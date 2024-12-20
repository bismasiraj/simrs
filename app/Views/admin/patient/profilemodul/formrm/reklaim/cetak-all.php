<style>
@media print {
    @page {
        margin: none;
    }

    @page {
        size: A4 portrait;
    }

    @page landscape {
        size: A4 landscape;
    }

    .container {
        width: 100%;
    }

    .page-break {
        page-break-before: always;
    }

    .landscape {
        width: 29.7cm;
        height: 29.7cm;
        page-break-before: always;
        writing-mode: horizontal-tb;
        transform: rotate(90deg);

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
        height: 29.7cm;
        margin: 0;
        font-size: 12px;
    }

    .landscape {
        width: 29.7cm;
        height: 29.7cm;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        page-break-inside: avoid;
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
                        <img src="<?= base_url() ?>bpjs.jpeg" alt="BPJS KESEHATAN" style="width: 230px;">
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
                            <div class="col-sm-7">
                                <span><?=@$kop['display']?> - <?=@$kop['kota']?></span>
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
                        <h6 class="text-center"><b>SURAT ELIGIBILITAS PESERTA <br> <?=@$kop['display']?></b></h6>
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
                                <h6><?=@$kop['display']?>,
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
                        <h6 class="text-center"><b>SURAT BUKTI PELAYANAN <br> NAMA RS : <?=@$kop['display']?> KODE RS :
                                0701R001 KELAS RS : B
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
                                <h6><?=@$kop['display']?>,............. <br>Dokter Pemeriksa</h6>
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
        window.print();
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
                        <img src="<?= base_url() ?>bpjs.jpeg" alt="BPJS KESEHATAN" style="width: 230px;">
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
                        <h6 class="text-center"><b>SURAT RENCANA KONTROL <br> <?=@$kop['display']?> </b></h6>
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
        window.print();
        </script>

    </body>

</div>
<?php elseif ($type === 'ResumeMedis'): ?>
<div class="page-break">
    <!doctype html>
    <html lang="en">

    <body>
        <div class="container-fluid mt-5">
            <!-- template header -->
            <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php"); ?>
            <!-- end of template header -->
            <div class="row">
                <h4 class="text-start">Subjektif (S)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Keluhan Utama (Autoanamnesis)</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['anamnesis']; ?></p>
                            <b>Keluhan Utama (Alloanamnesis)</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['alloanamnesis']; ?></p>
                        </td>
                        <td style="width: 33%;">
                            <b>Riwayat Penyakit Sekarang</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_sekarang']; ?></p>
                            <b>Riwayat Penyakit Dahulu</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_dahulu']; ?></p>
                        </td>
                        <td>
                            <b>Riwayat Penyakit Keluarga</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_keluarga']; ?></p>
                            <b>Riwayat Obat Yang Dikonsumsi</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['riwayat_obat_dikonsumsi']; ?></p>
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
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['tensi_atas']; ?> /
                                <?= @$resumeMedis['val']['tensi_bawah']; ?></p>mmHg
                        </td>
                        <td class="p-1">
                            <b>Denyut Nadi</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['tensi_atas']; ?> /
                                <?= @$resumeMedis['val']['tensi_bawah']; ?></p>m
                        </td>
                        <td class="p-1">
                            <b>Suhu Tubuh</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['suhu']; ?> </p>℃
                            </div>
                        </td>
                        <td class="p-1">
                            <b>Respiration Rate</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['respiration']; ?></p>x/m
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>SpO2</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['spo2']; ?></p>
                            </div>
                        </td>
                        <td class="p-1">
                            <b>Berat Badan</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['berat']; ?></p>kg
                            </div>
                        </td>
                        <td colspan="2">
                            <b><i>GCS / Tingkat Kesadaran</i></b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['gcs']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
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
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <b>Diagnosis Masuk</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['pdiagnosa']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Procedure Masuk</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['pprocedures']; ?></p>
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
                                name=""><?= @$resumeMedis['val']['pdiagnosa']; ?></textarea>
                        </td>
                        <td class="p-1">
                            <b>Procedure Pulang</b>
                            <textarea type="text" class="form-control" id=""
                                name=""><?= @$resumeMedis['val']['pprocedures']; ?></textarea>
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
                                name="laboratorium"><?= @$resumeMedis['val']['laboratorium']; ?></textarea>
                        </td>
                        <td class="p-1">
                            <b>Radiologi</b>
                            <textarea type="text" class="form-control" id="radiologi"
                                name="radiologi"><?= @$resumeMedis['val']['radiologi']; ?></textarea>
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
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['farmakologia']; ?></p>
                        </td>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['recipe']['signatura'] ?></p>
                        </td>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['recipe']['tanggal_mulai'] ?></p>
                        </td>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['recipe']['tanggal_selesai'] ?></p>
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
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['farmakologia']; ?></p>
                        </td>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['recipe']['signatura'] ?></p>
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
                        <div id="qrcodeMedis"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Tanda Tangan Pasien/Keluarga</div>
                    <div class="mb-1">
                        <div id="qrcode1Medis"></div>
                    </div>
                </div>
            </div>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->


    </body>

    <script>
    var qrcode = new QRCode(document.getElementById("qrcodeMedis"), {
        text: '<?= @$resumeMedis['val']['dpjp']; ?>',
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    </script>
    <script>
    var qrcode = new QRCode(document.getElementById("qrcode1Medis"), {
        text: '<?= @$resumeMedis['val']['nama']; ?>',
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    </script>
    <style>
    /* @media print {
        @page {
            margin: none;
            scale: 85;
        }

        .container {
            width: 210mm;
        }
    } */
    </style>
    <script type="text/javascript">
    window.print();
    </script>

    </html>
</div>
<?php elseif ($type === 'INV'): ?>
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
                        <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                            <?= @$kop['fax'] ?? "-"?>,
                            <?= @$kop['kota'] ?? "-"?></p>
                        <p><?= @$kop['sk'] ?? "-"?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kemenkes.png" width="70px">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kars-bintang.png" width="70px">
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

        // render patient 
        $("#name_patient-inv").html(data?.name_of_pasien)
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
<?php elseif ($type === 'Persalinan'): ?>
<div class="page-break">

    <body>
        <div class="container-fluid mt-5">
            <!-- template header -->
            <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php"); ?>
            <!-- end of template header -->

            <!-- <div class="row">
                <h4>Laporan Persalinan</h4>
            </div> -->
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
            <?php if (isset($persalinan['apgarData']) && isset($apgarWaktu)) : ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" width="25%"></td>
                        <?php foreach ($apgarWaktu as $key => $waktu) : ?>
                        <th class="p-1" width="25%"><?= $waktu['p_description'] ?></th>
                        <?php endforeach ?>
                    </tr>
                    <?php $totalSkor = 0; ?>
                    <?php foreach ($persalinan['apgarData'] as $key => $row) : ?>
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
            <?php endif; ?>

            <div class="row">
                <div class="col-auto" align="center">
                    <div>Dokter</div>
                    <div class="mb-1">
                        <div id="qrcode"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Bidan</div>
                    <div class="mb-1">
                        <div id="qrcode1"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->


    </body>
</div>
<?php elseif ($type === 'ANOTOMI'): ?>
<div class="page-break">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>

    <?php foreach ($anotomi as $item): ?>
    <?php 
        if ($item['file_image'] !== NULL) {
            $filePath = WRITEPATH . $item['file_image']; 
            if (file_exists($filePath)) {
                $fileType = mime_content_type($filePath); 
                $fileContent = base64_encode(file_get_contents($filePath)); 
                $item['file_image_base64'] = 'data:' . $fileType . ';base64,' . $fileContent; 
            } else {
                $item['file_image_base64'] = null; 
            }
        } else {
            $item['file_image_base64'] = null; 
        }
    ?>


    <?php if (!empty($item['file_image_base64'])): ?>
    <?php 
        $fileType = substr($item['file_image_base64'], 5, strpos($item['file_image_base64'], ';') - 5); 
    ?>

    <?php 
        if ($fileType === 'application/pdf') {
    ?>
    <div class="pdf-container" style="margin-bottom: 20px;">
        <div id="pdf-container-<?php echo md5($item['file_image']); ?>" style="width: 100%;"></div>
    </div>

    <script>
    const base64PDF = '<?= $item['file_image_base64']; ?>';
    const pdfData = atob(base64PDF.split(',')[1]);
    const loadingTask = pdfjsLib.getDocument({
        data: new Uint8Array(pdfData.split("").map(function(c) {
            return c.charCodeAt(0);
        }))
    });

    loadingTask.promise.then(function(pdf) {
        const container = document.getElementById('pdf-container-<?php echo md5($item['file_image']); ?>');
        let renderComplete = 0;

        for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
            pdf.getPage(pageNumber).then(function(page) {
                const scale = 1.5;
                const viewport = page.getViewport({
                    scale: scale
                });

                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                container.appendChild(canvas);

                page.render({
                    canvasContext: context,
                    viewport: viewport
                }).promise.then(() => {
                    renderComplete++;

                });
            });
        }
    }).catch(function(error) {
        console.error('Error loading PDF: ' + error);
    });
    </script>

    <?php 
        } else if (strpos($fileType, 'image/') === 0) { 
    ?>
    <div class="image-container" style="margin-top: 20px; margin-bottom: 20px;">
        <img src="<?= $item['file_image_base64']; ?>" alt="Image"
            style="width: 100%; max-height: 500px; object-fit: contain;" />
    </div>
    <?php } ?>
    <?php endif; ?>

    <?php endforeach; ?>
</div>
<?php elseif ($type === 'OPRS'): ?>
<div class="page-break">

    <body>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-auto text-center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="90px">
                </div>
                <div class="col text-center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                        <?= @$kop['fax'] ?? "-"?>,
                        <?= @$kop['kota'] ?? "-"?></p>
                    <p><?= @$kop['sk'] ?? "-"?></p>
                </div>
                <div class="col-auto text-center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="90px">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><?= $oprasi['title']; ?></h4>
            </div>
            <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Nomor RM</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['no_registration']; ?></p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Nama Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['diantar_oleh']; ?></p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Jenis Kelamin</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['gendername']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Tanggal Lahir (Usia)</b>
                            <p class="m-0 mt-1 p-0">
                                <?= date("d M Y", strtotime($oprasi['visit']['date_of_birth'])) . ' (' . (!empty($oprasi['visit']['age']) ? $oprasi['visit']['age'] : 'N/A') . ')'; ?>
                            </p>


                        </td>
                        <td class="p-1" style="width:66.3%" colspan="2">
                            <b>Alamat Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['visitor_address']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['fullname_inap']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['name_of_clinic_from']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['in_date'] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Kelas</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['class_room']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Bangsal/Kamar</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['name_of_clinic']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Bed</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['bed']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (isset($oprasi['operation_team'])) : ?>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($oprasi['operation_team'] as $key => $team) : ?>
                <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b><?= $team['task'] ?></b>
                    <p class="m-0 mt-1 p-0"><?= @$team['doctor']; ?></p>
                </div>
                <?php endforeach ?>
            </div>
            <?php endif; ?>

            <?php if (isset($oprasi['diagnosas'])) : ?>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <ul><b>Diagnosa Pra Operasi</b>
                        <?php
                        $diagnosa_pra = array_filter($oprasi['diagnosas'], function ($item) {
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
                        <?= date_format(date_create(@$oprasi['val']['start_operation']), 'd-m-Y H:i'); ?></p>
                    <b>Waktu Selesai</b>
                    <p class="m-0 mt-1 p-0">
                        <?= date_format(date_create(@$oprasi['val']['end_operation']), 'd-m-Y H:i'); ?></p>
                    <b>Ada Penundaan?</b>
                    <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['terlayani'] == 0 ? 'Tidak' : 'Ada'; ?></p>
                </div>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <ul><b>Diagnosa Pasca Operasi</b>
                        <?php
                        $diagnosa_pasca = array_filter($oprasi['diagnosas'], function ($item) {
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
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['tarif_name']; ?></p>
                    </td>
                    <td width="33.3%">
                        <b>Tipe Operasi</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['tipe_operasi']; ?></p>
                    </td>
                    <td width="33.3%">
                        <b>Operasi Ke</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['re_operation'] == 'OP080801' ? '1' : 're-do';  ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="33.3%">
                        <b>Profilaksis</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['profilaksis'] == 'OP080901' ? 'Ya' : 'Tidak'; ?>
                        </p>
                    </td>
                    <td width="33.3%">
                        <b>Jenis Antibiotik</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['antibiotic_desc']; ?></p>
                    </td>
                    <td width="33.3%">
                        <b>Waktu Pemberian</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['antibiotic_time']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Uraian Pembedahan</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['operation_desc']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Komplikasi</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['komplikasi']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Nomor Implant</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['implant']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" width="66.6%">
                        <b>Konsultasi Intra-Operatif</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['konsultasi']; ?></p>
                    </td>
                    <td>
                        <b>Jumlah Pendarahan</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['bleeding']; ?> CC</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Jaringan Ke Patologi</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['patologi_desc']; ?></p>
                    </td>
                </tr>
            </table>


            <div class="row">
                <div class="col-auto" align="center">
                    <div>Dokter</div>
                    <div class="mb-1">
                        <div id="qrcode-oprasi"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Pasien</div>
                    <div class="mb-1">
                        <div id="qrcode-oprasi1"></div>
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
    var qrcode = new QRCode(document.getElementById("qrcode-opras"), {
        text: `<?= $oprasi['visit']['fullname']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    </script>
    <script>
    var qrcode = new QRCode(document.getElementById("qrcode-opras1"), {
        text: `<?= $oprasi['visit']['diantar_oleh']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    </script>

</div>
<?php elseif ($type === 'Anestesi'): ?>
<div class="page-break landscape">

    <body>
        <div class="row align-items-center mb-3">
            <div class="col-2 px-0 d-flex">
                <img class="mt-2 mx-auto" src="<?= base_url() ?>assets/img/logo.png"
                    style="width: 100px; height: 100px;">
            </div>
            <div class="col-6 px-0 text-center">
                <h1 class="px-1">CATATAN KAMAR PEMULIHAN</h1>
            </div>
            <div class="col-4 px-0">
                <div class="border border-1" style="height: auto; min-height:100px;">
                    <table class="table table-borderless">
                        <tr class="mb-0">
                            <td width="30%">Nama</td>
                            <td width="1%">:</td>
                            <td><?= $anestesi['visit']['diantar_oleh']; ?></td>
                        </tr>
                        <tr class="mb-0">
                            <td width="30%">Umur</td>
                            <td width="1%">:</td>
                            <td><?= $anestesi['visit']['age']; ?></td>
                        </tr>
                        <tr class="mb-0">
                            <td width="30%">Alamat</td>
                            <td width="1%">:</td>
                            <td><?= $anestesi['visit']['contact_address']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between gap-3">
            <div class="col-7">
                <h5 class="text-center">MONITORING DURANTEE OPERASI</h5>
                <div class="row">
                    <div id="cairanMasuk" class="table tablecustom-responsive">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <canvas id="myChartMonitoringRecoveryRoom" width="auto" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="monitoringRecoveryRoom-1" class="table tablecustom-responsive">
                        <table class="table">
                            <thead class="table">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">TD(S)</th>
                                    <th scope="col">TD(D)</th>
                                    <th scope="col">NADI</th>
                                    <th scope="col">SUHU</th>
                                    <th scope="col">RR</th>
                                    <th scope="col">SPO2</th>
                                    <th scope="col">CATATAN</th>
                                    <th scope="col">STAFF NAME</th>
                                </tr>
                            </thead>
                            <tbody id="bodyDatamyChartMonitoringRecoveryRoom" class="table-group-divider">
                                <tr>
                                    <td colspan="10" class="text-center">Data Kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Tindakan</th>
                                <th scope="col">Tandatangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-8"><span id="nama-tindakan"></span></td>
                                <td class="col-4"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4">
                <h5 class="text-center">KRITERIA KELUAR KAMAR PULIH</h5>
                <table class="table table-bordered">

                    <?php foreach (@$anestesi['steward_score'] as $key => $steward) : ?>
                    <tr>
                        <th colspan="2" class="text-center">steward Score</th>
                    </tr>
                    <tr class="text-center">
                        <th>Kriteria</th>
                        <th width="1%">Score</th>
                    </tr>
                    <?php foreach (@$steward as $strd) : ?>
                    <tr>
                        <td><?= $strd['value_desc']; ?></td>
                        <td class="text-center"><?= $strd['value_score']; ?></td>
                    </tr>
                    <?php endforeach; ?>

                    <?php endforeach; ?>
                </table>
                <table class="table table-bordered">
                    <?php foreach ($anestesi['aldrete_score'] as $key => $aldrete) : ?>
                    <tr>
                        <th colspan="2" class="text-center">Aldrete Score</th>
                    </tr>
                    <tr class="text-center">
                        <th>Kriteria</th>
                        <th width="1%">Score</th>
                    </tr>
                    <?php foreach ($aldrete as $aldr) : ?>
                    <tr>
                        <td><?= $aldr['value_desc']; ?></td>
                        <td class="text-center"><?= $aldr['value_score']; ?></td>
                    </tr>
                    <?php endforeach; ?>

                    <?php endforeach; ?>
                </table>
                <?php if (!empty($anestesi['bromage_score'])) : ?>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2" class="text-center">Bromage Score</th>
                    </tr>
                    <tr class="text-center">
                        <th>Kriteria</th>
                        <th width="1%">Score</th>
                    </tr>
                    <?php foreach ($anestesi['bromage_score'] as $key => $bromage) : ?>
                    <tr>
                        <td><?= $bromage['value_desc']; ?></td>
                        <td class="text-center"><?= $bromage['value_score']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </body>
</div>
<div class="page-break landscape">

    <body>
        <div class="d-flex gap-2">
            <div class="col-3">
                <?php foreach ($anestesi['infusion'] as $key => $infus) : ?>
                <b><?= $key; ?></b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($infus as $index => $valInfus) : ?>
                    <?php if ($valInfus['entry_type'] == '3' || $valInfus['entry_type'] == '7') : ?>
                    <div class="col-6 p-0">
                        <input type="checkbox" onclick="return false;"
                            <?= $valInfus['checked'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $valInfus['value_desc']; ?></small></label>
                    </div>
                    <?php elseif ($valInfus['entry_type'] == '2') : ?>
                    <input type="checkbox" onclick="return false;" <?= $valInfus['value_id'] == 1 ? 'checked' : ''; ?>>
                    <label for=""><?= $valInfus['value_desc']; ?></label>
                    <?php else : ?>
                    <small class="mb-0"><?= $valInfus['value_id']; ?></small>
                    <label for=""><?= $valInfus['value_desc']; ?></label>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endforeach ?>

                <b>1. General Anestesia</b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($anestesi['general_entry_type']['entries'] as $key => $entry) : ?>
                    <div class="col-6 p-0">
                        <?php if ($entry['entry_type'] == '2') : ?>
                        <input type="checkbox" onclick="return false;" <?= $entry['value_id'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $entry['parameter_desc']; ?></small></label>
                        <?php else : ?>
                        <small><?= $entry['parameter_desc']; ?> : </small>
                        <small><?= $entry['value_id']; ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php foreach ($anestesi['general'] as $key => $gen) : ?>
                <?php if (!in_array($key, $anestesi['general_entry_type']['keys'])) : ?>
                <b><?= $key; ?></b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($gen as $index => $valGen) : ?>
                    <?php if ($valGen['entry_type'] == '3' || $valGen['entry_type'] == '7') : ?>
                    <div class="col-6 p-0">
                        <?php if ($valGen['entry_type'] == '3' || $valGen['entry_type'] == '7') : ?>
                        <input type="checkbox" onclick="return false;" <?= $valGen['checked'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $valGen['value_desc']; ?></small></label>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php endforeach ?>
                <b>Ventilasi</b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($anestesi['ventilasi_entry_type']['entries'] as $key => $entry_ven) : ?>
                    <div class="col-6 p-0">
                        <?php if ($entry_ven['entry_type'] == '2') : ?>
                        <input type="checkbox" onclick="return false;"
                            <?= $entry_ven['value_id'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $entry_ven['parameter_desc']; ?></small></label>
                        <?php else : ?>
                        <small><?= $entry_ven['parameter_desc']; ?> : </small>
                        <small><?= $entry_ven['value_id']; ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php foreach ($anestesi['ventilasi'] as $key => $ven) : ?>
                <?php if (!in_array($key, $anestesi['ventilasi_entry_type']['keys'])) : ?>
                <b><?= $key; ?></b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($ven as $index => $valVen) : ?>
                    <div class="col-6 p-0">
                        <?php if ($valVen['entry_type'] == '3' || $valVen['entry_type'] == '7') : ?>
                        <input type="checkbox" onclick="return false;" <?= $valVen['checked'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $valVen['value_desc']; ?></small></label>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php endforeach ?>
                <b>Jalan Napas</b><br>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($anestesi['jalan_napas_entry_type']['entries'] as $key => $entry_jalan_napas) : ?>
                    <div class="col-6 p-0">
                        <?php if ($entry_jalan_napas['entry_type'] == '2') : ?>
                        <input type="checkbox" onclick="return false;"
                            <?= $entry_jalan_napas['value_id'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $entry_jalan_napas['parameter_desc']; ?></small></label>
                        <?php else : ?>
                        <small><?= $entry_jalan_napas['parameter_desc']; ?> : </small>
                        <small><?= $entry_jalan_napas['value_id']; ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php foreach ($anestesi['jalan_napas'] as $key => $napas) : ?>
                <?php if (!in_array($key, $anestesi['jalan_napas_entry_type']['keys'])) : ?>
                <b><?= $key; ?></b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($napas as $index => $valJalan) : ?>
                    <div class="col-6 p-0">
                        <?php if ($valJalan['entry_type'] == '3' || $valJalan['entry_type'] == '7') : ?>
                        <input type="checkbox" onclick="return false;"
                            <?= $valJalan['checked'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $valJalan['value_desc']; ?></small></label>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php endforeach ?>


                <b>2. Regional Anestesia</b>

                <?php foreach ($anestesi['regional'] as $key => $reg) : ?>
                <?php if (!in_array($key, $anestesi['regional_entry_type']['keys'])) : ?>
                <b><?= $key; ?></b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($reg as $index => $valReg) : ?>
                    <div class="col-6 p-0">
                        <?php if ($valReg['entry_type'] == '3' || $valReg['entry_type'] == '7') : ?>
                        <input type="checkbox" onclick="return false;" <?= $valReg['checked'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $valReg['value_desc']; ?></small></label>
                        <?php else : ?>
                        <small><?= $valReg['value_id']; ?></small>
                        <label for=""><?= $valReg['value_desc']; ?></label>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php endforeach ?>

                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($anestesi['regional_entry_type']['entries'] as $key => $entry_regional) : ?>
                    <div class="col-6 p-0">
                        <?php if ($entry_regional['entry_type'] == '2') : ?>
                        <input type="checkbox" onclick="return false;"
                            <?= $entry_regional['value_id'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $entry_regional['parameter_desc']; ?></small></label>
                        <?php else : ?>
                        <small><?= $entry_regional['parameter_desc']; ?> : </small>
                        <small><?= $entry_regional['value_id']; ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-6">
                <h5 class="text-center">MONITORING DURANTEE OPERASI</h5>
                <div class="row">
                    <div id="cairanMasuk-1" class="table tablecustom-responsive">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <canvas id="myChartMonitoringDurante" width="auto" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="monitoringDurante-1" class="table tablecustom-responsive">
                        <table class="table">
                            <thead class="table">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">TD(S)</th>
                                    <th scope="col">TD(D)</th>
                                    <th scope="col">NADI</th>
                                    <th scope="col">SUHU</th>
                                    <th scope="col">RR</th>
                                    <th scope="col">SPO2</th>
                                    <th scope="col">CATATAN</th>
                                    <th scope="col">STAFF NAME</th>
                                </tr>
                            </thead>
                            <tbody id="bodyDatamyChartMonitoringDurante" class="table-group-divider">
                                <tr>
                                    <td colspan="10" class="text-center">Data Kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-6">
                        Cairan Masuk
                        <table class="table borderless">
                            <?php foreach ($anestesi['cairan_masuk'] as $key => $cm) : ?>
                            <tr>
                                <td><small><?= date_format(date_create($cm['date']), 'd-m-Y'); ?></small></td>
                                <td><small><?= $cm['name']; ?></small></td>
                                <td><small><?= $cm['quantity']; ?> cc</small></td>
                            </tr>

                            <?php endforeach; ?>
                            <?php
                        $array_cairan_masuk = array_filter($anestesi['cairan'], fn ($item) => $item['cairan_masuk'] === 1);

                        foreach ($array_cairan_masuk as $key => $c) : ?>
                            <tr>
                                <td><small><?= date_format(date_create($c['examination_date']), 'd-m-Y'); ?></small>
                                </td>
                                <td><small><?= $c['value_desc']; ?></small></td>
                                <td><small><?= $c['fluid_amount']; ?> cc</small></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="col-6">
                        Cairan Keluar
                        <table class="table table-borderless">
                            <?php
                        $array_cairan_keluar = array_filter($anestesi['cairan'], fn ($item) => $item['cairan_masuk'] === 0);

                        foreach ($array_cairan_keluar as $key => $ck) : ?>
                            <tr>
                                <td><small><?= date_format(date_create($ck['examination_date']), 'd-m-Y'); ?></small>
                                </td>
                                <td><small><?= $ck['value_desc']; ?></small></td>
                                <td><small><?= $ck['fluid_amount']; ?> cc</small></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <h5 class="text-center">INSTRUKSI PASCA ANESTESI DAN SEDASI</h5>
                <table class="table table-borderless">
                    <tr>
                        <td width="30%">Posisi</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['position']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Analgesia</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['analgesik']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Anti Muntah</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['antiemetik']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Antibiotika</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['antibiotik']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Obat-obatan lain</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['other_drugs']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Infus/transfusi</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['infusion']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Makan/minum</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['eat']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Pemantauan tensi,nadi,napas tiap menit selama</td>
                        <td width="1%">:</td>
                        <td></td>
                    </tr>
                </table>
                <div class="row justify-content-center">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</div>
<div class="page-break landscape">

    <body>

        <div class="container-fluid mt-5">
            <div class="row mb-5">
                <div class="col-2 d-flex">
                    <img class="mt-2 mx-auto" src="<?= base_url() ?>assets/img/logo.png"
                        style="width: 100px; height: 100px;">
                </div>
                <div class="col-6 text-center">
                    <h1>CATATAN ANESTESI DAN SEDASI</h1>
                </div>
                <div class="col-4">
                    <div class="border border-1" style="height: auto; min-height:100px;">
                        <table class="table table-borderless">
                            <tr class="mb-0">
                                <td width="30%">Nama</td>
                                <td width="1%">:</td>
                                <td><?= $anestesi['visit']['diantar_oleh']; ?></td>
                            </tr>
                            <tr class="mb-0">
                                <td width="30%">Umur</td>
                                <td width="1%">:</td>
                                <td><?= $anestesi['visit']['age']; ?></td>
                            </tr>
                            <tr class="mb-0">
                                <td width="30%">Alamat</td>
                                <td width="1%">:</td>
                                <td><?= $anestesi['visit']['contact_address']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="DiagnosisPreTb" class="table tablecustom-responsive">
                    <span>Diagnosis Preoperatif</span>
                    <table class="table">
                        <thead class="table">
                            <tr>
                                <th scope="col">Diagnosis</th>
                                <th scope="col">Jenis Kasus</th>
                                <th scope="col">Kategori Diagnosis</th>

                            </tr>
                        </thead>

                        <tbody id="tabelsRenderdiagPreoperatif" class="table-group-divider">
                            <tr>
                                <td colspan="10" class="text-center">Data Kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div id="DiagnosisPostTb" class="table tablecustom-responsive">
                    <span>Diagnosis Postoperatif</span>
                    <table class="table">
                        <thead class="table">
                            <tr>
                                <th scope="col">Diagnosis</th>
                                <th scope="col">Jenis Kasus</th>
                                <th scope="col">Kategori Diagnosis</th>

                            </tr>
                        </thead>

                        <tbody id="tabelsRenderdiagPostoperatif" class="table-group-divider">
                            <tr>
                                <td colspan="10" class="text-center">Data Kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="waktu_prosedur" class="fw-bold">Macam Prosedur</label>
                        <span type="text" class="form-control" id="macam-prosedur-treat-name"
                            placeholder="Waktu Prosedur">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="jenis_bedah">Team</label>
                        <div class="row" id="bodyTimOperasiAnesthesiLengkap-cetak">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tanggal_operasi" class="fw-bold">Tanggal Operasi:</label>
                            <span><?= tanggal_indo(date_format(date_create(@$anestesi['val']['start_operation']), 'Y-m-d'));  ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tanda_vital">Keadaan Prainduksi:</label>
                            <div class="row">

                                <div id="CAnestesiandsedasi-1" class="table tablecustom-responsive">
                                    <table class="table">
                                        <thead class="table">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">TD(S)</th>
                                                <th scope="col">TD(D)</th>
                                                <th scope="col">NADI</th>
                                                <th scope="col">SUHU</th>
                                                <th scope="col">RR</th>
                                                <th scope="col">SPO2</th>
                                                <th scope="col">CATATAN</th>
                                                <th scope="col">STAFF NAME</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyDataCAnestesiandsedasi" class="table-group-divider">
                                            <tr>
                                                <td colspan="10" class="text-center">Data Kosong</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Pemeriksaan_fisik" class="fw-bold">Pemeriksaan fisik</label>
                            <div class="row" id="Pemeriksaan_fisikck"></div>
                            <label for="Pemeriksaan_fisik" class="fw-bold">Mallampati</label>
                            <div class="row" id="Pemeriksaan_fisikck-malapati"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="anastesi" class="fw-bold">Anamnesis</label>
                            <div class="row" id="ckAnamnesis">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="auto">
                                        <label class="form-check-label" for="auto">
                                            Auto
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="regional">
                                        <label class="form-check-label" for="regional">
                                            Regional
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="lainnya">
                                        <label class="form-check-label" for="lainnya">
                                            Lainnya
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="status_psa" class="fw-bold">STATUS FISIK ASA</label>
                            <div class="row" id="asa-canestesi-sedasi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="checklist_operasi" class="fw-bold">Checklist Operasi</label>
                            <div class="row" id="checklist_operasi-canestesi-sedasi">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_area_prosedur">
                                        <label class="form-check-label" for="cek_area_prosedur">
                                            Cek area prosedur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_persiapan_alat">
                                        <label class="form-check-label" for="cek_persiapan_alat">
                                            Persiapan alat-alat
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_identitas_pasien">
                                        <label class="form-check-label" for="cek_identitas_pasien">
                                            Identitas pasien
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="teknik_resusitasi" class="fw-bold">Teknik Anestesi</label>
                            <div class="row" id='teknik-anestesi-canestesi-sedasi'>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_oral">
                                        <label class="form-check-label" for="cek_oral">
                                            Oral
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_nasal">
                                        <label class="form-check-label" for="cek_nasal">
                                            Nasal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_intubasi">
                                        <label class="form-check-label" for="cek_intubasi">
                                            Intubasi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_tracheal">
                                        <label class="form-check-label" for="cek_tracheal">
                                            Tracheal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_bib_sagital">
                                        <label class="form-check-label" for="cek_bib_sagital">
                                            Bib sagital
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="monitoring" class="fw-bold">Monitoring</label>
                            <div class="row" id="monitoring-cas">
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_nadi">
                                        <label class="form-check-label" for="cek_nadi">
                                            Nadi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_ecg">
                                        <label class="form-check-label" for="cek_ecg">
                                            ECG
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_nip_saturator">
                                        <label class="form-check-label" for="cek_nip_saturator">
                                            NIP Saturator
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_temperatur">
                                        <label class="form-check-label" for="cek_temperatur">
                                            Temperatur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_dic">
                                        <label class="form-check-label" for="cek_dic">
                                            DIC
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-auto" align="center">
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode-anestesi"></div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Pasien</div>
                <div class="mb-1">
                    <div id="qrcode-anestesi1"></div>
                </div>
            </div>
        </div>
    </body>

</div>

<div class="">
    <script>
    var qrcode1 = new QRCode(document.getElementById("qrcode-anestesi"), {
        text: `<?= $visit['fullname']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    var qrcode = new QRCode(document.getElementById("qrcode-anestesi1"), {
        text: `<?= $visit['diantar_oleh']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        let val = <?= json_encode($anestesi['val']); ?>;
        let aParamVal = <?= json_encode($anestesi['a_paramVal']); ?>;
        let aParam = <?= json_encode($anestesi['a_param']); ?>;
        getRequestVtRangeAnesthesia({
            vactination_id: <?= json_encode(@$val['document_id']); ?>,
            filters: ["13", "all", "11"],
            body_requestCharts: ["myChartMonitoringDurante", "myChartMonitoringRecoveryRoom", null],
            body_requestTables: ["bodyDatamyChartMonitoringDurante",
                "bodyDatamyChartMonitoringRecoveryRoom",
                "bodyDataCAnestesiandsedasi"
            ]
        });

        renderAlldata({
            aParamVal: aParamVal,
            val: val,
            aParam: aParam
        })

        getDataTreatment(val)
    })



    const ChartMonitoringDurante1 = (props) => {
        let rawData = props?.data || [];
        let dataRendersTables = '';

        let groupedData = {};

        rawData?.forEach(item => {
            let dateTime = item?.examination_date ? moment(item?.examination_date).format(
                'DD MMM YYYY HH:mm') : null;
            if (dateTime && !groupedData[dateTime]) {
                groupedData[dateTime] = {
                    nadi: [],
                    temperature: [],
                    saturasi: [],
                    tension_upper: [],
                    tension_below: []
                };
            }
            if (dateTime) {
                groupedData[dateTime].nadi.push(parseInt(item?.nadi ?? 0));
                groupedData[dateTime].temperature.push(parseInt(item?.temperature ?? 0));
                groupedData[dateTime].saturasi.push(parseInt(item?.saturasi ?? 10));
                groupedData[dateTime].tension_upper.push(parseInt(item?.tension_upper ?? 0));
                groupedData[dateTime].tension_below.push(parseInt(item?.tension_below ?? 0));
            }
        });


        let allDates = Object.keys(groupedData);
        let dates = Array.from(new Set(allDates.map(dt => moment(dt, 'DD MMM YYYY HH:mm').format(
            'DD MMM YYYY'))));
        let times = allDates.map(dt => moment(dt, 'DD MMM YYYY HH:mm').format('HH:mm'));

        let labels = dates.flatMap(date => times.filter((_, index) => allDates[index].startsWith(date)));


        if (props?.body_requestChart) {
            let datasets = [{
                    label: 'Nadi',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.nadi.reduce((a, b) => a + b, 0) / (groupedData[
                            key]?.nadi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(235, 125, 52, 0.2)',
                    borderColor: '#eb7d34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yNadi'
                },
                {
                    label: 'Suhu',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.temperature.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.temperature.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(52, 101, 235, 0.2)',
                    borderColor: '#3465eb',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTemperature'
                },
                {
                    label: 'SPO2',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.saturasi.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.saturasi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(18, 41, 105, 0.2)',
                    borderColor: '#122969',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'ySaturasi'
                },
                {
                    label: 'Sistole',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.tension_upper.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.tension_upper.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(61, 235, 52, 0.2)',
                    borderColor: '#3deb34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTension'
                },
                {
                    label: 'Diastole',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.tension_below.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.tension_below.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(61, 235, 52, 0.2)',
                    borderColor: '#3deb34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTension'
                },
                {
                    label: 'Respirasi',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.nadi.reduce((a, b) => a + b, 0) / (groupedData[
                            key]?.nadi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(230, 242, 5, 0.2)',
                    borderColor: '#e6f205',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yRespirasi'
                }
            ];

            const ctxChart = document?.getElementById(`${props?.body_requestChart}`)?.getContext('2d');
            new Chart(ctxChart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    plugins: {
                        datalabels: false
                    },
                    scales: {
                        yNadi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Nadi'
                            }
                        },
                        yTemperature: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Suhu'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        ySaturasi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'SPO2'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        yTension: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Tekanan Darah'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        yRespirasi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Respirasi'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            });
        }


        const tableBody = $(`#${props?.body_requestTabels}`);
        if (tableBody.length) {
            dataRendersTables = rawData.map(item => `
                                    <tr>
                                        <td>${moment(item?.examination_date).format('DD MMM YYYY HH:mm')}</td>
                                        <td>${item?.tension_upper ?? 0}</td>
                                        <td>${item?.tension_below?? 0}</td>
                                        <td>${item?.nadi?? 0}</td>
                                        <td>${item?.temperature?? 0}</td>
                                        <td>${item?.nafas?? 0}</td>
                                        <td>${item?.saturasi?? 0}</td>
                                        <td>${item?.pemeriksaan ?? "-"}</td>
                                        <td>${item?.petugas ?? "-"}</td>
                                    </tr>
                                `).join('');

            tableBody.html(dataRendersTables);
        } else {
            console.log("Table body element not found.");
        }
    };

    const getRequestVtRangeAnesthesia1 = (props) => {
        let {
            vactination_id,
            filters,
            body_requestCharts,
            body_requestTables
        } = props;




        filters.forEach((filter, index) => {
            postData({
                document_id: vactination_id ?? "",
                filter: filter ?? ""
            }, 'admin/PatientOperationRequest/getDataVitailSignRangeAnesthesia', (res) => {

                if (res.respon && res.data.examination_info.length > 0) {
                    ChartMonitoringDurante({
                        data: res.data.examination_info,
                        body_requestChart: body_requestCharts[
                            index],
                        body_requestTabels: body_requestTables[index]
                    });
                } else {
                    $(`#${body_requestTables[index]}`).closest('.box.box-info').hide();
                    if (body_requestCharts[index]) {
                        $(`#${body_requestCharts[index]}`).closest('.box.box-info').hide();
                    }
                }
            });
        });
    };


    const getDataDiagnosaPreoperatif1 = (props) => {
        let result = ''
        const sufferTypes = {
            "0": "BELUM DIIDENTIFIKASI",
            "1": "KASUS BARU",
            "2": "KASUS LAMA",
            "11": "KASUS BEDAH",
            "12": "KASUS NON BEDAH",
            "13": "KASUS KEBIDANAN",
            "14": "KASUS PSKIATRIK",
            "15": "KASUS ANAK"
        };
        const diagCategories = {
            "1": "DIAGNOSA UTAMA",
            "2": "DIAGNOSA PENUNJANG /SEKUNDER",
            "3": "DIAGNOSA MASUK",
            "4": "DIAGNOSA HARIAN/ KERJA",
            "5": "DIAGNOSA KECELAKAAN",
            "6": "DIAGNOSA KEMATIAN",
            "7": "DIAGNOSA BANDING",
            "8": "DIAGNOSA UTAMA EKLAIM",
            "9": "DIAGNOSA SEKUNDER EKLAIM",
            "10": "DIAGNOSA AKTUAL (KEPERAWATAN)",
            "11": "DIAGNOSA RESIKO(KEPERAWATAN)",
            "12": "DIAGNOSA PROMOSI KESEHATAN (KEPERAWATAN)",
            "13": "DIAGNOSA PRA OPERASI",
            "14": "DIAGNOSA PASCA OPERASI",
            "15": "DIAGNOSA OPERASI"
        };
        if (props?.data) {
            props?.data?.diagnosa?.map(item => {
                const sufferTypeText = sufferTypes[item?.suffer_type] || "Unknown";
                const diagCatText = diagCategories[item?.diag_cat] || "Unknown";
                result += `<tr>
                            <td>${item?.diagnosa_name}</td>
                            <td>${sufferTypeText}</td>
                            <td>${diagCatText}</td>
                        </tr>`
            })

            $("#tabelsRenderdiagPreoperatif").html(result)

        }

    }

    const renderDataTeamInPembedahanAnesthesiLengkap1 = (result) => {
        const labels = result?.labels || [];
        const data = result?.data || [];

        const groupedData = data.reduce((acc, item) => {
            const label = labels.find(lbl => lbl.task_id === item?.task_id);
            const taskName = label ? label.task : item?.task_id;

            const category = taskName.split(' ')[0];

            if (!acc[category]) {
                acc[category] = [];
            }
            acc[category].push({
                ...item,
                taskName
            });
            return acc;
        }, {});

        const categories = Object.entries(groupedData);
        const half = Math.ceil(categories.length / 2);
        const leftCategories = categories.slice(0, half);
        const rightCategories = categories.slice(half);

        let hasil = `
                    <div class="d-flex justify-content-between">
                        <div class="flex-fill me-2">
                            ${leftCategories.map(([category, tasks]) => `
                                <div class="form-group mb-3">
                                    <h5 class="fw-bold">${category}</h5>
                                    ${tasks.map(item => `
                                        <div class="d-flex align-items-center mb-2 ms-4">
                                            <label class="fw-bold me-3 w-25">${item.taskName}</label>
                                            <span class="w-75">${item?.doctor}</span>
                                        </div>
                                    `).join('')}
                                    <hr />
                                </div>
                            `).join('')}
                        </div>
                        <div class="flex-fill ms-2">
                            ${rightCategories.map(([category, tasks]) => `
                                <div class="form-group mb-3">
                                    <h5 class="fw-bold">${category}</h5>
                                    ${tasks.map(item => `
                                        <div class="d-flex align-items-center mb-2 ms-4">
                                            <label class="fw-bold me-3 w-25">${item.taskName}</label>
                                            <span class="w-75">${item?.doctor}</span>
                                        </div>
                                    `).join('')}
                                    <hr />
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;

        $(`#bodyTimOperasiAnesthesiLengkap-cetak`).html(hasil);
    }

    const templateOprasiPembedahanAnesthesiLengkap1 = (props) => {
        let data = props?.data
        renderDataTeamInPembedahanAnesthesiLengkap({
            data: data?.operation_team,
            labels: data?.operation_task
        });

    }


    const renderAlldata1 = (props) => {
        quillInstances = {};
        dataDrain = [];
        globalBodyId = '';

        postData({
            id: <?= json_encode(@$val['document_id']); ?>,
            visit_id: <?= json_encode(@$val['visit_id']); ?>
        }, 'admin/PatientOperationRequest/getAllArcodions', (res) => {

            if (res.respon) {
                let result = res?.data
                getDataDiagnosaPreoperatif({
                    data: {
                        diagnosa: result?.diagnosas
                    }
                })

                getDataDiagnosaPostoperatif({
                    pasien_diagnosa_id: result?.assessment_anesthesia?.body_id,
                    vactination_id: result?.assessment_anesthesia?.document_id
                });

                templateOprasiPembedahanAnesthesiLengkap({
                    data: {
                        operation_team: result?.operation_team,
                        operation_task: result?.operation_task

                    }
                })

                getDataAsaRender({
                    aParamVal: props?.aParamVal,
                    val: props?.val
                })

                getDatateknikAnesRender({
                    aParamVal: props?.aParam,
                    val: props?.val
                })


            }
        })
    }


    const getDataDiagnosaPostoperatif1 = (props) => {
        const sufferTypes = {
            "0": "BELUM DIIDENTIFIKASI",
            "1": "KASUS BARU",
            "2": "KASUS LAMA",
            "11": "KASUS BEDAH",
            "12": "KASUS NON BEDAH",
            "13": "KASUS KEBIDANAN",
            "14": "KASUS PSKIATRIK",
            "15": "KASUS ANAK"
        };
        const diagCategories = {
            "1": "DIAGNOSA UTAMA",
            "2": "DIAGNOSA PENUNJANG /SEKUNDER",
            "3": "DIAGNOSA MASUK",
            "4": "DIAGNOSA HARIAN/ KERJA",
            "5": "DIAGNOSA KECELAKAAN",
            "6": "DIAGNOSA KEMATIAN",
            "7": "DIAGNOSA BANDING",
            "8": "DIAGNOSA UTAMA EKLAIM",
            "9": "DIAGNOSA SEKUNDER EKLAIM",
            "10": "DIAGNOSA AKTUAL (KEPERAWATAN)",
            "11": "DIAGNOSA RESIKO(KEPERAWATAN)",
            "12": "DIAGNOSA PROMOSI KESEHATAN (KEPERAWATAN)",
            "13": "DIAGNOSA PRA OPERASI",
            "14": "DIAGNOSA PASCA OPERASI",
            "15": "DIAGNOSA OPERASI"
        };
        postData({
            pasien_diagnosa_id: props?.pasien_diagnosa_id
        }, 'admin/PatientOperationRequest/getDiagnosassDockterData', (res) => {
            if (res.respon && Array.isArray(res.data)) {
                let result = "";
                res?.data?.map(item => {
                    const sufferTypeText = sufferTypes[item?.suffer_type] || "Unknown";
                    const diagCatText = diagCategories[item?.diag_cat] || "Unknown";
                    result += `<tr>
                            <td>${item?.diagnosa_name}</td>
                            <td>${sufferTypeText}</td>
                            <td>${diagCatText}</td>
                        </tr>`
                })
                $("#tabelsRenderdiagPostoperatif").html(result)

            }
        });
    };



    const getDataTreatment1 = (data) => {
        getDataList(
            'admin/PatientOperationRequest/getTreatment',
            (res) => {
                let macam_procedure = res?.find(item => item?.tarif_id === data?.tarif_id)
                $("#macam-prosedur-treat-name").html(macam_procedure?.tarif_name)
                $("#nama-tindakan").html(macam_procedure?.tarif_name)

                // res.
            },
            () => {
                // console.log('Before send callback');
            }
        );
    };

    const getDataAsaRender1 = (props) => {
        let htmlContent = '';
        let htmlContentckAnamnesis = '';
        let htmlContentckfisik = '';


        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS006' && item.parameter_id === "22") {
                const isChecked = item?.value_id === props?.val?.asa_class ? 'checked' : '';

                htmlContent += `
            <div class="col-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${isChecked} onclick="return false;">
                    <label class="form-check-label" for="checkbox_${index + 1}">
                        ${item?.value_desc}
                    </label>
                </div>
            </div>
        `;
            }
        });

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && item.parameter_id === "20") {
                const isChecked = item?.value_id === props?.val?.auto_anamnesis ? 'checked' : '';

                htmlContentckAnamnesis += `
            <div class="col-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${isChecked} onclick="return false;">
                    <label class="form-check-label" for="checkbox_${index + 1}">
                        ${item?.value_desc}
                    </label>
                </div>
            </div>
        `;
            }
        });

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS006' && item.parameter_id === "21") {
                const isChecked = item?.value_id === props?.val?.mallampati ? 'checked' : '';

                htmlContentckfisik += `
            <div class="col-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${isChecked} onclick="return false;">
                    <label class="form-check-label" for="checkbox_${index + 1}">
                        ${item?.value_desc}
                    </label>
                </div>
            </div>
        `;
            }
        });


        $("#Pemeriksaan_fisikck-malapati").html(htmlContentckfisik);
        $("#asa-canestesi-sedasi").html(htmlContent);
        $("#ckAnamnesis").html(htmlContentckAnamnesis);
    };

    const getDatateknikAnesRender1 = (props) => {
        let htmlContent = '';
        let htmlContentChecklist = '';
        let htmlContentPemeriksaan_fisik = '';
        let htmlContentmonitoring = '';

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS006' && parseInt(item.parameter_id) >= 26 && parseInt(item
                    .parameter_id) <=
                32) {
                htmlContent += `
            <div class="col-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                    <label class="form-check-label" for="checkbox_${index + 1}">
                        ${item?.parameter_desc}
                    </label>
                </div>
            </div>
        `;
            }
        });

        $("#teknik-anestesi-canestesi-sedasi").html(htmlContent);

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && parseInt(item.parameter_id) >= 22 && parseInt(item
                    .parameter_id) <=
                25) {


                htmlContentChecklist += `
            <div class="col-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                    <label class="form-check-label" for="checkbox_${index + 1}">
                        ${item?.parameter_desc}
                    </label>
                </div>
            </div>
        `;
            }
        });

        $("#checklist_operasi-canestesi-sedasi").html(htmlContentChecklist);

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && parseInt(item.parameter_id) >= 16 && parseInt(item
                    .parameter_id) <=
                19) {


                htmlContentPemeriksaan_fisik += `
            <div class="col-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                    <label class="form-check-label" for="checkbox_${index + 1}">
                        ${item?.parameter_desc}
                    </label>
                </div>
            </div>
        `;
            }
        });

        $("#Pemeriksaan_fisikck").html(htmlContentPemeriksaan_fisik);

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && parseInt(item.parameter_id) >= 4 && parseInt(item
                    .parameter_id) <=
                11) {


                htmlContentmonitoring += `
            <div class="col-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                    <label class="form-check-label" for="checkbox_${index + 1}">
                        ${item?.parameter_desc}
                    </label>
                </div>
            </div>
        `;
            }
        });

        $("#monitoring-cas").html(htmlContentmonitoring);


    };
    </script>
</div>


<?php elseif ($type === 'TRIASE'): ?>
<!-- ========================================================== -->
<div class="page-break">
    <!doctype html>
    <html lang="en">

    <body>
        <div class="container-fluid mt-5">
            <!-- template header -->
            <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php"); ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Triage</b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$triaseIgd['val']['ats_tipe']) ? @$triaseIgd['val']['ats_tipe'] : '-'; ?>
                            </p>
                        </td>
                    </tr>
                    <?php if(!empty($triaseIgd['val']['ats_tipe'])): ?>
                    <tr>
                        <td class="p-1">
                            <b><?= @$triaseIgd['val']['ats_tipe']; ?></b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$triaseIgd['val']['ats_item']) ? @$triaseIgd['val']['ats_item']:'-'; ?></p>
                        </td>
                    </tr>
                    <?php endif;?>
                    <?php if (!empty($triaseIgd['val']['hamil']) && ($triaseIgd['val']['hamil'] === "Hamil")): ?>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>Hamil</b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$triaseIgd['val']['hamil']) ? @$triaseIgd['val']['hamil']:'-'; ?></p>
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
                            <p class="m-0 mt-1 p-0"><?= @$triaseIgd['val']['hamil_g']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>P</b>
                            <p class="m-0 mt-1 p-0"><?= @$triaseIgd['val']['hamil_p']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>A</b>
                            <p class="m-0 mt-1 p-0"><?= @$triaseIgd['val']['hamil_a']; ?></p>
                        </td>
                    </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </body>

    </html>


</div>
<?php elseif ($type === 'PNJG'): ?>
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
                        <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                            <?= @$kop['fax'] ?? "-"?>,
                            <?= @$kop['kota'] ?? "-"?></p>
                        <p><?= @$kop['sk'] ?? "-"?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kemenkes.png" width="70px">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kars-bintang.png" width="70px">
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
                                <div id="noLab_rm-lab"></div>
                            </td>
                        </tr> -->
                        <tr>
                            <th>Nama Pasien</th>
                            <th>:</th>
                            <th>
                                <div id="name_patient-lab"></div>
                            </th>
                        </tr>
                        <tr>
                            <td>J. Kelamin</td>
                            <td>:</td>
                            <td>
                                <div id="gender_patient-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl. Lahir - Umur</td>
                            <td>:</td>
                            <td>
                                <div id="date_age-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>No.Telp.</td>
                            <td>:</td>
                            <td>
                                <div id="no_tlp-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat Pasien</td>
                            <td>:</td>
                            <td>
                                <div id="adresss_patient-lab"></div>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <!--kanan -->
                        <!-- <tr>
                            <td>Tgl.Priksa</td>
                            <td>:</td>
                            <td>
                                <div id="date_check-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl. Sampel</td>
                            <td>:</td>
                            <td>
                                <div id="date_sampel-lab"></div>
                            </td>
                        </tr> -->
                        <tr>
                            <td>Cara Bayar</td>
                            <td>:</td>
                            <td>
                                <div id="payment_method-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Dokter Pengirim</td>
                            <td>:</td>
                            <td>
                                <div id="doctor_send-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ruang/ Poliklinik</td>
                            <td>:</td>
                            <td>
                                <div id="room_poli-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosa Klinis</td>
                            <td>:</td>
                            <td>
                                <div id="diagnosa_klinis-lab"></div>
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
                            <th style="width: 5%;">Satuan</th>
                            <th style="width: 7%;">Nilai Rujukan</th>
                            <th style="width: 15%;">Metode</th>
                            <th style="width: 2%;">Flag</th>
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

                <h6>Expertise :</h6>
                <p>Note: Rapid Antigen SARS-CoV-2
                    * Spesimen : Swab Nasofaring/ Orofaring
                    * Hasil negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen di bawah level deteksi
                    alat
                    * Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih berisiko
                    menularkan
                    ke orang lain,
                    disarankan tes ulang atau tes konfirmasi dengan NAAT (Nucleic Acid Amplification Tests), bila
                    probabilitas pretes relatif tinggi,
                    terutama bila pasien bergejala atau diketahui memikili kontak dengan orang yang terkonfirmasi
                    COVID-19
                </p>


                <div class="row mb-2">
                    <div class="col-3" align="center">
                        <br>
                        <div>Approve & Cetak</div>
                        <div id="qrcode-container">
                            <div id="qrcode-lab"></div>
                        </div>
                        <div id="datetime-now-lab"></div>
                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>Diotorasi oleh:<br> Quality Validator</div>
                        <div>
                            <div class="pt-2 pb-2" id="qrcode1-lab"></div>
                        </div>
                        <div id="validator-ttd-lab"></div>
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

        dataRenderTables1Laborat();
        renderDataPatient1Laborat();

    })

    const dataRenderTables1Laborat = () => {
        <?php $dataJsonTables = json_encode($lab); ?>
        let dataTable = <?php echo $dataJsonTables; ?>;
        let groupedData = {};
        dataTable?.forEach(e => {
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
                                            <td>${e.flag_hl === 'L ' || e.flag_hl === 'L' ? `<b style="color:blue;">${e.hasil}</b>` :
                                                e.flag_hl === 'H ' || e.flag_hl === 'H' ? `<b style="color:red;">${e.hasil}</b>` :
                                                e.flag_hl === '(*) ' || e.flag_hl === '(*)' ? `<b style="color:red;">${e.hasil}</b>` :
                                                e.hasil}</td>
                                            <td>${!e.satuan ? "-" : e.satuan}</td>
                                            <td>${!e.nilai_rujukan ? "-" : e.nilai_rujukan}</td>
                                            <td>${!e.metode_periksa ? "-" : e.metode_periksa}</td>
                                            <td>${e.flag_hl === 'L ' || e.flag_hl === 'L' ? `<b style="color:blue;">${e.flag_hl}</b>` :
                                                e.flag_hl === 'H ' || e.flag_hl === 'H' ? `<b style="color:red;">${e.flag_hl}</b>` :
                                                e.flag_hl === '(*)' || e.flag_hl === '(*)' ? `<b style="color:red;">${e.flag_hl}</b>` :
                                                e.flag_hl}</td>
                                        </tr>`;
                                        });
                                    }
                                }
                            }
                        }

                        $("#noLab_rm-lab").html(firstItem?.nolab_lis + '/ ' + firstItem?.norm);
                        $("#name_patient-lab").html(firstItem?.nama);
                        $("#adresss_patient-lab").html(firstItem?.alamat);
                        $("#date_check-lab").html(formattedCheckDate);
                        $("#date_sampel-lab").html(formattedSampleDate);
                        $("#payment_method-lab").html(firstItem?.cara_bayar_name);
                        $("#doctor_send-lab").html(firstItem?.pengirim_name);
                        $("#room_poli-lab").html(firstItem?.ruang_name);
                        $("#doctor-responsible-lab").html(firstItem?.pengirim_name);
                        $("#validator-ttd-lab").html(firstItem?.pengirim_name);

                        isFirstGroup = false;
                    }
                }
            }

            $("#render-tables").html(dataResultTable);

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

        new QRCode(document.getElementById("qrcode1-lab"), {
            text: `${dataTable[0]?.pengirim_name}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        new QRCode(document.getElementById("qrcode-lab"), {
            text: `<?= user()->fullname; ?> | ${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    }
    const renderDataPatient1Laborat = () => {
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>
        // render patient 
        $("#gender_patient-lab").html(data?.name_of_gender)
        $("#date_age-lab").html(moment(data?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.age)
        $("#no_tlp-lab").html(data?.phone_number)
        $("#diagnosa_klinis-lab").html(data?.diagnosa)
    }
    </script>

    </html>

</div>
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
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                            <?= @$kop['fax'] ?? "-"?>,
                            <?= @$kop['kota'] ?? "-"?></p>
                        <p><?= @$kop['sk'] ?? "-"?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kemenkes.png" width="70px">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kars-bintang.png" width="70px">
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
    // window.print();
    </script>

    </html>
</div>
<?php else: ?>
<div class="page-break">

    <body>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-6">
                    <div>
                        <img src="<?= base_url() ?>bpjs.jpeg" alt="BPJS KESEHATAN" style="width: 230px;">
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
                            <div class="col-sm-7">
                                <span><?=@$kop['display']?> - <?=@$kop['kota']?></span>
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
                        <h6 class="text-center"><b>SURAT ELIGIBILITAS PESERTA <br> <?=@$kop['display']?></b></h6>
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
                                <h6><?=@$kop['display']?>,
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
                        <h6 class="text-center"><b>SURAT BUKTI PELAYANAN <br> NAMA RS : <?=@$kop['display']?> KODE RS :
                                0701R001 KELAS RS : B
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
                                <h6><?=@$kop['display']?>,............. <br>Dokter Pemeriksa</h6>
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
        window.print();
        </script>

    </body>

</div>

<!-- ========================================================== -->
<div class="page-break">

    <body>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-6">
                    <div>
                        <img src="<?= base_url() ?>bpjs.jpeg" alt="BPJS KESEHATAN" style="width: 230px;">
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
                        <h6 class="text-center"><b>SURAT RENCANA KONTROL <br> <?=@$kop['display']?></b></h6>
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
        window.print();
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
            <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php"); ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Triage</b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$triaseIgd['val']['ats_tipe']) ? @$triaseIgd['val']['ats_tipe'] : '-'; ?>
                            </p>
                        </td>
                    </tr>
                    <?php if(!empty($triaseIgd['val']['ats_tipe'])): ?>
                    <tr>
                        <td class="p-1">
                            <b><?= @$triaseIgd['val']['ats_tipe']; ?></b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$triaseIgd['val']['ats_item']) ? @$triaseIgd['val']['ats_item']:'-'; ?></p>
                        </td>
                    </tr>
                    <?php endif;?>
                    <?php if (!empty($triaseIgd['val']['hamil']) && ($triaseIgd['val']['hamil'] === "Hamil")): ?>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>Hamil</b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$triaseIgd['val']['hamil']) ? @$triaseIgd['val']['hamil']:'-'; ?></p>
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
                            <p class="m-0 mt-1 p-0"><?= @$triaseIgd['val']['hamil_g']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>P</b>
                            <p class="m-0 mt-1 p-0"><?= @$triaseIgd['val']['hamil_p']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>A</b>
                            <p class="m-0 mt-1 p-0"><?= @$triaseIgd['val']['hamil_a']; ?></p>
                        </td>
                    </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </body>

    </html>


</div>

<!-- ========================================================== -->

<div class="page-break">

    <body>
        <div class="container-fluid mt-5">
            <!-- template header -->
            <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php"); ?>
            <!-- end of template header -->

            <!-- <div class="row">
                <h4>Laporan Persalinan</h4>
            </div> -->
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
            <?php if (isset($persalinan['apgarData']) && isset($apgarWaktu)) : ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" width="25%"></td>
                        <?php foreach ($apgarWaktu as $key => $waktu) : ?>
                        <th class="p-1" width="25%"><?= $waktu['p_description'] ?></th>
                        <?php endforeach ?>
                    </tr>
                    <?php $totalSkor = 0; ?>
                    <?php foreach ($persalinan['apgarData'] as $key => $row) : ?>
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
            <?php endif; ?>

            <div class="row">
                <div class="col-auto" align="center">
                    <div>Dokter</div>
                    <div class="mb-1">
                        <div id="qrcode"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Bidan</div>
                    <div class="mb-1">
                        <div id="qrcode1"></div>
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
</div>

<!-- ========================================================== -->
<div class="page-break">

    <body>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-auto text-center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="90px">
                </div>
                <div class="col text-center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                        <?= @$kop['fax'] ?? "-"?>,
                        <?= @$kop['kota'] ?? "-"?></p>
                    <p><?= @$kop['sk'] ?? "-"?></p>
                </div>
                <div class="col-auto text-center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="90px">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><?= $oprasi['title']; ?></h4>
            </div>
            <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Nomor RM</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['no_registration']; ?></p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Nama Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['diantar_oleh']; ?></p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Jenis Kelamin</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['gendername']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Tanggal Lahir (Usia)</b>
                            <p class="m-0 mt-1 p-0">
                                <?= date("d M Y", strtotime($oprasi['visit']['date_of_birth'])) . ' (' . (!empty($oprasi['visit']['age']) ? $oprasi['visit']['age'] : 'N/A') . ')'; ?>
                            </p>


                        </td>
                        <td class="p-1" style="width:66.3%" colspan="2">
                            <b>Alamat Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['visitor_address']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['fullname_inap']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['name_of_clinic_from']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['in_date'] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Kelas</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['class_room']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Bangsal/Kamar</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['name_of_clinic']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Bed</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['bed']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (isset($oprasi['operation_team'])) : ?>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($oprasi['operation_team'] as $key => $team) : ?>
                <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b><?= $team['task'] ?></b>
                    <p class="m-0 mt-1 p-0"><?= @$team['doctor']; ?></p>
                </div>
                <?php endforeach ?>
            </div>
            <?php endif; ?>

            <?php if (isset($oprasi['diagnosas'])) : ?>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <ul><b>Diagnosa Pra Operasi</b>
                        <?php
                        $diagnosa_pra = array_filter($oprasi['diagnosas'], function ($item) {
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
                        <?= date_format(date_create(@$oprasi['val']['start_operation']), 'd-m-Y H:i'); ?></p>
                    <b>Waktu Selesai</b>
                    <p class="m-0 mt-1 p-0">
                        <?= date_format(date_create(@$oprasi['val']['end_operation']), 'd-m-Y H:i'); ?></p>
                    <b>Ada Penundaan?</b>
                    <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['terlayani'] == 0 ? 'Tidak' : 'Ada'; ?></p>
                </div>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <ul><b>Diagnosa Pasca Operasi</b>
                        <?php
                        $diagnosa_pasca = array_filter($oprasi['diagnosas'], function ($item) {
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
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['tarif_name']; ?></p>
                    </td>
                    <td width="33.3%">
                        <b>Tipe Operasi</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['tipe_operasi']; ?></p>
                    </td>
                    <td width="33.3%">
                        <b>Operasi Ke</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['re_operation'] == 'OP080801' ? '1' : 're-do';  ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="33.3%">
                        <b>Profilaksis</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['profilaksis'] == 'OP080901' ? 'Ya' : 'Tidak'; ?>
                        </p>
                    </td>
                    <td width="33.3%">
                        <b>Jenis Antibiotik</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['antibiotic_desc']; ?></p>
                    </td>
                    <td width="33.3%">
                        <b>Waktu Pemberian</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['antibiotic_time']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Uraian Pembedahan</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['operation_desc']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Komplikasi</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['komplikasi']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Nomor Implant</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['implant']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" width="66.6%">
                        <b>Konsultasi Intra-Operatif</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['konsultasi']; ?></p>
                    </td>
                    <td>
                        <b>Jumlah Pendarahan</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['bleeding']; ?> CC</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Jaringan Ke Patologi</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['patologi_desc']; ?></p>
                    </td>
                </tr>
            </table>


            <div class="row">
                <div class="col-auto" align="center">
                    <div>Dokter</div>
                    <div class="mb-1">
                        <div id="qrcode-oprasi"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Pasien</div>
                    <div class="mb-1">
                        <div id="qrcode-oprasi1"></div>
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
    var qrcode = new QRCode(document.getElementById("qrcode-opras"), {
        text: `<?= $oprasi['visit']['fullname']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    </script>
    <script>
    var qrcode = new QRCode(document.getElementById("qrcode-opras1"), {
        text: `<?= $oprasi['visit']['diantar_oleh']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    </script>

</div>

<!-- ========================================================== -->
<div class="page-break landscape">

    <body>
        <div class="row align-items-center mb-3">
            <div class="col-2 px-0 d-flex">
                <img class="mt-2 mx-auto" src="<?= base_url() ?>assets/img/logo.png"
                    style="width: 100px; height: 100px;">
            </div>
            <div class="col-6 px-0 text-center">
                <h1 class="px-1">CATATAN KAMAR PEMULIHAN</h1>
            </div>
            <div class="col-4 px-0">
                <div class="border border-1" style="height: auto; min-height:100px;">
                    <table class="table table-borderless">
                        <tr class="mb-0">
                            <td width="30%">Nama</td>
                            <td width="1%">:</td>
                            <td><?= $anestesi['visit']['diantar_oleh']; ?></td>
                        </tr>
                        <tr class="mb-0">
                            <td width="30%">Umur</td>
                            <td width="1%">:</td>
                            <td><?= $anestesi['visit']['age']; ?></td>
                        </tr>
                        <tr class="mb-0">
                            <td width="30%">Alamat</td>
                            <td width="1%">:</td>
                            <td><?= $anestesi['visit']['contact_address']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between gap-3">
            <div class="col-7">
                <h5 class="text-center">MONITORING DURANTEE OPERASI</h5>
                <div class="row">
                    <div id="cairanMasuk" class="table tablecustom-responsive">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <canvas id="myChartMonitoringRecoveryRoom" width="auto" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="monitoringRecoveryRoom-1" class="table tablecustom-responsive">
                        <table class="table">
                            <thead class="table">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">TD(S)</th>
                                    <th scope="col">TD(D)</th>
                                    <th scope="col">NADI</th>
                                    <th scope="col">SUHU</th>
                                    <th scope="col">RR</th>
                                    <th scope="col">SPO2</th>
                                    <th scope="col">CATATAN</th>
                                    <th scope="col">STAFF NAME</th>
                                </tr>
                            </thead>
                            <tbody id="bodyDatamyChartMonitoringRecoveryRoom" class="table-group-divider">
                                <tr>
                                    <td colspan="10" class="text-center">Data Kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Tindakan</th>
                                <th scope="col">Tandatangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-8"><span id="nama-tindakan"></span></td>
                                <td class="col-4"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-4">
                <h5 class="text-center">KRITERIA KELUAR KAMAR PULIH</h5>
                <table class="table table-bordered">
                    <?php foreach (@$anestesi['steward_score'] as $key => $steward) : ?>
                    <tr>
                        <th colspan="2" class="text-center">steward Score</th>
                    </tr>
                    <tr class="text-center">
                        <th>Kriteria</th>
                        <th width="1%">Score</th>
                    </tr>
                    <?php foreach (@$steward as $strd) : ?>
                    <tr>
                        <td><?= $strd['value_desc']; ?></td>
                        <td class="text-center"><?= $strd['value_score']; ?></td>
                    </tr>
                    <?php endforeach; ?>

                    <?php endforeach; ?>
                </table>
                <table class="table table-bordered">
                    <?php foreach ($anestesi['aldrete_score'] as $key => $aldrete) : ?>
                    <tr>
                        <th colspan="2" class="text-center">Aldrete Score</th>
                    </tr>
                    <tr class="text-center">
                        <th>Kriteria</th>
                        <th width="1%">Score</th>
                    </tr>
                    <?php foreach ($aldrete as $aldr) : ?>
                    <tr>
                        <td><?= $aldr['value_desc']; ?></td>
                        <td class="text-center"><?= $aldr['value_score']; ?></td>
                    </tr>
                    <?php endforeach; ?>

                    <?php endforeach; ?>
                </table>
                <?php if (!empty($anestesi['bromage_score'])) : ?>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2" class="text-center">Bromage Score</th>
                    </tr>
                    <tr class="text-center">
                        <th>Kriteria</th>
                        <th width="1%">Score</th>
                    </tr>
                    <?php foreach ($anestesi['bromage_score'] as $key => $bromage) : ?>
                    <tr>
                        <td><?= $bromage['value_desc']; ?></td>
                        <td class="text-center"><?= $bromage['value_score']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </body>
</div>
<div class="page-break landscape">

    <body>
        <div class="d-flex gap-2">
            <div class="col-3">
                <?php foreach ($anestesi['infusion'] as $key => $infus) : ?>
                <b><?= $key; ?></b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($infus as $index => $valInfus) : ?>
                    <?php if ($valInfus['entry_type'] == '3' || $valInfus['entry_type'] == '7') : ?>
                    <div class="col-6 p-0">
                        <input type="checkbox" onclick="return false;"
                            <?= $valInfus['checked'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $valInfus['value_desc']; ?></small></label>
                    </div>
                    <?php elseif ($valInfus['entry_type'] == '2') : ?>
                    <input type="checkbox" onclick="return false;" <?= $valInfus['value_id'] == 1 ? 'checked' : ''; ?>>
                    <label for=""><?= $valInfus['value_desc']; ?></label>
                    <?php else : ?>
                    <small class="mb-0"><?= $valInfus['value_id']; ?></small>
                    <label for=""><?= $valInfus['value_desc']; ?></label>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endforeach ?>

                <b>1. General Anestesia</b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($anestesi['general_entry_type']['entries'] as $key => $entry) : ?>
                    <div class="col-6 p-0">
                        <?php if ($entry['entry_type'] == '2') : ?>
                        <input type="checkbox" onclick="return false;" <?= $entry['value_id'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $entry['parameter_desc']; ?></small></label>
                        <?php else : ?>
                        <small><?= $entry['parameter_desc']; ?> : </small>
                        <small><?= $entry['value_id']; ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php foreach ($anestesi['general'] as $key => $gen) : ?>
                <?php if (!in_array($key, $anestesi['general_entry_type']['keys'])) : ?>
                <b><?= $key; ?></b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($gen as $index => $valGen) : ?>
                    <?php if ($valGen['entry_type'] == '3' || $valGen['entry_type'] == '7') : ?>
                    <div class="col-6 p-0">
                        <?php if ($valGen['entry_type'] == '3' || $valGen['entry_type'] == '7') : ?>
                        <input type="checkbox" onclick="return false;" <?= $valGen['checked'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $valGen['value_desc']; ?></small></label>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php endforeach ?>
                <b>Ventilasi</b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($anestesi['ventilasi_entry_type']['entries'] as $key => $entry_ven) : ?>
                    <div class="col-6 p-0">
                        <?php if ($entry_ven['entry_type'] == '2') : ?>
                        <input type="checkbox" onclick="return false;"
                            <?= $entry_ven['value_id'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $entry_ven['parameter_desc']; ?></small></label>
                        <?php else : ?>
                        <small><?= $entry_ven['parameter_desc']; ?> : </small>
                        <small><?= $entry_ven['value_id']; ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php foreach ($anestesi['ventilasi'] as $key => $ven) : ?>
                <?php if (!in_array($key, $anestesi['ventilasi_entry_type']['keys'])) : ?>
                <b><?= $key; ?></b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($ven as $index => $valVen) : ?>
                    <div class="col-6 p-0">
                        <?php if ($valVen['entry_type'] == '3' || $valVen['entry_type'] == '7') : ?>
                        <input type="checkbox" onclick="return false;" <?= $valVen['checked'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $valVen['value_desc']; ?></small></label>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php endforeach ?>
                <b>Jalan Napas</b><br>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($anestesi['jalan_napas_entry_type']['entries'] as $key => $entry_jalan_napas) : ?>
                    <div class="col-6 p-0">
                        <?php if ($entry_jalan_napas['entry_type'] == '2') : ?>
                        <input type="checkbox" onclick="return false;"
                            <?= $entry_jalan_napas['value_id'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $entry_jalan_napas['parameter_desc']; ?></small></label>
                        <?php else : ?>
                        <small><?= $entry_jalan_napas['parameter_desc']; ?> : </small>
                        <small><?= $entry_jalan_napas['value_id']; ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php foreach ($anestesi['jalan_napas'] as $key => $napas) : ?>
                <?php if (!in_array($key, $anestesi['jalan_napas_entry_type']['keys'])) : ?>
                <b><?= $key; ?></b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($napas as $index => $valJalan) : ?>
                    <div class="col-6 p-0">
                        <?php if ($valJalan['entry_type'] == '3' || $valJalan['entry_type'] == '7') : ?>
                        <input type="checkbox" onclick="return false;"
                            <?= $valJalan['checked'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $valJalan['value_desc']; ?></small></label>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php endforeach ?>


                <b>2. Regional Anestesia</b>

                <?php foreach ($anestesi['regional'] as $key => $reg) : ?>
                <?php if (!in_array($key, $anestesi['regional_entry_type']['keys'])) : ?>
                <b><?= $key; ?></b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($reg as $index => $valReg) : ?>
                    <div class="col-6 p-0">
                        <?php if ($valReg['entry_type'] == '3' || $valReg['entry_type'] == '7') : ?>
                        <input type="checkbox" onclick="return false;" <?= $valReg['checked'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $valReg['value_desc']; ?></small></label>
                        <?php else : ?>
                        <small><?= $valReg['value_id']; ?></small>
                        <label for=""><?= $valReg['value_desc']; ?></label>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php endforeach ?>

                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($anestesi['regional_entry_type']['entries'] as $key => $entry_regional) : ?>
                    <div class="col-6 p-0">
                        <?php if ($entry_regional['entry_type'] == '2') : ?>
                        <input type="checkbox" onclick="return false;"
                            <?= $entry_regional['value_id'] == 1 ? 'checked' : ''; ?>>
                        <label for=""><small><?= $entry_regional['parameter_desc']; ?></small></label>
                        <?php else : ?>
                        <small><?= $entry_regional['parameter_desc']; ?> : </small>
                        <small><?= $entry_regional['value_id']; ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-6">
                <h5 class="text-center">MONITORING DURANTEE OPERASI</h5>
                <div class="row">
                    <div id="cairanMasuk-1" class="table tablecustom-responsive">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <canvas id="myChartMonitoringDurante" width="auto" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="monitoringDurante-1" class="table tablecustom-responsive">
                        <table class="table">
                            <thead class="table">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">TD(S)</th>
                                    <th scope="col">TD(D)</th>
                                    <th scope="col">NADI</th>
                                    <th scope="col">SUHU</th>
                                    <th scope="col">RR</th>
                                    <th scope="col">SPO2</th>
                                    <th scope="col">CATATAN</th>
                                    <th scope="col">STAFF NAME</th>
                                </tr>
                            </thead>
                            <tbody id="bodyDatamyChartMonitoringDurante" class="table-group-divider">
                                <tr>
                                    <td colspan="10" class="text-center">Data Kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-6">
                        Cairan Masuk
                        <table class="table borderless">
                            <?php foreach ($anestesi['cairan_masuk'] as $key => $cm) : ?>
                            <tr>
                                <td><small><?= date_format(date_create($cm['date']), 'd-m-Y'); ?></small></td>
                                <td><small><?= $cm['name']; ?></small></td>
                                <td><small><?= $cm['quantity']; ?> cc</small></td>
                            </tr>

                            <?php endforeach; ?>
                            <?php
                            $array_cairan_masuk = array_filter($anestesi['cairan'], fn ($item) => $item['cairan_masuk'] === 1);

                            foreach ($array_cairan_masuk as $key => $c) : ?>
                            <tr>
                                <td><small><?= date_format(date_create($c['examination_date']), 'd-m-Y'); ?></small>
                                </td>
                                <td><small><?= $c['value_desc']; ?></small></td>
                                <td><small><?= $c['fluid_amount']; ?> cc</small></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="col-6">
                        Cairan Keluar
                        <table class="table table-borderless">
                            <?php
                            $array_cairan_keluar = array_filter($anestesi['cairan'], fn ($item) => $item['cairan_masuk'] === 0);

                            foreach ($array_cairan_keluar as $key => $ck) : ?>
                            <tr>
                                <td><small><?= date_format(date_create($ck['examination_date']), 'd-m-Y'); ?></small>
                                </td>
                                <td><small><?= $ck['value_desc']; ?></small></td>
                                <td><small><?= $ck['fluid_amount']; ?> cc</small></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <h5 class="text-center">INSTRUKSI PASCA ANESTESI DAN SEDASI</h5>
                <table class="table table-borderless">
                    <tr>
                        <td width="30%">Posisi</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['position']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Analgesia</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['analgesik']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Anti Muntah</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['antiemetik']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Antibiotika</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['antibiotik']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Obat-obatan lain</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['other_drugs']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Infus/transfusi</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['infusion']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Makan/minum</td>
                        <td width="1%">:</td>
                        <td><?= @$anestesi['instruksi_post']['eat']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Pemantauan tensi,nadi,napas tiap menit selama</td>
                        <td width="1%">:</td>
                        <td></td>
                    </tr>
                </table>
                <div class="row justify-content-center">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</div>
<div class="page-break landscape">

    <body>

        <div class="container-fluid mt-5">
            <div class="row mb-5">
                <div class="col-2 d-flex">
                    <img class="mt-2 mx-auto" src="<?= base_url() ?>assets/img/logo.png"
                        style="width: 100px; height: 100px;">
                </div>
                <div class="col-6 text-center">
                    <h1>CATATAN ANESTESI DAN SEDASI</h1>
                </div>
                <div class="col-4">
                    <div class="border border-1" style="height: auto; min-height:100px;">
                        <table class="table table-borderless">
                            <tr class="mb-0">
                                <td width="30%">Nama</td>
                                <td width="1%">:</td>
                                <td><?= $anestesi['visit']['diantar_oleh']; ?></td>
                            </tr>
                            <tr class="mb-0">
                                <td width="30%">Umur</td>
                                <td width="1%">:</td>
                                <td><?= $anestesi['visit']['age']; ?></td>
                            </tr>
                            <tr class="mb-0">
                                <td width="30%">Alamat</td>
                                <td width="1%">:</td>
                                <td><?= $anestesi['visit']['contact_address']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="DiagnosisPreTb" class="table tablecustom-responsive">
                    <span>Diagnosis Preoperatif</span>
                    <table class="table">
                        <thead class="table">
                            <tr>
                                <th scope="col">Diagnosis</th>
                                <th scope="col">Jenis Kasus</th>
                                <th scope="col">Kategori Diagnosis</th>

                            </tr>
                        </thead>

                        <tbody id="tabelsRenderdiagPreoperatif" class="table-group-divider">
                            <tr>
                                <td colspan="10" class="text-center">Data Kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div id="DiagnosisPostTb" class="table tablecustom-responsive">
                    <span>Diagnosis Postoperatif</span>
                    <table class="table">
                        <thead class="table">
                            <tr>
                                <th scope="col">Diagnosis</th>
                                <th scope="col">Jenis Kasus</th>
                                <th scope="col">Kategori Diagnosis</th>

                            </tr>
                        </thead>

                        <tbody id="tabelsRenderdiagPostoperatif" class="table-group-divider">
                            <tr>
                                <td colspan="10" class="text-center">Data Kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="waktu_prosedur" class="fw-bold">Macam Prosedur</label>
                        <span type="text" class="form-control" id="macam-prosedur-treat-name"
                            placeholder="Waktu Prosedur">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="jenis_bedah">Team</label>
                        <div class="row" id="bodyTimOperasiAnesthesiLengkap-cetak">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tanggal_operasi" class="fw-bold">Tanggal Operasi:</label>
                            <span><?= tanggal_indo(date_format(date_create(@$anestesi['val']['start_operation']), 'Y-m-d'));  ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tanda_vital">Keadaan Prainduksi:</label>
                            <div class="row">

                                <div id="CAnestesiandsedasi-1" class="table tablecustom-responsive">
                                    <table class="table">
                                        <thead class="table">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">TD(S)</th>
                                                <th scope="col">TD(D)</th>
                                                <th scope="col">NADI</th>
                                                <th scope="col">SUHU</th>
                                                <th scope="col">RR</th>
                                                <th scope="col">SPO2</th>
                                                <th scope="col">CATATAN</th>
                                                <th scope="col">STAFF NAME</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyDataCAnestesiandsedasi" class="table-group-divider">
                                            <tr>
                                                <td colspan="10" class="text-center">Data Kosong</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Pemeriksaan_fisik" class="fw-bold">Pemeriksaan fisik</label>
                            <div class="row" id="Pemeriksaan_fisikck"></div>
                            <label for="Pemeriksaan_fisik" class="fw-bold">Mallampati</label>
                            <div class="row" id="Pemeriksaan_fisikck-malapati"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="anastesi" class="fw-bold">Anamnesis</label>
                            <div class="row" id="ckAnamnesis">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="auto">
                                        <label class="form-check-label" for="auto">
                                            Auto
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="regional">
                                        <label class="form-check-label" for="regional">
                                            Regional
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="lainnya">
                                        <label class="form-check-label" for="lainnya">
                                            Lainnya
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="status_psa" class="fw-bold">STATUS FISIK ASA</label>
                            <div class="row" id="asa-canestesi-sedasi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="checklist_operasi" class="fw-bold">Checklist Operasi</label>
                            <div class="row" id="checklist_operasi-canestesi-sedasi">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_area_prosedur">
                                        <label class="form-check-label" for="cek_area_prosedur">
                                            Cek area prosedur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_persiapan_alat">
                                        <label class="form-check-label" for="cek_persiapan_alat">
                                            Persiapan alat-alat
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_identitas_pasien">
                                        <label class="form-check-label" for="cek_identitas_pasien">
                                            Identitas pasien
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="teknik_resusitasi" class="fw-bold">Teknik Anestesi</label>
                            <div class="row" id='teknik-anestesi-canestesi-sedasi'>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_oral">
                                        <label class="form-check-label" for="cek_oral">
                                            Oral
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_nasal">
                                        <label class="form-check-label" for="cek_nasal">
                                            Nasal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_intubasi">
                                        <label class="form-check-label" for="cek_intubasi">
                                            Intubasi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_tracheal">
                                        <label class="form-check-label" for="cek_tracheal">
                                            Tracheal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_bib_sagital">
                                        <label class="form-check-label" for="cek_bib_sagital">
                                            Bib sagital
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="monitoring" class="fw-bold">Monitoring</label>
                            <div class="row" id="monitoring-cas">
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_nadi">
                                        <label class="form-check-label" for="cek_nadi">
                                            Nadi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_ecg">
                                        <label class="form-check-label" for="cek_ecg">
                                            ECG
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_nip_saturator">
                                        <label class="form-check-label" for="cek_nip_saturator">
                                            NIP Saturator
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_temperatur">
                                        <label class="form-check-label" for="cek_temperatur">
                                            Temperatur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_dic">
                                        <label class="form-check-label" for="cek_dic">
                                            DIC
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-auto" align="center">
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode-anestesi"></div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Pasien</div>
                <div class="mb-1">
                    <div id="qrcode-anestesi1"></div>
                </div>
            </div>
        </div>
    </body>

</div>

<div class="">
    <script>
    var qrcode1 = new QRCode(document.getElementById("qrcode-anestesi"), {
        text: `<?= $visit['fullname']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    var qrcode = new QRCode(document.getElementById("qrcode-anestesi1"), {
        text: `<?= $visit['diantar_oleh']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        let val = <?= json_encode($anestesi['val']); ?>;
        let aParamVal = <?= json_encode($anestesi['a_paramVal']); ?>;
        let aParam = <?= json_encode($anestesi['a_param']); ?>;
        getRequestVtRangeAnesthesia({
            vactination_id: <?= json_encode(@$val['document_id']); ?>,
            filters: ["13", "all", "11"],
            body_requestCharts: ["myChartMonitoringDurante", "myChartMonitoringRecoveryRoom", null],
            body_requestTables: ["bodyDatamyChartMonitoringDurante",
                "bodyDatamyChartMonitoringRecoveryRoom",
                "bodyDataCAnestesiandsedasi"
            ]
        });

        renderAlldata({
            aParamVal: aParamVal,
            val: val,
            aParam: aParam
        })

        getDataTreatment(val)
    })



    const ChartMonitoringDurante = (props) => {
        let rawData = props?.data || [];
        let dataRendersTables = '';

        let groupedData = {};

        rawData?.forEach(item => {
            let dateTime = item?.examination_date ? moment(item?.examination_date).format(
                'DD MMM YYYY HH:mm') : null;
            if (dateTime && !groupedData[dateTime]) {
                groupedData[dateTime] = {
                    nadi: [],
                    temperature: [],
                    saturasi: [],
                    tension_upper: [],
                    tension_below: []
                };
            }
            if (dateTime) {
                groupedData[dateTime].nadi.push(parseInt(item?.nadi ?? 0));
                groupedData[dateTime].temperature.push(parseInt(item?.temperature ?? 0));
                groupedData[dateTime].saturasi.push(parseInt(item?.saturasi ?? 10));
                groupedData[dateTime].tension_upper.push(parseInt(item?.tension_upper ?? 0));
                groupedData[dateTime].tension_below.push(parseInt(item?.tension_below ?? 0));
            }
        });


        let allDates = Object.keys(groupedData);
        let dates = Array.from(new Set(allDates.map(dt => moment(dt, 'DD MMM YYYY HH:mm').format(
            'DD MMM YYYY'))));
        let times = allDates.map(dt => moment(dt, 'DD MMM YYYY HH:mm').format('HH:mm'));

        let labels = dates.flatMap(date => times.filter((_, index) => allDates[index].startsWith(date)));


        if (props?.body_requestChart) {
            let datasets = [{
                    label: 'Nadi',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.nadi.reduce((a, b) => a + b, 0) / (groupedData[
                            key]?.nadi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(235, 125, 52, 0.2)',
                    borderColor: '#eb7d34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yNadi'
                },
                {
                    label: 'Suhu',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.temperature.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.temperature.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(52, 101, 235, 0.2)',
                    borderColor: '#3465eb',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTemperature'
                },
                {
                    label: 'SPO2',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.saturasi.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.saturasi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(18, 41, 105, 0.2)',
                    borderColor: '#122969',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'ySaturasi'
                },
                {
                    label: 'Sistole',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.tension_upper.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.tension_upper.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(61, 235, 52, 0.2)',
                    borderColor: '#3deb34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTension'
                },
                {
                    label: 'Diastole',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.tension_below.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.tension_below.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(61, 235, 52, 0.2)',
                    borderColor: '#3deb34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTension'
                },
                {
                    label: 'Respirasi',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.nadi.reduce((a, b) => a + b, 0) / (groupedData[
                            key]?.nadi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(230, 242, 5, 0.2)',
                    borderColor: '#e6f205',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yRespirasi'
                }
            ];

            const ctxChart = document?.getElementById(`${props?.body_requestChart}`)?.getContext('2d');
            new Chart(ctxChart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    plugins: {
                        datalabels: false
                    },
                    scales: {
                        yNadi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Nadi'
                            }
                        },
                        yTemperature: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Suhu'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        ySaturasi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'SPO2'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        yTension: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Tekanan Darah'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        yRespirasi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Respirasi'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            });
        }


        const tableBody = $(`#${props?.body_requestTabels}`);
        if (tableBody.length) {
            dataRendersTables = rawData.map(item => `
                                        <tr>
                                            <td>${moment(item?.examination_date).format('DD MMM YYYY HH:mm')}</td>
                                            <td>${item?.tension_upper ?? 0}</td>
                                            <td>${item?.tension_below?? 0}</td>
                                            <td>${item?.nadi?? 0}</td>
                                            <td>${item?.temperature?? 0}</td>
                                            <td>${item?.nafas?? 0}</td>
                                            <td>${item?.saturasi?? 0}</td>
                                            <td>${item?.pemeriksaan ?? "-"}</td>
                                            <td>${item?.petugas ?? "-"}</td>
                                        </tr>
                                    `).join('');

            tableBody.html(dataRendersTables);
        } else {
            console.log("Table body element not found.");
        }
    };

    const getRequestVtRangeAnesthesia = (props) => {
        let {
            vactination_id,
            filters,
            body_requestCharts,
            body_requestTables
        } = props;




        filters.forEach((filter, index) => {
            postData({
                document_id: vactination_id ?? "",
                filter: filter ?? ""
            }, 'admin/PatientOperationRequest/getDataVitailSignRangeAnesthesia', (res) => {

                if (res.respon && res.data.examination_info.length > 0) {
                    ChartMonitoringDurante({
                        data: res.data.examination_info,
                        body_requestChart: body_requestCharts[
                            index],
                        body_requestTabels: body_requestTables[index]
                    });
                } else {
                    $(`#${body_requestTables[index]}`).closest('.box.box-info').hide();
                    if (body_requestCharts[index]) {
                        $(`#${body_requestCharts[index]}`).closest('.box.box-info').hide();
                    }
                }
            });
        });
    };


    const getDataDiagnosaPreoperatif = (props) => {
        let result = ''
        const sufferTypes = {
            "0": "BELUM DIIDENTIFIKASI",
            "1": "KASUS BARU",
            "2": "KASUS LAMA",
            "11": "KASUS BEDAH",
            "12": "KASUS NON BEDAH",
            "13": "KASUS KEBIDANAN",
            "14": "KASUS PSKIATRIK",
            "15": "KASUS ANAK"
        };
        const diagCategories = {
            "1": "DIAGNOSA UTAMA",
            "2": "DIAGNOSA PENUNJANG /SEKUNDER",
            "3": "DIAGNOSA MASUK",
            "4": "DIAGNOSA HARIAN/ KERJA",
            "5": "DIAGNOSA KECELAKAAN",
            "6": "DIAGNOSA KEMATIAN",
            "7": "DIAGNOSA BANDING",
            "8": "DIAGNOSA UTAMA EKLAIM",
            "9": "DIAGNOSA SEKUNDER EKLAIM",
            "10": "DIAGNOSA AKTUAL (KEPERAWATAN)",
            "11": "DIAGNOSA RESIKO(KEPERAWATAN)",
            "12": "DIAGNOSA PROMOSI KESEHATAN (KEPERAWATAN)",
            "13": "DIAGNOSA PRA OPERASI",
            "14": "DIAGNOSA PASCA OPERASI",
            "15": "DIAGNOSA OPERASI"
        };
        if (props?.data) {
            props?.data?.diagnosa?.map(item => {
                const sufferTypeText = sufferTypes[item?.suffer_type] || "Unknown";
                const diagCatText = diagCategories[item?.diag_cat] || "Unknown";
                result += `<tr>
                                <td>${item?.diagnosa_name}</td>
                                <td>${sufferTypeText}</td>
                                <td>${diagCatText}</td>
                            </tr>`
            })

            $("#tabelsRenderdiagPreoperatif").html(result)

        }

    }

    const renderDataTeamInPembedahanAnesthesiLengkap = (result) => {
        const labels = result?.labels || [];
        const data = result?.data || [];

        const groupedData = data.reduce((acc, item) => {
            const label = labels.find(lbl => lbl.task_id === item?.task_id);
            const taskName = label ? label.task : item?.task_id;

            const category = taskName.split(' ')[0];

            if (!acc[category]) {
                acc[category] = [];
            }
            acc[category].push({
                ...item,
                taskName
            });
            return acc;
        }, {});

        const categories = Object.entries(groupedData);
        const half = Math.ceil(categories.length / 2);
        const leftCategories = categories.slice(0, half);
        const rightCategories = categories.slice(half);

        let hasil = `
                        <div class="d-flex justify-content-between">
                            <div class="flex-fill me-2">
                                ${leftCategories.map(([category, tasks]) => `
                                    <div class="form-group mb-3">
                                        <h5 class="fw-bold">${category}</h5>
                                        ${tasks.map(item => `
                                            <div class="d-flex align-items-center mb-2 ms-4">
                                                <label class="fw-bold me-3 w-25">${item.taskName}</label>
                                                <span class="w-75">${item?.doctor}</span>
                                            </div>
                                        `).join('')}
                                        <hr />
                                    </div>
                                `).join('')}
                            </div>
                            <div class="flex-fill ms-2">
                                ${rightCategories.map(([category, tasks]) => `
                                    <div class="form-group mb-3">
                                        <h5 class="fw-bold">${category}</h5>
                                        ${tasks.map(item => `
                                            <div class="d-flex align-items-center mb-2 ms-4">
                                                <label class="fw-bold me-3 w-25">${item.taskName}</label>
                                                <span class="w-75">${item?.doctor}</span>
                                            </div>
                                        `).join('')}
                                        <hr />
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;

        $(`#bodyTimOperasiAnesthesiLengkap-cetak`).html(hasil);
    }

    const templateOprasiPembedahanAnesthesiLengkap = (props) => {
        let data = props?.data
        renderDataTeamInPembedahanAnesthesiLengkap({
            data: data?.operation_team,
            labels: data?.operation_task
        });

    }


    const renderAlldata = (props) => {
        quillInstances = {};
        dataDrain = [];
        globalBodyId = '';

        postData({
            id: <?= json_encode(@$val['document_id']); ?>,
            visit_id: <?= json_encode(@$val['visit_id']); ?>
        }, 'admin/PatientOperationRequest/getAllArcodions', (res) => {

            if (res.respon) {
                let result = res?.data
                getDataDiagnosaPreoperatif({
                    data: {
                        diagnosa: result?.diagnosas
                    }
                })

                getDataDiagnosaPostoperatif({
                    pasien_diagnosa_id: result?.assessment_anesthesia?.body_id,
                    vactination_id: result?.assessment_anesthesia?.document_id
                });

                templateOprasiPembedahanAnesthesiLengkap({
                    data: {
                        operation_team: result?.operation_team,
                        operation_task: result?.operation_task

                    }
                })

                getDataAsaRender({
                    aParamVal: props?.aParamVal,
                    val: props?.val
                })

                getDatateknikAnesRender({
                    aParamVal: props?.aParam,
                    val: props?.val
                })


            }
        })
    }


    const getDataDiagnosaPostoperatif = (props) => {
        const sufferTypes = {
            "0": "BELUM DIIDENTIFIKASI",
            "1": "KASUS BARU",
            "2": "KASUS LAMA",
            "11": "KASUS BEDAH",
            "12": "KASUS NON BEDAH",
            "13": "KASUS KEBIDANAN",
            "14": "KASUS PSKIATRIK",
            "15": "KASUS ANAK"
        };
        const diagCategories = {
            "1": "DIAGNOSA UTAMA",
            "2": "DIAGNOSA PENUNJANG /SEKUNDER",
            "3": "DIAGNOSA MASUK",
            "4": "DIAGNOSA HARIAN/ KERJA",
            "5": "DIAGNOSA KECELAKAAN",
            "6": "DIAGNOSA KEMATIAN",
            "7": "DIAGNOSA BANDING",
            "8": "DIAGNOSA UTAMA EKLAIM",
            "9": "DIAGNOSA SEKUNDER EKLAIM",
            "10": "DIAGNOSA AKTUAL (KEPERAWATAN)",
            "11": "DIAGNOSA RESIKO(KEPERAWATAN)",
            "12": "DIAGNOSA PROMOSI KESEHATAN (KEPERAWATAN)",
            "13": "DIAGNOSA PRA OPERASI",
            "14": "DIAGNOSA PASCA OPERASI",
            "15": "DIAGNOSA OPERASI"
        };
        postData({
            pasien_diagnosa_id: props?.pasien_diagnosa_id
        }, 'admin/PatientOperationRequest/getDiagnosassDockterData', (res) => {
            if (res.respon && Array.isArray(res.data)) {
                let result = "";
                res?.data?.map(item => {
                    const sufferTypeText = sufferTypes[item?.suffer_type] || "Unknown";
                    const diagCatText = diagCategories[item?.diag_cat] || "Unknown";
                    result += `<tr>
                                <td>${item?.diagnosa_name}</td>
                                <td>${sufferTypeText}</td>
                                <td>${diagCatText}</td>
                            </tr>`
                })
                $("#tabelsRenderdiagPostoperatif").html(result)

            }
        });
    };



    const getDataTreatment = (data) => {
        getDataList(
            'admin/PatientOperationRequest/getTreatment',
            (res) => {
                let macam_procedure = res?.find(item => item?.tarif_id === data?.tarif_id)
                $("#macam-prosedur-treat-name").html(macam_procedure?.tarif_name)
                $("#nama-tindakan").html(macam_procedure?.tarif_name)

                // res.
            },
            () => {
                // console.log('Before send callback');
            }
        );
    };

    const getDataAsaRender = (props) => {
        let htmlContent = '';
        let htmlContentckAnamnesis = '';
        let htmlContentckfisik = '';


        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS006' && item.parameter_id === "22") {
                const isChecked = item?.value_id === props?.val?.asa_class ? 'checked' : '';

                htmlContent += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${isChecked} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.value_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && item.parameter_id === "20") {
                const isChecked = item?.value_id === props?.val?.auto_anamnesis ? 'checked' : '';

                htmlContentckAnamnesis += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${isChecked} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.value_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS006' && item.parameter_id === "21") {
                const isChecked = item?.value_id === props?.val?.mallampati ? 'checked' : '';

                htmlContentckfisik += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${isChecked} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.value_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });


        $("#Pemeriksaan_fisikck-malapati").html(htmlContentckfisik);
        $("#asa-canestesi-sedasi").html(htmlContent);
        $("#ckAnamnesis").html(htmlContentckAnamnesis);
    };

    const getDatateknikAnesRender = (props) => {
        let htmlContent = '';
        let htmlContentChecklist = '';
        let htmlContentPemeriksaan_fisik = '';
        let htmlContentmonitoring = '';

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS006' && parseInt(item.parameter_id) >= 26 && parseInt(item
                    .parameter_id) <=
                32) {
                htmlContent += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.parameter_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        $("#teknik-anestesi-canestesi-sedasi").html(htmlContent);

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && parseInt(item.parameter_id) >= 22 && parseInt(item
                    .parameter_id) <=
                25) {


                htmlContentChecklist += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.parameter_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        $("#checklist_operasi-canestesi-sedasi").html(htmlContentChecklist);

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && parseInt(item.parameter_id) >= 16 && parseInt(item
                    .parameter_id) <=
                19) {


                htmlContentPemeriksaan_fisik += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.parameter_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        $("#Pemeriksaan_fisikck").html(htmlContentPemeriksaan_fisik);

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && parseInt(item.parameter_id) >= 4 && parseInt(item
                    .parameter_id) <=
                11) {


                htmlContentmonitoring += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.parameter_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        $("#monitoring-cas").html(htmlContentmonitoring);


    };
    </script>
</div>


<!-- ========================================================== -->

<div class="page-break">
    <!doctype html>
    <html lang="en">

    <body>
        <div class="container-fluid mt-5">
            <!-- template header -->
            <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php"); ?>
            <!-- end of template header -->
            <div class="row">
                <h4 class="text-start">Subjektif (S)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Keluhan Utama (Autoanamnesis)</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['anamnesis']; ?></p>
                            <b>Keluhan Utama (Alloanamnesis)</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['alloanamnesis']; ?></p>
                        </td>
                        <td style="width: 33%;">
                            <b>Riwayat Penyakit Sekarang</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_sekarang']; ?></p>
                            <b>Riwayat Penyakit Dahulu</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_dahulu']; ?></p>
                        </td>
                        <td>
                            <b>Riwayat Penyakit Keluarga</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_keluarga']; ?></p>
                            <b>Riwayat Obat Yang Dikonsumsi</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['riwayat_obat_dikonsumsi']; ?></p>
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
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['tensi_atas']; ?> /
                                <?= @$resumeMedis['val']['tensi_bawah']; ?></p>mmHg
                        </td>
                        <td class="p-1">
                            <b>Denyut Nadi</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['tensi_atas']; ?> /
                                <?= @$resumeMedis['val']['tensi_bawah']; ?></p>m
                        </td>
                        <td class="p-1">
                            <b>Suhu Tubuh</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['suhu']; ?> </p>℃
                            </div>
                        </td>
                        <td class="p-1">
                            <b>Respiration Rate</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['respiration']; ?></p>x/m
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>SpO2</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['spo2']; ?></p>
                            </div>
                        </td>
                        <td class="p-1">
                            <b>Berat Badan</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['berat']; ?></p>kg
                            </div>
                        </td>
                        <td colspan="2">
                            <b><i>GCS / Tingkat Kesadaran</i></b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['gcs']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
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
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <b>Diagnosis Masuk</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['pdiagnosa']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Procedure Masuk</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['pprocedures']; ?></p>
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
                                name=""><?= @$resumeMedis['val']['pdiagnosa']; ?></textarea>
                        </td>
                        <td class="p-1">
                            <b>Procedure Pulang</b>
                            <textarea type="text" class="form-control" id=""
                                name=""><?= @$resumeMedis['val']['pprocedures']; ?></textarea>
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
                                name="laboratorium"><?= @$resumeMedis['val']['laboratorium']; ?></textarea>
                        </td>
                        <td class="p-1">
                            <b>Radiologi</b>
                            <textarea type="text" class="form-control" id="radiologi"
                                name="radiologi"><?= @$resumeMedis['val']['radiologi']; ?></textarea>
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
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['farmakologia']; ?></p>
                        </td>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['recipe']['signatura'] ?></p>
                        </td>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['recipe']['tanggal_mulai'] ?></p>
                        </td>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['recipe']['tanggal_selesai'] ?></p>
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
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['val']['farmakologia']; ?></p>
                        </td>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMedis['recipe']['signatura'] ?></p>
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
                        <div id="qrcodeMedis"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Tanda Tangan Pasien/Keluarga</div>
                    <div class="mb-1">
                        <div id="qrcode1Medis"></div>
                    </div>
                </div>
            </div>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->


    </body>

    <script>
    var qrcode = new QRCode(document.getElementById("qrcodeMedis"), {
        text: '<?= @$resumeMedis['val']['dpjp']; ?>',
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    </script>
    <script>
    var qrcode = new QRCode(document.getElementById("qrcode1Medis"), {
        text: '<?= @$resumeMedis['val']['nama']; ?>',
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
    </script>
    <style>
    /* @media print {
        @page {
            margin: none;
            scale: 85;
        }

        .container {
            width: 210mm;
        }
    } */
    </style>
    <script type="text/javascript">
    window.print();
    </script>

    </html>
</div>

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
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                            <?= @$kop['fax'] ?? "-"?>,
                            <?= @$kop['kota'] ?? "-"?></p>
                        <p><?= @$kop['sk'] ?? "-"?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kemenkes.png" width="70px">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kars-bintang.png" width="70px">
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
        //     img.src = '<?= base_url() ?>'assets/img/logo.png;
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
        $("#name_patient-inv").html(data?.name_of_pasien)
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
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                            <?= @$kop['fax'] ?? "-"?>,
                            <?= @$kop['kota'] ?? "-"?></p>
                        <p><?= @$kop['sk'] ?? "-"?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kemenkes.png" width="70px">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kars-bintang.png" width="70px">
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
                                <div id="noLab_rm-lab"></div>
                            </td>
                        </tr> -->
                        <tr>
                            <th>Nama Pasien</th>
                            <th>:</th>
                            <th>
                                <div id="name_patient-lab"></div>
                            </th>
                        </tr>
                        <tr>
                            <td>J. Kelamin</td>
                            <td>:</td>
                            <td>
                                <div id="gender_patient-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl. Lahir - Umur</td>
                            <td>:</td>
                            <td>
                                <div id="date_age-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>No.Telp.</td>
                            <td>:</td>
                            <td>
                                <div id="no_tlp-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat Pasien</td>
                            <td>:</td>
                            <td>
                                <div id="adresss_patient-lab"></div>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <!--kanan -->
                        <!-- <tr>
                            <td>Tgl.Priksa</td>
                            <td>:</td>
                            <td>
                                <div id="date_check-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl. Sampel</td>
                            <td>:</td>
                            <td>
                                <div id="date_sampel-lab"></div>
                            </td>
                        </tr> -->
                        <tr>
                            <td>Cara Bayar</td>
                            <td>:</td>
                            <td>
                                <div id="payment_method-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Dokter Pengirim</td>
                            <td>:</td>
                            <td>
                                <div id="doctor_send-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ruang/ Poliklinik</td>
                            <td>:</td>
                            <td>
                                <div id="room_poli-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosa Klinis</td>
                            <td>:</td>
                            <td>
                                <div id="diagnosa_klinis-lab"></div>
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
                            <th style="width: 5%;">Satuan</th>
                            <th style="width: 7%;">Nilai Rujukan</th>
                            <th style="width: 15%;">Metode</th>
                            <th style="width: 2%;">Flag</th>
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

                <h6>Expertise :</h6>
                <p>Note: Rapid Antigen SARS-CoV-2
                    * Spesimen : Swab Nasofaring/ Orofaring
                    * Hasil negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen di bawah level deteksi
                    alat
                    * Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih berisiko
                    menularkan
                    ke orang lain,
                    disarankan tes ulang atau tes konfirmasi dengan NAAT (Nucleic Acid Amplification Tests), bila
                    probabilitas pretes relatif tinggi,
                    terutama bila pasien bergejala atau diketahui memikili kontak dengan orang yang terkonfirmasi
                    COVID-19
                </p>


                <div class="row mb-2">
                    <div class="col-3" align="center">
                        <br>
                        <div>Approve & Cetak</div>
                        <div id="qrcode-container">
                            <div id="qrcode-lab"></div>
                        </div>
                        <div id="datetime-now-lab"></div>
                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>Diotorasi oleh:<br> Quality Validator</div>
                        <div>
                            <div class="pt-2 pb-2" id="qrcode1-lab"></div>
                        </div>
                        <div id="validator-ttd-lab"></div>
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

        dataRenderTablesLaborat();
        renderDataPatientLaborat();

    })

    const dataRenderTablesLaborat = () => {
        <?php $dataJsonTables = json_encode($lab); ?>
        let dataTable = <?php echo $dataJsonTables; ?>;
        let groupedData = {};
        dataTable?.forEach(e => {
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
                                            <td>${e.flag_hl === 'L ' || e.flag_hl === 'L' ? `<b style="color:blue;">${e.hasil}</b>` :
                                                e.flag_hl === 'H ' || e.flag_hl === 'H' ? `<b style="color:red;">${e.hasil}</b>` :
                                                e.flag_hl === '(*) ' || e.flag_hl === '(*)' ? `<b style="color:red;">${e.hasil}</b>` :
                                                e.hasil}</td>
                                            <td>${!e.satuan ? "-" : e.satuan}</td>
                                            <td>${!e.nilai_rujukan ? "-" : e.nilai_rujukan}</td>
                                            <td>${!e.metode_periksa ? "-" : e.metode_periksa}</td>
                                            <td>${e.flag_hl === 'L ' || e.flag_hl === 'L' ? `<b style="color:blue;">${e.flag_hl}</b>` :
                                                e.flag_hl === 'H ' || e.flag_hl === 'H' ? `<b style="color:red;">${e.flag_hl}</b>` :
                                                e.flag_hl === '(*)' || e.flag_hl === '(*)' ? `<b style="color:red;">${e.flag_hl}</b>` :
                                                e.flag_hl}</td>
                                        </tr>`;
                                        });
                                    }
                                }
                            }
                        }

                        $("#noLab_rm-lab").html(firstItem?.nolab_lis + '/ ' + firstItem?.norm);
                        $("#name_patient-lab").html(firstItem?.nama);
                        $("#adresss_patient-lab").html(firstItem?.alamat);
                        $("#date_check-lab").html(formattedCheckDate);
                        $("#date_sampel-lab").html(formattedSampleDate);
                        $("#payment_method-lab").html(firstItem?.cara_bayar_name);
                        $("#doctor_send-lab").html(firstItem?.pengirim_name);
                        $("#room_poli-lab").html(firstItem?.ruang_name);
                        $("#doctor-responsible-lab").html(firstItem?.pengirim_name);
                        $("#validator-ttd-lab").html(firstItem?.pengirim_name);

                        isFirstGroup = false;
                    }
                }
            }

            $("#render-tables").html(dataResultTable);

            function addImageToQRCode1() {
                var qrElement = document.getElementById("qrcode");
                var qrCanvas = qrElement.querySelector('canvas');

                var img = new Image();
                img.src = '<?= base_url() ?>'
                assets / img / logo.png;

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

        new QRCode(document.getElementById("qrcode1-lab"), {
            text: `${dataTable[0]?.pengirim_name}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        new QRCode(document.getElementById("qrcode-lab"), {
            text: `<?= user()->fullname; ?> | ${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    }
    const renderDataPatientLaborat = () => {
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>
        // render patient 
        $("#gender_patient-lab").html(data?.name_of_gender)
        $("#date_age-lab").html(moment(data?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.age)
        $("#no_tlp-lab").html(data?.phone_number)
        $("#diagnosa_klinis-lab").html(data?.diagnosa)
    }
    </script>

    </html>

</div>

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
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                            <?= @$kop['fax'] ?? "-"?>,
                            <?= @$kop['kota'] ?? "-"?></p>
                        <p><?= @$kop['sk'] ?? "-"?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kemenkes.png" width="70px">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kars-bintang.png" width="70px">
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
    // window.print();
    </script>

    </html>
</div>

<!-- ========================================================== -->
<div class="page-break">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>

    <?php foreach ($anotomi as $item): ?>
    <?php 
        if ($item['file_image'] !== NULL) {
            $filePath = WRITEPATH . $item['file_image']; 
            if (file_exists($filePath)) {
                $fileType = mime_content_type($filePath); 
                $fileContent = base64_encode(file_get_contents($filePath)); 
                $item['file_image_base64'] = 'data:' . $fileType . ';base64,' . $fileContent; 
            } else {
                $item['file_image_base64'] = null; 
            }
        } else {
            $item['file_image_base64'] = null; 
        }
    ?>


    <?php if (!empty($item['file_image_base64'])): ?>
    <?php 
        $fileType = substr($item['file_image_base64'], 5, strpos($item['file_image_base64'], ';') - 5); 
    ?>

    <?php 
        if ($fileType === 'application/pdf') {
    ?>
    <div class="pdf-container" style="margin-bottom: 20px;">
        <div id="pdf-container-<?php echo md5($item['file_image']); ?>" style="width: 100%;"></div>
    </div>

    <script>
    const base64PDF = '<?= $item['file_image_base64']; ?>';
    const pdfData1 = atob(base64PDF.split(',')[1]);
    const loadingTask1 = pdfjsLib.getDocument({
        data: new Uint8Array(pdfData1.split("").map(function(c) {
            return c.charCodeAt(0);
        }))
    });

    loadingTask1.promise.then(function(pdf) {
        const container = document.getElementById('pdf-container-<?php echo md5($item['file_image']); ?>');
        let renderComplete = 0;

        for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
            pdf.getPage(pageNumber).then(function(page) {
                const scale = 1.5;
                const viewport = page.getViewport({
                    scale: scale
                });

                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                container.appendChild(canvas);

                page.render({
                    canvasContext: context,
                    viewport: viewport
                }).promise.then(() => {
                    renderComplete++;

                });
            });
        }
    }).catch(function(error) {
        console.error('Error loading PDF: ' + error);
    });
    </script>

    <?php 
        } else if (strpos($fileType, 'image/') === 0) { 
    ?>
    <div class="image-container" style="margin-top: 20px; margin-bottom: 20px;">
        <img src="<?= $item['file_image_base64']; ?>" alt="Image"
            style="width: 100%; max-height: 500px; object-fit: contain;" />
    </div>
    <?php } ?>
    <?php endif; ?>

    <?php endforeach; ?>
</div>

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
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                            <?= @$kop['fax'] ?? "-"?>,
                            <?= @$kop['kota'] ?? "-"?></p>
                        <p><?= @$kop['sk'] ?? "-"?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kemenkes.png" width="70px">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/kars-bintang.png" width="70px">
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