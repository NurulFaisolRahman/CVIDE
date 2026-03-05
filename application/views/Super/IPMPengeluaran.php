<!-- Tambahan Sedikit CSS Custom untuk mempercantik tanpa merusak struktur -->
          <style>
            .modern-card {
              transition: transform 0.3s ease, box-shadow 0.3s ease;
              border-radius: 10px;
              overflow: hidden;
            }
            .modern-card:hover {
              transform: translateY(-3px);
              box-shadow: 0 8px 15px rgba(0,0,0,0.1) !important;
            }
            .img-container {
              background-color: #f8f9fc; /* Warna background lembut untuk gambar */
              border-bottom: 1px solid #e3e6f0;
            }
            .data-title {
              font-size: 11px; /* Diperkecil dari 13px */
              color: #858796;
              text-transform: uppercase;
              letter-spacing: 0.5px;
              font-weight: 700;
              line-height: 1.2;
            }
            .data-value {
              font-size: 1.05rem; /* Diperkecil dari 1.2rem */
              color: #4e73df;
              font-weight: 800;
              margin-top: 4px;
            }
            .filter-label {
              background-color: #4e73df;
              color: white;
              border: none;
              font-size: 12px; /* Font label lebih kecil */
            }
            .custom-select, .btn-sm {
              font-size: 12px !important; /* Font dropdown dan tombol lebih kecil */
            }
          </style>

          <div class="clearfix"></div>
            <div class="row">
              <div class="col-lg-12">
                
                <!-- Bagian Filter -->
                <div class="row mt-2"> <!-- Margin top diperkecil -->
                  <div class="col-lg-3 col-md-6"> <!-- Margin bottom diperkecil menjadi mb-2 -->
                    <div class="input-group input-group-sm shadow-sm rounded"> <!-- Tambah input-group-sm -->
                      <div class="input-group-prepend">
                        <label class="input-group-text filter-label"><b>Kabupaten</b></label>
                      </div>
                      <select class="custom-select border-0" id="Kabupaten">  
                        <?php foreach ($Kabupaten as $key) { ?>
                          <option value="<?=$key['Kode']?>" <?=$KodeKabupaten==$key['Kode']?'selected':'';?>><?=ucfirst(strtolower(substr($key['Nama'],5)))?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mb-2">
                    <div class="input-group input-group-sm shadow-sm rounded">
                      <div class="input-group-prepend">
                        <label class="input-group-text filter-label"><b>Kecamatan</b></label>
                      </div>
                      <select class="custom-select border-0" id="Kecamatan">  
                        <?php foreach ($Kecamatan as $key) { ?>
                          <option value="<?=$key['Kode']?>" <?=$KodeKecamatan==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mb-2">
                    <div class="input-group input-group-sm shadow-sm rounded">
                      <div class="input-group-prepend">
                        <label class="input-group-text filter-label"><b>Desa</b></label>
                      </div>
                      <select class="custom-select border-0" id="Desa">                    
                        <?php foreach ($Desa as $key) { ?>
                          <option value="<?=$key['Kode']?>" <?=$KodeDesa==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Bagian Action -->
                <div class="row mb-2"> <!-- Margin bottom diperkecil -->
                  <div class="col-lg-3 col-md-6 mb-2">
                    <div class="input-group input-group-sm shadow-sm rounded">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-info text-light border-0" style="font-size: 12px;"><b>Data</b></label>
                      </div>
                      <select class="custom-select border-0" id="JenisData">                    
                        <option value="Kabupaten" <?=$this->session->userdata('JenisData')=='Kabupaten'?'selected':'';?>>Kabupaten</option>
                        <option value="Kecamatan" <?=$this->session->userdata('JenisData')=='Kecamatan'?'selected':'';?>>Kecamatan</option>
                        <option value="Desa" <?=$this->session->userdata('JenisData')=='Desa'?'selected':'';?>>Desa</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 mb-2 d-flex align-items-center">
                    <button class="btn btn-primary btn-sm shadow-sm mr-2 px-3" id="TampilkanData"><b>Tampilkan</b></button>
                    <a href="<?=base_url('/Rekap/RekapDimensiPengeluaran.xlsx')?>" class="btn btn-success btn-sm shadow-sm px-3"><b>Unduh Rekap</b></a>
                  </div>
                </div>

                <hr class="my-2"> <!-- Margin garis diperkecil -->

                <!-- Bagian Kartu Data & Gambar -->
                <div class="row mt-3"> <!-- Margin diperkecil -->
                  
                  <!-- Kartu 1 -->
                  <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-3"> <!-- Margin bottom kartu diperkecil -->
                    <div class="card modern-card shadow-sm border-0 h-100">
                      <div class="card-body img-container p-2 d-flex align-items-center justify-content-center"> <!-- Padding diperkecil menjadi p-2 -->
                        <a><img src="<?=base_url('assets/img/PerKapita.png')?>" alt="Per Kapita" height="140" style="object-fit: contain;"></a> <!-- Tinggi gambar diperkecil dari 180 ke 140 -->
                      </div>
                      <div class="card-footer bg-white border-0 py-2 px-1"> <!-- Padding Y diperkecil -->
                        <div class="data-title mb-1">Rata-rata Pengeluaran<br>PerKapita Per Tahun</div>
                        <div class="data-value"><?=number_format($PerKapita*100*12,0,",",".")?></div>
                      </div>
                    </div>
                  </div>

                  <!-- Kartu 2 -->
                  <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-3">
                    <div class="card modern-card shadow-sm border-0 h-100">
                      <div class="card-body img-container p-2 d-flex align-items-center justify-content-center">
                        <a><img src="<?=base_url('assets/img/PerKapitaKonstan.png')?>" alt="Per Kapita Konstan" height="140" style="object-fit: contain;"></a>
                      </div>
                      <div class="card-footer bg-white border-0 py-2 px-1">
                        <div class="data-title mb-1">Rata-rata Pengeluaran<br>PerKapita Konstan / Tahun</div>
                        <div class="data-value"><?=number_format($PerKapitaKonstan*100*12,0,",",".")?></div>
                      </div>
                    </div>
                  </div>

                  <!-- Kartu 3 -->
                  <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-3">
                    <div class="card modern-card shadow-sm border-0 h-100">
                      <div class="card-body img-container p-2 d-flex align-items-center justify-content-center">
                        <a><img src="<?=base_url('assets/img/PPP.png')?>" alt="PPP" height="140" style="object-fit: contain;"></a>
                      </div>
                      <div class="card-footer bg-white border-0 py-2 px-1">
                        <div class="data-title mb-1">Purchasing Power Parity<br>Indeks PPP</div>
                        <div class="data-value"><?=number_format($PPP,2,",",".")?></div>
                      </div>
                    </div>
                  </div>

                  <!-- Kartu 4 -->
                  <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-3">
                    <div class="card modern-card shadow-sm border-0 h-100">
                      <div class="card-body img-container p-2 d-flex align-items-center justify-content-center">
                        <a><img src="<?=base_url('assets/img/GK.png')?>" alt="GK" height="140" style="object-fit: contain;"></a>
                      </div>
                      <div class="card-footer bg-white border-0 py-2 px-1">
                        <div class="data-title mb-1">Indeks Pengeluaran<br>&nbsp;</div>
                        <div class="data-value"><?=number_format($IndeksPengeluaran,2,",",".")?></div>
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

    <!-- Script Javascript Tetap Utuh Tidak Diubah -->
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
            alert('Data Pengeluaran Desa Belum Tersedia')
          } else {
            var Data =  { KodeDesa: $("#Desa").val(),
                          KodeKecamatan: $("#Kecamatan").val(),
                          JenisData: $("#JenisData").val() }
            $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
              if (Respon == '1') {
                window.location = BaseURL + "Super/IPMPengeluaran"
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