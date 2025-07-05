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

        body {
            margin: 0;
            font-size: 12px;
            width: 100%;
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
    <link rel="stylesheet" href="<?= base_url(); ?>assets/libs/bootstrap/css/bootstrap.min.css">
    <link href="<?= base_url(); ?>css/jquery.signature.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>js/jquery.signature.js"></script>
    <script src="<?= base_url(); ?>assets/libs/qrcode/qrcode.js"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/default.js"></script>

    <title>Cetak All </title>

    <style>
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
            /* height: 29.7cm; */
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

<?php if ($type === 'SEP'): ?>
    <div class="page-break">

        <body>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-6">
                        <div>
                            <img src="<?= base_url() ?>assets/img/logo-bpjs.jpg" alt="BPJS KESEHATAN" style="width: 260px;">
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
                                        <span>Laki- Laki</span>
                                    <?php } else { ?>
                                        <span>Perempuan</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="poli_tujuan" class="col-sm-4 col-form-label">Poli Tujuan</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$sep['json']['name_of_clinic']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="asal_faskes" class="col-sm-4 col-form-label">Asal Faskes</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?= @$kop['display'] ?> - <?= @$kop['kota'] ?></span>
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
                            <h6 class="text-center"><b>SURAT ELIGIBILITAS PESERTA <br> <?= @$kop['display'] ?></b></h6>
                        </div>
                        <form action="" method="">
                            <div class="form-group row mt-2">
                                <label for="peserta" class="col-sm-4 col-form-label">Peserta</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7 align-items-center">
                                    <!-- <span>Anak</span> -->
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
                                    <h6><?= @$kop['display'] ?>,
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
                            <h6 class="text-center"><b>SURAT BUKTI PELAYANAN <br> NAMA RS : <?= @$kop['display'] ?> KODE RS :
                                    <?= @$kop['other_code'] ?> KELAS RS : <?= @$kop['org_type'] ?>
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
                                <!-- <table class="table table-bordered" style="border: solid black;">
                                <tbody>
                                    <tr style="height: 15px;">
                                        <td class="text-center">
                                            <label class="text-uppercase">urologi</label>
                                        </td>
                                    </tr>
                                    <tr style="height: 25px;">
                                        <td class="text-center">
                                            <label class="text-uppercase fs-2"
                                                style="font-family: 'Times New Roman', Times, serif;">
                                                <b><?php echo @$sep['json']['urutan']; ?></b>
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> -->
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
                                    <h6><?= @$kop['display'] ?>,............. <br>Dokter Pemeriksa</h6>
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
                /* @media print {
            @page {
                margin: 20px;
                size: auto;
            }
        } */
            </style>

            <script>
                //window.print();
            </script>

        </body>

    </div>
<?php elseif ($type === 'SRI'): ?>
    <div class="page-break">

        <body>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-6">
                        <div>
                            <img src="<?= base_url() ?>assets/img/logo-bpjs.jpg" alt="BPJS KESEHATAN" style="width: 260px;">
                        </div>
                        <form action="" method="">
                            <div class="form-group row mt-2 align-items-center">
                                <label for="no_sep" class="col-sm-4 col-form-label">No. Kartu</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$skdp['json']['no_bpjs']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="tgl_sep" class="col-sm-4 col-form-label">Nama Peserta</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-4">
                                    <span><?php echo @$skdp['json']['nama']; ?></span>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-4">
                                    <span><?php echo @$skdp['json']['date_of_birth']; ?>
                                        <?php echo @$skdp['json']['umur']; ?></span>
                                </div>
                            </div>



                            <div class="form-group row align-items-center">
                                <label for="diagnosa_awal" class="col-sm-4 col-form-label">Diagnosa</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$skdp['json']['diagnosis']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="catatan" class="col-sm-4 col-form-label">Rencana Kontrol</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$skdp['json']['tgl_kontrol_selanjutnya']; ?></span>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <p>Demikian Atas Bantuannya, diucapkan Banyak Terimakasih

                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="row">
                            <h6 class="text-center"><b>SURAT RENCANA KONTROL <br> <?= @$kop['display'] ?></b></h6>
                        </div>
                        <form action="" method="">
                            <div class="form-group row mt-2">
                                <label for="no" class="col-sm-4 col-form-label">No</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7 align-items-center">
                                    <span><?php echo @$skdp['json']['nosep']; ?></span>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>



            <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>


            <script>
                //window.print();
            </script>

        </body>

    </div>
<?php elseif ($type === 'TRIASE'): ?>
    <div class="page-break">
        <!doctype html>
        <html lang="en">

        <body>
            <div class="container-fluid mt-5">

                <!-- template header -->
                <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php", ['key' => ['title' => 'Resume Pasien Pulang']]) ?>
                <!-- end of template header -->
                <div class="row">
                    <h5 class="text-start">Subjektif (S)</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Keluhan Utama (Autoanamnesis)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['anamnesis']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Penyakit Sekarang</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_sekarang']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Penyakit Dahulu</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_dahulu']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Riwayat Penyakit Keluarga</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_keluarga']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Alergi (Non Obat)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alergi_nonobat']; ?></p>
                                <b>Riwayat Alergi (Obat)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alergi_obat']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Obat Yang Dikonsumsi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_obat_dikonsumsi']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Riwayat Kehamilan dan Persalinan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_kehamilan']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Diet</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_diet']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Imunisasi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_imunisasi']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="p-1">
                                <b>Riwayat Kebiasaan (Negatif)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alkohol']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Obyektif (O)</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td colspan="4" class="p-1"><b>Vital Sign</b></td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Tekanan Darah</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= (int) ($resumeMedis['val']['tensi_atas'] ?? 0)  ?>/<?= (int) ($resumeMedis['val']['tensi_bawah'] ?? 0); ?>
                                    mmHg</p>
                            </td>
                            <td class="p-1">
                                <b>Denyut Nadi</b>
                                <p class="m-0 mt-1 p-0"><?= (int) ($resumeMedis['val']['nadi'] ?? 0) ?> x/m</p>
                            </td>
                            <td class="p-1">
                                <b>Suhu Tubuh</b>
                                <p class="m-0 mt-1 p-0"><?= (int) ($resumeMedis['val']['suhu'] ?? 0)  ?> °C</p>
                            </td>
                            <td class="p-1">
                                <b>Respiration Rate</b>
                                <p class="m-0 mt-1 p-0"><?= (int) ($resumeMedis['val']['respiration'] ?? 0)  ?> x/m</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Berat Badan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['berat']; ?> kg</p>
                            </td>
                            <td class="p-1">
                                <b>Tinggi Badan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['tinggi']; ?> cm</p>
                            </td>
                            <td class="p-1">
                                <b>SpO2</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['spo2']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>BMI</b>
                                <p class="m-0 mt-1 p-0"><?= number_format($resumeMedis['val']['imt'] ?? 0, 2, '.', ''); ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php if (!empty($resumeMedis['val']['gcs_desc'])) { ?>

                    <?php
                    if ($resumeMedis['visit']['ageyear'] < 18) { ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="p-1">
                                        <b><i>pGCS / Tingkat Kesadaran</i></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>pGCS E / Respon Membuka Mata :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_e'] . '] ' . @$resumeMedis['val']['gsc_e_desc']; ?>.</span>
                                                <b>pGCS V / Respon Verbal Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_v'] . '] ' . @$resumeMedis['val']['gsc_v_desc']; ?>.</span>
                                                <b>pGCS M / Respon Motorik Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_m'] . '] ' . @$resumeMedis['val']['gsc_m_desc']; ?>.</span>
                                            </div>

                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>Score pGCS : </b>
                                                <span class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['gcs_desc']; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <b>Keadaan Umum</b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['keadaanumum']) ? @$resumeMedis['val']['keadaanumum'] : '-'; ?>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    <?php } else { ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="p-1">
                                        <b><i>GCS / Tingkat Kesadaran</i></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>GCS E / Respon Membuka Mata :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_e'] . '] ' . @$resumeMedis['val']['gsc_e_desc']; ?>.</span><br>
                                                <b>GCS V / Respon Verbal Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_v'] . '] ' . @$resumeMedis['val']['gsc_v_desc']; ?>.</span><br>
                                                <b>GCS M / Respon Motorik Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_m'] . '] ' . @$resumeMedis['val']['gsc_m_desc']; ?>.</span>
                                            </div>

                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>Score GCS : </b>
                                                <span class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['gcs_desc']; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <b>Keadaan Umum</b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['keadaanumum']) ? @$resumeMedis['val']['keadaanumum'] : '-'; ?>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                <?php } ?>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width: 50%;">
                                <b>Skala Nyeri</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['pain_score']; ?></p>
                            </td>
                            <td class="p-1" style="width: 50%;">
                                <b>Resiko Jatuh</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['fall_score']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if ($resumeMedis['visit']['specialist_type_id'] === "1.12"): ?>
                    <table class="table table-bordered" id="statusDermatologiShow">
                        <tbody>
                            <tr>
                                <td colspan="4" class="fw-bold">Status Dermatologik</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <b class="col-12">I. Inspeksi</b>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td class="fw-bold">Lokasi</td>
                                                <td class="fw-bold">UKK</td>
                                                <td class="fw-bold">Distribusi</td>
                                                <td class="fw-bold">Konfigurasi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_location'] ?></td>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_ukk'] ?></td>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_distribution'] ?></td>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_configuration'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Palpasi</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sd_palpation'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Lain-Lain</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sd_others'] ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <b class="col-12">Status Venerologik</b>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Inspeksi</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sv_inspection'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Palpasi</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sv_palpation'] ?></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
                <?php
                if ($resumeMedis['visit']['specialist_type_id'] === "1.16"): ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Var/NRS</th>
                                <th>Pupil Kiri</th>
                                <th>Pupil kanan</th>
                            </tr>
                            <tr>
                                <td><?= @$resumeMedis['val']['saraf']['vas_nrs'] ?></td>
                                <td>
                                    <b>Diameter :</b><?= @$resumeMedis['val']['saraf']['left_diameter'] ?>
                                    <br><b>Refleks Cahaya :</b><?= @$resumeMedis['val']['saraf']['left_light_reflex'] ?>
                                    <br><b>Kornea:</b><?= @$resumeMedis['val']['saraf']['left_cornea'] ?>
                                    <br><b>Isokor Anisokor :</b><?= @$resumeMedis['val']['saraf']['left_isokor_anisokor'] ?>
                                </td>
                                <td>
                                    <b>Diameter :</b><?= @$resumeMedis['val']['saraf']['right_diameter'] ?>
                                    <br><b>Refleks Cahaya :</b><?= @$resumeMedis['val']['saraf']['right_light_reflex'] ?>
                                    <br><b>Kornea:</b><?= @$resumeMedis['val']['saraf']['right_cornea'] ?>
                                    <br><b>Isokor Anisokor :</b><?= @$resumeMedis['val']['saraf']['right_isokor_anisokor'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Leher</th>
                                <th>Gerak</th>
                                <th>Kekuatan</th>
                            </tr>
                            <tr>
                                <td>
                                    <b>Kaku kuduk :</b><?= @$resumeMedis['val']['saraf']['stiff_neck'] ?>
                                    <br><b>Meningeal Sign :</b><?= @$resumeMedis['val']['saraf']['meningeal_sign'] ?>
                                    <br><b>Brudzinki I-IV :</b><?= @$resumeMedis['val']['saraf']['brudzinki_i_iv'] ?>
                                    <br><b>Kernig Sign:</b><?= @$resumeMedis['val']['saraf']['kernig_sign'] ?>
                                    <br><b>Dolls eye phenomena :</b><?= @$resumeMedis['val']['saraf']['dolls_eye_phenomenon'] ?>
                                    <br><b>Vertebra :</b><?= @$resumeMedis['val']['saraf']['vertebra'] ?>
                                    <br><b>Extremity :</b><?= @$resumeMedis['val']['saraf']['extremity'] ?>
                                </td>
                                <td>
                                    <b>Gerak Atas Kiri :</b><?= @$resumeMedis['val']['saraf']['motion_upper_left'] ?>
                                    <br><b>Gerak Atas Kanan :</b><?= @$resumeMedis['val']['saraf']['motion_upper_right'] ?>
                                    <br><b>Gerak Bawah Kiri :</b><?= @$resumeMedis['val']['saraf']['motion_lower_left'] ?>
                                    <br><b>Gerak Bawah Kanan :</b><?= @$resumeMedis['val']['saraf']['motion_lower_right'] ?>
                                </td>
                                <td>
                                    <b>Kekuatan Atas Kiri :</b><?= @$resumeMedis['val']['saraf']['strength_upper_left'] ?>
                                    <br><b>Kekuatan Atas Kanan :</b><?= @$resumeMedis['val']['saraf']['strength_upper_right'] ?>
                                    <br><b>Kekuatan Bawah Kiri:</b><?= @$resumeMedis['val']['saraf']['strength_lower_left'] ?>
                                    <br><b>Kekuatan Bawah Kanan
                                        :</b><?= @$resumeMedis['val']['saraf']['strength_lower_right'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>

                <table class="table table-bordered">
                    <tbody>
                        <?php
                        // check jika data lokalis ada atau tidak
                        if (!empty($resumeMedis['lokalis2'])) {
                            // jika ada maka lakukan perulangan untuk menampilkan data
                            foreach ($resumeMedis['lokalis2'] as $key => $value) {
                                // jika data lokalis memiliki value score = 2 maka tampilkan
                                if ($value['value_score'] == 2) {
                                    // jika key pada data adalah ganjil
                                    if (($key + 1) % 2 != 0) {
                                        // jika data bukan data terakhir 
                                        if ($key + 1 != count($resumeMedis['lokalis2'])) {
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
                        <?php
                        if (!empty($resumeMedis['lokalis'])) {
                            foreach ($resumeMedis['lokalis'] as $key => $value) {
                                if ($value['value_score'] == 3) {
                                    $filepath = WRITEPATH . 'uploads/lokalis/' . $value['value_detail'];

                                    if (file_exists($filepath)) {
                                        $filedata = file_get_contents($filepath);
                                        $filedata64 = base64_encode($filedata);
                                        $selectlokalis[$key]['filedata64'] = $filedata64;

                                        echo '<tr>';
                                        echo '<th>' . $value['nama_lokalis'] . '</th>';
                                        echo '<td style="width: 50%;">';
                                        echo '<img class="mt-3" src="data:image/jpeg;base64,' . $filedata64 . '" width="400px">';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                if ($resumeMedis['visit']['specialist_type_id'] === "1.10"): ?>
                    <?php
                    if (!empty($resumeMedis['val']['mata']) && is_array($resumeMedis['val']['mata'])) {
                        $result = [];
                        foreach ($resumeMedis['val']['mata'] as $item) {
                            $nama_lokalis = str_replace(["DEXTRA", "SINISTRA"], "", $item['nama_lokalis']);
                            $nama_lokalis = trim($nama_lokalis);
                            $value_info = $item['value_info'];
                            $value_detail = $item['value_detail'];

                            if (isset($result[$nama_lokalis])) {
                                $result[$nama_lokalis][$value_info] = $value_detail;
                            } else {
                                $result[$nama_lokalis] = [
                                    "SINISTRA" => $value_info === "SINISTRA" ? $value_detail : null,
                                    "nama_lokalis" => $nama_lokalis,
                                    "DEXTRA" => $value_info === "DEXTRA" ? $value_detail : null
                                ];
                            }
                        }

                        $resultChunks = array_chunk($result, ceil(count($result) / 2), true);
                        echo "<div style='display: flex; gap: auto;'>";

                        foreach ($resultChunks as $chunk) {
                            echo "<div style='flex: 1;'>";
                            echo "<table border='1' class='table table-bordered'>";
                            echo "<tr><td class='fw-bold'>Oculus Dextra</td><td class='fw-bold text-center'>Keterangan</td><td class='fw-bold'>Oculus Sinistra</td></tr>";
                            foreach ($chunk as $row) {
                                echo "<tr>";
                                echo "<td>" . ($row['DEXTRA'] ?? '') . "</td>";
                                echo "<td class='text-center'>{$row['nama_lokalis']}</td>";
                                echo "<td>" . ($row['SINISTRA'] ?? '') . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
                        }

                        echo "</div>";
                    }
                    ?>

                <?php endif; ?>
                <?php if (!empty($resumeMedis['val']['pemeriksaan']) && is_array($resumeMedis['val']['pemeriksaan'])) { ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="p-1" colspan="2">
                                    <b>Catatan Obyektif</b>
                                    <p class="m-0 mt-1 p-0">
                                        <?= !empty(@$resumeMedis['val']['pemeriksaan']) ? @$resumeMedis['val']['pemeriksaan'] : '-'; ?>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <?php if (!empty($resumeMedis['val']['ats_tipe']) && is_array($resumeMedis['val']['ats_tipe'])) { ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="p-1">
                                    <b>Triage</b>
                                    <p class="m-0 mt-1 p-0">
                                        <?= !empty(@$resumeMedis['val']['ats_tipe']) ? @$resumeMedis['val']['ats_tipe'] : '-'; ?>
                                    </p>
                                </td>
                            </tr>
                            <?php if (!empty($resumeMedis['val']['ats_tipe'])): ?>
                                <tr>
                                    <td class="p-1">
                                        <b><?= @$resumeMedis['val']['ats_tipe']; ?></b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['ats_item']) ? @$resumeMedis['val']['ats_item'] : '-'; ?>
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php if (!empty($resumeMedis['val']['hamil']) && ($resumeMedis['val']['hamil'] === "Hamil")): ?>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>Hamil</b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['hamil']) ? @$resumeMedis['val']['hamil'] : '-'; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>Umur Kehamilan</b>
                                        <p class="m-0 mt-1 p-0"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>G</b>
                                        <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_g']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>P</b>
                                        <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_p']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>A</b>
                                        <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_a']; ?></p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php } ?>


                <div class="row">
                    <h4 class="text-start">Assessment (A)</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Diagnosis</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['namadiagnosa']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Permasalahan Medis</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['masalah_medis']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Penyebab Cidera / Keracunan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['penyebab_cidera']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start fw-bold">Planning (P)</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <?php if ($resumeMedis['visit']['isrj'] == '0') {
                        ?>
                            <tr>
                                <td class="p-1">
                                    <b>Standing Order</b>
                                    <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['standing_order']; ?></p>
                                </td>
                            </tr>
                        <?php
                        } ?>
                        <tr>
                            <td class="p-1">
                                <b>Target / Sasaran Terapi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['sasaran']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start">Pemeriksaan Diagnostik Penunjang</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Laboratorium</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= isset($resumeMedis['val']['laboratorium']) ? nl2br($resumeMedis['val']['laboratorium']) : ''; ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Radiologi</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= isset($resumeMedis['val']['radiologi']) ? nl2br($resumeMedis['val']['radiologi']) : ''; ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Farmakoterapi</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= isset($resumeMedis['val']['farmakologia']) ? nl2br($resumeMedis['val']['farmakologia']) : ''; ?>
                                </p>

                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Target / Sasaran Terapi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['prosedur']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Catatan Procedure</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Standing Order</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['standing_order']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Rencana Tindak Lanjut</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Rencana Tindak Lanjut</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['rencana_tl']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kontrol</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['kontrol']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (@$resumeMedis['val']['edukasi_pasien']) {
                ?>
                    <div class="row">
                        <h5 class="text-start">Edukasi Pasien</h5>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="p-1">
                                    <!-- <b>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada:</b> -->
                                    <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['edukasi_pasien']; ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                } ?>

                <div class="col-md-4 text-start">
                    <div>Sampangan, <?= tanggal_indo(date('Y-m-d')); ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-3" align="center">
                        <br>
                        <div>Dokter</div>
                        <div id="qrcode-container">
                            <div id="qrcodeMedis"></div>
                        </div>
                        <p class="p-0 m-0 py-1" id="qrcodeMedis_name">(<?= @$resumeMedis['val']['dokter']; ?>)</p>
                        <p><i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i></p>
                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>Penerima Penjelasan</div>
                        <div>
                            <div id="qrcodeMedis1"></div>
                        </div>
                        <p class="p-0 m-0 py-1" id="">(<?= @$resumeMedis['val']['nama']; ?>)</p>
                    </div>
                </div>
            </div>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        </body>
        <script>
            let val = <?= json_encode($resumeMedis['val']); ?>;
            let sign = <?= json_encode($resumeMedis['sign']); ?>;

            sign = JSON.parse(sign)
        </script>
        <script>
            $.each(sign, function(key, value) {
                if (value.user_type == 1 && value.isvalid == 1) {
                    var qrcode = new QRCode(document.getElementById("qrcodeMedis"), {
                        text: value.sign_path,
                        width: 150,
                        height: 150,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });
                    $("#qrcodeMedis_name").html(`(${value.fullname??value.user_id})`)
                } else if (value.user_type == 2 && value.isvalid == 1) {
                    var qrcode1 = new QRCode(document.getElementById("qrcodeMedis1"), {
                        text: value.sign_path,
                        width: 150,
                        height: 150,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });
                    // $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)
                }
            })
        </script>

        </html>
    </div>
<?php elseif ($type === 'ResumeMedis'): ?>
    <div class="page-break">
        <!doctype html>
        <html lang="en">

        <body>
            <div class="container-fluid mt-5">

                <!-- template header -->
                <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php", ['key' => ['title' => 'Resume Pasien Pulang']]) ?>
                <!-- end of template header -->
                <div class="row">
                    <h5 class="text-start">Subjektif (S)</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Keluhan Utama (Autoanamnesis)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['anamnesis']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Penyakit Sekarang</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_sekarang']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Penyakit Dahulu</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_dahulu']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Riwayat Penyakit Keluarga</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_keluarga']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Alergi (Non Obat)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alergi_nonobat']; ?></p>
                                <b>Riwayat Alergi (Obat)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alergi_obat']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Obat Yang Dikonsumsi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_obat_dikonsumsi']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Riwayat Kehamilan dan Persalinan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_kehamilan']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Diet</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_diet']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Imunisasi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_imunisasi']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="p-1">
                                <b>Riwayat Kebiasaan (Negatif)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alkohol']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Obyektif (O)</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td colspan="4" class="p-1"><b>Vital Sign</b></td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Tekanan Darah</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= (int) ($resumeMedis['val']['tensi_atas'] ?? 0)  ?>/<?= (int) ($resumeMedis['val']['tensi_bawah'] ?? 0); ?>
                                    mmHg</p>
                            </td>
                            <td class="p-1">
                                <b>Denyut Nadi</b>
                                <p class="m-0 mt-1 p-0"><?= (int) ($resumeMedis['val']['nadi'] ?? 0) ?> x/m</p>
                            </td>
                            <td class="p-1">
                                <b>Suhu Tubuh</b>
                                <p class="m-0 mt-1 p-0"><?= (int) ($resumeMedis['val']['suhu'] ?? 0)  ?> °C</p>
                            </td>
                            <td class="p-1">
                                <b>Respiration Rate</b>
                                <p class="m-0 mt-1 p-0"><?= (int) ($resumeMedis['val']['respiration'] ?? 0)  ?> x/m</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Berat Badan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['berat']; ?> kg</p>
                            </td>
                            <td class="p-1">
                                <b>Tinggi Badan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['tinggi']; ?> cm</p>
                            </td>
                            <td class="p-1">
                                <b>SpO2</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['spo2']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>BMI</b>
                                <p class="m-0 mt-1 p-0"><?= number_format($resumeMedis['val']['imt'] ?? 0, 2, '.', ''); ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php if (!empty($resumeMedis['val']['gcs_desc'])) { ?>

                    <?php
                    if ($resumeMedis['visit']['ageyear'] < 18) { ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="p-1">
                                        <b><i>pGCS / Tingkat Kesadaran</i></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>pGCS E / Respon Membuka Mata :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_e'] . '] ' . @$resumeMedis['val']['gsc_e_desc']; ?>.</span>
                                                <b>pGCS V / Respon Verbal Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_v'] . '] ' . @$resumeMedis['val']['gsc_v_desc']; ?>.</span>
                                                <b>pGCS M / Respon Motorik Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_m'] . '] ' . @$resumeMedis['val']['gsc_m_desc']; ?>.</span>
                                            </div>

                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>Score pGCS : </b>
                                                <span class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['gcs_desc']; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <b>Keadaan Umum</b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['keadaanumum']) ? @$resumeMedis['val']['keadaanumum'] : '-'; ?>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    <?php } else { ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="p-1">
                                        <b><i>GCS / Tingkat Kesadaran</i></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>GCS E / Respon Membuka Mata :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_e'] . '] ' . @$resumeMedis['val']['gsc_e_desc']; ?>.</span><br>
                                                <b>GCS V / Respon Verbal Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_v'] . '] ' . @$resumeMedis['val']['gsc_v_desc']; ?>.</span><br>
                                                <b>GCS M / Respon Motorik Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_m'] . '] ' . @$resumeMedis['val']['gsc_m_desc']; ?>.</span>
                                            </div>

                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>Score GCS : </b>
                                                <span class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['gcs_desc']; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <b>Keadaan Umum</b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['keadaanumum']) ? @$resumeMedis['val']['keadaanumum'] : '-'; ?>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                <?php } ?>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width: 50%;">
                                <b>Skala Nyeri</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['pain_score']; ?></p>
                            </td>
                            <td class="p-1" style="width: 50%;">
                                <b>Resiko Jatuh</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['fall_score']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if ($resumeMedis['visit']['specialist_type_id'] === "1.12"): ?>
                    <table class="table table-bordered" id="statusDermatologiShow">
                        <tbody>
                            <tr>
                                <td colspan="4" class="fw-bold">Status Dermatologik</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <b class="col-12">I. Inspeksi</b>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td class="fw-bold">Lokasi</td>
                                                <td class="fw-bold">UKK</td>
                                                <td class="fw-bold">Distribusi</td>
                                                <td class="fw-bold">Konfigurasi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_location'] ?></td>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_ukk'] ?></td>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_distribution'] ?></td>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_configuration'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Palpasi</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sd_palpation'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Lain-Lain</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sd_others'] ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <b class="col-12">Status Venerologik</b>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Inspeksi</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sv_inspection'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Palpasi</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sv_palpation'] ?></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
                <?php
                if ($resumeMedis['visit']['specialist_type_id'] === "1.16"): ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Var/NRS</th>
                                <th>Pupil Kiri</th>
                                <th>Pupil kanan</th>
                            </tr>
                            <tr>
                                <td><?= @$resumeMedis['val']['saraf']['vas_nrs'] ?></td>
                                <td>
                                    <b>Diameter :</b><?= @$resumeMedis['val']['saraf']['left_diameter'] ?>
                                    <br><b>Refleks Cahaya :</b><?= @$resumeMedis['val']['saraf']['left_light_reflex'] ?>
                                    <br><b>Kornea:</b><?= @$resumeMedis['val']['saraf']['left_cornea'] ?>
                                    <br><b>Isokor Anisokor :</b><?= @$resumeMedis['val']['saraf']['left_isokor_anisokor'] ?>
                                </td>
                                <td>
                                    <b>Diameter :</b><?= @$resumeMedis['val']['saraf']['right_diameter'] ?>
                                    <br><b>Refleks Cahaya :</b><?= @$resumeMedis['val']['saraf']['right_light_reflex'] ?>
                                    <br><b>Kornea:</b><?= @$resumeMedis['val']['saraf']['right_cornea'] ?>
                                    <br><b>Isokor Anisokor :</b><?= @$resumeMedis['val']['saraf']['right_isokor_anisokor'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Leher</th>
                                <th>Gerak</th>
                                <th>Kekuatan</th>
                            </tr>
                            <tr>
                                <td>
                                    <b>Kaku kuduk :</b><?= @$resumeMedis['val']['saraf']['stiff_neck'] ?>
                                    <br><b>Meningeal Sign :</b><?= @$resumeMedis['val']['saraf']['meningeal_sign'] ?>
                                    <br><b>Brudzinki I-IV :</b><?= @$resumeMedis['val']['saraf']['brudzinki_i_iv'] ?>
                                    <br><b>Kernig Sign:</b><?= @$resumeMedis['val']['saraf']['kernig_sign'] ?>
                                    <br><b>Dolls eye phenomena :</b><?= @$resumeMedis['val']['saraf']['dolls_eye_phenomenon'] ?>
                                    <br><b>Vertebra :</b><?= @$resumeMedis['val']['saraf']['vertebra'] ?>
                                    <br><b>Extremity :</b><?= @$resumeMedis['val']['saraf']['extremity'] ?>
                                </td>
                                <td>
                                    <b>Gerak Atas Kiri :</b><?= @$resumeMedis['val']['saraf']['motion_upper_left'] ?>
                                    <br><b>Gerak Atas Kanan :</b><?= @$resumeMedis['val']['saraf']['motion_upper_right'] ?>
                                    <br><b>Gerak Bawah Kiri :</b><?= @$resumeMedis['val']['saraf']['motion_lower_left'] ?>
                                    <br><b>Gerak Bawah Kanan :</b><?= @$resumeMedis['val']['saraf']['motion_lower_right'] ?>
                                </td>
                                <td>
                                    <b>Kekuatan Atas Kiri :</b><?= @$resumeMedis['val']['saraf']['strength_upper_left'] ?>
                                    <br><b>Kekuatan Atas Kanan :</b><?= @$resumeMedis['val']['saraf']['strength_upper_right'] ?>
                                    <br><b>Kekuatan Bawah Kiri:</b><?= @$resumeMedis['val']['saraf']['strength_lower_left'] ?>
                                    <br><b>Kekuatan Bawah Kanan
                                        :</b><?= @$resumeMedis['val']['saraf']['strength_lower_right'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>

                <table class="table table-bordered">
                    <tbody>
                        <?php
                        // check jika data lokalis ada atau tidak
                        if (!empty($resumeMedis['lokalis2'])) {
                            // jika ada maka lakukan perulangan untuk menampilkan data
                            foreach ($resumeMedis['lokalis2'] as $key => $value) {
                                // jika data lokalis memiliki value score = 2 maka tampilkan
                                if ($value['value_score'] == 2) {
                                    // jika key pada data adalah ganjil
                                    if (($key + 1) % 2 != 0) {
                                        // jika data bukan data terakhir 
                                        if ($key + 1 != count($resumeMedis['lokalis2'])) {
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
                        <?php
                        if (!empty($resumeMedis['lokalis'])) {
                            foreach ($resumeMedis['lokalis'] as $key => $value) {
                                if ($value['value_score'] == 3) {
                                    $filepath = WRITEPATH . 'uploads/lokalis/' . $value['value_detail'];

                                    if (file_exists($filepath)) {
                                        $filedata = file_get_contents($filepath);
                                        $filedata64 = base64_encode($filedata);
                                        $selectlokalis[$key]['filedata64'] = $filedata64;

                                        echo '<tr>';
                                        echo '<th>' . $value['nama_lokalis'] . '</th>';
                                        echo '<td style="width: 50%;">';
                                        echo '<img class="mt-3" src="data:image/jpeg;base64,' . $filedata64 . '" width="400px">';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                if ($resumeMedis['visit']['specialist_type_id'] === "1.10"): ?>
                    <?php
                    if (!empty($resumeMedis['val']['mata']) && is_array($resumeMedis['val']['mata'])) {
                        $result = [];
                        foreach ($resumeMedis['val']['mata'] as $item) {
                            $nama_lokalis = str_replace(["DEXTRA", "SINISTRA"], "", $item['nama_lokalis']);
                            $nama_lokalis = trim($nama_lokalis);
                            $value_info = $item['value_info'];
                            $value_detail = $item['value_detail'];

                            if (isset($result[$nama_lokalis])) {
                                $result[$nama_lokalis][$value_info] = $value_detail;
                            } else {
                                $result[$nama_lokalis] = [
                                    "SINISTRA" => $value_info === "SINISTRA" ? $value_detail : null,
                                    "nama_lokalis" => $nama_lokalis,
                                    "DEXTRA" => $value_info === "DEXTRA" ? $value_detail : null
                                ];
                            }
                        }

                        $resultChunks = array_chunk($result, ceil(count($result) / 2), true);
                        echo "<div style='display: flex; gap: auto;'>";

                        foreach ($resultChunks as $chunk) {
                            echo "<div style='flex: 1;'>";
                            echo "<table border='1' class='table table-bordered'>";
                            echo "<tr><td class='fw-bold'>Oculus Dextra</td><td class='fw-bold text-center'>Keterangan</td><td class='fw-bold'>Oculus Sinistra</td></tr>";
                            foreach ($chunk as $row) {
                                echo "<tr>";
                                echo "<td>" . ($row['DEXTRA'] ?? '') . "</td>";
                                echo "<td class='text-center'>{$row['nama_lokalis']}</td>";
                                echo "<td>" . ($row['SINISTRA'] ?? '') . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
                        }

                        echo "</div>";
                    }
                    ?>

                <?php endif; ?>
                <?php if (!empty($resumeMedis['val']['pemeriksaan']) && is_array($resumeMedis['val']['pemeriksaan'])) { ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="p-1" colspan="2">
                                    <b>Catatan Obyektif</b>
                                    <p class="m-0 mt-1 p-0">
                                        <?= !empty(@$resumeMedis['val']['pemeriksaan']) ? @$resumeMedis['val']['pemeriksaan'] : '-'; ?>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <?php if (!empty($resumeMedis['val']['ats_tipe']) && is_array($resumeMedis['val']['ats_tipe'])) { ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="p-1">
                                    <b>Triage</b>
                                    <p class="m-0 mt-1 p-0">
                                        <?= !empty(@$resumeMedis['val']['ats_tipe']) ? @$resumeMedis['val']['ats_tipe'] : '-'; ?>
                                    </p>
                                </td>
                            </tr>
                            <?php if (!empty($resumeMedis['val']['ats_tipe'])): ?>
                                <tr>
                                    <td class="p-1">
                                        <b><?= @$resumeMedis['val']['ats_tipe']; ?></b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['ats_item']) ? @$resumeMedis['val']['ats_item'] : '-'; ?>
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php if (!empty($resumeMedis['val']['hamil']) && ($resumeMedis['val']['hamil'] === "Hamil")): ?>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>Hamil</b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['hamil']) ? @$resumeMedis['val']['hamil'] : '-'; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>Umur Kehamilan</b>
                                        <p class="m-0 mt-1 p-0"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>G</b>
                                        <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_g']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>P</b>
                                        <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_p']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>A</b>
                                        <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_a']; ?></p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php } ?>


                <div class="row">
                    <h4 class="text-start">Assessment (A)</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Diagnosis</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['namadiagnosa']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Permasalahan Medis</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['masalah_medis']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Penyebab Cidera / Keracunan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['penyebab_cidera']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start fw-bold">Planning (P)</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <?php if ($resumeMedis['visit']['isrj'] == '0') {
                        ?>
                            <tr>
                                <td class="p-1">
                                    <b>Standing Order</b>
                                    <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['standing_order']; ?></p>
                                </td>
                            </tr>
                        <?php
                        } ?>
                        <tr>
                            <td class="p-1">
                                <b>Target / Sasaran Terapi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['sasaran']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start">Pemeriksaan Diagnostik Penunjang</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Laboratorium</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= isset($resumeMedis['val']['laboratorium']) ? nl2br($resumeMedis['val']['laboratorium']) : ''; ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Radiologi</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= isset($resumeMedis['val']['radiologi']) ? nl2br($resumeMedis['val']['radiologi']) : ''; ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Farmakoterapi</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= isset($resumeMedis['val']['farmakologia']) ? nl2br($resumeMedis['val']['farmakologia']) : ''; ?>
                                </p>

                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Target / Sasaran Terapi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['prosedur']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Catatan Procedure</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Standing Order</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['standing_order']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Rencana Tindak Lanjut</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Rencana Tindak Lanjut</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['rencana_tl']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kontrol</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['kontrol']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (@$resumeMedis['val']['edukasi_pasien']) {
                ?>
                    <div class="row">
                        <h5 class="text-start">Edukasi Pasien</h5>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="p-1">
                                    <!-- <b>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada:</b> -->
                                    <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['edukasi_pasien']; ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                } ?>


                <div class="row">
                    <div class="col-md-4 text-center">
                        <div>Sampangan, <?= tanggal_indo(date('Y-m-d')); ?></div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <div></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div></div>
                        <br>
                        <div class="mb-2">Dokter</div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <div></div>
                        <br>
                        <div class="mb-2">Penerima Penjelasan</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4" align="center">
                        <div class="mb-1">
                            <div id="qrcode"></div>
                        </div>
                        <p class="p-0 m-0 py-1" id="qrcode_name">(<?= @$resumeMedis['val']['dokter']; ?>)</p>
                        <p><i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i></p>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4" align="center">
                        <div class="mb-1">
                            <div id="qrcode1"></div>
                        </div>
                        <p class="p-0 m-0 py-1" id="">(<?= @$resumeMedis['val']['nama']; ?>)</p>
                    </div>
                </div>
            </div>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        </body>
        <script>
            let val = <?= json_encode($resumeMedis['val']); ?>;
            let sign = <?= json_encode($resumeMedis['sign']); ?>;

            sign = JSON.parse(sign)
        </script>
        <script>
            $.each(sign, function(key, value) {
                console.log(value)
                if (value.user_type == 1 && value.isvalid == 1) {
                    var qrcode = new QRCode(document.getElementById("qrcode"), {
                        text: value.sign_path,
                        width: 70,
                        height: 70,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });
                    $("#qrcode_name").html(`(${value.fullname??value.user_id})`)
                } else if (value.user_type == 2 && value.isvalid == 1) {
                    var qrcode1 = new QRCode(document.getElementById("qrcode1"), {
                        text: value.sign_path,
                        width: 70,
                        height: 70,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });
                    // $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)
                }
            })
        </script>

        </html>
    </div>
<?php elseif ($type === 'INV'): ?>
    <div class="page-break portrait">

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
                            <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                        </div>
                        <div class="col mt-2">
                            <h3><?= @$kop['name_of_org_unit'] ?></h3>
                            <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                                <?= @$kop['fax'] ?? "-" ?>,
                                <?= @$kop['kota'] ?? "-" ?></p>
                            <p><?= @$kop['sk'] ?? "-" ?></p>
                        </div>
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <h4 class="text-center pt-2">INVOICE PASIEN</h4>
                    </div>
                    <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                    <div class="table-container-split">
                        <table>
                            <!-- kiri -->
                            <tr>
                                <th>Nama</th>
                                <td colspan='3'>
                                    <span id="name_patient-inv"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>NO.RM</th>
                                <td>
                                    <span id="no_rm-inv"></span>
                                </td>
                                <th>Status</th>
                                <td>
                                    <span id="type-pay-inv"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <div>Alamat</div>
                                </th>
                                <td colspan='3'>
                                    <span id="address-inv"></span>
                                </td>
                            </tr>

                        </table>
                        <table class="text-end">
                            <!--kanan -->
                            <tr>
                                <th>
                                    Tgl Lahir
                                </th>
                                <td>
                                    <span id="birthday-inv"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    No.Peserta
                                </th>
                                <td>
                                    <span id="nobpjs-inv"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Tanggal Masuk
                                </th>
                                <td>
                                    <span id="indate-inv"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Tanggal Keluar
                                </th>
                                <td>
                                    <span id="exitdate-inv"></span>
                                </td>
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
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="fw-bold text-end">Grand Total</td>
                                    <td class="fw-bold text-end" id="total-all-pay-inv"></td>
                                </tr>
                            </tfoot>
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


        </body>

        <script>
            $(document).ready(function() {

                $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)
                <?php $dataJsonTables2 = json_encode($treatment_bill); ?>
                let dataTable1 = <?php echo $dataJsonTables2; ?>;

                dataRenderTablesinvorat1();
                renderDataPatientinvorat1();

            })

            function formatCurrency(total) {

                var components = total.toFixed(2).toString().split(".");

                components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                return components.join(",");
            }

            const dataRenderTablesinvorat1 = () => {
                <?php $dataJsonTables = json_encode($treatment_bill); ?>
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

            };


            const renderDataPatientinvorat1 = () => {
                <?php $dataJson = json_encode($visit); ?>
                let data = <?php echo $dataJson; ?>;

                $("#no_rm-inv").html(data?.no_registration)
                $("#address-inv").html(data?.contact_address)
                $("#birthday-inv").html(data?.date_of_birth ? moment(data?.date_of_birth).format("DD-MM-YYYY") : "")
                $("#nobpjs-inv").html(data?.pasien_id)
                $("#indate-inv").html(data?.in_date)
                $("#exitdate-inv").html(data?.exit_date)


                // render patient 
                $("#name_patient-inv").html(data?.name_of_pasien)
                $("#type-pay-inv").html(data?.name_of_status_pasien)
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

<?php elseif ($type === 'PNJG'): ?>
    <?php if (!empty($lab)) : ?>
        <div class="page-break portrait">

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
                                <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                            </div>
                            <div class="col mt-2 text-center">
                                <h3><?= @$kop['name_of_org_unit'] ?></h3>
                                <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                                    <?= @$kop['fax'] ?? "-" ?>,
                                    <?= @$kop['kota'] ?? "-" ?></p>
                                <p><?= @$kop['sk'] ?? "-" ?></p>
                            </div>
                            <div class="col-auto" align="center">

                                <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                            </div>
                        </div>
                        <br>
                        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                        <div class="row">
                            <h6 class="text-center pt-2">HASIL PEMERIKSAAN LABORATORIUM</h6>
                        </div>
                        <div class="table-container-split">
                            <table>
                                <!-- kiri -->
                                <!-- <tr>
                            <td>No.Lab / No.RM</td>
                            <td>:</td>
                            <td>
                                <div id="noLab_rm"></div>
                            </td>
                        </tr> -->
                                <tr>
                                    <th>Nama Pasien</th>
                                    <th>:</th>
                                    <th>
                                        <div id="name_patient"></div>
                                    </th>
                                </tr>
                                <tr>
                                    <td>J. Kelamin</td>
                                    <td>:</td>
                                    <td>
                                        <div id="gender_patient"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tgl. Lahir - Umur</td>
                                    <td>:</td>
                                    <td>
                                        <div id="date_age"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No.Telp.</td>
                                    <td>:</td>
                                    <td>
                                        <div id="no_tlp"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat Pasien</td>
                                    <td>:</td>
                                    <td>
                                        <div id="adresss_patient"></div>
                                    </td>
                                </tr>
                            </table>

                            <table>
                                <!--kanan -->
                                <tr>
                                    <td>Tgl.Priksa</td>
                                    <td>:</td>
                                    <td>
                                        <div id="date_check"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cara Bayar</td>
                                    <td>:</td>
                                    <td>
                                        <div id="payment_method"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dokter Pengirim</td>
                                    <td>:</td>
                                    <td>
                                        <div id="doctor_send"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kelas - Cara Bayar</td>
                                    <td>:</td>
                                    <td>
                                        <div id="class_pay"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ruang/ Poliklinik</td>
                                    <td>:</td>
                                    <td>
                                        <div id="room_poli"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Diagnosa Klinis</td>
                                    <td>:</td>
                                    <td>
                                        <div id="diagnosa_klinis"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="row">
                            <b class="text-start"><em>Dokter Penanggungjawab: <i id="doctor-responsible-lab"></i></em></b>
                        </div>
                        <table class="table-borderless">
                            <thead class="border" style="vertical-align: text-top;">
                                <tr>
                                    <th style="width: 10%;">Nama pemeriksaan</th>
                                    <th style="width: 5%;">Hasil</th>
                                    <th style="width: 2%;">Flag</th>
                                    <th style="width: 5%;">Satuan</th>
                                    <th style="width: 10%;">Nilai Rujukan</th>
                                    <th style="width: 15%;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="render-tables" class="border">
                            </tbody>
                        </table>

                        <em>Hasil berupa angka menggunakan desimal dengan separator titik
                            <p>H: Hasil Lebih Dari Nilai Rujukan | L: Hasil Kurang Dari Nilai Rujukan | (*): Abnormal | (K):
                                Hasil
                                Nilai Kritis</p>
                        </em>

                        <div id="tindakan_medis"></div>

                        <div class="row mb-2">
                            <div class="col-3" align="center">
                                <br>
                                <div>Approve & Cetak</div>
                                <div id="qrcode-container">
                                    <div id="qrcode"></div>
                                </div>
                                <div id="datetime-now-valid"></div>
                            </div>
                            <div class="col"></div>
                            <div class="col-3" align="center">
                                <div>Diotorasi oleh:<br> Quality Validator</div>
                                <div>
                                    <div class="pt-2 pb-2" id="qrcode1"></div>
                                </div>
                                <div id="validator-ttd"></div>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- Optional JavaScript; choose one of the two! -->

                <!-- Option 1: Bootstrap Bundle with Popper -->


            </body>

            <script>
                $(document).ready(function() {
                    dataRenderTables1Laborat();
                    renderDataPatient1Laborat();

                })

                const dataRenderTables1Laborat = () => {
                    <?php $dataJsonTables = json_encode($lab); ?>
                    let dataTable = <?php echo $dataJsonTables; ?>;

                    const diagnosaList = [];
                    dataTable?.data?.forEach((item) => {
                        if (item.diagnosa_desc !== null && !diagnosaList.includes(item.diagnosa_desc)) {
                            diagnosaList.push(item.diagnosa_desc);
                        }
                    });

                    let result;
                    if (diagnosaList.length === 0) {
                        result = "";
                    } else if (diagnosaList.length === 1) {
                        result = diagnosaList;
                    } else {
                        result = diagnosaList.join(" ,<br>");
                    }

                    $("#diagnosa_klinis").html(result);
                    let groupedData = {};

                    dataTable?.data?.forEach(e => {
                        if (e.tarif_name?.toLowerCase().includes("antigen")) {
                            $("#tindakan_medis").html(`<h6>Expertise :</h6>
                    <p>Note: Rapid Antigen SARS-CoV-2
                        * Spesimen : Swab Nasofaring/ Orofaring
                        * Hasil negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen di bawah level deteksi alat
                        * Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih berisiko menularkan
                        ke orang lain,
                        disarankan tes ulang atau tes konfirmasi dengan NAAT (Nucleic Acid Amplification Tests), bila
                        probabilitas pretes relatif tinggi,
                        terutama bila pasien bergejala atau diketahui memikili kontak dengan orang yang terkonfirmasi COVID-19
                    </p>`);
                        }
                        if (!groupedData[e.nolab_lis]) {
                            groupedData[e.nolab_lis] = {};
                        }

                        if (!groupedData[e.nolab_lis][e.norm]) {
                            groupedData[e.nolab_lis][e.norm] = {};
                        }

                        if (!groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan]) {
                            groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan] = {};
                        }

                        if (!groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name]) {
                            groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name] = [];
                        }

                        groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name].push(e);
                    });

                    let dataResultTable = '';
                    let isFirstGroup = true;

                    for (let nolabLis in groupedData) {
                        if (groupedData.hasOwnProperty(nolabLis)) {
                            for (let norm in groupedData[nolabLis]) {
                                if (groupedData[nolabLis].hasOwnProperty(norm)) {

                                    const firstItem = groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[0]]
                                        [Object.keys(groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[0]])[
                                            0]][0];

                                    const formattedCheckDate = moment(firstItem?.tgl_periksa).format("DD/MM/YYYY HH:mm");
                                    const formattedSampleDate = moment(firstItem?.tgl_hasil).format("DD/MM/YYYY HH:mm");

                                    if (!isFirstGroup) {
                                        dataResultTable += `<tr>
                                                <td colspan="6">
                                                    <hr style="border-top: 2px solid #000;">
                                                </td>
                                            </tr>`;
                                    }

                                    dataResultTable += `<tr>
                                            <td colspan="6">
                                                <strong>No. Lab: ${nolabLis} / RM: ${norm}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><strong class="fst-italic"><u>
                                                Tgl.Priksa: ${formattedCheckDate} Tgl. Sampel :${formattedSampleDate}</u></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <hr style="border-top: 1px dashed #ddd;">
                                            </td>
                                        </tr>`;

                                    for (let kelPemeriksaan in groupedData[nolabLis][norm]) {
                                        if (groupedData[nolabLis][norm].hasOwnProperty(kelPemeriksaan)) {
                                            dataResultTable += `<tr>
                                <td colspan="6"><strong>${kelPemeriksaan}</strong></td>
                            </tr>`;

                                            for (let tarifName in groupedData[nolabLis][norm][kelPemeriksaan]) {
                                                if (groupedData[nolabLis][norm][kelPemeriksaan].hasOwnProperty(tarifName)) {
                                                    dataResultTable += `<tr>
                                        <td colspan="6" style="padding-left: 20px;"><strong>${tarifName}</strong></td>
                                    </tr>`;

                                                    groupedData[nolabLis][norm][kelPemeriksaan][tarifName].forEach(e => {
                                                        dataResultTable += `<tr>
                                                    <td style="padding-left: 40px;">${e.parameter_name}</td>
                                                    <td>
                                                        ${(e.flag_hl?.trim() || '') === '' ? e.hasil : 
                                                            ['L', 'H', 'K', '(*)'].includes(e.flag_hl.trim()) ? `<b class="fw-bold">${e.hasil}</b>` : 
                                                            (e.flag_hl.trim().includes('K') ? `<b style="color:red;">${e.hasil}</b>` : 
                                                            e.hasil)}
                                                    </td>

                                                    <td>${(e.flag_hl?.trim() || '') === '' ? '-' : 
                                                            (e.flag_hl?.trim().includes('K') ? `<b style="color:red;">${e.flag_hl.trim()}</b>` :
                                                            ['L', 'H', 'K' , '(*)'].includes(e.flag_hl?.trim()) ? `<b class="fw-bold">${e.flag_hl.trim()}</b>` : 
                                                            e.flag_hl.trim())}
                                                    </td>
                                                    <td>${!e.satuan? "-":e.satuan}</td>
                                                    <td>${!e.nilai_rujukan? "-":e.nilai_rujukan}</td>
                                                    <td>${!e.catatan? "-": e.catatan === "-" ? !e.rekomendasi ? "-" : e.rekomendasi : e.catatan }</td>

                                                </tr>`;
                                                    });
                                                }
                                            }
                                        }
                                    }

                                    isFirstGroup = false;
                                }
                            }
                        }

                        $("#render-tables").html(dataResultTable);

                        $("#noLab_rm").html(dataTable?.data[0]?.nolab_lis + '/ ' + dataTable?.data[0]?.norm)
                        $("#name_patient").html(dataTable?.data[0]?.nama)
                        $("#adresss_patient").html(dataTable?.data[0]?.alamat)
                        $("#date_check").html(moment(dataTable?.data[0]?.tgl_hasil).format("DD/MM/YYYY HH:mm:ss"))
                        $("#payment_method").html(dataTable?.data[0]?.cara_bayar_name)
                        $("#doctor_send").html(dataTable?.data[0]?.pengirim_name)
                        $("#room_poli").html(dataTable?.data[0]?.ruang_name)
                        $("#class_pay").html(`${dataTable?.data[0]?.kelas_name} - ${dataTable?.data[0]?.cara_bayar_name}`)
                        $("#datetime-now-valid").html(
                            `${moment(dataTable?.data[0]?.tgl_hasil_selesai).format("DD/MM/YYYY HH:mm:ss")}`)



                        var qrcode = new QRCode(document.getElementById("qrcode"), {
                            text: `https://www.pkusampangan.com/`, // Your text here
                            width: 70,
                            height: 70,
                            colorDark: "#000000",
                            colorLight: "#ffffff",
                            correctLevel: QRCode.CorrectLevel.H // High error correction
                        });

                        function addImageToQRCode1() {
                            var qrElement = document.getElementById("qrcode");
                            var qrCanvas = qrElement.querySelector('canvas');

                            var img = new Image();
                            img.src = '<?= base_url() ?>assets/img/logo.png';

                            img.onload = function() {
                                var canvas = document.createElement('canvas');
                                var ctx = canvas.getContext('2d');

                                canvas.width = qrCanvas.width;
                                canvas.height = qrCanvas.height;

                                ctx.drawImage(qrCanvas, 0, 0, canvas.width, canvas.height);

                                var imgSize = Math.min(canvas.width, canvas.height) * 0.3;
                                var imgX = (canvas.width - imgSize) / 2;
                                var imgY = (canvas.height - imgSize) / 2;

                                ctx.drawImage(img, imgX, imgY, imgSize, imgSize);

                                qrElement.innerHTML = '';
                                qrElement.appendChild(canvas);
                            };
                        }

                        addImageToQRCode1();
                    }
                }
                const renderDataPatient1Laborat = () => {
                    <?php $dataJson = json_encode($lab); ?>
                    let data = <?php echo $dataJson; ?>
                    // render patient 
                    $("#gender_patient").html(data?.visit?.name_of_gender)
                    $("#doctor-responsible-lab").html(data?.visit?.doctor_responsible)

                    $("#date_age").html(moment(data?.visit?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.visit?.age)
                    $("#no_tlp").html(data?.visit?.phone_number)
                    $("#validator-ttd").html(data?.visit?.valid_users_p)

                    var qrcode = new QRCode(document.getElementById("qrcode1"), {
                        text: `${data?.visit?.valid_users_p}`, // Your text here
                        width: 70,
                        height: 70,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });
                }
            </script>

            </html>

        </div>
    <?php endif; ?>
    <?php if (!empty($radiologi_cetak)) : ?>

        <!-- ========================================================== -->
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
                                <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                            </div>
                            <div class="col mt-2 text-center">
                                <h3><?= @$kop['name_of_org_unit'] ?></h3>
                                <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                                    <?= @$kop['fax'] ?? "-" ?>,
                                    <?= @$kop['kota'] ?? "-" ?></p>
                                <p><?= @$kop['sk'] ?? "-" ?></p>
                            </div>
                            <div class="col-auto" align="center">

                                <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">

                            </div>
                        </div>
                        <br>

                        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                        <div class="row">
                            <h6 class="text-center pt-2">HASIL PEMERIKSAAN RADIOLOGI</h6>
                        </div>
                        <div class="table-container-split">
                            <table>
                                <!-- kiri -->
                                <tr>
                                    <td>No.RM</td>
                                    <td>:</td>
                                    <td>
                                        <div id="no_rm"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama Pasien</td>
                                    <td>:</td>
                                    <td>
                                        <div id="name_patient"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>JK/Umur</td>
                                    <td>:</td>
                                    <td>
                                        <div id="gender_patient_age"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat Pasien</td>
                                    <td>:</td>
                                    <td>
                                        <div id="adresss_patient"></div>
                                    </td>
                                </tr>
                            </table>

                            <table>
                                <!--kanan -->
                                <tr>
                                    <td>No.Pemeriksaan</td>
                                    <td>:</td>
                                    <td>
                                        <div id="no_check"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td>
                                        <div id="date_check"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dokter Pengirim</td>
                                    <td>:</td>
                                    <td>
                                        <div id="doctor_send"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <table class="table-borderless">
                            <thead class="border" style="vertical-align: text-top;">
                                <tr>
                                    <td style="width: 15%;">Pemeriksaan : </td>
                                    <td>
                                        <div id="pemeriksaan-val"></div>
                                    </td>
                                </tr>
                            </thead>
                        </table>

                        <div><b>Dengan Hormat</b></div>
                        <p id="dengan-hormat-val"></p>
                        <div><b>Catatan/Rekomendasi</b></div>
                        <p id="note-val"></p>


                        <div class="row mb-2">
                            <div class="col-3" align="center">
                            </div>
                            <div class="col"></div>
                            <div class="col-3" align="center">
                                <div>Pemeriksa</div>
                                <div>
                                    <div class="pt-2 pb-2" id="qrcode-rad"></div>
                                </div>
                                <div id="validator-ttd-rad"></div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Optional JavaScript; choose one of the two! -->

                <!-- Option 1: Bootstrap Bundle with Popper -->

            </body>



            <script>
                $(document).ready(function() {
                    $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

                    dataRenderTables1();
                    renderDataPatient1();

                })


                const dataRenderTables1 = () => {
                    <?php $dataJsonTables = json_encode(@$radiologi_cetak); ?>
                    <?php $dataJsonTreat = json_encode(@$get_treat); ?>

                    let dataTable = <?php echo $dataJsonTables; ?>;
                    let dataTreat = <?php echo $dataJsonTreat; ?>;
                    let note_valrad = ''
                    let result_valrad = ''
                    let result_rad = ''


                    //     // render patient -
                    $("#no_rm").html(dataTable[0]?.no_registration)
                    $("#name_patient").html(dataTable[0]?.thename)
                    $("#gender_patient_age").html(dataTable[0]?.gender === "2" ? "Perempuan" : dataTable[0]?.gender === "2" ?
                        "Laki - Laki" : !dataTable[0]?.gender ? "" : dataTable[0]?.gender + '/' +
                        dataTable[0].ageyear + ' Th' + dataTable[0].agemonth + ' Bln' + dataTable[0].ageday + ' Hr')
                    $("#adresss_patient").html(dataTable[0]?.theaddress)
                    $("#no_check").html(dataTable[0]?.nota_no)
                    $("#date_check").html(moment(dataTable[0]?.pickup_date).format("DD-MMM-YYYY HH:ss"))
                    $("#doctor_send").html(dataTable[0]?.doctor_from)



                    dataTable?.forEach((item, index) => {
                        note_valrad += `<p>${index+1}. ${item?.conclusion}</p>`;
                        result_rad += `<p>${index+1}. ${item?.result_value}</p>`;
                        let matchedTreat = dataTreat.find(treat => treat.tarif_id === item?.tarif_id);

                        if (matchedTreat) {
                            result_valrad += `<p>${index+1}.  ${matchedTreat.tarif_name}</p>`;
                        } else {

                            result_valrad += `<p>${index+1}.  ${item?.tarif_id}</p>`;
                        }
                    });

                    $("#dengan-hormat-val").html(result_rad)
                    $("#pemeriksaan-val").html(result_valrad ?? "")
                    $("#note-val").html(note_valrad ?? "")
                    $("#validator-ttd-rad").html(dataTable[0]?.doctor)



                    var qrcode = new QRCode(document.getElementById("qrcode-rad"), {
                        text: `${dataTable[0]?.doctor}`, // Your text here
                        width: 70,
                        height: 70,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });


                }

                const renderDataPatient1 = () => {
                    <?php $dataJson = json_encode($visit); ?>
                    let data = <?php echo $dataJson; ?>;
                    // render patient 
                    $("#gender_patient").html(data?.name_of_gender)
                    $("#date_age").html(moment(data?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.age)
                    $("#no_tlp").html(data?.phone_number)
                    $("#diagnosa_klinis").html(data?.diagnosa)
                }
            </script>


            <script type="text/javascript">
                // //window.print();
            </script>

            </html>
        </div>
    <?php endif; ?>

<?php else: ?>

    <div class="page-break">

        <body>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-6">
                        <div>
                            <img src="<?= base_url() ?>assets/img/logo-bpjs.jpg" alt="BPJS KESEHATAN" style="width: 260px;">
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
                                        <span>Laki- Laki</span>
                                    <?php } else { ?>
                                        <span>Perempuan</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="poli_tujuan" class="col-sm-4 col-form-label">Poli Tujuan</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$sep['json']['name_of_clinic']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="asal_faskes" class="col-sm-4 col-form-label">Asal Faskes</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?= @$kop['display'] ?> - <?= @$kop['kota'] ?></span>
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
                            <h6 class="text-center"><b>SURAT ELIGIBILITAS PESERTA <br> <?= @$kop['display'] ?></b></h6>
                        </div>
                        <form action="" method="">
                            <div class="form-group row mt-2">
                                <label for="peserta" class="col-sm-4 col-form-label">Peserta</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7 align-items-center">
                                    <!-- <span>Anak</span> -->
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
                                    <h6><?= @$kop['display'] ?>,
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
                            <h6 class="text-center"><b>SURAT BUKTI PELAYANAN <br> NAMA RS : <?= @$kop['display'] ?> KODE RS :
                                    <?= @$kop['other_code'] ?> KELAS RS : <?= @$kop['org_type'] ?>
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

                            <!-- <div class="col-3">
                            <table class="table table-bordered" style="border: solid black;">
                                <tbody>
                                    <tr style="height: 15px;">
                                        <td class="text-center">
                                            <label class="text-uppercase">urologi</label>
                                        </td>
                                    </tr>
                                    <tr style="height: 25px;">
                                        <td class="text-center">
                                            <label class="text-uppercase fs-2"
                                                style="font-family: 'Times New Roman', Times, serif;">
                                                <b><?php echo @$sep['json']['urutan']; ?></b>
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
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
                                    <h6><?= @$kop['display'] ?>,............. <br>Dokter Pemeriksa</h6>
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
                /* @media print {
            @page {
                margin: 20px;
                size: auto;
            }
        } */
            </style>

            <script>
                //window.print();
            </script>

        </body>

    </div>

    <!-- ========================================================== -->
    <div class="page-break portrait">

        <body>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-6">
                        <div>
                            <img src="<?= base_url() ?>assets/img/logo-bpjs.jpg" alt="BPJS KESEHATAN" style="width: 260px;">
                        </div>
                        <form action="" method="">
                            <div class="form-group row mt-2 align-items-center">
                                <label for="no_sep" class="col-sm-4 col-form-label">No. Kartu</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$skdp['json']['no_bpjs']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="tgl_sep" class="col-sm-4 col-form-label">Nama Peserta</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-4">
                                    <span><?php echo @$skdp['json']['nama']; ?></span>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-4">
                                    <span><?php echo @$skdp['json']['date_of_birth']; ?>
                                        <?php echo @$skdp['json']['umur']; ?></span>
                                </div>
                            </div>



                            <div class="form-group row align-items-center">
                                <label for="diagnosa_awal" class="col-sm-4 col-form-label">Diagnosa</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$skdp['json']['diagnosis']; ?></span>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="catatan" class="col-sm-4 col-form-label">Rencana Kontrol</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7">
                                    <span><?php echo @$skdp['json']['tgl_kontrol_selanjutnya']; ?></span>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <p>Demikian Atas Bantuannya, diucapkan Banyak Terimakasih

                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="row">
                            <h6 class="text-center"><b>SURAT RENCANA KONTROL <br> <?= @$kop['display'] ?></b></h6>
                        </div>
                        <form action="" method="">
                            <div class="form-group row mt-2">
                                <label for="no" class="col-sm-4 col-form-label">No</label>
                                <div class="col-sm-1 d-flex align-items-center">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-7 align-items-center">
                                    <span><?php echo @$skdp['json']['nosep']; ?></span>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>



            <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>


            <script>
                //window.print();
            </script>

        </body>

    </div>

    <!-- ========================================================== -->

    <div class="page-break">
        <!doctype html>
        <html lang="en">

        <body>
            <div class="container-fluid mt-5">

                <!-- template header -->
                <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php", ['key' => ['title' => 'Resume Pasien Pulang']]) ?>
                <!-- end of template header -->
                <div class="row">
                    <h5 class="text-start">Subjektif (S)</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Keluhan Utama (Autoanamnesis)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['anamnesis']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Penyakit Sekarang</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_sekarang']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Penyakit Dahulu</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_dahulu']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Riwayat Penyakit Keluarga</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_keluarga']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Alergi (Non Obat)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alergi_nonobat']; ?></p>
                                <b>Riwayat Alergi (Obat)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alergi_obat']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Obat Yang Dikonsumsi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_obat_dikonsumsi']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Riwayat Kehamilan dan Persalinan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_kehamilan']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Diet</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_diet']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Riwayat Imunisasi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_imunisasi']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="p-1">
                                <b>Riwayat Kebiasaan (Negatif)</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alkohol']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Obyektif (O)</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td colspan="4" class="p-1"><b>Vital Sign</b></td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Tekanan Darah</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= (int) ($resumeMedis['val']['tensi_atas'] ?? 0)  ?>/<?= (int) ($resumeMedis['val']['tensi_bawah'] ?? 0); ?>
                                    mmHg</p>
                            </td>
                            <td class="p-1">
                                <b>Denyut Nadi</b>
                                <p class="m-0 mt-1 p-0"><?= (int) ($resumeMedis['val']['nadi'] ?? 0) ?> x/m</p>
                            </td>
                            <td class="p-1">
                                <b>Suhu Tubuh</b>
                                <p class="m-0 mt-1 p-0"><?= (int) ($resumeMedis['val']['suhu'] ?? 0)  ?> °C</p>
                            </td>
                            <td class="p-1">
                                <b>Respiration Rate</b>
                                <p class="m-0 mt-1 p-0"><?= (int) ($resumeMedis['val']['respiration'] ?? 0)  ?> x/m</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Berat Badan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['berat']; ?> kg</p>
                            </td>
                            <td class="p-1">
                                <b>Tinggi Badan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['tinggi']; ?> cm</p>
                            </td>
                            <td class="p-1">
                                <b>SpO2</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['spo2']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>BMI</b>
                                <p class="m-0 mt-1 p-0"><?= number_format($resumeMedis['val']['imt'] ?? 0, 2, '.', ''); ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php if (!empty($resumeMedis['val']['gcs_desc'])) { ?>

                    <?php
                    if ($resumeMedis['visit']['ageyear'] < 18) { ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="p-1">
                                        <b><i>pGCS / Tingkat Kesadaran</i></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>pGCS E / Respon Membuka Mata :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_e'] . '] ' . @$resumeMedis['val']['gsc_e_desc']; ?>.</span>
                                                <b>pGCS V / Respon Verbal Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_v'] . '] ' . @$resumeMedis['val']['gsc_v_desc']; ?>.</span>
                                                <b>pGCS M / Respon Motorik Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_m'] . '] ' . @$resumeMedis['val']['gsc_m_desc']; ?>.</span>
                                            </div>

                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>Score pGCS : </b>
                                                <span class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['gcs_desc']; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <b>Keadaan Umum</b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['keadaanumum']) ? @$resumeMedis['val']['keadaanumum'] : '-'; ?>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    <?php } else { ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="p-1">
                                        <b><i>GCS / Tingkat Kesadaran</i></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>GCS E / Respon Membuka Mata :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_e'] . '] ' . @$resumeMedis['val']['gsc_e_desc']; ?>.</span><br>
                                                <b>GCS V / Respon Verbal Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_v'] . '] ' . @$resumeMedis['val']['gsc_v_desc']; ?>.</span><br>
                                                <b>GCS M / Respon Motorik Terbaik :</b> <span
                                                    class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_m'] . '] ' . @$resumeMedis['val']['gsc_m_desc']; ?>.</span>
                                            </div>

                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                <b>Score GCS : </b>
                                                <span class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['gcs_desc']; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">
                                        <b>Keadaan Umum</b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['keadaanumum']) ? @$resumeMedis['val']['keadaanumum'] : '-'; ?>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                <?php } ?>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width: 50%;">
                                <b>Skala Nyeri</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['pain_score']; ?></p>
                            </td>
                            <td class="p-1" style="width: 50%;">
                                <b>Resiko Jatuh</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['fall_score']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if ($resumeMedis['visit']['specialist_type_id'] === "1.12"): ?>
                    <table class="table table-bordered" id="statusDermatologiShow">
                        <tbody>
                            <tr>
                                <td colspan="4" class="fw-bold">Status Dermatologik</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <b class="col-12">I. Inspeksi</b>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td class="fw-bold">Lokasi</td>
                                                <td class="fw-bold">UKK</td>
                                                <td class="fw-bold">Distribusi</td>
                                                <td class="fw-bold">Konfigurasi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_location'] ?></td>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_ukk'] ?></td>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_distribution'] ?></td>
                                                <td><?= @$resumeMedis['val']['kulit']['sd_ins_configuration'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Palpasi</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sd_palpation'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Lain-Lain</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sd_others'] ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <b class="col-12">Status Venerologik</b>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Inspeksi</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sv_inspection'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <b class="col-12">Palpasi</b>
                                        <span class="col-12"><?= @$resumeMedis['val']['kulit']['sv_palpation'] ?></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
                <?php
                if ($resumeMedis['visit']['specialist_type_id'] === "1.16"): ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Var/NRS</th>
                                <th>Pupil Kiri</th>
                                <th>Pupil kanan</th>
                            </tr>
                            <tr>
                                <td><?= @$resumeMedis['val']['saraf']['vas_nrs'] ?></td>
                                <td>
                                    <b>Diameter :</b><?= @$resumeMedis['val']['saraf']['left_diameter'] ?>
                                    <br><b>Refleks Cahaya :</b><?= @$resumeMedis['val']['saraf']['left_light_reflex'] ?>
                                    <br><b>Kornea:</b><?= @$resumeMedis['val']['saraf']['left_cornea'] ?>
                                    <br><b>Isokor Anisokor :</b><?= @$resumeMedis['val']['saraf']['left_isokor_anisokor'] ?>
                                </td>
                                <td>
                                    <b>Diameter :</b><?= @$resumeMedis['val']['saraf']['right_diameter'] ?>
                                    <br><b>Refleks Cahaya :</b><?= @$resumeMedis['val']['saraf']['right_light_reflex'] ?>
                                    <br><b>Kornea:</b><?= @$resumeMedis['val']['saraf']['right_cornea'] ?>
                                    <br><b>Isokor Anisokor :</b><?= @$resumeMedis['val']['saraf']['right_isokor_anisokor'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Leher</th>
                                <th>Gerak</th>
                                <th>Kekuatan</th>
                            </tr>
                            <tr>
                                <td>
                                    <b>Kaku kuduk :</b><?= @$resumeMedis['val']['saraf']['stiff_neck'] ?>
                                    <br><b>Meningeal Sign :</b><?= @$resumeMedis['val']['saraf']['meningeal_sign'] ?>
                                    <br><b>Brudzinki I-IV :</b><?= @$resumeMedis['val']['saraf']['brudzinki_i_iv'] ?>
                                    <br><b>Kernig Sign:</b><?= @$resumeMedis['val']['saraf']['kernig_sign'] ?>
                                    <br><b>Dolls eye phenomena :</b><?= @$resumeMedis['val']['saraf']['dolls_eye_phenomenon'] ?>
                                    <br><b>Vertebra :</b><?= @$resumeMedis['val']['saraf']['vertebra'] ?>
                                    <br><b>Extremity :</b><?= @$resumeMedis['val']['saraf']['extremity'] ?>
                                </td>
                                <td>
                                    <b>Gerak Atas Kiri :</b><?= @$resumeMedis['val']['saraf']['motion_upper_left'] ?>
                                    <br><b>Gerak Atas Kanan :</b><?= @$resumeMedis['val']['saraf']['motion_upper_right'] ?>
                                    <br><b>Gerak Bawah Kiri :</b><?= @$resumeMedis['val']['saraf']['motion_lower_left'] ?>
                                    <br><b>Gerak Bawah Kanan :</b><?= @$resumeMedis['val']['saraf']['motion_lower_right'] ?>
                                </td>
                                <td>
                                    <b>Kekuatan Atas Kiri :</b><?= @$resumeMedis['val']['saraf']['strength_upper_left'] ?>
                                    <br><b>Kekuatan Atas Kanan :</b><?= @$resumeMedis['val']['saraf']['strength_upper_right'] ?>
                                    <br><b>Kekuatan Bawah Kiri:</b><?= @$resumeMedis['val']['saraf']['strength_lower_left'] ?>
                                    <br><b>Kekuatan Bawah Kanan
                                        :</b><?= @$resumeMedis['val']['saraf']['strength_lower_right'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>

                <table class="table table-bordered">
                    <tbody>
                        <?php
                        // check jika data lokalis ada atau tidak
                        if (!empty($resumeMedis['lokalis2'])) {
                            // jika ada maka lakukan perulangan untuk menampilkan data
                            foreach ($resumeMedis['lokalis2'] as $key => $value) {
                                // jika data lokalis memiliki value score = 2 maka tampilkan
                                if ($value['value_score'] == 2) {
                                    // jika key pada data adalah ganjil
                                    if (($key + 1) % 2 != 0) {
                                        // jika data bukan data terakhir 
                                        if ($key + 1 != count($resumeMedis['lokalis2'])) {
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
                        <?php
                        if (!empty($resumeMedis['lokalis'])) {
                            foreach ($resumeMedis['lokalis'] as $key => $value) {
                                if ($value['value_score'] == 3) {
                                    $filepath = WRITEPATH . 'uploads/lokalis/' . $value['value_detail'];

                                    if (file_exists($filepath)) {
                                        $filedata = file_get_contents($filepath);
                                        $filedata64 = base64_encode($filedata);
                                        $selectlokalis[$key]['filedata64'] = $filedata64;

                                        echo '<tr>';
                                        echo '<th>' . $value['nama_lokalis'] . '</th>';
                                        echo '<td style="width: 50%;">';
                                        echo '<img class="mt-3" src="data:image/jpeg;base64,' . $filedata64 . '" width="400px">';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                if ($resumeMedis['visit']['specialist_type_id'] === "1.10"): ?>
                    <?php
                    if (!empty($resumeMedis['val']['mata']) && is_array($resumeMedis['val']['mata'])) {
                        $result = [];
                        foreach ($resumeMedis['val']['mata'] as $item) {
                            $nama_lokalis = str_replace(["DEXTRA", "SINISTRA"], "", $item['nama_lokalis']);
                            $nama_lokalis = trim($nama_lokalis);
                            $value_info = $item['value_info'];
                            $value_detail = $item['value_detail'];

                            if (isset($result[$nama_lokalis])) {
                                $result[$nama_lokalis][$value_info] = $value_detail;
                            } else {
                                $result[$nama_lokalis] = [
                                    "SINISTRA" => $value_info === "SINISTRA" ? $value_detail : null,
                                    "nama_lokalis" => $nama_lokalis,
                                    "DEXTRA" => $value_info === "DEXTRA" ? $value_detail : null
                                ];
                            }
                        }

                        $resultChunks = array_chunk($result, ceil(count($result) / 2), true);
                        echo "<div style='display: flex; gap: auto;'>";

                        foreach ($resultChunks as $chunk) {
                            echo "<div style='flex: 1;'>";
                            echo "<table border='1' class='table table-bordered'>";
                            echo "<tr><td class='fw-bold'>Oculus Dextra</td><td class='fw-bold text-center'>Keterangan</td><td class='fw-bold'>Oculus Sinistra</td></tr>";
                            foreach ($chunk as $row) {
                                echo "<tr>";
                                echo "<td>" . ($row['DEXTRA'] ?? '') . "</td>";
                                echo "<td class='text-center'>{$row['nama_lokalis']}</td>";
                                echo "<td>" . ($row['SINISTRA'] ?? '') . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
                        }

                        echo "</div>";
                    }
                    ?>

                <?php endif; ?>
                <?php if (!empty($resumeMedis['val']['pemeriksaan']) && is_array($resumeMedis['val']['pemeriksaan'])) { ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="p-1" colspan="2">
                                    <b>Catatan Obyektif</b>
                                    <p class="m-0 mt-1 p-0">
                                        <?= !empty(@$resumeMedis['val']['pemeriksaan']) ? @$resumeMedis['val']['pemeriksaan'] : '-'; ?>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <?php if (!empty($resumeMedis['val']['ats_tipe']) && is_array($resumeMedis['val']['ats_tipe'])) { ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="p-1">
                                    <b>Triage</b>
                                    <p class="m-0 mt-1 p-0">
                                        <?= !empty(@$resumeMedis['val']['ats_tipe']) ? @$resumeMedis['val']['ats_tipe'] : '-'; ?>
                                    </p>
                                </td>
                            </tr>
                            <?php if (!empty($resumeMedis['val']['ats_tipe'])): ?>
                                <tr>
                                    <td class="p-1">
                                        <b><?= @$resumeMedis['val']['ats_tipe']; ?></b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['ats_item']) ? @$resumeMedis['val']['ats_item'] : '-'; ?>
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php if (!empty($resumeMedis['val']['hamil']) && ($resumeMedis['val']['hamil'] === "Hamil")): ?>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>Hamil</b>
                                        <p class="m-0 mt-1 p-0">
                                            <?= !empty(@$resumeMedis['val']['hamil']) ? @$resumeMedis['val']['hamil'] : '-'; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>Umur Kehamilan</b>
                                        <p class="m-0 mt-1 p-0"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>G</b>
                                        <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_g']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>P</b>
                                        <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_p']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>A</b>
                                        <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_a']; ?></p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php } ?>


                <div class="row">
                    <h4 class="text-start">Assessment (A)</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Diagnosis</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['namadiagnosa']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Permasalahan Medis</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['masalah_medis']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Penyebab Cidera / Keracunan</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['penyebab_cidera']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start fw-bold">Planning (P)</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <?php if ($resumeMedis['visit']['isrj'] == '0') {
                        ?>
                            <tr>
                                <td class="p-1">
                                    <b>Standing Order</b>
                                    <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['standing_order']; ?></p>
                                </td>
                            </tr>
                        <?php
                        } ?>
                        <tr>
                            <td class="p-1">
                                <b>Target / Sasaran Terapi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['sasaran']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h4 class="text-start">Pemeriksaan Diagnostik Penunjang</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Laboratorium</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= isset($resumeMedis['val']['laboratorium']) ? nl2br($resumeMedis['val']['laboratorium']) : ''; ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Radiologi</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= isset($resumeMedis['val']['radiologi']) ? nl2br($resumeMedis['val']['radiologi']) : ''; ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Farmakoterapi</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= isset($resumeMedis['val']['farmakologia']) ? nl2br($resumeMedis['val']['farmakologia']) : ''; ?>
                                </p>

                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Target / Sasaran Terapi</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['prosedur']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Catatan Procedure</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Standing Order</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['standing_order']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <h5 class="text-start">Rencana Tindak Lanjut</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1">
                                <b>Rencana Tindak Lanjut</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['rencana_tl']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kontrol</b>
                                <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['kontrol']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (@$resumeMedis['val']['edukasi_pasien']) {
                ?>
                    <div class="row">
                        <h5 class="text-start">Edukasi Pasien</h5>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="p-1">
                                    <!-- <b>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada:</b> -->
                                    <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['edukasi_pasien']; ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                } ?>

                <div class="col-md-4 text-start">
                    <div>Sampangan, <?= tanggal_indo(date('Y-m-d')); ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-3" align="center">
                        <br>
                        <div>Dokter</div>
                        <div id="qrcode-container">
                            <div id="qrcodeMedisAll"></div>
                        </div>
                        <p class="p-0 m-0 py-1" id="qrcodeMedis_name">(<?= @$resumeMedis['val']['dokter']; ?>)</p>
                        <p><i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i></p>
                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>Penerima Penjelasan</div>
                        <div>
                            <div id="qrcodeMedis1All"></div>
                        </div>
                        <p class="p-0 m-0 py-1" id="">(<?= @$resumeMedis['val']['nama']; ?>)</p>
                    </div>
                </div>
            </div>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        </body>
        <script>
            let val = <?= json_encode($resumeMedis['val']); ?>;
            let sign = <?= json_encode($resumeMedis['sign']); ?>;

            sign = JSON.parse(sign)
        </script>
        <script>
            $.each(sign, function(key, value) {
                if (value.user_type == 1 && value.isvalid == 1) {
                    var qrcode = new QRCode(document.getElementById("qrcodeMedisAll"), {
                        text: value.sign_path,
                        width: 70,
                        height: 70,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });
                    $("#qrcodeMedis_name").html(`(${value.fullname??value.user_id})`)
                } else if (value.user_type == 2 && value.isvalid == 1) {
                    var qrcode1 = new QRCode(document.getElementById("qrcodeMedis1All"), {
                        text: value.sign_path,
                        width: 70,
                        height: 70,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });
                    // $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)
                }
            })
        </script>

        </html>
    </div>


    <!-- ========================================================== -->
    <?php if (!empty($lab)) : ?>

        <div class="page-break portrait">

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
                                <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                            </div>
                            <div class="col mt-2 text-center">
                                <h3><?= @$kop['name_of_org_unit'] ?></h3>
                                <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                                    <?= @$kop['fax'] ?? "-" ?>,
                                    <?= @$kop['kota'] ?? "-" ?></p>
                                <p><?= @$kop['sk'] ?? "-" ?></p>
                            </div>
                            <div class="col-auto" align="center">

                                <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                            </div>
                        </div>
                        <br>
                        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                        <div class="row">
                            <h6 class="text-center pt-2">HASIL PEMERIKSAAN LABORATORIUM</h6>
                        </div>
                        <div class="table-container-split">
                            <table>
                                <!-- kiri -->
                                <!-- <tr>
                            <td>No.Lab / No.RM</td>
                            <td>:</td>
                            <td>
                                <div id="noLab_rm"></div>
                            </td>
                        </tr> -->
                                <tr>
                                    <th>Nama Pasien</th>
                                    <th>:</th>
                                    <th>
                                        <div id="name_patient"></div>
                                    </th>
                                </tr>
                                <tr>
                                    <td>J. Kelamin</td>
                                    <td>:</td>
                                    <td>
                                        <div id="gender_patient"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tgl. Lahir - Umur</td>
                                    <td>:</td>
                                    <td>
                                        <div id="date_age"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No.Telp.</td>
                                    <td>:</td>
                                    <td>
                                        <div id="no_tlp"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat Pasien</td>
                                    <td>:</td>
                                    <td>
                                        <div id="adresss_patient"></div>
                                    </td>
                                </tr>
                            </table>

                            <table>
                                <!--kanan -->
                                <tr>
                                    <td>Tgl.Priksa</td>
                                    <td>:</td>
                                    <td>
                                        <div id="date_check"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cara Bayar</td>
                                    <td>:</td>
                                    <td>
                                        <div id="payment_method"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dokter Pengirim</td>
                                    <td>:</td>
                                    <td>
                                        <div id="doctor_send"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kelas - Cara Bayar</td>
                                    <td>:</td>
                                    <td>
                                        <div id="class_pay"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ruang/ Poliklinik</td>
                                    <td>:</td>
                                    <td>
                                        <div id="room_poli"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Diagnosa Klinis</td>
                                    <td>:</td>
                                    <td>
                                        <div id="diagnosa_klinis"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="row">
                            <b class="text-start"><em>Dokter Penanggungjawab: <i id="doctor-responsible-lab"></i></em></b>
                        </div>
                        <table class="table-borderless">
                            <thead class="border" style="vertical-align: text-top;">
                                <tr>
                                    <th style="width: 10%;">Nama pemeriksaan</th>
                                    <th style="width: 5%;">Hasil</th>
                                    <th style="width: 2%;">Flag</th>
                                    <th style="width: 5%;">Satuan</th>
                                    <th style="width: 10%;">Nilai Rujukan</th>
                                    <th style="width: 15%;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="render-tables" class="border">
                            </tbody>
                        </table>

                        <em>Hasil berupa angka menggunakan desimal dengan separator titik
                            <p>H: Hasil Lebih Dari Nilai Rujukan | L: Hasil Kurang Dari Nilai Rujukan | (*): Abnormal | (K):
                                Hasil
                                Nilai Kritis</p>
                        </em>

                        <div id="tindakan_medis"></div>

                        <div class="row mb-2">
                            <div class="col-3" align="center">
                                <br>
                                <div>Approve & Cetak</div>
                                <div id="qrcode-container">
                                    <div id="qrcode"></div>
                                </div>
                                <div id="datetime-now-valid"></div>
                            </div>
                            <div class="col"></div>
                            <div class="col-3" align="center">
                                <div>Diotorasi oleh:<br> Quality Validator</div>
                                <div>
                                    <div class="pt-2 pb-2" id="qrcode1"></div>
                                </div>
                                <div id="validator-ttd"></div>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- Optional JavaScript; choose one of the two! -->

                <!-- Option 1: Bootstrap Bundle with Popper -->


            </body>

            <script>
                $(document).ready(function() {
                    dataRenderTablesLaborat();
                    renderDataPatientLaborat();

                })

                const dataRenderTablesLaborat = () => {
                    <?php $dataJsonTables = json_encode($lab); ?>
                    let dataTable = <?php echo $dataJsonTables; ?>;

                    const diagnosaList = [];
                    dataTable?.data?.forEach((item) => {
                        if (item.diagnosa_desc !== null && !diagnosaList.includes(item.diagnosa_desc)) {
                            diagnosaList.push(item.diagnosa_desc);
                        }
                    });

                    let result;
                    if (diagnosaList.length === 0) {
                        result = "";
                    } else if (diagnosaList.length === 1) {
                        result = diagnosaList;
                    } else {
                        result = diagnosaList.join(" ,<br>");
                    }

                    $("#diagnosa_klinis").html(result);
                    let groupedData = {};

                    dataTable?.data?.forEach(e => {
                        if (e.tarif_name?.toLowerCase().includes("antigen")) {
                            $("#tindakan_medis").html(`<h6>Expertise :</h6>
                    <p>Note: Rapid Antigen SARS-CoV-2
                        * Spesimen : Swab Nasofaring/ Orofaring
                        * Hasil negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen di bawah level deteksi alat
                        * Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih berisiko menularkan
                        ke orang lain,
                        disarankan tes ulang atau tes konfirmasi dengan NAAT (Nucleic Acid Amplification Tests), bila
                        probabilitas pretes relatif tinggi,
                        terutama bila pasien bergejala atau diketahui memikili kontak dengan orang yang terkonfirmasi COVID-19
                    </p>`);
                        }
                        if (!groupedData[e.nolab_lis]) {
                            groupedData[e.nolab_lis] = {};
                        }

                        if (!groupedData[e.nolab_lis][e.norm]) {
                            groupedData[e.nolab_lis][e.norm] = {};
                        }

                        if (!groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan]) {
                            groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan] = {};
                        }

                        if (!groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name]) {
                            groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name] = [];
                        }

                        groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name].push(e);
                    });

                    let dataResultTable = '';
                    let isFirstGroup = true;

                    for (let nolabLis in groupedData) {
                        if (groupedData.hasOwnProperty(nolabLis)) {
                            for (let norm in groupedData[nolabLis]) {
                                if (groupedData[nolabLis].hasOwnProperty(norm)) {

                                    const firstItem = groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[0]]
                                        [Object.keys(groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[0]])[
                                            0]][0];

                                    const formattedCheckDate = moment(firstItem?.tgl_periksa).format("DD/MM/YYYY HH:mm");
                                    const formattedSampleDate = moment(firstItem?.tgl_hasil).format("DD/MM/YYYY HH:mm");

                                    if (!isFirstGroup) {
                                        dataResultTable += `<tr>
                                                <td colspan="6">
                                                    <hr style="border-top: 2px solid #000;">
                                                </td>
                                            </tr>`;
                                    }

                                    dataResultTable += `<tr>
                                            <td colspan="6">
                                                <strong>No. Lab: ${nolabLis} / RM: ${norm}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><strong class="fst-italic"><u>
                                                Tgl.Priksa: ${formattedCheckDate} Tgl. Sampel :${formattedSampleDate}</u></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <hr style="border-top: 1px dashed #ddd;">
                                            </td>
                                        </tr>`;

                                    for (let kelPemeriksaan in groupedData[nolabLis][norm]) {
                                        if (groupedData[nolabLis][norm].hasOwnProperty(kelPemeriksaan)) {
                                            dataResultTable += `<tr>
                                <td colspan="6"><strong>${kelPemeriksaan}</strong></td>
                            </tr>`;

                                            for (let tarifName in groupedData[nolabLis][norm][kelPemeriksaan]) {
                                                if (groupedData[nolabLis][norm][kelPemeriksaan].hasOwnProperty(tarifName)) {
                                                    dataResultTable += `<tr>
                                        <td colspan="6" style="padding-left: 20px;"><strong>${tarifName}</strong></td>
                                    </tr>`;

                                                    groupedData[nolabLis][norm][kelPemeriksaan][tarifName].forEach(e => {
                                                        dataResultTable += `<tr>
                                                    <td style="padding-left: 40px;">${e.parameter_name}</td>
                                                    <td>
                                                        ${(e.flag_hl?.trim() || '') === '' ? e.hasil : 
                                                            ['L', 'H', 'K', '(*)'].includes(e.flag_hl.trim()) ? `<b class="fw-bold">${e.hasil}</b>` : 
                                                            (e.flag_hl.trim().includes('K') ? `<b style="color:red;">${e.hasil}</b>` : 
                                                            e.hasil)}
                                                    </td>

                                                    <td>${(e.flag_hl?.trim() || '') === '' ? '-' : 
                                                            (e.flag_hl?.trim().includes('K') ? `<b style="color:red;">${e.flag_hl.trim()}</b>` :
                                                            ['L', 'H', 'K' , '(*)'].includes(e.flag_hl?.trim()) ? `<b class="fw-bold">${e.flag_hl.trim()}</b>` : 
                                                            e.flag_hl.trim())}
                                                    </td>
                                                    <td>${!e.satuan? "-":e.satuan}</td>
                                                    <td>${!e.nilai_rujukan? "-":e.nilai_rujukan}</td>
                                                    <td>${!e.catatan? "-": e.catatan === "-" ? !e.rekomendasi ? "-" : e.rekomendasi : e.catatan }</td>

                                                </tr>`;
                                                    });
                                                }
                                            }
                                        }
                                    }

                                    isFirstGroup = false;
                                }
                            }
                        }

                        $("#render-tables").html(dataResultTable);

                        $("#noLab_rm").html(dataTable?.data[0]?.nolab_lis + '/ ' + dataTable?.data[0]?.norm)
                        $("#name_patient").html(dataTable?.data[0]?.nama)
                        $("#adresss_patient").html(dataTable?.data[0]?.alamat)
                        $("#date_check").html(moment(dataTable?.data[0]?.tgl_hasil).format("DD/MM/YYYY HH:mm:ss"))
                        $("#payment_method").html(dataTable?.data[0]?.cara_bayar_name)
                        $("#doctor_send").html(dataTable?.data[0]?.pengirim_name)
                        $("#room_poli").html(dataTable?.data[0]?.ruang_name)
                        $("#class_pay").html(`${dataTable?.data[0]?.kelas_name} - ${dataTable?.data[0]?.cara_bayar_name}`)
                        $("#datetime-now-valid").html(
                            `${moment(dataTable?.data[0]?.tgl_hasil_selesai).format("DD/MM/YYYY HH:mm:ss")}`)



                        var qrcode = new QRCode(document.getElementById("qrcode"), {
                            text: `https://www.pkusampangan.com/`, // Your text here
                            width: 70,
                            height: 70,
                            colorDark: "#000000",
                            colorLight: "#ffffff",
                            correctLevel: QRCode.CorrectLevel.H // High error correction
                        });

                        function addImageToQRCode1() {
                            var qrElement = document.getElementById("qrcode");
                            var qrCanvas = qrElement.querySelector('canvas');

                            var img = new Image();
                            img.src = '<?= base_url() ?>assets/img/logo.png';

                            img.onload = function() {
                                var canvas = document.createElement('canvas');
                                var ctx = canvas.getContext('2d');

                                canvas.width = qrCanvas.width;
                                canvas.height = qrCanvas.height;

                                ctx.drawImage(qrCanvas, 0, 0, canvas.width, canvas.height);

                                var imgSize = Math.min(canvas.width, canvas.height) * 0.3;
                                var imgX = (canvas.width - imgSize) / 2;
                                var imgY = (canvas.height - imgSize) / 2;

                                ctx.drawImage(img, imgX, imgY, imgSize, imgSize);

                                qrElement.innerHTML = '';
                                qrElement.appendChild(canvas);
                            };
                        }

                        addImageToQRCode1();
                    }
                }
                const renderDataPatientLaborat = () => {
                    <?php $dataJson = json_encode($lab); ?>
                    let data = <?php echo $dataJson; ?>
                    // render patient 
                    $("#gender_patient").html(data?.visit?.name_of_gender)
                    $("#doctor-responsible-lab").html(data?.visit?.doctor_responsible)

                    $("#date_age").html(moment(data?.visit?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.visit?.age)
                    $("#no_tlp").html(data?.visit?.phone_number)
                    $("#validator-ttd").html(data?.visit?.valid_users_p)

                    var qrcode = new QRCode(document.getElementById("qrcode1"), {
                        text: `${data?.visit?.valid_users_p}`, // Your text here
                        width: 70,
                        height: 70,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });
                }
            </script>

            </html>

        </div>

    <?php endif; ?>

    <!-- ========================================================== -->
    <?php if (!empty($radiologi_cetak)) : ?>
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
                                <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                            </div>
                            <div class="col mt-2 text-center">
                                <h3><?= @$kop['name_of_org_unit'] ?></h3>
                                <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                                    <?= @$kop['fax'] ?? "-" ?>,
                                    <?= @$kop['kota'] ?? "-" ?></p>
                                <p><?= @$kop['sk'] ?? "-" ?></p>
                            </div>
                            <div class="col-auto" align="center">

                                <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                            </div>
                        </div>
                        <br>

                        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                        <div class="row">
                            <h6 class="text-center pt-2">HASIL PEMERIKSAAN RADIOLOGI</h6>
                        </div>
                        <div class="table-container-split">
                            <table>
                                <!-- kiri -->
                                <tr>
                                    <td>No.RM</td>
                                    <td>:</td>
                                    <td>
                                        <div id="no_rm"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama Pasien</td>
                                    <td>:</td>
                                    <td>
                                        <div id="name_patient"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>JK/Umur</td>
                                    <td>:</td>
                                    <td>
                                        <div id="gender_patient_age"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat Pasien</td>
                                    <td>:</td>
                                    <td>
                                        <div id="adresss_patient"></div>
                                    </td>
                                </tr>
                            </table>

                            <table>
                                <!--kanan -->
                                <tr>
                                    <td>No.Pemeriksaan</td>
                                    <td>:</td>
                                    <td>
                                        <div id="no_check"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td>
                                        <div id="date_check"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dokter Pengirim</td>
                                    <td>:</td>
                                    <td>
                                        <div id="doctor_send"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <table class="table-borderless">
                            <thead class="border" style="vertical-align: text-top;">
                                <tr>
                                    <td style="width: 15%;">Pemeriksaan : </td>
                                    <td>
                                        <div id="pemeriksaan-val"></div>
                                    </td>
                                </tr>
                            </thead>
                        </table>

                        <div><b>Dengan Hormat</b></div>
                        <p id="dengan-hormat-val"></p>
                        <div><b>Catatan/Rekomendasi</b></div>
                        <p id="note-val"></p>


                        <div class="row mb-2">
                            <div class="col-3" align="center">
                            </div>
                            <div class="col"></div>
                            <div class="col-3" align="center">
                                <div>Pemeriksa</div>
                                <div>
                                    <div class="pt-2 pb-2" id="qrcode-rad"></div>
                                </div>
                                <div id="validator-ttd-rad"></div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Optional JavaScript; choose one of the two! -->

                <!-- Option 1: Bootstrap Bundle with Popper -->


            </body>



            <script>
                $(document).ready(function() {
                    $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

                    dataRenderTables();
                    renderDataPatient();

                })

                // const dataRenderTables = () => {
                //     <?php $dataJsonTables = json_encode(@$radiologi_cetak); ?>

                //     let dataTable = <?php echo $dataJsonTables; ?>;
                //     <?php $dataJson = json_encode($visit); ?>
                //     let visit = <?php echo $dataJson; ?>;

                //     //     // render patient -
                //     $("#no_rm").html(visit?.no_registration)
                //     $("#name_patient").html(visit?.thename ?? visit?.name_of_pasien)
                //     $("#gender_patient_age").html(visit?.gender === "2" ? "Perempuan" : visit?.gender === "2" ?
                //         "Laki - Laki" : !visit?.gender ? "" : visit?.gender + '/' +
                //         visit.ageyear + ' Th' + visit.agemonth + ' Bln' + visit.ageday + ' Hr')
                //     $("#adresss_patient").html(visit?.theaddress ?? visit?.visitor_address)
                //     $("#no_check").html(visit?.nota_no ?? visit?.org_unit_code)
                //     $("#date_check").html(moment(visit?.pickup_date).format("DD-MMM-YYYY HH:ss"))
                //     $("#doctor_send").html(visit?.doctor_from ?? visit?.fullname_from)
                //     $("#pemeriksaan-val").html(visit?.tarif_name)
                //     $("#dengan-hormat-val").html(visit?.result_value)
                //     $("#note-val").html(visit?.conclusion)
                //     $("#validator-ttd").html(visit?.doctor)



                //     var qrcode = new QRCode(document.getElementById("qrcode"), {
                //         text: `${dataTable[0]?.doctor}`, // Your text here
                //         width: 70,
                //         height: 70,
                //         colorDark: "#000000",
                //         colorLight: "#ffffff",
                //         correctLevel: QRCode.CorrectLevel.H // High error correction
                //     });


                // }

                const dataRenderTables = () => {
                    <?php $dataJsonTables = json_encode(@$radiologi_cetak); ?>
                    <?php $dataJsonTreat = json_encode(@$get_treat); ?>

                    let dataTable = <?php echo $dataJsonTables; ?>;
                    let dataTreat = <?php echo $dataJsonTreat; ?>;
                    let note_valrad = ''
                    let result_valrad = ''
                    let result_rad = ''


                    //     // render patient -
                    $("#no_rm").html(dataTable[0]?.no_registration)
                    $("#name_patient").html(dataTable[0]?.thename)
                    $("#gender_patient_age").html(dataTable[0]?.gender === "2" ? "Perempuan" : dataTable[0]?.gender === "2" ?
                        "Laki - Laki" : !dataTable[0]?.gender ? "" : dataTable[0]?.gender + '/' +
                        dataTable[0].ageyear + ' Th' + dataTable[0].agemonth + ' Bln' + dataTable[0].ageday + ' Hr')
                    $("#adresss_patient").html(dataTable[0]?.theaddress)
                    $("#no_check").html(dataTable[0]?.nota_no)
                    $("#date_check").html(moment(dataTable[0]?.pickup_date).format("DD-MMM-YYYY HH:ss"))
                    $("#doctor_send").html(dataTable[0]?.doctor_from)



                    dataTable?.forEach((item, index) => {
                        note_valrad += `<p>${index+1}. ${item?.conclusion}</p>`;
                        result_rad += `<p>${index+1}. ${item?.result_value}</p>`;
                        let matchedTreat = dataTreat.find(treat => treat.tarif_id === item?.tarif_id);

                        if (matchedTreat) {
                            result_valrad += `<p>${index+1}.  ${matchedTreat.tarif_name}</p>`;
                        } else {

                            result_valrad += `<p>${index+1}.  ${item?.tarif_id}</p>`;
                        }
                    });

                    $("#dengan-hormat-val").html(result_rad)
                    $("#pemeriksaan-val").html(result_valrad ?? "")
                    $("#note-val").html(note_valrad ?? "")
                    $("#validator-ttd-rad").html(dataTable[0]?.doctor)



                    var qrcode = new QRCode(document.getElementById("qrcode-rad"), {
                        text: `${dataTable[0]?.doctor}`, // Your text here
                        width: 70,
                        height: 70,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });


                }

                const renderDataPatient = () => {
                    <?php $dataJson = json_encode($visit); ?>
                    let data = <?php echo $dataJson; ?>;
                    // render patient 
                    $("#gender_patient").html(data?.name_of_gender)
                    $("#date_age").html(moment(data?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.age)
                    $("#no_tlp").html(data?.phone_number)
                    $("#diagnosa_klinis").html(data?.diagnosa)
                }
            </script>


            <script type="text/javascript">
                // //window.print();
            </script>

            </html>
        </div>
    <?php endif; ?>

    <!-- ========================================================== -->
    <?php
    // var_dump($fisio['diag']);

    // exit();
    ?>

    <?php if (isset($fisio)): ?>


        <div class="page-break portrait">
            <div class="card-body">
                <div class="container-fluid mt-5">
                    <!-- template header -->
                    <div class="row">
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                        </div>
                        <div class="col mt-2">
                            <h3 class="kop-name text-center" id="kop-name">
                                <?= @$kop['name_of_org_unit'] ?>
                            </h3>
                            <p class="text-center"><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                                <?= @$kop['fax'] ?? "-" ?>,
                                <?= @$kop['kota'] ?? "-" ?></p>
                            <p class="text-center"><?= @$kop['sk'] ?? "-" ?></p>
                        </div>
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="100px">
                        </div>
                    </div>
                    <br>
                    <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
                    </div>
                    <br>
                    <div class="row">
                        <h3 class="text-center pt-2 fw-bold">Lembar Hasil Uji Fungsi KFR
                        </h3>
                    </div>
                    <div class="row">
                        <h5 class="text-start">Informasi Pasien</h5>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Nomor RM</b>
                                    <div id="no_registration-val-ujifungsimedic" name="no_registration">
                                        <?= $visit['no_registration'] ?>
                                    </div>
                                </td>
                                <td>
                                    <b>Nama Pasien</b>
                                    <div id="diantar_oleh-val-ujifungsimedic" name="name_of_pasien" class="thename">
                                        <?= $visit['name_of_pasien'] ?>
                                    </div>
                                </td>
                                <td>
                                    <b>Jenis Kelamin</b>
                                    <div name="gender" id="gender-val-ujifungsimedic">
                                        <?= $visit['gender'] ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Tanggal Lahir (Usia)</b>
                                    <div id="age-val-ujifungsimedic" name="age">
                                        <?= $visit['tgl_lahir'] ?> (<?= $visit['age'] ?> )

                                    </div>
                                </td>
                                <td colspan="2">
                                    <b>Alamat Pasien</b>
                                    <div id="contact_address-val-ujifungsimedic" name="contact_address" class="contact_address">
                                        <?= $visit['contact_address'] ?>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>DPJP</b>
                                    <div id="fullname-val-ujifungsimedic" name="fullname">
                                        <?= $visit['fullname'] ?>

                                    </div>
                                </td>
                                <td>
                                    <b>Department</b>
                                    <div id="clinic_id-val-ujifungsimedic" name="clinic_id">
                                        <?= $fisio['clinic']['name_of_clinic'] ?>

                                    </div>
                                </td>
                                <td>
                                    <b>Tanggal Masuk</b>
                                    <div id="visit_date-val-ujifungsimedic" name="visit_date">
                                        <?= $visit['visit_date'] ?>

                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <b>Lembar Hasil Tindakan Uji Fungsi / Prosedur KFR <span id="val-detail-treatment-result">
                            <?php if (isset($fisio['val']['teraphy_result'])): ?>
                                <span><?= $fisio['val']['teraphy_result'] ?></span>
                            <?php endif; ?></span></b>

                    <!-- end of template header -->
                    <form id="formaddaujirehab">
                        <div id="inputformujirehab"></div>
                        <table class="table table-bordered">
                            <tr>
                                <td>Tanggal Pemeriksaan</td>
                                <td>
                                    <?php if (isset($fisio['val']['vactination_date']) && !empty($fisio['val']['vactination_date'])): ?>
                                        <?php
                                        $dateTime = explode(' ', $fisio['val']['vactination_date']);
                                        $datePart = explode('-', $dateTime[0]);
                                        $timePart = substr($dateTime[1], 0, 5);

                                        $formattedDate = $datePart[2] . '/' . $datePart[1] . '/' . $datePart[0] . ' ' . $timePart;
                                        ?>
                                        <span><?= $formattedDate ?></span>
                                    <?php endif; ?>


                                </td>
                            </tr>
                            <tr>
                                <td>Diagnosis Fungsional</td>
                                <td id="diagnosis-fungsi-uji-fisio">
                                    <?php if (!empty($fisio['diag'])): ?>
                                        <?php foreach ($fisio['diag'] as $diagnosa): ?>
                                            <?php if (isset($diagnosa['diag_cat']) && ($diagnosa['diag_cat'] == 17 || $diagnosa['diag_cat'] === '17')): ?>
                                                <span><?= htmlspecialchars($diagnosa['diagnosa_name'], ENT_QUOTES, 'UTF-8') ?></span><br>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>


                                </td>
                            </tr>
                            <tr>
                                <td>Diagnosis Medis</td>
                                <td id="diagnosis-medis-uji-fisio">

                                    <?php if (!empty($fisio['diag'])): ?>
                                        <?php foreach ($fisio['diag'] as $diagnosa): ?>
                                            <?php if (isset($diagnosa['diag_cat']) && ($diagnosa['diag_cat'] == 1 || $diagnosa['diag_cat'] === '1')): ?>
                                                <span><?= htmlspecialchars($diagnosa['diagnosa_name'], ENT_QUOTES, 'UTF-8') ?></span><br>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>


                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Instrumen Uji Fungsi/ Prosedur KFR</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php if (isset($fisio['val']['treatment'])): ?>
                                        <span><?= $fisio['val']['treatment'] ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Hasil yang Didapat</td>
                                <td> <?php if (isset($fisio['val']['teraphy_result'])): ?>
                                        <span><?= $fisio['val']['teraphy_result'] ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Kesimpulan</td>
                                <td><?php if (isset($fisio['val']['teraphy_conclusion'])): ?>
                                        <span><?= $fisio['val']['teraphy_conclusion'] ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Rekomendasi</td>
                                <td><?php if (isset($fisio['val']['teraphy_recomendation'])): ?>
                                        <span><?= $fisio['val']['teraphy_recomendation'] ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </form>

                    <div class="row justify-content-end hidden-show-ttd">
                        <div class="col-auto" align="center">
                            <div class="mb-2">
                                <?= isset($kop['kota']) ? $kop['kota'] : 'Kota' ?>,
                                <?= tanggal_indo(date('Y-m-d')); ?></div>
                            <div class="mb-1">
                                <div id="qrcode-fisio-uji-pasien"></div>
                            </div>

                        </div>
                    </div>
                    <br><br>
                    <i class="hidden-show-ttd">Dicetak pada tanggal
                        <?= tanggal_indo(date('Y-m-d')); ?></i>
                </div>
            </div>

            <script>
                new QRCode(document.getElementById("qrcode-fisio-uji-pasien"), {
                    text: `<?php if (isset($fisio['val']['valid_user'])): ?>
                            <?= $fisio['val']['valid_user'] ?>
                            <?php endif; ?>`,
                    width: 70,
                    height: 70,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            </script>

        </div>
    <?php endif; ?>
    <!-- ========================================================== -->
    <div class="page-break portrait">

        <!doctype html>
        <html lang="en">

        <body>
            <div class="container-fluid mt-5">
                <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
                    autocomplete="off">

                    <?php csrf_field(); ?>
                    <div class="row">
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                        </div>
                        <div class="col mt-2 text-center">
                            <h3><?= @$kop['name_of_org_unit'] ?></h3>
                            <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                                <?= @$kop['fax'] ?? "-" ?>,
                                <?= @$kop['kota'] ?? "-" ?></p>
                            <p><?= @$kop['sk'] ?? "-" ?></p>
                        </div>
                        <div class="col-auto" align="center">

                            <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <h4 class="text-center pt-2">INVOICE PASIEN</h4>
                    </div>
                    <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                    <div class="table-container-split">
                        <table>
                            <!-- kiri -->
                            <tr>
                                <th>Nama</th>
                                <td colspan='3'>
                                    <span id="name_patient-inv"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>NO.RM</th>
                                <td>
                                    <span id="no_rm-inv"></span>
                                </td>
                                <th>Status</th>
                                <td>
                                    <span id="type-pay-inv"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <div>Alamat</div>
                                </th>
                                <td colspan='3'>
                                    <span id="address-inv"></span>
                                </td>
                            </tr>

                        </table>
                        <table class="text-end">
                            <!--kanan -->
                            <tr>
                                <th>
                                    Tgl Lahir
                                </th>
                                <td>
                                    <span id="birthday-inv"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    No.Peserta
                                </th>
                                <td>
                                    <span id="nobpjs-inv"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Tanggal Masuk
                                </th>
                                <td>
                                    <span id="indate-inv"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Tanggal Keluar
                                </th>
                                <td>
                                    <span id="exitdate-inv"></span>
                                </td>
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
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="fw-bold text-end">Grand Total</td>
                                    <td class="fw-bold text-end" id="total-all-pay-inv"></td>
                                </tr>
                            </tfoot>
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


        </body>

        <script>
            $(document).ready(function() {

                $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)
                <?php $dataJsonTables2 = json_encode($treatment_bill); ?>
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
                <?php $dataJsonTables = json_encode($treatment_bill); ?>
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


                        grandTotal += totalSubtotal;
                    }
                }

                $("#total-all-pay-inv").html(`Rp. ${formatCurrency(grandTotal)}`);



            };
            const renderDataPatientinvorat = () => {
                <?php $dataJson = json_encode($visit); ?>
                let data = <?php echo $dataJson; ?>;
                $("#no_rm-inv").html(data?.no_registration)
                $("#address-inv").html(data?.contact_address)
                $("#birthday-inv").html(data?.date_of_birth ? moment(data?.date_of_birth).format("DD-MM-YYYY") : "")
                $("#nobpjs-inv").html(data?.pasien_id)
                $("#indate-inv").html(data?.in_date)
                $("#exitdate-inv").html(data?.exit_date)

                // render patient 
                $("#name_patient-inv").html(data?.name_of_pasien)
                $("#type-pay-inv").html(data?.name_of_status_pasien)
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

    <!-- ========================================================== -->

    <?php if (!empty($resep)) : ?>

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
                                <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                            </div>
                            <div class="col mt-2">
                                <h3><?= @$kop['name_of_org_unit'] ?></h3>
                                <!-- <h3>Surakarta</h3> -->
                                <p><?= @$kop['contact_address'] ?></p>
                            </div>
                            <div class="col-auto" align="center">

                                <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                            </div>
                        </div>
                        <br>
                        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                        <div class="row">
                            <h4 class="text-center pt-2">CETAK RESEP</h4>
                        </div>
                        <div class="table-container-split">
                            <table>
                                <!-- kiri -->
                                <tr>
                                    <th>
                                        <div id="name_patient-resep"></div>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <div id="type-pay-resep"></div>
                                    </th>
                                </tr>
                            </table>
                            <table class="text-end">
                                <!--kanan -->
                                <tr>
                                    <th>
                                        <div id="total-all-pay-resep"></div>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <div id="date-pay-resep"></div>
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
                                <tbody id="render-tables-resep" class="border">
                                </tbody>
                            </table>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3" align="center">
                                <br>
                                <div>Pasien/Keluarga</div>
                                <div id="qrcode-container">
                                    <div id="qrcode-resep"></div>
                                </div>
                                <div id="datetime-now"></div>
                            </div>
                            <div class="col"></div>
                            <div class="col-3" align="center">
                                <div>Kasir</div>
                                <div>
                                    <div class="pt-2 pb-2" id="qrcode1-resep"></div>
                                </div>
                                <div id="validator-ttd"></div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Optional JavaScript; choose one of the two! -->

                <!-- Option 1: Bootstrap Bundle with Popper -->

            </body>

            <script>
                $(document).ready(function() {

                    $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)
                    <?php $dataJsonTables2 = json_encode($treatment_bill); ?>
                    let dataTable1 = <?php echo $dataJsonTables2; ?>;

                    dataRenderTablesresep();
                    renderDataPatientresep();

                })

                function formatCurrency(total) {

                    var components = total.toFixed(2).toString().split(".");

                    components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                    return components.join(",");
                }


                const dataRenderTablesresep = () => {
                    <?php $dataJsonTables = json_encode($resep); ?>
                    let dataTable = <?php echo $dataJsonTables; ?>;

                    let groupedData = {};

                    // Group by 'tarif_name_tt'
                    dataTable.forEach(e => {
                        if (!groupedData[e.tarif_name_tt]) {
                            groupedData[e.tarif_name_tt] = [];
                        }
                        groupedData[e.tarif_name_tt].push(e);
                    });

                    let dataResultTable = '';

                    let grandTotalResep = 0;

                    for (let tarifName in groupedData) {
                        if (groupedData.hasOwnProperty(tarifName)) {
                            let tarifNameId = tarifName.replace(/[\s\/]+/g, '_');
                            let totalSubtotalResep = 0;

                            dataResultTable += `<tr>
                                <td colspan="2" class="text-start w-auto"><strong>${tarifName}</strong></td>
                                <td colspan="1" class="text-end w-auto"><strong>SubTotal:</strong></td>
                                <td class="text-end w-auto"><strong><div id="sub-resep-${tarifNameId}"></div></strong></td>
                            </tr>`;

                            groupedData[tarifName].forEach(e => {
                                dataResultTable += `<tr>
                    <td class="w-auto">${!e?.description ? "-": e?.description }</td>
                    <td class="w-auto">${parseFloat(e.quantity ?? 0)}</td>
                    <td class="text-end w-auto">Rp. ${formatCurrency(parseFloat(e.sell_price ?? 0))}</td>
                    <td class="text-end w-auto">Rp. ${formatCurrency(parseFloat(e.subtotal ?? 0))}</td>
                </tr>`;

                                totalSubtotalResep += parseFloat(e.subtotal ?? 0) || 0;
                            });

                            $(`#sub-resep-${tarifNameId}`).html(`Rp. ${formatCurrency(totalSubtotalResep ?? 0)}`);
                            grandTotalResep += totalSubtotalResep;
                        }
                    }

                    $("#render-tables-resep").html(dataResultTable);
                    $("#total-all-pay-resep").html(`Rp. ${formatCurrency(grandTotalResep ?? 0)}`);
                };


                const renderDataPatientresep = () => {
                    <?php $dataJson = json_encode($visit); ?>
                    let data = <?php echo $dataJson; ?>;

                    // render patient 
                    $("#name_patient-resep").html(data?.name_of_pasien)
                    $("#type-pay-resep").html(data?.payor)
                    // $("#total-all-pay-resep").html(data?.phone_number)
                    $("#date-pay-resep").html(
                        moment(new Date(data?.exit_date || data?.in_date)).format("DD/MM/YYYY HH:mm")
                    );

                    new QRCode(document.getElementById("qrcode1-resep"), {
                        text: `${data?.diantar_oleh || ''}`,
                        width: 70,
                        height: 70,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });

                    new QRCode(document.getElementById("qrcode-resep"), {
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



<?php endif; ?>