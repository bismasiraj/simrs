<?php
$aValueParent = array();
foreach ($aValue as $key => $value) {
    $aValueParent[$value['parameter_id']]['parameter_id'] = $value['parameter_id'];
    $aValueParent[$value['parameter_id']]['p_type'] = $value['p_type'];
}
?>
<script type="text/javascript">
    $(document).ready(function(e) {})



    $("#arbdweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arbdheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arbdtemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arbdnadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arbdtension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arbdtension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arbdsaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arbdnafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#arbdarm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });

    $("#assessmentbidanTab").on("mouseup", function() {
        $("#arbTitle").html("Asesmen Kebidanan")

        $("#arbanamnase_label").html("Subyektif (S)")
        $("#collapseRiwayat").slideDown()
        $("#groupRiwayat").slideDown()
        // $("#subjectiveGroupHeader").slideDown()
        $("#objectiveGroupHeader").slideDown()
        $("#arbFallRisk_Group").slideDown()
        $("#arbPainMonitoring_Group").slideDown()

        // initialAddArb()
        generateSatelite()
        getAssessmentKebidanan()
    })
</script>

<script type="text/javascript">
    $(".formsavearbbtn").on('click', (function(e) {
        var data = [];

        let docDataRm = new FormData(document.getElementById("formaddarb"))
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
            id: "formaddarb",
            data: docDataObjectRm
        };
        data.push(newObjRm)

        $("#formaddarb").find(".satelite").each(function() {
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
                $("#formsavearbbtnid").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                $("#formsavearbbtnid").html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)

                // $("#formaddarb").find('input, select, textarea').each(function() {
                //     const key = $(this).attr('id'); // Use ID or placeholder as key

                //     localStorage.removeItem(key);
                // })
                // $("#arbModal").modal("hide")
                // let formData = new FormData(document.getElementById("formaddarb"))
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
                    // fillDataArb(examFiltered145.length - 1)
                    // $("#arbAddDocument").slideUp()
                    $("#arbDocument").slideDown()
                }

                if (examForassessment.length > 0) {
                    displayTableAssessmentKebidanan();
                    // displayTableAssessmentKebidananForVitalSign();
                }

                riwayatAll = data.perawat.pasienHistory


                disableARB()

                fillRiwayatArb()
                $("#formsavearbbtnid").html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $(".formsavearbbtn").html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
                errorSwal(xhr);
            },
            complete: function() {
                $("#formsavearbbtnid").button(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
                // clicked_submit_btn.button('reset');
            }
        });
    }));
    // $(".formsavearbbtn").on('click', (function(e) {
    //     $("#formaddarb").find("button.btn-save:visible").trigger("click")
    //     let clicked_submit_btn = $(this).closest('form').find(':submit');
    //     e.preventDefault();
    //     $.ajax({
    //         url: '<?php echo base_url(); ?>admin/rm/assessment/saveExaminationInfo',
    //         type: "POST",
    //         // data: 

    //         data: new FormData(document.getElementById('formaddarb')),
    //         dataType: 'json',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         beforeSend: function() {
    //             $(".formsavearbbtn").html('<i class="spinner-border spinner-border-sm"></i>')
    //         },
    //         success: function(data) {
    //             $("#formaddarb").find('input, select, textarea').each(function() {
    //                 const key = $(this).attr('id'); // Use ID or placeholder as key

    //                 localStorage.removeItem(key);
    //             })
    //             $("#arbModal").modal("hide")
    //             let formData = new FormData(document.getElementById("formaddarb"))
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
    //                 fillDataArb(examFiltered145.length - 1)
    //                 // $("#arbAddDocument").slideUp()
    //                 $("#arbDocument").slideDown()
    //             }

    //             if (examForassessment.length > 0) {
    //                 displayTableAssessmentKebidanan();
    //                 displayTableAssessmentKebidananForVitalSign();
    //             }


    //             fillRiwayatArb()
    //             $(".formsavearbbtn").button(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)

    //             // getAssessmentKebidanan()
    //             // // $("#formsavearbbtn").slideUp()
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
    //             // disableARB()
    //         },
    //         error: function(xhr) { // if error occured
    //             alert("Error occured.please try again");
    //             $(".formsavearbbtn").html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
    //             errorSwal(xhr);
    //         },
    //         complete: function() {
    //             $(".formsavearbbtn").button(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)
    //             // clicked_submit_btn.button('reset');
    //         }
    //     });
    // }));

    const filterVsStatusIdBidan = (value) => {
        if (value == 1) {
            $("#arbApgar_Group").slideUp()
            $("#arbAnak_Group").slideUp()
        } else if (value == 4) {
            $("#arbApgar_Group").slideDown()
            $("#arbAnak_Group").slideDown()
        } else if (value == 5) {
            $("#arbApgar_Group").slideUp()
            $("#arbAnak_Group").slideDown()
        } else if (value == 10) {
            $("#arbApgar_Group").slideUp()
            $("#arbAnak_Group").slideUp()
        }
        $("#arbvs_status_id").val(value)
    }

    function generateSatelite() {
        $("#bodyFallRiskBidan").html("")
        // addFallRisk(1, 0, 'arbbody_id', 'bodyFallRiskBidan')
        $("#bodyApgarBidan").html("")
        // addApgar(1, 0, 'arbbody_id', 'bodyApgarBidan')
        $("#bodyPainMonitoringBidan").html("")
        // addPainMonitoring(1, 0, 'arbbody_id', 'bodyPainMonitoringBidan')
        $("#bodyGiziBidan").html("")
        // addGizi(1, 0, 'arbbody_id', 'bodyGiziBidan')
        $("#bodyTriageBidan").html("")
        // addTriage(1, 0, 'arbbody_id', 'bodyTriageBidan')
        $("#bodyADLBidan").html("")
        // addADL(1, 0, 'arbbody_id', 'bodyADLBidan')
        $("#bodyDekubitusBidan").html("")
        // addDekubitus(1, 0, 'arbbody_id', 'bodyDekubitusBidan')
        $("#bodyStabilitasBidan").html("")
        // addDerajatStabilitas(1, 0, 'arbbody_id', 'bodyStabilitasBidan')
        $("#bodyEducationFormBidan").html("")
        // addEducationForm(1, 0, 'arbbody_id', 'bodyEducationFormBidan')
        $("#bodyGcsBidan").html("")
        // addGcs(1, 0, 'arbbody_id', 'bodyGcsBidan')
        $("#bodyIntegumenBidan").html("")
    }

    function getAssessmentKebidanan(top = 10, episode = 1) {
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
            beforeSend: function() {},
            processData: false,
            success: function(data) {
                examForassessment = data.examInfo
                examForassessmentDetail = data.examDetail
                riwayatAll = data.pasienHistory

                examSelected = [];

                var vsStatusId = [10];

                let examFiltered145 = examForassessment.filter(item => item.account_id == 2)
                if (examFiltered145.length > 0) {
                    $("#arbDocument").slideDown()
                }

                if (examForassessment.length > 0) {
                    displayTableAssessmentKebidanan();
                    // displayTableAssessmentKebidananForVitalSign();
                }


                fillRiwayatArb()
            },
            error: function() {
                $("#cpptBody").html(tempTablesNull())
                $("#vitalSignBody").html(tempTablesNull())
            }
        });
    }

    function initialAddArb() {

        <?php if (@$visit['specialist_type_id'] == '1.05') {
        ?>
            $("#arbTitle").html("Assessment Kebidanan")
        <?php
        } ?>
        let bodyId = '<?= @$visit['session_id']; ?>';
        let isnew = false;
        $.each(examForassessment, function(key, value) {
            if (value.body_id == bodyId && value.account_id) {
                isnew = true;
            }
        })
        // if (isnew) {
        //     alert("Anda sudah pernah membuat dokumen Assessment pada sesi " + bodyId + ". Silahkan buat sesi baru.");
        //     return false;
        // }

        $("#bodyDiagBidan").html("")


        $("#accordionAssessmentAwal .accordion-collapse.show").collapse('hide')
        $("#bodyFallRiskBidanAddBtn").html(`<a onclick="addFallRisk(1, 0, 'arbbody_id', 'bodyFallRiskBidan', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyPainMonitoringBidanAddBtn").html(`<a onclick="addPainMonitoring(1, 0, 'arbbody_id', 'bodyPainMonitoringBidan', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`);
        $("#bodyTriageBidanAddBtn").html(`<a onclick="addTriage(1,0,'arbbody_id', 'bodyTriageBidan', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("bodyApgarBidanAddBtn").html(`<a onclick="addApgar(1, 0, 'arbbody_id', 'bodyApgarBidan', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyGiziBidanAddBtn").html(`<a onclick="addGizi(1,1, 'arbbody_id','bodyGiziBidan', false, 'arb')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyADLBidanAddBtn").html(`<a onclick="addADL(1,1, 'arbbody_id','bodyADLBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyDekubitusBidanAddBtn").html(`<a onclick="addDekubitus(1,1, 'arbbody_id','bodyDekubitusBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyStabilitasBidanAddBtn").html(`<a onclick="addDerajatStabilitas(1, 0, 'arbbody_id', 'bodyStabilitasBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addEducationIntegrationButton").html(`<a onclick="addEducationIntegration(1,0, 'arbbody_id','bodyEducationIntegration', false)" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyEducationFormBidanAddBtn").html(`<a onclick="addEducationForm(1,1, 'arbbody_id','bodyEducationFormBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyGcsBidanAddBtn").html(`<a onclick="addGcs(1,0,'arbbody_id', 'bodyGcsBidan', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyIntegumenBidanAddBtn").html(`<a onclick="addIntegumen(1,1, 'arbbody_id','bodyIntegumenBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyAnakBidanAddBtn").html(`<a onclick="addAnak(1,1, 'arbbody_id','bodyAnakBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#bodyNeonatusBidanAddBtn").html(`<a onclick="addNeonatus(1,1, 'arbbody_id','bodyNeonatusBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addNeurosensorisButton").html(`<a onclick="addNeurosensoris(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addPencernaanButton").html(`<a onclick="addPencernaan(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addPerkemihanButton").html(`<a onclick="addPerkemihan(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addPernapasanButton").html(`<a onclick="addPernapasan(1,0, 'arbbody_id', 'bodyPernapasan', false, 'arb')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addPsikologiButton").html(`<a onclick="addPsikologi(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSeksualButton").html(`<a onclick="addSeksual(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSirkulasiButton").html(`<a onclick="addSirkulasi(1,0,'arbbody_id', 'bodySirkulasi', false, 'arb')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSocialButton").html(`<a onclick="addSocial(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addHearingButton").html(`<a onclick="addHearing(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $("#addSleepingButton").html(`<a onclick="addSleeping(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`)
        $('#arbcollapseRiwayatARB').collapse('show');


        // const date = new Date();
        // bodyId = date.toISOString().substring(0, 23);
        // bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#formaddarb").find('input[type="text"], input[type="hidden"], textarea').val(null)
        var initialexam = examForassessment[examForassessment.length - 1]
        $.each(initialexam, function(key, value) {
            $("#arb" + key).val(value)
        })

        var initialvital = examForassessmentDetail[examForassessmentDetail.length - 1]

        fillExaminationDetail(initialvital, 'arb')

        var ageYear = <?= @$visit['ageyear']; ?>;
        var ageMonth = <?= @$visit['agemonth']; ?>;
        var ageDay = <?= @$visit['ageday']; ?>;

        if (visit?.ageyear === 0 && visit?.agemonth === 0 && visit?.ageday <= 28) {
            $("#arbvs_status_id5").prop("checked", true);
        } else if (visit.ageyear >= 18) {
            $("#arbvs_status_id1").prop("checked", true);
        } else {
            $("#arbvs_status_id4").prop("checked", true);
        }
        $("#arbbody_id").val(bodyId)
        $("#arborg_unit_code").val('<?= @$visit['org_unit_code']; ?>')
        $("#arbpasien_diagnosa_id").val(null)
        $("#arbdiagnosa_id").val(null)
        $("#arbno_registration").val('<?= @$visit['no_registration']; ?>')
        $("#arbvisit_id").val('<?= @$visit['visit_id']; ?>')
        $("#arbbill_id").val(null)
        <?php if (@$visit['isrj'] == 0) { ?>
            // $('#arbclinic_id').val('<?= @$visit['class_room_id']; ?>')
        <?php } else { ?>
            // $('#arbclinic_id').val('<?= @$visit['clinic_id']; ?>')
        <?php } ?>
        let clinicSelect = clinics.filter(item => item.clinic_id == '<?= @$visit['clinic_id']; ?>')
        $("#arbclinic_id").html($('<option></option>')
            .val(clinicSelect[0].clinic_id)
            .text(clinicSelect[0].name_of_clinic))

        <?php if (@$visit['isrj'] == '0') {
        ?>
            $("#arbemployee_id").html('<option value="<?= @$visit['employee_inap']; ?>"><?= @$visit['fullname_inap']; ?></option>')
        <?php
        } else {
        ?>
            $("#arbemployee_id").html('<option value="<?= @$visit['employee_id']; ?>"><?= @@$visit['fullname']; ?></option>')
        <?php
        } ?>
        $("#arbclass_room_id").val('<?= @$visit['class_room_id']; ?>')
        $("#arbbed_id").val('<?= @$visit['bed_id']; ?>')
        $("#arbin_date").val('<?= @$visit['in_date']; ?>')
        $("#arbexit_date").val('<?= @$visit['exit_date']; ?>')
        $("#arbkeluar_id").val('<?= @$visit['keluar_id']; ?>')
        // flatpickrInstances["flatarbexamination_date"].setDate(moment().format("DD/MM/YYYY HH:mm"))
        // $("#flatarbexamination_date").trigger("change")
        $("#arbexamination_date").val(get_date())
        $("#arbmodified_date").val(get_date())
        $("#arbmodified_by").val('<?= user()->username; ?>')
        $("#arbmodified_from").val('<?= @$visit['clinic_id']; ?>')
        $("#arbstatus_pasien_id").val('<?= @$visit['status_pasien_id']; ?>')
        $("#arbageyear").val('<?= @$visit['ageyear']; ?>')
        $("#arbagemonth").val('<?= @$visit['agemonth']; ?>')
        $("#arbageday").val('<?= @$visit['ageday']; ?>')
        $("#arbthename").val('<?= @$visit['diantar_oleh']; ?>')
        $("#arbtheaddress").val('<?= @$visit['visitor_address']; ?>')
        $("#arbtheid").val('<?= @$visit['pasien_id']; ?>')
        $("#arbisrj").val('<?= @$visit['isrj']; ?>')
        $("#arbgender").val('<?= @$visit['gender']; ?>')
        $("#arbdoctor").val('<?= @@$visit['fullname']; ?>')
        $("#arbkal_id").val('<?= @$visit['kal_id']; ?>')
        $("#arbpetugas_id").val('<?= user()->username; ?>')
        $("#arbpetugas").val('<?= user()->getFullname(); ?>')
        $("#arbpetugas_type").val('<?= user()->getOneRoles(); ?>')
        $("#arbaccount_id").val(2)

        <?php if (@$visit['specialist_type_id'] == '1.05') {
        ?>
            $("#arbvs_status_id10").trigger("click")
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

        $("#arbweight").val(berat)
        $("#arbheight").val(tinggi)

        $('#kebidananListLinkAll').html("")

        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/ralan_anak/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #armbody_id").val() + '" target="_blank">Assessmen Kebidanan Ralan Anak</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/ralan_dewasa/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Assessmen Kebidanan Ralan Dewasa</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/ranap_dewasa/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Assessmen Kebidanan Ranap Dewasa</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/ranap_kandungan/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Assessmen Kebidanan Ranap Kandungan</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/ranap_neonatus/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Assessmen Kebidanan Ranap Neonatus</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/asuhan_gizi/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/asuhan_kebidanan/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/cppt_ranap/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">CPPT Rawat Inap</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/cppt_ralan/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">CPPT Rawat Jalan</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/diagnosis_kebidanan/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Diagnosis Kebidanan</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/edukasi_integrasi/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/edukasi_obat/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/formulir_edukasi/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/hak_dan_kewajiban/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Hak dan Kewajiban Pasien</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/identitas/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/implementasi/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Implementasi Asuhan Kebidanan</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/inform_concern/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Inform Concern (Pemasangan Infus)</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/igd_anak/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Kebidanan IGD Anak</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/igd_dewasa/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Kebidanan IGD Dewasa</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/monitoring_nyeri/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Monitoring Nyeri</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/resiko_jatuh/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/persetujuan_umum/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/ringkasan/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/sdki/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
        $('#kebidananListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/kebidanan/transfer_internal/' . base64_encode(json_encode(@$visit)); ?>/' + $(" #arbbody_id").val() + '" target="_blank">Transfer Internal</a></li>')

        $("#arbisvalid").val(0)

        $("#arbcollapseVitalSign").find("#arbtotal_score").html("")
        $("#arbcollapseVitalSign").find("span.h6").html("")

        // $("#arbAddDocument").slideUp()
        $("#arbDocument").slideDown()
        enableARB()
        fillRiwayatArb()

        generateSatelite()
        groupeActionPrgInAssBid()

        // $("#formaddarb").find('input, select, textarea').each(function() {
        // const key=$(this).attr('id'); // Use ID or placeholder as key

        // const savedValue=localStorage.getItem(key);
        // if (savedValue) {
        // $(this).val(savedValue);
        // }
        // })
        $("#arbModal").modal("show")
    }
    const fillDataArb = async (index) => {
        $("#bodyDiagBidan").html("")
        $("#formaddarbqrcode1").html("")
        $("#formaddarbsigner1").html("")
        $("#formaddarbqrcode2").html("")
        $("#formaddarbsigner2").html("")

        let ex = examForassessment[index]
        $.each(ex, function(key, value) {
            if (!Array.isArray(value)) {
                $("#arb" + key.replace(/([.#:,\[\]\/])/g, '\\$1')).val(value)
            }
        })
        let examdetail = examForassessmentDetail.filter(item => item?.body_id == $("#arbbody_id").val())
        fillExaminationDetail(examdetail[0], "arb")

        let clinicSelect = clinics.filter(item => item.clinic_id == '<?= @$visit['clinic_id']; ?>')
        $("#arbclinic_id").html($('<option></option>')
            .val(clinicSelect[0].clinic_id)
            .text(clinicSelect[0].name_of_clinic))
        $("#arbemployee_id").html('<option value="' + ex.employee_id + '">' + ex.fullname + '</option>')
        $("#arbvs_status_id" + ex.vs_status_id).prop("checked", true)
        // let formattedValue = moment(ex.examination_date).format('DD/MM/YYYY HH:mm');
        $("#arbcollapseVitalSign").find("input").each(function() {
            $(this).trigger("change")
        })
        $('#arbcollapseRiwayatARB').collapse('show');
        // flatpickrInstances["flatarbexamination_date"].setDate(
        //     formatedDatetimeFlat(ex.examination_date)
        // );
        // $("#flatarbexamination_date").trigger("change");
        $("#arbexamination_date").val(ex.examination_date)

        getSateliteBidan(ex)
        groupeActionPrgInAssBid()

        await checkSignSignature("formaddarb", "arbbody_id", "formsavearbbtnid", 3)

        disableARB()



        $("#arbModal").modal("show")
    }
    const getSateliteBidan = (ex) => {
        postData({
            document_id: ex.body_id,
            visit_id: ex.visit_id,
            specialist_type_id: ex.specialist_type_id,
            clinic_id: ex.specialist_type_id,
            no_registration: ex.no_registration
        }, 'admin/rm/assessmentperawat/getSatelitePerawat', (res) => {
            $("#bodyGcsBidan").html("")
            $("#bodyFallRiskBidan").html("")
            $("#bodyPainMonitoringBidan").html("")
            $("#bodyPernapasan").html("")
            $("#bodyApgarBidan").html("")
            $("#bodyTriageBidan").html("")
            $("#bodyGiziBidan").html("")
            $("#bodyADLBidan").html("")
            $("#bodyDekubitusBidan").html("")
            $("#bodyStabilitasBidan").html("")
            $("#bodyIntegumenBidan").html("")
            $("#bodyNeurosensoris").html("")
            $("#bodyPencernaan").html("")
            $("#bodyPerkemihan").html("")
            $("#bodyPsikologiBidan").html("")
            $("#bodySirkulasi").html("")
            $("#bodySeksual").html("")
            $("#bodySocial").html("")
            $("#bodyHearing").html("")
            $("#bodySleeping").html("")
            if (res.pasienHistory) {
                riwayatAll = res?.pasienHistory;
                fillRiwayatArb()
            }
            if (res.diagBidan) {
                $.each(res.diagBidan, function(key, value) {
                    addRowDiagBidanBasic('bodyDiagBidan', '', value.diagnosan_id, value.diag_notes, 'arbModal')
                })
            }
            if (res.gcs) {
                gcsAll = res.gcs
                // gcsDetailAll = data.gcsDetail
                $.each(gcsAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addGcs(0, key, "arbbody_id", "bodyGcsBidan", false)
                        return false
                    }
                })
            }
            if (res.fallRisk) {
                let data = res.fallRisk
                fallRisk = data.fallRisk
                fallRiskDetail = data.fallRiskDetail

                $.each(fallRisk, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addFallRisk(0, key, "arbbody_id", "bodyFallRiskBidan", false)
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
                    if (value.document_id == $("#arbbody_id").val()) {
                        addPainMonitoring(0, key, 'arbbody_id', "bodyPainMonitoringBidan", false)
                        return false
                    }
                })
            }

            if (res.pernapasan) {
                napas = res.pernapasan
                // stabilitasDetail = data.stabilitasDetail

                $.each(napas, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addPernapasan(0, key, "arbbody_id", "bodyPernapasan", false)
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
                    if (value.document_id == $("#arbbody_id").val()) {
                        addApgar(0, key, "arbbody_id", "bodyApgarBidan", false)
                        return false
                    }
                })
            }
            if (res.triage) {
                triage = res.triage.triage
                triageDetil = res.triage.triageDetil

                $.each(triage, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addTriage(0, key, "arbbody_id", "bodyTriageBidan", false)
                        return false
                    }
                })
            }
            if (res.gizi) {
                giziAll = res.gizi.gizi
                giziDetailAll = res.gizi.giziDetail

                $.each(giziAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addGizi(0, key, "arbbody_id", "bodyGiziBidan", false)
                        return false
                    }
                })
            }
            if (res.adl) {
                adlAll = res.adl.adl
                // stabilitasDetail = data.stabilitasDetail

                $.each(adlAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addADL(0, key, "arbbody_id", "bodyADLBidan", false)
                        return false
                    }
                })
            }
            if (res.dekubitus) {
                dekubitusAll = res.dekubitus.dekubitus

                $.each(dekubitusAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addDekubitus(0, key, 'arbbody_id', "bodyDekubitusBidan", false)
                        return false
                    }
                })
            }
            if (res.stabilitas) {
                stabilitas = res.stabilitas.stabilitas
                stabilitasDetail = res.stabilitas.stabilitasDetail

                $.each(stabilitas, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addDerajatStabilitas(0, key, "arbbody_id", "bodyStabilitasBidan", false)
                        return false
                    }
                })
            }
            if (res.integumen) {
                integumenAll = res.integumen.integumen
                console.log(integumenAll)
                // stabilitasDetail = data.stabilitasDetail

                $.each(integumenAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addIntegumen(0, key, 'arbbody_id', 'bodyIntegumenBidan')
                        return false
                    }
                })
            }
            if (res.neurosensoris) {
                neuroAll = res.neurosensoris.neuro
                console.log(neuroAll)

                $.each(neuroAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addNeurosensoris(0, key)
                        return false
                    }
                })
            }
            if (res.pencernaan) {
                digestAll = res.pencernaan.pencernaan

                $.each(digestAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addPencernaan(0, key)
                        return false
                    }
                })
            }
            if (res.perkemihan) {
                perkemihanAll = res.perkemihan.perkemihan
                // stabilitasDetail = data.stabilitasDetail

                $.each(perkemihanAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addPerkemihan(0, key)
                        return false
                    }
                })
            }
            if (res.psikologi) {
                psikologiAll = res.psikologi.psikologi
                psikologiDetailAll = res.psikologi.psikologiDetail

                $.each(psikologiAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addPsikologi(0, key, 'arbbody_id', 'bodyPsikologiBidan')
                        return false
                    }
                })
            }
            if (res.sirkulasi) {
                sirkulasiAll = res.sirkulasi.sirkulasi
                $.each(sirkulasiAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addSirkulasi(0, key, "arbbody_id", "bodySirkulasi")
                        return false
                    }
                })
            }
            if (res.seksual) {
                seksualAll = res.seksual.seksual

                $.each(seksualAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addSeksual(0, key)
                        return false
                    }
                })
            }
            if (res.social) {
                socialAll = res.social.social

                $.each(socialAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addSocial(0, key)
                        return false
                    }
                })
            }
            if (res.hearing) {
                hearingAll = res.hearing.hearing

                $.each(hearingAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {

                        addHearing(0, key)
                        return false
                    }
                })
            }
            if (res.sleeping) {
                sleepingAll = res.sleeping.sleeping

                $.each(sleepingAll, function(key, value) {
                    if (value.document_id == $("#arbbody_id").val()) {
                        addSleeping(0, key)
                        return false
                    }
                })
            }
        }, (beforesend) => {
            // getLoadingGlobalServices('bodydatapemeriksaanKulit')
        })
    }

    function fillRiwayatArb() {
        $.each(riwayatAll, function(key, value) {
            if ($("#arbGEN0009" + value.value_id).is(":checkbox")) {
                $("#arbGEN0009" + value.value_id).prop("checked", true)
                // $("#arbGEN0009" + value.value_id).prop("disabled", true)
            } else {
                $("#arbGEN0009" + value.value_id).val(value.histories)
                // $("#arbGEN0009" + value.value_id).prop("disabled", true)
            }
        })
    }

    const signArb = async () => {
        // $("#formeditarbid").trigger("click")
        //const addSignUser = (formId, container, primaryKey, buttonId, docs_type, user_type, sign_ke = 1, title)
        let titlenya = $("#arbTitle").html()
        let titlerj = ''
        let titlejenis = ''
        if ($("#arbisrj") == 0) {
            titlerj = ' Rawat Inap';
        } else {
            titlerj = ' Rawat Jalan'
        }
        switch ($('#formaddarb input[name="vs_status_id"]:checked').val()) {
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
        await addSignUser("formaddarb", "arb", "arbbody_id", "formsavearbbtnid", 3, 1, 1, $("#arbTitle").html() + titlejenis + titlerj)
    }

    function displayTableAssessmentKebidanan(index) {
        $("#assessmentKebidananHistoryBody").html("")
        $("#cpptBody").html("")
        // var vsStatusId = [1, 4, 5];


        // let examfiltered14 = examForassessment.filter(item => (vsStatusId.includes(item.vs_status_id)))


        $.each(examForassessment, function(key, value) {
            var pd = examForassessment[key]
            if (value.account_id == '2') {
                var titlekebidanan = '';
                if (value.vs_status_id == 1) {
                    titlekebidanan = 'Dewasa'
                }
                if (value.vs_status_id == 4) {
                    titlekebidanan = 'Neonatus'
                }
                if (value.vs_status_id == 5) {
                    titlekebidanan = 'Anak'
                }
                if (value.vs_status_id == 10) {
                    titlekebidanan = 'Obsetric'
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
                                    <button type="button" class="btn btn-success" onclick="fillDataArb(${key})">Lihat</button>
                                    <button type="button" class="btn btn-light" onclick="openPopUpTab('<?= base_url('admin/rm/keperawatan/cetak_kebidanan/' . base64_encode(json_encode(@$visit))) ?>/${value.body_id}/${titlekebidanan}')">Cetak</button>
                                </div>
                            </td>
                        </tr>
                    `;
                    $("#assessmentKebidananHistoryBody").append(rowHtml);
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
                                    <button type="button" class="btn btn-success" onclick="fillDataArb(${key})">Lihat</button>
                                    <button type="button" class="btn btn-light" onclick="openPopUpTab('<?= base_url('admin/rm/keperawatan/cetak_kebidanan/' . base64_encode(json_encode(@$visit))) ?>/${value.body_id}/${titlekebidanan}')">Cetak</button>
                                </div>
                            </td>
                        </tr>
                    `;
                    $("#assessmentKebidananHistoryBody").append(rowHtml);
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

    function enableARB() {
        $("#formsavearbbtnid").slideDown()
        $("#formeditarbid").slideUp()
        // $(".formsignarb").slideDown()
        $("#formaddarb input").prop("disabled", false)
        $("#formaddarb textarea").prop("disabled", false)
        $("#formaddarb select").prop("disabled", false)
        $("#formaddarb option").prop("disabled", false)

        $("#vitalSignBidan").find("button").click()
        $("#formaddarb").find(".btn-to-hide").slideDown()
        $("#formaddarb").find(".btn-edit").each(function() {
            $(this).trigger("click")
        })
    }

    const disableARB = () => {
        $("#formsavearbbtnid").slideUp()
        if ($("#arbmodified_by").val() == '<?= user()->username; ?>' || <?= json_encode(user()->checkRoles(['superuser'])) ?>) {
            $("#formeditarbid").slideDown()
        } else {
            $("#formeditarbid").slideUp()
        }
        // $(".formsignarb").slideUp()
        $("#formaddarb input").prop("disabled", true)
        $("#formaddarb textarea").prop("disabled", true)
        $("#formaddarb select").prop("disabled", true)
        $("#formaddarb option").prop("disabled", true)
        $("#formaddarb").find(".btn-to-hide").slideUp()
        $("#vitalSignBidan").find("button").click()
        if ($("#arbvalid_user").val() != '') {
            $("#formaddarbbtnid").slideUp()
            $("#formeditarbid").slideUp()
            $("#formsignarbid").slideUp()
            $("#formaddarb").find(".btn-add-doc").remove()
        } else {
            $("#formaddarbbtnid").slideDown()
            $("#formeditarbid").slideDown()
            $("#formsignarbid").slideDown()
            $("#formaddarb").find(".btn-add-doc").remove()
        }
    }

    $(".formaddarbbtn").on("mouseup", function() {
        initialAddArb()
    })
</script>

<script>
    function cetakAssessmenKebidanan() {
        var titlekeperawatan = '';
        if ($("#arbvs_status_id1").prop("checked")) {
            titlekeperawatan = 'Dewasa'
        }
        if ($("#arbvs_status_id4").prop("checked")) {
            titlekeperawatan = 'Neonatus'
        }
        if ($("#arbvs_status_id5").prop("checked")) {
            titlekeperawatan = 'Anak'
        }
        if ($("#arbvs_status_id10").prop("checked")) {
            titlekeperawatan = 'Obsetric'
        }

        openPopUpTab('<?= base_url() . '/admin/rm/keperawatan/cetak_kebidanan/' . base64_encode(json_encode(@$visit)); ?>' + '/' + $("#arbbody_id").val() + '/' + titlekeperawatan)
    }
</script>