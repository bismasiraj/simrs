<?php
$persalinan = array_filter($aType, function ($value) {
    return $value['p_type'] == 'KBDN002' || $value['p_type'] == 'KBDN003' || $value['p_type'] == 'KBDN004' || $value['p_type'] == 'KBDN005';
});
$persalinanp = array_filter($aParameter, function ($value) {
    return $value['p_type'] == 'KBDN002' || $value['p_type'] == 'KBDN003' || $value['p_type'] == 'KBDN004' || $value['p_type'] == 'KBDN005';
});
$persalinanv = array_filter($aValue, function ($value) {
    return $value['p_type'] == 'KBDN002' || $value['p_type'] == 'KBDN003' || $value['p_type'] == 'KBDN004' || $value['p_type'] == 'KBDN005';
});
// dd($persalinan);
?>
<!-- <div class="tab-pane <?= isset($group[11]) ? 'active' : '' ?>" id="assessmentmedis" role="tabpanel"> -->
<div class="tab-pane" id="persalinan" role="tabpanel">
    <div class="row">
        <div id="loadContentPersalinan" class="col-12 center-spinner"></div>
        <div class="row" id="contentPersalinan">
            <div class="col-lg-2 col-md-2 col-sm-12">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 mt-4">
                <div class="card border-1 rounded-4 p-4">
                    <div class="card-body">
                        <form id="formPersalinan" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                            <div class="modal-body pt0 pb0">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input name="org_unit_code" id="prslorg_unit_code" type="hidden" />
                                        <input name="visit_id" id="prslvisit_id" type="hidden" />
                                        <input name="trans_id" id="prsltrans_id" type="hidden" />
                                        <input name="body_id" id="prslbody_id" type="hidden" />
                                        <input name="document_id" id="prsldocument_id" type="hidden" />
                                        <input name="no_registration" id="prslno_registration" type="hidden" />
                                        <input name="valid_date" id="prslvalid_date" type="hidden" />
                                        <input name="valid_user" id="prslvalid_user" type="hidden" />
                                        <input name="valid_doctor" id="prslvalid_doctor" type="hidden" />
                                        <input name="valid_pasien" id="prslvalid_pasien" type="hidden" />
                                        <?php csrf_field(); ?>
                                        <div class="row row-eq">
                                            <!-- INI CURRENT FILLING DATA -->
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div id="ajax_load"></div>
                                                <div class="row">
                                                    <h3 id="prslTitle">Persalinan</h3>
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
                                                                    <label for="prslexamination_date">Tanggal Assessmennt</label>
                                                                    <input id="flatprslexamination_date" type="text" class="form-control datetimeflatpickr" />
                                                                    <input name="examination_date" id="prslexamination_date" type="hidden" class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="row mb-4">
                                                            <h4><b>Keadaan Umum</b></h4>
                                                            <hr>
                                                            <input type="hidden" id="prslexambody_id" name="exambody_id">
                                                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>BB(Kg)</label>
                                                                    <div class=" position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="weight" id="prslexamweight" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-bb"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Tinggi(cm)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="height" id="prslexamheight" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-prslexamheight"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Suhu(°C)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="temperature" id="prslexamtemperature" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-prslexamtemperature"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                                <div class="form-group">
                                                                    <label>Nadi(/menit)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="nadi" id="prslexamnadi" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-prslexamnadi"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                    <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="prslexamtension_upper" placeholder="" value="" class="form-control">
                                                                            <span class="h6" id="badge-prslexamtension_upper"></span>
                                                                        </div>
                                                                        <h4 class="mx-2">/</h4>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="prslexamtension_below" placeholder="" value="" class="form-control">
                                                                            <span class="h6" id="badge-prslexamtension_below"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Nafas/RR(/menit)</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="nafas" id="prslexamnafas" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-prslexamnafas"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>TFU</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="tfu" id="prslexamtfu" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-prslexamtfu"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Kontraksi Uterus</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="uterus" id="prslexamuterus" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-prslexamuterus"></span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <?php foreach ($persalinan as $key => $value) {
                                                        ?>
                                                            <div class="row mt-4">
                                                                <h4><b><?= $value['p_description']; ?></b></h4>
                                                                <hr>
                                                                <?php foreach (
                                                                    array_filter($persalinanp, function ($value) use ($persalinan, $key) {
                                                                        return $value['p_type'] == $persalinan[$key]['p_type'];
                                                                    }) as $key1 => $value1
                                                                ) {
                                                                    if ($value1['entry_type'] == '1') {
                                                                ?>
                                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label><?= $value1['parameter_desc']; ?></label>
                                                                                <div class=" position-relative">
                                                                                    <input type="text" name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= strtolower($value1['column_name'] ?? ''); ?>" placeholder="" value="" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                    } else if ($value1['entry_type'] == '2') {
                                                                    ?>
                                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label><?= $value1['parameter_desc']; ?></label>
                                                                                <div class=" position-relative">
                                                                                    <input class="form-check-input" type="checkbox" id="prsl<?= strtolower($value1['column_name'] ?? ''); ?>" name="<?= $value1['column_name'] ?? ''; ?>" value="1">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                    } else if ($value1['entry_type'] == '3') {
                                                                    ?>
                                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label><?= $value1['parameter_desc']; ?></label>
                                                                                <div class=" position-relative">
                                                                                    <select type="text" name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= strtolower($value1['column_name'] ?? ''); ?>" placeholder="" value="" class="form-select">
                                                                                        <?php foreach (
                                                                                            array_filter($persalinanv, function ($values) use ($value1) {
                                                                                                return $values['p_type'] == $value1['p_type'] && $values['parameter_id'] == $value1['parameter_id'];
                                                                                            }) as $key2 => $value2
                                                                                        ) {
                                                                                        ?>
                                                                                            <option value="<?= $value2['value_id']; ?>"><?= $value2['value_desc']; ?></option>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                    } else if ($value1['entry_type'] == '4') {
                                                                    ?>
                                                                        <div class="col-sm-12 mt-2">
                                                                            <div class="form-group"><label><?= $value1['parameter_desc']; ?></label>
                                                                                <textarea name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= strtolower($value1['column_name'] ?? ''); ?>" placeholder="" value="" class="form-control"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                    } else if ($value1['entry_type'] == '5') {
                                                                    ?>
                                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label><?= $value1['parameter_desc']; ?></label>
                                                                                <div class=" position-relative">
                                                                                    <input id="flatprsl<?= strtolower($value1['column_name'] ?? ''); ?>" type="text" class="form-control datetimeflatpickr" value="">
                                                                                    <input name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= strtolower($value1['column_name'] ?? ''); ?>" type="hidden" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                    } else if ($value1['entry_type'] == '6') {
                                                                    ?>
                                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label><?= $value1['parameter_desc']; ?></label>
                                                                                <div class=" position-relative">
                                                                                    <input class="form-check-input" type="checkbox" id="prsl<?= strtolower($value1['column_name'] ?? ''); ?>" name="<?= $value1['column_name'] ?? ''; ?>" value="1">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                    } else if ($value1['entry_type'] == '7') {
                                                                    ?>
                                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                            <div class="form-group">
                                                                                <label><?= $value1['parameter_desc']; ?></label>
                                                                                <div class="row position-relative">
                                                                                    <?php foreach (
                                                                                        array_filter($persalinanv, function ($values) use ($value1) {
                                                                                            return $values['p_type'] == $value1['p_type'] && $values['parameter_id'] == $value1['parameter_id'];
                                                                                        }) as $key2 => $value2
                                                                                    ) {
                                                                                    ?>
                                                                                        <!-- <option value="<?= $value2['value_id']; ?>"><?= $value2['value_desc']; ?></option> -->
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-check mb-3"><input class="form-check-input" type="radio" name="<?= strtolower($value1['column_name']); ?>" id="<?= $value2['p_type'] . $value2['parameter_id'] . $value2['value_id']; ?>" value="<?= $value2['value_id']; ?>">
                                                                                                <label class="form-check-label" for="<?= $value2['p_type'] . $value2['parameter_id'] . $value2['value_id']; ?>"><?= $value2['value_desc']; ?></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php
                                                                                    } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        <?php
                                                        } ?>
                                                        <div class="row m-4">
                                                            <h4><b>Keadaan Lahir</b></h4>
                                                            <hr>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <table id="" class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width: 30%;">Waktu Lahir</th>
                                                                            <th style="width: 30%;">Lahir</th>
                                                                            <th style="width: 30%;">Jenis Kelamin</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="prslBayiBody"></tbody>
                                                                </table>
                                                                <div class="col-md-12">
                                                                    <div id="addBayiBtn" class="box-tab-tools text-center btn-to-hide"><a onclick="addWaktuLahir()" class="btn btn-info btn-sm btn-to-hide" style="width: 200px"><i class=" fa fa-plus"></i> Tambah</a></div>
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
                                        <div class="panel-footer text-end mb-4">
                                            <button type="button" id="formPersalinanAddBtn" name="save" data-loading-text="Tambah" class="btn btn-info pull-right d-none"><i class="fa fa-plus"></i> <span>Tambah</span></button>
                                            <button type="submit" id="formPersalinanSaveBtn" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="formPersalinanEditBtn" name="editrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                            <button type="button" id="formPersalinanSignDoctorBtn" name="signrm" onclick="signPersalinanDokter()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign Dokter</span></button>
                                            <button type="button" id="formPersalinanSignPerawatBtn" name="signrm" onclick="signPersalinaPerawat()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign Perawat</span></button>
                                            <button type="button" id="formPersalinanCetakBtn" name="" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fas fa-file"></i> <span>Cetak</span></button>
                                        </div>
                                    </div><!--./col-md-4-->
                                </div><!--./row-->
                            </div><!--./col-md-12-->
                    </div><!--./row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!--./row-->

<div class="modal fade" id="persalinanModal" role="dialog" aria-labelledby="" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <div class="col-md-8">
                    <div class="row text-start">
                        <h3><b>BAYI LAHIR</b></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <div id="modalDocument" class="border-1 rounded-4 mb-4" style="">
                    <form action="" id="formBayi" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <input name="org_unit_code" id="bayiorg_unit_code" type="hidden" />
                        <input name="visit_id" id="bayivisit_id" type="hidden" />
                        <input name="trans_id" id="bayitrans_id" type="hidden" />
                        <input name="baby_id" id="bayibaby_id" type="hidden" />
                        <input name="document_id" id="bayidocument_id" type="hidden" />
                        <input name="inspection_date" id="bayiinspection_date" type="hidden" />
                        <input name="baby_ke" id="bayibaby_ke" type="hidden" />
                        <input name="valid_date" id="bayivalid_date" type="hidden" />
                        <input name="valid_user" id="bayivalid_user" type="hidden" />
                        <input name="valid_pasien" id="bayivalid_pasien" type="hidden" />
                        <input type="hidden" name="no_registration" id="bayino_registration">
                        <input name="visit" id="bayivisit" type="hidden" value="<?= base64_encode(json_encode($visit)); ?>" />
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>No RM</label>
                                    <div class="position-relative">
                                        <input type="text" name="babyno" id="bayibabyno" placeholder="" value="" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>DPJP Anak</label>
                                    <div class="position-relative">
                                        <select class="form-select" name="employee_id" id="bayiemployee_id">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Waktu Lahir</label>
                                    <div class="position-relative">
                                        <!-- <input id="flatbayidate_of_birth" type="text" class="form-control datetimeflatpickr" value=""> -->
                                        <input name="date_of_birth" id="bayidate_of_birth" type="datetime-local" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Jenis Partus</label>
                                    <div class=" position-relative">
                                        <select name="partus" id="bayipartus" placeholder="" value="" class="form-select" required>
                                            <option value="1">Spontan Pervaginam</option>
                                            <option value="2">Sectio Caesarea</option>
                                            <option value="3">Vacum Ekstraksi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Indikasi</label>
                                    <div class="position-relative">
                                        <input type="text" name="indication" id="bayiindication" placeholder="" value="" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Lahir</label>
                                    <div class="row position-relative">
                                        <div class="col-md-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="birth_con" id="bayibirth1" value="1">
                                                <label class="form-check-label" for="bayibirth1">Hidup</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="birth_con" id="bayibirth0" value="0">
                                                <label class="form-check-label" for="bayibirth0">Mati</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div class="row position-relative">
                                        <div class="col-md-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="gender" id="bayigender1" value="1">
                                                <label class="form-check-label" for="bayigender1">Laki-laki</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="gender" id="bayigender2" value="2">
                                                <label class="form-check-label" for="bayigender0">Perempuan</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="gender" id="bayigender3" value="3">
                                                <label class="form-check-label" for="bayigender0">Ambigu</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="gender" id="bayigender0" value="0">
                                                <label class="form-check-label" for="bayigender0">-</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <div class="form-group"><label>Resusitasi</label>
                                    <textarea name="resusitasi" id="bayiresusitasi" placeholder="" value="" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row mt-4 mb-4">
                                <h4><b>Keadaan Umum</b></h4>
                                <hr>
                                <input type="hidden" id="bayiexambody_id" name="exambody_id">
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Jenis EWS</label>
                                        <select class="form-select" name="vs_status_id" id="bayiexamvs_status_id">
                                            <option value="5" selected>Neonatus</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>BB(gr)</label>
                                        <div class=" position-relative">
                                            <input onchange="" type="text" name="weight" id="bayiexamweight" placeholder="" value="" class="form-control" required>
                                            <span class="h6" id="badge-bb"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>PB(cm)</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="height" id="bayiexamheight" placeholder="" value="" class="form-control" required>
                                            <span class="h6" id="badge-bayiheight"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Suhu(°C)</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="temperature" id="bayiexamtemperature" placeholder="" value="" class="form-control" required>
                                            <span class="h6" id="badge-bayitemperature"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                    <div class="form-group">
                                        <label>Nadi(/menit)</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="nadi" id="bayiexamnadi" placeholder="" value="" class="form-control" required>
                                            <span class="h6" id="badge-bayinadi"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group"><label>T.Darah(mmHg)</label>
                                        <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                            <div class="position-relative">
                                                <input onchange="" type="text" name="tension_upper" id="bayiexamtension_upper" placeholder="" value="" class="form-control" required>
                                                <span class="h6" id="badge-bayitension_upper"></span>
                                            </div>
                                            <h4 class="mx-2">/</h4>
                                            <div class="position-relative">
                                                <input onchange="" type="text" name="tension_below" id="bayiexamtension_below" placeholder="" value="" class="form-control" required>
                                                <span class="h6" id="badge-bayitension_below"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Saturasi(SpO2%)</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="saturasi" id="bayiexamsaturasi" placeholder="" value="" class="form-control" required>
                                            <span class="h6" id="badge-bayisaturasi"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Nafas/RR(/menit)</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="nafas" id="bayiexamnafas" placeholder="" value="" class="form-control" required>
                                            <span class="h6" id="badge-bayinafas"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Kesan Umum</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="general_condition" id="bayiexamgeneral_condition" placeholder="" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Pergerakan</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="movement" id="bayimovement" placeholder="" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Warna Kulit</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="skincolor" id="bayiskincolor" placeholder="" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Turgor</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="turgor" id="bayiturgor" placeholder="" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Tonus</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="tonus" id="bayitonus" placeholder="" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Suara</label>
                                        <select class="form-select" name="sound" id="bayisound">
                                            <option value="0">Tidak Ada</option>
                                            <option value="1">Merintih</option>
                                            <option value="2">Keras</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Reflek Moro</label>
                                        <select class="form-select" name="mororeflex" id="bayimororeflex">
                                            <option value="1">+</option>
                                            <option value="0">-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Reflek Menghisap</label>
                                        <select class="form-select" name="suckingreflex" id="bayisuckingreflex">
                                            <option value="1">+</option>
                                            <option value="0">-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Memegang</label>
                                        <select class="form-select" name="holding" id="bayiholding">
                                            <option value="1">+</option>
                                            <option value="0">-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Tonus Leher</label>
                                        <select class="form-select" name="necktone" id="bayinecktone">
                                            <option value="1">+</option>
                                            <option value="0">-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>LK</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="headcircumference" id="bayiheadcircumference" placeholder="" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>LD</label>
                                        <div class="position-relative">
                                            <input onchange="" type="text" name="chestcircumference" id="bayichestcircumference" placeholder="" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Proteinuria (Perhari)</label>
                                        <select class="form-select" name="proteinuria" id="bayiexamproteinuria" onchange="vitalsignInput(this)">
                                            <option value="0">-</option>
                                            <option value="2">+</option>
                                            <option value="3">++</option>
                                        </select>
                                        <span class="h6" id="badge-bayiexamproteinuria"></span>
                                    </div>
                                </div>
                                <!-- <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Diameter Lengan(cm)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="bayiarm_diameter" placeholder="" value="" class="form-control">
                                            <span class="h6" id="badge-bayiarm_diameter"></span>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Penggunaan Oksigen (L/mnt)</label>
                                        <div class="position-relative">
                                            <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="bayioxygen_usage" placeholder="" value="" class="form-control">
                                            <span class="h6" id="badge-bayioxygen_usage"></span>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                    <div class="form-group">
                                        <label>Kesadaran</label>
                                        <select class="form-select" name="awareness" id="bayiawareness" onchange="vitalsignInput(this)">
                                            <option value="0">Sadar</option>
                                            <option value="3">Nyeri</option>
                                            <option value="10">Unrespon</option>
                                        </select>
                                        <span class="h6" id="badge-bayiawareness"></span>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row mt-4 mb-4">
                                <div id="bodyApgarBayi"></div>
                                <div id="bodyApgarBayiAddBtn" class="col-md-12 text-center">
                                    <a onclick="addApgar(1, 0, 'bayibaby_id', 'bodyApgarBayi', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah APGAR</a>
                                </div>
                            </div>
                            <div class="panel-footer text-end mb-4">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="formBayiRegisterRMBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> <span>Daftarkan RM Bayi</span></button>
                <button type="button" id="formBayiRegisterBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> <span>Daftarkan Kunjungan Bayi</span></button>
                <button type="submit" id="formBayiSaveBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                <button type="button" id="formBayiEditBtn" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                <button type="button" id="formBayiSignBtn" name="sign" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                <button type="button" id="formBayiCetakBtn" name="cetak" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fas fa-file"></i> <span>Cetak</span></button>
            </div>
        </div>
    </div>
</div>