<!doctype html>
<html lang="en">
<?php

$selectedStatus = isset($_POST['selected-status']) ? $_POST['selected-status'] : '';
$selectedStatusFilter = isset($_POST['selected-status-filter']) ? $_POST['selected-status-filter'] : $data[0]['clinic'];

$validSub = ["P003", "P006", "P007","P009", "P008","P004","P010","P001","P005","P012", "all"];
$validVitail = ["P003", "P006", "P007","P009", "P008","P004","P010","P001","P005","P012", "all"];

$validGsc = ["P006", "P007","P009", "P008","P004","P010","P001","P005","P012", "all"];
$validSkala = ["P006", "P009", "P008","P004","P010","P001","P005","all"];

$validAssNew = ["P008","all"];
$validFisik = ["P003","P010","P001","P012", "all"];
$validHamil = ["P004","all"];
$validAssessment = ["P003", "P006", "P007","P009", "P008","P004","P010","P001","P005","P012", "all"];
$validPlanning = ["P003", "P006", "P007","P009", "P008","P004","P010","P001","P005","P012", "all"];
$validRencanaAsuhan = ["P003", "P006", "P007","P009", "P008","P004","P010","P001","P005","P012", "all"];
$validRencanaTindakLanjut = ["P003", "P006", "P007","P009", "P008","P004","P010","P001","P005","P012", "all"];
$validstatusDermatologi = ["P009","all"];
$validApgar = ["P003"];
$validsaraf = ["P006"];
$validpsikiatri = ["P007"];


$vitailShow = in_array($selectedStatusFilter, $validVitail);
$gscShow =in_array($selectedStatusFilter, $validGsc);
$skalaShow=in_array($selectedStatusFilter, $validSkala);
$assNewShow=in_array($selectedStatusFilter, $validAssNew);
$fisikShow=in_array($selectedStatusFilter, $validFisik);
$hamilShow=in_array($selectedStatusFilter, $validHamil);
$AssessmentShow=in_array($selectedStatusFilter, $validAssessment);
$PlanningShow=in_array($selectedStatusFilter, $validPlanning);
$RencanaAsuhanShow=in_array($selectedStatusFilter, $validRencanaAsuhan);
$RencanaTindakLanjutShow=in_array($selectedStatusFilter, $validRencanaAsuhan);
$statusDermatologiShow =in_array($selectedStatusFilter, $validstatusDermatologi);
$ApgarShow =in_array($selectedStatusFilter, $validApgar);
$SarafShow =in_array($selectedStatusFilter, $validsaraf);
$PsikiatriShow =in_array($selectedStatusFilter, $validpsikiatri);


// var_dump($data[0]);
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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
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
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                        <?= @$kop['fax'] ?? "-"?>,
                        <?= @$kop['kota'] ?? "-"?></p>
                    <p><?= @$kop['sk'] ?? "-"?></p>
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
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match('#<table.*?>(.*?)</table>#is', $html, $matches);

                if (isset($matches[0])) {
                echo $matches[0];
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="anamnesa" id="anamnesaShow">
                <div class="row">
                    <h4 class="text-start">Anamnesa</h4>
                </div>
                <?php
                    $html = @$item['data']['final_note'];
                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);
                if (isset($matches)) {
                echo ($matches[0][1]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="historynlifestyle" id="historynlifestyleShow">
                <div class="row">
                    <h4 class="text-start">Riwayat & Gaya Hidup</h4>
                </div>

                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][2]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="vitailsign" id="vitailsignShow">

                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][3]);
                } else {
                echo "No table found!";
                }
                ?>

            </div>

            <div class="RencanaAsuhandanTerapi" id="RencanaAsuhanShow">
                <div class="row">
                    <h5 class="text-start">Skrining Gizi</h5>
                </div>

                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][4]);
                } else {
                echo "No table found!";
                }
                ?>

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
                                                        <?= @$item['data']['numeric_score'] 
                                                        ? nl2br((@$item['data']['numeric_score'])) 
                                                        : nl2br((@$item['data']['wong_baker_score'])); ?>
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
                                                    <span class="col-12">
                                                        <?= nl2br(@$item['data']['fm_descriptions']); ?>
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

                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][4]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="psikologis" id="psikologisShow">
                <div class="row">
                    <h5 class="text-start">Psikologis Spiritual</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][5]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="sosialEkonomi" id="sosialEkonomiShow">
                <div class="row">
                    <h5 class="text-start">Sosial Ekonomi</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][6]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="integumen" id="integumenShow">
                <div class="row">
                    <h5 class="text-start">Integumen & Muskulo Skeletal</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][7]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="assNeurosensoris" id="assNeurosensorisShow">
                <div class="row">
                    <h5 class="text-start">Asesmen Neurosensoris</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][8]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="assSirkulasi" id="assSirkulasiShow">
                <div class="row">
                    <h5 class="text-start">Asesmen Sirkulasi</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][9]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="pencernaan" id="pencernaanShow">
                <div class="row">
                    <h5 class="text-start">Pencernaan</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][10]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="pernapasan" id="pernapasanShow">
                <div class="row">
                    <h5 class="text-start">Pernapasan</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][11]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="perkemihan" id="perkemihanShow">
                <div class="row">
                    <h5 class="text-start">Perkemihan</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][12]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="seksual" id="seksualShow">
                <div class="row">
                    <h5 class="text-start">Seksual/Reproduksi</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][13]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="thtneye" id="thtneyeShow">
                <div class="row">
                    <h5 class="text-start">THT & MATA</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][14]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="childSpecial" id="childSpecialShow">
                <div class="row">
                    <h5 class="text-start">Khusus Anak</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][15]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="sleepnChill" id="sleepnChillShow">
                <div class="row">
                    <h5 class="text-start">Tidur Dan Istirahat</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][16]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="dekubitus" id="dekubitusShow">
                <div class="row">
                    <h5 class="text-start">Dekubitus</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][17]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="activasntrain" id="activasntrainShow">
                <div class="row">
                    <h5 class="text-start">Aktivitas Dan Latihan</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][18]);
                } else {
                echo "No table found!";
                }
                ?>
            </div>

            <div class="diagkeperawatan" id="diagkeperawatanShow">
                <div class="row">
                    <h5 class="text-start">Diagnosis Keperawatan</h5>
                </div>
                <?php
                    $html = @$item['data']['final_note'];

                    preg_match_all('#<\s*table[^>]*>.*?</\s*table\s*>#is', $html, $matches);


                if (isset($matches)) {
                echo ($matches[0][19]);
                } else {
                echo "No table found!";
                }
                ?>
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
        }, 'admin/rm/LAINNYA/assessmen_perawat_preview', (res) => {
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
            console.log(e);

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


            const htmlView = `<div class="container-fluid mt-5" id="body-show-<?= $index ?>">
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                        <?= @$kop['fax'] ?? "-"?>,
                        <?= @$kop['kota'] ?? "-"?></p>
                    <p><?= @$kop['sk'] ?? "-"?></p>
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
                            <p class="m-0 mt-1 p-0 ">
                            ${e.data?.date_of_birth ? moment(e.data?.date_of_birth).format("DD/MM/YYYY"): "-"}
                            </p>
                        </td>
                        <td class="p-1" style="width:66.3%" colspan="2">
                            <b>Alamat Pasien</b>
                            <p class="m-0 mt-1 p-0">
                            ${e.data?.contact_address ?? "-"}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p class="m-0 mt-1 p-0">
                                ${e.data?.doctor ?? "-"}
                            </p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p class="m-0 mt-1 p-0">
                                ${e.data?.doctor ?? "-"}
                            </p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0 ">
                                  ${e.data?.create_date ? moment(e.data?.create_date).format("DD/MM/YYYY"): "-"}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>



            <div class="triage" id="triageShow">
                <div class="row">
                    <h4 class="text-start">Triage</h4>
                </div>
                   ${e.data?.triage_desc ? ((e.data.triage_desc))  : ""}
            </div>

            <div class="anamnesa" id="anamnesaShow">
                <div class="row">
                    <h4 class="text-start">Anamnesa</h4>
                </div>
                   ${e.data?.anamnesa_desc ? ((e.data.anamnesa_desc))  : ""}
            </div>

            <div class="historynlifestyle" id="historynlifestyleShow">
                <div class="row">
                    <h4 class="text-start">Riwayat & Gaya Hidup</h4>
                </div>
                   ${e.data?.lifestyle_desc ? ((e.data.lifestyle_desc))  : ""}
            </div>

            <div class="vitailsign" id="vitailsignShow">
                   ${e.data?.vital_sign_desc ? ((e.data.vital_sign_desc))  : ""}
            </div>

            <div class="RencanaAsuhandanTerapi" id="RencanaAsuhanShow">
                <div class="row">
                    <h5 class="text-start">Skrining Gizi</h5>
                </div>
                   ${e.data?.nutrition_desc ? ((e.data.nutrition_desc))  : ""}
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
                                                    <span class="col-12">
                                                     ${e.data?.numeric_score ? nl2br1(e.data?.numeric_score) : nl2br1(e.data?.wong_baker_score)}
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
                                                    <span class="col-12">
                                                     ${!e.data?.fm_descriptions ? "-":nl2br1(e.data?.fm_descriptions) }
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
                   ${e.data?.adl_desc ? ((e.data.adl_desc))  : ""}
            </div>

            <div class="psikologis" id="psikologisShow">
                <div class="row">
                    <h5 class="text-start">Psikologis Spiritual</h5>
                </div>
                   ${e.data?.psychology_desc ? ((e.data.psychology_desc))  : ""}
            </div>

            <div class="sosialEkonomi" id="sosialEkonomiShow">
                <div class="row">
                    <h5 class="text-start">Sosial Ekonomi</h5>
                </div>
                   ${e.data?.sosec_desc ? ((e.data.sosec_desc))  : ""}
            </div>

            <div class="integumen" id="integumenShow">
                <div class="row">
                    <h5 class="text-start">Integumen & Muskulo Skeletal</h5>
                </div>
                   ${e.data?.integumen_desc ? ((e.data.integumen_desc))  : ""}
            </div>

            <div class="assNeurosensoris" id="assNeurosensorisShow">
                <div class="row">
                    <h5 class="text-start">Asesmen Neurosensoris</h5>
                </div>
                   ${e.data?.neurosensoris_desc ? ((e.data.neurosensoris_desc))  : ""}
            </div>

            <div class="assSirkulasi" id="assSirkulasiShow">
                <div class="row">
                    <h5 class="text-start">Asesmen Sirkulasi</h5>
                </div>
                   ${e.data?.circulation_desc ? ((e.data.circulation_desc))  : ""}
            </div>

            <div class="pencernaan" id="pencernaanShow">
                <div class="row">
                    <h5 class="text-start">Pencernaan</h5>
                </div>
                   ${e.data?.disgetive_desc ? ((e.data.disgetive_desc))  : ""}
            </div>

            <div class="pernapasan" id="pernapasanShow">
                <div class="row">
                    <h5 class="text-start">Pernapasan</h5>
                </div>
                   ${e.data?.respiratory_desc ? ((e.data.respiratory_desc))  : ""}
            </div>

            <div class="perkemihan" id="perkemihanShow">
                <div class="row">
                    <h5 class="text-start">Perkemihan</h5>
                </div>
                   ${e.data?.urinaria_desc ? ((e.data.urinaria_desc))  : ""}
            </div>

            <div class="seksual" id="seksualShow">
                <div class="row">
                    <h5 class="text-start">Seksual/Reproduksi</h5>
                </div>
                   ${e.data?.obsgyn_desc ? ((e.data.obsgyn_desc))  : ""}
            </div>

            <div class="thtneye" id="thtneyeShow">
                <div class="row">
                    <h5 class="text-start">THT & MATA</h5>
                </div>
                   ${e.data?.matatht_desc ? ((e.data.matatht_desc))  : ""}
            </div>

            <div class="childSpecial" id="childSpecialShow">
                <div class="row">
                    <h5 class="text-start">Khusus Anak</h5>
                </div>
                   ${e.data?.pediatric_desc ? ((e.data.pediatric_desc))  : ""}
            </div>

            <div class="sleepnChill" id="sleepnChillShow">
                <div class="row">
                    <h5 class="text-start">Tidur Dan Istirahat</h5>
                </div>
                   ${e.data?.rest_sleep_desc ? ((e.data.rest_sleep_desc))  : ""}
            </div>

            <div class="dekubitus" id="dekubitusShow">
                <div class="row">
                    <h5 class="text-start">Dekubitus</h5>
                </div>
                   ${e.data?.decubitus_desc ? ((e.data.decubitus_desc))  : ""}
            </div>

            <div class="activasntrain" id="activasntrainShow">
                <div class="row">
                    <h5 class="text-start">Aktivitas Dan Latihan</h5>
                </div>
                   ${e.data?.training_desc ? ((e.data.training_desc))  : ""}
            </div>

            <div class="diagkeperawatan" id="diagkeperawatanShow">
                <div class="row">
                    <h5 class="text-start">Diagnosis Keperawatan</h5>
                </div>
                   ${e.data?.nurse_diagnose_desc ? ((e.data.nurse_diagnose_desc))  : ""}
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


        </div>`

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