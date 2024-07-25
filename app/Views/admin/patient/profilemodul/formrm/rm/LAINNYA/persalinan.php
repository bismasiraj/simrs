<?php
// echo "<pre>";
// var_dump($val);
// die();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
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
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <!-- template header -->
        <?= view("admin/patient/profilemodul/formrm/rm/template_header.php"); ?>
        <!-- end of template header -->

        <div class="row">
            <h4>Laporan Persalinan</h4>
        </div>
        <table class="table table-bordered">
            <tr>
                <td></td>
            </tr>
        </table>
        <div class="row">
            <h4>Ikhtisar Persalinan</h4>
        </div>
        <table class="table table-bordered mb-2">
            <tr>
                <td>
                    <b>Rupture</b>

                </td>
                <td>
                    <b>Waktu</b>

                </td>
                <td>
                    <b>Warna</b>

                </td>
            </tr>
            <tr>
                <td>
                    <b>Tekanan Darah</b>

                </td>
                <td>
                    <b>Nadi</b>

                </td>
                <td>
                    <b>Suhu</b>

                </td>
            </tr>
            <tr>
                <td>
                    <b>Freq. Pernapasan</b>

                </td>
                <td>
                    <b>Berat Badan</b>

                </td>
                <td>
                    <b>Tinggi Badan</b>

                </td>
            </tr>
            <tr>
                <td>
                    <b>Tinggi Fundus Uteri</b>

                </td>
                <td>
                    <b>Kontraks Uterus</b>

                </td>
                <td>
                    <b></b>

                </td>
            </tr>
        </table>
        <table class="table table-bordered mb-2">
            <tr>
                <td colspan="2">
                    <b>Pendarahan</b>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Kala I</b>

                </td>
                <td>
                    <b>Kala II</b>

                </td>
                <td>
                    <b>Kala III</b>

                </td>
                <td>
                    <b>Kala IV</b>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Placenta</b>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Lahir</b>

                </td>
                <td>
                    <b>Keadaan Lahir</b>

                </td>
                <td>
                    <b>Berat</b>

                </td>
                <td>
                    <b>Bentuk</b>

                </td>
            </tr>
            <tr>
                <td>
                    <b>Tali Pusat</b>

                </td>
                <td>
                    <b>Selaput Ketuban</b>

                </td>
                <td>
                    <b>Kotiledon</b>

                </td>
                <td>
                    <b>Insersio</b>

                </td>
            </tr>
        </table>
        <div class="row">
            <h4>Keadaan Anak Lahir</h4>
        </div>
        <table class="table table-bordered mb-2">
            <tr>
                <th colspan="3">Anak Ke-1</th>
            </tr>
            <tr>
                <td>
                    <b>Waktu Lahir</b>

                </td>
                <td>
                    <b>Jenis Patrus</b>

                </td>
                <td>
                    <b>Indikasi</b>

                </td>
            </tr>
            <tr>
                <td>
                    <b>Lahir</b>

                </td>
                <td>
                    <b>Jenis Kelamin</b>

                </td>
                <td>
                    <b>BB / PB</b>

                </td>
            </tr>
            <tr>
                <td>
                    <b>Lingkar Kepala</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['lingkar_kepala']) ? '-' : @$neonatus['lingkar_kepala']; ?></p>
                </td>
                <td>
                    <b>Lingkar Dada</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['lingkar_dada']) ? '-' : @$neonatus['lingkar_dada']; ?></p>
                </td>
                <td>
                    <b>SpO2</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['spo2']) ? '-' : @$neonatus['spo2']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Tekanan Darah</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['lingkar_kepala']) ? '-' : @$neonatus['lingkar_kepala']; ?></p>
                </td>
                <td>
                    <b>Nadi</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['lingkar_kepala']) ? '-' : @$neonatus['lingkar_kepala']; ?></p>
                </td>
                <td>
                    <b>Suhu</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['lingkar_kepala']) ? '-' : @$neonatus['lingkar_kepala']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Respiration Rate</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['lingkar_kepala']) ? '-' : @$neonatus['lingkar_kepala']; ?></p>
                </td>
                <td>
                    <b>Kesan Umum</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['keadaan_umum']) ? '-' : @$neonatus['keadaan_umum']; ?></p>
                </td>
                <td>
                    <b>Pergerakan</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['pergerakan']) ? '-' : @$neonatus['pergerakan']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Warna Kulit</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['warna_kulit']) ? '-' : @$neonatus['warna_kulit']; ?></p>
                </td>
                <td>
                    <b>Turgor</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['turgor']) ? '-' : @$neonatus['turgor']; ?></p>
                </td>
                <td>
                    <b>Tonus</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['tonus']) ? '-' : @$neonatus['tonus']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Suara</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['suara']) ? '-' : @$neonatus['suara']; ?></p>
                </td>
                <td>
                    <b>Reflek Moro</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['reflek_moro']) ? '-' : @$neonatus['reflek_moro']; ?></p>
                </td>
                <td>
                    <b>Reflek Menghisap</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['reflek_menghisap']) ? '-' : @$neonatus['reflek_menghisap']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Memegang</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['memegang']) ? '-' : @$neonatus['memegang']; ?></p>
                </td>
                <td>
                    <b>Tonus Leher</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['tonus_leher']) ? '-' : @$neonatus['tonus_leher']; ?></p>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Resusitasi</b>
                    <p class="m-0 mt-1 p-0"><?= empty(@$neonatus['resusitasi']) ? '-' : @$neonatus['resusitasi']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Kelainan Kongenital</b>

                </td>
                <td>
                    <b>Sebab bayi lahir mati/lahir lalu meninggal</b>

                </td>
            </tr>
        </table>

        <div class="row">
            <h5 class="text-start">Apgar Score</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" width="25%"></td>
                    <?php foreach ($apgarWaktu as $key => $waktu) : ?>
                        <th class="p-1" width="25%"><?= $waktu['p_description'] ?></th>
                    <?php endforeach ?>
                </tr>
                <?php $totalSkor = 0; ?>
                <?php foreach ($apgarData as $key => $row) : ?>
                    <tr>
                        <th class="p-1" width="25%"><?= $row['parameter_desc'] ?></th>
                        <td class="p-1" width="25%"><?= '(' . $row['value_score_1'] . ') ' . $row['menit_1'] ?></td>
                        <td class="p-1" width="25%"><?= '(' . $row['value_score_5'] . ') ' . $row['menit_5'] ?></td>
                        <td class="p-1" width="25%"><?= '(' . $row['value_score_10'] . ') ' . $row['menit_10'] ?></td>
                    </tr>
                    <?php $totalSkor += $row['value_score_1'] + $row['value_score_5'] + $row['value_score_10']; ?>
                <?php endforeach ?>
                <tr>
                    <th class="p-1" width="25%">Total Skor</th>
                    <th class="p-1 text-center" width="75%" colspan="3"><?= $totalSkor ?></th>
                </tr>
            </tbody>
        </table>


        <div class="row">
            <div class="col-auto" align="center">
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Bidan</div>
                <div class="mb-1">
                    <div id="qrcode1"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: 'sa',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: 'sa',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
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
    }
</style>
<script type="text/javascript">
    window.print();
</script>

</html>