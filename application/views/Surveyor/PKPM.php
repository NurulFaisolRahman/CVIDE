				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>

            <!-- Modern Survey Header Banner -->
            <div class="dash-survey-header mb-4">
              <div class="row align-items-center">
                <div class="col-md-8">
                  <div class="dash-header-title">
                    <i class="fa fa-hand-holding-heart mr-2 text-warning"></i> Survei BPNT - Persepsi KPM
                  </div>
                  <div class="dash-header-subtitle">
                    Keluarga Penerima Manfaat Bantuan Pangan Non Tunai • Instrumen Evaluasi Bantuan Pangan
                  </div>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                  <span class="badge badge-light px-3 py-2 font-weight-normal shadow-sm" style="font-size: 13px; border-radius: 8px;">
                    <i class="fa fa-user-circle text-primary mr-1"></i> Responden KPM
                  </span>
                </div>
              </div>
            </div>

            <!-- Data Responden Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-id-card text-primary mr-2"></i> Data Responden KPM
                </div>
                <span class="badge badge-pill badge-primary px-3 py-1 font-weight-normal">Identitas Penerima</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">
                  <div class="col-md-4 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Nama Lengkap</label>
                    <input class="form-control" type="text" id="Nama" placeholder="Nama Lengkap KPM">
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
                    <label class="font-weight-bold text-muted small mb-1">Alamat Lengkap</label>
                    <input class="form-control" type="text" id="Alamat" placeholder="Alamat Domisili KPM">
                  </div>
                </div>
              </div>
            </div>

            <!-- Pertanyaan Survei Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-list-check text-primary mr-2"></i> Kuesioner Evaluasi BPNT
                </div>
                <span class="badge badge-pill badge-info px-3 py-1 font-weight-normal">Persepsi KPM</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">

                  <!-- Pertanyaan 1 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Pekerjaan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #1</span>
                        <div class="q-text">1. (SA) Apa Pekerjaan Utama B/I/S saat ini?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-7 mb-2 mb-md-0">
                            <select class="custom-select" id="Pekerjaan">
                              <option value="1">Pekerjaan Formal</option>
                              <option value="2">Pekerjaan Informal</option>
                              <option value="3">Berwiraswasta/wirausaha/bekerja sendiri</option>
                              <option value="4">Pensiunan</option>
                              <option value="5">Ibu rumah tangga</option>
                              <option value="6">Pelajar/mahasiswa</option>
                              <option value="7">Sedang mencari pekerjaan</option>
                              <option value="8">Tidak bekerja karena sakit</option>
                              <option value="9">Lainnya, sebutkan</option>
                            </select>
                          </div>
                          <div class="col-md-5">
                            <input class="form-control" type="text" id="PekerjaanLainnya" placeholder="Sebutkan jika lainnya">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 2 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Pendapatan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #2</span>
                        <div class="q-text">2. Berapa kisaran pendapatan B/I/S per bulannya?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Pendapatan">
                          <option value="1">&le; Rp 500.000</option>
                          <option value="2">Rp 500.001 - Rp 1.000.000</option>
                          <option value="3">Rp 1.000.001 - Rp 3.000.000</option>
                          <option value="4">&gt; Rp 3.000.000</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 3 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Pendidikan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #3</span>
                        <div class="q-text">3. Tingkat Pendidikan Terakhir</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Pendidikan">
                          <option value="1">Tidak Sekolah</option>
                          <option value="2">Tamat SD</option>
                          <option value="3">Tamat SMP</option>
                          <option value="4">Tamat SLTA</option>
                          <option value="5">Tamat Diploma - Sarjana</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 4 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Bantuan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #4</span>
                        <div class="q-text">4. Apakah Ibu/Bapak sudah menerima dana bantuan program BPNT bulan lalu?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Bantuan" style="max-width: 250px;">
                          <option value="Ya">Ya</option>
                          <option value="Tidak">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 5 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Jumlah">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #5</span>
                        <div class="q-text">5. Berapa jumlah dana bantuan program BPNT yang diterima bulan lalu?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 320px;">
                          <div class="input-group-prepend">
                            <span class="input-group-text font-weight-bold">Rp</span>
                          </div>
                          <input class="form-control" type="text" id="Jumlah" placeholder="Masukkan jumlah dana (angka)">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 6 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Pangan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #6</span>
                        <div class="q-text">6. Apa saja jenis bahan pangan yang dibeli Ibu/Bapak dengan dana bantuan program BPNT? (Input jumlah/nominal angka)</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend"><span class="input-group-text bg-white font-weight-bold" style="min-width: 110px;">Beras</span></div>
                              <input class="form-control" type="text" id="Beras" placeholder="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend"><span class="input-group-text bg-white font-weight-bold" style="min-width: 110px;">Sagu</span></div>
                              <input class="form-control" type="text" id="Sagu" placeholder="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend"><span class="input-group-text bg-white font-weight-bold" style="min-width: 110px;">Jagung</span></div>
                              <input class="form-control" type="text" id="Jagung" placeholder="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend"><span class="input-group-text bg-white font-weight-bold" style="min-width: 110px;">Telur</span></div>
                              <input class="form-control" type="text" id="Telur" placeholder="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend"><span class="input-group-text bg-white font-weight-bold" style="min-width: 110px;">Ikan</span></div>
                              <input class="form-control" type="text" id="Ikan" placeholder="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend"><span class="input-group-text bg-white font-weight-bold" style="min-width: 110px;">Daging Ayam</span></div>
                              <input class="form-control" type="text" id="Ayam" placeholder="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend"><span class="input-group-text bg-white font-weight-bold" style="min-width: 110px;">Daging Sapi</span></div>
                              <input class="form-control" type="text" id="Sapi" placeholder="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend"><span class="input-group-text bg-white font-weight-bold" style="min-width: 110px;">Kacang2an</span></div>
                              <input class="form-control" type="text" id="Kacang" placeholder="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend"><span class="input-group-text bg-white font-weight-bold" style="min-width: 110px;">Sayur</span></div>
                              <input class="form-control" type="text" id="Sayur" placeholder="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend"><span class="input-group-text bg-white font-weight-bold" style="min-width: 110px;">Buah</span></div>
                              <input class="form-control" type="text" id="Buah" placeholder="0">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 7 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Jenis">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #7</span>
                        <div class="q-text">7. Apakah Ibu/Bapak dapat menentukan jenis bahan pangan yang dapat dibeli menggunakan KKS?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Jenis" style="max-width: 250px;">
                          <option value="Ya">Ya</option>
                          <option value="Tidak">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 8 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JumlahPangan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #8</span>
                        <div class="q-text">8. Apakah Ibu/Bapak dapat menentukan jumlah bahan pangan yang dapat dibeli menggunakan KKS?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="JumlahPangan" style="max-width: 250px;">
                          <option value="Ya">Ya</option>
                          <option value="Tidak">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 9 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Memanfaatkan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #9</span>
                        <div class="q-text">9. Apakah Ibu/Bapak memanfaatkan seluruh dana bantuan program BPNT yang diterima setiap bulan dalam satu kali pembelanjaan di eWarong?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Memanfaatkan" style="max-width: 250px;">
                          <option value="Ya">Ya</option>
                          <option value="Tidak">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 10 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_BelumTerima">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #10</span>
                        <div class="q-text">10. Mengapa Ibu/Bapak belum menerima dana bantuan program BPNT bulan lalu?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="BelumTerima">
                          <option value="1">Belum ada transfer dana ke rekening KPM</option>
                          <option value="2">Kartu KKS hilang</option>
                          <option value="3">Kartu KKS tidak terbaca di mesin EDC</option>
                          <option value="4">PIN terblokir</option>
                          <option value="5">Belum ada informasi sudah ada bantuan</option>
                          <option value="6">Lainnya</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 11 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Meningkatkan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #11</span>
                        <div class="q-text">11. Apakah program BPNT meningkatkan kondisi pangan keluarga bapak/ibu?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-3 mb-2 mb-md-0">
                            <select class="custom-select" id="Meningkatkan">
                              <option value="Ya">Ya</option>
                              <option value="Tidak">Tidak</option>
                            </select>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" type="text" id="AlasanMeningkatkan" placeholder="Jelaskan alasannya">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 12 -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Kelebihan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #12</span>
                        <div class="q-text">12. Apa yang B/I/S lakukan jika terdapat kelebihan bahan/barang?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="Kelebihan" placeholder="Jelaskan tindakan yang dilakukan">
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 13 - 18: Pernyataan -->
                  <?php 
                  $TanyaPernyataan = array(
                    'Bahan pangan yang diterima sudah sesuai jumlah',
                    'Bahan pangan sudah memenuhi kebutuhan hidup sehari-hari',
                    'Kondisi bahan pangan kualitas premium',
                    'Pendataan penerima BPNT sudah sesuai',
                    'Distribusi bahan pangan sudah tepat waktu',
                    'Harga bahan pangan yang ditetapkan sudah sesuai'
                  );
                  foreach ($TanyaPernyataan as $idx => $itemTanya) { ?>
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Pernyataan<?=$idx?>">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #<?=($idx + 13)?></span>
                        <div class="q-text"><?=($idx + 13).". ".$itemTanya?></div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="<?='Pernyataan'.$idx?>" style="max-width: 250px;">
                          <option value="Ya">Ya</option>
                          <option value="Tidak">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <!-- Pertanyaan 19 - 25: Sasaran -->
                  <?php 
                  $TanyaSasaran = array(
                    'Jumlah rumah tangga yang aktual menerima',
                    'Jumlah rumah tangga yang seharusnya menerima (terdaftar dalam daftar penerima manfaat pertama)',
                    'Jumlah beras atau telur yang aktual diterima rumah tangga sasaran (kg/RTSPM/bulan)',
                    'Jumlah beras atau telur yang seharusnya diterima rumah tangga sasaran (Rp 200.000/bulan)',
                    'Jumlah waktu yang aktual diterima KPM',
                    'Jumlah waktu pemberian bahan pokok yang seharusnya diterima KPM (12 kali dalam setahun)',
                    'KPM membawa Kartu Keluarga Sejahtera (KKS) saat pencairan bantuan'
                  );
                  foreach ($TanyaSasaran as $idx => $itemTanya) { ?>
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Sasaran<?=$idx?>">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #<?=($idx + 19)?></span>
                        <div class="q-text"><?=($idx + 19).". ".$itemTanya?></div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="<?='Sasaran'.$idx?>" placeholder="Input angka / jumlah">
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <!-- Saran & Masukan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Saran">
                      <div class="q-header">
                        <span class="q-number-pill">Saran & Masukan</span>
                        <div class="q-text">Saran dan Masukan mengenai Program BPNT di Daerah Anda</div>
                      </div>
                      <div class="p-3">
                        <textarea class="form-control" id="Saran" rows="3" placeholder="Tuliskan saran dan masukan Anda di sini..."></textarea>
                      </div>
                    </div>
                  </div>

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
          $("#Pekerjaan").val() == '9' ? Poin.push($("#PekerjaanLainnya").val()) : Poin.push($("#Pekerjaan").val())
          Poin.push($("#Pendapatan").val())
          Poin.push($("#Pendidikan").val())
          Poin.push($("#Bantuan").val())
          Poin.push($("#Jumlah").val())
          var Jenis = []
          Jenis.push($("#Beras").val())
          Jenis.push($("#Sagu").val())
          Jenis.push($("#Jagung").val())
          Jenis.push($("#Telur").val())
          Jenis.push($("#Ikan").val())
          Jenis.push($("#Ayam").val())
          Jenis.push($("#Sapi").val())
          Jenis.push($("#Kacang").val())
          Jenis.push($("#Sayur").val())
          Jenis.push($("#Buah").val())
          Poin.push(Jenis.join("$"))
          Poin.push($("#Jenis").val())
          Poin.push($("#JumlahPangan").val())
          Poin.push($("#Memanfaatkan").val())
          Poin.push($("#BelumTerima").val())
          $("#Meningkatkan").val() == 'Ya' ? Poin.push($("#Meningkatkan").val()) : Poin.push($("#AlasanMeningkatkan").val())
          Poin.push($("#Kelebihan").val())
          Poin.push($("#Pernyataan0").val())
          Poin.push($("#Pernyataan1").val())
          Poin.push($("#Pernyataan2").val())
          Poin.push($("#Pernyataan3").val())
          Poin.push($("#Pernyataan4").val())
          Poin.push($("#Pernyataan5").val())
          Poin.push($("#Sasaran0").val())
          Poin.push($("#Sasaran1").val())
          Poin.push($("#Sasaran2").val())
          Poin.push($("#Sasaran3").val())
          Poin.push($("#Sasaran4").val())
          Poin.push($("#Sasaran5").val())
          Poin.push($("#Sasaran6").val())
          var Nilai = Poin.join("|")
          var BPNT = { Nama: $("#Nama").val(),
                      Usia: $("#Usia").val(),
                      Gender: $("#Gender").val(),
                      Alamat: $("#Alamat").val(),
                      Telpon: $("#Telpon").val(), 
                      Saran: $("#Saran").val(), 
                      Nilai: Nilai }   
          var Konfirmasi = confirm("Klik Batal Cek Kembali Data & Pastikan Sudah Benar Sebelum Menyimpan! Ok Untuk Simpan!"); 
      		if (Konfirmasi == true) {                                            
            $("#Simpan").attr("disabled", true);                              
            $("#LoadingInput").show();
            $.post(BaseURL+"Surveyor/InputPKPM", BPNT).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/PKPM"
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