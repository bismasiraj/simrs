<?php
$this->extend('admin/patient/profilemodul/formrm/rm/KEPERAWATAN/0-ralan-template.php', [
    'title' => "Asesmen Keperawatan Rawat Jalan Pasien Anak"
]) ?>
<?php
?>

<?php $this->section('content') ?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>
                <b>Tekanan Darah</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_bp" name="pf_vital_sign_bp" value="<?= $val['tension_upper']; ?> / <?= $val['tension_below']; ?>">
                    <span class="input-group-text" id="basic-addon2">mmHg</span>
                </div>
            </td>
            <td>
                <b>Denyut Nadi</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_n" name="pf_vital_sign_n" value="<?= $val['nadi']; ?>">
                    <span class="input-group-text" id="basic-addon2">x/m</span>
                </div>
            </td>
            <td>
                <b>Suhu Tubuh</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_s" name="pf_vital_sign_s" value="<?= $val['temperature']; ?>">
                    <span class="input-group-text" id="basic-addon2">℃</span>
                </div>
            </td>
            <td>
                <b>Respiration Rate</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_rr" name="pf_vital_sign_rr" value="<?= $val['respiration']; ?>">
                    <span class="input-group-text" id="basic-addon2">x/m</span>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <b>Berat Badan</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_weight" name="pf_vital_sign_weight" value="<?= $val['weight']; ?>">
                    <span class="input-group-text" id="basic-addon2">kg</span>
                </div>
            </td>
            <td>
                <b>Tinggi Badan</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_height" name="pf_vital_sign_height" value="<?= $val['height']; ?>">
                    <span class="input-group-text" id="basic-addon2">cm</span>
                </div>
            </td>
            <td>
                <b>SpO2</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_spo2" name="pf_vital_sign_spo2" value="<?= $val['nafas']; ?>">
                </div>
            </td>
            <td>
                <b>BMI</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_bmi" name="pf_vital_sign_bmi" value="<?= $val['bmi']; ?>">
                </div>
            </td>
        </tr>
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
    $(document).ready(function() {
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