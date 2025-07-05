<?php if (!empty($cppt)): ?>
    <div class="page-break portrait">

        <body>
            <div class="container-fluid mt-5">
                <!-- template header -->
                <div class="row">
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="90px">
                    </div>
                    <div class="col mt-2" align="center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                            <?= @$kop['fax'] ?? "-" ?>,
                            <?= @$kop['kota'] ?? "-" ?></p>
                        <p><?= @$kop['sk'] ?? "-" ?></p>

                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="90px">
                    </div>
                </div>
                <!-- end of template header -->
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 50%;">
                                <b>No. RM / Nama Pasien / Jenis Kelamin</b>
                                <p class="p-1"><?= @$visit['no_registration'] . ' / ' . @$visit['diantar_oleh'] . ' / ' . @$visit['name_of_gender']  ?></p>
                            </td>
                            <td style="width: 50%;">
                                <b>Tanggal Masuk</b>
                                <p class="p-1"><?= tanggal_indo(date('Y-m-d')) ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                <b>Tanggal Lahir (Umur)</b>
                                <p class="p-1"><?= tanggal_indo(substr($visit['tgl_lahir'], 0, 10)) . ' (' . @$visit['age'] . ')'; ?></p>
                            </td>
                            <td style="width: 50%;">
                                <b>Alamat</b>
                                <p class="p-1"><?= @$visit['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                <b>DPJP</b>
                                <p class="p-1"><?= @$visit['fullname']; ?></p>
                            </td>
                            <td style="width: 50%;">
                                <b>Department</b>
                                <p class="p-1"><?= @$visit['name_of_clinic']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead class="fw-bold">
                        <tr>
                            <td style="width: 7%;">Tanggal</td>
                            <td style="width: 5%;">Kode PPA</td>
                            <td style="width: 13%;">Dokter/PPA</td>
                            <td colspan="2">Catatan Dokter</td>
                            <!-- <td>Response</td> -->
                            <td>Verifikasi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cppt as $key => $value) : ?>
                            <tr>
                                <td><?= $value['examination_date']; ?></td>
                                <td><?= $value['kode_ppa']; ?></td>
                                <td><?= $value['nama_ppa']; ?></td>
                                <?php if ($value['kode_ppa'] == 'D') : ?>
                                    <td colspan="2">
                                        <p>
                                            <b><?= $value['dokumen']; ?></b> <br>
                                            S : <?= $value['subyectif']; ?> <br>
                                            O : <?= $value['obyektif']; ?> <br>
                                            A : <?= $value['asesmen']; ?> <br>
                                            P : <?= $value['planning']; ?> <br>
                                        </p>
                                    </td>
                                <?php else : ?>
                                    <td width="1%">-</td>
                                    <td>
                                        <p>
                                            <b><?= $value['dokumen']; ?></b><br>
                                            S : <?= $value['subyectif']; ?> <br>
                                            O : <?= $value['obyektif']; ?> <br>
                                            A : <?= $value['asesmen']; ?> <br>
                                            P : <?= $value['planning']; ?> <br>
                                        </p>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <p>
                                        <b>Tgl Ditulis: </b><?= empty($value['tanggal_dibuat']) ? '-' : substr($value['tanggal_dibuat'], 0, 16); ?> <br>
                                        <b>Tgl Konfirm: </b><?= empty($value['tanggal_konfirm']) ? '-' : substr($value['tanggal_konfirm'], 0, 16); ?> <br>
                                        <b>Konfirm Oleh: </b><?= empty($value['konfirm_oleh']) ? '-' : $value['konfirm_oleh']; ?><br>
                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            </div>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        </body>

        <style>
            @media print {
                @page {
                    margin: none;
                    scale: 85;
                }

                .container {
                    width: 210mm;
                    /* Sesuaikan dengan lebar kertas A4 */
                }
            }
        </style>
    </div>
<?php endif; ?>