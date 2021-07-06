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

	public function Portfolio(){
    $Data['Portfolio'] = $this->db->get('portfolio')->result_array();
    $this->load->view('Econk/Header',$Data);
		$this->load->view('Econk/Portfolio',$Data);
  }

  public function GetNarasi($Id){
    echo $this->db->query('SELECT Narasi FROM `portfolio` WHERE Id = '.$Id)->row_array()['Narasi'];
  }

  public function Input(){
    $Foto = date('Ymd',time()).substr(password_hash('Thumbnail', PASSWORD_DEFAULT),7,7);
    $Foto = str_replace("/","E",$Foto);$Foto = str_replace(".","F",$Foto);
    $Tipe = pathinfo($_FILES['Thumbnail']['name'],PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['Thumbnail']['tmp_name'], "Thumbnail/".$Foto.".".$Tipe);
    $_POST['Thumbnail'] = $Foto.".".$Tipe;
    $this->db->insert('portfolio', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else { 
      echo 'Gagal Input Portfolio!';
    }
  }

  public function Edit(){
    if (count($_FILES) == 0) {
      $this->db->where('Id',$_POST['Id']);
      unset($_POST['Id']);unset($_POST['ThumbnailLama']);
      $this->db->update('portfolio', $_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo "Gagal Update Data!";
      }  
    } else if (count($_FILES) == 1) {
      if (!empty($_POST['ThumbnailLama'])) {
        unlink('Thumbnail/'.$_POST['ThumbnailLama']);
      }
			$NamaFile = date('Ymd',time()).substr(password_hash('Thumbnail', PASSWORD_DEFAULT),7,7);
      $NamaFile = str_replace("/","E",$NamaFile);$NamaFile = str_replace(".","F",$NamaFile);
      $Tipe = pathinfo($_FILES['Thumbnail']['name'],PATHINFO_EXTENSION);
      move_uploaded_file($_FILES['Thumbnail']['tmp_name'], "Thumbnail/".$NamaFile.".".$Tipe);
      $_POST['Thumbnail'] = $NamaFile.".".$Tipe;
      $this->db->where('Id',$_POST['Id']);
      unset($_POST['Id']);unset($_POST['ThumbnailLama']);
      $this->db->update('portfolio', $_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Update Data!';
      }  
		}
  }
  
  public function Hapus(){
    $this->db->delete('portfolio', array('Id' => $_POST['Id']));
		if ($this->db->affected_rows()){
      unlink('Thumbnail/'.$_POST['Thumbnail']);
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}
}