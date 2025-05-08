<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Sep</title>
    <link rel="stylesheet" media='screen,print' href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">

    <style>
        p {
            font-size: 10px;
        }

        .signature-line {
            width: 50%;
            /* Sesuaikan panjang garis sesuai kebutuhan */
            border-bottom: 1px solid black;
            /* Warna dan gaya garis dapat disesuaikan */
            margin: 8px auto;
            /* Sesuaikan margin atas/bawah dan auto untuk posisi tengah */
        }

        span {
            text-align: center;
        }
    </style>

</head>

<body>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-6">
                <div>
                    <img src="<?= base_url() ?>assets/img/bpjs.jpeg" alt="BPJS KESEHATAN" style="width: 230px;">
                </div>
                <form action="" method="">
                    <div class="form-group row mt-2 align-items-center">
                        <label for="no_sep" class="col-sm-4 col-form-label">No. SEP</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7">
                            <span><?php echo $json['no_skp']; ?></span>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tgl_sep" class="col-sm-4 col-form-label">Tgl. SEP</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-4">
                            <span><?php echo $json['visit_date']; ?></span>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="no_kartu" class="col-sm-4 col-form-label">No. Kartu</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7">
                            <span><?php echo $json['kk_no']; ?></span>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="nama_peserta" class="col-sm-4 col-form-label">Nama Peserta</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7">
                            <span><?php echo $json['name_of_pasien']; ?></span>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-4">
                            <span><?php echo $json['date_of_birth']; ?></span>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-4">
                            <?php if ($json['gender'] == 1) { ?>
                                <span>L</span>
                            <?php } else { ?>
                                <span>P</span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="poli_tujuan" class="col-sm-4 col-form-label">Poli Tujuan</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7">
                            <span><?php echo $json['clinic_id']; ?></span>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="asal_faskes" class="col-sm-4 col-form-label">Asal Faskes</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7">
                            <span>RSUD DR M YUNUS - KOTA BENGKULU</span>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="diagnosa_awal" class="col-sm-4 col-form-label">Diagnosa Awal</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7">
                            <span><?php echo $json['diag_awal']; ?>-<?php echo $json['conclusion']; ?></span>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="catatan" class="col-sm-4 col-form-label">Catatan</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7">
                            <span><?php echo $json['description']; ?></span>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col">
                        <p>*Saya menyetujui BPJS Kesehatan mengunakan informasi medis pasien jika diperlukan
                            <br>*SEP bukan sebagai bukti penjaminan peserta
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="row">
                    <h6 class="text-center"><b>SURAT ELIGIBILITAS PESERTA <br> RSUD DR M.YUNUS</b></h6>
                </div>
                <form action="" method="">
                    <div class="form-group row mt-2">
                        <label for="peserta" class="col-sm-4 col-form-label">Peserta</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7 align-items-center">
                            <span>Anak</span>
                        </div>
                    </div>

                    <div class="form-group row mt-1">
                        <label for="no_cm" class="col-sm-4 col-form-label">No. CM</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7 align-items-center">
                            <span><?php echo $json['no_registration']; ?></span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="cob" class="col-sm-4 col-form-label">COB</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7 align-items-center">
                            <span><?php echo $json['cob']; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_rawat" class="col-sm-4 col-form-label">Jenis Rawat</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7 align-items-center">
                            <span>Rawat Jalan</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                        <div class="col-sm-1 d-flex align-items-center">
                            <p class="mb-0">:</p>
                        </div>
                        <div class="col-sm-7 align-items-center">
                            <span>Kelas I</span>
                        </div>
                    </div>


                    <div class="row align-items-center mt-5">
                        <div class="col-2"></div>
                        <div class="col-10">
                            <h6>Bengkulu,
                                <span><?php echo $json['visit_date']; ?></span>
                            </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-3">
                            <div class="text-center">
                                <h6>Pasien/<br>Keluarga<br>Pasien</h6>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text-center">
                                <h6>Petugas BPJS<br>Kesehatan</h6>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-3">
                            <hr style="border: 2px solid black;">
                        </div>
                        <div class="col-3">
                            <hr style="border: 2px solid black;">
                        </div>
                    </div>

                </form>
            </div>
            <form action="" method="">
                <div class="row">
                    <h6 class="text-center"><b>SURAT BUKTI PELAYANAN <br> NAMA RS : RSUD DR M.YUNUS KODE RS : 0701R001 KELAS RS : B
                        </b></h6>
                    <h6 class="text-uppercase text-decoration-underline text-center"><b>rawat jalan</b></h6>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="col-5">
                            <label>Tanggal Masuk:</label>
                        </div>
                        <div class="col-12">
                            <label>Cara Keluar : 1. Sembuh 2. Rujuk <br> 3. APS 4. Meninggal 5. ..................</label>
                        </div>
                    </div>

                    <div class="col-4">
                        <label>Tanggal Keluar:</label>
                        <br>
                        <label>Tarif RS:</label>
                        <br>
                        <label>Jml Hari Perawatan:</label>
                        <br>
                        <label>Berat Lahir:</label>
                    </div>

                    <div class="col-3">
                        <table class="table table-bordered" style="border: solid black;">
                            <tbody>
                                <tr style="height: 15px;">
                                    <td class="text-center">
                                        <label class="text-uppercase">urologi</label>
                                    </td>
                                </tr>
                                <tr style="height: 25px;"> <!-- Sesuaikan tinggi baris sesuai kebutuhan -->
                                    <td class="text-center">
                                        <label class="text-uppercase fs-2" style="font-family: 'Times New Roman', Times, serif;">
                                            <b><?php echo $json['urutan']; ?></b>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Diagnosa Primer : </label>
                        <br>
                        <label>Dagnosa Sekunder :</label>
                        <br>
                        <label>Tindakan : </label>
                        <br>
                        <label>Special CMG : </label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="text-center">
                            <h6>Peserta</h6>
                            <br>
                            <br>
                            <div class="signature-line mt-5"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <h6>Bengkulu,............. <br>Dokter Pemeriksa</h6>
                            <br>
                            <br>
                            <div class="signature-line mt-4"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
    <style>
        @media print {
            @page {
                margin: 20px;
                size: auto;
            }
        }
    </style>

    <script>
        window.print();
    </script>

</body>

</html>