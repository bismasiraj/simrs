<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
    table.table-fit {
        width: auto !important;
        table-layout: auto !important;
    }

    table.table-fit thead th,
    table.table-fit tfoot th {
        width: auto !important;
    }

    table.table-fit tbody td,
    table.table-fit tfoot td {
        width: auto !important;
    }
</style>
<div class="tab-pane" id="rm" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-xs-12">
            <div class="row mt-4">

            </div>
            <div class="accordion mt-4">
                <div class="panel-group" id="labBody">
                </div>
            </div>
            <div class="table-responsive">
                <div class="accordion" id="accodrionFormRm">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="rmj2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsermj2" aria-expanded="true" aria-controls="collapsermj2">
                                <b>RMJ 2</b>
                            </button>
                        </h2>
                        <div id="collapsermj2" class="accordion-collapse collapse" aria-labelledby="rmj2" data-bs-parent="#accodrionFormRm" style="">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2 Assesmen Medis Pasien Umum</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_1/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.1 ASSESMEN MEDIS PASIEN RAWAT JALAN ANAK</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.2 ASSESMEN MEDIS PASIEN RAWAT JALAN KANDUNGAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_3/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.3 ASSESMEN MEDIS PASIEN PENYAKIT DALAM</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_4/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.4 ASSESMEN MEDIS PASIEN BEDAH</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_5/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.5 ASSESMEN MEDIS PASIEN KULIT DAN KELAMIN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_6/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.6 ASSESMEN MEDIS PASIEN SARAF</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_7/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.7 ASSESMEN MEDIS PASIEN THT</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_8/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.8 ASSESMEN MEDIS PASIEN GIGI DAN MULUT</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_9/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.9 ASSESMEN MEDIS PASIEN RAWAT JALAN MATA</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_10/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.10 ASESMEN AWAL MEDIS BEDAH ORTHOPEDI RJ</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_11/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.11 ASESMEN RAWAT JALAN GERIATRI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_12/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.12 ASSESMENT IKFR RAWAT JALAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_13/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.13 ASSESMENT PSIKIATRI RAWAT JALAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rmj2_14/' . base64_encode(json_encode($visit)); ?>" target="_blank">RMJ 2.14 ASSESMEN MEDIS PASIEN RAWAT JALAN PENYAKIT PARU</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="rm3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapserm3" aria-expanded="true" aria-controls="collapserm3">
                                <b>RM 3</b>
                            </button>
                        </h2>
                        <div id="collapserm3" class="accordion-collapse collapse" aria-labelledby="rm3" data-bs-parent="#accodrionFormRm" style="">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3 LEMBAR NADI DAN SUHU</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_1/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.1 MONITORING NYERI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2 EARLY WARNING SCORING SYSTEM OBSTETRI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_1/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.1 dx perawat - diagnosa kelebihan volume cairan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.2 dx perawat - diagnosa ketidakefektifan perfusi jaringan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_3/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.3 dx perawat - diagnosa gangguan mobilitas fisik</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_4/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.4 dx perawat - diagnosa gangguan pertukaran gas</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_5/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.5 dx perawat - diagnosa intoleransi aktifitas</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_6/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.6 dx perawat - diagnosa resiko infeksi</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_7/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.7 dx perawat - diagnosa gangguan nyeri</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_8/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.8 dx perawat - diagnosa gangguan kerusakan integritas kulit</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_9/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.9 dx perawat - diagnosa gangguan cemas</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_10/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.10 dx perawat - diagnosa resiko injury</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_11/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.11 dx perawat - diagnosa ketidakbersihan jalan nafas</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_12/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.12 dx perawat - diagnosa kekurangan volume cairan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_13/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.13 dx perawat - diagnosa hipertermia</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_14/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.14 dx perawat - diagnosa gangguan body image</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_15/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.15 dx perawat - diagnosa gangguan nutrisi kurang dari kebutuhan tubuh</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_2_16/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.16 dx perawat - diagnosa defisit perawatan dini</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_3/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.3 EARLY WARNING SCORING SYSTEM DEWASA</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rekammedis/rm3_4/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.3 EARLY WARNING SCORING SYSTEM ANAK</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--./row-->
</div>
<!-- -->