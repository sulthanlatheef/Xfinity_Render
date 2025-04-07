<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Load the database library
        $this->load->database();
    }
    
    /**
     * Get all pickup_ids for the given user_id from the tracking table.
     *
     * @param int $user_id
     * @return array
     */
    public function get_pickup_ids_by_user($user_id)
    {
        $this->db->select('pickup_id, model, created_at,status'); // Now fetching model and created_at
        $this->db->from('tracking');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        
        // Return results as an array of objects
        return $query->result();
    }
    
    
    /**
     * Get all details for a specific pickup_id for the given user_id.
     *
     * @param int $user_id
     * @param mixed $pickup_id
     * @return object
     */
    public function get_pickup_details($user_id, $pickup_id)
    {
        $this->db->from('tracking');
        $this->db->where('user_id', $user_id);
        $this->db->where('pickup_id', $pickup_id);
        $query = $this->db->get();
        
        // Return a single row object
        return $query->row();
    }
}
