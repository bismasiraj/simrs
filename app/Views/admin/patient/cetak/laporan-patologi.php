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
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
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
        <div class="row">
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="70px">
            </div>
            <div class="col mt-2">
                <h3><?= $organization['name_of_org_unit']; ?></h3>
                <p><?= $organization['contact_address']; ?></p>
            </div>
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/kemenkes.png') ?>" width="70px">
                <img class="mt-2" src="<?= base_url('assets/img/kars-bintang.png') ?>" width="70px">
            </div>
        </div>
        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
        <h3 class="text-center mb-0 my-1">HASIL PEMERIKSAAN PATOLOGI ANATOMI</h3>
        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
        <table class="table table-borderless mb-0">
            <tr>
                <td width="20%">Nama</td>
                <td width="1%">:</td>
                <td colspan="2"><?= $visit['diantar_oleh']; ?></td>
                <td width="20%">No.RM</td>
                <td width="1%">:</td>
                <td><?= $visit['no_registration']; ?></td>
            </tr>
            <tr>
                <td width="20%">Umur</td>
                <td width="1%">:</td>
                <td><?= $visit['age']; ?></td>
                <td>LP: <?= $visit['gendername']; ?></td>
                <td width="20%">Tanggal</td>
                <td width="1%">:</td>
                <td><?= date('d-m-Y') ?></td>
            </tr>
            <tr>
                <td width="20%">Alamat</td>
                <td width="1%">:</td>
                <td colspan="2"><?= $visit['contact_address']; ?></td>
                <td width="20%">Dokter Pengirim</td>
                <td width="1%">:</td>
                <td><?= $visit['fullname_from']; ?></td>
            </tr>
            <tr>
                <td width="20%">No Sampel</td>
                <td width="1%">:</td>
                <td colspan="2"><?= @$val['specimen_id']; ?></td>
                <td width="20%">No Transaksi</td>
                <td width="1%">:</td>
                <td><?= @$val['nota_no']; ?></td>
            </tr>
        </table>
        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;" class="mb-2"></div>
        <h3>Informasi Medis</h3>
        <br>
        <table class="table table-bordered">
            <tr>
                <td>
                    <b>Jenis Pemeriksaan</b>
                    <p class="p-1 mb-0 text-wrap"><?= $val['tarif_name']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Asal Jaringan</b>
                    <p class="p-1 mb-0 text-wrap"><?= $val['desc_english']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Diagnosa Klinis</b>
                    <p class="p-1 mb-0 text-wrap"><?= $val['description']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Makroskopik</b>
                    <p class="p-1 mb-0 text-wrap"><?= $val['result_english']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Mikroskopik</b>
                    <p class="p-1 mb-0 text-wrap"><?= $val['result_value']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Kesimpulan</b>
                    <p class="p-1 mb-0 text-wrap"><?= $val['conclusion']; ?></p>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div class="row justify-content-end px-3">
        <div class="col-auto" align="center">
            <div>Dokter</div>
            <div class="mb-1">
                <div id="qrcode"></div>
            </div>
        </div>
    </div>
    <br>
    <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: `<?= $visit['fullname_from']; ?>`,
        width: 70,
        height: 70,
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
    setTimeout(() => {
        window.print();
    }, 1000);
</script>

</html>