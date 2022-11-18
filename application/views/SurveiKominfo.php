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
          1. Pelayanan monev Jaringan dan pengembangan Aplikasi. 2. Pelayanan data Statistik (Portal Data). 3. Pelayanan Tanda Tangan Elektronik (TTE) dan Keamanan Informasi.
          4. Pelayanan Publikasi dan Komunikasi Publik.<b><span class="text-danger"> Catatan Penting : Bapak/Ibu dimohon menjawab pertanyaan berikut dengan benar. 
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
            <div style="background-color: yellow;" class="card-body border border-primary">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-4 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-white"><b>Nama</b></label>
                      </div>
                      <input class="form-control" type="text" id="Nama" placeholder="Nama">
                    </div>
                  </div> 
                  <div class="col-sm-4 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-white"><b>Jenis Kelamin</b></label>
                      </div>
                      <select class="custom-select" id="Gender">                    
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
                        <option value="1">Organisasi Perangkat Daerah</option>
                        <option value="2">Kecamatan/Kelurahan/Desa</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4 my-1" id="InputOPD">
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
                  <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>PENDAPAT RESPONDEN TENTANG PELAYANAN PORTAL DATA</b></div> 
                  <?php 
                    $Tanya = array('1. Apakah persyaratan yang harus dipenuhi untuk mendapatkan pelayanan di Portal Data Kabupaten Banyuwangi sudah sesuai?',
                                   '2. Bagaimanakah kemudahan prosedur pelayanan di Portal Data Kabupaten Banyuwangi?',
                                   '3. Bagaimanakah kecepatan pelayanan di Portal Data Kabupaten Banyuwangi?',
                                   '4. Bagaimanakah kewajaran biaya (apabila dikenakan biaya) terhadap jenis pelayanan untuk mengakses Portal Data Kabupaten Banyuwangi?',
                                   '5. Apakah Portal Data Kabupaten Banyuwangi sesuai dengan kebutuhan yang diinginkan oleh pengguna/pemohon data?',
                                   '6. Bagaimanakah penanganan terhadap pengaduan, saran & masukan pelayanan Portal Data yang dilakukan Dinas Kominfo & Persandian Kabupaten Banyuwangi?',
                                   '7. Bagaimanakah kemampuan petugas Dinas Kominfo & Persandian Kabupaten Banyuwangi dalam memberikan pelayanan?',
                                   '8. Bagaimanakah sikap (kesopanan & keramahan) petugas Dinas Kominfo & Persandian Kabupaten Banyuwangi dalam memberikan pelayanan?',
                                   '9. Bagaimanakah kelengkapan fitur (kolom pencarian data, download/upload, login, request data, dll) yang dimiliki Portal Data Kabupaten Banyuwangi?',
                                   '10. Menurut anda, bagaimanakah keamanan Portal Data di Dinas Kominfo dan Persandian Kabupaten Banyuwangi?'); 
                    $Opsi = array('1. Sangat Tidak Sesuai 2. Tidak Sesuai 3. Kurang Sesuai 4. Sesuai 5. Sangat Sesuai 6. Sangat Sesuai Sekali',
                                  '1. Sangat Tidak Mudah 2. Tidak Mudah 3. Kurang Mudah 4. Mudah 5. Sangat Mudah 6. Sangat Mudah Sekali',
                                  '1. Sangat Tidak Cepat 2. Tidak Cepat 3. Kurang Cepat 4. Cepat 5. Sangat Cepat 6. Sangat Cepat Sekali',
                                  '1. Sangat Tidak Wajar 2. Tidak Wajar 3. Kurang Wajar 4. Wajar 5. Sangat Wajar 6. Sangat Wajar Sekali',
                                  '1. Sangat Tidak Sesuai 2. Tidak Sesuai 3. Kurang Sesuai 4. Sesuai 5. Sangat Sesuai 6. Sangat Sesuai Sekali',
                                  '1. Sangat Tidak Memuaskan 2. Tidak Memuaskan 3. Kurang Memuaskan 4. Memuaskan 5. Sangat Memuaskan 6. Sangat Memuaskan Sekali',
                                  '1. Sangat Tidak Mampu 2. Tidak Mampu 3. Kurang Mampu 4. Mampu 5. Sangat Mampu 6. Sangat Mampu Sekali',
                                  '1. Sangat Tidak Sopan & Sangat Tidak Ramah 2. Tidak Sopan & Tidak Ramah 3. Kurang Sopan & Kurang Ramah 4. Sopan & Ramah 5. Sangat Sopan & Sangat Ramah 6. Sangat Sopan Sekali & Sangat Ramah Sekali',
                                  '1. Sangat Tidak Lengkap 2. Tidak Lengkap 3. Kurang Lengkap 4. Lengkap 5. Sangat Lengkap 6. Sangat Lengkap Sekali',
                                  '1. Sangat Tidak Aman 2. Tidak Aman 3. Kurang Aman 4. Aman 5. Sangat Aman 6. Sangat Aman Sekali'); 
                  ?>
                  <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                    <div class="col-sm-6 my-1">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=$Tanya[$j]?></b></p>
                        </div>
                      </div>
                    </div> 
                    <div class="col-sm-6 bg-primary p-2 my-1">
                      <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                      <?=$Opsi[$j]?>
                      </div>
                      <div class="input-group mt-1">
                        <?php for ($i=1; $i <= 6; $i++) { ?>
                          <div class="form-check form-check-inline ml-4">
                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+1)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                            <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                          </div>
                        <?php } ?>
                      </div>
                    </div> 
                  <?php } ?>
                  <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>PENDAPAT RESPONDEN TENTANG PELAYANAN PUBLIKASI DAN KOMUNIKASI PUBLIK</b></div> 
                  <?php 
                    $Tanya = array('11. Apakah menurut anda persyaratan yang harus dipenuhi untuk mendapatkan pelayanan publikasi dan komunikasi publik dari Dinas Kominfo dan Persandian Kabupaten Banyuwangi sudah sesuai?',
                                   '12. Bagaimanakah kemudahan prosedur pelayanan publikasi dan komunikasi publik di Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '13. Bagaimanakah kecepatan pelayanan publikasi dan komunikasi publik di Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '14. Bagaimanakah kewajaran biaya (apabila dikenakan biaya) terhadap jenis pelayanan publikasi dan komunikasi publik yang diberikan oleh Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '15. Apakah hasil pelayanan publikasi dan komunikasi publik yang diberikan oleh Dinas Kominfo dan Persandian sudah sesuai dengan yang Anda harapkan/inginkan?',
                                   '16. Bagaimanakah kemampuan petugas Dinas Kominfo dan Persandian Kabupaten Banyuwangi dalam memberikan pelayanan?',
                                   '17. Bagaimanakah sikap (kesopanan dan keramahan) petugas Dinas Kominfo dan Persandian Kabupaten Banyuwangi dalam memberikan pelayanan?',
                                   '18. Bagaimanakah sarana dan prasarana pelayanan publik yang dimiliki Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '19. Bagaimanakah penanganan terhadap pengaduan, saran dan masukan pelayanan yang dilakukan Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '20. Bagaimanakah situasi keamanan pelayanan di Dinas Kominfo dan Persandian Kabupaten Banyuwangi?'); 
                    $Opsi = array('1. Sangat Tidak Sesuai 2. Tidak Sesuai 3. Kurang Sesuai 4. Sesuai 5. Sangat Sesuai 6. Sangat Sesuai Sekali',
                                  '1. Sangat Tidak Mudah 2. Tidak Mudah 3. Kurang Mudah 4. Mudah 5. Sangat Mudah 6. Sangat Mudah Sekali',
                                  '1. Sangat Tidak Cepat 2. Tidak Cepat 3. Kurang Cepat 4. Cepat 5. Sangat Cepat 6. Sangat Cepat Sekali',
                                  '1. Sangat Tidak Wajar 2. Tidak Wajar 3. Kurang Wajar 4. Wajar 5. Sangat Wajar 6. Sangat Wajar Sekali',
                                  '1. Sangat Tidak Sesuai 2. Tidak Sesuai 3. Kurang Sesuai 4. Sesuai 5. Sangat Sesuai 6. Sangat Sesuai Sekali',
                                  '1. Sangat Tidak Mampu 2. Tidak Mampu 3. Kurang Mampu 4. Mampu 5. Sangat Mampu 6. Sangat Mampu Sekali',
                                  '1. Sangat Tidak Sopan & Sangat Tidak Ramah 2. Tidak Sopan & Tidak Ramah 3. Kurang Sopan & Kurang Ramah 4. Sopan & Ramah 5. Sangat Sopan & Sangat Ramah 6. Sangat Sopan Sekali & Sangat Ramah Sekali',
                                  '1. Sangat Tidak Lengkap 2. Tidak Lengkap 3. Kurang Lengkap 4. Lengkap 5. Sangat Lengkap 6. Sangat Lengkap Sekali',
                                  '1. Sangat Tidak Memuaskan 2. Tidak Memuaskan 3. Kurang Memuaskan 4. Memuaskan 5. Sangat Memuaskan 6. Sangat Memuaskan Sekali',
                                  '1. Sangat Tidak Aman 2. Tidak Aman 3. Kurang Aman 4. Aman 5. Sangat Aman 6. Sangat Aman Sekali'); 
                  ?>
                  <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                    <div class="col-sm-6 my-1">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=$Tanya[$j]?></b></p>
                        </div>
                      </div>
                    </div> 
                    <div class="col-sm-6 bg-primary p-2 my-1">
                      <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                      <?=$Opsi[$j]?>
                      </div>
                      <div class="input-group mt-1">
                        <?php for ($i=1; $i <= 6; $i++) { ?>
                          <div class="form-check form-check-inline ml-4">
                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+11)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                            <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                          </div>
                        <?php } ?>
                      </div>
                    </div> 
                  <?php } ?>
                  <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>PENDAPAT RESPONDEN TENTANG PELAYANAN TANDA TANGAN ELEKTRONIK (TTE) DAN KEAMANAN INFORMASI</b></div> 
                  <?php 
                    $Tanya = array('21. Apakah regulasi/persyaratan yang harus dipenuhi untuk mendapatkan pelayanan TTE sudah sesuai?',
                                   '22. Bagaimanakah kemudahan prosedur pelayanan TTE di Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '23. Bagaimanakah kecepatan pelayanan petugas dalam memberikan pelayanan TTE (ketika pendaftaran TTE maupun dalam menangani pengaduan)?',
                                   '24. Bagaimanakah kewajaran biaya (apabila dikenakan biaya) yang diberikan oleh Dinas Kominfo dan Persandian Kabupaten Banyuwangi dalam pelayanan TTE?',
                                   '25. Apakah hasil pelayanan TTE yang diberikan dengan yang anda harapkan/inginkan sudah sesuai?',
                                   '26. Bagaimanakah penanganan terhadap pengaduan, saran dan masukan yang dilakukan Dinas Kominfo dan Persandian Kabupaten Banyuwangi terhadap pelayanan TTE?',
                                   '27. Bagaimanakah kemampuan petugas Dinas Kominfo dan Persandian Kabupaten Banyuwangi dalam memberikan pelayanan TTE?',
                                   '28. Bagaimanakah sikap (kesopanan dan keramahan) petugas Dinas Kominfo dan Persandian Kabupaten Banyuwangi dalam memberikan pelayanan TTE?',
                                   '29. Bagaimanakah sarana dan prasarana yang dimiliki Dinas Kominfo dan Persandian Kabupaten Banyuwangi dalam menunjang pelayanan TTE?',
                                   '30. Pada saat terjadi gangguan dan dilakukan pemulihan, data dan informasi mengenai dokumen TTE masih tersedia dengan baik?'); 
                    $Opsi = array('1. Sangat Tidak Sesuai 2. Tidak Sesuai 3. Kurang Sesuai 4. Sesuai 5. Sangat Sesuai 6. Sangat Sesuai Sekali',
                                  '1. Sangat Tidak Mudah 2. Tidak Mudah 3. Kurang Mudah 4. Mudah 5. Sangat Mudah 6. Sangat Mudah Sekali',
                                  '1. Sangat Tidak Cepat 2. Tidak Cepat 3. Kurang Cepat 4. Cepat 5. Sangat Cepat 6. Sangat Cepat Sekali',
                                  '1. Sangat Tidak Wajar 2. Tidak Wajar 3. Kurang Wajar 4. Wajar 5. Sangat Wajar 6. Sangat Wajar Sekali',
                                  '1. Sangat Tidak Sesuai 2. Tidak Sesuai 3. Kurang Sesuai 4. Sesuai 5. Sangat Sesuai 6. Sangat Sesuai Sekali',
                                  '1. Sangat Tidak Memuaskan 2. Tidak Memuaskan 3. Kurang Memuaskan 4. Memuaskan 5. Sangat Memuaskan 6. Sangat Memuaskan Sekali',
                                  '1. Sangat Tidak Mampu 2. Tidak Mampu 3. Kurang Mampu 4. Mampu 5. Sangat Mampu 6. Sangat Mampu Sekali',
                                  '1. Sangat Tidak Sopan & Sangat Tidak Ramah 2. Tidak Sopan & Tidak Ramah 3. Kurang Sopan & Kurang Ramah 4. Sopan & Ramah 5. Sangat Sopan & Sangat Ramah 6. Sangat Sopan Sekali & Sangat Ramah Sekali',
                                  '1. Sangat Tidak Lengkap 2. Tidak Lengkap 3. Kurang Lengkap 4. Lengkap 5. Sangat Lengkap 6. Sangat Lengkap Sekali',
                                  '1. Sangat Tidak Setuju 2. Tidak Setuju 3. Kurang Setuju 4. Setuju 5. Sangat Setuju 6. Sangat Setuju Sekali'); 
                  ?>
                  <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                    <div class="col-sm-6 my-1">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=$Tanya[$j]?></b></p>
                        </div>
                      </div>
                    </div> 
                    <div class="col-sm-6 bg-primary p-2 my-1">
                      <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                      <?=$Opsi[$j]?>
                      </div>
                      <div class="input-group mt-1">
                        <?php for ($i=1; $i <= 6; $i++) { ?>
                          <div class="form-check form-check-inline ml-4">
                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+21)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                            <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                          </div>
                        <?php } ?>
                      </div>
                    </div> 
                  <?php } ?>
                  <div class="col-sm-12 my-1 bg-primary text-white py-2"><b>PENDAPAT RESPONDEN TENTANG PELAYANAN MONEV JARINGAN DAN PENGEMBANGAN APLIKASI</b></div> 
                  <?php 
                    $Tanya = array('31. Bagaimanakah menurut anda terhadap kesesuaian persyaratan yang harus dipenuhi untuk mendapatkan pelayanan monev jaringan dan pengembangan aplikasi dari Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '32. Bagaimanakah kemudahan prosedur pelayanan monev jaringan dan pengembangan aplikasi di Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '33. Bagaimanakah kecepatan pelayanan monev jaringan dan pengembangan aplikasi di Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '34. Bagaimanakah kewajaran biaya (apabila dikenakan biaya) terhadap jenis pelayanan monev jaringan dan pengembangan aplikasi yang diberikan oleh Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '35. Bagaimanakah kesesuaian antara hasil pelayanan monev jaringan dan pengembangan aplikasi yang diberikan oleh Dinas Kominfo dan Persandian Kabupaten Banyuwangi dengan ketentuan yang telah ditetapkan / permintaan awal pemohon?',
                                   '36. Bagaimanakah kemampuan petugas Dinas Kominfo dan Persandian Kabupaten Banyuwangi dalam memberikan pelayanan monev jaringan dan pengembangan aplikasi?',
                                   '37. Bagaimanakah sikap (kesopanan dan keramahan) petugas Dinas Kominfo dan Persandian Kabupaten Banyuwangi dalam memberikan pelayanan monev jaringan dan pengembangan aplikasi?',
                                   '38. Bagaimanakah sarana dan prasarana yang dimiliki Dinas Kominfo dan Persandian Kabupaten Banyuwangi dalam menunjang pelayanan monev jaringan dan pengembangan aplikasi?',
                                   '39. Bagaimanakah penanganan terhadap pengaduan, saran dan masukan pelayanan monev jaringan dan pengembangan aplikasi yang dilakukan Dinas Kominfo dan Persandian Kabupaten Banyuwangi?',
                                   '40. Bagaimanakah situasi keamanan pelayanan di Dinas Kominfo dan Persandian Kabupaten Banyuwangi?'); 
                    $Opsi = array('1. Sangat Tidak Sesuai 2. Tidak Sesuai 3. Kurang Sesuai 4. Sesuai 5. Sangat Sesuai 6. Sangat Sesuai Sekali',
                                  '1. Sangat Tidak Mudah 2. Tidak Mudah 3. Kurang Mudah 4. Mudah 5. Sangat Mudah 6. Sangat Mudah Sekali',
                                  '1. Sangat Tidak Cepat 2. Tidak Cepat 3. Kurang Cepat 4. Cepat 5. Sangat Cepat 6. Sangat Cepat Sekali',
                                  '1. Sangat Tidak Wajar 2. Tidak Wajar 3. Kurang Wajar 4. Wajar 5. Sangat Wajar 6. Sangat Wajar Sekali',
                                  '1. Sangat Tidak Sesuai 2. Tidak Sesuai 3. Kurang Sesuai 4. Sesuai 5. Sangat Sesuai 6. Sangat Sesuai Sekali',
                                  '1. Sangat Tidak Mampu 2. Tidak Mampu 3. Kurang Mampu 4. Mampu 5. Sangat Mampu 6. Sangat Mampu Sekali',
                                  '1. Sangat Tidak Sopan & Sangat Tidak Ramah 2. Tidak Sopan & Tidak Ramah 3. Kurang Sopan & Kurang Ramah 4. Sopan & Ramah 5. Sangat Sopan & Sangat Ramah 6. Sangat Sopan Sekali & Sangat Ramah Sekali',
                                  '1. Sangat Tidak Lengkap 2. Tidak Lengkap 3. Kurang Lengkap 4. Lengkap 5. Sangat Lengkap 6. Sangat Lengkap Sekali',
                                  '1. Sangat Tidak Memuaskan 2. Tidak Memuaskan 3. Kurang Memuaskan 4. Memuaskan 5. Sangat Memuaskan 6. Sangat Memuaskan Sekali',
                                  '1. Sangat Tidak Aman 2. Tidak Aman 3. Kurang Aman 4. Aman 5. Sangat Aman 6. Sangat Aman Sekali'); 
                  ?>
                  <?php for ($j=0; $j < count($Tanya); $j++) { ?>
                    <div class="col-sm-6 my-1">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=$Tanya[$j]?></b></p>
                        </div>
                      </div>
                    </div> 
                    <div class="col-sm-6 bg-primary p-2 my-1">
                      <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold text-white">
                      <?=$Opsi[$j]?>
                      </div>
                      <div class="input-group mt-1">
                        <?php for ($i=1; $i <= 6; $i++) { ?>
                          <div class="form-check form-check-inline ml-4">
                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+31)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                            <label class="form-check-label font-weight-bold text-white" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                          </div>
                        <?php } ?>
                      </div>
                    </div> 
                  <?php } ?>
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
                  <div class="col-sm-6 offset-sm-6">
                    <button type="button" class="btn btn-primary" id="Kirim"><b>Kirim Survei</b> <div id="LoadingInput" class="spinner-border spinner-border-sm text-white" style="display: none;" role="status"></div></button>
                  </div> 
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
      if ($("#Instansi").val() == '1') {
        document.getElementById("InputOPD").style.display = 'block' 
        document.getElementById("InputKecamatan").style.display = 'none' 
        document.getElementById("InputDesa").style.display = 'none' 
      } else {
        document.getElementById("InputKecamatan").style.display = 'block' 
        document.getElementById("InputDesa").style.display = 'block' 
        document.getElementById("InputOPD").style.display = 'none'   
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
          alert('Input Nama Belum Benar!')
        } else {
          var Cek = false
          var Tanya = 0
          for (let i = 1; i <= 40; i++) {
            if ($("input[name='Input"+i+"']:checked").val() == undefined) {
              Cek = true
              Tanya = i
              break
            }
          }
          if (Cek) {
            alert('Pertanyaan Nomer '+Tanya+' Wajib Di Isi!')
          } 
          else {
            var Poin = []
            for (let i = 1; i <= 40; i++) {
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
                alert('Terima Kasih!')
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