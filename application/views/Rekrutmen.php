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
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
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
                    <div class="card border border-light" style="width: 700px;">
                      <div class="card-header border border-white bg-primary"><b class="text-light">LIST SURVEYOR YANG MENDAFTAR</b></div>
                      <div class="card-body border border-white bg-danger overflow-auto" style="height: 500px;">
                        <div class="table-responsive">
                          <table class="table table-sm table-bordered bg-light" style="font-size: 12px;">
                            <thead>
                              <tr class="bg-danger text-light">
                                <th scope="col" style="width: 4%;" class="text-center align-middle">No</th>
                                <th scope="col" style="width: 30%;" class="align-middle">Nama Surveyor</th>
                                <th scope="col" style="width: 15%;" class="text-center align-middle">Nomer WA</th>
                                <th scope="col" style="width: 5%;" class="text-center align-middle">File CV</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $No = 1; foreach ($Rekrutmen as $key) { ?>
                                <tr>
                                  <th scope="row" class="text-center align-middle"><?=$No++?></th>
                                  <th scope="row" class="align-middle"><?=$key['Nama']?></th>
                                  <th scope="row" class="align-middle text-center"><?=$key['WA']?></th>
                                  <th scope="row" class="text-center align-middle">
                                    <a href="../Rekrutmen/<?=$key['CV']?>" download="CV <?=$key['Nama']?>" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></button>
                                  </th>
                                </tr>
                              <?php } ?>  
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
    </header>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>