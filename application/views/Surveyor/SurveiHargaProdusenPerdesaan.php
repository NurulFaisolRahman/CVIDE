				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="card"> 
                    <div class="card-header bg-primary text-white">
                      <b>SURVEI HARGA PRODUSEN PERDESAAN</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary pl-0 pr-2 py-2">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-primary border-white" data-toggle="modal" data-target="#ModalInput"><i class="fa fa-plus"></i><b> Input Data Survei</b></button>
                            <div class="table-responsive">
                              <table id="TabelProdusen" class="table table-sm table-bordered bg-light">
                                <thead>
                                  <tr class="bg-danger text-light">
                                    <th scope="col" style="width: 4%;" class="text-center align-middle">No</th>
                                    <th scope="col" class="align-middle">Kecamatan</th>
                                    <th scope="col" class="align-middle">Tanggal Survei</th>
                                    <th scope="col" class="align-middle">Nama Responden</th>
                                    <th scope="col" class="text-center align-middle">Edit</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $No = 1; foreach ($Data as $key) {?>
                                    <tr>
                                      <th scope="row" class="text-center align-middle"><?=$No++?></th>
                                      <th scope="row" class="align-middle"><?=$key['NamaKecamatan']?></th>
                                      <th scope="row" class="align-middle"><?=$key['TanggalSurvei']?></th>
                                      <th scope="row" class="align-middle"><?=$key['NamaResponden']?></th>
                                      <th scope="row" style="width: 10%;" class="text-center align-middle">
                                        <button Edit="<?=$key['Id'].'$'.$key['Kecamatan'].'$'.$key['TanggalSurvei'].'$'.$key['NamaResponden'].'$'.$key['Alamat'].'$'.$key['KodeKualitas'].'$'.$key['Harga'].'$'.$key['_Harga']?>" class="btn btn-sm btn-warning Edit"><i class="fa fa-edit"></i></button>
                                        <button Copy="<?=$key['Id'].'$'.$key['Kecamatan'].'$'.$key['TanggalSurvei'].'$'.$key['NamaResponden'].'$'.$key['Alamat'].'$'.$key['KodeKualitas'].'$'.$key['Harga'].'$'.$key['_Harga']?>?>" class="btn btn-sm btn-primary Copy"><i class="fa fa-copy"></i></button>
                                      </th>
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
        <!-- /page content -->
      </div>
    </div>

    <div class="modal fade" id="ModalInput">
      <div class="modal-dialog modal-xl">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Kecamatan</b></label>
                    </div>
                    <select class="custom-select" id="Kecamatan">  
                      <?php foreach ($Kecamatan as $key) { ?>
                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option> 
                      <?php } ?>                  
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Tanggal Survei</b></label>
                    </div>
                    <input class="form-control" type="date" id="TanggalSurvei">
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Nama Responden</b></label>
                    </div>
                    <input class="form-control" type="text" id="NamaResponden">
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Alamat Responden</b></label>
                    </div>
                    <input class="form-control" type="text" id="Alamat">
                  </div>
                </div>  
                <?php $Kode = array('IA001001','IA001002','IA001003','IA001004','IA001005','IA001006','IA002001','IA002002','IA002003','IA002004','IA002005','IA002006','IA003001','IA003002',
                'IA003003','IA003004','IA003005','IA003006','IA004001','IA004002','IA005001','IA005002','IB001001','IB001002','IB002001','IB002002','IB001003','IB003001','IB005001','IB005002',
                'IB006001','IB006002','IB007001','IB007002','IB008001','IB008002','IB008003','IB009001','IB009002','IB010001','IB011001','IB012001','JA101001','JA101002','JA101003','JA101004',
                'JA102001','JA102002','JA102003','JA102004','JA201001','JA201002','JA202001','JA203001','JA204001','JA205001','JA206001','JA207001','JA208001','JB001001','JB001002','JB001003',
                'JB002001','JB002002','JB004001','JB005001','JB006001','JB007001','JB008001','JB011001','JB012001','JB012002','JB012003','JB013001','JB014001','JB015001','JB101001','JB101002',
                'JB101003','JB102001','JB102002','JB102003','JB103001','JB103002','JB103003','JB104001','JB104002','JB104003','JB105001','JB105002','JB105003','JB106001','JB106002','JB106003',
                'JB107001','JB107002','JC001001','JC001002','JC001003','JC002001','JC002002','JC002003','JC006001','JC007001','JC007002','JC008001','JC008002','JC009001','JC009002','JC010001',
                'JC011001','JC013001','JC014001','JC015001','JC016001','JC017001','JD001001','JD001002','JD001003','JD002001','JD002002','JD002003','JD002004','JD003002','JD003003','JD003004',
                'JD003005','JD004001','JD004002','JD005001','JD005002','JD005003','JD006001','JD006002','JD006003','JD007001','JD007002','JD008001','JD008002','JD010001','JD010002','JD011001',
                'JD011002','JD012001','JD013001','JD014001','JD016001','JD016002','JD017001','JD017002','JD018001','JF001001','JF002001','JF002002','JF003001','JF003002','JF004001','JF005001',
                'JF005002','JF006001','JF006002','JF007001','JF008001','JF009001','JF009002','JF010001','JF010002','JF011001','JF012001','JF013001','JF016001','JF017001','JF017002','JF018001',
                'JF019001','JF019002','JF020001','JF023001','JF024001','JF025001','JF026001','JF027001','JF028001','JF029001','JF030001','JF031001','JF032001','JF033001','JF034001','JF035001',
                'JG003001','JG004001','JG005001','JG005002','JG006001','JG007001','JG009001','JG009002','JG011001','JG011002','JG012001','JG012002','JG013001','JG013002','JG014001','JG015001',
                'JG016001','JG017001','KA101101','KA101102','KA101103','KA201101','KA201102','KA201103','KA301101','KA301102','KA301103','KA401101','KA401102','KA401103','KA501101','KA501102',
                'KA501103','KA601101','KA601102','KA601103','KA701101','KA701102','KA701103','KA801101','KA801102','KA801103','KA901101','KA901102','KA901103','KA911101','KA911102','KA911103',
                'KA921101','KA921102','KA921103','KA941101','KA941102','KA941103','KA951101','KA951102','KA951103','KA961101','KA961102','KA961103','XA001001','XA002001','XA002002','XA002003',
                'XA003001','XA004001','XA005001','XA006001','XA007001','XA007002','XA008001','XA009001','XA010001','XA010002','XA011001','XA012001','XA013001','XA014001','XA014002','XA015001',
                'XA016001','XA016002','XA017001','XA019001','XA020001','XA022001','XA024001','XA025001','XA026001','XA027001','XA028001','XA029001','XA030001','XA031001','XA032001','XA033001',
                'XA034001','XA035001','XA036001','XA037001','XA038001','XA039001','XB001001','XB001002','XB001003','XB002001','XB002002','XB003001','XB003002','XB004001','XB005001','XB005002',
                'XB006001','XB006002','XB007001','XB007002','XB007003','XB008001','XB008002','XB008003','XB009001','XB009002','XB009003','XB009004','XB009005','XB010001','XB010002','XB010003',
                'XB010004','XB010005','XB012001','XB013001','XB013002','XB014001','XB014002','XB014003','XB015001','XB016001','XB016002','XB016003','XB017001','XB018001','XB018002','XB019001',
                'XB019002','XB019003','XB020001','XB020002','XB021001','XB021002','XB021003','XB022001','XB022002','XB023001','XB023002','XB023003','XB023004','XB024001','XB026001','XB027001',
                'XB028001','XB029001','XB030001','XB031001','XB032001','XB033001','XB034001','XB035001','XD001001','XD002001','XD003001','XD004001','XD005001','XD007001','XD008001','XD009001',
                'XD010001','XD011001','XD012001','YA101001','YA101002','YA101003','YA102001','YA102002','YA103001','YA104001','YA105001','YA106001','YA107001','YA108001','YA109001','YA110001',
                'YA111001','YA112001','YA113001','YA114001','YA115001','YA116001','YA117001','YA118001','YA119001','YA121001','YA122001','YA161001','YA163001','YA164001','YA165001','YA166001',
                'YA167001','YA201001','YA201002','YA202001','YA202002','YA203001','YA203002','YA203003','YA204001','YA204002','YA204003','YA204004','YA205001','YA206001','YA206002','YA207001',
                'YA207002','YA207003','YA208001','YA208002','YA209001','YA211001','YA211002','YA212001','YA212002','YA262001','YA263001','YA264001','YA265001','YA266001','YA267001','YA268001',
                'YA401001','YA402001','YA403001','YA405001','YA408001','YA409001','YA410001','YB001001','YB001002','YB001003','YB002001','YB002002','YB004001','YB005001','YB006001','YB007001',
                'YB008001','YB011001','YB016001','YB601001','YB601002','YB601003','YB602001','YB603001','YB604001','YB605001','YB101001','YB101002','YB101003','YB102001','YB102002','YB103001',
                'YB103002','YB104001','YB104002','YB105001','YB105002','YB106001','YB106002','YB107001','YB108001','YB109001','YC001001','YC001002','YC001003','YC002001','YC002002','YC002003',
                'YC006001','YC006002','YC007001','YC007002','YC009001','YC009002','YC010001','YC011001','YC601001','YC602001','YD001001','YD001002','YD001003','YD002001','YD002003','YD002004',
                'YD002002','YD003002','YD003003','YD003004','YD003005','YD004001','YD004002','YD005001','YD005002','YD006001','YD006002','YD007001','YD007002','YD008001','YD008002','YD011001',
                'YD012001','YD012002','YD012003','YD013001','YD013002','YD013003','YD014001','YD014002','YD014003','YD015001','YD015002','YD017001','YD017002','YD017003','YD018001','YF001001',
                'YF003001','YF004001','YF005001','YF006001','YF006002','YF007001','YF008001','YF009001','YF009002','YF011001','YF012001','YF016001','YF017001','YF017002','YF018001','YF019001',
                'YF019002','YF020001','YF022001','YF023001','YF024001','YF025001','YF026001','YF027001','YF028001','YF031001','YF033001','YF601001','YF603001','YF605001','YF607001','YF607002',
                'YF999001','YF100001','YG003001','YG004001','YG006001','YG007001','YG009001','YG009002','YG009003','YG012001','YG013001','YG015001','YG015002','YG016001','ZA101101','ZA101102',
                'ZA101103','ZA201101','ZA201102','ZA201103','ZA301101','ZA301102','ZA301103','ZA401101','ZA401102','ZA401103','ZA501101','ZA501102','ZA501103','ZA601101','ZA601102','ZA601103',
                'ZA701101','ZA701102','ZA701103','ZA801101','ZA801102','ZA801103','ZA901101','ZA901102','ZA901103','ZA921101','ZA921102','ZA921103','LA001001','LA001002','LA002001','LA002002',
                'LA004001','LA004002','LA005001','LA006001','LA006002','LA006003','LA008001','LA011001','LA011002','LA012001','LA012002','LA013001','LA014001','LA017001','LA017002','LA019001',
                'LA020001','LA021001','LA022001','LA023001','LA026001','LA027001','LA029001','LA031001','LA032001','LA033001','LA007001','LA009001','LA009002','LA018001','LA025001','LA028001',
                'LA030001','MA001001','MA001002','MA001003','MA002001','MA002002','MA002003','MA003001','MA004001','MA005001','MA006001','MA007001','MA008001','MA009001','MA010001','MA011001',
                'MA012001','MA015001','MA017001','MA018001','MA019001','MB001001','MB001002','MB001003','MB002001','MB002002','MB004001','MB005001','MB005002','MB006001','MB007001','MB007002',
                'MB007003','MB008001','MB011001','MB013001','MB014001','MB015002','MB015001','MB015002','MB016001','MB017001','MB018001','MB101001','MB101002','MB101003','MB101004','MB102001',
                'MB102002','MB102003','MB103001','MB103002','MB103003','MB104001','MB104002','MB105001','MB105002','MB106001','MB106002','MC001001','MC001002','MC001003','MC003001','MC004001',
                'MC004002','MC005001','MC005002','MC007001','MC008001','MC009001','MC010001','MC011001','MD001001','MD001002','MD001003','MD001004','MD002001','MD002002','MD002003','MD002004',
                'MD003002','MD003003','MD003004','MD003005','MD004001','MD004002','MD005001','MD005002','MD005003','MD006001','MD006002','MD007001','MD007002','MD008001','MD008002','MD009001',
                'MD009002','MD011001','MD011002','MD012001','MD012002','MD013001','MD014001','MD014002','MD014003','MD015001','MD015002','MD015003','MD017001','MD019001','MD019002','MD019003',
                'MD019004','MD020001','MD020002','MD021001','MD022001','ME001001','ME002001','ME002002','ME002003','ME003001','ME003002','ME004001','ME004002','ME005001','ME005002','ME006001',
                'ME007001','ME008001','ME009001','ME009002','ME009003','ME010001','ME011001','ME011002','ME012001','ME012002','ME013001','ME014001','ME015001','ME017001','ME019001','ME020001',
                'ME021001','ME022001','ME023001','ME024001','ME025001','ME026001','ME602001','ME602002','ME602003','ME604001','ME605001','ME606001','ME607001','ME608001','ME609001','ME610001',
                'ME611001','ME612001','ME613001','MF002001','MF002002','MF003001','MF006001','MF009001','MF009002','MF009003','MF012001','MF012002','MF602001','MF603001','MF606001','MF607001',
                'NA101101','NA102101','NA103101','NA201101','NA202101','NA203101','NA301101','NA301102','NA301103','NA401101','NA401102','NA401103','NA501101','NA501102','NA501103','NA601101',
                'NA601102','NA601103','NA701101','NA701102','NA701103','NA801101','NA801102','NA801103','NA901101','NA901102','NA901103','NA911101','NA911102','NA911103','NA921101','NA921102',
                'NA921103','NA931101','NA931102','NA931103','OA001001','OA001002','OA001003','OA002001','OA002002','OA002003','OA002004','OA002005','OA002006','OA003001','OA003002','OA004001',
                'OA004002','OA005002','OB001001','OB001002','OB001003','OB001004','OB002001','OB002002','OB002003','OB002004','OB003001','OB003002','OB003003','OB003004','OB003005','OB004001',
                'OB004002','OB005001','OB006001','OC002001','OC002002','OC002003','OC002004','OC003001','OC005001','OC005002','OC005003','OC006001','OC007001','OC008001','OC009001','OC010001',
                'OC011001','OD001001','OD006001','OD007001','OD008001','OD009001','OD010001','OD011001','PA002001','PA002002','PA002003','PA003001','PA003002','PA005001','PA005002','PA006001',
                'PA006002','PA007001','PA007002','PA601001','PA601002','PA602001','PA602002','PA615001','PA615002','PA615003','PA616001','PA616002','PA617001','PA617002','PA617003','PA618001',
                'PA618002','PA619001','PA619002','PA620001','PA620002','PA621001','PA621002','PA622001','PA622002','PA623001','PA623002','PA624001','PA625001','PA626001','PA701001','PA701002',
                'PA702001','PA702002','PA703001','PA703002','PA703003','PA704001','PA704002','PA705001','PA705002','PA706001','PA706002','PA707001','PB102001','PB102002','PB102003','PB102004',
                'PB104001','PB105001','PB106001','PB107001','PB107002','PB107003','PB108001','PB109001','PB110001','PB113001','PB114001','PB116001','PB117001','PB122001','PB162001','PB164001',
                'PB165001','PB165002','PB165003','PB166001','PB201001','PB201002','PB201003','PB201004','PB202001','PB202002','PB202003','PB202004','PB203001','PB203002','PB204001','PB204002',
                'PB205001','PB205002','PB205003','PB206001','PB206002','PB208001','PB208002','PB209001','PB210001','PB210002','PB210003','PB210004','PB211001','PB212001','PB214001','PB215001',
                'PB216001','PB217001','PB218001','PB219001','PB220001','PB221001','PB261001','PB262001','PB263001','PB264001','PB265001','PB266001','PB267001','PB268001','PB269001','PB270001',
                'PC001001','PC002001','PC012001','PC601001','PC602001','PC603001','PD001001','PD001002','PD001003','PD001004','PD002001','PD002003','PD002004','PD002002','PD003002','PD003003',
                'PD003004','PD003005','PD004001','PD004002','PD005001','PD005002','PD006001','PD006002','PD007001','PD007002','PD008001','PD009001','PD009002','PD014001','PD601001','PD601002',
                'PD601003','PD602001','PE001001','PE001002','PE002001','PE002002','PE002003','PE003001','PE003002','PE003003','PE004001','PE004002','PE008001','PE008002','PE012001','PE012002',
                'PE013001','PE013002','PE015001','PE016001','PE017001','PE018001','PE019001','PE020001','PE021001','PE023001','PE024001','PE025001','PE602001','PE602002','PE605001','PE606001',
                'PE607001','PE608001','PE609001','PE610001','PE611001','PE612001','PE613001','PE614001','PE615001','PE616001','PE617001','PE618001','PE619001','PE620001','PF005001','PF006001',
                'PF007001','PF008001','PF010001','PF010002','PF011001','PF012001','PF014001','PF015001','PF016001','PF016002','PF016003','PF017001','PF017002','PF018001','PF019001','PF019002',
                'PF020001','PF020002','PF021001','PF022001','PF022002','PF023001','PF023002','PF024001','PF602001','PF602002','PF603001','PF604001','PF605001','PF606001','QA101101','QA101102',
                'QA101103','QA301101','QA301102','QA301103','QA401101','QA401102','QA401103','QA501101','QA501102','QA501103','QA502101','QA502102','QA502103','RA001001','RA002001','RA003001',
                'RA004001','RA006001','RA007001','RA007002','RA007003','RA007004','RA007005','RA007006','RA008001','RA009001','RA010001','RA011001','RA011002','RA011003','RA011004','RA011005',
                'RA012001','RA014001','RA015001','RA019001','RA020001','RA021001','RA022001','RA023001','RA024001','RA501001','RA502001','RA503001','RA505001','RA507001','RA508001','RA509001',
                'RA510001','RB001001','RB004001','RB005001','RB006001','RB008001','RB010001','RB011001','RB012001','RB013001','RB014001','RB016001','RB017001','RB020001','RB021001','RB023001',
                'RB024001','RB028001','RB029001','RB030001','RB032001','RB035001','RB037001','RB039001','RB040001','RB042001','RB042002','RB042003','RB042004','RB042005','RB044001','RB046001',
                'RB047001','RB048001','RB049001','RB050001','RB052001','RB053001','RB054001','RB055001','RB056001','RB057001','RB058001','RB059001','RB063001','RB065001','RB072001','RB072002',
                'RB072003','RB072004','RB073001','RB076001','RB078001','RB080001','RB081001','RB082001','RB082002','RB083001','RB085001','RB086001','RB087001','RB092001','RB093001','RB094001',
                'RB095001','RB096001','RB098001','RB099001','RB104001','RB106001','RB106002','RB106003','RB106004','RB106005','RB108001','RB109001','RB109002','RB109003','RB109004','RB109005',
                'RB110001','RB111001','RB113001','RB114001','RB115001','RB115002','RB115003','RB117001','RB118001','RB127001','RB128001','RB131001','RB131002','RB501001','RB502001','SA001001',
                'SA001002','SA001003','SA001004','SA002001','SA002002','SA002003','SA002004','SA003001','SA003002','SA003003','SA003004','SA003005','SA004001','SA004002','SA004003','SA004004',
                'SA005001','SB001001','SB001002','SB001003','SB001004','SB001005','SB001006','SB002001','SB002003','SB002004','SB002002','SB003002','SB003003','SB003004','SB003005','SB004001',
                'SB004002','SB004003','SB005001','SB005002','SB005003','SB006001','SB006002','SB006003','SB007002','SB007003','SB008001','SB009001','SC001001','SC001002','SC001003','SC001004',
                'SC002001','SC002002','SC002003','SC002004','SC003001','SC003002','SC003003','SC003004','SC003005','SC003006','SC004001','SC004002','SC004003','SC005001','SC005002','SC005003',
                'SC006001','SC007001','SC007002','SC007003','SC007004','SC008001','SC009001','SC009002','SC009003','SC009004','SC009005','SC010001','SC010002','SC010003','SC010004','SC011001',
                'SC011002','SC011003','SC011004','SC011005','SC011006','SC013001','SC014001','SC015001','SC016001','SC017001','SC018001','SC019001','SC019002','SC020001','SC020002','SC021001',
                'SC022001','SC022002','SC023001','SC024001','SC025001','SC026001','SC027001','SC028001','SC029001','SC030001','SC031001','SC032001','SC033001','SC033002','SC033003','SC033004',
                'SC034001','SC034002','SC034003','SC034004','SC034005','SC037001','SC038001','SC039001','SC040001','SC601001','SC601002','SC601003','SC602001','SC603001','SC603002','SC604001',
                'SC605001','SE001001','SE002001','SE003001','SE004001','SE004002','SE004003','SE004004','SE005001','SE006001','SE006002','SE007001','SE007002','SE007003','SE007004','SE007005',
                'SE007006','SE008001','SE009001','SE010001','SE011001','SE015001','SE016001','SE016002','SE016003','SE017001','SE017002','SE018001','SE019001','SE020001','SE021001','SE602001',
                'SE603001','SE603002','SE604001','SE605001','SF101101','SF102101','SF103101','SF201101','SF202101','SF203101','SF301101','SF302101','SF303101','SF501101','SF502101','SF503101',
                'SF401101','SF402101','SF403101','TA002001','TA005001','TA006001','TA007001','TA009001','TA012001','TA012002','TA012003','TA012004','TA012005','TA012006','TA013001','TA014001',
                'TA015001','TA017001','TA018001','TA019001','TA019002','TA019003','TA019004','TA019005','TA032001','TA033001','TB002001','TB002002','TB002003','TB003001','TB003002','TB003003',
                'TB003004','TB003005','TB006001','TB006002','TB006003','TB006004','TB006005','TB006006','TB007001','TB011001','TB011002','TB013001','TB016002','TB016003','TB503001','TB504001',
                'TB505001','TB506001','TB507001','TC001001','TC002001','TC003001','TC004001','TC005001','TC006001','TC007001','TC011001','TC011002','TC011003','TC011004','TC011005','TC012002',
                'TC013001','UA002001','UA004001','UA005001','UA006001','UA007001','UA011001','UA011002','UA011003','UA011004','UA011005','UA012001','UA013001','UA014001','UA016001','UA018001',
                'UA018002','UA018003','UA018004','UA020001','UA021001','UA022001','UA023001','UA101001','UA101002','UA101003','UA102001','UA102002','UA102003','UA102004','UA102005','UA104001',
                'UA104002','UA104003','UA104004','UA104005','UA105001','UA106001','UA161001','UA162001','UA163001','UA164001','UA165001','UA166001','UA201001','UA201002','UA201003','UA202001',
                'UA203001','UA204001','UA205001','UA206001','UA210001','UA210002','UA210003','UA210004','UA210005','UA211001','UA212001','UA213001','UB001001','UB001002','UB001003','UB002001',
                'UB002002','UB003001','UB004001','UB004002','UB004003','UB004004','UB005001','UB006001','UB061001','UB062001','UB063001','UB064001','UB101001','UB102001','UB103001','UB104001',
                'UB104002','UB105001','UB106001','UB107001','UB108001','UB109001','UB110001','UB111001','UB112001','UB113001','UB201001','UB201002','UB202001','UB202002','UB203001','UB204001',
                'UB205001','UB207001','UB208001','UB209001','UB210001','UB211001','UB212001','UB213001','UB262001','UB263001','UB265001','UB266001','UB267001','UC001001','UC601001','UC602001',
                'UC603001','UD001001','UD001002','UD001003','UD001004','UD001005','UD001006','UD002001','UD002003','UD002004','UD002002','UD003002','UD003003','UD003004','UD003005','UD004001',
                'UD004002','UD004003','UD005001','UD005002','UD005003','UD006001','UD006002','UE001001','UE001002','UE001003','UE001004','UE002001','UE002002','UE002003','UE002004','UE003001',
                'UE003002','UE003003','UE003004','UE003005','UE003006','UE004001','UE004002','UE004003','UE004004','UE005001','UE007001','UE007002','UE007003','UE007004','UE008001','UE008002',
                'UE008003','UE008004','UE008005','UE008006','UE010001','UE010002','UE010003','UE011001','UE012001','UE014001','UE015001','UE016001','UE017001','UE018001','UE019001','UE019002',
                'UE020001','UE020002','UE021001','UE022001','UE022002','UE023001','UE024001','UE025001','UE026001','UE027001','UE028001','UE029001','UE030001','UE031001','UE032001','UE033001',
                'UE601001','UE602001','UE603001','UE605001','UE606001','UE607002','UE608003','UE609001','UE610001','UE611001','UE612001','UE613001','UG002001','UG003001','UG004001','UG005001',
                'UG005002','UG006001','UG006002','UG006003','UG007001','UG007002','UG007003','UG008001','UG604001','UG604002','UG605001','UG606001','UH201101','UH201102','UH201103','UH301101',
                'UH301102','UH301103','UH401101','UH401102','UH401103','UH501101','UH501102','UH501103','UH601101','UH601102','UH601103','UH701101','UH701102','UH701103','UH011101','UH011102',
                'UH011103');?>
                <div class="col-sm-6">
                  <div class="table-responsive mt-1">
                    <table class="table table-sm table-bordered table-striped">
                      <thead class="bg-danger">
                        <tr style="font-size: 10pt;" class="text-white text-center">
                          <th class="align-middle">Kode Kualitas</th>
                          <th class="align-middle">Harga Bulan Pencacahan</th>
                          <th class="align-middle">Harga Bulan Sebelumnya</th>
                        </tr>
                      </thead>
                    <?php for ($i=0; $i < 880; $i++) { ?>
                      <tr class="text-white bg-primary">
                        <td class="text-center align-middle font-weight-bold"><?=$Kode[$i]?></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="<?=$Kode[$i]?>"></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="<?='_'.$Kode[$i]?>"></td>
                      </tr>
                    <?php } ?>
                    </table>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="table-responsive mt-1">
                    <table class="table table-sm table-bordered table-striped">
                      <thead class="bg-danger">
                        <tr style="font-size: 10pt;" class="text-white text-center">
                          <th class="align-middle">Kode Kualitas</th>
                          <th class="align-middle">Harga Bulan Pencacahan</th>
                          <th class="align-middle">Harga Bulan Sebelumnya</th>
                        </tr>
                      </thead>
                    <?php for ($i=880; $i < 1759; $i++) { ?>
                      <tr class="text-white bg-primary">
                        <td class="text-center align-middle font-weight-bold"><?=$Kode[$i]?></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="<?=$Kode[$i]?>"></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="<?='_'.$Kode[$i]?>"></td>
                      </tr>
                    <?php } ?>
                    </table>
                  </div>
                </div>
                <div class="col-sm-12 mt-2 d-flex justify-content-center">
                  <button type="button" class="btn btn-primary" id="Simpan"><b>Simpan Survei&nbsp;</b><div id="LoadingInput" class="spinner-border spinner-border-sm text-white" role="status" style="display: none;"></div></button>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="ModalEdit">
      <div class="modal-dialog modal-xl">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Kecamatan</b></label>
                    </div>
                    <select class="custom-select" id="EditKecamatan">  
                      <?php foreach ($Kecamatan as $key) { ?>
                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option> 
                      <?php } ?>                  
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Tanggal Survei</b></label>
                    </div>
                    <input class="form-control" type="date" id="EditTanggalSurvei">
                    <input class="form-control" type="hidden" id="Id">
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Nama Responden</b></label>
                    </div>
                    <input class="form-control" type="text" id="EditNamaResponden">
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Alamat Responden</b></label>
                    </div>
                    <input class="form-control" type="text" id="EditAlamat">
                  </div>
                </div>  
                <div class="col-sm-6">
                  <div class="table-responsive mt-1">
                    <table class="table table-sm table-bordered table-striped">
                      <thead class="bg-danger">
                        <tr style="font-size: 10pt;" class="text-white text-center">
                          <th class="align-middle">Kode Kualitas</th>
                          <th class="align-middle">Harga Bulan Pencacahan</th>
                          <th class="align-middle">Harga Bulan Sebelumnya</th>
                        </tr>
                      </thead>
                    <?php for ($i=0; $i < 880; $i++) { ?>
                      <tr class="text-white bg-primary">
                        <td class="text-center align-middle font-weight-bold"><?=$Kode[$i]?></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="Edit<?=$Kode[$i]?>"></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="Edit<?='_'.$Kode[$i]?>"></td>
                      </tr>
                    <?php } ?>
                    </table>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="table-responsive mt-1">
                    <table class="table table-sm table-bordered table-striped">
                      <thead class="bg-danger">
                        <tr style="font-size: 10pt;" class="text-white text-center">
                          <th class="align-middle">Kode Kualitas</th>
                          <th class="align-middle">Harga Bulan Pencacahan</th>
                          <th class="align-middle">Harga Bulan Sebelumnya</th>
                        </tr>
                      </thead>
                    <?php for ($i=880; $i < 1759; $i++) { ?>
                      <tr class="text-white bg-primary">
                        <td class="text-center align-middle font-weight-bold"><?=$Kode[$i]?></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="Edit<?=$Kode[$i]?>"></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="Edit<?='_'.$Kode[$i]?>"></td>
                      </tr>
                    <?php } ?>
                    </table>
                  </div>
                </div>
                <div class="col-sm-12 mt-2 d-flex justify-content-center">
                  <button type="button" class="btn btn-primary" id="Edit"><b>Update Survei&nbsp;</b><div id="LoadingEdit" class="spinner-border spinner-border-sm text-white" role="status" style="display: none;"></div></button>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="ModalCopy">
      <div class="modal-dialog modal-xl">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Kecamatan</b></label>
                    </div>
                    <select class="custom-select" id="CopyKecamatan">  
                      <?php foreach ($Kecamatan as $key) { ?>
                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option> 
                      <?php } ?>                  
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Tanggal Survei</b></label>
                    </div>
                    <input class="form-control" type="date" id="CopyTanggalSurvei">
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Nama Responden</b></label>
                    </div>
                    <input class="form-control" type="text" id="CopyNamaResponden">
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Alamat Responden</b></label>
                    </div>
                    <input class="form-control" type="text" id="CopyAlamat">
                  </div>
                </div>  
                <div class="col-sm-6">
                  <div class="table-responsive mt-1">
                    <table class="table table-sm table-bordered table-striped">
                      <thead class="bg-danger">
                        <tr style="font-size: 10pt;" class="text-white text-center">
                          <th class="align-middle">Kode Kualitas</th>
                          <th class="align-middle">Harga Bulan Pencacahan</th>
                          <th class="align-middle">Harga Bulan Sebelumnya</th>
                        </tr>
                      </thead>
                    <?php for ($i=0; $i < 880; $i++) { ?>
                      <tr class="text-white bg-primary">
                        <td class="text-center align-middle font-weight-bold"><?=$Kode[$i]?></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="Copy<?=$Kode[$i]?>"></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="Copy<?='_'.$Kode[$i]?>"></td>
                      </tr>
                    <?php } ?>
                    </table>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="table-responsive mt-1">
                    <table class="table table-sm table-bordered table-striped">
                      <thead class="bg-danger">
                        <tr style="font-size: 10pt;" class="text-white text-center">
                          <th class="align-middle">Kode Kualitas</th>
                          <th class="align-middle">Harga Bulan Pencacahan</th>
                          <th class="align-middle">Harga Bulan Sebelumnya</th>
                        </tr>
                      </thead>
                    <?php for ($i=880; $i < 1759; $i++) { ?>
                      <tr class="text-white bg-primary">
                        <td class="text-center align-middle font-weight-bold"><?=$Kode[$i]?></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="Copy<?=$Kode[$i]?>"></td>
                        <td class="text-center font-weight-bold"><input class="form-control form-control-sm" type="text" id="Copy<?='_'.$Kode[$i]?>"></td>
                      </tr>
                    <?php } ?>
                    </table>
                  </div>
                </div>
                <div class="col-sm-12 mt-2 d-flex justify-content-center">
                  <button type="button" class="btn btn-primary" id="Copy"><b>Simpan Survei&nbsp;</b><div id="LoadingCopy" class="spinner-border spinner-border-sm text-white" role="status" style="display: none;"></div></button>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
		</div>

    <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
    <script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
    <script src="<?=base_url("build/js/custom.min.js")?>"></script>
    <script src="<?=base_url("assets/datatables/jquery.dataTables.js")?>"></script>
		<script src="<?=base_url("assets/datatables-bs4/js/dataTables.bootstrap4.js")?>"></script>
		<script>
			$(document).ready(function(){
        
        var BaseURL = '<?=base_url()?>'

        $('#TabelProdusen').DataTable( {
					"ordering": true,
					"bInfo" : false,
					"lengthMenu": [[5, 30, 50, -1], [5, 30, 50, "All"]],
					"language": {
						"paginate": {
							'previous': '<b class="text-white"><</b>',
							'next': '<b class="text-white">></b>'
						}
					}
				})

        var Kode = ['IA001001','IA001002','IA001003','IA001004','IA001005','IA001006','IA002001','IA002002','IA002003','IA002004','IA002005','IA002006','IA003001','IA003002',
                    'IA003003','IA003004','IA003005','IA003006','IA004001','IA004002','IA005001','IA005002','IB001001','IB001002','IB002001','IB002002','IB001003','IB003001','IB005001','IB005002',
                    'IB006001','IB006002','IB007001','IB007002','IB008001','IB008002','IB008003','IB009001','IB009002','IB010001','IB011001','IB012001','JA101001','JA101002','JA101003','JA101004',
                    'JA102001','JA102002','JA102003','JA102004','JA201001','JA201002','JA202001','JA203001','JA204001','JA205001','JA206001','JA207001','JA208001','JB001001','JB001002','JB001003',
                    'JB002001','JB002002','JB004001','JB005001','JB006001','JB007001','JB008001','JB011001','JB012001','JB012002','JB012003','JB013001','JB014001','JB015001','JB101001','JB101002',
                    'JB101003','JB102001','JB102002','JB102003','JB103001','JB103002','JB103003','JB104001','JB104002','JB104003','JB105001','JB105002','JB105003','JB106001','JB106002','JB106003',
                    'JB107001','JB107002','JC001001','JC001002','JC001003','JC002001','JC002002','JC002003','JC006001','JC007001','JC007002','JC008001','JC008002','JC009001','JC009002','JC010001',
                    'JC011001','JC013001','JC014001','JC015001','JC016001','JC017001','JD001001','JD001002','JD001003','JD002001','JD002002','JD002003','JD002004','JD003002','JD003003','JD003004',
                    'JD003005','JD004001','JD004002','JD005001','JD005002','JD005003','JD006001','JD006002','JD006003','JD007001','JD007002','JD008001','JD008002','JD010001','JD010002','JD011001',
                    'JD011002','JD012001','JD013001','JD014001','JD016001','JD016002','JD017001','JD017002','JD018001','JF001001','JF002001','JF002002','JF003001','JF003002','JF004001','JF005001',
                    'JF005002','JF006001','JF006002','JF007001','JF008001','JF009001','JF009002','JF010001','JF010002','JF011001','JF012001','JF013001','JF016001','JF017001','JF017002','JF018001',
                    'JF019001','JF019002','JF020001','JF023001','JF024001','JF025001','JF026001','JF027001','JF028001','JF029001','JF030001','JF031001','JF032001','JF033001','JF034001','JF035001',
                    'JG003001','JG004001','JG005001','JG005002','JG006001','JG007001','JG009001','JG009002','JG011001','JG011002','JG012001','JG012002','JG013001','JG013002','JG014001','JG015001',
                    'JG016001','JG017001','KA101101','KA101102','KA101103','KA201101','KA201102','KA201103','KA301101','KA301102','KA301103','KA401101','KA401102','KA401103','KA501101','KA501102',
                    'KA501103','KA601101','KA601102','KA601103','KA701101','KA701102','KA701103','KA801101','KA801102','KA801103','KA901101','KA901102','KA901103','KA911101','KA911102','KA911103',
                    'KA921101','KA921102','KA921103','KA941101','KA941102','KA941103','KA951101','KA951102','KA951103','KA961101','KA961102','KA961103','XA001001','XA002001','XA002002','XA002003',
                    'XA003001','XA004001','XA005001','XA006001','XA007001','XA007002','XA008001','XA009001','XA010001','XA010002','XA011001','XA012001','XA013001','XA014001','XA014002','XA015001',
                    'XA016001','XA016002','XA017001','XA019001','XA020001','XA022001','XA024001','XA025001','XA026001','XA027001','XA028001','XA029001','XA030001','XA031001','XA032001','XA033001',
                    'XA034001','XA035001','XA036001','XA037001','XA038001','XA039001','XB001001','XB001002','XB001003','XB002001','XB002002','XB003001','XB003002','XB004001','XB005001','XB005002',
                    'XB006001','XB006002','XB007001','XB007002','XB007003','XB008001','XB008002','XB008003','XB009001','XB009002','XB009003','XB009004','XB009005','XB010001','XB010002','XB010003',
                    'XB010004','XB010005','XB012001','XB013001','XB013002','XB014001','XB014002','XB014003','XB015001','XB016001','XB016002','XB016003','XB017001','XB018001','XB018002','XB019001',
                    'XB019002','XB019003','XB020001','XB020002','XB021001','XB021002','XB021003','XB022001','XB022002','XB023001','XB023002','XB023003','XB023004','XB024001','XB026001','XB027001',
                    'XB028001','XB029001','XB030001','XB031001','XB032001','XB033001','XB034001','XB035001','XD001001','XD002001','XD003001','XD004001','XD005001','XD007001','XD008001','XD009001',
                    'XD010001','XD011001','XD012001','YA101001','YA101002','YA101003','YA102001','YA102002','YA103001','YA104001','YA105001','YA106001','YA107001','YA108001','YA109001','YA110001',
                    'YA111001','YA112001','YA113001','YA114001','YA115001','YA116001','YA117001','YA118001','YA119001','YA121001','YA122001','YA161001','YA163001','YA164001','YA165001','YA166001',
                    'YA167001','YA201001','YA201002','YA202001','YA202002','YA203001','YA203002','YA203003','YA204001','YA204002','YA204003','YA204004','YA205001','YA206001','YA206002','YA207001',
                    'YA207002','YA207003','YA208001','YA208002','YA209001','YA211001','YA211002','YA212001','YA212002','YA262001','YA263001','YA264001','YA265001','YA266001','YA267001','YA268001',
                    'YA401001','YA402001','YA403001','YA405001','YA408001','YA409001','YA410001','YB001001','YB001002','YB001003','YB002001','YB002002','YB004001','YB005001','YB006001','YB007001',
                    'YB008001','YB011001','YB016001','YB601001','YB601002','YB601003','YB602001','YB603001','YB604001','YB605001','YB101001','YB101002','YB101003','YB102001','YB102002','YB103001',
                    'YB103002','YB104001','YB104002','YB105001','YB105002','YB106001','YB106002','YB107001','YB108001','YB109001','YC001001','YC001002','YC001003','YC002001','YC002002','YC002003',
                    'YC006001','YC006002','YC007001','YC007002','YC009001','YC009002','YC010001','YC011001','YC601001','YC602001','YD001001','YD001002','YD001003','YD002001','YD002003','YD002004',
                    'YD002002','YD003002','YD003003','YD003004','YD003005','YD004001','YD004002','YD005001','YD005002','YD006001','YD006002','YD007001','YD007002','YD008001','YD008002','YD011001',
                    'YD012001','YD012002','YD012003','YD013001','YD013002','YD013003','YD014001','YD014002','YD014003','YD015001','YD015002','YD017001','YD017002','YD017003','YD018001','YF001001',
                    'YF003001','YF004001','YF005001','YF006001','YF006002','YF007001','YF008001','YF009001','YF009002','YF011001','YF012001','YF016001','YF017001','YF017002','YF018001','YF019001',
                    'YF019002','YF020001','YF022001','YF023001','YF024001','YF025001','YF026001','YF027001','YF028001','YF031001','YF033001','YF601001','YF603001','YF605001','YF607001','YF607002',
                    'YF999001','YF100001','YG003001','YG004001','YG006001','YG007001','YG009001','YG009002','YG009003','YG012001','YG013001','YG015001','YG015002','YG016001','ZA101101','ZA101102',
                    'ZA101103','ZA201101','ZA201102','ZA201103','ZA301101','ZA301102','ZA301103','ZA401101','ZA401102','ZA401103','ZA501101','ZA501102','ZA501103','ZA601101','ZA601102','ZA601103',
                    'ZA701101','ZA701102','ZA701103','ZA801101','ZA801102','ZA801103','ZA901101','ZA901102','ZA901103','ZA921101','ZA921102','ZA921103','LA001001','LA001002','LA002001','LA002002',
                    'LA004001','LA004002','LA005001','LA006001','LA006002','LA006003','LA008001','LA011001','LA011002','LA012001','LA012002','LA013001','LA014001','LA017001','LA017002','LA019001',
                    'LA020001','LA021001','LA022001','LA023001','LA026001','LA027001','LA029001','LA031001','LA032001','LA033001','LA007001','LA009001','LA009002','LA018001','LA025001','LA028001',
                    'LA030001','MA001001','MA001002','MA001003','MA002001','MA002002','MA002003','MA003001','MA004001','MA005001','MA006001','MA007001','MA008001','MA009001','MA010001','MA011001',
                    'MA012001','MA015001','MA017001','MA018001','MA019001','MB001001','MB001002','MB001003','MB002001','MB002002','MB004001','MB005001','MB005002','MB006001','MB007001','MB007002',
                    'MB007003','MB008001','MB011001','MB013001','MB014001','MB015002','MB015001','MB015003','MB016001','MB017001','MB018001','MB101001','MB101002','MB101003','MB101004','MB102001',
                    'MB102002','MB102003','MB103001','MB103002','MB103003','MB104001','MB104002','MB105001','MB105002','MB106001','MB106002','MC001001','MC001002','MC001003','MC003001','MC004001',
                    'MC004002','MC005001','MC005002','MC007001','MC008001','MC009001','MC010001','MC011001','MD001001','MD001002','MD001003','MD001004','MD002001','MD002002','MD002003','MD002004',
                    'MD003002','MD003003','MD003004','MD003005','MD004001','MD004002','MD005001','MD005002','MD005003','MD006001','MD006002','MD007001','MD007002','MD008001','MD008002','MD009001',
                    'MD009002','MD011001','MD011002','MD012001','MD012002','MD013001','MD014001','MD014002','MD014003','MD015001','MD015002','MD015003','MD017001','MD019001','MD019002','MD019003',
                    'MD019004','MD020001','MD020002','MD021001','MD022001','ME001001','ME002001','ME002002','ME002003','ME003001','ME003002','ME004001','ME004002','ME005001','ME005002','ME006001',
                    'ME007001','ME008001','ME009001','ME009002','ME009003','ME010001','ME011001','ME011002','ME012001','ME012002','ME013001','ME014001','ME015001','ME017001','ME019001','ME020001',
                    'ME021001','ME022001','ME023001','ME024001','ME025001','ME026001','ME602001','ME602002','ME602003','ME604001','ME605001','ME606001','ME607001','ME608001','ME609001','ME610001',
                    'ME611001','ME612001','ME613001','MF002001','MF002002','MF003001','MF006001','MF009001','MF009002','MF009003','MF012001','MF012002','MF602001','MF603001','MF606001','MF607001',
                    'NA101101','NA102101','NA103101','NA201101','NA202101','NA203101','NA301101','NA301102','NA301103','NA401101','NA401102','NA401103','NA501101','NA501102','NA501103','NA601101',
                    'NA601102','NA601103','NA701101','NA701102','NA701103','NA801101','NA801102','NA801103','NA901101','NA901102','NA901103','NA911101','NA911102','NA911103','NA921101','NA921102',
                    'NA921103','NA931101','NA931102','NA931103','OA001001','OA001002','OA001003','OA002001','OA002002','OA002003','OA002004','OA002005','OA002006','OA003001','OA003002','OA004001',
                    'OA004002','OA005002','OB001001','OB001002','OB001003','OB001004','OB002001','OB002002','OB002003','OB002004','OB003001','OB003002','OB003003','OB003004','OB003005','OB004001',
                    'OB004002','OB005001','OB006001','OC002001','OC002002','OC002003','OC002004','OC003001','OC005001','OC005002','OC005003','OC006001','OC007001','OC008001','OC009001','OC010001',
                    'OC011001','OD001001','OD006001','OD007001','OD008001','OD009001','OD010001','OD011001','PA002001','PA002002','PA002003','PA003001','PA003002','PA005001','PA005002','PA006001',
                    'PA006002','PA007001','PA007002','PA601001','PA601002','PA602001','PA602002','PA615001','PA615002','PA615003','PA616001','PA616002','PA617001','PA617002','PA617003','PA618001',
                    'PA618002','PA619001','PA619002','PA620001','PA620002','PA621001','PA621002','PA622001','PA622002','PA623001','PA623002','PA624001','PA625001','PA626001','PA701001','PA701002',
                    'PA702001','PA702002','PA703001','PA703002','PA703003','PA704001','PA704002','PA705001','PA705002','PA706001','PA706002','PA707001','PB102001','PB102002','PB102003','PB102004',
                    'PB104001','PB105001','PB106001','PB107001','PB107002','PB107003','PB108001','PB109001','PB110001','PB113001','PB114001','PB116001','PB117001','PB122001','PB162001','PB164001',
                    'PB165001','PB165002','PB165003','PB166001','PB201001','PB201002','PB201003','PB201004','PB202001','PB202002','PB202003','PB202004','PB203001','PB203002','PB204001','PB204002',
                    'PB205001','PB205002','PB205003','PB206001','PB206002','PB208001','PB208002','PB209001','PB210001','PB210002','PB210003','PB210004','PB211001','PB212001','PB214001','PB215001',
                    'PB216001','PB217001','PB218001','PB219001','PB220001','PB221001','PB261001','PB262001','PB263001','PB264001','PB265001','PB266001','PB267001','PB268001','PB269001','PB270001',
                    'PC001001','PC002001','PC012001','PC601001','PC602001','PC603001','PD001001','PD001002','PD001003','PD001004','PD002001','PD002003','PD002004','PD002002','PD003002','PD003003',
                    'PD003004','PD003005','PD004001','PD004002','PD005001','PD005002','PD006001','PD006002','PD007001','PD007002','PD008001','PD009001','PD009002','PD014001','PD601001','PD601002',
                    'PD601003','PD602001','PE001001','PE001002','PE002001','PE002002','PE002003','PE003001','PE003002','PE003003','PE004001','PE004002','PE008001','PE008002','PE012001','PE012002',
                    'PE013001','PE013002','PE015001','PE016001','PE017001','PE018001','PE019001','PE020001','PE021001','PE023001','PE024001','PE025001','PE602001','PE602002','PE605001','PE606001',
                    'PE607001','PE608001','PE609001','PE610001','PE611001','PE612001','PE613001','PE614001','PE615001','PE616001','PE617001','PE618001','PE619001','PE620001','PF005001','PF006001',
                    'PF007001','PF008001','PF010001','PF010002','PF011001','PF012001','PF014001','PF015001','PF016001','PF016002','PF016003','PF017001','PF017002','PF018001','PF019001','PF019002',
                    'PF020001','PF020002','PF021001','PF022001','PF022002','PF023001','PF023002','PF024001','PF602001','PF602002','PF603001','PF604001','PF605001','PF606001','QA101101','QA101102',
                    'QA101103','QA301101','QA301102','QA301103','QA401101','QA401102','QA401103','QA501101','QA501102','QA501103','QA502101','QA502102','QA502103','RA001001','RA002001','RA003001',
                    'RA004001','RA006001','RA007001','RA007002','RA007003','RA007004','RA007005','RA007006','RA008001','RA009001','RA010001','RA011001','RA011002','RA011003','RA011004','RA011005',
                    'RA012001','RA014001','RA015001','RA019001','RA020001','RA021001','RA022001','RA023001','RA024001','RA501001','RA502001','RA503001','RA505001','RA507001','RA508001','RA509001',
                    'RA510001','RB001001','RB004001','RB005001','RB006001','RB008001','RB010001','RB011001','RB012001','RB013001','RB014001','RB016001','RB017001','RB020001','RB021001','RB023001',
                    'RB024001','RB028001','RB029001','RB030001','RB032001','RB035001','RB037001','RB039001','RB040001','RB042001','RB042002','RB042003','RB042004','RB042005','RB044001','RB046001',
                    'RB047001','RB048001','RB049001','RB050001','RB052001','RB053001','RB054001','RB055001','RB056001','RB057001','RB058001','RB059001','RB063001','RB065001','RB072001','RB072002',
                    'RB072003','RB072004','RB073001','RB076001','RB078001','RB080001','RB081001','RB082001','RB082002','RB083001','RB085001','RB086001','RB087001','RB092001','RB093001','RB094001',
                    'RB095001','RB096001','RB098001','RB099001','RB104001','RB106001','RB106002','RB106003','RB106004','RB106005','RB108001','RB109001','RB109002','RB109003','RB109004','RB109005',
                    'RB110001','RB111001','RB113001','RB114001','RB115001','RB115002','RB115003','RB117001','RB118001','RB127001','RB128001','RB131001','RB131002','RB501001','RB502001','SA001001',
                    'SA001002','SA001003','SA001004','SA002001','SA002002','SA002003','SA002004','SA003001','SA003002','SA003003','SA003004','SA003005','SA004001','SA004002','SA004003','SA004004',
                    'SA005001','SB001001','SB001002','SB001003','SB001004','SB001005','SB001006','SB002001','SB002003','SB002004','SB002002','SB003002','SB003003','SB003004','SB003005','SB004001',
                    'SB004002','SB004003','SB005001','SB005002','SB005003','SB006001','SB006002','SB006003','SB007002','SB007003','SB008001','SB009001','SC001001','SC001002','SC001003','SC001004',
                    'SC002001','SC002002','SC002003','SC002004','SC003001','SC003002','SC003003','SC003004','SC003005','SC003006','SC004001','SC004002','SC004003','SC005001','SC005002','SC005003',
                    'SC006001','SC007001','SC007002','SC007003','SC007004','SC008001','SC009001','SC009002','SC009003','SC009004','SC009005','SC010001','SC010002','SC010003','SC010004','SC011001',
                    'SC011002','SC011003','SC011004','SC011005','SC011006','SC013001','SC014001','SC015001','SC016001','SC017001','SC018001','SC019001','SC019002','SC020001','SC020002','SC021001',
                    'SC022001','SC022002','SC023001','SC024001','SC025001','SC026001','SC027001','SC028001','SC029001','SC030001','SC031001','SC032001','SC033001','SC033002','SC033003','SC033004',
                    'SC034001','SC034002','SC034003','SC034004','SC034005','SC037001','SC038001','SC039001','SC040001','SC601001','SC601002','SC601003','SC602001','SC603001','SC603002','SC604001',
                    'SC605001','SE001001','SE002001','SE003001','SE004001','SE004002','SE004003','SE004004','SE005001','SE006001','SE006002','SE007001','SE007002','SE007003','SE007004','SE007005',
                    'SE007006','SE008001','SE009001','SE010001','SE011001','SE015001','SE016001','SE016002','SE016003','SE017001','SE017002','SE018001','SE019001','SE020001','SE021001','SE602001',
                    'SE603001','SE603002','SE604001','SE605001','SF101101','SF102101','SF103101','SF201101','SF202101','SF203101','SF301101','SF302101','SF303101','SF501101','SF502101','SF503101',
                    'SF401101','SF402101','SF403101','TA002001','TA005001','TA006001','TA007001','TA009001','TA012001','TA012002','TA012003','TA012004','TA012005','TA012006','TA013001','TA014001',
                    'TA015001','TA017001','TA018001','TA019001','TA019002','TA019003','TA019004','TA019005','TA032001','TA033001','TB002001','TB002002','TB002003','TB003001','TB003002','TB003003',
                    'TB003004','TB003005','TB006001','TB006002','TB006003','TB006004','TB006005','TB006006','TB007001','TB011001','TB011002','TB013001','TB016002','TB016003','TB503001','TB504001',
                    'TB505001','TB506001','TB507001','TC001001','TC002001','TC003001','TC004001','TC005001','TC006001','TC007001','TC011001','TC011002','TC011003','TC011004','TC011005','TC012002',
                    'TC013001','UA002001','UA004001','UA005001','UA006001','UA007001','UA011001','UA011002','UA011003','UA011004','UA011005','UA012001','UA013001','UA014001','UA016001','UA018001',
                    'UA018002','UA018003','UA018004','UA020001','UA021001','UA022001','UA023001','UA101001','UA101002','UA101003','UA102001','UA102002','UA102003','UA102004','UA102005','UA104001',
                    'UA104002','UA104003','UA104004','UA104005','UA105001','UA106001','UA161001','UA162001','UA163001','UA164001','UA165001','UA166001','UA201001','UA201002','UA201003','UA202001',
                    'UA203001','UA204001','UA205001','UA206001','UA210001','UA210002','UA210003','UA210004','UA210005','UA211001','UA212001','UA213001','UB001001','UB001002','UB001003','UB002001',
                    'UB002002','UB003001','UB004001','UB004002','UB004003','UB004004','UB005001','UB006001','UB061001','UB062001','UB063001','UB064001','UB101001','UB102001','UB103001','UB104001',
                    'UB104002','UB105001','UB106001','UB107001','UB108001','UB109001','UB110001','UB111001','UB112001','UB113001','UB201001','UB201002','UB202001','UB202002','UB203001','UB204001',
                    'UB205001','UB207001','UB208001','UB209001','UB210001','UB211001','UB212001','UB213001','UB262001','UB263001','UB265001','UB266001','UB267001','UC001001','UC601001','UC602001',
                    'UC603001','UD001001','UD001002','UD001003','UD001004','UD001005','UD001006','UD002001','UD002003','UD002004','UD002002','UD003002','UD003003','UD003004','UD003005','UD004001',
                    'UD004002','UD004003','UD005001','UD005002','UD005003','UD006001','UD006002','UE001001','UE001002','UE001003','UE001004','UE002001','UE002002','UE002003','UE002004','UE003001',
                    'UE003002','UE003003','UE003004','UE003005','UE003006','UE004001','UE004002','UE004003','UE004004','UE005001','UE007001','UE007002','UE007003','UE007004','UE008001','UE008002',
                    'UE008003','UE008004','UE008005','UE008006','UE010001','UE010002','UE010003','UE011001','UE012001','UE014001','UE015001','UE016001','UE017001','UE018001','UE019001','UE019002',
                    'UE020001','UE020002','UE021001','UE022001','UE022002','UE023001','UE024001','UE025001','UE026001','UE027001','UE028001','UE029001','UE030001','UE031001','UE032001','UE033001',
                    'UE601001','UE602001','UE603001','UE605001','UE606001','UE607002','UE608003','UE609001','UE610001','UE611001','UE612001','UE613001','UG002001','UG003001','UG004001','UG005001',
                    'UG005002','UG006001','UG006002','UG006003','UG007001','UG007002','UG007003','UG008001','UG604001','UG604002','UG605001','UG606001','UH201101','UH201102','UH201103','UH301101',
                    'UH301102','UH301103','UH401101','UH401102','UH401103','UH501101','UH501102','UH501103','UH601101','UH601102','UH601103','UH701101','UH701102','UH701103','UH011101','UH011102',
                    'UH011103']  
        $(document).on("click",".Copy",function(){
					var Data = $(this).attr('Copy')
					var Pisah = Data.split("$")
					// $("#Id").val(Pisah[0])
					$("#CopyKecamatan").val(Pisah[1])
          var SplitDate = Pisah[2].split("-");
          var Bulan = parseInt(SplitDate[1])+1
          if (Bulan > 12) {
            $("#CopyTanggalSurvei").val((parseInt(SplitDate[0])+1)+'-01-'+SplitDate[2]) 
          } else {
            if (Bulan < 10) {
              $("#CopyTanggalSurvei").val(SplitDate[0]+'-0'+Bulan+'-'+SplitDate[2]) 
            } else {
              $("#CopyTanggalSurvei").val(SplitDate[0]+'-'+Bulan+'-'+SplitDate[2])
            }
          }
					$("#CopyNamaResponden").val(Pisah[3])
					$("#CopyAlamat").val(Pisah[4])
          var CopyKode = Pisah[5].split('|')
          var CopyHarga = Pisah[6].split('|')
          // var Copy_Harga = Pisah[7].split('|')
          for (let i = 0; i < CopyKode.length; i++) {
            $("#Copy_"+CopyKode[i]).val(CopyHarga[i])
            // $("#Copy_"+CopyKode[i]).val(Copy_Harga[i])
          }
					$('#ModalCopy').modal("show")
				})

        $("#Copy").click(function() {
					var KodeKualitas = []
          var Harga = []
          var _Harga = []
          for (let i = 0; i < Kode.length; i++) {
            if ($("#Copy_"+Kode[i]).val() > 0 && $("#Copy"+Kode[i]).val() == "") {
              alert('Input Kode Kualitas '+Kode[i]+' Belum Benar!')
              return
            } else if ($("#Copy"+Kode[i]).val() > 0) {
              KodeKualitas.push(Kode[i])
              Harga.push($("#Copy"+Kode[i]).val())
              _Harga.push($("#Copy_"+Kode[i]).val())
            } 
          }
          var NTP = { Kecamatan: $("#CopyKecamatan").val(),
                      TanggalSurvei: $("#CopyTanggalSurvei").val(),
                      NamaResponden: $("#CopyNamaResponden").val(),
                      Alamat: $("#CopyAlamat").val(),
                      KodeKualitas: KodeKualitas.join('|'),
                      Harga: Harga.join('|'),
                      _Harga: _Harga.join('|') }
          $("#Copy").attr("disabled", true);                              
          $("#LoadingCopy").show();
          $.post(BaseURL+"Surveyor/CopyNTPProdusen", NTP).done(function(Respon) {
            if (Respon == '1') {
              alert('Data Survei Berhasil Di Simpan!')
              window.location = BaseURL + "Surveyor/SurveiHargaProdusenPerdesaan"
            } else {
              alert(Respon)
              $("#LoadingCopy").hide();
              $("#Copy").attr("disabled", false);    
            }
          })
				})

        $(document).on("click",".Edit",function(){
					var Data = $(this).attr('Edit')
					var Pisah = Data.split("$");
					$("#Id").val(Pisah[0])
					$("#EditKecamatan").val(Pisah[1])
					$("#EditTanggalSurvei").val(Pisah[2])
					$("#EditNamaResponden").val(Pisah[3])
					$("#EditAlamat").val(Pisah[4])
          var EditKode = Pisah[5].split('|')
          var EditHarga = Pisah[6].split('|')
          var Edit_Harga = Pisah[7].split('|')
          for (let i = 0; i < EditKode.length; i++) {
            $("#Edit"+EditKode[i]).val(EditHarga[i])
            $("#Edit_"+EditKode[i]).val(Edit_Harga[i])
          }
					$('#ModalEdit').modal("show")
				})

        $("#Edit").click(function() {
					if ($("#EditTanggalSurvei").val() == "") {
            alert('Mohon Input Tanggal Survei!')
          } else if ($("#EditNamaResponden").val() == "") {
            alert('Mohon Input Nama Responden!')
          } else if ($("#EditAlamat").val() == "") {
            alert('Mohon Input Alamat Responden!')
          } else {
						var KodeKualitas = []
            var Harga = []
            var _Harga = []
            for (let i = 0; i < Kode.length; i++) {
              if ($("#Edit"+Kode[i]).val() > 0) {
                KodeKualitas.push(Kode[i])
                Harga.push($("#Edit"+Kode[i]).val())
                _Harga.push($("#Edit_"+Kode[i]).val())
              }
            }
            var NTP = { Id: $("#Id").val(),
                        Kecamatan: $("#EditKecamatan").val(),
                        TanggalSurvei: $("#EditTanggalSurvei").val(),
                        NamaResponden: $("#EditNamaResponden").val(),
                        Alamat: $("#EditAlamat").val(),
                        KodeKualitas: KodeKualitas.join('|'),
                        Harga: Harga.join('|'),
                        _Harga: _Harga.join('|') }
            $("#Edit").attr("disabled", true);                              
            $("#LoadingEdit").show();
						$.post(BaseURL+"Surveyor/EditNTPProdusen", NTP).done(function(Respon) {
							if (Respon == '1') {
                alert('Data Survei Berhasil Di Update!')
								window.location = BaseURL + "Surveyor/SurveiHargaProdusenPerdesaan"
							} else {
								alert(Respon)
                $("#LoadingEdit").hide();
                $("#Edit").attr("disabled", false);    
							}
						})
					}
				})
  
        $("#Simpan").click(function() {
          if ($("#TanggalSurvei").val() == "") {
            alert('Mohon Input Tanggal Survei!')
          } else if ($("#NamaResponden").val() == "") {
            alert('Mohon Input Nama Responden!')
          } else if ($("#Alamat").val() == "") {
            alert('Mohon Input Alamat Responden!')
          } else {
            var KodeKualitas = []
            var Harga = []
            var _Harga = []
            for (let i = 0; i < Kode.length; i++) {
              if ($("#"+Kode[i]).val() > 0) {
                KodeKualitas.push(Kode[i])
                Harga.push($("#"+Kode[i]).val())
                _Harga.push($("#_"+Kode[i]).val())
              }
            }
            var NTP = { Kecamatan: $("#Kecamatan").val(),
                        TanggalSurvei: $("#TanggalSurvei").val(),
                        NamaResponden: $("#NamaResponden").val(),
                        Alamat: $("#Alamat").val(),
                        KodeKualitas: KodeKualitas.join('|'),
                        Harga: Harga.join('|'),
                        _Harga: _Harga.join('|'), }
            $("#Simpan").attr("disabled", true);                              
            $("#LoadingInput").show();
            $.post(BaseURL+"Surveyor/InputNTPProdusen", NTP).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/SurveiHargaProdusenPerdesaan"
              } else { 
                alert(Respon)
                $("#LoadingInput").hide();
                $("#Simpan").attr("disabled", false);                              
              }
            })         
          }
        })
      })
		</script>
  </body>
</html>