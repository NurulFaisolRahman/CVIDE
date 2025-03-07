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
    $Umum = $this->db->query("SELECT * FROM `kas` WHERE Tanggal >= '".$From."' and Tanggal <= '".$To."' AND DeleteAt IS NULL ORDER BY Tanggal ASC")->result_array();
    $Biaya = $this->db->query("SELECT * FROM `pengeluaran` WHERE Tanggal >= '".$From."' and Tanggal <= '".$To."' AND DeleteAt IS NULL ORDER BY Tanggal ASC")->result_array();
    $Data['Kas'] = array_merge($Umum,$Biaya);
    array_multisort(array_column($Data['Kas'], 'Tanggal'), SORT_ASC, $Data['Kas']);
		$this->load->view('ExcelKas',$Data);
  }

	public function Cashflow(){
    $InLalu = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Tanggal` >= '2022-05' AND Tanggal <= '2023-12-30' AND DeleteAt IS NULL")->row_array()['Total'];
    $OutLalu = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='OUT' AND `Tanggal` >= '2022-05-10' AND Tanggal <= '2023-12-30' AND DeleteAt IS NULL")->row_array()['Total'];
    $SeleisihLalu = $InLalu - $OutLalu;$Bulan = date("Y-n-j", strtotime("last day of previous month"));
    $In = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND Tanggal <= '".$Bulan."' AND Tanggal >= '2024-01-01' AND DeleteAt IS NULL")->row_array()['Total'];
    $Out = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='Out' AND Tanggal <= '".$Bulan."' AND Tanggal >= '2024-01-01' AND DeleteAt IS NULL")->row_array()['Total'];
    $Outt = $this->db->query("SELECT SUM(NominalPengeluaran) AS Total FROM `pengeluaran` WHERE Tanggal <= '".$Bulan."' AND DeleteAt IS NULL")->row_array()['Total'];
    $Data['SaldoLalu'] = $SeleisihLalu + ($In-$Out-$Outt);
    $Data['InBerjalan'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Tanggal` LIKE '".date('Y-m')."%' AND DeleteAt IS NULL")->row_array()['Total'];
    $OutBulan = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='Out' AND `Tanggal` LIKE '".date('Y-m')."%' AND DeleteAt IS NULL")->row_array()['Total'];
    $OuttBulan = $this->db->query("SELECT SUM(NominalPengeluaran) AS Total FROM `pengeluaran` WHERE `Tanggal` LIKE '".date('Y-m')."%' AND DeleteAt IS NULL")->row_array()['Total'];
    $Data['OutBerjalan'] = $OutBulan + $OuttBulan;
    $Umum = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL")->result_array();
    $Biaya = $this->db->query("SELECT * FROM `pengeluaran` WHERE DeleteAt IS NULL")->result_array();
    $Data['Kas'] = array_merge($Umum,$Biaya);
    array_multisort(array_column($Data['Kas'], 'Tanggal'), SORT_DESC, $Data['Kas']);
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Cashflow',$Data);
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

  public function Pendapatan(){
    $Data['Pendapatan'] = $this->db->get('pendapatan')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Pendapatan',$Data);
  }

  public function Pengeluaran(){
    $Id = $this->session->userdata('Kegiatan');
    $Kegiatan = $this->db->query("SELECT * FROM `pendapatan` WHERE `Id`=".$Id)->row_array();
    $Data['NamaKegiatan'] = $Kegiatan['NamaKegiatan'];
    $Data['NominalKegiatan'] = $Kegiatan['NominalKegiatan'];
    $Data['Pengeluaran'] = $this->db->query("SELECT * FROM `pengeluaran` WHERE `DeleteAt` IS NULL AND `IdKegiatan`=".$Id." ORDER BY Tanggal DESC")->result_array();
    $Data['Charge'] = 30/100*$Data['NominalKegiatan'];
    $Data['Saving'] = 20/100*$Data['NominalKegiatan'];
    $Data['Umum'] = 5/100*$Data['NominalKegiatan'];
    $Data['Biaya'] = 0;
    foreach ($Data['Pengeluaran'] as $key) {
      $Data['Biaya'] += $key['NominalPengeluaran'];
    }
    $Data['Saldo'] = $Data['NominalKegiatan'] - ($Data['Charge']+$Data['Saving']+$Data['Biaya']);
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Pengeluaran',$Data);
  }

  public function SesiBiaya(){
    $this->session->set_userdata(array('Kegiatan' => $_POST['Kegiatan']));
    echo '1';
  }
}