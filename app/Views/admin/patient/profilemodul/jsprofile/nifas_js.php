<?php
$laktasi = array_filter($aValue, function ($value) {
    return $value['p_type'] == 'KBDN001' && $value['parameter_id'] == '01';
});
$uterus = array_filter($aValue, function ($value) {
    return $value['p_type'] == 'KBDN001' && $value['parameter_id'] == '02';
});
$lochea = array_filter($aValue, function ($value) {
    return $value['p_type'] == 'KBDN001' && $value['parameter_id'] == '03';
});
?>
<script type='text/javascript'>
    $("#nifasTab").on("click", function() {
        $("#nifasBody").html('')
        getNifasAll()
    })

    var nifasAll
    let laktasiData = <?= json_encode($laktasi); ?>;
    let uterusData = <?= json_encode($uterus); ?>;
    let locheaData = <?= json_encode($lochea); ?>;



    const addRowNifas = (nifasselect, key) => {
        let laktasi = Object.keys(laktasiData).filter(key => laktasiData[key].value_score === nifasselect.lactation).reduce((obj, key) => {
            obj = laktasiData[key];
            return obj;
        }, {});
        let uterus = Object.keys(uterusData).filter(key => uterusData[key].value_score === nifasselect.lactation).reduce((obj, key) => {
            obj = uterusData[key];
            return obj;
        }, {});
        let lochea = Object.keys(locheaData).filter(key => locheaData[key].value_score === nifasselect.lactation).reduce((obj, key) => {
            obj = locheaData[key];
            return obj;
        }, {});
        // let laktasi = laktasiData.filter(item => item.value_score === nifasselect.lactation)
        // let uterus = uterusData.filter(item => item.value_score === nifasselect.uterus)
        // let lochea = locheaData.filter(item => item.value_score === nifasselect.lochea)
        if (nifasselect.valid_user === null) {
            $("#nifasBody").append($("<tr>")
                .append($("<td>").append($("#nifasBody tr").length + 1))
                .append($("<td>").html((String)(nifasselect.examination_date)?.substring(0, 16)))
                .append($("<td>").html(nifasselect.general_con))
                .append($("<td>").html(laktasi.value_desc))
                .append($("<td>").html(uterus.value_desc))
                .append($("<td>").html(lochea.value_desc))
                .append($("<td>").html(nifasselect.complication))
                .append($("<td>").html(nifasselect.modified_by))
                .append($("<td>").html('<button type="button" onclick="editNifas(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
                .append($("<td>").html('<button type="button" onclick="removeNifas(\'' + nifasselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
        } else {
            $("#nifasBody").append($("<tr>")
                .append($("<td>").append($("#nifasBody tr").length + 1))
                .append($("<td>").html((String)(nifasselect.examination_date)?.substring(0, 16)))
                .append($("<td>").html(nifasselect.general_con))
                .append($("<td>").html(laktasi.value_desc))
                .append($("<td>").html(uterus.value_desc))
                .append($("<td>").html(lochea.value_desc))
                .append($("<td>").html(nifasselect.complication))
                .append($("<td>").html(nifasselect.modified_by))
                .append($('<td colspan="2">'))
            )
        }
    }

    painjson.forEach((element, key) => {
        examselect = painjson[key];
        addRowpain(examselect, key)
    });

    const editNifas = (key) => {
        nifasselected = nifasAll[key]
        $.each(nifasselected, function(key, value) {
            $("#anifas" + key).val(value)
        })
        $("#nifasModal").modal("show")
        $("#formNifas").find("input, select, textarea").prop("disabled", false)
    }
    const removeNifas = (body_id) => {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/deleteNifas/' + body_id,
            type: "DELETE",
            // data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                getLoadingGlobalServices('nifasBody')
            },
            success: function(data) {
                $("#nifasBody").html("")
                getNifasAll()
                // addRowNifas(data, 0)
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $("#nifasBody").html("")
            },
            complete: function() {}
        });
    }
</script>

<script>
    const initialAddNifas = () => {
        $("#anifasorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#anifasvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#anifastrans_id").val('<?= $visit['trans_id']; ?>')
        $("#anifasbody_id").val(get_bodyid())
        $("#anifasdocument_id").val('')
        $("#anifasno_registration").val('<?= $visit['no_registration']; ?>')
        $("#anifasp_type").val('KBDN001')
        $("#anifasexamination_date").val(get_date())
        $("#anifasgeneral_con").val(null)
        $("#anifaslactation").val(null)
        $("#anifasuterus").val(null)
        $("#anifaslochea").val(null)
        $("#anifascomplication").val(null)
        $("#anifasvalid_user").val(null)
        $("#anifasvalid_pasien").val(null)
        $("#anifasvalid_date").val(null)
        $("#anifasmodified_by").val('<?= user()->username; ?>')
        $("#nifasModal").modal("show")
        $("#formNifas").find("input, select, textarea").prop("disabled", false)
    }
</script>
<script>
    const fillNifasHistory = (nifasAll) => {
        $.each(nifasAll, function(key, value) {
            addRowNifas(value, key)
        })
    }
</script>
<script>
    function getNifasAll() {
        // $("#bodyPainMonitoring").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getNifasAll',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit.visit_id,
                'nomor': nomor,
                'body_id': ''
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#nifasBody").html(loadingScreen())
            },
            success: function(data) {
                $("#nifasBody").html("")
                nifasAll = data.nifas
                if (data.nifas.length > 0) {
                    $.each(data.nifas, function(key, value) {
                        addRowNifas(value, key)
                    })
                } else {
                    $("#nifasBody").html(tempTablesNull())
                }


            },
            error: function() {
                $("#nifasBody").html(tempTablesNull())
            }
        });
    }
</script>

<script>
    $("#formNifas").on("submit", function(e) {
        e.preventDefault()

        let databody = new FormData(this)
        console.log(databody)
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveNifas',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#nifasModal").modal('hide')
                getLoadingGlobalServices('nifasBody')
            },
            success: function(data) {
                $("#nifasBody").html("")
                // let findNifas = nifasAll.filter(item => item.body_id === data.body_id).reduce((obj, key) => {
                //     return key;
                // }, {});
                // console.log(findNifas)
                // nifasAll[findNifas] = data
                getNifasAll()
                // addRowNifas(data, 0)
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $("#nifasBody").html("")
            },
            complete: function() {}
        });
    })
</script>