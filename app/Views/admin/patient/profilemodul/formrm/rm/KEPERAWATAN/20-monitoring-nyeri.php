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
    <div class="container-fluid">

        <!-- template header -->
        <?= view("admin/patient/profilemodul/formrm/rm/template_header.php"); ?>
        <!-- end of template header -->

        <table class="table table-bordered">
            <thead class="fw-bold">
                <tr>
                    <td rowspan="2">Tanggal</td>
                    <td rowspan="2">Asesmen</td>
                    <td rowspan="2">Alat Ukur Nyeri</td>
                    <td rowspan="2">Score Nyeri</td>
                    <td colspan="3">Intervensi</td>
                    <td rowspan="2">Re-Assessment</td>
                    <td rowspan="2">Asesmen Selanjutnya</td>
                    <td rowspan="2">Petugas</td>
                </tr>
                <tr>
                    <td>Tgl Intervensi</td>
                    <td>Intervensi</td>
                    <td>Rute</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($val as $key => $data) : ?>
                    <tr>
                        <td><?= tanggal_indo(date_format(date_create($data['tgl']), 'Y-m-d')) . ' ' . date('H:i', strtotime($data['tgl'])); ?></td>
                        <td><?= $data['assesment']; ?></td>
                        <td><?= $data['alat_ukur']; ?></td>
                        <td><?= $data['total_score'] <= 11 ? 'Resiko Rendah | Skor 7-11' : 'Resiko Tinggi | Skor 12 Keatas'; ?></td>
                        <td><?= tanggal_indo(date_format(date_create($data['intervensi_date']), 'Y-m-d')) ?></td>
                        <td><?= $data['intervensi']; ?></td>
                        <td><?= $data['rute']; ?></td>
                        <td><?= $data['reassessment']; ?></td>
                        <td><?= tanggal_indo(date_format(date_create($data['reassessment_date']), 'Y-m-d')); ?></td>
                        <td><?= $data['petugas']; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

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