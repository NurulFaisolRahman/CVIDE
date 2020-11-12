<div class="left-content">
				<div class="mother-grid-inner">
					<div class="ml-2">
						<div class="blank">
							<div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card mt-2">
                      <div class="card-header bg-primary text-light">
                        <b>SURVEI PENGUKURAN KINERJA APARATUR DESA</b>
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
                                <input class="form-control" type="text" id="Dusun" data-inputmask='"mask": "99"' data-mask>
                              </div>
                            </div> 
                            <?php 
                              $Tanya = array('Jam kerja kantor :<br>- Senin – kamis ( 07.00 – 15.30 )<br>- Jumat ( 06.30 – 14.30 )',
                                             'Apakah terdapat buku absensi?',
                                             'Adanya dokumen pemerintah desa?
                                             <br>- menyelenggarakan pemerintahan desa, seperti tata praja pemerintahan, penetapan peraturan di desa, pembinaan masalah pertanahan, pembinaan ketentraman dan ketertiban, melakukan upaya perlindungan masyarakat, administrasi kependudukan, dan penataan dan pengelolaan wilayah
                                             <br>- melaksanakan pembangunan seperti pembangunan sarana prasarana perdesaan, dan pembangunan bidang pendidikan, kesehatan.
                                             <br>- pembinaan kemasyarakatan, seperti pelaksanaan hak dan kewajiban masyarakat, partisipasi masyarakat, sosial budaya masyarakat, keagamaan, dan ketenagakerjaan.
                                             <br>- pemberdayaan masyarakat, seperti tugas sosialisasi dan motivasi masyarakat di bidang budaya, ekonomi, politik, lingkungan hidup, pemberdayaan keluarga, pemuda, olahraga, dan karang taruna.
                                             <br>- menjaga hubungan kemitraan dengan lembaga masyarakat dan lembaga lainnya.',
                                             'Berapa Pendapatan Asli Desa & Berapa Total Penerimaan Yang di Dapat Desa?',
                                             'Jam kerja kantor :<br>- Senin – kamis ( 07.00 – 15.30 )<br>- Jumat ( 06.30 – 14.30 )'); 
                              $Opsi = array('Jika aparatur desa masuk selama 181-200 jam kerja dalam sebulan|Jika aparatur desa masuk selama 141-180 jam kerja dalam sebulan|Jika aparatur desa masuk selama 101-140 jam kerja dalam sebulan|Jika aparatur desa masuk selama < 100 jam kerja dalam sebulan',
                                            'Jika aparatur melakukan finger print sebanyak 4 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 3 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 2 kali  dalam sehari|Jika aparatur melakukan finger print sebanyak 1 kali dalam sehari',
                                            'Jika kepala desa menyelesaikan dan melaksanakan semua 5 dokumen|Jika kepala desa menyelesaikan dan melaksanakan 4 dokumen|Jika kepala desa menyelesaikan dan melaksanakan 3 dokumen|Jika kepala desa menyelesaikan dan melaksanakan < 3 dokumen',
                                            'Pendapatan Asli Desa|Total Penerimaan Desa',
                                            'Jika aparatur desa masuk selama 181-200 jam kerja dalam sebulan|Jika aparatur desa masuk selama 141-180 jam kerja dalam sebulan|Jika aparatur desa masuk selama 101-140 jam kerja dalam sebulan|Jika aparatur desa masuk selama < 100 jam kerja dalam sebulan');                              
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
                                        <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="I<?=$i?>" id="I<?=$i.$j?>" value="<?=(4-$j)?>">
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
  <script src="<?=base_url('assets/inputmask/min/jquery.inputmask.bundle.min.js')?>"></script>
	<script>
    $(document).ready(function(){
        
      var BaseURL = '<?=base_url()?>'  

      $('[data-mask]').inputmask()

      $("#Kecamatan").change(function (){
        var Desa = { Kode: $("#Kecamatan").val() }
        $.post(BaseURL+"IDE/Desa", Desa).done(function(Respon) {
          $('#Desa').html(Respon)
        })    
      })

      $("#Kirim").click(function() {
        if (isNaN(parseInt($("#Dusun").val())) || $("#Dusun").val() === "") {
          alert('Input Jumlah Dusun Hanya Boleh Angka Positif!')
        } 
        else {
          var Cek = false
          var Tanya = 0
          var Radio = [0,5,9,10,11,12,13,14]
          for (let i = 0; i < Radio.length; i++) {
            if ($("input[name='I"+Radio[i]+"']:checked").val() == undefined) {
              Cek = true
              Tanya = Radio[i]+1
              break
            }
          }
          if (Cek) {
            alert('Pertanyaan Nomer '+Tanya+' Wajib Di Isi!')
          } else {
            if (isNaN(parseInt($("#I10").val()))) {
              alert('Input Jumlah Aspirasi Masyarakat Miskin Hanya Boleh 0 Atau Angka Positif!')
            } else if (isNaN(parseInt($("#I11").val()))) {
              alert('Input Jumlah Masyarakat Miskin Hanya Boleh 0 Atau Angka Positif!')
            } else if (isNaN(parseInt($("#I20").val()))) {
              alert('Input Jumlah Aspirasi Masyarakat Berkebutuhan Khusus Hanya Boleh 0 Atau Angka Positif!')
            } else if (isNaN(parseInt($("#I21").val()))) {
              alert('Input Jumlah Masyarakat Berkebutuhan Khusus Hanya Boleh 0 Atau Angka Positif!')
            } else if (isNaN(parseInt($("#I30").val()))) {
              alert('Input Jumlah Aspirasi Perempuan & Kelompok Marginal Hanya Boleh 0 Atau Angka Positif!')
            } else if (isNaN(parseInt($("#I31").val()))) {
              alert('Input Jumlah Perempuan & Kelompok Marginal Hanya Boleh 0 Atau Angka Positif!')
            } else if (isNaN(parseInt($("#I40").val()))) {
              alert('Input Jumlah agenda terealisasi Dalam 1 Tahun Hanya Boleh 0 Atau Angka Positif!')
            } else if (isNaN(parseInt($("#I41").val()))) {
              alert('Input Jumlah agenda Dalam 1 Tahun Hanya Boleh 0 Atau Angka Positif!')
            } else if (isNaN(parseInt($("#I60").val()))) {
              alert('Input Jumlah Aspirasi yang ditampung Hanya Boleh 0 Atau Angka Positif!')
            } else if (isNaN(parseInt($("#I70").val()))) {
              alert('Input Jumlah Aspirasi Yang Disampaikan Hanya Boleh 0 Atau Angka Positif!')
            } else if (isNaN(parseInt($("#I80").val()))) {
              alert('Input Jumlah Aspirasi Yang Disalurkan Hanya Boleh 0 Atau Angka Positif!')
            } else {
              var JumlahAspirasiMasyarakatMiskin = parseInt($("#I10").val())
              var JumlahMasyarakatMiskin = parseInt($("#I11").val())
              var JumlahAspirasiMasyarakatBerkebutuhanKhusus = parseInt($("#I20").val())
              var JumlahMasyarakatBerkebutuhanKhusus = parseInt($("#I21").val())
              var JumlahAspirasiPerempuandanKelompokMarginal = parseInt($("#I30").val())
              var JumlahPerempuandanKelompokMarginal = parseInt($("#I31").val())
              var JumlahagendaterealisasiDalam1Tahun = parseInt($("#I40").val())
              var JumlahagendaDalam1Tahun = parseInt($("#I41").val())
              var JumlahAspirasiyangditampung = parseInt($("#I60").val())
              var JumlahAspirasiYangDisampaikan = parseInt($("#I70").val())
              var JumlahAspirasiYangDisalurkan = parseInt($("#I80").val())
              if (JumlahAspirasiMasyarakatMiskin > JumlahMasyarakatMiskin) {
                alert('Input Jumlah Aspirasi Masyarakat Miskin Harus Lebih Kecil Dari '+(JumlahMasyarakatMiskin+1))
              } else if (JumlahAspirasiMasyarakatBerkebutuhanKhusus > JumlahMasyarakatBerkebutuhanKhusus) {
                alert('Input Jumlah Aspirasi Masyarakat Berkebutuhan Khusus Harus Lebih Kecil Dari '+(JumlahMasyarakatBerkebutuhanKhusus+1))
              } else if (JumlahAspirasiPerempuandanKelompokMarginal > JumlahPerempuandanKelompokMarginal) {
                alert('Input Jumlah Aspirasi Perempuan & Kelompok Marginal Harus Lebih Kecil Dari '+(JumlahPerempuandanKelompokMarginal+1))
              } else if (JumlahagendaterealisasiDalam1Tahun > JumlahagendaDalam1Tahun) {
                alert('Input Jumlah agenda terealisasi Dalam 1 Tahun Harus Lebih Kecil Dari '+(JumlahagendaDalam1Tahun+1))
              } else if (JumlahAspirasiyangditampung > (JumlahAspirasiMasyarakatMiskin+JumlahAspirasiMasyarakatBerkebutuhanKhusus+JumlahAspirasiPerempuandanKelompokMarginal)) {
                alert('Input Jumlah Aspirasi yang Ditampung Harus Lebih Kecil Dari '+(JumlahAspirasiMasyarakatMiskin+JumlahAspirasiMasyarakatBerkebutuhanKhusus+JumlahAspirasiPerempuandanKelompokMarginal+1))
              } else if (JumlahAspirasiYangDisampaikan > JumlahAspirasiyangditampung) {
                alert('Input Jumlah Aspirasi yang Disampaikan Harus Lebih Kecil Dari '+(JumlahAspirasiyangditampung+1))
              } else if (JumlahAspirasiYangDisalurkan > JumlahAspirasiYangDisampaikan) {
                alert('Input Jumlah Aspirasi yang Disalurkan Harus Lebih Kecil Dari '+(JumlahAspirasiYangDisampaikan+1))
              } else {
                var Poin = ""
                Poin += ($("input[name='I0']:checked").val() + '|')
                if (JumlahAspirasiMasyarakatMiskin == 0 && JumlahMasyarakatMiskin == 0 || (JumlahAspirasiMasyarakatMiskin/JumlahMasyarakatMiskin*100) < 40) {
                  Poin += '1|'
                } else if ((JumlahAspirasiMasyarakatMiskin/JumlahMasyarakatMiskin*100) < 56) {
                  Poin += '2|'
                } else if ((JumlahAspirasiMasyarakatMiskin/JumlahMasyarakatMiskin*100) < 76) {
                  Poin += '3|'
                } else {
                  Poin += '4|'
                }
                if (JumlahAspirasiMasyarakatBerkebutuhanKhusus == 0 && JumlahMasyarakatBerkebutuhanKhusus == 0 || (JumlahAspirasiMasyarakatBerkebutuhanKhusus/JumlahMasyarakatBerkebutuhanKhusus*100) < 40) {
                  Poin += '1|'
                } else if ((JumlahAspirasiMasyarakatBerkebutuhanKhusus/JumlahMasyarakatBerkebutuhanKhusus*100) < 56) {
                  Poin += '2|'
                } else if ((JumlahAspirasiMasyarakatBerkebutuhanKhusus/JumlahMasyarakatBerkebutuhanKhusus*100) < 76) {
                  Poin += '3|'
                } else {
                  Poin += '4|'
                }
                if (JumlahAspirasiPerempuandanKelompokMarginal == 0 && JumlahPerempuandanKelompokMarginal == 0 || (JumlahAspirasiPerempuandanKelompokMarginal/JumlahPerempuandanKelompokMarginal*100) < 40) {
                  Poin += '1|'
                } else if ((JumlahAspirasiPerempuandanKelompokMarginal/JumlahPerempuandanKelompokMarginal*100) < 56) {
                  Poin += '2|'
                } else if ((JumlahAspirasiPerempuandanKelompokMarginal/JumlahPerempuandanKelompokMarginal*100) < 76) {
                  Poin += '3|'
                } else {
                  Poin += '4|'
                }
                if (JumlahagendaterealisasiDalam1Tahun == 0 && JumlahagendaDalam1Tahun == 0 || (JumlahagendaterealisasiDalam1Tahun/JumlahagendaDalam1Tahun*100) < 40) {
                  Poin += '1|'
                } else if ((JumlahagendaterealisasiDalam1Tahun/JumlahagendaDalam1Tahun*100) < 56) {
                  Poin += '2|'
                } else if ((JumlahagendaterealisasiDalam1Tahun/JumlahagendaDalam1Tahun*100) < 76) {
                  Poin += '3|'
                } else {
                  Poin += '4|'
                }
                Poin += ($("input[name='I5']:checked").val() + '|')
                if (JumlahAspirasiyangditampung == 0 && (JumlahAspirasiMasyarakatMiskin+JumlahAspirasiMasyarakatBerkebutuhanKhusus+JumlahAspirasiPerempuandanKelompokMarginal) == 0 || (JumlahAspirasiyangditampung/(JumlahAspirasiMasyarakatMiskin+JumlahAspirasiMasyarakatBerkebutuhanKhusus+JumlahAspirasiPerempuandanKelompokMarginal)*100) < 40) {
                  Poin += '1|'
                } else if ((JumlahAspirasiyangditampung/(JumlahAspirasiMasyarakatMiskin+JumlahAspirasiMasyarakatBerkebutuhanKhusus+JumlahAspirasiPerempuandanKelompokMarginal)*100) < 56) {
                  Poin += '2|'
                } else if ((JumlahAspirasiyangditampung/(JumlahAspirasiMasyarakatMiskin+JumlahAspirasiMasyarakatBerkebutuhanKhusus+JumlahAspirasiPerempuandanKelompokMarginal)*100) < 76) {
                  Poin += '3|'
                } else {
                  Poin += '4|'
                }
                if (JumlahAspirasiYangDisampaikan == 0 && JumlahAspirasiyangditampung == 0 || (JumlahAspirasiYangDisampaikan/JumlahAspirasiyangditampung*100) < 40) {
                  Poin += '1|'
                } else if ((JumlahAspirasiYangDisampaikan/JumlahAspirasiyangditampung*100) < 56) {
                  Poin += '2|'
                } else if ((JumlahAspirasiYangDisampaikan/JumlahAspirasiyangditampung*100) < 76) {
                  Poin += '3|'
                } else {
                  Poin += '4|'
                }
                if (JumlahAspirasiYangDisalurkan == 0 && JumlahAspirasiYangDisampaikan == 0 || (JumlahAspirasiYangDisalurkan/JumlahAspirasiYangDisampaikan*100) < 40) {
                  Poin += '1|'
                } else if ((JumlahAspirasiYangDisampaikan/JumlahAspirasiyangditampung*100) < 56) {
                  Poin += '2|'
                } else if ((JumlahAspirasiYangDisampaikan/JumlahAspirasiyangditampung*100) < 76) {
                  Poin += '3|'
                } else {
                  Poin += '4|'
                }
                Poin += ($("input[name='I9']:checked").val() + '|')
                Poin += ($("input[name='I10']:checked").val() + '|')
                Poin += ($("input[name='I11']:checked").val() + '|')
                Poin += ($("input[name='I12']:checked").val() + '|')
                Poin += ($("input[name='I13']:checked").val() + '|')
                Poin += ($("input[name='I14']:checked").val())
                var IKM = { Kecamatan: $("#Kecamatan").val(),
                            Desa: $("#Desa").val(),
                            JumlahDusun: parseInt($("#Dusun").val()),
                            Poin: Poin }
                $.post(BaseURL+"Surveyor/InputBPD", IKM).done(function(Respon) {
                  if (Respon == '1') {
                    alert('Survei Berhasil Di Simpan!')
                    window.location = BaseURL + "Surveyor/SurveiBPD"
                  } else { 
                    alert(Respon)
                  }
                })
              }
            }
          }
        }
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