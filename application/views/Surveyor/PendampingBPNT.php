				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>

            <!-- Modern Survey Header Banner -->
            <div class="dash-survey-header mb-4">
              <div class="row align-items-center">
                <div class="col-md-8">
                  <div class="dash-header-title">
                    <i class="fa fa-users-gear mr-2 text-warning"></i> Survei BPNT - Persepsi Pendamping BPNT
                  </div>
                  <div class="dash-header-subtitle">
                    Instrumen Evaluasi Pendamping Sosial Program Bantuan Pangan Non Tunai
                  </div>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                  <span class="badge badge-light px-3 py-2 font-weight-normal shadow-sm" style="font-size: 13px; border-radius: 8px;">
                    <i class="fa fa-user-tie text-primary mr-1"></i> Pendamping Sosial BPNT
                  </span>
                </div>
              </div>
            </div>

            <!-- Data Responden Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-id-card text-primary mr-2"></i> Data Responden Pendamping Sosial
                </div>
                <span class="badge badge-pill badge-primary px-3 py-1 font-weight-normal">Identitas Pendamping</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">
                  <div class="col-md-4 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Nama Lengkap</label>
                    <input class="form-control" type="text" id="Nama" placeholder="Nama Lengkap Pendamping">
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
                    <input class="form-control" type="text" id="Alamat" placeholder="Alamat Domisili Pendamping">
                  </div>
                </div>
              </div>
            </div>

            <!-- Pertanyaan Survei Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-list-check text-primary mr-2"></i> Kuesioner Evaluasi Pendamping BPNT
                </div>
                <span class="badge badge-pill badge-info px-3 py-1 font-weight-normal">Persepsi Pendamping</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">

                  <?php 
                    $Tanya = array(
                      'Pendamping sosial BPNT berasal dari SDM kesejahteraan sosial',
                      'Membantu pelaksanaan validasi, verifikasi, registrasi dan mendampingi KPM dalam aktivasi rekening KPM sesuai dengan data yang diterima',
                      'Mendampingi KPM dalam pembelanjaan dana Program BPNT untuk pertama kali atau mendampingi KPM yang mengalami kesulitan pembelanjaan di e-warong',
                      'Melengkapi data KPM untuk melakukan penggantian KPM',
                      'Membuat jadwal distribusi KKS bersama-sama dengan Bank Penyalur dan dinas sosial daerah kabupaten/kota',
                      'Menyusun laporan penyaluran Program BPNT sesuai dengan wilayah kerjanya',
                      'Melakukan sosialisasi kepada KPM sesuai dengan wilayah kerjanya',
                      'Melakukan sosialisasi Program BPNT kepada e-warong',
                      'Mengumpulkan dan menyampaikan data rekapitulasi transaksi KPM dari e-warong yang paling sedikit memuat nama dan alamat KPM dalam setiap tahap penyaluran kepada koordinator daerah kabupaten/kota Program BPNT dengan tembusan kepada dinas sosial daerah',
                      'Memantau pelaksanaan tugas e-warong sesuai dengan ketentuan Peraturan Menteri',
                      'Melakukan pemantauan penyaluran Program BPNT sesuai dengan wilayah kerjanya',
                      'Melaksanakan tugas lain terkait program penanganan fakir miskin yang ditugaskan oleh direktur yang menangani Program BPNT sesuai dengan wilayah kerja selama tidak bertentangan dengan ketentuan peraturan perundang-undangan',
                      'Bahan pangan yang diterima KPM sudah sesuai jumlah',
                      'Bahan pangan sudah memenuhi kebutuhan hidup sehari-hari KPM',
                      'Kondisi bahan pangan yang diterima KPM kualitas premium',
                      'Pendataan penerima BPNT sudah sesuai',
                      'Distribusi bahan pangan sudah tepat waktu',
                      'Harga bahan pangan yang ditetapkan sudah sesuai'
                    ); 
                  ?>

                  <!-- Pertanyaan 1: Asal SDM -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_SDM">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #1</span>
                        <div class="q-text"><?="1. ".$Tanya[0]?></div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="SDM">
                          <option value="1">Tenaga kesejahteraan sosial kecamatan</option>
                          <option value="2">Pekerja sosial masyarakat</option>
                          <option value="3">Pengurus karang taruna</option>
                          <option value="4">Penyuluh sosial masyarakat</option>
                          <option value="5">Potensi dan sumber kesejahteraan sosial lainnya</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 2 - 18: Tanya Loop -->
                  <?php for ($i=1; $i < count($Tanya); $i++) { ?>
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Ask<?=($i+1)?>">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #<?=($i+1)?></span>
                        <div class="q-text"><?=($i+1).". ".$Tanya[$i]?></div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-3 mb-2 mb-md-0">
                            <select class="custom-select" id="<?='Ask'.($i+1)?>">
                              <option value="Ya">Ya</option>
                              <option value="Tidak">Tidak</option>
                            </select>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" type="text" id="<?='Alasan'.($i+1)?>" placeholder="Jelaskan alasan jika Tidak / keterangan tambahan">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <!-- Pertanyaan 19: Kendala -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Kendala">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #19</span>
                        <div class="q-text">19. Sebagai pendamping Program BPNT permasalahan apa yang seringkali terjadi dan menjadi kendala dalam penyaluran program BPNT?</div>
                      </div>
                      <div class="p-3">
                        <textarea class="form-control" id="Kendala" rows="3" placeholder="Tuliskan kendala dalam penyaluran..."></textarea>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 20: Saran -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Saran">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #20</span>
                        <div class="q-text">20. Berikan saran dan masukan bapak/ibu mengenai program BPNT di Kabupaten Banyuwangi?</div>
                      </div>
                      <div class="p-3">
                        <textarea class="form-control" id="Saran" rows="3" placeholder="Tuliskan saran dan rekomendasi..."></textarea>
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
          Poin.push($("#SDM").val())
          for (let i = 2; i <= 18; i++) {
            $("#Ask"+i).val() == 'Ya' ? Poin.push($("#Ask"+i).val()) : Poin.push($("#Alasan"+i).val())
          }
          var Nilai = Poin.join("|")
          var BPNT = { Nama: $("#Nama").val(),
                      Usia: $("#Usia").val(),
                      Gender: $("#Gender").val(),
                      Alamat: $("#Alamat").val(),
                      Telpon: $("#Telpon").val(), 
                      Kendala: $("#Kendala").val(), 
                      Saran: $("#Saran").val(), 
                      Nilai: Nilai }                  
          var Konfirmasi = confirm("Klik Batal Cek Kembali Data & Pastikan Sudah Benar Sebelum Menyimpan! Ok Untuk Simpan!"); 
      		if (Konfirmasi == true) {                                            
            $("#Simpan").attr("disabled", true);                              
            $("#LoadingInput").show();
            $.post(BaseURL+"Surveyor/InputPendampingBPNT", BPNT).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/PendampingBPNT"
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