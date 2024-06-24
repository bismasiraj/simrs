<script type='text/javascript'>
    var mrJson;
    var lastOrder = 0;
    var transfer = <?= json_encode($exam); ?>;
    var exam1 = [];
    var exam2 = [];

    $("#transferTab").on("click", function() {
        gettransfer()
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
        $("#atransferexamination_date").val(get_date())
    })


    $("#atransferweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#atransferheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#atransfertemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#atransfernadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#atransfertension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#atransfertension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#atransfersaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#atransfernafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#atransferarm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });

    function setDatatransfer() {
        $("#formaddatransfer").find("input, textarea").val(null)

        $("#transferDerajatBody").html("")
        // addDerajatStabilitas(1, 0, "atransferbody_id", "transferDerajatBody")

        $("#transferModal").modal("show")


        var bodyId = get_bodyid()
        var bodyId1 = get_bodyid()
        var bodyId2 = get_bodyid()

        $("#atransferbody_id").val(bodyId)
        $("#atransferorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#atransferno_registration").val('<?= $visit['no_registration']; ?>')
        $("#atransfervisit_id").val('<?= $visit['visit_id']; ?>')
        $("#atransfertrans_id").val('<?= $visit['trans_id']; ?>')
        $("#atransferdocument_id").val(bodyId1)
        $("#atransferdocument_id2").val(bodyId2)
        $("#atransferexamination_date").val(get_date())
        <?php if (!is_null($visit['class_room_id'])) { ?>
            $("#employee_id").val('<?= $visit['employee_inap']; ?>')
        <?php } else { ?>
            $("#employee_id").val('<?= $visit['employee_id']; ?>')
        <?php } ?>
        $("#atransferisinternal").val(1)


        $("#formaddatransfer1").find("input, textarea").val(null)
        $("#atransfer1body_id").val(bodyId1)
        $("#atransfer1clinic_id").val('<?= $visit['clinic_id']; ?>')
        $("#atransfer1class_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#atransfer1bed_id").val()
        $("#atransfer1keluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#atransfer1employee_id").val('<?= $visit['employee_id']; ?>')
        $("#atransfer1no_registration").val('<?= $visit['no_registration']; ?>')
        $("#atransfer1visit_id").val('<?= $visit['visit_id']; ?>')
        $("#atransfer1org_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#atransfer1doctor").val('<?= $visit['fullname']; ?>')
        $("#atransfer1kal_id").val('<?= $visit['kal_id']; ?>')
        $("#atransfer1theid").val('<?= $visit['pasien_id']; ?>')
        $("#atransfer1thename").val('<?= $visit['diantar_oleh']; ?>')
        $("#atransfer1theaddress").val('<?= $visit['visitor_address']; ?>')
        $("#atransfer1status_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#atransfer1isrj").val('<?= $visit['isrj']; ?>')
        $("#atransfer1gender").val('<?= $visit['gender']; ?>')
        $("#atransfer1ageyear").val('<?= $visit['ageyear']; ?>')
        $("#atransfer1agemonth").val('<?= $visit['agemonth']; ?>')
        $("#atransfer1ageday").val('<?= $visit['ageday']; ?>')
        $("#atransfer1examination_date").val(get_date())
        $("#atransfer1vs_status_id").val(9)



        $("#formaddatransfer2").find("input, textarea").val(null)
        $("#atransfer2body_id").val(bodyId2)
        // $("#atransfer2clinic_id").val('<?= $visit['clinic_id']; ?>')
        $("#atransfer2class_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#atransfer2bed_id").val()
        $("#atransfer2keluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#atransfer2employee_id").val('<?= $visit['employee_id']; ?>')
        $("#atransfer2no_registration").val('<?= $visit['no_registration']; ?>')
        $("#atransfer2visit_id").val('<?= $visit['visit_id']; ?>')
        $("#atransfer2org_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#atransfer2doctor").val('<?= $visit['fullname']; ?>')
        $("#atransfer2kal_id").val('<?= $visit['kal_id']; ?>')
        $("#atransfer2theid").val('<?= $visit['pasien_id']; ?>')
        $("#atransfer2thename").val('<?= $visit['diantar_oleh']; ?>')
        $("#atransfer2theaddress").val('<?= $visit['visitor_address']; ?>')
        $("#atransfer2status_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#atransfer2isrj").val('<?= $visit['isrj']; ?>')
        $("#atransfer2gender").val('<?= $visit['gender']; ?>')
        $("#atransfer2ageyear").val('<?= $visit['ageyear']; ?>')
        $("#atransfer2agemonth").val('<?= $visit['agemonth']; ?>')
        $("#atransfer2ageday").val('<?= $visit['ageday']; ?>')
        $("#atransfer2examination_date").val(get_date())
        $("#atransfer2vs_status_id").val(9)

        enabletransfer()
    }

    function addRowtransfer(examselect, key) {

        $.each(examForassessment, function(key, value) {
            if (value.body_id == examselect.document_id) {
                exam1 = value
            } else if (value.body_id == examselect.document_id2) {
                exam2 = value
            }
        })

        $("#transferBodyHistory").append($("<tr>")
                .append($("<td rowspan='3'>").append((examselect.examination_date).substring(0, 16)))
                .append($("<td rowspan='3'>").html(examselect.petugas))
                .append($("<td>").html('<b>Departemen</b>'))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='3'>").html('<button type="button" onclick="copytransfer(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editCpptTransfer(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
                .append($("<td rowspan='3'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
            .append($("<tr>")
                .append($("<td>").html(exam1.name_of_clinic))
                .append($("<td>").html(exam1.tension_upper + '/' + exam1.tension_below + 'mmHg'))
                .append($("<td>").html(exam1.nadi + '/menit'))
                .append($("<td>").html(exam1.nafas + '/menit'))
                .append($("<td>").html(exam1.temperature + '/°C'))
                .append($("<td>").html(exam1.saturasi + '/SpO2%'))
            )
            .append($("<tr>")
                .append($("<td>").html(exam2.name_of_clinic))
                .append($("<td>").html(exam2.tension_upper + '/' + exam2.tension_below + 'mmHg'))
                .append($("<td>").html(exam2.nadi + '/menit'))
                .append($("<td>").html(exam2.nafas + '/menit'))
                .append($("<td>").html(exam2.temperature + '/°C'))
                .append($("<td>").html(exam2.saturasi + '/SpO2%'))
            )
    }

    function transferInput(prop) {
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

    function disabletransfer() {
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", true)

        $("#formtransfersubmit").hide()
        $("#formtransferedit").show()
    }

    function enabletransfer() {
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)

        $("#formtransfersubmit").show()
        $("#formtransferedit").hide()
    }

    function disabletransfer1() {
        $("#formaddatransfer1").find("input, select, textarea").prop("disabled", true)

        $("#formsaveatransfer1btnid").hide()
        $("#formeditatransfer1id").show()
    }

    function enabletransfer1() {
        $("#formaddatransfer1").find("input, select, textarea").prop("disabled", false)

        $("#formsaveatransfer1btnid").show()
        $("#formeditatransfer1id").hide()
    }

    function disabletransfer2() {
        $("#formaddatransfer2").find("input, select, textarea").prop("disabled", true)

        $("#formsaveatransfer2btnid").hide()
        $("#formeditatransfer2id").show()
    }

    function enabletransfer2() {
        $("#formaddatransfer2").find("input, select, textarea").prop("disabled", false)

        $("#formsaveatransfer2btnid").show()
        $("#formeditatransfer2id").hide()
    }

    var transferdesc = []

    var i = 0

    // for (let index = transfer.length; index >= 0; index--) {
    //     transferdesc.push(transfer[index]);
    // }
    // console.log(transferdesc)
    // transfer = transferdesc

    transfer.forEach((element, key) => {
        examselect = transfer[key];
        addRowtransfer(examselect, key)
    });

    transfer.forEach((element, key) => {
        examselect = transfer[key];

        if (examselect.visit_id == '<?= $visit['visit_id']; ?>') {

            disabletransfer()
            $("#formtransfersubmit").hide()
            $("#formtransferedit").show()

            $("#atransferclinic_id").val(examselect.clinic_id)
            $("#atransferclass_room_id").val(examselect.class_room_id)
            $("#atransferbed_id").val(examselect.bed_id)
            $("#atransferkeluar_id").val(examselect.keluar_id)
            $("#atransferemployee_id").val(examselect.employee_id)
            $("#atransferno_registration").val(examselect.no_registration)
            $("#atransfervisit_id").val(examselect.visit_id)
            $("#atransferorg_unit_code").val(examselect.org_unit_code)
            $("#atransferdoctor").val(examselect.fullname)
            $("#atransferkal_id").val(examselect.kal_id)
            $("#atransfertheid").val(examselect.pasien_id)
            $("#atransferthename").val(examselect.diantar_oleh)
            $("#atransfertheaddress").val(examselect.visitor_address)
            $("#atransferstatus_pasien_id").val(examselect.status_pasien_id)
            $("#atransferisrj").val(examselect.isrj)
            $("#atransfergender").val(examselect.gender)
            $("#atransferageyear").val(examselect.ageyear)
            $("#atransferagemonth").val(examselect.agemonth)
            $("#atransferageday").val(examselect.ageday)
            $("#atransferbody_id").val(examselect.body_id)

            $("#atransferexamination_date").val(examselect.examination_date)
            $("#atransferpetugas").val(examselect.petugas)
            $("#atransferweight").val(examselect.weight)
            $("#atransferheight").val(examselect.height)
            $("#atransfertemperature").val(examselect.temperature)
            $("#atransfernadi").val(examselect.nadi)
            $("#atransfertension_upper").val(examselect.tension_upper)
            $("#atransfertension_below").val(examselect.tension_below)
            $("#atransfersaturasi").val(examselect.saturasi)
            $("#atransfernafas").val(examselect.nafas)
            $("#atransferarm_diameter").val(examselect.arm_diameter)
            $("#atransferanamnase").val(examselect.anamnase)
            $("#atransferpemeriksaan").val(examselect.pemeriksaan)
            $("#atransferteraphy_desc").val(examselect.teraphy_desc)
            $("#atransferdescription").val(examselect.description)
            $("#atransferclinic_id").val(examselect.clinic_id)
            $("#atransferclass_room_id").val(examselect.class_room_id)
            $("#atransferbed_id").val(examselect.bed_id)
            $("#atransferkeluar_id").val(examselect.keluar_id)
            $("#atransferemployee_id").val(examselect.employee_id)
            $("#atransferno_registraiton").val(examselect.no_registraiton)
            $("#atransfervisit_id").val(examselect.visit_id)
            $("#atransferorg_unit_code").val(examselect.org_unit_code)
            $("#atransferdoctor").val(examselect.doctor)
            $("#atransferkal_id").val(examselect.kal_id)
            $("#atransfertheid").val(examselect.theid)
            $("#atransferthename").val(examselect.thename)
            $("#atransfertheaddress").val(examselect.theaddress)
            $("#atransferstatus_pasien_id").val(examselect.status_pasien_id)
            $("#atransferisrj").val(examselect.isrj)
            $("#atransfergender").val(examselect.gender)
            $("#atransferageyear").val(examselect.ageyear)
            $("#atransferagemonth").val(examselect.agemonth)
            $("#atransferageday").val(examselect.ageday)
            $("#atransferinstruction").val(examselect.instruction)
        }

        if (typeof $("#atransferbody_id").val() !== 'undefined' || $("#atransferbody_id").val() == "") {
            $("#atransferclinic_id").val('<?= $visit['clinic_id']; ?>')
            $("#atransferclass_room_id").val('<?= $visit['class_room_id']; ?>')
            $("#atransferbed_id").val()
            $("#atransferkeluar_id").val('<?= $visit['keluar_id']; ?>')
            $("#atransferemployee_id").val('<?= $visit['employee_id']; ?>')
            $("#atransferno_registration").val('<?= $visit['no_registration']; ?>')
            $("#atransfervisit_id").val('<?= $visit['visit_id']; ?>')
            $("#atransferorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
            $("#atransferdoctor").val('<?= $visit['fullname']; ?>')
            $("#atransferkal_id").val('<?= $visit['kal_id']; ?>')
            $("#atransfertheid").val('<?= $visit['pasien_id']; ?>')
            $("#atransferthename").val('<?= $visit['diantar_oleh']; ?>')
            $("#atransfertheaddress").val('<?= $visit['visitor_address']; ?>')
            $("#atransferstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
            $("#atransferisrj").val('<?= $visit['isrj']; ?>')
            $("#atransfergender").val('<?= $visit['gender']; ?>')
            $("#atransferageyear").val('<?= $visit['ageyear']; ?>')
            $("#atransferagemonth").val('<?= $visit['agemonth']; ?>')
            $("#atransferageday").val('<?= $visit['ageday']; ?>')
        }
    });
    $("#formaddatransfer").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        clicked_submit_btn.html('<i class="spinner-border spinner-border-sm"></i>')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveTransfer',
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
                    $("#formaddatransfer").find("input, textarea, select").prop("disabled", true)
                    $("#formtransfersubmit").toggle()
                    $("#formtransferedit").toggle()
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
    $("#formeditatransferid").on("click", function() {
        $("#formaddatransfer").find("input, textarea, select").prop("disabled", false)
    })

    function gettransfer() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getTransfer',
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
                transfer = data.transfer
                examForassessment = data.examinfo

                $("#transferBodyHistory").html("")
                transfer.forEach((element, key) => {
                    addRowtransfer(transfer[key], key)
                });
            },
            error: function() {

            }
        });
    }
</script>

<script>
    function copytransfer(key) {
        var examselect = transfer[key];

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#atransferageday").val(examselect.ageday)
        $("#atransferagemonth").val(examselect.agemonth)
        $("#atransferageyear").val(examselect.ageyear)
        $("#atransferanamnase").val(examselect.anamnase)
        $("#atransferarm_diameter").val(examselect.arm_diameter)
        $("#atransferbed_id").val(examselect.bed_id)
        $("#atransferbody_id").val(bodyId)
        $("#atransferclass_room_id").val(examselect.class_room_id)
        $("#atransferclinic_id").val(examselect.clinic_id)
        $("#atransferdescription").val(examselect.description)
        $("#atransferdoctor").val(examselect.doctor)
        $("#atransferemployee_id").val(examselect.employee_id)
        $("#atransferexamination_date").val(get_date())
        $("#atransfergender").val(examselect.gender)
        $("#atransferheight").val(examselect.height)
        $("#atransferinstruction").val(examselect.instruction)
        $("#atransferisrj").val(examselect.isrj)
        $("#atransferkal_id").val(examselect.kal_id)
        $("#atransferkeluar_id").val(examselect.keluar_id)
        $("#atransfernadi").val(examselect.nadi)
        $("#atransfernafas").val(examselect.nafas)
        $("#atransferno_registraiton").val(examselect.no_registraiton)
        $("#atransferorg_unit_code").val(examselect.org_unit_code)
        $("#atransferpemeriksaan").val(examselect.pemeriksaan)
        $("#atransferpetugas").val(examselect.petugas)
        $("#atransfersaturasi").val(examselect.saturasi)
        $("#atransferstatus_pasien_id").val(examselect.status_pasien_id)
        $("#atransfertemperature").val(examselect.temperature)
        $("#atransfertension_below").val(examselect.tension_below)
        $("#atransfertension_upper").val(examselect.tension_upper)
        $("#atransferteraphy_desc").val(examselect.teraphy_desc)
        $("#atransfertheaddress").val(examselect.theaddress)
        $("#atransfertheid").val(examselect.pasien_id)
        $("#atransferthename").val(examselect.diantar_oleh)
        $("#atransfervisit_id").val(examselect.visit_id)
        $("#atransferweight").val(examselect.weight)

        $("#atransferorg_unit_code").val(examselect.org_unit_code)
        $("#atransferpasien_diagnosa_id").val(examselect.pasien_diagnosa_id)
        $("#atransferno_registration").val(examselect.no_registration)
        $("#atransfervisit_id").val(examselect.visit_id)
        $("#atransfertrans_id").val(examselect.trans_id)
        $("#atransferbill_id").val(examselect.bill_id)
        $("#atransferclass_room_id").val(examselect.class_room_id)
        $("#atransferbed_id").val(examselect.bed_id)
        $("#atransferin_date").val(examselect.in_date)
        $("#atransferexit_date").val(examselect.exit_date)
        $("#atransferkeluar_id").val(examselect.keluar_id)
        $("#atransferimt_score").val(examselect.imt_score)
        $("#atransferimt_desc").val(examselect.imt_desc)
        $("#atransferpemeriksaan").val(examselect.pemeriksaan)
        $("#atransfermedical_treatment").val(examselect.medical_treatment)
        $("#atransfermodified_date").val(examselect.modified_date)
        $("#atransfermodified_by").val(examselect.modified_by)
        $("#atransfermodified_from").val(examselect.modified_from)
        $("#atransferstatus_pasien_id").val(examselect.status_pasien_id)
        $("#atransferageyear").val(examselect.ageyear)
        $("#atransferagemonth").val(examselect.agemonth)
        $("#atransferageday").val(examselect.ageday)
        $("#atransferthename").val(examselect.thename)
        $("#atransfertheaddress").val(examselect.theaddress)
        $("#atransfertheid").val(examselect.theid)
        $("#atransferisrj").val(examselect.isrj)
        $("#atransfergender").val(examselect.gender)
        $("#atransferdoctor").val(examselect.doctor)
        $("#atransferkal_id").val(examselect.kal_id)
        $("#atransferpetugas_id").val(examselect.petugas_id)
        $("#atransferpetugas").val(examselect.petugas)
        $("#atransferaccount_id").val(examselect.account_id)
        $("#atransferkesadaran").val(examselect.kesadaran)
        $("#atransferisvalid").val(examselect.isvalid)

        $("#atransferanamnase").val(examselect.anamnase)
        $("#atransferdescription").val(examselect.description)
        $("#atransferweight").val(examselect.weight)
        $("#atransferheight").val(examselect.height)
        $("#atransfertemperature").val(examselect.temperature)
        $("#atransfernadi").val(examselect.nadi)
        $("#atransfertension_upper").val(examselect.tension_upper)
        $("#atransfertension_lower").val(examselect.tension_lower)
        $("#atransfersaturasi").val(examselect.saturasi)
        $("#atransfernafas").val(examselect.nafas)
        $("#atransferarm_diameter").val(examselect.arm_diameter)
        $("#atransferpemeriksaan").val(examselect.pemeriksaan)

        $("#atransfervs_status_id").val(examselect.vs_status_id)

        // $("#cpptModal").modal("show")
        // $("#formsaveatransferbtnid").show()
        // $("#formeditatransferid").hide()
    }

    function editCpptTransfer(key) {
        var transferselect = transfer[key];

        $.each(transferselect, function(keyt, value) {
            $("#atransfer" + keyt).val(value)
            if (keyt == 'employee_id') {
                $("#atransferemployee_id").html("")
                $("#atransferemployee_id").append(new Option(value.fullname, value.employee_id))
            }
        })
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)
        $.each(examForassessment, function(key, value) {
            if (value.body_id == examselect.document_id) {
                exam1 = value
            } else if (value.body_id == examselect.document_id2) {
                exam2 = value
            }
        })
        $.each(exam1, function(keyt, value) {
            if (keyt == 'employee_id') {
                $("#atransfer1employee_id").html("")
                $("#atransfer1employee_id").append(new Option(exam1.fullname, value.employee_id))
            }
            $("#atransfer1" + keyt).val(value)
            $("#atransfer1" + keyt).prop("disabled", false)
        })
        $.each(exam2, function(keyt, value) {
            if (keyt == 'employee_id') {
                $("#atransfer2employee_id").html("")
                $("#atransfer2employee_id").append(new Option(exam2.fullname, exam2.employee_id))
            }
            $("#atransfer2" + keyt).val(value)
            $("#atransfer2" + keyt).prop("disabled", false)
        })

        getStabilitas($("#atransferbody_id").val(), "transferDerajatBody")
        // addDerajatStabilitas(1, 0, "atransferbody_id", "transferDerajatBody")

        $("#atransferDocument").find("input, select, textarea").prop("disabled", false)
        enabletransfer()
        enabletransfer1()
        enabletransfer2()

        $("#transferModal").modal('show')
    }
</script>

<script>
    $("#formsaveatransfer1btnid").on('click', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveExaminationInfo',
            type: "POST",
            // data: 

            data: new FormData(document.getElementById('formaddatransfer1')),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                disabletransfer1
                $("#formaddatransfer1").find("input, textarea, select").prop("disabled", true)
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
                errorMsg(xhr);
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));
    $("#formeditatransfer1id").on("click", function() {
        $("#formaddatransfer1").find("input, textarea, select").prop("disabled", false)
        $("#formsaveatransfer1btnid").show()
        $("#formeditatransfer1id").hide()
    })
</script>
<script>
    $("#formsaveatransfer2btnid").on('click', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveExaminationInfo',
            type: "POST",
            // data: 

            data: new FormData(document.getElementById('formaddatransfer2')),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                disabletransfer2()
                // $("#formsavearpbtn").hide()
                // $("#formeditarp").show()
                // var isNewDocument = 0
                // $.each(examForassessment, function(key, value) {
                //     if (value.body_id == data.body_id) {
                //         examForassessment[key] = data
                //         isNewDocument = 1
                //     }
                // })
                // if (isNewDocument != 1)
                //     examForassessment.push(data)
                $("#formaddatransfer2").find("input, textarea, select").prop("disabled", true)

                // disableacppt()
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
                errorMsg(xhr);
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));
    $("#formeditatransfer2id").on("click", function() {
        $("#formaddatransfer2").find("input, textarea, select").prop("disabled", false)
        $("#formsaveatransfer2btnid").show()
        $("#formeditatransfer2id").hide()
    })
</script>