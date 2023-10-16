<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>
<div class="tab-pane active" id="rekammedis">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <div class="box-header border-b mb10 pl-0 pt0">
                <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"><?= $visit['diantar_oleh']; ?> (<?= $visit['no_registration']; ?>)</h3>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ptt10">

                    <?php

                    if ($visit['gender'] == '1') {
                        $file = "uploads\images\profile_male.png";
                    } else if ($visit['gender'] == '2') {
                        $file = "uploads\images\profile_female.png";
                    }

                    ?>
                    <img width="115" height="115" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url(); ?><?php echo $file ?>">

                </div><!--./col-lg-5-->
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table class="table tablecustom table-bordered mb0">
                        <tr>
                            <td class="bolds"><?php echo lang('Word.age'); ?></td>
                            <td id="age"><?= $visit['age']; ?></td>
                        </tr>
                        <tr>
                            <td class="bolds">Alamat</td>
                            <td id="address"><?php echo $visit['visitor_address']; ?></td>
                        </tr>

                        <tr>
                            <td class="bolds">Dokter</td>
                            <td id="dokter"><?php echo $visit['fullname']; ?></td>
                        </tr>
                        <?php if (!is_null($visit['class_room_id'])) { ?>
                            <tr>
                                <td class="bolds">Tanggal Masuk</td>
                                <td id="visit_date"><?php echo $visit['visit_date']; ?></td>
                            </tr>
                            <tr>
                                <td class="bolds">Tanggal Keluar</td>
                                <td id="exit_date"><?php echo $visit['exit_date']; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="bolds">Tanggal</td>
                                <td id="visit_date"><?php echo $visit['visit_date']; ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <?php if (!is_null($visit['class_room_id'])) { ?>
                                <td class="bolds">Bangsal</td>
                                <td id="klinik"><?php echo ($visit['name_of_class']); ?></td>
                            <?php } else { ?>
                                <td class="bolds">Poli</td>
                                <td id="klinik"><?php echo $visit['name_of_clinic']; ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td class="bolds">Alergi</td>
                            <td class="alergi"> - </td>
                        </tr>


                    </table>
                </div><!--./col-lg-7-->
            </div><!--./row-->

            <?php
            // if (!empty($pasienDiagnosa)) {
            if (false) {
            ?>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Ringkasan Diagnosis:</b></p>
                <ul>
                    <li>
                        <div><?= $pasienDiagnosa['description']; ?></div>
                    </li>
                    <li>
                        <div><?= $pasienDiagnosa['diagnosa_desc_05']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Riwayat Alergi:</b></p>
                <ul>
                    <li>
                        <div><?= $pasienDiagnosa['diagnosa_desc_06']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Anamnesis:</b></p>
                <ul>
                    <li>
                        <div><?= $pasienDiagnosa['anamnase']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Periksa Fisik:</b></p>
                <ul>
                    <li>
                        <div><?= $pasienDiagnosa['pemeriksaan']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Periksa Lab:</b></p>
                <ul>
                    <li>
                        <div><?= $pasienDiagnosa['pemeriksaan_02']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Periksa RO:</b></p>
                <ul>
                    <li>
                        <div><?= $pasienDiagnosa['pemeriksaan_03']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Pemeriksaan Lain:</b></p>
                <ul>
                    <li>
                        <div><?= $pasienDiagnosa['pemeriksaan_05']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Terapi:</b></p>
                <ul>
                    <li>
                        <div><?= $pasienDiagnosa['teraphy_desc']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Instruksi:</b></p>
                <ul>
                    <li>
                        <div><?= $pasienDiagnosa['instruction']; ?></div>
                    </li>
                </ul>
            <?php
            } ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">
            <form id="formaddrm" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                <div class="">
                    <div class="modal-body pt0 pb0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <input name="org_unit_code" id="arorg_unit_code" type="hidden" class="form-control" />
                                <input name="visit_id" id="arvisit_id" type="hidden" class="form-control" />
                                <input name="date_of_diagnosa" id="ardate_of_diagnosa" type="hidden" class="form-control" />
                                <input name="report_date" id="arreport_date" type="hidden" class="form-control" />
                                <input name="theid" id="artheid" type="hidden" class="form-control" />
                                <input name="theaddress" id="artheaddress" type="hidden" class="form-control" />
                                <input name="isrj" id="arisrj" type="hidden" class="form-control" />
                                <input name="kal_id" id="arkal_id" type="hidden" class="form-control" />
                                <input name="clinic_id" id="arclinic_id" type="hidden" class="form-control" />
                                <input name="spesialistik" id="arspesialistik" type="hidden" class="form-control" />
                                <input name="employee_id" id="aremployee_id" type="hidden" class="form-control" />
                                <input name="doctor" id="ardoctor" type="hidden" class="form-control" />
                                <input name="class_room_id" id="arclass_room_id" type="hidden" class="form-control" />
                                <input name="bed_id" id="arbed_id" type="hidden" class="form-control" />
                                <input name="result_id" id="arresult_id" type="hidden" class="form-control" />
                                <input name="keluar_id" id="arkeluar_id" type="hidden" class="form-control" />
                                <input name="in_date" id="arin_date" type="hidden" class="form-control" />
                                <input name="exit_date" id="arexit_date" type="hidden" class="form-control" />
                                <input name="modified_date" id="armodified_date" type="hidden" class="form-control" />
                                <input name="modified_by" id="armodified_by" type="hidden" class="form-control" />
                                <input name="nokartu" id="arnokartu" type="hidden" class="form-control" />
                                <input name="pasien_diagnosa_id" id="arpasien_diagnosa_id" type="hidden" class="form-control" />
                                <input name="no_registration" id="arno_registration" type="hidden" class="form-control" />
                                <input name="thename" id="arthename" type="hidden" class="form-control" />
                                <input name="status_pasien_id" id="arstatus_pasien_id" type="hidden" class="form-control" />
                                <input name="gender" id="argender" type="hidden" class="form-control" />
                                <input name="ageyear" id="arageyear" type="hidden" class="form-control" />
                                <input name="agemonth" id="aragemonth" type="hidden" class="form-control" />
                                <input name="ageday" id="arageday" type="hidden" class="form-control" />
                                <input name="nosep" id="arnosep" type="hidden" class="form-control" />
                                <input name="tglsep" id="artglsep" type="hidden" class="form-control" />
                                <input name="kddpjp" id="artglsep" type="hidden" class="form-control" />




                                <div class="row row-eq">


                                    <!-- INI CURRENT FILLING DATA -->



                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div id="ajax_load"></div>
                                        <div class="row">
                                            <h3>Rekam Medis</h3>

                                            <div class="col-md-12">
                                                <div class="dividerhr"></div>
                                            </div><!--./col-md-12-->



                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Ringkasan Diagnosis</label>
                                                    <textarea id="ardescription" name="description" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Ringkasan Diagnosis 2</label>
                                                    <textarea id="ardiagnosa_desc_05" name="diagnosa_desc_05" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Riwayat Alergi</label>
                                                    <textarea id="ardiagnosa_desc_06" name="diagnosa_desc_06" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Anamnesis</label>
                                                    <textarea id="aranamnase" name="anamnase" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa Fisik</label>
                                                    <textarea id="arpemeriksaan" name="pemeriksaan" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa Lab</label>
                                                    <textarea id="arpemeriksaan_02" name="pemeriksaan_02" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa RO</label>
                                                    <textarea id="arpemeriksaan_03" name="pemeriksaan_03" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa Lain</label>
                                                    <textarea id="arpemeriksaan_05" name="pemeriksaan_05" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Terapi</label>
                                                    <textarea id="arteraphy_desc" name="teraphy_desc" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Instruksi/Anjuran</label>
                                                    <textarea id="arinstruction" name="instruction" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Evaluasi</label>
                                                    <textarea id="armorfologi_neoplasma" name="morfologi_neoplasma" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Suspek Penyakit Akibat Kerja</label>
                                                    <textarea id="ardisability" name="disability" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="dividerhr"></div>
                                            </div><!--./col-md-12-->
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <h3>Diagnosa</h3>
                                                    <div class="staff-members">
                                                        <div class="table tablecustom-responsive">
                                                            <table class="table table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                                                <?php if (true) { ?>
                                                                    <thead>
                                                                        <th>Diagnosa</th>
                                                                        <th>Jenis Kasus</th>
                                                                        <th colspan="2">Kategori Diagnosis</th>
                                                                    </thead>
                                                                    <tbody id="bodyDiag">

                                                                    </tbody>
                                                                <?php }   ?>
                                                            </table>
                                                        </div>
                                                        <div id="eresepAdd" class="box-tab-tools" style="text-align: center;">
                                                            <button type="button" id="formdiag" name="adddiagnosa" onclick="addRowDiag()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info"><i class="fa fa-plus"></i> <span>Diagnosa</span></button>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <h3>Prosedur</h3>

                                                    <div class="staff-members">
                                                        <div class="table tablecustom-responsive">
                                                            <table class="table table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                                                <?php if (true) { ?>
                                                                    <thead>
                                                                        <th colspan="2">Prosedur (ICD IX)</th>
                                                                    </thead>
                                                                    <tbody id="bodyProc">

                                                                    </tbody>
                                                                <?php }   ?>
                                                            </table>
                                                        </div>
                                                        <div class="box-tab-tools" style="text-align: center;">
                                                            <button type="button" id="addprocedure" onclick="addRowProc()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info"><i class="fa fa-plus"></i> <span>Prosedur</span></button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Rencana Tindak Lanjut</label>
                                                    <select name="rujukan" id="arrujukan" class="form-control">
                                                        <option value="1">Diperbolehkan Pulang</option>
                                                        <option value="2">Pemeriksaan Penunjang</option>
                                                        <option value="3">Dirujuk ke</option>
                                                        <option value="4">Kontrol Kembali</option>
                                                        <option value="5">Rawat Inap</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group"><label for="diag_awal">Dirujuk Ke</label>
                                                    <div class="p-2 select2-full-width">
                                                        <select class="form-control patient_list_ajax" name='dirujukke' id="ardirujukke">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Tanggal Kontrol</label>
                                                    <input id="artgl_kontrol" name="tgl_kontrol" placeholder="" type="text" class="form-control" value="<?= date('Y-m-d');; ?>">
                                                    <span class="text-danger"></span>
                                                </div>
                                                <script type="text/javascript">
                                                    $(function() {
                                                        $('#artgl_kontrol').datetimepicker({
                                                            format: 'YYYY-MM-DD'
                                                        });
                                                    });
                                                </script>
                                            </div>
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Ke Poli</label>
                                                    <select name="kdpoli_kontrol" id="arkdpoli_kontrol" class="form-control">
                                                        <?php $cliniclist = array();
                                                        foreach ($clinic as $key => $value) {
                                                            if ($clinic[$key]['stype_id'] == '1') {
                                                                $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                                            }
                                                        }
                                                        asort($cliniclist);
                                                        ?>
                                                        <?php foreach ($cliniclist as $key => $value) { ?>
                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-md-3">
                                                <div class="form-group">
                                                    <label for="pwd">Alasan/Ket</label>
                                                    <textarea id="ardescription" name="procedure_05" rows="1" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Nomor SKDP</label>
                                                    <input id="arskdp" name="skdp" placeholder="" type="text" class="form-control" value="">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Nomor SPRI</label>
                                                    <input id="arspri" name="spri" placeholder="" type="text" class="form-control" value="">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <?php
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./row-->
                                    </div><!--./col-md-8-->



                                    <!-- INI HISTORY PART -->



                                    <div class="col-lg-6 col-md-6 col-sm-6 col-eq ptt10" style="display: none;">
                                        <div class="row" id="patientDetails" style="display:block">
                                            <div class="col-md-9 col-sm-9 col-xs-9" id="Myinfo">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <table class="table tablecustom table-bordered mb0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="bolds">Tanggal Kunjungan</td>
                                                                    <td id="arhvisit_date"><?= substr($visit['visit_date'], 0, 13); ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div><!-- ./col-md-9 -->
                                        </div>

                                        <div class="row">
                                            <div class="box-header ptbnull">
                                                <h3 class="box-title titlefix">
                                                    History Rekam Medis Pasien </h3>

                                                <div class="box-tools pull-right">

                                                    <div class="dt-buttons btn-group btn-group2">
                                                        <a onclick="prevHistory()" class="btn btn-default dt-button buttons-copy buttons-html5 btn-copy" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Copy"><span>
                                                                <i class="fa fa-caret-square-o-left"></i></span>
                                                        </a>
                                                        <h4 id="currentHistory" class="box-title titlefix">
                                                        </h4>
                                                        <a onclick="nextHistory()" class=" btn btn-default dt-button buttons-excel buttons-html5 btn-excel" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Excel"><span>
                                                                <i class="fa fa-caret-square-o-right"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="dividerhr"></div>
                                            </div><!--./col-md-12-->

                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Ringkasan Diagnosis</label>
                                                    <a href='#' onclick='copydescription()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhdescription" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Ringkasan Diagnosis 2</label>
                                                    <a href='#' onclick='copydiagnosa_desc_05()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhdiagnosa_desc_05" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Riwayat Alergi</label>
                                                    <a href='#' onclick='copydiagnosa_desc_06()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhdiagnosa_desc_06" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Anamnesis</label>
                                                    <a href='#' onclick='copyanamnase()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhanamnase" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa Fisik</label>
                                                    <a href='#' onclick='copypemeriksaan()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhpemeriksaan" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa Lab</label>
                                                    <textarea id="arhpemeriksaan_02" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa RO</label>
                                                    <textarea id="arhpemeriksaan_03" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa Lain</label>
                                                    <textarea id="arhpemeriksaan_05" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Terapi</label>
                                                    <a href='#' onclick='copyteraphy_desc()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhteraphy_desc" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Instruksi/Anjuran</label>
                                                    <a href='#' onclick='copyinstruction()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhinstruction" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Evaluasi</label>
                                                    <textarea id="arhmorfologi_neoplasma" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Suspek Penyakit Akibat Kerja</label>
                                                    <textarea id="arhdisability" rows="2" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="dividerhr"></div>
                                            </div><!--./col-md-12-->
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Rencana Tindak Lanjut</label>

                                                    <select id="arhrujukan" class="form-control" disabled="">
                                                        <option value="1">Diperbolehkan Pulang</option>
                                                        <option value="2">Pemeriksaan Penunjang</option>
                                                        <option value="3">Dirujuk ke</option>
                                                        <option value="4">Kontrol Kembali</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group"><label for="diag_awal">Dirujuk Ke</label>
                                                    <div class="p-2 select2-full-width">
                                                        <select class="form-control patient_list_ajax" id="arhdirujukke" disabled>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Tanggal Kontrol</label>
                                                    <input id="arhtgl_kontrol" placeholder="" type="text" class="form-control" value="<?= date('Y-m-d');; ?>" disabled>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <script type="text/javascript">
                                                    $(function() {
                                                        $('#tgl_kontrol').datetimepicker({
                                                            format: 'YYYY-MM-DD'
                                                        });
                                                    });
                                                </script>
                                            </div>
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Ke Poli</label>
                                                    <select id="arhkdpoli_kontrol" class="form-control" disabled="">
                                                        <?php $cliniclist = array();
                                                        foreach ($clinic as $key => $value) {
                                                            if ($clinic[$key]['stype_id'] == '1') {
                                                                $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                                            }
                                                        }
                                                        asort($cliniclist);
                                                        ?>
                                                        <?php foreach ($cliniclist as $key => $value) { ?>
                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-md-3">
                                                <div class="form-group">
                                                    <label for="pwd">Alasan/Ket</label>
                                                    <textarea id="arhdescription" rows="1" class="form-control" autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>

                                        </div><!--./row-->
                                    </div><!--./row-->
                                    <div class="box-footer sticky-footer">
                                        <div class="pull-right">
                                            <button type="submit" id="formaddrmbtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="formeditrm" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right" style="display:none;"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                        </div>
                                        <div class="pull-right" style="margin-right: 10px; ">
                                        </div>
                                    </div>
                                </div><!--./col-md-4-->
                            </div><!--./row-->
                        </div><!--./col-md-12-->
                    </div><!--./row-->
                </div>
            </form>
        </div>
    </div><!--./row-->

</div>
<!-- -->



<script type='text/javascript'>
    var mrJson;
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    $(document).ready(function(e) {
        var nomor = '<?= $visit['no_registration']; ?>';
        var ke = '%'
        var mulai = '2023-08-01' //tidak terpakai
        var akhir = '2023-08-31' //tidak terpakai
        var lunas = '%'
        // var klinik = '<?= $visit['clinic_id']; ?>'
        var klinik = '%'
        var rj = '%'
        var status = '%'
        var nota = '%'
        var trans = '<?= $visit['trans_id']; ?>'
        var visit = '<?= $visit['visit_id']; ?>'
    })
</script>
<script type="text/javascript">
    var historyJson = new Array();
    var pasienDiagnosa = new Array();
    var currentIndex;
    var indexLength;
    $(document).ready(function(e) {
        getDiagnosas()
        getProcedures()
        modalAddRm()
    })
</script>