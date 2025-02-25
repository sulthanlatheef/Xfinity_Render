<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model'); // Load your User model
        $this->load->helper('url'); // Load URL helper
        $this->load->helper('form'); // Load Form helper
    }

    public function index() {
        $data['error_message'] = '';
        $data['success_message'] = '';

        // Load the view
        $this->load->view('register', $data);
    }

    public function submit() {
        $data['error_message'] = '';
        $data['success_message'] = '';

        // Form validation rules
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register', $data);
        } else {
            $name = $this->input->post('name');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Check if username contains spaces
            if (preg_match('/\s/', $username)) {
                $data['error_message'] = "Username cannot contain spaces!";
                $this->load->view('register', $data);
                return;
            }

            // Check if username already exists
            if ($this->User_model->check_username_exists($username)) {
                $data['error_message'] = "Username already exists. Please choose another one.";
                $this->load->view('register', $data);
            } else {
                // Generate a random ID
                $random_id = rand(1000, 9999);

                // Save the user to the database
                $user_data = array(
                    'id' => $random_id,
                    'name' => $name,
                    'username' => $username,
                    'password' => $password // Ideally, you should hash the password
                );

                if ($this->User_model->register_user($user_data)) {
                    $data['success_message'] = "Account created successfully!";
                    $this->load->view('register', $data);
                } else {
                    $data['error_message'] = "There was a problem creating your account.";
                    $this->load->view('register', $data);
                }
            }
        }
    }
}
?>
