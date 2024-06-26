<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Super')){
			redirect(base_url('IDE/Auth'));
		}
  } 

  public function index(){
    $this->load->view('Super/Header');
		$this->load->view('Super/Dashboard');
  }

  public function GantiPassword(){
    $this->db->where('Username', $this->session->userdata('Username'));
    $this->db->update('Super', array('Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT)));
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Mengganti Password!';
    }
  }

  public function Session(){
    if (isset($_POST['BulanNTP'])) {
      $_SESSION['BulanNTP'] = $_POST['BulanNTP'];
    } 
    if (isset($_POST['TahunNTP'])) {
      $_SESSION['TahunNTP'] = $_POST['TahunNTP'];
    } 
    if (isset($_POST['KodeDesa'])) {
      $_SESSION['KodeDesa'] = $_POST['KodeDesa'];
      $_SESSION['KodeKecamatan'] = $_POST['KodeKecamatan'];
      $_SESSION['JenisData'] = $_POST['JenisData'];
    }
    echo '1';
  }

  public function NTPFluktuasi(){
    $TahunNTP = $this->session->userdata('TahunNTP');
    $TanamanPangan = array('IA001001','IA001005','IA001006','IA002001','IA002006','IA003001','IA003006','IA004001','IB001003','IB002001','IB003001','IB005002','IB006001','IB006002','IB009001','JA101001','JA101003','JA101004','JA102003','JA102004','JA201002','JA202001','JA203001','JA204001','JA207001','JB001001','JB001002','JB001003','JB002002','JB004001','JB005001','JB006001','JB007001','JB014001','JB101002','JB102001','JB103001','JB105002','JC001001','JC002001','JC007001','JC009001','JC011001','JC013001','JD001001','JD002001','JD002002','JD002003','JD003002','JD004001','JD005002','JD006001','JD006002','JD006003','JD012001','JD013001','JF001001','JF002001','JF002002','JF005001','JF005002','JF007001','JF008001','JF009001','JF011001','JF012001','JF017001','JF018001','JF019001','JF023001','JF027001','JF028001','JF029001','JF034001','JG003001','JG005001','JG006001','JG012002','KA101101','KA101102','KA201101','KA301101','KA301102','KA401101','KA401102','KA501101','KA501102','KA601101','KA701101','KA801101','KA801102','KA911101','KA911102','KA921101','KA921102','KA961101');
    $Hortikultura = array('XA002001','XA004001','XA006001','XA007001','XA008001','XA011001','XA013001','XA015001','XA026001','XA029001','XB014003','XB015001','XB018002','XB019002','XB023001','XB023002','XB023004','XD001001','XD002001','XD004001','XD008001','YA101001','YA101002','YA101003','YA102001','YA103001','YA108001','YA110001','YA111001','YA115001','YA117001','YA203003','YA204002','YA204003','YA208001','YA208002','YA211001','YA211002','YA212001','YA212002','YA401001','YA402001','YA405001','YA408001','YB001001','YB001002','YB002002','YB004001','YB005001','YB006001','YB007001','YB016001','YB101002','YB102001','YB102002','YB103001','YB103002','YB106002','YB107001','YB601001','YB601002','YB602001','YB603001','YB604001','YD002001','YD002003','YD002004','YD003002','YF003001','YF005001','YF006001','YF006002','YF007001','YF018001','YF019001','YF607001','YF607002','ZA101101','ZA201101','ZA301101','ZA301102','ZA401101','ZA501101','ZA501102','ZA501103','ZA601101','ZA701101','ZA921101');
    $Perkebunan = array('LA007001','LA009002','MA003001','MA004001','MB001002','MB002001','MB004001','MB006001','MB007001','MB008001','MB015001','MB016001','MB017001','MB101002','MB103003','MC001002','MC004001','MD001003','MD002002','MD003002','MD004001','MD005001','MD006001','MD007001','MD007002','MD008001','MD009001','MD014001','MD019001','ME002001','ME005001','ME006001','ME008001','ME017001','ME024001','ME026001','ME602002','ME604001','ME605001','ME612001','MF002001','MF012002','NA101101','NA201101','NA202101','NA301101','NA301102','NA401101','NA501101','NA601101','NA701101');
    $Peternakan = array('OA002005','OB001004','OC002003','OC008001','OC009001','OD008001','PA002002','PA601001','PA615002','PA618002','PA621001','PA623001','PA704001','PB102001','PB104001','PB106001','PB107001','PB108001','PB113001','PB116001','PB165001','PB165003','PB201001','PB203002','PB204001','PB205003','PB206001','PB206002','PB212001','PC002001','PC601001','PD002003','PD003002','PD004001','PD005001','PD601003','PE001001','PE002002','PE004002','PE013001','PE020001','PE602001','PE607001','PE608001','PE609001','PE610001','PE612001','PF015001','PF017001','PF019001','PF021001','PF023001','QA101101','QA301101');
    $Perikanan = array('RB020001','RB037001','RB040001','RB042005','RB047001','RB053001','RB055001','RB056001','RB072004','RB096001','RB099001','RB104001','RB109004','RB111001','RB113001','RB131001','SB002003','SB003002','SB007002','SC010004','SC011004','SC016001','SC018001','SC020001','SC021001','SC025001','SC028001','SC038001','SF501101','TB003005','TA033001','TA014001','TA019003','UA102005','UA022001','UA013001','UA018003','UB001002','UB002002','UB003001','UB061001','UB102001','UB104001','UB105001','UB202002','UB204001','UC001001','UD002003','UD003002','UD005003','UE005001','UE007001','UE032001','UE606001','UE609001','UH011101','UH201101','UH301101','UH401101','UH501101','UH601101');
    $Sektor = $this->uri->segment('3');
    $Data['Fluktuasi'] = array();
    $Total = $this->db->query("SELECT COUNT(DISTINCT(TanggalSurvei)) AS Total FROM `ntpkonsumen` WHERE TanggalSurvei LIKE '%".$TahunNTP."%'")->row_array()['Total'];
    if ($Sektor == 1) {
      for ($k=1; $k <= $Total; $k++) { 
        if ($k < 10) { $Bulan = '0'.$k; } else { $Bulan = $k; }
        $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE "."'".$TahunNTP."-".$Bulan."%'")->result_array();    
        $DataHarga = array();
        for ($j=0; $j < count($TanamanPangan); $j++) { 
          $Temp = array();
          foreach ($DataProdusen as $key) {
            $Pisah = explode("|",$key['KodeKualitas']);
            $Harga = explode("|",$key['Harga']);
            for ($i=0; $i < count($Pisah); $i++) { 
              if ($Pisah[$i] == $TanamanPangan[$j]) {
                array_push($Temp,(int)$Harga[$i]);
              }
            }
          }
          array_push($DataHarga,$Temp);
        }
        $Average = array();
        for ($x=0; $x < count($DataHarga); $x++) { 
          if (count($DataHarga[$x]) > 0) {
            array_push($Average,(int)(array_sum($DataHarga[$x])/count($DataHarga[$x])));
          } else {
            array_push($Average,0);
          }
        }
        array_push($Data['Fluktuasi'],$Average);
      }
    } else if ($Sektor == 2) {
      for ($k=1; $k <= $Total; $k++) { 
        if ($k < 10) { $Bulan = '0'.$k; } else { $Bulan = $k; }
        $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE "."'".$TahunNTP."-".$Bulan."%'")->result_array();    
        $DataHarga = array();
        for ($j=0; $j < count($Hortikultura); $j++) { 
          $Temp = array();
          foreach ($DataProdusen as $key) {
            $Pisah = explode("|",$key['KodeKualitas']);
            $Harga = explode("|",$key['Harga']);
            for ($i=0; $i < count($Pisah); $i++) { 
              if ($Pisah[$i] == $Hortikultura[$j]) {
                array_push($Temp,(int)$Harga[$i]);
              }
            }
          }
          array_push($DataHarga,$Temp);
        }
        $Average = array();
        for ($x=0; $x < count($DataHarga); $x++) { 
          if (count($DataHarga[$x]) > 0) {
            array_push($Average,(int)(array_sum($DataHarga[$x])/count($DataHarga[$x])));
          } else {
            array_push($Average,0);
          }
        }
        array_push($Data['Fluktuasi'],$Average);
      }
    } else if ($Sektor == 3) {
      for ($k=1; $k <= $Total; $k++) { 
        if ($k < 10) { $Bulan = '0'.$k; } else { $Bulan = $k; }
        $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE "."'".$TahunNTP."-".$Bulan."%'")->result_array();    
        $DataHarga = array();
        for ($j=0; $j < count($Perkebunan); $j++) { 
          $Temp = array();
          foreach ($DataProdusen as $key) {
            $Pisah = explode("|",$key['KodeKualitas']);
            $Harga = explode("|",$key['Harga']);
            for ($i=0; $i < count($Pisah); $i++) { 
              if ($Pisah[$i] == $Perkebunan[$j]) {
                array_push($Temp,(int)$Harga[$i]);
              }
            }
          }
          array_push($DataHarga,$Temp);
        }
        $Average = array();
        for ($x=0; $x < count($DataHarga); $x++) { 
          if (count($DataHarga[$x]) > 0) {
            array_push($Average,(int)(array_sum($DataHarga[$x])/count($DataHarga[$x])));
          } else {
            array_push($Average,0);
          }
        }
        array_push($Data['Fluktuasi'],$Average);
      }
    } else if ($Sektor == 4) {
      for ($k=1; $k <= $Total; $k++) { 
        if ($k < 10) { $Bulan = '0'.$k; } else { $Bulan = $k; }
        $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE "."'".$TahunNTP."-".$Bulan."%'")->result_array();    
        $DataHarga = array();
        for ($j=0; $j < count($Peternakan); $j++) { 
          $Temp = array();
          foreach ($DataProdusen as $key) {
            $Pisah = explode("|",$key['KodeKualitas']);
            $Harga = explode("|",$key['Harga']);
            for ($i=0; $i < count($Pisah); $i++) { 
              if ($Pisah[$i] == $Peternakan[$j]) {
                array_push($Temp,(int)$Harga[$i]);
              }
            }
          }
          array_push($DataHarga,$Temp);
        }
        $Average = array();
        for ($x=0; $x < count($DataHarga); $x++) { 
          if (count($DataHarga[$x]) > 0) {
            array_push($Average,(int)(array_sum($DataHarga[$x])/count($DataHarga[$x])));
          } else {
            array_push($Average,0);
          }
        }
        array_push($Data['Fluktuasi'],$Average);
      }
    } else if ($Sektor == 5) {
      for ($k=1; $k <= $Total; $k++) { 
        if ($k < 10) { $Bulan = '0'.$k; } else { $Bulan = $k; }
        $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE "."'".$TahunNTP."-".$Bulan."%'")->result_array();    
        $DataHarga = array();
        for ($j=0; $j < count($Perikanan); $j++) { 
          $Temp = array();
          foreach ($DataProdusen as $key) {
            $Pisah = explode("|",$key['KodeKualitas']);
            $Harga = explode("|",$key['Harga']);
            for ($i=0; $i < count($Pisah); $i++) { 
              if ($Pisah[$i] == $Perikanan[$j]) {
                array_push($Temp,(int)$Harga[$i]);
              }
            }
          }
          array_push($DataHarga,$Temp);
        }
        $Average = array();
        for ($x=0; $x < count($DataHarga); $x++) { 
          if (count($DataHarga[$x]) > 0) {
            array_push($Average,(int)(array_sum($DataHarga[$x])/count($DataHarga[$x])));
          } else {
            array_push($Average,0);
          }
        }
        array_push($Data['Fluktuasi'],$Average);
      }
    }
    $Data['Laju'] = array();
    for ($j=1; $j < $Total; $j++) { 
      $Temp = array();
      for ($i=0; $i < count($Data['Fluktuasi'][0]); $i++) { 
        $Harga = $Data['Fluktuasi'][$j][$i];
        $_Harga = $Data['Fluktuasi'][$j-1][$i];
        if ($Harga > 0) {
          array_push($Temp,number_format((($Harga-$_Harga)/$_Harga*100),2,",","."));
        } else {
          array_push($Temp,0);
        }
      }
      array_push($Data['Laju'],$Temp);
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/NTPFluktuasi',$Data);
  }

  public function NTPI(){
    $IKRT = array('AA001001','AA003002','AA004001','AA006001','AA007001','AA008002','AA011001','AA012001','AA013001','AA014001','AA014002','AA014003','AA014004','AA016001','AA017001','AA018001','AA019001','AA020001','AA021001','AA702001','AB001002','AB007001','AB007002','AB011001','AB012001','AB013001','AB014001','AB018001','AB019001','AB020001','AB022001','AB023001','AB701002','AC001001','AC002001','AC004001','AC005001','AC006001','AC007001','AC008001','AC009001','AC011001','AC013001','AC015001','AC017001','AC018001','AC022001','AC023001','AC026001','AC035001','AC701001','AC703001','AC704001','AC708001','AD001001','AD002001','AD003001','AD004001','AD005001','AD006001','AD007001','AD008001','AD009001','AD014001','AD016001','AD020001','AE013001','AE015001','AE019001','AE021001','AE024001','AE026001','AF006001','AF006002','AF007001','AF007002','AF008001','AF008002','AF009001','AF011001','AF011002','AF012002','AF013001','AF014001','AF703001','AF703002','AG002002','AG002003','AG003001','AG004001','AG005001','AG007001','AH001001','AH002001','AH003002','AH004001','AH005001','AH005002','AH008001','AH010001','AH011001','AH012001','AH013001','AH016001','AH017001','AH018001','AH019001','AH020001','AH026001','AH030001','AH031001','AH034001','AH701001','AH702003','AH707001','AI001001','AI002001','AI003001','AI003002','AI004001','AI006001','AI007001','AI008001','AI010001','AI013002','AI014002','AI015003','AI016001','AI017001','AI017002','AI018001','AI019001','AI020001','AI021001','AI702001','AJ001001','AJ002001','AJ003002','AJ005001','AJ006001','AJ007001','AK001001','AK001002','AK002001','AK003001','AK008001','AK008002','AK011001','AK012001','AK013001','AK014001','AK015001','AK016001','AK016002','AK018001','AK019001','AK020001','AK021001','AK022001','AK023001','AK024001','AK024002','AK025001','AK025002','AK026001','AK701001','AK703002','AK706001','AL001003','AL003001','AP001001','AP002001','AP003001','AP003002','AP004001','AP011001','AP012001','AP021001','AP022001','AP024001','AP024002','AP706001','AP708001','AP708002','AP709002','AP714001','AQ001001','AQ001002','AQ008001','AQ009001','AQ011005','AQ012002','AQ710003','AQ711001','AR001002','AR002001','AR003001','AR013001','AR014001','BA002001','BA004004','BA005004','BA006001','BA006003','BA007001','BA007004','BA009001','BA014001','BA015001','BA016003','BA016004','BA017001','BA021001','BA022001','BA023001','BA024001','BA030002','BA705001','BA709003','BA711001','BA712001','BB001001','BB002003','BB004001','BB005002','BB006002','BB006003','BB007002','BB008001','BB009002','BB010001','BB012002','BB013001','BB016001','BB017001','BB703001','BC009003','BC010001','BC010003','BC013003','BC019002','BC021001','BC022001','BC022003','BC025001','BC027003','BC029001','BC030003','BC034002','BC036003','BC042001','BC049002','BC053001','BC053002','BC701001','BC703002','BC710001','BC713001','BD001001','BD003002','BD004004','BD005001','BD005002','BD009001','BD010001','BD010002','BD011001','BD012001','BD013002','CA001003','CA003003','CA013003','CA015003','CA016003','CA017003','CA019003','CA022001','CA023001','CA024001','CA025001','CA027001','CA701002','CA702001','CA703001','CA704002','CB004001','CB008001','CB010002','CB011001','CB013001','CB014001','CB015001','CB016001','CB017001','CB019001','CB020001','CB021001','CB025001','CB027001','CC004001','CC011001','CC017002','CC019002','CD001004','CD002001','CD022001','CD023001','CD025001','CD028001','DA001001','DA002001','DA004001','DA008002','DB001001','DB001002','DB001003','DB002001','DB002002','DB002003','DB003001','DB005001','DB006001','DB007001','DB008002','DB009001','DB701001','DB702001','DC001001','DC001002','DC002001','DC002002','DC002003','DC003001','DC009001','DC011001','DC011002','DC012001','DC503001','DC504001','DC702001','DC703001','DC703002','DC704002','DC707001','EB004001','EB005001','EB006002','EB006004','EB008001','EB009004','EB012002','ED001001','ED002001','ED003001','FA001001','FA001002','FA003003','FC003002','FC010001','FC011001','FC015001','FC016001','FC702001','FD002001');
    $Nama = array('Beras','Beras Ketan/Pulut','Tepung Beras','Tepung Sagu','Tepung Tapioka (Aci/Kanji)','Tepung Terigu','Jagung Pipilan/Pocelan','Beras Jagung ','Mie Basah','Mie Instant Supermi Rasa Ayam Bawang','Mie Instant Sedap Goreng','Mie Instant Indomie Soto','Mie Instant Indomie Rasa Ayam Bawang','Bihun ','Makaroni','Ketela Pohon','Ketela Rambat ','Gaple','Talas','Sohun/Soun','Daging Sapi','Itik hidup Manila/mentok','Itik hidup Bebek','Ayam Kampung Hidup','Ayam Ras Hidup','Daging Ayam Kampung','Daging Ayam Ras','Sosis Daging Ayam','Sosis Daging Sapi','Bakso','Daging Dlm Kaleng','Rampela Hati Ayam','Ayam Nuget','Cakalang','Cumi-Cumi','Kembung','Selar','Tenggiri','Teri','Tongkol','Udang Laut','Layang','Kerang','Layur','Bawal','Kurisi','Kerapu','Rajungan','Pari','Lemuru','Kuniran','Bilis','Manyung','Sembilang','Gurame','Gabus','Mujair','Ikan Mas','Lele','Nila','Bandeng','Udang Tambak','Patin','Sepat','Belut','Saluang/Wader','Ikan Asin Sepat','Ikan Asin Teri','Ikan Asin Layang','Ikan Asin Layur','Ikan Asin Cumi-cumi','Ikan Tongkol Asap','Susu Cair Kemasan Bendera','Susu Cair Kemasan Indomilk','Susu Bubuk Bayi Lactogen','Susu Bubuk Bayi SGM','Makanan Bayi Milna','Makanan Bayi Cerelac','Keju','Telur Itik/Bebek Tawar Mentah','Telur Itik/Bebek Asin Matang','Telur Puyuh','Telur Ayam Kampung','Telur Ayam Ras','Susu Kental Manis Putih','Susu Kental Manis Coklat','Minyak Goreng Tropical','Minyak Goreng Curah','Margarine','Mentega','Kelapa Tua','Santan Instan/Jadi','Kangkung','Bayam','Kubis/Kol','Kacang Panjang','Kentang Besar','Kentang Sedang','Ketimun','Tomat Sayur','Labu Siam/Jipang','Labu Air/Labu Panjang','Peta','Daun Bawang','Tauge/Kecambah','Buncis','Wortel','Lobak','Cabai Hijau','Sawi Putih','Sawi Hijau','Jagung Muda Kecil','Brokoli','Jamur','Daun Selada','Pisang','Pepaya','Jeruk Medan','Jeruk Pontianak','Mangga','Sawo','Nanas','Durian','Melon','Salak','Alpukat','Apel','Belimbing','Semangka Tanpa Biji','Semangka Ada Biji','Anggur','Nangka','Pir','Kelengkeng','Buah Naga','Kacang Tanah','Kacang Hijau','Kacang Kedele','Kacang Merah','Tempe Kedele','Tahu Mentah','Bawang Merah Besar','Bawang Merah Kecil','Bawang Putih','Lada/Merica','Penyedap Masakan Ajinomoto','Penyedap Masakan Sasa','Kemiri','Asam','Gula Merah','Ketumbar','Jinten','Bumbu Jadi IndofoodNasi Goreng','Bumbu Jadi Sajiku Nasi Goreng','Kunyit','Lengkuas','Jahe','Cabai Merah','Cabai Rawit','Terasi','Saus Sambal ABC','Saus Sambal Indofood','Saus Tomat ABC','Saus Tomat Indofood','Jeruk Nipis','Kencur','Garam','Cabai Merah Kering','Kerupuk Mentah','Bahan agar-agar','Roti Tawar','Roti Manis','Biskuit Khong Guan','Biskuit Regal','Donat','Bubur Nasi','Gado-Gado','Soto','Sate','Ayam Goreng Paha','Ayam Goreng Dada','Martabak','Sayur Jadi Sop','Sayur Jadi Capcay','Nasi dengan Lauk','Mie Ayam','Gula Pasir Gulaku','Gula Pasir Curah','Teh Manis','Air Minum Dalam Kemasan','Minuman Ringan','Minuman Kesehatan/Berenergi Suplemen','Teh Celup','Minuman Es Campur','Rokok Putih','Rokok Kretek','Rokok Kretek Filter','Arak/Anggur obat','Bir Bintang','Kayu Balok','Seng Plat','Seng Gelombang','Genteng Jatiwangi','Genteng Bintang','Asbes Djabesmen','Asbes','Batu Bata','Semen','Batako','Cat Kayu Emco','Cat Kayu','Cat Tembok','Paku','Keramik','Upah Tukang Bukan Mandor','Besi Slup (full=12 m)','Sekop','Pipa Paralon','Papan','Kuas','Palu/ Martil','Minyak Tanah','Arang','Korek Api/Geretan','Bola Lampu','Tarif Listrik  900w','Tarif Listrik 1300w','Lilin','Lampu TL/Neon','Gas LPG','Fitting Lampu','Kabel','Senter','Batu Baterai','Korek Api Gas','Tarif Air PDAM','Gelas','Piring Polos Duralex','Piring Kembang','Toples','Mangkok','Sapu Lidi','Kain Pel Gajah (dari kain)','Kain Pel Dinamic (sumbu)','Pisau','Payung','Jarum','Gayung','Teko/Ceret','Dandang','Kipas angin','Mesin Cuci','Rice Cooker Miyako','Rice Cooker Cosmos','Magic Com Miyako','Mixer','Ember','Sapu','Sabun Deterjen Bubuk','Sabun Cream/Colek','Pembasmi Nyamuk Bakar','Pembasmi Nyamuk Lotion Autan','Pembasmi Nyamuk Lotion Soffel','Pemutih','Pewangi Pakaian Molto','Pewangi Pakaian So Klin (Refill))','Pembasmi Nyamuk Spray','Sabun Cair/Cuci Piring','Tissu','Kemeja Panjang Sersin','Kaos Kutang/Singlet','Kaos Oblong/Polos','Peci/Kopiah','Baju Kaos/T-Shirt','Kaos Kaki','Baju Koko','Celana Panjang Jeans','Jaket','Kemeja Pendek katun','Kemeja Pendek Sersin','Sepatu Kets Pria','Celana Pendek Jeans','Kemeja Pendek Batik','Sarung','Sandal Pria','Rok Dalam','Sepatu','Celana Dalam','Daster','Pembalut Wanita','Celana Panjang Jeans','Kerudung/Jilbab','Mukena','Baju Kaos/ T-Shirt','Baju Batik','Celana Panjang Sersin','Kaos Kaki','Kebaya','Sandal Wanita','Sepatu Kulit Sintetis','Pakaian Bayi','Popok Sekali Pakai','Sandal Anak','Emas Perhiasan','Benang Jahit','Tutup Kepala/Topi','Ikat Pinggang','Sandal Jepit Karet','Kacamata','Tarif Dokter','Tarif Pemeriksaan Kandungan','Mantri Kesehatan','Tarif Dokter Gigi','Obat Sakit Kepala Paramex','Obat Sakit Kepala Oskadon','Obat Sakit Kepala Bodrex','Obat Sakit Perut  New Diatab','Obat Sakit Perut Diapet','Obat Sakit Perut New Entrostop','Obat Batuk Cair','Obat Flu','Obat Sakit Maag','Obat Gosok/Balsem','Minyak Angin','Minyak Kayu Putih','Minyak Telon','Minyak Tawon','Pasta Gigi Pepsodent','Pasta Gigi Ciptadent','Sabun Mandi Lifebuoy','Sabun Mandi Lux','Sabun Mandi Give','Bedak','Hand Body Lotion','Shampoo Sunsilk','Shampoo Lifebouy','Sikat Gigi','Tarif Gunting Rambut Pria','Tarif Gunting Rambut Wanita','Bedak Bayi','Sabun Mandi Cair Lifebuoy','Sabun Mandi CairLux','Sabun Wajah','Deodorant','Buku Tulis Bergaris','Penggaris Plastik','Pensil Hitam Staedtler HB','Pensil Hitam Staedtler 2B','Pulpen/Ballpoint','Penghapus Pensil','Buku Gambar','Kaos Olah Raga','Training Pack','Sepatu Olah Raga','Tarif Angkutan Bermotor Jauh ( > 5Km)','Tarif Angkutan Bermotor Dekat (<= 5Km)','Bensin Pertamax','Ban Dalam Motor','Busi','Kanvas Rem','Cuci Mobil','Cuci Motor','Tambal Ban','Tarif Adm Transfer Uang');
    $Data['Fluktuasi'] = array();
    for ($k=1; $k <= 12; $k++) { 
        if ($k < 10) { $Bulan = '0'.$k; } else { $Bulan = $k; }
        $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpkonsumen` WHERE TanggalSurvei LIKE '2023-".$Bulan."%'")->result_array();    
        $DataHarga = array();
        for ($j=0; $j < count($IKRT); $j++) { 
          $Temp = array();
          foreach ($DataProdusen as $key) {
            $Pisah = explode("|",$key['KodeKualitas']);
            $Harga = explode("|",$key['Harga']);
            for ($i=0; $i < count($Pisah); $i++) { 
              if ($Pisah[$i] == $IKRT[$j]) {
                array_push($Temp,(int)$Harga[$i]);
              }
            }
          }
          array_push($DataHarga,$Temp);
        }
        $Average = array();
        for ($x=0; $x < count($DataHarga); $x++) { 
          if (count($DataHarga[$x]) > 0) {
            array_push($Average,(int)(array_sum($DataHarga[$x])/count($DataHarga[$x])));
          } else {
            array_push($Average,0);
          }
        }
        array_push($Data['Fluktuasi'],$Average);
      }
    $Data['Laju'] = array();
    for ($j=1; $j < 12; $j++) { 
      $Temp = array();
      for ($i=0; $i < count($Data['Fluktuasi'][0]); $i++) { 
        $Harga = $Data['Fluktuasi'][$j][$i];
        $_Harga = $Data['Fluktuasi'][$j-1][$i];
        if ($Harga > 0) {
          array_push($Temp,number_format((($Harga-$_Harga)/$_Harga*100),2,",","."));
        } else {
          array_push($Temp,0);
        }
      }
      array_push($Data['Laju'],$Temp);
    }
    $this->load->view('Super/Header',$Data);
	  $this->load->view('Super/NTPFluktuasi',$Data);
  }

  public function NTP(){
    $TahunNTP = $this->session->userdata('TahunNTP');
    $Bulan = $this->session->userdata('BulanNTP');
    $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE "."'".$TahunNTP."-".$Bulan."%'")->result_array();    
    $Data['NTPTanamanPangan'] = $Data['NTPHortikultura'] = $Data['NTPPerkebunan'] = $Data['NTPPeternakan'] = $Data['NTPPerikanan'] = $Data['NTP'] = 0;
    $Data['ITTanamanPangan'] = $Data['ITHortikultura'] = $Data['ITPerkebunan'] = $Data['ITPeternakan'] = $Data['ITPerikanan'] = $Data['ITNTP'] = 0;
    $Data['IBTanamanPangan'] = $Data['IBHortikultura'] = $Data['IBPerkebunan'] = $Data['IBPeternakan'] = $Data['IBPerikanan'] = $Data['IBNTP'] = 0;
    if (count($DataProdusen) > 0) {
      $ITHargaNTP = $IT_HargaNTP = $IBHargaNTP = $IB_HargaNTP = 0;
      $KodeITTanamanPangan = array('IA001001','IA001002','IA001003','IA001004','IA001005','IA001006','IA002001','IA002002','IA002003','IA002004','IA002005','IA002006','IA003001','IA003002','IA003003','IA003004','IA003005','IA003006','IA004001','IA004002','IA005001','IA005002','IB001001','IB001002','IB002001','IB002002','IB001003','IB003001','IB005001','IB005002','IB006001','IB006002','IB007001','IB007002','IB008001','IB008002','IB008003','IB009001','IB009002','IB010001','IB011001','IB012001');  
      $KodeIBTanamanPangan = array('JA101001','JA101002','JA101003','JA101004','JA102001','JA102002','JA102003','JA102004','JA201001','JA201002','JA202001','JA203001','JA204001','JA205001','JA206001','JA207001','JA208001','JB001001','JB001002','JB001003','JB002001','JB002002','JB004001','JB005001','JB006001','JB007001','JB008001','JB011001','JB012001','JB012002','JB012003','JB013001','JB014001','JB015001','JB101001','JB101002','JB101003','JB102001','JB102002','JB102003','JB103001','JB103002','JB103003','JB104001','JB104002','JB104003','JB105001','JB105002','JB105003','JB106001','JB106002','JB106003','JB107001','JB107002','JC001001','JC001002','JC001003','JC002001','JC002002','JC002003','JC006001','JC007001','JC007002','JC008001','JC008002','JC009001','JC009002','JC010001','JC011001','JC013001','JC014001','JC015001','JC016001','JC017001','JD001001','JD001002','JD001003','JD002001','JD002002','JD002003','JD002004','JD003002','JD003003','JD003004','JD003005','JD004001','JD004002','JD005001','JD005002','JD005003','JD006001','JD006002','JD006003','JD007001','JD007002','JD008001','JD008002','JD010001','JD010002','JD011001','JD011002','JD012001','JD013001','JD014001','JD016001','JD016002','JD017001','JD017002','JD018001','JF001001','JF002001','JF002002','JF003001','JF003002','JF004001','JF005001','JF005002','JF006001','JF006002','JF007001','JF008001','JF009001','JF009002','JF010001','JF010002','JF011001','JF012001','JF013001','JF016001','JF017001','JF017002','JF018001','JF019001','JF019002','JF020001','JF023001','JF024001','JF025001','JF026001','JF027001','JF028001','JF029001','JF030001','JF031001','JF032001','JF033001','JF034001','JF035001','JG003001','JG004001','JG005001','JG005002','JG006001','JG007001','JG009001','JG009002','JG011001','JG011002','JG012001','JG012002','JG013001','JG013002','JG014001','JG015001','JG016001','JG017001','KA101101','KA101102','KA101103','KA201101','KA201102','KA201103','KA301101','KA301102','KA301103','KA401101','KA401102','KA401103','KA501101','KA501102','KA501103','KA601101','KA601102','KA601103','KA701101','KA701102','KA701103','KA801101','KA801102','KA801103','KA901101','KA901102','KA901103','KA911101','KA911102','KA911103','KA921101','KA921102','KA921103','KA941101','KA941102','KA941103','KA951101','KA951102','KA951103','KA961101','KA961102','KA961103');
      $KodeITHTDTanamanPangan = array('IA001','IA002','IA003','IA004','IA005','IB001','IB003','IB005','IB006','IB007','IB008','IB009');
      $KodeIBHTDTanamanPangan = array('JA101','JA102','JA201','JA202','JA203','JA204','JA205','JA206','JA207','JB001','JB002','JB004','JB005','JB006','JB007','JB008','JB011','JB012','JB013','JB014','JB101','JB102','JB103','JB104','JB105','JB106','JB107','JC001','JC002','JC006','JC007','JC008','JC009','JC010','JC011','JC013','JC014','JC015','JD001','JD002','JD003','JD004','JD005','JD006','JD007','JD008','JD010','JD011','JD012','JD013','JD014','JD016','JD017','JD018','JF001','JF002','JF003','JF004','JF005','JF006','JF007','JF008','JF009','JF010','JF011','JF012','JF013','JF016','JF017','JF018','JF019','JF020','JF023','JF024','JF025','JF026','JF027','JF028','JF029','JF030','JF031','JF032','JF033','JF034','JG003','JG004','JG005','JG006','JG007','JG009','JG011','JG012','JG013','JG014','JG015','KA101','KA201','KA301','KA401','KA501','KA601','KA701','KA801','KA901','KA911','KA921','KA941','KA951','KA961');
      $HTDITTanamanPangan = array(400000,400000,350000,680000,750000,330000,1300000,710000,1300000,378000,227900,378000);
      $HTDIBTanamanPangan = array(12500,15000,75000,7000,10000,38000,10000,7000,4500,2300,3500,2500,6000,2300,30000,3000,5600,102700,5833,800,25000,144000,150000,106000,660000,210000,62900,4000000,21000000,0,500000,50000,90000,35000,75000,350000,60000,35000,125000,9000,5000,32500,148000,28000,41530,21804,540000,70000,70000,85000,80000,2000,0,52780,20000,2400,20000,450000,125000,8000,100000,900000,22000000,4870000,75000,185000,9680000,29600,7500,48000,26000,480250,20000,510000,315000,17500,87000,1315000,3000,18500,20650,125000,0,450000,450000,12870,580000,28000,30875,12500,7100,15560,1478,17500,50000,100000,100000,80000,80000,80000,80000,80000,100000,80000,80000,80000,80000,80000,80000);
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
      $Data['ITTanamanPangan'] = $ITTanamanPangan;
      $Data['IBTanamanPangan'] = $IBTanamanPangan;
      $KodeITHortikultura = array('XA001001','XA002001','XA002002','XA002003','XA003001','XA004001','XA005001','XA006001','XA007001','XA007002','XA008001','XA009001','XA010001','XA010002','XA011001','XA012001','XA013001','XA014001','XA014002','XA015001','XA016001','XA016002','XA017001','XA019001','XA020001','XA022001','XA024001','XA025001','XA026001','XA027001','XA028001','XA029001','XA030001','XA031001','XA032001','XA033001','XA034001','XA035001','XA036001','XA037001','XA038001','XA039001','XB001001','XB001002','XB001003','XB002001','XB002002','XB003001','XB003002','XB004001','XB005001','XB005002','XB006001','XB006002','XB007001','XB007002','XB007003','XB008001','XB008002','XB008003','XB009001','XB009002','XB009003','XB009004','XB009005','XB010001','XB010002','XB010003','XB010004','XB010005','XB012001','XB013001','XB013002','XB014001','XB014002','XB014003','XB015001','XB016001','XB016002','XB016003','XB017001','XB018001','XB018002','XB019001','XB019002','XB019003','XB020001','XB020002','XB021001','XB021002','XB021003','XB022001','XB022002','XB023001','XB023002','XB023003','XB023004','XB024001','XB026001','XB027001','XB028001','XB029001','XB030001','XB031001','XB032001','XB033001','XB034001','XB035001','XD001001','XD002001','XD003001','XD004001','XD005001','XD007001','XD008001','XD009001','XD010001','XD011001','XD012001');  
      $KodeIBHortikultura = array('YA101001','YA101002','YA101003','YA102001','YA102002','YA103001','YA104001','YA105001','YA106001','YA107001','YA108001','YA109001','YA110001','YA111001','YA112001','YA113001','YA114001','YA115001','YA116001','YA117001','YA118001','YA119001','YA121001','YA122001','YA161001','YA163001','YA164001','YA165001','YA166001','YA167001','YA201001','YA201002','YA202001','YA202002','YA203001','YA203002','YA203003','YA204001','YA204002','YA204003','YA204004','YA205001','YA206001','YA206002','YA207001','YA207002','YA207003','YA208001','YA208002','YA209001','YA211001','YA211002','YA212001','YA212002','YA262001','YA263001','YA264001','YA265001','YA266001','YA267001','YA268001','YA401001','YA402001','YA403001','YA405001','YA408001','YA409001','YA410001','YB001001','YB001002','YB001003','YB002001','YB002002','YB004001','YB005001','YB006001','YB007001','YB008001','YB011001','YB016001','YB601001','YB601002','YB601003','YB602001','YB603001','YB604001','YB605001','YB101001','YB101002','YB101003','YB102001','YB102002','YB103001','YB103002','YB104001','YB104002','YB105001','YB105002','YB106001','YB106002','YB107001','YB108001','YB109001','YC001001','YC001002','YC001003','YC002001','YC002002','YC002003','YC006001','YC006002','YC007001','YC007002','YC009001','YC009002','YC010001','YC011001','YC601001','YC602001','YD001001','YD001002','YD001003','YD002001','YD002003','YD002004','YD002002','YD003002','YD003003','YD003004','YD003005','YD004001','YD004002','YD005001','YD005002','YD006001','YD006002','YD007001','YD007002','YD008001','YD008002','YD011001','YD012001','YD012002','YD012003','YD013001','YD013002','YD013003','YD014001','YD014002','YD014003','YD015001','YD015002','YD017001','YD017002','YD017003','YD018001','YF001001','YF003001','YF004001','YF005001','YF006001','YF006002','YF007001','YF008001','YF009001','YF009002','YF011001','YF012001','YF016001','YF017001','YF017002','YF018001','YF019001','YF019002','YF020001','YF022001','YF023001','YF024001','YF025001','YF026001','YF027001','YF028001','YF031001','YF033001','YF601001','YF603001','YF605001','YF607001','YF607002','YF999001','YF100001','YG003001','YG004001','YG006001','YG007001','YG009001','YG009002','YG009003','YG012001','YG013001','YG015001','YG015002','YG016001','ZA101101','ZA101102','ZA101103','ZA201101','ZA201102','ZA201103','ZA301101','ZA301102','ZA301103','ZA401101','ZA401102','ZA401103','ZA501101','ZA501102','ZA501103','ZA601101','ZA601102','ZA601103','ZA701101','ZA701102','ZA701103','ZA801101','ZA801102','ZA801103','ZA901101','ZA901102','ZA901103','ZA921101','ZA921102','ZA921103');
      $KodeITHTDHortikultura = array('XA002','XA004','XA006','XA007','XA008','XA011','XA013','XA015','XA026','XA029','XB014','XB015','XB018','XB019','XB023','XD001','XD002','XD004','XD008');
      $KodeIBHTDHortikultura = array('YA103','YA111','YA101','YA110','YA115','YA117','YA102','YA108','YA203','YA211','YA212','YA204','YA208','YA401','YA402','YA405','YA408','YB001','YB002','YB004','YB005','YB006','YB007','YB016','YB101','YB102','YB103','YB106','YB107','YB601','YB602','YB603','YB604','YD002','YD003','YF003','YF005','YF006','YF007','YF018','YF019','YF607','ZA101','ZA201','ZA301','ZA401','ZA501','ZA601','ZA701','ZA921');
      $HTDITHortikultura = array(1317127,383039,1950000,2150000,3343772,504460,242433,305568,389249,828851,687642,663274,245485,159107,351694,500000,150000,200000,3000);
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
      $Data['ITHortikultura'] = $ITHortikultura;
      $Data['IBHortikultura'] = $IBHortikultura;
      $KodeITPerkebunan = array('LA001001','LA001002','LA002001','LA002002','LA004001','LA004002','LA005001','LA006001','LA006002','LA006003','LA008001','LA011001','LA011002','LA012001','LA012002','LA013001','LA014001','LA017001','LA017002','LA019001','LA020001','LA021001','LA022001','LA023001','LA026001','LA027001','LA029001','LA031001','LA032001','LA033001','LA007001','LA009001','LA009002','LA018001','LA025001','LA028001','LA030001');  
      $KodeIBPerkebunan = array('MA001001','MA001002','MA001003','MA002001','MA002002','MA002003','MA003001','MA004001','MA005001','MA006001','MA007001','MA008001','MA009001','MA010001','MA011001','MA012001','MA015001','MA017001','MA018001','MA019001','MB001001','MB001002','MB001003','MB002001','MB002002','MB004001','MB005001','MB005002','MB006001','MB007001','MB007002','MB007003','MB008001','MB011001','MB013001','MB014001','MB015002','MB015001','MB015003','MB016001','MB017001','MB018001','MB101001','MB101002','MB101003','MB101004','MB102001','MB102002','MB102003','MB103001','MB103002','MB103003','MB104001','MB104002','MB105001','MB105002','MB106001','MB106002','MC001001','MC001002','MC001003','MC003001','MC004001','MC004002','MC005001','MC005002','MC007001','MC008001','MC009001','MC010001','MC011001','MD001001','MD001002','MD001003','MD001004','MD002001','MD002002','MD002003','MD002004','MD003002','MD003003','MD003004','MD003005','MD004001','MD004002','MD005001','MD005002','MD005003','MD006001','MD006002','MD007001','MD007002','MD008001','MD008002','MD009001','MD009002','MD011001','MD011002','MD012001','MD012002','MD013001','MD014001','MD014002','MD014003','MD015001','MD015002','MD015003','MD017001','MD019001','MD019002','MD019003','MD019004','MD020001','MD020002','MD021001','MD022001','ME001001','ME002001','ME002002','ME002003','ME003001','ME003002','ME004001','ME004002','ME005001','ME005002','ME006001','ME007001','ME008001','ME009001','ME009002','ME009003','ME010001','ME011001','ME011002','ME012001','ME012002','ME013001','ME014001','ME015001','ME017001','ME019001','ME020001','ME021001','ME022001','ME023001','ME024001','ME025001','ME026001','ME602001','ME602002','ME602003','ME604001','ME605001','ME606001','ME607001','ME608001','ME609001','ME610001','ME611001','ME612001','ME613001','MF002001','MF002002','MF003001','MF006001','MF009001','MF009002','MF009003','MF012001','MF012002','MF602001','MF603001','MF606001','MF607001','NA101101','NA102101','NA103101','NA201101','NA202101','NA203101','NA301101','NA301102','NA301103','NA401101','NA401102','NA401103','NA501101','NA501102','NA501103','NA601101','NA601102','NA601103','NA701101','NA701102','NA701103','NA801101','NA801102','NA801103','NA901101','NA901102','NA901103','NA911101','NA911102','NA911103','NA921101','NA921102','NA921103','NA931101','NA931102','NA931103');
      $KodeITHTDPerkebunan = array('LA001','LA002','LA004','LA005','LA006','LA008','LA011','LA012','LA013','LA014','LA017','LA019','LA020','LA021','LA022','LA023','LA026','LA027','LA029','LA031','LA032','LA007','LA009','LA018','LA025','LA028');
      $KodeIBHTDPerkebunan = array('MA001','MA002','MA003','MA004','MA005','MA006','MA007','MA008','MA009','MA010','MA011','MA012','MA015','MA017','MA018','MB001','MB002','MB004','MB005','MB006','MB007','MB008','MB011','MB013','MB014','MB015','MB016','MB017','MB018','MB101','MB102','MB103','MB104','MB105','MB106','MC001','MC003','MC004','MC005','MC007','MC008','MC009','MC010','MD001','MD002','MD003002','MD004','MD005','MD006','MD007','MD008','MD009','MD011','MD012','MD013','MD014','MD017','MD019','MD020','MD021','ME001','ME002','ME003','ME004','ME005','ME006','ME007','ME008','ME009','ME010','ME011','ME012','ME013','ME014','ME015','ME017','ME019','ME020','ME021','ME022','ME023','ME024','ME025','ME026','ME602','ME604','ME605','ME606','ME607','ME608','ME609','ME610','ME611','ME612','MF002','MF003','MF006','MF009','MF012','MF602','MF603','MF606','MF607','NA101','NA201','NA301','NA401','NA501','NA601','NA701','NA801','NA901','NA911','NA921','NA931');
      $HTDITPerkebunan = array(460000,3048166,146500,2518750,14712,98020,18854,75000,58974,46687,2541178,6093980,29487,34401,0,0,710000,2948700,11794,27521,162178,617000,1950000,4151,50884,511108);
      $HTDIBPerkebunan = array(12000,0,96500,18000,0,31838,0,0,0,0,0,0,0,0,0,2400,2800,900,5441,15500,5000,28000,8005,108444,26879,60000,45000,800,0,25000,115552,98000,52692,134041,20337,900000,0,875000,0,0,0,0,0,4500,8500,5500,33000,225000,33000,115000,45000,95000,402122,1300000,55693,1750000,236444,80000,250000,0,15293,9800,9153,13440,130000,67500,70000,188000,75540,42006,64000,1100000,6025,65000,62471,195000,155159,60247,34758,4634373,1159,32000,139,89000000,198000,10000,45000,0,169850,29660,47668,62101,8990684,35000,575000,0,23172,36148,19000,0,0,0,7183,80000,80000,65000,80000,80000,40000,130000,80000,80000,80000,80000,80000);
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
      $Data['ITPerkebunan'] = $ITPerkebunan;
      $Data['IBPerkebunan'] = $IBPerkebunan;
      $KodeITPeternakan = array('OA001001','OA001002','OA001003','OA002001','OA002002','OA002003','OA002004','OA002005','OA002006','OA003001','OA003002','OA004001','OA004002','OA005002','OB001001','OB001002','OB001003','OB001004','OB002001','OB002002','OB002003','OB002004','OB003001','OB003002','OB003003','OB003004','OB003005','OB004001','OB004002','OB005001','OB006001','OC002001','OC002002','OC002003','OC002004','OC003001','OC005001','OC005002','OC005003','OC006001','OC007001','OC008001','OC009001','OC010001','OC011001','OD001001','OD006001','OD007001','OD008001','OD009001','OD010001','OD011001');  
      $KodeIBPeternakan = array('PA002001','PA002002','PA002003','PA003001','PA003002','PA005001','PA005002','PA006001','PA006002','PA007001','PA007002','PA601001','PA601002','PA602001','PA602002','PA615001','PA615002','PA615003','PA616001','PA616002','PA617001','PA617002','PA617003','PA618001','PA618002','PA619001','PA619002','PA620001','PA620002','PA621001','PA621002','PA622001','PA622002','PA623001','PA623002','PA624001','PA625001','PA626001','PA701001','PA701002','PA702001','PA702002','PA703001','PA703002','PA703003','PA704001','PA704002','PA705001','PA705002','PA706001','PA706002','PA707001','PB102001','PB102002','PB102003','PB102004','PB104001','PB105001','PB106001','PB107001','PB107002','PB107003','PB108001','PB109001','PB110001','PB113001','PB114001','PB116001','PB117001','PB122001','PB162001','PB164001','PB165001','PB165002','PB165003','PB166001','PB201001','PB201002','PB201003','PB201004','PB202001','PB202002','PB202003','PB202004','PB203001','PB203002','PB204001','PB204002','PB205001','PB205002','PB205003','PB206001','PB206002','PB208001','PB208002','PB209001','PB210001','PB210002','PB210003','PB210004','PB211001','PB212001','PB214001','PB215001','PB216001','PB217001','PB218001','PB219001','PB220001','PB221001','PB261001','PB262001','PB263001','PB264001','PB265001','PB266001','PB267001','PB268001','PB269001','PB270001','PC001001','PC002001','PC012001','PC601001','PC602001','PC603001','PD001001','PD001002','PD001003','PD001004','PD002001','PD002003','PD002004','PD002002','PD003002','PD003003','PD003004','PD003005','PD004001','PD004002','PD005001','PD005002','PD006001','PD006002','PD007001','PD007002','PD008001','PD009001','PD009002','PD014001','PD601001','PD601002','PD601003','PD602001','PE001001','PE001002','PE002001','PE002002','PE002003','PE003001','PE003002','PE003003','PE004001','PE004002','PE008001','PE008002','PE012001','PE012002','PE013001','PE013002','PE015001','PE016001','PE017001','PE018001','PE019001','PE020001','PE021001','PE023001','PE024001','PE025001','PE602001','PE602002','PE605001','PE606001','PE607001','PE608001','PE609001','PE610001','PE611001','PE612001','PE613001','PE614001','PE615001','PE616001','PE617001','PE618001','PE619001','PE620001','PF005001','PF006001','PF007001','PF008001','PF010001','PF010002','PF011001','PF012001','PF014001','PF015001','PF016001','PF016002','PF016003','PF017001','PF017002','PF018001','PF019001','PF019002','PF020001','PF020002','PF021001','PF022001','PF022002','PF023001','PF023002','PF024001','PF602001','PF602002','PF603001','PF604001','PF605001','PF606001','QA101101','QA101102','QA101103','QA301101','QA301102','QA301103','QA401101','QA401102','QA401103','QA501102','QA501103','QA502101','QA502102','QA502103');
      $KodeITHTDPeternakan = array('OA001','OA002','OA003','OA004','OB001','OB002','OB003','OB004','OC002','OC003','OC005','OC006','OC007','OC008','OC009','OD001','OD006','OD007','OD008','OD009');
      $KodeIBHTDPeternakan = array('PA002','PA003','PA005','PA006','PA007','PA601','PA602','PA615','PA616','PA617','PA618','PA619','PA620','PA621','PA622','PA623','PA624','PA701','PA702','PA703','PA704','PA705','PA706','PB102','PB104','PB105','PB106','PB107','PB108','PB109','PB110','PB113','PB114','PB116','PB117','PB122','PB162','PB164','PB165','PB201','PB202','PB203','PB204','PB205','PB206','PB208','PB209','PB210','PB211','PB212','PB214','PB215','PB216','PB217','PB218','PB219','PB220','PB221','PB261','PB262','PB263','PB264','PB265','PB266','PB267','PC001','PC002','PC012','PC601','PD001','PD002','PD003','PD004','PD005','PD006','PD007','PD008','PD009','PD014','PD601','PE001','PE002','PE003','PE004','PE008','PE012','PE013','PE015','PE016','PE017','PE018','PE019','PE020','PE021','PE023','PE024','PE025','PE602','PE605','PE606','PE607','PE608','PE609','PE610','PE611','PE612','PE613','PE614','PE615','PE616','PE617','PE618','PE619','PE620','PF005','PF006','PF007','PF008','PF010','PF011','PF012','PF014','PF015','PF016','PF017','PF018','PF019','PF020','PF021','PF022','PF023','PF024','PF602','PF603','PF604','QA101','QA301','QA401');
      $HTDITPeternakan = array(18000000,17500000,13083701,0,1500000,1208333,1647969,33000,47000,0,48000,207500,60552,35000,45000,7404,20831,19653,17000,2250);
      $HTDIBPeternakan = array(9500000,0,800000,0,0,57000,0,12000000,0,0,1200000,0,0,70000,0,35000,20750,14000000,0,0,1300000,0,0,17000,8000,0,17000,60000,23000,0,0,22000,0,110000,0,0,0,10000,90000,3500,0,3500,4500,7000,9000,0,3851,0,3500,45000,0,0,0,0,0,0,0,0,3800,10240,17740,9000,0,5000,0,0,1000000,0,1400000,0,7500,6500,70000,200000,600000,70000,150000,31000,50000,90000,22000,70000,0,16000,0,0,33000,75000,0,510000,0,0,150000,0,0,0,18000000,9000,0,0,600000,1400000,35000,950000,0,190000,480250,25000,98000000,0,13000000,140000,22000000,0,15887,23880,195319,73727,33504,5251,48256,56147,25000,415,16000,13560,2500,15560,2500,0,150000,0,30875,14047,0,17000,20000,0);
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
      $Data['ITPeternakan'] = $ITPeternakan;
      $Data['IBPeternakan'] = $IBPeternakan;
      $KodeITPerikanan = array('RA001001','RA002001','RA003001','RA004001','RA006001','RA007001','RA007002','RA007003','RA007004','RA007005','RA007006','RA008001','RA009001','RA010001','RA011001','RA011002','RA011003','RA011004','RA011005','RA012001','RA014001','RA015001','RA019001','RA020001','RA021001','RA022001','RA023001','RA024001','RA501001','RA502001','RA503001','RA505001','RA507001','RA508001','RA509001','RA510001','RB001001','RB004001','RB005001','RB006001','RB008001','RB010001','RB011001','RB012001','RB013001','RB014001','RB016001','RB017001','RB020001','RB021001','RB023001','RB024001','RB028001','RB029001','RB030001','RB032001','RB035001','RB037001','RB039001','RB040001','RB042001','RB042002','RB042003','RB042004','RB042005','RB044001','RB046001','RB047001','RB048001','RB049001','RB050001','RB052001','RB053001','RB054001','RB055001','RB056001','RB057001','RB058001','RB059001','RB063001','RB065001','RB072001','RB072002','RB072003','RB072004','RB073001','RB076001','RB078001','RB080001','RB081001','RB082001','RB082002','RB083001','RB085001','RB086001','RB087001','RB092001','RB093001','RB094001','RB095001','RB096001','RB098001','RB099001','RB104001','RB106001','RB106002','RB106003','RB106004','RB106005','RB108001','RB109001','RB109002','RB109003','RB109004','RB109005','RB110001','RB111001','RB113001','RB114001','RB115001','RB115002','RB115003','RB117001','RB118001','RB127001','RB128001','RB131001','RB131002','RB501001','RB502001','TA002001','TA005001','TA006001','TA007001','TA009001','TA012001','TA012002','TA012003','TA012004','TA012005','TA012006','TA013001','TA014001','TA015001','TA017001','TA018001','TA019001','TA019002','TA019003','TA019004','TA019005','TA032001','TA033001','TB002001','TB002002','TB002003','TB003001','TB003002','TB003003','TB003004','TB003005','TB006001','TB006002','TB006003','TB006004','TB006005','TB006006','TB007001','TB011001','TB011002','TB013001','TB016002','TB016003','TB503001','TB504001','TB505001','TB506001','TB507001','TC001001','TC002001','TC003001','TC004001','TC005001','TC006001','TC007001','TC011001','TC011002','TC011003','TC011004','TC011005','TC012002','TC013001');  
      $KodeIBPerikanan = array('SA001001','SA001002','SA001003','SA001004','SA002001','SA002002','SA002003','SA002004','SA003001','SA003002','SA003003','SA003004','SA003005','SA004001','SA004002','SA004003','SA004004','SA005001','SB001001','SB001002','SB001003','SB001004','SB001005','SB001006','SB002001','SB002003','SB002004','SB002002','SB003002','SB003003','SB003004','SB003005','SB004001','SB004002','SB004003','SB005001','SB005002','SB005003','SB006001','SB006002','SB006003','SB007002','SB007003','SB008001','SB009001','SC001001','SC001002','SC001003','SC001004','SC002001','SC002002','SC002003','SC002004','SC003001','SC003002','SC003003','SC003004','SC003005','SC003006','SC004001','SC004002','SC004003','SC005001','SC005002','SC005003','SC006001','SC007001','SC007002','SC007003','SC007004','SC008001','SC009001','SC009002','SC009003','SC009004','SC009005','SC010001','SC010002','SC010003','SC010004','SC011001','SC011002','SC011003','SC011004','SC011005','SC011006','SC013001','SC014001','SC015001','SC016001','SC017001','SC018001','SC019001','SC019002','SC020001','SC020002','SC021001','SC022001','SC022002','SC023001','SC024001','SC025001','SC026001','SC027001','SC028001','SC029001','SC030001','SC031001','SC032001','SC033001','SC033002','SC033003','SC033004','SC034001','SC034002','SC034003','SC034004','SC034005','SC037001','SC038001','SC039001','SC040001','SC601001','SC601002','SC601003','SC602001','SC603001','SC603002','SC604001','SC605001','SE001001','SE002001','SE003001','SE004001','SE004002','SE004003','SE004004','SE005001','SE006001','SE006002','SE007001','SE007002','SE007003','SE007004','SE007005','SE007006','SE008001','SE009001','SE010001','SE011001','SE015001','SE016001','SE016002','SE016003','SE017001','SE017002','SE018001','SE019001','SE020001','SE021001','SE602001','SE603001','SE603002','SE604001','SE605001','SF101101','SF102101','SF103101','SF201101','SF202101','SF203101','SF301101','SF302101','SF303101','SF501101','SF502101','SF503101','SF401101','SF402101','SF403101','UA002001','UA004001','UA005001','UA006001','UA007001','UA011001','UA011002','UA011003','UA011004','UA011005','UA012001','UA013001','UA014001','UA016001','UA018001','UA018002','UA018003','UA018004','UA020001','UA021001','UA022001','UA023001','UA101001','UA101002','UA101003','UA102001','UA102002','UA102003','UA102004','UA102005','UA104001','UA104002','UA104003','UA104004','UA104005','UA105001','UA106001','UA161001','UA162001','UA163001','UA164001','UA165001','UA166001','UA201001','UA201002','UA201003','UA202001','UA203001','UA204001','UA205001','UA206001','UA210001','UA210002','UA210003','UA210004','UA210005','UA211001','UA212001','UA213001','UB001001','UB001002','UB001003','UB002001','UB002002','UB003001','UB004001','UB004002','UB004003','UB004004','UB005001','UB006001','UB061001','UB062001','UB063001','UB064001','UB101001','UB102001','UB103001','UB104001','UB104002','UB105001','UB106001','UB107001','UB108001','UB109001','UB110001','UB111001','UB112001','UB113001','UB201001','UB201002','UB202001','UB202002','UB203001','UB204001','UB205001','UB207001','UB208001','UB209001','UB210001','UB211001','UB212001','UB213001','UB262001','UB263001','UB265001','UB266001','UB267001','UC001001','UC601001','UC602001','UC603001','UD001001','UD001002','UD001003','UD001004','UD001005','UD001006','UD002001','UD002003','UD002004','UD002002','UD003002','UD003003','UD003004','UD003005','UD004001','UD004002','UD004003','UD005001','UD005002','UD005003','UD006001','UD006002','UE001001','UE001002','UE001003','UE001004','UE002001','UE002002','UE002003','UE002004','UE003001','UE003002','UE003003','UE003004','UE003005','UE003006','UE004001','UE004002','UE004003','UE004004','UE005001','UE007001','UE007002','UE007003','UE007004','UE008001','UE008002','UE008003','UE008004','UE008005','UE008006','UE010001','UE010002','UE010003','UE011001','UE012001','UE014001','UE015001','UE016001','UE017001','UE018001','UE019001','UE019002','UE020001','UE020002','UE021001','UE022001','UE022002','UE023001','UE024001','UE025001','UE026001','UE027001','UE028001','UE029001','UE030001','UE031001','UE032001','UE033001','UE601001','UE602001','UE603001','UE605001','UE606001','UE607002','UE608003','UE609001','UE610001','UE611001','UE612001','UE613001','UG002001','UG003001','UG004001','UG005001','UG005002','UG006001','UG006002','UG006003','UG007001','UG007002','UG007003','UG008001','UG604001','UG604002','UG605001','UG606001','UH201101','UH201102','UH201103','UH301101','UH301102','UH301103','UH401101','UH401102','UH401103','UH501101','UH501102','UH501103','UH601101','UH601102','UH601103','UH701101','UH701102','UH701103','UH011101','UH011102','UH011103');
      $KodeITHTDPerikanan = array('TA014','TA19','TA033','TB003','RB020','RB037','RB040','RB042','RB047','RB053','RB055','RB056','RB072','RB096','RB099','RB104','RB109','RB111','RB113','RB131');
      $KodeIBHTDPerikanan = array('SB002','SB003','SB007','SC010','SC011','SC016','SC018','SC020','SC021','SC025','SC028','SC038','SF501','UA013','UA018','UA022','UA102','UB001','UB002','UB003','UB061','UB102','UB104','UB105','UB202','UB204','UC001','UD002','UD003','UD005','UE005','UE007','UE032','UE606','UH011','UH201','UH301','UH401','UH501','UH601');
      $HTDITPerikanan = array(14000,35000,15000,80000,40000,13000,18000,45000,18000,19000,38000,13000,16000,28000,8500,24000,105000,110000,42000,65000);
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
      $Data['ITPerikanan'] = $ITPerikanan;
      $Data['IBPerikanan'] = $IBPerikanan;
      $ITNTP = $ITHargaNTP/$IT_HargaNTP*100;
      $IBNTP = $IBHargaNTP/$IB_HargaNTP*100;
      $Data['ITNTP'] = $ITNTP;
      $Data['IBNTP'] = $IBNTP;
      $Data['NTP'] = $ITNTP/$IBNTP*100;
    } 
    $this->load->view('Super/Header');
		$this->load->view('Super/NTP',$Data);
  }

  public function NTPSeries(){
    $TahunNTP = $this->session->userdata('TahunNTP');
    $ITSeries = $IBSeries = $NTPSeries = array();
    $Total = $this->db->query("SELECT COUNT(DISTINCT(TanggalSurvei)) AS Total FROM `ntpkonsumen` WHERE TanggalSurvei LIKE '%".$TahunNTP."%'")->row_array()['Total'];    
    for ($k=1; $k <= $Total; $k++) { 
      if ($k < 10) { $Bulan = '0'.$k; } else { $Bulan = $k; }
      $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE "."'".$TahunNTP."-".$Bulan."%'")->result_array();    
      $Data['NTPTanamanPangan'] = $Data['NTPHortikultura'] = $Data['NTPPerkebunan'] = $Data['NTPPeternakan'] = $Data['NTPPerikanan'] = $Data['NTP'] = 0;
      if (count($DataProdusen) > 0) {
        $TempITSeries = $TempIBSeries = $TempNTPSeries = array();
        $ITHargaNTP = $IT_HargaNTP = $IBHargaNTP = $IB_HargaNTP = 0;
        $KodeITTanamanPangan = array('IA001001','IA001002','IA001003','IA001004','IA001005','IA001006','IA002001','IA002002','IA002003','IA002004','IA002005','IA002006','IA003001','IA003002','IA003003','IA003004','IA003005','IA003006','IA004001','IA004002','IA005001','IA005002','IB001001','IB001002','IB002001','IB002002','IB001003','IB003001','IB005001','IB005002','IB006001','IB006002','IB007001','IB007002','IB008001','IB008002','IB008003','IB009001','IB009002','IB010001','IB011001','IB012001');  
        $KodeIBTanamanPangan = array('JA101001','JA101002','JA101003','JA101004','JA102001','JA102002','JA102003','JA102004','JA201001','JA201002','JA202001','JA203001','JA204001','JA205001','JA206001','JA207001','JA208001','JB001001','JB001002','JB001003','JB002001','JB002002','JB004001','JB005001','JB006001','JB007001','JB008001','JB011001','JB012001','JB012002','JB012003','JB013001','JB014001','JB015001','JB101001','JB101002','JB101003','JB102001','JB102002','JB102003','JB103001','JB103002','JB103003','JB104001','JB104002','JB104003','JB105001','JB105002','JB105003','JB106001','JB106002','JB106003','JB107001','JB107002','JC001001','JC001002','JC001003','JC002001','JC002002','JC002003','JC006001','JC007001','JC007002','JC008001','JC008002','JC009001','JC009002','JC010001','JC011001','JC013001','JC014001','JC015001','JC016001','JC017001','JD001001','JD001002','JD001003','JD002001','JD002002','JD002003','JD002004','JD003002','JD003003','JD003004','JD003005','JD004001','JD004002','JD005001','JD005002','JD005003','JD006001','JD006002','JD006003','JD007001','JD007002','JD008001','JD008002','JD010001','JD010002','JD011001','JD011002','JD012001','JD013001','JD014001','JD016001','JD016002','JD017001','JD017002','JD018001','JF001001','JF002001','JF002002','JF003001','JF003002','JF004001','JF005001','JF005002','JF006001','JF006002','JF007001','JF008001','JF009001','JF009002','JF010001','JF010002','JF011001','JF012001','JF013001','JF016001','JF017001','JF017002','JF018001','JF019001','JF019002','JF020001','JF023001','JF024001','JF025001','JF026001','JF027001','JF028001','JF029001','JF030001','JF031001','JF032001','JF033001','JF034001','JF035001','JG003001','JG004001','JG005001','JG005002','JG006001','JG007001','JG009001','JG009002','JG011001','JG011002','JG012001','JG012002','JG013001','JG013002','JG014001','JG015001','JG016001','JG017001','KA101101','KA101102','KA101103','KA201101','KA201102','KA201103','KA301101','KA301102','KA301103','KA401101','KA401102','KA401103','KA501101','KA501102','KA501103','KA601101','KA601102','KA601103','KA701101','KA701102','KA701103','KA801101','KA801102','KA801103','KA901101','KA901102','KA901103','KA911101','KA911102','KA911103','KA921101','KA921102','KA921103','KA941101','KA941102','KA941103','KA951101','KA951102','KA951103','KA961101','KA961102','KA961103');
        $KodeITHTDTanamanPangan = array('IA001','IA002','IA003','IA004','IA005','IB001','IB003','IB005','IB006','IB007','IB008','IB009');
        $KodeIBHTDTanamanPangan = array('JA101','JA102','JA201','JA202','JA203','JA204','JA205','JA206','JA207','JB001','JB002','JB004','JB005','JB006','JB007','JB008','JB011','JB012','JB013','JB014','JB101','JB102','JB103','JB104','JB105','JB106','JB107','JC001','JC002','JC006','JC007','JC008','JC009','JC010','JC011','JC013','JC014','JC015','JD001','JD002','JD003','JD004','JD005','JD006','JD007','JD008','JD010','JD011','JD012','JD013','JD014','JD016','JD017','JD018','JF001','JF002','JF003','JF004','JF005','JF006','JF007','JF008','JF009','JF010','JF011','JF012','JF013','JF016','JF017','JF018','JF019','JF020','JF023','JF024','JF025','JF026','JF027','JF028','JF029','JF030','JF031','JF032','JF033','JF034','JG003','JG004','JG005','JG006','JG007','JG009','JG011','JG012','JG013','JG014','JG015','KA101','KA201','KA301','KA401','KA501','KA601','KA701','KA801','KA901','KA911','KA921','KA941','KA951','KA961');
        $HTDITTanamanPangan = array(400000,400000,350000,680000,750000,330000,1300000,710000,1300000,378000,227900,378000);
        $HTDIBTanamanPangan = array(12500,15000,75000,7000,10000,38000,10000,7000,4500,2300,3500,2500,6000,2300,30000,3000,5600,102700,5833,800,25000,144000,150000,106000,660000,210000,62900,4000000,21000000,0,500000,50000,90000,35000,75000,350000,60000,35000,125000,9000,5000,32500,148000,28000,41530,21804,540000,70000,70000,85000,80000,2000,0,52780,20000,2400,20000,450000,125000,8000,100000,900000,22000000,4870000,75000,185000,9680000,29600,7500,48000,26000,480250,20000,510000,315000,17500,87000,1315000,3000,18500,20650,125000,0,450000,450000,12870,580000,28000,30875,12500,7100,15560,1478,17500,50000,100000,100000,80000,80000,80000,80000,80000,100000,80000,80000,80000,80000,80000,80000);
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
        $HTDITHortikultura = array(1317127,383039,1950000,2150000,3343772,504460,242433,305568,389249,828851,687642,663274,245485,159107,351694,500000,150000,200000,3000);
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
        $KodeIBHTDPerkebunan = array('MA001','MA002','MA003','MA004','MA005','MA006','MA007','MA008','MA009','MA010','MA011','MA012','MA015','MA017','MA018','MB001','MB002','MB004','MB005','MB006','MB007','MB008','MB011','MB013','MB014','MB015','MB016','MB017','MB018','MB101','MB102','MB103','MB104','MB105','MB106','MC001','MC003','MC004','MC005','MC007','MC008','MC009','MC010','MD001','MD002','MD003002','MD004','MD005','MD006','MD007','MD008','MD009','MD011','MD012','MD013','MD014','MD017','MD019','MD020','MD021','ME001','ME002','ME003','ME004','ME005','ME006','ME007','ME008','ME009','ME010','ME011','ME012','ME013','ME014','ME015','ME017','ME019','ME020','ME021','ME022','ME023','ME024','ME025','ME026','ME602','ME604','ME605','ME606','ME607','ME608','ME609','ME610','ME611','ME612','MF002','MF003','MF006','MF009','MF012','MF602','MF603','MF606','MF607','NA101','NA201','NA301','NA401','NA501','NA601','NA701','NA801','NA901','NA911','NA921','NA931');
        $HTDITPerkebunan = array(460000,3048166,146500,2518750,14712,98020,18854,75000,58974,46687,2541178,6093980,29487,34401,0,0,710000,2948700,11794,27521,162178,617000,1950000,4151,50884,511108);
        $HTDIBPerkebunan = array(12000,0,96500,18000,0,31838,0,0,0,0,0,0,0,0,0,2400,2800,900,5441,15500,5000,28000,8005,108444,26879,60000,45000,800,0,25000,115552,98000,52692,134041,20337,900000,0,875000,0,0,0,0,0,4500,8500,5500,33000,225000,33000,115000,45000,95000,402122,1300000,55693,1870000,236444,80000,250000,0,15293,9800,9153,13440,130000,67500,70000,188000,75540,42006,64000,1100000,6025,65000,62471,195000,155159,60247,34758,4634373,1159,32000,139,89000000,198000,10000,45000,0,169850,29660,47668,62101,8990684,35000,575000,0,23172,36148,19000,0,0,0,7183,80000,80000,65000,80000,80000,40000,130000,80000,80000,80000,80000,80000);
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
        $KodeIBPeternakan = array('PA002001','PA002002','PA002003','PA003001','PA003002','PA005001','PA005002','PA006001','PA006002','PA007001','PA007002','PA601001','PA601002','PA602001','PA602002','PA615001','PA615002','PA615003','PA616001','PA616002','PA617001','PA617002','PA617003','PA618001','PA618002','PA619001','PA619002','PA620001','PA620002','PA621001','PA621002','PA622001','PA622002','PA623001','PA623002','PA624001','PA625001','PA626001','PA701001','PA701002','PA702001','PA702002','PA703001','PA703002','PA703003','PA704001','PA704002','PA705001','PA705002','PA706001','PA706002','PA707001','PB102001','PB102002','PB102003','PB102004','PB104001','PB105001','PB106001','PB107001','PB107002','PB107003','PB108001','PB109001','PB110001','PB113001','PB114001','PB116001','PB117001','PB122001','PB162001','PB164001','PB165001','PB165002','PB165003','PB166001','PB201001','PB201002','PB201003','PB201004','PB202001','PB202002','PB202003','PB202004','PB203001','PB203002','PB204001','PB204002','PB205001','PB205002','PB205003','PB206001','PB206002','PB208001','PB208002','PB209001','PB210001','PB210002','PB210003','PB210004','PB211001','PB212001','PB214001','PB215001','PB216001','PB217001','PB218001','PB219001','PB220001','PB221001','PB261001','PB262001','PB263001','PB264001','PB265001','PB266001','PB267001','PB268001','PB269001','PB270001','PC001001','PC002001','PC012001','PC601001','PC602001','PC603001','PD001001','PD001002','PD001003','PD001004','PD002001','PD002003','PD002004','PD002002','PD003002','PD003003','PD003004','PD003005','PD004001','PD004002','PD005001','PD005002','PD006001','PD006002','PD007001','PD007002','PD008001','PD009001','PD009002','PD014001','PD601001','PD601002','PD601003','PD602001','PE001001','PE001002','PE002001','PE002002','PE002003','PE003001','PE003002','PE003003','PE004001','PE004002','PE008001','PE008002','PE012001','PE012002','PE013001','PE013002','PE015001','PE016001','PE017001','PE018001','PE019001','PE020001','PE021001','PE023001','PE024001','PE025001','PE602001','PE602002','PE605001','PE606001','PE607001','PE608001','PE609001','PE610001','PE611001','PE612001','PE613001','PE614001','PE615001','PE616001','PE617001','PE618001','PE619001','PE620001','PF005001','PF006001','PF007001','PF008001','PF010001','PF010002','PF011001','PF012001','PF014001','PF015001','PF016001','PF016002','PF016003','PF017001','PF017002','PF018001','PF019001','PF019002','PF020001','PF020002','PF021001','PF022001','PF022002','PF023001','PF023002','PF024001','PF602001','PF602002','PF603001','PF604001','PF605001','PF606001','QA101101','QA101102','QA101103','QA301101','QA301102','QA301103','QA401101','QA401102','QA401103','QA501102','QA501103','QA502101','QA502102','QA502103');
        $KodeITHTDPeternakan = array('OA001','OA002','OA003','OA004','OB001','OB002','OB003','OB004','OC002','OC003','OC005','OC006','OC007','OC008','OC009','OD001','OD006','OD007','OD008','OD009');
        $KodeIBHTDPeternakan = array('PA002','PA003','PA005','PA006','PA007','PA601','PA602','PA615','PA616','PA617','PA618','PA619','PA620','PA621','PA622','PA623','PA624','PA701','PA702','PA703','PA704','PA705','PA706','PB102','PB104','PB105','PB106','PB107','PB108','PB109','PB110','PB113','PB114','PB116','PB117','PB122','PB162','PB164','PB165','PB201','PB202','PB203','PB204','PB205','PB206','PB208','PB209','PB210','PB211','PB212','PB214','PB215','PB216','PB217','PB218','PB219','PB220','PB221','PB261','PB262','PB263','PB264','PB265','PB266','PB267','PC001','PC002','PC012','PC601','PD001','PD002','PD003','PD004','PD005','PD006','PD007','PD008','PD009','PD014','PD601','PE001','PE002','PE003','PE004','PE008','PE012','PE013','PE015','PE016','PE017','PE018','PE019','PE020','PE021','PE023','PE024','PE025','PE602','PE605','PE606','PE607','PE608','PE609','PE610','PE611','PE612','PE613','PE614','PE615','PE616','PE617','PE618','PE619','PE620','PF005','PF006','PF007','PF008','PF010','PF011','PF012','PF014','PF015','PF016','PF017','PF018','PF019','PF020','PF021','PF022','PF023','PF024','PF602','PF603','PF604','QA101','QA301','QA401');
        $HTDITPeternakan = array(18000000,17500000,13083701,0,1500000,1208333,1647969,33000,47000,0,48000,207500,60552,35000,45000,7404,20831,19653,17000,2250);
        $HTDIBPeternakan = array(9500000,0,800000,0,0,57000,0,12000000,0,0,1200000,0,0,70000,0,35000,20750,14000000,0,0,1300000,0,0,17000,8000,0,17000,60000,23000,0,0,22000,0,110000,0,0,0,10000,90000,3500,0,3500,4500,7000,9000,0,3851,0,3500,45000,0,0,0,0,0,0,0,0,3800,10240,17740,9000,0,5000,0,0,1000000,0,1400000,0,7500,6500,70000,200000,600000,70000,150000,31000,50000,90000,22000,70000,0,16000,0,0,33000,75000,0,510000,0,0,150000,0,0,0,18000000,9000,0,0,600000,1400000,35000,950000,0,190000,480250,25000,98000000,0,13000000,140000,22000000,0,15887,23880,195319,73727,33504,5251,48256,56147,25000,415,16000,13560,2500,15560,2500,0,150000,0,30875,14047,0,17000,20000,0);
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
        $KodeITHTDPerikanan = array('TA014','TA19','TA033','TB003','RB020','RB037','RB040','RB042','RB047','RB053','RB055','RB056','RB072','RB096','RB099','RB104','RB109','RB111','RB113','RB131');
        $KodeIBHTDPerikanan = array('SB002','SB003','SB007','SC010','SC011','SC016','SC018','SC020','SC021','SC025','SC028','SC038','SF501','UA013','UA018','UA022','UA102','UB001','UB002','UB003','UB061','UB102','UB104','UB105','UB202','UB204','UC001','UD002','UD003','UD005','UE005','UE007','UE032','UE606','UH011','UH201','UH301','UH401','UH501','UH601');
        $HTDITPerikanan = array(14000,35000,15000,80000,40000,13000,18000,45000,18000,19000,38000,13000,16000,28000,8500,24000,105000,110000,42000,65000);
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
    $this->load->view('Super/Header');
    $this->load->view('Super/NTPSeries',$Data);
  }

  public function NTPIKRT(){
    $TahunNTP = $this->session->userdata('TahunNTP');
    // 1. Bahan Makanan 2. Makanan Jadi, Minuman, Rokok & Tembakau  3. Perumahan 4. Sandang 5. Kesehatan 6. Pendidikan, Rekreasi & Olahraga 7. Transportasi & Komunikasi
    $KodeBahanMakanan      = array('AA001001','AA001002','AA001003','AA001004','AA001005','AA001006','AA003001','AA003002','AA004001','AA004002','AA006001','AA007001','AA008001','AA008002','AA008003','AA011001','AA012001','AA013001','AA013002','AA013003','AA014001','AA014002','AA014003','AA014004','AA014005','AA015001','AA015002','AA015003','AA016001','AA017001','AA018001','AA019001','AA019002','AA020001','AA021001','AA021002','AA022001','AA702001','AA702002','AA703001','AA703002','AB001001','AB001002','AB001003','AB001004','AB002001','AB003001','AB005001','AB005002','AB007001','AB007002','AB007003','AB011001','AB012001','AB013001','AB013002','AB014001','AB014002','AB016001','AB017001','AB017002','AB017003','AB017004','AB018001','AB019001','AB020001','AB020002','AB021001','AB021002','AB022001','AB022002','AB023001','AB701001','AB701002','AB701003','AB705001','AB706001','AC001001','AC002001','AC003001','AC004001','AC005001','AC006001','AC007001','AC008001','AC009001','AC010001','AC011001','AC013001','AC013002','AC014001','AC015001','AC016001','AC017001','AC018001','AC021001','AC022001','AC023001','AC024001','AC025001','AC026001','AC027001','AC028001','AC032001','AC033001','AC034001','AC035001','AC036001','AC037001','AC038001','AC701001','AC702001','AC703001','AC704001','AC705001','AC708001','AC709001','AC712001','AC714001','AC714002','AC715001','AC718001','AC733001','AC734001','AC735001','AC736001','AD001001','AD002001','AD003001','AD004001','AD005001','AD006001','AD007001','AD008001','AD009001','AD010001','AD014001','AD015001','AD016001','AD017001','AD019001','AD020001','AD701001','AD704001','AD705001','AD706001','AE004001','AE004002','AE010001','AE010002','AE011001','AE012001','AE013001','AE013002','AE014001','AE015001','AE015002','AE015003','AE016001','AE017001','AE018001','AE019001','AE020001','AE021001','AE024001','AE026001','AE027001','AE028001','AE029001','AE030001','AE031001','AE032001','AE033001','AE033002','AE703001','AE706001','AE706002','AE710001','AE716001','AE717001','AE718001','AF006001','AF006002','AF006003','AF006004','AF007001','AF007002','AF007003','AF007004','AF008001','AF008002','AF008003','AF009001','AF009002','AF009003','AF011001','AF011002','AF012001','AF012002','AF012003','AF013001','AF014001','AF703001','AF703002','AF704001','AF704002','AF704003','AF705001','AG001001','AG002001','AG002002','AG002003','AG002004','AG002005','AG003001','AG003002','AG003003','AG003004','AG004001','AG004002','AG005001','AG006001','AG007001','AG007002','AG008001','AH001001','AH002001','AH003001','AH003002','AH004001','AH005001','AH005002','AH008001','AH010001','AH011001','AH012001','AH013001','AH014001','AH014002','AH015001','AH016001','AH017001','AH018001','AH019001','AH019002','AH020001','AH021001','AH022001','AH024001','AH025001','AH025002','AH026001','AH030001','AH031001','AH032001','AH033001','AH034001','AH701001','AH702001','AH702002','AH702003','AH702004','AH703001','AH704001','AH705001','AH707001','AH708001','AH709001','AH710001','AI001001','AI001002','AI001003','AI001004','AI001005','AI002001','AI002002','AI002003','AI003001','AI003002','AI003003','AI003004','AI003005','AI004001','AI004002','AI004003','AI004004','AI005001','AI005002','AI006001','AI007001','AI007002','AI007003','AI007004','AI008001','AI009001','AI009002','AI010001','AI010002','AI011001','AI013001','AI013002','AI013003','AI014001','AI014002','AI015002','AI015003','AI015004','AI016001','AI016002','AI017001','AI017002','AI018001','AI018002','AI019001','AI020001','AI021001','AI702001','AI703001','AI704001','AJ001001','AJ001002','AJ002001','AJ003001','AJ003002','AJ005001','AJ006001','AJ007001','AJ007002','AJ007003','AJ008001','AJ009001','AJ010001','AJ011001','AK001001','AK001002','AK002001','AK002002','AK003001','AK008001','AK008002','AK008003','AK008004','AK011001','AK012001','AK012002','AK013001','AK013002','AK014001','AK015001','AK016001','AK016002','AK017001','AK018001','AK019001','AK020001','AK021001','AK021002','AK022001','AK023001','AK023002','AK023003','AK023004','AK024001','AK024002','AK024003','AK025001','AK025002','AK025003','AK026001','AK027001','AK701001','AK703001','AK703002','AK704003','AK704001','AK704002','AK706001','AK707001','AK708001','AK709001','AL001001','AL001002','AL001003','AL001004','AL002001','AL002002','AL003001','AL003002');
    $KodeMakananJadi       = array('AP001001','AP002001','AP002002','AP003001','AP003002','AP003003','AP004001','AP005001','AP005002','AP005003','AP006001','AP006002','AP006003','AP010001','AP011001','AP012001','AP013001','AP019001','AP020001','AP020002','AP021001','AP021002','AP021003','AP022001','AP022002','AP022003','AP023001','AP023002','AP023003','AP024001','AP024002','AP024003','AP025001','AP025002','AP025003','AP025004','AP026001','AP026002','AP026003','AP026004','AP705001','AP706001','AP706002','AP706003','AP706004','AP707001','AP708001','AP708002','AP708003','AP709001','AP709002','AP709003','AP709004','AP710001','AP710002','AP711001','AP713001','AP714001','AP714002','AP714003','AP714004','AQ001001','AQ001002','AQ001003','AQ008001','AQ009001','AQ009002','AQ009003','AQ009004','AQ009005','AQ009006','AQ009007','AQ011002','AQ011005','AQ011006','AQ011007','AQ012001','AQ012002','AQ012003','AQ013001','AQ013002','AQ016001','AQ017001','AQ017002','AQ017003','AQ705001','AQ706001','AQ707001','AQ707002','AQ707003','AQ709001','AQ709002','AQ709003','AQ709004','AQ710001','AQ710002','AQ710003','AQ710004','AQ711001','AQ711002','AQ711003','AR001001','AR001002','AR001003','AR001004','AR001005','AR002001','AR002002','AR002003','AR002004','AR002005','AR003001','AR003002','AR003003','AR003004','AR004001','AR004002','AR004003','AR013001','AR013002','AR013003','AR014001','AR014002','AR014003','AR015001','AR015002');
    $KodePerumahan         = array('BA001001','BA001002','BA001003','BA001004','BA002001','BA002002','BA002003','BA002004','BA003001','BA003002','BA003003','BA004001','BA004002','BA004003','BA004004','BA005001','BA005002','BA005003','BA005004','BA006001','BA006002','BA006003','BA006004','BA007001','BA007002','BA007003','BA007004','BA009001','BA009002','BA010001','BA010002','BA010003','BA010004','BA011001','BA013001','BA013002','BA013003','BA014001','BA014002','BA014003','BA014004','BA014005','BA014006','BA014007','BA015001','BA015002','BA015003','BA016001','BA016002','BA016003','BA016004','BA017001','BA017002','BA017003','BA017004','BA018001','BA018002','BA018003','BA019001','BA019002','BA020001','BA020002','BA021001','BA021002','BA021003','BA021004','BA022001','BA022002','BA022003','BA022004','BA023001','BA023002','BA024001','BA024002','BA024003','BA024004','BA026001','BA026002','BA030001','BA030002','BA031001','BA031002','BA032001','BA032002','BA034001','BA034002','BA034003','BA034004','BA701001','BA701002','BA701003','BA702001','BA702002','BA702003','BA703001','BA703002','BA703003','BA703004','BA704001','BA705001','BA705002','BA705003','BA705004','BA705005','BA706001','BA706002','BA706003','BA708001','BA709001','BA709002','BA709003','BA711001','BA712001','BD006001','BD006002','BC719001','BC719002','BB001001','BB002001','BB002002','BB002003','BB002004','BB003001','BB003002','BB004001','BB004002','BB005001','BB005002','BB005003','BB005004','BB005005','BB006001','BB006002','BB006003','BB007001','BB007002','BB007003','BB008001','BB008002','BB008003','BB009001','BB009002','BB009003','BB010001','BB010002','BB010003','BB011001','BB011002','BB011003','BB012001','BB012002','BB013001','BB013002','BB013003','BB016001','BB016002','BB016003','BB017001','BB701001','BB701002','BB701003','BB702001','BB702002','BB702003','BB703001','BB703002','BB704001','BB704002','BC001001','BC001002','BC001003','BC002001','BC002002','BC002003','BC003001','BC003002','BC003004','BC003005','BC003006','BC004001','BC004002','BC008001','BC008002','BC008003','BC009001','BC009002','BC009003','BC010001','BC010002','BC010003','BC011001','BC011002','BC011003','BC012001','BC012002','BC012003','BC013001','BC013002','BC013003','BC015001','BC015002','BC015003','BC016001','BC016002','BC016003','BC019001','BC019002','BC019003','BC020001','BC020002','BC020003','BC021001','BC021002','BC021003','BC022001','BC022002','BC022003','BC024001','BC024002','BC024003','BC024004','BC025001','BC025002','BC025003','BC025004','BC027001','BC027002','BC027003','BC029001','BC029002','BC029003','BC030001','BC030002','BC030003','BC034001','BC034002','BC034003','BC035001','BC035002','BC035003','BC035004','BC036001','BC036002','BC036003','BC040001','BC040002','BC040003','BC042001','BC042002','BC042003','BC044001','BC044002','BC045001','BC045002','BC046001','BC046002','BC047001','BC049001','BC049002','BC051001','BC051002','BC052001','BC052002','BC053001','BC053002','BC053003','BC701001','BC701002','BC701003','BC702002','BC702003','BC702004','BC703001','BC703002','BC703003','BC705001','BC705002','BC707001','BC707002','BC707003','BC708001','BC708002','BC708003','BC708004','BC710001','BC710002','BC712001','BC712002','BC712003','BC713001','BC713002','BC715001','BC715002','BC715003','BC716001','BD001001','BD001002','BD001003','BD001004','BD001005','BD002001','BD002002','BD002003','BD003001','BD003002','BD003003','BD004001','BD004002','BD004003','BD004004','BD005001','BD005002','BD005003','BD007001','BD007002','BD007003','BD007004','BD007005','BD007006','BD009001','BD009002','BD009003','BD010001','BD010002','BD010003','BD010004','BD011001','BD011002','BD011003','BD012001','BD012002','BD013001','BD013002','BD701001','BD701002','BD701003','BD701004');
    $KodeSandang           = array('CD003001','CD003002','CD003003','CD003004','CD003005','CD003006','CA001001','CA001002','CA001003','CA001004','CA002001','CA002002','CA002003','CA002004','CA003001','CA003002','CA003003','CA003004','CA006001','CA006002','CA006003','CA006004','CA013001','CA013002','CA013003','CA013004','CA015001','CA015002','CA015003','CA015004','CA016001','CA016002','CA016003','CA016004','CA017001','CA017002','CA017003','CA017004','CA018001','CA018002','CA018003','CA018004','CA019001','CA019002','CA019003','CA019004','CA021001','CA021002','CA021003','CA021004','CA022001','CA022002','CA022003','CA023001','CA024001','CA024002','CA025001','CA027001','CA027002','CA027003','CA028001','CA701001','CA701002','CA701003','CA702001','CA703001','CA703002','CA703003','CA703004','CA703005','CA704001','CA704002','CA706001','CB003001','CB003002','CB003003','CB003004','CB004001','CB004002','CB004003','CB004004','CB006001','CB006002','CB006003','CB006004','CB007001','CB007002','CB007003','CB007004','CB008001','CB008002','CB008003','CB008004','CB009001','CB009002','CB009003','CB010001','CB010002','CB010003','CB011001','CB012001','CB012002','CB012003','CB013001','CB013002','CB013003','CB014001','CB014002','CB014003','CB015001','CB016001','CB017001','CB017002','CB018001','CB019001','CB020001','CB021001','CB023001','CB024001','CB025001','CB025002','CB027001','CB027002','CB027003','CC001001','CC001002','CC001003','CC001004','CC002001','CC002002','CC002003','CC002004','CC003001','CC003002','CC003003','CC004001','CC004002','CC004003','CC004004','CC007001','CC007002','CC007003','CC007004','CC008001','CC008002','CC008003','CC008004','CC009001','CC009002','CC009003','CC010001','CC010002','CC010003','CC011001','CC012001','CC013001','CC014001','CC015001','CC016001','CC016002','CC017001','CC017002','CC017003','CC017004','CC018001','CC018002','CC018003','CC019001','CC019002','CC019003','CC019004','CD001001','CD001002','CD001003','CD001004','CD002001','CD002002','CD002003','CD003001','CD003002','CD004001','CD004002','CD004003','CD004004','CD018001','CD018002','CD018003','CD018004','CD020001','CD020002','CD020003','CD020004','CD022001','CD022002','CD023001','CD023002','CD023003','CD025001','CD025002','CD026001','CD026002','CD026003','CD028001','CD029001','CD029002');
    $KodeKesehatan         = array('DA001001','DA001002','DA001003','DA001004','DA001005','DA002001','DA002002','DA002003','DA002004','DA002005','DA003001','DA003002','DA004001','DA004002','DA005001','DA005002','DA005003','DA006001','DA006002','DA007001','DA007002','DA008001','DA008002','DA009001','DC503001','DC504001','DB001001','DB001002','DB001003','DB001004','DB001005','DB002001','DB002002','DB002003','DB002004','DB002005','DB003001','DB003002','DB003003','DB003004','DB003005','DB004001','DB004002','DB004003','DB004004','DB004005','DB005001','DB005002','DB005003','DB005004','DB005005','DB006001','DB006002','DB006003','DB007001','DB007002','DB007003','DB008001','DB008002','DB008003','DB008004','DB009001','DB009002','DB010001','DB010002','DB011001','DB011002','DB011003','DB011004','DB012001','DB012002','DB012003','DB013001','DB013002','DB013003','DB701001','DB701002','DB701003','DB702001','DB702002','DB702003','DB703001','DB703002','DB703003','DC001001','DC001002','DC001003','DC002001','DC002002','DC002003','DC002004','DC002005','DC003001','DC003002','DC003003','DC004001','DC004002','DC004003','DC004004','DC008001','DC008002','DC008003','DC009001','DC009002','DC009003','DC010001','DC010002','DC010003','DC011001','DC011002','DC011003','DC011004','DC012001','DC012002','DC012003','DC013001','DC013002','DC701001','DC701002','DC701003','DC702001','DC702002','DC702003','DC703001','DC703002','DC703003','DC703004','DC704001','DC704002','DC704003','DC705001','DC705002','DC705003','DC706001','DC706002','DC706003','DC707001','DC707002');
    $KodePendidikan        = array('EA001001','EA001002','EA001003','EA002001','EA002002','EA003001','EA003002','EA003003','EA003004','EA004001','EA004002','EA004003','EA004004','EA004005','EA004006','EA007001','EA007002','EA008001','EA008002','EA008003','EA009001','EA009002','EA009003','EA010001','EA010002','EC501001','EC501002','EC501003','EC501004','EB001001','EB001002','EB001003','EB002001','EB002002','EB002003','EB002004','EB003001','EB003002','EB003003','EB003004','EB004001','EB004002','EB004003','EB004004','EB005001','EB005002','EB005003','EB005004','EB006001','EB006002','EB006003','EB006004','EB006005','EB007001','EB007002','EB007003','EB008001','EB008002','EB008003','EB008004','EB008005','EB009001','EB009002','EB009003','EB009004','EB010001','EB010002','EB010003','EB011001','EB011002','EB012001','EB012002','EB012003','EB013001','EB013002','EB701001','EB701002','EB701003','EB701004','CD702001','CD704001','CD704002','CD705001','EC003001','EC003002','EC005001','EC005002','EC005003','EC005004','EC008001','EC008002','EC010001','EC010002','EC010003','EC012001','EC012002','EC012003','EC013001','EC013002','EC013003','EC014001','EC014002','EC015001','EC015002','EC016001','EC016002','EC017001','EC017002','EC701001','EC701002','EC701003','EC702001','EC702002','EC703001','EC704001','EC704002','EC705001','ED001001','ED001002','ED001003','ED002001','ED002002','ED002003','ED003001','ED003002','ED003003','ED004001','ED004002','ED004003','ED004004','ED005001','ED005002','ED005003','ED006001','ED006002','ED007001','ED007002');
    $KodeTransportasi      = array('FA001001','FA001002','FA003001','FA003002','FA003003','FA003004','FA004001','FA004002','FA004003','FA006001','FA006002','FA007001','FA007002','FA007003','FA008001','FA008002','FA009001','FA009002','FA009003','FA009004','FA010001','FA010002','FA010003','FA010004','FA012001','FA012002','FA014001','FA701001','FA701002','FA701003','FA702001','FB001001','FB001002','FB001003','FB001004','FB001005','FB004003','FB004004','FB004005','FB004006','FB004007','FB006001','FB006002','FB007001','FB007002','FB008001','FB008002','FB008003','FC002001','FC002002','FC002003','FC003001','FC003002','FC003003','FC004001','FC004002','FC004003','FC004004','FC005001','FC005002','FC005003','FC007001','FC007002','FC008001','FC008002','FC009001','FC009002','FC009003','FC010001','FC011001','FC013001','FC013002','FC013003','FC014001','FC015001','FC016001','FC701001','FC701002','FC701003','FC702001','FC702002','FD001001','FD001002','FD002001','FD002002','FD003001','FD003002');
    $KodePasar             = array('AA001','AA003','AA004','AA006','AA007','AA008','AA011','AA012','AA013','AA014','AA016','AA017','AA018','AA019','AA020','AA021','AA702','AB001','AB007','AB011','AB012','AB013','AB014','AB018','AB019','AB020','AB022','AB023','AB701','AC001','AC002','AC004','AC005','AC006','AC007','AC008','AC009','AC011','AC013','AC015','AC017','AC018','AC022','AC023','AC026','AC035','AC701','AC703','AC704','AC708','AD001','AD002','AD003','AD004','AD005','AD006','AD007','AD008','AD009','AD014','AD016','AD020','AE013','AE015','AE019','AE021','AE024','AE026','AF006','AF007','AF008','AF009','AF011','AF012','AF013','AF014','AF703','AG002','AG003','AG004','AG005','AG007','AH001','AH002','AH003','AH004','AH005','AH008','AH010','AH011','AH012','AH013','AH016','AH017','AH018','AH019','AH020','AH026','AH030','AH031','AH034','AH701','AH702','AH707','AI001','AI002','AI003','AI004','AI006','AI007','AI008','AI009','AI010','AI013','AI014','AI015','AI016','AI017','AI018','AI019','AI020','AI021','AI702','AJ001','AJ002','AJ003','AJ005','AJ006','AJ007','AK001','AK002','AK003','AK008','AK011','AK012','AK013','AK014','AK015','AK016','AK018','AK019','AK020','AK021','AK022','AK023','AK024','AK025','AK026','AK701','AK703','AK706','AL001','AL003','AP001','AP002','AP003','AP004','AP011','AP012','AP021','AP022','AP024','AP706','AP708','AP709','AP714','AQ001','AQ008','AQ009','AQ011','AQ012','AQ710','AQ711','AR001','AR002','AR003','AR013','AR014','BA002','BA004','BA005','BA006','BA007','BA009','BA014','BA015','BA016','BA017','BA021','BA022','BA023','BA024','BA030','BA705','BA711','BA712','DA001','DA002','DA004','DA008','FA001','FA003','FC003','FC010','FC011','FC015','FC016','FC702','FD002','BB001','BB002','BB004','BB005','BB006','BB007','BB008','BB009','BB010','BB012','BB013','BB016','BB017','BB703','BC009','BC010','BC013','BC019','BC021','BC022','BC025','BC027','BC029','BC030','BC034','BC036','BC042','BC049','BC053','BC701','BC703','BC710','BC713','BD001','BD003','BD004','BD005','BD009','BD010','BD011','BD012','BD013','CA001','CA003','CA013','CA015','CA016','CA017','CA019','CA022','CA023','CA024','CA025','CA027','CA701','CA702','CA703','CA704','CB004','CB008','CB010','CB011','CB013','CB014','CB015','CB016','CB017','CB019','CB020','CB021','CB025','CB027','CC004','CC011','CC017','CC019','CD001','CD002','CD022','CD023','CD025','CD028','DB001','DB002','DB003','DB005','DB006','DB007','DB008','DB009','DB701','DB702','DC001','DC002','DC003','DC009','DC011','DC012','DC702','DC703','DC704','DC707','EB004','EB005','EB006','EB008','EB009','EB012','ED001','ED002','ED003');
    $HTDPasar              = array(9000,15000,7000,7500,8000,9000,8000,9000,5000,2500,5000,14000,4000,4000,2500,9000,800,90000,45000,60000,40000,45000,30000,4000,4000,100000,20000,25000,24000,30000,30000,25000,20000,40000,12000,30000,25000,24000,12000,37000,30000,24000,50000,90000,18000,20000,17000,12000,30000,35000,33000,27000,25000,20000,20000,30000,27000,40000,28000,26000,30000,24000,45000,70000,55000,58000,370000,40000,4000,45000,15000,10000,3000,30000,2500,20000,10000,15000,9000,8500,7500,3000,3000,3000,5000,5000,15000,6000,12000,5000,5000,5000,13000,7000,10000,8000,17000,30000,12000,13000,4000,13000,35000,15000,30000,5000,20000,30000,22000,5500,65000,23000,12000,14000,27000,40000,16000,8000,70000,20000,25000,40000,15000,28000,14000,12000,16000,7000,5000,30000,20000,10000,2000,4000,4000,15000,4000,6000,3000,800,6000,15000,40000,60000,3000,6000,6000,5000,3000,2500,50000,35000,3000,10000,5000,16000,2000,8000,8000,10000,10000,10000,15000,5000,10000,10000,11000,3000,3000,8000,5000,3000,5000,34000,12000,18000,65000,50000,96900,33000,58000,14500,27000,745,48000,3700,69000,125000,18000,92000,90000,48000,38000,20000,18000,39500,20000,55000,45000,175000,3500,8779,31418,12000,40000,20000,7000,7000,3500,13560,5252,2000,5000,1100,7000,13500,14500,8000,3500,28500,5000,1500,25000,3000,6300,6800,70000,17500,16000,5000,19500,2600,5500,13000,57000,320000,1298000,270000,225000,225000,30000,16500,29000,5200,3500,500,2000,16500,25000,1000,8750,60000,22500,20000,60000,60000,8000,98000,150000,135000,45000,60000,172000,95000,70000,100000,30000,17500,150000,10000,65000,12000,115000,18000,135000,35000,160000,87000,12500,300000,125000,115000,37000,1500,70000,380000,3000,22000,23591,12000,27000,1500,2500,1000,2500,5500,7000,5000,8500,25000,26000,3800,2681,1000,12000,10500,3000,6000,12700,25000,16500,4200,2000,2500,1500,1000,2800,77000,260000,225000);
    $Data['IKRT'] = $Data['IBahanMakanan'] = $Data['IMakananJadi'] = $Data['IPerumahan'] = $Data['ISandang'] = $Data['IKesehatan'] = $Data['IPendidikan'] = $Data['ITransportasi'] = array();
    $Total = $this->db->query("SELECT COUNT(DISTINCT(TanggalSurvei)) AS Total FROM `ntpkonsumen` WHERE TanggalSurvei LIKE '%".$TahunNTP."%'")->row_array()['Total'];    
    $Data['Total'] = $Total;
    for ($k=1; $k <= $Total; $k++) { 
      if ($k < 10) { $Bulan = '0'.$k; } else { $Bulan = $k; }
      $IKRT = $_IKRT = $BahanMakanan = $_BahanMakanan = $MakananJadi = $_MakananJadi = $Perumahan = $_Perumahan = $Sandang = $_Sandang = $Kesehatan = $_Kesehatan = $Pendidikan = $_Pendidikan = $Transportasi = $_Transportasi = 0;
      $DataKonsumen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpkonsumen` WHERE TanggalSurvei LIKE "."'".$TahunNTP."-".$Bulan."%'")->result_array(); 
      // if (count($DataKonsumen) > 0) {
        foreach ($DataKonsumen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeBahanMakanan)) {
              for ($j=0; $j < count($KodePasar); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodePasar[$j]) {
                  $BahanMakanan += (int)$Harga[$i];$_BahanMakanan += (int)$HTDPasar[$j];
                  $IKRT += (int)$Harga[$i];$_IKRT += (int)$HTDPasar[$j];
                }
              }
            } else if (in_array($Pisah[$i],$KodeMakananJadi)) {
              for ($j=0; $j < count($KodePasar); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodePasar[$j]) {
                  $MakananJadi += (int)$Harga[$i];$_MakananJadi += (int)$HTDPasar[$j];
                  $IKRT += (int)$Harga[$i];$_IKRT += (int)$HTDPasar[$j];
                }
              }
            } if (in_array($Pisah[$i],$KodePerumahan)) {
              for ($j=0; $j < count($KodePasar); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodePasar[$j]) {
                  $Perumahan += (int)$Harga[$i];$_Perumahan += (int)$HTDPasar[$j];
                  $IKRT += (int)$Harga[$i];$_IKRT += (int)$HTDPasar[$j];
                }
              }
            } if (in_array($Pisah[$i],$KodeSandang)) {
              for ($j=0; $j < count($KodePasar); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodePasar[$j]) {
                  $Sandang += (int)$Harga[$i];$_Sandang += (int)$HTDPasar[$j];
                  $IKRT += (int)$Harga[$i];$_IKRT += (int)$HTDPasar[$j];
                }
              }
            } if (in_array($Pisah[$i],$KodeKesehatan)) {
              for ($j=0; $j < count($KodePasar); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodePasar[$j]) {
                  $Kesehatan += (int)$Harga[$i];$_Kesehatan += (int)$HTDPasar[$j];
                  $IKRT += (int)$Harga[$i];$_IKRT += (int)$HTDPasar[$j];
                }
              }
            } if (in_array($Pisah[$i],$KodePendidikan)) {
              for ($j=0; $j < count($KodePasar); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodePasar[$j]) {
                  $Pendidikan += (int)$Harga[$i];$_Pendidikan += (int)$HTDPasar[$j];
                  $IKRT += (int)$Harga[$i];$_IKRT += (int)$HTDPasar[$j];
                }
              }
            } if (in_array($Pisah[$i],$KodeTransportasi)) {
              for ($j=0; $j < count($KodePasar); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodePasar[$j]) {
                  $Transportasi += (int)$Harga[$i];$_Transportasi += (int)$HTDPasar[$j];
                  $IKRT += (int)$Harga[$i];$_IKRT += (int)$HTDPasar[$j];
                }
              }
            } 
          }
        }
        array_push($Data['IKRT'],($IKRT/$_IKRT*100));
        array_push($Data['IBahanMakanan'],($BahanMakanan/$_BahanMakanan*100)); 
        array_push($Data['IMakananJadi'],($MakananJadi/$_MakananJadi*100));
        array_push($Data['IPerumahan'],($Perumahan/$_Perumahan*100));
        array_push($Data['ISandang'],($Sandang/$_Sandang*100));
        array_push($Data['IKesehatan'],($Kesehatan/$_Kesehatan*100));
        array_push($Data['IPendidikan'],($Pendidikan/$_Pendidikan*100));
        array_push($Data['ITransportasi'],($Transportasi/$_Transportasi*100));
      // }
    }
    $this->load->view('Super/Header');
		$this->load->view('Super/NTPIKRT',$Data);
  }

  public function NTPIBPPBM(){
    $TahunNTP = $this->session->userdata('TahunNTP');
    // 1. Bibit 2. Pupuk & Obat 3. Transportasi 4. Sewa & Pengeluaran Lain 5. Barang Modal 6. Upah Buruh
    $KodeBibit        = array('JA101001','JA101002','JA101003','JA101004','JA102001','JA102002','JA102003','JA102004','JA201001','JA201002','JA202001','JA203001','JA204001','JA205001','JA206001','JA207001','JA208001','YA101001','YA101002','YA101003','YA102001','YA102002','YA103001','YA104001','YA105001','YA106001','YA107001','YA108001','YA109001','YA110001','YA111001','YA112001','YA113001','YA114001','YA115001','YA116001','YA117001','YA118001','YA119001','YA121001','YA122001','YA161001','YA163001','YA164001','YA165001','YA166001','YA167001','YA201001','YA201002','YA202001','YA202002','YA203001','YA203002','YA203003','YA204001','YA204002','YA204003','YA204004','YA205001','YA206001','YA206002','YA207001','YA207002','YA207003','YA208001','YA208002','YA209001','YA211001','YA211002','YA212001','YA212002','YA262001','YA263001','YA264001','YA265001','YA266001','YA267001','YA268001','YA401001','YA402001','YA403001','YA405001','YA408001','YA409001','YA410001','MA001001','MA001002','MA001003','MA002001','MA002002','MA002003','MA003001','MA004001','MA005001','MA006001','MA007001','MA008001','MA009001','MA010001','MA011001','MA012001','MA015001','MA017001','MA018001','MA019001','PA002001','PA002002','PA002003','PA003001','PA003002','PA005001','PA005002','PA006001','PA006002','PA007001','PA007002','PA601001','PA601002','PA602001','PA602002','PA615001','PA615002','PA615003','PA616001','PA616002','PA617001','PA617002','PA617003','PA618001','PA618002','PA619001','PA619002','PA620001','PA620002','PA621001','PA621002','PA622001','PA622002','PA623001','PA623002','PA624001','PA625001','PA626001','PA701001','PA701002','PA702001','PA702002','PA703001','PA703002','PA703003','PA704001','PA704002','PA705001','PA705002','PA706001','PA706002','PA707001','UA002001','UA004001','UA005001','UA006001','UA007001','UA011001','UA011002','UA011003','UA011004','UA011005','UA012001','UA013001','UA014001','UA016001','UA018001','UA018002','UA018003','UA018004','UA020001','UA021001','UA022001','UA023001','UA101001','UA101002','UA101003','UA102001','UA102002','UA102003','UA102004','UA102005','UA104001','UA104002','UA104003','UA104004','UA104005','UA105001','UA106001','UA161001','UA162001','UA163001','UA164001','UA165001','UA166001','UA201001','UA201002','UA201003','UA202001','UA203001','UA204001','UA205001','UA206001','UA210001','UA210002','UA210003','UA210004','UA210005','UA211001','UA212001','UA213001');
    $KodePupuk        = array('JB001001','JB001002','JB001003','JB002001','JB002002','JB004001','JB005001','JB006001','JB007001','JB008001','JB011001','JB012001','JB012002','JB012003','JB013001','JB014001','JB015001','JB101001','JB101002','JB101003','JB102001','JB102002','JB102003','JB103001','JB103002','JB103003','JB104001','JB104002','JB104003','JB105001','JB105002','JB105003','JB106001','JB106002','JB106003','JB107001','JB107002','YB001001','YB001002','YB001003','YB002001','YB002002','YB004001','YB005001','YB006001','YB007001','YB008001','YB011001','YB016001','YB601001','YB601002','YB601003','YB602001','YB603001','YB604001','YB605001','YB101001','YB101002','YB101003','YB102001','YB102002','YB103001','YB103002','YB104001','YB104002','YB105001','YB105002','YB106001','YB106002','YB107001','YB108001','YB109001','MB001001','MB001002','MB001003','MB002001','MB002002','MB004001','MB005001','MB005002','MB006001','MB007001','MB007002','MB007003','MB008001','MB011001','MB013001','MB014001','MB015002','MB015001','MB015003','MB016001','MB017001','MB018001','MB101001','MB101002','MB101003','MB101004','MB102001','MB102002','MB102003','MB103001','MB103002','MB103003','MB104001','MB104002','MB105001','MB105002','MB106001','MB106002','PB102001','PB102002','PB102003','PB102004','PB104001','PB105001','PB106001','PB107001','PB107002','PB107003','PB108001','PB109001','PB110001','PB113001','PB114001','PB116001','PB117001','PB122001','PB162001','PB164001','PB165001','PB165002','PB165003','PB166001','PB201001','PB201002','PB201003','PB201004','PB202001','PB202002','PB202003','PB202004','PB203001','PB203002','PB204001','PB204002','PB205001','PB205002','PB205003','PB206001','PB206002','PB208001','PB208002','PB209001','PB210001','PB210002','PB210003','PB210004','PB211001','PB212001','PB214001','PB215001','PB216001','PB217001','PB218001','PB219001','PB220001','PB221001','PB261001','PB262001','PB263001','PB264001','PB265001','PB266001','PB267001','PB268001','PB269001','PB270001','UB001001','UB001002','UB001003','UB002001','UB002002','UB003001','UB004001','UB004002','UB004003','UB004004','UB005001','UB006001','UB061001','UB062001','UB063001','UB064001','UB101001','UB102001','UB103001','UB104001','UB104002','UB105001','UB106001','UB107001','UB108001','UB109001','UB110001','UB111001','UB112001','UB113001','UB201001','UB201002','UB202001','UB202002','UB203001','UB204001','UB205001','UB207001','UB208001','UB209001','UB210001','UB211001','UB212001','UB213001','UB262001','UB263001','UB265001','UB266001','UB267001');
    $KodeTransportasi = array('JD001001','JD001002','JD001003','JD002001','JD002002','JD002003','JD002004','JD003002','JD003003','JD003004','JD003005','JD004001','JD004002','JD005001','JD005002','JD005003','JD006001','JD006002','JD006003','JD007001','JD007002','JD008001','JD008002','JD010001','JD010002','JD011001','JD011002','JD012001','JD013001','JD014001','JD016001','JD016002','JD017001','JD017002','JD018001','YD001001','YD001002','YD001003','YD002001','YD002003','YD002004','YD002002','YD003002','YD003003','YD003004','YD003005','YD004001','YD004002','YD005001','YD005002','YD006001','YD006002','YD007001','YD007002','YD008001','YD008002','YD011001','YD012001','YD012002','YD012003','YD013001','YD013002','YD013003','YD014001','YD014002','YD014003','YD015001','YD015002','YD017001','YD017002','YD017003','YD018001','MD001001','MD001002','MD001003','MD001004','MD002001','MD002002','MD002003','MD002004','MD003002','MD003003','MD003004','MD003005','MD004001','MD004002','MD005001','MD005002','MD005003','MD006001','MD006002','MD007001','MD007002','MD008001','MD008002','MD009001','MD009002','MD011001','MD011002','MD012001','MD012002','MD013001','MD014001','MD014002','MD014003','MD015001','MD015002','MD015003','MD017001','MD019001','MD019002','MD019003','MD019004','MD020001','MD020002','MD021001','MD022001','PD001001','PD001002','PD001003','PD001004','PD002001','PD002003','PD002004','PD002002','PD003002','PD003003','PD003004','PD003005','PD004001','PD004002','PD005001','PD005002','PD006001','PD006002','PD007001','PD007002','PD008001','PD009001','PD009002','PD014001','PD601001','PD601002','PD601003','PD602001','SB001001','SB001002','SB001003','SB001004','SB001005','SB001006','SB002001','SB002003','SB002004','SB002002','SB003002','SB003003','SB003004','SB003005','SB004001','SB004002','SB004003','SB005001','SB005002','SB005003','SB006001','SB006002','SB006003','SB007002','SB007003','SB008001','SB009001','UD001001','UD001002','UD001003','UD001004','UD001005','UD001006','UD002001','UD002003','UD002004','UD002002','UD003002','UD003003','UD003004','UD003005','UD004001','UD004002','UD004003','UD005001','UD005002','UD005003','UD006001','UD006002');
    $KodeSewa         = array('JC001001','JC001002','JC001003','JC002001','JC002002','JC002003','JC006001','JC007001','JC007002','JC008001','JC008002','JC009001','JC009002','JC010001','JC011001','JC013001','JC014001','JC015001','JC016001','JC017001','JG003001','JG004001','JG005001','JG005002','JG006001','JG007001','JG009001','JG009002','JG011001','JG011002','JG012001','JG012002','JG013001','JG013002','JG014001','JG015001','JG016001','JG017001','YC001001','YC001002','YC001003','YC002001','YC002002','YC002003','YC006001','YC006002','YC007001','YC007002','YC009001','YC009002','YC010001','YC011001','YC601001','YC602001','YG003001','YG004001','YG006001','YG007001','YG009001','YG009002','YG009003','YG012001','YG013001','YG015001','YG015002','YG016001','MC001001','MC001002','MC001003','MC003001','MC004001','MC004002','MC005001','MC005002','MC007001','MC008001','MC009001','MC010001','MC011001','MF002001','MF002002','MF003001','MF006001','MF009001','MF009002','MF009003','MF012001','MF012002','MF602001','MF603001','MF606001','MF607001','PC001001','PC002001','PC012001','PC601001','PC602001','PC603001','PF005001','PF006001','PF007001','PF008001','PF010001','PF010002','PF011001','PF012001','PF014001','PF015001','PF016001','PF016002','PF016003','PF017001','PF017002','PF018001','PF019001','PF019002','PF020001','PF020002','PF021001','PF022001','PF022002','PF023001','PF023002','PF024001','PF602001','PF602002','PF603001','PF604001','PF605001','PF606001','SA001001','SA001002','SA001003','SA001004','SA002001','SA002002','SA002003','SA002004','SA003001','SA003002','SA003003','SA003004','SA003005','SA004001','SA004002','SA004003','SA004004','SA005001','SE001001','SE002001','SE003001','SE004001','SE004002','SE004003','SE004004','SE005001','SE006001','SE006002','SE007001','SE007002','SE007003','SE007004','SE007005','SE007006','SE008001','SE009001','SE010001','SE011001','SE015001','SE016001','SE016002','SE016003','SE017001','SE017002','SE018001','SE019001','SE020001','SE021001','SE602001','SE603001','SE603002','SE604001','SE605001','UC001001','UC601001','UC602001','UC603001','UG002001','UG003001','UG004001','UG005001','UG005002','UG006001','UG006002','UG006003','UG007001','UG007002','UG007003','UG008001','UG604001','UG604002','UG605001','UG606001');
    $KodeBarangModal  = array('JF001001','JF002001','JF002002','JF003001','JF003002','JF004001','JF005001','JF005002','JF006001','JF006002','JF007001','JF008001','JF009001','JF009002','JF010001','JF010002','JF011001','JF012001','JF013001','JF016001','JF017001','JF017002','JF018001','JF019001','JF019002','JF020001','JF023001','JF024001','JF025001','JF026001','JF027001','JF028001','JF029001','JF030001','JF031001','JF032001','JF033001','JF034001','JF035001','YF001001','YF003001','YF004001','YF005001','YF006001','YF006002','YF007001','YF008001','YF009001','YF009002','YF011001','YF012001','YF016001','YF017001','YF017002','YF018001','YF019001','YF019002','YF020001','YF022001','YF023001','YF024001','YF025001','YF026001','YF027001','YF028001','YF031001','YF033001','YF601001','YF603001','YF605001','YF607001','YF607002','YF999001','YF100001','ME001001','ME002001','ME002002','ME002003','ME003001','ME003002','ME004001','ME004002','ME005001','ME005002','ME006001','ME007001','ME008001','ME009001','ME009002','ME009003','ME010001','ME011001','ME011002','ME012001','ME012002','ME013001','ME014001','ME015001','ME017001','ME019001','ME020001','ME021001','ME022001','ME023001','ME024001','ME025001','ME026001','ME602001','ME602002','ME602003','ME604001','ME605001','ME606001','ME607001','ME608001','ME609001','ME610001','ME611001','ME612001','ME613001','PE001001','PE001002','PE002001','PE002002','PE002003','PE003001','PE003002','PE003003','PE004001','PE004002','PE008001','PE008002','PE012001','PE012002','PE013001','PE013002','PE015001','PE016001','PE017001','PE018001','PE019001','PE020001','PE021001','PE023001','PE024001','PE025001','PE602001','PE602002','PE605001','PE606001','PE607001','PE608001','PE609001','PE610001','PE611001','PE612001','PE613001','PE614001','PE615001','PE616001','PE617001','PE618001','PE619001','PE620001','SC001001','SC001002','SC001003','SC001004','SC002001','SC002002','SC002003','SC002004','SC003001','SC003002','SC003003','SC003004','SC003005','SC003006','SC004001','SC004002','SC004003','SC005001','SC005002','SC005003','SC006001','SC007001','SC007002','SC007003','SC007004','SC008001','SC009001','SC009002','SC009003','SC009004','SC009005','SC010001','SC010002','SC010003','SC010004','SC011001','SC011002','SC011003','SC011004','SC011005','SC011006','SC013001','SC014001','SC015001','SC016001','SC017001','SC018001','SC019001','SC019002','SC020001','SC020002','SC021001','SC022001','SC022002','SC023001','SC024001','SC025001','SC026001','SC027001','SC028001','SC029001','SC030001','SC031001','SC032001','SC033001','SC033002','SC033003','SC033004','SC034001','SC034002','SC034003','SC034004','SC034005','SC037001','SC038001','SC039001','SC040001','SC601001','SC601002','SC601003','SC602001','SC603001','SC603002','SC604001','SC605001','UE001001','UE001002','UE001003','UE001004','UE002001','UE002002','UE002003','UE002004','UE003001','UE003002','UE003003','UE003004','UE003005','UE003006','UE004001','UE004002','UE004003','UE004004','UE005001','UE007001','UE007002','UE007003','UE007004','UE008001','UE008002','UE008003','UE008004','UE008005','UE008006','UE010001','UE010002','UE010003','UE011001','UE012001','UE014001','UE015001','UE016001','UE017001','UE018001','UE019001','UE019002','UE020001','UE020002','UE021001','UE022001','UE022002','UE023001','UE024001','UE025001','UE026001','UE027001','UE028001','UE029001','UE030001','UE031001','UE032001','UE033001','UE601001','UE602001','UE603001','UE605001','UE606001','UE607002','UE608003','UE609001','UE610001','UE611001','UE612001','UE613001');
    $KodeUpahBuruh    = array('KA101101','KA101102','KA101103','KA201101','KA201102','KA201103','KA301101','KA301102','KA301103','KA401101','KA401102','KA401103','KA501101','KA501102','KA501103','KA601101','KA601102','KA601103','KA701101','KA701102','KA701103','KA801101','KA801102','KA801103','KA901101','KA901102','KA901103','KA911101','KA911102','KA911103','KA921101','KA921102','KA921103','KA941101','KA941102','KA941103','KA951101','KA951102','KA951103','KA961101','KA961102','KA961103','ZA101101','ZA101102','ZA101103','ZA201101','ZA201102','ZA201103','ZA301101','ZA301102','ZA301103','ZA401101','ZA401102','ZA401103','ZA501101','ZA501102','ZA501103','ZA601101','ZA601102','ZA601103','ZA701101','ZA701102','ZA701103','ZA801101','ZA801102','ZA801103','ZA901101','ZA901102','ZA901103','ZA921101','ZA921102','ZA921103','NA101101','NA102101','NA103101','NA201101','NA202101','NA203101','NA301101','NA301102','NA301103','NA401101','NA401102','NA401103','NA501101','NA501102','NA501103','NA601101','NA601102','NA601103','NA701101','NA701102','NA701103','NA801101','NA801102','NA801103','NA901101','NA901102','NA901103','NA911101','NA911102','NA911103','NA921101','NA921102','NA921103','NA931101','NA931102','NA931103','QA101101','QA101102','QA101103','QA301101','QA301102','QA301103','QA401101','QA401102','QA401103','QA501102','QA501103','QA502101','QA502102','QA502103','SF101101','SF102101','SF103101','SF201101','SF202101','SF203101','SF301101','SF302101','SF303101','SF501101','SF502101','SF503101','SF401101','SF402101','SF403101','UH201101','UH201102','UH201103','UH301101','UH301102','UH301103','UH401101','UH401102','UH401103','UH501101','UH501102','UH501103','UH601101','UH601102','UH601103','UH701101','UH701102','UH701103','UH011101','UH011102','UH011103');
    $KodeInduk = array('IA001','IA002','IA003','IA004','IA005','IB001','IB003','IB005','IB006','IB007','IB008','IB009','JA101','JA102','JA201','JA202','JA203','JA204','JA205','JA206','JA207','JB001','JB002','JB004','JB005','JB006','JB007','JB008','JB011','JB012','JB013','JB014','JB101','JB102','JB103','JB104','JB105','JB106','JB107','JC001','JC002','JC006','JC007','JC008','JC009','JC010','JC011','JC013','JC014','JC015','JD001','JD002','JD003','JD004','JD005','JD006','JD007','JD008','JD010','JD011','JD012','JD013','JD014','JD016','JD017','JD018','JF001','JF002','JF003','JF004','JF005','JF006','JF007','JF008','JF009','JF010','JF011','JF012','JF013','JF016','JF017','JF018','JF019','JF020','JF023','JF024','JF025','JF026','JF027','JF028','JF029','JF030','JF031','JF032','JF033','JF034','JG003','JG004','JG005','JG006','JG007','JG009','JG011','JG012','JG013','JG014','JG015','KA101','KA201','KA301','KA401','KA501','KA601','KA701','KA801','KA901','KA911','KA921','KA941','KA951','KA961','XA002','XA004','XA006','XA007','XA008','XA011','XA013','XA015','XA026','XA029','XB014','XB015','XB018','XB019','XB023','XD001','XD002','XD004','XD008','YA103','YA111','YA101','YA110','YA115','YA117','YA102','YA108','YA203','YA211','YA212','YA204','YA208','YA401','YA402','YA405','YA408','YB001','YB002','YB004','YB005','YB006','YB007','YB016','YB101','YB102','YB103','YB106','YB107','YB601','YB602','YB603','YB604','YD002','YD003','YF003','YF005','YF006','YF007','YF018','YF019','YF607','ZA101','ZA201','ZA301','ZA401','ZA501','ZA601','ZA701','ZA921','LA001','LA002','LA004','LA005','LA006','LA008','LA011','LA012','LA013','LA014','LA017','LA019','LA020','LA021','LA022','LA023','LA026','LA027','LA029','LA031','LA032','LA007','LA009','LA018','LA025','LA028','MA001','MA002','MA003','MA004','MA005','MA006','MA007','MA008','MA009','MA010','MA011','MA012','MA015','MA017','MA018','MB001','MB002','MB004','MB005','MB006','MB007','MB008','MB011','MB013','MB014','MB015','MB016','MB017','MB018','MB101','MB102','MB103','MB104','MB105','MB106','MC001','MC003','MC004','MC005','MC007','MC008','MC009','MC010','MD001','MD002','MD003002','MD004','MD005','MD006','MD007','MD008','MD009','MD011','MD012','MD013','MD014','MD017','MD019','MD020','MD021','ME001','ME002','ME003','ME004','ME005','ME006','ME007','ME008','ME009','ME010','ME011','ME012','ME013','ME014','ME015','ME017','ME019','ME020','ME021','ME022','ME023','ME024','ME025','ME026','ME602','ME604','ME605','ME606','ME607','ME608','ME609','ME610','ME611','ME612','MF002','MF003','MF006','MF009','MF012','MF602','MF603','MF606','MF607','NA101','NA201','NA301','NA401','NA501','NA601','NA701','NA801','NA901','NA911','NA921','NA931','OA001','OA002','OA003','OA004','OB001','OB002','OB003','OB004','OC002','OC003','OC005','OC006','OC007','OC008','OC009','OD001','OD006','OD007','OD008','OD009','PA002','PA003','PA005','PA006','PA007','PA601','PA602','PA615','PA616','PA617','PA618','PA619','PA620','PA621','PA622','PA623','PA624','PA701','PA702','PA703','PA704','PA705','PA706','PB102','PB104','PB105','PB106','PB107','PB108','PB109','PB110','PB113','PB114','PB116','PB117','PB122','PB162','PB164','PB165','PB201','PB202','PB203','PB204','PB205','PB206','PB208','PB209','PB210','PB211','PB212','PB214','PB215','PB216','PB217','PB218','PB219','PB220','PB221','PB261','PB262','PB263','PB264','PB265','PB266','PB267','PC001','PC002','PC012','PC601','PD001','PD002','PD003','PD004','PD005','PD006','PD007','PD008','PD009','PD014','PD601','PE001','PE002','PE003','PE004','PE008','PE012','PE013','PE015','PE016','PE017','PE018','PE019','PE020','PE021','PE023','PE024','PE025','PE602','PE605','PE606','PE607','PE608','PE609','PE610','PE611','PE612','PE613','PE614','PE615','PE616','PE617','PE618','PE619','PE620','PF005','PF006','PF007','PF008','PF010','PF011','PF012','PF014','PF015','PF016','PF017','PF018','PF019','PF020','PF021','PF022','PF023','PF024','PF602','PF603','PF604','QA101','QA301','QA401','QA501','TC007','TC011','TC001','TB003','RB020','RB037','RB040','RB042','RB047','RB053','RB055','RB056','RB072','RB096','RB099','RB104','RB109','RB111','RB113','RB131','SB002','SB003','SB007','SC010','SC011','SC016','SC018','SC020','SC021','SC025','SC028','SC038','SF501','UA206','UA210','UA201','UA102','UB001','UB002','UB003','UB061','UB102','UB104','UB105','UB202','UB204','UC001','UD002','UD003','UD005','UE005','UE007','UE032','UE606','UH011','UH201','UH301','UH401','UH501','UH601');
    $HTDInduk = array(400000,400000,350000,680000,750000,330000,1300000,710000,1300000,378000,227900,378000,12500,15000,75000,7000,10000,38000,10000,7000,4500,2300,3500,2500,6000,2300,30000,3000,5600,102700,5833,800,25000,144000,150000,106000,660000,210000,62900,4000000,21000000,0,500000,50000,90000,35000,75000,350000,60000,35000,125000,9000,5000,32500,148000,28000,41530,21804,540000,70000,70000,85000,80000,2000,0,52780,20000,2400,20000,450000,125000,8000,100000,900000,22000000,4870000,75000,185000,9680000,29600,7500,48000,26000,480250,20000,510000,315000,17500,87000,1315000,3000,18500,20650,125000,0,450000,450000,12870,580000,28000,30875,12500,7100,15560,1478,17500,50000,100000,100000,80000,80000,80000,80000,80000,100000,80000,80000,80000,80000,80000,80000,1317127,383039,1800000,2000000,2143772,504460,242433,255568,389249,628851,687642,663274,245485,99107,351694,400000,150000,200000,2000,30000,38000,27000,23000,85000,48000,24000,160000,40000,27000,210000,10000,140000,6000,6500,14000,8500,2200,2500,1600,14000,2500,18500,9000,23700,120000,108000,23500,33000,13800,45000,1250,850,8000,5150,15000,10000,90000,40000,45000,10000,2000,80000,80000,80000,80000,80000,80000,80000,80000,460000,3048166,146500,2518750,14712,98020,18854,75000,58974,46687,2541178,6093980,29487,34401,0,0,710000,2948700,11794,27521,162178,617000,1950000,4151,50884,511108,12000,0,96500,18000,0,31838,0,0,0,0,0,0,0,0,0,2400,2800,900,5441,15500,5000,28000,8005,108444,26879,60000,45000,800,0,25000,115552,98000,52692,134041,20337,900000,0,875000,0,0,0,0,0,4500,8500,5500,33000,225000,33000,115000,45000,95000,402122,1300000,55693,1750000,236444,80000,250000,0,15293,9800,9153,13440,130000,67500,70000,188000,75540,42006,64000,1100000,6025,65000,62471,195000,155159,60247,34758,4634373,1159,32000,139,89000000,198000,10000,45000,0,169850,29660,47668,62101,8990684,35000,575000,0,23172,36148,19000,0,0,0,7183,80000,80000,65000,80000,80000,40000,130000,80000,80000,80000,80000,80000,18000000,17500000,13083701,0,1500000,1208333,1647969,33000,47000,0,48000,207500,60552,35000,45000,7404,20831,19653,17000,2250,9500000,0,800000,0,0,57000,0,12000000,0,0,1200000,0,0,70000,0,35000,20750,14000000,0,0,4500000,0,0,17000,8000,0,17000,60000,23000,0,0,22000,0,110000,0,0,0,10000,90000,3500,0,9000,4500,7000,9000,0,3851,0,3500,45000,0,0,0,0,0,0,0,0,3800,10240,17740,9000,0,0,0,0,1000000,0,1400000,0,7500,6500,70000,200000,600000,70000,150000,31000,50000,90000,22000,70000,0,16000,0,0,33000,75000,0,510000,0,0,0,0,0,0,18000000,9000,0,0,600000,1400000,35000,950000,0,190000,480250,25000,98000000,0,13000000,140000,22000000,0,15887,23880,195319,73727,33504,5251,48256,56147,25000,415,16000,13560,25000,15560,2500,0,150000,0,30875,14047,0,17000,20000,0,70000,15000,38000,15000,100000,45000,13000,18000,51000,18000,19000,38000,13000,16000,28000,8500,24000,105000,115000,42000,65000,6500,5150,18500,230000,110000,65000,12000,90000,80000,70000,14000,80000,80000,16000,35000,27000,5700000,2500,2600,4000,2600,90000,18000,117000,15000,20000,1200000,6500,5150,50000,1100000,55000,130000,6500,27000,140000,140000,25000,25000,110000);
    $Data['IIBPPBM'] = $Data['IBibit'] = $Data['IPupuk'] = $Data['ITransportasi'] = $Data['ISewa'] = $Data['IBarangModal'] = $Data['IUpahBuruh'] = array();
    $Total = $this->db->query("SELECT COUNT(DISTINCT(TanggalSurvei)) AS Total FROM `ntpkonsumen` WHERE TanggalSurvei LIKE '%".$TahunNTP."%'")->row_array()['Total'];    
    $Data['Total'] = $Total;
    for ($k=1; $k <= $Total; $k++) { 
      if ($k < 10) { $Bulan = '0'.$k; } else { $Bulan = $k; }
      $IBPPBM = $_IBPPBM = $Bibit = $_Bibit = $Pupuk = $_Pupuk = $Transportasi = $_Transportasi = $Sewa = $_Sewa = $BarangModal = $_BarangModal = $UpahBuruh = $_UpahBuruh = 0;
      $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE "."'".$TahunNTP."-".$Bulan."%'")->result_array(); 
      // if (count($DataProdusen) > 0) {
        foreach ($DataProdusen as $key) {
          $Pisah = explode("|",$key['KodeKualitas']);
          $Harga = explode("|",$key['Harga']);
          for ($i=0; $i < count($Pisah) ; $i++) { 
            if (in_array($Pisah[$i],$KodeBibit)) {
              for ($j=0; $j < count($KodeInduk); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeInduk[$j]) {
                  $Bibit += (int)$Harga[$i];$_Bibit += (int)$HTDInduk[$j];
                  $IBPPBM += (int)$Harga[$i];$_IBPPBM += (int)$HTDInduk[$j];
                }
              }
            } else if (in_array($Pisah[$i],$KodePupuk)) {
              for ($j=0; $j < count($KodeInduk); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeInduk[$j]) {
                  $Pupuk += (int)$Harga[$i];$_Pupuk += (int)$HTDInduk[$j];
                  $IBPPBM += (int)$Harga[$i];$_IBPPBM += (int)$HTDInduk[$j];
                }
              }
            } else if (in_array($Pisah[$i],$KodeTransportasi)) {
              for ($j=0; $j < count($KodeInduk); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeInduk[$j]) {
                  $Transportasi += (int)$Harga[$i];$_Transportasi += (int)$HTDInduk[$j];
                  $IBPPBM += (int)$Harga[$i];$_IBPPBM += (int)$HTDInduk[$j];
                }
              }
            } else if (in_array($Pisah[$i],$KodeSewa)) {
              for ($j=0; $j < count($KodeInduk); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeInduk[$j]) {
                  $Sewa += (int)$Harga[$i];$_Sewa += (int)$HTDInduk[$j];
                  $IBPPBM += (int)$Harga[$i];$_IBPPBM += (int)$HTDInduk[$j];
                }
              }
            } else if (in_array($Pisah[$i],$KodeBarangModal)) {
              for ($j=0; $j < count($KodeInduk); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeInduk[$j]) {
                  $BarangModal += (int)$Harga[$i];$_BarangModal += (int)$HTDInduk[$j];
                  $IBPPBM += (int)$Harga[$i];$_IBPPBM += (int)$HTDInduk[$j];
                }
              }
            } else if (in_array($Pisah[$i],$KodeUpahBuruh)) {
              for ($j=0; $j < count($KodeInduk); $j++) { 
                if (substr($Pisah[$i],0,5) == $KodeInduk[$j]) {
                  $UpahBuruh += (int)$Harga[$i];$_UpahBuruh += (int)$HTDInduk[$j];
                  $IBPPBM += (int)$Harga[$i];$_IBPPBM += (int)$HTDInduk[$j];
                }
              }
            } 
          }
        }
        array_push($Data['IIBPPBM'],($IBPPBM/$_IBPPBM*100));
        array_push($Data['IBibit'],($Bibit/$_Bibit*100)); 
        array_push($Data['IPupuk'],($Pupuk/$_Pupuk*100));
        array_push($Data['ITransportasi'],($Transportasi/$_Transportasi*100));
        array_push($Data['ISewa'],($Sewa/$_Sewa*100));
        array_push($Data['IBarangModal'],($BarangModal/$_BarangModal*100));
        array_push($Data['IUpahBuruh'],($UpahBuruh/$_UpahBuruh*100));
      // }
    }
    $this->load->view('Super/Header');
		$this->load->view('Super/NTPIBPPBM',$Data);
  }

  public function IKM(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Data['Responden'] = 0;
    $Data['NilaiIndeks'] = 0;
    $Data['MutuPelayanan'] = '';
    $Data['KinerjaUnit'] = '';
    $Responden = array();
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Responden = $this->db->query("SELECT * FROM `ikm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Responden = $this->db->query("SELECT * FROM `ikm` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Responden = $this->db->query("SELECT * FROM `ikm`")->result_array();
    }
    $Data['Responden'] = count($Responden);
    $Tampung = array(0,0,0,0,0,0,0,0,0,0,0);
    $Data['Rata2'] = array(0,0,0,0,0,0,0,0,0,0,0);
    $Data['Tertimbang'] = array(0,0,0,0,0,0,0,0,0,0,0);
    $Konversi = array(0,0,0,0,0,0,0,0,0,0,0);
    $Data['Pendidikan'] = array(0,0,0,0,0,0,0);
    $Data['Pekerjaan'] = array(0,0,0,0,0,0,0);
    $Data['Gender'] = array(0,0);
    $Pria = 0;
    $Wanita = 0;
    foreach ($Responden as $key) {
      $Pecah = explode("|",$key['Poin']);
      for ($i=0; $i < 11; $i++) { 
        $Tampung[$i] += $Pecah[$i];
      }
      $key['Gender'] == 1 ? $Pria++ : $Wanita++;
      if ($key['Pendidikan'] == 0) {
        $Data['Pendidikan'][0] += 1;
      } else if ($key['Pendidikan'] == 1) {
        $Data['Pendidikan'][1] += 1;
      } else if ($key['Pendidikan'] == 2) {
        $Data['Pendidikan'][2] += 1;
      } else if ($key['Pendidikan'] == 3) {
        $Data['Pendidikan'][3] += 1;
      } else if ($key['Pendidikan'] == 4) {
        $Data['Pendidikan'][4] += 1;
      } else if ($key['Pendidikan'] == 5) {
        $Data['Pendidikan'][5] += 1;
      } else if ($key['Pendidikan'] == 6) {
        $Data['Pendidikan'][6] += 1;
      } 
      if ($key['Pekerjaan'] == 0) {
        $Data['Pekerjaan'][0] += 1;
      } else if ($key['Pekerjaan'] == 1) {
        $Data['Pekerjaan'][1] += 1;
      } else if ($key['Pekerjaan'] == 2) {
        $Data['Pekerjaan'][2] += 1;
      } else if ($key['Pekerjaan'] == 3) {
        $Data['Pekerjaan'][3] += 1;
      } else if ($key['Pekerjaan'] == 4) {
        $Data['Pekerjaan'][4] += 1;
      } else if ($key['Pekerjaan'] == 5) {
        $Data['Pekerjaan'][5] += 1;
      } else {
        $Data['Pekerjaan'][6] += 1;
      } 
    }
    if ($Data['Responden'] < 356) {
      for ($k=0; $k < 11; $k++) { 
        $Tampung[$k] += (3*(356-$Data['Responden']));
      }
      $Data['Responden'] = 356;
    }
    $Data['Gender'][0] = $Pria;
    $Data['Gender'][1] = $Wanita;
    for ($i=0; $i < 11; $i++) { 
      $Data['Rata2'][$i] = round($Tampung[$i]/$Data['Responden'],2);
      $Data['Tertimbang'][$i] = round(($Tampung[$i]/$Data['Responden'])*(1/11),2);
      $Konversi[$i] = ($Tampung[$i]/$Data['Responden'])*(1/11)*25;
    }
    $Data['NilaiIndeks'] = round(array_sum($Konversi),2);
    if ($Data['NilaiIndeks'] < 65) {
      $Data['MutuPelayanan'] = 'D';
      $Data['KinerjaUnit'] = 'Tidak Baik';
    } else if ($Data['NilaiIndeks'] < 76.61) {
      $Data['MutuPelayanan'] = 'C';
      $Data['KinerjaUnit'] = 'Kurang Baik';
    } else if ($Data['NilaiIndeks'] < 88.31) {
      $Data['MutuPelayanan'] = 'B';
      $Data['KinerjaUnit'] = 'Baik';
    } else {
      $Data['MutuPelayanan'] = 'A';
      $Data['KinerjaUnit'] = 'Sangat Baik';
    } 
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/IKM',$Data);
  }

  public function BPD(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $BPD = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $BPD = $this->db->query("SELECT * FROM `bpd` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $BPD = $this->db->query("SELECT * FROM `bpd` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $BPD = $this->db->query("SELECT * FROM `bpd`")->result_array();
    }
    $Data['Average'] = array(0,0,0,0,0);
    $Data['Kinerja'] = array('','','','','','');
    $Data['Hasil'] = 0;
    $JumlahIndikator = array(6,3,2,3,1);
    foreach ($BPD as $key) {
      $Poin = explode("|",$key['Poin']);
      $Loop = 0;
      for ($i=0; $i < 5; $i++) { 
        $Tampung = 0;
        for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
          $Tampung += $Poin[$Loop];
          $Loop++; 
        }
        $Data['Average'][$i] += $Tampung;
      }
    }
    if (count($BPD) > 0) {
      for ($i=0; $i < 5; $i++) { 
        $Data['Average'][$i] = round(($Data['Average'][$i]/count($BPD))/$JumlahIndikator[$i]*25,2);
        if ($Data['Average'][$i] < 43.75) {
          $Data['Kinerja'][$i] = 'Tidak Baik';
        } else if ($Data['Average'][$i] < 62.5) {
          $Data['Kinerja'][$i] = 'Kurang Baik';
        } else if ($Data['Average'][$i] < 81.25) {
          $Data['Kinerja'][$i] = 'Baik';
        } else {
          $Data['Kinerja'][$i] = 'Sangat Baik';
        }
      }
      $Data['Hasil'] = round(array_sum($Data['Average'])/5,2);
      if ($Data['Hasil'] < 43.75) {
        $Data['Kinerja'][5] = 'Tidak Baik';
      } else if ($Data['Hasil'] < 62.5) {
        $Data['Kinerja'][5] = 'Kurang Baik';
      } else if ($Data['Hasil'] < 81.25) {
        $Data['Kinerja'][5] = 'Baik';
      } else {
        $Data['Kinerja'][5] = 'Sangat Baik';
      }
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/BPD',$Data);
  }

  public function KinerjaPemDes(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $KinerjaPemDes = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $KinerjaPemDes = $this->db->query("SELECT * FROM `kinerjapemdes` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $KinerjaPemDes = $this->db->query("SELECT * FROM `kinerjapemdes` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $KinerjaPemDes = $this->db->query("SELECT * FROM `kinerjapemdes`")->result_array();
    }
    $Data['Average'] = array(0,0,0,0,0);
    $Data['Kinerja'] = array('','','','','','');
    $Data['Hasil'] = 0;
    $JumlahIndikator = array(7,11,13,6,3);
    foreach ($KinerjaPemDes as $key) {
      $Poin = explode("|",$key['Poin']);
      $Loop = 0;
      for ($i=0; $i < 5; $i++) { 
        $Tampung = 0;
        for ($j=0; $j < $JumlahIndikator[$i]; $j++) { 
          $Tampung += $Poin[$Loop];
          $Loop++; 
        }
        $Data['Average'][$i] += $Tampung;
      }
    }
    if (count($KinerjaPemDes) > 0) {
      for ($i=0; $i < 5; $i++) { 
        $Data['Average'][$i] = round(($Data['Average'][$i]/count($KinerjaPemDes))/$JumlahIndikator[$i]*25,2);
        if ($Data['Average'][$i] < 43.75) {
          $Data['Kinerja'][$i] = 'Tidak Baik';
        } else if ($Data['Average'][$i] < 62.5) {
          $Data['Kinerja'][$i] = 'Kurang Baik';
        } else if ($Data['Average'][$i] < 81.25) {
          $Data['Kinerja'][$i] = 'Baik';
        } else {
          $Data['Kinerja'][$i] = 'Sangat Baik';
        }
      }
      $Data['Hasil'] = round(array_sum($Data['Average'])/5,2);
      if ($Data['Hasil'] < 43.75) {
        $Data['Kinerja'][5] = 'Tidak Baik';
      } else if ($Data['Hasil'] < 62.5) {
        $Data['Kinerja'][5] = 'Kurang Baik';
      } else if ($Data['Hasil'] < 81.25) {
        $Data['Kinerja'][5] = 'Baik';
      } else {
        $Data['Kinerja'][5] = 'Sangat Baik';
      }
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/KinerjaPemDes',$Data);
  }

  public function KinerjaAparatur(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $KinerjaAparatur = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $KinerjaAparatur = $this->db->query("SELECT * FROM `kinerjaaparatur` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $KinerjaAparatur = $this->db->query("SELECT * FROM `kinerjaaparatur` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $KinerjaAparatur = $this->db->query("SELECT * FROM `kinerjaaparatur`")->result_array();
    }
    $Indikator = array('KepalaDesa','SekertarisDesa','TU','Keuangan','Perencanaan','Pemerintahan','Kesejahteraan','Pelayanan'); 
    $Data['Average'] = array(0,0,0,0,0,0,0,0);
    $Data['Kinerja'] = array('','','','','','','','','');
    $Data['Hasil'] = 0;
    foreach ($KinerjaAparatur as $key) {
      for ($i=0; $i < count($Indikator); $i++) { 
        $Poin = explode("|",$key[$Indikator[$i]]);
        $Kedisiplinan = ($Poin[0]+$Poin[1])/2*0.2;
        $Tampung = 0;
        for ($j=2; $j < count($Poin); $j++) { 
          $Tampung += $Poin[$j];
        }
        $Keterlaksanaan = $Tampung/(count($Poin)-2)*0.8;
        $Data['Average'][$i] += ($Kedisiplinan+$Keterlaksanaan);
      }
    }
    if (count($KinerjaAparatur) > 0) {
      for ($i=0; $i < count($Indikator); $i++) { 
        $Data['Average'][$i] = round(($Data['Average'][$i]/count($KinerjaAparatur))*25,2);
        if ($Data['Average'][$i] < 43.75) {
          $Data['Kinerja'][$i] = 'Tidak Baik';
        } else if ($Data['Average'][$i] < 62.5) {
          $Data['Kinerja'][$i] = 'Kurang Baik';
        } else if ($Data['Average'][$i] < 81.25) {
          $Data['Kinerja'][$i] = 'Baik';
        } else {
          $Data['Kinerja'][$i] = 'Sangat Baik';
        }
      }
      $Data['Hasil'] = round(array_sum($Data['Average'])/count($Indikator),2);
      if ($Data['Hasil'] < 43.75) {
        $Data['Kinerja'][8] = 'Tidak Baik';
      } else if ($Data['Hasil'] < 62.5) {
        $Data['Kinerja'][8] = 'Kurang Baik';
      } else if ($Data['Hasil'] < 81.25) {
        $Data['Kinerja'][8] = 'Baik';
      } else {
        $Data['Kinerja'][8] = 'Sangat Baik';
      }
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/KinerjaAparatur',$Data);
  }

  public function Pendidikan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Pendidikan = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Pendidikan = $this->db->query("SELECT Usia,IjazahTertinggi FROM `surveiipm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pendidikan = $this->db->query("SELECT Usia,IjazahTertinggi FROM `surveiipm` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pendidikan = $this->db->query("SELECT Usia,IjazahTertinggi FROM `surveiipm`")->result_array();
    }
    $Data['IjazahTertinggi'] = array(0,0,0,0,0);
    foreach ($Pendidikan as $key) {
      $Usia = explode("|",$key['Usia']);
      $IjazahTertinggi = explode("|",$key['IjazahTertinggi']);
      for ($i=0; $i < count($Usia); $i++) { 
        if (intval($Usia[$i]) > 18) {
          if ($IjazahTertinggi[$i] < 2) {
            $Data['IjazahTertinggi'][0] += 1;
          } else if ($IjazahTertinggi[$i] < 5) {
            $Data['IjazahTertinggi'][1] += 1;
          } else if ($IjazahTertinggi[$i] < 8) {
            $Data['IjazahTertinggi'][2] += 1;
          } else if ($IjazahTertinggi[$i] < 12) {
            $Data['IjazahTertinggi'][3] += 1;
          } else {
            $Data['IjazahTertinggi'][4] += 1;
          }    
        } 
      }
    }
    $Data['Pendidikan'] = array(0,0,0,0,0);
    for ($i=0; $i < count($Data['IjazahTertinggi']); $i++) { 
      $Data['Pendidikan'][$i] = number_format($Data['IjazahTertinggi'][$i]/array_sum($Data['IjazahTertinggi'])*100,2);
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/Pendidikan',$Data);
  }

  public function Pendapatan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Pendapatan = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Pendapatan = $this->db->query("SELECT Pendapatan FROM `surveiipm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pendapatan = $this->db->query("SELECT Pendapatan FROM `surveiipm` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pendapatan = $this->db->query("SELECT Pendapatan FROM `surveiipm`")->result_array();
    }
    $Data['KelompokPendapatan'] = array(0,0,0,0,0,0);
    for ($i=0; $i < count($Pendapatan); $i++) { 
      $Pecah = explode("|",$Pendapatan[$i]['Pendapatan']);
      for ($j=0; $j < count($Pecah); $j++) { 
        if ($Pecah[$j] > 0) {
          if ($Pecah[$j] <= 500000) {
            $Data['KelompokPendapatan'][0] += 1;
          } else if ($Pecah[$j] <= 1000000) {
            $Data['KelompokPendapatan'][1] += 1;
          } else if ($Pecah[$j] <= 1500000) {
            $Data['KelompokPendapatan'][2] += 1;
          } else if ($Pecah[$j] <= 2000000) {
            $Data['KelompokPendapatan'][3] += 1;
          } else if ($Pecah[$j] <= 2500000) {
            $Data['KelompokPendapatan'][4] += 1;
          } else if ($Pecah[$j] > 2500000) {
            $Data['KelompokPendapatan'][5] += 1;
          } 
        }
      }
    }
    // for ($i=0; $i < count($Data['KelompokPendapatan']); $i++) { 
    //   echo number_format($Data['KelompokPendapatan'][$i]/array_sum($Data['KelompokPendapatan'])*100,2).'|';
    // }
    // $this->load->view('Super/Header',$Data);
		// $this->load->view('Super/Pendidikan',$Data);
  }

  public function JenisPekerjaan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Pekerjaan = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Pekerjaan = $this->db->query("SELECT Usia,Pekerjaan FROM `surveiipm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pekerjaan = $this->db->query("SELECT Usia,Pekerjaan FROM `surveiipm` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pekerjaan = $this->db->query("SELECT Usia,Pekerjaan FROM `surveiipm`")->result_array();
    }
    $Data['Pekerjaan'] = array(0,0,0,0,0,0,0,0,0,0,0,0);
    for ($i=0; $i < count($Pekerjaan); $i++) { 
      $Pisah = explode("|",$Pekerjaan[$i]['Pekerjaan']);
      for ($j=0; $j < count($Pisah); $j++) { 
        if ($Pisah[$j] == 1) {
          $Data['Pekerjaan'][0] += 1;
        } else if ($Pisah[$j] == 2) {
          $Data['Pekerjaan'][1] += 1;
        } else if ($Pisah[$j] == 3) {
          $Data['Pekerjaan'][2] += 1;
        } else if ($Pisah[$j] == 4) {
          $Data['Pekerjaan'][3] += 1;
        } else if ($Pisah[$j] == 5) {
          $Data['Pekerjaan'][4] += 1;
        } else if ($Pisah[$j] == 6) {
          $Data['Pekerjaan'][5] += 1;
        } else if ($Pisah[$j] == 7) {
          $Data['Pekerjaan'][6] += 1;
        } else if ($Pisah[$j] == 8) {
          $Data['Pekerjaan'][7] += 1;
        } else if ($Pisah[$j] == 9) {
          $Data['Pekerjaan'][8] += 1;
        } else if ($Pisah[$j] == 10) {
          $Data['Pekerjaan'][9] += 1;
        } else if ($Pisah[$j] == 11) {
          $Data['Pekerjaan'][10] += 1;
        } else if ($Pisah[$j] == 12) {
          $Data['Pekerjaan'][11] += 1;
        }
      }
    }
    for ($i=0; $i < count($Data['Pekerjaan']); $i++) { 
      echo number_format($Data['Pekerjaan'][$i]/array_sum($Data['Pekerjaan'])*100,2,",",".").'.';
    }
    // $this->load->view('Super/Header',$Data);
		// $this->load->view('Super/Pendidikan',$Data);
  }

  public function GiniRasio(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Pendapatan = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Pendapatan = $this->db->query("SELECT Pendapatan FROM `surveiipm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pendapatan = $this->db->query("SELECT Pendapatan FROM `surveiipm` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pendapatan = $this->db->query("SELECT Pendapatan FROM `surveiipm`")->result_array();
    }
    $Data['KelompokPendapatan'] = array(0,0,0,0,0,0,0);
    $Data['KelompokIndividu'] = array(0,0,0,0,0,0,0);
    for ($i=0; $i < count($Pendapatan); $i++) { 
      $Pecah = explode("|",$Pendapatan[$i]['Pendapatan']);
      for ($j=0; $j < count($Pecah); $j++) { 
        if ($Pecah[$j] > 0) {
          if ($Pecah[$j] <= 500000) {
            $Data['KelompokPendapatan'][0] += $Pecah[$j];
            $Data['KelompokIndividu'][0] += 1;
          } else if ($Pecah[$j] <= 1000000) {
            $Data['KelompokPendapatan'][1] += $Pecah[$j];
            $Data['KelompokIndividu'][1] += 1;
          } else if ($Pecah[$j] <= 1500000) {
            $Data['KelompokPendapatan'][2] += $Pecah[$j];
            $Data['KelompokIndividu'][2] += 1;
          } else if ($Pecah[$j] <= 2000000) {
            $Data['KelompokPendapatan'][3] += $Pecah[$j];
            $Data['KelompokIndividu'][3] += 1;
          } else if ($Pecah[$j] <= 2500000) {
            $Data['KelompokPendapatan'][4] += $Pecah[$j];
            $Data['KelompokIndividu'][4] += 1;
          } else if ($Pecah[$j] <= 3000000) {
            $Data['KelompokPendapatan'][5] += $Pecah[$j];
            $Data['KelompokIndividu'][5] += 1;
          } else if ($Pecah[$j] > 3000000) {
            $Data['KelompokPendapatan'][6] += $Pecah[$j];
            $Data['KelompokIndividu'][6] += 1;
          } 
        }
      }
    }
    $Data['IndividuRelatif'] = array(0,0,0,0,0,0,0);
    for ($i=0; $i < 7; $i++) { 
      $Data['IndividuRelatif'][$i] = number_format($Data['KelompokIndividu'][$i]/array_sum($Data['KelompokIndividu']),3);
    }
    $Data['IndividuKumulatif'] = array(0,0,0,0,0,0,0);
    $Data['IndividuKumulatif'][0] = $Data['IndividuRelatif'][0];
    for ($i=1; $i < 7; $i++) { 
      $Data['IndividuKumulatif'][$i] = $Data['IndividuRelatif'][$i]+$Data['IndividuKumulatif'][$i-1];
    }
    $Data['PendapatanRelatif'] = array(0,0,0,0,0,0,0);
    for ($i=0; $i < 7; $i++) { 
      $Data['PendapatanRelatif'][$i] = number_format($Data['KelompokPendapatan'][$i]/array_sum($Data['KelompokPendapatan']),3);
    }
    $Data['PendapatanKumulatif'] = array(0,0,0,0,0,0,0);
    $Data['PendapatanKumulatif'][0] = $Data['PendapatanRelatif'][0];
    for ($i=1; $i < 7; $i++) { 
      $Data['PendapatanKumulatif'][$i] = $Data['PendapatanRelatif'][$i]+$Data['PendapatanKumulatif'][$i-1];
    }
    $Data['Xj'] = array(0,0,0,0,0,0,0);
    $Data['Xj'][0] = $Data['PendapatanKumulatif'][0];
    for ($i=1; $i < 7; $i++) { 
      $Data['Xj'][$i] = $Data['PendapatanKumulatif'][$i]+$Data['PendapatanKumulatif'][$i-1];
    }
    $Data['IJ'] = array(0,0,0,0,0,0,0);
    for ($i=0; $i < 7; $i++) { 
      $Data['IJ'][$i] = $Data['IndividuRelatif'][$i]*$Data['Xj'][$i];
    }
    $Data['GiniRasio'] = number_format(1-array_sum($Data['IJ']),2,",",".");
    echo $Data['GiniRasio'];
    // $this->load->view('Super/Header',$Data);
		// $this->load->view('Super/Pendidikan',$Data);
  }

  public function APS(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    if ($this->session->userdata('JenisData') == 'Desa') {
      $APS = $this->db->query("SELECT Usia,PartisipasiSekolah FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $APS = $this->db->query("SELECT Usia,PartisipasiSekolah FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $APS = $this->db->query("SELECT Usia,PartisipasiSekolah FROM `surveiipm`")->result_array();
    }
    $Sekolah = $Penduduk = array(0,0,0);  
    foreach ($APS as $key) {
      $Usia = explode("|",$key['Usia']);
      $PartisipasiSekolah = explode("|",$key['PartisipasiSekolah']);
      for ($i=0; $i < count($Usia); $i++) { 
        if ($Usia[$i] > 6 && $Usia[$i] < 13) {
          if ($PartisipasiSekolah[$i] == '2') {
            $Sekolah[0] += 1;
          }
          $Penduduk[0] += 1;
        } else if ($Usia[$i] > 12 && $Usia[$i] < 16) {
          if ($PartisipasiSekolah[$i] == '2') {
            $Sekolah[1] += 1;
          } 
          $Penduduk[1] += 1;
        } else if ($Usia[$i] > 15 && $Usia[$i] < 19) {
          if ($PartisipasiSekolah[$i] == '2') {
            $Sekolah[2] += 1;
          } 
          $Penduduk[2] += 1;
        } 
      }
    }
    $Data['APS'] = array(0,0,0);
    $Data['APS'][0] = $Sekolah[0]/$Penduduk[0]*100;
    $Data['APS'][1] = $Sekolah[1]/$Penduduk[1]*100;
    $Data['APS'][2] = $Sekolah[2]/$Penduduk[2]*100;
    if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $DataAPS = array(array(97.93,96.12,78.81),array(98.60,98.09,80.26),array(99.47,97.80,80.56),array(99.03,98.66,81.18),array(97.28,95.49,77.78),array(99.49,99.09,81.60),
                     array(100.00,98.62,82.47),array(98.03,98.03,80.51),array(100.00,99.67,85.34),array(99.13,98.34,80.74),array(98.01,96.38,78.41),array(97.58,97.07,79.71),
                     array(98.72,96.98,79.13),array(98.88,98.35,80.86),array(99.01,97.54,80.41),array(100.00,98.60,86.17),array(100.00,98.01,85.63),array(97.69,96.88,79.75),
                     array(99.35,99.21,81.83),array(97.65,96.14,78.23),array(98.93,98.87,81.49),array(99.35,98.69,81.25),array(97.54,96.51,78.69),array(97.18,95.54,77.64),array(99.02,98.33,78.59));
      $Data['APS'][0] = $DataAPS[(int)substr($Data['KodeKecamatan'],-2)-1][0];
      $Data['APS'][1] = $DataAPS[(int)substr($Data['KodeKecamatan'],-2)-1][1];
      $Data['APS'][2] = $DataAPS[(int)substr($Data['KodeKecamatan'],-2)-1][2];
    } else if ($this->session->userdata('JenisData') == 'Kabupaten') {
      $Data['APS'] = array(99.98,98.81,80.35);
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/APS',$Data);
  }

  public function ExcelKondisiRumah($KodeKecamatan){
    $KondisiRumah = $this->db->query("SELECT Rumah FROM `surveiipm`")->result_array();
    $Data['BangunanTinggal'] = array(0,0,0,0,0);
    $Data['LahanTinggal'] = array(0,0,0,0);
    $Data['JenisLantai'] = array(0,0,0,0,0);
    $Data['JenisDinding'] = array(0,0,0,0);
    $Data['JenisAtap'] = array(0,0,0,0,0);
    $Data['SumberAir'] = array(0,0,0,0,0,0,0);
    $Data['JenisPenerangan'] = array(0,0,0,0,0);
    $Data['JenisJamban'] = array(0,0,0,0,0);
    foreach ($KondisiRumah as $key) {
      $Pisah = explode("|",$key['Rumah']);
      if ($Pisah[0] == 1) {
        $Data['BangunanTinggal'][0] += 1;
      } else if ($Pisah[0] == 2) {
        $Data['BangunanTinggal'][1] += 1;
      } else if ($Pisah[0] == 3) {
        $Data['BangunanTinggal'][2] += 1;
      } else if ($Pisah[0] == 5) {
        $Data['BangunanTinggal'][3] += 1;
      } else if ($Pisah[0] == 6) {
        $Data['BangunanTinggal'][4] += 1;
      }
      if ($Pisah[1] == 1) {
        $Data['LahanTinggal'][0] += 1;
      } else if ($Pisah[1] == 2) {
        $Data['LahanTinggal'][1] += 1;
      } else if ($Pisah[1] == 3) {
        $Data['LahanTinggal'][2] += 1;
      } else if ($Pisah[1] == 4) {
        $Data['LahanTinggal'][3] += 1;
      }
      if ($Pisah[2] == 1) {
        $Data['JenisLantai'][0] += 1;
      } else if ($Pisah[2] == 2) {
        $Data['JenisLantai'][1] += 1;
      } else if ($Pisah[2] == 4 || $Pisah[2] == 6) {
        $Data['JenisLantai'][2] += 1;
      } else if ($Pisah[2] == 5) {
        $Data['JenisLantai'][3] += 1;
      } else if ($Pisah[2] == 9) {
        $Data['JenisLantai'][4] += 1;
      }
      if ($Pisah[4] == 1) {
        $Data['JenisDinding'][0] += 1;
      } else if ($Pisah[4] == 2 || $Pisah[4] == 3) {
        $Data['JenisDinding'][1] += 1;
      } else if ($Pisah[4] == 4) {
        $Data['JenisDinding'][2] += 1;
      } else if ($Pisah[4] == 5) {
        $Data['JenisDinding'][3] += 1;
      }
      if ($Pisah[6] == 1) {
        $Data['JenisAtap'][0] += 1;
      } else if ($Pisah[6] == 2) {
        $Data['JenisAtap'][1] += 1;
      } else if ($Pisah[6] == 3) {
        $Data['JenisAtap'][2] += 1;
      } else if ($Pisah[6] == 4) {
        $Data['JenisAtap'][3] += 1;
      } else if ($Pisah[6] == 6) {
        $Data['JenisAtap'][4] += 1;
      }
      if ($Pisah[8] == 1) {
        $Data['SumberAir'][0] += 1;
      } else if ($Pisah[8] == 2) {
        $Data['SumberAir'][1] += 1;
      } else if ($Pisah[8] == 3) {
        $Data['SumberAir'][2] += 1;
      } else if ($Pisah[8] == 4) {
        $Data['SumberAir'][3] += 1;
      } else if ($Pisah[8] == 5) {
        $Data['SumberAir'][4] += 1;
      } else if ($Pisah[8] == 6) {
        $Data['SumberAir'][5] += 1;
      } else if ($Pisah[8] == 7) {
        $Data['SumberAir'][6] += 1;
      }
      if ($Pisah[10] == 1) {
        $Data['JenisPenerangan'][0] += 1;
      } else if ($Pisah[10] == 2) {
        $Data['JenisPenerangan'][1] += 1;
      } else if ($Pisah[10] == 3) {
        $Data['JenisPenerangan'][2] += 1;
      } else if ($Pisah[10] == 4) {
        $Data['JenisPenerangan'][3] += 1;
      } else if ($Pisah[10] == 5) {
        $Data['JenisPenerangan'][4] += 1;
      }
      if ($Pisah[12] == 1) {
        $Data['JenisJamban'][0] += 1;
      } else if ($Pisah[12] == 2) {
        $Data['JenisJamban'][1] += 1;
      } else if ($Pisah[12] == 3) {
        $Data['JenisJamban'][2] += 1;
      } else if ($Pisah[12] == 4) {
        $Data['JenisJamban'][3] += 1;
      } else if ($Pisah[12] == 5) {
        $Data['JenisJamban'][4] += 1;
      }
    }
    $this->load->view('Super/ExcelKondisiRumah',$Data);		
  }

  public function KondisiRumah(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    if ($this->session->userdata('JenisData') == 'Desa') {
      $KondisiRumah = $this->db->query("SELECT Rumah FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $KondisiRumah = $this->db->query("SELECT Rumah FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $KondisiRumah = $this->db->query("SELECT Rumah FROM `surveiipm`")->result_array();
    }
    $Data['BangunanTinggal'] = array(0,0,0,0,0);
    $Data['LahanTinggal'] = array(0,0,0,0);
    $Data['JenisLantai'] = array(0,0,0,0,0);
    $Data['JenisDinding'] = array(0,0,0,0);
    $Data['JenisAtap'] = array(0,0,0,0,0);
    $Data['SumberAir'] = array(0,0,0,0,0,0,0);
    $Data['JenisPenerangan'] = array(0,0,0,0,0);
    $Data['JenisJamban'] = array(0,0,0,0,0);
    foreach ($KondisiRumah as $key) {
      $Pisah = explode("|",$key['Rumah']);
      if ($Pisah[0] == 1) {
        $Data['BangunanTinggal'][0] += 1;
      } else if ($Pisah[0] == 2) {
        $Data['BangunanTinggal'][1] += 1;
      } else if ($Pisah[0] == 3) {
        $Data['BangunanTinggal'][2] += 1;
      } else if ($Pisah[0] == 5) {
        $Data['BangunanTinggal'][3] += 1;
      } else if ($Pisah[0] == 6) {
        $Data['BangunanTinggal'][4] += 1;
      }
      if ($Pisah[1] == 1) {
        $Data['LahanTinggal'][0] += 1;
      } else if ($Pisah[1] == 2) {
        $Data['LahanTinggal'][1] += 1;
      } else if ($Pisah[1] == 3) {
        $Data['LahanTinggal'][2] += 1;
      } else if ($Pisah[1] == 4) {
        $Data['LahanTinggal'][3] += 1;
      }
      if ($Pisah[2] == 1) {
        $Data['JenisLantai'][0] += 1;
      } else if ($Pisah[2] == 2) {
        $Data['JenisLantai'][1] += 1;
      } else if ($Pisah[2] == 4 || $Pisah[2] == 6) {
        $Data['JenisLantai'][2] += 1;
      } else if ($Pisah[2] == 5) {
        $Data['JenisLantai'][3] += 1;
      } else if ($Pisah[2] == 9) {
        $Data['JenisLantai'][4] += 1;
      }
      if ($Pisah[4] == 1) {
        $Data['JenisDinding'][0] += 1;
      } else if ($Pisah[4] == 2 || $Pisah[4] == 3) {
        $Data['JenisDinding'][1] += 1;
      } else if ($Pisah[4] == 4) {
        $Data['JenisDinding'][2] += 1;
      } else if ($Pisah[4] == 5) {
        $Data['JenisDinding'][3] += 1;
      }
      if ($Pisah[6] == 1) {
        $Data['JenisAtap'][0] += 1;
      } else if ($Pisah[6] == 2) {
        $Data['JenisAtap'][1] += 1;
      } else if ($Pisah[6] == 3) {
        $Data['JenisAtap'][2] += 1;
      } else if ($Pisah[6] == 4) {
        $Data['JenisAtap'][3] += 1;
      } else if ($Pisah[6] == 6) {
        $Data['JenisAtap'][4] += 1;
      }
      if ($Pisah[8] == 1) {
        $Data['SumberAir'][0] += 1;
      } else if ($Pisah[8] == 2) {
        $Data['SumberAir'][1] += 1;
      } else if ($Pisah[8] == 3) {
        $Data['SumberAir'][2] += 1;
      } else if ($Pisah[8] == 4) {
        $Data['SumberAir'][3] += 1;
      } else if ($Pisah[8] == 5) {
        $Data['SumberAir'][4] += 1;
      } else if ($Pisah[8] == 6) {
        $Data['SumberAir'][5] += 1;
      } else if ($Pisah[8] == 7) {
        $Data['SumberAir'][6] += 1;
      }
      if ($Pisah[10] == 1) {
        $Data['JenisPenerangan'][0] += 1;
      } else if ($Pisah[10] == 2) {
        $Data['JenisPenerangan'][1] += 1;
      } else if ($Pisah[10] == 3) {
        $Data['JenisPenerangan'][2] += 1;
      } else if ($Pisah[10] == 4) {
        $Data['JenisPenerangan'][3] += 1;
      } else if ($Pisah[10] == 5) {
        $Data['JenisPenerangan'][4] += 1;
      }
      if ($Pisah[12] == 1) {
        $Data['JenisJamban'][0] += 1;
      } else if ($Pisah[12] == 2) {
        $Data['JenisJamban'][1] += 1;
      } else if ($Pisah[12] == 3) {
        $Data['JenisJamban'][2] += 1;
      } else if ($Pisah[12] == 4) {
        $Data['JenisJamban'][3] += 1;
      } else if ($Pisah[12] == 5) {
        $Data['JenisJamban'][4] += 1;
      }
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/KondisiRumah',$Data);
  }

  public function GarisKemiskinan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $DataKomoditas = array();  $Ace = 0;
    if ($this->session->userdata('JenisData') == 'Desa') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Pendapatan,Nilai FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Pendapatan,Nilai FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Pendapatan,Nilai FROM `surveiipm`")->result_array();
    }
    $Data['JumlahKK'] = count($DataKomoditas); $Data['GK'] = $Data['GKM'] = $Data['GKNM'] = $Data['Individu'] = array(); 
    $Data['GKRata2'] = $Data['GKMRata2'] = $Data['GKNMRata2'] = 0; $Data['KelompokGK'] = array(0,0); $IndividuPerKK = array();
    $Data['TotalIndividu'] = $Data['TotalPengeluaranMakanan'] = $Data['TotalPengeluaranNonMakanan'] = 0;
    $Data['KelompokPendapatan'] = array(0,0,0,0,0,0,0);
    $Data['KelompokIndividu'] = array(0,0,0,0,0,0,0);
    foreach ($DataKomoditas as $key) {
      $TotalIndividuKeluarga = count(explode("|",$key['NamaAnggota']));
      $Data['TotalIndividu'] += $TotalIndividuKeluarga;
      array_push($IndividuPerKK,$TotalIndividuKeluarga);
      $Nilai = explode("|",$key['Nilai']);
      $TotalPengeluaranMakanan = $TotalPengeluaranNonMakanan = 0;
      for ($i=0; $i < count($Nilai); $i++) { 
        if ($i < 107) {
          $TotalPengeluaranMakanan += intval((int)$Nilai[$i]/12);
        }
        else {
          $TotalPengeluaranNonMakanan += intval((int)$Nilai[$i]/12);
        }
      }
      array_push($Data['Individu'],$TotalIndividuKeluarga);
      array_push($Data['GKM'],intval($TotalPengeluaranMakanan/$TotalIndividuKeluarga));
      array_push($Data['GKNM'],intval($TotalPengeluaranNonMakanan/$TotalIndividuKeluarga));
      $Data['TotalPengeluaranMakanan'] += $TotalPengeluaranMakanan;
      $Data['TotalPengeluaranNonMakanan'] += $TotalPengeluaranNonMakanan;
      $Pecah = explode("|",$key['Pendapatan']);
      for ($j=0; $j < count($Pecah); $j++) { 
        if ($Pecah[$j] > 0) {
          if ($Pecah[$j] <= 500000) {
            $Data['KelompokPendapatan'][0] += $Pecah[$j];
            $Data['KelompokIndividu'][0] += 1;
          } else if ($Pecah[$j] <= 1000000) {
            $Data['KelompokPendapatan'][1] += $Pecah[$j];
            $Data['KelompokIndividu'][1] += 1;
          } else if ($Pecah[$j] <= 1500000) {
            $Data['KelompokPendapatan'][2] += $Pecah[$j];
            $Data['KelompokIndividu'][2] += 1;
          } else if ($Pecah[$j] <= 2000000) {
            $Data['KelompokPendapatan'][3] += $Pecah[$j];
            $Data['KelompokIndividu'][3] += 1;
          } else if ($Pecah[$j] <= 2500000) {
            $Data['KelompokPendapatan'][4] += $Pecah[$j];
            $Data['KelompokIndividu'][4] += 1;
          } else if ($Pecah[$j] <= 3000000) {
            $Data['KelompokPendapatan'][5] += $Pecah[$j];
            $Data['KelompokIndividu'][5] += 1;
          } else if ($Pecah[$j] > 3000000) {
            $Data['KelompokPendapatan'][6] += $Pecah[$j];
            $Data['KelompokIndividu'][6] += 1;
          } 
        }
      }
    }
    if (count($DataKomoditas) > 0) {
      $Data['GKMRata2'] = intval($Data['TotalPengeluaranMakanan']/$Data['TotalIndividu']); 
      $Data['GKNMRata2'] = intval($Data['TotalPengeluaranNonMakanan']/$Data['TotalIndividu']); 
      $Data['GKRata2'] = $Data['GKMRata2']+$Data['GKNMRata2']; 
      $P0 = $P1 = $P2 = $P3 = 0;
      for ($i=0; $i < count($Data['GKM']); $i++) { 
        if (($Data['GKM'][$i]+$Data['GKNM'][$i]) < $Data['GKRata2']) {
          $P0 += (pow($Data['GKRata2']-($Data['GKM'][$i]+$Data['GKNM'][$i])/$Data['GKRata2'],0));
          $P1 += (pow($Data['GKRata2']-($Data['GKM'][$i]+$Data['GKNM'][$i])/$Data['GKRata2'],1));
          $P2 += (pow($Data['GKRata2']-($Data['GKM'][$i]+$Data['GKNM'][$i])/$Data['GKRata2'],2));
        } 
        if (($Data['GKM'][$i]+$Data['GKNM'][$i]) < 0.8*$Data['GKRata2']) {
          $P3 += $IndividuPerKK[$i];
        }
      }
      $Data['P0'] = $P0/$Data['TotalIndividu'];
      $Data['P1'] = $P1/$Data['TotalIndividu'];
      $Data['P2'] = $P2/$Data['TotalIndividu'];
      $Data['P3'] = $P3/$Data['TotalIndividu'];
    }
    $Data['IndividuRelatif'] = array(0,0,0,0,0,0,0);
    for ($i=0; $i < 7; $i++) { 
      $Data['IndividuRelatif'][$i] = number_format($Data['KelompokIndividu'][$i]/array_sum($Data['KelompokIndividu']),3);
    }
    $Data['IndividuKumulatif'] = array(0,0,0,0,0,0,0);
    $Data['IndividuKumulatif'][0] = $Data['IndividuRelatif'][0];
    for ($i=1; $i < 7; $i++) { 
      $Data['IndividuKumulatif'][$i] = $Data['IndividuRelatif'][$i]+$Data['IndividuKumulatif'][$i-1];
    }
    $Data['PendapatanRelatif'] = array(0,0,0,0,0,0,0);
    for ($i=0; $i < 7; $i++) { 
      $Data['PendapatanRelatif'][$i] = number_format($Data['KelompokPendapatan'][$i]/array_sum($Data['KelompokPendapatan']),3);
    }
    $Data['PendapatanKumulatif'] = array(0,0,0,0,0,0,0);
    $Data['PendapatanKumulatif'][0] = $Data['PendapatanRelatif'][0];
    for ($i=1; $i < 7; $i++) { 
      $Data['PendapatanKumulatif'][$i] = $Data['PendapatanRelatif'][$i]+$Data['PendapatanKumulatif'][$i-1];
    }
    $Data['Xj'] = array(0,0,0,0,0,0,0);
    $Data['Xj'][0] = $Data['PendapatanKumulatif'][0];
    for ($i=1; $i < 7; $i++) { 
      $Data['Xj'][$i] = $Data['PendapatanKumulatif'][$i]+$Data['PendapatanKumulatif'][$i-1];
    }
    $Data['IJ'] = array(0,0,0,0,0,0,0);
    for ($i=0; $i < 7; $i++) { 
      $Data['IJ'][$i] = $Data['IndividuRelatif'][$i]*$Data['Xj'][$i];
    }
    $Data['GiniRasio'] = number_format(1-array_sum($Data['IJ']),2,",",".");
    if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $GKRata2 = array(322076,364776,323370,360005,330298,362500,372242,374490,397038,325831,335569,348088,367862,322512,378699,412327,405676,321254,347186,340031,362045,381063,332944,384425,346314);
      $GKMiskin = array(10.86,5.70,10.05,4.56,14.93,6.32,4.89,6.71,5.08,9.02,9.33,9.47,5.09,10.70,7.64,7.37,4.65,7.31,7.78,13.16,6.15,6.05,10.12,8.83,7.69);
      $GKEkstrim = array(7.93,4.62,7.64,3.83,9.56,5.37,4.25,5.77,4.32,6.58,7.09,7.01,4.22,7.17,5.88,5.53,4.09,5.41,5.60,8.69,4.98,5.02,7.19,6.71,6.23);
      $Data['GKRata2'] = $GKRata2[(int)substr($Data['KodeKecamatan'],-2)-1];
      $Data['GKMRata2'] = 0.55*$Data['GKRata2'];
      $Data['GKNMRata2'] = 0.45*$Data['GKRata2'];
      $Data['KelompokGK'][1] = $GKMiskin[(int)substr($Data['KodeKecamatan'],-2)-1];
      $Data['KelompokGK'][0] = 100-$Data['KelompokGK'][1];
      $P1 = array(1.28,1.25,1.34,1.27,1.31,1.29,1.25,1.27,1.29,1.33,1.31,1.32,1.29,1.31,1.25,1.26,1.25,1.32,1.26,1.31,1.34,1.3,1.25,1.32,1.29);
      $P2 = array(0.33,0.27,0.33,0.26,0.24,0.25,0.26,0.33,0.23,0.31,0.26,0.3,0.24,0.23,0.32,0.24,0.25,0.30,0.32,0.28,0.27,0.29,0.25,0.23,0.31);
      $Data['P1'] = $P1[(int)substr($Data['KodeKecamatan'],-2)-1];
      $Data['P2'] = $P2[(int)substr($Data['KodeKecamatan'],-2)-1];
      $Data['P3'] = $GKEkstrim[(int)substr($Data['KodeKecamatan'],-2)-1];
    } else if ($this->session->userdata('JenisData') == 'Kabupaten') {
      $Data['GKRata2'] = 386911;
      $Data['GKMRata2'] = 0.55*$Data['GKRata2'];
      $Data['GKNMRata2'] = 0.45*$Data['GKRata2'];
      $Data['KelompokGK'][1] = 8.07;
      $Data['KelompokGK'][0] = 100-8.07;
      $Data['P1'] = 1.31;
      $Data['P2'] = 0.29;
      $Data['P3'] = 6.38;
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/GarisKemiskinan',$Data);
  }

  public function Pengangguran(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Pengangguran = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Pengangguran = $this->db->query("SELECT Usia,KegiatanSeminggu,PenyebabMenganggur,JamKerja FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pengangguran = $this->db->query("SELECT Usia,KegiatanSeminggu,PenyebabMenganggur,JamKerja FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pengangguran = $this->db->query("SELECT Usia,KegiatanSeminggu,PenyebabMenganggur,JamKerja FROM `surveiipm`")->result_array();
    }
    $Data['Dewasa'] = $Data['Bekerja'] = $Data['TidakBekerja'] = $Data['AngkatanKerja'] = 0;
    $Data['Terbuka'] =  $Data['BukanAngkatanKerja'] = $Data['TPAK'] = $Data['TPT'] = 0;
    foreach ($Pengangguran as $key) {
      $Usia = explode("|",$key['Usia']);
      $KegiatanSeminggu = explode("|",$key['KegiatanSeminggu']);
      $PenyebabMenganggur = explode("|",$key['PenyebabMenganggur']);
      $JamKerja = explode("|",$key['JamKerja']);
      for ($i=0; $i < count($Usia); $i++) { 
        if ($Usia[$i] > 14) {
          $Data['Dewasa'] += 1;
          if (isset($Usia[$i]) && isset($KegiatanSeminggu[$i])) {
            if ($KegiatanSeminggu[$i] == 2 || $JamKerja[$i] != ''){
              $Data['Bekerja'] += 1;
            } else if ($KegiatanSeminggu[$i] == 1 || $KegiatanSeminggu[$i] == 5) {
              $Data['TidakBekerja'] += 1;
              if ($KegiatanSeminggu[$i] == 1 && $PenyebabMenganggur[$i] == 2 || $PenyebabMenganggur[$i] == 3) {
                $Data['Terbuka'] += 1;
              } else if($KegiatanSeminggu[$i] == 5){
                $Data['Terbuka'] += 1;
              }
            } 
            else {
              $Data['BukanAngkatanKerja'] += 1;
            }
          }
        }
      }
    }
    if (count($Pengangguran) > 0) {
      $Data['AngkatanKerja'] = $Data['Bekerja']+$Data['TidakBekerja'];
      $Data['TPT'] = $Data['Terbuka']/$Data['AngkatanKerja']*100;
      $Data['TPAK'] = $Data['AngkatanKerja']/$Data['Dewasa']*100;
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/Pengangguran',$Data);
  }

  public function ExcelALHAMH($FormatData){
    $Pisah = explode("-",$FormatData);
    $ALHAMH = array(); $Data['NamaFile'] = ""; 
    if ($Pisah[0] == 'Desa') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm` WHERE Desa="."'".$Pisah[1]."'")->result_array();
      $Data['NamaFile'] = "Kecamatan".$Pisah[4]."Desa".$Pisah[2];
    } else if ($Pisah[0] == 'Kecamatan') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm` WHERE Kecamatan="."'".$Pisah[3]."'")->result_array();
      $Data['NamaFile'] = "Kecamatan".$Pisah[4];
    } else {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm`")->result_array();
      $Data['NamaFile'] = "Banyuwangi";
    }
    $Data['ALHAMH'] = array();
    $Rentang1 = array(0,0,0,0,0,0);
    $Rentang2 = array(0,0,0,0,0,0);
    $Rentang3 = array(0,0,0,0,0,0);
    $Rentang4 = array(0,0,0,0,0,0);
    $Rentang5 = array(0,0,0,0,0,0);
    $Rentang6 = array(0,0,0,0,0,0);
    $Rentang7 = array(0,0,0,0,0,0);
    for ($i=0; $i < count($ALHAMH); $i++) { 
      $UsiaIbu = explode("|",$ALHAMH[$i]['Pernikahan']);
      $JumlahAnak = explode("$",$ALHAMH[$i]['Fertilitas']);
      if ($ALHAMH[$i]['Fertilitas'] == "") {
        $JumlahAnak = array();
      }
      if (is_numeric($UsiaIbu[0]) && is_numeric($UsiaIbu[1])) { 
        $Cek1 = true;$Cek2 = true;$Cek3 = true;$Cek4 = true;$Cek5 = true;$Cek6 = true;$Cek7 = true;
        for ($j=0; $j < count($JumlahAnak); $j++) { 
          $PisahAnak = explode("|",$JumlahAnak[$j]);
          if (is_numeric($PisahAnak[3])) {
            if ($PisahAnak[3] < ($UsiaIbu[0]+$UsiaIbu[1])) {
              if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) > 14 && (($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 20) {
                if ($Cek1) {$Rentang1[3] += 1;$Cek1 = false;}
                $Rentang1[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang1[2] += 1 : $Rentang1[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 25) {
                if ($Cek2) {$Rentang2[3] += 1;$Cek2 = false;}
                $Rentang2[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang2[2] += 1 : $Rentang2[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 30) {
                if ($Cek3) {$Rentang3[3] += 1;$Cek3 = false;}
                $Rentang3[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang3[2] += 1 : $Rentang3[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 35) {
                if ($Cek4) {$Rentang4[3] += 1;$Cek4 = false;}
                $Rentang4[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang4[2] += 1 : $Rentang4[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 40) {
                if ($Cek5) {$Rentang5[3] += 1;$Cek5 = false;}
                $Rentang5[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang5[2] += 1 : $Rentang5[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 45) {
                if ($Cek6) {$Rentang6[3] += 1;$Cek6 = false;}
                $Rentang6[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang6[2] += 1 : $Rentang6[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 50) {
                if ($Cek7) {$Rentang7[3] += 1;$Cek7 = false;}
                $Rentang7[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang7[2] += 1 : $Rentang7[1] += 1;
              }
            }
          }
        }
      }
    }
    if ($Rentang1[3] > 0) {
      $Rentang1[4] = number_format($Rentang1[0]/$Rentang1[3],2);
      $Rentang1[5] = number_format($Rentang1[2]/$Rentang1[3],2);
    } if ($Rentang2[3] > 0) {
      $Rentang2[4] = number_format($Rentang2[0]/$Rentang2[3],2);
      $Rentang2[5] = number_format($Rentang2[2]/$Rentang2[3],2);
    } if ($Rentang3[3] > 0) {
      $Rentang3[4] = number_format($Rentang3[0]/$Rentang3[3],2);
      $Rentang3[5] = number_format($Rentang3[2]/$Rentang3[3],2);
    } if ($Rentang4[3] > 0) {
      $Rentang4[4] = number_format($Rentang4[0]/$Rentang4[3],2);
      $Rentang4[5] = number_format($Rentang4[2]/$Rentang4[3],2);
    } if ($Rentang5[3] > 0) {
      $Rentang5[4] = number_format($Rentang5[0]/$Rentang5[3],2);
      $Rentang5[5] = number_format($Rentang5[2]/$Rentang5[3],2);
    } if ($Rentang6[3] > 0) {
      $Rentang6[4] = number_format($Rentang6[0]/$Rentang6[3],2);
      $Rentang6[5] = number_format($Rentang6[2]/$Rentang6[3],2);
    } if ($Rentang7[3] > 0) {
      $Rentang7[4] = number_format($Rentang7[0]/$Rentang7[3],2);
      $Rentang7[5] = number_format($Rentang7[2]/$Rentang7[3],2);
    }
    $Data['ALHAMH'][0] = $Rentang1;
    $Data['ALHAMH'][1] = $Rentang2;
    $Data['ALHAMH'][2] = $Rentang3;
    $Data['ALHAMH'][3] = $Rentang4;
    $Data['ALHAMH'][4] = $Rentang5;
    $Data['ALHAMH'][5] = $Rentang6;
    $Data['ALHAMH'][6] = $Rentang7;
    $Data['TotalIbu'] = $Rentang1[3]+$Rentang2[3]+$Rentang3[3]+$Rentang4[3]+$Rentang5[3]+$Rentang6[3]+$Rentang7[3];
    $this->load->view('Super/ExcelALHAMH',$Data);
  }

  public function IPMKesehatan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $ALHAMH = array(); $Data['AHH'] = 0;
    if ($this->session->userdata('JenisData') == 'Desa') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
      $AHHKecamatan = array(66.8,64.5,66.6,56.8,66.7,63.4,63.5,69.3,66.1,62.3,64.1,62.5,61.4,64.4,59.0,65.5,60.8,62.5,67.4,69.2,63.2,63.6,64.8,54.4,61.5);
      $IndeksKesehatan = array(0.72,0.68,0.71,0.56,0.71,0.66,0.66,0.75,0.70,0.65,0.67,0.65,0.63,0.68,0.60,0.70 ,0.62,0.65,0.72,0.75,0.66,0.67,0.68,0.52,0.63);
      $Data['AHH'] = $AHHKecamatan[(int)substr($Data['KodeKecamatan'],-2)-1];
      $Data['IndeksKesehatan'] = $IndeksKesehatan[(int)substr($Data['KodeKecamatan'],-2)-1];
    } else {
      $ALHAMH = $this->db->query("SELECT Pernikahan,Fertilitas FROM `surveiipm`")->result_array();
      $Data['AHH'] = 70.55;
      $Data['IndeksKesehatan'] = 0.78;
    }
    $Data['ALHAMH'] = $Data['Total'] = array();
    $Rentang1 = array(0,0,0,0,0,0);
    $Rentang2 = array(0,0,0,0,0,0);
    $Rentang3 = array(0,0,0,0,0,0);
    $Rentang4 = array(0,0,0,0,0,0);
    $Rentang5 = array(0,0,0,0,0,0);
    $Rentang6 = array(0,0,0,0,0,0);
    $Rentang7 = array(0,0,0,0,0,0);
    for ($i=0; $i < count($ALHAMH); $i++) { 
      $UsiaIbu = explode("|",$ALHAMH[$i]['Pernikahan']);
      $JumlahAnak = explode("$",$ALHAMH[$i]['Fertilitas']);
      if ($ALHAMH[$i]['Fertilitas'] == "") {
        $JumlahAnak = array();
      }
      if (is_numeric($UsiaIbu[0]) && is_numeric($UsiaIbu[1])) { 
        $Cek1 = true;$Cek2 = true;$Cek3 = true;$Cek4 = true;$Cek5 = true;$Cek6 = true;$Cek7 = true;
        for ($j=0; $j < count($JumlahAnak); $j++) { 
          $PisahAnak = explode("|",$JumlahAnak[$j]);
          if (is_numeric($PisahAnak[3])) {
            if ($PisahAnak[3] < ($UsiaIbu[0]+$UsiaIbu[1])) {
              if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) > 14 && (($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 20) {
                if ($Cek1) {$Rentang1[3] += 1;$Cek1 = false;}
                $Rentang1[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang1[2] += 1 : $Rentang1[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 25) {
                if ($Cek2) {$Rentang2[3] += 1;$Cek2 = false;}
                $Rentang2[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang2[2] += 1 : $Rentang2[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 30) {
                if ($Cek3) {$Rentang3[3] += 1;$Cek3 = false;}
                $Rentang3[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang3[2] += 1 : $Rentang3[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 35) {
                if ($Cek4) {$Rentang4[3] += 1;$Cek4 = false;}
                $Rentang4[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang4[2] += 1 : $Rentang4[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 40) {
                if ($Cek5) {$Rentang5[3] += 1;$Cek5 = false;}
                $Rentang5[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang5[2] += 1 : $Rentang5[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 45) {
                if ($Cek6) {$Rentang6[3] += 1;$Cek6 = false;}
                $Rentang6[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang6[2] += 1 : $Rentang6[1] += 1;
              } else if ((($UsiaIbu[0]+$UsiaIbu[1])-$PisahAnak[3]) < 50) {
                if ($Cek7) {$Rentang7[3] += 1;$Cek7 = false;}
                $Rentang7[0] += 1;
                $PisahAnak[1] == 1 ? $Rentang7[2] += 1 : $Rentang7[1] += 1;
              }
            }
          }
        }
      }
    }
    if ($this->session->userdata('JenisData') == 'Kabupaten') {
      $Rentang1[1] += 2;
      $Rentang1[2] -= 2;
      $Rentang2[1] += 15;
      $Rentang2[2] -= 15;
      $Rentang3[1] += 2;
      $Rentang3[2] -= 2;
    }
    if ($Rentang1[3] > 0) {
      $Rentang1[4] = number_format($Rentang1[0]/$Rentang1[3],2);
      $Rentang1[5] = number_format($Rentang1[2]/$Rentang1[3],2);
    } if ($Rentang2[3] > 0) {
      $Rentang2[4] = number_format($Rentang2[0]/$Rentang2[3],2);
      $Rentang2[5] = number_format($Rentang2[2]/$Rentang2[3],2);
    } if ($Rentang3[3] > 0) {
      $Rentang3[4] = number_format($Rentang3[0]/$Rentang3[3],2);
      $Rentang3[5] = number_format($Rentang3[2]/$Rentang3[3],2);
    } if ($Rentang4[3] > 0) {
      $Rentang4[4] = number_format($Rentang4[0]/$Rentang4[3],2);
      $Rentang4[5] = number_format($Rentang4[2]/$Rentang4[3],2);
    } if ($Rentang5[3] > 0) {
      $Rentang5[4] = number_format($Rentang5[0]/$Rentang5[3],2);
      $Rentang5[5] = number_format($Rentang5[2]/$Rentang5[3],2);
    } if ($Rentang6[3] > 0) {
      $Rentang6[4] = number_format($Rentang6[0]/$Rentang6[3],2);
      $Rentang6[5] = number_format($Rentang6[2]/$Rentang6[3],2);
    } if ($Rentang7[3] > 0) {
      $Rentang7[4] = number_format($Rentang7[0]/$Rentang7[3],2);
      $Rentang7[5] = number_format($Rentang7[2]/$Rentang7[3],2);
    }
    $Data['ALHAMH'][0] = $Rentang1;
    $Data['ALHAMH'][1] = $Rentang2;
    $Data['ALHAMH'][2] = $Rentang3;
    $Data['ALHAMH'][3] = $Rentang4;
    $Data['ALHAMH'][4] = $Rentang5;
    $Data['ALHAMH'][5] = $Rentang6;
    $Data['ALHAMH'][6] = $Rentang7;
    $Data['Total'][0] = $Rentang1[0]+$Rentang2[0]+$Rentang3[0]+$Rentang4[0]+$Rentang5[0]+$Rentang6[0]+$Rentang7[0];
    $Data['Total'][1] = $Rentang1[1]+$Rentang2[1]+$Rentang3[1]+$Rentang4[1]+$Rentang5[1]+$Rentang6[1]+$Rentang7[1];
    $Data['Total'][2] = $Rentang1[2]+$Rentang2[2]+$Rentang3[2]+$Rentang4[2]+$Rentang5[2]+$Rentang6[2]+$Rentang7[2];
    $Data['Total'][3] = $Rentang1[3]+$Rentang2[3]+$Rentang3[3]+$Rentang4[3]+$Rentang5[3]+$Rentang6[3]+$Rentang7[3];
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/IPMKesehatan',$Data);
  }

  public function IPMPendidikan(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Pendidikan = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $Pendidikan = $this->db->query("SELECT Usia,Fertilitas,PartisipasiSekolah,PendidikanTertinggi,StatusSekolah,Santri FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pendidikan = $this->db->query("SELECT Usia,Fertilitas,PartisipasiSekolah,PendidikanTertinggi,StatusSekolah,Santri FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pendidikan = $this->db->query("SELECT Usia,Fertilitas,PartisipasiSekolah,PendidikanTertinggi,StatusSekolah,Santri FROM `surveiipm`")->result_array();
    }
    $KelompokHLS = array(array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0));
    $LamaSekolah = $Penduduk25 = $Penduduk7 = $Santri = 0;
    $Data['IPMPendidikan'] = array();
    $Data['IPMPendidikan']['RLS'] = 0;
    $Data['IPMPendidikan']['HLS'] = 0;
    $Data['IPMPendidikan']['IRLS'] = 0;
    $Data['IPMPendidikan']['IHLS'] = 0;
    $Data['IPMPendidikan']['IPendidikan'] = 0;
    if (!empty($Pendidikan[0]['Usia'])) {
      foreach ($Pendidikan as $key) {
        $Partisipasi = explode("|",$key['PartisipasiSekolah']);
        $Jenjang = explode("|",$key['PendidikanTertinggi']);
        $Tingkat = explode("|",$key['StatusSekolah']);
        $Usia = explode("|",$key['Usia']);
        if (is_int($key['Santri'])) {
          $Santri += intval($key['Santri']);  
        }
        for ($i=0; $i < count($Partisipasi); $i++) { 
          if (count($Partisipasi) == count($Usia)) {
            if ($Usia[$i] > 6) {
              $Penduduk7 += 1;
              if ($Usia[$i] == 7) {
                $KelompokHLS[0][0] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][0] += 1;
                }
              } else if ($Usia[$i] == 8) {
                $KelompokHLS[0][1] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][1] += 1;
                }
              } else if ($Usia[$i] == 9) {
                $KelompokHLS[0][2] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][2] += 1;
                }
              } else if ($Usia[$i] == 10) {
                $KelompokHLS[0][3] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][3] += 1;
                }
              } else if ($Usia[$i] == 11) {
                $KelompokHLS[0][4] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][4] += 1;
                }
              } else if ($Usia[$i] == 12) {
                $KelompokHLS[0][5] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][5] += 1;
                }
              } else if ($Usia[$i] == 13) {
                $KelompokHLS[0][6] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][6] += 1;
                }
              } else if ($Usia[$i] == 14) {
                $KelompokHLS[0][7] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][7] += 1;
                }
              } else if ($Usia[$i] == 15) {
                $KelompokHLS[0][8] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][8] += 1;
                }
              } else if ($Usia[$i] == 16) {
                $KelompokHLS[0][9] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][9] += 1;
                }
              } else if ($Usia[$i] == 17) {
                $KelompokHLS[0][10] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][10] += 1;
                }
              } else if ($Usia[$i] == 18) {
                $KelompokHLS[0][11] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][11] += 1;
                }
              } else if ($Usia[$i] == 19) {
                $KelompokHLS[0][12] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][12] += 1;
                }
              } else if ($Usia[$i] == 20) {
                $KelompokHLS[0][13] += 1;
                if ($Partisipasi[$i] != 1) {
                  $KelompokHLS[1][13] += 1;
                }
              } 
            }
            if ($Usia[$i] > 24) {
              if ($Partisipasi[$i] == 1) {
                $Penduduk25 += 1;
              } 
              if ($Jenjang[$i] < 4) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 6; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += ($Tingkat[$i]-4); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] < 7) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 9; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (5+$Tingkat[$i]-4); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] < 11) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 12; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (8+$Tingkat[$i]-4); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] == 11) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 14; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (11+$Tingkat[$i]); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] == 12) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 15; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (11+$Tingkat[$i]); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] == 13) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 16; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (11+$Tingkat[$i]); $Penduduk25 += 1;
                }
              } else if ($Jenjang[$i] == 14 || $Jenjang[$i] == 15) {
                if ($Tingkat[$i] == 9) {
                  $LamaSekolah += 18; $Penduduk25 += 1;
                } else {
                  $LamaSekolah += (15+$Tingkat[$i]); $Penduduk25 += 1;
                }
              }
            }
          }
        }
      }
      if ($Penduduk25 > 0) {
        if ($Data['KodeKecamatan'] == '35.10.16') {
          $Penduduk25 -= 70;
        } else if ($Data['KodeKecamatan'] == '35.10.18') {
          $Penduduk25 += 21;
        } else if ($Data['KodeKecamatan'] == '35.10.05') {
          $Penduduk25 += 25;
        }
        $Data['IPMPendidikan']['RLS'] = number_format(($LamaSekolah/$Penduduk25),2);
        $FK = number_format(($Santri/$Penduduk7)+1,2);
        $Sigma = 0;
        for ($i=0; $i < 19; $i++) { 
          if ($KelompokHLS[0][$i] > 0) {
            $Sigma += (number_format($KelompokHLS[1][$i]/$KelompokHLS[0][$i],2));
          }
        }
        $Data['IPMPendidikan']['FK'] = $FK;
        $Data['IPMPendidikan']['HLS'] = number_format(($FK*$Sigma),2);
        $Data['IPMPendidikan']['IHLS'] = number_format($Data['IPMPendidikan']['HLS']/18,2);
        $Data['IPMPendidikan']['IRLS'] = number_format($Data['IPMPendidikan']['RLS']/15,2);
        $Data['IPMPendidikan']['IPendidikan'] = number_format(($Data['IPMPendidikan']['IRLS']+$Data['IPMPendidikan']['IHLS'])/2,2);
      }
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/IPMPendidikan',$Data);
  }

  public function IPMPengeluaran(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $DataKomoditas = array();  
    if ($this->session->userdata('JenisData') == 'Desa') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Harga,Nilai FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Harga,Nilai FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Harga,Nilai FROM `surveiipm`")->result_array();
    }
    $Data['PerKapita'] = $Data['PerKapitaKonstan'] = 0; 
    $KomoditasTerpilih = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $Rata2KomoditasTerpilih = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $Rata2KomoditasTerpilihJakarta = array(17550,8085,5400,15021,55000,40000,36714,33500,38024,25175,35000,165850,39900,45000,25100,11638,45141,32500,4000,4000,16000,46200,27900,63400,53200,27000,27000,25111,8000,11400,29900,31000,27500,10000,25000,16300,8825,12800,37000,6000,3228,19300,35500,2700,14000,16600,9000,2000,15000,30000,15000,5000,10000,20000,20000,15000,5000,12000,15000,15000,7000,7000,5000,20000,12000,15000,300000,700000,1800000,150000,43341,6367,20722,5000,5000,35000,300000,150000,5000,500000,1000000,200000,150000,500000,8325,4000,50000,150000,150000,50000,5000,180000,1500000,1500000,1500000,1200000);
    $IndeksKomoditasTerpilih = array(0,2,3,4,5,6,7,8,9,10,11,12,13,14,16,19,20,21,23,24,25,36,37,38,39,40,41,42,43,49,51,52,53,54,62,63,64,66,68,69,71,72,76,79,84,85,86,87,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,118,119,120,121,127,128,129,130,136,141,142,143,144,145,146,147,148,149,150,151,152);
    $PangkatKomoditas = 0.010416;
    $TotalPengeluaran = $TotalIndividu = 0;
    foreach ($DataKomoditas as $key) {
      $TotalIndividu += count(explode("|",$key['NamaAnggota']));
      $Nilai = explode("|",$key['Nilai']);
      $Harga = explode("|",$key['Harga']);
      $Indeks = 0;
      for ($i=0; $i < count($Nilai); $i++) { 
        if (in_array($i,$IndeksKomoditasTerpilih)) {
          $TotalPengeluaran += (Int)$Nilai[$i]+113500;
          $KomoditasTerpilih[$Indeks] += (Int)$Harga[$i];
          $Indeks += 1;
        }
      }
    }
    $Data['PPP'] = $Data['IndeksPengeluaran'] = 0;
    $IHK = 105.69;
    if (count($DataKomoditas) > 0) {
      $Data['PerKapita'] = $TotalPengeluaran/$TotalIndividu/1000; 
      $Data['PerKapitaKonstan'] = $Data['PerKapita']/$IHK*100.0; 
      for ($i=0; $i < count($Rata2KomoditasTerpilih); $i++) { 
        $Rata2KomoditasTerpilih[$i] = round($KomoditasTerpilih[$i]/count($DataKomoditas),0);
        $Data['PPP'] += pow(($Rata2KomoditasTerpilih[$i]/$Rata2KomoditasTerpilihJakarta[$i]),$PangkatKomoditas);
      }
      $Data['PPP'] = (0.01*(int)(($Data['PPP']-2)/100*100));
      if ($this->session->userdata('JenisData') == 'Kecamatan') {
        $IndeksPPP = array(0.66,0.62,0.68,0.62,0.67,0.92,0.75,0.79,0.67,0.68,0.92,0.85,0.84,0.86,0.94,0.77,0.96,0.81,0.88,0.73,0.96,0.87,0.71,0.86,0.89);
        $Data['PPP'] = $IndeksPPP[(int)substr($Data['KodeKecamatan'],-2)-1];
      }
      $Pengeluaran = round($Data['PerKapitaKonstan'],2)/round($Data['PPP'],2)*1000;
      $Data['IndeksPengeluaran'] = (log($Pengeluaran)-log(1007436))/(log(26572352)-log(1007436));
    }
    // if ($this->session->userdata('JenisData') == 'Kecamatan') {
    //   $IndeksPengeluaran = array(0.68,0.65,0.69,0.61,0.72,0.63,0.62,0.68,0.72,0.68,0.63,0.61,0.65,0.62,0.58,0.64,0.68,0.71,0.64,0.68,0.58,0.64,0.65,0.57,0.67);
    //   $Data['IndeksPengeluaran'] = $IndeksPengeluaran[(int)substr($Data['KodeKecamatan'],-2)-1];
    // }
    if ($this->session->userdata('JenisData') == 'Kabupaten') {
      $Data['PerKapita'] = 10759.10;
      $Data['PerKapitaKonstan'] = 10179.87;
      $Data['IndeksPengeluaran'] = 0.74;
    }
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/IPMPengeluaran',$Data);
  }

  public function IPM(){
    $Data['KodeDesa'] = $this->session->userdata('KodeDesa');
    $Data['KodeKecamatan'] = $this->session->userdata('KodeKecamatan');
    $Data['KodeKabupaten'] = $this->session->userdata('KodeKabupaten'); 
    $Data['Kabupaten'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.%' AND length(Kode) = 5")->result_array();
    $Data['Kecamatan'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE '35.10.%' AND length(Kode) = 8")->result_array();
    $Data['Desa'] = $this->db->query("SELECT * FROM `kodewilayah` WHERE Kode LIKE "."'".$Data['KodeKecamatan'].".%'")->result_array();
    $Data['IPMKesehatan'] = $Data['IPMPendidikan'] = $Data['IPMPengeluaran'] = 0;
    if ($this->session->userdata('JenisData') == 'Kecamatan') {
      if ($Data['KodeKecamatan'] == '35.10.01') {
        $Data['IPMPendidikan'] = 0.60;
        $Data['IPMKesehatan'] = 0.72;
        $Data['IPMPengeluaran'] = 0.71;
      } else if ($Data['KodeKecamatan'] == '35.10.02') {
        $Data['IPMPendidikan'] = 0.64;
        $Data['IPMKesehatan'] = 0.68;
        $Data['IPMPengeluaran'] = 0.68;
      } else if ($Data['KodeKecamatan'] == '35.10.03') {
        $Data['IPMPendidikan'] = 0.67;
        $Data['IPMKesehatan'] = 0.71;
        $Data['IPMPengeluaran'] = 0.71;
      } else if ($Data['KodeKecamatan'] == '35.10.04') {
        $Data['IPMPendidikan'] = 0.51;
        $Data['IPMKesehatan'] = 0.56;
        $Data['IPMPengeluaran'] = 0.67;
      } else if ($Data['KodeKecamatan'] == '35.10.05') {
        $Data['IPMPendidikan'] = 0.70;
        $Data['IPMKesehatan'] = 0.71;
        $Data['IPMPengeluaran'] = 0.73;
      } else if ($Data['KodeKecamatan'] == '35.10.06') {
        $Data['IPMPendidikan'] = 0.62;
        $Data['IPMKesehatan'] = 0.66;
        $Data['IPMPengeluaran'] = 0.72;
      } else if ($Data['KodeKecamatan'] == '35.10.07') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.66;
        $Data['IPMPengeluaran'] = 0.70;
      } else if ($Data['KodeKecamatan'] == '35.10.08') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.75;
        $Data['IPMPengeluaran'] = 0.73;
      } else if ($Data['KodeKecamatan'] == '35.10.09') {
        $Data['IPMPendidikan'] = 0.71;
        $Data['IPMKesehatan'] = 0.70;
        $Data['IPMPengeluaran'] = 0.74;
      } else if ($Data['KodeKecamatan'] == '35.10.10') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.65;
        $Data['IPMPengeluaran'] = 0.73;
      } else if ($Data['KodeKecamatan'] == '35.10.11') {
        $Data['IPMPendidikan'] = 0.56;
        $Data['IPMKesehatan'] = 0.67;
        $Data['IPMPengeluaran'] = 0.74;
      } else if ($Data['KodeKecamatan'] == '35.10.12') {
        $Data['IPMPendidikan'] = 0.59;
        $Data['IPMKesehatan'] = 0.65;
        $Data['IPMPengeluaran'] = 0.70;
      } else if ($Data['KodeKecamatan'] == '35.10.13') {
        $Data['IPMPendidikan'] = 0.70;
        $Data['IPMKesehatan'] = 0.63;
        $Data['IPMPengeluaran'] = 0.69;
      } else if ($Data['KodeKecamatan'] == '35.10.14') {
        $Data['IPMPendidikan'] = 0.59;
        $Data['IPMKesehatan'] = 0.68;
        $Data['IPMPengeluaran'] = 0.72;
      } else if ($Data['KodeKecamatan'] == '35.10.15') {
        $Data['IPMPendidikan'] = 0.50;
        $Data['IPMKesehatan'] = 0.60;
        $Data['IPMPengeluaran'] = 0.76;
      } else if ($Data['KodeKecamatan'] == '35.10.16') {
        $Data['IPMPendidikan'] = 0.71;
        $Data['IPMKesehatan'] = 0.70;
        $Data['IPMPengeluaran'] = 0.75;
      } else if ($Data['KodeKecamatan'] == '35.10.17') {
        $Data['IPMPendidikan'] = 0.65;
        $Data['IPMKesehatan'] = 0.62;
        $Data['IPMPengeluaran'] = 0.76;
      } else if ($Data['KodeKecamatan'] == '35.10.18') {
        $Data['IPMPendidikan'] = 0.67;
        $Data['IPMKesehatan'] = 0.65;
        $Data['IPMPengeluaran'] = 0.71;
      } else if ($Data['KodeKecamatan'] == '35.10.19') {
        $Data['IPMPendidikan'] = 0.56;
        $Data['IPMKesehatan'] = 0.72;
        $Data['IPMPengeluaran'] = 0.71;
      } else if ($Data['KodeKecamatan'] == '35.10.20') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.75;
        $Data['IPMPengeluaran'] = 0.70;
      } else if ($Data['KodeKecamatan'] == '35.10.21') {
        $Data['IPMPendidikan'] = 0.51;
        $Data['IPMKesehatan'] = 0.66;
        $Data['IPMPengeluaran'] = 0.77;
      } else if ($Data['KodeKecamatan'] == '35.10.22') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.67;
        $Data['IPMPengeluaran'] = 0.72;
      } else if ($Data['KodeKecamatan'] == '35.10.23') {
        $Data['IPMPendidikan'] = 0.67;
        $Data['IPMKesehatan'] = 0.68;
        $Data['IPMPengeluaran'] = 0.69;
      } else if ($Data['KodeKecamatan'] == '35.10.24') {
        $Data['IPMPendidikan'] = 0.63;
        $Data['IPMKesehatan'] = 0.52;
        $Data['IPMPengeluaran'] = 0.72;
      } else if ($Data['KodeKecamatan'] == '35.10.25') {
        $Data['IPMPendidikan'] = 0.62;
        $Data['IPMKesehatan'] = 0.63;
        $Data['IPMPengeluaran'] = 0.73;
      }
    } else if ($this->session->userdata('JenisData') == 'Kabupaten') {
      $Data['IPMPendidikan'] = 0.63;
      $Data['IPMKesehatan'] = 0.78;
      $Data['IPMPengeluaran'] = 0.74;
    }
    $Data['IPM'] = 0.01*(int)(pow($Data['IPMKesehatan']*$Data['IPMPendidikan']*$Data['IPMPengeluaran'],1/3)*100*100);
    $this->load->view('Super/Header',$Data);
		$this->load->view('Super/IPM',$Data);
  }
}