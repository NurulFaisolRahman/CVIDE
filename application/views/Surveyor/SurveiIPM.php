				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="card-header bg-primary text-light py-2">
                      <b>Lokasi Responden</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary py-2 px-0">
                      <div class="container-fluid">
                        <div class="row">
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
                                <label class="input-group-text bg-danger text-light"><b>Alamat</b></label>
                              </div>
                              <input class="form-control" type="text" id="Alamat" placeholder="Nama Jalan/Gang, RT/RW, Dusun">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 mt-2">
                  <div class="card">
                    <div class="card-header bg-primary text-light py-2">
                      <b>Informasi Anggota Keluarga (Ditanyakan Untuk Semua Anggota Keluarga Di Mulai Dari Kepala Keluarga)</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary py-2 px-0">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 17%;" class="align-middle">Nama Anggota</th>
                                    <th style="width: 10%;" class="align-middle">Status</th>
                                    <th style="width: 11%;" class="align-middle">Jenis Kelamin</th>
                                    <th style="width: 5%;" class="align-middle">Usia</th>
                                    <th style="width: 11%;" class="align-middle">Pendapatan<br>Bersih 1 Bulan</th>
                                    <th style="width: 20%;" class="align-middle">Jenis Pekerjaan</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                  <?php for ($i=0; $i < 8; $i++) { ?>
                                    <tr class="text-light text-center align-middle">
                                      <td class="align-middle font-weight-bold"><?=$i+1?></td>
                                      <td><input class="form-control form-control-sm" type="text" id="<?='NamaAnggota'.$i?>"></td>
                                      <td>
                                        <select class="custom-select custom-select-sm" id="<?='Status'.$i?>">                    
                                          <option value="1">Suami</option>
                                          <option value="2">Istri</option>
                                          <option value="3">Anak</option>
                                          <option value="4">Family</option>
                                        </select>
                                      </td>
                                      <td>
                                        <select class="custom-select custom-select-sm" id="<?='Gender'.$i?>">                    
                                          <option value="1">Laki-Laki</option>
                                          <option value="2">Perempuan</option>
                                        </select>
                                      </td>
                                      <td><input class="form-control form-control-sm" type="text" id="<?='Usia'.$i?>"></td>
                                      <td><input class="form-control form-control-sm" type="text" id="<?='Pendapatan'.$i?>"></td>
                                      <td>
                                        <select class="custom-select custom-select-sm" id="<?='Pekerjaan'.$i?>">              
                                          <option value="1">Pegawai level bawah (staff, Pegawai negeri gol II, Tentara gol letnan bawah)</option>
                                          <option value="2">Pegawai golongan menengah (Kabag,Manager,Direktur,PNS gol III Keatas,Tentara Pangkat Kapten Keatas,Dosen)</option>
                                          <option value="3">Profesional (Dokter, Pengacara, Notaris, Seniman dll)</option>
                                          <option value="4">Wiraswasta / Pedagang Besar (Karyawan > 10 orang)</option>
                                          <option value="5">Wiraswasta / Pedagang Kecil (Karyawan < 10 orang)</option>
                                          <option value="6">Mahasiswa / Pelajar</option>
                                          <option value="7">Pekerja Terlatih (Salesman, Teknisi, montir, Tukang bangunan, tukang kayu, dll)</option>
                                          <option value="8">Pekerjaan tidak terlatih (Buruh tani, tukang becak, penjaga toko dll)</option>
                                          <option value="9">Pemilik usaha (Petani, petambak, Peternak dll)</option>
                                          <option value="10">Pensiunan</option>
                                          <option value="11">Tidak Bekerja</option>      
                                          <option value="12">Lainnya</option>      
                                        </select>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 2%;" class="align-middle">No</th>
                                    <th style="width: 10%;" class="align-middle">Kegiatan<br>Seminggu Lalu</th>
                                    <th style="width: 1%;" class="align-middle">Jumlah Jam Kerja<br>Dalam Seminggu</th>
                                    <th style="width: 18%;" class="align-middle">Alasan Mencari<br>Pekerjaan</th>
                                    <th style="width: 18%;" class="align-middle">Penyebab Pengangguran<br>di Keluarga Anda</th>
                                    <th style="width: 11%;" class="align-middle">Lokasi Pekerjaan</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                  <?php for ($i=0; $i < 8; $i++) { ?>
                                    <tr class="text-light text-center align-middle">
                                      <td class="align-middle font-weight-bold"><?=$i+1?></td>
                                      <td>
                                        <select class="custom-select custom-select-sm" id="<?='KegiatanSeminggu'.$i?>">                    
                                          <option value="1">Tidak Bekerja</option>
                                          <option value="2">Bekerja</option>
                                          <option value="3">Bersekolah</option>
                                          <option value="4">Mengurus Rumah Tangga</option>
                                          <option value="5">Mencari Pekerjaan</option>
                                        </select>
                                      </td>
                                      <td><input class="form-control form-control-sm" type="text" id="<?='JamKerja'.$i?>"></td>
                                      <td>
                                        <div class="form-inline">
                                          <select style="width: 50%;" class="custom-select custom-select-sm" id="<?='AlasanMencariKerja'.$i?>">                    
                                            <option value="1">Tamat Sekolah</option>
                                            <option value="2">Mencari Nafkah/Membantu Ekonomi Keluarga</option>
                                            <option value="3">Lainnya</option>
                                          </select>
                                          <input disabled placeholder="Jika Lainnya" style="width: 50%;" class="form-control form-control-sm" type="text" id="<?='AlasanMencariKerjaLainnya'.$i?>">
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-inline">
                                          <select style="width: 50%;" class="custom-select custom-select-sm" id="<?='PenyebabMenganggur'.$i?>">
                                            <option value="1">Rendahnya Kualitas Pendidikan</option>
                                            <option value="2">Sedang Mencari Pekerjaan</option>
                                            <option value="3">Minimnya Lowongan Pekerjaan</option>
                                            <option value="4">Lainnya</option>
                                          </select>
                                          <input disabled placeholder="Jika Lainnya" style="width: 50%;" class="form-control form-control-sm" type="text" id="<?='PenyebabMenganggurLainnya'.$i?>">
                                        </div>
                                      </td>
                                      <td>
                                        <select class="custom-select custom-select-sm" id="<?='LokasiPekerjaan'.$i?>">              
                                          <option value="1">Dalam Kabupaten</option>
                                          <option value="2">Luar Kabupaten</option>
                                          <option value="3">Luar Negeri</option>
                                        </select>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 mt-2">
                  <div class="card">
                    <div class="card-header bg-primary text-light py-2">
                      <b>Kondisi Kesehatan (Ditanyakan Untuk Semua Anggota Keluarga Di Mulai Dari Kepala Keluarga)</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary py-2 px-0">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 24%;" class="align-middle">Pertolongan Saat Di Lahirkan</th>
                                    <th style="width: 24%;" class="align-middle">Pernah Di Beri ASI</th>
                                    <th style="width: 24%;" class="align-middle">Pernah mendapat Imunisasi</th>
                                    <th style="width: 24%;" class="align-middle">Memiliki Kartu Jaminan Kesehatan</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                  <?php for ($i=0; $i < 8; $i++) { ?>
                                    <tr class="text-light text-center align-middle">
                                      <td class="align-middle font-weight-bold"><?=$i+1?></td>
                                      <td>
                                        <select style="width: 70%;" class="custom-select custom-select-sm" id="<?='PertolonganLahir'.$i?>">                    
                                          <option value="1">Dokter</option>
                                          <option value="2">Bidan</option>
                                          <option value="3">Tenaga Medis Lainnya</option>
                                          <option value="4">Dukun Bersalin</option>
                                          <option value="5">Family</option>
                                          <option value="6">lainnya</option>
                                        </select>
                                      </td>
                                      <td>
                                        <select style="width: 30%;" class="custom-select custom-select-sm" id="<?='Asi'.$i?>">                    
                                          <option value="1">Ya</option>
                                          <option value="2">Tidak</option>
                                        </select>
                                      </td>
                                      <td>
                                        <select style="width: 30%;" class="custom-select custom-select-sm" id="<?='Imunisasi'.$i?>">                    
                                          <option value="1">Ya</option>
                                          <option value="2">Tidak</option>
                                        </select>
                                      </td>
                                      <td>
                                        <select style="width: 60%;" class="custom-select custom-select-sm" id="<?='JaminanKesehatan'.$i?>">                    
                                          <option value="0">NA</option>
                                          <option value="1">BPJS</option>
                                          <option value="2">Jamkesda</option>
                                          <option value="3">Asuransi Swasta</option>
                                          <option value="4">Lainnya</option>
                                        </select>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 mt-2">
                  <div class="card">
                    <div class="card-header bg-primary text-light py-2">
                      <b>Kondisi Fertilitas (Ditanyakan Kepada Istri)</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary py-2 px-0">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-light"><b>Usia Saat Pernikahan Pertama</b></label>
                              </div>
                              <input class="form-control form-control-sm" type="text" id="UsiaIstriMenikah">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-primary text-light"><b>Tahun</b></label>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-8"></div>
                          <div class="col-sm-5">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-light"><b>Jumlah Tahun Dalam Ikatan Pernikahan</b></label>
                              </div>
                              <input class="form-control form-control-sm" type="text" id="UsiaPernikahan">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-primary text-light"><b>Tahun</b></label>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="table-responsive">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th class="align-middle">Anak Kandung</th>
                                    <th class="align-middle">Anak Lahir Hidup</th>
                                    <th class="align-middle">Anak Masih Hidup</th>
                                    <th class="align-middle">Anak Sudah Meninggal</th>
                                    <th class="align-middle">Usia</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                  <?php for ($i=0; $i < 6; $i++) { ?>
                                    <tr class="text-light text-center align-middle">
                                      <td class="align-middle font-weight-bold"><?='Ke-'.($i+1)?></td>
                                      <td class="align-middle font-weight-bold">
                                        <select style="width: 50%;" class="custom-select custom-select-sm" id="AnakLahirHidup<?=$i?>">                    
                                          <option value="0"></option>
                                          <option value="1">Ya</option>
                                          <option value="2">Tidak</option>
                                        </select>
                                      </td>
                                      <td class="align-middle font-weight-bold">
                                        <select style="width: 50%;" class="custom-select custom-select-sm" id="AnakMasihHidup<?=$i?>">                    
                                          <option value="0"></option>
                                          <option value="1">Ya</option>
                                          <option value="2">Tidak</option>
                                        </select>
                                      </td>
                                      <td class="align-middle font-weight-bold">
                                        <select disabled style="width: 40%;" class="custom-select custom-select-sm" id="AnakSudahMeninggal<?=$i?>">                    
                                          <option value="0"></option>
                                          <option value="1">Ya</option>
                                          <option value="2">Tidak</option>
                                        </select>
                                      </td>
                                      <td class="align-middle font-weight-bold d-flex justify-content-center">
                                        <input style="width: 20%;" class="form-control form-control-sm" type="text" id="UsiaAnak<?=$i?>">
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 mt-2">
                  <div class="card">
                    <div class="card-header bg-primary text-light py-2">
                      <b>Kondisi Pendidikan (Ditanyakan Untuk Seluruh Anggota Keluarga Di Mulai Dari Kepala Keluarga)</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary py-2 px-0">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 3%;" class="align-middle">No</th>
                                    <th style="width: 22%;" class="align-middle">Partisipasi Sekolah</th>
                                    <th style="width: 21%;" class="align-middle">Jenjang Pendidikan Tertinggi<br>Yang Pernah/Sedang Di Duduki</th>
                                    <th style="width: 21%;" class="align-middle">Tingkat Kelas Yang Pernah<br>Atau Sedang Di Duduki</th>
                                    <th style="width: 16%;" class="align-middle">Ijasah Tertinggi<br>Yang Dimiliki</th>
                                    <th style="width: 17%;" class="align-middle">Dapat Membaca Tulis</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                  <?php for ($i=0; $i < 8; $i++) { ?>
                                    <tr class="text-light text-center align-middle">
                                      <td class="align-middle font-weight-bold"><?=$i+1?></td>
                                      <td>
                                        <select class="custom-select custom-select-sm" id="<?='PartisipasiSekolah'.$i?>">                    
                                          <option value="1">Tidak/Belum Pernah Sekolah</option>
                                          <option value="2">Masih Sekolah</option>
                                          <option value="3">Tidak Sekolah Lagi</option>
                                        </select>
                                      </td>
                                      <td>
                                        <select class="custom-select custom-select-sm" id="<?='PendidikanTertinggi'.$i?>">                    
                                          <option value="1">SD/SDLB</option>
                                          <option value="2">MI</option>
                                          <option value="3">Paket A</option>
                                          <option value="4">SMP/SMLB</option>
                                          <option value="5">M.Ts</option>
                                          <option value="6">Paket B</option>
                                          <option value="7">SMA/SMLB</option>
                                          <option value="8">MA</option>
                                          <option value="9">SMK</option>
                                          <option value="10">Paket C</option>
                                          <option value="11">D1/D2</option>
                                          <option value="12">D3</option>
                                          <option value="13">D4/S1</option>
                                          <option value="14">S2</option>
                                          <option value="15">S3</option>
                                        </select>
                                      </td>
                                      <td>
                                        <select style="width: 40%;" class="custom-select custom-select-sm" id="<?='StatusSekolah'.$i?>">                    
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">Tamat</option>
                                        </select>
                                      </td>
                                      <td>
                                        <select class="custom-select custom-select-sm" id="<?='IjazahTertinggi'.$i?>">                    
                                          <option value="1">Tdk Punya Ijazah</option>
                                          <option value="2">SD/SDLB</option>
                                          <option value="3">MI</option>
                                          <option value="4">Paket A</option>
                                          <option value="5">SMP/SMLB</option>
                                          <option value="6">M.Ts</option>
                                          <option value="7">Paket B</option>
                                          <option value="8">SMA/SMLB</option>
                                          <option value="9">MA</option>
                                          <option value="10">SMK</option>
                                          <option value="11">Paket C</option>
                                          <option value="12">D1/D2</option>
                                          <option value="13">D3</option>
                                          <option value="14">D4/S1</option>
                                          <option value="15">S2</option>
                                          <option value="16">S3</option>
                                        </select>
                                      </td>
                                      <td>
                                        <select class="custom-select custom-select-sm" id="<?='BacaTulis'.$i?>">                    
                                          <option value="1">Huruf Latin</option>
                                          <option value="2">Huruf Arab</option>
                                          <option value="3">Huruf Lain</option>
                                          <option value="4">All</option>
                                        </select>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                            <div class="col-sm-8">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <label class="input-group-text bg-danger text-light"><b>Apakah ada anggota keluarga yang bersekolah di pesantren?</b></label>
                                </div>
                                <select class="custom-select custom-select-sm" id="Santri">                    
                                  <option value="Tidak">Tidak</option>
                                  <option value="Ya">Ya</option>
                                </select>
                                <input class="form-control form-control-sm" type="text" id="JumlahSantri" disabled>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 mt-2">
                  <div class="card">
                    <div class="card-header bg-primary text-light py-2">
                      <b>Kepesertaan Program & Informasi Usaha (Ditanyakan untuk satu keluarga)</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary py-2 px-0">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th class="align-middle">Program</th>
                                    <th class="align-middle">Kepesertaan</th>
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th class="align-middle">Program</th>
                                    <th class="align-middle">Kepesertaan</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                  <?php $Program = array('Kartu Indonesia Pintar (KIP)','Program keluarga Harapan (PKH)','PBI JKN','BPJS Ketenagakerjaan','BLT Dana Desa','Bantuan Sosial Tunai (BST)','Bantuan Presiden (BanPres)','Bantuan UMKM','Bantuan Untuk Pekerja','Asuransi Kesehatan Lainnya'); 
                                    $No = 1; for ($i=0; $i < count($Program)/2; $i++) { ?>
                                    <tr class="text-light text-center align-middle">
                                      <td class="align-middle font-weight-bold"><?=$No++?></td>
                                      <td class="align-middle font-weight-bold"><?=$Program[$i]?></td>
                                      <td>
                                        <select style="width: 75%;" class="custom-select custom-select-sm" id="<?='Program'.$i?>">                    
                                          <option value="1">Tidak</option>
                                          <option value="2">Ya</option>
                                        </select>
                                      </td>
                                      <td class="align-middle font-weight-bold"><?=$i+6?></td>
                                      <td class="align-middle font-weight-bold"><?=$Program[$i+5]?></td>
                                      <td>
                                        <select style="width: 75%;" class="custom-select custom-select-sm" id="<?='Program'.($i+5)?>">                    
                                          <option value="1">Tidak</option>
                                          <option value="2">Ya</option>
                                        </select>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light">
                                    <th style="width: 3%;" class="align-middle">No</th>
                                    <th style="width: 70%;" class="align-middle">Pertanyaan</th>
                                    <th style="width: 27%;" class="align-middle">Keterangan</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary text-light font-weight-bold">
                                  <tr>
                                    <td class="align-middle text-center">1</td>
                                    <td class="align-middle">Apakah bapak/ibu mempunyai sebuah usaha?</td>
                                    <td>
                                      <select style="width: 30%;" class="custom-select custom-select-sm" id="PunyaUsaha">              
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>  
                                      </select>  
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="align-middle text-center">2</td>
                                    <td class="align-middle">Jika Ya, apakah bapak/ibu mempunyai karyawan?</td>
                                    <td class="form-inline">
                                      <select style="width: 30%;" class="custom-select custom-select-sm" id="PunyaKaryawan">              
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                      </select>  
                                      <input style="width: 70%;" class="form-control form-control-sm" type="text" id="JumlahKaryawan" disabled>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="align-middle text-center">3</td>
                                    <td class="align-middle">Apakah bapak/ibu mempunyai keinginan untuk membuka suatu usaha? (*Bagi yang tidak punya usaha)</td>
                                    <td>
                                      <select style="width: 30%;" class="custom-select custom-select-sm" id="BukaUsaha">              
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                      </select>  
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="align-middle text-center">4</td>
                                    <td class="align-middle">Apakah bapak/ibu berminat untuk berinvestasi?</td>
                                    <td>
                                      <select style="width: 30%;" class="custom-select custom-select-sm" id="MinatInvest">              
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                      </select>  
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle">Apakah bapak/ibu mempunyai tabungan?</td>
                                    <td>
                                      <select style="width: 30%;" class="custom-select custom-select-sm" id="Tabungan">              
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                      </select>  
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="align-middle text-center">6</td>
                                    <td class="align-middle">Apakah Bapak Ibu Pernah Mengajukan Kredit (KUR, KUBE dsb)</td>
                                    <td>
                                      <select style="width: 30%;" class="custom-select custom-select-sm" id="MengajukanKredit">              
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                      </select>  
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="align-middle text-center">7</td>
                                    <td class="align-middle">Apakah Bapak Dan ibu Berhasil Mendapatkan Kredit?</td>
                                    <td>
                                      <select style="width: 30%;" class="custom-select custom-select-sm" id="DapatKredit">              
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                      </select>  
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 mt-2">
                  <div class="card">
                    <div class="card-header bg-primary text-light py-2">
                      <b>Pengeluaran Perkapita (Ditanyakan untuk 1 Keluarga Untuk Konsumsi Selama 1 Minggu)</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary py-2 px-0">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 34%;" class="align-middle">Komoditas</th>
                                    <th style="width: 8%;" class="align-middle">Satuan</th>
                                    <th style="width: 8%;" class="align-middle">Banyaknya</th>
                                    <th style="width: 20%;" class="align-middle">Harga</th>
                                    <th style="width: 24%;" class="align-middle">Nilai</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                  <?php $Komoditas = array('Beras','Biji-bijian (jagung/kedelai/kacang hijau/lainnya)','Tepung terigu/beras/jagung/lainnya',
                                                          'Ketela pohon/singkong','Kentang','Tongkol/tuna/cakalang','Kembung','Bandeng','Mujair','Mas','Lele',
                                                          'Ikan segar lainnya','Daging sapi','Daging ayam ras','Daging ayam kampung','Daging Kambing','Telur ayam ras',
                                                          'Telur ayam kampung','Telur bebek','Susu kental manis','Susu bubuk','Susu bubuk bayi','Susu untuk ibu hamil',
                                                          'Bayam','Kangkung','Kacang panjang','Buncis','Sawi (putih/hijau)','Wortel','Mentimun','Tomat','Terong','Labu',
                                                          'Tauge','Jamur','Petai/jengkol','Bawang merah','Bawang putih','Cabe merah/hijau','Cabe rawit','Tahu','Tempe',
                                                          'Jeruk','Mangga','Apel','Alpukat','Rambutan','Duku','Durian','Salak','Nanas','Pisang ambon','Pisang raja',
                                                          'Pisang lainnya','Pepaya','Jambu','Sawo','Belimbing','Kedondong','Semangka','Melon','Nangka','Minyak kelapa',
                                                          'Minyak goreng lainnya','Kelapa','Margarin/Mentega','Gula pasir','Gula merah','Teh','Kopi (bubuk/biji)',
                                                          'Coklat bubuk','Garam','Kecap','Pala (kemiri, merica, lainnya)','Terasi','Cengkeh','Penyedap masakan/vetsin',
                                                          'Bumbu masak jadi/kemasan','Kerupuk','Mie instan','Makaroni/mie kering','Bihun','Bahan agar/agar/nutrijel',
                                                          'Bubur bayi kemasan','Roti manis/roti lainnya','Kue kering','Kue basah','Makanan gorengan',
                                                          'Bubur (ayam/kacang hijau/lainnya)','Gado-gado/ketoprak','Nasi campur/rames','Nasi goreng','Nasi putih',
                                                          'Lontong/ketupat sayur','Soto/gule/sop/rawon/cincang','Sate/tongseng','Mie bakso/mie rebus/mie goreng',
                                                          'Makanan ringan anak','Ikang (goreng/bakar dll)','Ayam/daging (goreng dll)','Makanan jadi lainnya',
                                                          'Air kemasan galon','Minuman jadi lainnya','Es lainnya','Roko kretek filter','Rokok kretek tanpa filter',
                                                          'Rokok putih','Perawatan rumah sendiri/bebas sewa','Rumah kontrak','Rumah sewa','Rumah dinas','Listrik',
                                                          'Air PAM','LPG','Minyak tanah','Lainnya(batu baterai,aki,korek,obat nyamuk dll)',
                                                          'Perawatan Kendaraan (servis/lainnya)','Biaya paket data','Perlengkapan mandi','Barang kecantikan',
                                                          'Perawatan kulit,muka,kuku,rambut','Sabun cuci','Lainnya (handuk, ikat pinggang,semir sepatu, dasi, dan lainnya)',
                                                          'Hotel, Penginapan, dekoder, dan rekreasi lain (tidak termasuk transport dan pembelian barang rekreasi)',
                                                          'Pembantu Rumah tangga dan sopir (gaji/upah)','Barang lainnya (tissue, kapur barus, daun pisang, daun kelapa, tusuk sate, dan lainnya )',
                                                          'Jasa lainnya (KTP, SIM, akte kelahiran, foto copy, foto, dan lainnya)','Biaya RS Pemerintah','Biaya RS Swasta','Puskesmas/pustu',
                                                          'Praktek dokter/poliklinik','Posyandu/Kader','Bidan/mantri/perawat praktek','Dukun/tabib','Beli obat dengan resep dokter',
                                                          'Berobat sendiri/beli obat tanpa resep dokter/ beli jamu untuk obat','SPP','Sumbangan pembangunan sekolah (uang pangkal)',
                                                          'Buku pelajaran/fotocopy bahan pelajaran','Alat tulis','Uang kursus/les','Bensin','Transportasi/pengangkutan umum',
                                                          'Pos dan Telekomunikasi','Pakaian jadi laki-laki dewasa','Pakaian jadi perempuan dewasa','Pakaian jadi anak-anak','Alas kaki',
                                                          'Minyak Pelumas','Meubelair','Peralatan Rumah Tangga','Perlengkapan perabot rumah tangga','Alat-alat Dapur/Makan',
                                                          'Lembaga Keuangan (Kredit, Premi, dll)'); 
                                        $Satuan = array('Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','ml','Gram','Gram','Gram',
                                        'Ikat','Ikat','Ikat','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Potong','Potong','Kg','Kg','Kg','Kg','Kg','Kg',
                                        'Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Liter','Liter','Butir','Ons','Kg','Kg','Bungkus','Bungkus',
                                        'Bungkus','Bungkus','Bungkus','Ons','Bungkus','Ons','Bungkus','Bungkus','Bungkus','Bungkus','Ons','Bungkus','Bungkus','Gram','Bungkus',
                                        'Bungkus','Bungkus','Biji','Porsi','Porsi','Porsi','Porsi','Porsi','Porsi','Porsi','Porsi','Porsi','Bungkus','Porsi','Porsi','Porsi',
                                        'Galon','Ml','Ml','Bungkus','Bungkus','Bungkus','Rp','Rp','Rp','Rp','Rp','Rp','Tabung','Liter','Rp','Rp','Rp','Rp','Rp','Rp','Rp',
                                        'Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Liter','Rp','Rp','Rp','Rp','Rp','Rp',
                                        'Liter','Rp','Rp','Rp','Rp','Rp');
                                        // $Harga = array('10000','13000','8000','3000','24000','30000','45000','23000','40000','30000','22000','25000','125000','30000','40000',
                                        // '80000','27000','40000','45000','200','75','75','75','2000','2000','2000','10000','10000','9000','8000','18000','14000','45000','35000',
                                        // '22000','40000','22000','22000','35000','60000','500','2000','30000','15000','28000','20000','15000','20000','55000','9000','15000','15000',
                                        // '20000','12000','15000','12000','15000','15000','10000','10000','20000','20000','25000','15000','5000','1500','12000','15000','5000',
                                        // '10000','15000','2000','5000','2000','500','1000','1000','2000','1000','3000','2500','3000','6000','100','5000','5000','3000','1000',
                                        // '7000','12000','15000','10000','4000','8000','12000','10000','10000','2000','5000','5000','5000','15000','5000','5000','20000','20000',
                                        // '20000','100000','3000000','3000000','0','75000','50000','18000','10000','5000','150000','100000','10000','50000','30000','5000','10000',
                                        // '500000','2000000','5000','100000','100000','150000','50000','75000','30000','50000','50000','50000','50000','75000','500000','10000',
                                        // '5000','20000','10000','5000','15000','100000','150000','100000','15000','10000','150000','100000','200000','100000','50000');
                                  $No = 1; for ($i=0; $i < count($Komoditas); $i++) { ?>
                                    <tr class="text-light text-center align-middle">
                                      <td class="align-middle font-weight-bold"><?=$No++?></td>
                                      <td class="align-middle font-weight-bold"><?=$Komoditas[$i]?></td>
                                      <td class="align-middle font-weight-bold"><?=$Satuan[$i]?></td>
                                      <td>
                                        <input class="form-control form-control-sm text-center" oninput="Banyaknya<?=$i?>()" placeholder="0" type="text" id="Banyaknya<?=$i?>">
                                      </td>
                                      <td>
                                      <input class="form-control form-control-sm text-center" oninput="Harga<?=$i?>()" placeholder="0" type="text" id="Harga<?=$i?>">
                                      </td>
                                      <td>
                                        <input class="form-control form-control-sm text-center" disabled placeholder="0" type="text" id="Nilai<?=$i?>">
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mt-2">
                  <div class="card">
                    <div class="card-header bg-primary text-light py-2">
                      <b>Kepemilikan Aset (Ditanyakan Untuk 1 Keluarga)</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary py-2 px-0">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 50%;"class="align-middle">Aset</th>
                                    <th class="align-middle">Banyaknya</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                <?php $Aset = array('Sepeda Motor','Mobil','Lemari Es','AC','Pemanas Air (Water heater)','Televisi','Sepeda','Komputer/Laptop','Perhiasan/Tabungan > 10Gr','Rumah di tempat lain'); 
                                  $No = 1; for ($i=0; $i < count($Aset); $i++) { ?>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold"><?=$No++?></td>
                                    <td class="align-middle font-weight-bold"><?=$Aset[$i]?></td>
                                    <td>
                                      <input class="form-control form-control-sm" type="text" id="Aset<?=$i?>">
                                    </td>
                                  </tr>
                                <?php } ?>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">11</td>
                                    <td class="align-middle font-weight-bold">Lahan/Tanah</td>
                                    <td>
                                      <div class="input-group input-group-sm">
                                        <input class="form-control form-control-sm" type="text" id="Aset10">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text bg-danger text-light"><b>ha</b></label>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">12</td>
                                    <td class="align-middle font-weight-bold">Sapi</td>
                                    <td>
                                      <div class="input-group input-group-sm">
                                        <input class="form-control form-control-sm" type="text" id="Aset11">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text bg-danger text-light"><b>ekor</b></label>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">13</td>
                                    <td class="align-middle font-weight-bold">Kerbau</td>
                                    <td>
                                      <div class="input-group input-group-sm">
                                        <input class="form-control form-control-sm" type="text" id="Aset12">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text bg-danger text-light"><b>ekor</b></label>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">14</td>
                                    <td class="align-middle font-weight-bold">Kambing/Domba</td>
                                    <td>
                                      <div class="input-group input-group-sm">
                                        <input class="form-control form-control-sm" type="text" id="Aset13">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text bg-danger text-light"><b>ekor</b></label>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">15</td>
                                    <td class="align-middle font-weight-bold">Kuda</td>
                                    <td>
                                      <div class="input-group input-group-sm">
                                        <input class="form-control form-control-sm" type="text" id="Aset14">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text bg-danger text-light"><b>ekor</b></label>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mt-2">
                  <div class="card">
                    <div class="card-header bg-primary text-light py-2">
                      <b>Keterangan Kondisi Rumah (Ditanyakan Untuk 1 Keluarga)</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary py-2 px-0">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 35%;"class="align-middle">Perumahan</th>
                                    <th class="align-middle">Keterangan</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">1</td>
                                    <td class="align-middle font-weight-bold">Status Bangunan Tinggal</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah0">              
                                        <option value="1">Milik sendiri</option>
                                        <option value="2">Kontrak/sewa</option>
                                        <option value="3">Bebas sewa</option>
                                        <option value="4">Dipinjami</option>
                                        <option value="5">Dinas</option>
                                        <option value="6">Lainnya</option>
                                      </select>  
                                      <input disabled style="width: 50%;" class="form-control form-control-sm" type="text" id="Rumah0Lainnya">
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">2</td>
                                    <td class="align-middle font-weight-bold">Status Lahan Tinggal</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah1">              
                                        <option value="1">Milik sendiri</option>
                                        <option value="2">Orang lain</option>
                                        <option value="3">Tanah negara</option>
                                        <option value="4">Lainnya</option>
                                      </select>  
                                      <input disabled style="width: 50%;" class="form-control form-control-sm" type="text" id="Rumah1Lainnya">
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">3</td>
                                    <td class="align-middle font-weight-bold">Jenis Lantai</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah2">              
                                        <option value="1">Marmer/Granit</option>
                                        <option value="2">Keramik</option>
                                        <option value="3">Parket/Vinil/Permadani</option>
                                        <option value="4">Ubin/Tegel/Teraso</option>
                                        <option value="5">Kayu/Papan Kualitas Tinggi</option>
                                        <option value="6">Semen/Bata Merah</option>
                                        <option value="7">Bambu</option>
                                        <option value="8">Kayu/Papan Kualitas Rendah</option>
                                        <option value="9">Lainnya</option>
                                      </select>  
                                      <input disabled style="width: 50%;" class="form-control form-control-sm" type="text" id="Rumah2Lainnya">
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">4</td>
                                    <td class="align-middle font-weight-bold">Kondisi Lantai</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah3">              
                                        <option value="1">Bagus/Kualitas Tinggi</option>
                                        <option value="2">Jelek/Berkualitas Rendah</option>
                                      </select>  
                                      <input disabled style="width: 50%;" class="form-control form-control-sm" type="text" id="Rumah3Lainnya">
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">5</td>
                                    <td class="align-middle font-weight-bold">Jenis Dinding</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah4">              
                                        <option value="1">Tembok/Beton</option>
                                        <option value="2">Kayu Kualitas Tinggi</option>
                                        <option value="3">Kayu Berkualitas Rendah</option>
                                        <option value="4">Plesteran anyaman bambu</option>
                                        <option value="5">Lainnya</option>
                                      </select>  
                                      <input disabled style="width: 50%;" class="form-control form-control-sm" type="text" id="Rumah4Lainnya">
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">6</td>
                                    <td class="align-middle font-weight-bold">Kondisi Dinding</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah5">              
                                        <option value="1">Bagus/Kualitas Tinggi</option>
                                        <option value="2">Jelek/Kualitas Rendah</option>
                                      </select>  
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">7</td>
                                    <td class="align-middle font-weight-bold">Jenis Atap</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah6">              
                                        <option value="1">Genteng Beton</option>
                                        <option value="2">Genteng keramik</option>
                                        <option value="3">Genteng tanah liat</option>
                                        <option value="4">Asbes</option>
                                        <option value="5">Kayu/Jerami</option>
                                        <option value="6">Lainnya</option>
                                      </select>  
                                      <input disabled style="width: 50%;" class="form-control form-control-sm" type="text" id="Rumah6Lainnya">
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">8</td>
                                    <td class="align-middle font-weight-bold">Kondisi Atap</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah7">              
                                        <option value="1">Bagus/Kualitas Tinggi</option>
                                        <option value="2">Jelek/Kualitas Rendah</option>
                                      </select>  
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">9</td>
                                    <td class="align-middle font-weight-bold">Sumber Air Minum</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah8">              
                                        <option value="1">Air kemasan/Air isi ulang</option>
                                        <option value="2">Leding meteran/eceran</option>
                                        <option value="3">Sumur Bor/Pompa</option>
                                        <option value="4">Sumur terlindung</option>
                                        <option value="5">Sumur tak terlindung</option>
                                        <option value="6">Air sungai</option>
                                        <option value="7">Lainnya</option>
                                      </select>  
                                      <input disabled style="width: 50%;" class="form-control form-control-sm" type="text" id="Rumah8Lainnya">
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">10</td>
                                    <td class="align-middle font-weight-bold">Sumber Penerangan</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah9">              
                                        <option value="1">Listrik PLN</option>
                                        <option value="2">Listrik non PLN</option>
                                        <option value="3">Lampu Minyak/Lilin</option>
                                        <option value="4">Tidak Ada</option>
                                        <option value="5">Lainnya</option>
                                      </select> 
                                      <input disabled style="width: 50%;" class="form-control form-control-sm" type="text" id="Rumah9Lainnya"> 
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">11</td>
                                    <td class="align-middle font-weight-bold">Daya Listrik Terpasang</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah10">              
                                        <option value="1">450 watt</option>
                                        <option value="2">900 watt</option>
                                        <option value="3">1300 watt</option>
                                        <option value="4">> 1300 watt</option>
                                        <option value="5">Tanpa meteran</option>
                                      </select>  
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">12</td>
                                    <td class="align-middle font-weight-bold">Status Sanitasi BAB</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah11">              
                                        <option value="1">Sendiri</option>
                                        <option value="2">Bersama</option>
                                        <option value="3">Umum</option>
                                        <option value="4">Tidak ada</option>
                                      </select>  
                                    </td>
                                  </tr>
                                  <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">13</td>
                                    <td class="align-middle font-weight-bold">TPA Tinja</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah12">              
                                        <option value="1">Tangki</option>
                                        <option value="2">SPAL</option>
                                        <option value="3">Lubang tanah</option>
                                        <option value="4">Sungai</option>
                                        <option value="5">Lainnya</option>
                                      </select>  
                                      <input disabled style="width: 50%;" class="form-control form-control-sm" type="text" id="Rumah12Lainnya">
                                    </td>
                                  </tr>
                                  <!-- <tr class="text-light text-center align-middle">
                                    <td class="align-middle font-weight-bold">14</td>
                                    <td class="align-middle font-weight-bold">Energi Untuk Memasak</td>
                                    <td class="form-inline">
                                      <select style="width: 50%;" class="custom-select custom-select-sm" id="Rumah13">              
                                        <option value="1">Gas/LPG/Biogas</option>
                                        <option value="2">Minyak Tanah/Batu Bara</option>
                                        <option value="3">Kayu Bakar</option>
                                        <option value="4">Lainnya</option>
                                      </select>  
                                      <input disabled style="width: 50%;" class="form-control form-control-sm" type="text" id="Rumah13Lainnya">
                                    </td>
                                  </tr> -->
                                </tbody>
                              </table>
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-primary mt-2" id="Simpan"><b>Simpan Survei <div id="LoadingInput" class="spinner-border spinner-border-sm text-white" style="display: none;" role="status"></b></button>
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

        $('[data-mask]').inputmask()
  
        $("#Kecamatan").change(function (){
          var Desa = { Kode: $("#Kecamatan").val() }
          $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) {
            $('#Desa').html(Respon)
          })    
        })
  
        $("#Simpan").click(function() {
          if ($("#Alamat").val() === "") {
            alert('Input Alamat Tidak Boleh Kosong!')
          } else {
            var Anggota = 0,NamaAnggota = Status = Gender = Usia = Pendapatan = Pekerjaan = ''
            for (let i = 0; i < 8; i++) {
              if ($("#NamaAnggota"+i).val() != "" && i > 0) {
                NamaAnggota += ('|'+$("#NamaAnggota"+i).val())
                Status += ('|'+$("#Status"+i).val())
                Gender += ('|'+$("#Gender"+i).val())
                Usia += ('|'+$("#Usia"+i).val())
                Pendapatan += ('|'+$("#Pendapatan"+i).val())
                Pekerjaan += ('|'+$("#Pekerjaan"+i).val())
                Anggota += 1
              } else if ($("#NamaAnggota"+i).val() != "" && i == 0) {
                NamaAnggota += $("#NamaAnggota"+i).val()
                Status += $("#Status"+i).val()
                Gender += $("#Gender"+i).val()
                Usia += $("#Usia"+i).val()
                Pendapatan += $("#Pendapatan"+i).val()
                Pekerjaan += $("#Pekerjaan"+i).val()
                Anggota += 1
              } else {
                break
              }
            }
            var KegiatanSeminggu = JamKerja = AlasanMencariKerja = PenyebabMenganggur = LokasiPekerjaan = ''
            for (let i = 0; i < Anggota; i++) {
              if (i > 0) {
                KegiatanSeminggu += ('|'+$("#KegiatanSeminggu"+i).val())
                JamKerja += ('|'+$("#JamKerja"+i).val())
                if ($("#AlasanMencariKerja"+i).val() == 3) {
                  AlasanMencariKerja += ('|'+$("#AlasanMencariKerjaLainnya"+i).val())
                } else {
                  AlasanMencariKerja += ('|'+$("#AlasanMencariKerja"+i).val())
                }
                if ($("#PenyebabMenganggur"+i).val() == 4) {
                  PenyebabMenganggur += ('|'+$("#PenyebabMenganggurLainnya"+i).val())
                } else {
                  PenyebabMenganggur += ('|'+$("#PenyebabMenganggur"+i).val())
                }
                LokasiPekerjaan += ('|'+$("#LokasiPekerjaan"+i).val())
              } else {
                KegiatanSeminggu += $("#KegiatanSeminggu"+i).val()
                JamKerja += $("#JamKerja"+i).val()
                if ($("#AlasanMencariKerja"+i).val() == 3) {
                  AlasanMencariKerja += $("#AlasanMencariKerjaLainnya"+i).val()
                } else {
                  AlasanMencariKerja += $("#AlasanMencariKerja"+i).val()
                }
                if ($("#PenyebabMenganggur"+i).val() == 4) {
                  PenyebabMenganggur += $("#PenyebabMenganggurLainnya"+i).val()
                } else {
                  PenyebabMenganggur += $("#PenyebabMenganggur"+i).val()
                }
                LokasiPekerjaan += $("#LokasiPekerjaan"+i).val()
              } 
            }
            var PertolonganLahir = Asi = Imunisasi = JaminanKesehatan = ''
            for (let i = 0; i < Anggota; i++) {
              if (i > 0) {
                PertolonganLahir += ("|"+$("#PertolonganLahir"+i).val())
                Asi += ("|"+$("#Asi"+i).val())
                Imunisasi += ("|"+$("#Imunisasi"+i).val())
                JaminanKesehatan += ("|"+$("#JaminanKesehatan"+i).val())
              } else {
                PertolonganLahir += $("#PertolonganLahir"+i).val()
                Asi += $("#Asi"+i).val()
                Imunisasi += $("#Imunisasi"+i).val()
                JaminanKesehatan += $("#JaminanKesehatan"+i).val()
              } 
            }
            var Pernikahan = Fertilitas = ''
            Pernikahan += ($("#UsiaIstriMenikah").val()+"|")
            Pernikahan += ($("#UsiaPernikahan").val())
            for (let i = 0; i < 6; i++) {
              if ($("#AnakLahirHidup"+i).val() != 0) {
                if (i > 0) {
                  Fertilitas += ("$"+$("#AnakLahirHidup"+i).val()+"|"+$("#AnakMasihHidup"+i).val()+"|"+$("#AnakSudahMeninggal"+i).val()+"|"+$("#UsiaAnak"+i).val())
                } else {
                  Fertilitas += ($("#AnakLahirHidup"+i).val()+"|"+$("#AnakMasihHidup"+i).val()+"|"+$("#AnakSudahMeninggal"+i).val()+"|"+$("#UsiaAnak"+i).val())
                }
              } else {
                break
              }
            }
            var PartisipasiSekolah = PendidikanTertinggi = StatusSekolah = IjazahTertinggi = BacaTulis = ''
            for (let i = 0; i < Anggota; i++) {
              if (i > 0) {
                PartisipasiSekolah += ("|"+$("#PartisipasiSekolah"+i).val())
                PendidikanTertinggi += ("|"+$("#PendidikanTertinggi"+i).val())
                StatusSekolah += ("|"+$("#StatusSekolah"+i).val())
                IjazahTertinggi += ("|"+$("#IjazahTertinggi"+i).val())
                BacaTulis += ("|"+$("#BacaTulis"+i).val())
              } else {
                PartisipasiSekolah += $("#PartisipasiSekolah"+i).val()
                PendidikanTertinggi += $("#PendidikanTertinggi"+i).val()
                StatusSekolah += $("#StatusSekolah"+i).val()
                IjazahTertinggi += $("#IjazahTertinggi"+i).val()
                BacaTulis += $("#BacaTulis"+i).val()
              } 
            }
            var Santri = ''
            if ($("#Santri").val() == 'Tidak') {
              Santri += $("#Santri").val()
            } else {
              Santri += $("#JumlahSantri").val()
            }
            var KepesertaanProgram = ''
            for (let i = 0; i < 10; i++) {
              if (i > 0) {
                KepesertaanProgram += ("|"+$("#Program"+i).val())
              } else {
                KepesertaanProgram += $("#Program"+i).val()
              }
            }
            var Usaha = $("#PunyaUsaha").val()
            if ($("#PunyaKaryawan").val() == "Ya") {
              Usaha += ("|"+$("#JumlahKaryawan").val())
            } else {
              Usaha += ("|"+$("#PunyaKaryawan").val())
            }
            Usaha += ("|"+$("#BukaUsaha").val()+"|"+$("#MinatInvest").val()+"|"+$("#Tabungan").val()+"|"+$("#MengajukanKredit").val()+"|"+$("#DapatKredit").val())
            var Banyaknya = Harga = Nilai = ''
            for (let i = 0; i < 154; i++) {
              if (i == 0) {
                Banyaknya += $("#Banyaknya"+i).val().replace(',','.')
                Harga += $("#Harga"+i).val().replace(',','.')
                Nilai += $("#Nilai"+i).val()
              } else {
                Banyaknya += ("|"+$("#Banyaknya"+i).val().replace(',','.'))
                Harga += ("|"+$("#Harga"+i).val().replace(',','.'))
                Nilai += ("|"+$("#Nilai"+i).val())
              }
            }
            var Rumah = ''
            if ($("#Rumah0").val() == 6) {
              Rumah += $("#Rumah0Lainnya").val()
            } else {
              Rumah += $("#Rumah0").val()
            }
            if ($("#Rumah1").val() == 4) {
              Rumah += ("|"+$("#Rumah1Lainnya").val())
            } else {
              Rumah += ("|"+$("#Rumah1").val())
            }
            if ($("#Rumah2").val() == 9) {
              Rumah += ("|"+$("#Rumah2Lainnya").val())
            } else {
              Rumah += ("|"+$("#Rumah2").val())
            }
            Rumah += ("|"+$("#Rumah3").val())
            if ($("#Rumah4").val() == 5) {
              Rumah += ("|"+$("#Rumah4Lainnya").val())
            } else {
              Rumah += ("|"+$("#Rumah4").val())
            }
            Rumah += ("|"+$("#Rumah5").val())
            if ($("#Rumah6").val() == 6) {
              Rumah += ("|"+$("#Rumah6Lainnya").val())
            } else {
              Rumah += ("|"+$("#Rumah6").val())
            }
            Rumah += ("|"+$("#Rumah7").val())
            if ($("#Rumah8").val() == 7) {
              Rumah += ("|"+$("#Rumah8Lainnya").val())
            } else {
              Rumah += ("|"+$("#Rumah8").val())
            }
            if ($("#Rumah9").val() == 5) {
              Rumah += ("|"+$("#Rumah9Lainnya").val())
            } else {
              Rumah += ("|"+$("#Rumah9").val())
            }
            Rumah += ("|"+$("#Rumah10").val())
            Rumah += ("|"+$("#Rumah11").val())
            if ($("#Rumah12").val() == 5) {
              Rumah += ("|"+$("#Rumah12Lainnya").val())
            } else {
              Rumah += ("|"+$("#Rumah12").val())
            }
            var Aset = ''
            for (let i = 0; i < 15; i++) {
              if (i > 0) {
                Aset += ("|"+$("#Aset"+i).val())
              } else {
                Aset += $("#Aset"+i).val()
              }
            }
            var IPM = { Kecamatan: $("#Kecamatan").val(),Desa: $("#Desa").val(),Alamat: $("#Alamat").val(),
                        NamaAnggota: NamaAnggota,Status: Status,Gender: Gender,Usia: Usia,Pendapatan: Pendapatan,Pekerjaan: Pekerjaan,
                        KegiatanSeminggu: KegiatanSeminggu,JamKerja: JamKerja,AlasanMencariKerja: AlasanMencariKerja,Aset: Aset,
                        PenyebabMenganggur: PenyebabMenganggur,LokasiPekerjaan: LokasiPekerjaan,PertolonganLahir: PertolonganLahir,
                        Asi: Asi,Imunisasi: Imunisasi,JaminanKesehatan: JaminanKesehatan,Pernikahan: Pernikahan,Fertilitas: Fertilitas,
                        PartisipasiSekolah: PartisipasiSekolah,PendidikanTertinggi: PendidikanTertinggi,StatusSekolah: StatusSekolah,
                        IjazahTertinggi: IjazahTertinggi,BacaTulis: BacaTulis,Santri: Santri,Rumah: Rumah,Nilai: Nilai,
                        KepesertaanProgram: KepesertaanProgram,Usaha: Usaha,Banyaknya: Banyaknya,Harga: Harga }    
            $("#Simpan").attr("disabled", true);                              
            $("#LoadingInput").show();         
            $.post(BaseURL+"Surveyor/InputIPM", IPM).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/SurveiIPM"
              } else { 
                alert(Respon)
                $("#LoadingInput").hide();
                $("#Simpan").attr("disabled", false);   
              }
            }).fail(function() {
              alert('Gagal Menyimpan!')
              $("#LoadingInput").hide();
              $("#Simpan").attr("disabled", false);   
            })
          } 
        })
  
        <?php for ($i=0; $i < 8; $i++) { ?>
          $("#AlasanMencariKerja<?=$i?>").change(function (){
            if ($("#AlasanMencariKerja<?=$i?>").val() == 3) {
              $("#AlasanMencariKerjaLainnya<?=$i?>").prop('disabled', false)
              $("#AlasanMencariKerjaLainnya<?=$i?>").attr("placeholder", "Sebutkan")
            } else {
              $("#AlasanMencariKerjaLainnya<?=$i?>").prop('disabled', true)
              $("#AlasanMencariKerjaLainnya<?=$i?>").val("")
              $("#AlasanMencariKerjaLainnya<?=$i?>").attr("placeholder", "Jika Lainnya")
            }
          })
        <?php } ?>
  
        <?php for ($i=0; $i < 8; $i++) { ?>
          $("#PenyebabMenganggur<?=$i?>").change(function (){
            if ($("#PenyebabMenganggur<?=$i?>").val() == 4) {
              $("#PenyebabMenganggurLainnya<?=$i?>").prop('disabled', false)
              $("#PenyebabMenganggurLainnya<?=$i?>").attr("placeholder", "Sebutkan")
            } else {
              $("#PenyebabMenganggurLainnya<?=$i?>").prop('disabled', true)
              $("#PenyebabMenganggurLainnya<?=$i?>").val("")
              $("#PenyebabMenganggurLainnya<?=$i?>").attr("placeholder", "Jika Lainnya")
            }
          })
        <?php } ?>

        $("#PunyaKaryawan").change(function (){
          if ($("#PunyaKaryawan").val() == "Ya") {
            $("#JumlahKaryawan").prop('disabled', false)
            $("#JumlahKaryawan").attr("placeholder", "Sebutkan Total Karyawan")
          } else {
            $("#JumlahKaryawan").prop('disabled', true)
            $("#JumlahKaryawan").val("")
            $("#JumlahKaryawan").attr("placeholder", "")
          }
        })

        $("#Santri").change(function (){
          if ($("#Santri").val() == "Ya") {
            $("#JumlahSantri").prop('disabled', false)
            $("#JumlahSantri").attr("placeholder", "Sebutkan")
            $("#JumlahSantri").val(1)
          } else {
            $("#JumlahSantri").prop('disabled', true)
            $("#JumlahSantri").val("")
            $("#JumlahSantri").attr("placeholder", "")
          }
        })

        <?php for ($i=0; $i < 6; $i++) { ?>
          $("#AnakLahirHidup<?=$i?>").change(function (){
            if ($('#AnakLahirHidup<?=$i?>').val() == 1) {
              $("#AnakMasihHidup<?=$i?>").val(1);
              $("#AnakSudahMeninggal<?=$i?>").val(2);
              $("#AnakMasihHidup<?=$i?>").prop('disabled', false);
            } else if ($('#AnakLahirHidup<?=$i?>').val() == 2) {
              $("#AnakMasihHidup<?=$i?>").val(2);
              $("#AnakSudahMeninggal<?=$i?>").val(1);
              $("#AnakMasihHidup<?=$i?>").prop('disabled', true);
            } else {
              $("#AnakMasihHidup<?=$i?>").val(0);
              $("#AnakSudahMeninggal<?=$i?>").val(0);
              $("#AnakMasihHidup<?=$i?>").prop('disabled', true);
            }
          })
        <?php } ?>
  
        <?php for ($i=0; $i < 6; $i++) { ?>
          $("#AnakMasihHidup<?=$i?>").change(function (){
            if ($('#AnakMasihHidup<?=$i?>').val() == 2) {
              $("#AnakSudahMeninggal<?=$i?>").val(1);
            } else {
              $("#AnakSudahMeninggal<?=$i?>").val(2);
            }  
          })
        <?php } ?>
        
        <?php $Rumah = [0,1,2,4,6,8,9,12]; $OpsiRumah = [6,4,9,5,6,7,5,5]; for ($i=0; $i < count($Rumah); $i++) { ?>
          $("#Rumah<?=$Rumah[$i]?>").change(function (){
            if ($("#Rumah<?=$Rumah[$i]?>").val() == <?=$OpsiRumah[$i]?>) {
              $("#Rumah<?=$Rumah[$i]?>Lainnya").prop('disabled', false)
              $("#Rumah<?=$Rumah[$i]?>Lainnya").attr("placeholder", "Sebutkan")
            } else {
              $("#Rumah<?=$Rumah[$i]?>Lainnya").prop('disabled', true)
              $("#Rumah<?=$Rumah[$i]?>Lainnya").val("")
            }  
          })
        <?php } ?>
  
      })
  
      <?php for ($i=0; $i < 154; $i++) { ?>
        function Banyaknya<?=$i?>() {
          if ($('#Banyaknya<?=$i?>').val() === "" || $('#Harga<?=$i?>').val() === "") {
            $("#Nilai<?=$i?>").val("")
          } else {
            $("#Nilai<?=$i?>").val(parseFloat($('#Banyaknya<?=$i?>').val().replace(',','.')) * parseInt($('#Harga<?=$i?>').val())) 
          }
        }
      <?php } ?>
  
      <?php for ($i=0; $i < 154; $i++) { ?>
        function Harga<?=$i?>() {
          if ($('#Banyaknya<?=$i?>').val() === "" || $('#Harga<?=$i?>').val() === "") {
            $("#Nilai<?=$i?>").val("")
          } else {
            $("#Nilai<?=$i?>").val(parseFloat($('#Banyaknya<?=$i?>').val().replace(',','.')) * parseInt($('#Harga<?=$i?>').val())) 
          }
        }
      <?php } ?>
		</script>
  </body>
</html>