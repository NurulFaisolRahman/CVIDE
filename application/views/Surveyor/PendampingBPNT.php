				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="card"> 
                    <div class="card-header bg-primary text-white">
                      <b>PERSEPSI PENDAMPING SOSIAL BPNT</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary pl-0 pr-2 py-2">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-4 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Nama</b></label>
                              </div>
                              <input class="form-control" type="text" id="Nama">
                            </div>
                          </div> 
                          <div class="col-sm-4 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Usia</b></label>
                              </div>
                              <input class="form-control" type="text" id="Usia">
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
                          <div class="col-sm-4">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Alamat</b></label>
                              </div>
                              <input class="form-control" type="text" id="Alamat">
                            </div>
                          </div> 
                          <div class="col-sm-4">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Telpon</b></label>
                              </div>
                              <input class="form-control" type="text" id="Telpon">
                            </div>
                          </div> 
                          <?php 
                            $Tanya =  array('Pendamping sosial BPNT berasal dari SDM kesejahteraan sosial',
                                            'Membantu pelaksanaan validasi, verifikasi, regristasi dan mendampingi KPM dalam aktivasi rekening KPM sesuai dengan data yang diterima',
                                            'Mendampingi KPM dalam pembelanjaan dana Program BPNT untuk pertama kali atau mendampingi KPM yang mengalami kesulitan pembelanjaan di e-warong',
                                            'Melengkapi data KPM untuk melakukan penggantian KPM',
                                            'Membuat jadwal distribusi KKS bersama-sama dengan Bank Penyalur dan dinas sosial daerah kabupaten/kota',
                                            'Menyusun laporan penyaluran Program BPNT sesuai dengan wilayah kerjanya',
                                            'Melakukan sosialisasi kepada KPM sesuai dengan wilayah kerjanya',
                                            'Melakukan sosialisasi Program BPNT kepada e-warong',
                                            'Mengumpulkan dan menyampaikan data rekapitulasi transaksi KPM dari e-warong yang paling sedikit memuat nama dan alamat KPM dalam setiap tahap penyaluran kepada koordinator daerah kabupaten/kota Program BPNT dengan tembusan kepada dinas sosial daerah',
                                            'Memantau pelaksanaan tugas e-warong sesuai dengan ketentuan Peraturan Menteri',
                                            'Melakukan pemantauan penyaluran Program BPNT sesuai dengan wilayah kerjanya',
                                            'Melaksanakan tugas lain terkait program penangan fakir miskin yang ditugaskan oleh direktur yang menangani Program BPNT sesuai dengan wilayah kerja selama tidak bertentangan dengan ketentuan peraturan perundang-undangan',
                                            'Bahan pangan yang diterima KPM sudah sesuai jumlah',
                                            'Bahan pangan sudah memenuhi kebutuhan hidup sehari hari KPM',
                                            'Kondisi bahan pangan yang diterima KPM kualitas premium',
                                            'Pendataan penerima BPNT sudah sesuai',
                                            'Distribusi bahan pangan sudah tepat waktu',
                                            'Harga bahan pangan yang ditetapkan sudah sesuai'
                                          ); 
                          ?>
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?="1. ".$Tanya[0]?></b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="SDM">                    
                                  <option value="Tenaga kesejahteraan sosial kecamatan">Tenaga kesejahteraan sosial kecamatan</option>
                                  <option value="Pekerja sosial masyarakat">Pekerja sosial masyarakat</option>
                                  <option value="Pengurus karang taruna">Pengurus karang taruna</option>
                                  <option value="Penyuluh sosial masyarakat">Penyuluh sosial masyarakat</option>
                                  <option value="Potensi dan sumber kesejahteraan sosial lainnya">Potensi dan sumber kesejahteraan sosial lainnya</option>
                                </select>
                              </div>
                            </div> 
                          <?php for ($i=1; $i < count($Tanya); $i++) { ?>
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($i+1).". ".$Tanya[$i]?></b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="<?='Ask'.($i+1)?>" style="width: 15%;">                    
                                  <option value="Ya">Ya</option>
                                  <option value="Tidak">Tidak</option>
                                </select>
                                <input class="form-control form-control-sm" type="text" id="<?='Alasan'.($i+1)?>" placeholder="Alasan" style="width: 85%;">
                              </div>
                            </div> 
                          <?php } ?>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>19. Sebagai pendamping Program BPNT permasalahan apa yang seringkali terjadi dan menjadi kendala dalam penyaluran program BPNT</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group mt-1">
                            <textarea class="form-control" id="Kendala"></textarea>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>20. Berikan saran dan masukan bapak/ibu mengenai progam BPNT di Kabupaten Banyuwangi</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group mt-1">
                            <textarea class="form-control" id="Saran"></textarea>
                            </div>
                          </div> 
                          <div class="col-sm-12 mt-2 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary" id="Simpan"><b>Simpan Survei</b></button>
                            <div id="LoadingInput" class="spinner-border text-success" role="status" style="display: none;"></div>
                          </div> 
                        </div>
                      </div>
                    </div>
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