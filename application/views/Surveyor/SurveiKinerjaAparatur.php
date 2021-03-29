				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="card-header bg-primary text-light">
                      <b>SURVEI PENGUKURAN KINERJA APARATUR DESA</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-4 my-1">
                            <div class="input-group input-group-sm">
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
                            <div class="input-group input-group-sm">
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
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-light"><b>Jumlah Dusun</b></label>
                              </div>
                              <input class="form-control" type="text" id="Dusun" data-inputmask='"mask": "99"' data-mask>
                            </div>
                          </div> 
                          <b class="ml-3 my-2">Kepala Desa</b>
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 40%;"class="align-middle">Pertanyaan</th>
                                    <th style="width: 56%;"class="align-middle">Opsi</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                <?php 
                                  $Tanya = array('Jam kerja kantor :<br>- Senin – kamis ( 07.00 – 15.30 )<br>- Jumat ( 06.30 – 14.30 )',
                                                'Apakah terdapat buku absensi?',
                                                'Adanya dokumen pemerintah desa?<br>- menyelenggarakan pemerintahan desa, seperti tata praja pemerintahan, penetapan peraturan di desa, pembinaan masalah pertanahan, pembinaan ketentraman dan ketertiban, melakukan upaya perlindungan masyarakat, administrasi kependudukan, dan penataan dan pengelolaan wilayah<br>- melaksanakan pembangunan seperti pembangunan sarana prasarana perdesaan, dan pembangunan bidang pendidikan, kesehatan.<br>- pembinaan kemasyarakatan, seperti pelaksanaan hak dan kewajiban masyarakat, partisipasi masyarakat, sosial budaya masyarakat, keagamaan, dan ketenagakerjaan.<br>- pemberdayaan masyarakat, seperti tugas sosialisasi dan motivasi masyarakat di bidang budaya, ekonomi, politik, lingkungan hidup, pemberdayaan keluarga, pemuda, olahraga, dan karang taruna.<br>- menjaga hubungan kemitraan dengan lembaga masyarakat dan lembaga lainnya.',
                                                'Berapa Pendapatan Asli Desa & Berapa Total Penerimaan Yang di Dapat Desa?'); 
                                  $Opsi = array('Jika aparatur desa masuk selama 181-200 jam kerja dalam sebulan|Jika aparatur desa masuk selama 141-180 jam kerja dalam sebulan|Jika aparatur desa masuk selama 101-140 jam kerja dalam sebulan|Jika aparatur desa masuk selama < 100 jam kerja dalam sebulan',
                                                'Jika aparatur melakukan finger print sebanyak 4 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 3 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 2 kali  dalam sehari|Jika aparatur melakukan finger print sebanyak 1 kali dalam sehari',
                                                'Jika kepala desa menyelesaikan dan melaksanakan semua 5 dokumen|Jika kepala desa menyelesaikan dan melaksanakan 4 dokumen|Jika kepala desa menyelesaikan dan melaksanakan 3 dokumen|Jika kepala desa menyelesaikan dan melaksanakan < 3 dokumen',
                                                'Pendapatan Asli Desa|Total Penerimaan Desa');                              
                                $No = 1; for ($i=0; $i < count($Tanya); $i++) { $Pisah = explode("|",$Opsi[$i]); ?>
                                  <tr class="text-light">
                                    <td class="text-center font-weight-bold"><?=$No++?></td>
                                    <td class="text-justify font-weight-bold"><?=$Tanya[$i]?></td>
                                    <td class="text-left">
                                      <?php if (count($Pisah) == 4) { ?>
                                        <?php for ($j=0; $j < 4; $j++) { ?>
                                          <div class="form-check form-check-inline ml-4 my-1">
                                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="KepalaDesa<?=$i?>" id="KepalaDesa<?=$i.$j?>" value="<?=(4-$j)?>">
                                            <label class="form-check-label font-weight-bold" for="KepalaDesa<?=$i.$j?>">&nbsp;<?=$Pisah[$j]?></label>
                                          </div>
                                        <?php } ?>
                                      <?php } else if (count($Pisah) <= 2) { ?>
                                        <?php for ($j=0; $j < count($Pisah); $j++) { ?>
                                          <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                              <label class="input-group-text bg-danger text-light"><b><?=$Pisah[$j]?></b></label>
                                            </div>
                                            <input class="form-control form-control-sm" type="text" value="0" id="KepalaDesa<?=$i.$j?>" placeholder="Input Hanya Angka Saja">
                                          </div>
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                          <b class="ml-3 my-2">SEKERTARIS DESA</b>
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 40%;"class="align-middle">Pertanyaan</th>
                                    <th style="width: 56%;"class="align-middle">Opsi</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                <?php 
                                  $Tanya = array('Jam kerja kantor :<br>- Senin – kamis ( 07.00 – 15.30 )<br>- Jumat ( 06.30 – 14.30 )',
                                                'Apakah terdapat buku absensi?',
                                                'Adanya dokumen urusan ketatausahaan<br>- tata naskah,<br>- administrasi surat menyurat, <br>- arsip, <br>- ekspedisi',
                                                'Adanya dokumen urusan umum<br>- penataan administrasi, <br>- penyediaan prasarana perangkat desa dan kantor, <br>- penyiapan rapat, <br>- pengadministrasian aset, <br>- inventarisasi, <br>- perjalanan dinas, <br>- pelayanan umum',
                                                'Adanya dokumen urusan keuangan<br>- pengurusan administrasi keuangan, <br>- administrasi sumber – sumber pendapatan dan pengeluaran, <br>- verifikasi administrasi keuangan, <br>- administrasi penghasilan kepala desa, <br>- administrasi  penghasilan perangkat desa, <br>- administrasi penghasilan BPD, <br>- administrasi penghasilan lembaga pemerintahan desa',
                                                'Adanya dokumen urusan perencanaan<br>- rencana anggaran pendapatan dan belanja desa, <br>- menginventarisir data – data dalam rangka pembangunan, <br>- melakukan monitoring dan evaluasi program, <br>- penyusunan laporan)',
                                                'Apakah dari ke-13 dokumen dari sekertaris desa sudah dijalankan ?<br>- mengoordinasikan penyusunan rumusan kebijakan dan program kerja pemerintahan desa/dusun<br>- menyusun rancangan produk hukum desa<br>- mengundangkan produk hukum desa<br>- mengoordinasikan pelaksanaan kegiatan evaluasi dan pelaporan penyelenggaraan pemerintahan desa<br>- mengoordinasikan pelaksanaan tugas perangkat desa lainnya<br>- menyelenggarakan tugas kesekretariatan desa<br>- memberikan pelayanan administrasi <br>- melaksanakan penatausahaan keuagan dan aset desa dan mengelola administrasi aparatur pemerintahan desa<br>- mengumumkan/menyebarluaskan informasi dan produk hukum desa kepada masyarakat<br>- mengumumkan/menyebarluaskan informasi dan produk hukum desa kepada masyarakat <br>- melaksanakan urusan rumah tangga, perawatan sarana dan prasarana fisik pemerintah desa<br>- mengoordinasikan pelaksanaan seleksi perangkat desa<br>- mengoordinasikan pelaksanaan musyawarah desa<br>- melaksanakan tugas lain yang diberikan oleh kepala desa',
                                                'Berapa jumlah kegiatan yang terealisasikan & Berapa jumlah kegiatan yang ditargetkan?',
                                                'Berapa jumlah realisasi anggaran yang digunakan & Berapa jumlah pagu anggaran Yang di dapat?',
                                                'berapa jumlah anggaran yang terealisasi & berapa jumlah anggaran belanja yang didapat?'); 
                                  $Opsi = array('Jika aparatur desa masuk selama 181-200 jam kerja dalam sebulan|Jika aparatur desa masuk selama 141-180 jam kerja dalam sebulan|Jika aparatur desa masuk selama 101-140 jam kerja dalam sebulan|Jika aparatur desa masuk selama < 100 jam kerja dalam sebulan',
                                                'Jika aparatur melakukan finger print sebanyak 4 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 3 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 2 kali  dalam sehari|Jika aparatur melakukan finger print sebanyak 1 kali dalam sehari',
                                                'Jika sekretaris desa menyelesaikan 4 dokumen|Jika sekretaris desa menyelesaikan 3 dokumen|Jika sekretaris desa menyelesaikan 2 dokumen|Jika sekretaris desa menyelesaikan 1 dokumen',
                                                'Jika sekretaris desa menyelesaikan 7 dokumen|Jika sekretaris desa menyelesaikan 6 dokumen|Jika sekretaris desa menyelesaikan 5 dokumen|Jika sekretaris desa menyelesaikan < 5 dokumen',
                                                'Jika sekretaris desa menyelesaikan 7 dokumen|Jika sekretaris desa menyelesaikan 6 dokumen|Jika sekretaris desa menyelesaikan 5 dokumen|Jika sekretaris desa menyelesaikan < 5 dokumen',
                                                'Jika sekretaris desa menyelesaikan 4 dokumen|Jika sekretaris desa menyelesaikan 3 dokumen|Jika sekretaris desa menyelesaikan 2 dokumen|Jika sekretaris desa menyelesaikan 1 dokumen',
                                                'Apablia sekertaris desa melaksanakan semua dokumen|Jika sekertaris desa melaksanakan 10-12 dokumen|Jika sekertaris desa melaksanakan 7-9 dokumen|Jika sekertaris desa melaksanakan <= 6 dokumen',
                                                'jumlah kegiatan yang terealisasikan|jumlah kegiatan yang ditargetkan',
                                                'realisasi anggaran yang digunakan|jumlah pagu anggaran Yang di dapat',
                                                'jumlah anggaran yang terealisasi|jumlah anggaran belanja yang didapat');                              
                                $No = 1; for ($i=0; $i < count($Tanya); $i++) { $Pisah = explode("|",$Opsi[$i]); ?>
                                  <tr class="text-light">
                                    <td class="text-center font-weight-bold"><?=$No++?></td>
                                    <td class="text-justify font-weight-bold"><?=$Tanya[$i]?></td>
                                    <td class="text-left">
                                      <?php if (count($Pisah) == 4) { ?>
                                        <?php for ($j=0; $j < 4; $j++) { ?>
                                          <div class="form-check form-check-inline ml-4 my-1">
                                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="SekertarisDesa<?=$i?>" id="SekertarisDesa<?=$i.$j?>" value="<?=(4-$j)?>">
                                            <label class="form-check-label font-weight-bold" for="SekertarisDesa<?=$i.$j?>">&nbsp;<?=$Pisah[$j]?></label>
                                          </div>
                                        <?php } ?>
                                      <?php } else if (count($Pisah) <= 2) { ?>
                                        <?php for ($j=0; $j < count($Pisah); $j++) { ?>
                                          <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                              <label class="input-group-text bg-danger text-light"><b><?=$Pisah[$j]?></b></label>
                                            </div>
                                            <input class="form-control form-control-sm" type="text" value="0" id="SekertarisDesa<?=$i.$j?>" placeholder="Input Hanya Angka Saja">
                                          </div>
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                          <b class="ml-3 my-2">KEPALA URUSAN TATA USAHA DAN UMUM</b>
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 40%;"class="align-middle">Pertanyaan</th>
                                    <th style="width: 56%;"class="align-middle">Opsi</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                <?php 
                                  $Tanya = array('Jam kerja kantor :<br>- Senin – kamis ( 07.00 – 15.30 )<br>- Jumat ( 06.30 – 14.30 )',
                                                'Apakah terdapat buku absensi?',
                                                'Adanya dokumen urusan pelaksanaan teknis <br>- melakukan administrasi surat masuk dan surat keluar;<br>- melaksanakan pencatatan dan menginventarisasi aset desa;<br>- melakukan penataan arsip desa;<br>- melaksanakan administrasi aparatur pemerintah desa;<br>- melaksanakan pengelolaan perpustakaan desa;<br>- melaksanakan urusan penyediaan prasarana perangkat desa dan kantor;<br>- melaksanakan administrasi perjalanan dinas;<br>- mempersiapkan sarana rapat/pertemuan, upacara resmi dan lain-lain kegiatan pemerintah desa.<br>- fasilitasi penyelenggaraan musyawarah desa;<br>- melaksanakan tugas lain yang diberikan oleh pimpinan.',
                                                'Berapa jumlah kegiatan yang terealisasikan & Berapa jumlah kegiatan yang ditargetka ?',
                                                'Berapa jumlah realisasi anggaran & Berapa jumlah pagu anggaran?',
                                                'Penyediaan Penghasilan Tetap dan Tunjangan Kepala Desa',
                                                'Penyediaan Penghasilan Tetap dan Tunjangan Perangkat Desa',
                                                'Penyediaan Jaminan Sosial bagi Kepala Desa dan Perangkat Desa',
                                                'Penyediaan Operasional Pemerintah Desa (ATK, Honorarium PKPKD dan PPKD, perlengkapan perkantoran, pakaian dinas/atribut, listrik/telpon, dll)',
                                                'Penyediaan Tunjangan BPD',
                                                'Penyediaan Operasional BPD (ATK, perlengkapan perkantoran, Pakaian Seragam, listrik/telpon, dll)',
                                                'Penyediaan Insentif/Operasional RT/RW',
                                                'Lain-lain Sub Bidang Penyelenggaraan Belanja Penghasilan Tetap, Tunjangan dan Operasional Pemerintahan Desa',
                                                'Penyediaan sarana (aset tetap) perkantoran/pemerintahan',
                                                'Pemeliharaan Gedung/Prasarana Kantor Desa',
                                                'Pembangunan/Rehabilitasi/Peningkatan Gedung/Prasarana Kantor Desa',
                                                'lain-lain kegiatan sub bidang sarana dan prasarana pemerintahan Desa',
                                                'Pelayanan administrasi umum dan kependudukan (Surat Pengantar/Pelayanan KTP, Kartu Keluarga, dll)',
                                                'Pengelolaan administrasi dan kearsipan pemerintahan desa',
                                                'Pengelolaan/Administrasi/Inventarisasi/Penilaian Aset Desa',
                                                'Bagaimana ketepatan waktu penyelesaian dokumen semua dokumen ?'); 
                                  $Opsi = array('Jika aparatur desa masuk selama 181-200 jam kerja dalam sebulan|Jika aparatur desa masuk selama 141-180 jam kerja dalam sebulan|Jika aparatur desa masuk selama 101-140 jam kerja dalam sebulan|Jika aparatur desa masuk selama < 100 jam kerja dalam sebulan',
                                                'Jika aparatur melakukan finger print sebanyak 4 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 3 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 2 kali  dalam sehari|Jika aparatur melakukan finger print sebanyak 1 kali dalam sehari',
                                                'Jika kepala seksi pemerintahan menyelesaikan 10 dokumen|Jika kepala seksi pemerintahan menyelesaikan 7-9 dokumen |Jika kepala seksi pemerintahan menyelesaikan 3-6 dokumen |Jika kepala seksi pemerintahan menyelesaikan < 3 dokumen',
                                                'jumlah kegiatan yang terealisasikan|jumlah kegiatan yang ditargetkan',
                                                'jumlah realisasi anggaran|Berapa jumlah pagu anggaran',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Menyelesaikan dokumen tepat waktu tanggal penetapan|Menyelesaikan dokumen lebih dari 1 minggu waktu tanggal penetapan|Menyelesaikan dokumen lebih dari 2 minggu waktu tanggal penetapan|Menyelesaikan dokumen lebih dari 3 minggu waktu tanggal penetapan');                              
                                $No = 1; for ($i=0; $i < count($Tanya); $i++) { $Pisah = explode("|",$Opsi[$i]); ?>
                                  <tr class="text-light">
                                    <td class="text-center font-weight-bold"><?=$No++?></td>
                                    <td class="text-justify font-weight-bold"><?=$Tanya[$i]?></td>
                                    <td class="text-left">
                                      <?php if (count($Pisah) == 4) { ?>
                                        <?php for ($j=0; $j < 4; $j++) { ?>
                                          <div class="form-check form-check-inline ml-4 my-1">
                                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="TU<?=$i?>" id="TU<?=$i.$j?>" value="<?=(4-$j)?>">
                                            <label class="form-check-label font-weight-bold" for="TU<?=$i.$j?>">&nbsp;<?=$Pisah[$j]?></label>
                                          </div>
                                        <?php } ?>
                                      <?php } else if (count($Pisah) <= 2) { ?>
                                        <?php for ($j=0; $j < count($Pisah); $j++) { ?>
                                          <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                              <label class="input-group-text bg-danger text-light"><b><?=$Pisah[$j]?></b></label>
                                            </div>
                                            <input class="form-control form-control-sm" type="text" value="0" id="TU<?=$i.$j?>" placeholder="Input Hanya Angka Saja">
                                          </div>
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                          <b class="ml-3 my-2">KEPALA URUSAN KEUANGAN</b>
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 40%;"class="align-middle">Pertanyaan</th>
                                    <th style="width: 56%;"class="align-middle">Opsi</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                <?php 
                                  $Tanya = array('Jam kerja kantor :<br>- Senin – kamis ( 07.00 – 15.30 )<br>- Jumat ( 06.30 – 14.30 )',
                                                'Apakah terdapat buku absensi?',
                                                'Adanya dokumen urusan pelaksanaan teknis <br>- menyiapkan bahan penyusunan rancangan APBDesa, perubahan APBDesa dan laporan realisasi APBDesa<br>- mencatat dan menginventarisasi sumber pendapatan desa;<br>- menghimpun, menganalisis, menyajikan, dan memberikan informasi data terkait keuangan Desa;<br>- melaksanakan pengelolaan, pengadministrasian dan pembukuan  keuangan Desa;<br>- melaksanakan tugas lain yang diberikan oleh pimpinan',
                                                'Berapa jumlah kegiatan yang terealisasikan & Berapa jumlah kegiatan yang ditargetkan?',
                                                'Berapa jumlah realisasi anggaran & Berapa jumlah pagu anggaran?',
                                                'Bagaimana ketepatan waktu penyelesaian dokumen semua dokumen ?'); 
                                  $Opsi = array('Jika aparatur desa masuk selama 181-200 jam kerja dalam sebulan|Jika aparatur desa masuk selama 141-180 jam kerja dalam sebulan|Jika aparatur desa masuk selama 101-140 jam kerja dalam sebulan|Jika aparatur desa masuk selama < 100 jam kerja dalam sebulan',
                                                'Jika aparatur melakukan finger print sebanyak 4 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 3 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 2 kali  dalam sehari|Jika aparatur melakukan finger print sebanyak 1 kali dalam sehari',
                                                'Jika kepala seksi pemerintahan menyelesaikan 5 dokumen|Jika kepala seksi pemerintahan menyelesaikan 4 dokumen|Jika kepala seksi pemerintahan menyelesaikan 3 dokumen|Jika kepala seksi pemerintahan menyelesaikan < 3 dokumen ',
                                                'jumlah kegiatan yang terealisasikan|jumlah kegiatan yang ditargetkan',
                                                'jumlah realisasi anggaran|jumlah pagu anggaran',
                                                'Menyelesaikan dokumen tepat waktu tanggal penetapan|Menyelesaikan dokumen lebih dari 1 minggu waktu tanggal penetapan|Menyelesaikan dokumen lebih dari 2 minggu waktu tanggal penetapan|Menyelesaikan dokumen lebih dari 3 minggu waktu tanggal penetapan');                              
                                $No = 1; for ($i=0; $i < count($Tanya); $i++) { $Pisah = explode("|",$Opsi[$i]); ?>
                                  <tr class="text-light">
                                    <td class="text-center font-weight-bold"><?=$No++?></td>
                                    <td class="text-justify font-weight-bold"><?=$Tanya[$i]?></td>
                                    <td class="text-left">
                                      <?php if (count($Pisah) == 4) { ?>
                                        <?php for ($j=0; $j < 4; $j++) { ?>
                                          <div class="form-check form-check-inline ml-4 my-1">
                                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Keuangan<?=$i?>" id="Keuangan<?=$i.$j?>" value="<?=(4-$j)?>">
                                            <label class="form-check-label font-weight-bold" for="Keuangan<?=$i.$j?>">&nbsp;<?=$Pisah[$j]?></label>
                                          </div>
                                        <?php } ?>
                                      <?php } else if (count($Pisah) <= 2) { ?>
                                        <?php for ($j=0; $j < count($Pisah); $j++) { ?>
                                          <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                              <label class="input-group-text bg-danger text-light"><b><?=$Pisah[$j]?></b></label>
                                            </div>
                                            <input class="form-control form-control-sm" type="text" value="0" id="Keuangan<?=$i.$j?>" placeholder="Input Hanya Angka Saja">
                                          </div>
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                          <b class="ml-3 my-2">KEPALA URUSAN PERENCANAAN</b>
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 40%;"class="align-middle">Pertanyaan</th>
                                    <th style="width: 56%;"class="align-middle">Opsi</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                <?php 
                                  $Tanya = array('Jam kerja kantor :<br>- Senin – kamis ( 07.00 – 15.30 )<br>- Jumat ( 06.30 – 14.30 )',
                                                'Apakah terdapat buku absensi?',
                                                'Adanya dokumen urusan pelaksanaan teknis <br>- menyiapkan bahan penyusunan kebijakan dan perencanaan kerja pemerintahan desa;<br>- menyusun pelaporan penyelenggaraan pemerintahan desa akhir tahun anggaran dan akhir masa jabatan;<br>- menyiapkan bahan musyawarah perencanaan pembangunan desa;<br>- mengelola arsip perencanaan pembangunan;<br>- pengendalian, monitoring dan evaluasi program;<br>- melaksanakan tugas lain yang diberikan oleh pimpinan.',
                                                'Berapa jumlah kegiatan yang terealisasikan & Berapa jumlah kegiatan yang ditargetkan?',
                                                'Berapa jumlah realisasi anggaran & Berapa jumlah pagu anggaran?',
                                                'Penyelenggaraan Musyawarah Perencanaan Desa/Pembahasan APBDes  (Musdes, Musrenbangdes/Pra-Musrenbangdes, dll., bersifat reguler)',
                                                'Penyusunan Dokumen Perencanaan Desa (RPJMDes/RKPDes,dll)',
                                                'Penyusunan Dokumen Keuangan Desa (APBDes/ APBDes Perubahan/ LPJ APBDes, dan seluruh dokumen terkait)',
                                                'Penyusunan Laporan Kepala Desa/Penyelenggaraan Pemerintahan Desa (laporan akhir tahun anggaran, laporan akhir masa jabatan, laporan keterangan akhir tahun anggaran, informasi kepada masyarakat)',
                                                'lain-lain kegiatan sub bidang tata praja pemerintahan, perencanaan, keuangan dan pelaporan',
                                                'Bagaimana ketepatan waktu penyelesaian dokumen semua dokumen?'); 
                                  $Opsi = array('Jika aparatur desa masuk selama 181-200 jam kerja dalam sebulan|Jika aparatur desa masuk selama 141-180 jam kerja dalam sebulan|Jika aparatur desa masuk selama 101-140 jam kerja dalam sebulan|Jika aparatur desa masuk selama < 100 jam kerja dalam sebulan',
                                                'Jika aparatur melakukan finger print sebanyak 4 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 3 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 2 kali  dalam sehari|Jika aparatur melakukan finger print sebanyak 1 kali dalam sehari',
                                                'Jika kepala seksi pemerintahan menyelesaikan 5 dokumen|Jika kepala seksi pemerintahan menyelesaikan 4 dokumen|Jika kepala seksi pemerintahan menyelesaikan 3 dokumen|Jika kepala seksi pemerintahan menyelesaikan < 3 dokumen ',
                                                'jumlah kegiatan yang terealisasikan|jumlah kegiatan yang ditargetkan',
                                                'jumlah realisasi anggaran|jumlah pagu anggaran',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Menyelesaikan dokumen tepat waktu tanggal penetapan|Menyelesaikan dokumen lebih dari 1 minggu waktu tanggal penetapan|Menyelesaikan dokumen lebih dari 2 minggu waktu tanggal penetapan|Menyelesaikan dokumen lebih dari 3 minggu waktu tanggal penetapan'); 
                                $No = 1; for ($i=0; $i < count($Tanya); $i++) { $Pisah = explode("|",$Opsi[$i]); ?>
                                  <tr class="text-light">
                                    <td class="text-center font-weight-bold"><?=$No++?></td>
                                    <td class="text-justify font-weight-bold"><?=$Tanya[$i]?></td>
                                    <td class="text-left">
                                      <?php if (count($Pisah) == 4) { ?>
                                        <?php for ($j=0; $j < 4; $j++) { ?>
                                          <div class="form-check form-check-inline ml-4 my-1">
                                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Perencanaan<?=$i?>" id="Perencanaan<?=$i.$j?>" value="<?=(4-$j)?>">
                                            <label class="form-check-label font-weight-bold" for="Perencanaan<?=$i.$j?>">&nbsp;<?=$Pisah[$j]?></label>
                                          </div>
                                        <?php } ?>
                                      <?php } else if (count($Pisah) <= 2) { ?>
                                        <?php for ($j=0; $j < count($Pisah); $j++) { ?>
                                          <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                              <label class="input-group-text bg-danger text-light"><b><?=$Pisah[$j]?></b></label>
                                            </div>
                                            <input class="form-control form-control-sm" type="text" value="0" id="Perencanaan<?=$i.$j?>" placeholder="Input Hanya Angka Saja">
                                          </div>
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                          <b class="ml-3 my-2">KASI PEMERINTAHAN</b>
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 40%;"class="align-middle">Pertanyaan</th>
                                    <th style="width: 56%;"class="align-middle">Opsi</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                <?php 
                                  $Tanya = array('Jam kerja kantor :<br>- Senin – kamis ( 07.00 – 15.30 )<br>- Jumat ( 06.30 – 14.30 )',
                                                'Apakah terdapat buku absensi?',
                                                'Apakah dari ke 8 fungsi Kasi Pemerintahan ini sudah dilaksanakan?  <br>- Melakukan sosialisasi, bimbingan, konsultasi, koordinasi, monitoring dan evaluasi serta pengawasan penyelenggaraan urusan pemerintahan<br>- Pengumpulan bahan dan data penyusunan rancangan regulasi desa<br>- Merencanakan, melaksanakan, mengevaluasi dan melaporkan pencatatan data kependudukan dan perubahannya<br>- Pelaksanaan fasilitasi dan pengkoordinasian kegiatan pencatatan dan intervensi luas, peruntukan dan pemanfaatan tanah di desa serta perubahannya<br>- Merumuskan kebijakan pengembangan kerjasama desa serta pelaporan pelaksanaan kerjasama desa<br>- Melaksanakan koordinasi, pengendalian dan pembinaan penyelenggaraan ketentraman dan ketertiban umum<br>- Melaksanakan kegiatan pengumpulan data, pengisian dan pengelolaan profil desa<br>- Melakukan pembinaan lembaga RT dan RW',
                                                'Berapa jumlah kegiatan yang terealisasikan & Berapa jumlah kegiatan yang ditargetkan?',
                                                'Berapa jumlah realisasi anggaran & Berapa jumlah pagu anggaran?',
                                                'Penyusunan/pendataan/ pemutakhiran profil desa',
                                                'Lain-lain kegiatan sub bidang administrasi kependudukan, pencatatan sipil, statistik, dan kearsipan',
                                                'Penyelenggaraan musyawarah desalainnya (musdus, rembug warga, dll yg bersifat non-reguler sesuai kebutuhan desa)',
                                                'Penyusunan kebijakan desa (perdes/perkades, dll. Diluar rencana pembangunan keuangan ',
                                                'Pengembangan sistem informasi desa',
                                                'Koordinasi/kerjasama penyelenggaraan pemerintahan dan pembangunan desa',
                                                'Dukungan pelaksanaan dan sosialisasi pilkades, pemilihan kepala kewilayahan dan pemilihan BPD',
                                                'Penyelenggaraan lomba antar kewilayahan dan pengiriman kontingen dalam mengikuti lomba desa',
                                                'Sertifikasi tanah kas desa',
                                                'Administrasi pertanahan (pendaftaran tanah, dan pemberian registrasi agenda pertanahan',
                                                'Fasilitasi sertifikasi tanah untuk masyarakat miskin',
                                                'Mediasi konflik pertanahan',
                                                'Penyuluhan pertanahan',
                                                'Administrasi pajak bumi dan bangunan',
                                                'Penentuan/penegasan/pembangunan',
                                                'Penentuan/penegasan/pembangunan batas/ patok tanah desa',
                                                'Lain-lain kegiatan sub bidang pertanahan',
                                                'Pembuatan pemutakhiran peta wilayah dan sosia desa',
                                                'Penyusunan dokumen perencanaan tata ruang desa',
                                                'Lain- lain kegiatan sub bidang pekerjaan umum dan penataan ruang ',
                                                'Pembuatan Rambu-rambu di Jalan Desa',
                                                'Penyelenggaraan Informasi Publik Desa (Misal : Pembuatan Poster/Baliho Informasi penetapan/LPJ APBDes untuk Warga, dll)',
                                                'Pengelolaan dan Pembuatan Jaringan/Instalasi Komunikasi dan Informasi Lokal Desal',
                                                'lain-lain kegiatan sub bidang Perhubungan, Komunikasi, dan Informatika*',
                                                'Pengadaan/Penyelenggaraan Pos Keamanan Desa (pembangunan pos, pengawasan pelaksanaan jadwal ronda/patroli dll)',
                                                'Penguatan dan Peningkatan Kapasitas Tenaga Keamanan/Ketertiban oleh PemerintahDesa (Satlinmas desa)',
                                                'Koordinasi Pembinaan Ketentraman, Ketertiban, dan Pelindungan Masyarakat (dengan masyarakat/instansi pemerintah daerah, dll) Skala Lokal Desa',
                                                'Pelatihan Kesiapsiagaan/Tanggap Bencana Skala Lokal Desa',
                                                'Bantuan Hukum Untuk Aparatur Desa dan Masyarakat Miskin',
                                                'lain-lain kegiatan sub bidang Ketenteraman, Ketertiban Umum, dan Pelindungan Masyarakat*',
                                                'Peningkatan kapasitas kepala Desa',
                                                'Peningkatan kapasitas perangkat Desa',
                                                'Peningkatan kapasitas BPD',
                                                'Lain-lain Peningkatan kapasitas Aparatur Desa',
                                                'Berapa jumlah linmas di desa & Berapa jumlah penduduk di desa?'); 
                                  $Opsi = array('Jika aparatur desa masuk selama 181-200 jam kerja dalam sebulan|Jika aparatur desa masuk selama 141-180 jam kerja dalam sebulan|Jika aparatur desa masuk selama 101-140 jam kerja dalam sebulan|Jika aparatur desa masuk selama < 100 jam kerja dalam sebulan',
                                                'Jika aparatur melakukan finger print sebanyak 4 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 3 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 2 kali  dalam sehari|Jika aparatur melakukan finger print sebanyak 1 kali dalam sehari',
                                                'kasi pemerintahan melaksanakan semua fungsi|kasi pemerintahan melaksanakan 6-7 fungsi|kasi pemerintahan melaksanakan 4-5 fungsi |kasi pemerintahan melaksanakan <= 3 fungsi',
                                                'jumlah kegiatan yang terealisasikan|jumlah kegiatan yang ditargetkan',
                                                'jumlah realisasi anggaran|jumlah pagu anggaran',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'jumlah linmas di desa|jumlah penduduk di desa'); 
                                $No = 1; for ($i=0; $i < count($Tanya); $i++) { $Pisah = explode("|",$Opsi[$i]); ?>
                                  <tr class="text-light">
                                    <td class="text-center font-weight-bold"><?=$No++?></td>
                                    <td class="text-justify font-weight-bold"><?=$Tanya[$i]?></td>
                                    <td class="text-left">
                                      <?php if (count($Pisah) == 4) { ?>
                                        <?php for ($j=0; $j < 4; $j++) { ?>
                                          <div class="form-check form-check-inline ml-4 my-1">
                                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Pemerintahan<?=$i?>" id="Pemerintahan<?=$i.$j?>" value="<?=(4-$j)?>">
                                            <label class="form-check-label font-weight-bold" for="Pemerintahan<?=$i.$j?>">&nbsp;<?=$Pisah[$j]?></label>
                                          </div>
                                        <?php } ?>
                                      <?php } else if (count($Pisah) <= 2) { ?>
                                        <?php for ($j=0; $j < count($Pisah); $j++) { ?>
                                          <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                              <label class="input-group-text bg-danger text-light"><b><?=$Pisah[$j]?></b></label>
                                            </div>
                                            <input class="form-control form-control-sm" type="text" value="0" id="Pemerintahan<?=$i.$j?>" placeholder="Input Hanya Angka Saja">
                                          </div>
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                          <b class="ml-3 my-2">KEPALA SEKSI KESEJAHTERAAN</b>
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 40%;"class="align-middle">Pertanyaan</th>
                                    <th style="width: 56%;"class="align-middle">Opsi</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                <?php 
                                  $Tanya = array('Jam kerja kantor :<br>- Senin – kamis ( 07.00 – 15.30 )<br>- Jumat ( 06.30 – 14.30 )',
                                                'Apakah terdapat buku absensi?',
                                                'Apakah dari ke-10 dokumen dari kasi kesejahteraan  sudah dijalankan?<br>- Merencanakan, melaksanakan, mengevaluasi dan melaporkan kegiatan pembangunan desa<br>- Mengumpulkan, mengolah dan mengevaluasi serta menyusun data di bidang pemberdayaan masyarakat dan kesejahteraan rakyat<br>- Mendorong swadaya dan partisippasi masyarakat dalam pembangunan dan kesejahteraan masyarakat<br>- Mengelola sarana dan prasarana perekonomian masyarakat desa dan sumber-sumber pendapatan desa <br>- Melaksanakan penyiapan bahan untuk perencanaan pembangunan desa<br>- Melaksanakan pengendalian pelaksanaan pembangunan desa<br>- Peningkatan peran serta masyarakat dalam pelestarian lingkungan hidup<br>- Melaksanakan inventarisasi usaha mikro<br>- Pengkoordinasian kegiatan pemberdayaan masyarakat desa sesuai bidang tugasnya<br>- Melaksanakan pembinaan kegiatan lembaga kemasyarakatan seperti kegiatan pemberdayaan kesejahteraankeluarga, karang taruna dan organisasi kemasyarakatan lainnya sesuai dengan peraturan perundang-undangan yang berlaku',
                                                'Berapa jumlah kegiatan yang terealisasikan & Berapa jumlah kegiatan yang ditargetkan?',
                                                'Berapa jumlah realisasi anggaran & Berapa jumlah pagu anggaran?',
                                                'Pembangunan / Rehabilitasi / Peningkatan / Pengadaan Sarana / Prasarana / Alat Peraga Edukatif (APE) PAUD /  TK / TPA / TKA / TPQ / Madrasah Non-Formal Milik Desa',
                                                'Pembangunan / Rehabilitasi / Peningkatan Sarana Prasarana Perpustakaan / Taman Bacaan Desa /  Sanggar Belajar Milik Desa**',
                                                'Pembangunan / Rehabilitasi / Peningkatan / Pengadaan Sarana / Prasarana Posyandu / Polindes / PKD',
                                                'Pemeliharaan Jalan Desa',
                                                'Pemeliharaan Jalan Lingkungan Permukiman / Gang',
                                                'Pemeliharaan Jalan Usaha Tani',
                                                'Pemeliharaan Jembatan Milik Desa',
                                                'Pemeliharaan Prasarana Jalan Desa (Gorong-gorong, Selokan, Box / Slab Culvert,Drainase, Prasarana Jalan lain)',
                                                'Pemeliharaan Gedung / Prasarana Balai Desa / Balai Kemasyarakatan',
                                                'Pemeliharaan Pemakaman Milik Desa / Situs Bersejarah Milik Desa / Petilasan Milik Desa',
                                                'Pemeliharaan Embung Milik Desa',
                                                'Pembangunan / Rehabilitasi / Peningkatan / Pengerasan Jalan Desa',
                                                'Pembangunan / rehabilitasi / peningkatan / pengerasan jalan lingkungan permukaan / gang',
                                                'Pembangunan / Rehabilitasi / Peningkatan / Pengerasan Jalan Usaha Tani',
                                                'Pembangunan / Rehabilitasi / Peningkatan / Pengerasan Jembatan Milik Desa',
                                                'Pembangunan / Rehabilitasi / Peningkatan Prasarana Jalan Desa (Gorong-gorong,Selokan, Box / Slab Culvert, Drainase, Prasarana Jalan lain)',
                                                'Pembangunan / Rehabilitasi / Peningkatan Balai Desa / Balai Kemasyarakatan',
                                                'Pembangunan / Rehabilitasi / Peningkatan Pemakaman Milik Desa / Situs Bersejarah Milik Desa / Petilasan',
                                                'Pemeliharaan Prasarana Jalan Desa (Gorong-gorong, Selokan, Box / Slab Culvert,Drainase, Prasarana Jalan lain)',
                                                'Pembangunan / Rehabilitasi / Peningkatan Embung Desa',
                                                'Dukungan pelaksanaan program Pembangunan / Rehab Rumah Tidak Layak Huni (RTLH) GAKIN (pemetaan, validasi, dll)',
                                                'Pembangunan / Rehabilitasi / Peningkatan Sumur Resapan',
                                                'Pembangunan / Rehabilitasi / Peningkatan Sumber Air Bersih Milik Desa (Mata Air / Tandon Penampungan Air Hujan / Sumur Bor, dll)',
                                                'Pembangunan / Rehabilitasi / Peningkatan Sambungan Air Bersih ke Rumah Tangga (pipanisasi, dll) **',
                                                'Pembangunan / Rehabilitasi / Peningkatan Sanitasi Permukiman (Gorong-gorong,Selokan, Parit, dll., diluar prasarana jalan)',
                                                'Pembangunan / Rehabilitas / Peningkatan Fasilitas Jamban Umum / MCK umum, dll **',
                                                'Pembangunan / Rehabilitasi / Peningkatan Fasilitas Pengelolaan Sampah Desa / Permukiman (Penampungan, Bank Sampah, dll)**',
                                                'Pembangunan / Rehabilitasi / Peningkatan Sistem Pembuangan Air Limbah (Drainase,Air limbah Rumah Tangga)**',
                                                'Pembangunan / Rehabilitasi / Peningkatan Taman / Taman Bermain Anak Milik Desa**',
                                                'lain-lain kegiatan sub bidang perumahan rakyat dan kawasan pemukiman*',
                                                'Pengelolaan Hutan Milik Desa',
                                                'Pengelolaan Lingkungan Hidup Desa',
                                                'lain-lain kegiatan sub bidang Kehutanan dan Lingkungan Hidup*',
                                                'Pembangunan / Rehabilitasi / Peningkatan Sarana dan Prasarana Energi Alternatif tingkat Desa **',
                                                'lain-lain kegiatan sub bidang Energi dan Sumber Daya Mineral*',
                                                'Pembangunan / Rehabilitasi / Peningkatan Sarana dan Prasarana Pariwisata Milik Desa',
                                                'Pengembangan Pariwisata Tingkat Desa',
                                                'lain-lain kegiatan sub bidang pariwisata*',
                                                'Penyediaan Pos Kesiapsiagaan Bencana Skala Lokal Desa',
                                                'Pembangunan / Rehabilitasi / Peningkatan Sarana dan Prasarana Kebudayaan / Rumah Adat / Keagamaan Milik Desa',
                                                'Pembangunan / Rehabilitasi / Peningkatan Sarana dan Prasarana Kepemudaan dan Olah Raga Milik Desa**',
                                                'Pembangunan / Rehabilitasi / Peningkatan Karamba / Kolam Perikanan Darat Milik Desa',
                                                'Pembangunan / Rehabilitasi / Peningkatan Pelabuhan Perikanan Sungai/Kecil Milik Desa',
                                                'Penguatan Ketahanan Pangan Tingkat Desa (Lumbung Desa, dll)',
                                                'Pemeliharaan Saluran Irigasi Tersier/Sederhana',
                                                'Pembangunan / Rehabilitasi / Peningkatan Pasar Desa / Kios milik Desa',
                                                'Berapa jumlah rumah tidak layak huni yang akan di rehab & Berapa jumlah rumah tidak layak huni yang sudah direhab?'); 
                                  $Opsi = array('Jika aparatur desa masuk selama 181-200 jam kerja dalam sebulan|Jika aparatur desa masuk selama 141-180 jam kerja dalam sebulan|Jika aparatur desa masuk selama 101-140 jam kerja dalam sebulan|Jika aparatur desa masuk selama < 100 jam kerja dalam sebulan',
                                                'Jika aparatur melakukan finger print sebanyak 4 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 3 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 2 kali  dalam sehari|Jika aparatur melakukan finger print sebanyak 1 kali dalam sehari',
                                                'Sekertaris desa melaksanakan semua dokumen|Sekertaris desa melaksanakan 7-9 dokumen|Sekertaris desa melaksanakan 4-6 dokumen|Sekertaris desa melaksanakan <= 3 dokumen',
                                                'jumlah kegiatan yang terealisasikan|jumlah kegiatan yang ditargetkan',
                                                'jumlah realisasi anggaran|jumlah pagu anggaran',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'jumlah rumah tidak layak huni yang akan di rehab|jumlah rumah tidak layak huni yang sudah direhab'); 
                                $No = 1; for ($i=0; $i < count($Tanya); $i++) { $Pisah = explode("|",$Opsi[$i]); ?>
                                  <tr class="text-light">
                                    <td class="text-center font-weight-bold"><?=$No++?></td>
                                    <td class="text-justify font-weight-bold"><?=$Tanya[$i]?></td>
                                    <td class="text-left">
                                      <?php if (count($Pisah) == 4) { ?>
                                        <?php for ($j=0; $j < 4; $j++) { ?>
                                          <div class="form-check form-check-inline ml-4 my-1">
                                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Kesejahteraan<?=$i?>" id="Kesejahteraan<?=$i.$j?>" value="<?=(4-$j)?>">
                                            <label class="form-check-label font-weight-bold" for="Kesejahteraan<?=$i.$j?>">&nbsp;<?=$Pisah[$j]?></label>
                                          </div>
                                        <?php } ?>
                                      <?php } else if (count($Pisah) <= 2) { ?>
                                        <?php for ($j=0; $j < count($Pisah); $j++) { ?>
                                          <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                              <label class="input-group-text bg-danger text-light"><b><?=$Pisah[$j]?></b></label>
                                            </div>
                                            <input class="form-control form-control-sm" type="text" value="0" id="Kesejahteraan<?=$i.$j?>" placeholder="Input Hanya Angka Saja">
                                          </div>
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
                          <b class="ml-3 my-2">KASI PELAYANAN</b>
                          <div class="col-sm-12">
                            <div class="table-responsive mt-1">
                              <table class="table table-sm table-bordered table-striped">
                                <thead class="bg-danger">
                                  <tr style="font-size: 10pt;" class="text-light text-center">
                                    <th style="width: 4%;" class="align-middle">No</th>
                                    <th style="width: 40%;"class="align-middle">Pertanyaan</th>
                                    <th style="width: 56%;"class="align-middle">Opsi</th>
                                  </tr>
                                </thead>
                                <tbody class="bg-primary">
                                <?php 
                                  $Tanya = array('Jam kerja kantor :<br>- Senin – kamis ( 07.00 – 15.30 )<br>- Jumat ( 06.30 – 14.30 )',
                                                'Apakah terdapat buku absensi?',
                                                'Apakah dari ke 7 dokumen  kasi pelayanan sudah dilaksanakan? <br>- Mengumpulkan, mengolah data dan informasi, menginventarisasi permasalahan serta yang berkaitan dengan pelayanan, informasi dan pengaduan <br>- Merencanakan, melaksanakan, mengevaluasi dan melaporkan kegiatan pembinaan mental spiritual, keagamaan, nikah, talak, cerai dan rujuk, sosial,, pendidikan, kebudayaan, olahraga, kepemudaan, kesehatan masyarakat, kesejahteraan keluarga, pemberdayaan perempuan dan perlindungan anak <br>- Melaksanakan administrasi rekomendasi dan surat keterangan yang dibutuhkan masyarakat <br>- Menyiapkan dan menyusun standar pelayanan publik dan standar operasional prosedur pelayanan di desa<br>- Melaksanakan administrasi penerimaaan dan pemeriksaan kelengkapan berkas permohonan pelayanan dari masyarakat<br>- Melaksanakan penyerahan dokumen kepada masyarakat pengguna layanan <br>- Mengoordinasikan pelaksanakan pelayanan satu pintu',
                                                'Berapa jumlah kegiatan yang terealisasikan & Berapa jumlah kegiatan yang ditargetkan?',
                                                'Berapa jumlah realisasi anggaran & Berapa jumlah pagu anggaran?',
                                                'Penyuluhan dan Penyadaran Masyarakat tentang Kependudukan dan Pencatatan Sipil',
                                                'Penyelenggaraan PAUD/TK/TPA/TKA/TPQ/Madrasah Non-Formal Milik Desa (Bantuan Honor Pengajar, Pakaian Seragam, Operasional, dst)',
                                                'Dukungan Penyelenggaraan PAUD (APE, Sarana PAUD, dst)',
                                                'Penyuluhan dan Pelatihan Pendidikan bagi Masyarakat',
                                                'Pemeliharaan Sarana dan Prasarana Perpustakaan/Taman Bacaan Desa/ Sanggar Belajar Milik Desa',
                                                'Pemeliharaan Sarana dan Prasarana PAUD/TK/TPA/TKA/TPQ/Madrasah Non-Formal Milik Desa',
                                                'Pengelolaan Perpustakaan Milik Desa (Pengadaan Buku-buku Bacaan, Honor Penjaga untuk Perpustakaan/Taman Bacaan Desa)',
                                                'Pengembangan dan Pembinaan Sanggar Seni dan Belajar',
                                                'Dukungan Pendidikan bagi Siswa Miskin/Berprestasi',
                                                'lain-lain kegiatan sub bidang pendidikan*',
                                                'Penyelenggaraan Pos Kesehatan Desa (PKD)/Polindes Milik Desa (Obat-obatan; Tambahan Insentif Bidan Desa/Perawat Desa; Penyediaan Pelayanan KB dan Alat Kontrasepsi bagi Keluarga Miskin, dst)',
                                                'Penyelenggaraan Posyandu (Makanan Tambahan, Kelas Ibu Hamil, Kelas Lansia, Insentif Kader Posyandu)',
                                                'Penyuluhan dan Pelatihan Bidang Kesehatan (untuk Masyarakat, Tenaga Kesehatan,Kader Kesehatan, dll)',
                                                'Penyelenggaraan Desa Siaga Kesehatan',
                                                'Pembinaan Palang Merah Remaja (PMR) tingkat desa',
                                                'Pengasuhan Bersama atau Bina Keluarga Balita (BKB)',
                                                'Pembinaan dan Pengawasan Upaya Kesehatan Tradisional',
                                                'Pemeliharaan Sarana/Prasarana Posyandu/Polindes/PKD',
                                                'Penyelenggaraan Pos Kesehatan Desa (PKD)/Polindes Milik Desa (Obat-obatan; Tambahan Insentif Bidan Desa/Perawat Desa; Penyediaan Pelayanan KB dan Alat Kontrasepsi bagi Keluarga Miskin, dst)',
                                                'lain-lain kegiatan sub bidang kesehatan*',
                                                'Pemeliharaan Sumur Resapan Milik Desa',
                                                'Pemeliharaan Sumber Air Bersih Milik Desa (Mata Air/Tandon Penampungan Air Hujan/Sumur Bor, dll)',
                                                'Pemeliharaan Sambungan Air Bersih ke Rumah Tangga (pipanisasi, dll)',
                                                'Pemeliharaan Sanitasi Permukiman (Gorong-gorong, Selokan, Parit, dll., diluar prasarana jalan)',
                                                'Pemeliharaan Fasilitas Jamban Umum/MCK umum, dll',
                                                'Pemeliharaan Fasilitas Pengelolaan Sampah Desa/Permukiman (Penampungan, Bank Sampah, dll)',
                                                'Pemeliharaan Sistem Pembuangan Air Limbah (Drainase, Air limbah Rumah Tangga)',
                                                'Pemeliharaan Taman/Taman Bermain Anak Milik Desa',
                                                'Pelatihan/Sosialisasi/Penyuluhan/Penyadaran tentang Lingkungan Hidup dan Kehutanan',
                                                'Pemeliharaan Sarana dan Prasarana Energi Alternatif tingkat Desa',
                                                'Pemeliharaan Sarana dan Prasarana Pariwisata Milik Desa',
                                                'Pelatihan/Penyuluhan/Sosialisasi kepada Masyarakat di Bidang Hukum dan Pelindungan Masyarakat',
                                                'Pembinaan Group Kesenian dan Kebudayaan Tingkat Desa',
                                                'Pengiriman Kontingen Group Kesenian dan Kebudayaan sebagai Wakil Desa di tingkat Kecamatan dan Kabupaten/Kota',
                                                'Penyelenggaraan Festival Kesenian, Adat/Kebudayaan, dan Keagamaan (perayaan hari kemerdekaan, hari besar keagamaan, dll) tingkat Desa',
                                                'Pemeliharaan Sarana dan Prasarana Kebudayaan/Rumah Adat/Keagamaan Milik Desa',
                                                'Pembinaan Group Kesenian dan Kebudayaan Tingkat Desa',
                                                'Pengiriman Kontingen Kepemudaan dan Olah Raga sebagai Wakil Desa di tingkat Kecamatan dan Kabupaten/Kota',
                                                'Penyelenggaraan pelatihan kepemudaan (Kepemudaan, Penyadaraan Wawasan Kebangsaan, dll) tingkat Desa',
                                                'Penyelenggaraan Festival/Lomba Kepemudaan dan Olahraga tingkat Desa',
                                                'Pemeliharaan Sarana dan Prasarana Kepemudaan dan Olah Raga Milik Desa**',
                                                'Pembinaan Karang Taruna/Klub Kepemudaan/Klub Olah raga',
                                                'lain-lain kegiatan sub bidang Kepemudaan dan Olah Raga',
                                                'Pembinaan Lembaga Adat',
                                                'Pembinaan LKMD/LPM/LPMD',
                                                'Pembinaan PKK',
                                                'Pelatihan Pembinaan Lembaga Kemasyarakatan',
                                                'lain-lain kegiatan sub bidang Kelembagaan Masyarakat*',
                                                'Pemeliharaan Karamba/Kolam Perikanan Darat Milik Desa',
                                                'Pemeliharaan Pelabuhan Perikanan Sungai/Kecil Milik Desa',
                                                'Bantuan Perikanan (Bibit/Pakan/dst)',
                                                'Pelatihan/Bimtek/Pengenalan Tekonologi Tepat Guna untuk Perikanan Darat/Nelayan',
                                                'lain-lain kegiatan sub bidang kelautan dan perikanan',
                                                'Peningkatan Produksi Tanaman Pangan (Alat Produksi dan pengolahan pertanian,penggilingan Padi/jagung, dll)',
                                                'Peningkatan Produksi Peternakan (Alat Produksi dan pengolahan peternakan, kandang, dll)',
                                                'Pelatihan/Bimtek/Pengenalan Tekonologi Tepat Guna untuk Pertanian/Peternakan',
                                                'lain-lain kegiatan sub bidang pertanian dan peternakan',
                                                'Pelatihan/Penyuluhan Pemberdayaan Perempuan',
                                                'Pelatihan/Penyuluhan Perlindungan Anak',
                                                'Pelatihan dan Penguatan Penyandang Difabel (penyandang disabilitas)',
                                                'lain-lain kegiatan sub bidang Pemberdayaan Perempuan dan Perlindungan Anak*',
                                                'Pelatihan Manajemen Pengelolaan Koperasi/ KUD/ UMKM',
                                                'Pengembangan Sarana Prasarana Usaha Mikro, Kecil dan Menengah serta Koperasi',
                                                'Pengadaan Teknologi Tepat Guna untuk Pengembangan Ekonomi Pedesaan Non- Pertanian',
                                                'lain-lain kegiatan sub bidang Koperasi, Usaha Kecil dan Menengah*',
                                                'Pembentukan BUM Desa (Persiapan dan Pembentukan Awal BUM Desa)',
                                                'Pelatihan Pengelolaan BUM Desa (Pelatihan yang dilaksanakan oleh Desa)',
                                                'lain-lain kegiatan sub bidang Penanaman Modal*',
                                                'Pemeliharaan Pasar Desa/Kios milik Desa',
                                                'Pengembangan Industri kecil level Desa',
                                                'Pembentukan/Fasilitasi/Pelatihan/Pendampingan kelompok usaha ekonomi produktif (pengrajin, pedagang, industri rumah tangga, dll) **',
                                                'lain-lain kegiatan sub bidang Perdagangan dan Perindustrian*',
                                                'Berapa jumlah siswa & Berapa jumlah kelas (Paud,TK,TKA,TPQ,Madarsah)?',
                                                'Berapa jumlah murid (Paud,TK,TPQ,Madarsah) & Berapa jumlah guru (Paud,TK,TKA,TPQ,Madarsah)?',
                                                'Berapa jumlah penduduk & Berapa jumlah tenaga poskesdes?',
                                                'Berapa jumlah balita & Berapa jumlah tenaga posyandu?'); 
                                  $Opsi = array('Jika aparatur desa masuk selama 181-200 jam kerja dalam sebulan|Jika aparatur desa masuk selama 141-180 jam kerja dalam sebulan|Jika aparatur desa masuk selama 101-140 jam kerja dalam sebulan|Jika aparatur desa masuk selama < 100 jam kerja dalam sebulan',
                                                'Jika aparatur melakukan finger print sebanyak 4 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 3 kali dalam sehari|Jika aparatur melakukan finger print sebanyak 2 kali  dalam sehari|Jika aparatur melakukan finger print sebanyak 1 kali dalam sehari',
                                                'Kasi Pelayanan melaksanakan 7 dokumen|Kasi Pelayanan melaksanakan 5-6 dokumen |Kasi Pelayanan melaksanakan 3-4 dokumen |Kasi Pelayanan melaksanakan < 3 dokumen',
                                                'jumlah kegiatan yang terealisasikan|jumlah kegiatan yang ditargetkan',
                                                'jumlah realisasi anggaran|jumlah pagu anggaran',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'Realisasi Belanja|Anggaran Belanja',
                                                'jumlah murid (Paud,TK,TPQ,Madarsah)|jumlah kelas (Paud,TK,TKA,TPQ,Madarsah)',
                                                'jumlah murid (Paud,TK,TPQ,Madarsah)|jumlah guru (Paud,TK,TKA,TPQ,Madarsah)',
                                                'jumlah penduduk|jumlah tenaga poskesdes',
                                                'jumlah balita|jumlah tenaga posyandu'); 
                                $No = 1; for ($i=0; $i < count($Tanya); $i++) { $Pisah = explode("|",$Opsi[$i]); ?>
                                  <tr class="text-light">
                                    <td class="text-center font-weight-bold"><?=$No++?></td>
                                    <td class="text-justify font-weight-bold"><?=$Tanya[$i]?></td>
                                    <td class="text-left">
                                      <?php if (count($Pisah) == 4) { ?>
                                        <?php for ($j=0; $j < 4; $j++) { ?>
                                          <div class="form-check form-check-inline ml-4 my-1">
                                            <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="Pelayanan<?=$i?>" id="Pelayanan<?=$i.$j?>" value="<?=(4-$j)?>">
                                            <label class="form-check-label font-weight-bold" for="Pelayanan<?=$i.$j?>">&nbsp;<?=$Pisah[$j]?></label>
                                          </div>
                                        <?php } ?>
                                      <?php } else if (count($Pisah) <= 2) { ?>
                                        <?php for ($j=0; $j < count($Pisah); $j++) { ?>
                                          <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                              <label class="input-group-text bg-danger text-light"><b><?=$Pisah[$j]?></b></label>
                                            </div>
                                            <input class="form-control form-control-sm" type="text" value="0" id="Pelayanan<?=$i.$j?>" placeholder="Input Hanya Angka Saja">
                                          </div>
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div> 
                          </div>
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
        <!-- /page content -->
        
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
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
  
        $("#Kirim").click(function() {
          if (isNaN(parseInt($("#Dusun").val())) || $("#Dusun").val() === "") {
            alert('Input Jumlah Dusun Hanya Boleh Angka Positif!')
          } 
          else {
            //Kepala Desa
            var KepalaDesa = ''
            var Cek = false
            var Tanya = 0
            for (let i = 0; i < 3; i++) {
              if ($("input[name='KepalaDesa"+i+"']:checked").val() == undefined) {
                Cek = true
                Tanya = i+1
                break
              } 
            }
            if (Cek) {
              alert('Kepala Desa, Pertanyaan Nomer '+Tanya+' Wajib Di Isi!')
              return true
            } 
            else {
              if (parseInt($("#KepalaDesa30").val()) > parseInt($("#KepalaDesa31").val()) || isNaN(parseInt($("#KepalaDesa30").val())) || isNaN(parseInt($("#KepalaDesa31").val())) || $("#KepalaDesa30").val() == "" || $("#KepalaDesa31").val() == "") {
                alert('Kepala Desa, Pertanyaan Nomer 4 Input Pendapatan Asli Desa Harus Lebih Kecil Dari Total Penerimaan Desa!')
                return true
              } else {
                KepalaDesa += ($("input[name='KepalaDesa0']:checked").val()+"|"+
                              $("input[name='KepalaDesa1']:checked").val()+"|"+
                              $("input[name='KepalaDesa2']:checked").val()+"|")
                var KepDes = parseInt($("#KepalaDesa30").val()) / parseInt($("#KepalaDesa31").val()) * 100
                if (KepDes < 26 || isNaN(KepDes) || KepDes == Infinity) {
                  KepalaDesa += '1'
                } else if (KepDes < 51) {
                  KepalaDesa += '2'
                } else if (KepDes < 76) {
                  KepalaDesa += '3'
                } else {
                  KepalaDesa += '4'
                }               
              }
            }
            //Sekertaris Desa
            var SekertarisDesa = ''
            var Cek = false
            var Tanya = 0
            for (let i = 0; i < 7; i++) {
              if ($("input[name='SekertarisDesa"+i+"']:checked").val() == undefined) {
                Cek = true
                Tanya = i+1
                break
              } 
            }
            if (Cek) {
              alert('Sekertaris Desa, Pertanyaan Nomer '+Tanya+' Wajib Di Isi!')
              return true
            } 
            else {
              if (parseInt($("#SekertarisDesa70").val()) > parseInt($("#SekertarisDesa71").val()) || isNaN(parseInt($("#SekertarisDesa70").val())) || isNaN(parseInt($("#SekertarisDesa71").val())) || $("#SekertarisDesa70").val() == "" || $("#SekertarisDesa71").val() == "") {
                alert('Sekertaris Desa, Pertanyaan Nomer 8 Input jumlah kegiatan yang terealisasikan Harus Lebih Kecil Dari jumlah kegiatan yang ditargetkan!')
                return true
              } else if (parseInt($("#SekertarisDesa80").val()) > parseInt($("#SekertarisDesa81").val()) || isNaN(parseInt($("#SekertarisDesa80").val())) || isNaN(parseInt($("#SekertarisDesa81").val())) || $("#SekertarisDesa80").val() == "" || $("#SekertarisDesa81").val() == "") {
                alert('Sekertaris Desa, Pertanyaan Nomer 9 Input realisasi anggaran yang digunakan Harus Lebih Kecil Dari jumlah pagu anggaran Yang di dapat!')
                return true
              } else if (isNaN(parseInt($("#SekertarisDesa90").val())) || isNaN(parseInt($("#SekertarisDesa91").val())) || $("#SekertarisDesa90").val() == "" || $("#SekertarisDesa91").val() == "") {
                alert('Sekertaris Desa, Pertanyaan Nomer 10 Input jumlah anggaran yang terealisasi atau jumlah anggaran belanja yang didapat belum benar!')
                return true
              } else {
                for (let i = 0; i < 7; i++) {
                  if (i == 0) {
                    SekertarisDesa += $("input[name='SekertarisDesa"+i+"']:checked").val()
                  } else {
                    SekertarisDesa += ("|"+$("input[name='SekertarisDesa"+i+"']:checked").val())
                  }
                }
                if (parseInt($("#SekertarisDesa70").val()) / parseInt($("#SekertarisDesa71").val()) * 100 < 26 || isNaN(parseInt($("#SekertarisDesa70").val()) / parseInt($("#SekertarisDesa71").val()) * 100) || parseInt($("#SekertarisDesa70").val()) / parseInt($("#SekertarisDesa71").val()) * 100 == Infinity) {
                  SekertarisDesa += '|1'
                } else if (parseInt($("#SekertarisDesa70").val()) / parseInt($("#SekertarisDesa71").val()) * 100 < 51) {
                  SekertarisDesa += '|2'
                } else if (parseInt($("#SekertarisDesa70").val()) / parseInt($("#SekertarisDesa71").val()) * 100 < 76) {
                  SekertarisDesa += '|3'
                } else {
                  SekertarisDesa += '|4'
                }   
                if (parseInt($("#SekertarisDesa80").val()) / parseInt($("#SekertarisDesa81").val()) * 100 < 26 || isNaN(parseInt($("#SekertarisDesa80").val()) / parseInt($("#SekertarisDesa81").val()) * 100) || parseInt($("#SekertarisDesa80").val()) / parseInt($("#SekertarisDesa81").val()) * 100 == Infinity) {
                  SekertarisDesa += '|1'
                } else if (parseInt($("#SekertarisDesa80").val()) / parseInt($("#SekertarisDesa81").val()) * 100 < 51) {
                  SekertarisDesa += '|2'
                } else if (parseInt($("#SekertarisDesa80").val()) / parseInt($("#SekertarisDesa81").val()) * 100 < 76) {
                  SekertarisDesa += '|3'
                } else {
                  SekertarisDesa += '|4'
                }
                if (parseInt($("#SekertarisDesa90").val()) / parseInt($("#SekertarisDesa91").val()) * 100 > 100 || isNaN(parseInt($("#SekertarisDesa90").val()) / parseInt($("#SekertarisDesa91").val()) * 100) || parseInt($("#SekertarisDesa90").val()) / parseInt($("#SekertarisDesa91").val()) * 100 == Infinity) {
                  SekertarisDesa += '|1'
                } else if (parseInt($("#SekertarisDesa90").val()) / parseInt($("#SekertarisDesa91").val()) * 100 > 90) {
                  SekertarisDesa += '|2'
                } else if (parseInt($("#SekertarisDesa90").val()) / parseInt($("#SekertarisDesa91").val()) * 100 > 80) {
                  SekertarisDesa += '|3'
                } else {
                  SekertarisDesa += '|4'
                }           
              }
            }
            //KEPALA URUSAN TATA USAHA DAN UMUM
            var TU = ''
            var Cek = false
            var Tanya = 0
            for (let i = 0; i < 3; i++) {
              if ($("input[name='TU"+i+"']:checked").val() == undefined) {
                Cek = true
                Tanya = i+1
                break
              } 
            }
            if (Cek) {
              alert('KEPALA URUSAN TATA USAHA DAN UMUM, Pertanyaan Nomer '+Tanya+' Wajib Di Isi!')
              return true
            } 
            else {
              for (let i = 3; i < 5; i++) {
                if (parseInt($("#TU"+i+"0").val()) > parseInt($("#TU"+i+"1").val()) || isNaN(parseInt($("#TU"+i+"0").val())) || isNaN(parseInt($("#TU"+i+"1").val())) || $("#TU"+i+"0").val() == "" || $("#TU"+i+"1").val() == "") {
                  alert('KEPALA URUSAN TATA USAHA DAN UMUM, Pertanyaan Nomer '+(i+1)+' Input Pertama Harus Lebih Kecil Dari input Kedua!')
                  return true
                  break
                } 
              }
              for (let i = 5; i < 20; i++) {
                if (isNaN(parseInt($("#TU"+i+"0").val())) || isNaN(parseInt($("#TU"+i+"1").val())) || $("#TU"+i+"0").val() == "" || $("#TU"+i+"1").val() == "") {
                  alert('KEPALA URUSAN TATA USAHA DAN UMUM, Pertanyaan Nomer '+(i+1)+' Belum Benar!')
                  return true
                  break
                } 
              }
              if ($("input[name='TU"+20+"']:checked").val() == undefined) {
                alert('KEPALA URUSAN TATA USAHA DAN UMUM, Pertanyaan Nomer 21 Wajib Di Isi!')
                return true
              } 
              TU += ($("input[name='TU0']:checked").val()+"|"+
                    $("input[name='TU1']:checked").val()+"|"+
                    $("input[name='TU2']:checked").val())
              for (let i = 3; i < 5; i++) {
                if (parseInt($("#TU"+i+"0").val()) / parseInt($("#TU"+i+"1").val()) * 100 < 26 || isNaN(parseInt($("#TU"+i+"0").val()) / parseInt($("#TU"+i+"1").val()) * 100) || parseInt($("#TU"+i+"0").val()) / parseInt($("#TU"+i+"1").val()) * 100 == Infinity) {
                  TU += '|1'
                } else if (parseInt($("#TU"+i+"0").val()) / parseInt($("#TU"+i+"1").val()) * 100 < 51) {
                  TU += '|2'
                } else if (parseInt($("#TU"+i+"0").val()) / parseInt($("#TU"+i+"1").val()) * 100 < 76) {
                  TU += '|3'
                } else {
                  TU += '|4'
                } 
              }     
              for (let i = 5; i < 20; i++) {
                if (parseInt($("#TU"+i+"0").val()) / parseInt($("#TU"+i+"1").val()) * 100 > 100 || isNaN(parseInt($("#TU"+i+"0").val()) / parseInt($("#TU"+i+"1").val()) * 100) || parseInt($("#TU"+i+"0").val()) / parseInt($("#TU"+i+"1").val()) * 100 == Infinity) {
                  TU += '|1'
                } else if (parseInt($("#TU"+i+"0").val()) / parseInt($("#TU"+i+"1").val()) * 100 > 90) {
                  TU += '|2'
                } else if (parseInt($("#TU"+i+"0").val()) / parseInt($("#TU"+i+"1").val()) * 100 > 80) {
                  TU += '|3'
                } else {
                  TU += '|4'
                } 
              }
              TU += ("|"+$("input[name='TU20']:checked").val())     
            }
            //Keuangan
            var Keuangan = ''
            var Cek = false
            var Tanya = 0
            for (let i = 0; i < 3; i++) {
              if ($("input[name='Keuangan"+i+"']:checked").val() == undefined) {
                Cek = true
                Tanya = i+1
                break
              } 
            }
            if (Cek) {
              alert('KEPALA URUSAN KEUANGAN, Pertanyaan Nomer '+Tanya+' Wajib Di Isi!')
              return true
            } 
            else {
              if (parseInt($("#Keuangan30").val()) > parseInt($("#Keuangan31").val()) || isNaN(parseInt($("#Keuangan30").val())) || isNaN(parseInt($("#Keuangan31").val())) || $("#Keuangan30").val() == "" || $("#Keuangan31").val() == "") {
                alert('KEPALA URUSAN KEUANGAN, Pertanyaan Nomer 4 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                return true
              } else if (parseInt($("#Keuangan40").val()) > parseInt($("#Keuangan41").val()) || isNaN(parseInt($("#Keuangan40").val())) || isNaN(parseInt($("#Keuangan41").val())) || $("#Keuangan40").val() == "" || $("#Keuangan41").val() == "") {
                alert('KEPALA URUSAN KEUANGAN, Pertanyaan Nomer 5 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                return true
              } if ($("input[name='Keuangan5']:checked").val() == undefined) {
                alert('KEPALA URUSAN KEUANGAN, Pertanyaan Nomer 6 Wajib Di Isi!')
                return true
              } else {
                Keuangan += ($("input[name='Keuangan0']:checked").val()+"|"+
                              $("input[name='Keuangan1']:checked").val()+"|"+
                              $("input[name='Keuangan2']:checked").val()+"|")
                if (parseInt($("#Keuangan30").val()) / parseInt($("#Keuangan31").val()) * 100 < 26 || isNaN(parseInt($("#Keuangan30").val()) / parseInt($("#Keuangan31").val()) * 100) || parseInt($("#Keuangan30").val()) / parseInt($("#Keuangan31").val()) * 100 == Infinity) {
                  Keuangan += '1|'
                } else if (parseInt($("#Keuangan30").val()) / parseInt($("#Keuangan31").val()) * 100 < 51) {
                  Keuangan += '2|'
                } else if (parseInt($("#Keuangan30").val()) / parseInt($("#Keuangan31").val()) * 100 < 76) {
                  Keuangan += '3|'
                } else {
                  Keuangan += '4|'
                }   
                if (parseInt($("#Keuangan40").val()) / parseInt($("#Keuangan41").val()) * 100 < 26 || isNaN(parseInt($("#Keuangan40").val()) / parseInt($("#Keuangan41").val()) * 100) || parseInt($("#Keuangan40").val()) / parseInt($("#Keuangan41").val()) * 100 == Infinity) {
                  Keuangan += '1|'
                } else if (parseInt($("#Keuangan40").val()) / parseInt($("#Keuangan41").val()) * 100 < 51) {
                  Keuangan += '2|'
                } else if (parseInt($("#Keuangan40").val()) / parseInt($("#Keuangan41").val()) * 100 < 76) {
                  Keuangan += '3|'
                } else {
                  Keuangan += '4|'
                }          
                Keuangan += $("input[name='Keuangan5']:checked").val()
              }
            }
            // Perencanaan
            var Perencanaan = ''
            var Cek = false
            var Tanya = 0
            for (let i = 0; i < 3; i++) {
              if ($("input[name='Perencanaan"+i+"']:checked").val() == undefined) {
                Cek = true
                Tanya = i+1
                break
              } 
            }
            if (Cek) {
              alert('KEPALA URUSAN PERENCANAAN, Pertanyaan Nomer '+Tanya+' Wajib Di Isi!')
              return true
            } 
            else {
              if (parseInt($("#Perencanaan30").val()) > parseInt($("#Perencanaan31").val()) || isNaN(parseInt($("#Perencanaan30").val())) || isNaN(parseInt($("#Perencanaan31").val())) || $("#Perencanaan30").val() == "" || $("#Perencanaan31").val() == "") {
                alert('KEPALA URUSAN PERENCANAAN, Pertanyaan Nomer 4 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                return true
              } else if (parseInt($("#Perencanaan40").val()) > parseInt($("#Perencanaan41").val()) || isNaN(parseInt($("#Perencanaan40").val())) || isNaN(parseInt($("#Perencanaan41").val())) || $("#Perencanaan40").val() == "" || $("#Perencanaan41").val() == "") {
                alert('KEPALA URUSAN PERENCANAAN, Pertanyaan Nomer 5 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                return true
              } else {
                for (let i = 5; i < 10; i++) {
                  if (isNaN(parseInt($("#Perencanaan"+i+"0").val())) || isNaN(parseInt($("#Perencanaan"+i+"1").val())) || $("#Perencanaan"+i+"0").val() == "" || $("#Perencanaan"+i+"1").val() == "") {
                    alert('KEPALA URUSAN PERENCANAAN, Pertanyaan Nomer '+(i+1)+' Belum Benar!')
                    return true
                    break
                  } 
                }
                if ($("input[name='Perencanaan10']:checked").val() == undefined) {
                  alert('KEPALA URUSAN PERENCANAAN, Pertanyaan Nomer 11 Wajib Di Isi!')
                  return true
                } 
                Perencanaan += ($("input[name='Perencanaan0']:checked").val()+"|"+
                                $("input[name='Perencanaan1']:checked").val()+"|"+
                                $("input[name='Perencanaan2']:checked").val())
                for (let i = 3; i < 5; i++) {
                  if (parseInt($("#Perencanaan"+i+"0").val()) / parseInt($("#Perencanaan"+i+"1").val()) * 100 < 26 || isNaN(parseInt($("#Perencanaan"+i+"0").val()) / parseInt($("#Perencanaan"+i+"1").val()) * 100) || parseInt($("#Perencanaan"+i+"0").val()) / parseInt($("#Perencanaan"+i+"1").val()) * 100 == Infinity) {
                    Perencanaan += '|1'
                  } else if (parseInt($("#Perencanaan"+i+"0").val()) / parseInt($("#Perencanaan"+i+"1").val()) * 100 < 51) {
                    Perencanaan += '|2'
                  } else if (parseInt($("#Perencanaan"+i+"0").val()) / parseInt($("#Perencanaan"+i+"1").val()) * 100 < 76) {
                    Perencanaan += '|3'
                  } else {
                    Perencanaan += '|4'
                  } 
                }     
                for (let i = 5; i < 10; i++) {
                  if (parseInt($("#Perencanaan"+i+"0").val()) / parseInt($("#Perencanaan"+i+"1").val()) * 100 > 100 || isNaN(parseInt($("#Perencanaan"+i+"0").val()) / parseInt($("#Perencanaan"+i+"1").val()) * 100) || parseInt($("#Perencanaan"+i+"0").val()) / parseInt($("#Perencanaan"+i+"1").val()) * 100 == Infinity) {
                    Perencanaan += '|1'
                  } else if (parseInt($("#Perencanaan"+i+"0").val()) / parseInt($("#Perencanaan"+i+"1").val()) * 100 > 90) {
                    Perencanaan += '|2'
                  } else if (parseInt($("#Perencanaan"+i+"0").val()) / parseInt($("#Perencanaan"+i+"1").val()) * 100 > 80) {
                    Perencanaan += '|3'
                  } else {
                    Perencanaan += '|4'
                  } 
                }
                Perencanaan += ("|"+$("input[name='Perencanaan10']:checked").val())    
              }
            }
            // Pemerintahan
            var Pemerintahan = ''
            var Cek = false
            var Tanya = 0
            for (let i = 0; i < 3; i++) {
              if ($("input[name='Pemerintahan"+i+"']:checked").val() == undefined) {
                Cek = true
                Tanya = i+1
                break
              } 
            }
            if (Cek) {
              alert('KASI PEMERINTAHAN, Pertanyaan Nomer '+Tanya+' Wajib Di Isi!')
              return true
            } 
            else {
              if (parseInt($("#Pemerintahan30").val()) > parseInt($("#Pemerintahan31").val()) || isNaN(parseInt($("#Pemerintahan30").val())) || isNaN(parseInt($("#Pemerintahan31").val())) || $("#Pemerintahan30").val() == "" || $("#Pemerintahan31").val() == "") {
                alert('KASI PEMERINTAHAN, Pertanyaan Nomer 4 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                return true
              } else if (parseInt($("#Pemerintahan40").val()) > parseInt($("#Pemerintahan41").val()) || isNaN(parseInt($("#Pemerintahan40").val())) || isNaN(parseInt($("#Pemerintahan41").val())) || $("#Pemerintahan40").val() == "" || $("#Pemerintahan41").val() == "") {
                alert('KASI PEMERINTAHAN, Pertanyaan Nomer 5 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                return true
              } else {
                for (let i = 5; i < 39; i++) {
                  if (isNaN(parseInt($("#Pemerintahan"+i+"0").val())) || isNaN(parseInt($("#Pemerintahan"+i+"1").val())) || $("#Pemerintahan"+i+"0").val() == "" || $("#Pemerintahan"+i+"1").val() == "") {
                    alert('KASI PEMERINTAHAN, Pertanyaan Nomer '+(i+1)+' Belum Benar!')
                    return true
                    break
                  } 
                }
                if (parseInt($("#Pemerintahan390").val()) > parseInt($("#Pemerintahan391").val()) || isNaN(parseInt($("#Pemerintahan390").val())) || isNaN(parseInt($("#Pemerintahan391").val())) || $("#Pemerintahan390").val() == "" || $("#Pemerintahan391").val() == "") {
                  alert('KASI PEMERINTAHAN, Pertanyaan Nomer 40 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                  return true
                } 
                Pemerintahan += ($("input[name='Pemerintahan0']:checked").val()+"|"+
                                $("input[name='Pemerintahan1']:checked").val()+"|"+
                                $("input[name='Pemerintahan2']:checked").val())
                for (let i = 3; i < 5; i++) {
                  if (parseInt($("#Pemerintahan"+i+"0").val()) / parseInt($("#Pemerintahan"+i+"1").val()) * 100 < 26 || isNaN(parseInt($("#Pemerintahan"+i+"0").val()) / parseInt($("#Pemerintahan"+i+"1").val()) * 100) || parseInt($("#Pemerintahan"+i+"0").val()) / parseInt($("#Pemerintahan"+i+"1").val()) * 100 == Infinity) {
                    Pemerintahan += '|1'
                  } else if (parseInt($("#Pemerintahan"+i+"0").val()) / parseInt($("#Pemerintahan"+i+"1").val()) * 100 < 51) {
                    Pemerintahan += '|2'
                  } else if (parseInt($("#Pemerintahan"+i+"0").val()) / parseInt($("#Pemerintahan"+i+"1").val()) * 100 < 76) {
                    Pemerintahan += '|3'
                  } else {
                    Pemerintahan += '|4'
                  } 
                }     
                for (let i = 5; i < 39; i++) {
                  if (parseInt($("#Pemerintahan"+i+"0").val()) / parseInt($("#Pemerintahan"+i+"1").val()) * 100 > 100 || isNaN(parseInt($("#Pemerintahan"+i+"0").val()) / parseInt($("#Pemerintahan"+i+"1").val()) * 100) || parseInt($("#Pemerintahan"+i+"0").val()) / parseInt($("#Pemerintahan"+i+"1").val()) * 100 == Infinity) {
                    Pemerintahan += '|1'
                  } else if (parseInt($("#Pemerintahan"+i+"0").val()) / parseInt($("#Pemerintahan"+i+"1").val()) * 100 > 90) {
                    Pemerintahan += '|2'
                  } else if (parseInt($("#Pemerintahan"+i+"0").val()) / parseInt($("#Pemerintahan"+i+"1").val()) * 100 > 80) {
                    Pemerintahan += '|3'
                  } else {
                    Pemerintahan += '|4'
                  } 
                }
                if (parseInt($("#Pemerintahan"+39+"0").val()) / parseInt($("#Pemerintahan"+39+"1").val()) * 100 < 26 || isNaN(parseInt($("#Pemerintahan"+39+"0").val()) / parseInt($("#Pemerintahan"+39+"1").val()) * 100) || parseInt($("#Pemerintahan"+39+"0").val()) / parseInt($("#Pemerintahan"+39+"1").val()) * 100 == Infinity) {
                  Pemerintahan += '|1'
                } else if (parseInt($("#Pemerintahan"+39+"0").val()) / parseInt($("#Pemerintahan"+39+"1").val()) * 100 < 51) {
                  Pemerintahan += '|2'
                } else if (parseInt($("#Pemerintahan"+39+"0").val()) / parseInt($("#Pemerintahan"+39+"1").val()) * 100 < 76) {
                  Pemerintahan += '|3'
                } else {
                  Pemerintahan += '|4'
                } 
              }
            }
            // Kesejahteraan
            var Kesejahteraan = ''
            var Cek = false
            var Tanya = 0
            for (let i = 0; i < 3; i++) {
              if ($("input[name='Kesejahteraan"+i+"']:checked").val() == undefined) {
                Cek = true
                Tanya = i+1
                break
              } 
            }
            if (Cek) {
              alert('KEPALA SEKSI KESEJAHTERAAN, Pertanyaan Nomer '+Tanya+' Wajib Di Isi!')
              return true
            } 
            else {
              if (parseInt($("#Kesejahteraan30").val()) > parseInt($("#Kesejahteraan31").val()) || isNaN(parseInt($("#Kesejahteraan30").val())) || isNaN(parseInt($("#Kesejahteraan31").val())) || $("#Kesejahteraan30").val() == "" || $("#Kesejahteraan31").val() == "") {
                alert('KEPALA SEKSI KESEJAHTERAAN, Pertanyaan Nomer 4 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                return true
              } else if (parseInt($("#Kesejahteraan40").val()) > parseInt($("#Kesejahteraan41").val()) || isNaN(parseInt($("#Kesejahteraan40").val())) || isNaN(parseInt($("#Kesejahteraan41").val())) || $("#Kesejahteraan40").val() == "" || $("#Kesejahteraan41").val() == "") {
                alert('KEPALA SEKSI KESEJAHTERAAN, Pertanyaan Nomer 5 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                return true
              } else {
                for (let i = 5; i < 51; i++) {
                  if (isNaN(parseInt($("#Kesejahteraan"+i+"0").val())) || isNaN(parseInt($("#Kesejahteraan"+i+"1").val())) || $("#Kesejahteraan"+i+"0").val() == "" || $("#Kesejahteraan"+i+"1").val() == "") {
                    alert('KEPALA SEKSI KESEJAHTERAAN, Pertanyaan Nomer '+(i+1)+' Belum Benar!')
                    return true
                    break
                  } 
                }
                if (parseInt($("#Kesejahteraan510").val()) > parseInt($("#Kesejahteraan511").val()) || isNaN(parseInt($("#Kesejahteraan510").val())) || isNaN(parseInt($("#Kesejahteraan511").val())) || $("#Kesejahteraan510").val() == "" || $("#Kesejahteraan511").val() == "") {
                  alert('KEPALA SEKSI KESEJAHTERAAN, Pertanyaan Nomer 52 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                  return true
                } 
                Kesejahteraan += ($("input[name='Kesejahteraan0']:checked").val()+"|"+
                                $("input[name='Kesejahteraan1']:checked").val()+"|"+
                                $("input[name='Kesejahteraan2']:checked").val())
                for (let i = 3; i < 5; i++) {
                  if (parseInt($("#Kesejahteraan"+i+"0").val()) / parseInt($("#Kesejahteraan"+i+"1").val()) * 100 < 26 || isNaN(parseInt($("#Kesejahteraan"+i+"0").val()) / parseInt($("#Kesejahteraan"+i+"1").val()) * 100) || parseInt($("#Kesejahteraan"+i+"0").val()) / parseInt($("#Kesejahteraan"+i+"1").val()) * 100 == Infinity) {
                    Kesejahteraan += '|1'
                  } else if (parseInt($("#Kesejahteraan"+i+"0").val()) / parseInt($("#Kesejahteraan"+i+"1").val()) * 100 < 51) {
                    Kesejahteraan += '|2'
                  } else if (parseInt($("#Kesejahteraan"+i+"0").val()) / parseInt($("#Kesejahteraan"+i+"1").val()) * 100 < 76) {
                    Kesejahteraan += '|3'
                  } else {
                    Kesejahteraan += '|4'
                  } 
                }     
                for (let i = 5; i < 51; i++) {
                  if (parseInt($("#Kesejahteraan"+i+"0").val()) / parseInt($("#Kesejahteraan"+i+"1").val()) * 100 > 100 || isNaN(parseInt($("#Kesejahteraan"+i+"0").val()) / parseInt($("#Kesejahteraan"+i+"1").val()) * 100) || parseInt($("#Kesejahteraan"+i+"0").val()) / parseInt($("#Kesejahteraan"+i+"1").val()) * 100 == Infinity) {
                    Kesejahteraan += '|1'
                  } else if (parseInt($("#Kesejahteraan"+i+"0").val()) / parseInt($("#Kesejahteraan"+i+"1").val()) * 100 > 90) {
                    Kesejahteraan += '|2'
                  } else if (parseInt($("#Kesejahteraan"+i+"0").val()) / parseInt($("#Kesejahteraan"+i+"1").val()) * 100 > 80) {
                    Kesejahteraan += '|3'
                  } else {
                    Kesejahteraan += '|4'
                  } 
                }
                if (parseInt($("#Kesejahteraan"+51+"0").val()) / parseInt($("#Kesejahteraan"+51+"1").val()) * 100 < 26 || isNaN(parseInt($("#Kesejahteraan"+51+"0").val()) / parseInt($("#Kesejahteraan"+51+"1").val()) * 100) || parseInt($("#Kesejahteraan"+51+"0").val()) / parseInt($("#Kesejahteraan"+51+"1").val()) * 100 == Infinity) {
                  Kesejahteraan += '|1'
                } else if (parseInt($("#Kesejahteraan"+51+"0").val()) / parseInt($("#Kesejahteraan"+51+"1").val()) * 100 < 51) {
                  Kesejahteraan += '|2'
                } else if (parseInt($("#Kesejahteraan"+51+"0").val()) / parseInt($("#Kesejahteraan"+51+"1").val()) * 100 < 76) {
                  Kesejahteraan += '|3'
                } else {
                  Kesejahteraan += '|4'
                } 
              }
            }
            // Pelayanan
            var Pelayanan = ''
            var Cek = false
            var Tanya = 0
            for (let i = 0; i < 3; i++) {
              if ($("input[name='Pelayanan"+i+"']:checked").val() == undefined) {
                Cek = true
                Tanya = i+1
                break
              } 
            }
            if (Cek) {
              alert('KASI PELAYANAN, Pertanyaan Nomer '+Tanya+' Wajib Di Isi!')
              return true
            } 
            else {
              if (parseInt($("#Pelayanan30").val()) > parseInt($("#Pelayanan31").val()) || isNaN(parseInt($("#Pelayanan30").val())) || isNaN(parseInt($("#Pelayanan31").val())) || $("#Pelayanan30").val() == "" || $("#Pelayanan31").val() == "") {
                alert('KASI PELAYANAN, Pertanyaan Nomer 4 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                return true
              } else if (parseInt($("#Pelayanan40").val()) > parseInt($("#Pelayanan41").val()) || isNaN(parseInt($("#Pelayanan40").val())) || isNaN(parseInt($("#Pelayanan41").val())) || $("#Pelayanan40").val() == "" || $("#Pelayanan41").val() == "") {
                alert('KASI PELAYANAN, Pertanyaan Nomer 5 Input Pertama Harus Lebih Kecil Dari input Kedua!')
                return true
              } else {
                for (let i = 5; i < 77; i++) {
                  if (isNaN(parseInt($("#Pelayanan"+i+"0").val())) || isNaN(parseInt($("#Pelayanan"+i+"1").val())) || $("#Pelayanan"+i+"0").val() == "" || $("#Pelayanan"+i+"1").val() == "") {
                    alert('KASI PELAYANAN, Pertanyaan Nomer '+(i+1)+' Belum Benar!')
                    return true
                    break
                  } 
                }
                if (isNaN(parseInt($("#Pelayanan770").val())) || isNaN(parseInt($("#Pelayanan771").val())) || $("#Pelayanan770").val() == "" || $("#Pelayanan771").val() == "") {
                  alert('KASI PELAYANAN, Pertanyaan Nomer 78 Belum Benar!')
                  return true
                } else if (isNaN(parseInt($("#Pelayanan780").val())) || isNaN(parseInt($("#Pelayanan781").val())) || $("#Pelayanan780").val() == "" || $("#Pelayanan781").val() == "") {
                  alert('KASI PELAYANAN, Pertanyaan Nomer 79 Belum Benar!')
                  return true
                } else if (parseInt($("#Pelayanan790").val()) < parseInt($("#Pelayanan791").val()) || isNaN(parseInt($("#Pelayanan790").val())) || isNaN(parseInt($("#Pelayanan791").val())) || $("#Pelayanan790").val() == "" || $("#Pelayanan791").val() == "") {
                  alert('KASI PELAYANAN, Pertanyaan Nomer 80 Input Pertama Harus Lebih Besar Dari input Kedua!')
                  return true
                } else if (parseInt($("#Pelayanan800").val()) < parseInt($("#Pelayanan801").val()) || isNaN(parseInt($("#Pelayanan800").val())) || isNaN(parseInt($("#Pelayanan801").val())) || $("#Pelayanan800").val() == "" || $("#Pelayanan801").val() == "") {
                  alert('KASI PELAYANAN, Pertanyaan Nomer 81 Input Pertama Harus Lebih Besar Dari input Kedua!')
                  return true
                } 
                Pelayanan += ($("input[name='Pelayanan0']:checked").val()+"|"+
                                $("input[name='Pelayanan1']:checked").val()+"|"+
                                $("input[name='Pelayanan2']:checked").val())
                for (let i = 3; i < 5; i++) {
                  if (parseInt($("#Pelayanan"+i+"0").val()) / parseInt($("#Pelayanan"+i+"1").val()) * 100 < 26 || isNaN(parseInt($("#Pelayanan"+i+"0").val()) / parseInt($("#Pelayanan"+i+"1").val()) * 100) || parseInt($("#Pelayanan"+i+"0").val()) / parseInt($("#Pelayanan"+i+"1").val()) * 100 == Infinity) {
                    Pelayanan += '|1'
                  } else if (parseInt($("#Pelayanan"+i+"0").val()) / parseInt($("#Pelayanan"+i+"1").val()) * 100 < 51) {
                    Pelayanan += '|2'
                  } else if (parseInt($("#Pelayanan"+i+"0").val()) / parseInt($("#Pelayanan"+i+"1").val()) * 100 < 76) {
                    Pelayanan += '|3'
                  } else {
                    Pelayanan += '|4'
                  } 
                }     
                for (let i = 5; i < 77; i++) {
                  if (parseInt($("#Pelayanan"+i+"0").val()) / parseInt($("#Pelayanan"+i+"1").val()) * 100 > 100 || isNaN(parseInt($("#Pelayanan"+i+"0").val()) / parseInt($("#Pelayanan"+i+"1").val()) * 100) || parseInt($("#Pelayanan"+i+"0").val()) / parseInt($("#Pelayanan"+i+"1").val()) * 100 == Infinity) {
                    Pelayanan += '|1'
                  } else if (parseInt($("#Pelayanan"+i+"0").val()) / parseInt($("#Pelayanan"+i+"1").val()) * 100 > 90) {
                    Pelayanan += '|2'
                  } else if (parseInt($("#Pelayanan"+i+"0").val()) / parseInt($("#Pelayanan"+i+"1").val()) * 100 > 80) {
                    Pelayanan += '|3'
                  } else {
                    Pelayanan += '|4'
                  } 
                }
                if (parseInt($("#Pelayanan770").val()) / parseInt($("#Pelayanan771").val()) * 100 > 36 || isNaN(parseInt($("#Pelayanan770").val()) / parseInt($("#Pelayanan771").val()) * 100) || parseInt($("#Pelayanan770").val()) / parseInt($("#Pelayanan771").val()) * 100 == Infinity) {
                  Pelayanan += '|1'
                } else if (parseInt($("#Pelayanan770").val()) / parseInt($("#Pelayanan771").val()) * 100 > 27) {
                  Pelayanan += '|2'
                } else if (parseInt($("#Pelayanan770").val()) / parseInt($("#Pelayanan771").val()) * 100 > 20) {
                  Pelayanan += '|3'
                } else {
                  Pelayanan += '|4'
                } 
                if (parseInt($("#Pelayanan780").val()) / parseInt($("#Pelayanan781").val()) * 100 > 75 || isNaN(parseInt($("#Pelayanan780").val()) / parseInt($("#Pelayanan781").val()) * 100) || parseInt($("#Pelayanan780").val()) / parseInt($("#Pelayanan781").val()) * 100 == Infinity) {
                  Pelayanan += '|1'
                } else if (parseInt($("#Pelayanan780").val()) / parseInt($("#Pelayanan781").val()) * 100 > 50) {
                  Pelayanan += '|2'
                } else if (parseInt($("#Pelayanan780").val()) / parseInt($("#Pelayanan781").val()) * 100 > 25) {
                  Pelayanan += '|3'
                } else {
                  Pelayanan += '|4'
                } 
                if (parseInt($("#Pelayanan790").val()) / parseInt($("#Pelayanan791").val()) > 75 || isNaN(parseInt($("#Pelayanan790").val()) / parseInt($("#Pelayanan791").val()) * 100) || parseInt($("#Pelayanan790").val()) / parseInt($("#Pelayanan791").val()) * 100 == Infinity) {
                  Pelayanan += '|1'
                } else if (parseInt($("#Pelayanan790").val()) / parseInt($("#Pelayanan791").val()) > 50) {
                  Pelayanan += '|2'
                } else if (parseInt($("#Pelayanan790").val()) / parseInt($("#Pelayanan791").val()) > 25) {
                  Pelayanan += '|3'
                } else {
                  Pelayanan += '|4'
                }
                if (parseInt($("#Pelayanan800").val()) / parseInt($("#Pelayanan801").val()) > 75 || isNaN(parseInt($("#Pelayanan800").val()) / parseInt($("#Pelayanan801").val()) * 100) || parseInt($("#Pelayanan800").val()) / parseInt($("#Pelayanan801").val()) * 100 == Infinity) {
                  Pelayanan += '|1'
                } else if (parseInt($("#Pelayanan800").val()) / parseInt($("#Pelayanan801").val()) > 50) {
                  Pelayanan += '|2'
                } else if (parseInt($("#Pelayanan800").val()) / parseInt($("#Pelayanan801").val()) > 25) {
                  Pelayanan += '|3'
                } else {
                  Pelayanan += '|4'
                }
              }
            }
            var KinerjaAparatur = { Kecamatan: $("#Kecamatan").val(),
                                    Desa: $("#Desa").val(),
                                    JumlahDusun: parseInt($("#Dusun").val()),
                                    KepalaDesa: KepalaDesa,SekertarisDesa: SekertarisDesa,TU: TU, Keuangan: Keuangan,
                                    Perencanaan: Perencanaan,Pemerintahan: Pemerintahan,Kesejahteraan: Kesejahteraan,Pelayanan: Pelayanan }
            $.post(BaseURL+"Surveyor/InputKinerjaAparatur", KinerjaAparatur).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/SurveiKinerjaAparatur"
              } else { 
                alert(Respon)
              }
            })
          }
        })
        
      })
		</script>
  </body>
</html>