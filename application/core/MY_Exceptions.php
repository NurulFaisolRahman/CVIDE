<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

    function show_403($page = '', $message = '') {
        $this->ci =& get_instance();
        $this->ci->output->set_status_header(403);

        // Load view custom 403
        $this->ci->load->view('errors/custom_403');
        exit;
    }
}