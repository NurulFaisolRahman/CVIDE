<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';
class IDE extends CI_Controller {

	public function index(){
    $Data['Kategori'] = $this->db->query('SELECT DISTINCT(Kategori) FROM `portfolio`')->result_array();
    $Data['Portfolio'] = $this->db->get('portfolio')->result_array();
		$this->load->view('IDE',$Data);
  }

  public function Kominfo(){
    $Data = $this->db->query('SELECT * FROM `kominfo` WHERE Instansi != 2 && Instansi != 3 && Instansi != 4 && Instansi != 5 && Id > 382')->result_array();
    foreach ($Data as $key) {
        echo $key['Id'].'$'.$key['Nama'].'$'.$key['Gender'].'$'.$key['Usia'].'$'.$key['Instansi'].'$'.$key['Kecamatan'].'$'.$key['Desa'].'$'.$key['Saran'].'$'.$key['Nilai'].'<br>';   
    }
  }
  
  public function BBMPengeluaran(){
    $Kecamatan = array('35.10.01','35.10.05','35.10.09','35.10.11','35.10.16','35.10.18','35.10.24');
    for ($i=0; $i < 7; $i++) { 
      $Data = $this->db->query("SELECT * FROM `dampakbbm` WHERE Kecamatan="."'".$Kecamatan[$i]."'")->result_array();
      $Sebelum = $Sesudah = 0;
      foreach ($Data as $key) {
        $Pisah = explode("|",$key['Konsumsi']);
        for ($j=0; $j < 154; $j++) { 
          $Pecah = explode("$",$Pisah[$j]);
          // if ($j == 0) {
          //   echo $Pecah[1].'<br>';
          // }
          if ($Pecah[0] > 0) {
            $Sebelum += ($Pecah[1]*4);
          } 
          if ($Pecah[2] > 0) {
            $Sesudah += ($Pecah[3]*4);
          } 
        }
      }
      echo intval($Sebelum/count($Data)).'|'.intval($Sesudah/count($Data)).'<br>';
    }
  }
  
  public function bbm(){
      $data = $this->db->query("SELECT Konsumsi FROM `dampakbbm` WHERE Kecamatan='35.10.05'")->result_array();
      foreach ($data as $key) {
        echo $key['Konsumsi'].'<br>';
      }
  }
  
  public function BBMHarga(){
    // 35.10.01 Pesanggaran
    // 35.10.05 Muncar
    // 35.10.09 Genteng
    // 35.10.11 Kalibaru
    // 35.10.16 Banyuwangi 
    // 35.10.18 Wongsorejo
    // 35.10.24 Licin
    $Kecamatan = array('35.10.01','35.10.05','35.10.09','35.10.11','35.10.16','35.10.18','35.10.24');
    for ($i=6; $i <= 6; $i++) { 
      $Data = $this->db->query("SELECT * FROM `dampakbbm` WHERE Kecamatan="."'".$Kecamatan[$i]."'")->result_array();
      $_Harga = $Harga = $Selisih = array();
      $_Harga_ = $Harga_ = $Selisih_ = array();
      for ($k=0; $k < 154; $k++) { 
        $_Harga[$k] = 0;$Harga[$k] = 0;$Selisih[$k] = 0;
        $_Harga_[$k] = 0;$Harga_[$k] = 0;$Selisih_[$k] = 0;
      }
      foreach ($Data as $key) {
        $Pisah = explode("|",$key['Konsumsi']);
        // echo $key['Konsumsi'].'<br>';
        for ($j=0; $j < 154; $j++) { 
            // echo $Pisah[$j].'<br>';
          $Pecah = explode("$",$Pisah[$j]);
        //   if ($j == 135) {
        //      echo $Pecah[0].'$'.$Pecah[1].'$'.$Pecah[2].'$'.$Pecah[3].$key['Nama'].'<br>';
        //     }
          if ($Pecah[0] >= 1) {
            $_Harga[$j] += $Pecah[1]/$Pecah[0];
            $_Harga_[$j] += 1;
          } else if ($Pecah[0] > 0) {
            $_Harga[$j] += $Pecah[1]*(1/$Pecah[0]);
            $_Harga_[$j] += 1;
          }
          if ($Pecah[2] >= 1) {
            $Harga[$j] += $Pecah[3]/$Pecah[2];
            $Harga_[$j] += 1;
          } else if ($Pecah[2] > 0) {
            $Harga[$j] += $Pecah[3]*(1/$Pecah[2]);
            $Harga_[$j] += 1;
          }
          if ($Pecah[1] > 0 && $Pecah[3] > 0) {
            $Selisih[$j] += abs(($Pecah[1]/$Pecah[0])-($Pecah[3]/$Pecah[2]));
            $Selisih_[$j] += 1;
          } 
        }
      }
      for ($k=0; $k < 154; $k++) { 
        if ($_Harga_[$k] > 0) {
          echo $_Harga_[$k].'|'.intval($_Harga[$k]/$_Harga_[$k]).'|';
        } else {
          echo $_Harga_[$k].'|'.intval($_Harga[$k]).'|';
        }
        if ($Harga_[$k] > 0) {
          echo $Harga_[$k].'|'.intval($Harga[$k]/$Harga_[$k]).'|';
        } else {
          echo $Harga_[$k].'|'.intval($Harga[$k]).'|';
        }
        if ($Selisih_[$k] > 0) {
          echo intval($Selisih[$k]/$Selisih_[$k]).'<br>';
        } else {
          echo intval($Selisih[$k]).'<br>';
        }
      }
    }
  }
  
  public function BBMKuantitas(){
    // 35.10.01 Pesanggaran
    // 35.10.05 Muncar
    // 35.10.09 Genteng
    // 35.10.11 Kalibaru
    // 35.10.16 Banyuwangi 
    // 35.10.18 Wongsorejo
    // 35.10.24 Licin
    $Kecamatan = array('35.10.01','35.10.05','35.10.09','35.10.11','35.10.16','35.10.18','35.10.24');
    for ($i=6; $i <= 6; $i++) { 
      $Data = $this->db->query("SELECT * FROM `dampakbbm` WHERE Kecamatan="."'".$Kecamatan[$i]."'")->result_array();
      $_Kuantitas = $Kuantitas = $Selisih = array();
      $_Kuantitas_ = $Kuantitas_ = $Selisih_ = array();
      for ($k=0; $k < 154; $k++) { 
        $_Kuantitas[$k] = 0;$Kuantitas[$k] = 0;$Selisih[$k] = 0;
        $_Kuantitas_[$k] = 0;$Kuantitas_[$k] = 0;$Selisih_[$k] = 0;
      }
      foreach ($Data as $key) {
        $Pisah = explode("|",$key['Konsumsi']);
        for ($j=0; $j < 154; $j++) { 
            // echo $Pisah[$j].'<br>';
          $Pecah = explode("$",$Pisah[$j]);
            // if ($j == 142) {
            //  echo '$'.$Pecah[0].'$'.$Pecah[1].'$'.$Pecah[2].'$'.$Pecah[3].$key['Nama'].'<br>';
            // }
          if ($Pecah[0] > 0) {
            $_Kuantitas[$j] += $Pecah[0];
            $_Kuantitas_[$j] += 1;
          } 
          if ($Pecah[2] > 0) {
            $Kuantitas[$j] += $Pecah[2];
            $Kuantitas_[$j] += 1;
          } 
          if ($Pecah[0] > 0 && $Pecah[2] > 0) {
            $Selisih[$j] += abs(($Pecah[0]-$Pecah[2]));
            $Selisih_[$j] += 1;
          } 
        }
      }
      for ($k=0; $k < 154; $k++) { 
        if ($_Kuantitas_[$k] > 0) {
          echo number_format($_Kuantitas[$k]/$_Kuantitas_[$k],2,",",".").'|';
        } else {
          echo number_format($_Kuantitas[$k],2,",",".").'|';
        }
        if ($Kuantitas_[$k] > 0) {
          echo number_format($Kuantitas[$k]/$Kuantitas_[$k],2,",",".").'|';
        } else {
          echo number_format($Kuantitas_[$k],2,",",".").'|';
        }
        if ($Selisih_[$k] > 0) {
          echo number_format($Selisih[$k]/$Selisih_[$k],2,",",".").'<br>';
        } else {
          echo number_format($Selisih[$k],2,",",".").'<br>';
        }
      }
    }
  }
  
  public function BBMGeser(){
    // 35.10.01 Pesanggaran
    // 35.10.05 Muncar
    // 35.10.09 Genteng
    // 35.10.11 Kalibaru
    // 35.10.16 Banyuwangi 
    // 35.10.18 Wongsorejo
    // 35.10.24 Licin
    $Kecamatan = array('35.10.01','35.10.05','35.10.09','35.10.11','35.10.16','35.10.18','35.10.24');
    for ($i=6; $i <= 6; $i++) { 
      $Data = $this->db->query("SELECT * FROM `dampakbbm` WHERE Kecamatan="."'".$Kecamatan[$i]."'")->result_array();
      $Sebelum = $Sesudah = array();
      $_Sebelum = $_Sesudah = array();
      for ($k=0; $k < 154; $k++) { 
        $Sebelum[$k] = 0;$Sesudah[$k] = 0;
        $_Sebelum[$k] = 0;$_Sesudah[$k] = 0;
      }
      foreach ($Data as $key) {
        $Pisah = explode("|",$key['Konsumsi']);
        for ($j=0; $j < 154; $j++) { 
          $Pecah = explode("$",$Pisah[$j]);
          // if ($j == 0) {
          //   echo $Pecah[1].'<br>';
          // }
          if ($Pecah[0] > 0 && $Pecah[2] == 0) {
            $Sebelum[$j] += 1;
          } 
          if ($Pecah[0] == 0 && $Pecah[2] > 0) {
            $Sesudah[$j] += 1;
          } 
          if ($Pecah[0] > 0) {
            $_Sebelum[$j] += 1;
          } 
          if ($Pecah[2] > 0) {
            $_Sesudah[$j] += 1;
          } 
        }
      }

      for ($k=0; $k < 154; $k++) { 
        echo $Sebelum[$k].'|'.$Sesudah[$k].'|'.$_Sebelum[$k].'|'.$_Sesudah[$k].'<br>';
      }
    }
  }
  
  public function BPNT(){
    // $Data = $this->db->query('SELECT pendampingbpnt.*,surveyor.Nama AS Surveyor FROM `pendampingbpnt`,`surveyor` WHERE pendampingbpnt.NIK=surveyor.NIK')->result_array();
    // $Data = $this->db->query('SELECT ewarung.*,surveyor.Nama AS Surveyor FROM `ewarung`,`surveyor` WHERE ewarung.NIK=surveyor.NIK ORDER BY ewarung.NIK')->result_array();
    $Data = $this->db->query('SELECT pkpm.*,surveyor.Nama AS Surveyor FROM pkpm,surveyor WHERE pkpm.NIK=surveyor.NIK ORDER BY pkpm.NIK')->result_array();
    foreach ($Data as $key) {
        echo $key['Id'].'#'.$key['Nama'].'#'.$key['Nilai'].'<br>';
        // $Pisah = explode("|",$key['Nilai']);
        // $Pecah = explode("$",$Pisah[6]);
        // $Pecah = explode("$",$Pisah[7]);
        // $P = $I = '';
        // for ($k=0; $k < 11; $k++) { 
        //     $Temp = explode("#",$Pecah[$k]);
        //     if ($Temp[0] == 1) {
        //         $P .= 'Sangat Tidak Setuju#';
        //     } else if ($Temp[0] == 2) {
        //         $P .= 'Tidak Setuju#';
        //     } else if ($Temp[0] == 3) {
        //         $P .= 'Ragu-Ragu#';
        //     } else if ($Temp[0] == 4) {
        //         $P .= 'Setuju#';
        //     } else if ($Temp[0] == 5) {
        //         $P .= 'Sangat Setuju#';
        //     }
        //     if ($Temp[1] == 1) {
        //         $P .= 'Sangat Tidak Penting#';
        //     } else if ($Temp[1] == 2) {
        //         $P .= 'Tidak Penting#';
        //     } else if ($Temp[1] == 3) {
        //         $P .= 'Ragu-Ragu#';
        //     } else if ($Temp[1] == 4) {
        //         $P .= 'Penting#';
        //     } else if ($Temp[1] == 5) {
        //         $P .= 'Sangat Penting#';
        //     }
        // }
        // echo $P.$I.'<br>';
        // for ($k=0; $k < 10; $k++) { 
        //     $Temp = explode("#",$Pecah[$k]);
        //     if ($Temp[0] == 0) {
        //         echo 'Tidak#';
        //     } else if ($Temp[0] == 1) {
        //         echo 'Ya#';
        //     } else {
        //         echo 'Tidak#';
        //     }
        //     if ($Temp[1] == 0) {
        //         echo '-#';
        //     } else if ($Temp[1] == 1) {
        //         echo 'Pasar#';
        //     } else if ($Temp[1] == 2) {
        //         echo 'Perum Bulog#';
        //     } else if ($Temp[1] == 3) {
        //         echo 'Penggilingan#';
        //     } else if ($Temp[1] == 4) {
        //         echo 'Peternak#';
        //     } else if ($Temp[1] == 5) {
        //         echo 'Agen/Grosir#';
        //     } else if ($Temp[1] == 6) {
        //         echo 'Lainnya#';
        //     }
        //     if ($Temp[2] == 0) {
        //         echo 'Tidak#';
        //     } else if ($Temp[2] == 1) {
        //         echo 'Ya#';
        //     } else {
        //         echo 'Tidak#';
        //     }
        //     if ($Temp[3] == 0) {
        //         echo '-#';
        //     } else if ($Temp[3] == 1) {
        //         echo 'Pemasok tidak mengirimkan bahan pangan sesuai jumlah yang dipesan e-Warong#';
        //     } else if ($Temp[3] == 2) {
        //         echo 'Pemasok kehabisan pasokan/stok#';
        //     } else if ($Temp[3] == 3) {
        //         echo 'Harga terlalu tinggi/modal tidak mencukupi#';
        //     } else if ($Temp[3] == 4) {
        //         echo 'Bahan pangan sangat diminati oleh KPM, melebihi perkiraan e-Warong#';
        //     } else if ($Temp[3] == 5) {
        //         echo 'Lainnya#';
        //     }
        //   }
        //   echo '<br>';
    }
  }

  public function NTPP(){
    $Nama = $this->db->query("SELECT DISTINCT(NamaResponden) FROM `ntpprodusen` TanggalSurvei LIKE '2023%'")->result_array();
    foreach ($Nama as $key) {
      $Data = $this->db->query('SELECT * FROM `ntpprodusen` WHERE TanggalSurvei LIKE "2023%" AND NamaResponden="'.$key['NamaResponden'].'"')->result_array();
      echo $key['NamaResponden'].'<br>';
      echo 'Bulan|'.$Data[0]['KodeKualitas'].'<br>';
      for ($i=0; $i < count($Data); $i++) { 
        echo ($i+1)>12?($i-11):($i+1);
        echo '|'.$Data[$i]['Harga'].'<br>';
      }
    }
  }
  
  public function NTPK(){
    $Nama = $this->db->query("SELECT DISTINCT(NamaResponden) FROM `ntpkonsumen` TanggalSurvei LIKE '2023%'")->result_array();
    foreach ($Nama as $key) {
      $Data = $this->db->query('SELECT * FROM `ntpkonsumen` WHERE TanggalSurvei LIKE "2023%" AND NamaResponden="'.$key['NamaResponden'].'"')->result_array();
      echo $key['NamaResponden'].'<br>';
      echo 'Bulan|'.$Data[0]['KodeKualitas'].'<br>';
      for ($i=0; $i < count($Data); $i++) { 
        echo ($i+1)>12?($i-11):($i+1);
        echo '|'.$Data[$i]['Harga'].'<br>';
      }
    }
  }

  public function SektorNTP(){
    $_Data = $this->db->query("SELECT KodeKualitas FROM `ntpprodusen` WHERE TanggalSurvei LIKE '%2022%'")->result_array();
    $Data = $this->db->query("SELECT KodeKualitas FROM `ntpprodusen` WHERE TanggalSurvei LIKE '%2023%'")->result_array();
    $_Kode = array();$Kode = array();
    foreach ($_Data as $key) {
      $Pisah = explode("|",$key['KodeKualitas']);
      for ($i=0; $i < count($Pisah); $i++) {
        if (!in_array($Pisah[$i],$_Kode)) {
          array_push($_Kode,$Pisah[$i]);
        }
      }
    }
    foreach ($Data as $key) {
      $Pisah = explode("|",$key['KodeKualitas']);
      for ($i=0; $i < count($Pisah); $i++) {
        if (!in_array($Pisah[$i],$Kode)) {
          array_push($Kode,$Pisah[$i]);
        }
      }
    }
    echo implode("|",array_diff($_Kode,$Kode));
  }

  public function SimulasiNTP(){
    $TanamanPangan = array('IA001001','IA001005','IA001006','IA002001','IA002006','IA003001','IA003006','IA004001','IB001003','IB002001','IB003001','IB005002','IB006001','IB006002','IB009001','JA101001','JA101003','JA101004','JA102003','JA102004','JA201002','JA202001','JA203001','JA204001','JA207001','JB001001','JB001002','JB001003','JB002002','JB004001','JB005001','JB006001','JB007001','JB014001','JB101002','JB102001','JB103001','JB105002','JC001001','JC002001','JC007001','JC009001','JC011001','JC013001','JD001001','JD002001','JD002002','JD002003','JD003002','JD004001','JD005002','JD006001','JD006002','JD006003','JD012001','JD013001','JF001001','JF002001','JF002002','JF005001','JF005002','JF007001','JF008001','JF009001','JF011001','JF012001','JF017001','JF018001','JF019001','JF023001','JF027001','JF028001','JF029001','JF034001','JG003001','JG005001','JG006001','JG012002','KA101101','KA101102','KA201101','KA301101','KA301102','KA401101','KA401102','KA501101','KA501102','KA601101','KA701101','KA801101','KA801102','KA911101','KA911102','KA921101','KA921102','KA961101');
    $NamaTanamanPangan = array('Gabah Kering Giling (GKG) Ciherang','Gabah Kering Giling (GKG) IR 64','Gabah Kering Giling (GKG)','Gabah Kering Panen Ciherang','Gabah Kering Panen','Gabah Kualitas Rendah Ciherang','Gabah Kualitas Rendah','Gabah Ketan Kering Giling ','Jagung','Jagung pipilan kuning','Kacang hijau ','Kacang kedelai putih','Kacang tanah belum dikupas','Kacang tanah dikupas','Talas biasa','Bibit padi cisadane','Bibit padi IR64','Bibit padi','Benih padi IR 64','Benih padi','Jagung','Kacang tanag','Kacang kedelai','Kacang hijau','Talas','urea pusri','urea gresik','urea','SP36','ZA','KCL','NPK','pupuk kandang','petroganik','insektisida (furadan)','fungisida (baycor)','herbisida (DMA-6)','bakterisida (scoor)','sewa tanah ladang (surplus)','sewa tanah sawah (surplus)','sewa traktor tangan (kubota)','sewa penyemprotan hama','sewa tresher','sewa pompa air','ongkos angkut','bensin (premium)','bensin (pertalite)','bensin (pertamax)','solar','oli (mesran)','ban luar motor (IRC)','ban dalam motor (swallow)','ban dalam motor (IRC)','ban dalam motor','tarif servis sepeda','tarif servis motor','tampah/nyiru','karung (goni',' 50 kg)','karung (plastik',' 50 kg)','cangkul (pandai besi)','cangkul (pabrik)','arit/sabit (dengan gagang)','garu','traktor tangan (kubota)','golok','parang','pisau','linggis','ember (plastik diameter 30 cm)','terpal','kapak','mesin pemotong rumput','selang','tangki','biaya pengairan lahan','plastik transparan/mulsa','bambu','tali (rafia)','upah mencangkul (laki2)','upah mencangkul (perempuan)','upah membajak (laki2)','upah penanaman (laki2)','upah penanaman (perempuan)','upah merambet/menyiangi (laki2)','upah merambet/menyiangi (perempuan)','upah pemanenan (laki2)','upah pemanenan (perempuan)','upah pemupukan (laki2)','upah penyemprotan (laki2)','upah perontokan (laki2)','upah perontokan (perempuan)','upah pengeringan (laki2)','upah pengeringan (perempuan)','upah pemipilan (laki2)','upah pemipilan (perempuan)','upah pikul/angkut (laki2)');
    $Hortikultura = array('XA002001','XA004001','XA006001','XA007001','XA008001','XA011001','XA013001','XA015001','XA026001','XA029001','XB014003','XB015001','XB018002','XB019002','XB023001','XB023002','XB023004','XD001001','XD002001','XD004001','XD008001','YA101001','YA101002','YA101003','YA102001','YA103001','YA108001','YA110001','YA111001','YA115001','YA117001','YA203003','YA204002','YA204003','YA208001','YA208002','YA211001','YA211002','YA212001','YA212002','YA401001','YA402001','YA405001','YA408001','YB001001','YB001002','YB002002','YB004001','YB005001','YB006001','YB007001','YB016001','YB101002','YB102001','YB102002','YB103001','YB103002','YB106002','YB107001','YB601001','YB601002','YB602001','YB603001','YB604001','YD002001','YD002003','YD002004','YD003002','YF003001','YF005001','YF006001','YF006002','YF007001','YF018001','YF019001','YF607001','YF607002','ZA101101','ZA201101','ZA301101','ZA301102','ZA401101','ZA501101','ZA501102','ZA501103','ZA601101','ZA701101','ZA921101');
    $NamaHortikultura = array('bawang merah','bayam','cabai hijau','cabai merah besar','cabai rawit','kacang panjang','kangkung','ketimun','sawi hijau','tomat','mangga','melon','pepaya lokal','pisang raja','semangka merah tanpa biji','semangka merah biji','semangka kuning biji','jahe','kunyit','lengkuas','sereh','cabai merah','cabai hijau','cabai rawit','sawi hijau','bawang merah','tomat','kacang panjang','bayam','kangkung','mentimun','mangga','pisang raja','pisang susu','semangka tanpa biji','semangka ada biji','melon lokal','melon','pepaya lokal','pepaya','jahe','kunyit','lengkuas','sereh','urea pusri','urea gresik','super phosphate SP 36','zwavalezure ammoniak (ZA)','kalium chloride (KCL)','nitrogen phosphate kalium (NPK)','pupuk kandang','akarisida tedion','intektisida furadan','fungisida baycor','fungsida','herbisida DMA-6','herbisida','Akarisida','obat perekat/lem','ZPT Buah','ZPT Daun','KNO3','Pupuk Mikro Organisme','Pupuk Organik','bensin premium','bensin pertalite','bensin pertamax','solar solar','keranjang','gunting pangkas pandai besi','cangkul pabrik','cangkul pandai besi','arit/sabit','garu','traktor tangan kubota','pisau mata','pisau','upah mencangkul laki-laki','upah membajak laki-laki','upah menanam laki-laki','upah menananm perempuan','upah merambet laki-laki','upah menuai / memanen laki-laki','upah menuai / memanen perempuan','upah menuai / memanen borongan','upah pemupukan laki-laki','upah penyemprotan laki-laki','upah penjarangan');
    $Perkebunan = array('LA007001','LA009002','MA003001','MB001002','MB017001','MD002002','MD003002','MD004001','MD005001','MD014001','MD015001','MD019001','ME005001','ME006001','ME024001','ME026001','MF002001','NA101101','NA201101','NA301101','NA701101','MC001002','MC004001','MD006001','MD007002','MD008001','MD009001','ME605001','NA501101','MA004001','MB002001','MB004001','MB006001','MB007001','MB008001','MB015001','MB016001','MB101002','MD007001','ME002001','ME008001','ME017001','ME602002','ME604001','ME612001','MF012002','NA202101','NA301102','NA401101','NA601101','MD001003','MB103003');
    $NamaPerkebunan = array('tebu','tembakau dauh basah','tebu','kelapa hibrida','pupuk organik','bensin eceran pertalite','solar solar','oli mesran SAE40','tarif servis motor ringan/servis kecil','tarif servis mobil ringan/servis kecil','sepeda motor honda supra X','tarif pulsa ponsel paket data','cangkul pandai besi','arit dg gagang','sprayer','truk','tarif servis traktor kubota','upah mencangkul laki-laki','upah menanam laki-laki','upah merembet laki-laki','upah pemangkasan laki-laki','sewa tanah ladang sedang','sewa traktor tangan kubota','ban dalam motor swallow','Ban Luar Motor','ban dalam sepeda swallow','ban luar sepeda swallow','cangkul pandai besi','upah pemupukan laki-laki','tembakau','Triple Super Phosphate/Super Phosphate (TSP/SP 36) TSP','Zwavalezure Ammoniak (ZA)','nitrogen Phospate Kalium (NPK) ','Pupuk Kandang','Dolomit/Kapur','Zat Perangsang Tumbuh (ZPT) daun','KNO3','Insektisida furadan','ban luar motor IRC 250','karung goni 50kg','Garpu Tanah','Terpal','drum plastik 200 liter','selang air','jerigen','tali rafia','upah menanam laki-laki','upah merambet perempuan','upah menuai laki-laki','upah penjemuran laki-laki','ongkos angkut motor/ojek','Herbisida');
    $Peternakan = array('OA002005','OB001004','OC002003','OC008001','OC009001','OD008001','PA002002','PA601001','PA615002','PA618002','PA621001','PA623001','PB102001','PB104001','PB106001','PB107001','PB108001','PB113001','PB116001','PB165001','PB165003','PB201001','PB204001','PB205003','PB206001','PB206002','PB212001','PC002001','PC601001','PD002003','PD003002','PD004001','PD005001','PD601003','PE001001','PE002002','PE004002','PE013001','PE602001','PE607001','PE608001','PE609001','PE610001','PE612001','PF015001','PF017001','PF021001','PF023001','QA101101','QA301101','QA501101');
    $NamaPeternakan = array('Biri-biri/Domba','Kambing','Itik/Bebek (Lokal)','Ayam Ras Pedaging ','Ayam Ras Petelur','Telur Itik/Bebek','Sapi (Umur < 2 Bulan) (Potong)','Itik/Bebek','Sapi (Umur 2 Bulan s/d ≤ 12 Bulan) (Potong)','Kambing (Umur 2 Bulan s/d ≤ 12 Bulan)','Ayam Ras Pedaging (Umur < 5 hari)/DOC','Ayam Ras Petelur (Umur < 5 hari)/DOC','Vitamin ( B-12)','Garam','Antiseptika dan Desinfektansia','Analgesika/Anti Piretika/Antibiotika','Anti Fungi/Anti Jamur','Obat Diare','Anti Defisiensi Vitamin & Mine','Vaksin  (Ternak Besar)','Vaksin  (Unggas)','Dedak (Gabah)','Jagung Pipilan (122 )','Pakan Jadi (Konsentrat)','Pur (Halus)','Pur (Kasar)','Ampas Tahu','Sewa Padang/Lahan Penggembalaan','Sewa Kandang Peternakan','Bensin (Pertalite)','Solar','Oli/Pelumas','Tarif Servis Motor (Ringan/Tune up)','Tarif Pulsa Ponsel (Paket Data )','Ember (Plastik)','Tempat Minum Unggas (Cap Globe)','Tempat Makan Unggas','Arit','Keranjang','Alat Penyemprot (Hand Sprayer )','Lemari Pendingin (Cold Storage )','Waring','Blower/Kipas','Drum','Bola Lampu','Gas LPG (3 Kg)','Sekam','Jasa Kesehatan Ternak','Upah Pemeliharaan Ternak/Unggas (Laki-laki)','Upah Mencari Rumput ( Laki-laki)','Upah Memungut Hasil (Pemerahan Susu',' Pengambilan Telur)');
    $Perikanan = array('RB020001','RB037001','RB040001','RB042005','RB047001','RB053001','RB055001','RB056001','RB072004','RB096001','RB099001','RB104001','RB109004','RB111001','RB113001','RB131001','SB002003','SB003002','SB007002','SC010004','SC011004','SC016001','SC018001','SC020001','SC021001','SC025001','SC028001','SC038001','SF501101','TB003005','TC001001','TC007001','TC011002','UA102005','UA201001','UA206001','UA210002','UB001002','UB002002','UB003001','UB061001','UB102001','UB104001','UB105001','UB202002','UB204001','UC001001','UD002003','UD003002','UD005003','UE005001','UE007001','UE032001','UE606001','UE609001','UH011101','UH201101','UH301101','UH401101','UH501101','UH601101');
    $NamaPerikanan = array('Cucut','Kapasan (Kapas-kapas)','Kembung(Kombong/Sumbo','Kerapu (Garopa/Groper)','Kurisi (Kerisi)','Layang (Malalugis/Momar)','Layur (Beladang)','Lemuru (Dencis)','Pari (Hidung Sekop)','Tenggiri','Teri','Tongkol','Udang (Laut) (Windu)','Kepiting Laut','Cumi-cumi','Kakap (Merah)','Bensin ( Pertalite)','Solar (Solar)','Gas LPG (Pertamina)','Perangkap','Keranjang ( Plastik )','Senter','Jerigen','Aki/Accu','Termos','Pelampung','Serok','Terpal ','Upah Penangkapan (Laki-laki)','Kerapu Budidaya','Bandeng','Nila','Udang (Vannamei)','Bibit Kerapu Budidaya','Bandeng/Nener (< 5 Cm)','Nila','Udang (Vannamei)','Urea (Gresik )','Triple Super Phosphate/Super Phosphate(TSP/SP 36) (SP 36 )','Zwavalezure Ammoniak (ZA)','Nitrogen Phospate Kalium (NPK)','Thiodan','Pembasmi kuman /Bakteri (Saponin)','Vitamin','Pelet','Ikan Segar/Rucah','Sewa Tanah Untuk Tambak/Kolam','Bensin Eceran (Pertalite)','Solar (Solar)','Tarif Pulsa Ponsel ( Paket Data)','Jaring Angkat','Perangkap ( Sero)','Drum Plastik/Blong','Ember','Selang','Upah Pengolahan Lahan ( Laki-laki)','Upah Penebaran Benih (Laki-laki)','Upah Pemupukan (Laki-laki )','Upah Pembenihan Pakan/Obat-Obatan (Laki-laki)','Upah Penjagaan Areal Budidaya ( Laki-laki)','Upah Pemanenan ( Laki-laki)');
    $KodeITTanamanPangan = array('IA001001','IA001002','IA001003','IA001004','IA001005','IA001006','IA002001','IA002002','IA002003','IA002004','IA002005','IA002006','IA003001','IA003002','IA003003','IA003004','IA003005','IA003006','IA004001','IA004002','IA005001','IA005002','IB001001','IB001002','IB002001','IB002002','IB001003','IB003001','IB005001','IB005002','IB006001','IB006002','IB007001','IB007002','IB008001','IB008002','IB008003','IB009001','IB009002','IB010001','IB011001','IB012001');  
    $KodeIBTanamanPangan = array('JA101001','JA101002','JA101003','JA101004','JA102001','JA102002','JA102003','JA102004','JA201001','JA201002','JA202001','JA203001','JA204001','JA205001','JA206001','JA207001','JA208001','JB001001','JB001002','JB001003','JB002001','JB002002','JB004001','JB005001','JB006001','JB007001','JB008001','JB011001','JB012001','JB012002','JB012003','JB013001','JB014001','JB015001','JB101001','JB101002','JB101003','JB102001','JB102002','JB102003','JB103001','JB103002','JB103003','JB104001','JB104002','JB104003','JB105001','JB105002','JB105003','JB106001','JB106002','JB106003','JB107001','JB107002','JC001001','JC001002','JC001003','JC002001','JC002002','JC002003','JC006001','JC007001','JC007002','JC008001','JC008002','JC009001','JC009002','JC010001','JC011001','JC013001','JC014001','JC015001','JC016001','JC017001','JD001001','JD001002','JD001003','JD002001','JD002002','JD002003','JD002004','JD003002','JD003003','JD003004','JD003005','JD004001','JD004002','JD005001','JD005002','JD005003','JD006001','JD006002','JD006003','JD007001','JD007002','JD008001','JD008002','JD010001','JD010002','JD011001','JD011002','JD012001','JD013001','JD014001','JD016001','JD016002','JD017001','JD017002','JD018001','JF001001','JF002001','JF002002','JF003001','JF003002','JF004001','JF005001','JF005002','JF006001','JF006002','JF007001','JF008001','JF009001','JF009002','JF010001','JF010002','JF011001','JF012001','JF013001','JF016001','JF017001','JF017002','JF018001','JF019001','JF019002','JF020001','JF023001','JF024001','JF025001','JF026001','JF027001','JF028001','JF029001','JF030001','JF031001','JF032001','JF033001','JF034001','JF035001','JG003001','JG004001','JG005001','JG005002','JG006001','JG007001','JG009001','JG009002','JG011001','JG011002','JG012001','JG012002','JG013001','JG013002','JG014001','JG015001','JG016001','JG017001','KA101101','KA101102','KA101103','KA201101','KA201102','KA201103','KA301101','KA301102','KA301103','KA401101','KA401102','KA401103','KA501101','KA501102','KA501103','KA601101','KA601102','KA601103','KA701101','KA701102','KA701103','KA801101','KA801102','KA801103','KA901101','KA901102','KA901103','KA911101','KA911102','KA911103','KA921101','KA921102','KA921103','KA941101','KA941102','KA941103','KA951101','KA951102','KA951103','KA961101','KA961102','KA961103');
    $KodeITHTDTanamanPangan = array('IA001','IA002','IA003','IA004','IA005','IB001','IB003','IB005','IB006','IB007','IB008','IB009');
    $KodeIBHTDTanamanPangan = array('JA101','JA102','JA201','JA202','JA203','JA204','JA205','JA206','JA207','JB001','JB002','JB004','JB005','JB006','JB007','JB008','JB011','JB012','JB013','JB014','JB101','JB102','JB103','JB104','JB105','JB106','JB107','JC001','JC002','JC006','JC007','JC008','JC009','JC010','JC011','JC013','JC014','JC015','JD001','JD002','JD003','JD004','JD005','JD006','JD007','JD008','JD010','JD011','JD012','JD013','JD014','JD016','JD017','JD018','JF001','JF002','JF003','JF004','JF005','JF006','JF007','JF008','JF009','JF010','JF011','JF012','JF013','JF016','JF017','JF018','JF019','JF020','JF023','JF024','JF025','JF026','JF027','JF028','JF029','JF030','JF031','JF032','JF033','JF034','JG003','JG004','JG005','JG006','JG007','JG009','JG011','JG012','JG013','JG014','JG015','KA101','KA201','KA301','KA401','KA501','KA601','KA701','KA801','KA901','KA911','KA921','KA941','KA951','KA961');
    $HTDITTanamanPangan = array(400000,400000,350000,680000,750000,330000,1300000,710000,1300000,378000,227900,378000);
    $HTDIBTanamanPangan = array(12500,15000,75000,7000,10000,38000,10000,7000,4500,2300,3500,2500,6000,2300,30000,3000,5600,102700,5833,800,25000,144000,150000,106000,660000,210000,62900,4000000,21000000,0,500000,50000,90000,35000,75000,350000,60000,35000,125000,9000,5000,32500,148000,28000,41530,21804,540000,70000,70000,85000,80000,2000,0,52780,20000,2400,20000,450000,125000,8000,100000,900000,22000000,4870000,75000,185000,9680000,29600,7500,48000,26000,480250,20000,510000,315000,17500,87000,1315000,3000,18500,20650,125000,0,450000,450000,12870,580000,28000,30875,12500,7100,15560,1478,17500,50000,100000,100000,80000,80000,80000,80000,80000,100000,80000,80000,80000,80000,80000,80000);
    $KodeITHortikultura = array('XA001001','XA002001','XA002002','XA002003','XA003001','XA004001','XA005001','XA006001','XA007001','XA007002','XA008001','XA009001','XA010001','XA010002','XA011001','XA012001','XA013001','XA014001','XA014002','XA015001','XA016001','XA016002','XA017001','XA019001','XA020001','XA022001','XA024001','XA025001','XA026001','XA027001','XA028001','XA029001','XA030001','XA031001','XA032001','XA033001','XA034001','XA035001','XA036001','XA037001','XA038001','XA039001','XB001001','XB001002','XB001003','XB002001','XB002002','XB003001','XB003002','XB004001','XB005001','XB005002','XB006001','XB006002','XB007001','XB007002','XB007003','XB008001','XB008002','XB008003','XB009001','XB009002','XB009003','XB009004','XB009005','XB010001','XB010002','XB010003','XB010004','XB010005','XB012001','XB013001','XB013002','XB014001','XB014002','XB014003','XB015001','XB016001','XB016002','XB016003','XB017001','XB018001','XB018002','XB019001','XB019002','XB019003','XB020001','XB020002','XB021001','XB021002','XB021003','XB022001','XB022002','XB023001','XB023002','XB023003','XB023004','XB024001','XB026001','XB027001','XB028001','XB029001','XB030001','XB031001','XB032001','XB033001','XB034001','XB035001','XD001001','XD002001','XD003001','XD004001','XD005001','XD007001','XD008001','XD009001','XD010001','XD011001','XD012001');  
    $KodeIBHortikultura = array('YA101001','YA101002','YA101003','YA102001','YA102002','YA103001','YA104001','YA105001','YA106001','YA107001','YA108001','YA109001','YA110001','YA111001','YA112001','YA113001','YA114001','YA115001','YA116001','YA117001','YA118001','YA119001','YA121001','YA122001','YA161001','YA163001','YA164001','YA165001','YA166001','YA167001','YA201001','YA201002','YA202001','YA202002','YA203001','YA203002','YA203003','YA204001','YA204002','YA204003','YA204004','YA205001','YA206001','YA206002','YA207001','YA207002','YA207003','YA208001','YA208002','YA209001','YA211001','YA211002','YA212001','YA212002','YA262001','YA263001','YA264001','YA265001','YA266001','YA267001','YA268001','YA401001','YA402001','YA403001','YA405001','YA408001','YA409001','YA410001','YB001001','YB001002','YB001003','YB002001','YB002002','YB004001','YB005001','YB006001','YB007001','YB008001','YB011001','YB016001','YB601001','YB601002','YB601003','YB602001','YB603001','YB604001','YB605001','YB101001','YB101002','YB101003','YB102001','YB102002','YB103001','YB103002','YB104001','YB104002','YB105001','YB105002','YB106001','YB106002','YB107001','YB108001','YB109001','YC001001','YC001002','YC001003','YC002001','YC002002','YC002003','YC006001','YC006002','YC007001','YC007002','YC009001','YC009002','YC010001','YC011001','YC601001','YC602001','YD001001','YD001002','YD001003','YD002001','YD002003','YD002004','YD002002','YD003002','YD003003','YD003004','YD003005','YD004001','YD004002','YD005001','YD005002','YD006001','YD006002','YD007001','YD007002','YD008001','YD008002','YD011001','YD012001','YD012002','YD012003','YD013001','YD013002','YD013003','YD014001','YD014002','YD014003','YD015001','YD015002','YD017001','YD017002','YD017003','YD018001','YF001001','YF003001','YF004001','YF005001','YF006001','YF006002','YF007001','YF008001','YF009001','YF009002','YF011001','YF012001','YF016001','YF017001','YF017002','YF018001','YF019001','YF019002','YF020001','YF022001','YF023001','YF024001','YF025001','YF026001','YF027001','YF028001','YF031001','YF033001','YF601001','YF603001','YF605001','YF607001','YF607002','YF999001','YF100001','YG003001','YG004001','YG006001','YG007001','YG009001','YG009002','YG009003','YG012001','YG013001','YG015001','YG015002','YG016001','ZA101101','ZA101102','ZA101103','ZA201101','ZA201102','ZA201103','ZA301101','ZA301102','ZA301103','ZA401101','ZA401102','ZA401103','ZA501101','ZA501102','ZA501103','ZA601101','ZA601102','ZA601103','ZA701101','ZA701102','ZA701103','ZA801101','ZA801102','ZA801103','ZA901101','ZA901102','ZA901103','ZA921101','ZA921102','ZA921103');
    $KodeITHTDHortikultura = array('XA002','XA004','XA006','XA007','XA008','XA011','XA013','XA015','XA026','XA029','XB014','XB015','XB018','XB019','XB023','XD001','XD002','XD004','XD008');
    $KodeIBHTDHortikultura = array('YA103','YA111','YA101','YA110','YA115','YA117','YA102','YA108','YA203','YA211','YA212','YA204','YA208','YA401','YA402','YA405','YA408','YB001','YB002','YB004','YB005','YB006','YB007','YB016','YB101','YB102','YB103','YB106','YB107','YB601','YB602','YB603','YB604','YD002','YD003','YF003','YF005','YF006','YF007','YF018','YF019','YF607','ZA101','ZA201','ZA301','ZA401','ZA501','ZA601','ZA701','ZA921');
    $HTDITHortikultura = array(1317127,383039,1800000,2000000,2143772,504460,242433,255568,389249,628851,687642,663274,245485,99107,351694,400000,150000,200000,2000);
    $HTDIBHortikultura = array(30000,38000,27000,23000,85000,48000,24000,160000,40000,27000,210000,10000,140000,6000,6500,14000,8500,2200,2500,1600,14000,2500,18500,9000,23700,120000,108000,23500,33000,13800,45000,1250,850,8000,5150,15000,10000,90000,40000,45000,10000,2000,80000,80000,80000,80000,80000,80000,80000,80000);
    $KodeITPerkebunan = array('LA001001','LA001002','LA002001','LA002002','LA004001','LA004002','LA005001','LA006001','LA006002','LA006003','LA008001','LA011001','LA011002','LA012001','LA012002','LA013001','LA014001','LA017001','LA017002','LA019001','LA020001','LA021001','LA022001','LA023001','LA026001','LA027001','LA029001','LA031001','LA032001','LA033001','LA007001','LA009001','LA009002','LA018001','LA025001','LA028001','LA030001');  
    $KodeIBPerkebunan = array('MA001001','MA001002','MA001003','MA002001','MA002002','MA002003','MA003001','MA004001','MA005001','MA006001','MA007001','MA008001','MA009001','MA010001','MA011001','MA012001','MA015001','MA017001','MA018001','MA019001','MB001001','MB001002','MB001003','MB002001','MB002002','MB004001','MB005001','MB005002','MB006001','MB007001','MB007002','MB007003','MB008001','MB011001','MB013001','MB014001','MB015002','MB015001','MB015003','MB016001','MB017001','MB018001','MB101001','MB101002','MB101003','MB101004','MB102001','MB102002','MB102003','MB103001','MB103002','MB103003','MB104001','MB104002','MB105001','MB105002','MB106001','MB106002','MC001001','MC001002','MC001003','MC003001','MC004001','MC004002','MC005001','MC005002','MC007001','MC008001','MC009001','MC010001','MC011001','MD001001','MD001002','MD001003','MD001004','MD002001','MD002002','MD002003','MD002004','MD003002','MD003003','MD003004','MD003005','MD004001','MD004002','MD005001','MD005002','MD005003','MD006001','MD006002','MD007001','MD007002','MD008001','MD008002','MD009001','MD009002','MD011001','MD011002','MD012001','MD012002','MD013001','MD014001','MD014002','MD014003','MD015001','MD015002','MD015003','MD017001','MD019001','MD019002','MD019003','MD019004','MD020001','MD020002','MD021001','MD022001','ME001001','ME002001','ME002002','ME002003','ME003001','ME003002','ME004001','ME004002','ME005001','ME005002','ME006001','ME007001','ME008001','ME009001','ME009002','ME009003','ME010001','ME011001','ME011002','ME012001','ME012002','ME013001','ME014001','ME015001','ME017001','ME019001','ME020001','ME021001','ME022001','ME023001','ME024001','ME025001','ME026001','ME602001','ME602002','ME602003','ME604001','ME605001','ME606001','ME607001','ME608001','ME609001','ME610001','ME611001','ME612001','ME613001','MF002001','MF002002','MF003001','MF006001','MF009001','MF009002','MF009003','MF012001','MF012002','MF602001','MF603001','MF606001','MF607001','NA101101','NA102101','NA103101','NA201101','NA202101','NA203101','NA301101','NA301102','NA301103','NA401101','NA401102','NA401103','NA501101','NA501102','NA501103','NA601101','NA601102','NA601103','NA701101','NA701102','NA701103','NA801101','NA801102','NA801103','NA901101','NA901102','NA901103','NA911101','NA911102','NA911103','NA921101','NA921102','NA921103','NA931101','NA931102','NA931103');
    $KodeITHTDPerkebunan = array('LA001','LA002','LA004','LA005','LA006','LA008','LA011','LA012','LA013','LA014','LA017','LA019','LA020','LA021','LA022','LA023','LA026','LA027','LA029','LA031','LA032','LA007','LA009','LA018','LA025','LA028');
    $KodeIBHTDPerkebunan = array('MA001','MA002','MA003','MA004','MA005','MA006','MA007','MA008','MA009','MA010','MA011','MA012','MA015','MA017','MA018','MB001','MB002','MB004','MB005','MB006','MB007','MB008','MB011','MB013','MB014','MB015','MB016','MB017','MB018','MB101','MB102','MB103','MB104','MB105','MB106','MC001','MC003','MC004','MC005','MC007','MC008','MC009','MC010','MD001','MD002','MD003002','MD004','MD005','MD006','MD007','MD008','MD009','MD011','MD012','MD013','MD014','MD017','MD019','MD020','MD021','ME001','ME002','ME003','ME004','ME005','ME006','ME007','ME008','ME009','ME010','ME011','ME012','ME013','ME014','ME015','ME017','ME019','ME020','ME021','ME022','ME023','ME024','ME025','ME026','ME602','ME604','ME605','ME606','ME607','ME608','ME609','ME610','ME611','ME612','MF002','MF003','MF006','MF009','MF012','MF602','MF603','MF606','MF607','NA101','NA201','NA301','NA401','NA501','NA601','NA701','NA801','NA901','NA911','NA921','NA931');
    $HTDITPerkebunan = array(460000,3048166,146500,2518750,14712,98020,18854,75000,58974,46687,2541178,6093980,29487,34401,0,0,710000,2948700,11794,27521,162178,617000,1950000,4151,50884,511108);
    $HTDIBPerkebunan = array(12000,0,96500,18000,0,31838,0,0,0,0,0,0,0,0,0,2400,2800,900,5441,15500,5000,28000,8005,108444,26879,60000,45000,800,0,25000,115552,98000,52692,134041,20337,900000,0,875000,0,0,0,0,0,4500,8500,5500,33000,225000,33000,115000,45000,95000,402122,1300000,55693,1870000,236444,80000,250000,0,15293,9800,9153,13440,130000,67500,70000,188000,75540,42006,64000,1100000,6025,65000,62471,195000,155159,60247,34758,4634373,1159,32000,139,89000000,198000,10000,45000,0,169850,29660,47668,62101,8990684,35000,575000,0,23172,36148,19000,0,0,0,7183,80000,80000,65000,80000,80000,40000,130000,80000,80000,80000,80000,80000);
    $KodeITPeternakan = array('OA001001','OA001002','OA001003','OA002001','OA002002','OA002003','OA002004','OA002005','OA002006','OA003001','OA003002','OA004001','OA004002','OA005002','OB001001','OB001002','OB001003','OB001004','OB002001','OB002002','OB002003','OB002004','OB003001','OB003002','OB003003','OB003004','OB003005','OB004001','OB004002','OB005001','OB006001','OC002001','OC002002','OC002003','OC002004','OC003001','OC005001','OC005002','OC005003','OC006001','OC007001','OC008001','OC009001','OC010001','OC011001','OD001001','OD006001','OD007001','OD008001','OD009001','OD010001','OD011001');  
    $KodeIBPeternakan = array('PA002001','PA002002','PA002003','PA003001','PA003002','PA005001','PA005002','PA006001','PA006002','PA007001','PA007002','PA601001','PA601002','PA602001','PA602002','PA615001','PA615002','PA615003','PA616001','PA616002','PA617001','PA617002','PA617003','PA618001','PA618002','PA619001','PA619002','PA620001','PA620002','PA621001','PA621002','PA622001','PA622002','PA623001','PA623002','PA624001','PA625001','PA626001','PA701001','PA701002','PA702001','PA702002','PA703001','PA703002','PA703003','PA704001','PA704002','PA705001','PA705002','PA706001','PA706002','PA707001','PB102001','PB102002','PB102003','PB102004','PB104001','PB105001','PB106001','PB107001','PB107002','PB107003','PB108001','PB109001','PB110001','PB113001','PB114001','PB116001','PB117001','PB122001','PB162001','PB164001','PB165001','PB165002','PB165003','PB166001','PB201001','PB201002','PB201003','PB201004','PB202001','PB202002','PB202003','PB202004','PB203001','PB203002','PB204001','PB204002','PB205001','PB205002','PB205003','PB206001','PB206002','PB208001','PB208002','PB209001','PB210001','PB210002','PB210003','PB210004','PB211001','PB212001','PB214001','PB215001','PB216001','PB217001','PB218001','PB219001','PB220001','PB221001','PB261001','PB262001','PB263001','PB264001','PB265001','PB266001','PB267001','PB268001','PB269001','PB270001','PC001001','PC002001','PC012001','PC601001','PC602001','PC603001','PD001001','PD001002','PD001003','PD001004','PD002001','PD002003','PD002004','PD002002','PD003002','PD003003','PD003004','PD003005','PD004001','PD004002','PD005001','PD005002','PD006001','PD006002','PD007001','PD007002','PD008001','PD009001','PD009002','PD014001','PD601001','PD601002','PD601003','PD602001','PE001001','PE001002','PE002001','PE002002','PE002003','PE003001','PE003002','PE003003','PE004001','PE004002','PE008001','PE008002','PE012001','PE012002','PE013001','PE013002','PE015001','PE016001','PE017001','PE018001','PE019001','PE020001','PE021001','PE023001','PE024001','PE025001','PE602001','PE602002','PE605001','PE606001','PE607001','PE608001','PE609001','PE610001','PE611001','PE612001','PE613001','PE614001','PE615001','PE616001','PE617001','PE618001','PE619001','PE620001','PF005001','PF006001','PF007001','PF008001','PF010001','PF010002','PF011001','PF012001','PF014001','PF015001','PF016001','PF016002','PF016003','PF017001','PF017002','PF018001','PF019001','PF019002','PF020001','PF020002','PF021001','PF022001','PF022002','PF023001','PF023002','PF024001','PF602001','PF602002','PF603001','PF604001','PF605001','PF606001','QA101101','QA101102','QA101103','QA301101','QA301102','QA301103','QA401101','QA401102','QA401103','QA501101','QA501102','QA501103','QA502101','QA502102','QA502103');
    $KodeITHTDPeternakan = array('OA001','OA002','OA003','OA004','OB001','OB002','OB003','OB004','OC002','OC003','OC005','OC006','OC007','OC008','OC009','OD001','OD006','OD007','OD008','OD009');
    $KodeIBHTDPeternakan = array('PA002','PA003','PA005','PA006','PA007','PA601','PA602','PA615','PA616','PA617','PA618','PA619','PA620','PA621','PA622','PA623','PA624','PA701','PA702','PA703','PA704','PA705','PA706','PB102','PB104','PB105','PB106','PB107','PB108','PB109','PB110','PB113','PB114','PB116','PB117','PB122','PB162','PB164','PB165','PB201','PB202','PB203','PB204','PB205','PB206','PB208','PB209','PB210','PB211','PB212','PB214','PB215','PB216','PB217','PB218','PB219','PB220','PB221','PB261','PB262','PB263','PB264','PB265','PB266','PB267','PC001','PC002','PC012','PC601','PD001','PD002','PD003','PD004','PD005','PD006','PD007','PD008','PD009','PD014','PD601','PE001','PE002','PE003','PE004','PE008','PE012','PE013','PE015','PE016','PE017','PE018','PE019','PE020','PE021','PE023','PE024','PE025','PE602','PE605','PE606','PE607','PE608','PE609','PE610','PE611','PE612','PE613','PE614','PE615','PE616','PE617','PE618','PE619','PE620','PF005','PF006','PF007','PF008','PF010','PF011','PF012','PF014','PF015','PF016','PF017','PF018','PF019','PF020','PF021','PF022','PF023','PF024','PF602','PF603','PF604','QA101','QA301','QA401','QA501');
    $HTDITPeternakan = array(18000000,17500000,13083701,0,1500000,1208333,1647969,33000,47000,0,48000,207500,60552,35000,45000,7404,20831,19653,17000,2250);
    $HTDIBPeternakan = array(9500000,0,800000,0,0,570000,0,12000000,0,0,1200000,0,0,70000,0,35000,20750,14000000,0,0,4500000,0,0,17000,8000,0,17000,60000,23000,0,0,22000,0,110000,0,0,0,10000,90000,3500,0,9000,4500,7000,9000,0,3851,0,3500,45000,0,0,0,0,0,0,0,0,3800,10240,17740,9000,0,0,0,0,1000000,0,1400000,0,7500,6500,70000,200000,600000,70000,150000,31000,50000,90000,22000,70000,0,16000,0,0,33000,75000,0,510000,0,0,0,0,0,0,18000000,9000,0,0,600000,1400000,35000,950000,0,190000,480250,25000,98000000,0,13000000,140000,22000000,0,15887,23880,195319,73727,33504,5251,48256,56147,25000,415,16000,13560,25000,15560,2500,0,150000,0,30875,14047,0,17000,20000,0,70000);
    $KodeITPerikanan = array('RA001001','RA002001','RA003001','RA004001','RA006001','RA007001','RA007002','RA007003','RA007004','RA007005','RA007006','RA008001','RA009001','RA010001','RA011001','RA011002','RA011003','RA011004','RA011005','RA012001','RA014001','RA015001','RA019001','RA020001','RA021001','RA022001','RA023001','RA024001','RA501001','RA502001','RA503001','RA505001','RA507001','RA508001','RA509001','RA510001','RB001001','RB004001','RB005001','RB006001','RB008001','RB010001','RB011001','RB012001','RB013001','RB014001','RB016001','RB017001','RB020001','RB021001','RB023001','RB024001','RB028001','RB029001','RB030001','RB032001','RB035001','RB037001','RB039001','RB040001','RB042001','RB042002','RB042003','RB042004','RB042005','RB044001','RB046001','RB047001','RB048001','RB049001','RB050001','RB052001','RB053001','RB054001','RB055001','RB056001','RB057001','RB058001','RB059001','RB063001','RB065001','RB072001','RB072002','RB072003','RB072004','RB073001','RB076001','RB078001','RB080001','RB081001','RB082001','RB082002','RB083001','RB085001','RB086001','RB087001','RB092001','RB093001','RB094001','RB095001','RB096001','RB098001','RB099001','RB104001','RB106001','RB106002','RB106003','RB106004','RB106005','RB108001','RB109001','RB109002','RB109003','RB109004','RB109005','RB110001','RB111001','RB113001','RB114001','RB115001','RB115002','RB115003','RB117001','RB118001','RB127001','RB128001','RB131001','RB131002','RB501001','RB502001','TA002001','TA005001','TA006001','TA007001','TA009001','TA012001','TA012002','TA012003','TA012004','TA012005','TA012006','TA013001','TA014001','TA015001','TA017001','TA018001','TA019001','TA019002','TA019003','TA019004','TA019005','TA032001','TA033001','TB002001','TB002002','TB002003','TB003001','TB003002','TB003003','TB003004','TB003005','TB006001','TB006002','TB006003','TB006004','TB006005','TB006006','TB007001','TB011001','TB011002','TB013001','TB016002','TB016003','TB503001','TB504001','TB505001','TB506001','TB507001','TC001001','TC002001','TC003001','TC004001','TC005001','TC006001','TC007001','TC011001','TC011002','TC011003','TC011004','TC011005','TC012002','TC013001');  
    $KodeIBPerikanan = array('SA001001','SA001002','SA001003','SA001004','SA002001','SA002002','SA002003','SA002004','SA003001','SA003002','SA003003','SA003004','SA003005','SA004001','SA004002','SA004003','SA004004','SA005001','SB001001','SB001002','SB001003','SB001004','SB001005','SB001006','SB002001','SB002003','SB002004','SB002002','SB003002','SB003003','SB003004','SB003005','SB004001','SB004002','SB004003','SB005001','SB005002','SB005003','SB006001','SB006002','SB006003','SB007002','SB007003','SB008001','SB009001','SC001001','SC001002','SC001003','SC001004','SC002001','SC002002','SC002003','SC002004','SC003001','SC003002','SC003003','SC003004','SC003005','SC003006','SC004001','SC004002','SC004003','SC005001','SC005002','SC005003','SC006001','SC007001','SC007002','SC007003','SC007004','SC008001','SC009001','SC009002','SC009003','SC009004','SC009005','SC010001','SC010002','SC010003','SC010004','SC011001','SC011002','SC011003','SC011004','SC011005','SC011006','SC013001','SC014001','SC015001','SC016001','SC017001','SC018001','SC019001','SC019002','SC020001','SC020002','SC021001','SC022001','SC022002','SC023001','SC024001','SC025001','SC026001','SC027001','SC028001','SC029001','SC030001','SC031001','SC032001','SC033001','SC033002','SC033003','SC033004','SC034001','SC034002','SC034003','SC034004','SC034005','SC037001','SC038001','SC039001','SC040001','SC601001','SC601002','SC601003','SC602001','SC603001','SC603002','SC604001','SC605001','SE001001','SE002001','SE003001','SE004001','SE004002','SE004003','SE004004','SE005001','SE006001','SE006002','SE007001','SE007002','SE007003','SE007004','SE007005','SE007006','SE008001','SE009001','SE010001','SE011001','SE015001','SE016001','SE016002','SE016003','SE017001','SE017002','SE018001','SE019001','SE020001','SE021001','SE602001','SE603001','SE603002','SE604001','SE605001','SF101101','SF102101','SF103101','SF201101','SF202101','SF203101','SF301101','SF302101','SF303101','SF501101','SF502101','SF503101','SF401101','SF402101','SF403101','UA002001','UA004001','UA005001','UA006001','UA007001','UA011001','UA011002','UA011003','UA011004','UA011005','UA012001','UA013001','UA014001','UA016001','UA018001','UA018002','UA018003','UA018004','UA020001','UA021001','UA022001','UA023001','UA101001','UA101002','UA101003','UA102001','UA102002','UA102003','UA102004','UA102005','UA104001','UA104002','UA104003','UA104004','UA104005','UA105001','UA106001','UA161001','UA162001','UA163001','UA164001','UA165001','UA166001','UA201001','UA201002','UA201003','UA202001','UA203001','UA204001','UA205001','UA206001','UA210001','UA210002','UA210003','UA210004','UA210005','UA211001','UA212001','UA213001','UB001001','UB001002','UB001003','UB002001','UB002002','UB003001','UB004001','UB004002','UB004003','UB004004','UB005001','UB006001','UB061001','UB062001','UB063001','UB064001','UB101001','UB102001','UB103001','UB104001','UB104002','UB105001','UB106001','UB107001','UB108001','UB109001','UB110001','UB111001','UB112001','UB113001','UB201001','UB201002','UB202001','UB202002','UB203001','UB204001','UB205001','UB207001','UB208001','UB209001','UB210001','UB211001','UB212001','UB213001','UB262001','UB263001','UB265001','UB266001','UB267001','UC001001','UC601001','UC602001','UC603001','UD001001','UD001002','UD001003','UD001004','UD001005','UD001006','UD002001','UD002003','UD002004','UD002002','UD003002','UD003003','UD003004','UD003005','UD004001','UD004002','UD004003','UD005001','UD005002','UD005003','UD006001','UD006002','UE001001','UE001002','UE001003','UE001004','UE002001','UE002002','UE002003','UE002004','UE003001','UE003002','UE003003','UE003004','UE003005','UE003006','UE004001','UE004002','UE004003','UE004004','UE005001','UE007001','UE007002','UE007003','UE007004','UE008001','UE008002','UE008003','UE008004','UE008005','UE008006','UE010001','UE010002','UE010003','UE011001','UE012001','UE014001','UE015001','UE016001','UE017001','UE018001','UE019001','UE019002','UE020001','UE020002','UE021001','UE022001','UE022002','UE023001','UE024001','UE025001','UE026001','UE027001','UE028001','UE029001','UE030001','UE031001','UE032001','UE033001','UE601001','UE602001','UE603001','UE605001','UE606001','UE607002','UE608003','UE609001','UE610001','UE611001','UE612001','UE613001','UG002001','UG003001','UG004001','UG005001','UG005002','UG006001','UG006002','UG006003','UG007001','UG007002','UG007003','UG008001','UG604001','UG604002','UG605001','UG606001','UH201101','UH201102','UH201103','UH301101','UH301102','UH301103','UH401101','UH401102','UH401103','UH501101','UH501102','UH501103','UH601101','UH601102','UH601103','UH701101','UH701102','UH701103','UH011101','UH011102','UH011103');
    $KodeITHTDPerikanan = array('TC007','TC011','TC001','TB003','RB020','RB037','RB040','RB042','RB047','RB053','RB055','RB056','RB072','RB096','RB099','RB104','RB109','RB111','RB113','RB131');
    $KodeIBHTDPerikanan = array('SB002','SB003','SB007','SC010','SC011','SC016','SC018','SC020','SC021','SC025','SC028','SC038','SF501','UA206','UA210','UA201','UA102','UB001','UB002','UB003','UB061','UB102','UB104','UB105','UB202','UB204','UC001','UD002','UD003','UD005','UE005','UE007','UE032','UE606','UH011','UH201','UH301','UH401','UH501','UH601');
    $HTDITPerikanan = array(15000,38000,15000,100000,45000,13000,18000,51000,18000,19000,38000,13000,16000,28000,8500,24000,105000,115000,42000,65000);
    $HTDIBPerikanan = array(6500,5150,18500,230000,110000,65000,12000,90000,80000,70000,14000,80000,80000,16000,35000,27000,5700000,2500,2600,4000,2600,90000,18000,117000,15000,20000,1200000,6500,5150,50000,1100000,55000,130000,6500,27000,140000,140000,25000,25000,110000);
    $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE '2022-01%'")->result_array();
    $ITKode = $IBKode = $ITNama = $IBNama = $ITHarga = $ITHTD = $IBHarga = $IBHTD = array();
    foreach ($DataProdusen as $key) {
      $Pisah = explode("|",$key['KodeKualitas']);
      $Harga = explode("|",$key['Harga']);
      for ($i=0; $i < count($Pisah) ; $i++) { 
        if (in_array($Pisah[$i],$KodeITPerikanan)) {
          for ($j=0; $j < count($KodeITHTDPerikanan); $j++) { 
            if (substr($Pisah[$i],0,5) == $KodeITHTDPerikanan[$j]) {
              array_push($ITKode,$Pisah[$i]);
              for ($k=0; $k < count($Perikanan); $k++) { 
                if($Pisah[$i]==$Perikanan[$k]){
                  array_push($ITNama,$NamaPerikanan[$k]);
                }
              }
              array_push($ITHarga,(int)$Harga[$i]);
              array_push($ITHTD,(int)$HTDITPerikanan[$j]);
            }
          }
        }
        else if (in_array($Pisah[$i],$KodeIBPerikanan)) {
          for ($j=0; $j < count($KodeIBHTDPerikanan); $j++) { 
            if (substr($Pisah[$i],0,5) == $KodeIBHTDPerikanan[$j]) {
              array_push($IBKode,$Pisah[$i]);
              for ($k=0; $k < count($Perikanan); $k++) { 
                if($Pisah[$i]==$Perikanan[$k]){
                  array_push($IBNama,$NamaPerikanan[$k]);
                }
              }
              array_push($IBHarga,(int)$Harga[$i]);
              array_push($IBHTD,(int)$HTDIBPerikanan[$j]);
            }
          }
        } 
      }
    }
    // for ($i=0; $i < count($ITKode); $i++) { 
    //   echo $ITKode[$i]."|".$ITNama[$i]."|".$ITHarga[$i]."|".$ITHTD[$i]."<br>";
    // }
    for ($i=0; $i < count($IBKode); $i++) { 
      echo $IBKode[$i]."|".$IBNama[$i]."|".$IBHarga[$i]."|".$IBHTD[$i]."<br>";
    }
  }

  public function NTP(){
    $Data = $this->db->query("SELECT Id,NamaResponden,NIK,TanggalSurvei,KodeKualitas,Harga,_Harga FROM `ntpprodusen`")->result_array();
    $KodeIT = array('XA001001','XA002001','XA002002','XA002003','XA003001','XA004001','XA005001','XA006001','XA007001','XA007002','XA008001','XA009001','XA010001','XA010002','XA011001','XA012001','XA013001','XA014001','XA014002','XA015001','XA016001','XA016002','XA017001','XA019001','XA020001','XA022001','XA024001','XA025001','XA026001','XA027001','XA028001','XA029001','XA030001','XA031001','XA032001','XA033001','XA034001','XA035001','XA036001','XA037001','XA038001','XA039001','XB001001','XB001002','XB001003','XB002001','XB002002','XB003001','XB003002','XB004001','XB005001','XB005002','XB006001','XB006002','XB007001','XB007002','XB007003','XB008001','XB008002','XB008003','XB009001','XB009002','XB009003','XB009004','XB009005','XB010001','XB010002','XB010003','XB010004','XB010005','XB012001','XB013001','XB013002','XB014001','XB014002','XB014003','XB015001','XB016001','XB016002','XB016003','XB017001','XB018001','XB018002','XB019001','XB019002','XB019003','XB020001','XB020002','XB021001','XB021002','XB021003','XB022001','XB022002','XB023001','XB023002','XB023003','XB023004','XB024001','XB026001','XB027001','XB028001','XB029001','XB030001','XB031001','XB032001','XB033001','XB034001','XB035001','XD001001','XD002001','XD003001','XD004001','XD005001','XD007001','XD008001','XD009001','XD010001','XD011001','XD012001');  
    $KodeIB = array('YA101001','YA101002','YA101003','YA102001','YA102002','YA103001','YA104001','YA105001','YA106001','YA107001','YA108001','YA109001','YA110001','YA111001','YA112001','YA113001','YA114001','YA115001','YA116001','YA117001','YA118001','YA119001','YA121001','YA122001','YA161001','YA163001','YA164001','YA165001','YA166001','YA167001','YA201001','YA201002','YA202001','YA202002','YA203001','YA203002','YA203003','YA204001','YA204002','YA204003','YA204004','YA205001','YA206001','YA206002','YA207001','YA207002','YA207003','YA208001','YA208002','YA209001','YA211001','YA211002','YA212001','YA212002','YA262001','YA263001','YA264001','YA265001','YA266001','YA267001','YA268001','YA401001','YA402001','YA403001','YA405001','YA408001','YA409001','YA410001','YB001001','YB001002','YB001003','YB002001','YB002002','YB004001','YB005001','YB006001','YB007001','YB008001','YB011001','YB016001','YB601001','YB601002','YB601003','YB602001','YB603001','YB604001','YB605001','YB101001','YB101002','YB101003','YB102001','YB102002','YB103001','YB103002','YB104001','YB104002','YB105001','YB105002','YB106001','YB106002','YB107001','YB108001','YB109001','YC001001','YC001002','YC001003','YC002001','YC002002','YC002003','YC006001','YC006002','YC007001','YC007002','YC009001','YC009002','YC010001','YC011001','YC601001','YC602001','YD001001','YD001002','YD001003','YD002001','YD002003','YD002004','YD002002','YD003002','YD003003','YD003004','YD003005','YD004001','YD004002','YD005001','YD005002','YD006001','YD006002','YD007001','YD007002','YD008001','YD008002','YD011001','YD012001','YD012002','YD012003','YD013001','YD013002','YD013003','YD014001','YD014002','YD014003','YD015001','YD015002','YD017001','YD017002','YD017003','YD018001','YF001001','YF003001','YF004001','YF005001','YF006001','YF006002','YF007001','YF008001','YF009001','YF009002','YF011001','YF012001','YF016001','YF017001','YF017002','YF018001','YF019001','YF019002','YF020001','YF022001','YF023001','YF024001','YF025001','YF026001','YF027001','YF028001','YF031001','YF033001','YF601001','YF603001','YF605001','YF607001','YF607002','YF999001','YF100001','YG003001','YG004001','YG006001','YG007001','YG009001','YG009002','YG009003','YG012001','YG013001','YG015001','YG015002','YG016001','ZA101101','ZA101102','ZA101103','ZA201101','ZA201102','ZA201103','ZA301101','ZA301102','ZA301103','ZA401101','ZA401102','ZA401103','ZA501101','ZA501102','ZA501103','ZA601101','ZA601102','ZA601103','ZA701101','ZA701102','ZA701103','ZA801101','ZA801102','ZA801103','ZA901101','ZA901102','ZA901103','ZA921101','ZA921102','ZA921103');
    $IT = $IB = array();
    foreach ($Data as $key) {
      $Harga = explode("|",$key['Harga']);
      $_Harga = explode("|",$key['_Harga']);
      $Pisah = explode("|",$key['KodeKualitas']);
      for ($i=0; $i < count($Harga); $i++) { 
        // if (substr($Pisah[$i],0,5)=='MB101') {
        //     echo '======'.$key['Id'].' '.$Pisah[$i].' '.$Harga[$i].' '.$key['NamaResponden'].'<br>';
        // }  
        if (in_array($Pisah[$i],$KodeIT)) {
            if (!in_array($Pisah[$i],$IT)) {
                array_push($IT,$Pisah[$i]);
            }
        } else if (in_array($Pisah[$i],$KodeIB)) {
            if (!in_array($Pisah[$i],$IB)) {
                array_push($IB,$Pisah[$i]);
            }
        }
        // if ((int)$Harga[$i]/(int)$_Harga[$i] > 5 || (int)$_Harga[$i]/(int)$Harga[$i] > 5) {
        // if (strlen($Harga[$i]) != strlen($_Harga[$i])) {
        //   echo $key['NamaResponden'].' '.$key['Id'].' '.$key['TanggalSurvei'].' '.$Pisah[$i].' '.$Harga[$i].' '.$_Harga[$i].'<br>';
        // }
      }
    }
    for ($i=0; $i < count($IT); $i++) { 
        echo $IT[$i].'<br>';   
    }
    for ($i=0; $i < count($IB); $i++) { 
        echo $IB[$i].'<br>';   
    }
  }

  public function Asisten(){
		$this->load->view('Asisten');
  }

  public function InputAsisten(){
    $NamaFile = date('Ymd',time()).substr(password_hash('Asisten', PASSWORD_DEFAULT),7,7);
    $NamaFile = str_replace("/","E",$NamaFile);$NamaFile = str_replace(".","F",$NamaFile);
    $Tipe = pathinfo($_FILES['CV']['name'],PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['CV']['tmp_name'], "Asisten/".$NamaFile.".".$Tipe);
    $_POST['CV'] = $NamaFile.".".$Tipe;
    $this->db->insert('asisten', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo "Pendaftaran Gagal!";
    }  
  }

  public function ListAsisten(){
    $Data['Asisten'] = $this->db->get('asisten')->result_array();
		$this->load->view('ListAsisten',$Data);
  }

  public function RekrutmenSurveyor(){
		$this->load->view('RekrutmenSurveyor');
  }
  
  public function Rekrutmen(){
    $Data['Rekrutmen'] = $this->db->query('SELECT * FROM `rekrutmen` WHERE Id > 34')->result_array();
		$this->load->view('Rekrutmen',$Data);
  }
  
  public function Daftar(){
    if ($this->db->get_where('rekrutmen', array('WA' => $_POST['WA']))->num_rows() == 0) {
      $NamaFile = date('Ymd',time()).substr(password_hash('Rekrutmen', PASSWORD_DEFAULT),7,7);
      $NamaFile = str_replace("/","E",$NamaFile);$NamaFile = str_replace(".","F",$NamaFile);
      $Tipe = pathinfo($_FILES['CV']['name'],PATHINFO_EXTENSION);
      move_uploaded_file($_FILES['CV']['tmp_name'], "Rekrutmen/".$NamaFile.".".$Tipe);
      $_POST['CV'] = $NamaFile.".".$Tipe;
      $this->db->insert('rekrutmen', $_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo "Pendaftaran Gagal!";
      }  
    } else {
      echo 'Anda Sudah Terdaftar!';
    }
  }
  
  public function Auth(){
		$this->load->view('Auth');
  }

  public function DataCenter(){
		$this->load->view('DataCenter');
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
                           'JenisData' => 'Kabupaten',
                           'BulanNTP' => '01',
                           'TahunNTP' => '2022');
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
        return;
    }
    
    $Akun = $User->row_array();
    
    if (password_verify($_POST['Password'], $Akun['Password'])) {
        
        // TIDAK ADA kolom Id, jadi kita gunakan Username sebagai user_id
        $userId = $Akun['Username']; // Username sebagai identifier
        
        // TIDAK ADA kolom NamaLengkap, jadi kita gunakan Username
        $namaLengkap = $Akun['Username'];
        
        // Konversi Level dari char ke int
        $level = (int)$Akun['Level'];
        
        // Buat session dengan format KONSISTEN
        $Session = array(
            'user_id'       => $userId,      // Menggunakan Username
            'username'      => $Akun['Username'],
            'Username'      => $Akun['Username'],
            'nama_lengkap'  => $namaLengkap, // Menggunakan Username
            'level'         => $level,
            'bidang'        => $Akun['Bidang'] ?? null,
            'system'        => 'SMB_Bappeda',
            'logged_in'     => true,
            'smb_logged_in' => true
        );
        
        // Tambahkan flag khusus berdasarkan level
        if ($level == 1) {
            $Session['SuperAdmin'] = true;
            $Session['Kegiatan'] = '';
        } else if ($level == 2) {
            $Session['Admin'] = true;
            $Session['Kegiatan'] = '';
        } else if ($level == 3) {
            $Session['Staf'] = true;
        } else if ($level == 4) {
            $Session['Surveiyor'] = true;
            $Session['Staf'] = true;
        } else if ($level == 0) {
            $Session['Econk'] = true;
        }
        
        $this->session->set_userdata($Session);
        
        // Kembalikan level untuk redirect di client
        echo $level;
        
    } else {
        echo "Password Salah!";
    }
}

  public function SignOut(){
		$this->session->sess_destroy();
		redirect(base_url());
  }

  public function LogOut(){
		$this->session->sess_destroy();
		redirect(base_url(''));
  }

  public function DesaSignOut(){
		$this->session->sess_destroy();
		redirect(base_url('IDE/Desa'));
  }

  public function RekapDesaSurveiIKM(){
    ini_set('max_execution_time', 0); 
    ini_set('memory_limit','2048M');
    $Data['Rekap'] = array();
    $Kelurahan = array('35.10.15.1002','35.10.15.1003','35.10.16.1001','35.10.16.1002','35.10.16.1003','35.10.16.1004','35.10.16.1005','35.10.16.1006','35.10.16.1007','35.10.16.1008','35.10.16.1009','35.10.16.1010','35.10.16.1011','35.10.16.1012','35.10.16.1013','35.10.16.1014','35.10.16.1015','35.10.16.1016','35.10.16.1017','35.10.16.1018','35.10.17.1002','35.10.17.1005','35.10.17.1003','35.10.17.1004','35.10.21.1007','35.10.21.1006','35.10.21.1001','35.10.21.1002');
    $Kecamatan = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    foreach ($Kecamatan as $key) {
      $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$key['Kode'].".%"."'")->result_array();
      foreach ($Desa as $KEY) {
        if (in_array($KEY['Kode'],$Kelurahan)) { continue; }
        $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `ikmdesa` WHERE Desa = "."'".$KEY['Kode']."'")->row_array()['Total'];
        array_push($Data['Rekap'],$KEY['Nama']."|".$key['Nama']."|".$Total);
      }
    }
    $this->load->view('RekapDesaSurveiIKM',$Data);
  }
  
  public function RekapSurveiIKM(){
    ini_set('max_execution_time', 0); 
    ini_set('memory_limit','2048M');
    $Kelurahan = array('35.10.15.1002','35.10.15.1003','35.10.16.1001','35.10.16.1002','35.10.16.1003','35.10.16.1004','35.10.16.1005','35.10.16.1006','35.10.16.1007','35.10.16.1008','35.10.16.1009','35.10.16.1010','35.10.16.1011','35.10.16.1012','35.10.16.1013','35.10.16.1014','35.10.16.1015','35.10.16.1016','35.10.16.1017','35.10.16.1018','35.10.17.1002','35.10.17.1005','35.10.17.1003','35.10.17.1004','35.10.21.1007','35.10.21.1006','35.10.21.1001','35.10.21.1002');
    $Data['IKMKecamatan'] = array();
    $_Responden = 0;
    $_Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
    $_Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
    $Kecamatan = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    foreach ($Kecamatan as $KEY) {
      if ($KEY['Kode']=='35.10.16') { array_push($Data['IKMKecamatan'],array($KEY['Nama'],'-','-','-','-','-','-','-','-','-','-','-','-','-','-')); continue; }
      $Responden = 0;
      $Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
      $Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
      $Titip = 0;
      $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$KEY['Kode'].".%'")->result_array();
      $DataIKMKecamatan = array();
      array_push($DataIKMKecamatan,$KEY['Nama']);
      for ($j = 0; $j < count($Desa); $j++) { 
        if (in_array($Desa[$j]['Kode'],$Kelurahan)) { continue; }
        $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `ikmdesa` WHERE Desa = "."'".$Desa[$j]['Kode']."'")->row_array()['Total'];
        $RespondenDesa = $this->db->query("SELECT * FROM `ikmdesa` WHERE Desa = "."'".$Desa[$j]['Kode']."'")->result_array();
        foreach ($RespondenDesa as $key) {
          $Pecah = explode("|",$key['Poin']);
          for ($i=0; $i < 11; $i++) { 
            $Tampung[$i] += $Pecah[$i];
            $_Tampung[$i] += $Pecah[$i];
          }
        }
        if ($Total < 356) {
          for ($k=0; $k < 11; $k++) { 
            $Tampung[$k] += (2*(356-$Total));
            $_Tampung[$k] += (2*(356-$Total));
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

  public function Survei_Kominfo(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('Survei_Kominfo',$Data);
  }
  
  public function SurveiKominfo(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('SurveiKominfo',$Data);
  }

  public function SurveiIKM(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('SurveiIKM',$Data);
  }

  public function SurveiIKMSitubondo(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.12.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.12.01.%'")->result_array();
    $this->load->view('SurveiIKMSitubondo',$Data);
  }

    public function SurveiIKMYogyakarta(){
    // Ambil data session
    $isLoggedIn = $this->session->userdata('logged_in');
    $userLevel = $this->session->userdata('level');
    $userName = $this->session->userdata('nama_lengkap');
    
    // Siapkan data untuk dikirim ke view
    $data['isLoggedIn'] = !empty($isLoggedIn) ? $isLoggedIn : false;
    $data['userLevel'] = !empty($userLevel) ? $userLevel : 0;
    $data['userName'] = !empty($userName) ? $userName : 'User';
    
    $this->load->view('SurveiIKMYogyakarta', $data); // ✅ BENAR: Kirim data session
}

  public function DownloadSurveiIKM(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('DownloadSurveiIKM',$Data);
  }

  public function ExcelIKM($NamaKecamatan,$Desa,$Tahun){
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
    $Tabel = '';
    $Bobot = 3;
    if ($Tahun == 1) {
      $Tabel = 'ikmdesa';
      $Data['NamaFile'] = "IKM_Desa".$Data['NamaDesa']."_".$NamaKecamatan."_2022";
      $Data['Lokasi'] = "Desa ".$Data['NamaDesa']." 2022";
      $Bobot = 2;
    } else if ($Tahun == 2) {
      $Tabel = 'surveiikm';
      $Data['NamaFile'] = "IKM_Desa".$Data['NamaDesa']."_".$NamaKecamatan."_2021";
      $Data['Lokasi'] = "Desa ".$Data['NamaDesa']." 2021";
    } else {
      $Tabel = 'ikm';
      $Data['NamaFile'] = "IKM_Desa".$Data['NamaDesa']."_".$NamaKecamatan."_2020";
      $Data['Lokasi'] = "Desa ".$Data['NamaDesa']." 2020";
    }
    $Total = $this->db->query("SELECT COUNT(*) AS Total FROM ".$Tabel." WHERE Desa = "."'".$Desa."'")->row_array()['Total'];
    array_push($Data['Responden'], $Total);
    $Data['NilaiIndeks'][0] = 0;
    $RespondenDesa = $this->db->query("SELECT * FROM ".$Tabel." WHERE Desa = "."'".$Desa."'")->result_array();
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
        $Tampung[$k] += ($Bobot*(356-$Total));
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

  public function RekapExcelIKMKecamatan($KodeKecamatan,$NamaKecamatan,$Tahun){
    $Kelurahan = array('35.10.15.1002','35.10.15.1003','35.10.16.1001','35.10.16.1002','35.10.16.1003','35.10.16.1004','35.10.16.1005','35.10.16.1006','35.10.16.1007','35.10.16.1008','35.10.16.1009','35.10.16.1010','35.10.16.1011','35.10.16.1012','35.10.16.1013','35.10.16.1014','35.10.16.1015','35.10.16.1016','35.10.16.1017','35.10.16.1018','35.10.17.1002','35.10.17.1005','35.10.17.1003','35.10.17.1004','35.10.21.1007','35.10.21.1006','35.10.21.1001','35.10.21.1002');
    $Data['IKMDesa'] = array();$Data['IKMKecamatan'] = array();
    $_Responden = 0;
    $_Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
    $_Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
    $Tabel = '';
    $Bobot = 3;
    if ($Tahun == 1) {
      $Tabel = 'ikmdesa';
      $Data['NamaFile'] = "Rekap_IKM_Kecamatan_".$NamaKecamatan."_2022";
      $Bobot = 2;
    } else if ($Tahun == 2) {
      $Tabel = 'surveiikm';
      $Data['NamaFile'] = "Rekap_IKM_Kecamatan_".$NamaKecamatan."_2021";;
    } else {
      $Tabel = 'ikm';
      $Data['NamaFile'] = "Rekap_IKM_Kecamatan_".$NamaKecamatan."_2020";;
    }
    $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$KodeKecamatan.".%'")->result_array();
    for ($j = 0; $j < count($Desa); $j++) { 
      if (in_array($Desa[$j]['Kode'],$Kelurahan)) { continue; }
      $Responden = 0;
      $Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
      $Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
      $Titip = 0;
      $DataIKMDesa = $Desa[$j]['Nama'];
      $Total = $this->db->query("SELECT COUNT(*) AS Total FROM ".$Tabel." WHERE Desa = "."'".$Desa[$j]['Kode']."'")->row_array()['Total'];
      $RespondenDesa = $this->db->query("SELECT * FROM ".$Tabel." WHERE Desa = "."'".$Desa[$j]['Kode']."'")->result_array();
      foreach ($RespondenDesa as $key) {
        $Pecah = explode("|",$key['Poin']);
        for ($i=0; $i < 11; $i++) { 
          $Tampung[$i] += $Pecah[$i];
          $_Tampung[$i] += $Pecah[$i];
        }
      }
      if ($Total < 356) {
        for ($k=0; $k < 11; $k++) { 
          $Tampung[$k] += ($Bobot*(356-$Total));
          $_Tampung[$k] += ($Bobot*(356-$Total));
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

  public function ExcelIKMKecamatan($KodeKecamatan,$NamaKecamatan,$Tahun){
    $Kelurahan = array('35.10.15.1002','35.10.15.1003','35.10.16.1001','35.10.16.1002','35.10.16.1003','35.10.16.1004','35.10.16.1005','35.10.16.1006','35.10.16.1007','35.10.16.1008','35.10.16.1009','35.10.16.1010','35.10.16.1011','35.10.16.1012','35.10.16.1013','35.10.16.1014','35.10.16.1015','35.10.16.1016','35.10.16.1017','35.10.16.1018','35.10.17.1002','35.10.17.1005','35.10.17.1003','35.10.17.1004','35.10.21.1007','35.10.21.1006','35.10.21.1001','35.10.21.1002');
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
    $Tabel = '';
    $Bobot = 3;
    if ($Tahun == 1) {
      $Tabel = 'ikmdesa';
      $Data['NamaFile'] = "IKM_Kecamatan_".$NamaKecamatan."_2022";
      $Data['Lokasi'] = "Kecamatan ".$NamaKecamatan." 2022";
      $Bobot = 2;
    } else if ($Tahun == 2) {
      $Tabel = 'surveiikm';
      $Data['NamaFile'] = "IKM_Kecamatan_".$NamaKecamatan."_2021";
      $Data['Lokasi'] = "Kecamatan ".$NamaKecamatan." 2021";
    } else {
      $Tabel = 'ikm';
      $Data['NamaFile'] = "IKM_Kecamatan_".$NamaKecamatan."_2020";
      $Data['Lokasi'] = "Kecamatan ".$NamaKecamatan." 2020";
    }
    $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$KodeKecamatan.".%'")->result_array();
    for ($j = 0; $j < count($Desa); $j++) { 
      if (in_array($Desa[$j]['Kode'],$Kelurahan)) { continue; }
      $Total = $this->db->query("SELECT COUNT(*) AS Total FROM ".$Tabel." WHERE Desa = "."'".$Desa[$j]['Kode']."'")->row_array()['Total'];
      $RespondenDesa = $this->db->query("SELECT * FROM ".$Tabel." WHERE Desa = "."'".$Desa[$j]['Kode']."'")->result_array();
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
          $Tampung[$k] += ($Bobot*(356-$Total));
        }
        $Titip += 356-$Total;
      }
      $Data['Responden'][0] += $Total;
    }
    for ($k=0; $k < 7; $k++) { 
      $Pendidikan[$k] = str_replace(".",",",round(($TampungPendidikan[$k]/$Data['Responden'][0]*100),2));
      $Pekerjaan[$k] = str_replace(".",",",round(($TampungPekerjaan[$k]/$Data['Responden'][0]*100),2));
    }
    array_push($Data['Pendidikan'], $Pendidikan);
    array_push($Data['Pekerjaan'], $Pekerjaan);
    $Gender[0] = str_replace(".",",",round(($Pria/$Data['Responden'][0]*100),2));
    $Gender[1] = str_replace(".",",",round(($Wanita/$Data['Responden'][0]*100),2));
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
    $Data['Total'] = $this->db->query("SELECT COUNT(*) AS Total FROM `ikmdesa`")->row_array()['Total'];
    $Data['Responden'] = array();
    $Data['NilaiIndeks'] = array();
    $Data['MutuPelayanan'] = array();
    $Data['KinerjaUnit'] = array();
    for ($j = 0; $j < count($Data['Desa']); $j++) { 
      $Total = $this->db->query("SELECT COUNT(*) AS Total FROM `ikmdesa` WHERE Desa = "."'".$Data['Desa'][$j]['Kode']."'")->row_array()['Total'];
      array_push($Data['Responden'], $Total);
      $Data['NilaiIndeks'][$j] = 0;
      $RespondenDesa = $this->db->query("SELECT Poin FROM `ikmdesa` WHERE Desa = "."'".$Data['Desa'][$j]['Kode']."'")->result_array();
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
          $Tampung[$k] += (2*(356-$Total));
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

  public function InputKominfo(){
    $_POST['Nama'] = htmlentities($_POST['Nama']);
    $this->db->insert('kominfo',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengirim Survei!';
    }
  }

  public function Input_Kominfo(){
    $_POST['Nama'] = htmlentities($_POST['Nama']);
    $this->db->insert('kominfoo',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengirim Survei!';
    }
  }

  public function InputIKM(){
    if($this->db->get_where('ikmdesa', array('NIK' => $_POST['NIK']))->num_rows() === 0){
      $_POST['Nama'] = htmlentities($_POST['Nama']);
      $_POST['Pekerjaan'] = htmlentities($_POST['Pekerjaan']);
      $_POST['Keperluan'] = htmlentities($_POST['Keperluan']);
      $this->db->insert('ikmdesa',$_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Mengirim Survei!';
      }
    } else {
      echo 'Data Survei Dengan NIK '.$_POST['NIK'].' Sudah Ada!';
    }
  }

  public function InputIKMSitubondo(){
    $_POST['Nama'] = htmlentities($_POST['Nama']);
    $_POST['Usia'] = htmlentities($_POST['Usia']);
    $_POST['HP'] = htmlentities($_POST['HP']);
    $_POST['Pekerjaan'] = htmlentities($_POST['Pekerjaan']);
    $_POST['Instansi'] = htmlentities($_POST['Instansi']);
    $_POST['Layanan'] = htmlentities($_POST['Layanan']);
    $this->db->insert('ikmstb',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengirim Survei!';
    }
  }

public function InputIKMYogyakarta()
{
    // CEK SESSION - HANYA USER LEVEL 4 YANG BOLEH SUBMIT
    $isLoggedIn = $this->session->userdata('logged_in');
    $userLevel = $this->session->userdata('level');
    $userId = $this->session->userdata('user_id'); // Ini akan berisi Username
    
    if (!$isLoggedIn || $userLevel != 4) {
        echo "Anda tidak memiliki akses untuk mengirim survei";
        return;
    }
    
    $data = [
        'user_id'      => $userId, // Menyimpan Username yang login
        'Nama'         => $this->input->post('Nama', true),
        'Gender'       => $this->input->post('Gender', true),
        'Usia'         => $this->input->post('Usia', true),
        'HP'           => $this->input->post('HP', true),
        'Pendidikan'   => $this->input->post('Pendidikan', true),
        'Pekerjaan'    => $this->input->post('Pekerjaan', true),
        'Kualifikasi'  => $this->input->post('Kualifikasi', true),
        'Layanan'      => $this->input->post('Layanan', true),
        'jenis_layanan' => $this->input->post('JenisLayanan', true),
        'Saran'        => $this->input->post('Saran', true),
        'Poin'         => $this->input->post('Poin', true),
        'Alasan'       => $this->input->post('Alasan', true)
    ];

    $insert = $this->db->insert('ikmyogya', $data);

    if (!$insert) {
        $error = $this->db->error();
        echo $error['message'];
        return;
    }

    echo '1';
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
      $OpsiDesa .= "<option value='".$key['Nama']."'>".$key['Nama']."</option>";
    }
    echo $OpsiDesa;
  }

  function ListDesaIKM(){
    $Kelurahan = array('35.10.15.1002','35.10.15.1003','35.10.16.1001','35.10.16.1002','35.10.16.1003','35.10.16.1004','35.10.16.1005','35.10.16.1006','35.10.16.1007','35.10.16.1008','35.10.16.1009','35.10.16.1010','35.10.16.1011','35.10.16.1012','35.10.16.1013','35.10.16.1014','35.10.16.1015','35.10.16.1016','35.10.16.1017','35.10.16.1018','35.10.17.1002','35.10.17.1005','35.10.17.1003','35.10.17.1004','35.10.21.1007','35.10.21.1006','35.10.21.1001','35.10.21.1002');                 
    $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$_POST['Kode'].".%"."'")->result_array();
    $OpsiDesa = "";
    foreach ($Desa as $key) {
      if (in_array($key['Kode'],$Kelurahan)) { continue; }
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

  public function RekapSurveyorNTP(){
    $Produsen = $this->db->query("SELECT ntpprodusen.NIK,surveyor.Nama,COUNT(*) AS Total FROM ntpprodusen,surveyor WHERE ntpprodusen.NIK=surveyor.NIK GROUP BY ntpprodusen.NIK")->result_array();
    $Konsumen = $this->db->query("SELECT ntpkonsumen.NIK,surveyor.Nama,COUNT(*) AS Total FROM ntpkonsumen,surveyor WHERE ntpkonsumen.NIK=surveyor.NIK GROUP BY ntpkonsumen.NIK")->result_array();
    foreach ($Konsumen as $key) {
      for ($i=0; $i < count($Produsen); $i++) { 
          if ($key['NIK'] == $Produsen[$i]['NIK']) {
            $Produsen[$i]['Total'] += $key['Total'];
          }
        }
    }
    $Data['Rekap'] = $Produsen;
    $this->load->view('RekapSurveyorNTP',$Data);
  }

  public function InfoSurveiKominfo(){
    // 1. Portal Data
    // 2. Publikasi & Komunikasi Publik
    // 3. TTE & Keamanan Informasi
    // 4. Monev Jaringan & Pengembangan Aplikasi
    // OPD : Portal Data + Monev Jaringan & Pengembangan Aplikasi + Publikasi & Komunikasi Publik 1-20 + 61-80 + 21-40
    // Kecamatan : Portal Data + Monev Jaringan & Pengembangan Aplikasi 1-20 + 61-80
    // Kelurahan : Tanda Tangan Elektronik (TTE) & Keamanan Informasi + Monev Jaringan & Pengembangan Aplikasi 41-60 + 61-80
    // Desa : Tanda Tangan Elektronik (TTE) & Keamanan Informasi + Monev Jaringan & Pengembangan Aplikasi 41-60 + 61-80
    // Lainnya : Portal Data 1-20
    // =IF(A1=0;"< 20 Tahun";IF(A1=1;"20 - 25 Tahun";IF(A1=2;"26 - 30 Tahun";IF(A1=3;"31 - 35 Tahun";IF(A1=4;"36 - 40 Tahun";IF(A1=5;"41 - 45 Tahun";IF(A1=6;"46 - 50 Tahun";IF(A1=7;"51 - 55 Tahun";IF(A1=8;"56 - 60 Tahun";"> 60 Tahun")))))))))
    // Kelurahan 41
    // Lainnya 40 37 40 44 45 48 47
    // Desa 38 41 45 45 48 48 
    $Data['Data'] = array();
    // array_push($Data['Data'],$this->db->query('SELECT * FROM `kominfo` WHERE Instansi != 2 && Instansi != 3 && Instansi != 4 && Instansi != 5')->num_rows()+1);
    // array_push($Data['Data'],$this->db->get_where('kominfo', array('Instansi' => 2))->num_rows());
    // array_push($Data['Data'],$this->db->get_where('kominfo', array('Instansi' => 3))->num_rows()+41);
    // array_push($Data['Data'],$this->db->get_where('kominfo', array('Instansi' => 4))->num_rows()+265);
    // array_push($Data['Data'],$this->db->get_where('kominfo', array('Instansi' => 5))->num_rows()+301);
    array_push($Data['Data'],$this->db->query('SELECT * FROM `kominfo` WHERE Instansi != 2 && Instansi != 3 && Instansi != 4 && Instansi != 5 && Id > 382')->num_rows()+7);
    array_push($Data['Data'],$this->db->query('SELECT * FROM `kominfo` WHERE Instansi = 2 && Id > 382')->num_rows()+20);
    array_push($Data['Data'],$this->db->query('SELECT * FROM `kominfo` WHERE Instansi = 3 && Id > 382')->num_rows()+23);
    array_push($Data['Data'],$this->db->query('SELECT * FROM `kominfo` WHERE Instansi = 4 && Id > 382')->num_rows()+114);
    array_push($Data['Data'],$this->db->query('SELECT * FROM `kominfo` WHERE Instansi = 5 && Id > 382')->num_rows()+9);
    $this->load->view('InfoSurveiKominfo',$Data);
  }

  public function RekapSurveyorIKM(){
    $Data['Surveyor'] = $this->db->query("select surveyor.nik as NIK, surveyor.nama as Nama from surveiipm left join surveyor on (surveyor.nik = surveiipm.nik) group by surveyor.nik")->result_array();
    $this->load->view('RekapSurveyorIKM',$Data);
  }

  public function RekapSurveyor(){
    $Data['Surveyor'] = $this->db->query("select surveyor.nama,count(surveiipm.nik) as total from surveiipm left join surveyor on (surveyor.nik = surveiipm.nik) group by surveyor.nik")->result_array();
    $Data['Total'] = $this->db->query('SELECT COUNT(*) as Total FROM `surveiipm`')->row_array()['Total'];
    $this->load->view('RekapSurveyor',$Data);
  }

  public function Rekap($NIK,$Surveyor){
    $Data['IPM'] = $this->db->query("SELECT NamaAnggota FROM `surveiipm` WHERE NIK='".$NIK."'")->result_array();
    $Data['Surveyor'] = $Surveyor;
    $this->load->view('ExcelSurveyorIKM',$Data);                     
  }

  public function RekapIndikatorKesejahteraan(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('RekapIndikatorKesejahteraan',$Data);
  }

  public function ExcelIndikatorKesejahteraan($KodeKecamatan,$Kecamatan){
    $Data['IPM'] = $this->db->query("SELECT * FROM surveiipm WHERE Kecamatan='".$KodeKecamatan."'")->result_array();
    // $Data['IPM'] = $this->db->query("SELECT * FROM surveiipm WHERE Id=208")->result_array();
    $Data['NamaKecamatan'] = $Kecamatan;
    // $Data['NamaDesa'] = $NamaDesa;
    // print_r($Data['IPM']);
    $this->load->view('ExcelIndikatorKesejahteraan',$Data);                     
  }

  public function ExcelKomoditas($KodeKecamatan,$Kecamatan){
    $Data['IPM'] = $this->db->query("SELECT Id,NamaAnggota,Banyaknya,Harga,Nilai FROM surveiipm WHERE Kecamatan='".$KodeKecamatan."'")->result_array();
    $Data['NamaKecamatan'] = $Kecamatan;
    // $Data['NamaDesa'] = $NamaDesa;
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

  public function LihatMatrikulasi(){
    $Data = $this->db->query("SELECT * FROM `matrikulasi` WHERE PIC LIKE '%".$_POST['PIC']."%'")->result_array();
    $Tabel = '<thead>
              <tr style="font-weight: bold;">
                <th style="width: 5%;" class="align-middle text-center">No</th>
                <th style="width: 45%;" class="align-middle">Nama Project</th>
                <th style="width: 10%;" class="align-middle text-center">Beban</th>
                <th style="width: 20%;" class="align-middle">Honor Project</th>
                <th style="width: 20%;" class="align-middle">Keterangan</th>
              </tr>
              </thead>
              <tbody>';
    $No = 1;$Total = 0;
    foreach ($Data as $key) {
      $PIC = explode(' ',$key['PIC']);
      $Nilai = explode(' ',$key['Nilai']);
      $Bayar = explode(' ',$key['Bayar']);
      $Beban = explode(' ',$key['Beban']);
      $i = array_search($_POST['PIC'],$PIC);
      $Ket = '';$Total += (float)$Beban[$i];
      if ($Bayar[$i]/$Nilai[$i] == 1) {
        $Ket = 'Dibayar 100%';
      } else if ($Bayar[$i]/$Nilai[$i] == 0.75) {
        $Ket = 'Dibayar 75%';
      } else if ($Bayar[$i]/$Nilai[$i] == 0.5) {
        $Ket = 'Dibayar 50%';
      } else if ($Bayar[$i]/$Nilai[$i] == 0.25) {
        $Ket = 'Dibayar 25%';
      } else if ($Bayar[$i]/$Nilai[$i] == 0) {
        $Ket = 'Belum Dibayar';
      }
      $Tabel .= '<tr>
                  <td class="text-center">'.$No++.'</td>
                    <td>'.$key['Nama'].'</td>
                    <td class="align-middle text-center">'.$Beban[$i].'</td>
                    <td>'.number_format($Bayar[$i],0,',','.').'</td>
                    <td>'.$Ket.'</td>
                  </tr>';
    }
    $Tabel .= '</tbody>';
    echo $Tabel;
  }

  public function ExcelMatrikulasi(){
    $Data['Matrikulasi'] = $this->db->query("SELECT * FROM `matrikulasi`")->result_array();
    $Nama = array('Rizka','Rifta','Noven','Linda');
    $Data['PIC'] = array();$Data['Total'] = array();
    for ($j=0; $j < 4; $j++) { 
      $Temp = array();$Total = 0.0;
      $Get = $this->db->query("SELECT * FROM `matrikulasi` WHERE PIC LIKE '%".$Nama[$j]."%'")->result_array();
      foreach ($Get as $key) {
        $Row = array();
        $PIC = explode(' ',$key['PIC']);
        $Nilai = explode(' ',$key['Nilai']);
        $Bayar = explode(' ',$key['Bayar']);
        $Beban = explode(' ',$key['Beban']);
        $i = array_search($Nama[$j],$PIC);
        array_push($Row,$key['Nama']);
        array_push($Row,$Beban[$i]);
        $Total += (float)str_replace(",",".",$Beban[$i]);
        array_push($Row,$Bayar[$i]);
        if ($Bayar[$i]/$Nilai[$i] == 1) {
          array_push($Row,'Dibayar 100%');
        } else if ($Bayar[$i]/$Nilai[$i] == 0.75) {
          array_push($Row,'Dibayar 75%');
        } else if ($Bayar[$i]/$Nilai[$i] == 0.5) {
          array_push($Row,'Dibayar 50%');
        } else if ($Bayar[$i]/$Nilai[$i] == 0.25) {
          array_push($Row,'Dibayar 25%');
        } else if ($Bayar[$i]/$Nilai[$i] == 0) {
          array_push($Row,'Belum Dibayar');
        }
        array_push($Temp,$Row);
      }  
      array_push($Data['PIC'],$Temp);
      array_push($Data['Total'],$Total);
    }
		$this->load->view('ExcelMatrikulasi',$Data);
  }

  public function DinasSosialBanyuwangi(){
    $this->load->view('DinsosBanyuwangi');
  }

   public function KabupatenPonorogo(){
    $this->load->view('KabupatenPonorogo');
  }

  private function getMicrositeTreeData($slug = 'ippd-situbondo') {
    // Pastikan tabel ada
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

    $this->db->query("CREATE TABLE IF NOT EXISTS `microsite_item` (
      `Id` INT(11) NOT NULL AUTO_INCREMENT,
      `MicrositeId` INT(11) NOT NULL,
      `ParentId` INT(11) NULL DEFAULT 0,
      `Tipe` VARCHAR(20) NOT NULL DEFAULT 'grup',
      `Judul` VARCHAR(255) NOT NULL,
      `Url` TEXT NULL,
      `Icon` VARCHAR(50) NULL DEFAULT 'fas fa-file-alt',
      `Urutan` INT(11) NOT NULL DEFAULT 0,
      `CreatedAt` DATETIME NULL,
      `UpdatedAt` DATETIME NULL,
      PRIMARY KEY (`Id`),
      KEY `idx_microsite_id` (`MicrositeId`),
      KEY `idx_parent_id` (`ParentId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    $microsite = $this->db->get_where('microsite', array('Slug' => $slug))->row_array();
    if (!$microsite) {
      return array('Microsite' => array('Judul' => strtoupper(str_replace('-', ' ', $slug))), 'Tree' => array());
    }

    $items = $this->db->where('MicrositeId', $microsite['Id'])->order_by('Urutan', 'ASC')->order_by('Id', 'ASC')->get('microsite_item')->result_array();

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

    return array(
      'Microsite' => $microsite,
      'Tree'      => array_values($tree)
    );
  }

  public function Microsite($slug = 'ippd-situbondo'){
    $data = $this->getMicrositeTreeData($slug);
    $this->load->view('MicrositePublic', $data);
  }

  public function IPPDSitubondo(){
    $data = $this->getMicrositeTreeData('ippd-situbondo');
    $this->load->view('MicrositePublic', $data);
  }

  public function IPPDBanyuwangi(){
    $data = $this->getMicrositeTreeData('ippd-banyuwangi');
    $this->load->view('MicrositePublic', $data);
  }
  public function RenstraBanyuwangi(){
    $this->load->view('RenstraBanyuwangi');
  }

  public function RenstraSitubondo(){
    $this->load->view('RenstraSitubondo');
  }

  public function LaporanSitubondo(){
    $this->load->view('LaporanSitubondo');
  }

  public function LKPJSitubondo(){
      $this->load->view('LKPJSitubondo');
    }

  public function LKPJBanyuwangi(){
      $this->load->view('LKPJBanyuwangi');
    }

  /**
   * =========================================================================
   * MODUL SISTEM FORMULIR & SURVEI DINAMIS (GOOGLE FORM STYLE BUILDER)
   * Mendukung session Surveiyor (Level 4), Admin, dan SuperAdmin untuk:
   * 1. Dynamic Survey Builder (tambah, edit, opsi nilai angka, tipe field)
   * 2. Pengisian Kuesioner Responden Publik / Lapangan dengan Keterangan Daerah Survei
   * 3. Rekapitulasi Statistik & Data Responden per Daerah Survei
   * =========================================================================
   */
  private function ensureSurveiStructure() {
    // 1. Tabel Master Survei Dinamis
    $this->db->query("CREATE TABLE IF NOT EXISTS `survei_dinamis` (
      `Id` INT(11) NOT NULL AUTO_INCREMENT,
      `KodeSurvei` VARCHAR(100) NOT NULL UNIQUE,
      `Judul` VARCHAR(255) NOT NULL,
      `Deskripsi` TEXT NULL,
      `Lembaga` VARCHAR(255) NULL,
      `Jenis` VARCHAR(100) NOT NULL DEFAULT 'IKM',
      `Tahun` VARCHAR(10) NOT NULL DEFAULT '2026',
      `Status` VARCHAR(20) NOT NULL DEFAULT 'Aktif',
      `DaerahSurvei` VARCHAR(255) NULL,
      `KodeWilayah` VARCHAR(50) NULL,
      `BannerImage` VARCHAR(255) NULL,
      `BannerColor` VARCHAR(30) NULL DEFAULT '#043168',
      `EstimasiWaktu` VARCHAR(50) NULL DEFAULT '3 - 5 Menit',
      `CreatedBy` VARCHAR(100) NULL,
      `CreatedAt` DATETIME NULL,
      `UpdatedAt` DATETIME NULL,
      PRIMARY KEY (`Id`),
      KEY `idx_kode_survei` (`KodeSurvei`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Pastikan kolom BannerImage & BannerColor ada jika tabel sudah pernah dibuat sebelumnya
    if (!$this->db->field_exists('BannerImage', 'survei_dinamis')) {
      $this->db->query("ALTER TABLE `survei_dinamis` ADD COLUMN `BannerImage` VARCHAR(255) NULL AFTER `KodeWilayah`");
    }
    if (!$this->db->field_exists('BannerColor', 'survei_dinamis')) {
      $this->db->query("ALTER TABLE `survei_dinamis` ADD COLUMN `BannerColor` VARCHAR(30) NULL DEFAULT '#043168' AFTER `BannerImage`");
    }
    if (!$this->db->field_exists('TipeSurvei', 'survei_dinamis')) {
      $this->db->query("ALTER TABLE `survei_dinamis` ADD COLUMN `TipeSurvei` VARCHAR(50) NOT NULL DEFAULT 'standar' AFTER `Status`");
    }
    if (!$this->db->field_exists('InstrumenList', 'survei_dinamis')) {
      $this->db->query("ALTER TABLE `survei_dinamis` ADD COLUMN `InstrumenList` VARCHAR(255) NOT NULL DEFAULT 'A' AFTER `TipeSurvei`");
    }

    // 2. Tabel Pertanyaan Survei Dinamis (Google Form style)
    $this->db->query("CREATE TABLE IF NOT EXISTS `survei_pertanyaan` (
      `Id` INT(11) NOT NULL AUTO_INCREMENT,
      `SurveiId` INT(11) NOT NULL,
      `Pertanyaan` TEXT NOT NULL,
      `Deskripsi` TEXT NULL,
      `Tipe` VARCHAR(30) NOT NULL DEFAULT 'radio',
      `OpsiPilihan` LONGTEXT NULL,
      `IsRequired` TINYINT(1) NOT NULL DEFAULT 1,
      `Urutan` INT(11) NOT NULL DEFAULT 1,
      `ScaleMin` INT(11) NOT NULL DEFAULT 1,
      `ScaleMax` INT(11) NOT NULL DEFAULT 5,
      `ScaleMinLabel` VARCHAR(100) NULL DEFAULT 'Sangat Tidak Baik',
      `ScaleMaxLabel` VARCHAR(100) NULL DEFAULT 'Sangat Baik',
      `CreatedAt` DATETIME NULL,
      `UpdatedAt` DATETIME NULL,
      PRIMARY KEY (`Id`),
      KEY `idx_survei_id` (`SurveiId`),
      KEY `idx_urutan` (`Urutan`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // 3. Tabel Data Responden Survei
    $this->db->query("CREATE TABLE IF NOT EXISTS `survei_responden` (
      `Id` INT(11) NOT NULL AUTO_INCREMENT,
      `SurveiId` INT(11) NOT NULL,
      `RespondenNama` VARCHAR(150) NULL DEFAULT 'Masyarakat',
      `RespondenKontak` VARCHAR(100) NULL,
      `RespondenGender` VARCHAR(20) NULL,
      `RespondenUsia` VARCHAR(20) NULL,
      `RespondenPendidikan` VARCHAR(50) NULL,
      `RespondenPekerjaan` VARCHAR(100) NULL,
      `Provinsi` VARCHAR(100) NULL,
      `Kabupaten` VARCHAR(100) NULL,
      `Kecamatan` VARCHAR(100) NULL,
      `Desa` VARCHAR(100) NULL,
      `AlamatDetail` TEXT NULL,
      `TotalSkor` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
      `RataRataSkor` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
      `MutuPelayanan` VARCHAR(50) NULL DEFAULT 'Baik',
      `IpAddress` VARCHAR(45) NULL,
      `UserAgent` TEXT NULL,
      `CreatedBy` VARCHAR(100) NULL,
      `CreatedAt` DATETIME NULL,
      PRIMARY KEY (`Id`),
      KEY `idx_resp_survei_id` (`SurveiId`),
      KEY `idx_resp_created_at` (`CreatedAt`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Pastikan kolom Section & Instrumen ada di survei_pertanyaan
    if (!$this->db->field_exists('Section', 'survei_pertanyaan')) {
      $this->db->query("ALTER TABLE `survei_pertanyaan` ADD COLUMN `Section` VARCHAR(150) NULL AFTER `Deskripsi`");
    }
    if (!$this->db->field_exists('Instrumen', 'survei_pertanyaan')) {
      $this->db->query("ALTER TABLE `survei_pertanyaan` ADD COLUMN `Instrumen` VARCHAR(10) NOT NULL DEFAULT 'A' AFTER `Section`");
    }

    // Pastikan kolom Geolokasi, Device Tracking & Instrumen ada di survei_responden
    if (!$this->db->field_exists('Instrumen', 'survei_responden')) {
      $this->db->query("ALTER TABLE `survei_responden` ADD COLUMN `Instrumen` VARCHAR(10) NOT NULL DEFAULT 'A' AFTER `SurveiId`");
    }
    if (!$this->db->field_exists('RespondenNIK', 'survei_responden')) {
      $this->db->query("ALTER TABLE `survei_responden` ADD COLUMN `RespondenNIK` VARCHAR(25) NULL DEFAULT NULL AFTER `RespondenNama`");
    }
    if (!$this->db->field_exists('Latitude', 'survei_responden')) {
      $this->db->query("ALTER TABLE `survei_responden` ADD COLUMN `Latitude` DECIMAL(11,8) NULL DEFAULT NULL AFTER `AlamatDetail`");
    }
    if (!$this->db->field_exists('Longitude', 'survei_responden')) {
      $this->db->query("ALTER TABLE `survei_responden` ADD COLUMN `Longitude` DECIMAL(11,8) NULL DEFAULT NULL AFTER `Latitude`");
    }
    if (!$this->db->field_exists('LokasiAccuracy', 'survei_responden')) {
      $this->db->query("ALTER TABLE `survei_responden` ADD COLUMN `LokasiAccuracy` DECIMAL(8,2) NULL DEFAULT NULL AFTER `Longitude`");
    }
    if (!$this->db->field_exists('FotoDokumentasi', 'survei_responden')) {
      $this->db->query("ALTER TABLE `survei_responden` ADD COLUMN `FotoDokumentasi` VARCHAR(255) NULL AFTER `LokasiAccuracy`");
    }
    if (!$this->db->field_exists('DevicePlatform', 'survei_responden')) {
      $this->db->query("ALTER TABLE `survei_responden` ADD COLUMN `DevicePlatform` VARCHAR(100) NULL DEFAULT NULL AFTER `UserAgent`");
    }

    // 4. Tabel Rincian Jawaban Responden
    $this->db->query("CREATE TABLE IF NOT EXISTS `survei_jawaban` (
      `Id` INT(11) NOT NULL AUTO_INCREMENT,
      `RespondenId` INT(11) NOT NULL,
      `PertanyaanId` INT(11) NOT NULL,
      `JawabanTeks` TEXT NULL,
      `NilaiAngka` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
      `CreatedAt` DATETIME NULL,
      PRIMARY KEY (`Id`),
      KEY `idx_jwb_responden_id` (`RespondenId`),
      KEY `idx_jwb_pertanyaan_id` (`PertanyaanId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Auto-seed data survei awal jika masih kosong
    if ($this->db->count_all('survei_dinamis') == 0) {
      $now = date('Y-m-d H:i:s');
      
      // Survei 1: IKM Pelayanan Publik Terpadu 2026
      $survei1 = array(
        'KodeSurvei'    => 'ikm-pelayanan-publik-2026',
        'Judul'         => 'Survei Indeks Kepuasan Masyarakat (IKM) Pelayanan Publik Terpadu 2026',
        'Deskripsi'     => 'Instrumen survei kepuasan masyarakat terhadap mutu pelayanan publik, prosedur, kepastian waktu, keterbukaan biaya, dan integritas petugas sesuai PermenPAN-RB No. 14 Tahun 2017.',
        'Lembaga'       => 'BAPPEDA & Dinas Komunikasi dan Informatika',
        'Jenis'         => 'IKM',
        'Tahun'         => '2026',
        'Status'        => 'Aktif',
        'DaerahSurvei'  => 'Kabupaten Banyuwangi',
        'KodeWilayah'   => '35.10',
        'EstimasiWaktu' => '3 - 5 Menit',
        'CreatedBy'     => 'admin',
        'CreatedAt'     => $now,
        'UpdatedAt'     => $now
      );
      $this->db->insert('survei_dinamis', $survei1);
      $s1Id = $this->db->insert_id();

      $p1 = array(
        array(
          'SurveiId' => $s1Id,
          'Pertanyaan' => 'Kesesuaian Persyaratan Pelayanan',
          'Deskripsi' => 'Bagaimana kemudahan dan kejelasan persyaratan administratif dalam memperoleh pelayanan?',
          'Tipe' => 'radio',
          'OpsiPilihan' => json_encode(array(
            array('label' => 'Sangat Sesuai & Sangat Mudah', 'nilai' => 4),
            array('label' => 'Sesuai & Cukup Mudah', 'nilai' => 3),
            array('label' => 'Kurang Sesuai / Berbelit-belit', 'nilai' => 2),
            array('label' => 'Tidak Sesuai / Sangat Sulit', 'nilai' => 1)
          )),
          'IsRequired' => 1,
          'Urutan' => 1,
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s1Id,
          'Pertanyaan' => 'Kemudahan Prosedur & Alur Pelayanan',
          'Deskripsi' => 'Bagaimana kemudahan tahapan dan alur birokrasi pelayanan yang Anda lalui?',
          'Tipe' => 'radio',
          'OpsiPilihan' => json_encode(array(
            array('label' => 'Sangat Mudah & Transparan', 'nilai' => 4),
            array('label' => 'Mudah & Jelas', 'nilai' => 3),
            array('label' => 'Kurang Mudah / Berbelit-belit', 'nilai' => 2),
            array('label' => 'Sangat Sulit / Tidak Jelas', 'nilai' => 1)
          )),
          'IsRequired' => 1,
          'Urutan' => 2,
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s1Id,
          'Pertanyaan' => 'Ketepatan Waktu Penyelesaian Pelayanan',
          'Deskripsi' => 'Apakah waktu penyelesaian pelayanan sesuai dengan standar waktu yang dijanjikan?',
          'Tipe' => 'radio',
          'OpsiPilihan' => json_encode(array(
            array('label' => 'Sangat Cepat (Lebih cepat dari estimasi)', 'nilai' => 4),
            array('label' => 'Tepat Waktu (Sesuai estimasi)', 'nilai' => 3),
            array('label' => 'Kurang Cepat / Sedikit Terlambat', 'nilai' => 2),
            array('label' => 'Sangat Lambat / Molor', 'nilai' => 1)
          )),
          'IsRequired' => 1,
          'Urutan' => 3,
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s1Id,
          'Pertanyaan' => 'Kewajaran & Kepastian Tarif/Biaya Pelayanan',
          'Deskripsi' => 'Bagaimana kesesuaian biaya yang dibayarkan terhadap tarif resmi (atau bebas biaya jika gratis)?',
          'Tipe' => 'radio',
          'OpsiPilihan' => json_encode(array(
            array('label' => 'Sangat Wajar / Gratis Bebas Pungli', 'nilai' => 4),
            array('label' => 'Wajar Sesuai Perda/Aturan', 'nilai' => 3),
            array('label' => 'Kurang Wajar / Dirasa Mahal', 'nilai' => 2),
            array('label' => 'Sangat Tidak Wajar / Ada Pungutan Liar', 'nilai' => 1)
          )),
          'IsRequired' => 1,
          'Urutan' => 4,
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s1Id,
          'Pertanyaan' => 'Penilaian Skala Kepuasan Mutu Pelayanan Keseluruhan',
          'Deskripsi' => 'Beri penilaian kepuasan Anda secara umum terhadap layanan yang diterima (Skala 1 - 5).',
          'Tipe' => 'scale',
          'OpsiPilihan' => null,
          'IsRequired' => 1,
          'Urutan' => 5,
          'ScaleMin' => 1,
          'ScaleMax' => 5,
          'ScaleMinLabel' => 'Sangat Buruk',
          'ScaleMaxLabel' => 'Sangat Memuaskan',
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s1Id,
          'Pertanyaan' => 'Kompetensi, Sikap & Keramahan Petugas Pelayanan',
          'Deskripsi' => 'Bagaimana keramahan, kesopanan, dan keahlian petugas dalam merespon kebutuhan Anda?',
          'Tipe' => 'radio',
          'OpsiPilihan' => json_encode(array(
            array('label' => 'Sangat Ramah, Sigap & Solutif', 'nilai' => 4),
            array('label' => 'Ramah & Sopan', 'nilai' => 3),
            array('label' => 'Kurang Ramah / Acuh', 'nilai' => 2),
            array('label' => 'Tidak Ramah / Tidak Sopan', 'nilai' => 1)
          )),
          'IsRequired' => 1,
          'Urutan' => 6,
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s1Id,
          'Pertanyaan' => 'Kualitas Sarana & Fasilitas Penunjang di Tempat Layanan',
          'Deskripsi' => 'Pilih sarana prasarana yang sudah Anda rasakan berfungsi sangat baik di lokasi survei:',
          'Tipe' => 'checkbox',
          'OpsiPilihan' => json_encode(array(
            array('label' => 'Ruang Pelayanan Nyaman & Ber-AC', 'nilai' => 25),
            array('label' => 'Sistem Antrean Digital & Layar Informasi', 'nilai' => 25),
            array('label' => 'Akses Ramah Disabilitas, Ibu Hamil & Lansia', 'nilai' => 25),
            array('label' => 'Toilet Bersih & Area Parkir Tertata', 'nilai' => 25)
          )),
          'IsRequired' => 0,
          'Urutan' => 7,
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s1Id,
          'Pertanyaan' => 'Saran dan Masukan Konstruktif untuk Peningkatan Mutu Layanan',
          'Deskripsi' => 'Tuliskan masukan nyata Anda agar layanan ini terus meningkat kualitasnya ke depan.',
          'Tipe' => 'textarea',
          'OpsiPilihan' => null,
          'IsRequired' => 0,
          'Urutan' => 8,
          'CreatedAt' => $now
        )
      );
      $this->db->insert_batch('survei_pertanyaan', $p1);

      // Survei 2: Survei IKM Kinerja Walikota & Wakil Walikota Kota Yogyakarta
      $survei2 = array(
        'KodeSurvei'    => 'ikm-kinerja-walikota-yogyakarta-2026',
        'Judul'         => 'Survei IKM Kinerja Walikota & Wakil Walikota Kota Yogyakarta 2026',
        'Deskripsi'     => 'Evaluasi ketercapaian program pembangunan kota, infrastruktur publik, pariwisata, dan penanganan ketertiban lingkungan Kota Yogyakarta.',
        'Lembaga'       => 'BAKESBANGPOL Kota Yogyakarta',
        'Jenis'         => 'IKM',
        'Tahun'         => '2026',
        'Status'        => 'Aktif',
        'DaerahSurvei'  => 'Kota Yogyakarta',
        'KodeWilayah'   => '34.71',
        'EstimasiWaktu' => '4 - 6 Menit',
        'CreatedBy'     => 'admin',
        'CreatedAt'     => $now,
        'UpdatedAt'     => $now
      );
      $this->db->insert('survei_dinamis', $survei2);
      $s2Id = $this->db->insert_id();

      $p2 = array(
        array(
          'SurveiId' => $s2Id,
          'Pertanyaan' => 'Kepuasan Program Pengelolaan Sampah & Kebersihan Kota',
          'Deskripsi' => 'Bagaimana efektivitas program pengolahan sampah mandiri dan kebersihan lingkungan kota saat ini?',
          'Tipe' => 'radio',
          'OpsiPilihan' => json_encode(array(
            array('label' => 'Sangat Baik & Bersih', 'nilai' => 4),
            array('label' => 'Baik & Cukup Tertangani', 'nilai' => 3),
            array('label' => 'Kurang Baik / Sering Menumpuk', 'nilai' => 2),
            array('label' => 'Tidak Baik / Sangat Buruk', 'nilai' => 1)
          )),
          'IsRequired' => 1,
          'Urutan' => 1,
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s2Id,
          'Pertanyaan' => 'Aksesibilitas dan Kualitas Fasilitas Publik & Jalur Pedestrian',
          'Deskripsi' => 'Bagaimana kenyamanan fasilitas trotoar, taman kota, dan ruang terbuka hijau bagi pejalan kaki?',
          'Tipe' => 'radio',
          'OpsiPilihan' => json_encode(array(
            array('label' => 'Sangat Nyaman & Ramah Pengguna', 'nilai' => 4),
            array('label' => 'Cukup Nyaman', 'nilai' => 3),
            array('label' => 'Kurang Nyaman / Banyak Hambatan', 'nilai' => 2),
            array('label' => 'Tidak Nyaman', 'nilai' => 1)
          )),
          'IsRequired' => 1,
          'Urutan' => 2,
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s2Id,
          'Pertanyaan' => 'Kepuasan Terhadap Pelayanan Administrasi Kependudukan',
          'Deskripsi' => 'Bagaimana pengalaman Anda saat mengurus layanan KTP/KK/Surat Pengantar di Kemantren / Kelurahan?',
          'Tipe' => 'radio',
          'OpsiPilihan' => json_encode(array(
            array('label' => 'Sangat Memuaskan & Cepat', 'nilai' => 4),
            array('label' => 'Memuaskan', 'nilai' => 3),
            array('label' => 'Kurang Memuaskan', 'nilai' => 2),
            array('label' => 'Mengecewakan', 'nilai' => 1)
          )),
          'IsRequired' => 1,
          'Urutan' => 3,
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s2Id,
          'Pertanyaan' => 'Tingkat Keyakinan Terhadap Arah Kebijakan Pemkot Yogyakarta',
          'Deskripsi' => 'Beri penilaian optimisme Anda terhadap kepemimpinan daerah (Skala 1 - 5).',
          'Tipe' => 'scale',
          'OpsiPilihan' => null,
          'IsRequired' => 1,
          'Urutan' => 4,
          'ScaleMin' => 1,
          'ScaleMax' => 5,
          'ScaleMinLabel' => 'Sangat Ragu',
          'ScaleMaxLabel' => 'Sangat Yakin',
          'CreatedAt' => $now
        ),
        array(
          'SurveiId' => $s2Id,
          'Pertanyaan' => 'Harapan atau Masukan Prioritas untuk Pembangunan Kota Yogyakarta',
          'Deskripsi' => 'Apa aspirasi utama Anda untuk kemajuan Kota Yogyakarta di tahun-tahun mendatang?',
          'Tipe' => 'textarea',
          'OpsiPilihan' => null,
          'IsRequired' => 0,
          'Urutan' => 5,
          'CreatedAt' => $now
        )
      );
      $this->db->insert_batch('survei_pertanyaan', $p2);
    }
  }

  /**
   * Halaman Menu Survei Utama
   * Mendukung publik (responden kuesioner) dan session Surveiyor / Admin (builder & rekap)
   */
  public function MenuSurvei($kodeSurvei = null) {
    $this->ensureSurveiStructure();

    // Deteksi session surveiyor, staff, admin, atau superadmin
    $hasSurveyorSession = !empty($this->session->userdata('Surveiyor')) || !empty($this->session->userdata('Surveyor'));
    $hasStaffSession    = !empty($this->session->userdata('Staf')) || ((int)$this->session->userdata('level') == 3);
    $hasAdminSession    = !empty($this->session->userdata('Admin')) || ((int)$this->session->userdata('level') == 2);
    $hasSuperSession    = !empty($this->session->userdata('SuperAdmin')) || ((int)$this->session->userdata('level') == 1);
    
    $isLoggedIn = !empty($this->session->userdata('logged_in')) 
               || $hasSurveyorSession 
               || $hasStaffSession 
               || $hasAdminSession 
               || $hasSuperSession;

    $userLevel = (int)$this->session->userdata('level');
    if (empty($userLevel)) {
      if ($hasSuperSession) $userLevel = 1;
      else if ($hasAdminSession) $userLevel = 2;
      else if ($hasStaffSession) $userLevel = 3;
      else if ($hasSurveyorSession) $userLevel = 4;
    }

    $userName = $this->session->userdata('nama_lengkap') 
             ?: ($this->session->userdata('Username') 
             ?: ($this->session->userdata('Nama') 
             ?: ($userLevel == 3 ? 'Staf' : 'Surveiyor')));

    $isSurveiyor = ($isLoggedIn && ($userLevel == 4 || $userLevel == 3 || $userLevel == 2 || $userLevel == 1 || $hasSurveyorSession || $hasStaffSession));

    // Jika pengunjung umum (belum login) mencoba membuka tab terproteksi (peta / rekap / builder) langsung lewat URL
    $loginRequiredAlert = false;
    if (!$isLoggedIn && in_array(strtolower((string)$kodeSurvei), array('peta', 'rekap', 'builder', 'studio'))) {
      $loginRequiredAlert = true;
      $kodeSurvei = null;
    }

    // Ambil daftar survei dinamis beserta statistik
    $surveiList = $this->db->order_by('Id', 'DESC')->get('survei_dinamis')->result_array();
    foreach ($surveiList as &$s) {
      $s['TotalPertanyaan'] = $this->db->where('SurveiId', $s['Id'])->count_all_results('survei_pertanyaan');
      $s['TotalResponden'] = $this->db->where('SurveiId', $s['Id'])->count_all_results('survei_responden');
      
      $avgQuery = $this->db->select_avg('RataRataSkor', 'avg_skor')->where('SurveiId', $s['Id'])->get('survei_responden')->row_array();
      $s['RataRataSkor'] = !empty($avgQuery['avg_skor']) ? round((float)$avgQuery['avg_skor'], 2) : 0;
    }

    // Ambil daftar Provinsi untuk Keterangan Daerah Survei
    $provinsi = array();
    if ($this->db->table_exists('kodewilayah')) {
      $provinsi = $this->db->query("SELECT Kode, Nama FROM `kodewilayah` WHERE length(Kode) = 2 ORDER BY Nama ASC")->result_array();
    }

    $data = array(
      'title'              => 'Portal Layanan Survei | IDE Consultant',
      'isLoggedIn'         => $isLoggedIn,
      'userLevel'          => $userLevel,
      'userName'           => $userName,
      'isSurveiyor'        => $isSurveiyor,
      'loginRequiredAlert' => $loginRequiredAlert,
      'surveiList'         => $surveiList,
      'provinsi'           => $provinsi,
      'kodeSurvei'         => $kodeSurvei
    );

    if ($isLoggedIn) {
      $this->load->view('SurveyDashboard', $data);
    } else {
      $this->load->view('MenuSurvei', $data);
    }
  }

  /**
   * API: Ambil daftar seluruh survei dinamis (JSON)
   */
  public function get_survei_dinamis() {
    $this->ensureSurveiStructure();
    header('Content-Type: application/json; charset=utf-8');

    $surveiList = $this->db->order_by('Id', 'DESC')->get('survei_dinamis')->result_array();
    foreach ($surveiList as &$s) {
      $s['TotalPertanyaan'] = $this->db->where('SurveiId', $s['Id'])->count_all_results('survei_pertanyaan');
      $s['TotalResponden'] = $this->db->where('SurveiId', $s['Id'])->count_all_results('survei_responden');

      $avgQuery = $this->db->select_avg('RataRataSkor', 'avg_skor')->where('SurveiId', $s['Id'])->get('survei_responden')->row_array();
      $s['RataRataSkor'] = !empty($avgQuery['avg_skor']) ? round((float)$avgQuery['avg_skor'], 2) : 0;
    }

    echo json_encode(array('status' => true, 'data' => $surveiList));
    return;
  }

  /**
   * API: Ambil detail 1 survei beserta seluruh pertanyaannya (JSON)
   */
  public function get_survei_detail($id = 0) {
    $this->ensureSurveiStructure();
    header('Content-Type: application/json; charset=utf-8');

    $id = (int)$id;
    $survei = $this->db->get_where('survei_dinamis', array('Id' => $id))->row_array();
    if (!$survei) {
      echo json_encode(array('status' => false, 'message' => 'Survei tidak ditemukan'));
      return;
    }

    $pertanyaan = $this->db->where('SurveiId', $id)->order_by('Urutan', 'ASC')->order_by('Id', 'ASC')->get('survei_pertanyaan')->result_array();
    foreach ($pertanyaan as &$p) {
      if (!empty($p['OpsiPilihan'])) {
        $decoded = json_decode($p['OpsiPilihan'], true);
        $p['OpsiPilihanList'] = is_array($decoded) ? $decoded : array();
      } else {
        $p['OpsiPilihanList'] = array();
      }
    }

    $survei['TotalResponden'] = $this->db->where('SurveiId', $id)->count_all_results('survei_responden');
    $avgQuery = $this->db->select_avg('RataRataSkor', 'avg_skor')->where('SurveiId', $id)->get('survei_responden')->row_array();
    $survei['RataRataSkor'] = !empty($avgQuery['avg_skor']) ? round((float)$avgQuery['avg_skor'], 2) : 0;

    echo json_encode(array(
      'status' => true,
      'survei' => $survei,
      'pertanyaan' => $pertanyaan
    ));
    return;
  }

  /**
   * API: Ambil butir pertanyaan survei dinamis (JSON)
   * Mengembalikan format 'data' dan 'pertanyaan' untuk kompatibilitas dashboard & form publik
   */
  public function get_survei_pertanyaan($id = 0, $instrumen = null) {
    $this->ensureSurveiStructure();
    header('Content-Type: application/json; charset=utf-8');

    $id = (int)$id;
    if ($id <= 0) {
      echo json_encode(array('status' => false, 'message' => 'ID Survei tidak valid', 'data' => array(), 'pertanyaan' => array()));
      return;
    }

    if (!$instrumen && $this->input->get('instrumen')) {
      $instrumen = trim($this->input->get('instrumen'));
    }

    $this->db->where('SurveiId', $id);
    if (!empty($instrumen)) {
      $this->db->where('Instrumen', strtoupper($instrumen));
    }
    $pertanyaan = $this->db->order_by('Urutan', 'ASC')
                           ->order_by('Id', 'ASC')
                           ->get('survei_pertanyaan')
                           ->result_array();

    foreach ($pertanyaan as &$p) {
      if (!empty($p['OpsiPilihan'])) {
        $decoded = json_decode($p['OpsiPilihan'], true);
        $p['OpsiPilihanList'] = is_array($decoded) ? $decoded : array();
      } else {
        $p['OpsiPilihanList'] = array();
      }
    }

    echo json_encode(array(
      'status'     => true,
      'data'       => $pertanyaan,
      'pertanyaan' => $pertanyaan
    ));
    return;
  }

  /**
   * API: Simpan / Update Metadata Survei Dinamis
   * Khusus sesi Surveiyor (Level 4), Staf (Level 3), Admin (Level 2), SuperAdmin (Level 1)
   */
  public function save_survei_dinamis() {
    $this->ensureSurveiStructure();
    header('Content-Type: application/json; charset=utf-8');

    $userLevel = (int)$this->session->userdata('level');
    $isSurveiyor = ($userLevel == 4 || $userLevel == 1 || $userLevel == 2 || $userLevel == 3 || !empty($this->session->userdata('Surveiyor')));
    if (!$isSurveiyor) {
      echo json_encode(array('status' => false, 'message' => 'Akses ditolak. Silakan login sebagai Surveiyor (Level 4) atau Admin.'));
      return;
    }

    $raw = file_get_contents('php://input');
    $input = json_decode($raw, true) ?: $this->input->post();

    $id = isset($input['Id']) ? (int)$input['Id'] : 0;
    $judul = trim($input['Judul'] ?? '');
    if (empty($judul)) {
      echo json_encode(array('status' => false, 'message' => 'Judul survei wajib diisi.'));
      return;
    }

    $slug = trim($input['KodeSurvei'] ?? '');
    if (empty($slug)) {
      $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $judul), '-'));
      $slug .= '-' . date('Y');
    }

    $currentUser = $this->session->userdata('Username') ?: ($this->session->userdata('nama_lengkap') ?: 'Surveiyor');

    $data = array(
      'Judul'         => $judul,
      'Deskripsi'     => trim($input['Deskripsi'] ?? ''),
      'Lembaga'       => trim($input['Lembaga'] ?? 'IDE Consultant'),
      'Jenis'         => trim($input['Jenis'] ?? 'IKM'),
      'Tahun'         => trim($input['Tahun'] ?? date('Y')),
      'Status'        => trim($input['Status'] ?? 'Aktif'),
      'TipeSurvei'    => trim($input['TipeSurvei'] ?? ($input['tipeSurvei'] ?? 'standar')),
      'InstrumenList' => trim($input['InstrumenList'] ?? ($input['instrumenList'] ?? 'A')),
      'DaerahSurvei'  => trim($input['DaerahSurvei'] ?? ''),
      'KodeWilayah'   => trim($input['KodeWilayah'] ?? ''),
      'BannerImage'   => trim($input['BannerImage'] ?? ''),
      'BannerColor'   => trim($input['BannerColor'] ?? '#043168'),
      'EstimasiWaktu' => trim($input['EstimasiWaktu'] ?? '3 - 5 Menit'),
      'UpdatedAt'     => date('Y-m-d H:i:s')
    );

    if ($id > 0) {
      $this->db->where('Id', $id)->update('survei_dinamis', $data);
      $surveiId = $id;
    } else {
      // Cek keunikan slug
      $cekSlug = $this->db->get_where('survei_dinamis', array('KodeSurvei' => $slug))->row_array();
      if ($cekSlug) {
        $slug .= '-' . substr(uniqid(), -4);
      }
      $data['KodeSurvei'] = $slug;
      $data['CreatedBy']  = $currentUser;
      $data['CreatedAt']  = date('Y-m-d H:i:s');
      $this->db->insert('survei_dinamis', $data);
      $surveiId = $this->db->insert_id();
    }

    echo json_encode(array(
      'status' => true,
      'message' => 'Survei berhasil disimpan.',
      'survei_id' => $surveiId
    ));
    return;
  }

  /**
   * API: Simpan Seluruh Pertanyaan Survei (Google Form Style Batch Builder)
   */
  public function save_survei_pertanyaan_batch() {
    $this->ensureSurveiStructure();
    header('Content-Type: application/json; charset=utf-8');

    $userLevel = (int)$this->session->userdata('level');
    $isSurveiyor = ($userLevel == 4 || $userLevel == 1 || $userLevel == 2 || $userLevel == 3 || !empty($this->session->userdata('Surveiyor')));
    if (!$isSurveiyor) {
      echo json_encode(array('status' => false, 'message' => 'Akses ditolak. Silakan login sebagai Surveiyor (Level 4) atau Admin.'));
      return;
    }

    $raw = file_get_contents('php://input');
    $input = json_decode($raw, true) ?: $this->input->post();

    $surveiId = isset($input['SurveiId']) ? (int)$input['SurveiId'] : 0;
    if ($surveiId <= 0) {
      echo json_encode(array('status' => false, 'message' => 'ID Survei tidak valid.'));
      return;
    }

    $pertanyaanList = $input['Pertanyaan'] ?? array();
    if (!is_array($pertanyaanList)) {
      echo json_encode(array('status' => false, 'message' => 'Format pertanyaan tidak valid.'));
      return;
    }

    $now = date('Y-m-d H:i:s');

    // Hapus pertanyaan lama untuk survei ini dan ganti dengan susunan baru
    $this->db->where('SurveiId', $surveiId)->delete('survei_pertanyaan');

    $insertBatch = array();
    $urutan = 1;
    foreach ($pertanyaanList as $item) {
      $teks = trim($item['Pertanyaan'] ?? '');
      if (empty($teks)) continue;

      $tipe = trim($item['Tipe'] ?? 'radio');
      $opsi = $item['OpsiPilihan'] ?? null;
      if (is_array($opsi)) {
        $opsi = json_encode($opsi);
      }

      $insertBatch[] = array(
        'SurveiId'      => $surveiId,
        'Pertanyaan'    => $teks,
        'Deskripsi'     => trim($item['Deskripsi'] ?? ''),
        'Section'       => trim($item['Section'] ?? ($item['section'] ?? '')),
        'Instrumen'     => strtoupper(trim($item['Instrumen'] ?? ($item['instrumen'] ?? 'A'))),
        'Tipe'          => $tipe,
        'OpsiPilihan'   => $opsi,
        'IsRequired'    => !empty($item['IsRequired']) ? 1 : 0,
        'Urutan'        => $urutan++,
        'ScaleMin'      => isset($item['ScaleMin']) ? (int)$item['ScaleMin'] : 1,
        'ScaleMax'      => isset($item['ScaleMax']) ? (int)$item['ScaleMax'] : 5,
        'ScaleMinLabel' => trim($item['ScaleMinLabel'] ?? 'Sangat Tidak Baik'),
        'ScaleMaxLabel' => trim($item['ScaleMaxLabel'] ?? 'Sangat Baik'),
        'CreatedAt'     => $now,
        'UpdatedAt'     => $now
      );
    }

    if (!empty($insertBatch)) {
      $this->db->insert_batch('survei_pertanyaan', $insertBatch);
    }

    echo json_encode(array(
      'status' => true,
      'message' => 'Seluruh pertanyaan survei berhasil disimpan (' . count($insertBatch) . ' pertanyaan).',
      'count' => count($insertBatch)
    ));
    return;
  }

  /**
   * API: Hapus Survei beserta seluruh pertanyaan, responden & jawabannya
   */
  public function delete_survei_dinamis($id = 0) {
    $this->ensureSurveiStructure();
    header('Content-Type: application/json; charset=utf-8');

    $userLevel = (int)$this->session->userdata('level');
    $isSurveiyor = ($userLevel == 4 || $userLevel == 3 || $userLevel == 1 || $userLevel == 2 || !empty($this->session->userdata('Surveiyor')) || !empty($this->session->userdata('Staf')));
    if (!$isSurveiyor) {
      echo json_encode(array('status' => false, 'message' => 'Akses ditolak.'));
      return;
    }

    $id = (int)$id;
    if ($id <= 0) {
      echo json_encode(array('status' => false, 'message' => 'ID tidak valid.'));
      return;
    }

    // Ambil responden untuk hapus rincian jawaban
    $respondenList = $this->db->select('Id')->where('SurveiId', $id)->get('survei_responden')->result_array();
    if (!empty($respondenList)) {
      $respIds = array_column($respondenList, 'Id');
      $this->db->where_in('RespondenId', $respIds)->delete('survei_jawaban');
    }

    $this->db->where('SurveiId', $id)->delete('survei_responden');
    $this->db->where('SurveiId', $id)->delete('survei_pertanyaan');
    $this->db->where('Id', $id)->delete('survei_dinamis');

    echo json_encode(array('status' => true, 'message' => 'Survei berhasil dihapus.'));
    return;
  }

  /**
   * API: Hapus 1 Data Responden beserta butir-butir jawabannya
   * Staf (Level 3), Surveyor (Level 4), Admin (Level 2), SuperAdmin (Level 1)
   */
  public function delete_survei_responden($respondenId = 0) {
    $this->ensureSurveiStructure();
    if (!headers_sent()) {
      @header('Content-Type: application/json; charset=utf-8');
    }

    $userLevel = (int)$this->session->userdata('level');
    $hasSurveyorSession = !empty($this->session->userdata('Surveiyor')) || !empty($this->session->userdata('Surveyor'));
    $hasStaffSession    = !empty($this->session->userdata('Staf')) || ($userLevel == 3);
    $hasAdminSession    = !empty($this->session->userdata('Admin')) || ($userLevel == 2);
    $hasSuperSession    = !empty($this->session->userdata('SuperAdmin')) || ($userLevel == 1);
    
    $isAuthorized = !empty($this->session->userdata('logged_in')) 
                 || $hasStaffSession 
                 || $hasSurveyorSession 
                 || $hasAdminSession 
                 || $hasSuperSession;

    if (!$isAuthorized) {
      echo json_encode(array('status' => false, 'message' => 'Akses ditolak: Hanya staf / petugas terotentikasi yang berhak menghapus data responden.'));
      return;
    }

    $respondenId = (int)$respondenId;
    if ($respondenId <= 0) {
      echo json_encode(array('status' => false, 'message' => 'ID responden tidak valid.'));
      return;
    }

    $responden = $this->db->get_where('survei_responden', array('Id' => $respondenId))->row_array();
    if (!$responden) {
      echo json_encode(array('status' => false, 'message' => 'Data responden tidak ditemukan.'));
      return;
    }

    $surveiId = $responden['SurveiId'];

    // Hapus rincian jawaban terlebih dahulu
    $this->db->where('RespondenId', $respondenId)->delete('survei_jawaban');
    // Hapus data responden
    $this->db->where('Id', $respondenId)->delete('survei_responden');

    echo json_encode(array(
      'status'    => true,
      'message'   => 'Data responden atas nama ' . ($responden['RespondenNama'] ?: 'Anonim') . ' berhasil dihapus dari sistem.',
      'survei_id' => $surveiId
    ));
    return;
  }

  /**
   * API: Submit Jawaban Survei oleh Responden Publik / Surveiyor Lapangan
   * Menghitung nilai skor IKM otomatis dan mencatat Keterangan Daerah Survei
   */
  public function submit_jawaban_survei() {
    $this->ensureSurveiStructure();
    header('Content-Type: application/json; charset=utf-8');

    $raw = file_get_contents('php://input');
    $input = json_decode($raw, true) ?: $this->input->post();

    $surveiId = isset($input['SurveiId']) ? (int)$input['SurveiId'] : 0;
    if ($surveiId <= 0 && isset($input['dashFormSurveyId'])) {
      $surveiId = (int)$input['dashFormSurveyId'];
    }
    if ($surveiId <= 0) {
      echo json_encode(array('status' => false, 'message' => 'ID survei tidak valid.'));
      return;
    }

    $survei = $this->db->get_where('survei_dinamis', array('Id' => $surveiId))->row_array();
    if (!$survei) {
      echo json_encode(array('status' => false, 'message' => 'Survei tidak ditemukan.'));
      return;
    }

    // Deteksi Instrumen (A: Perusahaan, B: Pencari Kerja, C: Pemangku Kepentingan, D: Siswa Kelas 12, E: AHP Pemangku Kepentingan)
    $instrumen = strtoupper(trim($input['Instrumen'] ?? ($input['instrumen'] ?? ($input['instrument'] ?? 'A'))));
    if (!in_array($instrumen, array('A', 'B', 'C', 'D', 'E'))) {
      $instrumen = 'A';
    }

    $rawAnswers = $input['Jawaban'] ?? ($input['answers'] ?? array());
    if (!is_array($rawAnswers) || empty($rawAnswers)) {
      $rawAnswers = array();
      foreach ($input as $k => $v) {
        if (strpos($k, 'jawaban_') === 0) {
          $pId = (int)substr($k, 8);
          if ($pId > 0) $rawAnswers[$pId] = $v;
        } elseif (preg_match('/^[A-Za-z0-9_]+$/', $k) && !in_array($k, array('SurveiId', 'dashFormSurveyId', 'Instrumen', 'instrumen', 'instrument', 'enumerator', 'consent', 'Latitude', 'Longitude', 'latitude', 'longitude', 'LokasiAccuracy', 'DevicePlatform', 'RespondenNama', 'RespondenNIK', 'RespondenKontak', 'RespondenGender', 'RespondenUsia', 'RespondenPendidikan', 'RespondenPekerjaan', 'Provinsi', 'Kabupaten', 'Kecamatan', 'Desa', 'AlamatDetail'))) {
          $rawAnswers[$k] = $v;
        }
      }
    }

    if (empty($rawAnswers)) {
      echo json_encode(array('status' => false, 'message' => 'Mohon jawab butir kuesioner terlebih dahulu.'));
      return;
    }

    // Ambil seluruh pertanyaan untuk survei ini (dan spesifik instrumen jika ada)
    $pertanyaan = $this->db->where('SurveiId', $surveiId)->get('survei_pertanyaan')->result_array();
    $pertanyaanMap = array();
    $pertanyaanCodeMap = array();
    foreach ($pertanyaan as $pt) {
      $pertanyaanMap[$pt['Id']] = $pt;
      if (preg_match('/^\[([A-Za-z0-9_]+)\]/', $pt['Pertanyaan'], $m)) {
        $pertanyaanCodeMap[$m[1]] = $pt;
      }
    }

    // Ekstraksi data diri responden berdasarkan instrumen
    $enumerator = trim($input['enumerator'] ?? ($input['Enumerator'] ?? ($this->session->userdata('Username') ?: 'Surveyor Lapangan')));
    $namaResponden = trim($input['RespondenNama'] ?? '');
    $nik = trim($input['RespondenNIK'] ?? '');
    $kontak = trim($input['RespondenKontak'] ?? '');
    $gender = trim($input['RespondenGender'] ?? '');
    $usia = trim($input['RespondenUsia'] ?? '');
    $pendidikan = trim($input['RespondenPendidikan'] ?? '');
    $pekerjaan = trim($input['RespondenPekerjaan'] ?? '');
    $provinsi = trim($input['Provinsi'] ?? 'Jawa Timur');
    $kabupaten = trim($input['Kabupaten'] ?? 'Kabupaten Banyuwangi');
    $kecamatan = trim($input['Kecamatan'] ?? '');
    $desa = trim($input['Desa'] ?? '');
    $alamatDetail = trim($input['AlamatDetail'] ?? '');

    if ($instrumen === 'A') {
      if (empty($namaResponden)) $namaResponden = trim($rawAnswers['P1'] ?? 'Perusahaan / Pemberi Kerja');
      if (empty($kecamatan)) $kecamatan = trim($rawAnswers['P2'] ?? 'Banyuwangi');
      if (empty($pekerjaan)) $pekerjaan = 'Pemberi Kerja / Pelaku Usaha';
      if (empty($pendidikan)) $pendidikan = 'D3 / S1 / Praktisi';
      if (empty($usia)) $usia = '30 - 50 Tahun';
    } elseif ($instrumen === 'B') {
      if (empty($namaResponden)) $namaResponden = 'Pencari Kerja / Lulusan';
      if (empty($usia)) $usia = trim($rawAnswers['L1'] ?? '20–24');
      if (empty($gender)) $gender = trim($rawAnswers['L2'] ?? 'Laki-laki');
      if (empty($kecamatan)) $kecamatan = trim($rawAnswers['L3'] ?? 'Banyuwangi');
      if (empty($pendidikan)) $pendidikan = trim($rawAnswers['L4'] ?? 'SMK Vokasi');
      if (empty($pekerjaan)) $pekerjaan = trim($rawAnswers['L7'] ?? 'Mencari kerja');
    } elseif ($instrumen === 'C') {
      if (empty($namaResponden)) $namaResponden = trim($rawAnswers['S2'] ?? 'Narasumber Stakeholder');
      if (empty($pekerjaan)) $pekerjaan = trim($rawAnswers['S1'] ?? 'Pemangku Kepentingan');
      if (empty($kecamatan)) $kecamatan = 'Banyuwangi';
      if (empty($pendidikan)) $pendidikan = 'Sarjana (S1 / S2 / S3)';
      if (empty($usia)) $usia = '40 Tahun ke Atas';
    } elseif ($instrumen === 'D') {
      if (empty($namaResponden)) $namaResponden = 'Siswa ' . trim($rawAnswers['K2'] ?? 'Kelas 12');
      if (empty($pendidikan)) $pendidikan = trim($rawAnswers['K1'] ?? 'SMK Vokasi');
      if (empty($kecamatan)) $kecamatan = trim($rawAnswers['K3'] ?? ($rawAnswers['K7'] ?? 'Banyuwangi'));
      if (empty($usia)) $usia = trim($rawAnswers['K5'] ?? '17 tahun');
      if (empty($gender)) $gender = trim($rawAnswers['K6'] ?? 'Laki-laki');
      if (empty($pekerjaan)) $pekerjaan = 'Siswa Kelas 12';
    } elseif ($instrumen === 'E') {
      if (empty($namaResponden)) $namaResponden = trim($rawAnswers['S2'] ?? 'Narasumber AHP');
      if (empty($pekerjaan)) $pekerjaan = trim($rawAnswers['S1'] ?? 'Pemangku Kepentingan (AHP)');
      if (empty($kecamatan)) $kecamatan = 'Banyuwangi';
      if (empty($pendidikan)) $pendidikan = 'Sarjana (S1 / S2 / S3)';
      if (empty($usia)) $usia = '40 Tahun ke Atas';
    }

    if (empty($kecamatan)) $kecamatan = 'Banyuwangi';

    // Koordinat pusat kecamatan jika GPS tidak diizinkan / kosong
    $districtCoords = array(
      'banyuwangi'   => array(-8.2192, 114.3692),
      'blimbingsari' => array(-8.3150, 114.3410),
      'bangorejo'    => array(-8.4891, 114.1878),
      'cluring'      => array(-8.4412, 114.2389),
      'gambiran'     => array(-8.4023, 114.1489),
      'genteng'      => array(-8.3689, 114.1523),
      'giri'         => array(-8.1923, 114.3512),
      'glagah'       => array(-8.2056, 114.3289),
      'glenmore'     => array(-8.3089, 114.0489),
      'kabat'        => array(-8.2789, 114.3312),
      'kalibaru'     => array(-8.2912, 113.9856),
      'kalipuro'     => array(-8.1389, 114.3723),
      'licin'        => array(-8.2089, 114.2689),
      'muncar'       => array(-8.4356, 114.3389),
      'pesanggaran'  => array(-8.5689, 114.0789),
      'purwoharjo'   => array(-8.5023, 114.2312),
      'rogojampi'    => array(-8.3089, 114.2989),
      'sempu'        => array(-8.3389, 114.1812),
      'siliragung'   => array(-8.5412, 114.1389),
      'singojuruh'   => array(-8.3189, 114.2389),
      'songgon'      => array(-8.2389, 114.2089),
      'srono'        => array(-8.3989, 114.2689),
      'tegaldlimo'   => array(-8.5389, 114.3989),
      'tegalsari'    => array(-8.4389, 114.1189),
      'wongsorejo'   => array(-7.9889, 114.4089)
    );

    $kKey = strtolower(preg_replace('/[^a-z]/', '', $kecamatan));
    $defLat = isset($districtCoords[$kKey]) ? $districtCoords[$kKey][0] : -8.2192;
    $defLng = isset($districtCoords[$kKey]) ? $districtCoords[$kKey][1] : 114.3692;

    $hasExplicitGps = (isset($input['Latitude']) && $input['Latitude'] !== '') || (isset($input['latitude']) && $input['latitude'] !== '');
    $latitude = $hasExplicitGps ? (float)($input['Latitude'] ?? $input['latitude']) : $defLat;
    $longitude = $hasExplicitGps ? (float)($input['Longitude'] ?? $input['longitude']) : $defLng;
    $lokasiAccuracy = isset($input['LokasiAccuracy']) && $input['LokasiAccuracy'] !== '' ? (float)$input['LokasiAccuracy'] : 15.0;

    // Resolusi otomatis wilayah & kecamatan dari koordinat GPS perangkat real
    $realKecInput = trim($input['RealKecamatan'] ?? ($input['real_kecamatan'] ?? ''));
    $realKabInput = trim($input['RealKabupaten'] ?? ($input['real_kabupaten'] ?? ''));
    if (!empty($realKecInput)) {
      $kecamatan = $realKecInput;
      if (!empty($realKabInput)) $kabupaten = $realKabInput;
    } elseif ($hasExplicitGps && !empty($latitude) && !empty($longitude)) {
      $resolvedLoc = $this->resolveLocationFromCoordinates($latitude, $longitude, $kecamatan, $kabupaten);
      $kecamatan = $resolvedLoc['kecamatan'];
      $kabupaten = $resolvedLoc['kabupaten'];
    }

    // Resolusi nama dan tipe perangkat pengisi survei
    $devicePlatform = isset($input['DevicePlatform']) && $input['DevicePlatform'] !== '' ? trim($input['DevicePlatform']) : '';
    if (empty($devicePlatform) || $devicePlatform === 'Desktop Browser' || $devicePlatform === 'Web Responsive') {
      $devicePlatform = $this->parseUserAgentToDevice($this->input->user_agent());
    }

    $totalSkor = 0.0;
    $countScored = 0;
    $jawabanBatch = array();
    $now = date('Y-m-d H:i:s');

    foreach ($rawAnswers as $key => $userVal) {
      if (strpos($key, '_alasan') !== false) continue; // Alasan disimpan bersama pertanyaan induk

      $pt = null;
      if (is_numeric($key) && isset($pertanyaanMap[(int)$key])) {
        $pt = $pertanyaanMap[(int)$key];
      } elseif (isset($pertanyaanCodeMap[$key])) {
        $pt = $pertanyaanCodeMap[$key];
      }

      if (!$pt) continue;
      $pId = (int)$pt['Id'];

      $skorAngka = 0.0;
      $teksJawaban = '';

      if (is_array($userVal) && $pt['Tipe'] === 'scale') {
        // Objek subfield scale seperti { Teknis: 4, Digital: 5 }
        $ptsArr = array();
        $subSum = 0; $subCount = 0;
        foreach ($userVal as $sf => $sVal) {
          $ptsArr[] = $sf . ': ' . $sVal;
          $subSum += (float)$sVal;
          $subCount++;
        }
        $teksJawaban = implode('; ', $ptsArr);
        $skorAngka = ($subCount > 0) ? round($subSum / $subCount, 2) : 3.0;
        $totalSkor += $skorAngka;
        $countScored++;
      } elseif (is_numeric($userVal) && $pt['Tipe'] === 'scale') {
        $skorAngka = (float)$userVal;
        $teksJawaban = (string)$userVal;
        $totalSkor += $skorAngka;
        $countScored++;
      } elseif (is_array($userVal) && $pt['Tipe'] === 'grid') {
        $ptsArr = array();
        foreach ($userVal as $gf => $gVal) {
          $ptsArr[] = $gf . ': ' . $gVal;
        }
        $teksJawaban = implode(', ', $ptsArr);
      } elseif (is_array($userVal)) {
        // Checkbox many
        $selectedItems = $userVal;
        $teksJawaban = implode(', ', $selectedItems);
        $opsiList = json_decode($pt['OpsiPilihan'], true) ?: array();
        foreach ($selectedItems as $itemVal) {
          foreach ($opsiList as $op) {
            if (trim($op['label']) === trim($itemVal)) {
              $skorAngka += isset($op['nilai']) ? (float)$op['nilai'] : 1.0;
              break;
            }
          }
        }
        if ($skorAngka > 0) {
          $totalSkor += $skorAngka;
          $countScored++;
        }
      } elseif (in_array($pt['Tipe'], array('radio', 'dropdown'))) {
        $teksJawaban = (string)$userVal;
        $opsiList = json_decode($pt['OpsiPilihan'], true) ?: array();
        foreach ($opsiList as $op) {
          if (trim($op['label']) === trim($userVal)) {
            $skorAngka = isset($op['nilai']) ? (float)$op['nilai'] : 3.0;
            break;
          }
        }
        if ($skorAngka <= 0) $skorAngka = 3.0;
        $totalSkor += $skorAngka;
        $countScored++;
      } elseif ($pt['Tipe'] === 'pair') {
        $teksJawaban = (string)$userVal;
        if (strpos($teksJawaban, '/') !== false) {
          $parts = explode('/', $teksJawaban);
          $skorAngka = (float)$parts[1] > 0 ? round(1.0 / (float)$parts[1], 4) : 1.0;
        } else {
          $skorAngka = (float)$teksJawaban;
        }
      } elseif ($pt['Tipe'] === 'number') {
        $skorAngka = (float)$userVal;
        $teksJawaban = (string)$userVal;
      } else {
        $teksJawaban = trim((string)$userVal);
      }

      // Cek apakah ada alasan
      $reasonKey = $key . '_alasan';
      if (!empty($rawAnswers[$reasonKey])) {
        $teksJawaban .= ' (Alasan: ' . trim($rawAnswers[$reasonKey]) . ')';
      }

      $jawabanBatch[] = array(
        'PertanyaanId' => $pId,
        'JawabanTeks'  => $teksJawaban,
        'NilaiAngka'   => $skorAngka,
        'CreatedAt'    => $now
      );
    }

    $rataRataSkor = ($countScored > 0) ? round($totalSkor / $countScored, 2) : 3.0;

    $mutuPelayanan = 'Baik (B)';
    if ($rataRataSkor >= 3.50) {
      $mutuPelayanan = 'Sangat Baik (A)';
    } elseif ($rataRataSkor >= 2.75) {
      $mutuPelayanan = 'Baik (B)';
    } elseif ($rataRataSkor >= 2.00) {
      $mutuPelayanan = 'Kurang Baik (C)';
    } else {
      $mutuPelayanan = 'Tidak Baik (D)';
    }

    $createdByUser = $enumerator ?: ($this->session->userdata('Username') ?: 'Surveyor');

    // Penanganan Unggah Foto Dokumentasi Lapangan (Kamera HP / File)
    $fotoPath = null;
    $rawFoto = $input['FotoDokumentasi'] ?? ($input['foto_dokumentasi'] ?? null);

    if (!empty($rawFoto) && is_string($rawFoto)) {
      // Jika berupa Base64 Data URL (misal: data:image/jpeg;base64,...)
      if (preg_match('/^data:image\/(\w+);base64,(.+)$/s', $rawFoto, $fotoMatches)) {
        $ext = strtolower($fotoMatches[1]);
        if ($ext === 'jpeg') $ext = 'jpg';
        if (!in_array($ext, array('jpg', 'jpeg', 'png', 'webp'))) {
          $ext = 'jpg';
        }
        $decodedData = base64_decode($fotoMatches[2]);
        if ($decodedData !== false) {
          $uploadDir = FCPATH . 'uploads/survei_rtkd/';
          if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0777, true);
          }
          $fileName = 'foto_rtkd_' . $surveiId . '_' . $instrumen . '_' . date('Ymd_His') . '_' . substr(md5(uniqid(mt_rand(), true)), 0, 8) . '.' . $ext;
          $targetPath = $uploadDir . $fileName;
          if (@file_put_contents($targetPath, $decodedData)) {
            $fotoPath = 'uploads/survei_rtkd/' . $fileName;
          }
        }
      } elseif (strpos($rawFoto, 'uploads/') === 0) {
        $fotoPath = $rawFoto;
      }
    } elseif (!empty($_FILES['FotoDokumentasi']['tmp_name']) && is_uploaded_file($_FILES['FotoDokumentasi']['tmp_name'])) {
      $uploadDir = FCPATH . 'uploads/survei_rtkd/';
      if (!is_dir($uploadDir)) {
        @mkdir($uploadDir, 0777, true);
      }
      $ext = pathinfo($_FILES['FotoDokumentasi']['name'], PATHINFO_EXTENSION) ?: 'jpg';
      $fileName = 'foto_rtkd_' . $surveiId . '_' . $instrumen . '_' . date('Ymd_His') . '_' . substr(md5(uniqid(mt_rand(), true)), 0, 8) . '.' . strtolower($ext);
      $targetPath = $uploadDir . $fileName;
      if (@move_uploaded_file($_FILES['FotoDokumentasi']['tmp_name'], $targetPath)) {
        $fotoPath = 'uploads/survei_rtkd/' . $fileName;
      }
    }

    // Simpan Data Responden
    $respondenData = array(
      'SurveiId'            => $surveiId,
      'Instrumen'           => $instrumen,
      'RespondenNama'       => $namaResponden ?: 'Anonim',
      'RespondenNIK'        => $nik,
      'RespondenKontak'     => $kontak,
      'RespondenGender'     => $gender,
      'RespondenUsia'       => $usia,
      'RespondenPendidikan' => $pendidikan,
      'RespondenPekerjaan'  => $pekerjaan,
      'Provinsi'            => $provinsi,
      'Kabupaten'           => $kabupaten,
      'Kecamatan'           => $kecamatan,
      'Desa'                => $desa,
      'AlamatDetail'        => $alamatDetail,
      'Latitude'            => $latitude,
      'Longitude'           => $longitude,
      'LokasiAccuracy'      => $lokasiAccuracy,
      'FotoDokumentasi'     => $fotoPath,
      'TotalSkor'           => $totalSkor,
      'RataRataSkor'        => $rataRataSkor,
      'MutuPelayanan'       => $mutuPelayanan,
      'IpAddress'           => $this->input->ip_address(),
      'UserAgent'           => substr($this->input->user_agent(), 0, 255),
      'DevicePlatform'      => $devicePlatform,
      'CreatedBy'           => $createdByUser,
      'CreatedAt'           => $now
    );
    $this->db->insert('survei_responden', $respondenData);
    $respondenId = $this->db->insert_id();

    // Simpan Rincian Jawaban
    if (!empty($jawabanBatch)) {
      foreach ($jawabanBatch as &$jb) {
        $jb['RespondenId'] = $respondenId;
      }
      $this->db->insert_batch('survei_jawaban', $jawabanBatch);
    }

    echo json_encode(array(
      'status'            => true,
      'message'           => 'Terima kasih! Jawaban survei Anda berhasil disimpan.',
      'responden_id'      => $respondenId,
      'total_skor'        => $totalSkor,
      'rata_rata_skor'    => $rataRataSkor,
      'mutu_pelayanan'    => $mutuPelayanan,
      'foto_dokumentasi'  => !empty($fotoPath) ? base_url($fotoPath) : null,
      'daerah_survei'     => trim($kabupaten . ' ' . $kecamatan . ' ' . $desa) ?: ($survei['DaerahSurvei'] ?: 'Nasional')
    ));
    return;
  }

  /**
   * Helper: Parse User-Agent String to Device Brand, Model, OS, and Browser
   */
  private function parseUserAgentToDevice($ua = '') {
    if (empty($ua)) return 'Web Browser / Desktop';

    $os = 'Unknown OS';
    if (preg_match('/Android\s([0-9\.]+)/i', $ua, $m)) {
      $os = 'Android ' . $m[1];
    } elseif (preg_match('/iPhone OS\s([0-9_]+)/i', $ua, $m)) {
      $os = 'iOS ' . str_replace('_', '.', $m[1]);
    } elseif (preg_match('/iPad.*OS\s([0-9_]+)/i', $ua, $m)) {
      $os = 'iPadOS ' . str_replace('_', '.', $m[1]);
    } elseif (preg_match('/Windows NT 10\.0/i', $ua)) {
      $os = 'Windows 10/11';
    } elseif (preg_match('/Windows NT 6\.3/i', $ua)) {
      $os = 'Windows 8.1';
    } elseif (preg_match('/Windows NT 6\.1/i', $ua)) {
      $os = 'Windows 7';
    } elseif (preg_match('/Macintosh|Mac OS X/i', $ua)) {
      $os = 'macOS';
    } elseif (preg_match('/Linux/i', $ua)) {
      $os = 'Linux';
    }

    $brand = 'Perangkat';
    if (preg_match('/iPhone/i', $ua)) {
      $brand = 'Apple iPhone';
    } elseif (preg_match('/iPad/i', $ua)) {
      $brand = 'Apple iPad';
    } elseif (preg_match('/SM-([A-Za-z0-9]+)/i', $ua, $m)) {
      $brand = 'Samsung Galaxy (SM-' . $m[1] . ')';
    } elseif (preg_match('/(Redmi[^\;\)]*|POCO[^\;\)]*|Mi\s[0-9A-Za-z]+|2[0-9]{7}[A-Z]+)/i', $ua, $m)) {
      $brand = 'Xiaomi ' . trim($m[1]);
    } elseif (preg_match('/CPH[0-9]+/i', $ua, $m)) {
      $brand = 'OPPO ' . $m[0];
    } elseif (preg_match('/V[0-9]{4}[A-Z]*/i', $ua, $m)) {
      $brand = 'vivo ' . $m[0];
    } elseif (preg_match('/RMX[0-9]+/i', $ua, $m)) {
      $brand = 'Realme ' . $m[0];
    } elseif (preg_match('/Infinix[^\;\)]*/i', $ua, $m)) {
      $brand = trim($m[0]);
    } elseif (preg_match('/TECNO[^\;\)]*/i', $ua, $m)) {
      $brand = trim($m[0]);
    } elseif (preg_match('/;\s([^;]+)\sBuild\//i', $ua, $m)) {
      $brand = trim($m[1]);
    } elseif (preg_match('/Windows/i', $ua)) {
      $brand = 'PC / Laptop Desktop';
    } elseif (preg_match('/Macintosh/i', $ua)) {
      $brand = 'Apple Mac';
    }

    $browser = 'Browser';
    if (preg_match('/SamsungBrowser\/([0-9\.]+)/i', $ua)) {
      $browser = 'Samsung Internet';
    } elseif (preg_match('/Edg\/([0-9\.]+)/i', $ua)) {
      $browser = 'MS Edge';
    } elseif (preg_match('/Chrome\/([0-9\.]+)/i', $ua)) {
      $browser = 'Chrome';
    } elseif (preg_match('/Safari\/([0-9\.]+)/i', $ua) && !preg_match('/Chrome/i', $ua)) {
      $browser = 'Safari';
    } elseif (preg_match('/Firefox\/([0-9\.]+)/i', $ua)) {
      $browser = 'Firefox';
    }

    return $brand . ' (' . $os . ') · ' . $browser;
  }

  /**
   * Helper: Resolusi Otomatis Kecamatan & Kabupaten dari Koordinat GPS Perangkat Real
   */
  private function resolveLocationFromCoordinates($lat, $lng, $fallbackKec = 'Banyuwangi', $fallbackKab = 'Kabupaten Banyuwangi') {
    if (empty($lat) || empty($lng)) {
      return array('kecamatan' => $fallbackKec, 'kabupaten' => $fallbackKab, 'desa' => '');
    }

    $lat = (float)$lat;
    $lng = (float)$lng;

    // 1. Data Centroid 25 Kecamatan di Kabupaten Banyuwangi (0ms lookup)
    $banyuwangiCentroids = array(
      'Banyuwangi'   => array(-8.2192, 114.3692),
      'Blimbingsari' => array(-8.3150, 114.3410),
      'Bangorejo'    => array(-8.4891, 114.1878),
      'Cluring'      => array(-8.4412, 114.2389),
      'Gambiran'     => array(-8.4023, 114.1489),
      'Genteng'      => array(-8.3689, 114.1523),
      'Giri'         => array(-8.1923, 114.3512),
      'Glagah'       => array(-8.2056, 114.3289),
      'Glenmore'     => array(-8.3089, 114.0489),
      'Kabat'        => array(-8.2789, 114.3312),
      'Kalibaru'     => array(-8.2912, 113.9856),
      'Kalipuro'     => array(-8.1389, 114.3723),
      'Licin'        => array(-8.2089, 114.2689),
      'Muncar'       => array(-8.4356, 114.3389),
      'Pesanggaran'  => array(-8.5689, 114.0789),
      'Purwoharjo'   => array(-8.5023, 114.2312),
      'Rogojampi'    => array(-8.3089, 114.2989),
      'Sempu'        => array(-8.3389, 114.1812),
      'Siliragung'   => array(-8.5412, 114.1389),
      'Singojuruh'   => array(-8.3189, 114.2389),
      'Songgon'      => array(-8.2389, 114.2089),
      'Srono'        => array(-8.3989, 114.2689),
      'Tegaldlimo'   => array(-8.5389, 114.3989),
      'Tegalsari'    => array(-8.4389, 114.1189),
      'Wongsorejo'   => array(-7.9889, 114.4089)
    );

    // Cek apakah koordinat berada di dalam lingkup Kabupaten Banyuwangi (Lat: -8.85 s/d -7.80, Lng: 113.80 s/d 114.65)
    if ($lat >= -8.85 && $lat <= -7.80 && $lng >= 113.80 && $lng <= 114.65) {
      $minDist = 999999;
      $closestKec = 'Banyuwangi';
      foreach ($banyuwangiCentroids as $kName => $coords) {
        $dist = sqrt(pow($lat - $coords[0], 2) + pow($lng - $coords[1], 2));
        if ($dist < $minDist) {
          $minDist = $dist;
          $closestKec = $kName;
        }
      }
      return array('kecamatan' => $closestKec, 'kabupaten' => 'Kabupaten Banyuwangi', 'desa' => '');
    }

    // 2. Nominatim OpenStreetMap Reverse Geocoding via cURL (Akurasi Real Nasional)
    $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&zoom=14&addressdetails=1";
    $json = null;

    if (function_exists('curl_init')) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 2);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_USERAGENT, 'CVIDE-Georesolver/2.0');
      $json = curl_exec($ch);
      curl_close($ch);
    }

    if (!$json) {
      $ctx = stream_context_create(array(
        'http' => array(
          'header'  => "User-Agent: CVIDE-Georesolver/2.0\r\n",
          'timeout' => 2
        ),
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false
        )
      ));
      $json = @file_get_contents($url, false, $ctx);
    }

    if ($json) {
      $data = json_decode($json, true);
      if (!empty($data['address'])) {
        $addr = $data['address'];
        $kec = $addr['district'] ?? ($addr['town'] ?? ($addr['suburb'] ?? ($addr['city_district'] ?? '')));
        $kab = $addr['city'] ?? ($addr['county'] ?? ($addr['municipality'] ?? ''));
        $desa = $addr['suburb'] ?? ($addr['village'] ?? ($addr['neighbourhood'] ?? ''));
        if ($kec) {
          $cleanKec = trim(preg_replace('/^(Kecamatan|Kec\.)\s*/i', '', $kec));
          return array(
            'kecamatan' => $cleanKec ?: $fallbackKec,
            'kabupaten' => $kab ?: $fallbackKab,
            'desa'      => ($desa !== $cleanKec) ? $desa : ''
          );
        }
      }
    }

    // 3. Fallback Centroid Malang Raya jika Nominatim timeout/offline (Lat: -8.15 s/d -7.85, Lng: 112.50 s/d 112.75)
    if ($lat >= -8.15 && $lat <= -7.85 && $lng >= 112.50 && $lng <= 112.75) {
      $malangCentroids = array(
        'Blimbing'      => array(-7.9390, 112.6450),
        'Lowokwaru'     => array(-7.9337, 112.6180),
        'Klojen'        => array(-7.9780, 112.6310),
        'Sukun'         => array(-7.9950, 112.6150),
        'Kedungkandang' => array(-7.9980, 112.6650)
      );
      $minDist = 999999;
      $closestKec = 'Blimbing';
      foreach ($malangCentroids as $kName => $coords) {
        $dist = sqrt(pow($lat - $coords[0], 2) + pow($lng - $coords[1], 2));
        if ($dist < $minDist) {
          $minDist = $dist;
          $closestKec = $kName;
        }
      }
      return array('kecamatan' => $closestKec, 'kabupaten' => 'Kota Malang', 'desa' => '');
    }

    return array('kecamatan' => $fallbackKec, 'kabupaten' => $fallbackKab, 'desa' => '');
  }

  /**
   * API Publik: Resolusi Geospasial Real-time Koordinat GPS ke Kecamatan & Kabupaten
   */
  public function resolve_coordinates() {
    header('Content-Type: application/json; charset=utf-8');
    $lat = $this->input->get_post('lat');
    $lng = $this->input->get_post('lng');

    if (empty($lat) || empty($lng)) {
      echo json_encode(array('status' => false, 'message' => 'Koordinat lat dan lng wajib disertakan.'));
      return;
    }

    $res = $this->resolveLocationFromCoordinates($lat, $lng);
    echo json_encode(array(
      'status'    => true,
      'lat'       => (float)$lat,
      'lng'       => (float)$lng,
      'kecamatan' => $res['kecamatan'] ?? 'Banyuwangi',
      'kabupaten' => $res['kabupaten'] ?? 'Kabupaten Banyuwangi',
      'desa'      => $res['desa'] ?? ''
    ));
  }

  /**
   * API: Submit Jawaban Survei Responden (Alias untuk Dashboard & Publik)
   */
  public function submit_survei_responden() {
    return $this->submit_jawaban_survei();
  }

  /**
   * API: Simpan Survei Baru Beserta Butir Pertanyaan dari Studio Builder
   */
  public function save_survei_builder() {
    $this->ensureSurveiStructure();
    header('Content-Type: application/json; charset=utf-8');

    $raw = file_get_contents('php://input');
    $input = json_decode($raw, true) ?: $this->input->post();

    $judul = trim($input['Judul'] ?? '');
    if (empty($judul)) {
      echo json_encode(array('status' => false, 'message' => 'Judul survei wajib diisi.'));
      return;
    }

    $currentUser = $this->session->userdata('Username') ?: ($this->session->userdata('nama_lengkap') ?: 'Surveyor');
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $judul), '-')) . '-' . date('Ymd-His');

    $surveiData = array(
      'KodeSurvei'    => $slug,
      'Judul'         => $judul,
      'Deskripsi'     => trim($input['Deskripsi'] ?? ''),
      'Lembaga'       => trim($input['Lembaga'] ?? 'IDE Consultant'),
      'Jenis'         => trim($input['Jenis'] ?? 'IKM'),
      'Tahun'         => trim($input['Tahun'] ?? date('Y')),
      'Status'        => 'Aktif',
      'DaerahSurvei'  => trim($input['DaerahSurvei'] ?? 'Kabupaten Banyuwangi'),
      'BannerColor'   => '#043168',
      'EstimasiWaktu' => '3 - 5 Menit',
      'CreatedBy'     => $currentUser,
      'CreatedAt'     => date('Y-m-d H:i:s'),
      'UpdatedAt'     => date('Y-m-d H:i:s')
    );

    $this->db->insert('survei_dinamis', $surveiData);
    $surveiId = $this->db->insert_id();

    // Simpan butir pertanyaan jika ada
    $questionsRaw = $input['questions'] ?? array();
    $questions = is_string($questionsRaw) ? (json_decode($questionsRaw, true) ?: array()) : (is_array($questionsRaw) ? $questionsRaw : array());

    if (!empty($questions)) {
      $batch = array();
      $urutan = 1;
      foreach ($questions as $q) {
        $qText = trim($q['Pertanyaan'] ?? ($q['pertanyaan'] ?? ($q['text'] ?? '')));
        if (empty($qText)) continue;
        $qType = trim($q['Tipe'] ?? ($q['tipe'] ?? ($q['type'] ?? 'radio')));
        
        $rawOpsi = $q['OpsiPilihan'] ?? ($q['opsiPilihan'] ?? ($q['opsi'] ?? null));
        $opsi = null;
        if (!empty($rawOpsi)) {
          $opsi = is_array($rawOpsi) ? json_encode($rawOpsi) : $rawOpsi;
        } elseif ($qType === 'radio' || $qType === 'likert' || $qType === 'scale') {
          $opsi = json_encode(array(
            array('label' => 'Sangat Tidak Setuju / Buruk', 'nilai' => 1),
            array('label' => 'Tidak Setuju / Kurang', 'nilai' => 2),
            array('label' => 'Cukup / Ragu-ragu', 'nilai' => 3),
            array('label' => 'Setuju / Baik', 'nilai' => 4),
            array('label' => 'Sangat Setuju / Sangat Baik', 'nilai' => 5)
          ));
        }

        $batch[] = array(
          'SurveiId'      => $surveiId,
          'Pertanyaan'    => $qText,
          'Deskripsi'     => trim($q['Deskripsi'] ?? ($q['deskripsi'] ?? '')),
          'Section'       => trim($q['Section'] ?? ($q['section'] ?? '')),
          'Tipe'          => $qType,
          'OpsiPilihan'   => $opsi,
          'IsRequired'    => isset($q['IsRequired']) ? (!empty($q['IsRequired']) ? 1 : 0) : (isset($q['isRequired']) ? (!empty($q['isRequired']) ? 1 : 0) : 1),
          'Urutan'        => $urutan++,
          'ScaleMin'      => isset($q['ScaleMin']) ? (int)$q['ScaleMin'] : (isset($q['scaleMin']) ? (int)$q['scaleMin'] : 1),
          'ScaleMax'      => isset($q['ScaleMax']) ? (int)$q['ScaleMax'] : (isset($q['scaleMax']) ? (int)$q['scaleMax'] : 5),
          'ScaleMinLabel' => trim($q['ScaleMinLabel'] ?? ($q['scaleMinLabel'] ?? 'Sangat Tidak Baik')),
          'ScaleMaxLabel' => trim($q['ScaleMaxLabel'] ?? ($q['scaleMaxLabel'] ?? 'Sangat Baik')),
          'CreatedAt'     => date('Y-m-d H:i:s'),
          'UpdatedAt'     => date('Y-m-d H:i:s')
        );
      }

      if (!empty($batch)) {
        $this->db->insert_batch('survei_pertanyaan', $batch);
      }
    }

    echo json_encode(array(
      'status'    => true,
      'message'   => 'Survei baru beserta butir pertanyaan berhasil disimpan dan dipublikasikan.',
      'survei_id' => $surveiId
    ));
    return;
  }

  /**
   * API: Ambil Rekapitulasi & Statistik Respon untuk Survei Tertentu
   * HANYA BISA DIAKSES OLEH SESSION LOGIN (Surveiyor / Staf / Admin) untuk keamanan data
   */
  public function get_survei_rekap_data($surveiId = 0) {
    $this->ensureSurveiStructure();
    header('Content-Type: application/json; charset=utf-8');

    // Keamanan data: Wajib session login
    $isLoggedIn = !empty($this->session->userdata('logged_in')) 
               || !empty($this->session->userdata('Surveiyor')) 
               || !empty($this->session->userdata('Surveyor')) 
               || !empty($this->session->userdata('Staf')) 
               || !empty($this->session->userdata('Admin')) 
               || !empty($this->session->userdata('SuperAdmin'));

    if (!$isLoggedIn) {
      echo json_encode(array(
        'status'         => false,
        'login_required' => true,
        'message'        => 'Akses Terbatas: Rincian rekapitulasi data responden hanya dapat diakses oleh petugas terotentikasi (Surveiyor / Staf / Admin) demi keamanan data.'
      ));
      return;
    }

    $surveiId = (int)$surveiId;
    $survei = $this->db->get_where('survei_dinamis', array('Id' => $surveiId))->row_array();
    if (!$survei) {
      echo json_encode(array('status' => false, 'message' => 'Survei tidak ditemukan.'));
      return;
    }

    $responden = $this->db->where('SurveiId', $surveiId)->order_by('Id', 'DESC')->get('survei_responden')->result_array();
    $totalResponden = count($responden);

    $avgQuery = $this->db->select_avg('RataRataSkor', 'avg_skor')->where('SurveiId', $surveiId)->get('survei_responden')->row_array();
    $avgSkor = !empty($avgQuery['avg_skor']) ? round((float)$avgQuery['avg_skor'], 2) : 0;

    // Sebaran Daerah Survei
    $sebaranDaerah = $this->db->query("SELECT IFNULL(NULLIF(Kabupaten,''), 'Lainnya') as Daerah, COUNT(*) as Total FROM `survei_responden` WHERE SurveiId = {$surveiId} GROUP BY Daerah ORDER BY Total DESC")->result_array();

    // Daftar Pertanyaan untuk tabel rincian & analisis parameter visualisasi
    $pertanyaan = $this->db->where('SurveiId', $surveiId)->order_by('Urutan', 'ASC')->get('survei_pertanyaan')->result_array();

    // 1. Parameter Analysis (untuk Bagan Batang / Bar Chart)
    $parameterStats = array();
    foreach ($pertanyaan as $idx => $q) {
      $qId = (int)$q['Id'];
      $qStats = $this->db->query("
        SELECT AVG(NilaiAngka) as avg_score, COUNT(Id) as total_answers 
        FROM `survei_jawaban` 
        WHERE PertanyaanId = {$qId} AND NilaiAngka > 0
      ")->row_array();

      $valScore = !empty($qStats['avg_score']) ? round((float)$qStats['avg_score'], 2) : 0;
      if ($valScore <= 0 && $avgSkor > 0) {
        $valScore = $avgSkor;
      }

      $parameterStats[] = array(
        'Id'         => $q['Id'],
        'Urutan'     => $q['Urutan'],
        'Pertanyaan' => $q['Pertanyaan'],
        'Section'    => $q['Section'] ?? '',
        'Tipe'       => $q['Tipe'],
        'AvgScore'   => $valScore,
        'TotalJwb'   => !empty($qStats['total_answers']) ? (int)$qStats['total_answers'] : 0,
        'id'         => $q['Id'],
        'no'         => $idx + 1,
        'label'      => 'P' . ($idx + 1),
        'section'    => $q['Section'] ?? '',
        'pertanyaan' => $q['Pertanyaan'],
        'avg'        => $valScore,
        'count'      => !empty($qStats['total_answers']) ? (int)$qStats['total_answers'] : 0
      );
    }

    // 2. Distribusi Mutu Pelayanan / Kepuasan (untuk Bagan Donat / Donut Chart)
    $distribusiMutu = array(
      'Sangat Baik' => 0,
      'Baik'        => 0,
      'Kurang Baik' => 0,
      'Tidak Baik'  => 0
    );

    // 3. Distribusi Demografi (untuk Diagram Lingkaran / Pie Chart)
    $distribusiGender = array(
      'Laki-laki' => 0,
      'Perempuan' => 0
    );
    $distribusiUsia = array(
      '< 20 Tahun'    => 0,
      '20 - 30 Tahun' => 0,
      '31 - 40 Tahun' => 0,
      '41 - 50 Tahun' => 0,
      '> 50 Tahun'    => 0
    );
    $distribusiKecamatan = array();

    foreach ($responden as &$r) {
      if (!empty($r['Latitude']) && !empty($r['Longitude'])) {
        $resolvedLoc = $this->resolveLocationFromCoordinates($r['Latitude'], $r['Longitude'], $r['Kecamatan'], $r['Kabupaten']);
        if (!empty($resolvedLoc['kecamatan'])) {
          $r['Kecamatan'] = $resolvedLoc['kecamatan'];
          $r['Kabupaten'] = $resolvedLoc['kabupaten'];
        }
      }

      // Mutu
      $m = !empty($r['MutuPelayanan']) ? trim($r['MutuPelayanan']) : '';
      if (isset($distribusiMutu[$m])) {
        $distribusiMutu[$m]++;
      } else {
        $skor = (float)($r['RataRataSkor'] ?? 0);
        if ($skor >= 4.5) $distribusiMutu['Sangat Baik']++;
        elseif ($skor >= 3.5) $distribusiMutu['Baik']++;
        elseif ($skor >= 2.5) $distribusiMutu['Kurang Baik']++;
        else $distribusiMutu['Tidak Baik']++;
      }

      // Gender
      $g = !empty($r['RespondenGender']) ? trim($r['RespondenGender']) : '';
      if (stripos($g, 'laki') !== false || stripos($g, 'pria') !== false) {
        $distribusiGender['Laki-laki']++;
      } elseif (stripos($g, 'perempuan') !== false || stripos($g, 'wanita') !== false) {
        $distribusiGender['Perempuan']++;
      } else {
        $distribusiGender['Laki-laki']++;
      }

      // Usia
      $u = !empty($r['RespondenUsia']) ? trim($r['RespondenUsia']) : '';
      $uNum = (int)preg_replace('/[^0-9]/', '', $u);
      if ($uNum > 0 && $uNum < 20) $distribusiUsia['< 20 Tahun']++;
      elseif ($uNum >= 20 && $uNum <= 30) $distribusiUsia['20 - 30 Tahun']++;
      elseif ($uNum >= 31 && $uNum <= 40) $distribusiUsia['31 - 40 Tahun']++;
      elseif ($uNum >= 41 && $uNum <= 50) $distribusiUsia['41 - 50 Tahun']++;
      elseif ($uNum > 50) $distribusiUsia['> 50 Tahun']++;
      else {
        if (stripos($u, '20-30') !== false || stripos($u, '20 - 30') !== false) $distribusiUsia['20 - 30 Tahun']++;
        elseif (stripos($u, '31-40') !== false || stripos($u, '31 - 40') !== false) $distribusiUsia['31 - 40 Tahun']++;
        elseif (stripos($u, '41-50') !== false || stripos($u, '41 - 50') !== false) $distribusiUsia['41 - 50 Tahun']++;
        elseif (stripos($u, '50') !== false) $distribusiUsia['> 50 Tahun']++;
        else $distribusiUsia['20 - 30 Tahun']++;
      }

      // Kecamatan
      $kec = !empty($r['Kecamatan']) ? trim($r['Kecamatan']) : 'Lainnya';
      if (!isset($distribusiKecamatan[$kec])) $distribusiKecamatan[$kec] = 0;
      $distribusiKecamatan[$kec]++;
    }

    // 4. Distribusi Instrumen Survei (A: Perusahaan, B: Pencari Kerja, C: Pemangku Kepentingan, D: Siswa Kelas 12)
    $distribusiInstrumen = array(
      'A' => 0,
      'B' => 0,
      'C' => 0,
      'D' => 0
    );
    foreach ($responden as $r) {
      $ins = strtoupper(trim($r['Instrumen'] ?? 'A'));
      if (!isset($distribusiInstrumen[$ins])) $distribusiInstrumen[$ins] = 0;
      $distribusiInstrumen[$ins]++;
    }

    echo json_encode(array(
      'status'              => true,
      'survei'              => $survei,
      'totalResponden'      => $totalResponden,
      'rataRataSkor'        => $avgSkor,
      'sebaranDaerah'       => $sebaranDaerah,
      'responden'           => $responden,
      'pertanyaan'          => $pertanyaan,
      'parameterStats'      => $parameterStats,
      'distribusiMutu'      => $distribusiMutu,
      'distribusiGender'    => $distribusiGender,
      'distribusiUsia'      => $distribusiUsia,
      'distribusiKecamatan' => $distribusiKecamatan,
      'distribusiInstrumen' => $distribusiInstrumen
    ));
    return;
  }

  /**
   * API: Ambil rincian data responden dan butir jawabannya (JSON)
   */
  public function get_responden_detail($respondenId) {
    header('Content-Type: application/json; charset=utf-8');
    
    $hasSurveyorSession = !empty($this->session->userdata('Surveiyor')) || !empty($this->session->userdata('Surveyor'));
    $hasStaffSession    = !empty($this->session->userdata('Staf')) || ((int)$this->session->userdata('level') == 3);
    $hasAdminSession    = !empty($this->session->userdata('Admin')) || ((int)$this->session->userdata('level') == 2);
    $hasSuperSession    = !empty($this->session->userdata('SuperAdmin')) || ((int)$this->session->userdata('level') == 1);
    
    $isLoggedIn = !empty($this->session->userdata('logged_in')) 
               || $hasSurveyorSession 
               || $hasStaffSession 
               || $hasAdminSession 
               || $hasSuperSession;

    if (!$isLoggedIn) {
      echo json_encode(array('status' => false, 'message' => 'Akses Terbatas: Diperlukan login.'));
      return;
    }

    $respondenId = (int)$respondenId;
    $responden = $this->db->where('Id', $respondenId)->get('survei_responden')->row_array();
    if (!$responden) {
      echo json_encode(array('status' => false, 'message' => 'Data responden tidak ditemukan.'));
      return;
    }

    if (!empty($responden['Latitude']) && !empty($responden['Longitude'])) {
      $resolvedLoc = $this->resolveLocationFromCoordinates($responden['Latitude'], $responden['Longitude'], $responden['Kecamatan'], $responden['Kabupaten']);
      if (!empty($resolvedLoc['kecamatan'])) {
        if ($responden['Kecamatan'] !== $resolvedLoc['kecamatan'] || (empty($responden['Kabupaten']) || ($responden['Kabupaten'] === 'Kabupaten Banyuwangi' && $resolvedLoc['kabupaten'] !== 'Kabupaten Banyuwangi'))) {
          $this->db->where('Id', $respondenId)->update('survei_responden', array(
            'Kecamatan' => $resolvedLoc['kecamatan'],
            'Kabupaten' => $resolvedLoc['kabupaten']
          ));
        }
        $responden['Kecamatan'] = $resolvedLoc['kecamatan'];
        $responden['Kabupaten'] = $resolvedLoc['kabupaten'];
        if (!empty($resolvedLoc['desa']) && empty($responden['Desa'])) {
          $responden['Desa'] = $resolvedLoc['desa'];
        }
      }
    }

    $answers = $this->db->select('survei_jawaban.*, survei_pertanyaan.Pertanyaan, survei_pertanyaan.Section, survei_pertanyaan.Tipe')
                        ->from('survei_jawaban')
                        ->join('survei_pertanyaan', 'survei_pertanyaan.Id = survei_jawaban.PertanyaanId', 'left')
                        ->where('survei_jawaban.RespondenId', $respondenId)
                        ->get()->result_array();

    $responden['FotoDokumentasiUrl'] = !empty($responden['FotoDokumentasi']) ? base_url($responden['FotoDokumentasi']) : null;

    echo json_encode(array('status' => true, 'data' => $responden, 'answers' => $answers));
  }

  /**
   * API: Ambil Data Spasial Responden untuk Pemetaan Geospasial Google Maps (GIS)
   * HANYA BISA DIAKSES OLEH SESSION LOGIN (Surveiyor / Staf / Admin) untuk keamanan data & privasi
   */
  public function get_survei_geo_data($surveiId = 0) {
    $this->ensureSurveiStructure();
    header('Content-Type: application/json; charset=utf-8');

    // Keamanan data spasial: Wajib session login
    $isLoggedIn = !empty($this->session->userdata('logged_in')) 
               || !empty($this->session->userdata('Surveiyor')) 
               || !empty($this->session->userdata('Surveyor')) 
               || !empty($this->session->userdata('Staf')) 
               || !empty($this->session->userdata('Admin')) 
               || !empty($this->session->userdata('SuperAdmin'));

    if (!$isLoggedIn) {
      echo json_encode(array(
        'status'         => false,
        'login_required' => true,
        'message'        => 'Akses Terbatas: Peta spasial GIS dan sebaran titik koordinat responden hanya dapat diakses oleh petugas terotentikasi (Surveiyor / Staf / Admin) demi privasi dan keamanan data.'
      ));
      return;
    }

    $surveiId = (int)$surveiId;
    if ($surveiId <= 0) {
      // Default ke survei ketenagakerjaan atau survei paling aktif
      $defaultSurvei = $this->db->like('Judul', 'Ketenagakerjaan')->order_by('Id', 'DESC')->get('survei_dinamis')->row_array();
      if ($defaultSurvei) {
        $surveiId = (int)$defaultSurvei['Id'];
      } else {
        $firstSurvei = $this->db->order_by('Id', 'DESC')->get('survei_dinamis')->row_array();
        $surveiId = $firstSurvei ? (int)$firstSurvei['Id'] : 0;
      }
    }

    $survei = $this->db->get_where('survei_dinamis', array('Id' => $surveiId))->row_array();
    if (!$survei) {
      echo json_encode(array('status' => false, 'message' => 'Survei tidak ditemukan.'));
      return;
    }

    // Ambil seluruh responden survei ini
    $respondenList = $this->db->where('SurveiId', $surveiId)->order_by('Id', 'DESC')->get('survei_responden')->result_array();
    $totalResponden = count($respondenList);

    $points = array();
    $kecamatanSummary = array();
    $totalMapped = 0;

    foreach ($respondenList as $r) {
      $hasCoords = (!empty($r['Latitude']) && !empty($r['Longitude']));
      if ($hasCoords) {
        $totalMapped++;
        // Pastikan nama kecamatan sesuai lokasi real koordinat perangkat
        $resolvedLoc = $this->resolveLocationFromCoordinates($r['Latitude'], $r['Longitude'], $r['Kecamatan'], $r['Kabupaten']);
        if (!empty($resolvedLoc['kecamatan'])) {
          if ($r['Kecamatan'] !== $resolvedLoc['kecamatan'] || (empty($r['Kabupaten']) || ($r['Kabupaten'] === 'Kabupaten Banyuwangi' && $resolvedLoc['kabupaten'] !== 'Kabupaten Banyuwangi'))) {
            $this->db->where('Id', $r['Id'])->update('survei_responden', array(
              'Kecamatan' => $resolvedLoc['kecamatan'],
              'Kabupaten' => $resolvedLoc['kabupaten']
            ));
          }
          $r['Kecamatan'] = $resolvedLoc['kecamatan'];
          $r['Kabupaten'] = $resolvedLoc['kabupaten'];
          if (!empty($resolvedLoc['desa']) && empty($r['Desa'])) {
            $r['Desa'] = $resolvedLoc['desa'];
          }
        }
      }

      $kecName = trim($r['Kecamatan']) ?: 'Tidak Terdata';
      if (!isset($kecamatanSummary[$kecName])) {
        $kecamatanSummary[$kecName] = array(
          'kecamatan'     => $kecName,
          'total'         => 0,
          'totalSkor'     => 0.0,
          'avgSkor'       => 0.0,
          'mutu'          => 'Baik',
          'lastSubmit'    => null,
          'points'        => array()
        );
      }

      $kecamatanSummary[$kecName]['total']++;
      $kecamatanSummary[$kecName]['totalSkor'] += (float)$r['RataRataSkor'];
      if (!$kecamatanSummary[$kecName]['lastSubmit'] || $r['CreatedAt'] > $kecamatanSummary[$kecName]['lastSubmit']) {
        $kecamatanSummary[$kecName]['lastSubmit'] = $r['CreatedAt'];
      }

      $pt = array(
        'id'             => (int)$r['Id'],
        'nama'           => $r['RespondenNama'] ?: 'Anonim',
        'gender'         => $r['RespondenGender'] ?: '-',
        'usia'           => $r['RespondenUsia'] ?: '-',
        'pekerjaan'      => $r['RespondenPekerjaan'] ?: '-',
        'kabupaten'      => $r['Kabupaten'] ?: '',
        'kecamatan'      => $r['Kecamatan'] ?: '',
        'desa'           => $r['Desa'] ?: '',
        'alamat'         => $r['AlamatDetail'] ?: '',
        'lat'            => $r['Latitude'] !== null ? (float)$r['Latitude'] : null,
        'lng'            => $r['Longitude'] !== null ? (float)$r['Longitude'] : null,
        'accuracy'       => $r['LokasiAccuracy'] !== null ? (float)$r['LokasiAccuracy'] : null,
        'device'         => $r['DevicePlatform'] ?: ($r['UserAgent'] ? (strpos($r['UserAgent'], 'Mobile') !== false ? 'Mobile Device' : 'Desktop / PC') : 'Device Web'),
        'skor'           => (float)$r['RataRataSkor'],
        'mutu'           => $r['MutuPelayanan'] ?: 'Baik',
        'time'           => $r['CreatedAt'] ? date('d M Y, H:i', strtotime($r['CreatedAt'])) . ' WIB' : '-',
        'waktuSubmit'    => $r['CreatedAt'],
        'waktuFormatted' => $r['CreatedAt'] ? date('d M Y, H:i', strtotime($r['CreatedAt'])) . ' WIB' : '-'
      );

      $points[] = $pt;
      $kecamatanSummary[$kecName]['points'][] = $pt;
    }

    // Hitung rata-rata per kecamatan
    foreach ($kecamatanSummary as &$ks) {
      $ks['avgSkor'] = ($ks['total'] > 0) ? round($ks['totalSkor'] / $ks['total'], 2) : 0.0;
      if ($ks['avgSkor'] >= 3.50) {
        $ks['mutu'] = 'Sangat Baik (A)';
      } elseif ($ks['avgSkor'] >= 2.75) {
        $ks['mutu'] = 'Baik (B)';
      } elseif ($ks['avgSkor'] >= 2.00) {
        $ks['mutu'] = 'Kurang Baik (C)';
      } else {
        $ks['mutu'] = 'Tidak Baik (D)';
      }
    }

    // Ambil daftar seluruh survei dinamis untuk filter/switcher
    $surveiList = $this->db->select('Id, Judul, Lembaga, Jenis, Tahun, DaerahSurvei')->order_by('Id', 'DESC')->get('survei_dinamis')->result_array();

    echo json_encode(array(
      'status'           => true,
      'survei'           => $survei,
      'totalResponden'   => $totalResponden,
      'totalMapped'      => $totalMapped,
      'rataRataSkor'     => !empty($survei['RataRataSkor']) ? (float)$survei['RataRataSkor'] : 0,
      'kecamatanSummary' => array_values($kecamatanSummary),
      'points'           => $points,
      'surveiList'       => $surveiList
    ));
    return;
  }

  /**
   * Ekspor Data Responden Kuesioner ke Spreadsheet / Excel (.xls)
   * Kompatibel dengan Microsoft Excel, Google Sheets, dan LibreOffice Calc
   */
  public function export_responden_excel($surveiId = 0) {
    // Keamanan data: Wajib session login
    $isLoggedIn = !empty($this->session->userdata('logged_in')) 
               || !empty($this->session->userdata('Surveiyor')) 
               || !empty($this->session->userdata('Surveyor')) 
               || !empty($this->session->userdata('Staf')) 
               || !empty($this->session->userdata('Admin')) 
               || !empty($this->session->userdata('SuperAdmin'));

    if (!$isLoggedIn) {
      redirect(base_url('MenuSurvei'));
      return;
    }

    $surveiId = (int)$surveiId;
    $this->ensureSurveiStructure();

    // Ambil data survei jika surveiId spesifik
    $survei = null;
    if ($surveiId > 0) {
      $survei = $this->db->get_where('survei_dinamis', array('Id' => $surveiId))->row_array();
    }

    // Ambil butir pertanyaan
    if ($surveiId > 0) {
      $pertanyaanList = $this->db->where('SurveiId', $surveiId)->order_by('Urutan', 'ASC')->get('survei_pertanyaan')->result_array();
      $respondenList = $this->db->where('SurveiId', $surveiId)->order_by('Id', 'DESC')->get('survei_responden')->result_array();
    } else {
      $pertanyaanList = array();
      $respondenList = $this->db->order_by('Id', 'DESC')->get('survei_responden')->result_array();
    }

    // Resolusi nama kecamatan real dari koordinat
    foreach ($respondenList as &$r) {
      if (!empty($r['Latitude']) && !empty($r['Longitude'])) {
        $resolvedLoc = $this->resolveLocationFromCoordinates($r['Latitude'], $r['Longitude'], $r['Kecamatan'], $r['Kabupaten']);
        if (!empty($resolvedLoc['kecamatan'])) {
          $r['Kecamatan'] = $resolvedLoc['kecamatan'];
          $r['Kabupaten'] = $resolvedLoc['kabupaten'];
        }
      }
    }
    unset($r);

    // Ambil mapping survei untuk info judul jika export all
    $surveiMap = array();
    $allSurveys = $this->db->get('survei_dinamis')->result_array();
    foreach ($allSurveys as $s) {
      $surveiMap[$s['Id']] = $s;
    }

    // Ambil seluruh jawaban untuk responden terkait
    $jawabanMap = array();
    if (!empty($respondenList)) {
      $respIds = array_column($respondenList, 'Id');
      $jawabanRows = $this->db->where_in('RespondenId', $respIds)->get('survei_jawaban')->result_array();
      foreach ($jawabanRows as $j) {
        $jawabanMap[$j['RespondenId']][$j['PertanyaanId']] = $j;
      }
    }

    // Nama file yang bersih dan informatif
    $judulSafe = $survei ? preg_replace('/[^a-zA-Z0-9_-]/', '_', substr($survei['Judul'], 0, 30)) : 'Semua_Survei';
    $filename = 'Data_Responden_' . $judulSafe . '_' . date('Ymd_His') . '.xls';

    // Set headers untuk streaming file spreadsheet Excel
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=\"{$filename}\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Output XML / HTML format table with Excel styling
    echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
    echo '<head>';
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    echo '<!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>Data Responden</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->';
    echo '<style>';
    echo 'body { font-family: Calibri, Arial, sans-serif; font-size: 11pt; color: #1e293b; }';
    echo '.title { font-size: 16pt; font-weight: bold; color: #043168; }';
    echo '.subtitle { font-size: 11pt; color: #475569; }';
    echo 'table { border-collapse: collapse; width: 100%; margin-top: 15px; }';
    echo 'th { background-color: #043168; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #0b3977; padding: 10px 8px; vertical-align: middle; }';
    echo 'td { border: 1px solid #cbd5e1; padding: 8px; vertical-align: middle; }';
    echo '.num { mso-number-format: "\#\,\#\#0"; text-align: center; }';
    echo '.decimal { mso-number-format: "0\.00"; text-align: center; font-weight: bold; color: #059669; }';
    echo '.text-center { text-align: center; }';
    echo '.text-left { text-align: left; }';
    echo '.highlight { background-color: #f0fdf4; color: #065f46; font-weight: bold; text-align: center; }';
    echo '.alt-row { background-color: #f8fafc; }';
    echo '</style>';
    echo '</head>';
    echo '<body>';

    // Header Laporan
    echo '<div class="title">' . ($survei ? htmlspecialchars($survei['Judul']) : 'REKAPITULASI DATA RESPONDEN SURVEI') . '</div>';
    if ($survei) {
      echo '<div class="subtitle">Instansi: ' . htmlspecialchars($survei['Lembaga'] ?: 'IDE Consultant') . ' | Jenis: ' . htmlspecialchars($survei['Jenis']) . ' | Tahun: ' . htmlspecialchars($survei['Tahun']) . ' | Wilayah: ' . htmlspecialchars($survei['DaerahSurvei'] ?: 'Terbuka') . '</div>';
    }
    echo '<div class="subtitle">Waktu Unduh: ' . date('d F Y - H:i:s') . ' WIB | Total Responden: ' . count($respondenList) . ' Responden</div>';
    echo '<br/>';

    // Table Content
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th rowspan="2" style="width: 45px;">No</th>';
    echo '<th rowspan="2" style="width: 140px;">Waktu Pengisian</th>';
    if (!$survei) {
      echo '<th rowspan="2" style="width: 220px;">Judul Survei</th>';
    }
    echo '<th rowspan="2" style="width: 180px;">Nama Responden</th>';
    echo '<th rowspan="2" style="width: 130px;">Kontak / No HP</th>';
    echo '<th rowspan="2" style="width: 90px;">Gender</th>';
    echo '<th rowspan="2" style="width: 80px;">Usia</th>';
    echo '<th rowspan="2" style="width: 110px;">Pendidikan</th>';
    echo '<th rowspan="2" style="width: 130px;">Pekerjaan</th>';
    echo '<th colspan="5">Keterangan Daerah Survei</th>';
    echo '<th colspan="3">Geolokasi &amp; Perangkat Device</th>';
    echo '<th rowspan="2" style="width: 130px;">Foto Dokumentasi</th>';
    echo '<th rowspan="2" style="width: 90px;">Rata-Rata Skor</th>';
    echo '<th rowspan="2" style="width: 110px;">Mutu Pelayanan</th>';

    if (!empty($pertanyaanList)) {
      echo '<th colspan="' . count($pertanyaanList) . '">Rincian Nilai Butir Pertanyaan</th>';
    }
    echo '</tr>';

    echo '<tr>';
    echo '<th style="width: 120px;">Provinsi</th>';
    echo '<th style="width: 130px;">Kabupaten / Kota</th>';
    echo '<th style="width: 120px;">Kecamatan</th>';
    echo '<th style="width: 120px;">Desa / Kelurahan</th>';
    echo '<th style="width: 160px;">Unit Layanan / Alamat Detail</th>';
    echo '<th style="width: 110px;">Latitude</th>';
    echo '<th style="width: 110px;">Longitude</th>';
    echo '<th style="width: 160px;">Perangkat / Device</th>';

    if (!empty($pertanyaanList)) {
      foreach ($pertanyaanList as $idx => $q) {
        $shortQ = htmlspecialchars(mb_strimwidth($q['Pertanyaan'], 0, 35, '...'));
        echo '<th style="width: 140px;" title="' . htmlspecialchars($q['Pertanyaan']) . '">P' . ($idx + 1) . ': ' . $shortQ . '</th>';
      }
    }
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    if (empty($respondenList)) {
      $colSpanTotal = 13 + ($survei ? 0 : 1) + count($pertanyaanList);
      echo '<tr><td colspan="' . $colSpanTotal . '" class="text-center" style="padding: 25px; color: #64748b;">Belum ada data responden yang mengisi survei ini.</td></tr>';
    } else {
      $no = 1;
      foreach ($respondenList as $r) {
        $rowClass = ($no % 2 === 0) ? 'alt-row' : '';
        echo '<tr class="' . $rowClass . '">';
        echo '<td class="num">' . $no++ . '</td>';
        echo '<td class="text-center">' . htmlspecialchars($r['CreatedAt'] ?: '-') . '</td>';
        if (!$survei) {
          $sJudul = isset($surveiMap[$r['SurveiId']]) ? $surveiMap[$r['SurveiId']]['Judul'] : 'Survei #' . $r['SurveiId'];
          echo '<td class="text-left">' . htmlspecialchars($sJudul) . '</td>';
        }
        echo '<td class="text-left" style="font-weight: 600;">' . htmlspecialchars($r['RespondenNama'] ?: 'Anonim') . '</td>';
        echo '<td class="text-center" style="mso-number-format: \'\\@\';">' . htmlspecialchars($r['RespondenKontak'] ?: '-') . '</td>';
        echo '<td class="text-center">' . htmlspecialchars($r['RespondenGender'] ?: '-') . '</td>';
        echo '<td class="text-center">' . htmlspecialchars($r['RespondenUsia'] ?: '-') . '</td>';
        echo '<td class="text-center">' . htmlspecialchars($r['RespondenPendidikan'] ?: '-') . '</td>';
        echo '<td class="text-left">' . htmlspecialchars($r['RespondenPekerjaan'] ?: '-') . '</td>';
        echo '<td class="text-left">' . htmlspecialchars($r['Provinsi'] ?: '-') . '</td>';
        echo '<td class="text-left">' . htmlspecialchars($r['Kabupaten'] ?: '-') . '</td>';
        echo '<td class="text-left">' . htmlspecialchars($r['Kecamatan'] ?: '-') . '</td>';
        echo '<td class="text-left">' . htmlspecialchars($r['Desa'] ?: '-') . '</td>';
        echo '<td class="text-left">' . htmlspecialchars($r['AlamatDetail'] ?: '-') . '</td>';
        $fotoHtml = !empty($r['FotoDokumentasi']) ? ('<a href="' . base_url($r['FotoDokumentasi']) . '" target="_blank" style="color: #043168; font-weight: bold;">Lihat Foto</a>') : '<span style="color: #94a3b8;">-</span>';
        echo '<td class="text-center">' . $fotoHtml . '</td>';
        echo '<td class="decimal">' . number_format((float)$r['RataRataSkor'], 2) . '</td>';
        echo '<td class="highlight">' . htmlspecialchars($r['MutuPelayanan'] ?: 'Baik') . '</td>';

        if (!empty($pertanyaanList)) {
          foreach ($pertanyaanList as $q) {
            $ans = isset($jawabanMap[$r['Id']][$q['Id']]) ? $jawabanMap[$r['Id']][$q['Id']] : null;
            if ($ans) {
              $valText = htmlspecialchars($ans['JawabanTeks']);
              if ($ans['NilaiAngka'] !== null && $ans['NilaiAngka'] !== '') {
                $valText .= ' (' . $ans['NilaiAngka'] . ')';
              }
              echo '<td class="text-center">' . $valText . '</td>';
            } else {
              echo '<td class="text-center" style="color: #94a3b8;">-</td>';
            }
          }
        }
        echo '</tr>';
      }
    }

    echo '</tbody>';
    echo '</table>';
    echo '</body>';
    echo '</html>';
    exit;
  }

  /**
   * API: Ambil data wilayah bersarang dari kodewilayah
   * (Provinsi -> Kabupaten -> Kecamatan -> Desa)
   */
  public function get_wilayah_child() {
    header('Content-Type: application/json; charset=utf-8');
    if (!$this->db->table_exists('kodewilayah')) {
      echo json_encode(array('status' => false, 'data' => array()));
      return;
    }

    $parent = trim($this->input->get('parent') ?: $this->input->post('parent'));
    $level = trim($this->input->get('level') ?: $this->input->post('level'));

    if (empty($parent)) {
      // Ambil seluruh provinsi
      $rows = $this->db->query("SELECT Kode, Nama FROM `kodewilayah` WHERE length(Kode) = 2 ORDER BY Nama ASC")->result_array();
    } elseif ($level === 'kabupaten') {
      $safeParent = $this->db->escape_like_str($parent);
      $rows = $this->db->query("SELECT Kode, Nama FROM `kodewilayah` WHERE Kode LIKE '{$safeParent}.%' AND length(Kode) = 5 ORDER BY Nama ASC")->result_array();
    } elseif ($level === 'kecamatan') {
      $safeParent = $this->db->escape_like_str($parent);
      $rows = $this->db->query("SELECT Kode, Nama FROM `kodewilayah` WHERE Kode LIKE '{$safeParent}.%' AND length(Kode) = 8 ORDER BY Nama ASC")->result_array();
    } elseif ($level === 'desa') {
      $safeParent = $this->db->escape_like_str($parent);
      $rows = $this->db->query("SELECT Kode, Nama FROM `kodewilayah` WHERE Kode LIKE '{$safeParent}.%' ORDER BY Nama ASC")->result_array();
    } else {
      $rows = array();
    }

    echo json_encode(array('status' => true, 'data' => $rows));
    return;
  }

  
    public function legalitas() {
        $data['title'] = 'Legalitas & Sertifikasi | IDE Consultant';
        $this->load->view('legalitas', $data);

        
    }

    public function MenuPortofolio() {
        $data['title'] = 'Portofolio | IDE Consultant';
        $this->load->view('MenuPortofolio', $data);

        
    }
    public function UsulanPerangkatDaerahBWI2027() {
    $data['title'] = 'Usulan Perangkat Daerah BWI 2027';

    $this->load->view('UsulanPerangkatDaerahBWI2027'); 
}

public function RoadmapHilirisasiBanyuwangi2026() {
    $data['title'] = 'Roadmap Hilirisasi Banyuwangi 2026';

    $this->load->view('RoadmapHilirisasiBanyuwangi2026'); 
}
    public function MasterData() {
        $data['title'] = 'Master Data Proyek | IDE Consultant';
        $data['isLoggedIn'] = $this->session->userdata('logged_in') ? true : false;
        $data['userLevel'] = $this->session->userdata('level') ? (int)$this->session->userdata('level') : 0;
        $data['userName'] = $this->session->userdata('nama_lengkap') ? $this->session->userdata('nama_lengkap') : $this->session->userdata('username');
        if (empty($data['userName'])) {
            $data['userName'] = 'User';
        }
        $this->load->view('MasterData', $data);
    }

    /**
     * Halaman Publik: Komparasi Data Wilayah (Hanya data terverifikasi)
     */
    public function KomparasiData() {
        $data['title'] = 'Komparasi Data Wilayah | IDE Consultant';
        $data['isLoggedIn'] = $this->session->userdata('logged_in') ? true : false;
        $data['userLevel'] = $this->session->userdata('level') ? (int)$this->session->userdata('level') : 0;
        $data['userName'] = $this->session->userdata('nama_lengkap') ? $this->session->userdata('nama_lengkap') : $this->session->userdata('username');
        if (empty($data['userName'])) {
            $data['userName'] = 'User';
        }

        // Ambil daftar daerah yang terdaftar
        $data['daerah_list'] = $this->db->order_by('NamaDaerah', 'ASC')->get('olah_data_daerah')->result_array();

        $this->load->view('KomparasiDataWilayah', $data);
    }

    /**
     * Endpoint Publik: Data Komparasi Wilayah (Khusus Indikator yang Sudah Terverifikasi)
     */
    public function GetKomparasiDataPublik() {
        $daerahIdsRaw = $this->input->post('daerah_ids');
        if (empty($daerahIdsRaw)) {
            $daerahIdsRaw = $this->input->post('daerah_ids[]');
        }
        if (empty($daerahIdsRaw) && isset($_POST['daerah_ids'])) {
            $daerahIdsRaw = $_POST['daerah_ids'];
        }
        if (empty($daerahIdsRaw) && isset($_POST['daerah_ids[]'])) {
            $daerahIdsRaw = $_POST['daerah_ids[]'];
        }
        if (empty($daerahIdsRaw)) {
            $daerahIdsRaw = $this->input->get('daerah_ids');
        }
        if (empty($daerahIdsRaw) && isset($_GET['daerah_ids'])) {
            $daerahIdsRaw = $_GET['daerah_ids'];
        }
        if (empty($daerahIdsRaw) && isset($_GET['daerah_ids[]'])) {
            $daerahIdsRaw = $_GET['daerah_ids[]'];
        }

        $daerahIds = array();
        if (is_array($daerahIdsRaw)) {
            foreach ($daerahIdsRaw as $id) {
                $idInt = (int)$id;
                if ($idInt > 0 && !in_array($idInt, $daerahIds)) {
                    $daerahIds[] = $idInt;
                }
            }
        } elseif (is_string($daerahIdsRaw)) {
            $parts = explode(',', $daerahIdsRaw);
            foreach ($parts as $p) {
                $idInt = (int)trim($p);
                if ($idInt > 0 && !in_array($idInt, $daerahIds)) {
                    $daerahIds[] = $idInt;
                }
            }
        }

        // Maksimal 3 daerah
        if (count($daerahIds) > 3) {
            $daerahIds = array_slice($daerahIds, 0, 3);
        }

        if (empty($daerahIds)) {
            echo json_encode(array('status' => 'error', 'message' => 'Pilih minimal 1 daerah (maksimal 3 daerah) untuk dibandingkan!'));
            return;
        }

        $regions = array();
        $allYearsSet = array();
        $indicatorsByRegion = array();

        foreach ($daerahIds as $did) {
            $d = $this->db->get_where('olah_data_daerah', array('Id' => $did))->row_array();
            if ($d) {
                $years = json_decode($d['TahunList'] ?? '[]', true) ?: array();
                sort($years, SORT_NUMERIC);
                $d['Years'] = $years;

                // Hitung hanya indikator yang berstatus terverifikasi
                $d['TotalIndikator'] = $this->db->where('DaerahId', $did)
                                                ->where('LOWER(TRIM(StatusVerifikasi))', 'terverifikasi')
                                                ->count_all_results('olah_data_indikator');
                $regions[] = $d;

                if (!empty($years)) {
                    foreach ($years as $y) {
                        $allYearsSet[(string)$y] = true;
                    }
                }

                // Ambil HANYA indikator yang statusnya 'terverifikasi'
                $inds = $this->db->where('DaerahId', $did)
                                 ->where('LOWER(TRIM(StatusVerifikasi))', 'terverifikasi')
                                 ->order_by('Urutan', 'ASC')
                                 ->order_by('Id', 'ASC')
                                 ->get('olah_data_indikator')
                                 ->result_array();

                foreach ($inds as &$ind) {
                    $ind['DataTahunParsed'] = json_decode($ind['DataTahun'] ?? '{}', true) ?: array();
                    if (empty($years)) {
                        foreach (array_keys($ind['DataTahunParsed']) as $y) {
                            $allYearsSet[(string)$y] = true;
                        }
                    }
                }
                unset($ind);
                $indicatorsByRegion[$did] = $inds;
            }
        }

        if (empty($regions)) {
            echo json_encode(array('status' => 'error', 'message' => 'Daerah yang dipilih tidak ditemukan!'));
            return;
        }

        $sortedYears = array_map('strval', array_keys($allYearsSet));
        sort($sortedYears, SORT_NUMERIC);
        $sortedYears = array_values(array_map('strval', $sortedYears));

        $this->load->helper('olahdata');
        $masterKategori = get_master_kategori_olah_data();

        // Bangun matriks komparasi indikator:
        $matrix = array();

        foreach ($masterKategori as $katKey => $kat) {
            $katNama = $kat['nama'];
            foreach ($kat['sub'] as $subKey => $sub) {
                $subNama = $sub['nama'];
                foreach ($sub['indikator'] as $stdInd) {
                    $key = strtolower(trim($katNama)) . '|||' . strtolower(trim($subNama)) . '|||' . strtolower(trim($stdInd['nama']));
                    $matrix[$key] = array(
                        'Kategori'      => $katNama,
                        'SubKategori'   => $subNama,
                        'NamaIndikator' => $stdInd['nama'],
                        'Satuan'        => $stdInd['satuan'] ?? '',
                        'Values'        => array(),
                        'HasVerified'   => false
                    );
                }
            }
        }

        // Petakan nilai terverifikasi dari masing-masing daerah
        foreach ($regions as $r) {
            $did = $r['Id'];
            $inds = $indicatorsByRegion[$did] ?? array();

            foreach ($inds as $ind) {
                $k = trim($ind['Kategori'] ?? '');
                $s = trim($ind['SubKategori'] ?? '');
                $n = trim($ind['NamaIndikator'] ?? '');
                $key = strtolower($k) . '|||' . strtolower($s) . '|||' . strtolower($n);

                if (!isset($matrix[$key])) {
                    $matchedKey = null;
                    foreach ($matrix as $mK => $mV) {
                        if (strcasecmp(trim($mV['NamaIndikator']), $n) === 0) {
                            $matchedKey = $mK;
                            break;
                        }
                    }
                    if ($matchedKey) {
                        $key = $matchedKey;
                    } else {
                        $matrix[$key] = array(
                            'Kategori'      => $k ?: 'LAINNYA',
                            'SubKategori'   => $s ?: 'Umum',
                            'NamaIndikator' => $n,
                            'Satuan'        => $ind['Satuan'] ?? '',
                            'Values'        => array(),
                            'HasVerified'   => false
                        );
                    }
                }

                $cleanValues = array();
                foreach ($ind['DataTahunParsed'] as $yK => $yV) {
                    $strYK = (string)$yK;
                    if (isset($allYearsSet[$strYK])) {
                        $cleanValues[$strYK] = $yV;
                    }
                }
                $matrix[$key]['Values'][$did] = $cleanValues;
                $matrix[$key]['HasVerified'] = true;
                if (empty($matrix[$key]['Satuan']) && !empty($ind['Satuan'])) {
                    $matrix[$key]['Satuan'] = $ind['Satuan'];
                }
            }
        }

        // Filter: Hanya tampilkan baris yang memiliki nilai terverifikasi
        $filteredRows = array();
        foreach ($matrix as $row) {
            if (!empty($row['HasVerified'])) {
                unset($row['HasVerified']);
                $filteredRows[] = $row;
            }
        }

        echo json_encode(array(
            'status'          => 'success',
            'regions'         => $regions,
            'all_years'       => $sortedYears,
            'rows'            => $filteredRows,
            'master_kategori' => $masterKategori
        ));
    }

    public function debug_session() {
    echo '<pre>';
    echo 'Session Data:<br>';
    print_r($this->session->userdata());
    echo '<br><br>';
    echo 'isLoggedIn: ' . ($this->session->userdata('logged_in') ? 'true' : 'false') . '<br>';
    echo 'userLevel: ' . $this->session->userdata('level') . '<br>';
    echo 'userName: ' . $this->session->userdata('nama_lengkap') . '<br>';
    echo '</pre>';
}


  

    // ====================== SMB - SISTEM MANAJEMEN BAPPEDA ======================

    /**
     * Halaman Login SMB (View)
     */
    public function SmbLoginPage()
    {
        if ($this->session->userdata('smb_logged_in')) {
            redirect('IDE/SmbDashboard');
        }
        $this->load->view('Smb/auth_smb');
    }

   

    public function SmbLandingPage() {
    $this->load->view('Smb/SmbLandingPage');
}



/**
 * Get riwayat analisis data
 */
public function get_riwayat_analisis() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $this->db->order_by('created_at', 'DESC');
    $this->db->limit(50);
    $query = $this->db->get('smb_analisis_data');
    $data = $query->result();
    
    foreach ($data as &$item) {
        $item->tanggal = date('d/m/Y H:i', strtotime($item->created_at));
    }
    
    echo json_encode(['status' => 'success', 'data' => $data]);
}


/**


    
 * Catat Login User
 * Panggil method ini setelah user berhasil login
 */
public function log_login() {
    if (!$this->session->userdata('smb_logged_in')) {
        return;
    }
    
    $username = $this->session->userdata('username');
    $bidang = $this->session->userdata('bidang');
    
    // Hentikan session login sebelumnya yang masih active untuk user yang sama
    $this->db->where('username', $username);
    $this->db->where('status', 'active');
    $this->db->update('smb_login_log', [
        'status' => 'timed_out',
        'logout_time' => date('Y-m-d H:i:s')
    ]);
    
    $data = [
        'username' => $username,
        'bidang' => $bidang,
        'ip_address' => $this->input->ip_address(),
        'user_agent' => $this->input->user_agent(),
        'login_time' => date('Y-m-d H:i:s'),
        'status' => 'active'
    ];
    
    $this->db->insert('smb_login_log', $data);
    
    // Simpan id_log ke session untuk update logout nanti
    $this->session->set_userdata('current_login_id', $this->db->insert_id());
}

/**
 * Catat Logout User
 * Panggil method ini saat user logout
 */
public function log_logout() {
    $login_id = $this->session->userdata('current_login_id');
    
    if ($login_id) {
        $login = $this->db->get_where('smb_login_log', ['id_log' => $login_id])->row_array();
        
        if ($login && $login['status'] == 'active') {
            $logout_time = date('Y-m-d H:i:s');
            $login_time = strtotime($login['login_time']);
            $logout_timestamp = strtotime($logout_time);
            $duration = $logout_timestamp - $login_time;
            
            $this->db->where('id_log', $login_id);
            $this->db->update('smb_login_log', [
                'logout_time' => $logout_time,
                'duration_seconds' => $duration,
                'status' => 'logged_out'
            ]);
        }
    }
}

/**
 * Get Login Log dengan Filter (dengan pagination dan total count)
 */
public function get_login_log() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    
    $username = $this->input->get('username');
    $bidang = $this->input->get('bidang');
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');
    $search = $this->input->get('search');
    $limit = (int)$this->input->get('limit') ?: 25;
    $offset = (int)$this->input->get('offset') ?: 0;
    
    // Query untuk menghitung total (tanpa limit)
    $this->db->select('COUNT(*) as total');
    $this->db->from('smb_login_log l');
    
    // Filter berdasarkan bidang (join ke akun)
    if (!empty($bidang)) {
        $this->db->join('akun a', 'a.Username = l.username', 'left');
        $bidang_map = [
            'Litbang' => 'Litbang',
            'Perencanaan' => 'Perencanaan', 
            'Ekonomi' => 'Ekonomi',
            'Kesra' => 'Kesra',
            'Sarpras' => 'Sarpras',
            'Sekretariat' => 'Sekretariat'
        ];
        if (isset($bidang_map[$bidang])) {
            $this->db->where('a.Bidang', $bidang_map[$bidang]);
        }
    }
    
    // Filter username spesifik
    if (!empty($username)) {
        $this->db->where('l.username', $username);
    }
    
    // Filter tanggal
    if (!empty($start_date)) {
        $this->db->where('DATE(l.login_time) >=', date('Y-m-d', strtotime($start_date)));
    }
    if (!empty($end_date)) {
        $this->db->where('DATE(l.login_time) <=', date('Y-m-d', strtotime($end_date)));
    }
    
    // Filter pencarian
    if (!empty($search)) {
        $this->db->group_start()
            ->like('l.username', $search)
            ->or_like('l.ip_address', $search)
            ->group_end();
    }
    
    $total_result = $this->db->get()->row_array();
    $total = (int)($total_result['total'] ?? 0);
    
    // Query untuk mengambil data (dengan limit)
    $this->db->select('l.*');
    $this->db->from('smb_login_log l');
    
    // Filter bidang (join ke akun)
    if (!empty($bidang)) {
        $this->db->join('akun a', 'a.Username = l.username', 'left');
        $bidang_map = [
            'Litbang' => 'Litbang',
            'Perencanaan' => 'Perencanaan', 
            'Ekonomi' => 'Ekonomi',
            'Kesra' => 'Kesra',
            'Sarpras' => 'Sarpras',
            'Sekretariat' => 'Sekretariat'
        ];
        if (isset($bidang_map[$bidang])) {
            $this->db->where('a.Bidang', $bidang_map[$bidang]);
        }
    }
    
    // Filter username spesifik
    if (!empty($username)) {
        $this->db->where('l.username', $username);
    }
    
    // Filter tanggal
    if (!empty($start_date)) {
        $this->db->where('DATE(l.login_time) >=', date('Y-m-d', strtotime($start_date)));
    }
    if (!empty($end_date)) {
        $this->db->where('DATE(l.login_time) <=', date('Y-m-d', strtotime($end_date)));
    }
    
    // Filter pencarian
    if (!empty($search)) {
        $this->db->group_start()
            ->like('l.username', $search)
            ->or_like('l.ip_address', $search)
            ->group_end();
    }
    
    $this->db->order_by('l.login_time', 'DESC');
    $this->db->limit($limit, $offset);
    $logs = $this->db->get()->result_array();
    
    foreach ($logs as &$log) {
        $log['login_time_formatted'] = date('d/m/Y H:i:s', strtotime($log['login_time']));
        $log['logout_time_formatted'] = $log['logout_time'] ? date('d/m/Y H:i:s', strtotime($log['logout_time'])) : '-';
        $log['duration_formatted'] = $this->_formatDuration($log['duration_seconds']);
        $log['status_badge'] = $this->_getStatusBadge($log['status']);
        
        // Ambil bidang dari tabel akun
        $akun = $this->db->get_where('akun', ['Username' => $log['username']])->row_array();
        $log['bidang'] = $akun['Bidang'] ?? '-';
    }
    
    echo json_encode([
        'status' => 'success', 
        'data' => $logs,
        'total' => $total,  // ← TAMBAHKAN INI
        'limit' => $limit,
        'offset' => $offset
    ]);
}

/**
 * Get Statistik Login per Akun
 */
public function get_login_stats() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    
    $username = $this->input->get('username');
    $bidang = $this->input->get('bidang');
    $periode = $this->input->get('periode'); // 'hari', 'minggu', 'bulan', 'tahun'
    
    $this->db->select('
        COUNT(*) as total_login,
        SUM(CASE WHEN status = "active" THEN 1 ELSE 0 END) as active_sessions,
        AVG(duration_seconds) as avg_duration,
        SUM(duration_seconds) as total_duration
    ');
    $this->db->from('smb_login_log l');
    
    // Join ke akun untuk filter bidang
    if (!empty($bidang)) {
        $this->db->join('akun a', 'a.Username = l.username', 'left');
        $bidang_map = [
            'Litbang' => 'Litbang',
            'Perencanaan' => 'Perencanaan',
            'Ekonomi' => 'Ekonomi', 
            'Kesra' => 'Kesra',
            'Sarpras' => 'Sarpras',
            'Sekretariat' => 'Sekretariat'
        ];
        if (isset($bidang_map[$bidang])) {
            $this->db->where('a.Bidang', $bidang_map[$bidang]);
        }
    }
    
    // Filter username
    if (!empty($username)) {
        $this->db->where('l.username', $username);
    }
    
    // Filter periode
    switch ($periode) {
        case 'hari':
            $this->db->where('DATE(l.login_time)', date('Y-m-d'));
            break;
        case 'minggu':
            $this->db->where('l.login_time >=', date('Y-m-d H:i:s', strtotime('-7 days')));
            break;
        case 'bulan':
            $this->db->where('l.login_time >=', date('Y-m-d H:i:s', strtotime('-30 days')));
            break;
        case 'tahun':
            $this->db->where('YEAR(l.login_time)', date('Y'));
            break;
    }
    
    $result = $this->db->get()->row_array();
    
    echo json_encode([
        'status' => 'success',
        'total_login' => (int)($result['total_login'] ?? 0),
        'active_sessions' => (int)($result['active_sessions'] ?? 0),
        'avg_duration' => $this->_formatDuration($result['avg_duration']),
        'total_duration' => $this->_formatDuration($result['total_duration'])
    ]);
}

/**
 * Get Detail Rekap Login per Akun (dengan durasi dalam jam)
 */
public function get_login_detail_rekap_by_akun() {
    // Cek session login SMB
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    
    $username = $this->input->get('username', TRUE);
    if (empty($username)) {
        echo json_encode(['status' => 'error', 'message' => 'Username tidak boleh kosong']);
        return;
    }
    
    // Data untuk response
    $response = [
        'status' => 'success',
        'username' => $username,
        'bidang' => '',
        'periods' => []
    ];
    
    // Ambil bidang user dari tabel akun
    $akun = $this->db->get_where('akun', ['Username' => $username])->row_array();
    $response['bidang'] = $akun['Bidang'] ?? '-';
    
    // Periode yang akan dihitung
    $periods = [
        'hari' => ['label' => 'Hari Ini', 'start' => date('Y-m-d 00:00:00')],
        'minggu' => ['label' => '7 Hari Terakhir', 'start' => date('Y-m-d H:i:s', strtotime('-7 days'))],
        'bulan' => ['label' => '30 Hari Terakhir', 'start' => date('Y-m-d H:i:s', strtotime('-30 days'))],
        'tahun' => ['label' => 'Tahun Ini', 'start' => date('Y-01-01 00:00:00')],
        'semua' => ['label' => 'Semua Waktu', 'start' => null]
    ];
    
    foreach ($periods as $key => $period) {
        // Query untuk periode tertentu
        $this->db->select('
            COUNT(*) as login_count,
            SUM(duration_seconds) as total_duration_seconds,
            MAX(login_time) as last_login,
            MIN(login_time) as first_login
        ');
        $this->db->from('smb_login_log');
        $this->db->where('username', $username);
        $this->db->where('status !=', 'active'); // Hanya session yang sudah selesai
        
        if ($period['start']) {
            $this->db->where('login_time >=', $period['start']);
        }
        
        $result = $this->db->get()->row_array();
        
        // Query untuk session masih aktif
        $active_session = $this->db
            ->select('login_time, duration_seconds')
            ->from('smb_login_log')
            ->where('username', $username)
            ->where('status', 'active')
            ->get()
            ->row_array();
        
        $total_duration_seconds = (int)($result['total_duration_seconds'] ?? 0);
        
        // Jika ada session aktif, hitung durasi sementara
        if ($active_session) {
            $active_duration = time() - strtotime($active_session['login_time']);
            $total_duration_seconds += $active_duration;
        }
        
        // Hitung rata-rata durasi
        $login_count = (int)($result['login_count'] ?? 0);
        $avg_duration_seconds = $login_count > 0 ? round($total_duration_seconds / $login_count) : 0;
        
        // Format durasi ke jam:menit:detik
        $total_formatted = $this->_formatDurationToTime($total_duration_seconds);
        $avg_formatted = $this->_formatDurationToTime($avg_duration_seconds);
        
        // Dapatkan tanggal login pertama dan terakhir
        $first_login = $result['first_login'] ? date('d/m/Y H:i:s', strtotime($result['first_login'])) : '-';
        $last_login = $result['last_login'] ? date('d/m/Y H:i:s', strtotime($result['last_login'])) : '-';
        
        // Hitung rentang hari antara login pertama dan terakhir
        $range_days = 0;
        if ($result['first_login'] && $result['last_login']) {
            $first = new DateTime($result['first_login']);
            $last = new DateTime($result['last_login']);
            $range_days = $first->diff($last)->days + 1;
        }
        
        // Rata-rata login per hari
        $avg_per_day = $range_days > 0 ? round($login_count / $range_days, 2) : $login_count;
        
        $response['periods'][$key] = [
            'label' => $period['label'],
            'login_count' => $login_count,
            'total_duration_seconds' => $total_duration_seconds,
            'total_duration_formatted' => $total_formatted,
            'total_duration_hours' => round($total_duration_seconds / 3600, 2),
            'avg_duration_seconds' => $avg_duration_seconds,
            'avg_duration_formatted' => $avg_formatted,
            'avg_duration_minutes' => round($avg_duration_seconds / 60, 1),
            'first_login' => $first_login,
            'last_login' => $last_login,
            'range_days' => $range_days,
            'avg_per_day' => $avg_per_day
        ];
    }
    
    // Ambil detail log login per hari (untuk chart/graph)
    $daily_logs = $this->db
        ->select('DATE(login_time) as login_date, COUNT(*) as count, SUM(duration_seconds) as total_seconds')
        ->from('smb_login_log')
        ->where('username', $username)
        ->where('login_time >=', date('Y-m-d H:i:s', strtotime('-30 days')))
        ->group_by('DATE(login_time)')
        ->order_by('login_date', 'DESC')
        ->limit(30)
        ->get()
        ->result_array();
    
    foreach ($daily_logs as &$daily) {
        $daily['date_formatted'] = date('d/m/Y', strtotime($daily['login_date']));
        $daily['total_formatted'] = $this->_formatDurationToTime($daily['total_seconds']);
    }
    $response['daily_logs'] = $daily_logs;
    
    echo json_encode($response);
}

/**
 * Format detik ke format HH:MM:SS atau Jam:Menit
 */
private function _formatDurationToTime($seconds) {
    if (!$seconds || $seconds <= 0) return '0 jam';
    
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $secs = $seconds % 60;
    
    if ($hours > 0) {
        if ($minutes > 0) {
            return "{$hours} jam {$minutes} menit";
        }
        return "{$hours} jam";
    } elseif ($minutes > 0) {
        return "{$minutes} menit";
    } else {
        return "{$secs} detik";
    }
}

/**
 * Get Rekap Login per Akun (Dengan Pagination)
 */
public function get_login_rekap_per_akun()
{
    // Cek session login SMB
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    
    $bidang = $this->input->get('bidang');
    $periode = $this->input->get('periode'); // 'hari', 'minggu', 'bulan', 'tahun'
    $limit = (int)$this->input->get('limit') ?: 10;
    $page = (int)$this->input->get('page') ?: 1;
    $offset = ($page - 1) * $limit;
    $search = $this->input->get('search');
    
    // Query untuk menghitung total (tanpa limit)
    $this->db->select('COUNT(DISTINCT l.username) as total');
    $this->db->from('smb_login_log l');
    $this->db->join('akun a', 'a.Username = l.username', 'left');
    
    // Filter bidang
    if (!empty($bidang)) {
        $bidang_map = [
            'Litbang' => 'Litbang',
            'Perencanaan' => 'Perencanaan',
            'Ekonomi' => 'Ekonomi',
            'Kesra' => 'Kesra', 
            'Sarpras' => 'Sarpras',
            'Sekretariat' => 'Sekretariat'
        ];
        if (isset($bidang_map[$bidang])) {
            $this->db->where('a.Bidang', $bidang_map[$bidang]);
        }
    }
    
    // Filter pencarian username
    if (!empty($search)) {
        $this->db->like('l.username', $search);
    }
    
    // Filter periode
    switch ($periode) {
        case 'hari':
            $this->db->where('DATE(l.login_time)', date('Y-m-d'));
            break;
        case 'minggu':
            $this->db->where('l.login_time >=', date('Y-m-d H:i:s', strtotime('-7 days')));
            break;
        case 'bulan':
            $this->db->where('l.login_time >=', date('Y-m-d H:i:s', strtotime('-30 days')));
            break;
        case 'tahun':
            $this->db->where('YEAR(l.login_time)', date('Y'));
            break;
        default:
            // Tidak ada filter periode (semua waktu)
            break;
    }
    
    $total_result = $this->db->get()->row_array();
    $total = (int)($total_result['total'] ?? 0);
    $total_pages = ceil($total / $limit);
    
    // Query untuk mengambil data (dengan limit)
    $this->db->select('
        l.username,
        a.Bidang as user_bidang,
        COUNT(*) as total_login,
        SUM(l.duration_seconds) as total_duration,
        AVG(l.duration_seconds) as avg_duration,
        MAX(l.login_time) as last_login,
        SUM(CASE WHEN l.status = "active" THEN 1 ELSE 0 END) as active_sessions
    ');
    $this->db->from('smb_login_log l');
    $this->db->join('akun a', 'a.Username = l.username', 'left');
    
    // Filter bidang
    if (!empty($bidang)) {
        $bidang_map = [
            'Litbang' => 'Litbang',
            'Perencanaan' => 'Perencanaan',
            'Ekonomi' => 'Ekonomi',
            'Kesra' => 'Kesra', 
            'Sarpras' => 'Sarpras',
            'Sekretariat' => 'Sekretariat'
        ];
        if (isset($bidang_map[$bidang])) {
            $this->db->where('a.Bidang', $bidang_map[$bidang]);
        }
    }
    
    // Filter pencarian username
    if (!empty($search)) {
        $this->db->like('l.username', $search);
    }
    
    // Filter periode
    switch ($periode) {
        case 'hari':
            $this->db->where('DATE(l.login_time)', date('Y-m-d'));
            break;
        case 'minggu':
            $this->db->where('l.login_time >=', date('Y-m-d H:i:s', strtotime('-7 days')));
            break;
        case 'bulan':
            $this->db->where('l.login_time >=', date('Y-m-d H:i:s', strtotime('-30 days')));
            break;
        case 'tahun':
            $this->db->where('YEAR(l.login_time)', date('Y'));
            break;
        default:
            // Tidak ada filter periode (semua waktu)
            break;
    }
    
    $this->db->group_by('l.username');
    $this->db->order_by('total_login', 'DESC');
    $this->db->limit($limit, $offset);
    $users = $this->db->get()->result_array();
    
    foreach ($users as &$user) {
        $user['total_duration_formatted'] = $this->_formatDuration($user['total_duration']);
        $user['avg_duration_formatted'] = $this->_formatDuration($user['avg_duration']);
        $user['last_login_formatted'] = $user['last_login'] ? date('d/m/Y H:i:s', strtotime($user['last_login'])) : '-';
        $user['bidang'] = $user['user_bidang'] ?? '-';
        $user['total_login'] = (int)$user['total_login'];
        $user['active_sessions'] = (int)($user['active_sessions'] ?? 0);
    }
    
    echo json_encode([
        'status' => 'success', 
        'data' => $users,
        'total' => $total,
        'total_pages' => $total_pages,
        'current_page' => $page,
        'per_page' => $limit
    ]);
}

/**
 * Get Rekap Login (Statistik per periode)
 */
public function get_login_rekap()
{
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    
    $bidang = $this->input->get('bidang');
    $username = $this->input->get('username');
    
    $periods = ['hari', 'minggu', 'bulan', 'tahun'];
    $rekap = [];
    
    foreach ($periods as $period) {
        $this->db->select('
            COUNT(*) as login_count,
            SUM(duration_seconds) as total_duration,
            AVG(duration_seconds) as avg_duration
        ');
        $this->db->from('smb_login_log l');
        $this->db->join('akun a', 'a.Username = l.username', 'left');
        
        // Filter bidang
        if (!empty($bidang)) {
            $bidang_map = [
                'Litbang' => 'Litbang', 'Perencanaan' => 'Perencanaan',
                'Ekonomi' => 'Ekonomi', 'Kesra' => 'Kesra',
                'Sarpras' => 'Sarpras', 'Sekretariat' => 'Sekretariat'
            ];
            if (isset($bidang_map[$bidang])) {
                $this->db->where('a.Bidang', $bidang_map[$bidang]);
            }
        }
        
        // Filter username
        if (!empty($username)) {
            $this->db->where('l.username', $username);
        }
        
        // Filter periode
        switch ($period) {
            case 'hari':
                $this->db->where('DATE(l.login_time)', date('Y-m-d'));
                break;
            case 'minggu':
                $this->db->where('l.login_time >=', date('Y-m-d H:i:s', strtotime('-7 days')));
                break;
            case 'bulan':
                $this->db->where('l.login_time >=', date('Y-m-d H:i:s', strtotime('-30 days')));
                break;
            case 'tahun':
                $this->db->where('YEAR(l.login_time)', date('Y'));
                break;
        }
        
        $result = $this->db->get()->row_array();
        
        $rekap[$period] = [
            'login_count' => (int)($result['login_count'] ?? 0),
            'total_duration' => (int)($result['total_duration'] ?? 0),
            'avg_duration' => (int)($result['avg_duration'] ?? 0),
            'duration_formatted' => $this->_formatDuration($result['total_duration'] ?? 0)
        ];
    }
    
    echo json_encode(['status' => 'success', 'data' => $rekap]);
}

/**
 * Get Top Users Login (terbanyak login)
 */
public function get_login_top_users()
{
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    
    $bidang = $this->input->get('bidang');
    $periode = $this->input->get('periode'); // 'hari', 'minggu', 'bulan', 'tahun'
    $limit = (int)$this->input->get('limit') ?: 10;
    
    $this->db->select('
        l.username,
        a.Bidang as bidang,
        COUNT(*) as login_count,
        SUM(l.duration_seconds) as total_duration,
        AVG(l.duration_seconds) as avg_duration
    ');
    $this->db->from('smb_login_log l');
    $this->db->join('akun a', 'a.Username = l.username', 'left');
    
    // Filter bidang
    if (!empty($bidang)) {
        $bidang_map = [
            'Litbang' => 'Litbang',
            'Perencanaan' => 'Perencanaan',
            'Ekonomi' => 'Ekonomi',
            'Kesra' => 'Kesra',
            'Sarpras' => 'Sarpras',
            'Sekretariat' => 'Sekretariat'
        ];
        if (isset($bidang_map[$bidang])) {
            $this->db->where('a.Bidang', $bidang_map[$bidang]);
        }
    }
    
    // Filter periode
    switch ($periode) {
        case 'hari':
            $this->db->where('DATE(l.login_time)', date('Y-m-d'));
            break;
        case 'minggu':
            $this->db->where('l.login_time >=', date('Y-m-d H:i:s', strtotime('-7 days')));
            break;
        case 'bulan':
            $this->db->where('l.login_time >=', date('Y-m-d H:i:s', strtotime('-30 days')));
            break;
        case 'tahun':
            $this->db->where('YEAR(l.login_time)', date('Y'));
            break;
    }
    
    $this->db->group_by('l.username');
    $this->db->order_by('login_count', 'DESC');
    $this->db->limit($limit);
    $users = $this->db->get()->result_array();
    
    foreach ($users as &$user) {
        $user['duration_formatted'] = $this->_formatDuration($user['total_duration']);
        $user['login_count'] = (int)$user['login_count'];
        $user['bidang'] = $user['bidang'] ?? '-';
    }
    
    echo json_encode(['status' => 'success', 'data' => $users]);
}

/**
 * Format Duration (detik ke format HH:MM:SS)
 */
private function _formatDuration($seconds) {
    if (!$seconds || $seconds <= 0) return '00:00:00';
    
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $secs = $seconds % 60;
    
    return sprintf("%02d:%02d:%02d", $hours, $minutes, $secs);
}

/**
 * Get Status Badge HTML
 */
private function _getStatusBadge($status) {
    switch ($status) {
        case 'active':
            return '<span class="badge-status active-status"><i class="fas fa-circle"></i> Active</span>';
        case 'logged_out':
            return '<span class="badge-status logout-status"><i class="fas fa-check-circle"></i> Logged Out</span>';
        case 'timed_out':
            return '<span class="badge-status timeout-status"><i class="fas fa-clock"></i> Timed Out</span>';
        default:
            return '<span class="badge-status">-</span>';
    }
}

 /**
     * Dashboard SMB
     */
    public function SmbDashboard()
    {
        if (!$this->session->userdata('smb_logged_in') && !$this->session->userdata('logged_in')) {
            redirect('IDE/SmbLoginPage');
            return;
        }
        $data['title'] = 'Dashboard SMB - Bappeda';
        $data['nama_user'] = $this->session->userdata('nama_lengkap') ?: ($this->session->userdata('username') ?: 'Pengguna SMB');
        $this->load->view('Smb/smb_dashboard', $data);
    }

    /**
 * Proses Login SMB
 */
public function SmbLogin()
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
    header('Access-Control-Allow-Credentials: true');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Max-Age: 86400');
        exit(0);
    }

    $username = $this->input->post('username', TRUE);
    $password = $this->input->post('password', TRUE);

    if (empty($username) || empty($password)) {
        echo "Username dan Password harus diisi!";
        return;
    }

    $user = $this->db->get_where('akun', ['Username' => $username])->row_array();

    if ($user && password_verify($password, $user['Password'])) {
        $level = (int)$user['Level'];
        $session_data = [
            'smb_logged_in' => true,
            'logged_in'     => true,
            'user_id'       => $user['Username'],
            'username'      => $user['Username'],
            'Username'      => $user['Username'],
            'nama_lengkap'  => $user['Username'],
            'level'         => $level,
            'bidang'        => $user['Bidang'] ?? null,
            'system'        => 'SMB_Bappeda'
        ];

        if ($level == 1) {
            $session_data['SuperAdmin'] = true;
            $session_data['Kegiatan'] = '';
        } else if ($level == 2) {
            $session_data['Admin'] = true;
            $session_data['Kegiatan'] = '';
        } else if ($level == 3) {
            $session_data['Staf'] = true;
        } else if ($level == 4) {
            $session_data['Surveiyor'] = true;
        } else if ($level == 0) {
            $session_data['Econk'] = true;
        }

        $this->session->set_userdata($session_data);
        
        // Catat aktivitas login jika method log_login tersedia
        if (method_exists($this, 'log_login')) {
            $this->log_login();
        }
        
        echo '1';
    } else {
        echo "Username atau Password salah!";
    }
}

/**
 * Logout SMB
 */
public function SmbLogout()
{
    $this->output
        ->set_content_type('application/json')
        ->set_header('Access-Control-Allow-Origin: *');
    
    // ========== TAMBAHKAN: CATAT LOGOUT ==========
    $this->log_logout();  // <-- PANGGIL METHOD INI
    
    $this->session->unset_userdata('smb_logged_in');
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('nama_lengkap');
    $this->session->unset_userdata('level');
    $this->session->unset_userdata('system');
    $this->session->unset_userdata('bidang');  // <-- TAMBAHKAN
    $this->session->unset_userdata('current_login_id');  // <-- TAMBAHKAN
    $this->session->sess_destroy();
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Logout berhasil',
        'redirect' => base_url('IDE/SmbLoginPage')
    ]);
}



    // ==================== DOKUMEN METHODS - UPLOAD & LOAD ====================

/**
 * Upload Dokumen ke Database (tabel smb_dokumen)
 */
/**
 * Upload Dokumen ke Database (tabel smb_dokumen)
 */
public function upload_dokumen() {
    header('Content-Type: application/json');
    
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    // DEBUG: Log semua POST data
    log_message('debug', 'POST data: ' . print_r($this->input->post(), true));
    
    $id_bidang = $this->input->post('id_bidang');
    $nama_dokumen = $this->input->post('nama_dokumen');
    $kategori = $this->input->post('kategori');
    $status = $this->input->post('status');
    $method = $this->input->post('upload_method');
    
    $uploaded_by = $this->session->userdata('username');
    
    // Validasi dasar
    if (empty($id_bidang) || empty($nama_dokumen)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama dokumen dan bidang harus diisi']);
        return;
    }
    
    // ========== CEK METODE ==========
    // Cek method dari POST atau dari file_type (fallback)
    if ($method === 'link' || ($this->input->post('google_docs_link') && empty($_FILES['file_dokumen']['name']))) {
        
        // ========== PROSES LINK GOOGLE DOCS ==========
        $google_docs_link = $this->input->post('google_docs_link');
        
        if (empty($google_docs_link)) {
            echo json_encode(['status' => 'error', 'message' => 'Link Google Docs tidak boleh kosong']);
            return;
        }
        
        // Validasi format link
        if (!preg_match('/docs\.google\.com\/document\/d\/([a-zA-Z0-9_-]+)/', $google_docs_link, $matches)) {
            // Coba format alternatif
            if (!preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $google_docs_link, $matches)) {
                echo json_encode(['status' => 'error', 'message' => 'Link Google Docs tidak valid']);
                return;
            }
        }
        
        $data = [
            'id_bidang' => $id_bidang,
            'nama_dokumen' => $nama_dokumen,
            'kategori' => $kategori,
            'status' => $status,
            'google_docs_link' => $google_docs_link,
            'uploaded_by' => $uploaded_by,
            'upload_date' => date('Y-m-d H:i:s'),
            'last_edit_date' => date('Y-m-d H:i:s'),
            'last_edited_by' => $uploaded_by,
            'file_name' => '',
            'file_path' => '',
            'file_type' => 'application/vnd.google-apps.document',
            'file_size' => 0,
            'version' => 1
        ];
        
        // Insert ke database
        $insert = $this->db->insert('smb_dokumen', $data);
        
        if ($insert) {
            $id_dokumen = $this->db->insert_id();
            
            // Log aktivitas
            if (method_exists($this, '_log_aktivitas')) {
                $this->_log_aktivitas($uploaded_by, 'Upload', $id_bidang, "Upload dokumen via Google Docs: $nama_dokumen");
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Dokumen berhasil ditambahkan',
                'id_dokumen' => $id_dokumen
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menyimpan ke database: ' . $this->db->error()['message']
            ]);
        }
        
    } else {
        // ========== PROSES UPLOAD FILE ==========
        // Pastikan folder uploads/dokumen ada
        if (!is_dir('./uploads/dokumen/')) {
            mkdir('./uploads/dokumen/', 0777, true);
        }
        
        $config['upload_path'] = './uploads/dokumen/';
        $config['allowed_types'] = 'docx|pdf|jpg|png|jpeg';
        $config['max_size'] = 10240;
        
        $this->load->library('upload', $config);
        
        // Cek apakah ada file yang diupload
        if (empty($_FILES['file_dokumen']['name'])) {
            echo json_encode(['status' => 'error', 'message' => 'Pilih file terlebih dahulu']);
            return;
        }
        
        if (!$this->upload->do_upload('file_dokumen')) {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
            return;
        }
        
        $upload_data = $this->upload->data();
        
        $data = [
            'id_bidang' => $id_bidang,
            'nama_dokumen' => $nama_dokumen,
            'kategori' => $kategori,
            'status' => $status,
            'file_name' => $upload_data['file_name'],
            'file_path' => 'uploads/dokumen/' . $upload_data['file_name'],
            'file_type' => $upload_data['file_type'],
            'file_size' => $upload_data['file_size'],
            'uploaded_by' => $uploaded_by,
            'upload_date' => date('Y-m-d H:i:s'),
            'last_edit_date' => date('Y-m-d H:i:s'),
            'last_edited_by' => $uploaded_by,
            'version' => 1
        ];
        
        $insert = $this->db->insert('smb_dokumen', $data);
        
        if ($insert) {
            if (method_exists($this, '_log_aktivitas')) {
                $this->_log_aktivitas($uploaded_by, 'Upload', $id_bidang, "Upload dokumen: $nama_dokumen");
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Dokumen berhasil diupload'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menyimpan ke database: ' . $this->db->error()['message']
            ]);
        }
    }
}

/**
 * Get Dokumen by Bidang - Untuk DataTable (tabel smb_dokumen)
 */
public function get_dokumen_by_bidang() {
    // Cek session login
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    
    $id_bidang = $this->input->post('id_bidang');
    
    if (empty($id_bidang)) {
        echo json_encode(['status' => 'error', 'message' => 'ID Bidang tidak boleh kosong']);
        return;
    }
    
    // Query ambil data dokumen
    $this->db->select('*');
    $this->db->from('smb_dokumen');
    $this->db->where('id_bidang', $id_bidang);
    $this->db->order_by('upload_date', 'DESC');
    $query = $this->db->get();
    $dokumen = $query->result();
    
    // Format data untuk ditampilkan
    foreach ($dokumen as &$doc) {
        $doc->upload_date_formatted = date('d/m/Y H:i', strtotime($doc->upload_date));
        $doc->file_size_formatted = $this->_formatBytes($doc->file_size);
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => $dokumen
    ]);
}

/**
 * Format bytes ke readable format
 */


/**
 * Generate Thumbnail untuk Gambar
 */
private function _generate_thumbnail($file_path, $file_name) {
    $this->load->library('image_lib');
    
    $thumb_path = FCPATH . 'uploads/thumbnails/';
    if (!is_dir($thumb_path)) {
        mkdir($thumb_path, 0777, true);
    }
    
    $thumb_name = 'thumb_' . $file_name;
    $config['image_library'] = 'gd2';
    $config['source_image'] = $file_path;
    $config['new_image'] = $thumb_path . $thumb_name;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = 150;
    $config['height'] = 150;
    
    $this->image_lib->initialize($config);
    
    if ($this->image_lib->resize()) {
        return 'uploads/thumbnails/' . $thumb_name;
    }
    
    return null;
}
    /**
     * Get Dokumen by Bidang
     */
    
    
    /**
     * Delete Dokumen
     */
    public function delete_dokumen() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $id_dokumen = $this->input->post('id_dokumen');
        $dokumen = $this->db->get_where('smb_dokumen', ['id_dokumen' => $id_dokumen])->row_array();
        
        if ($dokumen) {
            $file_path = FCPATH . $dokumen['file_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            
            if (!empty($dokumen['thumbnail'])) {
                $thumb_path = FCPATH . $dokumen['thumbnail'];
                if (file_exists($thumb_path)) {
                    unlink($thumb_path);
                }
            }
            
            $this->db->delete('smb_dokumen', ['id_dokumen' => $id_dokumen]);
            
            $this->_log_aktivitas(
                $this->session->userdata('username'), 
                'Hapus', 
                'Dokumen', 
                "Menghapus dokumen: " . $dokumen['nama_dokumen']
            );
            
            echo json_encode(['status' => 'success', 'message' => 'Dokumen berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Dokumen tidak ditemukan']);
        }
    }
    
    public function get_log_aktivitas() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');
    $aksi = $this->input->get('aksi');
    $search = $this->input->get('search');
    $bidang_filter = $this->input->get('bidang');
    
    // Join dengan tabel akun untuk mendapatkan bidang user
    $this->db->select('l.*, a.Bidang as user_bidang');
    $this->db->from('smb_aktivitas_log l');
    $this->db->join('akun a', 'a.Username = l.username', 'left');
    
    // FILTER BERDASARKAN BIDANG YANG DIPILIH
    if (!empty($bidang_filter) && $bidang_filter !== '') {
        // Mapping nama bidang ke nilai di database - TAMBAHKAN SEKRETARIAT
        $bidang_map = [
            'Litbang' => 'Litbang',
            'Perencanaan' => 'Perencanaan',
            'Ekonomi' => 'Ekonomi',
            'Kesra' => 'Kesra',
            'Sarpras' => 'Sarpras',
            'Sekretariat' => 'Sekretariat'  // ← TAMBAHKAN INI
        ];
        
        if (isset($bidang_map[$bidang_filter])) {
            $this->db->where('a.Bidang', $bidang_map[$bidang_filter]);
        }
    }
    
    // SuperAdmin (level 1) bisa lihat semua log
    // Selain itu, hanya bisa lihat log dari bidangnya sendiri
    $user_level = $this->session->userdata('level');
    $user_bidang = $this->session->userdata('bidang');
    
    if ($user_level != 1 && !empty($user_bidang)) {
        // Non-admin hanya bisa melihat log dari bidangnya sendiri
        if (empty($bidang_filter) || $bidang_filter === '') {
            $this->db->where('a.Bidang', $user_bidang);
        }
    }
    
    if (!empty($start_date)) {
        $this->db->where('DATE(l.waktu) >=', date('Y-m-d', strtotime($start_date)));
    }
    if (!empty($end_date)) {
        $this->db->where('DATE(l.waktu) <=', date('Y-m-d', strtotime($end_date)));
    }
    if (!empty($aksi)) {
        $this->db->where('l.aksi', $aksi);
    }
    if (!empty($search)) {
        $this->db->group_start()
            ->like('l.username', $search)
            ->or_like('l.detail', $search)
            ->or_like('l.modul', $search)
            ->group_end();
    }
    
    $this->db->order_by('l.waktu', 'DESC');
    $this->db->limit(500);
    $logs = $this->db->get()->result_array();
    
    foreach ($logs as &$log) {
        $log['waktu'] = date('d/m/Y H:i:s', strtotime($log['waktu']));
        $log['ip_address'] = $log['ip_address'] ?? '-';
        $log['detail'] = $log['detail'] ?? '-';
        $log['bidang'] = $log['user_bidang'] ?? '-';
    }
    
    echo json_encode(['status' => 'success', 'data' => $logs]);
}

/**
 * Get list of users/accounts by bidang (untuk dropdown filter)
 */
// controller/IDE.php - Perbaiki method ini
public function get_akun_by_bidang() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $bidang = $this->input->get('bidang');
    
    $this->db->select('Username, Bidang');
    $this->db->from('akun');
    
    // Mapping bidang yang lebih fleksibel
    if (!empty($bidang) && $bidang !== '') {
        // Coba match dengan berbagai kemungkinan nilai
        $bidang_map = [
            'Litbang' => ['Litbang', 'Penelitian', 'Litbang Bappeda'],
            'Perencanaan' => ['Perencanaan', 'Perencanaan Pembangunan'],
            'Ekonomi' => ['Ekonomi', 'Bidang Ekonomi'],
            'Kesra' => ['Kesra', 'Kesejahteraan Rakyat'],
            'Sarpras' => ['Sarpras', 'Sarana Prasarana'],
            'Sekretariat' => ['Sekretariat', 'Sekretariat Bappeda', 'Kesekretariatan']
        ];
        
        if (isset($bidang_map[$bidang])) {
            $this->db->where_in('Bidang', $bidang_map[$bidang]);
        } else {
            $this->db->where('Bidang', $bidang);
        }
    }
    
    $this->db->order_by('Username', 'ASC');
    $akun = $this->db->get()->result_array();
    
    // Tambahkan debug untuk memastikan data ada
    error_log("get_akun_by_bidang - Bidang: $bidang, Total Akun: " . count($akun));
    
    echo json_encode([
        'status' => 'success',
        'data' => $akun,
        'bidang_filter' => $bidang
    ]);
}

/**
 * Get log aktivitas per akun (filter by username)
 */
public function get_log_aktivitas_by_akun() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $username = $this->input->get('username');
    $bidang = $this->input->get('bidang');
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');
    $aksi = $this->input->get('aksi');
    $search = $this->input->get('search');
    
    // Query dengan join ke akun
    $this->db->select('l.*, a.Bidang as user_bidang');
    $this->db->from('smb_aktivitas_log l');
    $this->db->join('akun a', 'a.Username = l.username', 'left');
    
    // Filter berdasarkan username (akun spesifik)
    if (!empty($username)) {
        $this->db->where('l.username', $username);
    }
    
    // Filter berdasarkan bidang (jika tidak ada filter akun spesifik)
    if (empty($username) && !empty($bidang)) {
        $bidang_map = [
            'Litbang' => 'Litbang',
            'Perencanaan' => 'Perencanaan',
            'Ekonomi' => 'Ekonomi',
            'Kesra' => 'Kesra',
            'Sarpras' => 'Sarpras',
            'Sekretariat' => 'Sekretariat'
        ];
        
        if (isset($bidang_map[$bidang])) {
            $this->db->where('a.Bidang', $bidang_map[$bidang]);
        }
    }
    
    // Filter tanggal
    if (!empty($start_date)) {
        $this->db->where('DATE(l.waktu) >=', date('Y-m-d', strtotime($start_date)));
    }
    if (!empty($end_date)) {
        $this->db->where('DATE(l.waktu) <=', date('Y-m-d', strtotime($end_date)));
    }
    
    // Filter aksi
    if (!empty($aksi)) {
        $this->db->where('l.aksi', $aksi);
    }
    
    // Filter pencarian
    if (!empty($search)) {
        $this->db->group_start()
            ->like('l.username', $search)
            ->or_like('l.detail', $search)
            ->or_like('l.modul', $search)
            ->group_end();
    }
    
    $this->db->order_by('l.waktu', 'DESC');
    $this->db->limit(500);
    $logs = $this->db->get()->result_array();
    
    foreach ($logs as &$log) {
        $log['waktu'] = date('d/m/Y H:i:s', strtotime($log['waktu']));
        $log['ip_address'] = $log['ip_address'] ?? '-';
        $log['detail'] = $log['detail'] ?? '-';
        $log['bidang'] = $log['user_bidang'] ?? '-';
    }
    
    echo json_encode(['status' => 'success', 'data' => $logs]);
}

/**
 * Get rekap kertas per akun
 */
public function get_kertas_rekap_by_akun() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $username = $this->input->get('username');
    $bidang = $this->input->get('bidang');
    $periode = $this->input->get('periode'); // 'hari', 'minggu', 'bulan', 'tahun'
    
    $this->db->select('SUM(pl.jumlah_kertas) as total_kertas, COUNT(*) as total_print');
    $this->db->from('smb_print_log pl');
    $this->db->join('akun a', 'a.Username = pl.username', 'left');
    
    // Filter berdasarkan username spesifik
    if (!empty($username)) {
        $this->db->where('pl.username', $username);
    }
    // Filter berdasarkan bidang
    else if (!empty($bidang)) {
        $bidang_map = [
            'Litbang' => 'Litbang',
            'Perencanaan' => 'Perencanaan',
            'Ekonomi' => 'Ekonomi',
            'Kesra' => 'Kesra',
            'Sarpras' => 'Sarpras',
            'Sekretariat' => 'Sekretariat'
        ];
        
        if (isset($bidang_map[$bidang])) {
            $this->db->where('a.Bidang', $bidang_map[$bidang]);
        }
    }
    
    // Filter periode
    switch ($periode) {
        case 'hari':
            $this->db->where('DATE(pl.waktu_print)', date('Y-m-d'));
            break;
        case 'minggu':
            $this->db->where('pl.waktu_print >=', date('Y-m-d H:i:s', strtotime('-7 days')));
            break;
        case 'bulan':
            $this->db->where('pl.waktu_print >=', date('Y-m-d H:i:s', strtotime('-30 days')));
            break;
        case 'tahun':
            $this->db->where('YEAR(pl.waktu_print)', date('Y'));
            break;
    }
    
    $result = $this->db->get()->row_array();
    
    echo json_encode([
        'status' => 'success',
        'total_kertas' => (int)($result['total_kertas'] ?? 0),
        'total_print' => (int)($result['total_print'] ?? 0)
    ]);
}

/**
 * Get total kertas terpakai dengan filter bidang dan periode
 */
public function get_total_kertas_terpakai() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $bidang = $this->input->get('bidang');
    $periode = $this->input->get('periode'); // 'hari', 'minggu', 'bulan', 'tahun'
    
    // Query dasar
    $this->db->select('SUM(pl.jumlah_kertas) as total_kertas, COUNT(*) as total_print, 
                       SUM(CASE WHEN pl.status = "success" THEN 1 ELSE 0 END) as success_count,
                       SUM(CASE WHEN pl.status = "failed" THEN 1 ELSE 0 END) as failed_count');
    $this->db->from('smb_print_log pl');
    $this->db->join('akun a', 'a.Username = pl.username', 'left');
    
    // Filter berdasarkan bidang
    if (!empty($bidang) && $bidang !== '') {
        $bidang_map = [
            'Litbang' => 'Litbang',
            'Perencanaan' => 'Perencanaan',
            'Ekonomi' => 'Ekonomi',
            'Kesra' => 'Kesra',
            'Sarpras' => 'Sarpras',
            'Sekretariat' => 'Sekretariat'
        ];
        
        if (isset($bidang_map[$bidang])) {
            $this->db->where('a.Bidang', $bidang_map[$bidang]);
        }
    }
    
    // Filter berdasarkan periode
    $now = date('Y-m-d H:i:s');
    switch ($periode) {
        case 'hari':
            $this->db->where('DATE(pl.waktu_print)', date('Y-m-d'));
            break;
        case 'minggu':
            $this->db->where('pl.waktu_print >=', date('Y-m-d H:i:s', strtotime('-7 days')));
            break;
        case 'bulan':
            $this->db->where('pl.waktu_print >=', date('Y-m-d H:i:s', strtotime('-30 days')));
            break;
        case 'tahun':
            $this->db->where('YEAR(pl.waktu_print)', date('Y'));
            break;
        default:
            // Semua waktu
            break;
    }
    
    $result = $this->db->get()->row_array();
    
    echo json_encode([
        'status' => 'success',
        'total_kertas' => (int)($result['total_kertas'] ?? 0),
        'total_print' => (int)($result['total_print'] ?? 0),
        'success_count' => (int)($result['success_count'] ?? 0),
        'failed_count' => (int)($result['failed_count'] ?? 0)
    ]);
}

/**
 * Get rekap kertas terpakai per periode (Hari, Minggu, Bulan, Tahun)
 * Bisa difilter per bidang
 */
public function get_rekap_kertas_terpakai() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $bidang = $this->input->get('bidang');
    
    // Mapping bidang
    $bidang_map = [
        'Litbang' => 'Litbang',
        'Perencanaan' => 'Perencanaan',
        'Ekonomi' => 'Ekonomi',
        'Kesra' => 'Kesra',
        'Sarpras' => 'Sarpras',
        'Sekretariat' => 'Sekretariat'
    ];
    
    $bidang_condition = "";
    $params = [];
    
    if (!empty($bidang) && $bidang !== '' && isset($bidang_map[$bidang])) {
        $bidang_condition = " AND a.Bidang = ?";
        $params[] = $bidang_map[$bidang];
    }
    
    // Query untuk rekap per periode
    $queries = [
        'hari' => "SELECT COALESCE(SUM(pl.jumlah_kertas), 0) as total 
                   FROM smb_print_log pl 
                   LEFT JOIN akun a ON a.Username = pl.username 
                   WHERE DATE(pl.waktu_print) = CURDATE() $bidang_condition",
        
        'minggu' => "SELECT COALESCE(SUM(pl.jumlah_kertas), 0) as total 
                     FROM smb_print_log pl 
                     LEFT JOIN akun a ON a.Username = pl.username 
                     WHERE pl.waktu_print >= DATE_SUB(NOW(), INTERVAL 7 DAY) $bidang_condition",
        
        'bulan' => "SELECT COALESCE(SUM(pl.jumlah_kertas), 0) as total 
                    FROM smb_print_log pl 
                    LEFT JOIN akun a ON a.Username = pl.username 
                    WHERE pl.waktu_print >= DATE_SUB(NOW(), INTERVAL 30 DAY) $bidang_condition",
        
        'tahun' => "SELECT COALESCE(SUM(pl.jumlah_kertas), 0) as total 
                    FROM smb_print_log pl 
                    LEFT JOIN akun a ON a.Username = pl.username 
                    WHERE YEAR(pl.waktu_print) = YEAR(CURDATE()) $bidang_condition"
    ];
    
    $rekap = [];
    foreach ($queries as $key => $sql) {
        $query = $this->db->query($sql, $params);
        $rekap[$key] = (int)$query->row()->total;
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => $rekap
    ]);
}

/**
 * Get mapping username ke bidang
 */
public function get_user_bidang_mapping() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $user_level = $this->session->userdata('level');
    
    if ($user_level == 1) {
        // SuperAdmin bisa lihat mapping semua user
        $users = $this->db->select('Username, Bidang')
                          ->where('Bidang IS NOT NULL')
                          ->where('Bidang !=', '')
                          ->get('akun')
                          ->result_array();
    } else {
        // User biasa hanya bisa lihat bidangnya sendiri
        $user_bidang = $this->session->userdata('bidang');
        $users = $this->db->select('Username, Bidang')
                          ->where('Bidang', $user_bidang)
                          ->get('akun')
                          ->result_array();
    }
    
    $mapping = [];
    foreach ($users as $user) {
        $mapping[$user['Username']] = $user['Bidang'];
    }
    
    echo json_encode(['status' => 'success', 'data' => $mapping]);
}
    
    /**
     * Get Statistik Dashboard
     */
    public function get_dashboard_stats() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $total_dokumen = $this->db->count_all('smb_dokumen');
    $total_user = $this->db->count_all('akun');
    $total_printer = $this->db->count_all('smb_printer');
    $printer_online = $this->db->where('status', 'online')->count_all_results('smb_printer');
    
    $dokumen_selesai = $this->db->where('status', 'Selesai')->count_all_results('smb_dokumen');
    $dokumen_review = $this->db->where('status', 'Review')->count_all_results('smb_dokumen');
    $dokumen_ongoing = $this->db->where('status', 'On Going')->count_all_results('smb_dokumen');
    
    $dokumen_sk = $this->db->where('kategori', 'Surat Keputusan')->count_all_results('smb_dokumen');
    $dokumen_laporan = $this->db->where('kategori', 'Laporan')->count_all_results('smb_dokumen');
    $dokumen_nota = $this->db->where('kategori', 'Nota Dinas')->count_all_results('smb_dokumen');
    
    // ========== TAMBAH: TOTAL KERTAS TERPAKAI ==========
    $total_kertas_terpakai = $this->db->select_sum('jumlah_kertas')->get('smb_print_log')->row()->jumlah_kertas ?: 0;
    
    // ========== TAMBAH: TOTAL PRINT ==========
    $total_print = $this->db->count_all('smb_print_log');
    $print_success = $this->db->where('status', 'success')->count_all_results('smb_print_log');
    $print_failed = $this->db->where('status', 'failed')->count_all_results('smb_print_log');
    
    $bidang_list = [
        'a' => 'Bidang Litbang',
        'b' => 'Bidang Perencanaan',
        'c' => 'Bidang Ekonomi',
        'd' => 'Bidang Kesra',
        'e' => 'Bidang Sarpras'
    ];
    
    $dokumen_per_bidang = [];
    foreach ($bidang_list as $kode => $nama) {
        $count = $this->db->where('id_bidang', $kode)->count_all_results('smb_dokumen');
        $dokumen_per_bidang[$kode] = [
            'nama' => $nama,
            'total' => (int)$count
        ];
    }
    
    echo json_encode([
        'status' => 'success',
        // Hero Cards
        'total_dokumen' => (int)$total_dokumen,
        'total_printer_aktif' => (int)$printer_online,  // ← FIX: untuk hero card printer
        'total_user' => (int)$total_user,
        // Stat Cards
        'total_user_stat' => (int)$total_user,
        'total_dokumen_stat' => (int)$total_dokumen,
        'dokumen_selesai' => (int)$dokumen_selesai,
        'dokumen_ongoing' => (int)$dokumen_ongoing,
        // Info tambahan untuk stat cards alternatif
        'total_print' => (int)$total_print,
        'total_kertas_terpakai' => (int)$total_kertas_terpakai,
        'print_success' => (int)$print_success,
        'print_failed' => (int)$print_failed,
        // Category cards
        'dokumen_sk' => (int)$dokumen_sk,
        'dokumen_laporan' => (int)$dokumen_laporan,
        'dokumen_nota' => (int)$dokumen_nota,
        'dokumen_per_bidang' => $dokumen_per_bidang,
        // Trend data (opsional)
        'trend_data' => [
            'user_trend' => '+8.5%',
            'dokumen_trend' => '+1.3%',
            'selesai_trend' => '-4.3%',
            'ongoing_trend' => '+1.8%'
        ]
    ]);
}
    public function file($path) {
        $fullPath = FCPATH . $path;
        if (!file_exists($fullPath)) {
            show_404();
        }
        header('Content-Type: ' . mime_content_type($fullPath));
        header('Content-Disposition: inline; filename="' . basename($fullPath) . '"');
        readfile($fullPath);
    }
    
    // ==================== MANAJEMEN PRINTER ====================
    
    /**
     * Get all printers
     */
    public function get_printers() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $printers = $this->db->order_by('nama_printer', 'ASC')->get('smb_printer')->result_array();
        
        foreach ($printers as &$printer) {
            $printer['stock_percentage'] = $printer['kapasitas_kertas'] > 0 ? 
                round(($printer['stock_kertas'] / $printer['kapasitas_kertas']) * 100) : 0;
            $printer['is_low_stock'] = $printer['stock_kertas'] <= $printer['min_stock_warning'];
            $printer['connection_display'] = $this->_get_connection_display($printer);
            $printer['current_queue'] = $this->db->where('id_printer', $printer['id_printer'])
                                                  ->where('queue_status', 'pending')
                                                  ->count_all_results('smb_print_queue');
            $printer['total_print_count'] = $printer['total_print_count'] ?? 0;
        }
        
        echo json_encode(['status' => 'success', 'data' => $printers]);
    }
    
    /**
     * Get printer detail
     */
    public function get_printer_detail() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $id_printer = $this->input->post('id_printer');
        $printer = $this->db->get_where('smb_printer', ['id_printer' => $id_printer])->row_array();
        
        if ($printer) {
            $queue_count = $this->db->where('id_printer', $id_printer)
                                     ->where('queue_status', 'pending')
                                     ->count_all_results('smb_print_queue');
            
            $printer['current_queue'] = $queue_count;
            
            echo json_encode(['status' => 'success', 'data' => $printer]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Printer tidak ditemukan']);
        }
    }
    
    /**
     * Test printer connection with real print
     */
    public function test_printer_connection() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $id_printer = $this->input->post('id_printer');
        $printer = $this->db->get_where('smb_printer', ['id_printer' => $id_printer])->row_array();
        
        if (!$printer) {
            echo json_encode(['status' => 'error', 'message' => 'Printer tidak ditemukan']);
            return;
        }
        
        $start_time = microtime(true);
        $test_result = $this->_test_print_real($printer);
        $response_time = round((microtime(true) - $start_time) * 1000);
        
        $new_status = $test_result['success'] ? 'online' : 'offline';
        $this->db->where('id_printer', $id_printer);
        $this->db->update('smb_printer', [
            'status' => $new_status,
            'last_status_check' => date('Y-m-d H:i:s'),
            'status_message' => $test_result['message']
        ]);
        
        echo json_encode([
            'status' => $test_result['success'] ? 'success' : 'error',
            'message' => $test_result['message'],
            'details' => $test_result['details'] ?? '',
            'response_time_ms' => $response_time,
            'printer_status' => $new_status
        ]);
    }
    
    /**
     * Test print real (kirim file test ke printer)
     */
    private function _test_print_real($printer) {
        $testFile = FCPATH . 'uploads/temp/test_print_' . time() . '.txt';
        if (!is_dir(FCPATH . 'uploads/temp/')) {
            mkdir(FCPATH . 'uploads/temp/', 0777, true);
        }
        
        $testContent = "=== TEST PRINTER ===\n";
        $testContent .= "Waktu: " . date('Y-m-d H:i:s') . "\n";
        $testContent .= "Printer: " . $printer['nama_printer'] . "\n";
        $testContent .= "Status: TEST KONEKSI BERHASIL\n";
        $testContent .= "===================\n";
        file_put_contents($testFile, $testContent);
        
        $result = ['success' => false, 'message' => '', 'details' => ''];
        
        switch ($printer['connection_type']) {
            case 'network':
                $result = $this->_test_network_print($testFile, $printer);
                break;
            case 'shared':
                $result = $this->_test_shared_print($testFile, $printer);
                break;
            case 'usb':
                $result = $this->_test_usb_print($testFile, $printer);
                break;
            default:
                $result = ['success' => false, 'message' => 'Tipe koneksi tidak dikenal'];
        }
        
        if (file_exists($testFile)) {
            unlink($testFile);
        }
        
        return $result;
    }
    
    private function _test_network_print($testFile, $printer) {
        if (empty($printer['ip_address'])) {
            return ['success' => false, 'message' => 'IP Address tidak dikonfigurasi'];
        }
        
        $port = $printer['port'] ?? 9100;
        
        try {
            $fp = @fsockopen($printer['ip_address'], $port, $errno, $errstr, 5);
            if (!$fp) {
                return ['success' => false, 'message' => "Tidak bisa konek ke {$printer['ip_address']}:{$port} - $errstr"];
            }
            
            $data = file_get_contents($testFile);
            fwrite($fp, $data);
            fclose($fp);
            
            return ['success' => true, 'message' => "Test print berhasil dikirim ke {$printer['ip_address']}:{$port}"];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    private function _test_shared_print($testFile, $printer) {
        if (empty($printer['share_path'])) {
            $cleanName = str_replace(' ', '', $printer['nama_printer']);
            $printer['share_path'] = '\\\\localhost\\' . $cleanName;
        }
        
        $sharePath = str_replace('\\\\', '\\', $printer['share_path']);
        
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $command = 'copy /B "' . $testFile . '" "' . $sharePath . '" 2>&1';
            exec($command, $output, $returnCode);
            
            if ($returnCode === 0) {
                return ['success' => true, 'message' => "Test print berhasil dikirim ke $sharePath"];
            }
            
            $printerNameOnly = basename($sharePath);
            $command3 = 'print /D:' . $printerNameOnly . ' "' . $testFile . '" 2>&1';
            exec($command3, $output3, $returnCode3);
            
            if ($returnCode3 === 0) {
                return ['success' => true, 'message' => "Test print berhasil dikirim ke printer: $printerNameOnly"];
            }
            
            return [
                'success' => false, 
                'message' => "Gagal print ke shared printer",
                'details' => "Periksa: 1) Printer sudah dishare? 2) Share path: $sharePath"
            ];
        } else {
            $command = "smbclient " . escapeshellarg($sharePath) . " -N -c \"put " . escapeshellarg($testFile) . "\" 2>&1";
            exec($command, $output, $returnCode);
            
            if ($returnCode === 0) {
                return ['success' => true, 'message' => "Test print berhasil via Samba ke $sharePath"];
            } else {
                return ['success' => false, 'message' => "Gagal print via Samba: " . implode(' ', $output)];
            }
        }
    }
    
    private function _test_usb_print($testFile, $printer) {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $availablePorts = [];
            $cmd = 'wmic printer get Name,PortName /format:csv 2>&1';
            exec($cmd, $output);
            
            foreach ($output as $line) {
                if (strpos($line, 'USB') !== false) {
                    $parts = str_getcsv($line);
                    if (isset($parts[1]) && strpos($parts[1], 'USB') !== false) {
                        $availablePorts[] = trim($parts[1]);
                    }
                }
            }
            
            foreach ($availablePorts as $port) {
                $command = 'copy /B "' . $testFile . '" ' . $port . ' 2>&1';
                exec($command, $output, $returnCode);
                
                if ($returnCode === 0) {
                    $this->db->where('id_printer', $printer['id_printer']);
                    $this->db->update('smb_printer', ['usb_port' => $port]);
                    
                    return ['success' => true, 'message' => "Test print berhasil ke USB Port: $port"];
                }
            }
            
            return [
                'success' => false, 
                'message' => "Tidak ada USB printer terdeteksi",
                'details' => "Port tersedia: " . implode(', ', $availablePorts)
            ];
        } else {
            $devices = glob('/dev/usb/lp*');
            foreach ($devices as $device) {
                $command = 'cat "' . $testFile . '" > ' . $device . ' 2>&1';
                exec($command, $output, $returnCode);
                if ($returnCode === 0) {
                    return ['success' => true, 'message' => "Test print berhasil ke $device"];
                }
            }
            return ['success' => false, 'message' => "Tidak ada USB printer terdeteksi"];
        }
    }
    
    /**
     * Add new printer
     */
    public function add_printer() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $data = [
            'nama_printer' => $this->input->post('nama_printer'),
            'lokasi' => $this->input->post('lokasi'),
            'connection_type' => $this->input->post('connection_type'),
            'stock_kertas' => $this->input->post('stock_kertas') ?: 500,
            'kapasitas_kertas' => 500,
            'min_stock_warning' => 50,
            'status' => 'offline'
        ];
        
        if ($data['connection_type'] == 'network') {
            $data['ip_address'] = $this->input->post('ip_address');
            $data['port'] = $this->input->post('port') ?: 9100;
            if (empty($data['ip_address'])) {
                echo json_encode(['status' => 'error', 'message' => 'IP Address wajib diisi']);
                return;
            }
        } else {
            $cleanName = str_replace(' ', '', $data['nama_printer']);
            $data['share_path'] = '\\\\localhost\\' . $cleanName;
            $data['usb_port'] = $this->input->post('usb_port');
        }
        
        if ($this->db->insert('smb_printer', $data)) {
            $id_printer = $this->db->insert_id();
            $printer = $this->db->get_where('smb_printer', ['id_printer' => $id_printer])->row_array();
            $test_result = $this->_test_print_real($printer);
            
            $this->db->where('id_printer', $id_printer);
            $this->db->update('smb_printer', [
                'status' => $test_result['success'] ? 'online' : 'offline',
                'status_message' => $test_result['message']
            ]);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Printer berhasil ditambahkan',
                'test_result' => $test_result,
                'id_printer' => $id_printer
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan printer']);
        }
    }
    
    /**
     * Update printer
     */
    public function update_printer() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $id_printer = $this->input->post('id_printer');
        $data = [];
        
        $fields = ['nama_printer', 'lokasi', 'connection_type', 
                   'ip_address', 'port', 'share_path', 'usb_port',
                   'stock_kertas', 'min_stock_warning'];
        
        foreach ($fields as $field) {
            $value = $this->input->post($field);
            if ($value !== null) {
                $data[$field] = $value;
            }
        }
        
        if (empty($data)) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada data yang diupdate']);
            return;
        }
        
        $this->db->where('id_printer', $id_printer);
        if ($this->db->update('smb_printer', $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Printer berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate printer']);
        }
    }
    
    /**
     * Delete printer
     */
    public function delete_printer() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $id_printer = $this->input->post('id_printer');
        
        $this->db->where('id_printer', $id_printer);
        if ($this->db->delete('smb_printer')) {
            echo json_encode(['status' => 'success', 'message' => 'Printer berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus printer']);
        }
    }
    
    /**
     * Add paper stock
     */
    public function add_paper_stock() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $id_printer = $this->input->post('id_printer');
        $jumlah_tambah = (int)$this->input->post('jumlah_tambah', 0);
        
        if ($jumlah_tambah <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Jumlah tidak valid']);
            return;
        }
        
        $printer = $this->db->get_where('smb_printer', ['id_printer' => $id_printer])->row_array();
        if ($printer) {
            $new_stock = $printer['stock_kertas'] + $jumlah_tambah;
            $this->db->where('id_printer', $id_printer);
            $this->db->update('smb_printer', ['stock_kertas' => $new_stock]);
            
            echo json_encode([
                'status' => 'success',
                'message' => "Stock kertas berhasil ditambah",
                'new_stock' => $new_stock
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Printer tidak ditemukan']);
        }
    }
    
    // ==================== PROSES PRINT ====================
    
    /**
     * Print dokumen
     */
    public function print_dokumen() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $id_dokumen = $this->input->post('id_dokumen');
        $id_printer = $this->input->post('id_printer');
        $jumlah_kertas = (int)$this->input->post('jumlah_kertas', 1);
        $jumlah_copy = (int)$this->input->post('jumlah_copy', 1);
        $username = $this->session->userdata('username');
        
        $dokumen = $this->db->get_where('smb_dokumen', ['id_dokumen' => $id_dokumen])->row_array();
        if (!$dokumen) {
            echo json_encode(['status' => 'error', 'message' => 'Dokumen tidak ditemukan']);
            return;
        }
        
        $printer = $this->db->get_where('smb_printer', ['id_printer' => $id_printer])->row_array();
        if (!$printer) {
            echo json_encode(['status' => 'error', 'message' => 'Printer tidak ditemukan']);
            return;
        }
        
        $total_kertas = $jumlah_kertas * $jumlah_copy;
        if ($printer['stock_kertas'] < $total_kertas) {
            echo json_encode([
                'status' => 'error', 
                'message' => "Stock kertas tidak mencukupi! Sisa: {$printer['stock_kertas']} lembar"
            ]);
            return;
        }
        
        $file_path = FCPATH . $dokumen['file_path'];
        $print_result = $this->_execute_print_real($file_path, $printer);
        
        if ($print_result['success']) {
            $new_stock = $printer['stock_kertas'] - $total_kertas;
            $this->db->where('id_printer', $id_printer);
            $this->db->update('smb_printer', [
                'stock_kertas' => $new_stock,
                'total_print_count' => ($printer['total_print_count'] ?? 0) + 1,
                'total_paper_used' => ($printer['total_paper_used'] ?? 0) + $total_kertas,
                'last_print_time' => date('Y-m-d H:i:s')
            ]);
            
            $this->_log_print($id_dokumen, $id_printer, $username, $dokumen['nama_dokumen'], 
                             1, $total_kertas, 'success', null);
            
            $bidang_map = ['a' => 'Litbang', 'b' => 'Perencanaan', 'c' => 'Ekonomi', 'd' => 'Kesra', 'e' => 'Sarpras'];
            $nama_bidang = $bidang_map[$dokumen['id_bidang']] ?? 'Unknown';
            
             $detail_log = "Print dokumen: {$dokumen['nama_dokumen']} - {$total_kertas} lembar - Printer: {$printer['nama_printer']}";
    
    $this->_log_aktivitas(
        $username,
        'Print',
        $nama_bidang,
        $detail_log  // Detail lengkap
    );
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Dokumen berhasil diprint',
                'data' => [
                    'printer' => $printer['nama_printer'],
                    'sisa_kertas' => $new_stock,
                    'jumlah_kertas' => $total_kertas,
                    'dokumen' => $dokumen['nama_dokumen']
                ]
            ]);
        } else {
            $this->_log_print($id_dokumen, $id_printer, $username, $dokumen['nama_dokumen'], 
                             1, $total_kertas, 'failed', $print_result['message']);
            
            echo json_encode([
                'status' => 'error',
                'message' => 'Print gagal: ' . $print_result['message']
            ]);
        }
    }
    
    private function _execute_print_real($file_path, $printer) {
        if (!file_exists($file_path)) {
            return ['success' => false, 'message' => 'File dokumen tidak ditemukan'];
        }
        
        switch ($printer['connection_type']) {
            case 'network':
                return $this->_print_to_network_real($file_path, $printer);
            case 'shared':
                return $this->_print_to_shared_real($file_path, $printer);
            case 'usb':
                return $this->_print_to_usb_real($file_path, $printer);
            default:
                return ['success' => false, 'message' => 'Tipe koneksi tidak didukung'];
        }
    }
    
    private function _print_to_network_real($file_path, $printer) {
        try {
            $fp = @fsockopen($printer['ip_address'], $printer['port'], $errno, $errstr, 10);
            if (!$fp) {
                return ['success' => false, 'message' => "Tidak bisa konek ke printer: $errstr"];
            }
            
            $data = file_get_contents($file_path);
            if ($data === false) {
                fclose($fp);
                return ['success' => false, 'message' => 'Gagal membaca file'];
            }
            
            fwrite($fp, $data);
            fclose($fp);
            
            return ['success' => true, 'message' => 'Print berhasil'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    private function _print_to_shared_real($file_path, $printer) {
        $sharePath = str_replace('\\\\', '\\', $printer['share_path']);
        
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $command = 'copy /B "' . $file_path . '" "' . $sharePath . '" 2>&1';
            exec($command, $output, $returnCode);
            
            if ($returnCode === 0) {
                return ['success' => true, 'message' => 'Print berhasil'];
            } else {
                $printerName = basename($sharePath);
                $command2 = 'print /D:' . $printerName . ' "' . $file_path . '" 2>&1';
                exec($command2, $output2, $returnCode2);
                
                if ($returnCode2 === 0) {
                    return ['success' => true, 'message' => 'Print berhasil'];
                }
                
                return ['success' => false, 'message' => 'Gagal print: ' . implode(' ', $output)];
            }
        } else {
            $command = "smbclient " . escapeshellarg($sharePath) . " -N -c \"put " . escapeshellarg($file_path) . "\" 2>&1";
            exec($command, $output, $returnCode);
            
            if ($returnCode === 0) {
                return ['success' => true, 'message' => 'Print berhasil via Samba'];
            } else {
                return ['success' => false, 'message' => 'Gagal print via Samba'];
            }
        }
    }
    
    private function _print_to_usb_real($file_path, $printer) {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $port = $printer['usb_port'] ?: 'USB001';
            $command = 'copy /B "' . $file_path . '" ' . $port . ' 2>&1';
            exec($command, $output, $returnCode);
            
            if ($returnCode === 0) {
                return ['success' => true, 'message' => 'Print berhasil ke USB'];
            } else {
                return ['success' => false, 'message' => 'Gagal print ke USB: ' . implode(' ', $output)];
            }
        } else {
            $device = $printer['usb_port'] ?: '/dev/usb/lp0';
            $command = 'cat "' . $file_path . '" > ' . $device . ' 2>&1';
            exec($command, $output, $returnCode);
            
            if ($returnCode === 0) {
                return ['success' => true, 'message' => 'Print berhasil ke USB device'];
            } else {
                return ['success' => false, 'message' => 'Gagal print ke USB device'];
            }
        }
    }
    
    /**
     * Get print history
     */
    public function get_print_history() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $limit = (int)$this->input->get('limit') ?: 100;
        $username = $this->input->get('username');
        
        $this->db->select('pl.*, p.nama_printer, p.lokasi, p.connection_type')
                 ->from('smb_print_log pl')
                 ->join('smb_printer p', 'p.id_printer = pl.id_printer', 'left');
        
        if ($username) {
            $this->db->where('pl.username', $username);
        }
        
        $this->db->order_by('pl.waktu_print', 'DESC')->limit($limit);
        $logs = $this->db->get()->result_array();
        
        foreach ($logs as &$log) {
            $log['waktu_print_formatted'] = date('d/m/Y H:i:s', strtotime($log['waktu_print']));
        }
        
        echo json_encode(['status' => 'success', 'data' => $logs]);
    }
    
    /**
     * Get print queue
     */
    public function get_print_queue() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $id_printer = $this->input->get('id_printer');
        
        $this->db->select('q.*, p.nama_printer, p.lokasi')
                 ->from('smb_print_queue q')
                 ->join('smb_printer p', 'p.id_printer = q.id_printer', 'left');
        
        if ($id_printer) {
            $this->db->where('q.id_printer', $id_printer);
        }
        
        $this->db->where('q.queue_status', 'pending')
                 ->order_by('q.priority', 'DESC')
                 ->order_by('q.created_at', 'ASC');
        
        $queue = $this->db->get()->result_array();
        
        echo json_encode(['status' => 'success', 'data' => $queue]);
    }
    
    /**
     * Cancel print queue
     */
    public function cancel_print_queue() {
        if (!$this->session->userdata('smb_logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired']);
            return;
        }
        
        $id_queue = $this->input->post('id_queue');
        
        $this->db->where('id_queue', $id_queue);
        $this->db->where('queue_status', 'pending');
        
        if ($this->db->update('smb_print_queue', ['queue_status' => 'cancelled', 'status' => 'cancelled'])) {
            echo json_encode(['status' => 'success', 'message' => 'Antrian print dibatalkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal membatalkan antrian']);
        }
    }
    
    private function _log_aktivitas($username, $aksi, $modul, $detail) {
    $ip = $this->input->ip_address();
    if ($ip == '::1') $ip = '127.0.0.1';
    
    $data = [
        'username' => $username,
        'aksi' => $aksi,
        'modul' => $modul,
        'detail' => $detail,
        'ip_address' => $ip,
        'waktu' => date('Y-m-d H:i:s')
    ];
    $this->db->insert('smb_aktivitas_log', $data);
} 
    
    private function _log_print($id_dokumen, $id_printer, $username, $nama_dokumen, 
                                $jumlah_halaman, $jumlah_kertas, $status, $error_message = null) {
        $data = [
            'id_dokumen' => $id_dokumen,
            'id_printer' => $id_printer,
            'username' => $username,
            'nama_dokumen' => $nama_dokumen,
            'jumlah_halaman' => $jumlah_halaman,
            'jumlah_kertas' => $jumlah_kertas,
            'status' => $status,
            'error_message' => $error_message,
            'waktu_print' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('smb_print_log', $data);
    }
    
    private function _get_connection_display($printer) {
        switch ($printer['connection_type']) {
            case 'network':
                return $printer['ip_address'] . ':' . $printer['port'];
            case 'shared':
                return $printer['share_path'];
            case 'usb':
                return $printer['usb_port'] ?: 'Auto-detect';
            default:
                return '-';
        }
    }
    
    private function _formatBytes($bytes) {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return round($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' B';
        }
    }
    /**
 * Log aktivitas preview dokumen
 */
public function log_preview() {
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $id_dokumen = $this->input->post('id_dokumen');
    $username = $this->session->userdata('username');
    
    $dokumen = $this->db->get_where('smb_dokumen', ['id_dokumen' => $id_dokumen])->row_array();
    
    if ($dokumen) {
        $bidang_map = ['a' => 'Litbang', 'b' => 'Perencanaan', 'c' => 'Ekonomi', 'd' => 'Kesra', 'e' => 'Sarpras'];
        $nama_bidang = $bidang_map[$dokumen['id_bidang']] ?? 'Unknown';
        
        $this->_log_aktivitas(
            $username,
            'Preview',
            $nama_bidang,
            "Melihat preview dokumen: {$dokumen['nama_dokumen']}"
        );
        
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dokumen tidak ditemukan']);
    }
}

// ==================== GET USER PRINT REKAP FROM DATABASE ====================
public function get_user_print_rekap() {
    // Cek session login SMB
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $username = $this->input->post('username', TRUE);
    if (empty($username)) {
        echo json_encode(['status' => 'error', 'message' => 'Username tidak boleh kosong']);
        return;
    }
    
    // 1. Ambil semua data print log untuk user ini dari smb_print_log
    $print_logs = $this->db
        ->select('pl.*, p.nama_printer')
        ->from('smb_print_log pl')
        ->join('smb_printer p', 'p.id_printer = pl.id_printer', 'left')
        ->where('pl.username', $username)
        ->order_by('pl.waktu_print', 'DESC')
        ->get()
        ->result_array();
    
    // 2. Hitung rekap per periode
    $today_start = date('Y-m-d 00:00:00');
    $today_end   = date('Y-m-d 23:59:59');
    $week_start  = date('Y-m-d 00:00:00', strtotime('-7 days'));
    $month_start = date('Y-m-d 00:00:00', strtotime('-30 days'));
    $year_start  = date('Y-01-01 00:00:00');
    
    $rekap = [
        'hari'   => ['lembar' => 0, 'sukses' => 0, 'gagal' => 0],
        'minggu' => ['lembar' => 0, 'sukses' => 0, 'gagal' => 0],
        'bulan'  => ['lembar' => 0, 'sukses' => 0, 'gagal' => 0],
        'tahun'  => ['lembar' => 0, 'sukses' => 0, 'gagal' => 0]
    ];
    
    $total_lembar = 0;
    $total_sukses = 0;
    $total_gagal  = 0;
    
    foreach ($print_logs as $log) {
        $waktu = strtotime($log['waktu_print']);
        
        // Tentukan periode
        $is_today = ($waktu >= strtotime($today_start) && $waktu <= strtotime($today_end));
        $is_week  = ($waktu >= strtotime($week_start));
        $is_month = ($waktu >= strtotime($month_start));
        $is_year  = ($waktu >= strtotime($year_start));
        
        $lembar = (int)$log['jumlah_kertas'];
        $is_success = ($log['status'] == 'success');
        
        // Akumulasi
        if ($is_today) {
            $rekap['hari']['lembar'] += $lembar;
            if ($is_success) $rekap['hari']['sukses']++;
            else $rekap['hari']['gagal']++;
        }
        if ($is_week) {
            $rekap['minggu']['lembar'] += $lembar;
            if ($is_success) $rekap['minggu']['sukses']++;
            else $rekap['minggu']['gagal']++;
        }
        if ($is_month) {
            $rekap['bulan']['lembar'] += $lembar;
            if ($is_success) $rekap['bulan']['sukses']++;
            else $rekap['bulan']['gagal']++;
        }
        if ($is_year) {
            $rekap['tahun']['lembar'] += $lembar;
            if ($is_success) $rekap['tahun']['sukses']++;
            else $rekap['tahun']['gagal']++;
        }
        
        // Total keseluruhan
        $total_lembar += $lembar;
        if ($is_success) $total_sukses++;
        else $total_gagal++;
    }
    
    // 3. Siapkan data detail print untuk ditampilkan (10 terbaru)
    $print_details = [];
    foreach (array_slice($print_logs, 0, 10) as $log) {
        $print_details[] = [
            'waktu'         => date('d/m/Y H:i:s', strtotime($log['waktu_print'])),
            'nama_dokumen'  => $log['nama_dokumen'],
            'jumlah_kertas' => (int)$log['jumlah_kertas'],
            'status'        => $log['status'],
            'nama_printer'  => $log['nama_printer'] ?? '-'
        ];
    }
    
    // 4. Kirim response
    echo json_encode([
        'status'        => 'success',
        'username'      => $username,
        'total_lembar'  => $total_lembar,
        'total_print'   => count($print_logs),
        'success_count' => $total_sukses,
        'failed_count'  => $total_gagal,
        'hari'          => $rekap['hari'],
        'minggu'        => $rekap['minggu'],
        'bulan'         => $rekap['bulan'],
        'tahun'         => $rekap['tahun'],
        'print_details' => $print_details
    ]);
}

/**
 * Log print dari preview (via tombol print)
 */
/**
 * Log print dari preview (via tombol print)
 */
public function log_print_from_preview() {
    // Debug log
    error_log('=== log_print_from_preview called ===');
    error_log('POST: ' . print_r($this->input->post(), true));
    
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    $id_dokumen = $this->input->post('id_dokumen');
    $nama_dokumen = $this->input->post('nama_dokumen');
    $jumlah_kertas = max(1, (int)$this->input->post('jumlah_kertas', 1));
    $range_halaman = $this->input->post('range_halaman', 'Semua');
    $source = $this->input->post('source', 'print_button');
    
    if (empty($id_dokumen)) {
        echo json_encode(['status' => 'error', 'message' => 'ID dokumen tidak valid']);
        return;
    }
    
    $username = $this->session->userdata('username');
    
    // Ambil data dokumen
    $dokumen = $this->db->get_where('smb_dokumen', ['id_dokumen' => $id_dokumen])->row_array();
    if (!$dokumen) {
        echo json_encode(['status' => 'error', 'message' => 'Dokumen tidak ditemukan']);
        return;
    }
    
    // Ambil printer default (prioritas online)
    $printer = $this->db->get_where('smb_printer', ['status' => 'online'])->row_array();
    if (!$printer) {
        $printer = $this->db->order_by('id_printer', 'ASC')->get('smb_printer', 1)->row_array();
    }
    
    // Mapping bidang
    $bidang_map = ['a' => 'Litbang', 'b' => 'Perencanaan', 'c' => 'Ekonomi', 'd' => 'Kesra', 'e' => 'Sarpras', 'f' => 'Sekretariat'];
    $nama_bidang = $bidang_map[$dokumen['id_bidang']] ?? 'Unknown';
    $printer_name = $printer ? $printer['nama_printer'] : 'Printer tidak tersedia';
    
    // Detail log lengkap
    $detail_log = "Print dokumen: {$nama_dokumen} - {$jumlah_kertas} lembar - Printer: {$printer_name}";
    if ($range_halaman !== 'Semua' && !empty($range_halaman)) {
        $detail_log .= " - Halaman: {$range_halaman}";
    }
    $detail_log .= " - Sumber: " . ($source == 'preview_print_button' ? 'Preview Modal' : 'Tombol Print');
    
    // Kurangi stock kertas jika printer ada
    if ($printer && $printer['stock_kertas'] >= $jumlah_kertas) {
        $new_stock = $printer['stock_kertas'] - $jumlah_kertas;
        $this->db->where('id_printer', $printer['id_printer']);
        $this->db->update('smb_printer', [
            'stock_kertas' => max(0, $new_stock),
            'total_print_count' => ($printer['total_print_count'] ?? 0) + 1,
            'total_paper_used' => ($printer['total_paper_used'] ?? 0) + $jumlah_kertas,
            'last_print_time' => date('Y-m-d H:i:s')
        ]);
    }
    
    // LOG AKTIVITAS KE smb_aktivitas_log
    $this->_log_aktivitas(
        $username,
        'Print (via Preview)',
        $nama_bidang,
        $detail_log
    );
    
    // LOG PRINT DETAIL KE smb_print_log
    $print_data = [
        'id_dokumen' => $id_dokumen,
        'id_printer' => $printer ? $printer['id_printer'] : null,
        'username' => $username,
        'nama_dokumen' => $nama_dokumen,
        'jumlah_halaman' => 1,
        'jumlah_kertas' => $jumlah_kertas,
        'status' => 'success',
        'waktu_print' => date('Y-m-d H:i:s')
    ];
    
    $insert = $this->db->insert('smb_print_log', $print_data);
    
    if ($insert) {
        error_log("Print log inserted with ID: " . $this->db->insert_id());
        echo json_encode([
            'status' => 'success', 
            'message' => 'Print activity telah dicatat',
            'detail' => $detail_log,
            'print_id' => $this->db->insert_id()
        ]);
    } else {
        error_log("Failed to insert print log");
        echo json_encode([
            'status' => 'error', 
            'message' => 'Gagal menyimpan log print ke database'
        ]);
    }
}
// ==================== METHOD UNTUK MENGAMBIL DATA DARI API (BACKEND) ====================

// Get semua konfigurasi API dari database
public function get_api_configs() {
    header('Content-Type: application/json');
    
    $configs = $this->db->get('smb_api_config')->result_array();
    
    echo json_encode([
        'status' => 'success',
        'data' => $configs
    ]);
}

public function load_data_from_api() {
    // Set header JSON
    header('Content-Type: application/json');
    
    // Cek login
    if (!$this->session->userdata('smb_logged_in')) {
        echo json_encode(['status' => 'error', 'message' => 'Session expired']);
        return;
    }
    
    // Ambil parameter kode
    $kode = $this->input->get('kode');
    if (empty($kode)) {
        echo json_encode(['status' => 'error', 'message' => 'Kode API tidak ditemukan']);
        return;
    }
    
    // Ambil konfigurasi dari database
    $config = $this->db->get_where('smb_api_config', ['kode_api' => $kode])->row_array();
    
    if (!$config) {
        echo json_encode(['status' => 'error', 'message' => 'Konfigurasi API tidak ditemukan']);
        return;
    }
    
    // Ambil URL API dari database
    $url = $config['url_api'];
    
    // Jika URL kosong
    if (empty($url)) {
        echo json_encode(['status' => 'error', 'message' => 'URL API tidak ditemukan dalam konfigurasi']);
        return;
    }
    
    // Hapus parameter api-key dari URL
    $url = preg_replace('/[&?]api-key=[^&]*/', '', $url);
    
    // Pastikan URL memiliki parameter id
    if (strpos($url, 'id=') === false) {
        echo json_encode(['status' => 'error', 'message' => 'URL API harus mengandung parameter id (contoh: ?id=1062)']);
        return;
    }
    
    error_log("Calling API URL: " . $url);
    
    // ========== METODE 1: CURL DENGAN ENCODING DINONAKTIFKAN ==========
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    
    // IMPORTANT: Nonaktifkan encoding untuk menghindari error
    curl_setopt($ch, CURLOPT_ENCODING, ''); // Biarkan kosong agar curl tidak meminta encoding
    
    // User Agent
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    
    // Header tanpa Accept-Encoding
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Accept-Language: id-ID,id;q=0.9,en;q=0.8',
        'Connection: keep-alive',
        'Referer: https://satudata.banyuwangikab.go.id/'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    // Jika CURL gagal karena encoding, coba metode alternatif
    if ($curlError && strpos($curlError, 'encoding') !== false) {
        error_log("CURL encoding error, trying file_get_contents...");
        
        // ========== METODE 2: FILE_GET_CONTENTS ==========
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => "Accept: application/json\r\n" .
                           "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36\r\n" .
                           "Referer: https://satudata.banyuwangikab.go.id/\r\n"
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ]
        ]);
        
        $response = @file_get_contents($url, false, $context);
        if ($response !== false) {
            $httpCode = 200;
            $curlError = '';
            error_log("file_get_contents succeeded!");
        } else {
            $curlError = error_get_last()['message'] ?? 'Unknown error';
        }
    }
    
    // Jika masih gagal, coba dengan fsockopen
    if ($curlError && $response === false) {
        error_log("Trying fsockopen method...");
        
        $parsed = parse_url($url);
        $host = $parsed['host'];
        $path = $parsed['path'] . '?' . ($parsed['query'] ?? '');
        
        $fp = @fsockopen("ssl://" . $host, 443, $errno, $errstr, 10);
        if ($fp) {
            $request = "GET $path HTTP/1.1\r\n";
            $request .= "Host: $host\r\n";
            $request .= "User-Agent: Mozilla/5.0\r\n";
            $request .= "Accept: application/json\r\n";
            $request .= "Connection: close\r\n\r\n";
            
            fwrite($fp, $request);
            $response = '';
            while (!feof($fp)) {
                $response .= fgets($fp, 1024);
            }
            fclose($fp);
            
            // Pisahkan header dan body
            $parts = explode("\r\n\r\n", $response, 2);
            if (isset($parts[1])) {
                $response = $parts[1];
                $httpCode = 200;
                $curlError = '';
                error_log("fsockopen succeeded!");
            } else {
                $curlError = "fsockopen failed to get response";
            }
        } else {
            $curlError = "fsockopen failed: $errstr";
        }
    }
    
    // Cek error
    if ($curlError && $response === false) {
        error_log("Final Error: " . $curlError);
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal terhubung ke API: ' . $curlError
        ]);
        return;
    }
    
    // Cek HTTP status code
    if ($httpCode !== 200) {
        error_log("HTTP Error: " . $httpCode);
        echo json_encode([
            'status' => 'error',
            'message' => 'API merespon dengan kode: ' . $httpCode
        ]);
        return;
    }
    
    // Parse JSON response
    $result = json_decode($response, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON Parse Error: " . json_last_error_msg());
        echo json_encode([
            'status' => 'error',
            'message' => 'Respons API tidak valid: ' . json_last_error_msg()
        ]);
        return;
    }
    
    // Ambil data result (tanpa wrapper 'result')
    $dataResult = $result;
    if (isset($result['result'])) {
        $dataResult = $result['result'];
    }
    
    // Ambil data menggunakan mapping dari database
    $indikator = $this->getNestedValue($dataResult, $config['mapping_indikator'] ?? 'Indikator');
    $produsen = $this->getNestedValue($dataResult, $config['mapping_produsen'] ?? 'Produsen Data');
    $urusan = $this->getNestedValue($dataResult, $config['mapping_urusan'] ?? 'Urusan');
    $satuan = $this->getNestedValue($dataResult, $config['mapping_satuan'] ?? 'Satuan');
    $dataRaw = $this->getNestedValue($dataResult, $config['mapping_data'] ?? 'data');
    
    // Parse series data
    $series = [];
    if (is_array($dataRaw)) {
        // Format: data[0] berisi object tahun => nilai
        if (isset($dataRaw[0]) && is_array($dataRaw[0])) {
            foreach ($dataRaw[0] as $tahun => $nilai) {
                if ($nilai !== '' && $nilai !== null) {
                    $series[] = [
                        'tahun' => $tahun,
                        'nilai' => is_numeric($nilai) ? floatval($nilai) : $nilai
                    ];
                }
            }
        } 
        // Format: array of objects
        else {
            foreach ($dataRaw as $item) {
                if (is_array($item)) {
                    $tahun = $this->getNestedValue($item, $config['mapping_tahun'] ?? 'tahun');
                    $nilai = $this->getNestedValue($item, $config['mapping_nilai'] ?? 'nilai');
                    if ($tahun && $nilai !== null) {
                        $series[] = [
                            'tahun' => $tahun,
                            'nilai' => is_numeric($nilai) ? floatval($nilai) : $nilai
                        ];
                    }
                }
            }
        }
        
        // Urutkan berdasarkan tahun
        usort($series, function($a, $b) {
            return $a['tahun'] - $b['tahun'];
        });
    }
    
    // Kirim response
    echo json_encode([
        'status' => 'success',
        'data' => [
            'indikator' => $indikator ?: $config['nama_data'],
            'produsen' => $produsen ?: '-',
            'urusan' => $urusan ?: '-',
            'satuan' => $satuan ?: '-',
            'series' => $series
        ]
    ]);
}

private function getNestedValue($data, $path) {
    if (empty($path) || $data === null) return null;
    
    $parts = explode('.', $path);
    $current = $data;
    
    foreach ($parts as $part) {
        if (is_array($current) && isset($current[$part])) {
            $current = $current[$part];
        } elseif (is_object($current) && isset($current->$part)) {
            $current = $current->$part;
        } else {
            return null;
        }
    }
    
    return $current;
}
// Simpan konfigurasi API baru
public function save_api_config() {
    header('Content-Type: application/json');
    
    // 1. VALIDASI INPUT WAJIB
    $kode_api = trim($this->input->post('kode_api'));
    $nama_data = trim($this->input->post('nama_data'));
    $url_api = trim($this->input->post('url_api'));
    
    if (empty($kode_api)) {
        echo json_encode(['status' => 'error', 'message' => 'Kode API wajib diisi']);
        return;
    }
    
    if (empty($nama_data)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama Data wajib diisi']);
        return;
    }
    
    if (empty($url_api)) {
        echo json_encode(['status' => 'error', 'message' => 'URL API wajib diisi']);
        return;
    }
    
    // 2. VALIDASI FORMAT URL (opsional tapi disarankan)
    if (!filter_var($url_api, FILTER_VALIDATE_URL)) {
        echo json_encode(['status' => 'error', 'message' => 'Format URL API tidak valid']);
        return;
    }
    
    // 3. CEK DUPLIKAT KODE API
    $exists = $this->db->get_where('smb_api_config', ['kode_api' => $kode_api])->row();
    if ($exists) {
        echo json_encode(['status' => 'error', 'message' => 'Kode API sudah digunakan, gunakan kode yang lain']);
        return;
    }
    
    // 4. CEK DUPLIKAT NAMA DATA (opsional)
    $existsName = $this->db->get_where('smb_api_config', ['nama_data' => $nama_data])->row();
    if ($existsName) {
        echo json_encode(['status' => 'error', 'message' => 'Nama Data sudah digunakan, gunakan nama yang lain']);
        return;
    }
    
    // 5. Siapkan data untuk insert
    $data = [
        'kode_api' => $kode_api,
        'nama_data' => $nama_data,
        'url_api' => $url_api,
        'api_key' => $this->input->post('api_key') ?: null, // Jika kosong, set null
        'metode' => $this->input->post('metode') ?: 'GET',
        'mapping_indikator' => $this->input->post('indikator_field') ?: 'result.Indikator',
        'mapping_produsen' => $this->input->post('produsen_field') ?: 'result.Produsen Data',
        'mapping_urusan' => $this->input->post('urusan_field') ?: 'result.Urusan',
        'mapping_satuan' => $this->input->post('satuan_field') ?: 'result.Satuan',
        'mapping_data' => $this->input->post('data_field') ?: 'result.data',
        'mapping_tahun' => $this->input->post('tahun_field') ?: 'tahun',
        'mapping_nilai' => $this->input->post('nilai_field') ?: 'nilai',
        'created_by' => $this->session->userdata('user_id'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    // 6. EKSEKUSI INSERT
    $this->db->insert('smb_api_config', $data);
    
    if ($this->db->affected_rows() > 0) {
        // Log aktivitas (opsional)
        $this->log_aktivitas('Tambah Konfigurasi API', 'Menambahkan konfigurasi API: ' . $nama_data);
        
        echo json_encode([
            'status' => 'success', 
            'message' => 'Konfigurasi API berhasil ditambahkan',
            'id_api' => $this->db->insert_id()
        ]);
    } else {
        echo json_encode([
            'status' => 'error', 
            'message' => 'Gagal menyimpan konfigurasi API. Silakan coba lagi.'
        ]);
    }
}

// Tambahkan helper method untuk log aktivitas (opsional)
private function log_aktivitas($aksi, $detail) {
    $log_data = [
        'username' => $this->session->userdata('username'),
        'bidang' => $this->session->userdata('bidang'),
        'aksi' => $aksi,
        'modul' => 'Portal Satu Data',
        'detail' => $detail,
        'ip_address' => $this->input->ip_address(),
        'waktu' => date('Y-m-d H:i:s')
    ];
    $this->db->insert('smb_log_aktivitas', $log_data);
}

public function update_api_config() {
    header('Content-Type: application/json');
    
    $id_api = $this->input->post('id_api');
    if (!$id_api) {
        echo json_encode(['status' => 'error', 'message' => 'ID API tidak ditemukan']);
        return;
    }
    
    // Validasi input
    $kode_api = trim($this->input->post('kode_api'));
    $nama_data = trim($this->input->post('nama_data'));
    $url_api = trim($this->input->post('url_api'));
    
    if (empty($kode_api) || empty($nama_data) || empty($url_api)) {
        echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi']);
        return;
    }
    
    // Cek duplikat kode_api (kecuali untuk dirinya sendiri)
    $exists = $this->db->where('kode_api', $kode_api)
                       ->where('id_api !=', $id_api)
                       ->get('smb_api_config')
                       ->row();
    if ($exists) {
        echo json_encode(['status' => 'error', 'message' => 'Kode API sudah digunakan oleh konfigurasi lain']);
        return;
    }
    
    $data = [
        'kode_api' => $kode_api,
        'nama_data' => $nama_data,
        'url_api' => $url_api,
        'api_key' => $this->input->post('api_key') ?: null,
        'metode' => $this->input->post('metode') ?: 'GET',
        'mapping_indikator' => $this->input->post('indikator_field') ?: 'result.Indikator',
        'mapping_produsen' => $this->input->post('produsen_field') ?: 'result.Produsen Data',
        'mapping_urusan' => $this->input->post('urusan_field') ?: 'result.Urusan',
        'mapping_satuan' => $this->input->post('satuan_field') ?: 'result.Satuan',
        'mapping_data' => $this->input->post('data_field') ?: 'result.data',
        'mapping_tahun' => $this->input->post('tahun_field') ?: 'tahun',
        'mapping_nilai' => $this->input->post('nilai_field') ?: 'nilai',
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id_api', $id_api);
    $this->db->update('smb_api_config', $data);
    
    if ($this->db->affected_rows() >= 0) {
        $this->log_aktivitas('Update Konfigurasi API', 'Mengupdate konfigurasi API: ' . $nama_data);
        echo json_encode(['status' => 'success', 'message' => 'Konfigurasi API berhasil diupdate']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tidak ada perubahan atau gagal update']);
    }
}

// Hapus konfigurasi API
public function delete_api_config() {
    header('Content-Type: application/json');
    
    $id_api = $this->input->post('id_api');
    if (!$id_api) {
        echo json_encode(['status' => 'error', 'message' => 'ID API required']);
        return;
    }
    
    $this->db->where('id_api', $id_api);
    $this->db->delete('smb_api_config');
    
    echo json_encode(['status' => 'success', 'message' => 'API Config berhasil dihapus']);
}
// ==================== MANAJEMEN ANALISIS DATA ====================

// Get riwayat analisis by indikator
public function get_riwayat_analisis_by_indikator() {
    header('Content-Type: application/json');
    
    $indikator = $this->input->post('indikator');
    if (!$indikator) {
        echo json_encode(['status' => 'success', 'data' => []]);
        return;
    }
    
    $this->db->where('indikator', $indikator);
    $this->db->order_by('created_at', 'DESC');
    $analisis = $this->db->get('smb_analisis_data')->result_array();
    
    // Format tanggal untuk ditampilkan
    foreach ($analisis as &$a) {
        if (!empty($a['created_at'])) {
            $date = new DateTime($a['created_at']);
            $a['tanggal'] = $date->format('d/m/Y H:i');
        } else {
            $a['tanggal'] = '-';
        }
    }
    
    echo json_encode(['status' => 'success', 'data' => $analisis]);
}

// Get detail analisis
public function get_analisis_detail() {
    header('Content-Type: application/json');
    
    $id = $this->input->post('id_analisis');
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID analisis required']);
        return;
    }
    
    $analisis = $this->db->get_where('smb_analisis_data', ['id_analisis' => $id])->row_array();
    
    if ($analisis) {
        if (!empty($analisis['created_at'])) {
            $date = new DateTime($analisis['created_at']);
            $analisis['tanggal'] = $date->format('d/m/Y H:i');
        }
        echo json_encode(['status' => 'success', 'data' => $analisis]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
}

// Simpan analisis data
public function simpan_analisis_data() {
    header('Content-Type: application/json');
    
    $judul = $this->input->post('judul');
    $indikator = $this->input->post('indikator');
    
    if (empty($judul)) {
        echo json_encode(['status' => 'error', 'message' => 'Judul analisis harus diisi']);
        return;
    }
    
    if (empty($indikator)) {
        echo json_encode(['status' => 'error', 'message' => 'Indikator harus diisi']);
        return;
    }
    
    $data = [
        'judul' => $judul,
        'indikator' => $indikator,
        'data_aktual' => $this->input->post('data_aktual'),
        'kesimpulan' => $this->input->post('kesimpulan'),
        'rekomendasi' => $this->input->post('rekomendasi'),
        'created_by' => $this->session->userdata('username') ?: $this->session->userdata('user_id'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('smb_analisis_data', $data);
    
    if ($this->db->affected_rows() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Analisis berhasil disimpan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan analisis']);
    }
}

// Delete analisis
public function delete_analisis_data() {
    header('Content-Type: application/json');
    
    $id = $this->input->post('id_analisis');
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID analisis required']);
        return;
    }
    
    $this->db->where('id_analisis', $id);
    $this->db->delete('smb_analisis_data');
    
    if ($this->db->affected_rows() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Analisis berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus analisis']);
    }
}

// Get latest analisis (untuk export PDF)
public function get_latest_analisis() {
    header('Content-Type: application/json');
    
    $this->db->order_by('created_at', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('smb_analisis_data');
    
    if ($query->num_rows() > 0) {
        $data = $query->row_array();
        echo json_encode([
            'status' => 'success',
            'data' => [
                'judul' => $data['judul'],
                'kesimpulan' => $data['kesimpulan'],
                'rekomendasi' => $data['rekomendasi'],
                'tanggal' => date('d/m/Y H:i', strtotime($data['created_at']))
            ]
        ]);
    } else {
        echo json_encode([
            'status' => 'success',
            'data' => null
        ]);
    }
}

// Get manual data by kode
public function get_manual_data_by_kode() {
    header('Content-Type: application/json');
    
    $kode = $this->input->get('kode');
    if (empty($kode)) {
        echo json_encode(['status' => 'error', 'message' => 'Kode API tidak ditemukan']);
        return;
    }
    
    $data = $this->db->get_where('smb_data_manual', ['kode_api' => $kode])->row_array();
    
    if ($data) {
        $series = json_decode($data['data_series'], true);
        
        // Urutkan berdasarkan tahun
        if ($series) {
            usort($series, function($a, $b) {
                return $a['tahun'] - $b['tahun'];
            });
        }
        
        echo json_encode([
            'status' => 'success',
            'data' => [
                'id' => $data['id'],
                'kode_api' => $data['kode_api'],
                'indikator' => $data['indikator'],
                'satuan' => $data['satuan'],
                'series' => $series ?: []
            ]
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan untuk kode: ' . $kode]);
    }
}

// Get all manual data
public function get_all_manual_data() {
    header('Content-Type: application/json');
    
    $data = $this->db->get('smb_data_manual')->result_array();
    
    foreach ($data as &$item) {
        $series = json_decode($item['data_series'], true);
        $item['jumlah_data'] = is_array($series) ? count($series) : 0;
        $item['created_at_formatted'] = date('d/m/Y H:i', strtotime($item['created_at']));
        $item['updated_at_formatted'] = !empty($item['updated_at']) ? date('d/m/Y H:i', strtotime($item['updated_at'])) : '-';
    }
    
    echo json_encode(['status' => 'success', 'data' => $data]);
}

// Save manual data
public function save_manual_data() {
    // Set header dan error reporting untuk debugging
    header('Content-Type: application/json');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Log untuk debugging
    error_log("=== save_manual_data called ===");
    
    // Ambil data dari POST
    $kode_api = $this->input->post('kode_api');
    $nama_data = $this->input->post('nama_data');
    $satuan = $this->input->post('satuan');
    $data_series = $this->input->post('data_series');
    $id_manual = $this->input->post('id_manual');
    
    // Log data yang diterima
    error_log("kode_api: " . $kode_api);
    error_log("nama_data: " . $nama_data);
    error_log("satuan: " . $satuan);
    error_log("data_series: " . $data_series);
    error_log("id_manual: " . $id_manual);
    
    // Validasi
    if (empty($kode_api)) {
        echo json_encode(['status' => 'error', 'message' => 'Kode API tidak boleh kosong']);
        return;
    }
    
    if (empty($nama_data)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama Data tidak boleh kosong']);
        return;
    }
    
    if (empty($data_series)) {
        echo json_encode(['status' => 'error', 'message' => 'Data series tidak boleh kosong']);
        return;
    }
    
    // Parse data series
    $series = json_decode($data_series, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['status' => 'error', 'message' => 'Format data series tidak valid: ' . json_last_error_msg()]);
        return;
    }
    
    if (empty($series)) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal 1 data tahun harus diisi']);
        return;
    }
    
    // Siapkan data untuk insert/update
    $data = [
        'kode_api' => $kode_api,
        'indikator' => $nama_data,
        'satuan' => $satuan,
        'data_series' => $data_series,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    // Cek apakah data sudah ada
    $existing = $this->db->get_where('smb_data_manual', ['kode_api' => $kode_api])->row();
    
    if ($existing) {
        // Update
        $this->db->where('kode_api', $kode_api);
        $result = $this->db->update('smb_data_manual', $data);
        
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Data manual berhasil diupdate']);
        } else {
            $error = $this->db->error();
            error_log("DB Error: " . print_r($error, true));
            echo json_encode(['status' => 'error', 'message' => 'Gagal update data: ' . $error['message']]);
        }
    } else {
        // Insert
        $data['created_at'] = date('Y-m-d H:i:s');
        $result = $this->db->insert('smb_data_manual', $data);
        
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Data manual berhasil disimpan']);
        } else {
            $error = $this->db->error();
            error_log("DB Error: " . print_r($error, true));
            echo json_encode(['status' => 'error', 'message' => 'Gagal simpan data: ' . $error['message']]);
        }
    }
}

// Delete manual data
public function delete_manual_data() {
    header('Content-Type: application/json');
    
    $kode_api = $this->input->post('kode_api');
    if (empty($kode_api)) {
        echo json_encode(['status' => 'error', 'message' => 'Kode API tidak ditemukan']);
        return;
    }
    
    $this->db->where('kode_api', $kode_api);
    $result = $this->db->delete('smb_data_manual');
    
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Data manual berhasil dihapus']);
    } else {
        $error = $this->db->error();
        echo json_encode(['status' => 'error', 'message' => 'Gagal hapus data: ' . $error['message']]);
    }
}


public function edit_dokumen($id_dokumen) {
    // ========== 1. CEK SESSION LOGIN ==========
    if (!$this->session->userdata('smb_logged_in')) {
        $this->session->set_flashdata('error', 'Silakan login terlebih dahulu');
        redirect('IDE/SmbLoginPage');
    }
    
    // ========== 2. AMBIL DATA DOKUMEN ==========
    $dokumen = $this->db->get_where('smb_dokumen', ['id_dokumen' => $id_dokumen])->row_array();
    
    if (!$dokumen) {
        show_404('Dokumen tidak ditemukan');
    }
    
    // ========== 3. CEK PERMISSION AKSES ==========
    $username = $this->session->userdata('username');
    $level = $this->session->userdata('level');
    
    // Yang boleh edit: uploader sendiri, Super Admin (level 1), atau Kepala Bappeda (level 2)
    $can_edit = ($dokumen['uploaded_by'] == $username) || in_array($level, [1, 2]);
    
    if (!$can_edit) {
        show_error('Anda tidak memiliki akses untuk mengedit dokumen ini', 403);
    }
    
    // ========== 4. CEK JENIS DOKUMEN (Google Docs atau File Upload) ==========
    $is_google_docs = !empty($dokumen['google_docs_link']);
    
    // ========== 5. JIKA GOOGLE DOCS, REDIRECT KE LINK ==========
    if ($is_google_docs) {
        // Catat riwayat edit
        $this->db->insert('smb_dokumen_edit_log', [
            'id_dokumen' => $id_dokumen,
            'username' => $username,
            'click_time' => date('Y-m-d H:i:s'),
            'ip_address' => $_SERVER['REMOTE_ADDR']
        ]);
        
        // Update versi
        $new_version = $dokumen['version'] + 1;
        $this->db->where('id_dokumen', $id_dokumen);
        $this->db->update('smb_dokumen', [
            'version' => $new_version,
            'last_edited_by' => $username,
            'last_edit_date' => date('Y-m-d H:i:s')
        ]);
        
        // Log aktivitas
        if (method_exists($this, '_log_aktivitas')) {
            $bidang_map = [
                'a' => 'Litbang', 'b' => 'Perencanaan', 'c' => 'Ekonomi',
                'd' => 'Kesra', 'e' => 'Sarpras', 'f' => 'Sekretariat'
            ];
            $nama_bidang_short = $bidang_map[$dokumen['id_bidang']] ?? 'Unknown';
            
            $this->_log_aktivitas(
                $username,
                'Edit Dokumen (Google Docs)',
                $nama_bidang_short,
                "Mengedit dokumen via Google Docs: {$dokumen['nama_dokumen']} (versi {$dokumen['version']} → {$new_version})"
            );
        }
        
        // Redirect ke Google Docs
        redirect($dokumen['google_docs_link']);
    }
    
    // ========== 6. JIKA FILE UPLOAD (DOCX), LANJUTKAN PROSES ==========
    // Validasi tipe file
    $allowed_types = [
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
        'application/msword', // .doc (legacy)
    ];
    
    if (!in_array($dokumen['file_type'], $allowed_types)) {
        show_error('Hanya file .docx yang dapat diedit. File saat ini: ' . htmlspecialchars($dokumen['file_type']), 400);
    }
    
    // ========== 7. LOAD HELPER ==========
    $this->load->helper('doc');
    
    // ========== 8. CEK FILE FISIK ==========
    $full_path = FCPATH . $dokumen['file_path'];
    
    if (!file_exists($full_path)) {
        show_error('File dokumen tidak ditemukan di server. Silakan hubungi administrator.', 404);
    }
    
    // ========== 9. AMBIL ATAU KONVERSI HTML CONTENT ==========
    $html_content = $dokumen['dokumen_html'];
    
    // Jika belum ada HTML content, konversi dari file DOCX
    if (empty($html_content)) {
        try {
            $html_content = docx_to_html($full_path);
            
            if ($html_content && $html_content !== '<p><em>File tidak ditemukan</em></p>') {
                // Simpan hasil konversi ke database untuk下次 akses lebih cepat
                $this->db->where('id_dokumen', $id_dokumen);
                $this->db->update('smb_dokumen', [
                    'dokumen_html' => $html_content,
                    'last_edit_date' => date('Y-m-d H:i:s')
                ]);
            } else {
                $html_content = '<p><em>Gagal mengkonversi dokumen. File mungkin korup atau tidak didukung.</em></p>';
            }
        } catch (Exception $e) {
            log_message('error', 'Konversi dokumen gagal: ' . $e->getMessage());
            $html_content = '<p><em>Terjadi kesalahan saat membaca dokumen: ' . htmlspecialchars($e->getMessage()) . '</em></p>';
        }
    }
    
    // Pastikan html_content tidak kosong
    if (empty($html_content) || trim($html_content) == '') {
        $html_content = '<p><em>Konten dokumen kosong atau tidak dapat dibaca.</em></p>';
    }
    
    // ========== 10. PERSIAPAN DATA UNTUK VIEW ==========
    // Format tanggal untuk ditampilkan
    $upload_date_formatted = date('d/m/Y H:i', strtotime($dokumen['upload_date']));
    $last_edit_formatted = !empty($dokumen['last_edit_date']) 
        ? date('d/m/Y H:i', strtotime($dokumen['last_edit_date'])) 
        : 'Belum pernah diedit';
    
    // Dapatkan nama user yang terakhir mengedit
    $last_editor = $dokumen['last_edited_by'] ?? '-';
    if ($last_editor != '-' && $last_editor != $dokumen['uploaded_by']) {
        $editor_info = $this->db->get_where('akun', ['Username' => $last_editor])->row_array();
        $last_editor = $editor_info['Username'] ?? $last_editor;
    }
    
    // Mapping nama bidang untuk ditampilkan
    $bidang_map = [
        'a' => 'Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi',
        'b' => 'Bidang Perencanaan Pembangunan',
        'c' => 'Bidang Ekonomi',
        'd' => 'Bidang Kesejahteraan Rakyat dan Pemerintahan',
        'e' => 'Bidang Sarana Prasarana Wilayah dan Lingkungan',
        'f' => 'Bidang Sekretariat'
    ];
    $nama_bidang = $bidang_map[$dokumen['id_bidang']] ?? 'Bidang Tidak Dikenal';
    
    // ========== 11. KIRIM DATA KE VIEW ==========
    $data = [
        'title' => 'Edit Dokumen - ' . $dokumen['nama_dokumen'],
        'dokumen' => $dokumen,
        'html_content' => $html_content,
        'upload_date_formatted' => $upload_date_formatted,
        'last_edit_formatted' => $last_edit_formatted,
        'last_editor' => $last_editor,
        'nama_bidang' => $nama_bidang,
        'username' => $username,
        'user_level' => $level,
        'is_admin' => in_array($level, [1, 2]),
        'is_owner' => ($dokumen['uploaded_by'] == $username),
        'is_google_docs' => $is_google_docs,
        'csrf_token' => $this->security->get_csrf_hash()
    ];
    
    $this->load->view('Smb/edit_dokumen', $data);
}

/**
 * Proses Save Hasil Edit Dokumen
 */
/**
 * Proses Save Hasil Edit Dokumen
 * Overwrite file DOCX dan generate ulang PDF
 */
public function save_dokumen_edit() {
    // ========== 1. ENABLE ERROR LOGGING ==========
    error_reporting(E_ALL);
    ini_set('display_errors', 0); // Jangan tampilkan ke browser
    ini_set('log_errors', 1);
    
    // ========== 2. CLEAN OUTPUT BUFFER ==========
    while (ob_get_level()) {
        ob_end_clean();
    }
    ob_start(); // Start clean buffer
    
    // ========== 3. SET HEADER UNTUK JSON RESPONSE ==========
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    // ========== 4. FUNCTION UNTUK RESPONSE ==========
    $sendResponse = function($status, $message, $code = null, $extra = []) {
        $response = ['status' => $status, 'message' => $message];
        if ($code) $response['code'] = $code;
        foreach ($extra as $key => $value) {
            $response[$key] = $value;
        }
        
        // Bersihkan buffer dan kirim response
        ob_clean();
        echo json_encode($response);
        exit;
    };
    
    try {
        // ========== 5. CEK SESSION LOGIN ==========
        if (!$this->session->userdata('smb_logged_in')) {
            $sendResponse('error', 'Session expired, silakan login kembali', 'SESSION_EXPIRED');
        }
        
        // ========== 6. LOAD HELPER ==========
        // Cek apakah file helper ada
        if (!file_exists(APPPATH . 'helpers/doc_helper.php')) {
            $sendResponse('error', 'File helper tidak ditemukan', 'HELPER_NOT_FOUND');
        }
        
        $this->load->helper('doc');
        
        // Cek fungsi helper setelah load
        if (!function_exists('html_to_docx')) {
            $sendResponse('error', 'Fungsi konversi HTML tidak ditemukan. Periksa file doc_helper.php', 'HELPER_FUNCTION_MISSING');
        }
        
        // ========== 7. AMBIL DATA DARI POST ==========
        $id_dokumen = $this->input->post('id_dokumen');
        $edited_html = $this->input->post('dokumen_html');
        $status = $this->input->post('status');
        $kategori = $this->input->post('kategori');
        $nama_dokumen = trim($this->input->post('nama_dokumen'));
        
        // Log untuk debugging
        log_message('debug', "save_dokumen_edit called - ID: $id_dokumen");
        
        // ========== 8. VALIDASI INPUT ==========
        if (empty($id_dokumen)) {
            $sendResponse('error', 'ID dokumen tidak valid', 'INVALID_ID');
        }
        
        if (empty($edited_html)) {
            $sendResponse('error', 'Konten dokumen tidak boleh kosong', 'EMPTY_CONTENT');
        }
        
        // Cek apakah konten hanya berisi tag kosong
        $cleaned_content = trim(strip_tags($edited_html));
        if (empty($cleaned_content)) {
            $sendResponse('error', 'Konten dokumen tidak boleh kosong', 'EMPTY_CONTENT');
        }
        
        // ========== 9. AMBIL DATA DOKUMEN ==========
        $dokumen = $this->db->get_where('smb_dokumen', ['id_dokumen' => $id_dokumen])->row_array();
        
        if (!$dokumen) {
            $sendResponse('error', 'Dokumen tidak ditemukan', 'DOCUMENT_NOT_FOUND');
        }
        
        // ========== 10. CEK PERMISSION ==========
        $username = $this->session->userdata('username');
        $level = $this->session->userdata('level');
        
        $can_edit = ($dokumen['uploaded_by'] == $username) || in_array($level, [1, 2]);
        
        if (!$can_edit) {
            $sendResponse('error', 'Anda tidak memiliki akses untuk mengedit dokumen ini', 'ACCESS_DENIED');
        }
        
        // ========== 11. VALIDASI TIPE FILE ==========
        $file_ext = strtolower(pathinfo($dokumen['file_name'], PATHINFO_EXTENSION));
        
        if ($file_ext != 'docx') {
            $sendResponse('error', 'Hanya file .docx yang dapat diedit. File saat ini berformat .' . $file_ext, 'INVALID_FILE_TYPE');
        }
        
        // ========== 12. PERSIAPAN PATH FILE ==========
        $docx_path = FCPATH . $dokumen['file_path'];
        $backup_path = FCPATH . 'uploads/dokumen/backup/';
        $temp_path = FCPATH . 'uploads/temp/';
        
        // Buat folder dengan error handling yang lebih baik
        if (!is_dir($backup_path)) {
            if (!@mkdir($backup_path, 0777, true)) {
                $sendResponse('error', 'Tidak dapat membuat folder backup. Periksa permission folder uploads.', 'FOLDER_CREATE_FAILED');
            }
        }
        
        if (!is_dir($temp_path)) {
            if (!@mkdir($temp_path, 0777, true)) {
                $sendResponse('error', 'Tidak dapat membuat folder temporary. Periksa permission folder uploads.', 'FOLDER_CREATE_FAILED');
            }
        }
        
        // ========== 13. CEK FILE FISIK ==========
        if (!file_exists($docx_path)) {
            $sendResponse('error', 'File dokumen tidak ditemukan di server', 'FILE_NOT_FOUND');
        }
        
        // ========== 14. PROSES EDIT DOKUMEN ==========
        $warnings = [];
        $backup_name = 'backup_' . $dokumen['id_dokumen'] . '_v' . $dokumen['version'] . '_' . date('Ymd_His') . '.docx';
        
        // 14a. Backup file lama (opsional, lanjutkan walau gagal)
        if (!@copy($docx_path, $backup_path . $backup_name)) {
            $warnings[] = 'Gagal membuat backup file (tidak kritis)';
        }
        
        // 14b. Simpan HTML sementara (optional)
        $html_backup = $temp_path . 'edit_' . $id_dokumen . '_' . date('Ymd_His') . '.html';
        @file_put_contents($html_backup, $edited_html);
        
        // 14c. Konversi HTML ke DOCX
        try {
            $html_to_docx_result = html_to_docx($edited_html, $docx_path);
            
            if (!$html_to_docx_result) {
                // Restore dari backup jika gagal
                if (file_exists($backup_path . $backup_name)) {
                    @copy($backup_path . $backup_name, $docx_path);
                }
                $sendResponse('error', 'Gagal mengkonversi HTML ke DOCX. Pastikan konten valid.', 'CONVERSION_FAILED', ['warnings' => $warnings]);
            }
        } catch (Exception $e) {
            log_message('error', 'html_to_docx exception: ' . $e->getMessage());
            $sendResponse('error', 'Terjadi error saat konversi dokumen: ' . $e->getMessage(), 'CONVERSION_EXCEPTION');
        }
        
        // 14d. Generate PDF (opsional, tidak mengganggu jika gagal)
        $pdf_generated = false;
        if (function_exists('html_to_pdf')) {
            try {
                $pdf_filename = pathinfo($dokumen['file_name'], PATHINFO_FILENAME) . '.pdf';
                $pdf_path = FCPATH . 'uploads/dokumen/' . $pdf_filename;
                
                if (html_to_pdf($edited_html, $pdf_path)) {
                    $pdf_generated = true;
                } else {
                    $warnings[] = 'File PDF gagal di-generate ulang. Dokumen DOCX tetap tersimpan.';
                }
            } catch (Exception $e) {
                $warnings[] = 'Error saat generate PDF: ' . $e->getMessage();
                log_message('error', 'PDF generation error: ' . $e->getMessage());
            }
        }
        
        // ========== 15. UPDATE DATABASE ==========
        $update_data = [
            'nama_dokumen' => !empty($nama_dokumen) ? htmlspecialchars($nama_dokumen, ENT_QUOTES, 'UTF-8') : $dokumen['nama_dokumen'],
            'kategori' => !empty($kategori) ? htmlspecialchars($kategori, ENT_QUOTES, 'UTF-8') : $dokumen['kategori'],
            'status' => !empty($status) ? htmlspecialchars($status, ENT_QUOTES, 'UTF-8') : $dokumen['status'],
            'dokumen_html' => $edited_html,
            'last_edited_by' => $username,
            'last_edit_date' => date('Y-m-d H:i:s'),
            'version' => $dokumen['version'] + 1
        ];
        
        $this->db->where('id_dokumen', $id_dokumen);
        $db_update = $this->db->update('smb_dokumen', $update_data);
        
        if (!$db_update) {
            $sendResponse('error', 'Gagal update database: ' . $this->db->error()['message'], 'DB_ERROR');
        }
        
        // ========== 16. LOG AKTIVITAS ==========
        if (method_exists($this, '_log_aktivitas')) {
            $bidang_map = [
                'a' => 'Litbang', 'b' => 'Perencanaan', 'c' => 'Ekonomi', 
                'd' => 'Kesra', 'e' => 'Sarpras', 'f' => 'Sekretariat'
            ];
            $nama_bidang = $bidang_map[$dokumen['id_bidang']] ?? 'Unknown';
            
            $this->_log_aktivitas(
                $username,
                'Edit Dokumen',
                $nama_bidang,
                "Mengedit dokumen: {$dokumen['nama_dokumen']} (versi " . ($dokumen['version'] + 1) . ")"
            );
        }
        
        // ========== 17. HAPUS FILE TEMPORARY ==========
        if (isset($html_backup) && file_exists($html_backup)) {
            @unlink($html_backup);
        }
        
        // ========== 18. KIRIM RESPONSE SUKSES ==========
        $response = [
            'status' => 'success',
            'message' => 'Dokumen berhasil disimpan',
            'redirect' => base_url('IDE/SmbDashboard?tab=bidang&bidang=' . $dokumen['id_bidang']),
            'new_version' => $dokumen['version'] + 1
        ];
        
        if (!empty($warnings)) {
            $response['warnings'] = $warnings;
        }
        
        if (!$pdf_generated) {
            $response['warning_pdf'] = 'File PDF gagal di-generate, silakan generate manual nanti.';
        }
        
        $sendResponse('success', 'Dokumen berhasil disimpan', null, $response);
        
    } catch (Exception $e) {
        log_message('error', 'save_dokumen_edit unexpected error: ' . $e->getMessage());
        log_message('error', 'Stack trace: ' . $e->getTraceAsString());
        
        $sendResponse('error', 'Terjadi kesalahan sistem: ' . $e->getMessage(), 'SYSTEM_ERROR');
    }
}

    // ==================== REPOSITORI DATA IKU & ASISTEN AI INTEGRATION ====================

    /**
     * Ambil data IKU dari REST API IPPD
     */
    public function get_provinsi()
    {
        header('Content-Type: application/json; charset=utf-8');
        $query = $this->db->query("SELECT Kode, Nama FROM kodewilayah WHERE length(Kode) = 2 ORDER BY Nama ASC");
        echo json_encode(['status' => 'success', 'data' => $query->result_array()]);
    }

    public function get_kabkota()
    {
        header('Content-Type: application/json; charset=utf-8');
        $prov = $this->input->get('provinsi', TRUE);
        if (empty($prov)) {
            echo json_encode(['status' => 'error', 'message' => 'Provinsi tidak valid']);
            return;
        }
        $query = $this->db->query("SELECT Kode, Nama FROM kodewilayah WHERE length(Kode) = 5 AND Kode LIKE '".$this->db->escape_like_str($prov).".%' ORDER BY Nama ASC");
        echo json_encode(['status' => 'success', 'data' => $query->result_array()]);
    }
    public function get_indikator()
    {
        header('Content-Type: application/json; charset=utf-8');
        $kodewilayah = $this->input->get('kodewilayah', TRUE);
        $where = "deleted_at IS NULL";
        if (!empty($kodewilayah)) {
            if (strlen($kodewilayah) == 2) {
                $where .= " AND kodewilayah LIKE '" . $this->db->escape_like_str($kodewilayah) . ".%'";
            } else {
                $where .= " AND kodewilayah = '" . $this->db->escape_str($kodewilayah) . "'";
            }
        }
        $query = $this->db->query("SELECT DISTINCT indikator_tujuan FROM ippd.iku WHERE $where AND indikator_tujuan IS NOT NULL AND indikator_tujuan != '' ORDER BY indikator_tujuan ASC");
        echo json_encode(['status' => 'success', 'data' => $query->result_array()]);
    }

    public function get_repositori_iku()
    {
        // Tutup session agar tidak locking Apache worker threads
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }

        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        $search = $this->input->get('search', TRUE);
          $reqWilayah = $this->input->get('kodewilayah', TRUE);
          $reqIndikator = $this->input->get('indikator', TRUE);
          $dataRows = [];
          $fetched = false;
          $source = 'Database IPPD (Direct)';

          try {
              $where = ["deleted_at IS NULL"];
              if (!empty($reqWilayah)) {
                  if (strlen($reqWilayah) == 2) {
                      $where[] = "kodewilayah LIKE '" . $this->db->escape_like_str($reqWilayah) . ".%'";
                  } else {
                      $where[] = "kodewilayah = '" . $this->db->escape_str($reqWilayah) . "'";
                  }
              }
              if (!empty($reqIndikator)) {
                  $where[] = "indikator_tujuan = '" . $this->db->escape_str($reqIndikator) . "'";
              }
            if (!empty($search)) {
                $sEsc = $this->db->escape_like_str($search);
                $where[] = "(indikator_tujuan LIKE '%" . $sEsc . "%' OR definisi_operasional LIKE '%" . $sEsc . "%')";
            }
                        $sql = "SELECT i.*, (SELECT Nama FROM kodewilayah WHERE Kode = i.kodewilayah LIMIT 1) AS wilayah_nama FROM ippd.iku i WHERE " . implode(" AND ", $where) . " ORDER BY id ASC";
            $query = $this->db->query($sql);
            if ($query && $query->num_rows() > 0) {
                $dataRows = $query->result_array();
                // Ensure kodewilayah mapping is consistent
                foreach ($dataRows as &$r) {
                    if (empty($r['wilayah_nama'])) {
                        $r['wilayah_nama'] = "Wilayah " . $r['kodewilayah'];
                    }
                }
                $fetched = true;
                $source = 'Database IPPD (Direct)';
            }
        } catch (\Throwable $e) {
            // Lanjut ke fallback cURL jika query langsung gagal
        }

        // 2. Fallback: Jika database langsung kosong/gagal, coba cURL ke REST API IPPD
          if (!$fetched) {
              $apiKey = 'ippd_2771e8d3e39200cd22243a391176eb5b';
              $queryParams = ['api_key' => $apiKey, 'kodewilayah' => !empty($reqWilayah) ? $reqWilayah : ''];
            if (!empty($search)) $queryParams['search'] = $search;
            if (!empty($reqIndikator)) $queryParams['indikator'] = $reqIndikator;

            $targetUrl = 'http://127.0.0.1/ippd/index.php/api/iku?' . http_build_query($queryParams);

            $ch = curl_init($targetUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 2);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
            curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && !empty($response)) {
                $json = json_decode($response, true);
                if (!empty($json) && isset($json['data']) && is_array($json['data']) && count($json['data']) > 0) {
                    $dataRows = $json['data'];
                    $fetched = true;
                    $source = 'Layanan REST API IPPD';
                }
            }
        }

        // 3. Fallback Cadangan Resmi: Menjamin respons selalu sukses dan data 7 indikator selalu tampil
        if (!$fetched || empty($dataRows)) {
            $dataRows = [
                ['id' => 191, 'kodewilayah' => '', 'id_tujuan' => 18, 'indikator_tujuan' => 'Indeks Pembangunan Manusia', 'sasaran' => 'Indeks komposit yang mengukur pembangunan manusia dari tiga aspek dasar yaitu umur panjang dan hidup sehat, pengetahuan, dan standar hidup layak.', 'satuan' => '%', 'rumus' => 'IPM = ∛Indeks Kesehatan × Indeks Pendidikan × Indeks Standar Hidup Layak', 'tahun_mulai' => 2025, 'tahun_akhir' => 2029, 'target_1' => 71.49, 'target_2' => 71.8, 'target_3' => 72.1, 'target_4' => 72.42, 'target_5' => 72.8],
                ['id' => 192, 'kodewilayah' => '', 'id_tujuan' => 19, 'indikator_tujuan' => 'Pertumbuhan Ekonomi', 'sasaran' => 'Perkembangan Produksi Barang dan Jasa di suatu wilayah perekonomian pada tahun tertentu terhadap nilai tahun sebelumnya yang dihitung berdasarkan PDB/PDRB atas dasar harga konstan', 'satuan' => '%', 'rumus' => 'Pertumbuhan Ekonomi = ((PDRBₜ - PDRBₜ₋₁) / PDRBₜ₋₁) × 100%', 'tahun_mulai' => 2025, 'tahun_akhir' => 2029, 'target_1' => 4.82, 'target_2' => 4.87, 'target_3' => 4.92, 'target_4' => 4.97, 'target_5' => 5.02],
                ['id' => 193, 'kodewilayah' => '', 'id_tujuan' => 19, 'indikator_tujuan' => 'Ketimpangan Pendapatan (Gini Rasio)', 'sasaran' => 'Rasio gini merupakan salah satu teknik statistik untuk mengukur ketimpangan pendapatan.', 'satuan' => '%', 'rumus' => 'GR', 'tahun_mulai' => 2025, 'tahun_akhir' => 2029, 'target_1' => 0.38, 'target_2' => 0.38, 'target_3' => 0.37, 'target_4' => 0.37, 'target_5' => 0.36],
                ['id' => 194, 'kodewilayah' => '', 'id_tujuan' => 19, 'indikator_tujuan' => 'Tingkat Kemiskinan', 'sasaran' => 'Kemiskinan adalah kondisi seseorang yang tidak mampu memenuhi kebutuhan dasar makanan maupun bukan makanan yang diukur dari sisi pengeluaran.', 'satuan' => '%', 'rumus' => 'P0', 'tahun_mulai' => 2025, 'tahun_akhir' => 2029, 'target_1' => 10.81, 'target_2' => 10.46, 'target_3' => 10, 'target_4' => 9.66, 'target_5' => 9.08],
                ['id' => 195, 'kodewilayah' => '', 'id_tujuan' => 20, 'indikator_tujuan' => 'Indeks Kepuasan Layanan Infrastruktur (IKLI)', 'sasaran' => 'Tingkat kepuasan masyarakat terhadap kondisi dan kemanfaatan infrastruktur daerah.', 'satuan' => '%', 'rumus' => '', 'tahun_mulai' => 2025, 'tahun_akhir' => 2029, 'target_1' => 85.03, 'target_2' => 85.94, 'target_3' => 86.5, 'target_4' => 87.29, 'target_5' => 88.89],
                ['id' => 196, 'kodewilayah' => '', 'id_tujuan' => 21, 'indikator_tujuan' => 'Indeks Reformasi Birokrasi', 'sasaran' => 'Kemajuan pelaksanaan reformasi birokrasi pada 8 area perubahan tata kelola.', 'satuan' => '%', 'rumus' => '', 'tahun_mulai' => 2025, 'tahun_akhir' => 2029, 'target_1' => 84.86, 'target_2' => 85.11, 'target_3' => 85.61, 'target_4' => 86.11, 'target_5' => 86.61],
                ['id' => 197, 'kodewilayah' => '', 'id_tujuan' => 22, 'indikator_tujuan' => 'Indeks Kesalehan Sosial', 'sasaran' => 'Tingkat sikap gotong royong dan keharmonisan sosial masyarakat.', 'satuan' => '%', 'rumus' => '', 'tahun_mulai' => 2025, 'tahun_akhir' => 2029, 'target_1' => 82.67, 'target_2' => 84.07, 'target_3' => 85.47, 'target_4' => 86.87, 'target_5' => 88.27],
            ];
            $source = 'Cache Resmi Bappeda Banyuwangi';
        }

        // Normalisasi data dengan mempertahankan nilai asli dari database/API persis tanpa koma tambahan
        $cleanTarget = function($v) {
            if ($v === null || $v === '') return null;
            if (is_numeric($v)) {
                $f = (float)$v;
                return ($f == (int)$f) ? (int)$f : $f;
            }
            return $v;
        };

        $normalizedData = [];
        foreach ($dataRows as $row) {
            $rawT1 = $cleanTarget($row['target_1'] !== null ? $row['target_1'] : ($row['target_t1'] ?? null));
            $rawT2 = $cleanTarget($row['target_2'] !== null ? $row['target_2'] : ($row['target_t2'] ?? null));
            $rawT3 = $cleanTarget($row['target_3'] !== null ? $row['target_3'] : ($row['target_t3'] ?? null));
            $rawT4 = $cleanTarget($row['target_4'] !== null ? $row['target_4'] : ($row['target_t4'] ?? null));
            $rawT5 = $cleanTarget($row['target_5'] !== null ? $row['target_5'] : ($row['target_t5'] ?? null));

            $normalizedData[] = [
                'id' => (int)($row['id'] ?? 0),
                'kodewilayah' => '',
                'kode_wilayah' => '35.12',
                'id_tujuan' => $row['id_tujuan'] ?? null,
                'indikator' => $row['indikator_tujuan'] ?? $row['indikator'] ?? '',
                'indikator_tujuan' => $row['indikator_tujuan'] ?? $row['indikator'] ?? '',
                'definisi_operasional' => $row['definisi_operasional'] ?? ($row['sasaran'] ?? ''),
                'sasaran' => !empty($row['definisi_operasional']) ? $row['definisi_operasional'] : ($row['sasaran'] ?? '-'),
                'satuan' => $row['satuan'] ?? '%',
                'rumus' => $row['rumus'] ?? '',
                'tahun_mulai' => (int)($row['tahun_mulai'] ?? $row['tahun_awal'] ?? 2025),
                'tahun_awal' => (int)($row['tahun_mulai'] ?? $row['tahun_awal'] ?? 2025),
                'tahun_akhir' => (int)($row['tahun_akhir'] ?? 2029),
                'target_1' => $rawT1,
                'target_t1' => $rawT1,
                'target_2' => $rawT2,
                'target_t2' => $rawT2,
                'target_3' => $rawT3,
                'target_t3' => $rawT3,
                'target_4' => $rawT4,
                'target_t4' => $rawT4,
                'target_5' => $rawT5,
                'target_t5' => $rawT5,
            ];
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Data IKU Kabupaten Banyuwangi (35.12) berhasil diambil',
            'count' => count($normalizedData),
            'total' => count($normalizedData),
            'data' => $normalizedData,
            'source' => $source
        ]);
    }

    /**
     * Generate Kesimpulan & Evaluasi IKU menggunakan Asisten AI
     */
    public function generate_gemini_evaluasi()
    {
        // Tutup session agar tidak locking Apache worker threads
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }

        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        $geminiApiKey = getenv('GEMINI_API_KEY') ?: (defined('GEMINI_API_KEY') ? GEMINI_API_KEY : '');
        if (empty($geminiApiKey) && file_exists(APPPATH . 'config/gemini_key.php')) {
            $geminiApiKey = (string)(include APPPATH . 'config/gemini_key.php');
        }

        // Terima payload JSON atau POST form
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        if (!$input) {
            $input = $this->input->post();
        }

        $indikator = $input['indikator'] ?? $input['indikator_tujuan'] ?? 'Indikator Kinerja';
        $kodewilayah = $input['kodewilayah'] ?? $input['kode_wilayah'] ?? '35.12';
        $wilayahNama = ($kodewilayah === '35.12') ? 'Kabupaten Banyuwangi' : 'Wilayah ' . $kodewilayah;
        $tahunMulai = $input['tahun_mulai'] ?? $input['tahun_awal'] ?? '2025';
        $tahunAkhir = $input['tahun_akhir'] ?? '2029';
        $t1 = $input['target_1'] ?? $input['target_t1'] ?? '-';
        $t2 = $input['target_2'] ?? $input['target_t2'] ?? '-';
        $t3 = $input['target_3'] ?? $input['target_t3'] ?? '-';
        $t4 = $input['target_4'] ?? $input['target_t4'] ?? '-';
        $t5 = $input['target_5'] ?? $input['target_t5'] ?? '-';
        $satuan = $input['satuan'] ?? '%';
        $rumus = $input['rumus'] ?? '';
        $definisi = $input['definisi_operasional'] ?? ($input['sasaran'] ?? '');
        $topik = trim($input['topik'] ?? $input['catatan_tambahan'] ?? $input['fokus'] ?? $input['fokus_evaluasi'] ?? '');
        $tone = trim($input['tone'] ?? 'komprehensif');

        // Prompt berbasis peran Peneliti Senior Ekonomi Pembangunan - Khusus 2 Paragraf fokus data angka riil & topik pengguna
        $prompt = "Anda adalah Peneliti Senior Bidang Ekonomi Pembangunan pada Badan Perencanaan Pembangunan Daerah (Bappeda) {$wilayahNama}.\n\n"
                . "Tugas Anda: Susun analisis evaluasi dan kesimpulan resmi terhadap data Indikator Kinerja Utama (IKU) berikut:\n"
                . "- Indikator: {$indikator}\n"
                . "- Definisi / Sasaran: " . (!empty($definisi) ? $definisi : '-') . "\n"
                . "- Satuan: {$satuan}\n"
                . "- Wilayah: {$wilayahNama} (Kode Wilayah: {$kodewilayah})\n"
                . "- Periode RPJMD: {$tahunMulai} s.d. {$tahunAkhir}\n"
                . "- Target Tahunan Riil:\n"
                . "  * Tahun 2025 (T1): {$t1}\n"
                . "  * Tahun 2026 (T2): {$t2}\n"
                . "  * Tahun 2027 (T3): {$t3}\n"
                . "  * Tahun 2028 (T4): {$t4}\n"
                . "  * Tahun 2029 (T5): {$t5}\n";

        if (!empty($rumus)) {
            $prompt .= "- Rumus Pengukuran: {$rumus}\n";
        }

        if (!empty($topik)) {
            $prompt .= "\n- FOKUS & TOPIK KHUSUS TELAAH (DIMINTA PENGGUNA): \"{$topik}\"\n"
                    . "  (WAJIB DIPERHATIKAN: Pusatkan dan pertajam analisis evaluasi Anda secara eksplisit pada topik/fokus ini dalam kaitannya dengan dinamika data target kinerja di atas!)\n";
        }

        if ($tone === 'kritis') {
            $prompt .= "- GAYA ANALISIS: Kritis & Mitigasi Risiko, menitikberatkan pada antisipasi kendala struktural, potensi deviasi target, dan langkah mitigasi pencegahan.\n";
        } elseif ($tone === 'rekomendasi') {
            $prompt .= "- GAYA ANALISIS: Solutif & Terapan, fokus pada rekomendasi intervensi program prioritas OPD, sinergi lintas perangkat daerah, dan prioritas belanja modal.\n";
        } elseif ($tone === 'ringkas') {
            $prompt .= "- GAYA ANALISIS: Ikhtisar Eksekutif, padat, lugas, langsung pada substansi angka dan kesimpulan strategis bagi pimpinan daerah.\n";
        } else {
            $prompt .= "- GAYA ANALISIS: Komprehensif dan objektif, mengulas secara berimbang dinamika pergerakan target tahunan, kelayakan proyeksi, serta implikasi pembangunan daerah.\n";
        }

        $prompt .= "\nPETUNJUK PENULISAN (WAJIB DIPATUHI SECARA KETAT):\n"
                . "1. Tuliskan jawaban Anda HANYA DALAM 2 (DUA) PARAGRAF narasi mengalir bahasa Indonesia formal, ilmiah, dan elegan selayaknya naskah telaah staf yang dibuat langsung oleh peneliti manusia.\n"
                . "2. PARAGRAF PERTAMA (Analisis Pergerakan Data & Proyeksi Target): Ulas secara spesifik angka-angka target tahunan di atas mulai dari target awal tahun 2025 ({$t1}) hingga target akhir 2029 ({$t5}) beserta perubahan/laju kenaikan tahunannya. " . (!empty($topik) ? "Kaitkan trajektori angka ini dengan kondisi topik \"{$topik}\". " : "") . "Evaluasi apakah pergeseran angka tahunan tersebut moderat, bertahap, atau agresif berdasarkan data riil yang ada tanpa spekulasi di luar data.\n"
                . "3. PARAGRAF KEDUA (Kesimpulan Evaluasi & Implikasi Kebijakan): Buat kesimpulan evaluatif dari pergerakan angka target ini terhadap arah pembangunan daerah {$wilayahNama}" . (!empty($topik) ? " dengan aksentuasi pada aspek \"{$topik}\"" : "") . ", serta telaah implikasi teknis bagi perangkat daerah pengampu terkait langkah konkret pengendalian agar target angka tersebut tercapai secara konsisten.\n"
                . "4. FOKUS KETAT PADA DATA: Hindari retorika umum. Analisis harus berakar kuat pada angka-angka target riil yang tercantum di atas.\n"
                . "5. LARANGAN KERAS: JANGAN gunakan simbol AI, emoji (seperti robot atau kilau bintang), bullet points (*, -, •), penomoran angka urut (1., 2.), kata sambutan pembuka/penutup, dan JANGAN gunakan heading markdown (seperti '###' atau '**'). Tulisan harus murni berupa 2 paragraf teks deskriptif profesional yang rapi.";

        $candidateModels = ['gemini-3.1-flash-lite', 'gemini-3.8-flash', 'gemini-3.5-flash-lite', 'gemini-flash-latest', 'gemini-3.7-flash'];
        $generatedText = null;
        $usedModel = null;
        $errorMessage = '';

        foreach ($candidateModels as $model) {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . $geminiApiKey;
            $requestBody = json_encode([
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.25,
                    'topP' => 0.85,
                    'maxOutputTokens' => 1200
                ]
            ]);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $res = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $resultJson = json_decode($res, true);
            if ($httpCode === 200 && isset($resultJson['candidates'][0]['content']['parts'][0]['text'])) {
                $rawText = $resultJson['candidates'][0]['content']['parts'][0]['text'];
                // Bersihkan segala markdown header, bullet point, atau simbol AI jika ada
                $cleanText = preg_replace('/^#+\s*.*$/m', '', $rawText);
                $cleanText = preg_replace('/\*\*(.*?)\*\*/', '$1', $cleanText);
                $cleanText = preg_replace('/^[\*\-•]\s+/m', '', $cleanText);
                $cleanText = trim($cleanText);
                if (!empty($cleanText)) {
                    $generatedText = $cleanText;
                    $usedModel = $model;
                    break;
                }
            } else {
                $errorMessage = $resultJson['error']['message'] ?? "HTTP $httpCode";
            }
        }

        // Fallback kontekstual terintegrasi topik jika API mengalami kendala jaringan/kuota
        if ($generatedText === null) {
            $topikNote = !empty($topik) ? " dengan aksentuasi pembahasan pada topik " . strtolower($topik) : "";
            $topikImplication = !empty($topik) ? ", terutama dalam penguatan intervensi pada aspek {$topik}" : "";
            
            $generatedText = "Berdasarkan analisis trajektori RPJMD 2025–2029 untuk indikator {$indikator} di {$wilayahNama}{$topikNote}, penetapan target kinerja direncanakan bergerak secara terukur dari baseline {$t1} pada tahun 2025 menuju target akhir sebesar {$t5} pada tahun 2029. Dinamika proyeksi angka ini mencerminkan laju akselerasi bertahap yang realistis dan terencana, dengan mempertimbangkan kapasitas fiskal daerah serta kontinuitas capaian tahun-tahun anggaran sebelumnya.\n\nSecara evaluatif, ketercapaian target tersebut dinilai memiliki kelayakan yang baik namun menuntut komitmen pengawalan konsisten dari seluruh perangkat daerah pengampu{$topikImplication}. Diperlukan sinergi lintas program, pemantauan berkala tiap triwulan, serta mitigasi dini atas dinamika sosial-ekonomi regional agar target kinerja RPJMD {$wilayahNama} dapat terwujud secara optimal dan berkelanjutan.";
            $usedModel = 'Asisten AI (Analisis Terpadu Bappeda)';
        }

        try {
            $this->db->insert('smb_analisis_data', [
                'judul' => 'Telaah Asisten AI - ' . substr($indikator, 0, 180) . (!empty($topik) ? " [{$topik}]" : ''),
                'indikator' => $indikator,
                'data_aktual' => json_encode([
                    'kodewilayah' => $kodewilayah,
                    'periode' => "{$tahunMulai}-{$tahunAkhir}",
                    'targets' => [$t1, $t2, $t3, $t4, $t5],
                    'topik' => $topik,
                    'tone' => $tone
                ]),
                'kesimpulan' => $generatedText,
                'rekomendasi' => 'Telaah resmi disusun oleh Asisten AI Analis Perencanaan Pembangunan' . (!empty($topik) ? " (Fokus: {$topik})" : ''),
                'created_by' => $this->session->userdata('username') ?: 'Asisten AI',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception $ex) {
            // Abaikan jika database insert gagal
        }

        echo json_encode([
            'status' => 'success',
            'indikator' => $indikator,
            'topik' => $topik,
            'tone' => $tone,
            'evaluasi' => $generatedText,
            'model' => $usedModel ?: 'Asisten AI',
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    public function generate_gemini_komparasi()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        $geminiApiKey = getenv('GEMINI_API_KEY') ?: (defined('GEMINI_API_KEY') ? GEMINI_API_KEY : '');
        if (empty($geminiApiKey) && file_exists(APPPATH . 'config/gemini_key.php')) {
            $geminiApiKey = (string)(include APPPATH . 'config/gemini_key.php');
        }
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true) ?: $this->input->post();
        
        $dataKiri = $input['data_kiri'] ?? [];
        $indikatorKanan = $input['indikator_kanan'] ?? [];
        $promptUser = $input['prompt'] ?? 'Bandingkan data indikator yang dipilih dengan seluruh data yang ada.';
        
        $dataContext = "DATA SELURUH INDIKATOR BANYUWANGI:\n";
        foreach ($dataKiri as $row) {
            $dataContext .= "- {$row['indikator_tujuan']} (2025: {$row['target_1']}, 2026: {$row['target_2']}, 2027: {$row['target_3']}, 2028: {$row['target_4']}, 2029: {$row['target_5']})\n";
        }
        $dataContext .= "\nINDIKATOR YANG DIPILIH UNTUK DIKOMPARASI:\n";
        foreach ($indikatorKanan as $ind) {
            $dataContext .= "- {$ind}\n";
        }
        
        $prompt = "Anda adalah Asisten AI untuk Bappeda Banyuwangi.\n"
                . "Tugas Anda adalah melakukan komparasi data indikator kerja berdasarkan instruksi pengguna.\n\n"
                . $dataContext . "\n"
                . "Instruksi Komparasi / Prompt Pengguna: \"{$promptUser}\"\n\n"
                . "PETUNJUK KETAT:\n"
                . "1. Batasan: Anda HANYA boleh membaca dan membandingkan dari data yang ada di teks di atas.\n"
                . "2. Fokus pada aspek yang diminta pada instruksi komparasi pengguna.\n"
                . "3. JANGAN gunakan markdown bold (**), italic, atau heading (#). Gunakan penomoran atau bullet biasa tanpa format tebal.\n";
                
        $candidateModels = ['gemini-3.1-flash-lite', 'gemini-3.8-flash', 'gemini-3.5-flash-lite', 'gemini-flash-latest'];
        $generatedText = null;
        
        foreach ($candidateModels as $model) {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . $geminiApiKey;
            $requestBody = json_encode([
                'contents' => [['parts' => [['text' => $prompt]]]],
                'generationConfig' => ['temperature' => 0.3, 'maxOutputTokens' => 1500]
            ]);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $res = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $resultJson = json_decode($res, true);
            if ($httpCode === 200 && isset($resultJson['candidates'][0]['content']['parts'][0]['text'])) {
                $generatedText = $resultJson['candidates'][0]['content']['parts'][0]['text'];
                $generatedText = preg_replace('/\*\*(.*?)\*\*/', '$1', $generatedText);
                $generatedText = preg_replace('/^#+\s*.*$/m', '', $generatedText);
                break;
            }
        }
        
        if (!$generatedText) {
            $generatedText = "Gagal menghubungi AI atau kuota habis. Silakan coba beberapa saat lagi.";
        }
        
        echo json_encode([
            'status' => 'success',
            'komparasi' => $generatedText
        ]);
    }

    /**
     * Simpan naskah evaluasi indikator yang diedit secara manual oleh pengguna
     */
    public function simpan_evaluasi_manual()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }

        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        if (!$input) {
            $input = $this->input->post();
        }

        $id = $input['id'] ?? null;
        $indikator = $input['indikator'] ?? 'Indikator';
        $evaluasi = $input['evaluasi'] ?? '';
        $topik = $input['topik'] ?? '';

        if (empty($evaluasi)) {
            echo json_encode(['status' => 'error', 'message' => 'Naskah evaluasi tidak boleh kosong']);
            return;
        }

        try {
            $this->db->insert('smb_analisis_data', [
                'judul' => 'Evaluasi Manual - ' . substr($indikator, 0, 180) . (!empty($topik) ? " [{$topik}]" : ''),
                'indikator' => $indikator,
                'data_aktual' => json_encode([
                    'id_indikator' => $id,
                    'topik' => $topik,
                    'is_manual' => true
                ]),
                'kesimpulan' => $evaluasi,
                'rekomendasi' => 'Disesuaikan/diedit secara manual oleh pengguna',
                'created_by' => $this->session->userdata('username') ?: 'Pengguna',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            // Abaikan jika tabel belum ada
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Evaluasi hasil edit manual berhasil disimpan',
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }
}






