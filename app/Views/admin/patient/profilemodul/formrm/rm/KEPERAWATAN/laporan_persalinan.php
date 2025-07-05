<?php
// echo "<pre>";
// var_dump($neurosensoris);
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
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="<?= base_url('assets/libs/qrcode/qrcode.min.js') ?>"></script>

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

        .border-collide {
            margin-right: -.5px;
            /* Adjust margin to make borders overlap */
            margin-bottom: -.5px;
            /* Adjust margin to make borders overlap */
        }

        .border-custom {
            border-bottom: .5px solid #dee2e6;
            border-right: .5px solid #dee2e6;
            border-left: .5px solid #dee2e6;
            border-top: none;
            box-sizing: border-box;
        }

        .border-custom:first-child {
            border-right: .5px solid #dee2e6;
            border-left: .5px solid #dee2e6;
            border-bottom: none;
            border-top: .5px solid #dee2e6;
            box-sizing: border-box;
        }

        .border-custom:last-child {
            border-right: .5px solid #dee2e6;
            border-left: .5px solid #dee2e6;
            border-top: none;
            border-bottom: .5px solid #dee2e6;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">

        <!-- template header -->
        <?= view("admin/patient/profilemodul/formrm/rm/template_header.php"); ?>
        <!-- end of template header -->

        <div class="row mt-4">
            <div class="row">
                <h5 class="text-start"><b>Ikhtisar Persalinan</b></h5>
            </div>

            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($ikhtisar as $key => $value) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $value['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
        <div class="row mt-4">
            <div class="row">
                <h5 class="text-start"><b>Laporan Persalinan</b></h5>
            </div>

            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($laporanPersalinan as $key => $value) : ?>
                    <div class="col-12 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $value['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="row mt-4">
            <div class="row">
                <h5 class="text-start"><b>Perdarahan</b></h5>
            </div>

            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($perdarahan as $key => $value) : ?>
                    <div class="col-6 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $value['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
        <div class="row mt-4">
            <div class="row">
                <h5 class="text-start"><b>Placenta</b></h5>
            </div>

            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($placenta as $key => $value) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $value['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= ($value['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        </div>


        <?php
        foreach ($baby as $key => $value) {
            $exb = array_filter($exambaby, function ($value1) use ($value) {
                return $value1['document_id'] == $value['baby_id'];
            });
            // dd($exb);
        ?>
            <div class="row mt-4">
                <div class="row">
                    <h5 class="text-start"><b>Anak Ke-<?= $key + 1; ?> </b></h5>
                </div>

                <div class="d-flex flex-wrap mb-3">
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Waktu Lahir</b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['date_of_birth']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <?php $partus = ['', 'Spontan Pervaginam', 'Sectio Caesarea', 'Vacum Ekstraksi'] ?>
                        <b>Jenis Partus</b>
                        <p class="m-0 mt-1 p-0"><?= (@$partus[$value['partus']]); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Indikasi</b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['indication']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <?php $lahir = ['Mati', 'Hidup'] ?>
                        <b>Lahir</b>
                        <p class="m-0 mt-1 p-0"><?= (@$lahir[$value['birth_con']]); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <?php $jenisKelamin = ['-', 'Laki-laki',  'Perempuan', 'Ambigu'] ?>
                        <b>Jenis Kelamin</b>
                        <p class="m-0 mt-1 p-0"><?= (@$jenisKelamin[$value['gender']]); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Resusitasi</b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['resusitasi']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>BB(gr)</b>
                        <p class="m-0 mt-1 p-0"><?= (@$exb[0]['weight']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>PB(cm)</b>
                        <p class="m-0 mt-1 p-0"><?= (@$exb[0]['height']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Suhu(°C)</b>
                        <p class="m-0 mt-1 p-0"><?= (@$exb[0]['temperature']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Nadi(/menit)</b>
                        <p class="m-0 mt-1 p-0"><?= (@$exb[0]['nadi']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>T.Darah(mmHg)</b>
                        <p class="m-0 mt-1 p-0"><?= (@$exb[0]['tension_upper']); ?>/<?= @$exb[0]['tension_below']; ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Saturasi(SpO2%)</b>
                        <p class="m-0 mt-1 p-0"><?= (@$exb[0]['saturasi']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Nafas/RR(/menit)</b>
                        <p class="m-0 mt-1 p-0"><?= (@$exb[0]['nafas']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Kesan Umum</b>
                        <p class="m-0 mt-1 p-0"><?= (@$exb[0]['general_condition']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Pergerakan</b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['movement']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Warna Kulit</b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['skincolor']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Turgor</b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['turgor']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Tonus</b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['tonus']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <?php $suara = ['Tidak ada', 'Merintih', 'Keras'] ?>
                        <b>Suara</b>
                        <p class="m-0 mt-1 p-0"><?= (@$suara[$value['sound']]); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <?php $moro = ['-', '+'] ?>
                        <b>Reflek Moro</b>
                        <p class="m-0 mt-1 p-0"><?= (@$moro[$value['mororeflex']]); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Reflek Menghisap</b>
                        <p class="m-0 mt-1 p-0"><?= (@$moro[$value['suckingreflex']]); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Memegang</b>
                        <p class="m-0 mt-1 p-0"><?= (@$moro[$value['holding']]); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>Tonus Leher</b>
                        <p class="m-0 mt-1 p-0"><?= (@$moro[$value['necktone']]); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>LK</b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['headcircumference']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b>LD</b>
                        <p class="m-0 mt-1 p-0"><?= (@$value['chestcircumference']); ?></p>
                    </div>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <?php $proteinuria = ['-', '1', '+', '++']; ?>
                        <b>Proteinuria (Perhari)</b>
                        <p class="m-0 mt-1 p-0"><?= (@$proteinuria[(int)$exb[0]['proteinuria']]); ?></p>
                    </div>
                </div>
            </div>
            <?php
            if (count($apgarData) > 0) {
                $apgr = array_filter($apgar, function ($value1) use ($value) {
                    return $value1['document_id'] == $value['baby_id'];
                });
                $body_id = @$apgr[0]['body_id'];
                $apgrData = array_filter($apgarData, function ($value1) use ($body_id) {
                    return $value1['body_id'] == $body_id;
                });
            ?>
                <div class="row">

                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" width="25%">
                                <h5 class="text-start">Apgar Score</h5>
                            </td>
                            <?php foreach ($apgarWaktu as $key2 => $waktu2) : ?>
                                <th class="p-1" width="25%"><?= $waktu2['p_description'] ?></th>
                            <?php endforeach ?>
                        </tr>
                        <?php $totalSkor = 0;
                        $totalSkor1 = 0;
                        $totalSkor5 = 0;
                        $totalSkor10 = 0;
                        ?>
                        <?php foreach ($apgrData as $key3 => $row) : ?>
                            <tr>
                                <th class="p-1" width="25%"><?= $row['parameter_desc'] ?></th>
                                <td class="p-1" width="25%"><?= '(' . $row['value_score_1'] . ') ' . $row['menit_1'] ?></td>
                                <td class="p-1" width="25%"><?= '(' . $row['value_score_5'] . ') ' . $row['menit_5'] ?></td>
                                <td class="p-1" width="25%"><?= '(' . $row['value_score_10'] . ') ' . $row['menit_10'] ?></td>
                            </tr>
                            <?php $totalSkor += $row['value_score_1'] + $row['value_score_5'] + $row['value_score_10'];
                            $totalSkor1 += $row['value_score_1'];
                            $totalSkor5 += $row['value_score_5'];
                            $totalSkor10 += $row['value_score_10'];
                            ?>
                        <?php endforeach ?>
                        <tr>
                            <th class="p-1" width="25%">Total Skor</th>
                            <th><?= $totalSkor1; ?></th>
                            <th><?= $totalSkor5; ?></th>
                            <th><?= $totalSkor10; ?></th>
                        </tr>
                    </tbody>
                </table>
            <?php
            } ?>
        <?php
        }
        ?>

    </div>


    <div class="row">
        <div class="col-auto" align="center">
            <div>Sampangan, <?= tanggal_indo((substr($val['examination_date'], 0, 10))); ?></div>
            <br>
            <div>Perawat yang mengkaji</div>
            <div class="mb-1">
                <div id="qrcode"></div>
            </div>
            <p class="p-0 m-0 py-1" id="qrcode_name">(<?= @$val['dokter']; ?>)</p>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
        </div>
        <div class="col"></div>
        <div class="col-auto" align="center">
            <br><br>
            <div></div>
            <div class="mb-1">
                <div id="qrcode1"></div>
            </div>
            <p class="p-0 m-0 py-1" id="qrcode_name1">(<?= @$val['nama']; ?>)</p>
        </div>
    </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    let val = <?= json_encode($val); ?>;
    let sign = <?= json_encode($sign); ?>;

    sign = JSON.parse(sign)
    $.each(sign, function(key, value) {
        if (value.user_type == 1 && value.isvalid == 1 && value.sign_ke == '1') {
            $("#qrcode_name").html(`(<?= @$visit['fullname']; ?>)`)
            $("#qrcode").html('<img class="mt-3" src="data:image/png;base64,' + value.sign_file + '" width="400px">')

        } else if (value.user_type == 1 && value.isvalid == 1 && value.sign_ke == '2') {

            $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)
            $("#qrcode1").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file + '" width="400px">')

        }
    })
</script>
<!-- <script>
    $.each(sign, function(key, value) {
        console.log(value)
        if (value.user_type == 1 && value.sign_ke == '1') {
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: value.sign_path,
                width: 150,
                height: 150,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
            $("#qrcode_name").html(`(${value.fullname??value.user_id})`)
        } else if (value.user_type == 1 && value.sign_ke == '2') {
            var qrcode1 = new QRCode(document.getElementById("qrcode1"), {
                text: value.sign_path,
                width: 150,
                height: 150,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
            $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)
        }
    })
</script> -->

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
    // window.print();
</script>

</html>