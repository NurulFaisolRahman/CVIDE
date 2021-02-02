<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>IDE Consultant</title>
    <!-- Favicons -->
    <link href="../assets/img/favicon.ico" rel="icon">
    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet"> -->
    <!-- Template Main CSS File -->
    <!-- <link href="../assets/css/style.css" rel="stylesheet"> -->
  </head>

  <body>  
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
          <div class="card mt-2">
            <div class="card-header bg-primary text-light">
              <b>REKAPITULASI DESA YANG BELUM MENYELESAIKAN SURVEI KEPUASAN PELAYANAN TAHUN 2020</b>
            </div>
            <div style="background-color: yellow;padding: 0.5rem;" class="card-body border border-primary">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12 my-1">
                    <div class="table-responsive">
                      <table class="table table-bordered bg-light">
                        <thead>
                          <tr class="bg-primary text-light">
                            <th scope="col" class="text-center align-middle">No</th>
                            <th scope="col" class="text-center align-middle">Desa</th>
                            <th scope="col" class="text-center align-middle">Kecamatan</th>
                            <th scope="col" class="text-center align-middle">Total Responden</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($Rekap as $key => $value) { $Pecah = explode("|",$value); ?>
                            <tr>
                              <td scope="row" class="text-center align-middle"><?=($key+1)?></td>
                              <td scope="row" class="text-center align-middle"><?=$Pecah[0]?></td>
                              <td scope="row" class="text-center align-middle"><?=$Pecah[1]?></td>
                              <td scope="row" class="text-center align-middle"><?=$Pecah[2]?></td>
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
  </body>
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</html>