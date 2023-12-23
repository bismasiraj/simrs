<script type='text/javascript'>
    var mrJson;
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    var examForassessment = <?= json_encode($exam); ?>;
    $(document).ready(function(e) {
        var nomor = '<?= $visit['no_registration']; ?>';
        var ke = '%'
        var mulai = '2023-08-01' //tidak terpakai
        var akhir = '2023-08-31' //tidak terpakai
        var lunas = '%'
        // var klinik = '<?= $visit['clinic_id']; ?>'
        var klinik = '%'
        var rj = '%'
        var status = '%'
        var nota = '%'
        var trans = '<?= $visit['trans_id']; ?>'
        var visit = '<?= $visit['visit_id']; ?>'
        $("#aigdexamination_date").val(get_date())
        getAssessmentIgd(visit)
    })

    function get_bodyid() {
        var m = new Date();
        m.setHours(m.getHours() + 7)
        var dateString = m.getUTCFullYear() + "-" + String(m.getUTCMonth() + 1 + 100).substring(1, 3) + "-" + String(m.getUTCDate() + 100).substring(1, 3) + " " + String(m.getUTCHours() + 100).substring(1, 3) + ":" + String(m.getUTCMinutes() + 100).substring(1, 3) + ":" + String(m.getUTCSeconds() + 100).substring(1, 3);
        return dateString;
    }

    $("#aigdweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdnadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdsaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdnafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdarm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });



    function assessmentIgdInput(prop) {
        var value = $(prop).val()
        value = (Number(value.replace(/[^\d+(\.\d{1,2})$]/g, '')).toFixed(2))

        console.log(prop.id)

        if (prop.id == "aigdtemperature") {
            // Number(GetText( )) < 50 and Number(GetText( )) > 10
            if (value < 10)
                value = 10.00

            if (value > 50)
                value = 50.00
        }
        if (prop.id == "aigdtension_upper") {
            // Number(GetText()) < 250 and Number(GetText()) > 50
            if (value < 50)
                value = 50.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "aigdnadi") {
            //Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }
        if (prop.id == "aigdweight") {
            // Number(GetText( )) < 500
            if (value > 500)
                value = 500.00
        }
        if (prop.id == "aigdheight") {
            // Number(GetText( )) between 30 and 250
            if (value < 30)
                value = 30.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "aigdtension_below") {
            // Number(GetText( )) between 0 and 300
            if (value < 0)
                value = 0.00

            if (value > 300)
                value = 300.00
        }
        if (prop.id == "aigdtension_below") {
            // Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }

        $(prop).val(value)
    }


    function setDataassessmentIgd() {
        if (typeof $("#aigdbody_id").val() !== 'undefined' || $("#aigdbody_id").val() == "") {
            // $("#aigdbody_id").val((get_bodyid() + String(Math.floor(Math.random() * 1000))).replaceAll(' ', '').replaceAll('-', '').replaceAll(':', ''))
            $("#aigdno_registration").val('<?= $visit['no_registration']; ?>')
            $("#aigdvisit_id").val('<?= $visit['visit_id']; ?>')
            $("#aigdorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
            $("#aigdclinic_id").val('<?= $visit['clinic_id']; ?>')
            $("#aigdclass_room_id").val('<?= $visit['class_room_id']; ?>')
            $("#aigdbed_id").val()
            $("#aigdkeluar_id").val('<?= $visit['keluar_id']; ?>')
            $("#aigdemployee_id").val('<?= $visit['employee_id']; ?>')
            $("#aigddoctor").val('<?= $visit['fullname']; ?>')
            $("#aigdexamination_date").val(get_date())
            $("#aigdkal_id").val('<?= $visit['kal_id']; ?>')
            $("#aigdassessment_type").val('2')
            $("#aigdtheid").val('<?= $visit['pasien_id']; ?>')
            $("#aigdthename").val('<?= $visit['diantar_oleh']; ?>')
            $("#aigdtheaddress").val('<?= $visit['visitor_address']; ?>')
            $("#aigdstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
            $("#aigdisrj").val('<?= $visit['isrj']; ?>')
            $("#aigdgender").val('<?= $visit['gender']; ?>')
            $("#aigdageyear").val('<?= $visit['ageyear']; ?>')
            $("#aigdagemonth").val('<?= $visit['agemonth']; ?>')
            $("#aigdageday").val('<?= $visit['ageday']; ?>')

            if (typeof $("#aigdriwayat_alergi").val() !== 'undefined' || $("#aigdriwayat_alergi").val() == "") {
                $("#t_04").val(2)
            }

            <?php if (isset($pasienDiagnosa['pasien_diagnosa_id'])) { ?>

                $("#aigdanamnase").val('<?= $pasienDiagnosa['anamnase']; ?>')
                $("#aigddiagnosa_desc").val('<?= $pasienDiagnosa['diagnosa_id'] . '-' . $pasienDiagnosa['diagnosa_desc']; ?>')
                $("#aigdanamnase").val('<?= $pasienDiagnosa['anamnase']; ?>')
                $("#aigdv_07").val('<?= $pasienDiagnosa['pemeriksaan']; ?>')
                $("#aigdv_33").val('<?= $pasienDiagnosa['pemeriksaan_02']; ?>')
                $("#aigdv_34").val('<?= $pasienDiagnosa['pemeriksaan_03']; ?>')
                $("#aigdv_35").val('<?= $pasienDiagnosa['pemeriksaan_05']; ?>')
                $("#aigdteraphy_desc").val('<?= $pasienDiagnosa['teraphy_desc']; ?>')
                $("#aiginstruction").val('<?= $pasienDiagnosa['instruction']; ?>')
                $("#aigeducation_date").val(get_date())
            <?php } ?>

            var diagnosaHistory = '<?php foreach ($pasienDiagnosaAll as $key => $value) {
                                        echo "(" . $pasienDiagnosaAll[$key]['diagnosa_id'] . ")" . $pasienDiagnosaAll[$key]['diagnosa_desc'] . ",";
                                    } ?>';

            examForassessment.forEach((element, key) => {
                var exam = examForassessment[key]
                $("#aigdweight").val(exam.weight)
                $("#aigdheight").val(exam.height)
                $("#aigdtension_upper").val(exam.tension_upper)
                $("#aigdtension_below").val(exam.tension_below)
                $("#aigdnadi").val(exam.nadi)
                $("#aigdtemperature").val(exam.temperature)
                $("#aigdsaturasi").val(exam.saturasi)

            });

        }
    }



    function getAssessmentIgd(visit) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getAssessmentIgd',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                data.forEach((element, key) => {
                    $('#clinic_id').val(data[key].clinic_id)
                    $('#aigdclass_room_id').val(data[key].class_room_id)
                    $('#aigdkeluar_id').val(data[key].keluar_id)
                    $('#aigdemployee_id').val(data[key].employee_id)
                    $('#aigdno_registration').val(data[key].no_registration)
                    $('#aigdvisit_id').val(data[key].visit_id)
                    $('#aigdorg_unit_code').val(data[key].org_unit_code)
                    $('#aigddoctor').val(data[key].doctor)
                    $('#aigdkal_id').val(data[key].kal_id)
                    $('#aigdtheid').val(data[key].theid)
                    $('#aigdthename').val(data[key].thename)
                    $('#aigdtheaddress').val(data[key].theaddress)
                    $('#aigdstatus_pasien_id').val(data[key].status_pasien_id)
                    $('#aigdisrj').val(data[key].isrj)
                    $('#aigdgender').val(data[key].gender)
                    $('#aigdageyear').val(data[key].ageyear)
                    $('#aigdagemonth').val(data[key].agemonth)
                    $('#aigdageday').val(data[key].ageday)
                    $('#aigdbody_id').val(data[key].body_id)
                    $('#aigdmodified_by').val(data[key].modified_by)
                    $('#aigdpasien_diagnosa_id').val(data[key].pasien_diagnosa_id)
                    $('#aigdassessment_type').val(data[key].assessment_type)
                    $('#aigdexamination_date').val(data[key].examination_date)
                    $("input[name=t_01][value=" + data[key].t_01 + "]").prop('checked', true);
                    $('#aigdv_01').val(data[key].v_01)
                    $('#aigdt_02').val(data[key].t_02)
                    $("input[name=t_02][value=" + data[key].t_02 + "]").prop('checked', true);
                    $('#aigdt_04').val(data[key].t_04)
                    $("input[name=t_04][value=" + data[key].t_04 + "]").prop('checked', true);
                    $('#aigdriwayat_alergi').val(data[key].riwayat_alergi)
                    $('#aigdv_02').val(data[key].v_02)
                    $('#aigdv_03').val(data[key].v_03)
                    $('#aigdalloanamnesis_contact').val(data[key].alloanamnesis_contact)
                    $('#aigdalloanamnesis_hub').val(data[key].alloanamnesis_hub)
                    $('#aigdanamnase').val(data[key].anamnase)
                    $('#aigddiagnosa_history').val(data[key].diagnosa_history)
                    $('#aigdriwayat_obat').val(data[key].riwayat_obat)
                    $('#aigdtension_upper').val(data[key].tension_upper)
                    $('#aigdtension_below').val(data[key].tension_below)
                    $('#aigdnadi').val(data[key].nadi)
                    $('#aigdnafas').val(data[key].nafas)
                    $('#aigdsaturasi').val(data[key].saturasi)
                    $('#aigdtemperature').val(data[key].temperature)
                    $('#aigdt_012').val(data[key].t_012)
                    $("input[name=t_012][value=" + data[key].t_012 + "]").prop('checked', true);
                    $('#aigdweight').val(data[key].weight)
                    $('#aigdheight').val(data[key].height)
                    $('#aigdpemeriksaan').val(data[key].pemeriksaan)
                    $('#aigdlokalis').val(data[key].lokalis)
                    $('#aigdv_33').val(data[key].v_33)
                    $('#aigdv_34').val(data[key].v_34)
                    $('#aigdv_35').val(data[key].v_35)
                    $('#aigddiagnosa_desc').val(data[key].diagnosa_desc)
                    $('#aigdv_36').val(data[key].v_36)
                    $('#aigdv_37').val(data[key].v_37)
                    $('#aigdinstruction').val(data[key].instruction)
                    $('#aigddescription').val(data[key].description)
                    $('#aigdt_010').val(data[key].t_010)
                    $("input[name=t_010][value=" + data[key].t_010 + "]").prop('checked', true);
                    $("input[name=t_011][value=" + data[key].t_011 + "]").prop('checked', true);
                    $('#aigdt_011').val(data[key].t_011)
                    $('#aigddirujuk').val(data[key].dirujuk)
                    $('#aigdv_31').val(data[key].v_31)
                    $('#aigdteraphy_desc').val(data[key].teraphy_desc)
                    $('#aigddiagnosa_kerja').val(data[key].diagnosa_kerja)
                    $('#aigdeducation_date').val(data[key].education_date)
                    $('#aigdv_39').val(data[key].v_39)
                    $('#aigdv_40').val(data[key].v_40)
                    $('#aigdpetugas').val(data[key].petugas)

                    disableAssessmentIgd()
                });
                if (data.length == 0) {
                    setDataassessmentIgd()
                }
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                // clicked_submit_btn.button('reset');
            },
            complete: function() {
                // clicked_submit_btn.button('reset');
            }
        });
    }



    $("#formassessmentigd").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/assessmentigd',
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
                    disableAssessmentIgd()
                    $("#formassessmentigdsubmit").toggle()
                    $("#formassessmentigdedit").toggle()
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

    function disableAssessmentIgd() {
        $('#clinic_id').prop('disabled', true)
        $('#aigdclass_room_id').prop('disabled', true)
        $('#aigdkeluar_id').prop('disabled', true)
        $('#aigdemployee_id').prop('disabled', true)
        $('#aigdno_registration').prop('disabled', true)
        $('#aigdvisit_id').prop('disabled', true)
        $('#aigdorg_unit_code').prop('disabled', true)
        $('#aigddoctor').prop('disabled', true)
        $('#aigdkal_id').prop('disabled', true)
        $('#aigdtheid').prop('disabled', true)
        $('#aigdthename').prop('disabled', true)
        $('#aigdtheaddress').prop('disabled', true)
        $('#aigdstatus_pasien_id').prop('disabled', true)
        $('#aigdisrj').prop('disabled', true)
        $('#aigdgender').prop('disabled', true)
        $('#aigdageyear').prop('disabled', true)
        $('#aigdagemonth').prop('disabled', true)
        $('#aigdageday').prop('disabled', true)
        $('#aigdbody_id').prop('disabled', true)
        $('#aigdmodified_by').prop('disabled', true)
        $('#aigdpasien_diagnosa_id').prop('disabled', true)
        $('#aigdassessment_type').prop('disabled', true)
        $('#aigdexamination_date').prop('disabled', true)
        $('#aigdv_01').prop('disabled', true)
        $('#aigdt_02').prop('disabled', true)
        $('#aigdt_04').prop('disabled', true)
        $('#aigdriwayat_alergi').prop('disabled', true)
        $('#aigdv_02').prop('disabled', true)
        $('#aigdv_03').prop('disabled', true)
        $('#aigdalloanamnesis_contact').prop('disabled', true)
        $('#aigdalloanamnesis_hub').prop('disabled', true)
        $('#aigdanamnase').prop('disabled', true)
        $('#aigddiagnosa_history').prop('disabled', true)
        $('#aigdriwayat_obat').prop('disabled', true)
        $('#aigdtension_upper').prop('disabled', true)
        $('#aigdtension_below').prop('disabled', true)
        $('#aigdnadi').prop('disabled', true)
        $('#aigdnafas').prop('disabled', true)
        $('#aigdsaturasi').prop('disabled', true)
        $('#aigdtemperature').prop('disabled', true)
        $('#aigdt_012').prop('disabled', true)
        $('#aigdweight').prop('disabled', true)
        $('#aigdheight').prop('disabled', true)
        $('#aigdpemeriksaan').prop('disabled', true)
        $('#aigdlokalis').prop('disabled', true)
        $('#aigdv_33').prop('disabled', true)
        $('#aigdv_34').prop('disabled', true)
        $('#aigdv_35').prop('disabled', true)
        $('#aigddiagnosa_desc').prop('disabled', true)
        $('#aigdv_36').prop('disabled', true)
        $('#aigdv_37').prop('disabled', true)
        $('#aigdinstruction').prop('disabled', true)
        $('#aigddescription').prop('disabled', true)
        $('#aigdt_010').prop('disabled', true)
        $('#aigdt_011').prop('disabled', true)
        $('#aigddirujuk').prop('disabled', true)
        $('#aigdv_31').prop('disabled', true)
        $('#aigdteraphy_desc').prop('disabled', true)
        $('#aigddiagnosa_kerja').prop('disabled', true)
        $('#aigdeducation_date').prop('disabled', true)
        $('#aigdv_39').prop('disabled', true)
        $('#aigdv_40').prop('disabled', true)
        $('#aigdpetugas').prop('disabled', true)
        $("input[name=t_01]").prop('disabled', true);
        $("input[name=t_02]").prop('disabled', true);
        $("input[name=t_04]").prop('disabled', true);
        $("input[name=t_012]").prop('disabled', true);
        $("input[name=t_010]").prop('disabled', true);
        $("input[name=t_011]").prop('disabled', true);

    }

    function enableAssessmentIgd() {
        $('#clinic_id').prop('disabled', false)
        $('#aigdclass_room_id').prop('disabled', false)
        $('#aigdkeluar_id').prop('disabled', false)
        $('#aigdemployee_id').prop('disabled', false)
        $('#aigdno_registration').prop('disabled', false)
        $('#aigdvisit_id').prop('disabled', false)
        $('#aigdorg_unit_code').prop('disabled', false)
        $('#aigddoctor').prop('disabled', false)
        $('#aigdkal_id').prop('disabled', false)
        $('#aigdtheid').prop('disabled', false)
        $('#aigdthename').prop('disabled', false)
        $('#aigdtheaddress').prop('disabled', false)
        $('#aigdstatus_pasien_id').prop('disabled', false)
        $('#aigdisrj').prop('disabled', false)
        $('#aigdgender').prop('disabled', false)
        $('#aigdageyear').prop('disabled', false)
        $('#aigdagemonth').prop('disabled', false)
        $('#aigdageday').prop('disabled', false)
        $('#aigdbody_id').prop('disabled', false)
        $('#aigdmodified_by').prop('disabled', false)
        $('#aigdpasien_diagnosa_id').prop('disabled', false)
        $('#aigdassessment_type').prop('disabled', false)
        $('#aigdexamination_date').prop('disabled', false)
        $('#aigdv_01').prop('disabled', false)
        $('#aigdt_02').prop('disabled', false)
        $('#aigdt_04').prop('disabled', false)
        $('#aigdriwayat_alergi').prop('disabled', false)
        $('#aigdv_02').prop('disabled', false)
        $('#aigdv_03').prop('disabled', false)
        $('#aigdalloanamnesis_contact').prop('disabled', false)
        $('#aigdalloanamnesis_hub').prop('disabled', false)
        $('#aigdanamnase').prop('disabled', false)
        $('#aigddiagnosa_history').prop('disabled', false)
        $('#aigdriwayat_obat').prop('disabled', false)
        $('#aigdtension_upper').prop('disabled', false)
        $('#aigdtension_below').prop('disabled', false)
        $('#aigdnadi').prop('disabled', false)
        $('#aigdnafas').prop('disabled', false)
        $('#aigdsaturasi').prop('disabled', false)
        $('#aigdtemperature').prop('disabled', false)
        $('#aigdt_012').prop('disabled', false)
        $('#aigdweight').prop('disabled', false)
        $('#aigdheight').prop('disabled', false)
        $('#aigdpemeriksaan').prop('disabled', false)
        $('#aigdlokalis').prop('disabled', false)
        $('#aigdv_33').prop('disabled', false)
        $('#aigdv_34').prop('disabled', false)
        $('#aigdv_35').prop('disabled', false)
        $('#aigddiagnosa_desc').prop('disabled', false)
        $('#aigdv_36').prop('disabled', false)
        $('#aigdv_37').prop('disabled', false)
        $('#aigdinstruction').prop('disabled', false)
        $('#aigddescription').prop('disabled', false)
        $('#aigdt_010').prop('disabled', false)
        $('#aigdt_011').prop('disabled', false)
        $('#aigddirujuk').prop('disabled', false)
        $('#aigdv_31').prop('disabled', false)
        $('#aigdteraphy_desc').prop('disabled', false)
        $('#aigddiagnosa_kerja').prop('disabled', false)
        $('#aigdeducation_date').prop('disabled', false)
        $('#aigdv_39').prop('disabled', false)
        $('#aigdv_40').prop('disabled', false)
        $('#aigdpetugas').prop('disabled', false)
        $("input[name=t_01]").prop('disabled', false);
        $("input[name=t_02]").prop('disabled', false);
        $("input[name=t_04]").prop('disabled', false);
        $("input[name=t_012]").prop('disabled', false);
        $("input[name=t_010]").prop('disabled', false);
        $("input[name=t_011]").prop('disabled', false);

        $("#formassessmentigdsubmit").toggle()
        $("#formassessmentigdedit").toggle()
    }
</script>