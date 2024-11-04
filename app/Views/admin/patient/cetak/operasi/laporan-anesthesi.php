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
            <div class="col-auto text-center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
            </div>
            <div class="col text-center">
                <h3><?= @$organization['name_of_org_unit'] ?></h3>
                <!-- <h3>Surakarta</h3> -->
                <p><?= @$organization['contact_address'] ?></p>
            </div>
            <div class="col-auto text-center">
                <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
            </div>
        </div>
        <div class="row">
            <h4 class="text-center"><?= $title; ?></h4>
        </div>
        <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" style="width:33.3%">
                        <b>Nomor RM</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Nama Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['diantar_oleh']; ?></p>
                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Jenis Kelamin</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['gendername']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" style="width:33.3%">
                        <b>Tanggal Lahir (Usia)</b>
                        <p class="m-0 mt-1 p-0"><?= tanggal_indo($visit['date_of_birth']) . ' (' . @$visit['age'] . ')'; ?></p>

                    </td>
                    <td class="p-1" style="width:66.3%" colspan="2">
                        <b>Alamat Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['visitor_address']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>DPJP</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['fullname_inap']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Department</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic_from']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Tanggal Masuk</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['in_date'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Kelas</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['class_room']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Bangsal/Kamar</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Bed</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['bed']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <h5>Informasi Medis</h5>
        <?php if (isset($informasiMedis)) : ?>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($informasiMedis as $key => $medis) : ?>
                    <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $key ?></b>
                        <p class="m-0 mt-1 p-0"><?= @$medis; ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif; ?>

        <h5>Pemeriksaan Fisik</h5>
        <table class="table table-bordered mb-2">
            <tbody>
                <tr>
                    <td>
                        <b>Tekanan Darah</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['tensi_atas'] . '/' . @$val['tensi_bawah']; ?> mmHg</p>
                    </td>
                    <td>
                        <b>Denyut Nadi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['nadi']; ?> x/m</p>
                    </td>
                    <td>
                        <b>Suhu Tubuh</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['suhu']; ?> &degC</p>
                    </td>
                    <td>
                        <b>Respiration Rate</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['respirasi']; ?> x/m</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Berat Badan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['bb']; ?> kg</p>
                    </td>
                    <td>
                        <b>Tinggi Badan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['tb']; ?> cm</p>
                    </td>
                    <td>
                        <b>SpO2</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['saturasi']; ?></p>
                    </td>
                    <td>
                        <b>BMI</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['bmi']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <?php
                // check jika data lokalis ada atau tidak
                if (!empty($lokalis)) {
                    // jika ada maka lakukan perulangan untuk menampilkan data
                    foreach ($lokalis as $key => $value) {
                        // jika data lokalis memiliki value score = 2 maka tampilkan
                        if ($value['value_score'] == 2) {
                            // jika key pada data adalah ganjil
                            if (($key + 1) % 2 != 0) {
                                // jika data bukan data terakhir 
                                if ($key + 1 != count($lokalis)) {
                                    echo '<tr>';
                                    echo '<td class="p-1" style="width: 50%;">'
                                        . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_desc'] . '</p>' .
                                        '</td>';
                                } else {
                                    echo '<tr>';
                                    echo '<td class="p-1" colspan="2" style="width: 50%;">'
                                        . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_desc'] . '</p>' .
                                        '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<td class="p-1" style="width: 50%;">'
                                    . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_desc'] . '</p>' .
                                    '</td>';
                                echo "<tr>";
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>

        <h5>Keadaan Umum</h5>
        <?php if (isset($keadaanUmum)) : ?>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($keadaanUmum as $key => $keadaan) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $key ?></b>
                        <p class="m-0 mt-1 p-0"><?= @$keadaan; ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
        <h5>Diagnosis</h5>
        <?php if (isset($diagnosa)) : ?>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($diagnosa as $key => $diag) : ?>
                    <div class="col-12 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$diag['diagnosa_name']; ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
        <h5>Perencanaan Anestesi</h5>
        <?php if (isset($perencanaanAnestesi)) : ?>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($perencanaanAnestesi as $key => $anestesi) : ?>
                    <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $key ?></b>
                        <p class="m-0 mt-1 p-0"><?= @$anestesi; ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
        <h5>Perencanaan Pasca Anestesi</h5>


        <div class="row">
            <div class="col-auto" align="center">
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>pasien</div>
                <div class="mb-1">
                    <div id="qrcode1"></div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: `<?= $visit['fullname']; ?>`,
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: `<?= $visit['diantar_oleh']; ?>`,
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

</script>

</html>