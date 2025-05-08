<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mechacontrol extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Forcepickups_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    /**
     * Show all pickups for the mechanic’s city
     */
    public function view_pickups()
    {
        // 1) Get vcity from session
        $vcity = $this->session->userdata('vcity');

        if (empty($vcity)) {
            // If no city in session, redirect to login or dashboard
            redirect('login');
            return;
        }

        // 2) Fetch all matching pickups
        $data['pickups'] = $this->Forcepickups_model->get_by_city($vcity);
        
        // 3) Load the view and pass the data
        $this->load->view('view_pickups', $data);
    }
    public function geninvoice()
    {
        // Retrieve pickup_id from POST
        $pickup_id = $this->input->post('pickup_id');
    
        // Log the pickup_id
        log_message('info', 'Generating invoice for pickup_id: ' . $pickup_id);
    
        // Initialize the data array
        $data['pickup_id'] = $pickup_id;
    
        // Load the database if not autoloaded
        $this->load->database();
    
        // Fetch the name from the 'tracking' table based on pickup_id
        $query = $this->db->get_where('tracking', ['pickup_id' => $pickup_id]);
        $row = $query->row();
    
        if ($row) {
            $data['name'] = $row->name;
            $data['user_id'] = $row->user_id;
        } else {
            $data['name'] = null; // or handle missing entry appropriately
            log_message('error', 'No tracking entry found for pickup_id: ' . $pickup_id);
        }

        $query = $this->db->get_where('users', ['id' => $data['user_id']]);
        $row = $query->row();
        if ($row) {
            $data['membership'] = $row->membership_type;
            
        } else {
            $data['membership'] = null; // or handle missing entry appropriately
            log_message('error', 'No tracking entry found for pickup_id: ' . $pickup_id);
        }

    
        // Load the view
        $this->load->view('geninvoice', $data);
    }
    

public function finvoice() {
    $invoiceNumber = $this->input->post('invoice_number');
    $total = $this->input->post('total');
    $pickup_id = $this->input->post('pickup_id');

    // Log the incoming data
    log_message('info', "Received invoice $invoiceNumber with total $total for $pickup_id");

    // Update the pickups table
    $this->db->where('pickup_id', $pickup_id); // Assuming 'id' is the primary key column in the pickups table
    $this->db->update('forcepickups', ['invoice_number' => $invoiceNumber]);

    $this->db->where('pickup_id', $pickup_id); // Assuming 'id' is the primary key column in the pickups table
    $this->db->update('tracking', ['total_amount' => $total]);

    echo json_encode(['status' => 'success', 'message' => 'Invoice data received and updated.']);
}

    

    private function add_log($message)
{
    log_message('info', $message); // Writes to application/logs/log-*.php
}

    public function manage_service()
    {
        // 1) Get vcity from session
        $vcity = $this->session->userdata('vcity');

        if (empty($vcity)) {
            // If no city in session, redirect to login or dashboard
            redirect('login');
            return;
        }

        // 2) Fetch all matching pickups
        $data['pickups'] = $this->Forcepickups_model->get_by_city($vcity);
        
        // 3) Load the view and pass the data
        $this->load->view('manage_service', $data);
    }
    public function complete_pickup($pickup_id)
    {
        // Update status and lock it
        $this->Forcepickups_model->update_status_and_lock($pickup_id, 'Pickup Completed');
    
        // Redirect back to the list
        redirect('Mechacontrol/view_pickups');
    }
    
    public function update_status()
{
   
    $pickup_id = $this->input->post('pickup_id');
    $status    = $this->input->post('status');

    if($status === 'Service Completed'){

    $query = $this->db->get_where('tracking', array('pickup_id' => $pickup_id));

   
        $user_row = $query->row();
        $user_id = $user_row->user_id;
        $this->add_log("Retrieved user_id successfully(express service): {$user_id}");

        $query = $this->db->get_where('users', array('id' => $user_id));
       
        $user_row = $query->row();
        $email = $user_row->email;
        $this->add_log("Retrieved mail_id: {$email}");
    
        $query = $this->db->get_where('tracking', array('pickup_id' => $pickup_id));
        $user_row = $query->row();
        $name = $user_row->name;
        $total_amount = $user_row->total_amount;
        $service_type = $user_row->service_type;
        $brand = $user_row->brand;
    
        if ($service_type === 'Express') {
            $pickup_query = $this->db->get_where('pickups', array('pickup_id' => $pickup_id));
            if ($pickup_query->num_rows() > 0) {
                $pickup_row = $pickup_query->row();
                $invoice_number = $pickup_row->invoice_number;
                $this->add_log("Retrieved invoice number: {$invoice_number}");

                $pythonExecutable = 'C:\\Users\\shanu\\AppData\\Local\\Programs\\Python\\Python38\\python.exe';
                $pythonScriptPath = 'C:\\wamp64\\www\\XFINITY\\assets\\python\\test.py';
        
                // Pass parameters to the Python script
                $cmd = $pythonExecutable . " " . $pythonScriptPath . " " . 
                       escapeshellarg($email) . " " . 
                       escapeshellarg($name) . " " . 
                       escapeshellarg($pickup_id) . " " .  
                       escapeshellarg($invoice_number) . " 2>&1"; 
                      
                      
                     
        
                $this->add_log("Executing command: {$cmd}");
                
                // Execute the command and capture output
                $output = shell_exec($cmd);
                $this->add_log("Python script output: " . trim($output));
        
            } else {
                $this->add_log("No record found in 'pickups' for pickup_id: {$pickup_id}");
            }
        
    }
    
      else{

        $pickup_query = $this->db->get_where('forcepickups', array('pickup_id' => $pickup_id));
            if ($pickup_query->num_rows() > 0) {
                $pickup_row = $pickup_query->row();
                $invoice_number = $pickup_row->invoice_number;
                $this->add_log("Retrieved invoice number: {$invoice_number}");
        

            $pythonExecutable = 'C:\\Users\\shanu\\AppData\\Local\\Programs\\Python\\Python38\\python.exe';
                $pythonScriptPath = 'C:\\wamp64\\www\\XFINITY\\assets\\python\\test.py';
        
                // Pass parameters to the Python script
                $cmd = $pythonExecutable . " " . $pythonScriptPath . " " . 
                escapeshellarg($email) . " " . 
                escapeshellarg($name) . " " . 
                escapeshellarg($pickup_id) . " " .  
                escapeshellarg($invoice_number) . " 2>&1"; 
                      
                      
                     
        
                $this->add_log("Executing command for Regular pickup: {$cmd}");
                
                // Execute the command and capture output
                $output = shell_exec($cmd);
                $this->add_log("Python script output(force pickup): " . trim($output));
        
      }
    }
      
    
    }

    else{
 
        $this->add_log("Confirmation mail will only send for service Completed");
    }
   
        $this->Forcepickups_model->update_ser_and_lock($pickup_id, $status);

    
    


    // Return to the manage screen
    redirect('Mechacontrol/manage_service');
}

    
}
