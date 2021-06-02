<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Econk extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Econk')){
			redirect(base_url()); 
		}
  } 

  public function index(){
    $this->load->view('Econk/Header');
		$this->load->view('Econk/Dashboard');
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

	public function Project(){
    $Data['Project'] = $this->db->get('project')->result_array();
    $Data['PJ'] = $this->db->get_where('akun', array('Level' => 3))->result_array();
    $this->load->view('Econk/Header',$Data);
		$this->load->view('Econk/Project',$Data);
  }

  public function Input(){
    $this->db->insert('project', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Project!';
    }
  }

  public function Edit(){
    $this->db->where('Id',$_POST['Id']);
    unset($_POST['Id']);
    $this->db->update('project', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo "Gagal Update Data!";
		}
	}

  public function Hapus(){
		$this->db->delete('project', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}
}