<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
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

        $orderData = [
            'receipt'         => 'rcpt_' . time(),
            'amount'          => 50000,  // Amount in paise (500 * 100)
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
                'amount'   => 50000
            ];
            echo json_encode(['status' => 'success', 'data' => $data]);
        } catch(Exception $e) {
            log_message('error', 'Error creating order: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
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
        $api->utility->verifyPaymentSignature($attributes);
        log_message('info', 'Payment verified successfully for order: ' . $post['razorpay_order_id']);
        
        // Payment is verified. Now record the payment details in the database.
        $user_id = $this->session->userdata('user_id');
        $pickup_id = $this->session->userdata('c_pickup_id');
        $pickup_details = $this->tracking_model->get_pickup_details($user_id, $pickup_id);

        $payment_data = array(
            'user_id'         => $user_id,
            'pickup_id'       => $pickup_id,
            'collected_amount'=> $pickup_details->total_amount,
            'status'          => 'paid'
        );
        
        if ($this->db->insert('payments', $payment_data)) {
            log_message('info', 'Payment record inserted successfully.');
        } else {
            $error = $this->db->error();
            log_message('error', 'Failed to insert payment record. Error: ' . json_encode($error));
        }

        $response = [
            'status'  => 'success',
            'message' => 'Payment Verified Successfully!'
        ];
    } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
        log_message('error', 'Payment verification failed: ' . $e->getMessage());
        // Payment verification failed
        $response = [
            'status'  => 'error',
            'message' => 'Payment verification failed: ' . $e->getMessage()
        ];
    }
    
    echo json_encode($response);
}

    
}
