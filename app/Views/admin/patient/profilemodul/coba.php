<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
    table.table-fit {
        width: auto !important;
        table-layout: auto !important;
    }

    table.table-fit thead th,
    table.table-fit tfoot th {
        width: auto !important;
    }

    table.table-fit tbody td,
    table.table-fit tfoot td {
        width: auto !important;
    }
</style>
<div class="tab-pane" id="coba" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12">
            <page size="A4">
                <div class="container mt-3">

                    <h3 style="text-align: right;">RM 08 Lanjutan</h3>
                    <table class="table table-bordered" style="border: 2px solid black;">
                        <tbody>
                            <tr>
                                <td style="width: 10%">
                                    <img src="logo.jpg" alt="logo" width="150px" height="200px">
                                </td>
                                <td style="width: 40%; text-align: center; vertical-align: middle;">
                                    <h6>RSUD Dr. YUNUS BENGKULU</h6>
                                    <p>Jln. Bhayangkara Bengkulu 38229
                                        Telp. (0736) 52004 – 53006</p>


                                </td>
                                <td style="width: 50%;" rowspan="2">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="">Nama</label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="text" id="v_01" name="v_01" style="width: 150px;" required autofocus>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div>
                                            <label for="">Jenis Kelamin</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="t_01" value="option1">
                                                <label class="form-check-label" for="t_01">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="t_02" value="option2">
                                                <label class="form-check-label" for="t_02">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="">Tanggal Lahir</label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="date" id="v_04" name="v_04" required>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="">Register</label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="text" id="v_01" name="v_01" style="width: 150px;" required autofocus>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <label for="waktu">(STIKER PASIEN)</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="text-center">
                                        <label for="waktu"><b>PENUNDAAN/PEMBATALAN TINDAKAN OPERASI</b></label>
                                    </div>
                                </td>
                            </tr>
                            <tr style="border: 2px solid black;">
                                <td colspan="3">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for=""><b>Hari/Tanggal/Jam</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="date" id="v_01" name="v_01" required autofocus>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for=""><b>Asal Ruang Rawat</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="text" id="v_01" name="v_01" style="width: 400px;" required autofocus>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr style="border: 2px solid black;">
                                <td colspan="3">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for=""><b>Diangnosa Pre Operasi</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="text" id="v_01" name="v_01" style="width: 400px;" required autofocus>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for=""><b>Rencana Tindakan Operasi</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="text" id="v_01" name="v_01" style="width: 400px;" required autofocus>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for=""><b>Rencana Tindakan Anestesi</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="text" id="v_01" name="v_01" style="width: 400px;" required autofocus>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for=""><b>Dokter Bedah</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="text" id="v_01" name="v_01" style="width: 400px;" required autofocus>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for=""><b>Dokter Anestesi</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="text" id="v_01" name="v_01" style="width: 400px;" required autofocus>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr style="border: 2px solid black;">
                                <td colspan="3">
                                    <div class="mb-3">
                                        <label for="alasan" type="text" class="text-center" id="v_11" name="v_11"><b>Penyebab/Alasan Penundaan</b></label>
                                    </div>
                                    <div class="mb-1">
                                        <label for="alasan" type="text" id="v_12" name="v_12"><b>1. Pasien</b></label>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_03">
                                                <label class="form-check-label" name="t_03">Menstruasi</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="perempuan" type="checkbox" class="form-check-input" id="t_04">
                                                <label class="form-check-label" name="t_04">Demam/Panas</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_05">
                                                <label class="form-check-label" name="t_05">Batuk/Pilek</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="perempuan" type="checkbox" class="form-check-input" id="t_06">
                                                <label class="form-check-label" name="t_06">HB<10 Gram %</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_07">
                                                <label class="form-check-label" name="t_07">Tekanan Darah Tinggi</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="perempuan" type="checkbox" class="form-check-input" id="t_08">
                                                <label class="form-check-label" name="t_08">Kelainan Kardiologi</label>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_09">
                                                <label class="form-check-label" name="t_09">Menolak di Operasi</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="perempuan" type="checkbox" class="form-check-input" id="t_10">
                                                <label class="form-check-label" name="t_10">Belum Masuk Ruang Perawatan</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_11">
                                                <label class="form-check-label" name="t_11">Tidak Terdaftar Dalam Acara</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="perempuan" type="checkbox" class="form-check-input" id="t_12">
                                                <label class="form-check-label" name="t_12">Salah Mengajukan Rencana</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_13">
                                                <label class="form-check-label" name="t_13">Tidak Datang</label>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input for="perempuan" type="checkbox" class="form-check-input" id="t_14">
                                                <label class="form-check-label" name="t_14">Lain-lain :</label>
                                                <input type="text" name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <label for="alasan" type="text" id="v_13" name="v_13"><b>2. Dokter Bedah/Operator</b></label>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_15">
                                                <label class="form-check-label" name="t_15">Terlambat Datang</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_16">
                                                <label class="form-check-label" name="t_16">Sakit</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_17">
                                                <label class="form-check-label" name="t_17">Dinas Luar</label>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_18">
                                                <label class="form-check-label" name="t_18">Lain-Lain : </label>
                                                <input type="text" name="">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-1">
                                        <label for="alasan" type="text" id="v_14" name="v_14"><b>3. Ruang Rawat</b></label>
                                    </div>
                                    <div class="mb-1 form-check">
                                        <input for="laki" type="checkbox" class="form-check-input" id="t_19">
                                        <label class="form-check-label" name="t_19">Surat Izin Tindakan Operasi/Anestesi tidak ada</label>
                                    </div>
                                    <div class="mb-1 form-check">
                                        <input for="laki" type="checkbox" class="form-check-input" id="t_20">
                                        <label class="form-check-label" name="t_20">Persiapan Operasi belum Lengkap, Belum/Tidak Ada :</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id=21>
                                                <label class="form-check-label" name="t_21">Hasil Pemeriksaan Laboraturium</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_22">
                                                <label class="form-check-label" name="t_22">Hasil Pemeriksaan Radiologi</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_23">
                                                <label class="form-check-label" name="t_23">Hasil Pemeriksaan/Konsultasi Penyakit Dalam</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_24">
                                                <label class="form-check-label" name="t_24">Persiapan Darah</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_25">
                                                <label class="form-check-label" name="t_25">Puasa</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_26">
                                                <label class="form-check-label" name="t_26">Cukur</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_27">
                                                <label class="form-check-label" name="t_27">Huknah/Lavement</label>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_28">
                                                <label class="form-check-label" name="t_28">Lain-lain : </label>
                                                <input type="text" name="">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-1">
                                        <label for="alasan" type="text" id="v_15" name="v_15"><b>4. Fasilitas/Peralatan Kamar Operasi</b></label>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_29">
                                                <label class="form-check-label" name="t_29">Linen/Pakaian Operasi Habis</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_30">
                                                <label class="form-check-label" name="t_30">BHP/BMHP Habis/Kosong</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_31">
                                                <label class="form-check-label" name="t_31">Oksigen/Gas Media Lainnya Habis/Kosong</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_32">
                                                <label class="form-check-label" name="t_32">Peralatan media RUsak/Perbaikan</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_33">
                                                <label class="form-check-label" name="t_33">AC/Listrik Mati</label>
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_34">
                                                <label class="form-check-label" name="t_34">Air Mati</label>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input for="laki" type="checkbox" class="form-check-input" id="t_35">
                                                <label class="form-check-label" name="t_35">Lain-lain : </label>
                                                <input type="text" name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for=""><b>5. Penyebab/Alasan Lainnya : </b></label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="text" id="v_01" name="v_01" style="width: 400px;" required autofocus>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for=""><b>Rencana Tindakan Operasi</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            :<input type="text" id="v_01" name="v_01" style="width: 400px;" required autofocus>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="text-align: right;">
                        <div class="mb-1">
                            <label for="diagnosa">Bengkulu, </label>
                            <input type="date">
                        </div>
                        <div class="mb-3">
                            <label for="alasan" type="text">Penanggung Jawab Kamar Operasi</label>
                        </div>
                        <div class="mb-1">
                            <div id="sig"></div>
                            <br><label for="ruang">NIP.</label>
                            <input type="text">
                        </div>
                    </div>

                </div>
            </page>
        </div>
    </div><!--./row-->

</div>
<!-- -->