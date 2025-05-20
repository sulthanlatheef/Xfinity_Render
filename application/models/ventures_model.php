<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventures_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_ventures()
    {
        return $this->db->get('ventures')->result_array();
    }

    /**
     * Search ventures by a single ZIP code in the
     * comma-separated `serviceable_zip` field.
     *
     * @param  string $zip
     * @return array
     */
    public function search_by_zip($zip)
    {
        // Use FIND_IN_SET to match exact zip in CSV field
        $this->db
             ->select('location, address, contact_no')
             ->where("FIND_IN_SET(" . $this->db->escape($zip) . ", serviceable_zip) >", 0);

        return $this->db->get('ventures')->result_array();
    }
}
