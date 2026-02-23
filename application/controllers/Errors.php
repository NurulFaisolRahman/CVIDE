<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function show_404() {
        $this->output->set_status_header('404');
        $this->load->view('errors/custom_404');
    }

    public function show_403() {
        $this->output->set_status_header('403');
        $this->load->view('errors/custom_403');
    }
}