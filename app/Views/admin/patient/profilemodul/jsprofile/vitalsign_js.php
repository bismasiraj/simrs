<script type='text/javascript'>
    $("#vitalsignTab").on("click", function() {
        getVitalSign()
    })
    $("#avtvs_status_id").on("change", function() {
        changeEwsParam("vitalsignclass")
        var optionSelected = $("option:selected", this);
        $('.vitalsignclass').each((index, each) => {
            $(each).change(element => {
                vitalsignInput({
                    value: $(each).val(),
                    name: $(each).attr('name'),
                    type: optionSelected.val()
                })
            })
            vitalsignInput({
                value: $(each).val(),
                name: $(each).attr('name'),
                type: optionSelected.val()
            })
        });
    })

    $(document).ready(function() {
        vitalsign.forEach((element, key) => {
            examselect = vitalsign[key];
            addRowVitalSign(examselect, key)
        });
    })


    const setDataVitalSign = () => {
        $("#formvitalsign").find("input, textarea").val(null)
        $("#formvitalsign").find("#avttotal_score").html("")
        $("#formvitalsign").find("span.h6").html("")
        var initialexam = vitalsign[vitalsign.length - 1]
        $.each(initialexam, function(key, value) {
            $("#avt" + key).val(value)
        })
        $("#avtbody_id").val(get_bodyid())
        $("#avtclinic_id").val('<?= $visit['clinic_id']; ?>')
        $("#avttrans_id").val('<?= $visit['trans_id']; ?>')
        $("#avtclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#avtbed_id").val()
        $("#avtkeluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#avtemployee_id").val('<?= $visit['employee_id']; ?>')
        $("#avtno_registration").val('<?= $visit['no_registration']; ?>')
        $("#avtvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#avtorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#avtdoctor").val('<?= @$visit['fullname']; ?>')
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
        // $("#avtpetugas").val('<?= user()->getFullname(); ?>')
        // $("#avtpetugas_id").val('<?= user()->username; ?>')
        $("#avtmodified_by").val('<?= user()->username; ?>')
        console.log($("#avtmodified_by").val())
        $("#avtaccount_id").val(5)
        flatpickrInstances["flatavtexamination_date"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );
        $("#flatavtexamination_date").trigger("change");

        var ageYear = <?= $visit['ageyear']; ?>;
        var ageMonth = <?= $visit['agemonth']; ?>;
        var ageDay = <?= $visit['ageday']; ?>;

        if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
            $("#avtvs_status_id").prop("selectedIndex", 3);
        } else if (ageYear >= 18) {
            $("#avtvs_status_id").prop("selectedIndex", 1);
        } else {
            $("#avtvs_status_id").prop("selectedIndex", 2);
        }
        enableVitalSign()
        $("#vitalSignDocument").slideDown()
    }

    const addRowVitalSign = (examselect, key) => {
        $("#vitalSignBody").append($("<tr>")
                .append($("<td rowspan='2'>").append(formatedDatetimeFlat(examselect.examination_date)))
                .append($("<td rowspan='2'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='2'>").html('<button type="button" onclick="copyVitalSign(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editCpptVitalSign(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
                .append($("<td rowspan='2'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
            .append($("<tr>")
                .append($("<td>").html(''))
                .append($("<td>").html(examselect.tension_upper + '/' + examselect.tension_below + 'mmHg'))
                .append($("<td>").html(examselect.nadi + '/menit'))
                .append($("<td>").html(examselect.nafas + '/menit'))
                .append($("<td>").html(examselect.temperature + '/°C'))
                .append($("<td>").html(examselect.saturasi + '/SpO2%'))
            )
    }



    const disableVitalSign = () => {
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
        $("#avtoxygen_usage").prop("disabled", true)
        $("#avtvs_status_id").prop("disabled", true)
        $("#avtpemeriksaan").prop("disabled", true)
        $("#avtteraphy_desc").prop("disabled", true)
        $("#avtdescription").prop("disabled", true)
        $("#avtclinic_id").prop("disabled", true)
        $("#avttrans_id").prop("disabled", true) //==new
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

        $("#formvitalsignsubmit").hide()
        $("#formvitalsignedit").show()
    }

    const enableVitalSign = () => {
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
        $("#avtoxygen_usage").prop("disabled", false)
        $("#avtvs_status_id").prop("disabled", false)
        $("#avtanamnase").prop("disabled", false)
        $("#avtpemeriksaan").prop("disabled", false)
        $("#avtteraphy_desc").prop("disabled", false)
        $("#avtdescription").prop("disabled", false)
        $("#avtclinic_id").prop("disabled", false)
        $("#avttrans_id").prop("disabled", false) //==new
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

        $("#formvitalsignsubmit").show()
        $("#formvitalsignedit").hide()
    }

    var vitalsigndesc = []

    var i = 0


    $("#formvitalsign").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        clicked_submit_btn.html('<i class="spinner-border spinner-border-sm"></i>')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/Assessment/saveVitalSign', //==new
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
                    // errorSwal(message);
                    errorSwal(message)
                    getVitalSign()
                } else {
                    // successSwal(data.message);
                    successSwal("Berhasil Simpan Data")
                    disableVitalSign()
                    $("#formvitalsignsubmit").toggle()
                    $("#formvitalsignedit").toggle()
                    getVitalSign()
                }
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            error: function(xhr) { // if error occured
                errorSwal("Error occured.please try again");
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            complete: function() {
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            }
        });
    }));

    const getVitalSign = () => {
        $("#vitalSignDocument").slideUp()
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getVitalSign',
            type: "POST",
            data: JSON.stringify({
                'visit_id': '<?= $visit['visit_id']; ?>',
                'trans_id': '<?= $visit['trans_id']; ?>',
                'nomor': '<?= $visit['no_registration']; ?>',
                'isrj': '<?= $visit['isrj']; ?>',
                'norujukan': '<?= $visit['norujukan']; ?>',
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                getLoadingscreen("contentVitalSign", "loadContentVitalSign")
            },
            success: function(data) {
                $("#vitalSignBody").html(tempTablesNull())
                vitalsign = data.examInfo
                if (vitalsign.length > 0) {
                    $("#vitalSignBody").html("")
                    vitalsign.forEach((element, key) => {
                        examselect = vitalsign[key];
                        addRowVitalSign(examselect, key)
                    });
                } else {
                    $("#vitalSignBody").html(tempTablesNull())
                }
            },
            error: function() {

            }
        });
    }
</script>

<script>
    const copyVitalSign = (key) => {
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
        flatpickrInstances["flatavtexamination_date"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );
        $("#flatavtexamination_date").trigger("change");
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
        $("#avtoxygen_usage").val(examselect.oxygen_usage)
        $("#avtvs_status_id").val(examselect.vs_status_id)
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
        $("#avttrans_id").val(examselect.trans_id) //==new
        $("#avtbill_id").val(examselect.bill_id)
        $("#avtclass_room_id").val(examselect.class_room_id)
        $("#avtbed_id").val(examselect.bed_id)
        $("#avtin_date").val(examselect.in_date)
        $("#avtexit_date").val(examselect.exit_date)
        $("#avtkeluar_id").val(examselect.keluar_id)
        $("#avtimt_score").val(examselect.imt_score)
        $("#avtimt_desc").val(examselect.imt_desc)
        $("#avtoxygen_usage").val(examselect.oxygen_usage)
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
        $("#avtweight").val(examselect.weight).trigger("change")
        $("#avtheight").val(examselect.height).trigger("change")
        $("#avttemperature").val(examselect.temperature).trigger("change")
        $("#avtnadi").val(examselect.nadi).trigger("change")
        $("#avttension_upper").val(examselect.tension_upper).trigger("change")
        $("#avttension_lower").val(examselect.tension_lower).trigger("change")
        $("#avtsaturasi").val(examselect.saturasi).trigger("change")
        $("#avtnafas").val(examselect.nafas).trigger("change")
        $("#avtarm_diameter").val(examselect.arm_diameter).trigger("change")
        $("#avtoxygen_usage").val(examselect.oxygen_usage).trigger("change")
        $("#avtvs_status_id").val(examselect.vs_status_id).trigger("change")
        $("#avtpemeriksaan").val(examselect.pemeriksaan).trigger("change")

        $("#vitalSignDocument").slideDown()
        enableVitalSign()
        //=new
        // data1 = getAdultScore('nadi', examselect.nadi);
        // data2 = getAdultScore('suhu', examselect.temperature);
        // data3 = getAdultScore('saturasi', examselect.saturasi);
        // data4 = getAdultScore('pernapasan', examselect.nafas);
        // data5 = getAdultScore('oksigen', examselect.oxygen_usage);
        // data6 = getAdultScore('darah', examselect.tension_upper);

        // let totalSkor = data1.score + data2.score + data3.score + data4.score + data5.score + data6.score;
        // document.getElementById('total_score').textContent = 'Total Skor: ' + totalSkor;
        //endofnew

        // $("#cpptModal").modal("show")
        // $("#formsaveavtbtnid").show()
        // $("#formeditavtid").hide()
    }

    const editCpptVitalSign = (key) => {
        var examselect = vitalsign[key];

        $.each(examselect, function(key, value) {
            $("#avt" + key).val(value)
        })
        // $("#avtvs_status_id" + examselect.vs_status_id).prop("checked", true)
        // $("#cpptModal").modal("show")
        $("#avtDocument").find("input, select, textarea").prop("disabled", false)
        $("#formsaveavtbtnid").show()
        $("#formeditavtid").hide()
        $("#vitalSignDocument").slideDown()
        enableVitalSign()
        // getFallRisk(examselect.body_id, "bodyFallRiskCppt")
        // getGcs(examselect.body_id, "bodyGcsCppt")
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

    const displayTableAssessmentKeperawatanForVitalSign = () => {
        $("#copyListVitalSignModal").html("")
        $.each(examForassessment, function(key, value) {
            var pd = examForassessment[key]
            if (value.body_id == $("#armbody_id")) {
                $("#copyListVitalSignModal").append($("<tr>")
                    .append($("<td>").append($("<b>").append('<i class="mdi mdi-arrow-collapse-right" style="font-size: large"></i>')))
                    .append($("<td>").append($("<b>").html(formatedDatetimeFlat(value.examination_date))))
                    .append($("<td>").append($("<b>").html(value.petugas_id)))
                    .append($("<td>").append($("<b>").html(value.weight)))
                    .append($("<td>").append($("<b>").html(value.height)))
                    .append($("<td>").append($("<b>").html(value.temperature)))
                    .append($("<td>").append($("<b>").html(value.nadi)))
                    .append($("<td>").append($("<b>").html(value.tension_upper)))
                    .append($("<td>").append($("<b>").html(value.tension_below)))
                    .append($("<td>").append($("<b>").html(value.saturasi)))
                    .append($("<td>").append($("<b>").html(value.nafas)))
                    .append($("<td>").append($("<b>").html(value.arm_diameter)))
                    .append($("<td>").append($("<b>").append($('<button class="btn btn-success" onclick="fillVitalSignMedis(' + key + ')">').html("Copy"))))
                )
                $("#copyListVitalSignModal").append($("<tr>")
                    .append($("<td>").append($("<b>").append('<i class="mdi mdi-arrow-collapse-right" style="font-size: large"></i>')))
                    .append($("<td>").append($("<b>").html(formatedDatetimeFlat(value.examination_date))))
                    .append($("<td>").append($("<b>").html(value.name_of_clinic)))
                    .append($("<td>").append($("<b>").html(value.fullname)))
                    .append($("<td>").append($('<button class="btn btn-success" onclick="fillDataArp(' + key + ')">').html("Lihat")))
                )
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
            } else {
                $("#copyListVitalSignModal").append($("<tr>")
                    .append($("<td>"))
                    .append($("<td>").html(formatedDatetimeFlat(value.examination_date)))
                    .append($("<td>").html(value.petugas_id))
                    .append($("<td>").html(value.weight))
                    .append($("<td>").html(value.height))
                    .append($("<td>").html(value.temperature))
                    .append($("<td>").html(value.nadi))
                    .append($("<td>").html(value.tension_upper))
                    .append($("<td>").html(value.tension_below))
                    .append($("<td>").html(value.saturasi))
                    .append($("<td>").html(value.nafas))
                    .append($("<td>").html(value.arm_diameter))
                    .append($("<td>").append($('<button class="btn btn-success" onclick="fillVitalSignMedis(' + key + ')">').html("Copy")))
                )
            }
        })
    }
</script>