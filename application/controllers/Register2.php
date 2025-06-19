<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 1) Make sure Composer’s autoloader is loaded so Guzzle, Google_Client, etc. can be found
require_once FCPATH . 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;

class Register2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
         $this->load->model('User_model');
        $this->load->helper(['url','form']);
        $this->load->library(['form_validation','session']);
    }

    /**
     * STEP 1: Build the Google_Client, ask for consent, then redirect to Google.
     * This method does NOT try to handle any incoming "code" parameter.
     */
    public function googlecallback()
    {
        // Initialize Google Client
        $client = new Google_Client();
        $client->setPrompt('consent');
        $client->setClientId('189704440706-qvigrqndj8sf9j934cfch69hqpd3ukkq.apps.googleusercontent.com');
        $client->setClientSecret('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');
        // <-- NOTE: This must match exactly your "Authorized redirect URI" in Google Console:
        $client->setRedirectUri('https://xfinity-l6rj.onrender.com/index.php/register2/googlesignup');
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

    /**
     * STEP 2: Google redirects back here with “?code=…” (or ?error=…).
     * We exchange the code, fetch profile info, and load the “collect more data” view.
     */
    public function googlesignup()
{
    $client = new Google_Client();
    $client->setPrompt('consent');
    $client->setClientId('189704440706-qvigrqndj8sf9j934cfch69hqpd3ukkq.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('https://xfinity-l6rj.onrender.com/index.php/register2/googlesignup');
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

        //✅ Check if email already exists
        if (!$this->_check_email($email)) {
        //Email already exists, show error
         redirect('register2/emailerror');
           
            return;
        }

        // ✅ Store info in session and proceed
        $this->session->set_userdata('google_user', [
            'google_id' => $userInfo->id,
            'name'      => $userInfo->name,
            'email'     => $email,
            'status'    => '1',
            'picture'   => $userInfo->picture
        ]);

        redirect('register2/showGoogleForm');
    } else {
        redirect('register2/googlesignup');
    }
}
public function emailerror(){
     $this->load->view('emailerror');

}

public function _check_email($email)
{
    if ($this->User_model->check_email_exists($email)) {
        // Set flash data or log if needed
        return FALSE; // ❌ Email already exists
    }
    return TRUE; // ✅ Email is unique
}



    public function showGoogleForm()
{
   $data = $this->session->userdata('google_user');
if ($data && isset($data['status']) && $data['status'] == 1) {
  
    $data['status'] = '2';
$this->session->set_userdata('google_user', $data);

   $this->load->view('goolgesignup', ['data' => $data]);
} else {
     $this->load->view('refresh_error');// fallback if no session or status not 1
}

}

 public function validate_details() {
    $input = json_decode(file_get_contents('php://input'), true);
    $_POST = $input;

  
    $this->form_validation->set_rules('name',     'Full Name',       'required');
  $this->form_validation->set_rules(
    'username',
    'Username',
    'required|min_length[5]|regex_match[/^(?=.*\d).+$/]|callback__no_spaces|callback__check_username',
    array(
        'required'       => 'The %s field is required',
        'min_length'     => 'At least five characters long',
        'regex_match'    => 'Please include numbers',
        'callback__no_spaces' => 'Should not contain spaces',
        'callback__check_username' => 'Username already exists!'
    )
);

   $this->form_validation->set_rules(
    'contact',
    'Contact Number',
    'required|exact_length[10]|regex_match[/^[0-9]+$/]',
    array(
        'required'     => 'Please enter %s',
        'exact_length' => ' Must be exactly 10 digits',
        'regex_match'  => 'Must contain only numbers'
    )
);

   $this->form_validation->set_rules(
    'password',
    'Password',
    'required|min_length[6]',
    array(
        'required'   => 'Please enter your %s',
        'min_length' => ' At least 6 characters long'
    )
);


    if ($this->form_validation->run() === FALSE) {
        $errors = [];
        foreach (['name','username','contact','password'] as $f) {
            $msg = form_error($f);
            if ($msg) {
                $errors[$f] = strip_tags($msg);
            }
        }
        header('Content-Type: application/json');
        echo json_encode(['status'=>'error','errors'=>$errors]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status'=>'success']);
    }
}
public function _no_spaces($str)
{
    if (preg_match('/\s/', $str)) {
        $this->form_validation->set_message('_no_spaces', 'Should not contain spaces');
        return FALSE;
    }
    return TRUE;
}
public function _check_username($username) {
    // If username is empty, skip this check and let 'required' rule handle it
    if (empty($username)) {
        return TRUE;
    }

    if ($this->User_model->check_username_exists($username)) {
        $this->form_validation->set_message('_check_username', 'Username already exists!');
        return FALSE;
    }

    return TRUE;
}
 public function submit()
{
    // 1) Server-side validation
    $this->form_validation->set_rules('email',    'Email',          'required|valid_email');
    $this->form_validation->set_rules('name',     'Full Name',      'required');
    $this->form_validation->set_rules('username', 'Username',       'required|callback__check_username');
    $this->form_validation->set_rules('contact',  'Contact Number', 'required');
    $this->form_validation->set_rules('password', 'Password',       'required');

    if ($this->form_validation->run() === FALSE) {
        // Collect field-by-field errors
        $errors = [];
        foreach (['email','name','username','contact','password'] as $field) {
            if (form_error($field)) {
                $errors[$field] = strip_tags(form_error($field));
            }
        }

        // Send a 400 status to indicate client-side issues
        return $this->output
                    ->set_status_header(400)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => 'error',
                        'errors' => $errors
                    ]));
    }

    // 2) Create the user
    $user_data = [
        'id'          => rand(1000,9999),
        'email'       => $this->input->post('email'),
        'name'        => $this->input->post('name'),
        'membership_type' => "Regular Membership",
        'delivery_address' => "Not found,please add your delivery address",
        'username'    => $this->input->post('username'),
        'contact_no'  => $this->input->post('contact'),
        'password' => $this->input->post('password')  // remember to hash in production!
    ];


   if ($this->User_model->register_user($user_data)) {
        // success
        $resp = ['status' => 'success'];
        $status_code = 200;
    } else {
         //failure inserting
        $resp = [
            'status'  => 'error',
           'message' => 'There was a problem creating your account.'
        ];
       $status_code = 500;
   }

   $name = $user_data['name'];
      $email = $user_data['email'];
      $username=$user_data['username'];

    log_message('info', 'Name retrieved for suucess mail: ' . $email . ' | Name: ' . $name);
   $pythonExecutable = 'C:\\Users\\shanu\\AppData\\Local\\Programs\\Python\\Python38\\python.exe';
            $pythonScriptPath = 'C:\\wamp64\\www\\XFINITY\\assets\\python\\registered.py';

            // Pass parameters to the Python script
            $cmd = $pythonExecutable . " " . $pythonScriptPath . " " . 
                   escapeshellarg($email) . " " . 
                  
                   escapeshellarg($name) . " ".
                    escapeshellarg($username) . " 2>&1";

           log_message('info', "Executing command: {$cmd}");
            
            // Execute the command and capture output
            $output = shell_exec($cmd);
           log_message('info', "Python script output: " . trim($output));

            // Optionally, write the output to a file for later inspection
            file_put_contents(APPPATH . 'logs/python_debug.txt', date("Y-m-d H:i:s") . " - " . trim($output) . "\n", FILE_APPEND);


 

    return $this->output
                ->set_status_header($status_code)
                ->set_content_type('application/json')
                ->set_output(json_encode($resp));
}
}
