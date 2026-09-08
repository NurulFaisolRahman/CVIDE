<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf extends CI_Controller {

  function __construct(){
    parent::__construct();
    if(!$this->session->userdata('Staf') && !$this->session->userdata('Surveiyor')){
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
    $userLevel = (int)($this->session->userdata('level') ?? 3);
    if ($userLevel === 4) {
      echo 'Akses ditolak: Role 4 tidak memiliki izin menambah project baru!';
      return;
    }

    $picInput = $this->input->post('PIC');
    $pic = !empty(trim($picInput ?? '')) ? trim($picInput) : '';
    $statusInput = $this->input->post('Status');
    $status = !empty(trim($statusInput ?? '')) ? trim($statusInput) : 'Belum Mulai';

    $outputInput = $this->input->post('OutputKegiatan');
    $outputData = '';
    if (is_array($outputInput)) {
      $filtered = array_values(array_filter(array_map('trim', $outputInput)));
      $outputData = !empty($filtered) ? json_encode($filtered) : '';
    } else if (is_string($outputInput)) {
      $trimmed = trim($outputInput);
      $decoded = json_decode($trimmed, true);
      if (is_array($decoded)) {
        $filtered = array_values(array_filter(array_map('trim', $decoded)));
        $outputData = !empty($filtered) ? json_encode($filtered) : '';
      } else {
        $outputData = $trimmed;
      }
    }

    $insertData = array(
      'PJ'             => $pic,
      'NamaProject'    => $this->input->post('NamaProject'),
      'Tag'            => $this->input->post('Tag'),
      'Instansi'       => $this->input->post('Instansi'),
      'JenisPengadaan' => $this->input->post('JenisPengadaan'),
      'Nominal'        => $this->input->post('Nominal'),
      'Deadline'       => $this->input->post('Deadline'),
      'Status'         => $status,
      'OutputKegiatan' => $outputData,
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

    $userLevel = (int)($this->session->userdata('level') ?? 3);
    if ($userLevel === 4) {
      $this->db->where('Id', $id);
      $result = $this->db->update('project', array('Tag' => $this->input->post('Tag')));
      if ($result) {
        echo '1';
      } else {
        $error = $this->db->error();
        echo !empty($error['message']) ? 'Gagal Update Tag: ' . $error['message'] : 'Gagal Update Tag!';
      }
      return;
    }

    $picInput = $this->input->post('PIC');
    $pic = !empty(trim($picInput ?? '')) ? trim($picInput) : '';
    $statusInput = $this->input->post('Status');

    $outputInput = $this->input->post('OutputKegiatan');
    $outputData = '';
    if (is_array($outputInput)) {
      $filtered = array_values(array_filter(array_map('trim', $outputInput)));
      $outputData = !empty($filtered) ? json_encode($filtered) : '';
    } else if (is_string($outputInput)) {
      $trimmed = trim($outputInput);
      $decoded = json_decode($trimmed, true);
      if (is_array($decoded)) {
        $filtered = array_values(array_filter(array_map('trim', $decoded)));
        $outputData = !empty($filtered) ? json_encode($filtered) : '';
      } else {
        $outputData = $trimmed;
      }
    }

    $updateData = array(
      'PJ'             => $pic,
      'NamaProject'    => $this->input->post('NamaProject'),
      'Tag'            => $this->input->post('Tag'),
      'Instansi'       => $this->input->post('Instansi'),
      'JenisPengadaan' => $this->input->post('JenisPengadaan'),
      'Nominal'        => $this->input->post('Nominal'),
      'Deadline'       => $this->input->post('Deadline'),
      'OutputKegiatan' => $outputData,
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
   * Mengunggah berkas baru atau menambahkan tautan Google Drive langsung ke dokumen spesifik (Admin / Project)
   */
  public function UploadDokumen(){
    $id = $this->input->post('Id');
    $type = $this->input->post('Type'); // 'Admin' atau 'Project'
    $customNames = $this->input->post('CustomNames') ?: array();
    $driveLinks = $this->input->post('DriveLinks') ?: array();
    $driveNames = $this->input->post('DriveNames') ?: array();

    $userLevel = (int)($this->session->userdata('level') ?? 3);
    if ($userLevel === 4 && $type === 'Admin') {
      echo json_encode(array('status' => 'error', 'message' => 'Akses ditolak: Role 4 hanya memiliki izin mengelola Dokumen Project!'));
      return;
    }

    $project = $this->db->get_where('project', array('Id' => $id))->row_array();
    if (!$project) {
      echo json_encode(array('status' => 'error', 'message' => 'Project tidak ditemukan!'));
      return;
    }

    $newFiles = $this->handleFileUploads('Files', $customNames);

    // Proses Tautan Google Drive jika ada
    if (!empty($driveLinks) && is_array($driveLinks)) {
      foreach ($driveLinks as $idx => $link) {
        $link = trim($link ?? '');
        if (!empty($link)) {
          $dName = isset($driveNames[$idx]) ? trim($driveNames[$idx] ?? '') : '';
          if (!empty($dName)) {
            $newFiles[] = $link . '::' . $dName;
          } else {
            $newFiles[] = $link;
          }
        }
      }
    }

    if (empty($newFiles)) {
      echo json_encode(array('status' => 'error', 'message' => 'Silakan pilih berkas atau masukkan tautan Google Drive yang akan disimpan!'));
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
      'message'     => count($newFiles) . ' dokumen/tautan berhasil disimpan!'
    ));
  }

  /**
   * Menghapus 1 berkas atau tautan spesifik dari dokumen project
   */
  public function HapusDokumenItem(){
    $id = $this->input->post('Id');
    $type = $this->input->post('Type'); // 'Admin' atau 'Project'
    $fileName = $this->input->post('FileName');

    $userLevel = (int)($this->session->userdata('level') ?? 3);
    if ($userLevel === 4 && $type === 'Admin') {
      echo json_encode(array('status' => 'error', 'message' => 'Akses ditolak: Role 4 hanya memiliki izin mengelola Dokumen Project!'));
      return;
    }

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

    // Hapus fisik berkas hanya jika merupakan file lokal (bukan URL tautan)
    if (!empty($fileName) && !preg_match('/^https?:\/\//i', $fileName) && file_exists('Project/' . $fileName)) {
      @unlink('Project/' . $fileName);
    }

    echo json_encode(array(
      'status'      => 'success',
      'id'          => $id,
      'type'        => $type,
      'projectName' => $project['NamaProject'],
      'files'       => $remainingFiles,
      'total'       => count($remainingFiles),
      'message'     => 'Dokumen berhasil dihapus!'
    ));
  }

  /**
   * Mengedit nama berkas, tautan Google Drive, atau mengganti file dokumen yang sudah terlampir
   */
  public function EditDokumenItem(){
    $id = $this->input->post('Id');
    $type = $this->input->post('Type'); // 'Admin' atau 'Project'
    $oldFileName = trim($this->input->post('OldFileName') ?? '');
    $newCustomName = trim($this->input->post('NewFileName') ?? '');
    $newDriveUrl = trim($this->input->post('NewDriveUrl') ?? '');

    $userLevel = (int)($this->session->userdata('level') ?? 3);
    if ($userLevel === 4 && $type === 'Admin') {
      echo json_encode(array('status' => 'error', 'message' => 'Akses ditolak: Role 4 hanya memiliki izin mengelola Dokumen Project!'));
      return;
    }

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
      echo json_encode(array('status' => 'error', 'message' => 'Item dokumen lama tidak ditemukan dalam daftar!'));
      return;
    }

    $isOldDriveLink = preg_match('/^https?:\/\//i', $oldFileName);

    if ($isOldDriveLink || !empty($newDriveUrl)) {
      // Kasus item Google Drive Link
      $targetUrl = !empty($newDriveUrl) ? $newDriveUrl : explode('::', $oldFileName)[0];
      if (!empty($newCustomName)) {
        $finalFileName = $targetUrl . '::' . $newCustomName;
      } else {
        $finalFileName = $targetUrl;
      }
    } else {
      // Kasus file fisik lokal
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
      'message'     => 'Dokumen berhasil diperbarui!'
    ));
  }

  /**
   * Mengubah Status Project secara langsung dari kolom status pada tabel
   * (Pilihan: Belum Mulai, Sedang Proses, Selesai)
   */
  public function UpdateStatus(){
    $userLevel = (int)($this->session->userdata('level') ?? 3);
    if ($userLevel === 4) {
      echo 'Akses ditolak: Role 4 tidak memiliki izin mengubah status project!';
      return;
    }

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
    $userLevel = (int)($this->session->userdata('level') ?? 3);
    if ($userLevel === 4) {
      echo 'Akses ditolak: Role 4 tidak memiliki izin menghapus project!';
      return;
    }

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

  /**
   * =========================================================================
   * MODUL MANAJEMEN MICROSITE TERISOLASI & STRUKTUR BAB/SUB-BAB BERSARANG
   * =========================================================================
   */
  private function ensureMicrositeStructure() {
    // 1. Tabel Induk Microsite
    $this->db->query("CREATE TABLE IF NOT EXISTS `microsite` (
      `Id` INT(11) NOT NULL AUTO_INCREMENT,
      `Slug` VARCHAR(100) NOT NULL UNIQUE,
      `Judul` VARCHAR(255) NOT NULL,
      `Subjudul` VARCHAR(255) NULL,
      `BannerImg` TEXT NULL,
      `LogoImg` TEXT NULL,
      `FooterText` VARCHAR(255) NULL,
      `CreatedAt` DATETIME NULL,
      `UpdatedAt` DATETIME NULL,
      PRIMARY KEY (`Id`),
      KEY `idx_slug` (`Slug`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // 2. Tabel Struktur Bab, Sub-Bab, & Dokumen Bersarang
    $this->db->query("CREATE TABLE IF NOT EXISTS `microsite_item` (
      `Id` INT(11) NOT NULL AUTO_INCREMENT,
      `MicrositeId` INT(11) NOT NULL,
      `ParentId` INT(11) NULL DEFAULT 0,
      `Tipe` VARCHAR(20) NOT NULL DEFAULT 'grup',
      `Judul` VARCHAR(255) NOT NULL,
      `Url` TEXT NULL,
      `Icon` VARCHAR(50) NULL DEFAULT '',
      `Urutan` INT(11) NOT NULL DEFAULT 0,
      `CreatedAt` DATETIME NULL,
      `UpdatedAt` DATETIME NULL,
      PRIMARY KEY (`Id`),
      KEY `idx_microsite_id` (`MicrositeId`),
      KEY `idx_parent_id` (`ParentId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Pastikan seluruh ikon lama dibersihkan
    $this->db->query("UPDATE `microsite_item` SET `Icon` = '' WHERE `Icon` != ''");

    // Auto-seed jika tabel microsite masih kosong
    if ($this->db->count_all('microsite') == 0) {
      // 1. Seed IPPD Situbondo
      $this->db->insert('microsite', array(
        'Slug'       => 'ippd-situbondo',
        'Judul'      => 'IPPD SITUBONDO',
        'Subjudul'   => 'Microsite Dokumen IPPD Kabupaten Situbondo',
        'BannerImg'  => 'https://awsimages.detik.net.id/community/media/visual/2020/11/25/pemkab-situbondo-1_169.jpeg?w=600&q=90',
        'LogoImg'    => 'https://situbondo.info/wp-content/uploads/2024/04/logo-kabupaten-situbondo-png-3-2.png',
        'FooterText' => '© 2025 IPPD Situbondo | Kebijakan Privasi',
        'CreatedAt'  => date('Y-m-d H:i:s'),
        'UpdatedAt'  => date('Y-m-d H:i:s')
      ));
      $situbondoId = $this->db->insert_id();

      // Bab 1: Laporan
      $this->db->insert('microsite_item', array(
        'MicrositeId' => $situbondoId,
        'ParentId'    => 0,
        'Tipe'        => 'grup',
        'Judul'       => 'Laporan',
        'Icon'        => '',
        'Urutan'      => 1,
        'CreatedAt'   => date('Y-m-d H:i:s')
      ));
      $babLaporanId = $this->db->insert_id();

      $itemsLaporan = array(
        array('MicrositeId' => $situbondoId, 'ParentId' => $babLaporanId, 'Tipe' => 'link', 'Judul' => 'Kertas Kerja', 'Url' => 'https://drive.google.com/drive/folders/1D1PjEg2SiyYtfTcSS81nUA7ktighq9_0', 'Urutan' => 1, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $situbondoId, 'ParentId' => $babLaporanId, 'Tipe' => 'link', 'Judul' => 'BAB I', 'Url' => 'https://docs.google.com/document/d/1sjCyW0PEFbYkymnceodu7itLlJ1Gh5CGjsCAU3KScK8/edit?usp=sharing', 'Urutan' => 2, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $situbondoId, 'ParentId' => $babLaporanId, 'Tipe' => 'link', 'Judul' => 'BAB II', 'Url' => 'https://docs.google.com/document/d/1bjAsnY8OfR9nGamwx6Aol3gx7Yp81eaAe1U8zAqVapI/edit?usp=drive_link', 'Urutan' => 3, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $situbondoId, 'ParentId' => $babLaporanId, 'Tipe' => 'link', 'Judul' => 'BAB III', 'Url' => 'https://docs.google.com/document/d/1abbjbdWFWMFTBB_DxFCIWeOpmDso2uBOw_I_bFKhMuM/edit?usp=drive_link', 'Urutan' => 4, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $situbondoId, 'ParentId' => $babLaporanId, 'Tipe' => 'link', 'Judul' => 'BAB IV', 'Url' => '', 'Urutan' => 5, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $situbondoId, 'ParentId' => $babLaporanId, 'Tipe' => 'link', 'Judul' => 'LAPORAN PENDAHULUAN', 'Url' => '', 'Urutan' => 6, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $situbondoId, 'ParentId' => $babLaporanId, 'Tipe' => 'link', 'Judul' => 'LAPORAN AKHIR', 'Url' => '', 'Urutan' => 7, 'CreatedAt' => date('Y-m-d H:i:s'))
      );
      $this->db->insert_batch('microsite_item', $itemsLaporan);

      // Bab 2: Upload Dokumen
      $this->db->insert('microsite_item', array(
        'MicrositeId' => $situbondoId,
        'ParentId'    => 0,
        'Tipe'        => 'grup',
        'Judul'       => 'Upload Dokumen',
        'Icon'        => '',
        'Urutan'      => 2,
        'CreatedAt'   => date('Y-m-d H:i:s')
      ));
      $babUploadId = $this->db->insert_id();

      $itemsUpload = array(
        array('MicrositeId' => $situbondoId, 'ParentId' => $babUploadId, 'Tipe' => 'link', 'Judul' => 'P RENJA 2025', 'Url' => 'https://drive.google.com/drive/folders/1No92_NbtN_5DOGIXqowFexAHAOL9aAee?usp=drive_link', 'Urutan' => 1, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $situbondoId, 'ParentId' => $babUploadId, 'Tipe' => 'link', 'Judul' => 'RENSTRA 2025 - 2026', 'Url' => 'https://drive.google.com/drive/folders/186IY8jPfHb2yMvpHwXod_yLIUqA--wbR?usp=drive_link', 'Urutan' => 2, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $situbondoId, 'ParentId' => $babUploadId, 'Tipe' => 'link', 'Judul' => 'P-RKPD 2025', 'Url' => 'https://drive.google.com/drive/folders/18BaH26rpe_xs8nq2bI7xalDDX2TuefGl?usp=drive_link', 'Urutan' => 3, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $situbondoId, 'ParentId' => $babUploadId, 'Tipe' => 'link', 'Judul' => 'RPJMD 2025 - 2029', 'Url' => 'https://drive.google.com/drive/folders/1gLa2GzKXgsrN3KcDaJas3bsjt9GTutCn?usp=drive_link', 'Urutan' => 4, 'CreatedAt' => date('Y-m-d H:i:s'))
      );
      $this->db->insert_batch('microsite_item', $itemsUpload);

      // 2. Seed IPPD Banyuwangi
      $this->db->insert('microsite', array(
        'Slug'       => 'ippd-banyuwangi',
        'Judul'      => 'IPPD BANYUWANGI',
        'Subjudul'   => 'Microsite Dokumen IPPD Kabupaten Banyuwangi',
        'BannerImg'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZk60T9ljRKayq88gckmZWpC2PjxD_SzFA7Q&s',
        'LogoImg'    => 'https://pengairan.banyuwangikab.go.id/images/banyuwangi.png',
        'FooterText' => '© 2025 IPPD Banyuwangi | Kebijakan Privasi',
        'CreatedAt'  => date('Y-m-d H:i:s'),
        'UpdatedAt'  => date('Y-m-d H:i:s')
      ));
      $banyuwangiId = $this->db->insert_id();

      // Bab 1: Laporan
      $this->db->insert('microsite_item', array('MicrositeId' => $banyuwangiId, 'ParentId' => 0, 'Tipe' => 'grup', 'Judul' => 'Laporan', 'Icon' => '', 'Urutan' => 1, 'CreatedAt' => date('Y-m-d H:i:s')));
      $bwiLaporanId = $this->db->insert_id();
      $this->db->insert_batch('microsite_item', array(
        array('MicrositeId' => $banyuwangiId, 'ParentId' => $bwiLaporanId, 'Tipe' => 'link', 'Judul' => 'Kertas Kerja', 'Url' => 'https://docs.google.com/spreadsheets/d/16eVJkVTVVFNyDAmr54tVqHyPrHkVZlHl-U5lcxv8MXs/edit?usp=drive_link', 'Urutan' => 1, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $banyuwangiId, 'ParentId' => $bwiLaporanId, 'Tipe' => 'link', 'Judul' => 'Laporan', 'Url' => 'https://docs.google.com/document/d/1yORD0PP6axrGlge87tJFqsAJ9SI88x9T1qKnY3GvupM/edit?tab=t.0', 'Urutan' => 2, 'CreatedAt' => date('Y-m-d H:i:s'))
      ));

      // Bab 2: Justifikasi Penilaian
      $this->db->insert('microsite_item', array('MicrositeId' => $banyuwangiId, 'ParentId' => 0, 'Tipe' => 'grup', 'Judul' => 'Justifikasi Penilaian', 'Icon' => '', 'Urutan' => 2, 'CreatedAt' => date('Y-m-d H:i:s')));
      $bwiJustId = $this->db->insert_id();
      $this->db->insert_batch('microsite_item', array(
        array('MicrositeId' => $banyuwangiId, 'ParentId' => $bwiJustId, 'Tipe' => 'link', 'Judul' => 'Lembar Kerja - Sinergi', 'Url' => 'https://docs.google.com/spreadsheets/d/1pTxeLhUEJVpj5_hZPVkYaAwA-uo0YTd38QRuev-aHOA/edit?usp=drive_link', 'Urutan' => 1, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $banyuwangiId, 'ParentId' => $bwiJustId, 'Tipe' => 'link', 'Judul' => 'Kertas Kerja - Kualitas Perencanaan', 'Url' => 'https://docs.google.com/spreadsheets/d/1IJd37K7wsCEstzq9nou_HiNMbtzFeLnFCZYBBHpy0p4/edit?usp=drive_link', 'Urutan' => 2, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $banyuwangiId, 'ParentId' => $bwiJustId, 'Tipe' => 'link', 'Judul' => 'Lembar Kerja - Keterhubungan Perencanaan Pembangunan dengan Perencanaan Kinerja', 'Url' => 'https://docs.google.com/spreadsheets/d/16LwtXtpCH6Ri_LdRihJLeXL8JLCrbLkfe45kPX-t6VY/edit?usp=drive_link', 'Urutan' => 3, 'CreatedAt' => date('Y-m-d H:i:s'))
      ));

      // Bab 3: Upload Dokumen
      $this->db->insert('microsite_item', array('MicrositeId' => $banyuwangiId, 'ParentId' => 0, 'Tipe' => 'grup', 'Judul' => 'Upload Dokumen', 'Icon' => '', 'Urutan' => 3, 'CreatedAt' => date('Y-m-d H:i:s')));
      $bwiUpId = $this->db->insert_id();
      $this->db->insert_batch('microsite_item', array(
        array('MicrositeId' => $banyuwangiId, 'ParentId' => $bwiUpId, 'Tipe' => 'link', 'Judul' => 'RENJA SKPD Tahun 2025', 'Url' => 'https://drive.google.com/drive/folders/1m1YNSLMOjSrzbW-A2BYFWFaYyhy6346x?usp=drive_link', 'Urutan' => 1, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $banyuwangiId, 'ParentId' => $bwiUpId, 'Tipe' => 'link', 'Judul' => 'RENSTRA SKPD Tahun 2025-2029', 'Url' => 'https://drive.google.com/drive/folders/1DRSnxisnDcgYntUdFD09yX52gG9LQUdm?usp=drive_link', 'Urutan' => 2, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $banyuwangiId, 'ParentId' => $bwiUpId, 'Tipe' => 'link', 'Judul' => 'RKPD Tahun 2024 & 2025 (Murni dan Perubahan)', 'Url' => 'https://drive.google.com/drive/folders/1YvE1K3nEX1r7mSqr_LobewTEPstZSFuY?usp=drive_link', 'Urutan' => 3, 'CreatedAt' => date('Y-m-d H:i:s')),
        array('MicrositeId' => $banyuwangiId, 'ParentId' => $bwiUpId, 'Tipe' => 'link', 'Judul' => 'RPJMD Tahun 2025-2029', 'Url' => 'https://drive.google.com/drive/folders/1jOc37e73VFJWYfGzkPxJC38xXaM41RUL?usp=drive_link', 'Urutan' => 4, 'CreatedAt' => date('Y-m-d H:i:s'))
      ));
    }
  }

  /**
   * Helper untuk mengunggah gambar Foto Banner / Logo Badge
   */
  private function uploadMicrositeImage($inputName) {
    if (!isset($_FILES[$inputName]) || empty($_FILES[$inputName]['tmp_name']) || !is_uploaded_file($_FILES[$inputName]['tmp_name'])) {
      return null;
    }

    if (!is_dir('MicrositeAssets')) {
      mkdir('MicrositeAssets', 0777, true);
    }

    $file = $_FILES[$inputName];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $validExts = array('jpg', 'jpeg', 'png', 'webp', 'svg', 'gif');
    if (!in_array($ext, $validExts)) {
      return null;
    }

    $fileName = 'img_' . date('YmdHis') . '_' . uniqid() . '.' . $ext;
    $targetPath = 'MicrositeAssets/' . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
      return base_url($targetPath);
    }
    return null;
  }

  /**
   * 1. KATALOG SEMUA MICROSITE (Setiap microsite terpisah dalam kartu tersendiri)
   */
  public function Microsite(){
    $this->ensureMicrositeStructure();

    $microsites = $this->db->order_by('Id', 'ASC')->get('microsite')->result_array();
    foreach ($microsites as &$m) {
      $m['TotalBab'] = $this->db->where(array('MicrositeId' => $m['Id'], 'ParentId' => 0))->count_all_results('microsite_item');
      $m['TotalDokumen'] = $this->db->where(array('MicrositeId' => $m['Id'], 'Tipe' => 'link'))->count_all_results('microsite_item');
      $m['TotalItems'] = $this->db->where('MicrositeId', $m['Id'])->count_all_results('microsite_item');
    }

    $Data['Microsites'] = $microsites;
    $this->load->view('Staf/Header', $Data);
    $this->load->view('Staf/MicrositeKatalog', $Data);
  }

  /**
   * 2. BUILDER STRUKTUR BAB & SUB-BAB BERSARANG UNTUK SATU MICROSITE TERTENTU
   */
  public function KelolaMicrosite($id = 0){
    $this->ensureMicrositeStructure();
    $id = (int)$id;

    $microsite = $this->db->get_where('microsite', array('Id' => $id))->row_array();
    if (!$microsite) {
      redirect('Staf/Microsite');
      return;
    }

    // Ambil seluruh item untuk microsite ini
    $items = $this->db->where('MicrositeId', $id)->order_by('Urutan', 'ASC')->order_by('Id', 'ASC')->get('microsite_item')->result_array();

    // Bangun tree hirarki bersarang
    $tree = array();
    $lookup = array();
    foreach ($items as $item) {
      $item['children'] = array();
      $lookup[$item['Id']] = $item;
    }
    foreach ($lookup as $itemId => $item) {
      $pId = (int)$item['ParentId'];
      if ($pId === 0 || !isset($lookup[$pId])) {
        $tree[$itemId] = &$lookup[$itemId];
      } else {
        $lookup[$pId]['children'][] = &$lookup[$itemId];
      }
    }

    $Data['Microsite'] = $microsite;
    $Data['AllItems'] = $items;
    $Data['Tree'] = array_values($tree);

    $this->load->view('Staf/Header', $Data);
    $this->load->view('Staf/MicrositeBuilder', $Data);
  }

  /**
   * 3. TAMBAH MICROSITE BARU (Profil, Judul, Foto)
   */
  public function InputMicrosite(){
    $this->ensureMicrositeStructure();

    $judul = trim($this->input->post('Judul') ?? '');
    $slugInput = trim($this->input->post('Slug') ?? '');
    if (empty($judul)) {
      echo 'Judul Microsite wajib diisi!';
      return;
    }

    $slug = !empty($slugInput) ? url_title(strtolower($slugInput), '-', true) : url_title(strtolower($judul), '-', true);

    // Cek slug duplikat
    $existing = $this->db->get_where('microsite', array('Slug' => $slug))->row_array();
    if ($existing) {
      $slug = $slug . '-' . time();
    }

    $bannerUpload = $this->uploadMicrositeImage('BannerFile');
    $logoUpload = $this->uploadMicrositeImage('LogoFile');

    $bannerImg = $bannerUpload ?: trim($this->input->post('BannerImg') ?? '');
    $logoImg = $logoUpload ?: trim($this->input->post('LogoImg') ?? '');

    $insertData = array(
      'Slug'       => $slug,
      'Judul'      => $judul,
      'Subjudul'   => trim($this->input->post('Subjudul') ?? ''),
      'BannerImg'  => $bannerImg,
      'LogoImg'    => $logoImg,
      'FooterText' => '© ' . date('Y') . ' ' . $judul . ' | Kebijakan Privasi',
      'CreatedAt'  => date('Y-m-d H:i:s'),
      'UpdatedAt'  => date('Y-m-d H:i:s')
    );

    $this->db->insert('microsite', $insertData);
    if ($this->db->affected_rows() > 0 || $this->db->insert_id() > 0){
      echo '1';
    } else {
      $error = $this->db->error();
      echo !empty($error['message']) ? 'Gagal Input Microsite: ' . $error['message'] : 'Gagal Input Microsite!';
    }
  }

  /**
   * 4. EDIT PENGATURAN & FOTO PROFIL MICROSITE
   */
  public function EditMicrosite(){
    $this->ensureMicrositeStructure();
    $id = (int)$this->input->post('Id');
    if (empty($id)) {
      echo 'ID Microsite tidak ditemukan!';
      return;
    }

    $microsite = $this->db->get_where('microsite', array('Id' => $id))->row_array();
    if (!$microsite) {
      echo 'Microsite tidak ditemukan!';
      return;
    }

    $judul = trim($this->input->post('Judul') ?? '');
    $slugInput = trim($this->input->post('Slug') ?? '');
    if (empty($judul)) {
      echo 'Judul Microsite wajib diisi!';
      return;
    }

    $slug = !empty($slugInput) ? url_title(strtolower($slugInput), '-', true) : url_title(strtolower($judul), '-', true);
    // Cek slug duplikat
    $existing = $this->db->where('Slug', $slug)->where('Id !=', $id)->get('microsite')->row_array();
    if ($existing) {
      $slug = $slug . '-' . time();
    }

    $bannerUpload = $this->uploadMicrositeImage('BannerFile');
    $logoUpload = $this->uploadMicrositeImage('LogoFile');

    $bannerImg = $bannerUpload ?: trim($this->input->post('BannerImg') ?? ($microsite['BannerImg'] ?? ''));
    $logoImg = $logoUpload ?: trim($this->input->post('LogoImg') ?? ($microsite['LogoImg'] ?? ''));

    $updateData = array(
      'Slug'       => $slug,
      'Judul'      => $judul,
      'Subjudul'   => trim($this->input->post('Subjudul') ?? ''),
      'BannerImg'  => $bannerImg,
      'LogoImg'    => $logoImg,
      'FooterText' => '© ' . date('Y') . ' ' . $judul . ' | Kebijakan Privasi',
      'UpdatedAt'  => date('Y-m-d H:i:s')
    );

    $this->db->where('Id', $id);
    $result = $this->db->update('microsite', $updateData);
    if ($result) {
      echo '1';
    } else {
      $error = $this->db->error();
      echo !empty($error['message']) ? 'Gagal Update Microsite: ' . $error['message'] : 'Gagal Update Microsite!';
    }
  }

  /**
   * 5. HAPUS MICROSITE (Beserta seluruh item Bab & Sub-Babnya)
   */
  public function HapusMicrosite(){
    $this->ensureMicrositeStructure();
    $id = (int)$this->input->post('Id');

    $this->db->delete('microsite_item', array('MicrositeId' => $id));
    $this->db->delete('microsite', array('Id' => $id));
    if ($this->db->affected_rows() > 0){
      echo '1';
    } else {
      echo 'Gagal Menghapus Microsite!';
    }
  }

  /**
   * 6. TAMBAH BAB / SUB-BAB / DOKUMEN BERSARANG
   */
  public function InputMicrositeItem(){
    $this->ensureMicrositeStructure();

    $micrositeId = (int)$this->input->post('MicrositeId');
    $parentId = (int)($this->input->post('ParentId') ?? 0);
    $tipe = trim($this->input->post('Tipe') ?? 'grup'); // 'grup' (Bab/Sub-Bab) atau 'link' (Tombol Dokumen)
    $judul = trim($this->input->post('Judul') ?? '');
    $url = trim($this->input->post('Url') ?? '');
    $icon = trim($this->input->post('Icon') ?? '');
    $urutan = (int)($this->input->post('Urutan') ?? 0);

    if (empty($judul) || empty($micrositeId)) {
      echo 'Judul tidak boleh kosong!';
      return;
    }

    if ($urutan <= 0) {
      $maxRow = $this->db->select_max('Urutan', 'max_u')->where(array('MicrositeId' => $micrositeId, 'ParentId' => $parentId))->get('microsite_item')->row_array();
      $urutan = !empty($maxRow['max_u']) ? ((int)$maxRow['max_u'] + 1) : 1;
    }

    $insertData = array(
      'MicrositeId' => $micrositeId,
      'ParentId'    => $parentId,
      'Tipe'        => $tipe,
      'Judul'       => $judul,
      'Url'         => $url,
      'Icon'        => '',
      'Urutan'      => $urutan,
      'CreatedAt'   => date('Y-m-d H:i:s'),
      'UpdatedAt'   => date('Y-m-d H:i:s')
    );

    $this->db->insert('microsite_item', $insertData);
    if ($this->db->affected_rows() > 0 || $this->db->insert_id() > 0){
      echo '1';
    } else {
      $error = $this->db->error();
      echo !empty($error['message']) ? 'Gagal Input Item: ' . $error['message'] : 'Gagal Input Item!';
    }
  }

  /**
   * 7. EDIT BAB / SUB-BAB / DOKUMEN BERSARANG
   */
  public function EditMicrositeItem(){
    $this->ensureMicrositeStructure();

    $id = (int)$this->input->post('Id');
    $parentId = (int)($this->input->post('ParentId') ?? 0);
    $tipe = trim($this->input->post('Tipe') ?? 'grup');
    $judul = trim($this->input->post('Judul') ?? '');
    $url = trim($this->input->post('Url') ?? '');
    $urutan = (int)($this->input->post('Urutan') ?? 1);

    if (empty($id) || empty($judul)) {
      echo 'ID dan Judul wajib diisi!';
      return;
    }

    // Hindari circular parent
    if ($parentId == $id) {
      echo 'Item tidak bisa menjadi induk untuk dirinya sendiri!';
      return;
    }

    $updateData = array(
      'ParentId'  => $parentId,
      'Tipe'      => $tipe,
      'Judul'     => $judul,
      'Url'       => $url,
      'Icon'      => '',
      'Urutan'    => $urutan,
      'UpdatedAt' => date('Y-m-d H:i:s')
    );

    $this->db->where('Id', $id);
    $result = $this->db->update('microsite_item', $updateData);
    if ($result) {
      echo '1';
    } else {
      $error = $this->db->error();
      echo !empty($error['message']) ? 'Gagal Update Item: ' . $error['message'] : 'Gagal Update Item!';
    }
  }

  /**
   * 8. HAPUS BAB / SUB-BAB (Rekursif Hapus Semua Anak di Dalamnya)
   */
  public function HapusMicrositeItem(){
    $this->ensureMicrositeStructure();
    $id = (int)$this->input->post('Id');
    if (empty($id)) {
      echo 'ID Item tidak ditemukan!';
      return;
    }

    // Fungsi rekursif untuk menghapus anak-anaknya
    $deleteRecursive = function($targetId) use (&$deleteRecursive) {
      $children = $this->db->where('ParentId', $targetId)->get('microsite_item')->result_array();
      foreach ($children as $c) {
        $deleteRecursive($c['Id']);
      }
      $this->db->delete('microsite_item', array('Id' => $targetId));
    };

    $deleteRecursive($id);
    echo '1';
  }

  /**
   * 9. REORDER / DRAG & DROP URUTAN ITEM SECARA REAL-TIME
   */
  public function ReorderMicrositeItems(){
    $this->ensureMicrositeStructure();
    
    $micrositeId = (int)$this->input->post('MicrositeId');
    $items = $this->input->post('Items'); // Array of Item IDs in desired sequence
    
    if (empty($micrositeId) || empty($items) || !is_array($items)) {
      echo json_encode(array('status' => 'error', 'message' => 'Data urutan tidak valid!'));
      return;
    }

    $order = 1;
    foreach ($items as $itemId) {
      $itemId = (int)$itemId;
      if ($itemId > 0) {
        $this->db->where(array('Id' => $itemId, 'MicrositeId' => $micrositeId))->update('microsite_item', array(
          'Urutan'    => $order,
          'UpdatedAt' => date('Y-m-d H:i:s')
        ));
        $order++;
      }
    }

    echo json_encode(array('status' => 'success', 'message' => 'Urutan berhasil disimpan!'));
  }
}