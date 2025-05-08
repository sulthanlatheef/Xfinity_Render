<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model_profile extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get user record by ID
     * @param  int   $id
     * @return array|null
     */
    public function get_by_id($id)
    {
        return $this->db
                    ->select('id, avatar, name, username, email, contact_no, delivery_address, membership_type')
                    ->from('users')
                    ->where('id', $id)
                    ->get()
                    ->row_array();
    }
}
