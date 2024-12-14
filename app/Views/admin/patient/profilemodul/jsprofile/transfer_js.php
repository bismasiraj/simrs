<!-- Dokumen tindak lanjut -->
<script type='text/javascript'>
    let transfer = <?= json_encode($exam); ?>;
    let exam1 = [];
    let exam2 = [];
    let exam3 = [];
    let transferdesc = []
    let visitTransfer = []
    let clinicDoctors = [];
    var i = 0
    // addRanap('100000') // blm ranap
    // getAkomodasi('202408030835470650684') // sudah ranap
    $("#transferTab").on("click", function() {
        getTindakLanjut()
    })

    const setDataTindakLanjut = (data = null) => {
        $("#formaddatransfer").find("input, textarea").val(null)

        $("#transferDerajatBody").html("")
        // addDerajatStabilitas(1, 0, "atransferbody_id", "transferDerajatBody")

        // $("#transferModal").modal("show")
        $("#contentTindakLanjut").slideUp()
        $("#contentTindakLanjut").slideDown()


        var bodyId = get_bodyid()
        var bodyId1 = get_bodyid()
        var bodyId2 = get_bodyid()
        var bodyId3 = get_bodyid()

        $("#atransferbody_id").val(bodyId)
        $("#atransferorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#atransferno_registration").val('<?= $visit['no_registration']; ?>')
        $("#atransfervisit_id").val('<?= $visit['visit_id']; ?>')
        $("#atransfertrans_id").val('<?= $visit['trans_id']; ?>')
        $("#atransferdocument_id").val(bodyId1)
        $("#atransferdocument_id2").val(bodyId2)
        $("#atransferdocument_id3").val(bodyId3)
        $("#atransferexamination_date").val(get_date())
        <?php if ($visit['isrj'] == '0') {
        ?>
            $("#atransferemployee_id").val('<?= $visit['employee_inap']; ?>')
        <?php
        } else {
        ?>
            $("#atransferemployee_id").val('<?= $visit['employee_id']; ?>')
        <?php
        } ?>

        $("#atransferisinternal_group").prop("readonly", false)
        $("#atransferisinternal").val(1).trigger("change")

        flatpickrInstances["flatatransferexamination_date"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );
        $("#flatatransferexamination_date").trigger("change");
        getClinicDoctors()
        enableTindakLanjut()
    }

    const getClinicDoctors = () => {
        postData({

        }, 'admin/patient/getClinicDoctors', res => {
            clinicDoctors = res
        });
    }
    const setPoliTindakLanjut = (dokter) => {
        let clinic_id = clinicDoctors.filter(item => item.employee_id == dokter)
        console.log(dokter)
        console.log(clinic_id)
        $("#sprikdpoli").val(clinic_id[0].clinic_id)
    }

    const getFollowUpName = (isinternal) => {
        <?php foreach ($followup as $key => $value) {
        ?>
            if (isinternal == <?= $value['follow_up']; ?>) {
                return '<?= $value['followup']; ?>';
            }
        <?php
        } ?>
    }

    const editDataTindakLanjut = async (key) => {
        $("#formaddatransfer").find("input, textarea").val(null)
        $("#atransferisinternal_group").prop("readonly", true)
        var transferselect = transfer[key];
        $.each(transferselect, function(keyt, valuet) {
            $("#atransfer" + keyt).val(valuet)
        })
        $("#atransferisinternal").trigger("change")
        $("#flatatransferexamination_date").val(formatedDatetimeFlat(transferselect.examination_date)).trigger("change")
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)
        $("#contentTindakLanjut").slideDown()
        await checkSignSignature("formaddatransfer", "atransferbody_id", "formsaveatransferbtnid")

        if ($("#atransfervalid_user").val() != '' && $("#atransfervalid_user").val() != null) {
            $("#formsaveatransferbtnid").slideUp()
            $("#formeditatransferid").slideUp()
            $("#formsignatransferid").slideUp()
            $("#formaddatransfer").find("input, select, textarea").prop("disabled", true)
        } else {
            $("#formsaveatransferbtnid").slideUp()
            $("#formeditatransferid").slideDown()
            $("#formsignatransferid").slideDown()
            $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)
        }
    }

    const openTindakLanjutModal = async () => {
        let isinternal = $("#atransferisinternal").val();

        $("#formopenmodaltransferid").html('<i class="spinner-border spinner-border-sm"></i>')

        $("#formakomodasiatransferid").slideUp()

        $("#atransferclinic_id_group").slideUp()
        $("#atransferclinic_id_to_group").slideUp()
        $("#atransferstabilitas").slideUp()
        $("#atransferinternal").slideUp()
        $("#atransferrujukaninternalgroup").hide()
        $("#atransferrujukaninternalgroup").find("input, select, textarea").val(null)
        $("#atransferrujukaneksternalgroups").hide()
        $("#atransferrujukaneksternalgroups").find("input, select, textarea").val(null)
        $("#atransfersprigroup").hide()
        $("#atransfersprigroup").find("input, select, textarea").val(null)
        $("#atransferskdpgroup").hide()
        $("#atransferskdpgroup").find("input, select, textarea").val(null)
        $("#atransfertransferinternalgroup").hide()
        $("#atransfertransferinternalgroup").find("input, select, textarea").val(null)
        if (isinternal == 10) {
            $("#atransferservice_needs_group").slideUp()
            $("#atransferclinic_id_group").slideDown()
            $("#atransferclinic_id_to_group").slideDown()
            $("#atransferstabilitas").slideDown()
            $("#atransferinternal").slideDown()
            setDatatransfer($("#atransferdocument_id").val(), $("#atransferdocument_id3").val())
        } else if (isinternal == 3) {
            let visitselected = {};
            $.each(visitTransfer, function(key, value) {
                if (value.visit_id == $("#atransferdocument_id").val()) {
                    visitselected = value
                }
            })
            $("#atransferservice_needs_group").slideUp()
            await setDataRujukInternal(visitselected)
        } else if (isinternal == 2) {
            $("#atransferservice_needs_group").slideUp()
            await setDataRujukEksternal()
            setDataCpptEksternal($("#atransferdocument_id").val(), $("#atransferdocument_id2").val(), $("#atransferdocument_id3").val())
            $("#atransferinternal").slideDown()
        } else if (isinternal == 4) {
            $("#atransferservice_needs_group").slideUp()
            $("#atransferinternal").slideDown()
            await setDataSkdp()
        } else if (isinternal == 5) {
            $("#atransferservice_needs_group").slideDown()
            await setDataSpri()
        } else {
            $("#atransferservice_needs_group").slideUp()
        }
        $("#formopenmodaltransferid").html('<i class="fa fa-plus"></i> <span>Detail</span>')
    }

    const disableTindakLanjut = () => {
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", true)
        $("#atransferisinternal_group").prop("readonly", true)

        $("#formtransfersubmit").slideUp()
        $("#formtransferedit").slideDown()
        if ($("#atransfervalid_user").val() != '' && $("#atransfervalid_user").val() != null) {
            $("#formsaveatransferbtnid").slideUp()
            $("#formeditatransferid").slideUp()
            $("#formsignatransferid").slideUp()
            $("#formaddatransfer").find("input, select, textarea").prop("disabled", true)
        } else {
            $("#formsaveatransferbtnid").slideUp()
            $("#formeditatransferid").slideDown()
            $("#formsignatransferid").slideDown()
            $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)
        }
    }

    const enableTindakLanjut = () => {
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)


        $("#formsaveatransferbtnid").slideDown()
        $("#formeditatransferid").slideUp()
        $("#formsignatransferid").slideUp()
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)
    }

    const signTindakLanjut = () => {
        //addSignUserSatelite = (formId, container, body_id, primaryKey, buttonId, docs_type, user_type, sign_ke = 1,title)
        addSignUser("formaddatransfer", "atransfer", "atransferbody_id", "formsaveatransferbtnid", 7, 1, 1, $("#atransferisinternal option:selected").text())
    }
    //ini untuk save tindak lanjut
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
                clicked_submit_btn.html('loading');
            },
            success: function(data) {
                successSwal("Data berhasil disimpan")
                let isNewDocument = 0
                $.each(transfer, function(key, value) {
                    if (value.body_id == data.body_id) {
                        transfer[key] = data
                        isNewDocument = 1
                    }
                })
                if (isNewDocument != 1)
                    transfer.push(data)
                $("#transferBodyHistory").html("")
                transfer.forEach((element, key) => {
                    addRowHistoryTL(transfer[key], key)
                });
                // if (data.status == "fail") {
                //     var message = "";
                //     $.each(data.error, function(index, value) {
                //         message += value;
                //     });
                //     errorSwal(message);
                // } else {
                //     successSwal(data.message);
                // }
                disableTindakLanjut()
                clicked_submit_btn.html("save");
            },
            error: function(xhr) { // if error occured
                errorSwal("Error occured.please try again");
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            complete: function() {
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            }
        });
        let isinternal = $("#atransferisinternal").val()
        if (isinternal == 10) {

            $("#atransferinternal").slideDown()
            $("#atransferstabilitas").slideDown()
            saveCpptTransfer()
        }
        if (isinternal == 3) {
            postRujukInternal()
        }
        if (isinternal == 2) {
            postRujukan()
            saveCpptTransfer()
        }
        if (isinternal == 4) {
            saveSkdp()
        }
        if (isinternal == 5) {
            saveSpri()
        }

    }));
    //ini untuk edit tindak lanjut
    $("#formeditatransferid").on("click", function() {
        $("#formaddatransfer").find("input, textarea, select").prop("disabled", false)
    })

    const getTindakLanjut = () => {
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
            beforeSend: () => {
                $("#contentTindakLanjut").slideUp()
                $("#transferBodyHistory").html(loadingScreen())
            },
            success: function(data) {
                $("#transferBodyHistory").html(tempTablesNull())
                transfer = data.transfer
                examForassessment = data.examinfo
                examForassessmentDetail = data.examDetail
                visitTransfer = data.visit

                $("#transferBodyHistory").html("")
                transfer.forEach((element, key) => {
                    addRowHistoryTL(transfer[key], key)
                });
            },
            error: function() {
                $("#transferBodyHistory").html(tempTablesNull())
            }
        });
    }

    const hideTransfer = () => {
        $("#contentTindakLanjut").slideUp();
    }
</script>

<!-- History Tindak Lanjut -->
<script>
    //ini untuk 
    const addRowHistoryTL = (examselect, key) => {

        console.log(examselect)
        let isinternal = examselect.isinternal

        let employee = <?= json_encode($employee); ?>;

        if (isinternal == 10) {
            $.each(examForassessmentDetail, function(key, value) {
                if (value.body_id == examselect.document_id) {
                    console.log('masuk1')
                    console.log(value.body_id)
                    exam1 = value
                } else if (value.body_id == examselect.document_id2) {
                    console.log('masuk2')
                    console.log(value.body_id)
                    exam2 = value
                } else if (value.body_id == examselect.document_id3) {
                    console.log('masuk3')
                    console.log(value.body_id)
                    exam3 = value
                }
            })
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td rowspan='3'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td rowspan='3'>").html(examselect.petugas))
                .append($("<td rowspan='3'>").html(getFollowUpName(examselect.isinternal)))
                .append($("<td>").html('<b>Departemen</b>'))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='3'>").html('<div class="btn-group-vertical">' +
                    '<button type="button" onclick="copytransfer(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editDataTindakLanjut(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>' +
                    '<button type="button" onclick="cetakCpptTransfer(' + key + ')" class="btn btn-light" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Cetak</i></button>' +
                    '</div>'))
                .append($("<td rowspan='3'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
            if (Object.keys(exam1).length > 0)
                $("#transferBodyHistory")
                .append($("<tr>")
                    .append($("<td>").html(exam1?.name_of_clinic))
                    .append($("<td>").html(exam1?.tension_upper + '/' + exam1?.tension_below + 'mmHg'))
                    .append($("<td>").html(exam1?.nadi + '/menit'))
                    .append($("<td>").html(exam1?.nafas + '/menit'))
                    .append($("<td>").html(exam1?.temperature + '/°C'))
                    .append($("<td>").html(exam1?.saturasi + '/SpO2%'))
                )
            else
                $("#transferBodyHistory")
                .append($("<tr>")
                    .append($("<td colspan=\"6\">").html("-"))
                )
            // if (Object.keys(exam2).length > 0)
            //     $("#transferBodyHistory")
            //     .append($("<tr>")
            //         .append($("<td>").html(exam2?.name_of_clinic))
            //         .append($("<td>").html(exam2?.tension_upper + '/' + exam2?.tension_below + 'mmHg'))
            //         .append($("<td>").html(exam2?.nadi + '/menit'))
            //         .append($("<td>").html(exam2?.nafas + '/menit'))
            //         .append($("<td>").html(exam2?.temperature + '/°C'))
            //         .append($("<td>").html(exam2?.saturasi + '/SpO2%'))
            //     )
            // else
            //     $("#transferBodyHistory")
            //     .append($("<tr>")
            //         .append($("<td colspan=\"6\">").html("-"))
            //     )
            if (Object.keys(exam3).length > 0)
                $("#transferBodyHistory")
                .append($("<tr>")
                    .append($("<td>").html(exam3?.name_of_clinic))
                    .append($("<td>").html(exam3?.tension_upper + '/' + exam3?.tension_below + 'mmHg'))
                    .append($("<td>").html(exam3?.nadi + '/menit'))
                    .append($("<td>").html(exam3?.nafas + '/menit'))
                    .append($("<td>").html(exam3?.temperature + '/°C'))
                    .append($("<td>").html(exam3?.saturasi + '/SpO2%'))
                )
            else
                $("#transferBodyHistory")
                .append($("<tr>")
                    .append($("<td colspan=\"6\">").html("-"))
                )
        } else if (isinternal == 3) {
            let visitselected = {};
            $.each(visitTransfer, function(key, value) {
                if (value.visit_id == examselect.document_id) {
                    visitselected = value
                }
            })
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td>").append(formatedDatetimeFlat(examselect?.examination_date)))
                .append($("<td>").html(examselect?.petugas))
                .append($("<td>").html(getFollowUpName(examselect?.isinternal)))
                .append($("<td colspan=\"2\">").html(visitselected?.visit_id))
                .append($("<td colspan=\"2\">").html(visitselected?.name_of_clinic))
                .append($("<td colspan=\"2\">").html(visitselected?.fullname))
                // .append($("<td>").html('<b>Nafas/RR</b>'))
                // .append($("<td>").html('<b>Temp</b>'))
                // .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td>").html('<div class="btn-group-vertical">' +
                    '<button type="button" onclick="copytransfer(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editDataTindakLanjut(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>' +
                    '<button type="button" onclick="cetakCpptTransfer(' + key + ')" class="btn btn-light" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Cetak</i></button>' +
                    '</div>'))
                .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
        } else if (isinternal == 2) {
            $.each(examForassessmentDetail, function(key, value) {
                if (value.body_id == examselect.document_id) {
                    console.log('masuk1')
                    console.log(value.body_id)
                    exam1 = value
                } else if (value.body_id == examselect.document_id2) {
                    console.log('masuk2')
                    console.log(value.body_id)
                    exam2 = value
                } else if (value.body_id == examselect.document_id3) {
                    console.log('masuk3')
                    console.log(value.body_id)
                    exam3 = value
                }
            })
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td rowspan='4'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td rowspan='4'>").html(examselect.petugas))
                .append($("<td rowspan='4'>").html(getFollowUpName(examselect.isinternal)))
                .append($("<td>").html('<b>Departemen</b>'))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='4'>").html('<div class="btn-group-vertical">' +
                    '<button type="button" onclick="copytransfer(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editDataTindakLanjut(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>' +
                    '<button type="button" onclick="cetakCpptTransfer(' + key + ')" class="btn btn-light" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Cetak</i></button>' +
                    '</div>'))
                .append($("<td rowspan='4'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
            if (Object.keys(exam1).length > 0)
                $("#transferBodyHistory")
                .append($("<tr>")
                    .append($("<td>").html(exam1?.name_of_clinic))
                    .append($("<td>").html(exam1?.tension_upper + '/' + exam1?.tension_below + 'mmHg'))
                    .append($("<td>").html(exam1?.nadi + '/menit'))
                    .append($("<td>").html(exam1?.nafas + '/menit'))
                    .append($("<td>").html(exam1?.temperature + '/°C'))
                    .append($("<td>").html(exam1?.saturasi + '/SpO2%'))
                )
            else
                $("#transferBodyHistory")
                .append($("<tr>")
                    .append($("<td colspan=\"6\">").html("-"))
                )
            if (Object.keys(exam2).length > 0)
                $("#transferBodyHistory")
                .append($("<tr>")
                    .append($("<td>").html(exam2?.name_of_clinic))
                    .append($("<td>").html(exam2?.tension_upper + '/' + exam2?.tension_below + 'mmHg'))
                    .append($("<td>").html(exam2?.nadi + '/menit'))
                    .append($("<td>").html(exam2?.nafas + '/menit'))
                    .append($("<td>").html(exam2?.temperature + '/°C'))
                    .append($("<td>").html(exam2?.saturasi + '/SpO2%'))
                )
            else
                $("#transferBodyHistory")
                .append($("<tr>")
                    .append($("<td colspan=\"6\">").html("-"))
                )
            if (Object.keys(exam3).length > 0)
                $("#transferBodyHistory")
                .append($("<tr>")
                    .append($("<td>").html(exam3?.name_of_clinic))
                    .append($("<td>").html(exam3?.tension_upper + '/' + exam3?.tension_below + 'mmHg'))
                    .append($("<td>").html(exam3?.nadi + '/menit'))
                    .append($("<td>").html(exam3?.nafas + '/menit'))
                    .append($("<td>").html(exam3?.temperature + '/°C'))
                    .append($("<td>").html(exam3?.saturasi + '/SpO2%'))
                )
            else
                $("#transferBodyHistory")
                .append($("<tr>")
                    .append($("<td colspan=\"6\">").html("-"))
                )
        } else if (isinternal == 4) {
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td>").append(formatedDatetimeFlat(examselect.examination_date)))
                .append($("<td>").html(examselect.petugas))
                .append($("<td>").html(getFollowUpName(examselect.isinternal)))
                .append($("<td colspan=\"2\">").html(examselect.isinternal))
                .append($("<td colspan=\"2\">").html(examselect.isinternal))
                .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td>").html('<b>Nafas/RR</b>'))
                // .append($("<td>").html('<b>Temp</b>'))
                // .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td>").html('<div class="btn-group-vertical">' +
                    '<button type="button" onclick="copytransfer(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editDataTindakLanjut(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>' +
                    '<button type="button" onclick="cetakCpptTransfer(' + key + ')" class="btn btn-light" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Cetak</i></button>' +
                    '</div>'))
                .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
        } else if (isinternal == 5) {
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td>").append(formatedDatetimeFlat(examselect.examination_date)))
                .append($("<td>").html(examselect.petugas))
                .append($("<td>").html(getFollowUpName(examselect.isinternal)))
                .append($("<td colspan=\"2\">").html(examselect.isinternal))
                .append($("<td colspan=\"2\">").html(examselect.isinternal))
                .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td>").html('<b>Nafas/RR</b>'))
                // .append($("<td>").html('<b>Temp</b>'))
                // .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td>").html('<div class="btn-group-vertical">' +
                    '<button type="button" onclick="copytransfer(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editDataTindakLanjut(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>' +
                    '<button type="button" onclick="cetakCpptTransfer(' + key + ')" class="btn btn-light" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Cetak</i></button>' +
                    '</div>'))
                .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
        }
    }
</script>

<!-- TRANSFER INTERNAL -->
<script>
    const setDatatransfer = (bodyId1, bodyId3) => {
        $("#formakomodasiatransferid").slideDown()
        $("#formaddatransfer1").find("input, textarea").val(null)
        var initialcppt = examForassessment[examForassessment.length - 1]
        var initialexam = examForassessmentDetail[examForassessmentDetail.length - 1]
        let exam = [];

        let isnew = false;



        // buat cek dokumen cppt ada yang induknya si transfer enggak
        $.each(examForassessment, function(key, value) {
            if (value.body_id == bodyId1) {
                exam = value
            }
        })

        if (typeof(exam.body_id) !== 'undefined') {
            isnew = false
            $.each(exam, function(keyt, value) {
                $("#atransfer1" + keyt).val(value)
                $("#atransfer1" + keyt).prop("disabled", false)
            })
            $("#atransfer1collapseVitalSign").find("input, select").trigger("change")
        } else {
            isnew = true
            $.each(initialexam, function(key, value) {
                $("#atransfer1" + key).val(value)
            })

            $.each(initialexam, function(key, value) {
                $("#atransfer3" + key).val(value)
            })

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
            $("#atransfer1vs_status_id").val(1)
            $("#atransfer1account_id").val(3)
            $("#acpptpetugas_type").val('<?= user()->getOneRoles(); ?>')
        }


        if (!isnew) {
            $.each(examForassessmentDetail, function(key, value) {
                if (value.body_id == bodyId1) {
                    exam1 = value
                    console.log('exam1')
                }
                // else if (value.body_id == bodyId2) {
                //     exam2 = value
                // } 
                else if (value.body_id == bodyId3) {
                    exam3 = value
                    console.log('exam3')
                }
            })
            if (typeof(exam1.body_id) !== 'undefined') {
                $.each(exam1, function(keyt, value) {
                    $("#atransfer1" + keyt).val(value)
                    $("#atransfer1" + keyt).prop("disabled", false)
                })
                $("#atransfer1collapseVitalSign").find("input, select").trigger("change")
            }

            if (typeof(exam3.body_id) !== 'undefined') {
                $.each(exam3, function(keyt, value) {
                    $("#atransfer3" + keyt).val(value)
                    $("#atransfer3" + keyt).prop("disabled", false)
                })
                $("#atransfer3collapseVitalSign").find("input, select").trigger("change")
            }
        }



        $("#atransfer1body_id").val(bodyId1)
        $("#atransfer3body_id").val(bodyId3)


        $("#atransfer2VitalSign").hide()


        getStabilitas($("#atransferbody_id").val(), "transferDerajatBody")


        // $("#atransfertransferinternalgroup").slideDown()

        enableTindakLanjut()
    }

    const copytransfer = (key) => {
        var examselect = transfer[key];

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#atransferageday").val(examselect.ageday)
        $("#atransferagemonth").val(examselect.agemonth)
        $("#atransferageyear").val(examselect.ageyear)
        $("#atransferanamnase").val(examselect.anamnase)
        $("#atransferatransfer_diameter").val(examselect.atransfer_diameter)
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
        $("#atransferatransfer_diameter").val(examselect.atransfer_diameter)
        $("#atransferpemeriksaan").val(examselect.pemeriksaan)

        $("#atransfervs_status_id").val(examselect.vs_status_id)

        // $("#cpptModal").modal("show")
        // $("#formsaveatransferbtnid").slideDown()
        // $("#formeditatransferid").slideUp()
    }

    const editCpptTransfer = (key) => {

        var transferselect = transfer[key];

        $.each(examForassessment, function(key, value) {
            if (value.body_id == transferselect.document_id) {
                exam1 = value
            } else if (value.body_id == transferselect.document_id2) {
                exam2 = value
            }
        })
        if (typeof(exam1.body_id) !== 'undefined') {
            $.each(exam1, function(keyt, value) {
                // if (keyt == 'employee_id') {
                //     $("#atransfer1employee_id").val(value)
                // }
                $("#atransfer1" + keyt).val(value)
                $("#atransfer1" + keyt).prop("disabled", false)
            })
            $("#atransfer1collapseVitalSign").find("input, select").trigger("change")
        }
        if (typeof(exam2.body_id) !== 'undefined') {
            $.each(exam2, function(keyt, value) {
                // if (keyt == 'employee_id') {
                //     $("#atransfer2employee_id").val(value)
                // }
                $("#atransfer2" + keyt).val(value)
                $("#atransfer2" + keyt).prop("disabled", false)
            })
            $("#atransfer2collapseVitalSign").find("input, select").trigger("change")
        }
        if (typeof(transferselect.document_id1) !== 'undefined')
            $("#atransferbody_id1").val(transferselect.document_id1)
        if (typeof(transferselect.document_id2) !== 'undefined')
            $("#atransferbody_id2").val(transferselect.document_id2)
        if (typeof(transferselect.document_id2) !== 'undefined')
            $("#atransferbody_id3").val(transferselect.document_id3)

        getStabilitas($("#atransferbody_id").val(), "transferDerajatBody")
        // addDerajatStabilitas(1, 0, "atransferbody_id", "transferDerajatBody")

        $("#atransferDocument").find("input, select, textarea").prop("disabled", false)
        enableTindakLanjut()
        enableTindakLanjut1()
        enableTindakLanjut2()

        // $("#transferModal").modal('show')
        $("#contentTindakLanjut").slideDown()
    }

    const openModalTransfser = (isinternal = 0) => {
        $("#transferModal").modal('show')
    }

    const cetakCpptTransfer = (key) => {
        var transferselect = transfer[key];

        var win = window.open('<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>' + '/' + transferselect.body_id, '_blank');

    }

    const saveCpptTransfer = () => {
        console.log($("#atransfer1anamnase").val())
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveTransferInternal',
            type: "POST",
            data: JSON.stringify({
                "body_id": $("#atransfer1body_id").val(),
                "org_unit_code": $("#atransfer1org_unit_code").val(),
                "pasien_diagnosa_id": $("#atransfer1pasien_diagnosa_id").val(),
                "diagnosa_id": $("#atransfer1diagnosa_id").val(),
                "no_registration": $("#atransfer1no_registration").val(),
                "visit_id": $("#atransfer1visit_id").val(),
                "bill_id": $("#atransfer1bill_id").val(),
                "clinic_id": $("#atransferclinic_id").val(),
                "class_room_id": $("#atransfer1class_room_id").val(),
                "bed_id": $("#atransfer1bed_id").val(),
                "in_date": $("#atransfer1in_date").val(),
                "exit_date": $("#atransfer1exit_date").val(),
                "keluar_id": $("#atransfer1keluar_id").val(),
                "examination_date": $("#atransferexamination_date").val(),
                "anamnase": $("#atransfer1anamnase").val(),
                "alo_anamnase": $("#atransfer1alo_anamnase").val(),
                "pemeriksaan": $("#atransfer1pemeriksaan").val(),
                "teraphy_desc": $("#atransfer1teraphy_desc").val(),
                "instruction": $("#atransfer1instruction").val(),
                "medical_treatment": $("#atransfer1medical_treatment").val(),
                "employee_id": $("#atransferemployee_id").val(),
                "description": $("#atransfer1description").val(),
                "modified_date": $("#atransfer1modified_date").val(),
                "modified_by": $("#atransfer1modified_by").val(),
                "modified_from": $("#atransfer1modified_from").val(),
                "status_pasien_id": $("#atransfer1status_pasien_id").val(),
                "ageyear": $("#atransfer1ageyear").val(),
                "agemonth": $("#atransfer1agemonth").val(),
                "ageday": $("#atransfer1ageday").val(),
                "thename": $("#atransfer1thename").val(),
                "theaddress": $("#atransfer1theaddress").val(),
                "theid": $("#atransfer1theid").val(),
                "isrj": $("#atransfer1isrj").val(),
                "gender": $("#atransfer1gender").val(),
                "doctor": $("#atransfer1doctor").val(),
                "kal_id": $("#atransfer1kal_id").val(),
                "petugas_id": $("#atransfer1petugas_id").val(),
                "petugas": $("#atransfer1petugas").val(),
                "account_id": $("#atransfer1account_id").val(),
                "isvalid": $("#atransfer1isvalid").val(),
                "vs_status_id": $("#atransfer1vs_status_id").val(),
                "valid_date": $("#atransfer1valid_date").val(),
                "valid_user": $("#atransfer1valid_user").val(),
                "valid_pasien": $("#atransfer1valid_pasien").val(),
                "petugas_type": $("#atransfer1petugas_type").val(),

                "body_id1": $("#atransfer1body_id").val(),
                "temperature1": $("#atransfer1temperature").val(),
                "tension_upper1": $("#atransfer1tension_upper").val(),
                "tension_below1": $("#atransfer1tension_below").val(),
                "nadi1": $("#atransfer1nadi").val(),
                "nafas1": $("#atransfer1nafas").val(),
                "weight1": $("#atransfer1weight").val(),
                "height1": $("#atransfer1height").val(),
                "imt_score1": $("#atransfer1imt_score").val(),
                "imt_desc1": $("#atransfer1imt_desc").val(),
                "saturasi1": $("#atransfer1saturasi").val(),
                "arm_diameter1": $("#atransfer1arm_diameter").val(),
                "oxygen_usage1": $("#atransfer1oxygen_usage").val(),
                "oxygen_usage_score1": $("#atransfer1oxygen_usage_score").val(),
                "temperature_score1": $("#atransfer1temperature_score").val(),
                "tension_upper_score1": $("#atransfer1tension_upper_score").val(),
                "tension_below_score1": $("#atransfer1tension_below_score").val(),
                "nadi_score1": $("#atransfer1nadi_score").val(),
                "nafas_score1": $("#atransfer1nafas_score").val(),
                "saturasi_score1": $("#atransfer1saturasi_score").val(),
                "awareness1": $("#atransfer1awareness").val(),
                "pain1": $("#atransfer1pain").val(),
                "lochia1": $("#atransfer1lochia").val(),
                "general_condition1": $("#atransfer1general_condition").val(),
                "cardiovasculer1": $("#atransfer1cardiovasculer").val(),
                "respiration1": $("#atransfer1respiration").val(),
                "proteinuria1": $("#atransfer1proteinuria").val(),

                "body_id2": $("#atransfer2body_id").val(),
                "temperature2": $("#atransfer2temperature").val(),
                "tension_upper2": $("#atransfer2tension_upper").val(),
                "tension_below2": $("#atransfer2tension_below").val(),
                "nadi2": $("#atransfer2nadi").val(),
                "nafas2": $("#atransfer2nafas").val(),
                "weight2": $("#atransfer2weight").val(),
                "height2": $("#atransfer2height").val(),
                "imt_score2": $("#atransfer2imt_score").val(),
                "imt_desc2": $("#atransfer2imt_desc").val(),
                "saturasi2": $("#atransfer2saturasi").val(),
                "arm_diameter2": $("#atransfer2arm_diameter").val(),
                "oxygen_usage2": $("#atransfer2oxygen_usage").val(),
                "oxygen_usage_score2": $("#atransfer2oxygen_usage_score").val(),
                "temperature_score2": $("#atransfer2temperature_score").val(),
                "tension_upper_score2": $("#atransfer2tension_upper_score").val(),
                "tension_below_score2": $("#atransfer2tension_below_score").val(),
                "nadi_score2": $("#atransfer2nadi_score").val(),
                "nafas_score2": $("#atransfer2nafas_score").val(),
                "saturasi_score2": $("#atransfer2saturasi_score").val(),
                "awareness2": $("#atransfer2awareness").val(),
                "pain2": $("#atransfer2pain").val(),
                "lochia2": $("#atransfer2lochia").val(),
                "general_condition2": $("#atransfer2general_condition").val(),
                "cardiovasculer2": $("#atransfer2cardiovasculer").val(),
                "respiration2": $("#atransfer2respiration").val(),
                "proteinuria2": $("#atransfer2proteinuria").val(),

                "body_id3": $("#atransfer3body_id").val(),
                "temperature3": $("#atransfer3temperature").val(),
                "tension_upper3": $("#atransfer3tension_upper").val(),
                "tension_below3": $("#atransfer3tension_below").val(),
                "nadi3": $("#atransfer3nadi").val(),
                "nafas3": $("#atransfer3nafas").val(),
                "weight3": $("#atransfer3weight").val(),
                "height3": $("#atransfer3height").val(),
                "imt_score3": $("#atransfer3imt_score").val(),
                "imt_desc3": $("#atransfer3imt_desc").val(),
                "saturasi3": $("#atransfer3saturasi").val(),
                "arm_diameter3": $("#atransfer3arm_diameter").val(),
                "oxygen_usage3": $("#atransfer3oxygen_usage").val(),
                "oxygen_usage_score3": $("#atransfer3oxygen_usage_score").val(),
                "temperature_score3": $("#atransfer3temperature_score").val(),
                "tension_upper_score3": $("#atransfer3tension_upper_score").val(),
                "tension_below_score3": $("#atransfer3tension_below_score").val(),
                "nadi_score3": $("#atransfer3nadi_score").val(),
                "nafas_score3": $("#atransfer3nafas_score").val(),
                "saturasi_score3": $("#atransfer3saturasi_score").val(),
                "awareness3": $("#atransfer3awareness").val(),
                "pain3": $("#atransfer3pain").val(),
                "lochia3": $("#atransfer3lochia").val(),
                "general_condition3": $("#atransfer3general_condition").val(),
                "cardiovasculer3": $("#atransfer3cardiovasculer").val(),
                "respiration3": $("#atransfer3respiration").val(),
                "proteinuria3": $("#atransfer3proteinuria").val(),
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                successSwal("Data berhasil disimpan")
                // let isNewDocument = 0
                // $.each(transfer, function(key, value) {
                //     if (value.body_id == data.body_id) {
                //         transfer[key] = data
                //         isNewDocument = 1
                //     }
                // })
                // if (isNewDocument != 1)
                //     transfer.push(data)
                // $("#transferBodyHistory").html("")
                // transfer.forEach((element, key) => {
                //     addRowHistoryTL(transfer[key], key)
                // });
                // if (data.status == "fail") {
                //     var message = "";
                //     $.each(data.error, function(index, value) {
                //         message += value;
                //     });
                //     errorSwal(message);
                // } else {
                //     successSwal(data.message);
                // }
                disableTindakLanjut()
            },
            error: function(xhr) { // if error occured
                errorSwal("Error occured.please try again");
            },
            complete: function() {}
        });
    }
</script>


<!-- CPPT Awal -->
<script>
    const disableTindakLanjut1 = () => {
        $("#formaddatransfer1").find("input, select, textarea").prop("disabled", true)

        $("#formsaveatransfer1btnid").slideUp()
        $("#formeditatransfer1id").slideDown()
    }

    const enableTindakLanjut1 = () => {
        $("#formaddatransfer1").find("input, select, textarea").prop("disabled", false)

        $("#formsaveatransfer1btnid").slideDown()
        $("#formeditatransfer1id").slideUp()
    }


    $("#formeditatransfer1id").on("click", function() {
        $("#formaddatransfer1").find("input, textarea, select").prop("disabled", false)
        $("#formsaveatransfer1btnid").slideDown()
        $("#formeditatransfer1id").slideUp()
    })
    $("#atransfer1vs_status_id").on("change", function() {
        changeEwsParam("vitalSignTransfer1")
    })
</script>
<!-- CPPT Terakhir -->
<script>
    const disableTindakLanjut2 = () => {
        $("#formaddatransfer2").find("input, select, textarea").prop("disabled", true)

        $("#formsaveatransfer2btnid").slideUp()
        $("#formeditatransfer2id").slideDown()
    }

    const enableTindakLanjut2 = () => {
        $("#formaddatransfer2").find("input, select, textarea").prop("disabled", false)

        $("#formsaveatransfer2btnid").slideDown()
        $("#formeditatransfer2id").slideUp()
    }


    $("#formeditatransfer2id").on("click", function() {
        $("#formaddatransfer2").find("input, textarea, select").prop("disabled", false)
        $("#formsaveatransfer2btnid").slideDown()
        $("#formeditatransfer2id").slideUp()
    })
    $("#atransfer2vs_status_id").on("change", function() {
        changeEwsParam("vitalSignTransfer1")
    })
</script>


<!-- KONSUL INTERNAL -->
<script>
    const setDataRujukInternal = async (data = null) => {
        $("#rujintvisitdate").val(get_date())
        $("#rujintclinicid").val(null)
        $("#rujintemployeeid").val(null)
        flatpickrInstances["flatrujintvisitdate"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );

        if (data) {
            $("#rujintvisitdate").val(data.visit_date)
            $("#rujintclinicid").val(data.clinic_id)
            $("#rujintemployeeid").val(data.employee_id)
        }
        $("#atransferrujukaninternalgroup").slideDown()
        $("#flatrujintvisitdate").trigger("change");

    }

    function postRujukInternal() {
        var visitJson = JSON.parse('<?= json_encode($visit); ?>');
        visitJson.visit_id = $("#atransferdocument_id").val()
        visitJson.clinic_id = $("#rujintclinicid").val()
        visitJson.visit_date = $("#rujintvisitdate").val()
        visitJson.booked_date = $("#rujintvisitdate").val()
        visitJson.employee_id = $("#rujintemployeeid").val()
        visitJson.clinic_id_from = '<?= $visit['clinic_id']; ?>'
        visitJson.employee_id_from = '<?= $visit['employee_id']; ?>'
        visitJson.way_id = '19'
        visitJson.isnew = '0'
        visitJson.class_room_id = null
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/addvisit',
            type: "POST",
            data: visitJson,
            dataType: 'json',
            success: function(data) {
                $("#rujukInternalModal").modal("hide")
                successSwal("Simpan rujukan internal berhasil")
            }
        })
    }

    const getRujukInternal = (visitIdKonsul) => {
        postData({
            visitIdKonsul: pasienDiagnosaId
        }, 'admin/PatientOperationRequest/getExaminationData', (res) => {
            if (res?.respon === false) {
                // Jika data tidak ditemukan, gunakan newBodyId
                $(`#avtbody_id${suffix}`).val(newBodyId);
            } else {
                const data = res?.data[0];

                // Tentukan body_id untuk elemen
                const bodyIdFromData = data?.body_id === pasienDiagnosaId ? data?.body_id : newBodyId;

                // Perbarui nilai elemen HTML sesuai suffix
                $(`#avtbody_id${suffix}`).val(bodyIdFromData);

                // Render data jika body_id valid
                renderDataVitailSign(data);
            }
        });
    }

    $("#rujintclinicid").on("click", function() {
        $("#rujintemployeeid").html("");
        var clinicSelected = $("#rujintclinicid").val();
        // dokterdpjp.forEach((value, key) => {
        //     if (value[0] == clinicSelected) {
        //         $("#rujintemployeeid").append(new Option(value[2], value[1]));
        //     }
        // })
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getdokterrujukan',
            type: "POST",
            data: {
                clinicSelected: clinicSelected,
                rujintvisitdate: $("#rujintvisitdate").val(),
            },
            dataType: 'json',
            success: function(data) {
                $("#rujintemployeeid").html("")
                data.forEach((element, key) => {
                    $("#rujintemployeeid").append(new Option(element.fullname, element.employee_id));
                })
            }
        })
    });
</script>

<!-- SKDP -->
<script>
    const setDataSkdp = async (data = null) => {
        <?php if ($visit['isrj'] == 0) {
        ?>
            $("#skdpnosep").val('<?= $visit['no_skpinap']; ?>')
        <?php
        } else {
        ?>
            $("#skdpnosep").val('<?= $visit['no_skp']; ?>')
        <?php
        } ?>


        $("#skdpkddpjp").val($("#atransferemployee_id").val())

        <?php if ($visit['isrj'] == '0') {
        ?>
            $("#skdpkdpoli").val('<?= $visit['clinic_id_from']; ?>')
        <?php
        } else {
        ?>
            $("#skdpkdpoli").val('<?= $visit['clinic_id']; ?>')
        <?php
        } ?>
        flatpickrInstances["flatskdptglkontrol"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );
        $("#flatskdptglkontrol").trigger("change");

        $("#skdpkddpjp").val('<?= $visit['employee_id']; ?>')

        $("#skdpnosurat").val(null)

        const req = await libAsyncAwaitPost({
                visit: '<?= $visit['visit_id']; ?>',
                nosurat: $("#atransferdocument_id").val()
            },
            "admin/rm/assessment/getKontrol"
        );


        // coba = JSON.parse(req)
        if (req.data.length > 0) {
            $("#skdpnosep").val(req.data.nosep)
            $("#skdpkddpjp").val(req.data.kodedokter)
            $("#skdpkdpoli").val(req.data.clinic_id)
            $("#skdptglkontrol").val(req.data.tglrenckontrol)
            $("#skdpnosurat").val(req.data.nosuratkontrol)
        }
        $("#atransferskdpgroup").slideDown()
    }

    const getSKDP = () => {
        $("#getSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')

        var currentkey = $("#pvcurrentkey").val()
        var currentClinic = $("#pvclinic_id").val()
        var selectedVisit = ''
        skunjAll.forEach((element, key) => {
            if (key < currentkey && element.clinic_id == currentClinic)
                selectedVisit = element.visit_id
        })

        postData({
            'norm': '<?= $visit['no_registration']; ?>',
            'kddpjp': $("#pvkddpjp").val(),
            'clinic_id': currentClinic,
            'visit_id': '<?= $visit['visit_id']; ?>'
        }, 'admin/pendaftaran/getSKDP', (res) => {
            if (res.metadata.code == '200') {
                alert('Berhasil mengambil data SKDP')
            } else {
                alert('tidak ada data SKDP')
            }
            $("#getSkdpBtn").html('<i class="fa fa-search"></i>')
        });
        // $.ajax({
        //     url: '<?php echo base_url(); ?>admin/pendaftaran/getSKDP',
        //     type: "POST",
        //     data: JSON.stringify({
        //         'norm': '<?= $visit['no_registration']; ?>',
        //         'kddpjp': $("#pvkddpjp").val(),
        //         'clinic_id': currentClinic,
        //         'visit_id': '<?= $visit['visit_id']; ?>'
        //     }),
        //     dataType: 'json',
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     success: function(data) {
        //         if (data.metadata.code == '200') {
        //             alert('Berhasil mengambil data SKDP')
        //             $("#pvedit_sep").val(data.skdp)
        //         } else {
        //             alert('tidak ada data SKDP')
        //         }
        //         $("#getSkdpBtn").html('<i class="fa fa-search"></i>')
        //     },
        //     error: function() {
        //         $("#getSkdpBtn").html('<i class="fa fa-search"></i>')
        //     }
        // });
    }

    const saveSkdp = () => {
        let skdpnosep = $("#skdpnosep").val()
        let skdpkddpjp = $("#skdpkddpjp").val()
        let skdpkdpoli = $("#skdpkdpoli").val()
        let skdptglkontrol = $("#skdptglkontrol").val()
        let skdpnosurat = $("#skdpnosurat").val()

        if (skdpkddpjp == '' || skdpkddpjp == null) {
            alert('Kolom Dokter tidak boleh kosong')
        } else if (skdpkdpoli == '' | skdpkdpoli == null) {
            alert('Kolom Poli tidak boleh kosong')
        } else if (skdptglkontrol == '' || skdptglkontrol == null) {
            alert('Kolom Tanggal Rencana Kontrol tidak boleh kosong')
        } else {
            $("#saveSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')

            let formtransfer = new FormData(document.getElementById("formaddatransfer"))
            let formtransferarray = {}
            formtransfer.forEach(function(value, key) {
                formtransferarray[key] = value
            });
            skdptglkontrol == (String)(skdptglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSkdp',
                type: "POST",
                data: JSON.stringify({
                    "request": {
                        "noSEP": skdpnosep,
                        "kodeDokter": skdpkddpjp,
                        "poliKontrol": skdpkdpoli,
                        "tglRencanaKontrol": skdptglkontrol,
                        "user": '<?= user()->username; ?>'
                    },
                    "visit_id": '<?= $visit['visit_id']; ?>',
                    "noSuratKontrol": skdpnosurat,
                    'no_registration': '<?= $visit['no_registration']; ?>',
                    'transfer': formtransferarray
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data)
                    console.log(data.metaData.code)
                    console.log(data.response.noSuratKontrol)
                    if (data.metaData.code == '200') {
                        alert("Berhasil posting SKDP!")
                        $("#skdpnosurat").val(data.response.noSuratKontrol)
                    } else {
                        alert(data.metaData.message)
                    }
                    $("#saveSkdpBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                },
                error: function() {
                    $("#saveSkdpBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                }
            });
        }
    }

    const deleteSkdp = () => {
        var skdpnosurat = $("#skdpnosurat").val()
        if (skdpnosurat == '' || skdpnosurat == null) {
            alert('Kolom Nomor SKDP tidak boleh kosong saat menghapus')
        } else {
            $("#deleteSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')
            skdptglkontrol == (String)(skdptglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/deleteSkdp',
                type: "DELETE",
                data: JSON.stringify({
                    "request": {
                        "t_suratkontrol": {
                            "noSuratKontrol": skdpnosurat,
                            "user": '<?= user()->username; ?>'
                        }
                    }
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("Berhasil delete SKDP!")
                        $("#skdpnosurat").val("")
                    } else {
                        alert(data.metaData.message)
                    }
                    $("#deleteSkdpBtn").html('<i class="fa fa-trash"></i> <span>Delete</span>')
                },
                error: function() {
                    $("#deleteSkdpBtn").html('<i class="fa fa-trash"></i> <span>Delete</span>')
                }
            });
        }
    }

    const checkSkdp = () => {
        $("#checkSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        var skdpnosurat = $("#skdpnosurat").val()
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/checkSkdp',
            type: "POST",
            data: JSON.stringify({
                "visit": '<?= $visit['visit_id']; ?>'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == '200') {
                    alert(data.metadata.message)
                    var skdp = data.data
                    $("#skdpnosep").val(skdp.nosep)
                    $("#skdpkddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    $("#skdpkdpoli").html("")
                    klinikBpjs.forEach((value, key) => {
                        if (value[1] == $("#pvclinic_id").val()) {
                            $("#skdpkdpoli").append(new Option(value[2], value[0]))
                            console.log(value[2])
                        }
                    })
                    $("#skdptglkontrol").val((String)(skdp.tglrenckontrol).slice(0, 10))
                    $("#skdpnosurat").val(skdp.nosuratkontrol)
                    // Object.keys(dpjp).forEach(key => {
                    //     if (key == employeeSelected) {
                    //         // console.log(key, dpjp[key]);
                    //         $("#pvkddpjp").append(new Option(dpjp[key], dpjp[key]));
                    //         $("#skdpkddpjp").html("")
                    //         $("#skdpkddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    //     }
                    // });
                } else {
                    alert(data.metadata.message)
                    $("#skdpnosep").val($("#pvno_skp").val())
                    $("#skdpkddpjp").html("")
                    $("#skdpkddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    $("#skdpkdpoli").html("")
                    klinikBpjs.forEach((value, key) => {
                        if (value[1] == $("#pvclinic_id").val()) {
                            $("#skdpkdpoli").append(new Option(value[2], value[0]))
                            console.log(value[2])
                        }
                    })
                    $("#skdptglkontrol").val(null)
                    $("#skdpnosurat").val("")
                }
                $("#checkSkdpBtn").html('<i class="fa fa-edit"></i> <span>Check</span>')
            },
            error: function() {
                $("#checkSkdpBtn").html('<i class="fa fa-edit"></i> <span>Check</span>')
            }
        });
    }
</script>

<!-- SPRI -->
<script>
    const setDataSpri = async (data = null) => {
        $("#sprikddpjp").val($("#atransferemployee_id").val())

        <?php if ($visit['isrj'] == '0') {
        ?>
            $("#sprikdpoli").val('<?= $visit['clinic_id_from']; ?>')
        <?php
        } else {
        ?>
            $("#sprikdpoli").val('<?= $visit['clinic_id']; ?>')
        <?php
        } ?>

        $("#spritglkontrol").val(get_date())
        $("#sprinosurat").val(null)
        flatpickrInstances["flatspritglkontrol"].setDate(moment().format("DD/MM/YYYY HH:mm"))
        $("#flatacpptexamination_date").trigger("change")


        const req = await libAsyncAwaitPost({
                visit: '<?= $visit['visit_id']; ?>',
                nosurat: $("#atransferdocument_id").val()
            },
            "admin/rm/assessment/getSPRI"
        );

        if (req) {
            $("#sprikddpjp").val(req?.data?.kodedokter)
            $("#sprikdpoli").val(req?.data?.clinic_id)
            $("#spritglkontrol").val(req?.data?.tglrenckontrol)
            $("#sprinosurat").val(req?.data?.nosuratkontrol)
            console.log(req?.data?.tglrenckontrol)
            flatpickrInstances["flatspritglkontrol"].setDate(formatedDatetimeFlat(req?.data?.tglrenckontrol))
            $("#flatspritglkontrol").trigger("change")
        }
        $("#atransfersprigroup").slideDown()
    }

    // const getSPRI = () => {
    //     $("#getSpriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
    //     $("#getSpriSpriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
    //     // alert("Get Nomor SKDP Berhasil")
    //     $.ajax({
    //         url: '<?php echo base_url(); ?>admin/pendaftaran/getSPRI',
    //         type: "POST",
    //         data: JSON.stringify({
    //             'norm': $visit['no_registration'],
    //             'kddpjp': $visit['kddpjp'],
    //             'clinic_id': $visit['clinic_id'],
    //             'visit_id': $visit['visit_id']
    //         }),
    //         dataType: 'json',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function(data) {
    //             if (data.metadata.code == '200') {
    //                 alert('Berhasil mengambil data SPRI')
    //                 $("#pvspecimenno").val(data.spri)
    //                 $("#taspecimenno").val(data.spri)
    //             } else {
    //                 alert('tidak ada data SPRI')
    //             }
    //             $("#getSpriBtn").html('<i class="fa fa-search"></i>')
    //             $("#getSpriRanapBtn").html('<i class="fa fa-search"></i>')
    //         },
    //         error: function() {
    //             $("#getSpriBtn").html('<i class="fa fa-search"></i>')
    //             $("#getSpriRanapBtn").html('<i class="fa fa-search"></i>')
    //         }
    //     });
    // }

    const saveSpri = () => {
        let spripasien_id = '<?= $visit['pasien_id']; ?>'
        let sprikddpjp = $("#sprikddpjp").val()
        let sprikdpoli = $("#sprikdpoli").val()
        let spritglkontrol = $("#spritglkontrol").val()
        let sprinosurat = $("#atransferdocument_id").val()

        // if (spripasien_id == '') {
        //     if ('<?= $visit['status_pasien_id']; ?>' == '18')
        //         alert('No Kartu BPJS harus diisi!')
        // } else 
        if (sprikddpjp == '' || sprikddpjp == null) {
            alert('Kolom Dokter tidak boleh kosong')
        } else if (sprikdpoli == '' | sprikdpoli == null) {
            alert('Kolom Poli tidak boleh kosong')
        } else if (spritglkontrol == '' || spritglkontrol == null) {
            alert('Kolom Tanggal Rencana Kontrol tidak boleh kosong')
        } else {
            $("#saveSpriBtn").html('<i class="spinner-border spinner-border-sm"></i>')

            let formtransfer = new FormData(document.getElementById("formaddatransfer"))
            let formtransferarray = {}
            formtransfer.forEach(function(value, key) {
                formtransferarray[key] = value
            });
            spritglkontrol == (String)(spritglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSpri',
                type: "POST",
                data: JSON.stringify({
                    "request": {
                        "noKartu": spripasien_id,
                        "kodeDokter": sprikddpjp,
                        "poliKontrol": sprikdpoli,
                        "tglRencanaKontrol": spritglkontrol,
                        "user": '<?= user()->username; ?> '
                    },
                    "visit_id": '<?= $visit['visit_id']; ?>',
                    "noSuratKontrol": sprinosurat,
                    'no_registration': '<?= $visit['no_registration']; ?>',
                    'transfer': formtransferarray
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("Berhasil posting spri!")
                        $("#sprinosurat").val(data.response.noSPRI)
                        $("#atransferdocument_id").val(data.response.noSPRI)
                    } else {
                        alert(data.metaData.message)
                    }
                    $("#saveSpriBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                },
                error: function() {
                    $("#saveSpriBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                }
            });
        }
    }

    const deleteSpri = () => {
        var sprinosurat = $("#sprinosurat").val()
        if (sprinosurat == '' || sprinosurat == null) {
            alert('Kolom Nomor spri tidak boleh kosong saat menghapus')
        } else {
            $("#deletespriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
            spritglkontrol == (String)(spritglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/pendaftaran/deletespri ',
                type: "DELETE",
                data: JSON.stringify({
                    "request": {
                        "t_suratkontrol": {
                            "noSuratKontrol": sprinosurat,
                            "user": '<?= user()->username; ?> '
                        }
                    }
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("Berhasil delete spri!")
                        $("#sprinosurat").val("")
                    } else {
                        alert(data.metaData.message)
                    }
                    $("#deletespriBtn").html('<i class="fa fa-trash"></i> <span>Delete</span>')
                },
                error: function() {
                    $("#deletespriBtn").html('<i class="fa fa-trash"></i> <span>Delete</span>')
                }
            });
        }
    }

    const checkSpri = () => {
        $("#checkspriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        var sprinosurat = $("#sprinosurat").val()
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/checkSpri ',
            type: "POST",
            data: JSON.stringify({
                "visit": '<?= $visit['visit_id']; ?>'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == '200') {
                    alert(data.metadata.message)
                    var spri = data.data
                    // $("#sprikddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    $("#sprikddpjp").val($("#pvkddpjp").val())
                    $("#sprikdpoli").val("")
                    klinikBpjs.forEach((value, key) => {
                        if (value[1] == $("#pvclinic_id").val()) {
                            // $("#sprikdpoli").append(new Option(value[2], value[0]))
                            $("#sprikdpoli").val(value[0])
                            // console.log(value[2])
                        }
                    })
                    $("#spritglkontrol").val((String)(spri.tglrenckontrol).slice(0, 10))
                    $("#sprinosurat").val(spri.nosuratkontrol)
                    // Object.keys(dpjp).forEach(key => {
                    // if (key == employeeSelected) {
                    // // console.log(key, dpjp[key]);
                    // $("#pvkddpjp").append(new Option(dpjp[key], dpjp[key]));
                    // $("#sprikddpjp").val("")
                    // $("#sprikddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    // }
                    // });
                } else {
                    alert(data.metadata.message)
                    $("#sprikddpjp").val("")
                    // $("#sprikddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    $("#sprikddpjp").val($("#pvkddpjp").val())
                    $("#sprikdpoli").val("")
                    klinikBpjs.forEach((value, key) => {
                        if (value[1] == $("#pvclinic_id").val()) {
                            // $("#sprikdpoli").append(new Option(value[2], value[0]))
                            $("#sprikdpoli").val(value[0])
                            // console.log(value[2])
                        }
                    })
                    $("#spritglkontrol").val(null)
                    $("#sprinosurat").val("")
                }
                $("#checkspriBtn").html('<i class="fa fa-edit"></i> <span>Check</span>')
            },
            error: function() {
                $("#checkspriBtn").html('<i class="fa fa-edit"></i> <span>Check</span>')
            }
        });
    }
</script>

<!-- RUJUKAN -->
<script>
    $(document).ready(function() {
        $('#ardirujukke').select2({
            placeholder: "Input PPK Rujukan",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getPPKRujukan',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

    })
    const setDataRujukEksternal = async (data = null) => {
        let diag_id = null
        let diag_name = null

        //initiate diagnosa
        let modalParentId;
        if ("atransferrujukaneksternalgroups" == null) {
            modallParentId = $(this).parent()
        } else {
            modalParentId = $("#" + "atransferrujukaneksternalgroups")
        }
        $("#" + "ardiag_id1").select2({
            placeholder: "Input Diagnosa",
            dropdownParent: modalParentId,
            theme: 'bootstrap-5',
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getDiagnosisListAjax',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                    };
                },
                processResults: function(response) {
                    $("#" + "ardiag_id1").val(null).trigger('change');
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        if (diag_id != null) {
            var option = new Option(initialname, diag_id, true, true);
            $("#" + "ardiag_id1").append(option).trigger('change');
        }
        //end initiate diagnosa
        flatpickrInstances["flatarmartgl_kontrol"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );
        $("#flatarmartgl_kontrol").trigger("change");

        const req = await libAsyncAwaitPost({
                visit: '<?= $visit['visit_id']; ?>'
            },
            "admin/patient/getRujukan"
        );

        // coba = JSON.parse(req)
        if (req.length > 0) {
            let datarujukan = JSON.parse(req)
            $("#arnorujukan").val(datarujukan?.nokunjungan)

            var option = new Option(datarujukan?.provrujukan_nmprovider, datarujukan?.provrujukan_kdprovider, true, true);
            $("#ardirujukke").append(option).trigger('change')
            $("#artiperujukan").val(datarujukan?.tiperujukan)
            $("#artgl_kontrol").val(datarujukan?.tglrujukan)
            $("#arkdpoli_kontrol").val(datarujukan?.clinic_id)
            $("#arnorujukan").val(datarujukan?.nokunjungan)

            var option = new Option(datarujukan?.nmdiag, datarujukan?.kddiag, true, true);
            $("#ardiag_id1").append(option).trigger('change');
        }


        $("#atransferrujukaneksternalgroups").slideDown()
    }
    const setDataCpptEksternal = (bodyId1, bodyId2, bodyId3) => {
        $("#formakomodasiatransferid").slideDown()
        $("#formaddatransfer1").find("input, textarea").val(null)
        var initialcppt = examForassessment[examForassessment.length - 1]
        var initialexam = examForassessmentDetail[examForassessmentDetail.length - 1]
        let exam = [];

        let isnew = false;

        $("#atransfertransferinternalgroup").slideDown()


        // buat cek dokumen cppt ada yang induknya si transfer enggak
        $.each(examForassessment, function(key, value) {
            if (value.body_id == bodyId1) {
                exam = value
            }
        })
        if (typeof(exam.body_id) !== 'undefined') {
            isnew = false
            $.each(exam, function(keyt, value) {
                $("#atransfer1" + keyt).val(value)
                $("#atransfer1" + keyt).prop("disabled", false)
            })
            $("#atransfer1collapseVitalSign").find("input, select").trigger("change")
        } else {
            isnew = true
            $.each(initialexam, function(key, value) {
                $("#atransfer1" + key).val(value)
            })
            $.each(initialexam, function(key, value) {
                $("#atransfer2" + key).val(value)
            })
            $.each(initialexam, function(key, value) {
                $("#atransfer3" + key).val(value)
            })

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
            $("#atransfer1vs_status_id").val(1)
            $("#atransfer1account_id").val(3)
            $("#acpptpetugas_type").val('<?= user()->getOneRoles(); ?>')
        }


        if (!isnew) {
            $.each(examForassessmentDetail, function(key, value) {
                if (value.body_id == bodyId1) {
                    exam1 = value
                } else if (value.body_id == bodyId2) {
                    exam2 = value
                } else if (value.body_id == bodyId3) {
                    exam3 = value
                }
            })
            if (typeof(exam1.body_id) !== 'undefined') {
                $.each(exam1, function(keyt, value) {
                    $("#atransfer1" + keyt).val(value)
                    $("#atransfer1" + keyt).prop("disabled", false)
                })
                $("#atransfer1collapseVitalSign").find("input, select").trigger("change")
            }
            if (typeof(exam2.body_id) !== 'undefined') {
                $.each(exam2, function(keyt, value) {
                    $("#atransfer2" + keyt).val(value)
                    $("#atransfer2" + keyt).prop("disabled", false)
                })
                $("#atransfer2collapseVitalSign").find("input, select").trigger("change")
            }

            if (typeof(exam3.body_id) !== 'undefined') {
                $.each(exam3, function(keyt, value) {
                    $("#atransfer3" + keyt).val(value)
                    $("#atransfer3" + keyt).prop("disabled", false)
                })
                $("#atransfer3collapseVitalSign").find("input, select").trigger("change")
            }
        }


        $("#atransfer1body_id").val(bodyId1)
        $("#atransfer2body_id").val(bodyId2)
        $("#atransfer3body_id").val(bodyId3)



        $("#atransfer2VitalSign").show()


        getStabilitas($("#atransferbody_id").val(), "transferDerajatBody")


        // $("#atransfertransferinternalgroup").slideDown()

        enableTindakLanjut()
    }

    function postRujukan() {
        let clicked_submit_btn = $("#addnorujukan")



        let rujvisit = '<?= $visit['visit_id']; ?>'
        let rujrujukanNosep = '<?= $visit['no_skpinap'] ?? $visit['no_skp']; ?>'
        let rujnoRujukan = $("#arnorujukan").val()
        let rujtglRujukan = '<?= $visit['visit_date']; ?>'
        let rujtglRencanaKunjungan = $("#artgl_kontrol").val()
        if (rujtglRencanaKunjungan == '' || rujtglRencanaKunjungan == null) {
            alert('Tanggal Rencana Rujukan harus diisi')
            return '';
        }
        let rujppkdirujuk = $("#ardirujukke").val()
        if (rujppkdirujuk == '' || rujppkdirujuk == null) {
            alert('kolom "Dirujuk Ke" tidak boleh kosong')
            return '';
        }
        let rujppkname = $("#ardirujukke").find(":selected").text()
        if (typeof rujppkname !== 'undefined') {
            var rujppkdirujukName = rujppkname
        }
        let rujjnsPelayanan = '<?= is_null($visit['class_room_id']) ? '1' : '2'; ?>'
        let rujcatatan = $("#atransferprocedure_05").val()
        let rujdiagRujukan = $("#ardiag_id1").val()
        if (rujdiagRujukan == '' || rujdiagRujukan == null) {
            alert('Harus sudah mengisi diagnosa utama')
            return '';
        }
        let rujdiagname = $("#ardiag_id1").find(":selected").text()
        if (typeof rujdiagname !== 'undefined') {
            var rujdiagRujukanName = rujdiagname
        }
        let rujtipeRujukan = $("#artiperujukan").val()
        let rujpoliRujukan = $("#arkdpoli_kontrol").val()
        if (rujpoliRujukan == '' || rujpoliRujukan == null) {
            alert('Poli rujukan harus diisi')
            return '';
        }
        let rujsex = '<?= $visit['gender']; ?>'
        let rujnama = '<?= $visit['diantar_oleh']; ?>'
        let rujnokartu = '<?= $visit['pasien_id']; ?>'
        let rujnorm = '<?= $visit['no_registration']; ?>'

        let formtransfer = new FormData(document.getElementById("formaddatransfer"))
        let formtransferarray = {}
        formtransfer.forEach(function(value, key) {
            formtransferarray[key] = value
        });
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/postRujukan',
            type: "POST",
            data: JSON.stringify({
                'nosep': rujrujukanNosep,
                'norujukan': rujnoRujukan,
                'tglRujukan': rujtglRujukan,
                'tglRencanaKunjungan': rujtglRencanaKunjungan,
                'ppkdirujuk': rujppkdirujuk,
                'jnsPelayanan': rujjnsPelayanan,
                'catatan': rujcatatan,
                'diagRujukan': rujdiagRujukan,
                'tipeRujukan': rujtipeRujukan,
                'poliRujukan': rujpoliRujukan,
                'visit': rujvisit,
                'ppkdirujukName': rujppkdirujukName,
                'diagRujukanName': rujdiagRujukanName,
                'sex': rujsex,
                'nama': rujnama,
                'nokartu': rujnokartu,
                'nomr': rujnorm,
                'status_pasien_id': '<?= $visit['status_pasien_id']; ?>',
                'formtransfer': formtransferarray
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.metaData.code == '200') {
                    var noRujukan = data.response.norujukan
                    $("#arnorujukan").val(noRujukan);
                    $("#arnorujukan").prop("disabled", true);
                }
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }

    function deleteRujukan() {
        var clicked_submit_btn = $("#deleterujukan")

        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/deleteRujukan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': '<?= $visit['visit_id']; ?>',
                'noRujukan': $("#arnorujukan").val(),
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.metaData.code == '200') {
                    $("#arnorujukan").val("");
                }

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        })
    }
</script>

<!-- Harusnya ga dipake -->
<script>
    const tindakLanjut = (tindakLanjutType) => {
        // console.log(tindakLanjutType)
        if (tindakLanjutType == '2') { //2
            $("#atransferservice_needs_group").slideUp()
            // $("#atransferdirujukkegroup").slideDown()
            // $("#atransfertgl_kontrolgroup").slideDown()
            // $("#atransferkdpoli_kontrolgroup").slideDown()
            // $("#atransferdescriptiongroup").slideDown()
            // $("#atransferskdpgroup").slideUp()
            // $("#atransfersprigroup").slideUp()
            // $("#atransferrujukaneksternalgroup").slideDown()
            // $("#atransfertiperujukan_group").slideDown()
            // getRujukan()
            // $("#arrujukaninternalgroup").slideUp()
            // $("#atransferrujukaninternalgroup").slideUp()
        } else if (tindakLanjutType == '3') { //3
            $("#atransferservice_needs_group").slideUp()
            // $("#atransferdirujukkegroup").slideUp()
            // $("#atransfertgl_kontrolgroup").slideUp()
            // $("#atransferkdpoli_kontrolgroup").slideUp()
            // $("#atransferdescriptiongroup").slideUp()
            // $("#atransferskdpgroup").slideUp()
            // $("#atransfersprigroup").slideUp()
            // $("#atransferrujukaneksternalgroup").slideUp()
            // $("#atransfertiperujukan_group").slideUp()
            // $("#atransferrujukaninternalgroup").slideDown()
        } else if (tindakLanjutType == '4') { //4
            $("#atransferservice_needs_group").slideUp()
            // $("#atransferdirujukkegroup").slideUp()
            // $("#atransfertgl_kontrolgroup").slideDown()
            // $("#atransferkdpoli_kontrolgroup").slideDown()
            // $("#atransferdescriptiongroup").slideDown()
            // $("#atransferskdpgroup").slideDown()
            // $("#atransfersprigroup").slideUp()
            // $("#atransferrujukaneksternalgroup").slideUp()
            // $("#atransfertiperujukan_group").slideUp()
            // $("#atransferrujukaninternalgroup").slideUp()
        } else if (tindakLanjutType == '5') { //5
            $("#atransferservice_needs_group").slideDown()
            // $("#atransferdirujukkegroup").slideUp()
            // $("#atransfertgl_kontrolgroup").slideDown()
            // $("#atransferkdpoli_kontrolgroup").slideUp()
            // $("#atransferdescriptiongroup").slideDown()
            // $("#atransferskdpgroup").slideUp()
            // $("#atransfersprigroup").slideDown()
            // $("#atransferrujukaneksternalgroup").slideUp()
            // $("#atransfertiperujukan_group").slideUp()
        } else {
            $("#atransferservice_needs_group").slideUp()
            // $("#atransferdirujukkegroup").slideUp()
            // $("#atransfertgl_kontrolgroup").slideUp()
            // $("#atransferkdpoli_kontrolgroup").slideUp()
            // $("#atransferdescriptiongroup").slideUp()
            // $("#atransferskdpgroup").slideUp()
            // $("#atransfersprigroup").slideUp()
            // $("#atransferrujukaneksternalgroup").slideUp()
            // $("#atransfertiperujukan_group").slideUp()
            // $("#atransferrujukaninternalgroup").slideUp()
        }
    }
</script>


<script src="<?php echo base_url(); ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<!-- AKOMODASI -->
<script>
    var tableKetersediaanTT = $("#ketersediaanTT").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
        "pageLength": 50
    })
    var classRoomArray = [];
    var bedArray = [];
    var jsonBed;
    var sAkom;
    var caraKeluar;
    $("#formAkomodasiView").on('submit', (function(e) {

        e.preventDefault();
        $("#formAkomodasiViewBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/saveAkomodasi',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == 200) {
                    successSwal(data.metadata.message)
                    if (data.response.lastkeluar == 32) {
                        nextFormRanap()
                        $("#addRanapModal").css("z-index", 2000)
                    }
                } else {
                    errorSwal(data.metadata.message)
                }
                $("#formAkomodasiViewBtn").html('<i class="fa fa-save"></i> Simpan')
                $("#formAkomodasiViewBtn").slideUp()
                disableElementTA()
            },
            error: function() {
                $("#formAkomodasiViewBtn").html('<i class="fa fa-save"></i> Simpan')
            }
        });

    }));

    function addRanap(id) {
        $("#historyRajalModal").modal("show")
        getHistoryRajalPasien(id)
    }

    function enableElementTA(key) {
        $("#tatreat_date" + key).removeAttr("readonly")
        $("#taexit_date" + key).removeAttr("readonly")
        $("#taquantity" + key).removeAttr("readonly")
        $("#takeluar_id" + key).off('mousedown')
        $("#formAkomodasiViewBtn").slideDown()
    }

    function disableElementTA(key) {
        $('[id^="tatreat_date"]').prop("readonly", true)
        $('[id^="taexit_date"]').prop("readonly", true)
        $('[id^="taquantity"]').prop("readonly", true)
        $('[id^="takeluar_id"]').on('mousedown', function() {
            return false;
        })
    }

    function getAkomodasi(visit) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/getSinglePV',
            type: "POST",
            data: JSON.stringify({
                'visit': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data) {
                    skunj = data

                    //BIODATA
                    $("#taidentity").html(skunj.diantar_oleh + '(' + skunj.no_registration + ')')
                    $("#tabiodatatapasien_id").html(skunj.pasien_id)
                    $("#tabiodatatacoverages").html(skunj.coverage_id)
                    $("#tabiodatataaddress").html(skunj.visitor_address)
                    $("#tabiodatatagender").html(skunj.gender)
                    $("#tabiodatataclass_id_plafond").html(skunj.class_id_plafond)
                    $("#tabiodatataage").html(skunj.ageyear + "th " + skunj.agemonth + "bl " + skunj.ageday + "hr")
                    $("#tabiodatatastatus").html(skunj.status_pasien_id)
                    $("#tabiodatatapayor").html(skunj.payor_id)



                    $("#tanorujukan").val(data.norujukan)
                    $("#takdpoli").val(data.kdpoli)
                    $("#tatanggal_rujukan").val((String)(data.tanggal_rujukan).slice(0, 10))
                    $("#tappkrujukan").val(data.ppkrujukan)
                    $("#tadiag_awal").html("")
                    $("#tadiag_awal").append(new Option(data.conclusion, data.diag_awal))
                    $("#taconclusion").val(data.conclusion)
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/rawatinap/getAkomodasi',
                        type: "POST",
                        data: JSON.stringify({
                            'visit': skunj.visit_id,
                            'nomor': skunj.no_registration
                        }),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (typeof data.cara_keluar !== 'undefined') {
                                caraKeluar = data.cara_keluar
                            }
                            if (typeof data.data[0] !== 'undefined') {

                                $("#iidentity").html(skunj.diantar_oleh + " (" + skunj.no_registration + ")")
                                $("#biodatatapasien_id").html(skunj.pasien_id)
                                // coverage.forEach((element, index) => {
                                //     if (index == skunj.coverage_id) {
                                //         $("#biodatatacoverages").html(element);
                                //     }
                                // });
                                $("#biodatataaddress").html(skunj.visitor_address)
                                $("#biodatatagender").html(skunj.gender)
                                // kelas.forEach(value => {
                                //     if (value[0] == skunj.class_id_plafond) {
                                //         $("#biodatataclass_id_plafond").html(value[1]);
                                //     }
                                // });
                                $("#biodatataage").val(skunj.ageyear + "th " + skunj.agemonth + "bl " + skunj.ageday + "hr")
                                // statusPasien.forEach(value => {
                                //     if (value[0] == skunj.status_pasien_id) {
                                //         $("#biodatatastatus").html(value[1]);
                                //     }
                                // });
                                // payor.forEach(payorvalue => {
                                //     if (payorvalue[1] == skunj.payor_id) {
                                //         $("#biodatatapayor").html(payorvalue[3]);
                                //     }
                                // });

                                $("#taasalrujukan").val(skunj.asalrujukan)
                                $("#tanorujukan").val(skunj.norujukan)
                                $("#taspecimenno").val(skunj.specimenno)
                                $("#tano_skp").val(skunj.no_skp)
                                $("#tano_skpinap").val(skunj.no_skpinap)

                                $("#tatujuankunj").val(skunj.tujuankunj)
                                $("#takdpenunjang").val(skunj.kdpenunjang)
                                $("#taflagprocedure").val(skunj.flagprocedure)
                                $("#taassesmentpel").val(skunj.assesmentpel)


                                $("#akomodasiView").modal('show')
                                console.log(data)
                                sAkom = data.data
                                $("#akomodasiViewTableBody").html("")
                                sAkom.forEach((element, key) => {
                                    $("#akomodasiViewTableBody").append($("<tr id='" + element.bill_id + "'>")
                                        .append('<input name="bill_id[]" type="hidden" value="' + element.bill_id + '">')
                                        .append('<input id="tatagihan' + key + '" name="tagihan[]" type="hidden" value="' + element.tagihan + '">')
                                        .append($("<td>").append(key + 1))
                                        .append($("<td>").append(element.name_of_class + "<br>" + element.fullname + "<br>" + element.bed_id))
                                        .append($('<td>')
                                            .append($("<div>")
                                                .append('<input name="treat_date[]" class="form-control" type="datetime-local" value="' + element.treat_date + '" id="tatreat_date' + key + '" onchange="changeTreatDateTA(' + key + ')" readonly>')
                                            )
                                        )
                                        .append($('<td>')
                                            .append($("<div>")
                                                .append('<input name="exit_date[]" class="form-control" type="datetime-local" value="' + element.exit_date + '" id="taexit_date' + key + '" onchange="changeExitDateTA(' + key + ')" readonly>')
                                            )
                                        )
                                        .append($("<td>").append('<input id="taquantity' + key + '" name="quantity[]" class="form-control" type="text" value="' + parseFloat(element.quantity) + '" onchange="changeQuantityTA(' + key + ')" readonly/>'))
                                        .append($("<td>").append('<select name="keluar_id[]" id="takeluar_id' + key + '" class="form-control" onchange="changeCaraKeluarTA(' + key + ')"></select>'))
                                        .append($("<td>").append(element.tarif_name))
                                        .append($("<td>").append('<input id="tasell_price' + key + '" name="sell_price[]" class="form-control" type="text" value="' + parseFloat(element.sell_price) + '" readonly/>'))
                                        .append($("<td>").append('<input id="taamount_paid' + key + '" name="amount_paid[]" class="form-control" type="text" value="' + parseFloat(element.amount_paid) + '" readonly/>'))
                                    )
                                    if (key + 1 == sAkom.length) {
                                        $("#" + element.bill_id).append($('<td id="btnTdAkom"' + key + '>')
                                            .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                                                .append($('<button type="button" class="btn btn-primary" onclick="enableElementTA(' + key + ')">').append('<i class="fa fa-edit"></i>'))
                                                .append($('<button id="delBtnAkomodasi' + key + '" type="button" class="btn btn-danger" onclick="deleteAkomodasi(\'' + element.bill_id + '\',' + key + ')">').append('<i class="fa fa-trash"></i>'))
                                            )
                                        )

                                    } else {
                                        $("#" + element.bill_id).append($("<td>"))
                                    }
                                    caraKeluar.forEach((elementKel, keyKel) => {
                                        $("#takeluar_id" + key).append('<option value="' + elementKel.keluar_id + '">' + elementKel.cara_keluar + '</option>')
                                    })
                                    $("#takeluar_id" + key).val(element.keluar_id)
                                    $("#takeluar_id" + key).on('mousedown', function() {
                                        return false;
                                    })
                                    $("#taquantity" + key).keydown(function(e) {
                                        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
                                    });
                                });
                            } else {
                                nextFormRanap()
                            }
                            $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                                .prop("disabled", false)
                        },
                        error: function() {
                            $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                                .prop("disabled", false)
                        }
                    });
                    // getRujukanInap()
                } else {
                    $("#ajax_load").html("");
                    $("#patientDetails").slideUp();
                }
            },
            error: function() {
                $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
            }
        });
    }

    function nextFormRanap() {
        $("#addRanapModal").modal("show")
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);
        var hours = ('0' + currentDate.getHours()).slice(-2);
        var minutes = ('0' + currentDate.getMinutes()).slice(-2);
        var seconds = ('0' + currentDate.getSeconds()).slice(-2);
        var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

        var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;

        $("#aritreat_date").val(isoDatetime);
        $("#historyRajalModal").modal('hide')
        $("#ariemployee_id").val(skunj.employee_id)
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/getBangsalInfo',
            type: "POST",
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                tableKetersediaanTT.clear()
                if (data) {
                    classRoomArray = data.classRoom
                    data.data.forEach((element, key) => {
                        tableKetersediaanTT.row.add(element).draw()
                    });
                } else {
                    $("#ajax_load").html("");
                    $("#patientDetails").slideUp();
                }
            },
            error: function() {
                $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
            }
        });
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/getBedInfo',
            type: "POST",
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                bedArray = data

                changeClinicInap('<?= @$visit['clinic_id']; ?>')
                changeClassRoomTA('<?= @$visit['class_room_id']; ?>')
            },
            error: function() {
                $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
            }
        });
    }

    function pilihBed(id) {
        jsonBed = JSON.parse($("#" + id).html())
        var clinicId = jsonBed.clinic_id
        $("#ariclinic_id").val(jsonBed.clinic_id)
        $("#ariclass_room_id").html("")
        $("#aribed_id").html("")
        $("#ariamount_paid").val(0)
        $("#aritarif_name").val("")
        $("#aritarif_id").val("")
        classRoomArray.forEach((element, key) => {
            if (element.class_room_id == jsonBed.class_room_id) {
                $("#ariclass_room_id").append('<option value="' + element.class_room_id + '">' + element.classroomname + '</option>')
                $("#ariamount_paid").val(element.amount_paid)
                $("#aritarif_name").val(element.tarif_name)
                $("#aritarif_id").val(element.tarif_id)
                $("#ariclass_id").val(element.class_id)
            }
        });
        bedArray.forEach((element, key) => {
            if (element.class_room_id == jsonBed.class_room_id) {
                $("#aribed_id").append('<option value="' + element.bed_id + '">' + element.bed_id + '</option>')
            }
        })


        $("#ariclinic_idalert").slideUp()
        $("#ariclass_room_idalert").slideUp()
        $("#aribed_idalert").slideUp()
    }

    function changeClinicInap(id) {
        $("#ariclass_room_id").html("")
        $("#aribed_id").html("")
        $("#ariamount_paid").val(0)
        $("#aritarif_name").val("")
        $("#aritarif_id").val("")
        console.log(id)
        classRoomArray.forEach((element, key) => {
            if (element.clinic_id == id) {
                $("#ariclass_room_id").append('<option value="' + element.class_room_id + '">' + element.classroomname + '</option>')
            }
        });
        bedArray.forEach((element, key) => {
            if (element.class_room_id == $("#ariclass_room_id").val()) {
                $("#aribed_id").append('<option value="' + element.bed_id + '">' + element.bed_id + '</option>')
            }
        })
        classRoomArray.forEach((element, key) => {
            if (element.class_room_id == $("#ariclass_room_id").val()) {
                $("#ariamount_paid").val(element.amount_paid)
                $("#aritarif_name").val(element.tarif_name)
                $("#aritarif_id").val(element.tarif_id)
            }
        });
    }

    function changeClassRoomTA(id) {
        $("#aribed_id").html("")
        console.log(id)

        bedArray.forEach((element, key) => {
            if (element.class_room_id == id) {
                $("#aribed_id").append('<option value="' + element.bed_id + '">' + element.bed_id + '</option>')
            }
        })
        classRoomArray.forEach((element, key) => {
            if (element.class_room_id == id) {
                $("#ariamount_paid").val(element.amount_paid)
                $("#aritarif_name").val(element.tarif_name)
                $("#aritarif_id").val(element.tarif_id)
            }
        });
    }

    function changeCaraKeluarTA(id) {
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);
        var hours = ('0' + currentDate.getHours()).slice(-2);
        var minutes = ('0' + currentDate.getMinutes()).slice(-2);
        var seconds = ('0' + currentDate.getSeconds()).slice(-2);
        var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

        var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;

        $("#taexit_date" + id).val(isoDatetime);
        var start = new Date($("#tatreat_date" + id).val())
        var end = new Date($("#taexit_date" + id).val())
        var daydiff = datediff(start, end)
        if (daydiff == 0) {
            daydiff = 1
        }
        $("#taquantity" + id).val(daydiff)
        changeQuantityTA(id)

    }

    function changeExitDateTA(id) {
        var start = new Date($("#tatreat_date" + id).val())
        var end = new Date($("#taexit_date" + id).val())
        var now = new Date()
        var daydiff = datediff(start, end)
        if (daydiff < 0) {
            alert("Tanggal Keluar harus lebih besar dari tanggal masuk")
            $("#taexit_date" + id).val($("#tatreat_date" + id).val())
            daydiff = 1
            $("#taquantity" + id).val(daydiff)
            changeQuantityTA(id)
        } else {
            if (daydiff == 0) {
                daydiff = 1
            }
            $("#taquantity" + id).val(daydiff)
            changeQuantityTA(id)
        }
        var daydiffnow = datediff(end, now)
        if (daydiffnow < 0) {
            alert("Tanggal keluar harus lebih kecil dari hari, jam, dan menit sekarang")
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
            var day = ('0' + currentDate.getDate()).slice(-2);
            var hours = ('0' + currentDate.getHours()).slice(-2);
            var minutes = ('0' + currentDate.getMinutes()).slice(-2);
            var seconds = ('0' + currentDate.getSeconds()).slice(-2);
            var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

            var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
            $("#taexit_date" + id).val(isoDatetime)
            end = new Date($("#taexit_date" + id).val())
            daydiff = datediff(start, end)
            if (daydiff == 0) {
                daydiff = 1
            }
            $("#taquantity" + id).val(daydiff)
            changeQuantityTA(id)
        }
    }

    function changeTreatDateTA(id) {
        if (id > 1) {
            var idEnd = id - 1
            var start = new Date($("#tatreat_date" + id).val())
            var end = new Date($("#taexit_date" + idEnd).val())
            var daydiffBefore = datediff(start, end)
            if (daydiffBefore > 0) {
                alert('Tanggal masuk RI harus lebih besar dari tanggal keluar pada kamar sebelumnya')
                $("#tatreat_date" + id).val($("#taexit_date" + idEnd).val())
            } else {
                var visitDate = new Date(skunj.visit_date)
                var daydiffrajal = datediff(visitDate, start)
                if (daydiffrajal >= 0) {
                    var now = new Date()
                    var daydiffnow = datediff(start, now)
                    if (daydiffnow < 0) {
                        alert("Tanggal masuk harus lebih kecil dari hari, jam, dan menit sekarang")
                        var currentDate = new Date();
                        var year = currentDate.getFullYear();
                        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
                        var day = ('0' + currentDate.getDate()).slice(-2);
                        var hours = ('0' + currentDate.getHours()).slice(-2);
                        var minutes = ('0' + currentDate.getMinutes()).slice(-2);
                        var seconds = ('0' + currentDate.getSeconds()).slice(-2);
                        var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

                        var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
                        $("#tatreat_date" + id).val(isoDatetime)
                        start = new Date($("#tatreat_date" + id).val())
                        daydiff = datediff(start, end)
                        if (daydiff == 0) {
                            daydiff = 1
                        }
                        $("#taquantity" + id).val(daydiff)
                        changeQuantityTA(id)
                    }
                    var end = new Date($("#taexit_date" + id).val())
                    var daydiff = datediff(start, end)
                    if (daydiff >= 0) {
                        if (daydiff == 0) {
                            daydiff = 1
                        }
                        $("#taquantity" + id).val(daydiff)
                    } else {
                        alert('Tanggal keluar rawat inap harus lebih besar dari tanggal masuk')
                        $("#taexit_date" + id).val($("#tatreat_date" + id).val())
                        $("#taquantity" + id).val(1)
                        changeQuantityTA(id)
                    }

                } else {
                    alert('Tanggal dan jam masuk harus lebih besar dari tanggal dan jam kunjungan rawat jalannya.')
                    var currentDate = new Date(visitDate);
                    var year = currentDate.getFullYear();
                    var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
                    var day = ('0' + currentDate.getDate()).slice(-2);
                    var hours = ('0' + currentDate.getHours()).slice(-2);
                    var minutes = ('0' + currentDate.getMinutes()).slice(-2);
                    var seconds = ('0' + currentDate.getSeconds()).slice(-2);
                    var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

                    var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
                    $("#tatreat_date" + id).val(isoDatetime)
                }
            }
        }

        if (daydiff <= 0) {
            daydiff = 1
        }
        $("#taquantity" + id).val(daydiff)
        changeQuantityTA(id)
    }

    function changeQuantityTA(id) {
        var quantity = $("#taquantity" + id).val()
        var sell_price = $("#tasell_price" + id).val()

        var tagihan = quantity * sell_price
        $("#tatagihan" + id).val(tagihan)
        $("#taamount_paid" + id).val(tagihan)
    }

    function changeAriTreatDate() {
        var start = new Date($("#aritreat_date").val())
        var visitDate = new Date(skunj.visit_date)
        var daydiffrajal = datediff(visitDate, start)
        if (daydiffrajal < 0) {
            alert('Tanggal dan jam masuk harus lebih besar dari tanggal dan jam kunjungan rawat jalannya.')
            var currentDate = new Date(visitDate);
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
            var day = ('0' + currentDate.getDate()).slice(-2);
            var hours = ('0' + currentDate.getHours()).slice(-2);
            var minutes = ('0' + currentDate.getMinutes()).slice(-2);
            var seconds = ('0' + currentDate.getSeconds()).slice(-2);
            var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

            var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
            $("#aritreat_date").val(isoDatetime)
        }
        if (sAkom.length > 1) {
            var idLast = sAkom.length - 1
            var endLast = new Date($("#taexit_date" + idLast).val())
            var daydiff = datediff(endLast, start)
            if (daydiff < 0) {
                alert('Tanggal awal rawat inap tidak boleh lebih kecil dari tanggal rawat bangsal terakhir')
                var currentDate = new Date();
                var year = currentDate.getFullYear();
                var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
                var day = ('0' + currentDate.getDate()).slice(-2);
                var hours = ('0' + currentDate.getHours()).slice(-2);
                var minutes = ('0' + currentDate.getMinutes()).slice(-2);
                var seconds = ('0' + currentDate.getSeconds()).slice(-2);
                var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

                var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
                $("#aritreat_date").val(isoDatetime)
            }
        }
    }


    //form tambah akomodasi yang ada list bangsalnya
    function saveAddAkomodasi() {
        $("#saveAddAkomodasi").html('<i class="spinner-border spinner-border-sm"></i>')
        $("#saveAddAkomodasi").prop("disabled", true)
        var ariclinic_id = $("#ariclinic_id").val()
        var ariclass_room_id = $("#ariclass_room_id").val()
        var aribed_id = $("#aribed_id").val()

        if (typeof ariclinic_id === 'undefined' || ariclinic_id == null) {
            $("#ariclinic_idalert").slideDown()
            $("#ariclass_room_idalert").slideUp()
            $("#aribed_idalert").slideUp()
        } else if (typeof ariclass_room_id === 'undefined' || ariclass_room_id == null) {
            $("#ariclinic_idalert").slideUp()
            $("#ariclass_room_idalert").slideDown()
            $("#aribed_idalert").slideUp()
        } else if (typeof aribed_id === 'undefined' || aribed_id == null) {
            $("#ariclinic_idalert").slideUp()
            $("#ariclass_room_idalert").slideUp()
            $("#aribed_idalert").slideDown()
        } else {
            $("#ariclinic_idalert").slideUp()
            $("#ariclass_room_idalert").slideUp()
            $("#aribed_idalert").slideUp()

            $.ajax({
                url: '<?php echo base_url(); ?>admin/rawatinap/postAddAkomodasi',
                type: "POST",
                data: JSON.stringify({
                    'class_room_id': $("#ariclass_room_id").val(),
                    'treat_date': $("#aritreat_date").val(),
                    'exit_date': $("#aritreat_date").val(),
                    'quantity': 1,
                    'measure_id': null,
                    'amount': $("#ariamount_paid").val(),
                    'amount_paid': $("#ariamount_paid").val(),
                    'payment_date': null,
                    'islunas': 0,
                    'modified_from': 'P000',
                    'iscetak': 0,
                    'print_date': null,
                    'employee_id': $("#ariemployee_id").val(),
                    'doctor': $("#ariemployee_id option:selected").text(),
                    'employee_id_from': skunj.employee_id,
                    'doctor_from': skunj.fullname,
                    'visit_id': skunj.visit_id,
                    'no_registration': skunj.no_registration,
                    'bill_id': null,
                    'subsidi': 0,
                    'org_unit_code': skunj.org_unit_code,
                    'clinic_id': $("#ariclinic_id").val(),
                    'treatment': $("#aritarif_name").val(),
                    'description': $("#ariclass_room_id option:selected").text(),
                    'tarif_id': $("#aritarif_id").val(),
                    'bed_id': $("#aribed_id").val(),
                    'keluar_id': 0,
                    'nota_no': null,
                    'clinic_id_from': skunj.clinic_id,
                    'sold_status': null,
                    'status_pasien_id': skunj.status_pasien_id,
                    'thename': skunj.diantar_oleh,
                    'theaddress': skunj.visitor_address,
                    'theid': skunj.pasien_id,
                    'class_id': $("#ariclass_id").val(),
                    'class_id_plafond': skunj.class_id_plafond,
                    'amount_plafond': 0,
                    'treatment_plafond': '',
                    'amount_paid_plafond': 0,
                    'pembulatan': 0,
                    'isrj': 0,
                    'payor_id': skunj.payor_id,
                    'ageyear': skunj.ageyear,
                    'agemonth': skunj.agemonth,
                    'ageday': skunj.ageday,
                    'gender': skunj.gender,
                    'kal_id': skunj.kal_id,
                    'discount': 0,
                    'karyawan': skunj.karyawan,
                    'account_id': skunj.account_id,
                    'sell_price': $("#ariamount_paid").val(),
                    'diskon': 0,
                    'invoice_id': null,
                    'tagihan': $("#ariamount_paid").val(),
                    'koreksi': 0,
                    'potongan': 0,
                    'bayar': 0,
                    'retur': 0,
                    'ppnvalue': 0,
                    'tarif_type': $("#aritarif_type").val(),
                    'subsidisat': 0,
                    'printq': 0,
                    'printed_by': null,
                    'clinic_type': $("#ariclinic_type").val(),
                    'package_id': null,
                    'module_id': null,
                    'theorder': null,
                    'cashier': '<?= user_id(); ?>',
                    'no_skpinap': skunj.no_skpinap,
                    'pasien_id': skunj.pasien_id,
                    'respon': null,
                    'mapping_sep': null,
                    'trans_id': skunj.trans_id,
                    'sppkasir': null,
                    'sppbill': null,
                    'spppoli': null,
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data)
                    $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                        .prop("disabled", false)
                    getAkomodasi(skunj.visit_id)
                    $("#addRanapModal").modal('hide')
                },
                error: function() {
                    $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                        .prop("disabled", false)
                }
            });
        }
    }

    function deleteAkomodasi(billId, key) {
        if ((sAkom[key].sppbill == '' || sAkom[key].sppbill == null) && (sAkom[key].sppbill == '' || sAkom[key].sppbill == null)) {
            var daysadded = new Date($("#tatreat_date" + key).val())
            var daysadded = daysadded.setDate(daysadded.getDate() + 10)
            var resultDate = new Date(daysadded)
            var today = new Date()
            if (resultDate > today) {
                var lsSep = $("#tano_skpinap").val()
                if (lsSep != '' && lsSep != null && sAkom.length != 0) {
                    alert('No SEP telah diterbitkan. Hapus nomor SEP terlebih dahulu.')
                } else {
                    if (confirm('Apakah anda betul-betul akan menghapus data ini?')) {
                        if (confirm('Menghapus data ini berarti akan menghapus semua transaksi yang pernah dilakukan di bangsal ini, Apakah anda betul-betul akan menghapus Data ini?')) {
                            $("#delBtnAkomodasi" + key).html('<i class="spinner-border spinner-border-sm"></i>')
                            $.ajax({
                                url: '<?php echo base_url(); ?>admin/rawatinap/deleteAkomodasi',
                                type: "POST",
                                data: JSON.stringify({
                                    "bill": sAkom[key].bill_id,
                                    "pastBill": key == 0 ? '' : sAkom[key - 1].bill_id
                                }),
                                dataType: 'json',
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(data) {
                                    console.log(data.metadata.code)
                                    if (data.metadata.code == 200) {
                                        $("#" + sAkom[key].bill_id).remove()
                                        sAkom.splice(key, 1)
                                        if (key == 0) {
                                            sAkom[key - 1].keluar_id = 0
                                            var keypast = key - 1
                                            $("#takeluar_id" + keypast).val(0)
                                            $("#btnTdAkom" + keypast).append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                                                .append($('<button type="button" class="btn btn-primary" onclick="enableElementTA(' + keypast + ')">').append('<i class="fa fa-edit"></i>'))
                                                .append($('<button id="delBtnAkomodasi' + keypast + '" type="button" class="btn btn-danger" onclick="deleteAkomodasi(\'' + sAkom[keypast].bill_id + '\',' + keypast + ')">').append('<i class="fa fa-trash"></i>'))
                                            )
                                        }
                                    } else {
                                        errorSwal(data.metadata.message)
                                    }
                                    $("#delBtnAkomodasi" + key).html('<i class="fa fa-trash"></i>')
                                },
                                error: function() {
                                    $("#delBtnAkomodasi" + key).html('<i class="fa fa-trash"></i>')
                                }
                            });
                        }
                    }
                }
            } else {
                alert("Anda tidak berhak menghapus transaksi ini karena durasi waktu telah terlampaui. Silahkan hubungi pihak administrator!")
            }
        } else {
            alert('Kunjungan pasien ini telah dilakukan close billing. Silahkan menghubungi petugas kasir untuk membua transaksinya kembali.')
        }
    }
</script>