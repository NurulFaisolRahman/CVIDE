<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Admin')){
			redirect(base_url()); 
		}
    date_default_timezone_set("Asia/Jakarta");
  } 

  public function index(){
    $this->load->view('Admin/Header');
		$this->load->view('Admin/Dashboard');
  }

  public function GantiPassword(){
    $this->db->where('Username', $this->session->userdata('Username'));
    $this->db->update('akun', array('Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT)));
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengganti Password!';
    }
  }

  public function Matrikulasi(){
    $Data['Matrikulasi'] = $this->db->get('matrikulasi')->result_array();
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/Matrikulasi',$Data);
  }

  public function InputMatrikulasi(){
    $this->db->insert('matrikulasi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data!';
    }
  }

  public function EditMatrikulasi(){
    $this->db->where('Id',$_POST['Id']);
    $this->db->update('matrikulasi', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo "Gagal Update Data!";
		}
  }

  public function SesiBiaya(){
    $this->session->set_userdata(array('Kegiatan' => $_POST['Kegiatan']));
    echo '1';
  }

  public function PengeluaranKegiatan(){
    // Ambil tahun unik dari kolom Mulai
    $queryTahun = $this->db->query("SELECT DISTINCT YEAR(Mulai) AS Tahun FROM pendapatan WHERE Mulai IS NOT NULL ORDER BY Tahun DESC");
    $Data['TahunPendapatan'] = $queryTahun->result_array();
    // Ambil data pendapatan dengan filter tahun jika ada, dan urutkan dari paling baru (berdasarkan InputAt DESC)
    $tahunFilter = $this->input->get('tahun');
    $Data['Pendapatan'] = $this->db->query("SELECT * FROM `pendapatan` ORDER BY Mulai DESC,InputAt DESC")->result_array();
    if (!empty($tahunFilter) && is_numeric($tahunFilter)) {
        $Data['Pendapatan'] = $this->db->query("SELECT * FROM `pendapatan` WHERE YEAR(Mulai) = '".$tahunFilter."' ORDER BY Mulai DESC,InputAt DESC")->result_array();
    }
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/PengeluaranKegiatan',$Data);
  }

  public function BiayaKegiatan(){
    $Id = $this->session->userdata('Kegiatan');
    $Kegiatan = $this->db->query("SELECT * FROM `pendapatan` WHERE `Id`=".$Id)->row_array();
    $Data['NamaKegiatan'] = $Kegiatan['NamaKegiatan'];
    $Data['NominalKegiatan'] = $Kegiatan['NominalKegiatan'];
    $Data['Pengeluaran'] = $this->db->query("SELECT * FROM `pengeluaran` WHERE `DeleteAt` IS NULL AND `IdKegiatan`=".$Id." ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    
    // $Data['Charge'] = 30/100*$Data['NominalKegiatan'];  
    // $Data['Saving'] = 20/100*$Data['NominalKegiatan'];   
    // $Data['Umum'] = 5/100*$Data['NominalKegiatan'];      
    
    $Data['Biaya'] = 0; 
    foreach ($Data['Pengeluaran'] as $key) {
        $Data['Biaya'] += $key['NominalPengeluaran'];
    }
    
    // RUMUS BARU: Saldo = Nominal - Biaya Riil
    // $Data['Saldo'] = $Data['NominalKegiatan'] - ($Data['Charge']+$Data['Saving']+$Data['Biaya']);
    $Data['Saldo'] = $Data['NominalKegiatan'] - $Data['Biaya'];
    
    $this->load->view('Admin/Header',$Data);
    $this->load->view('Admin/BiayaKegiatan',$Data);
}

  public function InputBiayaKegiatan(){
    $this->db->insert('pengeluaran', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data Pendapatan!';
    }
  }

  public function EditBiayaKegiatan(){
    $_POST['UpdateAt'] = date("Y-m-d H:i:s");
    $this->db->where('Id',$_POST['Id']);
    $this->db->update('pengeluaran', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
      echo 'Gagal Update Data Pendapatan!';
    }
  }

  public function HapusBiayaKegiatan(){
    $Hapus = array('DeleteAt' => date("Y-m-d H:i:s"));
		$this->db->where('Id',$_POST['Id']);
    $this->db->update('pengeluaran', $Hapus);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}

public function PendapatanKegiatan(){
    // Ambil tahun unik dari kolom Mulai
    $queryTahun = $this->db->query("SELECT DISTINCT YEAR(Mulai) AS Tahun FROM pendapatan WHERE Mulai IS NOT NULL ORDER BY Tahun DESC");
    $Data['TahunPendapatan'] = $queryTahun->result_array();
    // Ambil data pendapatan dengan filter tahun jika ada, dan urutkan dari paling baru (berdasarkan InputAt DESC)
    $tahunFilter = $this->input->get('tahun');
    $Data['Pendapatan'] = $this->db->query("SELECT * FROM `pendapatan` ORDER BY Mulai DESC,InputAt DESC")->result_array();
    if (!empty($tahunFilter) && is_numeric($tahunFilter)) {
        $Data['Pendapatan'] = $this->db->query("SELECT * FROM `pendapatan` WHERE YEAR(Mulai) = '".$tahunFilter."' ORDER BY Mulai DESC,InputAt DESC")->result_array();
    }
    $this->load->view('Admin/Header', $Data);
    $this->load->view('Admin/PendapatanKegiatan', $Data);
}

// Perbaikan juga di Input (set InputAt saat insert)
public function InputPendapatanKegiatan(){
    $_POST['InputAt'] = date("Y-m-d H:i:s");  // Set waktu input
    $this->db->insert('pendapatan', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data Pendapatan!';
    }
}

// Sudah ada UpdateAt di Edit, tapi tambahkan jika perlu
public function EditPendapatanKegiatan(){
    $_POST['UpdateAt'] = date("Y-m-d H:i:s");
    $this->db->where('Id', $_POST['Id']);
    $this->db->update('pendapatan', $_POST);
    if ($this->db->affected_rows()){
        echo '1';
    } else {
        echo 'Gagal Update Data Pendapatan!';
    }
}

  public function ExcelKas($From,$To){
    $Data['NamaFile'] = "Kas ".$From." Hingga ".$To;
    $Data['SumberKegiatan'] = array('','Swakelola Tipe 1','Swakelola Tipe 2','Narasumber','Rekanan','CV IDE PL','CV IDE Tender/Seleksi');
    $Data['JenisPengeluaran'] = array('','Honor','Perjalanan Dinas','Pajak','Survei','Operasional Kantor'); 
    $Data['SubPengeluaran'] = array(array(''),
                                                        array('','PIC Kegiatan','TA Kegiatan','General Manager','Lainnya'),
                                                        array('','BBM','Tol','Penginapan','Konsumsi','Honor Peserta rapat/FGD','Honor Perjadin TA Kegiatan','Honor Perjadin PIC Kegiatan','Lainnya'),
                                                        array('','Pajak','Lainnya'),
                                                        array('','Honor Surveyor','Operasional Survei','Penginapan','Penginapan','Sewa Kendaraan','Lainnya'),
                                                        array('','Cetak Laporan Kegiatan','Pembelian ATK','Jasa Pengiriman Dokumen Kegiatan','Lainnya'));  
    $Umum = $this->db->query("SELECT * FROM `kas` WHERE Tanggal >= '".$From."' and Tanggal <= '".$To."' AND DeleteAt IS NULL ORDER BY Tanggal ASC,InputAt ASC")->result_array();
    $Biaya = $this->db->query("SELECT r.*,t.NamaKegiatan FROM `pengeluaran` as r,`pendapatan` as t WHERE r.Tanggal >= '".$From."' and r.Tanggal <= '".$To."' AND r.DeleteAt IS NULL AND r.IdKegiatan = t.Id ORDER BY r.Tanggal ASC,r.InputAt DESC")->result_array();
    $Data['Kas'] = array_merge($Umum,$Biaya);
    array_multisort(array_column($Data['Kas'], 'Tanggal'), SORT_ASC, $Data['Kas']);
		$this->load->view('ExcelKas',$Data);
  }

	public function JurnalTotal(){
    $InLalu = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Tanggal` >= '2022-05' AND Tanggal <= '2023-12-30' AND DeleteAt IS NULL")->row_array()['Total'];
    $OutLalu = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='OUT' AND `Tanggal` >= '2022-05-10' AND Tanggal <= '2023-12-30' AND DeleteAt IS NULL")->row_array()['Total'];
    $SeleisihLalu = $InLalu - $OutLalu;$Bulan = date("Y-n-j", strtotime("last day of previous month"));
    $In = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND Tanggal <= '".$Bulan."' AND Tanggal >= '2024-01-01' AND DeleteAt IS NULL")->row_array()['Total'];
    $Out = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='Out' AND Tanggal <= '".$Bulan."' AND Tanggal >= '2024-01-01' AND DeleteAt IS NULL")->row_array()['Total'];
    $Outt = $this->db->query("SELECT SUM(NominalPengeluaran) AS Total FROM `pengeluaran` WHERE Tanggal <= '".$Bulan."' AND DeleteAt IS NULL")->row_array()['Total'];
    $Data['SaldoLalu'] = $SeleisihLalu + ($In-$Out-$Outt);
    $Data['InBerjalan'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Tanggal` LIKE '".date('Y-m')."%' AND DeleteAt IS NULL")->row_array()['Total'];
    $OutBulan = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='Out' AND `Tanggal` LIKE '".date('Y-m')."%' AND DeleteAt IS NULL")->row_array()['Total'];
    $OuttBulan = $this->db->query("SELECT SUM(NominalPengeluaran) AS Total FROM `pengeluaran` WHERE `Tanggal` LIKE '".date('Y-m')."%' AND DeleteAt IS NULL")->row_array()['Total'];
    $Data['OutBerjalan'] = $OutBulan + $OuttBulan;
    $Umum = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    $Biaya = $this->db->query("SELECT * FROM `pengeluaran` WHERE DeleteAt IS NULL ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    $Data['Kas'] = array_merge($Umum,$Biaya);
    array_multisort(array_column($Data['Kas'], 'Tanggal'), SORT_DESC, $Data['Kas']);
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/JurnalTotal',$Data);
  }

 public function PendapatanKas() {
    // Ambil tahun unik dari kolom Tanggal
    $queryTahun = $this->db->query("SELECT DISTINCT YEAR(Tanggal) AS Tahun FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'IN' AND Tanggal IS NOT NULL ORDER BY Tahun DESC");
    $Data['TahunKas'] = $queryTahun->result_array();
    // Ambil data kas, dengan filter tahun jika ada
    $tahunFilter = $this->input->get('tahun');
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'IN' ORDER BY Tanggal DESC, InputAt DESC")->result_array(); // Default semua
    if (!empty($tahunFilter) && is_numeric($tahunFilter)) {
        $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'IN' AND YEAR(Tanggal) = '".$tahunFilter."' ORDER BY Tanggal DESC, InputAt DESC")->result_array(); //
    }
    $this->load->view('Admin/Header', $Data);
    $this->load->view('Admin/PendapatanKas', $Data);
}

  public function InputPendapatanKas(){
    $_POST['Jenis'] = 'IN';
    $this->db->insert('kas', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data!';
    }
  }

  public function EditPendapatanKas(){
    $_POST['UpdateAt'] = date("Y-m-d H:i:s");
    $this->db->where('Id',$_POST['Id']);
    $this->db->update('kas', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo "Gagal Update Data!";
		}
	}

  public function HapusPendapatanKas(){
    $Hapus = array('DeleteAt' => date("Y-m-d H:i:s"));
    $this->db->where('Id',$_POST['Id']);
		$this->db->update('kas', $Hapus);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}

  public function PengeluaranUmum(){
    // Ambil tahun unik dari kolom Tanggal
    $queryTahun = $this->db->query("SELECT DISTINCT YEAR(Tanggal) AS Tahun FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'OUT' AND Tanggal IS NOT NULL ORDER BY Tahun DESC");
    $Data['TahunKas'] = $queryTahun->result_array();
    // Ambil data kas, dengan filter tahun jika ada
    $tahunFilter = $this->input->get('tahun');
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'OUT' ORDER BY Tanggal DESC, InputAt DESC")->result_array(); // Default semua
    if (!empty($tahunFilter) && is_numeric($tahunFilter)) {
        $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'OUT' AND YEAR(Tanggal) = '".$tahunFilter."' ORDER BY Tanggal DESC, InputAt DESC")->result_array(); //
    }
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/PengeluaranUmum',$Data);
  }

  public function InputPengeluaranUmum(){
    $_POST['Jenis'] = 'OUT';
    $this->db->insert('kas', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data!';
    }
  }

  public function EditPengeluaranUmum(){
    $_POST['UpdateAt'] = date("Y-m-d H:i:s");
    $this->db->where('Id',$_POST['Id']);
    $this->db->update('kas', $_POST);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo "Gagal Update Data!";
		}
	}

  public function HapusPengeluaranUmum(){
    $Hapus = array('DeleteAt' => date("Y-m-d H:i:s"));
    $this->db->where('Id',$_POST['Id']);
		$this->db->update('kas', $Hapus);
		if ($this->db->affected_rows()){
			echo '1';
		} else {
			echo 'Gagal Menghapus Data!';
		}
	}

  public function JurnalUmum(){
    // Ambil tahun unik dari kolom Tanggal
    $queryTahun = $this->db->query("SELECT DISTINCT YEAR(Tanggal) AS Tahun FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'OUT' AND Tanggal IS NOT NULL ORDER BY Tahun DESC");
    $Data['TahunKas'] = $queryTahun->result_array();    
    // Ambil data kas, dengan filter tahun jika ada
    $tahunFilter = $this->input->get('tahun');
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'OUT' ORDER BY Tanggal DESC, InputAt DESC")->result_array(); // Default semua
    if (!empty($tahunFilter) && is_numeric($tahunFilter)) {
      $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE DeleteAt IS NULL AND Jenis = 'OUT' AND YEAR(Tanggal) = '".$tahunFilter."' ORDER BY Tanggal DESC, InputAt DESC")->result_array(); //
    }
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/JurnalUmum',$Data);
  }

  public function JurnalKegiatan(){
    // Ambil tahun unik dari kolom Mulai
    $queryTahun = $this->db->query("SELECT DISTINCT YEAR(Mulai) AS Tahun FROM pendapatan WHERE Mulai IS NOT NULL ORDER BY Tahun DESC");
    $Data['TahunKas'] = $queryTahun->result_array();
    // Ambil data pendapatan dengan filter tahun jika ada, dan urutkan dari paling baru (berdasarkan InputAt DESC)
    $tahunFilter = $this->input->get('tahun');
    $Data['Biaya'] = $this->db->query("SELECT * FROM `pengeluaran` WHERE DeleteAt IS NULL ORDER BY Tanggal DESC,InputAt DESC")->result_array();
    $Data['Kegiatan'] = $this->db->query("SELECT * FROM `pendapatan` ORDER BY Mulai DESC,InputAt DESC")->result_array();
    if (!empty($tahunFilter) && is_numeric($tahunFilter)) {
        $Data['Biaya'] = $this->db->query("SELECT * FROM `pengeluaran` WHERE DeleteAt IS NULL AND YEAR(Tanggal) = '".$tahunFilter."' ORDER BY Tanggal DESC,InputAt DESC")->result_array();
        $Data['Kegiatan'] = $this->db->query("SELECT * FROM `pendapatan` WHERE YEAR(Mulai) = '".$tahunFilter."' ORDER BY Mulai DESC,InputAt DESC")->result_array();
    }
    $this->load->view('Admin/Header',$Data);
		$this->load->view('Admin/JurnalKegiatan',$Data);
  }
}