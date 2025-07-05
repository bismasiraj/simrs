<?php
// echo "<pre>";
// var_dump($val);
// die();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="<?= base_url(); ?>assets/libs/qrcode/qrcode.js"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
    <script src="<?= base_url() ?>'/assets/js/default.js'"></script>
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
                            <?= date("d M Y", strtotime($visit['tgl_lahir'])) . ' (' . (!empty($visit['age']) ? $visit['age'] : 'N/A') . ')'; ?>
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
                        <p class="m-0 mt-1 p-0"><?= @$visit['fullname']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Department</b>
                        <p class="m-0 mt-1 p-0">
                            <?php 
                            if (!empty($visit['specialist_type_id'])) {
                                $db = db_connect();
                                $query = $db->table('specialist_type')
                                            ->select('SPECIALIST_TYPE')
                                            ->where('specialist_type_id', $visit['specialist_type_id'])
                                            ->get()
                                            ->getRow();

                                echo $query ? esc($query->SPECIALIST_TYPE) : '-';
                            }
                            ?>
                        </p>

                    </td>
                    <td class="p-1">
                        <b>Tanggal Masuk</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['visit_date'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Kelas</b>
                        <p class="m-0 mt-1 p-0">
                            <?php 
                                    if (!empty($visit['class_id'])) {
                                        $db = db_connect();
                                        $queryClass = $db->table('CLASS')
                                                    ->select('name_of_class')
                                                    ->where('class_id', $visit['class_id'])
                                                    ->get()
                                                    ->getRow();

                                        echo $queryClass ? esc($queryClass->name_of_class) : '-';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                        </p>


                    </td>
                    <td class="p-1" colspan="2">
                        <b>Bangsal/Kamar</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
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

        <?php if (isset($diagnosas)) :
            
            ?>
        <div class="d-flex flex-wrap mb-3">
            <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <ul><b>Diagnosa Pra Operasi</b>
                    <?php
                        $diagnosa_pra = array_filter($diagnosas, function ($item) {
                            return $item['diag_cat'] === 13;
                        });
                        foreach ($diagnosa_pra as $key => $diag_pra) :
                        ?>
                    <li class="m-0 mt-1 p-0"><?= $diag_pra['diagnosa_name']  ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <b>Waktu Mulai</b>
                <p class="m-0 mt-1 p-0"><?= date_format(date_create(@$val['start_operation']), 'd-m-Y H:i'); ?></p>
                <b>Waktu Selesai</b>
                <p class="m-0 mt-1 p-0"><?= date_format(date_create(@$val['end_operation']), 'd-m-Y H:i'); ?></p>
                <b>Ada Penundaan?</b>
                <?php
                    $statusTerlayani = [
                        0 => 'Terjadwal',
                        1 => 'Proses Oprasi',
                        2 => 'Selesai (Tidak tertunda)',
                        3 => 'Tertunda',
                        4 => 'Batal',
                    ];
                    ?>
                <p class="m-0 mt-1 p-0">
                    <?= $statusTerlayani[$val['terlayani'] ?? 0] ?? 'Status Tidak Diketahui'; ?>
                </p>

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
                    <li class="m-0 mt-1 p-0"><?= $diag_pasca['diagnosa_name'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <b>Sifat Operasi</b>
                <p class="m-0 mt-1 p-0">
                    <?php
                        $kategoriOprs = [
                            0 => 'Elektif',
                            1 => 'Cyto',
                            2 => 'Emergency'
                        ];
                        echo isset($kategoriOprs[$val['patient_category_id']]) ? $kategoriOprs[$val['patient_category_id']] : '-';
                        ?>
                </p>
            </div>
        </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <tr>
                <td width="33.3%">
                    <b>Prosedur Pembedahan</b>
                    <p class="m-0 mt-1 p-0"><?= @$val['tarif_id']; ?></p>
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
                    <p class="m-0 mt-1 p-0">
                        <?= empty($val['profilaksis']) ? '' : ($val['profilaksis'] == 'OP080901' ? 'Ya' : 'Tidak'); ?>
                    </p>

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
                    <!-- bisma -->
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
                <div id="qrcode-name"></div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Pasien</div>
                <div class="mb-1">
                    <div id="qrcode1"></div>
                </div>
                <div><?= $visit['diantar_oleh'] ?></div>
            </div>
        </div>
    </div>
    <br>
    <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

<script>
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
const base64_ttd_dok = <?= json_encode($val['ttd_dok'] ?? '') ?>;
if (base64_ttd_dok) {
    $('#qrcode').html(
        `<img src="${base64_ttd_dok}" alt="QR Code" style="width: 100%; max-width: 300px; height: auto;">`);
} else {
    $('#qrcode').html('');
}

$('#qrcode-name').html(`<?= $val['ttd_dokter_name']?>;`)


const base64_ttd_ps = <?= json_encode($val['ttd_pasien']?? '') ?>;
// if (base64_ttd_ps) {
//     $('#qrcode1').html(
//         `<img src="${base64_ttd_ps}" alt="QR Code" style="width: 100%; max-width: 300px; height: auto;">`);
// } else {
//     $('#qrcode1').html('');
// }
if (base64_ttd_ps) {
    cropTransparentPNG(base64_ttd_ps, (croppedImage) => {
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