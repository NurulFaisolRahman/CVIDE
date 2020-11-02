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
        <div class="col-sm-6">
          <div class="card mt-2">
            <div class="card-header bg-primary text-light">
              <b>REKAPITULASI SURVEY KEPUASAN PELAYANAN DESA / KELURAHAN</b>
            </div>
            <div style="background-color: yellow;" class="card-body border border-primary">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-6 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Kecamatan</b></label>
                      </div>
                      <select class="custom-select" id="Kecamatan">  
                        <?php foreach ($Kecamatan as $key) { ?>
                          <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 my-1">
                    <div class="table-responsive">
                      <table class="table table-bordered bg-light">
                        <thead>
                          <tr class="bg-primary text-light">
                            <th scope="col" class="text-center align-middle">Nama Desa</th>
                            <th scope="col" class="text-center align-middle">Total Responden</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $Index = 0; foreach ($Desa as $key) { ?>
                            <tr>
                              <th scope="row" class="text-center align-middle"><?=$key['Nama']?></th>
                              <td scope="row" class="text-center align-middle"><?=$Responden[$Index++]?></td>
                            </tr>
                          <?php } ?>  
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
  <script>
    $(document).ready(function(){
        
      var BaseURL = '<?=base_url()?>'  

      $("#Kecamatan").change(function (){
        // var Desa = { Kode: $("#Kecamatan").val() }
        // $.post(BaseURL+"IDE/Desa", Desa).done(function(Respon) {
        //   $('#Desa').html(Respon)
        // })    
      })
      
    })
  </script>
</html>