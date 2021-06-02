<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Staf')){
			redirect(base_url()); 
		}
  } 

  public function index(){
    $this->load->view('Staf/Header');
		$this->load->view('Staf/Dashboard');
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
    $this->load->view('Staf/Header',$Data);
		$this->load->view('Staf/Pengeluaran',$Data);
  }

  public function Input(){
    $this->db->insert('pengeluaran', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Pengeluaran!';
    }
  }

  public function Edit(){
    $this->db->where('Id',$_POST['Id']);
    unset($_POST['Id']);
    $this->db->update('pengeluaran', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo "Gagal Update Data!";
		}
	}

  public function Hapus(){
		$this->db->delete('pengeluaran', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}
}