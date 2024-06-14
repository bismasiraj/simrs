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
    var cpptjson = [];
    cpptjson = <?= json_encode($exam); ?>;
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
        // $("#examination_date").val(get_date())
        // setDataCPPT()
    })
    $("#cpptTab").on("click", function() {
        getAssessmentKeperawatan()
    })

    $("#cpptweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cpptheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cppttemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cpptnadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cppttension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cppttension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cpptsaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cpptnafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cpptarm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });

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

        $("#formcpptsubmit").toggle()
        $("#formcpptedit").toggle()
    }
    $("#acpptvs_status_id2").on("click", function() {
        $("#groupRiwayatCppt").show()
        $("#groupRiwayatCppt").find("input, textarea, select").prop("disabled", false)
        $("#groupVitalSignCppt").show()
        $("#groupVitalSignCppt").find("input, textarea, select").prop("disabled", false)
        $("#groupDiagnosaPerawatCppt").show()
        $("#cpptSubyektifTitle").html("SUBYEKTIF (S)")
        $("#cpptObyektifTitle").html("OBYEKTIF (O)")
        $("#cpptPlanningTitle").html("PLANNING (P)")
        // $("#acpptvs_status_id2").is("checked", function() {})
    })
    $("#acpptvs_status_id7").on("click", function() {
        $("#groupRiwayatCppt").hide()
        $("#groupRiwayatCppt").find("input, textarea, select").prop("disabled", true)
        $("#groupVitalSignCppt").hide()
        $("#groupVitalSignCppt").find("input, textarea, select").prop("disabled", true)
        $("#groupDiagnosaPerawatCppt").hide()
        $("#cpptSubyektifTitle").html("SITUATION (S)")
        $("#cpptObyektifTitle").html("BACKGROUND (B)")
        $("#cpptPlanningTitle").html("RECOMMENDATION (R)")
        // $("#acpptvs_status_id2").is("checked", function() {})
    })

    function addRowCPPT(examselect, key) {
        if (examselect.vs_status_id == "2") {
            $("#cpptBody").append($("<tr>")
                    .append($("<td rowspan='7'>").append((examselect.examination_date).substring(0, 16)))
                    .append($("<td rowspan='7'>").html(examselect.petugas))
                    .append($("<td>").html(''))
                    .append($("<td>").html('<b>Tekanan Darah</b>'))
                    .append($("<td>").html('<b>Nadi</b>'))
                    .append($("<td>").html('<b>Nafas/RR</b>'))
                    .append($("<td>").html('<b>Temp</b>'))
                    .append($("<td>").html('<b>SpO2</b>'))
                    .append($("<td rowspan='7'>").html('<button type="button" onclick="copyCppt(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
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
        } else {
            // $("#cpptBody").append($("<tr>"))

        }

        if (examselect.vs_status_id == "2") {
            $("#cpptBody")
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
        } else {
            $("#cpptBody")
                .append($("<tr>")
                    .append($("<td rowspan='5'>").append((examselect.examination_date).substring(0, 16)))
                    .append($("<td rowspan='5'>").html(examselect.petugas))
                    .append($("<td>").html("<b>S</b>"))
                    .append($("<td colspan='5'>").html(examselect.anamnase))
                    .append($("<td rowspan='5'>").html('<button type="button" onclick="copyCppt(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                        '<button type="button" onclick="editCppt(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
                    .append($("<td rowspan='5'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
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

    cpptjson.forEach((element, key) => {
        examselect = cpptjson[key];
        addRowCPPT(examselect, key)
    });

    function editCppt(key) {
        var examselect = examForassessment[key];

        console.log(examselect)
        $.each(examselect, function(key, value) {
            $("#acppt" + key).val(value)
        })
        $("#acpptvs_status_id" + examselect.vs_status_id).prop("checked", true)
        $("#cpptModal").modal("show")
        $("#acpptDocument").find("input, select, textarea").prop("disabled", false)

        $("#bodyFallRiskCppt").html("")
        $("#bodyGcsCppt").html("")
        $("#formsaveacpptbtnid").show()
        $("#formeditacpptid").hide()
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
        $("#acpptpetugas").val(examselect.petugas)
        $("#acpptaccount_id").val(examselect.account_id)
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

        $("#acpptvs_status_id" + examselect.vs_status_id).prop("checked", true)

        $("#cpptModal").modal("show")
        $("#formsaveacpptbtnid").show()
        $("#formeditacpptid").hide()
    }

    $("#formcppt").on('submit', (function(e) {
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
                    if (data.type == 'insert') {
                        cpptjson.push(data.data)
                        setDataCPPT()
                        var len = cpptjson.length
                        addRowCPPT(data.data, len)
                    } else {
                        console.log(data.type)
                        $("#cpptBody").html("")
                        setDataCPPT()
                        cpptjson.forEach((element, key) => {
                            console.log("json: " + cpptjson[key].body_id + " & data: " + data.data.body_id)
                            if (cpptjson[key].body_id == data.data.body_id) {
                                cpptjson[key] = data.data
                            }
                            addRowCPPT(data.data, key)
                        });
                    }
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

<script>
    function initialAddacppt() {


        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#formaddacppt").find("input, textarea").val(null)

        $("#acpptvs_status_id2").val("2")
        $("#acpptvs_status_id7").val("7")
        $("#acpptvs_status_id2").prop("checked", true)
        $("#acpptbody_id").val(bodyId)
        $("#acpptorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#acpptpasien_diagnosa_id").val(null)
        $("#acpptdiagnosa_id").val(null)
        $("#acpptno_registration").val('<?= $visit['no_registration']; ?>')
        $("#acpptvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#acpptbill_id").val(null)
        <?php if (!is_null($visit['class_room_id'])) { ?>
            $('#acpptclinic_id').val('<?= $visit['class_room_id']; ?>')
        <?php } else { ?>
            $('#acpptclinic_id').val('<?= $visit['clinic_id']; ?>')
        <?php } ?>
        <?php if (!is_null($visit['class_room_id'])) { ?>
            $('#acpptemployee_id').val('<?= $visit['employee_inap']; ?>')
        <?php } else { ?>
            $('#acpptemployee_id').val('<?= $visit['employee_id']; ?>')
        <?php } ?>
        $("#acpptclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#acpptbed_id").val('<?= $visit['bed_id']; ?>')
        $("#acpptin_date").val('<?= $visit['in_date']; ?>')
        $("#acpptexit_date").val('<?= $visit['exit_date']; ?>')
        $("#acpptkeluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#acpptexamination_date").val(get_date())
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
        $("#acpptpetugas").val('<?= user()->getFullname(); ?>')

        $('#keperawatanListLinkAll').html("")

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
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>/' + $("#acpptbody_id").val() + '" target="_blank">Transfer Internal</a></li>')

        $("#acpptisvalid").val(0)

        $("#acpptAddDocument").hide()
        $("#acpptDocument").show()
        enableacppt()
        fillRiwayatAcppt()
        $("#cpptModal").modal("show")
    }
</script>
<script>
    function enableacppt() {
        $("#formsaveacpptbtnid").show()
        $("#formeditacpptid").hide()
        $("#formsignacpptid").hide()
        $("#formaddacppt input").prop("disabled", false)
        $("#formaddacppt textarea").prop("disabled", false)
        $("#formaddacppt select").prop("disabled", false)
        $("#vitalSignPerawat").find("button").click()
    }

    function disableacppt() {
        $("#formsaveacpptbtnid").hide()
        $("#formeditacpptid").show()
        $("#formsignacpptid").show()
        $("#formaddacppt input").prop("disabled", true)
        $("#formaddacppt textarea").prop("disabled", true)
        $("#formaddacppt select").prop("disabled", true)
        $("#vitalSignPerawat").find("button").click()
    }

    function fillRiwayatAcppt() {
        $.each(riwayatAll, function(key, value) {
            $("#acpptGEN0009" + value.value_id).val(value.histories)
            $("#acpptGEN0009" + value.value_id).prop("disabled", true)
        })
    }

    function fillDataAcppt(index) {
        var ex = examForassessment[index]
        $.each(ex, function(key, value) {
            $("#acppt" + key).val(value)
            $("#acppt" + key).prop("disabled", true)
        })
        $("#acpptclinic_id").html('<option value="' + ex.clinic_id + '">' + ex.name_of_clinic + '</option>')
        $("#acpptemployee_id").html('<option value="' + ex.employee_id + '">' + ex.fullname + '</option>')

        getPainMonitoring(ex.body_id)
        getTriage(ex.body_id, "bodyTriage")
        getApgar(ex.body_id)
        getStabilitas(ex.body_id)
        getPernapasan(ex.body_id)
        getSirkulasi(ex.body_id)
        getNeurosensoris(ex.body_id)
        getIntegumen(ex.body_id)
        getADL(ex.body_id)
        getPencernaan(ex.body_id)
        getDekubitus(ex.body_id)
        getPsikologi(ex.body_id)
        getPerkemihan(ex.body_id)
        getSeksual(ex.body_id)
        getSocial(ex.body_id)
        getGizi(ex.body_id)
        getEducationForm(ex.body_id)
        getEducationIntegration(ex.body_id)
        getHearing(ex.body_id)
        getSleeping(ex.body_id)
        disableARP()
    }
</script>

<script>
    $("#formsaveacpptbtnid").on('click', (function(e) {
        tinyMCE.triggerSave();
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveExaminationInfo',
            type: "POST",
            data: new FormData(document.getElementById('formaddacppt')),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                // $("#formsavearpbtn").hide()
                // $("#formeditarp").show()
                var isNewDocument = 0
                $.each(examForassessment, function(key, value) {
                    if (value.body_id == data.body_id) {
                        examForassessment[key] = data
                        isNewDocument = 1
                    }
                })
                if (isNewDocument != 1)
                    examForassessment.push(data)
                disableacppt()
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
</script>