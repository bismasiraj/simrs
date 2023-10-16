<div class="modal fade" id="editExamModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Pemeriksaan Fisik Pasien</h4>
            </div><!--./modal-header-->
            <form id="formeditexam" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                <div class="modal-body pt0 pb0">
                    <input id="eeclinic_id" name="clinic_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eeclass_room_id" name="class_room_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eebed_id" name="bed_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eekeluar_id" name="keluar_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eeemployee_id" name="employee_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eeno_registration" name="no_registration" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eevisit_id" name="visit_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eeorg_unit_code" name="org_unit_code" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eedoctor" name="doctor" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eekal_id" name="kal_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eetheid" name="theid" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eethename" name="thename" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eetheaddress" name="theaddress" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eestatus_pasien_id" name="status_pasien_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eeisrj" name="isrj" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eegender" name="gender" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eeageyear" name="ageyear" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eeagemonth" name="agemonth" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eeageday" name="ageday" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eebody_id" name="body_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />

                    <div class="row">

                        <div class="col-sm-3" style="display: none;">
                            <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="eepetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="examination_date">Tgl Periksa</label>
                                <input type='text' name="examination_date" class="form-control" id='eeexamination_date' />
                            </div>
                            <script type="text/javascript">
                                $(function() {
                                    $('#eeexamination_date').datetimepicker({
                                        format: 'YYYY-MM-DD hh:mm:ss'
                                    });
                                });
                            </script>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Berat Badan(Kg)</label><input type="text" name="weight" id="eeweight" placeholder="" value="" class="form-control"></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Tinggi(cm)</label><input type="text" name="height" id="eeheight" placeholder="" value="" class="form-control"></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Suhu(°C)</label><input type="text" name="temperature" id="eetemperature" placeholder="" value="" class="form-control"></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Denyut Nadi(/menit)</label><input type="text" name="nadi" id="eenadi" placeholder="" value="" class="form-control"></div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group"><label>Tekanan Darah(mmHg)</label>
                                <div class="col-sm-12" style="display: flex;  align-items: center;">
                                    <input type="text" name="tension_upper" id="eetension_upper" placeholder="" value="" class="form-control">
                                    <h4>/</h4>
                                    <input type="text" name="tension_below" id="eetension_below" placeholder="" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Saturasi(SpO2%)</label><input type="text" name="saturasi" id="eesaturasi" placeholder="" value="" class="form-control"></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Nafas/RR(/menit)</label><input type="text" name="nafas" id="eenafas" placeholder="" value="" class="form-control"></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Diameter Lengan(cm)</label><input type="text" name="arm_diameter" id="eearm_diameter" placeholder="" value="" class="form-control"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-3">
                                    <div class="form-group"><label>Anamnesis</label><textarea name="anamnase" id="eeanamnase" placeholder="" value="" class="form-control"></textarea></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="eepemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group"><label>Implementasi</label><textarea name="teraphy_desc" id="eeteraphy_desc" placeholder="" value="" class="form-control"></textarea></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group"><label>Keterangan</label><textarea name="description" id="eedescription" placeholder="" value="" class="form-control"></textarea></div>
                                </div>
                            </div>
                        </div>
                        <div class="" id="eecustomfield"></div>
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
    function editExamFunc(key) {
        examselect = exam[key];

        console.log(examselect)

        $("#eeclinic_id").val(examselect.clinic_id)
        $("#eeclass_room_id").val(examselect.class_room_id)
        $("#eebed_id").val(examselect.bed_id)
        $("#eekeluar_id").val(examselect.keluar_id)
        $("#eeemployee_id").val(examselect.employee_id)
        $("#eeno_registration").val(examselect.no_registration)
        $("#eevisit_id").val(examselect.visit_id)
        $("#eeorg_unit_code").val(examselect.org_unit_code)
        $("#eedoctor").val(examselect.fullname)
        $("#eekal_id").val(examselect.kal_id)
        $("#eetheid").val(examselect.pasien_id)
        $("#eethename").val(examselect.diantar_oleh)
        $("#eetheaddress").val(examselect.visitor_address)
        $("#eestatus_pasien_id").val(examselect.status_pasien_id)
        $("#eeisrj").val(examselect.isrj)
        $("#eegender").val(examselect.gender)
        $("#eeageyear").val(examselect.ageyear)
        $("#eeagemonth").val(examselect.agemonth)
        $("#eeageday").val(examselect.ageday)
        $("#eebody_id").val(examselect.body_id)

        $("#eeexamination_date").val(examselect.examination_date)
        $("#eepetugas").val(examselect.petugas)
        $("#eeweight").val(examselect.weight)
        $("#eeheight").val(examselect.height)
        $("#eetemperature").val(examselect.temperature)
        $("#eenadi").val(examselect.nadi)
        $("#eetension_upper").val(examselect.tension_upper)
        $("#eetension_below").val(examselect.tension_below)
        $("#eesaturasi").val(examselect.saturasi)
        $("#eenafas").val(examselect.nafas)
        $("#eearm_diameter").val(examselect.arm_diameter)
        $("#eeanamnase").val(examselect.anamnase)
        $("#eepemeriksaan").val(examselect.pemeriksaan)
        $("#eeteraphy_desc").val(examselect.teraphy_desc)
        $("#eedescription").val(examselect.description)
        $("#eeclinic_id").val(examselect.clinic_id)
        $("#eeclass_room_id").val(examselect.class_room_id)
        $("#eebed_id").val(examselect.bed_id)
        $("#eekeluar_id").val(examselect.keluar_id)
        $("#eeemployee_id").val(examselect.employee_id)
        $("#eeno_registraiton").val(examselect.no_registraiton)
        $("#eevisit_id").val(examselect.visit_id)
        $("#eeorg_unit_code").val(examselect.org_unit_code)
        $("#eedoctor").val(examselect.doctor)
        $("#eekal_id").val(examselect.kal_id)
        $("#eetheid").val(examselect.theid)
        $("#eethename").val(examselect.thename)
        $("#eetheaddress").val(examselect.theaddress)
        $("#eestatus_pasien_id").val(examselect.status_pasien_id)
        $("#eeisrj").val(examselect.isrj)
        $("#eegender").val(examselect.gender)
        $("#eeageyear").val(examselect.ageyear)
        $("#eeagemonth").val(examselect.agemonth)
        $("#eeageday").val(examselect.ageday)


        holdModal("editExamModal")
    }
</script>

<script type="text/javascript">
    $("#eeweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#eeheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#eetemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#eenadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#eetension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#eetension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#eesaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#eenafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#eearm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });

    $("#eeclinic_id").val(skunj.clinic_id)
    $("#eeclass_room_id").val(skunj.class_room_id)
    $("#eebed_id").val(skunj.bed_id)
    $("#eekeluar_id").val(skunj.keluar_id)
    $("#eeemployee_id").val(skunj.employee_id)
    $("#eeno_registration").val(skunj.no_registration)
    $("#eevisit_id").val(skunj.visit_id)
    $("#eeorg_unit_code").val(skunj.org_unit_code)
    $("#eedoctor").val(skunj.fullname)
    $("#eekal_id").val(skunj.kal_id)
    $("#eetheid").val(skunj.pasien_id)
    $("#eethename").val(skunj.diantar_oleh)
    $("#eetheaddress").val(skunj.visitor_address)
    $("#eestatus_pasien_id").val(skunj.status_pasien_id)
    $("#eeisrj").val(skunj.isrj)
    $("#eegender").val(skunj.gender)
    $("#eeageyear").val(skunj.ageyear)
    $("#eeagemonth").val(skunj.agemonth)
    $("#eeageday").val(skunj.ageday)

    $("#formeditexam").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/editExam',
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
                    errorMsg(message);
                } else {
                    successMsg(data.message);

                    window.location.reload(true);
                }
                clicked_submit_btn.button('reset');
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));
</script>