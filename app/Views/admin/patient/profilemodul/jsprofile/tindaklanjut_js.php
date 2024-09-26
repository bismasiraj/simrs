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
    var vitalsign = <?= json_encode($exam); ?>;
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
        $("#aeexamination_date").val(get_date())
        setDataVitalSign()
    })



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

    function setDataVitalSign() {
        $("#aeclinic_id").val('<?= $visit['clinic_id']; ?>')
        $("#aeclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#aebed_id").val()
        $("#aekeluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#aeemployee_id").val('<?= $visit['employee_id']; ?>')
        $("#aeno_registration").val('<?= $visit['no_registration']; ?>')
        $("#aevisit_id").val('<?= $visit['visit_id']; ?>')
        $("#aeorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#aedoctor").val('<?= $visit['fullname']; ?>')
        $("#aekal_id").val('<?= $visit['kal_id']; ?>')
        $("#aetheid").val('<?= $visit['pasien_id']; ?>')
        $("#aethename").val('<?= $visit['diantar_oleh']; ?>')
        $("#aetheaddress").val('<?= $visit['visitor_address']; ?>')
        $("#aestatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#aeisrj").val('<?= $visit['isrj']; ?>')
        $("#aegender").val('<?= $visit['gender']; ?>')
        $("#aeageyear").val('<?= $visit['ageyear']; ?>')
        $("#aeagemonth").val('<?= $visit['agemonth']; ?>')
        $("#aeageday").val('<?= $visit['ageday']; ?>')

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
                // .append($("<td rowspan='7'>").html('<button type="button" onclick="copyCppt(' + key + ')" class="addbtn copybtn" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                // '<button type="button" onclick="editCppt(' + key + ')" class="editbtn edit-transparent-btn" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
                // .append($("<td rowspan='7'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="closebtn delete_row" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>'))
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

    function disableVitalSign() {
        $("#aeexamination_date").prop("disabled", true)
        $("#aepetugas").prop("disabled", true)
        $("#aeweight").prop("disabled", true)
        $("#aeheight").prop("disabled", true)
        $("#aetemperature").prop("disabled", true)
        $("#aenadi").prop("disabled", true)
        $("#aetension_upper").prop("disabled", true)
        $("#aetension_below").prop("disabled", true)
        $("#aesaturasi").prop("disabled", true)
        $("#aenafas").prop("disabled", true)
        $("#aearm_diameter").prop("disabled", true)
        $("#aeanamnase").prop("disabled", true)
        $("#aepemeriksaan").prop("disabled", true)
        $("#aeteraphy_desc").prop("disabled", true)
        $("#aedescription").prop("disabled", true)
        $("#aeclinic_id").prop("disabled", true)
        $("#aeclass_room_id").prop("disabled", true)
        $("#aebed_id").prop("disabled", true)
        $("#aekeluar_id").prop("disabled", true)
        $("#aeemployee_id").prop("disabled", true)
        $("#aeno_registraiton").prop("disabled", true)
        $("#aevisit_id").prop("disabled", true)
        $("#aeorg_unit_code").prop("disabled", true)
        $("#aedoctor").prop("disabled", true)
        $("#aekal_id").prop("disabled", true)
        $("#aetheid").prop("disabled", true)
        $("#aethename").prop("disabled", true)
        $("#aetheaddress").prop("disabled", true)
        $("#aestatus_pasien_id").prop("disabled", true)
        $("#aeisrj").prop("disabled", true)
        $("#aegender").prop("disabled", true)
        $("#aeageyear").prop("disabled", true)
        $("#aeagemonth").prop("disabled", true)
        $("#aeageday").prop("disabled", true)
        $("#aeinstruction").prop("disabled", true)
    }

    function enableVitalSign() {
        $("#aeexamination_date").prop("disabled", false)
        $("#aepetugas").prop("disabled", false)
        $("#aeweight").prop("disabled", false)
        $("#aeheight").prop("disabled", false)
        $("#aetemperature").prop("disabled", false)
        $("#aenadi").prop("disabled", false)
        $("#aetension_upper").prop("disabled", false)
        $("#aetension_below").prop("disabled", false)
        $("#aesaturasi").prop("disabled", false)
        $("#aenafas").prop("disabled", false)
        $("#aearm_diameter").prop("disabled", false)
        $("#aeanamnase").prop("disabled", false)
        $("#aepemeriksaan").prop("disabled", false)
        $("#aeteraphy_desc").prop("disabled", false)
        $("#aedescription").prop("disabled", false)
        $("#aeclinic_id").prop("disabled", false)
        $("#aeclass_room_id").prop("disabled", false)
        $("#aebed_id").prop("disabled", false)
        $("#aekeluar_id").prop("disabled", false)
        $("#aeemployee_id").prop("disabled", false)
        $("#aeno_registraiton").prop("disabled", false)
        $("#aevisit_id").prop("disabled", false)
        $("#aeorg_unit_code").prop("disabled", false)
        $("#aedoctor").prop("disabled", false)
        $("#aekal_id").prop("disabled", false)
        $("#aetheid").prop("disabled", false)
        $("#aethename").prop("disabled", false)
        $("#aetheaddress").prop("disabled", false)
        $("#aestatus_pasien_id").prop("disabled", false)
        $("#aeisrj").prop("disabled", false)
        $("#aegender").prop("disabled", false)
        $("#aeageyear").prop("disabled", false)
        $("#aeagemonth").prop("disabled", false)
        $("#aeageday").prop("disabled", false)
        $("#aeinstruction").prop("disabled", false)

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
            console.log(examselect)

            $("#aeclinic_id").val(examselect.clinic_id)
            $("#aeclass_room_id").val(examselect.class_room_id)
            $("#aebed_id").val(examselect.bed_id)
            $("#aekeluar_id").val(examselect.keluar_id)
            $("#aeemployee_id").val(examselect.employee_id)
            $("#aeno_registration").val(examselect.no_registration)
            $("#aevisit_id").val(examselect.visit_id)
            $("#aeorg_unit_code").val(examselect.org_unit_code)
            $("#aedoctor").val(examselect.fullname)
            $("#aekal_id").val(examselect.kal_id)
            $("#aetheid").val(examselect.pasien_id)
            $("#aethename").val(examselect.diantar_oleh)
            $("#aetheaddress").val(examselect.visitor_address)
            $("#aestatus_pasien_id").val(examselect.status_pasien_id)
            $("#aeisrj").val(examselect.isrj)
            $("#aegender").val(examselect.gender)
            $("#aeageyear").val(examselect.ageyear)
            $("#aeagemonth").val(examselect.agemonth)
            $("#aeageday").val(examselect.ageday)
            $("#aebody_id").val(examselect.body_id)

            $("#aeexamination_date").val(examselect.examination_date)
            $("#aepetugas").val(examselect.petugas)
            $("#aeweight").val(examselect.weight)
            $("#aeheight").val(examselect.height)
            $("#aetemperature").val(examselect.temperature)
            $("#aenadi").val(examselect.nadi)
            $("#aetension_upper").val(examselect.tension_upper)
            $("#aetension_below").val(examselect.tension_below)
            $("#aesaturasi").val(examselect.saturasi)
            $("#aenafas").val(examselect.nafas)
            $("#aearm_diameter").val(examselect.arm_diameter)
            $("#aeanamnase").val(examselect.anamnase)
            $("#aepemeriksaan").val(examselect.pemeriksaan)
            $("#aeteraphy_desc").val(examselect.teraphy_desc)
            $("#aedescription").val(examselect.description)
            $("#aeclinic_id").val(examselect.clinic_id)
            $("#aeclass_room_id").val(examselect.class_room_id)
            $("#aebed_id").val(examselect.bed_id)
            $("#aekeluar_id").val(examselect.keluar_id)
            $("#aeemployee_id").val(examselect.employee_id)
            $("#aeno_registraiton").val(examselect.no_registraiton)
            $("#aevisit_id").val(examselect.visit_id)
            $("#aeorg_unit_code").val(examselect.org_unit_code)
            $("#aedoctor").val(examselect.doctor)
            $("#aekal_id").val(examselect.kal_id)
            $("#aetheid").val(examselect.theid)
            $("#aethename").val(examselect.thename)
            $("#aetheaddress").val(examselect.theaddress)
            $("#aestatus_pasien_id").val(examselect.status_pasien_id)
            $("#aeisrj").val(examselect.isrj)
            $("#aegender").val(examselect.gender)
            $("#aeageyear").val(examselect.ageyear)
            $("#aeagemonth").val(examselect.agemonth)
            $("#aeageday").val(examselect.ageday)
            $("#aeinstruction").val(examselect.instruction)
        }

        if (typeof $("#aebody_id").val() !== 'undefined' || $("#aebody_id").val() == "") {
            $("#aeclinic_id").val('<?= $visit['clinic_id']; ?>')
            $("#aeclass_room_id").val('<?= $visit['class_room_id']; ?>')
            $("#aebed_id").val()
            $("#aekeluar_id").val('<?= $visit['keluar_id']; ?>')
            $("#aeemployee_id").val('<?= $visit['employee_id']; ?>')
            $("#aeno_registration").val('<?= $visit['no_registration']; ?>')
            $("#aevisit_id").val('<?= $visit['visit_id']; ?>')
            $("#aeorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
            $("#aedoctor").val('<?= $visit['fullname']; ?>')
            $("#aekal_id").val('<?= $visit['kal_id']; ?>')
            $("#aetheid").val('<?= $visit['pasien_id']; ?>')
            $("#aethename").val('<?= $visit['diantar_oleh']; ?>')
            $("#aetheaddress").val('<?= $visit['visitor_address']; ?>')
            $("#aestatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
            $("#aeisrj").val('<?= $visit['isrj']; ?>')
            $("#aegender").val('<?= $visit['gender']; ?>')
            $("#aeageyear").val('<?= $visit['ageyear']; ?>')
            $("#aeagemonth").val('<?= $visit['agemonth']; ?>')
            $("#aeageday").val('<?= $visit['ageday']; ?>')


        }
    });
    $("#formvitalsign").on('submit', (function(e) {
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
                    disableVitalSign()
                    $("#formvitalsignsubmit").toggle()
                    $("#formvitalsignedit").toggle()
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