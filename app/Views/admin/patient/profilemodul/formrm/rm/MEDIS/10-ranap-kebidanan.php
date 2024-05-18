<?php
$this->extend('admin/patient/profilemodul/formrm/rm/MEDIS/0-ranap-template.php', [
    'title' => "Asesmen Medis Kebidanan Rawat Inap"
]) ?>
<?php
?>

<?php $this->section('content1') ?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>
                <b><i>GCS / Tingkat Kesadaran</i></b>
            </td>
        </tr>
        <tr>
            <td>
                <div class="row mb-2">
                    <div class="col-auto">
                        <b>GCS E / Respon Membuka Mata :</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="gcs_e" name="gcs_e" value="<?= $val['gcs_e']; ?>">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-auto">
                        <b>GCS V / Respon Verbal Terbaik :</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="gcs_v" name="gcs_v" value="<?= $val['gcs_v']; ?>">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-auto">
                        <b>GCS M / Respon Motorik Terbaik :</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="gcs_m" name="gcs_m" value="<?= $val['gcs_m']; ?>">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-auto">
                        <b>Score GCS : </b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="gcs" name="gcs" value="<?= $val['gcs']; ?>">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <b>Keadaan Umum</b>
                <input type="text" class="form-control" id="" name="" value="">
            </td>
        </tr>
    </tbody>
</table>
<?php $this->endSection() ?>

<?php $this->section('content_kebidanan') ?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-auto">
                        <b>Kasus Hamil</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 80%;">
                <b>Kasus Obstetri</b>
                <input type="text" class="form-control" id="" name="" value="">
            </td>
            <td>
                <b>Status Ginekologi</b>
                <input type="text" class="form-control" id="" name="" value="">
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width: 50%;">
                <b>Gambar Ovarium</b><br>
                <img class="mt-3" src="<?= base_url('assets/img/asesmen/bidan_kandungan/ovary.png') ?>" width="400px">
            </td>
            <td>
                <b>Gambar Leopoid Obstetric</b>
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
<style>
    @media print {
        @page {
            margin: none;
            scale: 85;
        }

        .container {
            width: 210mm;
            /* Sesuaikan dengan lebar kertas A4 */
        }
    }
</style>
<script type="text/javascript">
    window.print();
</script>
<?php $this->endSection() ?>