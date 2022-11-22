				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="card"> 
                    <div class="card-header bg-primary text-white">
                      <b>PEMERINTAH DESA</b>
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
                                <label class="input-group-text bg-danger text-white"><b>Kecamatan</b></label>
                              </div>
                              <select class="custom-select" id="Kecamatan">  
                                <?php foreach ($Kecamatan as $key) { ?>
                                  <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option> 
                                <?php } ?>                  
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Desa/Kelurahan</b></label>
                              </div>
                              <select class="custom-select" id="Desa">                    
                                <?php foreach ($Desa as $key) { ?>
                                  <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                <?php } ?>                  
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
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah di desa ini tersedia jaringan listrik yang memadahi?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Jaringan">                    
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div> 
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa presentase rumah tangga yang telah teraliri listrik dari PLN</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="PersentasePLN" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div> 
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa kwh listrik yang dipakai oleh rumah tangga miskin yang ada di desa?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="DayaPLN" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div> 
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Bagaimana kondisi jaringan telekomunikasi yang ada di desa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Jaringan">                    
                                <option value="1">Kuat</option>
                                <option value="2">Sedang</option>
                                <option value="3">Lemah</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah di desa ini terdapat pasar desa?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Jaringan">                    
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika tidak terdapat pasar desa, biasanya masyarakat membeli barang dimana?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="NoPasar">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Seberapa jauh jarak yang ditempuh ke tempat tersebut dari sini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="JarakPasar" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah di desa ini tersedia toko kelontong?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Toko">                    
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa banyak toko kelontong yang tersedia?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="JumlahToko" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah di desa ini dekat dengan ATM/Bank?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="ATM">                    
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Seberapa jauh jarak yang ditempuh untuk ke ATM/Bank?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="JarakATM" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berasal dari mana sumber air utama untuk masyarakat desa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="SumberAir" style="width: 50%;">
                                <option value="1">Sumur</option>
                                <option value="2">PDAM</option>
                                <option value="3">Lainnya</option>
                              </select>
                              <input class="form-control" type="text" id="SumberAirLainnya" placeholder="Sebutkan" style="width: 50%;">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah dari sumber air tersebut dapat digunakan masyarakat untuk Masak,Minum,Mencuci</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="AirLayak">                    
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika sumber air tersebut hanya digunakan untuk mandi, alasannya mengapa?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="HanyaMandi" placeholder="Alasannya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah semua masyarakat desa ini memiliki ketersediaan MCK sendiri?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="MCK">                    
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika tidak semuanya, berapakah jumlah masyarakat yang tidak memiliki MCK?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="JumlahMCK" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika tidak, maka biasanya masyarakat buang air besar dimana?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="BAB" style="width: 50%;">
                                <option value="1">Sungai/Kali</option>
                                <option value="2">Lainnya</option>
                              </select>
                              <input class="form-control" type="text" id="BABLainnya" placeholder="Sebutkan" style="width: 50%;">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah di desa ini terdapat MCK umum?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="MCKUmum">                    
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika tersedia MCK umum, berapa jumlah yang ada di desa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="JumlahMCKUmum" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa presentase kondisi jalan yang dalam keadaan baik didesa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="PersentaseJalanBaik" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa presentase kondisi jalan yang dalam keadaan kurang baik/jelek didesa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="PersentaseJalanBuruk" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Bagaimana penduduk desa / kelurahan ini mengelola sampah?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Sampah" style="width: 50%;">
                                <option value="1">Diangkut Petugas</option>
                                <option value="2">Dibakar</option>
                                <option value="3">Dibuang</option>
                                <option value="4">Lainnya</option>
                              </select>
                              <input class="form-control" type="text" id="SampahLainnya" placeholder="Sebutkan" style="width: 50%;">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apa saja fasilitas kesehatan yang ada di desa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Faskes" style="width: 50%;">
                                <option value="1">Poskesdes</option>
                                <option value="2">Polindes</option>
                                <option value="3">Dokter</option>
                                <option value="4">Lainnya</option>
                              </select>
                              <input class="form-control" type="text" id="FaskesLainnya" placeholder="Sebutkan" style="width: 50%;">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Bagaimana kondisi fasilitas kesehatan yang ada di desa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="KondisiFaskes" style="width: 50%;">
                                <option value="1">Sangat Baik</option>
                                <option value="2">Baik</option>
                                <option value="3">Kurang Baik</option>
                                <option value="4">Tidak Baik</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa jumlah tenaga kesehatan yang ada di desa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="TenagaMedis" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apa saja fasilitas pendidikan yang ada di desa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="Faislitas Pendidikan">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Bagaimana kondisi fasilitas pendidikan yang ada di desa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="KondisiPendidikan" style="width: 50%;">
                                <option value="1">Sangat Baik</option>
                                <option value="2">Baik</option>
                                <option value="3">Kurang Baik</option>
                                <option value="4">Tidak Baik</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa jumlah tenaga pendidik yang ada di desa ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="JumlahPendidik" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <!-- <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Kriteria apa yang dipakai untuk mengidentifikasi keluarga yang pantas untuk menerima program pengentasan kemiskinan?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Kriteria" style="width: 50%;">
                                <option value="1">Sangat Baik</option>
                                <option value="2">Baik</option>
                                <option value="3">Kurang Baik</option>
                                <option value="4">Tidak Baik</option>
                              </select>
                            </div>
                          </div> -->
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika sebuah rumah tangga dirasa pantas menerima program kemiskinan, namun tidak tercantum dalam daftar GAKIN, apakah ada mekanisme bagi rumah tangga tersebut untuk mengajukan permohon?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Mekanisme" style="width: 50%;">
                                <option value="1">Melapor ke kketua RT/RW</option>
                                <option value="2">Melapor ke desa</option>
                                <option value="3">Melapor ke kecamatan</option>
                                <option value="4">Tergantung jenis program</option>
                                <option value="5">Tidak Ada Mekanisme</option>
                              </select>
                            </div>
                          </div>
                          <!-- <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jenis program penanggulangan kemiskinan apa yang terdapat di desa ini? (boleh lebih dari satu)</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="JenisBPNT" style="width: 50%;">
                                <option value="1">KIS</option>
                                <option value="2">Raskin</option>
                                <option value="3">Rastra</option>
                                <option value="4">PKH</option>
                                <option value="5">BPNT</option>
                                <option value="6">BLT DD</option>
                                <option value="7">BLT BBM</option>
                                <option value="8">Kanggo riko</option>
                                <option value="9">Gancang Aron</option>
                                <option value="10">Rantang Kasih</option>
                                <option value="11">Lainnya</option>
                              </select>
                            </div>
                          </div> -->
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apa saja program dari desa selama ini untuk peningkatan pemberdayaan masyarakat?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="ProgramDesa">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah program tersebut dilaksanakan secara berkelanjutan?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Sustain" style="width: 50%;">
                                <option value="1">Iya</option>
                                <option value="2">Tidak, Mengapa?</option>
                              </select>
                              <input class="form-control" type="text" id="SustainLainnya" placeholder="Sebutkan" style="width: 50%;">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Bagaimana dampak masyarakat setelah adanya program pemberdayaan tersebut terutama bagi masyarakat miskin?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="Dampak">
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
        
        $("#Kecamatan").change(function (){
          var Desa = { Kode: $("#Kecamatan").val() }
          $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) {
            $('#Desa').html(Respon)
          })    
        }) 
        
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
                      Kecamatan: $("#Kecamatan").val(),
                      Desa: $("#Desa").val(),
                      Alamat: $("#Alamat").val(),
                      Nilai: Nilai }                  
          var Konfirmasi = confirm("Klik Batal Cek Kembali Data & Pastikan Sudah Benar Sebelum Menyimpan! Ok Untuk Simpan!"); 
      		if (Konfirmasi == true) {                                            
            $("#Simpan").attr("disabled", true);                              
            $("#LoadingInput").show();
            $.post(BaseURL+"Surveyor/InputDesaBBM", BPNT).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/DesaBBM"
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