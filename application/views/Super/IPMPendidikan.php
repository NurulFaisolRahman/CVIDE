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
                    <a href="<?=base_url('/Rekap/RekapDimensiPendidikan.xlsx')?>" class="btn btn-sm btn-danger border-light"><b>Unduh Rekap</b></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/RLS.png')?>" alt="GK" height="209" ></a>
                      </div>
                    <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Rata2 Lama Sekolah ".$IPMPendidikan['RLS']."<br>Indeks Rata2 Lama Sekolah ".$IPMPendidikan['IRLS']?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/HLS.png')?>" alt="GK" height="210" ></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Harapan Lama Sekolah ".$IPMPendidikan['HLS']."<br>Indeks Harapan Lama Sekolah ".$IPMPendidikan['IHLS']?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/IndeksPendidikan.png')?>" alt="GK" height="209" ></a>
                      </div>
                    <div class="card-footer bg-danger border border-light" style="padding-top: 11px;"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Indeks Pendidikan ".$IPMPendidikan['IPendidikan']?></div></div>
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
        $("#Kecamatan").change(function (){
          var Desa = { Kode: $("#Kecamatan").val() }
          $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) { 
            $('#Desa').html(Respon)
          })    
        })
        $("#TampilkanData").click(function() {
          if ($("#JenisData").val() == 'Desa') {
            alert('Data Pendidikan Desa Belum Tersedia')
          } else {
            var Data =  { KodeDesa: $("#Desa").val(),
                          KodeKecamatan: $("#Kecamatan").val(),
                          JenisData: $("#JenisData").val() }
            $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
              if (Respon == '1') {
                window.location = BaseURL + "Super/IPMPendidikan"
              }
              else {
                alert(Respon)
              }
            })                    
          }
        })
      })
		</script>
  </body>
</html>