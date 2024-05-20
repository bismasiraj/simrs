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
            <table class="table table-bordered">
                <tr>
                    <td width=10% align="center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                    </td>
                    <td width=45%>
                        <h2>RS PKU MUHAMMADIYAH</h2>
                        <h2>SURAKARTA</h2>
                        <p>Jl. Ronggowarsito No 130 Surakarta <br> Telp. (0271) 714578 Jawa Tengah 57131</p>
                    </td>
                    <td>
                        <div class="container">
                            <div class="row mb-1">
                                <div class="col-sm-auto col-form-label">No RM :</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="" name="">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-auto col-form-label">Nama Pasien :</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="" name="">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-auto col-form-label">NIK :</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="" name="">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-auto col-form-label">Alamat :</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="" name="">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-auto col-form-label">Jenkel :</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="" name="">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <h3 class="text-center fw-bold">PERMINTAAN LABORATORIUM PATOLOGI ANATOMI (PA)</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-sm-auto col-form-label">Pengirim :</div>
                            <div class="col">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-sm-auto col-form-label"><b>PEMERIKSAAN JARINGAN TUBUH :</b></div>
                            <div class="col">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-1">
                            <div class="col-sm-auto col-form-label">Jaringan Tubuh Ini Didapat Dengan Eksisi Percobaan / Biopsi / Kerokan / Operasi / Otopsi / :</div>
                            <div class="col">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-auto col-form-label">Sebanyak :</div>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                            <div class="col-sm-auto col-form-label">Botol Kontainer</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-1">
                            <div class="col-sm-auto col-form-label">Berasal dari Alat / Organ :</div>
                            <div class="col">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-1">
                            <div class="col-sm-auto col-form-label">Difiksasi Dalam : Larutan Formalin 10% /</div>
                            <div class="col">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-1">
                            <div class="col-sm-auto col-form-label"><b>KETERANGAN KLINIK :</b></div>
                            <div class="col">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        Keterangan Jelas Tentang Penyakitnya (Riwayat Penyakit / Status Lokalis / Laporan Durante Operasi) :
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea class="form-control" name="" id=""></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Diagnosa Klinik :
                        <input type="text" class="form-control" id="" name="">
                    </td>
                </tr>
                <tr>
                    <td>
                        Terhadap Penderita Ini Belum / Telah Pernah Dilakukan Pemeriksaan Patologi / Sitologi Yaitu Di
                        <input type="text" class="form-control" id="" name="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-1">
                            <div class="col-sm-auto col-form-label">No :</div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                            <div class="col-sm-auto col-form-label">Tanggal :</div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                            <div class="col-sm-auto col-form-label">Diagnosa :</div>
                            <div class="col">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        Untuk Pemeriksaan Ini Penderita Dapat Membayar Menurut Kelas :
                        <div class="row mb-1">
                            <div class="col-sm-auto col-form-label">VIP / I / II / III Sebanyak @ Rp</div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="" name="">
                            </div> X
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                            <div class="col-sm-auto col-form-label">(Jumlah Bahan Jaringan) = Rp</div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-1">
                            <div class="col-sm-auto col-form-label">Dikirim Langsung / Tagihan / Lewat</div>
                            <div class="col">
                                <input type="text" class="form-control" id="" name="">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <table class="table table-bordered text-center">
                                    <tr>
                                        <td>Pengirim</td>
                                    </tr>
                                    <tr align="center">
                                        <td>
                                            <div id="qrcode"></div><br>
                                            <input type="text" class="form-control" id="" name="">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
        text: "https://example.com",
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

</html>