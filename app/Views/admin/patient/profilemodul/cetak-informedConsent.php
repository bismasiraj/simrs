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
    <link href="<?= base_url('assets/css/jquery.min.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/default.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
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
<!-- new -->
<!-- new -->
<div id="E01-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <b id="code-E01"></b>
                        <!-- <img class="mt-2" src="<?= base_url(
                                                        "assets/img/paripurna.png"
                                                    ) ?>" width="90px"> -->
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="row">
                    <h4 class="text-center">PERSETUJUAN UMUM</h4>
                </div>
                <div class="row">
                    <h6 class="text-start">IDENTITAS PASIEN :</h6>
                </div>
                <table class="1 pb-2">
                    <tbody>
                        <tr>
                            <td class="p-1">Nama</td>
                            <td class="p-1">: <span id="name_of_pasien-E01" class="name_of_pasien-E01"></span></td>
                        </tr>
                        <tr>
                            <td class="p-1">Tanggal Lahir</td>
                            <td class="p-1">: <span id="date_of_birth-E01" class="date_of_birth-E01"></span></td>
                            <td class="p-1">Jenis Kelamin</td>
                            <td class="p-1">: <span id="name_of_gender-E01" class="name_of_gender-E01"></span></td>
                        </tr>
                        <tr>
                            <td class="p-1">Alamat</td>
                            <td class="p-1">: <span id="contact_address-E01" class="contact_address-E01"></span></td>
                            <td class="p-1">No. Telp</td>
                            <td class="p-1">: <span id="noTlp-E01" class="noTlp-E01"></span></td>
                        </tr>
                        <tr>
                            <td class="p-1">No.RM</td>
                            <td class="p-1">: <span id="no_registration-E01" class="no_registration-E01"></span></td>
                        </tr>
                    </tbody>
                </table>

                <div class="row">
                    <h6 class="text-start">IDENTITAS PENANGGUNGJAWAB PASIEN :</h6>
                </div>
                <table class="2 pb-2">
                    <tbody>
                        <tr>
                            <td class="p-1">Nama</td>
                            <td class="p-1">: <span id="p_name_of_pasien-E01" class="p_name_of_pasien-E01"><?= @$visit["name_of_pasien"] ?></span></td>
                        </tr>
                        <tr>
                            <td class="p-1">Tanggal Lahir</td>
                            <td class="p-1">: <span id="p_date_of_birth-E01" class="p_date_of_birth-E01"></span></td>
                            <td class="p-1">Jenis Kelamin</td>
                            <td class="p-1">: <span id="p_name_of_gender-E01" class="p_name_of_gender-E01"></span></td>
                        </tr>
                        <tr>
                            <td class="p-1">Alamat</td>
                            <td class="p-1">: <span id="p_contact_address-E01" class="p_contact_address-E01"></span>
                            </td>
                            <td class="p-1">No. Telp</td>
                            <td class="p-1">: <span id="p_noTlp-E01" class="p_noTlp-E01"></span></td>
                        </tr>
                    </tbody>
                </table>

                <p>Selaku <b id="selaku-E01" class="selaku-E01"> Pasien/ Orang tua Pasien/ Suami pasien/ Istri pasien/
                        dan lainnya*</b>, sebutkan</p>
                <p>Dengan ini menyatakan persetujuan atas hal-hal sebagai berikut,</p>

                <table class="table-responsive">
                    <tbody id="data-E01">
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <div id="hasil-Avalue-desc"></div>
                <p><b> TELAH MEMBACA, MEMAHAMI, dan SEPENUHNYA SETUJU </b>terhadap pernyataan tersebut di atas.</p>

                <div class="row">
                    <div class="col-md-6 " align="center">
                        <div class="row pt-3">
                            <div class="col-4" align="center">
                                <br>
                                <div>Petugas</div>
                                <div class="mb-1">
                                    <div class="pt-2" id="qrcode-petugas-E01"></div>
                                </div>
                                <p class="p-0 m-0 py-1" id="text-petugas-E01">Ttd dan nama terang</p>
                            </div>
                            <div class="col-4" align="center">
                                <br><br>
                            </div>
                            <div class="col-4" align="center">
                                <br>
                                <div>Penerima Penjelasan</div>
                                <div class="mb-1">
                                    <div class="pt-2" id="qrcode-pasien-E01"></div>
                                </div>
                                <p class="p-0 m-0 py-1" id="text-pasien-E01">(valid_user)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</div>

<div id="E02-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="row">
                    <h4 class="text-center" id="content-1-E02">Surat Persetujuan Alih Kelas/ Alih Kriteria Pasien</h4>
                </div>
                <div class="row">
                    <p class="text-start" id="content-2-E02">Saya yang bertandatangan dibawah ini:</p>
                </div>
                <table class="1 pb-2">
                    <tbody id="content_tabels-E02">
                        <tr>
                            <td class="p-1">Nama</td>
                            <td class="p-1">: <?= @$visit["name_of_pasien"] ?></td>
                        </tr>
                        <tr>
                            <td class="p-1">No. KTP/ SIM</td>
                            <td class="p-1">: <?= @$visit["name_of_pasien"] ?></td>
                        </tr>
                        <tr>
                            <td class="p-1">Umur</td>
                            <td class="p-1">:
                                <?php if (!empty($visit["date_of_birth"])) : ?>
                                    <?= date(
                                        "d/m/Y",
                                        strtotime($visit["date_of_birth"])
                                    ) ?>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">Agama</td>
                            <td class="p-1">: <?= @$visit["contact_address"] ?></td>
                        </tr>
                        <tr>
                            <td class="p-1">Pekerjaan</td>
                            <td class="p-1">: <?= @$visit["no_registration"] ?></td>
                        </tr>
                        <tr>
                            <td class="p-1">Alamat</td>
                            <td class="p-1">: <?= @$visit["no_registration"] ?></td>
                        </tr>
                        <tr>
                            <td class="p-1">Telepon</td>
                            <td class="p-1">: <?= @$visit["no_registration"] ?></td>
                        </tr>
                        <tr>
                            <td class="p-1">Hubungan dengan pasien</td>
                            <td class="p-1">: <?= @$visit["no_registration"] ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="row">
                    <p class="text-start" id="content-3-E02">Menyetujui bahwa pasien dibawah ini:</p>
                </div>
                <table class="2 pb-2" id="content-tables-down-E02">
                    <tbody>
                        <tr>
                            <td class="p-1">Nama Pasien</td>
                            <td class="p-1">: <span id="name_of_pasien-E02"></span></td>
                        </tr>
                        <tr>
                            <td class="p-1">Umur</td>
                            <td class="p-1">: <span id="age-E02"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">Alamat</td>
                            <td class="p-1">: <span id="contact_address-E02"></span></td>
                        </tr>
                        <tr>
                            <td class="p-1">No. RM</td>
                            <td class="p-1">: <span id="no_registration-E02"></span></td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    <ol>
                        <li>Alih Kelas : dari kelas <span id="contentInclass-E02"></span>. menjadi kelas <span id="contentToclass-E02"></span>.</li>
                        <li>Alih Kriteria :
                            <table>
                                <tbody>
                                    <tr>
                                        <td>dari pasien <span id="contentInKriteria-E02"></span></td>

                                    </tr>
                                    <tr>
                                        <td>Menjadi pasien <span id="contentToKriteria-E02"></span></td>


                                    </tr>
                                </tbody>
                            </table>
                        </li>
                    </ol>
                </div>

                <div>
                    <p>Dengan alasan : <span id="content-alasan-E02"></span></p>
                </div>
                <div>
                    <p>Dan saya menyatakan dengan sesungguhnya, bahwa saya :</p>
                    <ol>
                        <li>Telah diberikan penjelasan akan tentang resiko serta konsekuensi dari alih kelas/ alih
                            kriteria
                            status pasien.</li>
                        <li>Telah memahami sepenuhnya penjelasan yang diberikan oleh petugas RS PKU Muhammadiyah
                            Sampangan
                            Surakarta.</li>
                        <li>Atas tanggung jawab dan resiko sendiri menyetujui bila pasien alih kelas/ alih kriteria
                            status
                            pasien.</li>
                        <li>Atas persetujuan ini apabila terjadi sesuatu yang tidak diinginkan saya tidak akan menuntut
                            siapapun.</li>
                    </ol>
                </div>
                <div class="row pb-4">
                    <div class="col-md-3 offset-md-8 text-right" align="right">
                        Surakarta, <span id="date-E02"></span>
                    </div>
                </div>

                <table class="tabel text-center pt-2" style="width: 720px; height: 200px; margin: auto;">
                    <tbody>
                        <tr>
                            <td style="vertical-align: top; width: 50%;">
                                <p style="margin-bottom: 5px;">Dokter,</p>
                                <p style="margin-top: 5px; margin-bottom: 10px;">RS PKU Muhammadiyah Sampangan</p>
                                <div align="center" id="qr-doctor-E02"></div>
                                <p><span id="doctor-E02"></span></p>
                            </td>
                            <td style="vertical-align: top; width: 50%;">
                                <p style="margin-bottom: 5px;">Yang Menyatakan</p>
                                <div align="center" id="qr-menyatakan-E02"></div>
                                <p><span id="menyatakan-E02"></span></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <p style="margin-top: 10px; margin-bottom: 5px;">SAKSI I</p>
                                <div align="center" id="qr-saksi-E02"></div>
                                <p><span id="saksi-E02"></span></p>
                            </td>
                            <!-- <td style="vertical-align: top;">
                                <p style="margin-top: 10px; margin-bottom: 5px;">SAKSI II</p>
                                <p style="margin: 93px;">(……………………………)</p>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</div>

<div id="E03-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="row">
                    <h4 class="text-center">SURAT PERSETUJUAN PEMBERIAN VAKSINASI</h4>
                </div>
                <div class="row">
                    <p class="text-start">Yang bertandatangan di bawah ini :</p>
                </div>
                <table class="1 pb-2">
                    <tbody id="content_tabels-E03" class="content_tabels-E03">
                        <tr>
                            <td class="p-1">Nama</td>
                            <td class="p-1">: <?= @$visit["name_of_pasien"] ?></td>
                        </tr>
                        <tr>
                            <td class="p-1">Umur</td>
                            <td class="p-1">:
                                <?php if (!empty($visit["date_of_birth"])) : ?>
                                    <?= date(
                                        "d/m/Y",
                                        strtotime($visit["date_of_birth"])
                                    ) ?>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">Alamat</td>
                            <td class="p-1">: <?= @$visit["no_registration"] ?></td>
                        </tr>
                        <tr>
                            <td class="p-1">Selaku Ayah/ Ibu/ Nenek/ Wali/ Lainnya</td>
                        </tr>
                    </tbody>
                </table>

                <div class="row">
                    <p class="text-start contentIsi-E03" id="contentIsi-E03">Menyatakan persetujuan untuk diberikan
                        Vaksinasi amti virus</p>
                    <p>terhadap Pasien/ anak :</p>
                </div>
                <table class="2 pb-2">
                    <tbody>
                        <tr>
                            <td class="p-1">Nama</td>
                            <td class="p-1">: <span class="name_of_pasien-E03"></span></td>
                        </tr>
                        <tr>
                            <td class="p-1">Umur</td>
                            <td class="p-1">: <span class="age-E03"></span>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <div class="row pb-4">
                    <div class="col-md-3 offset-md-7 text-right" align="right">
                        Surakarta,<span class="date-E03"></span>
                    </div>
                </div>

                <table class="tabel text-center pt-2" style="width: 720px; height: 200px; margin: auto;">
                    <tbody>
                        <tr>
                            <td style="vertical-align: top;">
                                <p style="margin-top: 10px; margin-bottom: 5px;">SAKSI</p>
                                <div align="center" id="qr-saksi-1-E03"></div>
                                <p><span class="saksi-E03"></span></p>
                            </td>
                            <td style="vertical-align: top;">
                                <p style="margin-top: 10px; margin-bottom: 5px;">Yang Menyatakan,</p>
                                <div align="center" id="qr-menyarakan-1-E03"></div>
                                <p><span class="menyatakan-E03"></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="row">
                    <h4 class="text-center">SURAT PERSETUJUAN PEMBERIAN VAKSINASI</h4>
                </div>
                <div class="row">
                    <p class="text-start">Yang bertandatangan di bawah ini :</p>
                </div>
                <table class="1 pb-2">
                    <tbody id="content_tabels-E02" class="content_tabels-E03">
                        <tr>
                            <td class="p-1">Nama</td>
                            <td class="p-1">: <?= @$visit["name_of_pasien"] ?></td>
                        </tr>
                        <tr>
                            <td class="p-1">Umur</td>
                            <td class="p-1">:
                                <?php if (!empty($visit["date_of_birth"])) : ?>
                                    <?= date(
                                        "d/m/Y",
                                        strtotime($visit["date_of_birth"])
                                    ) ?>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">Alamat</td>
                            <td class="p-1">: <?= @$visit["no_registration"] ?></td>
                        </tr>
                        <tr>
                            <td class="p-1">Selaku Ayah/ Ibu/ Nenek/ Wali/ Lainnya</td>
                        </tr>
                    </tbody>
                </table>

                <div class="row">
                    <p class="text-start contentIsi-E03" id="contentIsi-E03">Menyatakan persetujuan untuk diberikan
                        Vaksinasi amti virus</p>
                    <p>terhadap Pasien/ anak :</p>
                </div>
                <table class="2 pb-2">
                    <tbody>
                        <tr>
                            <td class="p-1">Nama</td>
                            <td class="p-1">: <span class="name_of_pasien-E03"></span></td>
                        </tr>
                        <tr>
                            <td class="p-1">Umur</td>
                            <td class="p-1">: <span class="age-E03"></span>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <div class="row pb-4">
                    <div class="col-md-3 offset-md-7 text-right" align="right">
                        Surakarta,<span class="date-E03"></span>
                    </div>
                </div>

                <table class="tabel text-center pt-2" style="width: 720px; height: 200px; margin: auto;">
                    <tbody>
                        <tr>
                            <td style="vertical-align: top;">
                                <p style="margin-top: 10px; margin-bottom: 5px;">SAKSI</p>
                                <div align="center" id="qr-saksi-2-E03"></div>
                                <p><span class="saksi-E03"></span></p>
                            </td>
                            <td style="vertical-align: top;">
                                <p style="margin-top: 10px; margin-bottom: 5px;">Yang Menyatakan,</p>
                                <div align="center" id="qr-menyarakan-2-E03"></div>
                                <p><span class="menyatakan-E03"></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</div>

<div id="E04-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= isset($kop["name_of_org_unit"])
                                ? $kop["name_of_org_unit"]
                                : "" ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= isset($kop["contact_address"])
                                ? $kop["contact_address"]
                                : "" ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-left">PERSETUJUAN DIRUJUK</h4>
                </div>
                <div class="row">
                    <h5 class="text-center">PEMBERIAN INFORMASI</h5>
                </div>
                <?php $dt = new DateTime(
                    "now",
                    new DateTimeZone("Asia/Bangkok")
                ); ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Dokter Penanggung Jawab</b>
                            </td>
                            <td>
                                <div class="m-0 mt-1 p-0 fullname_from-E04" id="fullname_from-E04"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Pemberi Informasi</b>
                            </td>
                            <td>
                                <div class="m-0 mt-1 p-0 pemberi_informasi-E04" id="pemberi_informasi-E04"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Penerima Informasi / Pemberi Persetujuan*</b>
                            </td>
                            <td>
                                <div class="m-0 mt-1 p-0 Penerima_Informasi-E04" id="Penerima_Informasi-E04"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>



                <table class="table table-bordered mb-1 table-container-data">
                    <thead>
                        <tr>
                            <th class="text-left p-2 fit align-middle">NO</th>
                            <th class="text-left p-2 align-middle">JENIS INFORMASI</th>
                            <th class="text-left p-2 align-middle">ISI INFORMASI</th>
                            <th class="text-left p-2 align-middle">TANDA(√)/PARAF<br>Penerima Informasi</th>
                        </tr>
                    </thead>
                    <tbody id="data_js-E04">
                        <tr>
                            <td>DATA</td>
                            <td>DATA</td>
                            <td>DATA</td>
                            <td>DATA</td>

                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <tr>
                        <td colspan="8" style="width: 575px;">
                            <div class="mb-3" id="content-13-E04">
                                Dengan ini menyatakan bahwa saya telah menerangkan hal-hal diatas secara benar dan jelas
                                dan memberikan kesempatan untuk bertanya dan / berdiskusi
                            </div>
                        </td>
                        <td style="width: 123px;">
                            Tanda Tangan Dokter
                            <div id="qr-docter-E04"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" style="width: 699px;">
                            <h6 class="text-center" id="setuju-14-E04">SETUJU/MENOLAK DIRUJUK</h6>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" style="width: 699px;">
                            <div>
                                <div class="mb-2">Yang bertandatangan dibawah ini saya,</div>
                                <div class="mb-2">Nama:<span class="name-E04" id="name-E04"></span> Umur: <span class="age-E04" id="age-E04"></span> tahun, <span id="gender-E04" class="gender-E04"></span></div>
                                <div class="mb-2">Alamat: <span class="address-E04" id="address-E04"></span></div>
                                <div class="mb-2">Bahwa saya telah menerima informasi sebagaimana diatas, dengan ini
                                    menyatakan <span id="val-setuju-E04"></span></div>
                                <div class="mb-2">Untuk dilakukan rujuk: <span id="rujuk-E04" class="rujuk-E04"></span>
                                </div>
                                <div class="mb-2">Terhadap saya / <span id="terhadap-E04"></span> saya*</div>
                                <div class="mb-2">Nama: <span class="name-pasien-E04" id="name-pasien-E04"></span> Umur:
                                    <span class="age-pasien-E04" id="age-pasien-E04"></span> tahun, <span id="gender-pasien-E04" class="gender-pasien-E04"></span>
                                </div>
                                <div class="mb-2">Alamat: <span class="address-pasien-E04" id="address-pasien-E04"></span></div>
                                <div class="mb-2">Saya memahami perlunya dan manfaat rujuk tersebut sebagaimana telah
                                    dijelaskan seperti diatas kepada saya, termasuk resiko dan komplikasi yang mungkin
                                    timbul.</div>
                                <div class="text-end">Surakarta, tanggal <span id="date-E04" class="date-E04"></span>
                                    jam <span id="time-E04"></span> WIB</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="width: 233px;">
                            <div class="mb-5">
                                <div class="mb-2">Yang menyatakan*</div>
                                <div class="text-center">
                                    <div align="center" id="qrcode-menyatakan-E04"></div>
                                </div>
                                <div class="text-center"><span class="name-E04" id="name-E04"></span></div>
                            </div>
                        </td>
                        <td colspan="4" style="width: 233px;">
                            <div class="mb-5">
                                <div class="mb-2">Saksi I</div>
                                <div class="mb-2">Keluarga</div>
                                <div class="text-center">
                                    <div align="center" id="qrcode-keluarga-E04"></div>
                                </div>
                                <div class="text-center"><span class="keluarga-E04" id="keluarga-E04"></div>
                            </div>
                        </td>
                        <td colspan="2" style="width: 233px;">
                            <div class="mb-5">
                                <div class="mb-2">Saksi II</div>
                                <div class="mb-2">Perawat/Bidan</div>
                                <div class="text-center">
                                    <div align="center" id="qrcode-bidan-E04"></div>
                                </div>
                                <div class="text-center"><span class="bidan-E04" id="bidan-E04"></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </body>
</div>

<div id="E05-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>

                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="mt-4">
                    <table class="table table-bordered mb-4">
                        <tbody>
                            <tr>
                                <td class="w-50"><strong>Ruang</strong>: <span id="room-E05" class="room-E05"></span>
                                </td>
                                <td class="w-25"><strong>No. RM</strong>: <span id="register-E05" class="register-E05"></span></td>
                            </tr>
                            <tr>
                                <td class="w-50"><strong>Nama</strong>: <span id="name-E05" class="name-E05"></span>
                                </td>
                                <td class="w-25"><strong>Umur</strong>: <span id="age-E05" class="age-E05"></span></td>
                                <td class="w-25"><span id="gender-E05" class="gender-E05"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center mb-4">
                        <h6><strong>SURAT PERSETUJUAN TINDAKAN MEDIK</strong></h6>
                    </div>

                    <p>Saya yang bertanda tangan di bawah ini :</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="5%">:</td>
                                <td width="75%"><span id="content_val_1-E05"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>:</td>
                                <td><span id="content_val_2-E05"></span> tahun. Jenis Kelamin: <span id="content_val_3-E05"></span></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><span id="content_val_4-E05"></span></td>
                            </tr>
                            <tr>
                                <td>Bukti diri / KTP</td>
                                <td>:</td>
                                <td><span id="content_val_5-E05"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Dengan ini menyatakan dengan sesungguhnya telah memberikan:</p>

                    <div class="text-center mb-4">
                        <h6><strong>PERSETUJUAN</strong></h6>
                    </div>

                    <p>Untuk dilakukan tindakan medis berupa **: <span id="content_val_6-E05"></span></p>

                    <p>Terhadap <span id="content_val_7-E05"></span> *, dengan:</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="5%">:</td>
                                <td width="75%"><span id="name-E05" class="name-E05"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>:</td>
                                <td><span id="age-E05" class="age-E05"></span> tahun. Jenis Kelamin: <span id="gender-E05" class="gender-E05"></span></td>
                            </tr>
                            <tr>
                                <td>Bukti diri / KTP</td>
                                <td>:</td>
                                <td><span id="identity-E05" class="identity-E05"></span></td>
                            </tr>
                            <tr>
                                <td>Di rawat di ruang</td>
                                <td>:</td>
                                <td><span id="room-E05" class="room-E05"></span></td>
                            </tr>
                            <tr>
                                <td>No. RM</td>
                                <td>:</td>
                                <td><span id="register-E05" class="register-E05"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Yang tujuan, sifat, dan perhitungannya telah saya mengerti sepenuhnya.</p>
                    <p>Demikian pernyataan persetujuan ini saya buat dengan penuh kesadaran dan tanpa paksaan.</p>

                    <div class="text-end mt-4">
                        <p>Surakarta, <span class="date-E05"></span></p>
                    </div>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-center" width="33.33%">
                                    <p>Saksi - saksi</p>
                                    <p>1. Keluarga</p>
                                    <p>
                                    <div align="center" id="qr-valid_other-E05"></div>
                                    </p>
                                    <p>(<span id="valid_other_ttd-E05"></span>)</p>
                                    <p>2. Perawat</p>
                                    <p>
                                    <div align="center" id="qr-valid_user-E05"></div>
                                    </p>
                                    <p>(<span id="valid_user-ttd-E05"></span>)</p>

                                </td>
                                <td class="text-center" width="33.33%">
                                    <p>Dokter</p>
                                    <div align="center" id="qr-doctor-E05"></div>
                                    <p>(<span id="doctor-ttd-E05"></span>)</p>
                                </td>
                                <td class="text-center" width="33.33%">
                                    <p>Yang membuat pernyataan</p>
                                    <div align="center" id="qr-val-E05"></div>
                                    <p>(<span id="val-ttd-E05"></span>)</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </body>
</div>

<div id="E06-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <h5 class="text-center"><strong>PERSETUJUAN TINDAKAN KEDOKTERAN</strong></h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="my-2">Yang bertandatangan di bawah ini, saya,</div>
                                <div class="mb-2">Nama: <span id="val_content_1_E06"></span></div>
                                <div class="mb-2">Umur: <span id="val_content_2_E06"></span> tahun, <span id="val_content_3_E06"></span>
                                </div>
                                <div class="mb-2">Alamat:
                                    <span id="val_content_4_E06"></span>
                                </div>

                                <div class="my-3">Dengan ini menyatakan <strong>SETUJU</strong> untuk dilakukan
                                    tindakan: <span id="val_content_5_E06"></span></div>
                                <div class="mb-2">Terhadap saya / <span id="val_content_6_E06"></span>
                                    saya:</div>
                                <div class="mb-2">Nama:
                                    <span id="val_visit_name_E06"></span>
                                </div>
                                <div class="mb-2">Umur: <span id="val_visit_age_E06"></span> tahun, <span id="val_visit_gender_E06"></span>
                                </div>
                                <div class="mb-2">Alamat:
                                    <span id="val_visit_address_E06"></span>
                                </div>

                                <div class="my-3">
                                    Saya memahami perlunya dan manfaat tindakan tersebut sebagaimana telah
                                    dijelaskan seperti di atas kepada saya, termasuk risiko dan komplikasi
                                    yang mungkin timbul. Saya juga menyadari bahwa oleh karena ilmu kedokteran
                                    bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan,
                                    melainkan sangat bergantung kepada izin Tuhan Yang Maha Esa.
                                </div>

                                <div class="text-end">Surakarta, tanggal <span id="date_E06"></span></div>

                                <div class="row text-center mt-5">
                                    <div class="col-4">
                                        Yang menyatakan
                                    </div>
                                    <div class="col-4">
                                        Saksi
                                    </div>
                                    <div class="col-4">
                                        Petugas
                                    </div>
                                </div>

                                <div class="row text-center mt-1">
                                    <div class="col-4 text-center">
                                        <div id="qr_val_content_E06" align="center"></div>

                                        <p>(<span id="text_val_content_E06"></span>)</p>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div id="qr_valid_other_E06" align="center"></div>
                                        <p> (<span id="text_valid_other_E06"></span>)</p>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div id="qr_valid_user_E06" align="center"></div>
                                        <p> (<span id="text_valid_user_E06"></span>)</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </body>
</div>

<div id="E07-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <h6 class="text-center" colspan="2"><strong>PERSETUJUAN PERMINTAAN SECOND OPINION</strong>
                            </h6>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">Yang bertanda tangan di bawah ini:</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>
                                : <span id="content_value_1_E07"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>
                                : <span id="content_value_2_E07"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Adalah</td>
                            <td> :
                                <span id="content_value_3_E07"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Penanggung jawab pasien:</td>
                        </tr>
                        <tr>
                            <td>Nama
                            </td>
                            <td>
                                :<span id="content_visit_name_E07"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>No. RM</td>
                            <td>
                                : <span id="content_visit_register_E07"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Dengan ini menyatakan dengan sadar dan sesungguhnya bahwa:</p>
                                <ol>
                                    <li>Telah menerima dan memahami informasi mengenai kondisi terhadap diri saya /
                                        pasien dan tindakan penanganan awal yang telah dilakukan dari pihak
                                        Rumah Sakit.</li>
                                    <li>Meminta kepada pihak Rumah Sakit untuk diberikan kesempatan mencari second
                                        opinion terhadap alternatif diagnosis/pengobatan diri saya / pasien ke
                                        dokter <span id="content_value_4_E07"></span>di Rumah Sakit
                                        <span id="content_value_5_E07"></span>
                                    </li>
                                    <li>Segala sarana, biaya maupun fasilitas untuk mencari second opinion adalah
                                        tanggung jawab diri saya / pasien / keluarga.</li>
                                    <li>Untuk keperluan tersebut di atas, meminjam hasil pemeriksaan penunjang
                                        kesehatan saya / pasien berupa:
                                        <span id="content_value_6_E07"></span>
                                    </li>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div>Demikian pernyataan ini kami buat.</div>
                                <div class="text-end">Surakarta, <span id="date_E07"></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" style="width: 50%;">
                                <div>Mengetahui</div>
                                <div>Dokter jaga</div>
                                <div id="qr_docter_E07" align="center"></div>
                                <div>(<span id="docter_E07"></span>)</div>

                            </td>
                            <td class="text-center" style="width: 50%;">
                                <br>
                                <div>Pasien/Keluarga Pasien</div>
                                <div id="qr_val_E07" align="center"></div>
                                <div>(<span id="val_E07"></span>)</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </body>
</div>

<div id="E08-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= isset($kop["name_of_org_unit"])
                                ? $kop["name_of_org_unit"]
                                : "" ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= isset($kop["contact_address"])
                                ? $kop["contact_address"]
                                : "" ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <h6 class="pt-2 pb-2 text-center"><strong>PERSETUJUAN TINDAKAN ANESTESI</strong></h6>
                <span>Saya yang bertandatangan dibawah ini :</span>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>: <span id="name-val-E08" class="name-val-E08"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Umur</strong></td>
                            <td>: <span id="age-val-E08" class="age-val-E08"></span>Tahun</td>
                            <td><strong>Jenis Kelamin</strong></td>
                            <td>: <span id="gender-val-E08" class="gender-val-E08"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>:<span id="address-val-E08" class="address-val-E08"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Bukti diri/KTP</strong></td>
                            <td>:<span id="identity-val-E08" class="identity-val-E08"></span></td>
                        </tr>
                    </tbody>
                </table>

                <div class="mb-3">
                    <p>Dengan ini menyatakan dengan sesungguhnya telah memberikan:</p>
                </div>

                <h6 class="text-center"><strong>PERSETUJUAN</strong></h6>

                <div class="mb-3">
                    <p>Untuk dilakukan tindakan anestesi**: <span id="anestesi-val-E08" class="anestesi-val-E08"></span>
                    </p>
                    <p>Terhadap: <span id="terhadap-val-E08" class="terhadap-val-E08"></span></p>
                </div>

                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>:<span id="name-E08" class="name-E08"></span></td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:<span id="age-E08" class="age-E08"></span></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:<span id="adress-E08" class="adress-E08"></span></td>
                        </tr>
                        <tr>
                            <td>Dirawat di ruang</td>
                            <td>:<span id="room-E08" class="room-E08"></span></td>
                        </tr>
                        <tr>
                            <td>No. RM</td>
                            <td>:<span id="noregister-E08" class="noregister-E08"></span></td>
                        </tr>
                    </tbody>
                </table>

                <div class="mb-3" id="content_deskripsi-E08"></div>
                <div class="mb-3" id="content_deskripsi2-E08"></div>

                <div class="text-start mb-3">
                    <p>Surakarta, Tgl <span id="date-E08"></span> Bulan <span id="month-E08"></span> Tahun <span id="year-E08"></span></p>
                </div>

                <table class="table">
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <p>Saksi – saksi</p>
                                <p>Keluarga</p>
                                <div class="mb-1 text-center">
                                    <!-- tambahkan class text-center di sini -->
                                    <div class="pt-2" id="qrcode-keluarga-E08" style="text-align: center;"></div>
                                    <!-- tambahkan style="text-align: center;" di sini -->
                                </div>
                                <p class="p-0 m-0 py-1" id="text-keluarga-E08">Ttd dan nama terang</p>
                                <div></div>
                            </td>
                            <td class="text-center">
                                <p>Yang membuat pernyataan</p>
                                <div class="mb-1 text-center">
                                    <!-- tambahkan class text-center di sini -->
                                    <div class="pt-2" id="qrcode-pernyataan-E08" style="text-align: center;"></div>
                                    <!-- tambahkan style="text-align: center;" di sini -->
                                </div>
                                <p class="p-0 m-0 py-1" id="text-pernyataan-E08">Ttd dan nama terang</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <p>Perawat</p>
                                <div class="mb-1 text-center">
                                    <!-- tambahkan class text-center di sini -->
                                    <div class="pt-1" id="qrcode-Perawat-E08" style="text-align: center;"></div>
                                    <!-- tambahkan style="text-align: center;" di sini -->
                                </div>
                                <p class="p-0 m-0 py-1" id="text-Perawat-E08">Ttd dan nama terang</p>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </body>
</div>


<div id="E09-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="mt-4">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td width="36">Ruang</td>
                                <td width="214"><span class="content_visit_room_E09"></span></td>
                                <td width="67">No. RM</td>
                                <td colspan="2" width="225"><span class="content_visit_register_E09"></span></td>
                            </tr>
                            <tr>
                                <td width="36">Nama</td>
                                <td width="214"><span class="content_visit_name_E09"></span></td>
                                <td width="67">Umur</td>
                                <td width="144"><span class="content_visit_age_E09"></span></td>
                                <td width="81" class="text-center"><span class="content_visit_gender_E09"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">
                        <h6><strong>SURAT PERSETUJUAN PEMBERIAN</strong></h6>
                        <h6><strong>SUSU FORMULA</strong></h6>
                    </div>

                    <p>Yang bertandatangan di bawah ini:</p>
                    <p>Nama: <span class="content_val_1_E09"></span> </p>
                    <p>Umur: <span class="content_val_2_E09"></span></p>
                    <p>Alamat: <span class="content_val_3_E09"></span></p>
                    <p>Adalah : <span class="content_val_4_E09"></span></p>
                    <p>Menyatakan persetujuan untuk pemberian Susu Formula terhadap Pasien/ anak:</p>
                    <p>Nama: <span class="content_visit_name_E09"></span></p>
                    <p>Umur: <span class="content_visit_age_E09"></span></p>

                    <div class="text-end">
                        <p>Surakarta, <span class="date_E09"></span></p>
                    </div>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <p>Saksi</p>
                                    <div id="qr_valid_1_E09" align="center"></div>

                                    <div class="mt-4">(<span class="valid_E09"></span>)</div>
                                </td>
                                <td class="text-center">
                                    <p>Yang Menyatakan,</p>
                                    <div id="qr_val_1_E09" align="center"></div>

                                    <div class="mt-4">(<span class="val_E09"></span>)</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 2 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="mt-4">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td width="36">Ruang</td>
                                <td width="214"><span class="content_visit_room_E09"></span></td>
                                <td width="67">No. RM</td>
                                <td colspan="2" width="225"><span class="content_visit_register_E09"></span></td>
                            </tr>
                            <tr>
                                <td width="36">Nama</td>
                                <td width="214"><span class="content_visit_name_E09"></span></td>
                                <td width="67">Umur</td>
                                <td width="144"><span class="content_visit_age_E09"></span></td>
                                <td width="81" class="text-center"><span class="content_visit_gender_E09"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">
                        <h6><strong>SURAT PERSETUJUAN PEMBERIAN</strong></h6>
                        <h6><strong>SUSU FORMULA</strong></h6>
                    </div>

                    <p>Yang bertandatangan di bawah ini:</p>
                    <p>Nama: <span class="content_val_1_E09"></span> </p>
                    <p>Umur: <span class="content_val_2_E09"></span></p>
                    <p>Alamat: <span class="content_val_3_E09"></span></p>
                    <p>Adalah : <span class="content_val_4_E09"></span></p>
                    <p>Menyatakan persetujuan untuk pemberian Susu Formula terhadap Pasien/ anak:</p>
                    <p>Nama: <span class="content_visit_name_E09"></span></p>
                    <p>Umur: <span class="content_visit_age_E09"></span></p>

                    <div class="text-end">
                        <p>Surakarta, <span class="date_E09"></span></p>
                    </div>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <p>Saksi</p>
                                    <div id="qr_valid_2_E09" align="center"></div>

                                    <div class="mt-4">(<span class="valid_E09"></span>)</div>
                                </td>
                                <td class="text-center">
                                    <p>Yang Menyatakan,</p>
                                    <div id="qr_val_2_E09" align="center"></div>

                                    <div class="mt-4">(<span class="val_E09"></span>)</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</div>

<div id="E10-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="mt-4">
                    <div class="text-center mb-4">
                        <h6><strong>SURAT PENOLAKAN PEMBERIAN VAKSINASI</strong></h6>
                    </div>

                    <p>Yang bertandatangan di bawah ini :</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="5%"><span id="content_val_1_E10" class="content_val_1_E10"></span></td>
                                <td width="75%"><span id="content_val_2_E10" class="content_val_2_E10"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span id="content_val_3_E10" class="content_val_3_E10"></span></td>

                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><span id="content_val_4_E10" class="content_val_4_E10"></span></td>
                            </tr>
                            <tr>
                                <td>Selaku</td>
                                <td><span id="content_val_5_E10" class="content_val_5_E10"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Menyatakan menolak untuk diberikan Vaksinasi : <span id="content_val_6_E10" class="content_val_6_E10"></span></p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="5%">Nama</td>
                                <td width="20%"><span class="pb-5 visit_name_E10"></span></td>
                                <td width="75%"><span class="visit_gender_E10"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span class="visit_age_E10"></span></td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="text-end mt-4">
                        <p>Surakarta, <span class="date_E10"></span></p>
                    </div>


                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <p>Saksi</p>
                                    <div id="qr_valid_1_E10" align="center"></div>
                                    <div class="mt-4">(<span class="valid_E10"></span>)</div>
                                </td>
                                <td class="text-center">
                                    <p>Yang Menyatakan,</p>
                                    <div id="qr_val_1_E10" align="center"></div>

                                    <div class="mt-4">(<span class="val_E10"></span>)</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 2 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="mt-4">
                    <div class="text-center mb-4">
                        <h6><strong>SURAT PENOLAKAN PEMBERIAN VAKSINASI</strong></h6>
                    </div>

                    <p>Yang bertandatangan di bawah ini :</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="5%"><span id="content_val_1_E10" class="content_val_1_E10"></span></td>
                                <td width="75%"><span id="content_val_2_E10" class="content_val_2_E10"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span id="content_val_3_E10" class="content_val_3_E10"></span></td>

                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><span id="content_val_4_E10" class="content_val_4_E10"></span></td>
                            </tr>
                            <tr>
                                <td>Selaku</td>
                                <td><span id="content_val_5_E10" class="content_val_5_E10"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Menyatakan menolak untuk diberikan Vaksinasi : <span id="content_val_6_E10" class="content_val_6_E10"></span></p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="5%">Nama</td>
                                <td width="20%"><span class="pb-5 visit_name_E10"></span></td>
                                <td width="75%"><span class="visit_gender_E10"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span class="visit_age_E10"></span></td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="text-end mt-4">
                        <p>Surakarta, <span class="date_E10"></span></p>
                    </div>


                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <p>Saksi</p>
                                    <div id="qr_valid_2_E10" align="center"></div>
                                    <div class="mt-4">(<span class="valid_E10"></span>)</div>
                                </td>
                                <td class="text-center">
                                    <p>Yang Menyatakan,</p>
                                    <div id="qr_val_2_E10" align="center"></div>

                                    <div class="mt-4">(<span class="val_E10"></span>)</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</div>

<div id="E11-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="mt-4">
                    <div class="text-center mb-4">
                        <h6><strong>SURAT PERSETUJUAN</strong></h6>
                        <h6><strong>SHK (Skrining Hipotiroid Kongenital)</strong></h6>
                    </div>

                    <p>Yang bertandatangan di bawah ini :</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="5%"><span id="content_val_1_E11" class="content_val_1_E11"></span></td>
                                <td width="75%"><span id="content_val_2_E11" class="content_val_2_E11"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span id="content_val_3_E11" class="content_val_3_E11"></span></td>

                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><span id="content_val_4_E11" class="content_val_4_E11"></span></td>
                            </tr>
                            <tr>
                                <td>Selaku</td>
                                <td><span id="content_val_5_E11" class="content_val_5_E11"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Menyatakan persetujuan untuk dilakukan SHK (Skrining Hipotiroid Kongenital) terhadap Pasien/
                        anak:</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="5%">Nama</td>
                                <td width="20%"><span class="pb-5 visit_name_E11"></span></td>
                                <td width="75%"><span class="visit_gender_E11"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span class="visit_age_E11"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-end mt-4">
                        <p>Surakarta, <span class="date_E11"></span></p>
                    </div>


                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <p>Saksi</p>
                                    <div id="qr_valid_1_E11" align="center"></div>
                                    <div class="mt-4">(<span class="valid_E11"></span>)</div>
                                </td>
                                <td class="text-center">
                                    <p>Yang Menyatakan,</p>
                                    <div id="qr_val_1_E11" align="center"></div>

                                    <div class="mt-4">(<span class="val_E11"></span>)</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 2 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="mt-4">
                    <div class="text-center mb-4">
                        <h6><strong>SURAT PERSETUJUAN</strong></h6>
                        <h6><strong>SHK (Skrining Hipotiroid Kongenital)</strong></h6>
                    </div>

                    <p>Yang bertandatangan di bawah ini :</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="5%"><span id="content_val_1_E11" class="content_val_1_E11"></span></td>
                                <td width="75%"><span id="content_val_2_E11" class="content_val_2_E11"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span id="content_val_3_E11" class="content_val_3_E11"></span></td>

                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><span id="content_val_4_E11" class="content_val_4_E11"></span></td>
                            </tr>
                            <tr>
                                <td>Selaku</td>
                                <td><span id="content_val_5_E11" class="content_val_5_E11"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Menyatakan persetujuan untuk dilakukan SHK (Skrining Hipotiroid Kongenital) terhadap Pasien/
                        anak:</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="5%">Nama</td>
                                <td width="20%"><span class="pb-5 visit_name_E11"></span></td>
                                <td width="75%"><span class="visit_gender_E11"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span class="visit_age_E11"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-end mt-4">
                        <p>Surakarta, <span class="date_E11"></span></p>
                    </div>


                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <p>Saksi</p>
                                    <div id="qr_valid_2_E11" align="center"></div>
                                    <div class="mt-4">(<span class="valid_E11"></span>)</div>
                                </td>
                                <td class="text-center">
                                    <p>Yang Menyatakan,</p>
                                    <div id="qr_val_2_E11" align="center"></div>

                                    <div class="mt-4">(<span class="val_E11"></span>)</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</div>

<div id="E12-content" hidden>

    <body>
        <!-- Halaman 1 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="mt-4">
                    <div class="text-center mb-4">
                        <h6><strong>SURAT PENOLAKAN SHK (Skrining Hipotiroid Kongenital)</strong></h6>

                    </div>

                    <p>Yang bertandatangan di bawah ini :</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="5%"><span id="content_val_1_E12" class="content_val_1_E12"></span></td>
                                <td width="75%"><span id="content_val_2_E12" class="content_val_2_E12"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span id="content_val_3_E12" class="content_val_3_E12"></span></td>

                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><span id="content_val_4_E12" class="content_val_4_E12"></span></td>
                            </tr>
                            <tr>
                                <td>Selaku</td>
                                <td><span id="content_val_5_E12" class="content_val_5_E12"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Menyatakan menolak untuk dilakukan SHK (Skrining Hipotiroid Kongenital)
                        terhadap Pasien/ anak :</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="5%">Nama</td>
                                <td width="20%"><span class="pb-5 visit_name_E12"></span></td>
                                <td width="75%"><span class="visit_gender_E12"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span class="visit_age_E12"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-end mt-4">
                        <p>Surakarta, <span class="date_E12"></span></p>
                    </div>


                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <p>Saksi</p>
                                    <div id="qr_valid_1_E12" align="center"></div>
                                    <div class="mt-4">(<span class="valid_E12"></span>)</div>
                                </td>
                                <td class="text-center">
                                    <p>Yang Menyatakan,</p>
                                    <div id="qr_val_1_E12" align="center"></div>

                                    <div class="mt-4">(<span class="val_E12"></span>)</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 2 -->
        <div class="page">
            <div class="container-fluid mt-5">
                <div class="row pb-3">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/logo.png"
                                                ) ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop["name_of_org_unit"] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop["contact_address"] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url(
                                                    "assets/img/paripurna.png"
                                                ) ?>" width="90px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

                <div class="mt-4">
                    <div class="text-center mb-4">
                        <h6><strong>SURAT PENOLAKAN SHK (Skrining Hipotiroid Kongenital)</strong></h6>

                    </div>

                    <p>Yang bertandatangan di bawah ini :</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="5%"><span id="content_val_1_E12" class="content_val_1_E12"></span></td>
                                <td width="75%"><span id="content_val_2_E12" class="content_val_2_E12"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span id="content_val_3_E12" class="content_val_3_E12"></span></td>

                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><span id="content_val_4_E12" class="content_val_4_E12"></span></td>
                            </tr>
                            <tr>
                                <td>Selaku</td>
                                <td><span id="content_val_5_E12" class="content_val_5_E12"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Menyatakan menolak untuk dilakukan SHK (Skrining Hipotiroid Kongenital)
                        terhadap Pasien/ anak :</p>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="5%">Nama</td>
                                <td width="20%"><span class="pb-5 visit_name_E12"></span></td>
                                <td width="75%"><span class="visit_gender_E12"></span></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td><span class="visit_age_E12"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-end mt-4">
                        <p>Surakarta, <span class="date_E12"></span></p>
                    </div>


                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <p>Saksi</p>
                                    <div id="qr_valid_2_E12" align="center"></div>
                                    <div class="mt-4">(<span class="valid_E12"></span>)</div>
                                </td>
                                <td class="text-center">
                                    <p>Yang Menyatakan,</p>
                                    <div id="qr_val_2_E12" align="center"></div>

                                    <div class="mt-4">(<span class="val_E12"></span>)</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</div>

<div id="F01-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => '', 'tindakan' => false, 'id' => 'F01']); ?>
                <!-- endof template table -->
            </div>
        </div>

    </body>
</div>
<div id="F02-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->


                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info-2.php", ['nama_tindakan' => 'GENERAL ANESTESIA']); ?>
                <!-- endof template table -->

            </div>
        </div>
    </body>
</div>
<div id="F03-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->


                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => '', 'tindakan' => false, 'id' => 'F03']); ?>
                <!-- endof template table -->
            </div>
        </div>
    </body>
</div>
<div id="F04-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'REGIONAL ANESTESIA', 'tindakan' => false, 'id' => 'F04']); ?>
                <!-- endof template table -->

            </div>
        </div>
    </body>
</div>
<div id="F05-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'EKSPLORASI DAN REPAIR JALAN LAHIR', 'tindakan' => true, 'id' => 'F05']); ?>
                <!-- endof template table -->

            </div>
        </div>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->

            </div>
        </div>


    </body>
</div>
<div id="F06-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'KURETASE', 'tindakan' => true, 'id' => 'F06']); ?>
                <!-- endof template table -->

            </div>
        </div>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->

            </div>
        </div>


    </body>
</div>
<div id="F07-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'MASSAGE OKSITOSIN', 'tindakan' => true, 'id' => 'F07']); ?>
                <!-- endof template table -->

            </div>
        </div>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->

            </div>
        </div>
    </body>
</div>
<div id="F08-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'INSISI - DRAINASE', 'tindakan' => true, 'id' => 'F08']); ?>
                <!-- endof template table -->

            </div>
        </div>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->

            </div>
        </div>
    </body>
</div>
<div id="F09-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'MARSUPIALISASI', 'tindakan' => true, 'id' => 'F09']); ?>
                <!-- endof template table -->

            </div>
        </div>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->

            </div>
        </div>
    </body>
</div>
<div id="F10-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->


                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'RIPENING/ INDUKSI PERSALINAN/ PACUAN', 'tindakan' => true, 'id' => 'F10']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->

            </div>
        </div>


    </body>
</div>
<div id="F11-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'VERSI- EKSTRAKSI', 'tindakan' => true, 'id' => 'F11']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F12-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'KAUTERISASI', 'tindakan' => true, 'id' => 'F12']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F13-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'INDUKSI PERSALINAN', 'tindakan' => true, 'id' => 'F13']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F14-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => ' PLASENTA  MANUAL', 'tindakan' => true, 'id' => 'F14']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F15-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'TRANFUSI DARAH/KOMPONEN DARAH', 'tindakan' => true, 'id' => 'F15']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F16-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'PERSALINAN PERVAGINAM', 'tindakan' => true, 'id' => 'F16']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F17-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'AFF IUD', 'tindakan' => true, 'id' => 'F17']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F18-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'INSERSI IMPLANT', 'tindakan' => true, 'id' => 'F18']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F19-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => ' AFF IMPLANT', 'tindakan' => true, 'id' => 'F19']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F20-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop 2 -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop 2 -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'SEDASI', 'id' => 'F20']); ?>
                <!-- endof template table -->


            </div>
        </div>

    </body>
</div>
<div id="F21-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <<!-- template kop 2 -->
                    <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                    <!-- endof template kop 2 -->

                    <!-- template table -->
                    <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'DISTOSIA BAHU', 'tindakan' => true, 'id' => 'F21']); ?>
                    <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>

        ---------
    </body>
</div>
<div id="F22-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                'EKSTRAKSI VAKUM', 'tindakan' => true, 'id' => 'F22']); ?>
                <!-- endof template table -->
            </div>
        </div>

        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>
    </body>
</div>
<div id="F23-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop 2 -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop 2 -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'TRANFUSI DARAH/KOMPONEN DARAH', 'tindakan' => true, 'id' => 'F23']); ?>
                <!-- endof template table -->

            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>

    </body>
</div>
<div id="F24-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                'CALDWEL LUC (CWL)', 'tindakan' => false, 'id' => 'F24']); ?>
                <!-- endof template table -->
            </div>
        </div>

        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' =>
                'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->
            </div>
        </div>
    </body>
</div>
<div id="F25-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                ' TONSILECTOMY', 'tindakan' => false, 'id' => 'F25']); ?>
                <!-- endof template table -->
            </div>
        </div>
    </body>
</div>
<div id="F25A-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->
                <div class="text-center">

                    <b id="bagian-F25A"></b>
                    <hr>
                    <b>
                        <p id="petunjuk-F25A"></p>
                    </b>

                    <table>
                        <tbody id="data-table-F25A" style="text-align: justify;">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </body>
</div>
<div id="F26-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'KONKA REDUKSI', 'tindakan' => false, 'id' => 'F26']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F27-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'MIRINGOTOMI', 'tindakan' => false, 'id' => 'F27']); ?>
                <!-- endof template table -->


            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F28-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <<!-- template kop 2 -->
                    <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                    <!-- endof template kop 2 -->

                    <!-- template table -->
                    <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'TIMPANOPLASTI', 'tindakan' => false, 'id' => 'F28']); ?>
                    <!-- endof template table -->


            </div>


        </div>


    </body>
</div>
<div id="F29-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                'REPOSISI FRAKTUR OS NASAL', 'tindakan' => false, 'id' => 'F29']); ?>
                <!-- endof template table -->
            </div>
        </div>
    </body>
</div>
<div id="F30-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                ' BIOPSI', 'tindakan' => false, 'id' => 'F30']); ?>
                <!-- endof template table -->
            </div>
        </div>
    </body>
</div>
<div id="F31-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">



                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->


                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'ADENOIDEKTOMI', 'tindakan' => false, 'id' => 'F31']); ?>
                <!-- endof template table -->


            </div>
        </div>
    </body>
</div>
<div id="F32-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->


                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'POLIPEKTO', 'tindakan' => false, 'id' => 'F32']); ?>
                <!-- endof template table -->

            </div>
        </div>

    </body>
</div>
<div id="F33-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                ' SUBMUKUS SEPTUM RESEKSI', 'tindakan' => false, 'id' => 'F33']); ?>
                <!-- endof template table -->
            </div>
        </div>
    </body>
</div>
<div id="F34-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop 2 -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop 2 -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'INSERSI IUD', 'tindakan' => false, 'id' => 'F34']); ?>
                <!-- endof template table -->

            </div>
        </div>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop-2.php", ['heading' => 'Rekam Medis Rawat Jalan/Darurat/Inap']); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>

    </body>
</div>
<div id="F35-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                ' KISTEKTOMI / SALPINGOOFOREKTOMI', 'tindakan' => false, 'id' => 'F35']); ?>
                <!-- endof template table -->
            </div>
        </div>

        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php"); ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>
    </body>
</div>
<div id="F36-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                ' PEMASANGAN KATETER URINE / DC', 'tindakan' => false, 'id' => 'F36']); ?>
                <!-- endof template table -->
            </div>
        </div>
    </body>
</div>
<div id="F37-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">



                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->


                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'NEAGLE EXTRACTI / CABUT KUKU', 'tindakan' => false, 'id' => 'F37']); ?>
                <!-- endof template table -->


            </div>
        </div>
    </body>
</div>
<div id="F38-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                ' PEMASANGAN INFUS', 'tindakan' => false, 'id' => 'F38']); ?>
                <!-- endof template table -->
            </div>
        </div>
    </body>
</div>
<div id="F39-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">



                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->


                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'PEMBERIAN OBAT INJEKSI (IC, SC, IM DAN IV)', 'tindakan' => false, 'id' => 'F39']); ?>
                <!-- endof template table -->


            </div>
        </div>
    </body>
</div>
<div id="F40-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'PEMASANGAN NGT', 'tindakan' => false, 'id' => 'F40']); ?>
                <!-- endof template table -->

            </div>
        </div>

    </body>
</div>
<div id="F41-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                ' PASANG ATAU AFF TAMPON HIDUNG', 'tindakan' => false, 'id' => 'F41']); ?>
                <!-- endof template table -->
            </div>
        </div>
    </body>
</div>
<div id="F42-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">



                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->


                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'AMPUTASI', 'tindakan' => false, 'id' => 'F42']); ?>
                <!-- endof template table -->


            </div>
        </div>
    </body>
</div>
<div id="F43-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">
                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' =>
                'APPENDEKTOMI', 'tindakan' => false, 'id' => 'F43']); ?>
                <!-- endof template table -->
            </div>
        </div>
    </body>
</div>
<div id="F44-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'BIOPSI INSISI/EKSISI', 'tindakan' => false, 'id' => 'F44']); ?>
                <!-- endof template table -->

            </div>
        </div>

    </body>
</div>
<div id="F45-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'AV-SHUNT(CIMINO)', 'tindakan' => false, 'id' => 'F45']); ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F46-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'DEBRIDEMENT', 'tindakan' => false, 'id' => 'F46']); ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F47-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'EKSISI', 'tindakan' => false, 'id' => 'F47']); ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F48-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'MIOMEKTOMI', 'tindakan' => false, 'id' => 'F48']); ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F49-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => 'EKSTIRPASI', 'tindakan' => false, 'id' => 'F49']); ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F50-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php"); ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ['nama_tindakan' => ' HEMOROIDEKTOMI', 'tindakan' => false, 'id' => 'F50']); ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F51-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => " HERNIA REPAIR", "tindakan" => false, "id" => "F51"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F52-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    [
                        "nama_tindakan" => " HERNIORAFI  DENGAN MESH",
                        "tindakan" => false,
                        "id" => "F52"
                    ]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F53-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "HERNIORAFI", "tindakan" => false, "id" => "F53"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F54-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    [
                        "nama_tindakan" => "Insisi dan Drainage",
                        "tindakan" => false,
                        "id" => "F54"
                    ]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F55-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "KOLESISTEKTOMI", "tindakan" => false, "id" => "F55"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F56-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    [
                        "nama_tindakan" => "LAPARATOMI EKSPLORASI",
                        "tindakan" => false,
                        "id" => "F56"
                    ]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F57-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    [
                        "nama_tindakan" =>
                        "LOBEKTOMI, SUBTOTAL TIROIDEKTOMI, ISTHMOLOBEKTOMI",
                        "tindakan" => false,
                        "id" => "F57"
                    ]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F58-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "LUMPEKTOMI", "tindakan" => false, "id" => "F58"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F59-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "ORCHIDEKTOMI", "tindakan" => false, "id" => "F59"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F60-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "ORIF", "tindakan" => false, "id" => "F60"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F61-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "SIRKUMSISI", "tindakan" => false, "id" => "F61"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F62-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "MASTOIDEKTOMI", "tindakan" => false, "id" => "F62"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>


    </body>
</div>
<div id="F63-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <table class="table table-bordered mt-3">
                    <tbody>
                        <tr>
                            <td colspan="3" valign="center" width="720">
                                <p class="">Yang bertandatangan dibawah ini :</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="bottom" width="130">
                                <p class="">Nama</p>
                            </td>
                            <td colspan="2" valign="bottom" width="590">
                                <p class="">:
                                    &nbsp;..........................................................................................................................................
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="bottom" width="130">
                                <p class="">Umur</p>
                            </td>
                            <td colspan="2" valign="bottom" width="590">
                                <p class="">: &nbsp;................. tahun. Laki laki / Perempuan</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="bottom" width="130">
                                <p class="">Alamat</p>
                            </td>
                            <td colspan="2" valign="bottom" width="590">
                                <p class="">:
                                    &nbsp;..........................................................................................................................................
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="bottom" width="720">
                                <p class="">Dengan ini menyatakan <strong>SETUJU </strong>untuk dilakukan perawatan di
                                    Unit Rawat Intensif terhadap diri saya sendiri / Istri / Suami / Anak / Ayah / Ibu
                                    saya* dengan</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="bottom" width="130">
                                <p class="">Nama</p>
                            </td>
                            <td colspan="2" valign="bottom" width="590">
                                <p class="">:
                                    &nbsp;..........................................................................................................................................
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="bottom" width="130">
                                <p class="">Umur</p>
                            </td>
                            <td colspan="2" valign="bottom" width="590">
                                <p class="">: &nbsp;................. tahun. Laki laki / Perempuan</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="bottom" width="130">
                                <p class="">Alamat</p>
                            </td>
                            <td colspan="2" valign="bottom" width="590">
                                <p class="">:
                                    &nbsp;..........................................................................................................................................
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="bottom" width="720">
                                <p class="">Saya menyatakan mengerti :</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="bottom" width="720">
                                <p class="" align="justify">
                                    <!-- [if !supportLists]--><span>1.&nbsp;</span>
                                    <!--[endif]-->Bahwa berdasarkan penjelasan dokter / petugas di Unit Rawat Intensif,
                                    selama perawatan di ruang intensif dapat terjadi perubahan kondisi termasuk
                                    perubahan, tekanan darah, reaksi obat (alergi), henti jantung, kerusakan otak,
                                    kerusakan saraf, kelumpuhan, bahkan kematian. Saya menyadari hal ini, risiko serta
                                    komplikasi lain yang mungkin dapat terjadi.
                                </p>
                                <p class="" align="justify">
                                    <!-- [if !supportLists]--><span>2.&nbsp;</span>
                                    <!--[endif]-->Bahwa dalam ilmu kedokteran, bukan merupakan ilmu pengetahuan yang
                                    pasti (exact science) dan saya menyadari tidak seorangpun dapat menjajikan atau
                                    menjamin sesuatu yang berhubungan dengan tindakan medis di Unit Rawat Intensif.
                                </p>
                                <p class="" align="justify">
                                    <!-- [if !supportLists]--><span>3.&nbsp;</span>
                                    <!--[endif]-->Bahwa obat-obatan yang digunakan sebelum prosedur di Unit Rawat
                                    Intensif dapat saja menimbulkan komplikasi, oleh karena itu sudah menjadi kewajiban
                                    dan tanggung jawab saya untuk memberikan informasi kepada dokter semua obat-obatan
                                    yang saya sendiri/Istri /Suami/Anak/Ayah/Ibu gunakan, termasuk aspirin, kontrasepsi
                                    narkotik dan lain-lain.
                                </p>
                                <p class="" align="justify">
                                    <!-- [if !supportLists]--><span>4.&nbsp;</span>
                                    <!--[endif]-->Bahwa selama pasien dirawat di Unit Rawat Intensif, dapat dilakukan
                                    tindakan medis sesuai kondisi pasien berdasarkan pertimbangan medis termasuk
                                    intubasi, pemakaian ventilator, kateter vena central arteri line serta transfusi
                                    darah atau produk-produk darah.
                                </p>
                                <p class="" align="justify">
                                    <!-- [if !supportLists]--><span>5.&nbsp;</span>
                                    <!--[endif]-->Bahwa dokter Unit Rawat Intensif yang bertugas dapat melakukan
                                    konsultasi atau mendapat bantuan dari dokter lain sesuai kebutuhan.
                                </p>
                                <p class="" align="justify">
                                    <!-- [if !supportLists]--><span>6.&nbsp;</span>
                                    <!--[endif]-->Bahwa apabila staf Unit Rawat Intensif yang bertugas mengalami luka
                                    tusuk atau terpapar cairan tubuh pasien, pasien setuju untuk diperiksa darahnya.
                                </p>
                                <p class="" align="justify">&nbsp;</p>
                                <p class="" align="justify">Saya menyadari dan mengerti sepenuhnya bahwa pada tindakan
                                    medis, berbagai resiko dan komplikasi yang tidak didiskusikan sebelumya mungkin
                                    dapat timbul.</p>
                                <p class="" align="justify">&nbsp;</p>
                                <p class="" align="justify">Saya juga menyadari selama berlangsungnya tindakan tersebut,
                                    ada kemungkinan timbulnya kondisi yang tidak terduga dimana hal tersebut memerlukan
                                    tindakan-tindakan perluasan yang berhubungan dengana perawatan yang sedang
                                    dilakukan, untuk itu saya menyetujui dilakukanya tindakan tersebut apabila
                                    diperlukan.</p>
                                <p class="" align="justify">&nbsp;</p>
                                <p class="" align="justify">Selanjutnya saya menyadari bahwa tidak ada jaminan atas
                                    janji-janji yang diberikan kepada saya sehubungan dengan hasil dari segala tindakan
                                    dan atau perawatan.</p>
                                <p class="" align="justify">Demikianlah permohonan ini saya buat dengan kesadaran dan
                                    tanpa paksaan.</p>
                                <p class="" align="justify">&nbsp;</p>
                                <p class="" align="justify"><?= $kop["kota"] ?>, tanggal
                                    ..........................................., jam .............. WIB</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top" width="360">
                                <p class="">Saksi-saksi</p>
                                <p class="">
                                    <!-- [if !supportLists]--><span>1.&nbsp;</span>
                                    <!--[endif]-->Keluarga
                                </p>
                                <p class="">&nbsp;</p>
                                <p class="">&nbsp;</p>
                                <p class="">( ....................................)</p>
                            </td>
                            <td valign="top" width="360">
                                <p class="" align="center">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang
                                    membuat pernyataan</p>
                                <p class="" align="center">&nbsp;</p>
                                <p class="">&nbsp;</p>
                                <p class="" align="center">&nbsp;</p>
                                <p class="" align="center">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(....................................)
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top" width="360">
                                <p class="">
                                    <!-- [if !supportLists]--><span>2.&nbsp;</span>
                                    <!--[endif]-->Petugas
                                </p>
                                <p class="">&nbsp;</p>
                                <p class="">&nbsp;</p>
                                <p class="">( ....................................)</p>
                            </td>
                            <td valign="top" width="360">
                                <p class="" align="center">&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="">*) <em>Coret yang tidak dipilih</em></p>


            </div>
        </div>


    </body>
</div>
<div id="F64-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "FOTOTERAPI", "tindakan" => false]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>

        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view(
                    "admin/patient/profilemodul/template/template-tindakan-dokter.php"
                ) ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F65-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    [
                        "nama_tindakan" =>
                        "CPAP (Continuous Positive Airway Pressure)",
                        "tindakan" => false,
                        "kelas" => true,
                    ]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>

        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view(
                    "admin/patient/profilemodul/template/template-tindakan-dokter.php"
                ) ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F66-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    [
                        "nama_tindakan" => "VAKSINASI",
                        "tindakan" => false,
                        "kelas" => true,
                    ]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>

        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view(
                    "admin/patient/profilemodul/template/template-tindakan-dokter.php"
                ) ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F67-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    [
                        "nama_tindakan" => "KMC/KANGOROO MOTHER CARE",
                        "tindakan" => false,
                        "kelas" => true,
                    ]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>

        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view(
                    "admin/patient/profilemodul/template/template-tindakan-dokter.php"
                ) ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F68-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->
                <table class="table table-bordered mt-3">
                    <tbody>
                        <tr>
                            <td valign="top" width="723">
                                <p align="center"><strong>FORMULIR IJIN KLIEN</strong></p>
                                <p align="center"><strong>UNTUK PEMERIKSAAN ANTI HIV</strong></p>
                                <p align="center"><strong><em>(NFORMED CONSENT)</em></strong></p>
                                <p align="center"><strong><em>&nbsp;</em></strong></p>
                                <p align="justify">Sebelum menanda tangani &nbsp;formulir ijin ini, perlu diketahui
                                    bahwa :</p>
                                <p class="16" align="justify">
                                    <!-- [if !supportLists]--><span>-&nbsp;</span>
                                    <!--[endif]-->Anda mempunyai hak untuk berperan serta dalam tes/pemeriksaan dengan
                                    dasar kerahasiaan
                                </p>
                                <p class="16" align="justify">
                                    <!-- [if !supportLists]--><span>-&nbsp;</span>
                                    <!--[endif]-->Anda mempunyai hak menarik ijin dari tes/pemeriksaan, kapanpun sebelum
                                    tes tersebut dilaksananan
                                </p>

                                <table class="table table-bordered mt-3">
                                    <colgroup>
                                        <col style="width: 99.8617%;">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>Saya telah menerima informasi dan konseling menyangkut hal-hal
                                                    berikut ini :</p>
                                                <p class="15">
                                                    <!-- [if !supportLists]--><span>a.&nbsp;</span>
                                                    <!--[endif]-->Keberadaan, kegunaan dan tujuan dari tes/pemeriksaan
                                                    anti HIV
                                                </p>
                                                <p class="15">
                                                    <!-- [if !supportLists]--><span>b.&nbsp;</span>
                                                    <!--[endif]-->Apa yang dapat dan tidak dapat diberitahukan dari
                                                    tes/pemeriksaan anti HIV
                                                </p>
                                                <p class="15">
                                                    <!-- [if !supportLists]--><span>c.&nbsp;</span>
                                                    <!--[endif]-->Keuntungan serta resiko dari tes /pemeriksaan anti HIV
                                                    dan dari mengetahui hasil tes/pemeriksaan anti HIV
                                                </p>
                                                <p class="15">
                                                    <!-- [if !supportLists]--><span>d.&nbsp;</span>
                                                    <!--[endif]-->Pemahaman dari positif, negatif, negatif palsu,
                                                    positif palsu dan hasil meragukan serta dampak dari masa jendela
                                                </p>
                                                <p class="15">
                                                    <!-- [if !supportLists]--><span>e.&nbsp;</span>
                                                    <!--[endif]-->Pengukuran untuk pencegahan dari pemaparan dan
                                                    penularan oleh HIV
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-3">
                                    <colgroup>
                                        <col style="width: 99.8617%;">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p align="justify">Saya, dengan sukarela menyetujui untuk menjalani
                                                    tes/pemeriksaan anti HIV dengan ketentuanbahwa hasil tes tersebut
                                                    akan tetap dirahasiakan dan terbuka hanya kepada saya seorang.</p>
                                                <p align="justify">Saya menyetujui untuk menerima pelayanan konseling
                                                    setelah menjalani tes/pemeriksaan untuk mendiskusikan hasil-hasil
                                                    tes/pemeriksaan anti HIV saya dengan cara-cara mengurangi risiko
                                                    terkena HIV atau menyebarluaskan kepada orang lain untuk masa yang
                                                    akan datang</p>
                                                <p align="justify">Saya mengerti bahwa pelayanan kesehatan saya di
                                                    klinik ini tidak akan mempengaruhi keputusan saya secara negatif
                                                    terhadap tes atau tidak menjalani tes atau hasil tes anti HIV saya
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered mt-3">
                                    <colgroup>
                                        <col style="width: 99.8617%;">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>Saya, dengan ini mengijinkan untuk dilaksanankan tes/pemeriksaan anti
                                                    HIV</p>
                                                <p>&nbsp;</p>
                                                <p>_________________________ __________________ _________________</p>
                                                <p>Tandatangan/cap jempol klien Tandatangan konselor Tanggal</p>
                                                <p>&nbsp;</p>
                                                <p>Untuk anak di bawah umur</p>
                                                <p>Saya _______________________________ orang tua/wali
                                                    /pengasuh/teman/saudara terdekat*, memberikan ijin untuk
                                                    melaksanakan tes/pemeriksaan anti HIV (*coret yang tidak perlu)</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered mt-3">
                    <tbody>
                        <tr>
                            <td valign="top" width="727">
                                <p align="center"><strong>&nbsp;</strong></p>
                                <p align="center"><strong>&nbsp;</strong></p>
                                <p align="center"><strong>FORMULIR PENOLAKAN TES SKRINING HIV</strong></p>
                                <p align="justify">&nbsp;</p>
                                <p align="justify">Saya yang bertandatangan di bawah ini telah diberi penjelasan dan
                                    kegunaan dari pemeriksaan skrining HIV serta prosedurnya, namun saya tidak bersedia
                                    atau belum siap untuk melakukan pemeriksaan HIV.</p>
                                <p align="justify">Demikian surat pernyataan ini kami buatkan untuk dipergunakan
                                    seperlunya</p>
                                <p align="justify">&nbsp;</p>
                                <p align="justify">&nbsp;</p>
                                <p align="justify">&nbsp;</p>
                                <p align="justify">&nbsp;</p>
                                <p>Yang memberi pernyataan Petugas</p>
                                <p align="justify">&nbsp;</p>
                                <p align="justify">&nbsp;</p>
                                <p align="justify">&nbsp;</p>
                                <p>...........................................
                                    .............................................</p>
                                <p align="center">&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>



    </body>
</div>
<div id="F69-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "GRANULOMEKTOMI", "tindakan" => false, "id" => "F69"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>



    </body>
</div>
<div id="F70-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "KAUTERISASI", "tindakan" => false, "id" => "F70"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>

        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view(
                    "admin/patient/profilemodul/template/template-tindakan-dokter.php"
                ) ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>

<div id="F71-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php") ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ["nama_tindakan" => "INSISI – DRAINASE KISTA NABOTY", "tindakan" => true, "id" => "F71"]) ?>
                <!-- endof template table -->


            </div>
        </div>

        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php") ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view("admin/patient/profilemodul/template/template-tindakan-dokter.php") ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F72-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view("admin/patient/profilemodul/template/template-kop.php") ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view("admin/patient/profilemodul/template/template-info.php", ["nama_tindakan" => "PEMASANGAN WSD", "tindakan" => false, "id" => "F72"]) ?>
                <!-- endof template table -->


            </div>
        </div>



    </body>
</div>

<div id="F73-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    [
                        "nama_tindakan" => "FISTULECTOMY/FISTULOTOMY",
                        "tindakan" => false,
                        "id" => "F73"
                    ]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>



    </body>
</div>
<div id="F74-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    ["nama_tindakan" => "HISTEREKTOMI", "tindakan" => false, "id" => "F74"]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>

        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view(
                    "admin/patient/profilemodul/template/template-tindakan-dokter.php"
                ) ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>
<div id="F75-content" hidden>

    <body>
        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template table -->
                <?= view(
                    "admin/patient/profilemodul/template/template-info.php",
                    [
                        "nama_tindakan" =>
                        "SHK (Skrining Hipotiroid Kongenital)",
                        "tindakan" => false,
                        "id" => "F75"
                    ]
                ) ?>
                <!-- endof template table -->


            </div>
        </div>

        <div class="page">
            <div class="container-fluid">


                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop.php"
                ) ?>
                <!-- endof template kop -->

                <!-- template tindakan dokter -->
                <?= view(
                    "admin/patient/profilemodul/template/template-tindakan-dokter.php"
                ) ?>
                <!-- endof template tindakan dokter -->


            </div>
        </div>


    </body>
</div>



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

<!-- data  -->
<script>
    $(document).ready(function() {
        getDataStart()
        let data1 = <?= json_encode($visit) ?>;
        let visitation = <?= json_encode($visitation[0]) ?>;
        console.log(data1);
    });

    const getDataStart = () => {
        let data1 = <?= json_encode($visit) ?>;
        let param = data1?.parameter_id;


        if (param !== undefined) {
            let lastPart;

            if (typeof param === 'string') {
                if (param.includes('_')) {
                    let parts = param.split('_');
                    lastPart = parts[parts.length - 1];
                } else {
                    lastPart = param;
                }
            } else if (typeof param === 'number') {
                lastPart = param.toString();
            } else {
                console.error('Parameter ID is not valid or undefined.');
            }



            if (lastPart !== undefined) {
                $(`#${lastPart}-content`).removeAttr("hidden");
            } else {
                console.error('Cannot find valid lastPart to remove hidden attribute.');
            }
        } else {
            console.error('Parameter ID is not valid or undefined.');
        }

        postData({
            body_id: data1?.body_id,
            visit_id: data1?.visit_id,
            parameter_id: data1?.parameter_id
        }, 'admin/InformedConsent/getDetail', (res) => {
            let hasil = {
                data: res
            };
            contentData(hasil);
        });

    };

    const contentData = (result) => {

        let visitation = <?= json_encode($visitation[0]) ?>;
        let visit = <?= json_encode($visit['visit']) ?>;
        let resultDataLine = [];

        function trimQuotesAndSpaces(str) {
            return str.trim().replace(/^"+|"+$/g, '').replace(/^\\+"|\\+"$/g, '').replace(/<p>|<\/p>/g, '');
        }
        //new
        if (result.data[0].parameter_id === "RM_9_E01") {

            const startId = "G017E0117";
            const endId = "G017E0123";
            const startNum = parseInt(startId.slice(-2));
            const endNum = parseInt(endId.slice(-2));
            const baseId = startId.slice(0, -2);
            let rowIndex = 1;
            result?.data?.forEach((item, index) => {

                let hasival_info = trimQuotesAndSpaces(item.value_info)
                const itemIdNum = parseInt(item.value_id.slice(-2));
                let trimmedValueDesc = trimQuotesAndSpaces(item.value_desc);
                if (trimmedValueDesc !== "" && itemIdNum >= startNum && itemIdNum <= endNum) {
                    resultDataLine +=
                        `<tr><td>${rowIndex}. <b>${trimmedValueDesc}</b>. ${hasival_info}</td></tr>`;
                    rowIndex++;
                }
            });
            $("#data-E01").html(resultDataLine);

            let data2 = <?= json_encode($AValue) ?>

            let hasil = "";
            const startIdDown = "G017E0124";
            const endIdDown = "G017E0126";
            const startNumDown = parseInt(startIdDown.slice(-2));
            const endNumDown = parseInt(endIdDown.slice(-2));
            const baseIdDown = startIdDown.slice(0, -2);
            let aValue = data2.filter(item => item.value_desc === "");
            aValue.forEach(item => {
                const itemIdNumDown = parseInt(item.value_id.slice(-2));

                if (itemIdNumDown >= startNumDown && itemIdNumDown <= endNumDown) {
                    hasil += `<p id="${item?.value_id}">${item?.value_info}</p>`;
                }
            });

            $("#hasil-Avalue-desc").html(hasil);

            // ttd
            let petugas = new QRCode(document.getElementById(`qrcode-petugas-E01`), {
                text: result.data[0]?.valid_user ?? "petugas",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            let pasien = new QRCode(document.getElementById(`qrcode-pasien-E01`), {
                text: result?.data[9]?.value_info || "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            $("#text-petugas-E01").html(`(${result.data[0]?.valid_user ?? ""})`);
            $("#text-pasien-E01").html(`(${result?.data[9]?.value_info || "-"})`);

            // content
            $("#code-E01").html(result.data[0].parameter_id.replace(/_/g, ' '));
            // pasien

            $(".name_of_pasien-E01").html(visit.name_of_pasien);
            $(".date_of_birth-E01").html(moment(visit.date_of_birth).format("DD-MM-YYYY"));
            $(".name_of_gender-E01").html(visit.name_of_gender);
            $(".contact_address-E01").html(visit.contact_address);
            $(".no_registration-E01").html(visit.no_registration);
            $(".noTlp-E01").html(visit.phone_number || "-");


            // PENANGGUNGJAWAB

            getDataIdTables({
                id: result?.data[11]?.value_info,
                score: result?.data[11]?.value_score,
                vId: result?.data[11]?.value_id,
                element: ".p_name_of_gender-E01"
            })
            getDataIdTables({
                id: result?.data[14]?.value_info,
                score: result?.data[14]?.value_score,
                vId: result?.data[14]?.value_id,
                element: ".selaku-E01"
            })
            // $(".selaku-E01").html(result.data[14].value_info)
            // $(".p_name_of_gender-E01").html(result?.data[11]?.value_info);
            $(".p_name_of_pasien-E01").html(result?.data[9]?.value_info || "-");
            $(".p_date_of_birth-E01").html(!result?.data[10]?.value_info ? "-" : moment(result?.data[10]?.value_info)
                .format("DD-MM-YYYY"));
            $(".p_contact_address-E01").html(result?.data[12]?.value_info || "-");
            $(".p_noTlp-E01").html(result?.data[13]?.value_info || "-");

            // actionCetak();

        } else if (result.data[0].parameter_id === "RM_9_E02") {
            let avalue = <?= json_encode($AValue) ?>;
            let visit = <?= json_encode($visit) ?>;

            let aValueTabels = avalue.filter(item => item.value_score === 8);
            let valValue = avalue.filter(item => item.value_score === 9);

            let value = result.data.filter(item => item.value_score === 3 || item.value_score === 7 || item
                .value_score === 1)
            // content
            aValueTabels.map((item, index) => {
                return $(`#content-${index+1}-E02`).html(item.value_info)
            })
            getDataIdTables({
                id: value[8].value_info,
                score: value[8].value_score,
                vId: value[8].value_id,
                element: "#contentInclass-E02"
            });
            getDataIdTables({
                id: value[9].value_info,
                score: value[9].value_score,
                vId: value[9].value_id,
                element: "#contenttoclass-E02"
            });
            getDataIdTables({
                id: value[10].value_info,
                score: value[10].value_score,
                vId: value[10].value_id,
                element: "#contentInKriteria-E02"
            });
            getDataIdTables({
                id: value[11].value_info,
                score: value[11].value_score,
                vId: value[11].value_id,
                element: "#contentToKriteria-E02"
            });

            $("#content-alasan-E02").html(result?.data[21].value_info)

            let tablesdown = [];
            let visitInfo = visit.visit;

            valValue.forEach((item) => {
                let visitVal = item.value_info;
                let visitData = visitInfo[visitVal];

                tablesdown.push(`<tr>
                            <td class="p-1">${item.value_desc}</td>
                            <td class="p-1">: ${visitData}</td>
                    </tr>`);
            });

            $("#content-tables-down-E02").html(tablesdown.join(''));

            //tabels content
            let datatabels = [];
            let stopLoop = false;

            for (let i = 0; i < value.length; i++) {
                const item = value[i];

                datatabels.push(`<tr>
                        <td class="p-1">${item.value_desc}</td>
                        <td class="p-1" id="value-info-${item.value_id}">: ${item.value_info}</td>
                    </tr>`);

                if (item.value_id === "G017E0210") {
                    stopLoop = true;
                }

                if (stopLoop) {
                    break;
                }

                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `#value-info-${item.value_id}`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }
            }

            $("#content_tabels-E02").html(datatabels.join(''));

            for (let i = 0; i < value.length; i++) {
                const item = value[i];
                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `#value-info-${item.value_id}`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }
            }

            new QRCode(document.getElementById(`qr-doctor-E02`), {
                text: visit?.visit?.fullname_from,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr-menyatakan-E02`), {
                text: value[0]?.value_info,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr-saksi-E02`), {
                text: !value[0]?.valid_other ? "-" : value[0]?.valid_other,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });


            $("#saksi-E02").html(!value[0]?.valid_other ? "-" : value[0]?.valid_other)
            $("#menyatakan-E02").html(value[0]?.value_info)
            $("#doctor-E02").html(visit?.visit?.fullname_from)
            $("#date-E02").html(moment(new Date()).format("DD-MMM-YYYY"))
        } else if (result.data[0].parameter_id === "RM_9_E03") {
            let avalue = <?= json_encode($AValue) ?>;
            let visit = <?= json_encode($visit) ?>;

            let aValueTabels = avalue.filter(item => item.value_score === 8);
            let valValue = avalue.filter(item => item.value_score === 9);

            let value = result.data.filter(item => item.value_score === 3 || item.value_score === 7 || item
                .value_score === 1)
            $(".contentIsi-E03").html(`${value[4].value_desc} : ${value[4].value_info}`)

            $(".name_of_pasien-E03").html(visit?.visit.name_of_pasien)
            $(".age-E03").html(visit?.visit.age)
            $(".date-E03").html(moment(new Date()).format("DD-MMM-YYYY"))
            $(".saksi-E03").html(!value[0]?.valid_other ? "-" : value[0]?.valid_other)
            $(".menyatakan-E03").html(value[0]?.value_info)


            //tabels content
            let datatabels = [];
            let stopLoop = false;

            for (let i = 0; i < value.length; i++) {
                const item = value[i];

                datatabels.push(`<tr>
                    <td class="p-1">${item.value_desc}</td>
                    <td class="p-1" id="value-info-${item.value_id}">: ${item.value_info}</td>
                </tr>`);

                if (item.value_id === "G017E0305") {
                    stopLoop = true;
                }

                if (stopLoop) {
                    break;
                }

                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `#value-info-${item.value_id}`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }
            }

            $(".content_tabels-E03").html(datatabels.join(''));

            for (let i = 0; i < value.length; i++) {
                const item = value[i];
                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `#value-info-${item.value_id}`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }
            }

            new QRCode(document.getElementById(`qr-saksi-1-E03`), {
                text: !value[0]?.valid_other ? "-" : value[0]?.valid_other,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr-saksi-2-E03`), {
                text: !value[0]?.valid_other ? "-" : value[0]?.valid_other,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr-menyarakan-1-E03`), {
                text: value[0]?.value_info,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr-menyarakan-2-E03`), {
                text: value[0]?.value_info,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

        } else if (result.data[0].parameter_id === "RM_9_E04") {
            // render tables
            const startId = "G017E0406";
            const endId = "G017E0413";
            const startNum = parseInt(startId.slice(-2));
            const endNum = parseInt(endId.slice(-2));
            const baseId = startId.slice(0, -2);
            let rowIndex = 1;
            result?.data.forEach((item, index) => {
                const itemIdNum = parseInt(item.value_id.slice(-2));
                let trimmedValueDesc = trimQuotesAndSpaces(item.value_desc);
                if (trimmedValueDesc !== "" && itemIdNum >= startNum && itemIdNum <= endNum) {
                    resultDataLine += `<tr>
                                    <td class="text-left p-2 fit">${rowIndex}</td>
                                    <td class="text-left p-2 fit">${trimmedValueDesc}</td>
                                    <td class="text-left p-2 fit isi-informasi">${item.value_info}</td>
                                    <td class="text-left p-2 fit tanda"><div id="qrcode-${item.value_id}-E04"></div></td>
                                </tr>`;
                    rowIndex++;
                }
            });
            $("#data_js-E04").html(resultDataLine);

            result?.data?.forEach(e => {
                let element = document.getElementById(`qrcode-${e.value_id}-E04`);
                if (element) {
                    new QRCode(element, {
                        text: result?.data[4].value_info.replace(/<p>|<\/p>/g, ''),
                        width: 50,
                        height: 50,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
            });

            // ttd
            new QRCode(document.getElementById(`qr-docter-E04`), {
                text: visit?.fullname_from,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            new QRCode(document.getElementById(`qrcode-menyatakan-E04`), {
                text: result?.data[16].value_info.replace(/<p>|<\/p>/g, ''),
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            new QRCode(document.getElementById(`qrcode-keluarga-E04`), {
                text: result?.data[0].valid_other ?? "other",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            new QRCode(document.getElementById(`qrcode-bidan-E04`), {
                text: result?.data[0].valid_user ?? "user",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            // PEMBERIAN INFORMASI
            let data2 = <?= json_encode($AValue) ?>;
            let hasil = "";

            let aValue = data2.filter(item => item.value_desc === "");
            $(".fullname_from-E04").html(visit?.fullname_from);
            $(".pemberi_informasi-E04").html(result?.data[3].value_info.replace(/<p>|<\/p>/g, ''));
            $(".Penerima_Informasi-E04").html(result?.data[4].value_info.replace(/<p>|<\/p>/g, ''));
            $("#content-13-E04").html(aValue[3]?.value_info);
            $("#setuju-14-E04").html(result?.data[14].value_desc);
            $(".name-E04").html(result?.data[16].value_info.replace(/<p>|<\/p>/g, ''));
            $(".age-E04").html(result?.data[18].value_info.replace(/<p>|<\/p>/g, ''));
            $(".address-E04").html(result?.data[17].value_info.replace(/<p>|<\/p>/g, ''));


            getDataIdTables({
                id: result?.data[19]?.value_info,
                score: result?.data[19]?.value_score,
                vId: result?.data[19]?.value_id,
                element: ".gender-E04"
            })

            // $(".gender-E04").html(genderText);
            $("#val-setuju-E04").html(result?.data[14].value_info.replace(/<p>|<\/p>/g, ''));
            $("#terhadap-E04").html(result?.data[21].value_info.replace(/<p>|<\/p>/g, ''));
            $("#rujuk-E04").html(result?.data[20].value_info.replace(/<p>|<\/p>/g, ''));
            $("#keluarga-E04").html(result?.data[0].valid_other);
            $("#bidan-E04").html(result?.data[0].valid_user);

            // pasien
            $("#name-pasien-E04").html(visit?.name_of_pasien);
            $("#age-pasien-E04").html(visit?.ageyear);
            $("#address-pasien-E04").html(visit?.contact_address);
            $("#gender-pasien-E04").html(visit?.gendername);
            $("#date-E04").html(moment(new Date).format("DD/MMM/YYYY"));
            $("#time-E04").html(moment(new Date).format("HH:mm"));

        } else if (result.data[0].parameter_id === "RM_9_E05") {
            let avalue = <?= json_encode($AValue) ?>;
            let visit = <?= json_encode($visit) ?>;

            let aValueTabels = avalue.filter(item => item.value_score === 8);
            let valValue = avalue.filter(item => item.value_score === 9);

            let value = result.data.filter(item => item.value_score === 3 || item.value_score === 7 || item
                .value_score === 1 || item.value_score === 4)
            $(".contentIsi-E03").html(`${value[4].value_desc} : ${value[4].value_info}`)

            $(".name-E05").html(visit?.visit.diantar_oleh)
            $(".age-E05").html(visit?.visit.age)
            $(".gender-E05").html(visit?.visit.name_of_gender)
            $(".identity-E05").html(visit?.visit.pasien_id)
            $(".room-E05").html(visit?.visit.class_room_id)
            $(".register-E05").html(visit?.visit.no_registration)

            $(".date-E05").html(moment(new Date()).format("DD-MMM-YYYY"))
            $("#valid_other_ttd-E05").html(!value[0]?.valid_other ? "-" : value[0]?.valid_other)
            $("#valid_user-ttd-E05").html(!value[0]?.valid_other ? "-" : value[0]?.valid_other)
            $("#val-ttd-E05").html(value[0]?.value_info)
            $("#doctor-ttd-E05").html(!visit?.visit?.fullname ? "-" : visit?.visit?.fullname)


            //tabels content
            let datatabels = [];
            let stopLoop = false;
            for (let i = 0; i < value.length; i++) {
                const item = value[i];
                let number = i + 1;


                $(`#content_val_${number}-E05`).html(item.value_info);

                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `#content_val_${number}-E05`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }

                if (item.value_id === "G017E0305") {
                    stopLoop = true;
                }

                if (stopLoop) {
                    break;
                }
            }


            new QRCode(document.getElementById(`qr-val-E05`), {
                text: !value[0]?.value_info ? "-" : value[0]?.value_info,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr-valid_other-E05`), {
                text: !value[0]?.valid_other ? "-" : value[0]?.valid_other,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr-valid_user-E05`), {
                text: !value[0]?.valid_user ? "-" : value[0]?.valid_user,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            new QRCode(document.getElementById(`qr-doctor-E05`), {
                text: !visit?.visit?.fullname ? "-" : visit?.visit?.fullname,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

        } else if (result.data[0].parameter_id === "RM_9_E06") {
            let avalue = <?= json_encode($AValue) ?>;
            let visit = <?= json_encode($visit) ?>;

            let aValueTabels = avalue.filter(item => item.value_score === 8);
            let valValue = avalue.filter(item => item.value_score === 9);

            let value = result.data.filter(item => item.value_score === 3 || item.value_score === 7 || item
                .value_score === 1 || item.value_score === 4)
            $("#val_visit_name_E06").html(visit?.visit.diantar_oleh)
            $("#val_visit_age_E06").html(visit?.visit.age)
            $("#val_visit_gender_E06").html(visit?.visit.name_of_gender)
            $("#val_visit_address_E06").html(visit?.visit.visitor_address)


            $("#date_E06").html(moment(new Date()).format("DD-MMM-YYYY HH:mm"))
            $("#text_valid_other_E06").html(!value[0]?.valid_other ? "-" : value[0]?.valid_other)
            $("#text_valid_user_E06").html(!value[0]?.valid_other ? "-" : value[0]?.valid_other)
            $("#text_val_content_E06").html(value[0]?.value_info)



            //tabels content
            let datatabels = [];
            let stopLoop = false;
            for (let i = 0; i < value.length; i++) {
                const item = value[i];
                let number = i + 1;


                $(`#val_content_${number}_E06`).html(item.value_info);

                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `#val_content_${number}_E06`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }

                if (item.value_id === "G017E0305") {
                    stopLoop = true;
                }

                if (stopLoop) {
                    break;
                }
            }


            new QRCode(document.getElementById(`qr_val_content_E06`), {
                text: !value[0]?.value_info ? "-" : value[0]?.value_info,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_valid_other_E06`), {
                text: !value[0]?.valid_other ? "-" : value[0]?.valid_other,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_valid_user_E06`), {
                text: !value[0]?.valid_user ? "-" : value[0]?.valid_user,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });



        } else if (result.data[0].parameter_id === "RM_9_E07") {
            let avalue = <?= json_encode($AValue) ?>;
            let visit = <?= json_encode($visit) ?>;

            let aValueTabels = avalue.filter(item => item.value_score === 8);
            let valValue = avalue.filter(item => item.value_score === 9);

            let value = result.data.filter(item => item.value_score === 3 || item.value_score === 7 || item
                .value_score === 1 || item.value_score === 4)

            $("#content_visit_name_E07").html(visit?.visit.diantar_oleh)
            $("#content_visit_register_E07").html(visit?.visit.no_registration)


            $("#date_E07").html(moment(new Date()).format("DD-MMM-YYYY HH:mm"))
            $("#docter_E07").html(visit?.visit.fullname)
            $("#val_E07").html(value[0]?.value_info)



            //tabels content
            let datatabels = [];
            let stopLoop = false;
            for (let i = 0; i < value.length; i++) {
                const item = value[i];
                let number = i + 1;


                $(`#content_value_${number}_E07`).html(item.value_info);

                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `#content_value_${number}_E07`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }

                if (item.value_id === "G017E0305") {
                    stopLoop = true;
                }

                if (stopLoop) {
                    break;
                }
            }


            new QRCode(document.getElementById(`qr_val_E07`), {
                text: !value[0]?.value_info ? "-" : value[0]?.value_info,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_docter_E07`), {
                text: visit?.visit.fullname,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });



        } else if (result.data[0].parameter_id === "RM_9_E08") {
            let data2 = <?= json_encode($AValue) ?>;
            let hasil = "";

            let aValue = data2.filter(item => item.value_desc === "");

            getDataIdTables({
                id: result?.data[6]?.value_info,
                score: result?.data[6]?.value_score,
                vId: result?.data[6]?.value_id,
                element: ".gender-val-E08"
            })


            $(".name-val-E08").html(result.data[1].value_info.replace(/<p>|<\/p>/g, ''));
            $(".age-val-E08").html(result.data[2].value_info.replace(/<p>|<\/p>/g, ''));
            $(".address-val-E08").html(result.data[3].value_info.replace(/<p>|<\/p>/g, ''));
            $(".identity-val-E08").html(result.data[4].value_info.replace(/<p>|<\/p>/g, ''));
            $(".anestesi-val-E08").html(result.data[8].value_info.replace(/<p>|<\/p>/g, ''));
            $(".terhadap-val-E08").html(result.data[9].value_info.replace(/<p>|<\/p>/g, ''));


            $("#content_deskripsi-E08").html(aValue[3]?.value_info);
            $("#content_deskripsi2-E08").html(aValue[4]?.value_info);
            $("#date-E08").html(moment(new Date).format("DD"));
            $("#month-E08").html(moment(new Date).format("MMMM"));
            $("#year-E08").html(moment(new Date).format("YYYY"));

            // pasien
            $(".name-E08").html(visit.name_of_pasien);
            $(".age-E08").html(visit.ageyear);
            $(".adress-E08").html(visit.contact_address);
            $(".room-E08").html(visit.name_of_clinic);
            $(".noregister-E08").html(visit.no_registration);

            // ttd
            new QRCode(document.getElementById(`qrcode-keluarga-E08`), {
                text: !result.data[0].valid_other ? "-" : result.data[0].valid_other,
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qrcode-pernyataan-E08`), {
                text: !result.data[1].value_info ? "-" : result.data[1].value_info.replace(/<p>|<\/p>/g, ''),
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qrcode-Perawat-E08`), {
                text: !result.data[0].valid_user ? "-" : result.data[0].valid_user,
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            // text ttd
            $("#text-keluarga-E08").html(!result.data[0].valid_other ? "-" : result.data[0].valid_other)
            $("#text-pernyataan-E08").html(!result.data[1].value_info ? "-" : result.data[1].value_info.replace(
                /<p>|<\/p>/g, ''))
            $("#text-Perawat-E08").html(!result.data[0].valid_user ? "-" : result.data[0].valid_user)


        } else if (result.data[0].parameter_id === "RM_9_E09") {
            let avalue = <?= json_encode($AValue) ?>;
            let visit = <?= json_encode($visit) ?>;

            let aValueTabels = avalue.filter(item => item.value_score === 8);
            let valValue = avalue.filter(item => item.value_score === 9);

            let value = result.data.filter(item => item.value_score === 3 || item.value_score === 7 || item
                .value_score === 1 || item.value_score === 4)

            $(".content_visit_room_E09").html(visit?.visit.class_room_id ?? "-")
            $(".content_visit_register_E09").html(visit?.visit.no_registration ?? "-")
            $(".content_visit_name_E09").html(visit?.visit.diantar_oleh ?? "-")
            $(".content_visit_age_E09").html(visit?.visit.age ?? "-")
            $(".content_visit_gender_E09").html(visit?.visit.name_of_gender ?? "-")


            $(".date_E09").html(moment(new Date()).format("DD-MMM-YYYY HH:mm"))
            $(".valid_E09").html(value[0]?.valid_other ?? "-")
            $(".val_E09").html(value[0]?.value_info ?? "-")


            //tabels content
            let datatabels = [];
            let stopLoop = false;
            for (let i = 0; i < value.length; i++) {
                const item = value[i];
                let number = i + 1;


                $(`.content_val_${number}_E09`).html(item.value_info);

                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `.content_val_${number}_E09`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }

                if (item.value_id === "G017E0305") {
                    stopLoop = true;
                }

                if (stopLoop) {
                    break;
                }
            }


            new QRCode(document.getElementById(`qr_valid_1_E09`), {
                text: value[0]?.valid_other ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_val_1_E09`), {
                text: value[0]?.value_info ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_valid_2_E09`), {
                text: value[0]?.valid_other ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_val_2_E09`), {
                text: value[0]?.value_info ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });



        } else if (result.data[0].parameter_id === "RM_9_E10") {
            let avalue = <?= json_encode($AValue) ?>;
            let visit = <?= json_encode($visit) ?>;

            let aValueTabels = avalue.filter(item => item.value_score === 8);
            let valValue = avalue.filter(item => item.value_score === 9);

            let value = result.data.filter(item => item.value_score === 3 || item.value_score === 7 || item
                .value_score === 1 || item.value_score === 4)

            $(".visit_name_E10").html(visit?.visit.diantar_oleh)
            $(".visit_gender_E10").html(visit?.visit.gendername)
            $(".visit_age_E10").html(visit?.visit.age)


            $(".date_E10").html(moment(new Date()).format("DD-MMM-YYYY HH:mm"))
            $(".valid_E10").html(value[0]?.valid_other ?? "-")
            $(".val_E10").html(value[0]?.value_info ?? "-")



            //tabels content
            let datatabels = [];
            let stopLoop = false;
            for (let i = 0; i < value.length; i++) {
                const item = value[i];
                let number = i + 1;


                $(`.content_val_${number}_E10`).html(item.value_info);

                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `.content_val_${number}_E10`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }

                if (item.value_id === "G017E0305") {
                    stopLoop = true;
                }

                if (stopLoop) {
                    break;
                }
            }


            new QRCode(document.getElementById(`qr_valid_1_E10`), {
                text: value[0]?.valid_other ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_val_1_E10`), {
                text: value[0]?.value_info ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_valid_2_E10`), {
                text: value[0]?.valid_other ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_val_2_E10`), {
                text: value[0]?.value_info ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });



        } else if (result.data[0].parameter_id === "RM_9_E11") {
            let avalue = <?= json_encode($AValue) ?>;
            let visit = <?= json_encode($visit) ?>;

            let aValueTabels = avalue.filter(item => item.value_score === 8);
            let valValue = avalue.filter(item => item.value_score === 9);

            let value = result.data.filter(item => item.value_score === 3 || item.value_score === 7 || item
                .value_score === 1 || item.value_score === 4)

            $(".visit_name_E11").html(visit?.visit.diantar_oleh)
            $(".visit_gender_E11").html(visit?.visit.gendername)
            $(".visit_age_E11").html(visit?.visit.age)


            $(".date_E11").html(moment(new Date()).format("DD-MMM-YYYY HH:mm"))
            $(".valid_E11").html(value[0]?.valid_other ?? "-")
            $(".val_E11").html(value[0]?.value_info ?? "-")



            //tabels content
            let datatabels = [];
            let stopLoop = false;
            for (let i = 0; i < value.length; i++) {
                const item = value[i];
                let number = i + 1;


                $(`.content_val_${number}_E11`).html(item.value_info);

                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `.content_val_${number}_E11`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }

                if (item.value_id === "G017E0305") {
                    stopLoop = true;
                }

                if (stopLoop) {
                    break;
                }
            }


            new QRCode(document.getElementById(`qr_valid_1_E11`), {
                text: value[0]?.valid_other ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_val_1_E11`), {
                text: value[0]?.value_info ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_valid_2_E11`), {
                text: value[0]?.valid_other ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_val_2_E11`), {
                text: value[0]?.value_info ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });



        } else if (result.data[0].parameter_id === "RM_9_E12") {
            let avalue = <?= json_encode($AValue) ?>;
            let visit = <?= json_encode($visit) ?>;

            let aValueTabels = avalue.filter(item => item.value_score === 8);
            let valValue = avalue.filter(item => item.value_score === 9);

            let value = result.data.filter(item => item.value_score === 3 || item.value_score === 7 || item
                .value_score === 1 || item.value_score === 4)

            $(".visit_name_E12").html(visit?.visit.diantar_oleh)
            $(".visit_gender_E12").html(visit?.visit.gendername)
            $(".visit_age_E12").html(visit?.visit.age)


            $(".date_E12").html(moment(new Date()).format("DD-MMM-YYYY HH:mm"))
            $(".valid_E12").html(value[0]?.valid_other ?? "-")
            $(".val_E12").html(value[0]?.value_info ?? "-")



            //tabels content
            let datatabels = [];
            let stopLoop = false;
            for (let i = 0; i < value.length; i++) {
                const item = value[i];
                let number = i + 1;


                $(`.content_val_${number}_E12`).html(item.value_info);

                if (item.value_score === 3 || item.value_score === 7) {
                    let element = `.content_val_${number}_E12`;
                    getDataIdTables({
                        id: item.value_info,
                        score: item.value_score,
                        vId: item.value_id,
                        element: element
                    });
                }

                if (item.value_id === "G017E0305") {
                    stopLoop = true;
                }

                if (stopLoop) {
                    break;
                }
            }


            new QRCode(document.getElementById(`qr_valid_1_E12`), {
                text: value[0]?.valid_other ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_val_1_E12`), {
                text: value[0]?.value_info ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_valid_2_E12`), {
                text: value[0]?.valid_other ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            new QRCode(document.getElementById(`qr_val_2_E12`), {
                text: value[0]?.value_info ?? "-",
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });



        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F01") {
            renderDynamicContent({
                result: result,
                visit: visit,
                code: 'F01'
            });



        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F03") {
            renderDynamicContent({
                result: result,
                visit: visit,
                code: 'F03'
            });
        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F04") {
            renderDynamicContent({
                result: result,
                visit: visit,
                code: 'F04'
            });

        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F05") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F05'
            });

        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F06") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F06'
            });

        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F07") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F07'
            });

        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F08") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F08'
            });

        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F09") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F09'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F10") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F10'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F11") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F11'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F12") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F12'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F13") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F13'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F14") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F14'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F15") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F15'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F16") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F16'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F17") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F17'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F18") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F18'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F19") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F19'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F20") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F20'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F21") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F21'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F22") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F22'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F23") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F23'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F24") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F24'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F25") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F25'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F25A") {
            let data2 = <?= json_encode($AValue) ?>;
            let hasil = "";
            let aValue = data2.filter(item => item?.p_type === "GEN0017" && item?.parameter_id === 'RM_9_F25A');
            let dataContent = '';

            let concatenatedResult = result.data.slice(6, 9)
                .filter(item => item)
                .reduce((accumulator, currentItem) => {
                    return accumulator + currentItem.value_desc + currentItem.value_info;
                }, '');

            $("#bagian-F25A").html(aValue[0].value_info.substring(aValue[0].value_info.indexOf("THT")));
            $("#petunjuk-F25A").html(aValue[0].value_info);

            aValue.slice(1, 6).forEach((element, index) => {

                dataContent +=
                    `<tr class="px-3">
                            <td style="width: 40px; vertical-align: text-top;">${index+1}. </td>
                            <td>
                                <p class="mb-0">${element.value_desc}</p>
                                <p>${element.value_info}</p>
                            </td>
                        </tr>`;
            });
            dataContent +=
                `<tr class="px-3">
                        <td style="width: 40px; vertical-align: text-top;">6. </td>
                        <td>
                            <p>${concatenatedResult}</p>
                        </td>
                    </tr>`;
            aValue.slice(9, 10).forEach((element, index) => {

                dataContent +=
                    `<tr class="px-3">
                            <td style="width: 40px; vertical-align: text-top;">${index+7}. </td>
                            <td>
                                <p class="mb-0">${element.value_desc}</p>
                                <p class="mb-0">${element.value_info}</p>
                            </td>
                        </tr>`;
            });

            $("#data-table-F25A").html(dataContent);

        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F26") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F26'
            });

        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F27") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F27'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F28") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F28'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F29") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F29'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F30") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F30'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F31") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F31'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F32") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F32'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F33") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F33'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F34") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F34'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F35") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F35'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F36") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F36'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F37") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F37'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F38") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F38'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F39") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F39'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F40") {
            renderDynamicContent({
                result: result,
                visit: visit,
                code: 'F40'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F41") {
            renderDynamicContent({
                result: result,
                visit: visit,
                code: 'F41'
            });

        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F42") {
            renderDynamicContent({
                result: result,
                visit: visit,
                code: 'F42'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F43") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F43'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F44") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F44'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F45") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F45'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F46") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F46'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F47") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F47'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F48") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F48'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F49") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F49'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F50") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F50'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F51") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F51'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F52") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F52'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F53") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F53'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F54") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F54'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F55") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F55'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F56") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F56'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F57") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F57'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F58") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F58'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F59") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F59'
            });
        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F60") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F60'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F61") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F61'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F62") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F62'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F69") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F69'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F70") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F70'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F71") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F71'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F72") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F72'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F73") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F73'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F74") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F74'
            });


        } else if (result.data[0].parameter_id.replaceAll(' ', '') === "RM_9_F75") {
            renderDynamicContent2({
                result: result,
                visit: visit,
                code: 'F75'
            });


        }
        // actionCetak()
    }

    const renderDynamicContent = (props) => {

        let result = props.result;
        let resultDataLine = '';
        let hasil = '';
        let dataInformasi = '';
        let dataTable = '';
        let dataTable2 = '';
        result.data.forEach((item, index) => {
            let hasival_info = item.value_info;
            if (item.value_desc !== "") {
                resultDataLine +=
                    `<tr><td>${index + 1}. <b>${item.value_desc}</b>. ${hasival_info.replace(/<p>|<\/p>/g, '')}</td></tr>`;
            }
        });
        let data2 = <?= json_encode($AValue) ?>;
        let aValue = data2.filter(item => item.value_desc === "");
        aValue.forEach(item => {
            hasil += `<p id="${item?.value_id}">${item?.value_info}</p> `;
        });
        if (props.code === 'F01') {
            result.data.slice(0, 6).forEach((element, index) => {
                if (index < 2) {
                    if (index === 0) {
                        dataInformasi +=
                            `<tr>
                                <th colspan="3" class="text-center">${aValue[index].value_info}</th>
                            </tr>`;
                    } else {
                        dataInformasi +=
                            `<tr>
                                <th colspan="3" class="text-center">${element.value_desc}</th>
                            </tr>`;
                    }

                } else {
                    if (index === 2) {
                        let dokter = <?= json_encode($visit['visit']['fullname']); ?>;
                        dataInformasi +=
                            `<tr>
                                <td style="width: 250px;">Dokter Pelaksana Tindakan</td>
                                <td width="1%">:</td>
                                <td>${dokter}</td>
                            </tr>`;
                    } else {
                        dataInformasi +=
                            `<tr>
                                    <td style="width: 250px;">${element.value_desc}</td>
                                    <td width="1%">:</td>
                                    <td>${element.value_info}</td>
                                </tr>`;
                    }

                }
            });
            result.data.slice(6, 17).forEach((element, index) => {
                dataTable +=
                    `<tr>
                                    <td valign="top" width="37">
                                        <p class="mb-1" align="center">${index + 1}</p>
                                    </td>
                                    <td colspan="2" valign="top" width="228">
                                        <p class="mb-1">${element.value_desc}</p>
                                    </td>
                                    <td valign="top" width="300">
                                        <p class="mb-1">${element.value_info}</p>
                                    </td>
                                    <td valign="top" width="162">
                                        <p class="mb-1" align="center" id="qrcode-${element.value_id}-${props.code}"></p>
                                    </td>
                                </tr>`;
            });
            let avalueIndex = 1;
            result.data.slice(17, 20).forEach((element, index) => {
                if (index == 2) {
                    dataTable2 +=
                        `<tr>
                            <td colspan="5" valign="top" width="565">
                                <p class="">${element.value_info == "" ? aValue[avalueIndex].value_info : element.value_info}</p>
                            </td>
                        </tr>`;
                } else {
                    dataTable2 +=
                        `<tr>
                            <td colspan="4" valign="top" width="565">
                                <p class="">${element.value_info == "" ? aValue[avalueIndex].value_info : element.value_info}</p>
                            </td>
                            <td valign="top" width="162">
                                <p class="" align="center">Tanda tangan</p>
                                <p class="mb-1" align="center" id="qrcode-${element.value_id}-${props.code}"></p>
                            </td>
                        </tr>`;
                }

                avalueIndex++;
            });

            $("#data-" + props.code).html(resultDataLine);
            $("#hasil-Avalue-desc").html(hasil);
            $("#data-informasi-" + props.code).html(dataInformasi);
            $("#data-table-" + props.code).html(dataTable);
            $("#data-table2-" + props.code).html(dataTable2);

            result?.data?.slice(6, 17).forEach(e => {
                let element = document.getElementById(`qrcode-${e.value_id}-${props.code}`);
                if (element) {
                    new QRCode(element, {
                        text: result?.data[4].value_info.replace(/<p>|<\/p>/g, ''),
                        width: 50,
                        height: 50,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
            });
            result?.data?.slice(17, 19).forEach(e => {
                let element = document.getElementById(`qrcode-${e.value_id}-${props.code}`);
                if (element) {
                    new QRCode(element, {
                        text: result?.data[3].value_info.replace(/<p>|<\/p>/g, ''),
                        width: 50,
                        height: 50,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
            });
        } else {
            result.data.slice(0, 4).forEach((element, index) => {
                if (index < 1) {
                    dataInformasi +=
                        `<tr>
                                <th colspan="3" class="text-center">${aValue[index].value_info}</th>
                            </tr>`;

                } else {
                    if (index === 1) {
                        let dokter = <?= json_encode($visit['visit']['fullname']); ?>;
                        dataInformasi +=
                            `<tr>
                                <td style="width: 250px;">Dokter Pelaksana Tindakan</td>
                                <td width="1%">:</td>
                                <td>${dokter}</td>
                            </tr>`;
                    } else {
                        dataInformasi +=
                            `<tr>
                                <td style="width: 250px;">${element.value_desc}</td>
                                <td width="1%">:</td>
                                <td>${element.value_info}</td>
                            </tr>`;
                    }

                }

            });
            dataInformasi += ``;
            result.data.slice(4, 15).forEach((element, index) => {
                dataTable +=
                    `<tr>
                            <td valign="top" width="37">
                                <p class="mb-1" align="center">${index + 1}</p>
                            </td>
                            <td colspan="2" valign="top" width="228">
                                <p class="mb-1">${element.value_desc}</p>
                            </td>
                            <td valign="top" width="300">
                                <p class="mb-1">${element.value_info}</p>
                            </td>
                            <td valign="top" width="162">
                                <p class="mb-1" align="center" id="qrcode-${element.value_id}-${props.code}"></p>
                            </td>
                        </tr>`;
            });
            dataTable += ``;
            let avalueIndex = 1;
            result.data.slice(15, 18).forEach((element, index) => {
                if (index == 2) {
                    dataTable2 +=
                        `<tr>
                                <td colspan="5" valign="top" width="565">
                                    <p class="">${element.value_info == "" ? aValue[avalueIndex].value_info : element.value_info}</p>
                                </td>
                            </tr>`;
                } else {
                    dataTable2 +=
                        `<tr>
                            <td colspan="4" valign="top" width="565">
                                <p class="">${element.value_info == "" ? aValue[avalueIndex].value_info : element.value_info}</p>
                            </td>
                            <td valign="top" width="162">
                                <p class="" align="center">Tanda tangan</p>
                                <p class="mb-1" align="center" id="qrcode-${element.value_id}-${props.code}"></p>
                            </td>
                        </tr>`;
                }

                avalueIndex++
            });

            $("#data-" + props.code).html(resultDataLine);
            $("#hasil-Avalue-desc").html(hasil);
            $("#data-informasi-" + props.code).html(dataInformasi);
            $("#data-table-" + props.code).html(dataTable);
            $("#data-table2-" + props.code).html(dataTable2);

            result?.data?.slice(4, 15).forEach(e => {
                let element = document.getElementById(`qrcode-${e.value_id}-${props.code}`);
                if (element) {
                    new QRCode(element, {
                        text: result?.data[3].value_info.replace(/<p>|<\/p>/g, ''),
                        width: 50,
                        height: 50,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
            });
            result?.data?.slice(15, 17).forEach(e => {
                let element = document.getElementById(`qrcode-${e.value_id}-${props.code}`);
                if (element) {
                    new QRCode(element, {
                        text: result?.data[2].value_info.replace(/<p>|<\/p>/g, ''),
                        width: 50,
                        height: 50,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
            });
        }




        $("#text-petugas-" + props.code).html("(" + (result.data[0]?.valid_user !== null && result.data[0]
            ?.valid_user !== undefined ? result.data[0]?.valid_user : "") + ")");
        $("#text-pasien-" + props.code).html("(" + (result.data[0]?.valid_pasien !== null && result.data[0]
            ?.valid_pasien !== undefined ? result.data[0]?.valid_pasien : "") + ")");
        $("#code-" + props.code).html(result.data[0].parameter_id.replaceAll(' ', '').replace(/_/g, ' '));


        $(".name_of_pasien-" + props.code).html(props.visit.name_of_pasien);
        $(".date_of_birth-" + props.code).html(moment(props.visit.date_of_birth).format("DD-MM-YYYY"));
        $(".name_of_gender-" + props.code).html(props.visit.name_of_gender);
        //     $(".contact_address-" + tableId).html(visit.contact_address);
        //     $(".no_registration-" + tableId).html(visit.no_registration);
        //     $(".noTlp-" + tableId).html(!visit.phone_number ? "-" : visit.phone_number);
    }

    const renderDynamicContent2 = (props) => {

        let result = props.result;
        let resultDataLine = '';
        let hasil = '';
        let dataInformasi = '';
        let dataTable = '';
        let dataTable2 = '';

        getDataIdTables({
            id: result?.data[24]?.value_info,
            score: result?.data[24]?.value_score,
            vId: result?.data[24]?.value_id,
            element: ".kelamin-setuju" + props.code
        })
        getDataIdTables({
            id: result?.data[26]?.value_info,
            score: result?.data[26]?.value_score,
            vId: result?.data[26]?.value_id,
            element: "#selaku-" + props.code
        })

        getDataIdTables({
            id: result?.data[37]?.value_info,
            score: result?.data[37]?.value_score,
            vId: result?.data[37]?.value_id,
            element: ".kelamin-menolak" + props.code
        })
        getDataIdTables({
            id: result?.data[39]?.value_info,
            score: result?.data[39]?.value_score,
            vId: result?.data[39]?.value_id,
            element: "#selaku-2-" + props.code
        })


        let data2 = <?= json_encode($AValue) ?>;
        let aValue = data2.filter(item => item.value_desc === "");
        aValue.forEach(item => {
            hasil += `<p id="${item?.value_id}">${item?.value_info}</p> `;
        });

        result.data.slice(0, 5).forEach((element, index) => {
            if (index < 1) {
                let hasival_info = element.value_info;
                let dateTimeRegex = /\d{4}-\d{2}-\d{2}T\d{2}:\d{2}/;

                if (dateTimeRegex.test(hasival_info)) {
                    let dateTimeMatch = hasival_info.match(dateTimeRegex);
                    if (dateTimeMatch) {
                        let dateTime = moment(dateTimeMatch[0]).format('DD MM YYYY HH:mm');
                        hasival_info = hasival_info.replace(dateTimeMatch[0], dateTime);
                    }
                }

                dataInformasi +=
                    `<tr>
                    <th colspan="3" class="text-center">${hasival_info}</th>
                </tr>`;
            } else {
                if (index === 1) {
                    let dokter = <?= json_encode($visit["visit"]["fullname"]) ?>;
                    dataInformasi +=
                        `<tr>
                        <td style="width: 250px;">Dokter Pelaksana Tindakan</td>
                        <td width="1%">:</td>
                        <td>${dokter}</td>
                    </tr>`;
                } else {
                    let hasival_info = element.value_info;
                    let dateTimeRegex = /\d{4}-\d{2}-\d{2}T\d{2}:\d{2}/;

                    if (dateTimeRegex.test(hasival_info)) {
                        let dateTimeMatch = hasival_info.match(dateTimeRegex);
                        if (dateTimeMatch) {
                            let dateTime = moment(dateTimeMatch[0]).format('DD MMM YYYY HH:mm');
                            hasival_info = hasival_info.replace(dateTimeMatch[0], dateTime);
                        }
                    }

                    dataInformasi +=
                        `<tr>
                        <td style="width: 250px;">${element.value_desc}</td>
                        <td width="1%">:</td>
                        <td>${hasival_info}</td>
                    </tr>`;
                }
            }
        });
        result.data.slice(5, 16).forEach((element, index) => {
            dataTable +=
                `<tr>
                    <td valign="top" width="37">
                        <p class="mb-1" align="center">${index + 1}</p>
                    </td>
                    <td colspan="2" valign="top" width="228">
                        <p class="mb-1">${element.value_desc}</p>
                    </td>
                    <td valign="top" width="300">
                        <p class="mb-1">${element.value_info}</p>
                    </td>
                    <td valign="top" width="162">
                        <p class="mb-1" align="center" id="qrcode-${element.value_id}-${props.code}"></p>
                    </td>
                </tr>`;
        });
        let avalueIndex = 1;
        result.data.slice(17, 20).forEach((element, index) => {
            if (index != 2) {
                dataTable2 +=
                    `<tr>
                            <td colspan="4" valign="top" width="565">
                                <p class="">${element.value_info == "" ? aValue[avalueIndex].value_info : element.value_info}</p>
                            </td>
                            <td valign="top" width="162">
                                <p class="" align="center">Tanda tangan</p>
                                <p class="mb-1" align="center" id="qrcode-${element.value_id}-${props.code}"></p>
                            </td>
                        </tr>`;
            } else {
                dataTable2 +=
                    `<tr>
                            <td colspan="5" valign="top">
                                <p class="">${element.value_info == "" ? aValue[avalueIndex].value_info : element.value_info}</p>
                            </td>
                        </tr>`;
            }

            avalueIndex++;
        });



        $("#data-" + props.code).html(resultDataLine);
        $("#hasil-Avalue-desc").html(hasil);
        $("#data-informasi-" + props.code).html(dataInformasi);
        $("#data-table-" + props.code).html(dataTable);
        $("#data-table2-" + props.code).html(dataTable2);

        result?.data?.slice(5, 16).forEach(e => {
            let element = document.getElementById(`qrcode-${e.value_id}-${props.code}`);
            if (element) {
                new QRCode(element, {
                    text: result?.data[3].value_info.replace(/<p>|<\/p>/g, ''),
                    width: 50,
                    height: 50,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }
        });
        result?.data?.slice(17, 19).forEach(e => {
            let element = document.getElementById(`qrcode-${e.value_id}-${props.code}`);
            if (element) {
                new QRCode(element, {
                    text: result?.data[2].value_info.replace(/<p>|<\/p>/g, ''),
                    width: 50,
                    height: 50,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }
        });





        $("#nama-tindakan-setuju-" + props.code).html((result.data[21].value_info));
        $("#umur-tindakan-setuju-" + props.code).html((result.data[22].value_info));
        $("#alamat-tindakan-setuju-" + props.code).html((result.data[23].value_info));
        $("#pihak-menyatakan-" + props.code).html((result.data[21].value_info));


        let element = document.getElementById(`qrcode-tandatangan-pihak-menyatakan-${ props.code}`);
        let element1 = document.getElementById(`qrcode-tandatangan-pihak-keluarga-${ props.code}`);
        let element2 = document.getElementById(`qrcode-tandatangan-pihak-medis-${ props.code}`);

        if (element) {
            generateQRCode(`qrcode-tandatangan-pihak-menyatakan-${ props.code}`, result?.data[21].value_info);
        }
        if (element1) {

            generateQRCode(`qrcode-tandatangan-pihak-keluarga-${ props.code}`, result?.data[21].value_info);
        }
        if (element2) {
            generateQRCode(`qrcode-tandatangan-pihak-medis-${ props.code}`, result?.data[21].value_info);
        }

        $("#nama-tindakan-setuju-2-" + props.code).html((props.visit['name_of_pasien']));
        $("#umur-tindakan-setuju-2-" + props.code).html((props.visit['age']));
        $("#alamat-tindakan-setuju-2-" + props.code).html((props.visit['contact_address']));
        $("#kelamin-tindakan-setuju-2-" + props.code).html((props.visit['gender']) == 2 ? 'Perempuan' : 'Laki-Laki');

        $("#text-petugas-" + props.code).html("(" + (result.data[0]?.valid_user !== null && result.data[0]
            ?.valid_user !== undefined ? result.data[0]?.valid_user : "") + ")");
        $("#text-pasien-" + props.code).html("(" + (result.data[0]?.valid_pasien !== null && result.data[0]
            ?.valid_pasien !== undefined ? result.data[0]?.valid_pasien : "") + ")");
        $("#code-" + props.code).html(result.data[0].parameter_id.replaceAll(' ', '').replace(/_/g, ' '));


        $(".name_of_pasien-" + props.code).html(props.visit.name_of_pasien);
        $(".date_of_birth-" + props.code).html(moment(props.visit.date_of_birth).format("DD-MM-YYYY"));
        $(".name_of_gender-" + props.code).html(props.visit.name_of_gender);
        //     $(".contact_address-" + tableId).html(visit.contact_address);
        //     $(".no_registration-" + tableId).html(visit.no_registration);
        //     $(".noTlp-" + tableId).html(!visit.phone_number ? "-" : visit.phone_number);


    }

    //new
    const getDataIdTables = (props) => {
        let data2 = <?= json_encode($AValue) ?>;
        let aValueTabels = data2.filter(item => item.value_score === 3 || item.value_score === 7);

        let matchedItem = aValueTabels.find(item => item.value_id === props.vId);

        if (matchedItem) {
            postData({
                nameTables: matchedItem.value_info,
                score: matchedItem.value_score,
                vId: matchedItem.value_id
            }, 'admin/InformedConsent/getTablesAll', (res) => {
                renderData(res, matchedItem, props);
            });
        } else {

            $(props.element).html("-");
        }

        const renderData = (data, item, props) => {
            if (data && data.length > 0) {
                let matchedItem = data.find(resItem => resItem.score === item.value_score && resItem.id == props
                    .id && resItem.vId == props.vId);

                if (matchedItem && matchedItem.val !== undefined) {
                    $(props.element).html(matchedItem.val);
                } else {
                    $(props.element).html("-");
                }
            } else {
                $(props.element).html("-");
            }
        };
    };
    const generateQRCode = (elementId, text) => {
        let element = document.getElementById(elementId);
        if (element) {
            new QRCode(element, {
                text: text.replace(/<p>|<\/p>/g, ''),
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    };
    //new
    const actionCetak = () => {
        setTimeout(() => {
            window.print();
        }, 2000);
    };
</script>





</html>