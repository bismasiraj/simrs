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
<div class="tab-pane" id="cppt" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12 mt-4">
            <div id="" class="box-tab-tools text-center">
                <a data-toggle="modal" onclick="initialAddacppt()" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
            </div>
            <h3>Histori CPPT</h3>
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="text-align: center;">
                    <tr>
                        <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                        <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                        <th class="text-center" colspan="6" style="width: 70%;">SOAP</th class="text-center">
                        <th class="text-center" style="width: 5%;"></th class="text-center">
                        <th class="text-center" style="width: 5%;"></th class="text-center">
                    </tr>

                </thead>
                <tbody id="cpptBody">
                    <?php
                    $total = 0;

                    ?>


                </tbody>

            </table>
        </div>
    </div><!--./row-->

</div>
<!-- -->

<div class="modal fade" id="cpptModal" role="dialog" aria-labelledby="myModalLabel">
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
                <div id="acpptDocument" class="border-1 rounded-4 mb-4 p-4" style="">
                    <div class="">
                        <form id="formaddacppt" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                            <input type="hidden" id="acpptbody_id" name="body_id">
                            <input type="hidden" id="acpptorg_unit_code" name="org_unit_code">
                            <input type="hidden" id="acpptpasien_diagnosa_id" name="pasien_diagnosa_id">
                            <input type="hidden" id="acpptno_registration" name="no_registration">
                            <input type="hidden" id="acpptvisit_id" name="visit_id">
                            <input type="hidden" id="acppttrans_id" name="trans_id" value="<?= $visit['trans_id']; ?>">
                            <input type="hidden" id="acpptbill_id" name="bill_id">
                            <input type="hidden" id="acpptclass_room_id" name="class_room_id">
                            <input type="hidden" id="acpptbed_id" name="bed_id">
                            <input type="hidden" id="acpptin_date" name="in_date">
                            <input type="hidden" id="acpptexit_date" name="exit_date">
                            <input type="hidden" id="acpptkeluar_id" name="keluar_id">
                            <input type="hidden" id="acpptimt_score" name="imt_score">
                            <input type="hidden" id="acpptimt_desc" name="imt_desc">
                            <input type="hidden" id="acpptpemeriksaan" name="pemeriksaan">
                            <input type="hidden" id="acpptmedical_treatment" name="medical_treatment">
                            <input type="hidden" id="acpptmodified_date" name="modified_date">
                            <input type="hidden" id="acpptmodified_by" name="modified_by">
                            <input type="hidden" id="acpptmodified_from" name="modified_from">
                            <input type="hidden" id="acpptstatus_pasien_id" name="status_pasien_id">
                            <input type="hidden" id="acpptageyear" name="ageyear">
                            <input type="hidden" id="acpptagemonth" name="agemonth">
                            <input type="hidden" id="acpptageday" name="ageday">
                            <input type="hidden" id="acpptthename" name="thename">
                            <input type="hidden" id="acppttheaddress" name="theaddress">
                            <input type="hidden" id="acppttheid" name="theid">
                            <input type="hidden" id="acpptisrj" name="isrj">
                            <input type="hidden" id="acpptgender" name="gender">
                            <input type="hidden" id="acpptdoctor" name="doctor">
                            <input type="hidden" id="acpptkal_id" name="kal_id">
                            <input type="hidden" id="acpptpetugas_id" name="petugas_id">
                            <input type="hidden" id="acpptpetugas" name="petugas">
                            <input type="hidden" id="acpptaccount_id" name="account_id">
                            <input type="hidden" id="acpptkesadaran" name="kesadaran">
                            <input type="hidden" id="acpptisvalid" name="isvalid">

                            <div class="row">
                                <h3 id="acpptTitle">CPPT</h3>
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
                                    <div class="col-md-3">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="acpptvs_status_id2" value="2"><label class="form-check-label" for="acpptvs_status_id2" checked>SOAP</label></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="acpptvs_status_id7" value="7"><label class="form-check-label" for="acpptvs_status_id7">SBAR</label></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="acpptexamination_date">Tanggal Assessmennt</label>
                                                <input name="examination_date" id="acpptexamination_date" type="datetime-local" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="acpptclinic_id">Poli</label>
                                                <select name="clinic_id" id="acpptclinic_id" type="hidden" class="form-control ">
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
                                                <label for="acpptemployee_id">Dokter</label>
                                                <select name="employee_id" id="acpptemployee_id" type="hidden" class="form-control ">
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
                                <!-- <h4 id="assessmentGroupHeader">A:</h4> -->
                                <div class="accordion" id="accordionSOAP">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSubyektif">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubyektif" aria-expanded="false" aria-controls="collapseSubyektif">
                                                <b id="cpptSubyektifTitle">SUBYEKTIF (S)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseSubyektif" class="accordion-collapse collapse" aria-labelledby="headingSubyektif" data-bs-parent="#accordionSOAP" style="">
                                            <div class="accordion-body text-muted">
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="acpptanamnase_label">Keluhan Utama</label><textarea name="anamnase" id="acpptanamnase" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                                <div id="groupRiwayatCppt" class="row" style="display: none;">
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="acpptdescription">Riwayat Penyakit Sekarang</label>
                                                                <textarea id="acpptdescription" name="description" rows="2" class="form-control " autocomplete="off"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php foreach ($aValue as $key => $value) {
                                                        if ($value['p_type'] == 'GEN0009') {
                                                    ?>
                                                            <div class="col-sm-6 col-xs-12">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label for="acppt<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                        <textarea id="acppt<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
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
                                        <h2 class="accordion-header" id="headingVitalSign">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVitalSign" aria-expanded="false" aria-controls="collapseVitalSign">
                                                <b id="cpptObyektifTitle">OBYEKTIF (O)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseVitalSign" class="accordion-collapse collapse" aria-labelledby="headingVitalSign" data-bs-parent="#accordionSOAP" style="">
                                            <div class="accordion-body text-muted">
                                                <div id="groupVitalSignCppt" class="row">
                                                    <div class="row mb-4">
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>BB(Kg)</label><input onchange="vitalsignInput(this)" type="text" name="weight" id="acpptweight" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Tinggi(cm)</label><input onchange="vitalsignInput(this)" type="text" name="height" id="acpptheight" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Suhu(°C)</label><input onchange="vitalsignInput(this)" type="text" name="temperature" id="acppttemperature" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Nadi(/menit)</label><input onchange="vitalsignInput(this)" type="text" name="nadi" id="acpptnadi" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12" style="display: flex;  align-items: center;">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="acppttension_upper" placeholder="" value="" class="form-control">
                                                                    <h4>/</h4>
                                                                    <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="acppttension_below" placeholder="" value="" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Saturasi(SpO2%)</label><input onchange="vitalsignInput(this)" type="text" name="saturasi" id="acpptsaturasi" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Nafas/RR(/menit)</label><input onchange="vitalsignInput(this)" type="text" name="nafas" id="acpptnafas" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-2 mt-2">
                                                            <div class="form-group"><label>Diameter Lengan(cm)</label><input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="acpptarm_diameter" placeholder="" value="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group"><label>Pemeriksaan Fisik Tambahan</label><textarea name="pemeriksaan" id="acpptpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="acpptalo_anamnase_label">Catatan Obyektif</label><textarea name="alo_anamnase" id="acpptalo_anamnase" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingDiagnosaPerawat">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaPerawat" aria-expanded="false" aria-controls="collapseDiagnosaPerawat">
                                                <b id="cpptAssessmentTitle">ASESMEN (A)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseDiagnosaPerawat" class="accordion-collapse collapse" aria-labelledby="headingDiagnosaPerawat" data-bs-parent="#accordionSOAP">
                                            <div class="accordion-body text-muted">
                                                <div id="groupDiagnosaPerawatCppt" class="row mb-2" <?= isset($group[11]) ? 'style="display: none"' : '' ?>>
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
                                                                            <tbody id="bodyDiagPerawatCppt">
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
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="acpptteraphy_desc_label">Catatan Asesmen</label><textarea name="teraphy_desc" id="acpptteraphy_desc" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingPlanning">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePlanning" aria-expanded="false" aria-controls="collapsePlanning">
                                                <b id="cpptPlanningTitle">PLANNING (P)</b>
                                            </button>
                                        </h2>
                                        <div id="collapsePlanning" class="accordion-collapse collapse" aria-labelledby="headingPlanning" data-bs-parent="#accordionSOAP">
                                            <div class="accordion-body text-muted">
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="acpptinstruction_label">Catatan Planning</label><textarea name="instruction" id="acpptinstruction" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                                <script>
                                                    tinymce.init({
                                                        selector: "#acpptinstruction",
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div><!--./col-md-12-->
                                <div class="panel-footer text-end mb-4">
                                    <button type="button" id="formaddacpptbtnid" name="save" data-loading-text="Tambah" class="btn btn-info pull-right formaddacpptbtn" style="display: none"><i class="fa fa-check-circle"></i> <span>Tambah</span></button>
                                    <button type="button" id="formsaveacpptbtnid" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right formsaveacpptbtn"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                    <button type="button" id="formeditacpptid" name="editrm" onclick="enableacppt()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right formeditacppt"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                    <button type="button" id="formsignacpptid" name="signrm" onclick="signacppt()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignacppt"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                    <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                                </div>
                            </div>
                        </form>
                        <div class="accordion" id="accodrionCPPT">


                            <?php foreach ($aParent as $key => $value) { ?>
                                <?php if ($value['parent_id'] == '001') { ?>
                                    <div id="acpptFallRisk_Group" class="accordion-item">
                                        <h2 class="accordion-header" id="FallRiskMedis">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFallRiskMedis" aria-expanded="true" aria-controls="collapseFallRiskMedis">
                                                <b>RESIKO JATUH</b>
                                            </button>
                                        </h2>
                                        <div id="collapseFallRiskMedis" class="accordion-collapse collapse" aria-labelledby="FallRiskMedis" data-bs-parent="#accordionAssessmentMedis" style="">
                                            <div class="accordion-body text-muted">
                                                <div class="row">
                                                    <form id="formassessmentigd" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                                                        <div class="col-md-12">
                                                            <div id="bodyFallRiskCppt">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addFallRiskButton" class="box-tab-tools text-center">
                                                                        <a onclick="addFallRisk(1,0,'acpptbody_id', 'bodyFallRiskCppt')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                            <?php foreach ($aType as $key => $value) {
                                if ($value['p_type'] == 'ASES016') {
                            ?>
                                <?php
                                } else if ($value['p_type'] == 'GEN0012') {
                                ?>

                                <?php
                                } else if ($value['p_type'] == 'ASES049') {
                                ?>

                                <?php
                                } else if ($value['p_type'] == 'GEN0013') {
                                ?>

                                <?php
                                } else if ($value['p_type'] == 'GEN0011') {
                                ?>
                                    <div id="acpptGcs_Group" class="accordion-item">
                                        <h2 class="accordion-header" id="headingGcs">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGcs" aria-expanded="false" aria-controls="collapseGcs">
                                                <b>GLASGOW COMA SCALE (GCS)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseGcs" class="accordion-collapse collapse" aria-labelledby="headingGcs" data-bs-parent="#accodrionCPPT" style="">
                                            <div class="accordion-body text-muted">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="bodyGcsCppt">
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div id="addGcsButton" class="box-tab-tools text-center">
                                                                    <a onclick="addGcs(1,0,'acpptbody_id', 'bodyGcsCppt')" class="btn btn-primary btn-lg" id="addGcsBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                            <div id="acpptTindakanKolaboratif_Group" class="accordion-item">
                                <h2 class="accordion-header" id="tindakanPerawat">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTindakanPerawat" aria-expanded="true" aria-controls="collapseTindakanPerawat">
                                        <b>TINDAKAN KOLABORATIF</b>
                                    </button>
                                </h2>
                                <div id="collapseTindakanPerawat" class="accordion-collapse collapse" aria-labelledby="tindakanPerawat" data-bs-parent="#accodrionCPPT" style="">
                                    <div class="accordion-body text-muted">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form id="form1" action="" method="post" class="">
                                                    <div class="box-body row mt-4">
                                                        <input type="hidden" name="ci_csrf_token" value="">
                                                        <div class="col-sm-12 col-md-12 mb-4">
                                                            <div class="row">
                                                                <div class="col-md-8"><select id="searchTarifPerawatCppt" class="form-control" style="width: 100%"></select></div>
                                                                <div class="col-md-4">
                                                                    <div class="box-tab-tools">
                                                                        <a data-toggle="modal" onclick='addBillChargePerawat("searchTarifPerawatCppt", 1, 1)' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
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
                                                            <form id="formchargesBodyPerawatCppt" action="" method="post" class="">
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
                                                                    <tbody id="chargesBodyPerawatCppt" class="table-group-divider">
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
                            <div id="acpptTindakanMandiri_Group" class="accordion-item">
                                <h2 class="accordion-header" id="tindakanPerawatMandiri">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTindakanPerawatMandiri" aria-expanded="true" aria-controls="collapseTindakanPerawatMandiri">
                                        <b>TINDAKAN MANDIRI</b>
                                    </button>
                                </h2>
                                <div id="collapseTindakanPerawatMandiri" class="accordion-collapse collapse" aria-labelledby="tindakanPerawatMandiri" data-bs-parent="#accodrionCPPT" style="">
                                    <div class="accordion-body text-muted">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form id="form1" action="" method="post" class="">
                                                    <div class="box-body row mt-4">
                                                        <input type="hidden" name="ci_csrf_token" value="">
                                                        <div class="col-sm-12 col-md-12 mb-4">
                                                            <div class="row">
                                                                <div class="col-md-8"><select id="searchTarifPerawatMandiriCppt" class="form-control" style="width: 100%"></select></div>
                                                                <div class="col-md-4">
                                                                    <div class="box-tab-tools">
                                                                        <a data-toggle="modal" onclick='addBillChargePerawat("searchTarifPerawatMandiriCppt", 2, 1)' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
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
                                                            <form id="formchargesBodyPerawatMandiriCppt" action="" method="post" class="">
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
                                                                    <tbody id="chargesBodyPerawatMandiriCppt" class="table-group-divider">
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
                            <div id="acpptImplementasi_Group" class="accordion-item">
                                <h2 class="accordion-header" id="tindakanPerawatImplementasi">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTindakanPerawatImplementasi" aria-expanded="true" aria-controls="collapseTindakanPerawatImplementasi">
                                        <b>IMPLEMENTASI KEPERAWATAN</b>
                                    </button>
                                </h2>
                                <div id="collapseTindakanPerawatImplementasi" class="accordion-collapse collapse" aria-labelledby="tindakanPerawatImplementasi" data-bs-parent="#accodrionCPPT" style="">
                                    <div class="accordion-body text-muted">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form id="form1" action="" method="post" class="">
                                                    <div class="box-body row mt-4">
                                                        <input type="hidden" name="ci_csrf_token" value="">
                                                        <div class="col-sm-12 col-md-12 mb-4">
                                                            <div class="row">
                                                                <div class="col-md-8"><select id="searchTarifPerawatImplementasiCppt" class="form-control" style="width: 100%"></select></div>
                                                                <div class="col-md-4">
                                                                    <div class="box-tab-tools">
                                                                        <a data-toggle="modal" onclick='addBillChargePerawat("searchTarifPerawatImplementasiCppt", 3, 1)' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
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
                                                            <form id="formchargesBodyPerawatImplementasiCppt" action="" method="post" class="">
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
                                                                    <tbody id="chargesBodyPerawatImplementasiCppt" class="table-group-divider">
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
                                <div id="collapseprintKeperawatan" class="accordion-collapse collapse" aria-labelledby="printKeperawatan" data-bs-parent="#accodrionCPPT">
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
                        <button type="button" id="formaddacpptbtn" name="save" data-loading-text="Tambah" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <span>Tambah</span></button>
                        <button type="button" id="formsaveacpptbtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                        <button type="button" id="formeditacppt" name="editrm" onclick="enableacppt()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                        <button type="button" id="formsignacppt" name="signrm" onclick="signacppt()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                    </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>