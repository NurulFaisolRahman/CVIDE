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
              <b>SURVEI KINERJA PENYELENGGARAAN PEMERINTAHAN DESA</b>
            </div>
            <div style="background-color: yellow;" class="card-body border border-primary">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Nama</b></label>
                      </div>
                      <input class="form-control" type="text" id="Nama" placeholder="Nama Responden">
                    </div>
                  </div> 
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Jabatan</b></label>
                      </div>
                      <input class="form-control" type="text" id="Jabatan">
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
                  <?php 
                    $Tanya =  array('Apakah visi dan misi penyelenggaraan pemerintahan desa yang dituangkan dalam LPPDes sesuai dengan RPJMDes?',
                                    'Apakah arah dan strategi yang dituangkan dalam LPPDes selaras dengan RKPDes dan APBDes yang telah disusun?',
                                    'Berapakah PADes dan Dana Desa yang dimiliki sesuai dengan yang dicantumkan di LPPDes?',
                                    'Berapakah jumlah belanja aparatur desa dengan berapa jumlah total APBDes dengan yang dicantumkan ada di LPPDes?',
                                    'Berapakah hasil SiLPA? (Terselanggaranya semua program kegiatan dan terdapat laporan sisa hasil anggaran)',
                                    'Keberhasilan apa sajakah yang telah dicapai dalam setiap bidang aspek baik pelaksanaan pemerintahan desa, pelaksanaan pembangunan, pembinaan kemasyarakatan dan pemberdayaan masyarakat yang telah dituangkan dalam Laporan Penyelenggaran Pemerintahan Desa (LPPDes)?  (Dalam 1 Tahun)',
                                    'Permasalahan apa sajakah yang dihadapi dalam setiap bidang aspek baik pelaksanaan pemerintahan desa, pelaksanaan pembangunan, pembinaan kemasyrakatan dan pemberdayaan masyarakat yang telah dituangkan dalam Laporan Penyelenggaran Pemerintahan Desa (LPPDes)? Serta berapakah persentase tindak lanjut yang telah dicapai dalam menyelesaikan permasalahan tersebut?',
                                    'Apakah setiap program dari aspek bidang penyelenggaraan pemerintahan desa sesuai/selaras dengan :<br>a. Peraturan desa<br>b. Peraturan bersama kepala desa<br>c. Peraturan kepala desa<br>d. Keputusan kepala desa',
                                    'Apakah di LPPDes tercantum data terkait :<br>a. Jumlah total penduduk<br>b. Jumlah penduduk laki-laki<br>c. Jumlah penduduk perempuan<br>d. Jumlah kepala keluarga<br>e. Jumlah anggota keluarga<br>f. Jumlah penduduk menurut tingkat Pendidikan umum<br>g. Jumlah penduduk tingkat kebutuhan khusus<br>h. Jumlah penduduk menurut mata pencaharian PNS<br>i. Jumlah penduduk menurut mata pencaharian TNI<br>j. Jumlah penduduk menurut mata pencaharian SWASTA<br>k. Jumlah aparat pemerintah PNS dan NON PNS<br>l. Jumlah BPD',
                                    'Apakah di LPPDes tercantum data terkait :<br>a.Status tanah yang memiliki sertifikat hak milik<br>b.Status tanah yang memiliki sertifikat hak guna usaha<br>c.Status tanah yang memiliki sertifikat hak pakai<br>d.Luas tanah yang bersertifikat<br>e.Luas tanah yang belum bersertifikat<br>f.Luas tanah kas desa<br>g.Luas tanah untuk keperuntukkan jalan<br>h.Luas tanah untuk keperuntukkan tanah ladang<br>i.Luas tanah untuk keperuntukkan bangunan umum<br>j.Luas tanah untuk keperuntukkan perumahan<br>k.Luas tanah untuk keperuntukkan ruang fasilitas umum<br>l.Tanah yang belum dikelola (hutan)<br>m.Tanah yang belum dikelola (rawa-rawa)',
                                    'Berapakah target dan realisasi dari setiap program sesuai keputusan pada saat Musyawarah desa, musrenbangdesa, musyawarah BPD yang dituangkan dalam LPPDes?',
                                    'Berapakah jumlah hansip yang tersedia di Desa? Dan berapakah banyak penduduk desa?',
                                    'Apakah di desa terdapat :<br>a. pos pemadam kebakaran<br>b. alat pemadam kebakaran<br>c. Pompa hidran<br>d. Kelompok sukarelawan pemadam kebakaran tingkat RT/RW',
                                    'Apakah di desa terdapat :<br>a. petugas sigap bencana alam<br>b. persediaan obat-obatan untuk gempa<br>c. alat deteksi bencana<br>d. tenda evakuasi bencana',
                                    'Apakah tersedia pos keamanan desa dan jadwal ronda setiap harinya dalam sebulan?',
                                    'Berapa kali terjadi kecelakaan remaja di desa setiap tahun?',
                                    'Apakah tersedia :<br>1. RT/RW<br>2. PKK<br>3. Karang taruna<br>4. Pos pelayanan terpadu<br>5. LPM',
                                    'Apakah Lembaga kemasyarakatan membantu keterlaksanaan setiap program desa?'); 
                    $Opsi = array('Sangat Selaras|Cukup Selaras|Kurang Selaras|Tidak Selaras',
                                  'Sangat Selaras|Cukup Selaras|Kurang Selaras|Tidak Selaras',
                                  'PADes|Dana Desa',
                                  'Penghasilan tetap aparatur desa|Total belanja pembangunan',
                                  'program telah terselenggara semua & SiLPA < 30% dari pendapatan desa|program telah terselenggara semua & SiLPA = 0 dari pendapatan desa|program telah terselenggara semua & SiLPA < 0 dari pendapatan desa|ada program yang belum terselenggara & SiLPA > 0 dari pendapatan desa',
                                  'Keberhasilan yang telah dicapai > 5|Keberhasilan yang telah dicapai 4-5|Keberhasilan yang telah dicapai 2-3|Keberhasilan yang telah dicapai < 0',
                                  'tindak lanjut sebesar 76-100%|tindak lanjut sebesar 56-75%|tindak lanjut sebesar 40-55%|tindak lanjut sebesar < 40%',
                                  'Selaras semua|Selaras 3|Selaras 2|Selaras 1',
                                  'Tercatat semua item di LPPDes|Tercatat > 5 item di LPPDes|Tercatat hanya 5 item di LPPDes|Tercatat < 5 item di LPPDes',
                                  'Tercatat semua item di LPPDes|Tercatat > 8 item di LPPDes|Tercatat hanya 5 item di LPPDes|Tercatat < 5 item di LPPDes',
                                  'Target|Realisasi',
                                  'Jumlah hansip|Jumlah penduduk',
                                  'tersedia semua item|tersedia 3 item|tersedia 1-2 item|tidak tersedia',
                                  'tersedia semua item|tersedia 3 item|tersedia 1-2 item|tidak tersedia',
                                  'Ketersediaan pos keamanan desa & ada jadwal ronda setiap harinya dalam sebulan|Tidak tersedia pos keamanan & tetapi ada jadwal ronda tiap harinya|Tersedia pos keamanan desa tapi tidak ada jadwal ronda tiap harinya dalam sebulan|Tidak tersedia pos keamanan & tidak ada jadwal ronda tiap harinya',
                                  'Jika kecelakaan remaja 1-2x|Jika kecelakaan remaja 3-4x|Jika kecelakaan remaja 5x|Jika kecelakaan remaja > 5x',
                                  'tersedia semua item|tersedia 3 item|tersedia 1-2 item|tidak tersedia',
                                  'selalu berpartisipasi keterlaksanaan program desa|sering berpartisipasi keterlaksanaan program desa|kadang-kadang berpartisipasi keterlaksanaan program desa|tidak pernah berpartisipasi keterlaksanaan program desa');                              
                  ?>
                  <?php for ($i=0; $i < count($Tanya); $i++) { $Pisah = explode("|",$Opsi[$i]);?>
                    <div class="col-sm-5 my-1">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <p class="input-group-text bg-danger text-light text-justify text-wrap"><b><?=($i+1).". ".$Tanya[$i]?></b></p>
                        </div>
                      </div>
                    </div> 
                    <div class="col-sm-7 bg-light p-2 my-1">
                      <div class="input-group">
                        <?php if (count($Pisah) == 4) { ?>
                          <?php for ($j=0; $j < 4; $j++) { ?>
                            <div class="form-check form-check-inline ml-4 my-1">
                              <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="I<?=$i?>" id="I<?=$i.$j?>" value="<?=$j?>">
                              <label class="form-check-label font-weight-bold" for="I<?=$i.$j?>">&nbsp;<?=$Pisah[$j]?></label>
                            </div>
                          <?php } ?>
                        <?php } else if (count($Pisah) <= 2) { ?>
                          <?php for ($j=0; $j < count($Pisah); $j++) { ?>
                            <div class="input-group my-1">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-light"><b><?=$Pisah[$j]?></b></label>
                              </div>
                              <input class="form-control" type="text" id="I<?=$i.$j?>" placeholder="0">
                            </div>
                          <?php } ?>
                        <?php } ?>
                      </div>
                    </div> 
                  <?php } ?>
                  <div class="col-sm-12 mt-2 d-flex justify-content-center">
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
      
    })
  </script>
</html>