

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;

class Register extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(['url','form']);
        $this->load->library(['form_validation','session']);
    }

    public function index() {
        $this->load->view('register');
    }

  

    public function otp()
{
    $input = json_decode(file_get_contents('php://input'), true);
    $email = $input['email'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email']);
        return;
    }

    // Generate 6-digit OTP
    $otp = rand(100000, 999999);

    // Store OTP and email in session
   $this->session->set_userdata('otp', $otp);
$this->session->set_userdata('otp_email', $email);
$this->session->set_userdata('otp_time', time()); // Store current timestamp


    // Log the OTP generation event (do NOT log the actual OTP in production)
    log_message('info', 'OTP generated for email: ' . $email . ' | OTP: ' . $otp);

           $pythonExecutable = 'python3';
           $pythonScriptPath = '/var/www/html/assets/python/send_otp_email.py';

            // Pass parameters to the Python script
            $cmd = $pythonExecutable . " " . $pythonScriptPath . " " . 
                   escapeshellarg($email) . " " . 
                  
                   escapeshellarg($otp) . " 2>&1";

           log_message('info', "Executing command: {$cmd}");
            
            // Execute the command and capture output
            $output = shell_exec($cmd);
           log_message('info', "Python script output: " . trim($output));

            // Optionally, write the output to a file for later inspection
            file_put_contents(APPPATH . 'logs/python_debug.txt', date("Y-m-d H:i:s") . " - " . trim($output) . "\n", FILE_APPEND);

    // Return success response
    echo json_encode(['status' => 'success', 'otp' => $otp]);
}


public function verify_otp()
{
    $input = json_decode(file_get_contents('php://input'), true);
    $submittedOtp = $input['otp'] ?? '';

    $storedOtp = $this->session->userdata('otp');
    $otpTime   = $this->session->userdata('otp_time');

    if (!$storedOtp || !$otpTime) {
        echo json_encode(['status' => 'cleared', 'message' => 'Your session has expired. Please request a new OTP.']);
        return;
    }

    // Check if OTP expired (5 minutes = 300 seconds)
    if (time() - $otpTime > 300) {
        $this->session->unset_userdata(['otp', 'otp_email', 'otp_time']);
        echo json_encode(['status' => 'expired', 'message' => 'Your OTP has expired. Please request a new one.']);
        return;
    }

    else if ($submittedOtp == $storedOtp) {
        $this->session->unset_userdata(['otp', 'otp_email', 'otp_time']);
        echo json_encode(['status' => 'success', 'message' => 'OTP verified']);
    } else {
        echo json_encode(['status' => 'invalid', 'message' => 'Incorrect OTP. Please try again.']);
    }
}


    /**
     * Called via AJAX from step 2 to validate name, username, contact & password.
     */
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


public function _check_email($email) {
    if ($this->User_model->check_email_exists($email)) {
        $this->form_validation->set_message('_check_email', 'This email is already registered with us, please login');
        return FALSE;
    }
    return TRUE;
}

 public function validate_email() {
    $input = json_decode(file_get_contents('php://input'), true);
    $_POST = $input;

    $this->form_validation->set_rules('email',    'Email',           'required|valid_email|callback__check_email');
   

    if ($this->form_validation->run() === FALSE) {
        $errors = [];
        foreach (['email'] as $f) {
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


public function testGoogleClient()
{
    $client = new Google_Client();
    $client->setApplicationName("Test App");
    echo "Google Client initialized!";
}
    /**
     * Final submission (after OTP & confirmation)
     */
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
