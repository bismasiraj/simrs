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
            <h4 class="text-start">Subjektif (S)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width: 33%;">
                        <b>Keluhan Utama (Autoanamnesis)</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['anamnesis']; ?></p>
                        <b>Keluhan Utama (Alloanamnesis)</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['alloanamnesis']; ?></p>
                    </td>
                    <td style="width: 33%;">
                        <b>Riwayat Penyakit Sekarang</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['riwayat_penyakit_sekarang']; ?></p>
                        <b>Riwayat Penyakit Dahulu</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['riwayat_penyakit_dahulu']; ?></p>
                    </td>
                    <td>
                        <b>Riwayat Penyakit Keluarga</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['riwayat_penyakit_keluarga']; ?></p>
                        <b>Riwayat Obat Yang Dikonsumsi</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['riwayat_obat_dikonsumsi']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Obyektif (O)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="4"><b>Vital Sign</b></td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Tekanan Darah</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['tensi_atas']; ?> / <?= @$val['tensi_bawah']; ?></p>mmHg
                    </td>
                    <td class="p-1">
                        <b>Denyut Nadi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['tensi_atas']; ?> / <?= @$val['tensi_bawah']; ?></p>m
                    </td>
                    <td class="p-1">
                        <b>Suhu Tubuh</b>
                        <div class="input-group">
                            <p class="m-0 mt-0 p-0"><?= @$val['suhu']; ?> </p>℃
                        </div>
                    </td>
                    <td class="p-1">
                        <b>Respiration Rate</b>
                        <div class="input-group">
                            <p class="m-0 mt-0 p-0"><?= @$val['respiration']; ?></p>x/m
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>SpO2</b>
                        <div class="input-group">
                            <p class="m-0 mt-0 p-0"><?= @$val['spo2']; ?></p>
                        </div>
                    </td>
                    <td class="p-1">
                        <b>Berat Badan</b>
                        <div class="input-group">
                            <p class="m-0 mt-0 p-0"><?= @$val['berat']; ?></p>kg
                        </div>
                    </td>
                    <td colspan="2">
                        <b><i>GCS / Tingkat Kesadaran</i></b>
                        <p class="m-0 mt-0 p-0"><?= @$val['gcs']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <?php
                // check jika data lokalis ada atau tidak
                if (!empty($lokalis2)) {
                    // jika ada maka lakukan perulangan untuk menampilkan data
                    foreach ($lokalis2 as $key => $value) {
                        // jika data lokalis memiliki value score = 2 maka tampilkan
                        if ($value['value_score'] == 2) {
                            // jika key pada data adalah ganjil
                            if (($key + 1) % 2 != 0) {
                                // jika data bukan data terakhir 
                                if ($key + 1 != count($lokalis2)) {
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
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width: 50%;">
                        <b>Diagnosis Masuk</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['pdiagnosa']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Procedure Masuk</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['pprocedures']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Indikasi Rawat Inap</b>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Diagnosis Pulang</b>
                        <textarea type="text" class="form-control" id="" name=""><?= @$val['pdiagnosa']; ?></textarea>
                    </td>
                    <td class="p-1">
                        <b>Procedure Pulang</b>
                        <textarea type="text" class="form-control" id="" name=""><?= @$val['pprocedures']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Status/Cara Pulang</b>
                        <p class="m-0 mt-0 p-0"></p>
                    </td>
                    <td class="p-1">
                        <b>Kondisi Pulang</b>
                        <p class="m-0 mt-0 p-0"></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Penunjang Medis</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Laboratorium</b>
                        <textarea type="text" class="form-control" id="laboratorium" name="laboratorium"><?= @$val['laboratorium']; ?></textarea>
                    </td>
                    <td class="p-1">
                        <b>Radiologi</b>
                        <textarea type="text" class="form-control" id="radiologi" name="radiologi"><?= @$val['radiologi']; ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Terapi Obat (Farmakoterapi)</h4>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>
                        <b>Nama Resep</b>
                    </td>
                    <td>
                        <b>Signature</b>
                    </td>
                    <td>
                        <b>Mulai Terapi</b>
                    </td>
                    <td>
                        <b>Selesai Terapi</b>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p class="m-0 mt-0 p-0"><?= @$val['farmakologia']; ?></p>
                    </td>
                    <td>
                        <p class="m-0 mt-0 p-0"><?= @$recipe['signatura'] ?></p>
                    </td>
                    <td>
                        <p class="m-0 mt-0 p-0"><?= @$recipe['tanggal_mulai'] ?></p>
                    </td>
                    <td>
                        <p class="m-0 mt-0 p-0"><?= @$recipe['tanggal_selesai'] ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Take Home Prescription</h4>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>
                        <b>Nama Resep</b>

                    </td>
                    <td>
                        <b>Signature</b>

                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p class="m-0 mt-0 p-0"><?= @$val['farmakologia']; ?></p>
                    </td>
                    <td>
                        <p class="m-0 mt-0 p-0"><?= @$recipe['signatura'] ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row mb-3">
            <div class="col">
                <b>Terapi Tindakan (Procedure)</b>
            </div>
        </div>
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
        text: '<?= @$val['dpjp']; ?>',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: '<?= @$val['nama']; ?>',
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