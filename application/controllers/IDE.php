<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IDE extends CI_Controller {

	public function index(){
		$this->load->view('IDE');
	}
	
	public function SurveiIPM(){
		$Data['Provinsi'] = $this->db->query("SELECT * FROM `KodeWilayah` WHERE length(Kode) = 2")->result_array();
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `KodeWilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `KodeWilayah` WHERE Kode LIKE '11.01.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `KodeWilayah` WHERE Kode LIKE '11.01.01.%'")->result_array();
		$this->load->view('SurveiIPM',$Data);
  }
  
  public function SurveiIKM(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `KodeWilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `KodeWilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
		$this->load->view('SurveiIKM',$Data);
  }
  
  public function SurveiBPD(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `KodeWilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `KodeWilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
		$this->load->view('SurveiBPD',$Data);
	}

	function Kabupaten(){
    $Kabupaten = $this->db->query("SELECT * FROM `KodeWilayah` WHERE Kode LIKE "."'".$_POST['Kode'].".%"."' AND length(Kode) = 5")->result_array();
    $OpsiKabupaten = "";
    foreach ($Kabupaten as $key) {
      $OpsiKabupaten .= "<option value='".$key['Kode']."'>".$key['Nama']."</option>";
    }
    echo $OpsiKabupaten;
  }
  
  function Kecamatan(){
    $Kecamatan = $this->db->query("SELECT * FROM `KodeWilayah` WHERE Kode LIKE "."'".$_POST['Kode'].".%"."' AND length(Kode) = 8")->result_array();
    $OpsiKecamatan = "";
    foreach ($Kecamatan as $key) {
      $OpsiKecamatan .= "<option value='".$key['Kode']."'>".$key['Nama']."</option>";
    }
    echo $OpsiKecamatan;
  }

  function Desa(){
    $Desa = $this->db->query("SELECT * FROM `KodeWilayah` WHERE Kode LIKE "."'".$_POST['Kode'].".%"."'")->result_array();
    $OpsiDesa = "";
    foreach ($Desa as $key) {
      $OpsiDesa .= "<option value='".$key['Kode']."'>".$key['Nama']."</option>";
    }
    echo $OpsiDesa;
  }
}