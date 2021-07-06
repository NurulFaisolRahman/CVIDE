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

	public function Project(){
    $Data['Project'] = $this->db->get('project')->result_array();
    $this->load->view('Staf/Header',$Data);
		$this->load->view('Staf/Project',$Data);
  }

  public function Input(){
    if (count($_FILES) == 0) {
      $_POST['PJ'] = $this->session->userdata('Username');
      $this->db->insert('project', $_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Input Data!';
      }  
    } else if (count($_FILES) == 1) {
			$NamaFile = date('Ymd',time()).substr(password_hash('Project', PASSWORD_DEFAULT),7,7);
      $NamaFile = str_replace("/","E",$NamaFile);$NamaFile = str_replace(".","F",$NamaFile);
      $Tipe = pathinfo($_FILES['File']['name'],PATHINFO_EXTENSION);
      move_uploaded_file($_FILES['File']['tmp_name'], "Project/".$NamaFile.".".$Tipe);
      $_POST['File'] = $NamaFile.".".$Tipe;
      $_POST['PJ'] = $this->session->userdata('Username');
      $this->db->insert('project', $_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Input Data!';
      }  
		}
  }

  public function Edit(){
    if (count($_FILES) == 0) {
      $this->db->where('Id',$_POST['Id']);
      unset($_POST['Id']);unset($_POST['FileLama']);
      $this->db->update('project', $_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo "Gagal Update Data!";
      }  
    } else if (count($_FILES) == 1) {
      if (!empty($_POST['FileLama'])) {
        unlink('Project/'.$_POST['FileLama']);
      }
			$NamaFile = date('Ymd',time()).substr(password_hash('Project', PASSWORD_DEFAULT),7,7);
      $NamaFile = str_replace("/","E",$NamaFile);$NamaFile = str_replace(".","F",$NamaFile);
      $Tipe = pathinfo($_FILES['File']['name'],PATHINFO_EXTENSION);
      move_uploaded_file($_FILES['File']['tmp_name'], "Project/".$NamaFile.".".$Tipe);
      $_POST['File'] = $NamaFile.".".$Tipe;
      $this->db->where('Id',$_POST['Id']);
      unset($_POST['Id']);unset($_POST['FileLama']);
      $this->db->update('project', $_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Update Data!';
      }  
		}
	}

  public function Hapus(){
    $this->db->delete('project', array('Id' => $_POST['Id']));
		if ($this->db->affected_rows()){
      if (!empty($_POST['File'])) {
        unlink('Project/'.$_POST['File']);
      }
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}
}