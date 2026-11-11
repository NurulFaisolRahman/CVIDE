				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>

            <!-- Modern Survey Header Banner -->
            <div class="dash-survey-header mb-4">
              <div class="row align-items-center">
                <div class="col-md-8">
                  <div class="dash-header-title">
                    <i class="fa fa-gas-pump mr-2 text-warning"></i> Survei BBM - Pemerintah Desa
                  </div>
                  <div class="dash-header-subtitle">
                    Instrumen Pemantauan Kondisi Sosial Ekonomi & Dampak Penyesuaian Harga BBM bagi Desa
                  </div>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                  <span class="badge badge-light px-3 py-2 font-weight-normal shadow-sm" style="font-size: 13px; border-radius: 8px;">
                    <i class="fa fa-landmark text-primary mr-1"></i> Pemerintah Desa
                  </span>
                </div>
              </div>
            </div>

            <!-- Data Responden Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-id-card text-primary mr-2"></i> Data Responden Aparatur Desa
                </div>
                <span class="badge badge-pill badge-primary px-3 py-1 font-weight-normal">Identitas Aparatur</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">
                  <div class="col-md-4 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Nama Lengkap</label>
                    <input class="form-control" type="text" id="Nama" placeholder="Nama Lengkap">
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
                    <label class="font-weight-bold text-muted small mb-1">Pendidikan Terakhir</label>
                    <input class="form-control" type="text" id="Pendidikan" placeholder="Pendidikan Terakhir">
                  </div>
                  <div class="col-md-4 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Jabatan di Desa</label>
                    <input class="form-control" type="text" id="Jabatan" placeholder="Jabatan">
                  </div>
                  <div class="col-md-4 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Kecamatan</label>
                    <select class="custom-select" id="Kecamatan">  
                      <?php foreach ($Kecamatan as $key) { ?>
                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option> 
                      <?php } ?>                  
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-3">
                    <label class="font-weight-bold text-muted small mb-1">Desa / Kelurahan</label>
                    <select class="custom-select" id="Desa">                    
                      <?php foreach ($Desa as $key) { ?>
                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                      <?php } ?>                  
                    </select>
                  </div>
                  <div class="col-12 mb-2">
                    <label class="font-weight-bold text-muted small mb-1">Alamat Kantor / Domisili</label>
                    <input class="form-control" type="text" id="Alamat" placeholder="Alamat Lengkap">
                  </div>
                </div>
              </div>
            </div>

            <!-- Pertanyaan Survei Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-list-check text-primary mr-2"></i> Kuesioner Survei Dampak BBM (Pemerintah Desa)
                </div>
                <span class="badge badge-pill badge-info px-3 py-1 font-weight-normal">34 Butir Instrumen</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">

                  <!-- 1. Jaringan PLN -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JaringanPLN">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #1</span>
                        <div class="q-text">1. Apakah di desa ini tersedia jaringan listrik yang memadai?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="JaringanPLN" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 2. Persentase PLN -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_PersentasePLN">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #2</span>
                        <div class="q-text">2. Berapa persentase rumah tangga yang telah teraliri listrik dari PLN?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 250px;">
                          <input class="form-control" type="text" id="PersentasePLN" placeholder="Angka persentase">
                          <div class="input-group-append"><span class="input-group-text font-weight-bold">%</span></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 3. Daya PLN -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_DayaPLN">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #3</span>
                        <div class="q-text">3. Berapa kwh listrik yang dipakai oleh rumah tangga miskin yang ada di desa?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 250px;">
                          <input class="form-control" type="text" id="DayaPLN" placeholder="Input angka kwh">
                          <div class="input-group-append"><span class="input-group-text font-weight-bold">kWh</span></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 4. Jaringan Telekomunikasi -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Jaringan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #4</span>
                        <div class="q-text">4. Bagaimana kondisi jaringan telekomunikasi yang ada di desa ini?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Jaringan" style="max-width: 250px;">
                          <option value="1">Kuat</option>
                          <option value="2">Sedang</option>
                          <option value="3">Lemah</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 5. Pasar Desa -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_PasarDesa">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #5</span>
                        <div class="q-text">5. Apakah di desa ini terdapat pasar desa?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="PasarDesa" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 6. Lokasi Beli Jika Tidak Ada Pasar -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_NoPasar">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #6</span>
                        <div class="q-text">6. Jika tidak terdapat pasar desa, biasanya masyarakat membeli barang di mana? (Boleh pilih lebih dari satu)</div>
                      </div>
                      <div class="p-3">
                        <?php $NoPasar = array('Pasar Desa Sebelah','Pasar Kecamatan','Toko Sekitar','Warung'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($NoPasar); $j++) { ?>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$NoPasar[$j]?>" name="NoPasar" id="NoPasar<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="NoPasar<?=$j?>"><?=$NoPasar[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="NoPasarLainnya" placeholder="Sebutkan tempat lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 7. Jarak Pasar -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JarakPasar">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #7</span>
                        <div class="q-text">7. Seberapa jauh jarak yang ditempuh ke tempat tersebut dari sini?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 250px;">
                          <input class="form-control" type="text" id="JarakPasar" placeholder="Input angka jarak">
                          <div class="input-group-append"><span class="input-group-text font-weight-bold">Km</span></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 8. Toko Kelontong -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Toko">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #8</span>
                        <div class="q-text">8. Apakah di desa ini tersedia toko kelontong?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Toko" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 9. Jumlah Toko -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JumlahToko">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #9</span>
                        <div class="q-text">9. Berapa banyak toko kelontong yang tersedia?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="JumlahToko" placeholder="Input jumlah toko (angka)" style="max-width: 250px;">
                      </div>
                    </div>
                  </div>

                  <!-- 10. ATM / Bank -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_ATM">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #10</span>
                        <div class="q-text">10. Apakah di desa ini dekat dengan ATM/Bank?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="ATM" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 11. Jarak ATM -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JarakATM">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #11</span>
                        <div class="q-text">11. Seberapa jauh jarak yang ditempuh untuk ke ATM/Bank?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 250px;">
                          <input class="form-control" type="text" id="JarakATM" placeholder="Input angka jarak">
                          <div class="input-group-append"><span class="input-group-text font-weight-bold">Km</span></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 12. Sumber Air -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_SumberAir">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #12</span>
                        <div class="q-text">12. Berasal dari mana sumber air utama untuk masyarakat desa ini?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-6 mb-2 mb-md-0">
                            <select class="custom-select" id="SumberAir">
                              <option value="1">Sumur</option>
                              <option value="2">PDAM</option>
                              <option value="3">Lainnya</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" id="SumberAirLainnya" placeholder="Sebutkan jika lainnya">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 13. Kelayakan Air -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_AirLayak">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #13</span>
                        <div class="q-text">13. Apakah dari sumber air tersebut dapat digunakan masyarakat untuk Masak, Minum, Mencuci?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="AirLayak" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 14. Alasan Mandi Saja -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_HanyaMandi">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #14</span>
                        <div class="q-text">14. Jika sumber air tersebut hanya digunakan untuk mandi, alasannya mengapa?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="HanyaMandi" placeholder="Tuliskan alasannya jika hanya untuk mandi">
                      </div>
                    </div>
                  </div>

                  <!-- 15. MCK Sendiri -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_MCK">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #15</span>
                        <div class="q-text">15. Apakah semua masyarakat desa ini memiliki ketersediaan MCK sendiri?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="MCK" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 16. Jumlah Tidak Ada MCK -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JumlahMCK">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #16</span>
                        <div class="q-text">16. Jika tidak semuanya, berapakah jumlah masyarakat yang tidak memiliki MCK?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="JumlahMCK" placeholder="Input jumlah KK/orang (angka)" style="max-width: 250px;">
                      </div>
                    </div>
                  </div>

                  <!-- 17. Lokasi BAB -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_BAB">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #17</span>
                        <div class="q-text">17. Jika tidak memiliki MCK, biasanya masyarakat buang air besar di mana?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-6 mb-2 mb-md-0">
                            <select class="custom-select" id="BAB">
                              <option value="1">Sungai/Kali</option>
                              <option value="2">Lainnya</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" id="BABLainnya" placeholder="Sebutkan tempat lainnya">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 18. MCK Umum -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_MCKUmum">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #18</span>
                        <div class="q-text">18. Apakah di desa ini terdapat MCK umum?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="MCKUmum" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 19. Jumlah MCK Umum -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JumlahMCKUmum">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #19</span>
                        <div class="q-text">19. Jika tersedia MCK umum, berapa jumlah unit yang ada di desa ini?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="JumlahMCKUmum" placeholder="Input jumlah unit (angka)" style="max-width: 250px;">
                      </div>
                    </div>
                  </div>

                  <!-- 20. Jalan Baik -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_PersentaseJalanBaik">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #20</span>
                        <div class="q-text">20. Berapa persentase kondisi jalan yang dalam keadaan baik di desa ini?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 250px;">
                          <input class="form-control" type="text" id="PersentaseJalanBaik" placeholder="Persentase">
                          <div class="input-group-append"><span class="input-group-text font-weight-bold">%</span></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 21. Jalan Jelek -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_PersentaseJalanBuruk">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #21</span>
                        <div class="q-text">21. Berapa persentase kondisi jalan yang dalam keadaan kurang baik/rusak di desa ini?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 250px;">
                          <input class="form-control" type="text" id="PersentaseJalanBuruk" placeholder="Persentase">
                          <div class="input-group-append"><span class="input-group-text font-weight-bold">%</span></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 22. Kelola Sampah -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Sampah">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #22</span>
                        <div class="q-text">22. Bagaimana penduduk desa/kelurahan ini mengelola sampah?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-6 mb-2 mb-md-0">
                            <select class="custom-select" id="Sampah">
                              <option value="1">Diangkut Petugas</option>
                              <option value="2">Dibakar</option>
                              <option value="3">Dibuang</option>
                              <option value="4">Lainnya</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" id="SampahLainnya" placeholder="Sebutkan jika lainnya">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 23. Fasilitas Kesehatan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Faskes">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #23</span>
                        <div class="q-text">23. Apa saja fasilitas kesehatan yang ada di desa ini? (Boleh pilih lebih dari satu)</div>
                      </div>
                      <div class="p-3">
                        <?php $Faskes = array('Poskesdes','Polindes','Praktik Dokter'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($Faskes); $j++) { ?>
                          <div class="col-md-4 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$Faskes[$j]?>" name="Faskes" id="Faskes<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="Faskes<?=$j?>"><?=$Faskes[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="FaskesLainnya" placeholder="Sebutkan fasilitas kesehatan lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 24. Kondisi Faskes -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_KondisiFaskes">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #24</span>
                        <div class="q-text">24. Bagaimana kondisi fasilitas kesehatan yang ada di desa ini?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="KondisiFaskes" style="max-width: 250px;">
                          <option value="1">Sangat Baik</option>
                          <option value="2">Baik</option>
                          <option value="3">Kurang Baik</option>
                          <option value="4">Tidak Baik</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 25. Tenaga Medis -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_TenagaMedis">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #25</span>
                        <div class="q-text">25. Berapa jumlah tenaga kesehatan yang ada di desa ini?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="TenagaMedis" placeholder="Input jumlah orang (angka)" style="max-width: 250px;">
                      </div>
                    </div>
                  </div>

                  <!-- 26. Fasilitas Pendidikan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_FasilitasPendidikan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #26</span>
                        <div class="q-text">26. Apa saja fasilitas pendidikan yang ada di desa ini? (Boleh pilih lebih dari satu)</div>
                      </div>
                      <div class="p-3">
                        <?php $FasilitasPendidikan = array('PAUD','SD/Sederajat','SMP/Sederajat','SMA/Sederajat','Perguruan Tinggi','Pondok Pesantren'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($FasilitasPendidikan); $j++) { ?>
                          <div class="col-md-4 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$FasilitasPendidikan[$j]?>" name="FasilitasPendidikan" id="FasilitasPendidikan<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="FasilitasPendidikan<?=$j?>"><?=$FasilitasPendidikan[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="FasilitasPendidikanLainnya" placeholder="Sebutkan fasilitas pendidikan lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 27. Kondisi Pendidikan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_KondisiPendidikan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #27</span>
                        <div class="q-text">27. Bagaimana kondisi fasilitas pendidikan yang ada di desa ini?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="KondisiPendidikan" style="max-width: 250px;">
                          <option value="1">Sangat Baik</option>
                          <option value="2">Baik</option>
                          <option value="3">Kurang Baik</option>
                          <option value="4">Tidak Baik</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 28. Tenaga Pendidik -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JumlahPendidik">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #28</span>
                        <div class="q-text">28. Berapa jumlah tenaga pendidik (guru/pengajar) yang ada di desa ini?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="JumlahPendidik" placeholder="Input jumlah orang (angka)" style="max-width: 250px;">
                      </div>
                    </div>
                  </div>

                  <!-- 29. Kriteria Kemiskinan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Kriteria">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #29</span>
                        <div class="q-text">29. Kriteria apa yang dipakai untuk mengidentifikasi keluarga yang pantas untuk menerima program pengentasan kemiskinan?</div>
                      </div>
                      <div class="p-3">
                        <?php $Kriteria = array('Tidak memiliki tanah','Kualitas tempat tinggal rendah','Tidak ada toilet/toilet bersama','Tidak ada listrik','Menggunakan kayu untuk memasak',
                                                'Makan kurang dari 2 kali sehari','Tidak mampu membayar pelayanan kesehatan','Kesehatan buruk','Duda/janda','Tidak punya pekerjaan tetap'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($Kriteria); $j++) { ?>
                          <div class="col-md-6 col-lg-4 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$Kriteria[$j]?>" name="Kriteria" id="Kriteria<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="Kriteria<?=$j?>"><?=$Kriteria[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="KriteriaLainnya" placeholder="Sebutkan kriteria lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 30. Mekanisme Permohonan GAKIN -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Mekanisme">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #30</span>
                        <div class="q-text">30. Jika sebuah rumah tangga dirasa pantas menerima program kemiskinan namun tidak tercantum dalam daftar GAKIN, apakah ada mekanisme bagi keluarga tersebut untuk mengajukan permohonan?</div>
                      </div>
                      <div class="p-3">
                        <?php $Mekanisme = array('Melapor ke ketua RT/RW','Melapor ke desa','Melapor ke kecamatan','Tergantung jenis program','Tidak Ada Mekanisme'); ?>
                        <div class="row">
                          <?php for ($j=0; $j < count($Mekanisme); $j++) { ?>
                          <div class="col-md-4 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$Mekanisme[$j]?>" name="Mekanisme" id="Mekanisme<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="Mekanisme<?=$j?>"><?=$Mekanisme[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 31. Jenis Bansos Kemiskinan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JenisBPNT">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #31</span>
                        <div class="q-text">31. Jenis program penanggulangan kemiskinan apa yang terdapat di desa ini? (Boleh pilih lebih dari satu)</div>
                      </div>
                      <div class="p-3">
                        <?php $JenisBPNT = array('KIS','Raskin','Rastra','PKH','BPNT','BLT DD','BLT BBM','Kanggo Riko','Gancang Aron','Rantang Kasih'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($JenisBPNT); $j++) { ?>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$JenisBPNT[$j]?>" name="JenisBPNT" id="JenisBPNT<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="JenisBPNT<?=$j?>"><?=$JenisBPNT[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="JenisBPNTLainnya" placeholder="Sebutkan program lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 32. Program Pemberdayaan Desa -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_ProgramDesa">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #32</span>
                        <div class="q-text">32. Apa saja program dari desa selama ini untuk peningkatan pemberdayaan masyarakat?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="ProgramDesa" placeholder="Tuliskan program pemberdayaan masyarakat desa">
                      </div>
                    </div>
                  </div>

                  <!-- 33. Keberlanjutan Program -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Sustain">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #33</span>
                        <div class="q-text">33. Apakah program tersebut dilaksanakan secara berkelanjutan?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-6 mb-2 mb-md-0">
                            <select class="custom-select" id="Sustain">
                              <option value="1">Iya (Berkelanjutan)</option>
                              <option value="2">Tidak, Mengapa?</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" id="SustainLainnya" placeholder="Sebutkan alasan jika tidak berkelanjutan">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 34. Dampak Program -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Dampak">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #34</span>
                        <div class="q-text">34. Bagaimana dampak masyarakat setelah adanya program pemberdayaan tersebut terutama bagi masyarakat miskin?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="Dampak" placeholder="Deskripsikan dampak bagi masyarakat miskin">
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