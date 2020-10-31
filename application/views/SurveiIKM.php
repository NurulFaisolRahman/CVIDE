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
    <!-- <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet"> -->
    <!-- Template Main CSS File -->
    <!-- <link href="../assets/css/style.css" rel="stylesheet"> -->
  </head>

  <body>  
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card mt-2">
            <div class="card-header bg-primary text-light">
              <b>SURVEY KEPUASAN PELAYANAN DESA / KELURAHAN</b>
            </div>
            <div style="background-color: yellow;" class="card-body border border-primary">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>NIK</b></label>
                      </div>
                      <input class="form-control" type="text" id="NIK" placeholder="NIK">
                    </div>
                  </div> 
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Nama</b></label>
                      </div>
                      <input class="form-control" type="text" id="Nama" placeholder="Nama">
                    </div>
                  </div> 
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Jenis Kelamin</b></label>
                      </div>
                      <select class="custom-select" id="Gender">                    
                        <option value="1">Laki-Laki</option>
                        <option value="2">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Usia</b></label>
                      </div>
                      <select class="custom-select" id="Usia">                    
                      <?php $Usia = array('20 - 25 Tahun','26 - 30 Tahun','31 - 35 Tahun','36 - 40 Tahun','41 - 45 Tahun',
                                          '46 - 50 Tahun','51 - 55 Tahun','56 - 60 Tahun','> 60 Tahun'); 
                      foreach ($Usia as $key => $value) { ?>
                        <option value="<?=$key?>"><?=$value?></option>
                      <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Pendidikan</b></label>
                      </div>
                      <select class="custom-select" id="Pendidikan">                    
                      <?php $Pendidikan = array('TIDAK SEKOLAH','SD','SLTP SEDERAJAT','SMA SEDERAJAT','D3/D4',
                                          'S1','S2 KEATAS'); 
                      foreach ($Pendidikan as $key => $value) { ?>
                        <option value="<?=$key?>"><?=$value?></option>
                      <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Kecamatan</b></label>
                      </div>
                      <select class="custom-select" id="Kecamatan">  
                        <?php foreach ($Kecamatan as $key) { ?>
                          <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Desa/Kelurahan</b></label>
                      </div>
                      <select class="custom-select" id="Desa">                    
                        <?php foreach ($Desa as $key) { ?>
                          <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Pekerjaan</b></label>
                      </div>
                      <select class="custom-select" id="Pekerjaan">                    
                      <?php $Pekerjaan = array('PNS','TNI / POLRI','PEGAWAI SWASTA','WIRASWASTA','PELAJAR / MAHASISWA',
                                          'TIDAK/BELUM BEKERJA','LAINNYA'); 
                      foreach ($Pekerjaan as $key => $value) { ?>
                        <option value="<?=$key?>"><?=$value?></option>
                      <?php }?>
                      </select>
                      <input class="form-control" type="text" id="PekerjaanLainnya" placeholder="Jenis Lainnya" disabled>
                    </div>
                  </div>
                  <div class="col-sm-6 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>KEPERLUAN PENGURUSAN DI DESA</b></label>
                      </div>
                      <input class="form-control" type="text" id="Keperluan">
                    </div>
                  </div>
                  <?php 
                    $Tanya = array('1. Persyaratan Pelayanan, yaitu persyaratan teknis dan administratif yang diperlukan untuk mendapatkan pelayanan sesuai dengan jenis pelayanannya.',
                                   '2. Prosedur Pelayanan : kemudahan tahapan pelayanan yang diberikan kepada masyarakat dilihat dari sisi kesederhanaan alur pelayanan',
                                   '3. Waktu Pelayanan : Kecepatan dan Target waktu pelayanan dapat diselesaikan dalam waktu yang telah ditentukan oleh unit penyelenggara pelayanan',
                                   '4. Biaya/Tarif adalah ongkos yang dikenakan kepada penerima layanan dalam mengurus dan/atau memperoleh pelayanan dari penyelenggara yang besarnya ditetapkan berdasarkan kesepakatan antara penyelenggara dan masyarakat',
                                   '5. Produk spesifikasi jenis pelayanan adalah hasil pelayanan yang diberikan dan diterima sesuai dengan ketentuan yang telah ditetapkan. Produk pelayanan ini merupakan hasil dari setiap spesifikasi jenis pelayanan.',
                                   '6. Kompetensi Pelaksana adalah kemampuan yang harus dimiliki oleh pelaksana meliputi pengetahuan, keahlian, keterampilan, dan pengalaman.',
                                   '7. Perilaku Pelaksana adalah sikap petugas dalam memberikan pelayanan.',
                                   '8. Kedisiplinan : Kedisiplinan petugas pelayanan berkaitan dengan waktu kerja sesuai ketentuan',
                                   '9. Penanganan pengaduan, saran dan masukan, adalah tata cara pelaksanaan penanganan pengaduan dan tindak lanjut.',
                                   '10. Sarana adalah segala sesuatu yang dapat dipakai sebagai alat dalam mencapai maksud dan tujuan. Prasarana adalah segala sesuatu yang merupakan penunjang utama terselenggaranya suatu proses (usaha,pembangunan, proyek). Sarana digunakan untuk benda yang bergerak(komputer, mesin) dan prasarana untuk benda yang tidak bergerak (gedung).',
                                   '11. Penerapan Smart Kampung : Apakah Smart Kampung sangat berguna/bermanfaat dalam pelayanan Desa'); 
                    $Opsi = array('1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai',
                                  '1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah',
                                  '1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat',
                                  '1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis',
                                  '1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai',
                                  '1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten',
                                  '1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah',
                                  '1. Tidak disiplin, 2. Kurang Disiplin, 3. Disiplin, 4. Sangat Disiplin',
                                  '1. Tidak Ada, 2. Ada Tapi Tidak Berfungsi, 3. Berfungsi Kurang Maksimal, 4. Dikelola Dengan Baik',
                                  '1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik',
                                  '1. Tidak Bermanfaat, 2. Kurang Bermanfaat, 3. Bermanfaat, 4. Sangat Bermanfaat'); 
                  ?> 
                  <?php for ($j=0; $j < 11; $j++) { ?>
                    <div class="col-sm-6 my-1">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <p class="input-group-text bg-danger text-light text-justify text-wrap"><b><?=$Tanya[$j]?></b></p>
                        </div>
                      </div>
                    </div> 
                    <div class="col-sm-6 bg-light p-2 my-1">
                      <div style="font-size: 11pt;" class="text-wrap text-justify font-weight-bold">
                      <?=$Opsi[$j]?>
                      </div>
                      <div class="input-group mt-1">
                        <?php for ($i=1; $i <= 4; $i++) { ?>
                          <div class="form-check form-check-inline ml-4">
                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Input<?=($j+1)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                            <label class="form-check-label font-weight-bold" for="I<?=($j+1).$i?>">&nbsp;<?=$i?></label>
                          </div>
                        <?php } ?>
                      </div>
                    </div> 
                  <?php } ?>
                  <div class="col-sm-6 offset-sm-6 mt-2">
                    <button type="button" class="btn btn-primary" id="Kirim"><b>Kirim Survei</b></button>
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
  <script>
    $(document).ready(function(){
        
      var BaseURL = '<?=base_url()?>'  

      $("#Kecamatan").change(function (){
        var Desa = { Kode: $("#Kecamatan").val() }
        $.post(BaseURL+"IDE/Desa", Desa).done(function(Respon) {
          $('#Desa').html(Respon)
        })    
      })

      $("#Pekerjaan").change(function (){
        if ($("#Pekerjaan").val() == 6) {
          $("#PekerjaanLainnya").prop('disabled', false);
          $("#PekerjaanLainnya").attr("placeholder", "Sebutkan");
        } else {
          $("#PekerjaanLainnya").prop('disabled', true);
          $("#PekerjaanLainnya").attr("placeholder", "Jenis Lainnya");
        }
      })
      
    })
  </script>
</html>