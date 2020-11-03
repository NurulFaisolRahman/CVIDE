<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IDE extends CI_Controller {

	public function index(){
		$this->load->view('IDE');
  }
  
  public function Surveyor(){
		$this->load->view('SurveyorSignIn');
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
  
  public function SurveyorSignOut(){
		$this->session->sess_destroy();
		redirect(base_url('IDE/Surveyor'));
  }
  
  public function SurveiIKM(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('SurveiIKM',$Data);
  }

  public function InfoSurveiIKM(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $Data['Responden'] = array();
    foreach ($Data['Desa'] as $key) {
      $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `ikm` WHERE Desa = "."'".$key['Kode']."'")->row_array()['Total'];
      array_push($Data['Responden'], $Total);
    }
    $this->load->view('InfoSurveiIKM',$Data);
  }

  public function InfoIKM(){
    $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$_POST['Kecamatan'].".%'")->result_array();
    foreach ($Desa as $key) {
      $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `ikm` WHERE Desa = "."'".$key['Kode']."'")->row_array()['Total'];
      echo "<tr>";
      echo "<th scope='row' class='text-center align-middle'>".$key['Nama']."</th>";
      echo "<td scope='row' class='text-center align-middle'>".$Total."</td>";
      echo "</tr>";
    }
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

	function Kabupaten(){
    $Kabupaten = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$_POST['Kode'].".%"."' AND length(Kode) = 5")->result_array();
    $OpsiKabupaten = "";
    foreach ($Kabupaten as $key) {
      $OpsiKabupaten .= "<option value='".$key['Kode']."'>".$key['Nama']."</option>";
    }
    echo $OpsiKabupaten;
  }
  
  function Kecamatan(){
    $Kecamatan = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$_POST['Kode'].".%"."' AND length(Kode) = 8")->result_array();
    $OpsiKecamatan = "";
    foreach ($Kecamatan as $key) {
      $OpsiKecamatan .= "<option value='".$key['Kode']."'>".$key['Nama']."</option>";
    }
    echo $OpsiKecamatan;
  }

  function Desa(){
    $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$_POST['Kode'].".%"."'")->result_array();
    $OpsiDesa = "";
    foreach ($Desa as $key) {
      $OpsiDesa .= "<option value='".$key['Kode']."'>".$key['Nama']."</option>";
    }
    echo $OpsiDesa;
  }
}