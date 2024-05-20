<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>PENILAIAN KEBUTUHAN EDUKASI TRIASE DEWASA</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script type="text/javascript">
        // JavaScript Document
        var v = 9;
        var t = 10;

        function addRow(tableID) {

            i1 = t + 1;
            i2 = t + 2;
            i3 = t + 3;
            i4 = t + 4;
            i5 = t + 5;
            i6 = t + 6;
            i7 = t + 7;
            i8 = t + 8;
            v1 = v + 1;
            v2 = v + 2;

            $("#" + tableID).append($("<tr>")
                .append($("<td>").html('<div class="form-group"> \
                            <input type="text" class="form-control" id="v_' + v1 + '"name="v_' + v1 + '" \
                        </div>'))

                .append($("<td>").html('<select class="form-select" name="t_0' + i1 + '" >\
                            <option selected>Pilih</option> \
                            <option value="1">1. Tindakan Pencegahan</option> \
                            <option value="2">2. Intervensi Diet</option> \
                            <option value="3">3. Peralatan Khusus</option> \
                            <option value="4">4. Pencegahan Resiko Jatuh</option> \
                            <option value="5">5. Managemen Nyeri</option> \
                            <option value="6">6. Penyakit Khusus</option> \
                            <option value="7">7. Pengobatan</option> \
                            <option value="8">8. Warfain</option> \
                            <option value="9">9. Edukasi Diabetes</option> \
                            <option value="10">10. Tranfusi Darah</option> \
                            <option value="11">11. Vaksinasi</option> \
                            <option value="12">12. Lain-Lain</option> \
                        </select>'))

                .append($("<td>").html('<select class="form-select" name="t_0' + i2 + '" >\
                        <option selected>Pilih</option> \
                        <option value="1">1. Mulai menggunakan informasi yang didapat</option> \
                        <option value="2">2. Dapat mengungkapkan secara lisan informasi yang didapat</option> \
                    </select>'))



                .append($("<td>").html('<select class="form-select" name="t_0' + i3 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Dapat mengubah perilaku</option> \
                                <option value="2">2. Dapat menguasai informasi</option> \
                                <option value="3">3. Tidak jelas pada saat ini</option> \
                            </select>'))

                .append($("<td>").html('<select class="form-select" name="t_0' + i4 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Siap</option> \
                                <option value="2">2. Tertarik</option> \
                                <option value="3">3. Tidak tertarik / Tidak mampu</option> \
                            </select>'))


                .append($("<td>").html('<select class="form-select" name="t_0' + i5 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Tidak ada</option> \
                                <option value="2">2. Takut</option> \
                                <option value="3">3. Tidak tertarik</option> \
                                <option value="4">4. Nyeri / Tidak nyaman</option> \
                                <option value="5">5. Gangguan Kognitif</option> \
                                <option value="6">6. hambatan bahasa</option> \
                            </select>'))


                .append($("<td>").html('<select class="form-select" name="t_0' + i6 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Tidak ada</option> \
                                <option value="2">2. Membatasi materi</option> \
                                <option value="3">3. Menggunakan penerjemah</option> \
                                <option value="4">4. Mengulangi edukasi</option> \
                                <option value="5">5. Mengedukasi keluarga</option> \
                            </select>'))

                .append($("<td>").html('<select class="form-select" name="t_0' + i7 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Demonstrasi</option> \
                                <option value="2">2. Diskusi</option> \
                                <option value="3">3. Leaflet/Handout</option> \
                            </select>'))

                .append($("<td>").html('<select class="form-select" name="t_0' + i8 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Menunjukkan tingkat pengetahuan yang diharapkan</option> \
                                <option value="2">2. Membutuhkan Petunjuk Tambahan</option> \
                            </select>'))

                .append($("<td>").html('<div class="form-group"><input type="text" class="form-control" required="required" name="v_' + v2 + '" size="20px"></div>'))
            )

            t += 8;
            v += 2;


        }
    </script>

    <script type="text/javascript">
        // JavaScript Document
        var v1 = 101;
        var t1 = 107;

        function addRow1(tableID) {

            j1 = t1 + 1;
            j2 = t1 + 2;
            j3 = t1 + 3;
            j4 = t1 + 4;
            j5 = t1 + 5;
            j6 = t1 + 6;
            j7 = t1 + 7;
            j8 = t1 + 8;
            x1 = v1 + 1;
            x2 = v1 + 2;

            $("#" + tableID).append($("<tr>")
                .append($("<td>").html('<div class="form-group"> \
                            <input type="text" class="form-control" id="v_' + x1 + '" name="v_' + x1 + '" \
                        </div>'))

                .append($("<td>").html('<select class="form-select" name="t_' + j1 + '" >\
                            <option selected>Pilih</option> \
                            <option value="1">1. Tindakan Pencegahan</option> \
                            <option value="2">2. Intervensi Diet</option> \
                            <option value="3">3. Peralatan Khusus</option> \
                            <option value="4">4. Pencegahan Resiko Jatuh</option> \
                            <option value="5">5. Managemen Nyeri</option> \
                            <option value="6">6. Penyakit Khusus</option> \
                            <option value="7">7. Pengobatan</option> \
                            <option value="8">8. Warfain</option> \
                            <option value="9">9. Edukasi Diabetes</option> \
                            <option value="10">10. Tranfusi Darah</option> \
                            <option value="11">11. Vaksinasi</option> \
                            <option value="12">12. Lain-Lain</option> \
                        </select>'))

                .append($("<td>").html('<select class="form-select" name="t_' + j2 + '" >\
                        <option selected>Pilih</option> \
                        <option value="1">1. Mulai menggunakan informasi yang didapat</option> \
                        <option value="2">2. Dapat mengungkapkan secara lisan informasi yang didapat</option> \
                    </select>'))



                .append($("<td>").html('<select class="form-select" name="t_' + j3 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Dapat mengubah perilaku</option> \
                                <option value="2">2. Dapat menguasai informasi</option> \
                                <option value="3">3. Tidak jelas pada saat ini</option> \
                            </select>'))

                .append($("<td>").html('<select class="form-select" name="t_' + j4 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Siap</option> \
                                <option value="2">2. Tertarik</option> \
                                <option value="3">3. Tidak tertarik / Tidak mampu</option> \
                            </select>'))


                .append($("<td>").html('<select class="form-select" name="t_' + j5 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Tidak ada</option> \
                                <option value="2">2. Takut</option> \
                                <option value="3">3. Tidak tertarik</option> \
                                <option value="4">4. Nyeri / Tidak nyaman</option> \
                                <option value="5">5. Gangguan Kognitif</option> \
                                <option value="6">6. hambatan bahasa</option> \
                            </select>'))


                .append($("<td>").html('<select class="form-select" name="t_' + j6 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Tidak ada</option> \
                                <option value="2">2. Membatasi materi</option> \
                                <option value="3">3. Menggunakan penerjemah</option> \
                                <option value="4">4. Mengulangi edukasi</option> \
                                <option value="5">5. Mengedukasi keluarga</option> \
                            </select>'))

                .append($("<td>").html('<select class="form-select" name="t_' + j7 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Demonstrasi</option> \
                                <option value="2">2. Diskusi</option> \
                                <option value="3">3. Leaflet/Handout</option> \
                            </select>'))

                .append($("<td>").html('<select class="form-select" name="t_' + j8 + '" >\
                                <option selected>Pilih</option> \
                                <option value="1">1. Menunjukkan tingkat pengetahuan yang diharapkan</option> \
                                <option value="2">2. Membutuhkan Petunjuk Tambahan</option> \
                            </select>'))

                .append($("<td>").html('<div class="form-group"><input type="text" class="form-control" required="required" id="v_' + x2 + '" name="v_' + x2 + '" size="20px"></div>'))
            )

            t1 += 8;
            v1 += 2;


        }
    </script>

</head>

<body>

    <div class="container-fluid mt-5">
        <form action="<?= site_url('#') ?>" method="post" autocomplete="off">
            <?php csrf_field(); ?>
            <table class="table table-bordered mb-0" style="border: 2px solid black">
                <tr>
                    <td width="20%" align="center">
                        <img class="mt-3" src="<?= base_url('assets/img/logo.png') ?>" width="80px">

                        <p class="mt-3">Sehat-Amanah <br> Tanggung Jawab-Islami</p>
                    </td>
                    <td width="45%" style="padding-top: 40px;">
                        <h5>RS. PKU MUHAMMADIYAH SURAKARTA </h5>
                        <strong>
                            <p>Jl. Ronggowarsito No.10 Surakarta <br> Telpon (0271) 714578 Jawa Tengah 57131</p>
                        </strong>
                    </td>
                    <td width="35%">

                        <div class="container mt-2" style="border:1px solid black; padding:5px">
                            <div class="row">
                                <div class="col-4">
                                    <label>Nama</label>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="thename" id="thename" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label>Umur</label>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="ageday" id="ageday" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label>Alamat</label>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="theaddress" id="theaddress" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label>No. RM</label>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="no_registration" id="no_registration" readonly>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 2px solid black">
                    <td colspan="3">
                        <h6 class="text-center">PENILAIAN KEBUTUHAN EDUKASI</h6>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="text-center" style="vertical-align: middle" width="25%">
                        <p>Kemampuan berbahasa</p>
                    </td>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-1">
                                <p>1.</p>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="v_01" name="v_01">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_01" id="t_01_baik" value="1">
                                    <label for="t_01_baik">Baik</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_01" id="t_01_cukup" value="0">
                                    <label for="t_01_cukup">Cukup</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_01" id="t_01_kurang" value="0">
                                    <label for="t_01_kurang">Kurang</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-1">
                                <p>2.</p>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="v_02" name="v_02">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_02" id="t_02_baik" value="1">
                                    <label for="t_02_baik">Baik</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_02" id="t_02_cukup" value="0">
                                    <label for="t_02_cukup">Cukup</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_02" id="t_02_kurang" value="0">
                                    <label for="t_02_kurang">Kurang</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered my-0" style="border: 2px solid black; border-top: 0;">
                <tr class="text-center">
                    <th width="25%">Kebutuhan Edukasi</th>
                    <th width="25%">Tujuan</th>
                    <th width="25%">Kemampuan Belajar</th>
                    <th width="25%">Kesiapan Belajar</th>
                </tr>
                <tr>
                    <td>
                        <p>1. Tindakan Pencegahan <br> 2. Intervensi Diet <br> 3. Peralatan Khusus <br> 4. pencegahan Risiko Jatuh <br> 5. Managemen Nyeri <br> 6. Penyakit Khusus <br> 7. Pengobatan <br> 8. Warfain <br> 9. Edukasi Diabetes <br> 10. Tranfusi Darah <br> 11. Vaksinasi <br> 12. Lain-lain</p>
                    </td>
                    <td>1. Mulai menggunakan informasi yang di dapat <br> 2. Dapat mengungkapkan secara lisan informasi yang didapat</td>
                    <td>1. Dapat mengubah perilaku <br> 2. Dapat menguasai informasi <br> 3. Tidak jelas pada saat ini</td>
                    <td>1. Siap <br> 2. Tertarik <br> 3. Tidak tertarik/ Tidak mampu</td>
                </tr>
                <tr>
                    <th>Hambatan</th>
                    <th>Intervensi Terhadap Hambatan</th>
                    <th>Metode Pembelajaran</th>
                    <th>Hasil</th>
                </tr>
                <tr>
                    <td>
                        <p>1. Tidak ada <br> 2. Takut <br> 3. Tidak Tertarik <br> 4. Nyeri/Tidak Nyaman <br> 5. Gangguan Kognitif <br> 6. Hambatan Bahasa</p>
                    </td>
                    <td>
                        <p>1. Tidak ada <br> 2. Membatasi Materi <br> 3. Menggunakan Penerjemah <br> 4. Mengulangi Edukasi br 5. Mengedukasi Keluarga</p>
                    </td>
                    <td>
                        <p>1. Demontrasi <br> 2. Diskusi <br> 3. Leaflet/Handout</p>
                    </td>
                    <td>
                        <p>1. Menunjukkan tingkat pengetahuan yang diharapkan <br> 2. Membutuhkan petunjuk tambahan</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <p>Topik Edukasi</p>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="v_03" name="v_03">
                                </div>
                            </div>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <p>Diberikan Kepada</p>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="v_04" name="v_04">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
    </div>
    <div class="container-fluid table-responsive">

        <table class=" w-full table table-striped table-bordered table-hover my-1" style="border: 2px solid black; border-top: 0;">
            <thead>
                <tr class="text-center">
                    <th>Tanggal</th>
                    <th>Kebutuhan Edukasi</th>
                    <th>Tujuan</th>
                    <th>Kemampuan Belajar</th>
                    <th>Kesiapan Belajar</th>
                    <th>Hambatan</th>
                    <th>Intervensi</th>
                    <th>Metode</th>
                    <th>Hasil</th>
                    <th>Nama/TTD</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr>
                    <td>
                        <input type="date" class="form-control" id="v_05" name="v_05">
                    </td>
                    <td>
                        <select class="form-select" name="t_03">
                            <option selected>Pilih</option>
                            <option value="1">1. Tindakan Pencegahan</option>
                            <option value="2">2. Intervensi Diet</option>
                            <option value="3">3. Peralatan Khusus</option>
                            <option value="4">4. Pencegahan Resiko Jatuh</option>
                            <option value="5">5. Managemen Nyeri</option>
                            <option value="6">6. Penyakit Khusus</option>
                            <option value="7">7. Pengobatan</option>
                            <option value="8">8. Warfain</option>
                            <option value="9">9. Edukasi Diabetes</option>
                            <option value="10">10. Tranfusi Darah</option>
                            <option value="11">11. Vaksinasi</option>
                            <option value="12">12. Lain-Lain</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_04">
                            <option selected>Pilih</option>
                            <option value="1">1. Mulai menggunakan informasi yang didapat</option>
                            <option value="2">2. Dapat mengungkapkan secara lisan informasi yang didapat</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_05">
                            <option selected>Pilih</option>
                            <option value="1">1. Dapat mengubah perilaku</option>
                            <option value="2">2. Dapat menguasai informasi</option>
                            <option value="3">3. Tidak jelas pada saat ini</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_06">
                            <option selected>Pilih</option>
                            <option value="1">1. Siap</option>
                            <option value="2">2. Tertarik</option>
                            <option value="3">3. Tidak tertarik / Tidak mampu</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_07">
                            <option selected>Pilih</option>
                            <option value="1">1. Tidak ada</option>
                            <option value="2">2. Takut</option>
                            <option value="3">3. Tidak tertarik</option>
                            <option value="4">4. Nyeri / Tidak nyaman</option>
                            <option value="5">5. Gangguan Kognitif</option>
                            <option value="6">6. hambatan bahasa</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_08">
                            <option selected>Pilih</option>
                            <option value="1">1. Tidak ada</option>
                            <option value="2">2. Membatasi materi</option>
                            <option value="3">3. Menggunakan penerjemah</option>
                            <option value="4">4. Mengulangi edukasi</option>
                            <option value="5">5. mengedukasi keluarga</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_09">
                            <option selected>Pilih</option>
                            <option value="1">1. Demonstrasi</option>
                            <option value="2">2. Diskusi</option>
                            <option value="3">3. Leaflet/Handout</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_010">
                            <option selected>Pilih</option>
                            <option value="1">1. Menunjukkan tingkat pengetahuan yang diharapkan</option>
                            <option value="2">2. Membutuhkan Petunjuk Tambahan</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="v_06" name="v_06">
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <td colspan="10" align="center">
                    <button type="button" class="btn btn-primary" onclick="addRow('tbody')">Tambah Baris</button>
                </td>
            </tfoot>
        </table>
    </div>
    <div class="container">
        <table class="table table-bordered mt-0 mb-1" style="border: 2px solid black; border-top: 0;">
            <tr>
                <td colspan="2">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <p>Catatan (apabila ada) : </p>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="v_07" name="v_07">
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <p>Topik Edukasi</p>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" class="form-control" id="v_98" name="v_98">
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <p>Diberikan Kepada</p>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="v_99" name="v_99">
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="container-fluid table-responsive">

        <table class=" w-full table table-striped table-bordered table-hover my-1" style="border: 2px solid black; border-top: 0;">
            <thead>
                <tr class="text-center">
                    <th>Tanggal</th>
                    <th>Kebutuhan Edukasi</th>
                    <th>Tujuan</th>
                    <th>Kemampuan Belajar</th>
                    <th>Kesiapan Belajar</th>
                    <th>Hambatan</th>
                    <th>Intervensi</th>
                    <th>Metode</th>
                    <th>Hasil</th>
                    <th>Nama/TTD</th>
                </tr>
            </thead>
            <tbody id="tbody1">
                <tr>
                    <td>
                        <input type="date" class="form-control" id="v_100" name="v_100">
                    </td>
                    <td>
                        <select class="form-select" name="t_100">
                            <option selected>Pilih</option>
                            <option value="1">1. Tindakan Pencegahan</option>
                            <option value="2">2. Intervensi Diet</option>
                            <option value="3">3. Peralatan Khusus</option>
                            <option value="4">4. Pencegahan Resiko Jatuh</option>
                            <option value="5">5. Managemen Nyeri</option>
                            <option value="6">6. Penyakit Khusus</option>
                            <option value="7">7. Pengobatan</option>
                            <option value="8">8. Warfain</option>
                            <option value="9">9. Edukasi Diabetes</option>
                            <option value="10">10. Tranfusi Darah</option>
                            <option value="11">11. Vaksinasi</option>
                            <option value="12">12. Lain-Lain</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_101">
                            <option selected>Pilih</option>
                            <option value="1">1. Mulai menggunakan informasi yang didapat</option>
                            <option value="2">2. Dapat mengungkapkan secara lisan informasi yang didapat</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_102">
                            <option selected>Pilih</option>
                            <option value="1">1. Dapat mengubah perilaku</option>
                            <option value="2">2. Dapat menguasai informasi</option>
                            <option value="3">3. Tidak jelas pada saat ini</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_103">
                            <option selected>Pilih</option>
                            <option value="1">1. Siap</option>
                            <option value="2">2. Tertarik</option>
                            <option value="3">3. Tidak tertarik / Tidak mampu</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_104">
                            <option selected>Pilih</option>
                            <option value="1">1. Tidak ada</option>
                            <option value="2">2. Takut</option>
                            <option value="3">3. Tidak tertarik</option>
                            <option value="4">4. Nyeri / Tidak nyaman</option>
                            <option value="5">5. Gangguan Kognitif</option>
                            <option value="6">6. hambatan bahasa</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_105">
                            <option selected>Pilih</option>
                            <option value="1">1. Tidak ada</option>
                            <option value="2">2. Membatasi materi</option>
                            <option value="3">3. Menggunakan penerjemah</option>
                            <option value="4">4. Mengulangi edukasi</option>
                            <option value="5">5. mengedukasi keluarga</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_106">
                            <option selected>Pilih</option>
                            <option value="1">1. Demonstrasi</option>
                            <option value="2">2. Diskusi</option>
                            <option value="3">3. Leaflet/Handout</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="t_107">
                            <option selected>Pilih</option>
                            <option value="1">1. Menunjukkan tingkat pengetahuan yang diharapkan</option>
                            <option value="2">2. Membutuhkan Petunjuk Tambahan</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="v_101" name="v_101">
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <td colspan="10" align="center">
                    <button type="button" class="btn btn-primary" onclick="addRow1('tbody1')">Tambah Baris</button>
                </td>
            </tfoot>
        </table>
    </div>
    <div class="container">
        <table class="table table-bordered mt-0 mb-5" style="border: 2px solid black; border-top: 0;">
            <tr>
                <td>
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <p>Catatan (apabila ada) : </p>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="v_08" name="v_08">
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    </form>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>