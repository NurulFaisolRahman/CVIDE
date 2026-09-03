<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf extends CI_Controller {

  function __construct(){
    parent::__construct();
    if(!$this->session->userdata('Staf')){
      redirect(base_url()); 
    }
    date_default_timezone_set("Asia/Jakarta");
  } 

  public function index(){
    $this->load->view('Staf/Header');
    $this->load->view('Staf/Dashboard');
  }

  public function GantiPassword(){
    $username = $this->session->userdata('Username') ?: $this->session->userdata('username');
    $this->db->where('Username', $username);
    $this->db->update('akun', array('Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT)));
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengganti Password!';
    }
  }

  public function Project(){
    $Data['Project'] = $this->db->get('project')->result_array();
    $this->load->view('Staf/Header',$Data);
    $this->load->view('Staf/Project',$Data);
  }

  public function Input(){
    $pj = $this->session->userdata('Username') ?: ($this->session->userdata('username') ?: 'Staf');
    
    $insertData = array(
      'PJ'          => $pj,
      'NamaProject' => $this->input->post('NamaProject'),
      'Kategori'    => $this->input->post('Kategori'),
      'Deadline'    => $this->input->post('Deadline'),
      'Catatan'     => $this->input->post('Catatan')
    );

    if (isset($_FILES['File']) && is_uploaded_file($_FILES['File']['tmp_name'])) {
      if (!is_dir('Project')) {
        mkdir('Project', 0777, true);
      }
      $NamaFile = date('Ymd',time()).substr(password_hash('Project', PASSWORD_DEFAULT),7,7);
      $NamaFile = str_replace("/","E",$NamaFile);
      $NamaFile = str_replace(".","F",$NamaFile);
      $Tipe = pathinfo($_FILES['File']['name'], PATHINFO_EXTENSION);
      $fullFileName = $NamaFile.".".$Tipe;
      if (move_uploaded_file($_FILES['File']['tmp_name'], "Project/".$fullFileName)) {
        $insertData['File'] = $fullFileName;
      }
    }

    $this->db->insert('project', $insertData);
    if ($this->db->affected_rows() > 0 || $this->db->insert_id() > 0){
      echo '1';
    } else {
      $error = $this->db->error();
      echo !empty($error['message']) ? 'Gagal Input Data: ' . $error['message'] : 'Gagal Input Data!';
    }
  }

  public function Edit(){
    $id = $this->input->post('Id');
    if (empty($id)) {
      echo 'ID Project tidak ditemukan!';
      return;
    }

    $fileLama = $this->input->post('FileLama');
    
    $updateData = array(
      'NamaProject' => $this->input->post('NamaProject'),
      'Kategori'    => $this->input->post('Kategori'),
      'Deadline'    => $this->input->post('Deadline'),
      'Catatan'     => $this->input->post('Catatan')
    );

    if (isset($_FILES['File']) && is_uploaded_file($_FILES['File']['tmp_name'])) {
      if (!is_dir('Project')) {
        mkdir('Project', 0777, true);
      }
      if (!empty($fileLama) && file_exists('Project/'.$fileLama)) {
        @unlink('Project/'.$fileLama);
      }
      $NamaFile = date('Ymd',time()).substr(password_hash('Project', PASSWORD_DEFAULT),7,7);
      $NamaFile = str_replace("/","E",$NamaFile);
      $NamaFile = str_replace(".","F",$NamaFile);
      $Tipe = pathinfo($_FILES['File']['name'], PATHINFO_EXTENSION);
      $fullFileName = $NamaFile.".".$Tipe;
      if (move_uploaded_file($_FILES['File']['tmp_name'], "Project/".$fullFileName)) {
        $updateData['File'] = $fullFileName;
      }
    }

    $this->db->where('Id', $id);
    $result = $this->db->update('project', $updateData);
    if ($result) {
      echo '1';
    } else {
      $error = $this->db->error();
      echo !empty($error['message']) ? 'Gagal Update Data: ' . $error['message'] : 'Gagal Update Data!';
    }
  }

  public function Hapus(){
    $id = $this->input->post('Id');
    $file = $this->input->post('File');
    
    $this->db->delete('project', array('Id' => $id));
    if ($this->db->affected_rows() > 0){
      if (!empty($file) && file_exists('Project/'.$file)) {
        @unlink('Project/'.$file);
      }
      echo '1';
    } else {
      echo 'Gagal Menghapus Data!';
    }
  }
}