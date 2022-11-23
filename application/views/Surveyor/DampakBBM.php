				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="card"> 
                    <div class="card-header bg-primary text-white">
                      <b>PERSEPSI RUMAH TANGGA</b>
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
                                <label class="input-group-text bg-danger text-white"><b>Pendidikan</b></label>
                              </div>
                              <input class="form-control" type="text" id="Pendidikan">
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
                          <div class="col-sm-12 mt-2">
                            <div class="card">
                              <div class="card-header bg-primary text-light py-2">
                                <b>Pengeluaran Konsumsi Makanan & Non Makanan Rumah Tangga Dikonversi Selama Seminggu Sebelum & Sesudah Kenaikan Harga BBM</b>
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
                                              <th style="width: 20%;" class="align-middle">Pengeluaran Agustus</th>
                                              <th style="width: 20%;" class="align-middle">Pengeluaran Sekarang</th>
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
                                            $No = 1; for ($i=0; $i < count($Komoditas); $i++) { ?>
                                              <tr class="text-light text-center align-middle">
                                                <td class="align-middle font-weight-bold"><?=$No++?></td>
                                                <td class="align-middle font-weight-bold"><?=$Komoditas[$i]?></td>
                                                <td><input class="form-control form-control-sm text-center" value="0" type="text" id="Agustus<?=$i?>"></td>
                                                <td><input class="form-control form-control-sm text-center" value="0" type="text" id="Sekarang<?=$i?>"></td>
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
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Melihat perubahan harga saat ini, menurut perkiraan Ibu/Bapak/Sdr dalam 1 tahun mendatang, apakah Ibu/Bapak/Sdr akan dapat mencukupi kebutuhan sehari-hari dengan?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Mencukupi">                    
                                <option value="1">Sangat Mudah</option>
                                <option value="2">Mudah</option>
                                <option value="3">Sulit</option>
                                <option value="4">Sangat Sulit</option>
                              </select>
                            </div>
                          </div> 
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Pengeluaran dalam konsumsi apa yang paling memberatkan anda?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Memberatkan">                    
                                <option value="1">Makanan</option>
                                <option value="2">Non Makanan</option>
                              </select>
                            </div>
                          </div> 
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jenis Bantuan Sosial apa yang pernah diterima ibu/bapak/sdr?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $Bansos = array('PKH','BLT Dana Desa','BPJS Kesehatan/KIS','BPNT','Gancang Aron','Rantang Kasih','Kanggo riko'); ?>
                            <?php for ($j=0; $j < count($Bansos); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$Bansos[$j]?>" name="Bansos" id="Bansos<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="Bansos<?=$j?>"><?=$Bansos[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="BansosLainnya" placeholder="Sebutkan Lainnya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Manfaat apa yang selama ini anda rasakan setelah mendapat bantuan tersebut?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="Manfaat">
                            </div>
                          </div> 
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah ibu/bapak/sdr mempunyai anak yang masih dalam tanggung jawab keluarga?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Anak">                    
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika iya, berapa anak yang anda miliki yang masih jadi tanggung jawab keluarga?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="JumlahAnak" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Bagaimana kondisi kesehatan ibu/bapak/sdr selama sebulan lalu?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Kesehatan">                    
                                <option value="1">Sehat</option>
                                <option value="2">Tidak Sehat</option>
                              </select>
                            </div>
                            <input class="form-control" type="text" id="KesehatanLainnya" placeholder="Karena Sakit Apa?">
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah ada riwayat sakit yang diderita anggota keluarga selama ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Riwayat">                    
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika iya, berapa kisaran biaya pengobatannya?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="Biaya" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Dimanakah biasanya periksa jika sakit?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $Berobat = array('Rumah Sakit','Puskesmas','Bidan','Mantri','Dokter'); ?>
                            <?php for ($j=0; $j < count($Berobat); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$Berobat[$j]?>" name="Berobat" id="Berobat<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="Berobat<?=$j?>"><?=$Berobat[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="BerobatLainnya" placeholder="Sebutkan Lainnya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Mengapa memilih berobat di tempat tersebut?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="AlasanBerobat" placeholder="Sebutkan Alasannya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah masih ada anak yang bersekolah dalam keluarga ini?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="AnakSekolah" style="width: 50%;">
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berada pada tingkatan pendidikan (SD/SMP/SMA/PT) apa yang sedang ditempuh anak anda sekarang?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Anak 1</b></label>
                              </div>
                              <select class="custom-select custom-select-sm" id="Anak1" style="width: 50%;">
                                <option value="0">Pilih</option>
                                <option value="1">SD</option>
                                <option value="2">SMP</option>
                                <option value="3">SMA</option>
                                <option value="4">PT</option>
                              </select>
                            </div>
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Anak 2</b></label>
                              </div>
                              <select class="custom-select custom-select-sm" id="Anak2" style="width: 50%;">
                                <option value="0">Pilih</option>
                                <option value="1">SD</option>
                                <option value="2">SMP</option>
                                <option value="3">SMA</option>
                                <option value="4">PT</option>
                              </select>
                            </div>
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Anak 3</b></label>
                              </div>
                              <select class="custom-select custom-select-sm" id="Anak3" style="width: 50%;">
                                <option value="0">Pilih</option>
                                <option value="1">SD</option>
                                <option value="2">SMP</option>
                                <option value="3">SMA</option>
                                <option value="4">PT</option>
                              </select>
                            </div>
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Anak 4</b></label>
                              </div>
                              <select class="custom-select custom-select-sm" id="Anak4" style="width: 50%;">
                                <option value="0">Pilih</option>
                                <option value="1">SD</option>
                                <option value="2">SMP</option>
                                <option value="3">SMA</option>
                                <option value="4">PT</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah untuk pendidikan anak-anak mendapatkan beasiswa/bantuan pendidikan?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Beasiswa" style="width: 50%;">
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika iya, jenis beasiswa/bantuan pendidikan apa yang didapatkan?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $JenisBeasiswa = array('KIP','Uang saku pelajar miskin','Garda Ampuh','Banyuwangi Cerdas'); ?>
                            <?php for ($j=0; $j < count($JenisBeasiswa); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$JenisBeasiswa[$j]?>" name="JenisBeasiswa" id="JenisBeasiswa<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="JenisBeasiswa<?=$j?>"><?=$JenisBeasiswa[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="JenisBeasiswaLainnya" placeholder="Sebutkan Lainnya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berupa bentuk apa pemberian beasiswa/bantuan pendidikan yang didapatkan?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $BentukBeasiswa = array('Bantuan SPP','Alat Tulis','Bantuan Seragam','Uang Saku'); ?>
                            <?php for ($j=0; $j < count($BentukBeasiswa); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$BentukBeasiswa[$j]?>" name="BentukBeasiswa" id="BentukBeasiswa<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="BentukBeasiswa<?=$j?>"><?=$BentukBeasiswa[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="BentukBeasiswaLainnya" placeholder="Sebutkan Lainnya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah bapak/ibu/sdr dalam seminggu yang lalu masih bekerja?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="SemingguKerja" style="width: 50%;">
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika bekerja, Apa status pekerjaan ibu/bapak/sdr?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="StatusKerja" style="width: 50%;">
                                <option value="1">Usaha sendiri</option>
                                <option value="2">karyawan swasta</option>
                                <option value="3">karyawan pemerintah</option>
                                <option value="4">Pekerja disektor pertanian</option>
                                <option value="5">Pekerja disektor non pertanian</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah kegiatan terbanyak ibu/bapak/sdr lakukan selama seminggu yang lalu?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="KegiatanSeminggu" style="width: 50%;">
                                <option value="1">Mencari pekerjaan</option>
                                <option value="2">Bersekolah</option>
                                <option value="3">Mengurus rumah tangga</option>
                                <option value="4">Pensiun/sudah tua</option>
                                <option value="5">Sakit/cacat</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa pendapatan ibu/bapak/sdr per bulannya?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="Pendapatan" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa orang anggota keluarga yang bekerja?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="Anggota" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa total pendapatan keluarga ini selama sebulan?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="TotalPendapatan" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa pendapatan anda sebelum dan sesudah adanya kenaikan BBM?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Sebelum</b></label>
                              </div>
                              <input class="form-control" type="text" id="PendapatanSebelum" placeholder="Input Hanya Boleh Angka">
                            </div>    
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Sesudah</b></label>
                              </div>
                              <input class="form-control" type="text" id="PendapatanSesudah" placeholder="Input Hanya Boleh Angka">
                            </div>    
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapa jam kerja anda sebelum dan sesudah adanya kenaikan BBM?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Sebelum</b></label>
                              </div>
                              <input class="form-control" type="text" id="JamSebelum" placeholder="Input Hanya Boleh Angka">
                            </div>    
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Sesudah</b></label>
                              </div>
                              <input class="form-control" type="text" id="JamSesudah" placeholder="Input Hanya Boleh Angka">
                            </div>    
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah selama setahun ini ibu/bapak/sdr pernah mendapatkan pelatihan?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Pelatihan" style="width: 50%;">
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika iya, pelatihan apa yang pernah diikuti?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $JenisPelatihan = array('Pengolahan Produk','Menjahit','Teknologi'); ?>
                            <?php for ($j=0; $j < count($JenisPelatihan); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$JenisPelatihan[$j]?>" name="JenisPelatihan" id="JenisPelatihan<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="JenisPelatihan<?=$j?>"><?=$JenisPelatihan[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="JenisPelatihanLainnya" placeholder="Sebutkan Lainnya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Dari pelatihan yang didapatkan, apakah ibu/bapak/sdr ingin menggunakannya untuk membuka usaha?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="BukaUsaha" style="width: 50%;">
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                              <input class="form-control" type="text" id="AlasanUsaha" placeholder="Sebutkan" style="width: 50%;">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah ibu/bapak/sdr mempunyai usaha sendiri seperti toko/penyewaan jasa?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Usaha" style="width: 50%;">
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapakah kisaran pendapatan anda dari usaha tersebut selama sebulan terakhir?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="PendapatanUsaha" placeholder="Input Hanya Boleh Angka">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berapakah pendapatan dari usaha anda sebelum dan sesudah adanya kenaikan BBM?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Sebelum</b></label>
                              </div>
                              <input class="form-control" type="text" id="UsahaSebelum" placeholder="Input Hanya Boleh Angka">
                            </div>    
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-white"><b>Sesudah</b></label>
                              </div>
                              <input class="form-control" type="text" id="UsahaSesudah" placeholder="Input Hanya Boleh Angka">
                            </div>    
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah dengan modal yang anda miliki sekarang dapat dilakukan untuk : Pembelian peralatan/perlengkapan usaha,Perluasan tempat usaha</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Modal" style="width: 50%;">
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Apakah anda pernah mendapatkan bantuan untuk usaha anda?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="BantuanUsaha" style="width: 50%;">
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Berasal dari bantuan apa yang pernah anda dapatkan untuk usaha anda?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $AsalBantuan = array('BLT Mikro','Koperasi'); ?>
                            <?php for ($j=0; $j < count($AsalBantuan); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$AsalBantuan[$j]?>" name="AsalBantuan" id="AsalBantuan<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="AsalBantuan<?=$j?>"><?=$AsalBantuan[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="AsalBantuanLainnya" placeholder="Sebutkan Lainnya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Dalam bentuk apa bantuan tersebut yang diberikan?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $BentukBantuan = array('Uang','Peralatan Usaha'); ?>
                            <?php for ($j=0; $j < count($BentukBantuan); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$BentukBantuan[$j]?>" name="BentukBantuan" id="BentukBantuan<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="BentukBantuan<?=$j?>"><?=$BentukBantuan[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="BentukBantuanLainnya" placeholder="Sebutkan Lainnya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Dalam kondisi darurat, biasanya tindakan/perilaku apa yang bapak ambil untuk menangani hal tersebut?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <div class="input-group input-group-sm">
                              <select class="custom-select custom-select-sm" id="Darurat" style="width: 50%;">
                                <option value="1">Pinjaman</option>
                                <option value="2">Tabungan</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Jika menggunakan tabungan, tabungan dalam bentuk apa yang dimiliki?</b></p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-sm-6 bg-primary p-2 my-1">
                            <?php $BentukTabungan = array('Emas','Ternak','Sawah'); ?>
                            <?php for ($j=0; $j < count($BentukTabungan); $j++) { ?>
                              <div class="form-check my-2 ml-3">
                                <input class="form-check-input" type="checkbox" value="<?=$BentukTabungan[$j]?>" name="BentukTabungan" id="BentukTabungan<?=$j?>">
                                <label class="form-check-label text-white font-weight-bold" for="BentukTabungan<?=$j?>"><?=$BentukTabungan[$j]?></label>
                              </div>
                            <?php } ?>
                            <div class="input-group input-group-sm">
                              <input class="form-control form-control-sm" type="text" id="BentukTabunganLainnya" placeholder="Sebutkan Lainnya">
                            </div>
                          </div>
                          <div class="col-sm-6 my-1">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <p class="input-group-text bg-danger text-white text-justify text-wrap"><b>Saran terhadap pemerintah setempat</b></p>
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
        
        $("#Kecamatan").change(function (){
          var Desa = { Kode: $("#Kecamatan").val() }
          $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) {
            $('#Desa').html(Respon)
          })    
        }) 
        
        $("#Simpan").click(function() {
          var Komoditas = []
          for (let i = 0; i < 154; i++) {
            Komoditas.push($("#Agustus"+i).val()+'$'+$("#Sekarang"+i).val())
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