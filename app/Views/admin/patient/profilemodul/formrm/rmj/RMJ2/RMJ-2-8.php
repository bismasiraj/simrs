<?php
$this->extend('admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-template.php', [
    'title' => "ASSESMEN MEDIS PASIEN BEDAH"
]) ?>
<?php
?>

<?php $this->section('content') ?>
<table class="table table-bordered mb-2">

    <tr>
        <td rowspan="2" width="40%">
            <p><strong>STATUS INTRA ORAL</strong></p>

            <div class="container">
                <img class="mb-3" src="<?= base_url('uploads/intra_oral.png') ?>" alt="" width="90%">
                <br>
                <img src="<?= base_url('uploads/intra_oral2.png') ?>" alt="" style="width: 90%;">
            </div>
        </td>
        <td>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="V_13">Mukosa bibir, pipi :</label>
                </div>
                <div class="col-6">
                    <input type="text" id="V_13" name="V_13" style="width: 100%;">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="V_14">Dasar mulut :</label>
                </div>
                <div class="col-6">
                    <input type="text" id="V_14" name="V_14" style="width: 100%;">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="V_15">Lidah :</label>
                </div>
                <div class="col-6">
                    <input type="text" id="V_15" name="V_15" style="width: 100%;">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="V_16">Gingiva :</label>
                </div>
                <div class="col-6">
                    <input type="text" id="V_16" name="V_16" style="width: 100%;">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="V_17">Orofaring :</label>
                </div>
                <div class="col-6">
                    <input type="text" id="V_17" name="V_17" style="width: 100%;">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    <label for="V_18">Oklusi :</label>
                </div>
                <div class="col-5">
                    <input type="checkbox" class="form-check-input" id="T_02_normal" name="T_02" value="1">
                    <label for="T_02_normal" class="form-check-label">normal bite</label>
                </div>
                <div class="col-3">
                    <input type="text" id="V_18" name="V_18" style="width: 100%;">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="V_19">Torus palatinus :</label>
                </div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_03_kecil" name="T_03" value="1">
                    <label for="T_03_kecil" class="form-check-label">kecil</label>
                </div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_03_sdg" name="T_03" value="2">
                    <label for="T_03_sdg" class="form-check-label">Sdg</label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6"></div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_03_bsr" name="T_03" value="3">
                    <label for="T_03_bsr" class="form-check-label">Bsr</label>
                </div>
                <div class="col-3">
                    <input type="text" id="V_19" name="V_19" style="width: 100%;">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>Torus mandibularis</label>
                </div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_04_kecil" name="T_04" value="1">
                    <label for="T_04_kecil" class="form-check-label">kecil</label>
                </div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_04_sdg" name="T_04" value="2">
                    <label for="T_0_sdg" class="form-check-label">sdg</label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">

                </div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_04_besar" name="T_04" value="3">
                    <label for="T_04_besar" class="form-check-label">Bsr</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>Palatum :</label>
                </div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_05_dalam" name="T_05" value="1">
                    <label for="T_05_dalam" class="form-check-label">dlm</label>
                </div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_05_sedang" name="T_05" value="2">
                    <label for="T_05_sedang" class="form-check-label">sdg</label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6"></div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_05_rendah" name="T_05" value="3">
                    <label for="T_05_rendah" class="form-check-label">rndh</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="V_20">Super numary :</label>
                </div>
                <div class="col-5">
                    <input type="radio" class="form-check-input" id="T_06_tidak" name="T_06" value="1">
                    <label for="T_06_tidak" class="form-check-label">tdk ada</label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6"></div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_06_ada" name="T_06" value="2">
                    <label for="T_06_ada" class="form-check-label">ada</label>
                </div>
                <div class="col-3">
                    <input type="text" id="V_20" name="V_20" style="width: 100%;">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="V_21">Gigi anomaly :</label>
                </div>
                <div class="col-5">
                    <input type="radio" class="form-check-input" id="T_07_tidak" name="T_07" value="1">
                    <label for="T_07_tidak" class="form-check-label">tdk ada</label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6"></div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_07_ada" name="T_07" value="2">
                    <label for="T_07_ada" class="form-check-label">ada</label>
                </div>
                <div class="col-3">
                    <input type="text" id="V_21" name="V_21" style="width: 100%;">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="V_22">Diastema :</label>
                </div>
                <div class="col-5">
                    <input type="radio" class="form-check-input" id="T_08_tidak" name="T_08" value="1">
                    <label for="T_08_tidak" class="form-check-label">tdk ada</label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6"></div>
                <div class="col-3">
                    <input type="radio" class="form-check-input" id="T_08_ada" name="T_08" value="2">
                    <label for="T_08_ada" class="form-check-label">ada</label>
                </div>
                <div class="col-3">
                    <input type="text" id="V_22" name="V_22" style="width: 100%;">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="V_23">Lain-lain</label>
                </div>
                <div class="col-6">
                    <input type="text" id="V_23" name="V_23" style="width: 100%;">
                </div>
            </div>
        </td>
    </tr>
</table>
<?php $this->endSection() ?>