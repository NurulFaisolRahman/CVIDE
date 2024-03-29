<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surveyor extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Surveyor')){
			redirect(base_url()); 
		}
  } 

  public function index(){
    $this->load->view('Surveyor/Header');
		$this->load->view('Surveyor/Profil');
  }
  // $2y$10$nhEvPNxmjSLuZMzDn6y5QuFOqDN6gXcN5sPrLMba8I.wVbECFkqda 12345678
  public function GantiPassword(){
    $this->db->where('NIK', $this->session->userdata('NIK'));
    $this->db->update('surveyor', array('Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT)));
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengganti Password!';
    }
  }

  public function PKPM(){
    $this->load->view('Surveyor/Header');
		$this->load->view('Surveyor/PKPM');
  }

  public function PendampingBPNT(){
    $this->load->view('Surveyor/Header');
		$this->load->view('Surveyor/PendampingBPNT');
  }

  public function BankPenyalur(){
    $this->load->view('Surveyor/Header');
		$this->load->view('Surveyor/BankPenyalur');
  }

  public function EWarung(){
    $this->load->view('Surveyor/Header');
		$this->load->view('Surveyor/EWarung');
  }

  public function DesaBBM(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/DesaBBM',$Data);
  }

  public function DampakBBM(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/DampakBBM',$Data);
  }

	public function SurveiBPD(){
    $Data['Provinsi'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE length(Kode) = 2")->result_array();
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiBPD',$Data);
  }
  
  public function SurveiKinerjaPemDes(){
    $Data['Provinsi'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE length(Kode) = 2")->result_array();
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
    $this->load->view('Surveyor/SurveiKinerjaPemDes',$Data);
  }

  public function SurveiKinerjaAparatur(){
    $Data['Provinsi'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE length(Kode) = 2")->result_array();
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiKinerjaAparatur',$Data);
  }

  public function InputPKPM(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('pkpm',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function InputPendampingBPNT(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('pendampingbpnt',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function InputBankPenyalur(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('bankpenyalur',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function InputEWarung(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('ewarung',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function InputDesaBBM(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('desabbm',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function InputDampakBBM(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('dampakbbm',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function Input($Tabel){
    if ($this->db->get_where($Tabel, array('Desa' => $_POST['Desa'], 'Tahun' => $_POST['Tahun']))->num_rows() === 0){
      $_POST['NIK'] = $this->session->userdata('NIK');
      $this->db->insert($Tabel,$_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Menyimpan Survei!';
      }
    } else {
      $Desa = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode = "."'".$_POST['Desa']."'")->row_array()['Nama'];
      echo 'Data Survei Desa '.$Desa.' Tahun '.$_POST['Tahun'].' Sudah Ada!';
    }
  }

  public function SurveiIPM(){
		// $Data['Provinsi'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE length(Kode) = 2")->result_array();
    // $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.%' AND length(Kode) = 5")->result_array();
    // $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.%' AND length(Kode) = 8")->result_array();
    // $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '11.01.01.%'")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.01.%'")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiIPM',$Data);
  }

  public function InputIPM(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('surveiipm',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function SurveiHargaKonsumenPerdesaan(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.24.%' AND length(Kode) = 8")->result_array();
    // $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.24.01.%'")->result_array();
    $Data['Data'] = $this->db->query("SELECT kodewilayah.Nama as NamaKecamatan,ntpkonsumen.* FROM kodewilayah,ntpkonsumen WHERE ntpkonsumen.Kecamatan=kodewilayah.Kode AND NIK = ".$this->session->userdata('NIK')." ORDER BY TanggalSurvei DESC")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiHargaKonsumenPerdesaan',$Data);
  }

  public function InputNTPKonsumen(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('ntpkonsumen',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function EditNTPKonsumen(){
    $this->db->where('Id',$_POST['Id']);
    unset($_POST['Id']);
    $this->db->update('ntpkonsumen', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data Survei!';
    }
  }

  public function CopyNTPKonsumen(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('ntpkonsumen',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function SurveiHargaProdusenPerdesaan(){
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.24.%' AND length(Kode) = 8")->result_array();
    // $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.24.01.%'")->result_array();
    $Data['Data'] = $this->db->query("SELECT kodewilayah.Nama as NamaKecamatan,ntpprodusen.* FROM kodewilayah,ntpprodusen WHERE ntpprodusen.Kecamatan=kodewilayah.Kode AND NIK = ".$this->session->userdata('NIK')." ORDER BY TanggalSurvei DESC")->result_array();
    $this->load->view('Surveyor/Header',$Data);
		$this->load->view('Surveyor/SurveiHargaProdusenPerdesaan',$Data);
  }

  public function InputNTPProdusen(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('ntpprodusen',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function CopyNTPProdusen(){
    $_POST['NIK'] = $this->session->userdata('NIK');
    $this->db->insert('ntpprodusen',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Survei!';
    }
  }

  public function EditNTPProdusen(){
    $this->db->where('Id',$_POST['Id']);
    unset($_POST['Id']);
    $this->db->update('ntpprodusen', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data Survei!';
    }
  }

  public function NTPProdusen(){
    $ITDasar = $IBDasar = $ITSeries = $IBSeries = $NTPSeries = array();
    for ($j=1; $j <= 6; $j++) { 
      $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga,_Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE '2022-0".$j."%'")->result_array();    
      $Data['NTPTanamanPangan'] = $Data['NTPHortikultura'] = $Data['NTPPerkebunan'] = $Data['NTPPeternakan'] = $Data['NTPPerikanan'] = $Data['NTP'] = 0;
      if (count($DataProdusen) > 0) {
        $TempITSeries = $TempIBSeries = $TempNTPSeries = array();
        $ITHargaNTP = $IT_HargaNTP = $IBHargaNTP = $IB_HargaNTP = 0;
        $KodeITTanamanPangan = array('IA001001','IA001002','IA001003','IA001004','IA001005','IA001006','IA002001','IA002002','IA002003','IA002004','IA002005','IA002006','IA003001','IA003002','IA003003','IA003004','IA003005','IA003006','IA004001','IA004002','IA005001','IA005002','IB001001','IB001002','IB002001','IB002002','IB001003','IB003001','IB005001','IB005002','IB006001','IB006002','IB007001','IB007002','IB008001','IB008002','IB008003','IB009001','IB009002','IB010001','IB011001','IB012001');  
        $KodeIBTanamanPangan = array('JA101001','JA101002','JA101003','JA101004','JA102001','JA102002','JA102003','JA102004','JA201001','JA201002','JA202001','JA203001','JA204001','JA205001','JA206001','JA207001','JA208001','JB001001','JB001002','JB001003','JB002001','JB002002','JB004001','JB005001','JB006001','JB007001','JB008001','JB011001','JB012001','JB012002','JB012003','JB013001','JB014001','JB015001','JB101001','JB101002','JB101003','JB102001','JB102002','JB102003','JB103001','JB103002','JB103003','JB104001','JB104002','JB104003','JB105001','JB105002','JB105003','JB106001','JB106002','JB106003','JB107001','JB107002','JC001001','JC001002','JC001003','JC002001','JC002002','JC002003','JC006001','JC007001','JC007002','JC008001','JC008002','JC009001','JC009002','JC010001','JC011001','JC013001','JC014001','JC015001','JC016001','JC017001','JD001001','JD001002','JD001003','JD002001','JD002002','JD002003','JD002004','JD003002','JD003003','JD003004','JD003005','JD004001','JD004002','JD005001','JD005002','JD005003','JD006001','JD006002','JD006003','JD007001','JD007002','JD008001','JD008002','JD010001','JD010002','JD011001','JD011002','JD012001','JD013001','JD014001','JD016001','JD016002','JD017001','JD017002','JD018001','JF001001','JF002001','JF002002','JF003001','JF003002','JF004001','JF005001','JF005002','JF006001','JF006002','JF007001','JF008001','JF009001','JF009002','JF010001','JF010002','JF011001','JF012001','JF013001','JF016001','JF017001','JF017002','JF018001','JF019001','JF019002','JF020001','JF023001','JF024001','JF025001','JF026001','JF027001','JF028001','JF029001','JF030001','JF031001','JF032001','JF033001','JF034001','JF035001','JG003001','JG004001','JG005001','JG005002','JG006001','JG007001','JG009001','JG009002','JG011001','JG011002','JG012001','JG012002','JG013001','JG013002','JG014001','JG015001','JG016001','JG017001','KA101101','KA101102','KA101103','KA201101','KA201102','KA201103','KA301101','KA301102','KA301103','KA401101','KA401102','KA401103','KA501101','KA501102','KA501103','KA601101','KA601102','KA601103','KA701101','KA701102','KA701103','KA801101','KA801102','KA801103','KA901101','KA901102','KA901103','KA911101','KA911102','KA911103','KA921101','KA921102','KA921103','KA941101','KA941102','KA941103','KA951101','KA951102','KA951103','KA961101','KA961102','KA961103');
        $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          $_Harga = explode("|",$key['_Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeITTanamanPangan)) {
              $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$_Harga[$i];
            }
            else if (in_array($Pisah[$i],$KodeIBTanamanPangan)) {
              $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$_Harga[$i];
            } 
          }
        }
        if (count($ITDasar)!=6) {
          $ITTanamanPangan = $ITHarga/$ITHarga*100;
          $IBTanamanPangan = $IBHarga/$IBHarga*100;
          $ITHargaNTP += $ITHarga;$IT_HargaNTP += $ITHarga;
          $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IBHarga;
          array_push($ITDasar,$ITHarga);array_push($IBDasar,$IBHarga);
        } else {
          $ITTanamanPangan = $ITHarga/$ITDasar[0]*100;
          $IBTanamanPangan = $IBHarga/$IBDasar[0]*100;
          $ITHargaNTP += $ITHarga;$IT_HargaNTP += $IT_Harga;
          $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IB_Harga;
        }
        $Data['NTPTanamanPangan'] = $ITTanamanPangan/$IBTanamanPangan*100;
        array_push($TempITSeries,$ITTanamanPangan);array_push($TempIBSeries,$IBTanamanPangan);array_push($TempNTPSeries,$Data['NTPTanamanPangan']); 
        $KodeITHortikultura = array('XA001001','XA002001','XA002002','XA002003','XA003001','XA004001','XA005001','XA006001','XA007001','XA007002','XA008001','XA009001','XA010001','XA010002','XA011001','XA012001','XA013001','XA014001','XA014002','XA015001','XA016001','XA016002','XA017001','XA019001','XA020001','XA022001','XA024001','XA025001','XA026001','XA027001','XA028001','XA029001','XA030001','XA031001','XA032001','XA033001','XA034001','XA035001','XA036001','XA037001','XA038001','XA039001','XB001001','XB001002','XB001003','XB002001','XB002002','XB003001','XB003002','XB004001','XB005001','XB005002','XB006001','XB006002','XB007001','XB007002','XB007003','XB008001','XB008002','XB008003','XB009001','XB009002','XB009003','XB009004','XB009005','XB010001','XB010002','XB010003','XB010004','XB010005','XB012001','XB013001','XB013002','XB014001','XB014002','XB014003','XB015001','XB016001','XB016002','XB016003','XB017001','XB018001','XB018002','XB019001','XB019002','XB019003','XB020001','XB020002','XB021001','XB021002','XB021003','XB022001','XB022002','XB023001','XB023002','XB023003','XB023004','XB024001','XB026001','XB027001','XB028001','XB029001','XB030001','XB031001','XB032001','XB033001','XB034001','XB035001','XD001001','XD002001','XD003001','XD004001','XD005001','XD007001','XD008001','XD009001','XD010001','XD011001','XD012001');  
        $KodeIBHortikultura = array('YA101001','YA101002','YA101003','YA102001','YA102002','YA103001','YA104001','YA105001','YA106001','YA107001','YA108001','YA109001','YA110001','YA111001','YA112001','YA113001','YA114001','YA115001','YA116001','YA117001','YA118001','YA119001','YA121001','YA122001','YA161001','YA163001','YA164001','YA165001','YA166001','YA167001','YA201001','YA201002','YA202001','YA202002','YA203001','YA203002','YA203003','YA204001','YA204002','YA204003','YA204004','YA205001','YA206001','YA206002','YA207001','YA207002','YA207003','YA208001','YA208002','YA209001','YA211001','YA211002','YA212001','YA212002','YA262001','YA263001','YA264001','YA265001','YA266001','YA267001','YA268001','YA401001','YA402001','YA403001','YA405001','YA408001','YA409001','YA410001','YB001001','YB001002','YB001003','YB002001','YB002002','YB004001','YB005001','YB006001','YB007001','YB008001','YB011001','YB016001','YB601001','YB601002','YB601003','YB602001','YB603001','YB604001','YB605001','YB101001','YB101002','YB101003','YB102001','YB102002','YB103001','YB103002','YB104001','YB104002','YB105001','YB105002','YB106001','YB106002','YB107001','YB108001','YB109001','YC001001','YC001002','YC001003','YC002001','YC002002','YC002003','YC006001','YC006002','YC007001','YC007002','YC009001','YC009002','YC010001','YC011001','YC601001','YC602001','YD001001','YD001002','YD001003','YD002001','YD002003','YD002004','YD002002','YD003002','YD003003','YD003004','YD003005','YD004001','YD004002','YD005001','YD005002','YD006001','YD006002','YD007001','YD007002','YD008001','YD008002','YD011001','YD012001','YD012002','YD012003','YD013001','YD013002','YD013003','YD014001','YD014002','YD014003','YD015001','YD015002','YD017001','YD017002','YD017003','YD018001','YF001001','YF003001','YF004001','YF005001','YF006001','YF006002','YF007001','YF008001','YF009001','YF009002','YF011001','YF012001','YF016001','YF017001','YF017002','YF018001','YF019001','YF019002','YF020001','YF022001','YF023001','YF024001','YF025001','YF026001','YF027001','YF028001','YF031001','YF033001','YF601001','YF603001','YF605001','YF607001','YF607002','YF999001','YF100001','YG003001','YG004001','YG006001','YG007001','YG009001','YG009002','YG009003','YG012001','YG013001','YG015001','YG015002','YG016001','ZA101101','ZA101102','ZA101103','ZA201101','ZA201102','ZA201103','ZA301101','ZA301102','ZA301103','ZA401101','ZA401102','ZA401103','ZA501101','ZA501102','ZA501103','ZA601101','ZA601102','ZA601103','ZA701101','ZA701102','ZA701103','ZA801101','ZA801102','ZA801103','ZA901101','ZA901102','ZA901103','ZA921101','ZA921102','ZA921103');
        $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          $_Harga = explode("|",$key['_Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeITHortikultura)) {
              $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$_Harga[$i];
            }
            else if (in_array($Pisah[$i],$KodeIBHortikultura)) {
              $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$_Harga[$i];
            } 
          }
        }
        if (count($ITDasar)!=6) {
          $ITHortikultura = $ITHarga/$ITHarga*100;
          $IBHortikultura = $IBHarga/$IBHarga*100;
          $ITHargaNTP += $ITHarga;$IT_HargaNTP += $ITHarga;
          $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IBHarga;
          array_push($ITDasar,$ITHarga);array_push($IBDasar,$IBHarga);
        } else {
          $ITHortikultura = $ITHarga/$ITDasar[1]*100;
          $IBHortikultura = $IBHarga/$IBDasar[1]*100;
          $ITHargaNTP += $ITHarga;$IT_HargaNTP += $IT_Harga;
          $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IB_Harga;
        }
        $Data['NTPHortikultura'] = $ITHortikultura/$IBHortikultura*100;
        array_push($TempITSeries,$ITHortikultura);array_push($TempIBSeries,$IBHortikultura);array_push($TempNTPSeries,$Data['NTPHortikultura']); 
        $KodeITPerkebunan = array('LA001001','LA001002','LA002001','LA002002','LA004001','LA004002','LA005001','LA006001','LA006002','LA006003','LA008001','LA011001','LA011002','LA012001','LA012002','LA013001','LA014001','LA017001','LA017002','LA019001','LA020001','LA021001','LA022001','LA023001','LA026001','LA027001','LA029001','LA031001','LA032001','LA033001','LA007001','LA009001','LA009002','LA018001','LA025001','LA028001','LA030001');  
        $KodeIBPerkebunan = array('MA001001','MA001002','MA001003','MA002001','MA002002','MA002003','MA003001','MA004001','MA005001','MA006001','MA007001','MA008001','MA009001','MA010001','MA011001','MA012001','MA015001','MA017001','MA018001','MA019001','MB001001','MB001002','MB001003','MB002001','MB002002','MB004001','MB005001','MB005002','MB006001','MB007001','MB007002','MB007003','MB008001','MB011001','MB013001','MB014001','MB015002','MB015001','MB015003','MB016001','MB017001','MB018001','MB101001','MB101002','MB101003','MB101004','MB102001','MB102002','MB102003','MB103001','MB103002','MB103003','MB104001','MB104002','MB105001','MB105002','MB106001','MB106002','MC001001','MC001002','MC001003','MC003001','MC004001','MC004002','MC005001','MC005002','MC007001','MC008001','MC009001','MC010001','MC011001','MD001001','MD001002','MD001003','MD001004','MD002001','MD002002','MD002003','MD002004','MD003002','MD003003','MD003004','MD003005','MD004001','MD004002','MD005001','MD005002','MD005003','MD006001','MD006002','MD007001','MD007002','MD008001','MD008002','MD009001','MD009002','MD011001','MD011002','MD012001','MD012002','MD013001','MD014001','MD014002','MD014003','MD015001','MD015002','MD015003','MD017001','MD019001','MD019002','MD019003','MD019004','MD020001','MD020002','MD021001','MD022001','ME001001','ME002001','ME002002','ME002003','ME003001','ME003002','ME004001','ME004002','ME005001','ME005002','ME006001','ME007001','ME008001','ME009001','ME009002','ME009003','ME010001','ME011001','ME011002','ME012001','ME012002','ME013001','ME014001','ME015001','ME017001','ME019001','ME020001','ME021001','ME022001','ME023001','ME024001','ME025001','ME026001','ME602001','ME602002','ME602003','ME604001','ME605001','ME606001','ME607001','ME608001','ME609001','ME610001','ME611001','ME612001','ME613001','MF002001','MF002002','MF003001','MF006001','MF009001','MF009002','MF009003','MF012001','MF012002','MF602001','MF603001','MF606001','MF607001','NA101101','NA102101','NA103101','NA201101','NA202101','NA203101','NA301101','NA301102','NA301103','NA401101','NA401102','NA401103','NA501101','NA501102','NA501103','NA601101','NA601102','NA601103','NA701101','NA701102','NA701103','NA801101','NA801102','NA801103','NA901101','NA901102','NA901103','NA911101','NA911102','NA911103','NA921101','NA921102','NA921103','NA931101','NA931102','NA931103');
        $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          $_Harga = explode("|",$key['_Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeITPerkebunan)) {
              $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$_Harga[$i];
            }
            else if (in_array($Pisah[$i],$KodeIBPerkebunan)) {
              $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$_Harga[$i];
            } 
          }
        }
        if (count($ITDasar)!=6) {
          $ITPerkebunan = $ITHarga/$ITHarga*100;
          $IBPerkebunan = $IBHarga/$IBHarga*100;
          $ITHargaNTP += $ITHarga;$IT_HargaNTP += $ITHarga;
          $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IBHarga;
          array_push($ITDasar,$ITHarga);array_push($IBDasar,$IBHarga);
        } else {
          $ITPerkebunan = $ITHarga/$ITDasar[2]*100;
          $IBPerkebunan = $IBHarga/$IBDasar[2]*100;
          $ITHargaNTP += $ITHarga;$IT_HargaNTP += $IT_Harga;
          $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IB_Harga;
        }
        $Data['NTPPerkebunan'] = $ITPerkebunan/$IBPerkebunan*100;
        array_push($TempITSeries,$ITPerkebunan);array_push($TempIBSeries,$IBPerkebunan);array_push($TempNTPSeries,$Data['NTPPerkebunan']); 
        $KodeITPeternakan = array('OA001001','OA001002','OA001003','OA002001','OA002002','OA002003','OA002004','OA002005','OA002006','OA003001','OA003002','OA004001','OA004002','OA005002','OB001001','OB001002','OB001003','OB001004','OB002001','OB002002','OB002003','OB002004','OB003001','OB003002','OB003003','OB003004','OB003005','OB004001','OB004002','OB005001','OB006001','OC002001','OC002002','OC002003','OC002004','OC003001','OC005001','OC005002','OC005003','OC006001','OC007001','OC008001','OC009001','OC010001','OC011001','OD001001','OD006001','OD007001','OD008001','OD009001','OD010001','OD011001');  
        $KodeIBPeternakan = array('PA002001','PA002002','PA002003','PA003001','PA003002','PA005001','PA005002','PA006001','PA006002','PA007001','PA007002','PA601001','PA601002','PA602001','PA602002','PA615001','PA615002','PA615003','PA616001','PA616002','PA617001','PA617002','PA617003','PA618001','PA618002','PA619001','PA619002','PA620001','PA620002','PA621001','PA621002','PA622001','PA622002','PA623001','PA623002','PA624001','PA625001','PA626001','PA701001','PA701002','PA702001','PA702002','PA703001','PA703002','PA703003','PA704001','PA704002','PA705001','PA705002','PA706001','PA706002','PA707001','PB102001','PB102002','PB102003','PB102004','PB104001','PB105001','PB106001','PB107001','PB107002','PB107003','PB108001','PB109001','PB110001','PB113001','PB114001','PB116001','PB117001','PB122001','PB162001','PB164001','PB165001','PB165002','PB165003','PB166001','PB201001','PB201002','PB201003','PB201004','PB202001','PB202002','PB202003','PB202004','PB203001','PB203002','PB204001','PB204002','PB205001','PB205002','PB205003','PB206001','PB206002','PB208001','PB208002','PB209001','PB210001','PB210002','PB210003','PB210004','PB211001','PB212001','PB214001','PB215001','PB216001','PB217001','PB218001','PB219001','PB220001','PB221001','PB261001','PB262001','PB263001','PB264001','PB265001','PB266001','PB267001','PB268001','PB269001','PB270001','PC001001','PC002001','PC012001','PC601001','PC602001','PC603001','PD001001','PD001002','PD001003','PD001004','PD002001','PD002003','PD002004','PD002002','PD003002','PD003003','PD003004','PD003005','PD004001','PD004002','PD005001','PD005002','PD006001','PD006002','PD007001','PD007002','PD008001','PD009001','PD009002','PD014001','PD601001','PD601002','PD601003','PD602001','PE001001','PE001002','PE002001','PE002002','PE002003','PE003001','PE003002','PE003003','PE004001','PE004002','PE008001','PE008002','PE012001','PE012002','PE013001','PE013002','PE015001','PE016001','PE017001','PE018001','PE019001','PE020001','PE021001','PE023001','PE024001','PE025001','PE602001','PE602002','PE605001','PE606001','PE607001','PE608001','PE609001','PE610001','PE611001','PE612001','PE613001','PE614001','PE615001','PE616001','PE617001','PE618001','PE619001','PE620001','PF005001','PF006001','PF007001','PF008001','PF010001','PF010002','PF011001','PF012001','PF014001','PF015001','PF016001','PF016002','PF016003','PF017001','PF017002','PF018001','PF019001','PF019002','PF020001','PF020002','PF021001','PF022001','PF022002','PF023001','PF023002','PF024001','PF602001','PF602002','PF603001','PF604001','PF605001','PF606001','QA101101','QA101102','QA101103','QA301101','QA301102','QA301103','QA401101','QA401102','QA401103','QA501101','QA501102','QA501103','QA502101','QA502102','QA502103');
        $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          $_Harga = explode("|",$key['_Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeITPeternakan)) {
              $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$_Harga[$i];
            }
            else if (in_array($Pisah[$i],$KodeIBPeternakan)) {
              $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$_Harga[$i];
            } 
          }
        }
        if (count($ITDasar)!=6) {
          $ITPeternakan = $ITHarga/$ITHarga*100;
          $IBPeternakan = $IBHarga/$IBHarga*100;
          $ITHargaNTP += $ITHarga;$IT_HargaNTP += $ITHarga;
          $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IBHarga;
          array_push($ITDasar,$ITHarga);array_push($IBDasar,$IBHarga);
        } else {
          $ITPeternakan = $ITHarga/$ITDasar[3]*100;
          $IBPeternakan = $IBHarga/$IBDasar[3]*100;
          $ITHargaNTP += $ITHarga;$IT_HargaNTP += $IT_Harga;
          $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IB_Harga;
        }
        $Data['NTPPeternakan'] = $ITPeternakan/$IBPeternakan*100;
        array_push($TempITSeries,$ITPeternakan);array_push($TempIBSeries,$IBPeternakan);array_push($TempNTPSeries,$Data['NTPPeternakan']); 
        $KodeITPerikanan = array('RA001001','RA002001','RA003001','RA004001','RA006001','RA007001','RA007002','RA007003','RA007004','RA007005','RA007006','RA008001','RA009001','RA010001','RA011001','RA011002','RA011003','RA011004','RA011005','RA012001','RA014001','RA015001','RA019001','RA020001','RA021001','RA022001','RA023001','RA024001','RA501001','RA502001','RA503001','RA505001','RA507001','RA508001','RA509001','RA510001','RB001001','RB004001','RB005001','RB006001','RB008001','RB010001','RB011001','RB012001','RB013001','RB014001','RB016001','RB017001','RB020001','RB021001','RB023001','RB024001','RB028001','RB029001','RB030001','RB032001','RB035001','RB037001','RB039001','RB040001','RB042001','RB042002','RB042003','RB042004','RB042005','RB044001','RB046001','RB047001','RB048001','RB049001','RB050001','RB052001','RB053001','RB054001','RB055001','RB056001','RB057001','RB058001','RB059001','RB063001','RB065001','RB072001','RB072002','RB072003','RB072004','RB073001','RB076001','RB078001','RB080001','RB081001','RB082001','RB082002','RB083001','RB085001','RB086001','RB087001','RB092001','RB093001','RB094001','RB095001','RB096001','RB098001','RB099001','RB104001','RB106001','RB106002','RB106003','RB106004','RB106005','RB108001','RB109001','RB109002','RB109003','RB109004','RB109005','RB110001','RB111001','RB113001','RB114001','RB115001','RB115002','RB115003','RB117001','RB118001','RB127001','RB128001','RB131001','RB131002','RB501001','RB502001','TA002001','TA005001','TA006001','TA007001','TA009001','TA012001','TA012002','TA012003','TA012004','TA012005','TA012006','TA013001','TA014001','TA015001','TA017001','TA018001','TA019001','TA019002','TA019003','TA019004','TA019005','TA032001','TA033001','TB002001','TB002002','TB002003','TB003001','TB003002','TB003003','TB003004','TB003005','TB006001','TB006002','TB006003','TB006004','TB006005','TB006006','TB007001','TB011001','TB011002','TB013001','TB016002','TB016003','TB503001','TB504001','TB505001','TB506001','TB507001','TC001001','TC002001','TC003001','TC004001','TC005001','TC006001','TC007001','TC011001','TC011002','TC011003','TC011004','TC011005','TC012002','TC013001');  
        $KodeIBPerikanan = array('SA001001','SA001002','SA001003','SA001004','SA002001','SA002002','SA002003','SA002004','SA003001','SA003002','SA003003','SA003004','SA003005','SA004001','SA004002','SA004003','SA004004','SA005001','SB001001','SB001002','SB001003','SB001004','SB001005','SB001006','SB002001','SB002003','SB002004','SB002002','SB003002','SB003003','SB003004','SB003005','SB004001','SB004002','SB004003','SB005001','SB005002','SB005003','SB006001','SB006002','SB006003','SB007002','SB007003','SB008001','SB009001','SC001001','SC001002','SC001003','SC001004','SC002001','SC002002','SC002003','SC002004','SC003001','SC003002','SC003003','SC003004','SC003005','SC003006','SC004001','SC004002','SC004003','SC005001','SC005002','SC005003','SC006001','SC007001','SC007002','SC007003','SC007004','SC008001','SC009001','SC009002','SC009003','SC009004','SC009005','SC010001','SC010002','SC010003','SC010004','SC011001','SC011002','SC011003','SC011004','SC011005','SC011006','SC013001','SC014001','SC015001','SC016001','SC017001','SC018001','SC019001','SC019002','SC020001','SC020002','SC021001','SC022001','SC022002','SC023001','SC024001','SC025001','SC026001','SC027001','SC028001','SC029001','SC030001','SC031001','SC032001','SC033001','SC033002','SC033003','SC033004','SC034001','SC034002','SC034003','SC034004','SC034005','SC037001','SC038001','SC039001','SC040001','SC601001','SC601002','SC601003','SC602001','SC603001','SC603002','SC604001','SC605001','SE001001','SE002001','SE003001','SE004001','SE004002','SE004003','SE004004','SE005001','SE006001','SE006002','SE007001','SE007002','SE007003','SE007004','SE007005','SE007006','SE008001','SE009001','SE010001','SE011001','SE015001','SE016001','SE016002','SE016003','SE017001','SE017002','SE018001','SE019001','SE020001','SE021001','SE602001','SE603001','SE603002','SE604001','SE605001','SF101101','SF102101','SF103101','SF201101','SF202101','SF203101','SF301101','SF302101','SF303101','SF501101','SF502101','SF503101','SF401101','SF402101','SF403101','UA002001','UA004001','UA005001','UA006001','UA007001','UA011001','UA011002','UA011003','UA011004','UA011005','UA012001','UA013001','UA014001','UA016001','UA018001','UA018002','UA018003','UA018004','UA020001','UA021001','UA022001','UA023001','UA101001','UA101002','UA101003','UA102001','UA102002','UA102003','UA102004','UA102005','UA104001','UA104002','UA104003','UA104004','UA104005','UA105001','UA106001','UA161001','UA162001','UA163001','UA164001','UA165001','UA166001','UA201001','UA201002','UA201003','UA202001','UA203001','UA204001','UA205001','UA206001','UA210001','UA210002','UA210003','UA210004','UA210005','UA211001','UA212001','UA213001','UB001001','UB001002','UB001003','UB002001','UB002002','UB003001','UB004001','UB004002','UB004003','UB004004','UB005001','UB006001','UB061001','UB062001','UB063001','UB064001','UB101001','UB102001','UB103001','UB104001','UB104002','UB105001','UB106001','UB107001','UB108001','UB109001','UB110001','UB111001','UB112001','UB113001','UB201001','UB201002','UB202001','UB202002','UB203001','UB204001','UB205001','UB207001','UB208001','UB209001','UB210001','UB211001','UB212001','UB213001','UB262001','UB263001','UB265001','UB266001','UB267001','UC001001','UC601001','UC602001','UC603001','UD001001','UD001002','UD001003','UD001004','UD001005','UD001006','UD002001','UD002003','UD002004','UD002002','UD003002','UD003003','UD003004','UD003005','UD004001','UD004002','UD004003','UD005001','UD005002','UD005003','UD006001','UD006002','UE001001','UE001002','UE001003','UE001004','UE002001','UE002002','UE002003','UE002004','UE003001','UE003002','UE003003','UE003004','UE003005','UE003006','UE004001','UE004002','UE004003','UE004004','UE005001','UE007001','UE007002','UE007003','UE007004','UE008001','UE008002','UE008003','UE008004','UE008005','UE008006','UE010001','UE010002','UE010003','UE011001','UE012001','UE014001','UE015001','UE016001','UE017001','UE018001','UE019001','UE019002','UE020001','UE020002','UE021001','UE022001','UE022002','UE023001','UE024001','UE025001','UE026001','UE027001','UE028001','UE029001','UE030001','UE031001','UE032001','UE033001','UE601001','UE602001','UE603001','UE605001','UE606001','UE607002','UE608003','UE609001','UE610001','UE611001','UE612001','UE613001','UG002001','UG003001','UG004001','UG005001','UG005002','UG006001','UG006002','UG006003','UG007001','UG007002','UG007003','UG008001','UG604001','UG604002','UG605001','UG606001','UH201101','UH201102','UH201103','UH301101','UH301102','UH301103','UH401101','UH401102','UH401103','UH501101','UH501102','UH501103','UH601101','UH601102','UH601103','UH701101','UH701102','UH701103','UH011101','UH011102','UH011103');
        $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          $_Harga = explode("|",$key['_Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeITPerikanan)) {
              $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$_Harga[$i];
            }
            else if (in_array($Pisah[$i],$KodeIBPerikanan)) {
              $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$_Harga[$i];
            } 
          }
        }
        if (count($ITDasar)!=6) {
          $ITPerikanan = $ITHarga/$ITHarga*100;
          $IBPerikanan = $IBHarga/$IBHarga*100;
          $ITHargaNTP += $ITHarga;$IT_HargaNTP += $ITHarga;
          $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IBHarga;
          array_push($ITDasar,$ITHarga);array_push($IBDasar,$IBHarga);
          array_push($ITDasar,$ITHargaNTP);array_push($IBDasar,$IBHargaNTP);
        } else {
          $ITPerikanan = $ITHarga/$ITDasar[4]*100;
          $IBPerikanan = $IBHarga/$IBDasar[4]*100;
          $ITHargaNTP += $ITHarga;$IT_HargaNTP += $IT_Harga;
          $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IB_Harga;
        }
        $Data['NTPPerikanan'] = $ITPerikanan/$IBPerikanan*100;
        array_push($TempITSeries,$ITPerikanan);array_push($TempIBSeries,$IBPerikanan);array_push($TempNTPSeries,$Data['NTPPerikanan']);
        $ITNTP = $ITHargaNTP/$ITDasar[5]*100;
        $IBNTP = $IBHargaNTP/$IBDasar[5]*100;
        $Data['ITNTP'] = $ITNTP;
        $Data['IBNTP'] = $IBNTP;
        $Data['NTP'] = $ITNTP/$IBNTP*100;
        array_push($TempITSeries,$ITNTP);array_push($TempIBSeries,$IBNTP);array_push($TempNTPSeries,$Data['NTP']);
        array_push($ITSeries,$TempITSeries);array_push($IBSeries,$TempIBSeries);array_push($NTPSeries,$TempNTPSeries);
      } 
    }
    $Data['IT'] = $ITSeries;$Data['IB'] = $IBSeries;$Data['NTP'] = $NTPSeries;
    $this->load->view('Surveyor/Header');
		$this->load->view('Surveyor/NTPProdusen',$Data);
  }

  public function NTPProdusenHTD(){
    $ITSeries = $IBSeries = $NTPSeries = array();
    for ($k=1; $k <= 7; $k++) { 
      $DataProdusen = $this->db->query("SELECT Id,KodeKualitas,Harga,_Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE '2022-0".$k."%'")->result_array();    
      $Data['NTPTanamanPangan'] = $Data['NTPHortikultura'] = $Data['NTPPerkebunan'] = $Data['NTPPeternakan'] = $Data['NTPPerikanan'] = $Data['NTP'] = 0;
      if (count($DataProdusen) > 0) {
        $TempITSeries = $TempIBSeries = $TempNTPSeries = array();
        $ITHargaNTP = $IT_HargaNTP = $IBHargaNTP = $IB_HargaNTP = 0;
        $KodeITTanamanPangan = array('IA001001','IA001002','IA001003','IA001004','IA001005','IA001006','IA002001','IA002002','IA002003','IA002004','IA002005','IA002006','IA003001','IA003002','IA003003','IA003004','IA003005','IA003006','IA004001','IA004002','IA005001','IA005002','IB001001','IB001002','IB002001','IB002002','IB001003','IB003001','IB005001','IB005002','IB006001','IB006002','IB007001','IB007002','IB008001','IB008002','IB008003','IB009001','IB009002','IB010001','IB011001','IB012001');  
        $KodeIBTanamanPangan = array('JA101001','JA101002','JA101003','JA101004','JA102001','JA102002','JA102003','JA102004','JA201001','JA201002','JA202001','JA203001','JA204001','JA205001','JA206001','JA207001','JA208001','JB001001','JB001002','JB001003','JB002001','JB002002','JB004001','JB005001','JB006001','JB007001','JB008001','JB011001','JB012001','JB012002','JB012003','JB013001','JB014001','JB015001','JB101001','JB101002','JB101003','JB102001','JB102002','JB102003','JB103001','JB103002','JB103003','JB104001','JB104002','JB104003','JB105001','JB105002','JB105003','JB106001','JB106002','JB106003','JB107001','JB107002','JC001001','JC001002','JC001003','JC002001','JC002002','JC002003','JC006001','JC007001','JC007002','JC008001','JC008002','JC009001','JC009002','JC010001','JC011001','JC013001','JC014001','JC015001','JC016001','JC017001','JD001001','JD001002','JD001003','JD002001','JD002002','JD002003','JD002004','JD003002','JD003003','JD003004','JD003005','JD004001','JD004002','JD005001','JD005002','JD005003','JD006001','JD006002','JD006003','JD007001','JD007002','JD008001','JD008002','JD010001','JD010002','JD011001','JD011002','JD012001','JD013001','JD014001','JD016001','JD016002','JD017001','JD017002','JD018001','JF001001','JF002001','JF002002','JF003001','JF003002','JF004001','JF005001','JF005002','JF006001','JF006002','JF007001','JF008001','JF009001','JF009002','JF010001','JF010002','JF011001','JF012001','JF013001','JF016001','JF017001','JF017002','JF018001','JF019001','JF019002','JF020001','JF023001','JF024001','JF025001','JF026001','JF027001','JF028001','JF029001','JF030001','JF031001','JF032001','JF033001','JF034001','JF035001','JG003001','JG004001','JG005001','JG005002','JG006001','JG007001','JG009001','JG009002','JG011001','JG011002','JG012001','JG012002','JG013001','JG013002','JG014001','JG015001','JG016001','JG017001','KA101101','KA101102','KA101103','KA201101','KA201102','KA201103','KA301101','KA301102','KA301103','KA401101','KA401102','KA401103','KA501101','KA501102','KA501103','KA601101','KA601102','KA601103','KA701101','KA701102','KA701103','KA801101','KA801102','KA801103','KA901101','KA901102','KA901103','KA911101','KA911102','KA911103','KA921101','KA921102','KA921103','KA941101','KA941102','KA941103','KA951101','KA951102','KA951103','KA961101','KA961102','KA961103');
        $KodeITHTDTanamanPangan = array('IA001','IA002','IA003','IA004','IA005','IB001','IB003','IB005','IB006','IB007','IB008','IB009');
        $KodeIBHTDTanamanPangan = array('JA101','JA102','JA201','JA202','JA203','JA204','JA205','JA206','JA207','JB001','JB002','JB004','JB005','JB006','JB007','JB008','JB011','JB012','JB013','JB014','JB101','JB102','JB103','JB104','JB105','JB106','JB107','JC001','JC002','JC006','JC007','JC008','JC009','JC010','JC011','JC013','JC014','JC015','JD001','JD002','JD003','JD004','JD005','JD006','JD007','JD008','JD010','JD011','JD012','JD013','JD014','JD016','JD017','JD018','JF001','JF002','JF003','JF004','JF005','JF006','JF007','JF008','JF009','JF010','JF011','JF012','JF013','JF016','JF017','JF018','JF019','JF020','JF023','JF024','JF025','JF026','JF027','JF028','JF029','JF030','JF031','JF032','JF033','JF034','JG003','JG004','JG005','JG006','JG007','JG009','JG011','JG012','JG013','JG014','JG015','KA101','KA201','KA301','KA401','KA501','KA601','KA701','KA801','KA901','KA911','KA921','KA941','KA951','KA961');
        $HTDITTanamanPangan = array(400000,400000,350000,680000,750000,330000,1300000,710000,1300000,378000,227900,378000);
        $HTDIBTanamanPangan = array(12500,15000,75000,7000,10000,38000,10000,7000,4500,2300,3500,2500,6000,2300,30000,3000,5600,102700,5833,800,25000,144000,150000,106000,660000,210000,62900,3600000,20000000,0,500000,50000,90000,35000,75000,350000,60000,35000,125000,12000,5000,32500,148000,33000,41530,21804,540000,70000,70000,85000,80000,2000,0,52780,20000,2400,20000,450000,125000,8000,100000,850000,21000000,4870000,75000,185000,9680000,29600,7500,48000,26000,480250,20000,510000,315000,17500,87000,1315000,3000,18500,20650,125000,0,450000,450000,12870,580000,28000,30875,12500,7100,15560,1478,17500,50000,100000,100000,80000,80000,80000,80000,80000,100000,80000,80000,80000,80000,80000,80000);
        $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeITTanamanPangan)) {
              for ($j=0; $j < count($KodeITHTDTanamanPangan); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeITHTDTanamanPangan[$j]) {
                  $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$HTDITTanamanPangan[$j];
                }
              }
            }
            else if (in_array($Pisah[$i],$KodeIBTanamanPangan)) {
              for ($j=0; $j < count($KodeIBHTDTanamanPangan); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeIBHTDTanamanPangan[$j]) {
                  $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$HTDIBTanamanPangan[$j];
                }
              }
            } 
          }
        }
        $ITTanamanPangan = $ITHarga/$IT_Harga*100;
        $IBTanamanPangan = $IBHarga/$IB_Harga*100;
        $ITHargaNTP += $ITHarga;$IT_HargaNTP += $IT_Harga;
        $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IB_Harga;
        $Data['NTPTanamanPangan'] = $ITTanamanPangan/$IBTanamanPangan*100;
        array_push($TempITSeries,$ITTanamanPangan);array_push($TempIBSeries,$IBTanamanPangan);array_push($TempNTPSeries,$Data['NTPTanamanPangan']); 
        $KodeITHortikultura = array('XA001001','XA002001','XA002002','XA002003','XA003001','XA004001','XA005001','XA006001','XA007001','XA007002','XA008001','XA009001','XA010001','XA010002','XA011001','XA012001','XA013001','XA014001','XA014002','XA015001','XA016001','XA016002','XA017001','XA019001','XA020001','XA022001','XA024001','XA025001','XA026001','XA027001','XA028001','XA029001','XA030001','XA031001','XA032001','XA033001','XA034001','XA035001','XA036001','XA037001','XA038001','XA039001','XB001001','XB001002','XB001003','XB002001','XB002002','XB003001','XB003002','XB004001','XB005001','XB005002','XB006001','XB006002','XB007001','XB007002','XB007003','XB008001','XB008002','XB008003','XB009001','XB009002','XB009003','XB009004','XB009005','XB010001','XB010002','XB010003','XB010004','XB010005','XB012001','XB013001','XB013002','XB014001','XB014002','XB014003','XB015001','XB016001','XB016002','XB016003','XB017001','XB018001','XB018002','XB019001','XB019002','XB019003','XB020001','XB020002','XB021001','XB021002','XB021003','XB022001','XB022002','XB023001','XB023002','XB023003','XB023004','XB024001','XB026001','XB027001','XB028001','XB029001','XB030001','XB031001','XB032001','XB033001','XB034001','XB035001','XD001001','XD002001','XD003001','XD004001','XD005001','XD007001','XD008001','XD009001','XD010001','XD011001','XD012001');  
        $KodeIBHortikultura = array('YA101001','YA101002','YA101003','YA102001','YA102002','YA103001','YA104001','YA105001','YA106001','YA107001','YA108001','YA109001','YA110001','YA111001','YA112001','YA113001','YA114001','YA115001','YA116001','YA117001','YA118001','YA119001','YA121001','YA122001','YA161001','YA163001','YA164001','YA165001','YA166001','YA167001','YA201001','YA201002','YA202001','YA202002','YA203001','YA203002','YA203003','YA204001','YA204002','YA204003','YA204004','YA205001','YA206001','YA206002','YA207001','YA207002','YA207003','YA208001','YA208002','YA209001','YA211001','YA211002','YA212001','YA212002','YA262001','YA263001','YA264001','YA265001','YA266001','YA267001','YA268001','YA401001','YA402001','YA403001','YA405001','YA408001','YA409001','YA410001','YB001001','YB001002','YB001003','YB002001','YB002002','YB004001','YB005001','YB006001','YB007001','YB008001','YB011001','YB016001','YB601001','YB601002','YB601003','YB602001','YB603001','YB604001','YB605001','YB101001','YB101002','YB101003','YB102001','YB102002','YB103001','YB103002','YB104001','YB104002','YB105001','YB105002','YB106001','YB106002','YB107001','YB108001','YB109001','YC001001','YC001002','YC001003','YC002001','YC002002','YC002003','YC006001','YC006002','YC007001','YC007002','YC009001','YC009002','YC010001','YC011001','YC601001','YC602001','YD001001','YD001002','YD001003','YD002001','YD002003','YD002004','YD002002','YD003002','YD003003','YD003004','YD003005','YD004001','YD004002','YD005001','YD005002','YD006001','YD006002','YD007001','YD007002','YD008001','YD008002','YD011001','YD012001','YD012002','YD012003','YD013001','YD013002','YD013003','YD014001','YD014002','YD014003','YD015001','YD015002','YD017001','YD017002','YD017003','YD018001','YF001001','YF003001','YF004001','YF005001','YF006001','YF006002','YF007001','YF008001','YF009001','YF009002','YF011001','YF012001','YF016001','YF017001','YF017002','YF018001','YF019001','YF019002','YF020001','YF022001','YF023001','YF024001','YF025001','YF026001','YF027001','YF028001','YF031001','YF033001','YF601001','YF603001','YF605001','YF607001','YF607002','YF999001','YF100001','YG003001','YG004001','YG006001','YG007001','YG009001','YG009002','YG009003','YG012001','YG013001','YG015001','YG015002','YG016001','ZA101101','ZA101102','ZA101103','ZA201101','ZA201102','ZA201103','ZA301101','ZA301102','ZA301103','ZA401101','ZA401102','ZA401103','ZA501101','ZA501102','ZA501103','ZA601101','ZA601102','ZA601103','ZA701101','ZA701102','ZA701103','ZA801101','ZA801102','ZA801103','ZA901101','ZA901102','ZA901103','ZA921101','ZA921102','ZA921103');
        $KodeITHTDHortikultura = array('XA002','XA004','XA006','XA007','XA008','XA011','XA013','XA015','XA026','XA029','XB014','XB015','XB018','XB019','XB023','XD001','XD002','XD004','XD008');
        $KodeIBHTDHortikultura = array('YA103','YA111','YA101','YA110','YA115','YA117','YA102','YA108','YA203','YA211','YA212','YA204','YA208','YA401','YA402','YA405','YA408','YB001','YB002','YB004','YB005','YB006','YB007','YB016','YB101','YB102','YB103','YB106','YB107','YB601','YB602','YB603','YB604','YD002','YD003','YF003','YF005','YF006','YF007','YF018','YF019','YF607','ZA101','ZA201','ZA301','ZA401','ZA501','ZA601','ZA701','ZA921');
        $HTDITHortikultura = array(1317127,383039,1800000,2000000,2143772,504460,242433,255568,389249,628851,687642,663274,245485,99107,351694,400000,150000,200000,2000);
        $HTDIBHortikultura = array(30000,38000,27000,23000,85000,48000,24000,160000,40000,27000,210000,10000,140000,6000,6500,14000,8500,2200,2500,1600,14000,2500,18500,9000,23700,120000,108000,23500,33000,13800,45000,1250,850,8000,5150,15000,10000,90000,40000,45000,10000,2000,80000,80000,80000,80000,80000,80000,80000,80000);
        $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeITHortikultura)) {
              for ($j=0; $j < count($KodeITHTDHortikultura); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeITHTDHortikultura[$j]) {
                  $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$HTDITHortikultura[$j];
                }
              }
            }
            else if (in_array($Pisah[$i],$KodeIBHortikultura)) {
              for ($j=0; $j < count($KodeIBHTDHortikultura); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeIBHTDHortikultura[$j]) {
                  $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$HTDIBHortikultura[$j];
                }
              }
            } 
          }
        }
        $ITHortikultura = $ITHarga/$IT_Harga*100;
        $IBHortikultura = $IBHarga/$IB_Harga*100;
        $ITHargaNTP += $ITHarga;$IT_HargaNTP += $IT_Harga;
        $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IB_Harga;
        $Data['NTPHortikultura'] = $ITHortikultura/$IBHortikultura*100;
        array_push($TempITSeries,$ITHortikultura);array_push($TempIBSeries,$IBHortikultura);array_push($TempNTPSeries,$Data['NTPHortikultura']); 
        $KodeITPerkebunan = array('LA001001','LA001002','LA002001','LA002002','LA004001','LA004002','LA005001','LA006001','LA006002','LA006003','LA008001','LA011001','LA011002','LA012001','LA012002','LA013001','LA014001','LA017001','LA017002','LA019001','LA020001','LA021001','LA022001','LA023001','LA026001','LA027001','LA029001','LA031001','LA032001','LA033001','LA007001','LA009001','LA009002','LA018001','LA025001','LA028001','LA030001');  
        $KodeIBPerkebunan = array('MA001001','MA001002','MA001003','MA002001','MA002002','MA002003','MA003001','MA004001','MA005001','MA006001','MA007001','MA008001','MA009001','MA010001','MA011001','MA012001','MA015001','MA017001','MA018001','MA019001','MB001001','MB001002','MB001003','MB002001','MB002002','MB004001','MB005001','MB005002','MB006001','MB007001','MB007002','MB007003','MB008001','MB011001','MB013001','MB014001','MB015002','MB015001','MB015003','MB016001','MB017001','MB018001','MB101001','MB101002','MB101003','MB101004','MB102001','MB102002','MB102003','MB103001','MB103002','MB103003','MB104001','MB104002','MB105001','MB105002','MB106001','MB106002','MC001001','MC001002','MC001003','MC003001','MC004001','MC004002','MC005001','MC005002','MC007001','MC008001','MC009001','MC010001','MC011001','MD001001','MD001002','MD001003','MD001004','MD002001','MD002002','MD002003','MD002004','MD003002','MD003003','MD003004','MD003005','MD004001','MD004002','MD005001','MD005002','MD005003','MD006001','MD006002','MD007001','MD007002','MD008001','MD008002','MD009001','MD009002','MD011001','MD011002','MD012001','MD012002','MD013001','MD014001','MD014002','MD014003','MD015001','MD015002','MD015003','MD017001','MD019001','MD019002','MD019003','MD019004','MD020001','MD020002','MD021001','MD022001','ME001001','ME002001','ME002002','ME002003','ME003001','ME003002','ME004001','ME004002','ME005001','ME005002','ME006001','ME007001','ME008001','ME009001','ME009002','ME009003','ME010001','ME011001','ME011002','ME012001','ME012002','ME013001','ME014001','ME015001','ME017001','ME019001','ME020001','ME021001','ME022001','ME023001','ME024001','ME025001','ME026001','ME602001','ME602002','ME602003','ME604001','ME605001','ME606001','ME607001','ME608001','ME609001','ME610001','ME611001','ME612001','ME613001','MF002001','MF002002','MF003001','MF006001','MF009001','MF009002','MF009003','MF012001','MF012002','MF602001','MF603001','MF606001','MF607001','NA101101','NA102101','NA103101','NA201101','NA202101','NA203101','NA301101','NA301102','NA301103','NA401101','NA401102','NA401103','NA501101','NA501102','NA501103','NA601101','NA601102','NA601103','NA701101','NA701102','NA701103','NA801101','NA801102','NA801103','NA901101','NA901102','NA901103','NA911101','NA911102','NA911103','NA921101','NA921102','NA921103','NA931101','NA931102','NA931103');
        $KodeITHTDPerkebunan = array('LA001','LA002','LA004','LA005','LA006','LA008','LA011','LA012','LA013','LA014','LA017','LA019','LA020','LA021','LA022','LA023','LA026','LA027','LA029','LA031','LA032','LA007','LA009','LA018','LA025','LA028');
        $KodeIBHTDPerkebunan = array('MA001','MA002','MA003','MA004','MA005','MA006','MA007','MA008','MA009','MA010','MA011','MA012','MA015','MA017','MA018','MB001','MB002','MB004','MB005','MB006','MB007','MB008','MB011','MB013','MB014','MB015','MB016','MB017','MB018','MB101','MB102','MB103','MB104','MB105','MB106','MC001','MC003','MC004','MC005','MC007','MC008','MC009','MC010','MD001','MD002','MD003002','MD004','MD005','MD006','MD007','MD008','MD009','MD011','MD012','MD013','MD014','MD015','MD017','MD019','MD020','MD021','ME001','ME002','ME003','ME004','ME005','ME006','ME007','ME008','ME009','ME010','ME011','ME012','ME013','ME014','ME015','ME017','ME019','ME020','ME021','ME022','ME023','ME024','ME025','ME026','ME602','ME604','ME605','ME606','ME607','ME608','ME609','ME610','ME611','ME612','MF002','MF003','MF006','MF009','MF012','MF602','MF603','MF606','MF607','NA101','NA201','NA301','NA401','NA501','NA601','NA701','NA801','NA901','NA911','NA921','NA931');
        $HTDITPerkebunan = array(460000,3048166,146500,2518750,14712,98020,18854,75000,58974,46687,2541178,6093980,29487,34401,0,0,710000,2948700,11794,27521,162178,617000,1950000,4151,50884,511108);
        $HTDIBPerkebunan = array(12000,0,96500,18000,0,31838,0,0,0,0,0,0,0,0,0,2400,2800,900,5441,15500,5000,28000,8005,108444,26879,60000,45000,800,0,25000,115552,98000,52692,134041,20337,900000,0,875000,0,0,0,0,0,4500,8500,5500,33000,225000,33000,115000,45000,95000,402122,1300000,55693,1870000,12000000,236444,80000,250000,0,15293,9800,9153,13440,130000,67500,70000,188000,75540,42006,64000,1100000,6025,65000,62471,195000,155159,60247,34758,4634373,1159,32000,139,89000000,198000,10000,45000,0,169850,29660,47668,62101,8990684,35000,575000,0,23172,36148,19000,0,0,0,7183,80000,80000,65000,80000,80000,40000,130000,80000,80000,80000,80000,80000);
        $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeITPerkebunan)) {
              for ($j=0; $j < count($KodeITHTDPerkebunan); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeITHTDPerkebunan[$j]) {
                  $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$HTDITPerkebunan[$j];
                }
              }
            }
            else if (in_array($Pisah[$i],$KodeIBPerkebunan)) {
              for ($j=0; $j < count($KodeIBHTDPerkebunan); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeIBHTDPerkebunan[$j]) {
                  $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$HTDIBPerkebunan[$j];
                }
              }
            } 
          }
        }
        $ITPerkebunan = $ITHarga/$IT_Harga*100;
        $IBPerkebunan = $IBHarga/$IB_Harga*100;
        $ITHargaNTP += $ITHarga;$IT_HargaNTP += $IT_Harga;
        $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IB_Harga;
        $Data['NTPPerkebunan'] = $ITPerkebunan/$IBPerkebunan*100;
        array_push($TempITSeries,$ITPerkebunan);array_push($TempIBSeries,$IBPerkebunan);array_push($TempNTPSeries,$Data['NTPPerkebunan']); 
        $KodeITPeternakan = array('OA001001','OA001002','OA001003','OA002001','OA002002','OA002003','OA002004','OA002005','OA002006','OA003001','OA003002','OA004001','OA004002','OA005002','OB001001','OB001002','OB001003','OB001004','OB002001','OB002002','OB002003','OB002004','OB003001','OB003002','OB003003','OB003004','OB003005','OB004001','OB004002','OB005001','OB006001','OC002001','OC002002','OC002003','OC002004','OC003001','OC005001','OC005002','OC005003','OC006001','OC007001','OC008001','OC009001','OC010001','OC011001','OD001001','OD006001','OD007001','OD008001','OD009001','OD010001','OD011001');  
        $KodeIBPeternakan = array('PA002001','PA002002','PA002003','PA003001','PA003002','PA005001','PA005002','PA006001','PA006002','PA007001','PA007002','PA601001','PA601002','PA602001','PA602002','PA615001','PA615002','PA615003','PA616001','PA616002','PA617001','PA617002','PA617003','PA618001','PA618002','PA619001','PA619002','PA620001','PA620002','PA621001','PA621002','PA622001','PA622002','PA623001','PA623002','PA624001','PA625001','PA626001','PA701001','PA701002','PA702001','PA702002','PA703001','PA703002','PA703003','PA704001','PA704002','PA705001','PA705002','PA706001','PA706002','PA707001','PB102001','PB102002','PB102003','PB102004','PB104001','PB105001','PB106001','PB107001','PB107002','PB107003','PB108001','PB109001','PB110001','PB113001','PB114001','PB116001','PB117001','PB122001','PB162001','PB164001','PB165001','PB165002','PB165003','PB166001','PB201001','PB201002','PB201003','PB201004','PB202001','PB202002','PB202003','PB202004','PB203001','PB203002','PB204001','PB204002','PB205001','PB205002','PB205003','PB206001','PB206002','PB208001','PB208002','PB209001','PB210001','PB210002','PB210003','PB210004','PB211001','PB212001','PB214001','PB215001','PB216001','PB217001','PB218001','PB219001','PB220001','PB221001','PB261001','PB262001','PB263001','PB264001','PB265001','PB266001','PB267001','PB268001','PB269001','PB270001','PC001001','PC002001','PC012001','PC601001','PC602001','PC603001','PD001001','PD001002','PD001003','PD001004','PD002001','PD002003','PD002004','PD002002','PD003002','PD003003','PD003004','PD003005','PD004001','PD004002','PD005001','PD005002','PD006001','PD006002','PD007001','PD007002','PD008001','PD009001','PD009002','PD014001','PD601001','PD601002','PD601003','PD602001','PE001001','PE001002','PE002001','PE002002','PE002003','PE003001','PE003002','PE003003','PE004001','PE004002','PE008001','PE008002','PE012001','PE012002','PE013001','PE013002','PE015001','PE016001','PE017001','PE018001','PE019001','PE020001','PE021001','PE023001','PE024001','PE025001','PE602001','PE602002','PE605001','PE606001','PE607001','PE608001','PE609001','PE610001','PE611001','PE612001','PE613001','PE614001','PE615001','PE616001','PE617001','PE618001','PE619001','PE620001','PF005001','PF006001','PF007001','PF008001','PF010001','PF010002','PF011001','PF012001','PF014001','PF015001','PF016001','PF016002','PF016003','PF017001','PF017002','PF018001','PF019001','PF019002','PF020001','PF020002','PF021001','PF022001','PF022002','PF023001','PF023002','PF024001','PF602001','PF602002','PF603001','PF604001','PF605001','PF606001','QA101101','QA101102','QA101103','QA301101','QA301102','QA301103','QA401101','QA401102','QA401103','QA501101','QA501102','QA501103','QA502101','QA502102','QA502103');
        $KodeITHTDPeternakan = array('OA001','OA002','OA003','OA004','OB001','OB002','OB003','OB004','OC002','OC003','OC005','OC006','OC007','OC008','OC009','OD001','OD006','OD007','OD008','OD009');
        $KodeIBHTDPeternakan = array('PA002','PA003','PA005','PA006','PA007','PA601','PA602','PA615','PA616','PA617','PA618','PA619','PA620','PA621','PA622','PA623','PA624','PA701','PA702','PA703','PA704','PA705','PA706','PB102','PB104','PB105','PB106','PB107','PB108','PB109','PB110','PB113','PB114','PB116','PB117','PB122','PB162','PB164','PB165','PB201','PB202','PB203','PB204','PB205','PB206','PB208','PB209','PB210','PB211','PB212','PB214','PB215','PB216','PB217','PB218','PB219','PB220','PB221','PB261','PB262','PB263','PB264','PB265','PB266','PB267','PC001','PC002','PC012','PC601','PD001','PD002','PD003','PD004','PD005','PD006','PD007','PD008','PD009','PD014','PD601','PE001','PE002','PE003','PE004','PE008','PE012','PE013','PE015','PE016','PE017','PE018','PE019','PE020','PE021','PE023','PE024','PE025','PE602','PE605','PE606','PE607','PE608','PE609','PE610','PE611','PE612','PE613','PE614','PE615','PE616','PE617','PE618','PE619','PE620','PF005','PF006','PF007','PF008','PF010','PF011','PF012','PF014','PF015','PF016','PF017','PF018','PF019','PF020','PF021','PF022','PF023','PF024','PF602','PF603','PF604','QA101','QA301','QA401','QA501');
        $HTDITPeternakan = array(18000000,17500000,13083701,0,1500000,1208333,1647969,33000,47000,0,48000,207500,60552,35000,45000,7404,20831,19653,17000,2250);
        $HTDIBPeternakan = array(9500000,0,800000,0,0,570000,0,12000000,0,0,1200000,0,0,70000,0,35000,20750,14000000,0,0,4500000,0,0,17000,8000,0,17000,60000,23000,0,0,22000,0,110000,0,0,0,10000,90000,3500,0,9000,4500,7000,9000,0,3851,0,3500,45000,0,0,0,0,0,0,0,0,3800,10240,17740,9000,0,0,0,0,1000000,0,1400000,0,7500,6500,70000,200000,600000,70000,150000,31000,50000,90000,22000,70000,0,16000,0,0,33000,75000,0,510000,0,0,0,0,0,0,18000000,9000,0,0,600000,1400000,35000,950000,0,190000,480250,25000,98000000,0,13000000,140000,22000000,0,15887,23880,195319,73727,33504,5251,48256,56147,25000,415,16000,13560,25000,15560,2500,0,150000,0,30875,14047,0,17000,20000,0,70000);
        $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeITPeternakan)) {
              for ($j=0; $j < count($KodeITHTDPeternakan); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeITHTDPeternakan[$j]) {
                  $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$HTDITPeternakan[$j];
                }
              }
            }
            else if (in_array($Pisah[$i],$KodeIBPeternakan)) {
              for ($j=0; $j < count($KodeIBHTDPeternakan); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeIBHTDPeternakan[$j]) {
                  $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$HTDIBPeternakan[$j];
                }
              }
            } 
          }
        }
        $ITPeternakan = $ITHarga/$IT_Harga*100;
        $IBPeternakan = $IBHarga/$IB_Harga*100;
        $ITHargaNTP += $ITHarga;$IT_HargaNTP += $IT_Harga;
        $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IB_Harga;
        $Data['NTPPeternakan'] = $ITPeternakan/$IBPeternakan*100;
        array_push($TempITSeries,$ITPeternakan);array_push($TempIBSeries,$IBPeternakan);array_push($TempNTPSeries,$Data['NTPPeternakan']); 
        $KodeITPerikanan = array('RA001001','RA002001','RA003001','RA004001','RA006001','RA007001','RA007002','RA007003','RA007004','RA007005','RA007006','RA008001','RA009001','RA010001','RA011001','RA011002','RA011003','RA011004','RA011005','RA012001','RA014001','RA015001','RA019001','RA020001','RA021001','RA022001','RA023001','RA024001','RA501001','RA502001','RA503001','RA505001','RA507001','RA508001','RA509001','RA510001','RB001001','RB004001','RB005001','RB006001','RB008001','RB010001','RB011001','RB012001','RB013001','RB014001','RB016001','RB017001','RB020001','RB021001','RB023001','RB024001','RB028001','RB029001','RB030001','RB032001','RB035001','RB037001','RB039001','RB040001','RB042001','RB042002','RB042003','RB042004','RB042005','RB044001','RB046001','RB047001','RB048001','RB049001','RB050001','RB052001','RB053001','RB054001','RB055001','RB056001','RB057001','RB058001','RB059001','RB063001','RB065001','RB072001','RB072002','RB072003','RB072004','RB073001','RB076001','RB078001','RB080001','RB081001','RB082001','RB082002','RB083001','RB085001','RB086001','RB087001','RB092001','RB093001','RB094001','RB095001','RB096001','RB098001','RB099001','RB104001','RB106001','RB106002','RB106003','RB106004','RB106005','RB108001','RB109001','RB109002','RB109003','RB109004','RB109005','RB110001','RB111001','RB113001','RB114001','RB115001','RB115002','RB115003','RB117001','RB118001','RB127001','RB128001','RB131001','RB131002','RB501001','RB502001','TA002001','TA005001','TA006001','TA007001','TA009001','TA012001','TA012002','TA012003','TA012004','TA012005','TA012006','TA013001','TA014001','TA015001','TA017001','TA018001','TA019001','TA019002','TA019003','TA019004','TA019005','TA032001','TA033001','TB002001','TB002002','TB002003','TB003001','TB003002','TB003003','TB003004','TB003005','TB006001','TB006002','TB006003','TB006004','TB006005','TB006006','TB007001','TB011001','TB011002','TB013001','TB016002','TB016003','TB503001','TB504001','TB505001','TB506001','TB507001','TC001001','TC002001','TC003001','TC004001','TC005001','TC006001','TC007001','TC011001','TC011002','TC011003','TC011004','TC011005','TC012002','TC013001');  
        $KodeIBPerikanan = array('SA001001','SA001002','SA001003','SA001004','SA002001','SA002002','SA002003','SA002004','SA003001','SA003002','SA003003','SA003004','SA003005','SA004001','SA004002','SA004003','SA004004','SA005001','SB001001','SB001002','SB001003','SB001004','SB001005','SB001006','SB002001','SB002003','SB002004','SB002002','SB003002','SB003003','SB003004','SB003005','SB004001','SB004002','SB004003','SB005001','SB005002','SB005003','SB006001','SB006002','SB006003','SB007002','SB007003','SB008001','SB009001','SC001001','SC001002','SC001003','SC001004','SC002001','SC002002','SC002003','SC002004','SC003001','SC003002','SC003003','SC003004','SC003005','SC003006','SC004001','SC004002','SC004003','SC005001','SC005002','SC005003','SC006001','SC007001','SC007002','SC007003','SC007004','SC008001','SC009001','SC009002','SC009003','SC009004','SC009005','SC010001','SC010002','SC010003','SC010004','SC011001','SC011002','SC011003','SC011004','SC011005','SC011006','SC013001','SC014001','SC015001','SC016001','SC017001','SC018001','SC019001','SC019002','SC020001','SC020002','SC021001','SC022001','SC022002','SC023001','SC024001','SC025001','SC026001','SC027001','SC028001','SC029001','SC030001','SC031001','SC032001','SC033001','SC033002','SC033003','SC033004','SC034001','SC034002','SC034003','SC034004','SC034005','SC037001','SC038001','SC039001','SC040001','SC601001','SC601002','SC601003','SC602001','SC603001','SC603002','SC604001','SC605001','SE001001','SE002001','SE003001','SE004001','SE004002','SE004003','SE004004','SE005001','SE006001','SE006002','SE007001','SE007002','SE007003','SE007004','SE007005','SE007006','SE008001','SE009001','SE010001','SE011001','SE015001','SE016001','SE016002','SE016003','SE017001','SE017002','SE018001','SE019001','SE020001','SE021001','SE602001','SE603001','SE603002','SE604001','SE605001','SF101101','SF102101','SF103101','SF201101','SF202101','SF203101','SF301101','SF302101','SF303101','SF501101','SF502101','SF503101','SF401101','SF402101','SF403101','UA002001','UA004001','UA005001','UA006001','UA007001','UA011001','UA011002','UA011003','UA011004','UA011005','UA012001','UA013001','UA014001','UA016001','UA018001','UA018002','UA018003','UA018004','UA020001','UA021001','UA022001','UA023001','UA101001','UA101002','UA101003','UA102001','UA102002','UA102003','UA102004','UA102005','UA104001','UA104002','UA104003','UA104004','UA104005','UA105001','UA106001','UA161001','UA162001','UA163001','UA164001','UA165001','UA166001','UA201001','UA201002','UA201003','UA202001','UA203001','UA204001','UA205001','UA206001','UA210001','UA210002','UA210003','UA210004','UA210005','UA211001','UA212001','UA213001','UB001001','UB001002','UB001003','UB002001','UB002002','UB003001','UB004001','UB004002','UB004003','UB004004','UB005001','UB006001','UB061001','UB062001','UB063001','UB064001','UB101001','UB102001','UB103001','UB104001','UB104002','UB105001','UB106001','UB107001','UB108001','UB109001','UB110001','UB111001','UB112001','UB113001','UB201001','UB201002','UB202001','UB202002','UB203001','UB204001','UB205001','UB207001','UB208001','UB209001','UB210001','UB211001','UB212001','UB213001','UB262001','UB263001','UB265001','UB266001','UB267001','UC001001','UC601001','UC602001','UC603001','UD001001','UD001002','UD001003','UD001004','UD001005','UD001006','UD002001','UD002003','UD002004','UD002002','UD003002','UD003003','UD003004','UD003005','UD004001','UD004002','UD004003','UD005001','UD005002','UD005003','UD006001','UD006002','UE001001','UE001002','UE001003','UE001004','UE002001','UE002002','UE002003','UE002004','UE003001','UE003002','UE003003','UE003004','UE003005','UE003006','UE004001','UE004002','UE004003','UE004004','UE005001','UE007001','UE007002','UE007003','UE007004','UE008001','UE008002','UE008003','UE008004','UE008005','UE008006','UE010001','UE010002','UE010003','UE011001','UE012001','UE014001','UE015001','UE016001','UE017001','UE018001','UE019001','UE019002','UE020001','UE020002','UE021001','UE022001','UE022002','UE023001','UE024001','UE025001','UE026001','UE027001','UE028001','UE029001','UE030001','UE031001','UE032001','UE033001','UE601001','UE602001','UE603001','UE605001','UE606001','UE607002','UE608003','UE609001','UE610001','UE611001','UE612001','UE613001','UG002001','UG003001','UG004001','UG005001','UG005002','UG006001','UG006002','UG006003','UG007001','UG007002','UG007003','UG008001','UG604001','UG604002','UG605001','UG606001','UH201101','UH201102','UH201103','UH301101','UH301102','UH301103','UH401101','UH401102','UH401103','UH501101','UH501102','UH501103','UH601101','UH601102','UH601103','UH701101','UH701102','UH701103','UH011101','UH011102','UH011103');
        $KodeITHTDPerikanan = array('TC007','TC011','TC001','TB003','RB020','RB037','RB040','RB042','RB047','RB053','RB055','RB056','RB072','RB096','RB099','RB104','RB109','RB111','RB113','RB131');
        $KodeIBHTDPerikanan = array('SB002','SB003','SB007','SC010','SC011','SC016','SC018','SC020','SC021','SC025','SC028','SC038','SF501','UA206','UA210','UA201','UA102','UB001','UB002','UB003','UB061','UB102','UB104','UB105','UB202','UB204','UC001','UD002','UD003','UD005','UE005','UE007','UE032','UE606','UH011','UH201','UH301','UH401','UH501','UH601');
        $HTDITPerikanan = array(15000,38000,15000,100000,45000,13000,18000,51000,18000,19000,38000,13000,16000,28000,8500,24000,105000,115000,42000,65000);
        $HTDIBPerikanan = array(6500,5150,18500,230000,110000,65000,12000,90000,80000,70000,14000,80000,80000,16000,35000,27000,5700000,2500,2600,4000,2600,90000,18000,117000,15000,20000,1200000,6500,5150,50000,1100000,55000,130000,6500,27000,140000,140000,25000,25000,110000);
        $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeITPerikanan)) {
              for ($j=0; $j < count($KodeITHTDPerikanan); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeITHTDPerikanan[$j]) {
                  $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$HTDITPerikanan[$j];
                }
              }
            }
            else if (in_array($Pisah[$i],$KodeIBPerikanan)) {
              for ($j=0; $j < count($KodeIBHTDPerikanan); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeIBHTDPerikanan[$j]) {
                  $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$HTDIBPerikanan[$j];
                }
              }
            } 
          }
        }
        $ITPerikanan = $ITHarga/$IT_Harga*100;
        $IBPerikanan = $IBHarga/$IB_Harga*100;
        $ITHargaNTP += $ITHarga;$IT_HargaNTP += $IT_Harga;
        $IBHargaNTP += $IBHarga;$IB_HargaNTP += $IB_Harga;
        $Data['NTPPerikanan'] = $ITPerikanan/$IBPerikanan*100;
        array_push($TempITSeries,$ITPerikanan);array_push($TempIBSeries,$IBPerikanan);array_push($TempNTPSeries,$Data['NTPPerikanan']);
        $ITNTP = $ITHargaNTP/$IT_HargaNTP*100;
        $IBNTP = $IBHargaNTP/$IB_HargaNTP*100;
        $Data['ITNTP'] = $ITNTP;
        $Data['IBNTP'] = $IBNTP;
        $Data['NTP'] = $ITNTP/$IBNTP*100;
        array_push($TempITSeries,$ITNTP);array_push($TempIBSeries,$IBNTP);array_push($TempNTPSeries,$Data['NTP']);
        array_push($ITSeries,$TempITSeries);array_push($IBSeries,$TempIBSeries);array_push($NTPSeries,$TempNTPSeries);
      } 
    }
    $Data['IT'] = $ITSeries;$Data['IB'] = $IBSeries;$Data['NTP'] = $NTPSeries;
    $this->load->view('Surveyor/Header');
		$this->load->view('Surveyor/NTPProdusenHTD',$Data);
  }
}