<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
$group = user()->getRoles();
// dd($permissions['assessmentmedis']);
// dd(user()->checkPermission("assessmentmedis", "c"));
?>
<!-- <div class="tab-pane <?= isset($group[11]) ? 'active' : '' ?>" id="assessmentmedis" role="tabpanel"> -->
<div class="tab-pane " id="assessmentmedis" role="tabpanel">
    <div class="row">
        <div id="loadContentAssessmentMedis" class="col-12 center-spinner"></div>
        <div class="row" id="contentAssessmentMedis">
            <div class="col-lg-2 col-md-2 col-sm-12">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 mt-4">
                <!-- <div class="card border-1 rounded-4 p-4">
                    <div class="card-body">
                    </div>
                </div> -->
                <?php if (user()->checkPermission("assessmentmedis", "c")) {
                    if (true) { ?>
                        <div class="box-tab-tools text-center mb-4">
                            <a id="formaddarmbtn" data-toggle="modal" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                        </div> <?php }
                        } ?>
                <!-- <h3>Histori Assessmen Medis</h3> -->

                <table class="table table-striped table-hover">
                    <!-- <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th style="width: 5%;"></th>
                            <th class="text-center" style="width: 15%;"></th class="text-center">
                            <th class="text-center" style="width: 10%;"></th class="text-center">
                            <th class="text-center" style="width: 60%;"></th class="text-center">
                            <th class="text-center" style="width: 10%;"></th class="text-center">
                        </tr>
                    </thead> -->
                    <tbody id="assessmentMedisHistoryBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--./row-->
</div>
<div class="modal fade" id="cetakarm" role="dialog" aria-labelledby="myModalLabel" data-bs-backdrop="static">
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
            <div class="modal-body pt0 pb0" id="cetakarmbody">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="armModal" role="dialog" aria-labelledby="myModalLabel" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 id="armTitle">ASESMEN MEDIS INSTALASI GAWAT DARURAT</h3>
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <div class="card">
                    <div class="card-body">
                        <form id="formaddarm" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                            <div class="modal-body pt0 pb0">
                                <div class="row flex-grow-1">
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
                                        <input name="kddpjp" id="armkddpjp" type="hidden" />
                                        <input name="diag_cat" id="armdiag_cat" type="hidden" />
                                        <input name="valid_date" class="valid_date" id="armvalid_date" type="hidden" />
                                        <input name="valid_user" class="valid_user" id="armvalid_user" type="hidden" />
                                        <input name="valid_pasien" class="valid_pasien" id="armvalid_pasien" type="hidden" />
                                        <input name="specialist_type_id" id="armspecialist_type_id" type="hidden" />
                                        <input name="statusantrean" id="armstatusantrean" type="hidden" value="<?= $visit['statusantrean']; ?>" />
                                        <?php csrf_field(); ?>
                                        <div class="row row-eq">
                                            <!-- INI CURRENT FILLING DATA -->
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div id="ajax_load"></div>
                                                <div class="row">
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
                                                                    <!-- <input id="flatarmdate_of_diagnosa" type="text" class="form-control datetimeflatpickr" readonly /> -->
                                                                    <input id="armdate_of_diagnosa" type="datetime-local" id="searchmulai" class="form-control" name="date_of_diagnosa">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-12">
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label for="armclinic_id">Pelayanan</label>
                                                                    <select name="clinic_id" id="armclinic_id" type="hidden" class="form-control ">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-12">
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label for="armemployee_id">Dokter</label>
                                                                    <select name="employee_id" id="armemployee_id" type="hidden" class="form-control ">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="armemergency_group" class="col-sm-4 col-xs-12">
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label for="armemergency">Emergency</label>
                                                                    <select name="emergency" id="armemergency" type="hidden" class="form-control" onclick="patientCategoryId=this.value">
                                                                        <option value="1">Tidak Emergency</option>
                                                                        <option value="2">False Emergency</option>
                                                                        <option value="3">Emergency</option>
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
                                            <div class="row text-center">
                                                <div class="col-sm-6 col-md-4 m-4">
                                                    <div id="formaddarmqrcode1" class="qrcode-class"></div>
                                                    <div id="formaddarmsigner1"></div>
                                                </div>
                                                <div class="col-sm-6 col-md-4 m-4">
                                                    <div id="formaddarmqrcode2" class="qrcode-class"></div>
                                                    <div id="formaddarmsigner2"></div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-4-->
                                    </div><!--./row-->
                                </div><!--./col-md-12-->
                            </div><!--./row-->
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <?php if (user()->checkPermission("assessmentmedis", "u")) {
                    if (true) { ?>
                        <button type="button" id="formeditarm" name="editrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                <?php }
                } ?>
                <?php if (user()->checkPermission("assessmentmedis", "c") || user()->checkPermission("assessmentmedis", "c")) {
                    if (true) { ?>
                        <button type="button" id="formsavearmbtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                        <button type="button" id="formsignarm" name="signrm" onclick="signarm(1)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign Dokter</span></button>
                <?php }
                } ?>
                <?php if (user()->checkRoles(['perawat', 'dokter'])) {
                ?>
                    <button type="button" id="formsignarm2" name="signrm" onclick="signarm(2)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign Pasien/Keluarga</span></button>
                <?php
                } ?>
                <?php if (user()->checkPermission("assessmentmedis", "d") && user()->checkRoles(['superuser'])) {
                    if (true) { ?>
                        <button type="button" id="formdeletearm" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> <span>Remove & Duplicate</span></button>
                <?php }
                } ?>
                <?php if (user()->checkPermission("assessmentmedis", "d") && user()->checkRoles(['superuser'])) {
                    if (true) { ?>
                        <button type="button" id="formdeleteonlyarm" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> <span>Remove</span></button>
                <?php }
                } ?>
                <button type="button" id="formcetakarm" name="" onclick="cetakAssessmentMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fas fa-file"></i> <span>Cetak</span></button>
            </div>
        </div>
    </div>
</div>