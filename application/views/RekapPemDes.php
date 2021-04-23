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
  </head>

  <body>  
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
          <div class="card mt-2">
            <div class="card-header bg-primary text-light">
              <b>REKAPITULASI EVALUASI KINERJA PENYELENGGARAAN PEMERINTAHAN DESA</b>
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
                            <th scope="col" class="text-center align-middle">Desa</th>
                            <th scope="col" class="text-center align-middle">V1</th>
                            <th scope="col" class="text-center align-middle">V2</th>
                            <th scope="col" class="text-center align-middle">V3</th>
                            <th scope="col" class="text-center align-middle">V4</th>
                            <th scope="col" class="text-center align-middle">V5</th>
                            <th scope="col" class="text-center align-middle">Nilai<br>Indeks</th>
                            <th scope="col" class="text-center align-middle">Mutu<br>Pelayanan</th>
                            <th scope="col" class="text-center align-middle">Kinerja<br>Unit<br>Pelayanan</th>
                          </tr>
                        </thead>
                        <tbody id="RekapSurvei">
                          <?php $No = count($PemDes); for ($i = 0; $i < count($PemDes); $i++) { ?>
                            <tr>
                              <th scope="row" class="text-center align-middle"><?=$No--?></th>
                              <th scope="row" class="text-center align-middle"><?=$PemDes[$i][0]?></th>
                              <th scope="row" class="text-center align-middle"><?=$PemDes[$i][1]?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($PemDes[$i][2],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($PemDes[$i][3],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($PemDes[$i][4],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($PemDes[$i][5],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($PemDes[$i][6],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($PemDes[$i][7],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=$PemDes[$i][8]?></th>
                              <th scope="row" class="text-center align-middle"><?=$PemDes[$i][9]?></th>
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