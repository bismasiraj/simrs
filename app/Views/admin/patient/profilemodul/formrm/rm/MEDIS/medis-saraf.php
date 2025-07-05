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

        <div class="row">
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
            </div>
            <div class="col mt-2" align="center">
                <h3><?= @$kop['name_of_org_unit'] ?></h3>
                <!-- <h3>Surakarta</h3> -->
                <p><?= @$kop['contact_address'] ?>,<?= @$kop['phone'] ?>, Fax: <?= @$kop['fax'] ?>, <?= @$kop['kota'] ?>
                    <br><?= @$kop['sk'] ?>
                </p>

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
                    <td class="p-1" style="width:33.3%">
                        <b>Nomor RM</b>
                        <p id="no_registration" class="m-0 mt-1 p-0">
                            <?= isset($visit['no_registration']) && $visit['no_registration'] ? $visit['no_registration'] : '-' ?>
                        </p>
                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Nama Pasien</b>
                        <p id="name_of_pasien" class="m-0 mt-1 p-0">
                            <?= isset($visit['name_of_pasien']) && $visit['name_of_pasien'] ? $visit['name_of_pasien'] : '-' ?>
                        </p>
                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Jenis Kelamin</b>
                        <p id="gendername" class="m-0 mt-1 p-0 ">
                            <?= isset($visit['gendername']) && $visit['gendername'] ? $visit['gendername'] : '-' ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" style="width:33.3%">
                        <b>Tanggal Lahir (Usia)</b>
                        <p class="m-0 mt-1 p-0 ">
                            <?= DateTime::createFromFormat('Y-m-d H:i:s.u', $visit['tgl_lahir'])->format('d-m-Y') ?>
                        </p>
                    </td>
                    <td class="p-1" style="width:66.3%" colspan="2">
                        <b>Alamat Pasien</b>
                        <p class="m-0 mt-1 p-0">
                            <?= isset($visit['visitor_address']) && $visit['visitor_address'] ? $visit['visitor_address'] : '-' ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>DPJP</b>
                        <p class="m-0 mt-1 p-0">
                            <?= isset(@$visit['fullname']) && @$visit['fullname'] ? @$visit['fullname'] : '-' ?>
                        </p>
                    </td>
                    <td class="p-1">
                        <b>Department</b>
                        <p class="m-0 mt-1 p-0">
                            <?= isset($visit['nama_clinic']) && $visit['nama_clinic'] ? $visit['nama_clinic'] : '-' ?>
                        </p>
                    </td>
                    <td class="p-1">
                        <b>Tanggal Masuk</b>
                        <p class="m-0 mt-1 p-0 ">
                            <?= isset($visit['in_date']) && $visit['in_date'] ? DateTime::createFromFormat('Y-m-d H:i:s.u', $visit['in_date'])->format('d-m-Y H:i') : '-' ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="subyektif" id="showSubyektif">
            <div class="row">
                <h4 class="text-start">Subyektif (S)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <div class="row">
                                <b class="row-12">Keluhan Utama (Autoanamnesis)</b>
                                <span class="row-12">
                                    <?= @$val['anamnesis']; ?></span>
                                <b class="row-12">Keluhan Utama (Alloanamnesis)</b>
                                <span class="row-12"> </span>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <b class="row-12">Riwayat Penyakit Sekarang</b>
                                <span class="row-12">
                                    <?= @$val['riwayat_penyakit_sekarang']; ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <b class="row-12">Riwayat Penyakit Dahulu</b>
                                <span class="row-12">
                                    <?= @$val['riwayat_penyakit_dahulu']; ?></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <b class="row-12">Riwayat Penyakit Keluarga</b>
                                <span class="row-12">
                                    <?= @$val['riwayat_penyakit_keluarga']; ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <b class="row-12">Riwayat Alergi (Non Obat)</b>
                                <span class="row-12">
                                    <?= @$val['riwayat_alergi_nonobat']; ?></span>
                                <b class="row-12">Riwayat Alergi (Obat)</b>
                                <span class="row-12">
                                    <?= @$val['riwayat_alergi_obat']; ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <b class="row-12">Riwayat Obat Yang Dikonsumsi</b>
                                <span class="row-12">
                                    <?= @$val['riwayat_obat_dikonsumsi']; ?></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <b class="row-12">Riwayat Kehamilan dan Persalinan</b>
                                <span class="row-12">
                                    <?= @$val['riwayat_kehamilan']; ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <b class="row-12">Riwayat Diet</b>
                                <span class="row-12">
                                    <?= @$val['riwayat_diet']; ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <b class="row-12">Riwayat Imunisasi</b>
                                <span class="row-12">
                                    <?= @$val['riwayat_imunisasi']; ?></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="row">
                                <b class="row-12">Riwayat Kebiasaan (Negatif)</b>
                                <span class="row-12">
                                    <?= @$val['riwayat_alkohol']; ?></span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <h4 class="text-start">Obyektif (O)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="4"><b>Vital Sign</b></td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <b class="col-12">Tekanan Darah</b>
                            <span class="col-12"><?= @$val['tensi_atas']; ?>
                                mmHg</span>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <b class="col-12">Denyut Nadi</b>
                            <span class="col-12"><?= @$val['nadi']; ?> x/m</span>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <b class="col-12">Suhu Tubuh</b>
                            <span class="col-12"><?= @$val['suhu']; ?> ?</span>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <b class="col-12">Respiration Rate</b>
                            <span class="col-12"><?= @$val['respiration']; ?>
                                x/m</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <b class="col-12">Berat Badan</b>
                            <span class="col-12"><?= @$val['berat']; ?>
                                kg</span>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <b class="col-12">Tinggi Badan</b>
                            <span class="col-12"><?= @$val['tinggi']; ?>
                                cm</span>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <b class="col-12">SpO2</b>
                            <span class="col-12"><?= @$val['spo2']; ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <b class="col-12">BMI</b>
                            <span class="col-12"><?= @$val['imt']; ?></span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b><i>GCS / Tingkat Kesadaran</i></b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-2">
                            <div class="col-auto">
                                <b>GCS E / Respon Membuka Mata :</b>
                            </div>
                            <div class="col">
                                <span><?= @$val['gcs_e']; ?></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-auto">
                                <b>GCS V / Respon Verbal Terbaik :</b>
                            </div>
                            <div class="col">
                                <span><?= @$val['gcs_v']; ?></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-auto">
                                <b>GCS M / Respon Motorik Terbaik :</b>
                            </div>
                            <div class="col">
                                <span><?= @$val['gcs_m']; ?></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-auto">
                                <b>Score GCS : </b>
                            </div>
                            <div class="col">
                                <span><?= @$val['gcs']; ?></span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Keadaan Umum</b>
                        <?php
                        $gcs = @$val['gcs'];

                        if (in_array($gcs, [1, 2, 3])) {
                            $gcsText = 'Coma';
                        } elseif (in_array($gcs, [4, 5, 6])) {
                            $gcsText = 'Sopor';
                        } elseif (in_array($gcs, [7, 8, 9])) {
                            $gcsText = 'Somnolen';
                        } elseif (in_array($gcs, [10, 11])) {
                            $gcsText = 'Delirium';
                        } elseif (in_array($gcs, [12, 13])) {
                            $gcsText = 'Apatis';
                        } elseif (in_array($gcs, [15, 16])) {
                            $gcsText = 'Compos mentis';
                        } else {
                            $gcsText = '';
                        }

                        ?>
                        <span><?= $gcsText; ?></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered" id="skalaShow">
            <tbody>
                <tr>
                    <td>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="4" class="fst-italic fw-bold">Skala Nyeri</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <span class="col-12">
                                                <?= @$val['skala_nyeri']; ?>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="4" class="fst-italic fw-bold">Resiko Jatuh</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <span class="col-12">
                                                <?= @$val['fall_risk_detail']; ?>
                                                <!-- Tipe Resiko Jatuh : fall_morse <br>Riwayat Jatuh : (0)
                                                Tidak<br>Diagnosis Sekunder : (15) Ya<br>Menggunakan Alat_Bantu : (0)
                                                Tidak ada/ Bed rest/ dibantu perawat<br>Menggunakan Infuse Heparine :
                                                (0) Tidak<br>Gaya_berjalan : (0) Normal/ tirah baring
                                                /imobilisasi<br>Status Mental : (0) Sadar akan kemampuan diri
                                                sendiri<br>Medikasi : (0) Tidak ada<br> -->
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Var/NRS</th>
                    <th>Pupil Kiri</th>
                    <th>Pupil kanan</th>
                </tr>
                <tr>
                    <td><?= @$val['vas_nrs'] ?></td>
                    <td>
                        <b>Diameter :</b><?= @$val['left_diameter'] ?>
                        <br><b>Refleks Cahaya :</b><?= @$val['left_light_reflex'] ?>
                        <br><b>Kornea:</b><?= @$val['left_cornea'] ?>
                        <br><b>Isokor Anisokor :</b><?= @$val['left_isokor_anisokor'] ?>
                    </td>
                    <td>
                        <b>Diameter :</b><?= @$val['right_diameter'] ?>
                        <br><b>Refleks Cahaya :</b><?= @$val['right_light_reflex'] ?>
                        <br><b>Kornea:</b><?= @$val['right_cornea'] ?>
                        <br><b>Isokor Anisokor :</b><?= @$val['right_isokor_anisokor'] ?>
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
                        <b>Kaku kuduk :</b><?= @$val['stiff_neck'] ?>
                        <br><b>Meningeal Sign :</b><?= @$val['meningeal_sign'] ?>
                        <br><b>Brudzinki I-IV :</b><?= @$val['brudzinki_i_iv'] ?>
                        <br><b>Kernig Sign:</b><?= @$val['kernig_sign'] ?>
                        <br><b>Dolls eye phenomena :</b><?= @$val['dolls_eye_phenomenon'] ?>
                        <br><b>Vertebra :</b><?= @$val['vertebra'] ?>
                        <br><b>Extremity :</b><?= @$val['extremity'] ?>
                    </td>
                    <td>
                        <b>Gerak Atas Kiri :</b><?= @$val['motion_upper_left'] ?>
                        <br><b>Gerak Atas Kanan :</b><?= @$val['motion_upper_right'] ?>
                        <br><b>Gerak Bawah Kiri :</b><?= @$val['motion_lower_left'] ?>
                        <br><b>Gerak Bawah Kanan :</b><?= @$val['motion_lower_right'] ?>
                    </td>
                    <td>
                        <b>Kekuatan Atas Kiri :</b><?= @$val['strength_upper_left'] ?>
                        <br><b>Kekuatan Atas Kanan :</b><?= @$val['strength_upper_right'] ?>
                        <br><b>Kekuatan Bawah Kiri:</b><?= @$val['strength_lower_left'] ?>
                        <br><b>Kekuatan Bawah Kanan :</b><?= @$val['strength_lower_right'] ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Reflek Fisiologi</th>
                    <th>Reflek Patologi</th>
                    <th>Clonus/Sensibilitas</th>
                </tr>
                <tr>
                    <td>
                        <b>Reflek Fisiologi Atas Kiri :</b><?= @$val['physiological_reflex_upper_left'] ?>
                        <br><b>Reflek Fisiologi Atas Kanan :</b><?= @$val['physiological_reflex_upper_right'] ?>
                        <br><b>Reflek Fisiologi Bawah Kiri :</b><?= @$val['physiological_reflex_lower_left'] ?>
                        <br><b>Reflek Fisiologi Bawah Kanan :</b><?= @$val['physiological_reflex_lower_right'] ?>
                    </td>
                    <td>
                        <b>Reflek Patologi Atas Kiri :</b><?= @$val['pathologycal_reflex_upper_left'] ?>
                        <br><b>Reflek Patologi Atas Kanan :</b><?= @$val['pathologycal_reflex_upper_right'] ?>
                        <br><b>Reflek Patologi Bawah Kiri :</b><?= @$val['pathologycal_reflex_lower_left'] ?>
                        <br><b>Reflek Patologi Bawah Kanan :</b><?= @$val['pathologycal_reflex_lower_right'] ?>
                    </td>
                    <td>
                        <b>Clonus :</b><?= @$val['clonus'] ?>
                        <br><b>Sensibilitas :</b><?= @$val['sensibility'] ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <h4 class="text-start">Assessment (A)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Diagnosis (ICD-10)</b><br>
                        <span> <?= @$val['icd10']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Permasalahan Medis</b><br>
                        <span> <?= @$val['masalah_medis']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Penyebab Cidera / Keracunan</b><br>
                        <span><?= @$val['penyebab_cidera']; ?></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Planning (P)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><b>Target / Sasaran Terapi</b><br>
                        <span><?= @$val['sasaran']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><b>Pemeriksaan Diagnostik Penunjang</b><br>
                    </td>
                </tr>
                <tr>
                    <td><b>Laboratorium</b><br>
                        <span><?= @$val['laboratorium']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><b>Radiologi</b><br>
                        <span><?= @$val['radiologi']; ?></span>
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
                    <td><b>Farmakoterapi</b><br>
                        <span><?= @$val['farmakologia']; ?></span>

                    </td>
                </tr>
                <tr>
                    <td><b>Procedure</b><br>
                        <span><?= @$val['prosedur']; ?></span>

                    </td>
                </tr>
                <tr>
                    <td><b>Catatan Procedure</b><br>
                    </td>
                </tr>
                <tr>
                    <td><b>Standing Order</b><br>
                        <span><?= @$val['standing_order']; ?></span>

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
                    <td><b>Rencana Tindak Lanjut</b><br>
                        <span><?= @$val['rencana_tl']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><b>Kontrol</b><br>
                        <span><?= @$val['kontrol']; ?></span>
                    </td>
                </tr>

            </tbody>
        </table>


        <div class="row">
            <h5 class="text-start">Edukasi Pasien</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapai kepada:</b>
                        <div type="text" class="form-control" id="sa" name="sa"></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-auto" align="center">
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Penerima Penjelasan</div>
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
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: '<?= @$val['dpjp']; ?>',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: '<?= @$val['nama']; ?>',
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