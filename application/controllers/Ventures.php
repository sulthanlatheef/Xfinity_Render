<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventures extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
          $this->load->helper('url');
             $this->load->library('session');
        $this->load->model('ventures_model');
    }

    /**
     * Show the full list + search box
     */
    public function index()
    {
        $data['ventures'] = $this->Ventures_model->get_all_ventures();
        $this->load->view('ventures', $data);
    }

    /**
     * AJAX endpoint: return JSON list of ventures
     * matching the given ZIP code.
     */
    public function search()
    {
        $zip = $this->input->get('zip', TRUE);
        $results = [];

        if ( ! empty($zip)) {
            $results = $this->Ventures_model->search_by_zip($zip);
        }

        // send JSON back to client
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($results));
    }
}
