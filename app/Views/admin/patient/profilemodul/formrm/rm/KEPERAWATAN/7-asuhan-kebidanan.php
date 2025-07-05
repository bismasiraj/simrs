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

            <input type="hidden" name="body_id" id="body_id">
            <input type="hidden" name="org_unit_code" id="org_unit_code">
            <input type="hidden" name="pasien_diagnosa_id" id="pasien_diagnosa_id">
            <input type="hidden" name="diagnosa_id" id="diagnosa_id">
            <input type="hidden" name="visit_id" id="visit_id">
            <input type="hidden" name="bill_id" id="bill_id">
            <input type="hidden" name="class_room_id" id="class_room_id">
            <input type="hidden" name="in_date" id="in_date">
            <input type="hidden" name="exit_date" id="exit_date">
            <input type="hidden" name="keluar_id" id="keluar_id">
            <!-- <input type="hidden" name="examination_date" id="examination_date"> -->
            <input type="hidden" name="employee_id" id="employee_id">
            <input type="hidden" name="description" id="description">
            <input type="hidden" name="modified_date" id="modified_date">
            <input type="hidden" name="modified_by" id="modified_by">
            <input type="hidden" name="modified_from" id="modified_from">
            <input type="hidden" name="status_pasien_id" id="status_pasien_id">
            <input type="hidden" name="ageyear" id="ageyear">
            <input type="hidden" name="agemonth" id="agemonth">
            <input type="hidden" name="ageday" id="ageday">
            <input type="hidden" name="theid" id="theid">
            <input type="hidden" name="isrj" id="isrj">
            <input type="hidden" name="gender" id="gender">
            <input type="hidden" name="kal_id" id="kal_id">
            <input type="hidden" name="petugas_id" id="petugas_id">
            <input type="hidden" name="petugas" id="petugas">
            <input type="hidden" name="account_id" id="account_id">
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
                <h3 class="text-center">Asuhan Kebidanan</h3>
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
                <h4 class="text-start">Tabel Asuhan Kebidanan</h4>
            </div>
            <table class="table table-bordered">
                <thead class="fw-bold">
                    <tr>
                        <td style="width: 9%;">Waktu</td>
                        <td>Dokumentasi</td>
                        <td style="width: 25%;">Bidan</td>
                        <td style="width: 20%;">Paraf</td>
                    </tr>
                </thead>
                <tbody id="data-asuhan-bidan-tabels">

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
        dataRender();

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
        data?.map((e, index) => {
            if (e?.respons === "mashookkkk") {
                dataResult += `<tr>
                                        <td>${moment(e?.tanggal, "YYYY-MM-DD HH:mm:ss.SSS").format("DD-MM-YYYY HH:mm")}</td>
                                        <td colspan="2">${tabelsHandover}</td>
                                        <td></td>
                                    </tr>`;
            } else {
                dataResult += `<tr><td>${moment(e?.tanggal, "YYYY-MM-DD HH:mm:ss.SSS").format("DD-MM-YYYY HH:mm")}</td>
                                <td>${e?.tindakan}</td>
                                <td>${e?.nama}</td>
                                <td>
                                    <div id="qrcode-${index + 1}" style="display: flex; justify-content: center;"></div>
                                </td>
                            </tr>`;
            }
        });

        $("#data-asuhan-bidan-tabels").html(dataResult)

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

        data?.forEach((e, index) => {
            let qrcodeName = new QRCode(document.getElementById(`qrcode-${index + 1}`), {
                text: !e?.nama ? "" : e?.nama,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // Tingkat koreksi tinggi
            });
        });
    }
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
            /* Memastikan konten mencakup seluruh lebar kertas A4 */
            height: auto;
            /* Mengatur tinggi halaman otomatis sesuai dengan konten */
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
<script type="text/javascript">
    window.print();
</script>

</html>