<div class="row mb-5">
    <div class="col-2 d-flex">
        <img class="mt-2 mx-auto" src="<?= base_url('assets/img/logo.png') ?>" style="width: 110px; height: 110px;">
    </div>
    <div class="col-6">
        <h3><?= @$kop['name_of_org_unit'] ?></h3>
        <h5><?= strtoupper(@$kop['kota']) ?></h5>
        <b><?= @$kop['contact_address'] ?></b>
        <br>
        <b><?= 'Telp ' . @$kop['phone'] . ' Fax: ' . @$kop['fax'] ?></b>
    </div>
    <div class="col-4">
        <div class="border border-1 d-flex justify-content-center align-items-center" style="height: 100px;">
            <span>Label Identitas Pasien</span>
        </div>
    </div>
</div>