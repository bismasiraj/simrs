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
                <input type="text" class="form-control" name="" value="">
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
                        <input type="text" class="form-control" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 80%;">
                <b>Kasus Obstetri</b>
                <input type="text" class="form-control" name="" value="">
            </td>
            <td>
                <b>Status Ginekologi</b>
                <input type="text" class="form-control" name="" value="">
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