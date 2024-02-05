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
        <div class="col-sm-12 mt-2"> 
          <p class="text-justify">&emsp;&emsp;&emsp;Dalam rangka peningkatan kualitas pelayanan publik secara berkelanjutan dan memenuhi amanat PERMENPAN RB Nomor 14 Tahun 2017 tentang Pedoman Penyusunan Survei Kepuasan Masyarakat Unit Penyelenggara Pelayanan Publik, bahwa penyelenggara pelayanan publik wajib melaksanakan Survei Kepuasan Masyarakat (SKM) secara berkala minimal 1 (satu) kali setahun.
            Atas dasar tersebut, dengan ini BAPPEDA Kabupaten Situbondo bermaksud melakukan Survei Kepuasan Masyarakat (SKM) tentang Penyelenggaraan Pelayanan BAPPEDA Kabupaten Situbondo. Kami berharap Bapak/Ibu/Saudara/Saudari berkenan untuk menjawab kuesioner di bawah ini.
            Kuesioner ini disusun berdasarkan Lampiran III PERMENPAN RB Nomor 14 Tahun 2017 tentang Pedoman Penyusunan Survei Kepuasan Masyarakat.
            <b>Pilih jawaban sesuai dengan pendapat anda tentang Kinerja (Performa) dan Kepentingan (Importance) pelayanan pada BAPPEDA Kabupaten Situbondo. Pilih jawaban dengan cara memilih salah satu
            <span class="text-danger">*) Unit layanan adalah Bidang dan Fungsional Perencana pada Bappeda.</span></b></p>
        </div>
        <!-- <div class="col-sm-12 text-center">
          <h2 class="text-primary font-weight-bold">WAKTU PENGISIAN SURVEI TINGGAL</h2>
          <h2 id="Timer" class="text-danger font-weight-bold"></h2>
        </div> -->
        <div class="col-sm-12">
          <div class="card mt-2">
            <div class="card-header bg-danger text-white">
              <b>SURVEI KEPUASAN MASYARAKAT (SKM) TERHADAP LAYANAN BAPPEDA KABUPATEN SITUBONDO</b>
            </div>
            <div style="background-color: #FFBF00;" class="card-body border border-primary">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-3 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-white"><b>Nama</b></label>
                      </div>
                      <input class="form-control" type="text" id="Nama" placeholder="Nama">
                    </div>
                  </div> 
                  <div class="col-sm-3 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-white"><b>Jenis Kelamin</b></label>
                      </div>
                      <select class="custom-select" id="Gender">                    
                        <option value="Gender">Klik Disini</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-white"><b>Usia</b></label>
                      </div>
                      <input class="form-control" type="text" id="Usia">
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-white"><b>Pendidikan</b></label>
                      </div>
                      <select class="custom-select" id="Pendidikan">  
                        <option value="Pendidikan">Klik Disini</option>                  
                      <?php $Pendidikan = array('SD/SEDERAJAT','SMP/SEDERAJAT','SMA/SEDERAJAT','D3/D4',
                                          'S1','S2','S3'); 
                      foreach ($Pendidikan as $key => $value) { ?>
                        <option value="<?=$value?>"><?=$value?></option>
                      <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-white"><b>Pekerjaan</b></label>
                      </div>
                      <select class="custom-select" id="Pekerjaan">      
                        <option value="Pekerjaan">Klik Disini</option>                 
                      <?php $Pekerjaan = array('PNS','TNI/POLRI','PEGAWAI SWASTA','WIRAUSAHA','LAINNYA'); 
                      foreach ($Pekerjaan as $key => $value) { ?>
                        <option value="<?=$value?>"><?=$value?></option>
                      <?php }?>
                      </select>
                      <input class="form-control" type="text" id="PekerjaanLainnya" placeholder="Lainnya" disabled>
                    </div>
                  </div>
                  <div class="col-sm-6 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-white"><b>Instansi</b></label>
                      </div>
                      <select class="custom-select" id="Instansi">    
                        <option value="Instansi">Klik Disini</option>                   
                      <?php $Instansi = array('DINAS PENDIDIKAN DAN KEBUDAYAAN','DINAS KESEHATAN','RUMAH SAKIT UMUM DAERAH (RSUD) ASEMBAGUS','RUMAH SAKIT UMUM DAERAH (RSUD) BESUKI','RUMAH SAKIT UMUM DAERAH (RSUD) DR. ABDOER RAHEM','DINAS PEKERJAAN UMUM DAN PERUMAHAN PERMUKIMAN','SATUAN POLISI PAMONG PRAJA','BADAN PENANGGULANGAN BENCANA DAERAH','DINAS SOSIAL','DINAS KETENAGAKERJAAN','DINAS PEMBERDAYAAN PEREMPUAN',' PERLINDUNGAN ANAK',' PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA','DINAS PERTANIAN DAN KETAHANAN PANGAN','DINAS LINGKUNGAN HIDUP','DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL','DINAS PEMBERDAYAAN MASYARAKAT DAN DESA','DINAS PERHUBUNGAN','DINAS KOMUNIKASI DAN INFORMATIKA','DINAS KOPERASI PERINDUSTRIAN DAN PERDAGANGAN','DINAS PENANAMAN MODAL PELAYANAN TERPADU SATU PINTU','DINAS PARIWISATA PEMUDA DAN OLAHRAGA','DINAS PERPUSTAKAAN DAN KEARSIPAN','DINAS PETERNAKAN DAN PERIKANAN','SEKRETARIAT DAERAH','SEKRETARIAT DPRD','BADAN PERENCANAAN PEMBANGUNAN DAERAH','BADAN KEUANGAN DAN ASET DAERAH','BADAN PENDAPATAN DAERAH','BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA','INSPEKTORAT','KECAMATAN BANYUGLUGUR','KECAMATAN JATIBANTENG','KECAMATAN SUMBERMALANG','KECAMATAN BESUKI','KECAMATAN SUBOH','KECAMATAN MLANDINGAN','KECAMATAN BUNGATAN','KECAMATAN KENDIT','KECAMATAN PANARUKAN','KECAMATAN SITUBONDO','KECAMATAN PANJI','KECAMATAN MANGARAN','KECAMATAN KAPONGAN','KECAMATAN ARJASA','KECAMATAN ASEMBAGUS','KECAMATAN JANGKAR','KECAMATAN BANYUPUTIH','BADAN KESATUAN BANGSA DAN POLITIK','LAINNYA'); 
                      foreach ($Instansi as $key => $value) { ?>
                        <option value="<?=$value?>"><?=$value?></option>
                      <?php }?>
                      </select>
                      <input class="form-control" type="text" id="InstansiLainnya" placeholder="Lainnya" disabled>
                    </div>
                  </div>
                  <div class="col-sm-6 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-white"><b>Jenis Layanan</b></label>
                      </div>
                      <select class="custom-select" id="Layanan">      
                        <option value="Layanan">Klik Disini</option>                 
                      <?php $Pekerjaan = array('Musrenbang','Penyusunan Dokumen Perencanaan Tahuna/5 Tahunan','LKPJ','SIPD','Inovasi Daerah','LAINNYA'); 
                      foreach ($Pekerjaan as $key => $value) { ?>
                        <option value="<?=$value?>"><?=$value?></option>
                      <?php }?>
                      </select>
                      <input class="form-control" type="text" id="LayananLainnya" placeholder="Lainnya" disabled>
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-white"><b>Kecamatan</b></label>
                      </div>
                      <select class="custom-select" id="Kecamatan">  
                        <?php foreach ($Kecamatan as $key) { ?>
                          <option value="<?=$key['Nama']?>"><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-white"><b>Desa/Kelurahan</b></label>
                      </div>
                      <select class="custom-select" id="Desa">                    
                        <?php foreach ($Desa as $key) { ?>
                          <option value="<?=$key['Nama']?>"><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <?php 
                    $Tanya = array('1. Bagaimana pendapat saudara tentang kesesuaian persyaratan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) dengan peraturan perundang-undangan di unit pelayanan Bappeda Kab. Situbondo?',
                                   '2. Bagaimana kepentingan/harapan saudara tentang kesesuaian persyaratan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) dengan peraturan perundang-undangan di unit pelayanan Bappeda Kab. Situbondo?',
                                   '3. Bagaimana pemahaman Saudara tentang kejelasan dan kemudahan SOP/prosedur layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                                   '4. Bagaimana kepentingan/harapan Saudara tentang kejelasan dan kemudahan SOP/prosedur layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                                   '5. Bagaimana pendapat Saudara tentang kecepatan dan ketepatan waktu dalam memberikan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                                   '6. Bagaimana kepentingan/harapan Saudara tentang kecepatan dan ketepatan waktu dalam memberikan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                                   '7. Bagaimana pendapat saudara tentang biaya/tarif layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di BAPPEDA telah sesuai dengan peraturan yang berlaku?',
                                   '8. Bagaimana kepentingan/harapan saudara tentang biaya/tarif layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di BAPPEDA telah sesuai dengan peraturan yang berlaku?',
                                   '9. Bagaimana pendapat saudara tentang kewajaran biaya/tarif dalam layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di BAPPEDA Kab Situbondo?',
                                   '10. Bagaimana kepentingan/harapan saudara tentang kewajaran biaya/tarif dalam layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di BAPPEDA Kab Situbondo?',
                                   '11. Bagaimana pendapat anda tentang kesesuaian produk layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) substansi dan arahan antara yang tercantum dalam standar regulasi dengan hasil yang diberikan di unit pelayanan Bappeda Kab. Situbondo?',
                                   '12. Bagaimana kepentingan/harapan anda tentang kesesuaian produk layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) substansi dan arahan antara yang tercantum dalam standar regulasi dengan hasil yang diberikan di unit pelayanan Bappeda Kab. Situbondo?',
                                   '13. Bagaimana pendapat Saudara tentang kompetensi/ kemampuan SDM (Kabid dan Perencana) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                                   '14. Bagaimana kepentingan/harapan Saudara tentang kompetensi/ kemampuan SDM (Kabid dan Perencana) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                                   '15. Bagaimana pendapat saudara perilaku petugas dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) terkait kesopanan dan keramahan di unit pelayanan Bappeda Kab. Situbondo?',
                                   '16. Bagaimana kepentingan/harapan saudara perilaku petugas dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) terkait kesopanan dan keramahan di unit pelayanan Bappeda Kab. Situbondo?',
                                   '17. Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana (Wifi, Proyektor, AC, dll) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                                   '18. Bagaimana kepentingan/harapan Saudara tentang kualitas sarana dan prasarana (Wifi, Proyektor, AC, dll) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                                   '19. Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                                   '20. Bagaimana kepentingan/harapan Saudara tentang penanganan pengaduan pengguna layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD/RENSTRA/RKPD/RENJA/LKPJ/Inovasi/Lainnya) di unit pelayanan Bappeda Kab. Situbondo?'); 
                    $Opsi = array('1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai',
                                  '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
                                  '1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah',
                                  '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
                                  '1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat',
                                  '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
                                  '1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai',
                                  '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
                                  '1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis',
                                  '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
                                  '1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai',
                                  '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
                                  '1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten',
                                  '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
                                  '1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah',
                                  '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
                                  '1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik',
                                  '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
                                  '1. Tidak Ada, 2. Ada Tapi Tidak Berfungsi, 3. Berfungsi Kurang Maksimal, 4. Dikelola Dengan Baik',
                                  '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting'); 
                  ?> 
                  <?php for ($j=0; $j < 20; $j++) { ?>
                    <div class="col-sm-6 my-1">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <p class="input-group-text bg-primary text-white text-justify text-wrap"><b><?=$Tanya[$j]?></b></p>
                        </div>
                      </div>
                    </div> 
                    <div class="col-sm-6 bg-danger p-2 my-1">
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
                  <div class="col-sm-6 my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <p class="input-group-text bg-primary text-white text-justify text-wrap"><b>Silakan memberikan masukan berupa saran atau kritik terhadap layanan BAPPEDA Kab. Situbondo :</b></p>
                      </div>
                    </div>
                  </div> 
                  <div class="col-sm-6 bg-danger p-2 my-1">
                    <div class="input-group mt-1">
                    <textarea class="form-control" rows="3" id="Saran"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6 offset-sm-6">
                    <!-- <button type="button" class="btn btn-primary" id="Kirim"><b>Kirim Survei</b> <div id="LoadingInput" class="spinner-border spinner-border-sm text-white" style="display: none;" role="status"></div></button> -->
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
    $(document).ready(function(){
        
      var BaseURL = '<?=base_url()?>'  

      $('[data-mask]').inputmask()

      $("#Kecamatan").change(function (){
        var Desa = { Kode: $("#Kecamatan").val() }
        $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) {
          $('#Desa').html(Respon)
        })    
      })

      $("#Pekerjaan").change(function (){
        if ($("#Pekerjaan").val() == 'LAINNYA') {
          $("#PekerjaanLainnya").prop('disabled', false);
          $("#PekerjaanLainnya").attr("placeholder", "Sebutkan");
        } else {
          $("#PekerjaanLainnya").prop('disabled', true);
          $("#PekerjaanLainnya").attr("placeholder", "Lainnya");
        }
      })

      $("#Instansi").change(function (){
        if ($("#Instansi").val() == 'LAINNYA') {
          $("#InstansiLainnya").prop('disabled', false);
          $("#InstansiLainnya").attr("placeholder", "Sebutkan");
        } else {
          $("#InstansiLainnya").prop('disabled', true);
          $("#InstansiLainnya").attr("placeholder", "Lainnya");
        }
      })

      $("#Layanan").change(function (){
        if ($("#Layanan").val() == 'LAINNYA') {
          $("#LayananLainnya").prop('disabled', false);
          $("#LayananLainnya").attr("placeholder", "Sebutkan");
        } else {
          $("#LayananLainnya").prop('disabled', true);
          $("#LayananLainnya").attr("placeholder", "Lainnya");
        }
      })

      $("#Kirim").click(function() {
        if (isNaN($("#NIK").val()) || $("#NIK").val() === "") {
          alert('Input NIK Belum Benar!')
        } else if ($("#Nama").val() === "") {
          alert('Input Nama Belum Benar!')
        } else if ($("#Pekerjaan").val() == 6 && $("#PekerjaanLainnya").val() === "") {
          alert('Input Pekerjaan Lainnya Belum Benar!')
        } else if ($("#Keperluan").val() === "") {
          alert('Input Keperluan Belum Benar!')
        } else {
          var Cek = false
          var Tanya = 0
          for (let i = 1; i <= 11; i++) {
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
            var Poin = ""
            for (let i = 1; i <= 11; i++) {
              Poin += $("input[name='Input"+i+"']:checked").val()
              if (i < 11) {
                Poin += "|"
              }
            }
            var IKM = { NIK: $("#NIK").val(),
                        Nama: $("#Nama").val(),
                        Gender: $("#Gender").val(),
                        Usia: $("#Usia").val(),
                        Pendidikan: $("#Pendidikan").val(),
                        Kecamatan: $("#Kecamatan").val(),
                        Desa: $("#Desa").val(),
                        Pekerjaan: $("#Pekerjaan").val(),
                        Keperluan: $("#Keperluan").val(),
                        Poin: Poin }
            $("#Kirim").attr("disabled", true);                              
            $("#LoadingInput").show();
            $.post(BaseURL+"IDE/InputIKM", IKM).done(function(Respon) {
              if (Respon == '1') {
                alert('Terima Kasih')
                window.location = BaseURL + "IDE/SurveiIKM"
              } else {
                alert(Respon)
                $("#LoadingInput").hide();
                $("#Kirim").attr("disabled", false);   
              }
            })
          } 
        }
      })
    })
  </script>
</html>