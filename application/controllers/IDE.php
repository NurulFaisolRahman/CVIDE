<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IDE extends CI_Controller {

	public function index(){
    $Data['Kategori'] = $this->db->query('SELECT DISTINCT(Kategori) FROM `portfolio`')->result_array();
    $Data['Portfolio'] = $this->db->get('portfolio')->result_array();
		$this->load->view('IDE',$Data);
  }
  
  public function Auth(){
		$this->load->view('Auth');
  }

  public function GetPortofolio($Id){
    echo json_encode($this->db->get_where('portfolio', array('Id' => $Id))->row_array());
  }

  public function CekAuth(){
		$Akun = $this->db->get_where('surveyor', array('NIK' => $_POST['Username']))->row_array();
		if (isset($Akun) > 0) {
      if (password_verify($_POST['Password'], $Akun['Password'])) {
        $Session = array('Surveyor' => true, 
                         'NIK' => $_POST['Username'],
                         'Nama' => $Akun['Nama']);
        $this->session->set_userdata($Session);
        echo '1';
      } else { 
        echo "Password Salah!";
      }
    } else {
      $Akun = $this->db->get_where('super', array('Username' => $_POST['Username']))->row_array();
      if (isset($Akun) > 0) {
        if (password_verify($_POST['Password'], $Akun['Password'])) {
          $Session = array('Super' => true,
                           'Username' => $_POST['Username'],
                           'KodeKabupaten' => '35.10',
                           'KodeKecamatan' => '35.10.01',
                           'KodeDesa' => '35.10.01.2001',
                           'JenisData' => 'Desa');
          $this->session->set_userdata($Session);
          echo '2';
        } else {
          echo "Password Salah!";
        }
      } else {
        echo "Username Salah!";
      }
    }		
  }

  public function PendampingDesa(){
    $this->load->view('AuthPendampingDesa');
  }

  public function AuthPendampingDesa(){ 
    $Desa = $this->db->get_where('pendampingdesa', array('Username' => htmlentities($_POST['Username'])));
		if($Desa->num_rows() == 0){
			echo "Username Salah!";
		}
		else{
			$Akun = $Desa->result_array();
			if ($_POST['Password'] == $Akun[0]['Password']) {
        $Session = array('PendampingDesa' => true,
                         'KodeDesa' => $Akun[0]['KodeDesa'],
                         'NamaDesa' => $Akun[0]['NamaDesa']);
				$this->session->set_userdata($Session);
				echo '1';
			} else {
				echo "Password Salah!";
			}
		}
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

  public function SignIn(){  
    $User = $this->db->get_where('akun', array('Username' => htmlentities($_POST['Username'])));
		if ($User->num_rows() == 0) {
			echo "Username Salah!";
		}
		else {
			$Akun = $User->result_array();
			if (password_verify($_POST['Password'], $Akun[0]['Password'])) {
        if ($Akun[0]['Level'] == 1) {
          $Session = array('SuperAdmin' => true,
                           'Username' => $Akun[0]['Username']);
          $this->session->set_userdata($Session);
          echo '1';
        } else if ($Akun[0]['Level'] == 2) {
          $Session = array('Admin' => true,
                           'Username' => $Akun[0]['Username']);
          $this->session->set_userdata($Session);
          echo '2';
        } else if ($Akun[0]['Level'] == 3) {
          $Session = array('Staf' => true,
                           'Username' => $Akun[0]['Username']);
          $this->session->set_userdata($Session);
          echo '3';
        } else if ($Akun[0]['Level'] == 0) {
          $Session = array('Econk' => true,
                           'Username' => $Akun[0]['Username']);
          $this->session->set_userdata($Session);
          echo '0';
        }
			} else {
				echo "Password Salah!";
			}
		}	
  }
  
  public function SignOut(){
		$this->session->sess_destroy();
		redirect(base_url());
  }

  public function LogOut(){
		$this->session->sess_destroy();
		redirect(base_url('IDE/Auth'));
  }

  public function DesaSignOut(){
		$this->session->sess_destroy();
		redirect(base_url('IDE/Desa'));
  }

  public function RekapDesaSurveiIKM(){
    ini_set('max_execution_time', 0); 
    ini_set('memory_limit','2048M');
    $Data['Rekap'] = array();
    $Kecamatan = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    foreach ($Kecamatan as $key) {
      $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$key['Kode'].".%"."'")->result_array();
      foreach ($Desa as $KEY) {
        $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `surveiikm` WHERE Desa = "."'".$KEY['Kode']."'")->row_array()['Total'];
        array_push($Data['Rekap'],$KEY['Nama']."|".$key['Nama']."|".$Total);
      }
    }
    $this->load->view('RekapDesaSurveiIKM',$Data);
  }
  
  public function RekapSurveiIKM(){
    ini_set('max_execution_time', 0); 
    ini_set('memory_limit','2048M');
    $Data['IKMKecamatan'] = array();
    $_Responden = 0;
    $_Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
    $_Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
    $Kecamatan = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    foreach ($Kecamatan as $KEY) {
      $Responden = 0;
      $Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
      $Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
      $Titip = 0;
      $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$KEY['Kode'].".%'")->result_array();
      $DataIKMKecamatan = array();
      array_push($DataIKMKecamatan,$KEY['Nama']);
      for ($j = 0; $j < count($Desa); $j++) { 
        $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `surveiikm` WHERE Desa = "."'".$Desa[$j]['Kode']."'")->row_array()['Total'];
        $RespondenDesa = $this->db->query("SELECT * FROM `surveiikm` WHERE Desa = "."'".$Desa[$j]['Kode']."'")->result_array();
        foreach ($RespondenDesa as $key) {
          $Pecah = explode("|",$key['Poin']);
          for ($i=0; $i < 11; $i++) { 
            $Tampung[$i] += $Pecah[$i];
            $_Tampung[$i] += $Pecah[$i];
          }
        }
        if ($Total < 356) {
          for ($k=0; $k < 11; $k++) { 
            $Tampung[$k] += (3*(356-$Total));
            $_Tampung[$k] += (3*(356-$Total));
          }
          $Titip += 356-$Total;
        }
        $Responden += $Total;
      }
      $Responden += $Titip;
      $_Responden += $Responden;
      for ($i=0; $i < 11; $i++) { 
        array_push($DataIKMKecamatan,number_format(($Tampung[$i]/$Responden)*(1/11),2));
        $Konversi[$i] = ($Tampung[$i]/$Responden)*(1/11)*25;
      }
      $NilaiIndeks = number_format(array_sum($Konversi),2);
      array_push($DataIKMKecamatan,$NilaiIndeks);
      if ($NilaiIndeks < 65) {
        array_push($DataIKMKecamatan,'D');
        array_push($DataIKMKecamatan,'Tidak Baik');
      } else if ($NilaiIndeks < 76.61) {
        array_push($DataIKMKecamatan,'C');
        array_push($DataIKMKecamatan,'Kurang Baik');
      } else if ($NilaiIndeks < 88.31) {
        array_push($DataIKMKecamatan,'B');
        array_push($DataIKMKecamatan,'Baik');
      } else {
        array_push($DataIKMKecamatan,'A');
        array_push($DataIKMKecamatan,'Sangat Baik');
      }
      array_push($Data['IKMKecamatan'],$DataIKMKecamatan);
    }
    $DataIKMKecamatan = array();
    array_push($DataIKMKecamatan,'Banyuwangi');
    for ($i=0; $i < 11; $i++) { 
      array_push($DataIKMKecamatan,number_format(($_Tampung[$i]/$_Responden)*(1/11),2));
      $_Konversi[$i] = ($_Tampung[$i]/$_Responden)*(1/11)*25;
    }
    $NilaiIndeks = number_format(array_sum($_Konversi),2);
    array_push($DataIKMKecamatan,$NilaiIndeks);
    if ($NilaiIndeks < 65) {
      array_push($DataIKMKecamatan,'D');
      array_push($DataIKMKecamatan,'Tidak Baik');
    } else if ($NilaiIndeks < 76.61) {
      array_push($DataIKMKecamatan,'C');
      array_push($DataIKMKecamatan,'Kurang Baik');
    } else if ($NilaiIndeks < 88.31) {
      array_push($DataIKMKecamatan,'B');
      array_push($DataIKMKecamatan,'Baik');
    } else {
      array_push($DataIKMKecamatan,'A');
      array_push($DataIKMKecamatan,'Sangat Baik');
    }
    array_push($Data['IKMKecamatan'],$DataIKMKecamatan);
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
    $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `surveiikm` WHERE Desa = "."'".$Desa."'")->row_array()['Total'];
    array_push($Data['Responden'], $Total);
    $Data['NilaiIndeks'][0] = 0;
    $RespondenDesa = $this->db->query("SELECT * FROM `surveiikm` WHERE Desa = "."'".$Desa."'")->result_array();
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

  public function RekapExcelIKMKecamatan($KodeKecamatan,$NamaKecamatan){
    $Data['NamaFile'] = "Rekap_IKM_Kecamatan_".$NamaKecamatan;
    $Data['IKMDesa'] = array();$Data['IKMKecamatan'] = array();
    $_Responden = 0;
    $_Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
    $_Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
    $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$KodeKecamatan.".%'")->result_array();
    for ($j = 0; $j < count($Desa); $j++) { 
      $Responden = 0;
      $Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
      $Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
      $Titip = 0;
      $DataIKMDesa = $Desa[$j]['Nama'];
      $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `surveiikm` WHERE Desa = "."'".$Desa[$j]['Kode']."'")->row_array()['Total'];
      $RespondenDesa = $this->db->query("SELECT * FROM `surveiikm` WHERE Desa = "."'".$Desa[$j]['Kode']."'")->result_array();
      foreach ($RespondenDesa as $key) {
        $Pecah = explode("|",$key['Poin']);
        for ($i=0; $i < 11; $i++) { 
          $Tampung[$i] += $Pecah[$i];
          $_Tampung[$i] += $Pecah[$i];
        }
      }
      if ($Total < 356) {
        for ($k=0; $k < 11; $k++) { 
          $Tampung[$k] += (3*(356-$Total));
          $_Tampung[$k] += (3*(356-$Total));
        }
        $Titip += 356-$Total;
      }
      $Responden += $Total;
      $Responden += $Titip;
      $_Responden += $Responden;
      for ($i=0; $i < 11; $i++) { 
        $DataIKMDesa .= ("|".number_format(($Tampung[$i]/$Responden)*(1/11),2));
        $Konversi[$i] = ($Tampung[$i]/$Responden)*(1/11)*25;
      }
      $NilaiIndeks = number_format(array_sum($Konversi),2);
      $DataIKMDesa .= ("|".$NilaiIndeks);
      array_push($Data['IKMDesa'],$DataIKMDesa);
    }
    array_push($Data['IKMKecamatan'],$NamaKecamatan);
    for ($i=0; $i < 11; $i++) { 
      array_push($Data['IKMKecamatan'],number_format(($_Tampung[$i]/$_Responden)*(1/11),2));
      $_Konversi[$i] = ($_Tampung[$i]/$_Responden)*(1/11)*25;
    }
    $NilaiIndeks = number_format(array_sum($_Konversi),2);
    array_push($Data['IKMKecamatan'],$NilaiIndeks);
    $this->load->view('RekapExcelIKMKecamatan',$Data);
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
      $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `surveiikm` WHERE Desa = "."'".$Desa[$j]['Kode']."'")->row_array()['Total'];
      $RespondenDesa = $this->db->query("SELECT * FROM `surveiikm` WHERE Desa = "."'".$Desa[$j]['Kode']."'")->result_array();
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
    $Data['Total'] = $this->db->query("SELECT COUNT(*) AS Total FROM `surveiikm`")->row_array()['Total'];
    $Data['Responden'] = array();
    $Data['NilaiIndeks'] = array();
    $Data['MutuPelayanan'] = array();
    $Data['KinerjaUnit'] = array();
    for ($j = 0; $j < count($Data['Desa']); $j++) { 
      $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `surveiikm` WHERE Desa = "."'".$Data['Desa'][$j]['Kode']."'")->row_array()['Total'];
      array_push($Data['Responden'], $Total);
      $Data['NilaiIndeks'][$j] = 0;
      $RespondenDesa = $this->db->query("SELECT Poin FROM `surveiikm` WHERE Desa = "."'".$Data['Desa'][$j]['Kode']."'")->result_array();
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
    if($this->db->get_where('surveiikm', array('NIK' => $_POST['NIK']))->num_rows() === 0){
      $_POST['Nama'] = htmlentities($_POST['Nama']);
      $_POST['Pekerjaan'] = htmlentities($_POST['Pekerjaan']);
      $_POST['Keperluan'] = htmlentities($_POST['Keperluan']);
      $this->db->insert('surveiikm',$_POST);
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

  public function RekapSurveyorIKM(){
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
    $Data['IPM'] = $this->db->query("SELECT Id,NamaAnggota,Banyaknya,Harga,Nilai FROM `ipm` WHERE Desa='".$Desa."'")->result_array();
    $Data['NamaKecamatan'] = $Kecamatan;
    $Data['NamaDesa'] = $NamaDesa;
    $this->load->view('ExcelKomoditas',$Data);                      
  }

  public function RekapBPD(){
    $DataKecamatan = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Kecamatan = array();
    foreach ($DataKecamatan as $key) {
      $Kecamatan[$key['Kode']] = $key['Nama'];
    }
    $BPD = $this->db->query("SELECT * FROM `pbpd` ORDER BY `pbpd`.`Time` DESC")->result_array();
    $Data['BPD'] = array();
    $JumlahIndikator = array(6,3,2,3,1);
    foreach ($BPD as $key) {
      $Average = array(0,0,0,0,0);
      $DataDesa = array();
      array_push($DataDesa,$Kecamatan[substr($key['KodeDesa'],0,8)]);
      array_push($DataDesa,$key['NamaDesa']);
      $Poin = explode("|",$key['Poin']);
      $Loop = 0;
      for ($i=0; $i < 5; $i++) { 
        $Tampung = 0;
        for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
          $Tampung += $Poin[$Loop];
          $Loop++; 
        }
        $Average[$i] += $Tampung;
      }
      for ($i=0; $i < 5; $i++) { 
        $Average[$i] = $Average[$i]/$JumlahIndikator[$i]*25;
        array_push($DataDesa,$Average[$i]);
      }
      $Hasil = array_sum($Average)/5;
      array_push($DataDesa,$Hasil);
      if ($Hasil < 43.75) {
        array_push($DataDesa,'D');
        array_push($DataDesa,'Tidak Baik');
      } else if ($Hasil < 62.5) {
        array_push($DataDesa,'C');
        array_push($DataDesa,'Kurang Baik');
      } else if ($Hasil < 81.25) {
        array_push($DataDesa,'B');
        array_push($DataDesa,'Baik');
      } else {
        array_push($DataDesa,'A');
        array_push($DataDesa,'Sangat Baik');
      }
      array_push($Data['BPD'],$DataDesa);
    }
    $this->load->view('RekapBPD',$Data);
  }

  public function RekapPemDes(){
    $DataKecamatan = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Kecamatan = array();
    foreach ($DataKecamatan as $key) {
      $Kecamatan[$key['Kode']] = $key['Nama'];
    }
    $PemDes = $this->db->query("SELECT * FROM `pkinerjapemdes` ORDER BY `pkinerjapemdes`.`Time` DESC")->result_array();
    $Data['PemDes'] = array();
    $JumlahIndikator = array(7,11,13,6,3);
    foreach ($PemDes as $key) {
      $Average = array(0,0,0,0,0);
      $DataDesa = array();
      array_push($DataDesa,$Kecamatan[substr($key['KodeDesa'],0,8)]);
      array_push($DataDesa,$key['NamaDesa']);
      $Poin = explode("|",$key['Poin']);
      $Loop = 0;
      for ($i=0; $i < 5; $i++) { 
        $Tampung = 0;
        for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
          $Tampung += $Poin[$Loop];
          $Loop++; 
        }
        $Average[$i] += $Tampung;
      }
      for ($i=0; $i < 5; $i++) { 
        $Average[$i] = $Average[$i]/$JumlahIndikator[$i]*25;
        array_push($DataDesa,$Average[$i]);
      }
      $Hasil = array_sum($Average)/5;
      array_push($DataDesa,$Hasil);
      if ($Hasil < 43.75) {
        array_push($DataDesa,'D');
        array_push($DataDesa,'Tidak Baik');
      } else if ($Hasil < 62.5) {
        array_push($DataDesa,'C');
        array_push($DataDesa,'Kurang Baik');
      } else if ($Hasil < 81.25) {
        array_push($DataDesa,'B');
        array_push($DataDesa,'Baik');
      } else {
        array_push($DataDesa,'A');
        array_push($DataDesa,'Sangat Baik');
      }
      array_push($Data['PemDes'],$DataDesa);
    }
    $this->load->view('RekapPemDes',$Data);
  }

  public function ExcelEvaluasiDesa($Filter){
    $Filter = $Filter;
    $Pisah = explode("-",$Filter);
    $Data['Desa'] = $Data['Kecamatan'] = array();
    $Cek = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Pisah[1]."%'")->result_array();
    array_shift($Cek);
    if ($Pisah[0] == "BPD") {
      $Data['NamaFile'] = "BPD_Kecamatan_".$Pisah[2];
      $JumlahIndikator = array(6,3,2,3,1);
      $Tabel = "pbpd";
    } 
    else if ($Pisah[0] == "PEMDES") {
      $Data['NamaFile'] = "PemDes_Kecamatan_".$Pisah[2];
      $JumlahIndikator = array(7,11,13,6,3);
      $Tabel = "pkinerjapemdes";
    }
    $data = $this->db->query("SELECT * FROM ".$Tabel." WHERE KodeDesa LIKE "."'".$Pisah[1]."%'")->result_array();
    $KodeDesa = array();
    foreach ($data as $key) {
      array_push($KodeDesa,$key['KodeDesa']);
    }
    $Rata2 = array(0,0,0,0,0,0);
    $Pembagi = 0;
    foreach ($Cek as $key) {
      if (in_array($key['Kode'],$KodeDesa)) {
        $Pembagi += 1;
        $data = $this->db->query("SELECT * FROM ".$Tabel." WHERE KodeDesa = "."'".$key['Kode']."'")->row_array();
        $Average = array(0,0,0,0,0);
        $Poin = explode("|",$data['Poin']);
        $Loop = 0;
        for ($i=0; $i < 5; $i++) { 
          $Tampung = 0;
          for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
            $Tampung += $Poin[$Loop];
            $Loop++; 
          }
          $Average[$i] += $Tampung;
        }
        $DataDesa = array();
        array_push($DataDesa,$key['Nama']);
        for ($i=0; $i < 5; $i++) { 
          $Average[$i] = $Average[$i]/$JumlahIndikator[$i]*25;
          array_push($DataDesa,number_format($Average[$i],2));
          $Rata2[$i] += $Average[$i]; 
        }
        $Hasil = array_sum($Average)/5;
        $Rata2[5] += $Hasil;
        array_push($Average,$Hasil);
        array_push($DataDesa,number_format($Hasil,2));
        if ($Hasil < 43.75) {
          array_push($DataDesa,'D');
          array_push($DataDesa,'Tidak Baik');
        } else if ($Hasil < 62.5) {
          array_push($DataDesa,'C');
          array_push($DataDesa,'Kurang Baik');
        } else if ($Hasil < 81.25) {
          array_push($DataDesa,'B');
          array_push($DataDesa,'Baik');
        } else {
          array_push($DataDesa,'A');
          array_push($DataDesa,'Sangat Baik');
        }
        array_push($Data['Desa'],join("|",$DataDesa));
      } else {
        $DataDesa = $key['Nama']."|0|0|0|0|0|0|-|-";
        array_push($Data['Desa'],$DataDesa);
      }
    }
    if (count($KodeDesa) > 0) {
      array_push($Data['Kecamatan'],$Pisah[2]);
      for ($i=0; $i < 6; $i++) { 
        array_push($Data['Kecamatan'],number_format($Rata2[$i]/$Pembagi,2));
      }
      if (number_format($Rata2[5]/$Pembagi,2) < 43.75) {
        array_push($Data['Kecamatan'],'D');
        array_push($Data['Kecamatan'],'Tidak Baik');
      } else if (number_format($Rata2[5]/$Pembagi,2) < 62.5) {
        array_push($Data['Kecamatan'],'C');
        array_push($Data['Kecamatan'],'Kurang Baik');
      } else if (number_format($Rata2[5]/$Pembagi,2) < 81.25) {
        array_push($Data['Kecamatan'],'B');
        array_push($Data['Kecamatan'],'Baik');
      } else {
        array_push($Data['Kecamatan'],'A');
        array_push($Data['Kecamatan'],'Sangat Baik');
      }
    } 
    else {
      array_push($Data['Kecamatan'],$Pisah[2]);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],'-');
      array_push($Data['Kecamatan'],'-');
    }  
    $this->load->view('ExcelEvaluasiDesa',$Data);
  }

  public function RekapEvaluasiPerKecamatan(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $this->load->view('RekapEvaluasiPerKecamatan',$Data);
  }

  public function FilterEvaluasiPerKecamatan(){
    $Filter = $_POST['Filter'];
    $Pisah = explode("-",$Filter);
    $Data['Desa'] = $Data['Kecamatan'] = array();
    $Cek = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Pisah[1]."%'")->result_array();
    array_shift($Cek);
    if ($Pisah[0] == "BPD") {
      $Data['NamaFile'] = "BPD_Kecamatan_".$Pisah[2];
      $JumlahIndikator = array(6,3,2,3,1);
      $Tabel = "pbpd";
    } 
    else if ($Pisah[0] == "PEMDES") {
      $Data['NamaFile'] = "PemDes_Kecamatan_".$Pisah[2];
      $JumlahIndikator = array(7,11,13,6,3);
      $Tabel = "pkinerjapemdes";
    }
    $data = $this->db->query("SELECT * FROM ".$Tabel." WHERE KodeDesa LIKE "."'".$Pisah[1]."%'")->result_array();
    $KodeDesa = array();
    foreach ($data as $key) {
      array_push($KodeDesa,$key['KodeDesa']);
    }
    $Rata2 = array(0,0,0,0,0,0);
    $Pembagi = 0;
    foreach ($Cek as $key) {
      if (in_array($key['Kode'],$KodeDesa)) {
        $Pembagi += 1;
        $data = $this->db->query("SELECT * FROM ".$Tabel." WHERE KodeDesa = "."'".$key['Kode']."'")->row_array();
        $Average = array(0,0,0,0,0);
        $Poin = explode("|",$data['Poin']);
        $Loop = 0;
        for ($i=0; $i < 5; $i++) { 
          $Tampung = 0;
          for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
            $Tampung += $Poin[$Loop];
            $Loop++; 
          }
          $Average[$i] += $Tampung;
        }
        $DataDesa = array();
        array_push($DataDesa,$key['Nama']);
        for ($i=0; $i < 5; $i++) { 
          $Average[$i] = $Average[$i]/$JumlahIndikator[$i]*25;
          array_push($DataDesa,number_format($Average[$i],2));
          $Rata2[$i] += $Average[$i]; 
        }
        $Hasil = array_sum($Average)/5;
        $Rata2[5] += $Hasil;
        array_push($Average,$Hasil);
        array_push($DataDesa,number_format($Hasil,2));
        if ($Hasil < 43.75) {
          array_push($DataDesa,'D');
          array_push($DataDesa,'Tidak Baik');
        } else if ($Hasil < 62.5) {
          array_push($DataDesa,'C');
          array_push($DataDesa,'Kurang Baik');
        } else if ($Hasil < 81.25) {
          array_push($DataDesa,'B');
          array_push($DataDesa,'Baik');
        } else {
          array_push($DataDesa,'A');
          array_push($DataDesa,'Sangat Baik');
        }

        array_push($Data['Desa'],join("|",$DataDesa));
      } else {
        $DataDesa = $key['Nama']."|0|0|0|0|0|0|-|-";
        array_push($Data['Desa'],$DataDesa);
      }
    }
    if (count($KodeDesa) > 0) {
      array_push($Data['Kecamatan'],$Pisah[2]);
      for ($i=0; $i < 6; $i++) { 
        array_push($Data['Kecamatan'],number_format($Rata2[$i]/$Pembagi,2));
      }
      if (number_format($Rata2[5]/$Pembagi,2) < 43.75) {
        array_push($Data['Kecamatan'],'D');
        array_push($Data['Kecamatan'],'Tidak Baik');
      } else if (number_format($Rata2[5]/$Pembagi,2) < 62.5) {
        array_push($Data['Kecamatan'],'C');
        array_push($Data['Kecamatan'],'Kurang Baik');
      } else if (number_format($Rata2[5]/$Pembagi,2) < 81.25) {
        array_push($Data['Kecamatan'],'B');
        array_push($Data['Kecamatan'],'Baik');
      } else {
        array_push($Data['Kecamatan'],'A');
        array_push($Data['Kecamatan'],'Sangat Baik');
      }
    } 
    else {
      array_push($Data['Kecamatan'],$Pisah[2]);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],0);
      array_push($Data['Kecamatan'],'-');
      array_push($Data['Kecamatan'],'-');
    } 
    $Rekap = "";
    for ($i=0; $i < count($Data['Desa']); $i++) { 
      $Pecah = explode("|",$Data['Desa'][$i]);
      $Rekap .= "<tr style='color:#000000;'>";
      $Rekap .= '<th scope="row" rowspan ="2" class="text-center align-middle">'.($i+1).'</th>';
      $Rekap .= '<th scope="row" rowspan ="2" class="text-center align-middle">'.str_replace(".",",",$Pecah[0]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Pecah[1]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Pecah[2]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Pecah[3]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Pecah[4]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Pecah[5]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Pecah[6]).'</th>';
      $Rekap .= '<th scope="row" rowspan ="2" class="text-center align-middle">'.$Pecah[7].'</th>';
      $Rekap .= '<th scope="row" rowspan ="2" class="text-center align-middle">'.$Pecah[8].'</th>';
      $Rekap .= "</tr>";
      $Rekap .= "<tr style='color:#0000ff;'>";
      $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Pecah[1]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Pecah[2]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Pecah[3]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Pecah[4]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Pecah[5]).'</th>';
      $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Pecah[6]).'</th>';
      $Rekap .= "</tr>";
    }
    $Rekap .= "<tr style='color:#ff0000;'>";
    $Rekap .= '<th scope="row" rowspan ="2" class="text-center align-middle">#</th>';
    $Rekap .= '<th scope="row" rowspan ="2" class="text-center align-middle">'.str_replace(".",",",$Data['Kecamatan'][0]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Data['Kecamatan'][1]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Data['Kecamatan'][2]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Data['Kecamatan'][3]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Data['Kecamatan'][4]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Data['Kecamatan'][5]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.str_replace(".",",",$Data['Kecamatan'][6]).'</th>';
    $Rekap .= '<th scope="row" rowspan ="2" class="text-center align-middle">'.$Data['Kecamatan'][7].'</th>';
    $Rekap .= '<th scope="row" rowspan ="2" class="text-center align-middle">'.$Data['Kecamatan'][8].'</th>';
    $Rekap .= "</tr>";
    $Rekap .= "<tr style='color:#0000ff;'>";
    $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Data['Kecamatan'][1]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Data['Kecamatan'][2]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Data['Kecamatan'][3]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Data['Kecamatan'][4]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Data['Kecamatan'][5]).'</th>';
    $Rekap .= '<th scope="row" class="text-center align-middle">'.$this->Grade($Data['Kecamatan'][6]).'</th>';
    $Rekap .= "</tr>";
    echo $Rekap;
  }

  public function Grade($Nilai){
    if ($Nilai == 0){
      return '-';
    } else if ($Nilai < 43.75) {
      return 'Tidak Baik';
    } else if ($Nilai < 62.5) {
      return 'Kurang Baik';
    } else if ($Nilai < 81.25) {
      return 'Baik';
    } else {
      return 'Sangat Baik';
    }
  }
}