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
    var falljson = [];
    falljson = <?= json_encode($exam); ?>;
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
    })
    $("#fallTab").on("click", function() {
        $("#fallBody").html('')
        getFallRiskAll()
    })



    function addRowfall(fallselect, key) {
        var type = '';
        if (fallselect.p_type == 'ASES019') {
            type = 'HUMPTY DUMPTY (SKALA JATUH ANAK)'
        } else {
            type = 'MORSE FALL SCALE(SKALA JATUH MORSE)'
        }
        var p1 = '';
        var p2 = '';
        var p3 = '';
        var p4 = '';
        var p5 = '';
        var p6 = '';
        var p7 = '';

        $.each(fallRiskDetail, function(key, value) {
            if (value.body_id == fallselect.body_id) {
                if (value.parameter_id == '01') {
                    p1 = value.value_desc
                }
                if (value.parameter_id == '02') {
                    p2 = value.value_desc
                }
                if (value.parameter_id == '03') {
                    p3 = value.value_desc
                }
                if (value.parameter_id == '04') {
                    p4 = value.value_desc
                }
                if (value.parameter_id == '05') {
                    p5 = value.value_desc
                }
                if (value.parameter_id == '06') {
                    p6 = value.value_desc
                }
            }
        })
        $("#fallBody").append($("<tr>")
            .append($("<td>").append((fallselect.examination_date)?.substring(0, 16)))
            .append($("<td>").html(fallselect.modified_by))
            .append($("<td>").html(type))
            .append($("<td>").html(p1))
            .append($("<td>").html(p2))
            .append($("<td>").html(p3))
            .append($("<td>").html(p4))
            .append($("<td>").html(p5))
            .append($("<td>").html('<button type="button" onclick="editfall(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
            .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + fallselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
        )
        // if (fallselect.valid_user === null) {} else {
        //     $("#fallBody").append($("<tr>")
        //         .append($("<td>").append((fallselect.examination_date)?.substring(0, 16)))
        //         .append($("<td>").html(fallselect.modified_by))
        //         .append($("<td>").html(type))
        //         .append($("<td>").html(p1))
        //         .append($("<td>").html(p2))
        //         .append($("<td>").html(p3))
        //         .append($("<td>").html(p4))
        //         .append($("<td>").html(p5))
        //         .append($("<td colspan=\"2\">"))
        //     )
        // }
    }

    falljson.forEach((element, key) => {
        examselect = falljson[key];
        addRowfall(examselect, key)
    });

    function editfall(key) {
        // var examselect = examForassessment[key];

        // $.each(examselect, function(key, value) {
        //     $("#afall" + key).val(value)
        // })
        $("#afallDocument").html("")
        addFallRisk(0, key, 'FallRisk', 'afallDocument')
        $("#fallModal").modal("show")
        // $("#afallDocument").find("input, select, textarea").prop("disabled", false)
    }

    function copyfall(key) {
        var examselect = examForassessment[key];

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#afallageday").val(examselect.ageday)
        $("#afallagemonth").val(examselect.agemonth)
        $("#afallageyear").val(examselect.ageyear)
        $("#afallanamnase").val(examselect.anamnase)
        $("#afallarm_diameter").val(examselect.arm_diameter)
        $("#afallbed_id").val(examselect.bed_id)
        $("#afallbody_id").val(bodyId)
        $("#afallclass_room_id").val(examselect.class_room_id)
        $("#afallclinic_id").val(examselect.clinic_id)
        $("#afalldescription").val(examselect.description)
        $("#afalldoctor").val(examselect.doctor)
        $("#afallemployee_id").val(examselect.employee_id)
        $("#afallexamination_date").val(get_date())
        $("#afallgender").val(examselect.gender)
        $("#afallheight").val(examselect.height)
        $("#afallinstruction").val(examselect.instruction)
        $("#afallisrj").val(examselect.isrj)
        $("#afallkal_id").val(examselect.kal_id)
        $("#afallkeluar_id").val(examselect.keluar_id)
        $("#afallnadi").val(examselect.nadi)
        $("#afallnafas").val(examselect.nafas)
        $("#afallno_registraiton").val(examselect.no_registraiton)
        $("#afallorg_unit_code").val(examselect.org_unit_code)
        $("#afallpemeriksaan").val(examselect.pemeriksaan)
        $("#afallpetugas").val(examselect.petugas)
        $("#afallsaturasi").val(examselect.saturasi)
        $("#afallstatus_pasien_id").val(examselect.status_pasien_id)
        $("#afalltemperature").val(examselect.temperature)
        $("#afalltension_below").val(examselect.tension_below)
        $("#afalltension_upper").val(examselect.tension_upper)
        $("#afallteraphy_desc").val(examselect.teraphy_desc)
        $("#afalltheaddress").val(examselect.theaddress)
        $("#afalltheid").val(examselect.pasien_id)
        $("#afallthename").val(examselect.diantar_oleh)
        $("#afallvisit_id").val(examselect.visit_id)
        $("#afallweight").val(examselect.weight)

        $("#afallorg_unit_code").val(examselect.org_unit_code)
        $("#afallpasien_diagnosa_id").val(examselect.pasien_diagnosa_id)
        $("#afallno_registration").val(examselect.no_registration)
        $("#afallvisit_id").val(examselect.visit_id)
        $("#afalltrans_id").val(examselect.trans_id)
        $("#afallbill_id").val(examselect.bill_id)
        $("#afallclass_room_id").val(examselect.class_room_id)
        $("#afallbed_id").val(examselect.bed_id)
        $("#afallin_date").val(examselect.in_date)
        $("#afallexit_date").val(examselect.exit_date)
        $("#afallkeluar_id").val(examselect.keluar_id)
        $("#afallimt_score").val(examselect.imt_score)
        $("#afallimt_desc").val(examselect.imt_desc)
        $("#afallpemeriksaan").val(examselect.pemeriksaan)
        $("#afallmedical_treatment").val(examselect.medical_treatment)
        $("#afallmodified_date").val(examselect.modified_date)
        $("#afallmodified_by").val(examselect.modified_by)
        $("#afallmodified_from").val(examselect.modified_from)
        $("#afallstatus_pasien_id").val(examselect.status_pasien_id)
        $("#afallageyear").val(examselect.ageyear)
        $("#afallagemonth").val(examselect.agemonth)
        $("#afallageday").val(examselect.ageday)
        $("#afallthename").val(examselect.thename)
        $("#afalltheaddress").val(examselect.theaddress)
        $("#afalltheid").val(examselect.theid)
        $("#afallisrj").val(examselect.isrj)
        $("#afallgender").val(examselect.gender)
        $("#afalldoctor").val(examselect.doctor)
        $("#afallkal_id").val(examselect.kal_id)
        $("#afallpetugas_id").val(examselect.petugas_id)
        $("#afallpetugas").val(examselect.petugas)
        $("#afallaccount_id").val(examselect.account_id)
        $("#afallkesadaran").val(examselect.kesadaran)
        $("#afallisvalid").val(examselect.isvalid)

        $("#afallanamnase").val(examselect.anamnase)
        $("#afalldescription").val(examselect.description)
        $("#afallweight").val(examselect.weight)
        $("#afallheight").val(examselect.height)
        $("#afalltemperature").val(examselect.temperature)
        $("#afallnadi").val(examselect.nadi)
        $("#afalltension_upper").val(examselect.tension_upper)
        $("#afalltension_lower").val(examselect.tension_lower)
        $("#afallsaturasi").val(examselect.saturasi)
        $("#afallnafas").val(examselect.nafas)
        $("#afallarm_diameter").val(examselect.arm_diameter)
        $("#afallpemeriksaan").val(examselect.pemeriksaan)

        $("#afallvs_status_id" + examselect.vs_status_id).prop("checked", true)

        $("#fallModal").modal("show")
        $("#formsaveafallbtnid").slideDown()
        $("#formeditafallid").slideUp()
    }
</script>

<script>
    function initialAddafall() {
        $("#afallDocument").html("")
        addFallRisk(1, 0, 'FallRisk', 'afallDocument', true, true)
        $("#fallModal").modal("show")
        $("#afallDocument").find("input, select, textarea").prop("disabled", false)
    }
</script>
<script>
    function getFallRiskAll() {
        // $("#bodyFallRisk").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getFallRisk',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': ''
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#fallBody").html(loadingScreen())
            },
            success: function(data) {
                $("#fallBody").html("")
                fallRisk = data.fallRisk
                fallRiskDetail = data.fallRiskDetail

                $.each(fallRisk, function(key, value) {
                    addRowfall(value, key)
                })
            },
            error: function() {
                $("#fallBody").html(tempTablesNull())
            }
        });
    }
</script>