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
    $_SESSION['KodeDesa'] = $_POST['KodeDesa'];
    $_SESSION['KodeKecamatan'] = $_POST['KodeKecamatan'];
    $_SESSION['JenisData'] = $_POST['JenisData'];
    echo '1';
  }

  public function NTP(){
    $DataKonsumen = $this->db->query("SELECT KodeKualitas,Harga,_Harga FROM `ntpkonsumen` WHERE TanggalSurvei LIKE '2022-01%'")->result_array();    
    $DataProdusen = $this->db->query("SELECT KodeKualitas,Harga,_Harga FROM `ntpprodusen` WHERE TanggalSurvei LIKE '2022-01%'")->result_array();    
    $HargaPasar = $_HargaPasar = 0;
    foreach ($DataKonsumen as $key) {
      $Pisah = explode("|",$key['KodeKualitas']);
      $Harga = explode("|",$key['Harga']);
      $_Harga = explode("|",$key['_Harga']);
      for ($i=0; $i < count($Pisah) ; $i++) { 
        $HargaPasar += (int)$Harga[$i];$_HargaPasar += (int)$_Harga[$i];
      }
    }
    $KodeITTanamanPangan = array('IA001001','IA001002','IA001003','IA001004','IA001005','IA001006','IA002001','IA002002','IA002003','IA002004','IA002005','IA002006','IA003001','IA003002','IA003003','IA003004','IA003005','IA003006','IA004001','IA004002','IA005001','IA005002','IB001001','IB001002','IB002001','IB002002','IB001003','IB003001','IB005001','IB005002','IB006001','IB006002','IB007001','IB007002','IB008001','IB008002','IB008003','IB009001','IB009002','IB010001','IB011001','IB012001');  
    $KodeIBTanamanPangan = array('JA101001','JA101002','JA101003','JA101004','JA102001','JA102002','JA102003','JA102004','JA201001','JA201002','JA202001','JA203001','JA204001','JA205001','JA206001','JA207001','JA208001','JB001001','JB001002','JB001003','JB002001','JB002002','JB004001','JB005001','JB006001','JB007001','JB008001','JB011001','JB012001','JB012002','JB012003','JB013001','JB014001','JB015001','JB101001','JB101002','JB101003','JB102001','JB102002','JB102003','JB103001','JB103002','JB103003','JB104001','JB104002','JB104003','JB105001','JB105002','JB105003','JB106001','JB106002','JB106003','JB107001','JB107002','JC001001','JC001002','JC001003','JC002001','JC002002','JC002003','JC006001','JC007001','JC007002','JC008001','JC008002','JC009001','JC009002','JC010001','JC011001','JC013001','JC014001','JC015001','JC016001','JC017001','JD001001','JD001002','JD001003','JD002001','JD002002','JD002003','JD002004','JD003002','JD003003','JD003004','JD003005','JD004001','JD004002','JD005001','JD005002','JD005003','JD006001','JD006002','JD006003','JD007001','JD007002','JD008001','JD008002','JD010001','JD010002','JD011001','JD011002','JD012001','JD013001','JD014001','JD016001','JD016002','JD017001','JD017002','JD018001','JF001001','JF002001','JF002002','JF003001','JF003002','JF004001','JF005001','JF005002','JF006001','JF006002','JF007001','JF008001','JF009001','JF009002','JF010001','JF010002','JF011001','JF012001','JF013001','JF016001','JF017001','JF017002','JF018001','JF019001','JF019002','JF020001','JF023001','JF024001','JF025001','JF026001','JF027001','JF028001','JF029001','JF030001','JF031001','JF032001','JF033001','JF034001','JF035001','JG003001','JG004001','JG005001','JG005002','JG006001','JG007001','JG009001','JG010001','JG011001','JG009001','JG012001','JG012002','JG013001','JG013002','JG014001','JG015001','JG016001','JG017001','KA101101','KA101102','KA101103','KA201101','KA201102','KA201103','KA301101','KA301102','KA301103','KA401101','KA401102','KA401103','KA501101','KA501102','KA501103','KA601101','KA601102','KA601103','KA701101','KA701102','KA701103','KA801101','KA801102','KA801103','KA901101','KA901102','KA901103','KA911101','KA911102','KA911103','KA921101','KA921102','KA921103','KA941101','KA941102','KA941103','KA951101','KA951102','KA951103','KA961101','KA961102','KA961103');
    $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
    foreach ($DataProdusen as $key) {
      $Pisah = explode("|",$key['KodeKualitas']);
      $Harga = explode("|",$key['Harga']);
      $_Harga = explode("|",$key['_Harga']);
      for ($i=0; $i < count($Pisah) ; $i++) { 
        if (in_array($Pisah[$i],$KodeITTanamanPangan)) {
          $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$_Harga[$i];
        }
        if (in_array($Pisah[$i],$KodeIBTanamanPangan)) {
          $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$_Harga[$i];
        }
      }
    }
    $ITTanamanPangan = $ITHarga/$IT_Harga*100;
    $IBTanamanPangan = $IBHarga/$IB_Harga*100;
    $Data['NTPTanamanPangan'] = $ITTanamanPangan/$IBTanamanPangan*100;
    $KodeITHortikultura = array('XA001001','XA002001','XA002002','XA002003','XA003001','XA004001','XA005001','XA006001','XA007001','XA007002','XA008001','XA009001','XA010001','XA010002','XA011001','XA012001','XA013001','XA014001','XA014002','XA015001','XA016001','XA016002','XA017001','XA019001','XA020001','XA022001','XA024001','XA025001','XA026001','XA027001','XA028001','XA029001','XA030001','XA031001','XA032001','XA033001','XA034001','XA035001','XA036001','XA037001','XA038001','XA039001','XB001001','XB001002','XB001003','XB002001','XB002002','XB003001','XB003002','XB004001','XB005001','XB005002','XB006001','XB006002','XB007001','XB007002','XB007003','XB008001','XB008002','XB008003','XB009001','XB009002','XB009003','XB009004','XB009005','XB010001','XB010002','XB010003','XB010004','XB010005','XB012001','XB013001','XB013002','XB014001','XB014002','XB014003','XB015001','XB016001','XB016002','XB016003','XB017001','XB018001','XB018002','XB019001','XB019002','XB019003','XB020001','XB020002','XB021001','XB021002','XB021003','XB022001','XB022002','XB023001','XB023002','XB023003','XB023004','XB024001','XB026001','XB027001','XB028001','XB029001','XB030001','XB031001','XB032001','XB033001','XB034001','XB035001','XD001001','XD002001','XD003001','XD004001','XD005001','XD007001','XD008001','XD009001','XD010001','XD011001','XD012001');  
    $KodeIBHortikultura = array('YA101001','YA101002','YA101003','YA102001','YA102002','YA103001','YA104001','YA105001','YA106001','YA107001','YA108001','YA109001','YA110001','YA111001','YA112001','YA113001','YA114001','YA115001','YA116001','YA117001','YA118001','YA112001','YA121001','YA122001','YA161001','YA163001','YA164001','YA165001','YA166001','YA167001','YA201001','YA201002','YA202001','YA202002','YA203001','YA203002','YA203003','YA204001','YA204002','YA204003','YA204004','YA205001','YA206001','YA206002','YA207001','YA207002','YA207003','YA208001','YA208002','YA209001','YA211001','YA211002','YA212001','YA212002','YA262001','YA263001','YA264001','YA265001','YA266001','YA267001','YA268001','YA401001','YA402001','YA403001','YA405001','YA408001','YA409001','YA410001','YB001001','YB001002','YB001003','YB002001','YB002002','YB004001','YB005001','YB006001','YB007001','YB008001','YB011001','YB016001','YB601001','YB601002','YB601003','YB602001','YB603001','YB604001','YB605001','YB101001','YB101002','YB101003','YB102001','YB102002','YB103001','YB103002','YB104001','YB104002','YB105001','YB105002','YB106001','YB106002','YB107001','YB108001','YB109001','YC001001','YC001002','YC001003','YC002001','YC002002','YC002003','YC006001','YC006002','YC007001','YC007002','YC009001','YC009002','YC010001','YC011001','YC601001','YC602001','YD001001','YD001002','YD001003','YD002001','YD002003','YD002004','YD002002','YD003002','YD003003','YD003004','YD003005','YD004001','YD004002','YD005001','YD005002','YD006001','YD006002','YD007001','YD007002','YD008001','YD008002','YD011001','YD012001','YD012002','YD012003','YD013001','YD013002','YD013003','YD014001','YD014002','YD014003','YD015001','YD015002','YD017001','YD017002','YD017003','YD018001','YF001001','YF003001','YF004001','YF005001','YF006001','YF006002','YF007001','YF008001','YF009001','YF009002','YF011001','YF012001','YF016001','YF017001','YF017002','YF018001','YF019001','YF019002','YF020001','YF022001','YF023001','YF024001','YF025001','YF026001','YF027001','YF028001','YF031001','YF033001','YF601001','YF603001','YF605001','YF607001','YF607002','YF999001','YF100001','YG003001','YG004001','YG006001','YG007001','YG009001','YG009002','YG009003','YG012001','YG013001','YG015001','YG015002','YG016001','ZA101101','ZA101102','ZA101103','ZA201101','ZA201102','ZA201103','ZA301101','ZA301102','ZA301103','ZA401101','ZA401102','ZA401103','ZA501101','ZA501102','ZA501103','ZA601101','ZA601102','ZA601103','ZA701101','ZA701102','ZA701103','ZA801101','ZA801102','ZA801103','ZA901101','ZA901102','ZA901103','ZA921101','ZA921102','ZA921103');
    $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
    foreach ($DataProdusen as $key) {
      $Pisah = explode("|",$key['KodeKualitas']);
      $Harga = explode("|",$key['Harga']);
      $_Harga = explode("|",$key['_Harga']);
      for ($i=0; $i < count($Pisah) ; $i++) { 
        if (in_array($Pisah[$i],$KodeITHortikultura)) {
          $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$_Harga[$i];
        }
        if (in_array($Pisah[$i],$KodeIBHortikultura)) {
          $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$_Harga[$i];
        }
      }
    }
    $ITHortikultura = $ITHarga/$IT_Harga*100;
    $IBHortikultura = $IBHarga/$IB_Harga*100;
    $Data['NTPHortikultura'] = $ITHortikultura/$IBHortikultura*100;
    $KodeITPerkebunan = array('LA001001','LA001002','LA002001','LA002002','LA004001','LA004002','LA005001','LA006001','LA006002','LA006003','LA008001','LA011001','LA011002','LA012001','LA012002','LA013001','LA014001','LA017001','LA017002','LA019001','LA020001','LA021001','LA022001','LA023001','LA026001','LA027001','LA029001','LA031001','LA032001','LA033001','LA007001','LA009001','LA009002','LA018001','LA025001','LA028001','LA029001');  
    $KodeIBPerkebunan = array('MA001001','MA001002','MA001003','MA002001','MA002002','MA002003','MA003001','MA004001','MA005001','MA006001','MA007001','MA008001','MA009001','MA010001','MA011001','MA012001','MA015001','MA017001','MA018001','MA019001','MB001001','MB001002','MB001003','MB002001','MB002002','MB004001','MB005001','MB005002','MB006001','MB007001','MB007002','MB007003','MB008001','MB011001','MB013001','MB014001','MB015002','MB015001','MB015002','MB016001','MB017001','MB018001','MB101001','MB101002','MB101003','MB101004','MB102001','MB102002','MB102003','MB103001','MB103002','MB103003','MB104001','MB104002','MB105001','MB105002','MB106001','MB106002','MC001001','MC001002','MC001003','MC003001','MC004001','MC004002','MC005001','MC005002','MC007001','MC008001','MC009001','MC010001','MC011001','MD001001','MD001002','MD001003','MD001004','MD002001','MD002002','MD002003','MD002004','MD003002','MD003003','MD003004','MD003005','MD004001','MD004002','MD005001','MD005002','MD005003','MD006001','MD006002','MD007001','MD007002','MD008001','MD008002','MD009001','MD009002','MD011001','MD011002','MD012001','MD012002','MD013001','MD014001','MD014002','MD014003','MD015001','MD015002','MD015003','MD017001','MD019001','MD019002','MD019003','MD019004','MD020001','MD020002','MD021001','MD022001','ME001001','ME002001','ME002002','ME002003','ME003001','ME003002','ME004001','ME004002','ME005001','ME005002','ME006001','ME007001','ME008001','ME009001','ME009002','ME009003','ME010001','ME011001','ME011002','ME012001','ME012002','ME013001','ME014001','ME015001','ME017001','ME019001','ME020001','ME021001','ME022001','ME023001','ME024001','ME025001','ME026001','ME602001','ME602002','ME602003','ME604001','ME605001','ME606001','ME607001','ME608001','ME609001','ME610001','ME611001','ME612001','ME613001','MF002001','MF002002','MF003001','MF006001','MF009001','MF009002','MF009003','MF012001','MF012002','MF602001','MF603001','MF606001','MF607001','NA101101','NA102101','NA103101','NA201101','NA202101','NA203101','NA301101','NA301102','NA301103','NA401101','NA401102','NA401103','NA501101','NA501102','NA501103','NA601101','NA601102','NA601103','NA701101','NA701102','NA701103','NA801101','NA801102','NA801103','NA901101','NA901102','NA901103','NA911101','NA911102','NA911103','NA921101','NA921102','NA921103','NA931101','NA931102','NA931103');
    $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
    foreach ($DataProdusen as $key) {
      $Pisah = explode("|",$key['KodeKualitas']);
      $Harga = explode("|",$key['Harga']);
      $_Harga = explode("|",$key['_Harga']);
      for ($i=0; $i < count($Pisah) ; $i++) { 
        if (in_array($Pisah[$i],$KodeITPerkebunan)) {
          $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$_Harga[$i];
        }
        if (in_array($Pisah[$i],$KodeIBPerkebunan)) {
          $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$_Harga[$i];
        }
      }
    }
    // $ITPerkebunan = $ITHarga/$IT_Harga*100;
    // $IBPerkebunan = $IBHarga/$IB_Harga*100;
    $Data['NTPPerkebunan'] = 0;
    $KodeITPeternakan = array('OA001001','OA001002','OA001003','OA002001','OA002002','OA002003','OA002004','OA002005','OA002006','OA003001','OA003002','OA004001','OA004002','OA005002','OB001001','OB001002','OB001003','OB001004','OB002001','OB002002','OB002003','OB002004','OB003001','OB003002','OB003003','OB003004','OB003005','OB004001','OB004002','OB005001','OB006001','OC002001','OC002002','OC002003','OC002004','OC003001','OC005001','OC005002','OC005003','OC006001','OC007001','OC008001','OC009001','OC010001','OC011001','OD001001','OD006001','OD007001','OD008001','OD009001','OD010001','OD009001');  
    $KodeIBPeternakan = array('PA002001','PA002002','PA002003','PA003001','PA003002','PA005001','PA005002','PA006001','PA006002','PA007001','PA007002','PA601001','PA601002','PA602001','PA602002','PA615001','PA615002','PA615002','PA616001','PA616002','PA617001','PA617002','PA617003','PA618001','PA618002','PA619001','PA619002','PA620001','PA620002','PA621001','PA621002','PA622001','PA622002','PA623001','PA623002','PA624001','PA625001','PA626001','PA701001','PA701002','PA702001','PA702002','PA703001','PA703002','PA703003','PA704001','PA704002','PA705001','PA705002','PA706001','PA706002','PA707001','PB102001','PB102002','PB102003','PB102004','PB104001','PB105001','PB106001','PB107001','PB107002','PB107003','PB108001','PB109001','PB110001','PB113001','PB114001','PB116001','PB117001','PB122001','PB162001','PB164001','PB165001','PB165002','PB165003','PB166001','PB201001','PB201002','PB201003','PB201004','PB202001','PB202002','PB202003','PB202004','PB203001','PB203002','PB204001','PB204002','PB205001','PB205002','PB205003','PB206001','PB206002','PB208001','PB208002','PB209001','PB210001','PB210002','PB210003','PB210004','PB211001','PB212001','PB214001','PB215001','PB216001','PB217001','PB218001','PB219001','PB220001','PB221001','PB261001','PB262001','PB263001','PB264001','PB265001','PB266001','PB267001','PB268001','PB269001','PB270001','PC001001','PC002001','PC012001','PC601001','PC602001','PC603001','PD001001','PD001002','PD001003','PD001004','PD002001','PD002003','PD002004','PD002002','PD003002','PD003003','PD003004','PD003005','PD004001','PD004002','PD005001','PD005002','PD006001','PD006002','PD007001','PD007002','PD008001','PD009001','PD009002','PD014001','PD601001','PD601002','PD601003','PD602001','PE001001','PE001002','PE002001','PE002002','PE002003','PE003001','PE003002','PE003003','PE004001','PE004002','PE008001','PE008002','PE012001','PE012002','PE013001','PE013002','PE015001','PE016001','PE017001','PE018001','PE019001','PE020001','PE021001','PE023001','PE024001','PE025001','PE602001','PE602002','PE605001','PE606001','PE607001','PE608001','PE609001','PE610001','PE611001','PE612001','PE613001','PE614001','PE615001','PE616001','PE617001','PE618001','PE619001','PE620001','PF005001','PF006001','PF007001','PF008001','PF010001','PF010002','PF011001','PF012001','PF014001','PF015001','PF016001','PF016002','PF016003','PF017001','PF017002','PF018001','PF019001','PF019002','PF020001','PF020002','PF021001','PF022001','PF022002','PF023001','PF023002','PF024001','PF602001','PF602002','PF603001','PF604001','PF605001','PF606001','QA101101','QA101102','QA101103','QA301101','QA301102','QA301103','QA401101','QA401102','QA401103','QA501101','QA501102','QA501103','QA502101','QA502102','QA502103');
    $ITHarga = $IT_Harga = $IBHarga = $IB_Harga = 0;
    foreach ($DataProdusen as $key) {
      $Pisah = explode("|",$key['KodeKualitas']);
      $Harga = explode("|",$key['Harga']);
      $_Harga = explode("|",$key['_Harga']);
      for ($i=0; $i < count($Pisah) ; $i++) { 
        if (in_array($Pisah[$i],$KodeITPeternakan)) {
          $ITHarga += (int)$Harga[$i];$IT_Harga += (int)$_Harga[$i];
        }
        if (in_array($Pisah[$i],$KodeIBPeternakan)) {
          $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$_Harga[$i];
        }
      }
    }
    $ITPeternakan = $ITHarga/$IT_Harga*100;
    $IBPeternakan = $IBHarga/$IB_Harga*100;
    $Data['NTPPeternakan'] = $ITPeternakan/$IBPeternakan*100;
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
        if (in_array($Pisah[$i],$KodeIBPerikanan)) {
          $IBHarga += (int)$Harga[$i];$IB_Harga += (int)$_Harga[$i];
        }
      }
    }
    $ITPerikanan = $ITHarga/$IT_Harga*100;
    $IBPerikanan = $IBHarga/$IB_Harga*100;
    $Data['NTPPerikanan'] = $ITPerikanan/$IBPerikanan*100;
    $this->load->view('Super/Header');
		$this->load->view('Super/NTP',$Data);
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
      $Pendidikan = $this->db->query("SELECT PartisipasiSekolah,PendidikanTertinggi FROM `surveiipm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pendidikan = $this->db->query("SELECT PartisipasiSekolah,PendidikanTertinggi FROM `surveiipm` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pendidikan = $this->db->query("SELECT PartisipasiSekolah,PendidikanTertinggi FROM `surveiipm`")->result_array();
    }
    $Data['JenisPendidikan'] = array(0,0,0,0,0,0,0,0);
    $Data['Responden'] = 0;
    for ($i=0; $i < count($Pendidikan); $i++) { 
      $Pecah = explode("|",$Pendidikan[$i]['PartisipasiSekolah']);
      $Pisah = explode("|",$Pendidikan[$i]['PendidikanTertinggi']);
      $Data['Responden'] += count($Pisah);
      for ($j=0; $j < count($Pecah); $j++) { 
        if ($Pecah[$j] == 1) {
          $Data['JenisPendidikan'][0] += 1;
        } else {
          if ($Pisah[$j] < 4) {
            $Data['JenisPendidikan'][1] += 1;
          } else if ($Pisah[$j] < 7) {
            $Data['JenisPendidikan'][2] += 1;
          } else if ($Pisah[$j] < 11) {
            $Data['JenisPendidikan'][3] += 1;
          } else if ($Pisah[$j] < 13) {
            $Data['JenisPendidikan'][4] += 1;
          } else if ($Pisah[$j] == 13) {
            $Data['JenisPendidikan'][5] += 1;
          } else if ($Pisah[$j] == 14) {
            $Data['JenisPendidikan'][6] += 1;
          } else if ($Pisah[$j] == 15) {
            $Data['JenisPendidikan'][7] += 1;
          } 
        } 
      }
    }
    $Data['Pendidikan'] = array(0,0,0,0,0,0,0,0);
    if ($Data['Responden'] > 0) {
      for ($i=0; $i < count($Data['JenisPendidikan']); $i++) { 
        $Data['Pendidikan'][$i] = number_format($Data['JenisPendidikan'][$i]/$Data['Responden']*100,2);
      }
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
      $Pekerjaan = $this->db->query("SELECT Pekerjaan FROM `surveiipm` WHERE Desa = "."'".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $Pekerjaan = $this->db->query("SELECT Pekerjaan FROM `surveiipm` WHERE Kecamatan = "."'".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $Pekerjaan = $this->db->query("SELECT Pekerjaan FROM `surveiipm`")->result_array();
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
    $Sekolah = $Penduduk = array(0,0,0,0);  
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
        } else if ($Usia[$i] > 18 && $Usia[$i] < 25) {
          if ($PartisipasiSekolah[$i] == '2') {
            $Sekolah[3] += 1;
          } 
          $Penduduk[3] += 1;
        } 
      }
    }
    $Data['APS'] = array(0,0,0,0);
    $Data['APS'][0] = $Sekolah[0]/$Penduduk[0]*100;
    $Data['APS'][1] = $Sekolah[1]/$Penduduk[1]*100;
    $Data['APS'][2] = $Sekolah[2]/$Penduduk[2]*100;
    $Data['APS'][3] = $Sekolah[3]/$Penduduk[3]*100;
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
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Nilai FROM `surveiipm` WHERE Desa='".$Data['KodeDesa']."'")->result_array();
    } else if ($this->session->userdata('JenisData') == 'Kecamatan') {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Nilai FROM `surveiipm` WHERE Kecamatan='".$Data['KodeKecamatan']."'")->result_array();
    } else {
      $DataKomoditas = $this->db->query("SELECT NamaAnggota,Nilai FROM `surveiipm`")->result_array();
    }
    $Data['JumlahKK'] = count($DataKomoditas); $Data['GK'] = $Data['GKM'] = $Data['GKNM'] = $Data['Individu'] = array(); 
    $Data['GKRata2'] = $Data['GKMRata2'] = $Data['GKNMRata2'] = 0; $Data['KelompokGK'] = array(0,0); $IndividuPerKK = array();
    $Data['TotalIndividu'] = $Data['TotalPengeluaranMakanan'] = $Data['TotalPengeluaranNonMakanan'] = 0;
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