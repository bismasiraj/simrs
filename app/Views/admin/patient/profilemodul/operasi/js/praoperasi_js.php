<script>
    let coba = [];
    $(document).ready(function() {
        // appendDiagnosa(accordionId, bodyId, pasienDiagnosa)
        // appendLokalisOperation("accordionPraOperasiSurgeryBody")
    })
    const appendLokalisOperation = (accordionId, data) => {
        let filteredData = aparameter?.filter(item => item?.p_type === 'OPRS002');
        let accordionContent = ``;


        $.each(filteredData, function(key, value) {
            $.each(avalue, function(key1, value1) {
                if (value.p_type == value1.p_type && value.parameter_id == value1.parameter_id && value1.value_score == '3') {

                    let matchedData = data.find(item => item.value_id.toUpperCase() === value1.value_id.toUpperCase()) ?? '';

                    let description = matchedData ? matchedData.value_desc : '';

                    accordionContent += `
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-4">
                            <h5 class="font-size-14 mb-4 badge bg-primary">${value1.value_desc}:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="canvas${value1.p_type}${value1.parameter_id}${value1.value_id}" width="450" height="450" style="border: 1px solid #000;"></canvas>
                                    <input type="hidden" name="lokalis${value1.value_id}" id="lokalis${value1.value_id}">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lokalis${value1.value_id}desc">Deskripsi</label>
                                        <textarea name="lokalis${value1.value_id}desc" id="lokalis${value1.value_id}desc" class="form-control" cols="30" rows="10">${description}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button id="undo${value1.value_id}" class="btn btn-primary" type="button">Undo</button>
                                    <button id="clear${value1.value_id}" class="btn btn-danger" type="button">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>`;
                }
            });
        });

        $("#" + accordionId).html(accordionContent);

        generateLokalisOperation({
            data: data
        });
    };
</script>
<script>
    const generateLokalisOperation = (props) => {

        let filteredData = aparameter?.filter(item => item?.p_type === 'OPRS002');

        $.each(filteredData, function(key, value) {
            $.each(avalue, function(key1, value1) {
                if (value.p_type == value1.p_type && value.parameter_id == value1.parameter_id &&
                    value1.value_score == '3') {
                    var canvas = document.getElementById('canvas' + value1.p_type + value1.parameter_id + value1.value_id);
                    const canvasDataInput = document.getElementById('lokalis' + value1.value_id);
                    var ctx = canvas.getContext('2d');
                    var drawing = false;
                    var line = [];
                    let drawingHistory = [];

                    var img = new Image();
                    img.onload = function() {
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    };

                    let matchedData = props?.data?.find(item => item.value_id.toUpperCase() === value1.value_id.toUpperCase());
                    img.src = matchedData.filedata64 ? img.src = 'data:image/png;base64,' + matchedData.filedata64 : img.src = '<?= base_url() ?>assets/img/asesmen' + value1.value_info;


                    canvas.addEventListener('mousedown', startDrawing);
                    canvas.addEventListener('mousemove', draw);
                    canvas.addEventListener('mouseup', stopDrawing);
                    canvas.addEventListener('mouseout', stopDrawing);

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
                        ctx.strokeStyle = '#000';

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

                    // Clear canvas and reset image
                    $("#clear" + value1.value_id).on("click", function() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        drawingHistory = []; // Clear the drawing history
                        img.onload = function() {
                            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        };
                        // Reset to the image from value_detail if available
                        if (matchedData && matchedData.value_detail) {
                            img.src = '<?= base_url('assets/img/asesmen') ?>' + matchedData.value_detail;
                        } else {
                            img.src = '<?= base_url('assets/img/asesmen') ?>' + value1.value_info;
                        }
                    });

                    // Undo drawing
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
                    });
                }
            });
        });
    };

    const saveCanvasOperasiData = () => {
        <?php foreach ($aParameter as $key => $value) {
            if ($value['p_type'] === 'OPRS002') {
                foreach ($aValue as $key1 => $value1) {
                    if ($value['p_type'] === $value1['p_type'] && $value['parameter_id'] === $value1['parameter_id']) {
                        $file_path = $value1["value_info"];
                        $extension = pathinfo($file_path, PATHINFO_EXTENSION);
        ?>
                        var canvasId = document.getElementById(
                            `canvas<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>`);
                        const canvasResult<?= $value1['value_id']; ?> = canvasId.toDataURL(`image/<?= $extension; ?>`);
                        $("#lokalis<?= $value1['value_id']; ?>").val(canvasResult<?= $value1['value_id']; ?>);
        <?php
                    }
                }
            }
        } ?>
    };
</script>
<script>
    const initiatePraOperasi = (props, res) => {

        enablePraOperasi()
        let opsSelected = props

        // $("#apoexamination_date").val(get_date())
        // $("#apostart_operation").val(opsSelected.start_operation)
        let pattern = /G00905/
        let historyKronis = historyPasien?.filter(function(str) {
            return pattern.test(str.value_id);
        })
        let historyAlergy = historyPasien?.filter(item =>
            item.value_id === 'G0090101' || item.value_id === 'G0090102'
        )

        $.each(historyPasien, function(key, value) {
            $("#apo" + value.value_id).prop("checked", true)
        })
        $.each(historyAlergy, function(key, value) {
            if (value.value_id == 'G0090101') {
                $("#aporiwayatobat").val(value.histories)
            }

            if (value.value_id == 'G0090102') {
                $("#aporiwayatnonobat").val(value.histories)
            }
        })

        if (res) {
            let praoperasi = res?.praoperasi
            let lokalis = res?.lokalis
            let diagnosa = res?.pasienDiagnosas
            let blood = res?.blood

            coba = blood

            $.each(diagnosa, function(key, value) {
                if (value.pasien_diagnosa_id == props?.body_id) {
                    addRowDiagDokter('bodyDiagPraOperation', '', value.diagnosa_desc, value.diagnosa_name, value
                        .diag_cat, value.diag_suffer)
                }
            })
            $.each(blood, function(key, value) {
                if (value.pasien_diagnosa_id == props?.body_id) {
                    addBloodRequest('bodyBloodRequest', value.body_id, value)
                }
            })
            appendLokalisOperation("accordionPraOperasiSurgeryBody", res?.lokalis)

            $.each(praoperasi, function(key, value) {
                $.each(value, function(key1, value1) {
                    if ($("#apo" + key1).is(":checkbox")) {
                        if (value1 == 1) {
                            $("#apo" + key1).prop("checked", true)
                        }
                    } else {
                        $("#apo" + key1).val(value1)
                        if (key1 == 'modified_date') {
                            let valdate = String(value1).substring(0, 16)
                            $("#apo" + key1).val(valdate)
                        }
                    }
                })
            })

            $.each(lokalis, function(key, value) {
                if (value.body_id = props?.body_id) {
                    $("#lokalis" + value.value_id).val(value.value_detail)
                    $("#lokalis" + value.value_id + "desc").val(value.value_desc)
                    let valid = String(value.value_id)
                    let canvas = document.getElementById('canvas' + value.p_type + value.parameter_id + valid
                        .toUpperCase());
                    const canvasDataInput = document.getElementById('lokalis' + value.value_id);
                    let context = canvas.getContext('2d');
                    const img = new Image();
                    img.onload = function() {
                        context.drawImage(img, 0, 0, canvas.width, canvas.height);
                    };
                    img.src = "data:image/png;base64," + value.filedata64;
                }
            })

        }
    }

    const assessmentPraOperasi = (props) => {
        console.log(props?.vactination_id);
        const visit = <?= json_encode($visit) ?>;
        postData({
            body_id: props?.vactination_id
        }, 'admin/PatientOperationRequest/getDataPraOperasi', res => {

            initiatePraOperasi(props, res);
        });

        $("button[name='signrm']").each(function() {
            if (props?.vactination_id) {
                $(this).prop('disabled', false);
            } else {
                $(this).prop('disabled', true);
            }
        });

        $("button[name='signrm']").off().on("click", function() {
            const buttonId = $(this).data('button-id');
            const signKe = $(this).data('sign-ke');

            addSignUserOPS("formPraOperasi", "accordionPraOperasi", props?.vactination_id, buttonId, 7, 1,
                signKe, "Catatan Keperawatan Pra Operasi");
        });


    };


    $("#formPraOperasi").on('submit', e => {
        e.preventDefault();
        saveCanvasOperasiData();
        const clicked_submit_btn = $(e.currentTarget).find(':submit');

        $.ajax({
            url: '<?php echo base_url(); ?>admin/PatientOperationRequest/savePraOperasi',
            type: "POST",
            data: new FormData(document.getElementById("formPraOperasi")),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: () => {},
            success: data => {
                if (data.status === "fail") {
                    const message = data.error.join(' ');
                    errorSwal('Data tidak ditemukan.');
                } else {
                    successSwal('Data berhasil disimpan.');
                    disablePraOperasi();
                }
                clicked_submit_btn.button('reset');
            },
            error: () => errorSwal('Error occurred. Please try again.'),
            complete: () => {}
        });
    });

    $("#formPraOperasiEditBtn").on("click", () => {
        enablePraOperasi();
    });
</script>
<script>
    const enablePraOperasi = () => {
        // e.preventDefault()
        $("#formPraOperasi").find("input, select, textarea").prop("disabled", false)
        $("#formPraOperasiSaveBtn").show()
        $("#formPraOperasiEditBtn").hide()
        $("#formPraOperasiSignBtn").hide()
        $("#formPraOperasiCetakBtn").hide()
    }
    const disablePraOperasi = () => {
        $("#formPraOperasi").find("input, select, textarea").prop("disabled", true)
        $("#formPraOperasiSaveBtn").hide()
        if ($("#apovalid_user").val() == '' || typeof($("#apovalid_user").val()) === 'undefined') {
            $("#formPraOperasiEditBtn").show()
            $("#formPraOperasiSignBtn").show()
            $("#formPraOperasiCetakBtn").show()
        } else {
            $("#formPraOperasiEditBtn").hide()
            $("#formPraOperasiSignBtn").hide()
            $("#formPraOperasiCetakBtn").hide()
        }
    }
</script>

<script>
    const addBloodRequest = (container, bodyId = null, bloodselected = []) => {
        <?php

        $bloodUsage = array_filter($aValue, function ($value) {
            return $value['p_type'] === 'BLOD001';
        });
        $bloodOptions = array_map(fn($value) => ['value' => $value['value_score'], 'desc' => $value['value_desc']], $bloodUsage);
        ?>

        let bloodOptions = [];

        const tbody = document.getElementById(container);
        const bloodIndex = tbody.getElementsByTagName("tr").length;
        if (!bodyId) bodyId = get_bodyid();

        bloodOptions = <?php echo json_encode($bloodOptions); ?>;

        if (typeof bloodOptions === 'object' && !Array.isArray(bloodOptions)) {
            bloodOptions = Object.keys(bloodOptions).map(key => bloodOptions[key]);
        }


        if (Array.isArray(bloodOptions)) {
            const bloodOptionsHtml = bloodOptions.map(option =>
                `<option value="${option.value}" ${option.value == bloodselected.blood_usage_type ? 'selected' : ''}>${option.desc}</option>`
            ).join('');

            $("#" + container).append(`
            <tr id="apoblood${bodyId}">
                <input type="hidden" name="bloodorg_unit_code[]" id="apobloodorg_unit_code${bodyId}" value="<?= $visit['org_unit_code']; ?>">
                <input type="hidden" name="bloodblood_request[]" id="apobloodblood_request${bodyId}" value="${bodyId}">
                <input type="hidden" name="bloodvisit_id[]" id="apobloodvisit_id${bodyId}" value="<?= $visit['visit_id']; ?>">
                <input type="hidden" name="bloodtrans_id[]" id="apobloodtrans_id${bodyId}" value="<?= $visit['trans_id']; ?>">
                <input type="hidden" name="bloodno_registration[]" id="apobloodno_registration${bodyId}" value="<?= $visit['no_registration']; ?>">
                <input type="hidden" name="bloodrequest_date[]" id="apobloodrequest_date${bodyId}" value="${get_date()}">
                <input type="hidden" name="bloodclinic_id[]" id="apobloodclinic_id${bodyId}" value="P002">
                <td>
                    <select id="apobloodblood_usage_type${bodyId}" name="bloodblood_usage_type[]" type="text" class="form-select">
                        ${bloodOptionsHtml}
                    </select>
                </td>
                <td>
                    <input type="number" name="bloodblood_quantity[]" id="apobloodblood_quantity${bodyId}" class="form-control" value="${bloodselected?.blood_quantity ?? ''}">
                </td>
                <td>
                    <select name="bloodmeasure_id[]" id="apobloodmeasure_id${bodyId}" type="text" class="form-select">
                        <option value="1">cc</option>
                        <option value="56">kantong</option>
                    </select>
                </td>
                <td>
                    <select name="bloodblood_type_id[]" id="apoblood_type_id${bodyId}" type="text" class="form-select">
                        <option value="0" ${bloodselected.blood_type_id == '0' ? 'selected' : ''}>-</option>
                        <option value="1" ${bloodselected.blood_type_id == '1' ? 'selected' : ''}>A</option>
                        <option value="2" ${bloodselected.blood_type_id == '2' ? 'selected' : ''}>B</option>
                        <option value="3" ${bloodselected.blood_type_id == '3' ? 'selected' : ''}>AB</option>
                        <option value="4" ${bloodselected.blood_type_id == '4' ? 'selected' : ''}>O</option>
                        <option value="5" ${bloodselected.blood_type_id == '5' ? 'selected' : ''}>-</option>
                        <option value="6" ${bloodselected.blood_type_id == '6' ? 'selected' : ''}>A+</option>
                        <option value="7" ${bloodselected.blood_type_id == '7' ? 'selected' : ''}>B+</option>
                        <option value="8" ${bloodselected.blood_type_id == '8' ? 'selected' : ''}>AB+</option>
                        <option value="9" ${bloodselected.blood_type_id == '9' ? 'selected' : ''}>O+</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="blooddescriptions[]" id="apoblooddescriptions${bodyId}" class="form-control" value="${bloodselected?.descriptions ?? ''}">
                </td>
                <td>
                    <input type="text" id="apousingtime${bodyId}" name="bloodusing_time[]" id="flatapousingtime${bodyId}" class="form-control datepicker-darah" value="${bloodselected?.using_time ? moment(bloodselected?.using_time).format("YYYY-MM-DD HH:mm"): moment().format("YYYY-MM-DD HH:mm")}">
                </td>
                 ${bloodselected?.terlayani == 1 ? `
                <td>
                    <input type="text" name="bloodtransfusion_start[]" class="form-control bg-white datepicker-darah" 
                    value="${moment(bloodselected?.transfusion_start, 'YYYY-MM-DD HH:mm', true).isValid() 
                            ? moment(bloodselected?.transfusion_start).format('YYYY-MM-DD HH:mm') 
                            : moment().format('YYYY-MM-DD HH:mm')}">
                </td>
                <td>
                    <input type="text" name="bloodtransfusion_end[]" class="form-control bg-white datepicker-darah" 
                    value="${moment(bloodselected?.transfusion_end, 'YYYY-MM-DD HH:mm', true).isValid() 
                            ? moment(bloodselected?.transfusion_end).format('YYYY-MM-DD HH:mm') 
                            : moment().format('YYYY-MM-DD HH:mm')}">
                </td>
                <td>
                    <input type="text" name="bloodreaction_desc[]" class="form-control" value="${bloodselected?.reaction_desc ?? ''}">
                </td>
                ` : 
                `
                <td></td>
                <td></td>
                <td></td>
                `}
                <td>
                    <a href="#" onclick="$('#apoblood${bodyId}').remove(); return false;" class="btn closebtn btn-">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        `);
            flatpickr('.datepicker-darah', {
                dateFormat: 'Y-m-d H:i',
                enableTime: true,
                time_24hr: true,
                onChange: function(selectedDates, dateStr, instance) {
                    console.log(selectedDates);
                }
            });
        } else {
            console.error('Expected bloodOptions to be an array, but got:', bloodOptions);
        }
    };
</script>