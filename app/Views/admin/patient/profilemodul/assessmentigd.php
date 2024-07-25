<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
$group = user()->getRoles();
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
    <!-- <div class="tab-pane <?= isset($group[13]) || isset($group[1]) ? 'active' : '' ?>" id="assessmentigd" role="tabpanel"> -->
    <div class="row">
        <div id="loadContentAssessmentPerawat" class="col-12 center-spinner"></div>
        <div id="contentAssessmentPerawat" class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 border-r">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div><!--./col-lg-6-->
            <div class="col-lg-9 col-md-9 col-sm-12 mt-4">
                <div id="arpAddDocument" class="box-tab-tools text-center">
                    <a data-toggle="modal" onclick="initialAddArp()" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                </div>
                <div id="arpDocument" class="card border-1 rounded-4 p-4" style="display: none">
                    <form id="formaddarp" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <div class="card-body">
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
                            <input type="hidden" id="arpvalid_date" name="valid_date" value="">
                            <input type="hidden" id="arpvalid_user" name="valid_user" value="">
                            <?php csrf_field(); ?>
                            <div class="row">
                                <h3 id="arpTitle">Assessment Keperawatan</h3>
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
                                    <div class="col-md-4">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="arpvs_status_id1" value="1"><label class="form-check-label" for="arpvs_status_id1" checked>Dewasa</label></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="arpvs_status_id4" value="4"><label class="form-check-label" for="arpvs_status_id4">Neonatus</label></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="arpvs_status_id5" value="5"><label class="form-check-label" for="arpvs_status_id5">Anak</label></div>
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="acpptvs_status_id2" value="2"><label class="form-check-label" for="acpptvs_status_id2" checked>SOAP</label></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="acpptvs_status_id7" value="7"><label class="form-check-label" for="acpptvs_status_id7">SBAR</label></div>
                                    </div> -->
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
                                                <label for="arpemployee_id">Dokter</label>
                                                <select name="employee_id" id="arpemployee_id" type="hidden" class="form-control ">
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
                                <h4 id="subjectiveGroupHeader">S:</h4>
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <div class="form-group"><label id="arpanamnase_label">Keluhan Utama</label><textarea name="anamnase" id="arpanamnase" placeholder="" value="" class="form-control"></textarea></div>
                                    </div>
                                </div>
                                <div id="groupRiwayat" class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arpdescription">Riwayat Penyakit Sekarang</label>
                                                <textarea id="arpdescription" name="description" rows="2" class="form-control " autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <?php foreach ($aValue as $key => $value) {
                                        if ($value['p_type'] == 'GEN0009') {
                                            if ($value['value_score'] == '4') {
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
                                            } else if ($value['value_score'] == '2') {
                                            ?>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-check mb-3">
                                                        <input id="arp<?= $value['p_type'] . $value['value_id']; ?>" class="form-check-input" type="checkbox" name="<?= $value['value_id']; ?>" value="1">
                                                        <label class="form-check-label" for="arp<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                    </div>
                                                </div> <?php
                                                    }
                                                        ?>
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
                                                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>BB(Kg)</label>
                                                                    <div class=" position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="weight" id="arpweight" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-bb"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Tinggi(cm)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="height" id="arpheight" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arpheight"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Suhu(°C)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="temperature" id="arptemperature" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arptemperature"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                                <div class="form-group">
                                                                    <label>Nadi(/menit)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="nadi" id="arpnadi" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arpnadi"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                    <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="arptension_upper" placeholder="" value="" class="form-control">
                                                                            <span class="h6" id="badge-arptension_upper"></span>
                                                                        </div>
                                                                        <h4 class="mx-2">/</h4>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="arptension_below" placeholder="" value="" class="form-control">
                                                                            <span class="h6" id="badge-arptension_below"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Saturasi(SpO2%)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="arpsaturasi" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arpsaturasi"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Nafas/RR(/menit)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="nafas" id="arpnafas" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arpnafas"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Diameter Lengan(cm)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="arp_diameter" id="arparp_diameter" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arparp_diameter"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Penggunaan Oksigen (L/mnt)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="arpoxygen_usage" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arpoxygen_usage"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--==new -->
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Jenis EWS</label>
                                                                    <select class="form-select" name="vs_status_id" id="arpvs_status_id">
                                                                        <option value="" selected>-- pilih --</option>
                                                                        <option value="1">Dewasa</option>
                                                                        <option value="4">Anak</option>
                                                                        <option value="5">Neonatus</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--==endofnew -->
                                                            <div class="col-sm-12 mt-2">
                                                                <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="arppemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                            </div>
                                                            <!-- <div class="col-sm-12">
                                                            <div class="mb-4">
                                                                <div class="form-group"><label>Tanggal Periksa</label><textarea name="examination_date" id="arppemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                            </div>
                                                        </div> -->
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
                                                                                <th class="text-center" colspan="2">DiagnosaPerawat</th>
                                                                            </thead>
                                                                            <tbody id="bodyDiagPerawat">
                                                                            </tbody>
                                                                        <?php }   ?>
                                                                    </table>
                                                                </div>
                                                                <div class="box-tab-tools" style="text-align: center;">
                                                                    <button type="button" id="formdiag" name="addDiagnosaPerawat" onclick="addRowDiagPerawat('bodyDiagPerawat', '')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
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
                                    <button type="button" id="formcetakarp" name="" onclick="cetakAssessmenKeperawatan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fa fa-signature"></i> <span>Cetak</span></button>
                                    <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                                </div>
                            </div>
                            <div class="accordion" id="accodrionAssessmentAwal">
                                <?php foreach ($aParent as $key => $value) { ?>
                                    <?php if ($value['parent_id'] == '001') { ?>
                                        <div id="arpFallRisk_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="FallRiskPerawat">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFallRiskPerawat" aria-expanded="true" aria-controls="collapseFallRiskPerawat">
                                                    <b>RESIKO JATUH</b>
                                                </button>
                                            </h2>
                                            <div id="collapseFallRiskPerawat" class="accordion-collapse collapse" aria-labelledby="FallRiskPerawat" data-bs-parent="#accordionAssessmentPerawat" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <form id="formassessmentigd" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                                                            <div class="col-md-12">
                                                                <div id="bodyFallRiskPerawat">
                                                                </div>
                                                                <div id="bodyFallRiskPerawatAddBtn" class="col-md-12 text-center">
                                                                    <a onclick="addFallRisk(1, 0, 'arpbody_id', 'bodyFallRiskPerawat', false)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                <div id="bodyPainMonitoringPerawat">
                                                                </div>
                                                                <div id="bodyPainMonitoringPerawatAddBtn" class="col-md-12 text-center">
                                                                    <a onclick="addPainMonitoring(1, 0, 'arpbody_id', 'bodyPainMonitoringPerawat', false)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                            <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" data-bs-parent="#accodrionAssessmentAwal" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyTriagePerawat">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="bodyTriagePerawatAddBtn" class="box-tab-tools text-center">
                                                                        <a onclick="addTriage(1,0,'arpbody_id', 'bodyTriagePerawat', false)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                            <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" data-bs-parent="#accodrionAssessmentAwal" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyApgarPerawat">
                                                            </div>
                                                            <div id="bodyApgarPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addApgar(1, 0, 'arpbody_id', 'bodyApgarPerawat', false)" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                            <div id="bodyGiziPerawat">
                                                            </div>
                                                            <div id="bodyGiziPerawatAddBtn" class="col-md-12 text-center"><a onclick="addGizi(1,1, 'arpbody_id','bodyGiziPerawat')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a></div>
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
                                                            <div id="bodyADLPerawat">
                                                            </div>
                                                            <div id="bodyADLPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addADL(1,1, 'arpbody_id','bodyADLPerawat')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                            <div id="bodyDekubitusPerawat">
                                                            </div>
                                                            <div id="bodyDekubitusPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addDekubitus(1,1, 'arpbody_id','bodyDekubitusPerawat')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                            <div id="bodyStabilitasPerawat">
                                                            </div>
                                                            <div id="bodyStabilitasPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addDerajatStabilitas(1, 0, 'arpbody_id', 'bodyStabilitasPerawat')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addEducationIntegration(1,0)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                    <b>FORMULIR PEMBERIAN EDUKASI</b>
                                                </button>
                                            </h2>
                                            <div id="collapseEducationForm" class="accordion-collapse collapse" aria-labelledby="headingEducationForm" data-bs-parent="#accodrionAssessmentAwal" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyEducationFormPerawat">
                                                            </div>
                                                            <div id="bodyEducationFormPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addEducationForm(1,1, 'arpbody_id','bodyEducationFormPerawat')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                            <div id="bodyGcsPerawat">
                                                            </div>
                                                            <div id="bodyGcsPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addGcs(1,0,'arpbody_id', 'bodyGcsPerawat', false)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                    <b>INTEGUMEN & MOSKULO SKELETAL</b>
                                                </button>
                                            </h2>
                                            <div id="collapseIntegumen" class="accordion-collapse collapse" aria-labelledby="headingIntegumen" data-bs-parent="#accodrionAssessmentAwal" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyIntegumenPerawat">
                                                            </div>
                                                            <div id="bodyIntegumenPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addIntegumen(1,1, 'arpbody_id','bodyIntegumenPerawat')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES045') {
                                    ?>
                                        <div id="arpAnak_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingAnak">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAnak" aria-expanded="false" aria-controls="collapseAnak">
                                                    <b>KHUSUS ANAK</b>
                                                </button>
                                            </h2>
                                            <div id="collapseAnak" class="accordion-collapse collapse" aria-labelledby="headingAnak" data-bs-parent="#accodrionAssessmentAwal" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyAnakPerawat">
                                                            </div>
                                                            <div id="bodyAnakPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addAnak(1,1, 'arpbody_id','bodyAnakPerawat')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES050') {
                                    ?>
                                        <div id="arpNeonatus_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingNeonatus">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNeonatus" aria-expanded="false" aria-controls="collapseNeonatus">
                                                    <b>NEONATUS</b>
                                                </button>
                                            </h2>
                                            <div id="collapseNeonatus" class="accordion-collapse collapse" aria-labelledby="headingNeonatus" data-bs-parent="#accodrionAssessmentAwal" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyNeonatusPerawat">
                                                            </div>
                                                            <div id="bodyNeonatusPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addNeonatus(1,1, 'arpbody_id','bodyNeonatusPerawat')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addNeurosensoris(1,0)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addPencernaan(1,0)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addPerkemihan(1,0)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addPernapasan(1,0, 'arpbody_id', 'bodyPernapasan')" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addPsikologi(1,0)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addSeksual(1,0)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addSirkulasi(1,0,'arpbody_id', 'bodySirkulasi')" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addSocial(1,0)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addHearing(1,0)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                                                        <a onclick="addSleeping(1,0)" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                    </form>
                </div>
            </div>
            <h3>Histori Assessmen Keperawatan</h3>
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="text-align: center;">
                    <tr>
                        <th></th>
                        <th>Tanggal</th>
                        <th>Klinik/Poli</th>
                        <th class="text-center" style="width: 20%;">Subyektif</th class="text-center">
                        <th class="text-center" style="width: 20%;">Obyektif</th class="text-center">
                        <th class="text-center" style="width: 20%;">Asesmen</th class="text-center">
                        <th class="text-center" style="width: 20%;">Prosedur</th class="text-center">
                        <th></th>
                    </tr>
                </thead>
                <tbody id="assessmentKeperawatanHistoryBody">
                    <?php
                    $total = 0;
                    ?>
                </tbody>
            </table>
        </div>
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

<div class="modal fade" id="cpptModal" role="dialog" aria-labelledby="myModalLabel">
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
                <iframe id="pdfFrame" style="width:100%; height:500px;"></iframe>
            </div>
        </div>
    </div>
</div>