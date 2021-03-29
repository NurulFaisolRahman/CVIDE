<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PendampingDesa extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('PendampingDesa')){
			redirect(base_url('IDE/PendampingDesa')); 
		}
  } 

  public function index(){
    $this->load->view('PendampingDesa/Header');
		$this->load->view('PendampingDesa/Dashboard');
  }

  public function GantiPassword(){
    $this->db->where('Username', $this->session->userdata('KodeDesa'));
    $this->db->update('PendampingDesa', array('Password' => $_POST['Password']));
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengganti Password!';
    }
  }

	public function SurveiBPD(){
    $this->load->view('PendampingDesa/Header');
		$this->load->view('PendampingDesa/SurveiBPD');
  }

  public function InputBPD(){
    if ($this->db->get_where('pbpd', array('KodeDesa' => $this->session->userdata('KodeDesa')))->num_rows() === 0){
      $_POST['KodeDesa'] = $this->session->userdata('KodeDesa');
      $_POST['NamaDesa'] = $this->session->userdata('NamaDesa');
      $this->db->insert('pbpd',$_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Menyimpan Survei!';
      }
    } else {
      echo 'Data Survei Desa '.$this->session->userdata('NamaDesa').' Sudah Ada!';
    }
  }
  
  public function SurveiKinerjaPemDes(){
    $this->load->view('PendampingDesa/Header');
    $this->load->view('PendampingDesa/SurveiKinerjaPemDes');
  }
  
  public function InputKinerjaPemDes(){
    if ($this->db->get_where('pkinerjapemdes', array('KodeDesa' => $this->session->userdata('KodeDesa')))->num_rows() === 0){
      $_POST['KodeDesa'] = $this->session->userdata('KodeDesa');
      $_POST['NamaDesa'] = $this->session->userdata('NamaDesa');
      $this->db->insert('pkinerjapemdes',$_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Menyimpan Survei!';
      }
    } else {
      echo 'Data Survei Desa '.$this->session->userdata('NamaDesa').' Sudah Ada!';
    }
  }
  
}