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

  /**
   * Helper untuk mengunggah berkas tunggal / ganda (PDF, Word, Excel)
   */
  private function handleFileUploads($fileInputName = 'Files') {
    $uploadedFiles = array();
    
    if (!isset($_FILES[$fileInputName])) {
      if (isset($_FILES['File'])) {
        $fileInputName = 'File';
      } else {
        return $uploadedFiles;
      }
    }

    if (!is_dir('Project')) {
      mkdir('Project', 0777, true);
    }

    $fileData = $_FILES[$fileInputName];
    
    // Jika multiple files (array)
    if (is_array($fileData['name'])) {
      $count = count($fileData['name']);
      for ($i = 0; $i < $count; $i++) {
        if (!empty($fileData['tmp_name'][$i]) && is_uploaded_file($fileData['tmp_name'][$i])) {
          $tipe = strtolower(pathinfo($fileData['name'][$i], PATHINFO_EXTENSION));
          $namaFile = date('YmdHis') . '_' . substr(md5(uniqid(rand(), true)), 0, 8);
          $fullFileName = $namaFile . '.' . $tipe;
          if (move_uploaded_file($fileData['tmp_name'][$i], "Project/" . $fullFileName)) {
            $uploadedFiles[] = $fullFileName;
          }
        }
      }
    } else {
      // Jika single file
      if (!empty($fileData['tmp_name']) && is_uploaded_file($fileData['tmp_name'])) {
        $tipe = strtolower(pathinfo($fileData['name'], PATHINFO_EXTENSION));
        $namaFile = date('YmdHis') . '_' . substr(md5(uniqid(rand(), true)), 0, 8);
        $fullFileName = $namaFile . '.' . $tipe;
        if (move_uploaded_file($fileData['tmp_name'], "Project/" . $fullFileName)) {
          $uploadedFiles[] = $fullFileName;
        }
      }
    }

    return $uploadedFiles;
  }

  public function Input(){
    $pj = $this->session->userdata('Username') ?: ($this->session->userdata('username') ?: 'Staf');
    
    $uploaded = $this->handleFileUploads('Files');
    $fileVal = !empty($uploaded) ? json_encode($uploaded) : null;

    $insertData = array(
      'PJ'          => $pj,
      'NamaProject' => $this->input->post('NamaProject'),
      'Kategori'    => $this->input->post('Kategori'),
      'Deadline'    => $this->input->post('Deadline'),
      'Catatan'     => $this->input->post('Catatan'),
      'File'        => $fileVal
    );

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

    // Berkas lama yang dipertahankan
    $existingFilesRaw = $this->input->post('FileLama');
    $existingFiles = array();
    if (!empty($existingFilesRaw)) {
      $decoded = json_decode($existingFilesRaw, true);
      if (is_array($decoded)) {
        $existingFiles = $decoded;
      } else if (strpos($existingFilesRaw, '|') !== false) {
        $existingFiles = explode('|', $existingFilesRaw);
      } else {
        $existingFiles = array($existingFilesRaw);
      }
    }

    // Berkas yang dihapus oleh user
    $deletedFilesRaw = $this->input->post('FileHapus');
    if (!empty($deletedFilesRaw)) {
      $deletedFiles = json_decode($deletedFilesRaw, true);
      if (is_array($deletedFiles)) {
        foreach ($deletedFiles as $df) {
          if (!empty($df) && file_exists('Project/' . $df)) {
            @unlink('Project/' . $df);
          }
        }
      }
    }

    // Berkas baru yang diunggah
    $newUploaded = $this->handleFileUploads('Files');

    // Gabungkan berkas lama yang dipertahankan + berkas baru
    $allFiles = array_merge($existingFiles, $newUploaded);
    $fileVal = !empty($allFiles) ? json_encode(array_values(array_filter($allFiles))) : null;

    $updateData = array(
      'NamaProject' => $this->input->post('NamaProject'),
      'Kategori'    => $this->input->post('Kategori'),
      'Deadline'    => $this->input->post('Deadline'),
      'Catatan'     => $this->input->post('Catatan'),
      'File'        => $fileVal
    );

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
      if (!empty($file)) {
        $decoded = json_decode($file, true);
        if (is_array($decoded)) {
          foreach ($decoded as $f) {
            if (!empty($f) && file_exists('Project/' . $f)) {
              @unlink('Project/' . $f);
            }
          }
        } else if (strpos($file, '|') !== false) {
          foreach (explode('|', $file) as $f) {
            if (!empty($f) && file_exists('Project/' . $f)) {
              @unlink('Project/' . $f);
            }
          }
        } else {
          if (file_exists('Project/' . $file)) {
            @unlink('Project/' . $file);
          }
        }
      }
      echo '1';
    } else {
      echo 'Gagal Menghapus Data!';
    }
  }
}