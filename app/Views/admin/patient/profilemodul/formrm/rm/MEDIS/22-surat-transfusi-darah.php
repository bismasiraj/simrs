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
        <!-- template header -->
        <div class="row">
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
            </div>
            <div class="col mt-2" align="center">
                <h3><?= $organization['name_of_org_unit'] ?></h3>
                <p class="mb-1"><?= $organization['contact_address'] ?></p>
                <p>SK No.<?= $organization['sk'] ?></p>
            </div>
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
            </div>
        </div>

        <div class="row">
            <h5 class="text-center">Permintaan Daran Untuk Transfusi</h5><br>
        </div>
        <div class="row">
            <h5 class="text-start">Informasi Pasien</h5>
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
                        <p class="m-0 mt-1 p-0"><?= tanggal_indo($visit['date_of_birth']) . ' (' . @$visit['age'] . ')'; ?></p>

                    </td>
                    <td class="p-1" style="width:66.3%" colspan="2">
                        <b>Alamat Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['visitor_address']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>DPJP</b>
                        <p class="m-0 mt-1 p-0"><?= @@$visit['fullname']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Department</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic_from']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Tanggal Masuk</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['in_date']; ?></p>
                    </td>
                </tr>
                <!-- jika pasien rawat inap -->
                <?php if (!empty($visit['class_room_id'])) : ?>
                    <tr>
                        <td class="p-1">
                            <b>Kelas</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_class_plafond']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Bangsal/Kamar</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Bed</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['bed']; ?></p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <!-- end of template header -->
        <div class="row">
            <h2 class="text-center"><?= $title; ?></h2>
        </div>
        <table class="table table-borderless">
            <tr>
                <td width="90px;" class="p-0 mb-0">Bagian</td>
                <td width="1%" class="p-0 mb-0">:</td>
                <td class="p-0 mb-0"><?= $visit['name_of_clinic_from']; ?></td>
            </tr>
            <tr>
                <td class="p-0 mb-0">Dokter yang meminta</td>
                <td width="1%" class="p-0 mb-0">:</td>
                <td class="p-0 mb-0"><?= @$visit['fullname']; ?></td>
            </tr>
            <tr>
                <th colspan="3"><u>Penderita :</u></th>
            </tr>
        </table>
        <table class="table table-borderless">
            <tr>
                <td width="90px;" class="p-0 mb-0">Nama</td>
                <td width="1%" class="p-0 mb-0">:</td>
                <td class="p-0 mb-0"><?= $visit['diantar_oleh']; ?></td>
            </tr>
            <tr>
                <td class="p-0 mb-0">Jenis Kelamin</td>
                <td width="1%" class="p-0 mb-0">:</td>
                <td class="p-0 mb-0"><?= $visit['gendername']; ?></td>
            </tr>
            <tr>
                <td class="p-0 mb-0">Alamat</td>
                <td width="1%" class="p-0 mb-0">:</td>
                <td class="p-0 mb-0"><?= $visit['contact_address']; ?></td>
            </tr>
            <tr>
                <td class="p-0 mb-0">Ruang</td>
                <td width="1%" class="p-0 mb-0">:</td>
                <td class="p-0 mb-0"><?= $visit['name_of_clinic']; ?></td>
            </tr>
            <tr>
                <td class="p-0 mb-0">Kelas</td>
                <td width="1%" class="p-0 mb-0">:</td>
                <td class="p-0 mb-0"><?= $visit['name_of_clinic_from']; ?></td>
            </tr>
            <tr>
                <td class="p-0 mb-0">Diagnosis Sementara</td>
                <td width="1%" class="p-0 mb-0">:</td>
                <td class="p-0 mb-0"><?= $val['diagnosis']; ?></td>
            </tr>
            <tr>
                <td class="p-0 mb-0">Diperlukan tanggal</td>
                <td width="1%" class="p-0 mb-0">:</td>
                <td class="p-0 mb-0"><?= $blood_request['tanggal']; ?></td>
            </tr>
            <tr>
                <td class="p-0 mb-0">Jenis darah yang diperlukan</td>
                <td width="1%" class="p-0 mb-0">:</td>
                <td class="p-0 mb-0"><?= $blood_request['usagetype']; ?></td>
            </tr>
        </table>

        <div class="row justify-content-end">
            <div class="col-6">
                <p class="text-center fw-bold"><?= $organization['kota'] . ', ' . tanggal_indo(date_format(date_create('now'), 'Y-m-d')); ?></p>
                <p class="text-center fw-bold"><?= $organization['name_of_org_unit']; ?></p>
                <p class="text-center fw-bold">Dokter yang meminta</p>
                <div class="mb-1 d-flex justify-content-center">
                    <div id="qrcode"></div>
                </div>
                <p class="text-center fw-bold">(<?= @$visit['fullname']; ?>)</p>
            </div>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: '<?= @$visit['fullname']; ?>',
        width: 60,
        height: 60,
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