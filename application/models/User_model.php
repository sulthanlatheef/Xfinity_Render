<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database
    }

    // Validate user credentials
    public function validate_user($username, $password) {
        // Query the database for the user
        $this->db->where('username', $username); // Filter by username
        $query = $this->db->get('users'); // Assuming your table is 'users'

        if ($query->num_rows() == 1) {
            $user = $query->row();
            // Check if the password matches (plain text comparison for simplicity)
            if ($user->password == $password) {
                return $user; // Return the user object if valid
            }
        }
        return false;  // Return false if no match or invalid credentials
    }

     public function validate_email($email) {
        // Query the database for the user
        $this->db->where('email', $email); // Filter by username
        $query = $this->db->get('users'); // Assuming your table is 'users'

        if ($query->num_rows() == 1) {
            $user = $query->row();
            // Check if the password matches (plain text comparison for simplicity)
           
                return $user; // Return the user object if valid
            
        }
        return false;  // Return false if no match or invalid credentials
    }

    // Check if username exists
    public function check_username_exists($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users'); // Assuming your table is 'users'
        return $query->num_rows() > 0;
    }
     public function check_email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users'); // Assuming your table is 'users'
        return $query->num_rows() > 0;
    }


    // Register a new user
    public function register_user($user_data) {
        return $this->db->insert('users', $user_data); // Assuming your table is 'users'
    }
}
?>
