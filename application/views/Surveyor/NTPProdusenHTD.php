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
                          <td class="align-middle"><b><?=number_format($IT[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[5][$i],2)?></b></td>
                        </tr>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>IB <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[5][$i],2)?></b></td>
                        </tr>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>NTP <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[5][$i],2)?></b></td>
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