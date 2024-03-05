<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RM 5CP2a ORIENTASI PELAYANAN FASILITAS PELAYANAN RANAP</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RM 5 CP2a</b></h5>

            <br>
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
                            <br>
                            <h3><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h3>
                            <h5>Semanggi RT 002 / RW 020 Pasar Kliwon<br>Telp 0271-633894 Fax. : 0271-630229 Surakarta</h5>
                        </td>
                        <td>
                            <div class="container" style="height: 150px; border: 1px solid black; border-radius: 3px">
                                <h5 style="text-align: center; margin-top: 60px">Label Identitas Pasien</h5>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>

                    <tr>
                        <td rowspan="2"><br><b>ORIENTASI PELAYANA DAN <br>FASILITAS PASIEN RAWAT INAP</b></td>
                        <td>
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <label>NAMA :</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="v_01" id="v_01" style="width: 150px" autocomplete="off">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <label>NO RM :</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="v_02" id="v_02" style="width: 150px" autocomplete="off">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <label>TGL LAHIR :</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="date" name="v_03" id="v_03" style="width: 150px" autocomplete="off">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <label>BANGSAL :</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="v_04" id="v_04" style="width: 150px" autocomplete="off">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <label><b>Tanggal Pengkajian</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="date" name="v_05" id="v_05" style="width: 130px" autocomplete="off">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <label>JAM :</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="time" name="v_06" id="v_06" style="width: 150px" autocomplete="off">
                                </div>
                            </div>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align: center;"><b>DIISI OLEH PERAWAT</b></td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <p>ORIENTASI PELAYANAN DAN FASILITAS KEPADA PASIEN</p>
                            <div class="mb-4">
                                <label class="col-2" for="">Disampaikan kepada</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_01" id="t_01_cm" value="0">
                                    <label class="form-check-label" for="t_01_cm">Pasien</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_01" id="t_01_apatis" value="1">
                                    <label class="form-check-label" for="t_01_apatis">Saudara</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_01" id="t_01_sopor" value="1">
                                    <label class="form-check-label" for="t_01_sopor">Lainnya</label>
                                    <input type="text" id="v_07" name="v_07" style="width: 120px">
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_01" id="t_01_coma" value="1">
                                    <label class="form-check-label" for="t_01_coma">Tidak dapat dilakukan karena :</label>
                                    <input type="text" id="v_08" name="v_08" style="width: 120px">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="col-2" for="">1. Petugas ruangan</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_02" id="t_02_cm" value="0">
                                    <label class="form-check-label" for="t_02_cm">Memperkenalkan kepada PP, PPJP Dan petugas lainnya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_02" id="t_02_apatis" value="1">
                                    <label class="form-check-label" for="t_02_apatis">Memperkenalkan kepada pasien sekamar atau sesama</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="col-12" for="">2. Faslitas fisik lokasi ruangan dan tempat tidur</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_03" id="t_03_cm" value="0">
                                            <label class="form-check-label" for="t_03_cm">Kamar mandi dan toilet</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_03" id="t_03_apatis" value="1">
                                            <label class="form-check-label" for="t_03_apatis"> Nurse station</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_03" id="t_03_sopor" value="1">
                                            <label class="form-check-label" for="t_03_sopor"> Ruang publik</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_03" id="t_03_call" value="0">
                                            <label class="form-check-label" for="t_03_call"> Sistem Nurse Call</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_03" id="t_03_tv" value="1">
                                            <label class="form-check-label" for="t_03_tv"> Penggunaan TV</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_03" id="t_03_telp" value="1">
                                            <label class="form-check-label" for="t_03_telp"> Penggunaan telepon</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_03" id="t_03_coma" value="1">
                                            <label class="form-check-label" for="t_03_coma">Kegunaan monitor bedside / ventilator / syringe pump yang digunakan pasien</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="col-12" for="">3. Tata laksana pelayanan Rumah Sakit</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_cm" value="0">
                                            <label class="form-check-label" for="t_04_cm">Aktifitas harian pelayanan di ruangan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_apatis" value="1">
                                            <label class="form-check-label" for="t_04_apatis">Barang kebutuhan pribadi dan perlengkapan mandi</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_kamar" value="1">
                                            <label class="form-check-label" for="t_04_kamar">Nomor telepon ruangan / kamar</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_dokter" value="1">
                                            <label class="form-check-label" for="t_04_dokter">Prosedur visite dokter</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_sopor" value="1">
                                            <label class="form-check-label" for="t_04_sopor">Pengunjung dan jam berkunjung</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_saat" value="1">
                                            <label class="form-check-label" for="t_04_saat">Tidak mengalihkan perhatian perawat saat perawat sedang memberikan obat</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_pakaian" value="0">
                                            <label class="form-check-label" for="t_04_pakaian">Pemakaian pakaian pribadi pasien</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_inap" value="1">
                                            <label class="form-check-label" for="t_04_inap">Prosedur pasien masuk rawat inap dan deposit pembayaran</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_tindakan" value="1">
                                            <label class="form-check-label" for="t_04_tindakan">Prosedur khusus pra dan post tindakan / operasi ( untuk pasien dengan rencana tindakan / operasi</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_makanan" value="1">
                                            <label class="form-check-label" for="t_04_makanan">Pelayanan makanan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_hak" value="1">
                                            <label class="form-check-label" for="t_04_hak">Brosur Hak Pasien diberikan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_infeksi" value="1">
                                            <label class="form-check-label" for="t_04_infeksi">Pencegahan infeksi : cuci tangan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="col-12" for="">4. Keselamatan</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_05" id="t_05_cm" value="0">
                                            <label class="form-check-label" for="t_05_cm">Peringantan tentang orang yang berbahaya ( Penipu )</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_05" id="t_05_apatis" value="1">
                                            <label class="form-check-label" for="t_05_apatis">Bahaya kebakaran – dilarang merokok di area Rumah Sakit</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_05" id="t_05_sopor" value="1">
                                            <label class="form-check-label" for="t_05_sopor">Lokasi pintu darurat kebakaran</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_05" id="t_05_gelang" value="0">
                                            <label class="form-check-label" for="t_05_gelang">Penggunaan gelang identitas pasien</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_05" id="t_05_jatuh" value="1">
                                            <label class="form-check-label" for="t_05_jatuh">Pencegahan jatuh</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_05" id="t_05_ijin" value="1">
                                            <label class="form-check-label" for="t_05_ijin">Ijin bila akan meninggalkan ruang rawat. Jika tidak ijin kepada petugas, maka resiko selama meninggalkan ruangan ada pada pasien</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div>5. Barang milik pasien</div>
                                <label class="col-2" for="">a. Gigi Palsu</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_06" id="t_06_cm" value="0">
                                    <label class="form-check-label" for="t_06_cm">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_06" id="t_06_apatis" value="1">
                                    <label class="form-check-label" for="t_06_apatis">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_06" id="t_06_atas" value="0">
                                    <label class="form-check-label" for="t_06_atas">Atas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_06" id="t_06_bawah" value="1">
                                    <label class="form-check-label" for="t_06_bawah">Bawah</label>
                                    , Dibawa oleh :<input type="text" id="v_09" name="v_09" autocomplete="off">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-2" for="">b. Alat bantu dengar</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_07" id="t_07_cm" value="0">
                                    <label class="form-check-label" for="t_07_cm">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_07" id="t_07_apatis" value="1">
                                    <label class="form-check-label" for="t_07_apatis">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_07" id="t_07_kanan" value="0">
                                    <label class="form-check-label" for="t_07_kanan">Kanan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_07" id="t_07_kiri" value="1">
                                    <label class="form-check-label" for="t_07_kiri">Kiri</label>
                                    , Dibawa oleh :<input type="text" id="v_10" name="v_10" autocomplete="off">
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="col-2" for="">c. Uang tunai </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_08" id="t_08_cm" value="0">
                                    <label class="form-check-label" for="t_08_cm">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_08" id="t_08_apatis" value="1">
                                    <label class="form-check-label" for="t_08_apatis">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_08" id="t_08_simpan" value="0">
                                    <label class="form-check-label" for="t_08_simpan">Disimpan di</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_08" id="t_08_kasir" value="1">
                                    <label class="form-check-label" for="t_08_kasir">Kasir</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_08" id="t_08_pasien" value="1">
                                    <label class="form-check-label" for="t_08_pasien">Dibawa pasien/keluarga</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>d. Lainnya, sebutkan : </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_11" id="v_11" style="width: 800px" autocomplete="off">
                                    </div>
                                </div>
                            </div>


                            <div class="mb-2">
                                <p>Saya <input type="text" id="v_12" name="v_12"> ( Nama) sebagai <input type="text" id="v_13" name="v_13"> (Sebutkan jabatan) apabila saya dan pasien memilih untuk menyimpan benda/uang dalam penyimpanan saya atau pasien*) maka saya atau pasien tidak akan melimpahkan tanggungjawab kepada RS PKU Muahammadiyah Sampangan apabila terjadi kerusakan atau kehilangan benda/uang tersebut <br>Orientasi dan pernyataaan : <br> Diketahui oleh pasien / keluarga,</p>
                            </div>

                            <div class="mb-5">
                                Nama : <input type="text" id="v_14" name="v_14"> Hubungan <input type="text" id="v_15" name="v_15">
                                Tanda tangan <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD"> Tanggal dan jam <input type="datetime-local" id="v_16" name="v_16">
                            </div>

                            <div>Disaksikan oleh :</div>

                            <div>
                                Nama : <input type="text" id="v_17" name="v_17"> Hubungan <input type="text" id="v_18" name="v_18">
                                Tanda tangan <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD_1" id="TTD_1"> Tanggal dan jam <input type="datetime-local" id="v_19" name="v_19">
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

        function saveSignatureData1() {
            const canvasData1 = canvas1.toDataURL('image/png');

            canvasDataInput1.value = canvasData1;
        }
    </script>
</body>

</html>