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
        $data['membership'] = $isLoggedIn ? $this->session->userdata('membership') : 'Error in fetching membership';
        $user_id = $this->session->userdata('user_id');
        $membership= $this->session->userdata('membership');
        if ($membership == 'Gold Membership') {
    
           

            // Fetch subscription
            $this->db->where('user_id', $user_id);
            $subscription = $this->db->get('subscriptions')->row();
            log_message('info', 'Fetched subscription for user ID ' . $user_id);

            if ($subscription) {
                $current_date = date('Y-m-d');
                log_message('info', 'Subscription end date: ' . $subscription->end_date . ', Current date: ' . $current_date);

                if (strtotime($subscription->end_date) < strtotime($current_date)) {
                    // Expired
                    log_message('info', 'Subscription expired. Updating status and membership_type.');

                    $this->db->where('user_id', $user_id);
                    $this->db->update('subscriptions', ['status' => 'expired']);

                    $this->db->where('id', $user_id);
                    $this->db->update('users', ['membership_type' => 'Regular Membership']);

                    $this->session->set_userdata('membership', 'Regular Membership');
                } else {
                    log_message('info', 'Subscription still active.');
                }
            } else {
                log_message('info', 'No subscription found for user ID ' . $user_id);
            }
        }
        
        $this->load->view('advanced', $data);
    }

    public function update_address()
    {
      // 1) Ensure DB & URL helper are loaded
      $this->load->database();
      $this->load->helper('url');
  
      // 2) Grab the posted address (with XSS cleaning)
      $new_address = $this->input->post('delivery_address', TRUE);
  
      // 3) Identify the current user
      $user_id = $this->session->userdata('user_id');
  
      // 4) Directly update the 'users' table
      $this->db
        ->where('id', $user_id)
        ->update('users', [ 'delivery_address' => $new_address ]);
  
      // 5) Provide feedback
      $this->session->set_flashdata('addr_success', 'Delivery address updated.');
  
      // 6) Redirect back — use HTTP_REFERER or fallback to site root
      $ref = $this->input->server('HTTP_REFERER');
      if ( ! $ref) {
        $ref = site_url();  // or any default page
      }
      redirect($ref);
    }
    
    // Logout method destroys the session and redirects to the homepage
    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }
}
