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

  public function SesiBiaya(){
    $this->session->set_userdata(array('Kegiatan' => $_POST['Kegiatan']));
    echo '1';
  }

  public function Pengeluaran(){
    $Id = $this->session->userdata('Kegiatan');
    $Kegiatan = $this->db->query("SELECT * FROM `pendapatan` WHERE `Id`=".$Id)->row_array();
    $Data['NamaKegiatan'] = $Kegiatan['NamaKegiatan'];
    $Data['NominalKegiatan'] = $Kegiatan['NominalKegiatan'];
    $Data['Pengeluaran'] = $this->db->query("SELECT * FROM `pengeluaran` WHERE `DeleteAt` IS NULL AND `IdKegiatan`=".$Id)->result_array();
    $Data['Charge'] = 30/100*$Data['NominalKegiatan'];
    $Data['Saving'] = 20/100*$Data['NominalKegiatan'];
    $Data['Umum'] = 5/100*$Data['NominalKegiatan'];
    $Data['Biaya'] = 0;
    foreach ($Data['Pengeluaran'] as $key) {
      $Data['Biaya'] += $key['NominalPengeluaran'];
    }
    $Data['Saldo'] = $Data['NominalKegiatan'] - ($Data['Charge']+$Data['Saving']+$Data['Biaya']);
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/Pengeluaran',$Data);
  }

  public function InputPengeluaran(){
    $this->db->insert('pengeluaran', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data Pendapatan!';
    }
  }

  public function EditPengeluaran(){
    date_default_timezone_set("Asia/Jakarta");
    $_POST['UpdateAt'] = date("Y-m-d H:i:s");
    $this->db->where('Id',$_POST['Id']);
    $this->db->update('pengeluaran', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
      echo 'Gagal Update Data Pendapatan!';
    }
  }

  public function HapusPengeluaran(){
    date_default_timezone_set("Asia/Jakarta");
    $Hapus = array('DeleteAt' => date("Y-m-d H:i:s"));
		$this->db->where('Id',$_POST['Id']);
    $this->db->update('pengeluaran', $Hapus);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}

  public function Pendapatan(){
    $Data['Pendapatan'] = $this->db->get('pendapatan')->result_array();
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/Pendapatan',$Data);
  }

  public function InputPendapatan(){
    $this->db->insert('pendapatan', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data Pendapatan!';
    }
  }

  public function EditPendapatan(){
    date_default_timezone_set("Asia/Jakarta");
    $_POST['UpdateAt'] = date("Y-m-d H:i:s");
    $this->db->where('Id',$_POST['Id']);
    $this->db->update('pendapatan', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
      echo 'Gagal Update Data Pendapatan!';
    }
  }

  public function ExcelKas($From,$To){
    $Data['NamaFile'] = "Kas ".$From." Hingga ".$To;
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE Tanggal >= '".$From."' and Tanggal <= '".$To."' ORDER BY Tanggal ASC")->result_array();
		$this->load->view('ExcelKas',$Data);
  }

	public function Cashflow(){
    $Data['InLalu'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Tanggal` >= '2022-05' AND Tanggal <= '2023-12-30'")->row_array()['Total'];
    $Data['OutLalu'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='OUT' AND `Tanggal` >= '2022-05-10' AND Tanggal <= '2023-12-30'")->row_array()['Total'];
    $Data['SeleisihLalu'] = $Data['InLalu'] - $Data['OutLalu'];$Bulan = date("Y-n-j", strtotime("last day of previous month"));
    $Data['In'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND Tanggal <= '".$Bulan."' AND Tanggal >= '2024-01-01'")->row_array()['Total'];
    $Data['Out'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='Out' AND Tanggal <= '".$Bulan."' AND Tanggal >= '2024-01-01'")->row_array()['Total'];
    $Data['Outt'] = $this->db->query("SELECT SUM(NominalPengeluaran) AS Total FROM `pengeluaran`")->row_array()['Total'];
    $Data['SaldoLalu'] = $Data['SeleisihLalu'] + ($Data['In']-$Data['Out']-$Data['Outt']);
    $Data['InBerjalan'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Tanggal` LIKE '".date('Y-m')."%'")->row_array()['Total'];
    $Data['OutBerjalan'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='Out' AND `Tanggal` LIKE '".date('Y-m')."%'")->row_array()['Total'];
    $Umum = $this->db->get('kas')->result_array();
    $Biaya = $this->db->get('pengeluaran')->result_array();
    $Data['Kas'] = array_merge($Umum,$Biaya);
    array_multisort(array_column($Data['Kas'], 'Tanggal'), SORT_DESC, $Data['Kas']);
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/Cashflow',$Data);
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
    date_default_timezone_set("Asia/Jakarta");
    $_POST['UpdateAt'] = date("Y-m-d H:i:s");
    $this->db->where('Id',$_POST['Id']);
    $this->db->update('kas', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo "Gagal Update Data!";
		}
	}

  public function Hapus(){
    date_default_timezone_set("Asia/Jakarta");
    $Hapus = array('DeleteAt' => date("Y-m-d H:i:s"));
    $this->db->where('Id',$_POST['Id']);
		$this->db->update('kas', $Hapus);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}
}