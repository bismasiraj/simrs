<!-- Dokumen tindak lanjut -->
<script type='text/javascript'>
    let transfer = <?= json_encode($exam); ?>;
    let exam1 = [];
    let exam2 = [];
    let exam3 = [];
    let transferdesc = []
    let visitTransfer = []
    let clinicDoctors = [];
    let transferCurrentState = 0;
    var i = 0
    $("#transferTab").on("click", function() {
        transferCurrentState = 4
        getTindakLanjut()
        setDataTindakLanjut()
        transferInternalOptionList(transferCurrentState)
        $("#atransferisinternal").val(transferCurrentState).trigger("change")
    })
    $("#konsulInternalTab").on("click", function() {
        transferCurrentState = 3
        getTindakLanjut()
        setDataTindakLanjut()
        transferInternalOptionList(transferCurrentState)
        $("#atransferisinternal").val(transferCurrentState).trigger("change")
    })

    const transferInternalOptionList = (props) => {
        if (props == 4) {
            $("#atransferisinternal").html(` <?php if (user()->checkPermission("assessmentmedis", "c")) {
                                                    if (true) { ?>
                                                    <option value="4">PERAWATAN JALAN (KONTROL)</option>
                                                    <option value="2">RUJUK EKSTERNAL</option>
                                                    <option value="5">RAWAT INAP</option>
                                                    <option value="10">TRANSFER INTERNAL</option>
                                                    <option value="11">Pengobatan Selesai</option>
                                                    <option value="12">D.O.A</option>
                                                    <option value="13">Meninggal di IGD</option>
                                                    <option value="14">Meninggal < 24 Jam</option>
                                                    <option value="15">Meninggal < 48 Jam</option>
                                                    <option value="16">Meninggal > 48 Jam</option>
                                                    <option value="17">APS</option>
                                                <?php }
                                                } else {
                                                ?>
                                                <option value="4" disabled>PERAWATAN JALAN (KONTROL)</option>
                                                <option value="2" disabled>RUJUK EKSTERNAL</option>
                                                <option value="5" disabled>RAWAT INAP</option>
                                                <option value="10">TRANSFER INTERNAL</option>
                                                <option value="11">Pengobatan Selesai</option>
                                                <option value="12">D.O.A</option>
                                                <option value="13">Meninggal di IGD</option>
                                                <option value="14">Meninggal < 24 Jam</option>
                                                <option value="15">Meninggal < 48 Jam</option>
                                                <option value="16">Meninggal > 48 Jam</option>
                                                <option value="17">APS</option>
                                            <?php
                                                } ?>`)
        } else if (props == 3) {
            $("#atransferisinternal").html(` <?php if (user()->checkPermission("assessmentmedis", "c")) {
                                                    if (true) { ?>
                                                    <option value="3">RUJUK INTERNAL</option>
                                                <?php }
                                                } else {
                                                ?>
                                                <option value="3" disabled>RUJUK INTERNAL</option>
                                            <?php
                                                } ?>`)
        }
    }

    const setDataTindakLanjut = (data = null) => {
        $("#formaddatransfer").find("input, textarea").val(null)
        $("#formtransferqrcode").html("")

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
        $("#atransferclinic_id").val('<?= $visit['clinic_id']; ?>')


        if (visit?.isrj == '0') {
            $("#atransferemployee_id").val(visit?.employee_inap ?? '<?= user()->employee_id; ?>')
        } else {
            $("#atransferemployee_id").val(visit?.employee_id ?? '<?= user()->employee_id; ?>')
        }
        if ($("#atransferemployee_id").val() == null || $("#atransferemployee_id").val() == '') {
            $("#atransferemployee_id").val(new Option('<?= user()->getFullname(); ?>', '<?= user()->username; ?>'))

        }

        // alert($("#atransferemployee_id").val())

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
        let clinic_id = clinicDoctors.filter(item => item?.employee_id == dokter)
        console.log(dokter)
        console.log(clinic_id)
        $("#sprikdpoli").val(clinic_id[0]?.clinic_id)
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
        $("#formtransferqrcode").html("")
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
        await checkSignSignature("formaddatransfer", "atransferbody_id", "formsaveatransferbtnid", 11)

        if ($("#atransfervalid_user").val() != '' && $("#atransfervalid_user").val() != null) {
            $("#formsaveatransferbtnid").slideUp()
            $("#formeditatransferid").slideUp()
            $("#formsignatransferid").slideUp()
            let qrcode = new QRCode(document.getElementById(
                "formtransferqrcode"), {
                text: $("#atransfervalid_user").val(),
                width: 128,
                height: 128,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            $("#formaddatransfer").find("input, select, textarea").prop("disabled", true)
        } else {
            $("#formtransferqrcode").html("")
            $("#formsaveatransferbtnid").slideDown()
            $("#formeditatransferid").slideUp()
            $("#formsignatransferid").slideUp()
            $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)
        }
    }

    const deleteTindakLanjut = () => {
        let isinternal = $("#atransferisinternal").val()
        deleteById($("#atransferbody_id").val(), 11, (res) => {
            console.log(res)
            if (res.response) {
                console.log('masuk')
                console.log(isinternal)

                if (isinternal == 10) { //TRANSFER INTERNAL

                    deleteByIdNoSwal($("#atransferdocument_id").val(), 3, (res) => {})
                    deleteByIdNoSwal($("#atransferdocument_id3").val(), 3, (res) => {})
                } else if (isinternal == 3) { //RUJUK INTERNAL OTHER POLI
                    // $("label[for='atransfernotes']").text("Alasan Konsul Internal");
                    // $("label[for='atransferother_notes']").text("Keterangan lain");

                    // let visitselected = {};
                    // $.each(visitTransfer, function(key, value) {
                    //     if (value.visit_id == $("#atransferdocument_id").val()) {
                    //         visitselected = value
                    //     }
                    // })
                    // $("#atransferservice_needs_group").slideUp()
                    // await setDataRujukInternal(visitselected)

                } else if (isinternal == 2) { //RUJUK EKSTERNAL
                    deleteByIdNoSwal(visit.visit_id, 21, (res) => {
                        $("#transferTab").trigger("click")
                    })

                    deleteByIdNoSwal($("#atransferdocument_id").val(), 3, (res) => {})
                    deleteByIdNoSwal($("#atransferdocument_id2").val(), 3, (res) => {})
                    deleteByIdNoSwal($("#atransferdocument_id3").val(), 3, (res) => {})
                } else if (isinternal == 4) { //PERAWATAN JALAN (KONTROL) POLI SAMA
                    console.log('masukskdp')
                    console.log($("#skdpnoskdp_rs").val())
                    deleteByIdNoSwal($("#skdpnoskdp_rs").val(), 20, (res) => {
                        deleteSkdp()
                        $("#transferTab").trigger("click")
                    })
                } else if (isinternal == 5) { //RAWAT INAP (SPRI)
                    deleteByIdNoSwal($("#skdpnoskdp_rs").val(), 20, (res) => {
                        $("#transferTab").trigger("click")
                    })
                }
                successSwal('Data berhasil Dihapus.');
            } else {
                errorSwal("Gagal Di hapus")
            }
        })
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

        if (isinternal == 10) { //TRANSFER INTERNAL
            $("label[for='atransfernotes']").text("Alasan Transfer Internal");
            $("label[for='atransferother_notes']").text("Keterangan lain");

            $("#atransferservice_needs_group").slideUp()
            $("#atransferclinic_id_group").slideDown()
            $("#atransferclinic_id_to_group").slideDown()
            $("#atransferstabilitas").slideDown()
            $("#atransferinternal").slideDown()
            enableCpptTransfer(1)
            enableCpptTransfer(2)
            enableCpptTransfer(3)
            setDatatransfer($("#atransferdocument_id").val(), $("#atransferdocument_id3").val())
        } else if (isinternal == 3) { //RUJUK INTERNAL OTHER POLI
            $("label[for='atransfernotes']").text("Alasan Konsul Internal");
            $("label[for='atransferother_notes']").text("Keterangan lain");

            let visitselected = {};
            $.each(visitTransfer, function(key, value) {
                if (value.visit_id == $("#atransferdocument_id").val()) {
                    visitselected = value
                }
            })
            $("#atransferservice_needs_group").slideUp()
            await setDataRujukInternal(visitselected)

        } else if (isinternal == 2) { //RUJUK EKSTERNAL
            $("label[for='atransfernotes']").text("Alasan Dirujuk");
            $("label[for='atransferother_notes']").text("Keterangan lain");
            $("#atransferservice_needs_group").slideUp()
            await setDataRujukEksternal()
            enableCpptTransfer(1)
            enableCpptTransfer(2)
            enableCpptTransfer(3)
            setDataCpptEksternal($("#atransferdocument_id").val(), $("#atransferdocument_id2").val(), $("#atransferdocument_id3").val())
            if (visit.isrj == '0')
                $("#atransferinternal").slideDown()
            else
                $("#atransferinternal").slideUp()
        } else if (isinternal == 4) { //PERAWATAN JALAN (KONTROL) POLI SAMA
            $("label[for='atransfernotes']").text("Alasan Kontrol");
            $("label[for='atransferother_notes']").text("Keterangan lain");
            $("#atransferservice_needs_group").slideUp()
            $("#atransferinternal").slideUp()
            $("#atransferskdpgroup").slideDown()
            await setDataSkdp()
        } else if (isinternal == 5) { //RAWAT INAP (SPRI)
            $("label[for='atransfernotes']").text("Alasan Rawat Inap");
            $("label[for='atransferother_notes']").text("Advice Dokter");
            $("#atransferservice_needs_group").slideDown()
            await setDataSpri()
        } else {
            $("label[for='atransfernotes']").text("Alasan");
            $("label[for='atransferother_notes']").text("Keterangan lain");
            $("#atransferservice_needs_group").slideUp()
            $("#formakomodasiatransferid").slideDown()
        }
        $("#formopenmodaltransferid").html('<i class="fa fa-plus"></i> <span>Detail</span>')
    }

    const disableTindakLanjut = () => {
        // $("#formaddatransfer").find("input, select, textarea").not("#atransferinternal input, #atransferinternal select, #atransferinternal textarea").prop("disabled", true)
        $("#atransferisinternal_group").prop("readonly", true)

        $("#formtransfersubmit").slideUp()
        $("#formtransferedit").slideDown()
        if ($("#atransfervalid_user").val() != '' && $("#atransfervalid_user").val() != null) {
            $("#formsaveatransferbtnid").slideUp()
            $("#formeditatransferid").slideUp()
            $("#formsignatransferid").slideUp()
            $("#formcetakatransferid").slideDown()
        } else {
            $("#formsaveatransferbtnid").slideUp()
            $("#formeditatransferid").slideDown()
            $("#formsignatransferid").slideDown()
            $("#formcetakatransferid").slideDown()
            $("#formdeleteatransferid").slideDown()
        }
        $("#formaddatransfer").find("input, select, textarea").not("#atransferinternal input, #atransferinternal select, #atransferinternal textarea").prop("disabled", true)
        checkSignTransferInternal()
    }

    const enableTindakLanjut = () => {
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)


        // $("#formsaveatransferbtnid").slideDown()
        if ($("#atransfervalid_user").val() != '' && $("#atransfervalid_user").val() != null) {
            $("#formsaveatransferbtnid").slideUp()
            $("#formeditatransferid").slideUp()
            $("#formsignatransferid").slideUp()
            $("#formdeleteatransferid").slideUp()
            $("#formaddatransfer").find("input, select, textarea").prop("disabled", true)
            $("#formcetakatransferid").slideDown()
        } else {
            $("#formsaveatransferbtnid").slideDown()
            $("#formeditatransferid").slideUp()
            $("#formsignatransferid").slideDown()
            $("#formdeleteatransferid").slideDown()
            $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)
            $("#formcetakatransferid").slideUp()
        }
        // $("#formeditatransferid").slideUp()
        // $("#formsignatransferid").slideUp()
        $("#formaddatransfer").find("input, select, textarea").prop("disabled", false)

        checkSignTransferInternal()

    }

    const signTindakLanjut = () => {
        //addSignUserSatelite = (formId, container, body_id, primaryKey, buttonId, docs_type, user_type, sign_ke = 1,title)
        addSignUser("formaddatransfer", "atransfer", "atransferbody_id", "formsaveatransferbtnid", 11, 1, 1, $("#atransferisinternal option:selected").text())
    }
    //ini untuk save tindak lanjut
    $("#formaddatransfer").on('submit', (function(e) {
        let followup = $("#atransferisinternal").val()
        if (followup == '') {
            alert("Followup tidak boleh kosong")
            $("#atransferisinternal").focus()
            return false;
        }
        let alasan = $("#atransfernotes").val()
        if (alasan == '') {
            alert("Alasan tidak boleh kosong")
            $("#atransfernotes").focus()
            return false;
        }
        let doktertransfer = $("#atransferemployee_id").val()
        if (doktertransfer == '' || doktertransfer == null) {
            alert("Dokter DPJP belum ditentukan, silahkan mengisi Asesmen Medis terlebih dahulu atau hubungi pihak admisi")
            $("#atransferemployee_id").focus()
            return false;
        }
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        clicked_submit_btn.html('<i class="spinner-border spinner-border-sm"></i>')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/tindaklanjut/saveTransfer',
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
            saveCpptTransfer1()
            saveCpptTransfer3()
        }
        if (isinternal == 3) {
            postRujukInternal()
        }
        if (isinternal == 2) {
            postRujukan()
            if (visit.isrj == '0')
                saveCpptTransfer()
            saveCpptTransfer1()
            saveCpptTransfer2()
            saveCpptTransfer3()
        }
        if (isinternal == 4) {
            saveSkdp()
        }
        if (isinternal == 5) {
            saveSpri()
        }
        updateWaktu(5)
    }));
    //ini untuk edit tindak lanjut
    $("#formeditatransferid").on("click", function() {
        $("#formaddatransfer").find("input, textarea, select").prop("disabled", false)
    })

    const checkCpptTindakLanjut = () => {
        postData({
            visit_id: visit?.visit_id,
            username: '<?= user()->username; ?>'
        }, 'admin/tindaklanjut/checkcppt', (res) => {
            var userPreference;

            if (confirm(res?.cppt) == true) {

            } else {
                $("#cpptTab").trigger("click")
            }
        })
    }

    const getTindakLanjut = () => {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/tindaklanjut/getTransfer',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit.visit_id,
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
                    if (transferCurrentState == 4)
                        if (transfer[key].isinternal != 3)
                            addRowHistoryTL(transfer[key], key)
                    if (transferCurrentState == 3)
                        if (transfer[key].isinternal == 3)
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
                    exam1 = value
                } else if (value.body_id == examselect.document_id2) {
                    exam2 = value
                } else if (value.body_id == examselect.document_id3) {
                    exam3 = value
                }
            })
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td rowspan='3'>").append(formatedDatetimeFlat(examselect?.examination_date)))
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
                .append($("<td rowspan='3'>").html(''))
                // .append($("<td rowspan='3'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger d-none" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
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
                    // '<button type="button" onclick="cetakCpptTransfer(' + key + ')" class="btn btn-light" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Cetak</i></button>' +
                    '</div>'))
                .append($("<td>").html(''))
                // .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
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
            if (visit.isrj == '0') {
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
                    .append($("<td rowspan='4'>").html(''))
                    // .append($("<td rowspan='4'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
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
            } else {
                $("#transferBodyHistory").append($("<tr>")
                    .append($("<td>").append(formatedDatetimeFlat(examselect.examination_date)))
                    .append($("<td>").html(examselect.petugas))
                    .append($("<td colspan='7'>").html(getFollowUpName(examselect.isinternal)))
                    // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                    // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                    // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                    // .append($("<td>").html('<b>Nafas/RR</b>'))
                    // .append($("<td>").html('<b>Temp</b>'))
                    // .append($("<td>").html('<b>SpO2</b>'))
                    .append($("<td>").html('<div class="btn-group-vertical">' +
                        '<button type="button" onclick="copytransfer(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                        '<button type="button" onclick="editDataTindakLanjut(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>' +
                        '<button type="button" onclick="cetakCpptTransfer(' + key + ')" class="btn btn-light" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Cetak</i></button>' +
                        '</div>'))
                    .append($("<td>").html(''))
                    // .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
                )
            }
        } else if (isinternal == 4) {
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td>").append(formatedDatetimeFlat(examselect.examination_date)))
                .append($("<td>").html(examselect.petugas))
                .append($("<td colspan='7'>").html(getFollowUpName(examselect.isinternal)))
                // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td>").html('<b>Nafas/RR</b>'))
                // .append($("<td>").html('<b>Temp</b>'))
                // .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td>").html('<div class="btn-group-vertical">' +
                    '<button type="button" onclick="copytransfer(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editDataTindakLanjut(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>' +
                    '<button type="button" onclick="cetakCpptTransfer(' + key + ')" class="btn btn-light" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Cetak</i></button>' +
                    '</div>'))
                .append($("<td>").html(''))
                // .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
        } else if (isinternal == 5) {
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td>").append(formatedDatetimeFlat(examselect.examination_date)))
                .append($("<td>").html(examselect.petugas))
                .append($("<td colspan='7'>").html(getFollowUpName(examselect.isinternal)))
                // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td>").html('<b>Nafas/RR</b>'))
                // .append($("<td>").html('<b>Temp</b>'))
                // .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td>").html('<div class="btn-group-vertical">' +
                    '<button type="button" onclick="copytransfer(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editDataTindakLanjut(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>' +
                    '<button type="button" onclick="cetakCpptTransfer(' + key + ')" class="btn btn-light" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Cetak</i></button>' +
                    '</div>'))
                .append($("<td>").html(''))
                // .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
        } else {
            $("#transferBodyHistory").append($("<tr>")
                .append($("<td>").append(formatedDatetimeFlat(examselect.examination_date)))
                .append($("<td>").html(examselect.petugas))
                .append($("<td colspan='7'>").html(getFollowUpName(examselect.isinternal)))
                // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td colspan=\"2\">").html(examselect.isinternal))
                // .append($("<td>").html('<b>Nafas/RR</b>'))
                // .append($("<td>").html('<b>Temp</b>'))
                // .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td>").html('<div class="btn-group-vertical">' +
                    '<button type="button" onclick="copytransfer(' + key + ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editDataTindakLanjut(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>' +
                    // '<button type="button" onclick="cetakCpptTransfer(' + key + ')" class="btn btn-light" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Cetak</i></button>' +
                    '</div>'))
                .append($("<td>").html(''))
                // .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
            )
        }
    }
</script>

<!-- TRANSFER INTERNAL -->
<?php echo view('admin/patient/profilemodul/jsprofile/transfer/transferinternal_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
]); ?>




<!-- KONSUL INTERNAL -->
<?php echo view('admin/patient/profilemodul/jsprofile/transfer/konsulinternal_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
]); ?>

<!-- SKDP -->
<?php echo view('admin/patient/profilemodul/jsprofile/transfer/skdp_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
]); ?>

<!-- SPRI -->
<?php echo view('admin/patient/profilemodul/jsprofile/transfer/spri_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
]); ?>

<!-- RUJUKAN -->
<?php echo view('admin/patient/profilemodul/jsprofile/transfer/rujukan_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
]); ?>

<!-- AKOMODASI -->
<?php echo view('admin/patient/profilemodul/jsprofile/transfer/akomodasi_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
]); ?>


<!-- Harusnya ga dipake -->
<!-- <script>
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
</script> -->