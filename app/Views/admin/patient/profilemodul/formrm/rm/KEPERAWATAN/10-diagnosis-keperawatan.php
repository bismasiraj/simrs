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
                    <h3>RS PKU Muhammadiyah Sampangan</h3>
                    <h3>Surakarta</h3>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK No.449/0238/P-02/IORS/II/2018</p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h3 class="text-center">Diagnosis Keperawatan - Bersihan Jalan Nafas Tidak Efektif</h3>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
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
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead class="fw-bold fs-4 text-center">
                    <tr>
                        <td>Standar Diagnosa Keperawatan Indonesia (SDKI)</td>
                        <td>Standar Luaran Keperawatan Indonesia (SLKI)</td>
                        <td>Standar intervensi Keperawatan Indonesia (SIKI)</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 33.3%;">
                            <div class="row mb-2">
                                <div class="col"><b>Definisi:</b><br>
                                    <p>Ketidakmampuan membersihkan secret atau obstruksi jalan nafas untuk
                                        mempertahankan nafas tetap aman</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <b>b.d:</b>
                                    <div class="container px-3">
                                        <ul>
                                            <li>Spasme jalan nafas</li>
                                            <li>Hipersekresi jalan nafas</li>
                                            <li>Disfugsi neuromuskuler</li>
                                            <li>Benda asing dalam jalan nafas</li>
                                            <li>Adanya jalan nafas buatan</li>
                                            <li>Hyperplasia dinding jalan nafas</li>
                                            <li>Proses infeksi</li>
                                            <li>Respon alergi</li>
                                            <li>Efek agen farmakologis</li>
                                            <li>Merokok aktif</li>
                                            <li>Merokok pasif</li>
                                            <li>Terpajan polutan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <b>d.d gejala dan tanda:</b><br>
                                    <div class="container px-2">
                                        <b>Mayor</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Batuk tidak efektif</li>
                                                <li>Tidak mampu batuk</li>
                                                <li>Sputum berlebih</li>
                                                <li>Mengi, <i>wheezing</i> dan atau ronkhi kering</li>
                                                <li>Meconium jalan nafas</li>
                                            </ul>
                                        </div>
                                        <b>Minor</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li><i>Dyspnea</i></li>
                                                <li>Sulit bicara</li>
                                                <li>Ortopnea</li>
                                                <li>Gelisah</li>
                                                <li>Sianosis</li>
                                                <li>Bunyi nafas menurun</li>
                                                <li>Frekuensi nafas berubah</li>
                                                <li>Pola nafas berubah</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="width: 33.3%;">
                            <div class="row mb-2">
                                <div class="col">
                                    <p>Setelah dilakukan intervensi keperawatan selama .... jam,
                                        diharapkan <b>bersihan jalan nafas (L.01001) meningkat</b>
                                        sesuai dengan kriteria hasil:</p>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <b>Bersihan Jalan Nafas (L.01001)</b>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row mb-2">
                                <div class="col">
                                    <b>Latihan Batuk Efektif (I.01006)</b><br>
                                    <div class="container px-2">
                                        <b>Observasi</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Identifikasi kemampuan batuk</li>
                                                <li>Monitor adanya retensi sputum</li>
                                                <li>Monitor tanda dan gejala infeksi saluran nafas</li>
                                                <li>Monitor input dan output cairan</li>
                                            </ul>
                                        </div>
                                        <b>Terapeutik</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Atur posisi semi fowler atau fowler</li>
                                                <li>Pasang perlak dan bengkok di pangkuan pasien</li>
                                                <li>Buang sekret pada tempat sputum</li>
                                            </ul>
                                        </div>
                                        <b>Edukasi</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Jelaskan tujuan dan prosedur batuk efektif</li>
                                                <li>Anjurkan tarik nafas dalam melalui hidung selama 4
                                                    detik, ditahan 2 detik, kemudian keluarkan dari mulut
                                                    dengan bibir mencucu (dibulatkan) selama 8 detik</li>
                                                <li>Anjurkan mengulangi tarik nafas dalam hingga 3 kali</li>
                                                <li>Anjurkan batuk dengan kuat langsung setelah tarik nafas
                                                    dalam yang ke-3</li>
                                                <li>Kolaborasi</li>
                                                <li>Kolaborasi pemberian mukolitik atau ekspektoran</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <b>Manajemen Jalan Nafas (I.01011)</b>
                                    <div class="container px-2">
                                        <b>Observasi</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Monitor pola nafas (frekuensi, kedalaman, usaha
                                                    nafas)</li>
                                                <li>Monitor bunyi nafas tambahan</li>
                                                <li>Monitor sputum (jumlah, warna, aroma)</li>
                                            </ul>
                                        </div>
                                        <b>Terapeutik</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Pertahankan kepatenan jalan nafas dengan
                                                    <i>head-tilt</i> dan <i>chin-lift,</i>
                                                    (<i>jaw thrust</i> jika curiga trauma servikal)
                                                </li>
                                                <li>Posisi semi-fowler atau fowler</li>
                                                <li>Berikan minum hangat</li>
                                                <li>Lakukan fisioterapi dada</li>
                                                <li>Lakukan penghisapan lendir kurang dari 15 detik</li>
                                                <li>Lakukan hiperoksigenasi sebelum penghisapan
                                                    endotrakeal</li>
                                                <li>Keluarkan sumbatan benda padat dengan forsep
                                                    McGill</li>
                                                <li>Berikan oksigen</li>
                                            </ul>
                                        </div>
                                        <b>Edukasi</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Anjurkan asupan cairan 2000 ml/hari, jika tidak ada
                                                    kontraindikasi</li>
                                                <li>Ajarkan teknik batuk efektif</li>
                                            </ul>
                                        </div>
                                        <b>Kolaborasi</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Kolaborasi pemberian bronkodilator, ekspektoran,
                                                    mukolitik</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <b>Pemantauan Respirasi (I.01014)</b>
                                    <div class="container px-2">
                                        <b>Observasi</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Monitor frekuensi, irama, kedalaman, dan upaya
                                                    nafas</li>
                                                <li>Monitor pola nafas</li>
                                                <li>Monitor kemampuan batuk efektif</li>
                                                <li>Monitor adanya produksi sputum</li>
                                                <li>Monitor adanya sumbatan jalan nafas</li>
                                                <li>Palpasi kesimetrisan ekspansi paru</li>
                                                <li>Auskultasi bunyi nafas</li>
                                                <li>Monitor saturasi oksigen</li>
                                                <li>Monitor nilai AGD</li>
                                                <li>Monitor hasil X-Ray thorax</li>
                                            </ul>
                                        </div>
                                        <b>Terapeutik</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Atur interval pemantauan respirasi sesuai kondisi
                                                    pasien</li>
                                                <li>Dokumentasi hasil pemantauan</li>
                                            </ul>
                                        </div>
                                        <b>Edukasi</b>
                                        <div class="container px-3">
                                            <ul>
                                                <li>Jelaskan tujuan dan prosedur pemantauan</li>
                                                <li>Informasikan hasil pemantauan</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mb-3">
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Penanggung Jawab Dokumen</div>
                    <div class="mb-4">
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 class="text-start">Evaluasi Asuhan Keperawatan</h4>
            </div>
            <table class="table table-bordered">
                <thead class="fw-bold">
                    <tr>
                        <td>SDKI</td>
                        <td colspan="2">SLKI</td>
                        <td>TL</td>
                        <td>SL</td>
                        <td>Evaluasi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5"><b>D.0001-Bersihan Jalan Nafas Tidak Efektif</b></td>
                        <td rowspan="13"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Positif</td>
                        <td>Batuk efektif</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Positif</td>
                        <td>Frekuensi nafas</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Positif</td>
                        <td>Pola nafas</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Produksi sputum</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Mengi</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Wheezing</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Meconium</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Dyspnea</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Ortopnea</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Sulit bicara</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Sianosis</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Gelisah</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Penanggung Jawab Dokumen</div>
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
        text: 'a',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: 'a',
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