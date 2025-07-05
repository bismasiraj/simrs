<div id="atransferskdpgroup" class="row" style="display: none;">
    <div class="mb-4">
        <h3>Pembuatan SKDP</h3>
        <hr>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-xs-12 mb-3">
                <div class="form-group"><label for="skdpnosurat">No SKDP BPJS</label>
                    <input type='text' name="skdpnosurat" class="form-control" id='skdpnosurat' readonly />
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xs-12 mb-3">
                <div class="form-group"><label for="skdpnoskdp_rs">No SKDP RS</label>
                    <input type='text' name="skdpnoskdp_rs" class="form-control" id='skdpnoskdp_rs' readonly />
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                <div class="form-group"><label for="skdpnosep">No SEP</label>
                    <input type='text' name="skdpnosep" class="form-control" id='skdpnosep' value="<?= is_null($visit['class_room_id']) ? $visit['no_skp'] : $visit['no_skpinap']; ?>" readonly />
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
            <div class="col-sm-12 col-md-4 col-xs-4 mb-3">
                <div class="form-group">
                    <label>Tgl Rencana Kontrol</label>
                    <input id="flatskdptglkontrol" type="text" class="form-control" placeholder="yyyy-mm-dd">
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