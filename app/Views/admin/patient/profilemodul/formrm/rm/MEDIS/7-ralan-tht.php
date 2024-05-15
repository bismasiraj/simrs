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

</head>

<body>
    <div class="container mt-5">
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
                <div class="col-md-2" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h2>RS PKU Muhammadiyah Sampangan</h2>
                    <h2>Surakarta</h2>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK No.449/0238/P-02/IORS/II/2018</p>
                </div>
                <div class="col-md-2" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h3 class="text-center"><?= $title; ?></h3>
            </div>
            <div class="row">
                <h4 class="text-start">Informasi Pasien</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <input type="text" class="form-control" id="no_rm" name="no_rm" value="<?= $val['no_rm']; ?>">
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $val['nama']; ?>">
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <input type="text" class="form-control" id="jeniskel" name="jeniskel" value="<?= $val['jeniskel']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <input type="text" class="form-control" id="umur" name="umur" value="<?= $val['date_of_birth']; ?> (<?= $val['umur']; ?>)">
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $val['alamat']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <input type="text" class="form-control" id="dpjp" name="dpjp" value="<?= $val['dpjp']; ?>">
                        </td>
                        <td>
                            <b>Department</b>
                            <input type="text" class="form-control" id="departemen" name="departemen" value="<?= $val['departemen']; ?>">
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <input type="text" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= $val['tanggal_masuk']; ?>">
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
                            <input type="text" class="form-control" id="" name="" value="">
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
                    <tr>
                        <td colspan="2">
                            <b>Telinga</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img class="mt-3" src="<?= base_url('assets/img/asesmen/tht/struktur_telinga.jpg') ?>" width="400px">
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Keterangan :</b>
                            <textarea type="text" class="form-control" id="" name=""></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Hidung</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            <img class="mt-3" src="<?= base_url('assets/img/asesmen/tht/struktur_hidung.jpg') ?>" width="400px">
                        </td>
                        <td>
                            <b>Keterangan :</b>
                            <textarea type="text" class="form-control" id="" name=""></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Tenggorokan</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            <img class="mt-3" src="<?= base_url('assets/img/asesmen/tht/struktur_tenggorokan.jpg') ?>" width="400px">
                        </td>
                        <td>
                            <b>Keterangan :</b>
                            <textarea type="text" class="form-control" id="" name=""></textarea>
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
                            <div type="text" class="form-control" id="sa" name="sa"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kontrol</b>
                            <div type="text" class="form-control" id="sa" name="sa"></div>
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
                    <div class="mb-4">
                        <div id="qrcode"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Penerima Penjelasan</div>
                    <div class="mb-4">
                        <div id="qrcode1"></div>
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
        text: '<?= $val['dpjp']; ?>',
        width: 250,
        height: 250,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: 'a',
        width: 250,
        height: 250,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>