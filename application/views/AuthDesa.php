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
        background: url(../assets/img/BgIKM.jpg) no-repeat center center fixed;
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
            <div class="col-sm-auto">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-auto">
                    <div class="card border border-warning">
                      <div class="card-header bg-danger"><b class="text-light">AUTENTIKASI</b></div>
                      <div class="card-body bg-primary">
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <label class="input-group-text bg-danger text-light"><b>Kecamatan</b></label>
                          </div>
                          <select class="custom-select" id="Kecamatan">  
                            <?php foreach ($Kecamatan as $key) { ?>
                              <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                            <?php } ?>                  
                          </select>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <label class="input-group-text bg-danger text-light"><b>Desa/Kelurahan</b></label>
                          </div>
                          <select class="custom-select" id="Desa">                    
                            <?php foreach ($Desa as $key) { ?>
                              <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                            <?php } ?>                  
                          </select>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-danger text-light"><b>Password</b></span>
                          </div>
                          <input type="password" class="form-control" id="Password">
                        </div>
                        <div class="btn btn-danger" id="Masuk"><b>Masuk</b></div>
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
          var Desa = { Kode: $("#Kecamatan").val() }
          $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) {
            $('#Desa').html(Respon)
          })    
        })

        $('#Password').keypress(function(event){
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
            event.preventDefault();
            document.getElementById("Masuk").click();  
          }
        });

        $("#Masuk").click(function() {
          var Akun = { Username: $("#Desa").val(),
                       NamaKecamatan: $("#Kecamatan option:selected").text(),
                       NamaDesa: $("#Desa option:selected").text(),
                       Password: $("#Password").val() }
          $.post(BaseURL+"IDE/DesaSignIn", Akun).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "Desa"
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