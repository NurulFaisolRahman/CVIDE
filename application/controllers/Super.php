<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Super')){
			redirect(base_url('IDE/Auth')); 
		}
  } 

  public function index(){
    $this->load->view('Super/Header');
		$this->load->view('Super/Dashboard');
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

	public function Pengeluaran(){
    $Data['Pengeluaran'] = $this->db->get('pengeluaran')->result_array();
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/Pengeluaran',$Data);
  }
}