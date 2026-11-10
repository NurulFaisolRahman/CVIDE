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
      .swal2-container {
        z-index: 99999 !important;
      }
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
        background: url(../assets/img/SignInBackground.jpeg) no-repeat center center fixed;
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
                    <div class="card">
                      <div class="card-header bg-warning"><b class="text-primary">AUTENTIKASI</b></div>
                      <div class="card-body">
                        <ul class="nav nav-pills mb-2 nav-fill" id="pills-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active btn btn-outline-success" id="pills-Masuk-tab" data-toggle="pill" href="#pills-Masuk" role="tab" aria-controls="pills-Masuk" aria-selected="true"><b>SURVEYOR</b></a>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-Masuk" role="tabpanel" aria-labelledby="pills-Masuk-tab">
                            <div class="input-group input-group-sm mb-2">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-primary"><b>NIK</b></span>
                              </div>
                              <input type="text" class="form-control" id="NIK">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-primary"><b>Password</b></span>
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
        </div>
      </div>
    </header>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>  
      jQuery(document).ready(function($) {
        
        var BaseURL = '<?=base_url()?>'

        $('#NIK').keypress(function(event){
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
          var nik = $.trim($("#NIK").val());
          var password = $.trim($("#Password").val());
          if (!nik || !password) {
            Swal.fire({
              icon: 'warning',
              title: 'Form Belum Lengkap',
              text: 'Harap masukkan NIK dan Password Anda!',
              confirmButtonColor: '#007bff'
            });
            return;
          }
          var Akun = { NIK: nik,
                       Password: password }
          $.post(BaseURL+"IDE/SurveyorSignIn", Akun).done(function(Respon) {
            var trimmedRespon = $.trim(Respon);
            if (trimmedRespon == '1') {
              window.location = BaseURL + "Surveyor";
            }
            else {
              Swal.fire({
                icon: 'error',
                title: 'Gagal Masuk',
                text: trimmedRespon || 'NIK atau Password salah. Silakan periksa kembali!',
                confirmButtonColor: '#b40814'
              });
            }
          }).fail(function() {
            Swal.fire({
              icon: 'error',
              title: 'Koneksi Terputus',
              text: 'Terjadi kesalahan koneksi ke server. Silakan coba lagi.',
              confirmButtonColor: '#b40814'
            });
          });                    
        })
      })
    </script>
  </body>
</html>