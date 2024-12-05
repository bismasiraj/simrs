<div class="row mb-3">
    <div class="col-2 d-flex">
        <img class="mt-2 mx-auto" src="<?= base_url('assets/img/logo.png') ?>" style="width: 110px; height: 110px;">
    </div>
    <div class="col-10 text-center">
        <h3><?= @$kop['name_of_org_unit'] ?></h3>
        <h5><?= strtoupper(@$kop['kota']) ?></h5>
        <b><?= @$kop['contact_address'] ?></b>
        <br>
        <b><?= 'Telp ' . @$kop['phone'] . ' Fax: ' . @$kop['fax'] ?></b>
    </div>
</div>
<div class="border border-2 border-dark mb-3"></div>