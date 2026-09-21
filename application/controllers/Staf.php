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

  /**
   * =========================================================================
   * MODUL OLAH DATA BERDASARKAN DAERAH, INDIKATOR, GENDER, DAN TAHUN DINAMIS
   * =========================================================================
   */
  private function ensureOlahDataStructure() {
    $this->db->query("CREATE TABLE IF NOT EXISTS `olah_data_daerah` (
      `Id` INT(11) NOT NULL AUTO_INCREMENT,
      `NamaDaerah` VARCHAR(255) NOT NULL,
      `Keterangan` TEXT NULL,
      `TahunList` TEXT NULL,
      `CreatedAt` DATETIME NULL,
      `UpdatedAt` DATETIME NULL,
      PRIMARY KEY (`Id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    $this->db->query("CREATE TABLE IF NOT EXISTS `olah_data_indikator` (
      `Id` INT(11) NOT NULL AUTO_INCREMENT,
      `DaerahId` INT(11) NOT NULL,
      `NamaIndikator` VARCHAR(255) NOT NULL,
      `Kategori` VARCHAR(100) NULL,
      `Gender` VARCHAR(50) NULL DEFAULT 'Total',
      `Satuan` VARCHAR(100) NULL,
      `DataTahun` TEXT NULL,
      `Keterangan` TEXT NULL,
      `Urutan` INT(11) NOT NULL DEFAULT 1,
      `CreatedAt` DATETIME NULL,
      `UpdatedAt` DATETIME NULL,
      PRIMARY KEY (`Id`),
      KEY `idx_daerah_id` (`DaerahId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Pastikan kolom Kategori, ApiUrl, dan TipeSumber tersedia jika tabel sudah terbentuk sebelumnya
    if (!$this->db->field_exists('Kategori', 'olah_data_indikator')) {
      $this->db->query("ALTER TABLE `olah_data_indikator` ADD COLUMN `Kategori` VARCHAR(100) NULL AFTER `NamaIndikator`");
    }
    if (!$this->db->field_exists('ApiUrl', 'olah_data_indikator')) {
      $this->db->query("ALTER TABLE `olah_data_indikator` ADD COLUMN `ApiUrl` VARCHAR(1000) NULL AFTER `DataTahun`");
    }
    if (!$this->db->field_exists('TipeSumber', 'olah_data_indikator')) {
      $this->db->query("ALTER TABLE `olah_data_indikator` ADD COLUMN `TipeSumber` ENUM('manual', 'api') DEFAULT 'manual' AFTER `ApiUrl`");
    }
  }

  public function OlahData(){
    $this->ensureOlahDataStructure();

    $daerahList = $this->db->order_by('Id', 'ASC')->get('olah_data_daerah')->result_array();

    // Hitung jumlah indikator dan rentang tahun untuk setiap daerah
    foreach ($daerahList as &$d) {
      $d['TotalIndikator'] = $this->db->where('DaerahId', $d['Id'])->count_all_results('olah_data_indikator');
      $years = json_decode($d['TahunList'] ?? '[]', true) ?: array();
      $d['YearsCount'] = count($years);
      if (!empty($years)) {
        sort($years, SORT_NUMERIC);
        $d['RentangTahun'] = min($years) . ' - ' . max($years);
      } else {
        $d['RentangTahun'] = '-';
      }
    }
    unset($d);

    $daerahId = (int)$this->input->get('daerah_id');
    $activeDaerah = null;

    // Hanya aktifkan detail jika user secara spesifik membuka suatu daerah (?daerah_id=X)
    if ($daerahId > 0) {
      foreach ($daerahList as $d) {
        if ((int)$d['Id'] === $daerahId) {
          $activeDaerah = $d;
          break;
        }
      }
    }

    $tahunList = array();
    $indikatorList = array();

    if ($activeDaerah) {
      $decodedYears = json_decode($activeDaerah['TahunList'] ?? '[]', true);
      if (is_array($decodedYears) && !empty($decodedYears)) {
        sort($decodedYears, SORT_NUMERIC);
        $tahunList = $decodedYears;
      }

      $rawIndikator = $this->db->where('DaerahId', $daerahId)->order_by('Urutan', 'ASC')->order_by('Id', 'ASC')->get('olah_data_indikator')->result_array();
      foreach ($rawIndikator as $item) {
        $item['DataTahunParsed'] = json_decode($item['DataTahun'] ?? '{}', true) ?: array();
        $indikatorList[] = $item;
      }
    }

    $Data['title'] = $activeDaerah ? 'Olah Data: ' . $activeDaerah['NamaDaerah'] . ' | IDE Consultant' : 'Katalog Daerah Olah Data | IDE Consultant';
    $Data['DaerahList'] = $daerahList;
    $Data['ActiveDaerah'] = $activeDaerah;
    $Data['TahunList'] = $tahunList;
    $Data['IndikatorList'] = $indikatorList;

    $this->load->view('Staf/Header', $Data);
    $this->load->view('Staf/OlahData', $Data);
  }

  public function InputDaerah(){
    $this->ensureOlahDataStructure();

    $nama = trim($this->input->post('NamaDaerah') ?? '');
    if (empty($nama)) {
      echo 'Nama Daerah wajib diisi!';
      return;
    }

    $tahunInput = trim($this->input->post('TahunList') ?? '');
    $tahunArr = array();
    if (!empty($tahunInput)) {
      $rawYears = preg_split('/[\s,]+/', $tahunInput);
      foreach ($rawYears as $y) {
        $y = trim($y);
        if (preg_match('/^\d{4}$/', $y) && !in_array($y, $tahunArr)) {
          $tahunArr[] = $y;
        }
      }
    }

    if (empty($tahunArr)) {
      $currentYear = (int)date('Y');
      for ($y = $currentYear - 4; $y <= $currentYear; $y++) {
        $tahunArr[] = (string)$y;
      }
    }
    sort($tahunArr, SORT_NUMERIC);

    $now = date('Y-m-d H:i:s');
    $this->db->insert('olah_data_daerah', array(
      'NamaDaerah' => $nama,
      'Keterangan' => trim($this->input->post('Keterangan') ?? ''),
      'TahunList'  => json_encode($tahunArr),
      'CreatedAt'  => $now,
      'UpdatedAt'  => $now
    ));

    if ($this->db->affected_rows() > 0) {
      $newId = $this->db->insert_id();
      echo json_encode(array('status' => 'success', 'id' => $newId));
    } else {
      echo json_encode(array('status' => 'error', 'message' => 'Gagal menambahkan daerah!'));
    }
  }

  public function EditDaerah(){
    $this->ensureOlahDataStructure();

    $id = (int)$this->input->post('Id');
    $nama = trim($this->input->post('NamaDaerah') ?? '');
    if ($id <= 0 || empty($nama)) {
      echo 'Data daerah tidak valid!';
      return;
    }

    $this->db->where('Id', $id)->update('olah_data_daerah', array(
      'NamaDaerah' => $nama,
      'Keterangan' => trim($this->input->post('Keterangan') ?? ''),
      'UpdatedAt'  => date('Y-m-d H:i:s')
    ));

    echo '1';
  }

  public function HapusDaerah(){
    $this->ensureOlahDataStructure();

    $id = (int)$this->input->post('Id');
    if ($id <= 0) {
      echo 'ID daerah tidak valid!';
      return;
    }

    $this->db->where('DaerahId', $id)->delete('olah_data_indikator');
    $this->db->where('Id', $id)->delete('olah_data_daerah');
    echo '1';
  }

  public function TambahTahun(){
    $this->ensureOlahDataStructure();

    $daerahId = (int)$this->input->post('DaerahId');
    $tahun = trim($this->input->post('Tahun') ?? '');

    if ($daerahId <= 0 || !preg_match('/^\d{4}$/', $tahun)) {
      echo 'Tahun harus berupa 4 digit angka (misal: 2025)!';
      return;
    }

    $daerah = $this->db->get_where('olah_data_daerah', array('Id' => $daerahId))->row_array();
    if (!$daerah) {
      echo 'Daerah tidak ditemukan!';
      return;
    }

    $years = json_decode($daerah['TahunList'] ?? '[]', true) ?: array();
    if (in_array($tahun, $years)) {
      echo 'Tahun ' . $tahun . ' sudah ada di daerah ini!';
      return;
    }

    $years[] = $tahun;
    sort($years, SORT_NUMERIC);

    $this->db->where('Id', $daerahId)->update('olah_data_daerah', array(
      'TahunList' => json_encode($years),
      'UpdatedAt' => date('Y-m-d H:i:s')
    ));

    echo '1';
  }

  public function HapusTahun(){
    $this->ensureOlahDataStructure();

    $daerahId = (int)$this->input->post('DaerahId');
    $tahun = trim($this->input->post('Tahun') ?? '');

    if ($daerahId <= 0 || empty($tahun)) {
      echo 'Parameter tidak valid!';
      return;
    }

    $daerah = $this->db->get_where('olah_data_daerah', array('Id' => $daerahId))->row_array();
    if (!$daerah) {
      echo 'Daerah tidak ditemukan!';
      return;
    }

    $years = json_decode($daerah['TahunList'] ?? '[]', true) ?: array();
    $newYears = array();
    foreach ($years as $y) {
      if ((string)$y !== (string)$tahun) {
        $newYears[] = (string)$y;
      }
    }
    sort($newYears, SORT_NUMERIC);

    $this->db->where('Id', $daerahId)->update('olah_data_daerah', array(
      'TahunList' => json_encode($newYears),
      'UpdatedAt' => date('Y-m-d H:i:s')
    ));

    echo '1';
  }

  /**
   * Endpoint Preview/Uji Penarikan Data dari URL API atau String JSON (Mendukung Tabel Penuh / Multi-Indikator)
   */
  public function PreviewApiIndikator(){
    $this->ensureOlahDataStructure();

    $apiSource = trim($this->input->post('ApiSource') ?? '');
    if (empty($apiSource)) {
      echo json_encode(array('status' => 'error', 'message' => 'Silakan masukkan URL API atau paste kode JSON.'));
      return;
    }

    $result = $this->parseTableApiJson($apiSource);
    // Selalu sertakan properti flat indikator pertama agar form API otomatis terisi lengkap
    if ($result['status'] === 'success' && !empty($result['indicators'])) {
      $first = $result['indicators'][0];
      $result['DataTahun'] = $first['DataTahun'];
      $result['NamaIndikator'] = $first['NamaIndikator'];
      $result['Kategori'] = $first['Kategori'];
      $result['Gender'] = $first['Gender'] ?: 'Total';
      $result['Satuan'] = $first['Satuan'];
      $result['Keterangan'] = !empty($first['Keterangan']) ? $first['Keterangan'] : (!empty($result['global_keterangan']) ? $result['global_keterangan'] : '');
      $result['TotalTahun'] = count($first['DataTahun']);
    }
    echo json_encode($result);
  }

  /**
   * Helper Cerdas untuk Mengurai Tabel Penuh dari API / JSON (Bisa Multi-Indikator Sekaligus)
   */
  private function parseTableApiJson($inputSource) {
    $inputSource = trim($inputSource ?? '');
    if (empty($inputSource)) {
      return array('status' => 'error', 'message' => 'Sumber API atau teks JSON tidak boleh kosong.');
    }

    $rawJson = '';
    if (preg_match('/^https?:\/\//i', $inputSource)) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $inputSource);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 20);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json, text/plain, */*'));
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) CVIDE-OlahData/1.0');
      $rawJson = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $curlError = curl_error($ch);
      curl_close($ch);

      if ($rawJson === false || !empty($curlError)) {
        return array('status' => 'error', 'message' => 'Gagal menghubungi API: ' . ($curlError ?: 'Koneksi gagal / URL tidak merespons.'));
      }
      if ($httpCode >= 400) {
        return array('status' => 'error', 'message' => 'Server API mengembalikan kode status error HTTP ' . $httpCode);
      }
    } else {
      $rawJson = $inputSource;
    }

    $data = json_decode($rawJson, true);
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
      return array('status' => 'error', 'message' => 'Respon bukan format JSON yang valid (' . json_last_error_msg() . ').');
    }

    // Cari letak list/array utama baris data & tangkap metadata global di root
    $itemList = null;
    $globalMeta = array(
      'nama_indikator' => '',
      'kategori'       => '',
      'satuan'         => '',
      'gender'         => 'Total',
      'keterangan'     => ''
    );

    if (is_array($data)) {
      // Cek apakah data root adalah list numerik
      if (isset($data[0]) || (array_keys($data) === range(0, count($data) - 1))) {
        $itemList = $data;
      } else {
        // Cek metadata di root
        foreach ($data as $k => $v) {
          if (is_scalar($v) && !empty($v)) {
            $kl = strtolower((string)$k);
            if (empty($globalMeta['nama_indikator']) && in_array($kl, array('nama_indikator', 'indikator', 'indicator', 'nama', 'title', 'judul', 'uraian', 'variabel', 'variable', 'label', 'nama_data', 'aspek'))) {
              $globalMeta['nama_indikator'] = (string)$v;
            }
            if (empty($globalMeta['kategori']) && in_array($kl, array('kategori', 'category', 'bidang', 'sektor'))) {
              $globalMeta['kategori'] = (string)$v;
            }
            if (empty($globalMeta['satuan']) && in_array($kl, array('satuan', 'unit', 'satuan_data', 'measurement'))) {
              $globalMeta['satuan'] = (string)$v;
            }
            if (in_array($kl, array('gender', 'jenis_kelamin', 'sex'))) {
              $globalMeta['gender'] = (string)$v;
            }
            if (empty($globalMeta['keterangan']) && in_array($kl, array('keterangan', 'catatan', 'note', 'description', 'desc', 'sumber', 'source'))) {
              $globalMeta['keterangan'] = (string)$v;
            }
          }
        }

        // Cari child array yang berisi list baris
        foreach (array('data', 'result', 'rows', 'indikator', 'indicators', 'dataset', 'items', 'content', 'series', 'values') as $prop) {
          if (isset($data[$prop]) && is_array($data[$prop])) {
            $itemList = $data[$prop];
            break;
          }
        }
      }
    }

    if (!is_array($itemList) || empty($itemList)) {
      // Jika root bukan list tapi single object indikator
      $single = $this->parseJsonIndikatorData($rawJson);
      if ($single['status'] === 'success') {
        $singleItem = array(
          'NamaIndikator' => $single['NamaIndikator'] ?: ($globalMeta['nama_indikator'] ?: 'Indikator API'),
          'Kategori'      => $single['Kategori'] ?: $globalMeta['kategori'],
          'Gender'        => $single['Gender'] ?: $globalMeta['gender'],
          'Satuan'        => $single['Satuan'] ?: $globalMeta['satuan'],
          'Keterangan'    => $globalMeta['keterangan'] ?: '',
          'DataTahun'     => $single['DataTahun']
        );
        return array(
          'status'            => 'success',
          'is_multi'          => false,
          'total_indikator'   => 1,
          'all_years'         => $single['Years'],
          'indicators'        => array($singleItem),
          'global_keterangan' => $globalMeta['keterangan']
        );
      }
      return array('status' => 'error', 'message' => 'Tidak dapat menemukan kumpulan data tahun & nilai di dalam respon JSON.');
    }

    // Cek apakah ada baris yang memiliki nama indikator eksplisit
    $hasExplicitIndicatorColumn = false;
    foreach ($itemList as $checkItem) {
      if (is_array($checkItem)) {
        foreach ($checkItem as $ck => $cv) {
          if (is_scalar($cv) && !empty($cv)) {
            $ckl = strtolower((string)$ck);
            if (in_array($ckl, array('nama_indikator', 'indikator', 'indicator', 'title', 'judul', 'uraian', 'variabel', 'variable', 'label', 'nama_data', 'aspek'))) {
              $hasExplicitIndicatorColumn = true;
              break 2;
            }
          }
        }
      }
    }

    // Proses $itemList (setiap elemen bisa mewakili 1 indikator, atau baris per tahun)
    $allYearsSet = array();
    $groupedByName = array();

    foreach ($itemList as $idx => $item) {
      if (!is_array($item)) continue;

      // 1. Cari Nama Indikator
      $namaInd = '';
      foreach ($item as $k => $v) {
        if (is_scalar($v) && !empty($v)) {
          $kl = strtolower((string)$k);
          if (in_array($kl, array('nama_indikator', 'indikator', 'indicator', 'nama', 'title', 'judul', 'uraian', 'variabel', 'variable', 'label', 'nama_data', 'aspek'))) {
            $namaInd = trim((string)$v);
            break;
          }
        }
      }

      // 2. Kategori, Gender, Satuan
      $kategori = $globalMeta['kategori'];
      $gender = $globalMeta['gender'];
      $satuan = $globalMeta['satuan'];
      $keterangan = $globalMeta['keterangan'];

      foreach ($item as $k => $v) {
        if (is_scalar($v) && !empty($v)) {
          $kl = strtolower((string)$k);
          if (empty($kategori) && in_array($kl, array('kategori', 'category', 'bidang', 'sektor'))) $kategori = (string)$v;
          if (in_array($kl, array('gender', 'jenis_kelamin', 'sex'))) $gender = (string)$v;
          if (empty($satuan) && in_array($kl, array('satuan', 'unit', 'measurement', 'satuan_data'))) $satuan = (string)$v;
          if (empty($keterangan) && in_array($kl, array('keterangan', 'catatan', 'note', 'description', 'desc', 'sumber', 'source'))) $keterangan = (string)$v;
        }
      }

      // 3. Cari Data Tahun & Nilai
      $dataTahun = array();

      // Kasus A: Tahun adalah key 4 digit langsung {"2020": 71.5, "2021": 72.3}
      foreach ($item as $k => $v) {
        if (preg_match('/^(19|20)\d{2}$/', (string)$k) && (is_numeric($v) || (is_string($v) && strlen($v) < 20))) {
          $dataTahun[(string)$k] = (string)$v;
          $allYearsSet[(string)$k] = true;
        }
      }

      // Kasus B: Objek memiliki properti 'tahun' dan 'nilai' (Tidy format baris tunggal)
      if (empty($dataTahun)) {
        $singleYear = null;
        $singleVal = null;
        foreach ($item as $k => $v) {
          $kl = strtolower((string)$k);
          if (in_array($kl, array('tahun', 'year', 'th', 'thn', 'periode', 'period'))) {
            if (preg_match('/\b(19|20\d{2})\b/', (string)$v, $ym)) {
              $singleYear = $ym[1];
            }
          }
          if (in_array($kl, array('nilai', 'value', 'val', 'angka', 'jumlah', 'total', 'score', 'data', 'realisasi', 'persentase', 'hasil'))) {
            if (is_scalar($v) && (string)$v !== '') {
              $singleVal = (string)$v;
            }
          }
        }
        if ($singleYear && $singleVal !== null) {
          $dataTahun[(string)$singleYear] = (string)$singleVal;
          $allYearsSet[(string)$singleYear] = true;
        }
      }

      // Kasus C: Objek memiliki child array 'data_tahun' / 'series' / 'values'
      if (empty($dataTahun)) {
        foreach (array('data_tahun', 'tahun', 'series', 'values', 'datapoints') as $childKey) {
          if (isset($item[$childKey]) && is_array($item[$childKey])) {
            foreach ($item[$childKey] as $ck => $cv) {
              if (preg_match('/^(19|20)\d{2}$/', (string)$ck) && is_scalar($cv)) {
                $dataTahun[(string)$ck] = (string)$cv;
                $allYearsSet[(string)$ck] = true;
              } elseif (is_array($cv)) {
                $cy = null; $cval = null;
                foreach ($cv as $k2 => $v2) {
                  $k2l = strtolower((string)$k2);
                  if (in_array($k2l, array('tahun', 'year', 'th', 'thn', 'periode'))) {
                    if (preg_match('/\b(19|20\d{2})\b/', (string)$v2, $m2)) $cy = $m2[1];
                  }
                  if (in_array($k2l, array('nilai', 'value', 'val', 'angka', 'jumlah', 'score'))) {
                    if (is_scalar($v2)) $cval = (string)$v2;
                  }
                }
                if ($cy && $cval !== null) {
                  $dataTahun[(string)$cy] = (string)$cval;
                  $allYearsSet[(string)$cy] = true;
                }
              }
            }
            break;
          }
        }
      }

      if (empty($namaInd)) {
        if (!empty($globalMeta['nama_indikator'])) {
          $namaInd = $globalMeta['nama_indikator'];
        } elseif (!$hasExplicitIndicatorColumn) {
          $namaInd = 'Indikator API';
        } else {
          $namaInd = 'Indikator ' . ($idx + 1);
        }
      }

      // Grouping jika nama indikator sama (format tidy data per tahun)
      if (isset($groupedByName[$namaInd])) {
        foreach ($dataTahun as $y => $v) {
          $groupedByName[$namaInd]['DataTahun'][(string)$y] = $v;
        }
        if (empty($groupedByName[$namaInd]['Kategori']) && !empty($kategori)) $groupedByName[$namaInd]['Kategori'] = $kategori;
        if (empty($groupedByName[$namaInd]['Satuan']) && !empty($satuan)) $groupedByName[$namaInd]['Satuan'] = $satuan;
      } else {
        $groupedByName[$namaInd] = array(
          'NamaIndikator' => $namaInd,
          'Kategori'      => $kategori,
          'Gender'        => $gender ?: 'Total',
          'Satuan'        => $satuan,
          'Keterangan'    => $keterangan,
          'DataTahun'     => $dataTahun
        );
      }
    }

    $finalList = array_values($groupedByName);
    $sortedYears = array_keys($allYearsSet);
    sort($sortedYears, SORT_NUMERIC);

    if (empty($finalList) || empty($sortedYears)) {
      return array('status' => 'error', 'message' => 'Gagal membaca baris indikator atau kolom tahun dari API. Pastikan JSON memiliki format tabel atau array indikator.');
    }

    return array(
      'status'          => 'success',
      'is_multi'        => count($finalList) > 1,
      'total_indikator' => count($finalList),
      'all_years'       => $sortedYears,
      'indicators'      => $finalList
    );
  }

  /**
   * Endpoint Impor Seluruh Tabel Indikator & Kolom Tahun dari API / JSON
   */
  public function ImportTabelApi(){
    $this->ensureOlahDataStructure();

    $daerahId = (int)$this->input->post('DaerahId');
    if ($daerahId <= 0) {
      echo json_encode(array('status' => 'error', 'message' => 'Daerah tidak valid.'));
      return;
    }

    $apiSource = trim($this->input->post('ApiSource') ?? '');
    if (empty($apiSource)) {
      echo json_encode(array('status' => 'error', 'message' => 'Silakan masukkan URL API atau paste kode JSON.'));
      return;
    }

    $mode = trim($this->input->post('Mode') ?? 'tambah'); // 'tambah' atau 'replace'

    $parsed = $this->parseTableApiJson($apiSource);
    if ($parsed['status'] !== 'success') {
      echo json_encode($parsed);
      return;
    }

    $indicators = $parsed['indicators'];
    $newYears = $parsed['all_years'];

    // 1. Update TahunList Daerah agar semua kolom tahun dari API langsung aktif
    $daerah = $this->db->get_where('olah_data_daerah', array('Id' => $daerahId))->row_array();
    if (!$daerah) {
      echo json_encode(array('status' => 'error', 'message' => 'Data Daerah tidak ditemukan.'));
      return;
    }

    $currentYears = json_decode($daerah['TahunList'] ?? '[]', true) ?: array();
    if ($mode === 'replace') {
      $currentYears = $newYears;
    } else {
      foreach ($newYears as $y) {
        if (!in_array((string)$y, $currentYears)) {
          $currentYears[] = (string)$y;
        }
      }
    }
    sort($currentYears, SORT_NUMERIC);

    $this->db->where('Id', $daerahId)->update('olah_data_daerah', array(
      'TahunList' => json_encode($currentYears),
      'UpdatedAt' => date('Y-m-d H:i:s')
    ));

    // 2. Jika mode replace: bersihkan indikator lama daerah ini
    if ($mode === 'replace') {
      $this->db->where('DaerahId', $daerahId)->delete('olah_data_indikator');
    }

    // 3. Masukkan seluruh indikator dari API ke database
    $now = date('Y-m-d H:i:s');
    $insertedCount = 0;
    $isUrl = preg_match('/^https?:\/\//i', $apiSource);

    foreach ($indicators as $idx => $ind) {
      $this->db->insert('olah_data_indikator', array(
        'DaerahId'      => $daerahId,
        'NamaIndikator' => $ind['NamaIndikator'],
        'Kategori'      => $ind['Kategori'] ?? '',
        'Gender'        => $ind['Gender'] ?? 'Total',
        'Satuan'        => $ind['Satuan'] ?? '',
        'DataTahun'     => json_encode($ind['DataTahun'] ?? array()),
        'ApiUrl'        => $isUrl ? $apiSource : NULL,
        'TipeSumber'    => $isUrl ? 'api' : 'manual',
        'Keterangan'    => $ind['Keterangan'] ?? 'Diimpor otomatis dari API',
        'Urutan'        => $idx + 1,
        'CreatedAt'     => $now,
        'UpdatedAt'     => $now
      ));
      if ($this->db->affected_rows() > 0) {
        $insertedCount++;
      }
    }

    echo json_encode(array(
      'status'  => 'success',
      'message' => "Berhasil mengimpor $insertedCount indikator dan " . count($currentYears) . " kolom tahun ke dalam tabel!",
      'total'   => $insertedCount,
      'years'   => $currentYears
    ));
  }

  /**
   * Helper Parser Cerdas untuk Response API JSON (URL atau String JSON)
   */
  private function parseJsonIndikatorData($inputSource) {
    $inputSource = trim($inputSource ?? '');
    if (empty($inputSource)) {
      return array('status' => 'error', 'message' => 'Sumber API atau JSON tidak boleh kosong.');
    }

    $rawJson = '';
    // Jika diawali http:// atau https:// -> panggil via cURL
    if (preg_match('/^https?:\/\//i', $inputSource)) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $inputSource);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 15);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json, text/plain, */*'));
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) CVIDE-OlahData/1.0');
      $rawJson = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $curlError = curl_error($ch);
      curl_close($ch);

      if ($rawJson === false || !empty($curlError)) {
        return array('status' => 'error', 'message' => 'Gagal menghubungi API: ' . ($curlError ?: 'Koneksi gagal / URL tidak merespons.'));
      }
      if ($httpCode >= 400) {
        return array('status' => 'error', 'message' => 'Server API mengembalikan respon error HTTP ' . $httpCode);
      }
    } else {
      $rawJson = $inputSource;
    }

    $data = json_decode($rawJson, true);
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
      return array('status' => 'error', 'message' => 'Format respon bukan JSON yang valid (' . json_last_error_msg() . ').');
    }

    // Parsing data tahun & nilai, serta metadata (satuan, kategori, gender, indikator)
    $parsedTahun = array();
    $metadata = array(
      'Satuan' => '',
      'Kategori' => '',
      'Gender' => 'Total',
      'NamaIndikator' => ''
    );

    $this->extractDataFromJsonNode($data, $parsedTahun, $metadata);

    // Urutkan tahun numerik (ASC)
    uksort($parsedTahun, function($a, $b) {
      return (int)$a <=> (int)$b;
    });

    if (empty($parsedTahun)) {
      return array('status' => 'error', 'message' => 'Tidak ditemukan data tahun (format 4 digit seperti 2020, 2021) atau angka nilai di dalam respon JSON.');
    }

    return array(
      'status'        => 'success',
      'DataTahun'     => $parsedTahun,
      'Years'         => array_keys($parsedTahun),
      'Satuan'        => $metadata['Satuan'],
      'Kategori'      => $metadata['Kategori'],
      'Gender'        => $metadata['Gender'],
      'NamaIndikator' => $metadata['NamaIndikator'],
      'TotalTahun'    => count($parsedTahun)
    );
  }

  /**
   * Rekursif / Heuristik untuk mengekstrak tahun dan nilai dari aneka format JSON
   */
  private function extractDataFromJsonNode($node, &$parsedTahun, &$metadata) {
    if (!is_array($node)) return;

    // Cek metadata umum di level objek
    foreach ($node as $k => $v) {
      if (is_scalar($v)) {
        $kLower = strtolower((string)$k);
        if (empty($metadata['Satuan']) && in_array($kLower, array('satuan', 'unit', 'measurement', 'satuan_data', 'satuan_nama'))) {
          $metadata['Satuan'] = (string)$v;
        }
        if (empty($metadata['Kategori']) && in_array($kLower, array('kategori', 'category', 'bidang', 'sektor'))) {
          $metadata['Kategori'] = (string)$v;
        }
        if (in_array($kLower, array('gender', 'jenis_kelamin', 'sex'))) {
          $metadata['Gender'] = (string)$v;
        }
        if (empty($metadata['NamaIndikator']) && in_array($kLower, array('nama_indikator', 'indikator', 'indicator', 'title', 'judul', 'nama'))) {
          $metadata['NamaIndikator'] = (string)$v;
        }
      }
    }

    // Pola 1: Key adalah tahun 4 digit langsung (misal: {"2020": 72.5, "2021": 73.1})
    $hasDirectYearKeys = false;
    foreach ($node as $k => $v) {
      if (preg_match('/^(19|20)\d{2}$/', (string)$k) && (is_numeric($v) || (is_string($v) && strlen($v) < 20))) {
        $parsedTahun[(string)$k] = (string)$v;
        $hasDirectYearKeys = true;
      }
    }
    if ($hasDirectYearKeys) {
      return;
    }

    // Pola 2: Node adalah array of items (misal: [{"tahun": 2020, "nilai": 72.5}, ...])
    $isListOfItems = isset($node[0]) || (array_keys($node) === range(0, count($node) - 1));
    if ($isListOfItems) {
      foreach ($node as $item) {
        if (is_array($item)) {
          $itemYear = null;
          $itemVal = null;

          // Cari key tahun
          foreach ($item as $ik => $iv) {
            $ikLower = strtolower((string)$ik);
            if (in_array($ikLower, array('tahun', 'year', 'th', 'thn', 'periode', 'period', 'label', 'time', 'date'))) {
              if (preg_match('/\b(19|20\d{2})\b/', (string)$iv, $m)) {
                $itemYear = $m[1];
              }
            }
          }
          if (!$itemYear) {
            foreach ($item as $ik => $iv) {
              if (is_scalar($iv) && preg_match('/^(19|20)\d{2}$/', trim((string)$iv))) {
                $itemYear = trim((string)$iv);
                break;
              }
            }
          }

          // Cari key nilai
          foreach ($item as $ik => $iv) {
            $ikLower = strtolower((string)$ik);
            if (in_array($ikLower, array('nilai', 'value', 'val', 'angka', 'jumlah', 'total', 'score', 'data', 'realisasi', 'persentase', 'hasil'))) {
              if (is_scalar($iv) && (string)$iv !== '') {
                $itemVal = (string)$iv;
                break;
              }
            }
          }
          if ($itemYear && $itemVal === null) {
            foreach ($item as $ik => $iv) {
              if (is_scalar($iv) && is_numeric($iv) && (string)$iv !== (string)$itemYear) {
                $itemVal = (string)$iv;
                break;
              }
            }
          }

          if ($itemYear && $itemVal !== null) {
            $parsedTahun[(string)$itemYear] = (string)$itemVal;
          } else {
            $this->extractDataFromJsonNode($item, $parsedTahun, $metadata);
          }
        }
      }
      return;
    }

    // Pola 3: Traversing objek bersarang (misal {"result": {"data": ...}})
    foreach ($node as $k => $v) {
      if (is_array($v)) {
        $this->extractDataFromJsonNode($v, $parsedTahun, $metadata);
      }
    }
  }

  public function InputIndikator(){
    $this->ensureOlahDataStructure();

    $daerahId = (int)$this->input->post('DaerahId');
    $namaIndikator = trim($this->input->post('NamaIndikator') ?? '');
    if ($daerahId <= 0 || empty($namaIndikator)) {
      echo 'Nama Indikator wajib diisi!';
      return;
    }

    $apiUrl = trim($this->input->post('ApiUrl') ?? '');
    $tipeSumber = !empty($apiUrl) ? 'api' : 'manual';

    $dataTahun = array();
    $nilaiTahunPost = $this->input->post('NilaiTahun');
    if (is_array($nilaiTahunPost)) {
      foreach ($nilaiTahunPost as $thn => $val) {
        $valClean = trim($val ?? '');
        if ($valClean !== '') {
          $dataTahun[(string)$thn] = $valClean;
        }
      }
    }

    // Jika API diisi tetapi data tahun belum ada atau mode API langsung
    if (!empty($apiUrl) && empty($dataTahun)) {
      $parsedTable = $this->parseTableApiJson($apiUrl);
      if ($parsedTable['status'] === 'success' && !empty($parsedTable['indicators'])) {
        $first = $parsedTable['indicators'][0];
        $dataTahun = $first['DataTahun'];
        if (empty($_POST['Satuan']) && !empty($first['Satuan'])) {
          $_POST['Satuan'] = $first['Satuan'];
        }
        if (empty($_POST['Kategori']) && !empty($first['Kategori'])) {
          $_POST['Kategori'] = $first['Kategori'];
        }
        if (empty($_POST['Keterangan']) && !empty($first['Keterangan'])) {
          $_POST['Keterangan'] = $first['Keterangan'];
        }
      } else {
        $parsed = $this->parseJsonIndikatorData($apiUrl);
        if ($parsed['status'] === 'success') {
          $dataTahun = $parsed['DataTahun'];
          if (empty($_POST['Satuan']) && !empty($parsed['Satuan'])) {
            $_POST['Satuan'] = $parsed['Satuan'];
          }
          if (empty($_POST['Kategori']) && !empty($parsed['Kategori'])) {
            $_POST['Kategori'] = $parsed['Kategori'];
          }
        }
      }
    }

    // Periksa apakah ada tahun baru yang belum terdaftar pada Daerah ini
    if (!empty($dataTahun)) {
      $daerah = $this->db->get_where('olah_data_daerah', array('Id' => $daerahId))->row_array();
      if ($daerah) {
        $currentYears = json_decode($daerah['TahunList'] ?? '[]', true) ?: array();
        $hasNewYear = false;
        foreach (array_keys($dataTahun) as $y) {
          if (!in_array((string)$y, $currentYears)) {
            $currentYears[] = (string)$y;
            $hasNewYear = true;
          }
        }
        if ($hasNewYear) {
          sort($currentYears, SORT_NUMERIC);
          $this->db->where('Id', $daerahId)->update('olah_data_daerah', array(
            'TahunList' => json_encode($currentYears),
            'UpdatedAt' => date('Y-m-d H:i:s')
          ));
        }
      }
    }

    $now = date('Y-m-d H:i:s');
    $this->db->insert('olah_data_indikator', array(
      'DaerahId'      => $daerahId,
      'NamaIndikator' => $namaIndikator,
      'Kategori'      => trim($this->input->post('Kategori') ?? ''),
      'Gender'        => trim($this->input->post('Gender') ?? 'Total'),
      'Satuan'        => trim($this->input->post('Satuan') ?? ''),
      'DataTahun'     => json_encode($dataTahun),
      'ApiUrl'        => $apiUrl ?: NULL,
      'TipeSumber'    => $tipeSumber,
      'Keterangan'    => trim($this->input->post('Keterangan') ?? ''),
      'Urutan'        => (int)($this->input->post('Urutan') ?? 1),
      'CreatedAt'     => $now,
      'UpdatedAt'     => $now
    ));

    if ($this->db->affected_rows() > 0) {
      echo '1';
    } else {
      echo 'Gagal menyimpan indikator!';
    }
  }

  public function EditIndikator(){
    $this->ensureOlahDataStructure();

    $id = (int)$this->input->post('Id');
    $namaIndikator = trim($this->input->post('NamaIndikator') ?? '');
    if ($id <= 0 || empty($namaIndikator)) {
      echo 'Nama Indikator wajib diisi!';
      return;
    }

    $apiUrl = trim($this->input->post('ApiUrl') ?? '');
    $tipeSumber = !empty($apiUrl) ? 'api' : 'manual';

    $nilaiTahunPost = $this->input->post('NilaiTahun');
    $dataTahun = array();
    if (is_array($nilaiTahunPost)) {
      foreach ($nilaiTahunPost as $thn => $val) {
        $valClean = trim($val ?? '');
        if ($valClean !== '') {
          $dataTahun[(string)$thn] = $valClean;
        }
      }
    }

    $this->db->where('Id', $id)->update('olah_data_indikator', array(
      'NamaIndikator' => $namaIndikator,
      'Kategori'      => trim($this->input->post('Kategori') ?? ''),
      'Gender'        => trim($this->input->post('Gender') ?? 'Total'),
      'Satuan'        => trim($this->input->post('Satuan') ?? ''),
      'DataTahun'     => json_encode($dataTahun),
      'ApiUrl'        => $apiUrl ?: NULL,
      'TipeSumber'    => $tipeSumber,
      'Keterangan'    => trim($this->input->post('Keterangan') ?? ''),
      'Urutan'        => (int)($this->input->post('Urutan') ?? 1),
      'UpdatedAt'     => date('Y-m-d H:i:s')
    ));

    echo '1';
  }

  /**
   * Endpoint Sinkronkan / Tarik Ulang Data Indikator dari URL API
   */
  public function SinkronkanIndikator(){
    $this->ensureOlahDataStructure();

    $id = (int)$this->input->post('Id');
    if ($id <= 0) {
      echo json_encode(array('status' => 'error', 'message' => 'ID Indikator tidak valid.'));
      return;
    }

    $row = $this->db->get_where('olah_data_indikator', array('Id' => $id))->row_array();
    if (!$row) {
      echo json_encode(array('status' => 'error', 'message' => 'Indikator tidak ditemukan.'));
      return;
    }

    $apiUrl = trim($row['ApiUrl'] ?? '');
    if (empty($apiUrl)) {
      echo json_encode(array('status' => 'error', 'message' => 'Indikator ini tidak memiliki tautan URL API.'));
      return;
    }

    $parsed = $this->parseJsonIndikatorData($apiUrl);
    if ($parsed['status'] !== 'success') {
      echo json_encode(array('status' => 'error', 'message' => 'Gagal menarik data dari API: ' . $parsed['message']));
      return;
    }

    $dataTahun = $parsed['DataTahun'];
    $daerahId = (int)$row['DaerahId'];

    // Update TahunList daerah jika ada tahun baru
    $daerah = $this->db->get_where('olah_data_daerah', array('Id' => $daerahId))->row_array();
    if ($daerah) {
      $currentYears = json_decode($daerah['TahunList'] ?? '[]', true) ?: array();
      $hasNewYear = false;
      foreach (array_keys($dataTahun) as $y) {
        if (!in_array((string)$y, $currentYears)) {
          $currentYears[] = (string)$y;
          $hasNewYear = true;
        }
      }
      if ($hasNewYear) {
        sort($currentYears, SORT_NUMERIC);
        $this->db->where('Id', $daerahId)->update('olah_data_daerah', array(
          'TahunList' => json_encode($currentYears),
          'UpdatedAt' => date('Y-m-d H:i:s')
        ));
      }
    }

    $this->db->where('Id', $id)->update('olah_data_indikator', array(
      'DataTahun' => json_encode($dataTahun),
      'UpdatedAt' => date('Y-m-d H:i:s')
    ));

    echo json_encode(array(
      'status'    => 'success', 
      'message'   => 'Berhasil disinkronkan! ' . count($dataTahun) . ' data tahun diperbarui dari API.',
      'DataTahun' => $dataTahun
    ));
  }

  public function HapusIndikator(){
    $this->ensureOlahDataStructure();

    $id = (int)$this->input->post('Id');
    if ($id <= 0) {
      echo 'ID Indikator tidak valid!';
      return;
    }

    $this->db->where('Id', $id)->delete('olah_data_indikator');
    if ($this->db->affected_rows() > 0) {
      echo '1';
    } else {
      echo 'Gagal menghapus indikator!';
    }
  }

  public function UpdateNilaiCell(){
    $this->ensureOlahDataStructure();

    $id = (int)$this->input->post('IndikatorId');
    $tahun = trim($this->input->post('Tahun') ?? '');
    $nilai = trim($this->input->post('Nilai') ?? '');

    if ($id <= 0 || empty($tahun)) {
      echo 'Data tidak lengkap!';
      return;
    }

    $row = $this->db->get_where('olah_data_indikator', array('Id' => $id))->row_array();
    if (!$row) {
      echo 'Indikator tidak ditemukan!';
      return;
    }

    $dataTahun = json_decode($row['DataTahun'] ?? '{}', true) ?: array();
    if ($nilai === '') {
      unset($dataTahun[$tahun]);
    } else {
      $dataTahun[$tahun] = $nilai;
    }

    $this->db->where('Id', $id)->update('olah_data_indikator', array(
      'DataTahun' => json_encode($dataTahun),
      'UpdatedAt' => date('Y-m-d H:i:s')
    ));

    echo '1';
  }
}