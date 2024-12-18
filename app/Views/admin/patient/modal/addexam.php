<div class="modal fade" id="addExamModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Pemeriksaan Fisik Pasien</h4>
            </div><!--./modal-header-->
            <form id="formaddexam" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                <div class="modal-body pt0 pb0">
                    <input id="aeclinic_id" name="clinic_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeclass_room_id" name="class_room_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aebed_id" name="bed_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aekeluar_id" name="keluar_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeemployee_id" name="employee_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeno_registration" name="no_registration" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aevisit_id" name="visit_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeorg_unit_code" name="org_unit_code" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aedoctor" name="doctor" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aekal_id" name="kal_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aetheid" name="theid" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aethename" name="thename" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aetheaddress" name="theaddress" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aestatus_pasien_id" name="status_pasien_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeisrj" name="isrj" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aegender" name="gender" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeageyear" name="ageyear" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeagemonth" name="agemonth" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeageday" name="ageday" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <div class="row">
                        <div class="box-header border-b mb10 pl-0 pt0">
                            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"><?= $visit['diantar_oleh']; ?> (<?= $visit['no_registration']; ?>)</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-12 ptt10">

                                <?php

                                if ($visit['gender'] == '1') {
                                    $file = "uploads\images\profile_male.png";
                                } else if ($visit['gender'] == '2') {
                                    $file = "uploads\images\profile_female.png";
                                }

                                ?>
                                <img width="115" height="115" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url(); ?><?php echo $file ?>">

                            </div><!--./col-lg-5-->
                            <div class="col-lg-9 col-md-8 col-sm-12">
                                <table class="table tablecustom table-bordered mb0">
                                    <tr>
                                        <td class="bolds"><?php echo lang('Word.gender'); ?></td>
                                        <td id="gender"><?= $visit['gendername']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bolds"><?php echo lang('Word.age'); ?></td>
                                        <td id="age"><?= $visit['age']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">Alamat</td>
                                        <td id="address"><?php echo $visit['visitor_address']; ?></td>
                                    </tr>

                                    <tr>
                                        <td class="bolds">Dokter</td>
                                        <td id="dokter"><?php echo $visit['fullname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">Tanggal Masuk / Kunjung</td>
                                        <td id="visit_date"><?php echo $visit['visit_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">Tanggal Keluar</td>
                                        <td id="exit_date"><?php echo $visit['exit_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">Poli / Bangsal</td>
                                        <td id="klinik"><?php echo $visit['name_of_clinic']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">Tanggal Periksa</td>
                                        <td id="klinik"><input type='text' name="examination_date" class="form-control" id='examination_date' /></td>
                                    </tr>
                                    <script type="text/javascript">
                                        $(function() {
                                            $('#examination_date').datetimepicker({
                                                format: 'YYYY-MM-DD hh:mm:ss'
                                            });
                                        });
                                    </script>

                                </table>
                            </div><!--./col-lg-7-->
                        </div><!--./row-->
                        <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <label for="examination_date">Tgl Periksa</label>
                                <input type='text' name="examination_date" class="form-control" id='examination_date' />
                            </div>

                        </div> -->
                        <div class="col-sm-6" style="display: none;">
                            <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="aepetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-eq">
                                    <div class="box-header border-b mb10 pl-0 pt0">
                                        <h2 class="text-uppercase bolds mt0 ptt10 pull-left font14"> (S) Anamnesis</h2>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group"><label></label><textarea name="anamnase" id="aeanamnase" placeholder="" value="" class="form-control"></textarea></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-eq">
                                    <div class="box-header border-b mb10 pl-0 pt0">
                                        <h2 class="text-uppercase bolds mt0 ptt10 pull-left font14">(O) Pemeriksaan Fisik</h2>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label>Berat Badan(Kg)</label><input type="text" name="weight" id="aeweight" placeholder="" value="" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label>Tinggi(cm)</label><input type="text" name="height" id="aeheight" placeholder="" value="" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label>Suhu(°C)</label><input type="text" name="temperature" id="aetemperature" placeholder="" value="" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label>Denyut Nadi(/menit)</label><input type="text" name="nadi" id="aenadi" placeholder="" value="" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group"><label>Tekanan Darah(mmHg)</label>
                                            <div class="col-sm-12" style="display: flex;  align-items: center;">
                                                <input type="text" name="tension_upper" id="aetension_upper" placeholder="" value="" class="form-control">
                                                <h4>/</h4>
                                                <input type="text" name="tension_below" id="aetension_below" placeholder="" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label>Saturasi(SpO2%)</label><input type="text" name="saturasi" id="aesaturasi" placeholder="" value="" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label>Nafas/RR(/menit)</label><input type="text" name="nafas" id="aenafas" placeholder="" value="" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label>Diameter Lengan(cm)</label><input type="text" name="arm_diameter" id="aearm_diameter" placeholder="" value="" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="aepemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="row ptt10">
                                <div class="col-eq ptt10">
                                    <div class="box-header border-b mb10 pl-0 pt0">
                                        <h2 class="text-uppercase bolds mt0 ptt10 pull-left font14"> (A) Assesment </h2>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group"><label></label><textarea name="description" id="aedescription" placeholder="" value="" class="form-control"></textarea></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-eq ptt10">
                                    <div class="box-header border-b mb10 pl-0 pt0">
                                        <h2 class="text-uppercase bolds mt0 ptt10 pull-left font14"> (P) Rencana Penatalaksanaan </h2>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group"><label></label><textarea name="instruction" id="aeinstruction" placeholder="" value="" class="form-control"></textarea></div>
                                    </div>
                                    <div class="" id="aecustomfield"></div>
                                </div>
                            </div>
                        </div>


                    </div><!--./row-->
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="submit" id="formaddexam" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $("#aeweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aeheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aetemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aenadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aetension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aetension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aesaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aenafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aearm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });

    $("#aeclinic_id").val(skunj.clinic_id)
    $("#aeclass_room_id").val(skunj.class_room_id)
    $("#aebed_id").val(skunj.bed_id)
    $("#aekeluar_id").val(skunj.keluar_id)
    $("#aeemployee_id").val(skunj.employee_id)
    $("#aeno_registration").val(skunj.no_registration)
    $("#aevisit_id").val(skunj.visit_id)
    $("#aeorg_unit_code").val(skunj.org_unit_code)
    $("#aedoctor").val(skunj.fullname)
    $("#aekal_id").val(skunj.kal_id)
    $("#aetheid").val(skunj.pasien_id)
    $("#aethename").val(skunj.diantar_oleh)
    $("#aetheaddress").val(skunj.visitor_address)
    $("#aestatus_pasien_id").val(skunj.status_pasien_id)
    $("#aeisrj").val(skunj.isrj)
    $("#aegender").val(skunj.gender)
    $("#aeageyear").val(skunj.ageyear)
    $("#aeagemonth").val(skunj.agemonth)
    $("#aeageday").val(skunj.ageday)

    $("#formaddexam").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/addExam',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    errorSwal(message);
                } else {
                    successSwal(data.message);

                    window.location.reload(true);
                }
                clicked_submit_btn.button('reset');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                let errorMessage = "An error occurred: ";

                if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMessage = jqXHR.responseJSON.message;
                } else if (textStatus === "timeout") {
                    errorMessage = "The request timed out.";
                } else if (textStatus === "error") {
                    errorMessage = "Error: " + errorThrown;
                } else if (textStatus === "abort") {
                    errorMessage = "The request was aborted.";
                } else {
                    errorMessage = "Unknown error occurred.";
                }

                errorSwal(errorMessage);
                $("#form1btn").html('<i class="fa fa-search"></i>')
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));
</script>