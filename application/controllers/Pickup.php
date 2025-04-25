<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pickup extends CI_Controller {

    private $debug_logs = array();

    public function __construct()
    {
        parent::__construct();
        // Load session library, URL helper, and database
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    // This method handles the data insertion and email notification
    public function confirm()
    {
        $this->add_log("Starting pickup confirmation process.");

        // Check if the user is logged in by verifying if user_id exists in session
        $user_id = $this->session->userdata('user_id');
        if (empty($user_id)) {
            $this->add_log("No user ID found in session. Redirecting to login.");
            redirect('login');
        }

        // Generate a unique 8-digit alphanumeric pickup id
        $pickup_id = $this->generate_pickup_id();
        $this->add_log("Generated Pickup ID: {$pickup_id}");

        // Collect data from session
        $data = array(
            'user_id'             => $user_id,
            'name'                => $this->session->userdata('name'),
            'brand'               => $this->session->userdata('brand'),
            'model'               => $this->session->userdata('model'),
            'original_prediction' => $this->session->userdata('originalPrediction'),
            'pickup_address'      => $this->session->userdata('pickupaddress'),
            'pickup_date'         => $this->session->userdata('pickupdate'),
            'pickup_time'         => $this->session->userdata('pickuptime'),
            
            'pickup_id'           => $pickup_id,
            'invoice_number'      => $this->session->userdata('invoiceNumber'),
            'total_amount'        => $this->session->userdata('totalAmount'),
            'vehicle_reg'         => $this->session->userdata('vehiclereg'),
            'pickup_zip'        => $this->session->userdata('pickupzip'),
        );

        // Check if invoice_number is not empty
        if (!empty($data['invoice_number'])) {
            $data['service_type'] = 'Express';

            // Insert the data into the 'pickups' table
            $insert = $this->db->insert('pickups', $data);
            if ($insert) {
                $this->add_log("Data inserted successfully into pickups table.");
            } else {
                $error = $this->db->error();
                $this->add_log("Failed to insert data into pickups table. Error: " . json_encode($error));
            }
        } else {
            // Remove invoice_number and total_amount from data array
            unset($data['invoice_number'], $data['total_amount']);
            // Insert the data into the 'forcepickups' table
            $data['service_type'] = 'Regular';

            $insert = $this->db->insert('forcepickups', $data);
            if ($insert) {
                $this->add_log("Data inserted successfully into forcepickups table.");
            } else {
                $error = $this->db->error();
                $this->add_log("Failed to insert data into forcepickups table. Error: " . json_encode($error));
            }
        }


        // Insert a record into the 'tracking' table
$tracking_data = array(
    'user_id'   => $data['user_id'],
    'name'      => $data['name'],
    'pickup_zip' => $data['pickup_zip'],
    'pickup_id' => $pickup_id,
    'pickup_date' => $data['pickup_date'],
    'pickup_time' => $data['pickup_time'],
    'pickup_address' => $data['pickup_address'],
    'brand'     => $data['brand'],
    'service_type'     => $data['service_type'],
    'model'     => $data['model'],
    'registration_no'     => $data['vehicle_reg'],
    'issue'     => $data['original_prediction'],
    'total_amount'=> empty($data['total_amount']) ? 'force pickup' : $data['total_amount'],
    'status'    => 'Pickup Scheduled'
    
    
);

if($this->db->insert('tracking', $tracking_data)) {
    $this->add_log("Tracking record inserted successfully.");
} else {
    $error = $this->db->error();
    $this->add_log("Failed to insert tracking record. Error: " . json_encode($error));
}


        // Retrieve the email address corresponding to the user_id from the users table
        $query = $this->db->get_where('users', array('id' => $user_id));
        if ($query->num_rows() > 0) {
            $user_row = $query->row();
            $email = $user_row->email;
            $this->add_log("Retrieved email: {$email}");

            // Trigger the Python script to send an email.
            // Use full paths for the Python executable and script.
            $pythonExecutable = 'C:\\Users\\shanu\\AppData\\Local\\Programs\\Python\\Python38\\python.exe';
            $pythonScriptPath = 'C:\\wamp64\\www\\XFINITY\\assets\\python\\send_email.py';

            // Pass parameters to the Python script
            $cmd = $pythonExecutable . " " . $pythonScriptPath . " " . 
                   escapeshellarg($data['name']) . " " . 
                   escapeshellarg($data['brand']) . " " . 
                   escapeshellarg($data['model']) . " " . 
                   escapeshellarg($email) . " " . 
                   escapeshellarg($data['original_prediction']) . " " .
                   escapeshellarg($data['pickup_date']) . " " . 
                   escapeshellarg($data['pickup_time']) . " " .
                   escapeshellarg($data['vehicle_reg']) . " " .
                   escapeshellarg($data['pickup_id']) . " 2>&1";

            $this->add_log("Executing command: {$cmd}");
            
            // Execute the command and capture output
            $output = shell_exec($cmd);
            $this->add_log("Python script output: " . trim($output));

            // Optionally, write the output to a file for later inspection
            file_put_contents(APPPATH . 'logs/python_debug.txt', date("Y-m-d H:i:s") . " - " . trim($output) . "\n", FILE_APPEND);
        } else {
            $this->add_log("No user found for user_id: " . $user_id);
        }

        // Store necessary details in session for the confirmation page along with debug logs
        $this->session->set_userdata('pickup_data', $data);
        $this->session->set_userdata('debug_logs', $this->debug_logs);

        $this->add_log("Pickup data stored in session.");
        $this->add_log("Redirecting to pickup/show_confirmation.");

        redirect('pickup/show_confirmation');
    }

    // This method displays the confirmation page
    public function show_confirmation()
    {
        // Retrieve the data from session
        $pickup_data = $this->session->userdata('pickup_data');
        $debug_logs = $this->session->userdata('debug_logs');

        if (!$pickup_data) {
            echo "No pickup data found. Please schedule a pickup.";
            return;
        }

        // Pass data and debug logs to view
        $this->load->view('pickup_confirmation', array(
            'pickup_id'  => $pickup_data['pickup_id'],
            'data'       => $pickup_data,
            'debug_logs' => $debug_logs
        ));
    }

    // Private method to generate a unique 8-digit alphanumeric string
    private function generate_pickup_id()
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pickup_id = '';
        for ($i = 0; $i < 8; $i++) {
            $pickup_id .= $pool[mt_rand(0, strlen($pool) - 1)];
        }
        return $pickup_id;
    }

    // Helper method to add a log entry to our debug_logs array
    private function add_log($message)
    {
        $this->debug_logs[] = $message;
        // Also log to CodeIgniter log files
        log_message('debug', $message);
    }
}
?>