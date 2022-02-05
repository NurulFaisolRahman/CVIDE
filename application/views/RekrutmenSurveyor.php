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
                      <div class="card-header border border-white bg-primary"><b class="text-light">DAFTAR SEBAGAI SURVEYOR</b></div>
                      <div class="card-body border border-white bg-danger">
                        <!-- <pre class="text-white text-wrap"><b>SYARAT & KETENTUAN : <br>1. SURVEYOR BERSEDIA BEKERJA SESUAI SOP & TARGET<br>2. SURVEYOR WAJIB MEMILIKI SIM C AKTIF & HP ANDROID</b></pre> -->
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-light"><b>Nama</b></span>
                          </div>
                          <input type="text" class="form-control" id="Nama">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-light"><b>Nomer WA</b></span>
                          </div>
                          <input type="text" class="form-control" id="WA">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-light"><b>Upload CV</b></span>
                          </div>
                          <input type="file" class="form-control" id="CV" onchange="Upload()">
                        </div>
                        <pre class="text-white mb-2 text-wrap"><b>Format CV jpg/png/pdf Maksimal 5 Mb</b></pre>
                        <div class="btn border border-light btn-primary" id="Daftar"><b>Daftar <div id="LoadingInput" class="spinner-border spinner-border-sm text-white" style="display: none;" role="status"></div></b></div>
                        <pre class="text-white mb-0 mt-1 text-wrap"><b>Setelah Berhasil Mendaftar, Admin Kami Akan<br>Menghubungi Anda Untuk Informasi Lebih Lanjut</b></pre>
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
    
      function Upload() {
        var File = $('#CV')[0].files[0]
        var FileType = File["type"]
        var ValidFileTypes = ["image/jpg", "image/jpeg","image/png","application/pdf"]
        if ($.inArray(FileType, ValidFileTypes) < 0) {
          alert("Format File Upload CV Belum Benar!")
          $('#CV').val("")
        } else if (File["size"] > 5242880) {
          alert("Ukuran File Upload CV Maksimal 5 Mb!")
          $('#CV').val("")
        } 
      }

      jQuery(document).ready(function($) {
        
        var BaseURL = '<?=base_url()?>'

        $("#Daftar").click(function() {
          var File = $('#CV')[0].files[0]
          if ($("#Nama").val() === "") {
            alert('Input Nama Wajib Di isi!')
          } else if (isNaN($("#WA").val()) || $("#WA").val() === "") {
            alert('Input Nomer WA Belum Benar!')
          } else if (File == undefined) {
            alert('Wajib Upload CV!')
          } else {
            var fd = new FormData()
            fd.append("Nama", $('#Nama').val())
            fd.append("WA", $('#WA').val())
            fd.append('CV',$('#CV')[0].files[0])
            $("#Daftar").attr("disabled", true);                              
            $("#LoadingInput").show();
            $.ajax({
              url: BaseURL+'IDE/Daftar',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(Respon){
                if (Respon == '1') {
                  alert('Terima Kasih Telah Mendaftar')
                  window.location = BaseURL + "IDE/RekrutmenSurveyor"
                } else {
                  alert(Respon)
                  $("#LoadingInput").hide();
                  $("#Daftar").attr("disabled", false);   
                }
              }
            })
          }
        })
      })
    </script>
  </body>
</html>