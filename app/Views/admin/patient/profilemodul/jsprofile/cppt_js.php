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
        setDataCPPT()
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

    function get_bodyid() {
        var m = new Date();
        m.setHours(m.getHours() + 7)
        var dateString = m.getUTCFullYear() + "-" + String(m.getUTCMonth() + 1 + 100).substring(1, 3) + "-" + String(m.getUTCDate() + 100).substring(1, 3) + " " + String(m.getUTCHours() + 100).substring(1, 3) + ":" + String(m.getUTCMinutes() + 100).substring(1, 3) + ":" + String(m.getUTCSeconds() + 100).substring(1, 3);
        return dateString;
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

    function addRowCPPT(examselect, key) {
        $("#cpptBody").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date).substring(0, 16)))
                .append($("<td rowspan='7'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="copyCppt(' + key + ')" class="addbtn copybtn" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editCppt(' + key + ')" class="editbtn edit-transparent-btn" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="closebtn delete_row" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>'))
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
        var examselect = cpptjson[key];
        if (examselect.petugas == '<?= user()->getFullname(); ?>') {
            alert("Tidak dapat meengubah inputan CPPT milik dokter/petugas lain")
        } else {
            $("#cpptageday").val(examselect.ageday)
            $("#cpptagemonth").val(examselect.agemonth)
            $("#cpptageyear").val(examselect.ageyear)
            $("#cpptanamnase").val(examselect.anamnase)
            $("#cpptarm_diameter").val(examselect.arm_diameter)
            $("#cpptbed_id").val(examselect.bed_id)
            $("#cpptbody_id").val(examselect.body_id)
            $("#cpptclass_room_id").val(examselect.class_room_id)
            $("#cpptclinic_id").val(examselect.clinic_id)
            $("#cpptdescription").val(examselect.description)
            $("#cpptdoctor").val(examselect.doctor)
            $("#cpptemployee_id").val(examselect.employee_id)
            $("#cpptexamination_date").val(examselect.examination_date)
            $("#cpptgender").val(examselect.gender)
            $("#cpptheight").val(examselect.height)
            $("#cpptinstruction").val(examselect.instruction)
            $("#cpptisrj").val(examselect.isrj)
            $("#cpptkal_id").val(examselect.kal_id)
            $("#cpptkeluar_id").val(examselect.keluar_id)
            $("#cpptnadi").val(examselect.nadi)
            $("#cpptnafas").val(examselect.nafas)
            $("#cpptno_registraiton").val(examselect.no_registraiton)
            $("#cpptorg_unit_code").val(examselect.org_unit_code)
            $("#cpptpemeriksaan").val(examselect.pemeriksaan)
            $("#cpptpetugas").val(examselect.petugas)
            $("#cpptsaturasi").val(examselect.saturasi)
            $("#cpptstatus_pasien_id").val(examselect.status_pasien_id)
            $("#cppttemperature").val(examselect.temperature)
            $("#cppttension_below").val(examselect.tension_below)
            $("#cppttension_upper").val(examselect.tension_upper)
            $("#cpptteraphy_desc").val(examselect.teraphy_desc)
            $("#cppttheaddress").val(examselect.theaddress)
            $("#cppttheid").val(examselect.pasien_id)
            $("#cpptthename").val(examselect.diantar_oleh)
            $("#cpptvisit_id").val(examselect.visit_id)
            $("#cpptweight").val(examselect.weight)
        }
    }

    function copyCppt(key) {
        var examselect = cpptjson[key];
        $("#cpptageday").val(examselect.ageday)
        $("#cpptagemonth").val(examselect.agemonth)
        $("#cpptageyear").val(examselect.ageyear)
        $("#cpptanamnase").val(examselect.anamnase)
        $("#cpptarm_diameter").val(examselect.arm_diameter)
        $("#cpptbed_id").val(examselect.bed_id)
        $("#cpptbody_id").val("")
        $("#cpptclass_room_id").val(examselect.class_room_id)
        $("#cpptclinic_id").val(examselect.clinic_id)
        $("#cpptdescription").val(examselect.description)
        $("#cpptdoctor").val(examselect.doctor)
        $("#cpptemployee_id").val(examselect.employee_id)
        $("#cpptexamination_date").val(get_date())
        $("#cpptgender").val(examselect.gender)
        $("#cpptheight").val(examselect.height)
        $("#cpptinstruction").val(examselect.instruction)
        $("#cpptisrj").val(examselect.isrj)
        $("#cpptkal_id").val(examselect.kal_id)
        $("#cpptkeluar_id").val(examselect.keluar_id)
        $("#cpptnadi").val(examselect.nadi)
        $("#cpptnafas").val(examselect.nafas)
        $("#cpptno_registraiton").val(examselect.no_registraiton)
        $("#cpptorg_unit_code").val(examselect.org_unit_code)
        $("#cpptpemeriksaan").val(examselect.pemeriksaan)
        $("#cpptpetugas").val(examselect.petugas)
        $("#cpptsaturasi").val(examselect.saturasi)
        $("#cpptstatus_pasien_id").val(examselect.status_pasien_id)
        $("#cppttemperature").val(examselect.temperature)
        $("#cppttension_below").val(examselect.tension_below)
        $("#cppttension_upper").val(examselect.tension_upper)
        $("#cpptteraphy_desc").val(examselect.teraphy_desc)
        $("#cppttheaddress").val(examselect.theaddress)
        $("#cppttheid").val(examselect.pasien_id)
        $("#cpptthename").val(examselect.diantar_oleh)
        $("#cpptvisit_id").val(examselect.visit_id)
        $("#cpptweight").val(examselect.weight)
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