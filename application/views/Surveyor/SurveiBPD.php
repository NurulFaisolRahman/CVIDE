    	<div class="left-content">
				<div class="mother-grid-inner">
					<div class="ml-2">
						<div class="blank">
							<div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card mt-2">
                      <div class="card-header bg-primary text-light">
                        <b>SURVEI EVALUASI KINERJA BADAN PERMUSYAWARATAN DESA</b>
                      </div>
                      <div style="background-color: yellow;" class="card-body border border-primary">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-sm-4 my-1">
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
                            <div class="col-sm-4 my-1">
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
                            <div class="col-sm-4 my-1">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-light"><b>Jumlah Dusun</b></label>
                                </div>
                                <input class="form-control" type="text" id="Dusun" placeholder="0">
                              </div>
                            </div> 
                            <?php 
                              $Tanya =  array('Berapa kali melakukan penggalian aspirasi dalam 1 tahun?',
                                              'Berapa persentase aspirasi masyarakat miskin yang tergali?',
                                              'Berapa persentase aspirasi masyarakat berkebutuhan khusus yang tergali?',
                                              'Berapa persentase aspirasi perempuan & kelompok marginal yang tergali?',
                                              'Berapa persentase agenda kerja yang terealisasi?',
                                              'Apakah ada buku panduan BPD? (Sistematika => maksud, tujuan, sasaran waktu dan uraian kegiatan)',
                                              'Berapa persentase aspirasi yang disampaikan?',
                                              'Berapa persentase aspirasi yang disalurkan?',
                                              'Berapa kali musyawarah yang sudah dilakukan dalam satu tahun?',
                                              'Apakah ada dokumen?<br>1. Rancangan peraturan desa<br>2. Evaluasi penyelenggaraan pemdes<br>3. Tata tertib BPD<br>4. Dokumentasi musdes',
                                              'Apakah ada dokumen?<br>1. Pembentukan panitia kepala desa<br>2. Laporan kegiatan musyawarah desa<br>3. Laporan Rancangan Peraturan Desa yang Disepakati<br>4. Laporan Kegiatan Pengawasan Pemerintah Desa<br>5. Laporan evaluasi berdasarkan prinsip demokratis, responsif, transparansi, akuntabilitas dan objektif<br>6. Laporan evaluasi pelaksanaan RPJM Desa, RKP Desa dan APB Desa<br>7. Laporan forum komunikasi antar kelembagaan desa atau FKAKD',
                                              'Apakah penyelenggaraan kegiatan pemilihan kepala desa sudah tepat waktu berdasarkan kalender kegiatan BPD Sesuai UU No. 6 Tahun 2014?',
                                              'Berapa kali monitoring dan pengawasan terhadap kegiatan Pemerintah Desa sesuai dengan bidangnya masing-masing yang telah dilakukan dalam satu tahun?',
                                              'Apakah ada laporan buku administrasi desa?<br>&nbsp;&nbsp;1. Buku agenda surat keluar/masuk BPD<br>&nbsp;&nbsp;2. Buku ekspedisi dan data inventaris BPD<br>&nbsp;&nbsp;3. Buku laporan keuangan BPD<br>&nbsp;&nbsp;4. Buku data anggota BPD dan tamu BPD<br>&nbsp;&nbsp;5. Buku data kegiatan BPD<br>&nbsp;&nbsp;6. Buku data aspirasi masyarakat<br>&nbsp;&nbsp;7. Buku daftar hadir dan notulen rapat BPD<br>&nbsp;&nbsp;8. Buku data peraturan/ keputusan BPD<br>&nbsp;&nbsp;9. Buku data peraturan desa<br>10. Buku keputusan musyawarah desa / perencanaan pembangunan desa.'); 
                              $Opsi = array('12 Kali|11 Kali|10 Kali|< 10 Kali',
                                            'Jumlah Aspirasi Masyarakat Miskin|Jumlah Masyarakat Miskin',
                                            'Jumlah Aspirasi Masyarakat Berkebutuhan Khusus|Jumlah Masyarakat Berkebutuhan Khusus',
                                            'Jumlah Aspirasi Perempuan & Kelompok Marginal|Jumlah Perempuan & Kelompok Marginal',
                                            'Jumlah agenda terealisasi Dalam 1 Tahun|Jumlah agenda Dalam 1 Tahun',
                                            'Tidak Ada Buku Panduan|Memuat 1 atau 2 Poin Sistematika|Memuat 3 Poin Sistematika|Memuat 4 Poin Sistematika',
                                            'Jumlah Aspirasi Yang Disampaikan',
                                            'Jumlah Aspirasi Yang Disalurkan',
                                            '12 Kali|11 Kali|10 Kali|< 10 Kali',
                                            '4 Dokumen|3 Dokumen|2 DOkumen|1 Dokumen',
                                            '7 Dokumen|5-6 Dokumen|3-4 Dokumen|1-2 Dokumen',
                                            'sesuai kalender kegiatan BPD|mundur 1-2 bulan kegiatan BPD|mundur 3-4 bulan kegiatan BPD|mundur > 5 bulan kegiatan BPD',
                                            '12 Kali|11 Kali|10 Kali|< 10 Kali',
                                            'ada 10 laporan buku administrasi desa|ada 7-9 laporan buku administrasi desa|ada 4-6 laporan buku administrasi desa|ada 1-3 laporan buku administrasi desa');                              
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
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
  </body>
  <script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
	<script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
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
		var toggle = true;			
		$(".sidebar-icon").click(function() {                
			if (toggle){
				$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
				$("#menu span").css({"position":"absolute"});
			}
			else{
				$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
				setTimeout(function() {
					$("#menu span").css({"position":"relative"});
				}, 400);
			}
			toggle = !toggle;
		});
	</script>
</html>