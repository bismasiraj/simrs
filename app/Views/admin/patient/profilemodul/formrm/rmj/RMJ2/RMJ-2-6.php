<?php
$this->extend('admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-template.php', [
    'title' => "ASSESMEN MEDIS PASIEN BEDAH"
]) ?>
<?php
?>
<?php $this->section('content') ?>
<table class="table table-bordered mb-0">
    <tbody>
        <tr>
            <td>
                <div class="mb-3">
                    <div class="col-md-4">
                        <div class="row text-align">
                            <div class="col-md-4">
                                <label for="">1. Cranium</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="pf_cranium" name="pf_cranium" style="width: 900px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col-md-4">
                        <div class="row text-align">
                            <div class="col-md-4">
                                <label for="">2. Leher</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="pf_neck" name="pf_neck" style="width: 900px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col-md-4">
                        <div class="row text-align">
                            <div class="col-md-4">
                                <label for="">3. Thorax</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="pf_thorax" name="pf_thorax" style="width: 900px">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-md-4">
                        <div class="row text-align">
                            <div class="col-md-4">
                                <label for="">4. Abdomen</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="pf_abdomen" name="pf_abdomen" style="width: 900px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col-md-4">
                        <div class="row text-align">
                            <div class="col-md-4">
                                <label for="">5. Genitalia</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="pf_genitalia" name="pf_genitalia" style="width: 900px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>6. Extremitas</label>
                </div>
                <div class="mb-3">
                    <div class="col-md-6">
                        <div class="row text-align">
                            <div class="col-md-4">
                                <label for="">a. Extremitas Atas</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="pf_upper_extremity" name="pf_upper_extremity" style="width: 850px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col-md-6">
                        <div class="row text-align">
                            <div class="col-md-4">
                                <label for="">b. Extremitas Bawah</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="pf_lower_extremity" name="pf_lower_extremity" style="width: 850px">
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div><label><b>Pemeriksaan Neurologis :</b></label></div>
                <div>Kondisi Umum :<input class="form-control" type="text" id="general_condition" name="general_condition"></div>
                <div>GCS :<input class="form-control" type="text" id="gcs" name="gcs"></div>
                <div>VAS / NRS :<input class="form-control" type="text" id="vas_nrs" name="vas_nrs"></div>
            </td>
        </tr>


        <tr>
            <td>
                <div class="mb-3">
                    <label>Kepala </label>
                </div>
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Pupil Kiri</th>
                            <th>Pupil Kanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Diameter:</td>
                            <td><input type="text" class="form-control" id="left_diameter" name="left_diameter"></td>
                            <td><input type="text" class="form-control" id="right_diameter" name="right_diameter"></td>
                        </tr>
                        <tr>
                            <td>Refleks Cahaya:</td>
                            <td><input type="text" class="form-control" id="left_light_reflex" name="left_light_reflex"></td>
                            <td><input type="text" class="form-control" id="right_light_reflex" name="right_light_reflex"></td>
                        </tr>
                        <tr>
                            <td>Kornea:</td>
                            <td><input type="text" class="form-control" id="left_cornea" name="left_cornea"></td>
                            <td><input type="text" class="form-control" id="right_cornea" name="right_cornea"></td>
                        </tr>
                        <tr>
                            <td>Isokor Anisokor:</td>
                            <td><input type="text" class="form-control" name="left_isokor_anisokor" id="left_isokor_anisokor"></td>
                            <td><input type="text" class="form-control" name="right_isokor_anisokor" id="right_isokor_anisokor"></td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label>
                                <h5>Leher </h5>
                            </label>
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td>Kaku kuduk</td>
                                        <td><input type="text" class="form-control" id="stiff_neck" name="stiff_neck"></td>
                                    </tr>
                                    <tr>
                                        <td>Meninggal sign</td>
                                        <td><input type="text" class="form-control" id="meningeal_sign" name="meningeal_sign"></td>
                                    </tr>
                                    <tr>
                                        <td>Brudzinki I-IV</td>
                                        <td><input type="text" class="form-control" id="brudzinki_i_iv" name="brudzinki_i_iv"></td>
                                    </tr>
                                    <tr>
                                        <td>Kernig sign</td>
                                        <td><input type="text" class="form-control" id="kernig_sign" name="kernig_sign"></td>
                                    </tr>
                                    <tr>
                                        <td>Doll’s eye phenomena</td>
                                        <td><input type="text" class="form-control" id="dolls_eye_phenomenon" name="dolls_eye_phenomenon"></td>
                                    </tr>
                                    <tr>
                                        <td>Vertebra</td>
                                        <td><input type="text" class="form-control" id="vertebra" name="vertebra"></td>
                                    </tr>
                                    <tr>
                                        <td>Extremitas</td>
                                        <td><input type="text" class="form-control" id="extremity" name="extremity"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <label>
                                <h5>Gerak </h5>
                            </label>
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td>Gerak Atas Kiri</td>
                                        <td><input type="text" class="form-control" id="motion_upper_left" name="motion_upper_left"></td>
                                    </tr>
                                    <tr>
                                        <td>Gerak Atas Kanan</td>
                                        <td><input type="text" class="form-control" id="motion_upper_right" name="motion_upper_right"></td>
                                    </tr>
                                    <tr>
                                        <td>Gerak Bawah Kiri</td>
                                        <td><input type="text" class="form-control" id="motion_lower_left" name="motion_lower_left"></td>
                                    </tr>
                                    <tr>
                                        <td>Gerak Bawah Kanan</td>
                                        <td><input type="text" class="form-control" id="motion_lower_right" name="motion_lower_right"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <label>
                                <h5>Kekuatan </h5>
                            </label>
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td>Kekuatan Atas Kiri</td>
                                        <td><input type="text" class="form-control" id="strength_upper_left" name="strength_upper_left"></td>
                                    </tr>
                                    <tr>
                                        <td>Kekuatan Atas Kanan</td>
                                        <td><input type="text" class="form-control" id="strength_upper_right" name="strength_upper_right"></td>
                                    </tr>
                                    <tr>
                                        <td>Kekuatan Bawah Kiri</td>
                                        <td><input type="text" class="form-control" id="strength_lower_left" name="strength_lower_left"></td>
                                    </tr>
                                    <tr>
                                        <td>Kekuatan Bawah Kanan</td>
                                        <td><input type="text" class="form-control" id="strength_lower_right" name="strength_lower_right"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>
                                <h5>Reflek Fisiologi </h5>
                            </label>
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td>Reflek Fisiologi Atas Kiri</td>
                                        <td><input type="text" class="form-control" id="physiological_reflex_upper_left" name="physiological_reflex_upper_left"></td>
                                    </tr>
                                    <tr>
                                        <td>Reflek Fisiologi Atas Kanan</td>
                                        <td><input type="text" class="form-control" id="physiological_reflex_upper_right" name="physiological_reflex_upper_right"></td>
                                    </tr>
                                    <tr>
                                        <td>Reflek Fisiologi Bawah Kiri</td>
                                        <td><input type="text" class="form-control" id="physiological_reflex_lower_left" name="physiological_reflex_lower_left"></td>
                                    </tr>
                                    <tr>
                                        <td>Reflek Fisiologi Bawah Kanan</td>
                                        <td><input type="text" class="form-control" id="physiological_reflex_lower_right" name="physiological_reflex_lower_right"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <label>
                                <h5>Reflek Patologis </h5>
                            </label>
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td>Reflek Patologis Atas Kiri</td>
                                        <td><input type="text" class="form-control" id="pathologycal_reflex_upper_left" name="pathologycal_reflex_upper_left"></td>
                                    </tr>
                                    <tr>
                                        <td>Reflek Patologis Atas Kanan</td>
                                        <td><input type="text" class="form-control" id="pathologycal_reflex_upper_right" name="pathologycal_reflex_upper_right"></td>
                                    </tr>
                                    <tr>
                                        <td>Reflek Patologis Bawah Kiri</td>
                                        <td><input type="text" class="form-control" id="pathologycal_reflex_lower_left" name="pathologycal_reflex_lower_left"></td>
                                    </tr>
                                    <tr>
                                        <td>Reflek Patologis Bawah Kanan</td>
                                        <td><input type="text" class="form-control" id="pathologycal_reflex_lower_right" name="pathologycal_reflex_lower_right"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <label>
                                <h5>Clonus/Sensibilitas </h5>
                            </label>
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td>Reflek Patologis Atas Kiri</td>
                                        <td><input type="text" class="form-control" id="clonus" name="clonus"></td>
                                    </tr>
                                    <tr>
                                        <td>Reflek Patologis Atas Kanan</td>
                                        <td><input type="text" class="form-control" id="sensibility" name="sensibility"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
            </td>
    </tbody>
</table>

<?php $this->endSection() ?>
<?php $this->section('jsContent') ?>
<script>
    var canvas = document.getElementById('canvas');
    const canvasDataInput = document.getElementById('ttd');
    var context = canvas.getContext('2d');
    var drawing = false;

    // Load the background image onto the canvas
    const backgroundImage = new Image();




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
                $("#general_condition").val("<?= $val['general_condition']; ?>")
                $("#gcs").val("<?= $val['gcs']; ?>")
                $("#vas_nrs").val("<?= $val['vas_nrs']; ?>")
                $("#left_diameter").val("<?= $val['left_diameter']; ?>")
                $("#left_light_reflex").val("<?= $val['left_light_reflex']; ?>")
                $("#left_cornea").val("<?= $val['left_cornea']; ?>")
                $("#left_isokor_anisokor").val("<?= $val['left_isokor_anisokor']; ?>")
                $("#right_diameter").val("<?= $val['right_diameter']; ?>")
                $("#right_light_reflex").val("<?= $val['right_light_reflex']; ?>")
                $("#right_cornea").val("<?= $val['right_cornea']; ?>")
                $("#right_isokor_anisokor").val("<?= $val['right_isokor_anisokor']; ?>")
                $("#stiff_neck").val("<?= $val['stiff_neck']; ?>")
                $("#meningeal_sign").val("<?= $val['meningeal_sign']; ?>")
                $("#brudzinki_i_iv").val("<?= $val['brudzinki_i_iv']; ?>")
                $("#kernig_sign").val("<?= $val['kernig_sign']; ?>")
                $("#dolls_eye_phenomenon").val("<?= $val['dolls_eye_phenomenon']; ?>")
                $("#vertebra").val("<?= $val['vertebra']; ?>")
                $("#extremity").val("<?= $val['extremity']; ?>")
                $("#motion_upper_left").val("<?= $val['motion_upper_left']; ?>")
                $("#motion_upper_right").val("<?= $val['motion_upper_right']; ?>")
                $("#motion_lower_left").val("<?= $val['motion_lower_left']; ?>")
                $("#motion_lower_right").val("<?= $val['motion_lower_right']; ?>")
                $("#strength_upper_left").val("<?= $val['strength_upper_left']; ?>")
                $("#strength_upper_right").val("<?= $val['strength_upper_right']; ?>")
                $("#strength_lower_left").val("<?= $val['strength_lower_left']; ?>")
                $("#strength_lower_right").val("<?= $val['strength_lower_right']; ?>")
                $("#physiological_reflex_upper_left").val("<?= $val['physiological_reflex_upper_left']; ?>")
                $("#physiological_reflex_upper_right").val("<?= $val['physiological_reflex_upper_right']; ?>")
                $("#physiological_reflex_lower_left").val("<?= $val['physiological_reflex_lower_left']; ?>")
                $("#physiological_reflex_lower_right").val("<?= $val['physiological_reflex_lower_right']; ?>")
                $("#pathologycal_reflex_upper_left").val("<?= $val['pathologycal_reflex_upper_left']; ?>")
                $("#pathologycal_reflex_upper_right").val("<?= $val['pathologycal_reflex_upper_right']; ?>")
                $("#pathologycal_reflex_lower_left").val("<?= $val['pathologycal_reflex_lower_left']; ?>")
                $("#pathologycal_reflex_lower_right").val("<?= $val['pathologycal_reflex_lower_right']; ?>")
                $("#clonus").val("<?= $val['clonus']; ?>")
                $("#sensibility").val("<?= $val['sensibility']; ?>")
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
                $("#standing_order").val("<?= $val['standing_order']; ?>")
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
                $("#note_subjective").val("<?= $val['note_subjective']; ?>")
                $("#note_objective").val("<?= $val['note_objective']; ?>")
                $("#note_obat_confirmed").append("<?= $val['note_obat_confirmed']; ?>")
                $("#note_lab_confirmed").append("<?= $val['note_lab_confirmed']; ?>")
                $("#note_rad_confirmed").append("<?= $val['note_rad_confirmed']; ?>")
                $("#note_phy_confirmed").append("<?= $val['note_phy_confirmed']; ?>")
                $("#note_proc_confirmed").append("<?= $val['note_proc_confirmed']; ?>")
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
                $("#clinical_indication").val("<?= $val['clinical_indication']; ?>")
                $("#target_of_therapy").val("<?= $val['target_of_therapy']; ?>")
                $("#rtj_out_instruction").val("<?= $val['rtj_out_instruction']; ?>")
                $("#set_all_dbn").val("<?= $val['set_all_dbn']; ?>")
                $("#education_material").val("<?= $val['education_material']; ?>")
                $("#message_main_attachment_id").val("<?= $val['message_main_attachment_id']; ?>")
                $("#rtj_inpatient_service_needs").val("<?= $val['rtj_inpatient_service_needs']; ?>")
                $("#trial194").val("<?= $val['trial194']; ?>")
                $("input").prop("disabled", true);
                $("textarea").prop("disabled", true);

                const img = new Image();
                img.onload = function() {
                    context.drawImage(img, 0, 0, canvas.width, canvas.height);
                };
                img.src = "data:image/jpeg;base64,<?= $val['doctor_name']; ?>";
                const img1 = new Image();
                img1.onload = function() {
                    context1.drawImage(img1, 0, 0, canvas1.width, canvas1.height);
                };
                img1.src = "data:image/png;base64,<?= $val['target_of_therapy']; ?>";
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