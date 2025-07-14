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
        <div class="row">
            <h5 class="text-start">Data Umum</h5>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 50%;">Data Istri</th>
                    <th style="width: 50%;">Data Suami</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Nama Lengkap</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['diantar_oleh']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Nama Lengkap</b>
                        <p class="m-0 mt-1 p-0"><?= @$suami['fullname']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Tanggal Lahir</b>
                        <p class="m-0 mt-1 p-0"><?= substr(@$visit['date_of_birth'], 0, 10); ?></p>
                    </td>
                    <td class="p-1">
                        <b>Tanggal Lahir</b>
                        <p class="m-0 mt-1 p-0"><?= substr(@$suami['date_of_birth'], 0, 10); ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Agama</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['nama_agama']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Agama</b>
                        <p class="m-0 mt-1 p-0"><?= @$suami['nama_agama']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Pendidikan</b>
                        <p class="m-0 mt-1 p-0"><?= @$istri['name_of_edu_type']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Pendidikan</b>
                        <p class="m-0 mt-1 p-0"><?= @$suami['name_of_edu_type']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Pekerjaan</b>
                        <p class="m-0 mt-1 p-0"><?= @$istri['name_of_job']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Pekerjaan</b>
                        <p class="m-0 mt-1 p-0"><?= @$suami['name_of_job']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Alamat</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['visitor_address']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Alamat</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['address']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Kawin</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['name_of_maritalstatus']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Lama Menikah</b>
                        <p class="m-0 mt-1 p-0"></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Subyektif</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" colspan="3">
                        <b>Subyektif</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['anamnesis']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Riwayat Kebidanan dan Kandungan</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" colspan="3">
                        <b>Riwayat Haid</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['haid']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" style="width:30%;">
                        <b>Menarche</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['menarche']; ?></p>
                    </td>
                    <td class="p-1" style="width:30%;">
                        <b>Siklus</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['siklus']; ?></p>
                    </td>
                    <td class="p-1" style="width:30%;">
                        <b>Lama</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['lama']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Jumlah</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['jumlah']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>HPHT</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['hpht']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>HPL</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['hpl']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="3">
                        <b>Keluhan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['keluhan']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Riwayat Kehamilan</h5>
        </div>
        <table border="1" width="100%" cellspacing="0" cellpadding="5">
            <thead class="table-primary">
                <tr>
                    <th scope="row" class="w-auto text-nowrap">Tgl/Tahun Partus</th>
                    <th scope="row" class="w-auto text-nowrap">Tempat Partus</th>
                    <th scope="row" class="w-auto text-nowrap">Umur Hamil</th>
                    <th scope="row" class="w-auto text-nowrap">Jenis Persalinan</th>
                    <th scope="row" class="w-auto text-nowrap">Penolong Persalinan</th>
                    <th scope="row" class="w-auto text-nowrap">Penyulit</th>
                    <th scope="row" class="w-auto text-nowrap">Anak JK/ BB</th>
                    <th scope="row" class="w-auto text-nowrap">Keadaan Sekarang</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pregnancy as $key => $value) {
                ?>
                    <tr>
                        <td><?= substr($value['partus_date'], 0, 10); ?></td>
                        <td><?= $value['partus_location']; ?></td>
                        <td><?= $value['gestation']; ?></td>
                        <td><?= $value['partus_type']; ?></td>
                        <td><?= $value['partus_helper']; ?></td>
                        <td><?= $value['partus_abnormal']; ?></td>
                        <td><?php if ($value['baby_sex'] == '1') {
                            ?>Laki-laki<?php
                                    } else if ($value['baby_sex'] == '2') {
                                        ?>Perempuan<?php
                                                } else if ($vakye['baby_sex'] == '3') {
                                                    ?>Ambigu<?php
                                                        } else {
                                                            ?>-<?php
                                                            } ?></td>
                        <td><?= $value['baby_condition']; ?></td>
                    </tr>
                <?php
                } ?>
                <!-- <tr>
                    <td class="p-1" width="50%">
                        <b>Alkohol</b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['riwayat_alkohol']) ? @$val['riwayat_alkohol'] : '<i>-- data tidak tersedia --</i>'; ?></p>
                    </td>
                    <td class="p-1" width="50%">
                        <b>Merokok</b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['riwayat_merokok']) ? @$val['riwayat_merokok'] : '<i>-- data tidak tersedia --</i>'; ?></p>
                    </td>
                </tr> -->
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Catatan Pemeriksaan Obsetric</h5>
        </div>
        <table border="1" width="100%" cellspacing="0" cellpadding="5">
            <thead class="table-primary">
                <tr>
                    <th scope="row" class="w-auto text-nowrap">Tgl</th>
                    <th scope="row" class="w-auto text-nowrap">TFU</th>
                    <th scope="row" class="w-auto text-nowrap">Letak</th>
                    <th scope="row" class="w-auto text-nowrap">Jantung</th>
                    <th scope="row" class="w-auto text-nowrap">Oedema</th>
                    <th scope="row" class="w-auto text-nowrap">Urine</th>
                    <th scope="row" class="w-auto text-nowrap">Tense</th>
                    <th scope="row" class="w-auto text-nowrap">BB</th>
                    <th scope="row" class="w-auto text-nowrap">Minggu Kehamilan</th>
                    <th scope="row" class="w-auto text-nowrap">Hasil Pemeriksaan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $key => $value) {
                ?>
                    <tr>
                        <td><?= substr($value['examination_date'], 0, 10); ?></td>
                        <td><?= $value['tfu']; ?></td>
                        <td><?= $value['child_position']; ?></td>
                        <td><?= $value['heart_sound']; ?></td>
                        <td><?= $value['oedema']; ?></td>
                        <td><?= $value['urine']; ?></td>
                        <td><?= $value['tension_upper']; ?>/<?= $value['tension_below']; ?></td>
                        <td><?= $value['weight']; ?></td>
                    </tr>
                <?php
                } ?>
                <!-- <tr>
                    <td class="p-1" width="50%">
                        <b>Alkohol</b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['riwayat_alkohol']) ? @$val['riwayat_alkohol'] : '<i>-- data tidak tersedia --</i>'; ?></p>
                    </td>
                    <td class="p-1" width="50%">
                        <b>Merokok</b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['riwayat_merokok']) ? @$val['riwayat_merokok'] : '<i>-- data tidak tersedia --</i>'; ?></p>
                    </td>
                </tr> -->
            </tbody>
        </table>
        <!-- <div class="row">
            <h4 class="text-start">Planning (P)</h4>
        </div> -->
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Target / Sasaran Terapi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['sasaran']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Pemeriksaan Diagnostik Penunjang</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Laboratorium</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['laboratorium']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Radiologi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['radiologi']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Diagnosis Kebidanan</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Diagnosis</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['asesmen']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Farmakoterapi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['farmakologia']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Procedure</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['prosedur']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Catatan Planning</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b></b>
                        <p class="m-0 mt-1 p-0"><?= @$val['instruction']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Rencana Tindak Lanjut</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Rencana Tindak Lanjut</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['rencana_tl']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Kontrol</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['kontrol']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>



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
</script>
<script>
    $.each(sign, function(key, value) {
        if (value.user_type == 1 && value.isvalid == 1) {
            $("#qrcode_name").html(`(${value.fullname})`)
            $("#qrcode").html('<img class="mt-3" src="data:image/png;base64,' + value.sign_file +
                '" width="400px">')

        } else if (value.user_type == 2 && value.isvalid == 1) {
            $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)
            const base64ttd_cetak_resumePulang_pasien1 = `data:image/gif;base64,${value.sign_file}`

            if (base64ttd_cetak_resumePulang_pasien1) {

                cropTransparentPNG(base64ttd_cetak_resumePulang_pasien1, (croppedImage) => {
                    if (croppedImage) {
                        $('#qrcode1').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                    } else {
                        $('#qrcode1').html('');
                    }
                });
            } else {
                $('#qrcode1').html('');
            }

            // $("#qrcode1").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file +
            //     '" width="400px">')

        } else if (value.user_type == 3 && value.isvalid == 1) {

            $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)

            const base64ttd_cetak_resumePulang_pasien2 = `data:image/gif;base64,${value.sign_file}`

            if (base64ttd_cetak_resumePulang_pasien2) {
                cropTransparentPNG(base64ttd_cetak_resumePulang_pasien2, (croppedImage) => {
                    if (croppedImage) {
                        $('#qrcode1').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                    } else {
                        $('#qrcode1').html('');
                    }
                });
            } else {
                $('#qrcode1').html('');
            }

            // $("#qrcode1").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file +
            //     '" width="400px">')

        }
    })
    const cropTransparentPNG = (base64, callback) => {
        const img = new Image();
        img.crossOrigin = 'Anonymous';
        img.onload = () => {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);

            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const data = imageData.data;

            let top = null,
                bottom = null,
                left = null,
                right = null;

            for (let y = 0; y < canvas.height; y++) {
                for (let x = 0; x < canvas.width; x++) {
                    const index = (y * canvas.width + x) * 4;
                    const alpha = data[index + 3];
                    if (alpha > 0) {
                        if (top === null || y < top) top = y;
                        if (bottom === null || y > bottom) bottom = y;
                        if (left === null || x < left) left = x;
                        if (right === null || x > right) right = x;
                    }
                }
            }

            if (top === null) return callback(null); // tidak ada gambar

            const width = right - left + 1;
            const height = bottom - top + 1;

            const croppedCanvas = document.createElement('canvas');
            croppedCanvas.width = width;
            croppedCanvas.height = height;

            const croppedCtx = croppedCanvas.getContext('2d');
            croppedCtx.drawImage(canvas, left, top, width, height, 0, 0, width, height);

            const croppedBase64 = croppedCanvas.toDataURL('image/png');
            callback(croppedBase64);
        };
        img.src = base64;
    };
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
    // window.print();
</script>

</html>