<!DOCTYPE html>
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
    <link href="<?= base_url('assets/css/jquery.min.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

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

        @media print {
            .page {
                page-break-before: always;
            }

            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
            }

            .footer .pagenum:before {
                content: counter(page);
            }

            /* Menampilkan konten sesuai dengan halaman */
            .content {
                display: block;
            }
        }

        .table-container-data {
            border: 1px solid black;
            width: 100%;
        }

        .table-container-data th,
        .table-container-data td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }


        .table-container-data .text-left.isi-informasi {
            font-size: 12px;
            max-width: 300px;
            word-wrap: break-word;
            max-height: 100px;
            overflow-y: auto;
        }


        .table-container-data .text-left.tanda {
            font-size: 12px;
            white-space: nowrap;
            text-align: center;
        }
    </style>
</head>
<div id="CM_A_03-content">

    <body>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop-3.php"
                ) ?>
                <!-- endof template kop -->
                <div class="p-2" id="data-informasi-CM_A_03">
                    <h5 class="text-center">Dokumentasi Case Manager Form</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['no_registration']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['name_of_pasien']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['gender'] == 2 ? 'Perempuan' : 'Laki-Laki'; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0"><?= tanggal_indo($visit['visit']['date_of_birth']) . ' (' . @$visit['visit']['age'] . ')'; ?></p>

                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['contact_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['fullname']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Department</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['departmen']; ?></p>
                            </td class="p-1">
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= tanggal_indo(date('Y-m-d')) ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kelas</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['name_of_class_plafond']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bangsal/Kamar</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['name_of_clinic']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bed</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['class_room']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="p-2" id="data-informasi-CM_A_03">
                    <h5 class="text-center">Dokumentasi Case Manager Form</h5>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="3" class="text-center">EVALUASI AWAL CASE MANAGER</th>
                    </tr>
                    <tr>
                        <th width="60%">SKRINING AWAL</th>
                        <th width="20%"><?= 'Tanggal: ' . tanggal_indo(date_format(date_create($data1[0]['modified_date']), 'Y-m-d')); ?></th>
                        <th width="20%"><?= 'Jam : ' . date_format(date_create($data1[0]['modified_date']), 'H:i'); ?></th>
                    </tr>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">Beri tanda (√) pada pilihan data risiko yang sesuai:</th>
                        </tr>
                        <tr>
                            <th width="1%">No</th>
                            <th width="1%"></th>
                            <th>Data Resiko</th>
                            <th>Problem Pelayanan</th>
                        </tr>
                    </thead>
                    <tbody id="data-table-CM_A_01">
                        <?php if (!empty($data1)) : ?>
                            <?php foreach ($data1 as $key => $row) : ?>
                                <tr>
                                    <td class="py-0" width="1%"><?= $key + 1; ?></td>
                                    <td class="py-0" width="1%"><?= empty($row['value_info']) ? $row['value_info'] : '&#10003;'; ?></td>
                                    <td class="py-0" width="59%"><?= $row['value_desc']; ?></td>
                                    <td class="py-0" width="39%"><?= $row['desc']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">ASESMEN MANAJEMEN PELAYANAN PASIEN</th>
                        </tr>
                        <tr>
                            <th width="1%">No</th>
                            <th>Asesmen</th>
                            <th>Asesmen</th>
                        </tr>
                    </thead>
                    <tbody id="data-table-CM_A_02">
                        <?php if (!empty($data2)) : ?>
                            <?php foreach ($data2 as $key => $row) : ?>
                                <tr>
                                    <td class="py-0" width="1%"><?= $key + 1; ?></td>
                                    <td class="py-0" width="59%"><?= $row['value_desc']; ?></td>
                                    <td class="py-0" width="40%"><?= $row['value_info']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">ASESMEN MANAJEMEN PELAYANAN PASIEN</th>
                        </tr>
                        <tr>
                            <th width="1%">No</th>
                            <th></th>
                            <th>Asesmen</th>
                        </tr>
                    </thead>
                    <tbody id="data-ttd-CM_A_03">
                        <?php if (!empty($data3)) : ?>
                            <?php foreach ($data3 as $key => $row) : ?>
                                <tr>
                                    <td class="py-0" width="1%"><?= $key + 1; ?></td>
                                    <td class="py-0" width="1%"><?= empty($row['value_info']) ? $row['value_info'] : '&#10003;'; ?></td>
                                    <td class="py-0" width="58%"><?= $row['value_desc']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <h5 class="text-center">Dokumentasi Case Manager - Form B</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center">CATATAN IMPLEMENTASI CASE MANAGER</th>
                        </tr>
                        <tr>
                            <th width="15%">TGL/JAM</th>
                            <th width="35%">IMPLEMENTASI</th>
                            <th width="35%">CATATAN/EVALUASI</th>
                            <th width="15%">NAMA TERANG</th>
                        </tr>
                    </thead>
                    <tbody id="data-table-CM_B_01">
                        <?php if (!empty($data4)) : ?>
                            <?php foreach ($data4 as $key4 => $row4) : ?>
                                <tr>
                                    <td class="py-0" width="15%"><?= date_format(date_create($row4['modified_date']), 'd-m-Y H:i'); ?></td>
                                    <td class="py-0" width="35%"><?= $row4['implementasi']; ?></td>
                                    <td class="py-0" width="35%"><?= $row4['catatan']; ?></td>
                                    <td class="py-0" width="15%"><?= $row4['modified_by']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <br>
                <i class="my-4">*dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')) ?></i>
            </div>
        </div>

    </body>
</div>


</html>