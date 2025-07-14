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
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css"
        rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>

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
    <div class="container-fluid">
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
            autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>

            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p><?= @$kop['contact_address'] ?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h3 class="text-center">Formulir Pemberian Edukasi</h3>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Nomor RM</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Nama Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['diantar_oleh']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Jenis Kelamin</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['gendername']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Tanggal Lahir (Usia)</b>
                            <?php if (!empty($visit['tgl_lahir'])) : ?>
                                <p class="m-0 mt-1 p-0">
                                    <?= date('d/m/Y', strtotime($visit['tgl_lahir'])) . ' (' . @$visit['age'] . ')'; ?>
                                </p>
                            <?php else : ?>
                                <p class="m-0 mt-1 p-0">-</p>
                            <?php endif; ?>
                        </td>
                        <td class="p-1" colspan="2">
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
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0"> <?= date('d-m-Y H:i', strtotime(@$visit['visit_datetime'])) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Kelas</b>
                            <div><?= @$visit['name_of_class']; ?></div>
                        </td>
                        <td class="p-1">
                            <b>Bangsal/ Kamar</b>
                            <div><?= @$visit['name_of_class_room']; ?></div>
                        </td>
                        <td class="p-1">
                            <b>Bed</b>
                            <div><?= @$visit['bed_id'] === 0 ? "" : @$visit['bed_id']; ?></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Tabel Edukasi</h4>
            </div>
            <table class="table table-bordered">
                <thead class="fw-bold">
                    <tr>
                        <td>Tanggal</td>
                        <td>Materi Edukasi</td>
                        <td>Nama Pasien/Keluarga/Kerabat</td>
                        <td>Tanda Tangan Keluarga</td>
                        <td>Staff</td>
                        <td>Tanda Tangan Staff</td>
                    </tr>
                </thead>
                <tbody id="edukasi-tables">

                </tbody>
            </table>
            <div id="datetime-now"></div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
<script>
    $(document).ready(function() {
        $("#datetime-now").html(`<em>Dicetak pada Tanggal ${moment(new Date()).format("DD-MM-YYYY HH:mm")}</em>`)
        dataRender()
    })
    const dataRender = () => {
        <?php $dataJson = json_encode($data); ?>
        let dataResult = []
        let data = <?php echo $dataJson; ?>;


        data?.map((e, index) => {
            dataResult += `<tr>
                            <td>${moment(e?.date, "YYYY-MM-DD HH:mm:ss.SSS").format("DD-MM-YYYY HH:mm")}</td>
                            <td>${e?.education}</td>
                            <td>${!e?.family_name ? (e?.family_relation === "tidak ada" ? '<?php echo @$visit["diantar_oleh"]; ?>' : e?.family_relation) : e?.family_name }</td>
                            <td><div id="qrcode-keluarga-${index + 1}" style="display: flex; justify-content: center;"></div></td>
                            <td>${!e?.staff ? "":e?.staff}</td>
                            <td><div id="qrcode-${index + 1}" style="display: flex; justify-content: center;"></div></td>
                        </tr>`
        })

        $("#edukasi-tables").html(dataResult)

        data?.forEach((e, index) => {
            if (e?.sign_file_family)
                cropTransparentPNG(`data:image/gif;base64,` + e?.sign_file_family, (croppedImage) => {
                    if (croppedImage) {
                        $('#qrcode1').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                        $(`#qrcode-keluarga-${index + 1}`).html('<img class="mt-3" src="' + croppedImage + '" width="100px">')
                    } else {
                        $('#qrcode1').html('');
                    }
                });
            if (e?.sign_file_staff)
                cropTransparentPNG(`data:image/gif;base64,` + e?.sign_file_staff, (croppedImage) => {
                    if (croppedImage) {
                        $('#qrcode1').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                        $(`#qrcode-${index + 1}`).html('<img class="mt-3" src="' + croppedImage + '" width="100px">')
                    } else {
                        $('#qrcode1').html('');
                    }
                });
        });
        window.print();
    }
</script>
<script type="text/javascript">
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
            size: A4 landscape;
            width: auto;
        }

        body {
            width: auto;
            height: auto;
            margin: 0;
            font-size: 12px;
        }

        .logo-ci4 {
            display: none;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }
    }
</style>

</html>