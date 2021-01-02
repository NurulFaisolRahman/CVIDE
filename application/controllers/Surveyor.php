<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surveyor extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Surveyor')){
			redirect(base_url('IDE/Surveyor'));
		}
  } 

  public function index(){
    $this->load->view('Surveyor/Header');
		$this->load->view('Surveyor/Profil');
  }

  public function GantiPassword(){
    $this->db->where('NIK', $this->session->userdata('NIK'));
    $this->db->update('surveyor', array('Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT)));
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengganti Password!';
    }
  }

	public function SurveiBPD(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiBPD',$Data);
  }

  public function InputBPD(){
    if ($this->db->get_where('bpd', array('Desa' => $_POST['Desa']))->num_rows() === 0){
      $_POST['NIK'] = $this->session->userdata('NIK');
      $this->db->insert('bpd',$_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Menyimpan Survei!';
      }
    } else {
      $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode = "."'".$_POST['Desa']."'")->row_array()['Nama'];
      echo 'Data Survei Desa '.$Desa.' Sudah Ada!';
    }
  }
  
  public function SurveiKinerjaPemDes(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
    $this->load->view('Surveyor/SurveiKinerjaPemDes',$Data);
  }
  
  public function InputKinerjaPemDes(){
    if ($this->db->get_where('kinerjapemdes', array('Desa' => $_POST['Desa']))->num_rows() === 0){
      $_POST['NIK'] = $this->session->userdata('NIK');
      $this->db->insert('kinerjapemdes',$_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Menyimpan Survei!';
      }
    } else {
      $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode = "."'".$_POST['Desa']."'")->row_array()['Nama'];
      echo 'Data Survei Desa '.$Desa.' Sudah Ada!';
    }
  }

  public function SurveiKinerjaAparatur(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiKinerjaAparatur',$Data);
  }

  public function InputKinerjaAparatur(){
    if ($this->db->get_where('kinerjaaparatur', array('Desa' => $_POST['Desa']))->num_rows() === 0){
      $_POST['NIK'] = $this->session->userdata('NIK');
      $this->db->insert('kinerjaaparatur',$_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Menyimpan Survei!';
      }
    } else {
      $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode = "."'".$_POST['Desa']."'")->row_array()['Nama'];
      echo 'Data Survei Desa '.$Desa.' Sudah Ada!';
    }
  }

  public function SurveiIPM(){
		// $Data['Provinsi'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE length(Kode) = 2")->result_array();
    // $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiIPM',$Data);
  }

  public function InputIPM(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('ipm',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function Usia(){
    $NIK = $this->session->userdata('NIK');
    $Data['IPM'] = $this->db->query("SELECT NamaAnggota FROM `ipm` WHERE NIK='".$NIK."'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/Usia',$Data);
  }
  
}