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
        <div class="row mb-5">
            <div class="col-2 d-flex">
                <img class="mt-2 mx-auto" src="<?= base_url('assets/img/logo.png') ?>" style="width: 110px; height: 110px;">
            </div>
            <div class="col-6">
                <h3><?= @$organization['name_of_org_unit'] ?></h3>
                <h5><?= strtoupper(@$organization['kota']) ?></h5>
                <b><?= @$organization['contact_address'] ?></b>
                <br>
                <b><?= 'Telp ' . @$organization['phone'] . ' Fax: ' . @$organization['fax'] ?></b>
            </div>
            <div class="col-4">
                <div class="border border-1 d-flex justify-content-center align-items-center" style="height: 100px;">
                    <span>Label Identitas Pasien</span>
                </div>
            </div>
        </div>
        <b>Lembar Hasil Tindakan Uji Fungsi / Prosedur KFR …………………... (Koding: ………………..)</b>

        <!-- end of template header -->
        <table class="table table-bordered">
            <tr>
                <td>Tanggal Pemeriksaan</td>
                <td></td>
            </tr>
            <tr>
                <td>Diagnosis Fungsional</td>
                <td></td>
            </tr>
            <tr>
                <td>Diagnosis medis</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">Instrumen Uji Fungsi/ Prosedur KFR</td>
            </tr>
            <tr>
                <td>Hasil yang didapat</td>
                <td></td>
            </tr>
            <tr>
                <td>Kesimpulan</td>
                <td></td>
            </tr>
            <tr>
                <td>Rekomendasi</td>
                <td></td>
            </tr>

        </table>
        <div class="row justify-content-end">
            <div class="col-auto" align="center">
                <div class="mb-2"><?= $organization['kota'] . ', ' . tanggal_indo(date('Y-m-d')); ?></div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
                <?= @$visit['fullname']; ?>
            </div>
        </div>
        <br><br>
        <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: '<?= @$visit['fullname']; ?>',
        width: 100,
        height: 100,
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