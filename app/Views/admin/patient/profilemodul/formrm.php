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
                        <h2 class="accordion-header" id="rm1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapserm1" aria-expanded="true" aria-controls="collapserm3">
                                <b>RM 1</b>
                            </button>
                        </h2>
                        <div id="collapserm1" class="accordion-collapse collapse" aria-labelledby="rm1" data-bs-parent="#accodrionFormRm" style="">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm1/rm1/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 1 RINGKASAN MASUK DAN KELUAR</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm1/rm1_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 1.2 RINGKASAN PULANG</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm1/rm1_2a/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 1.2a PENILAIAN KEBUTUHAN EDUKASI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm1/rm1_2a_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 1.2a-2 TRIASE ANAK</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm1/rm1_2b/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 1.2b PENILAIAN KEBUTUHAN EDUKASI DEWASA</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm1/rm1_2b_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 1.2b-2 TRIASE DEWASA</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm1/rm1_2c/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 1.2c PERENCANAAN PEMULANGAN PASIEN</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="rm2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapserm2" aria-expanded="true" aria-controls="collapserm3">
                                <b>RM 2</b>
                            </button>
                        </h2>
                        <div id="collapserm2" class="accordion-collapse collapse" aria-labelledby="rm2" data-bs-parent="#accodrionFormRm" style="">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_1/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.1 ASESMEN MEDIS PASIEN ANAK</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.2 ASESMEN MEDIS PASIEN KEBIDANAN DAN KANDUNGAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_3/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.3 ASESMEN MEDIS PASIEN PENYAKIT DALAM</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_4/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.4 ASESMEN MEDIS PASIEN BEDAH</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_5/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.5 ASESMEN MEDIS PASIEN THT</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_6/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.6 ASESMEN MEDIS PASIEN SARAF</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_7/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.7 ASESMEN MEDIS PASIEN THT</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_8/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.8 ASESMEN MEDIS PASIEN TERMINAL</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_9/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.9 FORMULIR ASUHAN GIZI ANAK</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_10/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.10 FORMULIR ASUHAN GIZI DEWASA</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_11/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.11 ASESMEN AWAL KEPERAWATAN KRITIS</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_12/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.12 ASESMEN KEBUTUHAN EDUKASI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_13/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.13 ASESMEN ULANG NYERI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_14/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.14 ASESMEN MEDIS PASIEN BEDAH ORTHOPEDI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_15/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.15 ASESMEN AWAL KEPERAWATAN PASIEN NEONATUS RAWAT INAP</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_16/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.16 ASESMEN KHUSUS PENYAKIT MENULAR & IMMUNOSUPRESED</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_17/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.17 ASSESMEN GERIATRI RAWAT INAP</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_18/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.18 ASESMEN PASIEN DENGAN RISIKO MENDAPATKAN KEKERASAN FISIK</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_19/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.19 ASESMEN PASIEN KECANDUAN ALKOHOL ATAU OBAT TERLARANG</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_20/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.20 ASESMEN PASIEN KEMOTERAPI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_21/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.21 ASESMEN MEDIS PASIEN PSIKIATRI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_22/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.22 ASESMEN AWAL MEDIS PASIEN REHABILITASI MEDIK RAWAT INAP</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_23/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.23 ASSESMEN GERIATRI RAWAT INAP</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_1_24/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.1.24 ASESMEN MEDIS PASIEN PENYAKIT PARU</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_2_11/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.2.11 ASESMEN MEDIS PASIEN MATA</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2.2 LAPORAN PERSALINAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm2/rm2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 2 ASESMEN PERAWAT</a></li>
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
                                            <!-- <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3 LEMBAR NADI DAN SUHU</a></li> -->
                                            <!-- <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_1/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.1 MONITORING NYERI</a></li> -->
                                            <!-- <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2 EARLY WARNING SCORING SYSTEM OBSTETRI</a></li> -->
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_1/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.1 DIAGNOSA KELEBIHAN VOLUME CAIRAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.2 DIAGNOSA KETIDAKEFEKTIFAN PERFUSI JARINGAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_3/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.3 DIAGNOSA MOBILITAS FISIK</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_4/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.4 DIAGNOSA PERTUKARAN GAS</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_5/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.5 DIAGNOSA INTOLERANSI AKTIFITAS</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_6/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.6 DIAGNOSA RESIKO INFEKSI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_7/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.7 DIAGNOSA GANGGUAN NYERI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_8/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.8 DIAGNOSA GANGGUAN KERUSAKAN INTEGRITAS KULIT</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_9/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.9 DIAGNOSA GANGGUAN CEMAS</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_10/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.10 DIAGNOSA RESIKO INJURY</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_11/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.11 DIAGNOSA KEBERSIHAN JALAN NAFAS TIDAK EFEKTIF</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_12/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.12 DIAGNOSA KEKURANGAN VOLUME CAIRAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_13/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.13 DIAGNOSA HIPERTERMINA</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_14/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.14 DIAGNOSA GANGGUAN BODY IMAGE</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_15/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.15 DIAGNOSA NUTRISI KURANG DARI KEBUTUHAN TUBUH</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_2_16/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.16 DIAGNOSA NUTRISI KURANG DARI KEBUTUHAN TUBUH</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_3/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.3 EARLY WARNING SCORING SYSTEM (DEWASA)</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm3/rm3_4/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.4 EARLY WARNING SCORING SYSTEM (ANAK)K</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="rm3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapserm3" aria-expanded="true" aria-controls="collapserm3">
                                <b>RM 4</b>
                            </button>
                        </h2>
                        <div id="collapserm4" class="accordion-collapse collapse" aria-labelledby="rm4" data-bs-parent="#accodrionFormRm" style="">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_1/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.1 DIAGNOSA KELEBIHAN VOLUME CAIRAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.2 DIAGNOSA KETIDAKEFEKTIFAN PERFUSI JARINGAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_3/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.3 DIAGNOSA MOBILITAS FISIK</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_4/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.4 DIAGNOSA PERTUKARAN GAS</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_5/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.5 DIAGNOSA INTOLERANSI AKTIFITAS</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_6/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.6 DIAGNOSA RESIKO INFEKSI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_7/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.7 DIAGNOSA GANGGUAN NYERI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_8/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.8 DIAGNOSA GANGGUAN KERUSAKAN INTEGRITAS KULIT</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_9/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.9 DIAGNOSA GANGGUAN CEMAS</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_10/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.10 DIAGNOSA RESIKO INJURY</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_11/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.11 DIAGNOSA KEBERSIHAN JALAN NAFAS TIDAK EFEKTIF</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_12/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.12 DIAGNOSA KEKURANGAN VOLUME CAIRAN</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_13/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.13 DIAGNOSA HIPERTERMINA</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_14/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.14 DIAGNOSA GANGGUAN BODY IMAGE</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_15/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.15 DIAGNOSA NUTRISI KURANG DARI KEBUTUHAN TUBUH</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_2_16/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.2.16 DIAGNOSA NUTRISI KURANG DARI KEBUTUHAN TUBUH</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_3/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.3 EARLY WARNING SCORING SYSTEM (DEWASA)</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/rm4/rm4_4/' . base64_encode(json_encode($visit)); ?>" target="_blank">RM 3.4 EARLY WARNING SCORING SYSTEM (ANAK)K</a></li>
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