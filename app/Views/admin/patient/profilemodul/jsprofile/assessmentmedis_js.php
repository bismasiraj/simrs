<?php
// dd(@$visit);
?>

<script type='text/javascript'>
    var mapAssessment = JSON.parse('<?= json_encode($mapAssessment); ?>')
    var canvasAssessment;
    var specialistTypeId = '<?= @$visit['specialist_type_id']; ?>'
    var assessmentMedisType = 0;
    var patientCategoryId = '<?= @$visit['patient_category_id']; ?>'
    let mappingOrder = [{
            name: "appendRiwayatMedis",
            order: 2,
            isactive: 0
        },
        {
            name: "appendAnamnesisMedis",
            order: 1,
            isactive: 0
        },
        {
            name: "appendVitalSignMedis",
            order: 3,
            isactive: 0
        },
        {
            name: "appendOculusAccordion",
            order: 4,
            isactive: 0
        },
        {
            name: "appendPemeriksaanFisikMedis",
            order: 5,
            isactive: 0
        },
        {
            name: "appendLokalisAccordion",
            order: 6,
            isactive: 0
        },
        {
            name: "appendDiagnosaAccordion",
            order: 7,
            isactive: 0
        },
        {
            name: "appendProsedurAccordion",
            order: 8,
            isactive: 0
        }, {
            name: "appendTriaseMedis",
            order: 9,
            isactive: 0
        },
        {
            name: "appendGcsMedisAccordion",
            order: 10,
            isactive: 0
        },
        {
            name: "appendPainMonitoringMedisAccordion",
            order: 11,
            isactive: 0
        },
        {
            name: "appendPenunjangTerapi",
            order: 12,
            isactive: 0
        },
        {
            name: "appendFormEdukasi",
            order: 13,
            isactive: 0
        },
        {
            name: "appendRtlAccordion",
            order: 14,
            isactive: 0
        },
        {
            name: "appendFallRiskMedisAccordion",
            order: 15,
            isactive: 0
        }
    ]

    function getAssessmentMedis(diagCat) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentMedis',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit.visit_id,
                'nomor': nomor,
                'diagCat': diagCat,
                'norujukan': visit?.norujukan,
                'isrj': visit?.isrj
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(e) {
                getLoadingscreen("contentAssessmentMedis", "loadContentAssessmentMedis")
            },
            success: function(data) {
                $("#assessmentMedisHistoryBody").html("")

                pasienDiagnosa = []
                pasienDiagnosaAll = data.pasienDiagnosa
                riwayatAll = data.pasienHistory
                diagnosasAll = data.pasienDiagnosas
                proceduresAll = data.pasienProcedures
                lokalisAll = data.lokalis

                if (pasienDiagnosaAll.length > 0) {
                    displayTableAssessmentMedis()
                } else {
                    initialAddArm()
                }
            },
            error: function() {

            }
        });
    }
    $("#assessmentmedisTab").on("click", function() {
        var accMedisName = "accordionAssessmentMedis"
        // Call each function to append respective accordion items
        $("#accordionAssessmentMedis").html("")
        // if (<?= (@$visit['clinic_id'] == 'P012' && is_null(@$visit['class_room_id'])) ? true : false; ?>  ) {
        assessmentMedisType = 3

        // $("#formaddarmbtn").trigger("click")
        appendCetakMedis(accMedisName)
        // appendRtlAccordion(accMedisName);


        // $("#armdiag_cat").val(3)
    })
    $("#assessmentmedisTab").on("mouseup", function() {
        getAssessmentMedis(3)
    })
    $("#rekammedisTab").on("click", function() {
        var accMedisName = "accordionAssessmentMedis"
        getAssessmentMedis(1)

        $("#armTitle").html("Resume Medis")
        assessmentMedisType = 1;

        $("#accordionAssessmentMedis").html("")
        appendAnamnesisMedis(accMedisName);
        appendVitalSignMedis(accMedisName);
        appendPemeriksaanFisikMedis(accMedisName);
        appendDiagnosaAkhirAccordion(accMedisName);
        appendProsedurResumeAccordion(accMedisName);
        appendPenunjangTerapi(accMedisName);
        appendCetakMedis(accMedisName);
    })
</script>

<script type="text/javascript">
    const generateLokalis = () => {
        var specialistLokalis = '';
        if (typeof(pasienDiagnosa.specialist_type_id) === 'undefined') {
            specialistLokalis = '<?= @$visit['specialist_type_id']; ?>'
        } else {
            specialistLokalis = pasienDiagnosa.specialist_type_id
        }

        $.each(canvasAssessment, function(key1, value1) {
            var canvas = document.getElementById('canvas' + value1.p_type + value1.parameter_id + value1.value_id);
            const canvasDataInput = document.getElementById('lokalis' + value1.value_id);
            var ctx = canvas.getContext('2d');
            var drawing = false;
            var line = []; // Store points for the current line being drawn
            let drawingHistory = [];

            var img = new Image();
            img.onload = function() {
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            };
            img.src = '<?= base_url('assets/img/asesmen') ?>' + value1.value_info;

            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);



            // setTimeout(function() {
            // }, )

            function startDrawing(e) {
                drawing = true;
                draw(e);
                line = []; // Clear the current line
                line.push({
                    x: e.offsetX,
                    y: e.offsetY
                }); // Add the starting point of the line
            }

            function draw(e) {
                if (!drawing) return;

                ctx.lineWidth = 2;
                ctx.lineCap = 'round';
                ctx.strokeStyle = 'red';

                const x = e.offsetX;
                const y = e.offsetY;

                ctx.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
                ctx.stroke();
                ctx.beginPath();
                ctx.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
                line.push({
                    x,
                    y
                }); // Add the current point to the line
            }

            function stopDrawing() {
                drawing = false;
                ctx.beginPath();
                drawingHistory.push(line);
            }
            $("#clear" + value1.value_id).on("click", function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                drawingHistory = []; // Clear the drawing history
                img.onload = function() {
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                };
                img.src = '<?= base_url('assets/img/asesmen') ?>' + value1.value_info;
            })
            $("#undo" + value1.value_id).on("click", function() {
                if (drawingHistory.length > 0) {
                    // Remove the last line from the drawing history
                    drawingHistory.pop();
                    // Clear the canvas
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    // Redraw the remaining lines
                    drawingHistory.forEach(line => {
                        for (let i = 1; i < line.length; i++) {
                            ctx.beginPath();
                            ctx.moveTo(line[i - 1].x, line[i - 1].y);
                            ctx.lineTo(line[i].x, line[i].y);
                            ctx.stroke();
                        }
                    });
                }
            })
        })

        $.each(aparameter, function(key, value) {
            if (value.p_type == 'GEN0002') {
                $.each(avalue, function(key1, value1) {
                    if (value.p_type == value1.p_type && value.parameter_id == value1.parameter_id && value1.value_score == '3') {
                        $.each(mapAssessment, function(key2, value2) {})
                    }
                })
            }
        })
    }


    function saveCanvasData() {
        $.each(canvasAssessment, function(key, value1) {
            var canvasId = document.getElementById('canvas' + value1.p_type + value1.parameter_id + value1.value_id);
            if (canvasId) {
                let filePath = value1.value_info;
                let extension = filePath.split('.').pop(); // Get extension
                let canvasResult = canvasId.toDataURL('image/' + extension);
                $("#lokalis" + value1.value_id).val(canvasResult);
            }
        })
    }
</script>
<script type="text/javascript">
    var currentIndex;
    var indexLength;
    $(document).ready(function(e) {
        // initialAddArm()
    })

    const initialAddArm = async () => {
        if (assessmentMedisType == 3)
            var pasienDiagnosaId = '<?= @$visit['session_id']; ?>';
        else
            var pasienDiagnosaId = '<?= @$visit['session_id']; ?>' + assessmentMedisType.toString();

        let isnew = false;
        $.each(pasienDiagnosaAll, function(key, value) {
            if (value?.pasien_diagnosa_id == pasienDiagnosaId) {
                isnew = true;
            }
        })
        if (isnew) {
            return alert("Anda sudah pernah membuat dokumen Assessment Medis pada sesi " + pasienDiagnosaId + ". Silahkan membuat sesi yang baru.");
        }
        $("#armModal").modal("show")

        var accMedisName = "accordionAssessmentMedis";
        pasienDiagnosa = [];

        $("#formaddarm input").val(null)
        $("#formaddarm select").val(null)
        $("#formaddarm textarea").val(null)
        $("#accordionAssessmentMedis").html("")




        <?php if (user()->checkPermission("assessmentmedis", "c") || user()->checkPermission("assessmentmedis", "u")) {
        ?>
            enableARM()
        <?php
        } ?>
        const date = new Date();


        // pasienDiagnosaId = date.toISOString().substring(0, 23);
        // pasienDiagnosaId = pasienDiagnosaId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        // copyLastArm()

        if (assessmentMedisType == 1) {
            renderViewResumeMedis(accMedisName, pasienDiagnosaId, 1)
        } else {
            renderViewAssessmentMedis(accMedisName, pasienDiagnosaId, visit?.specialist_type_id, 1)
        }
        if (typeof pasienDiagnosa?.description !== 'undefined') {
            disableRM()
            $("#formaddrmbtn").slideUp()
            $("#formeditrm").slideDown()
        }
        fillRiwayat()




        if (visit.isrj == '1') {
            updateWaktu(4)
        }
    }

    const renderViewResumeMedis = async (accMedisName, pasienDiagnosaId, flag = 1) => {
        $("#armTitle").html("Resume Medis")

        $("#accordionAssessmentMedis").html("")



        const req = await libAsyncAwaitPost({
                specialist_type_id: "1.00"
            },
            "admin/rm/assessment/getMapAssessment"
        );
        $("#accordionAssessmentMedis").html("")


        let mappingContentMap = JSON.parse(req);
        let updatedMappingContentMap = mappingContentMap

        const sortedMappingContentMap = updatedMappingContentMap.sort((a, b) => a.theorder - b.theorder);
        let val = avalue?.filter(item => item.p_type == 'GEN0002')

        appendAnamnesisMedis(accMedisName);
        appendVitalSignMedis(accMedisName);
        appendGcsMedisAccordion(accMedisName);
        // if ("<?= @@$visit['specialist_type_id']; ?>" == '1.16') {
        //     appendSarafAccordion(accMedisName)
        // } else if ("<?= @@$visit['specialist_type_id']; ?>" == "1.12") {
        //     appendDermatologiAccordion(accMedisName)
        // } else if ("<?= @@$visit['specialist_type_id']; ?>" == "1.10") {
        //     appendOculusAccordion(accMedisName)

        // } else if ("<?= @@$visit['specialist_type_id']; ?>" == "1.02") {} else {
        // }
        appendPemeriksaanFisikMedis(accMedisName);
        // let pf = avalue.filter(item => item.p_type == 'GEN0002' && item.value_score == 2)
        // $.each(pf, function(key, value1) {
        //     $("#appendPemeriksaanFisikMedisBody").append(
        //         `<div class="col-sm-6 col-xs-12">
        //                 <div class="mb-3">
        //                     <div class="form-group">
        //                         <label for="arm${value1?.p_type+ value1?.parameter_id+ value1?.value_id}">${value1?.value_desc}</label>
        //                         <textarea id="arm${value1?.p_type+ value1?.parameter_id+ value1?.value_id}" name="fisik${value1?.value_id}" rows="2" class="form-control " autocomplete="off"></textarea>
        //                     </div>
        //                 </div>
        //             </div>`
        //     )
        //     // if (value?.doc_type == 3) {
        //     //     $.each(val, function(key1, value1) {
        //     //         if (value?.doc_id == value1?.value_id) {
        //     //         }
        //     //     })
        //     // }
        // })
        $.each(sortedMappingContentMap, function(key, value) {
            if (value?.doc_type == 3) {
                $.each(val, function(key1, value1) {
                    if (value?.doc_id == value1?.value_id) {
                        $("#appendPemeriksaanFisikMedisBody").append(
                            `<div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="arm${value1?.p_type+ value1?.parameter_id+ value1?.value_id}">${value1?.value_desc}</label>
                                            <textarea id="arm${value1?.p_type+ value1?.parameter_id+ value1?.value_id}" name="fisik${value1?.value_id}" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>`
                        )
                    }
                })
            }
        })
        appendDiagnosaAkhirAccordion(accMedisName);
        appendProsedurResumeAccordion(accMedisName);
        appendPenunjangTerapi(accMedisName);
        // appendCetakMedis(accMedisName)

        // appendRtlAccordion(accordionId)

        fillViewAssessmentMedis(pasienDiagnosaId, flag)
    }
    const reqFill = (req, pasienDiagnosaId, flag) => {
        let indikasi = req?.indikasi?.notes
        $("#armmedical_problem").val(indikasi)

        let procb = req.procbedah
        let procnb = req.procnonbedah
        $("#armprocedure_desc").html("")
        $.each(procb, (key, value) => {
            $("#armprocedure_desc").append(
                $(`<li class="list-group-item">`).html(value.treatment)
            )
        })
        $("#arminstruction").html("")
        $.each(procnb, (key, value) => {
            $("#arminstruction").append(
                $(`<li class="list-group-item">`).html(value.treatment)
            )
        })
        let lastDiag = req.lastDiag
        $("#armdiagnosa_desc_discharge").val(req?.lastDiag)
    }
    const renderViewAssessmentMedis = async (accMedisName, pasienDiagnosaId, spec_type_id, flag = 1) => {
        var titlerj = '';

        if (flag == 0)
            if (pasienDiagnosa?.class_room_id != '' && pasienDiagnosa?.class_room_id != null) {
                titlerj = ' RAWAT INAP'
            } else {
                titlerj = ' RAWAT JALAN'
            }
        else {
            if (visit?.class_room_id != '' && visit?.class_room_id != null) {
                titlerj = ' RAWAT INAP'
            } else {
                titlerj = ' RAWAT JALAN'
            }
        }


        if (spec_type_id == '1.04') {
            if (parseInt(visit.ageday) <= 20 && parseInt(visit.agemonth) == 0 && parseInt(visit.ageyear) == 0) {
                spec_type_id = '1.04.1'
            }
        }

        const req = await libAsyncAwaitPost({
                specialist_type_id: spec_type_id
            },
            "admin/rm/assessment/getMapAssessment"
        );
        $("#accordionAssessmentMedis").html("")

        let mappingContentMap = JSON.parse(req);
        let updatedMappingContentMap = mappingContentMap

        // const mappingOrderMap = new Map(mappingOrder.map(item => [item.name, item]));
        // const updatedMappingContentMap = mappingContentMap.map(item => {
        //     const orderItem = mappingOrderMap.get(item.doc_id);
        //     if (orderItem) {
        //         return {
        //             ...item,
        //             theorder: orderItem.order
        //         };
        //     }
        //     return item;
        // });

        const sortedMappingContentMap = updatedMappingContentMap.sort((a, b) => a.theorder - b.theorder);
        let val = avalue?.filter(item => item.p_type == 'GEN0002')
        $.each(sortedMappingContentMap, function(key, value) {
            if (value?.doc_type == 1) {
                window[value?.doc_id](accMedisName)
                if (pasienDiagnosa?.clinic_id != 'P012' && visit?.clinic_id != 'P012') {
                    $("#armTitle").html("ASESMEN MEDIS " + value?.specialist_type + titlerj)
                    $("#armemergency_group").hide()
                } else if (pasienDiagnosa?.clinic_id == 'P012' && flag == 0) {
                    $("#armTitle").html("ASESMEN MEDIS IGD")
                    $("#armemergency_group").show()
                } else if (visit?.clinic_id == 'P012' && flag == 1) {
                    $("#armTitle").html("ASESMEN MEDIS IGD")
                    $("#armemergency_group").show()
                }
            }
            // if (value.doc_type == 1 && value.specialist_type_id == pasienDiagnosa.specialist_type_id) {}
        })
        $.each(sortedMappingContentMap, function(key, value) {

            if (value?.doc_type == 3) {
                $.each(val, function(key1, value1) {
                    if (value?.doc_id == value1?.value_id) {
                        $("#appendPemeriksaanFisikMedisBody").append(
                            `<div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="arm${value1?.p_type+ value1?.parameter_id+ value1?.value_id}">${value1?.value_desc}</label>
                                            <textarea id="arm${value1?.p_type+ value1?.parameter_id+ value1?.value_id}" name="fisik${value1?.value_id}" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>`
                        )
                    }
                })
            }
            // if (value.doc_type == 1 && value.specialist_type_id == pasienDiagnosa.specialist_type_id) {}
        })
        // copyLastArm()
        fillViewAssessmentMedis(pasienDiagnosaId, flag)
    }
    const fillViewAssessmentMedis = async (pasienDiagnosaId, flag = 1) => {
        $("#formaddarmqrcode1").html("")

        // flatpickrInstances["flatarmdate_of_diagnosa"].setDate(
        //     moment().format("DD/MM/YYYY HH:mm")
        // );
        // $("#flatarmdate_of_diagnosa").trigger("change");
        $("#armdate_of_diagnosa").trigger(get_date());


        $("#formaddarm").find("#armtotal_score").html("")
        $("#formaddarm").find("span.h6").html("")



        $("#armvalid_user").val("")
        $("#armvalid_pasien").val("")
        $("#armvalid_date").val("")

        <?php foreach ($aParameter as $key => $value) {
            if (true) {
                if ($value['p_type'] == 'GEN0002')
                    foreach ($aValue as $key1 => $value1) {
                        if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id'] && ($value1['value_score'] == '2' || $value1['value_score'] == '6')) {
        ?>
                        $("#arm<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>").val(`<?= $value1['value_info']; ?>`);
        <?php
                        }
                    }
            }
        } ?>



        $("#armvalid_user").val("")
        $("#armvalid_pasien").val("")
        $("#armvalid_date").val("")


        if (flag == 0) {
            // console.log(pasienDiagnosa)
            $.each(pasienDiagnosa, function(key, value) {
                $("#arm" + key).val(value)
            })
            let examselectdetail = [];

            let selected = examForassessmentDetail.filter(item => item.body_id == pasienDiagnosa?.pasien_diagnosa_id);

            examselectdetail = selected[0]
            fillExaminationDetail(examselectdetail, 'arm')

            // fillPemeriksaanFisik(pasienDiagnosa?.pasien_diagnosa_id)
            // fillRiwayat()
            getSateliteMedis(pasienDiagnosa)
        } else {
            let clinicSelect = clinics.filter(item => item?.clinic_id == '<?= @$visit['clinic_id']; ?>')
            $("#armclinic_id").html($('<option></option>')
                .val(clinicSelect[0]?.clinic_id)
                .text(clinicSelect[0]?.name_of_clinic))

            $('#armorg_unit_code').val('<?= @$visit['org_unit_code']; ?>')
            $('#armvisit_id').val('<?= @$visit['visit_id']; ?>')
            $("#armdate_of_diagnosa").val(get_date())
            $('#armtrans_id').val('<?= @$visit['trans_id']; ?>')
            $('#armreport_date').val(get_date())
            $('#armtheid').val('<?= @$visit['pasien_id']; ?>')

            $('#armtheaddress').val('<?= @$visit['visitor_address']; ?>')
            $('#armisrj').val('<?= @$visit['isrj']; ?>')
            $('#armkal_id').val('<?= @$visit['kal_id']; ?>')
            $('#armspesialistik').val(null)
            $('#armdoctor').val('<?= @@$visit['fullname']; ?>')
            $('#armclass_room_id').val('<?= @$visit['class_room_id']; ?>')
            $('#armbed_id').val('<?= @$visit['bed_id']; ?>')
            $('#armresult_id').val(null)
            // $('#armkeluar_id').val('<?= @$visit['keluar_id']; ?>')
            $('#armin_date').val('<?= @$visit['in_date']; ?>')
            $('#armexit_date').val('<?= @$visit['exit_date']; ?>')
            $('#armmodified_date').val(get_date())
            $('#armmodified_by').val('<?= user()->username; ?>')
            $('#armnokartu').val('<?= @$visit['pasien_id']; ?>')
            $('#armno_registration').val('<?= @$visit['no_registration']; ?>')
            $('#armthename').val('<?= @$visit['diantar_oleh']; ?>')
            $('#armstatus_pasien_id').val('<?= @$visit['status_pasien_id']; ?>')
            $('#armgender').val('<?= @$visit['gender']; ?>')
            $('#armageyear').val('<?= @$visit['ageyear']; ?>')
            $('#armagemonth').val('<?= @$visit['agemonth']; ?>')
            $('#armageday').val('<?= @$visit['ageday']; ?>')
            $('#armnosep').val('<?= @$visit['no_skpinap'] ?? @$visit['no_skp']; ?>')
            $('#armtglsep').val('<?= @$visit['visit_date']; ?>')
            $('#armkddpjp').val('<?= @$visit['kddpjp']; ?>')
            $('#armstatusantrean').val('<?= @$visit['statusantrean']; ?>')
            $('#armspecialist_type_id').val('<?= @$visit['specialist_type_id']; ?>')
            $("#armdiag_cat").val(assessmentMedisType)
            $("#armclinic_id").val(clinicSelect[0]?.clinic_id)
            console.warn($("#armclinic_id").val())
            $('#armbody_id').val(null)
            $('#armpasien_diagnosa_id').val(pasienDiagnosaId)
            $("#armemployee_id").html('<option value="<?= user()->employee_id; ?>"><?= user()->getFullname(); ?></option>')
            $("#armemployee_id").val('<?= user()->employee_id; ?>')
            if (assessmentMedisType == 1) {
                const reqfill = await libAsyncAwaitPost({
                        visit_id: visit.visit_id,
                        trans_id: visit.trans_id
                    },
                    "admin/rm/assessmentmedis/fillResumeMedis"
                );
                reqFill(reqfill, pasienDiagnosaId, flag)
            }

            const props = {
                visit_id: visit?.visit_id,
                pasien_diagnosa_id: visit?.session_id,
                specialist_type_id: visit?.specialist_type_id,
                clinic_id: visit?.clinic_id
            }
            setTimeout(function() {
                copyLastArm()
            }, 2000)
            getSateliteMedis(props)

        }
    }




    const copyLastArm = async () => {
        if (assessmentMedisType == 1)
            var filterexaxm = examForassessment.filter(item => (item?.petugas_type == '11' && item?.account_id == '1'));
        else
            var filterexaxm = examForassessment.filter(item => (item?.petugas_type == '11' || item?.petugas_type == '13'));
        var initialexam = getLastObject(sortAscending(filterexaxm, 'examination_date'));
        if (initialexam) {
            fillExamination(initialexam, 'arm')
            $("#armdiagnosa_desc_discharge").val(initialexam?.teraphy_desc);
        }
        if (pasienDiagnosaAll?.length > 0) {
            let pasienDiagnosaLocal = getLastObject(sortAscending(pasienDiagnosaAll, 'date_of_diagnosa'));
            if (pasienDiagnosaLocal) {
                $("#armdescription").val(pasienDiagnosaLocal?.description)
                $("#armanamnase").val(pasienDiagnosaLocal?.anamnase)
                $("#armalloanamnase").val(pasienDiagnosaLocal?.alloanamnase)
                // $("#armmedical_problem").val(pasienDiagnosaLocal?.medical_problem)
                $("#armhurt").val(pasienDiagnosaLocal?.hurt)
                $("#arminstruction").val(pasienDiagnosaLocal?.instruction)
                $("#armdiagnosa_desc").val(pasienDiagnosaLocal?.diagnosa_desc)
            }
            // if (pasienDiagnosaLocal.specialist_type_id == '<?= @@$visit['specialist_type_id']; ?>')
            fillPemeriksaanFisik(pasienDiagnosaLocal?.pasien_diagnosa_id)

            // var filterexaxmdetail = examForassessmentDetail;
            // var initialexamdetail = getLastObject(sortDescending(filterexaxmdetail, 'examination_date'))
            // console.log(initialexamdetail)
            // if (initialexamdetail)
            //     fillExaminationDetail(initialexamdetail, 'arm')
        } else {
            // var filterexaxmdetail = examForassessmentDetail;
            // var initialexamdetail = getLastObject(sortDescending(filterexaxmdetail, 'examination_date'))
            // console.log(initialexamdetail)
            // if (initialexamdetail)
            //     fillExaminationDetail(initialexamdetail, 'arm')
        }
    }


    const fillDataProfileRM = (index) => {
        pasienDiagnosa = pasienDiagnosaAll[index]

        $.each(pasienDiagnosa, function(key, value) {
            $("#arm" + key).val(value)
        })
    }

    const fillDataArm = async (index) => {
        $("#armModal").modal("show")

        $("#formaddarmqrcode1").html("")

        pasienDiagnosa = pasienDiagnosaAll[index]

        // console.log(pasienDiagnosa)

        var accMedisName = "accordionAssessmentMedis"

        var titlerj = '';
        if (pasienDiagnosa?.class_room_id != '' && pasienDiagnosa?.class_room_id != null) {
            titlerj = ' RAWAT INAP'
        } else {
            titlerj = ' RAWAT JALAN'
        }
        $("#accordionAssessmentMedis").html("")

        if (assessmentMedisType == 1) {
            renderViewResumeMedis(accMedisName, pasienDiagnosa.pasien_diagnosa_id, 0)
        } else {
            renderViewAssessmentMedis(accMedisName, pasienDiagnosa?.pasien_diagnosa_id, pasienDiagnosa?.specialist_type_id, 0)
        }


        if (pasienDiagnosa?.diag_cat == 1) {
            $("#armTitle").html("RESUME MEDIS")
        } else if ('<?= @$visit['clinic_id']; ?>' == 'P012') {
            $("#armTitle").html("ASESMEN MEDIS INSTALASI GAWAT DARURAT")
        }

        // console.log(pasienDiagnosa)

        // $.each(pasienDiagnosa, function(key, value) {
        //     $("#arm" + key).val(value)
        // })
        if (pasienDiagnosa?.clinic_id == 'P012') {
            if (patientCategoryId === 'undefined')
                patientCategoryId = 1
            $("#armemergency").val(patientCategoryId)
            $("#armemergency_group").show()
        } else {
            $("#armemergency_group").hide()
        }
        $("#armemergency").val(pasienDiagnosa?.emergency)
        $("#armdiagnosa_desc_discharge").val(pasienDiagnosa?.diagnosa_desc)

        // console.log(pasienDiagnosa)

        // let formattedValue = moment(pasienDiagnosa?.date_of_diagnosa).format('DD/MM/YYYY HH:mm');
        $("#formaddarm").find("#armtotal_score").html("")
        $("#formaddarm").find("span.h6").html("")
        $("#armdate_of_diagnosa").val(pasienDiagnosa?.date_of_diagnosa)
        // $("#flatarmdate_of_diagnosa").val(formattedValue).trigger("change")

        if (pasienDiagnosa?.clinic_id == null || pasienDiagnosa?.clinic_id == '') {
            $("#armclinic_id").html('<option value="<?= @$visit['clinic_id']; ?>"><?= @$visit['name_of_clinic']; ?></option>')
            $("#armclinic_id").val('<?= @$visit['clinic_id']; ?>')
        } else {
            $("#armclinic_id").html('<option value="' + pasienDiagnosa?.clinic_id + '">' + pasienDiagnosa?.name_of_clinic + '</option>')
            $("#armclinic_id").val(pasienDiagnosa?.clinic_id)
        }

        if (pasienDiagnosa?.employee_id == null || pasienDiagnosa?.employee_id == '') {
            <?php if (@$visit['isrj'] == '0') {
            ?>
                $("#armemployee_id").html('<option value="<?= @$visit['employee_inap']; ?>"><?= @$visit['fullname_inap']; ?></option>')
            <?php
            } else {
            ?>
                $("#armemployee_id").html('<option value="<?= @$visit['employee_id']; ?>"><?= @@$visit['fullname']; ?></option>')
            <?php
            } ?>
        } else {
            $("#armemployee_id").html('<option value="' + pasienDiagnosa?.employee_id + '">' + pasienDiagnosa?.fullname + '</option>')
        }
        $("#armdiag_cat").val(pasienDiagnosa?.diag_cat)


        displayTableAssessmentMedis(index)

        // fillRiwayat()


        $("#armcollapseVitalSign").find("input, select").trigger("change")
        setTimeout(function() {
            disableARM()
        }, 2000)
        if (typeof pasienDiagnosa?.description !== 'undefined') {
            // $("#formaddrmbtn").slideUp()
            // $("#formeditrm").slideDown()
        }
    }
    const refreshPeriksaFisik = () => {
        let examselectdetail = [];
        let id = $("#armpasien_diagnosa_id").val()
        $.each(examForassessmentDetail, function(key, value) {
            if (value?.body_id == id) {
                examselectdetail = value
                fillExaminationDetail(examselectdetail, 'arm')
                return false
            }
        })
    }
    const getSateliteMedis = (pasienDiagnosa) => {

        if (pasienDiagnosa?.specialist_type_id == '1.12')
            groupeActionInTabKulit(pasienDiagnosa?.pasien_diagnosa_id)
        if (pasienDiagnosa?.specialist_type_id == '1.16')
            groupeActionInTabSaraf()
        postData({
            pasien_diagnosa_id: pasienDiagnosa?.pasien_diagnosa_id,
            visit_id: pasienDiagnosa?.visit_id,
            specialist_type_id: pasienDiagnosa?.specialist_type_id,
            clinic_id: pasienDiagnosa?.specialist_type_id
        }, 'admin/rm/assessmentmedis/getSateliteMedis', (res) => {
            if (res?.examDetail) {
                let examselect = res?.examDetail
                fillExaminationDetail(examselect, 'arm')
            }
            if (res?.lokalis) {
                $.each(res?.lokalis, function(key, value) {
                    if (value.body_id == pasienDiagnosa?.pasien_diagnosa_id) {
                        if (value.value_score == 2 || value.value_score == 4 || value.value_score == 5) {
                            $("#arm" + value?.p_type + value?.parameter_id + value?.value_id).val(value?.value_detail);
                            // $("#arm" + value?.p_type + value?.parameter_id + value?.value_id).prop("disabled", true)
                        } else if (value.value_score == 3) {
                            if ($("#lokalis" + value?.value_id).length) {
                                $("#lokalis" + value?.value_id).val(value?.value_detail);
                                $("#lokalis" + value?.value_id + "desc").val(value?.value_desc);
                                var canvas = document.getElementById('canvas' + value?.p_type + value?.parameter_id + value?.value_id);
                                const canvasDataInput = document.getElementById('lokalis' + value?.value_id);
                                var context = canvas?.getContext('2d');
                                const img = new Image();
                                img.onload = function() {
                                    context.drawImage(img, 0, 0, canvas?.width, canvas?.height);
                                };
                                img.src = "data:image/png;base64," + value?.filedata64;
                            }
                        }
                    }
                })
            }
            if (res?.gcs) {
                gcsAll = res?.gcs
                // gcsDetailAll = data.gcsDetail

                $.each(gcsAll, function(key, value) {
                    if (value?.document_id == $("#arpbody_id").val()) {
                        $("#bodyGcsPerawat").html("")
                        addGcs(0, key, "arpbody_id", "bodyGcsPerawat")
                    }
                    if (value?.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyGcsMedis").html()
                        addGcs(0, key, "armpasien_diagnosa_id", "bodyGcsMedis", false)
                    }
                    if (value?.document_id == $("#acpptbody_id").val()) {
                        addGcs(0, key, "acpptbody_id", container, false)
                    }
                })
            }
            // getGcs(pasienDiagnosa.pasien_diagnosa_id, "bodySirkulasiMedis")
            // getFallRisk(pasienDiagnosa.pasien_diagnosa_id, "bodyFallRiskMedis")
            // getPainMonitoring(pasienDiagnosa.pasien_diagnosa_id, "bodyPainMonitoringMedis")
            // getPernapasan(pasienDiagnosa.pasien_diagnosa_id, "bodyPernapasanMedis")

            if (res?.fallRisk) {
                let data = res?.fallRisk
                fallRisk = data?.fallRisk
                fallRiskDetail = data?.fallRiskDetail

                $.each(fallRisk, function(key, value) {
                    if (value?.document_id == $("#arpbody_id").val()) {
                        $("#bodyFallRiskPerawat").html("")
                        addFallRisk(0, key, "arpbody_id", "bodyFallRiskPerawat")
                    } else if (value?.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyFallRiskMedis").html("")
                        addFallRisk(0, key, "armpasien_diagnosa_id", "bodyFallRiskMedis", false)
                    } else if (value?.document_id == $("#acpptbody_id").val()) {
                        addFallRisk(0, key, "acpptbody_id", container, false)
                    }
                })
            }

            if (res?.painMonitoring) {
                let container = "bodyPainMonitoringMedis"
                let data = res?.painMonitoring
                painMonitoring = data?.painMonitoring
                painMonitoringDetil = data?.painDetil
                painIntervensi = data?.painIntervensi

                $.each(painMonitoring, function(key, value) {
                    $("#" + container).html("")
                    if (value?.document_id == $("#arpbody_id").val()) {
                        $("#bodyPainMonitoringPerawat").html("")
                        addPainMonitoring(0, key, 'arpbody_id', "bodyPainMonitoringPerawat")
                    } else if (value?.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyPainMonitoringMedis").html("")
                        addPainMonitoring(0, key, 'armpasien_diagnosa_id', "bodyPainMonitoringMedis", false)
                    }
                })
            }

            if (res?.pernapasan) {
                napas = res.pernapasan
                // stabilitasDetail = data.stabilitasDetail

                $.each(napas, function(key, value) {
                    if (value?.document_id == $("#armpasien_diagnosa_id").val())
                        addPernapasan(0, key, "armpasien_diagnosa_id", "bodyPernapasanMedis")
                })
            }
            if (res?.educationForm) {
                educationFormAll = res.educationForm
                // stabilitasDetail = data.stabilitasDetail

                $.each(educationFormAll, function(key, value) {
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyEducationFormMedis").html("")
                        addEducationForm(0, key, "armpasien_diagnosa_id", "bodyEducationFormMedis", false)
                    }
                })
            }
            if (res?.apgar) {
                let container = "bodyApgarMedis"
                let data = res?.apgar
                apgar = data?.apgar
                apgarDetil = data?.apgarDetil

                $.each(apgar, function(key, value) {
                    if (value?.document_id == $("#arpbody_id").val()) {
                        $("#bodyApgarPerawat").html("")
                        addApgar(0, key, "arpbody_id", "bodyApgarPerawat")
                    } else if (value?.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyApgarMedis").html("")
                    } else {
                        addApgar(0, key, "bayibaby_id", container, false)
                    }
                })
            }
            if (res?.pasienHistory) {
                riwayatAll = res?.pasienHistory;
                fillRiwayat()
            }
            if (pasienDiagnosa?.clinic_id == 'P012') {
                getTriage(pasienDiagnosa?.pasien_diagnosa_id, "bodyTriageMedis")
                // getTriageNew(pasienDiagnosa?.pasien_diagnosa_id, "bodyTriageMedis")
            }
        }, (beforesend) => {
            // getLoadingGlobalServices('bodydatapemeriksaanKulit')
        })
    }

    function fillRiwayat() {
        $.each(riwayatAll, function(key, value) {
            if ($("#armGEN0009" + value?.value_id).is(":checkbox")) {
                $("#armGEN0009" + value?.value_id).prop("checked", true)
                // $("#armGEN0009" + value?.value_id).prop("disabled", true)
            } else {
                $("#armGEN0009" + value?.value_id).val(value?.histories)
                // $("#armGEN0009" + value?.value_id).prop("disabled", true)
            }
        })
    }

    function fillPemeriksaanFisik(pasienDiagnosaId) {
        $.each(lokalisAll, function(key, value) {
            if (value.body_id == pasienDiagnosaId) {
                if (value.value_score == 2 || value.value_score == 4 || value.value_score == 5) {
                    $("#arm" + value?.p_type + value?.parameter_id + value?.value_id).val(value?.value_detail);
                    // $("#arm" + value?.p_type + value?.parameter_id + value?.value_id).prop("disabled", true)
                } else if (value.value_score == 3) {
                    if ($("#lokalis" + value?.value_id).length) {
                        $("#lokalis" + value?.value_id).val(value?.value_detail);
                        $("#lokalis" + value?.value_id + "desc").val(value?.value_desc);
                        var canvas = document.getElementById('canvas' + value?.p_type + value?.parameter_id + value?.value_id);
                        const canvasDataInput = document.getElementById('lokalis' + value?.value_id);
                        var context = canvas?.getContext('2d');
                        const img = new Image();
                        img.onload = function() {
                            context.drawImage(img, 0, 0, canvas?.width, canvas?.height);
                        };
                        img.src = "data:image/png;base64," + value?.filedata64;
                    }
                }
            }
        })
    }


    const enableARM = async () => {
        $("#formsignarm").slideUp()
        $("#formsignarm2").slideUp()
        $("#formsavearmbtn").slideDown()
        $("#formeditarm").slideUp()
        $("#formdeletearm").slideDown()
        $("#formaddarm input").prop("disabled", false)
        $("#formaddarm textarea").prop("disabled", false)
        $("#formaddarm select").prop("disabled", false)
        $("#formaddarm option").prop("disabled", false)
        if (assessmentMedisType != 1) {
            enableCanvasLokalis()
        }

        $("#formaddarm").find(".btn-to-hide").slideDown()

        $("#formaddarm").find(".btn-edit").each(function() {
            $(this).trigger("click")
        })
    }

    const disableARM = async () => {
        $("#formsavearmbtn").slideUp()

        if ($("#armmodified_by").val() == '<?= user()->username; ?>' || <?= json_encode(user()->checkRoles(['superuser'])) ?>) {
            $("#formeditarm").slideDown()
        } else {
            $("#formeditarm").slideUp()
        }
        $("#formaddarm input").prop("disabled", true)
        $("#formaddarm textarea").prop("disabled", true)
        $("#formaddarm select").prop("disabled", true)
        // $("#formaddarm option").prop("disabled", true)

        $("#formaddarm").find(".btn-to-hide").slideUp()
        if ($("#armvalid_user").val() != '' && $("#armvalid_user").val() != null) {
            $("#formeditarm").slideUp()
            $("#formdeletearm").slideDown()
            $("#formsignarm").slideDown()
            $("#formsignarm2").slideDown()
            $("#formaddarp").find(".btn-edit").each(function() {
                $(this).hide()
            })
        } else {
            $("#formeditarm").slideDown()
            $("#formdeletearm").slideDown()
            $("#formsignarm").slideDown()
        }
        disableCanvasLokalis()
        await checkSignSignature("formaddarm", "armpasien_diagnosa_id", "formsavearmbtn", 2)
    }

    function enableCanvasLokalis() {
        var specialistLokalis = '';
        if (typeof(pasienDiagnosa.specialist_type_id) === 'undefined') {
            specialistLokalis = '<?= @$visit['specialist_type_id']; ?>'
        } else {
            specialistLokalis = pasienDiagnosa?.specialist_type_id
        }
        $.each(canvasAssessment, function(key, value1) {
            var canvas = document.getElementById('canvas' + value1?.p_type + value1?.parameter_id + value1?.value_id);
            canvas.style.pointerEvents = 'auto';
        })
    }

    function disableCanvasLokalis() {
        var specialistLokalis = '';
        if (typeof(pasienDiagnosa.specialist_type_id) === 'undefined') {
            specialistLokalis = '<?= @$visit['specialist_type_id']; ?>'
        } else {
            specialistLokalis = pasienDiagnosa?.specialist_type_id
        }
        $.each(canvasAssessment, function(key, value1) {
            var canvas = document.getElementById('canvas' + value1?.p_type + value1?.parameter_id + value1?.value_id);
            if (canvas) {
                canvas.style.pointerEvents = 'none';
            } else {
                console.error('Element not found:', 'canvas' + value1?.p_type + value1?.parameter_id + value1?.value_id);
            }
        })

    }

    function copyPeriksaFisik() {
        <?php if (!is_null(@$visit['class_room_id']) && (@$visit['class_room_id'] != '')) {
        ?>
            $("#copyVitalSignModal").modal('show')
        <?php
        } else {
        ?>
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rekammedis/getPeriksaFisik/<?= @$visit['visit_id']; ?>',
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    alert("berhasil ambil periksa fisik")
                    $("#armbody_id").val(data?.body_id)
                    $("#armpemeriksaan").val(data?.periksafisik)
                    $("#armanamnase").val(data?.anamnase)
                    $("#armweight").val(data?.weight)
                    $("#armheight").val(data?.height)
                    $("#armtemperature").val(data?.temperature)
                    $("#armnadi").val(data?.nadi)
                    $("#armtension_upper").val(data?.tension_upper)
                    $("#armtension_below").val(data?.tension_below)
                    $("#armsaturasi").val(data?.saturasi)
                    $("#armnafas").val(data?.nafas)
                    $("#armsaturasi").val(data?.saturasi)
                    $("#armarm_diameter").val(data?.arm_diameter)
                    $("#armpemeriksaan").val(data?.pemeriksaan)
                    $("#armvs_status_id").val(data?.vs_status_id)
                    $("#armawareness").val(data?.awareness)
                }
            })
        <?php
        } ?>
    }

    function copyPeriksaLab() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getPeriksaLab/<?= @$visit['trans_id']; ?>',
            type: "GET",
            dataType: 'json',
            success: function(data) {
                alert("berhasil ambil periksa lab")
                $("#armlab_result").val(data.periksalab)
            }
        })
    }

    function copyPeriksaRad() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getPeriksaRad/<?= @$visit['trans_id']; ?>',
            type: "GET",
            dataType: 'json',
            success: function(data) {
                alert("berhasil ambil periksa radiologi")
                $("#armro_result").val(data.periksarad)
            }
        })
    }

    function copyTerapi() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getTerapi/<?= @$visit['visit_id']; ?>',
            type: "GET",
            dataType: 'json',
            success: function(data) {
                alert("berhasil ambil data terapi obat")
                $("#armteraphy_desc").val(data.terapi)
            }
        })
    }

    function displayTableAssessmentMedis(index) {
        $("#assessmentMedisHistoryBody").html("")
        let session_id = visit.session_id
        $.each(pasienDiagnosaAll, function(key, value) {
            var pd = pasienDiagnosaAll[key]

            let rowColor = '';


            if (pd.diag_cat == assessmentMedisType) {
                var titlerj = '';
                if (pd.class_room_id != '' && pd.class_room_id != null) {
                    titlerj = ' RAWAT INAP'
                } else {
                    titlerj = ' RAWAT JALAN'
                }
                let linkcetak = '';
                if (assessmentMedisType == 1) {
                    titlerj = 'RESUME MEDIS' + titlerj
                    linkcetak = 'resume_medis_post'
                } else {
                    linkcetak = 'rawat_jalan'
                }
                let examselectdetail = [];

                $.each(examForassessmentDetail, function(key, value) {
                    if (value?.body_id == pd?.pasien_diagnosa_id) {
                        examselectdetail = value
                        return false
                    }
                })

                if (assessmentMedisType == 3)
                    var pasienDiagnosaId = visit.session_id;
                else
                    var pasienDiagnosaId = visit.session_id + assessmentMedisType.toString();

                if (pd.pasien_diagnosa_id == pasienDiagnosaId) {
                    rowColor = 'table-warning'
                } else {
                    if (key % 2 !== 0) {
                        rowColor = '';
                    } else {
                        rowColor = '';
                    }
                }
                if (pd.pasien_diagnosa_id == pasienDiagnosaId) {
                    $("#assessmentMedisHistoryBody")
                        .append($(`<tr class="${rowColor}">`).append($("<td colspan =\"5\">").html()))
                        .append(`<tr class="${rowColor}">
                                    <td rowspan="6"><i class="fa fa-check"></i></td>
                                    <td><b>${formatedDatetimeFlat(value?.date_of_diagnosa)}</b></td>
                                    <td class="text-end"><b>Anamnase: </b></td>
                                    <td>${value?.anamnase}</td>
                                    <td rowspan="6">
                                        <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                            <button type="button" class="btn btn-success" onclick="fillDataArm(${key})">Lihat</button>
                                            <button type="button" class="btn btn-light" onclick="openPopUpTabWithPost('<?= base_url() ?>admin/rm/medis/${linkcetak}/visit/${value?.pasien_diagnosa_id}/${titlerj}')">Cetak</button>
                                        </div>
                                    </td>
                                </tr>
                            `)
                        .append($(`<tr class="${rowColor}">`)
                            .append($("<td>").append($("<b>").html(value?.name_of_clinic)))
                            .append($("<td class=\"text-end\">").html("<b>Aloanamnase: </b>"))
                            .append($("<td>").html(value?.alloanamnase))
                        )
                        .append($(`<tr class="${rowColor}">`)
                            .append($("<td rowspan=\"4\">").append($("<b>").html(value?.fullname)))
                            .append($("<td class=\"text-end\">").html("<b>Vital Sign: </b>"))
                            .append($("<td>").html(`BB: ${examselectdetail?.weight}; TB: ${examselectdetail?.height}; Suhu: ${examselectdetail?.temperature} (°C); Nadi: ${examselectdetail?.nadi}; T.Darah: ${examselectdetail?.tension_upper}/${examselectdetail?.tension_below}; Saturasi (SPO2%): ${examselectdetail?.saturasi}; Nafas/RR(/menit): ${examselectdetail?.nafas};`))
                        )
                        .append($(`<tr class="${rowColor}">`)
                            .append($("<td class=\"text-end\">").html("<b>Diagnosa Klinis: </b>"))
                            .append($("<td>").html(value?.diagnosa_desc))
                        )


                    $("#assessmentMedisHistoryBody")
                        .append($(`<tr class="${rowColor}">`)
                            .append($("<td class=\"text-end\">").html("<b>Standing Order: </b>"))
                            .append($("<td>").html((value?.standing_order?.toString() ?? '').replace(/\n/g, "<br>")))
                        )
                        .append($(`<tr class="${rowColor}">`)
                            .append($("<td class=\"text-end\">").html("<b>Target/Sasaran Terapi: </b>"))
                            .append($("<td>").html((value?.instruction?.toString() ?? '').replace(/\n/g, "<br>")))
                        )
                    // if (value?.standing_order != null && value?.standing_order != '') {
                    // } else {
                    //     $("#assessmentMedisHistoryBody")
                    //         .append($("<tr>")
                    //             // .append($("<td class=\"text-end\">").html("<b>Standing Order: </b>"))
                    //             // .append($("<td>").html(value?.standing_order))
                    //         )
                    //         .append($("<tr>")
                    //             .append($("<td class=\"text-end\">").html("<b>Target/Sasaran Terapi: </b>"))
                    //             .append($("<td>").html(value?.instruction))
                    //         )
                    // }
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                } else {
                    $("#assessmentMedisHistoryBody")
                        .append($("<tr>").append($("<td colspan =\"5\">").html()))
                        .append(`<tr>
                                    <td rowspan="6"></td>
                                    <td><b>${formatedDatetimeFlat(value?.date_of_diagnosa)}</b></td>
                                    <td class="text-end"><b>Anamnase: </b></td>
                                    <td>${value?.anamnase}</td>
                                    <td rowspan="6">
                                        <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                            <button type="button" class="btn btn-success" onclick="fillDataArm(${key})">Lihat</button>
                                            <button type="button" class="btn btn-light" onclick="openPopUpTabWithPost('<?= base_url() ?>admin/rm/medis/${linkcetak}/visit/${value?.pasien_diagnosa_id}/${titlerj}')">Cetak</button>
                                        </div>
                                    </td>
                                </tr>
                            `)
                        .append($("<tr>")
                            .append($("<td>").append($("<b>").html(value?.name_of_clinic)))
                            .append($("<td class=\"text-end\">").html("<b>Aloanamnase: </b>"))
                            .append($("<td>").html(value?.alloanamnase))
                        )
                        .append($("<tr>")
                            .append($("<td rowspan=\"4\">").append($("<b>").html(value?.fullname)))
                            .append($("<td class=\"text-end\">").html("<b>Vital Sign: </b>"))
                            .append($("<td>").html(`BB: ${value?.weight}; TB: ${value?.height}; Suhu: ${value?.temperature} (°C); Nadi: ${value?.nadi}; T.Darah: ${value?.tension_upper}/${value?.tension_below}; Saturasi (SPO2%): ${value?.saturasi}; Nafas/RR(/menit): ${value?.nafas};`))
                        )
                        .append($("<tr>")
                            .append($("<td class=\"text-end\">").html("<b>Diagnosa Klinis: </b>"))
                            .append($("<td>").html(value?.diagnosa_desc))
                        )
                        .append($("<tr>")
                            .append($("<td class=\"text-end\">").html("<b>Standing Order: </b>"))
                            .append($("<td>").html(value?.standing_order))
                        )
                        .append($("<tr>")
                            .append($("<td class=\"text-end\">").html("<b>Target/Sasaran Terapi: </b>"))
                            .append($("<td>").html(value?.instruction))
                        )
                }
            }
        })
    }
</script>

<script type="text/javascript">
    $("#formsavearmbtn").off().on('click', (function(e) {
        // alert("berhasil")

        saveCanvasData()
        // alert("berhasil1")

        // if ($("#armweight").val() == '') {
        //     alert("Berat Badan tidak boleh kosong!")
        //     return false
        // }
        // if ($("#armheight").val() == '') {
        //     alert("Tinggi Badan tidak boleh kosong!")
        //     return false
        // }
        if ($("#armbody_id").val() == '') {
            if (assessmentMedisType == 3)
                var pasienDiagnosaId = '<?= @$visit['session_id']; ?>';
            else
                var pasienDiagnosaId = '<?= @$visit['session_id']; ?>' + assessmentMedisType.toString();

            $("#armbody_id").val(pasienDiagnosaId)
        }
        var data = [];

        let docDataRm = new FormData(document.getElementById("formaddarm"))
        let docDataObjectRm = {};
        docDataRm.forEach(function(value, key) {
            docDataObjectRm[key] = value
        });
        let newObjRm = {
            id: "formaddarm",
            data: docDataObjectRm
        };
        data.push(newObjRm)

        $("#formaddarm").find(".satelite").each(function() {
            let docData = new FormData(document.getElementById($(this).attr("id")))
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
        })
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessmentmedis/addAssessmentMedis',
            type: "POST",
            data: JSON.stringify(data),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#formsavearmbtn").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                $("#formsavearmbtn").html(`<i class="fa fa-check-circle"></i> <span>Simpan</span>`)

                if (data?.medis) {
                    if (data?.medis?.status == "fail") {
                        var message = "";
                        $.each(data?.medis?.error, function(index, value) {
                            message += value;
                        });
                        errorSwal(message);
                    } else {
                        successSwal(data?.medis?.message);

                        // $("#formaddarm").find(".btn-save:visible").each(function() {
                        //     $(this).trigger("click")
                        // })
                        // $("#armModal").modal("hide")
                        disableARM()
                        let formData = new FormData(document.getElementById("formaddarm"))
                        let formDataObject = {};
                        formData.forEach(function(value, key) {
                            formDataObject[key] = value
                        });

                        var isNewDocument = 0



                        let dataMedis = data?.medis?.data
                        let dataExam = dataMedis?.exam

                        delete dataMedis.exam



                        $.each(pasienDiagnosaAll, function(key, value) {
                            if (value?.pasien_diagnosa_id == dataMedis?.pasien_diagnosa_id) {
                                pasienDiagnosaAll[key] = dataMedis
                                isNewDocument = 1
                            }
                        })
                        if (isNewDocument != 1)
                            pasienDiagnosaAll.push(dataMedis)

                        $.each(examForassessmentDetail, function(key, value) {
                            if (value?.body_id == dataExam?.body_id) {
                                examForassessmentDetail[key] = dataExam
                                isNewDocument = 1
                            }
                        })
                        if (isNewDocument != 1)
                            examForassessmentDetail.push(dataMedis)

                        displayTableAssessmentMedis(pasienDiagnosaAll.length - 1)
                        // if (isNewDocument != 1) {
                        //     let examNew = Array();
                        //     examNew.push(formDataObject)
                        //     $.each(examForassessment, function(key, value) {
                        //         examNew.push(examForassessment[key])
                        //     })
                        //     examForassessment = examNew
                        // }

                        riwayatAll = data?.medis?.data?.pasienHistory

                        lokalisAll = data?.medis?.data?.lokalis

                        // window.history.pushState({}, "", btoa(JSON.stringify(pasienVisitation)));
                        if (visit.clinic_id == 'P012') {
                            visit.employee_id = $("#armemployee_id").val()
                            visit.patient_category_id = data?.medis?.data?.patient_category_id;
                        }
                    }
                }
                if (data.gcs) {
                    let bodyId = data.gcs.body_id

                    if ($("#gcsvalid_pasien" + bodyId).val() == '') {
                        $("#formGcsSaveBtn" + bodyId).slideUp()
                        $("#formGcsEditBtn" + bodyId).slideDown()
                        $("#formGcsSignBtn" + bodyId).slideDown()
                    } else {
                        $("#formGcsSaveBtn" + bodyId).slideUp()
                        $("#formGcsEditBtn" + bodyId).slideUp()
                        $("#formGcsSignBtn" + bodyId).slideUp()
                    }
                    $("#formGcs" + bodyId).find("input, select, textarea").prop("disabled", true)
                    clicked_submit_btn.button('reset');

                    getGcsAll()
                    // if (isrefresh) {}
                }
                if (data.fallRisk) {
                    let bodyId = data.fallRisk.body_id
                    $('#formFallRisk' + bodyId + ' select').prop("disabled", true)
                    $('#formFallRisk' + bodyId + ' input').prop("disabled", true)
                    $("#formFallRiskSaveBtn" + bodyId).slideUp()
                    $("#formFallRiskEditBtn" + bodyId).slideDown()
                    $("#formFallRiskSignBtn" + bodyId).slideDown()
                    clicked_submit_btn.button('reset');
                    checkSign("formFallRisk" + bodyId)
                }
                if (data.monitoring) {
                    let bodyId = data.monitoring
                    if (response.status === 'success') {
                        getPainMonitoringAll()
                        // if (isrefresh) {}
                        if ($("#ases022valid_user" + bodyId).val() == '') {
                            $("#formPainMonitoringSaveBtn" + bodyId).slideUp();
                            $("#formPainMonitoringEditBtn" + bodyId).slideDown();
                            $("#formPainMonitoringSignBtn" + bodyId).slideDown();
                        } else {
                            $("#formPainMonitoringSaveBtn" + bodyId).slideUp();
                            $("#formPainMonitoringEditBtn" + bodyId).slideUp();
                            $("#formPainMonitoringSignBtn" + bodyId).slideUp();
                        }
                        // Disable the form inputs
                        $form.find("input, textarea, select").prop("disabled", true);

                        // Optionally display a success message
                        successSwal(response.message);
                    } else {
                        // Handle server-side validation or other error messages
                        errorSwal(response.message || 'An error occurred. Please try again.');
                    }
                }
                if (data.neuro) {

                }
                if (data.dermatologi) {

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                let errorMessage = "An error occurred: ";

                if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMessage = jqXHR.responseJSON.message;
                } else if (textStatus === "timeout") {
                    errorMessage = "The request timed out.";
                } else if (textStatus === "error") {
                    errorMessage = "Error: " + errorThrown;
                } else if (textStatus === "abort") {
                    errorMessage = "The request was aborted.";
                } else {
                    errorMessage = "Unknown error occurred.";
                }

                errorSwal(errorMessage);
                $("#form1btn").html('<i class="fa fa-search"></i>')
            },
            complete: function() {}
        });
    }));
    $("#formeditarm").off().on("click", function() {
        enableARM()
    })
    $("#formdeletearm").off().on("click", function() {
        // deleteById($("#armpasien_diagnosa_id").val(), 2, (res) => {
        //     if (res.response) {
        //         deleteById($("#armpasien_diagnosa_id").val(), 3, (res) => {
        //             if (res.response) {} else {}
        //             $("#armModal").modal("hide")
        //             getAssessmentMedis()
        //         })

        //         successSwal('Data berhasil Dihapus.');
        //     } else {
        //         errorSwal("Gagal Di hapus")
        //     }
        // })
        postData({
                pasien_diagnosa_id: $("#armpasien_diagnosa_id").val(),
            },
            'admin/rm/assessmentmedis/duplicateAssessmentMedis', (res) => {
                if (res?.response == 'sukses') {
                    $("#armModal").modal("hide")
                    getAssessmentMedis(assessmentMedisType)
                } else
                    errorSwal(res?.message)
            })
    })
    $("#formdeleteonlyarm").off().on("click", function() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success ms-2",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Apa anda yakin?",
            text: "Anda tidak akan dapat mengembalikannya!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                postData({
                        pasien_diagnosa_id: $("#armpasien_diagnosa_id").val(),
                    },
                    'admin/rm/assessmentmedis/deleteAssessmentMedis', (res) => {
                        if (res?.response == 'sukses') {
                            $("#armModal").modal("hide")
                            getAssessmentMedis(assessmentMedisType)
                        } else
                            errorSwal(res?.message)
                    })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Dibatalkan",
                    text: "File Anda aman :)",
                    icon: "error"
                });
            }
        });
    })
    $("#formaddarmbtn").off().on("click", function() {
        initialAddArm()
    })
    $("#formcetakarm").off().on("click", function() {
        var title = $("#armTitle").html()
        if ($("#armdiag_cat").val() == 1) {
            var url = "<?= base_url('admin/rm/medis/resume_medis/' . base64_encode(json_encode(@$visit))) ?>" + '/' + $("#armpasien_diagnosa_id").val() + '/' + title;
        } else {
            var url = "<?= base_url('admin/rm/medis/rawat_jalan/' . base64_encode(json_encode(@$visit))) ?>" + '/' + $("#armpasien_diagnosa_id").val() + '/' + title;
        }
        openPopUpTab(url, visit)
    })
</script>
<script type="text/javascript">
    const signarm = (user_type) => {
        enableARM()
        addSignUser("formaddarm", "arm", "armpasien_diagnosa_id", "formsavearmbtn", 2, user_type, 1, $("#armTitle").html(), 'valid_user')
    }

    function signRM() {
        $("#formeditarm").trigger("click")
        addSignUser("arm", "formsavearmbtn", "formaddarm")
    }
</script>
<script type="text/javascript">
    function addRowDiagMedis(diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
        diagIndex++;
        if (diag_cat == null) {
            diag_cat = 1
        }
        if (diag_cat == null && diagIndex > 1) {
            diag_cat = 2
        }
        $("#bodyDiagMedis")
            .append($('<tr id="diag_medis' + diagIndex + '">')
                // .append($('<td>').html(diagIndex + "."))
                .append($('<td>')
                    .append('<select id="diag_id_medis' + diagIndex + '" class="form-control" name="diag_id[]" onchange="selectedDiagMedis(' + diagIndex + ')" style="width: 100%"></select>')
                    .append('<input id="diag_name_medis' + diagIndex + '" name="diag_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    .append('<input id="sscondition_id_medis' + diagIndex + '" name="sscondition_id[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
                )
                // .append($('<td>')
                //     .append($('<input>').attr('name', 'diag_name[]').attr('id', 'diag_name' + diagIndex).attr('value', diag_name).attr('type', 'text').attr('readonly', 'readonly'))
                // )
                .append($('<td>')
                    .append($("<select class=\"form-control\">")
                        .attr('name', 'suffer_type[]').attr('id', 'suffer_type_medis' + diagIndex) <?php foreach ($suffer as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $suffer[$key]['suffer_type']; ?>').html('<?= $suffer[$key]['suffer']; ?>')
                            ) <?php } ?>
                        .val(diag_suffer)
                    )
                )
                .append($('<td>')
                    .append($("<select class=\"form-control\">")
                        .attr('name', 'diag_cat[]').attr('id', 'diag_cat' + diagIndex) <?php foreach ($diagCat as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                            ) <?php } ?>
                        .val(diag_cat)
                    )
                )
                .append("<td><a href='#' onclick='$(\"#diag" + diagIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-trash'></i></a></td>")
            );

        initializeDiagSelect2("diag_id_medis" + diagIndex, diag_id, diag_name)
        $("#suffer_type" + diagIndex).val(0)
        $("#diag_cat" + diagIndex).val(diagIndex)
    }

    function selectedDiagMedis(index) {
        var diagname = $("#diag_id_medis" + index).text()
        if (typeof diagname !== 'undefined') {
            $("#diag_name_medis" + index).val(diagname)
        }
    }

    function addRowProcMedis(diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
        procIndex++
        $("#bodyProcMedis")
            .append($('<tr id="procmedis' + procIndex + '">')
                // .append($('<td>').html(diagIndex + "."))
                .append($('<td style="width: 90%">')
                    .append('<div class="p-2 select2-full-width"><select id="proc_idmedis' + procIndex + '" onchange="selectedProcMedis(' + procIndex + ')" class="form-control" name="proc_id[]" ></select></div>')
                    .append('<input id="proc_namemedis' + procIndex + '" name="proc_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
                )
                .append("<td><a href='#' onclick='$(\"#procmedis" + procIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-remove'></i></a></td>")
            );

        initializeProcSelect2("proc_idmedis" + procIndex, diag_id, diag_name)
    }

    function selectedProcMedis(index) {
        var diagname = $("#proc_idmedis" + index).text()
        if (typeof diagname !== 'undefined') {
            $("#proc_namemedis" + index).val(diagname)
        }
    }

    function copyGcsResume(flag, index, document_id, container, isaddbutton = true) {
        $("#" + container).html("")
        postData({
            'visit_id': visit.visit_id,
            'nomor': nomor,
            'body_id': $("#" + document_id)?.val()
        }, 'admin/rm/assessmentmedis/copyGcsResume', (res) => {
            gcsAll = res.gcs
            // gcsDetailAll = data.gcsDetail

            $.each(gcsAll, function(key, value) {
                if (value.document_id == $("#arpbody_id").val()) {
                    $("#bodyGcsPerawat").html("")
                    addGcs(0, key, "arpbody_id", "bodyGcsPerawat")
                }
                if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                    $("#bodyGcsMedis").html("")
                    addGcs(0, key, "armpasien_diagnosa_id", "bodyGcsMedis", false)
                }
                if (value.document_id == $("#acpptbody_id").val()) {
                    $("#bodyGcsCppt").html("")
                    addGcs(0, key, "acpptbody_id", "bodyGcsCppt", false)
                }
            })
        })
    }
</script>



<script type="text/javascript">
    function fillVitalSignMedis(index) {
        var ex = examForassessment[index]
        $("#armpemeriksaan").val('BB: ' + ex.weight + 'Kg; TB: ' + ex.height + 'cm; ' +
            ex.temperature + '°C; ' +
            ex.nadi + '/menit; ' +
            ex.tension_upper + 'mmHg; ' +
            ex.tension_below + 'mmHg; ' +
            ex.saturasi + 'SpO2%; ' +
            ex.nafas + '/menit; ' +
            ex.arm_diameter + 'cm; ')
        $("#armbody_id").val(ex.body_id)
        $("#copyVitalSignModal").modal('hide')
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#armGcs_Group").slideUp()
        $("#armFallRisk_Group").slideUp()
        $("#armLokalis_Group").slideUp()
        $("#armProcedures_Group").slideUp()
        $("#vitalsign").slideUp()
        $("#armDiagnosas_Group").slideUp()
        $("#armPenunjang_Group").slideUp()
        $("#armProcedures_Group").slideUp()
        $("#armRtl_Group").slideUp()
        <?php foreach ($mappingAssessment as $key => $value) {
        ?>
            $("#<?= $value['id']; ?>").slideDown()
        <?php
        } ?>
    })
</script>
<script>
    function appendAnamnesisMedis(accordionId) {
        $("#" + accordionId).append(`
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSubyektif">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubyektif" aria-expanded="true" aria-controls="collapseSubyektif"><b>ANAMNESIS</b></button>
                </h2>
                <div id="collapseSubyektif" class="accordion-collapse collapse show" aria-labelledby="headingSubyektif">
                    <div class="accordion-body text-muted">
                        <div class="row">
                            <h4>Anamnase</h4>
                            <hr>
                            <div class="col-sm-12 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="armdescription">Keluhan Utama</label>
                                        <textarea id="armdescription" name="description" rows="4" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Riwayat Penyakit Sekarang</h4>
                            <hr>
                            <div class="col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="armanamnase">Autoanamnesis</label>
                                        <textarea id="armanamnase" name="anamnase" rows="8" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="armalloanamnase">Alloanamnesis</label>
                                        <textarea id="armalloanamnase" name="alloanamnase" rows="8" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                            <h4>Riwayat Penyakit Dahulu</h4>
                            <hr>
                            <?php foreach ($aValue as $key => $value): ?>
                                <?php if ($value['p_type'] == 'GEN0009'): ?>
                                    <?php if ($value['value_score'] == '4' && in_array($value['value_id'], ['G0090101', 'G0090102'])): ?>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="arm<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                    <textarea id="arm<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif ($value['value_id'] == 'G0090202'): ?>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="arm<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                    <textarea id="arm<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        `);


        // '<div class="accordion-item">' +
        // '<h2 class="accordion-header" id="headingSubyektif">' +
        // '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubyektif" aria-expanded="true" aria-controls="collapseSubyektif"><b>ANAMNESIS</b></button>' +
        // '</h2>' +
        // '<div id="collapseSubyektif" class="accordion-collapse collapse show" aria-labelledby="headingSubyektif" >' +
        // '<div class="accordion-body text-muted">' +
        // '<div class="row">' +
        // '<div class="col-sm-6 col-xs-12">' +
        // '<div class="mb-3">' +
        // '<div class="form-group">' +
        // '<label for="armanamnase">Autoanamnesis</label>' +
        // '<textarea id="armanamnase" name="anamnase" rows="2" class="form-control " autocomplete="off"></textarea>' +
        // '</div>' +
        // '</div>' +
        // '</div>' +
        // '<div class="col-sm-6 col-xs-12">' +
        // '<div class="mb-3">' +
        // '<div class="form-group">' +
        // '<label for="armalloanamnase">Alloanamnesis</label>' +
        // '<textarea id="armalloanamnase" name="alloanamnase" rows="2" class="form-control " autocomplete="off"></textarea>' +
        // '</div>' +
        // '</div>' +
        // '</div>' +
        // '<div class="col-sm-12 col-xs-12">' +
        // '<div class="mb-3">' +
        // '<div class="form-group">' +
        // '<label for="armdescription">Riwayat Penyakit Sekarang</label>' +
        // '<textarea id="armdescription" name="description" rows="4" class="form-control " autocomplete="off"></textarea>' +
        // '</div>' +
        // '</div>' +
        // '</div>' +
        // )
    }

    function appendVitalSignMedis(accordionId) {
        $("#" + accordionId).append(
            '<div class="accordion-item">' +
            '<h2 class="accordion-header" id="armheadingVitalSign">' +
            '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#armcollapseVitalSign" aria-expanded="true" aria-controls="armcollapseVitalSign"><b>VITAL SIGN</b></button>' +
            '</h2>' +
            '<div id="armcollapseVitalSign" class="accordion-collapse collapse show" aria-labelledby="armheadingVitalSign" >' +
            '<div class="accordion-body text-muted">' +
            '<h5>Vital Sign <a id="copyPeriksaFisikBtn" href="#" onclick="copyLastTTV(\'arm\')">(copy)</a></h5>' +
            `<div id="armVitalSignContent" class="row mb-4">
                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                    <div class="form-group">
                        <label>Jenis EWS</label>
                        <select class="form-select" name="vs_status_id" id="armvs_status_id">
                            <option value="" selected>-- pilih --</option>
                            <option value="1">Dewasa</option>
                            <option value="4">Anak</option>
                            <option value="5">Neonatus</option>
                            <option value="10">Obsetric</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                    <div class="form-group">
                        <label>BB(Kg)</label>
                        <div class=" position-relative">
                            <input onchange="vitalsignInput(this)" type="text" name="weight" id="armweight" placeholder="" value="" class="form-control">
                            <span class="h6" id="badge-bb"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                    <div class="form-group">
                        <label>Tinggi(cm)</label>
                        <div class="position-relative">
                            <input onchange="vitalsignInput(this)" type="text" name="height" id="armheight" placeholder="" value="" class="form-control">
                            <span class="h6" id="badge-armheight"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                    <div class="form-group">
                        <label>Suhu(°C)</label>
                        <div class="position-relative">
                            <input onchange="vitalsignInput(this)" type="text" name="temperature" id="armtemperature" placeholder="" value="" class="form-control">
                            <span class="h6" id="badge-armtemperature"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                    <div class="form-group">
                        <label>Nadi(/menit)</label>
                        <div class="position-relative">
                            <input onchange="vitalsignInput(this)" type="text" name="nadi" id="armnadi" placeholder="" value="" class="form-control">
                            <span class="h6" id="badge-armnadi"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                    <div class="form-group"><label>T.Darah(mmHg)</label>
                        <div class="col-sm-12 " style="display: flex;  align-items: center;">
                            <div class="position-relative">
                                <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="armtension_upper" placeholder="" value="" class="form-control">
                                <span class="h6" id="badge-armtension_upper"></span>
                            </div>
                            <h4 class="mx-2">/</h4>
                            <div class="position-relative">
                                <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="armtension_below" placeholder="" value="" class="form-control">
                                <span class="h6" id="badge-armtension_below"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                    <div class="form-group">
                        <label>Saturasi(SpO2%)</label>
                        <div class="position-relative">
                            <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="armsaturasi" placeholder="" value="" class="form-control">
                            <span class="h6" id="badge-armsaturasi"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                    <div class="form-group">
                        <label>Nafas/RR(/menit)</label>
                        <div class="position-relative">
                            <input onchange="vitalsignInput(this)" type="text" name="nafas" id="armnafas" placeholder="" value="" class="form-control">
                            <span class="h6" id="badge-armnafas"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                    <div class="form-group">
                        <label>Diameter Lengan(cm)</label>
                        <div class="position-relative">
                            <input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="armarm_diameter" placeholder="" value="" class="form-control">
                            <span class="h6" id="badge-armarm_diameter"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                    <div class="form-group">
                        <label>Penggunaan Oksigen (L/mnt)</label>
                        <div class="position-relative">
                            <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="armoxygen_usage" placeholder="" value="" class="form-control">
                            <span class="h6" id="badge-armoxygen_usage"></span>
                        </div>
                    </div>
                </div>
                <!--==new -->
                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                    <div class="form-group">
                        <label>Kesadaran</label>
                        <select class="form-select" name="awareness" id="armawareness" onchange="vitalsignInput(this)">
                            <option value="0">Sadar</option>
                            <option value="3">Nyeri</option>
                            <option value="10">Unrespon</option>
                        </select>
                        <span class="h6" id="badge-armawareness"></span>
                    </div>
                </div>
                <!--==endofnew -->
                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                    <div class="form-group"><label>Keadaan Umum</label>
                        <select class="form-select" name="pemeriksaan" id="armpemeriksaan">
                            <option value="0">Baik</option>
                            <option value="1">Sedang</option>
                            <option value="2">Buruk</option>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-sm-12">
                    <div class="mb-4">
                        <div class="form-group"><label>Tanggal Periksa</label><textarea name="examination_date" id="armpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                    </div>
                </div> -->
            </div>
            <span id="armtotal_score"></span>
            ` +
            '</div>' +
            '</div>' +
            '</div>'
        )

        var ageYear = <?= @$visit['ageyear']; ?>;
        var ageMonth = <?= @$visit['agemonth']; ?>;
        var ageDay = <?= @$visit['ageday']; ?>;

        if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
            $("#armvs_status_id").prop("selectedIndex", 3);
        } else if (ageYear >= 18) {
            $("#armvs_status_id").prop("selectedIndex", 1);
        } else {
            $("#armvs_status_id").prop("selectedIndex", 2);
        }
        <?php if (@$visit['specialist_type_id'] == '1.05') {
        ?>
            $("#armvs_status_id").prop("selectedIndex", 4)
        <?php
        } ?>
        // var initialexamdetail = getLastObject(sortAscending(examForassessmentDetail, 'examination_date'))
        // if (initialexamdetail)
        //     fillExaminationDetail(initialexamdetail, 'arm')
        $("#armdweight").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#armdheight").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#armdtemperature").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#armdnadi").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#armdtension_upper").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#armdtension_below").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#armdsaturasi").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#armdnafas").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#armdarm_diameter").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        // $.each(examForassessmentDetail, function(key, value) {
        //     if (value?.body_id == pasienDiagnosa?.pasien_diagnosa_id) {
        //         examselectdetail = value
        //         setTimeout(() => {
        //             fillExaminationDetail(examselectdetail, 'arm')
        //         }, 1000);
        //         return false
        //     }
        // })
    }

    function appendRiwayatMedis(accordionId) {
        $("#" + accordionId).append(
            '<div class="accordion-item">' +
            '<h2 class="accordion-header" id="headingRiwayatMedis">' +
            '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRiwayatMedis" aria-expanded="true" aria-controls="collapseRiwayatMedis"><b>RIWAYAT LAIN</b></button>' +
            '</h2>' +
            '<div id="collapseRiwayatMedis" class="accordion-collapse collapse" aria-labelledby="headingRiwayatMedis"  style="">' +
            '<div class="accordion-body text-muted">' +
            '<div class="row">' +
            <?php foreach ($aValue as $key => $value) {
                if ($value['p_type'] == 'GEN0009') {
                    if ($value['value_score'] == '4' && !in_array($value['value_id'], ['G0090202', 'G0090101', 'G0090102'])) {
            ?> '<div class="col-sm-6 col-xs-12">' +
                        '<div class="mb-3">' +
                        '<div class="form-group">' +
                        '<label for="arm<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>' +
                        '<textarea id="arm<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                    <?php
                    } else if ($value['value_id'] == 'G0090403') {
                    ?> '<div class="col-sm-12 col-xs-12">' +
                        '<div class="mb-3">' +
                        '<div class="form-group">' +
                        '<label for="arm<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>' +
                        '<textarea id="arm<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                    <?php
                    }
                    ?> <?php
                    }
                } ?> '</div>' +

            '<div class="row">' +
            <?php foreach ($aValue as $key => $value) {
                if ($value['p_type'] == 'GEN0009') {
                    if ($value['value_score'] == '2') {
            ?> `<div class="col-sm-6 col-xs-12">
                            <div class="form-check mb-3">
                                <input id="arm<?= $value['p_type'] . $value['value_id']; ?>" class="form-check-input" type="checkbox" name="<?= $value['value_id']; ?>" value="1">
                                <label class="form-check-label" for="arm<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                            </div>
                        </div>` +
                    <?php
                    }
                    ?> <?php
                    }
                } ?> '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        )
    }

    function appendPemeriksaanFisikMedis(accordionId) {
        var ageYear = <?= @$visit['ageyear']; ?>;
        var ageMonth = <?= @$visit['agemonth']; ?>;
        var ageDay = <?= @$visit['ageday']; ?>;

        if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
            $("#avtvs_status_id").prop("selectedIndex", 3);
        } else if (ageYear >= 18) {
            $("#avtvs_status_id").prop("selectedIndex", 1);
        } else {
            $("#avtvs_status_id").prop("selectedIndex", 2);
        }


        $("#" + accordionId).append(
            '<div class="accordion-item">' +
            '<h2 class="accordion-header" id="headingBodyPart">' +
            '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBodyPart" aria-expanded="true" aria-controls="collapseBodyPart">' +
            '<b>PEMERIKSAAN FISIK</b>' +
            '</button>' +
            '</h2>' +
            '<div id="collapseBodyPart" class="accordion-collapse collapse show" aria-labelledby="headingBodyPart"  style="">' +
            '<div class="accordion-body text-muted">' +
            '<div id="appendPemeriksaanFisikMedisBody" class="row">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        )
    }



    function appendPenunjangTerapi(accordionId) {
        var accordionContent = `
                <div id="armPenunjang_Group" class="accordion-item">
                    <h2 class="accordion-header" id="headingPenunjang">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePenunjang" aria-expanded="true" aria-controls="collapsePenunjang">
                            <b>PENUNJANG DAN TERAPI</b>
                        </button>
                    </h2>
                    <div id="collapsePenunjang" class="accordion-collapse collapse show" aria-labelledby="headingPenunjang" >
                        <div class="accordion-body text-muted">
                            <div class="row mb-2">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="mb-3">
                                        <h4>PEMERIKSAAN DIAGNOSTIK PENUNJANG</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armlab_result">Periksa Lab <a id="copyPeriksaLabBtn" href="#" onclick="copyPeriksaLab()">(Copy)</a></label>
                                            <textarea id="armlab_result" name="lab_result" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armro_result">Periksa RO <a id="copyPeriksaRadBtn" href="#" onclick="copyPeriksaRad()">(Copy)</a></label>
                                            <textarea id="armro_result" name="ro_result" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armecg_result">Periksa EKG</label>
                                            <textarea id="armecg_result" name="ecg_result" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="mb-3">
                                        <h4>RENCANA ASUHAN DAN TERAPI</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armteraphy_desc">Farmakoterapi <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                            <textarea id="armteraphy_desc" name="teraphy_desc" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armteraphy_home">Obat Pulang <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                            <textarea id="armteraphy_home" name="teraphy_home" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armtherapy_target">Target Sasaran Terapi <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                            <textarea id="armtherapy_target" name="therapy_target" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

        // $("#" + accordionId).append(accordionContent);
    }

    var stringdiagnosa = `<div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="mb-4">
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table id="tablediagnosaMedis" class="table" data-export-title="<?php echo (@$visit['diantar_oleh'] . @$visit['no_registration']) ?>">
                                            <?php if (true) { ?>
                                                <thead>
                                                    <th class="text-center" style="width: 40%">Diagnosa</th>
                                                    <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                    <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                                </thead>
                                                <tbody id="bodyDiagMedis">
                                                </tbody>
                                            <?php }   ?>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button"  name="adddiagnosa" onclick="addRowDiagMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>`;

    function appendDiagnosaAccordion(accordionId) {
        var accordionContent = `
        <div id="armDiagnosas_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingDiagnosa">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosa" aria-expanded="true" aria-controls="collapseDiagnosa">
                    <b>ASSESSMENT (A)</b>
                </button>
            </h2>
            <div id="collapseDiagnosa" class="accordion-collapse collapse show" aria-labelledby="headingDiagnosa" >
                <div class="accordion-body text-muted">
                    <div class="row mb-2">
                        <div class="col-sm-6 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armmedical_problem">Permasalahan Medis</label>
                                    <textarea id="armmedical_problem" name="medical_problem" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armhurt">Penyebab Cidera/Keracunan</label>
                                    <textarea id="armhurt" name="hurt" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armdiagnosa_desc">Diagnosa Klinis</label>
                                    <textarea id="armdiagnosa_desc" name="diagnosa_desc" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendDiagnosaAkhirAccordion(accordionId) {
        var accordionContent = `
        <div id="armDiagnosas_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingDiagnosa">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosa" aria-expanded="true" aria-controls="collapseDiagnosa">
                    <b>ASSESSMENT (A)</b>
                </button>
            </h2>
            <div id="collapseDiagnosa" class="accordion-collapse collapse show" aria-labelledby="headingDiagnosa" >
                <div class="accordion-body text-muted">
                    <div class="row mb-2">
                        <div class="col-sm-6 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armmedical_problem">Indikasi Rawat Inap</label>
                                    <textarea id="armmedical_problem" name="medical_problem" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armhurt">Penyebab Cidera/Keracunan</label>
                                    <textarea id="armhurt" name="hurt" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armdiagnosa_desc">Diagnosa Masuk</label>
                                    <textarea id="armdiagnosa_desc" name="diagnosa_desc" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armdiagnosa_desc_discharge">Diagnosa Pulang</label>
                                    <textarea id="armdiagnosa_desc_discharge" name="diagnosa_desc_discharge" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armprocedure_desc">Tindakan Bedah</label>
                                    <div>
                                        <ul id="armprocedure_desc" class="list-group list-group-numbered">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendProsedurAccordion(accordionId) {
        if (pasienDiagnosa?.isrj == 0 || visit?.isrj == 0 || visit?.clinic_id == 'P012') {
            var accordionContent = `
                    <div id="armProcedures_Group" class="accordion-item">
                        <h2 class="accordion-header" id="headingProsedur">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProsedur" aria-expanded="true" aria-controls="collapseProsedur">
                                <b>PLANNING (P)</b>
                            </button>
                        </h2>
                        <div id="collapseProsedur" class="accordion-collapse collapse show" aria-labelledby="headingProsedur" >
                            <div class="accordion-body text-muted">
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="armstanding_order" class="">Standing Order </label>
                                                <textarea id="armstanding_order" name="standing_order" rows="8" class="form-control " autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arminstruction" class="">Target/Sasaran Terapi </label>
                                                <textarea id="arminstruction" name="instruction" rows="8" class="form-control " autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
        } else {
            var accordionContent = `
                    <div id="armProcedures_Group" class="accordion-item">
                        <h2 class="accordion-header" id="headingProsedur">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProsedur" aria-expanded="true" aria-controls="collapseProsedur">
                                <b>PLANNING (P)</b>
                            </button>
                        </h2>
                        <div id="collapseProsedur" class="accordion-collapse collapse show" aria-labelledby="headingProsedur" >
                            <div class="accordion-body text-muted">
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="armstanding_order" class="">Standing Order </label>
                                                <textarea id="armstanding_order" name="standing_order" rows="2" class="form-control " autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arminstruction" class="">Target/Sasaran Terapi </label>
                                                <textarea id="arminstruction" name="instruction" rows="8" class="form-control " autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
        }
        appendAccordionItem(accordionId, accordionContent);

        // initializeQuillEditorsById("armstanding_order")
        // initializeQuillEditorsById("arminstruction")
    }

    function appendProsedurResumeAccordion(accordionId) {
        if (pasienDiagnosa?.isrj == 0 || visit?.isrj == 0 || visit?.clinic_id == 'P012') {
            var accordionContent = `
                    <div id="armProcedures_Group" class="accordion-item">
                        <h2 class="accordion-header" id="headingProsedur">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProsedur" aria-expanded="true" aria-controls="collapseProsedur">
                                <b></b>
                            </button>
                        </h2>
                        <div id="collapseProsedur" class="accordion-collapse collapse show" aria-labelledby="headingProsedur" >
                            <div class="accordion-body text-muted">
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arminstruction" class="">Tindakan Non Bedah</label>
                                                <div>
                                                    <ul id="arminstruction" class="list-group list-group-numbered">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="" class="">Laboratorium </label>
                                                <div>
                                                    <p><i>---Hasil Lab muncul pada saat cetak---</i></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="" class="">Radiologi </label>
                                                <div>
                                                    <p><i>---Hasil Radiologi muncul pada saat cetak---</i></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="" class="">Farmakoterapi </label>
                                                <div>
                                                    <p><i>---Farmakoterapi muncul pada saat cetak---</i></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Cara Pulang</label>
                                            <select class="form-select" name="discharge_way" id="armdischarge_way">
                                                <option value="1">Atas Persetujuan </option>
                                                <option value="2">Atas Permintaan Sendiri</option>
                                                <option value="3">Rujuk</option>
                                                <option value="4">Rujuk Balik</option>
                                                <option value="5">Melarikan Diri</option>
                                                <option value="6">Meninggal Dunia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Keadaan Pulang</label>
                                            <select class="form-select" name="discharge_condition" id="armdischarge_condition">
                                                <option value="1">Sembuh/Sehat</option>
                                                <option value="2">Membaik</option>
                                                <option value="3">Belum Sembuh</option>
                                                <option value="4">MENINGGAL < 48 JAM</option>
                                                <option value="4">MENINGGAL > 48 JAM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                `;
        } else {
            var accordionContent = `
                    <div id="armProcedures_Group" class="accordion-item">
                        <h2 class="accordion-header" id="headingProsedur">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProsedur" aria-expanded="true" aria-controls="collapseProsedur">
                                <b>PLANNING (P)</b>
                            </button>
                        </h2>
                        <div id="collapseProsedur" class="accordion-collapse collapse show" aria-labelledby="headingProsedur" >
                            <div class="accordion-body text-muted">
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="armstanding_order" class="">Standing Order </label>
                                                <textarea id="armstanding_order" name="standing_order" rows="2" class="form-control " autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arminstruction" class="">Target/Sasaran Terapi </label>
                                                <textarea id="arminstruction" name="instruction" rows="8" class="form-control " autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
        }
        appendAccordionItem(accordionId, accordionContent);

        // initializeQuillEditorsById("armstanding_order")
        // initializeQuillEditorsById("arminstruction")
    }



    function appendLokalisAccordion(accordionId) {
        canvasAssessment = []
        var specialistLokalis = '';
        if (typeof(pasienDiagnosa.specialist_type_id) === 'undefined') {
            specialistLokalis = '<?= @$visit['specialist_type_id']; ?>'
        } else {
            specialistLokalis = pasienDiagnosa.specialist_type_id
        }

        var accordionContent = `
        <div id="armLokalis_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingLokalis">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLokalis" aria-expanded="true" aria-controls="collapseLokalis">
                    <b>LOKALIS</b>
                </button>
            </h2>
            <div id="collapseLokalis" class="accordion-collapse collapse show" aria-labelledby="headingLokalis" >
                <div class="accordion-body text-muted">
                    <div class="row mb-2">`

        $.each(aparameter, function(key, value) {
            if (value.p_type == 'GEN0002') {
                $.each(avalue, function(key1, value1) {
                    if (value.p_type == value1.p_type && value.parameter_id == value1.parameter_id && value1.value_score == '3') {
                        $.each(mapAssessment, function(key2, value2) {
                            if (value2.doc_id == value1.value_id && value2.specialist_type_id == specialistLokalis) {
                                accordionContent += `<div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="mb-4">
                                        <h5 class="font-size-14 mb-4 badge bg-primary">` + value1.value_desc + `:</h5>
                                        <div class="row">
                                            <div id="rowcanvas` + value1.p_type + value1.parameter_id + value1.value_id + `" class="col-xl-12 col-lg-12 col-md-12 text-center">
                                                <canvas id="canvas` + value1.p_type + value1.parameter_id + value1.value_id + `" style="border: 1px solid #000;" width="600" height="600"></canvas>
                                                <input type="hidden" name="lokalis` + value1.value_id + `" id="lokalis` + value1.value_id + `">
                                            </div>
                                            <div class="col-md-12 col-xm-12 m-1 text-center">
                                                <button id="undo` + value1.value_id + `" class="btn btn-primary" type="button"> Undo</button>
                                                <button id="clear` + value1.value_id + `" class="btn btn-danger" type="button"> Clear</button>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="lokalis` + value1.value_id + `desc">Deskripsi</label>
                                                    <textarea name="lokalis` + value1.value_id + `desc" id="lokalis` + value1.value_id + `desc" class="form-control" cols="30" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                    </div>
                                </div>`
                                // $(`#canvas` + value1.p_type + value1.parameter_id + value1.value_id).
                                canvasAssessment.push({
                                    p_type: value1.p_type,
                                    parameter_id: value1.parameter_id,
                                    value_id: value1.value_id,
                                    value_info: value1.value_info,
                                    canvas: `canvas` + value1.p_type + value1.parameter_id + value1.value_id,
                                    lokalis: 'lokalis' + value1.value_id
                                })
                            }
                        })
                    }
                })
            }
        })
        accordionContent += `</div>
                    </div>
                </div>
            </div>
        `;
        appendAccordionItem(accordionId, accordionContent);

        $("#armLokalis_Group").find("textarea").each(function() {
            // initializeQuillEditorsById($(this).attr("id"))
        })

        generateLokalis()
    }

    function appendGcsMedisAccordion(accordionId) {
        var accordionContent = `
        <div id="arpGcsMedis_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingGcsMedis">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGcsMedis" aria-expanded="true" aria-controls="collapseGcs">
                    <b>GLASGOW COMA SCALE (GCS)</b>
                </button>
            </h2>
            <div id="collapseGcsMedis" class="accordion-collapse collapse show" aria-labelledby="headingGcsMedis"  style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bodyGcsMedis">
                            </div>
                        </div>
                        <div id="bodyGcsMedisAddBtn" class="col-md-12 text-center">
                            <a onclick="addGcs(1,0,'armpasien_diagnosa_id', 'bodyGcsMedis', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                            <a onclick="copyGcs(1,0,'armpasien_diagnosa_id', 'bodyGcsMedis', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Copy Dokumen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        appendAccordionItem(accordionId, accordionContent);
        // addGcs(1, 0, 'armpasien_diagnosa_id', 'bodyGcsMedis');
    }

    function appendRtlAccordion(accordionId) {
        var accordionContent = `
        <div id="armRtl_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingrtl">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRtl" aria-expanded="true" aria-controls="collapseRtl">
                    <b>RENCANA TINDAK LANJUT</b>
                </button>
            </h2>
            <div id="collapseRtl" class="accordion-collapse collapse show" aria-labelledby="headingrtl" >
                <div class="accordion-body text-muted">
                    <div class="row mb-2">
                        <div class="row">
                            <div class="col-sm-4 col-md-3">
                                <div class="mb-3">
                                    <div id="armrujukan_group" class="form-group">
                                        <label>Rencana Tindak Lanjut</label>
                                        <select name="rencanatl" id="armrencanatl" onchange="tindakLanjut()" class="form-control ">
                                            <option value="1">Diperbolehkan Pulang</option>
                                            <option value="2">Pemeriksaan Penunjang</option>
                                            <option value="3">Dirujuk ke</option>
                                            <option value="4">Kontrol Kembali</option>
                                            <option value="5">Rawat Inap</option>
                                            <option value="6">Rujuk Internal Antar Poli</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <div class="mb-3">
                                    <div id="armtiperujukan_group" class="form-group" style="display: none">
                                        <label>Tipe Rujukan</label>
                                        <select name="tiperujukan" id="armtiperujukan" onchange="tindakLanjut()" class="form-control ">
                                            <option value="1">Penuh</option>
                                            <option value="2">Parsial</option>
                                            <option value="3">PRB</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="armdirujukkegroup" class="col-sm-4 col-md-3" style="display: none">
                                <div class="mb-3">
                                    <div class="form-group"><label for="diag_awal">Dirujuk Ke</label>
                                        <div class="select2-full-width" style="width:100%">
                                            <select class="form-control patient_list_ajax" name='dirujukke' id="armdirujukke" style="width: 100%">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="armtgl_kontrolgroup" class="col-sm-4 col-md-3" style="display: none">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Tanggal Kontrol</label>
                                        <div class="input-group" id="armtglkontrol">
                                            <input id="armtgl_kontrol" name="tgl_kontrol" type="datetime-local" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#artglkontrol' value="<?= date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="armkdpoli_kontrolgroup" class="col-sm-4 col-md-3" style="display: none">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Ke Poli</label>
                                        <select name="kdpoli_kontrol" id="armkdpoli_kontrol" class="form-control ">
                                            <?php $cliniclist = array();
                                            foreach ($clinic as $key => $value) {
                                                if ($clinic[$key]['stype_id'] == '1') {
                                                    $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                                }
                                            }
                                            asort($cliniclist);
                                            ?>
                                            <?php foreach ($cliniclist as $key => $value) { ?>
                                                <option value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="armdescriptiongroup" class="col-sm-8 col-md-3" style="display: none">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="pwd">Alasan/Ket</label>
                                        <textarea id="armprocedure_05" name="procedure_05" rows="1" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-4">
                            <div id="armskdpgroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                <div class="mb-4">
                                    <h3>Pembuatan SKDP</h3>
                                    <div class="staff-members">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Nomor SKDP</label>
                                                    <input id="armskdp" name="skdp" placeholder="" type="text" class="form-control " value="" readonly>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" id="addskdp" onclick="postKontrol(1)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="deleteskdp" onclick="deleteKontrol(1)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="armsprigroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                <div class="mb-4">
                                    <h3>Pembuatan SPRI</h3>
                                    <div class="staff-members">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Nomor SPRI</label>
                                                    <input id="armspri" name="spri" placeholder="" type="text" class="form-control " value="" readonly>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" id="addspri" onclick="postKontrol(2)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="deletespri" onclick="deleteKontrol(2)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="armrujukaneksternalgroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                <div class="mb-4">
                                    <h3>Pembuatan Rujukan Eksternal</h3>
                                    <div class="staff-members">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Nomor Rujukan</label>
                                                    <input id="armnorujukan" name="norujukan" placeholder="" type="text" class="form-control " value="" readonly>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" id="addnorujukan" onclick="postRujukan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="deleterujukan" onclick="deleteRujukan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="armrujukaninternalgroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                <div class="mb-4">
                                    <h3>Pembuatan Rujukan Internal</h3>
                                    <div class="staff-members">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Tanggal Rencana</label>
                                                    <input id="rujintvisitdate" name=" rujintvisitdate" type="date" class="form-control" placeholder="yyyy-mm-dd" value="<?= date('Y-m-d'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Poli Tujuan</label>
                                                    <select name='rujintclinicid' id="rujintclinicid" class="form-control select2 act" style="width:100%">
                                                        <?php $cliniclist = array();
                                                        foreach ($clinic as $key => $value) {
                                                            if ($clinic[$key]['stype_id'] == '1') {
                                                                $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                                            }
                                                        }
                                                        asort($cliniclist);
                                                        ?>
                                                        <?php foreach ($cliniclist as $key => $value) { ?>
                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                        <?php } ?>
                                                    </select> <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Dokter Tujuan</label>
                                                    <select name='rujintemployeeid' id="rujintemployeeid" class="form-control select2 act" style="width:100%">
                                                        <?php $dokterlist = array();
                                                        foreach ($dokter as $key => $value) {
                                                            if ($key == 'P003') {
                                                                foreach ($value as $key1 => $value1) {
                                                                    $dokterlist[$key1] = $value1;
                                                                }
                                                            }
                                                        }
                                                        asort($dokterlist);
                                                        ?>
                                                        <?php foreach ($dokterlist as $key => $value) { ?>
                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" id="addnorujukan" onclick="postRujukInternal()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="deleterujukan" onclick="deleteRujukInternal()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        // appendAccordionItem(accordionId, accordionContent);
    }

    function appendMedisAccordion(accordionId) {
        var accordionContent = `
        <div class="accordion-item">
            <h2 class="accordion-header" id="medis">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsemedis" aria-expanded="true" aria-controls="collapsemedis">
                    <b>MEDIS</b>
                </button>
            </h2>
            <div id="collapsemedis" class="accordion-collapse collapse show" aria-labelledby="medis" data-bs-parent="#accodrionFormRm">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <ul id="medisListLinkAll" class="list-group list-group-flush">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);
    }



    function appendFallRiskMedisAccordion(accordionId) {
        var accordionContent = `
        <div id="armFallRisk_Group" class="accordion-item">
            <h2 class="accordion-header" id="FallRiskMedis">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFallRiskMedis" aria-expanded="true" aria-controls="collapseFallRiskMedis">
                    <b>RESIKO JATUH</b>
                </button>
            </h2>
            <div id="collapseFallRiskMedis" class="accordion-collapse collapse" aria-labelledby="FallRiskMedis"  style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bodyFallRiskMedis">
                            </div>
                        </div>
                        <div id="bodyFallRiskMedisAddBtn" class="col-md-12 text-center">
                            <a onclick="addFallRisk(1, 0, 'armpasien_diagnosa_id', 'bodyFallRiskMedis', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                            <a onclick="copyFallRisk(1, 0, 'armpasien_diagnosa_id', 'bodyFallRiskMedis', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Copy Dokumen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);
        // addFallRisk(1, 0, 'armpasien_diagnosa_id', 'bodyFallRiskMedis')
    }

    function appendTriaseMedis(accordionId) {
        var accordionContent = `
            <div id="arpTriage_Group" class="accordion-item">
                <h2 class="accordion-header" id="triaseMedis">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetriaseMedis" aria-expanded="true" aria-controls="collapsetriaseMedis">
                        <b>TRIASE</b>
                    </button>
                </h2>
                <div id="collapsetriaseMedis" class="accordion-collapse collapse show" aria-labelledby="triaseMedis"  style="">
                    <div class="accordion-body text-muted">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="bodyTriageMedis">
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div id="bodyTriageMedisAddBtn" class="box-tab-tools text-center">
                                            <a onclick="addTriage(1,0,'armpasien_diagnosa_id', 'bodyTriageMedis', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                            <a onclick="copyTriage(1,0,'armpasien_diagnosa_id', 'bodyTriageMedis', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Copy Dokumen</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        appendAccordionItem(accordionId, accordionContent);
    }

    function appendFormEdukasi(accordionId) {
        var accordionContent = `
            <div id="arpEdukasiForm_Group" class="accordion-item">
                <h2 class="accordion-header" id="headingEducationForm">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEducationForm" aria-expanded="true" aria-controls="collapseEducationForm">
                        <b>FORMULIR PEMBERIAN EDUKASI</b>
                    </button>
                </h2>
                <div id="collapseEducationForm" class="accordion-collapse collapse show" aria-labelledby="headingEducationForm"  style="">
                    <div class="accordion-body text-muted">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="bodyEducationFormMedis">
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div id="bodyEducationFormMedisAddBtn" class="box-tab-tools text-center">
                                            <a onclick="addEducationForm(1,0,'armpasien_diagnosa_id', 'bodyEducationFormMedis', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendSirkulasi(accordionId) {
        var accordionContent = `
        <div id="armSirkulasi_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingSirkulasiMedis">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSirkulasiMedis" aria-expanded="true" aria-controls="collapseSirkulasiMedis">
                    <b>SIRKULASI</b>
                </button>
            </h2>
            <div id="collapseSirkulasiMedis" class="accordion-collapse collapse show" aria-labelledby="headingSirkulasiMedis"  style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bodySirkulasiMedis">
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div id="addSirkulasiButton" class="box-tab-tools text-center">
                                        <a onclick="addSirkulasi(1,0,'armpasien_diagnosa_id', 'bodySirkulasiMedis')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendPernapasan(accordionId) {
        var accordionContent = `
        <div id="arpPernapasan_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingPernapasan">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePernapasan" aria-expanded="true" aria-controls="collapsePernapasan">
                    <b>PERNAPASAN</b>
                </button>
            </h2>
            <div id="collapsePernapasan" class="accordion-collapse collapse show" aria-labelledby="headingPernapasan"  style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bodyPernapasanMedis">
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div id="addPernapasanButton" class="box-tab-tools text-center">
                                        <a onclick="addPernapasan(1,0, 'armpasien_diagnosa_id', 'bodyPernapasanMedis')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendApgarAccordion(accordionId) {
        var accordionContent = `
        <div id="arpApgar_Group" class="accordion-item">
            <h2 class="accordion-header" id="apgarMedis">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseapgarMedis" aria-expanded="true" aria-controls="collapseapgarMedis">
                    <b>APGAR</b>
                </button>
            </h2>
            <div id="collapseapgarMedis" class="accordion-collapse collapse show" aria-labelledby="apgarMedis"  style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bodyApgarMedis">
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div id="addApgarButton" class="box-tab-tools text-center">
                                        <a onclick="addApgar(1,0,\'armpasien_diagnosa_id\', \'bodyApgarMedis\')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendOculusAccordion(accordionId) {
        var accordionContent = `
        <div id="arpOculus_Group" class="accordion-item">
            <h2 class="accordion-header" id="OculusMedis">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOculusMedis" aria-expanded="true" aria-controls="collapseOculusMedis">
                    <b>PEMERIKSAAN FISIK</b>
                </button>
            </h2>
            <div id="collapseOculusMedis" class="accordion-collapse collapse show" aria-labelledby="OculusMedis"  style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td width="50%">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <td><b>Oculus Dextra</b></td>
                                                        <td>Keterangan</td>
                                                        <td><b>Oculus Sinistra</b></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020206" name="lokalisG0020206" class="form-control" value=""></td>
                                                        <td><b>Visus</b></td>
                                                        <td><input type="text" id="armGEN000202G0020228" name="lokalisG0020228" class="form-control" value=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020207" name="lokalisG0020207" class="form-control" value=""></td>
                                                        <td><b>Koreksi</b></td>
                                                        <td><input type="text" id="armGEN000202G0020229" name="lokalisG0020229" class="form-control" value=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020208" name="lokalisG0020208" class="form-control" value="dbn"></td>
                                                        <td><b>Skiaskopi</b></td>
                                                        <td><input type="text" id="armGEN000202G0020230" name="lokalisG0020230" class="form-control" value="dbn"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020209" name="lokalisG0020209" class="form-control" value="gerak BM bebas ke segala arah"></td>
                                                        <td><b>Bulbus Oculi</b></td>
                                                        <td><input type="text" id="armGEN000202G0020231" name="lokalisG0020231" class="form-control" value="gerak BM bebas ke segala arah"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020210" name="lokalisG0020210" class="form-control" value="tdk ada"></td>
                                                        <td><b>Parese Paralyse</b></td>
                                                        <td><input type="text" id="armGEN000202G0020232" name="lokalisG0020232" class="form-control" value="tdk ada"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020211" name="lokalisG0020211" class="form-control" value="dbn"></td>
                                                        <td><b>Supercilia</b></td>
                                                        <td><input type="text" id="armGEN000202G0020233" name="lokalisG0020233" class="form-control" value="dbn"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020212" name="lokalisG0020212" class="form-control" value="dbn"></td>
                                                        <td><b>Palpebra Superior</b></td>
                                                        <td><input type="text" id="armGEN000202G0020234" name="lokalisG0020234" class="form-control" value="dbn"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020213" name="lokalisG0020213" class="form-control" value="dbn"></td>
                                                        <td><b>Palpebra Inferior</b></td>
                                                        <td><input type="text" id="armGEN000202G0020235" name="lokalisG0020235" class="form-control" value="dbn"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020214" name="lokalisG0020214" class="form-control" value="hiperemis-"></td>
                                                        <td><b>Conjunctiva Palpebralis</b></td>
                                                        <td><input type="text" id="armGEN000202G0020236" name="lokalisG0020236" class="form-control" value="hiperemis-"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020215" name="lokalisG0020215" class="form-control" value="hiperemis-"></td>
                                                        <td><b>Conjunctiva Fornices</b></td>
                                                        <td><input type="text" id="armGEN000202G0020237" name="lokalisG0020237" class="form-control" value="hiperemis-"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020216" name="lokalisG0020216" class="form-control" value="hiperemis-"></td>
                                                        <td><b>Conjunctiva Bulbi</b></td>
                                                        <td><input type="text" id="armGEN000202G0020238" name="lokalisG0020238" class="form-control" value="hiperemis-"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td width="50%">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <td><b>Oculus Dextra</b></td>
                                                        <td>Keterangan</td>
                                                        <td><b>Oculus Sinistra</b></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020217" name="lokalisG0020217" class="form-control" value="dbn"></td>
                                                        <td><b>Sclera</b></td>
                                                        <td><input type="text" id="armGEN000202G0020239" name="lokalisG0020239" class="form-control" value="dbn"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020218" name="lokalisG0020218" class="form-control" value="jernih"></td>
                                                        <td><b>Cornea</b></td>
                                                        <td><input type="text" id="armGEN000202G0020240" name="lokalisG0020240" class="form-control" value="jernih"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020219" name="lokalisG0020219" class="form-control" value="cukup"></td>
                                                        <td><b>Camera Oculi Anterior</b></td>
                                                        <td><input type="text" id="armGEN000202G0020241" name="lokalisG0020241" class="form-control" value="cukup"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020220" name="lokalisG0020220" class="form-control" value="kripte+sinekia-"></td>
                                                        <td><b>Iris</b></td>
                                                        <td><input type="text" id="armGEN000202G0020242" name="lokalisG0020242" class="form-control" value="kripte+sinekia-"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020221" name="lokalisG0020221" class="form-control" value="b,c,r,3mm,RP+N"></td>
                                                        <td><b>Pupil</b></td>
                                                        <td><input type="text" id="armGEN000202G0020243" name="lokalisG0020243" class="form-control" value="b,c,r,3mm,RP+N"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020222" name="lokalisG0020222" class="form-control" value="jernih"></td>
                                                        <td><b>Lensa</b></td>
                                                        <td><input type="text" id="armGEN000202G0020244" name="lokalisG0020244" class="form-control" value="jernih"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020223" name="lokalisG0020223" class="form-control" value="dbn"></td>
                                                        <td><b>Corpus Vitreous</b></td>
                                                        <td><input type="text" id="armGEN000202G0020245" name="lokalisG0020245" class="form-control" value="dbn"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020224" name="lokalisG0020224" class="form-control" value="+cemerlang"></td>
                                                        <td><b>Fundus Reflek</b></td>
                                                        <td><input type="text" id="armGEN000202G0020246" name="lokalisG0020246" class="form-control" value="+cemerlang"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020225" name="lokalisG0020225" class="form-control" value="T(dig)N"></td>
                                                        <td><b>Tensio Oculi</b></td>
                                                        <td><input type="text" id="armGEN000202G0020247" name="lokalisG0020247" class="form-control" value="T(dig)N"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020226" name="lokalisG0020226" class="form-control" value="dbn"></td>
                                                        <td><b>Sistem Canalis Lacrimaris</b></td>
                                                        <td><input type="text" id="armGEN000202G0020248" name="lokalisG0020248" class="form-control" value="dbn"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="armGEN000202G0020227" name="lokalisG0020227" class="form-control" value="-"></td>
                                                        <td><b>Lain-lain</b></td>
                                                        <td><input type="text" id="armGEN000202G0020249" name="lokalisG0020249" class="form-control" value="-"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendPainMonitoringMedisAccordion(accordionId) {
        var accordionContent = `
        <div id="arpPainMonitoring_Group" class="accordion-item">
            <h2 class="accordion-header" id="painMonitoringMedis">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsepainMonitoringMedis" aria-expanded="true" aria-controls="collapsepainMonitoringMedis">
                    <b>MONITORING SKALA NYERI</b>
                </button>
            </h2>
            <div id="collapsepainMonitoringMedis" class="accordion-collapse collapse show" aria-labelledby="painMonitoringMedis"  style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bodyPainMonitoringMedis">
                            </div>
                        </div>
                        <div id="bodyPainMonitoringMedisAddBtn" class="col-md-12 text-center">
                            <a onclick="addPainMonitoring(1, 0, 'armpasien_diagnosa_id', 'bodyPainMonitoringMedis', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                            <a onclick="copyPainMonitoring(1, 0, 'armpasien_diagnosa_id', 'bodyPainMonitoringMedis', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Copy Dokumen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);
        // addPainMonitoring(1, 0, 'armpasien_diagnosa_id', 'bodyPainMonitoringMedis')
    }

    function appendDermatologiAccordion(accordionId) {
        var accordionContent = `
        <div id="arpdermatologi_Group" class="accordion-item">
            <h2 class="accordion-header" id="dermatologiMedis">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsedermatologiMedis" aria-expanded="true" aria-controls="collapsedermatologiMedis">
                    <b>PEMERIKSAAN FISIK DERMATOVENEROLOGI</b>
                </button>
            </h2>
            <div id="collapsedermatologiMedis" class="accordion-collapse collapse show" aria-labelledby="dermatologiMedis"  style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="FormAssessmen_Dermatovenerologi" class="satelite">
                                <div id="contentAssessmen_Dermatovenerologi_Hide">
                                </div>
                                <div id="contentAssessmen_Dermatovenerologi_Show"></div>
                                <div class="panel-footer text-end mb-4">
                                    <button type="button" class="btn btn-primary btn-save" id="btn-action-dermatovenerologi" style="margin-right: 10px;">Simpan</button>
                                    <button type="button" class="btn btn-secondary btn-edit"  id="close-pemeriksaanKulit-modal" style="margin-right: 10px">Edit</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);

        let newvisit = visit
        if (pasienDiagnosa?.pasien_diagnosa_id)
            newvisit.session_id = pasienDiagnosa?.pasien_diagnosa_id
        templateDermatovenerologi({
            visit: newvisit
        })
    }

    function appendSarafAccordion(accordionId) {
        var accordionContent = `
        <div id="arpdermatologi_Group" class="accordion-item">
            <h2 class="accordion-header" id="dermatologiMedis">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsedermatologiMedis" aria-expanded="true" aria-controls="collapsedermatologiMedis">
                    <b>Pemeriksaan Fisik</b>
                </button>
            </h2>
            <div id="collapsedermatologiMedis" class="accordion-collapse collapse show" aria-labelledby="dermatologiMedis"  style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="FormAssessmen_Neurologi" class="satelite">
                                <div id="contentAssessmen_Neurologi_Hide">
                                </div>
                                <div id="contentAssessmen_Neurologi_Show"></div>
                                <div class="row">
                                <div class="panel-footer text-end mb-4">
                                    <button type="button" class="btn btn-primary btn-save" id="btn-action-neurologi" style="margin-right: 10px;">Simpan</button>
                                    <button type="button" class="btn btn-secondary btn-edit"  id="edit-pemeriksaanSaraf-modal" style="margin-right: 10px">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);

        let newvisit = visit
        if (pasienDiagnosa?.pasien_diagnosa_id)
            newvisit.session_id = pasienDiagnosa?.pasien_diagnosa_id

        templateNeurologi({
            visit: newvisit
        })
    }
</script>




<script>
    function cetakAssessmentMedis() {
        var titlerj = '';
        if ($("#armclass_room_id").val() != '' && $("#armclass_room_id").val() != null) {
            titlerj = ' RAWAT INAP'
        } else {
            titlerj = ' RAWAT JALAN'
        }
        if (assessmentMedisType == 1) {
            titlerj = 'RESUME MEDIS' + titlerj
            linkcetak = 'resume_medis'
        } else {
            linkcetak = 'rawat_jalan'
        }
        openPopUpTab(`<?= base_url() ?>admin/rm/medis/${linkcetak}/<?= base64_encode(json_encode(@$visit)); ?>/${$("#armpasien_diagnosa_id").val()}/${titlerj}`)
    }

    function appendCetakMedis(accordionId) {
        var accordionContent = `
            <div  class="accordion-item">
                <h2 class="accordion-header" id="painMonitoringMedis">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsepainMonitoringMedis" aria-expanded="true" aria-controls="collapsepainMonitoringMedis">
                        <b>REPORTING</b>
                    </button>
                </h2>
                <div id="collapsepainMonitoringMedis" class="accordion-collapse collapse show" aria-labelledby="painMonitoringMedis"  style="">
                    <div class="accordion-body text-muted">
                        <div class="row">
                            <ul id="medisListLinkAll" class="list-group list-group-flush">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
</script>