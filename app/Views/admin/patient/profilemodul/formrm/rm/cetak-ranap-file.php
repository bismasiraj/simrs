<style>
    @media print {
        @page {
            margin: none;
            /* scale: 85; */
        }

        .container {
            width: 100%;
            /* Sesuaikan dengan lebar kertas A4 */
        }

        .page-break {
            page-break-before: always;
            /* Menambahkan halaman baru sebelum elemen dengan kelas ini */
        }

        td {
            background-color: inherit;
            color: inherit;
            border: inherit;
            padding: inherit;
            text-align: inherit;
        }

    }
</style>


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RAWAT INAP FILE PENDUKUNG</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>

    <style>
        .form-control.print-hidden-form:focus,
        .input-group-text:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            border-color: #80bdff;
            outline: none;
        }

        .form-control.print-hidden-form:disabled,
        .form-control.print-hidden-form[readonly] {
            background-color: #FFF;
            opacity: 1;
        }

        .form-control.print-hidden-form,
        .input-group-text {
            background-color: #fff;
            border: 1px solid #fff;
            font-size: 12px;
        }

        .table-container-split {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .table-container-split table {
            width: 45%;
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

        thead.border {
            border-bottom: 1px solid black !important;
            border-top: 1px solid black !important;
        }

        tbody.border {
            border-bottom: 1px solid black !important;
        }
    </style>
</head>

<!-- SEP -->
<?php if (!empty($sep['json'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-6">
                        <div>
                            <img src="<?= base_url() ?>assets/img/bpjs.jpeg" alt="BPJS KESEHATAN" style="width: 230px;">
                        </div>
                        <form action="" method="">
                            <div class="form-group row mt-2 align-items-center">
                                <label for="no_sep" class="col-sm-4 col-form-label">No. SEP</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$sep['json']['no_skp']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="tgl_sep" class="col-sm-4 col-form-label">Tgl. SEP</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-4">
                                    <span><?php echo @$sep['json']['visit_date']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="no_kartu" class="col-sm-4 col-form-label">No. Kartu</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$sep['json']['kk_no']; ?></span>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="nama_peserta" class="col-sm-4 col-form-label">Nama Peserta</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$sep['json']['name_of_pasien']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-4">
                                    <span><?php echo @$sep['json']['date_of_birth']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-4">
                                    <?php if (@$sep['json']['gender'] == 1) { ?>
                                        <span>L</span>
                                    <?php } else { ?>
                                        <span>P</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="poli_tujuan" class="col-sm-4 col-form-label">Poli Tujuan</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$sep['json']['clinic_id']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="asal_faskes" class="col-sm-4 col-form-label">Asal Faskes</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>

                                <?= $kop['kota']; ?>
                                <div class="col-sm-7">
                                    <span><?= $kop['name_of_org_unit']; ?> - <?= $kop['kota']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="diagnosa_awal" class="col-sm-4 col-form-label">Diagnosa Awal</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$sep['json']['diag_awal']; ?>-<?php echo @$sep['json']['conclusion']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="catatan" class="col-sm-4 col-form-label">Catatan</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$sep['json']['description']; ?></span>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <p>*Saya menyetujui BPJS Kesehatan mengunakan informasi medis pasien jika diperlukan
                                    <br>*SEP bukan sebagai bukti penjaminan peserta
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="row">
                            <h6 class="text-center"><b>SURAT ELIGIBILITAS PESERTA <br> <?= $kop['name_of_org_unit']; ?></b>
                            </h6>
                        </div>
                        <form action="" method="">
                            <div class="form-group row mt-2">
                                <label for="peserta" class="col-sm-4 col-form-label">Peserta</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7 align-items-center">
                                    <span>Anak</span>
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="no_cm" class="col-sm-4 col-form-label">No. CM</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7 align-items-center">
                                    <span><?php echo @$sep['json']['no_registration']; ?></span>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="cob" class="col-sm-4 col-form-label">COB</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7 align-items-center">
                                    <span><?php echo @$sep['json']['cob']; ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_rawat" class="col-sm-4 col-form-label">Jenis Rawat</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7 align-items-center">
                                    <span>Rawat Jalan</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7 align-items-center">
                                    <span>Kelas I</span>
                                </div>
                            </div>


                            <div class="row align-items-center mt-5">
                                <div class="col-2"></div>
                                <div class="col-10">
                                    <h6><?= $kop['kota']; ?>,
                                        <span><?php echo @$sep['json']['visit_date']; ?></span>
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-3">
                                    <div class="text-center">
                                        <h6>Pasien/<br>Keluarga<br>Pasien</h6>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="text-center">
                                        <h6>Petugas BPJS<br>Kesehatan</h6>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-3">
                                    <hr style="border: 2px solid black;">
                                </div>
                                <div class="col-3">
                                    <hr style="border: 2px solid black;">
                                </div>
                            </div>

                        </form>
                    </div>
                    <form action="" method="">
                        <div class="row">
                            <h6 class="text-center"><b>SURAT BUKTI PELAYANAN <br> NAMA RS : <?= $kop['name_of_org_unit']; ?>
                                    KODE RS :<?= $kop['other_code']; ?>
                                    KELAS RS : <?= $kop['org_type']; ?>


                                </b></h6>
                            <h6 class="text-uppercase text-decoration-underline text-center"><b>rawat jalan</b></h6>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <div class="col-5">
                                    <label>Tanggal Masuk:</label>
                                </div>
                                <div class="col-12">
                                    <label>Cara Keluar : 1. Sembuh 2. Rujuk <br> 3. APS 4. Meninggal 5.
                                        ..................</label>
                                </div>
                            </div>

                            <div class="col-4">
                                <label>Tanggal Keluar:</label>
                                <br>
                                <label>Tarif RS:</label>
                                <br>
                                <label>Jml Hari Perawatan:</label>
                                <br>
                                <label>Berat Lahir:</label>
                            </div>

                            <div class="col-3">
                                <table class="table table-bordered" style="border: solid black;">
                                    <tbody>
                                        <tr style="height: 15px;">
                                            <td class="text-center">
                                                <label class="text-uppercase">urologi</label>
                                            </td>
                                        </tr>
                                        <tr style="height: 25px;">
                                            <!-- Sesuaikan tinggi baris sesuai kebutuhan -->
                                            <td class="text-center">
                                                <label class="text-uppercase fs-2"
                                                    style="font-family: 'Times New Roman', Times, serif;">
                                                    <b><?php echo @$sep['json']['urutan']; ?></b>
                                                </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Diagnosa Primer : </label>
                                <br>
                                <label>Dagnosa Sekunder :</label>
                                <br>
                                <label>Tindakan : </label>
                                <br>
                                <label>Special CMG : </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h6>Peserta</h6>
                                    <br>
                                    <br>
                                    <div class="signature-line mt-5"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h6><?= $kop['kota']; ?>,............. <br>Dokter Pemeriksa</h6>
                                    <br>
                                    <br>
                                    <div class="signature-line mt-4"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
            <style>
                @media print {
                    @page {
                        margin: 20px;
                        size: auto;
                    }
                }
            </style>

            <script>
                window.print();
            </script>

        </body>

    </div>
<?php endif; ?>


<!-- ========================================================== -->
<!-- SUrat Rawat Inap -->

<?php if (!empty($surat_perintah['val'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
                <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
                    autocomplete="off">
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
                        <h3 class="text-center">Surat Perintah Rawat Inap</h3>
                    </div>
                    <div class="row">
                        <h5 class="text-start">Informasi Pasien</h5>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Nomor RM</b>
                                    <div id="no_registration" name="no_registration">
                                        <?= @$surat_perintah['visit']['no_registration']; ?>
                                    </div>
                                </td>
                                <td>
                                    <b>Nama Pasien</b>
                                    <div id="thename" name="thename" class="thename">
                                        <?= @$surat_perintah['visit']['diantar_oleh']; ?></div>
                                </td>
                                <td>
                                    <b>Jenis Kelamin</b>
                                    <div name="gender" id="gender">
                                        <?= @$surat_perintah['visit']['name_of_gender']; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Tanggal Lahir (Usia)</b>
                                    <div id="patient_age" name="patient_age">
                                        <?= @$surat_perintah['visit']['date_of_birth']; ?>
                                        (<?= @$surat_perintah['visit']['age']; ?> )</div>
                                </td>
                                <td colspan="2">
                                    <b>Alamat Pasien</b>
                                    <div id="theaddress" name="theaddress" class="theaddress">
                                        <?= @$surat_perintah['visit']['contact_address']; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>DPJP</b>
                                    <div id="fullname" name="fullname"><?= @$surat_perintah['visit']['fullname']; ?></div>
                                </td>
                                <td>
                                    <b>Department</b>
                                    <div id="clinic_id" name="clinic_id"><?= @$surat_perintah['visit']['clinic_id']; ?>
                                    </div>
                                </td>
                                <td>
                                    <b>Tanggal Masuk</b>
                                    <div id="examination_date" name="examination_date">
                                        <?= @$surat_perintah['visit']['visit_date']; ?></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mb-2">
                        <h2 class="text-center"><b><u>SURAT PERINTAH RAWAT INAP</u></b></h2>
                    </div>
                    <div class="row mb-1">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <label for="nama" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$surat_perintah['val']['nama']; ?></span>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="date_of_birth" class="col-sm-2 col-form-label">Tanggal Lahir (Umur)</label>
                        <label for="date_of_birth" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$surat_perintah['val']['date_of_birth']; ?>
                                (<?= @$surat_perintah['val']['umur']; ?>)</span>


                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="jeniskel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <label for="jeniskel" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$surat_perintah['val']['jeniskel']; ?></span>


                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <label for="alamat" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$surat_perintah['val']['alamat']; ?></span>


                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="diagnosis" class="col-sm-2 col-form-label">Indikasi Rawat Inap</label>
                        <label for="diagnosis" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$surat_perintah['val']['diagnosis']; ?></span>


                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis</label>
                        <label for="diagnosis" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$surat_perintah['val']['diagnosis']; ?></span>


                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="bangsal" class="col-sm-2 col-form-label">Mohon rawat inap di</label>
                        <label for="bangsal" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$surat_perintah['val']['bangsal']; ?></span>


                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="intruksi" class="col-sm-2 col-form-label">Instruksi Rawat Inap</label>
                        <label for="intruksi" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <span><?= @$surat_perintah['val']['intruksi']; ?></span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-auto" align="center">
                            <div>IGD / Poliklinik</div>
                            <div>Dokter yang merawat</div>
                            <div class="mb-1">
                                <div id="qrcode-surat_perintah"></div>
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
            var qrcode = new QRCode(document.getElementById("qrcode-surat_perintah"), {
                text: '<?= @$surat_perintah['val']['dpjp']; ?>, <?= @$surat_perintah['val']['nosuratkontrol']; ?>',
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>

<!-- ========================================================== -->


<!-- ========================================================== -->
<!-- Kurang ASesMan Igd -->
<?php if (!empty($getIndikator['indikator'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
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
                    <h3 class="text-center">Assesman IGD</h3>
                </div>
                <div class="row">
                    <h5 class="text-start">Informasi Pasien</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <b>Nomor RM</b>
                                <div id="no_registration" name="no_registration">
                                    <?= @$visit['no_registration']; ?>
                                </div>
                            </td>
                            <td>
                                <b>Nama Pasien</b>
                                <div id="thename" name="thename" class="thename">
                                    <?= @$visit['diantar_oleh']; ?></div>
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
                                <div id="patient_age" name="patient_age">
                                    <?= @$visit['date_of_birth']; ?>
                                    (<?= @$visit['age']; ?> )</div>
                            </td>
                            <td colspan="2">
                                <b>Alamat Pasien</b>
                                <div id="theaddress" name="theaddress" class="theaddress">
                                    <?= @$visit['contact_address']; ?>
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
                                <div id="clinic_id" name="clinic_id"><?= @$visit['clinic_id']; ?>
                                </div>
                            </td>
                            <td>
                                <b>Tanggal Masuk</b>
                                <div id="examination_date" name="examination_date">
                                    <?= @$visit['visit_date']; ?></div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">

                    <tr>
                        <th>PEMERIKSAAN</th>
                        <?php foreach (@$param['aParam'] as $value): ?>
                            <?php if (@$value['p_type'] == @$getIndikator['indikator']['p_type']): ?>
                                <th id="theadAssessment" style="
                <?= $value['parameter_id'] == '01' ? 'color:white;background-color:red;' : '' ?>
                <?= in_array($value['parameter_id'], ['02', '03']) ? 'background-color:yellow;' : '' ?>
                <?= in_array($value['parameter_id'], ['04', '05']) ? 'color:white;background-color:green;' : '' ?>">
                                    <?= $value['parameter_desc'] ?>
                                </th>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>

                    <?php foreach ($param['aValue'] as $value): ?>
                        <?php if ($value['p_type'] == 'GEN0007'): ?>
                            <tr id="tbodyAssessment<?= $value['value_id'] ?>">
                                <th class="align-middle"><?= $value['value_desc'] ?></th>

                                <?php foreach ($param['aParam'] as $value1): ?>
                                    <?php if ($value1['p_type'] == @$getIndikator['indikator']['p_type']): ?>

                                        <td id="tbodyAssessment<?= $value['value_id'] ?><?= $value1['parameter_id'] ?>">
                                            <?php foreach ($param['aValue'] as $value2): ?>
                                                <?php if ($value2['value_info'] == $value['value_id'] && $value2['parameter_id'] == $value1['parameter_id'] && $value2['p_type'] == $value1['p_type']): ?>
                                                    <div class="form-check mb-3">
                                                        <input onclick="return false;" name="val<?= $value2['value_id'] ?>" class="form-check-input"
                                                            type="checkbox"
                                                            id="<?= $value['value_id'] . $value1['parameter_id'] . $value2['value_id'] ?>" <?php
                                                                                                                                            if (isset($getIndikator['detail']) && in_array($value2['value_id'], array_column($getIndikator['detail'], 'value_id'))) {
                                                                                                                                                echo 'checked';
                                                                                                                                            }
                                                                                                                                            ?>>
                                                        <label class="form-check-label"
                                                            for="<?= $value['value_id'] . $value1['parameter_id'] . $value2['value_id'] ?>">
                                                            <?= $value2['value_desc'] ?>
                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </table>

            </div>

    </div>
<?php endif; ?>

<!-- ========================================================== -->
<!-- Resume Pulang -->
<?php if (!empty($resume_medis['val'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
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
                    <h3 class="text-center content-title" id="content-title">Resume Medis</h3>
                </div>
                <div class="row">
                    <h5 class="text-start">Informasi Pasien</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <b>Nomor RM</b>
                                <div id="no_registration" name="no_registration">
                                    <?= @$resume_medis['visit']['no_registration']; ?></div>
                            </td>
                            <td>
                                <b>Nama Pasien</b>
                                <div id="thename" name="thename" class="thename">
                                    <?= @$resume_medis['visit']['diantar_oleh']; ?></div>
                            </td>
                            <td>
                                <b>Jenis Kelamin</b>
                                <div name="gender" id="gender">
                                    <?= @$resume_medis['visit']['name_of_gender']; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Tanggal Lahir (Usia)</b>
                                <div id="patient_age" name="patient_age"><?= @$resume_medis['visit']['date_of_birth']; ?>
                                    (<?= @$resume_medis['visit']['age']; ?> )</div>
                            </td>
                            <td colspan="2">
                                <b>Alamat Pasien</b>
                                <div id="theaddress" name="theaddress" class="theaddress">
                                    <?= @$resume_medis['visit']['contact_address']; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>DPJP</b>
                                <div id="fullname" name="fullname"><?= @$resume_medis['visit']['fullname']; ?></div>
                            </td>
                            <td>
                                <b>Department</b>
                                <div id="clinic_id" name="clinic_id"><?= @$resume_medis['visit']['clinic_id']; ?></div>
                            </td>
                            <td>
                                <b>Tanggal Masuk</b>
                                <div id="examination_date" name="examination_date">
                                    <?= @$resume_medis['visit']['visit_date']; ?></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start">Subjektif (S)</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 33%;">
                                <b>Keluhan Utama (Autoanamnesis)</b>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['anamnesis']; ?></p>
                                <b>Keluhan Utama (Alloanamnesis)</b>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['alloanamnesis']; ?></p>
                            </td>
                            <td style="width: 33%;">
                                <b>Riwayat Penyakit Sekarang</b>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['riwayat_penyakit_sekarang']; ?></p>
                                <b>Riwayat Penyakit Dahulu</b>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['riwayat_penyakit_dahulu']; ?></p>
                            </td>
                            <td>
                                <b>Riwayat Penyakit Keluarga</b>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['riwayat_penyakit_keluarga']; ?></p>
                                <b>Riwayat Obat Yang Dikonsumsi</b>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['riwayat_obat_dikonsumsi']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start">Obyektif (O)</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td colspan="4"><b>Vital Sign</b></td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Tekanan Darah</b>
                                <p class="m-0 mt-1 p-0"><?= @$resume_medis['val']['tensi_atas']; ?> /
                                    <?= @$resume_medis['val']['tensi_bawah']; ?></p>mmHg
                            </td>
                            <td class="p-1">
                                <b>Denyut Nadi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resume_medis['val']['tensi_atas']; ?> /
                                    <?= @$resume_medis['val']['tensi_bawah']; ?></p>m
                            </td>
                            <td class="p-1">
                                <b>Suhu Tubuh</b>
                                <div class="input-group">
                                    <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['suhu']; ?> </p>℃
                                </div>
                            </td>
                            <td class="p-1">
                                <b>Respiration Rate</b>
                                <div class="input-group">
                                    <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['respiration']; ?></p>x/m
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>SpO2</b>
                                <div class="input-group">
                                    <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['spo2']; ?></p>
                                </div>
                            </td>
                            <td class="p-1">
                                <b>Berat Badan</b>
                                <div class="input-group">
                                    <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['berat']; ?></p>kg
                                </div>
                            </td>
                            <td colspan="2">
                                <b><i>GCS / Tingkat Kesadaran</i></b>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['gcs']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <tbody>
                        <?php
                        // check jika data lokalis ada atau tidak
                        if (!empty($resume_medis['lokalis2'])) {
                            // jika ada maka lakukan perulangan untuk menampilkan data
                            foreach ($resume_medis['lokalis2'] as $key => $value) {
                                // jika data lokalis memiliki value score = 2 maka tampilkan
                                if ($value['value_score'] == 2) {
                                    // jika key pada data adalah ganjil
                                    if (($key + 1) % 2 != 0) {
                                        // jika data bukan data terakhir 
                                        if ($key + 1 != count($resume_medis['lokalis2'])) {
                                            echo '<tr>';
                                            echo '<td class="p-1" style="width: 50%;">'
                                                . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                                '</td>';
                                        } else {
                                            echo '<tr>';
                                            echo '<td class="p-1" colspan="2" style="width: 50%;">'
                                                . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                                '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<td class="p-1" style="width: 50%;">'
                                            . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                            '</td>';
                                        echo "<tr>";
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 50%;">
                                <b>Diagnosis Masuk</b>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['pdiagnosa']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Procedure Masuk</b>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['pprocedures']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>Indikasi Rawat Inap</b>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Diagnosis Pulang</b>
                                <textarea type="text" class="form-control" id=""
                                    name=""><?= @$resume_medis['val']['pdiagnosa']; ?></textarea>
                            </td>
                            <td class="p-1">
                                <b>Procedure Pulang</b>
                                <textarea type="text" class="form-control" id=""
                                    name=""><?= @$resume_medis['val']['pprocedures']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Status/Cara Pulang</b>
                                <p class="m-0 mt-0 p-0"></p>
                            </td>
                            <td class="p-1">
                                <b>Kondisi Pulang</b>
                                <p class="m-0 mt-0 p-0"></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start">Penunjang Medis</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Laboratorium</b>
                                <textarea type="text" class="form-control" id="laboratorium"
                                    name="laboratorium"><?= @$resume_medis['val']['laboratorium']; ?></textarea>
                            </td>
                            <td class="p-1">
                                <b>Radiologi</b>
                                <textarea type="text" class="form-control" id="radiologi"
                                    name="radiologi"><?= @$resume_medis['val']['radiologi']; ?></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start">Terapi Obat (Farmakoterapi)</h4>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>
                                <b>Nama Resep</b>
                            </td>
                            <td>
                                <b>Signature</b>
                            </td>
                            <td>
                                <b>Mulai Terapi</b>
                            </td>
                            <td>
                                <b>Selesai Terapi</b>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['farmakologia']; ?></p>
                            </td>
                            <td>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['recipe']['signatura'] ?></p>
                            </td>
                            <td>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['recipe']['tanggal_mulai'] ?></p>
                            </td>
                            <td>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['recipe']['tanggal_selesai'] ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start">Take Home Prescription</h4>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>
                                <b>Nama Resep</b>

                            </td>
                            <td>
                                <b>Signature</b>

                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['val']['farmakologia']; ?></p>
                            </td>
                            <td>
                                <p class="m-0 mt-0 p-0"><?= @$resume_medis['recipe']['signatura'] ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mb-3">
                    <div class="col">
                        <b>Terapi Tindakan (Procedure)</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto" align="center">
                        <div>Tanda Tangan Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode-resume_medis"></div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>Tanda Tangan Pasien/Keluarga</div>
                        <div class="mb-1">
                            <div id="qrcode1-resume_medis"></div>
                        </div>
                    </div>
                </div>
                <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            </div>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode-resume_medis"), {
                text: '<?= @$resume_medis['val']['dpjp']; ?>',
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
        <script>
            var qrcode1 = new QRCode(document.getElementById("qrcode1-resume_medis"), {
                text: '<?= @$resume_medis['val']['nama']; ?>',
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>

<!-- ========================================================== -->
<!-- Persalinan -->
<?php if (!empty($persalinan['neonatus'] || $persalinan['apgarWaktu'] || $persalinan['apgarData'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
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
                    <h3 class="text-center content-title" id="content-title">Persalinan</h3>
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
                <div class="row">
                    <h4>Ikhtisar Persalinan</h4>
                </div>
                <table class="table table-bordered mb-2">
                    <tr>
                        <td>
                            <b>Rupture</b>

                        </td>
                        <td>
                            <b>Waktu</b>

                        </td>
                        <td>
                            <b>Warna</b>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tekanan Darah</b>

                        </td>
                        <td>
                            <b>Nadi</b>

                        </td>
                        <td>
                            <b>Suhu</b>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Freq. Pernapasan</b>

                        </td>
                        <td>
                            <b>Berat Badan</b>

                        </td>
                        <td>
                            <b>Tinggi Badan</b>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tinggi Fundus Uteri</b>

                        </td>
                        <td>
                            <b>Kontraks Uterus</b>

                        </td>
                        <td>
                            <b></b>

                        </td>
                    </tr>
                </table>
                <table class="table table-bordered mb-2">
                    <tr>
                        <td colspan="2">
                            <b>Pendarahan</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kala I</b>

                        </td>
                        <td>
                            <b>Kala II</b>

                        </td>
                        <td>
                            <b>Kala III</b>

                        </td>
                        <td>
                            <b>Kala IV</b>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Placenta</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Lahir</b>

                        </td>
                        <td>
                            <b>Keadaan Lahir</b>

                        </td>
                        <td>
                            <b>Berat</b>

                        </td>
                        <td>
                            <b>Bentuk</b>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tali Pusat</b>

                        </td>
                        <td>
                            <b>Selaput Ketuban</b>

                        </td>
                        <td>
                            <b>Kotiledon</b>

                        </td>
                        <td>
                            <b>Insersio</b>

                        </td>
                    </tr>
                </table>
                <div class="row">
                    <h4>Keadaan Anak Lahir</h4>
                </div>
                <table class="table table-bordered mb-2">
                    <tr>
                        <th colspan="3">Anak Ke-1</th>
                    </tr>
                    <tr>
                        <td>
                            <b>Waktu Lahir</b>

                        </td>
                        <td>
                            <b>Jenis Patrus</b>

                        </td>
                        <td>
                            <b>Indikasi</b>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Lahir</b>

                        </td>
                        <td>
                            <b>Jenis Kelamin</b>

                        </td>
                        <td>
                            <b>BB / PB</b>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Lingkar Kepala</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['lingkar_kepala']) ? '-' : @$persalinan['neonatus']['lingkar_kepala']; ?>
                            </p>
                        </td>
                        <td>
                            <b>Lingkar Dada</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['lingkar_dada']) ? '-' : @$persalinan['neonatus']['lingkar_dada']; ?>
                            </p>
                        </td>
                        <td>
                            <b>SpO2</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['spo2']) ? '-' : @$persalinan['neonatus']['spo2']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tekanan Darah</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['lingkar_kepala']) ? '-' : @$persalinan['neonatus']['lingkar_kepala']; ?>
                            </p>
                        </td>
                        <td>
                            <b>Nadi</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['lingkar_kepala']) ? '-' : @$persalinan['neonatus']['lingkar_kepala']; ?>
                            </p>
                        </td>
                        <td>
                            <b>Suhu</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['lingkar_kepala']) ? '-' : @$persalinan['neonatus']['lingkar_kepala']; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Respiration Rate</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['lingkar_kepala']) ? '-' : @$persalinan['neonatus']['lingkar_kepala']; ?>
                            </p>
                        </td>
                        <td>
                            <b>Kesan Umum</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['keadaan_umum']) ? '-' : @$persalinan['neonatus']['keadaan_umum']; ?>
                            </p>
                        </td>
                        <td>
                            <b>Pergerakan</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['pergerakan']) ? '-' : @$persalinan['neonatus']['pergerakan']; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Warna Kulit</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['warna_kulit']) ? '-' : @$persalinan['neonatus']['warna_kulit']; ?>
                            </p>
                        </td>
                        <td>
                            <b>Turgor</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['turgor']) ? '-' : @$persalinan['neonatus']['turgor']; ?>
                            </p>
                        </td>
                        <td>
                            <b>Tonus</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['tonus']) ? '-' : @$persalinan['neonatus']['tonus']; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Suara</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['suara']) ? '-' : @$persalinan['neonatus']['suara']; ?>
                            </p>
                        </td>
                        <td>
                            <b>Reflek Moro</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['reflek_moro']) ? '-' : @$persalinan['neonatus']['reflek_moro']; ?>
                            </p>
                        </td>
                        <td>
                            <b>Reflek Menghisap</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['reflek_menghisap']) ? '-' : @$persalinan['neonatus']['reflek_menghisap']; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Memegang</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['memegang']) ? '-' : @$persalinan['neonatus']['memegang']; ?>
                            </p>
                        </td>
                        <td>
                            <b>Tonus Leher</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['tonus_leher']) ? '-' : @$persalinan['neonatus']['tonus_leher']; ?>
                            </p>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Resusitasi</b>
                            <p class="m-0 mt-1 p-0">
                                <?= empty(@$persalinan['neonatus']['resusitasi']) ? '-' : @$persalinan['neonatus']['resusitasi']; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kelainan Kongenital</b>

                        </td>
                        <td>
                            <b>Sebab bayi lahir mati/lahir lalu meninggal</b>

                        </td>
                    </tr>
                </table>

                <div class="row">
                    <h5 class="text-start">Apgar Score</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" width="25%"></td>
                            <?php foreach (@$persalinan['apgarWaktu'] as $key => $waktu) : ?>
                                <th class="p-1" width="25%"><?= $waktu['p_description'] ?></th>
                            <?php endforeach ?>
                        </tr>
                        <?php $totalSkor = 0; ?>
                        <?php foreach (@$persalinan['apgarData'] as $key => $row) : ?>
                            <tr>
                                <th class="p-1" width="25%"><?= $row['parameter_desc'] ?></th>
                                <td class="p-1" width="25%"><?= '(' . $row['value_score_1'] . ') ' . $row['menit_1'] ?></td>
                                <td class="p-1" width="25%"><?= '(' . $row['value_score_5'] . ') ' . $row['menit_5'] ?></td>
                                <td class="p-1" width="25%"><?= '(' . $row['value_score_10'] . ') ' . $row['menit_10'] ?></td>
                            </tr>
                            <?php $totalSkor += $row['value_score_1'] + $row['value_score_5'] + $row['value_score_10']; ?>
                        <?php endforeach ?>
                        <tr>
                            <th class="p-1" width="25%">Total Skor</th>
                            <th class="p-1 text-center" width="75%" colspan="3"><?= $totalSkor ?></th>
                        </tr>
                    </tbody>
                </table>


                <div class="row">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode-persalinan"></div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>Bidan</div>
                        <div class="mb-1">
                            <div id="qrcode1-persalinan"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode-persalinan"), {
                text: 'sa',
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode1-persalinan"), {
                text: 'sa',
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>

<!-- ========================================================== -->
<!-- Kurang Operasi -->
<!-- Pra Operasi -->
<?php if (!empty($praopra['informasiMedis'] || $praopra['lokalis'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-center"><?= $praopra['title']; ?></h4>
                </div>
                <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$praopra['visit']['no_registration']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$praopra['visit']['diantar_oleh']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0"><?= @$praopra['visit']['gendername']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= tanggal_indo($praopra['visit']['date_of_birth']) . ' (' . @$praopra['visit']['age'] . ')'; ?>
                                </p>

                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$praopra['visit']['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$praopra['visit']['fullname_inap']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Department</b>
                                <p class="m-0 mt-1 p-0"><?= @$praopra['visit']['name_of_clinic_from']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= @$praopra['visit']['in_date'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kelas</b>
                                <p class="m-0 mt-1 p-0"><?= @$praopra['visit']['class_room']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bangsal/Kamar</b>
                                <p class="m-0 mt-1 p-0"><?= @$praopra['visit']['name_of_clinic']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bed</b>
                                <p class="m-0 mt-1 p-0"><?= @$praopra['visit']['bed']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h5>Checklist Persiapan Operasi</h5>

                <?php if (isset($praopra['informasiMedis'])) : ?>
                    <div class="d-flex flex-wrap mb-3">
                        <?php foreach (@$praopra['informasiMedis'] as $key => $medis) : ?>
                            <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                                <b><?= $key ?></b>
                                <p class="m-0 mt-1 p-0"><?= @$medis == 1 ? '&#x1F5F9;' : @$medis; ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($praopra['lokalis'])) : ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="fw-bold">
                                <td>Gambar Laki-laki</td>
                                <td>Gambar Perempuan</td>
                            </tr>
                            <?php foreach (@$praopra['lokalis'] as $key => $value) : ?>
                                <?php if (($key + 1) % 2 != 0) : ?>
                                    <?php if ($key + 1 != count($praopra['lokalis'])) : ?>
                                        <tr>
                                            <td style="width: 50%;">
                                                <img class="mt-3" src="<?= base_url('assets/img/asesmen/' . $value['value_info']) ?>"
                                                    width="300px">
                                            </td>
                                        <?php else : ?>
                                        <tr>
                                            <td>
                                                <img class="mt-3" src="<?= base_url('assets/img/asesmen/' . $value['value_info']) ?>"
                                                    width="300px">
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <td>
                                        <img class="mt-3" src="<?= base_url('assets/img/asesmen/' . $value['value_info']) ?>"
                                            width="300px">
                                    </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>


                <div class="row">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode-praopra"></div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>pasien</div>
                        <div class="mb-1">
                            <div id="qrcode1-praopra"></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>

        <script>
            var qrcode = new QRCode(document.getElementById("qrcode-praopra"), {
                text: `<?= @$praopra['visit']['fullname']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode1-praopra"), {
                text: `<?= @$praopra['visit']['diantar_oleh']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>

<!-- Pri Operasi -->
<?php if (!empty($priopra['val'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>

                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-center"><?= $priopra['title']; ?></h4>
                </div>
                <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
                <h5>Informasi Medis</h5>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['visit']['no_registration']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['visit']['diantar_oleh']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['visit']['gendername']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= date("d M Y", strtotime(@$priopra['visit']['date_of_birth'])) . ' (' . (!empty($priopra['visit']['age']) ? @$priopra['visit']['age'] : 'N/A') . ')'; ?>
                                </p>


                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['visit']['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['visit']['fullname_inap']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Department</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['visit']['name_of_clinic_from']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['visit']['in_date'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kelas</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['visit']['class_room']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bangsal/Kamar</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['visit']['name_of_clinic']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bed</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['visit']['bed']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h4>A. Catatan Keperawatan Pra Operasi</h4>
                <table class="table table-bordered mb-2">
                    <tbody>
                        <tr>
                            <td width="25%">
                                <b>Tekanan Darah</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= @$priopra['val']['tensi_atas'] . '/' . @$priopra['val']['tensi_bawah']; ?> mmHg</p>
                            </td>
                            <td width="25%">
                                <b>Denyut Nadi</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['val']['nadi']; ?> x/m</p>
                            </td>
                            <td width="25%">
                                <b>Suhu Tubuh</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['val']['suhu']; ?> &degC</p>
                            </td>
                            <td width="25%">
                                <b>Respiration Rate</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['val']['respirasi']; ?> x/m</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">
                                <b>Berat Badan</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['val']['bb']; ?> kg</p>
                            </td>
                            <td width="25%">
                                <b>Tinggi Badan</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['val']['tb']; ?> cm</p>
                            </td>
                            <td width="25%">
                                <b>SpO2</b>
                                <p class="m-0 mt-1 p-0"><?= @$priopra['val']['saturasi']; ?></p>
                            </td>
                            <td width="25%">
                                <b>BMI</b>
                                <p class="m-0 mt-1 p-0"><?= number_format(@$priopra['val']['bmi'], 2, '.', ''); ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex flex-wrap mb-3">
                    <b>Diagnosa Keperawatan Pre OP</b>
                    <?php if (isset($priopra['diagnosas'])) : ?>
                        <?php foreach (@$priopra['diagnosas'] as $key => $diagnosa) : ?>
                            <div class="col-12 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                                <p class="m-0 mt-1 p-0"><?= @$diagnosa['diag_notes']; ?></p>
                            </div>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>

                <h4>B. Catatan Keperawatan Intra Operatif</h4>
                <div class="d-flex flex-wrap mb-3">
                    <?php if (isset($priopra['informasiIntra'])) : ?>
                        <?php foreach (@$priopra['informasiIntra'] as $key => $intra) : ?>
                            <div class="col-6 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                                <b><?= $key ?></b>
                                <p class="m-0 mt-1 p-0"><?= @$intra; ?></p>
                            </div>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>

                <b>Pemakaian Drain</b>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="25%">Tipe Drain</th>
                            <th width="25%">Jenis Drain</th>
                            <th width="25%">Ukuran</th>
                            <th width="25%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($priopra['drains'])) : ?>
                            <?php foreach (@$priopra['drains'] as $key => $drain) : ?>
                                <tr>
                                    <td width="25%"><?= $drain['drain_type']; ?></td>
                                    <td width="25%"><?= $drain['drain_kinds']; ?></td>
                                    <td width="25%"><?= $drain['size']; ?></td>
                                    <td width="25%"><?= $drain['description']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <br>
                <b>Hitung Instrumen/Kassa/Jarum</b>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="25%">Hitung</th>
                            <th width="25%">Kassa</th>
                            <th width="25%">Jarum</th>
                            <th width="25%">Instrumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($priopra['instrument'])) : ?>

                            <?php foreach (@$priopra['instrument'] as $instrumen) : ?>
                                <tr>
                                    <?php foreach ($instrumen as $cell) : ?>
                                        <td><?= @$cell; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="col-12 p-1 border-collide mb-3" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Catatan</b>
                    <p>Jika dihitung tidak Sesuai -> X-ray: <?= @$priopra['val']['xray'] == 1 ? 'Ya' : 'Tidak'; ?></p>
                </div>
                <div class="d-flex flex-wrap mb-3">
                    <?php if (isset($priopra['informasiIntra2'])) : ?>
                        <?php foreach (@$priopra['informasiIntra2'] as $key => $intra2) : ?>
                            <div class="col-6 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                                <b><?= $key ?></b>
                                <p class="m-0 mt-1 p-0"><?= @$intra2; ?></p>
                            </div>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>

                <h4>C. Catatan Keperawatan Pasca Operasi</h4>
                <div class="d-flex flex-wrap mb-3">
                    <?php if (isset($priopra['informasiPasca'])) : ?>
                        <?php foreach (@$priopra['informasiPasca'] as $key => $pasca) : ?>
                            <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                                <b><?= $key ?></b>
                                <p class="m-0 mt-1 p-0"><?= @$pasca ?? '-'; ?></p>
                            </div>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>
                <?php if (isset($priopra['aldrete'])) : ?>
                    <?php foreach (@$priopra['aldrete'] as $dataAldrete) : ?>
                        <div class="d-flex flex-wrap mb-3" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <div class="col-12 p-1 border-collide">
                                <b>Tanggal Observasi :
                                    <?= tanggal_indo(date_format(date_create(@$dataAldrete['observation_date']), 'Y-m-d')) . ' ' . date_format(date_create(@$dataAldrete['observation_date']), 'H:i') . ' WIB'; ?></b><br>
                                <b>Skor Aldrete</b>
                                <ul>
                                    <li>Aktivitas : <?= @$dataAldrete['value_desc_01']; ?></li>
                                    <li>Pernapasan : <?= @$dataAldrete['value_desc_02']; ?></li>
                                    <li>Circulation : <?= @$dataAldrete['value_desc_03']; ?></li>
                                    <li>Kesadaran : <?= @$dataAldrete['value_desc_04']; ?></li>
                                    <li>Saturasi O2 : <?= @$dataAldrete['value_desc_05']; ?></li>
                                </ul>
                                <b>Skor :
                                    <?= @$dataAldrete['value_score_01'] + @$dataAldrete['value_score_02'] + @$dataAldrete['value_score_03'] + @$dataAldrete['value_score_04'] + @$dataAldrete['value_score_05']; ?></b>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (isset($priopra['aldrete'])) : ?>
                    <?php foreach (@$priopra['bromage'] as $dataBromage) : ?>
                        <div class="d-flex flex-wrap mb-3" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <div class="col-12 border-collide">
                                <div class="p-1 border-collide">
                                    <b>Tanggal Observasi :
                                        <?= tanggal_indo(date_format(date_create(@$dataBromage['observation_date']), 'Y-m-d')) . ' ' . date_format(date_create(@$dataBromage['observation_date']), 'H:i') . ' WIB'; ?></b><br>
                                    <b>Skor Bromage</b>
                                    <p><?= @$dataBromage['value_desc']; ?></p>
                                    <b>Skor : <?= @$dataBromage['value_score']; ?></b>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (isset($priopra['steward'])) : ?>
                    <?php foreach (@$priopra['steward'] as $dataSteward) : ?>
                        <div class="d-flex flex-wrap mb-3" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <div class="col-12 border-collide">
                                <div class="p-1 border-collide">
                                    <b>Tanggal Observasi :
                                        <?= tanggal_indo(date_format(date_create(@$dataSteward['observation_date']), 'Y-m-d')) . ' ' . date_format(date_create(@$dataSteward['observation_date']), 'H:i') . ' WIB'; ?></b><br>
                                    <b>Skor Steward</b>
                                    <ul>
                                        <li>Kesadaran : <?= @$dataSteward['value_desc_01']; ?></li>
                                        <li>Jalan Nafas : <?= @$dataSteward['value_desc_02']; ?></li>
                                        <li>Gerakan : <?= @$dataSteward['value_desc_03']; ?></li>
                                    </ul>
                                    <b>Skor :
                                        <?= @$dataSteward['value_score_01'] + @$dataSteward['value_score_02'] + @$dataSteward['value_score_03']; ?></b>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="row">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode-priopras"></div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>Pasien</div>
                        <div class="mb-1">
                            <div id="qrcode1-priopras"></div>
                        </div>
                    </div>
                </div>

            </div>
            <br>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>

        <script>
            var qrcode = new QRCode(document.getElementById("qrcode-priopras"), {
                text: `<?= @$checklistKel['visit']['fullname']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode1-priopras"), {
                text: `<?= @$checklistKel['visit']['diantar_oleh']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>

<!-- Asesmen Pra Operasi -->
<?php if (!empty($checklistKel['theSignIn'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>

                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-center"><?= $checklistKel['title']; ?></h4>
                </div>
                <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistKel['visit']['no_registration']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistKel['visit']['diantar_oleh']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistKel['visit']['gendername']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= date("d M Y", strtotime($checklistKel['visit']['date_of_birth'])) . ' (' . (!empty($checklistKel['visit']['age']) ? $checklistKel['visit']['age'] : 'N/A') . ')'; ?>
                                </p>


                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistKel['visit']['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistKel['visit']['fullname_inap']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Department</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistKel['visit']['name_of_clinic_from']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistKel['visit']['in_date'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kelas</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistKel['visit']['class_room']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bangsal/Kamar</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistKel['visit']['name_of_clinic']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bed</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistKel['visit']['bed']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <h5>The Sign In</h5>
                <div class="d-flex flex-wrap mb-3">
                    <?php foreach (@$checklistKel['theSignIn'] as $key => $signIn) : ?>
                        <div class="col-10 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <b><?= $key ?></b>

                        </div>
                        <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <?php if ($signIn == "1") : ?>
                                <p class="m-0 mt-1 p-0 text-center"><?= isset($signIn) && !empty($signIn) ? '&#10003;' : '-'; ?></p>
                            <?php else : ?>
                                <p class="m-0 mt-1 p-0 text-center"><?= $signIn ?? '-' ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach ?>
                </div>

                <h5>The Time Out</h5>
                <div class="d-flex flex-wrap mb-3">
                    <?php foreach (@$checklistKel['theTimeOut'] as $key => $timeOut) : ?>
                        <div class="col-10 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <b><?= $key ?></b>

                        </div>
                        <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <?php if ($timeOut == "1") : ?>
                                <p class="m-0 mt-1 p-0 text-center"><?= isset($timeOut) && !empty($timeOut) ? '&#10003;' : '-'; ?>
                                </p>
                            <?php else : ?>
                                <p class="m-0 mt-1 p-0 text-center"><?= $timeOut ?? '-' ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach ?>
                </div>
                <b>Table Jumlah Instrumen</b>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center align-middle" width="1%">No</th>
                            <th class="text-center align-middle">Jenis</th>
                            <th class="text-center align-middle">Jumlah Sebelum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (@$checklistKel['instruments'] as $key => $instrumen) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $instrumen['brand_name']; ?></td>
                                <td><?= $instrumen['quantity_before']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h5>The Sign Out</h5>
                <div class="d-flex flex-wrap mb-3">
                    <?php foreach (@$checklistKel['theSignOut'] as $key => $signOut) : ?>
                        <div class="col-10 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <b><?= $key ?></b>

                        </div>
                        <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <?php if ($signOut == "1") : ?>
                                <p class="m-0 mt-1 p-0 text-center"><?= isset($signOut) && !empty($signOut) ? '&#10003;' : '-'; ?>
                                </p>
                            <?php else : ?>
                                <p class="m-0 mt-1 p-0 text-center"><?= $signOut ?? '-' ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach ?>
                </div>
                <b>Table Instrumen</b>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center align-middle" width="1%">No</th>
                            <th class="text-center align-middle">Jenis</th>
                            <th class="text-center align-middle">Jumlah Sebelum</th>
                            <th class="text-center align-middle">Jumlah Intra</th>
                            <th class="text-center align-middle">Jumlah Tambahan</th>
                            <th class="text-center align-middle">Jumlah Pasca</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (@$checklistKel['instruments'] as $key => $instrumen) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $instrumen['brand_name']; ?></td>
                                <td><?= $instrumen['quantity_before']; ?></td>
                                <td><?= $instrumen['quantity_intra']; ?></td>
                                <td><?= $instrumen['quantity_additional']; ?></td>
                                <td><?= $instrumen['quantity_after']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex flex-wrap mb-3">
                    <?php foreach (@$checklistKel['theSignOut2'] as $key => $signOut2) : ?>
                        <div class="col-10 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <b><?= $key ?></b>

                        </div>
                        <div class="col-2 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <?php if ($signOut2 == "1") : ?>
                                <p class="m-0 mt-1 p-0 text-center"><?= isset($signOut2) && !empty($signOut2) ? '&#10003;' : '-'; ?>
                                </p>
                            <?php else : ?>
                                <p class="m-0 mt-1 p-0 text-center"><?= $signOut2 ?? '-' ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class=" row">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode-checklistKel"></div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>Pasien</div>
                        <div class="mb-1">
                            <div id="qrcode1-checklistKel"></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>

        <script>
            var qrcode = new QRCode(document.getElementById("qrcode-checklistKel"), {
                text: `<?= $checklistKel['visit']['fullname']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode1-checklistKel"), {
                text: `<?= $checklistKel['visit']['diantar_oleh']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>

<!-- Checklist Anestesi -->
<?php if (!empty($checklistAnes['informasiTindakan'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>

                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-center"><?= $checklistAnes['title']; ?></h4>
                </div>
                <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['visit']['no_registration']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['visit']['diantar_oleh']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['visit']['gendername']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= date("d M Y", strtotime(@$checklistAnes['visit']['date_of_birth'])) . ' (' . (!empty($checklistAnes['visit']['age']) ? @$checklistAnes['visit']['age'] : 'N/A') . ')'; ?>
                                </p>


                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['visit']['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['visit']['fullname_inap']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Department</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['visit']['name_of_clinic_from']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['visit']['in_date'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kelas</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['visit']['class_room']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bangsal/Kamar</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['visit']['name_of_clinic']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bed</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['visit']['bed']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h5>Informasi Medis</h5>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Ruang Tindakan</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['operasi']['rooms_id']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Tindakan</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= date("d M Y", strtotime(@$checklistAnes['operasi']['start_operation']))  ?></p>
                            </td>

                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Tindakan</b>
                                <p class="m-0 mt-1 p-0">
                                    <?php
                                    $tarifId = @$checklistAnes['operasi']['tarif_id'];
                                    $tarifName = '-';
                                    foreach (@$checklistAnes['treatment'] as $item) {
                                        if ($item['tarif_id'] === $tarifId) {
                                            $tarifName = $item['tarif_name'];
                                            break;
                                        }
                                    }
                                    echo $tarifName;
                                    ?>
                                </p>
                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Jenis Anestesi</b>
                                <p class="m-0 mt-1 p-0"><?= @$checklistAnes['operasi']['type_of_anesthesia']; ?></p>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <h5>Informasi Tindakan</h5>
                <div class="d-flex flex-wrap mb-3">
                    <?php foreach (@$checklistAnes['informasiTindakan'] as $key => $tindakan) : ?>
                        <div class="col-6 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <b><?= $key ?></b>
                            <p class="m-0 mt-1 p-0"><?= isset($tindakan) && !empty(@$tindakan) ? '✔️' : '-'; ?></p>

                        </div>
                    <?php endforeach ?>
                </div>

                <div class="row">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode-checklistAnes"></div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>Pasien</div>
                        <div class="mb-1">
                            <div id="qrcode1-checklistAnes"></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>

        <script>
            var qrcode = new QRCode(document.getElementById("qrcode-checklistAnes"), {
                text: `<?= $checklistAnes['visit']['fullname']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode1-checklistAnes"), {
                text: `<?= $checklistAnes['visit']['diantar_oleh']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>

<!-- Laporan Pembedahan -->
<?php if (!empty($lapbedah['operation_team'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>

                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-center"><?= @$lapbedah['title']; ?></h4>
                </div>
                <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$lapbedah['visit']['no_registration']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$lapbedah['visit']['diantar_oleh']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0"><?= @$lapbedah['visit']['gendername']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= date("d M Y", strtotime(@$lapbedah['visit']['date_of_birth'])) . ' (' . (!empty(@$lapbedah['visit']['age']) ? @$lapbedah['visit']['age'] : 'N/A') . ')'; ?>
                                </p>


                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$lapbedah['visit']['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$lapbedah['visit']['fullname_inap']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Department</b>
                                <p class="m-0 mt-1 p-0"><?= @$lapbedah['visit']['name_of_clinic_from']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= @$lapbedah['visit']['in_date'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kelas</b>
                                <p class="m-0 mt-1 p-0"><?= @$lapbedah['visit']['class_room']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bangsal/Kamar</b>
                                <p class="m-0 mt-1 p-0"><?= @$lapbedah['visit']['name_of_clinic']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bed</b>
                                <p class="m-0 mt-1 p-0"><?= @$lapbedah['visit']['bed']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (isset($lapbedah['operation_team'])) : ?>
                    <div class="d-flex flex-wrap mb-3">
                        <?php foreach (@$lapbedah['operation_team'] as $key => $team) : ?>
                            <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                                <b><?= $team['task'] ?></b>
                                <p class="m-0 mt-1 p-0"><?= @$team['doctor']; ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($lapbedah['diagnosas'])) : ?>
                    <div class="d-flex flex-wrap mb-3">
                        <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <ul><b>Diagnosa Pra Operasi</b>
                                <?php
                                $diagnosa_pra = array_filter(@$lapbedah['diagnosas'], function ($item) {
                                    return $item['diag_cat'] === 13;
                                });
                                foreach ($diagnosa_pra as $key => $diag_pra) :
                                ?>
                                    <li class="m-0 mt-1 p-0"><?= $diag_pra['diagnosa_name'] . ', ' . @$diag_pra['suffer']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <b>Waktu Mulai</b>
                            <p class="m-0 mt-1 p-0">
                                <?= date_format(date_create(@$lapbedah['val']['start_operation']), 'd-m-Y H:i'); ?></p>
                            <b>Waktu Selesai</b>
                            <p class="m-0 mt-1 p-0">
                                <?= date_format(date_create(@$lapbedah['val']['end_operation']), 'd-m-Y H:i'); ?></p>
                            <b>Ada Penundaan?</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['terlayani'] == 0 ? 'Tidak' : 'Ada'; ?></p>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap mb-3">
                        <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <ul><b>Diagnosa Pasca Operasi</b>
                                <?php
                                $diagnosa_pasca = array_filter(@$lapbedah['diagnosas'], function ($item) {
                                    return in_array($item['diag_cat'], [14, 15]);
                                });
                                foreach ($diagnosa_pasca as $key => $diag_pasca) :
                                ?>
                                    <li class="m-0 mt-1 p-0"><?= $diag_pasca['diagnosa_name'] . ', ' . @$diag_pasca['suffer']; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                            <b>Sifat Operasi</b>
                            <p class="m-0 mt-1 p-0">Efektif</p>
                        </div>
                    </div>
                <?php endif; ?>

                <table class="table table-bordered">
                    <tr>
                        <td width="33.3%">
                            <b>Prosedur Pembedahan</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['tarif_name']; ?></p>
                        </td>
                        <td width="33.3%">
                            <b>Tipe Operasi</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['tipe_operasi']; ?></p>
                        </td>
                        <td width="33.3%">
                            <b>Operasi Ke</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['re_operation'] == 'OP080801' ? '1' : 're-do';  ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td width="33.3%">
                            <b>Profilaksis</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['profilaksis'] == 'OP080901' ? 'Ya' : 'Tidak'; ?>
                            </p>
                        </td>
                        <td width="33.3%">
                            <b>Jenis Antibiotik</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['antibiotic_desc']; ?></p>
                        </td>
                        <td width="33.3%">
                            <b>Waktu Pemberian</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['antibiotic_time']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Uraian Pembedahan</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['operation_desc']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Komplikasi</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['komplikasi']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Nomor Implant</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['implant']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" width="66.6%">
                            <b>Konsultasi Intra-Operatif</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['konsultasi']; ?></p>
                        </td>
                        <td>
                            <b>Jumlah Pendarahan</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['bleeding']; ?> CC</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Jaringan Ke Patologi</b>
                            <p class="m-0 mt-1 p-0"><?= @$lapbedah['val']['patologi_desc']; ?></p>
                        </td>
                    </tr>
                </table>


                <div class="row">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode-lapbedah"></div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>Pasien</div>
                        <div class="mb-1">
                            <div id="qrcode1-lapbedah"></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>

        <script>
            var qrcode = new QRCode(document.getElementById("qrcode-lapbedah"), {
                text: `<?= $lapbedah['visit']['fullname']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode1-lapbedah"), {
                text: `<?= $lapbedah['visit']['diantar_oleh']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>

<!-- Asesmen Post Operasi -->
<?php if (!empty($postoprs['informasiMedis'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-center"><?= $postoprs['title']; ?></h4>
                </div>
                <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$postoprs['visit']['no_registration']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$postoprs['visit']['diantar_oleh']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0"><?= @$postoprs['visit']['gendername']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= tanggal_indo($postoprs['visit']['date_of_birth']) . ' (' . @$postoprs['visit']['age'] . ')'; ?>
                                </p>

                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$postoprs['visit']['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$postoprs['visit']['fullname_inap']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Department</b>
                                <p class="m-0 mt-1 p-0"><?= @$postoprs['visit']['name_of_clinic_from']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= @$postoprs['visit']['in_date'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kelas</b>
                                <p class="m-0 mt-1 p-0"><?= @$postoprs['visit']['class_room']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bangsal/Kamar</b>
                                <p class="m-0 mt-1 p-0"><?= @$postoprs['visit']['name_of_clinic']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bed</b>
                                <p class="m-0 mt-1 p-0"><?= @$postoprs['visit']['bed']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h5>Informasi Medis</h5>
                <?php if (isset($postoprs['informasiMedis'])) : ?>
                    <div class="d-flex flex-wrap mb-3">
                        <?php foreach (@$postoprs['informasiMedis'] as $key => $medis) : ?>
                            <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                                <b><?= $key ?></b>
                                <p class="m-0 mt-1 p-0"><?= @$medis; ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode-postoprs"></div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>pasien</div>
                        <div class="mb-1">
                            <div id="qrcode1-postoprs"></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>

        <script>
            var qrcode = new QRCode(document.getElementById("qrcode-postoprs"), {
                text: `<?= $postoprs['visit']['fullname']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode1-postoprs"), {
                text: `<?= $postoprs['visit']['diantar_oleh']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>


<!-- ========================================================== -->
<!-- Anestesi -->
<?php if (!empty($anestesi['val'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                    </div>
                    <div class="col text-center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto text-center">
                        <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-center"><?= $anestesi['title']; ?></h4>
                </div>
                <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['visit']['no_registration']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['visit']['diantar_oleh']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['visit']['gendername']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= date("d M Y", strtotime(@$anestesi['visit']['date_of_birth'])) . ' (' . (!empty($anestesi['visit']['age']) ? @$anestesi['visit']['age'] : 'N/A') . ')'; ?>
                                </p>

                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['visit']['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['visit']['fullname_inap']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Department</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['visit']['name_of_clinic_from']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['visit']['in_date'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kelas</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['visit']['class_room']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bangsal/Kamar</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['visit']['name_of_clinic']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bed</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['visit']['bed']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h5>Informasi Medis</h5>
                <?php if (is_array(@$anestesi['informasiMedis']) && !empty(@$anestesi['informasiMedis'])) : ?>
                    <div class="d-flex flex-wrap mb-3">
                        <?php foreach (@$anestesi['informasiMedis'] as $key => $medis) : ?>
                            <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing: border-box;">
                                <b><?= htmlspecialchars($key) ?></b>
                                <p class="m-0 mt-1 p-0"><?= htmlspecialchars($medis); ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>

                <h5>Pemeriksaan Fisik</h5>
                <table class="table table-bordered mb-2">
                    <tbody>
                        <tr>
                            <td>
                                <b>Tekanan Darah</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= @$anestesi['val']['tensi_atas'] . '/' . @$anestesi['val']['tensi_bawah']; ?> mmHg
                                </p>
                            </td>
                            <td>
                                <b>Denyut Nadi</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['val']['nadi']; ?> x/m</p>
                            </td>
                            <td>
                                <b>Suhu Tubuh</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['val']['suhu']; ?> &degC</p>
                            </td>
                            <td>
                                <b>Respiration Rate</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['val']['respirasi']; ?> x/m</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Berat Badan</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['val']['bb']; ?> kg</p>
                            </td>
                            <td>
                                <b>Tinggi Badan</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['val']['tb']; ?> cm</p>
                            </td>
                            <td>
                                <b>SpO2</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['val']['saturasi']; ?></p>
                            </td>
                            <td>
                                <b>BMI</b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi['val']['bmi']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <tbody>
                        <?php
                        // check jika data lokalis ada atau tidak
                        if (!empty($anestesi['lokalis'])) {
                            // jika ada maka lakukan perulangan untuk menampilkan data
                            foreach (@$anestesi['lokalis'] as $key => $value) {
                                // jika data lokalis memiliki value score = 2 maka tampilkan
                                if ($value['value_score'] == 2) {
                                    // jika key pada data adalah ganjil
                                    if (($key + 1) % 2 != 0) {
                                        // jika data bukan data terakhir 
                                        if ($key + 1 != count($lokalis)) {
                                            echo '<tr>';
                                            echo '<td class="p-1" style="width: 50%;">'
                                                . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_desc'] . '</p>' .
                                                '</td>';
                                        } else {
                                            echo '<tr>';
                                            echo '<td class="p-1" colspan="2" style="width: 50%;">'
                                                . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_desc'] . '</p>' .
                                                '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<td class="p-1" style="width: 50%;">'
                                            . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_desc'] . '</p>' .
                                            '</td>';
                                        echo "<tr>";
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <h5>Keadaan Umum</h5>
                <?php if (is_array(@$anestesi['keadaanUmum']) && !empty(@$anestesi['keadaanUmum'])) : ?>
                    <div class="d-flex flex-wrap mb-3">
                        <?php foreach (@$anestesi['keadaanUmum'] as $key => $keadaan) : ?>
                            <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                                <b><?= htmlspecialchars($key) ?></b>
                                <p class="m-0 mt-1 p-0"><?= htmlspecialchars($keadaan); ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>

                <h5>Perencanaan Anestesi</h5>
                <?php if (is_array(@$anestesi['perencanaanAnestesi']) && !empty(@$anestesi['perencanaanAnestesi'])) : ?>
                    <div class="d-flex flex-wrap mb-3">
                        <?php foreach (@$anestesi['perencanaanAnestesi'] as $key => $anestesi) : ?>
                            <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                                <b><?= $key ?></b>
                                <p class="m-0 mt-1 p-0"><?= @$anestesi; ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>


                <div class="row">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode-anestesi"></div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>Bidan</div>
                        <div class="mb-1">
                            <div id="qrcode1-anestesi"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>

        <script>
            var qrcode = new QRCode(document.getElementById("qrcode-anestesi"), {
                text: 'sa',
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode1-anestesi"), {
                text: 'sa',
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>

<!-- ========================================================== -->
<!-- Penunjang -->
<?php if (!empty($penunjang_medis['bound'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3><?= $kop['name_of_org_unit']; ?></h3>
                        <p><?= $kop['contact_address']; ?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url('assets/img/kemenkes.png') ?>" width="70px">
                        <img class="mt-2" src="<?= base_url('assets/img/kars-bintang.png') ?>" width="70px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <h3 class="text-center mb-0 my-1">HASIL PEMERIKSAAN</h3>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <table class="table table-borderless mb-0">
                    <tr>
                        <td width="20%">Nama</td>
                        <td width="1%">:</td>
                        <td colspan="2"><?= $visit['diantar_oleh']; ?></td>
                        <td width="20%">No.RM</td>
                        <td width="1%">:</td>
                        <td><?= $visit['no_registration']; ?></td>
                    </tr>
                    <tr>
                        <td width="20%">Umur</td>
                        <td width="1%">:</td>
                        <td><?= $visit['age']; ?></td>
                        <td>LP: <?= $visit['gendername']; ?></td>
                        <td width="20%">Tanggal</td>
                        <td width="1%">:</td>
                        <td><?= date('d-m-Y') ?></td>
                    </tr>
                    <tr>
                        <td width="20%">Alamat</td>
                        <td width="1%">:</td>
                        <td colspan="2"><?= $visit['contact_address']; ?></td>
                        <td width="20%">Dokter</td>
                        <td width="1%">:</td>
                        <td></td>
                    </tr>
                </table>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;" class="mb-2">
                </div>
                <div id="ContainerbodyBoundPrint" class="row">

                </div>
            </div>
            <br>
            <div class="row justify-content-end px-3">
                <div class="col-auto" align="center">
                    <div>Dokter</div>
                    <div class="mb-1">
                        <div id="qrcodeHasil"></div>
                    </div>
                </div>
            </div>
            <br>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>
        <script>
            $(document).ready(function(e) {
                let items = <?= json_encode(@$penunjang_medis['bound']); ?>;
                let data = <?= json_encode(@$penunjang_medis['val']); ?>;

                const FilterBound = [{
                        name: "CHECK UP",
                        value: 1
                    },
                    {
                        name: "HIPERTENSI",
                        value: 1
                    },
                    {
                        name: "ARRHYTMIA",
                        value: 1
                    },
                    {
                        name: "CHEST PAIN",
                        value: 1
                    },
                    {
                        name: "PULMONARY DISEASE",
                        value: 1
                    },
                    {
                        name: "OBESITAS",
                        value: 1
                    },
                    {
                        name: "Keluhan/ gejala lain",
                        value: 3
                    },
                    {
                        name: "Sinus Rhytme",
                        value: 1
                    },
                    {
                        name: "Sinus Tachycardia",
                        value: 1
                    },
                    {
                        name: "Sinus Bpenunjangmedisycardia",
                        value: 1
                    },
                    {
                        name: "Sinus Arrhytmia",
                        value: 1
                    },
                    {
                        name: "Low Voltage",
                        value: 1
                    },
                    {
                        name: "AF / AFF",
                        value: 1
                    },
                    {
                        name: "SVT (PAT)",
                        value: 1
                    },
                    {
                        name: "VT / VF",
                        value: 1
                    },
                    {
                        name: "RBBB complete / incomplete",
                        value: 1
                    },
                    {
                        name: "LBBB complete / incomplete",
                        value: 1
                    },
                    {
                        name: "\"LVH",
                        value: 1
                    },
                    {
                        name: "\"RVH",
                        value: 1
                    },
                    {
                        name: "\"LAH",
                        value: 1
                    },
                    {
                        name: "RAH",
                        value: 1
                    },
                    {
                        name: "First / second/ third degree",
                        value: 1
                    },
                    {
                        name: "QRS Rate",
                        value: 2
                    },
                    {
                        name: "P-P Rate",
                        value: 2
                    },
                    {
                        name: "QRS Axis",
                        value: 2
                    },
                    {
                        name: "P-R Interval",
                        value: 2
                    },
                    {
                        name: "Q-T Interval",
                        value: 2
                    },
                    {
                        name: "SVES / VES",
                        value: 2
                    },
                    {
                        name: "Delta wave / U wave di lead",
                        value: 2
                    },
                    {
                        name: "Q Wave di lead",
                        value: 2
                    },
                    {
                        name: "r Premordial di lead",
                        value: 2
                    },
                    {
                        name: "ST depresed di lead",
                        value: 2
                    },
                    {
                        name: "ST Elevation di lead",
                        value: 2
                    },
                    {
                        name: "T Flat / T inverted di lead",
                        value: 2
                    },
                    {
                        name: "Kesan",
                        value: 3
                    },
                    {
                        name: "Anjuran",
                        value: 3
                    },
                    {
                        name: "Hasil",
                        value: 3
                    }
                ];

                const exists = items?.map(each => {
                    const match = FilterBound?.find(f => f?.name?.trim() === each?.description?.trim());
                    return match ? {
                        description: each.description.trim(),
                        value: match.value,
                        reagent_id: each.reagent_id
                    } : null;
                })?.filter(each => each !== null);

                const container = document?.getElementById('ContainerbodyBoundPrint');
                container.innerHTML = '';
                if (data && data.length > 0 && data[0]?.clinic_id === 'P016') {

                    exists?.forEach(item => {
                        let inputElement;
                        if (item.value === 3) {

                            inputElement = `
                    <div class="mb-3">
                        <label for="${item.reagent_id}" class="form-label">${item.description}</label>
                        <div class="border border-1 p-2" style="min-height: 120px">${item.description !== 'Kesan' ? (data[0].result_value) : (data[0]?.conclusion || '')}</div>
                    </div>
                    `;
                        }
                        container.innerHTML += inputElement;

                    });
                } else {
                    exists?.forEach(item => {
                        let inputElement;
                        let isChecked = data.some(d => d.reagent_id === item.reagent_id);
                        let foundData = data.find(d => d.reagent_id === item.reagent_id)

                        if (item.value === 1) {
                            // Create checkbox
                            inputElement = `
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="${item.reagent_id}" data-id="${item.reagent_id}" name="bound[]" onclick="return false;" value="${item.description.replace(/"/g, '')}" ${isChecked ? 'checked' : ''}>
                        <label class="form-check-label" for="${item.reagent_id}">
                            ${item.description}
                        </label>
                    </div>
                </div>
            `;
                        } else if (item.value === 2) {
                            // Create text input
                            inputElement = `
                <div class="mb-3">
                    <label for="${item.reagent_id}" class="form-label">${item.description}</label>
                    <div type="text" class="border border-1 p-2">${foundData ? foundData.result_value : '-'}</div>
                </div>
            `;
                        } else if (item.value === 3) {
                            // Create textarea
                            inputElement = `
                <div class="mb-3">
                    <label for="${item.reagent_id}" class="form-label">${item.description}</label>
                    <input type="hidden" name="${item.description !== 'Kesan' ? 'bound[]' : 'conclusion'}" class="quill-hidden-input" id="${item.reagent_id}-hidden" data-id="${item.reagent_id}" value="${item.description !== 'Kesan' ? (foundData ? foundData.result_value : '') : (data[0]?.conclusion || '')}">
                    <div class="border border-1 p-2" style="min-height: 120px">${item.description !== 'Kesan' ? (foundData ? foundData.result_value : '') : (data[0]?.conclusion || '')}</div>
                </div>
            `;
                        }
                        container.innerHTML += inputElement;

                    });
                }


            })
        </script>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcodeHasil"), {
                text: `<?= @$visit['fullname']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>


        </html>
    </div>
<?php endif; ?>

<!-- ========================================================== -->
<!-- Hasil bacaan pantologi -->
<?php if (!empty($patologi['val'])): ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3><?= $kop['name_of_org_unit']; ?></h3>
                        <p><?= $kop['contact_address']; ?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url('assets/img/kemenkes.png') ?>" width="70px">
                        <img class="mt-2" src="<?= base_url('assets/img/kars-bintang.png') ?>" width="70px">
                    </div>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <h3 class="text-center mb-0 my-1">HASIL PEMERIKSAAN PATOLOGI ANATOMI</h3>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <table class="table table-borderless mb-0">
                    <tr>
                        <td width="20%">Nama</td>
                        <td width="1%">:</td>
                        <td colspan="2"><?= @$patologi['visit']['diantar_oleh']; ?></td>
                        <td width="20%">No.RM</td>
                        <td width="1%">:</td>
                        <td><?= @$patologi['visit']['no_registration']; ?></td>
                    </tr>
                    <tr>
                        <td width="20%">Umur</td>
                        <td width="1%">:</td>
                        <td><?= @$patologi['visit']['age']; ?></td>
                        <td>LP: <?= @$patologi['visit']['gendername']; ?></td>
                        <td width="20%">Tanggal</td>
                        <td width="1%">:</td>
                        <td><?= date('d-m-Y') ?></td>
                    </tr>
                    <tr>
                        <td width="20%">Alamat</td>
                        <td width="1%">:</td>
                        <td colspan="2"><?= @$patologi['visit']['contact_address']; ?></td>
                        <td width="20%">Dokter</td>
                        <td width="1%">:</td>
                        <td></td>
                    </tr>
                </table>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;" class="mb-2">
                </div>
                <h3>Informasi Medis</h3>
                <table class="table table-bordered">
                    <tr>
                        <td width="33.3%">
                            <b>Jenis Pemeriksaan</b>
                            <p class="p-1 mb-0 text-wrap"><?= @$patologi['val']['tarif_name']; ?></p>
                        </td>
                        <td width="33.3%">
                            <b>Asal Jaringan</b>
                            <p class="p-1 mb-0 text-wrap"><?= @$patologi['val']['desc_english']; ?></p>
                        </td>
                        <td width="33.3%">
                            <b>Diagnosa Klinis</b>
                            <p class="p-1 mb-0 text-wrap"><?= @$patologi['val']['description']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Makroskopik</b>
                            <p class="p-1 mb-0 text-wrap"><?= @$patologi['val']['result_english']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Mikroskopik</b>
                            <p class="p-1 mb-0 text-wrap"><?= @$patologi['val']['result_value']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Kesimpulan</b>
                            <p class="p-1 mb-0 text-wrap"><?= @$patologi['val']['conclusion']; ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="row justify-content-end px-3">
                <div class="col-auto" align="center">
                    <div>Dokter</div>
                    <div class="mb-1">
                        <div id="qrcode-patologi"></div>
                    </div>
                </div>
            </div>
            <br>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </body>

        <script>
            var qrcode = new QRCode(document.getElementById("qrcode-patologi"), {
                text: `<?= $patologi['visit']['fullname']; ?>`,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
        </script>
    </div>
<?php endif; ?>

<!-- ========================================================== -->
<!-- INV -->
<?php if (!empty($treatment_bill)): ?>

    <div class="page-break">

        <!doctype html>
        <html lang="en">

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
                            <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="70px">
                        </div>
                        <div class="col mt-2">
                            <h3><?= @$kop['name_of_org_unit'] ?></h3>
                            <!-- <h3>Surakarta</h3> -->
                            <p><?= @$kop['contact_address'] ?></p>
                        </div>
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url('assets/img/kemenkes.png') ?>" width="70px">
                            <img class="mt-2" src="<?= base_url('assets/img/kars-bintang.png') ?>" width="70px">
                        </div>
                    </div>
                    <br>
                    <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                    <div class="row">
                        <h4 class="text-center pt-2">INVOICE</h4>
                    </div>
                    <div class="table-container-split">
                        <table>
                            <!-- kiri -->
                            <tr>
                                <th>
                                    <div id="name_patient-inv"></div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div id="type-pay-inv"></div>
                                </th>
                            </tr>
                        </table>
                        <table class="text-end">
                            <!--kanan -->
                            <tr>
                                <th>
                                    <div id="total-all-pay-inv"></div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div id="date-pay-inv"></div>
                                </th>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead class="border text-center" style="vertical-align: text-top;">
                                <tr>
                                    <th class="text-center w-auto">Deskripsi</th>
                                    <th class="text-center w-auto">Jumlah</th>
                                    <th class="text-center w-auto">Harga/Unit</th>
                                    <th class="text-center w-auto">Jumlah Harga</th>
                                </tr>
                            </thead>
                            <tbody id="render-tables-inv" class="border">
                            </tbody>
                        </table>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3" align="center">
                            <br>
                            <div>Pasien/Keluarga</div>
                            <div id="qrcode-container">
                                <div id="qrcode-inv"></div>
                            </div>
                            <div id="datetime-now"></div>
                        </div>
                        <div class="col"></div>
                        <div class="col-3" align="center">
                            <div>Kasir</div>
                            <div>
                                <div class="pt-2 pb-2" id="qrcode1-inv"></div>
                            </div>
                            <div id="validator-ttd"></div>
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
            $(document).ready(function() {

                $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)
                <?php $dataJsonTables2 = json_encode(@$treatment_bill); ?>
                let dataTable1 = <?php echo $dataJsonTables2; ?>;

                dataRenderTablesinvorat();
                renderDataPatientinvorat();

            })

            function formatCurrency(total) {

                var components = total.toFixed(2).toString().split(".");

                components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                return components.join(",");
            }

            const dataRenderTablesinvorat = () => {
                <?php $dataJsonTables = json_encode(@$treatment_bill); ?>
                let dataTable = <?php echo $dataJsonTables; ?>;

                let groupedData = {};

                dataTable.forEach(e => {
                    if (!groupedData[e.casemix]) {
                        groupedData[e.casemix] = {};
                    }

                    if (!groupedData[e.casemix][e.tarif_name_tt]) {
                        groupedData[e.casemix][e.tarif_name_tt] = [];
                    }

                    groupedData[e.casemix][e.tarif_name_tt].push(e);
                });

                let dataResultTable = '';


                for (let casemix in groupedData) {
                    if (groupedData.hasOwnProperty(casemix)) {
                        let casemixId = casemix.replace(/[\s\/]+/g, '_');
                        let totalSubtotal = 0;


                        dataResultTable += `<tr>
                                    <td colspan="2" class="text-start w-auto"><strong>${casemix}</strong></td>
                                    <td colspan="1" class="text-end w-auto"><strong>SubTotal:</strong></td>
                                    <td  class="text-end w-auto"><strong><div id="sub-inv-${casemixId}"></div></strong></td>
                                </tr>`;


                        for (let tarifName in groupedData[casemix]) {
                            if (groupedData[casemix].hasOwnProperty(tarifName)) {
                                groupedData[casemix][tarifName].forEach(e => {
                                    dataResultTable += `<tr>
                            <td class="w-auto">${e.tarif_name_tt ?? '-'}</td>
                            <td class="w-auto">${parseFloat(e.quantity) + ' Unit(s)' ?? 0}</td>
                            <td class="text-end w-auto">Rp. ${formatCurrency(parseFloat(e.sell_price ?? 0))}</td>
                            <td class="text-end w-auto">Rp. ${formatCurrency(parseFloat(e.subtotal ?? 0))}</td>
                        </tr>`;

                                    totalSubtotal += parseFloat(e.subtotal) || 0;
                                });
                            }
                        }
                    }
                }

                $("#render-tables-inv").html(dataResultTable);
                let grandTotal = 0;

                for (let casemix in groupedData) {
                    if (groupedData.hasOwnProperty(casemix)) {
                        let casemixId = casemix.replace(/[\s\/]+/g, '_');

                        let totalSubtotal = 0;

                        groupedData[casemix] = Object.values(groupedData[casemix]).flat();
                        groupedData[casemix].forEach(e => {
                            totalSubtotal += parseFloat(e.subtotal) || 0;
                        });

                        $(`#sub-inv-${casemixId}`).html(`Rp. ${formatCurrency(totalSubtotal)}`);

                        // Add the totalSubtotal to grandTotal
                        grandTotal += totalSubtotal;
                    }
                }

                $("#total-all-pay-inv").html(`Rp. ${formatCurrency(grandTotal)}`);





                // Optional: Function to add image to QR code (commented out)
                // function addImageToQRCode() {
                //     var qrElement = document.getElementById("qrcode");
                //     var qrCanvas = qrElement.querySelector('canvas');
                //     var img = new Image();
                //     img.src = '<?= base_url('assets/img/logo.png') ?>';
                //     img.onload = function() {
                //         var canvas = document.createElement('canvas');
                //         var ctx = canvas.getContext('2d');
                //         canvas.width = qrCanvas.width;
                //         canvas.height = qrCanvas.height;
                //         ctx.drawImage(qrCanvas, 0, 0, canvas.width, canvas.height);
                //         var imgSize = Math.min(canvas.width, canvas.height) * 0.3;
                //         var imgX = (canvas.width - imgSize) / 2;
                //         var imgY = (canvas.height - imgSize) / 2;
                //         ctx.drawImage(img, imgX, imgY, imgSize, imgSize);
                //         qrElement.innerHTML = '';
                //         qrElement.appendChild(canvas);
                //     };
                // }
                // addImageToQRCode();
            };







            const renderDataPatientinvorat = () => {
                <?php $dataJson = json_encode($visit); ?>
                let data = <?php echo $dataJson; ?>;

                // render patient 
                $("#name_patient-inv").html(data?.diantar_oleh)
                $("#type-pay-inv").html(data?.payor)
                // $("#total-all-pay-inv").html(data?.phone_number)
                $("#date-pay-inv").html(
                    moment(new Date(data?.exit_date || data?.in_date)).format("DD/MM/YYYY HH:mm")
                );

                new QRCode(document.getElementById("qrcode1-inv"), {
                    text: `${data?.diantar_oleh || ''}`,
                    width: 70,
                    height: 70,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });

                new QRCode(document.getElementById("qrcode-inv"), {
                    text: `<?= user()->fullname; ?> | ${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`,
                    width: 70,
                    height: 70,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });

            }
        </script>

        </html>

    </div>

<?php endif; ?>