				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>

            <!-- Modern Survey Header Banner -->
            <div class="dash-survey-header mb-4">
              <div class="row align-items-center">
                <div class="col-md-8">
                  <div class="dash-header-title">
                    <i class="fa fa-shop mr-2 text-warning"></i> Survei BPNT - Persepsi E-Warung
                  </div>
                  <div class="dash-header-subtitle">
                    Instrumen Pemantauan Penyaluran BPNT melalui E-Warung / Agen Penyalur Bantuan Pangan
                  </div>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                  <span class="badge badge-light px-3 py-2 font-weight-normal shadow-sm" style="font-size: 13px; border-radius: 8px;">
                    <i class="fa fa-store text-primary mr-1"></i> Responden E-Warung
                  </span>
                </div>
              </div>
            </div>

            <!-- Data Responden Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-id-card text-primary mr-2"></i> Data Responden E-Warung
                </div>
                <span class="badge badge-pill badge-primary px-3 py-1 font-weight-normal">Identitas Pemilik / Pengelola</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">
                  <div class="col-md-4 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Nama Lengkap</label>
                    <input class="form-control" type="text" id="Nama" placeholder="Nama Lengkap Responden">
                  </div>
                  <div class="col-md-2 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Usia (Tahun)</label>
                    <input class="form-control" type="text" id="Usia" placeholder="Usia">
                  </div>
                  <div class="col-md-3 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Jenis Kelamin</label>
                    <select class="custom-select" id="Gender">
                      <option value="1">Laki-Laki</option>
                      <option value="2">Perempuan</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Nomor Telepon / HP</label>
                    <input class="form-control" type="text" id="Telpon" placeholder="Nomor Telepon">
                  </div>
                  <div class="col-12 mb-2">
                    <label class="font-weight-bold text-muted small mb-1">Alamat Lengkap E-Warung</label>
                    <input class="form-control" type="text" id="Alamat" placeholder="Alamat Lokasi E-Warung">
                  </div>
                </div>
              </div>
            </div>

            <!-- Profil E-Warung Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-store-alt text-primary mr-2"></i> Profil & Operasional E-Warung
                </div>
                <span class="badge badge-pill badge-info px-3 py-1 font-weight-normal">Informasi Usaha</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">

                  <!-- Status Responden -->
                  <div class="col-md-6 col-12 mb-3">
                    <div class="question-box h-100" id="qBox_Status">
                      <div class="q-header">
                        <span class="q-number-pill">Profil #1</span>
                        <div class="q-text">Status Responden dalam Usaha</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Status">
                          <option value="1">Pemilik usaha</option>
                          <option value="2">Pasangan pemilik usaha</option>
                          <option value="3">Pengelola usaha</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Nama E-Warung -->
                  <div class="col-md-6 col-12 mb-3">
                    <div class="question-box h-100" id="qBox_NamaWarung">
                      <div class="q-header">
                        <span class="q-number-pill">Profil #2</span>
                        <div class="q-text">Nama Resmi E-Warung</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="NamaWarung" placeholder="Masukkan nama E-Warung">
                      </div>
                    </div>
                  </div>

                  <!-- Jenis E-Warung -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Jenis">
                      <div class="q-header">
                        <span class="q-number-pill">Profil #3</span>
                        <div class="q-text">Jenis E-Warung</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-6 mb-2 mb-md-0">
                            <select class="custom-select" id="Jenis">
                              <option value="1">E-Warong KUBE PKH</option>
                              <option value="2">Toko/warung kelontong</option>
                              <option value="3">Rumah Pangan Kita (RPK)</option>
                              <option value="4">Kantor kelurahan/kecamatan</option>
                              <option value="5">Rumah warga</option>
                              <option value="6">Lainnya</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" id="JenisLainnya" placeholder="Sebutkan jika lainnya">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Waktu Pendirian -->
                  <div class="col-md-4 col-12 mb-3">
                    <div class="question-box h-100" id="qBox_Waktu">
                      <div class="q-header">
                        <span class="q-number-pill">Profil #4</span>
                        <div class="q-text">Waktu Pendirian (Bulan-Tahun)</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="Waktu" value="00-0000" placeholder="MM-YYYY">
                      </div>
                    </div>
                  </div>

                  <!-- Kepemilikan Mesin EDC -->
                  <div class="col-md-4 col-12 mb-3">
                    <div class="question-box h-100" id="qBox_EDC">
                      <div class="q-header">
                        <span class="q-number-pill">Profil #5</span>
                        <div class="q-text">Kepemilikan Mesin EDC</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="EDC">
                          <option value="1">Ya (Memiliki Mesin EDC)</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Rata-rata KPM -->
                  <div class="col-md-4 col-12 mb-3">
                    <div class="question-box h-100" id="qBox_Belanja">
                      <div class="q-header">
                        <span class="q-number-pill">Profil #6</span>
                        <div class="q-text">Rata-rata KPM Belanja / Bulan</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="Belanja" placeholder="Jumlah KPM (Angka)">
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <!-- Komoditas Bahan Pangan Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-boxes-stacked text-primary mr-2"></i> Ketersediaan & Pasokan Bahan Pangan
                </div>
                <span class="badge badge-pill badge-primary px-3 py-1 font-weight-normal">10 Jenis Komoditas</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">

                  <?php 
                    $Komoditas = array(
                      'Beras',
                      'Sagu',
                      'Jagung',
                      'Telur',
                      'Ikan',
                      'Daging Ayam',
                      'Daging Sapi',
                      'Kacang-kacangan',
                      'Sayur',
                      'Buah'
                    ); 
                  ?>

                  <?php for ($i=0; $i < count($Komoditas); $i++) { ?>
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Komoditas<?=$i?>">
                      <div class="q-header">
                        <span class="q-number-pill">Komoditas #<?=($i+1)?></span>
                        <div class="q-text"><?=$Komoditas[$i]?></div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-3 col-sm-6 mb-2">
                            <label class="small font-weight-bold text-muted mb-1">Menjual Bahan Ini?</label>
                            <select class="custom-select custom-select-sm" id="<?='Jual'.$i?>">                    
                              <option value="0">- Pilih -</option>
                              <option value="1">Ya</option>
                              <option value="2">Tidak</option>
                            </select>
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <label class="small font-weight-bold text-muted mb-1">Asal Pasokan Utama</label>
                            <select class="custom-select custom-select-sm" id="<?='Pasokan'.$i?>">                    
                              <option value="0">- Pilih -</option>
                              <option value="1">Pasar</option>
                              <option value="2">Perum Bulog</option>
                              <option value="3">Penggilingan</option>
                              <option value="4">Peternak</option>
                              <option value="5">Agen/grosir</option>
                              <option value="6">Lainnya</option>
                            </select>
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <label class="small font-weight-bold text-muted mb-1">Ketersediaan Stok Mencukupi?</label>
                            <select class="custom-select custom-select-sm" id="<?='Stok'.$i?>">                    
                              <option value="0">- Pilih -</option>
                              <option value="1">Ya</option>
                              <option value="2">Tidak</option>
                            </select>
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <label class="small font-weight-bold text-muted mb-1">Penyebab Defisit (Jika Tidak Cukup)</label>
                            <select class="custom-select custom-select-sm" id="<?='Defisit'.$i?>">   
                              <option value="0">- Pilih -</option>                 
                              <option value="1">Pasokan Tidak sesuai pesanan</option>
                              <option value="2">Pemasok kehabisan stok</option>
                              <option value="3">Harga tinggi/modal tidak cukup</option>
                              <option value="4">Bahan pangan sangat diminati KPM</option>
                              <option value="5">Lainnya</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                </div>
              </div>
            </div>

            <!-- Dimensi Kepuasan & Kinerja Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-chart-line text-primary mr-2"></i> Evaluasi Kinerja (Performance) & Kepentingan (Importance)
                </div>
                <span class="badge badge-pill badge-success px-3 py-1 font-weight-normal">11 Aspek Layanan</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">

                  <?php 
                    $Dimensi = array(
                      'Jenis barang yang banyak dibeli KPM adalah premium',
                      'Kualitas bahan pangan untuk BPNT selalu bagus',
                      'Harga bahan pangan dari pemasok ke e-warong lebih murah dibandingkan harga eceran di pasaran',
                      'Jumlah bahan pangan di e-warong mencukupi seluruh KPM yang dilayani',
                      'E-warong menyediakan pilihan paket bahan pangan untuk BPNT',
                      'Besaran nilai manfaat BPNT dapat membantu KPM memenuhi kebutuhan pokok',
                      'E-warong menyediakan alternatif bahan pangan lain untuk bantuan sosial pangan',
                      'Pemasok selalu mengirimkan bahan pangan ke e-warong tepat waktu',
                      'Bulog sebagai salah satu pemasok beras dan/atau telur ke e-warong tepat waktu',
                      'Kondisi jaringan internet di e-warong berjalan baik',
                      'Kondisi mesin EDC tersedia dan bekerja dengan baik'
                    ); 
                  ?>

                  <?php for ($i=0; $i < count($Dimensi); $i++) { ?>
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Dimensi<?=$i?>">
                      <div class="q-header">
                        <span class="q-number-pill">Aspek #<?=($i+1)?></span>
                        <div class="q-text"><?=$Dimensi[$i]?></div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-6 mb-2 mb-md-0">
                            <label class="small font-weight-bold text-muted mb-1">Tingkat Kinerja (Performance)</label>
                            <select class="custom-select" id="<?='Performance'.$i?>">                    
                              <option value="1">1 - Sangat Tidak Setuju (STS)</option>
                              <option value="2">2 - Tidak Setuju (TS)</option>
                              <option value="3">3 - Ragu-ragu (R)</option>
                              <option value="4">4 - Setuju (S)</option>
                              <option value="5">5 - Sangat Setuju (SS)</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label class="small font-weight-bold text-muted mb-1">Tingkat Kepentingan (Importance)</label>
                            <select class="custom-select" id="<?='Importance'.$i?>">                    
                              <option value="1">1 - Sangat Tidak Penting (STP)</option>
                              <option value="2">2 - Tidak Penting (TP)</option>
                              <option value="3">3 - Ragu-ragu (R)</option>
                              <option value="4">4 - Penting (P)</option>
                              <option value="5">5 - Sangat Penting (SP)</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <!-- Tombol Simpan -->
                  <div class="col-12 text-center py-4">
                    <button type="button" class="btn btn-primary btn-lg px-5 shadow font-weight-bold" id="Simpan" style="border-radius: 8px;">
                      <i class="fa fa-save mr-2"></i> Simpan Survei
                    </button>
                    <div id="LoadingInput" class="spinner-border text-primary ml-2 align-middle" role="status" style="display: none;"></div>
                  </div>

                </div>
              </div>
            </div>

          </div> 
        </div>
        <!-- /page content -->
      </div>
    </div>

    <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
    <script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
    <script src="<?=base_url('assets/inputmask/min/jquery.inputmask.bundle.min.js')?>"></script>
		<script src="<?=base_url("build/js/custom.min.js")?>"></script>
		<script>
			$(document).ready(function(){
        var BaseURL = '<?=base_url()?>'  
        $("#Simpan").click(function() {
          var Poin = []
          Poin.push($("#Status").val())
          Poin.push($("#NamaWarung").val())
          $("#Jenis").val() == '6' ? Poin.push($("#JenisLainnya").val()) : Poin.push($("#Jenis").val())
          Poin.push($("#Waktu").val())
          Poin.push($("#EDC").val())
          Poin.push($("#Belanja").val())
          var Pangan = []
          for (let i = 0; i < 10; i++) {
            Pangan.push($("#Jual"+i).val()+'#'+$("#Pasokan"+i).val()+'#'+$("#Stok"+i).val()+'#'+$("#Defisit"+i).val())
          }
          Poin.push(Pangan.join("$"))
          var Dimensi = []
          for (let i = 0; i < 11; i++) {
            Dimensi.push($("#Performance"+i).val()+'#'+$("#Importance"+i).val())
          }
          Poin.push(Dimensi.join("$"))
          var Nilai = Poin.join("|")
          var BPNT = { Nama: $("#Nama").val(),
                      Usia: $("#Usia").val(),
                      Gender: $("#Gender").val(),
                      Alamat: $("#Alamat").val(),
                      Telpon: $("#Telpon").val(),
                      Nilai: Nilai }                  
          var Konfirmasi = confirm("Klik Batal Cek Kembali Data & Pastikan Sudah Benar Sebelum Menyimpan! Ok Untuk Simpan!"); 
      		if (Konfirmasi == true) {                                            
            $("#Simpan").attr("disabled", true);                              
            $("#LoadingInput").show();
            $.post(BaseURL+"Surveyor/InputEWarung", BPNT).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/EWarung"
              } else { 
                alert(Respon)
                $("#LoadingInput").hide();
                $("#Simpan").attr("disabled", false);                              
              }
            })
          }
        })
        
      })
		</script>
  </body>
</html>