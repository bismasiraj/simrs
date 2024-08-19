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
        <div id="loadContentCppt" class="col-12 center-spinner"></div>
        <div id="contentCppt">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 border-r">
                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
                        'visit' => $visit,
                        'pasienDiagnosaAll' => $pasienDiagnosaAll,
                        'pasienDiagnosa' => $pasienDiagnosa
                    ]); ?>
                </div><!--./col-lg-6-->
                <div class="col-lg-9 col-md-9 col-sm-12 mt-4">
                    <div id="cpptDivForm" class="card border-1 rounded-4 p-4" style="display: none">
                        <div class="card-body">
                            <div class="col-md-12 text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="hideCppt()"></button>
                            </div>
                            <div class="row">
                                <div id="acpptDocument" class="border-1 rounded-4" style="">
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
                                            <!-- <input type="hidden" id="acpptaccount_id" name="account_id"> -->
                                            <input type="hidden" id="acpptkesadaran" name="kesadaran">
                                            <input type="hidden" id="acpptisvalid" name="isvalid">
                                            <input type="hidden" id="acpptvalid_user" class="valid_user" name="valid_user">
                                            <input type="hidden" id="acpptvalid_pasien" class="valid_pasien" name="valid_pasien">
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
                                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="account_id" id="acpptaccount_id3" value="3"><label class="form-check-label" for="acpptaccount_id3" checked>SOAP</label></div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="account_id" id="acpptaccount_id4" value="4"><label class="form-check-label" for="acpptaccount_id4">SBAR</label></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4 col-xs-12">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="acpptexamination_date">Tanggal Assessmennt</label>
                                                                <input name="" id="flatacpptexamination_date" type="text" class="form-control datetimeflatpickr" />
                                                                <input name="examination_date" id="acpptexamination_date" type="hidden" />
                                                                <!-- <input class="form-control datetime-input" type="datetime-local"  name="${props?.column_name?.toLowerCase()}" value="${props?.get_data?.[props?.column_name?.toLowerCase()] ? moment(props?.get_data?.[props?.column_name?.toLowerCase()], " YYYY-MM-DDTHH:mm").format("YYYY-MM-DDTHH:mm") : '' }"> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="acpptclinic_id">Pelayanan</label>
                                                                <select name="clinic_id" id="acpptclinic_id" type="hidden" class="form-control ">
                                                                    <?php if ($visit['isrj'] == 1) {
                                                                        $selectedClinic = $visit['class_room_id'];
                                                                    } else {
                                                                        $selectedClinic = $visit['clinic_id'];
                                                                    } ?>
                                                                    <?php foreach ($clinic as $key => $value) {
                                                                    ?>
                                                                        <?php if ($selectedClinic == $visit['clinic_id']) { ?>
                                                                            <option value="<?= $value['clinic_id']; ?>" selected><?= $value['name_of_clinic']; ?></option>
                                                                        <?php } else { ?>
                                                                            <option value="<?= $value['clinic_id']; ?>"><?= $value['name_of_clinic']; ?></option>
                                                                        <?php } ?>
                                                                    <?php
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="acpptemployee_id">Dokter</label>
                                                                <select name="employee_id" id="acpptemployee_id" type="hidden" class="form-control ">
                                                                    <?php if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '')) {
                                                                        $dokterselected = $visit['employee_inap'];
                                                                    } else {
                                                                        $dokterselected = $visit['employee_id'];
                                                                    } ?>
                                                                    <?php foreach ($employee as $key => $value) {
                                                                    ?>
                                                                        <?php if ($dokterselected == $visit['employee_id']) { ?>
                                                                            <option value="<?= $value['employee_id']; ?>" selected><?= $value['fullname']; ?></option>
                                                                        <?php } else { ?>
                                                                            <option value="<?= $value['employee_id']; ?>"><?= $value['fullname']; ?></option>
                                                                        <?php } ?>
                                                                    <?php
                                                                    } ?>
                                                                </select>
                                                                <!-- <script>
                                                                    // Set the formatted date to the input field
                                                                    document.getElementById('acpptemployee_id').value = formattedDate;
                                                                </script> -->
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="acpptheadingVitalSign">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acpptcollapseVitalSign" aria-expanded="false" aria-controls="acpptcollapseVitalSign">
                                                                <b id="cpptObyektifTitle">OBYEKTIF (O)</b>
                                                            </button>
                                                        </h2>
                                                        <div id="acpptcollapseVitalSign" class="accordion-collapse collapse" aria-labelledby="acpptheadingVitalSign" data-bs-parent="#accordionSOAP" style="">
                                                            <div class="accordion-body text-muted">
                                                                <div id="groupVitalSignCppt" class="row">
                                                                    <div class="row mb-4">
                                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label>Jenis EWS</label>
                                                                                <select class="form-select" name="vs_status_id" id="acpptvs_status_id">
                                                                                    <option value="" selected>-- pilih --</option>
                                                                                    <option value="1">Dewasa</option>
                                                                                    <option value="4">Anak</option>
                                                                                    <option value="5">Neonatus</option>
                                                                                    <option value="10">Obsetric</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label>BB(Kg)</label>
                                                                                <div class=" position-relative">
                                                                                    <input onchange="vitalsignInput(this)" type="text" name="weight" id="acpptweight" placeholder="" value="" class="form-control">
                                                                                    <span class="h6" id="badge-bb"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label>Tinggi(cm)</label>
                                                                                <div class="position-relative">
                                                                                    <input onchange="vitalsignInput(this)" type="text" name="height" id="acpptheight" placeholder="" value="" class="form-control">
                                                                                    <span class="h6" id="badge-acpptheight"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label>Suhu(°C)</label>
                                                                                <div class="position-relative">
                                                                                    <input onchange="vitalsignInput(this)" type="text" name="temperature" id="acppttemperature" placeholder="" value="" class="form-control">
                                                                                    <span class="h6" id="badge-acppttemperature"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                                            <div class="form-group">
                                                                                <label>Nadi(/menit)</label>
                                                                                <div class="position-relative">
                                                                                    <input onchange="vitalsignInput(this)" type="text" name="nadi" id="acpptnadi" placeholder="" value="" class="form-control">
                                                                                    <span class="h6" id="badge-acpptnadi"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                                <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                                    <div class="position-relative">
                                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="acppttension_upper" placeholder="" value="" class="form-control">
                                                                                        <span class="h6" id="badge-acppttension_upper"></span>
                                                                                    </div>
                                                                                    <h4 class="mx-2">/</h4>
                                                                                    <div class="position-relative">
                                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="acppttension_below" placeholder="" value="" class="form-control">
                                                                                        <span class="h6" id="badge-acppttension_below"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label>Saturasi(SpO2%)</label>
                                                                                <div class="position-relative">
                                                                                    <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="acpptsaturasi" placeholder="" value="" class="form-control">
                                                                                    <span class="h6" id="badge-acpptsaturasi"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label>Nafas/RR(/menit)</label>
                                                                                <div class="position-relative">
                                                                                    <input onchange="vitalsignInput(this)" type="text" name="nafas" id="acpptnafas" placeholder="" value="" class="form-control">
                                                                                    <span class="h6" id="badge-acpptnafas"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label>Diameter Lengan(cm)</label>
                                                                                <div class="position-relative">
                                                                                    <input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="acpptarm_diameter" placeholder="" value="" class="form-control">
                                                                                    <span class="h6" id="badge-acpptarm_diameter"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label>Penggunaan Oksigen (L/mnt)</label>
                                                                                <div class="position-relative">
                                                                                    <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="acpptoxygen_usage" placeholder="" value="" class="form-control">
                                                                                    <span class="h6" id="badge-acpptoxygen_usage"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label>Kesadaran</label>
                                                                                <select class="form-select" name="awareness" id="acpptawareness" onchange="vitalsignInput(this)">
                                                                                    <option value="0">Sadar</option>
                                                                                    <option value="3">Nyeri</option>
                                                                                    <option value="10">Unrespon</option>
                                                                                </select>
                                                                                <span class="h6" id="badge-acpptawareness"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 mt-2">
                                                                            <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="acpptpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                                        </div>
                                                                        <div class="col-12 mt-4">
                                                                            <h4><b>Resiko Jatuh</b></h4>
                                                                            <hr>
                                                                            <div class="col-md-12">
                                                                                <div id="bodyFallRiskCppt">
                                                                                </div>
                                                                                <div class="row mb-4">
                                                                                    <div class="col-md-12">
                                                                                        <div id="addFallRiskButton" class="box-tab-tools text-center">
                                                                                            <a onclick="addFallRisk(1,0,'acpptbody_id', 'bodyFallRiskCppt')" class="btn btn-primary btn-lg btn-to-hide" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mt-4">
                                                                            <h4><b>GCS</b></h4>
                                                                            <hr>
                                                                            <div class="col-md-12">
                                                                                <div id="bodyGcsCppt">
                                                                                </div>
                                                                                <div class="row mb-4">
                                                                                    <div class="col-md-12">
                                                                                        <div id="bodyGcsCpptAddBtn" class="box-tab-tools text-center">
                                                                                            <a onclick="addGcs(1,0,'acpptbody_id', 'bodyGcsCppt')" class="btn btn-primary btn-lg" id="bodyGcsCpptAddBtn btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <span id="acppttotal_score"></span>
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
                                                                                                <th class="text-center" style="width: 100%">Diagnosa Perawat</th>
                                                                                            </thead>
                                                                                            <tbody id="bodyDiagPerawatCppt">
                                                                                            </tbody>
                                                                                        <?php }   ?>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="box-tab-tools" style="text-align: center;">
                                                                                    <button type="button" name="addDiagnosaPerawat" onclick="addRowDiagPerawat('bodyDiagPerawatCppt', '')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-to-hide"><i class="fa fa-plus"></i> <span>Diagnosa</span></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12 mt-2">
                                                                        <div class="form-group"><label id="acpptteraphy_desc_label">Catatan Asesmenen</label><textarea name="teraphy_desc" id="acpptteraphy_desc" placeholder="" value="" class="form-control"></textarea></div>
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
                                                                        <div class="form-group"><label id="acpptinstruction_label">Catatan Planning</label><textarea name="instruction" id="acpptinstruction" placeholder="" value="" class="form-control" row="4"></textarea></div>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    // tinymce.init({
                                                                    //     selector: "#acpptinstruction",
                                                                    //     height: 300,
                                                                    //     plugins: [
                                                                    //         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                                                                    //         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                                                    //         "save table contextmenu directionality emoticons template paste textcolor",
                                                                    //     ],
                                                                    //     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                                                                    //     style_formats: [{
                                                                    //             title: "Bold text",
                                                                    //             inline: "b"
                                                                    //         },
                                                                    //         {
                                                                    //             title: "Red text",
                                                                    //             inline: "span",
                                                                    //             styles: {
                                                                    //                 color: "#ff0000"
                                                                    //             }
                                                                    //         },
                                                                    //         {
                                                                    //             title: "Red header",
                                                                    //             block: "h1",
                                                                    //             styles: {
                                                                    //                 color: "#ff0000"
                                                                    //             }
                                                                    //         },
                                                                    //         {
                                                                    //             title: "Example 1",
                                                                    //             inline: "span",
                                                                    //             classes: "example1"
                                                                    //         },
                                                                    //         {
                                                                    //             title: "Example 2",
                                                                    //             inline: "span",
                                                                    //             classes: "example2"
                                                                    //         },
                                                                    //         {
                                                                    //             title: "Table styles"
                                                                    //         },
                                                                    //         {
                                                                    //             title: "Table row 1",
                                                                    //             selector: "tr",
                                                                    //             classes: "tablerow1"
                                                                    //         },
                                                                    //     ],
                                                                    // });
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <hr>
                                                </div><!--./col-md-12-->
                                                <div class="row text-center">
                                                    <div class="col-sm-12 col-md-4 m-4">
                                                        <div id="formaddacpptqrcode1" class="qrcode-class"></div>
                                                        <div id="formaddacpptsigner1"></div>
                                                    </div>
                                                </div>
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
                                                    <!-- <div id="acpptFallRisk_Group" class="accordion-item">
                                                        <h2 class="accordion-header" id="FallRiskMedis">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFallRiskMedis" aria-expanded="true" aria-controls="collapseFallRiskMedis">
                                                                <b>RESIKO JATUH</b>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFallRiskMedis" class="accordion-collapse collapse" aria-labelledby="FallRiskMedis" data-bs-parent="#accordionAssessmentMedis" style="">
                                                            <div class="accordion-body text-muted">
                                                                <div class="row">
                                                                    <form  accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
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
                                                    </div> -->
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
                                                    <!-- <div id="acpptGcs_Group" class="accordion-item">
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
                                                                                <div id="bodyGcsCpptAddBtn" class="box-tab-tools text-center">
                                                                                    <a onclick="addGcs(1,0,'acpptbody_id', 'bodyGcsCppt')" class="btn btn-primary btn-lg" id="bodyGcsCpptAddBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                            <?php
                                                }
                                            } ?>
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
                    <div class="box-tab-tools text-center">
                        <a data-toggle="modal" onclick="initialAddacppt()" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                        </tbody>
                    </table>
                    <div class="d-flex mb-3">
                        <?php if ($visit['class_room_id'] == '') {
                        ?>
                            <a href="<?= base_url(); ?>/admin/rm/keperawatan/cppt_ralan/<?= base64_encode(json_encode($visit)); ?>" target="_blank" class="btn btn-success w-100"><i class="fa fa-print"></i> Cetak</a>
                        <?php
                        } else {
                        ?>
                            <a href="<?= base_url(); ?>/admin/rm/keperawatan/cppt_ranap/<?= base64_encode(json_encode($visit)); ?>" target="_blank" class="btn btn-success w-100"><i class="fa fa-print"></i> Cetak</a>
                        <?php
                        } ?>
                    </div>
                </div>
            </div><!--./row-->
        </div>
    </div>

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

            </div>
        </div>
    </div>
</div>