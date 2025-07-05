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
    <script src="<?= base_url('/assets/js/default.js') ?>"></script>

    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

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
        <h4>Asesmen Gizi Awal</h4>
        <table class="table table-bordered">
            <tr>
                <td width="50%">
                    <b>Tanggal</b><br>
                    <small><?= tanggal_indo(date_format(date_create(@$val['examination_date']), 'Y-m-d')); ?></small>
                </td>
                <td width="50%">
                    <b>Jenis Antropometri</b><br>
                    <small><?= @$val['antropometri']; ?></small>
                </td>
            </tr>
        </table>

        <table class="table table-bordered">
            <tr>
                <td width="50%">
                    <b>Kategori Usia</b><br>
                    <small><?= @$val['display']; ?></small>
                </td>
                <td width="50%" rowspan="4"></td>
            </tr>
            <tr>
                <td width="50%">
                    <b>BB</b><br>
                    <small><?= @$val['weight'] ?? 0; ?></small>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <b>TB</b><br>
                    <small><?= @$val['height'] ?? 0; ?></small>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <b>BBI</b><br>
                    <small><?= @$val['weight_ideal']; ?></small>
                </td>
            </tr>
            <tr>
                <td width="50%" colspan="2">
                    <b>BIOKIMIA</b><br>
                    <small><?= @$val['biokimia'] ?? '-'; ?></small>
                </td>
            </tr>
            <tr>
                <td width="50%" colspan="2">
                    <b>Vital Sign & Keadaan Umum</b><br>
                    <small><?= @$val['clinical_description']; ?></small>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <b>Alergi Makanan</b><br>
                    <small><?= @$val['food_alergy']; ?></small>
                </td>
                <td width="50%">
                    <b>Pola Makan</b><br>
                    <small><?= @$val['dietary_habit']; ?></small>
                </td>
            </tr>
        </table>
        <h5>Total Asupan</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Zat Gizi</th>
                    <th>MRS</th>
                    <th>Kebuguhan</th>
                    <th>%</th>
                    <th>Perhitungan Kebutuhan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Energi</td>
                    <td>0.0</td>
                    <td><?= @$val['energi']; ?></td>
                    <td>0.0</td>
                    <td>0.0</td>
                </tr>
                <tr>
                    <td>Karbohidrat</td>
                    <td>0.0</td>
                    <td><?= @$val['karbohidrat']; ?></td>
                    <td>0.0</td>
                    <td>0.0</td>
                </tr>
                <tr>
                    <td>Protein</td>
                    <td>0.0</td>
                    <td><?= @$val['protein']; ?></td>
                    <td>0.0</td>
                    <td>0.0</td>
                </tr>
                <tr>
                    <td>Lemak</td>
                    <td>0.0</td>
                    <td><?= @$val['lemak']; ?></td>
                    <td>0.0</td>
                    <td>0.0</td>
                </tr>
            </tbody>
        </table>
        <h5>Diagnosis</h5>
        <div class="col-12 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <p class="m-0 mt-1 p-0"><?= @$val['nutrition_diagnose']; ?></p>
        </div>
        <?php if (isset($diagnosa)) : ?>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($diagnosa as $key => $diag) : ?>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
        <h5>Rencana dan Hasil Intervensi</h5>
        <?php if (isset($intervensi)) : ?>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Intervensi gizi</p>
                </div>
                <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Target</p>
                </div>
                <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Hasil</p>
                </div>
                <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Identifikasi masalah</p>
                </div>
                <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Rencana tindak lanjut</p>
                </div>
                <?php foreach ($intervensi as $key => $intr) : ?>
                    <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$intr['intervention_description']; ?></p>
                    </div>
                    <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$intr['intervention_target']; ?></p>
                    </div>
                    <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$intr['intervention_result']; ?></p>
                    </div>
                    <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$intr['intervention_problem']; ?></p>
                    </div>
                    <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$intr['intervention_planning']; ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
        <h5>Food Recall</h5>
        <?php if (isset($foodRecall)) : ?>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Nama Makanan</p>
                </div>
                <div class="col-1 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">URT Makanan</p>
                </div>
                <div class="col-1 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Estimasi (gram)</p>
                </div>
                <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Nama Bahan</p>
                </div>
                <div class="col-1 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">URT Bahan</p>
                </div>
                <div class="col-1 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Estimasi (gram)</p>
                </div>
                <div class="col-1 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Netto</p>
                </div>
                <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <p class="m-0 mt-1 p-0 fw-bold">Keterangan</p>
                </div>
                <?php foreach ($foodRecall as $key => $recall) : ?>
                    <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$recall['meal_name']; ?></p>
                    </div>
                    <div class="col-1 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$recall['meal_urt']; ?></p>
                    </div>
                    <div class="col-1 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$recall['meal_grams']; ?></p>
                    </div>
                    <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$recall['ingredient_name']; ?></p>
                    </div>
                    <div class="col-1 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$recall['ingredient_urt']; ?></p>
                    </div>
                    <div class="col-1 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$recall['ingredient_grams']; ?></p>
                    </div>
                    <div class="col-1 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$recall['ingredient_netto']; ?></p>
                    </div>
                    <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <p class="m-0 mt-1 p-0"><?= @$recall['meal_description']; ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif;  ?>
        <h5>Monitoring Evaluasi</h5>
        <table class="table table-bordered">
            <tr>
                <td>Total Kalori</td>
                <td>Target</td>
                <td>Kalori dikonsumsi</td>
                <td>Protein</td>
                <td>Karbohidrat</td>
                <td>Lemak</td>
            </tr>
            <tr>
                <td><?= @@$val['energi']; ?></td>
                <td><?= @$intr['intervention_target']; ?>%</td>
                <td><?= (@@$val['energi'] * (@$intr['intervention_target'] / 100)) ?? ''; ?></td>
                <td><?= (@@$val['protein'] * (@$intr['intervention_target'] / 100)) ?? ''; ?> gram</td>
                <td><?= (@@$val['karbohidrat'] * (@$intr['intervention_target'] / 100)) ?? ''; ?> gram</td>
                <td><?= (@@$val['lemak'] * (@$intr['intervention_target'] / 100)) ?? ''; ?> gram</td>
            </tr>

        </table>
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
        text: `<?= @$visit['fullname']; ?>`,
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
    setTimeout(() => {
        window.print();
    }, 1000);
</script>

</html>