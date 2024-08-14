<!-- Dokumen tindak lanjut -->
<script type='text/javascript'>
    let transfer = <?= json_encode($exam); ?>;
    let exam1 = [];
    let exam2 = [];
    let transferdesc = []
    let visitTransfer = []
    var i = 0

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

        $("#atransferbody_id").val(bodyId)
        $("#atransferorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#atransferno_registration").val('<?= $visit['no_registration']; ?>')
        $("#atransfervisit_id").val('<?= $visit['visit_id']; ?>')
        $("#atransfertrans_id").val('<?= $visit['trans_id']; ?>')
        $("#atransferdocument_id").val(bodyId1)
        $("#atransferdocument_id2").val(bodyId2)
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


        $("#atransferisinternal").val(1).trigger("change")



        // if (data != null) {
        //     $.each(data, function(keyt, value) {
        //         $("#atransfer" + keyt).val(value)
        //         if (keyt == 'employee_id') {
        //             // $("#atransferemployee_id").html("")
        //             $("#atransferemployee_id").append(value.employee_id)
        //         }
        //     })
        //     let isinternal = $("#atransferisinternal").val()
        //     if (isinternal == 10) {
        //         bodyId1 = $("#atransferdocument_id").val()
        //         bodyId2 = $("#atransferdocument_id2").val()

        //         setDatatransfer(bodyId1, bodyId2);
        //     }
        //     if (isinternal == 3) {
        //         getRujukInternal()
        //         setDataRujukInternal()
        //     }
        //     if (isinternal == 4) {

        //     }
        // }


        enableTindakLanjut()
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

    const editDataTindakLanjut = (key) => {
        var transferselect = transfer[key];
        $.each(transferselect, function(keyt, valuet) {
            $("#atransfer" + keyt).val(valuet)
        })
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)
        $("#contentTindakLanjut").slideDown()
    }

    const openTindakLanjutModal = async () => {
        let isinternal = $("#atransferisinternal").val();

        $("#formopenmodaltransferid").html('<i class="spinner-border spinner-border-sm"></i>')

        if (isinternal == 10) {
            // let bodyId1 = $("atransferdocument_id").val();
            // let bodyId2 = $("atransferdocument_id2").val();
            // bodyId1 = $("#atransferdocument_id").val()
            // bodyId2 = $("#atransferdocument_id2").val()

            setDatatransfer($("#atransferdocument_id").val(), $("#atransferdocument_id2").val())
        }
        if (isinternal == 3) {
            let visitselected = {};
            $.each(visitTransfer, function(key, value) {
                if (value.visit_id == $("#atransferdocument_id").val()) {
                    visitselected = value
                }
            })
            console.log(visitselected.visit_date)
            await setDataRujukInternal(visitselected)
        }
        if (isinternal == 2) {
            await setDataRujukEksternal()
        }
        if (isinternal == 4) {
            await setDataSkdp()
        }
        if (isinternal == 5) {
            await setDataSpri()
        }
        $("#formopenmodaltransferid").html('<i class="fa fa-plus"></i> <span>Detail</span>')
    }

    const disableTindakLanjut = () => {
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", true)

        $("#formtransfersubmit").slideUp()
        $("#formtransferedit").slideDown()
    }

    const enableTindakLanjut = () => {
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)

        $("#formtransfersubmit").slideDown()
        $("#formtransferedit").slideUp()
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
                clicked_submit_btn.button('loading');
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
                //     errorMsg(message);
                // } else {
                //     successMsg(data.message);
                // }
                $("#formaddatransfer").find("input, textarea, select").prop("disabled", true)
                $("#formtransfersubmit").toggle()
                $("#formtransferedit").toggle()
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

        let isinternal = examselect.isinternal

        let employee = <?= json_encode($employee); ?>;

        if (isinternal == 10) {
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
        } else if (isinternal == 3) {
            let visitselected = {};
            $.each(visitTransfer, function(key, value) {
                if (value.visit_id == examselect.document_id) {
                    visitselected = value
                }
            })
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td>").append((examselect.examination_date).substring(0, 16)))
                .append($("<td>").html(examselect.petugas))
                .append($("<td>").html(getFollowUpName(examselect.isinternal)))
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
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td>").append((examselect?.examination_date).substring(0, 16)))
                .append($("<td>").html(examselect?.petugas))
                .append($("<td>").html(getFollowUpName(examselect?.isinternal)))
                .append($("<td colspan=\"2\">").html(examselect?.org_id))
                .append($("<td colspan=\"2\">").html(examselect?.org_name))
                .append($("<td colspan=\"2\">").html(examselect?.name_of_clinic))
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
        } else if (isinternal == 4) {
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td>").append((examselect.examination_date).substring(0, 16)))
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
                .append($("<td>").append((examselect.examination_date).substring(0, 16)))
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

<!-- TIndak Lanjut -->
<script>
    const setDatatransfer = (bodyId1, bodyId2) => {

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


        $.each(examForassessment, function(key, value) {
            if (value.body_id == bodyId1) {
                exam1 = value
            } else if (value.body_id == bodyId2) {
                exam2 = value
            }
        })
        if (typeof(exam1.body_id) !== 'undefined')
            $.each(exam1, function(keyt, value) {
                $("#atransfer1" + keyt).val(value)
                $("#atransfer1" + keyt).prop("disabled", false)
            })
        if (typeof(exam2.body_id) !== 'undefined')
            $.each(exam2, function(keyt, value) {
                $("#atransfer2" + keyt).val(value)
                $("#atransfer2" + keyt).prop("disabled", false)
            })

        getStabilitas($("#atransferbody_id").val(), "transferDerajatBody")


        $("#transferModal").modal("show")

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
        if (typeof(exam1.body_id) !== 'undefined')
            $.each(exam1, function(keyt, value) {
                // if (keyt == 'employee_id') {
                //     $("#atransfer1employee_id").val(value)
                // }
                $("#atransfer1" + keyt).val(value)
                $("#atransfer1" + keyt).prop("disabled", false)
            })
        if (typeof(exam2.body_id) !== 'undefined')
            $.each(exam2, function(keyt, value) {
                // if (keyt == 'employee_id') {
                //     $("#atransfer2employee_id").val(value)
                // }
                $("#atransfer2" + keyt).val(value)
                $("#atransfer2" + keyt).prop("disabled", false)
            })
        if (typeof(transferselect.document_id1) !== 'undefined')
            $("#atransferbody_id1").val(transferselect.document_id1)
        if (typeof(transferselect.document_id2) !== 'undefined')
            $("#atransferbody_id2").val(transferselect.document_id2)

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

    $("#formaddatransfer1").on('submit', (function(e) {
        e.preventDefault();
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveExaminationInfo',
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
                disableTindakLanjut1
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

    $("#formaddatransfer2").on('submit', (function(e) {
        e.preventDefault();
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveExaminationInfo',
            type: "POST",
            data: new FormData(document.getElementById('formaddatransfer2')),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
                $("#form1btn").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                disableTindakLanjut2()
                // $("#formsavearpbtn").slideUp()
                // $("#formeditarp").slideDown()
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

        if (data) {
            $("#rujintvisitdate").val(data.visit_date)
            $("#rujintclinicid").val(data.clinic_id)
            $("#rujintemployeeid").val(data.employee_id)
        }
        $("#rujukInternalModal").modal("show")
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
        console.log($("#rujintclinicid").val())
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
        $("#skdptglkontrol").val(get_date())
        $("#skdpnosurat").val(null)

        const req = await libAsyncAwaitPost({
                visit: '<?= $visit['visit_id']; ?>',
                nosurat: $("#atransferdocument_id").val()
            },
            "admin/rm/assessment/getKontrol"
        );


        // coba = JSON.parse(req)
        if (req) {
            $("#skdpnosep").val(req.data.nosep)
            $("#skdpkddpjp").val(req.data.kodedokter)
            $("#skdpkdpoli").val(req.data.clinic_id)
            $("#skdptglkontrol").val(req.data.tglrenckontrol)
            $("#skdpnosurat").val(req.data.nosuratkontrol)
        }
        $("#skdpModal").modal("show")
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
        }
        $("#spriModal").modal("show")
    }

    const getSPRI = () => {
        $("#getSpriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        $("#getSpriSpriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        // alert("Get Nomor SKDP Berhasil")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/getSPRI',
            type: "POST",
            data: JSON.stringify({
                'norm': $visit['no_registration'],
                'kddpjp': $visit['kddpjp'],
                'clinic_id': $visit['clinic_id'],
                'visit_id': $visit['visit_id']
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == '200') {
                    alert('Berhasil mengambil data SPRI')
                    $("#pvspecimenno").val(data.spri)
                    $("#taspecimenno").val(data.spri)
                } else {
                    alert('tidak ada data SPRI')
                }
                $("#getSpriBtn").html('<i class="fa fa-search"></i>')
                $("#getSpriRanapBtn").html('<i class="fa fa-search"></i>')
            },
            error: function() {
                $("#getSpriBtn").html('<i class="fa fa-search"></i>')
                $("#getSpriRanapBtn").html('<i class="fa fa-search"></i>')
            }
        });
    }

    const saveSpri = () => {
        let spripasien_id = '<?= $visit['pasien_id']; ?>'
        let sprikddpjp = $("#sprikddpjp").val()
        let sprikdpoli = $("#sprikdpoli").val()
        let spritglkontrol = $("#spritglkontrol").val()
        let sprinosurat = $("#sprinosurat").val()

        if (spripasien_id == '') {
            alert('No Kartu BPJS harus diisi!')
        } else if (sprikddpjp == '' || sprikddpjp == null) {
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
                url: '<?php echo base_url(); ?>admin/pendaftaran/savespri ',
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
            dropdownParent: $("#rujukEksternalModal"),
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
        initializeDiagSelect2("ardiag_id1", diag_id, diag_name, null, "rujukEksternalModal")
        const req = await libAsyncAwaitPost({
                visit: '<?= $visit['visit_id']; ?>'
            },
            "admin/patient/getRujukan"
        );

        // coba = JSON.parse(req)
        if (req) {
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


        $("#rujukEksternalModal").modal("show")
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