<?php
$this->extend('admin/patient/profilemodul/formrm/rm/MEDIS/0-ranap-template.php', [
    'title' => "Asesmen Medis Paru Rawat Inap"
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

<?php $this->section('content2') ?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>
                <b>Kepala</b>
                <input type="text" class="form-control" id="pf_kepala" name="pf_kepala" value="<?= $val['pf_kepala']; ?>">
            </td>
            <td>
                <b>Mata</b>
                <input type="text" class="form-control" id="pf_mata" name="pf_mata" value="<?= $val['pf_mata']; ?>">
            </td>
        </tr>
        <tr>
            <td>
                <b>Hidung</b>
                <input type="text" class="form-control" id="pf_hidung" name="pf_hidung" value="<?= $val['pf_hidung']; ?>">
            </td>
            <td>
                <b>Telinga</b>
                <input type="text" class="form-control" id="pf_telinga" name="pf_telinga" value="<?= $val['pf_telinga']; ?>">
            </td>
        </tr>
        <tr>
            <td>
                <b>Mulut</b>
                <input type="text" class="form-control" id="pf_mulut" name="pf_mulut" value="<?= $val['pf_mulut']; ?>">
            </td>
            <td>
                <b>Gigi</b>
                <input type="text" class="form-control" id="pf_gigi" name="pf_gigi" value="<?= $val['pf_gigi']; ?>">
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>
                <b>Leher</b>
                <input type="text" class="form-control" id="pf_leher" name="pf_leher" value="<?= $val['pf_leher']; ?>">
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width:50%;">
                <b>Thorax</b>
                <input type="text" class="form-control" id="pf_thorax" name="pf_thorax" value="<?= $val['pf_thorax']; ?>">
            </td>
            <td rowspan="3">
                <img class="mt-3" src="<?= base_url('assets/img/asesmen/paru/thorax.png') ?>" width="400px">
            </td>
        </tr>
        <tr>
            <td>
                <b>Jantung</b>
                <input type="text" class="form-control" id="pf_jantung" name="pf_jantung" value="<?= $val['pf_jantung']; ?>">
            </td>
        </tr>
        <tr>
            <td>
                <b>Paru-paru</b>
                <input type="text" class="form-control" id="pf_paru" name="pf_paru" value="<?= $val['pf_paru']; ?>">
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width:50%;">
                <b>Abdomen</b>
                <input type="text" class="form-control" id="pf_perut" name="pf_perut" value="<?= $val['pf_perut']; ?>">
            </td>
            <td rowspan="4">
                <img class="mt-3" src="<?= base_url('assets/img/asesmen/paru/abdomen.png') ?>" width="400px">
            </td>
        </tr>
        <tr>
            <td>
                <b>Hepar</b>
                <input type="text" class="form-control" id="pf_hepar" name="pf_hepar" value="<?= $val['pf_hepar']; ?>">
            </td>
        </tr>
        <tr>
            <td>
                <b>Lien</b>
                <input type="text" class="form-control" id="pf_lien" name="pf_lien" value="<?= $val['pf_lien']; ?>">
            </td>
        </tr>
        <tr>
            <td>
                <b>Ginjal</b>
                <input type="text" class="form-control" id="pf_ginjal" name="pf_ginjal" value="<?= $val['pf_ginjal']; ?>">
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td rowspan="2">
                <b>Genitalia</b>
                <input type="text" class="form-control" id="pf_genitais" name="pf_genitais" value="<?= $val['pf_genitais']; ?>">
            </td>
            <td>
                <b>Ekstremitas Atas</b>
                <input type="text" class="form-control" id="pf_ekstermitas_atas" name="pf_ekstermitas_atas" value="<?= $val['pf_ekstermitas_atas']; ?>">
            </td>
        </tr>
        <tr>
            <td>
                <b>Ekstremitas Bawah</b>
                <input type="text" class="form-control" id="pf_extermintas_bawah" name="pf_extermintas_bawah" value="<?= $val['pf_extermintas_bawah']; ?>">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-auto">
                        <b>Catatan Obyektif</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php $this->endSection() ?>

<?php $this->section('content_paru') ?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-auto">
                        <b>Riwayat Obat Anti Tuberkolosis (OAT)</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-auto">
                        <b>Mulai Terapi</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-auto">
                        <b>Lama Terapi</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-auto">
                        <b>Riwayat bepergian ke luar negeri</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-auto">
                        <b>Kapan</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-auto">
                        <b>Riwayat kontak dengan unggas mati</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-auto">
                        <b>Kapan</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-auto">
                        <b>Pemeriksaan fisik paru</b>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" name="" value="">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%;">
                <b>Gambar Paru</b>
            </td>
            <td>
                <img class="mt-3" src="<?= base_url('assets/img/asesmen/paru/thorax.png') ?>" width="400px">
            </td>
        </tr>
    </tbody>
</table>
<?php $this->endSection() ?>