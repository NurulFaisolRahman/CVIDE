				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>

            <!-- Modern Survey Header Banner -->
            <div class="dash-survey-header mb-4">
              <div class="row align-items-center">
                <div class="col-md-8">
                  <div class="dash-header-title">
                    <i class="fa fa-users-line mr-2 text-warning"></i> Survei BBM - Persepsi Rumah Tangga
                  </div>
                  <div class="dash-header-subtitle">
                    Instrumen Pemantauan Dampak Penyesuaian Harga BBM terhadap Pengeluaran & Persepsi Rumah Tangga
                  </div>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                  <span class="badge badge-light px-3 py-2 font-weight-normal shadow-sm" style="font-size: 13px; border-radius: 8px;">
                    <i class="fa fa-house-user text-primary mr-1"></i> Responden Rumah Tangga
                  </span>
                </div>
              </div>
            </div>

            <!-- Data Responden Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-id-card text-primary mr-2"></i> Data Responden Rumah Tangga
                </div>
                <span class="badge badge-pill badge-primary px-3 py-1 font-weight-normal">Identitas Kepala/Anggota RT</span>
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
                    <label class="font-weight-bold text-muted small mb-1">Pendidikan Terakhir</label>
                    <input class="form-control" type="text" id="Pendidikan" placeholder="Pendidikan Terakhir">
                  </div>
                  <div class="col-md-3 col-sm-6 mb-3">
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
                  <div class="col-md-8 col-sm-12 mb-2">
                    <label class="font-weight-bold text-muted small mb-1">Alamat Lengkap</label>
                    <input class="form-control" type="text" id="Alamat" placeholder="Alamat Domisili">
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabel Konsumsi Komoditas Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 15px;">
                  <i class="fa fa-table-list text-primary mr-2"></i> Pengeluaran Konsumsi Makanan & Non Makanan Rumah Tangga (Seminggu Sebelum & Sesudah Kenaikan BBM)
                </div>
                <span class="badge badge-pill badge-primary px-3 py-1 font-weight-normal">154 Komoditas</span>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 520px; overflow-y: auto;">
                  <table class="table table-sm table-bordered table-hover mb-0">
                    <thead style="position: sticky; top: 0; z-index: 10; background: #1a2a44; color: #fff;">
                      <tr style="font-size: 10pt;" class="text-center">
                        <th rowspan="2" style="width: 4%; vertical-align: middle;">No</th>
                        <th rowspan="2" style="width: 36%; vertical-align: middle;">Komoditas</th>
                        <th colspan="2" style="width: 30%; vertical-align: middle;">Sebelum Kenaikan (Agustus)</th>
                        <th colspan="2" style="width: 30%; vertical-align: middle;">Kondisi Sekarang</th>
                      </tr>
                      <tr style="font-size: 10pt;" class="text-center">
                        <th style="vertical-align: middle;">Banyaknya</th>
                        <th style="vertical-align: middle;">Harga (Rp)</th>
                        <th style="vertical-align: middle;">Banyaknya</th>
                        <th style="vertical-align: middle;">Harga (Rp)</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white">
                    <?php 
                      $Komoditas = array('Beras','Biji-bijian (jagung/kedelai/kacang hijau/lainnya)','Tepung terigu/beras/jagung/lainnya',
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
                      $No = 1; for ($i=0; $i < count($Komoditas); $i++) { ?>
                        <tr class="align-middle">
                          <td class="text-center font-weight-bold text-muted"><?=$No++?></td>
                          <td class="font-weight-semibold text-dark"><?=$Komoditas[$i]?></td>
                          <td><input class="form-control form-control-sm text-center" value="0" type="text" id="_Agustus<?=$i?>"></td>
                          <td><input class="form-control form-control-sm text-center" value="0" type="text" id="Agustus<?=$i?>"></td>
                          <td><input class="form-control form-control-sm text-center" value="0" type="text" id="_Sekarang<?=$i?>"></td>
                          <td><input class="form-control form-control-sm text-center" value="0" type="text" id="Sekarang<?=$i?>"></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Kuesioner Persepsi Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="font-weight-bold text-dark" style="font-size: 16px;">
                  <i class="fa fa-list-check text-primary mr-2"></i> Kuesioner Persepsi & Kondisi Sosial Ekonomi Rumah Tangga
                </div>
                <span class="badge badge-pill badge-info px-3 py-1 font-weight-normal">Persepsi Rumah Tangga</span>
              </div>
              <div class="card-body p-4 bg-light">
                <div class="row">

                  <!-- 1. Mencukupi Kebutuhan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Mencukupi">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #1</span>
                        <div class="q-text">1. Melihat perubahan harga saat ini, menurut perkiraan Ibu/Bapak/Sdr dalam 1 tahun mendatang, apakah Ibu/Bapak/Sdr akan dapat mencukupi kebutuhan sehari-hari dengan?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Mencukupi" style="max-width: 280px;">
                          <option value="1">Sangat Mudah</option>
                          <option value="2">Mudah</option>
                          <option value="3">Sulit</option>
                          <option value="4">Sangat Sulit</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 2. Pengeluaran Memberatkan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Memberatkan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #2</span>
                        <div class="q-text">2. Pengeluaran dalam konsumsi apa yang paling memberatkan Anda?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Memberatkan" style="max-width: 280px;">
                          <option value="1">Makanan</option>
                          <option value="2">Non Makanan</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 3. Jenis Bansos -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Bansos">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #3</span>
                        <div class="q-text">3. Jenis Bantuan Sosial apa yang pernah diterima Ibu/Bapak/Sdr? (Boleh pilih lebih dari satu)</div>
                      </div>
                      <div class="p-3">
                        <?php $Bansos = array('PKH','BLT Dana Desa','BPJS Kesehatan/KIS','BPNT','Gancang Aron','Rantang Kasih','Kanggo riko'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($Bansos); $j++) { ?>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$Bansos[$j]?>" name="Bansos" id="Bansos<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="Bansos<?=$j?>"><?=$Bansos[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="BansosLainnya" placeholder="Sebutkan bantuan lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 4. Manfaat Bansos -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Manfaat">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #4</span>
                        <div class="q-text">4. Manfaat apa yang selama ini Anda rasakan setelah mendapat bantuan tersebut?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="Manfaat" placeholder="Tuliskan manfaat yang dirasakan">
                      </div>
                    </div>
                  </div>

                  <!-- 5. Tanggungan Anak -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Anak">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #5</span>
                        <div class="q-text">5. Apakah Ibu/Bapak/Sdr mempunyai anak yang masih dalam tanggung jawab keluarga?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Anak" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 6. Jumlah Tanggungan Anak -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JumlahAnak">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #6</span>
                        <div class="q-text">6. Jika iya, berapa anak yang Anda miliki yang masih jadi tanggung jawab keluarga?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="JumlahAnak" placeholder="Input jumlah anak (angka)" style="max-width: 250px;">
                      </div>
                    </div>
                  </div>

                  <!-- 7. Kondisi Kesehatan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Kesehatan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #7</span>
                        <div class="q-text">7. Bagaimana kondisi kesehatan Ibu/Bapak/Sdr selama sebulan lalu?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-3 mb-2 mb-md-0">
                            <select class="custom-select" id="Kesehatan">
                              <option value="1">Sehat</option>
                              <option value="2">Tidak Sehat</option>
                            </select>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" type="text" id="KesehatanLainnya" placeholder="Jika tidak sehat, karena sakit apa?">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 8. Riwayat Sakit -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Riwayat">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #8</span>
                        <div class="q-text">8. Apakah ada riwayat sakit yang diderita anggota keluarga selama ini?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Riwayat" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 9. Biaya Pengobatan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Biaya">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #9</span>
                        <div class="q-text">9. Jika iya, berapa kisaran biaya pengobatannya?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 280px;">
                          <div class="input-group-prepend"><span class="input-group-text font-weight-bold">Rp</span></div>
                          <input class="form-control" type="text" id="Biaya" placeholder="Biaya (angka)">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 10. Tempat Periksa -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Berobat">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #10</span>
                        <div class="q-text">10. Di manakah biasanya periksa jika sakit? (Boleh pilih lebih dari satu)</div>
                      </div>
                      <div class="p-3">
                        <?php $Berobat = array('Rumah Sakit','Puskesmas','Bidan','Mantri','Dokter'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($Berobat); $j++) { ?>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$Berobat[$j]?>" name="Berobat" id="Berobat<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="Berobat<?=$j?>"><?=$Berobat[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="BerobatLainnya" placeholder="Sebutkan tempat lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 11. Alasan Memilih Berobat -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_AlasanBerobat">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #11</span>
                        <div class="q-text">11. Mengapa memilih berobat di tempat tersebut?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="AlasanBerobat" placeholder="Sebutkan alasannya">
                      </div>
                    </div>
                  </div>

                  <!-- 12. Anak Bersekolah -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_AnakSekolah">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #12</span>
                        <div class="q-text">12. Apakah masih ada anak yang bersekolah dalam keluarga ini?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="AnakSekolah" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 13. Tingkat Pendidikan Anak -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_TingkatAnak">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #13</span>
                        <div class="q-text">13. Berada pada tingkatan pendidikan (SD/SMP/SMA/PT) apa yang sedang ditempuh anak Anda sekarang?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-3 col-sm-6 mb-2">
                            <label class="small font-weight-bold text-muted mb-1">Anak 1</label>
                            <select class="custom-select" id="Anak1">
                              <option value="0">- Pilih -</option>
                              <option value="1">SD</option>
                              <option value="2">SMP</option>
                              <option value="3">SMA</option>
                              <option value="4">PT</option>
                            </select>
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <label class="small font-weight-bold text-muted mb-1">Anak 2</label>
                            <select class="custom-select" id="Anak2">
                              <option value="0">- Pilih -</option>
                              <option value="1">SD</option>
                              <option value="2">SMP</option>
                              <option value="3">SMA</option>
                              <option value="4">PT</option>
                            </select>
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <label class="small font-weight-bold text-muted mb-1">Anak 3</label>
                            <select class="custom-select" id="Anak3">
                              <option value="0">- Pilih -</option>
                              <option value="1">SD</option>
                              <option value="2">SMP</option>
                              <option value="3">SMA</option>
                              <option value="4">PT</option>
                            </select>
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <label class="small font-weight-bold text-muted mb-1">Anak 4</label>
                            <select class="custom-select" id="Anak4">
                              <option value="0">- Pilih -</option>
                              <option value="1">SD</option>
                              <option value="2">SMP</option>
                              <option value="3">SMA</option>
                              <option value="4">PT</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 14. Beasiswa Pendidikan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Beasiswa">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #14</span>
                        <div class="q-text">14. Apakah untuk pendidikan anak-anak mendapatkan beasiswa/bantuan pendidikan?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Beasiswa" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 15. Jenis Beasiswa -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JenisBeasiswa">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #15</span>
                        <div class="q-text">15. Jika iya, jenis beasiswa/bantuan pendidikan apa yang didapatkan? (Boleh pilih lebih dari satu)</div>
                      </div>
                      <div class="p-3">
                        <?php $JenisBeasiswa = array('KIP','Uang saku pelajar miskin','Garda Ampuh','Banyuwangi Cerdas'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($JenisBeasiswa); $j++) { ?>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$JenisBeasiswa[$j]?>" name="JenisBeasiswa" id="JenisBeasiswa<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="JenisBeasiswa<?=$j?>"><?=$JenisBeasiswa[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="JenisBeasiswaLainnya" placeholder="Sebutkan jenis beasiswa lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 16. Bentuk Beasiswa -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_BentukBeasiswa">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #16</span>
                        <div class="q-text">16. Berupa bentuk apa pemberian beasiswa/bantuan pendidikan yang didapatkan?</div>
                      </div>
                      <div class="p-3">
                        <?php $BentukBeasiswa = array('Bantuan SPP','Alat Tulis','Bantuan Seragam','Uang Saku'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($BentukBeasiswa); $j++) { ?>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$BentukBeasiswa[$j]?>" name="BentukBeasiswa" id="BentukBeasiswa<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="BentukBeasiswa<?=$j?>"><?=$BentukBeasiswa[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="BentukBeasiswaLainnya" placeholder="Sebutkan bentuk bantuan lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 17. Bekerja Seminggu Lalu -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_SemingguKerja">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #17</span>
                        <div class="q-text">17. Apakah Bapak/Ibu/Sdr dalam seminggu yang lalu masih bekerja?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="SemingguKerja" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 18. Status Pekerjaan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_StatusKerja">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #18</span>
                        <div class="q-text">18. Jika bekerja, apa status pekerjaan Ibu/Bapak/Sdr?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="StatusKerja" style="max-width: 320px;">
                          <option value="1">Usaha sendiri</option>
                          <option value="2">Karyawan swasta</option>
                          <option value="3">Karyawan pemerintah</option>
                          <option value="4">Pekerja di sektor pertanian</option>
                          <option value="5">Pekerja di sektor non pertanian</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 19. Kegiatan Terbanyak Seminggu Lalu -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_KegiatanSeminggu">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #19</span>
                        <div class="q-text">19. Apakah kegiatan terbanyak yang Ibu/Bapak/Sdr lakukan selama seminggu yang lalu?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="KegiatanSeminggu" style="max-width: 320px;">
                          <option value="1">Mencari pekerjaan</option>
                          <option value="2">Bersekolah</option>
                          <option value="3">Mengurus rumah tangga</option>
                          <option value="4">Pensiun/sudah tua</option>
                          <option value="5">Sakit/cacat</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 20. Pendapatan Per Bulan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Pendapatan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #20</span>
                        <div class="q-text">20. Berapa pendapatan Ibu/Bapak/Sdr per bulannya?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 280px;">
                          <div class="input-group-prepend"><span class="input-group-text font-weight-bold">Rp</span></div>
                          <input class="form-control" type="text" id="Pendapatan" placeholder="Input angka pendapatan">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 21. Anggota Keluarga Bekerja -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Anggota">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #21</span>
                        <div class="q-text">21. Berapa orang anggota keluarga yang bekerja?</div>
                      </div>
                      <div class="p-3">
                        <input class="form-control" type="text" id="Anggota" placeholder="Input jumlah orang (angka)" style="max-width: 250px;">
                      </div>
                    </div>
                  </div>

                  <!-- 22. Total Pendapatan Keluarga -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_TotalPendapatan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #22</span>
                        <div class="q-text">22. Berapa total pendapatan keluarga ini selama sebulan?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 280px;">
                          <div class="input-group-prepend"><span class="input-group-text font-weight-bold">Rp</span></div>
                          <input class="form-control" type="text" id="TotalPendapatan" placeholder="Total pendapatan (angka)">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 23. Pendapatan Sebelum & Sesudah BBM -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_PendapatanBBM">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #23</span>
                        <div class="q-text">23. Berapa pendapatan Anda sebelum dan sesudah adanya kenaikan BBM?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-6 mb-2 mb-md-0">
                            <label class="small font-weight-bold text-muted mb-1">Sebelum Kenaikan BBM</label>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text font-weight-bold">Rp</span></div>
                              <input class="form-control" type="text" id="PendapatanSebelum" placeholder="Pendapatan sebelum">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="small font-weight-bold text-muted mb-1">Sesudah Kenaikan BBM</label>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text font-weight-bold">Rp</span></div>
                              <input class="form-control" type="text" id="PendapatanSesudah" placeholder="Pendapatan sesudah">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 24. Jam Kerja Sebelum & Sesudah BBM -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JamBBM">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #24</span>
                        <div class="q-text">24. Berapa jam kerja Anda per hari sebelum dan sesudah adanya kenaikan BBM?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-6 mb-2 mb-md-0">
                            <label class="small font-weight-bold text-muted mb-1">Sebelum Kenaikan BBM</label>
                            <div class="input-group">
                              <input class="form-control" type="text" id="JamSebelum" placeholder="Jam kerja sebelum">
                              <div class="input-group-append"><span class="input-group-text font-weight-bold">Jam/Hari</span></div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="small font-weight-bold text-muted mb-1">Sesudah Kenaikan BBM</label>
                            <div class="input-group">
                              <input class="form-control" type="text" id="JamSesudah" placeholder="Jam kerja sesudah">
                              <div class="input-group-append"><span class="input-group-text font-weight-bold">Jam/Hari</span></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 25. Pernah Pelatihan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Pelatihan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #25</span>
                        <div class="q-text">25. Apakah selama setahun ini Ibu/Bapak/Sdr pernah mendapatkan pelatihan?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Pelatihan" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 26. Jenis Pelatihan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_JenisPelatihan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #26</span>
                        <div class="q-text">26. Jika iya, pelatihan apa yang pernah diikuti?</div>
                      </div>
                      <div class="p-3">
                        <?php $JenisPelatihan = array('Pengolahan Produk','Menjahit','Teknologi'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($JenisPelatihan); $j++) { ?>
                          <div class="col-md-4 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$JenisPelatihan[$j]?>" name="JenisPelatihan" id="JenisPelatihan<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="JenisPelatihan<?=$j?>"><?=$JenisPelatihan[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="JenisPelatihanLainnya" placeholder="Sebutkan jenis pelatihan lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 27. Buka Usaha dari Pelatihan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_BukaUsaha">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #27</span>
                        <div class="q-text">27. Dari pelatihan yang didapatkan, apakah Ibu/Bapak/Sdr ingin menggunakannya untuk membuka usaha?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-3 mb-2 mb-md-0">
                            <select class="custom-select" id="BukaUsaha">
                              <option value="1">Ya</option>
                              <option value="2">Tidak</option>
                            </select>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" type="text" id="AlasanUsaha" placeholder="Sebutkan alasannya jika ya/tidak">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 28. Kepemilikan Usaha Sendiri -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Usaha">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #28</span>
                        <div class="q-text">28. Apakah Ibu/Bapak/Sdr mempunyai usaha sendiri seperti toko/penyewaan jasa?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Usaha" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 29. Pendapatan Usaha -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_PendapatanUsaha">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #29</span>
                        <div class="q-text">29. Berapakah kisaran pendapatan Anda dari usaha tersebut selama sebulan terakhir?</div>
                      </div>
                      <div class="p-3">
                        <div class="input-group" style="max-width: 280px;">
                          <div class="input-group-prepend"><span class="input-group-text font-weight-bold">Rp</span></div>
                          <input class="form-control" type="text" id="PendapatanUsaha" placeholder="Pendapatan usaha (angka)">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 30. Usaha Sebelum & Sesudah BBM -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_UsahaBBM">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #30</span>
                        <div class="q-text">30. Berapakah pendapatan dari usaha Anda sebelum dan sesudah adanya kenaikan BBM?</div>
                      </div>
                      <div class="p-3">
                        <div class="row">
                          <div class="col-md-6 mb-2 mb-md-0">
                            <label class="small font-weight-bold text-muted mb-1">Sebelum Kenaikan BBM</label>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text font-weight-bold">Rp</span></div>
                              <input class="form-control" type="text" id="UsahaSebelum" placeholder="Pendapatan sebelum">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="small font-weight-bold text-muted mb-1">Sesudah Kenaikan BBM</label>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text font-weight-bold">Rp</span></div>
                              <input class="form-control" type="text" id="UsahaSesudah" placeholder="Pendapatan sesudah">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 31. Modal Usaha -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Modal">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #31</span>
                        <div class="q-text">31. Apakah dengan modal yang Anda miliki sekarang dapat dilakukan untuk: Pembelian peralatan/perlengkapan usaha, Perluasan tempat usaha?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Modal" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 32. Bantuan Usaha -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_BantuanUsaha">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #32</span>
                        <div class="q-text">32. Apakah Anda pernah mendapatkan bantuan untuk usaha Anda?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="BantuanUsaha" style="max-width: 250px;">
                          <option value="1">Ya</option>
                          <option value="2">Tidak</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 33. Asal Bantuan Usaha -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_AsalBantuan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #33</span>
                        <div class="q-text">33. Berasal dari bantuan apa yang pernah Anda dapatkan untuk usaha Anda?</div>
                      </div>
                      <div class="p-3">
                        <?php $AsalBantuan = array('BLT Mikro','Koperasi'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($AsalBantuan); $j++) { ?>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$AsalBantuan[$j]?>" name="AsalBantuan" id="AsalBantuan<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="AsalBantuan<?=$j?>"><?=$AsalBantuan[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="AsalBantuanLainnya" placeholder="Sebutkan asal bantuan lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 34. Bentuk Bantuan Usaha -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_BentukBantuan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #34</span>
                        <div class="q-text">34. Dalam bentuk apa bantuan tersebut yang diberikan?</div>
                      </div>
                      <div class="p-3">
                        <?php $BentukBantuan = array('Uang','Peralatan Usaha'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($BentukBantuan); $j++) { ?>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$BentukBantuan[$j]?>" name="BentukBantuan" id="BentukBantuan<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="BentukBantuan<?=$j?>"><?=$BentukBantuan[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="BentukBantuanLainnya" placeholder="Sebutkan bentuk bantuan lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 35. Kondisi Darurat -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Darurat">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #35</span>
                        <div class="q-text">35. Dalam kondisi darurat, biasanya tindakan/perilaku apa yang Bapak/Ibu ambil untuk menangani hal tersebut?</div>
                      </div>
                      <div class="p-3">
                        <select class="custom-select" id="Darurat" style="max-width: 250px;">
                          <option value="1">Pinjaman</option>
                          <option value="2">Tabungan</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- 36. Bentuk Tabungan -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_BentukTabungan">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #36</span>
                        <div class="q-text">36. Jika menggunakan tabungan, tabungan dalam bentuk apa yang dimiliki?</div>
                      </div>
                      <div class="p-3">
                        <?php $BentukTabungan = array('Emas','Ternak','Sawah'); ?>
                        <div class="row mb-2">
                          <?php for ($j=0; $j < count($BentukTabungan); $j++) { ?>
                          <div class="col-md-3 col-sm-6 mb-2">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" value="<?=$BentukTabungan[$j]?>" name="BentukTabungan" id="BentukTabungan<?=$j?>">
                              <label class="custom-control-label font-weight-bold text-dark" for="BentukTabungan<?=$j?>"><?=$BentukTabungan[$j]?></label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <input class="form-control" type="text" id="BentukTabunganLainnya" placeholder="Sebutkan bentuk tabungan lainnya jika ada">
                      </div>
                    </div>
                  </div>

                  <!-- 37. Saran -->
                  <div class="col-12 mb-3">
                    <div class="question-box" id="qBox_Saran">
                      <div class="q-header">
                        <span class="q-number-pill">Pertanyaan #37</span>
                        <div class="q-text">37. Saran dan Harapan terhadap Pemerintah Setempat terkait Dampak Kebijakan BBM</div>
                      </div>
                      <div class="p-3">
                        <textarea class="form-control" id="Saran" rows="3" placeholder="Tuliskan saran dan masukan Anda di sini..."></textarea>
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
          var Komoditas = []
          for (let i = 0; i < 154; i++) {
            Komoditas.push($("#_Agustus"+i).val()+'$'+$("#Agustus"+i).val()+'$'+$("#_Sekarang"+i).val()+'$'+$("#Sekarang"+i).val())
          }
          var Konsumsi = Komoditas.join("|")
          var Poin = []
          Poin.push($("#Mencukupi").val())
          Poin.push($("#Memberatkan").val())
          var Tampung = []
          $.each($("input[name='Bansos']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#BansosLainnya").val())
          Poin.push(Tampung.join("$"))
          Poin.push($("#Manfaat").val())
          Poin.push($("#Anak").val())
          Poin.push($("#JumlahAnak").val())
          $("#Kesehatan").val() == '2' ? Poin.push($("#KesehatanLainnya").val()) : Poin.push($("#Kesehatan").val())
          Poin.push($("#Riwayat").val())
          Poin.push($("#Biaya").val())
          var Tampung = []
          $.each($("input[name='Berobat']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#BerobatLainnya").val())
          Poin.push(Tampung.join("$"))
          Poin.push($("#AlasanBerobat").val())
          Poin.push($("#AnakSekolah").val())
          Poin.push($("#Anak1").val()+'$'+$("#Anak2").val()+'$'+$("#Anak3").val()+'$'+$("#Anak4").val())
          Poin.push($("#Beasiswa").val())
          var Tampung = []
          $.each($("input[name='JenisBeasiswa']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#JenisBeasiswaLainnya").val())
          Poin.push(Tampung.join("$"))
          var Tampung = []
          $.each($("input[name='BentukBeasiswa']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#BentukBeasiswaLainnya").val())
          Poin.push(Tampung.join("$"))
          Poin.push($("#SemingguKerja").val())
          Poin.push($("#StatusKerja").val())
          Poin.push($("#KegiatanSeminggu").val())
          Poin.push($("#Pendapatan").val())
          Poin.push($("#Anggota").val())
          Poin.push($("#TotalPendapatan").val())
          Poin.push($("#PendapatanSebelum").val()+'$'+$("#PendapatanSesudah").val())
          Poin.push($("#JamSebelum").val()+'$'+$("#JamSesudah").val())
          Poin.push($("#Pelatihan").val())
          var Tampung = []
          $.each($("input[name='JenisPelatihan']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#JenisPelatihanLainnya").val())
          Poin.push(Tampung.join("$"))
          Poin.push($("#BukaUsaha").val()+'$'+$("#AlasanUsaha").val())
          Poin.push($("#Usaha").val())
          Poin.push($("#PendapatanUsaha").val())
          Poin.push($("#UsahaSebelum").val()+'$'+$("#UsahaSesudah").val())
          Poin.push($("#Modal").val())
          Poin.push($("#BantuanUsaha").val())
          var Tampung = []
          $.each($("input[name='AsalBantuan']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#AsalBantuanLainnya").val())
          Poin.push(Tampung.join("$"))
          var Tampung = []
          $.each($("input[name='BentukBantuan']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#BentukBantuanLainnya").val())
          Poin.push(Tampung.join("$"))
          Poin.push($("#Darurat").val())
          var Tampung = []
          $.each($("input[name='BentukTabungan']:checked"), function(){
            Tampung.push($(this).val())
          })
          Tampung.push($("#BentukTabunganLainnya").val())
          Poin.push(Tampung.join("$"))
          var Nilai = Poin.join("|")
          var BBM = { Nama: $("#Nama").val(),
                      Usia: $("#Usia").val(),
                      Pendidikan: $("#Pendidikan").val(),
                      Kecamatan: $("#Kecamatan").val(),
                      Desa: $("#Desa").val(),
                      Alamat: $("#Alamat").val(),
                      Saran: $("#Saran").val(),
                      Konsumsi: Konsumsi,
                      Nilai: Nilai }                  
          var Konfirmasi = confirm("Klik Batal Cek Kembali Data & Pastikan Sudah Benar Sebelum Menyimpan! Ok Untuk Simpan!"); 
      		if (Konfirmasi == true) {                                            
            $("#Simpan").attr("disabled", true);                              
            $("#LoadingInput").show();
            $.post(BaseURL+"Surveyor/InputDampakBBM", BBM).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/DampakBBM"
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