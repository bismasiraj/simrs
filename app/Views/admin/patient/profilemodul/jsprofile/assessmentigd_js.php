<?php
$aValueParent = array();
foreach ($aValue as $key => $value) {
    $aValueParent[$value['parameter_id']]['parameter_id'] = $value['parameter_id'];
    $aValueParent[$value['parameter_id']]['p_type'] = $value['p_type'];
}
?>
<script type="text/javascript">
    $(document).ready(function(e) {
        const nomor = '<?= $visit['no_registration']; ?>';
        const ke = '%'
        // const mulai = '2023-08-01' //tidak terpakai
        // const akhir = '2023-08-31' //tidak terpakai
        const lunas = '%'
        // var klinik = '<?= $visit['clinic_id']; ?>'
        const klinik = '%'
        const rj = '%'
        const status = '%'
        const nota = '%'
        const trans = '<?= $visit['trans_id']; ?>'
        const trans_id = '<?= $visit['trans_id']; ?>'
        const visit = '<?= $visit['visit_id']; ?>'





        $("#aigdexamination_date").val(get_date())

        // armstanding_ordereditor.init({
        //     selector: '#arpeducation_material'
        // });
        // tinymce.init({
        //     selector: '#arpeducation_material'
        // });
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#armbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_neonatus/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Jalan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Diagnosis Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Hak dan Kewajiban Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Implementasi Asuhan Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Inform Concern (Pemasangan Infus)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Nyeri</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Transfer Internal</a></li>')
    })



    $("#aigdweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdnadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdsaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdnafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdarm_diameter").keydown(function(e) {
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

        initialAddArp()
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
            docDataObjectRm[key] = value
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
                $(".formsavearpbtn").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                $("#formaddarp").find('input, select, textarea').each(function() {
                    const key = $(this).attr('id'); // Use ID or placeholder as key

                    localStorage.removeItem(key);
                })
                $("#arpModal").modal("hide")
                let formData = new FormData(document.getElementById("formaddarp"))
                let formDataObject = {};
                formData.forEach(function(value, key) {
                    formDataObject[key] = value
                });
                var isNewDocument = 0
                $.each(examForassessment, function(key, value) {
                    if (value.body_id == formDataObject.body_id) {
                        examForassessment[key] = formDataObject
                        isNewDocument = 1
                    }
                })
                // if (isNewDocument != 1)
                //     examForassessment.push(formDataObject)

                if (isNewDocument != 1) {
                    let examNew = Array();
                    examNew.push(formDataObject)
                    $.each(examForassessment, function(key, value) {
                        examNew.push(examForassessment[key])
                    })
                    examForassessment = examNew
                }


                // $("#cpptBody").html("")
                let examFiltered145 = examForassessment.filter(item => item.account_id == 2)
                if (examFiltered145.length > 0) {
                    fillDataArp(examFiltered145.length - 1)
                    // $("#arpAddDocument").slideUp()
                    $("#arpDocument").slideDown()
                }

                if (examForassessment.length > 0) {
                    displayTableAssessmentKeperawatan();
                    displayTableAssessmentKeperawatanForVitalSign();
                }


                fillRiwayatArp()
                $(".formsavearpbtn").button(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $(".formsavearpbtn").html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
                errorSwal(xhr);
            },
            complete: function() {
                $(".formsavearpbtn").button(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
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

    function getAssessmentKeperawatan(top = 10, episode = 1) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentKeperawatan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': '<?= $visit['visit_id']; ?>',
                'trans_id': '<?= $visit['trans_id']; ?>',
                'nomor': '<?= $visit['no_registration']; ?>',
                'isrj': '<?= $visit['isrj']; ?>',
                'norujukan': '<?= $visit['norujukan']; ?>',
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
                riwayatAll = data.pasienHistory

                examSelected = [];

                // $.each(examForassessment, function(key, value) {
                var vsStatusId = [1, 4, 5];

                //     if (vsStatusId.includes(value.vs_status_id)) {
                //         fillDataArp(key)
                //         disableARP()
                //     }
                // })
                // fillDataArp(examForassessment.length)


                let examFiltered145 = examForassessment.filter(item => item.account_id == 2)
                if (examFiltered145.length > 0) {
                    fillDataArp(examFiltered145.length - 1)
                    // $("#arpAddDocument").slideUp()
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

        <?php if ($visit['specialist_type_id'] == '1.05') {
        ?>
            $("#arpTitle").html("Assessment Kebidanan")
        <?php
        } ?>
        let bodyId = '<?= $visit['session_id']; ?>';
        let isnew = false;
        $.each(examForassessment, function(key, value) {
            if (value.body_id == bodyId) {
                isnew = true;
            }
        })
        if (isnew) {
            return alert("Anda sudah pernah membuat dokumen Assessment pada sesi " + bodyId + ". Silahkan refresh halaman jika memang sudah berganti sesi.");
        }

        $("#bodyDiagPerawat").html("")


        $("#accordionAssessmentAwal .accordion-collapse.show").collapse('hide')
        $("#bodyFallRiskPerawatAddBtn").html(`<a onclick="addFallRisk(1, 0, 'arpbody_id', 'bodyFallRiskPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyPainMonitoringPerawatAddBtn").html(`<a onclick="addPainMonitoring(1, 0, 'arpbody_id', 'bodyPainMonitoringPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`);
        $("#bodyTriagePerawatAddBtn").html(`<a onclick="addTriage(1,0,'arpbody_id', 'bodyTriagePerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("bodyApgarPerawatAddBtn").html(`<a onclick="addApgar(1, 0, 'arpbody_id', 'bodyApgarPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyGiziPerawatAddBtn").html(`<a onclick="addGizi(1,1, 'arpbody_id','bodyGiziPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
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
        $("#addPernapasanButton").html(`<a onclick="addPernapasan(1,0, 'arpbody_id', 'bodyPernapasan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addPsikologiButton").html(`<a onclick="addPsikologi(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSeksualButton").html(`<a onclick="addSeksual(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSirkulasiButton").html(`<a onclick="addSirkulasi(1,0,'arpbody_id', 'bodySirkulasi')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSocialButton").html(`<a onclick="addSocial(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addHearingButton").html(`<a onclick="addHearing(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSleepingButton").html(`<a onclick="addSleeping(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)



        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#formaddarp").find('input[type="text"], input[type="hidden"], textarea').val(null)
        var initialexam = examForassessment[examForassessment.length - 1]
        $.each(initialexam, function(key, value) {
            $("#arp" + key).val(value)
        })

        var ageYear = <?= $visit['ageyear']; ?>;
        var ageMonth = <?= $visit['agemonth']; ?>;
        var ageDay = <?= $visit['ageday']; ?>;

        if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
            $("#avtvs_status_id").prop("selectedIndex", 3);
        } else if (ageYear >= 18) {
            $("#avtvs_status_id").prop("selectedIndex", 1);
        } else {
            $("#avtvs_status_id").prop("selectedIndex", 2);
        }
        $("#arpbody_id").val(bodyId)
        $("#arporg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#arppasien_diagnosa_id").val(null)
        $("#arpdiagnosa_id").val(null)
        $("#arpno_registration").val('<?= $visit['no_registration']; ?>')
        $("#arpvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#arpbill_id").val(null)
        <?php if ($visit['isrj'] == 0) { ?>
            // $('#arpclinic_id').val('<?= $visit['class_room_id']; ?>')
        <?php } else { ?>
            // $('#arpclinic_id').val('<?= $visit['clinic_id']; ?>')
        <?php } ?>
        let clinicSelect = clinics.filter(item => item.clinic_id == '<?= $visit['clinic_id']; ?>')
        $("#arpclinic_id").html($('<option></option>')
            .val(clinicSelect[0].clinic_id)
            .text(clinicSelect[0].name_of_clinic))

        <?php if ($visit['isrj'] == '0') {
        ?>
            $("#arpemployee_id").html('<option value="<?= $visit['employee_inap']; ?>"><?= $visit['fullname_inap']; ?></option>')
        <?php
        } else {
        ?>
            $("#arpemployee_id").html('<option value="<?= $visit['employee_id']; ?>"><?= $visit['fullname']; ?></option>')
        <?php
        } ?>
        $("#arpclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#arpbed_id").val('<?= $visit['bed_id']; ?>')
        $("#arpin_date").val('<?= $visit['in_date']; ?>')
        $("#arpexit_date").val('<?= $visit['exit_date']; ?>')
        $("#arpkeluar_id").val('<?= $visit['keluar_id']; ?>')
        flatpickrInstances["flatarpexamination_date"].setDate(moment().format("DD/MM/YYYY HH:mm"))
        $("#flatarpexamination_date").trigger("change")
        $("#arpmodified_date").val(get_date())
        $("#arpmodified_by").val('<?= user()->username; ?>')
        $("#arpmodified_from").val('<?= $visit['clinic_id']; ?>')
        $("#arpstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#arpageyear").val('<?= $visit['ageyear']; ?>')
        $("#arpagemonth").val('<?= $visit['agemonth']; ?>')
        $("#arpageday").val('<?= $visit['ageday']; ?>')
        $("#arpthename").val('<?= $visit['diantar_oleh']; ?>')
        $("#arptheaddress").val('<?= $visit['visitor_address']; ?>')
        $("#arptheid").val('<?= $visit['pasien_id']; ?>')
        $("#arpisrj").val('<?= $visit['isrj']; ?>')
        $("#arpgender").val('<?= $visit['gender']; ?>')
        $("#arpdoctor").val('<?= $visit['fullname']; ?>')
        $("#arpkal_id").val('<?= $visit['kal_id']; ?>')
        $("#arppetugas_id").val('<?= user()->username; ?>')
        $("#arppetugas").val('<?= user()->getFullname(); ?>')
        $("#arpaccount_id").val(2)

        <?php if ($visit['specialist_type_id'] == '1.05') {
        ?>
            $("#arpvs_status_id10").trigger("click")
        <?php
        } ?>


        $("#arpweight").val(berat)
        $("#arpheight").val(tinggi)
        // $("#arpvs_status_id").val(1)

        $('#keperawatanListLinkAll').html("")

        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#armbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_neonatus/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Jalan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Diagnosis Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Hak dan Kewajiban Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Implementasi Asuhan Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Inform Concern (Pemasangan Infus)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Nyeri</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Transfer Internal</a></li>')

        $("#arpisvalid").val(0)

        $("#arpcollapseVitalSign").find("#arptotal_score").html("")
        $("#arpcollapseVitalSign").find("span.h6").html("")

        // $("#arpAddDocument").slideUp()
        $("#arpDocument").slideDown()
        enableARP()
        fillRiwayatArp()

        generateSatelite()

        $("#formaddarp").find('input, select, textarea').each(function() {
            const key = $(this).attr('id'); // Use ID or placeholder as key

            const savedValue = localStorage.getItem(key);
            if (savedValue) {
                $(this).val(savedValue);
            }
        })
        $("#arpModal").modal("show")
    }

    const fillDataArp = async (index) => {
        var ex = examForassessment[index]
        $.each(ex, function(key, value) {
            $("#arp" + key).val(value)
        })
        let clinicSelect = clinics.filter(item => item.clinic_id == '<?= $visit['clinic_id']; ?>')
        $("#arpclinic_id").html($('<option></option>')
            .val(clinicSelect[0].clinic_id)
            .text(clinicSelect[0].name_of_clinic))
        $("#arpemployee_id").html('<option value="' + ex.employee_id + '">' + ex.fullname + '</option>')
        $("#arpvs_status_id" + ex.vs_status_id).prop("checked", true)
        // let formattedValue = moment(ex.examination_date).format('DD/MM/YYYY HH:mm');
        $("#arpcollapseVitalSign").find("input").each(function() {
            $(this).trigger("change")
        })
        flatpickrInstances["flatarpexamination_date"].setDate(
            formatedDatetimeFlat(ex.examination_date)
        );
        $("#flatarpexamination_date").trigger("change");

        getSatelitePerawat(ex)

        // getFallRisk(ex.body_id)
        // getPainMonitoring(ex.body_id)
        // getTriage(ex.body_id, "bodyTriage")
        // getGcs(ex.body_id, "bodyGcsPerawat")
        // getApgar(ex.body_id)
        // getStabilitas(ex.body_id)
        // getPernapasan(ex.body_id)
        // getSirkulasi(ex.body_id)
        // getNeurosensoris(ex.body_id)
        // getIntegumen(ex.body_id)
        // getADL(ex.body_id)
        // getPencernaan(ex.body_id)
        // getDekubitus(ex.body_id)
        // getPsikologi(ex.body_id)
        // getPerkemihan(ex.body_id)
        // getSeksual(ex.body_id)
        // getSocial(ex.body_id)
        // getGizi(ex.body_id)
        // getEducationForm(ex.body_id)
        // getEducationIntegration(ex.body_id)
        // getHearing(ex.body_id)
        // getSleeping(ex.body_id)

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
            console.log(res)
            console.log(res.gcs)
            if (res.gcs) {
                gcsAll = res.gcs
                // gcsDetailAll = data.gcsDetail
                $.each(gcsAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyGcsPerawat").html("")
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
                        $("#bodyFallRiskPerawat").html("")
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
                        $("#bodyPainMonitoringPerawat").html("")
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
                        $("#bodyApgarPerawat").html("")
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
                        $("#bodyTriagePerawat").html("")
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
                        $("#bodyGiziPerawat").html("")
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
                        $("#bodyADLPerawat").html("")
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
                // stabilitasDetail = data.stabilitasDetail

                $.each(integumenAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addIntegumen(0, key)
                        return false
                    }
                })
            }
            if (res.neurosensoris) {
                neurosensoris = res.neurosensoris.neuro

                $.each(neuroAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addNeurosensoris(0, key)
                    return false
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
                        addPsikologi(0, key)
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
        $("#formeditarpid").trigger("click")
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
            if (value.account_id == '2')
                if (key == index) {
                    $("#assessmentKeperawatanHistoryBody").append($("<tr>")
                        .append($("<td>").append($("<b>").append('<i class="mdi mdi-arrow-collapse-right" style="font-size: large"></i>')))
                        .append($("<td>").append($("<b>").html(formatedDatetimeFlat(value.examination_date))))
                        .append($("<td>").append($("<b>").html(value.name_of_clinic)))
                        .append($("<td>").append($("<b>").html(value.anamnase)))
                        .append($("<td>").append($("<b>").html('BB: ' + value.weight + 'Kg; TB: ' + value.height + 'cm; ' +
                            value.temperature + '°C; ' +
                            value.nadi + '/menit; ' +
                            value.tension_upper + 'mmHg; ' +
                            value.tension_below + 'mmHg; ' +
                            value.saturasi + 'SpO2%; ' +
                            value.nafas + '/menit; ' +
                            value.arm_diameter + 'cm; ')))
                        .append($("<td>").append($("<b>").html()))
                        .append($("<td>").append($("<b>").html()))
                        .append($("<td>").append($('<button class="btn btn-success" onclick="fillDataArp(' + key + ')">').html("Lihat")))
                    )
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                } else {
                    $("#assessmentKeperawatanHistoryBody").append($("<tr>")
                        .append($("<td>"))
                        .append($("<td>").append($("<b>").html(formatedDatetimeFlat(value.examination_date))))
                        .append($("<td>").append($("<b>").html(value.name_of_clinic)))
                        .append($("<td>").append($("<b>").html(value.anamnase)))
                        .append($("<td>").append($("<b>").html('BB: ' + value.weight + 'Kg; TB: ' + value.height + 'cm; ' +
                            value.temperature + '°C; ' +
                            value.nadi + '/menit; ' +
                            value.tension_upper + 'mmHg; ' +
                            value.tension_below + 'mmHg; ' +
                            value.saturasi + 'SpO2%; ' +
                            value.nafas + '/menit; ' +
                            value.arm_diameter + 'cm; ')))
                        .append($("<td>").append($("<b>").html()))
                        .append($("<td>").append($("<b>").html()))
                        .append($("<td>").append($('<button class="btn btn-success" onclick="fillDataArp(' + key + ')">').html("Lihat")))
                    )
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
            $("#formsignarpid").slideUp()
            $("#formaddarp").find(".btn-add-doc").remove()
        }
    }

    $(".formaddarpbtn").on("mouseup", function() {
        initialAddArp()
    })
</script>
<script type="text/javascript">
    // function addRowDiagPerawat(diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
    //     diagIndex++;
    //     if (diag_cat == null) {
    //         diag_cat = 1
    //     }
    //     if (diag_cat == null && diagIndex > 1) {
    //         diag_cat = 2
    //     }
    //     $("#bodyDiagPerawat")
    //         .append($('<tr id="arpdiag' + diagIndex + '">')
    //             // .append($('<td>').html(diagIndex + "."))
    //             .append($('<td>')
    //                 .append('<select id="arpdiag_id' + diagIndex + '" class="form-control" name="diag_id[]" onchange="selectedDiagNurse(' + diagIndex + ')" style="width: 100%"></select>')
    //                 .append('<input id="arpdiag_name' + diagIndex + '" name="diag_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
    //                 .append('<input id="arpsscondition_id' + diagIndex + '" name="sscondition_id[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
    //                 // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
    //             )
    //             // .append($('<td>')
    //             //     .append($('<input>').attr('name', 'diag_name[]').attr('id', 'diag_name' + diagIndex).attr('value', diag_name).attr('type', 'text').attr('readonly', 'readonly'))
    //             // )
    //             .append($('<td>')
    //                 .append($("<select class=\"form-control\">")
    //                     .attr('name', 'suffer_type[]').attr('id', 'arpsuffer_type' + diagIndex) <?php foreach ($suffer as $key => $value) { ?>
    //                         .append($("<option>")
    //                             .attr('value', '<?= $suffer[$key]['suffer_type']; ?>').html('<?= $suffer[$key]['suffer']; ?>')
    //                         ) <?php } ?>
    //                     .val(diag_suffer)
    //                 )
    //             )
    //             .append($('<td>')
    //                 .append($("<select class=\"form-control\">")
    //                     .attr('name', 'diag_cat[]').attr('id', 'diag_cat' + diagIndex) <?php foreach ($diagCat as $key => $value) { ?>
    //                         .append($("<option>")
    //                             .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
    //                         ) <?php } ?>
    //                     .val(diag_cat)
    //                 )
    //             )
    //             .append("<td><a href='#' onclick='$(\"#diag" + diagIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-trash'></i></a></td>")
    //         );

    //     initializeDiagPerawatSelect2("arpdiag_id" + diagIndex, diag_id, diag_name)
    //     $("#arpsuffer_type" + diagIndex).val(0)
    //     $("#arpdiag_cat" + diagIndex).val(diagIndex)
    // }
</script>

<script>
    function cetakAssessmenKeperawatan() {
        var titlekeperawatan = '';
        if ($("#arpvs_status_id1").prop("checked")) {
            titlekeperawatan = 'Dewasa'
        }
        if ($("#arpvs_status_id4").prop("checked")) {
            titlekeperawatan = 'Neonatus'
        }
        if ($("#arpvs_status_id5").prop("checked")) {
            titlekeperawatan = 'Anak'
        }
        if ($("#arpvs_status_id10").prop("checked")) {
            titlekeperawatan = 'Obsetric'
        }

        var win = window.open('<?= base_url() . '/admin/rm/keperawatan/cetak_keperawatan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '/' + titlekeperawatan, '_blank');
        // $.ajax({
        //     url: '<?= base_url() . '/admin/rm/assessment/cetakKeperawatan' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val(),
        //     type: "GET",
        //     success: function(data) {
        //         // Insert fetched content into modal
        //         // $("#cetakarpbody").html(data);
        //         $("#pdfFrame").attr("src", "data:application/pdf;base64," + data);
        //         // Display the modal
        //         $("#cetakarp").modal('show');
        //     }
        // });
    }
</script>