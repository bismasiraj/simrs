<?php
$aValueParent = array();
foreach ($aValue as $key => $value) {
    $aValueParent[$value['parameter_id']]['parameter_id'] = $value['parameter_id'];
    $aValueParent[$value['parameter_id']]['p_type'] = $value['p_type'];
}
?>
<script type="text/javascript">
    $(document).ready(function(e) {





        $("#aigdexamination_date").val(get_date())

        // armstanding_ordereditor.init({
        //     selector: '#arpeducation_material'
        // });
        // tinymce.init({
        //     selector: '#arpeducation_material'
        // });
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode(@$visit)); ?>/' + $("#armbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_neonatus/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Jalan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Diagnosis Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Hak dan Kewajiban Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Implementasi Asuhan Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Inform Concern (Pemasangan Infus)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Nyeri</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode(@$visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Transfer Internal</a></li>')
    })



    $("#arpdweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arpdheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arpdtemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arpdnadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arpdtension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arpdtension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arpdsaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arpdnafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arpdarm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });

    // $("#cpptTab").on("click", function() {
    //     $("#arpTitle").html("CPPT")
    //     $("#arpanamnase_label").html("Subyektif (S)")
    //     $("#collapseRiwayat").slideUp()
    //     $("#groupRiwayat").slideUp()
    //     // $("#subjectiveGroupHeader").slideDown()
    //     $("#objectiveGroupHeader").slideDown()
    //     $("#arpFallRisk_Group").slideDown()
    //     $("#arpPainMonitoring_Group").slideUp()
    //     $("#arpTriage_Group").slideUp()
    //     $("#arpApgar_Group").slideUp()
    //     $("#arpGizi_Group").slideUp()
    //     $("#arpAdl_Group").slideUp()
    //     $("#arpDekubitus_Group").slideUp()
    //     $("#arpStabilitas_Group").slideUp()
    //     $("#arpEdukasiIntegrasi_Group").slideUp()
    //     $("#arpEdukasiForm_Group").slideUp()
    //     $("#arpGcs_Group").slideDown()
    //     $("#arpIntegumen_Group").slideUp()
    //     $("#arpNeurosensoris_Group").slideUp()
    //     $("#arpPencernaan_Group").slideUp()
    //     $("#arpPerkemihan_Group").slideUp()
    //     $("#arpPernapasan_Group").slideUp()
    //     $("#arpPsikologi_Group").slideUp()
    //     $("#arpSeksual_Group").slideUp()
    //     $("#arpSirkulasi_Group").slideUp()
    //     $("#arpSocial_Group").slideUp()
    //     $("#arpHearing_Group").slideUp()
    //     $("#arpSleeping_Group").slideUp()
    //     $("#arpTindakanKolaboratif_Group").slideDown()
    //     $("#arpTindakanMandiri_Group").slideDown()
    //     $("#arpImplementasi_Group").slideUp()
    // })
    $("#assessmentigdTab").on("mouseup", function() {
        $("#arpTitle").html("Asesmen Keperawatan")

        $("#arpanamnase_label").html("Subyektif (S)")
        $("#collapseRiwayat").slideDown()
        $("#groupRiwayat").slideDown()
        // $("#subjectiveGroupHeader").slideDown()
        $("#objectiveGroupHeader").slideDown()
        $("#arpFallRisk_Group").slideDown()
        $("#arpPainMonitoring_Group").slideDown()
        $("#arpTriage_Group").slideDown()
        $("#bodyTriagePerawat").html("")
        $("#arpApgar_Group").slideDown()
        $("#arpGizi_Group").slideDown()
        $("#arpAdl_Group").slideDown()
        $("#arpDekubitus_Group").slideDown()
        $("#arpStabilitas_Group").slideDown()
        $("#arpEdukasiIntegrasi_Group").slideDown()
        $("#arpEdukasiForm_Group").slideDown()
        $("#arpGcs_Group").slideDown()
        $("#arpIntegumen_Group").slideDown()
        $("#arpNeurosensoris_Group").slideDown()
        $("#arpPencernaan_Group").slideDown()
        $("#arpPerkemihan_Group").slideDown()
        $("#arpPernapasan_Group").slideDown()
        $("#arpPsikologi_Group").slideDown()
        $("#arpSeksual_Group").slideDown()
        $("#arpSirkulasi_Group").slideDown()
        $("#arpSocial_Group").slideDown()
        $("#arpHearing_Group").slideDown()
        $("#arpSleeping_Group").slideDown()
        $("#arpTindakanKolaboratif_Group").slideDown()
        $("#arpTindakanMandiri_Group").slideDown()
        $("#arpImplementasi_Group").slideDown()

        // initialAddArp()
        generateSatelite()
        getAssessmentKeperawatan()
        getTindakanPerawat()
    })
</script>

<script type="text/javascript">
    $(".formsavearpbtn").on('click', (function(e) {
        var data = [];

        let docDataRm = new FormData(document.getElementById("formaddarp"))
        let docDataObjectRm = {};
        docDataRm.forEach(function(value, key) {
            if (key.includes("[]")) {
                if (typeof docDataObjectRm[key.replace("[]", "")] !== 'undefined' && docDataObjectRm[key.replace("[]", "")] !== null) {
                    docDataObjectRm[key.replace("[]", "")].push(value)
                } else {
                    docDataObjectRm[key.replace("[]", "")] = [value]
                }
            } else {
                docDataObjectRm[key] = value
            }
        });
        let newObjRm = {
            id: "formaddarp",
            data: docDataObjectRm
        };
        data.push(newObjRm)

        $("#formaddarp").find(".satelite").each(function() {
            let element = document.getElementById($(this).attr("id"))
            if (element instanceof HTMLFormElement) {
                let docData = new FormData(element)
                let docDataObject = {};
                docData.forEach(function(value, key) {
                    if (key.includes("[]")) {
                        if (typeof docDataObject[key.replace("[]", "")] !== 'undefined' && docDataObject[key.replace("[]", "")] !== null) {
                            docDataObject[key.replace("[]", "")].push(value)
                        } else {
                            docDataObject[key.replace("[]", "")] = [value]
                        }
                    } else {
                        docDataObject[key] = value
                    }
                });
                let newObj = {
                    id: $(this).attr("id"),
                    data: docDataObject
                };
                data.push(newObj)
            } else {
                console.log($(this).attr("id"));
            }

        })

        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessmentperawat/saveExaminationInfo',
            type: "POST",
            // data: 

            data: JSON.stringify(data),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#formsavearpbtnid").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                $("#formsavearpbtnid").html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)

                // $("#formaddarp").find('input, select, textarea').each(function() {
                //     const key = $(this).attr('id'); // Use ID or placeholder as key

                //     localStorage.removeItem(key);
                // })
                // $("#arpModal").modal("hide")
                // let formData = new FormData(document.getElementById("formaddarp"))
                let formDataObject = {};
                // formData.forEach(function(value, key) {
                //     formDataObject[key] = value
                // });
                formDataObject = data.perawat
                var isNewDocument = 0

                console.log(formDataObject)
                $.each(examForassessment, function(key, value) {
                    if (value.body_id == formDataObject.body_id) {
                        examForassessment[key] = formDataObject
                        isNewDocument = 1
                    }
                })
                if (isNewDocument != 1) {
                    let examNew = Array();
                    examNew.push(formDataObject)
                    $.each(examForassessment, function(key, value) {
                        examNew.push(examForassessment[key])
                    })
                    examForassessment = examNew
                }

                $.each(examForassessmentDetail, function(key, value) {
                    if (value.body_id == formDataObject.body_id) {
                        examForassessmentDetail[key] = formDataObject
                        isNewDocument = 1
                    }
                })
                if (isNewDocument != 1) {
                    let examNew = Array();
                    examNew.push(formDataObject)
                    $.each(examForassessmentDetail, function(key, value) {
                        examNew.push(examForassessmentDetail[key])
                    })
                    examForassessmentDetail = examNew
                }

                // $("#cpptBody").html("")
                let examFiltered145 = examForassessment.filter(item => item.account_id == 2)
                if (examFiltered145.length > 0) {
                    // fillDataArp(examFiltered145.length - 1)
                    // $("#arpAddDocument").slideUp()
                    $("#arpDocument").slideDown()
                }

                if (examForassessment.length > 0) {
                    displayTableAssessmentKeperawatan();
                    // displayTableAssessmentKeperawatanForVitalSign();
                }

                riwayatAll = data.perawat.pasienHistory


                disableARP()

                fillRiwayatArp()
                $("#formsavearpbtnid").html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $(".formsavearpbtn").html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
                errorSwal(xhr);
            },
            complete: function() {
                $("#formsavearpbtnid").button(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
                // clicked_submit_btn.button('reset');
            }
        });
    }));
    // $(".formsavearpbtn").on('click', (function(e) {
    //     $("#formaddarp").find("button.btn-save:visible").trigger("click")
    //     let clicked_submit_btn = $(this).closest('form').find(':submit');
    //     e.preventDefault();
    //     $.ajax({
    //         url: '<?php echo base_url(); ?>admin/rm/assessment/saveExaminationInfo',
    //         type: "POST",
    //         // data: 

    //         data: new FormData(document.getElementById('formaddarp')),
    //         dataType: 'json',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         beforeSend: function() {
    //             $(".formsavearpbtn").html('<i class="spinner-border spinner-border-sm"></i>')
    //         },
    //         success: function(data) {
    //             $("#formaddarp").find('input, select, textarea').each(function() {
    //                 const key = $(this).attr('id'); // Use ID or placeholder as key

    //                 localStorage.removeItem(key);
    //             })
    //             $("#arpModal").modal("hide")
    //             let formData = new FormData(document.getElementById("formaddarp"))
    //             let formDataObject = {};
    //             formData.forEach(function(value, key) {
    //                 formDataObject[key] = value
    //             });
    //             var isNewDocument = 0
    //             $.each(examForassessment, function(key, value) {
    //                 if (value.body_id == formDataObject.body_id) {
    //                     examForassessment[key] = formDataObject
    //                     isNewDocument = 1
    //                 }
    //             })
    //             // if (isNewDocument != 1)
    //             //     examForassessment.push(formDataObject)

    //             if (isNewDocument != 1) {
    //                 let examNew = Array();
    //                 examNew.push(formDataObject)
    //                 $.each(examForassessment, function(key, value) {
    //                     examNew.push(examForassessment[key])
    //                 })
    //                 examForassessment = examNew
    //             }


    //             // $("#cpptBody").html("")
    //             let examFiltered145 = examForassessment.filter(item => item.account_id == 2)
    //             if (examFiltered145.length > 0) {
    //                 fillDataArp(examFiltered145.length - 1)
    //                 // $("#arpAddDocument").slideUp()
    //                 $("#arpDocument").slideDown()
    //             }

    //             if (examForassessment.length > 0) {
    //                 displayTableAssessmentKeperawatan();
    //                 displayTableAssessmentKeperawatanForVitalSign();
    //             }


    //             fillRiwayatArp()
    //             $(".formsavearpbtn").button(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)

    //             // getAssessmentKeperawatan()
    //             // // $("#formsavearpbtn").slideUp()
    //             // // $("#formeditarp").slideDown()
    //             // var isNewDocument = 0
    //             // $.each(examForassessment, function(key, value) {
    //             //     if (value.body_id == data.body_id) {
    //             //         examForassessment[key] = data
    //             //         isNewDocument = 1
    //             //     }
    //             // })
    //             // if (isNewDocument == 1)
    //             //     examForassessment.push(data)
    //             // disableARP()
    //         },
    //         error: function(xhr) { // if error occured
    //             alert("Error occured.please try again");
    //             $(".formsavearpbtn").html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
    //             errorSwal(xhr);
    //         },
    //         complete: function() {
    //             $(".formsavearpbtn").button(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
    //             // clicked_submit_btn.button('reset');
    //         }
    //     });
    // }));

    const filterVsStatusId = (value) => {
        if (value == 1) {
            $("#arpApgar_Group").slideUp()
            $("#arpAnak_Group").slideUp()
        } else if (value == 4) {
            $("#arpApgar_Group").slideDown()
            $("#arpAnak_Group").slideDown()
        } else if (value == 5) {
            $("#arpApgar_Group").slideUp()
            $("#arpAnak_Group").slideDown()
        } else if (value == 10) {
            $("#arpApgar_Group").slideUp()
            $("#arpAnak_Group").slideUp()
        }
        $("#arpvs_status_id").val(value)
    }

    function generateSatelite() {
        $("#bodyFallRiskPerawat").html("")
        // addFallRisk(1, 0, 'arpbody_id', 'bodyFallRiskPerawat')
        $("#bodyApgarPerawat").html("")
        // addApgar(1, 0, 'arpbody_id', 'bodyApgarPerawat')
        $("#bodyPainMonitoringPerawat").html("")
        // addPainMonitoring(1, 0, 'arpbody_id', 'bodyPainMonitoringPerawat')
        $("#bodyGiziPerawat").html("")
        // addGizi(1, 0, 'arpbody_id', 'bodyGiziPerawat')
        $("#bodyTriagePerawat").html("")
        // addTriage(1, 0, 'arpbody_id', 'bodyTriagePerawat')
        $("#bodyADLPerawat").html("")
        // addADL(1, 0, 'arpbody_id', 'bodyADLPerawat')
        $("#bodyDekubitusPerawat").html("")
        // addDekubitus(1, 0, 'arpbody_id', 'bodyDekubitusPerawat')
        $("#bodyStabilitasPerawat").html("")
        // addDerajatStabilitas(1, 0, 'arpbody_id', 'bodyStabilitasPerawat')
        $("#bodyEducationFormPerawat").html("")
        // addEducationForm(1, 0, 'arpbody_id', 'bodyEducationFormPerawat')
        $("#bodyGcsPerawat").html("")
        // addGcs(1, 0, 'arpbody_id', 'bodyGcsPerawat')
        $("#bodyIntegumenPerawat").html("")
    }

    function getAssessmentKeperawatan(top = 1000, episode = 1) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentKeperawatan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': '<?= @$visit['visit_id']; ?>',
                'trans_id': '<?= @$visit['trans_id']; ?>',
                'nomor': '<?= @$visit['no_registration']; ?>',
                'isrj': '<?= @$visit['isrj']; ?>',
                'norujukan': '<?= @$visit['norujukan']; ?>',
                'top': top,
                'episode': episode
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#cpptDivForm").hide()
                getLoadingscreen("contentCppt", "loadContentCppt")
                getLoadingscreen("contentAssessmentPerawat", "loadContentAssessmentPerawat")
                $("#cpptBody").html(loadingScreen())
                $("#vitalSignBody").html(loadingScreen())
            },
            processData: false,
            success: function(data) {
                $("#cpptBody").html(tempTablesNull())
                $("#vitalSignBody").html(tempTablesNull())
                examForassessment = data.examInfo
                examForassessmentDetail = data.examDetail
                riwayatAll = data.pasienHistory

                examSelected = [];

                var vsStatusId = [1, 4, 5];

                let examFiltered145 = examForassessment.filter(item => item.account_id == 2)
                if (examFiltered145.length > 0) {
                    $("#arpDocument").slideDown()
                }

                if (examForassessment.length > 0) {
                    displayTableAssessmentKeperawatan();
                    displayTableAssessmentKeperawatanForVitalSign();
                }


                fillRiwayatArp()
            },
            error: function() {
                $("#cpptBody").html(tempTablesNull())
                $("#vitalSignBody").html(tempTablesNull())
            }
        });
    }

    function initialAddArp() {

        <?php if (@$visit['specialist_type_id'] == '1.05') {
        ?>
            // $("#arpTitle").html("Assessment Kebidanan")
        <?php
        } ?>
        let bodyId = '<?= @$visit['session_id']; ?>';
        let isnew = false;
        $.each(examForassessment, function(key, value) {
            if (value.body_id == bodyId && value.account_id) {
                isnew = true;
            }
        })
        if (isnew) {
            alert("Anda sudah pernah membuat dokumen Assessment atau CPPT pada sesi " + bodyId + ". Silahkan buat sesi baru.");
            return false;
        }
        $("#acpptvalid_user").val("")
        $("#acpptvalid_pasien").val("")
        $("#acpptvalid_date").val("")


        $("#bodyDiagPerawat").html("")


        $("#accordionAssessmentAwal .accordion-collapse.show").collapse('hide')
        $("#bodyFallRiskPerawatAddBtn").html(`<a onclick="addFallRisk(1, 0, 'arpbody_id', 'bodyFallRiskPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyPainMonitoringPerawatAddBtn").html(`<a onclick="addPainMonitoring(1, 0, 'arpbody_id', 'bodyPainMonitoringPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`);
        $("#bodyTriagePerawatAddBtn").html(`<a onclick="addTriage(1,0,'arpbody_id', 'bodyTriagePerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("bodyApgarPerawatAddBtn").html(`<a onclick="addApgar(1, 0, 'arpbody_id', 'bodyApgarPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyGiziPerawatAddBtn").html(`<a onclick="addGizi(1,1, 'arpbody_id','bodyGiziPerawat', false, 'arp')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyADLPerawatAddBtn").html(`<a onclick="addADL(1,1, 'arpbody_id','bodyADLPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyDekubitusPerawatAddBtn").html(`<a onclick="addDekubitus(1,1, 'arpbody_id','bodyDekubitusPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyStabilitasPerawatAddBtn").html(`<a onclick="addDerajatStabilitas(1, 0, 'arpbody_id', 'bodyStabilitasPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addEducationIntegrationButton").html(`<a onclick="addEducationIntegration(1,0, 'arpbody_id','bodyEducationIntegration', false)" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyEducationFormPerawatAddBtn").html(`<a onclick="addEducationForm(1,1, 'arpbody_id','bodyEducationFormPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyGcsPerawatAddBtn").html(`<a onclick="addGcs(1,0,'arpbody_id', 'bodyGcsPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyIntegumenPerawatAddBtn").html(`<a onclick="addIntegumen(1,1, 'arpbody_id','bodyIntegumenPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyAnakPerawatAddBtn").html(`<a onclick="addAnak(1,1, 'arpbody_id','bodyAnakPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyNeonatusPerawatAddBtn").html(`<a onclick="addNeonatus(1,1, 'arpbody_id','bodyNeonatusPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addNeurosensorisButton").html(`<a onclick="addNeurosensoris(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addPencernaanButton").html(`<a onclick="addPencernaan(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addPerkemihanButton").html(`<a onclick="addPerkemihan(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addPernapasanButton").html(`<a onclick="addPernapasan(1,0, 'arpbody_id', 'bodyPernapasan', false, 'arp')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addPsikologiButton").html(`<a onclick="onclick="addPsikologi(1,0, 'arpbody_id', 'bodyPsikologi')" " class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSeksualButton").html(`<a onclick="addSeksual(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSirkulasiButton").html(`<a onclick="addSirkulasi(1,0,'arpbody_id', 'bodySirkulasi', false, 'arp')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSocialButton").html(`<a onclick="addSocial(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addHearingButton").html(`<a onclick="addHearing(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSleepingButton").html(`<a onclick="addSleeping(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)



        // const date = new Date();
        // bodyId = date.toISOString().substring(0, 23);
        // bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#formaddarp").find('input[type="text"], input[type="hidden"], textarea').val(null)
        var initialexam = examForassessment[examForassessment.length - 1]
        $.each(initialexam, function(key, value) {
            $("#arp" + key).val(value)
        })
        $("#arpvalid_user").val("")
        $("#arpvalid_pasien").val("")
        $("#arpvalid_date").val("")

        var initialvital = examForassessmentDetail[examForassessmentDetail.length - 1]

        fillExaminationDetail(initialvital, 'arp')

        var ageYear = <?= @$visit['ageyear']; ?>;
        var ageMonth = <?= @$visit['agemonth']; ?>;
        var ageDay = <?= @$visit['ageday']; ?>;

        if (visit?.ageyear === 0 && visit?.agemonth === 0 && visit?.ageday <= 28) {
            $("#arpvs_status_id5").prop("checked", true);
        } else if (visit.ageyear >= 18) {
            $("#arpvs_status_id1").prop("checked", true);
        } else {
            $("#arpvs_status_id4").prop("checked", true);
        }
        $("#arpbody_id").val(bodyId)
        $("#arporg_unit_code").val('<?= @$visit['org_unit_code']; ?>')
        $("#arppasien_diagnosa_id").val(null)
        $("#arpdiagnosa_id").val(null)
        $("#arpno_registration").val('<?= @$visit['no_registration']; ?>')
        $("#arpvisit_id").val('<?= @$visit['visit_id']; ?>')
        $("#arpbill_id").val(null)
        <?php if (@$visit['isrj'] == 0) { ?>
            // $('#arpclinic_id').val('<?= @$visit['class_room_id']; ?>')
        <?php } else { ?>
            // $('#arpclinic_id').val('<?= @$visit['clinic_id']; ?>')
        <?php } ?>
        let clinicSelect = clinics.filter(item => item.clinic_id == '<?= @$visit['clinic_id']; ?>')
        $("#arpclinic_id").html($('<option></option>')
            .val(clinicSelect[0].clinic_id)
            .text(clinicSelect[0].name_of_clinic))

        <?php if (@$visit['isrj'] == '0') {
        ?>
            // $("#arpemployee_id").html('<option value="<?= @$visit['employee_inap']; ?>"><?= @$visit['fullname_inap']; ?></option>')
        <?php
        } else {
        ?>
            // $("#arpemployee_id").html('<option value="<?= @$visit['employee_id']; ?>"><?= @@$visit['fullname']; ?></option>')
        <?php
        } ?>
        $("#arpemployee_id").html('<option value="<?= user()->employee_id ?? user()->username; ?>"><?= user()->getFullname(); ?></option>')

        $("#arpclass_room_id").val('<?= @$visit['class_room_id']; ?>')
        $("#arpbed_id").val('<?= @$visit['bed_id']; ?>')
        $("#arpin_date").val('<?= @$visit['in_date']; ?>')
        $("#arpexit_date").val('<?= @$visit['exit_date']; ?>')
        $("#arpkeluar_id").val('<?= @$visit['keluar_id']; ?>')
        // flatpickrInstances["flatarpexamination_date"].setDate(moment().format("DD/MM/YYYY HH:mm"))
        // $("#flatarpexamination_date").trigger("change")
        $("#arpexamination_date").val(get_date())
        $("#arpmodified_date").val(get_date())
        $("#arpmodified_by").val('<?= user()->username; ?>')
        $("#arpmodified_from").val('<?= @$visit['clinic_id']; ?>')
        $("#arpstatus_pasien_id").val('<?= @$visit['status_pasien_id']; ?>')
        $("#arpageyear").val('<?= @$visit['ageyear']; ?>')
        $("#arpagemonth").val('<?= @$visit['agemonth']; ?>')
        $("#arpageday").val('<?= @$visit['ageday']; ?>')
        $("#arpthename").val('<?= @$visit['diantar_oleh']; ?>')
        $("#arptheaddress").val('<?= @$visit['visitor_address']; ?>')
        $("#arptheid").val('<?= @$visit['pasien_id']; ?>')
        $("#arpisrj").val('<?= @$visit['isrj']; ?>')
        $("#arpgender").val('<?= @$visit['gender']; ?>')
        $("#arpdoctor").val('<?= @@$visit['fullname']; ?>')
        $("#arpkal_id").val('<?= @$visit['kal_id']; ?>')
        $("#arppetugas_id").val('<?= user()->username; ?>')
        $("#arppetugas").val('<?= user()->getFullname(); ?>')
        $("#arppetugas_type").val('<?= user()->getOneRoles(); ?>')
        $("#arpaccount_id").val(2)

        <?php if (@$visit['specialist_type_id'] == '1.05') {
        ?>
            $("#arpvs_status_id10").trigger("click")
        <?php
        } ?>

        // var ageYear = <?= @$visit['ageyear']; ?>;
        // var ageMonth = <?= @$visit['agemonth']; ?>;
        // var ageDay = <?= @$visit['ageday']; ?>;

        // if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
        // $("#armvs_status_id").prop("selectedIndex", 3);
        // } else if (ageYear>= 18) {
        // $("#armvs_status_id").prop("selectedIndex", 1);
        // } else {
        // $("#armvs_status_id").prop("selectedIndex", 2);
        // }

        $("#arpweight").val(berat)
        $("#arpheight").val(tinggi)

        $('#keperawatanListLinkAll').html("")

        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #armbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_neonatus/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">CPPT Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">CPPT Rawat Jalan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Diagnosis Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Hak dan Kewajiban Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Implementasi Asuhan Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Inform Concern (Pemasangan Infus)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Keperawatan IGD Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Keperawatan IGD Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Monitoring Nyeri</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arpbody_id").val() + '" target="_blank">Transfer Internal</a></li>')

        $("#arpisvalid").val(0)

        $("#arpcollapseVitalSign").find("#arptotal_score").html("")
        $("#arpcollapseVitalSign").find("span.h6").html("")

        // $("#arpAddDocument").slideUp()
        $("#arpDocument").slideDown()
        enableARP()
        fillRiwayatArp()

        generateSatelite()

        // $("#formaddarp").find('input, select, textarea').each(function() {
        // const key=$(this).attr('id'); // Use ID or placeholder as key

        // const savedValue=localStorage.getItem(key);
        // if (savedValue) {
        // $(this).val(savedValue);
        // }
        // })
        $("#arpModal").modal("show")
    }
    const fillDataArp = async (index) => {
        $("#bodyDiagPerawat").html("")
        $("#formaddarpqrcode1").html("")
        $("#formaddarpsigner1").html("")
        $("#formaddarpqrcode2").html("")
        $("#formaddarpsigner2").html("")

        let ex = examForassessment[index]
        $.each(ex, function(key, value) {
            if (!Array.isArray(value)) {
                $("#arp" + key.replace(/([.#:,\[\]\/])/g, '\\$1')).val(value)
            }
        })
        let examdetail = examForassessmentDetail.filter(item => item?.body_id == $("#arpbody_id").val())
        fillExaminationDetail(examdetail[0], "arp")

        let clinicSelect = clinics.filter(item => item.clinic_id == '<?= @$visit['clinic_id']; ?>')
        $("#arpclinic_id").html($('<option></option>')
            .val(clinicSelect[0].clinic_id)
            .text(clinicSelect[0].name_of_clinic))
        $("#arpemployee_id").html('<option value="' + ex.employee_id + '">' + ex.fullname + '</option>')
        $("#arpvs_status_id" + ex.vs_status_id).prop("checked", true)
        // let formattedValue = moment(ex.examination_date).format('DD/MM/YYYY HH:mm');
        $("#arpcollapseVitalSign").find("input").each(function() {
            $(this).trigger("change")
        })
        // flatpickrInstances["flatarpexamination_date"].setDate(
        //     formatedDatetimeFlat(ex.examination_date)
        // );
        // $("#flatarpexamination_date").trigger("change");

        getSatelitePerawat(ex)

        await checkSignSignature("formaddarp", "arpbody_id", "formsavearpbtnid", 3)

        disableARP()



        $("#arpModal").modal("show")
    }
    const getSatelitePerawat = (ex) => {
        postData({
            document_id: ex.body_id,
            visit_id: ex.visit_id,
            specialist_type_id: ex.specialist_type_id,
            clinic_id: ex.specialist_type_id
        }, 'admin/rm/assessmentperawat/getSatelitePerawat', (res) => {
            $("#bodyGcsPerawat").html("")
            $("#bodyFallRiskPerawat").html("")
            $("#bodyPainMonitoringPerawat").html("")
            $("#bodyPernapasan").html("")
            $("#bodyApgarPerawat").html("")
            $("#bodyTriagePerawat").html("")
            $("#bodyGiziPerawat").html("")
            $("#bodyADLPerawat").html("")
            $("#bodyDekubitusPerawat").html("")
            $("#bodyStabilitasPerawat").html("")
            $("#bodyIntegumenPerawat").html("")
            $("#bodyNeurosensoris").html("")
            $("#bodyPencernaan").html("")
            $("#bodyPerkemihan").html("")
            $("#bodyPsikologi").html("")
            $("#bodySirkulasi").html("")
            $("#bodySeksual").html("")
            $("#bodySocial").html("")
            $("#bodyHearing").html("")
            $("#bodySleeping").html("")

            if (res.diagPerawat) {
                $.each(res.diagPerawat, function(key, value) {
                    addRowDiagPerawatBasic('bodyDiagPerawat', '', value.diagnosan_id, value.diag_notes, 'arpModal')
                })
            }
            if (res.gcs) {
                gcsAll = res.gcs
                // gcsDetailAll = data.gcsDetail
                $.each(gcsAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addGcs(0, key, "arpbody_id", "bodyGcsPerawat", false)
                        return false
                    }
                })
            }
            if (res.fallRisk) {
                let data = res.fallRisk
                fallRisk = data.fallRisk
                fallRiskDetail = data.fallRiskDetail

                $.each(fallRisk, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addFallRisk(0, key, "arpbody_id", "bodyFallRiskPerawat", false)
                        return false
                    }
                })
            }

            if (res.painMonitoring) {
                let container = "bodyPainMonitoringMedis"
                let data = res.painMonitoring
                painMonitoring = data.painMonitoring
                painMonitoringDetil = data.painDetil
                painIntervensi = data.painIntervensi

                $.each(painMonitoring, function(key, value) {
                    $("#" + container).html("")
                    if (value.document_id == $("#arpbody_id").val()) {
                        addPainMonitoring(0, key, 'arpbody_id', "bodyPainMonitoringPerawat", false)
                        return false
                    }
                })
            }

            if (res.pernapasan) {
                napas = res.pernapasan
                // stabilitasDetail = data.stabilitasDetail

                $.each(napas, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addPernapasan(0, key, "arpbody_id", "bodyPernapasan", false)
                        return false
                    }
                })
            }
            if (res.apgar) {
                let container = "bodyApgarMedis"
                let data = res.apgar
                apgar = data.apgar
                apgarDetil = data.apgarDetil

                $.each(apgar, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addApgar(0, key, "arpbody_id", "bodyApgarPerawat", false)
                        return false
                    }
                })
            }
            if (res.triage) {
                triage = res.triage.triage
                triageDetil = res.triage.triageDetil

                $.each(triage, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addTriage(0, key, "arpbody_id", "bodyTriagePerawat", false)
                        return false
                    }
                })
            }
            if (res.gizi) {
                giziAll = res.gizi.gizi
                giziDetailAll = res.gizi.giziDetail

                $.each(giziAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addGizi(0, key, "arpbody_id", "bodyGiziPerawat", false)
                        return false
                    }
                })
            }
            if (res.adl) {
                adlAll = res.adl.adl
                // stabilitasDetail = data.stabilitasDetail

                $.each(adlAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addADL(0, key, "arpbody_id", "bodyADLPerawat", false)
                        return false
                    }
                })
            }
            if (res.dekubitus) {
                dekubitusAll = res.dekubitus.dekubitus

                $.each(dekubitusAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addDekubitus(0, key, 'arpbody_id', "bodyDekubitusPerawat", false)
                        return false
                    }
                })
            }
            if (res.stabilitas) {
                stabilitas = res.stabilitas.stabilitas
                stabilitasDetail = res.stabilitas.stabilitasDetail

                $.each(stabilitas, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addDerajatStabilitas(0, key, "arpbody_id", "bodyStabilitasPerawat", false)
                        return false
                    }
                })
            }
            if (res.integumen) {
                integumenAll = res.integumen.integumen
                console.log(integumenAll)
                // stabilitasDetail = data.stabilitasDetail

                $.each(integumenAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addIntegumen(0, key, 'arpbody_id', 'bodyIntegumenPerawat')
                        return false
                    }
                })
            }
            if (res.neurosensoris) {
                neuroAll = res.neurosensoris.neuro
                console.log(neuroAll)

                $.each(neuroAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addNeurosensoris(0, key)
                        return false
                    }
                })
            }
            if (res.pencernaan) {
                digestAll = res.pencernaan.pencernaan

                $.each(digestAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addPencernaan(0, key)
                        return false
                    }
                })
            }
            if (res.perkemihan) {
                perkemihanAll = res.perkemihan.perkemihan
                // stabilitasDetail = data.stabilitasDetail

                $.each(perkemihanAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addPerkemihan(0, key)
                        return false
                    }
                })
            }
            if (res.psikologi) {
                psikologiAll = res.psikologi.psikologi
                psikologiDetailAll = res.psikologi.psikologiDetail

                $.each(psikologiAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addPsikologi(0, key, 'arpbody_id', 'bodyPsikologi')
                        return false
                    }
                })
            }
            if (res.sirkulasi) {
                sirkulasiAll = res.sirkulasi.sirkulasi
                $.each(sirkulasiAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addSirkulasi(0, key, "arpbody_id", "bodySirkulasi")
                        return false
                    }
                })
            }
            if (res.seksual) {
                seksualAll = res.seksual.seksual

                $.each(seksualAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addSeksual(0, key)
                        return false
                    }
                })
            }
            if (res.social) {
                socialAll = res.social.social

                $.each(socialAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addSocial(0, key)
                        return false
                    }
                })
            }
            if (res.hearing) {
                hearingAll = res.hearing.hearing

                $.each(hearingAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {

                        addHearing(0, key)
                        return false
                    }
                })
            }
            if (res.sleeping) {
                sleepingAll = res.sleeping.sleeping

                $.each(sleepingAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addSleeping(0, key)
                        return false
                    }
                })
            }
        }, (beforesend) => {
            // getLoadingGlobalServices('bodydatapemeriksaanKulit')
        })
    }

    function fillRiwayatArp() {
        $.each(riwayatAll, function(key, value) {
            if ($("#arpGEN0009" + value.value_id).is(":checkbox")) {
                $("#arpGEN0009" + value.value_id).prop("checked", true)
                // $("#arpGEN0009" + value.value_id).prop("disabled", true)
            } else {
                $("#arpGEN0009" + value.value_id).val(value.histories)
                // $("#arpGEN0009" + value.value_id).prop("disabled", true)
            }
        })
    }

    const signArp = async () => {
        // $("#formeditarpid").trigger("click")
        //const addSignUser = (formId, container, primaryKey, buttonId, docs_type, user_type, sign_ke = 1, title)
        let titlenya = $("#arpTitle").html()
        let titlerj = ''
        let titlejenis = ''
        if ($("#arpisrj") == 0) {
            titlerj = ' Rawat Inap';
        } else {
            titlerj = ' Rawat Jalan'
        }
        switch ($('#formaddarp input[name="vs_status_id"]:checked').val()) {
            case 1:
                titlejenis = ' Dewasa'
                break;
            case 4:
                titlejenis = ' Neonatus'
                break;
            case 5:
                titlejenis = ' Anak'
                break;
            case 10:
                titlejenis = ' Obsetric'
                break;
            default:
                break;
        }
        await addSignUser("formaddarp", "arp", "arpbody_id", "formsavearpbtnid", 3, 1, 1, $("#arpTitle").html() + titlejenis + titlerj)
    }

    function displayTableAssessmentKeperawatan(index) {
        $("#assessmentKeperawatanHistoryBody").html("")
        $("#cpptBody").html("")
        // var vsStatusId = [1, 4, 5];


        // let examfiltered14 = examForassessment.filter(item => (vsStatusId.includes(item.vs_status_id)))


        $.each(examForassessment, function(key, value) {
            var pd = examForassessment[key]
            if (value.account_id == '2') {
                var titlekeperawatan = '';
                if (value.vs_status_id == 1) {
                    titlekeperawatan = 'Dewasa'
                }
                if (value.vs_status_id == 4) {
                    titlekeperawatan = 'Anak'
                }
                if (value.vs_status_id == 5) {
                    titlekeperawatan = 'Neonatus'
                }
                if (value.vs_status_id == 10) {
                    titlekeperawatan = 'Obsetric'
                }

                let examdetail = examForassessmentDetail.filter(item => item?.body_id == value?.body_id)
                examdetail = examdetail[0]

                console.log(value.body_id)

                if (value.body_id == '<?= @$visit['session_id']; ?>') {
                    var rowHtml = `
                        <tr>
                            <td><b><i class="mdi mdi-arrow-collapse-right" style="font-size: large"></i></b></td>
                            <td><b>${formatedDatetimeFlat(value?.examination_date)}</b></td>
                            <td><b>${value?.name_of_clinic}</b></td>
                            <td><b>${value?.anamnase}</b></td>
                            <td>
                                <b>
                                    BB: ${examdetail?.weight}Kg; 
                                    TB: ${examdetail?.height}cm; 
                                    ${examdetail?.temperature}°C; 
                                    ${examdetail?.nadi}/menit; 
                                    ${examdetail?.tension_upper}mmHg; 
                                    ${examdetail?.tension_below}mmHg; 
                                    ${examdetail?.saturasi}SpO2%; 
                                    ${examdetail?.nafas}/menit; 
                                    ${examdetail?.arm_diameter}cm;
                                </b>
                            </td>
                            <td><b><i>--Silahkan klik tombol lihat--</i></b></td>
                            <td><b>${value?.instruction}</b></td>
                            <td>
                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                    <button type="button" class="btn btn-success" onclick="fillDataArp(${key})">Lihat</button>
                                    <button type="button" class="btn btn-light" onclick="openPopUpTab('<?= base_url('admin/rm/keperawatan/cetak_keperawatan/' . base64_encode(json_encode(@$visit))) ?>/${value.body_id}/${titlekeperawatan}')">Cetak</button>
                                </div>
                            </td>
                        </tr>
                    `;
                    $("#assessmentKeperawatanHistoryBody").append(rowHtml);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                } else {
                    var rowHtml = `
                        <tr>
                            <td></td>
                            <td>${formatedDatetimeFlat(value?.examination_date)}</td>
                            <td>${value?.name_of_clinic}</td>
                            <td>${value?.anamnase}</td>
                            <td>
                                BB: ${examdetail?.weight}Kg; 
                                TB: ${examdetail?.height}cm; 
                                ${examdetail?.temperature}°C; 
                                ${examdetail?.nadi}/menit; 
                                ${examdetail?.tension_upper}mmHg; 
                                ${examdetail?.tension_below}mmHg; 
                                ${examdetail?.saturasi}SpO2%; 
                                ${examdetail?.nafas}/menit; 
                                ${examdetail?.arm_diameter}cm;
                            </td>
                            <td><i>--Silahkan klik tombol lihat--</i></td>
                            <td>${value?.instruction}</td>
                            <td>
                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                    <button type="button" class="btn btn-success" onclick="fillDataArp(${key})">Lihat</button>
                                    <button type="button" class="btn btn-light" onclick="openPopUpTab('<?= base_url('admin/rm/keperawatan/cetak_keperawatan/' . base64_encode(json_encode(@$visit))) ?>/${value.body_id}/${titlekeperawatan}')">Cetak</button>
                                </div>
                            </td>
                        </tr>
                    `;
                    $("#assessmentKeperawatanHistoryBody").append(rowHtml);
                }
            }
        })
        vsStatusId = [2, 7];

        // let examfiltered27 = examForassessment.filter(item => (item.vs_status_id == 2 || item.vs_status_id == 7))
        // coba = examfiltered27
        $.each(examForassessment, function(key, value) {
            if (value.account_id == 3 || value.account_id == 4) {
                let pd = examForassessment[key]
                addRowCPPT(value, key)
            }
        })
    }

    function enableARP() {
        $("#formsavearpbtnid").slideDown()
        $("#formeditarpid").slideUp()
        // $(".formsignarp").slideDown()
        $("#formaddarp input").prop("disabled", false)
        $("#formaddarp textarea").prop("disabled", false)
        $("#formaddarp select").prop("disabled", false)
        $("#formaddarp option").prop("disabled", false)

        $("#vitalSignPerawat").find("button").click()
        $("#formaddarp").find(".btn-to-hide").slideDown()
        $("#formaddarp").find(".btn-edit").each(function() {
            $(this).trigger("click")
        })
    }

    const disableARP = () => {
        $("#formsavearpbtnid").slideUp()
        if ($("#arpmodified_by").val() == '<?= user()->username; ?>' || <?= json_encode(user()->checkRoles(['superuser'])) ?>) {
            $("#formeditarpid").slideDown()
        } else {
            $("#formeditarpid").slideUp()
        }
        // $(".formsignarp").slideUp()
        $("#formaddarp input").prop("disabled", true)
        $("#formaddarp textarea").prop("disabled", true)
        $("#formaddarp select").prop("disabled", true)
        $("#formaddarp option").prop("disabled", true)
        $("#formaddarp").find(".btn-to-hide").slideUp()
        $("#vitalSignPerawat").find("button").click()
        if ($("#arpvalid_user").val() != '') {
            $("#formaddarpbtnid").slideUp()
            $("#formeditarpid").slideUp()
            $("#formsignarpid").slideDown()
            $("#formaddarp").find(".btn-add-doc").remove()
            $("#formaddarp").find(".btn-edit").each(function() {
                $(this).hide()
            })
        } else {
            $("#formaddarpbtnid").slideDown()
            $("#formeditarpid").slideDown()
            $("#formsignarpid").slideDown()
            $("#formaddarp").find(".btn-add-doc").remove()
        }
    }

    $(".formaddarpbtn").on("mouseup", function() {
        initialAddArp()
    })
</script>

<script>
    function cetakAssessmenKeperawatan() {
        var titlekeperawatan = '';
        if ($("#arpvs_status_id1").prop("checked")) {
            titlekeperawatan = 'Dewasa'
        }
        if ($("#arpvs_status_id4").prop("checked")) {
            titlekeperawatan = 'Anak'
        }
        if ($("#arpvs_status_id5").prop("checked")) {
            titlekeperawatan = 'Neonatus'
        }
        if ($("#arpvs_status_id10").prop("checked")) {
            titlekeperawatan = 'Obsetric'
        }

        openPopUpTab('<?= base_url() . '/admin/rm/keperawatan/cetak_keperawatan/' . base64_encode(json_encode(@$visit)); ?>' + '/' + $("#arpbody_id").val() + '/' + titlekeperawatan)

    }
</script>