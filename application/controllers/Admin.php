<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Admin')){
			redirect(base_url('IDE/Auth')); 
		}
  } 

  public function index(){
    $this->load->view('Admin/Header');
		$this->load->view('Admin/Dashboard');
  }

  public function GantiPassword(){
    $this->db->where('Username', $this->session->userdata('Username'));
    $this->db->update('Akun', array('Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT)));
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengganti Password!';
    }
  }

	public function Pengeluaran(){
    $Data['Pengeluaran'] = $this->db->get('Pengeluaran')->result_array();
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/Pengeluaran',$Data);
  }

  public function Input(){
    $this->db->insert('Pengeluaran', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Pengeluaran!';
    }
  }

  public function Edit(){
    $this->db->where('Id',$_POST['Id']);
    unset($_POST['Id']);
    $this->db->update('Pengeluaran', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo "Gagal Update Data!";
		}
	}

  public function Hapus(){
		$this->db->delete('Pengeluaran', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}
}