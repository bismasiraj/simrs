<script type='text/javascript'>
    var mrJson;
    var lastOrder = 0;
    var vitalsign = <?= json_encode($exam); ?>;

    $("#vitalsignTab").on("click", function() {
        getVitalSign()
    })
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
        $("#avtexamination_date").val(get_date())
        setDataVitalSign()
    })


    $("#avtweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#avtheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#avttemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#avtnadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#avttension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#avttension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#avtsaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#avtnafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#avtarm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });

    function setDataVitalSign() {
        $("#formvitalsign").find("input, textarea").val(null)

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#avtbody_id").val(bodyId)
        $("#avtclinic_id").val('<?= $visit['clinic_id']; ?>')
        $("#avtclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#avtbed_id").val()
        $("#avtkeluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#avtemployee_id").val('<?= $visit['employee_id']; ?>')
        $("#avtno_registration").val('<?= $visit['no_registration']; ?>')
        $("#avtvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#avtorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#avtdoctor").val('<?= $visit['fullname']; ?>')
        $("#avtkal_id").val('<?= $visit['kal_id']; ?>')
        $("#avttheid").val('<?= $visit['pasien_id']; ?>')
        $("#avtthename").val('<?= $visit['diantar_oleh']; ?>')
        $("#avttheaddress").val('<?= $visit['visitor_address']; ?>')
        $("#avtstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#avtisrj").val('<?= $visit['isrj']; ?>')
        $("#avtgender").val('<?= $visit['gender']; ?>')
        $("#avtageyear").val('<?= $visit['ageyear']; ?>')
        $("#avtagemonth").val('<?= $visit['agemonth']; ?>')
        $("#avtageday").val('<?= $visit['ageday']; ?>')
        $("#avtexamination_date").val(get_date())
        $("#avtvs_status_id").val(8)
    }

    function addRowVitalSign(examselect, key) {
        $("#vitalSignBody").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date).substring(0, 16)))
                .append($("<td rowspan='7'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="copyVitalSign(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editCppt(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
            .append($("<tr>")
                .append($("<td>").html(''))
                .append($("<td>").html(examselect.tension_upper + '/' + examselect.tension_below + 'mmHg'))
                .append($("<td>").html(examselect.nadi + '/menit'))
                .append($("<td>").html(examselect.nafas + '/menit'))
                .append($("<td>").html(examselect.temperature + '/°C'))
                .append($("<td>").html(examselect.saturasi + '/SpO2%'))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>S</b>"))
                .append($("<td colspan='5'>").html(examselect.anamnase))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>O</b>"))
                .append($("<td colspan='5'>").html(examselect.pemeriksaan))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>A</b>"))
                .append($("<td colspan='5'>").html(examselect.description))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>P</b>"))
                .append($("<td colspan='5'>").html(examselect.instruction))
            )
            .append($("<tr>")
                .append($("<td>").html("Instruksi"))
                .append($("<td colspan='5'>").html(examselect.instruction))
            )
    }

    function vitalsignInput(prop) {
        var value = $(prop).val()
        value = (Number(value.replace(/[^\d+(\.\d{1,2})$]/g, '')).toFixed(2))

        console.log(prop.id)

        if (prop.id == "cppttemperature") {
            // Number(GetText( )) < 50 and Number(GetText( )) > 10
            if (value < 10)
                value = 10.00

            if (value > 50)
                value = 50.00
        }
        if (prop.id == "aetension_upper") {
            // Number(GetText()) < 250 and Number(GetText()) > 50
            if (value < 50)
                value = 50.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "aetnadi") {
            //Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }
        if (prop.id == "aeweight") {
            // Number(GetText( )) < 500
            if (value > 500)
                value = 500.00
        }
        if (prop.id == "aeheight") {
            // Number(GetText( )) between 30 and 250
            if (value < 30)
                value = 30.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "aetension_below") {
            // Number(GetText( )) between 0 and 300
            if (value < 0)
                value = 0.00

            if (value > 300)
                value = 300.00
        }
        if (prop.id == "aetension_below") {
            // Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }

        $(prop).val(value)
    }

    function disableVitalSign() {
        $("#avtexamination_date").prop("disabled", true)
        $("#avtpetugas").prop("disabled", true)
        $("#avtweight").prop("disabled", true)
        $("#avtheight").prop("disabled", true)
        $("#avttemperature").prop("disabled", true)
        $("#avtnadi").prop("disabled", true)
        $("#avttension_upper").prop("disabled", true)
        $("#avttension_below").prop("disabled", true)
        $("#avtsaturasi").prop("disabled", true)
        $("#avtnafas").prop("disabled", true)
        $("#avtarm_diameter").prop("disabled", true)
        $("#avtanamnase").prop("disabled", true)
        $("#avtpemeriksaan").prop("disabled", true)
        $("#avtteraphy_desc").prop("disabled", true)
        $("#avtdescription").prop("disabled", true)
        $("#avtclinic_id").prop("disabled", true)
        $("#avtclass_room_id").prop("disabled", true)
        $("#avtbed_id").prop("disabled", true)
        $("#avtkeluar_id").prop("disabled", true)
        $("#avtemployee_id").prop("disabled", true)
        $("#avtno_registraiton").prop("disabled", true)
        $("#avtvisit_id").prop("disabled", true)
        $("#avtorg_unit_code").prop("disabled", true)
        $("#avtdoctor").prop("disabled", true)
        $("#avtkal_id").prop("disabled", true)
        $("#avttheid").prop("disabled", true)
        $("#avtthename").prop("disabled", true)
        $("#avttheaddress").prop("disabled", true)
        $("#avtstatus_pasien_id").prop("disabled", true)
        $("#avtisrj").prop("disabled", true)
        $("#avtgender").prop("disabled", true)
        $("#avtageyear").prop("disabled", true)
        $("#avtagemonth").prop("disabled", true)
        $("#avtageday").prop("disabled", true)
        $("#avtinstruction").prop("disabled", true)
    }

    function enableVitalSign() {
        $("#avtexamination_date").prop("disabled", false)
        $("#avtpetugas").prop("disabled", false)
        $("#avtweight").prop("disabled", false)
        $("#avtheight").prop("disabled", false)
        $("#avttemperature").prop("disabled", false)
        $("#avtnadi").prop("disabled", false)
        $("#avttension_upper").prop("disabled", false)
        $("#avttension_below").prop("disabled", false)
        $("#avtsaturasi").prop("disabled", false)
        $("#avtnafas").prop("disabled", false)
        $("#avtarm_diameter").prop("disabled", false)
        $("#avtanamnase").prop("disabled", false)
        $("#avtpemeriksaan").prop("disabled", false)
        $("#avtteraphy_desc").prop("disabled", false)
        $("#avtdescription").prop("disabled", false)
        $("#avtclinic_id").prop("disabled", false)
        $("#avtclass_room_id").prop("disabled", false)
        $("#avtbed_id").prop("disabled", false)
        $("#avtkeluar_id").prop("disabled", false)
        $("#avtemployee_id").prop("disabled", false)
        $("#avtno_registraiton").prop("disabled", false)
        $("#avtvisit_id").prop("disabled", false)
        $("#avtorg_unit_code").prop("disabled", false)
        $("#avtdoctor").prop("disabled", false)
        $("#avtkal_id").prop("disabled", false)
        $("#avttheid").prop("disabled", false)
        $("#avtthename").prop("disabled", false)
        $("#avttheaddress").prop("disabled", false)
        $("#avtstatus_pasien_id").prop("disabled", false)
        $("#avtisrj").prop("disabled", false)
        $("#avtgender").prop("disabled", false)
        $("#avtageyear").prop("disabled", false)
        $("#avtagemonth").prop("disabled", false)
        $("#avtageday").prop("disabled", false)
        $("#avtinstruction").prop("disabled", false)

        $("#formvitalsignsubmit").toggle()
        $("#formvitalsignedit").toggle()
    }

    var vitalsigndesc = []

    var i = 0

    // for (let index = vitalsign.length; index >= 0; index--) {
    //     vitalsigndesc.push(vitalsign[index]);
    // }
    // console.log(vitalsigndesc)
    // vitalsign = vitalsigndesc

    vitalsign.forEach((element, key) => {
        examselect = vitalsign[key];
        addRowVitalSign(examselect, key)
    });

    vitalsign.forEach((element, key) => {
        examselect = vitalsign[key];

        if (examselect.visit_id == '<?= $visit['visit_id']; ?>') {

            disableVitalSign()
            $("#formvitalsignsubmit").hide()
            $("#formvitalsignedit").show()

            $("#avtclinic_id").val(examselect.clinic_id)
            $("#avtclass_room_id").val(examselect.class_room_id)
            $("#avtbed_id").val(examselect.bed_id)
            $("#avtkeluar_id").val(examselect.keluar_id)
            $("#avtemployee_id").val(examselect.employee_id)
            $("#avtno_registration").val(examselect.no_registration)
            $("#avtvisit_id").val(examselect.visit_id)
            $("#avtorg_unit_code").val(examselect.org_unit_code)
            $("#avtdoctor").val(examselect.fullname)
            $("#avtkal_id").val(examselect.kal_id)
            $("#avttheid").val(examselect.pasien_id)
            $("#avtthename").val(examselect.diantar_oleh)
            $("#avttheaddress").val(examselect.visitor_address)
            $("#avtstatus_pasien_id").val(examselect.status_pasien_id)
            $("#avtisrj").val(examselect.isrj)
            $("#avtgender").val(examselect.gender)
            $("#avtageyear").val(examselect.ageyear)
            $("#avtagemonth").val(examselect.agemonth)
            $("#avtageday").val(examselect.ageday)
            $("#avtbody_id").val(examselect.body_id)

            $("#avtexamination_date").val(examselect.examination_date)
            $("#avtpetugas").val(examselect.petugas)
            $("#avtweight").val(examselect.weight)
            $("#avtheight").val(examselect.height)
            $("#avttemperature").val(examselect.temperature)
            $("#avtnadi").val(examselect.nadi)
            $("#avttension_upper").val(examselect.tension_upper)
            $("#avttension_below").val(examselect.tension_below)
            $("#avtsaturasi").val(examselect.saturasi)
            $("#avtnafas").val(examselect.nafas)
            $("#avtarm_diameter").val(examselect.arm_diameter)
            $("#avtanamnase").val(examselect.anamnase)
            $("#avtpemeriksaan").val(examselect.pemeriksaan)
            $("#avtteraphy_desc").val(examselect.teraphy_desc)
            $("#avtdescription").val(examselect.description)
            $("#avtclinic_id").val(examselect.clinic_id)
            $("#avtclass_room_id").val(examselect.class_room_id)
            $("#avtbed_id").val(examselect.bed_id)
            $("#avtkeluar_id").val(examselect.keluar_id)
            $("#avtemployee_id").val(examselect.employee_id)
            $("#avtno_registraiton").val(examselect.no_registraiton)
            $("#avtvisit_id").val(examselect.visit_id)
            $("#avtorg_unit_code").val(examselect.org_unit_code)
            $("#avtdoctor").val(examselect.doctor)
            $("#avtkal_id").val(examselect.kal_id)
            $("#avttheid").val(examselect.theid)
            $("#avtthename").val(examselect.thename)
            $("#avttheaddress").val(examselect.theaddress)
            $("#avtstatus_pasien_id").val(examselect.status_pasien_id)
            $("#avtisrj").val(examselect.isrj)
            $("#avtgender").val(examselect.gender)
            $("#avtageyear").val(examselect.ageyear)
            $("#avtagemonth").val(examselect.agemonth)
            $("#avtageday").val(examselect.ageday)
            $("#avtinstruction").val(examselect.instruction)
        }

        if (typeof $("#avtbody_id").val() !== 'undefined' || $("#avtbody_id").val() == "") {
            $("#avtclinic_id").val('<?= $visit['clinic_id']; ?>')
            $("#avtclass_room_id").val('<?= $visit['class_room_id']; ?>')
            $("#avtbed_id").val()
            $("#avtkeluar_id").val('<?= $visit['keluar_id']; ?>')
            $("#avtemployee_id").val('<?= $visit['employee_id']; ?>')
            $("#avtno_registration").val('<?= $visit['no_registration']; ?>')
            $("#avtvisit_id").val('<?= $visit['visit_id']; ?>')
            $("#avtorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
            $("#avtdoctor").val('<?= $visit['fullname']; ?>')
            $("#avtkal_id").val('<?= $visit['kal_id']; ?>')
            $("#avttheid").val('<?= $visit['pasien_id']; ?>')
            $("#avtthename").val('<?= $visit['diantar_oleh']; ?>')
            $("#avttheaddress").val('<?= $visit['visitor_address']; ?>')
            $("#avtstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
            $("#avtisrj").val('<?= $visit['isrj']; ?>')
            $("#avtgender").val('<?= $visit['gender']; ?>')
            $("#avtageyear").val('<?= $visit['ageyear']; ?>')
            $("#avtagemonth").val('<?= $visit['agemonth']; ?>')
            $("#avtageday").val('<?= $visit['ageday']; ?>')


        }
    });
    $("#formvitalsign").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        clicked_submit_btn.html('<i class="spinner-border spinner-border-sm"></i>')
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
                    disableVitalSign()
                    $("#formvitalsignsubmit").toggle()
                    $("#formvitalsignedit").toggle()
                }
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            error: function(xhr) { // if error occured
                errorMsg("Error occured.please try again");
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            complete: function() {
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            }
        });
    }));

    function getVitalSign() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentKeperawatan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                vitalsign = data.examInfo

                $("#vitalSignBody").html("")
                vitalsign.forEach((element, key) => {
                    examselect = vitalsign[key];
                    addRowVitalSign(examselect, key)
                });
            },
            error: function() {

            }
        });
    }
</script>

<script>
    function copyVitalSign(key) {
        var examselect = vitalsign[key];

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#avtageday").val(examselect.ageday)
        $("#avtagemonth").val(examselect.agemonth)
        $("#avtageyear").val(examselect.ageyear)
        $("#avtanamnase").val(examselect.anamnase)
        $("#avtarm_diameter").val(examselect.arm_diameter)
        $("#avtbed_id").val(examselect.bed_id)
        $("#avtbody_id").val(bodyId)
        $("#avtclass_room_id").val(examselect.class_room_id)
        $("#avtclinic_id").val(examselect.clinic_id)
        $("#avtdescription").val(examselect.description)
        $("#avtdoctor").val(examselect.doctor)
        $("#avtemployee_id").val(examselect.employee_id)
        $("#avtexamination_date").val(get_date())
        $("#avtgender").val(examselect.gender)
        $("#avtheight").val(examselect.height)
        $("#avtinstruction").val(examselect.instruction)
        $("#avtisrj").val(examselect.isrj)
        $("#avtkal_id").val(examselect.kal_id)
        $("#avtkeluar_id").val(examselect.keluar_id)
        $("#avtnadi").val(examselect.nadi)
        $("#avtnafas").val(examselect.nafas)
        $("#avtno_registraiton").val(examselect.no_registraiton)
        $("#avtorg_unit_code").val(examselect.org_unit_code)
        $("#avtpemeriksaan").val(examselect.pemeriksaan)
        $("#avtpetugas").val(examselect.petugas)
        $("#avtsaturasi").val(examselect.saturasi)
        $("#avtstatus_pasien_id").val(examselect.status_pasien_id)
        $("#avttemperature").val(examselect.temperature)
        $("#avttension_below").val(examselect.tension_below)
        $("#avttension_upper").val(examselect.tension_upper)
        $("#avtteraphy_desc").val(examselect.teraphy_desc)
        $("#avttheaddress").val(examselect.theaddress)
        $("#avttheid").val(examselect.pasien_id)
        $("#avtthename").val(examselect.diantar_oleh)
        $("#avtvisit_id").val(examselect.visit_id)
        $("#avtweight").val(examselect.weight)

        $("#avtorg_unit_code").val(examselect.org_unit_code)
        $("#avtpasien_diagnosa_id").val(examselect.pasien_diagnosa_id)
        $("#avtno_registration").val(examselect.no_registration)
        $("#avtvisit_id").val(examselect.visit_id)
        $("#avttrans_id").val(examselect.trans_id)
        $("#avtbill_id").val(examselect.bill_id)
        $("#avtclass_room_id").val(examselect.class_room_id)
        $("#avtbed_id").val(examselect.bed_id)
        $("#avtin_date").val(examselect.in_date)
        $("#avtexit_date").val(examselect.exit_date)
        $("#avtkeluar_id").val(examselect.keluar_id)
        $("#avtimt_score").val(examselect.imt_score)
        $("#avtimt_desc").val(examselect.imt_desc)
        $("#avtpemeriksaan").val(examselect.pemeriksaan)
        $("#avtmedical_treatment").val(examselect.medical_treatment)
        $("#avtmodified_date").val(examselect.modified_date)
        $("#avtmodified_by").val(examselect.modified_by)
        $("#avtmodified_from").val(examselect.modified_from)
        $("#avtstatus_pasien_id").val(examselect.status_pasien_id)
        $("#avtageyear").val(examselect.ageyear)
        $("#avtagemonth").val(examselect.agemonth)
        $("#avtageday").val(examselect.ageday)
        $("#avtthename").val(examselect.thename)
        $("#avttheaddress").val(examselect.theaddress)
        $("#avttheid").val(examselect.theid)
        $("#avtisrj").val(examselect.isrj)
        $("#avtgender").val(examselect.gender)
        $("#avtdoctor").val(examselect.doctor)
        $("#avtkal_id").val(examselect.kal_id)
        $("#avtpetugas_id").val(examselect.petugas_id)
        $("#avtpetugas").val(examselect.petugas)
        $("#avtaccount_id").val(examselect.account_id)
        $("#avtkesadaran").val(examselect.kesadaran)
        $("#avtisvalid").val(examselect.isvalid)

        $("#avtanamnase").val(examselect.anamnase)
        $("#avtdescription").val(examselect.description)
        $("#avtweight").val(examselect.weight)
        $("#avtheight").val(examselect.height)
        $("#avttemperature").val(examselect.temperature)
        $("#avtnadi").val(examselect.nadi)
        $("#avttension_upper").val(examselect.tension_upper)
        $("#avttension_lower").val(examselect.tension_lower)
        $("#avtsaturasi").val(examselect.saturasi)
        $("#avtnafas").val(examselect.nafas)
        $("#avtarm_diameter").val(examselect.arm_diameter)
        $("#avtpemeriksaan").val(examselect.pemeriksaan)

        $("#avtvs_status_id").val(examselect.vs_status_id)

        // $("#cpptModal").modal("show")
        // $("#formsaveavtbtnid").show()
        // $("#formeditavtid").hide()
    }

    function editCppt(key) {
        var examselect = vitalsign[key];

        $.each(examselect, function(key, value) {
            $("#avt" + key).val(value)
        })
        // $("#avtvs_status_id" + examselect.vs_status_id).prop("checked", true)
        // $("#cpptModal").modal("show")
        $("#avtDocument").find("input, select, textarea").prop("disabled", false)
        $("#formsaveavtbtnid").show()
        $("#formeditavtid").hide()
        getFallRisk(examselect.body_id, "bodyFallRiskCppt")
        getGcs(examselect.body_id, "bodyGcsCppt")
        if (examselect.petugas == '<?= user()->getFullname(); ?>') {
            // alert("Tidak dapat meengubah inputan CPPT milik dokter/petugas lain")
        } else {

            // $("#cpptageday").val(examselect.ageday)
            // $("#cpptagemonth").val(examselect.agemonth)
            // $("#cpptageyear").val(examselect.ageyear)
            // $("#cpptanamnase").val(examselect.anamnase)
            // $("#cpptarm_diameter").val(examselect.arm_diameter)
            // $("#cpptbed_id").val(examselect.bed_id)
            // $("#cpptbody_id").val(examselect.body_id)
            // $("#cpptclass_room_id").val(examselect.class_room_id)
            // $("#cpptclinic_id").val(examselect.clinic_id)
            // $("#cpptdescription").val(examselect.description)
            // $("#cpptdoctor").val(examselect.doctor)
            // $("#cpptemployee_id").val(examselect.employee_id)
            // $("#cpptexamination_date").val(examselect.examination_date)
            // $("#cpptgender").val(examselect.gender)
            // $("#cpptheight").val(examselect.height)
            // $("#cpptinstruction").val(examselect.instruction)
            // $("#cpptisrj").val(examselect.isrj)
            // $("#cpptkal_id").val(examselect.kal_id)
            // $("#cpptkeluar_id").val(examselect.keluar_id)
            // $("#cpptnadi").val(examselect.nadi)
            // $("#cpptnafas").val(examselect.nafas)
            // $("#cpptno_registraiton").val(examselect.no_registraiton)
            // $("#cpptorg_unit_code").val(examselect.org_unit_code)
            // $("#cpptpemeriksaan").val(examselect.pemeriksaan)
            // $("#cpptpetugas").val(examselect.petugas)
            // $("#cpptsaturasi").val(examselect.saturasi)
            // $("#cpptstatus_pasien_id").val(examselect.status_pasien_id)
            // $("#cppttemperature").val(examselect.temperature)
            // $("#cppttension_below").val(examselect.tension_below)
            // $("#cppttension_upper").val(examselect.tension_upper)
            // $("#cpptteraphy_desc").val(examselect.teraphy_desc)
            // $("#cppttheaddress").val(examselect.theaddress)
            // $("#cppttheid").val(examselect.pasien_id)
            // $("#cpptthename").val(examselect.diantar_oleh)
            // $("#cpptvisit_id").val(examselect.visit_id)
            // $("#cpptweight").val(examselect.weight)
        }
    }
</script>