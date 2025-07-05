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
            fillExaminationDetail(initialexam, 'atransfer1')
            fillExaminationDetail(initialexam, 'atransfer3')


            $("#atransfer1clinic_id").val('<?= $visit['clinic_id']; ?>')
            $("#atransfer1class_room_id").val('<?= $visit['class_room_id']; ?>')
            $("#atransfer1bed_id").val()
            $("#atransfer1keluar_id").val('<?= $visit['keluar_id']; ?>')
            $("#atransfer1employee_id").val('<?= $visit['employee_id']; ?>')
            $("#atransfer1no_registration").val('<?= $visit['no_registration']; ?>')
            $("#atransfer1visit_id").val('<?= $visit['visit_id']; ?>')
            $("#atransfer1org_unit_code").val('<?= $visit['org_unit_code']; ?>')
            $("#atransfer1doctor").val('<?= @$visit['fullname']; ?>')
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
        // enableTindakLanjut1()
        // enableTindakLanjut2()

        checkSignTransferInternal()

        // $("#transferModal").modal('show')
        $("#contentTindakLanjut").slideDown()
    }

    const openModalTransfser = (isinternal = 0) => {
        $("#transferModal").modal('show')
    }

    const checkSignTransferInternal = () => {
        if ($("#atransfersign_from").val() != '') {
            disableCpptTransfer(1)
        }
        if ($("#atransfersign_between").val() != '') {
            disableCpptTransfer(2)
        }
        if ($("#atransfersign_to").val() != '') {
            disableCpptTransfer(3)
        }
    }

    const cetakCpptTransfer = (key) => {
        let transferselect = transfer[key];

        let isinternal = transferselect.isinternal

        if (isinternal == '4') {
            openPopUpTab('<?= base_url() . 'admin/rm/medis/surat_bpjs/' . base64_encode(json_encode($visit)); ?>' + '/' + transferselect.body_id)
        } else if (isinternal == '5') {
            openPopUpTab('<?= base_url() . 'admin/rm/medis/surat_perintah/' . base64_encode(json_encode($visit)); ?>' + '/' + transferselect.body_id)
        } else if (isinternal == '2') {
            openPopUpTab('<?= base_url() . 'admin/rm/lainnya/surat_rujukan/' . base64_encode(json_encode($visit)); ?>' + '/' + transferselect.body_id)
        } else {
            openPopUpTab('<?= base_url() . 'admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>' + '/' + transferselect.body_id)
        }

        // var win = window.open('<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>' + '/' + transferselect.body_id, '_blank');
    }
    const cetakCpptTransferOnForm = () => {

        let isinternal = $("#atransferisinternal").val()
        let bodyId = $("#atransferbody_id").val()

        if (isinternal == '4') {
            openPopUpTab('<?= base_url() . 'admin/rm/medis/surat_bpjs/' . base64_encode(json_encode($visit)); ?>' + '/' + bodyId)
        } else if (isinternal == '5') {
            openPopUpTab('<?= base_url() . 'admin/rm/medis/surat_perintah/' . base64_encode(json_encode($visit)); ?>' + '/' + bodyId)
        } else if (isinternal == '2') {
            openPopUpTab('<?= base_url() . 'admin/rm/lainnya/surat_rujukan/' . base64_encode(json_encode($visit)); ?>' + '/' + bodyId)
        } else {
            openPopUpTab('<?= base_url() . 'admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>' + '/' + bodyId)
        }

        // var win = window.open('<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>' + '/' + transferselect.body_id, '_blank');
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
    const saveCpptTransfer1 = () => {
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
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                successSwal("Data berhasil disimpan")
                disableCpptTransfer(1)
            },
            error: function(xhr) { // if error occured
                errorSwal("Error occured.please try again");
            },
            complete: function() {}
        });
    }
    const saveCpptTransfer2 = () => {
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
                disableCpptTransfer(2)
            },
            error: function(xhr) { // if error occured
                errorSwal("Error occured.please try again");
            },
            complete: function() {}
        });
    }
    const saveCpptTransfer3 = () => {
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
                disableCpptTransfer(3)
            },
            error: function(xhr) { // if error occured
                errorSwal("Error occured.please try again");
            },
            complete: function() {}
        });
    }
    const enableCpptTransfer = (num) => {
        resetSignTransfer(num)
        $("#atransfer" + num + "body_id").prop("disabled", false)
        $("#atransfer" + num + "org_unit_code").prop("disabled", false)
        $("#atransfer" + num + "pasien_diagnosa_id").prop("disabled", false)
        $("#atransfer" + num + "diagnosa_id").prop("disabled", false)
        $("#atransfer" + num + "no_registration").prop("disabled", false)
        $("#atransfer" + num + "visit_id").prop("disabled", false)
        $("#atransfer" + num + "bill_id").prop("disabled", false)
        $("#atransfer" + num + "class_room_id").prop("disabled", false)
        $("#atransfer" + num + "bed_id").prop("disabled", false)
        $("#atransfer" + num + "in_date").prop("disabled", false)
        $("#atransfer" + num + "exit_date").prop("disabled", false)
        $("#atransfer" + num + "keluar_id").prop("disabled", false)
        $("#atransfer" + num + "anamnase").prop("disabled", false)
        $("#atransfer" + num + "alo_anamnase").prop("disabled", false)
        $("#atransfer" + num + "pemeriksaan").prop("disabled", false)
        $("#atransfer" + num + "teraphy_desc").prop("disabled", false)
        $("#atransfer" + num + "instruction").prop("disabled", false)
        $("#atransfer" + num + "medical_treatment").prop("disabled", false)
        $("#atransfer" + num + "description").prop("disabled", false)
        $("#atransfer" + num + "modified_date").prop("disabled", false)
        $("#atransfer" + num + "modified_by").prop("disabled", false)
        $("#atransfer" + num + "modified_from").prop("disabled", false)
        $("#atransfer" + num + "status_pasien_id").prop("disabled", false)
        $("#atransfer" + num + "ageyear").prop("disabled", false)
        $("#atransfer" + num + "agemonth").prop("disabled", false)
        $("#atransfer" + num + "ageday").prop("disabled", false)
        $("#atransfer" + num + "thename").prop("disabled", false)
        $("#atransfer" + num + "theaddress").prop("disabled", false)
        $("#atransfer" + num + "theid").prop("disabled", false)
        $("#atransfer" + num + "isrj").prop("disabled", false)
        $("#atransfer" + num + "gender").prop("disabled", false)
        $("#atransfer" + num + "doctor").prop("disabled", false)
        $("#atransfer" + num + "kal_id").prop("disabled", false)
        $("#atransfer" + num + "petugas_id").prop("disabled", false)
        $("#atransfer" + num + "petugas").prop("disabled", false)
        $("#atransfer" + num + "account_id").prop("disabled", false)
        $("#atransfer" + num + "isvalid").prop("disabled", false)
        $("#atransfer" + num + "vs_status_id").prop("disabled", false)
        $("#atransfer" + num + "valid_date").prop("disabled", false)
        $("#atransfer" + num + "valid_user").prop("disabled", false)
        $("#atransfer" + num + "valid_pasien").prop("disabled", false)
        $("#atransfer" + num + "petugas_type").prop("disabled", false)

        $("#formsavetransferid-" + num).show()
        $("#formedittransferid-" + num).hide()

        qrCodeGenerateSignTransfer(num)
    }
    const disableCpptTransfer = (num) => {
        resetSignTransfer(num)
        $("#atransfer" + num + "body_id").prop("disabled", true)
        $("#atransfer" + num + "org_unit_code").prop("disabled", true)
        $("#atransfer" + num + "pasien_diagnosa_id").prop("disabled", true)
        $("#atransfer" + num + "diagnosa_id").prop("disabled", true)
        $("#atransfer" + num + "no_registration").prop("disabled", true)
        $("#atransfer" + num + "visit_id").prop("disabled", true)
        $("#atransfer" + num + "bill_id").prop("disabled", true)
        $("#atransfer" + num + "class_room_id").prop("disabled", true)
        $("#atransfer" + num + "bed_id").prop("disabled", true)
        $("#atransfer" + num + "in_date").prop("disabled", true)
        $("#atransfer" + num + "exit_date").prop("disabled", true)
        $("#atransfer" + num + "keluar_id").prop("disabled", true)
        $("#atransfer" + num + "anamnase").prop("disabled", true)
        $("#atransfer" + num + "alo_anamnase").prop("disabled", true)
        $("#atransfer" + num + "pemeriksaan").prop("disabled", true)
        $("#atransfer" + num + "teraphy_desc").prop("disabled", true)
        $("#atransfer" + num + "instruction").prop("disabled", true)
        $("#atransfer" + num + "medical_treatment").prop("disabled", true)
        $("#atransfer" + num + "description").prop("disabled", true)
        $("#atransfer" + num + "modified_date").prop("disabled", true)
        $("#atransfer" + num + "modified_by").prop("disabled", true)
        $("#atransfer" + num + "modified_from").prop("disabled", true)
        $("#atransfer" + num + "status_pasien_id").prop("disabled", true)
        $("#atransfer" + num + "ageyear").prop("disabled", true)
        $("#atransfer" + num + "agemonth").prop("disabled", true)
        $("#atransfer" + num + "ageday").prop("disabled", true)
        $("#atransfer" + num + "thename").prop("disabled", true)
        $("#atransfer" + num + "theaddress").prop("disabled", true)
        $("#atransfer" + num + "theid").prop("disabled", true)
        $("#atransfer" + num + "isrj").prop("disabled", true)
        $("#atransfer" + num + "gender").prop("disabled", true)
        $("#atransfer" + num + "doctor").prop("disabled", true)
        $("#atransfer" + num + "kal_id").prop("disabled", true)
        $("#atransfer" + num + "petugas_id").prop("disabled", true)
        $("#atransfer" + num + "petugas").prop("disabled", true)
        $("#atransfer" + num + "account_id").prop("disabled", true)
        $("#atransfer" + num + "isvalid").prop("disabled", true)
        $("#atransfer" + num + "vs_status_id").prop("disabled", true)
        $("#atransfer" + num + "valid_date").prop("disabled", true)
        $("#atransfer" + num + "valid_user").prop("disabled", true)
        $("#atransfer" + num + "valid_pasien").prop("disabled", true)
        $("#atransfer" + num + "petugas_type").prop("disabled", true)

        $("#formsavetransferid-" + num).hide()
        $("#formedittransferid-" + num).show()

        qrCodeGenerateSignTransfer(num)
    }

    const resetSignTransfer = (num) => {
        if (num == 1) {
            document.getElementById("formtransferqrcode-from").innerHTML = "";
            document.getElementById("formtransfersigner-from").innerHTML = "";
            document.getElementById("formtransferqrcode-from_1").innerHTML = "";
            document.getElementById("formtransfersigner-from_1").innerHTML = "";
        }
        if (num == 3) {
            document.getElementById("formtransferqrcode-to").innerHTML = "";
            document.getElementById("formtransfersigner-to").innerHTML = "";
            document.getElementById("formtransferqrcode-to_1").innerHTML = "";
            document.getElementById("formtransfersigner-to_1").innerHTML = "";
        }
        // $("#formtransferqrcode" + num).html("")
        // $("#formtransfersigner" + num).html("")
        // $("#atransfer" + num + "groupbutton").show()
    }
    const qrCodeGenerateSignTransfer = (num) => {
        if (num == 1) {
            if ($("#atransfersign_from").val() != '') {
                $("#formsignatransferid-from").hide()
                let qrcode = new QRCode(document.getElementById(
                    "formtransferqrcode-from"), {
                    text: $("#atransfersign_from").val(),
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
                $("#formtransfersigner-from").html($("#atransferfrom_petugas").val())
            } else {
                $("#formsignatransferid-from").show()
                document.getElementById("formtransferqrcode-from").innerHTML = "";
                document.getElementById("formtransfersigner-from").innerHTML = "";
            }
            if ($("#atransfersign_from_1").val() != '') {
                $("#formsignatransferid-from_1").hide()
                let qrcode = new QRCode(document.getElementById(
                    "formtransferqrcode-from_1"), {
                    text: $("#atransfersign_from").val(),
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
                $("#formtransfersigner-from_1").html($("#atransferfrom_petugas_1").val())
            } else {
                $("#formsignatransferid-from_1").show()
                document.getElementById("formtransferqrcode-from_1").innerHTML = "";
                document.getElementById("formtransfersigner-from_1").innerHTML = "";
            }
        }
        if (num == 2)
            if ($("#atransfersign_between").val() != '') {
                $("#atransfer2groupbutton").hide()

                let qrcode = new QRCode(document.getElementById(
                    "formtransferqrcode2"), {
                    text: $("#atransfersign_between").val(),
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            } else {
                $("#atransfer2groupbutton").show()
                document.getElementById("formtransferqrcode2").innerHTML = "";
            }
        if (num == 3) {
            if ($("#atransfersign_to").val() != '') {
                $("#formsignatransferid-to").hide()

                let qrcode = new QRCode(document.getElementById(
                    "formtransferqrcode-to"), {
                    text: $("#atransfersign_to").val(),
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
                $("#formtransfersigner-to").html($("#atransferto_petugas_id").val())
            } else {
                $("#formsignatransferid-to").show()
                document.getElementById("formtransferqrcode-to").innerHTML = "";
                document.getElementById("formtransfersigner-to").innerHTML = "";
            }
            if ($("#atransfersign_to_1").val() != '') {
                $("#formsignatransferid-to_1").hide()

                let qrcode = new QRCode(document.getElementById(
                    "formtransferqrcode-to_1"), {
                    text: $("#atransfersign_to_1").val(),
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
                $("#formtransfersigner-to_1").html($("#atransferto_petugas_id_1").val())
            } else {
                $("#formsignatransferid-to_1").show()
                document.getElementById("formtransferqrcode-to_1").innerHTML = "";
                document.getElementById("formtransfersigner-to_1").innerHTML = "";
            }
        }
    }
    $("#atransfersign_from").on("change", function() {})
    $("#formsignatransferid-from").off().on("click", function() {
        // $("#atransferfrom_petugas_id").val('<?= user()->username; ?>')
        // $("#atransferfrom_petugas").val('<?= user()->getFullname(); ?>')
        addSignUser("formaddatransfer", "atransfer", "atransferbody_id", "formsaveatransferbtnid", 11, 1, 2, $("#atransferisinternal option:selected").text(), "sign_from")
    })
    $("#formsignatransferid-from_1").off().on("click", function() {
        // $("#atransferfrom_petugas_id_1").val('<?= user()->username; ?>')
        // $("#atransferfrom_petugas_1").val('<?= user()->getFullname(); ?>')
        addSignUser("formaddatransfer", "atransfer", "atransferbody_id", "formsaveatransferbtnid", 11, 1, 3, $("#atransferisinternal option:selected").text(), "sign_from_1")
    })
    $("#formsignatransferid-2").off().on("click", function() {
        // $("#atransferbetween_petugas_id").val('<?= user()->username; ?>')
        // $("#atransferbetween_petugas").val('<?= user()->getFullname(); ?>')
        addSignUser("formaddatransfer", "atransfer", "atransferbody_id", "formsaveatransferbtnid", 11, 1, 4, $("#atransferisinternal option:selected").text(), "sign_between")
    })
    $("#formsignatransferid-to").off().on("click", function() {
        // $("#atransferto_petugas_id").val('<?= user()->username; ?>')
        // $("#atransferto_petugas").val('<?= user()->getFullname(); ?>')
        addSignUser("formaddatransfer", "atransfer", "atransferbody_id", "formsaveatransferbtnid", 11, 1, 6, $("#atransferisinternal option:selected").text(), "sign_to")
    })
    $("#formsignatransferid-to_1").off().on("click", function() {
        // $("#atransferto_petugas_id_1").val('<?= user()->username; ?>')
        // $("#atransferto_petugas_1").val('<?= user()->getFullname(); ?>')
        addSignUser("formaddatransfer", "atransfer", "atransferbody_id", "formsaveatransferbtnid", 11, 1, 7, $("#atransferisinternal option:selected").text(), "sign_to_1")
    })
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