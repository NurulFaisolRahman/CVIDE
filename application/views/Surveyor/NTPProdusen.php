				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped">
                      <thead class="bg-danger">
                        <tr style="font-size: 10pt;" class="text-light text-center">
                          <th class="align-middle">#</th>
                          <th class="align-middle">Januari</th>
                          <th class="align-middle">Februari</th>
                          <th class="align-middle">Maret</th>
                          <th class="align-middle">April</th>
                          <th class="align-middle">Mei</th>
                          <th class="align-middle">Juni</th>
                        </tr>
                      </thead>
                      <tbody style="font-size: 12px;" class="bg-primary">
                      <?php $Sektor = array('Tanaman Pangan','Hortikultura','Perkebunan','Peternakan','Perikanan','5 Sektor'); ?>
                      <?php for ($i=0; $i < count($NTP); $i++) { ?>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>IT <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[$i][0],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[$i][1],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[$i][2],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[$i][3],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[$i][4],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[$i][5],2)?></b></td>
                        </tr>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>IB <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[$i][0],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[$i][1],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[$i][2],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[$i][3],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[$i][4],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[$i][5],2)?></b></td>
                        </tr>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>NTP <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[$i][0],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[$i][1],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[$i][2],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[$i][3],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[$i][4],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[$i][5],2)?></b></td>
                        </tr>
                        <tr><td colspan="7" class="bg-warning"></td></tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div>
        <!-- /page content -->
      </div>
    </div>

    <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
    <script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
    <script src="<?=base_url('assets/inputmask/min/jquery.inputmask.bundle.min.js')?>"></script>
		<script src="<?=base_url("build/js/custom.min.js")?>"></script>
  </body>
</html>