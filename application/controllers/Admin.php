<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');  // Ensure the model is loaded
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    // Load the main home page
    public function index() {
        $this->load->view('administrator');
    }

     public function promocodes() {
        $this->load->view('promocodes');
    }
     public function promocodeview() {
        // Fetch all promocodes
        $data['promocodes'] = $this->db->order_by('promocode', 'ASC')->get('promocodes')->result();
        // Load management view
        $this->load->view('promocodeview', $data);
    }

      public function delete_promocode($code) {
        $code = urldecode($code);
        if ($this->db->delete('promocodes', ['promocode' => $code])) {
            $this->session->set_flashdata('success', 'Promocode deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Unable to delete promocode.');
        }
        redirect('admin/promocodeview');
    }

    /**
     * Toggle promocode status between active/inactive by code value
     */
    public function toggle_status($code) {
        $code = urldecode($code);
        // Get current record
        $promo = $this->db->get_where('promocodes', ['promocode' => $code])->row();
        if (!$promo) {
            $this->session->set_flashdata('error', 'Promocode not found.');
            return redirect('admin/promocodeview');
        }

        $new_status = $promo->status === 'active' ? 'paused' : 'active';
        $this->db->update('promocodes', ['status' => $new_status], ['promocode' => $code]);

        $this->session->set_flashdata('success', 'Promocode status updated.');
        redirect('admin/promocodeview');
    }


   public function create()
{
    // Only run when form is submitted
    if ($this->input->post()) {
        $code = trim($this->input->post('promocode'));

        // 1) Manual existence check
        $exists = $this->db
                       ->where('promocode', $code)
                       ->count_all_results('promocodes') > 0;

        if ($exists) {
            // Pass error into the view
            $data['error'] = 'Promocode "' . htmlspecialchars($code) . '" already exists.';
            return $this->load->view('promocodes', $data);
        }

        // 2) Form validation rules (no is_unique, since we've done manual check)
        $this->form_validation->set_rules('promocode', 'Promocode', 'required');
        $this->form_validation->set_rules('discount', 'Discount',   'required|numeric');
        $this->form_validation->set_rules('type',     'Type',       'required|in_list[common,unique]');

        if ($this->form_validation->run() === FALSE) {
            // validation failed
            return $this->load->view('promocodes');
        }

        // 3) Insert
        $data = [
            'promocode' => $code,
            'discount'  => $this->input->post('discount'),
            'type'      => $this->input->post('type'),
            'status'    => 'active'
        ];
        $this->db->insert('promocodes', $data);

        // 4) Success flash & redirect
        $this->session->set_flashdata('success', 'Promocode created successfully!');
        redirect('Admin/promocodes');
    }

    // First time load
    $this->load->view('promocodes');
}


   
    
}
