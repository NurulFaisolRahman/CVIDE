<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login Survei IKM - IDE Consultant</title>
    <link href="<?= base_url('assets/img/favicon.ico') ?>" rel="icon">
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style type="text/css">
        html, body, header, #intro { height: 100vh; }
        body { overflow: auto; }
        #intro {
            background: url(<?= base_url('assets/img/BgIKM.jpg') ?>) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
        .login-card {
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            border-radius: 10px;
            overflow: hidden;
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
                                    <div class="card login-card border border-light">
                                        <div class="card-header border border-light bg-primary text-center py-3">
                                            <h4 class="text-light mb-0"><b>SURVEI IKM</b></h4>
                                            <small class="text-light">BAKESBANGPOL Kota Yogyakarta</small>
                                        </div>
                                        <div class="card-body border border-light bg-warning">
                                            <?php if (isset($error)): ?>
                                                <div class="alert alert-danger py-2"><?= $error ?></div>
                                            <?php endif; ?>
                                            
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-primary text-light" style="width: 90px;"><b>Username</b></span>
                                                </div>
                                                <input type="text" class="form-control" id="Username" placeholder="Masukkan username">
                                            </div>
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-primary text-light" style="width: 90px;"><b>Password</b></span>
                                                </div>
                                                <input type="password" class="form-control" id="Password" placeholder="Masukkan password">
                                            </div>
                                            
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">*Gunakan akun yang sudah terdaftar</small>
                                                <button class="btn btn-primary px-4" id="Masuk"><b>Masuk</b></button>
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
    
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script>   
        jQuery(document).ready(function($) {
            var BaseURL = '<?= base_url() ?>';
            
            // Enter key handler
            $('#Username, #Password').keypress(function(event){
                if(event.keyCode == 13){
                    event.preventDefault();
                    $("#Masuk").click();  
                }
            });
            
            $("#Masuk").click(function() {
                var username = $("#Username").val().trim();
                var password = $("#Password").val().trim();
                
                if (username === '' || password === '') {
                    alert('Username dan Password harus diisi!');
                    return;
                }
                
                var Akun = { 
                    Username: username,
                    Password: password 
                };
                
                $("#Masuk").prop('disabled', true).html('<span class="spinner-border spinner-border-sm mr-2"></span>Loading...');
                
                $.post(BaseURL + "IDE/CekAuth", Akun)
                    .done(function(Respon) {
                        $("#Masuk").prop('disabled', false).html('<b>Masuk</b>');
                        
                        if (Respon == '1') {
                            // Login sukses untuk survei
                            window.location = BaseURL + "IDE/SurveiIKMYogyakarta";
                        }
                        else if (Respon == '2') {
                            // Login untuk role lain
                            if (username.toLowerCase() == 'bappedalamongan') {
                                window.location = BaseURL + "Super/NTPSeries";
                            } else {
                                window.location = BaseURL + "Super";
                            }
                        }
                        else {
                            alert(Respon || 'Login gagal!');
                        }
                    })
                    .fail(function() {
                        $("#Masuk").prop('disabled', false).html('<b>Masuk</b>');
                        alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                    });
            });
        });
    </script>
</body>
</html>