      	<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="card-header bg-primary text-white">
                      <b>SURVEI KINERJA PENYELENGGARAAN PEMERINTAHAN DESA</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-4 my-1">
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
                          <div class="col-sm-4 my-1">
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
                          <?php 
                            $Tanya =  array('Apakah visi dan misi penyelenggaraan pemerintahan desa yang dituangkan dalam LPPDes sesuai dengan RPJMDes?',
                                            'Apakah arah dan strategi yang dituangkan dalam LPPDes selaras dengan RKPDes dan APBDes yang telah disusun?',
                                            'Berapakah PADes dan Dana Desa yang dimiliki sesuai dengan yang dicantumkan di LPPDes?',
                                            'Berapakah total belanja untuk aparatur desa & berapa total belanja sesuai yang dituangkan di APBDes?',
                                            'Berapakah hasil SiLPA? (Terselanggaranya semua program kegiatan dan terdapat laporan sisa hasil anggaran)',
                                            'Keberhasilan apa sajakah yang telah dicapai dalam setiap bidang aspek baik pelaksanaan pemerintahan desa, pelaksanaan pembangunan, pembinaan kemasyarakatan dan pemberdayaan masyarakat yang telah dituangkan dalam Laporan Penyelenggaran Pemerintahan Desa (LPPDes)?  (Dalam 1 Tahun)',
                                            'Permasalahan apa sajakah yang dihadapi dalam setiap bidang aspek baik pelaksanaan pemerintahan desa, pelaksanaan pembangunan, pembinaan kemasyrakatan dan pemberdayaan masyarakat yang telah dituangkan dalam Laporan Penyelenggaran Pemerintahan Desa (LPPDes)? Serta berapakah persentase tindak lanjut yang telah dicapai dalam menyelesaikan permasalahan tersebut?',
                                            'Apakah setiap program dari aspek bidang penyelenggaraan pemerintahan desa sesuai/selaras dengan :<br>a. Peraturan desa<br>b. Peraturan bersama kepala desa<br>c. Peraturan kepala desa<br>d. Keputusan kepala desa',
                                            'Apakah di LPPDes tercantum data terkait :<br>a. Jumlah total penduduk<br>b. Jumlah penduduk laki-laki<br>c. Jumlah penduduk perempuan<br>d. Jumlah kepala keluarga<br>e. Jumlah anggota keluarga<br>f. Jumlah penduduk menurut tingkat Pendidikan umum<br>g. Jumlah penduduk tingkat kebutuhan khusus<br>h. Jumlah penduduk menurut mata pencaharian PNS<br>i. Jumlah penduduk menurut mata pencaharian TNI<br>j. Jumlah penduduk menurut mata pencaharian SWASTA<br>k. Jumlah aparat pemerintah PNS dan NON PNS<br>l. Jumlah BPD',
                                            'Apakah di LPPDes tercantum data terkait :<br>a.Status tanah yang memiliki sertifikat hak milik<br>b.Status tanah yang memiliki sertifikat hak guna usaha<br>c.Status tanah yang memiliki sertifikat hak pakai<br>d.Luas tanah yang bersertifikat<br>e.Luas tanah yang belum bersertifikat<br>f.Luas tanah kas desa<br>g.Luas tanah untuk keperuntukkan jalan<br>h.Luas tanah untuk keperuntukkan tanah ladang<br>i.Luas tanah untuk keperuntukkan bangunan umum<br>j.Luas tanah untuk keperuntukkan perumahan<br>k.Luas tanah untuk keperuntukkan ruang fasilitas umum<br>l.Tanah yang belum dikelola (hutan)<br>m.Tanah yang belum dikelola (rawa-rawa)',
                                            'Berapakah target dan realisasi dari setiap program sesuai keputusan pada saat Musyawarah desa, musrenbangdesa, musyawarah BPD yang dituangkan dalam LPPDes?',
                                            'Berapakah jumlah hansip yang tersedia di Desa? Dan berapakah banyak penduduk desa?',
                                            'Apakah di desa terdapat :<br>a. pos pemadam kebakaran<br>b. alat pemadam kebakaran<br>c. Pompa hidran<br>d. Kelompok sukarelawan pemadam kebakaran tingkat RT/RW',
                                            'Apakah di desa terdapat :<br>a. petugas sigap bencana alam<br>b. persediaan obat-obatan untuk gempa<br>c. alat deteksi bencana<br>d. tenda evakuasi bencana',
                                            'Apakah tersedia pos keamanan desa dan jadwal ronda setiap harinya dalam sebulan?',
                                            'Berapa kali terjadi kecelakaan remaja di desa setiap tahun?',
                                            'Apakah tersedia :<br>1. RT/RW<br>2. PKK<br>3. Karang taruna<br>4. Pos pelayanan terpadu<br>5. LPM',
                                            'Apakah Lembaga kemasyarakatan membantu keterlaksanaan setiap program desa?',
                                            'Apa saja infrastruktur yang tersedia di desa terkait:<br>a. Jalan desa<br>b. Jalan kabupaten/kota <br>c. Jembatan<br>d. Kantor kepala desa',
                                            'Berapa panjang jalan yang ada di desa & luas wilayah desa?',
                                            'Apa saja fasilitas Pendidikan desa terkait :<br>a. Kelompok bermain <br>b. TK<br>c. SD<br>d. SMP<br>e. SMA/SMK<br>f. Akademi<br>g. Institut/sekolah tinggi<br>h. Pendidikan pesantren<br>i. Madrasah<br>j. SLB<br>k. Balai latihan kerja<br>l. Kursus',
                                            'Berapa jumlah ketersediaan TK yang ada di desa & Berapa banyak penduduk desa yang bersekolah TK di desa?',
                                            'Berapa jumlah ketersediaan SD yang ada di desa & Berapa banyak penduduk desa yang bersekolah SD di desa?',
                                            'Berapa jumlah ketersediaan SMP yang ada di desa & Berapa banyak penduduk desa yang bersekolah SMP di desa?',
                                            'Berapa jumlah ketersediaan SMA/SMK/MA yang ada di desa & Berapa banyak penduduk desa yang bersekolah SMA/SMK/MA di desa?',
                                            'Berapa jumlah ketersediaan pesantren/madrasah yang ada di desa & Berapa banyak penduduk desa yang menuntut ilmu di pesantren/madrasah di desa?',
                                            'Apa saja fasilitas kesehatan desa terkait :<br>a. RS umum pemerintah<br>b. RS umum swasta<br>c. RS kusta<br>d. RS mata<br>e. RS Jiwa<br>f. RS bersalin<br>g. Rumah bidan<br>h. Puskesmas<br>i. Apotik',
                                            'Berapa jumlah fasilitas Kesehatan yang ada di desa & Berapa jumlah penduduk desa?',
                                            'Apakah di desa tersedia fasilitas kesenian/kebudayaan terkait:<br>a. Gelanggang remaja<br>b. Gedung kesenian<br>c. Gedung teater<br>d. Gedung bioskop',
                                            'Apakah di desa tersedia fasilitas sarana sosial terkait :<br>a. Panti asuhan<br>b. Panti pijat tunanetra<br>c. Panti wordo<br>d. Panti jompo',
                                            'Berapakah jumlah industri yang ada di Desa & berapakah penduduk desa yang bekerja di industri tersebut?',
                                            'Apakah terdapat tempat pemisahan pembuangan sampah antara organik, anorganik dan b3 (bahan berbahaya dan beracun)?',
                                            'Apakah masyarakat aktif mengikuti setiap kegiatan yang diadakan oleh pemerintah desa?',
                                            'Berapa banyak dilakukannya sosialisasi kepada masyarakat terkait hak dan kewajiban bermasyarakat?',
                                            'Apakah masukkan berupa kritik dan saran dari masyarakat untuk pemerintah desa tersampaikan melalui:<br>a. Papan informasi<br>b. Forum rapat<br>c. Website desa',
                                            'Apakah terdapat pertengkaran/perselisihan antar penduduk desa & Berapa kali dalam setahun terjadi pertengkaran/perselisihan antar penduduk desa?',
                                            'Apakah di desa terdapat :<br>a. majlis taklim<br>b. majlis gereja<br>c. majlis budha<br>d. majlis hindu<br>e. remaja masjid<br>f. remaja gereja<br>g. remaja budha<br>h. remaja hindu',
                                            'Berapa kali pemerintah desa melakukan monitoring kegiatan dalam 1 tahun terkait sosialisasi dan motivasi oleh pemerintah desa?',
                                            'Berapa kali pemerintah desa melakukan monitoring kegiatan dalam 1 tahun terkait pemberdaayaan masyarakat?',
                                            'Berapa kali pemerintah desa melakukan monitoring kegiatan dalam 1 tahun terkait penggalangan partisipasi masyarakat dibidang Pendidikan dan kesehatan?'); 
                            $Opsi = array('Sangat Selaras|Cukup Selaras|Kurang Selaras|Tidak Selaras',
                                          'Sangat Selaras|Cukup Selaras|Kurang Selaras|Tidak Selaras',
                                          'PADes|Dana Desa',
                                          'Total belanja untuk aparatur desa|Total belanja Berdasarkan APBDes',
                                          'program telah terselenggara semua & SiLPA < 30% dari pendapatan desa|program telah terselenggara semua & SiLPA = 0 dari pendapatan desa|program telah terselenggara semua & SiLPA < 0 dari pendapatan desa|ada program yang belum terselenggara & SiLPA > 0 dari pendapatan desa',
                                          'Keberhasilan yang telah dicapai > 5|Keberhasilan yang telah dicapai 4-5|Keberhasilan yang telah dicapai 2-3|Keberhasilan yang telah dicapai < 2',
                                          'tindak lanjut sebesar 76-100%|tindak lanjut sebesar 56-75%|tindak lanjut sebesar 40-55%|tindak lanjut sebesar < 40%',
                                          'Selaras semua|Selaras 3|Selaras 2|Selaras 1',
                                          'Tercatat semua item di LPPDes|Tercatat > 5 item di LPPDes|Tercatat hanya 5 item di LPPDes|Tercatat < 5 item di LPPDes',
                                          'Tercatat semua item di LPPDes|Tercatat > 8 item di LPPDes|Tercatat hanya 5 item di LPPDes|Tercatat < 5 item di LPPDes',
                                          'Realisasi|Target',
                                          'Jumlah hansip|Jumlah penduduk',
                                          'tersedia semua item|tersedia 3 item|tersedia 1-2 item|tidak tersedia',
                                          'tersedia semua item|tersedia 3 item|tersedia 1-2 item|tidak tersedia',
                                          'Ketersediaan pos keamanan desa & ada jadwal ronda setiap harinya dalam sebulan|Tidak tersedia pos keamanan & tetapi ada jadwal ronda tiap harinya|Tersedia pos keamanan desa tapi tidak ada jadwal ronda tiap harinya dalam sebulan|Tidak tersedia pos keamanan & tidak ada jadwal ronda tiap harinya',
                                          'Jika kecelakaan remaja 1-2x|Jika kecelakaan remaja 3-4x|Jika kecelakaan remaja 5x|Jika kecelakaan remaja > 5x',
                                          'tersedia semua item|tersedia 3 item|tersedia 1-2 item|tidak tersedia',
                                          'selalu berpartisipasi keterlaksanaan program desa|sering berpartisipasi keterlaksanaan program desa|kadang-kadang berpartisipasi keterlaksanaan program desa|tidak pernah berpartisipasi keterlaksanaan program desa',
                                          'Jika tersedia semua infrastruktur tersebut|Jika hanya tersedia 3 jenis infrastruktur|Jika hanya tersedia 2 jenis infrastruktur|Jika hanya tersedia 1 jenis infrastruktur',
                                          'Panjang jalan|Luas wilayah',
                                          'tersedia semua fasilitas Pendidikan tersebut|tersedia 5-10 jenis fasilitas pendidikan tersebut|tersedia 3-4 jenis fasilitas pendidikan tersebut|tersedia <3 jenis fasilitas pendidikan tersebut',
                                          'Jumlah TK|Jumlah siswa TK',
                                          'Jumlah SD|Jumlah siswa SD',
                                          'Jumlah SMP|Jumlah siswa SMP',
                                          'Jumlah SMA/SMK/MA|Jumlah siswa SMA/SMK/MA',
                                          'Jumlah ketersediaan pesantren/madrasah|Jumlah penduduk yang menuntut ilmu di pesantren/madrasah',
                                          'Jika tersedia semua fasilitas Kesehatan tersebut|Jika hanya tersedia 6-9 jenis fasilitas kesehatan|Jika hanya tersedia 3-5 jenis fasilitas kesehatan|Jika hanya tersedia < 3 jenis fasilitas kesehatan',
                                          'Jumlah Fasilitas Kesehatan|Jumlah penduduk',
                                          'Tersedia semua fasilitas kesenian tersebut|Tersedia 2-3 fasilitas kesenian tersebut|Tersedia 1 fasilitas kesenian tersebut|Tidak tersedia fasilitas kesenian tersebut',
                                          'Tersedia semua fasilitas sosial tersebut|Tersedia 2-3 fasilitas sosial|Tersedia 2-3 fasilitas sosial|Tidak tersedia fasilitas sosial',
                                          'Jumlah industri  yang ada di Desa|Jumlah penduduk yang bekerja di industri tersebut',
                                          'Terdapat 3 jenis pemisahan sampah|Terdapat 2 jenis pemisahan sampah|Terdapat 1 jenis pemisahan sampah|Tidak terdapat pemisahan sampah',
                                          'Selalu mengikuti kegiatan & tersedia semua absensi kehadiran disetiap kegiatan|Selalu mengikuti kegiatan tapi hanya tersedia sebagian absensi kegiatan|Selalu mengikuti kegiatan tetapi tidak ada absensi kehadiran dalam semua kegiatan|Tidak mengikuti kegiatan dan tidak ada absensi kehadiran kegiatan',
                                          'Sosialisasi dilakukan > 4x dalam 1 tahun & dibuktikan dalam laporan kegiatan sosialisasi|Sosialisasi dilakukan 3-4x dalam 1 tahun & dibuktikan dalam laporan kegiatan sosialisasi|Sosialisasi dilakukan 1-2x dalam 1 tahun & dibuktikan dalam laporan kegiatan sosialisasi|Tidak pernah dilakukannya sosialisasi',
                                          'Tersampaikan dalam semua item terkait kritik dan saran masyarakat|Hanya tersampaikan lewat 2 media saja|Hanya tersampaikan lewat salah satu media saja |Tidak tersedianya media masukan berupa kritik dan saran dari masyarakat',
                                          'Tidak terdapat pertengkaran/perselisihan antar penduduk desa|Terdapat pertengkaran/perselisihan antar penduduk desa 1x|Terdapat pertengkaran/perselisihan antar penduduk desa 2-5x|Terdapat pertengkaran/perselisihan antar penduduk desa > 5x',
                                          'Terdapat semua majlis/remas|Terdapat 5-7 majlis/remas|Terdapat 1-4 majlis/remas|Tidak terdapat majlis/remas',
                                          'Pemerintah desa melakukan monitoring > 2x & terdapat bukti fisik kegiatan monitoring|Pemerintah desa melakukan monitoring 2x & terdapat bukti fisik kegiatan monitoring|Pemerintah desa melakukan monitoring 1x & terdapat bukti fisik kegiatan monitoring|Pemerintah desa tidak pernah melakukan monitoring',
                                          'Pemerintah desa melakukan monitoring > 2x & terdapat bukti fisik kegiatan monitoring|Pemerintah desa melakukan monitoring 2x & terdapat bukti fisik kegiatan monitoring|Pemerintah desa melakukan monitoring 1x & terdapat bukti fisik kegiatan monitoring|Pemerintah desa tidak pernah melakukan monitoring',
                                          'Pemerintah desa melakukan monitoring > 2x & terdapat bukti fisik kegiatan monitoring|Pemerintah desa melakukan monitoring 2x & terdapat bukti fisik kegiatan monitoring|Pemerintah desa melakukan monitoring 1x & terdapat bukti fisik kegiatan monitoring|Pemerintah desa tidak pernah melakukan monitoring');                              
                          ?>
                          <?php for ($i=0; $i < count($Tanya); $i++) { $Pisah = explode("|",$Opsi[$i]);?>
                            <div class="col-sm-5 my-1">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <p class="input-group-text bg-danger text-white text-justify text-wrap"><b><?=($i+1).". ".$Tanya[$i]?></b></p>
                                </div>
                              </div>
                            </div> 
                            <div class="col-sm-7 bg-primary p-2 my-1">
                              <div class="input-group input-group-sm">
                                <?php if (count($Pisah) == 4) { ?>
                                  <?php for ($j=0; $j < 4; $j++) { ?>
                                    <div class="form-check form-check-inline ml-4 my-1">
                                      <input style="transform: scale(1.5);" class="form-check-input" type="radio" name="I<?=$i?>" id="I<?=$i.$j?>" value="<?=(4-$j)?>">
                                      <label class="form-check-label font-weight-bold text-white" for="I<?=$i.$j?>">&nbsp;<?=$Pisah[$j]?></label>
                                    </div>
                                  <?php } ?>
                                <?php } else if (count($Pisah) <= 2) { ?>
                                  <?php for ($j=0; $j < count($Pisah); $j++) { ?>
                                    <div class="input-group input-group-sm my-1">
                                      <div class="input-group-prepend">
                                        <label class="input-group-text bg-danger text-white"><b><?=($j+1).'. '.$Pisah[$j]?></b></label>
                                      </div>
                                      <input class="form-control" type="text" id="I<?=$i.$j?>" placeholder="Input Hanya Angka Saja">
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
  
        $("#Kirim").click(function() {
          var Poin = []
          var Cek = true
          var Radio = [0,1,4,5,6,7,8,9,12,13,14,15,16,17,18,20,26,28,29,31,32,33,34,35,36,37,38,39]
          for (let i = 0; i < Radio.length; i++) {
            if ($("input[name='I"+Radio[i]+"']:checked").val() == undefined) {
              Cek = false
              alert('Pertanyaan Nomer '+(Radio[i]+1)+' Wajib Di Isi!')
              break
            } else {
              Poin[Radio[i]] = $("input[name='I"+Radio[i]+"']:checked").val()
            }
          }
          if (Cek) {
            var Input = [2,3,10,11,19,21,22,23,24,25,27,30]
            var Tanya = ['PADes|Dana Desa','Penghasilan tetap aparatur desa|Total belanja pembangunan','Target|Realisasi',
                         'Jumlah hansip|Jumlah penduduk','Panjang jalan|Luas wilayah','Jumlah TK|Jumlah siswa TK',
                         'Jumlah SD|Jumlah siswa SD','Jumlah SMP|Jumlah siswa SMP','Jumlah SMA/SMK/MA|Jumlah siswa SMA/SMK/MA',
                         'Jumlah ketersediaan pesantren/madrasah|Jumlah penduduk yang menuntut ilmu di pesantren/madrasah',
                         'Jumlah Fasilitas Kesehatan|Jumlah penduduk','Jumlah industri yang ada di Desa|Jumlah penduduk yang bekerja di industri tersebut']
            for (let i = 0; i < Input.length; i++) {
              if (isNaN(parseInt($("#I"+Input[i]+"0").val()))) {
                alert('Input Pertanyaan Nomer '+(Input[i]+1)+' Hanya Boleh Angka!')
                Cek = false
                break
              } else if (isNaN(parseInt($("#I"+Input[i]+"1").val()))) {
                alert('Input Pertanyaan Nomer '+(Input[i]+1)+' Hanya Boleh Angka!')
                Cek = false
                break
              } else if (parseInt($("#I"+Input[i]+"0").val()) > parseInt($("#I"+Input[i]+"1").val()) && i != 4) {
                $Pisah = Tanya[i].split("|")
                alert('Pertanyaan Nomer '+(Input[i]+1)+', Input '+$Pisah[0]+' Tidak Boleh Lebih Besar Dari Input '+$Pisah[1])
                Cek = false
                break
              } else if (parseInt($("#I"+Input[i]+"0").val()) == 0 && parseInt($("#I"+Input[i]+"1").val()) == 0) {
                $Pisah = Tanya[i].split("|")
                alert('Pertanyaan Nomer '+(Input[i]+1)+', Input '+$Pisah[0]+' & '+$Pisah[1]+' Tidak boleh 0')
                Cek = false
                break
              }
            }
          } 
          if (Cek) {
            if ((parseInt($("#I"+Input[0]+"0").val())/parseInt($("#I"+Input[0]+"1").val())*100) < 40) {
              Poin[Input[0]] = '1'
            } else if ((parseInt($("#I"+Input[0]+"0").val())/parseInt($("#I"+Input[0]+"1").val())*100) < 56) {
              Poin[Input[0]] = '2'
            } else if ((parseInt($("#I"+Input[0]+"0").val())/parseInt($("#I"+Input[0]+"1").val())*100) < 76) {
              Poin[Input[0]] = '3'
            } else {
              Poin[Input[0]] = '4'
            } 
            if ((parseInt($("#I"+Input[1]+"0").val())/parseInt($("#I"+Input[1]+"1").val())*100) < 30) {
              Poin[Input[1]] = '4'
            } else if ((parseInt($("#I"+Input[1]+"0").val())/parseInt($("#I"+Input[1]+"1").val())*100) < 56) {
              Poin[Input[1]] = '3'
            } else if ((parseInt($("#I"+Input[1]+"0").val())/parseInt($("#I"+Input[1]+"1").val())*100) < 76) {
              Poin[Input[1]] = '2'
            } else {
              Poin[Input[1]] = '1'
            } 
            if ((parseInt($("#I"+Input[2]+"0").val())/parseInt($("#I"+Input[2]+"1").val())*100) < 40) {
              Poin[Input[2]] = '1'
            } else if ((parseInt($("#I"+Input[2]+"0").val())/parseInt($("#I"+Input[2]+"1").val())*100) < 56) {
              Poin[Input[2]] = '2'
            } else if ((parseInt($("#I"+Input[2]+"0").val())/parseInt($("#I"+Input[2]+"1").val())*100) < 76) {
              Poin[Input[2]] = '3'
            } else {
              Poin[Input[2]] = '4'
            } 
            if (parseInt($("#I"+Input[3]+"1").val()/parseInt($("#I"+Input[3]+"0").val())) < 3) {
              Poin[Input[3]] = '1'
            } else if (parseInt($("#I"+Input[3]+"1").val())/parseInt($("#I"+Input[3]+"0").val()) < 6) {
              Poin[Input[3]] = '2'
            } else if (parseInt($("#I"+Input[3]+"1").val())/parseInt($("#I"+Input[3]+"0").val()) < 11) {
              Poin[Input[3]] = '3'
            } else {
              Poin[Input[3]] = '4'
            } 
            if (parseInt($("#I"+Input[4]+"0").val()/parseInt($("#I"+Input[4]+"1").val())) < 11) {
              Poin[Input[4]] = '1'
            } else if (parseInt($("#I"+Input[4]+"0").val())/parseInt($("#I"+Input[4]+"1").val()) < 26) {
              Poin[Input[4]] = '2'
            } else if (parseInt($("#I"+Input[4]+"0").val())/parseInt($("#I"+Input[4]+"1").val()) < 36) {
              Poin[Input[4]] = '3'
            } else {
              Poin[Input[4]] = '4'
            } 
            if (parseInt($("#I"+Input[5]+"1").val()/parseInt($("#I"+Input[5]+"0").val())) < 1000) {
              Poin[Input[5]] = '4'
            } else if (parseInt($("#I"+Input[5]+"1").val())/parseInt($("#I"+Input[5]+"0").val()) < 1501) {
              Poin[Input[5]] = '3'
            } else if (parseInt($("#I"+Input[5]+"1").val())/parseInt($("#I"+Input[5]+"0").val()) < 2001) {
              Poin[Input[5]] = '2'
            } else {
              Poin[Input[5]] = '1'
            } 
            if (parseInt($("#I"+Input[6]+"1").val()/parseInt($("#I"+Input[6]+"0").val())) < 2000) {
              Poin[Input[6]] = '4'
            } else if (parseInt($("#I"+Input[6]+"1").val())/parseInt($("#I"+Input[6]+"0").val()) < 2501) {
              Poin[Input[6]] = '3'
            } else if (parseInt($("#I"+Input[6]+"1").val())/parseInt($("#I"+Input[6]+"0").val()) < 3001) {
              Poin[Input[6]] = '2'
            } else {
              Poin[Input[6]] = '1'
            }
            if (parseInt($("#I"+Input[7]+"1").val()/parseInt($("#I"+Input[7]+"0").val())) < 2000) {
              Poin[Input[7]] = '4'
            } else if (parseInt($("#I"+Input[7]+"1").val())/parseInt($("#I"+Input[7]+"0").val()) < 2501) {
              Poin[Input[7]] = '3'
            } else if (parseInt($("#I"+Input[7]+"1").val())/parseInt($("#I"+Input[7]+"0").val()) < 3001) {
              Poin[Input[7]] = '2'
            } else {
              Poin[Input[7]] = '1'
            }
            if (parseInt($("#I"+Input[8]+"1").val()/parseInt($("#I"+Input[8]+"0").val())) < 6000) {
              Poin[Input[8]] = '4'
            } else if (parseInt($("#I"+Input[8]+"1").val())/parseInt($("#I"+Input[8]+"0").val()) < 7001) {
              Poin[Input[8]] = '3'
            } else if (parseInt($("#I"+Input[8]+"1").val())/parseInt($("#I"+Input[8]+"0").val()) < 9001) {
              Poin[Input[8]] = '2'
            } else {
              Poin[Input[8]] = '1'
            }
            if (parseInt($("#I"+Input[9]+"1").val()/parseInt($("#I"+Input[9]+"0").val())) < 6000) {
              Poin[Input[9]] = '4'
            } else if (parseInt($("#I"+Input[9]+"1").val())/parseInt($("#I"+Input[9]+"0").val()) < 7001) {
              Poin[Input[9]] = '3'
            } else if (parseInt($("#I"+Input[9]+"1").val())/parseInt($("#I"+Input[9]+"0").val()) < 9001) {
              Poin[Input[9]] = '2'
            } else {
              Poin[Input[9]] = '1'
            }
            if (parseInt($("#I"+Input[10]+"1").val()/parseInt($("#I"+Input[10]+"0").val())) < 3000) {
              Poin[Input[10]] = '4'
            } else if (parseInt($("#I"+Input[10]+"1").val())/parseInt($("#I"+Input[10]+"0").val()) < 5001) {
              Poin[Input[10]] = '3'
            } else if (parseInt($("#I"+Input[10]+"1").val())/parseInt($("#I"+Input[10]+"0").val()) < 9001) {
              Poin[Input[10]] = '2'
            } else {
              Poin[Input[10]] = '1'
            }
            if ((parseInt($("#I"+Input[11]+"0").val())/parseInt($("#I"+Input[11]+"1").val())*100) < 40) {
              Poin[Input[11]] = '1'
            } else if ((parseInt($("#I"+Input[11]+"0").val())/parseInt($("#I"+Input[11]+"1").val())*100) < 56) {
              Poin[Input[11]] = '2'
            } else if ((parseInt($("#I"+Input[11]+"0").val())/parseInt($("#I"+Input[11]+"1").val())*100) < 76) {
              Poin[Input[11]] = '3'
            } else {
              Poin[Input[11]] = '4'
            } 
            var GabungPoin = ''
            for (let i = 0; i < Poin.length; i++) {
              i < (Poin.length-1) ? GabungPoin += (Poin[i]+'|') : GabungPoin += Poin[i]
            }
            var KinerjaPemdes = { Kecamatan: $("#Kecamatan").val(),
                                  Desa: $("#Desa").val(),
                                  Poin: GabungPoin }
            $.post(BaseURL+"Surveyor/InputKinerjaPemDes", KinerjaPemdes).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/SurveiKinerjaPemDes"
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