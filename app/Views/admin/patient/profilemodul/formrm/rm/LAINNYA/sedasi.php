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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
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
                            <input type="text" class="form-control" id="kelas" name="kelas" value="">
                        </td>
                        <td>
                            <b>Bangsal/Kamar</b>
                            <input type="text" class="form-control" id="bangsal" name="bangsal" value="">
                        </td>
                        <td>
                            <b>Bed</b>
                            <input type="text" class="form-control" id="bed" name="bed" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4>Informasi Medis</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Hilangnya Gigi</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Masalah Mobilisasi Leher</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Leher Pendek</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Batuk</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Sesak Nafas</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Barusaja Menderita Infeksi Saluran Nafas</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Periode Menstruasi Tidak Normal</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Stroke</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Sakit Dada</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Denyut Jantung Tidak Normal</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Muntah</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Susah Kencing</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Kejang</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Sedang Hamil</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Pingsan</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Obesitas</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <div class="row mb-3">
                <h4>Kajian Sistem</h4>
            </div>
            <div class="row">
                <h4>Pemeriksaan Fisik</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Tekanan Darah</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Denyut Nadi</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Suhu Tubuh</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Respiration Rate</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Berat Badan</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Tinggi Badan</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>SpO2</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>BMI</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Keadaan Umum</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Kepala</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Mata</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Hidung</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Telinga</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Mulut</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Gigi</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Leher</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Thorax</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Jantung</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Paru-paru</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Abdomen</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Hepar</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Lien</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Ginjal</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td rowspan="2">
                        <b>Genitalia</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Ekstremitas Atas</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Ekstremitas Bawah</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <div class="row">
                <h4>Keadaan Umum</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td colspan="2">
                        <b>Gigi Palsu</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Mallampati</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Kriteria ASA</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <div class="row">
                <h4>Diagnosis</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Diagnosis (ICD-10)</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <div class="row">
                <h4>Asesmen</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Asesmen</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <div class="row">
                <h4>Perencenaan Anestesia</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Sedasi</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>GA</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Regional Spinal</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Regional Epidural</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Regional Kaudal</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Regional Block Perifer</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Lain-lain</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Perawatan Pasca Anestesi</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Persiapan Pre Anestesi</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <div class="row">
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Dokter Anestesi</div>
                    <div class="mb-1">
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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