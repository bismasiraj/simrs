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

    <title>RAWAT JALAN IGD</title>

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
                        <img src="<?= base_url('bpjs.jpeg') ?>" alt="BPJS KESEHATAN" style="width: 230px;">
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

                            <?= @$kop['kota']; ?>
                            <div class="col-sm-7">
                                <span><?= @$kop['name_of_org_unit']; ?> - <?= @$kop['kota']; ?></span>
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
                        <h6 class="text-center"><b>SURAT ELIGIBILITAS PESERTA <br> <?= @$kop['name_of_org_unit']; ?></b>
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
                        <h6 class="text-center"><b>SURAT BUKTI PELAYANAN <br> NAMA RS :
                                <?= @$kop['name_of_org_unit']; ?>
                                KODE RS :<?= @$kop['other_code']; ?>
                                KELAS RS : <?= @$kop['org_type']; ?>


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
                                <h6><?= @$kop['kota']; ?>,............. <br>Dokter Pemeriksa</h6>
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
<!-- SUrat Keterangan Diagnosa -->
<?php if (!empty($surat_diag['val'])): ?>
<div class="page-break">

    <body>
        <div class="container-fluid mt-5">
            <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
                autocomplete="off">



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
                    <h3 class="text-center">Surat Keterangan Diagnosis</h3>
                </div>
                <div class="row">
                    <h5 class="text-start">Informasi Pasien</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <b>Nomor RM</b>
                                <div id="no_registration" name="no_registration"><?= @$visit['no_registration']; ?>
                                </div>
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
                                <div id="theaddress" name="theaddress" class="theaddress">
                                    <?= @$visit['contact_address']; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>DPJP</b>
                                <div id="fullname" name="fullname"><?= @$visit['fullname']; ?></div>
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
                    <h2 class="text-center"><b><u>SURAT KETERANGAN DIAGNOSIS</u></b></h2>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        Yang bertanda tangan di bawah ini dokter RS PKU Muhammadiyah Sampangan Surakarta menerangkan
                        bahwa:
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <label for="nama" class="col-sm-auto col-form-label">:</label>
                    <div class="col">

                        <span><?= @$surat_diag['val']['nama']; ?></span>

                    </div>
                </div>
                <div class="row mb-1">
                    <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                    <label for="umur" class="col-sm-auto col-form-label">:</label>
                    <div class="col">

                        <span><?= @$surat_diag['val']['date_of_birth']; ?> (<?= @$surat_diag['val']['umur']; ?>)</span>

                    </div>
                </div>
                <div class="row mb-1">
                    <label for="jeniskel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <label for="jeniskel" class="col-sm-auto col-form-label">:</label>
                    <div class="col">

                        <span><?= @$surat_diag['val']['jeniskel']; ?></span>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <label for="alamat" class="col-sm-auto col-form-label">:</label>
                    <div class="col">
                        <span><?= @$surat_diag['val']['alamat']; ?></span>


                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        Telah diperiksa di RS PKU Muhammadiyah Sampangan Surakarta pada
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal</label>
                    <label for="tgl_masuk" class="col-sm-auto col-form-label">:</label>
                    <div class="col">
                        <span><?= @$surat_diag['val']['tgl_masuk']; ?></span>


                    </div>
                </div>
                <div class="row mb-1">
                    <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis</label>
                    <label for="diagnosis" class="col-sm-auto col-form-label">:</label>
                    <div class="col">
                        <span><?= @$surat_diag['val']['diagnosis']; ?></span>


                    </div>
                </div>
                <div class="row mb-1">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <label for="keterangan" class="col-sm-auto col-form-label">:</label>
                    <div class="col">
                        <span><?= @$surat_diag['val']['keterangan']; ?></span>


                    </div>
                </div>
                <div class="row mb-1">
                    <label for="tindakan" class="col-sm-2 col-form-label">Tindakan</label>
                    <label for="tindakan" class="col-sm-auto col-form-label">:</label>
                    <div class="col">
                        <span><?= @$surat_diag['val']['tindakan']; ?></span>


                    </div>
                </div>
                <div class="row mb-3">
                    <label for="farmakologi" class="col-sm-2 col-form-label">Terapi</label>
                    <label for="farmakologi" class="col-sm-auto col-form-label">:</label>
                    <div class="col">
                        <span><?= @$surat_diag['val']['farmakologi']; ?></span>

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        Demikian harap menjadikan periksa.
                    </div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>Dokter yang memeriksa,</div>
                        <div class="mb-1">
                            <div id="qrcode-diag-ket"></div>
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
    var qrcode = new QRCode(document.getElementById("qrcode-diag-ket"), {
        text: '<?= @$surat_diag['val']['dpjp']; ?>',
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
                            <div id="fullname" name="fullname"><?= @$visit['fullname']; ?></div>
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

                <?php foreach (@$param['aValue'] as $value): ?>
                <?php if (@$value['p_type'] == 'GEN0007'): ?>
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
                                for="<?=  $value['value_id'] . $value1['parameter_id'] . $value2['value_id'] ?>">
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
                    <h3><?= @$kop['name_of_org_unit']; ?></h3>
                    <p><?= @$kop['contact_address']; ?></p>
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
                    <td colspan="2"><?= @$visit['diantar_oleh']; ?></td>
                    <td width="20%">No.RM</td>
                    <td width="1%">:</td>
                    <td><?= @$visit['no_registration']; ?></td>
                </tr>
                <tr>
                    <td width="20%">Umur</td>
                    <td width="1%">:</td>
                    <td><?= @$visit['age']; ?></td>
                    <td>LP: <?= @$visit['gendername']; ?></td>
                    <td width="20%">Tanggal</td>
                    <td width="1%">:</td>
                    <td><?= date('d-m-Y') ?></td>
                </tr>
                <tr>
                    <td width="20%">Alamat</td>
                    <td width="1%">:</td>
                    <td colspan="2"><?= @$visit['contact_address']; ?></td>
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
<!-- INV -->
<?php if (!empty($treatment_bill)): ?>
<div class="page-break">

    <!doctype html>
    <html lang="en">

    <body>
        <div class="container-fluid mt-5">
            <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode(@$visit)); ?>" method="post"
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
        <?php $dataJson = json_encode(@$visit); ?>
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