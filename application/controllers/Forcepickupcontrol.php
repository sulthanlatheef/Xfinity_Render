<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forcepickupcontrol extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load form, URL, and database libraries
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->model('User_model_profile');
    }

    // Display the upload form
    public function index() {

        if ( ! $this->session->has_userdata('user_id')) {
            redirect('login');
            return;
        }

        // 2. Retrieve user_id from session
        $user_id = $this->session->userdata('user_id');

        // 3. Load user data
        $user = $this->User_model_profile->get_by_id($user_id);

        if ( ! $user) {
            show_error('User not found', 404);
        }

        // 4. Ensure membership_type key exists
        if (empty($user['membership_type'])) {
            $user['membership_type'] = 'Not Available';
        }
        $data['user'] = $user;
        $this->load->view('forcepickup',$data);
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
       // $this->session->set_userdata('originalPrediction', $this->input->post('originalPrediction'));
        $this->session->set_userdata('brand', $this->input->post('brand'));
        $this->session->set_userdata('model', $this->input->post('model'));
       // $this->session->set_userdata('invoiceNumber', $this->input->post('invoiceNumber'));
       // $this->session->set_userdata('totalAmount', $this->input->post('totalAmount'));
        $this->session->set_userdata('pickupdate', $this->input->post('pickup_date'));
        $this->session->set_userdata('pickuptime', $this->input->post('pickup_time'));
        $this->session->set_userdata('pickupaddress', $this->input->post('pickup_address'));
        $this->session->set_userdata('pickupcity', $this->input->post('pickup_city'));
        $this->session->set_userdata('pickupstate', $this->input->post('pickup_state'));
        $this->session->set_userdata('pickupzip', $this->input->post('pickup_zip'));
        $this->session->set_userdata('vehiclereg', $this->input->post('vehicle_reg'));
        // Return a JSON response indicating success
        echo json_encode(['status' => 'success']);
    }
    

    public function pickupdata_view() {
        
        
        $this->load->view('pickup_view');
    }

}





