<div class="row">
    <div class="col-auto" align="center">
        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
    </div>
    <div class="col mt-2" align="center">
        <h3><?= $organization['name_of_org_unit'] ?></h3>
        <p class="mb-1"><?= $organization['contact_address'] ?></p>
        <p>SK No.<?= $organization['sk'] ?></p>
    </div>
    <div class="col-auto" align="center">
        <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
    </div>
</div>

<div class="row">
    <h4 class="text-center"><?= $title; ?></h4>
</div>
<div class="row">
    <h5 class="text-start">Informasi Pasien</h5>
</div>
<?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td class="p-1" style="width:33.3%">
                <b>Nomor RM</b>
                <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
            </td>
            <td class="p-1" style="width:33.3%">
                <b>Nama Pasien</b>
                <p class="m-0 mt-1 p-0"><?= @$visit['name_of_pasien']; ?></p>
            </td>
            <td class="p-1" style="width:33.3%">
                <b>Jenis Kelamin</b>
                <p class="m-0 mt-1 p-0"><?= @$visit['gendername']; ?></p>
            </td>
        </tr>
        <tr>
            <td class="p-1" style="width:33.3%">
                <b>Tanggal Lahir (Usia)</b>
                <p class="m-0 mt-1 p-0"><?= tanggal_indo($visit['date_of_birth']) . ' (' . @$visit['age'] . ')'; ?></p>

            </td>
            <td class="p-1" style="width:66.3%" colspan="2">
                <b>Alamat Pasien</b>
                <p class="m-0 mt-1 p-0"><?= @$visit['visitor_address']; ?></p>
            </td>
        </tr>

        <!-- jika pasien rawat inap -->
        <?php if (!empty($visit['class_room_id'])) : ?>
            <tr>
                <td class="p-1">
                    <b>Kelas</b>
                    <p class="m-0 mt-1 p-0"><?= @$visit['class_id']; ?></p>
                </td>
                <td class="p-1">
                    <b>Bangsal/Kamar</b>
                    <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                </td>
                <td class="p-1">
                    <b>Bed</b>
                    <p class="m-0 mt-1 p-0"><?= @$visit['bed']; ?></p>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>