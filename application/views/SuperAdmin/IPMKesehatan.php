          <div class="clearfix"></div>
            <div class="row">
              <div class="col-lg-12">
                <div class="row mt-2">
                  <div class="col-lg-3">
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Kabupaten</b></label>
                      </div>
                      <select class="custom-select" id="Kabupaten">  
                        <?php foreach ($Kabupaten as $key) { ?>
                          <option value="<?=$key['Kode']?>" <?=$KodeKabupaten==$key['Kode']?'selected':'';?>><?=ucfirst(strtolower(substr($key['Nama'],5)))?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Kecamatan</b></label>
                      </div>
                      <select class="custom-select" id="Kecamatan">  
                        <?php foreach ($Kecamatan as $key) { ?>
                          <option value="<?=$key['Kode']?>" <?=$KodeKecamatan==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Desa</b></label>
                      </div>
                      <select class="custom-select" id="Desa">                    
                        <?php foreach ($Desa as $key) { ?>
                          <option value="<?=$key['Kode']?>" <?=$KodeDesa==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-light"><b>Data</b></label>
                      </div>
                      <select class="custom-select" id="JenisData">                    
                        <option value="Kabupaten" <?=$this->session->userdata('JenisData')=='Kabupaten'?'selected':'';?>>Kabupaten</option>
                        <option value="Kecamatan" <?=$this->session->userdata('JenisData')=='Kecamatan'?'selected':'';?>>Kecamatan</option>
                        <option value="Desa" <?=$this->session->userdata('JenisData')=='Desa'?'selected':'';?>>Desa</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="btn btn-sm btn-primary border-light" id="TampilkanData"><b>Tampilkan</b></div>
                    <div class="btn btn-sm btn-primary border-light" id="ExcelALHAMH"><i class="fa fa-file-excel-o"></i> <b>Excel</b></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 mb-2">
                    <div class="table-responsive mt-1">
                      <table class="table table-sm table-bordered table-striped">
                        <thead class="bg-danger">
                          <tr style="font-size: 10pt;" class="text-light text-center align-middle">
                            <th>Usia Ibu</th>
                            <th>Anak Lahir</th>
                            <th>Anak Mati</th>
                            <th>Anak Bertahan</th>
                            <th>Jumlah Ibu</th>
                            <th>ALH</th>
                            <th>AMH</th>
                          </tr>
                        </thead>
                        <tbody style="font-size: 12px;" class="bg-primary">
                        <?php $TingkatPendidikan = array('15 - 19','20 - 24','25 - 29','30 - 34','35 - 39','40 - 44','45 - 49'); 
                          foreach ($TingkatPendidikan as $key => $value) { ?>
                          <tr class="text-light align-middle text-center">
                            <td><?=$value?></td>
                            <td><?=$ALHAMH[$key][0]?></td>
                            <td><?=$ALHAMH[$key][1]?></td>
                            <td><?=$ALHAMH[$key][2]?></td>
                            <td><?=$ALHAMH[$key][3]?></td>
                            <td><?=$ALHAMH[$key][4]?></td>
                            <td><?=$ALHAMH[$key][5]?></td>
                          </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot class="bg-danger">
                          <tr style="font-size: 10pt;" class="text-light text-center align-middle">
                            <th>Total</th>
                            <th><?=$Total[0]?></th>
                            <th><?=$Total[1]?></th>
                            <th><?=$Total[2]?></th>
                            <th><?=$Total[3]?></th>
                            <th>-</th>
                            <th>-</th>
                          </tr>
                        </tfoot>
                      </table> 
                    </div>
                  </div>
                  <!-- <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/AHH.png')?>" alt="GK" height="209" ></a>
                      </div>
                    <div class="card-footer bg-danger border border-light" style="padding-top: 11px;"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Angka Harapan Hidup ".$AHH?></div></div>
                    </div>
                  </div> -->
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
        $("#Kecamatan").change(function (){
          var Desa = { Kode: $("#Kecamatan").val() }
          $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) { 
            $('#Desa').html(Respon)
          })    
        })
        $("#TampilkanData").click(function() {
          var Data =  { KodeDesa: $("#Desa").val(),
                        KodeKecamatan: $("#Kecamatan").val(),
                        JenisData: $("#JenisData").val() }
          $.post(BaseURL+"SuperAdmin/Session", Data).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "SuperAdmin/IPMKesehatan"
            }
            else {
              alert(Respon)
            }
          })                    
        })
        $("#ExcelALHAMH").click(function() {
          var NamaDesa = $("#Desa option:selected").text()
          var NamaKecamatan = $("#Kecamatan option:selected").text()
          var NamaKabupaten = $("#Kabupaten option:selected").text()
          var KodeDesa = $("#Desa").val()
          var KodeKecamatan = $("#Kecamatan").val()
          var KodeKabupaten = $("#Kabupaten").val()
          var JenisData = $("#JenisData").val() 
          window.location = BaseURL + "SuperAdmin/ExcelALHAMH/"+JenisData+"-"+KodeDesa+"-"+NamaDesa+"-"+KodeKecamatan+"-"+NamaKecamatan
        })
      })
		</script>
  </body>
</html>