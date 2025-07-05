<!-- ========================================================== -->
<?php
if (!empty($resumeMedis['val'])) :
?>
<div class="page-break portrait">
    <!doctype html>
    <html lang="en">

    <body>
        <div class="container-fluid mt-5">
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

            <div class="row">
                <h4 class="text-center"><?= $resumeMedis['title'] ?? @$title; ?>
                </h4>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Nomor RM</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['visit']['no_registration']; ?></p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Nama Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['visit']['diantar_oleh']; ?></p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Jenis Kelamin</b>
                            <p class="m-0 mt-1 p-0">
                                <?= isset($resumeMedis['visit']['gender']) ? ($resumeMedis['visit']['gender'] == 1 ? 'Laki-laki' : ($resumeMedis['visit']['gender'] == 2 ? 'Perempuan' : '')) : '' ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Tanggal Lahir (Usia)</b>
                            <p class="m-0 mt-1 p-0">
                                <?= substr(@$resumeMedis['visit']['tgl_lahir'], 0, 10) . ' (' . @$resumeMedis['visit']['age'] . ')'; ?>
                            </p>

                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Alamat Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['visit']['visitor_address']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0">
                                <?=
                                    substr(isset($resumeMedis['visit']['visit_date']) && $resumeMedis['visit']['visit_date'] ? $resumeMedis['visit']['visit_date'] : (isset($resumeMedis['visit']['visit_datetime']) ? $resumeMedis['visit']['visit_datetime'] : ''), 0, 16)
                                    ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['visit']['fullname']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['visit']['name_of_clinic']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Keluar</b>
                            <p class="m-0 mt-1 p-0">
                                <?=
                                    substr(isset($resumeMedis['visit']['exit_date']) && $resumeMedis['visit']['exit_date'] ? $resumeMedis['visit']['exit_date'] : (isset($resumeMedis['visit']['exit_date_tf']) ? $resumeMedis['visit']['exit_date_tf'] : ''), 0, 16)
                                    ?>
                            </p>
                        </td>
                    </tr>

                    <!-- jika pasien rawat inap -->
                    <?php if (!empty($resumeMedis['visit']['class_room_id'])) : ?>
                    <tr>
                        <td class="p-1">
                            <b>Kelas</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['visit']['name_of_class_plafond'] ?? "-"; ?></p>
                        </td>
                        <td class="p-1" colspan="2">
                            <b>Bangsal/Kamar</b>
                            <p class="m-0 mt-1 p-0"><?= $resumeMedis['visit']['name_of_class'] ?? '-'; ?></p>
                        </td>
                        <!-- <td class="p-1">
                    <b>Bed</b>
                    <p class="m-0 mt-1 p-0"><?= $visit['bed_id'] ?? '-'; ?></p>
                </td> -->
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>


            <!-- end of template header -->
            <div class="row">
                <h5 class="text-start">Subjektif (S)</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Keluhan Utama (Autoanamnesis)</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['anamnesis']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Riwayat Penyakit Sekarang</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_sekarang']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Riwayat Penyakit Dahulu</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_dahulu']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Riwayat Penyakit Keluarga</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_penyakit_keluarga']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Riwayat Alergi (Non Obat)</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alergi_nonobat']; ?></p>
                            <b>Riwayat Alergi (Obat)</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alergi_obat']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Riwayat Obat Yang Dikonsumsi</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_obat_dikonsumsi']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Riwayat Kehamilan dan Persalinan</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_kehamilan']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Riwayat Diet</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_diet']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Riwayat Imunisasi</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_imunisasi']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="p-1">
                            <b>Riwayat Kebiasaan (Negatif)</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['riwayat_alkohol']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Obyektif (O)</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td colspan="4" class="p-1"><b>Vital Sign</b></td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Tekanan Darah</b>
                            <p class="m-0 mt-1 p-0">
                                <?= (int) (@$resumeMedis['val']['tensi_atas'] ?? 0)  ?>/<?= (int) ($resumeMedis['val']['tensi_bawah'] ?? 0); ?>
                                mmHg</p>
                        </td>
                        <td class="p-1">
                            <b>Denyut Nadi</b>
                            <p class="m-0 mt-1 p-0"><?= (int) (@$resumeMedis['val']['nadi'] ?? 0) ?> x/m</p>
                        </td>
                        <td class="p-1">
                            <b>Suhu Tubuh</b>
                            <p class="m-0 mt-1 p-0"><?= (int) (@$resumeMedis['val']['suhu'] ?? 0)  ?> °C</p>
                        </td>
                        <td class="p-1">
                            <b>Respiration Rate</b>
                            <p class="m-0 mt-1 p-0"><?= (int) (@$resumeMedis['val']['respiration'] ?? 0)  ?> x/m</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Berat Badan</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['berat']; ?> kg</p>
                        </td>
                        <td class="p-1">
                            <b>Tinggi Badan</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['tinggi']; ?> cm</p>
                        </td>
                        <td class="p-1">
                            <b>SpO2</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['spo2']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>BMI</b>
                            <p class="m-0 mt-1 p-0"><?= number_format(@$resumeMedis['val']['imt'] ?? 0, 2, '.', ''); ?>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php if (!empty(@$resumeMedis['val']['gcs_desc'])) { ?>

            <?php
                    if (@$resumeMedis['visit']['ageyear'] < 18) { ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b><i>pGCS / Tingkat Kesadaran</i></b>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>pGCS E / Respon Membuka Mata :</b> <span
                                        class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_e'] . '] ' . @$resumeMedis['val']['gsc_e_desc']; ?>.</span>
                                    <b>pGCS V / Respon Verbal Terbaik :</b> <span
                                        class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_v'] . '] ' . @$resumeMedis['val']['gsc_v_desc']; ?>.</span>
                                    <b>pGCS M / Respon Motorik Terbaik :</b> <span
                                        class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_m'] . '] ' . @$resumeMedis['val']['gsc_m_desc']; ?>.</span>
                                </div>

                            </div>
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>Score pGCS : </b>
                                    <span class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['gcs_desc']; ?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Keadaan Umum</b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$resumeMedis['val']['keadaanumum']) ? @$resumeMedis['val']['keadaanumum'] : '-'; ?>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php } else { ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b><i>GCS / Tingkat Kesadaran</i></b>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>GCS E / Respon Membuka Mata :</b> <span
                                        class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_e'] . '] ' . @$resumeMedis['val']['gsc_e_desc']; ?>.</span><br>
                                    <b>GCS V / Respon Verbal Terbaik :</b> <span
                                        class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_v'] . '] ' . @$resumeMedis['val']['gsc_v_desc']; ?>.</span><br>
                                    <b>GCS M / Respon Motorik Terbaik :</b> <span
                                        class="m-0 mt-1 p-0"><?= '[' . @$resumeMedis['val']['gcs_m'] . '] ' . @$resumeMedis['val']['gsc_m_desc']; ?>.</span>
                                </div>

                            </div>
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>Score GCS : </b>
                                    <span class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['gcs_desc']; ?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Keadaan Umum</b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$resumeMedis['val']['keadaanumum']) ? @$resumeMedis['val']['keadaanumum'] : '-'; ?>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php } ?>
            <?php } ?>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" style="width: 50%;">
                            <b>Skala Nyeri</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['pain_score']; ?></p>
                        </td>
                        <td class="p-1" style="width: 50%;">
                            <b>Resiko Jatuh</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['fall_score']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if ($resumeMedis['visit']['specialist_type_id'] === "1.12"): ?>
            <table class="table table-bordered" id="statusDermatologiShow">
                <tbody>
                    <tr>
                        <td colspan="4" class="fw-bold">Status Dermatologik</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="row">
                                <b class="col-12">I. Inspeksi</b>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td class="fw-bold">Lokasi</td>
                                        <td class="fw-bold">UKK</td>
                                        <td class="fw-bold">Distribusi</td>
                                        <td class="fw-bold">Konfigurasi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= @$resumeMedis['val']['kulit']['sd_ins_location'] ?></td>
                                        <td><?= @$resumeMedis['val']['kulit']['sd_ins_ukk'] ?></td>
                                        <td><?= @$resumeMedis['val']['kulit']['sd_ins_distribution'] ?></td>
                                        <td><?= @$resumeMedis['val']['kulit']['sd_ins_configuration'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <b class="col-12">Palpasi</b>
                                <span class="col-12"><?= @$resumeMedis['val']['kulit']['sd_palpation'] ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <b class="col-12">Lain-Lain</b>
                                <span class="col-12"><?= @$resumeMedis['val']['kulit']['sd_others'] ?></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="row">
                                <b class="col-12">Status Venerologik</b>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <b class="col-12">Inspeksi</b>
                                <span class="col-12"><?= @$resumeMedis['val']['kulit']['sv_inspection'] ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <b class="col-12">Palpasi</b>
                                <span class="col-12"><?= @$resumeMedis['val']['kulit']['sv_palpation'] ?></span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php endif; ?>
            <?php
                if ($resumeMedis['visit']['specialist_type_id'] === "1.16"): ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Var/NRS</th>
                        <th>Pupil Kiri</th>
                        <th>Pupil kanan</th>
                    </tr>
                    <tr>
                        <td><?= @$resumeMedis['val']['saraf']['vas_nrs'] ?></td>
                        <td>
                            <b>Diameter :</b><?= @$resumeMedis['val']['saraf']['left_diameter'] ?>
                            <br><b>Refleks Cahaya :</b><?= @$resumeMedis['val']['saraf']['left_light_reflex'] ?>
                            <br><b>Kornea:</b><?= @$resumeMedis['val']['saraf']['left_cornea'] ?>
                            <br><b>Isokor Anisokor :</b><?= @$resumeMedis['val']['saraf']['left_isokor_anisokor'] ?>
                        </td>
                        <td>
                            <b>Diameter :</b><?= @$resumeMedis['val']['saraf']['right_diameter'] ?>
                            <br><b>Refleks Cahaya :</b><?= @$resumeMedis['val']['saraf']['right_light_reflex'] ?>
                            <br><b>Kornea:</b><?= @$resumeMedis['val']['saraf']['right_cornea'] ?>
                            <br><b>Isokor Anisokor :</b><?= @$resumeMedis['val']['saraf']['right_isokor_anisokor'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Leher</th>
                        <th>Gerak</th>
                        <th>Kekuatan</th>
                    </tr>
                    <tr>
                        <td>
                            <b>Kaku kuduk :</b><?= @$resumeMedis['val']['saraf']['stiff_neck'] ?>
                            <br><b>Meningeal Sign :</b><?= @$resumeMedis['val']['saraf']['meningeal_sign'] ?>
                            <br><b>Brudzinki I-IV :</b><?= @$resumeMedis['val']['saraf']['brudzinki_i_iv'] ?>
                            <br><b>Kernig Sign:</b><?= @$resumeMedis['val']['saraf']['kernig_sign'] ?>
                            <br><b>Dolls eye phenomena :</b><?= @$resumeMedis['val']['saraf']['dolls_eye_phenomenon'] ?>
                            <br><b>Vertebra :</b><?= @$resumeMedis['val']['saraf']['vertebra'] ?>
                            <br><b>Extremity :</b><?= @$resumeMedis['val']['saraf']['extremity'] ?>
                        </td>
                        <td>
                            <b>Gerak Atas Kiri :</b><?= @$resumeMedis['val']['saraf']['motion_upper_left'] ?>
                            <br><b>Gerak Atas Kanan :</b><?= @$resumeMedis['val']['saraf']['motion_upper_right'] ?>
                            <br><b>Gerak Bawah Kiri :</b><?= @$resumeMedis['val']['saraf']['motion_lower_left'] ?>
                            <br><b>Gerak Bawah Kanan :</b><?= @$resumeMedis['val']['saraf']['motion_lower_right'] ?>
                        </td>
                        <td>
                            <b>Kekuatan Atas Kiri :</b><?= @$resumeMedis['val']['saraf']['strength_upper_left'] ?>
                            <br><b>Kekuatan Atas Kanan :</b><?= @$resumeMedis['val']['saraf']['strength_upper_right'] ?>
                            <br><b>Kekuatan Bawah Kiri:</b><?= @$resumeMedis['val']['saraf']['strength_lower_left'] ?>
                            <br><b>Kekuatan Bawah Kanan
                                :</b><?= @$resumeMedis['val']['saraf']['strength_lower_right'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php endif; ?>

            <table class="table table-bordered">
                <tbody>
                    <?php
                        // check jika data lokalis ada atau tidak
                        if (!empty($resumeMedis['lokalis2'])) {
                            // jika ada maka lakukan perulangan untuk menampilkan data
                            foreach ($resumeMedis['lokalis2'] as $key => $value) {
                                // jika data lokalis memiliki value score = 2 maka tampilkan
                                if ($value['value_score'] == 2) {
                                    // jika key pada data adalah ganjil
                                    if (($key + 1) % 2 != 0) {
                                        // jika data bukan data terakhir 
                                        if ($key + 1 != count($resumeMedis['lokalis2'])) {
                                            echo '<tr>';
                                            echo '<td class="p-1" style="width: 50%;">'
                                                . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                                '</td>';
                                        } else {
                                            echo '<tr>';
                                            echo '<td class="p-1" colspan="2" style="width: 50%;">'
                                                . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                                '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<td class="p-1" style="width: 50%;">'
                                            . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                            '</td>';
                                        echo "<tr>";
                                    }
                                }
                            }
                        }
                        ?>
                </tbody>
            </table>

            <table class="table table-bordered">
                <tbody>
                    <?php
                        if (!empty($resumeMedis['lokalis'])) {
                            foreach ($resumeMedis['lokalis'] as $key => $value) {
                                if ($value['value_score'] == 3) {
                                    $filepath = 'C:\Users\Public\Pictures\\' . 'uploads/lokalis/' . $value['value_detail'];

                                    if (file_exists($filepath)) {
                                        $filedata = file_get_contents($filepath);
                                        $filedata64 = base64_encode($filedata);
                                        $selectlokalis[$key]['filedata64'] = $filedata64;

                                        echo '<tr>';
                                        echo '<th>' . $value['nama_lokalis'] . '</th>';
                                        echo '<td style="width: 50%;">';
                                        echo '<img class="mt-3" src="data:image/jpeg;base64,' . $filedata64 . '" width="400px">';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            }
                        }
                        ?>
                </tbody>
            </table>

            <?php
                if ($resumeMedis['visit']['specialist_type_id'] === "1.10"): ?>
            <?php
                    if (!empty($resumeMedis['val']['mata']) && is_array($resumeMedis['val']['mata'])) {
                        $result = [];
                        foreach ($resumeMedis['val']['mata'] as $item) {
                            $nama_lokalis = str_replace(["DEXTRA", "SINISTRA"], "", $item['nama_lokalis']);
                            $nama_lokalis = trim($nama_lokalis);
                            $value_info = $item['value_info'];
                            $value_detail = $item['value_detail'];

                            if (isset($result[$nama_lokalis])) {
                                $result[$nama_lokalis][$value_info] = $value_detail;
                            } else {
                                $result[$nama_lokalis] = [
                                    "SINISTRA" => $value_info === "SINISTRA" ? $value_detail : null,
                                    "nama_lokalis" => $nama_lokalis,
                                    "DEXTRA" => $value_info === "DEXTRA" ? $value_detail : null
                                ];
                            }
                        }

                        $resultChunks = array_chunk($result, ceil(count($result) / 2), true);
                        echo "<div style='display: flex; gap: auto;'>";

                        foreach ($resultChunks as $chunk) {
                            echo "<div style='flex: 1;'>";
                            echo "<table border='1' class='table table-bordered'>";
                            echo "<tr><td class='fw-bold'>Oculus Dextra</td><td class='fw-bold text-center'>Keterangan</td><td class='fw-bold'>Oculus Sinistra</td></tr>";
                            foreach ($chunk as $row) {
                                echo "<tr>";
                                echo "<td>" . ($row['DEXTRA'] ?? '') . "</td>";
                                echo "<td class='text-center'>{$row['nama_lokalis']}</td>";
                                echo "<td>" . ($row['SINISTRA'] ?? '') . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
                        }

                        echo "</div>";
                    }
                    ?>

            <?php endif; ?>
            <?php if (!empty($resumeMedis['val']['pemeriksaan']) && is_array($resumeMedis['val']['pemeriksaan'])) { ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>Catatan Obyektif</b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$resumeMedis['val']['pemeriksaan']) ? @$resumeMedis['val']['pemeriksaan'] : '-'; ?>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php } ?>
            <?php if (!empty($resumeMedis['val']['ats_tipe']) && is_array($resumeMedis['val']['ats_tipe'])) { ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Triage</b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$resumeMedis['val']['ats_tipe']) ? @$resumeMedis['val']['ats_tipe'] : '-'; ?>
                            </p>
                        </td>
                    </tr>
                    <?php if (!empty($resumeMedis['val']['ats_tipe'])): ?>
                    <tr>
                        <td class="p-1">
                            <b><?= @$resumeMedis['val']['ats_tipe']; ?></b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$resumeMedis['val']['ats_item']) ? @$resumeMedis['val']['ats_item'] : '-'; ?>
                            </p>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php if (!empty($resumeMedis['val']['hamil']) && ($resumeMedis['val']['hamil'] === "Hamil")): ?>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>Hamil</b>
                            <p class="m-0 mt-1 p-0">
                                <?= !empty(@$resumeMedis['val']['hamil']) ? @$resumeMedis['val']['hamil'] : '-'; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>Umur Kehamilan</b>
                            <p class="m-0 mt-1 p-0"></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>G</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_g']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>P</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_p']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>A</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['hamil_a']; ?></p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php } ?>


            <div class="row">
                <h4 class="text-start">Assessment (A)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Diagnosis</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['namadiagnosa']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Permasalahan Medis</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['masalah_medis']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Penyebab Cidera / Keracunan</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['penyebab_cidera']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start fw-bold">Planning (P)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <?php if ($resumeMedis['visit']['isrj'] == '0') {
                        ?>
                    <tr>
                        <td class="p-1">
                            <b>Standing Order</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['standing_order']; ?></p>
                        </td>
                    </tr>
                    <?php
                        } ?>
                    <tr>
                        <td class="p-1">
                            <b>Target / Sasaran Terapi</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['sasaran']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Pemeriksaan Diagnostik Penunjang</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Laboratorium</b>
                            <p class="m-0 mt-1 p-0">
                                <?= isset($resumeMedis['val']['laboratorium']) ? nl2br($resumeMedis['val']['laboratorium']) : ''; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Radiologi</b>
                            <p class="m-0 mt-1 p-0">
                                <?= isset($resumeMedis['val']['radiologi']) ? nl2br($resumeMedis['val']['radiologi']) : ''; ?>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Farmakoterapi</b>
                            <p class="m-0 mt-1 p-0">
                                <?= isset($resumeMedis['val']['farmakologia']) ? nl2br($resumeMedis['val']['farmakologia']) : ''; ?>
                            </p>

                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Target / Sasaran Terapi</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['prosedur']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Catatan Procedure</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Standing Order</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['standing_order']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Rencana Tindak Lanjut</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Rencana Tindak Lanjut</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['rencana_tl']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Kontrol</b>
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['kontrol']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (@$resumeMedis['val']['edukasi_pasien']) {
                ?>
            <div class="row">
                <h5 class="text-start">Edukasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <!-- <b>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada:</b> -->
                            <p class="m-0 mt-1 p-0"><?= @$resumeMedis['val']['edukasi_pasien']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
                } ?>

            <div class="col-md-4 text-start">
                <div>Sampangan, <?= tanggal_indo(substr(@$resumeMedis['val']['date_of_diagnosa'], 0, 10)); ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-3" align="center">
                    <br>
                    <div>Dokter</div>
                    <div id="qrcode-container">
                        <div id="qrcodeMedisAll"></div>
                    </div>
                    <p class="p-0 m-0 py-1" id="qrcodeMedis_name">(<?= @$resumeMedis['val']['dokter']; ?>)</p>
                    <p><i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i></p>
                </div>
                <div class="col"></div>
                <div class="col-3" align="center">
                    <div>Penerima Penjelasan</div>
                    <div>
                        <div id="qrcodeMedis1All"></div>
                    </div>
                    <p class="p-0 m-0 py-1" id="">(<?= @$resumeMedis['val']['nama']; ?>)</p>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>
    <script>
    let valMedis3 = <?= json_encode($resumeMedis['val']); ?>;
    let signMedis3 = <?= json_encode($resumeMedis['sign']); ?>;

    signMedis3 = JSON.parse(signMedis3)
    </script>
    <script>
    // $.each(signMedis3, function(key, value) {
    //     if (value.user_type == 1 && value.isvalid == 1) {
    //         var qrcode = new QRCode(document.getElementById("qrcodeMedisAll"), {
    //             text: value?.sign_path ?? "",
    //             width: 70,
    //             height: 70,
    //             colorDark: "#000000",
    //             colorLight: "#ffffff",
    //             correctLevel: QRCode.CorrectLevel.H // High error correction
    //         });
    //         $("#qrcodeMedis_name").html(`(${value.fullname??value.user_id})`)
    //     } else if (value.user_type == 2 && value.isvalid == 1) {
    //         var qrcode1 = new QRCode(document.getElementById("qrcodeMedis1All"), {
    //             text: value?.sign_path ?? "",
    //             width: 70,
    //             height: 70,
    //             colorDark: "#000000",
    //             colorLight: "#ffffff",
    //             correctLevel: QRCode.CorrectLevel.H // High error correction
    //         });
    // $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)
    //     }
    // })


    $.each(signMedis3, function(key, value) {
        if (value.user_type == 1 && value.isvalid == 1) {
            $("#qrcodeMedis_name").html(`(<?= $visit['fullname']; ?>)`)

            $("#qrcodeMedisAll").html('<img class="mt-3" src="data:image/png;base64,' + value.sign_file +
                '" width="400px">')

        } else if (value.user_type == 2 && value.isvalid == 1) {

            $("#mediss-qrcode_name1").html(`(${value.fullname??value.user_id})`)

            const base64ttd_cetak_resumeMedisss_pasien1 = `data:image/gif;base64,${value.sign_file}`

            if (base64ttd_cetak_resumeMedisss_pasien1) {
                cropTransparentPNG(base64ttd_cetak_resumeMedisss_pasien1, (croppedImage) => {
                    if (croppedImage) {
                        $('#qrcodeMedis1All').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                    } else {
                        $('#qrcodeMedis1All').html('');
                    }
                });
            } else {
                $('#qrcodeMedis1All').html('');
            }

            // $("#qrcodeMedis1All").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file +
            //     '" width="400px">')

        } else if (value.user_type == 3 && value.isvalid == 1) {

            $("#mediss-qrcode_name1").html(`(${value.fullname??value.user_id})`)
            const base64ttd_cetak_resumeMedisss_pasien2 = `data:image/gif;base64,${value.sign_file}`

            if (base64ttd_cetak_resumeMedisss_pasien2) {
                cropTransparentPNG(base64ttd_cetak_resumeMedisss_pasien2, (croppedImage) => {
                    if (croppedImage) {
                        $('#qrcodeMedis1All').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                    } else {
                        $('#qrcodeMedis1All').html('');
                    }
                });
            } else {
                $('#qrcodeMedis1All').html('');
            }


            // $("#qrcodeMedis1All").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file +
            //     '" width="400px">')

        }
    })


    setTimeout(() => {
        //window.print()
    }, 2000);
    </script>

    </html>
</div>
<?php
endif;
?>