<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');  // Ensure the model is loaded
        $this->load->library('session');
    }

    // Load the main home page
    public function index() {
        $this->load->view('home');
    }

    // Handle login form submission via AJAX (or regular POST)
    public function login() {
        // Check if the form is submitted with both username and password
        if ($this->input->post('username') && $this->input->post('password')) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Validate user credentials via the model
            $user = $this->User_model->validate_user($username, $password);

            if ($user) {
                // Set session data on successful login
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('name', $user->name);


                // If AJAX request, return JSON response with redirect URL
                if ($this->input->is_ajax_request()) {
                    echo json_encode([
                        'status' => 'success',
                        'redirect_url' => site_url('home/advanced')
                    ]);
                    return;
                } else {
                    redirect('home/advanced');
                }
            } else {
                // Invalid credentials: send back error message
                if ($this->input->is_ajax_request()) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Invalid username or password'
                    ]);
                    return;
                } else {
                    $data['login_error'] = true;
                    $this->load->view('home', $data);
                }
            }
        } else {
            // No post data provided
            if ($this->input->is_ajax_request()) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Please provide both username and password.'
                ]);
                return;
            } else {
                $this->load->view('home');
            }
        }
    }

    // Advanced page (after successful login)
    public function advanced() {
        if (!$this->session->userdata('user_id')) {
            redirect('home/login');
        }
        $this->load->view('advanced');
    }

    // Logout and destroy session
    public function logout() {
        $this->session->sess_destroy();
        redirect('home/login');
    }
    
    // New function to slide the home view to its bottom
    public function slide() {
        $data['slide_to_bottom'] = true;
        $this->load->view('home', $data);
    }
}
