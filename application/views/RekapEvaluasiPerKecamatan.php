<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>IDE Consultant</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.ico" rel="icon">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      html,
      body,
      header,
      #intro {
          height: 100vh;
      }
      body{
        overflow: auto;
      }
      #intro {
        background: url(../assets/img/BgIKM.jpg) no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
      }
    </style>
  </head>
  <body>
    <header id="intro">
      <div class="d-flex align-items-center">
        <div class="container-fluid">
          <div class="row justify-content-sm-center">
            <div class="col-lg-12">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card border border-white mt-2">
                      <div class="card-header bg-primary border border-white"><b class="text-light">REKAP EVALUASI DESA PER KECAMATAN</b></div>
                      <div class="card-body bg-danger border border-white">
                        <div class="container-fluid p-0">
                          <div class="row">
                            <div class="col-lg-4">
                              <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-primary text-light"><b>Kecamatan</b></span>
                                </div>
                                <select class="custom-select" id="Kecamatan">  
                                  <?php foreach ($Kecamatan as $key) { ?>
                                    <option value="<?=$key['Kode']."|".$key['Nama']?>"><?=$key['Nama']?></option>
                                  <?php } ?>                  
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="btn btn-sm btn-primary text-light" id="BPD"><b>BPD</b></div>
                              <div class="btn btn-sm btn-primary text-light" id="PEMDES"><b>PEMDES</b></div>
                              <div class="btn btn-sm btn-success text-light" id="EXCEL"><b>EXCEL</b></div>
                            </div>
                            <div class="col-sm-12">
                              <input type="hidden" id="JenisData" value="0">
                              <div class="table-responsive">
                                <table class="table table-sm table-bordered bg-light" style="font-size: 15px;">
                                  <thead>
                                    <tr class="bg-primary text-light">
                                      <th style="width: 3%;" scope="col" class="text-center align-middle">No</th>
                                      <th style="width: 17%;" scope="col" class="text-center align-middle">Desa</th>
                                      <th scope="col" class="text-center align-middle">Indikator 1</th>
                                      <th scope="col" class="text-center align-middle">Indikator 2</th>
                                      <th scope="col" class="text-center align-middle">Indikator 3</th>
                                      <th scope="col" class="text-center align-middle">Indikator 4</th>
                                      <th scope="col" class="text-center align-middle">Indikator 5</th>
                                      <th scope="col" class="text-center align-middle">Nilai Indeks</th>
                                      <th scope="col" class="text-center align-middle">Mutu Pelayanan</th>
                                      <th scope="col" class="text-center align-middle">Kinerja Pelayanan</th>
                                    </tr>
                                  </thead>
                                  <tbody id="Rekap">

                                  </tbody>
                                </table>
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
          </div>
        </div>
      </div>
    </header>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>  
      jQuery(document).ready(function($) {
        
        var BaseURL = '<?=base_url()?>'

        $("#BPD").click(function() {
          $("#JenisData").val("BPD")
          var Kecamatan = $("#Kecamatan").val().split("|")
          var Data = { Filter: 'BPD-'+Kecamatan[0]+'-'+Kecamatan[1] }
          $.post(BaseURL+"IDE/FilterEvaluasiPerKecamatan", Data).done(function(Respon) {
            $('#Rekap').html(Respon)
          }) 
        })

        $("#PEMDES").click(function() {
          $("#JenisData").val("PEMDES")
          var Kecamatan = $("#Kecamatan").val().split("|")
          var Data = { Filter: 'PEMDES-'+Kecamatan[0]+'-'+Kecamatan[1] }
          $.post(BaseURL+"IDE/FilterEvaluasiPerKecamatan", Data).done(function(Respon) {
            $('#Rekap').html(Respon)
          }) 
        })

        $("#EXCEL").click(function() {
          if ($("#JenisData").val() == "BPD"){
            var Kecamatan = $("#Kecamatan").val().split("|")
            window.location = BaseURL + 'IDE/ExcelEvaluasiDesa/'+$("#JenisData").val()+'-'+Kecamatan[0]+'-'+Kecamatan[1]
          } else if ($("#JenisData").val() == "PEMDES"){
            var Kecamatan = $("#Kecamatan").val().split("|")
            window.location = BaseURL + 'IDE/ExcelEvaluasiDesa/'+$("#JenisData").val()+'-'+Kecamatan[0]+'-'+Kecamatan[1]
          } else {
            alert("Belum Ada Data!")
          }
        })

      })
    </script>
  </body>
</html>