<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load the session library and the tracking model
        $this->load->library('session');
        $this->load->model('tracking_model');
        $this->load->helper('url'); // Load the URL helper here
    }
    
    public function index()
    {
        // Retrieve the current user's ID from the session
        $user_id = $this->session->userdata('user_id');
        
        // If no user_id is set, redirect the user to the login page
        if(!$user_id) {
            redirect('login');
        }

        // Retrieve all pickup_ids for the current user from the 'tracking' table
        $data['pickup_ids'] = $this->tracking_model->get_pickup_ids_by_user($user_id);

        // Load the view and pass the data
        $this->load->view('tracking_view', $data);
    }

    public function details($pickup_id)
    {
        // Retrieve the current user's ID from the session
        $user_id = $this->session->userdata('user_id');
        
        // If no user_id is set, redirect the user to the login page
        if(!$user_id) {
            redirect('login');
        }
        
        // Retrieve all details for the given pickup_id and user_id
        $data['pickup_details'] = $this->tracking_model->get_pickup_details($user_id, $pickup_id);

        // If no details found, you might want to redirect or show an error
        if (empty($data['pickup_details'])) {
            show_404();
        }
        
        // Save the pickup_id in session as 'c_pickup_id'
        $this->session->set_userdata('c_pickup_id', $pickup_id);
        
        // Load the detail view and pass the data
        $this->load->view('tracking_detail_view', $data);
        
    }
}
