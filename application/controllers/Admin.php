<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Admin')){
			redirect(base_url()); 
		}
  } 

  public function index(){
    $this->load->view('Admin/Header');
		$this->load->view('Admin/Dashboard');
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

  public function Matrikulasi(){
    $Data['Matrikulasi'] = $this->db->get('matrikulasi')->result_array();
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/Matrikulasi',$Data);
  }

  public function InputMatrikulasi(){
    $this->db->insert('matrikulasi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data!';
    }
  }

  public function EditMatrikulasi(){
    $this->db->where('Id',$_POST['Id']);
    $this->db->update('matrikulasi', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo "Gagal Update Data!";
		}
  }

  public function ExcelKas($From,$To){
    $Data['NamaFile'] = "Kas ".$From." Hingga ".$To;
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE Tanggal >= '".$From."' and Tanggal <= '".$To."' ORDER BY Tanggal ASC")->result_array();
		$this->load->view('ExcelKas',$Data);
  }

	public function Kas(){
    $Data['InLalu'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Tanggal` >= '2022-05' AND Tanggal <= '2023-12-30'")->row_array()['Total'];
    $Data['OutLalu'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='OUT' AND `Tanggal` >= '2022-05-10' AND Tanggal <= '2023-12-30'")->row_array()['Total'];
    $Data['SeleisihLalu'] = $Data['InLalu'] - $Data['OutLalu'];
    $Data['In'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Tanggal` <= ".date('Y')."-0".(date('m')-1)." AND Tanggal >= '2024-01-01'")->row_array()['Total'];
    $Data['Out'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='OUT' AND `Tanggal` <= ".date('Y')."-0".(date('m')-1)." AND Tanggal >= '2024-01-01'")->row_array()['Total'];;
    $Data['SaldoLalu'] = $Data['SeleisihLalu'] + ($Data['In']-$Data['Out']);
    $Data['InBerjalan'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Tanggal` LIKE '".date('Y-m')."%'")->row_array()['Total'];
    $Data['OutBerjalan'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='Out' AND `Tanggal` LIKE '".date('Y-m')."%'")->row_array()['Total'];
    $this->db->order_by('Id', 'DESC');
    $Data['Kas'] = $this->db->get('kas')->result_array();
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/Kas',$Data);
  }

  public function Input(){
    $this->db->insert('kas', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data!';
    }
  }

  public function Edit(){
    $this->db->where('Id',$_POST['Id']);
    $this->db->update('kas', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo "Gagal Update Data!";
		}
	}

  public function Hapus(){
		$this->db->delete('kas', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}
}