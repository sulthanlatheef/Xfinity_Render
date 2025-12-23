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
    $zip = $this->db->escape_str($zip);

    $this->db
        ->select('location, address, contact_no')
        ->where("',' || serviceable_zip || ',' LIKE '%,{$zip},%'", NULL, FALSE);

    return $this->db->get('ventures')->result_array();
}

}
