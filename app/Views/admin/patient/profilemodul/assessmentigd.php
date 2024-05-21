<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
    table.table-fit {
        width: auto !important;
        table-layout: auto !important;
    }

    table.table-fit thead th,
    table.table-fit tfoot th {
        width: auto !important;
    }

    table.table-fit tbody td,
    table.table-fit tfoot td {
        width: auto !important;
    }
</style>
<div class="tab-pane" id="assessmentigd" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->

        <div class="col-lg-9 col-md-9 col-sm-12 mt-4">
            <div id="arpAddDocument" class="box-tab-tools text-center">
                <a data-toggle="modal" onclick="initialAddArp()" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
            </div>
            <div id="arpDocument" class="card border-1 rounded-4 m-4 p-4" style="display: none">
                <div class="card-body">
                    <form id="formaddarp" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <input type="hidden" id="arpbody_id" name="body_id">
                        <input type="hidden" id="arporg_unit_code" name="org_unit_code">
                        <input type="hidden" id="arppasien_diagnosa_id" name="pasien_diagnosa_id">
                        <!-- <input type="hidden" id="arpdiagnosa_id" name="diagnosa_id"> -->
                        <input type="hidden" id="arpno_registration" name="no_registration">
                        <input type="hidden" id="arpvisit_id" name="visit_id">
                        <input type="hidden" id="arptrans_id" name="trans_id" value="<?= $visit['trans_id']; ?>">
                        <input type="hidden" id="arpbill_id" name="bill_id">
                        <input type="hidden" id="arpclass_room_id" name="class_room_id">
                        <input type="hidden" id="arpbed_id" name="bed_id">
                        <input type="hidden" id="arpin_date" name="in_date">
                        <input type="hidden" id="arpexit_date" name="exit_date">
                        <input type="hidden" id="arpkeluar_id" name="keluar_id">
                        <input type="hidden" id="arpimt_score" name="imt_score">
                        <input type="hidden" id="arpimt_desc" name="imt_desc">
                        <input type="hidden" id="arpgcs_e" name="gcs_e">
                        <input type="hidden" id="arpgcs_v" name="gcs_v">
                        <input type="hidden" id="arpgcs_m" name="gcs_m">
                        <input type="hidden" id="arpgcs_score" name="gcs_score">
                        <input type="hidden" id="arpgcs_desc" name="gcs_desc">
                        <input type="hidden" id="arpalo_anamnase" name="alo_anamnase">
                        <input type="hidden" id="arppemeriksaan" name="pemeriksaan">
                        <input type="hidden" id="arpteraphy_desc" name="teraphy_desc">
                        <input type="hidden" id="arpinstruction" name="instruction">
                        <input type="hidden" id="arpmedical_treatment" name="medical_treatment">
                        <input type="hidden" id="arpmodified_date" name="modified_date">
                        <input type="hidden" id="arpmodified_by" name="modified_by">
                        <input type="hidden" id="arpmodified_from" name="modified_from">
                        <input type="hidden" id="arpstatus_pasien_id" name="status_pasien_id">
                        <input type="hidden" id="arpageyear" name="ageyear">
                        <input type="hidden" id="arpagemonth" name="agemonth">
                        <input type="hidden" id="arpageday" name="ageday">
                        <input type="hidden" id="arpthename" name="thename">
                        <input type="hidden" id="arptheaddress" name="theaddress">
                        <input type="hidden" id="arptheid" name="theid">
                        <input type="hidden" id="arpisrj" name="isrj">
                        <input type="hidden" id="arpgender" name="gender">
                        <input type="hidden" id="arpdoctor" name="doctor">
                        <input type="hidden" id="arpkal_id" name="kal_id">
                        <input type="hidden" id="arppetugas_id" name="petugas_id">
                        <input type="hidden" id="arppetugas" name="petugas">
                        <input type="hidden" id="arpaccount_id" name="account_id">
                        <input type="hidden" id="arpkesadaran" name="kesadaran">
                        <input type="hidden" id="arpisvalid" name="isvalid">
                        <div class="row">
                            <h3>Assessment Keperawatan</h3>
                            <hr>
                            <div class="col-md-12">
                                <div class="dividerhr"></div>
                            </div><!--./col-md-12-->
                            <div class="row">
                                <div class="col-sm-2 col-xs-12">
                                    <h5 class="font-size-14 mb-4 badge bg-primary">Dokumen Assessment:</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="arpexamination_date">Tanggal Assessmennt</label>
                                            <input name="examination_date" id="arpexamination_date" type="datetime-local" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="arpclinic_id">Poli</label>
                                            <select name="clinic_id" id="arpclinic_id" type="hidden" class="form-control ">
                                                <option value="<?= $visit['clinic_id']; ?>"><?= $visit['name_of_clinic']; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="arpemployee_id">Dokter</label>
                                            <select name="employee_id" id="arpemployee_id" type="hidden" class="form-control ">
                                                <option value="<?= $visit['employee_id']; ?>"><?= $visit['fullname']; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 id="subjectiveGroupHeader">S:</h4>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <div class="form-group"><label id="arpanamnase_label">Keluhan Utama</label><textarea name="anamnase" id="arpanamnase" placeholder="" value="" class="form-control"></textarea></div>
                                </div>
                            </div>
                            <div id="groupRiwayat" class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="arpdescription">Riwayat Penyakit Sekarang</label>
                                            <textarea id="arpdescription" name="description" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php foreach ($aValue as $key => $value) {
                                    if ($value['p_type'] == 'GEN0009') {
                                ?>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="arp<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                    <textarea id="arp<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } ?>
                            </div>
                            <h4 id="objectiveGroupHeader">O:</h4>
                            <div class="accordion" id="accodrionExamInfo">
                                <div class="accordion-item">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingVitalSign">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVitalSign" aria-expanded="false" aria-controls="collapseVitalSign">
                                                <b>VITAL SIGN</b>
                                            </button>
                                        </h2>
                                        <div id="collapseVitalSign" class="accordion-collapse collapse" aria-labelledby="headingVitalSign" data-bs-parent="#accodrionExamInfo" style="">
                                            <div class="accordion-body text-muted">
                                                <div class="row">
                                                    <div class="row mb-4">
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>BB(Kg)</label><input onchange="vitalsignInput(this)" type="text" name="weight" id="arpweight" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Tinggi(cm)</label><input onchange="vitalsignInput(this)" type="text" name="height" id="arpheight" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Suhu(°C)</label><input onchange="vitalsignInput(this)" type="text" name="temperature" id="arptemperature" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Nadi(/menit)</label><input onchange="vitalsignInput(this)" type="text" name="nadi" id="arpnadi" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12" style="display: flex;  align-items: center;">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="arptension_upper" placeholder="" value="" class="form-control">
                                                                    <h4>/</h4>
                                                                    <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="arptension_below" placeholder="" value="" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Saturasi(SpO2%)</label><input onchange="vitalsignInput(this)" type="text" name="saturasi" id="arpsaturasi" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Nafas/RR(/menit)</label><input onchange="vitalsignInput(this)" type="text" name="nafas" id="arpnafas" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Diameter Lengan(cm)</label><input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="arparm_diameter" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group"><label>Pemeriksaan Fisik Tambahan</label><textarea name="pemeriksaan" id="arppemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 id="assessmentGroupHeader">A:</h4>
                            <div class="accordion" id="accodrionExamInfo">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingDiagnosaPerawat">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaPerawat" aria-expanded="false" aria-controls="collapseDiagnosaPerawat">
                                            <b>DIAGNOSA PERAWAT</b>
                                        </button>
                                    </h2>
                                    <div id="collapseDiagnosaPerawat" class="accordion-collapse collapse" aria-labelledby="headingDiagnosaPerawat" data-bs-parent="#accodrionAsesmen">
                                        <div class="accordion-body text-muted">
                                            <div class="row mb-2">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="mb-4">
                                                        <div class="staff-members">
                                                            <div class="table tablecustom-responsive">
                                                                <table id="tableDiagnosaPerawatMedis" class="table" data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                                                    <?php if (true) { ?>
                                                                        <thead>
                                                                            <th class="text-center" style="width: 40%">DiagnosaPerawat</th>
                                                                            <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                                            <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                                                        </thead>
                                                                        <tbody id="bodyDiagPerawat">
                                                                        </tbody>
                                                                    <?php }   ?>
                                                                </table>
                                                            </div>
                                                            <div class="box-tab-tools" style="text-align: center;">
                                                                <button type="button" id="formdiag" name="addDiagnosaPerawat" onclick="addRowDiagPerawat()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div><!--./col-md-12-->
                            <div class="panel-footer text-end mb-4">
                                <button type="button" id="formaddarpbtnid" name="save" data-loading-text="Tambah" class="btn btn-info pull-right formaddarpbtn"><i class="fa fa-check-circle"></i> <span>Tambah</span></button>
                                <button type="button" id="formsavearpbtnid" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right formsavearpbtn"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                <button type="button" id="formeditarpid" name="editrm" onclick="enableARP()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right formeditarp"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                <button type="button" id="formsignarpid" name="signrm" onclick="signArp()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignarp"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                            </div>
                        </div>
                    </form>
                    <div class="accordion" id="accodrionAssessmentAwal">


                        <?php foreach ($aParent as $key => $value) { ?>
                            <?php if ($value['parent_id'] == '001') { ?>
                                <div id="arpFallRisk_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="<?= $value['parent_id']; ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['parent_id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['parent_id']; ?>">
                                            <b><?= $value['parent_parameter']; ?></b>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <form id="formfallrisk" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Alat Ukur:</h5>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <?php foreach ($aType as $key1 => $value1) { ?>
                                                                    <?php if ($value1['parent_id'] == $value['parent_id']) {
                                                                    ?>
                                                                        <div class="form-check mb-3">
                                                                            <input class="form-check-input" type="radio" name="parameter<?= $value1['parent_id']; ?>" id="atype<?= $value1['p_type']; ?>" value=" <?= $value1['p_type']; ?>" onchange="aValueParamFallRisk('<?= $value1['parent_id']; ?>', '<?= $value1['p_type']; ?>')">
                                                                            <label class="form-check-label" for="atype<?= $value1['p_type']; ?>">
                                                                                <?= $value1['p_description']; ?>
                                                                            </label>
                                                                        </div>
                                                                    <?php
                                                                    } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Parameter 2:</h5>
                                                            </div>
                                                            <table class="col-md-12 table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Deskripsi</th>
                                                                        <th>Pilihan</th>
                                                                        <th>Score</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="bodyAssessment<?= $value['parent_id']; ?>">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="panel-footer text-end mb-4">
                                                            <button type="submit" id="formsavefallriskbtn" name="save" data-loading-text="processing" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                                            <button style="margin-right: 10px" type="button" id="historyprescbtn" onclick="" name="save" data-loading-text="processing" class="btn btn-secondary"><i class="fa fa-history"></i> <span>History</span></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($value['parent_id'] == '002') { ?>
                                <div id="arpPainMonitoring_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="<?= $value['parent_id']; ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['parent_id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['parent_id']; ?>">
                                            <b><?= $value['parent_parameter']; ?></b>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <form id="formassessmentigd" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                                                    <div class="col-md-12">
                                                        <div id="bodyPainMonitoring">
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div id="addPainMonitoringButton" class="box-tab-tools text-center">
                                                                    <a onclick="addPainMonitoring(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($value['parent_id'] == '004') { ?>
                                <div id="arpTriage_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="<?= $value['parent_id']; ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['parent_id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['parent_id']; ?>">
                                            <b><?= $value['parent_parameter']; ?></b>
                                        </button>
                                    </h2>
                                    <style>
                                        .table-striped-vertical :nth-child(odd) {
                                            /* // Specify the background color for odd rows  */
                                            /* background-color: lightblue; */
                                        }
                                    </style>
                                    <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyTriage">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addTriageButton" class="box-tab-tools text-center">
                                                                <a onclick="addTriage(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($value['parent_id'] == '005') { ?>
                                <div id="arpApgar_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="<?= $value['parent_id']; ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['parent_id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['parent_id']; ?>">
                                            <b><?= $value['parent_parameter']; ?></b>
                                        </button>
                                    </h2>
                                    <style>
                                        .table-striped-vertical :nth-child(odd) {
                                            /* // Specify the background color for odd rows  */
                                            /* background-color: lightblue; */
                                        }
                                    </style>
                                    <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyApgar">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addApgarButton" class="box-tab-tools text-center">
                                                                <a onclick="addApgar(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($value['parent_id'] == '006') {
                            ?>
                                <div id="arpGizi_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingGizi">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGizi" aria-expanded="false" aria-controls="collapseGizi">
                                            <b>SKRINING GIZI</b>
                                        </button>
                                    </h2>
                                    <div id="collapseGizi" class="accordion-collapse collapse" aria-labelledby="headingGizi" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyGizi">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addGiziButton" class="box-tab-tools text-center">
                                                                <a onclick="addGizi(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } ?>
                        <?php } ?>
                        <?php foreach ($aType as $key => $value) {
                            if ($value['p_type'] == 'ASES016') {
                        ?>
                                <div id="arpAdl_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingADL">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseADL" aria-expanded="false" aria-controls="collapseADL">
                                            <b>AKTIVITAS DAN LATIHAN</b>
                                        </button>
                                    </h2>
                                    <div id="collapseADL" class="accordion-collapse collapse" aria-labelledby="headingADL" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyADL">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addADLButton" class="box-tab-tools text-center">
                                                                <a onclick="addADL(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES047') {
                            ?>
                                <div id="arpDekubitus_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingDekubitus">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDekubitus" aria-expanded="false" aria-controls="collapseDekubitus">
                                            <b>DEKUBITUS</b>
                                        </button>
                                    </h2>
                                    <div id="collapseDekubitus" class="accordion-collapse collapse" aria-labelledby="headingDekubitus" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyDekubitus">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addDekubitusButton" class="box-tab-tools text-center">
                                                                <a onclick="addDekubitus(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'GEN0012') {
                            ?>
                                <div id="arpStabilitas_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="<?= $value['p_type']; ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['p_type']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['p_type']; ?>">
                                            <b><?= $value['p_description']; ?></b>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $value['p_type']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['p_type']; ?>" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyStabilitas">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addDerajatStabilitasButton" class="box-tab-tools text-center">
                                                                <a onclick="addDerajatStabilitas(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES049') {
                            ?>
                                <div id="arpEdukasiIntegrasi_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingEducationIntegration">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEducationIntegration" aria-expanded="false" aria-controls="collapseEducationIntegration">
                                            <b>EDUKASI INTEGRASI</b>
                                        </button>
                                    </h2>
                                    <div id="collapseEducationIntegration" class="accordion-collapse collapse" aria-labelledby="headingEducationIntegration" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyEducationIntegration">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addEducationIntegrationButton" class="box-tab-tools text-center">
                                                                <a onclick="addEducationIntegration(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'GEN0013') {
                            ?>
                                <div id="arpEdukasiForm_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingEducationForm">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEducationForm" aria-expanded="false" aria-controls="collapseEducationForm">
                                            <b>FORMULIR PEMBERIAK EDUKASI</b>
                                        </button>
                                    </h2>
                                    <div id="collapseEducationForm" class="accordion-collapse collapse" aria-labelledby="headingEducationForm" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyEducationForm">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addEducationFormButton" class="box-tab-tools text-center">
                                                                <a onclick="addEducationForm(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'GEN0011') {
                            ?>
                                <div id="arpGcs_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingGcs">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGcs" aria-expanded="false" aria-controls="collapseGcs">
                                            <b>GLASGOW COMA SCALE (GCS)</b>
                                        </button>
                                    </h2>
                                    <div id="collapseGcs" class="accordion-collapse collapse" aria-labelledby="headingGcs" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyGcs">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addGcsButton" class="box-tab-tools text-center">
                                                                <a onclick="addGcs(1,0)" class="btn btn-primary btn-lg" id="addGcsBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES036') {
                            ?>
                                <div id="arpIntegumen_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingIntegumen">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIntegumen" aria-expanded="false" aria-controls="collapseIntegumen">
                                            <b>INTEGUMEN & MOSKULO SKELETAL</b> ASES036
                                        </button>
                                    </h2>
                                    <div id="collapseIntegumen" class="accordion-collapse collapse" aria-labelledby="headingIntegumen" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyIntegumen">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addIntegumenButton" class="box-tab-tools text-center">
                                                                <a onclick="addIntegumen(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES038') {
                            ?>
                                <div id="arpNeurosensoris_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingNeurosensoris">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNeurosensoris" aria-expanded="false" aria-controls="collapseNeurosensoris">
                                            <b>NEUROSENSORIS</b>
                                        </button>
                                    </h2>
                                    <div id="collapseNeurosensoris" class="accordion-collapse collapse" aria-labelledby="headingNeurosensoris" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyNeurosensoris">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addNeurosensorisButton" class="box-tab-tools text-center">
                                                                <a onclick="addNeurosensoris(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES040') {
                            ?>
                                <div id="arpPencernaan_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingPencernaan">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencernaan" aria-expanded="false" aria-controls="collapsePencernaan">
                                            <b>PENCERNAAN</b>
                                        </button>
                                    </h2>
                                    <div id="collapsePencernaan" class="accordion-collapse collapse" aria-labelledby="headingPencernaan" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyPencernaan">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addPencernaanButton" class="box-tab-tools text-center">
                                                                <a onclick="addPencernaan(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES042') {
                            ?>
                                <div id="arpPerkemihan_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingPerkemihan">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePerkemihan" aria-expanded="false" aria-controls="collapsePerkemihan">
                                            <b>PERKEMIHAN</b>
                                        </button>
                                    </h2>
                                    <div id="collapsePerkemihan" class="accordion-collapse collapse" aria-labelledby="headingPerkemihan" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyPerkemihan">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addPerkemihanButton" class="box-tab-tools text-center">
                                                                <a onclick="addPerkemihan(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES041') {
                            ?>
                                <div id="arpPernapasan_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingPernapasan">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePernapasan" aria-expanded="false" aria-controls="collapsePernapasan">
                                            <b>PERNAPASAN</b>
                                        </button>
                                    </h2>
                                    <div id="collapsePernapasan" class="accordion-collapse collapse" aria-labelledby="headingPernapasan" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyPernapasan">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addPernapasanButton" class="box-tab-tools text-center">
                                                                <a onclick="addPernapasan(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES035') {
                            ?>
                                <div id="arpPsikologi_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingPsikologi">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePsikologi" aria-expanded="false" aria-controls="collapsePsikologi">
                                            <b>PSIKOLOGI SPIRITUAL</b>
                                        </button>
                                    </h2>
                                    <div id="collapsePsikologi" class="accordion-collapse collapse" aria-labelledby="headingPsikologi" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyPsikologi">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addPsikologiButton" class="box-tab-tools text-center">
                                                                <a onclick="addPsikologi(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES043') {
                            ?>
                                <div id="arpSeksual_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingSeksual">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeksual" aria-expanded="false" aria-controls="collapseSeksual">
                                            <b>SEKSUAL/REPRODUKSI</b>
                                        </button>
                                    </h2>
                                    <div id="collapseSeksual" class="accordion-collapse collapse" aria-labelledby="headingSeksual" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodySeksual">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addSeksualButton" class="box-tab-tools text-center">
                                                                <a onclick="addSeksual(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES039') {
                            ?>
                                <div id="arpSirkulasi_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingSirkulasi">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSirkulasi" aria-expanded="false" aria-controls="collapseSirkulasi">
                                            <b>SIRKULASI</b>
                                        </button>
                                    </h2>
                                    <div id="collapseSirkulasi" class="accordion-collapse collapse" aria-labelledby="headingSirkulasi" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodySirkulasi">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addSirkulasiButton" class="box-tab-tools text-center">
                                                                <a onclick="addSirkulasi(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES037') {
                            ?>
                                <div id="arpSocial_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingSocial">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSocial" aria-expanded="false" aria-controls="collapseSocial">
                                            <b>SOCIAL ECONOMY</b>
                                        </button>
                                    </h2>
                                    <div id="collapseSocial" class="accordion-collapse collapse" aria-labelledby="headingSocial" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodySocial">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addSocialButton" class="box-tab-tools text-center">
                                                                <a onclick="addSocial(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES044') {
                            ?>
                                <div id="arpHearing_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingHearing">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHearing" aria-expanded="false" aria-controls="collapseHearing">
                                            <b>THT & MATA</b>
                                        </button>
                                    </h2>
                                    <div id="collapseHearing" class="accordion-collapse collapse" aria-labelledby="headingHearing" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodyHearing">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addHearingButton" class="box-tab-tools text-center">
                                                                <a onclick="addHearing(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($value['p_type'] == 'ASES046') {
                            ?>
                                <div id="arpSleeping_Group" class="accordion-item">
                                    <h2 class="accordion-header" id="headingSleeping">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSleeping" aria-expanded="false" aria-controls="collapseSleeping">
                                            <b>TIDUR DAN ISTIRAHAT</b>
                                        </button>
                                    </h2>
                                    <div id="collapseSleeping" class="accordion-collapse collapse" aria-labelledby="headingSleeping" data-bs-parent="#accodrionAssessmentAwal" style="">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="bodySleeping">
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div id="addSleepingButton" class="box-tab-tools text-center">
                                                                <a onclick="addSleeping(1,0)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } ?>
                        <div id="arpTindakanKolaboratif_Group" class="accordion-item">
                            <h2 class="accordion-header" id="tindakanPerawat">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTindakanPerawat" aria-expanded="true" aria-controls="collapseTindakanPerawat">
                                    <b>TINDAKAN KOLABORATIF</b>
                                </button>
                            </h2>
                            <div id="collapseTindakanPerawat" class="accordion-collapse collapse" aria-labelledby="tindakanPerawat" data-bs-parent="#accodrionAssessmentAwal" style="">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="form1" action="" method="post" class="">
                                                <div class="box-body row mt-4">
                                                    <input type="hidden" name="ci_csrf_token" value="">
                                                    <div class="col-sm-12 col-md-12 mb-4">
                                                        <div class="row">
                                                            <div class="col-md-8"><select id="searchTarifPerawat" class="form-control" style="width: 100%"></select></div>
                                                            <div class="col-md-4">
                                                                <div class="box-tab-tools">
                                                                    <a data-toggle="modal" onclick='addBillChargePerawat("searchTarifPerawat", 1, 1)' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if (isset($permissions['tindakanpoli']['c'])) {
                                                            if ($permissions['tindakanpoli']['c'] == '1') { ?>
                                                                <div class="row">
                                                                    <div class="col-md-8"><select id="searchTarif" class="form-control" style="width: 100%"></select></div>
                                                                    <div class="col-md-4">
                                                                        <div class="box-tab-tools">
                                                                            <a data-toggle="modal" onclick='addBillChargePerawat("searchTarif")' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="table-responsive">
                                                <style>
                                                    th {
                                                        width: 200px;
                                                    }

                                                    #chargesBody td {
                                                        text-align: center;
                                                    }

                                                    #chargesBody p {
                                                        color: cadetblue;
                                                    }
                                                </style>
                                                <div class="table-rep-plugin">
                                                    <div class="table-responsive mb-0">
                                                        <form id="formchargesBodyPerawat" action="" method="post" class="">
                                                            <table class="table table-sm table-hover">
                                                                <thead class="table-primary" style="text-align: center;">
                                                                    <tr>
                                                                        <th class="text-center" rowspan="2" style="width: 2%;">No.</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 10%;">Tgl Tindakan</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: auto;">Prosedur Non Tarif</th class="text-center">
                                                                        <!-- <th class="text-center" rowspan="2">Cetak</th class="text-center"> -->
                                                                        <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 5%;">Jml</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan</th class="text-center">
                                                                        <th class="text-center" rowspan="2"></th class="text-center">
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="chargesBodyPerawat" class="table-group-divider">
                                                                    <?php
                                                                    $total = 0;
                                                                    ?>
                                                                </tbody>
                                                                <tfoot class="table-group-divider">
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-6"></div>
                                                                                <label for="tagihan_total" class="col-sm-3 col-form-label text-end"><?php echo "Total" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="tagihan_total" name="tagihan_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="subsidi_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Subsidi/Tanggungan/Piutang Pihak Ketiga" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="subsidi_total" name="subsidi_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="potongan_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Potongan" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="potongan_total" name="potongan_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="pembulatan_total" class="col-sm-4 col-form-label text-end"><?php echo "Pembulatan" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="pembulatan_total" name="pembulatan_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="pelunasan_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Pelunasan/Angsuran/Titipan/Deposit" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="pelunasan_total" name="pelunasan_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="pembayaran_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Retur Pembayaran" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="pembayaran_total" name="pembayaran_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="totalnya" class="col-sm-4 col-form-label text-end">
                                                                                    <h3><?php echo "Tagihan" . " : " . $currency_symbol . ""; ?></h3>
                                                                                </label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control border border-primary border-3 text-end" id="totalnya" name="totalnya" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="inacbg" class="col-sm-4 col-form-label text-end"><?php echo "Tarif INACBG" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="inacbg" name="inacbg" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="arpTindakanMandiri_Group" class="accordion-item">
                            <h2 class="accordion-header" id="tindakanPerawatMandiri">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTindakanPerawatMandiri" aria-expanded="true" aria-controls="collapseTindakanPerawatMandiri">
                                    <b>TINDAKAN MANDIRI</b>
                                </button>
                            </h2>
                            <div id="collapseTindakanPerawatMandiri" class="accordion-collapse collapse" aria-labelledby="tindakanPerawatMandiri" data-bs-parent="#accodrionAssessmentAwal" style="">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="form1" action="" method="post" class="">
                                                <div class="box-body row mt-4">
                                                    <input type="hidden" name="ci_csrf_token" value="">
                                                    <div class="col-sm-12 col-md-12 mb-4">
                                                        <div class="row">
                                                            <div class="col-md-8"><select id="searchTarifPerawatMandiri" class="form-control" style="width: 100%"></select></div>
                                                            <div class="col-md-4">
                                                                <div class="box-tab-tools">
                                                                    <a data-toggle="modal" onclick='addBillChargePerawat("searchTarifPerawatMandiri", 2, 1)' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if (isset($permissions['tindakanpoli']['c'])) {
                                                            if ($permissions['tindakanpoli']['c'] == '1') { ?>
                                                                <div class="row">
                                                                    <div class="col-md-8"><select id="searchTarif" class="form-control" style="width: 100%"></select></div>
                                                                    <div class="col-md-4">
                                                                        <div class="box-tab-tools">
                                                                            <a data-toggle="modal" onclick='addBillChargePerawat("searchTarif")' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="table-responsive">
                                                <style>
                                                    th {
                                                        width: 200px;
                                                    }

                                                    #chargesBody td {
                                                        text-align: center;
                                                    }

                                                    #chargesBody p {
                                                        color: cadetblue;
                                                    }
                                                </style>
                                                <div class="table-rep-plugin">
                                                    <div class="table-responsive mb-0">
                                                        <form id="formchargesBodyPerawatMandiri" action="" method="post" class="">
                                                            <table class="table table-sm table-hover">
                                                                <thead class="table-primary" style="text-align: center;">
                                                                    <tr>
                                                                        <th class="text-center" rowspan="2" style="width: 2%;">No.</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 10%;">Tgl Tindakan</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: auto;">Prosedur Non Tarif</th class="text-center">
                                                                        <!-- <th class="text-center" rowspan="2">Cetak</th class="text-center"> -->
                                                                        <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 5%;">Jml</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan</th class="text-center">
                                                                        <th class="text-center" rowspan="2"></th class="text-center">
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="chargesBodyPerawatMandiri" class="table-group-divider">
                                                                    <?php
                                                                    $total = 0;
                                                                    ?>
                                                                </tbody>
                                                                <tfoot class="table-group-divider">
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-6"></div>
                                                                                <label for="tagihan_total" class="col-sm-3 col-form-label text-end"><?php echo "Total" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="tagihan_total" name="tagihan_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="subsidi_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Subsidi/Tanggungan/Piutang Pihak Ketiga" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="subsidi_total" name="subsidi_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="potongan_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Potongan" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="potongan_total" name="potongan_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="pembulatan_total" class="col-sm-4 col-form-label text-end"><?php echo "Pembulatan" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="pembulatan_total" name="pembulatan_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="pelunasan_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Pelunasan/Angsuran/Titipan/Deposit" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="pelunasan_total" name="pelunasan_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="pembayaran_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Retur Pembayaran" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="pembayaran_total" name="pembayaran_total" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="totalnya" class="col-sm-4 col-form-label text-end">
                                                                                    <h3><?php echo "Tagihan" . " : " . $currency_symbol . ""; ?></h3>
                                                                                </label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control border border-primary border-3 text-end" id="totalnya" name="totalnya" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan='11' class="align_right">
                                                                            <div class="row">
                                                                                <div class="col-sm-5"></div>
                                                                                <label for="inacbg" class="col-sm-4 col-form-label text-end"><?php echo "Tarif INACBG" . " : " . $currency_symbol . ""; ?></label>
                                                                                <div class="col-sm-3">
                                                                                    <input type="text" class="form-control text-end" id="inacbg" name="inacbg" placeholder="" disabled></input>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="arpImplementasi_Group" class="accordion-item">
                            <h2 class="accordion-header" id="tindakanPerawatImplementasi">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTindakanPerawatImplementasi" aria-expanded="true" aria-controls="collapseTindakanPerawatImplementasi">
                                    <b>IMPLEMENTASI KEPERAWATAN</b>
                                </button>
                            </h2>
                            <div id="collapseTindakanPerawatImplementasi" class="accordion-collapse collapse" aria-labelledby="tindakanPerawatImplementasi" data-bs-parent="#accodrionAssessmentAwal" style="">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="form1" action="" method="post" class="">
                                                <div class="box-body row mt-4">
                                                    <input type="hidden" name="ci_csrf_token" value="">
                                                    <div class="col-sm-12 col-md-12 mb-4">
                                                        <div class="row">
                                                            <div class="col-md-8"><select id="searchTarifPerawatImplementasi" class="form-control" style="width: 100%"></select></div>
                                                            <div class="col-md-4">
                                                                <div class="box-tab-tools">
                                                                    <a data-toggle="modal" onclick='addBillChargePerawat("searchTarifPerawatImplementasi", 3, 1)' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if (isset($permissions['tindakanpoli']['c'])) {
                                                            if ($permissions['tindakanpoli']['c'] == '1') { ?>
                                                                <div class="row">
                                                                    <div class="col-md-8"><select id="searchTarif" class="form-control" style="width: 100%"></select></div>
                                                                    <div class="col-md-4">
                                                                        <div class="box-tab-tools">
                                                                            <a data-toggle="modal" onclick='addBillChargePerawat("searchTarif")' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="table-responsive">
                                                <style>
                                                    th {
                                                        width: 200px;
                                                    }

                                                    #chargesBody td {
                                                        text-align: center;
                                                    }

                                                    #chargesBody p {
                                                        color: cadetblue;
                                                    }
                                                </style>
                                                <div class="table-rep-plugin">
                                                    <div class="table-responsive mb-0">
                                                        <form id="formchargesBodyPerawatImplementasi" action="" method="post" class="">
                                                            <table class="table table-sm table-hover">
                                                                <thead class="table-primary" style="text-align: center;">
                                                                    <tr>
                                                                        <th class="text-center" rowspan="2" style="width: 2%;">No.</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 10%;">Tgl Tindakan</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: auto;">Prosedur Non Tarif</th class="text-center">
                                                                        <!-- <th class="text-center" rowspan="2">Cetak</th class="text-center"> -->
                                                                        <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 5%;">Jml</th class="text-center">
                                                                        <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan</th class="text-center">
                                                                        <th class="text-center" rowspan="2"></th class="text-center">
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="chargesBodyPerawatImplementasi" class="table-group-divider">
                                                                </tbody>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="cetakprintKeperawatan">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseprintKeperawatan" aria-expanded="true" aria-controls="collapseprintKeperawatan">
                                    <b>CETAK KEPERAWATAN</b>
                                </button>
                            </h2>
                            <div id="collapseprintKeperawatan" class="accordion-collapse collapse" aria-labelledby="printKeperawatan" data-bs-parent="#accodrionAssessmentAwal">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul id="keperawatanListLinkAll" class="list-group list-group-flush">
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
                    <!-- <div class="panel-footer text-end mb-4">
                        <button type="button" id="formaddarpbtn" name="save" data-loading-text="Tambah" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <span>Tambah</span></button>
                        <button type="button" id="formsavearpbtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                        <button type="button" id="formeditarp" name="editrm" onclick="enableARP()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                        <button type="button" id="formsignarp" name="signrm" onclick="signArp()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                    </div> -->
                </div>
            </div>
        </div>
        <h3>Histori Assessmen Keperawatan</h3>
        <table class="table table-striped table-hover">
            <thead class="table-primary" style="text-align: center;">
                <tr>
                    <th></th>
                    <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                    <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                    <th class="text-center" colspan="2" style="width: 70%;">SOAP</th class="text-center">
                </tr>
            </thead>
            <tbody id="assessmentKeperawatanHistoryBody">
                <?php
                $total = 0;

                ?>


            </tbody>

        </table>
    </div><!--./row-->

</div>
<!-- -->

<div class="modal fade" id="addEducationListPlan" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
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
                <form id="formEducationIntegrationPlan" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">

                    <input name="body_id" id="eduplanbody_id" type="hidden" class="form-control" />
                    <input name="plan_ke" id="eduplanplan_ke" type="hidden" class="form-control" />
                    <input name="p_type" id="eduplanp_type" type="hidden" class="form-control" />


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-header border-b mb-10 pl-0 pt0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Tambah List Perencanaan Edukasi</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <div class="form-group"><label for="employee_id">Materi Edukasi</label>
                                    <div class="row p-3">
                                        <div class="col-md-6 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_material" id="eduplaneducation_material1" checked="" value="1">
                                            <label class="form-check-label" for="formRadios1">
                                                Pilih Material
                                            </label>
                                        </div>
                                        <div class=" col-md-6 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_material" id="eduplaneducation_material2" checked="" value="2">
                                            <label class="form-check-label" for="formRadios1">
                                                Tulis Bebas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group"><label>Judul Edukasi</label>
                                    <select type="text" name="treatment_type" id="eduplantreatment_type" placeholder="" value="" class="form-control">
                                        <option value="1">Pengertian penyakit</option>
                                        <option value="2">Gizi</option>
                                        <option value="3">Farmasi</option>
                                        <option value="4">Rehabilitasi Medik</option>
                                        <option value="5">Nyeri dan Manajemen Nyeri</option>
                                        <option value="6">Pencegahan dan Pengendalian Infeksi</option>
                                        <option value="7">Pelayanan Saat Pelayanan di RS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-2"><label>Taggal Edukasi</label><input type="datetime-local" name="examination_date" id="eduplanexamination_date" placeholder="" value="" class="form-control"></div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group"><label for="employee_id">Pemberian Edukasi</label>
                                    <div class="row p-3">
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provision" checked="" value="1">
                                            <label class="form-check-label" for="eduplan">
                                                Perawat
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provision" checked="" value="2">
                                            <label class="form-check-label" for="eduplan">
                                                Dokter
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provision" checked="" value="3">
                                            <label class="form-check-label" for="eduplan">
                                                Ahli Gizi
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provision" checked="" value="4">
                                            <label class="form-check-label" for="eduplan">
                                                Terapis
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provision" checked="" value="5">
                                            <label class="form-check-label" for="eduplan">
                                                Bidan
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaeducation_provisionn" checked="" value="6">
                                            <label class="form-check-label" for="eduplan">
                                                Lain-lain
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label for="employee_id">Sasaran Edukasi</label>
                                    <div class="row p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_target" id="eduplaneducation_target1" checked="" value="1">
                                            <label class="form-check-label" for="eduplan">
                                                Pasien
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_target" id="eduplaneducation_target2" checked="" value="2">
                                            <label class="form-check-label" for="eduplan">
                                                Dokter
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_target" id="eduplaneducation_target3" checked="" value="3">
                                            <label class="form-check-label" for="eduplan">
                                                Ahli Gizi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label for="employee_id">Metode Edukasi</label>
                                    <div class="row p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" id="eduplaneducation_method" checked="">
                                            <label class="form-check-label" for="eduplan">
                                                Leaflet
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" id="eduplaneducation_method" checked="">
                                            <label class="form-check-label" for="eduplan">
                                                Demonstrasi
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" id="eduplaneducation_method" checked="">
                                            <label class="form-check-label" for="eduplan">
                                                Wawancara
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-2"><label>Penjelasan Metode Evaluasi</label><input type="text" name="EDUCAITON_EVALUATION" id="eduplaneducaiton_evaluation" placeholder="" value="" class="form-control" onfocus="this.value=''"></div>
                            </div>
                        </div>
                    </div><!--./row-->
                    <div class="pull-right">
                        <button type="button" id="formEducationIntegrationPlanBtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-primary" onclick="saveEducationIntegrationPlan()"><?php echo lang('Word.save'); ?></button>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <div class="pull-right">
                    <button type="submit" id="formaddbill" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                </div>
            </div> -->
        </div>
    </div>
</div>
<div class="modal fade" id="addEducationListProvision" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
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
                <form id="formEducationIntegrationProvision" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">

                    <input name="body_id" id="eduprovbody_id" type="hidden" class="form-control" />
                    <input name="provision_ke" id="eduprovprovision_ke" type="hidden" class="form-control" />
                    <input name="p_type" id="eduprovp_type" type="hidden" class="form-control" />


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-header border-b mb-10 pl-0 pt0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Tambah List Perencanaan Edukasi</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <div class="form-group"><label for="">Materi Edukasi</label>
                                    <div class="row p-3">
                                        <div class="col-md-6 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_material" id="eduproveducation_material1" checked="" value="1">
                                            <label class="form-check-label" for="eduproveducation_material1">
                                                Pilih Material
                                            </label>
                                        </div>
                                        <div class=" col-md-6 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_material" id="eduproveducation_material2" checked="" value="2">
                                            <label class="form-check-label" for="eduproveducation_material2">
                                                Tulis Bebas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group"><label>Judul Edukasi</label>
                                    <select type="text" name="treatment_type" id="eduprovtreatment_type" placeholder="" value="" class="form-control">
                                        <option value="1">Pengertian penyakit</option>
                                        <option value="2">Gizi</option>
                                        <option value="3">Farmasi</option>
                                        <option value="4">Rehabilitasi Medik</option>
                                        <option value="5">Nyeri dan Manajemen Nyeri</option>
                                        <option value="6">Pencegahan dan Pengendalian Infeksi</option>
                                        <option value="7">Pelayanan Saat Pelayanan di RS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-2">
                                    <label>Deskripsi Edukasi</label>
                                    <textarea type="datetime-local" name="education_desc" id="eduproveducation_desc" placeholder="" value="" class="form-control">
                                        </textarea>
                                </div>
                                <script>
                                    tinymce.init({
                                        selector: "#eduproveducation_desc",
                                        height: 300,
                                        plugins: [
                                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                            "save table contextmenu directionality emoticons template paste textcolor",
                                        ],
                                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                                        style_formats: [{
                                                title: "Bold text",
                                                inline: "b"
                                            },
                                            {
                                                title: "Red text",
                                                inline: "span",
                                                styles: {
                                                    color: "#ff0000"
                                                }
                                            },
                                            {
                                                title: "Red header",
                                                block: "h1",
                                                styles: {
                                                    color: "#ff0000"
                                                }
                                            },
                                            {
                                                title: "Example 1",
                                                inline: "span",
                                                classes: "example1"
                                            },
                                            {
                                                title: "Example 2",
                                                inline: "span",
                                                classes: "example2"
                                            },
                                            {
                                                title: "Table styles"
                                            },
                                            {
                                                title: "Table row 1",
                                                selector: "tr",
                                                classes: "tablerow1"
                                            },
                                        ],
                                    });
                                </script>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group"><label for="">Tingkat Pemahaman Awal</label>
                                    <div class="row p-3">
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="understanding_level" id="eduprovunderstanding_level1" checked="" value="1">
                                            <label class="form-check-label" for="eduprovunderstanding_level1">
                                                Sudah Mengerti
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="understanding_level" id="eduprovunderstanding_level2" checked="" value="2">
                                            <label class="form-check-label" for="eduprovunderstanding_level2">
                                                Edukasi Ulang
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="understanding_level" id="eduprovunderstanding_level3" checked="" value="3">
                                            <label class="form-check-label" for="eduprovunderstanding_level3">
                                                Hal Baru
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-2">
                                    <label>Assessment Ulang</label>
                                    <input type="checkbox" name="re_assessment" id="eduprovre_assessment" placeholder="" value="" class="form-check-input">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-2">
                                    <label>Tanggal/Jam Edukasi</label>
                                    <input type="datetime-local" name="examination_date" id="eduprovexamination_date" placeholder="" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label for="employee_id">Metode Edukasi</label>
                                    <div class="row p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" id="eduproveducation_method1" checked="" value="1">
                                            <label class="form-check-label" for="eduproveducation_method1">
                                                Leaflet
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" id="eduproveducation_method2" checked="" value="2">
                                            <label class="form-check-label" for="eduproveducation_method2">
                                                Demonstrasi
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" id="eduproveducation_method3" checked="" value="3">
                                            <label class="form-check-label" for="eduproveducation_method3">
                                                Wawancara
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label for="employee_id">Evaluasi/Verifikasi</label>
                                    <div class="row p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="evaluation" id="eduprovevaluation1" checked="" value="1">
                                            <label class="form-check-label" for="eduprovevaluation1">
                                                Sudah Mengerti
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="evaluation" id="eduprovevaluation2" checked="" value="2">
                                            <label class="form-check-label" for="eduprovevaluation2">
                                                Re-Edukasi
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="evaluation" id="eduprovevaluation3" checked="" value="3">
                                            <label class="form-check-label" for="eduprovevaluation3">
                                                Re-Demo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-2">
                                    <label>Tgl Reedukasi</label>
                                    <input type="datetime-local" name="reevaluation_date" id="eduprovreevaluation_date" placeholder="" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label for="">Re-evaluasi</label>
                                    <div class="row p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="re_evaluation" id="eduprovre_evaluation1" checked="" value="1">
                                            <label class="form-check-label" for="eduprovre_evaluation1">
                                                Leaflet
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="re_evaluation" id="eduprovre_evaluation2" checked="" value="2">
                                            <label class="form-check-label" for="eduprovre_evaluation2">
                                                Demonstrasi
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="re_evaluation" id="eduprovre_evaluation3" checked="" value="3">
                                            <label class="form-check-label" for="eduprovre_evaluation3">
                                                Wawancara
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-2"><label>Lama Edukasi</label><input type="text" name="education_duration" id="eduproveducation_duration" placeholder="" value="" class="form-control" onfocus="this.value=''"></div>
                            </div>
                        </div>
                    </div><!--./row-->
                    <div class="pull-right">
                        <button type="button" id="formEducationIntegrationProvisionBtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-primary" onclick="saveEducationIntegrationProvision()"><?php echo lang('Word.save'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>