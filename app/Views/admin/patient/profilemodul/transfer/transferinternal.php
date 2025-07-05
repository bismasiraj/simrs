<div id="atransferstabilitas" class="row" style="display: none;">
    <div class="mb-4">
        <h3>Derajat Stabilitas</h3>
        <hr>
    </div>
    <div id="transferDerajatBody">
    </div>
    <div id="transferDerajatBodyAddBtn" class="col-md-12 text-center">
        <a onclick="addDerajatStabilitas(1, 0, 'atransferbody_id', 'transferDerajatBody')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Derajat Stabilitas</a>
    </div>
</div>
<div id="atransferinternal" class="row" style="display: none;">
    <div class="mb-4">
        <h3>SOAP</h3>
        <hr>
        <!-- <div class="row">
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="atransfer1examination_date">Tanggal Assessmennt</label>
                                                <input id="flatatransfer1examination_date" type="text" class="form-control datetimeflatpickr" required />
                                                <input id="atransfer1examination_date" type="hidden" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="atransfer1clinic_id">Ruangan</label>
                                                <select id="atransfer1clinic_id" type="hidden" class="form-control" required>
                                                    <option value="P012">Unit Gawat Darurat</option>
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
                                                <select id="atransfer1employee_id" type="hidden" class="form-control" required>
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
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
        <div class="accordion" id="accordionTranferAsal">
            <input type="hidden" id="atransfer1org_unit_code">
            <input type="hidden" id="atransfer1pasien_diagnosa_id">
            <input type="hidden" id="atransfer1no_registration">
            <input type="hidden" id="atransfer1visit_id">
            <input type="hidden" id="atransfer1trans_id" value="<?= $visit['trans_id']; ?>">
            <input type="hidden" id="atransfer1bill_id">
            <input type="hidden" id="atransfer1class_room_id">
            <input type="hidden" id="atransfer1bed_id">
            <input type="hidden" id="atransfer1in_date">
            <input type="hidden" id="atransfer1exit_date">
            <input type="hidden" id="atransfer1keluar_id">
            <input type="hidden" id="atransfer1imt_score">
            <input type="hidden" id="atransfer1imt_desc">
            <input type="hidden" id="atransfer1medical_treatment">
            <input type="hidden" id="atransfer1modified_date">
            <input type="hidden" id="atransfer1modified_by">
            <input type="hidden" id="atransfer1modified_from">
            <input type="hidden" id="atransfer1status_pasien_id">
            <input type="hidden" id="atransfer1ageyear">
            <input type="hidden" id="atransfer1agemonth">
            <input type="hidden" id="atransfer1ageday">
            <input type="hidden" id="atransfer1thename">
            <input type="hidden" id="atransfer1theaddress">
            <input type="hidden" id="atransfer1theid">
            <input type="hidden" id="atransfer1isrj">
            <input type="hidden" id="atransfer1gender">
            <input type="hidden" id="atransfer1doctor">
            <input type="hidden" id="atransfer1kal_id">
            <input type="hidden" id="atransfer1petugas_id">
            <input type="hidden" id="atransfer1petugas">
            <input type="hidden" id="atransfer1account_id">
            <input type="hidden" id="atransfer1kesadaran">
            <input type="hidden" id="atransfer1isvalid">
            <input type="hidden" id="atransfer1petugas_type">
            <!-- Subyektif -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="atransfer1headingSubyektif">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#atransfer1collapseSubyektif" aria-expanded="false" aria-controls="atransfer1collapseSubyektif">
                        <b id="transferAsalSubyektifTitle">SUBYEKTIF (S)</b>
                    </button>
                </h2>
                <div id="atransfer1collapseSubyektif" class="accordion-collapse collapse show" aria-labelledby="atransfer1headingSubyektif" style="">
                    <div class="accordion-body text-muted">
                        <div class="row">
                            <div class="col-sm-12 mt-2">
                                <div class="form-group"><label id="atransfer1description_label">Keluhan Utama</label><textarea name="anamnase" id="atransfer1description" placeholder="" value="" class="form-control"></textarea></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Obyektif -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="atransfer1headingVitalSign">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#atransfer1collapseVitalSign" aria-expanded="false" aria-controls="atransfer1collapseVitalSign">
                        <b id="transferAsalObyektifTitle">OBYEKTIF (O) SEBELUM TRANSFER</b>
                    </button>
                </h2>
                <input type="hidden" id="atransfer1body_id">
                <div id="atransfer1collapseVitalSign" class="accordion-collapse collapse show" aria-labelledby="atransfer1headingVitalSign" style="">
                    <div class="accordion-body text-muted">
                        <div id="groupVitalSigntransferAsal" class="row">
                            <div class="row mb-4">
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Jenis EWS</label>
                                        <select class="form-select" name="vs_status_id" id="atransfer1vs_status_id">
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
                                            <input onchange="vitalsignInput(this)" type="text" name="weight" id="atransfer1weight" placeholder="" value="" class="form-control vitalSignTransfer1">
                                            <span class="h6" id="badge-bb"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Tinggi(cm)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="height" id="atransfer1height" placeholder="" value="" class="form-control vitalSignTransfer1">
                                            <span class="h6" id="badge-atransfer1height"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Suhu(°C)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="temperature" id="atransfer1temperature" placeholder="" value="" class="form-control vitalSignTransfer1">
                                            <span class="h6" id="badge-atransfer1temperature"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                    <div class="form-group">
                                        <label>Nadi(/menit)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="nadi" id="atransfer1nadi" placeholder="" value="" class="form-control vitalSignTransfer1">
                                            <span class="h6" id="badge-atransfer1nadi"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group"><label>T.Darah(mmHg)</label>
                                        <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                            <div class="position-relative">
                                                <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="atransfer1tension_upper" placeholder="" value="" class="form-control vitalSignTransfer1">
                                                <span class="h6" id="badge-atransfer1tension_upper"></span>
                                            </div>
                                            <h4 class="mx-2">/</h4>
                                            <div class="position-relative">
                                                <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="atransfer1tension_below" placeholder="" value="" class="form-control vitalSignTransfer1">
                                                <span class="h6" id="badge-atransfer1tension_below"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Saturasi(SpO2%)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="atransfer1saturasi" placeholder="" value="" class="form-control vitalSignTransfer1">
                                            <span class="h6" id="badge-atransfer1saturasi"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Nafas/RR(/menit)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="nafas" id="atransfer1nafas" placeholder="" value="" class="form-control vitalSignTransfer1">
                                            <span class="h6" id="badge-atransfer1nafas"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Diameter Lengan(cm)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="atransferm_diameter" id="atransfer1arm_diameter" placeholder="" value="" class="form-control vitalSignTransfer1">
                                            <span class="h6" id="badge-atransfer1arm_diameter"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Penggunaan Oksigen (L/mnt)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="atransfer1oxygen_usage" placeholder="" value="" class="form-control vitalSignTransfer1">
                                            <span class="h6" id="badge-atransfer1oxygen_usage"></span>
                                        </div>
                                    </div>
                                </div>
                                <!--==new -->
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Kesadaran</label>
                                        <select class="form-select" name="awareness" id="atransfer1awareness" onchange="vitalsignInput(this)">
                                            <option value="0">Sadar</option>
                                            <option value="3">Nyeri</option>
                                            <option value="10">Unrespon</option>
                                        </select>
                                        <span class="h6" id="badge-atransfer1awareness"></span>
                                    </div>
                                </div>
                                <!--==endofnew -->
                                <div class="col-sm-12 mt-2">
                                    <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="atransfer1pemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                </div>
                            </div>
                            <span id="atransfer1total_score"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-2">
                                <div class="form-group"><label id="atransfer1alo_anamnase_label">Catatan Obyektif</label><textarea name="alo_anamnase" id="atransfer1alo_anamnase" placeholder="" value="" class="form-control"></textarea></div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-sm-6 col-md-4 m-4">
                                <p>Petugas yang menyerahkan</p>
                                <div id="formtransferqrcode-from" class="qrcode-class"></div>
                                <div id="formtransfersigner-from"></div>
                                <div>
                                    <button type="button" id="formsignatransferid-from" name="signrm" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer1"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 m-4">
                                <p>Petugas yang menerima</p>
                                <div id="formtransferqrcode-from_1" class="qrcode-class"></div>
                                <div id="formtransfersigner-from_1"></div>
                                <div>
                                    <button type="button" id="formsignatransferid-from_1" name="signrm" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer1"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                </div>
                            </div>
                        </div>
                        <div id="atransfer1groupbutton" class="panel-footer text-end m-4" style="">
                            <button type="button" id="formsavetransferid-1" onclick="saveCpptTransfer1()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary d-none"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="formedittransferid-1" onclick="enableCpptTransfer(1)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Edit</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="atransfer2VitalSign" class="accordion-item">
                <h2 class="accordion-header" id="atransfer2headingVitalSign">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#atransfer2collapseVitalSign" aria-expanded="false" aria-controls="atransfer2collapseVitalSign">
                        <b id="transferTujuanObyektifTitle">OBYEKTIF (O) SELAMA TRANSFER</b>
                    </button>
                </h2>
                <input type="hidden" id="atransfer2body_id">

                <input type="hidden" id="atransfer2imt_score">
                <input type="hidden" id="atransfer2imt_desc">
                <div id="atransfer2collapseVitalSign" class="accordion-collapse collapse show" aria-labelledby="atransfer2headingVitalSign" style="">
                    <div class="accordion-body text-muted">
                        <div id="groupVitalSigntransferTujuan" class="row">
                            <div class="row mb-4">
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Jenis EWS</label>
                                        <select class="form-select" name="vs_status_id" id="atransfer2vs_status_id">
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
                                            <input onchange="vitalsignInput(this)" type="text" name="weight" id="atransfer2weight" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-bb"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Tinggi(cm)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="height" id="atransfer2height" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer2height"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Suhu(°C)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="temperature" id="atransfer2temperature" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer2temperature"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                    <div class="form-group">
                                        <label>Nadi(/menit)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="nadi" id="atransfer2nadi" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer2nadi"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group"><label>T.Darah(mmHg)</label>
                                        <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                            <div class="position-relative">
                                                <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="atransfer2tension_upper" placeholder="" value="" class="form-control vitalSignTransfer2">
                                                <span class="h6" id="badge-atransfer2tension_upper"></span>
                                            </div>
                                            <h4 class="mx-2">/</h4>
                                            <div class="position-relative">
                                                <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="atransfer2tension_below" placeholder="" value="" class="form-control vitalSignTransfer2">
                                                <span class="h6" id="badge-atransfer2tension_below"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Saturasi(SpO2%)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="atransfer2saturasi" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer2saturasi"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Nafas/RR(/menit)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="nafas" id="atransfer2nafas" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer2nafas"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Diameter Lengan(cm)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="atransferm_diameter" id="atransfer2arm_diameter" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer2arm_diameter"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Penggunaan Oksigen (L/mnt)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="atransfer2oxygen_usage" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer2oxygen_usage"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Kesadaran</label>
                                        <select class="form-select" name="awareness" id="atransfer2awareness" onchange="vitalsignInput(this)">
                                            <option value="0">Sadar</option>
                                            <option value="3">Nyeri</option>
                                            <option value="10">Unrespon</option>
                                        </select>
                                        <span class="h6" id="badge-atransfer2awareness"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-2">
                                    <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="atransfer2pemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                </div>
                            </div>
                            <span id="atransfer2total_score"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-2">
                                <div class="form-group"><label id="atransfer2alo_anamnase_label">Catatan Obyektif</label><textarea name="alo_anamnase" id="atransfer2alo_anamnase" placeholder="" value="" class="form-control"></textarea></div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-sm-6 col-md-4 m-4">
                                <div id="formtransferqrcode2" class="qrcode-class"></div>
                                <div id="formtransfersigner2"></div>
                            </div>
                        </div>
                        <div id="atransfer2groupbutton" class="panel-footer text-end m-4" style="">
                            <button type="button" id="formsavetransferid-2" onclick="saveCpptTransfer2()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary d-none"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="formedittransferid-2" onclick="enableCpptTransfer(2)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Edit</span></button>
                            <button type="button" id="formsignatransferid-2" name="signrm" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer1"><i class="fa fa-signature"></i> <span>Sign</span></button>
                        </div>
                        <div class="row">
                            <button type="button" id="formsignatransferid-2_1" name="signrm" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer1"><i class="fa fa-signature"></i> <span>Sign</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="atransfer3headingVitalSign">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#atransfer3collapseVitalSign" aria-expanded="false" aria-controls="atransfer3collapseVitalSign">
                        <b id="transferTujuanObyektifTitle">OBYEKTIF (O) SESUDAH TRANSFER</b>
                    </button>
                </h2>

                <input type="hidden" id="atransfer3body_id">
                <input type="hidden" id="atransfer3imt_score">
                <input type="hidden" id="atransfer3imt_desc">
                <div id="atransfer3collapseVitalSign" class="accordion-collapse collapse show" aria-labelledby="atransfer3headingVitalSign" style="">
                    <div class="accordion-body text-muted">
                        <div id="groupVitalSigntransferTujuan" class="row">
                            <div class="row mb-4">
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Jenis EWS</label>
                                        <select class="form-select" name="vs_status_id" id="atransfer3vs_status_id">
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
                                            <input onchange="vitalsignInput(this)" type="text" name="weight" id="atransfer3weight" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-bb"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Tinggi(cm)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="height" id="atransfer3height" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer3height"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Suhu(°C)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="temperature" id="atransfer3temperature" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer3temperature"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                    <div class="form-group">
                                        <label>Nadi(/menit)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="nadi" id="atransfer3nadi" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer3nadi"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group"><label>T.Darah(mmHg)</label>
                                        <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                            <div class="position-relative">
                                                <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="atransfer3tension_upper" placeholder="" value="" class="form-control vitalSignTransfer2">
                                                <span class="h6" id="badge-atransfer3tension_upper"></span>
                                            </div>
                                            <h4 class="mx-2">/</h4>
                                            <div class="position-relative">
                                                <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="atransfer3tension_below" placeholder="" value="" class="form-control vitalSignTransfer2">
                                                <span class="h6" id="badge-atransfer3tension_below"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Saturasi(SpO2%)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="atransfer3saturasi" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer3saturasi"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Nafas/RR(/menit)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="nafas" id="atransfer3nafas" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer3nafas"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Diameter Lengan(cm)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="atransferarm_diameter" id="atransfer3arm_diameter" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer3arm_diameter"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Penggunaan Oksigen (L/mnt)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="atransfer3oxygen_usage" placeholder="" value="" class="form-control vitalSignTransfer2">
                                            <span class="h6" id="badge-atransfer3oxygen_usage"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Kesadaran</label>
                                        <select class="form-select" name="awareness" id="atransfer3awareness" onchange="vitalsignInput(this)">
                                            <option value="0">Sadar</option>
                                            <option value="3">Nyeri</option>
                                            <option value="10">Unrespon</option>
                                        </select>
                                        <span class="h6" id="badge-atransfer3awareness"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-2">
                                    <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="atransfer3pemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                </div>
                            </div>
                            <span id="atransfer3total_score"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-2">
                                <div class="form-group"><label id="atransfer3alo_anamnase_label">Catatan Obyektif</label><textarea name="alo_anamnase" id="atransfer3alo_anamnase" placeholder="" value="" class="form-control"></textarea></div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-sm-6 col-md-4 m-4">
                                <p>Petugas yang menyerahkan</p>
                                <div id="formtransferqrcode-to" class="qrcode-class"></div>
                                <div id="formtransfersigner-to"></div>
                                <div>
                                    <button type="button" id="formsignatransferid-to" name="signrm" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer1"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 m-4">
                                <p>Petugas yang menerima</p>
                                <div id="formtransferqrcode-to_1" class="qrcode-class"></div>
                                <div id="formtransfersigner-to_1"></div>
                                <div>
                                    <button type="button" id="formsignatransferid-to_1" name="signrm" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer1"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                </div>
                            </div>
                        </div>
                        <div id="atransfer3groupbutton" class="panel-footer text-end m-4" style="">
                            <button type="button" id="formsavetransferid-3" onclick="saveCpptTransfer3()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary d-none"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="formedittransferid-3" onclick="enableCpptTransfer(3)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Edit</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Assessment -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="atransfer1headingDiagnosaPerawat">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#atransfer1collapseDiagnosaPerawat" aria-expanded="false" aria-controls="atransfer1collapseDiagnosaPerawat">
                        <b id="transferAsalAssessmentTitle">ASESMEN (A)</b>
                    </button>
                </h2>
                <div id="atransfer1collapseDiagnosaPerawat" class="accordion-collapse collapse show" aria-labelledby="atransfer1headingDiagnosaPerawat">
                    <div class="accordion-body text-muted">
                        <div id="groupDiagnosaPerawattransferAsal" class="row mb-2" <?= isset($group[11]) ? 'style="display: none"' : '' ?>>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-4">
                                    <div class="staff-members">
                                        <div class="table tablecustom-responsive">
                                            <table id="tableDiagnosaPerawatMedis" class="table" data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                                <?php if (true) { ?>
                                                    <thead>
                                                        <th class="text-center" style="width: 100%">DiagnosaPerawat</th>
                                                    </thead>
                                                    <tbody id="bodyDiagPerawattransferAsal">
                                                    </tbody>
                                                <?php }   ?>
                                            </table>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" name="addDiagnosaPerawat" onclick="addRowDiagPerawat('bodyDiagPerawattransferAsal', '', null, null,'transferModal')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
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
            <!-- Prosedur -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="atransfer1headingPlanning">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#atransfer1collapsePlanning" aria-expanded="false" aria-controls="atransfer1collapsePlanning">
                        <b id="transferAsalPlanningTitle">PLANNING (P)</b>
                    </button>
                </h2>
                <div id="atransfer1collapsePlanning" class="accordion-collapse collapse show" aria-labelledby="atransfer1headingPlanning">
                    <div class="accordion-body text-muted">
                        <div class="row">
                            <div class="col-sm-12 mt-2">
                                <div class="form-group"><label id="atransfer1instruction_label">Catatan Planning</label><textarea name="instruction" id="atransfer1instruction" placeholder="" value="" class="form-control"></textarea></div>
                            </div>
                        </div>
                        <script>
                            //bisma
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>