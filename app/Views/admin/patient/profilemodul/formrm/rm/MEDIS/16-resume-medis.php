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
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h2>RS PKU Muhammadiyah Sampangan</h2>
                    <h2>Surakarta</h2>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK No.449/0238/P-02/IORS/II/2018</p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h3 class="text-center">Resume Medis</h3>
            </div>
            <div class="row">
                <h4 class="text-start">Informasi Pasien</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <input type="text" class="form-control" id="no_registration" name="no_registration">
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <input type="text" class="form-control" id="thename" name="thename">
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <select name="gender" id="gender" class="form-control">
                                <option value="1">Laki-Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <input type="text" class="form-control" id="patient_age" name="patient_age">
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <input type="text" class="form-control" id="theaddress" name="theaddress">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <input type="text" class="form-control" id="doctor" name="doctor">
                        </td>
                        <td>
                            <b>Department</b>
                            <input type="text" class="form-control" id="clinic_id" name="clinic_id">
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kelas</b>
                            <input type="text" class="form-control" id="" name="" value="">
                        </td>
                        <td>
                            <b>Bangsal/Kamar</b>
                            <input type="text" class="form-control" id="" name="" value="">
                        </td>
                        <td>
                            <b>Bed</b>
                            <input type="text" class="form-control" id="" name="" value="">
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
                            <input type="text" class="form-control" id="anamnesis" name="anamnesis" value="<?= $val['anamnesis']; ?>">
                            <b>Keluhan Utama (Alloanamnesis)</b>
                            <input type="text" class="form-control" id="alloanamnesis" name="alloanamnesis" value="<?= $val['alloanamnesis']; ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Riwayat Penyakit Sekarang</b>
                            <input type="text" class="form-control" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" value="<?= $val['riwayat_penyakit_sekarang']; ?>">
                            <b>Riwayat Penyakit Dahulu</b>
                            <input type="text" class="form-control" id="riwayat_penyakit_dahulu" name="riwayat_penyakit_dahulu" value="<?= $val['riwayat_penyakit_dahulu']; ?>">
                        </td>
                        <td>
                            <b>Riwayat Penyakit Keluarga</b>
                            <input type="text" class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" value="<?= $val['riwayat_penyakit_keluarga']; ?>">
                            <b>Riwayat Obat Yang Dikonsumsi</b>
                            <input type="text" class="form-control" id="riwayat_obat_dikonsumsi" name="riwayat_obat_dikonsumsi" value="<?= $val['riwayat_obat_dikonsumsi']; ?>">
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
                            <b>SpO2</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="spo2" name="spo2" value="<?= $val['spo2']; ?>">
                            </div>
                        </td>
                        <td>
                            <b>Berat Badan</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="berat" name="berat" value="<?= $val['berat']; ?>">
                                <span class="input-group-text" id="basic-addon2">kg</span>
                            </div>
                        </td>
                        <td colspan="2">
                            <b><i>GCS / Tingkat Kesadaran</i></b>
                            <input type="text" class="form-control" id="gcs" name="gcs" value="<?= $val['gcs']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Kepala</b>
                            <input type="text" class="form-control" id="pf_kepala" name="pf_kepala" value="<?= $val['pf_kepala']; ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Mata</b>
                            <input type="text" class="form-control" id="pf_mata" name="pf_mata" value="<?= $val['pf_mata']; ?>">
                        </td>
                        <td>
                            <b>Hidung</b>
                            <input type="text" class="form-control" id="pf_hidung" name="pf_hidung" value="<?= $val['pf_hidung']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Telinga</b>
                            <input type="text" class="form-control" id="pf_telinga" name="pf_telinga" value="<?= $val['pf_telinga']; ?>">
                        </td>
                        <td>
                            <b>Mulut</b>
                            <input type="text" class="form-control" id="pf_mulut" name="pf_mulut" value="<?= $val['pf_mulut']; ?>">
                        </td>
                        <td>
                            <b>Gigi</b>
                            <input type="text" class="form-control" id="pf_gigi" name="pf_gigi" value="<?= $val['pf_gigi']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Leher</b>
                            <input type="text" class="form-control" id="pf_leher" name="pf_leher" value="<?= $val['pf_leher']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Thorax</b>
                            <input type="text" class="form-control" id="pf_thorax" name="pf_thorax" value="<?= $val['pf_thorax']; ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Jantung</b>
                            <input type="text" class="form-control" id="pf_jantung" name="pf_jantung" value="<?= $val['pf_jantung']; ?>">
                        </td>
                        <td>
                            <b>Paru-paru</b>
                            <input type="text" class="form-control" id="pf_paru" name="pf_paru" value="<?= $val['pf_paru']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Abdomen</b>
                            <input type="text" class="form-control" id="pf_perut" name="pf_perut" value="<?= $val['pf_perut']; ?>">
                        </td>
                        <td>
                            <b>Hepar</b>
                            <input type="text" class="form-control" id="pf_hepar" name="pf_hepar" value="<?= $val['pf_hepar']; ?>">
                        </td>
                        <td>
                            <b>Lien</b>
                            <input type="text" class="form-control" id="pf_lien" name="pf_lien" value="<?= $val['pf_lien']; ?>">
                        </td>
                        <td>
                            <b>Ginjal</b>
                            <input type="text" class="form-control" id="pf_ginjal" name="pf_ginjal" value="<?= $val['pf_ginjal']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Genitalia</b>
                            <input type="text" class="form-control" id="pf_genitais" name="pf_genitais" value="<?= $val['pf_genitais']; ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Ekstremitas Atas</b>
                            <input type="text" class="form-control" id="pf_ekstermitas_atas" name="pf_ekstermitas_atas" value="<?= $val['pf_ekstermitas_atas']; ?>">
                        </td>
                        <td>
                            <b>Ekstremitas Bawah</b>
                            <input type="text" class="form-control" id="pf_extermintas_bawah" name="pf_extermintas_bawah" value="<?= $val['pf_extermintas_bawah']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <b>Diagnosis Masuk</b>
                            <input type="text" class="form-control" id="" name="" value="<?= $val['pdiagnosa']; ?>">
                        </td>
                        <td>
                            <b>Procedure Masuk</b>
                            <input type="text" class="form-control" id="" name="" value="<?= $val['pprocedures']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Indikasi Rawat Inap</b>
                            <input type="text" class="form-control" id="" name="" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Diagnosis Pulang</b>
                            <textarea type="text" class="form-control" id="" name=""><?= $val['pdiagnosa']; ?></textarea>
                        </td>
                        <td>
                            <b>Procedure Pulang</b>
                            <textarea type="text" class="form-control" id="" name=""><?= $val['pprocedures']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Status/Cara Pulang</b>
                            <input type="text" class="form-control" id="" name="" value="">
                        </td>
                        <td>
                            <b>Kondisi Pulang</b>
                            <input type="text" class="form-control" id="" name="" value="">
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
                        <td>
                            <b>Laboratorium</b>
                            <textarea type="text" class="form-control" id="laboratorium" name="laboratorium"><?= $val['laboratorium']; ?></textarea>
                        </td>
                        <td>
                            <b>Radiologi</b>
                            <textarea type="text" class="form-control" id="radiologi" name="radiologi"><?= $val['radiologi']; ?></textarea>
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
                            <input type="text" class="form-control" id="" name="" value="<?= $val['farmakologia']; ?>">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="" name="">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="" name="">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="" name="">
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
                            <input type="text" class="form-control" id="" name="">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="" name="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mb-3">
                <div class="col">
                    <b>Terapi Tindakan (Procedure)</b>
                    <input type="text" class="form-control" id="" name="">
                </div>
            </div>
            <div class="row">
                <div class="col-auto" align="center">
                    <div>Tanda Tangan Dokter</div>
                    <div class="mb-1">
                        <div id="qrcode"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Tanda Tangan Pasien/Keluarga</div>
                    <div class="mb-1">
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
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: '<?= $val['nama']; ?>',
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