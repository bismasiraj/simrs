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

<body>
    <!-- Halaman 1 -->
    <div class="page">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-auto text-center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col text-center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p><?= @$kop['contact_address'] ?></p>
                </div>
                <div class="col-auto text-center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><?= $title; ?></h4>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Nomor RM</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Nama Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_pasien']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Jenis Kelamin</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_gender']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Tanggal Lahir (Usia)</b>
                            <?php if (!empty($visit['date_of_birth'])) : ?>
                                <p class="m-0 mt-1 p-0"><?= date('d/m/Y', strtotime($visit['date_of_birth'])) . ' (' . @$visit['age'] . ')'; ?></p>
                            <?php else : ?>
                                <p class="m-0 mt-1 p-0">-</p>
                            <?php endif; ?>
                        </td>
                        <td class="p-1" colspan="2">
                            <b>Alamat Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['contact_address']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['sspractitioner_name']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['visit_datetime'] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Kelas</b>
                        </td>
                        <td class="p-1" colspan="2">
                            <b><?= @$visit['name_of_class']; ?></b>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table">
                <tbody>
                    <tr>
                        <td><b>Nama Tindakan</b><br>Seksio Sesarea</td>
                        <td><b>Pelaksana Tindakan</b><br><?= @$visit['sspractitioner_name']; ?></td>
                        <td><b>Diberikan Pada Tanggal/Jam</b><br><?= $dt->format('d-m-y H:i:s'); ?></td>
                    </tr>
                    <tr>
                        <td><b>Permberi Informasi</b><br><?= @$visit['sspractitioner_name']; ?></td>
                        <td><b>Penerima Informasi</b><br><?= @$visit['name_of_pasien']; ?></td>
                        <td><b>Pemberi Persetujuan</b><br><?= @$visit['name_of_pasien']; ?></td>
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
                <tbody id="data-js">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- halaman 2 -->
    <div class="page">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-auto text-center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col text-center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p><?= @$kop['contact_address'] ?></p>
                </div>
                <div class="col-auto text-center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><?= $title2; ?></h4>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Nomor RM</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Nama Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_pasien']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Jenis Kelamin</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_gender']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Tanggal Lahir (Usia)</b>
                            <?php if (!empty($visit['date_of_birth'])) : ?>
                                <p class="m-0 mt-1 p-0"><?= date('d/m/Y', strtotime($visit['date_of_birth'])) . ' (' . @$visit['age'] . ')'; ?></p>
                            <?php else : ?>
                                <p class="m-0 mt-1 p-0">-</p>
                            <?php endif; ?>
                        </td>
                        <td class="p-1" colspan="2">
                            <b>Alamat Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['contact_address']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['sspractitioner_name']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['visit_datetime'] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Kelas</b>
                        </td>
                        <td class="p-1" colspan="2">
                            <b><?= @$visit['name_of_class']; ?></b>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h3 class="text-center">SURAT PERSETUJUAN SEKSIO SESAREA</h3>
            <br>
            <div>
                <p>Yang bertandatangan di bawah ini :</p>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>: <?= @$visit['name_of_pasien']; ?></td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>: <?= @$visit['age']; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: <?= @$visit['name_of_gender']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= @$visit['contact_address']; ?></td>
                    </tr>
                    <tr>
                        <td>Selaku</td>
                        <td>: DIRI SENDIRI / PASIEN</td>
                    </tr>
                </table>
            </div>
            <div class="pt-3">
                <p>Menyatakan persetujuan untuk Seksio Sesarea terhadap</p>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>: <?= @$visit['name_of_pasien']; ?></td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>: <?= @$visit['age']; ?></td>
                    </tr>
                </table>
            </div>

            <div class="row pt-3">
                <div class="col-4" align="center">
                    <div> , <?= date('d-m-Y'); ?></div>
                    <br>
                    <div>Yang Menyatakan</div>
                    <div class="mb-1">
                        <div class="pt-2" id="qrcode-valid_pasien"></div>
                    </div>
                    <p class="p-0 m-0 py-1" id="text-valid_pasien">(valid_pasien)</p>
                    <i>dicetak pada tanggal <?= date('d-m-Y H:i'); ?></i>
                </div>
                <div class="col-4" align="center">
                    <br><br>
                    <div>Saksi Keluarga/ Kerabat</div>
                    <div class="mb-1">
                        <div class="pt-2" id="qrcode-valid_other"></div>
                    </div>
                    <p class="p-0 m-0 py-1" id="text-valid_other">(valid_other)</p>
                </div>
                <div class="col-4" align="center">
                    <br><br>
                    <div>Penerima Penjelasan</div>
                    <div class="mb-1">
                        <div class="pt-2" id="qrcode-valid_user"></div>
                    </div>
                    <p class="p-0 m-0 py-1" id="text-valid_user">(valid_user)</p>
                </div>
            </div>


        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<!-- data  -->
<script>
    let data = localStorage.getItem('print');
    data = JSON.parse(data);

    let result = []
    data.data.map((item, index) => {
        result += `<tr>
                        <td class="text-left p-2 fit">${index+1}</td> 
                        <td class="text-left p-2 fit">${item.value_desc}</td> 
                        <td class="text-left p-2 fit isi-informasi">${item.value_info}</td> 
                        <td class="text-left p-2 fit tanda"><div id="qrcode-${item.value_id}"></div></td> 
                    </tr>`
    })
    $("#data-js").html(result)



    data?.data?.forEach(e => {
        let qrcode = new QRCode(document.getElementById(`qrcode-${e.value_id}`), {
            text: e?.value_id,
            width: 50,
            height: 50,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H // Tingkat koreksi tinggi
        });
    });



    let valid_pasien = new QRCode(document.getElementById(`qrcode-valid_pasien`), {
        text: data.data[0]?.valid_pasien !== null & data.data[0]?.valid_pasien ? data.data[0]?.valid_pasien : "valid_pasien",
        width: 80,
        height: 80,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
    let valid_other = new QRCode(document.getElementById(`qrcode-valid_other`), {
        text: data.data[0]?.valid_other !== null & data.data[0]?.valid_other ? data.data[0]?.valid_other : "valid_other",
        width: 80,
        height: 80,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
    let valid_user = new QRCode(document.getElementById(`qrcode-valid_user`), {
        text: data.data[0]?.valid_user !== null & data.data[0]?.valid_user ? data.data[0]?.valid_user : "valid_user",
        width: 80,
        height: 80,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });

    $("#text-valid_user").html("(" + (data.data[0]?.valid_user !== null && data.data[0]?.valid_user !== undefined ? data.data[0]?.valid_user : "valid_user") + ")");
    $("#text-valid_other").html("(" + (data.data[0]?.valid_other !== null && data.data[0]?.valid_other !== undefined ? data.data[0]?.valid_other : "valid_other") + ")");
    $("#text-valid_pasien").html("(" + (data.data[0]?.valid_pasien !== null && data.data[0]?.valid_pasien !== undefined ? data.data[0]?.valid_pasien : "valid_user") + ")");
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
    window.onload = function() {
        window.print();
    };
</script>

</html>