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
        <div class="col-lg-3 col-md-3 col-sm-12">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 mt-4">
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
                                                                <input name="examination_date" id="prslexamination_date" type="datetime-local" class="form-control" value="<?php date('Y/m/d H:i:s'); ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion" id="">
                                                    <?php foreach ($persalinan as $key => $value) {
                                                    ?>
                                                        <div class="row mt-4">
                                                            <h4><b><?= $value['p_description']; ?></b></h4>
                                                            <hr>

                                                            <?php foreach (array_filter($persalinanp, function ($value) use ($persalinan, $key) {
                                                                return $value['p_type'] == $persalinan[$key]['p_type'];
                                                            }) as $key1 => $value1) {
                                                                if ($value1['entry_type'] == '1') {
                                                            ?>
                                                                    <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                        <div class="form-group">
                                                                            <label><?= $value1['parameter_desc']; ?></label>
                                                                            <div class=" position-relative">
                                                                                <input type="text" name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= strtolower($value1['column_name'] ?? ''); ?>" placeholder="" value="" class="form-control">
                                                                                <span class="h6" id="badge-bb"></span>
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
                                                                                <span class="h6" id="badge-bb"></span>
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
                                                                                <select type="text" name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= strtolower($value1['column_name'] ?? ''); ?>" placeholder="" value="" class="form-control">
                                                                                    <?php foreach (array_filter($persalinanv, function ($values) use ($value1) {
                                                                                        return $values['p_type'] == $value1['p_type'] && $values['parameter_id'] == $value1['parameter_id'];
                                                                                    }) as $key2 => $value2) {
                                                                                    ?>
                                                                                        <option value="<?= $value2['value_id']; ?>"><?= $value2['value_desc']; ?></option>
                                                                                    <?php
                                                                                    } ?>
                                                                                </select>
                                                                                <span class="h6" id="badge-bb"></span>
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
                                                                                <input name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= strtolower($value1['column_name'] ?? ''); ?>" type="datetime-local" class="form-control" value="">
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
                                                                                <span class="h6" id="badge-bb"></span>
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
                                                                                <?php foreach (array_filter($persalinanv, function ($values) use ($value1) {
                                                                                    return $values['p_type'] == $value1['p_type'] && $values['parameter_id'] == $value1['parameter_id'];
                                                                                }) as $key2 => $value2) {
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
                                            <button type="button" id="formPersalinanAddBtn" name="save" data-loading-text="Tambah" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <span>Tambah</span></button>
                                            <button type="submit" id="formPersalinanSaveBtn" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="formPersalinanEditBtn" name="editrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                            <button type="button" id="formPersalinanSignBtn" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                            <button type="button" id="formPersalinanCetakBtn" name="" onclick="cetakAssessmentMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fa fa-signature"></i> <span>Cetak</span></button>
                                        </div>
                                    </div><!--./col-md-4-->
                                </div><!--./row-->
                            </div><!--./col-md-12-->
                        </div><!--./row-->
                    </form>
                </div>
            </div>
        </div>
    </div><!--./row-->

</div>