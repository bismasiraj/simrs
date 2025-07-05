<?php
if (!empty($tbc)) :
?>

<div class="page-break portrait">

    <!doctype html>
    <html lang="en">

    <body>
        <div class="container-fluid mt-5">
            <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
                autocomplete="off">


                <div style="display: none;">
                    <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                    <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                    <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
                </div>
                <?php csrf_field(); ?>

                <!-- <br> -->
                <!-- <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div> -->
                <!-- <div class="row">
                <h6 class="text-center pt-2">HASIL PEMERIKSAAN LABORATORIUM</h6>
            </div> -->

                <div class="modal-body" id="skrining-tbc-view">
                    <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php", ['key' => ['title' => 'Laporan Skrining TBC']]) ?>
                    <!-- Tambahkan form dengan id 'form-assTbc' -->
                    <form id="form-assTbc">
                        <input type="hidden" class="form-control" id="org_unit_code-assTbc" name="org_unit_code">
                        <input type="hidden" class="form-control" id="visit_id-assTbc" name="visit_id">
                        <input type="hidden" class="form-control" id="trans_id-assTbc" name="trans_id">
                        <input type="hidden" class="form-control" id="body_id-assTbc" name="body_id">
                        <input type="hidden" class="form-control" id="document_id-assTbc" name="document_id">
                        <input type="hidden" class="form-control" id="no_registration-assTbc" name="no_registration">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col fw-bold" class="text-center">YA</th>
                                    <th scope="col fw-bold" class="text-center">TIDAK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding: 5px; width: 2000px;"><span class="fw-bold">1. Batuk</span></td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['cough']) && $tbc['data']['cough'] === '1' ? '✔' : '' ?>
                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['cough']) && $tbc['data']['cough'] === '0' ? '✔' : '' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">2. Batuk darah</span></td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['hemoptisis']) && $tbc['data']['hemoptisis'] === '1' ? '✔' : '' ?>

                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['hemoptisis']) && $tbc['data']['hemoptisis'] === '0' ? '✔' : '' ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">3. Penurunan BB/Nafsu makan</span></td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['weight_loss']) && $tbc['data']['weight_loss'] === '1' ? '✔' : '' ?>
                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['weight_loss']) && $tbc['data']['weight_loss'] === '0' ? '✔' : '' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">4. Keringat malam</span></td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['hiperhidrosis']) && $tbc['data']['hiperhidrosis'] === '1' ? '✔' : '' ?>

                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['hiperhidrosis']) && $tbc['data']['hiperhidrosis'] === '0' ? '✔' : '' ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">5. Sesak nafas</span></td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['dispnea']) && $tbc['data']['dispnea'] === '1' ? '✔' : '' ?>

                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['dispnea']) && $tbc['data']['dispnea'] === '0' ? '✔' : '' ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">6. Kontak erat dengan pasien TBC</span></td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['close_contact']) && $tbc['data']['close_contact'] === '1' ? '✔' : '' ?>

                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['close_contact']) && $tbc['data']['close_contact'] === '0' ? '✔' : '' ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">7. Ada hasil rontgen pneumonia/mendukung TBC</span></td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['pneumonia']) && $tbc['data']['pneumonia'] === '1' ? '✔' : '' ?>

                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['pneumonia']) && $tbc['data']['pneumonia'] === '0' ? '✔' : '' ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><span class="fw-bold">8. Riwayat penyakit :</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <ul>
                                            <li>DM</li>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['diabetes']) && $tbc['data']['diabetes'] === '1' ? '✔' : '' ?>

                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['diabetes']) && $tbc['data']['diabetes'] === '0' ? '✔' : '' ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <ul>
                                            <li>HIV</li>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['hiv']) && $tbc['data']['hiv'] === '1' ? '✔' : '' ?>

                                    </td>
                                    <td class="text-center">
                                        <?= isset($tbc['data']['hiv']) && $tbc['data']['hiv'] === '0' ? '✔' : '' ?>

                                    </td>
                                </tr>
                                <?php
                                    $suspectKeys = ["cough", "hemoptisis", "weight_loss", "hiperhidrosis", "dispnea", "close_contact", "pneumonia", "diabetes", "hiv"];

                                    $isSuspect = false;
                                    foreach ($suspectKeys as $key) {
                                        if (!empty($tbc['data'][$key]) && $tbc['data'][$key] === '1') {
                                            $isSuspect = true;
                                            break; 
                                        }
                                    }
                                    $conclusionText = $isSuspect ? "TERDUGA TBC" : "BUKAN TERDUGA TBC";
                                    $conclusionValue = $isSuspect ? "1" : "0";
                                    ?>

                                <tr>
                                    <td colspan="3" class="text-center">
                                        <input type="hidden" name="suspect" class="form-control" id="conclusion-val"
                                            value="<?= $conclusionValue ?>">
                                        <strong>Kesimpulan :</strong> <span
                                            id="conclusion"><?= $conclusionText ?></span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <!-- Tombol Save ditambahkan di dalam form -->

                    </form>
                </div>

            </form>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->


    </body>

    <script>

    </script>

    </html>
</div>
<?php
endif;
?>