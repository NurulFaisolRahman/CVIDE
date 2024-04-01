<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('SuperAdmin')){
			redirect(base_url()); 
		}
  } 

  public function index(){
    $this->load->view('SuperAdmin/Header');
		$this->load->view('SuperAdmin/Dashboard');
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

  public function ExcelKas($From,$To){
    $Data['NamaFile'] = "Kas ".$From." Hingga ".$To;
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE Tanggal >= '".$From."' and Tanggal <= '".$To."' ORDER BY Tanggal ASC")->result_array();
		$this->load->view('ExcelKas',$Data);
  }

	public function Kas(){
    $Data['In'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Date` >= '2022-05'")->row_array()['Total'];
    $Data['Out'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='OUT' AND `Date` >= '2022-05-10'")->row_array()['Total'];
    $this->db->order_by('Tanggal', 'DESC');
    $Data['Kas'] = $this->db->get('kas')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Kas',$Data);
  }

  public function Project(){
    $Data['Project'] = $this->db->get('project')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Project',$Data);
  }

  public function Matrikulasi(){
    $Data['Matrikulasi'] = $this->db->get('matrikulasi')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Matrikulasi',$Data);
  }
}