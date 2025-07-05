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


        <h5>The Sign In</h5>
        <?php if (!empty($theSignIn)) : ?>
        <div class="d-flex flex-wrap mb-3">
            <?php foreach ($theSignIn as $key => $signIn) : ?>
            <div class="col-10 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <b><?= $key ?></b>

            </div>
            <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <?php if ($signIn == "1") : ?>
                <p class="m-0 mt-1 p-0 text-center"><?= isset($signIn) && !empty($signIn) ? '&#10003;' : '-'; ?></p>
                <?php else : ?>
                <p class="m-0 mt-1 p-0 text-center"><?= $signIn ?? '-' ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach ?>
        </div>
        <?php endif; ?>
        <h5>The Time Out</h5>
        <?php if (!empty($theTimeOut)) : ?>
        <div class="d-flex flex-wrap mb-3">
            <?php foreach ($theTimeOut as $key => $timeOut) : ?>
            <div class="col-10 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <b><?= $key ?></b>

            </div>
            <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <?php if ($timeOut == "1") : ?>
                <p class="m-0 mt-1 p-0 text-center"><?= isset($timeOut) && !empty($timeOut) ? '&#10003;' : '-'; ?></p>
                <?php else : ?>
                <p class="m-0 mt-1 p-0 text-center"><?= $timeOut ?? '-' ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach ?>
        </div>
        <?php endif; ?>
        <b>Table Jumlah Instrumen</b>
        <?php if (!empty($instruments)) : ?>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th class="text-center align-middle" width="1%">No</th>
                    <th class="text-center align-middle">Jenis</th>
                    <th class="text-center align-middle">Jumlah Sebelum</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($instruments as $key => $instrumen) : ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $instrumen['brand_name']; ?></td>
                    <td><?= $instrumen['quantity_before']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
        <h5>The Sign Out</h5>
        <?php if (!empty($theSignOut)) : ?>
        <div class="d-flex flex-wrap mb-3">
            <?php foreach ($theSignOut as $key => $signOut) : ?>
            <div class="col-10 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <b><?= $key ?></b>

            </div>
            <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <?php if ($signOut == "1") : ?>
                <p class="m-0 mt-1 p-0 text-center"><?= isset($signOut) && !empty($signOut) ? '&#10003;' : '-'; ?></p>
                <?php else : ?>
                <p class="m-0 mt-1 p-0 text-center"><?= $signOut ?? '-' ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach ?>
        </div>
        <?php endif; ?>
        <b>Table Instrumen</b>
        <?php if (!empty($instruments)) : ?>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th class="text-center align-middle" width="1%">No</th>
                    <th class="text-center align-middle">Jenis</th>
                    <th class="text-center align-middle">Jumlah Sebelum</th>
                    <th class="text-center align-middle">Jumlah Intra</th>
                    <th class="text-center align-middle">Jumlah Tambahan</th>
                    <th class="text-center align-middle">Jumlah Pasca</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($instruments as $key => $instrumen) : ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $instrumen['brand_name']; ?></td>
                    <td><?= $instrumen['quantity_before']; ?></td>
                    <td><?= $instrumen['quantity_intra']; ?></td>
                    <td><?= $instrumen['quantity_additional']; ?></td>
                    <td><?= $instrumen['quantity_after']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
        <?php if (!empty($theSignOut2)) : ?>
        <div class="d-flex flex-wrap mb-3">
            <?php foreach ($theSignOut2 as $key => $signOut2) : ?>
            <div class="col-10 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <b><?= $key ?></b>

            </div>
            <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <?php if ($signOut2 == "1") : ?>
                <p class="m-0 mt-1 p-0 text-center"><?= isset($signOut2) && !empty($signOut2) ? '&#10003;' : '-'; ?></p>
                <?php else : ?>
                <p class="m-0 mt-1 p-0 text-center"><?= $signOut2 ?? '-' ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach ?>
        </div>
        <?php endif; ?>
        <div class=" row">
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
                <div id="qrcode1_name"></div>

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

    console.log("sasasasa");

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

$('#qrcode-name').html(`<?=$val['dokter']?>`)



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
            $('#qrcode1_name').html('<?=$visit['diantar_oleh']?>')
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