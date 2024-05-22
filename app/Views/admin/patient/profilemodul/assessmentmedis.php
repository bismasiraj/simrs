<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>
<div class="tab-pane active" id="assessmentmedis" role="tabpanel">
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
                                    <input name="org_unit_code" id="armorg_unit_code" type="hidden" class="form-control " />
                                    <input name="visit_id" id="armvisit_id" type="hidden" class="form-control " />
                                    <input name="trans_id" id="armtrans_id" type="hidden" class="form-control " />
                                    <input name="report_date" id="armreport_date" type="hidden" class="form-control " />
                                    <input name="theid" id="armtheid" type="hidden" class="form-control " />
                                    <input name="body_id" id="armbody_id" type="hidden" class="form-control " />
                                    <input name="theaddress" id="armtheaddress" type="hidden" class="form-control " />
                                    <input name="isrj" id="armisrj" type="hidden" class="form-control " />
                                    <input name="kal_id" id="armkal_id" type="hidden" class="form-control " />
                                    <input name="spesialistik" id="armspesialistik" type="hidden" class="form-control " />
                                    <input name="doctor" id="armdoctor" type="hidden" class="form-control " />
                                    <input name="class_room_id" id="armclass_room_id" type="hidden" class="form-control " />
                                    <input name="bed_id" id="armbed_id" type="hidden" class="form-control " />
                                    <input name="result_id" id="armresult_id" type="hidden" class="form-control " />
                                    <input name="keluar_id" id="armkeluar_id" type="hidden" class="form-control " />
                                    <input name="in_date" id="armin_date" type="hidden" class="form-control " />
                                    <input name="exit_date" id="armexit_date" type="hidden" class="form-control " />
                                    <input name="modified_date" id="armmodified_date" type="hidden" class="form-control " />
                                    <input name="modified_by" id="armmodified_by" type="hidden" class="form-control " />
                                    <input name="nokartu" id="armnokartu" type="hidden" class="form-control " />
                                    <input name="pasien_diagnosa_id" id="armpasien_diagnosa_id" type="hidden" class="form-control " />
                                    <input name="no_registration" id="armno_registration" type="hidden" class="form-control " />
                                    <input name="thename" id="armthename" type="hidden" class="form-control " />
                                    <input name="status_pasien_id" id="armstatus_pasien_id" type="hidden" class="form-control " />
                                    <input name="gender" id="armgender" type="hidden" class="form-control " />
                                    <input name="ageyear" id="armageyear" type="hidden" class="form-control " />
                                    <input name="agemonth" id="armagemonth" type="hidden" class="form-control " />
                                    <input name="ageday" id="armageday" type="hidden" class="form-control " />
                                    <input name="nosep" id="armnosep" type="hidden" class="form-control " />
                                    <input name="tglsep" id="armtglsep" type="hidden" class="form-control " />
                                    <input name="kddpjp" id="armtglsep" type="hidden" class="form-control " />
                                    <input name="statusantrean" id="armstatusantrean" type="hidden" class="form-control " value="<?= $visit['statusantrean']; ?>" />
                                    <div class="row row-eq">
                                        <!-- INI CURRENT FILLING DATA -->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div id="ajax_load"></div>
                                            <div class="row">
                                                <h3>Assessment Medis</h3>
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
                                                                    <option value="<?= $visit['clinic_id']; ?>"><?= $visit['name_of_clinic']; ?></option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="armemployee_id">Dokter</label>
                                                                <select name="employee_id" id="armemployee_id" type="hidden" class="form-control ">
                                                                    <option value="<?= $visit['employee_id']; ?>"><?= $visit['fullname']; ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="accordion" id="accordionAssessmentMedis">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingSubyektif">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubyektif" aria-expanded="false" aria-controls="collapseSubyektif">
                                                                <b>ANAMNESIS</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseSubyektif" class="accordion-collapse collapse" aria-labelledby="headingSubyektif" data-bs-parent="#accordionAssessmentMedis">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armanamnase">Autoanamnesis</label>
                                                                                <textarea id="armanamnase" name="anamnase" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armalloanamnase">Alloanamnesis</label>
                                                                                <textarea id="armalloanamnase" name="alloanamnase" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingVitalSign">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVitalSign" aria-expanded="false" aria-controls="collapseVitalSign">
                                                                <b>VITAL SIGN</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseVitalSign" class="accordion-collapse collapse" aria-labelledby="headingVitalSign" data-bs-parent="#accordionAssessmentMedis">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-12 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armpemeriksaan">Vital Sign <a id="copyPeriksaFisikBtn" href="#" onclick="copyPeriksaFisik()">(Copy)</a></label>
                                                                                <textarea id="armpemeriksaan" name="pemeriksaan" rows="5" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingRiwayatMedi">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRiwayatMedi" aria-expanded="false" aria-controls="collapseRiwayatMedi">
                                                                <b>RIWAYAT</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseRiwayatMedis" class="accordion-collapse collapse" aria-labelledby="headingRiwayatMedis" data-bs-parent="#accordionAssessmentMedis" style="">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armdescription">Riwayat Penyakit Sekarang</label>
                                                                                <textarea id="armdescription" name="description" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php foreach ($aValue as $key => $value) {
                                                                        if ($value['p_type'] == 'GEN0009') {
                                                                    ?>
                                                                            <div class="col-sm-6 col-xs-12">
                                                                                <div class="mb-3">
                                                                                    <div class="form-group">
                                                                                        <label for="arm<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                                        <textarea id="arm<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    <?php
                                                                        }
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingBodyPart">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBodyPart" aria-expanded="false" aria-controls="collapseBodyPart">
                                                                <b>PEMERIKSAAN FISIK</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseBodyPart" class="accordion-collapse collapse" aria-labelledby="headingBodyPart" data-bs-parent="#accordionAssessmentMedis" style="">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row">
                                                                    <?php foreach ($aParameter as $key => $value) {
                                                                        if ($value['p_type'] == 'GEN0002')
                                                                            foreach ($aValue as $key1 => $value1) {
                                                                                if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id'] && $value1['value_score'] == '2') {
                                                                    ?>
                                                                                <div class="col-sm-6 col-xs-12">
                                                                                    <div class="mb-3">
                                                                                        <div class="form-group">
                                                                                            <label for="arm<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>"><?= $value1['value_desc']; ?></label>
                                                                                            <textarea id="arm<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>" name="fisik<?= $value1['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                    <?php
                                                                                }
                                                                            }
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="armPenunjang_Group" class="accordion-item">
                                                        <h2 class="accordion-header" id="headingPenunjang">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePenunjang" aria-expanded="false" aria-controls="collapsePenunjang">
                                                                <b>Penunjang dan Terapi</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapsePenunjang" class="accordion-collapse collapse" aria-labelledby="headingPenunjang" data-bs-parent="#accordionAssessmentMedis">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="pwd">Periksa Fisik <a id="copyPeriksaFisikBtn" href="#" onclick="copyPeriksaFisik()">(Copy)</a></label>
                                                                                <textarea id="armpemeriksaan" name="pemeriksaan" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armlab_result">Periksa Lab <a id="copyPeriksaLabBtn" href="#" onclick="copyPeriksaLab()">(Copy)</a></label>
                                                                                <textarea id="armlab_result" name="lab_result" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armro_result">Periksa RO <a id="copyPeriksaRadBtn" href="#" onclick="copyPeriksaRad()">(Copy)</a></label>
                                                                                <textarea id="armro_result" name="ro_result" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armecg_result">Periksa EKG</label>
                                                                                <textarea id="armecg_result" name="ecg_result" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armteraphy_desc">Farmakoterapi <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                                                                <textarea id="armteraphy_desc" name="teraphy_desc" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armteraphy_home">Obat Pulang <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                                                                <textarea id="armteraphy_home" name="teraphy_home" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armtherapy_target">Target Sasaran Terapi <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                                                                <textarea id="armtherapy_target" name="therapy_target" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="armDiagnosas_Group" class="accordion-item">
                                                        <h2 class="accordion-header" id="headingDiagnosa">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosa" aria-expanded="false" aria-controls="collapseDiagnosa">
                                                                <b>DIAGNOSA (ICD X)</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseDiagnosa" class="accordion-collapse collapse" aria-labelledby="headingDiagnosa" data-bs-parent="#accordionAssessmentMedis">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armmedical_problem">Permasalahan Medis <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                                                                <textarea id="armmedical_problem" name="medical_problem" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armhurt">Penyebab Cidera/Keracunan <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                                                                <textarea id="armhurt" name="hurt" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                                        <div class="mb-4">
                                                                            <div class="staff-members">
                                                                                <div class="table tablecustom-responsive">
                                                                                    <table id="tablediagnosaMedis" class="table" data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                                                                        <?php if (true) { ?>
                                                                                            <thead>
                                                                                                <th class="text-center" style="width: 40%">Diagnosa</th>
                                                                                                <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                                                                <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                                                                            </thead>
                                                                                            <tbody id="bodyDiagMedis">
                                                                                            </tbody>
                                                                                        <?php }   ?>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="box-tab-tools" style="text-align: center;">
                                                                                    <button type="button" id="formdiag" name="adddiagnosa" onclick="addRowDiagMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="armProcedures_Group" class="accordion-item">
                                                        <h2 class="accordion-header" id="headingProsedur">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProsedur" aria-expanded="false" aria-controls="collapseProsedur">
                                                                <b>PROSEDUR (ICD IX)</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseProsedur" class="accordion-collapse collapse" aria-labelledby="headingProsedur" data-bs-parent="#accordionAssessmentMedis">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-12 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="armstanding_order">Standing Order </label>
                                                                                <textarea id="armstanding_order" name="standing_order" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-xs-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group">
                                                                                <label for="arminstruction">Rencana Tindakan </label>
                                                                                <textarea id="arminstruction" name="instruction" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                                        <div class="mb-4">
                                                                            <div class="staff-members">
                                                                                <div class="table tablecustom-responsive">
                                                                                    <table id="tableprocedure" class="table table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
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
                                                                                    <button type="button" id="addprocedure" onclick="addRowProc()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Prosedur</span></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="armLokalis_Group" class="accordion-item">
                                                        <h2 class="accordion-header" id="headingLokalis">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLokalis" aria-expanded="false" aria-controls="collapseLokalis">
                                                                <b>Lokalis</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseLokalis" class="accordion-collapse collapse" aria-labelledby="headingLokalis" data-bs-parent="#accordionAssessmentMedis">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row mb-2">
                                                                    <?php foreach ($aParameter as $key => $value) {
                                                                        if ($value['p_type'] == 'GEN0002')
                                                                            foreach ($aValue as $key1 => $value1) {
                                                                                if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id'] && $value1['value_score'] == '3') {

                                                                    ?>
                                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                                    <div class="mb-4">
                                                                                        <h5 class="font-size-14 mb-4 badge bg-primary"><?= $value1['value_desc']; ?>:</h5>
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <canvas id="canvas<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>" width="450" height="450" style="border: 1px solid #000;"></canvas>
                                                                                                <input type="hidden" name="lokalis<?= $value1['value_id']; ?>" id="lokalis<?= $value1['value_id']; ?>">
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="lokalis<?= $value1['value_id']; ?>desc">Deskripsi</label>
                                                                                                    <textarea name="lokalis<?= $value1['value_id']; ?>desc" id="lokalis<?= $value1['value_id']; ?>desc" class="form-control" cols="30" rows="10"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <button id="undo<?= $value1['value_id'] ?>" class="btn btn-primary" type="button"> Undo</button>
                                                                                                <button id="clear<?= $value1['value_id'] ?>" class="btn btn-danger" type="button"> Clear</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                    <?php
                                                                                }
                                                                            }
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="arpGcsMedis_Group" class="accordion-item">
                                                        <h2 class="accordion-header" id="headingGcsMedis">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGcsMedis" aria-expanded="false" aria-controls="collapseGcs">
                                                                <b>GLASGOW COMA SCALE (GCS)</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseGcsMedis" class="accordion-collapse collapse" aria-labelledby="headingGcsMedis" data-bs-parent="#accodrionAssessmentAwal" style="">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div id="bodyGcsMedis">
                                                                        </div>
                                                                        <div class="row mb-4">
                                                                            <div class="col-md-12">
                                                                                <div id="addGcsMedisButton" class="box-tab-tools text-center">
                                                                                    <a onclick="addGcsMedis(1,0)" class="btn btn-primary btn-lg" id="addGcsMedisBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="armRtl_Group" class="accordion-item">
                                                        <h2 class="accordion-header" id="headingrtl">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRtl" aria-expanded="false" aria-controls="collapseRtl">
                                                                <b>Rencana Tindak Lanjut</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseRtl" class="accordion-collapse collapse" aria-labelledby="headingrtl" data-bs-parent="#accordionAssessmentMedis">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row mb-2">
                                                                    <div class="row">
                                                                        <div class="col-sm-4 col-md-3">
                                                                            <div class="mb-3">
                                                                                <div id="arrujukan_group" class="form-group">
                                                                                    <label>Rencana Tindak Lanjut</label>
                                                                                    <select name="rencanatl" id="arrencanatl" onchange="tindakLanjut()" class="form-control ">
                                                                                        <option value="1">Diperbolehkan Pulang</option>
                                                                                        <option value="2">Pemeriksaan Penunjang</option>
                                                                                        <option value="3">Dirujuk ke</option>
                                                                                        <option value="4">Kontrol Kembali</option>
                                                                                        <option value="5">Rawat Inap</option>
                                                                                        <option value="6">Rujuk Internal Antar Poli</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-md-3">
                                                                            <div class="mb-3">
                                                                                <div id="artiperujukan_group" class="form-group" style="display: none">
                                                                                    <label>Tipe Rujukan</label>
                                                                                    <select name="tiperujukan" id="artiperujukan" onchange="tindakLanjut()" class="form-control ">
                                                                                        <option value="1">Penuh</option>
                                                                                        <option value="2">Parsial</option>
                                                                                        <option value="3">PRB</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="ardirujukkegroup" class="col-sm-4 col-md-3" style="display: none">
                                                                            <div class="mb-3">
                                                                                <div class="form-group"><label for="diag_awal">Dirujuk Ke</label>
                                                                                    <div class="select2-full-width" style="width:100%">
                                                                                        <select class="form-control  patient_list_ajax" name='dirujukke' id="ardirujukke" style="width: 100%">
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="artgl_kontrolgroup" class="col-sm-4 col-md-3" style="display: none">
                                                                            <div class="mb-3">
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Kontrol</label>
                                                                                    <div class="input-group" id="artglkontrol">
                                                                                        <input id="artgl_kontrol" name="tgl_kontrol" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#artglkontrol' value="<?= date('Y-m-d'); ?>">

                                                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="arkdpoli_kontrolgroup" class="col-sm-4 col-md-3" style="display: none">
                                                                            <div class="mb-3">
                                                                                <div class="form-group">
                                                                                    <label>Ke Poli</label>
                                                                                    <select name="kdpoli_kontrol" id="arkdpoli_kontrol" class="form-control ">
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
                                                                        </div>
                                                                        <div id="ardescriptiongroup" class="col-sm-8 col-md-3" style="display: none">
                                                                            <div class="mb-3">
                                                                                <div class="form-group">
                                                                                    <label for="pwd">Alasan/Ket</label>
                                                                                    <textarea id="arprocedure_05" name="procedure_05" rows="1" class="form-control " autocomplete="off"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="medis">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsemedis" aria-expanded="true" aria-controls="collapsemedis">
                                                                <b>MEDIS</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapsemedis" class="accordion-collapse collapse" aria-labelledby="medis" data-bs-parent="#accodrionFormRm">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul id="medisListLinkAll" class="list-group list-group-flush">
                                                                            <input id="armpasien_diagnosa_id" type="hidden" value="asdf">
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                            <button type="button" id="formaddarmbtn" name="save" data-loading-text="Tambah" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <span>Tambah</span></button>
                                            <button type="submit" id="formsavearmbtns" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
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
                        <th class="text-center" colspan="2" style="width: 70%;">SOAP</th class="text-center">
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