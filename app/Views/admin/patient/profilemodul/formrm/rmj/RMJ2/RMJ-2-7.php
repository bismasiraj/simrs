<?php
$this->extend('admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-template.php') ?>
<?php
?>

<?php $this->section('content') ?>
<div class="container">
    <div class="row" align="center">
        <div class="col-md-4">
            <strong>
                <p>Struktur Telinga</p>
            </strong>
            <div class="mb-1" style="text-align: center;">
                <div style="position: relative;">
                    <img id="struktur_telinga" src="<?= base_url('assets/img/asesmen/tht/struktur_telinga.jpg') ?>" alt="" style="width: 100%; height: auto;">
                    <canvas id="canvas_pf_ls_ear" width="400" height="400" style="border: 1px solid #000;position: absolute; top: 0; left: 0;"></canvas>
                </div>
                <input type="hidden" name="pf_ls_ear" id="pf_ls_ear">
            </div>
            <div class="col-md-12">
                <button id="undo_pf_ls_ear" class="btn btn-primary" type="button" onclick="undoPfLsEar()"> Undo</button>
                <button id="undo_pf_ls_ear" class="btn btn-danger" type="button" onclick="clearCanvasEar()"> Clear</button>
            </div>
        </div>
        <div class="col-md-4">
            <strong>
                <p>Struktur Hidung</p>
            </strong>
            <div class="mb-1" style="text-align: center;">
                <div style="position: relative;">
                    <img id="struktur_hidung" src="<?= base_url('assets/img/asesmen/tht/struktur_hidung.jpg') ?>" alt="" style="width: 100%; height: auto;">
                    <canvas id="canvas_pf_ls_nose" width="400" height="400" style="border: 1px solid #000;position: absolute; top: 0; left: 0;"></canvas>
                </div>
                <input type="hidden" name="pf_ls_nose" id="pf_ls_nose">
            </div>
            <div class="col-md-12">
                <button id="undo_pf_ls_ear" class="btn btn-primary" type="button" onclick="undoPfLsNose()"> Undo</button>
                <button id="undo_pf_ls_ear" class="btn btn-danger" type="button" onclick="clearCanvasNose()"> Clear</button>
            </div>
        </div>
        <div class="col-md-4">
            <strong>
                <p>Struktur Tenggorokan</p>
            </strong>
            <div class="mb-1" style="text-align: center;">
                <div style="position: relative;">
                    <img id="struktur_tenggorokan" src="<?= base_url('assets/img/asesmen/tht/struktur_tenggorokan.jpg') ?>" alt="" style="width: 100%; height: auto;">
                    <canvas id="canvas_pf_ls_throat" width="400" height="400" style="border: 1px solid #000;position: absolute; top: 0; left: 0;"></canvas>
                </div>
                <input type="hidden" name="pf_ls_throat" id="pf_ls_throat">
            </div>
            <div class="col-md-12">
                <button id="undo_pf_ls_ear" class="btn btn-primary" type="button" onclick="undoPfLsThroat()"> Undo</button>
                <button id="undo_pf_ls_ear" class="btn btn-danger" type="button" onclick="clearCanvasThroat()"> Clear</button>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>

<?php $this->section('jsContent') ?>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function undo(drawingHistory, ctx) {
        if (drawingHistory.length > 0) {
            // Remove last drawing operation from history
            drawingHistory.pop();
            // Restore previous state of canvas
            ctx.putImageData(drawingHistory[drawingHistory.length - 1], 0, 0);
        }
    }
</script>
<script>
    $("#canvas_pf_ls_ear").width($("#struktur_telinga").width())
    $("#canvas_pf_ls_ear").height($("#struktur_telinga").height())

    const canvas_pf_ls_ear = document.getElementById('canvas_pf_ls_ear');
    const context_pf_ls_ear = canvas_pf_ls_ear.getContext('2d');

    let drawingHistory = []; // Array to store drawing history

    canvas_pf_ls_ear.addEventListener('mousedown', startDrawing);
    canvas_pf_ls_ear.addEventListener('mousemove', draw);
    canvas_pf_ls_ear.addEventListener('mouseup', stopDrawing);

    // document.getElementById('undoButton').addEventListener('click', undo);
    // document.getElementById('clearButton').addEventListener('click', clearCanvas);

    var isDrawing = false;
    var line = []; // Store points for the current line being drawn

    function startDrawing(e) {
        isDrawing = true;
        draw(e)
        line = []; // Clear the current line
        line.push({
            x: e.offsetX,
            y: e.offsetY
        }); // Add the starting point of the line
    }

    function draw(e) {
        if (!isDrawing) return;
        console.log(line)
        context_pf_ls_ear.lineWidth = 2;
        context_pf_ls_ear.lineCap = 'round';
        context_pf_ls_ear.strokeStyle = '#000';
        const x = e.offsetX;
        const y = e.offsetY;
        context_pf_ls_ear.beginPath();
        context_pf_ls_ear.moveTo(line[line.length - 1].x, line[line.length - 1].y);
        context_pf_ls_ear.lineTo(x, y);
        context_pf_ls_ear.stroke();
        line.push({
            x,
            y
        }); // Add the current point to the line
    }

    function stopDrawing() {
        if (!isDrawing) return;
        isDrawing = false;
        drawingHistory.push(line); // Save the completed line to drawing history
    }

    function undoPfLsEar() {
        if (drawingHistory.length > 0) {
            // Remove the last line from the drawing history
            drawingHistory.pop();
            // Clear the canvas
            context_pf_ls_ear.clearRect(0, 0, canvas_pf_ls_ear.width, canvas_pf_ls_ear.height);
            // Redraw the remaining lines
            // console.log(drawingHistory)
            drawingHistory.forEach(line => {
                for (let i = 1; i < line.length; i++) {
                    console.log(line[i].x)
                    context_pf_ls_ear.beginPath();
                    context_pf_ls_ear.moveTo(line[i - 1].x, line[i - 1].y);
                    context_pf_ls_ear.lineTo(line[i].x, line[i].y);
                    context_pf_ls_ear.stroke();
                }
            });
        }
    }

    function clearCanvasEar() {
        context_pf_ls_ear.clearRect(0, 0, canvas_pf_ls_ear.width, canvas_pf_ls_ear.height);
        drawingHistory = []; // Clear the drawing history
    }
</script>
<script>
    $("#canvas_pf_ls_nose").width($("#struktur_hidung").width())
    $("#canvas_pf_ls_nose").height($("#struktur_hidung").height())

    const canvas_pf_ls_nose = document.getElementById('canvas_pf_ls_nose');
    const context_pf_ls_nose = canvas_pf_ls_nose.getContext('2d');

    let drawingHistoryNose = []; // Array to store drawing history

    canvas_pf_ls_nose.addEventListener('mousedown', startDrawingNose);
    canvas_pf_ls_nose.addEventListener('mousemove', drawNose);
    canvas_pf_ls_nose.addEventListener('mouseup', stopDrawingNose);

    var isDrawing = false;
    var lineNose = []; // Store points for the current line being drawn
    // lineNose.push({
    //     x: 0,
    //     y: 0
    // });

    function startDrawingNose(e) {
        isDrawingNose = true;
        lineNose = [];
        lineNose.push({
            x: e.offsetX,
            y: e.offsetY
        });
        drawNose(e);
    }

    function drawNose(e) {
        if (!isDrawingNose) return;
        console.log(lineNose)
        context_pf_ls_nose.lineWidth = 2;
        context_pf_ls_nose.lineCap = 'round';
        context_pf_ls_nose.strokeStyle = '#000';
        const x = e.offsetX;
        const y = e.offsetY;
        context_pf_ls_nose.beginPath();
        context_pf_ls_nose.moveTo(lineNose[lineNose.length - 1].x, lineNose[lineNose.length - 1].y);
        context_pf_ls_nose.lineTo(x, y);
        context_pf_ls_nose.stroke();
        lineNose.push({
            x,
            y
        });
    }

    function stopDrawingNose() {
        if (!isDrawingNose) return;
        isDrawingNose = false;
        drawingHistoryNose.push(lineNose);
    }

    function undoPfLsNose() {
        if (drawingHistoryNose.length > 0) {
            // Remove the last line from the drawing history
            drawingHistoryNose.pop();
            // Clear the canvas
            context_pf_ls_nose.clearRect(0, 0, canvas_pf_ls_nose.width, canvas_pf_ls_nose.height);
            // Redraw the remaining lines
            // console.log(drawingHistoryNose)
            drawingHistoryNose.forEach(line => {
                for (let i = 1; i < lineNose.length; i++) {
                    console.log(lineNose[i].x)
                    context_pf_ls_nose.beginPath();
                    context_pf_ls_nose.moveTo(lineNose[i - 1].x, lineNose[i - 1].y);
                    context_pf_ls_nose.lineTo(lineNose[i].x, lineNose[i].y);
                    context_pf_ls_nose.stroke();
                }
            });
        }
    }

    function clearCanvasNose() {
        context_pf_ls_nose.clearRect(0, 0, canvas_pf_ls_nose.width, canvas_pf_ls_nose.height);
        drawingHistoryNose = []; // Clear the drawing history
    }
</script>
<script>
    $("#canvas_pf_ls_throat").width($("#struktur_tenggorokan").width())
    $("#canvas_pf_ls_throat").height($("#struktur_tenggorokan").height())

    const canvas_pf_ls_throat = document.getElementById('canvas_pf_ls_throat');
    const contextthroat = canvas_pf_ls_throat.getContext('2d');

    let drawingHistoryThroat = []; // Array to store drawing history

    canvas_pf_ls_throat.addEventListener('mousedown', startDrawingThroat);
    canvas_pf_ls_throat.addEventListener('mousemove', drawThroat);
    canvas_pf_ls_throat.addEventListener('mouseup', stopDrawingThroat);

    // document.getElementById('undoButton').addEventListener('click', undo);
    // document.getElementById('clearButton').addEventListener('click', clearCanvas);

    var isDrawingThroat = false;
    var lineThroat = []; // Store points for the current line being drawn

    function startDrawingThroat(e) {
        isDrawingThroat = true;
        draw(e)
        // line = []; // Clear the current line
        lineThroat.push({
            x: e.offsetX,
            y: e.offsetY
        }); // Add the starting point of the line
    }

    function drawThroat(e) {
        if (!isDrawingThroat) return;
        contextthroat.lineWidth = 2;
        contextthroat.lineCap = 'round';
        contextthroat.strokeStyle = '#000';
        const x = e.offsetX;
        const y = e.offsetY;
        contextthroat.beginPath();
        contextthroat.moveTo(lineThroat[lineThroat.length - 1].x, lineThroat[lineThroat.length - 1].y);
        contextthroat.lineTo(x, y);
        contextthroat.stroke();
        lineThroat.push({
            x,
            y
        }); // Add the current point to the line
    }

    function stopDrawingThroat() {
        if (!isDrawingThroat) return;
        isDrawingThroat = false;
        drawingHistoryThroat.push(lineThroat); // Save the completed line to drawing history
    }

    function undoPfLsThroat() {
        if (drawingHistoryThroat.length > 0) {
            // Remove the last line from the drawing history
            drawingHistoryThroat.pop();
            // Clear the canvas
            contextthroat.clearRect(0, 0, canvas_pf_ls_throat.width, canvas_pf_ls_throat.height);
            // Redraw the remaining lines
            // console.log(drawingHistoryThroat)
            drawingHistoryThroat.forEach(line => {
                for (let i = 1; i < lineThroat.length; i++) {
                    console.log(lineThroat[i].x)
                    contextthroat.beginPath();
                    contextthroat.moveTo(lineThroat[i - 1].x, lineThroat[i - 1].y);
                    contextthroat.lineTo(lineThroat[i].x, lineThroat[i].y);
                    contextthroat.stroke();
                }
            });
        }
    }

    function clearCanvasThroat() {
        contextthroat.clearRect(0, 0, canvas_pf_ls_throat.width, canvas_pf_ls_throat.height);
        drawingHistoryThroat = []; // Clear the drawing history
    }
</script>

<script>
    var canvas = document.getElementById('ttd');
    const canvasDataInput = document.getElementById('ttd');
    var context = canvas.getContext('2d');

    var drawing = false;

    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context.lineWidth = 2;
        context.lineCap = 'round';
        context.strokeStyle = '#000';

        // Draw a line
        context.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
        context.stroke();
        context.beginPath();
        context.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context.beginPath();
    }

    function saveSignatureData() {
        const canvasData = canvas.toDataURL('image/png');
        canvasDataInput.value = canvasData;
    }
</script>

<script>
    var canvas1 = document.getElementById('canvas1');
    const canvasDataInput1 = document.getElementById('ttd_1');
    var context1 = canvas1.getContext('2d');
    var drawing = false;

    canvas1.addEventListener('mousedown', startDrawing);
    canvas1.addEventListener('mousemove', draw);
    canvas1.addEventListener('mouseup', stopDrawing);
    canvas1.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context1.lineWidth = 2;
        context1.lineCap = 'round';
        context1.strokeStyle = '#000';

        context1.lineTo(e.clientX - canvas1.getBoundingClientRect().left, e.clientY - canvas1.getBoundingClientRect().top);
        context1.stroke();
        context1.beginPath();
        context1.moveTo(e.clientX - canvas1.getBoundingClientRect().left, e.clientY - canvas1.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context1.beginPath();
    }

    function saveSignatureData1() {
        const canvasData1 = canvas1.toDataURL('image/png');

        canvasDataInput1.value = canvasData1;
    }
</script>
<script>
    $(document).ready(function() {
        <?php if (isset($val)) {
        ?>
            if ("<?= $val['body_id']; ?>" != null && "<?= $val['body_id']; ?>" != '') {
                $("#body_id").val("<?= $val['body_id']; ?>")
                $("#org_unit_code").val("<?= $val['org_unit_code']; ?>")
                $("#pasien_diagnosa_id").val("<?= $val['pasien_diagnosa_id']; ?>")
                $("#diagnosa_id").val("<?= $val['diagnosa_id']; ?>")
                $("#no_registration").val("<?= $val['no_registration']; ?>")
                $("#visit_id").val("<?= $val['visit_id']; ?>")
                $("#bill_id").val("<?= $val['bill_id']; ?>")
                $("#clinic_id").val("<?= $val['clinic_id']; ?>")
                $("#class_room_id").val("<?= $val['class_room_id']; ?>")
                $("#in_date").val("<?= $val['in_date']; ?>")
                $("#exit_date").val("<?= $val['exit_date']; ?>")
                $("#keluar_id").val("<?= $val['keluar_id']; ?>")
                $("#examination_date").val("<?= $val['examination_date']; ?>")
                $("#employee_id").val("<?= $val['employee_id']; ?>")
                $("#description").val("<?= $val['description']; ?>")
                $("#modified_date").val("<?= $val['modified_date']; ?>")
                $("#modified_by").val("<?= $val['modified_by']; ?>")
                $("#modified_from").val("<?= $val['modified_from']; ?>")
                $("#status_pasien_id").val("<?= $val['status_pasien_id']; ?>")
                $("#ageyear").val("<?= $val['ageyear']; ?>")
                $("#agemonth").val("<?= $val['agemonth']; ?>")
                $("#ageday").val("<?= $val['ageday']; ?>")
                $("#thename").val("<?= $val['thename']; ?>")
                $("#theaddress").val("<?= $val['theaddress']; ?>")
                $("#theid").val("<?= $val['theid']; ?>")
                $("#isrj").val("<?= $val['isrj']; ?>")
                $("#gender").val("<?= $val['gender']; ?>")
                $("#doctor").val("<?= $val['doctor']; ?>")
                $("#kal_id").val("<?= $val['kal_id']; ?>")
                $("#petugas_id").val("<?= $val['petugas_id']; ?>")
                $("#petugas").val("<?= $val['petugas']; ?>")
                $("#account_id").val("<?= $val['account_id']; ?>")
                $("#cpoe_emr_rel_id").val("<?= $val['cpoe_emr_rel_id']; ?>")
                $("#cpoe_id").val("<?= $val['cpoe_id']; ?>")
                $("#episode_categ").val("<?= $val['episode_categ']; ?>")
                $("#date_order").val("<?= $val['date_order']; ?>")
                $("#patient_id").val("<?= $val['patient_id']; ?>")
                $("#patient_code").val("<?= $val['patient_code']; ?>")
                $("#patient_age").val("<?= $val['patient_age']; ?>")
                $("#patient_gender").val("<?= $val['patient_gender']; ?>")
                $("#colorbar").val("<?= $val['colorbar']; ?>")
                $("#physician_id").val("<?= $val['physician_id']; ?>")
                $("#physician_speciality").val("<?= $val['physician_speciality']; ?>")
                $("#payment_method").val("<?= $val['payment_method']; ?>")
                $("#pricelist_id").val("<?= $val['pricelist_id']; ?>")
                $("#currency_id").val("<?= $val['currency_id']; ?>")
                $("#is_out_cppt").val("<?= $val['is_out_cppt']; ?>")
                $("#soap_subjective").val("<?= $val['soap_subjective']; ?>")
                $("#soap_objective").val("<?= $val['soap_objective']; ?>")
                $("#ana_main_complaint").val("<?= $val['ana_main_complaint']; ?>")
                $("#ana_auto_current_disease_history").val("<?= $val['ana_auto_current_disease_history']; ?>")
                $("#ana_past_disease_history").val("<?= $val['ana_past_disease_history']; ?>")
                $("#ana_family_disease_history").val("<?= $val['ana_family_disease_history']; ?>")
                $("#ana_allergy_history_non_drugs").val("<?= $val['ana_allergy_history_non_drugs']; ?>")
                $("#ana_allergy_history_drugs").val("<?= $val['ana_allergy_history_drugs']; ?>")
                $("#ana_pregnancy_childbirth_history").val("<?= $val['ana_pregnancy_childbirth_history']; ?>")
                $("#ana_diet_history").val("<?= $val['ana_diet_history']; ?>")
                $("#ana_imun_history").val("<?= $val['ana_imun_history']; ?>")
                $("#ana_drugs_consumed").val("<?= $val['ana_drugs_consumed']; ?>")
                $("#pf_vital_sign_bp").val("<?= $val['pf_vital_sign_bp']; ?>")
                $("#pf_vital_sign_n").val("<?= $val['pf_vital_sign_n']; ?>")
                $("#pf_vital_sign_s").val("<?= $val['pf_vital_sign_s']; ?>")
                $("#pf_vital_sign_rr").val("<?= $val['pf_vital_sign_rr']; ?>")
                $("#pf_vital_sign_weight").val("<?= $val['pf_vital_sign_weight']; ?>")
                $("#pf_vital_sign_height").val("<?= $val['pf_vital_sign_height']; ?>")
                $("#pf_vital_sign_spo2").val("<?= $val['pf_vital_sign_spo2']; ?>")
                $("#pf_vital_sign_bmi").val("<?= $val['pf_vital_sign_bmi']; ?>")
                $("#pf_gcs_type").val("<?= $val['pf_gcs_type']; ?>")
                $("#pf_gcs_e").val("<?= $val['pf_gcs_e']; ?>")
                $("#pf_gcs_v").val("<?= $val['pf_gcs_v']; ?>")
                $("#pf_gcs_m").val("<?= $val['pf_gcs_m']; ?>")
                $("#pf_pgcs_e").val("<?= $val['pf_pgcs_e']; ?>")
                $("#pf_pgcs_v_type").val("<?= $val['pf_pgcs_v_type']; ?>")
                $("#pf_pgcs_v").val("<?= $val['pf_pgcs_v']; ?>")
                $("#pf_pgcs_v_non").val("<?= $val['pf_pgcs_v_non']; ?>")
                $("#pf_pgcs_m").val("<?= $val['pf_pgcs_m']; ?>")
                $("#pf_general_condition").val("<?= $val['pf_general_condition']; ?>")
                $("#pf_cranium").val("<?= $val['pf_cranium']; ?>")
                $("#pf_eyes").val("<?= $val['pf_eyes']; ?>")
                $("#pf_nose").val("<?= $val['pf_nose']; ?>")
                $("#pf_mouth").val("<?= $val['pf_mouth']; ?>")
                $("#pf_tooth").val("<?= $val['pf_tooth']; ?>")
                $("#pf_neck").val("<?= $val['pf_neck']; ?>")
                $("#pf_thorax").val("<?= $val['pf_thorax']; ?>")
                $("#pf_thorax_image").val("<?= $val['pf_thorax_image']; ?>")
                $("#pf_heart").val("<?= $val['pf_heart']; ?>")
                $("#pf_heart_image").val("<?= $val['pf_heart_image']; ?>")
                $("#pf_lungs").val("<?= $val['pf_lungs']; ?>")
                $("#pf_abdomen").val("<?= $val['pf_abdomen']; ?>")
                $("#pf_abdomen_image").val("<?= $val['pf_abdomen_image']; ?>")
                $("#pf_hepar").val("<?= $val['pf_hepar']; ?>")
                $("#pf_lien").val("<?= $val['pf_lien']; ?>")
                $("#pf_kidney").val("<?= $val['pf_kidney']; ?>")
                $("#pf_genitalia").val("<?= $val['pf_genitalia']; ?>")
                $("#pf_upper_extremity").val("<?= $val['pf_upper_extremity']; ?>")
                $("#pf_lower_extremity").val("<?= $val['pf_lower_extremity']; ?>")
                $("#pf_ls_ear").val("<?= $val['pf_ls_ear']; ?>")
                $("#pf_ls_nose").val("<?= $val['pf_ls_nose']; ?>")
                $("#pf_ls_throat").val("<?= $val['pf_ls_throat']; ?>")
                $("#cause_of_injury_poisoning").val("<?= $val['cause_of_injury_poisoning']; ?>")
                $("#nursing_problem").val("<?= $val['nursing_problem']; ?>")
                $("#medical_problem").val("<?= $val['medical_problem']; ?>")
                $("#care_and_therapy_plan").val("<?= $val['care_and_therapy_plan']; ?>")
                $("#follow_up_plan").val("<?= $val['follow_up_plan']; ?>")
                $("#rtj_control").val("<?= $val['rtj_control']; ?>")
                $("#rtj_time_of_death_emergency").val("<?= $val['rtj_time_of_death_emergency']; ?>")
                $("#rtj_inpatient_indication").val("<?= $val['rtj_inpatient_indication']; ?>")
                $("#rtj_inpatient_dpjp").val("<?= $val['rtj_inpatient_dpjp']; ?>")
                $("#rtj_inpatient_classes").val("<?= $val['rtj_inpatient_classes']; ?>")
                $("#rtj_inpatient_ward").val("<?= $val['rtj_inpatient_ward']; ?>")
                $("#rtj_inpatient_room").val("<?= $val['rtj_inpatient_room']; ?>")
                $("#rtj_inpatient_bed").val("<?= $val['rtj_inpatient_bed']; ?>")
                $("#rtj_referenced").val("<?= $val['rtj_referenced']; ?>")
                $("#rtj_referenced_to").val("<?= $val['rtj_referenced_to']; ?>")
                $("#rtj_referenced_phys").val("<?= $val['rtj_referenced_phys']; ?>")
                $("#rtj_referenced_based_on").val("<?= $val['rtj_referenced_based_on']; ?>")
                $("#rtj_referenced_deliver_by").val("<?= $val['rtj_referenced_deliver_by']; ?>")
                $("#patient_education").val("<?= $val['patient_education']; ?>")
                $("#if_patient_family").val("<?= $val['if_patient_family']; ?>")
                $("#if_can_not_give_edu").val("<?= $val['if_can_not_give_edu']; ?>")
                $("#explanation_receipient_name").val("<?= $val['explanation_receipient_name']; ?>")
                $("#doctor_name").val("<?= $val['doctor_name']; ?>")
                $("#paraf_doctor").val("<?= $val['paraf_doctor']; ?>")
                $("#episode_id").val("<?= $val['episode_id']; ?>")
                $("#app_nmbr").val("<?= $val['app_nmbr']; ?>")
                $("#code").val("<?= $val['code']; ?>")
                $("#proc_order_id").val("<?= $val['proc_order_id']; ?>")
                $("#open_header_flag").val("<?= $val['open_header_flag']; ?>")
                $("#hide_action_button").val("<?= $val['hide_action_button']; ?>")
                $("#lab_order_id").val("<?= $val['lab_order_id']; ?>")
                $("#physio_order_id").val("<?= $val['physio_order_id']; ?>")
                $("#radio_order_id").val("<?= $val['radio_order_id']; ?>")
                $("#is_cppt_leads").val("<?= $val['is_cppt_leads']; ?>")
                $("#refphysician_id").val("<?= $val['refphysician_id']; ?>")
                $("#inpatient_physician_speciality").val("<?= $val['inpatient_physician_speciality']; ?>")
                $("#is_fast_track").val("<?= $val['is_fast_track']; ?>")
                $("#is_cito").val("<?= $val['is_cito']; ?>")
                $("#is_rad_pending").val("<?= $val['is_rad_pending']; ?>")
                $("#rad_pending_order").val("<?= $val['rad_pending_order']; ?>")
                $("#is_lab_pending").val("<?= $val['is_lab_pending']; ?>")
                $("#lab_pending_order").val("<?= $val['lab_pending_order']; ?>")
                $("#is_phy_pending").val("<?= $val['is_phy_pending']; ?>")
                $("#phy_pending_order").val("<?= $val['phy_pending_order']; ?>")
                $("#has_drug_allergy").val("<?= $val['has_drug_allergy']; ?>")
                $("#state").val("<?= $val['state']; ?>")
                $("#standing_order").html("<?= $val['standing_order']; ?>")
                $("#is_locked").val("<?= $val['is_locked']; ?>")
                $("#text_diagnosis").val("<?= $val['text_diagnosis']; ?>")
                $("#is_signed").val("<?= $val['is_signed']; ?>")
                $("#last_notebook").val("<?= $val['last_notebook']; ?>")
                $("#inv_vendor_lab_id").val("<?= $val['inv_vendor_lab_id']; ?>")
                $("#lab_medical_checkup").val("<?= $val['lab_medical_checkup']; ?>")
                $("#inv_vendor_radio_id").val("<?= $val['inv_vendor_radio_id']; ?>")
                $("#inv_vendor_phy_id").val("<?= $val['inv_vendor_phy_id']; ?>")
                $("#inv_vendor_id").val("<?= $val['inv_vendor_id']; ?>")
                $("#inv_vendor_nurse_id").val("<?= $val['inv_vendor_nurse_id']; ?>")
                $("#inv_vendor_midwife_id").val("<?= $val['inv_vendor_midwife_id']; ?>")
                $("#has_pain_scale").val("<?= $val['has_pain_scale']; ?>")
                $("#pain_scale_type").val("<?= $val['pain_scale_type']; ?>")
                $("#numeric_scale").val("<?= $val['numeric_scale']; ?>")
                $("#wong_baker_scale").val("<?= $val['wong_baker_scale']; ?>")
                $("#cpot_ekspresi_wajah").val("<?= $val['cpot_ekspresi_wajah']; ?>")
                $("#cpot_gerakan_tubuh").val("<?= $val['cpot_gerakan_tubuh']; ?>")
                $("#cpot_options").val("<?= $val['cpot_options']; ?>")
                $("#cpot_aktivasi_ventilator").val("<?= $val['cpot_aktivasi_ventilator']; ?>")
                $("#cpot_berbicara").val("<?= $val['cpot_berbicara']; ?>")
                $("#cpot_ketegangan_otot").val("<?= $val['cpot_ketegangan_otot']; ?>")
                $("#nips_ekspresi_wajah").val("<?= $val['nips_ekspresi_wajah']; ?>")
                $("#nips_tangisan").val("<?= $val['nips_tangisan']; ?>")
                $("#nips_pola_nafas").val("<?= $val['nips_pola_nafas']; ?>")
                $("#nips_tungkai").val("<?= $val['nips_tungkai']; ?>")
                $("#nips_tingkat_kesadaran").val("<?= $val['nips_tingkat_kesadaran']; ?>")
                $("#painad_pernafasan").val("<?= $val['painad_pernafasan']; ?>")
                $("#painad_vokalisasi_negatif").val("<?= $val['painad_vokalisasi_negatif']; ?>")
                $("#painad_ekspresi_wajah").val("<?= $val['painad_ekspresi_wajah']; ?>")
                $("#painad_bahasa_tubuh").val("<?= $val['painad_bahasa_tubuh']; ?>")
                $("#painad_konsabilitas").val("<?= $val['painad_konsabilitas']; ?>")
                $("#flacc_wajah").val("<?= $val['flacc_wajah']; ?>")
                $("#flacc_kaki").val("<?= $val['flacc_kaki']; ?>")
                $("#flacc_aktivitas").val("<?= $val['flacc_aktivitas']; ?>")
                $("#flacc_menangis").val("<?= $val['flacc_menangis']; ?>")
                $("#flacc_konsabilitas").val("<?= $val['flacc_konsabilitas']; ?>")
                $("#has_fall_risk").val("<?= $val['has_fall_risk']; ?>")
                $("#fall_risk_desc").val("<?= $val['fall_risk_desc']; ?>")
                $("#fall_risk_type").val("<?= $val['fall_risk_type']; ?>")
                $("#hd_usia").val("<?= $val['hd_usia']; ?>")
                $("#hd_jenis_kelamin").val("<?= $val['hd_jenis_kelamin']; ?>")
                $("#hd_diagnosa").val("<?= $val['hd_diagnosa']; ?>")
                $("#hd_gangguan_kognitif").val("<?= $val['hd_gangguan_kognitif']; ?>")
                $("#hd_faktor_lingkungan").val("<?= $val['hd_faktor_lingkungan']; ?>")
                $("#hd_respon_pembedahan_sedasi_anestesi").val("<?= $val['hd_respon_pembedahan_sedasi_anestesi']; ?>")
                $("#hd_respon_penggunaan_medikamentosa").val("<?= $val['hd_respon_penggunaan_medikamentosa']; ?>")
                $("#fm_riwayat_jatuh").val("<?= $val['fm_riwayat_jatuh']; ?>")
                $("#fm_diagnosis_sekunder").val("<?= $val['fm_diagnosis_sekunder']; ?>")
                $("#fm_menggunakan_alat_bantu").val("<?= $val['fm_menggunakan_alat_bantu']; ?>")
                $("#fm_menggunakan_infuse_heparine").val("<?= $val['fm_menggunakan_infuse_heparine']; ?>")
                $("#fm_gaya_berjalan").val("<?= $val['fm_gaya_berjalan']; ?>")
                $("#fm_status_mental").val("<?= $val['fm_status_mental']; ?>")
                $("#fm_medikasi").val("<?= $val['fm_medikasi']; ?>")
                $("#note_subjective").html("<?= $val['note_subjective']; ?>")
                $("#note_objective").html("<?= $val['note_objective']; ?>")
                $("#note_obat_confirmed").html("<?= $val['note_obat_confirmed']; ?>")
                $("#note_lab_confirmed").html("<?= $val['note_lab_confirmed']; ?>")
                $("#note_rad_confirmed").html("<?= $val['note_rad_confirmed']; ?>")
                $("#note_phy_confirmed").html("<?= $val['note_phy_confirmed']; ?>")
                $("#note_proc_confirmed").html("<?= $val['note_proc_confirmed']; ?>")
                $("#additional_note").val("<?= $val['additional_note']; ?>")
                $("#final_note").val("<?= $val['final_note']; ?>")
                $("#create_uid").val("<?= $val['create_uid']; ?>")
                $("#create_date").val("<?= $val['create_date']; ?>")
                $("#write_uid").val("<?= $val['write_uid']; ?>")
                $("#write_date").val("<?= $val['write_date']; ?>")
                $("#patient_family_name").val("<?= $val['patient_family_name']; ?>")
                $("#is_applicant_signed").val("<?= $val['is_applicant_signed']; ?>")
                $("#applicant_sign").val("<?= $val['applicant_sign']; ?>")
                $("#rtj_inpatient_location").val("<?= $val['rtj_inpatient_location']; ?>")
                $("#rtj_referenced_dept").val("<?= $val['rtj_referenced_dept']; ?>")
                $("#rtj_inpatient_standing_order").val("<?= $val['rtj_inpatient_standing_order']; ?>")
                $("#rtj_is_control").val("<?= $val['rtj_is_control']; ?>")
                $("#rtj_control_date").val("<?= $val['rtj_control_date']; ?>")
                $("#rtj_control_reason").val("<?= $val['rtj_control_reason']; ?>")
                $("#rtj_outpatient_type").val("<?= $val['rtj_outpatient_type']; ?>")
                $("#rtj_referenced_based_other").val("<?= $val['rtj_referenced_based_other']; ?>")
                $("#rtj_rujuk_type").val("<?= $val['rtj_rujuk_type']; ?>")
                $("#pf_ears").val("<?= $val['pf_ears']; ?>")
                $("#coass_residence_sign").val("<?= $val['coass_residence_sign']; ?>")
                $("#is_coas_signed").val("<?= $val['is_coas_signed']; ?>")
                $("#coas_signed_datetime").val("<?= $val['coas_signed_datetime']; ?>")
                $("#month_count").val("<?= $val['month_count']; ?>")
                $("#rtj_internal_ref_pysician_id").val("<?= $val['rtj_internal_ref_pysician_id']; ?>")
                $("#rtj_internal_ref_notes").val("<?= $val['rtj_internal_ref_notes']; ?>")
                $("#soap_planning").val("<?= $val['soap_planning']; ?>")
                $("#is_consul_discount").val("<?= $val['is_consul_discount']; ?>")
                $("#sign_datetime").val("<?= $val['sign_datetime']; ?>")
                $("#pf_ls_eardrum").val("<?= $val['pf_ls_eardrum']; ?>")
                $("#pf_ls_ear_desc").val("<?= $val['pf_ls_ear_desc']; ?>")
                $("#pf_ls_nose_desc").val("<?= $val['pf_ls_nose_desc']; ?>")
                $("#pf_ls_throat_desc").val("<?= $val['pf_ls_throat_desc']; ?>")
                $("#clinical_indication").val("<?= $val['clinical_indication']; ?>")
                $("#target_of_therapy").val("<?= $val['target_of_therapy']; ?>")
                $("#rtj_out_instruction").val("<?= $val['rtj_out_instruction']; ?>")
                $("#set_all_dbn").val("<?= $val['set_all_dbn']; ?>")
                $("#education_material").val("<?= $val['education_material']; ?>")
                $("#outer_ear").val("<?= $val['outer_ear']; ?>")
                $("#earlobe").val("<?= $val['earlobe']; ?>")
                $("#ear_canal").val("<?= $val['ear_canal']; ?>")
                $("#middle_ear").val("<?= $val['middle_ear']; ?>")
                $("#tympanic_membrane").val("<?= $val['tympanic_membrane']; ?>")
                $("#audiometry").val("<?= $val['audiometry']; ?>")
                $("#outer_cavum_nasi").val("<?= $val['outer_cavum_nasi']; ?>")
                $("#inner_cavum_nasi").val("<?= $val['inner_cavum_nasi']; ?>")
                $("#concae").val("<?= $val['concae']; ?>")
                $("#septum_nasi").val("<?= $val['septum_nasi']; ?>")
                $("#concae_inferior").val("<?= $val['concae_inferior']; ?>")
                $("#tonsil").val("<?= $val['tonsil']; ?>")
                $("#farinx_posterior_region").val("<?= $val['farinx_posterior_region']; ?>")
                $("#epiglottis").val("<?= $val['epiglottis']; ?>")
                $("#larinx").val("<?= $val['larinx']; ?>")
                $("#vocal_cords").val("<?= $val['vocal_cords']; ?>")
                $("#message_main_attachment_id").val("<?= $val['message_main_attachment_id']; ?>")
                $("#rtj_inpatient_service_needs").val("<?= $val['rtj_inpatient_service_needs']; ?>")
                $("#trial118").val("<?= $val['trial118']; ?>")
                $("input").prop("disabled", true);
                $("textarea").prop("disabled", true);

                // const img = new Image();
                // img.onload = function() {
                //     context_pf_ls_ear.drawImage(img, 0, 0, canvas_pf_ls_ear.width, canvas_pf_ls_ear.height);
                // };
                // img.src = "data:image/png;base64,<?= $val['doctor_name']; ?>";
                // const img1 = new Image();
                // img1.onload = function() {
                //     context1.drawImage(img1, 0, 0, canvas1.width, canvas1.height);
                // };
                // img1.src = "data:image/png;base64,<?= $val['paraf_doctor']; ?>";
            } else {
                $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
                // $("#pasien_diagnosa_id").val("<?= $val['pasien_diagnosa_id']; ?>")
                // $("#diagnosa_id").val("<?= $val['diagnosa_id']; ?>")
                $("#no_registration").val("<?= $visit['no_registration']; ?>")
                $("#visit_id").val("<?= $visit['visit_id']; ?>")
                // $("#bill_id").val("<?= $val['bill_id']; ?>")
                $("#clinic_id").val("<?= $visit['clinic_id']; ?>")
                $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
                $("#in_date").val("<?= $visit['in_date']; ?>")
                $("#exit_date").val("<?= $visit['exit_date']; ?>")
                $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
                <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
                ?>
                $("#examination_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
                $("#employee_id").val("<?= $visit['employee_id']; ?>")
                $("#description").val("<?= $visit['description']; ?>")
                $("#modified_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
                $("#modified_by").val("<?= user()->username; ?>")
                $("#modified_from").val("<?= $visit['clinic_id']; ?>")
                $("#status_pasien_id").val("<?= $visit['status_pasien_id']; ?>")
                $("#ageyear").val("<?= $visit['ageyear']; ?>")
                $("#agemonth").val("<?= $visit['agemonth']; ?>")
                $("#ageday").val("<?= $visit['ageday']; ?>")
                $("#thename").val("<?= $visit['diantar_oleh']; ?>")
                $("#theaddress").val("<?= $visit['visitor_address']; ?>")
                $("#theid").val("<?= $visit['pasien_id']; ?>")
                $("#isrj").val("<?= $visit['isrj']; ?>")
                $("#gender").val("<?= $visit['gender']; ?>")
                $("#doctor").val("<?= $visit['employee_id']; ?>")
                $("#kal_id").val("<?= $visit['kal_id']; ?>")
                $("#petugas_id").val("<?= user()->username; ?>")
                $("#petugas").val("<?= user()->fullname; ?>")
                $("#account_id").val("<?= $visit['account_id']; ?>")
            }
        <?php
        } else { ?>
            $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
            $("#no_registration").val("<?= $visit['no_registration']; ?>")
            $("#visit_id").val("<?= $visit['visit_id']; ?>")
            $("#clinic_id").val("<?= $visit['clinic_id']; ?>")
            $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
            $("#in_date").val("<?= $visit['in_date']; ?>")
            $("#exit_date").val("<?= $visit['exit_date']; ?>")
            $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
            <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
            ?>
            $("#examination_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
            $("#employee_id").val("<?= $visit['employee_id']; ?>")
            $("#description").val("<?= $visit['description']; ?>")
            $("#modified_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
            $("#modified_by").val("<?= user()->username; ?>")
            $("#modified_from").val("<?= $visit['clinic_id']; ?>")
            $("#status_pasien_id").val("<?= $visit['status_pasien_id']; ?>")
            $("#ageyear").val("<?= $visit['ageyear']; ?>")
            $("#agemonth").val("<?= $visit['agemonth']; ?>")
            $("#ageday").val("<?= $visit['ageday']; ?>")
            $("#thename").val("<?= $visit['diantar_oleh']; ?>")
            $("#theaddress").val("<?= $visit['visitor_address']; ?>")
            $("#theid").val("<?= $visit['pasien_id']; ?>")
            $("#isrj").val("<?= $visit['isrj']; ?>")
            $("#gender").val("<?= $visit['gender']; ?>")
            $("#doctor").val("<?= $visit['employee_id']; ?>")
            $("#kal_id").val("<?= $visit['kal_id']; ?>")
            $("#petugas_id").val("<?= user()->username; ?>")
            $("#petugas").val("<?= user()->fullname; ?>")
            $("#account_id").val("<?= $visit['account_id']; ?>")
        <?php } ?>
    })
    $("#btnSimpan").on("click", function() {
        saveSignatureData()
        saveSignatureData1()
        console.log($("#TTD").val())
        $("#form").submit()
    })
    $("#btnEdit").on("click", function() {
        $("input").prop("disabled", false);
        $("textarea").prop("disabled", false);

    })
</script>
<?php $this->endSection() ?>