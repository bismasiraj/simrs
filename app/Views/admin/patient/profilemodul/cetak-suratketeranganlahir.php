<?php

$tanggal_lahir = $data['father_age'];
$lahir = new DateTime($tanggal_lahir);
$sekarang = new DateTime();

$selisih = $lahir->diff($sekarang);

$usia = sprintf('%dth %dbln %dhr', $selisih->y, $selisih->m, $selisih->d);

?>
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
    <script src="<?= base_url('assets/js/default.js') ?>"></script>
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
                    <h5 class="text-center">SURAT KETERANGAN LAHIR</h5>
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
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['class_id']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bangsal/Kamar</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['class_room_id']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bed</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['bed']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="text-center">SURAT KETERANGAN LAHIR</h3>
                <table class="table table-bordered">
                    <tr>
                        <td colspan="5">Yang bertandatangan dibawah ini menerangkan telah menolong dengan selamat lahiran seorang bayi :</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Nama Anak</td>
                        <td width="1%">:</td>
                        <td colspan="3"><?= $data['thename']; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td width="1%">:</td>
                        <td colspan="3"><?= $data['gender'] == 1 ? 'Laki-Laki' : 'Perempuan'; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td width="1%">:</td>
                        <td colspan="3"><?= tanggal_indo(date_format(date_create($data['inspection_date']), 'Y-m-d')); ?></td>
                    </tr>
                    <tr>
                        <td>Panjang Badan</td>
                        <td width="1%">:</td>
                        <td><?= $data['height']; ?></td>
                        <td style="width: 1%;">Berat Badan:</td>
                        <td><?= $data['weight']; ?></td>
                    </tr>
                    <tr>
                        <td>Jam</td>
                        <td width="1%">:</td>
                        <td colspan="3"><?= date_format(date_create($data['inspection_date']), 'H:i'); ?> WIB</td>
                    </tr>
                    <tr>
                        <td>Anak Ke</td>
                        <td width="1%">:</td>
                        <td colspan="3"><?= $data['baby_ke']; ?></td>
                    </tr>

                    <tr>
                        <td colspan="5">Bayi tersebut diatas adalah anak Suami / Istri :</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Nama Ibu</td>
                        <td width="1%">:</td>
                        <td><?= $visit['visit']['name_of_pasien']; ?></td>
                        <td style="width: 1%;">Umur:</td>
                        <td><?= $visit['visit']['age']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Ayah</td>
                        <td width="1%">:</td>
                        <td><?= $data['spouse']; ?></td>
                        <td style="width: 1%;">Umur:
                        <td><?= $usia; ?></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td width="1%">:</td>
                        <td colspan="3"><?= $data['job']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td width="1%">:</td>
                        <td colspan="3"><?= $data['theaddress']; ?></td>
                    </tr>
                </table>
                <i class="my-4">*dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')) ?></i>
            </div>
        </div>

    </body>
</div>


</html>