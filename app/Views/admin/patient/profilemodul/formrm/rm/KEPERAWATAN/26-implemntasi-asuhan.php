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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
            autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>
            <?php csrf_field(); ?>
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
                <h3 class="text-center"><?= $title; ?></h3>
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
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_gender']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Tanggal Lahir (Usia)</b>
                            <?php if (!empty($visit['date_of_birth'])) : ?>
                            <p class="m-0 mt-1 p-0">
                                <?= date('d/m/Y', strtotime($visit['date_of_birth'])) . ' (' . @$visit['age'] . ')'; ?>
                            </p>
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
                            <div><?= @$visit['name_of_class']; ?></div>
                        </td>
                        <td class="p-1">
                            <b>Bed</b>
                            <div><?= @$visit['bed_id'] === 0 ? "" : @$visit['bed_id']; ?></div>
                        </td>

                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Daftar Implementasi Asuhan Keperawatan</h4>
            </div>
            <table class="table table-bordered">
                <thead style="vertical-align: text-top;">
                    <tr>
                        <th style="width: 5%;">Tanggal</th>
                        <th style="width: 10%;">Tindakan</th>
                        <th>Respon</th>
                        <th style="width: 5%;">Nama</th>
                    </tr>
                </thead>
                <tbody id="daftar-implemntasi-tabels">
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
    let tabelsHandover = `<table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="2" ">HANDOVER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Pemberi</th>
                                            <th>Penerima</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="pt-2 text-center" id="qrcode" style="display: flex; justify-content: center;"></div>
                                                <p class="pt-3">Name</p>
                                            </td>
                                            <td>
                                                <div class="pt-2 text-center" id="qrcode2" style="display: flex; justify-content: center;"></div>
                                                <p class="pt-3">Name</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>`



    <?php $dataJson = json_encode($data); ?>
    let dataResult = []
    let data = <?php echo $dataJson; ?>;
    // console.log(data.lenght);
    // if(data.leng)
    data.map((e) => {
        if (e.respons === "mashookkkk") {
            dataResult += `<tr>
                                        <td>${moment(e?.tanggal, "YYYY-MM-DD HH:mm:ss.SSS").format("DD-MM-YYYY HH:mm")}</td>
                                        <td colspan="2">${tabelsHandover}</td>
                                        <td></td>
                                    </tr>`;
        } else {
            dataResult += `<tr><td>${moment(e?.tanggal, "YYYY-MM-DD HH:mm:ss.SSS").format("DD-MM-YYYY HH:mm")}</td>
                                <td>${e?.tindakan}</td>
                                <td>${e?.respons}</td>
                                <td>${e?.nama}</td>
                            </tr>`;
        }

    });

    $("#daftar-implemntasi-tabels").html(dataResult)

    let qrcode = new QRCode(document.getElementById("qrcode"), {
        text: 'a',
        width: 85,
        height: 85,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    let qrcode1 = new QRCode(document.getElementById("qrcode2"), {
        text: 'a',
        width: 85,
        height: 85,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });

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
window.print();
</script>

</html>