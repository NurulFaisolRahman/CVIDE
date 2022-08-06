            <div class="clearfix"></div>
              <div class="row">
                <div class="col-lg-8 col-sm-12">
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
                          <th class="align-middle bg-primary">Semester 1</th>
                          <th class="align-middle">Juli</th>
                        </tr>
                      </thead>
                      <tbody style="font-size: 12px;" class="bg-primary">
                      <?php $Sektor = array('Tanaman Pangan','Hortikultura','Perkebunan','Peternakan','Perikanan','5 Sektor'); ?>
                      <?php for ($i=0; $i < 6; $i++) { ?>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>IT <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[5][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($IT[0][$i]+$IT[1][$i]+$IT[2][$i]+$IT[3][$i]+$IT[4][$i]+$IT[5][$i])/6,2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[6][$i],2)?></b></td>
                        </tr>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>IB <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[5][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($IB[0][$i]+$IB[1][$i]+$IB[2][$i]+$IB[3][$i]+$IB[4][$i]+$IB[5][$i])/6,2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[6][$i],2)?></b></td>
                        </tr>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>NTP <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[5][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($NTP[0][$i]+$NTP[1][$i]+$NTP[2][$i]+$NTP[3][$i]+$NTP[4][$i]+$NTP[5][$i])/6,2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[6][$i],2)?></b></td>
                        </tr>
                        <tr><td colspan="9" class="bg-warning"></td></tr>
                      <?php } ?>
                      </tbody>
                    </table>
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
    <script src="<?=base_url("build/js/custom.min.js")?>"></script>
  </body>
</html>