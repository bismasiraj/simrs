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
    <script src="<?= base_url('assets/js/default.js') ?>"></script>

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
    <div class="row date-request pb-3 card-body" hidden>
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
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                    </div>
                    <div class="col mt-2" align="center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                            <?= @$kop['fax'] ?? "-" ?>,
                            <?= @$kop['kota'] ?? "-" ?></p>
                        <p><?= @$kop['sk'] ?? "-" ?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
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
                                    isset($item['data']['umur']) && $item['data']['umur']
                                        ? $item['data']['umur']
                                        : DateTime::createFromFormat('Y-m-d H:i:s.u', $visit['tgl_lahir'])->format('d-m-Y')
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



                <div class="triage" id="triageShow">
                    <div class="row">
                        <h4 class="text-start">Triage</h4>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Triage</b>
                                <p>isiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>ATS V</b>
                                <p>isiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="anamnesa" id="anamnesaShow">
                    <div class="row">
                        <h4 class="text-start">Anamnesa</h4>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Keluhan Utama</b>
                                <p>isiiiii</p>
                            </td>
                            <td>
                                <b>Riwayat Penyakit Sekarang</b>
                                <p>isiiiii</p>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Riwayat Penyakit Dahulu</b>
                                <p>isiiiii</p>

                            </td>
                            <td>
                                <b>Riwayat Alergi (Non Obat)</b>
                                <p>isiiiii</p>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Riwayat Penyakit Keluarga</b>
                                <p>isiiiii</p>

                            </td>
                            <td>
                                <b>Riwayat Alergi (Obat)</b>
                                <p>isiiiii</p>

                            </td>
                        </tr>
                    </table>
                </div>

                <div class="historynlifestyle" id="historynlifestyleShow">
                    <div class="row">
                        <h4 class="text-start">Riwayat & Gaya Hidup</h4>
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Alkohol</b>
                                <p>---data Tidak tersedia----</p>
                            </td>
                            <td>
                                <b>Merokok</b>
                                <p>---data Tidak tersedia----</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="vitailsign" id="vitailsignShow">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Tekanan Darah</b>
                                        <p>
                                            isiiiii
                                            mmHg
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Denyut Nadi</b>
                                        <p>
                                            isiiiii
                                            x/m
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Suhu Tubuh</b>
                                        <p>
                                            isiiiii
                                            ?
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Respiration Rate</b>
                                        <p>
                                            isiiiii
                                            x/m
                                        </p>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Berat Badan</b>
                                        <p>
                                            isiiiii
                                            kg
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Tinggi Badan</b>
                                        <p>
                                            isiiiii
                                            cm
                                        </p>

                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">SpO2</b>
                                        <p>
                                            isiiiii
                                        </p>

                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">BMI</b>
                                        <p>
                                            isiiiii
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="RencanaAsuhandanTerapi" id="RencanaAsuhanShow">
                    <div class="row">
                        <h5 class="text-start">Skrining Gizi</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Pasien operasi >= 65 Tahun ?</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Gangguan Makan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Masalah yang berhubungan dengan nutrisi</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Masalah Makan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Nutrisi melalui NGT</b>
                                <p>isiiiii</p>
                            </td>
                            <td>
                                <b>Mukosa Mulut/ Lidat</b>
                                <p>isiiiii</p>
                                <b>Fluid Intake</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Penyakit</b>
                                <p>isiiiii</p>
                                <b>Kategori Usia</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Gangguan Metabolik</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Status Gangguan Metabolik</b>
                                <p>isiiiii</p>
                                <b>Resiko Malnutrisi</b>
                                <p>isiiiii</p>
                                <b>Perlu Konsultasi Gizi</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="skalaNyeri" id="skalanyeri">
                    <table class="table table-bordered" id="skalaShow">
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
                                                            <?= nl2br(@$item['data']['skala_nyeri']); ?>


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
                </div>

                <div class="aktivitas" id="aktivitasShow">
                    <div class="row">
                        <h5 class="text-start">Aktivitas Dan Latihan</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>Faktor Ketergantungan</th>
                            <th>Nilai</th>
                        </tr>
                        <tr>
                            <td>isi Faktor </td>
                            <td>isi Nilai</td>
                        </tr>
                    </table>
                </div>

                <div class="psikologis" id="psikologisShow">
                    <div class="row">
                        <h5 class="text-start">Psikologis Spiritual</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Kondisi Pasien</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Hubungan dengan Keluarga</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Permintaan Khusus</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Agama</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Hambatan Soaial/Budaya/Ekonomi</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Larangan Keyakinan</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Mitos Budaya Setempat</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="sosialEkonomi" id="sosialEkonomiShow">
                    <div class="row">
                        <h5 class="text-start">Sosial Ekonomi</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Status Perkawinan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Punya Anak</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Jumlah Anak</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Pendidikan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Kewarganegaraan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Pekerjaan</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Aktivitas</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Curiga penganiayaan/penelantaran</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Tinggal Bersama</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="integumen" id="integumenShow">
                    <div class="row">
                        <h5 class="text-start">Integumen & Muskulo Skeletal</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Integumen</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Turgor</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Rambut</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Kuku</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Luka</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Perdarahan</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Fraktur</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Fraktur/Dislokasi</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>



                <div class="assNeurosensoris" id="assNeurosensorisShow">
                    <div class="row">
                        <h5 class="text-start">Asesmen Neurosensoris</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Orientasi</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Memori</b>
                                <p>isiiiii</p>
                            </td>
                            <td rowspan="3">
                                <b>Gsc</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Ukuran Pupil Kiri</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Ukuran Pupil Kanan</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Reaksi Cahaya Pupil Kiri</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Reaksi Cahaya Pupil Kanan</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Tanda Perangsang Selaput Otak</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Resiko Injury</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="assSirkulasi" id="assSirkulasiShow">
                    <div class="row">
                        <h5 class="text-start">Asesmen Sirkulasi</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Tekanan Darah</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Gangguan Sirkulasi</b>
                                <p>isiiiii</p>
                            </td>
                            <td>
                                <b>Pengisian Kapiler</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Denyut Nadi</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Irama Jantung</b>
                                <p>isiiiii</p>
                                <p>Frekuensi: isiiiiii</p>
                            </td>
                            <td><b>Pacemaker</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Akral</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Gangguan Perfusi Jaringan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Resiko Syok</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Gangguan Penurunan Curah Jantung</b>
                                <p>isiiiii</p>
                            </td>

                        </tr>
                    </table>
                </div>

                <div class="pencernaan" id="pencernaanShow">
                    <div class="row">
                        <h5 class="text-start">Pencernaan</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Jenis Diit</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Feeding Tube</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Pembatasan Cairan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Abdomen</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Bunyi Usus</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Trakhir BAB</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Konsistensi</b>
                                <p>isiiiii</p>
                                <b>Penggunaan Pencahar</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Gangguan Pola Eliminasi</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="pernapasan" id="pernapasanShow">
                    <div class="row">
                        <h5 class="text-start">Pernapasan</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Airway</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Benda Asing</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>ETT</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Breathing</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Bunyi Paru</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Posisi Paru</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Kesulitan Bernapas</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Penggunaan otot bantu nafas</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Menggunakan Oksigen</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Frekuensi Napas</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Batuk</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>SpO2</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Bersihan jalan nafas tidak efektif</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Pola nafas efektif</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Gangguan pertukaran gas</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="perkemihan" id="perkemihanShow">
                    <div class="row">
                        <h5 class="text-start">Perkemihan</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>BAK</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Menggunakan Katter Urine</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Jumlah Urine</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Masalah Prostat</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Keluhan Nyeri Pinggang</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Kelainan</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Gangguan Pola Eliminasi</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="seksual" id="seksualShow">
                    <div class="row">
                        <h5 class="text-start">Seksual/Reproduksi</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Jenis Kelamin</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Skrining Prostat</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Risiko Pendarahan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Gangguan Konsep Diri</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="thtneye" id="thtneyeShow">
                    <div class="row">
                        <h5 class="text-start">THT & MATA</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Telinga</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Sakit Menelan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Gigi</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Sakit Gigi</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Gigi Palsu</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Mata</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>Gangguan Persepsi Sensori</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="childSpecial" id="childSpecialShow">
                    <div class="row">
                        <h5 class="text-start">Khusus Anak</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Lama Kehamilan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Komplikasi</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Masalah Neonatus</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Masalah Maternal</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Riwayat Imunisasi</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Umur Saat Tengkurap</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Umur Saat Duduk</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Umur Saat Mengoceh</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Umur Saat Berdiri</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Umur Saat Bicara</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Umur Saat Berjalan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>ASI/Formula</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Makanan Tambahan</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Pengasuh</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Pembawaan Umum</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Tempramen</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Kebiasaan Perilaku Unik</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>Resiko terjadi penyakit yang dapat dicegah dengan imunisasi (PD3I)</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Gangguan Tumbuh Kembang</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="sleepnChill" id="sleepnChillShow">
                    <div class="row">
                        <h5 class="text-start">Tidur Dan Istirahat</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Beberapa Jam Tidur Per Hari</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Penggunaan Obat Tidur</b>
                                <p>isiiiii</p>
                            </td>
                            <td><b>Penerangan Lampu</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Keadaan Saat Ini</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="dekubitus" id="dekubitusShow">
                    <div class="row">
                        <h5 class="text-start">Dekubitus</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Resiko Dekubitus (Braden Score)</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Dekubitus</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="activasntrain" id="activasntrainShow">
                    <div class="row">
                        <h5 class="text-start">Aktivitas Dan Latihan</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Tingkat Ketergantungan ADL</b>
                                <p>isiiiii</p>
                            </td>
                            <td>
                                <b>Gangguan Pemenuhan Kebutuhan Aktifitas</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="diagkeperawatan" id="diagkeperawatanShow">
                    <div class="row">
                        <h5 class="text-start">Diagnosis Keperawatan</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Nama Diagnosis</b>
                                <p>isiiiii</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="tindakKolab" id="tindakKolabShow">
                    <div class="row">
                        <h5 class="text-start">1. Tindakan Kolaborasi</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>
                                Tanggal & Jam
                            </th>
                            <th>
                                Tindakan Keperawatan
                            </th>
                            <th>
                                Nama Terang
                            </th>
                        </tr>
                        <tr>
                            <td>isiii tgl</td>
                            <td>isiii Tindakan</td>
                            <td>isiii Nama</td>
                        </tr>
                    </table>
                </div>

                <div class="tindakMan" id="tindakManShow">
                    <div class="row">
                        <h5 class="text-start">2. Tindakan Mandiri</h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>
                                Tanggal & Jam
                            </th>
                            <th>
                                Tindakan Keperawatan
                            </th>
                            <th>
                                Nama Terang
                            </th>
                        </tr>
                        <tr>
                            <td>isiii tgl</td>
                            <td>isiii Tindakan</td>
                            <td>isiii Nama</td>
                        </tr>
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


                const htmlView = ` `

                $('#data-container').append(htmlView);


            });

            toggleDynamicVisibility(statusVisibility, selectedValue);

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