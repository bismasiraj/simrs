<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>

    <style>
        .table-container-split {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .table-container-split table {
            width: 45%;
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

        thead.border {
            border-bottom: 1px solid black !important;
            border-top: 1px solid black !important;
        }

        tbody.border {
            border-bottom: 1px solid black !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
            autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>
            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="70px">
                </div>
                <div class="col mt-2">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p><?= @$kop['contact_address'] ?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/kemenkes.png') ?>" width="70px">
                    <img class="mt-2" src="<?= base_url('assets/img/kars-bintang.png') ?>" width="70px">
                </div>
            </div>
            <br>
            <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

            <div class="container p-3">
                <table class="table table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <td class="text-center fw-bold">DIAGNOSA</td>
                            <td colspan="6">: <?php
                                                $descriptions = array_column($dataTables, 'description');
                                                echo implode(', ', $descriptions);
                                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">Permintaan Terapi</td>
                            <td colspan="6">: <?php
                                                $descriptions = array_column($dataTables, 'terapi_desc');
                                                echo implode(', ', $descriptions);
                                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle fw-bold" rowspan="2">PROGRAM</td>
                            <td class="text-center align-middle fw-bold" rowspan="2">TANGGAL</td>
                            <td colspan="2" class="text-center align-middle fw-bold">WAKTU
                                PELAYANAN</td>
                            <td class="text-center align-middle fw-bold" rowspan="2">PASIEN</td>
                            <td class="text-center align-middle fw-bold" rowspan="2">DOKTER</td>
                            <td class="text-center align-middle fw-bold" rowspan="2">TERAPIS</td>
                        </tr>
                        <tr>
                            <td class="text-center">Mulai</td>
                            <td class="text-center">Selesai</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        foreach ($dataTables as $data) :
                        ?>
                            <tr>
                                <td><?= $index++; ?>. <?= $data['teraphy_conclusion']; ?></td>
                                <td class="text-center"><?= $data['vactination_date']; ?></td>
                                <td class="text-center"><?= $data['start_date']; ?></td>
                                <td class="text-center"><?= $data['end_date']; ?></td>
                                <td class="text-center"><?= $data['thename']; ?></td>
                                <td class="text-center"><?= $data['doctor']; ?></td>
                                <td class="text-center"><?= $data['tarif_name']; ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>



            <div class="row mb-2">
                <div class="col-3" align="center">


                </div>
                <div class="col"></div>
                <div class="col-3" align="center">
                    <div>
                        <div id="datetime-now"></div><br>
                    </div>
                    <div>
                        <div class="pt-2 pb-2" id="qrcode1"></div>
                    </div>
                    <div id="validator-ttd"></div>
                </div>
            </div>
        </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

<script>
    $(document).ready(function() {
        $("#datetime-now").html(`Surakarta,${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>

        var qrcode = new QRCode(document.getElementById("qrcode1"), {
            text: `${data?.pengirim_name}`, // Your text here
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H // High error correction
        });

        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: `${data?.pengirim_name}`, // Your text here
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H // High error correction
        });

    })
</script>
<style>
    @media print {
        @page {
            margin: none;
            /* scale: 85; */
        }

        .container {
            width: 100%;
            /* Sesuaikan dengan lebar kertas A4 */
        }

        td {
            background-color: inherit;
            color: inherit;
            border: inherit;
            padding: inherit;
            text-align: inherit;
        }

    }
</style>

<script type="text/javascript">
    window.print();
</script>

</html>