<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IDE extends CI_Controller {

	public function index(){
		$this->load->view('IDE');
  }

  public function Desa(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
		$this->load->view('AuthDesa',$Data);
  }

  public function DesaSignIn(){ 
    $Desa = $this->db->get_where('desa', array('Username' => htmlentities($_POST['Username'])));
		if($Desa->num_rows() == 0){
			echo "Desa ".$_POST['NamaDesa']." Belum Punya Akun!";
		}
		else{
			$Akun = $Desa->result_array();
			if (password_verify($_POST['Password'], $Akun[0]['Password'])) {
        $Session = array('Desa' => true,
                         'KodeDesa' => $_POST['Username'],
                         'NamaKecamatan' => $_POST['NamaKecamatan'],
                         'NamaDesa' => $_POST['NamaDesa']);
				$this->session->set_userdata($Session);
				echo '1';
			} else {
				echo "Password Salah!";
			}
		}
  }
  
  public function Surveyor(){
		$this->load->view('SurveyorSignIn');
  }

  public function SuperAdmin(){
		$this->load->view('SuperAdmin');
  }
  
  public function SurveyorSignIn(){ 
    $Surveyor = $this->db->get_where('surveyor', array('NIK' => htmlentities($_POST['NIK'])));
		if($Surveyor->num_rows() == 0){
			echo "NIK Salah!";
		}
		else{
			$Akun = $Surveyor->result_array();
			if (password_verify($_POST['Password'], $Akun[0]['Password'])) {
        $Session = array('Surveyor' => true,
                         'NIK' => $_POST['NIK'],
                         'Nama' => $Akun[0]['Nama']);
				$this->session->set_userdata($Session);
				echo '1';
			} else {
				echo "Password Salah!";
			}
		}
  }

  public function SuperAdminSignIn(){ 
    $SuperAdmin = $this->db->get_where('superadmin', array('Username' => htmlentities($_POST['Username'])));
		if($SuperAdmin->num_rows() == 0){
			echo "Username Salah!";
		}
		else{
			$Akun = $SuperAdmin->result_array();
			if (password_verify($_POST['Password'], $Akun[0]['Password'])) {
        $Session = array('SuperAdmin' => true,
                         'Username' => $_POST['Username'],
                         'KodeKecamatan' => '35.10.01',
                         'KodeDesa' => '35.10.01.2001',
                         'NamaDesa' => 'Sarongan');
				$this->session->set_userdata($Session);
				echo '1';
			} else {
				echo "Password Salah!";
			}
		}
  }
  
  public function SurveyorSignOut(){
		$this->session->sess_destroy();
		redirect(base_url('IDE/Surveyor'));
  }

  public function DesaSignOut(){
		$this->session->sess_destroy();
		redirect(base_url('IDE/Desa'));
  }

  public function SuperAdminSignOut(){
		$this->session->sess_destroy();
		redirect(base_url('IDE/SuperAdmin'));
  }

  public function RekapSurveiIKM(){
    $Data['Rekap'] = array();
    $Kecamatan = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    foreach ($Kecamatan as $key) {
      $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$key['Kode'].".%"."'")->result_array();
      foreach ($Desa as $KEY) {
        $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `ikm` WHERE Desa = "."'".$KEY['Kode']."'")->row_array()['Total'];
        if ($Total < 356) {
          array_push($Data['Rekap'],$KEY['Nama']."|".$key['Nama']."|".$Total);
        } 
      }
    }
    $this->load->view('RekapSurveiIKM',$Data);
  }
  
  public function SurveiIKM(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('SurveiIKM',$Data);
  }

  public function DownloadSurveiIKM(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('DownloadSurveiIKM',$Data);
  }

  public function ExcelIKM($NamaKecamatan,$Desa){
    $Data['NamaKecamatan'] = $NamaKecamatan;
    $Data['NamaDesa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode = "."'".$Desa."'")->row_array()['Nama'];
    $Data['Responden'] = array();
    $Data['NilaiIndeks'] = array();
    $Data['MutuPelayanan'] = array();
    $Data['KinerjaUnit'] = array();
    $Data['Rata2'] = array();
    $Data['Tertimbang'] = array();
    $Data['Gender'] = array();
    $Data['Pendidikan'] = array();
    $Data['Pekerjaan'] = array();
    $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `ikm` WHERE Desa = "."'".$Desa."'")->row_array()['Total'];
    array_push($Data['Responden'], $Total);
    $Data['NilaiIndeks'][0] = 0;
    $RespondenDesa = $this->db->query("SELECT * FROM `ikm` WHERE Desa = "."'".$Desa."'")->result_array();
    $Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
    $Average = array(0,0,0,0,0,0,0,0,0,0,0);
    $Tertimbang = array(0,0,0,0,0,0,0,0,0,0,0);
    $Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
    $Pendidikan = array(0,0,0,0,0,0,0);
    $TampungPendidikan = array(0,0,0,0,0,0,0);
    $Pekerjaan = array(0,0,0,0,0,0,0);
    $TampungPekerjaan = array(0,0,0,0,0,0,0);
    $Gender = array(0,0);
    $Pria = 0;
    $Wanita = 0;
    foreach ($RespondenDesa as $key) {
      $Pecah = explode("|",$key['Poin']);
      for ($i=0; $i < 11; $i++) { 
        $Tampung[$i] += $Pecah[$i];
      }
      $key['Gender'] == 1 ? $Pria++ : $Wanita++;
      if ($key['Pendidikan'] == 0) {
        $TampungPendidikan[0] += 1;
      } else if ($key['Pendidikan'] == 1) {
        $TampungPendidikan[1] += 1;
      } else if ($key['Pendidikan'] == 2) {
        $TampungPendidikan[2] += 1;
      } else if ($key['Pendidikan'] == 3) {
        $TampungPendidikan[3] += 1;
      } else if ($key['Pendidikan'] == 4) {
        $TampungPendidikan[4] += 1;
      } else if ($key['Pendidikan'] == 5) {
        $TampungPendidikan[5] += 1;
      } else if ($key['Pendidikan'] == 6) {
        $TampungPendidikan[6] += 1;
      } 
      if ($key['Pekerjaan'] == 0) {
        $TampungPekerjaan[0] += 1;
      } else if ($key['Pekerjaan'] == 1) {
        $TampungPekerjaan[1] += 1;
      } else if ($key['Pekerjaan'] == 2) {
        $TampungPekerjaan[2] += 1;
      } else if ($key['Pekerjaan'] == 3) {
        $TampungPekerjaan[3] += 1;
      } else if ($key['Pekerjaan'] == 4) {
        $TampungPekerjaan[4] += 1;
      } else if ($key['Pekerjaan'] == 5) {
        $TampungPekerjaan[5] += 1;
      } else {
        $TampungPekerjaan[6] += 1;
      } 
    }
    if ($Total < 356) {
      for ($k=0; $k < 11; $k++) { 
        $Tampung[$k] += (3*(356-$Total));
      }
      $Data['Responden'][0] = 356;
    }
    if ($Total > 0) {
      for ($k=0; $k < 7; $k++) { 
        $Pendidikan[$k] = str_replace(".",",",round(($TampungPendidikan[$k]/$Total*100),2));
        $Pekerjaan[$k] = str_replace(".",",",round(($TampungPekerjaan[$k]/$Total*100),2));
      }
    }
    array_push($Data['Pendidikan'], $Pendidikan);
    array_push($Data['Pekerjaan'], $Pekerjaan);
    if ($Total > 0) {
      $Gender[0] = str_replace(".",",",round(($Pria/$Total*100),2));
      $Gender[1] = str_replace(".",",",round(($Wanita/$Total*100),2));
    } 
    array_push($Data['Gender'], $Gender);
    if ($Total < 356) {
      $Total = 356;
    }
    if ($Total > 0) {
      for ($i=0; $i < 11; $i++) { 
        $Average[$i] = str_replace(".",",",round($Tampung[$i]/$Total,2));
        $Tertimbang[$i] = str_replace(".",",",round(($Tampung[$i]/$Total)*(1/11),2));
        $Konversi[$i] = ($Tampung[$i]/$Total)*(1/11)*25;
      }
    }
    array_push($Data['Rata2'], $Average);
    array_push($Data['Tertimbang'], $Tertimbang);
    $Data['NilaiIndeks'][0] = str_replace(".",",",round(array_sum($Konversi),2));
    if ($Total > 355) {
      if ($Data['NilaiIndeks'][0] < 65) {
        $Data['MutuPelayanan'][0] = 'D';
        $Data['KinerjaUnit'][0] = 'Tidak Baik';
      } else if ($Data['NilaiIndeks'][0] < 76.61) {
        $Data['MutuPelayanan'][0] = 'C';
        $Data['KinerjaUnit'][0] = 'Kurang Baik';
      } else if ($Data['NilaiIndeks'][0] < 88.31) {
        $Data['MutuPelayanan'][0] = 'B';
        $Data['KinerjaUnit'][0] = 'Baik';
      } else {
        $Data['MutuPelayanan'][0] = 'A';
        $Data['KinerjaUnit'][0] = 'Sangat Baik';
      } 
    } else {
      $Data['NilaiIndeks'][0] = '-';
      $Data['MutuPelayanan'][0] = '-';
      $Data['KinerjaUnit'][0] = '-';
    }
    $this->load->view('ExcelSurveiIKM',$Data);
  }

  public function ExcelIKMKecamatan($KodeKecamatan,$NamaKecamatan){
    $Data['NamaKecamatan'] = $NamaKecamatan;
    $Data['NamaDesa'] = '';
    $Data['Responden'] = array(0);
    $Data['NilaiIndeks'] = array();
    $Data['MutuPelayanan'] = array();
    $Data['KinerjaUnit'] = array();
    $Data['Rata2'] = array();
    $Data['Tertimbang'] = array();
    $Data['Gender'] = array();
    $Data['Pendidikan'] = array();
    $Data['Pekerjaan'] = array();
    $Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
    $Average = array(0,0,0,0,0,0,0,0,0,0,0);
    $Tertimbang = array(0,0,0,0,0,0,0,0,0,0,0);
    $Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
    $Pendidikan = array(0,0,0,0,0,0,0);
    $TampungPendidikan = array(0,0,0,0,0,0,0);
    $Pekerjaan = array(0,0,0,0,0,0,0);
    $TampungPekerjaan = array(0,0,0,0,0,0,0);
    $Gender = array(0,0);
    $Pria = 0;
    $Wanita = 0;
    $Titip = 0;
    $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$KodeKecamatan.".%'")->result_array();
    for ($j = 0; $j < count($Desa); $j++) { 
      $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `ikm` WHERE Desa = "."'".$Desa[$j]['Kode']."'")->row_array()['Total'];
      $RespondenDesa = $this->db->query("SELECT * FROM `ikm` WHERE Desa = "."'".$Desa[$j]['Kode']."'")->result_array();
      foreach ($RespondenDesa as $key) {
        $Pecah = explode("|",$key['Poin']);
        for ($i=0; $i < 11; $i++) { 
          $Tampung[$i] += $Pecah[$i];
        }
        $key['Gender'] == 1 ? $Pria++ : $Wanita++;
        if ($key['Pendidikan'] == 0) {
          $TampungPendidikan[0] += 1;
        } else if ($key['Pendidikan'] == 1) {
          $TampungPendidikan[1] += 1;
        } else if ($key['Pendidikan'] == 2) {
          $TampungPendidikan[2] += 1;
        } else if ($key['Pendidikan'] == 3) {
          $TampungPendidikan[3] += 1;
        } else if ($key['Pendidikan'] == 4) {
          $TampungPendidikan[4] += 1;
        } else if ($key['Pendidikan'] == 5) {
          $TampungPendidikan[5] += 1;
        } else if ($key['Pendidikan'] == 6) {
          $TampungPendidikan[6] += 1;
        } 
        if ($key['Pekerjaan'] == 0) {
          $TampungPekerjaan[0] += 1;
        } else if ($key['Pekerjaan'] == 1) {
          $TampungPekerjaan[1] += 1;
        } else if ($key['Pekerjaan'] == 2) {
          $TampungPekerjaan[2] += 1;
        } else if ($key['Pekerjaan'] == 3) {
          $TampungPekerjaan[3] += 1;
        } else if ($key['Pekerjaan'] == 4) {
          $TampungPekerjaan[4] += 1;
        } else if ($key['Pekerjaan'] == 5) {
          $TampungPekerjaan[5] += 1;
        } else {
          $TampungPekerjaan[6] += 1;
        }
      }
      if ($Total < 356) {
        for ($k=0; $k < 11; $k++) { 
          $Tampung[$k] += (3*(356-$Total));
        }
        $Titip += 356-$Total;
      }
      $Data['Responden'][0] += $Total;
    }
    if ($Total > 0) {
      for ($k=0; $k < 7; $k++) { 
        $Pendidikan[$k] = str_replace(".",",",round(($TampungPendidikan[$k]/$Data['Responden'][0]*100),2));
        $Pekerjaan[$k] = str_replace(".",",",round(($TampungPekerjaan[$k]/$Data['Responden'][0]*100),2));
      }
    }
    array_push($Data['Pendidikan'], $Pendidikan);
    array_push($Data['Pekerjaan'], $Pekerjaan);
    if ($Total > 0) {
      $Gender[0] = str_replace(".",",",round(($Pria/$Data['Responden'][0]*100),2));
      $Gender[1] = str_replace(".",",",round(($Wanita/$Data['Responden'][0]*100),2));
    } 
    array_push($Data['Gender'], $Gender);
    $Data['Responden'][0] += $Titip;
    for ($i=0; $i < 11; $i++) { 
      $Average[$i] = str_replace(".",",",round($Tampung[$i]/$Data['Responden'][0],2));
      $Tertimbang[$i] = str_replace(".",",",round(($Tampung[$i]/$Data['Responden'][0])*(1/11),2));
      $Konversi[$i] = ($Tampung[$i]/$Data['Responden'][0])*(1/11)*25;
    }
    array_push($Data['Rata2'], $Average);
    array_push($Data['Tertimbang'], $Tertimbang);
    $Data['NilaiIndeks'][0] = str_replace(".",",",round(array_sum($Konversi),2));
    if ($Data['NilaiIndeks'][0] < 65) {
      $Data['MutuPelayanan'][0] = 'D';
      $Data['KinerjaUnit'][0] = 'Tidak Baik';
    } else if ($Data['NilaiIndeks'][0] < 76.61) {
      $Data['MutuPelayanan'][0] = 'C';
      $Data['KinerjaUnit'][0] = 'Kurang Baik';
    } else if ($Data['NilaiIndeks'][0] < 88.31) {
      $Data['MutuPelayanan'][0] = 'B';
      $Data['KinerjaUnit'][0] = 'Baik';
    } else {
      $Data['MutuPelayanan'][0] = 'A';
      $Data['KinerjaUnit'][0] = 'Sangat Baik';
    }
    $this->load->view('ExcelSurveiIKM',$Data);
  }

  public function InfoSurveiIKM(){
    if (isset($_SESSION['KodeKecamatanIKM'])) {
      $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
      $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '".$this->session->userdata('KodeKecamatanIKM').".%'")->result_array();
      $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatanIKM');
    } else {
      $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
      $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
      $Data['KodeKecamatan'] = '35.10.01';
    }
    $Data['Total'] = $this->db->query("SELECT COUNT(*) AS Total FROM `ikm`")->row_array()['Total'];
    $Data['Responden'] = array();
    $Data['NilaiIndeks'] = array();
    $Data['MutuPelayanan'] = array();
    $Data['KinerjaUnit'] = array();
    for ($j = 0; $j < count($Data['Desa']); $j++) { 
      $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `ikm` WHERE Desa = "."'".$Data['Desa'][$j]['Kode']."'")->row_array()['Total'];
      array_push($Data['Responden'], $Total);
      $Data['NilaiIndeks'][$j] = 0;
      $RespondenDesa = $this->db->query("SELECT Poin FROM `ikm` WHERE Desa = "."'".$Data['Desa'][$j]['Kode']."'")->result_array();
      $Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
      $Average = array(0,0,0,0,0,0,0,0,0,0,0);
      foreach ($RespondenDesa as $key) {
        $Pecah = explode("|",$key['Poin']);
        for ($i=0; $i < 11; $i++) { 
          $Tampung[$i] += $Pecah[$i];
        }
      }
      if ($Total < 356) {
        for ($k=0; $k < 11; $k++) { 
          $Tampung[$k] += (3*(356-$Total));
        }
        $Total = 356;
        $Data['Responden'][$j] = 356;
      }
      if ($Total > 0) {
        for ($i=0; $i < 11; $i++) { 
          $Average[$i] = ($Tampung[$i]/$Total)*(1/11)*25;
        }
      }
      $Data['NilaiIndeks'][$j] = round(array_sum($Average),2);
      if ($Total > 355) {
        if ($Data['NilaiIndeks'][$j] < 65) {
          $Data['MutuPelayanan'][$j] = 'D';
          $Data['KinerjaUnit'][$j] = 'Tidak Baik';
        } else if ($Data['NilaiIndeks'][$j] < 76.61) {
          $Data['MutuPelayanan'][$j] = 'C';
          $Data['KinerjaUnit'][$j] = 'Kurang Baik';
        } else if ($Data['NilaiIndeks'][$j] < 88.31) {
          $Data['MutuPelayanan'][$j] = 'B';
          $Data['KinerjaUnit'][$j] = 'Baik';
        } else {
          $Data['MutuPelayanan'][$j] = 'A';
          $Data['KinerjaUnit'][$j] = 'Sangat Baik';
        } 
      } else {
        $Data['NilaiIndeks'][$j] = '-';
        $Data['MutuPelayanan'][$j] = 'Jumlah Responden Belum Mencapai 356';
        $Data['KinerjaUnit'][$j] = 'Belum Diketahui';
      }
    }
    $this->load->view('InfoSurveiIKM',$Data);
  }

  public function InfoIKM(){
    $this->session->set_userdata('KodeKecamatanIKM', $_POST['Kecamatan']);
  }

  public function InputIKM(){
    if($this->db->get_where('ikm', array('NIK' => $_POST['NIK']))->num_rows() === 0){
      $_POST['Nama'] = htmlentities($_POST['Nama']);
      $_POST['Pekerjaan'] = htmlentities($_POST['Pekerjaan']);
      $_POST['Keperluan'] = htmlentities($_POST['Keperluan']);
      $this->db->insert('ikm',$_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Mengirim Survei!';
      }
    } else {
      echo 'Data Survei Dengan NIK '.$_POST['NIK'].' Sudah Ada!';
    }
  }

	function ListKabupaten(){
    $Kabupaten = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$_POST['Kode'].".%"."' AND length(Kode) = 5")->result_array();
    $OpsiKabupaten = "";
    foreach ($Kabupaten as $key) {
      $OpsiKabupaten .= "<option value='".$key['Kode']."'>".$key['Nama']."</option>";
    }
    echo $OpsiKabupaten;
  }
  
  function ListKecamatan(){
    $Kecamatan = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$_POST['Kode'].".%"."' AND length(Kode) = 8")->result_array();
    $OpsiKecamatan = "";
    foreach ($Kecamatan as $key) {
      $OpsiKecamatan .= "<option value='".$key['Kode']."'>".$key['Nama']."</option>";
    }
    echo $OpsiKecamatan;
  }

  function ListDesa(){
    $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$_POST['Kode'].".%"."'")->result_array();
    $OpsiDesa = "";
    foreach ($Desa as $key) {
      $OpsiDesa .= "<option value='".$key['Kode']."'>".$key['Nama']."</option>";
    }
    echo $OpsiDesa;
  }

  public function Simulasi(){
    $Data['BPD'] = $this->db->query("SELECT Poin FROM `bpd`")->result_array();
    $Data['KinerjaPemDes'] = $this->db->query("SELECT Poin FROM `kinerjapemdes`")->result_array();
    $Data['KinerjaAparatur'] = $this->db->query("SELECT * FROM `kinerjaaparatur`")->result_array();
    $this->load->view('ExcelSimulasi',$Data);
  }

  public function RekapIKM(){
    $Data['Surveyor'] = $this->db->get("surveyor")->result_array();
    $this->load->view('RekapSurveyorIKM',$Data);
  }

  public function RekapSurveyor(){
    $Data['Surveyor'] = $this->db->query("select surveyor.nama,count(ipm.nik) as total from surveyor left join ipm on (surveyor.nik = ipm.nik) group by surveyor.nik")->result_array();
    $this->load->view('RekapSurveyor',$Data);
  }

  public function Rekap($NIK,$Surveyor){
    $Data['IPM'] = $this->db->query("SELECT NamaAnggota FROM `ipm` WHERE NIK='".$NIK."'")->result_array();
    $Data['Surveyor'] = $Surveyor;
    $this->load->view('ExcelSurveyorIKM',$Data);                     
  }

  public function RekapIndikatorKesejahteraan(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('RekapIndikatorKesejahteraan',$Data);
  }

  public function ExcelIndikatorKesejahteraan($Kecamatan,$Desa,$NamaDesa){
    $Data['IPM'] = $this->db->query("SELECT * FROM `ipm` WHERE Desa='".$Desa."'")->result_array();
    // $Data['IPM'] = $this->db->query("SELECT * FROM `ipm` WHERE Id=208")->result_array();
    $Data['NamaKecamatan'] = $Kecamatan;
    $Data['NamaDesa'] = $NamaDesa;
    // print_r($Data['IPM']);
    $this->load->view('ExcelIndikatorKesejahteraan',$Data);                     
  }

  public function ExcelKomoditas($Kecamatan,$Desa,$NamaDesa){
    $Data['IPM'] = $this->db->query("SELECT Id,Banyaknya,Harga,Nilai FROM `ipm` WHERE Desa='".$Desa."'")->result_array();
    $Data['NamaKecamatan'] = $Kecamatan;
    $Data['NamaDesa'] = $NamaDesa;
    $this->load->view('ExcelKomoditas',$Data);                      
  }

  public function ExcelALHAMH($Kecamatan,$Desa,$NamaDesa){
    $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `ipm` WHERE Desa='".$Desa."'")->result_array();
    $Data['NamaKecamatan'] = $Kecamatan;
    $Data['NamaDesa'] = $NamaDesa;
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
    $this->load->view('ExcelALHAMH',$Data);                      
  }
}