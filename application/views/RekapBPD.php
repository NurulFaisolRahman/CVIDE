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
    <link href="../assets/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
  </head>

  <body>  
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
          <div class="card mt-2">
            <div class="card-header bg-primary text-light">
              <b>REKAPITULASI EVALUASI KINERJA BADAN PERMUSYAWARATAN DESA</b>
            </div>
            <div style="background-color: yellow;padding: 0.5rem;" class="card-body border border-primary">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12 my-1">
                    <div class="table-responsive">
                      <table id="RekapBPD" class="table table-bordered bg-light">
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
                          <?php $No = count($BPD); for ($i = 0; $i < count($BPD); $i++) { ?>
                            <tr>
                              <th scope="row" class="text-center align-middle"><?=$No--?></th>
                              <th scope="row" class="text-center align-middle"><?=$BPD[$i][0]?></th>
                              <th scope="row" class="text-center align-middle"><?=$BPD[$i][1]?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($BPD[$i][2],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($BPD[$i][3],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($BPD[$i][4],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($BPD[$i][5],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($BPD[$i][6],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=number_format($BPD[$i][7],2)?></th>
                              <th scope="row" class="text-center align-middle"><?=$BPD[$i][8]?></th>
                              <th scope="row" class="text-center align-middle"><?=$BPD[$i][9]?></th>
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
  <script src="../assets/datatables/jquery.dataTables.js"></script>
	<script src="../assets/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script>
    jQuery(document).ready(function($) {
			$('#RekapBPD').DataTable( {
        // dom:'lfrtip',
        "ordering": true,
        "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]
      })
    })
  </script>
</html>