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
                          <div class="col-sm-4 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Pendidikan</b></label>
                              </div>
                              <input class="form-control" type="text" id="Pendidikan">
                            </div>
                          </div>
                          <div class="col-sm-4 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Jabatan</b></label>
                              </div>
                              <input class="form-control" type="text" id="Jabatan">
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
                              <select class="custom-select custom-select-sm" id="JaringanPLN">                    
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
                              <select class="custom-select custom-select-sm" id="PasarDesa">                    
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
                            <?php $NoPasar = array('Pasar Desa Sebelah','Pasar Kecamatan','Toko Sekitar','Warung'); ?>
                            <?php for ($j=0; $j < count($NoPasar); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$NoPasar[$j]?>" name="NoPasar" id="NoPasar<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="NoPasar<?=$j?>"><?=$NoPasar[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="NoPasarLainnya" placeholder="Sebutkan Lainnya">
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
                            <?php $Faskes = array('Poskesdes','Polindes','Praktik Dokter'); ?>
                            <?php for ($j=0; $j < count($Faskes); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$Faskes[$j]?>" name="Faskes" id="Faskes<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="Faskes<?=$j?>"><?=$Faskes[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="FaskesLainnya" placeholder="Sebutkan Lainnya">
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
                            <?php $FasilitasPendidikan = array('PAUD','SD/Sederajat','SMP/Sederajat','SMA/Sederajat','Perguruan Tinggi','Pondok Pesantren'); ?>
                            <?php for ($j=0; $j < count($FasilitasPendidikan); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$FasilitasPendidikan[$j]?>" name="FasilitasPendidikan" id="FasilitasPendidikan<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="FasilitasPendidikan<?=$j?>"><?=$FasilitasPendidikan[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="FasilitasPendidikanLainnya" placeholder="Sebutkan Lainnya">
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
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Kriteria apa yang dipakai untuk mengidentifikasi keluarga yang pantas untuk menerima program pengentasan kemiskinan?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $Kriteria = array('Tidak memiliki tanah','Kualitas tempat tinggal rendah','Tidak ada toilet/toilet bersama','Tidak ada listrik','Menggunakan kayu untuk memasak',
                                                    'Makan kurang dari 2 kali sehari','Tidak mampu membayar pelayanan kesehatan','Kesehatan buruk','Duda/janda','Tidak punya pekerjaan tetap'); ?>
                            <?php for ($j=0; $j < count($Kriteria); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$Kriteria[$j]?>" name="Kriteria" id="Kriteria<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="Kriteria<?=$j?>"><?=$Kriteria[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="KriteriaLainnya" placeholder="Sebutkan Lainnya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika sebuah rumah tangga dirasa pantas menerima program kemiskinan, namun tidak tercantum dalam daftar GAKIN, apakah ada mekanisme bagi rumah tangga tersebut untuk mengajukan permohon?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $Mekanisme = array('Melapor ke kketua RT/RW','Melapor ke desa','Melapor ke kecamatan','Tergantung jenis program','Tidak Ada Mekanisme'); ?>
                            <?php for ($j=0; $j < count($Mekanisme); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$Mekanisme[$j]?>" name="Mekanisme" id="Mekanisme<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="Mekanisme<?=$j?>"><?=$Mekanisme[$j]?></label>
                              </div>
                            <?php } ?>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jenis program penanggulangan kemiskinan apa yang terdapat di desa ini? (boleh lebih dari satu)</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $JenisBPNT = array('KIS','Raskin','Rastra','PKH','BPNT','BLT DD','BLT BBM','Kanggo Riko','Gancang Aron','Rantang Kasih'); ?>
                            <?php for ($j=0; $j < count($JenisBPNT); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$JenisBPNT[$j]?>" name="JenisBPNT" id="JenisBPNT<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="JenisBPNT<?=$j?>"><?=$JenisBPNT[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="JenisBPNTLainnya" placeholder="Sebutkan Lainnya">
                            </div>
                          </div>
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
          Poin.push($("#JaringanPLN").val())
          Poin.push($("#PersentasePLN").val())
          Poin.push($("#DayaPLN").val())
          Poin.push($("#Jaringan").val())
          Poin.push($("#PasarDesa").val())
          var Tampung = []
          $.each($("input[name='NoPasar']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#NoPasarLainnya").val())
          Poin.push(Tampung.join("$"))
          Poin.push($("#JarakPasar").val())
          Poin.push($("#Toko").val())
          Poin.push($("#JumlahToko").val())
          Poin.push($("#ATM").val())
          Poin.push($("#JarakATM").val())
          $("#SumberAir").val() == '3' ? Poin.push($("#SumberAirLainnya").val()) : Poin.push($("#SumberAir").val())
          Poin.push($("#AirLayak").val())
          Poin.push($("#HanyaMandi").val())
          Poin.push($("#MCK").val())
          Poin.push($("#JumlahMCK").val())
          $("#BAB").val() == '2' ? Poin.push($("#BABLainnya").val()) : Poin.push($("#BAB").val())
          Poin.push($("#MCKUmum").val())
          Poin.push($("#JumlahMCKUmum").val())
          Poin.push($("#PersentaseJalanBaik").val())
          Poin.push($("#PersentaseJalanBuruk").val())
          $("#Sampah").val() == '4' ? Poin.push($("#SampahLainnya").val()) : Poin.push($("#Sampah").val())
          var Tampung = []
          $.each($("input[name='Faskes']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#FaskesLainnya").val())
          Poin.push(Tampung.join("$"))
          Poin.push($("#KondisiFaskes").val())
          Poin.push($("#TenagaMedis").val())
          var Tampung = []
          $.each($("input[name='FasilitasPendidikan']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#FasilitasPendidikanLainnya").val())
          Poin.push(Tampung.join("$"))
          Poin.push($("#KondisiPendidikan").val())
          Poin.push($("#JumlahPendidik").val())
          var Tampung = []
          $.each($("input[name='Kriteria']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#KriteriaLainnya").val())
          Poin.push(Tampung.join("$"))
          var Tampung = []
          $.each($("input[name='Mekanisme']:checked"), function(){
            Tampung.push($(this).val())
          })
          Poin.push(Tampung.join("$"))
          var Tampung = []
          $.each($("input[name='JenisBPNT']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#JenisBPNTLainnya").val())
          Poin.push(Tampung.join("$"))
          Poin.push($("#ProgramDesa").val())
          $("#Sustain").val() == '2' ? Poin.push($("#SustainLainnya").val()) : Poin.push($("#Sustain").val())
          Poin.push($("#Dampak").val())
          var Nilai = Poin.join("|")
          var BPNT = { Nama: $("#Nama").val(),
                      Usia: $("#Usia").val(),
                      Gender: $("#Gender").val(),
                      Pendidikan: $("#Pendidikan").val(),
                      Jabatan: $("#Jabatan").val(),
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