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
        // $("#" + "ardiag_id1").select2({
        //     placeholder: "Input Diagnosa",
        //     dropdownParent: modalParentId,
        //     theme: 'bootstrap-5',
        //     ajax: {
        //         url: '<?= base_url(); ?>admin/patient/getDiagnosisListAjax',
        //         type: "post",
        //         dataType: 'json',
        //         delay: 50,
        //         data: function(params) {
        //             return {
        //                 searchTerm: params.term,
        //             };
        //         },
        //         processResults: function(response) {
        //             $("#" + "ardiag_id1").val(null).trigger('change');
        //             return {
        //                 results: response
        //             };
        //         },
        //         cache: true
        //     }
        // });
        if (diag_id != null) {
            var option = new Option(initialname, diag_id, true, true);
            $("#" + "ardiag_id1").append(option).trigger('change');
        }
        //end initiate diagnosa
        flatpickrInstances["flatartgl_kontrol"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );
        $("#flatartgl_kontrol").trigger("change");

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
            $("#arnmpoli_kontrol").val(datarujukan?.polirujukan_nmpoli)
            $("#arnorujukan").val(datarujukan?.nokunjungan)
            $("#ardiag_name1").val(datarujukan?.nmdiag)
            $("#argiven").val(datarujukan?.given)
            $("#arneeds").val(datarujukan?.needs)

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
            fillExaminationDetail(initialexam, 'atransfer1')
            fillExaminationDetail(initialexam, 'atransfer2')
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
        let rujcatatan = $("#atransfernotes").val()
        // let rujdiagRujukan = $("#ardiag_id1").val()
        // if (rujdiagRujukan == '' || rujdiagRujukan == null) {
        //     alert('Harus sudah mengisi diagnosa utama')
        //     return '';
        // }
        let rujdiagRujukanName = $("#ardiag_name1").val()
        // let rujdiagname = $("#ardiag_id1").find(":selected").text()
        // if (typeof rujdiagname !== 'undefined') {
        //     var rujdiagRujukanName = rujdiagname
        // }
        let rujtipeRujukan = $("#artiperujukan").val()
        // let rujpoliRujukan = $("#arkdpoli_kontrol").val()
        let rujpoliRujukanName = $("#arnmpoli_kontrol").val()
        // if (rujpoliRujukanName == '' || rujpoliRujukanName == null) {
        //     alert('Poli rujukan harus diisi')
        //     return '';
        // }
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
                // 'diagRujukan': rujdiagRujukan,
                'tipeRujukan': rujtipeRujukan,
                // 'poliRujukan': rujpoliRujukan,
                'nmPoliRujukan': rujpoliRujukanName,
                'visit': rujvisit,
                'ppkdirujukName': rujppkdirujukName,
                'diagRujukanName': rujdiagRujukanName,
                'sex': rujsex,
                'nama': rujnama,
                'nokartu': rujnokartu,
                'nomr': rujnorm,
                'status_pasien_id': '<?= $visit['status_pasien_id']; ?>',
                'formtransfer': formtransferarray,
                'given': $("#argiven").val(),
                'needs': $("#arneeds").val()
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
                    var noRujukan = data.response
                    console.log(noRujukan)
                    console.log(data)
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