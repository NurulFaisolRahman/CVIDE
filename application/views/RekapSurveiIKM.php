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
              <b>REKAPITULASI SURVEI KEPUASAN PELAYANAN DESA PER KECAMATAN TAHUN 2020</b>
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
                            <th scope="col" class="text-center align-middle">Kecamatan</th>
                            <th scope="col" class="text-center align-middle">V1</th>
                            <th scope="col" class="text-center align-middle">V2</th>
                            <th scope="col" class="text-center align-middle">V3</th>
                            <th scope="col" class="text-center align-middle">V4</th>
                            <th scope="col" class="text-center align-middle">V5</th>
                            <th scope="col" class="text-center align-middle">V6</th>
                            <th scope="col" class="text-center align-middle">V7</th>
                            <th scope="col" class="text-center align-middle">V8</th>
                            <th scope="col" class="text-center align-middle">V9</th>
                            <th scope="col" class="text-center align-middle">V10</th>
                            <th scope="col" class="text-center align-middle">V11</th>
                            <th scope="col" class="text-center align-middle">Nilai<br>Indeks</th>
                            <th scope="col" class="text-center align-middle">Mutu<br>Pelayanan</th>
                            <th scope="col" class="text-center align-middle">Kinerja<br>Unit<br>Pelayanan</th>
                          </tr>
                        </thead>
                        <tbody id="RekapSurvei">
                          <?php for ($i = 0; $i < 25; $i++) { ?>
                            <tr>
                              <th scope="row" class="text-center align-middle"><?=($i+1)?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][0]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][1]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][2]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][3]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][4]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][5]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][6]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][7]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][8]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][9]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][10]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][11]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][12]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][13]?></th>
                              <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[$i][14]?></th>
                            </tr>
                          <?php } ?>  
                          <tr>
                            <th colspan="2" scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][0]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][1]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][2]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][3]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][4]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][5]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][6]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][7]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][8]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][9]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][10]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][11]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][12]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][13]?></th>
                            <th scope="row" class="text-center align-middle"><?=$IKMKecamatan[25][14]?></th>
                          </tr>
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