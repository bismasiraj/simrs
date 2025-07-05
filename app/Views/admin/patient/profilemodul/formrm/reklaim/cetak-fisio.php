<?php if (!empty($fisio['val'])): ?>


<div class="page-break portrait">
    <div class="card-body">
        <div class="container-fluid mt-5">
            <!-- template header -->
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                </div>
                <div class="col mt-2">
                    <h3 class="kop-name text-center" id="kop-name">
                        <?= @$kop['name_of_org_unit'] ?>
                    </h3>
                    <p class="text-center"><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                        <?= @$kop['fax'] ?? "-" ?>,
                        <?= @$kop['kota'] ?? "-" ?></p>
                    <p class="text-center"><?= @$kop['sk'] ?? "-" ?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="100px">
                </div>
            </div>
            <br>
            <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
            </div>
            <br>
            <div class="row">
                <h3 class="text-center pt-2 fw-bold">Lembar Hasil Uji Fungsi KFR
                </h3>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <div id="no_registration-val-ujifungsimedic" name="no_registration">
                                <?= $visit['no_registration'] ?>
                            </div>
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <div id="diantar_oleh-val-ujifungsimedic" name="name_of_pasien" class="thename">
                                <?= $visit['name_of_pasien'] ?>
                            </div>
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <div name="gender" id="gender-val-ujifungsimedic">
                                <?= (@$visit['gender'] === 1 || @$visit['gender'] === '1') ? 'Laki-laki' : 'Perempuan'; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <div id="age-val-ujifungsimedic" name="age">
                                <?= $visit['tgl_lahir'] ?> (<?= $visit['age'] ?> )

                            </div>
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <div id="contact_address-val-ujifungsimedic" name="contact_address" class="contact_address">
                                <?= $visit['contact_address'] ?>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <div id="fullname-val-ujifungsimedic" name="fullname">
                                <?= $visit['fullname'] ?>

                            </div>
                        </td>
                        <td>
                            <b>Department</b>
                            <div id="clinic_id-val-ujifungsimedic" name="clinic_id">
                                <?= $fisio['clinic']['name_of_clinic'] ?>

                            </div>
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <div id="visit_date-val-ujifungsimedic" name="visit_date">
                                <?= $visit['visit_date'] ?>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>


            <b>Lembar Hasil Tindakan Uji Fungsi / Prosedur KFR <span id="val-detail-treatment-result">
                    <?php if (isset($fisio['val']['teraphy_result'])): ?>
                    <span><?= $fisio['val']['teraphy_result'] ?></span>
                    <?php endif; ?></span></b>

            <!-- end of template header -->
            <form id="formaddaujirehab">
                <div id="inputformujirehab"></div>
                <table class="table table-bordered">
                    <tr>
                        <td>Tanggal Pemeriksaan</td>
                        <td>
                            <?php if (isset($fisio['val']['vactination_date']) && !empty($fisio['val']['vactination_date'])): ?>
                            <?php
                                    $dateTime = explode(' ', $fisio['val']['vactination_date']);
                                    $datePart = explode('-', $dateTime[0]);
                                    $timePart = substr($dateTime[1], 0, 5);

                                    $formattedDate = $datePart[2] . '/' . $datePart[1] . '/' . $datePart[0] . ' ' . $timePart;
                                    ?>
                            <span><?= $formattedDate ?></span>
                            <?php endif; ?>


                        </td>
                    </tr>
                    <tr>
                        <td>Diagnosis Fungsional</td>
                        <td id="diagnosis-fungsi-uji-fisio">
                            <?php if (!empty($fisio['diag'])): ?>
                            <?php foreach ($fisio['diag'] as $diagnosa): ?>
                            <?php if (isset($diagnosa['diag_cat']) && ($diagnosa['diag_cat'] == 17 || $diagnosa['diag_cat'] === '17')): ?>
                            <span><?= htmlspecialchars($diagnosa['diagnosa_name'], ENT_QUOTES, 'UTF-8') ?></span><br>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>


                        </td>
                    </tr>
                    <tr>
                        <td>Diagnosis Medis</td>
                        <td id="diagnosis-medis-uji-fisio">

                            <?php if (!empty($fisio['diag'])): ?>
                            <?php foreach ($fisio['diag'] as $diagnosa): ?>
                            <?php if (isset($diagnosa['diag_cat']) && ($diagnosa['diag_cat'] == 1 || $diagnosa['diag_cat'] === '1')): ?>
                            <span><?= htmlspecialchars($diagnosa['diagnosa_name'], ENT_QUOTES, 'UTF-8') ?></span><br>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>


                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Instrumen Uji Fungsi/ Prosedur KFR</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php if (isset($fisio['val']['treatment'])): ?>
                            <span><?= $fisio['val']['treatment'] ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Hasil yang Didapat</td>
                        <td> <?php if (isset($fisio['val']['teraphy_result'])): ?>
                            <span><?= $fisio['val']['teraphy_result'] ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Kesimpulan</td>
                        <td><?php if (isset($fisio['val']['teraphy_conclusion'])): ?>
                            <span><?= $fisio['val']['teraphy_conclusion'] ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Rekomendasi</td>
                        <td><?php if (isset($fisio['val']['teraphy_recomendation'])): ?>
                            <span><?= $fisio['val']['teraphy_recomendation'] ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </form>

            <div class="row justify-content-end hidden-show-ttd">
                <div class="col-auto" align="center">
                    <div class="mb-2">
                        <?= isset($kop['kota']) ? $kop['kota'] : 'Kota' ?>,
                        <?= tanggal_indo(date('Y-m-d')); ?></div>
                    <div class="mb-1">
                        <div id="qrcode-fisio-uji-pasien"></div>
                    </div>
                    <div><?= @$fisio['val']['doctor']; ?></div>

                </div>
            </div>
            <br><br>
            <i class="hidden-show-ttd">Dicetak pada tanggal
                <?= tanggal_indo(date('Y-m-d')); ?></i>
        </div>
    </div>

    <script>
    const base64ttd_cetak_fisio = <?= json_encode(@$fisio['val']['ttd_dok']); ?>;
    if (base64ttd_cetak_fisio) {
        $('#qrcode-fisio-uji-pasien').html(`<img src="${base64ttd_cetak_fisio}" alt="QR Code" width="300">`);
    } else {
        $('#qrcode-fisio-uji-pasien').html(' ');
    }



    //window.print();
    </script>

</div>
<?php endif; ?>