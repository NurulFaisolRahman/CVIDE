<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('SuperAdmin')){
			redirect(base_url('IDE/SuperAdmin'));
		}
  } 

  public function index(){
    $this->load->view('SuperAdmin/Header');
		$this->load->view('SuperAdmin/Dashboard');
  }

  public function GantiPassword(){
    $this->db->where('Username', $this->session->userdata('Username'));
    $this->db->update('superadmin', array('Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT)));
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengganti Password!';
    }
  }

  public function Session(){
    $_SESSION['NamaDesa'] = $_POST['NamaDesa'];
    $_SESSION['KodeDesa'] = $_POST['KodeDesa'];
    $_SESSION['KodeKecamatan'] = $_POST['KodeKecamatan'];
    echo '1';
  }

  public function IKM(){
    $Data['NamaDesa'] = $this->session->userdata('NamaDesa');
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan'); 
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Data['Responden'] = 0;
    $Data['NilaiIndeks'] = 0;
    $Data['MutuPelayanan'] = '';
    $Data['KinerjaUnit'] = '';
    $RespondenDesa = $this->db->query("SELECT * FROM `ikm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    $Data['Responden'] = count($RespondenDesa);
    $Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
    $Data['Rata2'] = array(0,0,0,0,0,0,0,0,0,0,0);
    $Data['Tertimbang'] = array(0,0,0,0,0,0,0,0,0,0,0);
    $Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
    $Data['Pendidikan'] = array(0,0,0,0,0,0,0);
    $Data['Pekerjaan'] = array(0,0,0,0,0,0,0);
    $Data['Gender'] = array(0,0);
    $Pria = 0;
    $Wanita = 0;
    foreach ($RespondenDesa as $key) {
      $Pecah = explode("|",$key['Poin']);
      for ($i=0; $i < 11; $i++) { 
        $Tampung[$i] += $Pecah[$i];
      }
      $key['Gender'] == 1 ? $Pria++ : $Wanita++;
      if ($key['Pendidikan'] == 0) {
        $Data['Pendidikan'][0] += 1;
      } else if ($key['Pendidikan'] == 1) {
        $Data['Pendidikan'][1] += 1;
      } else if ($key['Pendidikan'] == 2) {
        $Data['Pendidikan'][2] += 1;
      } else if ($key['Pendidikan'] == 3) {
        $Data['Pendidikan'][3] += 1;
      } else if ($key['Pendidikan'] == 4) {
        $Data['Pendidikan'][4] += 1;
      } else if ($key['Pendidikan'] == 5) {
        $Data['Pendidikan'][5] += 1;
      } else if ($key['Pendidikan'] == 6) {
        $Data['Pendidikan'][6] += 1;
      } 
      if ($key['Pekerjaan'] == 0) {
        $Data['Pekerjaan'][0] += 1;
      } else if ($key['Pekerjaan'] == 1) {
        $Data['Pekerjaan'][1] += 1;
      } else if ($key['Pekerjaan'] == 2) {
        $Data['Pekerjaan'][2] += 1;
      } else if ($key['Pekerjaan'] == 3) {
        $Data['Pekerjaan'][3] += 1;
      } else if ($key['Pekerjaan'] == 4) {
        $Data['Pekerjaan'][4] += 1;
      } else if ($key['Pekerjaan'] == 5) {
        $Data['Pekerjaan'][5] += 1;
      } else {
        $Data['Pekerjaan'][6] += 1;
      } 
    }
    if ($Data['Responden'] < 356) {
      for ($k=0; $k < 11; $k++) { 
        $Tampung[$k] += (3*(356-$Data['Responden']));
      }
      $Data['Responden'] = 356;
    }
    $Data['Gender'][0] = $Pria;
    $Data['Gender'][1] = $Wanita;
    for ($i=0; $i < 11; $i++) { 
      $Data['Rata2'][$i] = str_replace(".",",",round($Tampung[$i]/$Data['Responden'],2));
      $Data['Tertimbang'][$i] = str_replace(".",",",round(($Tampung[$i]/$Data['Responden'])*(1/11),2));
      $Konversi[$i] = ($Tampung[$i]/$Data['Responden'])*(1/11)*25;
    }
    $Data['NilaiIndeks'] = str_replace(".",",",round(array_sum($Konversi),2));
    if ($Data['NilaiIndeks'] < 65) {
      $Data['MutuPelayanan'] = 'D';
      $Data['KinerjaUnit'] = 'Tidak Baik';
    } else if ($Data['NilaiIndeks'] < 76.61) {
      $Data['MutuPelayanan'] = 'C';
      $Data['KinerjaUnit'] = 'Kurang Baik';
    } else if ($Data['NilaiIndeks'] < 88.31) {
      $Data['MutuPelayanan'] = 'B';
      $Data['KinerjaUnit'] = 'Baik';
    } else {
      $Data['MutuPelayanan'] = 'A';
      $Data['KinerjaUnit'] = 'Sangat Baik';
    } 
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/IKM',$Data);
  }

  public function BPD(){
    $Data['NamaDesa'] = $this->session->userdata('NamaDesa');
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan'); 
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $BPD = $this->db->query("SELECT * FROM `bpd` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();  
    $Data['Average'] = array(0,0,0,0,0);
    $Data['Kinerja'] = array('','','','','','');
    $Data['Hasil'] = 0;
    if (count($BPD) == 1) {
      $Poin = explode("|",$BPD[0]['Poin']);
      $JumlahIndikator = array(6,3,2,3,1);
      $Loop = 0;
      for ($i=0; $i < 5; $i++) { 
        $Tampung = 0;
        for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
          $Tampung += $Poin[$Loop];
          $Loop++; 
        }
        $Data['Average'][$i] = (round($Tampung/$JumlahIndikator[$i]*25,2));
        if ($Data['Average'][$i] < 43.75) {
          $Data['Kinerja'][$i] = 'Tidak Baik';
        } else if ($Data['Average'][$i] < 62.5) {
          $Data['Kinerja'][$i] = 'Kurang Baik';
        } else if ($Data['Average'][$i] < 81.25) {
          $Data['Kinerja'][$i] = 'Baik';
        } else {
          $Data['Kinerja'][$i] = 'Sangat Baik';
        }
      }
      $Data['Hasil'] = round(array_sum($Data['Average'])/5,2);
      if ($Data['Hasil'] < 43.75) {
        $Data['Kinerja'][5] = 'Tidak Baik';
      } else if ($Data['Hasil'] < 62.5) {
        $Data['Kinerja'][5] = 'Kurang Baik';
      } else if ($Data['Hasil'] < 81.25) {
        $Data['Kinerja'][5] = 'Baik';
      } else {
        $Data['Kinerja'][5] = 'Sangat Baik';
      }
    }
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/BPD',$Data);
  }

  public function KinerjaPemDes(){
    $Data['NamaDesa'] = $this->session->userdata('NamaDesa');
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan'); 
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $KinerjaPemDes = $this->db->query("SELECT * FROM `kinerjapemdes` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();  
    $Data['Average'] = array(0,0,0,0,0);
    $Data['Kinerja'] = array('','','','','','');
    $Data['Hasil'] = 0;
    if (count($KinerjaPemDes) == 1) {
      $Poin = explode("|",$KinerjaPemDes[0]['Poin']);
      $JumlahIndikator = array(7,11,13,6,3);
      $Loop = 0;
      for ($i=0; $i < 5; $i++) { 
        $Tampung = 0;
        for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
          $Tampung += $Poin[$Loop];
          $Loop++; 
        }
        $Data['Average'][$i] = (round($Tampung/$JumlahIndikator[$i]*25,2));
        if ($Data['Average'][$i] < 43.75) {
          $Data['Kinerja'][$i] = 'Tidak Baik';
        } else if ($Data['Average'][$i] < 62.5) {
          $Data['Kinerja'][$i] = 'Kurang Baik';
        } else if ($Data['Average'][$i] < 81.25) {
          $Data['Kinerja'][$i] = 'Baik';
        } else {
          $Data['Kinerja'][$i] = 'Sangat Baik';
        }
      }
      $Data['Hasil'] = round(array_sum($Data['Average'])/5,2);
      if ($Data['Hasil'] < 43.75) {
        $Data['Kinerja'][5] = 'Tidak Baik';
      } else if ($Data['Hasil'] < 62.5) {
        $Data['Kinerja'][5] = 'Kurang Baik';
      } else if ($Data['Hasil'] < 81.25) {
        $Data['Kinerja'][5] = 'Baik';
      } else {
        $Data['Kinerja'][5] = 'Sangat Baik';
      }
    }
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/KinerjaPemDes',$Data);
  }

  public function KinerjaAparatur(){
    $Data['NamaDesa'] = $this->session->userdata('NamaDesa');
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan'); 
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $KinerjaAparatur = $this->db->query("SELECT * FROM `kinerjaaparatur` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array(); 
    $Indikator = array('KepalaDesa','SekertarisDesa','TU','Keuangan','Perencanaan','Pemerintahan','Kesejahteraan','Pelayanan'); 
    $Data['Average'] = array(0,0,0,0,0,0,0,0);
    $Data['Kinerja'] = array('','','','','','','','','');
    $Data['Hasil'] = 0;
    if (count($KinerjaAparatur) == 1) {
      for ($i=0; $i < count($Indikator); $i++) { 
        $Poin = explode("|",$KinerjaAparatur[0][$Indikator[$i]]);
        $Kedisiplinan = ($Poin[0]+$Poin[1])/2*0.2;
        $Tampung = 0;
        for ($j=2; $j < count($Poin); $j++) { 
          $Tampung += $Poin[$j];
        }
        $Keterlaksanaan = $Tampung/(count($Poin)-2)*0.8;
        $Data['Average'][$i] = (round(($Kedisiplinan+$Keterlaksanaan)*25,2));
        if ($Data['Average'][$i] < 43.75) {
          $Data['Kinerja'][$i] = 'Tidak Baik';
        } else if ($Data['Average'][$i] < 62.5) {
          $Data['Kinerja'][$i] = 'Kurang Baik';
        } else if ($Data['Average'][$i] < 81.25) {
          $Data['Kinerja'][$i] = 'Baik';
        } else {
          $Data['Kinerja'][$i] = 'Sangat Baik';
        }
      }
      $Data['Hasil'] = round(array_sum($Data['Average'])/count($Indikator),2);
      if ($Data['Hasil'] < 43.75) {
        $Data['Kinerja'][8] = 'Tidak Baik';
      } else if ($Data['Hasil'] < 62.5) {
        $Data['Kinerja'][8] = 'Kurang Baik';
      } else if ($Data['Hasil'] < 81.25) {
        $Data['Kinerja'][8] = 'Baik';
      } else {
        $Data['Kinerja'][8] = 'Sangat Baik';
      }
    }
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/KinerjaAparatur',$Data);
  }
  
}