<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SmbLandingPage extends CI_Controller {

    public function index() {
        $this->load->view('Smb/SmbLandingPage');
    }
}