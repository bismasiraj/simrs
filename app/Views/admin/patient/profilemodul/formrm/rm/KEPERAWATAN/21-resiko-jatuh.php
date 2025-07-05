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
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>


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
            size: A4 landscape;
            /* Set page size to A4 in landscape orientation */
            margin: none;
        }

        body {
            margin: 0;
            font-size: 12px;
            width: 21cm;
            height: 29.7cm;
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

        .container-fluid {
            width: 100%;
            /* Adjust container width as needed */
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- template header -->
        <?= view("admin/patient/profilemodul/formrm/rm/template_header.php"); ?>
        <!-- end of template header -->

        <div class="row">
            <h5 class="text-start">Monitoring Resiko Jatuh</h5>
        </div>
        <table class="table table-bordered">
            <thead class="fw-bold">
                <tr>
                    <td>Tanggal</td>
                    <td>Alat Ukur Resiko Jatuh</td>
                    <td>Skor Resiko Jatuh</td>
                    <td>Intervensi</td>
                    <td>Petugas</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($val as $key => $data) : ?>
                    <tr>
                        <td><?= tanggal_indo(date_format(date_create($data['tanggal']), 'Y-m-d')); ?></td>
                        <td><?= $data['alat_ukur']; ?></td>
                        <td><?= $data['total_value_score'] <= 11 ? 'Resiko Rendah | Skor 7-11' : 'Resiko Tinggi | Skor 12 Keatas'; ?></td>
                        <td><?= $data['intervensi']; ?></td>
                        <td><?= $data['modified_by']; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        @media print {
            @page {
                margin: none;
                size: landscape;

            }

            .container-fluid {
                width: 100%;
                /* Set to 100% for full width */
            }

            body {
                margin: 0;
                font-size: 12px;
                width: auto;
                height: auto;
            }
        }
    </style>
    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>