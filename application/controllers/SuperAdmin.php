<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {

  function __construct(){
		parent::__construct();
		if(!$this->session->userdata('SuperAdmin')){
			redirect(base_url()); 
		}
  } 

  public function index(){
    $this->load->view('SuperAdmin/Header');
		$this->load->view('SuperAdmin/Dashboard');
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

  public function ExcelKas($From,$To){
    $Data['NamaFile'] = "Kas ".$From." Hingga ".$To;
    $Data['Kas'] = $this->db->query("SELECT * FROM `kas` WHERE Tanggal >= '".$From."' and Tanggal <= '".$To."' ORDER BY Tanggal ASC")->result_array();
		$this->load->view('ExcelKas',$Data);
  }

	public function Kas(){
    $Data['In'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='IN' AND `Date` LIKE "."'".date('Y-m')."%'")->row_array()['Total'];
    $Data['Out'] = $this->db->query("SELECT SUM(Amount) AS Total FROM `kas` WHERE `Jenis`='OUT' AND `Date` LIKE "."'".date('Y-m')."%'")->row_array()['Total'];
    $this->db->order_by('Date', 'DESC');
    $Data['Kas'] = $this->db->get('kas')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Kas',$Data);
  }

  public function Project(){
    $Data['Project'] = $this->db->get('project')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Project',$Data);
  }

  public function Matrikulasi(){
    $Data['Matrikulasi'] = $this->db->get('matrikulasi')->result_array();
    $this->load->view('SuperAdmin/Header',$Data);
		$this->load->view('SuperAdmin/Matrikulasi',$Data);
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
}