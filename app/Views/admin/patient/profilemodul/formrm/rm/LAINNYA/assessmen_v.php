<!doctype html>
<html lang="en">
<?php

$selectedStatus = isset($_POST['selected-status']) ? $_POST['selected-status'] : '';
$selectedStatusFilter = isset($_POST['selected-status-filter']) ? $_POST['selected-status-filter'] : $data[0]['clinic'];

$validSub = ["P003", "P006", "P007", "P009", "P008", "P004", "P010", "P001", "P005", "P012", "all"];
$validVitail = ["P003", "P006", "P007", "P009", "P008", "P004", "P010", "P001", "P005", "P012", "all"];

$validGsc = ["P006", "P007", "P009", "P008", "P004", "P010", "P001", "P005", "P012", "all"];
$validSkala = ["P006", "P009", "P008", "P004", "P010", "P001", "P005", "all"];

$validAssNew = ["P008", "all"];
$validFisik = ["P003", "P010", "P001", "P012", "all"];
$validHamil = ["P004", "all"];
$validAssessment = ["P003", "P006", "P007", "P009", "P008", "P004", "P010", "P001", "P005", "P012", "all"];
$validPlanning = ["P003", "P006", "P007", "P009", "P008", "P004", "P010", "P001", "P005", "P012", "all"];
$validRencanaAsuhan = ["P003", "P006", "P007", "P009", "P008", "P004", "P010", "P001", "P005", "P012", "all"];
$validRencanaTindakLanjut = ["P003", "P006", "P007", "P009", "P008", "P004", "P010", "P001", "P005", "P012", "all"];
$validstatusDermatologi = ["P009", "all"];
$validApgar = ["P003"];
$validsaraf = ["P006"];
$validpsikiatri = ["P007"];


$showSubyektif = in_array($selectedStatusFilter, $validSub);

$vitailShow = in_array($selectedStatusFilter, $validVitail);
$gscShow = in_array($selectedStatusFilter, $validGsc);
$skalaShow = in_array($selectedStatusFilter, $validSkala);
$assNewShow = in_array($selectedStatusFilter, $validAssNew);
$fisikShow = in_array($selectedStatusFilter, $validFisik);
$hamilShow = in_array($selectedStatusFilter, $validHamil);
$AssessmentShow = in_array($selectedStatusFilter, $validAssessment);
$PlanningShow = in_array($selectedStatusFilter, $validPlanning);
$RencanaAsuhanShow = in_array($selectedStatusFilter, $validRencanaAsuhan);
$RencanaTindakLanjutShow = in_array($selectedStatusFilter, $validRencanaAsuhan);
$statusDermatologiShow = in_array($selectedStatusFilter, $validstatusDermatologi);
$ApgarShow = in_array($selectedStatusFilter, $validApgar);
$SarafShow = in_array($selectedStatusFilter, $validsaraf);
$PsikiatriShow = in_array($selectedStatusFilter, $validpsikiatri);
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title class="content-title"><?= $data[0]['title']; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css"
        rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- swal -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="<?= base_url() ?>assets/js/default.js"></script>

    <style>
        .form-control:disabled,
        .form-control[readonly] {
            background-color: #FFF;
            opacity: 1;
        }

        .form-control,
        .input-group-text {
            background-color: #fff;
            border: 1px solid #fff;
            font-size: 12px;
        }

        @page {
            size: A4;
        }

        body {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
            font-size: 12px;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .3rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .o_list_view_ungrouped {
            width: auto !important;
        }
    </style>
</head>
<form method="post" id="filter-form">
    <div class="row date-request pb-3 card-body">
        <div class="col-md-8">
            <div class="form-group">
                <label for="" class="fw-bold">Filter</label>
                <div class="row">
                    <div class="col-md-4">
                        <select id="selected-status" class="form-select" name="selected-status">
                            <option value="1" selected>Rawat Jalan</option>
                            <option value="0">Rawat Inap</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <select id="selected-status-filter" class="form-select" name="selected-status-filter">
                            <option value="P001">Assessmen Medis Dalam</option>
                            <option value="P003">Assessmen Medis Anak</option>
                            <option value="P005">Assessmen Medis Bedah Umum</option>
                            <option value="P006">Asesmen Medis Saraf</option>
                            <option value="P007">Asesmen Medis Pasien PSIKIATRI</option>
                            <option value="P008">Assessmen Medis Mata</option>
                            <option value="P009">Assessmen Medis Kulit Kelamin</option>
                            <option value="P004">Assessmen Medis Kebidanan</option>
                            <option value="P010">Assessmen Medis THT</option>
                            <option value="P012">Asesmen Medis IGD</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



<body>
    <div id="data-container">
        <?php foreach ($data as $index => $item): ?>
            <div class="container-fluid mt-5" id="body-show-<?= $index ?>">
                <div class="row">
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="90px">
                    </div>
                    <div class="col mt-2" align="center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                            <?= @$kop['fax'] ?? "-" ?>,
                            <?= @$kop['kota'] ?? "-" ?></p>
                        <p><?= @$kop['sk'] ?? "-" ?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="90px">
                    </div>
                </div>


                <div class="row">
                    <h3 class="text-center content-title" id="content-title"><?= @$item['title'] ?></h3>
                </div>
                <div class="row">
                    <h5 class="text-start">Informasi Pasien</h5>
                </div>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nomor RM</b>
                                <p id="no_registration" class="m-0 mt-1 p-0">
                                    <?= isset($visit['no_registration']) && $visit['no_registration'] ? $visit['no_registration'] : '-' ?>
                                </p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Pasien</b>
                                <p id="name_of_pasien" class="m-0 mt-1 p-0">
                                    <?= isset($visit['name_of_pasien']) && $visit['name_of_pasien'] ? $visit['name_of_pasien'] : '-' ?>
                                </p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Jenis Kelamin</b>
                                <p id="gendername" class="m-0 mt-1 p-0 ">
                                    <?= isset($visit['gendername']) && $visit['gendername'] ? $visit['gendername'] : '-' ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Lahir (Usia)</b>
                                <p id="umur-<?= $index ?>" class="m-0 mt-1 p-0 ">
                                    <?=
                                    !empty($item['data']['date_of_birth'])
                                        ? $item['data']['date_of_birth']
                                        : (!empty($visit['tgl_lahir'])
                                            ? DateTime::createFromFormat('Y-m-d H:i:s.u', $visit['tgl_lahir'])->format('d-m-Y')
                                            : (!empty($visit['date_of_birth'])
                                                ? DateTime::createFromFormat('Y-m-d H:i:s.u', $visit['date_of_birth'])->format('d-m-Y')
                                                : '-'))
                                    ?>
                                </p>
                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Alamat Pasien</b>
                                <p id="alamat-<?= $index ?>" class="m-0 mt-1 p-0">
                                    <?= isset($item['data']['alamat']) && $item['data']['alamat'] ? $item['data']['alamat'] : '-' ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>DPJP</b>
                                <p id="dpjp-<?= $index ?>" class="m-0 mt-1 p-0">
                                    <?= isset($item['data']['dpjp']) && $item['data']['dpjp'] ? $item['data']['dpjp'] : '-' ?>
                                </p>
                            </td>
                            <td class="p-1">
                                <b>Department</b>
                                <p id="departement-<?= $index ?>" class="m-0 mt-1 p-0">
                                    <?= isset($item['data']['departement']) && $item['data']['departement'] ? $item['data']['departement'] : '-' ?>
                                </p>
                            </td>
                            <td class="p-1">
                                <b>Tanggal Masuk</b>
                                <p id="tanggal_masuk-<?= $index ?>" class="m-0 mt-1 p-0 ">
                                    <?= isset($item['data']['tanggal_masuk']) && $item['data']['tanggal_masuk'] ? $item['data']['tanggal_masuk'] : '-' ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="subyektif" id="showSubyektif" style="display: <?php echo $showSubyektif ? '' : 'none'; ?>;">
                    <div class="row">
                        <h4 class="text-start">Subyektif (S)</h4>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="row-12">Keluhan Utama (Autoanamnesis)</b>
                                        <span class="row-12" id="keluhan_utama-<?= $index ?>">
                                            <?= @$item['data']['keluhan_utama']; ?></span>
                                        <b class="row-12">Keluhan Utama (Alloanamnesis)</b>
                                        <span class="row-12"> </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="row-12">Riwayat Penyakit Sekarang</b>
                                        <span class="row-12" id="riwayat_penyakit_sekarang-<?= $index ?>">
                                            <?= @$item['data']['riwayat_penyakit_sekarang']; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="row-12">Riwayat Penyakit Dahulu</b>
                                        <span class="row-12" id="riwayat_penyakit_dahulu-<?= $index ?>">
                                            <?= @$item['data']['riwayat_penyakit_dahulu']; ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="row-12">Riwayat Penyakit Keluarga</b>
                                        <span class="row-12" id="riwayat_penyakit_keluarga-<?= $index ?>">
                                            <?= @$item['data']['riwayat_penyakit_keluarga']; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="row-12">Riwayat Alergi (Non Obat)</b>
                                        <span class="row-12" id="riwayat_alergi_non_obat-<?= $index ?>">
                                            <?= @$item['data']['riwayat_alergi_non_obat']; ?></span>
                                        <b class="row-12">Riwayat Alergi (Obat)</b>
                                        <span class="row-12" id="riwayat_alergi_obat-<?= $index ?>">
                                            <?= @$item['data']['riwayat_alergi_obat']; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="row-12">Riwayat Obat Yang Dikonsumsi</b>
                                        <span class="row-12" id="riwayat_obat_dikonsumsi-<?= $index ?>">
                                            <?= @$item['data']['riwayat_obat_dikonsumsi']; ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="row-12">Riwayat Kehamilan dan Persalinan</b>
                                        <span class="row-12" id="riwayat_kehamilan-<?= $index ?>">
                                            <?= @$item['data']['riwayat_kehamilan']; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="row-12">Riwayat Diet</b>
                                        <span class="row-12" id="riwayat_diet-<?= $index ?>">
                                            <?= @$item['data']['riwayat_diet']; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="row-12">Riwayat Imunisasi</b>
                                        <span class="row-12" id="riwayat_imunisasi-<?= $index ?>">
                                            <?= @$item['data']['riwayat_imunisasi']; ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="row">
                                        <b class="row-12">Riwayat Kebiasaan (Negatif)</b>
                                        <span class="row-12" id="riwayat_kebiasaan-<?= $index ?>">
                                            <?= @$item['data']['riwayat_kebiasaan']; ?></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="obyektif" id="ApgarShow" style="
                  display: <?php echo $ApgarShow ? '' : 'none'; ?>;">
                    <div style="display: <?php echo !empty($item['data']['apgar_score']) ? '' : 'none'; ?>;">
                        <div class="row">
                            <h4 class="text-start">Apgar Score</h4>
                        </div>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th>1 Menit</th>
                                    <th>5 Menit</th>
                                    <th>10 Menit</th>
                                </tr>
                                <?= @$item['data']['apgar_score'] ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="obyektif">
                    <div class="row">
                        <h4 class="text-start">Obyektif (O)</h4>
                    </div>

                    <table class="table table-bordered" id="vitailShow"
                        style="display: <?php echo $vitailShow ? '' : 'none'; ?>">
                        <tbody>
                            <tr>
                                <td colspan="4" class="fst-italic fw-bold">Vital Sign</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Tekanan Darah</b>
                                        <span
                                            class="col-12 tekanan_darah-<?= $index ?>"><?= @$item['data']['tekanan_darah']; ?>
                                            mmHg</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Denyut Nadi</b>
                                        <span class="col-12 nadi-<?= $index ?>"><?= @$item['data']['nadi']; ?> x/m</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Suhu Tubuh</b>
                                        <span class="col-12 suhu-<?= $index ?>"><?= @$item['data']['suhu']; ?> ℃</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Respiration Rate</b>
                                        <span class="col-12 respirasi-<?= $index ?>"><?= @$item['data']['respirasi']; ?>
                                            x/m</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Berat Badan</b>
                                        <span class="col-12 berat_badan-<?= $index ?>"><?= @$item['data']['berat_badan']; ?>
                                            kg</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Tinggi Badan</b>
                                        <span
                                            class="col-12 tinggi_badan-<?= $index ?>"><?= @$item['data']['tinggi_badan']; ?>
                                            cm</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">SpO2</b>
                                        <span class="col-12 sp02-<?= $index ?>"><?= @$item['data']['sp02']; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">BMI</b>
                                        <span class="col-12 bmi-<?= $index ?>"><?= @$item['data']['bmi']; ?></span>
                                    </div>
                                </td>
                            </tr>
                            <div class="apgar" id="ApgarShow" style="display: <?php echo $ApgarShow ? '' : 'none'; ?>;">
                                <div style="display: <?php echo !empty($item['data']['apgar_score']) ? '' : 'none'; ?>;">
                                    <div id="apgar_obyektif-<?= $index ?>">
                                        <?= @$item['data']['pf_neonatus']; ?>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table>

                    <table class="table table-bordered" id="gscShow" style="display: <?php echo $gscShow ? '' : 'none'; ?>">
                        <tbody>
                            <tr>
                                <td colspan="4" class="fst-italic fw-bold">GCS / Tingkat Kesadaran</td>
                            </tr>

                            <?php if (!empty($item['data']['kesadaran'])): ?>
                                <tr>
                                    <td>
                                        <span class="col-12" id="kesadaran-<?= $index ?>">
                                            <?= nl2br($item['data']['kesadaran']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <b class="col-12">Score GCS</b>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <b class="col-12">Keadaan Umum</b>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>

                    <table class="table table-bordered" id="skalaShow"
                        style="display: <?php echo $skalaShow ? '' : 'none'; ?>">
                        <tbody>
                            <tr>
                                <td>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="4" class="fst-italic fw-bold">Skala Nyeri</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <span class="col-12" id="skala_nyeri-<?= $index ?>">
                                                            <?= nl2br(@$item['data']['skala_nyeri']); ?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="4" class="fst-italic fw-bold">Resiko Jatuh</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <span class="col-12" id="resiko_jatuh-<?= $index ?>">
                                                            <?= nl2br(@$item['data']['resiko_jatuh']); ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="SarafShow" style="display: <?php echo $SarafShow ? '' : 'none'; ?>">
                        <?= nl2br(@$item['data']['pemeriksaan_saraf']); ?>
                    </div>

                    <div id="PsikiatriShow" style="display: <?php echo $PsikiatriShow ? '' : 'none'; ?>">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="col-12">
                                            <!-- <?= nl2br(@$item['data']['pemeriksaan_psikiatri']); ?> -->
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <?php
                    $html = @$item['data']['pemeriksaan_mata'] ?? '
                <tr><td></td><td><b>Visus</b></td><td></td></tr>
                <tr><td></td><td><b>Koreksi</b></td><td></td></tr>
                <tr><td></td><td><b>Skiaskopi</b></td><td></td></tr>
                <tr><td></td><td><b>Bulbus Oculi</b></td><td></td></tr>
                <tr><td></td><td><b>Parese Paralyse</b></td><td></td></tr>
                <tr><td></td><td><b>Supercilia</b></td><td></td></tr>
                <tr><td></td><td><b>Palpebra Superior</b></td><td></td></tr>
                <tr><td></td><td><b>Palpebra Inferior</b></td><td></td></tr>
                <tr><td></td><td><b>Conjunctiva Palpebralis</b></td><td></td></tr>
                <tr><td></td><td><b>Conjunctiva Fornices</b></td><td></td></tr>
                <tr><td></td><td><b>Conjunctiva Bulbi</b></td><td></td></tr>
                <tr><td></td><td><b>Sclera</b></td><td></td></tr>
                <tr><td></td><td><b>Cornea</b></td><td></td></tr>
                <tr><td></td><td><b>Camera Oculi Anterior</b></td><td></td></tr>
                <tr><td></td><td><b>Iris</b></td><td></td></tr>
                <tr><td></td><td><b>Pupil</b></td><td></td></tr>
                <tr><td></td><td><b>Lensa</b></td><td></td></tr>
                <tr><td></td><td><b>Corpus Vitreous</b></td><td></td></tr>
                <tr><td></td><td><b>Fundus Reflek</b></td><td></td></tr>
                <tr><td></td><td><b>Tensio Oculi</b></td><td></td></tr>
                <tr><td></td><td><b>Sistem Canalis Lacrimaris</b></td><td></td></tr>
                <tr><td></td><td><b>Lain-lain</b></td><td></td></tr>
                ';
                    ?>

                    <?php
                    $dom = new DOMDocument();
                    libxml_use_internal_errors(true);
                    $dom->loadHTML('<table>' . $html . '</table>');
                    libxml_clear_errors();

                    $trs = $dom->getElementsByTagName('tr');
                    $rows = [];

                    foreach ($trs as $tr) {
                        $rows[] = $dom->saveHTML($tr);
                    }

                    $half = ceil(count($rows) / 2);
                    $leftTable = array_slice($rows, 0, $half);
                    $rightTable = array_slice($rows, $half);
                    ?>


                    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->

                    <table class="table table-bordered" id="assNewShow"
                        style="display: <?php echo $assNewShow ? '' : 'none'; ?>">
                        <tbody>
                            <tr>
                                <td width="50%">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <td><b>Oculus Dextra</b></td>
                                                <td>Keterangan</td>
                                                <td><b>Oculus Sinistra</b></td>
                                            </tr>
                                        </thead>
                                        <tbody id="leftTableBody-<?= $index ?>">
                                            <?php foreach ($leftTable as $row): ?>
                                                <?= $row ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="50%">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <td><b>Oculus Dextra</b></td>
                                                <td>Keterangan</td>
                                                <td><b>Oculus Sinistra</b></td>
                                            </tr>
                                        </thead>
                                        <tbody id="rightTableBody-<?= $index ?>">
                                            <?php foreach ($rightTable as $row): ?>
                                                <?= $row ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>

                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered" id="fisikShow"
                        style="display: <?php echo $fisikShow ? '' : 'none'; ?>">
                        <tbody>
                            <tr>
                                <td colspan="4" class="fw-bold">Pemeriksaan Fisik Tambahan</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <span class="col-12" id="pemeriksaan_fisik-<?= $index ?>">
                                            <?= nl2br(@$item['data']['pemeriksaan_fisik'] ?? "-"); ?>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered" id="hamilShow"
                        style="display: <?php echo $hamilShow ? '' : 'none'; ?>">
                        <tbody>
                            <tr>
                                <td colspan="4" class="fw-bold">Kasus Hamil</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <span class="col-12" id="kehamilan-<?= $index ?>">
                                            <?= nl2br(@$item['data']['kehamilan']); ?>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered" id="statusDermatologiShow"
                        style="display: <?php echo $statusDermatologiShow ? '' : 'none'; ?>">
                        <tbody>
                            <tr>
                                <td colspan="4" class="fw-bold">Status Dermatologik</td>
                            </tr>
                            <?php if (!empty($item['data']['pemeriksaan_kulit'])): ?>
                                <tr>
                                    <td colspan="2">
                                        <span class="col-12" id="pemeriksaan_kulit-<?= $index ?>">
                                            <?= nl2br($item['data']['pemeriksaan_kulit']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <b class="col-12">I. Inspeksi</b>
                                        </div>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold">Lokasi</td>
                                                    <td class="fw-bold">UKK</td>
                                                    <td class="fw-bold">Distribusi</td>
                                                    <td class="fw-bold">Konfigurasi</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <b class="col-12">Palpasi</b>
                                            <span class="col-12"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <b class="col-12">Lain-Lain</b>
                                            <span class="col-12"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <b class="col-12">Status Venerologik</b>
                                            <span class="col-12"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <b class="col-12">Inspeksi</b>
                                            <span class="col-12"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <b class="col-12">Palpasi</b>
                                            <span class="col-12"></span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>

                <div class="assessment" id="AssessmentShow" style="display: <?php echo $AssessmentShow ? '' : 'none'; ?>">
                    <div class="row">
                        <h4 class="text-start">Assessment (A)</h4>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <span class="col-12" id="asesmen-<?= $index ?>">
                                    <?= nl2br(@$item['data']['asesmen'] ?? "-"); ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="planning" id="PlanningShow" style="display: <?php echo $PlanningShow ? '' : 'none'; ?>">
                    <div class="row">
                        <h4 class="text-start">Planning (P)</h4>
                    </div>

                    <table class="table table-bordered">
                        <?php if (!empty($item['data']['pemeriksaan_penunjang'])): ?>
                            <tr>
                                <td>
                                    <span class="col-12" id="pemeriksaan_penunjang-<?= $index ?>">
                                        <?= nl2br($item['data']['pemeriksaan_penunjang']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><b>Target / Sasaran Terapi</b><span></span></td>
                            </tr>
                            <tr>
                                <td><b>Pemeriksaan Diagnostik Penunjang</b><span></span></td>
                            </tr>
                            <tr>
                                <td><b>Laboratorium</b><span></span></td>
                            </tr>
                            <tr>
                                <td><b>Radiologi</b><span></span></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>

                <div class="RencanaAsuhandanTerapi" id="RencanaAsuhanShow"
                    style="display: <?php echo $RencanaAsuhanShow ? '' : 'none'; ?>">
                    <div class="row">
                        <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
                    </div>
                    <table class="table table-bordered">
                        <?php if (!empty($item['data']['rencana_asuhan'])): ?>
                            <tr>
                                <td>
                                    <span class="col-12" id="rencana_asuhan-<?= $index ?>">
                                        <?= nl2br($item['data']['rencana_asuhan']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><b>Farmakoterapi</b></td>
                            </tr>
                            <tr>
                                <td><b>Procedure</b></td>
                            </tr>
                            <tr>
                                <td><b>Catatan Procedure</b></td>
                            </tr>
                            <tr>
                                <td><b>Standing Order</b></td>
                            </tr>

                        <?php endif; ?>
                    </table>
                </div>

                <div class="RencanaTindakLanjut" id="RencanaTindakLanjutShow"
                    style="display: <?php echo $RencanaTindakLanjutShow ? '' : 'none'; ?>">
                    <div class="row">
                        <h5 class="text-start">Rencana Tindak Lanjut</h5>
                    </div>
                    <table class="table table-bordered">
                        <?php if (!empty($item['data']['rencana_tindak_lanjut'])): ?>
                            <tr>
                                <td>
                                    <span class="col-12" id="rencana_tindak_lanjut-<?= $index ?>">
                                        <?= nl2br($item['data']['rencana_tindak_lanjut']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><b>Rencana Tindak Lanjut</b></td>
                            </tr>
                            <tr>
                                <td><b>Kontrol</b></td>
                            </tr>
                        <?php endif; ?>

                    </table>
                </div>

                <div class="EdukasiPasien">
                    <div class="row">
                        <h5 class="text-start">Edukasi Pasien</h5>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <?php if (!empty($item['data']['edukasi'])): ?>
                                <tr>
                                    <td>
                                        <span class="col-12" id="edukasi-<?= $index ?>">
                                            <?= nl2br($item['data']['edukasi']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td>
                                        <b>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapai kepada:</b>
                                        <div></div>
                                    </td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
    const defaultStatus = <?= json_encode($visit['isrj']) ?>;
    const visit = '<?= $visit1 ?>';



    $(document).ready(function() {
        let statusVisibility = {
            showSubyektif: <?php echo json_encode($validSub); ?>,
            vitailShow: <?php echo json_encode($validVitail); ?>,
            gscShow: <?php echo json_encode($validGsc); ?>,
            skalaShow: <?php echo json_encode($validSkala); ?>,
            assNewShow: <?php echo json_encode($validAssNew); ?>,
            fisikShow: <?php echo json_encode($validFisik); ?>,
            hamilShow: <?php echo json_encode($validHamil); ?>,
            AssessmentShow: <?php echo json_encode($validAssessment); ?>,
            PlanningShow: <?php echo json_encode($validPlanning); ?>,
            RencanaAsuhanShow: <?php echo json_encode($validRencanaAsuhan); ?>,
            RencanaTindakLanjutShow: <?php echo json_encode($validRencanaTindakLanjut); ?>,
            statusDermatologiShow: <?php echo json_encode($validstatusDermatologi); ?>,
            ApgarShow: <?php echo json_encode($validApgar); ?>,
            SarafShow: <?php echo json_encode($validsaraf); ?>,
            PsikiatriShow: <?php echo json_encode($validpsikiatri); ?>,
        };


        if (defaultStatus !== null) {
            $('#selected-status').val(defaultStatus);
        }

        const requestAPi = () => {
            postData({
                status: $('#selected-status').val(),
                visit: visit,
                clinic: $("#selected-status-filter").val()
            }, 'admin/rm/LAINNYA/assessmen_preview', (res) => {
                const selectedValue = $("#selected-status-filter").val();
                rendersDataView({
                    data: res.data,
                    result_select: selectedValue,
                    dataLength: res?.data?.length
                });
            });
        }

        $('#selected-status').on('change', function() {
            requestAPi();
        });

        $('#selected-status-filter').on('change', function() {
            requestAPi();
        });

        function toggleDynamicVisibility(visibilityData, user) {

            Object.keys(visibilityData).forEach((key) => {
                const isVisible = visibilityData[key]?.includes(user) ?? false;
                const element = $("#" + key);

                if (element.length > 0) {
                    element.css("display", isVisible ? "" : "none");
                }
            });
        }

        const rendersDataView = (props) => {
            let {
                data,
                result_select,
                dataLength
            } = props;
            const selectedValue = result_select;


            $('#data-container').empty();

            data.map((e, index) => {
                let dummy = <?php echo json_encode($html); ?>;
                const rows = e?.data?.pemeriksaan_mata?.split('</tr>').filter(row => row.trim() !== '');
                let leftTableHtml = '';
                let rightTableHtml = '';

                rows?.forEach((row, index) => {
                    if (index % 2 === 0) {
                        leftTableHtml += row + '</tr>';
                    } else {
                        rightTableHtml += row + '</tr>';
                    }
                });


                const htmlView = ` <div class="container-fluid mt-5" id="body-show-${index}">
                        <div class="row">
                            <div class="col-auto" align="center">
                                <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="90px">
                            </div>
                            <div class="col mt-2" align="center">
                                <h3><?= @$kop['name_of_org_unit'] ?></h3>
                                <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                                    <?= @$kop['fax'] ?? "-" ?>,
                                    <?= @$kop['kota'] ?? "-" ?></p>
                                <p><?= @$kop['sk'] ?? "-" ?></p>
                            </div>
                            <div class="col-auto" align="center">
                                <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="90px">
                            </div>
                        </div>


                        <div class="row">
                            <h3 class="text-center content-title" id="content-title">${e.title}</h3>
                        </div>
                        <div class="row">
                            <h5 class="text-start">Informasi Pasien</h5>
                        </div>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="p-1" style="width:33.3%">
                                        <b>Nomor RM</b>
                                        <p id="no_registration" class="m-0 mt-1 p-0">
                                            <?= isset($visit['no_registration']) && $visit['no_registration'] ? $visit['no_registration'] : '-' ?>
                                        </p>
                                    </td>
                                    <td class="p-1" style="width:33.3%">
                                        <b>Nama Pasien</b>
                                        <p id="name_of_pasien" class="m-0 mt-1 p-0">
                                            <?= isset($visit['name_of_pasien']) && $visit['name_of_pasien'] ? $visit['name_of_pasien'] : '-' ?>
                                        </p>
                                    </td>
                                    <td class="p-1" style="width:33.3%">
                                        <b>Jenis Kelamin</b>
                                        <p id="gendername" class="m-0 mt-1 p-0 ">
                                            <?= isset($visit['gendername']) && $visit['gendername'] ? $visit['gendername'] : '-' ?>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" style="width:33.3%">
                                        <b>Tanggal Lahir (Usia)</b>
                                        <p id="umur-${index}" class="m-0 mt-1 p-0 ">${e?.data?.umur ?? "-"}
                                        </p>
                                    </td>
                                    <td class="p-1" style="width:66.3%" colspan="2">
                                        <b>Alamat Pasien</b>
                                        <p id="alamat-${index}" class="m-0 mt-1 p-0">
                                            ${e?.data?.alamat?? "-"}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <b>DPJP</b>
                                        <p id="dpjp-${index}" class="m-0 mt-1 p-0">
                                                ${e?.data?.dpjp?? "-"}
                                        </p>
                                    </td>
                                    <td class="p-1">
                                        <b>Department</b>
                                        <p id="departement-${index}" class="m-0 mt-1 p-0">
                                                ${e?.data?.departement?? "-"}
                                        </p>
                                    </td>
                                    <td class="p-1">
                                        <b>Tanggal Masuk</b>
                                        <p id="tanggal_masuk-${index}" class="m-0 mt-1 p-0 ">
                                                ${e?.data?.tanggal_masuk?? "-"}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="subyektif" id="showSubyektif" style="display: ${statusVisibility.showSubyektif.includes(e.clinic) ? '' : 'none' }">
                            <div class="row">
                                <h4 class="text-start">Subyektif (S)</h4>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <b class="row-12">Keluhan Utama (Autoanamnesis)</b>
                                                <span class="row-12" id="keluhan_utama-${index}">
                                                    ${e?.data?.keluhan_utama?? "-"}</span>
                                                <b class="row-12">Keluhan Utama (Alloanamnesis)</b>
                                                <span class="row-12"> </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <b class="row-12">Riwayat Penyakit Sekarang</b>
                                                <span class="row-12" id="riwayat_penyakit_sekarang-${index}">${e?.data?.riwayat_penyakit_sekarang?? "-"}
                                                    </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <b class="row-12">Riwayat Penyakit Dahulu</b>
                                                <span class="row-12" id="riwayat_penyakit_dahulu-${index}">${e?.data?.riwayat_penyakit_dahulu?? "-"}
                                                    </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <b class="row-12">Riwayat Penyakit Keluarga</b>
                                                <span class="row-12" id="riwayat_penyakit_keluarga-${index}">${e?.data?.riwayat_penyakit_keluarga?? "-"}
                                                    </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <b class="row-12">Riwayat Alergi (Non Obat)</b>
                                                <span class="row-12" id="riwayat_alergi_non_obat-${index}">${e?.data?.riwayat_alergi_non_obat?? "-"}
                                                    </span>
                                                <b class="row-12">Riwayat Alergi (Obat)</b>
                                                <span class="row-12" id="riwayat_alergi_obat-${index}">${e?.data?.riwayat_alergi_obat?? "-"}
                                                    </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <b class="row-12">Riwayat Obat Yang Dikonsumsi</b>
                                                <span class="row-12" id="riwayat_obat_dikonsumsi-${index}">${e?.data?.riwayat_obat_dikonsumsi?? "-"}
                                                    </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <b class="row-12">Riwayat Kehamilan dan Persalinan</b>
                                                <span class="row-12" id="riwayat_kehamilan-${index}">${e?.data?.riwayat_kehamilan?? "-"}
                                                    </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <b class="row-12">Riwayat Diet</b>
                                                <span class="row-12" id="riwayat_diet-${index}">${e?.data?.riwayat_diet?? "-"}
                                                    </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <b class="row-12">Riwayat Imunisasi</b>
                                                <span class="row-12" id="riwayat_imunisasi-${index}">${e?.data?.riwayat_imunisasi?? "-"}
                                                    </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="row">
                                                <b class="row-12">Riwayat Kebiasaan (Negatif)</b>
                                                <span class="row-12" id="riwayat_kebiasaan-${index}">${e?.data?.riwayat_kebiasaan?? "-"}
                                                    </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="ApgarShow" id="ApgarShow" style="display: ${statusVisibility?.ApgarShow.includes(e.clinic) ? '' : 'none'}">
                       <div style="display: ${e.data?.apgar_score ? '' : 'none' }">
                            <div class="row">
                                <h4 class="text-start">Apgar Score</h4>
                            </div>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <th>1 Menit</th>
                                        <th>5 Menit</th>
                                        <th>10 Menit</th>
                                    </tr>
                                      ${e.data?.apgar_score ? nl2br(e.data.apgar_score) :"-"}
                                </tbody>
                            </table>
                        </div>
                        </div>

                        <div class="obyektif">
                            <div class="row">
                                <h4 class="text-start">Obyektif (O)</h4>
                            </div>

                            <table class="table table-bordered" id="vitailShow"
                                        style="display: ${statusVisibility?.vitailShow.includes(e.clinic) ? '' : 'none'}">
                                        <tbody>
                                            <tr>
                                                <td colspan="4" class="fst-italic fw-bold">Vital Sign</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <b class="col-12">Tekanan Darah</b>
                                                        <span class="col-12 tekanan_darah-${index}">${e.data.tekanan_darah?? '-'} mmHg</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <b class="col-12">Denyut Nadi</b>
                                                        <span class="col-12 nadi-${index}">${e.data.nadi?? '-'} x/m</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <b class="col-12">Suhu Tubuh</b>
                                                        <span class="col-12 suhu-${index}">${e.data.suhu?? '-'} ℃</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <b class="col-12">Respiration Rate</b>
                                                        <span class="col-12 respirasi-${index}">${e.data.respirasi?? '-'} x/m</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <b class="col-12">Berat Badan</b>
                                                        <span class="col-12 berat_badan-${index}">${e.data.berat_badan?? '-'} kg</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <b class="col-12">Tinggi Badan</b>
                                                        <span class="col-12 tinggi_badan-${index}">${e.data.tinggi_badan?? '-'} cm</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <b class="col-12">SpO2</b>
                                                        <span class="col-12 sp02-${index}">${e.data.sp02?? '-'}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <b class="col-12">BMI</b>
                                                        <span class="col-12 bmi-${index}">${e.data.bmi?? '-'}</span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class="apgar ApgarShow" id="ApgarShoww" style="display: ${statusVisibility?.ApgarShow.includes(e.clinic) ? '' : 'none'}">
                                              ${e.data?.apgar_score ?`<div id="apgar_obyektif-${index}" style="white-space: pre-wrap;">
                                                    ${e.data.pf_neonatus ? e.data.pf_neonatus : '-'}
                                                </div>` : ""}
                                                
                                        </div>

                                        </tbody>
                                    </table>


                            <table class="table table-bordered" id="gscShow" style="display: ${statusVisibility?.gscShow.includes(e.clinic) ? '' : 'none'}">
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="fst-italic fw-bold">GCS / Tingkat Kesadaran</td>
                                    </tr>

                                    <?php if (!empty($item['data']['kesadaran'])): ?>
                                    <tr>
                                        <td>
                                            <span class="col-12" id="kesadaran-${index}">
                                             ${e.data.kesadaran ? nl2br(e.data.kesadaran) : '-'}
                                            </span>
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <b class="col-12">Score GCS</b>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <b class="col-12">Keadaan Umum</b>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>

                                </tbody>
                            </table>

                            <table class="table table-bordered" id="skalaShow"
                                style="display: ${statusVisibility?.skalaShow.includes(e.clinic) ? '' : 'none'}">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="4" class="fst-italic fw-bold">Skala Nyeri</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <span class="col-12" id="skala_nyeri-${index}">
                                                                   ${e.data.skala_nyeri ? nl2br(e.data.skala_nyeri) : '-'}
                                                                    </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="4" class="fst-italic fw-bold">Resiko Jatuh</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <span class="col-12" id="resiko_jatuh-${index}">
                                                                   ${e.data.resiko_jatuh ? nl2br(e.data.resiko_jatuh) : '-'}

                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                          <div id="SarafShow" style="display: ${statusVisibility?.SarafShow.includes(e.clinic) ? '' : 'none'}">
                                ${e.data?.pemeriksaan_saraf ? nl2br1((e.data.pemeriksaan_saraf))  : ""}
                            </div>

                          <div id="PsikiatriShow" style="display: ${statusVisibility?.PsikiatriShow.includes(e.clinic) ? '' : 'none'}">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="col-12" >
                                                  ${e.data?.pemeriksaan_psikiatri ? nl2br(e.data.pemeriksaan_psikiatri) :""}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <table class="table table-bordered" id="assNewShow"
                                style="display: ${statusVisibility?.assNewShow.includes(e.clinic) ? '' : 'none'}">
                                <tbody>
                                    <tr>
                                        <td width="50%">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <td><b>Oculus Dextra</b></td>
                                                        <td>Keterangan</td>
                                                        <td><b>Oculus Sinistra</b></td>
                                                    </tr>
                                                </thead>
                                                <tbody id="leftTableBody-${index}">
                                                ${leftTableHtml}
                                                </tbody>
                                            </table>
                                        </td>
                                        <td width="50%">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <td><b>Oculus Dextra</b></td>
                                                        <td>Keterangan</td>
                                                        <td><b>Oculus Sinistra</b></td>
                                                    </tr>
                                                </thead>
                                                <tbody id="rightTableBody-${index}">
                                                    ${rightTableHtml}
                                                </tbody>
                                            </table>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered" id="fisikShow"
                                style="display: ${statusVisibility?.fisikShow.includes(e.clinic) ? '' : 'none'}">
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="fw-bold">Pemeriksaan Fisik Tambahan</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <span class="col-12" id="pemeriksaan_fisik-${index}">
                                                    ${e.data.pemeriksaan_fisik ? nl2br(e.data
                                                             .pemeriksaan_fisik) : '-'}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered" id="hamilShow"
                                style="display: ${statusVisibility?.hamilShow.includes(e.clinic) ? '' : 'none'}">
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="fw-bold">Kasus Hamil</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <span class="col-12" id="kehamilan-${index}">
                                                 ${e.data.kehamilan ? nl2br(e.data
                                                             .kehamilan) : '-'}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered" id="statusDermatologiShow"
                                style="display: ${statusVisibility?.statusDermatologiShow.includes(e.clinic) ? '' : 'none'}">
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="fw-bold">Status Dermatologik</td>
                                    </tr>
                                    <?php if (!empty($item['data']['pemeriksaan_kulit'])): ?>
                                    <tr>
                                        <td colspan="2">
                                            <span class="col-12" id="pemeriksaan_kulit-${index}">
                                             ${e.data.pemeriksaan_kulit ? nl2br(e.data
                                                             .pemeriksaan_kulit) : '-'}
                                            </span>
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="2">
                                            <div class="row">
                                                <b class="col-12">I. Inspeksi</b>
                                            </div>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-bold">Lokasi</td>
                                                        <td class="fw-bold">UKK</td>
                                                        <td class="fw-bold">Distribusi</td>
                                                        <td class="fw-bold">Konfigurasi</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <b class="col-12">Palpasi</b>
                                                <span class="col-12"></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <b class="col-12">Lain-Lain</b>
                                                <span class="col-12"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="row">
                                                <b class="col-12">Status Venerologik</b>
                                                <span class="col-12"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <b class="col-12">Inspeksi</b>
                                                <span class="col-12"></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <b class="col-12">Palpasi</b>
                                                <span class="col-12"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="assessment" id="AssessmentShow" style="display: ${statusVisibility?.AssessmentShow.includes(e.clinic) ? '' : 'none'}">
                            <div class="row">
                                <h4 class="text-start">Assessment (A)</h4>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <span class="col-12" id="asesmen-${index}">
                                         ${e.data.asesmen ? nl2br(e.data.asesmen) : '-'}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="planning" id="PlanningShow" style="display: ${statusVisibility?.PlanningShow.includes(e.clinic) ? '' : 'none'}">
                            <div class="row">
                                <h4 class="text-start">Planning (P)</h4>
                            </div>

                            <table class="table table-bordered">
                                <?php if (!empty($item['data']['pemeriksaan_penunjang'])): ?>
                                <tr>
                                    <td>
                                        <span class="col-12" id="pemeriksaan_penunjang-<?= $index ?>">
                                         ${e.data.pemeriksaan_penunjang ? nl2br(e.data.pemeriksaan_penunjang) : '-'}

                                        </span>
                                    </td>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <td><b>Target / Sasaran Terapi</b><span></span></td>
                                </tr>
                                <tr>
                                    <td><b>Pemeriksaan Diagnostik Penunjang</b><span></span></td>
                                </tr>
                                <tr>
                                    <td><b>Laboratorium</b><span></span></td>
                                </tr>
                                <tr>
                                    <td><b>Radiologi</b><span></span></td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>

                        <div class="RencanaAsuhandanTerapi" id="RencanaAsuhanShow"
                            style="display: ${statusVisibility?.RencanaAsuhanShow.includes(e.clinic) ? '' : 'none'}">
                            <div class="row">
                                <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
                            </div>
                            <table class="table table-bordered">
                                <?php if (!empty($item['data']['rencana_asuhan'])): ?>
                                <tr>
                                    <td>
                                        <span class="col-12" id="rencana_asuhan-<?= $index ?>">
                                         ${e.data.rencana_asuhan ? nl2br(e.data.rencana_asuhan) : '-'}
                                        
                                        </span>
                                    </td>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <td><b>Farmakoterapi</b></td>
                                </tr>
                                <tr>
                                    <td><b>Procedure</b></td>
                                </tr>
                                <tr>
                                    <td><b>Catatan Procedure</b></td>
                                </tr>
                                <tr>
                                    <td><b>Standing Order</b></td>
                                </tr>

                                <?php endif; ?>
                            </table>
                        </div>

                        <div class="RencanaTindakLanjut" id="RencanaTindakLanjutShow"
                            style="display: ${statusVisibility?.RencanaTindakLanjutShow.includes(e.clinic) ? '' : 'none'}">
                            <div class="row">
                                <h5 class="text-start">Rencana Tindak Lanjut</h5>
                            </div>
                            <table class="table table-bordered">
                                <?php if (!empty($item['data']['rencana_tindak_lanjut'])): ?>
                                <tr>
                                    <td>
                                        <span class="col-12" id="rencana_tindak_lanjut-<?= $index ?>">
                                         ${e.data.rencana_tindak_lanjut ? nl2br(e.data.rencana_tindak_lanjut) : '-'}

                                        </span>
                                    </td>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <td><b>Rencana Tindak Lanjut</b></td>
                                </tr>
                                <tr>
                                    <td><b>Kontrol</b></td>
                                </tr>
                                <?php endif; ?>

                            </table>
                        </div>

                        <div class="EdukasiPasien">
                            <div class="row">
                                <h5 class="text-start">Edukasi Pasien</h5>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <?php if (!empty($item['data']['edukasi'])): ?>
                                    <tr>
                                        <td>
                                            <span class="col-12" id="edukasi-<?= $index ?>">
                                         ${e.data.edukasi ? nl2br(e.data.edukasi) : '-'}

                                            </span>
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                    <tr>
                                        <td>
                                            <b>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapai kepada:</b>
                                            <div></div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>

                    </div>`

                $('#data-container').append(htmlView);


            });

            toggleDynamicVisibility(statusVisibility, selectedValue);


            // if (dataLength === 1) {
            //     $(`#body-show-${dataLength}`).hide();
            // } else {
            //     for (let i = 0; i <= dataLength; i++) {
            //         $(`#body-show-${i}`).show();
            //     }
            // }

        }

        function nl2br(str) {
            return str.replace(/(\r\n|\n|\r)+/g, '<br>');
        }

        function nl2br1(str) {
            return str.replace(/\r\n/g, '<br>');
        }

        function cleanBr(str) {
            let result = str.replace(/(<table[^>]*>.*?<\/table>)/gs, (match) => {
                return match.replace(/(\r\n|\n|\r)+/g, '<br>');
            });

            result = result.replace(/(<br\s*\/?>)/g, '');

            return result;
        }
    });
</script>


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

        .date-request {
            display: none;
        }
    }
</style>

</html>