<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    public function __construct() {
        parent::__construct();
          $this->load->helper('url');
               $this->load->library('session');
        $this->load->model('chat_model');
    }

    public function index() {
        $this->session->unset_userdata('chat_context');
        $this->load->view('chat_view');
    }

    public function ask() {
        $message = $this->input->post('message');

        // Load session context
        $context = $this->session->userdata('chat_context');
        if (!$context) {
            $context = [];
        }

        $response = $this->Chat_model->ask_gemini($message, $context);

        // Save context
        $context[] = ['role' => 'user', 'parts' => [['text' => $message]]];
        $context[] = ['role' => 'model', 'parts' => [['text' => $response]]];
        $this->session->set_userdata('chat_context', $context);

        echo json_encode(['response' => $response]);
    }

    public function reset() {
        $this->session->unset_userdata('chat_context');
        echo "Chat reset.";
    }
}
