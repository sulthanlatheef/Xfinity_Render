<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class advanced extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the session library and URL helper for redirection
        $this->load->library('session');
        $this->load->helper('url');
    }

    // Default method loads the homepage view
    public function index() {
        // Check if the user is logged in using CodeIgniter session userdata
        $isLoggedIn = $this->session->userdata('username') ? true : false;
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userName'] = $isLoggedIn ? $this->session->userdata('name') : 'Guest';
        
        $this->load->view('advanced', $data);
    }
    
    // Logout method destroys the session and redirects to the homepage
    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }
}
