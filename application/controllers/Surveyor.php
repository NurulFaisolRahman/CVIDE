<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surveyor extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Surveyor')){
			redirect(base_url()); 
		}
  } 

  public function index(){
    $this->load->view('Surveyor/Header');
		$this->load->view('Surveyor/Profil');
  }
  // $2y$10$nhEvPNxmjSLuZMzDn6y5QuFOqDN6gXcN5sPrLMba8I.wVbECFkqda 12345678
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
    $Data['Provinsi'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE length(Kode) = 2")->result_array();
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiBPD',$Data);
  }
  
  public function SurveiKinerjaPemDes(){
    $Data['Provinsi'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE length(Kode) = 2")->result_array();
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
    $this->load->view('Surveyor/SurveiKinerjaPemDes',$Data);
  }

  public function SurveiKinerjaAparatur(){
    $Data['Provinsi'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE length(Kode) = 2")->result_array();
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiKinerjaAparatur',$Data);
  }

  public function Input($Tabel){
    if ($this->db->get_where($Tabel, array('Desa' => $_POST['Desa'], 'Tahun' => $_POST['Tahun']))->num_rows() === 0){
      $_POST['NIK'] = $this->session->userdata('NIK');
      $this->db->insert($Tabel,$_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Menyimpan Survei!';
      }
    } else {
      $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode = "."'".$_POST['Desa']."'")->row_array()['Nama'];
      echo 'Data Survei Desa '.$Desa.' Tahun '.$_POST['Tahun'].' Sudah Ada!';
    }
  }

  public function SurveiIPM(){
		// $Data['Provinsi'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE length(Kode) = 2")->result_array();
    // $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    // $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.%' AND length(Kode) = 8")->result_array();
    // $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.01.%'")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiIPM',$Data);
  }

  public function InputIPM(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('surveiipm',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function SurveiHargaKonsumenPerdesaan(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.24.%' AND length(Kode) = 8")->result_array();
    // $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.24.01.%'")->result_array();
    $Data['Data'] = $this->db->query("SELECT kodewilayah.Nama as NamaKecamatan,ntpkonsumen.* FROM kodewilayah,ntpkonsumen WHERE ntpkonsumen.Kecamatan=kodewilayah.Kode AND NIK = ".$this->session->userdata('NIK')." ORDER BY TanggalSurvei DESC")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiHargaKonsumenPerdesaan',$Data);
  }

  public function InputNTPKonsumen(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('ntpkonsumen',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function EditNTPKonsumen(){
    $this->db->where('Id',$_POST['Id']);
    unset($_POST['Id']);
    $this->db->update('ntpkonsumen', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data Survei!';
    }
  }

  public function CopyNTPKonsumen(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('ntpkonsumen',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function SurveiHargaProdusenPerdesaan(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.24.%' AND length(Kode) = 8")->result_array();
    // $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.24.01.%'")->result_array();
    $Data['Data'] = $this->db->query("SELECT kodewilayah.Nama as NamaKecamatan,ntpprodusen.* FROM kodewilayah,ntpprodusen WHERE ntpprodusen.Kecamatan=kodewilayah.Kode AND NIK = ".$this->session->userdata('NIK')." ORDER BY TanggalSurvei DESC")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiHargaProdusenPerdesaan',$Data);
  }

  public function InputNTPProdusen(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('ntpprodusen',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function CopyNTPProdusen(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('ntpprodusen',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function EditNTPProdusen(){
    $this->db->where('Id',$_POST['Id']);
    unset($_POST['Id']);
    $this->db->update('ntpprodusen', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data Survei!';
    }
  }
  
}