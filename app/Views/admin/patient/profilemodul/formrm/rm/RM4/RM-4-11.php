<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <title>PENGKAJIAN RESTRAIN</title>
</head>

<body>
    <form action="" autocomplete="off" style="vertical-align:middle; font-family:'Times New Roman'">
        <div class="container">
            <h6 style="text-align:right">RM. 4.11</h6>
            <h4 style="text-align: center"><b>REKAM MEDIS RAWAT INAP</b></h4>
            <table class="table table-bordered border-black">
                <tr style="vertical-align:middle; margin:0px">
                    <td>
                        <div class="row">
                            <div class="col-md-3" style="text-align:center">
                                <img src="\img\logo_PKU.png" alt="" style="width:90px"><br>
                                <p>SEHAT AMANAH<br>Tanggungjawab-Islami</p>
                            </div>
                            <div class="col">
                                <h4><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h4>
                                <p>Semanggi RT 02/20 Pasar Kliwon Surakarta<br>
                                    Telp. ( 0271 ) 633894 Fax: 0271- 630229 <br>
                                    Jawa Tengah 57117
                                </p>
                            </div>
                            <div class="col-md-4">
                                <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                                    <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center">
                        <h5><b>PENGKAJIAN RESTRAIN</b></h5>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center">
                        <b>Diisi oleh Dokter</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label for="V_01" class="col-sm-auto col-form-label">Tanggal :</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="V_01" name="V_01">
                            </div>
                            <div class="col-sm-1"></div>
                            <label for="V_02" class="col-sm-1 col-form-label">Jam :</label>
                            <div class="col-sm-4">
                                <input type="time" class="form-control" id="V_02" name="V_02">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-3">
                            <div class="col"><b>PENGKAJIAN FISIK DAN MENTAL</b></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-2">Kesadaran</div>
                            <div class="col-md-4">
                                : <input type="text" id="V_03" name="V_03" style="width: 150px;">
                            </div>
                            <div class="col-md-2">Tanda vital</div>
                            <div class="col-md-4">
                                : <input type="text" id="V_04" name="V_04" style="width: 150px;">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-2">Tekanan Darah</div>
                            <div class="col">
                                : <input type="text" id="V_05" name="V_05" style="width: 70px;">/
                                <input type="text" id="V_06" name="V_06" style="width: 70px;"> mmHg
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-2">Pernafasan </div>
                            <div class="col">
                                : <input type="text" id="V_07" name="V_07" style="width: 150px;"> x/menit
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-2">Suhu</div>
                            <div class="col">
                                : <input type="text" id="V_08" name="V_08" style="width: 150px;"> °C
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">Nadi</div>
                            <div class="col">
                                : <input type="text" id="V_09" name="V_09" style="width: 150px;"> x/menit
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Hasil observasi *)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_01" name="T_01" value="1">
                                    <label class="form-check-label" for="T_01">Gelisah atau delirium dan berontak</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_02" name="T_02" value="1">
                                    <label class="form-check-label" for="T_02">Pasien tidak kooperatif</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_03" name="T_03" value="1">
                                    <label class="form-check-label" for="T_03">Ketidakmampuan dalam mengikuti perintah untuk tidak meninggalkan tempat tidur</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-3">
                            <div class="col">
                                <b>PERTIMBANGAN KLINIS *)</b>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_04" name="T_04" value="1">
                                    <label class="form-check-label" for="T_04">Membahayakan diri sendiri</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_05" name="T_05" value="1">
                                    <label class="form-check-label" for="T_05">Membahayakan orang lain</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_06" name="T_06" value="1">
                                    <label class="form-check-label" for="T_06">Gagal meminimalkan penggunaan Restrain</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <b>PENILAIAN DAN ORDER DOKTER *)</b><br>
                                Restrain Non Farmakologi
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_07" name="T_07" value="1">
                                    <label class="form-check-label" for="T_07">Restrain tempat tidur atau bedrail</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_08" name="T_08" value="1">
                                    <label class="form-check-label" for="T_08">Restrain pergelangan tangan</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="T_09" name="T_09" value="1">
                                        <label class="form-check-label" for="T_09">Tangan kanan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="T_010" name="T_010" value="1">
                                        <label class="form-check-label" for="T_010">Tangan kiri</label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_011" name="T_011" value="1">
                                    <label class="form-check-label" for="T_011">Restrain pergelangan kaki</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="T_012" name="T_012" value="1">
                                        <label class="form-check-label" for="T_012">Tangan kanan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="T_013" name="T_013" value="1">
                                        <label class="form-check-label" for="T_013">Tangan kiri</label>
                                    </div>
                                </div>
                                Lain - lain : <input type="text" id="V_10" name="V_10" style="width: 300px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <b>RENCANA PENGKAJIAN LANJUTAN *)</b>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_014" name="T_014" value="1">
                                    <label class="form-check-label" for="T_014">Pengkajian satu jam pertama</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_015" name="T_015" value="1">
                                    <label class="form-check-label" for="T_015">Pengkajian lanjutan tiap dua jam</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_016" name="T_016" value="1">
                                    <label class="form-check-label" for="T_016">Pengkajian dua jam pertama</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_017" name="T_017" value="1">
                                    <label class="form-check-label" for="T_017">Pengkajian lanjutan tiap empat jam</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_018" name="T_018" value="1">
                                    <label class="form-check-label" for="T_018">Observasi Tanda-Tanda Vital (TTV) tiga puluh menit atau satu jam setelah pemberian obat selanjutnya sesuai kondisi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_019" name="T_019" value="1">
                                    <label class="form-check-label" for="T_019">Observasi lanjutan setiap satu jam</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <b>PENDIDIKAN RESTRAIN PASIEN ATAU KELUARGA *)</b>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_020" name="T_020" value="1">
                                    <label class="form-check-label" for="T_020">Menjelaskan alasan penggunaan restrain sebagai prosedur emergensi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_021" name="T_021" value="1">
                                    <label class="form-check-label" for="T_021">Menjelaskan kriteria hasil observasi atau ketentuan penghentian restrain (lihat halam 2)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_022" name="T_022" value="1">
                                    <label class="form-check-label" for="T_022">Memberikan informasi atau edukasi kepada pasien atau keluarga alasan penggunaan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="text-align:center">
                            <div class="col">
                                Dijelaskan Oleh,<br>
                                <button class="btn btn-outline-success" type="button" onclick="clearCanvas()">Clear Signature</button><br>
                                <canvas id="canvas" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD"><br>
                                ( <input type="text" id="V_11" name="V_11" style="width:250px; text-align: center;"> )<br>
                                TTD dan Nama Terang
                            </div>
                            <div class="col">
                                Yang menerima informasi,<br>
                                <button class="btn btn-outline-success" type="button" onclick="clearCanvas1()">Clear Signature</button><br>
                                <canvas id="canvas1" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD_1" id="TTD_1"><br>
                                ( <input type="text" id="V_12" name="V_12" style="width:250px; text-align: center;"> )<br>
                                TTD dan Nama Terang
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-3" style="text-align: center;">
                            <div class="col">
                                <h5><b>PENGKAJIAN PENGHENTIAN RESTRAIN</b></h5>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col"><b>PENGKAJIAN FISIK DAN MENTAL</b></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-2">Kesadaran</div>
                            <div class="col-md-4">
                                : <input type="text" id="V_13" name="V_13" style="width: 150px;">
                            </div>
                            <div class="col-md-2">Pernafasan </div>
                            <div class="col">
                                : <input type="text" id="V_14" name="V_14" style="width: 150px;"> x/menit
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-2">Tanda vital</div>
                            <div class="col-md-4">
                                : <input type="text" id="V_15" name="V_15" style="width: 150px;">
                            </div>
                            <div class="col-md-2">Tekanan Darah</div>
                            <div class="col">
                                : <input type="text" id="V_16" name="V_16" style="width: 70px;">/
                                <input type="text" id="V_17" name="V_17" style="width: 70px;"> mmHg
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">Suhu</div>
                            <div class="col">
                                : <input type="text" id="V_18" name="V_18" style="width: 150px;"> °C
                            </div>
                            <div class="col-md-2">Nadi</div>
                            <div class="col">
                                : <input type="text" id="V_19" name="V_19" style="width: 150px;"> x/menit
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Kriteria untuk menghentikan pemakaian resstrain*) :
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_023" name="T_023" value="1">
                                    <label class="form-check-label" for="T_023">Mampu mengenali orang, tempat, lingkungan dan waktu</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_024" name="T_024" value="1">
                                    <label class="form-check-label" for="T_024">Mampu secara verbal melakukan kesepakatan untuk keamanan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_025" name="T_025" value="1">
                                    <label class="form-check-label" for="T_025">Mampu mengenali dan atau mendiskusikan alternatif pertahanan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_026" name="T_026" value="1">
                                    <label class="form-check-label" for="T_026">Pasien sadar penuh (GCS 15)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_027" name="T_027" value="1">
                                    <label class="form-check-label" for="T_027">Perilaku awal tidak ditemukan lagi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_028" name="T_028" value="1">
                                    <label class="form-check-label" for="T_028">Lain - lain</label>
                                    <input type="text" id="V_20" name="V_20" style="width:500px">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="V_21">Jelaskan jika pasien telah menunjukan adanya kriteria atau ketentuan untuk menghentikan penggunaan restrain :</label>
                                <textarea class="form-control" name="V_21" id="V_21" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row" style="vertical-align:bottom">
                            <div class="col-md-3">
                                <label for="V_22">Nama Perawat yang melepas</label>
                            </div>
                            <div class="col-md-3">
                                : <input type="text" id="V_22" name="V_22" style="width:150px">
                            </div>
                            <div class="col-md-2">
                                Tanda Tangan
                            </div>
                            <div class="col-md-auto">:</div>
                            <div class="col">
                                <button class="btn btn-outline-success" type="button" onclick="clearCanvas2()">Clear Signature</button><br>
                                <canvas id="canvas2" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD_2" id="TTD_2">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="V_23">Tanggal / Bulan / Tahun</label>
                            </div>
                            <div class="col-md-3">
                                : <input type="date" id="V_23" name="V_23" style="width:150px">
                            </div>
                            <div class="col-md-2">
                                <label for="V_24">Pukul</label>
                            </div>
                            <div class="col">
                                : <input type="time" id="V_24" name="V_24" style="width:150px">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row mb-3">
                <div class="col">Catatan : *) beri tanda (√) sesuai pilihan</div>
            </div>
        </div>
        <div class="container-xxl">
            <div class="row mb-2" style="text-align: center;">
                <div class="col"><b>FORMULIR MONITORING RESTRAIN</b></div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2">
                    <label for="V_25">Nama Pasien</label>
                </div>
                <div class="col">
                    : <input type="text" id="V_25" name="V_25" style="width:300px">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2">
                    <label for="V_26">Tanggal Lahir</label>
                </div>
                <div class="col">
                    : <input type="date" id="V_26" name="V_26" style="width:300px">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2">
                    <label for="V_27">No RM</label>
                </div>
                <div class="col">
                    : <input type="text" id="V_27" name="V_27" style="width:300px">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2">
                    <label for="V_28">DPJP</label>
                </div>
                <div class="col">
                    : <input type="text" id="V_28" name="V_28" style="width:300px">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2">
                    <label for="V_29">Ruangan</label>
                </div>
                <div class="col">
                    : <input type="text" id="V_29" name="V_29" style="width:300px">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="V_30">Diagnosa</label>
                </div>
                <div class="col">
                    : <input type="text" id="V_30" name="V_30" style="width:300px">
                </div>
            </div>
            <div class="table-responsive">
                <table id="tbody" class="table table-bordered border-black">
                    <thead style="text-align:center; vertical-align:middle">
                        <tr>
                            <td rowspan="2">TGL/JAM</td>
                            <td colspan="4">TANDA - TANDA VITAL</td>
                            <td rowspan="2">KESADARAN</td>
                            <td rowspan="2">LOKASI RESTRAIN</td>
                            <td rowspan="2">LUKA (+/-)</td>
                            <td rowspan="2">DECUBITUS</td>
                            <td rowspan="2">BAK</td>
                            <td rowspan="2">BAB</td>
                            <td rowspan="2">NAMA PERAWAT PARAF</td>
                            <td rowspan="2">KETERANGAN</td>
                        </tr>
                        <tr>
                            <td>TD</td>
                            <td>HR</td>
                            <td>RR</td>
                            <td>S</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="datetime-local" id="V_31" name="V_31" style="width:100px">
                            </td>
                            <td>
                                <input type="text" id="V_32" name="V_32" style="width:100px">
                            </td>
                            <td>
                                <input type="text" id="V_33" name="V_33" style="width:50px">
                            </td>
                            <td>
                                <input type="text" id="V_34" name="V_34" style="width:50px">
                            </td>
                            <td>
                                <input type="text" id="V_35" name="V_35" style="width:50px">
                            </td>
                            <td>
                                <input type="text" id="V_36" name="V_36" style="width:100px">
                            </td>
                            <td>
                                <input type="text" id="V_37" name="V_37" style="width:100px">
                            </td>
                            <td>
                                <input type="text" id="V_38" name="V_38" style="width:70px">
                            </td>
                            <td>
                                <input type="text" id="V_39" name="V_39" style="width:100px">
                            </td>
                            <td>
                                <input type="text" id="V_40" name="V_40" style="width:50px">
                            </td>
                            <td>
                                <input type="text" id="V_41" name="V_41" style="width:50px">
                            </td>
                            <td>
                                <input type="text" id="V_42" name="V_42" style="width:100px">
                            </td>
                            <td>
                                <input type="text" id="V_43" name="V_43" style="width:100px">
                            </td>
                        </tr>
                    </tbody>
                    <tfoot style="text-align:center">
                        <td colspan="13">
                            <button type="button" class="btn btn-primary" onclick="addRow('tbody')">Tambah Baris</button>
                        </td>
                    </tfoot>
                </table>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        // JavaScript Document
        var i = 43;

        function addRow(tableID) {

            i1 = i + 1;
            i2 = i + 2;
            i3 = i + 3;
            i4 = i + 4;
            i5 = i + 5;
            i6 = i + 6;
            i7 = i + 7;
            i8 = i + 8;
            i9 = i + 9;
            i10 = i + 10;
            i11 = i + 11;
            i12 = i + 12;
            i13 = i + 13;

            $("#" + tableID).append($("<tr>")
                .append($("<td>").html('<div class="form-group"><input type="datetime-local" style="width:100px" id="V_' + i1 + '" name="V_' + i1 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:100px" id="V_' + i2 + '" name="V_' + i2 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:50px" id="V_' + i3 + '" name="V_' + i3 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:50px" id="V_' + i4 + '" name="V_' + i4 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:50px" id="V_' + i5 + '" name="V_' + i5 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:100px" id="V_' + i6 + '" name="V_' + i6 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:100px" id="V_' + i7 + '" name="V_' + i7 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:70px" id="V_' + i8 + '" name="V_' + i8 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:100px" id="V_' + i9 + '" name="V_' + i9 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:50px" id="V_' + i10 + '" name="V_' + i10 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:50px" id="V_' + i11 + '" name="V_' + i11 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:100px" id="V_' + i12 + '" name="V_' + i12 + '"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" style="width:100px" id="V_' + i13 + '" name="V_' + i13 + '"></div>'))
            )
            i += 13;
        }
    </script>
    <script>
        var canvas = document.getElementById('canvas');
        const canvasDataInput = document.getElementById('TTD');
        var context = canvas.getContext('2d');
        var drawing = false;

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        function startDrawing(e) {
            drawing = true;
            draw(e);
        }

        function draw(e) {
            if (!drawing) return;

            context.lineWidth = 2;
            context.lineCap = 'round';
            context.strokeStyle = '#000';

            context.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
            context.stroke();
            context.beginPath();
            context.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
        }

        function stopDrawing() {
            drawing = false;
            context.beginPath();
        }

        function clearCanvas() {
            context.clearRect(0, 0, canvas.width, canvas.height);
        }

        function saveSignatureData() {
            const canvasData = canvas.toDataURL('image/png');

            canvasDataInput.value = canvasData;
        }
    </script>
    <script>
        var canvas1 = document.getElementById('canvas1');
        const canvasDataInput1 = document.getElementById('TTD_1');
        var context1 = canvas1.getContext('2d');
        var drawing = false;

        canvas1.addEventListener('mousedown', startDrawing);
        canvas1.addEventListener('mousemove', draw);
        canvas1.addEventListener('mouseup', stopDrawing);
        canvas1.addEventListener('mouseout', stopDrawing);

        function startDrawing(e) {
            drawing = true;
            draw(e);
        }

        function draw(e) {
            if (!drawing) return;

            context1.lineWidth = 2;
            context1.lineCap = 'round';
            context1.strokeStyle = '#000';

            context1.lineTo(e.clientX - canvas1.getBoundingClientRect().left, e.clientY - canvas1.getBoundingClientRect().top);
            context1.stroke();
            context1.beginPath();
            context1.moveTo(e.clientX - canvas1.getBoundingClientRect().left, e.clientY - canvas1.getBoundingClientRect().top);
        }

        function stopDrawing() {
            drawing = false;
            context1.beginPath();
        }

        function clearCanvas1() {
            context1.clearRect(0, 0, canvas1.width, canvas1.height);
        }

        function saveSignatureData1() {
            const canvasData1 = canvas1.toDataURL('image/png');

            canvasDataInput1.value = canvasData1;
        }
    </script>
    <script>
        var canvas2 = document.getElementById('canvas2');
        const canvasDataInput2 = document.getElementById('TTD_2');
        var context2 = canvas2.getContext('2d');
        var drawing = false;

        canvas2.addEventListener('mousedown', startDrawing);
        canvas2.addEventListener('mousemove', draw);
        canvas2.addEventListener('mouseup', stopDrawing);
        canvas2.addEventListener('mouseout', stopDrawing);

        function startDrawing(e) {
            drawing = true;
            draw(e);
        }

        function draw(e) {
            if (!drawing) return;

            context2.lineWidth = 2;
            context2.lineCap = 'round';
            context2.strokeStyle = '#000';

            context2.lineTo(e.clientX - canvas2.getBoundingClientRect().left, e.clientY - canvas2.getBoundingClientRect().top);
            context2.stroke();
            context2.beginPath();
            context2.moveTo(e.clientX - canvas2.getBoundingClientRect().left, e.clientY - canvas2.getBoundingClientRect().top);
        }

        function stopDrawing() {
            drawing = false;
            context2.beginPath();
        }

        function clearCanvas2() {
            context2.clearRect(0, 0, canvas2.width, canvas2.height);
        }

        function saveSignatureData1() {
            const canvasData1 = canvas2.toDataURL('image/png');

            canvasDataInput1.value = canvasData1;
        }
    </script>
</body>

</html>