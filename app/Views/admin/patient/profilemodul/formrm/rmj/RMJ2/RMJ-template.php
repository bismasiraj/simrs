<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

</head>

<body>
    <div class="container-fluid mt-5">
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post" autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>

            <input type="hidden" name="body_id" id="body_id">
            <input type="hidden" name="org_unit_code" id="org_unit_code">
            <input type="hidden" name="pasien_diagnosa_id" id="pasien_diagnosa_id">
            <input type="hidden" name="diagnosa_id" id="diagnosa_id">
            <input type="hidden" name="visit_id" id="visit_id">
            <input type="hidden" name="bill_id" id="bill_id">
            <input type="hidden" name="class_room_id" id="class_room_id">
            <input type="hidden" name="in_date" id="in_date">
            <input type="hidden" name="exit_date" id="exit_date">
            <input type="hidden" name="keluar_id" id="keluar_id">
            <!-- <input type="hidden" name="examination_date" id="examination_date"> -->
            <input type="hidden" name="employee_id" id="employee_id">
            <input type="hidden" name="description" id="description">
            <input type="hidden" name="modified_date" id="modified_date">
            <input type="hidden" name="modified_by" id="modified_by">
            <input type="hidden" name="modified_from" id="modified_from">
            <input type="hidden" name="status_pasien_id" id="status_pasien_id">
            <input type="hidden" name="ageyear" id="ageyear">
            <input type="hidden" name="agemonth" id="agemonth">
            <input type="hidden" name="ageday" id="ageday">
            <input type="hidden" name="theid" id="theid">
            <input type="hidden" name="isrj" id="isrj">
            <input type="hidden" name="gender" id="gender">
            <input type="hidden" name="kal_id" id="kal_id">
            <input type="hidden" name="petugas_id" id="petugas_id">
            <input type="hidden" name="petugas" id="petugas">
            <input type="hidden" name="account_id" id="account_id">
            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-md-3" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col-md-6 mt-2" align="center">
                    <h2>RS. PKU MUHAMMADIYAH SAMPANGAN</h2>
                    <h2>Surakarta</h2>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta <br> Telp 0271-633894 Fax. : 0271-630229 <br> Jawa Tengah 57117</p>
                </div>
                <div class="col-md-3" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><?= $title; ?></h4>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <input type="text" class="form-control" id="no_registration" name="no_registration">
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <input type="text" class="form-control" id="thename" name="thename">
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <select name="gender" id="gender" class="form-control">
                                <option value="1">Laki-Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <input type="text" class="form-control" id="patient_age" name="patient_age">
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <input type="text" class="form-control" id="theaddress" name="theaddress">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <input type="text" class="form-control" id="doctor" name="doctor">
                        </td>
                        <td>
                            <b>Department</b>
                            <input type="text" class="form-control" id="clinic_id" name="clinic_id">
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Subjektif (S)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Keluhan Utama (Autoanamnesis)</b>
                            <input type="text" class="form-control" id="ana_main_complaint" name="ana_main_complaint">
                        </td>
                        <td>
                            <b>Riwayat Penyakit Sekarang</b>
                            <input type="text" class="form-control" id="ana_auto_current_disease_history" name="ana_auto_current_disease_history">
                        </td>
                        <td>
                            <b>Riwayat Penyakit Dahulu</b>
                            <input type="text" class="form-control" id="ana_past_disease_history" name="ana_past_disease_history">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Riwayat Penyakit Keluarga</b>
                            <input type="text" class="form-control" id="ana_family_disease_history" name="ana_family_disease_history">
                        </td>
                        <td>
                            <b>Riwayat Alergi (Non Obat)</b>
                            <input type="text" class="form-control" id="ana_allergy_history_non_drugs" name="ana_allergy_history_non_drugs">
                            <b>Riwayat Alergi (Obat)</b>
                            <input type="text" class="form-control" id="ana_allergy_history_drugs" name="ana_allergy_history_drugs">

                        </td>
                        <td>
                            <b>Riwayat Obat Yang Dikonsumsi</b>
                            <input type="text" class="form-control" id="ana_drugs_consumed" name="ana_drugs_consumed">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Riwayat Kehamilan dan Persalinan</b>
                            <input type="text" class="form-control" id="ana_pregnancy_childbirth_history" name="ana_pregnancy_childbirth_history">
                        </td>
                        <td>
                            <b>Riwayat Diet</b>
                            <input type="text" class="form-control" id="ana_diet_history" name="ana_diet_history">
                        </td>
                        <td>
                            <b>Riwayat Imunisasi</b>
                            <input type="text" class="form-control" id="ana_imun_history" name="ana_imun_history">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Riwayat Kebiasaan (Negatif)</b>
                            <input type="text" class="form-control" id="ana_drugs_consumed" name="ana_drugs_consumed">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Obyektif (O)</h4>
            </div>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td colspan="4"><b>Vital Sign</b></td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tekanan Darah</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_bp" name="pf_vital_sign_bp">
                                <span class="input-group-text" id="basic-addon2">mmHg</span>
                            </div>
                        </td>
                        <td>
                            <b>Denyut Nadi</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_n" name="pf_vital_sign_n">
                                <span class="input-group-text" id="basic-addon2">x/m</span>
                            </div>
                        </td>
                        <td>
                            <b>Suhu Tubuh</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_s" name="pf_vital_sign_s">
                                <span class="input-group-text" id="basic-addon2">℃</span>
                            </div>
                        </td>
                        <td>
                            <b>Respiration Rate</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_rr" name="pf_vital_sign_rr">
                                <span class="input-group-text" id="basic-addon2">x/m</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Berat Badan</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_weight" name="pf_vital_sign_weight">
                                <span class="input-group-text" id="basic-addon2">x/m</span>
                            </div>
                        </td>
                        <td>
                            <b>Tinggi Badan</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_height" name="pf_vital_sign_height">
                                <span class="input-group-text" id="basic-addon2">cm</span>
                            </div>
                        </td>
                        <td>
                            <b>SpO2</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_spo2" name="pf_vital_sign_spo2">
                            </div>
                        </td>
                        <td>
                            <b>BMI</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_bmi" name="pf_vital_sign_bmi">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>GCS / Tingkat Kesadaran</b>
                            <input type="text" class="form-control" id="pf_gcs_type" name="pf_gcs_type">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Score GCS</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Keadaan Umum</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Skala Nyeri</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                        <td>
                            <b>Resiko Jatuh</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php $this->renderSection('content'); ?>
            <div class="row">
                <h4 class="text-start">Assessment (A)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Diagnosis (ICD-10)</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Permasalahan Medis</b>
                            <input type="text" class="form-control" id="medical_problem" name="medical_problem">
                        </td>
                        <td>
                            <b>Permasalahan Keperawatan</b>
                            <input type="text" class="form-control" id="medical_problem" name="medical_problem">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Penyebab Cidera / Keracunan</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Planning (P)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Target / Sarana Terapi</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Pemeriksaan Diagnostik Penunjang</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Laboratorium</b>
                            <div type="text" class="form-control" id="note_lab_confirmed" name="note_lab_confirmed"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Radiologi</b>
                            <div type="text" class="form-control" id="note_rad_confirmed" name="note_rad_confirmed"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Farmatologi</b>
                            <div type="text" class="form-control" id="note_obat_confirmed" name="note_obat_confirmed">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Procedure</b>
                            <div type="text" class="form-control" id="note_phy_confirmed" name="note_phy_confirmed">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Catatan Procedure</b>
                            <div type="text" class="form-control" id="note_proc_confirmed" name="note_proc_confirmed">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Standing Order</b>
                            <div type="text" class="form-control" id="standing_order" name="standing_order">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Rencana Tindak Lanjut</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Rencana Tindak Lanjut</b>
                            <select type="text" class="form-control" id="follow_up_plan" name="follow_up_plan">
                                <option value="rawat jalan">Rawat Jalan</option>
                                <option value="rawat inap">Rawat Inap</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Jenis Tindak Lanjut</b>
                            <input type="text" class="form-control" id="follow_up_plan" name="follow_up_plan">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Edukasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><b>Subjek Edukasi</b>
                            <select type="text" class="form-control" id="patient_edication" name="patient_edication">
                                <option value="pasien">Pasien</option>
                                <option value="keluarga pasien">Keluarga Pasien</option>
                                <option value="tidak dapat memberi edukasi kepada pasien atau keluarga">Tidak dapat memberi edukasi kepada pasien atau keluarga</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                    <div style="text-align: center;">Dokter</div>

                    <div class="mb-1" style="text-align: center;">
                        <canvas id="canvas" width="550" height="150" style="border:1px solid #000;"></canvas>
                        <input type="hidden" name="ttd" id="ttd">
                        <br>(<input type="text" name="v_68" id="v_68">)
                    </div>
                </div>


                <div class="col-6">
                    <div style="text-align: center;">Penerima Penjelasan</div>

                    <div class="mb-1" style="text-align: center;">
                        <canvas id="canvas1" width="550" height="150" style="border:1px solid #000;"></canvas>
                        <input type="hidden" name="ttd_1" id="ttd_1">
                        <br>(<input type="text" name="v_69" id="v_69">)
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

<script>
    var canvas = document.getElementById('canvas');
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
<?php $this->renderSection('jsContent'); ?>

</html>