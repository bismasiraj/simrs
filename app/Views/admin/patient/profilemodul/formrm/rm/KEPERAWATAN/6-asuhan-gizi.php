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
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post" autocomplete="off">
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
                    <h3>RS PKU Muhammadiyah Sampangan</h3>
                    <h3>Surakarta</h3>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK No.449/0238/P-02/IORS/II/2018</p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><?= $title; ?></h4>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <input type="text" class="form-control" id="no_registration" name="no_registration">
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <input type="text" class="form-control" id="thename" name="thename">
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <select name="gender" id="gender" class="form-control">
                                <option value="1">Laki-Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <input type="text" class="form-control" id="patient_age" name="patient_age">
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <input type="text" class="form-control" id="theaddress" name="theaddress">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <input type="text" class="form-control" id="doctor" name="doctor">
                        </td>
                        <td>
                            <b>Department</b>
                            <input type="text" class="form-control" id="clinic_id" name="clinic_id">
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kelas</b>
                            <input type="text" class="form-control" name="">
                        </td>
                        <td>
                            <b>Bangsal/Kamar</b>
                            <input type="text" class="form-control" name="">
                        </td>
                        <td>
                            <b>Bed</b>
                            <input type="text" class="form-control" name="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Asesmen Gizi Awal</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Tanggal</b>
                        <input type="text" class="form-control" name="">
                    </td>
                    <td>
                        <b>Jenis Antropometri</b>
                        <input type="text" class="form-control" name="">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td width="50%">
                        <b>Kategori Usia</b>
                        <input type="text" class="form-control" name="">
                    </td>
                    <td rowspan="4"></td>
                </tr>
                <tr>
                    <td>
                        <b>BB</b>
                        <input type="text" class="form-control" name="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>TB</b>
                        <input type="text" class="form-control" name="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>BMI</b>
                        <input type="text" class="form-control" name="">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td colspan="2">
                        <b>Biokimia</b>
                        <input type="text" class="form-control" name="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Vital Sign & Keadaan Umum</b>
                        <textarea type="text" class="form-control" name=""></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Alergi Makanan</b>
                        <input type="text" class="form-control" name="">
                    </td>
                    <td>
                        <b>Pola Makan</b>
                        <input type="text" class="form-control" name="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Total Asupan</b>
                        <table class="table table-bordered">
                            <thead class="fw-bold">
                                <tr>
                                    <td>Zat Gizi</td>
                                    <td>MRS</td>
                                    <td>Kebuguhan</td>
                                    <td>%</td>
                                    <td>Perhitungan Kebutuhan (/kgBB/hr)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Energi</td>
                                    <td>0.0</td>
                                    <td>1944.6</td>
                                    <td>0.0</td>
                                    <td>0.0</td>
                                </tr>
                                <tr>
                                    <td>Karbohidrat</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Protein</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Lemak</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Diagnosis Gizi (ICD-10)</b>
                        <input type="text" class="form-control" name="">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-auto" align="center">
                                <div>Ahli Gizi</div>
                                <div class="mb-1">
                                    <div id="qrcode"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row">
                <h4 class="text-start">Diagnosis Gizi</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Diagnosis Gizi (ICD-10)</b>
                        <input type="text" class="form-control" name="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Rencana dan Hasil Intervensi</b>
                        <table class="table table-bordered">
                            <thead class="fw-bold">
                                <tr>
                                    <td>Tanggal</td>
                                    <td>Intervensi Gizi</td>
                                    <td>Target</td>
                                    <td>Hasil</td>
                                    <td>Identifikasi Masalah</td>
                                    <td>Rencana Tindak Lanjut</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Food Recall</b>
                        <table class="table table-bordered">
                            <thead class="fw-bold">
                                <tr>
                                    <td>Tanggal/Jam Makan</td>
                                    <td>Nama Masakan</td>
                                    <td>URT Masakan</td>
                                    <td>Estimasi/Gram</td>
                                    <td>Nama Bahan</td>
                                    <td>URT Bahan</td>
                                    <td>Gramasi Bahan</td>
                                    <td>Netto Bahan</td>
                                    <td>Keterangan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Monitoring dan Evaluasi</b>
                        <input type="text" class="form-control" name="">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: 'a',
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