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
            <div class="col-sm-5">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card border border-warning">
                      <div class="card-header bg-primary"><b class="text-light">Rekap Survei Kominfo</b></div>
                      <div class="card-body bg-danger overflow-auto" style="height: 250px;">
                        <div class="container-fluid p-0">
                          <div class="row">
                            <div class="col-sm-12">
                              <!-- <pre class="mb-1 text-white"><b>Total = <?=$Total?></b></pre> -->
                              <div class="table-responsive mt-1">
                                <table class="table table-sm table-bordered table-striped">
                                  <thead class="bg-primary">
                                    <tr style="font-size: 10pt;" class="text-light text-center">
                                      <th class="align-middle">No</th>
                                      <th class="align-middle">Instansi</th>
                                      <th class="align-middle">Responden</th>
                                    </tr>
                                  </thead>
                                  <tbody style="font-size: 12px;" class="bg-primary">
                                  <?php $Instansi = array('OPD','Kecamatan','Kelurahan','Desa','Masyarakat Umum'); $No = 1; for ($i=0; $i < 5; $i++) { ?>
                                    <tr class="text-light align-middle">
                                      <td class="align-middle text-center font-weight-bold"><?=$No++?></td>
                                      <td class="align-middle font-weight-bold"><?=$Instansi[$i]?></td>
                                      <td class="align-middle text-center font-weight-bold"><?=$Data[$i]?></td>
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
          </div>
        </div>
      </div>
    </header>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>