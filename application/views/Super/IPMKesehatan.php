<div class="clearfix"></div>
            
            <style>
              /* Custom CSS untuk konsistensi dengan modul lainnya */
              .filter-card { border-radius: 8px; border-left: 4px solid #007bff; }
              .data-card { transition: all 0.3s ease; border-radius: 12px; overflow: hidden; border: none; }
              .data-card:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.15) !important; }
              .img-hover { transition: transform 0.3s ease; }
              .data-card:hover .img-hover { transform: scale(1.05); }
              .label-filter { font-size: 0.75rem; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.2rem; }
              .card-title-custom { font-size: 0.85rem; font-weight: 700; color: #333; }
              .indeks-value { font-size: 1.1rem; font-weight: 700; letter-spacing: 0.5px; display: block; }
              .sub-text { font-size: 0.75rem; color: #666; }
              
              /* Table styling agar lebih modern */
              .table-custom { font-size: 0.75rem; }
              .table-custom thead th { background-color: #f8f9fa; color: #333; border-bottom: 2px solid #dee2e6; text-transform: uppercase; font-size: 0.65rem; padding: 10px 5px; }
              .table-custom tbody td { vertical-align: middle; }
            </style>

            <!-- Bagian Filter Data -->
            <div class="row mb-3">
              <div class="col-sm-12">
                <div class="card shadow-sm filter-card bg-light">
                  <div class="card-body py-2">
                    <h6 class="font-weight-bold text-primary mb-2" style="font-size: 0.9rem;"><i class="fa fa-filter mr-2"></i>Filter Dimensi Kesehatan</h6>
                    <div class="row">
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Kabupaten</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="Kabupaten">  
                          <?php foreach ($Kabupaten as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeKabupaten==$key['Kode']?'selected':'';?>><?=ucfirst(strtolower(substr($key['Nama'],5)))?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Kecamatan</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="Kecamatan">  
                          <?php foreach ($Kecamatan as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeKecamatan==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Desa</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="Desa">                    
                          <?php foreach ($Desa as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeDesa==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Jenis Data</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="JenisData">                    
                          <option value="Kabupaten" <?=$this->session->userdata('JenisData')=='Kabupaten'?'selected':'';?>>Kabupaten</option>
                          <option value="Kecamatan" <?=$this->session->userdata('JenisData')=='Kecamatan'?'selected':'';?>>Kecamatan</option>
                          <option value="Desa" <?=$this->session->userdata('JenisData')=='Desa'?'selected':'';?>>Desa</option>
                        </select>
                      </div>
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="row mt-1">
                      <div class="col-12 text-right">
                        <button class="btn btn-primary btn-sm shadow-sm px-3 rounded-pill" id="TampilkanData">
                          <b>Tampilkan</b>
                        </button>
                        <button class="btn btn-success btn-sm shadow-sm px-3 rounded-pill ml-1" id="ExcelALHAMH">
                          <i class="fa fa-file-excel-o mr-1"></i><b>Excel</b>
                        </button>
                        <a href="<?=base_url('/Rekap/RekapDimensiKesehatan.xlsx')?>" class="btn btn-danger btn-sm shadow-sm px-3 rounded-pill ml-1">
                          <b>Rekap</b>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bagian Data Visualisasi & Tabel -->
            <div class="row">
              <!-- Tabel ALHAMH -->
              <div class="col-lg-6 mb-3">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 12px; overflow: hidden;">
                  <div class="card-header bg-white border-0 py-2 mt-1">
                    <h6 class="card-title-custom text-uppercase mb-0 text-primary"><i class="fa fa-table mr-2"></i>Tabel ALH & AMH per Usia Ibu</h6>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-sm table-hover table-custom mb-0">
                        <thead>
                          <tr class="text-center">
                            <th>Usia Ibu</th>
                            <th>Anak Lahir</th>
                            <th>Anak Mati</th>
                            <th>Anak Bertahan</th>
                            <th>Jumlah Ibu</th>
                            <th>ALH</th>
                            <th>AMH</th>
                          </tr>
                        </thead>
                        <tbody class="text-center">
                        <?php $TingkatPendidikan = array('15 - 19','20 - 24','25 - 29','30 - 34','35 - 39','40 - 44','45 - 49'); 
                          foreach ($TingkatPendidikan as $key => $value) { ?>
                          <tr>
                            <td class="font-weight-bold text-dark"><?=$value?></td>
                            <td><?=$ALHAMH[$key][0]?></td>
                            <td><?=$ALHAMH[$key][1]?></td>
                            <td><?=$ALHAMH[$key][2]?></td>
                            <td><?=$ALHAMH[$key][3]?></td>
                            <td class="text-primary font-weight-bold"><?=$ALHAMH[$key][4]?></td>
                            <td class="text-danger font-weight-bold"><?=$ALHAMH[$key][5]?></td>
                          </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot class="bg-light text-center font-weight-bold" style="font-size: 0.7rem;">
                          <tr>
                            <td>TOTAL</td>
                            <td><?=$Total[0]?></td>
                            <td><?=$Total[1]?></td>
                            <td><?=$Total[2]?></td>
                            <td><?=$Total[3]?></td>
                            <td>-</td>
                            <td>-</td>
                          </tr>
                        </tfoot>
                      </table> 
                    </div>
                  </div>
                </div>
              </div>

              <!-- Angka Harapan Hidup -->
              <div class="col-lg-3 col-md-6 mb-3 text-center">
                <div class="card data-card shadow-sm h-100">
                  <div class="card-body p-3 d-flex align-items-center justify-content-center" style="background-color: #fff8f0;">
                    <a><img class="my-1 img-fluid img-hover" src="<?=base_url('assets/img/AHH.png')?>" alt="AHH" style="max-height: 130px;"></a>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="card-title-custom text-uppercase mb-1">Angka Harapan Hidup</h6>
                    <div class="mt-2">
                      <span class="badge badge-warning px-4 py-2 shadow-sm indeks-value text-dark" style="background-color: #ffc107;">
                        <?=$AHH?>
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Indeks Kesehatan -->
              <div class="col-lg-3 col-md-6 mb-3 text-center">
                <div class="card data-card shadow-sm h-100">
                  <div class="card-body p-3 d-flex align-items-center justify-content-center" style="background-color: #f0faff;">
                    <a><img class="my-1 img-fluid img-hover" src="<?=base_url('assets/img/IndeksKesehatan.png')?>" alt="Indeks" style="max-height: 130px;"></a>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="card-title-custom text-uppercase mb-1">Total Indeks Kesehatan</h6>
                    <div class="mt-2">
                      <span class="badge badge-info px-4 py-2 shadow-sm indeks-value">
                        <?=$IndeksKesehatan?>
                      </span>
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
          var $btn = $(this);
          var originalText = $btn.html();
          $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...');

          var Data =  { KodeDesa: $("#Desa").val(),
                        KodeKecamatan: $("#Kecamatan").val(),
                        JenisData: $("#JenisData").val() }
          $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "Super/IPMKesehatan"
            }
            else {
              alert(Respon)
              $btn.html(originalText);
            }
          }).fail(function() {
            $btn.html(originalText);
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
          window.location = BaseURL + "Super/ExcelALHAMH/"+JenisData+"-"+KodeDesa+"-"+NamaDesa+"-"+KodeKecamatan+"-"+NamaKecamatan
        })
      })
    </script>
  </body>
</html>