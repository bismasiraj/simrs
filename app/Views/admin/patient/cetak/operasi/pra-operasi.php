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
                <!-- <h3>Surakarta</h3> -->
                <p><?= @$organization['contact_address'] ?></p>
                <p class="mb-0"><?= @$organization['contact_address'] ?>, <?= @$organization['phone']; ?>, Fax:
                    <?= @$organization['fax']; ?>, <?= @$organization['kota']; ?></p>
                <p><?= @$organization['sk']; ?></p>
            </div>
            <div class="col-auto text-center">
                <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
            </div>
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
                    <p class="m-0 mt-1 p-0"><?= tanggal_indo($visit['tgl_lahir']) . ' (' . @$visit['age'] . ')'; ?>
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
                <td class="p-1" colspan="2">
                    <b>Bangsal/Kamar</b>
                    <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                </td>

            </tr>
        </tbody>
    </table>
    <div class="d-flex flex-wrap mb-3">
        <div class="col-4 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Waktu Operasi</b>
            <p> <?= isset($val['examination_date']) 
                ? tanggal_indo(date_format(date_create($val['examination_date']), 'Y-m-d')) . ' ' . date_format(date_create($val['examination_date']), 'H:i') 
                : ''; ?></p>
        </div>
        <div class="col-4 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Riwayat Alergi</b>
            <?php if (isset($riwayat_alergi)) : ?>
            <ul>
                <?php foreach ($riwayat_alergi as $alergi) : ?>
                <li><?= $alergi['value_desc'] . ': ' . $alergi['histories'] ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <div class="col-4 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Hasil Pemeriksaan Penunjang</b>

        </div>
        <div class="col-4 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Informed Consent Bedah</b>
            <p></p>
        </div>
        <div class="col-4 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Informed Consent Anesthesi</b>
            <p></p>
        </div>
        <div class="col-4 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Penanda Lokasi Operasi</b>
            <p></p>
        </div>
        <div class="col-12 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Rencana Operasi</b>
            <p><?= @$operasi['treatment']; ?></p>
        </div>
        <div class="col-12 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Diagnosis</b>
            <?php if (isset($diagnosa)) : ?>
            <ul>
                <?php foreach ($diagnosa as $diag) : ?>
                <li><?= $diag['diagnosa_name']; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <div class="col-4 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Estimasi Waktu Operasi</b>
            <p>
                <?php 
                    if (isset($operasi['start_operation']) && isset($operasi['end_operation'])) {
                        $start = date_create($operasi['start_operation']);
                        $end = date_create($operasi['end_operation']);

                        $startFormatted = tanggal_indo(date_format($start, 'Y-m-d')) . ' ' . date_format($start, 'H:i');
                        $endFormatted = tanggal_indo(date_format($end, 'Y-m-d')) . ' ' . date_format($end, 'H:i');
                        
                        echo $startFormatted . ' - ' . $endFormatted;
                    }
                ?>
            </p>

        </div>
        <div class="col-4 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Alat Khusus</b>
        </div>
        <div class="col-4 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <b>Produk Darah</b>
            <?php if (isset($blood_request)) : ?>
            <ul>
                <?php foreach ($blood_request as $blood) : ?>
                <li><?= $blood['usagetype'] . ' (' . $blood['blood_quantity'] . ' ' . $blood['measurement'] . ')'; ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
    <h5>Checklist Persiapan Operasi</h5>
    <?php if (isset($informasiMedis)) : ?>
    <div class=" d-flex flex-wrap mb-3">
        <?php foreach ($informasiMedis as $key => $medis) : ?>
        <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <input type="checkbox" <?= @$medis == 1 ? 'checked' : ''; ?> onclick="return false;">
            <b><?= $key ?></b>
        </div>
        <?php endforeach ?>
    </div>
    <?php endif; ?>

    <h5>Riwayat Penyakit</h5>
    <?php if (isset($riwayat_penyakit)) : ?>
    <div class=" d-flex flex-wrap mb-3">
        <?php foreach ($riwayat_penyakit as $key => $riwayat) : ?>
        <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">

            <?php if ($riwayat['item_id'] == '34') : ?>
            <b><?= $riwayat['value_desc'] ?></b>
            <p class="pb-0 my-0"><?= $riwayat['histories']; ?></p>
            <?php else : ?>
            <input type="checkbox" <?= !empty(@$riwayat['histories']) ? 'checked' : ''; ?> onclick="return false;">
            <b><?= $riwayat['value_desc'] ?></b>
            <?php endif; ?>
        </div>
        <?php endforeach ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($lokalis)) : ?>
    <h5>Lokasi Operasi</h5>
    <div class=" d-flex flex-wrap mb-3">
        <?php foreach ($lokalis as $key => $value) : ?>
        <div class="col-6 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
            <?php if (isset($value['filedata64'])) : ?>
            <img class="mt-3" src="<?= 'data:image/png;base64,' . $value['filedata64'] ?>" width="300px">
            <?php else : ?>
            <img class="mt-3" src="<?= base_url('assets/img/asesmen/' . $value['value_info']) ?>" width="300px">
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>


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
            <div>pasien</div>
            <div class="mb-1">
                <div id="qrcode1"></div>
            </div>
            <div id="qrcode1-name"></div>
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
const base64_ttd_dok = <?= json_encode($val['ttd_dok'] ?? '') ?>;
if (base64_ttd_dok) {
    $('#qrcode').html(
        `<img src="${base64_ttd_dok}" alt="QR Code" style="width: 100%; max-width: 300px; height: auto;">`);
} else {
    $('#qrcode').html('');
}

$('#qrcode-name').html(`<?=$operasi['doctor']?>`)
</script>
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
            $('#qrcode1-name').html('<?=$visit['diantar_oleh']?>')
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