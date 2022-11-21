				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="card"> 
                    <div class="card-header bg-primary text-white">
                      <b>PERSEPSI KELUARGA PENERIMA MANFAAT</b>
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
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>1. (SA) Apa Pekerjaan Utama B/I/S saat ini?</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="Pekerjaan" style="width: 60%;">                    
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
                                <input class="form-control form-control-sm" type="text" id="PekerjaanLainnya" placeholder="Sebutkan" style="width: 40%;">
                              </div>
                            </div> 
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>2. Berapa kisaaran pendapatan B/I/S per bulannya?</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="Pendapatan">                    
                                  <option value="1"><= 500000</option>
                                  <option value="2">500001 - 1000000</option>
                                  <option value="3">1000001 - 3000000</option>
                                  <option value="4">> 3000000</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>3. Tingkat Pendidikan</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="Pendidikan">                    
                                  <option value="1">Tidak Sekolah</option>
                                  <option value="2">Tamat SD</option>
                                  <option value="3">Tamat SMP</option>
                                  <option value="4">Tamat SLTA</option>
                                  <option value="5">Tamat Diploma - Sarjana</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>4. Apakah Ibu/Bapak sudah menerima dana bantuan program BPNT bulan lalu?</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="Bantuan" style="width: 20%;">                    
                                  <option value="Ya">Ya</option>
                                  <option value="Tidak">Tidak</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>5. Berapa jumlah dana bantuan program BPNT yang diterima bulan lalu?</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <input class="form-control form-control-sm" type="text" id="Jumlah" placeholder="Input Hanya Boleh Angka">
                              </div>
                            </div> 
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>6. Apa saja jenis bahan pangan yang dibeli Ibu/Bapak dengan dana bantuan program BPNT?</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-white"><b>Beras</b></label>
                                </div>
                                <input class="form-control form-control-sm" type="text" id="Beras" placeholder="Input Hanya Boleh Angka">
                              </div>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-white"><b>Sagu</b></label>
                                </div>
                                <input class="form-control form-control-sm" type="text" id="Sagu" placeholder="Input Hanya Boleh Angka">
                              </div>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-white"><b>Jagung</b></label>
                                </div>
                                <input class="form-control form-control-sm" type="text" id="Jagung" placeholder="Input Hanya Boleh Angka">
                              </div>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-white"><b>Telur</b></label>
                                </div>
                                <input class="form-control form-control-sm" type="text" id="Telur" placeholder="Input Hanya Boleh Angka">
                              </div>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-white"><b>Ikan</b></label>
                                </div>
                                <input class="form-control form-control-sm" type="text" id="Ikan" placeholder="Input Hanya Boleh Angka">
                              </div>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-white"><b>Daging Ayam</b></label>
                                </div>
                                <input class="form-control form-control-sm" type="text" id="Ayam" placeholder="Input Hanya Boleh Angka">
                              </div>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-white"><b>Daging Sapi</b></label>
                                </div>
                                <input class="form-control form-control-sm" type="text" id="Sapi" placeholder="Input Hanya Boleh Angka">
                              </div>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-white"><b>Kacang2an</b></label>
                                </div>
                                <input class="form-control form-control-sm" type="text" id="Kacang" placeholder="Input Hanya Boleh Angka">
                              </div>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-white"><b>Sayur</b></label>
                                </div>
                                <input class="form-control form-control-sm" type="text" id="Sayur" placeholder="Input Hanya Boleh Angka">
                              </div>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-white"><b>Buah</b></label>
                                </div>
                                <input class="form-control form-control-sm" type="text" id="Buah" placeholder="Input Hanya Boleh Angka">
                              </div>
                            </div>
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>7. Apakah Apakah Ibu/Bapak dapat menentukan jenis bahan pangan yang dapat dibeli menggunakan KKS?</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="Jenis" style="width: 20%;">                    
                                  <option value="Ya">Ya</option>
                                  <option value="Tidak">Tidak</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>8. Apakah Ibu/Bapak dapat menentukan jumlah bahan pangan yang dapat dibeli menggunakan KKS?</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="JumlahPangan" style="width: 20%;">                    
                                  <option value="Ya">Ya</option>
                                  <option value="Tidak">Tidak</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>9. Apakah Ibu/Bapak memanfaatkan seluruh dana bantuan program BPNT yang diterima setiap bulan dalam satu kali pembelanjaan di eWarong</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="Memanfaatkan" style="width: 20%;">                    
                                  <option value="Ya">Ya</option>
                                  <option value="Tidak">Tidak</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>10. Mengapa Ibu/Bapak belum menerima dana bantuan program BPNT bulan lalu?</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="BelumTerima">                    
                                  <option value="1">Belum ada transfer dana ke rekening KPM</option>
                                  <option value="2">Kartu KKS hilang</option>
                                  <option value="3">Kartu KKS tidak terbaca di mesin EDC</option>
                                  <option value="4">PIN terblok</option>
                                  <option value="5">Belum ada informasi sudah ada bantuan</option>
                                  <option value="6">Lainnya</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>11. Apakah progam BPNT meningkatkan kondisi pangan keluarga bapak/ibu?</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="Meningkatkan" style="width: 15%;">                    
                                  <option value="Ya">Ya</option>
                                  <option value="Tidak">Tidak</option>
                                </select>
                                <input class="form-control form-control-sm" type="text" id="AlasanMeningkatkan" placeholder="Alasan" style="width: 85%;">
                              </div>
                            </div> 
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>12. Apa yang B/I/S lakukan jika terdapat kelebihan bahan/barang?</b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <input class="form-control form-control-sm" type="text" id="Kelebihan" placeholder="Jelaskan">
                              </div>
                            </div> 
                            <?php 
                            $Tanya =  array('Bahan pangan yang diterima sudah sesuai jumlah',
                                            'Bahan pangan sudah memenuhi kebutuhan hidup sehari hari',
                                            'Kondisi bahan pangan kualitas premium',
                                            'Pendataan penerima BPNT sudah sesuai',
                                            'Distribusi bahan pangan sudah tepat waktu',
                                            'Harga bahan pangan yang ditetapkan sudah sesuai'
                                          ); 
                            ?>
                          <?php for ($i=0; $i < count($Tanya); $i++) { ?>
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($i+13).". ".$Tanya[$i]?></b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <select class="custom-select custom-select-sm" id="<?='Pernyataan'.$i?>" style="width: 20%;">                    
                                  <option value="Ya">Ya</option>
                                  <option value="Tidak">Tidak</option>
                                </select>
                              </div>
                            </div> 
                          <?php } ?>
                          <?php $Tanya =  array('Jumlah rumah tangga yang aktual menerima',
                                            'Jumlah rumah tangga yang seharusnya menerima (terdaftar dalam daftar penerima manfaat pertama)',
                                            'Jumlah beras atau telur yang aktual diterima rumah tangga sasaran (kg/RTSPM/bulan)',
                                            'Jumlah beras atau telur yang seharusnya diterima rumah tangga sasaran (Rp 200.000/bulan) ',
                                            'Jumlah waktu yang aktual diterima KPM',
                                            'Jumlah waktu pemberian bahan pokok yang seharusnya diterima KPM (12 kali dalam setahun)',
                                            'KPM membawa Kartu Keluaraga Sejahtera (KKS) saat pencairan bantuan'
                                          ); 
                            ?>
                          <?php for ($i=0; $i < count($Tanya); $i++) { ?>
                            <div class="col-sm-6 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($i+19).". ".$Tanya[$i]?></b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-6 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <input class="form-control form-control-sm" type="text" id="<?='Sasaran'.$i?>" placeholder="Input Hanya Boleh Angka">
                              </div>
                            </div> 
                          <?php } ?>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Saran & Masukan</b></p>
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