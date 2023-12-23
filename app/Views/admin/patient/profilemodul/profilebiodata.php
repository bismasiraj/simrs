<div class="card bg-light border border-1 rounded-4 m-4">
    <div class="card-body">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4 table-biodata-header">
            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"><?= $visit['diantar_oleh']; ?> (<?= $visit['no_registration']; ?>)</h3>
            <hr>
            <?php

            if ($visit['gender'] == '1') {
                $file = "uploads\images\profile_male.png";
            } else if ($visit['gender'] == '2') {
                $file = "uploads\images\profile_female.png";
            }

            ?>
            <img width="115" height="115" class="rounded-circle avatar-lg" src="<?php echo base_url(); ?><?php echo $file ?>">

        </div><!--./col-lg-5-->
        <div class="col-lg-12 col-md-12 col-sm-12">
            <table class="table">
                <tr>
                    <td class="bolds"><?php echo lang('Word.age'); ?></td>
                    <td id="age"><?= $visit['age']; ?></td>
                </tr>
                <tr>
                    <td class="bolds">Alamat</td>
                    <td id="address"><?php echo $visit['visitor_address']; ?></td>
                </tr>

                <tr>
                    <td class="bolds">Dokter</td>
                    <td id="dokter"><?php echo $visit['fullname']; ?></td>
                </tr>
                <?php if (!is_null($visit['class_room_id'])) { ?>
                    <tr>
                        <td class="bolds">Tanggal Masuk</td>
                        <td id="visit_date"><?php echo $visit['visit_date']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolds">Tanggal Keluar</td>
                        <td id="exit_date"><?php echo $visit['exit_date']; ?></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td class="bolds">Tanggal</td>
                        <td id="visit_date"><?php echo $visit['visit_date']; ?></td>
                    </tr>
                <?php } ?>

                <tr>
                    <?php if (!is_null($visit['class_room_id'])) { ?>
                        <td class="bolds">Bangsal</td>
                        <td id="klinik"><?php echo ($visit['name_of_class']); ?></td>
                    <?php } else { ?>
                        <td class="bolds">Poli</td>
                        <td id="klinik"><?php echo $visit['name_of_clinic']; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="bolds">Alergi</td>
                    <td class="alergi"> - </td>
                </tr>


            </table>
            <?php if (!empty($pasienDiagnosa)) {
            ?>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Ringkasan Diagnosis:</b></p>
                <ul>
                    <li>
                        <div class="rmdescription"><?= $pasienDiagnosa['description']; ?></div>
                    </li>
                    <li>
                        <div><?= $pasienDiagnosa['diagnosa_desc_05']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Riwayat Alergi:</b></p>
                <ul>
                    <li>
                        <div class="rmdiagnosa_desc_06"><?= $pasienDiagnosa['diagnosa_desc_06']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Anamnesis:</b></p>
                <ul>
                    <li>
                        <div class="rmanamnase"><?= $pasienDiagnosa['anamnase']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Periksa Fisik:</b></p>
                <ul>
                    <li>
                        <div class="rmpemeriksaan"><?= $pasienDiagnosa['pemeriksaan']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Periksa Lab:</b></p>
                <ul>
                    <li>
                        <div class="rmpemeriksaan_02"><?= $pasienDiagnosa['pemeriksaan_02']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Periksa RO:</b></p>
                <ul>
                    <li>
                        <div class="rmpemeriksaan_03"><?= $pasienDiagnosa['pemeriksaan_03']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Pemeriksaan Lain:</b></p>
                <ul>
                    <li>
                        <div class="rmpemeriksaan_05"><?= $pasienDiagnosa['pemeriksaan_05']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Terapi:</b></p>
                <ul>
                    <li>
                        <div class="rmteraphy_desc"><?= $pasienDiagnosa['teraphy_desc']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Instruksi:</b></p>
                <ul>
                    <li>
                        <div class="rminstruction"><?= $pasienDiagnosa['instruction']; ?></div>
                    </li>
                </ul>
            <?php
            } ?>
        </div><!--./col-lg-7-->
    </div>
</div>