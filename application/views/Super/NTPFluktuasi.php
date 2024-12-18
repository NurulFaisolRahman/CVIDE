<div class="clearfix"></div>
            <div class="row">
              <?php $Tahun = $this->session->userdata('TahunNTP'); ?>
              <div class="col-lg-12">
                <div class="row mt-1">
                  <div class="col-lg-3">
                    <div class="input-group input-group-sm mb-1">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-light"><b>Sektor NTP</b></label>
                      </div>
                      <select class="custom-select" id="Sektor">           
                        <option value="1" <?=$this->uri->segment('3')==1?'selected':'';?>>Tanaman Pangan</option>
                        <option value="2" <?=$this->uri->segment('3')==2?'selected':'';?>>Hortikultura</option>
                        <option value="3" <?=$this->uri->segment('3')==3?'selected':'';?>>Perkebunan</option>
                        <option value="4" <?=$this->uri->segment('3')==4?'selected':'';?>>Peternakan</option>
                        <option value="5" <?=$this->uri->segment('3')==5?'selected':'';?>>Perikanan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="input-group input-group-sm mb-1">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-light"><b>NTP Tahun</b></label>
                      </div>
                      <select class="custom-select" id="TahunNTP">                    
                          <option value="2022" <?=$Tahun==2022?'selected':'';?>>2022</option>
                          <option value="2023" <?=$Tahun==2023?'selected':'';?>>2023</option>
                          <option value="2024" <?=$Tahun==2024?'selected':'';?>>2024</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="btn btn-sm btn-primary border-light" id="TampilkanData"><b>Tampilkan</b></div>
                  </div>
                </div>
                <?php 
                  $TanamanPangan = array('IA001001','IA001005','IA001006','IA002001','IA002006','IA003001','IA003006','IA004001','IB001003','IB002001','IB003001','IB005002','IB006001','IB006002','IB009001','JA101001','JA101003','JA101004','JA102003','JA102004','JA201002','JA202001','JA203001','JA204001','JA207001','JB001001','JB001002','JB001003','JB002002','JB004001','JB005001','JB006001','JB007001','JB014001','JB101002','JB102001','JB103001','JB105002','JC001001','JC002001','JC007001','JC009001','JC011001','JC013001','JD001001','JD002001','JD002002','JD002003','JD003002','JD004001','JD005002','JD006001','JD006002','JD006003','JD012001','JD013001','JF001001','JF002001','JF002002','JF005001','JF005002','JF007001','JF008001','JF009001','JF011001','JF012001','JF017001','JF018001','JF019001','JF023001','JF027001','JF028001','JF029001','JF034001','JG003001','JG005001','JG006001','JG012002','KA101101','KA101102','KA201101','KA301101','KA301102','KA401101','KA401102','KA501101','KA501102','KA601101','KA701101','KA801101','KA801102','KA911101','KA911102','KA921101','KA921102','KA961101');
                  $NamaTanamanPangan = array('Gabah Kering Giling (GKG) Ciherang','Gabah Kering Giling (GKG) IR 64','Gabah Kering Giling (GKG)','Gabah Kering Panen Ciherang','Gabah Kering Panen','Gabah Kualitas Rendah Ciherang','Gabah Kualitas Rendah','Gabah Ketan Kering Giling ','Jagung','Jagung pipilan kuning','Kacang hijau ','Kacang kedelai putih','Kacang tanah belum dikupas','Kacang tanah dikupas','Talas biasa','Bibit padi cisadane','Bibit padi IR64','Bibit padi','Benih padi IR 64','Benih padi','Bibit Jagung','Bibit Kacang tanah','Bibit Kacang kedelai','Bibit Kacang hijau','Bibit Talas','urea pusri','urea gresik','urea','SP36','ZA','KCL','NPK','pupuk kandang','petroganik','insektisida (furadan)','fungisida (baycor)','herbisida (DMA-6)','bakterisida (scoor)','sewa tanah ladang (surplus)','sewa tanah sawah (surplus)','sewa traktor tangan (kubota)','sewa penyemprotan hama','sewa tresher','sewa pompa air','ongkos angkut','bensin (premium)','bensin (pertalite)','bensin (pertamax)','solar','oli (mesran)','ban luar motor (IRC)','ban dalam motor (swallow)','ban dalam motor (IRC)','ban dalam motor','tarif servis sepeda','tarif servis motor','tampah/nyiru','karung (goni 50 kg)','karung (plastik 50 kg)','cangkul (pandai besi)','cangkul (pabrik)','arit/sabit (dengan gagang)','garu','traktor tangan (kubota)','golok','parang','pisau','linggis','ember (plastik diameter 30 cm)','terpal','kapak','mesin pemotong rumput','selang','tangki','biaya pengairan lahan','plastik transparan/mulsa','Bambu','Tali Rafia','Upah Mencangkul (Laki2)','Upah Mencangkul (perempuan)','upah Membajak (laki2)','upah Penanaman (Laki2)','upah Penanaman (perempuan)','upah merambet/menyiangi (laki2)','upah merambet/menyiangi(wanita)','upah Pemanenan (laki2)','upah Pemanenan (perempuan)','upah pemupukan (laki2)','upah Penyemprotan/OPT (Laki2)','upah Perontokan (laki2)','upah Perontokan (perempuan)','upah Mencabut Bibit (laki2)','upah Mencabut Bibit (perempuan)','upah Pemipilan (laki2)','upah Pemipilan (perempuan)','upah Pikul/Angkut (laki2)');
                  $Hortikultura = array('XA002001','XA004001','XA006001','XA007001','XA008001','XA011001','XA013001','XA015001','XA026001','XA029001','XB014003','XB015001','XB018002','XB019002','XB023001','XB023002','XB023004','XD001001','XD002001','XD004001','XD008001','YA101001','YA101002','YA101003','YA102001','YA103001','YA108001','YA110001','YA111001','YA115001','YA117001','YA203003','YA204002','YA204003','YA208001','YA208002','YA211001','YA211002','YA212001','YA212002','YA401001','YA402001','YA405001','YA408001','YB001001','YB001002','YB002002','YB004001','YB005001','YB006001','YB007001','YB016001','YB101002','YB102001','YB102002','YB103001','YB103002','YB106002','YB107001','YB601001','YB601002','YB602001','YB603001','YB604001','YD002001','YD002003','YD002004','YD003002','YF003001','YF005001','YF006001','YF006002','YF007001','YF018001','YF019001','YF607001','YF607002','ZA101101','ZA201101','ZA301101','ZA301102','ZA401101','ZA501101','ZA501102','ZA501103','ZA601101','ZA701101','ZA921101');
                  $NamaHortikultura = array('bawang merah','bayam','cabai hijau','cabai merah besar','cabai rawit','kacang panjang','kangkung','ketimun','sawi hijau','tomat','mangga','melon','pepaya lokal','pisang raja','semangka merah tanpa biji','semangka merah biji','semangka kuning biji','jahe','kunyit','lengkuas','sereh','bibit cabai merah','bibit cabai hijau','bibit cabai rawit','bibit sawi hijau','bibit bawang merah','bibit tomat','bibit kacang panjang','bibit bayam','bibit kangkung','bibit mentimun','bibit mangga','bibit pisang raja','bibit pisang susu','bibit semangka tanpa biji','bibit semangka ada biji','bibit melon lokal','bibit melon','bibit pepaya lokal','bibit pepaya','bibit jahe','bibit kunyit','bibit lengkuas','bibit sereh','urea pusri','urea gresik','super phosphate SP 36','zwavalezure ammoniak (ZA)','kalium chloride (KCL)','nitrogen phosphate kalium (NPK)','pupuk kandang','akarisida tedion','intektisida furadan','fungisida baycor','fungsida','herbisida DMA-6','herbisida','Akarisida','obat perekat/lem','ZPT Buah','ZPT Daun','KNO3','Pupuk Mikro Organisme','Pupuk Organik','bensin premium','bensin pertalite','bensin pertamax','solar','keranjang','gunting pangkas pandai besi','cangkul pabrik','cangkul pandai besi','arit/sabit','Linggis','Ember','Karung Goni','Karung Plastik','upah mencangkul laki-laki','upah membajak laki-laki','upah menanam laki-laki','upah menananm perempuan','upah merambet laki-laki','upah menuai / memanen laki-laki','upah menuai / memanen perempuan','upah menuai / memanen borongan','upah pemupukan laki-laki','upah penyemprotan laki-laki','upah penjarangan');
                  $Perkebunan = array('LA007001','LA009002','MA003001','MA004001','MB001002','MB002001','MB004001','MB006001','MB007001','MB008001','MB015001','MB016001','MB017001','MB101002','MB103003','MC001002','MC004001','MD001003','MD002002','MD003002','MD004001','MD005001','MD006001','MD007001','MD007002','MD008001','MD009001','MD014001','MD019001','ME002001','ME005001','ME006001','ME008001','ME017001','ME024001','ME026001','ME602002','ME604001','ME605001','ME612001','MF002001','MF012002','NA101101','NA201101','NA202101','NA301101','NA301102','NA401101','NA501101','NA601101','NA701101');
                  $NamaPerkebunan = array('tebu','tembakau daun kering','Bibit tebu','Bibit tembakau','urea gresik','Triple Super Phosphate/Super Phosphate (TSP/SP 36) TSP','Zwavalezure Ammoniak (ZA)','nitrogen Phospate Kalium (NPK) ','Pupuk Kandang','Dolomit/Kapur','Zat Perangsang Tumbuh (ZPT) daun','KNO3','pupuk organik','Insektisida furadan','Herbisida','sewa tanah ladang sedang','sewa traktor tangan kubota','ongkos angkut motor/ojek','bensin eceran pertalite','solar','oli mesran SAE40','tarif servis motor ringan/servis kecil','ban dalam motor swallow','ban luar motor IRC 250','ban luar motor','ban dalam sepeda swallow','ban luar sepeda swallow','tarif servis mobil ringan/servis kecil','tarif pulsa ponsel paket data','karung goni 50kg','cangkul pandai besi','arit dengan gagang','Garpu Tanah','Terpal','sprayer','truk','drum plastik 200 liter','selang air','gancu','jerigen','tarif servis traktor kubota','tali rafia','upah mencangkul laki-laki','upah menanam laki-laki','upah menanam perempuan','upah merambet laki-laki','upah merambet perempuan','upah menuai laki-laki','upah pemupukan laki-laki','upah penjemuran laki-laki','upah pemangkasan laki-laki');
                  $Peternakan = array('OA002005','OB001004','OC002003','OC008001','OC009001','OD008001','PA002002','PA601001','PA615002','PA618002','PA621001','PA623001','PA704001','PB102001','PB104001','PB106001','PB107001','PB108001','PB113001','PB116001','PB165001','PB165003','PB201001','PB203002','PB204001','PB205003','PB206001','PB206002','PB212001','PC002001','PC601001','PD002003','PD003002','PD004001','PD005001','PD601003','PE001001','PE002002','PE004002','PE013001','PE020001','PE602001','PE607001','PE608001','PE609001','PE610001','PE612001','PF015001','PF017001','PF019001','PF021001','PF023001','QA101101','QA301101');
                  $NamaPeternakan = array('Sapi Potong Lokal','Kambing','Itik/Bebek (Lokal)','Ayam Ras Pedaging ','Ayam Ras Petelur','Telur Itik/Bebek','Bibit Sapi (Umur < 2 Bulan)','Bibit Itik/Bebek','Bibit Sapi (Umur 2 s/d ≤ 12 Bulan)','Bibit Kambing (2 s/d ≤ 12 Bulan)','Bibit Ayam Ras Pedaging (Umur < 5 hari)','Bibit Ayam Ras Petelur (Umur < 5 hari)/DOC','Bibit Kambing > 1 Th','Vitamin ( B-12)','Garam','Antiseptika dan Desinfektansia','Analgesika/Anti Piretika/Antibiotika','Anti Fungi/Anti Jamur','Obat Diare','Anti Defisiensi Vitamin & Mineral','Vaksin (Ternak Besar)','Vaksin (Unggas)','Dedak (Gabah)','Rumput','Jagung Pipilan','Pakan Jadi (Konsentrat)','Pur (Halus)','Pur (Kasar)','Ampas Tahu','Sewa Padang/Lahan Penggembalaan','Sewa Kandang Peternakan','Bensin (Pertalite)','Solar','Oli/Pelumas','Tarif Servis Motor (Ringan/Tune up)','Tarif Pulsa Ponsel (Paket Data )','Ember (Plastik)','Tempat Minum Unggas (Cap Globe)','Tempat Makan Unggas','Arit','Mesin Giling Pakan','Keranjang','Alat Penyemprot (Hand Sprayer )','Lemari Pendingin (Cold Storage )','Waring','Blower/Kipas','Drum','Bola Lampu','Gas LPG (3 Kg)','PDAM','Sekam','Jasa Kesehatan Ternak','Upah Pemeliharaan Ternak(Pria)','Upah Mencari Rumput(Pria)');
                  $Perikanan = array('RB020001','RB037001','RB040001','RB042005','RB047001','RB053001','RB055001','RB056001','RB072004','RB096001','RB099001','RB104001','RB109004','RB111001','RB113001','RB131001','SB002003','SB003002','SB007002','SC010004','SC011004','SC016001','SC018001','SC020001','SC021001','SC025001','SC028001','SC038001','SF501101','TB003005','TA033001','TA014001','TA019003','UA102005','UA022001','UA013001','UA018003','UB001002','UB002002','UB003001','UB061001','UB102001','UB104001','UB105001','UB202002','UB204001','UC001001','UD002003','UD003002','UD005003','UE005001','UE007001','UE032001','UE606001','UE609001','UH011101','UH201101','UH301101','UH401101','UH501101','UH601101');
                  $NamaPerikanan = array('Cucut','Kapasan (Kapas-kapas)','Kembung(Kombong/Sumbo','Kerapu (Garopa/Groper)','Kurisi (Kerisi)','Layang (Malalugis/Momar)','Layur (Beladang)','Lemuru (Dencis)','Pari (Hidung Sekop)','Tenggiri','Teri','Tongkol','Udang (Laut) (Windu)','Kepiting Laut','Cumi-cumi','Kakap (Merah)','Bensin ( Pertalite)','Solar (Solar)','Gas LPG (Pertamina)','Perangkap','Keranjang ( Plastik )','Senter','Jerigen','Aki/Accu','Termos','Pelampung','Serok','Terpal ','Upah Penangkapan (Laki-laki)','Kerapu Budidaya','Bandeng','Nila','Udang (Vannamei)','Bibit Kerapu Budidaya','Bibit Bandeng/Nener (< 5 Cm)','Bibit Nila','Bibit Udang (Vannamei)','Urea (Gresik)','Triple Super Phosphate (TSP/SP36)','Zwavalezure Ammoniak (ZA)','Nitrogen Phospate Kalium(NPK)','Thiodan','Pembasmi kuman/Bakteri(Saponin)','Vitamin','Pelet','Ikan Segar/Rucah','Sewa Tanah Untuk Tambak/Kolam','Bensin Eceran (Pertalite)','Solar (BBM Solar)','Tarif Pulsa Ponsel(Paket Data)','Jaring Angkat','Perangkap(Sero)','Drum Plastik/Blong','Ember','Selang','Upah Pengolahan Lahan(Pria)','Upah Penebaran Benih(Pria)','Upah Pemupukan(Pria)','Upah Pemberian Pakan/Obat(Pria)','Upah Penjagaan Areal Budidaya(Pria)','Upah Pemanenan(Pria)');
                ?>
                <div class="row mt-1">
                  <div class="col-lg-12 col-sm-12">
                    <div class="table-responsive">
                      <table class="table table-sm table-bordered table-striped">
                        <thead class="bg-primary">
                          <tr style="font-size: 10pt;" class="text-light text-center">
                            <th class="align-middle">Komoditas</th>
                            <th class="align-middle">Kode</th>
                            <th class="align-middle">Januari</th>
                            <th class="align-middle">Februari</th>
                            <th class="align-middle">Maret</th>
                            <th class="align-middle">April</th>
                            <th class="align-middle">Mei</th>
                            <th class="align-middle">Juni</th>
                            <th class="align-middle">Juli</th>
                            <th class="align-middle">Agustus</th>
                            <th class="align-middle">September</th>
                            <th class="align-middle">Oktober</th>
                            <th class="align-middle">November</th>
                            <th class="align-middle">Desember</th>
                          </tr>
                        </thead>
                        <tbody style="font-size: 11px;">
                        <?php 
                          $Sektor = $this->uri->segment('3');
                          if ($Sektor == 1) {
                            $Kode = $TanamanPangan;
                            $Nama = $NamaTanamanPangan;
                          } else if ($Sektor == 2) {
                            $Kode = $Hortikultura;
                            $Nama = $NamaHortikultura;
                          } else if ($Sektor == 3) {
                            $Kode = $Perkebunan;
                            $Nama = $NamaPerkebunan;
                          } else if ($Sektor == 4) {
                            $Kode = $Peternakan;
                            $Nama = $NamaPeternakan;
                          } else if ($Sektor == 5) {
                            $Kode = $Perikanan;
                            $Nama = $NamaPerikanan;
                          }
                          for ($i=0; $i < count($Kode); $i++) { ?>
                          <?php if ($Fluktuasi[0][$i] != 0) { ?>
                            <tr class="text-dark align-middle">
                              <td class="align-middle"><b><?=$Nama[$i]?></b></td>
                              <td class="align-middle"><b><?=$Kode[$i]?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[0][$i],0,',','.')?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[1][$i],0,',','.')?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[2][$i],0,',','.')?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[3][$i],0,',','.')?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[4][$i],0,',','.')?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[5][$i],0,',','.')?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[6][$i],0,',','.')?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[7][$i],0,',','.')?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[8][$i],0,',','.')?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[9][$i],0,',','.')?></b></td>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[10][$i],0,',','.')?></b></td>
                              <?php if ($Tahun != 2024) { ?>
                              <td class="align-middle"><b><?=number_format($Fluktuasi[11][$i],0,',','.')?></b></td>
                            <?php } ?>
                            </tr>
                            <tr class="text-light align-middle">
                              <td class="align-middle"><b></b></td>
                              <td class="align-middle text-primary"><b>Laju (%)</b></td>
                              <td class="align-middle"><b>0</b></td>
                              <?php if ($Laju[0][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[0][$i].'%'?></b></td>
                              <?php } else if ($Laju[0][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[0][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[0][$i].'%'?></b></td>
                              <?php } ?>
                              <?php if ($Laju[1][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[1][$i].'%'?></b></td>
                              <?php } else if ($Laju[1][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[1][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[1][$i].'%'?></b></td>
                              <?php } ?>
                              <?php if ($Laju[2][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[2][$i].'%'?></b></td>
                              <?php } else if ($Laju[2][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[2][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[2][$i].'%'?></b></td>
                              <?php } ?>
                              <?php if ($Laju[3][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[3][$i].'%'?></b></td>
                              <?php } else if ($Laju[3][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[3][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[3][$i].'%'?></b></td>
                              <?php } ?>
                              <?php if ($Laju[4][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[4][$i].'%'?></b></td>
                              <?php } else if ($Laju[4][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[4][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[4][$i].'%'?></b></td>
                              <?php } ?>
                              <?php if ($Laju[5][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[5][$i].'%'?></b></td>
                              <?php } else if ($Laju[5][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[5][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[5][$i].'%'?></b></td>
                              <?php } ?>
                              <?php if ($Laju[6][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[6][$i].'%'?></b></td>
                              <?php } else if ($Laju[6][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[6][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[6][$i].'%'?></b></td>
                              <?php } ?>
                              <?php if ($Laju[7][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[7][$i].'%'?></b></td>
                              <?php } else if ($Laju[7][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[7][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[7][$i].'%'?></b></td>
                              <?php } ?>
                              <?php if ($Laju[8][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[8][$i].'%'?></b></td>
                              <?php } else if ($Laju[8][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[8][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[8][$i].'%'?></b></td>
                              <?php } ?>
                              <?php if ($Laju[9][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[9][$i].'%'?></b></td>
                              <?php } else if ($Laju[9][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[9][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[9][$i].'%'?></b></td>
                              <?php } ?>
                              <?php if ($Laju[10][$i] > 0.0) { ?>
                                <td class="align-middle bg-success"><b><?='+'.$Laju[10][$i].'%'?></b></td>
                              <?php } else if ($Laju[10][$i] < 0.0) { ?>
                                <td class="align-middle bg-danger"><b><?=$Laju[10][$i].'%'?></b></td>
                              <?php } else { ?>
                                <td class="align-middle text-dark"><b><?=$Laju[10][$i].'%'?></b></td>
                              <?php } ?>
                            </tr>
                          <?php }} ?>
                        </tbody>
                      </table>
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
    <script src="<?=base_url("build/js/custom.min.js")?>"></script>
		<script>
			$(document).ready(function(){
        var BaseURL = '<?=base_url()?>' 
        $("#TampilkanData").click(function() {
          var Data =  { TahunNTP: $("#TahunNTP").val() }
          $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "Super/NTPFluktuasi/" + $("#Sektor").val()
            }
            else {
              alert(Respon)
            }
          })                 
        })
      })
		</script>
  </body>
</html>