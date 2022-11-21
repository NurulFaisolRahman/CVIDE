				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="card"> 
                    <div class="card-header bg-primary text-white">
                      <b>PERSEPSI BANK PENYALUR</b>
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
                            $Tanya =  array('Membuka pendaftaran calon e-warong sesuai dengan kriteria dan persyaratan yang ditentukan oleh Kementrian Sosial',
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
                                            'Menyediakan mesin electronic data capture atau sejenisnya sebagai alat transaksi Program BPNT di setiap e-warong dan memastikan keberfungsian mesin electronic data capture atau sejenisnya secara berkala',
                                            'Menyediakan kertas cetak resi atau foto transaksi di aplikasi berbasis telepon genggam atau telepon pintar sebagai bukti transaksi Program BPNT',
                                            'Melakukan rekonsiliasi penyaluran Program BPNT dengan Dinas Sosial',
                                            'Membuat aplikasi pembelanjaan dan sistem informasi pelaporan permasalahan dalam penyaluran Program BPNT',
                                            'Mengembangkan sistem yang dapat menolak transaksi pembelian barang selain bahan pangan yang telah ditetapkan'
                                          ); 
                          ?>
                          <?php for ($i=0; $i < count($Tanya); $i++) { ?>
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
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>18. Sebagai bank penyalur Program BPNT permasalahan apa yang seringkali terjadi dan menjadi kendala dalam pelaksanaan program BPNT?</b></p>
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
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>19. Berikan saran dan masukan bapak/ibu mengenai progam BPNT di Kabupaten Banyuwangi?</b></p>
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