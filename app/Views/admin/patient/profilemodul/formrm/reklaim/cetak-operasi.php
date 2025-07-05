<?php if (!empty($oprasi['val'])) : ?>
<div class="page-break portrait">

    <body>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-auto text-center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="90px">
                </div>
                <div class="col text-center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                        <?= @$kop['fax'] ?? "-"?>,
                        <?= @$kop['kota'] ?? "-"?></p>
                    <p><?= @$kop['sk'] ?? "-"?></p>
                </div>
                <div class="col-auto text-center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="90px">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><?= $oprasi['title']; ?></h4>
            </div>
            <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Nomor RM</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['no_registration']; ?></p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Nama Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['diantar_oleh']; ?></p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Jenis Kelamin</b>
                            <p class="m-0 mt-1 p-0">
                                <?= isset($oprasi['visit']['gender']) ? 
                                        ($oprasi['visit']['gender'] == 1 || $oprasi['visit']['gender'] === '1' ? 'Laki-laki' : 
                                        ($oprasi['visit']['gender'] == 2 || $oprasi['visit']['gender'] === '2' ? 'Perempuan' : '')) 
                                        : '' ?>


                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Tanggal Lahir (Usia)</b>


                            <p class="m-0 mt-1 p-0">
                                <?= date("d M Y", strtotime($oprasi['visit']['tgl_lahir'])) . ' (' . (!empty($oprasi['visit']['age']) ? $oprasi['visit']['age'] : 'N/A') . ')'; ?>
                            </p>


                        </td>
                        <td class="p-1" style="width:66.3%" colspan="2">
                            <b>Alamat Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['visitor_address']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['fullname']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p class="m-0 mt-1 p-0">
                                <?php 
                            if (!empty($oprasi['visit']['specialist_type_id'])) {
                                $db = db_connect();
                                $query = $db->table('specialist_type')
                                            ->select('SPECIALIST_TYPE')
                                            ->where('specialist_type_id', $oprasi['visit']['specialist_type_id'])
                                            ->get()
                                            ->getRow();

                                echo $query ? esc($query->SPECIALIST_TYPE) : '-';
                            }
                            ?>
                            </p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['in_date'] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Kelas</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['class_room']; ?></p>
                        </td>
                        <td class="p-1" colspan="2">
                            <b>Bangsal/Kamar</b>
                            <p class="m-0 mt-1 p-0"><?= @$oprasi['visit']['name_of_clinic']; ?></p>
                        </td>

                    </tr>
                </tbody>
            </table>
            <?php if (isset($oprasi['operation_team'])) : ?>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($oprasi['operation_team'] as $key => $team) : ?>
                <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b><?= $team['task'] ?></b>
                    <p class="m-0 mt-1 p-0"><?= @$team['doctor']; ?></p>
                </div>
                <?php endforeach ?>
            </div>
            <?php endif; ?>

            <?php if (isset($oprasi['diagnosas'])) : ?>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <ul><b>Diagnosa Pra Operasi</b>
                        <?php
                        $diagnosa_pra = array_filter($oprasi['diagnosas'], function ($item) {
                            return $item['diag_cat'] === 13;
                        });
                        foreach ($diagnosa_pra as $key => $diag_pra) :
                        ?>
                        <li class="m-0 mt-1 p-0"><?= $diag_pra['diagnosa_name']  ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Waktu Mulai</b>
                    <p class="m-0 mt-1 p-0">
                        <?= date_format(date_create(@$oprasi['val']['start_operation']), 'd-m-Y H:i'); ?></p>
                    <b>Waktu Selesai</b>
                    <p class="m-0 mt-1 p-0">
                        <?= date_format(date_create(@$oprasi['val']['end_operation']), 'd-m-Y H:i'); ?></p>
                    <b>Ada Penundaan?</b>
                    <?php
                    $statusTerlayaniOperasi = [
                        0 => 'Terjadwal',
                        1 => 'Proses',
                        2 => 'Selesai (Tidak tertunda)',
                        3 => 'Tertunda',
                        4 => 'Batal',
                    ];
                    ?>
                    <p class="m-0 mt-1 p-0">
                        <?= $statusTerlayaniOperasi[$oprasi['val']['terlayani'] ?? 0] ?? 'Status Tidak Diketahui'; ?>
                    </p>
                </div>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-8 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <ul><b>Diagnosa Pasca Operasi</b>
                        <?php
                        $diagnosa_pasca = array_filter($oprasi['diagnosas'], function ($item) {
                            return in_array($item['diag_cat'], [14, 15]);
                        });
                        foreach ($diagnosa_pasca as $key => $diag_pasca) :
                        ?>
                        <li class="m-0 mt-1 p-0"><?= $diag_pasca['diagnosa_name']  ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Sifat Operasi</b>
                    <p class="m-0 mt-1 p-0">
                        <?php
                        $kategoriOprs = [
                            0 => 'Elektif',
                            1 => 'Cyto',
                            2 => 'Emergency'
                        ];
                        echo isset($kategoriOprs[$oprasi['val']['patient_category_id']]) ? $kategoriOprs[$oprasi['val']['patient_category_id']] : '-';
                        ?>

                    </p>
                </div>
            </div>
            <?php endif; ?>

            <table class="table table-bordered">
                <tr>
                    <td width="33.3%">
                        <b>Prosedur Pembedahan</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['tarif_id']; ?></p>
                    </td>
                    <td width="33.3%">
                        <b>Tipe Operasi</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['tipe_operasi']; ?></p>
                    </td>
                    <td width="33.3%">
                        <b>Operasi Ke</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['re_operation'] == 'OP080801' ? '1' : 're-do';  ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="33.3%">
                        <b>Profilaksis</b>
                        <p class="m-0 mt-1 p-0">
                            <?= empty($oprasi['val']['profilaksis']) ? '' : ($oprasi['val']['profilaksis'] == 'OP080901' ? 'Ya' : 'Tidak'); ?>
                        </p>

                        </p>
                    </td>
                    <td width="33.3%">
                        <b>Jenis Antibiotik</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['antibiotic_desc']; ?></p>
                    </td>
                    <td width="33.3%">
                        <b>Waktu Pemberian</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['antibiotic_time']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Uraian Pembedahan</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['operation_desc']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Komplikasi</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['komplikasi']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Nomor Implant</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['implant']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" width="66.6%">
                        <b>Konsultasi Intra-Operatif</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['konsultasi']; ?></p>
                    </td>
                    <td>
                        <b>Jumlah Pendarahan</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['bleeding']; ?> CC</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Jaringan Ke Patologi</b>
                        <p class="m-0 mt-1 p-0"><?= @$oprasi['val']['patologi_desc']; ?></p>
                    </td>
                </tr>
            </table>


            <div class="row">
                <div class="col-auto" align="center">
                    <div>Dokter</div>
                    <div class="mb-1">
                        <div id="qrcode-oprasiEklaim"></div>
                    </div>
                    <div><?= $oprasi['val']['doctor']; ?></div>

                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Pasien</div>
                    <div class="mb-1">
                        <div id="qrcode-oprasiEklaim1"></div>
                    </div>
                    <div><?= $oprasi['visit']['diantar_oleh']; ?></div>

                </div>
            </div>
        </div>
        <br>
        <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

    </body>

    <script>
    const base64ttd_cetak_oprss = <?= json_encode(@$oprasi['val']['ttd_dok']); ?>;
    if (base64ttd_cetak_oprss) {
        $('#qrcode-oprasiEklaim').html(`<img src="${base64ttd_cetak_oprss}" alt="QR Code" width="300">`);
    } else {
        $('#qrcode-oprasiEklaim').html('');
    }
    // var qrcode = new QRCode(document.getElementById("qrcode-oprasiEklaim"), {
    //     text: `<?= $oprasi['visit']['fullname']; ?>`,
    //     width: 70,
    //     height: 70,
    //     colorDark: "#000000",
    //     colorLight: "#ffffff",
    //     correctLevel: QRCode.CorrectLevel.H // High error correction
    // });

    const base64ttd_cetak_oprss_pasien = <?= json_encode(@$oprasi['val']['ttd_pasien']); ?>;

    if (base64ttd_cetak_oprss_pasien) {
        cropTransparentPNG(base64ttd_cetak_oprss_pasien, (croppedImage) => {
            if (croppedImage) {
                $('#qrcode-oprasiEklaim1').html(
                    `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                );
            } else {
                $('#qrcode-oprasiEklaim1').html('');
            }
        });
    } else {
        $('#qrcode-oprasiEklaim1').html('');
    }

    // if (base64ttd_cetak_oprss_pasien) {
    //     $('#qrcode-oprasiEklaim1').html(
    //         `<img src="${base64ttd_cetak_oprss_pasien}" alt="QR Code" width="300" style="position: absolute;top: -63px; left: -100px;width: 498px;">`
    //     );
    // } else {
    //     $('#qrcode-oprasiEklaim1').html('');
    // }
    </script>

    </script>

</div>

<?php endif; ?>