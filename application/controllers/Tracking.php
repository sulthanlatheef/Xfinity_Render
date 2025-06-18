<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load the session library and the tracking model
        $this->load->library('session');
        $this->load->model('Tracking_model');
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
        $data['pickup_ids'] = $this->Tracking_model->get_pickup_ids_by_user($user_id);

        // Load the view and pass the data
        $this->load->view('tracking_view', $data);
    }

    public function details($pickup_id)
    {
        // 1. Load your model up front
        $this->load->model('Tracking_model');
    
        // 2. Get current user
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('login');
        }
    
        // 3. Fetch pickup details
        $pickup_details = $this->Tracking_model->get_pickup_details($user_id, $pickup_id);
        if (empty($pickup_details)) {
            show_404();
        }
    
        // 4. Fetch payment record for this user & pickup
        $payment = $this->Tracking_model->get_by_pickup_and_user($pickup_id, $user_id);
        $is_paid = ($payment && $payment->status === 'paid');
    
        // 5. Inject the flag into your details object
        $pickup_details->is_paid = $is_paid;
        $pickup_details->payment_id = $payment ? $payment->razorpay_payment_id : null;

    
        // 6. Save the pickup_id in session (for later AJAX status‐checks)
        $this->session->set_userdata('c_pickup_id', $pickup_id);
    
        // 7. Pass everything to your view
        $data['pickup_details'] = $pickup_details;
        $this->load->view('tracking_detail_view', $data);
    }
    
}
