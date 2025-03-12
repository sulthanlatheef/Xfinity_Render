<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageUpload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load form and URL helpers
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

    // Display the upload form
    public function index() {
        
        $this->load->view('image_upload_form');
    }

    

    // Function to handle the upload and prediction logic
    public function predict() {
        // Check if an image file was uploaded
        if (empty($_FILES['image']['name'])) {
            // Return a JSON error response if no file was selected
            echo json_encode(['error' => 'Please select an image to upload.']);
            return;
        }

        // Prepare the file for cURL
        $filePath = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        $fileName = $_FILES['image']['name'];
        
        // Use CURLFile to attach the file to the POST request
        $cfile = new CURLFile($filePath, $fileType, $fileName);

        // Create an array with the file data
        $data = array('image' => $cfile);

        // Initialize cURL to call the Flask API endpoint
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:5000/predict"); // Flask API endpoint URL
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $result = curl_exec($ch);

        // Handle any cURL errors
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            echo json_encode(['error' => $error_msg]);
            return;
        }
        curl_close($ch);

        // Optionally, set header for JSON response and return the API's result
        header('Content-Type: application/json');
        echo $result;
    }

    
}