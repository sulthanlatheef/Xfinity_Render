<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageUpload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load form, URL, and database libraries
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    // Display the upload form
    public function index() {
        $this->load->view('image_upload_form');
    }

    // Function to handle the upload and prediction logic
    public function predict() {
        if (empty($_FILES['image']['name'])) {
            echo json_encode(['error' => 'Please select an image to upload.']);
            return;
        }
        $filePath = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        $fileName = $_FILES['image']['name'];
        $cfile = new CURLFile($filePath, $fileType, $fileName);
        $data = array('image' => $cfile);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:5000/predict"); // Flask API endpoint URL
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            echo json_encode(['error' => $error_msg]);
            return;
        }
        curl_close($ch);
        header('Content-Type: application/json');
        echo $result;
    }

    // AJAX method to fetch brands matching the search term
    public function get_brands() {
        $term = $this->input->get('term');
        $this->db->like('name', $term);
        $query = $this->db->get('brands');
        $result = $query->result_array();
        echo json_encode($result);
    }

    // AJAX method to fetch models corresponding to a brand and matching the search term
    public function get_models() {
        $brand_id = $this->input->get('brand_id');
        $term = $this->input->get('term');
        $this->db->where('brand_id', $brand_id);
        $this->db->like('name', $term);
        $query = $this->db->get('models');
        $result = $query->result_array();
        echo json_encode($result);
    }

    public function save_pickupdata() {
        // Retrieve POST data and set them directly in session
        $this->session->set_userdata('originalPrediction', $this->input->post('originalPrediction'));
        $this->session->set_userdata('brand', $this->input->post('brand'));
        $this->session->set_userdata('model', $this->input->post('model'));
        $this->session->set_userdata('invoiceNumber', $this->input->post('invoiceNumber'));
        $this->session->set_userdata('totalAmount', $this->input->post('totalAmount'));
        $this->session->set_userdata('pickupdate', $this->input->post('pickup_date'));
        $this->session->set_userdata('pickuptime', $this->input->post('pickup_time'));
        $this->session->set_userdata('pickupaddress', $this->input->post('pickup_address'));
        $this->session->set_userdata('pickupcity', $this->input->post('pickup_city'));
        $this->session->set_userdata('pickupstate', $this->input->post('pickup_state'));
        $this->session->set_userdata('pickupzip', $this->input->post('pickup_zip'));
    
        // Return a JSON response indicating success
        echo json_encode(['status' => 'success']);
    }
    

    public function pickupdata_view() {
        
        
        $this->load->view('pickup_view');
    }



    // New AJAX method to get the accessory price
    public function get_accessory_price() {
        $brand_id = $this->input->get('brand_id');
        $model = $this->input->get('model');
        $accessory = $this->input->get('accessory');

        $this->db->where('brand_id', $brand_id);
        $this->db->where('model', $model);
        $this->db->where('accessory', $accessory);
        $query = $this->db->get('accessories');

        $result = $query->row_array();
        if($result) {
            echo json_encode(['price' => $result['price']]);
        } else {
            echo json_encode(['price' => 'Not available']);
        }
    }
}





