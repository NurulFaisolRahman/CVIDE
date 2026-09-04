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

      // Urutan 1: Tahun terbaru
      if ($yearA !== $yearB) {
        return $yearB <=> $yearA;
      }

      // Urutan 2: Status yang diutamakan (Sedang Proses -> Belum Mulai -> Selesai)
      $statA = $getStatusPriority($a);
      $statB = $getStatusPriority($b);
      if ($statA !== $statB) {
        return $statA <=> $statB;
      }

      // Urutan 3: ID Project
      return ($b['Id'] ?? 0) <=> ($a['Id'] ?? 0);
    });

    $Data['Project'] = $projects;
    $this->load->view('Staf/Header',$Data);
    $this->load->view('Staf/Project',$Data);
  }

  /**
   * Helper untuk mengunggah berkas tunggal / ganda (PDF, Word, Excel) dengan mempertahankan nama asli atau nama manual dari user
   */
  private function handleFileUploads($fileInputName = 'Files', $customNames = array()) {
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
          $originalName = $fileData['name'][$i];
          $tipe = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

          // Cek apakah ada penamaan manual dari user
          $manualName = !empty($customNames[$i]) ? trim($customNames[$i]) : '';
          if (!empty($manualName)) {
            $fileNameOnly = pathinfo($manualName, PATHINFO_FILENAME);
          } else {
            $fileNameOnly = pathinfo($originalName, PATHINFO_FILENAME);
          }

          // Bersihkan karakter terlarang dari nama file
          $cleanName = preg_replace('/[\\\\\/:\*\?"<>\|]/', '_', $fileNameOnly);
          $cleanName = trim($cleanName);
          if (empty($cleanName)) {
            $cleanName = 'Dokumen_' . date('YmdHis');
          }

          // Cek jika nama file sudah ada, tambahkan penomoran (1), (2), dst
          $targetFileName = $cleanName . '.' . $tipe;
          $counter = 1;
          while (file_exists('Project/' . $targetFileName)) {
            $targetFileName = $cleanName . ' (' . $counter . ').' . $tipe;
            $counter++;
          }

          if (move_uploaded_file($fileData['tmp_name'][$i], "Project/" . $targetFileName)) {
            $uploadedFiles[] = $targetFileName;
          }
        }
      }
    } else {
      // Jika single file
      if (!empty($fileData['tmp_name']) && is_uploaded_file($fileData['tmp_name'])) {
        $originalName = $fileData['name'];
        $tipe = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        $manualName = !empty($customNames[0]) ? trim($customNames[0]) : (!empty($customNames) && is_string($customNames) ? trim($customNames) : '');
        if (!empty($manualName)) {
          $fileNameOnly = pathinfo($manualName, PATHINFO_FILENAME);
        } else {
          $fileNameOnly = pathinfo($originalName, PATHINFO_FILENAME);
        }

        $cleanName = preg_replace('/[\\\\\/:\*\?"<>\|]/', '_', $fileNameOnly);
        $cleanName = trim($cleanName);
        if (empty($cleanName)) {
          $cleanName = 'Dokumen_' . date('YmdHis');
        }

        $targetFileName = $cleanName . '.' . $tipe;
        $counter = 1;
        while (file_exists('Project/' . $targetFileName)) {
          $targetFileName = $cleanName . ' (' . $counter . ').' . $tipe;
          $counter++;
        }

        if (move_uploaded_file($fileData['tmp_name'], "Project/" . $targetFileName)) {
          $uploadedFiles[] = $targetFileName;
        }
      }
    }

    return $uploadedFiles;
  }

  public function Input(){
    $picInput = $this->input->post('PIC');
    $pic = !empty(trim($picInput ?? '')) ? trim($picInput) : '';
    $statusInput = $this->input->post('Status');
    $status = !empty(trim($statusInput ?? '')) ? trim($statusInput) : 'Belum Mulai';

    $insertData = array(
      'PJ'             => $pic,
      'NamaProject'    => $this->input->post('NamaProject'),
      'Tag'            => $this->input->post('Tag'),
      'Instansi'       => $this->input->post('Instansi'),
      'JenisPengadaan' => $this->input->post('JenisPengadaan'),
      'Nominal'        => $this->input->post('Nominal'),
      'Deadline'       => $this->input->post('Deadline'),
      'Status'         => $status,
      'OutputKegiatan' => $this->input->post('OutputKegiatan'),
      'Catatan'        => $this->input->post('Catatan') ?: '',
      'DokumenAdmin'   => null,
      'DokumenProject' => null,
      'File'           => null
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

    $picInput = $this->input->post('PIC');
    $pic = !empty(trim($picInput ?? '')) ? trim($picInput) : '';
    $statusInput = $this->input->post('Status');

    $updateData = array(
      'PJ'             => $pic,
      'NamaProject'    => $this->input->post('NamaProject'),
      'Tag'            => $this->input->post('Tag'),
      'Instansi'       => $this->input->post('Instansi'),
      'JenisPengadaan' => $this->input->post('JenisPengadaan'),
      'Nominal'        => $this->input->post('Nominal'),
      'Deadline'       => $this->input->post('Deadline'),
      'OutputKegiatan' => $this->input->post('OutputKegiatan'),
      'Catatan'        => $this->input->post('Catatan') ?: ''
    );

    if (!empty($statusInput)) {
      $updateData['Status'] = trim($statusInput);
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

  /**
   * Mengambil daftar file dokumen (Admin / Project) untuk modal kelola dokumen
   */
  public function GetDokumen(){
    $id = $this->input->post('Id');
    $type = $this->input->post('Type'); // 'Admin' atau 'Project'
    $project = $this->db->get_where('project', array('Id' => $id))->row_array();
    if (!$project) {
      echo json_encode(array('status' => 'error', 'message' => 'Project tidak ditemukan!'));
      return;
    }

    $field = ($type === 'Admin') ? 'DokumenAdmin' : 'DokumenProject';
    $raw = !empty($project[$field]) ? $project[$field] : ($type === 'Project' ? ($project['File'] ?? '') : '');

    $files = array();
    if (!empty($raw)) {
      $decoded = json_decode($raw, true);
      if (is_array($decoded)) {
        $files = array_values(array_filter($decoded));
      } else if (strpos($raw, '|') !== false) {
        $files = array_values(array_filter(explode('|', $raw)));
      } else {
        $files = array($raw);
      }
    }

    echo json_encode(array(
      'status'      => 'success',
      'id'          => $id,
      'type'        => $type,
      'projectName' => $project['NamaProject'],
      'files'       => $files,
      'total'       => count($files)
    ));
  }

  /**
   * Mengunggah berkas baru langsung ke dokumen spesifik (Admin / Project)
   */
  public function UploadDokumen(){
    $id = $this->input->post('Id');
    $type = $this->input->post('Type'); // 'Admin' atau 'Project'
    $customNames = $this->input->post('CustomNames') ?: array();

    $project = $this->db->get_where('project', array('Id' => $id))->row_array();
    if (!$project) {
      echo json_encode(array('status' => 'error', 'message' => 'Project tidak ditemukan!'));
      return;
    }

    $newFiles = $this->handleFileUploads('Files', $customNames);
    if (empty($newFiles)) {
      echo json_encode(array('status' => 'error', 'message' => 'Silakan pilih berkas yang akan diunggah!'));
      return;
    }

    $field = ($type === 'Admin') ? 'DokumenAdmin' : 'DokumenProject';
    $raw = !empty($project[$field]) ? $project[$field] : ($type === 'Project' ? ($project['File'] ?? '') : '');
    $existingFiles = array();
    if (!empty($raw)) {
      $decoded = json_decode($raw, true);
      if (is_array($decoded)) {
        $existingFiles = array_values(array_filter($decoded));
      } else if (strpos($raw, '|') !== false) {
        $existingFiles = array_values(array_filter(explode('|', $raw)));
      } else {
        $existingFiles = array($raw);
      }
    }

    $merged = array_values(array_filter(array_merge($existingFiles, $newFiles)));
    $jsonVal = json_encode($merged);

    $updateData = array($field => $jsonVal);
    if ($type === 'Project') {
      $updateData['File'] = $jsonVal;
    }

    $this->db->where('Id', $id);
    $this->db->update('project', $updateData);

    echo json_encode(array(
      'status'      => 'success',
      'id'          => $id,
      'type'        => $type,
      'projectName' => $project['NamaProject'],
      'files'       => $merged,
      'total'       => count($merged),
      'message'     => count($newFiles) . ' berkas berhasil diunggah!'
    ));
  }

  /**
   * Menghapus 1 berkas spesifik dari dokumen project
   */
  public function HapusDokumenItem(){
    $id = $this->input->post('Id');
    $type = $this->input->post('Type'); // 'Admin' atau 'Project'
    $fileName = $this->input->post('FileName');

    $project = $this->db->get_where('project', array('Id' => $id))->row_array();
    if (!$project) {
      echo json_encode(array('status' => 'error', 'message' => 'Project tidak ditemukan!'));
      return;
    }

    $field = ($type === 'Admin') ? 'DokumenAdmin' : 'DokumenProject';
    $raw = !empty($project[$field]) ? $project[$field] : ($type === 'Project' ? ($project['File'] ?? '') : '');
    $existingFiles = array();
    if (!empty($raw)) {
      $decoded = json_decode($raw, true);
      if (is_array($decoded)) {
        $existingFiles = array_values(array_filter($decoded));
      } else if (strpos($raw, '|') !== false) {
        $existingFiles = array_values(array_filter(explode('|', $raw)));
      } else {
        $existingFiles = array($raw);
      }
    }

    $remainingFiles = array_values(array_diff($existingFiles, array($fileName)));
    $jsonVal = !empty($remainingFiles) ? json_encode($remainingFiles) : null;

    $updateData = array($field => $jsonVal);
    if ($type === 'Project') {
      $updateData['File'] = $jsonVal;
    }

    $this->db->where('Id', $id);
    $this->db->update('project', $updateData);

    if (!empty($fileName) && file_exists('Project/' . $fileName)) {
      @unlink('Project/' . $fileName);
    }

    echo json_encode(array(
      'status'      => 'success',
      'id'          => $id,
      'type'        => $type,
      'projectName' => $project['NamaProject'],
      'files'       => $remainingFiles,
      'total'       => count($remainingFiles),
      'message'     => 'Berkas berhasil dihapus!'
    ));
  }

  /**
   * Mengedit nama berkas atau mengganti file dokumen yang sudah terlampir
   */
  public function EditDokumenItem(){
    $id = $this->input->post('Id');
    $type = $this->input->post('Type'); // 'Admin' atau 'Project'
    $oldFileName = trim($this->input->post('OldFileName') ?? '');
    $newCustomName = trim($this->input->post('NewFileName') ?? '');

    $project = $this->db->get_where('project', array('Id' => $id))->row_array();
    if (!$project) {
      echo json_encode(array('status' => 'error', 'message' => 'Project tidak ditemukan!'));
      return;
    }

    $field = ($type === 'Admin') ? 'DokumenAdmin' : 'DokumenProject';
    $raw = !empty($project[$field]) ? $project[$field] : ($type === 'Project' ? ($project['File'] ?? '') : '');
    $existingFiles = array();
    if (!empty($raw)) {
      $decoded = json_decode($raw, true);
      if (is_array($decoded)) {
        $existingFiles = array_values(array_filter($decoded));
      } else if (strpos($raw, '|') !== false) {
        $existingFiles = array_values(array_filter(explode('|', $raw)));
      } else {
        $existingFiles = array($raw);
      }
    }

    $fileIndex = array_search($oldFileName, $existingFiles);
    if ($fileIndex === false) {
      echo json_encode(array('status' => 'error', 'message' => 'Berkas lama tidak ditemukan dalam daftar!'));
      return;
    }

    $hasNewUploadedFile = isset($_FILES['ReplaceFile']) && !empty($_FILES['ReplaceFile']['tmp_name']) && is_uploaded_file($_FILES['ReplaceFile']['tmp_name']);

    if (!is_dir('Project')) {
      mkdir('Project', 0777, true);
    }

    $finalFileName = $oldFileName;

    if ($hasNewUploadedFile) {
      // Ada file baru yang diunggah untuk menggantikan
      $originalNewName = $_FILES['ReplaceFile']['name'];
      $tipe = strtolower(pathinfo($originalNewName, PATHINFO_EXTENSION));

      if (!empty($newCustomName)) {
        $cleanName = preg_replace('/[\\\\\/:\*\?"<>\|]/', '_', pathinfo($newCustomName, PATHINFO_FILENAME));
      } else {
        $cleanName = preg_replace('/[\\\\\/:\*\?"<>\|]/', '_', pathinfo($originalNewName, PATHINFO_FILENAME));
      }
      $cleanName = trim($cleanName);
      if (empty($cleanName)) {
        $cleanName = 'Dokumen_' . date('YmdHis');
      }

      $targetFileName = $cleanName . '.' . $tipe;
      $counter = 1;
      while (file_exists('Project/' . $targetFileName) && $targetFileName !== $oldFileName) {
        $targetFileName = $cleanName . ' (' . $counter . ').' . $tipe;
        $counter++;
      }

      if (move_uploaded_file($_FILES['ReplaceFile']['tmp_name'], "Project/" . $targetFileName)) {
        if ($oldFileName !== $targetFileName && file_exists('Project/' . $oldFileName)) {
          @unlink('Project/' . $oldFileName);
        }
        $finalFileName = $targetFileName;
      } else {
        echo json_encode(array('status' => 'error', 'message' => 'Gagal mengunggah berkas pengganti!'));
        return;
      }
    } else {
      // Hanya ganti nama dokumen
      if (!empty($newCustomName)) {
        $oldExt = strtolower(pathinfo($oldFileName, PATHINFO_EXTENSION));
        $cleanName = preg_replace('/[\\\\\/:\*\?"<>\|]/', '_', pathinfo($newCustomName, PATHINFO_FILENAME));
        $cleanName = trim($cleanName);
        if (empty($cleanName)) {
          $cleanName = pathinfo($oldFileName, PATHINFO_FILENAME);
        }
        $targetFileName = $cleanName . '.' . $oldExt;

        if ($targetFileName !== $oldFileName) {
          $counter = 1;
          while (file_exists('Project/' . $targetFileName)) {
            $targetFileName = $cleanName . ' (' . $counter . ').' . $oldExt;
            $counter++;
          }

          if (file_exists('Project/' . $oldFileName)) {
            @rename('Project/' . $oldFileName, 'Project/' . $targetFileName);
          }
          $finalFileName = $targetFileName;
        }
      }
    }

    $existingFiles[$fileIndex] = $finalFileName;
    $jsonVal = json_encode(array_values(array_filter($existingFiles)));

    $updateData = array($field => $jsonVal);
    if ($type === 'Project') {
      $updateData['File'] = $jsonVal;
    }

    $this->db->where('Id', $id);
    $this->db->update('project', $updateData);

    echo json_encode(array(
      'status'      => 'success',
      'id'          => $id,
      'type'        => $type,
      'projectName' => $project['NamaProject'],
      'files'       => $existingFiles,
      'total'       => count($existingFiles),
      'updatedFile' => $finalFileName,
      'message'     => 'Berkas dokumen berhasil diperbarui!'
    ));
  }

  /**
   * Mengubah Status Project secara langsung dari kolom status pada tabel
   * (Pilihan: Belum Mulai, Sedang Proses, Selesai)
   */
  public function UpdateStatus(){
    $id = $this->input->post('Id');
    $status = $this->input->post('Status');

    $validStatuses = array('Belum Mulai', 'Sedang Proses', 'Selesai');
    if (empty($id) || !in_array($status, $validStatuses)) {
      echo 'Status tidak valid!';
      return;
    }

    $this->db->where('Id', $id);
    $this->db->update('project', array('Status' => $status));
    echo '1';
  }

  public function Hapus(){
    $id = $this->input->post('Id');
    if (empty($id)) {
      echo 'ID Project tidak ditemukan!';
      return;
    }

    $sessionUser = $this->session->userdata('Username') ?: ($this->session->userdata('username') ?: 'Staf');

    // Lakukan Soft Delete
    $updateData = array(
      'is_deleted' => 1,
      'DeletedAt'  => date('Y-m-d H:i:s'),
      'DeletedBy'  => $sessionUser
    );

    $this->db->where('Id', $id);
    $result = $this->db->update('project', $updateData);
    if ($result) {
      echo '1';
    } else {
      $error = $this->db->error();
      echo !empty($error['message']) ? 'Gagal Menghapus Data: ' . $error['message'] : 'Gagal Menghapus Data!';
    }
  }

  /**
   * =========================================================================
   * MODUL BANK DATA (NAMA DOKUMEN & MULTI LINK GOOGLE DRIVE BERJUDUL)
   * =========================================================================
   */
  public function BankData(){
    $Data['BankData'] = $this->db->order_by('Id', 'DESC')->get('bank_data')->result_array();
    $this->load->view('Staf/Header', $Data);
    $this->load->view('Staf/BankData', $Data);
  }

  public function InputBankData(){
    $pj = $this->session->userdata('Username') ?: ($this->session->userdata('username') ?: 'Staf');
    $namaDokumen = trim($this->input->post('NamaDokumen'));
    $linksRaw = $this->input->post('LinkGDrive');

    $linksArray = array();
    if (!empty($linksRaw)) {
      $decoded = json_decode($linksRaw, true);
      if (is_array($decoded)) {
        foreach ($decoded as $item) {
          $judul = isset($item['judul']) ? trim($item['judul']) : '';
          $url = isset($item['url']) ? trim($item['url']) : '';
          if (!empty($url)) {
            $linksArray[] = array(
              'judul' => !empty($judul) ? $judul : 'Link Google Drive',
              'url'   => $url
            );
          }
        }
      }
    }

    $insertData = array(
      'PJ'          => $pj,
      'NamaDokumen' => $namaDokumen,
      'LinkGDrive'  => !empty($linksArray) ? json_encode($linksArray) : null,
      'Indikator'   => $this->input->post('Indikator')
    );

    $this->db->insert('bank_data', $insertData);
    if ($this->db->affected_rows() > 0 || $this->db->insert_id() > 0){
      echo '1';
    } else {
      $error = $this->db->error();
      echo !empty($error['message']) ? 'Gagal Input Bank Data: ' . $error['message'] : 'Gagal Input Bank Data!';
    }
  }

  public function EditBankData(){
    $id = $this->input->post('Id');
    if (empty($id)) {
      echo 'ID Bank Data tidak ditemukan!';
      return;
    }

    $namaDokumen = trim($this->input->post('NamaDokumen'));
    $linksRaw = $this->input->post('LinkGDrive');

    $linksArray = array();
    if (!empty($linksRaw)) {
      $decoded = json_decode($linksRaw, true);
      if (is_array($decoded)) {
        foreach ($decoded as $item) {
          $judul = isset($item['judul']) ? trim($item['judul']) : '';
          $url = isset($item['url']) ? trim($item['url']) : '';
          if (!empty($url)) {
            $linksArray[] = array(
              'judul' => !empty($judul) ? $judul : 'Link Google Drive',
              'url'   => $url
            );
          }
        }
      }
    }

    $updateData = array(
      'NamaDokumen' => $namaDokumen,
      'LinkGDrive'  => !empty($linksArray) ? json_encode($linksArray) : null,
      'Indikator'   => $this->input->post('Indikator')
    );

    $this->db->where('Id', $id);
    $result = $this->db->update('bank_data', $updateData);
    if ($result) {
      echo '1';
    } else {
      $error = $this->db->error();
      echo !empty($error['message']) ? 'Gagal Update Bank Data: ' . $error['message'] : 'Gagal Update Bank Data!';
    }
  }

  public function HapusBankData(){
    $id = $this->input->post('Id');
    $this->db->delete('bank_data', array('Id' => $id));
    if ($this->db->affected_rows() > 0){
      echo '1';
    } else {
      echo 'Gagal Menghapus Bank Data!';
    }
  }
}