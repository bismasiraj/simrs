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
        <form action="/admin/rekammedis/rmj2_4/<?= base64_encode(json_encode($visit)); ?>" method="post"
            autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>

            <?php csrf_field(); ?>
            <div class="row text-center mb-2">
                <div class="col-auto">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px" alt="Logo">
                </div>
                <div class="col">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <p><?= @$kop['contact_address'] ?></p>
                </div>
                <div class="col-auto">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px"
                        alt="Paripurna Logo">
                </div>
            </div>
            <div class="row mb-2">
                <h3 class="text-center"><?= $title; ?></h3>
            </div>


            <div class="row mb-2">
                <div class="col">
                    Kepada Yth. TS Dokter: <br>
                    <br>
                    <?= @$data['polirujukan_nmpoli']; ?> <br>
                    di Faskes <b><?= @$data['provrujukan_nmprovider'] ?></b>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    Dengan hormat, <br>
                    Bersama ini kami kirimkan pasien:
                </div>
            </div>

            <!-- Form Input Fields -->

            <div class="row mb-2">
                <label for="" class="col-sm-3 col-form-label">Nama</label>
                <label for="" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span id=""><?= @$data['name_of_pasien'] ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="" class="col-sm-3 col-form-label">Umur</label>
                <label for="" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span id=""><?= @$data['age_years'] ?> th <?= @$data['age_months'] ?> bl <?= @$data['age_days'] ?> hr</span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                <label for="" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span id=""><?= @$data['contact_address'] ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="" class="col-sm-3 col-form-label">Pekerjaan</label>
                <label for="" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span id=""><?= @$data['name_of_job'] ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="" class="col-sm-3 col-form-label">Dengan kebutuhan / Diagnosa</label>
                <label for="" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span id=""><?= @$data['nmdiag'] ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="" class="col-sm-3 col-form-label">Sudah saya berikan</label>
                <label for="" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span id=""><?= @$data['given'] ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="" class="col-sm-3 col-form-label">Alasan Rujuk</label>
                <label for="" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span id=""><?= @$data['notes'] ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="" class="col-sm-3 col-form-label">Kebutuhan Pelayanan</label>
                <label for="" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span id=""><?= @$data['needs'] ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="" class="col-sm-3 col-form-label">Keterangan Lain</label>
                <label for="" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span id=""><?= @$data['other_notes'] ?></span>
                </div>
            </div>
            <!-- <div class="row mb-3">
                <div class="col"></div>
                <div class="col-auto text-end">
                    <div>Dokter Penanggung Jawab Pelayanan</div>
                    <div class="col-auto justify-end" id="qrcode">
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-4" align="center">
                    <div>Dokter Penanggung Jawab Pelayanan</div>
                    <br>
                    <div class="mb-1">
                        <div id="qrcode"></div>
                    </div>
                    <p class="p-0 m-0 py-1" id="qrcode_name"></p>
                    <p><i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i></p>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4" align="center">
                    <div class="mb-1">
                        <div id="qrcode1"></div>
                    </div>
                    <p class="p-0 m-0 py-1" id=""></p>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

<script>
    let sign = <?= json_encode($sign); ?>;

    sign = JSON.parse(sign)
    $.each(sign, function(key, value) {
        console.log(value)
        if (value.user_type == 1 && value.isvalid == 1) {
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: value.sign_path,
                width: 150,
                height: 150,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
            $("#qrcode_name").html(`(${value.fullname??value.user_id})`)
        } else if (value.user_type == 2 && value.isvalid == 1) {
            var qrcode1 = new QRCode(document.getElementById("qrcode1"), {
                text: value.sign_path,
                width: 150,
                height: 150,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
            // $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)
        }
    })
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
    window.print();
</script>

</html>