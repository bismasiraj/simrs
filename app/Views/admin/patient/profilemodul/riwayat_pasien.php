<div class="tab-pane" id="riwayatPasien" role="tabpanel">
    <div class="row">
        <div id="loadContentRiwayatPasien" class="col-12 center-spinner"></div>
        <div id="contentRiwayatPasien" class="col-12">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
                        'visit' => $visit,
                    ]); ?>
                </div>
                <div class="col-lg-10 col-md-10 col-xs-12">
                    <form id="formRiwayatPasien" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <input type="hidden" id="rwytorg_unit_code" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                        <input type="hidden" id="rwytno_registration" name="no_registration" value="<?= $visit['no_registration']; ?>">
                        <div class="accordion mt-4">
                            <div class="" id="">
                                <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Riwayat Pasien</h3>
                                <div class="row mt-4"><?php
                                                        $riwayatHeader = array_filter($aParameter, function ($value) {
                                                            return $value['p_type'] == 'GEN0009';
                                                        });
                                                        foreach ($riwayatHeader as $key => $value) {
                                                        ?>
                                        <div class="row">
                                            <h5><?= $value['parameter_desc']; ?></h5>
                                            <hr>
                                            <?php $riwayat = array_filter($aValue, function ($item) use ($value) {
                                                                return $item['p_type'] == $value['p_type'] && $item['parameter_id'] == $value['parameter_id'];
                                                            }); ?>
                                        </div>
                                        <?php foreach ($riwayat as $key1 => $value1) {
                                                                if ($value1['value_score'] == '4') {
                                        ?>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label for="rwyt<?= $value1['p_type'] . $value1['value_id']; ?>"><?= $value1['value_desc']; ?></label>
                                                            <textarea id="rwyt<?= $value1['p_type'] . $value1['value_id']; ?>" name="<?= $value1['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                                                } else if ($value1['value_score'] == '2') {
                                            ?>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-check mb-3">
                                                        <input id="rwyt<?= $value1['p_type'] . $value1['value_id']; ?>" class="form-check-input" type="checkbox" name="<?= $value1['value_id']; ?>" value="1" onchange="updateCheckRiwayatPasien(this.id)">
                                                        <label class="form-check-label" for="rwyt<?= $value1['p_type'] . $value1['value_id']; ?>"><?= $value1['value_desc']; ?></label>
                                                    </div>
                                                </div> <?php
                                                                }
                                                        ?>
                                        <?php
                                                            } ?>
                                    <?php
                                                        } ?>
                                </div>
                            </div>
                            <div class="panel-footer text-end mb-4">
                                <button type="button" id="formRiwayatPasienSaveBtn" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right" onclick="saveRiwayatPasien()"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                <button type="button" id="formRiwayatPasienEditBtn" name="editrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right" onclick="disableRiwayatPasien()"><i class="fa fa-edit"></i> <span>Edit</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>