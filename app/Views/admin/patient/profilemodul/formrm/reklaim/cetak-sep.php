<div class="page-break portrait">

    <body>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-6">
                    <div>
                        <img src="<?= base_url() ?>assets/img/logo-bpjs.jpg" alt="BPJS KESEHATAN" style="width: 260px;">
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2 align-items-center">
                            <label for="no_sep" class="col-sm-4 col-form-label">No. SEP</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['no_skp']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tgl_sep" class="col-sm-4 col-form-label">Tgl. SEP</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo substr(@$sep['json']['visit_date'], 0, 16); ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="no_kartu" class="col-sm-4 col-form-label">No. Kartu</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['kk_no']; ?>
                                    (MR. <?= @$sep['json']['no_registration'] ?>)</span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="nama_peserta" class="col-sm-4 col-form-label">Nama Peserta</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['name_of_pasien']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tgl_lahir" class="col-sm-4 col-form-label">Tgl.Lahir</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo substr(@$sep['json']['tgl_lahir'], 0, 10); ?></span>
                            </div>
                        </div>

                        <!-- <div class="form-group row align-items-center">
                            <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <?php if (@$sep['json']['gender'] == 1) { ?>
                                <span>Laki- Laki</span>
                                <?php } else { ?>
                                <span>Perempuan</span>
                                <?php } ?>
                            </div>
                        </div> -->
                        <div class="form-group row align-items-center">
                            <label for="poli_tujuan" class="col-sm-4 col-form-label">Sub/Spesialis</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['name_of_clinic']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="asal_faskes" class="col-sm-4 col-form-label">Dokter</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['fullname']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="asal_faskes" class="col-sm-4 col-form-label">Faskes Perujuk</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['nmprovider']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="diagnosa_awal" class="col-sm-4 col-form-label">Diagnosa Awal</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['diag_awal']; ?>-<?php echo @$sep['json']['conclusion']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="catatan" class="col-sm-4 col-form-label">Catatan</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['description']; ?></span>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-6">
                    <div class="row">
                        <h6 class="text-center"><b>SURAT ELIGIBILITAS PESERTA <br> <?= @$kop['display'] ?></b></h6>
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2">
                            <label for="peserta" class="col-sm-4 col-form-label">Peserta</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$sep['dataSep']['nmjnspeserta']; ?></span>

                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <label for="no_cm" class="col-sm-4 col-form-label">Jns.Rawat</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span>
                                    <?php
                                    $isrj = @$sep['json']['isrj'];
                                    echo ($isrj === "1") ? "Rawat Jalan" : (($isrj === "0") ? "Rawat Inap" : $isrj);
                                    ?>
                                </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="cob" class="col-sm-4 col-form-label">Jns. Kunjungan</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$sep['dataSep']['tujuankunj_desc'] ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_rawat" class="col-sm-4 col-form-label">Poli Perujuk</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span>Rawat Jalan</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 col-form-label">Kls. Hak</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$sep['json']['name_of_class_plafond']; ?></span>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 col-form-label">Kls. Rawat</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$sep['json']['name_of_class']; ?></span>

                            </div>
                        </div>



                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h6>Pasien/ Keluarga Pasien</h6>
                                </div>
                            </div>

                        </div>

                        <div class="row ">
                            <div class="col-6 d-flex justify-content-center align-items-center" style="height: 100px;">
                                <div id="qr-code-sep"></div>
                            </div>
                        </div>





                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>
                        *Saya menyetujui BPJS Kesehatan untuk:
                        <br>a. Membuka dan atau menggunakan informasi medis Pasien untuk keperluan administrasi,
                        pembayaran asuransi, atau jaminan pembiayaan kesehatan.
                        <br>b. Memberikan akses informasi medis atau riwayat pelayanan kepada dokter/tenaga
                        medis pada RS PKU MUHAMMADIYAH SAMPANGAN
                        untuk kepentingan pemeliharaan kesehatan, pengobatan, penyembuhan, dan perawatan Pasien.
                    </p>

                    <p>
                        *Saya mengetahui dan memahami:
                        <br>a. Rumah Sakit dapat melakukan koordinasi dengan PT Jasa Raharja / PT Taspen / PT
                        ASABRI / BPJS Ketenagakerjaan atau
                        Penjamin lainnya, jika Peserta merupakan pasien yang mengalami kecelakaan lalu lintas
                        dan/atau kecelakaan kerja.
                        <br>b. SEP bukan sebagai bukti penjaminan peserta.
                    </p>

                    <p>
                        **Dengan tampilnya luaran SEP elektronik ini merupakan hasil validasi terhadap
                        eligibilitas Pasien secara elektronik
                        (validasi finger print atau biometrik/sistem validasi lain), dan selanjutnya Pasien
                        dapat mengakses pelayanan kesehatan rujukan sesuai ketentuan berlaku.
                        <br>Kebenaran dan keaslian atas informasi data Pasien menjadi tanggung jawab penuh
                        FKRTL.
                    </p>
                </div>

            </div>
        </div>




        <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
        <style>
            /* @media print {
            @page {
                margin: 20px;
                size: auto;
            }
        } */
        </style>



    </body>

</div>
<script>
    const noSkp = `<?php echo isset($sep['json']['kk_no']) ? $sep['json']['kk_no'] : $sep['json']['no_registration']; ?>`;


    // const base64ttd_cetak_sep = noSkp

    // if (base64ttd_cetak_sep) {
    //     cropTransparentPNG(base64ttd_cetak_sep, (croppedImage) => {
    //         if (croppedImage) {
    //             $('#qr-code-sep').html(
    //                 `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
    //             );
    //         } else {
    //             $('#qr-code-sep').html('');
    //         }
    //     });
    // } else {
    //     $('#qr-code-sep').html('');
    // }


    // if (base64ttd_cetak_sep) {
    //     $('#qr-code-sep').html(
    //         `<img src="${base64ttd_cetak_sep}" alt="QR Code" width="300" style="position: absolute;top: -63px; left: -100px;width: 498px;">`
    //     );
    // } else {
    //     $('#qr-code-sep').html('');
    // }


    new QRCode(document.getElementById("qr-code-sep"), {
        text: noSkp || "",
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
    setTimeout(() => {
        //window.print()
    }, 2000);
</script>