<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>IDE Consultant</title>
    <!-- Favicons -->
    <link href="../assets/img/favicon.ico" rel="icon">
    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome/css/all.min.css" rel="stylesheet">
  </head>

  <body>  
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 mt-2"> 
          <p class="text-justify">&emsp;&emsp;&emsp;Dengan Hormat, Inti Desain Ekonomi Konsultan Beserta Dinas Komunikasi, Informatika dan Persandian Kabupaten Banyuwangi 
          membutuhkan informasi tentang pelayanan yang diberikan kepada masyarakat pengguna layanan Dinas Komunikasi, Informatika dan Persandian Kabupaten Banyuwangi yaitu :
          1. Pelayanan data Statistik (Portal Data). 2. Pelayanan Publikasi dan Komunikasi Publik. 3. Pelayanan Tanda Tangan Elektronik (TTE) dan Keamanan Informasi.
          4. Pelayanan monev Jaringan dan pengembangan Aplikasi. 5. Pelayanan Radio Blambangan<b><span class="text-danger"> Catatan Penting : Bapak/Ibu dimohon menjawab pertanyaan berikut dengan benar. 
          Segala informasi yang diberikan oleh responden dijamin kerahasiaannya oleh konsultan independen. Terima Kasih</span></b></p>
        </div>
        <!-- <div class="col-sm-12 text-center">
          <h2 class="text-primary font-weight-bold">WAKTU PENGISIAN SURVEI TINGGAL</h2>
          <h2 id="Timer" class="text-danger font-weight-bold"></h2>
        </div> -->
        <div class="col-sm-12">
          <div class="card mt-2">
            <div class="card-header bg-primary text-white">
              <b>SURVEI KEPUASAN MASYARAKAT TERHADAP PELAYANAN PUBLIK DINAS KOMUNIKASI, INFORMATIKA DAN PERSANDIAN KABUPATEN BANYUWANGI</b>
            </div>
            <div class="card-body border border-primary">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-4 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-white"><b>Nama</b></label>
                      </div>
                      <input class="form-control" type="text" id="Nama" placeholder="Wajib Isi Nama">
                    </div>
                  </div> 
                  <div class="col-sm-4 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-white"><b>Jenis Kelamin</b></label>
                      </div>
                      <select class="custom-select" id="Gender">                    
                        <option value="0">Klik Disini</option>
                        <option value="1">Laki-Laki</option>
                        <option value="2">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-white"><b>Usia</b></label>
                      </div>
                      <select class="custom-select" id="Usia">                    
                        <option value="$">Klik Disini</option>
                      <?php $Usia = array('< 20 Tahun','20 - 25 Tahun','26 - 30 Tahun','31 - 35 Tahun','36 - 40 Tahun','41 - 45 Tahun',
                                          '46 - 50 Tahun','51 - 55 Tahun','56 - 60 Tahun','> 60 Tahun'); 
                      foreach ($Usia as $key => $value) { ?>
                        <option value="<?=$key?>"><?=$value?></option>
                      <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-white"><b>Instansi</b></label>
                      </div>
                      <select class="custom-select" id="Instansi" onchange="Instansi()">                    
                        <option value="0">Klik Disini</option>
                        <option value="1">OPD</option>
                        <option value="2">Kecamatan</option>
                        <option value="3">Kelurahan</option>
                        <option value="4">Desa</option>
                        <option value="5">Masyarakat Umum</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4 my-1" id="InputOPD" style="display: none;">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-white"><b>Nama OPD</b></label>
                      </div>
                      <select class="custom-select" id="OPD">                    
                      <?php $OPD = array('Dinas Pendidikan','Dinas Kesehatan','DPUCKPR & Perumahan Pemukiman','Dinas Pekerjaan Umum Pengairan','DPMPTSP','Dinas Pertanian & Pangan',
                                          'Dinas Sosial',' Pemberdayaan Perempuan & KB','Dinas Ketenagakerjaan',' Transmigrasi & Perindustrian','Dinas Perikanan','Dinas Lingkungan Hidup',
                                          'Dinas Kependudukan & Pencatatan Sipil','Dinas Pemberdayaan Masyarakat & Desa','Dinas Perhubungan','Dinas Komunikasi Informatika & Persandian',
                                          'Dinas Koperasi',' Usaha Mikro & Perdagangan','Dinas Pemuda & Olahraga','Dinas Kebudayaan & Pariwisata','Dinas Perpustakaan & Kearsipan','Inspektorat',
                                          'BPBD','Bakesbangpol','Badan Kepegawaian Pendidikan & Pelatihan','BPKAD','BAPPEDA','BAPENDA','Satuan Polisi Pamong Praja',
                                          'Dinas Pemadam Kebakaran & Penyelamatan','RSUD Blambangan','RSUD Genteng','Sekretariat DPRD','Sekretariat Daerah'); 
                      foreach ($OPD as $key) { ?>
                        <option value="<?=$key?>"><?=$key?></option>
                      <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4 my-1" id="InputKecamatan" style="display: none;">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-white"><b>Kecamatan</b></label>
                      </div>
                      <select class="custom-select" id="Kecamatan">  
                        <?php foreach ($Kecamatan as $key) { ?>
                          <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4 my-1" id="InputDesa" style="display: none;">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-white"><b>Desa/Kelurahan</b></label>
                      </div>
                      <select class="custom-select" id="Desa">                    
                        <?php foreach ($Desa as $key) { ?>
                          <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 my-1" id="Portal" style="display: none;">
                    <div class="row">
                      <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>PENDAPAT RESPONDEN TENTANG PELAYANAN PORTAL DATA</b></div> 
                      <?php 
                        $Tanya = array('Bagaimanakah tingkat kemudahan persyaratan dalam mendapatkan pelayanan di Portal Data Kab. Banyuwangi?',
                                      'Bagaimanakah kemudahan prosedur pelayanan di Portal Data Kab. Banyuwangi?',
                                      'Bagaimanakah kecepatan pelayanan di Portal Data Kab. Banyuwangi?',
                                      'Bagaimanakah kewajaran biaya (apabila dikenakan biaya) terhadap jenis pelayanan untuk mengakses Portal Data Kab. Banyuwangi?',
                                      'Apakah Portal Data Kabupaten Banyuwangi sesuai dengan kebutuhan yang diinginkan oleh pengguna/pemohon data?',
                                      'Bagaimanakah kemampuan petugas Dinas Kominfo dan Persandian Kab. Banyuwangi dalam memberikan pelayanan?',
                                      'Bagaimanakah sikap (kesopanan dan keramahan) petugas Dinas Kominfo dan Persandian Kab. Banyuwangi dalam memberikan pelayanan?',
                                      'Bagaimanakah penanganan terhadap pengaduan, saran dan masukan pelayanan Portal Data yang dilakukan Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah kelengkapan fitur (kolom pencarian data, download/upload, login, request data, dll) yang dimiliki Portal Data Kab. Banyuwangi?',
                                      'Menurut anda, bagaimanakah keamanan Portal Data di Dinas Kominfo dan Persandian Kab. Banyuwangi?'
                                      ); 
                        $Opsi = array('1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah',
                                      '1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah',
                                      '1. Tidak Cepat 2. Kurang Cepat 3. Cepat 4. Sangat Cepat',
                                      '1. Tidak Wajar 2. Kurang Wajar 3. Wajar 4. Sangat Wajar',
                                      '1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai',
                                      '1. Tidak Mampu 2. Kurang Mampu 3. Mampu 4. Sangat Mampu',
                                      '1. Tidak Sopan & Tidak Ramah 2. Kurang Sopan & Kurang Ramah 3. Sopan & Ramah 4. Sangat Sopan & Sangat Ramah',
                                      '1. Tidak Memuaskan 2. Kurang Memuaskan 3. Memuaskan 4. Sangat Memuaskan',
                                      '1. Tidak Lengkap 2. Kurang Lengkap 3. Lengkap 4. Sangat Lengkap',
                                      '1. Tidak Aman 2. Kurang Aman 3. Aman 4. Sangat Aman'
                                    ); 
                      ?>
                      <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                        <div class="col-sm-6 my-1">
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($j+1).'. '.$Tanya[$j]?></b></p>
                            </div>
                          </div>
                        </div> 
                        <div class="col-sm-6 bg-primary p-2 my-1">
                          <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                          <?=$Opsi[$j]?>
                          </div>
                          <div class="input-group mt-1">
                            <?php for ($i=1; $i <= 4; $i++) { ?>
                              <div class="form-check form-check-inline ml-4">
                                <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+1)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                                <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                              </div>
                            <?php } ?>
                          </div>
                        </div> 
                      <?php } ?>
                      <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>HARAPAN RESPONDEN TENTANG PELAYANAN PORTAL DATA</b></div> 
                      <?php 
                        $Tanya = array('Persyaratan dalam mendapatkan pelayanan Portal Data Kab. Banyuwangi harus mudah',
                                      'Prosedur pelayanan Portal Data Kab. Banyuwangi harus mudah',
                                      'Harus cepat dalam memberikan pelayanan pada Portal Data Kab. Banyuwangi',
                                      'Biaya (apabila dikenakan biaya) yang ditetapkan pada setiap jenis pelayanan Portal Data Kab. Banyuwangi harus dalam taraf wajar',
                                      'Kesediaan layanan Portal Data Kabupaten Banyuwangi harus sesuai dengan kebutuhan yang diinginkan oleh pengguna/pemohon data',
                                      'Petugas Dinas Kominfo dan Persandian Kab. Banyuwangi harus tanggap dan mampu dalam  memberikan pelayanan',
                                      'Petugas Dinas Kominfo dan Persandian Kab. Banyuwangi harus sopan dan ramah dalam memberikan pelayanan',
                                      'Dinas Kominfo dan Persandian Kab. Banyuwangi harus memberikan penanganan yang memuaskan terhadap pengaduan, saran dan masukan pelayanan Portal',
                                      'Fitur (kolom pencarian data, download/upload, login, request data, dll) yang ada Portal Data Kab. Banyuwangi harus lengkap',
                                      'Dinas Kominfo dan Persandian Kab. Banyuwangi harus memberikan keamanan pelayanan pada pengguna Portal Data Kab. Banyuwangi'
                                      ); 
                        $Opsi = array('1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju'
                                    ); 
                      ?>
                      <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                        <div class="col-sm-6 my-1">
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($j+1).'. '.$Tanya[$j]?></b></p>
                            </div>
                          </div>
                        </div> 
                        <div class="col-sm-6 bg-primary p-2 my-1">
                          <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                          <?=$Opsi[$j]?>
                          </div>
                          <div class="input-group mt-1">
                            <?php for ($i=1; $i <= 4; $i++) { ?>
                              <div class="form-check form-check-inline ml-4">
                                <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+11)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                                <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                              </div>
                            <?php } ?>
                          </div>
                        </div> 
                      <?php } ?>
                    </div>          
                  </div>
                  <div class="col-sm-12 my-1" id="Publikasi" style="display: none;">
                    <div class="row">
                      <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>PENDAPAT RESPONDEN TENTANG PELAYANAN PUBLIKASI DAN KOMUNIKASI PUBLIK (PPID,Pengaduan,Konten Instagram/Berita Banyuwangi/Call Center 112, dll)</b></div> 
                      <?php 
                        $Tanya = array('Bagaimanakah tingkat kemudahan persyaratan dalam mendapatkan pelayanan publikasi dan komunikasi publik dari Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah kemudahan prosedur pelayanan publikasi dan komunikasi publik di Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah kecepatan pelayanan publikasi dan komunikasi publik di Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah kewajaran biaya (apabila dikenakan biaya) terhadap jenis pelayanan publikasi dan komunikasi publik yang diberikan oleh Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Apakah hasil pelayanan publikasi dan komunikasi publik yang diberikan oleh Dinas Kominfo dan Persandian sudah sesuai dengan yang Anda harapkan/inginkan?',
                                      'Bagaimanakah kemampuan petugas Dinas Kominfo dan Persandian Kab. Banyuwangi dalam  memberikan pelayanan?',
                                      'Bagaimanakah sikap (kesopanan dan keramahan) petugas Dinas Kominfo dan Persandian Kab. Banyuwangi dalam memberikan pelayanan?',
                                      'Bagaimanakah penanganan terhadap pengaduan, saran dan masukan pelayanan yang dilakukan Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah sarana dan prasarana pelayanan publik yang dimiliki Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Menurut anda, bagaimanakah keamanan pelayanan di Dinas Kominfo dan Persandian Kab. Banyuwangi?'); 
                        $Opsi = array('1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah',
                                      '1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah',
                                      '1. Tidak Cepat 2. Kurang Cepat 3. Cepat 4. Sangat Cepat',
                                      '1. Tidak Wajar 2. Kurang Wajar 3. Wajar 4. Sangat Wajar',
                                      '1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai',
                                      '1. Tidak Mampu 2. Kurang Mampu 3. Mampu 4. Sangat Mampu',
                                      '1. Tidak Sopan & Tidak Ramah 2. Kurang Sopan & Kurang Ramah 3. Sopan & Ramah 4. Sangat Sopan & Sangat Ramah',
                                      '1. Tidak Memuaskan 2. Kurang Memuaskan 3. Memuaskan 4. Sangat Memuaskan',
                                      '1. Tidak Lengkap 2. Kurang Lengkap 3. Lengkap 4. Sangat Lengkap',
                                      '1. Tidak Aman 2. Kurang Aman 3. Aman 4. Sangat Aman'
                      ); 
                      ?>
                      <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                        <div class="col-sm-6 my-1">
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($j+1).'. '.$Tanya[$j]?></b></p>
                            </div>
                          </div>
                        </div> 
                        <div class="col-sm-6 bg-primary p-2 my-1">
                          <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                          <?=$Opsi[$j]?>
                          </div>
                          <div class="input-group mt-1">
                            <?php for ($i=1; $i <= 4; $i++) { ?>
                              <div class="form-check form-check-inline ml-4">
                                <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+21)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                                <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                              </div>
                            <?php } ?>
                          </div>
                        </div> 
                      <?php } ?>
                      <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>HARAPAN RESPONDEN TENTANG PELAYANAN PUBLIKASI DAN KOMUNIKASI PUBLIK (PPID,Pengaduan,Konten Instagram/Berita Banyuwangi/Call Center 112, dll)</b></div> 
                      <?php 
                        $Tanya = array('Persyaratan dalam mendapatkan pelayanan publikasi dan komunikasi publik dari Dinas Kominfo dan Persandian Kab. Banyuwangi harus mudah',
                                      'Prosedur pelayanan publikasi dan komunikasi publik di Dinas Kominfo dan Persandian Kab. Banyuwangi harus mudah',
                                      'Harus cepat dalam memberikan pelayanan publikasi dan komunikasi publik',
                                      'Biaya (apabila dikenakan biaya) yang ditetapkan pada setiap jenis pelayanan publikasi dan komunikasi publik harus dalam taraf wajar',
                                      'Kesediaan layanan publikasi dan komunikasi publik yang diberikan oleh Dinas Kominfo dan Persandian harus sesuai dengan kebutuhan yang diinginkan oleh pengguna/pemohon data',
                                      'Petugas Dinas Kominfo dan Persandian Kab. Banyuwangi harus tanggap dan mampu dalam  memberikan pelayanan',
                                      'Petugas Dinas Kominfo dan Persandian Kab. Banyuwangi harus sopan dan ramah dalam memberikan pelayanan',
                                      'Dinas Kominfo dan Persandian Kab. Banyuwangi harus memberikan penanganan yang memuaskan terhadap pengaduan, saran dan masukan pelayanan Publikasi dan Komunikasi Publik',
                                      'Sarana dan prasarana pelayanan publik yang dimiliki Dinas Kominfo dan Persandian Kab. Banyuwangi harus lengkap',
                                      'Dinas Kominfo dan Persandian Kab. Banyuwangi harus memberikan keamanan pelayanan pada pengguna layanan publikasi dan komunikasi publik'); 
                        $Opsi = array('1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju'
                                    ); 
                      ?>
                      <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                        <div class="col-sm-6 my-1">
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($j+1).'. '.$Tanya[$j]?></b></p>
                            </div>
                          </div>
                        </div> 
                        <div class="col-sm-6 bg-primary p-2 my-1">
                          <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                          <?=$Opsi[$j]?>
                          </div>
                          <div class="input-group mt-1">
                            <?php for ($i=1; $i <= 4; $i++) { ?>
                              <div class="form-check form-check-inline ml-4">
                                <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+31)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                                <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                              </div>
                            <?php } ?>
                          </div>
                        </div> 
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-sm-12 my-1" id="TTE" style="display: none;">
                    <div class="row">
                      <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>PENDAPAT RESPONDEN TENTANG PELAYANAN TANDA TANGAN ELEKTRONIK (TTE) DAN KEAMANAN INFORMASI</b></div> 
                      <?php 
                        $Tanya = array('Bagaimanakah tingkat kemudahan persyaratan dalam mendapatkan pelayanan TTE?',
                                      'Bagaimanakah kemudahan prosedur pelayanan TTE di Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah kecepatan pelayanan petugas dalam memberikan pelayanan TTE (ketika pendaftaran TTE maupun dalam menangani pengaduan)?',
                                      'Bagaimanakah kewajaran biaya (apabila dikenakan biaya) yang diberikan oleh Dinas Kominfo dan Persandian Kab. Banyuwangi dalam pelayanan TTE?',
                                      'Apakah hasil pelayanan TTE yang diberikan dengan yang anda harapkan/inginkan sudah sesuai?',
                                      'Bagaimanakah kemampuan petugas Dinas Kominfo dan Persandian Kab. Banyuwangi dalam memberikan pelayanan TTE?',
                                      'Bagaimanakah sikap (kesopanan dan keramahan) petugas Dinas Kominfo dan Persandian Kab. Banyuwangi dalam memberikan pelayanan TTE?',
                                      'Bagaimanakah penanganan terhadap pengaduan, saran dan masukan yang dilakukan Dinas Kominfo dan Persandian Kab. Banyuwangi terhadap pelayanan TTE?',
                                      'Bagaimanakah sarana dan prasarana yang dimiliki Dinas Kominfo dan Persandian Kab. Banyuwangi dalam menunjang pelayanan TTE?',
                                      'Pada saat terjadi gangguan dan dilakukan pemulihan data dan informasi mengenai dokumen TTE  masih tersedia dengan baik'); 
                        $Opsi = array('1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai',
                                      '1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah',
                                      '1. Tidak Cepat 2. Kurang Cepat 3. Cepat 4. Sangat Cepat',
                                      '1. Tidak Wajar 2. Kurang Wajar 3. Wajar 4. Sangat Wajar',
                                      '1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai',
                                      '1. Tidak Mampu 2. Kurang Mampu 3. Mampu 4. Sangat Mampu',
                                      '1. Tidak Sopan & Tidak Ramah 2. Kurang Sopan & Kurang Ramah 3. Sopan & Ramah 4. Sangat Sopan & Sangat Ramah',
                                      '1. Tidak Memuaskan 2. Kurang Memuaskan 3. Memuaskan 4. Sangat Memuaskan',
                                      '1. Tidak Lengkap 2. Kurang Lengkap 3. Lengkap 4. Sangat Lengkap',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju'
                            );
                      ?>
                      <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                        <div class="col-sm-6 my-1">
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($j+1).'. '.$Tanya[$j]?></b></p>
                            </div>
                          </div>
                        </div> 
                        <div class="col-sm-6 bg-primary p-2 my-1">
                          <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                          <?=$Opsi[$j]?>
                          </div>
                          <div class="input-group mt-1">
                            <?php for ($i=1; $i <= 4; $i++) { ?>
                              <div class="form-check form-check-inline ml-4">
                                <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+41)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                                <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                              </div>
                            <?php } ?>
                          </div>
                        </div> 
                      <?php } ?>
                      <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>HARAPAN RESPONDEN TENTANG PELAYANAN TANDA TANGAN ELEKTRONIK (TTE) DAN KEAMANAN INFORMASI</b></div> 
                      <?php 
                        $Tanya = array('Persyaratan dalam mendapatkan pelayanan TTE dari Dinas Kominfo dan Persandian Kab. Banyuwangi harus mudah',
                                      'Prosedur pelayanan TTE harus mudah',
                                      'Harus cepat dalam memberikan pelayanan TTE (ketika pendaftaran TTE maupun dalam menangani pengaduan)',
                                      'Biaya (apabila dikenakan biaya) yang ditetapkan pada setiap pelayanan TTE harus dalam taraf wajar',
                                      'Kesediaan layanan TTE yang diberikan oleh Dinas Kominfo dan Persandian harus sesuai dengan kebutuhan yang diinginkan oleh pengguna/pemohon data',
                                      'Petugas Dinas Kominfo dan Persandian Kab. Banyuwangi harus tanggap dan mampu dalam memberikan pelayanan TTE',
                                      'Petugas Dinas Kominfo dan Persandian Kab. Banyuwangi harus sopan dan ramah dalam memberikan pelayanan TTE',
                                      'Dinas Kominfo dan Persandian Kab. Banyuwangi harus memberikan penanganan yang memuaskan terhadap pengaduan, saran dan masukan pelayanan TTE',
                                      'Sarana dan prasarana pelayanan publik dalam menunjang pelayanan TTE yang dimiliki Dinas Kominfo dan Persandian Kab. Banyuwangi harus lengkap',
                                      'Dinas Kominfo dan Persandian Kab. Banyuwangi harus menyediakan pemulihan data dan informasi mengenai dokumen TTE  apabila suatu saat terjadi gangguan/hal yang tidak diinginkan'
                                    ); 
                        $Opsi = array('1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju'
                                    ); 
                      ?>
                      <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                        <div class="col-sm-6 my-1">
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($j+1).'. '.$Tanya[$j]?></b></p>
                            </div>
                          </div>
                        </div> 
                        <div class="col-sm-6 bg-primary p-2 my-1">
                          <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                          <?=$Opsi[$j]?>
                          </div>
                          <div class="input-group mt-1">
                            <?php for ($i=1; $i <= 4; $i++) { ?>
                              <div class="form-check form-check-inline ml-4">
                                <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+51)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                                <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                              </div>
                            <?php } ?>
                          </div>
                        </div> 
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-sm-12 my-1" id="Jaringan" style="display: none;">
                    <div class="row">
                      <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>PENDAPAT RESPONDEN TENTANG PELAYANAN MONEV JARINGAN DAN PENGEMBANGAN APLIKASI</b></div> 
                      <?php 
                        $Tanya = array('Bagaimanakah tingkat kemudahan persyaratan dalam mendapatkan pelayanan monev jaringan dan pengembangan aplikasi?',
                                      'Bagaimanakah kemudahan prosedur pelayanan monev jaringan dan pengembangan aplikasi di Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah kecepatan pelayanan petugas dalam memberikan pelayanan monev jaringan dan pengembangan aplikasi?',
                                      'Bagaimanakah kewajaran biaya (apabila dikenakan biaya) terhadap jenis pelayanan monev jaringan dan pengembangan aplikasi yang diberikan oleh Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah kesesuaian antara hasil pelayanan monev jaringan dan pengembangan aplikasi yang diberikan oleh Dinas Kominfo dan Persandian Kab. Banyuwangi dengan ketentuan yang telah ditetapkan / permintaan awal pemohon?',
                                      'Bagaimanakah kemampuan petugas Dinas Kominfo dan Persandian Kab. Banyuwangi dalam memberikan pelayanan monev jaringan dan pengembangan aplikasi?',
                                      'Bagaimanakah sikap (kesopanan dan keramahan) petugas Dinas Kominfo dan Persandian Kab. Banyuwangi dalam memberikan pelayanan monev jaringan dan pengembangan aplikasi?',
                                      'Bagaimanakah penanganan terhadap pengaduan, saran dan masukan pelayanan monev jaringan dan pengembangan aplikasi yang dilakukan Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah sarana dan prasarana yang dimiliki Dinas Kominfo dan Persandian Kab. Banyuwangi dalam menunjang pelayanan monev jaringan dan pengembangan aplikasi?',
                                      'Menurut anda, bagaimanakah keamanan pelayanan di Dinas Kominfo dan Persandian Kab. Banyuwangi?'); 
                        $Opsi = array('1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai',
                                      '1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah',
                                      '1. Tidak Cepat 2. Kurang Cepat 3. Cepat 4. Sangat Cepat',
                                      '1. Tidak Wajar 2. Kurang Wajar 3. Wajar 4. Sangat Wajar',
                                      '1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai',
                                      '1. Tidak Mampu 2. Kurang Mampu 3. Mampu 4. Sangat Mampu',
                                      '1. Tidak Sopan & Tidak Ramah 2. Kurang Sopan & Kurang Ramah 3. Sopan & Ramah 4. Sangat Sopan & Sangat Ramah',
                                      '1. Tidak Memuaskan 2. Kurang Memuaskan 3. Memuaskan 4. Sangat Memuaskan',
                                      '1. Tidak Lengkap 2. Kurang Lengkap 3. Lengkap 4. Sangat Lengkap',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju'
                            );
                      ?>
                      <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                        <div class="col-sm-6 my-1">
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($j+1).'. '.$Tanya[$j]?></b></p>
                            </div>
                          </div>
                        </div> 
                        <div class="col-sm-6 bg-primary p-2 my-1">
                          <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                          <?=$Opsi[$j]?>
                          </div>
                          <div class="input-group mt-1">
                            <?php for ($i=1; $i <= 4; $i++) { ?>
                              <div class="form-check form-check-inline ml-4">
                                <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+61)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                                <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                              </div>
                            <?php } ?>
                          </div>
                        </div> 
                      <?php } ?>
                      <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>HARAPAN RESPONDEN TENTANG PELAYANAN MONEV JARINGAN DAN PENGEMBANGAN APLIKASI</b></div> 
                      <?php 
                        $Tanya = array('Persyaratan dalam mendapatkan pelayanan monev jaringan dan pengembangan aplikasi dari Dinas Kominfo dan Persandian Kab. Banyuwangi harus mudah',
                                      'Prosedur pelayanan monev jaringan dan pengembangan aplikasi di Dinas Kominfo dan Persandian Kab. Banyuwangi harus mudah',
                                      'Harus cepat dalam memberikan pelayanan monev jaringan dan pengembangan aplikasi',
                                      'Biaya (apabila dikenakan biaya) yang ditetapkan pada setiap jenis pelayanan monev jaringan dan pengembangan aplikasi harus dalam taraf wajar',
                                      'Kesediaan layanan monev jaringan dan pengembangan aplikasi yang diberikan oleh Dinas Kominfo dan Persandian harus sesuai dengan kebutuhan yang diinginkan oleh pengguna/pemohon data',
                                      'Petugas Dinas Kominfo dan Persandian Kab. Banyuwangi harus tanggap dan mampu dalam  memberikan pelayanan monev jaringan dan pengembangan aplikasi',
                                      'Petugas Dinas Kominfo dan Persandian Kab. Banyuwangi harus sopan dan ramah dalam memberikan pelayanan monev jaringan dan pengembangan aplikasi',
                                      'Dinas Kominfo dan Persandian Kab. Banyuwangi harus memberikan penanganan yang memuaskan terhadap pengaduan, saran dan masukan pelayanan monev jaringan dan pengembangan aplikasi',
                                      'Sarana dan prasarana pelayanan publik yang dimiliki Dinas Kominfo dan Persandian Kab. Banyuwangi harus lengkap',
                                      'Dinas Kominfo dan Persandian Kab. Banyuwangi harus memberikan keamanan pelayanan pada pengguna layanan monev jaringan dan pengembangan aplikasi'); 
                        $Opsi = array('1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju'
                                    ); 
                      ?>
                      <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                        <div class="col-sm-6 my-1">
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($j+1).'. '.$Tanya[$j]?></b></p>
                            </div>
                          </div>
                        </div> 
                        <div class="col-sm-6 bg-primary p-2 my-1">
                          <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                          <?=$Opsi[$j]?>
                          </div>
                          <div class="input-group mt-1">
                            <?php for ($i=1; $i <= 4; $i++) { ?>
                              <div class="form-check form-check-inline ml-4">
                                <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+71)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                                <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                              </div>
                            <?php } ?>
                          </div>
                        </div> 
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-sm-12 my-1" id="Radio" style="display: none;">
                    <div class="row">
                      <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>PENDAPAT RESPONDEN TENTANG PELAYANAN RADIO BLAMBANGAN</b></div> 
                      <?php 
                        $Tanya = array('Bagaimanakah tingkat kemudahan persyaratan dalam mendapatkan pelayanan radio blambangan dari Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah kemudahan prosedur pelayanan radio blambangan di Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah kecepatan pelayanan radio blambangan di Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah kewajaran biaya (apabila dikenakan biaya) terhadap jenis pelayanan radio blambangan yang diberikan oleh Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Apakah hasil pelayanan radio blambangan yang diberikan oleh Dinas Kominfo dan Persandian sudah sesuai dengan yang Anda harapkan/inginkan?',
                                      'Bagaimanakah kemampuan petugas Dinas Kominfo dan Persandian Kab. Banyuwangi dalam  memberikan pelayanan?',
                                      'Bagaimanakah sikap (kesopanan dan keramahan) petugas Dinas Kominfo dan Persandian Kab. Banyuwangi dalam memberikan pelayanan?',
                                      'Bagaimanakah penanganan terhadap pengaduan, saran dan masukan pelayanan yang dilakukan  Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Bagaimanakah sarana dan prasarana pelayanan publik yang dimiliki Dinas Kominfo dan Persandian Kab. Banyuwangi?',
                                      'Menurut anda, bagaimanakah keamanan pelayanan di Dinas Kominfo dan Persandian Kab. Banyuwangi?'); 
                        $Opsi = array('1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah',
                                      '1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah',
                                      '1. Tidak Cepat 2. Kurang Cepat 3. Cepat 4. Sangat Cepat',
                                      '1. Tidak Wajar 2. Kurang Wajar 3. Wajar 4. Sangat Wajar',
                                      '1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai',
                                      '1. Tidak Mampu 2. Kurang Mampu 3. Mampu 4. Sangat Mampu',
                                      '1. Tidak Sopan & Tidak Ramah 2. Kurang Sopan & Kurang Ramah 3. Sopan & Ramah 4. Sangat Sopan & Sangat Ramah',
                                      '1. Tidak Memuaskan 2. Kurang Memuaskan 3. Memuaskan 4. Sangat Memuaskan',
                                      '1. Tidak Lengkap 2. Kurang Lengkap 3. Lengkap 4. Sangat Lengkap',
                                      '1. Tidak Aman 2. Kurang Aman 3. Aman 4. Sangat Aman'
                            );
                      ?>
                      <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                        <div class="col-sm-6 my-1">
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($j+1).'. '.$Tanya[$j]?></b></p>
                            </div>
                          </div>
                        </div> 
                        <div class="col-sm-6 bg-primary p-2 my-1">
                          <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                          <?=$Opsi[$j]?>
                          </div>
                          <div class="input-group mt-1">
                            <?php for ($i=1; $i <= 4; $i++) { ?>
                              <div class="form-check form-check-inline ml-4">
                                <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+81)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                                <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                              </div>
                            <?php } ?>
                          </div>
                        </div> 
                      <?php } ?>
                      <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>HARAPAN RESPONDEN TENTANG PELAYANAN RADIO BLAMBANGAN</b></div> 
                      <?php 
                        $Tanya = array('Persyaratan dalam mendapatkan pelayanan radio blambangan dari Dinas Kominfo dan Persandian Kab. Banyuwangi harus mudah',
                                      'Prosedur pelayanan radio blambangan di Dinas Kominfo dan Persandian Kab. Banyuwangi harus mudah',
                                      'Harus cepat dalam memberikan pelayanan radio blambangan',
                                      'Biaya (apabila dikenakan biaya) yang ditetapkan pada setiap jenis pelayanan radio blambangan harus dalam taraf wajar',
                                      'Kesediaan layanan radio blambangan yang diberikan oleh Dinas Kominfo dan Persandian harus sesuai dengan kebutuhan yang diinginkan oleh',
                                      'Petugas Dinas Kominfo dan Persandian Kab. Banyuwangi harus tanggap dan mampu dalam  memberikan pelayanan',
                                      'Petugas Dinas Kominfo dan Persandian Kab. Banyuwangi harus sopan dan ramah dalam memberikan pelayanan',
                                      'Dinas Kominfo dan Persandian Kab. Banyuwangi harus memberikan penanganan yang memuaskan terhadap pengaduan, saran dan masukan pelayanan radio',
                                      'Sarana dan prasarana pelayanan publik yang dimiliki Dinas Kominfo dan Persandian Kab. Banyuwangi harus lengkap',
                                      'Dinas Kominfo dan Persandian Kab. Banyuwangi harus memberikan keamanan pelayanan pada pengguna layanan radio blambangan'); 
                        $Opsi = array('1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju',
                                      '1. Tidak Setuju 2. Kurang Setuju 3. Setuju 4. Sangat Setuju'
                                    ); 
                      ?>
                      <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                        <div class="col-sm-6 my-1">
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($j+1).'. '.$Tanya[$j]?></b></p>
                            </div>
                          </div>
                        </div> 
                        <div class="col-sm-6 bg-primary p-2 my-1">
                          <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                          <?=$Opsi[$j]?>
                          </div>
                          <div class="input-group mt-1">
                            <?php for ($i=1; $i <= 4; $i++) { ?>
                              <div class="form-check form-check-inline ml-4">
                                <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+91)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                                <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                              </div>
                            <?php } ?>
                          </div>
                        </div> 
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah anda memiliki kritik/saran terhadap pelayanan di Dinas Kominfo dan Persandian Kabupaten Banyuwangi?</b></p>
                      </div>
                    </div>
                  </div> 
                  <div class="col-sm-6 bg-primary p-2 my-1">
                    <div class="input-group mt-1">
                    <textarea class="form-control" id="Saran"></textarea>
                    </div>
                  </div> 
                </div>
                <div class="col-sm-6 offset-sm-6">
                  <button type="button" class="btn btn-primary" id="Kirim"><b>Kirim Survei</b> <div id="LoadingInput" class="spinner-border spinner-border-sm text-white" style="display: none;" role="status"></div></button>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <script>
    function Instansi() {
      if ($("#Instansi").val() == '0') {
        document.getElementById("InputOPD").style.display = 'none' 
        document.getElementById("Portal").style.display = 'none' 
        document.getElementById("Publikasi").style.display = 'none'  
        document.getElementById("TTE").style.display = 'none' 
        document.getElementById("Jaringan").style.display = 'none'
        document.getElementById("InputKecamatan").style.display = 'none' 
        document.getElementById("InputDesa").style.display = 'none' 
        document.getElementById("Radio").style.display = 'none'
      } else if ($("#Instansi").val() == '1') {
        document.getElementById("InputOPD").style.display = 'block' 
        document.getElementById("Portal").style.display = 'block' 
        document.getElementById("Publikasi").style.display = 'block'
        document.getElementById("TTE").style.display = 'none' 
        document.getElementById("Jaringan").style.display = 'block'  
        document.getElementById("InputKecamatan").style.display = 'none' 
        document.getElementById("InputDesa").style.display = 'none' 
        document.getElementById("Radio").style.display = 'none'
      } else {
        document.getElementById("InputKecamatan").style.display = 'block' 
        document.getElementById("InputDesa").style.display = 'block' 
        document.getElementById("InputOPD").style.display = 'none'  
        if ($("#Instansi").val() == '2') {
          document.getElementById("Portal").style.display = 'block' 
          document.getElementById("Publikasi").style.display = 'block'
          document.getElementById("TTE").style.display = 'none' 
          document.getElementById("Radio").style.display = 'none'
          document.getElementById("Jaringan").style.display = 'block'   
        } else if ($("#Instansi").val() == '3') {
          document.getElementById("Portal").style.display = 'none' 
          document.getElementById("Publikasi").style.display = 'none'  
          document.getElementById("Radio").style.display = 'none' 
          document.getElementById("TTE").style.display = 'block' 
          document.getElementById("Jaringan").style.display = 'block'
        } else if ($("#Instansi").val() == '4') {
          document.getElementById("Portal").style.display = 'none' 
          document.getElementById("Publikasi").style.display = 'none'   
          document.getElementById("Radio").style.display = 'none'
          document.getElementById("TTE").style.display = 'block' 
          document.getElementById("Jaringan").style.display = 'block'
        } else if ($("#Instansi").val() == '5') {
          document.getElementById("Portal").style.display = 'block' 
          document.getElementById("Radio").style.display = 'block' 
          document.getElementById("Publikasi").style.display = 'none'
          document.getElementById("TTE").style.display = 'none'   
          document.getElementById("Jaringan").style.display = 'none' 
        }
      }
      
    }

    $(document).ready(function(){
        
      var BaseURL = '<?=base_url()?>'  

      $('[data-mask]').inputmask()

      $("#Kecamatan").change(function (){
        var Desa = { Kode: $("#Kecamatan").val() }
        $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) {
          $('#Desa').html(Respon)
        })    
      })

      $("#Kirim").click(function() {
        if ($("#Nama").val() === "") {
          alert('Input Nama Wajib Di isi!')
        } else if ($("#Gender").val() === "0") {
          alert('Input Jenis Kelamin Wajib Di isi!')
        } else if ($("#Usia").val() === "$") {
          alert('Input Usia Wajib Di isi!')
        } else if ($("#Instansi").val() === "0") {
          alert('Input Instansi Wajib Di isi!')
        } else {
          var Cek = false
          if ($("#Instansi").val() === "1") {
            for (let i = 1; i <= 40; i++) {
              if ($("input[name='Input"+i+"']:checked").val() == undefined) {
                Cek = true
                break
              }
            }
            for (let i = 61; i <= 80; i++) {
              if ($("input[name='Input"+i+"']:checked").val() == undefined) {
                Cek = true
                break
              }
            }
          } else if ($("#Instansi").val() === "2") {
            for (let i = 1; i <= 40; i++) {
              if ($("input[name='Input"+i+"']:checked").val() == undefined) {
                Cek = true
                break
              }
            }
            for (let i = 61; i <= 80; i++) {
              if ($("input[name='Input"+i+"']:checked").val() == undefined) {
                Cek = true
                break
              }
            }    
          } else if ($("#Instansi").val() === "3") {
            for (let i = 41; i <= 80; i++) {
              if ($("input[name='Input"+i+"']:checked").val() == undefined) {
                Cek = true
                break
              }
            }    
          } else if ($("#Instansi").val() === "4") {
            for (let i = 41; i <= 80; i++) {
              if ($("input[name='Input"+i+"']:checked").val() == undefined) {
                Cek = true
                break
              }
            }    
          } else if ($("#Instansi").val() === "5") {
            for (let i = 1; i <= 20; i++) {
              if ($("input[name='Input"+i+"']:checked").val() == undefined) {
                Cek = true
                break
              }
            }
            for (let i = 81; i <= 100; i++) {
              if ($("input[name='Input"+i+"']:checked").val() == undefined) {
                Cek = true
                break
              }
            }
          }
          if (Cek) {
            alert('Ada Pertanyaan Yang Belum Di Isi Mohon Cek Kembali!')
          } 
          else {
            var Poin = []
            for (let i = 1; i <= 100; i++) {
              Poin.push($("input[name='Input"+i+"']:checked").val())
            }
            var Nilai = Poin.join("|")
            var Data = { Nama: $("#Nama").val(),
                        Gender: $("#Gender").val(),
                        Usia: $("#Usia").val(),
                        Instansi: $("#Instansi").val() == '1' ? $("#OPD").val() : $("#Instansi").val(),
                        Kecamatan: $("#Kecamatan").val(),
                        Desa: $("#Desa").val(),
                        Saran: $("#Saran").val(),
                        Nilai: Nilai }
            $("#Kirim").attr("disabled", true);                              
            $("#LoadingInput").show();
            $.post(BaseURL+"IDE/InputKominfo", Data).done(function(Respon) {
              if (Respon == '1') {
                alert('Terima Kasih Telah Mengisi Survei!')
                window.location = BaseURL + "IDE/SurveiKominfo"
              } else {
                alert(Respon)
                $("#LoadingInput").hide();
                $("#Kirim").attr("disabled", false);   
              }
            })
          } 
        }
      })
      
      // Set the date we're counting down to
      // var countDownDate = new Date("Nov 27, 2020 12:00:00").getTime();
      // Update the count down every 1 second
      // var x = setInterval(function() {
        // Get today's date and time
        // var now = new Date().getTime();
        // Find the distance between now and the count down date
        // var distance = countDownDate - now;
        // Time calculations for days, hours, minutes and seconds
        // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        // var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        // var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Output the result in an element with id="demo"
        // document.getElementById("Timer").innerHTML = days + " HARI " + hours + " JAM "
        // + minutes + " MENIT " + seconds + " DETIK ";
        // If the count down is over, write some text 
      //   if (distance < 0) {
      //     clearInterval(x);
      //     document.getElementById("Timer").innerHTML = "SURVEI DITUTUP";
      //     $("#Kirim").remove();
      //   }
      // }, 1000);
    })
  </script>
</html>