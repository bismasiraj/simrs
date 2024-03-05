<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>2.1.12 ASESMEN KEBUTUHAN EDUKASI</title>
</head>

<body>
    <form>
        <div class="container mt-3">


            <br>
            <h3 style="text-align: right;"><b>RM 2.1.12</b></h3>


            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            <img src="<?= base_url('assets/img/logo.png') ?>" alt="logo" width="100px">
                            <div>
                                <label>Sehat-Amanah <br>Tanggungjawab-Islami</label>
                            </div>
                        </td>
                        <td>
                            <h3><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h3>
                            <h5><b>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta<br>Telp 0271-633894 Fax. : 0271-630229 <br>Jawa Tengah 57117</b></h5>
                        </td>
                        <td>
                            <div class="container" style="height: 150px; border: 1px solid black; border-radius: 3px">
                                <h5 style="text-align: center; margin-top: 60px">Label Identitas Pasien</h5>

                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align: center;">
                            <h5><b>ASESMEN KEBUTUHAN EDUKASI</b></h5>
                        </td>
                    </tr>

                </tbody>
            </table>



            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>


                    <tr>
                        <td>Kemampuan membaca</td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_01" id="t_01_baik" value="0">
                                <label class="form-check-label" for="t_01_baik">Baik </label>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_01" id="t_01_kurang" value="0">
                                <label class="form-check-label" for="t_01_kurang">Kurang </label>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>Tingkat pendidikan</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_02" id="t_02_sd" value="0">
                                <label class="form-check-label" for="t_02_sd">SD </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_02" id="t_02_smp" value="0">
                                <label class="form-check-label" for="t_02_smp">SMP </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_02" id="t_02_diploma" value="0">
                                <label class="form-check-label" for="t_02_diploma">Diploma </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_02" id="t_02_sarjana" value="0">
                                <label class="form-check-label" for="t_02_sarjana">Sarjana </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_02" id="t_02_lainnya" value="0">
                                <label class="form-check-label" for="t_02_lainnya">Lainnya </label>
                                <input type="text" name="v_01" id="v_01" style="width: 100px">
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>Kemampuan berbahasa</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_03" id="t_03_indo" value="0">
                                <label class="form-check-label" for="t_03_indo">Indonesia</label>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_03" id="t_03_asing" value="0">
                                <label class="form-check-label" for="t_03_asing">Asing </label>
                                <input type="text" name="v_02" id="v_02" style="width: 100px">
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_03" id="t_03_daerah" value="0">
                                <label class="form-check-label" for="t_03_daerah">Daerah </label>
                                <input type="text" name="v_03" id="v_03" style="width: 100px">
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>Kebutuhan penerjemah</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_04" id="t_04_ya" value="0">
                                <label class="form-check-label" for="t_04_ya">Ya</label>
                            </div>
                        </td>
                        <td colspan="4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_04" id="t_04_tidak" value="0">
                                <label class="form-check-label" for="t_04_tidak">Tidak</label>
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>Hambatan emosional</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_05" id="t_05_tidak" value="0">
                                <label class="form-check-label" for="t_05_tidak">Tidak Ada</label>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_05" id="t_05_labil" value="0">
                                <label class="form-check-label" for="t_05_labil">Labil</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_05" id="t_05_depresi" value="0">
                                <label class="form-check-label" for="t_05_depresi">Depresi</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_05" id="t_05_agresif" value="0">
                                <label class="form-check-label" for="t_05_agresif">Agresif</label>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>Motivasi</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_06" id="t_06_lemah" value="0">
                                <label class="form-check-label" for="t_06_lemah">Lemah</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_06" id="t_06_cukup" value="0">
                                <label class="form-check-label" for="t_06_cukup">Cukup</label>
                            </div>
                        </td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_06" id="t_06_kuat" value="0">
                                <label class="form-check-label" for="t_06_kuat">Kuat</label>
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>Keterbatasan Fisik dan kognitif</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_07" id="t_07_tidak" value="0">
                                <label class="form-check-label" for="t_07_tidak">Tidak Ada</label>
                            </div>
                        </td>
                        <td colspan="4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_07" id="t_07_ada" value="0">
                                <label class="form-check-label" for="t_07_ada">Ada</label>
                            </div>
                            <div class="mb-1 form-check">
                                <input type="checkbox" class="form-check-input" name="t_011" id="t_011_fisik">
                                <label class="form-check-label" for="t_011_fisik">Fisik lemah</label>
                            </div>
                            <div class="mb-1 form-check">
                                <input type="checkbox" class="form-check-input" name="t_012" id="t_012_penglihatan">
                                <label class="form-check-label" for="t_012_penglihatan">Penglihatan terganggu</label>
                            </div>
                            <div class="mb-1 form-check">
                                <input type="checkbox" class="form-check-input" name="t_013" id="t_013_gangguan">
                                <label class="form-check-label" for="t_013_gangguan">Gangguan bicara</label>
                            </div>
                            <div class="mb-1 form-check">
                                <input type="checkbox" class="form-check-input" name="t_014" id="t_014_pendengaran">
                                <label class="form-check-label" for="t_014_pendengaran">Gangguan pendengaran</label>
                            </div>
                            <div class="mb-1 form-check">
                                <input type="checkbox" class="form-check-input" name="t_015" id="t_015_kognitif">
                                <label class="form-check-label" for="t_015_kognitif">Kognitif terbatas</label>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>Kesediaan menerima Edukasi</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_08" id="t_08_bersedia" value="0">
                                <label class="form-check-label" for="t_08_bersedia">Bersedia</label>
                            </div>
                        </td>
                        <td colspan="4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_08" id="t_08_tidak" value="0">
                                <label class="form-check-label" for="t_08_tidak">Tidak Bersedia</label>
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>Cara Edukasi</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_09" id="t_09_diskusi" value="0">
                                <label class="form-check-label" for="t_09_diskusi">Diskusi</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_09" id="t_09_demon" value="0">
                                <label class="form-check-label" for="t_09_demon">Demonstrasi/peragaan</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_09" id="t_09_ceramah" value="0">
                                <label class="form-check-label" for="t_09_ceramah">Ceramah</label>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_09" id="t_09_lainnya" value="0">
                                <label class="form-check-label" for="t_09_lainnya">Lainnya </label>
                                <input type="text" name="v_04" id="v_04" style="width: 150px">
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>Rencana kebutuhan edukasi</td>
                        <td colspan="5">
                            <label>Penggunaan obat secara efektif dan aman</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_010" id="t_010_potensi">
                                <label class="form-check-label" for="t_010_potensi">Potensi efek samping obat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_010" id="t_010_interaksi">
                                <label class="form-check-label" for="t_010_interaksi">Potensi interaksi obat antar obat, suplemen dan makanan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_010" id="t_010_asesmen">
                                <label class="form-check-label" for="t_010_asesmen">Asesmen nyeri dan managemen nyeri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_010" id="t_010_tehnik">
                                <label class="form-check-label" for="t_010_tehnik">Tehnik rehabilitasi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_010" id="t_010_cuci">
                                <label class="form-check-label" for="t_010_cuci">Cuci tangan yang benar</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_010" id="t_010_pencegahan">
                                <label class="form-check-label" for="t_010_pencegahan">Pencegahan risiko jatuh</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_010" id="t_010_etika">
                                <label class="form-check-label" for="t_010_etika">Etika batuk</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_010" id="t_010_edukasi">
                                <label class="form-check-label" for="t_010_edukasi">Edukasi lindungi anak</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_010" id="t_010_nifas">
                                <label class="form-check-label" for="t_010_nifas">Tanda bahaya pada nifas</label>
                            </div>

                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">Lain-lain</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_05" name="v_05" style="width: 500px">
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>

                </tbody>
            </table>



            <br>
            <h7><b>Beri tanda (√) pada kotak () sesuai pilihan <br>Beri tanda (-) untuk isian yang tidak ada keluhan</b></h7>








        </div>
    </form>

</body>

</html>