<!-- <div class="d-flex mb-4">
    <div class="col-4 text-center">
        <h5 class="mb-0"><?= $kop['name_of_org_unit']; ?></h5>
        <h5><?= $kop['kota']; ?></h5>
        <img class="mt-2 mx-auto" src="<?= base_url('assets/img/logo.png') ?>" style="width: 110px; height: 110px;">
    </div>

    <div class="col-8">
        <div class=" border border-1 d-flex justify-content-center align-items-center"
            style="width:100%; height: 100%;">
            <h5><?= $heading; ?></h5>
        </div>
    </div>
</div> -->


<div class="row mb-3">
    <div class="col-2 d-flex">
        <img class="mt-2 mx-auto" src="<?= base_url('assets/img/logo.png') ?>" style="width: 110px; height: 110px;">
    </div>
    <div class="col-10">
        <h3 class="text-center mb-3"><?= $heading; ?></h3>
        <h5><?= @$kop['name_of_org_unit'] ?></h5>
        <!-- <h3>Surakarta</h3> -->
        <p class="mb-0"><?= @$kop['contact_address'] ?>, <?= @$kop['phone']; ?>, Fax: <?= @$kop['fax']; ?>,
            <?= @$kop['kota']; ?></p>
        <p><?= @$kop['sk']; ?></p>
    </div>
</div>