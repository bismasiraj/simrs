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
                <h3 class="text-center">Persetujuan Umum</h3>
            </div>
            <div class="row mb-5">
                <h2 class="text-center fw-bold">IDENTITAS DAN PERNYATAAN RAWAT INAP PASIEN</h2>
            </div>
            <div class="row">
                <div class="col"><b>PENDAFTAR</b></div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?= isset($family_data['fullname']) ? $family_data['fullname'] : @$visit['diantar_oleh'] ?></span>
                </div>
                <label for="sa" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?= isset($family_data['gender'])
                            ? ($family_data['gender'] == 1 ? 'Laki-Laki' : 'Perempuan')
                            : (isset($visit['gender']) ? ($visit['gender'] == 1 ? 'Laki-Laki' : 'Perempuan') : '-'); ?>
                    </span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">No. KTP / SIM</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?= isset($family_data['family_status_id']) ? $family_data['family_status_id'] : @$visit['pasien_id'] ?></span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">Umur</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?php
                        if (isset($family_data['date_of_birth'])) {
                            $dateOfBirth = new DateTime($family_data['date_of_birth']);
                            $today = new DateTime();
                            $age = $today->diff($dateOfBirth)->y;

                            echo $age . " tahun";
                        } else {
                            echo @$visit['ageyear'] . " Tahun";
                        }
                        ?>
                    </span>

                </div>
                <label for="sa" class="col-sm-2 col-form-label">Status</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?= isset($family_data['status_pasien_id']) ? $family_data['status_pasien_id'] : @$visit['status_pasien_id'] ?></span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">Agama</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?php

                        $religions = [
                            1 => 'Islam',
                            2 => 'Kristen',
                            3 => 'Katholik',
                            4 => 'Hindu',
                            5 => 'Budha',
                            6 => 'Aliran',
                            7 => 'Lainnya',
                            8 => '-'
                        ];
                        ?>
                        <?php
                        $religionId  = isset($family_data['kode_agama']) ? $family_data['kode_agama'] : @$visit['nama_agama'];


                        echo isset($religions[$religionId]) ? $religions[$religionId] : '-';
                        ?></span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">Pekerjaan</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?php
                        $jobs = [
                            0 => 'BELUM BEKERJA',
                            1 => 'TNI',
                            2 => 'KARYAWAN',
                            3 => 'PENSIUNAN',
                            4 => 'PETANI',
                            5 => 'PELAJAR/MAHASISWA',
                            6 => 'BURUH',
                            7 => 'GURU/DOSEN',
                            8 => 'IBU RUMAH TANGGA',
                            9 => 'PNS',
                            10 => 'LAIN-LAIN',
                            11 => 'PEGAWAI SWASTA',
                            21 => 'WIRASWASTA',
                            22 => 'SWASTA',
                            23 => 'POLRI',
                            24 => 'CPNS',
                            25 => 'JAKSA',
                            26 => 'BUMN',
                            27 => 'BUMD',
                            28 => 'PEDAGANG',
                            29 => 'DOKTER',
                            30 => 'HAKIM/KEHAKIMAN',
                            31 => 'DPR/Anggota Dewan',
                            32 => 'BIDAN',
                            33 => 'PERAWAT',
                            34 => 'PENDETA',
                            35 => 'NELAYAN',
                            36 => 'HONORER'
                        ];
                        ?>
                        <?php
                        $jobId = isset($family_data['job_id']) ? $family_data['job_id'] : @$visit['employee_id'];


                        echo isset($jobs[$jobId]) ? $jobs[$jobId] : '-';
                        ?></span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?= isset($family_data['address']) ? $family_data['address'] : @$visit['contact_address'] ?></span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">Telepon</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?= isset($family_data['mobile']) ? $family_data['mobile'] : @$visit['phone_number'] ?></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="sa" class="col-sm-2 col-form-label">Hub. Dengan Pasien</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?= isset($family_data['family_status']) && !empty($family_data['family_status'])
                            ? $family_data['family_status']
                            : (isset($visit['family_status_id']) && !empty($visit['family_status_id'])
                                ? $visit['family_status_id']
                                : 'Diri Sendiri'); ?>
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col"><b>PASIEN</b></div>
            </div>
            <div class="row mb-1">
                <label for="thename" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <label for="thename" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span> <?= @$visit['diantar_oleh'] ?></span>
                </div>
                <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <label for="gender" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span>
                        <?= isset($visit['gender'])
                            ? ($visit['gender'] == 1 ? 'Laki-Laki' : 'Perempuan')
                            : '-'; ?>
                    </span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="theid" class="col-sm-2 col-form-label">No. KTP / SIM</label>
                <label for="theid" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span> <?= @$visit['pasien_id'] ?></span>

                </div>
            </div>

            <div class="row mb-1">
                <label for="patient_age" class="col-sm-2 col-form-label">Umur</label>
                <label for="patient_age" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span> <?= @$visit['ageyear'] . " Tahun" ?></span>
                </div>
                <label for="status_pasien_id" class="col-sm-2 col-form-label">Status</label>
                <label for="status_pasien_id" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span> <?= @$visit['status_pasien_id'] ?></span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">Agama</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span> <?= @$visit['nama_agama'] ?></span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">Pekerjaan</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span> <?= @$visit['employee_id'] ?></span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="theaddress" class="col-sm-2 col-form-label">Alamat</label>
                <label for="theaddress" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span> <?= @$visit['contact_address'] ?></span>
                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">Telepon</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span> <?= @$visit['phone_number'] ?></span>


                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-2 col-form-label">No. Kartu BPJS</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span> <?= @$visit['no_skp'] ?></span>

                </div>
            </div>
            <div class="row">
                <div class="col"><b>Dengan ini:</b></div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-auto col-form-label">Menghendaki Pasien tersebut di atas dirawat inap di
                    kelas:</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="sa" name="sa" value="">
                </div>
            </div>
            <div class="row mb-1">
                <label for="sa" class="col-sm-auto col-form-label">Dirawat Sebagai Pasien:</label>
                <label for="sa" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="sa" name="sa" value="">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <b>Keterangan:</b>
                    <p>Apabila diawal sudah melingkari sebagai pasien UMUM maka tidak bisa berpindah
                        menjadi pasien JKN KIS/BPJS atau Asuransi yang lain.</p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <b>Pernyataan Pasien JKN KIS / BPJS<br>Bahwa:</b>
                    <p>
                        1. Persyaratan Lengkap dalam waktu maksimal 2 x 24 jam. <br>
                        2. Apabila pasien pulang/dirujuk sebelum 2 x 24 jam, persyaratan harus sudah lengkap. <br>
                        3. Membayar sepenuhnya biaya perawatan (pasien umum), jika persyaratan tidak lengkap. <br>
                        4. Data yang tertulis di atas adalah yang sebenarnya dan tidak akan terjadi perubahan data. <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Surat pernyataan ini saya buat atas kesadaran sendiri dan tanpa paksaan/dipengaruhi oleh
                        siapapun. Kami mengerti dan bertanggung jawab atas segala resiko yang akan terjadi.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-auto" align="center">
                    <div>Petugas Pendaftaran,</div>
                    <div class="mb-1">
                        <div id="qrcode"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Yang Membuat Pernyataan,</div>
                    <div class="mb-1">
                        <div id="qrcode1"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
<script>
    // var qrcode = new QRCode(document.getElementById("qrcode"), {
    //     text: 'a',
    //     width: 70,
    //     height: 70,
    //     colorDark: "#000000",
    //     colorLight: "#ffffff",
    //     correctLevel: QRCode.CorrectLevel.H // High error correction
    // });
</script>
<script>
    // var qrcode = new QRCode(document.getElementById("qrcode1"), {
    //     text: 'a',
    //     width: 70,
    //     height: 70,
    //     colorDark: "#000000",
    //     colorLight: "#ffffff",
    //     correctLevel: QRCode.CorrectLevel.H // High error correction
    // });
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