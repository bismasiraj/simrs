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
                            <label for="no_sep" class="col-sm-4 col-form-label">No. Kartu</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$skdp['json']['no_bpjs']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tgl_sep" class="col-sm-4 col-form-label">Nama Peserta</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo @$skdp['json']['nama']; ?></span>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo @$skdp['json']['date_of_birth']; ?>
                                    <?php echo @$skdp['json']['umur']; ?></span>
                            </div>
                        </div>



                        <div class="form-group row align-items-center">
                            <label for="diagnosa_awal" class="col-sm-4 col-form-label">Diagnosa</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$skdp['json']['diagnosis']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="catatan" class="col-sm-4 col-form-label">Rencana Kontrol</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$skdp['json']['tgl_kontrol_selanjutnya']; ?></span>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col">
                            <p>Demikian Atas Bantuannya, diucapkan Banyak Terimakasih

                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <h6 class="text-center"><b>SURAT RENCANA KONTROL <br> <?= @$kop['display'] ?></b></h6>
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2">
                            <label for="no" class="col-sm-4 col-form-label">No</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$skdp['json']['nosep']; ?></span>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>



        <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>

        <script>
            //window.print();
        </script>


    </body>

</div>