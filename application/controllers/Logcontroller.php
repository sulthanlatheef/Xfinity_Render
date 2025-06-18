<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogController extends CI_Controller {
     public function __construct() {
        parent::__construct();
        $this->load->helper('url');
       // $this->load->model('User_model');  // Ensure the model is loaded
        $this->load->library('session');
        //$this->load->model('User_model_profile');
    }

    public function index() {
        $log_path = APPPATH . 'logs/';
        $files = array_diff(scandir($log_path), ['.', '..']);
        $data['files'] = $files;
        $this->load->view('log_list', $data);
    }

    public function view($filename) {
        $log_path = APPPATH . 'logs/' . $filename;
        if (file_exists($log_path)) {
            $content = file_get_contents($log_path);
            echo "<pre>" . htmlspecialchars($content) . "</pre>";
        } else {
            show_404();
        }
    }
}
