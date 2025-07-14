<div class="panel-footer text-start mb-4">
    <button type="submit" id="knslintsimpanbtn" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Respon</span></button>
</div>
<div id="atransferkonsulinternalgroup" class="row" style="display: none;">
    <div class="mb-4">
        <h3>Respon Konsul Internal</h3>
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="mb-3">
                    <div class="form-group">
                        <label>Tanggal Rencana</label>
                        <input id="knslintvisitdate" name="knslintvisitdate" type="hidden" class="form-control" placeholder="yyyy-mm-dd">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="mb-3">
                    <div class="form-group">
                        <label>Poli Tujuan</label>
                        <select name='knslintclinicid' id="knslintclinicid" class="form-control select2 act" style="width:100%">
                            <?php $cliniclist = array();
                            foreach (@$clinicAll as $key => $value) {
                                if (@$clinicAll[$key]['stype_id'] == '1' || @$clinicAll[$key]['stype_id'] == '5') {
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
                        <select name='knslintemployeeid' id="knslintemployeeid" class="form-control select2 act" style="width:100%">
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