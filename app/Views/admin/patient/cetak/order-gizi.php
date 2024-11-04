<?php
$jamMakan = '';
switch ($shift) {
    case 'pagi':
        $jamMakan = '07.30';
        break;
    case 'siang':
        $jamMakan = '13.00';
        break;
    case 'malam':
        $jamMakan = '19.00';
        break;
}

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
    <script src="<?= base_url('/assets/js/default.js') ?>"></script>
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
            font-size: 10px;
        }

        @page {
            size: 80mm auto;
            /* Width 80mm, height auto */
        }

        body {
            width: 7.5cm;
            height: 4.5cm;
            margin: 0;
            font-size: 8px;
        }

        tr td,
        th {
            padding-top: 0px !important;
            padding-right: 0px !important;
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
    <div class="container mt-3">
        <div class="row">
            <div class="border border-1">
                <div class="d-flex justify-content-center align-items-center py-2">
                    <b>Makan <?= $shift; ?> | Tanggal <?= date_format(date_create($date), 'd-m-Y'); ?></b>
                </div>
                <hr class="mt-0">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td width="65px">Nama</td>
                        <td width="1%">:</td>
                        <td><?= $data['name_of_pasien']; ?></td>
                    </tr>
                    <tr>
                        <td width="65px">No.RM</td>
                        <td width="1%">:</td>
                        <td><?= $data['no_registration']; ?></td>
                    </tr>
                    <tr>
                        <td width="65px">Tanggal Lahir</td>
                        <td width="1%">:</td>
                        <td><?= ''; ?></td>
                    </tr>
                    <tr>
                        <td width="65px">Ruangan</td>
                        <td width="1%">:</td>
                        <td><?= $clinic_name; ?></td>
                    </tr>
                    <tr>
                        <td width="65px">Diet</td>
                        <td width="1%">:</td>
                        <td><?= $data['bentuk'] . ', ' . $data['jenis'] . ', ' . $data['mineral'] . ', ' . $data['extra']; ?></td>
                    </tr>
                </table>
                <p class="text-center py-2 mb-0 fw-bold">Batas maksimal makanan dikonsumsi pada pukul <?= $jamMakan; ?></p>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>


<style>
    @media print {
        @page {
            margin: none;
            scale: 85;
        }

        .container {
            width: 80mm;
            /* Sesuaikan dengan lebar kertas thermal */
            height: auto;
            /* Sesuaikan tinggi sesuai kebutuhan */
            margin: 0 auto;
            /* Pusatkan kontainer */
        }
    }
</style>
<script type="text/javascript">
    // setTimeout(() => {
    //     window.print();
    // }, 1000);
</script>

</html>