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
                                            <option value="4">PERAWATAN JALAN (KONTROL)</option>
                                            <option value="2">RUJUK EKSTERNAL</option>
                                            <option value="3">KONSUL INTERNAL</option>
                                            <option value="5">RAWAT INAP</option>
                                            <option value="10">TRANSFER INTERNAL</option>
                                            <option value="11">Pengobatan Selesai</option>
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
                            <div id="atransferservice_needs_group" class="col-sm-4 col-xs-12" style="display: none;">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Kebutuhan Pelayanan</label>
                                        <select name="service_needs" id="atransferservice_needs" class="form-control ">
                                            <option value="0">Preventif</option>
                                            <option value="1">Kuratif</option>
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
                        <div id="atransferrujukaninternalgroup" class="row" style="display: none;">
                            <div class="mb-4">
                                <h3>Pembuatan Rujukan Internal</h3>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Tanggal Rencana</label>
                                                <input id="flatrujintvisitdate" type="text" class="form-control datetimeflatpickr" placeholder="yyyy-mm-dd">
                                                <input id="rujintvisitdate" name=" rujintvisitdate" type="hidden" class="form-control" placeholder="yyyy-mm-dd">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Poli Tujuan</label>
                                                <select name='rujintclinicid' id="rujintclinicid" class="form-control select2 act" style="width:100%">
                                                    <?php $cliniclist = array();
                                                    foreach (@$clinicAll as $key => $value) {
                                                        if (@$clinicAll[$key]['stype_id'] == '1') {
                                                            $cliniclist[@$clinicAll[$key]['clinic_id']] = @$clinicAll[$key]['name_of_clinic'];
                                                        }
                                                    }
                                                    asort($cliniclist);
                                                    ?>
                                                    <?php foreach ($cliniclist as $key => $value) { ?>
                                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                                    <?php } ?>
                                                </select> <span class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Dokter Tujuan</label>
                                                <select name='rujintemployeeid' id="rujintemployeeid" class="form-control select2 act" style="width:100%">
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
                                                <span class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center; display: none;">
                                        <button type="button" id="addRujukInternalBtn" onclick="postRujukInternal()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                        <button type="button" id="addRujukInternalDelete" onclick="deleteRujukInternal()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- bisma -->

                        <div id="atransferrujukaneksternalgroups" class="row" style="display: none;">
                            <h3>Pembuatan Rujukan Eksternal</h3>
                            <hr>
                            <div class="col-sm-12 col-md-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Nomor Rujukan</label>
                                        <input id="arnorujukan" name="norujukan" placeholder="" type="text" class="form-control " value="" readonly>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div id="ardirujukkegroup" class="col-sm-12 col-md-8">
                                <div class="mb-3">
                                    <div class="form-group"><label for="diag_awal">Dirujuk Ke</label>
                                        <div class="select2-full-width" style="width:100%">
                                            <select class="form-control  patient_list_ajax" name='dirujukke' id="ardirujukke" style="width: 100%">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="arperujukan_group" class="col-sm-4 col-md-4">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Tipe Rujukan</label>
                                        <select name="tiperujukan" id="artiperujukan" class="form-control ">
                                            <option value="1">Penuh</option>
                                            <option value="2">Parsial</option>
                                            <option value="3">PRB</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="artgl_kontrolgroup" class="col-sm-4 col-md-4">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Tanggal Kontrol</label>
                                        <div class="input-group" id="artglkontrol">
                                            <input id="flatarmartgl_kontrol" type="text" class="form-control datetimeflatpickr" />
                                            <input id="armartgl_kontrol" type="hidden" id="searchmulai" name="artgl_kontrol">

                                            <!-- <input id="artgl_kontrol" name="tgl_kontrol" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#artglkontrol' value="<?= date('Y-m-d'); ?>"> -->

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="arkdpoli_kontrolgroup" class="col-sm-4 col-md-4">
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
                            <div id="ardiag_id1roup" class="col-sm-4 col-md-4">
                                <div class="mb-3">
                                    <div class="form-group"><label for="diag_id1">Diagnosa</label>
                                        <div class="select2-full-width" style="width:100%">
                                            <select class="form-control  patient_list_ajax" name='diag_id1' id="ardiag_id1" style="width: 100%">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-tab-tools" style="text-align: center; display: none;">
                                <button type="button" id="addnorujukan" onclick="postRujukan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                <button type="button" id="deleterujukan" onclick="deleteRujukan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                            </div>
                        </div>
                        <div id="atransfersprigroup" class="row" style="display: none;">
                            <div class="col-sm-12 col-xs-12 col-md-12">
                                <div>
                                    <h3>Rencana SPRI</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-12 col-xs-12 col-md-12 mb-3">
                                <div class="form-group"><label for="sprinosurat">No SPRI</label>
                                    <input type='text' name="sprinosurat" class="form-control" id='sprinosurat' readonly />
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 col-md-4 mb-3">
                                <div class="form-group"><label for="sprikddpjp">Dokter</label>
                                    <div>
                                        <select name="sprikddpjp" id="sprikddpjp" class="form-control" style="width:100%" onchange="setPoliTindakLanjut(this.value)">
                                            <?php foreach ($employee as $key => $value) {
                                            ?>
                                                <option value="<?= $value['employee_id']; ?>"><?= $value['fullname']; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 col-md-4 mb-3">
                                <div class="form-group"><label for="sprikdpoli">Specialist</label>
                                    <div>
                                        <select name="sprikdpoli" id="sprikdpoli" class="form-control" style="width:100%">
                                            <?php
                                            $clinicList = array();
                                            foreach ($clinic as $key => $value) {
                                                if ($value['stype_id'] == '1') {
                                                    $clinicList[$value['clinic_id']] = $value['name_of_clinic'];
                                            ?>
                                            <?php
                                                }
                                            }
                                            asort($clinicList); ?>
                                            <?php foreach ($clinicList as $key => $value) {
                                            ?>
                                                <option value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 col-md-4 mb-3">
                                <div class="form-group"><label for="spritglkontrol">Tgl Rencana Ranap</label>
                                    <input name="" id="flatspritglkontrol" type="text" class="form-control datetimeflatpickr" readonly />
                                    <input name="spritglkontrol" id="spritglkontrol" type="hidden" />
                                </div>
                            </div>
                            <div class="row mt-3 mb-3" style=" display: none;">
                                <div class="col-sm-4 col-xs-12">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="button-items">
                                            <div class="d-grid">
                                                <button id="saveSpriBtn" type="button" onclick="saveSpri()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i>
                                                    <span>Simpan</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="button-items">
                                            <div class="d-grid">
                                                <button id="checkSpriBtn" type="button" onclick="checkSpri()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Check SPRI</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="button-items">
                                            <div class="d-grid">
                                                <button id="deleteSpriBtn" type="button" onclick="deleteSpri()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-trash"></i> <span>Delete SPRI</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="atransferskdpgroup" class="row" style="display: none;">
                            <div class="mb-4">
                                <h3>Pembuatan SKDP</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-xs-12 mb-3">
                                        <div class="form-group"><label for="skdpnosurat">No SKDP</label>
                                            <input type='text' name="skdpnosurat" class="form-control" id='skdpnosurat' readonly />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                                        <div class="form-group"><label for="skdpnosep">No SEP</label>
                                            <input type='text' name="skdpnosep" class="form-control" id='skdpnosep' value="<?= is_null($visit['class_room_id']) ? $visit['no_skp'] : $visit['no_skpinap']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-xs-4 mb-3">
                                        <div class="form-group"><label for="skdpkddpjp">Dokter</label>
                                            <div>
                                                <select name="skdpkddpjp" id="skdpkddpjp" class="form-control" style="width:100%">
                                                    <?php
                                                    asort($employee);

                                                    foreach ($employee as $key => $value) {
                                                    ?>
                                                        <option value="<?= $value['employee_id']; ?>"><?= $value['fullname']; ?></option>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-xs-4 mb-3">
                                        <div class="form-group"><label for="skdpkdpoli">Pelayanan</label>
                                            <div>
                                                <select name="skdpkdpoli" id="skdpkdpoli" class="form-control" style="width:100%">
                                                    <?php
                                                    $clinicList = array();
                                                    foreach ($clinic as $key => $value) {
                                                        if ($value['stype_id'] == '1') {
                                                            $clinicList[$value['clinic_id']] = $value['name_of_clinic'];
                                                    ?>
                                                    <?php
                                                        }
                                                    }
                                                    asort($clinicList); ?>
                                                    <?php foreach ($clinicList as $key => $value) {
                                                    ?>
                                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-xs-4 mb-3">
                                        <div class="form-group">
                                            <label>Tgl Rencana Kontrol</label>
                                            <input id="flatskdptglkontrol" type="text" class="form-control dateflatpickr" placeholder="yyyy-mm-dd">
                                            <input id="skdptglkontrol" name=" skdptglkontrol" type="hidden" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-3" style="display: none;">
                                        <div class="col-sm-4 col-xs-12">
                                            <div class="col-sm-12 col-xs-12">
                                                <div class="button-items">
                                                    <div class="d-grid">
                                                        <button id="saveSkdpBtn" type="button" onclick="saveSkdp()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Simpan</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-12">
                                            <div class="col-sm-12 col-xs-12">
                                                <div class="button-items">
                                                    <div class="d-grid">
                                                        <button id="checkSkdpBtn" type="button" onclick="checkSkdp()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Check SKDP</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-12">
                                            <div class="col-sm-12 col-xs-12">
                                                <div class="button-items">
                                                    <div class="d-grid">
                                                        <button id="deleteSkdpBtn" type="button" onclick="deleteSkdp()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-trash"></i> <span>Delete SKDP</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <div class="form-group"><label for="atransfernotes">Alasan Kontrol</label>
                                <textarea type='text' name="notes" class="form-control" id='atransfernotes'>
                                    </textarea>
                            </div>
                        </div>
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
                                                        <div class="form-group"><label id="atransfer1anamnase_label">Keluhan Utama</label><textarea name="anamnase" id="atransfer1anamnase" placeholder="" value="" class="form-control"></textarea></div>
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
                        <div class="panel-footer text-end mb-4">
                            <button type="submit" id="formsaveatransferbtnid" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right formsaveatransferbtn btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="formeditatransferid" name="editrm" onclick="enableTindakLanjut()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right formeditatransfer btn-edit"><i class="fa fa-edit"></i> <span>Edit</span></button>
                            <button type="button" id="formsignatransferid" name="signrm" onclick="signTindakLanjut()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignatransfer1"><i class="fa fa-signature"></i> <span>Sign</span></button>
                            <button type="button" id="formakomodasiatransferid" name="akomodasirm" onclick="getAkomodasi('<?= $visit['visit_id']; ?>')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-success pull-right formsignatransfer1"><i class="mdi mdi-bed"></i> <span>Akomodasi</span></button>
                            <!-- <button type="button" id="formopenmodaltransferid" name="signrm" onclick="openTindakLanjutModal()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-success pull-right formsignatransfer1"><i class="fa fa-plus"></i> <span>Detail</span></button> -->
                            <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                        </div>
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

<!-- ADD RANAP VIEW -->
<div id="addRanapModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addRanapModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Akomodasi Rawat Inap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div id="loadingHistoryrajal"></div>
                        <table id="ketersediaanTT" class="table table-bordered table-striped table-centered table-hover" data-export-title="<?= lang('Word.patient_list'); ?>">
                            <thead class="table-primary">
                                <tr style="text-align: center">
                                    <th>Nama Bangsal</th>
                                    <th>Nama Ruang / Kode JK</th>
                                    <th>Kelas</th>
                                    <th>Kapasitas</th>
                                    <th>Sisa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="ajaxlist" class="table-group-divider">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Bangsal</label>
                            <select class="form-select" id="ariclinic_id" name="clinic_id" onchange="changeClinicInap(this.value)">
                                <?php foreach ($clinicAll as $key => $value) {
                                    if ($value['stype_id'] == '3') { ?>
                                        <option value="<?= $value['clinic_id']; ?>"><?= $value['name_of_clinic']; ?></option>
                                <?php }
                                } ?>
                            </select>
                            <div id="ariclinic_idalert" class="alert alert-danger mb-0" role="alert" style="display: none;">
                                <strong>Bangsal</strong> tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Ruang</label>
                            <select id="ariclass_room_id" class="form-control" name="class_room_id" onchange="changeClassRoomTA(this.value)">
                            </select>
                            <div id="ariclass_room_idalert" class="alert alert-danger mb-0" role="alert" style="display: none;">
                                <strong>Ruang</strong> tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Nomor TT</label>
                            <select id="aribed_id" class="form-control" name="bed_id">
                            </select>
                            <div id="aribed_idalert" class="alert alert-danger mb-0" role="alert" style="display: none;">
                                <strong>Nomor TT</strong> tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Tarif</label>
                            <input id="aritarif_name" class="form-control" name="tarif_name" type="hidden">
                            <input id="ariamount_paid" class="form-control" name="amount_paid" type="number" step=".0,1">
                            <input id="aritarif_id" class="form-control" name="tarif_id" type="hidden">
                            <input id="aritarif_type" class="form-control" name="tarif_type" type="hidden">
                            <input id="ariclass_id" class="form-control" name="class_id" type="hidden">
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Dokter DPJP</label>
                            <select id="ariemployee_id" class="form-control" name="employee_id">
                                <?php foreach ($employee as $key => $value) { ?>
                                    <option value="<?= $value['employee_id']; ?>"><?= $value['fullname']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Jenis Perawatan</label>
                            <select class="form-select" id="ariclinic_type" name="clinic_type">
                                <?php foreach ($clinicType as $key => $value) { ?>
                                    <option value="<?= $clinicType[$key]['clinic_type']; ?>"><?= $clinicType[$key]['clinictype']; ?></option>
                                <?php } ?>
                            </select>
                            <div id="ariclinic_typealert" class="alert alert-danger mb-0" role="alert" style="display: none;">
                                <strong>Jenis Perawatan</strong> tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label>Tanggal Awal</label>
                            <div class="input-group" id="arimulai" style="padding:0">
                                <input id="aritreat_date" name="treat_date" class="form-control" type="datetime-local" onchange="changeAriTreatDate()">
                                <!-- 
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->

                            </div>
                        </div>
                        <div class="mb-3 row text-end">
                            <button id="saveAddAkomodasi" type="button" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right" onclick="saveAddAkomodasi()">Simpan <i class=" fas fa-check-circle"></i></button>
                        </div>
                    </div>
                </div><!-- row -->
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- AKOMODASI VIEW -->
<div id="akomodasiView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="historyRajalModal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Rawat Inap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadingAkomodasiView"></div>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo view('admin/patient/profilemodul/profilebiodata', [
                            'visit' => $visit,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa
                        ]); ?>
                    </div>
                    <div class="col-md-9">
                        <form id="formAkomodasiView" action="" method="post" class="">
                            <table id="akomoDasiViewTable" class="table table-bordered table-striped table-centered table-hover mb-4" data-export-title="<?= lang('Word.patient_list'); ?>">
                                <thead class="table-primary">
                                    <tr style="text-align: center">
                                        <th>No</th>
                                        <th>Bangsal/Dokter/No TT</th>
                                        <th>Tgl Masuk</th>
                                        <th>Tgl Keluar</th>
                                        <th>Jml Hari</th>
                                        <!-- <th>Jml Hari s/d hari ini</th> -->
                                        <th>Cara Keluar</th>
                                        <th>Tarif</th>
                                        <th>Biaya/Hari</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="akomodasiViewTableBody" class="table-group-divider">
                                </tbody>
                            </table>
                            <div class="col-sm-12 col-xs-12 mb-4">
                                <div class="button-items">
                                    <div class="text-center">
                                        <button id="formAkomodasiViewBtn" type="submit" class="btn btn-primary waves-effect waves-light" style="display: none;"><i class="fa fa-save"></i><span> Simpan</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="accordion" id="accordionRanap">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSepRanap">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSepRanap" aria-expanded="true" aria-controls="collapseSepRanap">
                                        <b>Parameter SEP</b>
                                    </button>
                                </h2>
                                <div id="collapseSepRanap" class="accordion-collapse collapse" aria-labelledby="headingSepRanap" data-bs-parent="#accordionRanap" style="">
                                    <div class="accordion-body text-muted">
                                        <div id="ajax_load"></div>
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="asalrujukan">Asal Rujukan</label>
                                                    <div>
                                                        <select name='asalrujukan' id="taasalrujukan" class="form-control select2 act" style="width:100%" disabled>
                                                            <option value="1">Faskes 1</option>
                                                            <option value="2">Faskes 2 (RS)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="norujukan">No. Rujukan</label><input id="tanorujukan" name="norujukan" type="text" class="form-control" disabled /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="kdpoli">Poli Rujukan</label>
                                                    <div>
                                                        <select name='kdpoli' id="takdpoli" class="form-control select2 act" style="width:100%" disabled>
                                                            <?php foreach ($inasisPoli as $key => $value) { ?>
                                                                <option value="<?= $inasisPoli[$key]['kdpoli']; ?>"><?= $inasisPoli[$key]['nmpoli']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group"><label for="tanggal_rujukan">Tgl Rujukan</label><input type='date' name="tanggal_rujukan" class="form-control" id='tatanggal_rujukan' /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="ppkrujukan">PPK Rujukan</label>
                                                    <div>
                                                        <select name='ppkrujukan' id="tappkrujukan" class="form-control select2 act" style="width:100%" disabled>
                                                            <?php foreach ($inasisFaskes as $key => $value) { ?>
                                                                <option value="<?= $inasisFaskes[$key]['kdprovider']; ?>"><?= $inasisFaskes[$key]['nmprovider']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="diag_awal">Diagnosis Rujukan</label>
                                                    <select class="form-select" name='diag_awal' id="tadiag_awal" disabled>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 mb-3">
                                                <div class="button-items">
                                                    <div class="d-grid">
                                                        <button id="getRujukanRanapBtn" type="button" onclick="getRujukanRanap()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Get Rujukan</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3" style="display: none;">
                                                <div class="form-group"><label for="conclusion"></label><input id="taconclusion" name="conclusion" type="text" class="form-control" /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="diagnosa_id">Diagnosis RS</label><input id="tadiagnosa_id" name="diagnosa_id" type="text" class="form-control" disabled /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3" style="display: none;">
                                                <div class="form-group"><label for="kdpoli_from"></label><input id="takdpoli_from" name=" kdpoli_from" type="text" class="form-control" /></div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12">
                                                <div>
                                                    <h3>Parameter SEP</h3>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="tatujuankunj">Tujuan Kunjungan</label>
                                                    <div>
                                                        <select name='tujuankunj' id="tatujuankunj" class="form-control select2 act" style="width:100%">
                                                            <option value="0">Normal</option>
                                                            <option value="1">Prosedur</option>
                                                            <option value="2">Konsul Dokter</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="takdpenunjang">Penunjang</label>
                                                    <div>
                                                        <select name='kdpenunjang' id="takdpenunjang" class="form-control select2 act" style="width:100%">
                                                            <option value="1">Radioterapi</option>
                                                            <option value="2">Kemoterapi</option>
                                                            <option value="3">Rehab Medik</option>
                                                            <option value="4">Rehab Psikososial</option>
                                                            <option value="5">Transfusi Darah</option>
                                                            <option value="6">Pelayanan Gigi</option>
                                                            <option value="7">Laboratorium</option>
                                                            <option value="8">USG</option>
                                                            <option value="9">Farmasi</option>
                                                            <option value="10">Lain-lain</option>
                                                            <option value="11">MRI</option>
                                                            <option value="12">Hemodialisa</option>
                                                            <option value="99">-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="taflagprocedure">Procedure</label>
                                                    <div>
                                                        <select name='flagprocedure' id="taflagprocedure" class="form-control select2 act" style="width:100%">
                                                            <option value="0">Prosedur Tidak Berkelanjutan</option>
                                                            <option value="1">Prosedur dan Terapi Berkelanjutan</option>
                                                            <option value="99">-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="taassesmentpelgroup">Assesment Pelayanan</label>
                                                    <div>
                                                        <select name='assesmentpel' id="taassesmentpel" class="form-control select2 act" style="width:100%">
                                                            <option value="1">Poli spesialis tidak tersedia pada hari sebelumnya</option>
                                                            <option value="2">Jam poli telah berakhir pada hari sebelumnya</option>
                                                            <option value="3">Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya</option>
                                                            <option value="4">Atas Instruksi RS</option>
                                                            <option value="5">Tujuan Kontrol</option>
                                                            <option value="99">-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-3 col-xs-12 mb-3">
                                                <label for="taedit_sep">No. SKDP</label>
                                                <div class="input-group">
                                                    <input id="taedit_sep" name="edit_sep" type="text" class="form-control" />
                                                    <span class="input-group-btn">
                                                        <button id="getSkdpRanapBtn" class="form-control" onclick="getSKDP()" type="button"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div> -->
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <label for="taspecimenno">No. SPRI</label>
                                                <div class="input-group">
                                                    <input id="taspecimenno" name="specimenno" type="text" class="form-control" />
                                                    <span class="input-group-btn">
                                                        <button id="getSpriRanapBtn" class="form-control" onclick="getSPRI()" type="button"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="tano_skpinap">SEP RI</label><input id="tano_skpinap" name="no_skpinap" type="text" class="form-control" disabled /></div>
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="createSepInapBtn" type="button" onclick="insertSepInap()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Insert SEP</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="editSepInapBtn" type="button" onclick="editSep()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Update SEP</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="deleteSepInapBtn" type="button" onclick="deleteSepInap()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-trash"></i> <span>Delete SEP</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        <b>Follow Up</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionRanap">
                                    <div class="accordion-body text-muted">
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label for="tglRencanaRujukanInap">Tanggal Rencana Rujukan</label>
                                                    <input class="form-control" type="date" value="" id="tglRencanaRujukanInap">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label for="ppkRujukanInap">PPK Rujukan</label>
                                                    <select name='ppkRujukanInap' id="ppkRujukanInap" class="form-control select2 act" style="width:100%">
                                                        <?php foreach ($inasisFaskes as $key => $value) { ?>
                                                            <option value="<?= $inasisFaskes[$key]['kdprovider']; ?>"><?= $inasisFaskes[$key]['nmprovider']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label for="diagRujukan">Diagnosa Rujukan</label>
                                                <div class="input-group">
                                                    <input id="diagRujukanInap" name="diagRujukan" type="text" class="form-control" />
                                                    <input id="nameDiagRujukanInap" name="nameDiagRujukan" type="hidden" class="form-control" />
                                                    <span class="input-group-btn">
                                                        <button class="form-control" onclick="getDiagRujukan()" type="button"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label for="poliRujukanInap">Poli Rujukan</label>
                                                    <select name="poliRujukan" id="poliRujukanInap" class="form-control ">
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
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label for="tipeRujukan">Tipe Rujukan</label>
                                                    <select name="tipeRujukan" id="tipeRujukanInap" class="form-control ">
                                                        <option value="0">Penuh</option>
                                                        <option value="1">Partial</option>
                                                        <option value="2">Balik PRB</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group"><label for="noRujukan">Catatan</label>
                                                    <textarea id="catatanRujukanInap" name="catatanRujukan" type="text" class="form-control">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group"><label for="noRujukan">No. Rujukan</label>
                                                    <input id="noRujukanInap" name="noRujukan" type="text" class="form-control" readonly />
                                                </div>
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="createSepInap" type="button" onclick="insertRujukanInap()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Simpan Rujukan</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="editSepInap" type="button" onclick="updateRujukanInap()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Edit Rujukan</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="deleteSepInap" type="button" onclick="deleteRujukanInap()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-remove"></i> <span>Delete Rujukan</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->