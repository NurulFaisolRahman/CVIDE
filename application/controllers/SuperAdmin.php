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
    $Umum = $this->db->query("SELECT * FROM `kas` WHERE Tanggal >= '".$From."' and Tanggal <= '".$To."' AND DeleteAt IS NULL ORDER BY Tanggal ASC,InputAt ASC")->result_array();
    $Biaya = $this->db->query("SELECT * FROM `pengeluaran` WHERE Tanggal >= '".$From."' and Tanggal <= '".$To."' AND DeleteAt IS NULL ORDER BY Tanggal ASC,InputAt DESC")->result_array();
    $Data['Kas'] = array_merge($Umum,$Biaya);
    array_multisort(array_column($Data['Kas'], 'Tanggal'), SORT_ASC, $Data['Kas']);
		$this->load->view('ExcelKas',$Data);
  }

  public function Project(){
    if ($this->db->field_exists('is_deleted', 'project')) {
      $this->db->where('(is_deleted = 0 OR is_deleted IS NULL)', NULL, FALSE);
    }
    $projects = $this->db->get('project')->result_array();
    
    // Sort dengan prioritas:
    // 1. Tahun / Timeline terbaru di atas (DESC)
    // 2. Status diutamakan: Sedang Dikerjakan/Proses (1) -> Belum Mulai (2) -> Selesai (3) -> Lainnya (4)
    // 3. ID Project terbaru (DESC)
    usort($projects, function($a, $b) {
      $getYear = function($item) {
        $dl = $item['Deadline'] ?? '';
        if (preg_match_all('/\b\d{4}\b/', $dl, $m)) {
          return max(array_map('intval', $m[0]));
        }
        return 0;
      };

      $getStatusPriority = function($item) {
        $st = strtolower(trim($item['Status'] ?? ''));
        if ($st === 'belum mulai' || empty($st)) {
          return 1; // Prioritas 1: Belum Mulai
        } else if ($st === 'sedang proses' || $st === 'sedang dikerjakan' || $st === 'sedang berjalan' || $st === 'proses') {
          return 2; // Prioritas 2: Sedang Dikerjakan / Sedang Proses
        } else if ($st === 'selesai') {
          return 3; // Prioritas 3: Selesai
        }
        return 4;
      };

      $yearA = $getYear($a);
      $yearB = $getYear($b);

      if ($yearA !== $yearB) {
        return $yearB <=> $yearA;
      }

      $statA = $getStatusPriority($a);
      $statB = $getStatusPriority($b);
      if ($statA !== $statB) {
        return $statA <=> $statB;
      }

      return ($b['Id'] ?? 0) <=> ($a['Id'] ?? 0);
    });

    $Data['Project'] = $projects;
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Project',$Data);
  }

  public function Matrikulasi(){
    $Data['Matrikulasi'] = $this->db->get('matrikulasi')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Matrikulasi',$Data);
  }

  public function SesiBiaya(){
    $this->session->set_userdata(array('Kegiatan' => $_POST['Kegiatan']));
    echo '1';
  }

  public function PengeluaranKegiatan(){
    $Data['Pendapatan'] = $this->db->get('pendapatan')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/PengeluaranKegiatan',$Data);
  }

  public function BiayaKegiatan(){
    $Id = $this->session->userdata('Kegiatan');
    $Kegiatan = $this->db->query("SELECT * FROM `pendapatan` WHERE `Id`=".$Id)->row_array();
    $Data['NamaKegiatan'] = $Kegiatan['NamaKegiatan'];
    $Data['NominalKegiatan'] = $Kegiatan['NominalKegiatan'];
    $Data['Pengeluaran'] = $this->db->query("SELECT * FROM `pengeluaran` WHERE `DeleteAt` IS NULL AND `IdKegiatan`=".$Id." ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    $Data['Charge'] = 30/100*$Data['NominalKegiatan'];
    $Data['Saving'] = 20/100*$Data['NominalKegiatan'];
    $Data['Umum'] = 5/100*$Data['NominalKegiatan'];
    $Data['Biaya'] = 0;
    foreach ($Data['Pengeluaran'] as $key) {
      $Data['Biaya'] += $key['NominalPengeluaran'];
    }
    $Data['Saldo'] = $Data['NominalKegiatan'] - ($Data['Charge']+$Data['Saving']+$Data['Biaya']);
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/BiayaKegiatan',$Data);
  }

  public function PendapatanKegiatan(){
    $Data['Pendapatan'] = $this->db->get('pendapatan')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/PendapatanKegiatan',$Data);
  }

  public function PendapatanKas(){
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'IN' ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/PendapatanKas',$Data);
  }

  public function PengeluaranUmum(){
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'OUT' ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/PengeluaranUmum',$Data);
  }

  public function JurnalUmum(){
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'OUT' ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/JurnalUmum',$Data);
  }

  public function JurnalKegiatan(){
    $Data['Biaya'] = $this->db->query("SELECT * FROM `pengeluaran` WHERE DeleteAt IS NULL ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    $Data['Kegiatan'] = $this->db->query("SELECT * FROM `pendapatan`")->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/JurnalKegiatan',$Data);
  }

  public function JurnalTotal(){
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
    $Umum = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    $Biaya = $this->db->query("SELECT * FROM `pengeluaran` WHERE DeleteAt IS NULL ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    $Data['Kas'] = array_merge($Umum,$Biaya);
    array_multisort(array_column($Data['Kas'], 'Tanggal'), SORT_DESC, $Data['Kas']);
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/JurnalTotal',$Data);
  }
}