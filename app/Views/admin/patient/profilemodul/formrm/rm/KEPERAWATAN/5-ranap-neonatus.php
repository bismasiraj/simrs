<?php
$this->extend('admin/patient/profilemodul/formrm/rm/KEPERAWATAN/0-ranap-template.php', [
    'title' => "Asesmen Keperawatan Rawat Inap Pasien Neonatus"
]) ?>
<?php
?>

<?php $this->section('content1') ?>
<div class="row">
    <h4 class="text-start">Apgar Score</h4>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <td style="width: 25%;"></td>
            <td style="width: 25%;">
                <b>1 Menit</b>
            </td>
            <td style="width: 25%;">
                <b>5 Menit</b>
            </td>
            <td style="width: 25%;">
                <b>10 Menit</b>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <b>Denyut Jantung</b>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <b>Pernafasan</b>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <b>Tonus Otot</b>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <b>Peka Rangsang</b>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <b>Warna</b>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <b>Total Skor</b>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>
                <b>Tekanan Darah</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_bp" name="pf_vital_sign_bp" value="">
                    <span class="input-group-text" id="basic-addon2">mmHg</span>
                </div>
            </td>
            <td>
                <b>Denyut Nadi</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_n" name="pf_vital_sign_n" value="">
                    <span class="input-group-text" id="basic-addon2">x/m</span>
                </div>
            </td>
            <td>
                <b>Suhu Tubuh</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_s" name="pf_vital_sign_s" value="">
                    <span class="input-group-text" id="basic-addon2">℃</span>
                </div>
            </td>
            <td>
                <b>Respiration Rate</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_rr" name="pf_vital_sign_rr" value="">
                    <span class="input-group-text" id="basic-addon2">x/m</span>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <b>Berat Badan</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_weight" name="pf_vital_sign_weight" value="">
                    <span class="input-group-text" id="basic-addon2">kg</span>
                </div>
            </td>
            <td>
                <b>Tinggi Badan</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_height" name="pf_vital_sign_height" value="">
                    <span class="input-group-text" id="basic-addon2">cm</span>
                </div>
            </td>
            <td>
                <b>SpO2</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_spo2" name="pf_vital_sign_spo2" value="">
                </div>
            </td>
            <td>
                <b>BMI</b>
                <div class="input-group">
                    <input type="text" class="form-control" id="pf_vital_sign_bmi" name="pf_vital_sign_bmi" value="">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <b>Kesan Umum</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
            <td>
                <b>Pergerakan</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
            <td>
                <b>Warna Kulit</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
            <td>
                <b>Turgor</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td>
                <b>Tonus</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
            <td>
                <b>Suara</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
            <td>
                <b>Reflek Moro</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
            <td>
                <b>Reflek Menghisap</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td>
                <b>Memegang</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
            <td>
                <b>Tonus Leher</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
            <td>
                <b>Lingkar Kepala</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
            <td>
                <b>Lingkar Dada</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
    </tbody>
</table>
<?php $this->endSection() ?>

<?php $this->section('content2') ?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width: 50%;">
                <h4><b>Skala Nyeri</b></h4>
            </td>
            <td>
                <h4><b>Resiko Jatuh</b></h4>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <textarea class="form-control" name="" id=""></textarea>
            </td>
            <td>
                <b>Penjelasan</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td>
                <b>Tipe Resiko Jatuh</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td rowspan="8">
                <div class="row mb-5">
                    <div class="col"></div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <b>Luka Operasi</b>
                        <input type="text" class="form-control" id="sa" name="sa" value="">
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <b>Deskripsi Nyeri</b>
                        <input type="text" class="form-control" id="sa" name="sa" value="">
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <b>Hipo/Hipertermi</b>
                        <input type="text" class="form-control" id="sa" name="sa" value="">
                    </div>
                </div>
            </td>
            <td>
                <b>Usia</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td>
                <b>Jenis Kelamin</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td>
                <b>Diagnosis</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td>
                <b>Gangguan Kognitif</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td>
                <b>Faktor Lingkungan</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td>
                <b>Respon terhadap Pembedahan/Sedasi/Anestesi</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td>
                <b>Respon terhadap penggunaan medikamentosa</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
        <tr>
            <td>
                <b>Humpty Dumpty Score</b>
                <input type="text" class="form-control" id="sa" name="sa" value="">
            </td>
        </tr>
    </tbody>
</table>
<?php $this->endSection() ?>

<?php $this->section('jsContent') ?>
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