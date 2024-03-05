<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RM 3.2.6 dx perawat - diagnosa resiko infeksi</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RM 3.2.6</b></h5>

            <br><br>
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
            <h5 style="text-align: center;"><b>DIAGNOSA RESIKO INFEKSI</b></h5>

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
                            <div class="mb-1"><b>Risiko Infeksi</b><br>berhubungan dengan :</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_01">
                                <label class="form-check-label" for="t_01">Penyakit kronis. Pertahanan tubuh primer tidak adekuat.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_02">
                                <label class="form-check-label" for="t_02">Tindakan invansif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_03">
                                <label class="form-check-label" for="t_03">Proseur pembedahan.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_04">
                                <label class="form-check-label" for="t_04">Ketuban pecah dini</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_05">
                                <label class="form-check-label" for="t_05">Trauma jaringan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_06">
                                <label class="form-check-label" for="t_06">Pertahanan tubuh sekunder</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_07">
                                <label class="form-check-label" for="t_07"> Penuran hemoglobin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_08">
                                <label class="form-check-label" for="t_08">Penyakit immunosupresi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_09">
                                <label class="form-check-label" for="t_09">Vaksinasi tidak adekat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_010">
                                <label class="form-check-label" for="t_010">Wabah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_011">
                                <label class="form-check-label" for="t_011"> Prosedur invasive</label>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_012">
                                    <label class="form-check-label" for="t_012">Ketidakadekuatan sistem kekebalan tubuh</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1">Kulit utuh / tidak ada kerusakan setelah dilakukan<br>tindakan keperawatan selama <input type="text" id="v_06" name="v_06" style="width: 50px"> 24 jam.</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_013">
                                <label class="form-check-label" for="t_013">Tidak ada luka</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_014">
                                <label class="form-check-label" for="t_014">Perfusi jaringan baik</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_015">
                                <label class="form-check-label" for="t_015">Kulit lembab</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_016">
                                <label class="form-check-label" for="t_016">Kulit teraba hangat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_017">
                                <label class="form-check-label" for="t_017"> Tidak ada warna merah pada kulit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_018">
                                <label class="form-check-label" for="t_018">Integritas kulit yang baik bisa ipertahankan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_019">
                                <label class="form-check-label" for="t_019">Tidak ada luka/lesi pada kulit</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_020">
                                    <label class="form-check-label" for="t_020">Perfusi jaringan baik</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1"><b>Therapi Aktifitas</b></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_021" id="t_021_efektif">
                                <label class="form-check-label" for="t_021_efektif">Bersihkan ruangan setelah dipakai pasien</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_022" id="t_022_efektif">
                                <label class="form-check-label" for="t_022_efektif">Kaji adanya tanda – randa infeksi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_023" id="t_023_tidak">
                                <label class="form-check-label" for="t_023_tidak">Pertahankan teknik isolasi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_024" id="t_024_tidak">
                                <label class="form-check-label" for="t_024_tidak">Batasi pengunjung bila perlu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_025" id="t_025_efektif">
                                <label class="form-check-label" for="t_025_efektif">Intruksikan pada pengunjung untuk menuci tangan saat berkunjung dan selah meninggalkan pasien</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_026" id="t_026_efektif">
                                <label class="form-check-label" for="t_026_efektif">Gunakan sabun antimikroba untuk cuci tangan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_027" id="t_027_tidak">
                                <label class="form-check-label" for="t_027_tidak">Cuci tangan setiap sebelum dan sesudah tindakan keperawatan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_028" id="t_028_tidak">
                                <label class="form-check-label" for="t_028_tidak">Gunakan baju, sarung tangan sebagai alat pelindung sesuai kebutuhan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_029" id="t_029_efektif">
                                <label class="form-check-label" for="t_029_efektif">Pertahankan lingkungan aseptic selama pemasangan alat.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_030" id="t_030_efektif">
                                <label class="form-check-label" for="t_030_efektif">Ganti letak IV perifer dan line central sesuai petunjuk umum</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_031" id="t_031_tidak">
                                <label class="form-check-label" for="t_031_tidak">Lakukan teknik aseptic saat melakukan tindakan invasif.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_032" id="t_032_tidak">
                                <label class="form-check-label" for="t_032_tidak">Tingkatkan intake nutrisi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_033" id="t_033_tidak">
                                <label class="form-check-label" for="t_033_tidak">Kolaborasi bila perlu</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="t_034" id="t_034_syok">
                                    <label class="form-check-label" for="t_034_syok">Laporkan hasil kultur</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1" style="text-align: center;">
                                <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD">
                                <br><input type="text" name="v_07" id="v_07" style="width: 130px" placeholder="Nama">
                            </div>
                        </td>
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