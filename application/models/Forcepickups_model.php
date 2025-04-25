<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forcepickups_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
 * Fetch all pickups where pickup_zip matches zip codes for a given service_center (vcity)
 *
 * @param string $city
 * @return array
 */
public function get_by_city($city)
{
    // Get zip codes from service_locations for the given city
    $zip_codes = $this->db
                      ->select('zip_code')
                      ->where('service_center', $city)
                      ->get('service_locations')
                      ->result_array();

    // Extract zip codes into a simple array
    $zip_code_list = array_column($zip_codes, 'zip_code');

    if (empty($zip_code_list)) {
        return []; // No matching zip codes found
    }

    // Get tracking data where pickup_zip is in the zip_code list
    return $this->db
                ->where_in('pickup_zip', $zip_code_list)
                ->get('tracking')
                ->result_array();
}


     /**
     * Update the status of a pickup.
     *
     * @param string|int $pickup_id
     * @param string $status
     * @return bool
     */
    public function update_status_and_lock($pickup_id, $status)
    {
        return $this->db
                    ->where('pickup_id', $pickup_id)
                    ->update('tracking', [
                        'status' => $status,
                        'status_locked' => 1 // lock it permanently after marking as completed
                    ]);
    }

   /**
 * Update the status of a pickup.
 *
 * @param string|int $pickup_id
 * @param string $status
 * @return bool
 */
public function update_ser_and_lock($pickup_id, $status)
{
    $update_data = ['status' => $status];

    if (strtolower($status) === 'service completed') {
        $update_data['ser_locked'] = 1;
    }

    return $this->db
                ->where('pickup_id', $pickup_id)
                ->update('tracking', $update_data);
}

    
}

   

