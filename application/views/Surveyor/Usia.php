<div class="left-content">
				<div class="mother-grid-inner">
					<div class="inner-block">
						<div class="blank">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-12">
                    <div class="table-responsive">
                      <table class="table table-sm table-bordered">
                        <thead>
                          <tr class="text-center align-middle">
                            <th scope="col">No</th>
                            <th scope="col" style="width: 70%;">Nama Anggota Keluarga</th>
                            <th scope="col" style="width: 25%;">Usia</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php for ($i=0; $i < count($IPM); $i++) { ?>
                            <tr class="text-center align-middle">
                              <th><?=($i+1)?></th>
                              <td><?=str_replace("|",", ",$IPM[$i]['NamaAnggota'])?></td>
                              <td><input class="form-control form-control-sm" type="text" id="Usia<?=$i?>"></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <button type="button" class="btn btn-primary" id="SELESAI"><b>SELESAI</b></button>
                  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
  </body>
  <div class="modal fade" id="Hasil">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold">USIA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                <th scope="col">No</th>
                  <th scope="col">Usia</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < 200; $i++) { ?>
                  <tr>
                    <th><?=($i+1)?></th>
                    <td><div id="USIA<?=$i?>"></div></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Tutup</b></button>
        </div>
      </div>
    </div>
  </div>
	<script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
	<script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
	<script>
		$(document).ready(function(){
			var BaseURL = '<?=base_url()?>'  
			$("#SELESAI").click(function() {
				for (let i = 0; i < 200; i++) {
          $("#USIA"+i).html($("#Usia"+i).val());
        }
        $('#Hasil').modal('show');
			})
		})
		var toggle = true;			
		$(".sidebar-icon").click(function() {                
			if (toggle){
				$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
				$("#menu span").css({"position":"absolute"});
			}
			else{
				$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
				setTimeout(function() {
					$("#menu span").css({"position":"relative"});
				}, 400);
			}
			toggle = !toggle;
		});
	</script>
</html>