<?php
// echo "<pre>";
// var_dump($visit);
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
                        <p class="m-0 mt-1 p-0">
                            <?= date("d M Y", strtotime($visit['date_of_birth'])) . ' (' . (!empty($visit['age']) ? $visit['age'] : 'N/A') . ')'; ?>
                        </p>


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
        <?php if (isset($operation_team)) : ?>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($operation_team as $key => $team) : ?>
                    <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $team['task'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= @$team['doctor']; ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif; ?>

        <?php if (isset($diagnosas)) : ?>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <ul><b>Diagnosa Pra Operasi</b>
                        <?php
                        $diagnosa_pra = array_filter($diagnosas, function ($item) {
                            return $item['diag_cat'] === 13;
                        });
                        foreach ($diagnosa_pra as $key => $diag_pra) :
                        ?>
                            <li class="m-0 mt-1 p-0"><?= $diag_pra['diagnosa_desc'] . ', ' . @$diag_pra['suffer']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Waktu Mulai</b>
                    <p class="m-0 mt-1 p-0"><?= date_format(date_create(@$val['start_operation']), 'd-m-Y H:i'); ?></p>
                    <b>Waktu Selesai</b>
                    <p class="m-0 mt-1 p-0"><?= date_format(date_create(@$val['end_operation']), 'd-m-Y H:i'); ?></p>
                    <b>Ada Penundaan?</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['terlayani'] == 0 ? 'Tidak' : 'Ada'; ?></p>
                </div>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <ul><b>Diagnosa Pasca Operasi</b>
                        <?php
                        $diagnosa_pasca = array_filter($diagnosas, function ($item) {
                            return in_array($item['diag_cat'], [14, 15]);
                        });
                        foreach ($diagnosa_pasca as $key => $diag_pasca) :
                        ?>
                            <li class="m-0 mt-1 p-0"><?= $diag_pasca['diagnosa_desc'] . ', ' . @$diag_pasca['suffer']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Sifat Operasi</b>
                    <p class="m-0 mt-1 p-0">Efektif</p>
                </div>
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <tr>
                <td width="33.3%">
                    <b>Prosedur Pembedahan</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['tarif_name']; ?></p>
                </td>
                <td width="33.3%">
                    <b>Tipe Operasi</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['tipe_operasi']; ?></p>
                </td>
                <td width="33.3%">
                    <b>Operasi Ke</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['re_operation'] == 'OP080801' ? '1' : 're-do';  ?></p>
                </td>
            </tr>
            <tr>
                <td width="33.3%">
                    <b>Profilaksis</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['profilaksis'] == 'OP080901' ? 'Ya' : 'Tidak'; ?></p>
                </td>
                <td width="33.3%">
                    <b>Jenis Antibiotik</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['antibiotic_desc']; ?></p>
                </td>
                <td width="33.3%">
                    <b>Waktu Pemberian</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['antibiotic_time']; ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Uraian Pembedahan</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['operation_desc']; ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Komplikasi</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['komplikasi']; ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Nomor Implant</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['implant']; ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" width="66.6%">
                    <b>Konsultasi Intra-Operatif</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['konsultasi']; ?></p>
                </td>
                <td>
                    <b>Jumlah Pendarahan</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['bleeding']; ?> CC</p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Jaringan Ke Patologi</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['patologi_desc']; ?></p>
                </td>
            </tr>
        </table>


        <div class="row">
            <div class="col-auto" align="center">
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Pasien</div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: `<?= $visit['fullname']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: `<?= $visit['diantar_oleh']; ?>`,
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

</script>

</html>