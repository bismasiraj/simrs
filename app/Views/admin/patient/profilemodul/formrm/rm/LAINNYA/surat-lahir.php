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
                <h3 class="text-center">Surat Keterangan Lahir</h3>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <div id="no_registration" name="no_registration"><?= @$visit['no_registration']; ?></div>
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <div id="thename" name="thename" class="thename"><?= @$visit['diantar_oleh']; ?></div>
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <div name="gender" id="gender">
                                <?= @$visit['name_of_gender']; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <div id="patient_age" name="patient_age"><?= @$visit['date_of_birth']; ?>
                                (<?= @$visit['age']; ?> )</div>
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <div id="theaddress" name="theaddress" class="theaddress"><?= @$visit['contact_address']; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <div id="fullname" name="fullname"><?= @@$visit['fullname']; ?></div>
                        </td>
                        <td>
                            <b>Department</b>
                            <div id="clinic_id" name="clinic_id"><?= @$visit['clinic_id']; ?></div>
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <div id="examination_date" name="examination_date"><?= @$visit['visit_date']; ?></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mb-2">
                <div class="col text-center">
                    <h3><b><u>Surat Keterangan Lahir</u></b></h3>
                </div>
            </div>
            <div class="row">
                <label for="sa" class="col col-form-label">Yang bertanda tangan di bawah ini menerangkan telah
                    menolong dengan selamat lahiran seorang bayi :</label>
            </div>
            <div class="row">
                <label for="sa" class="col-sm-2 col-form-label">Nama Anak</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span><?= @$data['thename']; ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row mb-2">
                        <label for="sa" class="col-sm-4 col-form-label">jenis Kelamin</label>
                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span>
                                <?= isset($data['gender']) ? ($data['gender'] == 1 ? 'Laki-laki' : ($data['gender'] == 2 ? 'Perempuan' : '')) : '' ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row mb-2">
                        <label for="weight" class="col-sm-4 col-form-label">Pasaran</label>
                        <label for="weight" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$pasaran['pasaran']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label for="sa" class="col-sm-2 col-form-label">Tanggal</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span><?= @$pasaran['the_day']; ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="sa" class="col-sm-2 col-form-label">Hari</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span><?= @$pasaran['nama_hari']; ?></span>

                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row mb-2">
                        <label for="sa" class="col-sm-4 col-form-label">Panjang Badan</label>
                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$data['height']; ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row mb-2">
                        <label for="weight" class="col-sm-4 col-form-label">Berat Badan</label>
                        <label for="weight" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$data['weight']; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <label for="sa" class="col-sm-2 col-form-label">Jam</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?= isset($pasaran['the_day']) ? date('H:i', strtotime($pasaran['the_day'])) : '' ?>
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="sa" class="col-sm-2 col-form-label">Anak Ke</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span><?= @$data['baby_ke']; ?></span>
                </div>
            </div>

            <div class="row">
                <label for="sa" class="col col-form-label">Bayi tersebut diatas adalah anak Suami/ Istri :</label>
            </div>

            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row mb-2">
                        <label for="sa" class="col-sm-4 col-form-label">Nama Ibu</label>
                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$data['mothername']; ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row mb-2">
                        <label for="weight" class="col-sm-4 col-form-label">Umur</label>
                        <label for="weight" class="col-sm-auto col-form-label">:</label>
                        <div class="col">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row mb-2">
                        <label for="sa" class="col-sm-4 col-form-label">Nama Ayah</label>
                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$data['fathername']; ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row mb-2">
                        <label for="weight" class="col-sm-4 col-form-label">umur</label>
                        <label for="weight" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$val['berat_badan'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label for="sa" class="col-sm-2 col-form-label">Pekerjaan</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span><?= @$data['employee_id'] ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="sa" class="col-sm-2 col-form-label">Alamat</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span><?= @$data['theaddress'] ?></span>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Dokter Yang Merawat,</div>
                    <div class="mb-1">
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div> -->
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: 'sa',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    $(document).ready(function() {
        $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
        $("#no_registration").val("<?= $visit['no_registration']; ?>")
        $("#visit_id").val("<?= $visit['visit_id']; ?>")
        $("#clinic_id").val("<?= $visit['clinic_id']; ?>")
        $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
        $("#in_date").val("<?= $visit['in_date']; ?>")
        $("#exit_date").val("<?= $visit['exit_date']; ?>")
        $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
        <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
        ?>
        $("#examination_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
        $("#employee_id").val("<?= $visit['employee_id']; ?>")
        $("#description").val("<?= $visit['description']; ?>")
        $("#modified_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
        $("#modified_by").val("<?= user()->username; ?>")
        $("#modified_from").val("<?= $visit['clinic_id']; ?>")
        $("#status_pasien_id").val("<?= $visit['status_pasien_id']; ?>")
        $("#ageyear").val("<?= $visit['ageyear']; ?>")
        $("#agemonth").val("<?= $visit['agemonth']; ?>")
        $("#ageday").val("<?= $visit['ageday']; ?>")
        $("#thename").val("<?= $visit['diantar_oleh']; ?>")
        $("#theaddress").val("<?= $visit['visitor_address']; ?>")
        $("#theid").val("<?= $visit['pasien_id']; ?>")
        $("#isrj").val("<?= $visit['isrj']; ?>")
        $("#gender").val("<?= $visit['gender']; ?>")
        $("#doctor").val("<?= $visit['employee_id']; ?>")
        $("#kal_id").val("<?= $visit['kal_id']; ?>")
        $("#petugas_id").val("<?= user()->username; ?>")
        $("#petugas").val("<?= user()->fullname; ?>")
        $("#account_id").val("<?= $visit['account_id']; ?>")
    })
    $("#btnSimpan").on("click", function() {
        saveSignatureData()
        saveSignatureData1()
        console.log($("#TTD").val())
        $("#form").submit()
    })
    $("#btnEdit").on("click", function() {
        $("input").prop("disabled", false);
        $("textarea").prop("disabled", false);

    })
</script>
<style>
    @media print {
        @page {
            margin: 0;
            scale: 80;
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