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

	public function SurveiBPD(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiBPD',$Data);
  }

  public function SurveiIPM(){
		$Data['Provinsi'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE length(Kode) = 2")->result_array();
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.01.%'")->result_array();
		$this->load->view('SurveiIPM',$Data);
  }
  
  public function SurveiKinerjaPemDes(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
		$this->load->view('SurveiKinerjaPemDes',$Data);
	}
  
}