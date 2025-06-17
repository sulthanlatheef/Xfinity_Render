<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');  // Ensure the model is loaded
        $this->load->library('session');
        $this->load->model('User_model_profile');
    }

    // Load the main home page
    public function index() {
        $this->load->view('home');
    }

    // Handle login form submission via AJAX (or regular POST)
    public function login() {
        if ($this->input->post('username') && $this->input->post('password')) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
    
            log_message('info', 'Login attempt for username: ' . $username);
    
            // Special case: administrator login
            if ($username === 'administrator' && $password === 'administrator') {
                log_message('info', 'Administrator login success.');
    
                $this->session->set_userdata('user_id', 0);
                $this->session->set_userdata('username', 'administrator');
                $this->session->set_userdata('name', 'Administrator');
    
                if ($this->input->is_ajax_request()) {
                    echo json_encode([
                        'status' => 'success',
                        'redirect_url' => site_url('Mechanic')
                    ]);
                    return;
                } else {
                    redirect('mechanic');
                }
            }
    
            // Validate user credentials via the model
            $user = $this->User_model->validate_user($username, $password);
    
            if ($user) {
                log_message('info', 'User validated: ID ' . $user->id);
    
                $this->session->set_userdata([
                    'user_id'   => $user->id,
                    'username'  => $user->username,
                    'name'      => $user->name,
                    'membership'=> $user->membership_type,
                    'avatar'    => $user->avatar ?: 'https://api.dicebear.com/6.x/initials/svg?seed=' . urlencode($user->name)
                ]);
                if ($user->membership_type == 'Gold Membership') {
    
                $user_id = $user->id;
    
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
                        
    
                if ($this->input->is_ajax_request()) {
                    echo json_encode([
                        'status' => 'success',
                        'redirect_url' => site_url('advanced')
                    ]);
                    return;
                } else {
                    redirect('home/advanced');
                }
            } else {
                log_message('error', 'Invalid login attempt for username: ' . $username);
    
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
            log_message('error', 'Login request missing username or password.');
    
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
    
    public function update_avatar()
    {
        // Only logged-in users
        $uid = $this->session->userdata('user_id');
        if ( ! $uid) {
            return $this->output
                ->set_status_header(403)
                ->set_output('{"error":"Not logged in"}');
        }
    
        // Grab JSON body
        $body = json_decode($this->input->raw_input_stream, true);
        $url  = $this->db->escape_str( $body['avatar_url'] ?? '' );
        if ( ! $url) {
            return $this->output
                ->set_status_header(400)
                ->set_output('{"error":"No avatar_url"}');
        }
    
        // Directly update the `users` table
        $this->db
             ->where('id', $uid)
             ->update('users', ['avatar' => $url]);
    
        // Refresh session so the sidebar shows it immediately
        $this->session->set_userdata('avatar', $url);
    
        // OK
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['status'=>'ok']));
    }

    
    public function profile()
    {
        // 1. Check login
        if ( ! $this->session->has_userdata('user_id')) {
            redirect('login');
            return;
        }

        // Unset the 'promocode' from session
$this->session->unset_userdata('promocode');

// Log the removal of the promocode
log_message('info', 'Promocode has been removed from session.');

        // 2. Retrieve user_id from session
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

        // 3. Load user data
        $user = $this->User_model_profile->get_by_id($user_id);
        $this->load->database();

// Query the subscriptions table for the user's end_date
$this->db->select('end_date');
$this->db->from('subscriptions');
$this->db->where('user_id', $user_id);
$query = $this->db->get();

if ($query->num_rows() > 0) {
    $row = $query->row();
    $end_date = $row->end_date;
} else {
    $end_date = null; // Or handle as needed if no subscription found
}

        if ( ! $user) {
            show_error('User not found', 404);
        }

        // 4. Ensure membership_type key exists
        if (empty($user['membership_type'])) {
            $user['membership_type'] = 'Not Available';
        }

        // 5. Pass to view
        $data['user'] = $user;
        $data['expiry'] =  $end_date;
        $this->load->view('profile', $data);
    }
    

    // Logout and destroy session
    public function logout() {
        $this->session->sess_destroy();
        redirect('home/login');
    }
      public function logoutadmin() {
        $this->session->sess_destroy();
        redirect('mechanic');
    }
    
    // New function to slide the home view to its bottom
    public function slide() {
        $data['slide_to_bottom'] = true;
        $this->load->view('home', $data);
    }
}
