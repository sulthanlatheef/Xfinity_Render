<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // Load the URL helper and Upload library
        $this->load->helper(array('url'));
        $this->load->library('upload');
    }

    public function save_invoice() {
        // Only allow POST requests
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['invoice']) && $_FILES['invoice']['error'] == 0) {
                // Set upload configuration
                $uploadPath = '/tmp/';  // Make sure this directory exists and is writable.
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'pdf';
                // Optionally, use a custom file name. Here we use the original name.
                $config['file_name']     = $_FILES['invoice']['name'];

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('invoice')) {
                    $error = array('error' => $this->upload->display_errors());
                    echo json_encode(array(
                        'status'  => 'error',
                        'message' => $error
                    ));
                } else {
                    $data = $this->upload->data();
                    echo json_encode(array(
                        'status'   => 'success',
                        'message'  => 'Invoice saved successfully on server.',
                        'filepath' => $uploadPath . $data['file_name']
                    ));
                }
            } else {
                echo json_encode(array(
                    'status'  => 'error',
                    'message' => 'No invoice file uploaded or an error occurred.'
                ));
            }
        } else {
            echo json_encode(array(
                'status'  => 'error',
                'message' => 'Invalid request method.'
            ));
        }
    }
}
