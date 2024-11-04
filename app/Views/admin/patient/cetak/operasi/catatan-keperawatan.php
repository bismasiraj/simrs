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
        <h5>Informasi Medis</h5>
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
        <h4>A. Catatan Keperawatan Pra Operasi</h4>
        <table class="table table-bordered mb-2">
            <tbody>
                <tr>
                    <td width="25%">
                        <b>Tekanan Darah</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['tensi_atas'] . '/' . @$val['tensi_bawah']; ?> mmHg</p>
                    </td>
                    <td width="25%">
                        <b>Denyut Nadi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['nadi']; ?> x/m</p>
                    </td>
                    <td width="25%">
                        <b>Suhu Tubuh</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['suhu']; ?> &degC</p>
                    </td>
                    <td width="25%">
                        <b>Respiration Rate</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['respirasi']; ?> x/m</p>
                    </td>
                </tr>
                <tr>
                    <td width="25%">
                        <b>Berat Badan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['bb']; ?> kg</p>
                    </td>
                    <td width="25%">
                        <b>Tinggi Badan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['tb']; ?> cm</p>
                    </td>
                    <td width="25%">
                        <b>SpO2</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['saturasi']; ?></p>
                    </td>
                    <td width="25%">
                        <b>BMI</b>
                        <p class="m-0 mt-1 p-0"><?= number_format(@$val['bmi'], 2, '.', ''); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex flex-wrap mb-3">
            <b>Diagnosa Keperawatan Pre OP</b>
            <?php if (isset($diagnosas)) : ?>
                <?php foreach ($diagnosas as $key => $diagnosa) : ?>
                    <div class="col-12 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$diagnosa['diag_notes']; ?></p>
                    </div>
                <?php endforeach ?>
            <?php endif; ?>
        </div>

        <h4>B. Catatan Keperawatan Intra Operatif</h4>
        <div class="d-flex flex-wrap mb-3">
            <?php if (isset($informasiIntra)) : ?>
                <?php foreach ($informasiIntra as $key => $intra) : ?>
                    <div class="col-6 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $key ?></b>
                        <p class="m-0 mt-1 p-0"><?= @$intra; ?></p>
                    </div>
                <?php endforeach ?>
            <?php endif; ?>
        </div>

        <b>Pemakaian Drain</b>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="25%">Tipe Drain</th>
                    <th width="25%">Jenis Drain</th>
                    <th width="25%">Ukuran</th>
                    <th width="25%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($drains)) : ?>
                    <?php foreach ($drains as $key => $drain) : ?>
                        <tr>
                            <td width="25%"><?= $drain['drain_type']; ?></td>
                            <td width="25%"><?= $drain['drain_kinds']; ?></td>
                            <td width="25%"><?= $drain['size']; ?></td>
                            <td width="25%"><?= $drain['description']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <br>
        <b>Hitung Instrumen/Kassa/Jarum</b>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="25%">Hitung</th>
                    <th width="25%">Kassa</th>
                    <th width="25%">Jarum</th>
                    <th width="25%">Instrumen</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($instrument)) : ?>

                    <?php foreach ($instrument as $instrumen) : ?>
                        <tr>
                            <?php foreach ($instrumen as $cell) : ?>
                                <td><?= @$cell; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
        <div class="col-12 p-1 border-collide mb-3" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Catatan</b>
            <p>Jika dihitung tidak Sesuai -> X-ray: <?= @$val['xray'] == 1 ? 'Ya' : 'Tidak'; ?></p>
        </div>
        <div class="d-flex flex-wrap mb-3">
            <?php if (isset($informasiIntra2)) : ?>
                <?php foreach ($informasiIntra2 as $key => $intra2) : ?>
                    <div class="col-6 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $key ?></b>
                        <p class="m-0 mt-1 p-0"><?= @$intra2; ?></p>
                    </div>
                <?php endforeach ?>
            <?php endif; ?>
        </div>

        <h4>C. Catatan Keperawatan Pasca Operasi</h4>
        <div class="d-flex flex-wrap mb-3">
            <?php if (isset($informasiPasca)) : ?>
                <?php foreach ($informasiPasca as $key => $pasca) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $key ?></b>
                        <p class="m-0 mt-1 p-0"><?= @$pasca ?? '-'; ?></p>
                    </div>
                <?php endforeach ?>
            <?php endif; ?>
        </div>
        <?php if (isset($aldrete)) : ?>
            <?php foreach ($aldrete as $dataAldrete) : ?>
                <div class="d-flex flex-wrap mb-3" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <div class="col-12 p-1 border-collide">
                        <b>Tanggal Observasi : <?= tanggal_indo(date_format(date_create($dataAldrete['observation_date']), 'Y-m-d')) . ' ' . date_format(date_create($dataAldrete['observation_date']), 'H:i') . ' WIB'; ?></b><br>
                        <b>Skor Aldrete</b>
                        <ul>
                            <li>Aktivitas : <?= @$dataAldrete['value_desc_01']; ?></li>
                            <li>Pernapasan : <?= @$dataAldrete['value_desc_02']; ?></li>
                            <li>Circulation : <?= @$dataAldrete['value_desc_03']; ?></li>
                            <li>Kesadaran : <?= @$dataAldrete['value_desc_04']; ?></li>
                            <li>Saturasi O2 : <?= @$dataAldrete['value_desc_05']; ?></li>
                        </ul>
                        <b>Skor : <?= @$dataAldrete['value_score_01'] + @$dataAldrete['value_score_02'] + @$dataAldrete['value_score_03'] + @$dataAldrete['value_score_04'] + @$dataAldrete['value_score_05']; ?></b>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (isset($aldrete)) : ?>
            <?php foreach ($bromage as $dataBromage) : ?>
                <div class="d-flex flex-wrap mb-3" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <div class="col-12 border-collide">
                        <div class="p-1 border-collide">
                            <b>Tanggal Observasi : <?= tanggal_indo(date_format(date_create(@$dataBromage['observation_date']), 'Y-m-d')) . ' ' . date_format(date_create(@$dataBromage['observation_date']), 'H:i') . ' WIB'; ?></b><br>
                            <b>Skor Bromage</b>
                            <p><?= @$dataBromage['value_desc']; ?></p>
                            <b>Skor : <?= @$dataBromage['value_score']; ?></b>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (isset($steward)) : ?>
            <?php foreach ($steward as $dataSteward) : ?>
                <div class="d-flex flex-wrap mb-3" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <div class="col-12 border-collide">
                        <div class="p-1 border-collide">
                            <b>Tanggal Observasi : <?= tanggal_indo(date_format(date_create(@$dataSteward['observation_date']), 'Y-m-d')) . ' ' . date_format(date_create(@$dataSteward['observation_date']), 'H:i') . ' WIB'; ?></b><br>
                            <b>Skor Steward</b>
                            <ul>
                                <li>Kesadaran : <?= @$dataSteward['value_desc_01']; ?></li>
                                <li>Jalan Nafas : <?= @$dataSteward['value_desc_02']; ?></li>
                                <li>Gerakan : <?= @$dataSteward['value_desc_03']; ?></li>
                            </ul>
                            <b>Skor : <?= @$dataSteward['value_score_01'] + @$dataSteward['value_score_02'] + @$dataSteward['value_score_03']; ?></b>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
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