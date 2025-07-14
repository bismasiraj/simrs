<script type='text/javascript'>
    $("#painTab").on("click", function() {
        $("#painBody").html('')
        getPainMonitoringAll()
    })



    function addRowpain(painselect, key) {
        var type = '';
        var p = '';
        var q = '';
        var r = '';
        var s = '';
        var t = '';

        $.each(painMonitoringDetil, function(key, value) {
            if (value.body_id == painselect.body_id && value.p_type == 'ASES021') {
                if (value.parameter_id == '01') {
                    type = value.value_desc
                }
                if (value.parameter_id == '02') {
                    p = value.value_desc
                }
                if (value.parameter_id == '03') {
                    q = value.value_desc
                }
                if (value.parameter_id == '04') {
                    r = value.value_desc
                }
                if (value.parameter_id == '05') {
                    s = value.value_desc
                }
                if (value.parameter_id == '06') {
                    t = value.value_desc
                }
            }
        })
        $("#painBody").append($("<tr>"))
        $("#painBody").append($("<tr>")
            .append($("<td>").append((painselect.examination_date)?.substring(0, 16)))
            .append($("<td>").html(painselect.modified_by))
            .append($("<td>").html(type))
            .append($("<td>").html(p))
            .append($("<td>").html(q))
            .append($("<td>").html(r))
            .append($("<td>").html(s))
            .append($("<td>").html(t))
            .append($("<td>").html('<button type="button" onclick="editpain(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
            .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + painselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
        )
        // if (painselect.valid_user === null) {
        //     $("#painBody").append($("<tr>")
        //         .append($("<td>").append((painselect.examination_date)?.substring(0, 16)))
        //         .append($("<td>").html(painselect.modified_by))
        //         .append($("<td>").html(type))
        //         .append($("<td>").html(p))
        //         .append($("<td>").html(q))
        //         .append($("<td>").html(r))
        //         .append($("<td>").html(s))
        //         .append($("<td>").html(t))
        //         .append($("<td>").html('<button type="button" onclick="editpain(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
        //         .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + painselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
        //     )
        // } else {
        //     $("#painBody").append($("<tr>")
        //         .append($("<td>").append((painselect.examination_date)?.substring(0, 16)))
        //         .append($("<td>").html(painselect.modified_by))
        //         .append($("<td>").html(type))
        //         .append($("<td>").html(p))
        //         .append($("<td>").html(q))
        //         .append($("<td>").html(r))
        //         .append($("<td>").html(s))
        //         .append($("<td>").html(t))
        //         .append($("<td colspan=\"2\">"))
        //     )
        // }
    }

    painjson.forEach((element, key) => {
        examselect = painjson[key];
        addRowpain(examselect, key)
    });

    function editpain(key) {
        // var examselect = examForassessment[key];

        // $.each(examselect, function(key, value) {
        //     $("#apain" + key).val(value)
        // })
        $("#apainDocument").html("")
        addPainMonitoring(0, key, 'painmonitoring', 'apainDocument')
        $("#painModal").modal("show")
        $("#apainDocument").find("input, select, textarea, option").prop("disabled", false)
    }

    function copypain(key) {
        var examselect = examForassessment[key];

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#apainageday").val(examselect.ageday)
        $("#apainagemonth").val(examselect.agemonth)
        $("#apainageyear").val(examselect.ageyear)
        $("#apainanamnase").val(examselect.anamnase)
        $("#apainarm_diameter").val(examselect.arm_diameter)
        $("#apainbed_id").val(examselect.bed_id)
        $("#apainbody_id").val(bodyId)
        $("#apainclass_room_id").val(examselect.class_room_id)
        $("#apainclinic_id").val(examselect.clinic_id)
        $("#apaindescription").val(examselect.description)
        $("#apaindoctor").val(examselect.doctor)
        $("#apainemployee_id").val(examselect.employee_id)
        $("#apainexamination_date").val(get_date())
        $("#apaingender").val(examselect.gender)
        $("#apainheight").val(examselect.height)
        $("#apaininstruction").val(examselect.instruction)
        $("#apainisrj").val(examselect.isrj)
        $("#apainkal_id").val(examselect.kal_id)
        $("#apainkeluar_id").val(examselect.keluar_id)
        $("#apainnadi").val(examselect.nadi)
        $("#apainnafas").val(examselect.nafas)
        $("#apainno_registraiton").val(examselect.no_registraiton)
        $("#apainorg_unit_code").val(examselect.org_unit_code)
        $("#apainpemeriksaan").val(examselect.pemeriksaan)
        $("#apainpetugas").val(examselect.petugas)
        $("#apainsaturasi").val(examselect.saturasi)
        $("#apainstatus_pasien_id").val(examselect.status_pasien_id)
        $("#apaintemperature").val(examselect.temperature)
        $("#apaintension_below").val(examselect.tension_below)
        $("#apaintension_upper").val(examselect.tension_upper)
        $("#apainteraphy_desc").val(examselect.teraphy_desc)
        $("#apaintheaddress").val(examselect.theaddress)
        $("#apaintheid").val(examselect.pasien_id)
        $("#apainthename").val(examselect.diantar_oleh)
        $("#apainvisit_id").val(examselect.visit_id)
        $("#apainweight").val(examselect.weight)

        $("#apainorg_unit_code").val(examselect.org_unit_code)
        $("#apainpasien_diagnosa_id").val(examselect.pasien_diagnosa_id)
        $("#apainno_registration").val(examselect.no_registration)
        $("#apainvisit_id").val(examselect.visit_id)
        $("#apaintrans_id").val(examselect.trans_id)
        $("#apainbill_id").val(examselect.bill_id)
        $("#apainclass_room_id").val(examselect.class_room_id)
        $("#apainbed_id").val(examselect.bed_id)
        $("#apainin_date").val(examselect.in_date)
        $("#apainexit_date").val(examselect.exit_date)
        $("#apainkeluar_id").val(examselect.keluar_id)
        $("#apainimt_score").val(examselect.imt_score)
        $("#apainimt_desc").val(examselect.imt_desc)
        $("#apainpemeriksaan").val(examselect.pemeriksaan)
        $("#apainmedical_treatment").val(examselect.medical_treatment)
        $("#apainmodified_date").val(examselect.modified_date)
        $("#apainmodified_by").val(examselect.modified_by)
        $("#apainmodified_from").val(examselect.modified_from)
        $("#apainstatus_pasien_id").val(examselect.status_pasien_id)
        $("#apainageyear").val(examselect.ageyear)
        $("#apainagemonth").val(examselect.agemonth)
        $("#apainageday").val(examselect.ageday)
        $("#apainthename").val(examselect.thename)
        $("#apaintheaddress").val(examselect.theaddress)
        $("#apaintheid").val(examselect.theid)
        $("#apainisrj").val(examselect.isrj)
        $("#apaingender").val(examselect.gender)
        $("#apaindoctor").val(examselect.doctor)
        $("#apainkal_id").val(examselect.kal_id)
        $("#apainpetugas_id").val(examselect.petugas_id)
        $("#apainpetugas").val(examselect.petugas)
        $("#apainaccount_id").val(examselect.account_id)
        $("#apainkesadaran").val(examselect.kesadaran)
        $("#apainisvalid").val(examselect.isvalid)

        $("#apainanamnase").val(examselect.anamnase)
        $("#apaindescription").val(examselect.description)
        $("#apainweight").val(examselect.weight)
        $("#apainheight").val(examselect.height)
        $("#apaintemperature").val(examselect.temperature)
        $("#apainnadi").val(examselect.nadi)
        $("#apaintension_upper").val(examselect.tension_upper)
        $("#apaintension_lower").val(examselect.tension_lower)
        $("#apainsaturasi").val(examselect.saturasi)
        $("#apainnafas").val(examselect.nafas)
        $("#apainarm_diameter").val(examselect.arm_diameter)
        $("#apainpemeriksaan").val(examselect.pemeriksaan)

        $("#apainvs_status_id" + examselect.vs_status_id).prop("checked", true)

        $("#painModal").modal("show")
        $("#formsaveapainbtnid").slideDown()
        $("#formeditapainid").slideUp()
    }
</script>

<script>
    function initialAddapain() {
        $("#apainDocument").html("")
        addPainMonitoring(1, 0, 'painmonitoring', 'apainDocument', true, true)
        $("#painModal").modal("show")
        $("#apainDocument").find("input, select, textarea").prop("disabled", false)
    }
</script>
<script>
    function getPainMonitoringAll() {
        // $("#bodyPainMonitoring").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPainMonitoring',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit?.visit_id,
                'nomor': visit?.no_registration,
                'body_id': '',
                'class_room_id': visit?.class_room_id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#painBody").html(loadingScreen())
            },
            success: function(data) {
                $("#painBody").html("")
                painMonitoring = data.painMonitoring
                painMonitoringDetil = data.painDetil
                painIntervensi = data.painIntervensi

                $.each(painMonitoring, function(key, value) {
                    addRowpain(value, key)
                })
            },
            error: function() {
                $("#painBody").html(tempTablesNull())
            }
        });
    }
</script>