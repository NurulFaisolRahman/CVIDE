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
                    <div class="card border border-light">
                      <div class="card-header border border-light bg-primary"><b class="text-light">SIGN IN</b></div>
                      <div class="card-body border border-light bg-warning">
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-light"><b>Username</b></span>
                          </div>
                          <input type="text" class="form-control" id="Username">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-light"><b>Password</b></span>
                          </div>
                          <input type="password" class="form-control" id="Password">
                        </div>
                        <div class="btn btn-primary" id="Masuk"><b>Masuk</b></div>
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
        $('#Username').keypress(function(event){
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
            event.preventDefault();
            document.getElementById("Masuk").click();  
          }
        });
        $('#Password').keypress(function(event){
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
            event.preventDefault();
            document.getElementById("Masuk").click();  
          }
        });
        $("#Masuk").click(function() {
          var Akun = { Username: $("#Username").val(),
                       Password: $("#Password").val() }
          $.post(BaseURL+"IDE/CekAuth", Akun).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "Surveyor"
            }
            else if (Respon == '2') {
              if ($("#Username").val() == 'bappedalamongan') {
                window.location = BaseURL + "Super/NTPSeries" 
              } else {
                window.location = BaseURL + "Super" 
              }
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