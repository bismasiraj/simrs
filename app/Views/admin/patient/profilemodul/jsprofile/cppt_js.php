<?php

$permissions = user()->getPermissions();
$group = user()->getRoles();

?>
<script type='text/javascript'>
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    // var cpptjson = [];
    // cpptjson = <?= json_encode($exam); ?>;


    $("#cpptTab").on("click", function() {
        $("#cpptSearchBtn").trigger("click")
    })

    function cpptInput(prop) {
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
        if (prop.id == "cppttension_upper") {
            // Number(GetText()) < 250 and Number(GetText()) > 50
            if (value < 50)
                value = 50.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "cppttnadi") {
            //Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }
        if (prop.id == "cpptweight") {
            // Number(GetText( )) < 500
            if (value > 500)
                value = 500.00
        }
        if (prop.id == "cpptheight") {
            // Number(GetText( )) between 30 and 250
            if (value < 30)
                value = 30.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "cppttension_below") {
            // Number(GetText( )) between 0 and 300
            if (value < 0)
                value = 0.00

            if (value > 300)
                value = 300.00
        }
        if (prop.id == "cppttension_below") {
            // Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }

        $(prop).val(value)
    }


    function disablecpptjson() {
        $("#examination_date").prop("disabled", true)
        $("#cpptpetugas").prop("disabled", true)
        $("#cpptweight").prop("disabled", true)
        $("#cpptheight").prop("disabled", true)
        $("#cppttemperature").prop("disabled", true)
        $("#cpptnadi").prop("disabled", true)
        $("#cppttension_upper").prop("disabled", true)
        $("#cppttension_below").prop("disabled", true)
        $("#cpptsaturasi").prop("disabled", true)
        $("#cpptnafas").prop("disabled", true)
        $("#cpptarm_diameter").prop("disabled", true)
        $("#cpptanamnase").prop("disabled", true)
        $("#cpptpemeriksaan").prop("disabled", true)
        $("#cpptteraphy_desc").prop("disabled", true)
        $("#cpptdescription").prop("disabled", true)
        $("#cpptclinic_id").prop("disabled", true)
        $("#cpptclass_room_id").prop("disabled", true)
        $("#cpptbed_id").prop("disabled", true)
        $("#cpptkeluar_id").prop("disabled", true)
        $("#cpptemployee_id").prop("disabled", true)
        $("#cpptno_registraiton").prop("disabled", true)
        $("#cpptvisit_id").prop("disabled", true)
        $("#cpptorg_unit_code").prop("disabled", true)
        $("#cpptdoctor").prop("disabled", true)
        $("#cpptkal_id").prop("disabled", true)
        $("#cppttheid").prop("disabled", true)
        $("#cpptthename").prop("disabled", true)
        $("#cppttheaddress").prop("disabled", true)
        $("#cpptstatus_pasien_id").prop("disabled", true)
        $("#cpptisrj").prop("disabled", true)
        $("#cpptgender").prop("disabled", true)
        $("#cpptageyear").prop("disabled", true)
        $("#cpptagemonth").prop("disabled", true)
        $("#cpptageday").prop("disabled", true)
        $("#cpptinstruction").prop("disabled", true)

        $("#formaddacppt").find(".btn-to-hide").slideUp()
    }

    function enablecpptjson() {
        $("#examination_date").prop("disabled", false)
        $("#cpptpetugas").prop("disabled", false)
        $("#cpptweight").prop("disabled", false)
        $("#cpptheight").prop("disabled", false)
        $("#cppttemperature").prop("disabled", false)
        $("#cpptnadi").prop("disabled", false)
        $("#cppttension_upper").prop("disabled", false)
        $("#cppttension_below").prop("disabled", false)
        $("#cpptsaturasi").prop("disabled", false)
        $("#cpptnafas").prop("disabled", false)
        $("#cpptarm_diameter").prop("disabled", false)
        $("#cpptanamnase").prop("disabled", false)
        $("#cpptpemeriksaan").prop("disabled", false)
        $("#cpptteraphy_desc").prop("disabled", false)
        $("#cpptdescription").prop("disabled", false)
        $("#cpptclinic_id").prop("disabled", false)
        $("#cpptclass_room_id").prop("disabled", false)
        $("#cpptbed_id").prop("disabled", false)
        $("#cpptkeluar_id").prop("disabled", false)
        $("#cpptemployee_id").prop("disabled", false)
        $("#cpptno_registraiton").prop("disabled", false)
        $("#cpptvisit_id").prop("disabled", false)
        $("#cpptorg_unit_code").prop("disabled", false)
        $("#cpptdoctor").prop("disabled", false)
        $("#cpptkal_id").prop("disabled", false)
        $("#cppttheid").prop("disabled", false)
        $("#cpptthename").prop("disabled", false)
        $("#cppttheaddress").prop("disabled", false)
        $("#cpptstatus_pasien_id").prop("disabled", false)
        $("#cpptisrj").prop("disabled", false)
        $("#cpptgender").prop("disabled", false)
        $("#cpptageyear").prop("disabled", false)
        $("#cpptagemonth").prop("disabled", false)
        $("#cpptageday").prop("disabled", false)
        $("#cpptinstruction").prop("disabled", false)
        $("#formaddacppt").find(".btn-to-hide").slideDown()

        $("#formcpptsubmit").toggle()
        $("#formcpptedit").toggle()
    }
    $("#acpptaccount_id").on("change", function() {
        if ($(this).val() == 3) {
            $("#groupRiwayatCppt").slideDown()
            $("#groupRiwayatCppt").find("input, textarea, select").prop("disabled", false)
            $("#groupVitalSignCppt").slideDown()
            $("#groupVitalSignCppt").find("input, textarea, select").prop("disabled", false)
            $("#groupDiagnosaPerawatCppt").slideDown()
            $("#cpptSubyektifTitle").html("SUBYEKTIF (S)")
            $("#cpptObyektifTitle").html("OBYEKTIF (O)")
            $("#cpptPlanningTitle").html("PLANNING (P)")
            $("#cpptVitalSign").show()
            $("#cpptFallRiskSegment").show()
            $("#cpptGcsSegment").show()
        } else {
            $("#cpptSubyektifTitle").html("SITUATION (S)")
            $("#cpptObyektifTitle").html("BACKGROUND (B)")
            $("#cpptPlanningTitle").html("RECOMMENDATION (R)")
            $("#cpptFallRiskSegment").hide()
            $("#cpptGcsSegment").hide()
        }
    })
    // $("#acpptaccount_id3").on("change", function() {
    //     $("#groupRiwayatCppt").slideDown()
    //     $("#groupRiwayatCppt").find("input, textarea, select").prop("disabled", false)
    //     $("#groupVitalSignCppt").slideDown()
    //     $("#groupVitalSignCppt").find("input, textarea, select").prop("disabled", false)
    //     $("#groupDiagnosaPerawatCppt").slideDown()
    //     $("#cpptSubyektifTitle").html("SUBYEKTIF (S)")
    //     $("#cpptObyektifTitle").html("OBYEKTIF (O)")
    //     $("#cpptPlanningTitle").html("PLANNING (P)")
    //     $("#cpptVitalSign").show()
    //     $("#cpptFallRiskSegment").show()
    //     $("#cpptGcsSegment").show()
    // })
    // $("#acpptaccount_id4").on("change", function() {
    //     $("#cpptSubyektifTitle").html("SITUATION (S)")
    //     $("#cpptObyektifTitle").html("BACKGROUND (B)")
    //     $("#cpptPlanningTitle").html("RECOMMENDATION (R)")
    //     $("#cpptFallRiskSegment").hide()
    //     $("#cpptGcsSegment").hide()
    // })

    function addRowCPPT(examselect, key) {
        if (examselect.account_id == "2" || examselect.account_id == "3") {
            $("#cpptBody").append($("<tr>")
                .append($("<td rowspan='8'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td>").html(examselect.petugas))
                .append($("<td colspan='6'>").html(''))
                // .append($("<td>").html('<b>Tekanan Darah</b>'))
                // .append($("<td>").html('<b>Nadi</b>'))
                // .append($("<td>").html('<b>Nafas/RR</b>'))
                // .append($("<td>").html('<b>Temp</b>'))
                // .append($("<td>").html('<b>SpO2</b>'))

                .append($("<td rowspan='8'>")
                    .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                        .append('<button type="button" onclick="copyCppt(' + key + ')" class="btn btn-primary" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                            '<button type="button" onclick="editCppt(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'
                            <?php if (user()->checkRoles(['dokter', 'superuser', 'admin'])) {
                            ?> + '<button type="button" onclick="verifyCppt(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-signature">Verify</i></button>'
                            <?php
                            } ?>
                        )
                    ))
                .append($("<td rowspan='8'>").html('<button type="button" onclick="removeCppt(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
            // .append($("<tr>")
            //     .append($("<td>").html(''))
            //     .append($("<td>").html(examselect.tension_upper + '/' + examselect.tension_below + 'mmHg'))
            //     .append($("<td>").html(examselect.nadi + '/menit'))
            //     .append($("<td>").html(examselect.nafas + '/menit'))
            //     .append($("<td>").html(examselect.temperature + '/°C'))
            //     .append($("<td>").html(examselect.saturasi + '/SpO2%'))
            // )
        } else {
            $("#cpptBody").append($("<tr>")
                .append($("<td rowspan='6'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td>").html(examselect.petugas))
                .append($("<td colspan='6'>").html(''))
                // .append($("<td>").html('<b>Tekanan Darah</b>'))
                // .append($("<td>").html('<b>Nadi</b>'))
                // .append($("<td>").html('<b>Nafas/RR</b>'))
                // .append($("<td>").html('<b>Temp</b>'))
                // .append($("<td>").html('<b>SpO2</b>'))

                .append($("<td rowspan='6'>")
                    .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                        .append('<button type="button" onclick="copyCppt(' + key + ')" class="btn btn-primary" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                            '<button type="button" onclick="editCppt(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'
                            <?php if (user()->checkRoles(['dokter', 'superuser', 'admin'])) {
                            ?> + '<button type="button" onclick="verifyCppt(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-signature">Verify</i></button>'
                            <?php
                            } ?>
                        )
                    ))
                .append($("<td rowspan='6'>").html('<button type="button" onclick="removeCppt(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )

        }

        if (examselect.account_id == "2" || examselect.account_id == "3") {
            $("#cpptBody")
                .append($("<tr>")
                    .append($("<td rowspan='7'>").html(examselect.kode_ppa))
                    .append($("<td>").html("<b>S</b>"))
                    .append($("<td colspan='5'>").html(examselect.anamnase))
                )

                .append($("<tr>")
                    .append($("<td rowspan=\"3\">").html("<b>O</b>"))
                    .append($("<td>").html('<b>Tekanan Darah</b>'))
                    .append($("<td>").html('<b>Nadi</b>'))
                    .append($("<td>").html('<b>Nafas/RR</b>'))
                    .append($("<td>").html('<b>Temp</b>'))
                    .append($("<td>").html('<b>SpO2</b>'))
                )
                .append($("<tr>")
                    .append($("<td>").html(examselect.tension_upper + '/' + examselect.tension_below + 'mmHg'))
                    .append($("<td>").html(examselect.nadi + '/menit'))
                    .append($("<td>").html(examselect.nafas + '/menit'))
                    .append($("<td>").html(examselect.temperature + '/°C'))
                    .append($("<td>").html(examselect.saturasi + '/SpO2%'))
                )
                .append($("<tr>")
                    // .append($("<td>").html("<b>O</b>"))
                    .append($("<td colspan='5'>").html(examselect.pemeriksaan))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>A</b>"))
                    .append($("<td colspan='5'>").html(examselect.teraphy_desc))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>P</b>"))
                    .append($("<td colspan='5'>").html(examselect.instruction))
                )
                .append($("<tr>")
                    .append($("<td>").html("Instruksi"))
                    .append($("<td colspan='5'>").html(examselect.instruction))
                )
        } else {
            $("#cpptBody")
                .append($("<tr>")
                    .append($("<td rowspan='5'>").html(examselect.kode_ppa))
                    .append($("<td>").html("<b>S</b>"))
                    .append($("<td colspan='5'>").html(examselect.anamnase))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>B</b>"))
                    .append($("<td colspan='5'>").html(examselect.alo_anamnase))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>A</b>"))
                    .append($("<td colspan='5'>").html(examselect.teraphy_desc))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>R</b>"))
                    .append($("<td colspan='5'>").html(examselect.instruction))
                )
                .append($("<tr>")
                    .append($("<td>").html("Instruksi"))
                    .append($("<td colspan='5'>").html(examselect.instruction))
                )
        }
    }

    function setDataCPPT() {
        $("#cpptclinic_id").val('<?= $visit['clinic_id']; ?>')
        $("#cpptclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#cpptbed_id").val()
        $("#cpptkeluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#cpptemployee_id").val('<?= $visit['employee_id']; ?>')
        $("#cpptno_registration").val('<?= $visit['no_registration']; ?>')
        $("#cpptvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#cpptorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#cpptdoctor").val('<?= $visit['fullname']; ?>')
        $("#cpptkal_id").val('<?= $visit['kal_id']; ?>')
        $("#cppttheid").val('<?= $visit['pasien_id']; ?>')
        $("#cpptthename").val('<?= $visit['diantar_oleh']; ?>')
        $("#cppttheaddress").val('<?= $visit['visitor_address']; ?>')
        $("#cpptstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#cpptisrj").val('<?= $visit['isrj']; ?>')
        $("#cpptgender").val('<?= $visit['gender']; ?>')
        $("#cpptageyear").val('<?= $visit['ageyear']; ?>')
        $("#cpptagemonth").val('<?= $visit['agemonth']; ?>')
        $("#cpptageday").val('<?= $visit['ageday']; ?>')
        $("#cpptexamination_date").val(get_date())
        $("#cpptanamnase").val("")
        $("#cppttemperature").val("")
        $("#cpptnadi").val("")
        $("#cppttension_upper").val("")
        $("#cppttension_below").val("")
        $("#cpptsaturasi").val("")
        $("#cpptnafas").val("")
        $("#cpptarm_diameter").val("")
        $("#cpptpemeriksaan").val("")
        $("#cpptdescription").val("")
        $("#cpptinstruction").val("")
        $("#cpptpetugas").val('<?= user()->getFullname(); ?>')
    }



    const editCppt = async (key) => {
        $("#acpptModal").modal("hide")

        var examselect = examForassessment[key];

        $.each(examselect, function(key, value) {
            $("#acppt" + key).val(value)
        })

        // var editor = tinymce.get('acpptinstruction')
        // editor.setContent(examselect.intstruction !== null ? examselect.instruction : "")
        // $("#acpptaccount_id" + examselect.account_id).prop("checked", true).trigger("change");

        $("#acpptcollapseVitalSign").find("input, select").trigger("change")


        $("#bodyFallRiskCppt").html("")
        $("#bodyGcsCppt").html("")
        $("#formsaveacpptbtnid").slideDown()
        $("#formeditacpptid").slideUp()

        // await checkSignSignature("formaddacppt", "acpptbody_id", "formsaveacpptbtnid")

        getFallRisk(examselect.body_id, "bodyFallRiskCppt")
        getGcs(examselect.body_id, "bodyGcsCppt")

        if ($("#acpptvalid_user").val() == '' || $("#acpptvalid_user").val() == null) {
            enableacppt()
        } else {
            if (<?= json_encode(user()->checkRoles(['superuser'])) ?>) {
                enableacppt()
            } else {
                disableacppt()
            }
        }
        if ($("#acpptpetugas_type").val() == '13') {
            $("#groupDiagnosaPerawatCppt").show()
        } else {
            $("#groupDiagnosaPerawatCppt").hide()
        }


        $("#acpptModal").modal("show")
    }

    function copyCppt(key) {
        var examselect = examForassessment[key];

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#acpptageday").val(examselect.ageday)
        $("#acpptagemonth").val(examselect.agemonth)
        $("#acpptageyear").val(examselect.ageyear)
        $("#acpptanamnase").val(examselect.anamnase)
        $("#acpptarm_diameter").val(examselect.arm_diameter)
        $("#acpptbed_id").val(examselect.bed_id)
        $("#acpptbody_id").val(bodyId)
        $("#acpptclass_room_id").val(examselect.class_room_id)
        $("#acpptclinic_id").val(examselect.clinic_id)
        $("#acpptdescription").val(examselect.description)
        $("#acpptdoctor").val(examselect.doctor)
        $("#acpptemployee_id").val(examselect.employee_id)
        $("#acpptexamination_date").val(get_date())
        $("#acpptgender").val(examselect.gender)
        $("#acpptheight").val(examselect.height)
        $("#acpptinstruction").val(examselect.instruction)
        $("#acpptisrj").val(examselect.isrj)
        $("#acpptkal_id").val(examselect.kal_id)
        $("#acpptkeluar_id").val(examselect.keluar_id)
        $("#acpptnadi").val(examselect.nadi)
        $("#acpptnafas").val(examselect.nafas)
        $("#acpptno_registraiton").val(examselect.no_registraiton)
        $("#acpptorg_unit_code").val(examselect.org_unit_code)
        $("#acpptpemeriksaan").val(examselect.pemeriksaan)
        $("#acpptpetugas").val(examselect.petugas)
        $("#acpptsaturasi").val(examselect.saturasi)
        $("#acpptstatus_pasien_id").val(examselect.status_pasien_id)
        $("#acppttemperature").val(examselect.temperature)
        $("#acppttension_below").val(examselect.tension_below)
        $("#acppttension_upper").val(examselect.tension_upper)
        $("#acpptteraphy_desc").val(examselect.teraphy_desc)
        $("#acppttheaddress").val(examselect.theaddress)
        $("#acppttheid").val(examselect.pasien_id)
        $("#acpptthename").val(examselect.diantar_oleh)
        $("#acpptvisit_id").val(examselect.visit_id)
        $("#acpptweight").val(examselect.weight)

        $("#acpptorg_unit_code").val(examselect.org_unit_code)
        $("#acpptpasien_diagnosa_id").val(examselect.pasien_diagnosa_id)
        $("#acpptno_registration").val(examselect.no_registration)
        $("#acpptvisit_id").val(examselect.visit_id)
        $("#acppttrans_id").val(examselect.trans_id)
        $("#acpptbill_id").val(examselect.bill_id)
        $("#acpptclass_room_id").val(examselect.class_room_id)
        $("#acpptbed_id").val(examselect.bed_id)
        $("#acpptin_date").val(examselect.in_date)
        $("#acpptexit_date").val(examselect.exit_date)
        $("#acpptkeluar_id").val(examselect.keluar_id)
        $("#acpptimt_score").val(examselect.imt_score)
        $("#acpptimt_desc").val(examselect.imt_desc)
        $("#acpptpemeriksaan").val(examselect.pemeriksaan)
        $("#acpptmedical_treatment").val(examselect.medical_treatment)
        $("#acpptmodified_date").val(examselect.modified_date)
        $("#acpptmodified_by").val(examselect.modified_by)
        $("#acpptmodified_from").val(examselect.modified_from)
        $("#acpptstatus_pasien_id").val(examselect.status_pasien_id)
        $("#acpptageyear").val(examselect.ageyear)
        $("#acpptagemonth").val(examselect.agemonth)
        $("#acpptageday").val(examselect.ageday)
        $("#acpptthename").val(examselect.thename)
        $("#acppttheaddress").val(examselect.theaddress)
        $("#acppttheid").val(examselect.theid)
        $("#acpptisrj").val(examselect.isrj)
        $("#acpptgender").val(examselect.gender)
        $("#acpptdoctor").val(examselect.doctor)
        $("#acpptkal_id").val(examselect.kal_id)
        $("#acpptpetugas_id").val(examselect.petugas_id)
        $("#acpptpetugas_type").val(examselect.petugas_type)
        $("#acpptpetugas").val(examselect.petugas)
        $("#acpptaccount_id").val(examselect.account_id).trigger("change")
        $("#acpptkesadaran").val(examselect.kesadaran)
        $("#acpptisvalid").val(examselect.isvalid)

        $("#acpptanamnase").val(examselect.anamnase)
        $("#acpptdescription").val(examselect.description)
        $("#acpptweight").val(examselect.weight)
        $("#acpptheight").val(examselect.height)
        $("#acppttemperature").val(examselect.temperature)
        $("#acpptnadi").val(examselect.nadi)
        $("#acppttension_upper").val(examselect.tension_upper)
        $("#acppttension_lower").val(examselect.tension_lower)
        $("#acpptsaturasi").val(examselect.saturasi)
        $("#acpptnafas").val(examselect.nafas)
        $("#acpptarm_diameter").val(examselect.arm_diameter)
        $("#acpptpemeriksaan").val(examselect.pemeriksaan)
        $("#acpptvs_status_id").val(examselect.vs_status_id)

        var editor = tinymce.get('acpptinstruction')
        editor.setContent(examselect.intstruction !== null ? examselect.instruction : "")

        // $("#acpptaccount_id" + examselect.account_id).prop("checked", true).trigger("change") //bisma


        $("#formsaveacpptbtnid").slideDown()
        $("#formeditacpptid").slideUp()
    }

    const removeCppt = () => {

    }

    $("#formsaveacpptbtnid").on('click', (function(e) {
        let clicked_submit_btn = $(this)
        e.preventDefault();

        if ($("#acpptclinic_id").val() == null) {
            alert("Kolom PELAYANAN tidak boleh kosong");
        } else {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/editExam',
                type: "POST",
                data: new FormData(document.getElementById("formaddacppt")),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $(this).html('<i class="spinner-border spinner-border-sm"></i>')
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
                        if (data.type == 'insert') {
                            examForassessment.push(data.data)
                            setDataCPPT()
                            var len = examForassessment.length
                            addRowCPPT(data.data, len)
                        } else {
                            console.log(data.type)
                            $("#cpptBody").html("")
                            setDataCPPT()
                            examForassessment.forEach((element, key) => {
                                console.log("json: " + examForassessment[key].body_id + " & data: " + data.data.body_id)
                                if (examForassessment[key].body_id == data.data.body_id) {
                                    examForassessment[key] = data.data
                                }
                                addRowCPPT(data.data, key)
                            });
                            $("#acpptModal").modal("hide")
                        }
                    }
                    $(this).html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    $(this).html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
                },
                complete: function() {
                    $(this).html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
                }
            });
        }
    }));
</script>

<script>
    function initialAddacppt(issoap = true) {
        const date = new Date();

        if (issoap) {
            bodyId = '<?= $visit['session_id']; ?>'
            let isnew = false;
            let theindex = 0;
            if (examForassessment.length > 0)
                $.each(examForassessment, function(key, value) {
                    if (value.body_id == bodyId) {
                        isnew = true;
                        theindex = key
                    }
                })
            if (isnew) {
                editCppt(theindex)
                return alert("Anda sudah pernah membuat dokumen CPPT SOAP pada sesi " + bodyId + ". Silahkan buat dokumen SBAR atau refresh halaman jika memang sudah berganti sesi.");
            }
        } else {
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        }



        let n = 1;
        $("#formaddacppt").find("input, textarea").val(null)
        if (examForassessment.length > 0) {
            let initialexam = examForassessment[examForassessment.length - n]
            let lastBodyId = initialexam.body_id
            $.each(initialexam, function(key, value) {
                $("#acppt" + key).val(value)
            })
            if ($("#acpptweight").val() == '') {
                n + 1
            }
        }
        $("#bodyFallRiskCppt").html("")
        $("#bodyGcsCppt").html("")
        $("#bodyDiagPerawatCppt").html("")

        // $("#acpptaccount_id3").val("3")
        // $("#acpptaccount_id4").val("4")
        // $("#acpptaccount_id3").prop("checked", true).trigger("change")
        $("#acpptbody_id").val(bodyId)
        $("#acpptorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#acpptpasien_diagnosa_id").val(null)
        $("#acpptdiagnosa_id").val(null)
        $("#acpptno_registration").val('<?= $visit['no_registration']; ?>')
        $("#acpptvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#acpptbill_id").val(null)
        <?php if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '')) { ?>
            $('#acpptclinic_id').val('<?= $visit['clinic_id']; ?>')
        <?php } else { ?>
            $('#acpptclinic_id').val('<?= $visit['clinic_id']; ?>')
        <?php } ?>
        <?php if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '')) { ?>
            $('#acpptemployee_id').val('<?= $visit['employee_inap']; ?>')
        <?php } else { ?>
            $('#acpptemployee_id').val('<?= $visit['employee_id']; ?>')
        <?php } ?>
        $("#acpptclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#acpptbed_id").val('<?= $visit['bed_id']; ?>')
        $("#acpptin_date").val('<?= $visit['in_date']; ?>')
        $("#acpptexit_date").val('<?= $visit['exit_date']; ?>')
        $("#acpptkeluar_id").val('<?= $visit['keluar_id']; ?>')
        flatpickrInstances["flatacpptexamination_date"].setDate(moment().format("DD/MM/YYYY HH:mm"))
        $("#flatacpptexamination_date").trigger("change")
        $("#acpptmodified_date").val(get_date())
        $("#acpptmodified_by").val('<?= user()->username; ?>')
        $("#acpptmodified_from").val('<?= $visit['clinic_id']; ?>')
        $("#acpptstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#acpptageyear").val('<?= $visit['ageyear']; ?>')
        $("#acpptagemonth").val('<?= $visit['agemonth']; ?>')
        $("#acpptageday").val('<?= $visit['ageday']; ?>')
        $("#acpptthename").val('<?= $visit['diantar_oleh']; ?>')
        $("#acppttheaddress").val('<?= $visit['visitor_address']; ?>')
        $("#acppttheid").val('<?= $visit['pasien_id']; ?>')
        $("#acpptisrj").val('<?= is_null($visit['class_room_id']) ? 1 : 0; ?>')
        $("#acpptgender").val('<?= $visit['gender']; ?>')
        $("#acpptdoctor").val('<?= $visit['fullname']; ?>')
        $("#acpptkal_id").val('<?= $visit['kal_id']; ?>')
        $("#acpptpetugas_id").val('<?= user()->username; ?>')
        $("#acpptpetugas_type").val('<?= user()->getOneRoles(); ?>')
        if ($("#acpptpetugas_type").val() == '13') {
            $("#groupDiagnosaPerawatCppt").show()
        } else {
            $("#groupDiagnosaPerawatCppt").hide()
        }
        $("#acpptpetugas").val('<?= user()->getFullname(); ?>')
        // $("#acpptaccount_id").val(<?= isset($group[11]) ? 3 : 4 ?>)

        $("#acpptcollapseVitalSign").find("#acppttotal_score").html("")
        $("#acpptcollapseVitalSign").find("span.h6").html("")

        $('#keperawatanListLinkAll').html("")

        if (issoap) {
            $("#acpptaccount_id").val(3).trigger("change")
            // $("#acpptaccount_id3").trigger("change")
        } else {
            $("#acpptaccount_id").val(4).trigger('change')
            // $("#acpptaccount_id4").trigger("change")
        }

        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#armbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_neonatus/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">CPPT Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">CPPT Rawat Jalan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Diagnosis Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Hak dan Kewajiban Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Implementasi Asuhan Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Inform Concern (Pemasangan Infus)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Keperawatan IGD Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Keperawatan IGD Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Monitoring Nyeri</a></li>')
        // $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Transfer Internal</a></li>')

        $("#acpptisvalid").val(0)

        $("#acpptAddDocument").slideUp()
        $("#acpptModal").modal("show")
        enableacppt()
        fillRiwayatAcppt()

        var ageYear = <?= $visit['ageyear']; ?>;
        var ageMonth = <?= $visit['agemonth']; ?>;
        var ageDay = <?= $visit['ageday']; ?>;

        if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
            $("#acpptvs_status_id").prop("selectedIndex", 3);
        } else if (ageYear >= 18) {
            $("#acpptvs_status_id").prop("selectedIndex", 1);
        } else {
            $("#acpptvs_status_id").prop("selectedIndex", 2);
        }
        <?php if ($visit['specialist_type_id'] == '1.05') {
        ?>
            $("#acpptvs_status_id").prop("selectedIndex", 4)
        <?php
        } ?>

        // getFallRisk(lastBodyId, "bodyFallRiskCppt")
        if (issoap) {
            copyFallRisk(1, 0, 'acpptbody_id', 'bodyFallRiskCppt', false)
            copyGcs(1, 0, 'acpptbody_id', 'bodyGcsCppt', false)
        }
    }

    const hideCppt = () => {
        $("#aacpptModal").modal("hide")
    }
</script>
<script>
    function getCppt(top = 10, episode = 1) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentKeperawatan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': '<?= $visit['visit_id']; ?>',
                'trans_id': '<?= $visit['trans_id']; ?>',
                'nomor': '<?= $visit['no_registration']; ?>',
                'isrj': '<?= $visit['isrj']; ?>',
                'norujukan': '<?= $visit['norujukan']; ?>',
                'top': top,
                'episode': episode
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#cpptDivForm").hide()
                getLoadingscreen("contentCppt", "loadContentCppt")
                getLoadingscreen("contentAssessmentPerawat", "loadContentAssessmentPerawat")
                $("#cpptBody").html(loadingScreen())
                $("#vitalSignBody").html(loadingScreen())
            },
            processData: false,
            success: function(data) {
                $("#cpptBody").html(tempTablesNull())
                $("#vitalSignBody").html(tempTablesNull())
                examForassessment = data.examInfo
                riwayatAll = data.pasienHistory

                examSelected = [];

                // $.each(examForassessment, function(key, value) {
                var vsStatusId = [1, 4, 5];

                //     if (vsStatusId.includes(value.vs_status_id)) {
                //         fillDataArp(key)
                //         disableARP()
                //     }
                // })
                // fillDataArp(examForassessment.length)



                if (examForassessment.length > 0) {
                    $("#cpptBody").html("")
                    $.each(examForassessment, function(key, value) {
                        if (value.account_id == 3 || value.account_id == 4) {
                            let pd = examForassessment[key]
                            addRowCPPT(value, key)
                        }
                    })
                }
            },
            error: function() {
                $("#cpptBody").html(tempTablesNull())
                $("#vitalSignBody").html(tempTablesNull())
            }
        });
    }

    function copyLastDiagnosis() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getLastDiagnosis',
            type: "POST",
            data: JSON.stringify({
                'visit_id': '<?= $visit['visit_id']; ?>',
                'username': '<?= user()->username; ?>'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#cpptDivForm").hide()
                getLoadingscreen("contentCppt", "loadContentCppt")
                getLoadingscreen("contentAssessmentPerawat", "loadContentAssessmentPerawat")
                $("#cpptBody").html(loadingScreen())
                $("#vitalSignBody").html(loadingScreen())
            },
            processData: false,
            success: function(data) {
                if (data) {
                    $("#acpptteraphy_desc").val(data.diagnosa_desc)
                } else {
                    alert("tidak ada data")
                }
            },
            error: function() {
                $("#cpptBody").html(tempTablesNull())
                $("#vitalSignBody").html(tempTablesNull())
            }
        });
    }

    function enableacppt() {
        $("#formsaveacpptbtnid").slideDown()
        $("#formeditacpptid").slideUp()
        $("#formsignacpptid").slideDown()
        $("#formaddacppt input").prop("disabled", false)
        $("#formaddacppt textarea").prop("disabled", false)
        $("#formaddacppt select").prop("disabled", false)
        $("#vitalSignPerawat").find("button").click()
        $("#formaddacppt .btn-to-hide").slideDown()
    }

    function disableacppt() {

        if ($("#acpptmodified_by").val() == '<?= user()->username; ?>' || <?= json_encode(user()->checkRoles(['superuser'])) ?>)
            if ($("#acpptvalid_user").val() == '' || $("#acpptvalid_user").val() == null) {
                $("#formsaveacpptbtnid").slideUp()
                $("#formeditacpptid").slideDown()
                $("#formsignacpptid").slideUp()
            } else {
                $("#formsaveacpptbtnid").slideUp()
                $("#formeditacpptid").slideUp()
                $("#formsignacpptid").slideUp()
            }
        else {
            $("#formsaveacpptbtnid").slideUp()
            $("#formeditacpptid").slideUp()
            $("#formsignacpptid").slideUp()
        }

        $("#formaddacppt input").prop("disabled", true)
        $("#formaddacppt textarea").prop("disabled", true)
        $("#formaddacppt select").prop("disabled", true)
        $("#vitalSignPerawat").find("button").click()

        $("#formaddacppt .btn-to-hide").slideUp()
    }
    const signacppt = () => {
        $("#bodyFallRiskCppt").find("button.btn-save:not([disabled])").trigger("click")
        $("#bodyGcsCppt").find("button.btn-save:not([disabled])").trigger("click")
        addSignUser("formaddacppt", "acppt", "acpptbody_id", "formsaveacpptbtnid", 1, 1, 1, "CPPT")
    }

    function fillRiwayatAcppt() {
        $.each(riwayatAll, function(key, value) {
            $("#acpptGEN0009" + value.value_id).val(value.histories)
            $("#acpptGEN0009" + value.value_id).prop("disabled", true)
        })
    }

    const fillDataAcppt = async (index) => {
        var ex = examForassessment[index]
        $.each(ex, function(key, value) {
            $("#acppt" + key).val(value)
            $("#acppt" + key).prop("disabled", true)
        })
        $("#acpptclinic_id").html('<option value="' + ex.clinic_id + '">' + ex.name_of_clinic + '</option>')
        $("#acpptemployee_id").html('<option value="' + ex.employee_id + '">' + ex.fullname + '</option>')
        flatpickrInstances["flatacpptexamination_date"].setDate(formatedDatetimeFlat(ex.examination_date))
        $("#flatacpptexamination_date").trigger("change")

        if ($("#acpptpetugas_type").val() == '13') {
            $("#groupDiagnosaPerawatCppt").show()
        } else {
            $("#groupDiagnosaPerawatCppt").hide()
        }

        await checkSignSignature("formaddacppt", "acpptbody_id", "formsaveacpptbtnid", 1)

        getFallRisk(examselect.body_id, "bodyFallRiskCppt")
        getGcs(examselect.body_id, "bodyGcsCppt")
        // getPainMonitoring(ex.body_id)
        // getTriage(ex.body_id, "bodyTriage")
        // getApgar(ex.body_id)
        // getStabilitas(ex.body_id)
        // getPernapasan(ex.body_id)
        // getSirkulasi(ex.body_id)
        // getNeurosensoris(ex.body_id)
        // getIntegumen(ex.body_id)
        // getADL(ex.body_id)
        // getPencernaan(ex.body_id)
        // getDekubitus(ex.body_id)
        // getPsikologi(ex.body_id)
        // getPerkemihan(ex.body_id)
        // getSeksual(ex.body_id)
        // getSocial(ex.body_id)
        // getGizi(ex.body_id)
        // getEducationForm(ex.body_id)
        // getEducationIntegration(ex.body_id)
        // getHearing(ex.body_id)
        // getSleeping(ex.body_id)
        disableARP()
    }
</script>

<script>
    $("#formsaveacpptbtnid").off().on('click', (function(e) {
        // tinyMCE.triggerSave();
        // let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();

        let account_id = $("#acpptaccount_id").val()

        if ($("#acpptanamnase").val() == '') {
            if (account_id == '3')
                alert("Subyektif tidak boleh kosong")
            else {
                alert("Situation tidak boleh kosong")
            }
            return false;
        }
        if ($("#acpptteraphy_desc").val() == '') {
            if (account_id == '3')
                alert("Asesmen tidak boleh kosong")
            else {
                alert("Asesmen tidak boleh kosong")
            }
            return false;
        }
        if ($("#acpptinstruction").val() == '') {
            if (account_id == '3')
                alert("Planning tidak boleh kosong")
            else {
                alert("Recommendation tidak boleh kosong")
            }
            return false;
        }

        $("#formaddacppt").find("button.btn-save:visible").trigger("click")

        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveExaminationInfo',
            type: "POST",
            data: new FormData(document.getElementById('formaddacppt')),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // clicked_submit_btn.button('loading');
            },
            success: function(data) {
                var isNewDocument = 0
                $.each(examForassessment, function(key, value) {
                    if (value.body_id == data.body_id) {
                        examForassessment[key] = data
                        isNewDocument = 1
                    }
                })
                // if (isNewDocument != 1)
                //     examForassessment.push(data)
                if (isNewDocument != 1) {
                    let examNew = Array();
                    examNew.push(data)
                    $.each(examForassessment, function(key, value) {
                        examNew.push(examForassessment[key])
                    })
                    examForassessment = examNew
                }

                $("#cpptBody").html("")
                examForassessment.forEach((element, key) => {
                    if (element.account_id == '3' || element.account_id == '4') {
                        examselect = examForassessment[key];
                        addRowCPPT(examselect, key)
                    }
                });
                disableacppt()
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                // clicked_submit_btn.button('reset');
                errorSwal(xhr);
            },
            complete: function() {
                // clicked_submit_btn.button('reset');
            }
        });
    }));

    $("#cpptVerifyAllBtn").on("click", function() {
        if (confirm('Apakah anda yakin akan memverifikasi semua data ini? Data yang sudah diverifikasi sudah tidak dapat diubah.')) {
            let data = examForassessment.filter(item => item.account_id == 3 || item.account_id == 4);
            let dataMap = data.map(item => item.body_id)
            console.log(dataMap)

            postData({
                data: dataMap
            }, 'admin/rm/assessment/verifyAllCppt', (res) => {
                getCppt()
                if (res.response) {
                    console.log(res)
                }
            })
        }
    })

    const verifyCppt = (key) => {
        var examselect = examForassessment[key];

        postData({
            data: examselect
        }, 'admin/rm/assessment/verifyCppt', (res) => {
            // getCppt()
            if (res.response) {
                examselect.valid_user = '<?= user()->username; ?>'
                examselect.valid_date = nowtime
                console.log(res)
            }
            $.each(examForassessment, function(key, value) {
                if (value.body_id == examselect.body_id) {
                    examForassessment[key] = examselect
                    isNewDocument = 1
                }
            })
            $("#cpptBody").html("")
            examForassessment.forEach((element, key) => {
                if (element.account_id == '3' || element.account_id == '4') {
                    examselect = examForassessment[key];
                    addRowCPPT(examselect, key)
                }
            });
        })
    }

    $("#cpptSearchBtn").on("click", function() {
        let top = $("#cpptTop").val()
        let episode = $("#cpptEpisode").val()
        getCppt(top, episode)
    })
</script>