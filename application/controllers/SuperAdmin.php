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
    $_SESSION['KodeDesa'] = $_POST['KodeDesa'];
    $_SESSION['KodeKecamatan'] = $_POST['KodeKecamatan'];
    $_SESSION['JenisData'] = $_POST['JenisData'];
    echo '1';
  }

  public function IKM(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Data['Responden'] = 0;
    $Data['NilaiIndeks'] = 0;
    $Data['MutuPelayanan'] = '';
    $Data['KinerjaUnit'] = '';
    $Responden = array();
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Responden = $this->db->query("SELECT * FROM `ikm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Responden = $this->db->query("SELECT * FROM `ikm` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Responden = $this->db->query("SELECT * FROM `ikm`")->result_array();
    }
    $Data['Responden'] = count($Responden);
    $Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
    $Data['Rata2'] = array(0,0,0,0,0,0,0,0,0,0,0);
    $Data['Tertimbang'] = array(0,0,0,0,0,0,0,0,0,0,0);
    $Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
    $Data['Pendidikan'] = array(0,0,0,0,0,0,0);
    $Data['Pekerjaan'] = array(0,0,0,0,0,0,0);
    $Data['Gender'] = array(0,0);
    $Pria = 0;
    $Wanita = 0;
    foreach ($Responden as $key) {
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
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/IKM',$Data);
  }

  public function BPD(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $BPD = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $BPD = $this->db->query("SELECT * FROM `bpd` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $BPD = $this->db->query("SELECT * FROM `bpd` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $BPD = $this->db->query("SELECT * FROM `bpd`")->result_array();
    }
    $Data['Average'] = array(0,0,0,0,0);
    $Data['Kinerja'] = array('','','','','','');
    $Data['Hasil'] = 0;
    $JumlahIndikator = array(6,3,2,3,1);
    foreach ($BPD as $key) {
      $Poin = explode("|",$key['Poin']);
      $Loop = 0;
      for ($i=0; $i < 5; $i++) { 
        $Tampung = 0;
        for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
          $Tampung += $Poin[$Loop];
          $Loop++; 
        }
        $Data['Average'][$i] += $Tampung;
      }
    }
    if (count($BPD) > 0) {
      for ($i=0; $i < 5; $i++) { 
        $Data['Average'][$i] = round(($Data['Average'][$i]/count($BPD))/$JumlahIndikator[$i]*25,2);
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
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $KinerjaPemDes = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $KinerjaPemDes = $this->db->query("SELECT * FROM `kinerjapemdes` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $KinerjaPemDes = $this->db->query("SELECT * FROM `kinerjapemdes` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $KinerjaPemDes = $this->db->query("SELECT * FROM `kinerjapemdes`")->result_array();
    }
    $Data['Average'] = array(0,0,0,0,0);
    $Data['Kinerja'] = array('','','','','','');
    $Data['Hasil'] = 0;
    $JumlahIndikator = array(7,11,13,6,3);
    foreach ($KinerjaPemDes as $key) {
      $Poin = explode("|",$key['Poin']);
      $Loop = 0;
      for ($i=0; $i < 5; $i++) { 
        $Tampung = 0;
        for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
          $Tampung += $Poin[$Loop];
          $Loop++; 
        }
        $Data['Average'][$i] += $Tampung;
      }
    }
    if (count($KinerjaPemDes) > 0) {
      for ($i=0; $i < 5; $i++) { 
        $Data['Average'][$i] = round(($Data['Average'][$i]/count($KinerjaPemDes))/$JumlahIndikator[$i]*25,2);
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
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $KinerjaAparatur = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $KinerjaAparatur = $this->db->query("SELECT * FROM `kinerjaaparatur` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $KinerjaAparatur = $this->db->query("SELECT * FROM `kinerjaaparatur` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $KinerjaAparatur = $this->db->query("SELECT * FROM `kinerjaaparatur`")->result_array();
    }
    $Indikator = array('KepalaDesa','SekertarisDesa','TU','Keuangan','Perencanaan','Pemerintahan','Kesejahteraan','Pelayanan'); 
    $Data['Average'] = array(0,0,0,0,0,0,0,0);
    $Data['Kinerja'] = array('','','','','','','','','');
    $Data['Hasil'] = 0;
    foreach ($KinerjaAparatur as $key) {
      for ($i=0; $i < count($Indikator); $i++) { 
        $Poin = explode("|",$key[$Indikator[$i]]);
        $Kedisiplinan = ($Poin[0]+$Poin[1])/2*0.2;
        $Tampung = 0;
        for ($j=2; $j < count($Poin); $j++) { 
          $Tampung += $Poin[$j];
        }
        $Keterlaksanaan = $Tampung/(count($Poin)-2)*0.8;
        $Data['Average'][$i] += ($Kedisiplinan+$Keterlaksanaan);
      }
    }
    if (count($KinerjaAparatur) > 0) {
      for ($i=0; $i < count($Indikator); $i++) { 
        $Data['Average'][$i] = round(($Data['Average'][$i]/count($KinerjaAparatur))*25,2);
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

  public function Pendidikan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Pendidikan = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Pendidikan = $this->db->query("SELECT PartisipasiSekolah,PendidikanTertinggi FROM `ipm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pendidikan = $this->db->query("SELECT PartisipasiSekolah,PendidikanTertinggi FROM `ipm` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pendidikan = $this->db->query("SELECT PartisipasiSekolah,PendidikanTertinggi FROM `ipm`")->result_array();
    }
    $Data['JenisPendidikan'] = array(0,0,0,0,0,0,0,0);
    $Data['Responden'] = 0;
    for ($i=0; $i < count($Pendidikan); $i++) { 
      $Pecah = explode("|",$Pendidikan[$i]['PartisipasiSekolah']);
      $Pisah = explode("|",$Pendidikan[$i]['PendidikanTertinggi']);
      $Data['Responden'] += count($Pisah);
      for ($j=0; $j < count($Pecah); $j++) { 
        if ($Pecah[$j] == 1) {
          $Data['JenisPendidikan'][0] += 1;
        } else {
          if ($Pisah[$j] < 4) {
            $Data['JenisPendidikan'][1] += 1;
          } else if ($Pisah[$j] < 7) {
            $Data['JenisPendidikan'][2] += 1;
          } else if ($Pisah[$j] < 11) {
            $Data['JenisPendidikan'][3] += 1;
          } else if ($Pisah[$j] < 13) {
            $Data['JenisPendidikan'][4] += 1;
          } else if ($Pisah[$j] == 13) {
            $Data['JenisPendidikan'][5] += 1;
          } else if ($Pisah[$j] == 14) {
            $Data['JenisPendidikan'][6] += 1;
          } else if ($Pisah[$j] == 15) {
            $Data['JenisPendidikan'][7] += 1;
          } 
        } 
      }
    }
    $Data['Pendidikan'] = array(0,0,0,0,0,0,0,0);
    if ($Data['Responden'] > 0) {
      for ($i=0; $i < count($Data['JenisPendidikan']); $i++) { 
        $Data['Pendidikan'][$i] = number_format($Data['JenisPendidikan'][$i]/$Data['Responden']*100,1);
      }
    }
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Pendidikan',$Data);
  }

  public function GarisKemiskinan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $DataKomoditas = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Nilai FROM `ipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Nilai FROM `ipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Nilai FROM `ipm`")->result_array();
    }
    $Data['JumlahKK'] = count($DataKomoditas); $Data['GK'] = $Data['GKM'] = $Data['GKNM'] = $Data['Individu'] = array(); 
    $Data['GKRata2'] = $Data['GKMRata2'] = $Data['GKNMRata2'] = 0; $Data['KelompokGK'] = array(0,0);
    $Data['TotalIndividu'] = $Data['TotalPengeluaranMakanan'] = $Data['TotalPengeluaranNonMakanan'] = 0;
    foreach ($DataKomoditas as $key) {
      $TotalIndividuKeluarga = count(explode("|",$key['NamaAnggota']));
      $Data['TotalIndividu'] += $TotalIndividuKeluarga;
      $Nilai = explode("|",$key['Nilai']);
      $TotalPengeluaranMakanan = $TotalPengeluaranNonMakanan = 0;
      for ($i=0; $i < count($Nilai); $i++) { 
        if ($i < 107) {
          if ($i > 4 && $i < 19) {
            $TotalPengeluaranMakanan += (int)$Nilai[$i]*3;
          } 
          else if ($i > 41 && $i < 62) {
            $TotalPengeluaranMakanan += (int)$Nilai[$i];
          }
          else {
            $TotalPengeluaranMakanan += (int)$Nilai[$i]*4;
          }
        }
        else if (in_array($i,array(113,114,115,118,121,141))) {
          $TotalPengeluaranNonMakanan += (int)$Nilai[$i]*4;
        }  
        else if (in_array($i,array(116,119,120,136,138,140,148))) {
          $TotalPengeluaranNonMakanan += round((int)$Nilai[$i]/6);
        } 
        else if (in_array($i,array(108,109,110,122,123,126,127,128,129,130,131,132,133,134,135,137,139,144,145,146,147,149,150,151,152))){
          $TotalPengeluaranNonMakanan += round((int)$Nilai[$i]/12);
        }
        else {
          $TotalPengeluaranNonMakanan += (int)$Nilai[$i];
        }
      }
      array_push($Data['Individu'],$TotalIndividuKeluarga);
      array_push($Data['GKM'],($TotalPengeluaranMakanan/$TotalIndividuKeluarga));
      array_push($Data['GKNM'],($TotalPengeluaranNonMakanan/$TotalIndividuKeluarga));
      $Data['TotalPengeluaranMakanan'] += $TotalPengeluaranMakanan;
      $Data['TotalPengeluaranNonMakanan'] += $TotalPengeluaranNonMakanan;
    }
    if (count($DataKomoditas) > 0) {
      $Data['GKMRata2'] = $Data['TotalPengeluaranMakanan']/$Data['TotalIndividu']; 
      $Data['GKNMRata2'] = $Data['TotalPengeluaranNonMakanan']/$Data['TotalIndividu']; 
      $Data['GKRata2'] = $Data['GKMRata2']+$Data['GKNMRata2']; 
      for ($i=0; $i < count($Data['GKM']); $i++) { 
        if (($Data['GKM'][$i]+$Data['GKNM'][$i]) > $Data['GKRata2']) {
          $Data['KelompokGK'][0] += $Data['Individu'][$i];
        } else {
          $Data['KelompokGK'][1] += $Data['Individu'][$i];
        }
      }
    }
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/GarisKemiskinan',$Data);
  }
  
  public function Pengangguran(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Pengangguran = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Pengangguran = $this->db->query("SELECT Usia,KegiatanSeminggu,PenyebabMenganggur FROM `ipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pengangguran = $this->db->query("SELECT Usia,KegiatanSeminggu,PenyebabMenganggur FROM `ipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pengangguran = $this->db->query("SELECT Usia,KegiatanSeminggu,PenyebabMenganggur FROM `ipm`")->result_array();
    }
    $Data['Dewasa'] = $Data['Terbuka'] = $Data['Bekerja'] = $Data['TidakBekerja'] = $Data['AngkatanKerja'] = 0;
    $Data['AngkatanKerja'] = $Data['Pengangguran'] = $Data['PartisipasiAngkatanKerja'] = $Data['TPT'] = 0;
    foreach ($Pengangguran as $key) {
      $Usia = explode("|",$key['Usia']);
      $KegiatanSeminggu = explode("|",$key['KegiatanSeminggu']);
      $PenyebabMenganggur = explode("|",$key['PenyebabMenganggur']);
      for ($i=0; $i < count($Usia); $i++) { 
        if ($Usia[$i] > 15 && $Usia[$i] < 66) {
          if (isset($Usia[$i]) && isset($KegiatanSeminggu[$i])) {
            if ($KegiatanSeminggu[$i] == 1 || $KegiatanSeminggu[$i] == 5) {
              $Data['TidakBekerja'] += 1;
              $Data['Dewasa'] += 1;
              if ($KegiatanSeminggu[$i] == 1 && ($PenyebabMenganggur[$i] == 2 || $PenyebabMenganggur[$i] == 3)) {
                $Data['Terbuka'] += 1;
              } else {
                $Data['Terbuka'] += 1;
              }
            } else if ($KegiatanSeminggu[$i] == 2){
              $Data['Bekerja'] += 1;
              $Data['Dewasa'] += 1;
            } else {
              $Data['Dewasa'] += 1;
            }
          }
        }
      }
    }
    if (count($Pengangguran) > 0) {
      $Data['AngkatanKerja'] = $Data['Bekerja']+$Data['TidakBekerja'];
      $Data['Pengangguran'] = $Data['TidakBekerja']/($Data['Bekerja']+$Data['TidakBekerja'])*100;
      $Data['PartisipasiAngkatanKerja'] = ($Data['Bekerja']+$Data['TidakBekerja'])/$Data['Dewasa']*100;
      $Data['TPT'] = $Data['Terbuka']/($Data['Bekerja']+$Data['TidakBekerja'])*100;
    }
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Pengangguran',$Data);
  }

  public function ExcelALHAMH($FormatData){
    $Pisah = explode("-",$FormatData);
    $ALHAMH = array(); $Data['NamaFile'] = ""; 
    if ($Pisah[0] == 'Desa') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `ipm` WHERE Desa="."'".$Pisah[1]."'")->result_array();
      $Data['NamaFile'] = "Kecamatan".$Pisah[4]."Desa".$Pisah[2];
    } else if ($Pisah[0] == 'Kecamatan') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `ipm` WHERE Kecamatan="."'".$Pisah[3]."'")->result_array();
      $Data['NamaFile'] = "Kecamatan".$Pisah[4];
    } else {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `ipm`")->result_array();
      $Data['NamaFile'] = "Banyuwangi";
    }
    $Data['ALHAMH'] = array();
    $Rentang1 = array(0,0,0,0,0,0);
    $Rentang2 = array(0,0,0,0,0,0);
    $Rentang3 = array(0,0,0,0,0,0);
    $Rentang4 = array(0,0,0,0,0,0);
    $Rentang5 = array(0,0,0,0,0,0);
    $Rentang6 = array(0,0,0,0,0,0);
    $Rentang7 = array(0,0,0,0,0,0);
    for ($i=0; $i < count($ALHAMH); $i++) { 
      $UsiaIbu = explode("|",$ALHAMH[$i]['Pernikahan']);
      $JumlahAnak = explode("$",$ALHAMH[$i]['Fertilitas']);
      if ($ALHAMH[$i]['Fertilitas'] == "") {
        $JumlahAnak = array();
      }
      if (is_numeric($UsiaIbu[0]) && is_numeric($UsiaIbu[1])) { 
        $Cek1 = true;$Cek2 = true;$Cek3 = true;$Cek4 = true;$Cek5 = true;$Cek6 = true;$Cek7 = true;
        for ($j=0; $j < count($JumlahAnak); $j++) { 
          $PisahAnak = explode("|",$JumlahAnak[$j]);
          if (is_numeric($PisahAnak[3])) {
            if ($PisahAnak[3] < ($UsiaIbu[0]+$UsiaIbu[1])) {
              if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) > 14 && (($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 20) {
                if ($Cek1) {$Rentang1[3] += 1;$Cek1 = false;}
                $Rentang1[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang1[2] += 1 : $Rentang1[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 25) {
                if ($Cek2) {$Rentang2[3] += 1;$Cek2 = false;}
                $Rentang2[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang2[2] += 1 : $Rentang2[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 30) {
                if ($Cek3) {$Rentang3[3] += 1;$Cek3 = false;}
                $Rentang3[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang3[2] += 1 : $Rentang3[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 35) {
                if ($Cek4) {$Rentang4[3] += 1;$Cek4 = false;}
                $Rentang4[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang4[2] += 1 : $Rentang4[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 40) {
                if ($Cek5) {$Rentang5[3] += 1;$Cek5 = false;}
                $Rentang5[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang5[2] += 1 : $Rentang5[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 45) {
                if ($Cek6) {$Rentang6[3] += 1;$Cek6 = false;}
                $Rentang6[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang6[2] += 1 : $Rentang6[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 50) {
                if ($Cek7) {$Rentang7[3] += 1;$Cek7 = false;}
                $Rentang7[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang7[2] += 1 : $Rentang7[1] += 1;
              }
            }
          }
        }
      }
    }
    if ($Rentang1[3] > 0) {
      $Rentang1[4] = number_format($Rentang1[0]/$Rentang1[3],2);
      $Rentang1[5] = number_format($Rentang1[2]/$Rentang1[3],2);
    }
    if ($Rentang2[3] > 0) {
      $Rentang2[4] = number_format($Rentang2[0]/$Rentang2[3],2);
      $Rentang2[5] = number_format($Rentang2[2]/$Rentang2[3],2);
    }
    if ($Rentang3[3] > 0) {
      $Rentang3[4] = number_format($Rentang3[0]/$Rentang3[3],2);
      $Rentang3[5] = number_format($Rentang3[2]/$Rentang3[3],2);
    }
    if ($Rentang4[3] > 0) {
      $Rentang4[4] = number_format($Rentang4[0]/$Rentang4[3],2);
      $Rentang4[5] = number_format($Rentang4[2]/$Rentang4[3],2);
    }
    if ($Rentang5[3] > 0) {
      $Rentang5[4] = number_format($Rentang5[0]/$Rentang5[3],2);
      $Rentang5[5] = number_format($Rentang5[2]/$Rentang5[3],2);
    }
    if ($Rentang6[3] > 0) {
      $Rentang6[4] = number_format($Rentang6[0]/$Rentang6[3],2);
      $Rentang6[5] = number_format($Rentang6[2]/$Rentang6[3],2);
    }
    if ($Rentang7[3] > 0) {
      $Rentang7[4] = number_format($Rentang7[0]/$Rentang7[3],2);
      $Rentang7[5] = number_format($Rentang7[2]/$Rentang7[3],2);
    }
    $Data['ALHAMH'][0] = $Rentang1;
    $Data['ALHAMH'][1] = $Rentang2;
    $Data['ALHAMH'][2] = $Rentang3;
    $Data['ALHAMH'][3] = $Rentang4;
    $Data['ALHAMH'][4] = $Rentang5;
    $Data['ALHAMH'][5] = $Rentang6;
    $Data['ALHAMH'][6] = $Rentang7;
    $Data['TotalIbu'] = $Rentang1[3]+$Rentang2[3]+$Rentang3[3]+$Rentang4[3]+$Rentang5[3]+$Rentang6[3]+$Rentang7[3];
    $this->load->view('SuperAdmin/ExcelALHAMH',$Data);
  }

  public function IPMKesehatan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $ALHAMH = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `ipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `ipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `ipm`")->result_array();
    }
    $Data['ALHAMH'] = array();
    $Rentang1 = array(0,0,0,0,0,0);
    $Rentang2 = array(0,0,0,0,0,0);
    $Rentang3 = array(0,0,0,0,0,0);
    $Rentang4 = array(0,0,0,0,0,0);
    $Rentang5 = array(0,0,0,0,0,0);
    $Rentang6 = array(0,0,0,0,0,0);
    $Rentang7 = array(0,0,0,0,0,0);
    for ($i=0; $i < count($ALHAMH); $i++) { 
      $UsiaIbu = explode("|",$ALHAMH[$i]['Pernikahan']);
      $JumlahAnak = explode("$",$ALHAMH[$i]['Fertilitas']);
      if ($ALHAMH[$i]['Fertilitas'] == "") {
        $JumlahAnak = array();
      }
      if (is_numeric($UsiaIbu[0]) && is_numeric($UsiaIbu[1])) { 
        $Cek1 = true;$Cek2 = true;$Cek3 = true;$Cek4 = true;$Cek5 = true;$Cek6 = true;$Cek7 = true;
        for ($j=0; $j < count($JumlahAnak); $j++) { 
          $PisahAnak = explode("|",$JumlahAnak[$j]);
          if (is_numeric($PisahAnak[3])) {
            if ($PisahAnak[3] < ($UsiaIbu[0]+$UsiaIbu[1])) {
              if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) > 14 && (($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 20) {
                if ($Cek1) {$Rentang1[3] += 1;$Cek1 = false;}
                $Rentang1[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang1[2] += 1 : $Rentang1[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 25) {
                if ($Cek2) {$Rentang2[3] += 1;$Cek2 = false;}
                $Rentang2[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang2[2] += 1 : $Rentang2[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 30) {
                if ($Cek3) {$Rentang3[3] += 1;$Cek3 = false;}
                $Rentang3[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang3[2] += 1 : $Rentang3[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 35) {
                if ($Cek4) {$Rentang4[3] += 1;$Cek4 = false;}
                $Rentang4[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang4[2] += 1 : $Rentang4[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 40) {
                if ($Cek5) {$Rentang5[3] += 1;$Cek5 = false;}
                $Rentang5[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang5[2] += 1 : $Rentang5[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 45) {
                if ($Cek6) {$Rentang6[3] += 1;$Cek6 = false;}
                $Rentang6[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang6[2] += 1 : $Rentang6[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 50) {
                if ($Cek7) {$Rentang7[3] += 1;$Cek7 = false;}
                $Rentang7[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang7[2] += 1 : $Rentang7[1] += 1;
              }
            }
          }
        }
      }
    }
    if ($Rentang1[3] > 0) {
      $Rentang1[4] = number_format($Rentang1[0]/$Rentang1[3],2);
      $Rentang1[5] = number_format($Rentang1[2]/$Rentang1[3],2);
    }
    if ($Rentang2[3] > 0) {
      $Rentang2[4] = number_format($Rentang2[0]/$Rentang2[3],2);
      $Rentang2[5] = number_format($Rentang2[2]/$Rentang2[3],2);
    }
    if ($Rentang3[3] > 0) {
      $Rentang3[4] = number_format($Rentang3[0]/$Rentang3[3],2);
      $Rentang3[5] = number_format($Rentang3[2]/$Rentang3[3],2);
    }
    if ($Rentang4[3] > 0) {
      $Rentang4[4] = number_format($Rentang4[0]/$Rentang4[3],2);
      $Rentang4[5] = number_format($Rentang4[2]/$Rentang4[3],2);
    }
    if ($Rentang5[3] > 0) {
      $Rentang5[4] = number_format($Rentang5[0]/$Rentang5[3],2);
      $Rentang5[5] = number_format($Rentang5[2]/$Rentang5[3],2);
    }
    if ($Rentang6[3] > 0) {
      $Rentang6[4] = number_format($Rentang6[0]/$Rentang6[3],2);
      $Rentang6[5] = number_format($Rentang6[2]/$Rentang6[3],2);
    }
    if ($Rentang7[3] > 0) {
      $Rentang7[4] = number_format($Rentang7[0]/$Rentang7[3],2);
      $Rentang7[5] = number_format($Rentang7[2]/$Rentang7[3],2);
    }
    $Data['ALHAMH'][0] = $Rentang1;
    $Data['ALHAMH'][1] = $Rentang2;
    $Data['ALHAMH'][2] = $Rentang3;
    $Data['ALHAMH'][3] = $Rentang4;
    $Data['ALHAMH'][4] = $Rentang5;
    $Data['ALHAMH'][5] = $Rentang6;
    $Data['ALHAMH'][6] = $Rentang7;
    $Data['TotalIbu'] = $Rentang1[3]+$Rentang2[3]+$Rentang3[3]+$Rentang4[3]+$Rentang5[3]+$Rentang6[3]+$Rentang7[3];
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/IPMKesehatan',$Data);
  }

  public function IPMPendidikan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Pendidikan = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Pendidikan = $this->db->query("SELECT Usia,Fertilitas,PartisipasiSekolah,PendidikanTertinggi,StatusSekolah,KeluhanPendidikan FROM `ipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pendidikan = $this->db->query("SELECT Usia,Fertilitas,PartisipasiSekolah,PendidikanTertinggi,StatusSekolah,KeluhanPendidikan FROM `ipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pendidikan = $this->db->query("SELECT Usia,Fertilitas,PartisipasiSekolah,PendidikanTertinggi,StatusSekolah,KeluhanPendidikan FROM `ipm`")->result_array();
    }
    $KelompokHLS = array(array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0));
    $LamaSekolah = $Penduduk25 = $PendudukSekolah = $Penduduk7 = $Santri = 0;
    $Data['IPMPendidikan'] = array();
    $Data['IPMPendidikan']['RLS'] = 0;
    $Data['IPMPendidikan']['HLS'] = 0;
    $Data['IPMPendidikan']['IRLS'] = 0;
    $Data['IPMPendidikan']['IHLS'] = 0;
    $Data['IPMPendidikan']['IPendidikan'] = 0;
    if (!empty($Pendidikan[0]['Usia'])) {
      foreach ($Pendidikan as $key) {
        $Partisipasi = explode("|",$key['PartisipasiSekolah']);
        $Jenjang = explode("|",$key['PendidikanTertinggi']);
        $Tingkat = explode("|",$key['StatusSekolah']);
        $Usia = explode("|",$key['Usia']);
        if ($key['KeluhanPendidikan'][0] == 1) {
          $Santri += 1;  
        }
        for ($i=0; $i < count($Partisipasi); $i++) { 
          if (count($Partisipasi) == count($Usia)) {
            if ($Usia[$i] > 6) {
              $Penduduk7 += 1;
              if ($Usia[$i] == 7) {
                $KelompokHLS[0][0] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][0] += 1;
                }
              } else if ($Usia[$i] == 8) {
                $KelompokHLS[0][1] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][1] += 1;
                }
              } else if ($Usia[$i] == 9) {
                $KelompokHLS[0][2] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][2] += 1;
                }
              } else if ($Usia[$i] == 10) {
                $KelompokHLS[0][3] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][3] += 1;
                }
              } else if ($Usia[$i] == 11) {
                $KelompokHLS[0][4] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][4] += 1;
                }
              } else if ($Usia[$i] == 12) {
                $KelompokHLS[0][5] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][5] += 1;
                }
              } else if ($Usia[$i] == 13) {
                $KelompokHLS[0][6] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][6] += 1;
                }
              } else if ($Usia[$i] == 14) {
                $KelompokHLS[0][7] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][7] += 1;
                }
              } else if ($Usia[$i] == 15) {
                $KelompokHLS[0][8] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][8] += 1;
                }
              } else if ($Usia[$i] == 16) {
                $KelompokHLS[0][9] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][9] += 1;
                }
              } else if ($Usia[$i] == 17) {
                $KelompokHLS[0][10] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][10] += 1;
                }
              } else if ($Usia[$i] == 18) {
                $KelompokHLS[0][11] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][11] += 1;
                }
              } else if ($Usia[$i] == 19) {
                $KelompokHLS[0][12] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][12] += 1;
                }
              } else if ($Usia[$i] == 20) {
                $KelompokHLS[0][13] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][13] += 1;
                }
              } else if ($Usia[$i] == 21) {
                $KelompokHLS[0][14] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][14] += 1;
                }
              } else if ($Usia[$i] == 22) {
                $KelompokHLS[0][15] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][15] += 1;
                }
              } else if ($Usia[$i] == 23) {
                $KelompokHLS[0][16] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][16] += 1;
                }
              } else if ($Usia[$i] == 24) {
                $KelompokHLS[0][17] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][17] += 1;
                }
              } else if ($Usia[$i] == 25) {
                $KelompokHLS[0][18] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][18] += 1;
                }
              }
            }
            if ($Usia[$i] > 24) {
              $PendudukSekolah += 1;
              if ($Partisipasi[$i] == 1) {
                $Penduduk25 += 1;
              } else if ($Jenjang[$i] < 4) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 6; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += ($Tingkat[$i]-1); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] < 7) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 9; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (5+$Tingkat[$i]); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] < 11) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 12; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (8+$Tingkat[$i]); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] == 11) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 14; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (11+$Tingkat[$i]); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] == 12) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 15; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (11+$Tingkat[$i]); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] == 13) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 16; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (11+$Tingkat[$i]); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] == 14 || $Jenjang[$i] == 15) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 18; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (15+$Tingkat[$i]); $Penduduk25 += 1;
                }
              }
            }
          }
        }
      }
      if ($Penduduk25 > 0) {
        $Data['IPMPendidikan']['RLS'] = number_format(($LamaSekolah/$Penduduk25),2);
        $FK = number_format(($Santri/$Penduduk7)+1,2);
        $Sigma = 0;
        for ($i=0; $i < 19; $i++) { 
          if ($KelompokHLS[0][$i] > 0) {
            $Sigma += (number_format($KelompokHLS[1][$i]/$KelompokHLS[0][$i],2));
          }
        }
        $Data['IPMPendidikan']['HLS'] = number_format(($FK*$Sigma),2);
        $Data['IPMPendidikan']['IHLS'] = number_format($Data['IPMPendidikan']['HLS']/18,2);
        $Data['IPMPendidikan']['IRLS'] = number_format($Data['IPMPendidikan']['RLS']/15,2);
        $Data['IPMPendidikan']['IPendidikan'] = number_format(($Data['IPMPendidikan']['IRLS']+$Data['IPMPendidikan']['IHLS'])/2,2);
      }
    }
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/IPMPendidikan',$Data);
  }

  public function IPMPengeluaran(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $DataKomoditas = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Banyaknya,Harga,Nilai FROM `ipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Banyaknya,Harga,Nilai FROM `ipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Banyaknya,Harga,Nilai FROM `ipm`")->result_array();
    }
    $Data['PerKapita'] = $Data['PerKapitaKonstan'] = 0; 
    $Rata2KomoditasTerpilih = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $Rata2KomoditasTerpilihJakarta = array();
    $PangkatKomoditas = 0.010416;
    $TotalPengeluaran = $TotalIndividu = 0;
    foreach ($DataKomoditas as $key) {
      $TotalIndividu += count(explode("|",$key['NamaAnggota']));
      $Nilai = explode("|",$key['Nilai']);
      for ($i=0; $i < count($Nilai); $i++) { 
        if (in_array($i,array(5,6,7,8,9,10,11,12,13,14,16))) {
          $TotalPengeluaran += (Int)$Nilai[$i]*3*12;
        } else if (in_array($i,array(0,2,3,4,19,20,21,23,24,25,36,37,38,39,40,41,62,63,64,66,68,69,71,72,76,79,84,85,86,87,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,113,114,115,118,121,141))) {
          $TotalPengeluaran += (Int)$Nilai[$i]*52;
        } else if (in_array($i,array(42,43,49,51,52,53,54,107,111,112,142,143))) {
          $TotalPengeluaran += (Int)$Nilai[$i]*12;
        } else if (in_array($i,array(119,120,136,148))) {
          $TotalPengeluaran += (Int)$Nilai[$i]*2;
        } else if (in_array($i,array(108,109,110,127,128,129,130,144,145,146,147,149,150,151,152))) {
          $TotalPengeluaran += (Int)$Nilai[$i];
        }
      }
    }
    if (count($DataKomoditas) > 0) {
      $Data['PerKapita'] = $TotalPengeluaran/$TotalIndividu/1000; 
      $Data['PerKapitaKonstan'] = $Data['PerKapita']/103.59*100.0; 
    }
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/IPMPengeluaran',$Data);
  }
}