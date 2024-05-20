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
                        <div id="collapsermj2" class="accordion-collapse collapse" aria-labelledby="rmj2" data-bs-parent="#accodrionFormRm">
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
                        <div id="collapserm1" class="accordion-collapse collapse" aria-labelledby="rm1" data-bs-parent="#accodrionFormRm">
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
                        <div id="collapserm2" class="accordion-collapse collapse" aria-labelledby="rm2" data-bs-parent="#accodrionFormRm">
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
                        <div id="collapserm3" class="accordion-collapse collapse" aria-labelledby="rm3" data-bs-parent="#accodrionFormRm">
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
                        <div id="collapserm4" class="accordion-collapse collapse" aria-labelledby="rm4" data-bs-parent="#accodrionFormRm">
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
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="medis">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsemedis" aria-expanded="true" aria-controls="collapsemedis">
                                <b>MEDIS</b>
                            </button>
                        </h2>
                        <div id="collapsemedis" class="accordion-collapse collapse" aria-labelledby="medis" data-bs-parent="#accodrionFormRm">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul id="medisListLink" class="list-group list-group-flush">
                                            <input id="armpasien_diagnosa_id" type="hidden" value="asdf">
                                            <!-- <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_anak/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Anak</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_bedah/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Bedah</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_dalam/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Dalam</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_kebidanan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Kebidanan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_kulit_kelamin/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Kulit Kelamin</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_mata/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Mata</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_tht/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan THT</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_anak/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ranap Anak</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_dalam/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ranap Dalam</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_kebidanan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ranap Kebidanan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_neonatal/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ranap Neonatal</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_paru/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ranap Paru</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/rawat_inap/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Rawat Inap</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/profile/' . base64_encode(json_encode($visit)); ?>" target="_blank">Profile Ringkas Medis Rawat Jalan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/reconsialisasi/' . base64_encode(json_encode($visit)); ?>" target="_blank">Reconsialisasi Obat</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/resume_medis/' . base64_encode(json_encode($visit)); ?>" target="_blank">Resume Medis</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_diagnosis/' . base64_encode(json_encode($visit)); ?>" target="_blank">Surat Keterangan Diagnosis</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_bpjs/' . base64_encode(json_encode($visit)); ?>" target="_blank">Surat Kontrol Pasien BPJS</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_perintah/' . base64_encode(json_encode($visit)); ?>" target="_blank">Surat Perintah Rawat Inap</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="keperawatan">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsekeperawatan" aria-expanded="true" aria-controls="collapsekeperawatan">
                                <b>KEPERAWATAN</b>
                            </button>
                        </h2>
                        <div id="collapsekeperawatan" class="accordion-collapse collapse" aria-labelledby="keperawatan" data-bs-parent="#accodrionFormRm">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul id="keperawatanListLink" class="list-group list-group-flush">
                                            <input id="arpbody_id" type="hidden" value="asdf">
                                            <!-- <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_neonatus/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>" target="_blank">Asuhan Gizi</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Asuhan Kebidanan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode($visit)); ?>" target="_blank">CPPT Rawat Inap</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode($visit)); ?>" target="_blank">CPPT Rawat Jalan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Diagnosis Keperawatan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>" target="_blank">Edukasi Integrasi</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode($visit)); ?>" target="_blank">Edukasi Obat Oleh Apoteker</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>" target="_blank">Formulir Pemberian Edukasi</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode($visit)); ?>" target="_blank">Hak dan Kewajiban Pasien</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode($visit)); ?>" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode($visit)); ?>" target="_blank">Implementasi Asuhan Keperawatan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode($visit)); ?>" target="_blank">Inform Concern (Pemasangan Infus)</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode($visit)); ?>" target="_blank">Keperawatan IGD Anak</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode($visit)); ?>" target="_blank">Keperawatan IGD Dewasa</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>" target="_blank">Monitoring Nyeri</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>" target="_blank">Monitoring Resiko Jatuh</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>" target="_blank">Persetujuan Umum (General Concert)</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>" target="_blank">SDKI SLKI SIKI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>" target="_blank">Transfer Internal</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="lainnya">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapselainnya" aria-expanded="true" aria-controls="collapselainnya">
                                <b>LAIN-LAIN</b>
                            </button>
                        </h2>
                        <div id="collapselainnya" class="accordion-collapse collapse" aria-labelledby="lainnya" data-bs-parent="#accodrionFormRm">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul id="lainnyaListLink" class="list-group list-group-flush">
                                            <input id="armpasien_diagnosa_id" type="hidden" value="asdf">
                                            <input id="arpbody_id" type="hidden" value="asdf">
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/lainnya_1/' . base64_encode(json_encode($visit)); ?>" target="_blank">Permintaan Laboratorium Patologi Anatomi (PA)</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/lainnya_2/' . base64_encode(json_encode($visit)); ?>" target="_blank">Daftar Pengobatan Parenteral</a></li>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_anak/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Anak</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_bedah/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Bedah</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_dalam/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Dalam</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_kebidanan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Kebidanan</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_kulit_kelamin/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Kulit Kelamin</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_mata/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Mata</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_tht/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan THT</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_anak/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Anak</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_dalam/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Dalam</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_kebidanan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Kebidanan</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_neonatal/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Neonatal</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_paru/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Paru</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/rawat_inap/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Rawat Inap</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/profile/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Profile Ringkas Medis Rawat Jalan</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/reconsialisasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Reconsialisasi Obat</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/resume_medis/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Resume Medis</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_diagnosis/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Keterangan Diagnosis</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_bpjs/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Kontrol Pasien BPJS</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_perintah/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Perintah Rawat Inap</a></li>')
</script>
<script type="text/javascript">
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_neonatus/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Inap</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Jalan</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Diagnosis Keperawatan</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Hak dan Kewajiban Pasien</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Implementasi Asuhan Keperawatan</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Inform Concern (Pemasangan Infus)</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Anak</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Dewasa</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Nyeri</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Transfer Internal</a></li>')
</script>
<script type="text/javascript">
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_diagnosis/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Keterangan Diagnosis</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_bpjs/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Kontrol Pasien BPJS</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/rawat_inap/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Rawat Inap</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_perintah/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Perintah Rawat Inap</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Diagnosis Keperawatan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/profile/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Profile Ringkas Medis Rawat Jalan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Jalan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Inap</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Nyeri</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Implementasi Asuhan Keperawatan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/resume_medis/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Resume Medis</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/reconsialisasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Reconsialisasi Obat</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Transfer Internal</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Hak dan Kewajiban Pasien</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Inform Concern (Pemasangan Infus)</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_anak/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Anak</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_kulit_kelamin/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Kulit Kelamin</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_mata/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Mata</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_kebidanan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Kebidanan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_tht/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan THT</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_dalam/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Dalam</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_bedah/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Bedah</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_anak/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Anak</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_paru/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Paru</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_dalam/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Dalam</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_kebidanan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Kebidanan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_neonatal/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Neonatal</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Anak</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Dewasa</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_neonatus/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/surat_rujukan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Surat Rujukan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/surat_darah/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Surat Permintaan Transfusi Darah</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/vaksinasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Surat Persetujuan Pemberian Vaksinasi</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/susu_formula/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Surat Persetujuan Pemberian Susu Formula</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/fisioterapi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Surat Pengantar Fisioterapi</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/konsultasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Surat Perintah Konsultasi</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/pengobatan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Daftar Pengobatan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/bedah_umum/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Assessmen Bedah Umum Rawat Inap</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/nadi_suhu/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Lembar Nadi dan Suhu</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/persalinan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Laporan Persalinan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/sedasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Assessmen Pra Anastesi Sedasi</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/surat_lahir/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Surat Keterangan Lahir</a></li>')
</script>