<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata'); // Set to Indian time
        // Log that the Payment controller is loaded.
        $this->load->library('session');
        $this->load->model('tracking_model');
        $this->load->helper('url'); // Load the URL helper here
        log_message('info', 'Payment controller initialized.');
    }

    /**
     * Loads the initial view.
     */
    public function index() {
        log_message('info', 'Loading payment view.');
        // Loads the view without order details.
        $this->load->view('payment_view');
    }

    /**
     * Creates a Razorpay order.
     * Called via AJAX when the user clicks "Pay Now".
     */
    public function create_order() {
        // Log the start of order creation.
        log_message('info', 'create_order() called.');

        // Adjust the path if your vendor folder is located elsewhere.
        require_once(APPPATH.'../assets/vendor/autoload.php');

        $key_id = 'rzp_test_5eDUiiTXUK94MD';         // Replace with your Razorpay Key ID
        $key_secret = '9mxzfivN3YK8EH38Cg95hI7K';  // Replace with your Razorpay Secret

        $api = new Razorpay\Api\Api($key_id, $key_secret);

        $user_id = $this->session->userdata('user_id');
        $pickup_id = $this->session->userdata('c_pickup_id');
        $pickup_details  = $this->tracking_model->get_pickup_details($user_id, $pickup_id);
        $amount = $pickup_details->total_amount * 100;


        $orderData = [
            'receipt'         => 'rcpt_' . time(),
            'amount'          => $amount,  // Amount in paise (500 * 100)
            'currency'        => 'INR',
            'payment_capture' => 1       // Auto-capture enabled
        ];

        try {
            $order = $api->order->create($orderData);
            log_message('info', 'Order created: ' . json_encode($order));

            // Prepare data to send back to view.
            $data = [
                'order_id' => $order['id'],
                'key_id'   => $key_id,
                'amount'   => $amount
            ];
            echo json_encode(['status' => 'success', 'data' => $data]);
        } catch(Exception $e) {
            log_message('error', 'Error creating order: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    
    public function check_status() {
        // Get pickup id and user id from session data
        $pickup_id = $this->session->userdata('c_pickup_id');
        $user_id   = $this->session->userdata('user_id');

        // If session data is missing, return error JSON
        if (!$pickup_id || !$user_id) {
            header('Content-Type: application/json');
            echo json_encode([
                'status'  => 'error', 
                'message' => 'Invalid session data.'
            ]);
            return;
        }

        // Query the payments table for a matching record
        $this->db->where('pickup_id', $pickup_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('payments');

        // Return JSON depending on whether the payment record is found and its status
        header('Content-Type: application/json');

        if ($query->num_rows() > 0) {
            $payment = $query->row();
            // Assuming your 'status' field contains "paid" for successful transactions
            if (strtolower($payment->status) === 'paid') {
                echo json_encode(['status' => 'paid']);
            } else {
                echo json_encode(['status' => 'incomplete']);
            }
        } else {
            // No record means the transaction was aborted or not created
            echo json_encode(['status' => 'incomplete']);
        }
    }
    /**
     * Verifies the payment using Razorpay's signature.
     */
   public function verify_payment() {
    log_message('info', 'verify_payment() called.');
    // Get the JSON post data.
    $post = json_decode(file_get_contents('php://input'), true);
    log_message('info', 'Payment details received: ' . json_encode($post));

    require_once(APPPATH.'../assets/vendor/autoload.php');

    $key_id = 'rzp_test_5eDUiiTXUK94MD';          // Replace with your Razorpay Key ID
    $key_secret = '9mxzfivN3YK8EH38Cg95hI7K';        // Replace with your Razorpay Secret

    $api = new Razorpay\Api\Api($key_id, $key_secret);

    $attributes = [
        'razorpay_order_id'   => $post['razorpay_order_id'],
        'razorpay_payment_id' => $post['razorpay_payment_id'],
        'razorpay_signature'  => $post['razorpay_signature']
    ];

    try {
        // Verify the payment signature.
        $api->utility->verifyPaymentSignature($attributes);
        log_message('info', 'Payment verified successfully for order: ' . $post['razorpay_order_id']);
        
        // Payment is verified. Now record the payment details in the database.
        $user_id = $this->session->userdata('user_id');
        $pickup_id = $this->session->userdata('c_pickup_id');
        $pickup_details = $this->tracking_model->get_pickup_details($user_id, $pickup_id);
        $razorpay_payment_id = $post['razorpay_payment_id'];
         
        $payment_data = array(
            'user_id'          => $user_id,
            'pickup_id'        => $pickup_id,
            'razorpay_payment_id'       => $razorpay_payment_id,
            'collected_amount' => $pickup_details->total_amount,
            'status'           => 'paid'
        );
        
        if ($this->db->insert('payments', $payment_data)) {
            log_message('info', 'Payment record inserted successfully.');
        } else {
            $error = $this->db->error();
            log_message('error', 'Failed to insert payment record. Error: ' . json_encode($error));
        }
        
        // Retrieve the user's email from the database.
        $query = $this->db->get_where('users', array('id' => $user_id));
        if ($query->num_rows() > 0) {
            $user_row = $query->row();
            $email = $user_row->email;
            log_message('info', "Retrieved email: {$email}");



            $data = array(
               
                'name'                => $this->session->userdata('name'),
               
            );
            $razorpay_payment_id = $post['razorpay_payment_id'];
            $currentDate = date('Y-m-d');       // e.g., 2025-04-08
            $currentTime = date('H:i:s');       // e.g., 17:15:22
        
            // Trigger the Python script to send an email.
            // Use full paths for the Python executable and the script.
           
            // Define your script paths and parameters
            // Paths and parameters as before.
$pythonExecutable = 'C:\\Users\\shanu\\AppData\\Local\\Programs\\Python\\Python38\\python.exe';
$pythonScriptPath = 'C:\\wamp64\\www\\XFINITY\\assets\\python\\payment_confirm.py';

// Build the command string with properly escaped parameters.
$cmd = $pythonExecutable . " " . $pythonScriptPath . " " .
       escapeshellarg($pickup_details->total_amount) . " " .
       escapeshellarg($email) . " " .
       escapeshellarg($pickup_id) . " " .
       escapeshellarg($razorpay_payment_id) . " " .
       escapeshellarg($currentDate) . " " .
       escapeshellarg($currentTime) . " >NUL 2>&1";

// To improve responsiveness, we launch the process using the full command interpreter.
// Using "cmd /C" forces the command shell to execute our command, and "start /B" launches it in the background without opening a new window.
// This method helps detach the execution.
$fullCommand = 'cmd /C start /B ' . $cmd;

// Set an empty descriptor array (we don’t need to read or write to the process).
$descriptorspec = [
    0 => ['pipe', 'r'],
    1 => ['pipe', 'w'],
    2 => ['pipe', 'w']
];

// Launch the process.
$process = proc_open($fullCommand, $descriptorspec, $pipes);

if (is_resource($process)) {
    // Immediately close all pipes to detach execution.
    foreach ($pipes as $pipe) {
        fclose($pipe);
    }
    // Close the process handle to free up resources immediately.
    proc_close($process);
    log_message('info', "Executed asynchronous command via proc_open with cmd /C and start /B.");
} else {
    log_message('error', "Failed to launch asynchronous process.");
}
            
            



        
            // Optionally, write the output to a file for later inspection.
            //file_put_contents(APPPATH . 'logs/python_debug.txt', date("Y-m-d H:i:s") . " - " . trim($output) . "\n", FILE_APPEND);
        } else {
            log_message('info' , "No user found for user_id: " . $user_id);
        }
        
        $response = [
            'status'  => 'success',
            'message' => 'Payment Processed Successfully!'
        ];
    } catch (Exception $e) {
        log_message('error', 'Payment verification failed: ' . $e->getMessage());
        $response = [
           'status'  => 'error',
           'message' => 'Payment verification failed. ' . $e->getMessage()
        ];
    }
    
    echo json_encode($response);
   }    

    
}
