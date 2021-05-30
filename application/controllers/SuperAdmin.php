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

  public function ExcelInvoice($Filter){
    $Data['NamaFile'] = "Invoice-".$Filter;
    $Data['Pengeluaran'] = $this->db->query("SELECT * FROM `pengeluaran` WHERE Tanggal LIKE '".$Filter."%' ORDER BY Tanggal ASC")->result_array();
		$this->load->view('Invoice',$Data);
  }

	public function Pengeluaran(){
    $Data['Pengeluaran'] = $this->db->get('pengeluaran')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Pengeluaran',$Data);
  }
}