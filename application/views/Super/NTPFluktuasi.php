          <div class="clearfix"></div>
            <div class="row">
              <div class="col-lg-12">
                <div class="row mt-1">
                  <div class="col-lg-3">
                    <div class="input-group input-group-sm mb-1">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Sektor NTP</b></label>
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
                  <div class="col-lg-3">
                    <div class="btn btn-sm btn-danger border-light" id="TampilkanData"><b>Tampilkan</b></div>
                  </div>
                </div>
                <?php 
                  $TanamanPangan = array('IA001001','IA001005','IA001006','IA002001','IA002006','IA003001','IA003006','IA004001','IB001003','IB002001','IB003001','IB005002','IB006001','IB006002','IB009001','JA101001','JA101003','JA101004','JA102003','JA102004','JA201002','JA202001','JA203001','JA204001','JA207001','JB001001','JB001002','JB001003','JB002002','JB004001','JB005001','JB006001','JB007001','JB014001','JB101002','JB102001','JB103001','JB105002','JC001001','JC002001','JC007001','JC009001','JC011001','JC013001','JD001001','JD002001','JD002002','JD002003','JD003002','JD004001','JD005002','JD006001','JD006002','JD006003','JD012001','JD013001','JF001001','JF002001','JF002002','JF005001','JF005002','JF007001','JF008001','JF009001','JF011001','JF012001','JF017001','JF018001','JF019001','JF023001','JF027001','JF028001','JF029001','JF034001','JG003001','JG005001','JG006001','JG012002','KA101101','KA101102','KA201101','KA301101','KA301102','KA401101','KA401102','KA501101','KA501102','KA601101','KA701101','KA801101','KA801102','KA911101','KA911102','KA921101','KA921102','KA961101');
                  $Hortikultura = array('XA002001','XA004001','XA006001','XA007001','XA008001','XA011001','XA013001','XA015001','XA026001','XA029001','XB014003','XB015001','XB018002','XB019002','XB023001','XB023002','XB023004','XD001001','XD002001','XD004001','XD008001','YA101001','YA101002','YA101003','YA102001','YA103001','YA108001','YA110001','YA111001','YA115001','YA117001','YA203003','YA204002','YA204003','YA208001','YA208002','YA211001','YA211002','YA212001','YA212002','YA401001','YA402001','YA405001','YA408001','YB001001','YB001002','YB002002','YB004001','YB005001','YB006001','YB007001','YB016001','YB101002','YB102001','YB102002','YB103001','YB103002','YB106002','YB107001','YB601001','YB601002','YB602001','YB603001','YB604001','YD002001','YD002003','YD002004','YD003002','YF003001','YF005001','YF006001','YF006002','YF007001','YF018001','YF019001','YF607001','YF607002','ZA101101','ZA201101','ZA301101','ZA301102','ZA401101','ZA501101','ZA501102','ZA501103','ZA601101','ZA701101','ZA921101');
                  $Perkebunan = array('LA001001','LA007001','LA009002','MA001002','MA003001','MA004001','MB001002','MB002001','MB004001','MB006001','MB007001','MB008001','MB015001','MB016001','MB017001','MB101002','MB103003','MC001002','MC004001','MD001003','MD002002','MD003002','MD004001','MD005001','MD006001','MD007001','MD007002','MD008001','MD009001','MD014001','MD015001','MD019001','ME002001','ME005001','ME006001','ME007001','ME008001','ME011001','ME012001','ME014001','ME017001','ME024001','ME026001','ME602002','ME604001','ME605001','ME612001','MF002001','MF012002','NA101101','NA201101','NA202101','NA301101','NA301102','NA401101','NA501101','NA601101','NA701101');
                  $Peternakan = array('OA002005','OB001004','OC002003','OC008001','OC009001','OD008001','PA002002','PA601001','PA615002','PA618002','PA621001','PA623001','PB102001','PB104001','PB106001','PB107001','PB108001','PB113001','PB116001','PB165001','PB165003','PB201001','PB204001','PB205003','PB206001','PB206002','PB212001','PC002001','PC601001','PD002003','PD003002','PD004001','PD005001','PD601003','PE001001','PE002002','PE004002','PE013001','PE602001','PE607001','PE608001','PE609001','PE610001','PE612001','PF015001','PF017001','PF021001','PF023001','QA101101','QA301101','QA501101');
                  $Perikanan = array('RB020001','RB037001','RB040001','RB042005','RB047001','RB053001','RB055001','RB056001','RB072004','RB096001','RB099001','RB104001','RB109004','RB111001','RB113001','RB131001','SB002003','SB003002','SB007002','SC010004','SC011004','SC016001','SC018001','SC020001','SC021001','SC025001','SC028001','SC038001','SF501101','TB003005','TC001001','TC007001','TC011002','UA102005','UA201001','UA206001','UA210002','UB001002','UB002002','UB003001','UB061001','UB102001','UB104001','UB105001','UB202002','UB204001','UC001001','UD002003','UD003002','UD005003','UE005001','UE007001','UE032001','UE606001','UE609001','UH011101','UH201101','UH301101','UH401101','UH501101','UH601101');
                ?>
                <div class="row mt-1">
                  <div class="col-lg-6 col-sm-12">
                    <div class="table-responsive">
                      <table class="table table-sm table-bordered table-striped">
                        <thead class="bg-danger">
                          <tr style="font-size: 10pt;" class="text-light text-center">
                            <th class="align-middle">Kode</th>
                            <th class="align-middle">Januari</th>
                            <th class="align-middle">Februari</th>
                            <th class="align-middle">Maret</th>
                            <th class="align-middle">April</th>
                            <th class="align-middle">Mei</th>
                            <th class="align-middle">Juni</th>
                            <th class="align-middle">Juli</th>
                            <th class="align-middle">Agustus</th>
                          </tr>
                        </thead>
                        <tbody style="font-size: 12px;" class="bg-primary">
                        <?php 
                          $Sektor = $this->uri->segment('3');
                          if ($Sektor == 1) {
                            $Kode = $TanamanPangan;
                          } else if ($Sektor == 2) {
                            $Kode = $Hortikultura;
                          } else if ($Sektor == 3) {
                            $Kode = $Perkebunan;
                          } else if ($Sektor == 4) {
                            $Kode = $Peternakan;
                          } else if ($Sektor == 5) {
                            $Kode = $Perikanan;
                          }
                          for ($i=0; $i < count($Kode); $i++) { ?>
                            <tr class="text-light align-middle">
                              <td class="align-middle"><b><?=$Kode[$i]?></b></td>
                              <td class="align-middle"><b><?=$Fluktuasi[0][$i]?></b></td>
                              <td class="align-middle"><b><?=$Fluktuasi[1][$i]?></b></td>
                              <td class="align-middle"><b><?=$Fluktuasi[2][$i]?></b></td>
                              <td class="align-middle"><b><?=$Fluktuasi[3][$i]?></b></td>
                              <td class="align-middle"><b><?=$Fluktuasi[4][$i]?></b></td>
                              <td class="align-middle"><b><?=$Fluktuasi[5][$i]?></b></td>
                              <td class="align-middle"><b><?=$Fluktuasi[6][$i]?></b></td>
                              <td class="align-middle"><b><?=$Fluktuasi[7][$i]?></b></td>
                            </tr>
                            <tr class="text-light align-middle">
                              <td class="align-middle"><b>Laju</b></td>
                              <td class="align-middle"><b>0</b></td>
                              <td class="align-middle"><b><?=$Laju[0][$i]?></b></td>
                              <td class="align-middle"><b><?=$Laju[1][$i]?></b></td>
                              <td class="align-middle"><b><?=$Laju[2][$i]?></b></td>
                              <td class="align-middle"><b><?=$Laju[3][$i]?></b></td>
                              <td class="align-middle"><b><?=$Laju[4][$i]?></b></td>
                              <td class="align-middle"><b><?=$Laju[5][$i]?></b></td>
                              <td class="align-middle"><b><?=$Laju[6][$i]?></b></td>
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
          window.location = BaseURL + "Super/NTPFluktuasi/" + $("#Sektor").val()                 
        })
      })
		</script>
  </body>
</html>