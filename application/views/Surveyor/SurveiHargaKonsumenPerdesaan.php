				<!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="card"> 
                    <div class="card-header bg-primary text-white">
                      <b>SURVEI HARGA KONSUMEN PERDESAAN</b>
                    </div>
                    <div style="background-color: yellow;" class="card-body border border-primary pl-0 pr-2 py-2">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-primary border-white" data-toggle="modal" data-target="#ModalInput"><i class="fa fa-plus"></i><b> Input Data Survei</b></button>
                            <div class="table-responsive">
                              <table id="TabelKonsumen" class="table table-sm table-bordered bg-light">
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
                                        <button Edit="<?=$key['Id'].'$'.$key['Kecamatan'].'$'.$key['TanggalSurvei'].'$'.$key['NamaResponden'].'$'.$key['Alamat'].'$'.$key['NamaPasar'].'$'.$key['HariPasar'].'$'.$key['KodeKualitas'].'$'.$key['Harga'].'$'.$key['_Harga']?>" class="btn btn-sm btn-warning Edit"><i class="fa fa-edit"></i></button>
                                        <button Copy="<?=$key['Id'].'$'.$key['Kecamatan'].'$'.$key['TanggalSurvei'].'$'.$key['NamaResponden'].'$'.$key['Alamat'].'$'.$key['NamaPasar'].'$'.$key['HariPasar'].'$'.$key['KodeKualitas'].'$'.$key['Harga'].'$'.$key['_Harga']?>?>" class="btn btn-sm btn-primary Copy"><i class="fa fa-copy"></i></button>
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
                <div class="col-sm-4">
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
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Tanggal Survei</b></label>
                    </div>
                    <input class="form-control" type="date" id="TanggalSurvei">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Nama</b></label>
                    </div>
                    <input class="form-control" type="text" id="NamaResponden" placeholder="Nama Responden">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Alamat</b></label>
                    </div>
                    <input class="form-control" type="text" id="Alamat">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Nama Pasar</b></label>
                    </div>
                    <select class="custom-select" id="NamaPasar">                    
                      <option value="1">Pasar Mantup</option>
                      <option value="2">Pasar Laren</option>
                      <option value="3">Pasar Pucuk</option>
                    </select>
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Hari Pasar</b></label>
                    </div>
                    <input class="form-control" type="text" id="HariPasar">
                  </div>
                </div> 
                <?php $Kode = array('AA001001','AA001002','AA001003','AA001004','AA001005','AA001006','AA003001','AA003002','AA004001','AA004002','AA006001','AA007001','AA008001','AA008002',
                'AA008003','AA011001','AA012001','AA013001','AA013002','AA013003','AA014001','AA014002','AA014003','AA014004','AA014005','AA015001','AA015002','AA015003','AA016001','AA017001',
                'AA018001','AA019001','AA019002','AA020001','AA021001','AA021002','AA022001','AA702001','AA702002','AA703001','AA703002','AB001001','AB001002','AB001003','AB001004','AB002001',
                'AB003001','AB005001','AB005002','AB007001','AB007002','AB007003','AB011001','AB012001','AB013001','AB013002','AB014001','AB014002','AB016001','AB017001','AB017002','AB017003',
                'AB017004','AB018001','AB019001','AB020001','AB020002','AB021001','AB021002','AB022001','AB022002','AB023001','AB701001','AB701002','AB701003','AB705001','AB706001','AC001001',
                'AC002001','AC003001','AC004001','AC005001','AC006001','AC007001','AC008001','AC009001','AC010001','AC011001','AC013001','AC013002','AC014001','AC015001','AC016001','AC017001',
                'AC018001','AC021001','AC022001','AC023001','AC024001','AC025001','AC026001','AC027001','AC028001','AC032001','AC033001','AC034001','AC035001','AC036001','AC037001','AC038001',
                'AC701001','AC702001','AC703001','AC704001','AC705001','AC708001','AC709001','AC712001','AC714001','AC714002','AC715001','AC718001','AC733001','AC734001','AC735001','AC736001',
                'AD001001','AD002001','AD003001','AD004001','AD005001','AD006001','AD007001','AD008001','AD009001','AD010001','AD014001','AD015001','AD016001','AD017001','AD019001','AD020001',
                'AD701001','AD704001','AD705001','AD706001','AE004001','AE004002','AE010001','AE010002','AE011001','AE012001','AE013001','AE013002','AE014001','AE015001','AE015002','AE015003',
                'AE016001','AE017001','AE018001','AE019001','AE020001','AE021001','AE024001','AE026001','AE027001','AE028001','AE029001','AE030001','AE031001','AE032001','AE033001','AE033002',
                'AE703001','AE706001','AE706002','AE710001','AE716001','AE717001','AE718001','AF006001','AF006002','AF006003','AF006004','AF007001','AF007002','AF007003','AF007004','AF008001',
                'AF008002','AF008003','AF009001','AF009002','AF009003','AF011001','AF011002','AF012001','AF012002','AF012003','AF013001','AF014001','AF703001','AF703002','AF704001','AF704002',
                'AF704003','AF705001','AG001001','AG002001','AG002002','AG002003','AG002004','AG002005','AG003001','AG003002','AG003003','AG003004','AG004001','AG004002','AG005001','AG006001',
                'AG007001','AG007002','AG008001','AH001001','AH002001','AH003001','AH003002','AH004001','AH005001','AH005002','AH008001','AH010001','AH011001','AH012001','AH013001','AH014001',
                'AH014002','AH015001','AH016001','AH017001','AH018001','AH019001','AH019002','AH020001','AH021001','AH022001','AH024001','AH025001','AH025002','AH026001','AH030001','AH031001',
                'AH032001','AH033001','AH034001','AH701001','AH702001','AH702002','AH702003','AH702004','AH703001','AH704001','AH705001','AH707001','AH708001','AH709001','AH701001','AI001001',
                'AI001002','AI001003','AI001004','AI001005','AI002001','AI002002','AI002003','AI003001','AI003002','AI003003','AI003004','AI003005','AI004001','AI004002','AI004003','AI004004',
                'AI005001','AI005002','AI006001','AI007001','AI007002','AI007003','AI007004','AI008001','AI009001','AI009002','AI010001','AI010002','AI011001','AI013001','AI013002','AI013002',
                'AI014001','AI014002','AI015002','AI015003','AI015004','AI016001','AI016002','AI017001','AI017002','AI018001','AI018002','AI019001','AI020001','AI021001','AI702001','AI703001',
                'AI704001','AJ001001','AJ001002','AJ002001','AJ003001','AJ003002','AJ005001','AJ006001','AJ007001','AJ007002','AJ007003','AJ008001','AJ009001','AJ010001','AJ011001','AK001001',
                'AK001002','AK002001','AK002002','AK003001','AK008001','AK008002','AK008003','AK008004','AK011001','AK012001','AK012002','AK013001','AK013002','AK014001','AK015001','AK016001',
                'AK016002','AK017001','AK018001','AK019001','AK020001','AK021001','AK021002','AK022001','AK023001','AK023002','AK023003','AK023004','AK024001','AK024002','AK024003','AK025001',
                'AK025002','AK025003','AK026001','AK027001','AK701001','AK703001','AK703002','AK704003','AK704001','AK704002','AK706001','AK707001','AK708001','AK709001','AL001001','AL001002',
                'AL001003','AL001004','AL002001','AL002002','AL003001','AL003002','AP001001','AP002001','AP002002','AP003001','AP003002','AP003003','AP004001','AP005001','AP005002','AP005003',
                'AP006001','AP006002','AP006003','AP010001','AP011001','AP012001','AP013001','AP019001','AP020001','AP020002','AP021001','AP021002','AP021003','AP022001','AP022002','AP022003',
                'AP023001','AP023002','AP023003','AP024001','AP024002','AP024003','AP025001','AP025002','AP025003','AP025004','AP026001','AP026002','AP026003','AP026004','AP705001','AP706001',
                'AP706002','AP706003','AP706004','AP707001','AP708001','AP708002','AP708003','AP709001','AP709002','AP709003','AP709004','AP710001','AP710002','AP711001','AP713001','AP714001',
                'AP714002','AP714003','AP714004','AQ001001','AQ001002','AQ001003','AQ008001','AQ009001','AQ009002','AQ009003','AQ009004','AQ009005','AQ009006','AQ009007','AQ011002','AQ011005',
                'AQ011006','AQ011007','AQ012001','AQ012002','AQ012003','AQ013001','AQ013002','AQ016001','AQ017001','AQ017002','AQ017003','AQ705001','AQ706001','AQ707001','AQ707002','AQ707003',
                'AQ709001','AQ709002','AQ709003','AQ709004','AQ710001','AQ710002','AQ710003','AQ710004','AQ711001','AQ711002','AQ711003','AR001001','AR001002','AR001003','AR001004','AR001005',
                'AR002001','AR002002','AR002003','AR002004','AR002005','AR003001','AR003002','AR003003','AR003004','AR004001','AR004002','AR004003','AR013001','AR013002','AR013003','AR014001',
                'AR014002','AR014003','AR015001','AR015002','BA001001','BA001002','BA001003','BA001004','BA002001','BA002002','BA002003','BA002004','BA003001','BA003002','BA003003','BA004001',
                'BA004002','BA004003','BA004004','BA005001','BA005002','BA005003','BA005004','BA006001','BA006002','BA006003','BA006004','BA007001','BA007002','BA007003','BA007004','BA009001',
                'BA009002','BA010001','BA010002','BA010003','BA010004','BA011001','BA013001','BA013002','BA013003','BA014001','BA014002','BA014003','BA014004','BA014005','BA014006','BA014007',
                'BA015001','BA015002','BA015003','BA016001','BA016002','BA016003','BA016004','BA017001','BA017002','BA017003','BA017004','BA018001','BA018002','BA018003','BA019001','BA019002',
                'BA020001','BA020002','BA021001','BA021002','BA021003','BA021004','BA022001','BA022002','BA022003','BA022004','BA023001','BA023002','BA024001','BA024002','BA024003','BA024004',
                'BA026001','BA026002','BA030001','BA030002','BA031001','BA031002','BA032001','BA032002','BA034001','BA034002','BA034003','BA034004','BA701001','BA701002','BA701003','BA702001',
                'BA702002','BA702003','BA703001','BA703002','BA703003','BA703004','BA704001','BA705001','BA705002','BA705003','BA705004','BA705005','BA706001','BA706002','BA706003','BA708001',
                'BA709001','BA709002','BA709003','BA711001','BA712001','BD006001','BD006002','BC719001','BC719002','CD003001','CD003002','CD003003','CD003004','CD003005','CD003006','DA001001',
                'DA001002','DA001003','DA001004','DA001005','DA002001','DA002002','DA002003','DA002004','DA002005','DA003001','DA003002','DA004001','DA004002','DA005001','DA005002','DA005003',
                'DA006001','DA006002','DA007001','DA007002','DA008001','DA008002','DA009001','DC503001','DC504001','EA001001','EA001002','EA001003','EA002001','EA002002','EA003001','EA003002',
                'EA003003','EA003004','EA004001','EA004002','EA004003','EA004004','EA004005','EA004006','EA007001','EA007002','EA008001','EA008002','EA008003','EA009001','EA009002','EA009003',
                'EA010001','EA010002','EC501001','EC501002','EC501003','EC501004','FA001001','FA001002','FA003001','FA003002','FA003003','FA003004','FA004001','FA004002','FA004003','FA006001',
                'FA006002','FA007001','FA007002','FA007003','FA008001','FA008002','FA009001','FA009002','FA009003','FA009004','FA010001','FA010002','FA010003','FA010004','FA012001','FA012002',
                'FA014001','FA701001','FA701002','FA701003','FA702001','FB001001','FB001002','FB001003','FB001004','FB001005','FB004003','FB004004','FB004005','FB004006','FB004007','FB006001',
                'FB006002','FB007001','FB007002','FB008001','FB008002','FB008003','FC002001','FC002002','FC002003','FC003001','FC003002','FC003003','FC004001','FC004002','FC004003','FC004004',
                'FC005001','FC005002','FC005003','FC007001','FC007002','FC008001','FC008002','FC009001','FC009002','FC009003','FC010001','FC011001','FC013001','FC013002','FC013003','FC014001',
                'FC015001','FC016001','FC701001','FC701002','FC701003','FC702001','FC702002','FD001001','FD001002','FD002001','FD002002','FD003001','FD003002','BB001001','BB002001','BB002002',
                'BB002003','BB002004','BB003001','BB003002','BB004001','BB004002','BB005001','BB005002','BB005003','BB005004','BB005005','BB006001','BB006002','BB006003','BB007001','BB007002',
                'BB007003','BB008001','BB008002','BB008003','BB009001','BB009002','BB009003','BB010001','BB010002','BB010003','BB011001','BB011002','BB011003','BB012001','BB012002','BB013001',
                'BB013002','BB013003','BB016001','BB016002','BB016003','BB017001','BB701001','BB701002','BB701003','BB702001','BB702002','BB702003','BB703001','BB703002','BB704001','BB704002',
                'BC001001','BC001002','BC001003','BC002001','BC002002','BC002003','BC003001','BC003002','BC003004','BC003005','BC003006','BC004001','BC004002','BC008001','BC008002','BC008003',
                'BC009001','BC009002','BC009003','BC010001','BC010002','BC010003','BC011001','BC011002','BC011003','BC012001','BC012002','BC012003','BC013001','BC013002','BC013003','BC015001',
                'BC015002','BC015003','BC016001','BC016002','BC016003','BC019001','BC019002','BC019003','BC020001','BC020002','BC020003','BC021001','BC021002','BC021003','BC022001','BC022002',
                'BC022003','BC024001','BC024002','BC024003','BC024004','BC025001','BC025002','BC025003','BC025004','BC027001','BC027002','BC027003','BC029001','BC029002','BC029003','BC030001',
                'BC030002','BC030003','BC034001','BC034002','BC034003','BC035001','BC035002','BC035003','BC035004','BC036001','BC036002','BC036003','BC040001','BC040002','BC040003','BC042001',
                'BC042002','BC042003','BC044001','BC044002','BC045001','BC045002','BC046001','BC046002','BC047001','BC049001','BC049002','BC051001','BC051002','BC052001','BC052002','BC053001',
                'BC053002','BC053003','BC701001','BC701002','BC701003','BC702002','BC702003','BC702004','BC703001','BC703002','BC703003','BC705001','BC705002','BC707001','BC707002','BC707003',
                'BC708001','BC708002','BC708003','BC708004','BC710001','BC710002','BC712001','BC712002','BC712003','BC713001','BC713002','BC715001','BC715002','BC715003','BC716001','BD001001',
                'BD001002','BD001003','BD001004','BD001005','BD002001','BD002002','BD002003','BD003001','BD003002','BD003003','BD004001','BD004002','BD004003','BD004004','BD005001','BD005002',
                'BD005003','BD007001','BD007002','BD007003','BD007004','BD007005','BD007006','BD009001','BD009002','BD009003','BD010001','BD010002','BD010003','BD010004','BD011001','BD011002',
                'BD011003','BD012001','BD012002','BD013001','BD013002','BD701001','BD701002','BD701003','BD701004','CA001001','CA001002','CA001003','CA001004','CA002001','CA002002','CA002003',
                'CA002004','CA003001','CA003002','CA003003','CA003004','CA006001','CA006002','CA006003','CA006004','CA013001','CA013002','CA013003','CA013004','CA015001','CA015002','CA015003',
                'CA015004','CA016001','CA016002','CA016003','CA016004','CA017001','CA017002','CA017003','CA017004','CA018001','CA018002','CA018003','CA018004','CA019001','CA019002','CA019003',
                'CA019004','CA021001','CA021002','CA021003','CA021004','CA022001','CA022002','CA022003','CA023001','CA024001','CA024002','CA025001','CA027001','CA027002','CA027003','CA028001',
                'CA701001','CA701002','CA701003','CA702001','CA703001','CA703002','CA703003','CA703004','CA703005','CA704001','CA704002','CA706001','CB003001','CB003002','CB003003','CB003004',
                'CB004001','CB004002','CB004003','CB004004','CB006001','CB006002','CB006003','CB006004','CB007001','CB007002','CB007003','CB007004','CB008001','CB008002','CB008003','CB008004',
                'CB009001','CB009002','CB009003','CB010001','CB010002','CB010003','CB011001','CB012001','CB012002','CB012003','CB013001','CB013002','CB013003','CB014001','CB014002','CB014003',
                'CB015001','CB016001','CB017001','CB017002','CB018001','CB019001','CB020001','CB021001','CB023001','CB024001','CB025001','CB025002','CB027001','CB027002','CB027003','CC001001',
                'CC001002','CC001003','CC001004','CC002001','CC002002','CC002003','CC002004','CC003001','CC003002','CC003003','CC004001','CC004002','CC004003','CC004004','CC007001','CC007002',
                'CC007003','CC007004','CC008001','CC008002','CC008003','CC008004','CC009001','CC009002','CC009003','CC010001','CC010002','CC010003','CC011001','CC012001','CC013001','CC014001',
                'CC015001','CC016001','CC016002','CC017001','CC017002','CC017003','CC017004','CC018001','CC018002','CC018003','CC019001','CC019002','CC019003','CC019004','CD001001','CD001002',
                'CD001003','CD001004','CD002001','CD002002','CD002003','CD003001','CD003002','CD004001','CD004002','CD004003','CD004004','CD018001','CD018002','CD018003','CD018004','CD020001',
                'CD020002','CD020003','CD020004','CD022001','CD022002','CD023001','CD023002','CD023003','CD025001','CD025002','CD026001','CD026002','CD026003','CD028001','CD029001','CD029002',
                'DB001001','DB001002','DB001003','DB001004','DB001005','DB002001','DB002002','DB002003','DB002004','DB002005','DB003001','DB003002','DB003003','DB003004','DB003005','DB004001',
                'DB004002','DB004003','DB004004','DB004005','DB005001','DB005002','DB005003','DB005004','DB005005','DB006001','DB006002','DB006003','DB007001','DB007002','DB007003','DB008001',
                'DB008002','DB008003','DB008004','DB009001','DB009002','DB010001','DB010002','DB011001','DB011002','DB011003','DB011004','DB012001','DB012002','DB012003','DB013001','DB013002',
                'DB013003','DB701001','DB701002','DB701003','DB702001','DB702002','DB702003','DB703001','DB703002','DB703003','DC001001','DC001002','DC001003','DC002001','DC002002','DC002003',
                'DC002004','DC002005','DC003001','DC003002','DC003003','DC004001','DC004002','DC004003','DC004004','DC008001','DC008002','DC008003','DC009001','DC009002','DC009003','DC010001',
                'DC010002','DC010003','DC011001','DC011002','DC011003','DC011004','DC012001','DC012002','DC012003','DC013001','DC013002','DC701001','DC701002','DC701003','DC702001','DC702002',
                'DC702003','DC703001','DC703002','DC703003','DC703004','DC704001','DC704002','DC704003','DC705001','DC705002','DC705003','DC706001','DC706002','DC706003','DC707001','DC707002',
                'EB001001','EB001002','EB001003','EB002001','EB002002','EB002003','EB002004','EB003001','EB003002','EB003003','EB003004','EB004001','EB004002','EB004003','EB004004','EB005001',
                'EB005002','EB005003','EB005004','EB006001','EB006002','EB006003','EB006004','EB006005','EB007001','EB007002','EB007003','EB008001','EB008002','EB008003','EB008004','EB008005',
                'EB009001','EB009002','EB009003','EB009004','EB010001','EB010002','EB010003','EB011001','EB011002','EB012001','EB012002','EB012003','EB013001','EB013002','EB701001','EB701002',
                'EB701003','EB701004','CD702001','CD704001','CD704002','CD705001','EC003001','EC003002','EC005001','EC005002','EC005003','EC005004','EC008001','EC008002','EC010001','EC010002',
                'EC010003','EC012001','EC012002','EC012003','EC013001','EC013002','EC013003','EC014001','EC014002','EC015001','EC015002','EC016001','EC016002','EC017001','EC017002','EC701001',
                'EC701002','EC701003','EC702001','EC702002','EC703001','EC704001','EC704002','EC705001','ED001001','ED001002','ED001003','ED002001','ED002002','ED002003','ED003001','ED003002',
                'ED003003','ED004001','ED004002','ED004003','ED004004','ED005001','ED005002','ED005003','ED006001','ED006002','ED007001','ED007002');?>
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
                    <?php for ($i=0; $i < 709; $i++) { ?>
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
                    <?php for ($i=709; $i < 1417; $i++) { ?>
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
                <div class="col-sm-4">
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
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Tanggal Survei</b></label>
                    </div>
                    <input class="form-control" type="date" id="EditTanggalSurvei">
                    <input class="form-control" type="hidden" id="Id">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Nama</b></label>
                    </div>
                    <input class="form-control" type="text" id="EditNamaResponden" placeholder="Nama Responden">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Alamat</b></label>
                    </div>
                    <input class="form-control" type="text" id="EditAlamat">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Nama Pasar</b></label>
                    </div>
                    <select class="custom-select" id="EditNamaPasar">                    
                      <option value="1">Pasar Mantup</option>
                      <option value="2">Pasar Laren</option>
                      <option value="3">Pasar Pucuk</option>
                    </select>
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Hari Pasar</b></label>
                    </div>
                    <input class="form-control" type="text" id="EditHariPasar">
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
                    <?php for ($i=0; $i < 709; $i++) { ?>
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
                    <?php for ($i=709; $i < 1417; $i++) { ?>
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
                <div class="col-sm-4">
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
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Tanggal Survei</b></label>
                    </div>
                    <input class="form-control" type="date" id="CopyTanggalSurvei">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Nama</b></label>
                    </div>
                    <input class="form-control" type="text" id="CopyNamaResponden" placeholder="Nama Responden">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Alamat</b></label>
                    </div>
                    <input class="form-control" type="text" id="CopyAlamat">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Nama Pasar</b></label>
                    </div>
                    <select class="custom-select" id="CopyNamaPasar">                    
                      <option value="1">Pasar Mantup</option>
                      <option value="2">Pasar Laren</option>
                      <option value="3">Pasar Pucuk</option>
                    </select>
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-white"><b>Hari Pasar</b></label>
                    </div>
                    <input class="form-control" type="text" id="CopyHariPasar">
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
                    <?php for ($i=0; $i < 709; $i++) { ?>
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
                    <?php for ($i=709; $i < 1417; $i++) { ?>
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
        
        $('#TabelKonsumen').DataTable( {
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

        var Kode = ['AA001001','AA001002','AA001003','AA001004','AA001005','AA001006','AA003001','AA003002','AA004001','AA004002','AA006001','AA007001','AA008001','AA008002',
                    'AA008003','AA011001','AA012001','AA013001','AA013002','AA013003','AA014001','AA014002','AA014003','AA014004','AA014005','AA015001','AA015002','AA015003','AA016001','AA017001',
                    'AA018001','AA019001','AA019002','AA020001','AA021001','AA021002','AA022001','AA702001','AA702002','AA703001','AA703002','AB001001','AB001002','AB001003','AB001004','AB002001',
                    'AB003001','AB005001','AB005002','AB007001','AB007002','AB007003','AB011001','AB012001','AB013001','AB013002','AB014001','AB014002','AB016001','AB017001','AB017002','AB017003',
                    'AB017004','AB018001','AB019001','AB020001','AB020002','AB021001','AB021002','AB022001','AB022002','AB023001','AB701001','AB701002','AB701003','AB705001','AB706001','AC001001',
                    'AC002001','AC003001','AC004001','AC005001','AC006001','AC007001','AC008001','AC009001','AC010001','AC011001','AC013001','AC013002','AC014001','AC015001','AC016001','AC017001',
                    'AC018001','AC021001','AC022001','AC023001','AC024001','AC025001','AC026001','AC027001','AC028001','AC032001','AC033001','AC034001','AC035001','AC036001','AC037001','AC038001',
                    'AC701001','AC702001','AC703001','AC704001','AC705001','AC708001','AC709001','AC712001','AC714001','AC714002','AC715001','AC718001','AC733001','AC734001','AC735001','AC736001',
                    'AD001001','AD002001','AD003001','AD004001','AD005001','AD006001','AD007001','AD008001','AD009001','AD010001','AD014001','AD015001','AD016001','AD017001','AD019001','AD020001',
                    'AD701001','AD704001','AD705001','AD706001','AE004001','AE004002','AE010001','AE010002','AE011001','AE012001','AE013001','AE013002','AE014001','AE015001','AE015002','AE015003',
                    'AE016001','AE017001','AE018001','AE019001','AE020001','AE021001','AE024001','AE026001','AE027001','AE028001','AE029001','AE030001','AE031001','AE032001','AE033001','AE033002',
                    'AE703001','AE706001','AE706002','AE710001','AE716001','AE717001','AE718001','AF006001','AF006002','AF006003','AF006004','AF007001','AF007002','AF007003','AF007004','AF008001',
                    'AF008002','AF008003','AF009001','AF009002','AF009003','AF011001','AF011002','AF012001','AF012002','AF012003','AF013001','AF014001','AF703001','AF703002','AF704001','AF704002',
                    'AF704003','AF705001','AG001001','AG002001','AG002002','AG002003','AG002004','AG002005','AG003001','AG003002','AG003003','AG003004','AG004001','AG004002','AG005001','AG006001',
                    'AG007001','AG007002','AG008001','AH001001','AH002001','AH003001','AH003002','AH004001','AH005001','AH005002','AH008001','AH010001','AH011001','AH012001','AH013001','AH014001',
                    'AH014002','AH015001','AH016001','AH017001','AH018001','AH019001','AH019002','AH020001','AH021001','AH022001','AH024001','AH025001','AH025002','AH026001','AH030001','AH031001',
                    'AH032001','AH033001','AH034001','AH701001','AH702001','AH702002','AH702003','AH702004','AH703001','AH704001','AH705001','AH707001','AH708001','AH709001','AH701001','AI001001',
                    'AI001002','AI001003','AI001004','AI001005','AI002001','AI002002','AI002003','AI003001','AI003002','AI003003','AI003004','AI003005','AI004001','AI004002','AI004003','AI004004',
                    'AI005001','AI005002','AI006001','AI007001','AI007002','AI007003','AI007004','AI008001','AI009001','AI009002','AI010001','AI010002','AI011001','AI013001','AI013002','AI013002',
                    'AI014001','AI014002','AI015002','AI015003','AI015004','AI016001','AI016002','AI017001','AI017002','AI018001','AI018002','AI019001','AI020001','AI021001','AI702001','AI703001',
                    'AI704001','AJ001001','AJ001002','AJ002001','AJ003001','AJ003002','AJ005001','AJ006001','AJ007001','AJ007002','AJ007003','AJ008001','AJ009001','AJ010001','AJ011001','AK001001',
                    'AK001002','AK002001','AK002002','AK003001','AK008001','AK008002','AK008003','AK008004','AK011001','AK012001','AK012002','AK013001','AK013002','AK014001','AK015001','AK016001',
                    'AK016002','AK017001','AK018001','AK019001','AK020001','AK021001','AK021002','AK022001','AK023001','AK023002','AK023003','AK023004','AK024001','AK024002','AK024003','AK025001',
                    'AK025002','AK025003','AK026001','AK027001','AK701001','AK703001','AK703002','AK704003','AK704001','AK704002','AK706001','AK707001','AK708001','AK709001','AL001001','AL001002',
                    'AL001003','AL001004','AL002001','AL002002','AL003001','AL003002','AP001001','AP002001','AP002002','AP003001','AP003002','AP003003','AP004001','AP005001','AP005002','AP005003',
                    'AP006001','AP006002','AP006003','AP010001','AP011001','AP012001','AP013001','AP019001','AP020001','AP020002','AP021001','AP021002','AP021003','AP022001','AP022002','AP022003',
                    'AP023001','AP023002','AP023003','AP024001','AP024002','AP024003','AP025001','AP025002','AP025003','AP025004','AP026001','AP026002','AP026003','AP026004','AP705001','AP706001',
                    'AP706002','AP706003','AP706004','AP707001','AP708001','AP708002','AP708003','AP709001','AP709002','AP709003','AP709004','AP710001','AP710002','AP711001','AP713001','AP714001',
                    'AP714002','AP714003','AP714004','AQ001001','AQ001002','AQ001003','AQ008001','AQ009001','AQ009002','AQ009003','AQ009004','AQ009005','AQ009006','AQ009007','AQ011002','AQ011005',
                    'AQ011006','AQ011007','AQ012001','AQ012002','AQ012003','AQ013001','AQ013002','AQ016001','AQ017001','AQ017002','AQ017003','AQ705001','AQ706001','AQ707001','AQ707002','AQ707003',
                    'AQ709001','AQ709002','AQ709003','AQ709004','AQ710001','AQ710002','AQ710003','AQ710004','AQ711001','AQ711002','AQ711003','AR001001','AR001002','AR001003','AR001004','AR001005',
                    'AR002001','AR002002','AR002003','AR002004','AR002005','AR003001','AR003002','AR003003','AR003004','AR004001','AR004002','AR004003','AR013001','AR013002','AR013003','AR014001',
                    'AR014002','AR014003','AR015001','AR015002','BA001001','BA001002','BA001003','BA001004','BA002001','BA002002','BA002003','BA002004','BA003001','BA003002','BA003003','BA004001',
                    'BA004002','BA004003','BA004004','BA005001','BA005002','BA005003','BA005004','BA006001','BA006002','BA006003','BA006004','BA007001','BA007002','BA007003','BA007004','BA009001',
                    'BA009002','BA010001','BA010002','BA010003','BA010004','BA011001','BA013001','BA013002','BA013003','BA014001','BA014002','BA014003','BA014004','BA014005','BA014006','BA014007',
                    'BA015001','BA015002','BA015003','BA016001','BA016002','BA016003','BA016004','BA017001','BA017002','BA017003','BA017004','BA018001','BA018002','BA018003','BA019001','BA019002',
                    'BA020001','BA020002','BA021001','BA021002','BA021003','BA021004','BA022001','BA022002','BA022003','BA022004','BA023001','BA023002','BA024001','BA024002','BA024003','BA024004',
                    'BA026001','BA026002','BA030001','BA030002','BA031001','BA031002','BA032001','BA032002','BA034001','BA034002','BA034003','BA034004','BA701001','BA701002','BA701003','BA702001',
                    'BA702002','BA702003','BA703001','BA703002','BA703003','BA703004','BA704001','BA705001','BA705002','BA705003','BA705004','BA705005','BA706001','BA706002','BA706003','BA708001',
                    'BA709001','BA709002','BA709003','BA711001','BA712001','BD006001','BD006002','BC719001','BC719002','CD003001','CD003002','CD003003','CD003004','CD003005','CD003006','DA001001',
                    'DA001002','DA001003','DA001004','DA001005','DA002001','DA002002','DA002003','DA002004','DA002005','DA003001','DA003002','DA004001','DA004002','DA005001','DA005002','DA005003',
                    'DA006001','DA006002','DA007001','DA007002','DA008001','DA008002','DA009001','DC503001','DC504001','EA001001','EA001002','EA001003','EA002001','EA002002','EA003001','EA003002',
                    'EA003003','EA003004','EA004001','EA004002','EA004003','EA004004','EA004005','EA004006','EA007001','EA007002','EA008001','EA008002','EA008003','EA009001','EA009002','EA009003',
                    'EA010001','EA010002','EC501001','EC501002','EC501003','EC501004','FA001001','FA001002','FA003001','FA003002','FA003003','FA003004','FA004001','FA004002','FA004003','FA006001',
                    'FA006002','FA007001','FA007002','FA007003','FA008001','FA008002','FA009001','FA009002','FA009003','FA009004','FA010001','FA010002','FA010003','FA010004','FA012001','FA012002',
                    'FA014001','FA701001','FA701002','FA701003','FA702001','FB001001','FB001002','FB001003','FB001004','FB001005','FB004003','FB004004','FB004005','FB004006','FB004007','FB006001',
                    'FB006002','FB007001','FB007002','FB008001','FB008002','FB008003','FC002001','FC002002','FC002003','FC003001','FC003002','FC003003','FC004001','FC004002','FC004003','FC004004',
                    'FC005001','FC005002','FC005003','FC007001','FC007002','FC008001','FC008002','FC009001','FC009002','FC009003','FC010001','FC011001','FC013001','FC013002','FC013003','FC014001',
                    'FC015001','FC016001','FC701001','FC701002','FC701003','FC702001','FC702002','FD001001','FD001002','FD002001','FD002002','FD003001','FD003002','BB001001','BB002001','BB002002',
                    'BB002003','BB002004','BB003001','BB003002','BB004001','BB004002','BB005001','BB005002','BB005003','BB005004','BB005005','BB006001','BB006002','BB006003','BB007001','BB007002',
                    'BB007003','BB008001','BB008002','BB008003','BB009001','BB009002','BB009003','BB010001','BB010002','BB010003','BB011001','BB011002','BB011003','BB012001','BB012002','BB013001',
                    'BB013002','BB013003','BB016001','BB016002','BB016003','BB017001','BB701001','BB701002','BB701003','BB702001','BB702002','BB702003','BB703001','BB703002','BB704001','BB704002',
                    'BC001001','BC001002','BC001003','BC002001','BC002002','BC002003','BC003001','BC003002','BC003004','BC003005','BC003006','BC004001','BC004002','BC008001','BC008002','BC008003',
                    'BC009001','BC009002','BC009003','BC010001','BC010002','BC010003','BC011001','BC011002','BC011003','BC012001','BC012002','BC012003','BC013001','BC013002','BC013003','BC015001',
                    'BC015002','BC015003','BC016001','BC016002','BC016003','BC019001','BC019002','BC019003','BC020001','BC020002','BC020003','BC021001','BC021002','BC021003','BC022001','BC022002',
                    'BC022003','BC024001','BC024002','BC024003','BC024004','BC025001','BC025002','BC025003','BC025004','BC027001','BC027002','BC027003','BC029001','BC029002','BC029003','BC030001',
                    'BC030002','BC030003','BC034001','BC034002','BC034003','BC035001','BC035002','BC035003','BC035004','BC036001','BC036002','BC036003','BC040001','BC040002','BC040003','BC042001',
                    'BC042002','BC042003','BC044001','BC044002','BC045001','BC045002','BC046001','BC046002','BC047001','BC049001','BC049002','BC051001','BC051002','BC052001','BC052002','BC053001',
                    'BC053002','BC053003','BC701001','BC701002','BC701003','BC702002','BC702003','BC702004','BC703001','BC703002','BC703003','BC705001','BC705002','BC707001','BC707002','BC707003',
                    'BC708001','BC708002','BC708003','BC708004','BC710001','BC710002','BC712001','BC712002','BC712003','BC713001','BC713002','BC715001','BC715002','BC715003','BC716001','BD001001',
                    'BD001002','BD001003','BD001004','BD001005','BD002001','BD002002','BD002003','BD003001','BD003002','BD003003','BD004001','BD004002','BD004003','BD004004','BD005001','BD005002',
                    'BD005003','BD007001','BD007002','BD007003','BD007004','BD007005','BD007006','BD009001','BD009002','BD009003','BD010001','BD010002','BD010003','BD010004','BD011001','BD011002',
                    'BD011003','BD012001','BD012002','BD013001','BD013002','BD701001','BD701002','BD701003','BD701004','CA001001','CA001002','CA001003','CA001004','CA002001','CA002002','CA002003',
                    'CA002004','CA003001','CA003002','CA003003','CA003004','CA006001','CA006002','CA006003','CA006004','CA013001','CA013002','CA013003','CA013004','CA015001','CA015002','CA015003',
                    'CA015004','CA016001','CA016002','CA016003','CA016004','CA017001','CA017002','CA017003','CA017004','CA018001','CA018002','CA018003','CA018004','CA019001','CA019002','CA019003',
                    'CA019004','CA021001','CA021002','CA021003','CA021004','CA022001','CA022002','CA022003','CA023001','CA024001','CA024002','CA025001','CA027001','CA027002','CA027003','CA028001',
                    'CA701001','CA701002','CA701003','CA702001','CA703001','CA703002','CA703003','CA703004','CA703005','CA704001','CA704002','CA706001','CB003001','CB003002','CB003003','CB003004',
                    'CB004001','CB004002','CB004003','CB004004','CB006001','CB006002','CB006003','CB006004','CB007001','CB007002','CB007003','CB007004','CB008001','CB008002','CB008003','CB008004',
                    'CB009001','CB009002','CB009003','CB010001','CB010002','CB010003','CB011001','CB012001','CB012002','CB012003','CB013001','CB013002','CB013003','CB014001','CB014002','CB014003',
                    'CB015001','CB016001','CB017001','CB017002','CB018001','CB019001','CB020001','CB021001','CB023001','CB024001','CB025001','CB025002','CB027001','CB027002','CB027003','CC001001',
                    'CC001002','CC001003','CC001004','CC002001','CC002002','CC002003','CC002004','CC003001','CC003002','CC003003','CC004001','CC004002','CC004003','CC004004','CC007001','CC007002',
                    'CC007003','CC007004','CC008001','CC008002','CC008003','CC008004','CC009001','CC009002','CC009003','CC010001','CC010002','CC010003','CC011001','CC012001','CC013001','CC014001',
                    'CC015001','CC016001','CC016002','CC017001','CC017002','CC017003','CC017004','CC018001','CC018002','CC018003','CC019001','CC019002','CC019003','CC019004','CD001001','CD001002',
                    'CD001003','CD001004','CD002001','CD002002','CD002003','CD003001','CD003002','CD004001','CD004002','CD004003','CD004004','CD018001','CD018002','CD018003','CD018004','CD020001',
                    'CD020002','CD020003','CD020004','CD022001','CD022002','CD023001','CD023002','CD023003','CD025001','CD025002','CD026001','CD026002','CD026003','CD028001','CD029001','CD029002',
                    'DB001001','DB001002','DB001003','DB001004','DB001005','DB002001','DB002002','DB002003','DB002004','DB002005','DB003001','DB003002','DB003003','DB003004','DB003005','DB004001',
                    'DB004002','DB004003','DB004004','DB004005','DB005001','DB005002','DB005003','DB005004','DB005005','DB006001','DB006002','DB006003','DB007001','DB007002','DB007003','DB008001',
                    'DB008002','DB008003','DB008004','DB009001','DB009002','DB010001','DB010002','DB011001','DB011002','DB011003','DB011004','DB012001','DB012002','DB012003','DB013001','DB013002',
                    'DB013003','DB701001','DB701002','DB701003','DB702001','DB702002','DB702003','DB703001','DB703002','DB703003','DC001001','DC001002','DC001003','DC002001','DC002002','DC002003',
                    'DC002004','DC002005','DC003001','DC003002','DC003003','DC004001','DC004002','DC004003','DC004004','DC008001','DC008002','DC008003','DC009001','DC009002','DC009003','DC010001',
                    'DC010002','DC010003','DC011001','DC011002','DC011003','DC011004','DC012001','DC012002','DC012003','DC013001','DC013002','DC701001','DC701002','DC701003','DC702001','DC702002',
                    'DC702003','DC703001','DC703002','DC703003','DC703004','DC704001','DC704002','DC704003','DC705001','DC705002','DC705003','DC706001','DC706002','DC706003','DC707001','DC707002',
                    'EB001001','EB001002','EB001003','EB002001','EB002002','EB002003','EB002004','EB003001','EB003002','EB003003','EB003004','EB004001','EB004002','EB004003','EB004004','EB005001',
                    'EB005002','EB005003','EB005004','EB006001','EB006002','EB006003','EB006004','EB006005','EB007001','EB007002','EB007003','EB008001','EB008002','EB008003','EB008004','EB008005',
                    'EB009001','EB009002','EB009003','EB009004','EB010001','EB010002','EB010003','EB011001','EB011002','EB012001','EB012002','EB012003','EB013001','EB013002','EB701001','EB701002',
                    'EB701003','EB701004','CD702001','CD704001','CD704002','CD705001','EC003001','EC003002','EC005001','EC005002','EC005003','EC005004','EC008001','EC008002','EC010001','EC010002',
                    'EC010003','EC012001','EC012002','EC012003','EC013001','EC013002','EC013003','EC014001','EC014002','EC015001','EC015002','EC016001','EC016002','EC017001','EC017002','EC701001',
                    'EC701002','EC701003','EC702001','EC702002','EC703001','EC704001','EC704002','EC705001','ED001001','ED001002','ED001003','ED002001','ED002002','ED002003','ED003001','ED003002',
                    'ED003003','ED004001','ED004002','ED004003','ED004004','ED005001','ED005002','ED005003','ED006001','ED006002','ED007001','ED007002']
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
          $("#CopyNamaPasar").val(Pisah[5])
          $("#CopyHariPasar").val(Pisah[6])
          var CopyKode = Pisah[7].split('|')
          var CopyHarga = Pisah[8].split('|')
          // var Copy_Harga = Pisah[9].split('|')
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
            if ($("#Copy"+Kode[i]).val() > 0) {
              KodeKualitas.push(Kode[i])
              Harga.push($("#Copy"+Kode[i]).val())
              _Harga.push($("#Copy_"+Kode[i]).val())
            }
          }
          var NTP = { Kecamatan: $("#CopyKecamatan").val(),
                      TanggalSurvei: $("#CopyTanggalSurvei").val(),
                      NamaResponden: $("#CopyNamaResponden").val(),
                      Alamat: $("#CopyAlamat").val(),
                      NamaPasar: $("#CopyNamaPasar").val(),
                      HariPasar: $("#CopyHariPasar").val(),
                      KodeKualitas: KodeKualitas.join('|'),
                      Harga: Harga.join('|'),
                      _Harga: _Harga.join('|') }
          $("#Copy").attr("disabled", true);                              
          $("#LoadingCopy").show();
          $.post(BaseURL+"Surveyor/CopyNTPKonsumen", NTP).done(function(Respon) {
            if (Respon == '1') {
              alert('Data Survei Berhasil Di Simpan!')
              window.location = BaseURL + "Surveyor/SurveiHargaKonsumenPerdesaan"
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
					$("#EditNamaPasar").val(Pisah[5])
          $("#EditHariPasar").val(Pisah[6])
          var EditKode = Pisah[7].split('|')
          var EditHarga = Pisah[8].split('|')
          var Edit_Harga = Pisah[9].split('|')
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
          } else if ($("#EditHariPasar").val() == "") {
            alert('Mohon Input Hari Pasar!')
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
                        NamaPasar: $("#EditNamaPasar").val(),
                        HariPasar: $("#EditHariPasar").val(),
                        KodeKualitas: KodeKualitas.join('|'),
                        Harga: Harga.join('|'),
                        _Harga: _Harga.join('|') }
            $("#Edit").attr("disabled", true);                              
            $("#LoadingEdit").show();
						$.post(BaseURL+"Surveyor/EditNTPKonsumen", NTP).done(function(Respon) {
							if (Respon == '1') {
                alert('Data Survei Berhasil Di Update!')
								window.location = BaseURL + "Surveyor/SurveiHargaKonsumenPerdesaan"
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
          } else if ($("#HariPasar").val() == "") {
            alert('Mohon Input Hari Pasar!')
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
                        NamaPasar: $("#NamaPasar").val(),
                        HariPasar: $("#HariPasar").val(),
                        KodeKualitas: KodeKualitas.join('|'),
                        Harga: Harga.join('|'),
                        _Harga: _Harga.join('|') }
            $("#Simpan").attr("disabled", true);                              
            $("#LoadingInput").show();
            $.post(BaseURL+"Surveyor/InputNTPKonsumen", NTP).done(function(Respon) {
              if (Respon == '1') {
                alert('Survei Berhasil Di Simpan!')
                window.location = BaseURL + "Surveyor/SurveiHargaKonsumenPerdesaan"
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