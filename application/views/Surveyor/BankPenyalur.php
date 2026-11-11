				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>

            <!-- Modern Survey Header Banner -->
            <div class="dash-survey-header mb-4">
              <div class="row align-items-center">
                <div class="col-md-8">
                  <div class="dash-header-title">
                    <i class="fa fa-university mr-2 text-warning"></i> Survei BPNT - Persepsi Bank Penyalur
                  </div>
                  <div class="dash-header-subtitle">
                    Instrumen Evaluasi dan Pengawasan Penyaluran Bantuan Pangan Non Tunai oleh Bank Penyalur
                  </div>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                  <span class="badge badge-light px-3 py-2 font-weight-normal shadow-sm" style="font-size: 13px; border-radius: 8px;">
                    <i class="fa fa-building-columns text-primary mr-1"></i> Bank Penyalur
                  </span>
                </div>
              </div>
            </div>

            <!-- Data Responden Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-id-card text-primary mr-2"></i> Data Responden Bank Penyalur
                </div>
                <span class="badge badge-pill badge-primary px-3 py-1 font-weight-normal">Identitas Petugas</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">
                  <div class="col-md-4 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Nama Lengkap</label>
                    <input class="form-control" type="text" id="Nama" placeholder="Nama Lengkap Petugas">
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
                    <label class="font-weight-bold text-muted small mb-1">Alamat Lengkap / Kantor</label>
                    <input class="form-control" type="text" id="Alamat" placeholder="Alamat Domisili / Kantor Bank">
                  </div>
                </div>
              </div>
            </div>

            <!-- Pertanyaan Survei Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-list-check text-primary mr-2"></i> Kuesioner Evaluasi Bank Penyalur
                </div>
                <span class="badge badge-pill badge-info px-3 py-1 font-weight-normal">Persepsi Bank Penyalur</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">

                  <?php 
                    $Tanya = array(
                      'Membuka pendaftaran calon e-warong sesuai dengan kriteria dan persyaratan yang ditentukan oleh Kementerian Sosial',
                      'Memastikan ketersediaan e-warong dengan jumlah sebaran yang memadai',
                      'Melakukan seleksi terhadap calon e-warong sesuai dengan asal dan kriteria',
                      'Mengevaluasi e-warong yang tidak melaksanakan ketentuan Peraturan Menteri',
                      'Memberikan sanksi administratif kepada e-warong apabila melanggar ketentuan Peraturan Menteri',
                      'Memberikan laporan mengenai jumlah e-warong yang aktif dan nonaktif kepada direktur yang menangani Program BPNT',
                      'Memastikan tidak ada pihak lain diluar e-warong yang dapat melakukan proses pencairan Program BPNT',
                      'Melakukan penerbitan atau pencetakaan KKS sesuai dengan data KPM yang berhasil dibukukan rekening kolektif',
                      'Melakukan sosialisasi dan edukasi secara tatap muka atau virtual mengenai Program BPNT kepada e-warong dan KPM',
                      'Melakukan distribusi KKS kepada KPM',
                      'Mendampingi KPM melakukan aktivasi KKS',
                      'Menyalurkan dana Program BPNT ke rekening atas nama KPM',
                      'Menyediakan mesin electronic data capture (EDC) atau sejenisnya sebagai alat transaksi Program BPNT di setiap e-warong dan memastikan keberfungsian mesin secara berkala',
                      'Menyediakan kertas cetak resi atau foto transaksi di aplikasi berbasis telepon pintar sebagai bukti transaksi Program BPNT',
                      'Melakukan rekonsiliasi penyaluran Program BPNT dengan Dinas Sosial',
                      'Membuat aplikasi pembelanjaan dan sistem informasi pelaporan permasalahan dalam penyaluran Program BPNT',
                      'Mengembangkan sistem yang dapat menolak transaksi pembelian barang selain bahan pangan yang telah ditetapkan'
                    ); 
                  ?>

                  <?php for ($i=0; $i < count($Tanya); $i++) { ?>
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

                  <!-- Pertanyaan 18: Kendala -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Kendala">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #18</span>
                        <div class="q-text">18. Sebagai bank penyalur Program BPNT, permasalahan apa yang seringkali terjadi dan menjadi kendala dalam pelaksanaan program BPNT?</div>
                      </div>
                      <div class="p-3">
                        <textarea class="form-control" id="Kendala" rows="3" placeholder="Tuliskan kendala dan permasalahan yang dihadapi..."></textarea>
                      </div>
                    </div>
                  </div>

                  <!-- Pertanyaan 19: Saran -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Saran">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #19</span>
                        <div class="q-text">19. Berikan saran dan masukan bapak/ibu mengenai program BPNT di Kabupaten Banyuwangi?</div>
                      </div>
                      <div class="p-3">
                        <textarea class="form-control" id="Saran" rows="3" placeholder="Tuliskan saran dan rekomendasi perbaikan..."></textarea>
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
          for (let i = 1; i <= 17; i++) {
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
            $.post(BaseURL+"Surveyor/InputBankPenyalur", BPNT).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/BankPenyalur"
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