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
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

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
        <p>Diagnosa : <?= $val[0]['description']; ?></p>
        <table class="table table-bordered">
            <tr>
                <td>No</td>
                <td>Tanggal</td>
                <td>Program Fisioterapi</td>
                <td>Tindakan Fisioterapi</td>
                <td>Paraf</td>
            </tr>
            <?php foreach ($val as $key => $data) : ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $data['vactination_date']; ?></td>
                    <td><?= $data['tarif_name']; ?></td>
                    <td><?= $data['terapi_desc']; ?></td>
                    <td>
                        <div class="row">
                            <div class="col-auto" align="center">
                                <div class="mb-1">
                                    <div id="qrcode2"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="row">
            <div class="col-auto" align="center">
                <div>Tanda Tangan Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Tanda Tangan Pasien/Keluarga</div>
                <div class="mb-1">
                    <div id="qrcode1"></div>
                </div>
            </div>
        </div>
        <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: '<?= @@$visit['fullname']; ?>',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: '<?= @$visit['diantar_oleh']; ?>',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode2"), {
        text: '<?= @@$visit['fullname']; ?>',
        width: 40,
        height: 40,
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