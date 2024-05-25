<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
$group = user()->getRoles();
?>
<div class="tab-pane <?= isset($group[11]) ? 'active' : '' ?>" id="assessmentmedis" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 mt-4">
            <div class="card border-1 rounded-4 m-4 p-4">
                <div class="card-body">
                    <form id="formaddarm" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <div class="modal-body pt0 pb0">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input name="org_unit_code" id="armorg_unit_code" type="hidden" />
                                    <input name="visit_id" id="armvisit_id" type="hidden" />
                                    <input name="trans_id" id="armtrans_id" type="hidden" />
                                    <input name="report_date" id="armreport_date" type="hidden" />
                                    <input name="theid" id="armtheid" type="hidden" />
                                    <input name="body_id" id="armbody_id" type="hidden" />
                                    <input name="theaddress" id="armtheaddress" type="hidden" />
                                    <input name="isrj" id="armisrj" type="hidden" />
                                    <input name="kal_id" id="armkal_id" type="hidden" />
                                    <input name="spesialistik" id="armspesialistik" type="hidden" />
                                    <input name="doctor" id="armdoctor" type="hidden" />
                                    <input name="class_room_id" id="armclass_room_id" type="hidden" />
                                    <input name="bed_id" id="armbed_id" type="hidden" />
                                    <input name="result_id" id="armresult_id" type="hidden" />
                                    <input name="keluar_id" id="armkeluar_id" type="hidden" />
                                    <input name="in_date" id="armin_date" type="hidden" />
                                    <input name="exit_date" id="armexit_date" type="hidden" />
                                    <input name="modified_date" id="armmodified_date" type="hidden" />
                                    <input name="modified_by" id="armmodified_by" type="hidden" />
                                    <input name="nokartu" id="armnokartu" type="hidden" />
                                    <input name="pasien_diagnosa_id" id="armpasien_diagnosa_id" type="hidden" />
                                    <input name="no_registration" id="armno_registration" type="hidden" />
                                    <input name="thename" id="armthename" type="hidden" />
                                    <input name="status_pasien_id" id="armstatus_pasien_id" type="hidden" />
                                    <input name="gender" id="armgender" type="hidden" />
                                    <input name="ageyear" id="armageyear" type="hidden" />
                                    <input name="agemonth" id="armagemonth" type="hidden" />
                                    <input name="ageday" id="armageday" type="hidden" />
                                    <input name="nosep" id="armnosep" type="hidden" />
                                    <input name="tglsep" id="armtglsep" type="hidden" />
                                    <input name="kddpjp" id="armtglsep" type="hidden" />
                                    <input name="diag_cat" id="armdiag_cat" type="hidden" />
                                    <input name="statusantrean" id="armstatusantrean" type="hidden" value="<?= $visit['statusantrean']; ?>" />
                                    <div class="row row-eq">
                                        <!-- INI CURRENT FILLING DATA -->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div id="ajax_load"></div>
                                            <div class="row">
                                                <h3 id="armTitle">Assessment Medis</h3>
                                                <hr>
                                                <div class="col-md-12">
                                                    <div class="dividerhr"></div>
                                                </div><!--./col-md-12-->
                                                <div class="row">
                                                    <div class="col-sm-2 col-xs-12">
                                                        <h5 class="font-size-14 mb-4 badge bg-primary">dokumen assessment:</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4 col-xs-12">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="armdate_of_diagnosa">Tanggal Assessmennt</label>
                                                                <input name="date_of_diagnosa" id="armdate_of_diagnosa" type="datetime-local" class="form-control" value="<?php date('Y/m/d H:i:s'); ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="armclinic_id">Poli</label>
                                                                <select name="clinic_id" id="armclinic_id" type="hidden" class="form-control ">
                                                                    <?php if (!is_null($visit['class_room_id'])) { ?>
                                                                        <option value="<?= $visit['class_room_id']; ?>"><?= $visit['name_of_class']; ?></option>
                                                                    <?php } else { ?>
                                                                        <option value="<?= $visit['clinic_id']; ?>"><?= $visit['name_of_clinic']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="armemployee_id">Dokter</label>
                                                                <select name="employee_id" id="armemployee_id" type="hidden" class="form-control ">
                                                                    <?php if (!is_null($visit['class_room_id'])) { ?>
                                                                        <option value="<?= $visit['employee_inap']; ?>"><?= $visit['fullname_inap']; ?></option>
                                                                    <?php } else { ?>
                                                                        <option value="<?= $visit['employee_id']; ?>"><?= $visit['fullname']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="accordion" id="accordionAssessmentMedis">

                                                </div>
                                                <div class="col-md-12">
                                                    <hr>
                                                </div><!--./col-md-12-->
                                                <div class="row">
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
                                                                        <td id="armhvisit_date"><?= substr($visit['visit_date'], 0, 13); ?></td>
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
                                                        <textarea id="armhdescription" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Ringkasan Diagnosis 2</label>
                                                        <a href='#' onclick='copydiagnosa_desc_05()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                        <textarea id="armhdiagnosa_desc_05" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Riwayat Alergi</label>
                                                        <a href='#' onclick='copydiagnosa_desc_06()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                        <textarea id="armhdiagnosa_desc_06" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Anamnesis</label>
                                                        <a href='#' onclick='copyanamnase()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                        <textarea id="armhanamnase" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Periksa Fisik</label>
                                                        <a href='#' onclick='copypemeriksaan()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                        <textarea id="armhpemeriksaan" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Periksa Lab</label>
                                                        <textarea id="armhpemeriksaan_02" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Periksa RO</label>
                                                        <textarea id="armhpemeriksaan_03" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Periksa Lain</label>
                                                        <textarea id="armhpemeriksaan_05" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Terapi</label>
                                                        <a href='#' onclick='copyteraphy_desc()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                        <textarea id="armhteraphy_desc" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Instruksi/Anjuran</label>
                                                        <a href='#' onclick='copyinstruction()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                        <textarea id="armhinstruction" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Evaluasi</label>
                                                        <textarea id="armhmorfologi_neoplasma" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Suspek Penyakit Akibat Kerja</label>
                                                        <textarea id="armhdisability" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="dividerhr"></div>
                                                </div><!--./col-md-12-->
                                                <div class="col-sm-4 col-md-3">
                                                    <div class="form-group">
                                                        <label>Rencana Tindak Lanjut</label>
                                                        <select id="armhrujukan" class="form-control " disabled="">
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
                                                            <select class="form-control  patient_list_ajax" id="armhdirujukke" disabled>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Kontrol</label>
                                                        <div class="input-group" id="armhtglkontrol">
                                                            <input id="armhtgl_kontrol" name="tgl_kontrol" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#arhtglkontrol' value="<?= date('Y-m-d'); ?>">
                                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-3">
                                                    <div class="form-group">
                                                        <label>Ke Poli</label>
                                                        <select id="armhkdpoli_kontrol" class="form-control " disabled="">
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
                                                        <textarea id="armhdescription" rows="1" class="form-control " autocomplete="off" disabled=""></textarea>
                                                    </div>
                                                </div>
                                            </div><!--./row-->
                                        </div><!--./row-->
                                        <div class="panel-footer text-end mb-4">
                                            <button type="button" id="formaddarmbtn" name="save" data-loading-text="Tambah" class="btn btn-info pull-right" style="display: none;"><i class="fa fa-check-circle"></i> <span>Tambah</span></button>
                                            <button type="submit" id="formsavearmbtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="formeditarm" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                            <button type="button" id="formsignarm" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                            <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                                        </div>
                                    </div><!--./col-md-4-->
                                </div><!--./row-->
                            </div><!--./col-md-12-->
                        </div><!--./row-->
                    </form>
                </div>
            </div>
            <h3>Histori Assessmen Medis</h3>
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="text-align: center;">
                    <tr>
                        <th></th>
                        <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                        <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                        <th class="text-center" style="width: 20%;">S (Subyektif)</th class="text-center">
                        <th class="text-center" style="width: 20%;">O (Obyektif)</th class="text-center">
                        <th class="text-center" style="width: 20%;">A (Asesmen)</th class="text-center">
                        <th class="text-center" style="width: 20%;">P (Prosedur)</th class="text-center">
                    </tr>

                </thead>
                <tbody id="assessmentMedisHistoryBody">
                    <?php
                    $total = 0;

                    ?>


                </tbody>

            </table>
        </div>
    </div><!--./row-->

</div>
<div class="modal fade" id="copyVitalSignModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <h3>Histori Vital Sign Perawat</h3>
                <table class="table table-striped table-hover">
                    <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th></th>
                            <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                            <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                            <th class="text-center" style="width: 10%;">BB (Kg)</th class="text-center">
                            <th class="text-center" style="width: 10%;">TInggi (cm)</th class="text-center">
                            <th class="text-center" style="width: 10%;">Suhu ()</th class="text-center">
                            <th class="text-center" style="width: 10%;">Nadi (/menit)</th class="text-center">
                            <th class="text-center" style="width: 10%;">Sistole (mmhg)</th class="text-center">
                            <th class="text-center" style="width: 10%;">Diastole (mmHg)</th class="text-center">
                            <th class="text-center" style="width: 10%;">Saturasi (SpO2%)</th class="text-center">
                            <th class="text-center" style="width: 10%;">Nafas/RR (/menit)</th class="text-center">
                            <th class="text-center" style="width: 10%;">Diameter Lengan (cm)</th class="text-center">
                            <th class="text-center" style="width: 10%;">Pemeriksaan Fisik Tambahan (cm)</th class="text-center">
                        </tr>
                    </thead>
                    <tbody id="copyListVitalSignModal">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>