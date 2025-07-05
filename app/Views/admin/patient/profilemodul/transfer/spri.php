<div id="atransfersprigroup" class="row" style="display: none;">
    <div class="col-sm-12 col-xs-12 col-md-12">
        <div>
            <h3>Rencana SPRI</h3>
        </div>
    </div>
    <hr>
    <div class="col-sm-12 col-xs-12 col-md-6 mb-3">
        <div class="form-group"><label for="sprinosurat">No SPRI BPJS</label>
            <input type='text' name="sprinosurat" class="form-control" id='sprinosurat' readonly />
        </div>
    </div>
    <div class="col-sm-12 col-xs-12 col-md-6 mb-3">
        <div class="form-group"><label for="sprinoskdp_rs">No SPRI RS</label>
            <input type='text' name="sprinoskdp_rs" class="form-control" id='sprinoskdp_rs' readonly />
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
                    foreach ($clinicAll as $key => $value) {
                        if ($value['stype_id'] == '1' || $value['stype_id'] == '5') {
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
            <input name="" id="flatspritglkontrol" type="text" class="form-control" readonly />
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