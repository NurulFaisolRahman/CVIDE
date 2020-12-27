<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Desa')){
			redirect(base_url('IDE/Desa'));
		}
  } 

  public function index(){
    $this->load->view('Desa/Header');
		$this->load->view('Desa/Dashboard');
  }

  public function GantiPassword(){
    $this->db->where('Username', $this->session->userdata('KodeDesa'));
    $this->db->update('desa', array('Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT)));
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengganti Password!';
    }
  }

  public function IKM(){
    $Desa = $this->session->userdata('KodeDesa');
    $Data['Responden'] = 0;
    $Data['NilaiIndeks'] = 0;
    $Data['MutuPelayanan'] = '';
    $Data['KinerjaUnit'] = '';
    $RespondenDesa = $this->db->query("SELECT * FROM `ikm` WHERE Desa = "."'".$Desa."'")->result_array();
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
      $Data['Rata2'][$i] = round($Tampung[$i]/$Data['Responden'],2);
      $Data['Tertimbang'][$i] = round(($Tampung[$i]/$Data['Responden'])*(1/11),2);
      $Konversi[$i] = ($Tampung[$i]/$Data['Responden'])*(1/11)*25;
    }
    $Data['NilaiIndeks'] = round(array_sum($Konversi),2);
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
    $this->load->view('Desa/Header',$Data);
		$this->load->view('Desa/IKM',$Data);
  }

  public function BPD(){
    $Desa = $this->session->userdata('KodeDesa');
    $BPD = $this->db->query("SELECT * FROM `bpd` WHERE Desa = "."'".$Desa."'")->result_array();  
    $Poin = explode("|",$BPD[0]['Poin']);
    $JumlahIndikator = array(6,3,2,3,1);
    $Data['Average'] = array();
    $Data['Kinerja'] = array();
    $Loop = 0;
    for ($i=0; $i < 5; $i++) { 
      $Tampung = 0;
      for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
        $Tampung += $Poin[$Loop];
        $Loop++; 
      }
      array_push($Data['Average'],(round($Tampung/$JumlahIndikator[$i]*25,2)));
      if ($Data['Average'][$i] < 43.75) {
        array_push($Data['Kinerja'],'Tidak Baik');
      } else if ($Data['Average'][$i] < 62.5) {
        array_push($Data['Kinerja'],'Kurang Baik');
      } else if ($Data['Average'][$i] < 81.25) {
        array_push($Data['Kinerja'],'Baik');
      } else {
        array_push($Data['Kinerja'],'Sangat Baik');
      }
    }
    $Data['Hasil'] = round(array_sum($Data['Average'])/5,2);
    if ($Data['Hasil'] < 43.75) {
      array_push($Data['Kinerja'],'Tidak Baik');
    } else if ($Data['Hasil'] < 62.5) {
      array_push($Data['Kinerja'],'Kurang Baik');
    } else if ($Data['Hasil'] < 81.25) {
      array_push($Data['Kinerja'],'Baik');
    } else {
      array_push($Data['Kinerja'],'Sangat Baik');
    }
    $this->load->view('Desa/Header',$Data);
		$this->load->view('Desa/BPD',$Data);
  }

  public function KinerjaPemDes(){
    $Desa = $this->session->userdata('KodeDesa');
    $KinerjaPemDes = $this->db->query("SELECT * FROM `kinerjapemdes` WHERE Desa = "."'".$Desa."'")->result_array();  
    $Poin = explode("|",$KinerjaPemDes[0]['Poin']);
    $JumlahIndikator = array(7,11,13,6,3);
    $Data['Average'] = array();
    $Data['Kinerja'] = array();
    $Loop = 0;
    for ($i=0; $i < 5; $i++) { 
      $Tampung = 0;
      for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
        $Tampung += $Poin[$Loop];
        $Loop++; 
      }
      array_push($Data['Average'],(round($Tampung/$JumlahIndikator[$i]*25,2)));
      if ($Data['Average'][$i] < 43.75) {
        array_push($Data['Kinerja'],'Tidak Baik');
      } else if ($Data['Average'][$i] < 62.5) {
        array_push($Data['Kinerja'],'Kurang Baik');
      } else if ($Data['Average'][$i] < 81.25) {
        array_push($Data['Kinerja'],'Baik');
      } else {
        array_push($Data['Kinerja'],'Sangat Baik');
      }
    }
    $Data['Hasil'] = round(array_sum($Data['Average'])/5,2);
    if ($Data['Hasil'] < 43.75) {
      array_push($Data['Kinerja'],'Tidak Baik');
    } else if ($Data['Hasil'] < 62.5) {
      array_push($Data['Kinerja'],'Kurang Baik');
    } else if ($Data['Hasil'] < 81.25) {
      array_push($Data['Kinerja'],'Baik');
    } else {
      array_push($Data['Kinerja'],'Sangat Baik');
    }
    $this->load->view('Desa/Header',$Data);
		$this->load->view('Desa/KinerjaPemDes',$Data);
  }

  public function KinerjaAparatur(){
    $Desa = $this->session->userdata('KodeDesa');
    $KinerjaAparatur = $this->db->query("SELECT * FROM `kinerjaaparatur` WHERE Desa = "."'".$Desa."'")->result_array(); 
    $Indikator = array('KepalaDesa','SekertarisDesa','TU','Keuangan','Perencanaan','Pemerintahan','Kesejahteraan','Pelayanan'); 
    $Data['Average'] = array();
    $Data['Kinerja'] = array();
    for ($i=0; $i < count($Indikator); $i++) { 
      $Poin = explode("|",$KinerjaAparatur[0][$Indikator[$i]]);
      $Kedisiplinan = ($Poin[0]+$Poin[1])/2*0.2;
      $Tampung = 0;
      for ($j=2; $j < count($Poin); $j++) { 
        $Tampung += $Poin[$j];
      }
      $Keterlaksanaan = $Tampung/(count($Poin)-2)*0.8;
      array_push($Data['Average'],(round(($Kedisiplinan+$Keterlaksanaan)*25,2)));
      if ($Data['Average'][$i] < 43.75) {
        array_push($Data['Kinerja'],'Tidak Baik');
      } else if ($Data['Average'][$i] < 62.5) {
        array_push($Data['Kinerja'],'Kurang Baik');
      } else if ($Data['Average'][$i] < 81.25) {
        array_push($Data['Kinerja'],'Baik');
      } else {
        array_push($Data['Kinerja'],'Sangat Baik');
      }
    }
    $Data['Hasil'] = round(array_sum($Data['Average'])/count($Indikator),2);
    if ($Data['Hasil'] < 43.75) {
      array_push($Data['Kinerja'],'Tidak Baik');
    } else if ($Data['Hasil'] < 62.5) {
      array_push($Data['Kinerja'],'Kurang Baik');
    } else if ($Data['Hasil'] < 81.25) {
      array_push($Data['Kinerja'],'Baik');
    } else {
      array_push($Data['Kinerja'],'Sangat Baik');
    }
    $this->load->view('Desa/Header',$Data);
		$this->load->view('Desa/KinerjaAparatur',$Data);
  }
  
}