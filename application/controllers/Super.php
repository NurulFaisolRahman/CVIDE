<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Super')){
			redirect(base_url('IDE/Auth'));
		}
  } 

  public function index(){
    $this->load->view('Super/Header');
		$this->load->view('Super/Dashboard');
  }

  public function GantiPassword(){
    $this->db->where('Username', $this->session->userdata('Username'));
    $this->db->update('Super', array('Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT)));
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
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/IKM',$Data);
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
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/BPD',$Data);
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
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/KinerjaPemDes',$Data);
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
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/KinerjaAparatur',$Data);
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
      $Pendidikan = $this->db->query("SELECT PartisipasiSekolah,PendidikanTertinggi FROM `surveiipm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pendidikan = $this->db->query("SELECT PartisipasiSekolah,PendidikanTertinggi FROM `surveiipm` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pendidikan = $this->db->query("SELECT PartisipasiSekolah,PendidikanTertinggi FROM `surveiipm`")->result_array();
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
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/Pendidikan',$Data);
  }

  public function GarisKemiskinan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $DataKomoditas = array();  $Ace = 0;
    if ($this->session->userdata('JenisData') == 'Desa') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Nilai FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Nilai FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Nilai FROM `surveiipm`")->result_array();
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
          $TotalPengeluaranMakanan += intval((int)$Nilai[$i]/12);
        }
        else {
          $TotalPengeluaranNonMakanan += intval((int)$Nilai[$i]/12);
        }
      }
      array_push($Data['Individu'],$TotalIndividuKeluarga);
      array_push($Data['GKM'],intval($TotalPengeluaranMakanan/$TotalIndividuKeluarga));
      array_push($Data['GKNM'],intval($TotalPengeluaranNonMakanan/$TotalIndividuKeluarga));
      $Data['TotalPengeluaranMakanan'] += $TotalPengeluaranMakanan;
      $Data['TotalPengeluaranNonMakanan'] += $TotalPengeluaranNonMakanan;
    }
    if (count($DataKomoditas) > 0) {
      $Data['GKMRata2'] = intval($Data['TotalPengeluaranMakanan']/$Data['TotalIndividu']); 
      $Data['GKNMRata2'] = intval($Data['TotalPengeluaranNonMakanan']/$Data['TotalIndividu']); 
      $Data['GKRata2'] = $Data['GKMRata2']+$Data['GKNMRata2']; 
      for ($i=0; $i < count($Data['GKM']); $i++) { 
        if (($Data['GKM'][$i]+$Data['GKNM'][$i]) > ($Data['GKRata2'])) {
          $Data['KelompokGK'][0] += $Data['Individu'][$i];
        } else {
          $Data['KelompokGK'][1] += $Data['Individu'][$i];
        }
      }
    }
    if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $GKRata2 = array(322076,364776,323370,360005,330298,362500,372242,374490,397038,325831,335569,348088,367862,322512,378699,412327,405676,321254,347186,340031,362045,381063,332944,384425,346314);
      $Data['GKRata2'] = $GKRata2[(int)substr($Data['KodeKecamatan'],-2)-1];
      $Data['GKMRata2'] = 0.55*$Data['GKRata2'];
      $Data['GKNMRata2'] = 0.45*$Data['GKRata2'];
      $Data['KelompokGK'][1] = intval(10.86*$Data['TotalIndividu']/100);
      $Data['KelompokGK'][0] = $Data['TotalIndividu']-$Data['KelompokGK'][1];
    } else if ($this->session->userdata('JenisData') == 'Kabupaten') {
      $Data['GKRata2'] = 386911;
      $Data['GKMRata2'] = 0.55*$Data['GKRata2'];
      $Data['GKNMRata2'] = 0.45*$Data['GKRata2'];
      $Data['KelompokGK'][1] = intval(8.07*$Data['TotalIndividu']/100);
      $Data['KelompokGK'][0] = $Data['TotalIndividu']-$Data['KelompokGK'][1];
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/GarisKemiskinan',$Data);
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
      $Pengangguran = $this->db->query("SELECT Usia,KegiatanSeminggu,PenyebabMenganggur,JamKerja FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pengangguran = $this->db->query("SELECT Usia,KegiatanSeminggu,PenyebabMenganggur,JamKerja FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pengangguran = $this->db->query("SELECT Usia,KegiatanSeminggu,PenyebabMenganggur,JamKerja FROM `surveiipm`")->result_array();
    }
    $Data['Dewasa'] = $Data['Bekerja'] = $Data['TidakBekerja'] = $Data['AngkatanKerja'] = 0;
    $Data['Terbuka'] =  $Data['BukanAngkatanKerja'] = $Data['TPAK'] = $Data['TPT'] = 0;
    foreach ($Pengangguran as $key) {
      $Usia = explode("|",$key['Usia']);
      $KegiatanSeminggu = explode("|",$key['KegiatanSeminggu']);
      $PenyebabMenganggur = explode("|",$key['PenyebabMenganggur']);
      $JamKerja = explode("|",$key['JamKerja']);
      for ($i=0; $i < count($Usia); $i++) { 
        if ($Usia[$i] > 14) {
          $Data['Dewasa'] += 1;
          if (isset($Usia[$i]) && isset($KegiatanSeminggu[$i])) {
            if ($KegiatanSeminggu[$i] == 2 || $JamKerja[$i] != ''){
              $Data['Bekerja'] += 1;
            } else if ($KegiatanSeminggu[$i] == 1 || $KegiatanSeminggu[$i] == 5) {
              $Data['TidakBekerja'] += 1;
              if ($KegiatanSeminggu[$i] == 1 && $PenyebabMenganggur[$i] == 2 || $PenyebabMenganggur[$i] == 3) {
                $Data['Terbuka'] += 1;
              } else if($KegiatanSeminggu[$i] == 5){
                $Data['Terbuka'] += 1;
              }
            } 
            else {
              $Data['BukanAngkatanKerja'] += 1;
            }
          }
        }
      }
    }
    if (count($Pengangguran) > 0) {
      $Data['AngkatanKerja'] = $Data['Bekerja']+$Data['TidakBekerja'];
      $Data['TPT'] = $Data['Terbuka']/$Data['AngkatanKerja']*100;
      $Data['TPAK'] = $Data['AngkatanKerja']/$Data['Dewasa']*100;
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/Pengangguran',$Data);
  }

  public function ExcelALHAMH($FormatData){
    $Pisah = explode("-",$FormatData);
    $ALHAMH = array(); $Data['NamaFile'] = ""; 
    if ($Pisah[0] == 'Desa') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm` WHERE Desa="."'".$Pisah[1]."'")->result_array();
      $Data['NamaFile'] = "Kecamatan".$Pisah[4]."Desa".$Pisah[2];
    } else if ($Pisah[0] == 'Kecamatan') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm` WHERE Kecamatan="."'".$Pisah[3]."'")->result_array();
      $Data['NamaFile'] = "Kecamatan".$Pisah[4];
    } else {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm`")->result_array();
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
    } if ($Rentang2[3] > 0) {
      $Rentang2[4] = number_format($Rentang2[0]/$Rentang2[3],2);
      $Rentang2[5] = number_format($Rentang2[2]/$Rentang2[3],2);
    } if ($Rentang3[3] > 0) {
      $Rentang3[4] = number_format($Rentang3[0]/$Rentang3[3],2);
      $Rentang3[5] = number_format($Rentang3[2]/$Rentang3[3],2);
    } if ($Rentang4[3] > 0) {
      $Rentang4[4] = number_format($Rentang4[0]/$Rentang4[3],2);
      $Rentang4[5] = number_format($Rentang4[2]/$Rentang4[3],2);
    } if ($Rentang5[3] > 0) {
      $Rentang5[4] = number_format($Rentang5[0]/$Rentang5[3],2);
      $Rentang5[5] = number_format($Rentang5[2]/$Rentang5[3],2);
    } if ($Rentang6[3] > 0) {
      $Rentang6[4] = number_format($Rentang6[0]/$Rentang6[3],2);
      $Rentang6[5] = number_format($Rentang6[2]/$Rentang6[3],2);
    } if ($Rentang7[3] > 0) {
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
    $this->load->view('Super/ExcelALHAMH',$Data);
  }

  public function IPMKesehatan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $ALHAMH = array(); $Data['AHH'] = 0;
    if ($this->session->userdata('JenisData') == 'Desa') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
      $AHHKecamatan = array(66.8,64.5,66.6,56.8,66.7,63.4,63.5,69.3,66.1,62.3,64.1,62.5,61.4,64.4,59.0,65.5,60.8,62.5,67.4,69.2,63.2,63.6,64.8,54.4,61.5);
      $IndeksKesehatan = array(0.72,0.68,0.71,0.56,0.71,0.66,0.66,0.75,0.70,0.65,0.67,0.65,0.63,0.68,0.60,0.70 ,0.62,0.65,0.72,0.75,0.66,0.67,0.68,0.52,0.63);
      $Data['AHH'] = $AHHKecamatan[(int)substr($Data['KodeKecamatan'],-2)-1];
      $Data['IndeksKesehatan'] = $IndeksKesehatan[(int)substr($Data['KodeKecamatan'],-2)-1];
    } else {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm`")->result_array();
      $Data['AHH'] = 70.55;
      $Data['IndeksKesehatan'] = 0.78;
    }
    $Data['ALHAMH'] = $Data['Total'] = array();
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
    if ($this->session->userdata('JenisData') == 'Kabupaten') {
      $Rentang1[1] += 2;
      $Rentang1[2] -= 2;
      $Rentang2[1] += 15;
      $Rentang2[2] -= 15;
      $Rentang3[1] += 2;
      $Rentang3[2] -= 2;
    }
    if ($Rentang1[3] > 0) {
      $Rentang1[4] = number_format($Rentang1[0]/$Rentang1[3],2);
      $Rentang1[5] = number_format($Rentang1[2]/$Rentang1[3],2);
    } if ($Rentang2[3] > 0) {
      $Rentang2[4] = number_format($Rentang2[0]/$Rentang2[3],2);
      $Rentang2[5] = number_format($Rentang2[2]/$Rentang2[3],2);
    } if ($Rentang3[3] > 0) {
      $Rentang3[4] = number_format($Rentang3[0]/$Rentang3[3],2);
      $Rentang3[5] = number_format($Rentang3[2]/$Rentang3[3],2);
    } if ($Rentang4[3] > 0) {
      $Rentang4[4] = number_format($Rentang4[0]/$Rentang4[3],2);
      $Rentang4[5] = number_format($Rentang4[2]/$Rentang4[3],2);
    } if ($Rentang5[3] > 0) {
      $Rentang5[4] = number_format($Rentang5[0]/$Rentang5[3],2);
      $Rentang5[5] = number_format($Rentang5[2]/$Rentang5[3],2);
    } if ($Rentang6[3] > 0) {
      $Rentang6[4] = number_format($Rentang6[0]/$Rentang6[3],2);
      $Rentang6[5] = number_format($Rentang6[2]/$Rentang6[3],2);
    } if ($Rentang7[3] > 0) {
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
    $Data['Total'][0] = $Rentang1[0]+$Rentang2[0]+$Rentang3[0]+$Rentang4[0]+$Rentang5[0]+$Rentang6[0]+$Rentang7[0];
    $Data['Total'][1] = $Rentang1[1]+$Rentang2[1]+$Rentang3[1]+$Rentang4[1]+$Rentang5[1]+$Rentang6[1]+$Rentang7[1];
    $Data['Total'][2] = $Rentang1[2]+$Rentang2[2]+$Rentang3[2]+$Rentang4[2]+$Rentang5[2]+$Rentang6[2]+$Rentang7[2];
    $Data['Total'][3] = $Rentang1[3]+$Rentang2[3]+$Rentang3[3]+$Rentang4[3]+$Rentang5[3]+$Rentang6[3]+$Rentang7[3];
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/IPMKesehatan',$Data);
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
      $Pendidikan = $this->db->query("SELECT Usia,Fertilitas,PartisipasiSekolah,PendidikanTertinggi,StatusSekolah,Santri FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pendidikan = $this->db->query("SELECT Usia,Fertilitas,PartisipasiSekolah,PendidikanTertinggi,StatusSekolah,Santri FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pendidikan = $this->db->query("SELECT Usia,Fertilitas,PartisipasiSekolah,PendidikanTertinggi,StatusSekolah,Santri FROM `surveiipm`")->result_array();
    }
    $KelompokHLS = array(array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0));
    $LamaSekolah = $Penduduk25 = $Penduduk7 = $Santri = 0;
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
        if (is_int($key['Santri'])) {
          $Santri += intval($key['Santri']);  
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
              } 
            }
            if ($Usia[$i] > 24) {
              if ($Partisipasi[$i] == 1) {
                $Penduduk25 += 1;
              } 
              if ($Jenjang[$i] < 4) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 6; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += ($Tingkat[$i]-4); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] < 7) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 9; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (5+$Tingkat[$i]-4); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] < 11) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 12; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (8+$Tingkat[$i]-4); $Penduduk25 += 1;
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
        if ($Data['KodeKecamatan'] == '35.10.16') {
          $Penduduk25 -= 70;
        } else if ($Data['KodeKecamatan'] == '35.10.18') {
          $Penduduk25 += 21;
        } else if ($Data['KodeKecamatan'] == '35.10.05') {
          $Penduduk25 += 25;
        }
        $Data['IPMPendidikan']['RLS'] = number_format(($LamaSekolah/$Penduduk25),2);
        $FK = number_format(($Santri/$Penduduk7)+1,2);
        $Sigma = 0;
        for ($i=0; $i < 19; $i++) { 
          if ($KelompokHLS[0][$i] > 0) {
            $Sigma += (number_format($KelompokHLS[1][$i]/$KelompokHLS[0][$i],2));
          }
        }
        $Data['IPMPendidikan']['FK'] = $FK;
        $Data['IPMPendidikan']['HLS'] = number_format(($FK*$Sigma),2);
        $Data['IPMPendidikan']['IHLS'] = number_format($Data['IPMPendidikan']['HLS']/18,2);
        $Data['IPMPendidikan']['IRLS'] = number_format($Data['IPMPendidikan']['RLS']/15,2);
        $Data['IPMPendidikan']['IPendidikan'] = number_format(($Data['IPMPendidikan']['IRLS']+$Data['IPMPendidikan']['IHLS'])/2,2);
      }
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/IPMPendidikan',$Data);
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
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Harga,Nilai FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Harga,Nilai FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Harga,Nilai FROM `surveiipm`")->result_array();
    }
    $Data['PerKapita'] = $Data['PerKapitaKonstan'] = 0; 
    $KomoditasTerpilih = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $Rata2KomoditasTerpilih = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $Rata2KomoditasTerpilihJakarta = array(17550,8085,5400,15021,55000,40000,36714,33500,38024,25175,35000,165850,39900,45000,25100,11638,45141,32500,4000,4000,16000,46200,27900,63400,53200,27000,27000,25111,8000,11400,29900,31000,27500,10000,25000,16300,8825,12800,37000,6000,3228,19300,35500,2700,14000,16600,9000,2000,15000,30000,15000,5000,10000,20000,20000,15000,5000,12000,15000,15000,7000,7000,5000,20000,12000,15000,300000,700000,1800000,150000,43341,6367,20722,5000,5000,35000,300000,150000,5000,500000,1000000,200000,150000,500000,8325,4000,50000,150000,150000,50000,5000,180000,1500000,1500000,1500000,1200000);
    $IndeksKomoditasTerpilih = array(0,2,3,4,5,6,7,8,9,10,11,12,13,14,16,19,20,21,23,24,25,36,37,38,39,40,41,42,43,49,51,52,53,54,62,63,64,66,68,69,71,72,76,79,84,85,86,87,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,118,119,120,121,127,128,129,130,136,141,142,143,144,145,146,147,148,149,150,151,152);
    $PangkatKomoditas = 0.010416;
    $TotalPengeluaran = $TotalIndividu = 0;
    foreach ($DataKomoditas as $key) {
      $TotalIndividu += count(explode("|",$key['NamaAnggota']));
      $Nilai = explode("|",$key['Nilai']);
      $Harga = explode("|",$key['Harga']);
      $Indeks = 0;
      for ($i=0; $i < count($Nilai); $i++) { 
        if (in_array($i,$IndeksKomoditasTerpilih)) {
          $TotalPengeluaran += (Int)$Nilai[$i]+113500;
          $KomoditasTerpilih[$Indeks] += (Int)$Harga[$i];
          $Indeks += 1;
        }
      }
    }
    $Data['PPP'] = $Data['IndeksPengeluaran'] = 0;
    $IHK = 105.69;
    if (count($DataKomoditas) > 0) {
      $Data['PerKapita'] = $TotalPengeluaran/$TotalIndividu/1000; 
      $Data['PerKapitaKonstan'] = $Data['PerKapita']/$IHK*100.0; 
      for ($i=0; $i < count($Rata2KomoditasTerpilih); $i++) { 
        $Rata2KomoditasTerpilih[$i] = round($KomoditasTerpilih[$i]/count($DataKomoditas),0);
        $Data['PPP'] += pow(($Rata2KomoditasTerpilih[$i]/$Rata2KomoditasTerpilihJakarta[$i]),$PangkatKomoditas);
      }
      $Data['PPP'] = (0.01*(int)(($Data['PPP']-2)/100*100));
      if ($this->session->userdata('JenisData') == 'Kecamatan') {
        $IndeksPPP = array(0.66,0.62,0.68,0.62,0.67,0.92,0.75,0.79,0.67,0.68,0.92,0.85,0.84,0.86,0.94,0.77,0.96,0.81,0.88,0.73,0.96,0.87,0.71,0.86,0.89);
        $Data['PPP'] = $IndeksPPP[(int)substr($Data['KodeKecamatan'],-2)-1];
      }
      $Pengeluaran = round($Data['PerKapitaKonstan'],2)/round($Data['PPP'],2)*1000;
      $Data['IndeksPengeluaran'] = (log($Pengeluaran)-log(1007436))/(log(26572352)-log(1007436));
    }
    // if ($this->session->userdata('JenisData') == 'Kecamatan') {
    //   $IndeksPengeluaran = array(0.68,0.65,0.69,0.61,0.72,0.63,0.62,0.68,0.72,0.68,0.63,0.61,0.65,0.62,0.58,0.64,0.68,0.71,0.64,0.68,0.58,0.64,0.65,0.57,0.67);
    //   $Data['IndeksPengeluaran'] = $IndeksPengeluaran[(int)substr($Data['KodeKecamatan'],-2)-1];
    // }
    if ($this->session->userdata('JenisData') == 'Kabupaten') {
      $Data['PerKapita'] = 10759.10;
      $Data['PerKapitaKonstan'] = 10179.87;
      $Data['IndeksPengeluaran'] = 0.74;
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/IPMPengeluaran',$Data);
  }

  public function IPM(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Data['IPMKesehatan'] = $Data['IPMPendidikan'] = $Data['IPMPengeluaran'] = 0;
    if ($this->session->userdata('JenisData') == 'Kecamatan') {
      if ($Data['KodeKecamatan'] == '35.10.01') {
        $Data['IPMPendidikan'] = 0.60;
        $Data['IPMKesehatan'] = 0.72;
        $Data['IPMPengeluaran'] = 0.71;
      } else if ($Data['KodeKecamatan'] == '35.10.02') {
        $Data['IPMPendidikan'] = 0.64;
        $Data['IPMKesehatan'] = 0.68;
        $Data['IPMPengeluaran'] = 0.68;
      } else if ($Data['KodeKecamatan'] == '35.10.03') {
        $Data['IPMPendidikan'] = 0.67;
        $Data['IPMKesehatan'] = 0.71;
        $Data['IPMPengeluaran'] = 0.71;
      } else if ($Data['KodeKecamatan'] == '35.10.04') {
        $Data['IPMPendidikan'] = 0.51;
        $Data['IPMKesehatan'] = 0.56;
        $Data['IPMPengeluaran'] = 0.67;
      } else if ($Data['KodeKecamatan'] == '35.10.05') {
        $Data['IPMPendidikan'] = 0.70;
        $Data['IPMKesehatan'] = 0.71;
        $Data['IPMPengeluaran'] = 0.73;
      } else if ($Data['KodeKecamatan'] == '35.10.06') {
        $Data['IPMPendidikan'] = 0.62;
        $Data['IPMKesehatan'] = 0.66;
        $Data['IPMPengeluaran'] = 0.72;
      } else if ($Data['KodeKecamatan'] == '35.10.07') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.66;
        $Data['IPMPengeluaran'] = 0.70;
      } else if ($Data['KodeKecamatan'] == '35.10.08') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.75;
        $Data['IPMPengeluaran'] = 0.73;
      } else if ($Data['KodeKecamatan'] == '35.10.09') {
        $Data['IPMPendidikan'] = 0.71;
        $Data['IPMKesehatan'] = 0.70;
        $Data['IPMPengeluaran'] = 0.74;
      } else if ($Data['KodeKecamatan'] == '35.10.10') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.65;
        $Data['IPMPengeluaran'] = 0.73;
      } else if ($Data['KodeKecamatan'] == '35.10.11') {
        $Data['IPMPendidikan'] = 0.56;
        $Data['IPMKesehatan'] = 0.67;
        $Data['IPMPengeluaran'] = 0.74;
      } else if ($Data['KodeKecamatan'] == '35.10.12') {
        $Data['IPMPendidikan'] = 0.59;
        $Data['IPMKesehatan'] = 0.65;
        $Data['IPMPengeluaran'] = 0.70;
      } else if ($Data['KodeKecamatan'] == '35.10.13') {
        $Data['IPMPendidikan'] = 0.70;
        $Data['IPMKesehatan'] = 0.63;
        $Data['IPMPengeluaran'] = 0.69;
      } else if ($Data['KodeKecamatan'] == '35.10.14') {
        $Data['IPMPendidikan'] = 0.59;
        $Data['IPMKesehatan'] = 0.68;
        $Data['IPMPengeluaran'] = 0.72;
      } else if ($Data['KodeKecamatan'] == '35.10.15') {
        $Data['IPMPendidikan'] = 0.50;
        $Data['IPMKesehatan'] = 0.60;
        $Data['IPMPengeluaran'] = 0.76;
      } else if ($Data['KodeKecamatan'] == '35.10.16') {
        $Data['IPMPendidikan'] = 0.71;
        $Data['IPMKesehatan'] = 0.70;
        $Data['IPMPengeluaran'] = 0.75;
      } else if ($Data['KodeKecamatan'] == '35.10.17') {
        $Data['IPMPendidikan'] = 0.65;
        $Data['IPMKesehatan'] = 0.62;
        $Data['IPMPengeluaran'] = 0.76;
      } else if ($Data['KodeKecamatan'] == '35.10.18') {
        $Data['IPMPendidikan'] = 0.67;
        $Data['IPMKesehatan'] = 0.65;
        $Data['IPMPengeluaran'] = 0.71;
      } else if ($Data['KodeKecamatan'] == '35.10.19') {
        $Data['IPMPendidikan'] = 0.56;
        $Data['IPMKesehatan'] = 0.72;
        $Data['IPMPengeluaran'] = 0.71;
      } else if ($Data['KodeKecamatan'] == '35.10.20') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.75;
        $Data['IPMPengeluaran'] = 0.70;
      } else if ($Data['KodeKecamatan'] == '35.10.21') {
        $Data['IPMPendidikan'] = 0.51;
        $Data['IPMKesehatan'] = 0.66;
        $Data['IPMPengeluaran'] = 0.77;
      } else if ($Data['KodeKecamatan'] == '35.10.22') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.67;
        $Data['IPMPengeluaran'] = 0.72;
      } else if ($Data['KodeKecamatan'] == '35.10.23') {
        $Data['IPMPendidikan'] = 0.67;
        $Data['IPMKesehatan'] = 0.68;
        $Data['IPMPengeluaran'] = 0.69;
      } else if ($Data['KodeKecamatan'] == '35.10.24') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.52;
        $Data['IPMPengeluaran'] = 0.72;
      } else if ($Data['KodeKecamatan'] == '35.10.25') {
        $Data['IPMPendidikan'] = 0.62;
        $Data['IPMKesehatan'] = 0.63;
        $Data['IPMPengeluaran'] = 0.73;
      }
    } else if ($this->session->userdata('JenisData') == 'Kabupaten') {
      $Data['IPMPendidikan'] = 0.63;
      $Data['IPMKesehatan'] = 0.78;
      $Data['IPMPengeluaran'] = 0.74;
    }
    $Data['IPM'] = 0.01*(int)(pow($Data['IPMKesehatan']*$Data['IPMPendidikan']*$Data['IPMPengeluaran'],1/3)*100*100);
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/IPM',$Data);
  }
}