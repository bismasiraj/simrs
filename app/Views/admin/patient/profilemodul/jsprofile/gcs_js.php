<script type='text/javascript'>
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    var gcsjson = [];
    gcsjson = <?= json_encode($exam); ?>;
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
    $("#gcsTab").on("click", function() {
        $("#gcsBody").html('')
        getGcsAll()
    })



    function addRowgcs(gcsselect, key) {
        $("#gcsBody").append($("<tr>")
            .append($("<td>").append((gcsselect.examination_date)?.substring(0, 16)))
            .append($("<td>").html(gcsselect.modified_by))
            .append($("<td>").html(gcsselect.gcs_e))
            .append($("<td>").html(gcsselect.gcs_m))
            .append($("<td>").html(gcsselect.gcs_v))
            .append($("<td>").html(gcsselect.gcs_score))
            .append($("<td>").html(gcsselect.gcs_desc))
            .append($("<td>").html('<button type="button" onclick="editgcs(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
            .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + gcsselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
        )
        // if (gcsselect.valid_user === null) {} else {
        //     $("#gcsBody").append($("<tr>")
        //         .append($("<td>").append((gcsselect.examination_date)?.substring(0, 16)))
        //         .append($("<td>").html(gcsselect.modified_by))
        //         .append($("<td>").html(gcsselect.gcs_e))
        //         .append($("<td>").html(gcsselect.gcs_m))
        //         .append($("<td>").html(gcsselect.gcs_v))
        //         .append($("<td>").html(gcsselect.gcs_score))
        //         .append($("<td>").html(gcsselect.gcs_desc))
        //         .append($("<td colspan=\"2\">"))
        //     )
        // }
    }

    gcsjson.forEach((element, key) => {
        examselect = gcsjson[key];
        addRowgcs(examselect, key)
    });

    function editgcs(key) {
        // var examselect = examForassessment[key];

        // $.each(examselect, function(key, value) {
        //     $("#agcs" + key).val(value)
        // })
        $("#agcsDocument").html("")
        addGcs(0, key, 'Gcs', 'agcsDocument')
        $("#gcsModal").modal("show")
        $("#agcsDocument").find("input, select, textarea").prop("disabled", false)
    }

    function copygcs(key) {
        var examselect = examForassessment[key];

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#agcsageday").val(examselect.ageday)
        $("#agcsagemonth").val(examselect.agemonth)
        $("#agcsageyear").val(examselect.ageyear)
        $("#agcsanamnase").val(examselect.anamnase)
        $("#agcsarm_diameter").val(examselect.arm_diameter)
        $("#agcsbed_id").val(examselect.bed_id)
        $("#agcsbody_id").val(bodyId)
        $("#agcsclass_room_id").val(examselect.class_room_id)
        $("#agcsclinic_id").val(examselect.clinic_id)
        $("#agcsdescription").val(examselect.description)
        $("#agcsdoctor").val(examselect.doctor)
        $("#agcsemployee_id").val(examselect.employee_id)
        $("#agcsexamination_date").val(get_date())
        $("#agcsgender").val(examselect.gender)
        $("#agcsheight").val(examselect.height)
        $("#agcsinstruction").val(examselect.instruction)
        $("#agcsisrj").val(examselect.isrj)
        $("#agcskal_id").val(examselect.kal_id)
        $("#agcskeluar_id").val(examselect.keluar_id)
        $("#agcsnadi").val(examselect.nadi)
        $("#agcsnafas").val(examselect.nafas)
        $("#agcsno_registraiton").val(examselect.no_registraiton)
        $("#agcsorg_unit_code").val(examselect.org_unit_code)
        $("#agcspemeriksaan").val(examselect.pemeriksaan)
        $("#agcspetugas").val(examselect.petugas)
        $("#agcssaturasi").val(examselect.saturasi)
        $("#agcsstatus_pasien_id").val(examselect.status_pasien_id)
        $("#agcstemperature").val(examselect.temperature)
        $("#agcstension_below").val(examselect.tension_below)
        $("#agcstension_upper").val(examselect.tension_upper)
        $("#agcsteraphy_desc").val(examselect.teraphy_desc)
        $("#agcstheaddress").val(examselect.theaddress)
        $("#agcstheid").val(examselect.pasien_id)
        $("#agcsthename").val(examselect.diantar_oleh)
        $("#agcsvisit_id").val(examselect.visit_id)
        $("#agcsweight").val(examselect.weight)

        $("#agcsorg_unit_code").val(examselect.org_unit_code)
        $("#agcspasien_diagnosa_id").val(examselect.pasien_diagnosa_id)
        $("#agcsno_registration").val(examselect.no_registration)
        $("#agcsvisit_id").val(examselect.visit_id)
        $("#agcstrans_id").val(examselect.trans_id)
        $("#agcsbill_id").val(examselect.bill_id)
        $("#agcsclass_room_id").val(examselect.class_room_id)
        $("#agcsbed_id").val(examselect.bed_id)
        $("#agcsin_date").val(examselect.in_date)
        $("#agcsexit_date").val(examselect.exit_date)
        $("#agcskeluar_id").val(examselect.keluar_id)
        $("#agcsimt_score").val(examselect.imt_score)
        $("#agcsimt_desc").val(examselect.imt_desc)
        $("#agcspemeriksaan").val(examselect.pemeriksaan)
        $("#agcsmedical_treatment").val(examselect.medical_treatment)
        $("#agcsmodified_date").val(examselect.modified_date)
        $("#agcsmodified_by").val(examselect.modified_by)
        $("#agcsmodified_from").val(examselect.modified_from)
        $("#agcsstatus_pasien_id").val(examselect.status_pasien_id)
        $("#agcsageyear").val(examselect.ageyear)
        $("#agcsagemonth").val(examselect.agemonth)
        $("#agcsageday").val(examselect.ageday)
        $("#agcsthename").val(examselect.thename)
        $("#agcstheaddress").val(examselect.theaddress)
        $("#agcstheid").val(examselect.theid)
        $("#agcsisrj").val(examselect.isrj)
        $("#agcsgender").val(examselect.gender)
        $("#agcsdoctor").val(examselect.doctor)
        $("#agcskal_id").val(examselect.kal_id)
        $("#agcspetugas_id").val(examselect.petugas_id)
        $("#agcspetugas").val(examselect.petugas)
        $("#agcsaccount_id").val(examselect.account_id)
        $("#agcskesadaran").val(examselect.kesadaran)
        $("#agcsisvalid").val(examselect.isvalid)

        $("#agcsanamnase").val(examselect.anamnase)
        $("#agcsdescription").val(examselect.description)
        $("#agcsweight").val(examselect.weight)
        $("#agcsheight").val(examselect.height)
        $("#agcstemperature").val(examselect.temperature)
        $("#agcsnadi").val(examselect.nadi)
        $("#agcstension_upper").val(examselect.tension_upper)
        $("#agcstension_lower").val(examselect.tension_lower)
        $("#agcssaturasi").val(examselect.saturasi)
        $("#agcsnafas").val(examselect.nafas)
        $("#agcsarm_diameter").val(examselect.arm_diameter)
        $("#agcspemeriksaan").val(examselect.pemeriksaan)

        $("#agcsvs_status_id" + examselect.vs_status_id).prop("checked", true)

        $("#gcsModal").modal("show")
        $("#formsaveagcsbtnid").slideDown()
        $("#formeditagcsid").slideUp()
    }
</script>

<script>
    function initialAddagcs() {
        $("#agcsDocument").html("")
        addGcs(1, 0, 'Gcs', 'agcsDocument', true, true)
        $("#gcsModal").modal("show")
        $("#agcsDocument").find("input, select, textarea").prop("disabled", false)
    }
</script>
<script>
    function getGcsAll() {
        // $("#bodyGcs").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getGcs',
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
                $("#gcsBody").html(loadingScreen())
            },
            success: function(data) {
                gcsAll = data.gcs
                $("#gcsBody").html("")
                if (gcsAll.length > 0)
                    $.each(gcsAll, function(key, value) {
                        addRowgcs(value, key)
                    })
                else
                    $("#gcsBody").html(tempTablesNull())
            },
            error: function() {
                $("#gcsBody").html(tempTablesNull())
            }
        });
    }
</script>