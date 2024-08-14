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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
                                <div id="anamnesis" name="anamnesis" class="h6"><?= $val['anamnesis']; ?></div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <b>Keluhan Utama (Alloanamnesis)</b>
                                <div id="alloanamnesis" name="alloanamnesis" class="h6"><?= $val['alloanamnase']; ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <b>Riwayat Penyakit Sekarang</b>
                        <div id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" class="h6"><?= $val['riwayat_penyakit_sekarang']; ?></div>
                    </td>
                    <td>
                        <b>Riwayat Penyakit Dahulu</b>
                        <div id="riwayat_penyakit_dahulu" name="riwayat_penyakit_dahulu" class="h6"><?= $val['riwayat_penyakit_dahulu']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Riwayat Penyakit Keluarga</b>
                        <div id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" class="h6"><?= $val['riwayat_penyakit_keluarga']; ?></div>
                    </td>
                    <td>
                        <b>Riwayat Alergi (Non Obat)</b>
                        <div id="riwayat_alergi_nonobat" name="riwayat_alergi_nonobat" class="h6"><?= $val['riwayat_alergi_nonobat']; ?></div>
                        <b>Riwayat Alergi (Obat)</b>
                        <div id="riwayat_alergi_obat" name="riwayat_alergi_obat" class="h6"><?= $val['riwayat_alergi_obat']; ?></div>
                    </td>
                    <td>
                        <b>Riwayat Obat Yang Dikonsumsi</b>
                        <div id="riwayat_obat_dikonsumsi" name="riwayat_obat_dikonsumsi" class="h6"><?= $val['riwayat_obat_dikonsumsi']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Riwayat Kehamilan dan Persalinan</b>
                        <div id="riwayat_kehamilan" name="riwayat_kehamilan" class="h6"><?= $val['riwayat_kehamilan']; ?></div>
                    </td>
                    <td>
                        <b>Riwayat Diet</b>
                        <div id="riwayat_diet" name="riwayat_diet" class="h6"><?= $val['riwayat_diet']; ?></div>
                    </td>
                    <td>
                        <b>Riwayat Imunisasi</b>
                        <div id="riwayat_imunisasi" name="riwayat_imunisasi" class="h6"><?= $val['riwayat_imunisasi']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Riwayat Kebiasaan (Negatif)</b>
                        <div id="riwayat_alkohol" name="riwayat_alkohol" class="h6"><?= $val['riwayat_alkohol']; ?>, <?= $val['riwayat_merokok']; ?></div>
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
                            <div id="tensi_atas" name="tensi_atas" class="h6"><?= $val['tensi_atas']; ?> / <?= $val['tensi_bawah']; ?></div>
                            <span class="" id="basic-addon2">mmHg</span>
                        </div>
                    </td>
                    <td>
                        <b>Denyut Nadi</b>
                        <div class="input-group">
                            <div id="nadi" name="nadi" class="h6"><?= $val['nadi']; ?></div>
                            <span class="" id="basic-addon2">x/m</span>
                        </div>
                    </td>
                    <td>
                        <b>Suhu Tubuh</b>
                        <div class="input-group">
                            <div id="suhu" name="suhu" class="h6"><?= $val['suhu']; ?></div>
                            <span class="" id="basic-addon2">℃</span>
                        </div>
                    </td>
                    <td>
                        <b>Respiration Rate</b>
                        <div class="input-group">
                            <div id="respiration" name="respiration" class="h6"><?= $val['respiration']; ?></div>
                            <span class="" id="basic-addon2">x/m</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Berat Badan</b>
                        <div class="input-group">
                            <div id="berat" name="berat" class="h6"><?= $val['berat']; ?></div>
                            <span class="" id="basic-addon2">kg</span>
                        </div>
                    </td>
                    <td>
                        <b>Tinggi Badan</b>
                        <div class="input-group">
                            <div id="tinggi" name="tinggi" class="h6"><?= $val['tinggi']; ?></div>
                            <span class="" id="basic-addon2">cm</span>
                        </div>
                    </td>
                    <td>
                        <b>SpO2</b>
                        <div class="input-group">
                            <div id="spo2" name="spo2" class="h6"><?= $val['spo2']; ?></div>
                        </div>
                    </td>
                    <td>
                        <b>BMI</b>
                        <div class="input-group">
                            <div id="imt" name="imt" class="h6"><?= $val['imt']; ?></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>LK</b>
                        <div class="input-group">
                            <div id="no_registration" name="no_registration" class="h6"></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Pemeriksaan Fisik Tambahan</b>
                        <div class="input-group">
                            <div id="no_registration" name="no_registration" class="h6"><?= $val['pemeriksaan_fisik']; ?></div>
                        </div>
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
                        <div id="icd10" name="icd10" class="h6"><?= $val['icd10']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Permasalahan Medis</b>
                        <div id="masalah_medis" name="masalah_medis" class="h6"><?= $val['masalah_medis']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Penyebab Cidera / Keracunan</b>
                        <div id="penyebab_cidera" name="penyebab_cidera" class="h6"><?= $val['penyebab_cidera']; ?></div>
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
                        <div id="sasaran" name="sasaran" class="h6"><?= $val['sasaran']; ?></div>
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
                        <div type="text" class="h6" id="laboratorium" name="laboratorium"><?= $val['laboratorium']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Radiologi</b>
                        <div type="text" class="h6" id="radiologi" name="radiologi"><?= $val['radiologi']; ?></div>
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
                        <div type="text" class="h6" id="farmakologia" name="farmakologia"><?= $val['farmakologia']; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Procedure</b>
                        <div type="text" class="h6" id="prosedur" name="prosedur"><?= $val['prosedur']; ?>
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
                        <div type="text" class="h6" id="standing_order" name="standing_order"><?= $val['standing_order']; ?>
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
                        <div type="text" class="h6" id="rencana_tl" name="rencana_tl"><?= $val['rencana_tl']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Kontrol</b>
                        <div type="text" class="h6" id="kontrol" name="kontrol"><?= $val['kontrol']; ?></div>
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
                        <div id="" name="" class="h6"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Materi Edukasi:</b>
                        <div id="" name="" class="h6"></div>
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
        <br>
        <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

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
            margin: 0;
            scale: 80;
        }

        .container {
            width: 210mm;
            /* Sesuaikan dengan lebar kertas A4 */
        }
    }
</style>