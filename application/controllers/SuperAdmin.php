<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('SuperAdmin')){
			redirect(base_url()); 
		}
  } 

  public function index(){
    $this->load->view('SuperAdmin/Header');
		$this->load->view('SuperAdmin/Dashboard');
  }

  public function GantiPassword(){
    $this->db->where('Username', $this->session->userdata('Username'));
    $this->db->update('akun', array('Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT)));
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengganti Password!';
    }
  }

  public function ExcelKas($From,$To){
    $Data['NamaFile'] = "Kas ".$From." Hingga ".$To;
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE Tanggal >= '".$From."' and Tanggal <= '".$To."' ORDER BY Tanggal ASC")->result_array();
		$this->load->view('ExcelKas',$Data);
  }

	public function Kas(){
    $Data['Kas'] = $this->db->get('kas')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Kas',$Data);
  }
}