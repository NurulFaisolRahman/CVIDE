<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		}
		else {
			$Akun = $User->result_array();
			if (password_verify($_POST['Password'], $Akun[0]['Password'])) {
        if ($Akun[0]['Level'] == 1) {
          $Session = array('SuperAdmin' => true,
                           'Username' => $Akun[0]['Username'],
                           'Kegiatan' => '');
          $this->session->set_userdata($Session);
          echo '1';
        } else if ($Akun[0]['Level'] == 2) {
          $Session = array('Admin' => true,
                           'Username' => $Akun[0]['Username'],
                           'Kegiatan' => '');
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

  public function RenjaBanyuwangi(){
    $this->load->view('RenjaBanyuwangi');
  }

   public function KabupatenPonorogo(){
    $this->load->view('KabupatenPonorogo');
  }

  public function RenstraBanyuwangi(){
    $this->load->view('RenstraBanyuwangi');
  }

  public function RenstraSitubondo(){
    $this->load->view('RenstraSitubondo');
  }
}