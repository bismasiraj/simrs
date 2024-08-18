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
        <!-- template header -->
        <?= view("admin/patient/profilemodul/formrm/rm/template_header_only.php"); ?>
        <!-- end of template header -->

        <div class="row">
            <h5 class="text-start">Informasi Pasien</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" style="width:33.3%">
                        <b>Nomor RM</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Nama Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_pasien']; ?></p>
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
                    <td class="p-1" style="width:33.3%">
                        <b>DPJP</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['fullname']; ?></p>
                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Department</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic_from']; ?></p>
                    </td class="p-1">
                    <td class="p-1" style="width:33.3%">
                        <b>Tanggal Masuk</b>
                        <p class="m-0 mt-1 p-0"><?= tanggal_indo(date_format(date_create($visit['in_date']), 'Y-m-d')) ?></p>
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
                    <td>
                        <div class="row mb-1">
                            <div class="col">
                                <b>Keluhan Utama (Autoanamnesis)</b>
                                <input type="text" class="form-control" id="anamnesis" name="anamnesis" value="<?= $val['anamnesis']; ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <b>Riwayat Penyakit Sekarang</b>
                        <input type="text" class="form-control" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" value="<?= $val['riwayat_penyakit_sekarang']; ?>">
                    </td>
                    <td>
                        <b>Riwayat Penyakit Dahulu</b>
                        <input type="text" class="form-control" id="riwayat_penyakit_dahulu" name="riwayat_penyakit_dahulu" value="<?= $val['riwayat_penyakit_dahulu']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Riwayat Penyakit Keluarga</b>
                        <input type="text" class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" value="<?= $val['riwayat_penyakit_keluarga']; ?>">
                    </td>
                    <td>
                        <b>Riwayat Alergi (Non Obat)</b>
                        <input type="text" class="form-control" id="riwayat_alergi_nonobat" name="riwayat_alergi_nonobat" value="<?= $val['riwayat_alergi_nonobat']; ?>">
                        <b>Riwayat Alergi (Obat)</b>
                        <input type="text" class="form-control" id="riwayat_alergi_obat" name="riwayat_alergi_obat" value="<?= $val['riwayat_alergi_obat']; ?>">
                    </td>
                    <td>
                        <b>Riwayat Obat Yang Dikonsumsi</b>
                        <input type="text" class="form-control" id="riwayat_obat_dikonsumsi" name="riwayat_obat_dikonsumsi" value="<?= $val['riwayat_obat_dikonsumsi']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Riwayat Kehamilan dan Persalinan</b>
                        <input type="text" class="form-control" id="riwayat_kehamilan" name="riwayat_kehamilan" value="<?= $val['riwayat_kehamilan']; ?>">
                    </td>
                    <td>
                        <b>Riwayat Diet</b>
                        <input type="text" class="form-control" id="riwayat_diet" name="riwayat_diet" value="<?= $val['riwayat_diet']; ?>">
                    </td>
                    <td>
                        <b>Riwayat Imunisasi</b>
                        <input type="text" class="form-control" id="riwayat_imunisasi" name="riwayat_imunisasi" value="<?= $val['riwayat_imunisasi']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Riwayat Kebiasaan (Negatif)</b>
                        <input type="text" class="form-control" id="riwayat_alkohol" name="riwayat_alkohol" value="<?= $val['riwayat_alkohol']; ?>, <?= $val['riwayat_merokok']; ?>">
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
                    <td>
                        <b>Tekanan Darah</b>
                        <div class="input-group">
                            <input type="text" class="form-control" id="tensi_atas" name="tensi_atas" value="<?= $val['tensi_atas']; ?> / <?= $val['tensi_bawah']; ?>">
                            <span class="input-group-text" id="basic-addon2">mmHg</span>
                        </div>
                    </td>
                    <td>
                        <b>Denyut Nadi</b>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nadi" name="nadi" value="<?= $val['nadi']; ?>">
                            <span class="input-group-text" id="basic-addon2">x/m</span>
                        </div>
                    </td>
                    <td>
                        <b>Suhu Tubuh</b>
                        <div class="input-group">
                            <input type="text" class="form-control" id="suhu" name="suhu" value="<?= $val['suhu']; ?>">
                            <span class="input-group-text" id="basic-addon2">℃</span>
                        </div>
                    </td>
                    <td>
                        <b>Respiration Rate</b>
                        <div class="input-group">
                            <input type="text" class="form-control" id="respiration" name="respiration" value="<?= $val['respiration']; ?>">
                            <span class="input-group-text" id="basic-addon2">x/m</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Berat Badan</b>
                        <div class="input-group">
                            <input type="text" class="form-control" id="berat" name="berat" value="<?= $val['berat']; ?>">
                            <span class="input-group-text" id="basic-addon2">kg</span>
                        </div>
                    </td>
                    <td>
                        <b>Tinggi Badan</b>
                        <div class="input-group">
                            <input type="text" class="form-control" id="tinggi" name="tinggi" value="<?= $val['tinggi']; ?>">
                            <span class="input-group-text" id="basic-addon2">cm</span>
                        </div>
                    </td>
                    <td>
                        <b>SpO2</b>
                        <div class="input-group">
                            <input type="text" class="form-control" id="spo2" name="spo2" value="<?= $val['spo2']; ?>">
                        </div>
                    </td>
                    <td>
                        <b>BMI</b>
                        <div class="input-group">
                            <input type="text" class="form-control" id="imt" name="imt" value="<?= $val['imt']; ?>">
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
                                <input type="text" class="form-control" id="gcs_e" name="gcs_e" value="<?= $val['gcs_e']; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-auto">
                                <b>GCS V / Respon Verbal Terbaik :</b>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="gcs_v" name="gcs_v" value="<?= $val['gcs_v']; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-auto">
                                <b>GCS M / Respon Motorik Terbaik :</b>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="gcs_m" name="gcs_m" value="<?= $val['gcs_m']; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-auto">
                                <b>Score GCS : </b>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="gcs" name="gcs" value="<?= $val['gcs']; ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Keadaan Umum</b>
                        <input type="text" class="form-control" name="" value="">
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Skala Nyeri</b>
                        <input type="text" class="form-control" id="pain_score" name="pain_score" value="<?= $val['pain_score']; ?>">
                    </td>
                    <td>
                        <b>Resiko Jatuh</b>
                        <input type="text" class="form-control" id="fall_score" name="fall_score" value="<?= $val['fall_score']; ?>">
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr class="fw-bold">
                    <td>Gambar Laki-laki</td>
                    <td>Gambar Perempuan</td>
                </tr>
                <tr>
                    <td style="width: 50%;">
                        <img class="mt-3" src="<?= base_url('assets/img/asesmen/bedah/male.jpg') ?>" width="400px">
                    </td>
                    <td>
                        <img class="mt-3" src="<?= base_url('assets/img/asesmen/bedah/female.jpg') ?>" width="400px">
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
                        <b>Diagnosis (ICD-10)</b>
                        <input type="text" class="form-control" id="icd10" name="icd10" value="<?= $val['icd10']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Permasalahan Medis</b>
                        <input type="text" class="form-control" id="masalah_medis" name="masalah_medis" value="<?= $val['masalah_medis']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Penyebab Cidera / Keracunan</b>
                        <input type="text" class="form-control" id="penyebab_cidera" name="penyebab_cidera" value="<?= $val['penyebab_cidera']; ?>">
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
                    <td>
                        <b>Target / Sasaran Terapi</b>
                        <input type="text" class="form-control" id="sasaran" name="sasaran" value="<?= $val['sasaran']; ?>">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Pemeriksaan Diagnostik Penunjang</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Laboratorium</b>
                        <div type="text" class="form-control" id="laboratorium" name="laboratorium"><?= $val['laboratorium']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Radiologi</b>
                        <div type="text" class="form-control" id="radiologi" name="radiologi"><?= $val['radiologi']; ?></div>
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
                    <td>
                        <b>Farmakoterapi</b>
                        <div type="text" class="form-control" id="farmakologia" name="farmakologia"><?= $val['farmakologia']; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Procedure</b>
                        <div type="text" class="form-control" id="prosedur" name="prosedur"><?= $val['prosedur']; ?>
                        </div>
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
                    <td>
                        <b>Standing Order</b>
                        <div type="text" class="form-control" id="standing_order" name="standing_order"><?= $val['standing_order']; ?>
                        </div>
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
                    <td>
                        <b>Rencana Tindak Lanjut</b>
                        <div type="text" class="form-control" id="rencana_tl" name="rencana_tl"><?= $val['rencana_tl']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Kontrol</b>
                        <div type="text" class="form-control" id="kontrol" name="kontrol"><?= $val['kontrol']; ?></div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: `<?= $visit['fullname']; ?>`,
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: `<?= $visit['diantar_oleh']; ?>`,
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
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