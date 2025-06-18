<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 1) Make sure Composer’s autoloader is loaded so Guzzle, Google_Client, etc. can be found
require_once FCPATH . 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use Google_Client;
use Google_Service_Oauth2;

class Google_signin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
         $this->load->model('User_model');
        $this->load->helper(['url','form']);
        $this->load->library(['form_validation','session']);
    }

     public function googlecallback()
    {
        // Initialize Google Client
        $client = new Google_Client();
        $client->setPrompt('consent');
        $client->setClientId('189704440706-5en0i2sjfn5tndacdjllimgg07piaug9.apps.googleusercontent.com');
        $client->setClientSecret('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');
        // <-- NOTE: This must match exactly your "Authorized redirect URI" in Google Console:
        $client->setRedirectUri('http://localhost/XFINITY/index.php/Google_signin/google_login');
        $client->addScope("email");
        $client->addScope("profile");

        // ====== Disable SSL verification (DEV ONLY) ======
        $curlHandler = new CurlHandler();
        $handlerStack = HandlerStack::create($curlHandler);
        $guzzleClient = new Client([
            'handler' => $handlerStack,
            'verify'  => false, // remove in production
        ]);
        $client->setHttpClient($guzzleClient);
        // ================================================

        // Create the auth URL and redirect
        $authUrl = $client->createAuthUrl();
        redirect($authUrl);
    }
 
    public function google_login(){

         $client = new Google_Client();
    $client->setPrompt('consent');
    $client->setClientId('189704440706-5en0i2sjfn5tndacdjllimgg07piaug9.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost/XFINITY/index.php/Google_signin/google_login');
    $client->addScope("email");
    $client->addScope("profile");

    $curlHandler = new CurlHandler();
    $handlerStack = HandlerStack::create($curlHandler);
    $guzzleClient = new Client([
        'handler' => $handlerStack,
        'verify'  => false,
    ]);
    $client->setHttpClient($guzzleClient);

    if ($this->input->get('error')) {
        echo "Error during Google authentication: " . htmlspecialchars($this->input->get('error'));
        return;
    }

    if ($this->input->get('code')) {
        $token = $client->fetchAccessTokenWithAuthCode($this->input->get('code'));

        if (isset($token['error'])) {
            echo "Error while authenticating with Google: " . htmlspecialchars($token['error']);
            return;
        }

        $client->setAccessToken($token['access_token']);

        $oauth    = new Google_Service_Oauth2($client);
        $userInfo = $oauth->userinfo->get();

        $email = $userInfo->email;

         $user = $this->User_model->validate_email($email);
    
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
                        'redirect_url' => site_url('Advanced')
                    ]);
                    return;
                } else {
                    redirect('advanced');
                }
            } 

            else{

                 redirect('Google_signin/emailexist');
                

            }
    }


    }

    public function emailexist(){
         $this->load->view('emailexist');
    }
}