<div class="modal fade" id="hasilRad" role="dialog" aria-labelledby="myModalLabel" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <div class="col-sm-8 col-md-8">
                    <H3>Hasil Radiologi</H3>
                </div>
                <div class="col-md-4 text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="singlelist24bold pb10">
                                    <h4 id="ardpatient_name"><?= $visit['diantar_oleh']; ?> (<?= $visit['no_registration']; ?>)</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="patientDetails" style="display:block">

                            <div class="col-md-9 col-sm-9 col-xs-9" id="Myinfo" style="float:left">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <table class="table table-borderless table-hover mb0">
                                            <tbody>
                                                <tr>
                                                    <td class="bolds text-end">Jenis Kelamin</td>
                                                    <td id="radgender"><?= $visit['gendername'] ?? ''; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bolds">Asuransi</td>
                                                    <td id="radstatus_pasien_id"><?= $visit['status_pasien_id']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bolds">Usia</td>
                                                    <td id="radage"><?= $visit['age']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <table class="table table-borderless table-hover mb0">
                                            <tbody>
                                                <tr>
                                                    <td class="bolds">No. SEP</td>
                                                    <td id="radno_skp"><?= $visit['no_skp']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bolds">Tanggal Kunjungan</td>
                                                    <td id="radvisit_date"><?= substr($visit['visit_date'], 0, 13); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- ./col-md-9 -->
                            <?php

                            if ($visit['gender'] == '1') {
                                $file = "uploads\images\profile_male.png";
                            } else if ($visit['gender'] == '2') {
                                $file = "uploads\images\profile_female.png";
                            }

                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-12" style="float:left">
                                <img class="profile-user-img img-responsive" src="<?php echo base_url(); ?>uploads\images\hasilradiologi.jpg" id="image" alt="User profile picture" style="height: 200px; width: 100% !important">
                            </div><!-- ./col-md-3 -->
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <div class="form-group"><label for="fillsuffer_type">Jenis Pemeriksaan</label>
                            <input id="radtarif_name" name="tarif_name" placeholder="" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <div class="form-group"><label for="filldiag_cat">No Film</label>
                            <input id="radspecimen_no" name="specimen_no" placeholder="" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group"><label for="filldiag_cat">Diagnosa Klinis</label>
                            <textarea id="raddescription" name="description" rows="2" class="form-control" autocomplete="off" readonly></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <div class="form-group"><label for="fillsuffer_type">Hasil Pemeriksaan </label>
                            <input id="radresult_typecode" name="tarif_name" placeholder="" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <div class="form-group"><label for="filldiag_cat">Kesimpulan Singkat</label>
                            <input id="radresult_type" name="specimen_no" placeholder="" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group"><label for="filldiag_cat">Hasil Baca</label>
                            <textarea id="radresult_value" name="result_value" rows="4" class="form-control" autocomplete="off" readonly></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group"><label for="filldiag_cat">Catatan Kesimpulan</label>
                            <textarea id="radconclution" name="conclution" rows="2" class="form-control" autocomplete="off" readonly></textarea>
                        </div>
                    </div>

                </div><!--./row-->
            </div>
            <!-- <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" id="adddiagbtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                </div>
            </div> -->
        </div>
    </div>
</div>


<script type="text/javascript">
    function getTreatResult(nomor, visit, tarif_id) {
        holdModal('hasilRad')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getTreatResult',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor,
                'visit': visit.visit_id,
                'tarif_id': tarif_id,
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                data.forEach((element, key) => {

                    $("#radtarif_name").val(data[key].tarif_name)
                    $("#radspecimen_no").val(data[key].specimen_id)
                    $("#raddescription").val(data[key].description)
                    $("#radresult_typecode").val(data[key].result_symbol)
                    $("#radresult_type").val(data[key].result_name)
                    $("#radresult_value").val(data[key].result_value)
                    $("#radconclution").val(data[key].conclution)

                });
                $("#hasilRad").modal('show')
            },
            error: function() {

            }
        });
    }
</script>