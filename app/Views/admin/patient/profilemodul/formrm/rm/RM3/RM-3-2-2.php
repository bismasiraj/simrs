<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RM 3.2.2 dx perawat - diagnosa ketidakefektifan perfusi jaringan</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RM 3.2.2</b></h5>

            <br><br>
            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            <img src="<?= base_url('img/logo.png') ?>" alt="logo" width="100px">
                            <div>
                                <label>SEhat-aMANah <br>tanGGungjawab-Islami</label>
                            </div>
                        </td>
                        <td>
                            <h3><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h3>
                            <h5>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta<br>Telp 0271-633894 Fax. : 0271-630229 <br>Jawa Tengah 57117</h5>
                        </td>
                        <td>
                            <div class="container" style="height: 150px; border: 1px solid black; border-radius: 3px">
                                <h5 style="text-align: center; margin-top: 60px">Label Identitas Pasien</h5>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>


            <br>
            <h5 style="text-align: center;"><b>DIAGNOSA KETIDAKEFEKTIFAN PERFUSI JARINGAN</b></h5>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>DPJP</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_01" id="v_01" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>PPJP</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_02" id="v_02" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>RUANG</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_03" id="v_03" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>KELAS</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_04" id="v_04" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>


            <br><br>
            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>

                    <tr>
                        <td style="text-align: center;"><b>Tgl/Jam <br>No.Dx</b></td>
                        <td style="text-align: center;"><b>Diagnosa<br>Keperawatan</b></td>
                        <td style="text-align: center;"><b>NOC</b></td>
                        <td style="text-align: center;"><b>NIC</b></td>
                        <td style="text-align: center;"><b>Nama/<br>Ttd</b></td>
                    </tr>

                    <tr>
                        <td>1. <input type="date" id="v_05" name="v_05" style="width: 110px"></td>
                        <td>
                            <div class="mb-1">Ketidak Efektifan Perfusi Jaringan :</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_01" value="0" id="t_01_jantung">
                                <label class="form-check-label" for="t_01_jantung">Jantung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_02" value="1" id="t_02_peri">
                                <label class="form-check-label" for="t_02_peri">Perifer</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_03" value="2" id="t_03_ginjal">
                                <label class="form-check-label" for="t_03_ginjal">Ginjal</label>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="t_04" value="3" id="t_04_otak">
                                    <label class="form-check-label" for="t_04_otak">Otak</label>
                                </div>
                            </div>

                            <div class="mb-1">Berhubungan dengan :</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_05" id="t_05_faktor">
                                <label class="form-check-label" for="t_05_faktor">Faktor usia>60 th.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="" id="t_06_dia">
                                <label class="form-check-label" for="t_06_dia">Diabetes Melitus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_06" id="t_07_hiper">
                                <label class="form-check-label" for="t_07_hiper">Hipertensi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_08" id="t_08_daya">
                                <label class="form-check-label" for="t_08_daya">Gaya hidup (Merokok).</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_09" id="t_09_demia">
                                <label class="form-check-label" for="t_09_demia">Hiperlipidemia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_010" id="t_010_hb">
                                <label class="form-check-label" for="t_010_hb">Penurunan kadar HB</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_011" id="t_011_spasme">
                                <label class="form-check-label" for="t_011_spasme">Spasme arteri coroner</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_012" id="t_012_coroner">
                                <label class="form-check-label" for="t_012_coroner">Riwayat penyakit arteri coroner</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_013" id="t_013_hy">
                                <label class="form-check-label" for="t_013_hy">Hypovolemia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_014" id="t_014_hipo">
                                <label class="form-check-label" for="t_014_hipo">Hipoksemia/hipoksia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_15" id="t_15">
                                <label class="form-check-label" for="t_15">Infeksi (sepsis)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_016" id="t_016">
                                <label class="form-check-label" for="t_016">Asidosis metabolic</label>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="t_017" id="t_017">
                                    <label class="form-check-label" for="t_017">Penyakit ginjal </label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1">Perfusi jaringan efdektif, setelah <br> dilakukan tindakan keperawatan <br> selama
                                <input type="text" id="v_06" name="v_06" style="width: 50px"> x 24 jam dengan kriteria<br>hasil :
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_018">
                                <label class="form-check-label" for="t_018">Tekanan darah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_019">
                                <label class="form-check-label" for="t_019">kadar gula darah</label><br>
                                GDS<input type="text" id="v_07" name="v_07" style="width: 100px"><br>
                                GDP<input type="text" id="v_08" name="v_08" style="width: 100px"><br>
                                GDP 2 j PP<input type="text" id="v_09" name="v_09" style="width: 100px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_020">
                                <label class="form-check-label" for="t_020">Hemoglobin</label>
                                <input type="text" id="v_10" name="v_10" style="width: 100px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_021">
                                <label class="form-check-label" for="t_021">Kadar Lemak</label>
                                <input type="text" id="v_11" name="v_11" style="width: 100px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_022">
                                <label class="form-check-label" for="t_022">Natrium</label>
                                <input type="text" id="v_12" name="v_12" style="width: 100px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_023">
                                <label class="form-check-label" for="t_023">Kalium</label>
                                <input type="text" id="v_13" name="v_13" style="width: 100px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_024">
                                <label class="form-check-label" for="t_024">Clorida </label>
                                <input type="text" id="v_14" name="v_14" style="width: 100px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_025">
                                <label class="form-check-label" for="t_025">Calsium </label>
                                <input type="text" id="v_15" name="v_15" style="width: 100px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_026">
                                <label class="form-check-label" for="t_026">Kreatinin </label>
                                <input type="text" id="v_16" name="v_16" style="width: 100px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_027">
                                <label class="form-check-label" for="t_027">Hematokrit </label>
                                <input type="text" id="v_17" name="v_17" style="width: 100px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_028">
                                <label class="form-check-label" for="t_028">BUN</label>
                                <input type="text" id="v_18" name="v_18" style="width: 100px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_029">
                                <label class="form-check-label" for="t_029">Komunikasi jelas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_030">
                                <label class="form-check-label" for="t_030">Orientasi baik (waktu, tempat dan orang).</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_031">
                                <label class="form-check-label" for="t_031">Fungsi sensori motori kranial baik</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_032">
                                <label class="form-check-label" for="t_032">CVP</label>
                                <input type="text" id="v_19" name="v_19" style="width: 100px">
                            </div>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="t_033">
            <label class="form-check-label" for="t_033">Nadi perifer kuat dan simetris.</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="t_034">
            <label class="form-check-label" for="t_034">Tidak ada oedem perifer, asites</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="t_035">
            <label class="form-check-label" for="t_035">AGD normal</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="t_036">
            <label class="form-check-label" for="t_036">Tidak ada nyeri dada</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="t_037">
            <label class="form-check-label" for="t_037">Tidak ada kelelahan ekstrim</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="t_038">
            <label class="form-check-label" for="t_038">Tidak ada rasa haus, membrane mukosa lembab</label>
        </div>
        </td>
        <td>
            <div class="mb-1">Cardiac Care</div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_039" id="t_039_ikterik">
                <label class="form-check-label" for="t_039_ikterik">Monitor adanya nyeri dada</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_040" id="t_040_glukosa">
                <label class="form-check-label" for="t_040_glukosa">Catat adanya disritmia</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_041" id="t_041_efektif">
                <label class="form-check-label" for="t_041_efektif">Catat adanya tanda gejala penurunan cardiac output.</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_042" id="t_042_tidak">
                <label class="form-check-label" for="t_042_tidak">Monitor balance cairan</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_043" id="t_043_difisit">
                <label class="form-check-label" for="t_043_difisit">Monitor tekanan darah</label>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="t_044" id="t_044_syok">
                    <label class="form-check-label" for="t_044_syok">Monitor respon pasien terhadap pengobatan antiaritmia.</label>
                </div>
            </div>

            <div class="mb-1">Manajemen Asam Basa</div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_045" id="t_045_glukosa">
                <label class="form-check-label" for="t_045_glukosa">Observasi status hidrasi.</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_046" id="t_046_efektif">
                <label class="form-check-label" for="t_046_efektif">Pertahankan intake-out put cairan secara akurat.</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_047" id="t_047_tidak">
                <label class="form-check-label" for="t_047_tidak">Monitor BUN, Kreatini, Haematokrit, elektrolit.</label>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="t_048" id="t_048_syok">
                    <label class="form-check-label" for="t_048_syok">Timbang BB sebelum dan sesudah prosedur.</label>
                </div>
            </div>

            <div class="mb-1">Manajemen Perfusi Jaringan</div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_049" id="t_049_glukosa">
                <label class="form-check-label" for="t_049_glukosa">Monitor observasi sensasi terhadap rangsang : panas/dingin/tajam/tumpul</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_050" id="t_050_efektif">
                <label class="form-check-label" for="t_050_efektif">Monitor adanya parese</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_051" id="t_051_efektif">
                <label class="form-check-label" for="t_051_efektif">Monitor adanya plebitis</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_052" id="t_052_tidak">
                <label class="form-check-label" for="t_052_tidak">Kaji tingkat orientasi pasien terhadap waktu, tempat dan orang.</label>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="t_053" id="t_053_syok">
                    <label class="form-check-label" for="t_053_syok">Kaji adanya hyperlipidemia, hipertensi.</label>
                </div>
            </div>

            <div class="mb-1">Manajemen Hipoglikemia</div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_054" id="t_054_glukosa">
                <label class="form-check-label" for="t_054_glukosa">Kenali tanda-tanda hipoglikemia</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_055" id="t_055_efektif">
                <label class="form-check-label" for="t_055_efektif">Kaji penyebab hipoglikemia</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_056" id="t_056_tidak">
                <label class="form-check-label" for="t_056_tidak">Monitor gula darah</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_057" id="t_057_efektif">
                <label class="form-check-label" for="t_057_efektif">Monitor tanda-tanda hipoglikemia</label>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="t_058" id="t_058_syok">
                    <label class="form-check-label" for="t_058_syok">Kolaborasi dokter adanya tanda-tanda hipoglikemia</label>
                </div>
            </div>

            <div class="mb-1">Manajemen Hiperglikemia</div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_059" id="t_059_glukosa">
                <label class="form-check-label" for="t_059_glukosa">Kenali tanda – tanda hiperglikemia</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_060" id="t_060_efektif">
                <label class="form-check-label" for="t_060_efektif">Kaji penyebab hiperglikemia</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_061" id="t_061_efektif">
                <label class="form-check-label" for="t_061_efektif">Monitor gula darah</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_062" id="t_062_efektif">
                <label class="form-check-label" for="t_062_efektif">Monitor tanda – tanda hiperglikemi</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_063" id="t_063_tidak">
                <label class="form-check-label" for="t_063_tidak">Kolaborasi dokter adanya tanda gejala hiperglikemi</label>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="t_064" id="t_064_syok">
                    <label class="form-check-label" for="t_064_syok">Berikan insulin sesuai instruksi dokter</label>
                </div>
            </div>

            <div class="mb-3"><b>Kaji Kadar Hemoglobin</b> </div>

            <div class="mb-1"><b>Pendidikan Kesehatan</b></div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_065" id="t_065_glukosa">
                <label class="form-check-label" for="t_065_glukosa">Ajarkan keluarga untuk memantau gula darah secara mandiri bila memungkinkan.</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_066" id="t_066_efektif">
                <label class="form-check-label" for="t_066_efektif">Berikan bantuan dalam mencegah dan mengatasi hipoglikemia/hiperglikemia.</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_067" id="t_067_efektif">
                <label class="form-check-label" for="t_067_efektif">Beri instruksi pasien/orang terdekat dalam pencegahan dan pengenalan hipoglikemi/ hiperglekemi.</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_068" id="t_068_efektif">
                <label class="form-check-label" for="t_068_efektif">Beri kemudahan untuk mentaati diit dan pengaturan exercise.</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_069" id="t_069_tidak">
                <label class="form-check-label" for="t_069_tidak">Anjuran gaya hidup sehat: tidak merokok, olah raga rutin.</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="t_070" id="t_070_tidak">
                <label class="form-check-label" for="t_070_tidak">Ajarkan keluarga mengenali tanda dan gejala anemia.</label>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="t_071" id="t_071_syok">
                    <label class="form-check-label" for="t_071_syok">Ajarkan latihan dan aktivitas yang diperbolehkan dan yang tidak diperbolehkan.</label>
                </div>
            </div>

        </td>
        <td>
            <div class="mb-1" style="text-align: center;">
                <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                <input type="hidden" name="TTD" id="TTD">
                <br><input type="text" name="v_20" id="v_20" style="width: 130px" placeholder="Nama">
            </div>
        </td>
        </tr>

        </tbody>
        </table>


        <table class="table table-bordered mt-3" style="border: 1px solid black;">
            <tbody>
                <tr>
                    <td colspan="2"> RENTANG NILAI NORMAL</td>
                </tr>

                <tr>
                    <td>Tekanan Darah</td>
                    <td>Dewasa : Sistole 110 – 130 mmHg, Diastole : 70 – 90 mmHg</td>
                </tr>

                <tr>
                    <td></td>
                    <td>Anak : Sistole 90 – 120 mmHg, Diastole : 50 – 70 mmHg</td>
                </tr>

                <tr>
                    <td>Haemoglobin</td>
                    <td>Laki-laki : 13,2 – 17,3 gr %, Perempuan 11,7 – 15,5 gr% </td>
                </tr>

                <tr>
                    <td>Kadar lemak</td>
                    <td>Kolesterol : 0,0 – 200mg/dl, HDL : > 40mg/dl, LDL : 20,0 – 164,0 mg/dl</td>
                </tr>

                <tr>
                    <td>Gula darah</td>
                    <td>70 – 140 mg/dl</td>
                </tr>

                <tr>
                    <td></td>
                    <td>Hipoglikemi : < 60mg/dl Hiperglikemia : GDS> 200mg/dl. GDP : > 126 mg/dl</td>
                </tr>

                <tr>
                    <td></td>
                    <td>GD 2 j PP : > 200 mg/dl. HBA1c : > 8 %</td>
                </tr>

                <tr>
                    <td>CVP</td>
                    <td>8-12 Cm H2O, 6-12 mmHg</td>
                </tr>

                <tr>
                    <td>AGD</td>
                    <td>Ph : 7,35 – 7,45 PCO2 : 35 – 48 PO2 : 80 – 108</td>
                </tr>

                <tr>
                    <td>Natrium</td>
                    <td>136 – 145</td>
                </tr>

                <tr>
                    <td>Kalium</td>
                    <td>3,5 – 5,1</td>
                </tr>

                <tr>
                    <td>HCO3</td>
                    <td>21 – 26</td>
                </tr>

                <tr>
                    <td>Ureum</td>
                    <td>13,0 – 43 mg/dl</td>
                </tr>

                <tr>
                    <td>Kreatinin </td>
                    <td>0,9 – 1,3 mg/dl</td>
                </tr>

                <tr>
                    <td>Magnesium </td>
                    <td>1,09 – 2,5 mg/dl</td>
                </tr>

                <tr>
                    <td>Kalsium </td>
                    <td>8,3 – 10,6 mg/dl</td>
                </tr>

                <tr>
                    <td>Clorida </td>
                    <td>98 – 107 mg/dl</td>
                </tr>

            </tbody>
        </table>


        </div>
    </form>
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

        function saveSignatureData() {
            const canvasData = canvas.toDataURL('image/png');

            canvasDataInput.value = canvasData;
        }
    </script>
</body>

</html>