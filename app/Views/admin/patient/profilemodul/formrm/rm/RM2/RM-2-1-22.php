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
    <title>ASESMEN PASIEN DENGAN RISIKO MENDAPATKAN KEKERASAN FISIK</title>
</head>

<body>
    <div class="container">
        <h6 style="text-align:right">RM 2.1.22</h6>
        <form action="" autocomplete="off" style="font-family:'Times New Roman';">
            <div class="row mb-3">
                <div class="col-md-3" style="text-align:center">
                    <img src="\img\logo_PKU.png" alt="" style="width:90px"><br>
                    <p>SEHAT AMANAH<br>Tanggungjawab-Islami</p>
                </div>
                <div class="col">
                    <h5><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h5>
                    <p>Semanggi RT 02/20 Pasar Kliwon Surakarta<br>
                        <i class="bi bi-telephone-fill"></i> 0271-533894 Fax. : 0271-630229 <br>
                        SURAKARTA
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                        <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                    </div>
                </div>
            </div>
            <div class="row" style="text-align:center">
                <div class="col">
                    <h4><b>ASESMEN AWAL MEDIS PASIEN REHABILITASI MEDIK RAWAT INAP</b></h4>
                </div>
            </div>
            <table class="table table-bordered border-black mb-5">
                <tr>
                    <td colspan="4">
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
                    <td colspan="4">
                        <div class="row">
                            <label for="V_03" class="col-sm-auto col-form-label"><b>Riwayat Alergi :</b></label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_03" name="V_03">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row mb-1">
                            <div class="col">
                                <b>ANAMNESIS : </b>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_01" id="T_01_0" value="0">
                                    <label class="form-check-label" for="T_01_0"><b>Autoanamnesis / </b></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_01" id="T_01_1" value="1">
                                    <label class="form-check-label" for="T_01_1"><b>Alloanamnesis*</b></label>
                                </div> dengan :
                                <input type="text" id="V_04" name="V_04" style="width:100px">
                                Hubungan dengan pasien :
                                <input type="text" id="V_05" name="V_05" style="width:100px">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <label for="V_06" class="col-sm-3 col-form-label">Keluhan Utama</label>
                            <div class="col-sm-auto col-form-label">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_06" name="V_06">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <label for="V_07" class="col-sm-3 col-form-label">Riwayat penyakit Sekarang</label>
                            <div class="col-sm-auto col-form-label">:</div>
                            <div class="col">
                                <textarea class="form-control" name="V_07" id="V_07" rows="3"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <label for="V_08" class="col-sm-3 col-form-label">Alloanamnesis dengan</label>
                            <div class="col-sm-auto col-form-label">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_08" name="V_08">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <label for="V_09" class="col-sm-3 col-form-label">Hasil alloanamnesis</label>
                            <div class="col-sm-auto col-form-label">:</div>
                            <div class="col">
                                <textarea class="form-control" name="V_09" id="V_09" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <label for="V_10" class="col-sm-3 col-form-label">Riwayat Penyakit Dahulu</label>
                            <div class="col-sm-auto col-form-label">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_10" name="V_10">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <label for="V_11" class="col-sm-auto col-form-label"><b>Riwayat Obat yang dikonsumsi :</b></label>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="V_11" name="V_11">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <div class="col"><b>Pemeriksaan Fisik</b></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>A. Keadaan Umum</b></div>
                            <div class="col-md-auto">&nbsp;&nbsp;&nbsp;:</div>
                        </div>
                        <div class="container mb-2">
                            <div class="row">
                                <div class="col-md-3"><b>Tanda Vital</b></div>
                                <div class="col-md-auto">:</div>
                                <div class="col">
                                    <label for="V_12">TD :</label>
                                    <input type="text" id="V_12" name="V_12" style="width:50px"> /
                                    <input type="text" id="V_13" name="V_13" style="width:50px"> mmHg &nbsp;&nbsp;&nbsp;
                                    <label for="V_14">N :</label>
                                    <input type="text" id="V_14" name="V_14" style="width:50px"> x/menit &nbsp;&nbsp;&nbsp;
                                    <label for="V_15">R :</label>
                                    <input type="text" id="V_15" name="V_15" style="width:50px"> x/menit &nbsp;&nbsp;&nbsp;
                                    <label for="V_16">S :</label>
                                    <input type="text" id="V_16" name="V_16" style="width:50px"> °C
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-3"><b>B. Status Lokalis :</b></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:25%">NECK</td>
                    <td style="width:25%"></td>
                    <td style="width:25%; text-align:center">ROM</td>
                    <td style="width:25%; text-align:center">MMT</td>
                </tr>
                <tr>
                    <td rowspan="4"></td>
                    <td>Fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_17" name="V_17">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_18" name="V_18">
                    </td>
                </tr>
                <tr>
                    <td>Ekstensi</td>
                    <td>
                        <input type="text" class="form-control" id="V_19" name="V_19">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_20" name="V_20">
                    </td>
                </tr>
                <tr>
                    <td>Lateral fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_21" name="V_21">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_22" name="V_22">
                    </td>
                </tr>
                <tr>
                    <td>Rotasi</td>
                    <td>
                        <input type="text" class="form-control" id="V_23" name="V_23">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_24" name="V_24">
                    </td>
                </tr>
                <tr>
                    <td>TRUNK</td>
                    <td>Fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_25" name="V_25">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_26" name="V_26">
                    </td>
                </tr>
                <tr>
                    <td rowspan="3"></td>
                    <td>Ekstensi</td>
                    <td>
                        <input type="text" class="form-control" id="V_27" name="V_27">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_28" name="V_28">
                    </td>
                </tr>
                <tr>
                    <td>Lateral fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_29" name="V_29">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_30" name="V_30">
                    </td>
                </tr>
                <tr>
                    <td>Rotasi</td>
                    <td>
                        <input type="text" class="form-control" id="V_31" name="V_31">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_32" name="V_32">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Ekstremitas Superior</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="6">Shoulder</td>
                    <td>Fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_33" name="V_33">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_34" name="V_34">
                    </td>
                </tr>
                <tr>
                    <td>Ekstensi</td>
                    <td>
                        <input type="text" class="form-control" id="V_35" name="V_35">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_36" name="V_36">
                    </td>
                </tr>
                <tr>
                    <td>Abduksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_37" name="V_37">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_38" name="V_38">
                    </td>
                </tr>
                <tr>
                    <td>Adduksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_39" name="V_39">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_40" name="V_40">
                    </td>
                </tr>
                <tr>
                    <td>Rotasi Internal</td>
                    <td>
                        <input type="text" class="form-control" id="V_41" name="V_41">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_42" name="V_42">
                    </td>
                </tr>
                <tr>
                    <td>Rotasi Eksternal</td>
                    <td>
                        <input type="text" class="form-control" id="V_43" name="V_43">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_44" name="V_44">
                    </td>
                </tr>
                <tr>
                    <td rowspan="4">Elbow</td>
                    <td>Fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_45" name="V_45">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_46" name="V_46">
                    </td>
                </tr>
                <tr>
                    <td>Ekstensi</td>
                    <td>
                        <input type="text" class="form-control" id="V_47" name="V_47">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_48" name="V_48">
                    </td>
                </tr>
                <tr>
                    <td>Pronasi</td>
                    <td>
                        <input type="text" class="form-control" id="V_49" name="V_49">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_50" name="V_50">
                    </td>
                </tr>
                <tr>
                    <td>Supinasi</td>
                    <td>
                        <input type="text" class="form-control" id="V_51" name="V_51">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_52" name="V_52">
                    </td>
                </tr>
                <tr>
                    <td rowspan="4">Wrist</td>
                    <td>Fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_53" name="V_53">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_54" name="V_54">
                    </td>
                </tr>
                <tr>
                    <td>Ekstensi</td>
                    <td>
                        <input type="text" class="form-control" id="V_55" name="V_55">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_56" name="V_56">
                    </td>
                </tr>
                <tr>
                    <td>Deviasi ulnar</td>
                    <td>
                        <input type="text" class="form-control" id="V_57" name="V_57">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_58" name="V_58">
                    </td>
                </tr>
                <tr>
                    <td>Deviasi radial</td>
                    <td>
                        <input type="text" class="form-control" id="V_59" name="V_59">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_60" name="V_60">
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">Finger</td>
                    <td>Fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_61" name="V_61">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_62" name="V_62">
                    </td>
                </tr>
                <tr>
                    <td>Ekstensi</td>
                    <td>
                        <input type="text" class="form-control" id="V_63" name="V_63">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_64" name="V_64">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Ekstremitas Inferior</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="6">Hip</td>
                    <td>Fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_65" name="V_65">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_66" name="V_66">
                    </td>
                </tr>
                <tr>
                    <td>Ekstensi</td>
                    <td>
                        <input type="text" class="form-control" id="V_67" name="V_67">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_68" name="V_68">
                    </td>
                </tr>
                <tr>
                    <td>Abduksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_69" name="V_69">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_70" name="V_70">
                    </td>
                </tr>
                <tr>
                    <td>Adduksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_71" name="V_71">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_72" name="V_72">
                    </td>
                </tr>
                <tr>
                    <td>Rotasi Internal</td>
                    <td>
                        <input type="text" class="form-control" id="V_73" name="V_73">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_74" name="V_74">
                    </td>
                </tr>
                <tr>
                    <td>Rotasi Eksternal</td>
                    <td>
                        <input type="text" class="form-control" id="V_75" name="V_75">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_76" name="V_76">
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">Knee</td>
                    <td>Fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_77" name="V_77">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_78" name="V_78">
                    </td>
                </tr>
                <tr>
                    <td>Ekstensi</td>
                    <td>
                        <input type="text" class="form-control" id="V_79" name="V_79">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_80" name="V_80">
                    </td>
                </tr>
                <tr>
                    <td rowspan="4">Ankle</td>
                    <td>Fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_81" name="V_81">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_82" name="V_82">
                    </td>
                </tr>
                <tr>
                    <td>Ekstensi</td>
                    <td>
                        <input type="text" class="form-control" id="V_83" name="V_83">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_84" name="V_84">
                    </td>
                </tr>
                <tr>
                    <td>Inversi</td>
                    <td>
                        <input type="text" class="form-control" id="V_85" name="V_85">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_86" name="V_86">
                    </td>
                </tr>
                <tr>
                    <td>Eversi</td>
                    <td>
                        <input type="text" class="form-control" id="V_87" name="V_87">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_88" name="V_88">
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">Toes</td>
                    <td>Fleksi</td>
                    <td>
                        <input type="text" class="form-control" id="V_89" name="V_89">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_90" name="V_90">
                    </td>
                </tr>
                <tr>
                    <td>Ekstensi</td>
                    <td>
                        <input type="text" class="form-control" id="V_91" name="V_91">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="V_92" name="V_92">
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <div class="col"><b>Pemeriksaan Penunjang :</b></div>
                        </div>
                        <div class="container">
                            <div class="row mb-1">
                                <label for="V_93" class="col-sm-3 col-form-label">1. Laboratorium</label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_93" name="V_93">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_94" class="col-sm-3 col-form-label">2. Radiologi</label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_94" name="V_94">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_95" class="col-sm-3 col-form-label">3. ECG</label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_95" name="V_95">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_96" class="col-sm-3 col-form-label">4. Lain - lain</label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_96" name="V_96">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row mb-1">
                            <label for="V_97" class="col-sm-3 col-form-label"><b>Diagnosa Kerja</b></label>
                            <div class="col-sm-auto col-form-label">:</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="V_97" name="V_97">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row mb-1">
                            <label for="V_98" class="col-sm-3 col-form-label"><b>Diagnosa Banding</b></label>
                            <div class="col-sm-auto col-form-label">:</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea class="form-control" name="V_98" id="V_98" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row mb-1">
                            <div class="col-sm-3 col-form-label"><b>Masalah</b></div>
                            <div class="col-sm-auto col-form-label">:</div>
                        </div>
                        <div class="container">
                            <div class="row mb-1">
                                <label for="V_99" class="col-sm-3 col-form-label">a. Medis</label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_99" name="V_99">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_100" class="col-sm-3 col-form-label">b. Keperawatan</label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_100" name="V_100">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row mb-1">
                            <label for="V_101" class="col-sm-3 col-form-label"><b>Sasaran</b></label>
                            <div class="col-sm-auto col-form-label">:</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="V_101" name="V_101">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row mb-1">
                            <label for="V_102" class="col col-form-label"><b>RENCANA ASUHAN/ TERAPI/ INSTRUKSI <i>(standing order) :</i></b></label>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea class="form-control" name="V_102" id="V_102" rows="5"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row mb-1">
                            <div class="col"><b>EDUKASI PASIEN :</b></div>
                        </div>
                        <div class="row">
                            <div class="col">Edukasi awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi Kepada :</div>
                        </div>
                        <div class="container">
                            <div class="row mb-1">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="T_02" id="T_02_0" value="0">
                                        <label class="form-check-label" for="T_02_0">Pasien</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="T_02" id="T_02_1" value="1">
                                        <label class="form-check-label" for="T_02_1">Keluarga pasien, </label>
                                        nama : <input type="text" id="V_103" name="V_103" style="width:200px">,
                                        Hubungan dengan pasien : <input type="text" id="V_104" name="V_104" style="width:200px">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="T_02" id="T_02_2" value="2">
                                        <label class="form-check-label" for="T_02_2">Tidak dapat memberi edukasi kepada pasien atau keluarga, </label>
                                        Karena <input type="text" id="V_105" name="V_105" style="width:200px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row mb-5">
                <div class="col-md-6" style="text-align: center;">
                    Penerima Penjelasan<br>
                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas()">Clear Signature</button><br>
                    <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD" id="TTD"><br>
                    ( <input type="text" id="V_106" name="V_106" style="width:200px; text-align: center;"> )<br>
                    Ttd & Nama Terang
                </div>
                <div class="col-md-6" style="text-align: center;">
                    Dokter<br>
                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas1()">Clear Signature</button><br>
                    <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD_1" id="TTD_1"><br>
                    ( <input type="text" id="V_107" name="V_107" style="width:200px; text-align: center;"> )<br>
                    Ttd & Nama Terang
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <p>
                        <i>Beri tanda (√) pada kotak (□) sesuai pilihan<br>
                            Ditulis dengan lengkap dan terbaca<br>
                            Ditulis dengan lengkap dan jelas terbaca
                        </i>
                    </p>
                </div>
            </div>
        </form>
    </div>
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
</body>

</html>