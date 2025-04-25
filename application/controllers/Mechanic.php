<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mechanic extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');  // Ensure the model is loaded
        $this->load->library('session');
    }

    // Load the main home page
    public function index() {
        $this->load->view('mechanic');
    }
    public function mdashboard() {
        $this->load->view('mdashboard');
    }

    public function get_user_info()
{
    if ( ! $this->input->is_ajax_request()) {
        show_error('No direct script access allowed', 403);
    }
    // read JSON payload
    $post = json_decode(file_get_contents('php://input'), true);
    $username = isset($post['username']) ? trim($post['username']) : '';

    if ($username === 'admin') {
        // When username is exactly "admin"
        echo json_encode([
            'status'    => true,
            'city'      => 'Admin Login',
            'cityValue' => 'admin',
            'iconClass' => 'bxs-shield'   // boxicon class you want
        ]);
    } else {
        // fallback
        echo json_encode(['status' => false]);
    }
}


    public function registration()
    {
        $username = $this->input->post('username');
        $city     = $this->input->post('city');
        $password = $this->input->post('password');
    
        $data = [
            'username' => $username,
            'city'     => $city,
            'password' => $password
        ];
    
        $inserted = $this->db->insert('mechanic', $data);
    
        // If AJAX, return JSON; else fall back to flash+redirect
        if ($this->input->is_ajax_request()) {
            if ($inserted) {
                echo json_encode([
                    'status'  => true,
                    'message' => 'Registration successful! You can now log in.'
                ]);
            } else {
                echo json_encode([
                    'status'  => false,
                    'message' => 'Registration failed. Please try again.'
                ]);
            }
            return; // no further redirect
        }
    
        // non-AJAX fallback
        if ($inserted) {
            $this->session->set_flashdata('success', 'Registration successful! Please login.');
            redirect('mechanic/login');
        } else {
            $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            redirect('mechanic/register_form');
        }
    }
    

    public function login()
{
    // grab POST data
    $username = $this->input->post('username', TRUE);
    $password = $this->input->post('password', TRUE);
    $city     = $this->input->post('city', TRUE);

    // special “admin” login
    if ($username === 'admin' && $password === 'admin') {
        $isAjax = $this->input->is_ajax_request();

        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode([
                'status'   => true,
                'redirect' => site_url('admin/index')
            ]);
        } else {
            redirect('admin/index');
        }
        return; // stop further processing
    }

    // check table 'mechanic' for matching row
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    $this->db->where('city',     $city);
    $query = $this->db->get('mechanic');

    // Are we in an AJAX call?
    $isAjax = $this->input->is_ajax_request();

    if ($query->num_rows() === 1)
    {
        // login successful
        $mech = $query->row();
        $this->session->set_userdata([
            'mechanic_id' => $mech->id,
            'musername'    => $mech->username,
            'vcity'        => $mech->city,
            'logged_in'   => TRUE
        ]);

        if ($isAjax) {
            // send JSON telling the JS to redirect
            header('Content-Type: application/json');
            echo json_encode([
                'status'   => true,
                'redirect' => site_url('mechanic/mdashboard')
            ]);
        } else {
            // normal PHP redirect
            redirect('mechanic/mdashboard');
        }
    }
    else
    {
        // login failed
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode([
                'status'  => false,
                'message' => ' Invalid Credentials!'
            ]);
        } else {
            $this->session->set_flashdata('error', 'Invalid username, password or city');
            redirect('mechanic/index');
        }
    }
}



   
    
}
