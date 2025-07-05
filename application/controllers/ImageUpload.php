<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageUpload extends CI_Controller {

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
        $data['user'] = $user;
        $this->load->view('image_upload_form',$data);
    }

    // Function to handle the upload and prediction logic
     public function predict() {
    // Log entry into the method
    log_message('info', '[Predict] Entry into predict()');

    // Check if file is provided
    if (empty($_FILES['image']['name'])) {
        log_message('error', '[Predict] No image file in request.');
        echo json_encode(['error' => 'Please select an image to upload.']);
        return;
    }

    // Retrieve file info
    $filePath = $_FILES['image']['tmp_name'];
    $fileType = $_FILES['image']['type'];
    $fileName = $_FILES['image']['name'];
    log_message('debug', "[Predict] Received file: name={$fileName}, type={$fileType}, tmp_path={$filePath}");

    // Prepare CURLFile
    try {
        $cfile = new CURLFile($filePath, $fileType, $fileName);
    } catch (Exception $e) {
        log_message('error', '[Predict] Failed to create CURLFile: ' . $e->getMessage());
        echo json_encode(['error' => 'Internal error preparing file upload.']);
        return;
    }
    $data = ['image' => $cfile];

    // Endpoint URL
    $url = "https://yolo-host2.onrender.com/predict";
    log_message('info', "[Predict] Preparing cURL request to URL: {$url} (SSL verification disabled)");

    // Initialize cURL
    $ch = curl_init();
    if ($ch === false) {
        log_message('error', '[Predict] curl_init() returned false.');
        echo json_encode(['error' => 'Failed to initialize request.']);
        return;
    }

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Disable SSL verification (INSECURE: only for dev/test)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    // Log as 'error' since CI3 does not have 'warning'
    log_message('error', '[Predict] SSL verification disabled (CURLOPT_SSL_VERIFYPEER=false, CURLOPT_SSL_VERIFYHOST=0).');

    // Optionally, set timeouts:
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    log_message('debug', '[Predict] cURL options set: POSTFIELDS with image, RETURNTRANSFER enabled, timeouts set.');

    // Execute
    $result = curl_exec($ch);
    $curlErrNo = curl_errno($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    log_message('debug', "[Predict] curl_exec completed. HTTP code: {$httpCode}, curl_errno: {$curlErrNo}");

    if ($curlErrNo) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        log_message('error', "[Predict] cURL error ({$curlErrNo}): {$error_msg}");
        echo json_encode(['error' => $error_msg]);
        return;
    }

    // Close cURL handle
    curl_close($ch);
    log_message('info', "[Predict] cURL request successful. Response length: " . strlen($result));

    // Optionally: Validate that result is valid JSON
    $decoded = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $jsonErr = json_last_error_msg();
        log_message('error', "[Predict] Response is not valid JSON: {$jsonErr}. Raw response: {$result}");
        echo json_encode([
            'error' => 'Invalid response from prediction service',
            'raw_response' => $result
        ]);
        return;
    }
    log_message('debug', '[Predict] Response decoded as JSON successfully.');

    // Return JSON response
    header('Content-Type: application/json');
    echo $result;
    log_message('info', '[Predict] Response sent back to client. Exiting predict().');
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
        $this->session->set_userdata('vehiclereg', $this->input->post('vehicle_reg'));
        $this->session->set_userdata('vehicletyp', $this->input->post('vehicle_typ'));
        $this->session->set_userdata('delivery', $this->input->post('delivery_addr'));
        log_message('info', 'Delivery address set in session: ' . $this->input->post('delivery_addr'));
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





