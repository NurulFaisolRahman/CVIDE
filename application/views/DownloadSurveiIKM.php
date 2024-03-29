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
      <div class="d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-sm-center">
            <div class="col-sm-4">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card border border-warning">
                      <div class="card-header bg-danger"><b class="text-light">UNDUH DATA IKM</b></div>
                      <div class="card-body bg-primary">
                        <div class="container-fluid p-0">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-danger text-light"><b>Kecamatan</b></span>
                                </div>
                                <select class="custom-select" id="Kecamatan">  
                                  <?php foreach ($Kecamatan as $key) { ?>
                                    <option value="<?=$key['Kode']."|".$key['Nama']?>"><?=$key['Nama']?></option>
                                  <?php } ?>                  
                                </select>
                              </div>
                              <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-danger text-light"><b>Desa</b></span>
                                </div>
                                <select class="custom-select" id="Desa">
                                  <?php foreach ($Desa as $key) { ?>
                                    <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                  <?php } ?>                  
                                </select>
                              </div>
                              <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-danger text-light"><b>Tahun</b></span>
                                </div>
                                <select class="custom-select" id="Tahun">                    
                                  <option value="1">2022</option>
                                  <option value="2">2021</option>
                                  <option value="3">2020</option>
                                </select>
                              </div>
                              <div class="btn btn-success text-light" id="RekapDesa"><b>Desa</b></div>
                              <div class="btn btn-warning text-light" id="RekapKecamatan"><b>Kecamatan</b></div>
                              <div class="btn btn-danger text-light" id="Rekap"><b>Rekap</b></div>
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

        $("#Kecamatan").change(function (){
          var Pecah = $("#Kecamatan").val().split("|")
          var Desa = { Kode: Pecah[0] }
          $.post(BaseURL+"IDE/ListDesaIKM", Desa).done(function(Respon) {
            $('#Desa').html(Respon)
          })    
        })

        $("#RekapDesa").click(function() {
          var Kecamatan = $("#Kecamatan").val().split("|")
          window.location = BaseURL + 'IDE/ExcelIKM/'+Kecamatan[1]+'/'+$("#Desa").val()+'/'+$("#Tahun").val()
        })

        $("#RekapKecamatan").click(function() {
          var Kecamatan = $("#Kecamatan").val().split("|")
          window.location = BaseURL + 'IDE/ExcelIKMKecamatan/'+Kecamatan[0]+'/'+Kecamatan[1]+'/'+$("#Tahun").val()
        })

        $("#Rekap").click(function() {
          var Kecamatan = $("#Kecamatan").val().split("|")
          window.location = BaseURL + 'IDE/RekapExcelIKMKecamatan/'+Kecamatan[0]+'/'+Kecamatan[1]+'/'+$("#Tahun").val()
        })

      })
    </script>
  </body>
</html>