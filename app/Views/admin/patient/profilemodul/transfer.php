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
<div class="tab-pane" id="transfer" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>

        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div id="" class="box-tab-tools text-center m-4">
                <a data-toggle="modal" onclick="setDatatransfer()" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
            </div>
            <h3>Histori Vital Sign</h3>
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
                <tbody id="transferBodyHistory">
                </tbody>
            </table>
        </div>
    </div><!--./row-->
</div>

<div class="modal fade" id="transferModal" role="dialog" aria-labelledby="myModalLabel">
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
            <div id="" class="modal-body pt0 pb0">
                <form id="formaddatransfer" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="atransferbody_id" name="body_id">
                    <input type="hidden" id="atransferorg_unit_code" name="org_unit_code">
                    <input type="hidden" id="atransferno_registration" name="no_registration">
                    <input type="hidden" id="atransfervisit_id" name="visit_id">
                    <input type="hidden" id="atransfertrans_id" name="trans_id" value="<?= $visit['trans_id']; ?>">
                    <input type="hidden" id="atransferdocument_id" name="document_id">
                    <input type="hidden" id="atransferdocument_id2" name="document_id2">
                    <input type="hidden" id="atransferclinic_id" name="clinic_id">
                    <input type="hidden" id="atransferclinic_id_to" name="clinic_id_to">
                    <!-- <input type="hidden" id="atransferisinternal" name="isinternal"> -->

                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="atransferexamination_date">Tanggal Assessmennt</label>
                                    <input name="examination_date" id="atransferexamination_date" type="datetime-local" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="atransferemployee_id">Dokter</label>
                                    <select name="employee_id" id="atransferemployee_id" type="hidden" class="form-control">
                                        <?php if (!is_null($visit['class_room_id'])) { ?>
                                            <option value="<?= $visit['employee_inap']; ?>"><?= $visit['fullname_inap']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $visit['employee_id']; ?>"><?= $visit['fullname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <div class="mb-3">
                                <div id="atransferisinternal" class="form-group">
                                    <label>Follow Up</label>
                                    <select name="rencanatl" id="arrencanatl" onchange="tindakLanjut()" class="form-control ">
                                        <?php foreach ($followup as $key => $value) {
                                        ?>
                                            <option value="<?= $value['follow_up']; ?>"><?= $value['followup']; ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-end mb-4">
                        <button type="submit" id="formsaveatransferbtnid" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right formsaveatransferbtn"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                        <button type="button" id="formeditatransferid" name="editrm" onclick="enabletransfer()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right formeditatransfer"><i class="fa fa-edit"></i> <span>Edit</span></button>
                        <button type="button" id="formsignatransferid" name="signrm" onclick="signatransfer1()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer1"><i class="fa fa-signature"></i> <span>Sign</span></button>
                        <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                    </div>
                </form>
                <div id="transferDerajatBody">
                </div>
                <div id="transferDerajatBodyAddBtn" class="col-md-12 text-center">
                    <a onclick="addDerajatStabilitas(1, 0, 'atransferbody_id', 'transferDerajatBody')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Derajat Stabilitas</a>
                </div>
                <div id="transferAsalBody" class="card border-1 rounded-4 m-4">
                    <div class="card-body">
                        <form id="formaddatransfer1" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                            <input type="hidden" id="atransfer1body_id" name="body_id">
                            <input type="hidden" id="atransfer1org_unit_code" name="org_unit_code">
                            <input type="hidden" id="atransfer1pasien_diagnosa_id" name="pasien_diagnosa_id">
                            <input type="hidden" id="atransfer1no_registration" name="no_registration">
                            <input type="hidden" id="atransfer1visit_id" name="visit_id">
                            <input type="hidden" id="atransfer1trans_id" name="trans_id" value="<?= $visit['trans_id']; ?>">
                            <input type="hidden" id="atransfer1bill_id" name="bill_id">
                            <input type="hidden" id="atransfer1class_room_id" name="class_room_id">
                            <input type="hidden" id="atransfer1bed_id" name="bed_id">
                            <input type="hidden" id="atransfer1in_date" name="in_date">
                            <input type="hidden" id="atransfer1exit_date" name="exit_date">
                            <input type="hidden" id="atransfer1keluar_id" name="keluar_id">
                            <input type="hidden" id="atransfer1imt_score" name="imt_score">
                            <input type="hidden" id="atransfer1imt_desc" name="imt_desc">
                            <input type="hidden" id="atransfer1pemeriksaan" name="pemeriksaan">
                            <input type="hidden" id="atransfer1medical_treatment" name="medical_treatment">
                            <input type="hidden" id="atransfer1modified_date" name="modified_date">
                            <input type="hidden" id="atransfer1modified_by" name="modified_by">
                            <input type="hidden" id="atransfer1modified_from" name="modified_from">
                            <input type="hidden" id="atransfer1status_pasien_id" name="status_pasien_id">
                            <input type="hidden" id="atransfer1ageyear" name="ageyear">
                            <input type="hidden" id="atransfer1agemonth" name="agemonth">
                            <input type="hidden" id="atransfer1ageday" name="ageday">
                            <input type="hidden" id="atransfer1thename" name="thename">
                            <input type="hidden" id="atransfer1theaddress" name="theaddress">
                            <input type="hidden" id="atransfer1theid" name="theid">
                            <input type="hidden" id="atransfer1isrj" name="isrj">
                            <input type="hidden" id="atransfer1gender" name="gender">
                            <input type="hidden" id="atransfer1doctor" name="doctor">
                            <input type="hidden" id="atransfer1kal_id" name="kal_id">
                            <input type="hidden" id="atransfer1petugas_id" name="petugas_id">
                            <input type="hidden" id="atransfer1petugas" name="petugas">
                            <input type="hidden" id="atransfer1account_id" name="account_id">
                            <input type="hidden" id="atransfer1kesadaran" name="kesadaran">
                            <input type="hidden" id="atransfer1isvalid" name="isvalid">
                            <input type="hidden" id="atransfer1vs_status_id" name="vs_status_id">
                            <div class="row">
                                <h3 id="atransfer1Title">CPPT Asal</h3>
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
                                                <label for="atransfer1examination_date">Tanggal Assessmennt</label>
                                                <input name="examination_date" id="atransfer1examination_date" type="datetime-local" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="atransfer1clinic_id">Ruangan</label>
                                                <select name="clinic_id" id="atransfer1clinic_id" type="hidden" class="form-control ">
                                                    <?php foreach ($clinic as $key => $value)
                                                        if ($value['stype_id'] == 3) {
                                                    ?><option value="<?= $value['clinic_id']; ?>"><?= $value['name_of_clinic']; ?></option><?php
                                                                                                                                        } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="atransfer1employee_id">Dokter</label>
                                                <select name="employee_id" id="atransfer1employee_id" type="hidden" class="form-control ">
                                                    <option value="<?= $visit['employee_id']; ?>"><?= $visit['fullname']; ?></option>
                                                    <option value="<?= $visit['employee_inap']; ?>"><?= $visit['fullname_inap']; ?></option>
                                                    <?php if (!is_null($visit['class_room_id'])) { ?>
                                                    <?php } else { ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <h4 id="assessmentGroupHeader">A:</h4> -->
                                <div class="accordion" id="accordionTranferAsal">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSubyektif">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubyektif" aria-expanded="false" aria-controls="collapseSubyektif">
                                                <b id="transferAsalSubyektifTitle">SUBYEKTIF (S)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseSubyektif" class="accordion-collapse collapse" aria-labelledby="headingSubyektif" data-bs-parent="#accordionTranferAsal" style="">
                                            <div class="accordion-body text-muted">
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="atransfer1anamnase_label">Keluhan Utama</label><textarea name="anamnase" id="atransfer1anamnase" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                                <div id="groupRiwayattransferAsal" class="row" style="display: none;">
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="atransfer1description">Riwayat Penyakit Sekarang</label>
                                                                <textarea id="atransfer1description" name="description" rows="2" class="form-control " autocomplete="off"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php foreach ($aValue as $key => $value) {
                                                        if ($value['p_type'] == 'GEN0009') {
                                                    ?>
                                                            <div class="col-sm-6 col-xs-12">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label for="atransfer1<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                        <textarea id="atransfer1<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
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
                                                <b id="transferAsalObyektifTitle">OBYEKTIF (O)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseVitalSign" class="accordion-collapse collapse" aria-labelledby="headingVitalSign" data-bs-parent="#accordionTranferAsal" style="">
                                            <div class="accordion-body text-muted">
                                                <div id="groupVitalSigntransferAsal" class="row">
                                                    <div class="row mb-4">
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>BB(Kg)</label>
                                                                <div class=" position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="weight" id="atransfer1weight" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-bb"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Tinggi(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="height" id="atransfer1height" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer1height"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Suhu(°C)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="temperature" id="atransfer1temperature" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer1temperature"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                            <div class="form-group">
                                                                <label>Nadi(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="nadi" id="atransfer1nadi" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer1nadi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="atransfer1tension_upper" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-atransfer1tension_upper"></span>
                                                                    </div>
                                                                    <h4 class="mx-2">/</h4>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="atransfer1tension_below" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-atransfer1tension_below"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Saturasi(SpO2%)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="atransfer1saturasi" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer1saturasi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Nafas/RR(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="nafas" id="atransfer1nafas" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer1nafas"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Diameter Lengan(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="atransfer1arm_diameter" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer1arm_diameter"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Penggunaan Oksigen (L/mnt)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="atransfer1oxygen_usage" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer1oxygen_usage"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--==new -->
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Jenis EWS</label>
                                                                <select class="form-select" name="vs_status_id" id="atransfer1vs_status_id">
                                                                    <option value="" selected>-- pilih --</option>
                                                                    <option value="1">Dewasa</option>
                                                                    <option value="4">Anak</option>
                                                                    <option value="5">Neonatus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--==endofnew -->
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="atransfer1pemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="atransfer1alo_anamnase_label">Catatan Obyektif</label><textarea name="alo_anamnase" id="atransfer1alo_anamnase" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingDiagnosaPerawat">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaPerawat" aria-expanded="false" aria-controls="collapseDiagnosaPerawat">
                                                <b id="transferAsalAssessmentTitle">ASESMEN (A)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseDiagnosaPerawat" class="accordion-collapse collapse" aria-labelledby="headingDiagnosaPerawat" data-bs-parent="#accordionTranferAsal">
                                            <div class="accordion-body text-muted">
                                                <div id="groupDiagnosaPerawattransferAsal" class="row mb-2" <?= isset($group[11]) ? 'style="display: none"' : '' ?>>
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
                                                                            <tbody id="bodyDiagPerawattransferAsal">
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
                                                        <div class="form-group"><label id="atransfer1teraphy_desc_label">Catatan Asesmen</label><textarea name="teraphy_desc" id="atransfer1teraphy_desc" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingPlanning">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePlanning" aria-expanded="false" aria-controls="collapsePlanning">
                                                <b id="transferAsalPlanningTitle">PLANNING (P)</b>
                                            </button>
                                        </h2>
                                        <div id="collapsePlanning" class="accordion-collapse collapse" aria-labelledby="headingPlanning" data-bs-parent="#accordionTranferAsal">
                                            <div class="accordion-body text-muted">
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="atransfer1instruction_label">Catatan Planning</label><textarea name="instruction" id="atransfer1instruction" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                                <script>
                                                    tinymce.init({
                                                        selector: "#atransfer1instruction",
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
                                    <button type="button" id="formSaveatransfer1btnid" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right formsaveatransfer1btn"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                    <button type="button" id="formeditatransfer1id" name="editrm" onclick="enabletransfer2()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right formeditatransfer1"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                    <button type="button" id="formsignatransfer1id" name="signrm" onclick="signatransfer1()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer1"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                    <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="transferTujuanBody" class="card border-1 rounded-4 m-4">
                    <div class="card-body">
                        <form id="formaddatransfer2" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                            <input type="hidden" id="atransfer2body_id" name="body_id">
                            <input type="hidden" id="atransfer2org_unit_code" name="org_unit_code">
                            <input type="hidden" id="atransfer2pasien_diagnosa_id" name="pasien_diagnosa_id">
                            <input type="hidden" id="atransfer2no_registration" name="no_registration">
                            <input type="hidden" id="atransfer2visit_id" name="visit_id">
                            <input type="hidden" id="atransfer2trans_id" name="trans_id" value="<?= $visit['trans_id']; ?>">
                            <input type="hidden" id="atransfer2bill_id" name="bill_id">
                            <input type="hidden" id="atransfer2class_room_id" name="class_room_id">
                            <input type="hidden" id="atransfer2bed_id" name="bed_id">
                            <input type="hidden" id="atransfer2in_date" name="in_date">
                            <input type="hidden" id="atransfer2exit_date" name="exit_date">
                            <input type="hidden" id="atransfer2keluar_id" name="keluar_id">
                            <input type="hidden" id="atransfer2imt_score" name="imt_score">
                            <input type="hidden" id="atransfer2imt_desc" name="imt_desc">
                            <input type="hidden" id="atransfer2pemeriksaan" name="pemeriksaan">
                            <input type="hidden" id="atransfer2medical_treatment" name="medical_treatment">
                            <input type="hidden" id="atransfer2modified_date" name="modified_date">
                            <input type="hidden" id="atransfer2modified_by" name="modified_by">
                            <input type="hidden" id="atransfer2modified_from" name="modified_from">
                            <input type="hidden" id="atransfer2status_pasien_id" name="status_pasien_id">
                            <input type="hidden" id="atransfer2ageyear" name="ageyear">
                            <input type="hidden" id="atransfer2agemonth" name="agemonth">
                            <input type="hidden" id="atransfer2ageday" name="ageday">
                            <input type="hidden" id="atransfer2thename" name="thename">
                            <input type="hidden" id="atransfer2theaddress" name="theaddress">
                            <input type="hidden" id="atransfer2theid" name="theid">
                            <input type="hidden" id="atransfer2isrj" name="isrj">
                            <input type="hidden" id="atransfer2gender" name="gender">
                            <input type="hidden" id="atransfer2doctor" name="doctor">
                            <input type="hidden" id="atransfer2kal_id" name="kal_id">
                            <input type="hidden" id="atransfer2petugas_id" name="petugas_id">
                            <input type="hidden" id="atransfer2petugas" name="petugas">
                            <input type="hidden" id="atransfer2account_id" name="account_id">
                            <input type="hidden" id="atransfer2kesadaran" name="kesadaran">
                            <input type="hidden" id="atransfer2isvalid" name="isvalid">
                            <input type="hidden" id="atransfer2vs_status_id" name="vs_status_id">
                            <div class="row">
                                <h3 id="atransfer2Title">CPPT Tujuan</h3>
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
                                                <label for="atransfer2examination_date">Tanggal Assessmennt</label>
                                                <input name="examination_date" id="atransfer2examination_date" type="datetime-local" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="atransfer2clinic_id">Ruangan</label>
                                                <select name="clinic_id" id="atransfer2clinic_id" type="hidden" class="form-control ">
                                                    <?php foreach ($clinic as $key => $value)
                                                        if ($value['stype_id'] == 3) {
                                                    ?><option value="<?= $value['clinic_id']; ?>"><?= $value['name_of_clinic']; ?></option><?php
                                                                                                                                        } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="atransfer2employee_id">Dokter</label>
                                                <select name="employee_id" id="atransfer2employee_id" type="hidden" class="form-control ">
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
                                <div class="accordion" id="accordionTranferTujuan">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSubyektif">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubyektif" aria-expanded="false" aria-controls="collapseSubyektif">
                                                <b id="transferTujuanSubyektifTitle">SUBYEKTIF (S)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseSubyektif" class="accordion-collapse collapse" aria-labelledby="headingSubyektif" data-bs-parent="#accordionTranferTujuan" style="">
                                            <div class="accordion-body text-muted">
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="atransfer2anamnase_label">Keluhan Utama</label><textarea name="anamnase" id="atransfer2anamnase" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                                <div id="groupRiwayattransferTujuan" class="row" style="display: none;">
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="atransfer2description">Riwayat Penyakit Sekarang</label>
                                                                <textarea id="atransfer2description" name="description" rows="2" class="form-control " autocomplete="off"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php foreach ($aValue as $key => $value) {
                                                        if ($value['p_type'] == 'GEN0009') {
                                                    ?>
                                                            <div class="col-sm-6 col-xs-12">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label for="atransfer2<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                        <textarea id="atransfer2<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
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
                                                <b id="transferTujuanObyektifTitle">OBYEKTIF (O)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseVitalSign" class="accordion-collapse collapse" aria-labelledby="headingVitalSign" data-bs-parent="#accordionTranferTujuan" style="">
                                            <div class="accordion-body text-muted">
                                                <div id="groupVitalSigntransferTujuan" class="row">
                                                    <div class="row mb-4">
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>BB(Kg)</label>
                                                                <div class=" position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="weight" id="atransfer2weight" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-bb"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Tinggi(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="height" id="atransfer2height" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer2height"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Suhu(°C)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="temperature" id="atransfer2temperature" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer2temperature"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                            <div class="form-group">
                                                                <label>Nadi(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="nadi" id="atransfer2nadi" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer2nadi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="atransfer2tension_upper" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-atransfer2tension_upper"></span>
                                                                    </div>
                                                                    <h4 class="mx-2">/</h4>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="atransfer2tension_below" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-atransfer2tension_below"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Saturasi(SpO2%)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="atransfer2saturasi" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer2saturasi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Nafas/RR(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="nafas" id="atransfer2nafas" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer2nafas"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Diameter Lengan(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="atransfer2arm_diameter" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer2arm_diameter"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Penggunaan Oksigen (L/mnt)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="atransfer2oxygen_usage" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-atransfer2oxygen_usage"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--==new -->
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Jenis EWS</label>
                                                                <select class="form-select" name="vs_status_id" id="atransfer2vs_status_id">
                                                                    <option value="" selected>-- pilih --</option>
                                                                    <option value="1">Dewasa</option>
                                                                    <option value="4">Anak</option>
                                                                    <option value="5">Neonatus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--==endofnew -->
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="atransfer2pemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="atransfer2alo_anamnase_label">Catatan Obyektif</label><textarea name="alo_anamnase" id="atransfer2alo_anamnase" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingDiagnosaPerawat">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaPerawat" aria-expanded="false" aria-controls="collapseDiagnosaPerawat">
                                                <b id="transferTujuanAssessmentTitle">ASESMEN (A)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseDiagnosaPerawat" class="accordion-collapse collapse" aria-labelledby="headingDiagnosaPerawat" data-bs-parent="#accordionTranferTujuan">
                                            <div class="accordion-body text-muted">
                                                <div id="groupDiagnosaPerawattransferTujuan" class="row mb-2" <?= isset($group[11]) ? 'style="display: none"' : '' ?>>
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
                                                                            <tbody id="bodyDiagPerawattransferTujuan">
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
                                                        <div class="form-group"><label id="atransfer2teraphy_desc_label">Catatan Asesmen</label><textarea name="teraphy_desc" id="atransfer2teraphy_desc" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingPlanning">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePlanning" aria-expanded="false" aria-controls="collapsePlanning">
                                                <b id="transferTujuanPlanningTitle">PLANNING (P)</b>
                                            </button>
                                        </h2>
                                        <div id="collapsePlanning" class="accordion-collapse collapse" aria-labelledby="headingPlanning" data-bs-parent="#accordionTranferTujuan">
                                            <div class="accordion-body text-muted">
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="atransfer2instruction_label">Catatan Planning</label><textarea name="instruction" id="atransfer2instruction" placeholder="" value="" class="form-control"></textarea></div>
                                                    </div>
                                                </div>
                                                <script>
                                                    tinymce.init({
                                                        selector: "#atransfer2instruction",
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
                                    <button type="button" id="formsaveatransfer2btnid" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right formsaveatransfer2btn"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                    <button type="button" id="formeditatransfer2id" name="editrm" onclick="enabletransfer2()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right formeditatransfer2"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                    <button type="button" id="formsignatransfer2id" name="signrm" onclick="signatransfer2()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer2"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                    <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>