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
            <div class="form-group"><label for="diag_awal">RS Tujuan</label>
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
                    <input id="flatartgl_kontrol" type="text" class="form-control datetimeflatpickr" />
                    <input id="artgl_kontrol" type="hidden" id="searchmulai" name="artgl_kontrol">

                    <!-- <input id="artgl_kontrol" name="tgl_kontrol" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#artglkontrol' value="<?= date('Y-m-d'); ?>"> -->

                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                </div>
            </div>
        </div>
    </div>
    <div id="arkdpoli_kontrolgroup" class="col-sm-4 col-md-4">
        <div class="mb-3">
            <div class="form-group">
                <label>Dokter yang Dituju</label>
                <input type="text" name="nmpoli_kontrol" id="arnmpoli_kontrol" class="form-control" />
                <!-- <select name="kdpoli_kontrol" id="arkdpoli_kontrol" class="form-control ">
                                            <?php $cliniclist = array();
                                            foreach ($clinicAll as $key => $value) {
                                                if ($clinicAll[$key]['stype_id'] == '1') {
                                                    $cliniclist[$clinicAll[$key]['clinic_id']] = $clinicAll[$key]['name_of_clinic'];
                                                }
                                            }
                                            asort($cliniclist);
                                            ?>
                                            <?php foreach ($cliniclist as $key => $value) { ?>
                                                <option value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                        </select> -->
            </div>
        </div>
    </div>
    <div id="ardiag_id1group" class="col-sm-4 col-md-4">
        <div class="mb-3">
            <div class="form-group"><label for="diag_name">Diagnosa</label>
                <input type="text" name="diag_name1" id="ardiag_name1" class="form-control" />

                <!-- <div class="select2-full-width" style="width:100%">
                                            <select class="form-control  patient_list_ajax" name='diag_id1' id="ardiag_id1" style="width: 100%">
                                            </select>
                                        </div> -->
            </div>
        </div>
    </div>
    <div id="argivengroup" class="col-sm-4 col-md-4">
        <div class="mb-3">
            <div class="form-group"><label for="argiven">Sudah saya berikan</label>
                <textarea type='text' name="given" class="form-control" id='argiven' rows="5">
                                    </textarea>
            </div>
        </div>
    </div>
    <div id="arneedsgroup" class="col-sm-4 col-md-4">
        <div class="mb-3">
            <div class="form-group"><label for="arneeds">Kebutuhan Pelayanan</label>
                <textarea type='text' name="needs" class="form-control" id='arneeds' rows="5">
            </textarea>
            </div>
        </div>
    </div>
    <div class="box-tab-tools" style="text-align: center; display: none;">
        <button type="button" id="addnorujukan" onclick="postRujukan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
        <button type="button" id="deleterujukan" onclick="deleteRujukan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
    </div>
</div>