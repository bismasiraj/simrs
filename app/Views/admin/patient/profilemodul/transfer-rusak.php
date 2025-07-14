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
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>

        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div id="contentTindakLanjut" class="card border-1 rounded-4 mt-4" style="display: none;">
                <div class="card-body">
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="hideTransfer()"></button>
                    </div>
                    <h3 id="atransfer1Title">Rencana Tindak Lanjut</h3>
                    <hr>
                    <form id="formaddatransfer" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <input type="hidden" id="atransferbody_id" name="body_id">
                        <input type="hidden" id="atransferorg_unit_code" name="org_unit_code">
                        <input type="hidden" id="atransferno_registration" name="no_registration">
                        <input type="hidden" id="atransfervisit_id" name="visit_id">
                        <input type="hidden" id="atransfertrans_id" name="trans_id" value="<?= $visit['trans_id']; ?>">
                        <input type="hidden" id="atransferdocument_id" name="document_id">
                        <input type="hidden" id="atransferdocument_id2" name="document_id2">
                        <input type="hidden" id="atransferdocument_id3" name="document_id3">
                        <input type="hidden" id="atransferfrom_petugas_id" name="from_petugas_id">
                        <input type="hidden" id="atransferfrom_petugas" name="from_petugas">
                        <input type="hidden" id="atransfersign_from" name="sign_from">
                        <input type="hidden" id="atransferfrom_petugas_id_1" name="from_petugas_id_1">
                        <input type="hidden" id="atransferfrom_petugas_1" name="from_petugas_1">
                        <input type="hidden" id="atransfersign_from_1" name="sign_from_1">
                        <input type="hidden" id="atransferbetween_petugas_id" name="between_petugas_id">
                        <input type="hidden" id="atransferbetween_petugas" name="between_petugas">
                        <input type="hidden" id="atransfersign_between" name="sign_between">
                        <input type="hidden" id="atransferto_petugas_id" name="to_petugas_id">
                        <input type="hidden" id="atransferto_petugas" name="to_petugas">
                        <input type="hidden" id="atransfersign_to" name="sign_to">
                        <input type="hidden" id="atransferto_petugas_id_1" name="to_petugas_id_1">
                        <input type="hidden" id="atransferto_petugas_1" name="to_petugas_1">
                        <input type="hidden" id="atransfersign_to_1" name="sign_to_1">
                        <input type="hidden" id="atransferstatus_pasien_id" name="status_pasien_id">
                        <input name="valid_date" class="valid_date" id="atransfervalid_date" type="hidden" />
                        <input name="valid_user" class="valid_user" id="atransfervalid_user" type="hidden" />
                        <input name="valid_pasien" class="valid_pasien" id="atransfervalid_pasien" type="hidden" />
                        <!-- <input type="hidden" id="atransferisinternal" name="isinternal"> -->
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="atransferexamination_date">Tanggal Dokumen</label>
                                        <input id="flatatransferexamination_date" type="text" class="form-control datetimeflatpickr" />
                                        <input name="examination_date" id="atransferexamination_date" type="hidden" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12" style="display: none;">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="atransferemployee_id">Dokter</label>
                                        <select name="employee_id" id="atransferemployee_id" type="hidden" class="form-control">

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
                            <div id="atransferisinternal_group" class="col-sm-4 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Follow Up</label>
                                        <select name="isinternal" id="atransferisinternal" onchange="openTindakLanjutModal()" class="form-control ">
                                            <?php if (user()->checkPermission("assessmentmedis", "c")) {
                                                if (true) { ?>
                                                    <option value="4">PERAWATAN JALAN (KONTROL)</option>
                                                    <option value="2">RUJUK EKSTERNAL</option>
                                                    <option value="3">RUJUK INTERNAL</option>
                                                    <option value="6">KONSUL INTERNAL</option>
                                                    <option value="5">RAWAT INAP</option>
                                                    <option value="10">TRANSFER INTERNAL</option>
                                                    <option value="11">Pengobatan Selesai</option>
                                                    <option value="12">D.O.A</option>
                                                    <option value="13">Meninggal di IGD</option>
                                                    <option value="14">Meninggal < 24 Jam</option>
                                                    <option value="15">Meninggal < 48 Jam</option>
                                                    <option value="16">Meninggal > 48 Jam</option>
                                                    <option value="17">APS</option>
                                                <?php }
                                            } else {
                                                ?>
                                                <option value="4" disabled>PERAWATAN JALAN (KONTROL)</option>
                                                <option value="2" disabled>RUJUK EKSTERNAL</option>
                                                <option value="3" disabled>RUJUK INTERNAL</option>
                                                <option value="6" disabled>KONSUL INTERNAL</option>
                                                <option value="5" disabled>RAWAT INAP</option>
                                                <option value="10">TRANSFER INTERNAL</option>
                                                <option value="11">Pengobatan Selesai</option>
                                                <option value="12">D.O.A</option>
                                                <option value="13">Meninggal di IGD</option>
                                                <option value="14">Meninggal < 24 Jam</option>
                                                <option value="15">Meninggal < 48 Jam</option>
                                                <option value="16">Meninggal > 48 Jam</option>
                                            <?php
                                            } ?>
                                        </select>
                                        <!-- <select name="isinternal" id="atransferisinternal" onchange="openTindakLanjutModal()" class="form-control ">
                                            <?php foreach ($followup as $key => $value) {
                                                if (in_array($value['follow_up'], [10, 5, 2, 3, 4])) {
                                            ?>
                                                    <option value="<?= $value['follow_up']; ?>"><?= $value['followup']; ?></option>
                                            <?php
                                                }
                                            } ?>
                                        </select> -->
                                    </div>
                                </div>
                            </div>
                            <div id="atransferclinic_id_group" class="col-sm-4 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="atransferclinic_id">Asal</label>
                                        <select name="clinic_id" id="atransferclinic_id" type="hidden" class="form-control ">
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
                            <div id="atransferclinic_id_to_group" class="col-sm-4 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="atransferclinic_id_to">Tujuan</label>
                                        <select name="clinic_id_to" id="atransferclinic_id_to" type="hidden" class="form-control ">
                                            <?php if ($visit['isrj'] == 1) {
                                                $selectedClinic = $visit['class_room_id'];
                                            } else {
                                                $selectedClinic = $visit['clinic_id'];
                                            } ?>
                                            <?php foreach ($clinicAll as $key => $value) {
                                            ?>
                                                <?php if ($selectedClinic == $visit['clinic_id']) { ?>
                                                    <option value="<?= $value['clinic_id']; ?>" selected><?= $value['name_of_clinic']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $value['clinic_id']; ?>"><?= $value['name_of_clinic']; ?></option>
                                                <?php } ?>
                                            <?php
                                            } ?>
                                            <option value="P002">IBS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="atransferservice_needs_group" class="col-sm-4 col-xs-12" style="display: none;">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Kebutuhan Pelayanan</label>
                                        <select name="service_needs" id="atransferservice_needs" class="form-control ">
                                            <option value="1">Kuratif</option>
                                            <option value="0">Preventif</option>
                                            <option value="2">Palatif</option>
                                            <option value="3">Rehabilitatif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="atransferdescriptiongroup" class="col-sm-8 col-md-3" style="display: none">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="pwd">Alasan/Ket</label>
                                        <textarea id="atransferprocedure_05" name="procedure_05" rows="1" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo view('admin/patient/profilemodul/transfer/konsulinternal', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            'statusPasien' => $statusPasien,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa,
                        ]); ?>
                        <?php echo view('admin\patient\profilemodul\transfer\rujukinternal', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            'statusPasien' => $statusPasien,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa,
                        ]); ?>
                        <?php echo view('admin/patient/profilemodul/transfer/rujukan', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            'statusPasien' => $statusPasien,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa,
                        ]); ?>

                        <?php echo view('admin/patient/profilemodul/transfer/spri', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            'statusPasien' => $statusPasien,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa,
                        ]); ?>

                        <?php echo view('admin/patient/profilemodul/transfer/skdp', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            'statusPasien' => $statusPasien,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa,
                        ]); ?>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <div class="form-group">(*)<label for="atransfernotes">Alasan</label>
                                <textarea type='text' name="notes" class="form-control" id='atransfernotes'>
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <div class="form-group">(*)<label for="atransferother_notes">Keterangan Lain</label>
                                <textarea type='text' name="other_notes" class="form-control" id='atransferother_notes' rows="5">
                                    </textarea>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-sm-6 col-md-4 m-4">
                                <div id="formtransferqrcode" class="qrcode-class"></div>
                                <div id="formtransfersigner"></div>
                            </div>
                        </div>
                        <div class="panel-footer text-end mb-4">
                            <button type="submit" id="formsaveatransferbtnid" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right formsaveatransferbtn btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="formeditatransferid" onclick="enableTindakLanjut()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right formeditatransfer btn-edit"><i class="fa fa-edit"></i> <span>Edit</span></button>
                            <button type="button" id="formdeleteatransferid" onclick="deleteTindakLanjut()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right formeditatransfer btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                            <button type="button" id="formsignatransferid" onclick="signTindakLanjut()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer1"><i class="fa fa-signature"></i> <span>Sign</span></button>
                            <button type="button" id="formcetakatransferid" onclick="cetakCpptTransferOnForm()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right formsignatransfer1"><i class="fa fa-print"></i> <span>Cetak</span></button>
                            <button type="button" id="formakomodasiatransferid" onclick="getAkomodasi('<?= $visit['visit_id']; ?>')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-success pull-right formsignatransfer1"><i class="mdi mdi-bed"></i> <span>Akomodasi</span></button>
                            <!-- <button type="button" id="formopenmodaltransferid" name="signrm" onclick="openTindakLanjutModal()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-success pull-right formsignatransfer1"><i class="fa fa-plus"></i> <span>Detail</span></button> -->
                            <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                        </div>
                        <?php echo view('admin/patient/profilemodul/transfer/transferinternal', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            'statusPasien' => $statusPasien,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa,
                        ]); ?>

                    </form>
                </div>
            </div>
            <div class="box-tab-tools text-center m-4">
                <a data-toggle="modal" onclick="setDataTindakLanjut()" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
            </div>
            <h3>History Tindak Lanjut</h3>
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="text-align: center;">
                    <tr>
                        <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                        <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                        <th class="text-center" style="width: 10%;">TIndak Lanjut</th class="text-center">
                        <th class="text-center" colspan="6" style="width: 70%;"></th class="text-center">
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

<?php echo view('admin/patient/profilemodul/transfer/akomodasi', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
]); ?>