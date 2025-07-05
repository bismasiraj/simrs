<div class="card bg-light border border-1 rounded-4 mt-4 biodata">
    <div class="card-body">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4 table-biodata-header">
            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14 pointer">
                <!-- update perubahan  familymanTab pointer  04/02/2025-->
                <?= $visit['diantar_oleh']; ?>
                (<?= $visit['no_registration']; ?>)
            </h3>
            <hr>
            <?php
            $file = '';
            if ($visit['gender'] == '1') {
                $file = "uploads\images\profile_male.png";
            } else if ($visit['gender'] == '2') {
                $file = "uploads\images\profile_female.png";
            } else {
                $file = "uploads\images\profile_male.png";
            }

            ?>
            <img width="115" height="115" class="rounded-circle avatar-lg"
                src="<?php echo base_url(); ?><?php echo $file ?>">
        </div>
        <!--./col-lg-5-->
        <div class="col-lg-12 col-md-12 col-sm-12">
            <hr>
            <div class="row text-center">
                <button type="button" name="save" data-loading-text="processing" class="btn btn-primary pull-right btn-spppoli"
                    onclick="closeBillPoli()"><i class="fa fa-check-circle"></i> <span>Selesai</span></button>
            </div>
            <hr>
            <table class="table">
                <tr>
                    <td class="bolds"><?php echo lang('Word.age'); ?></td>
                    <td><?= $visit['age']; ?></td>
                </tr>
                <tr>
                    <td class="bolds">Tanggal Lahir</td>
                    <td><?= date("Y-m-d", strtotime(@$visit['tgl_lahir'])); ?></td>
                </tr>
                <tr>
                    <td class="bolds">Alamat</td>
                    <td><?php echo ($visit['visitor_address']); ?></td>
                </tr>
                <tr>
                    <td class="bolds">NIK</td>
                    <td><?php echo (@$visit['npk']); ?></td>
                </tr>
                <tr>
                    <td class="bolds">Status Asuransi</td>
                    <td><?php echo @$visit['name_of_status_pasien']; ?></td>
                </tr>
                <tr>
                    <td class="bolds">Baru / Lama</td>
                    <td><?php echo @$visit['isnew'] == '0' ? 'Lama' : 'Baru'; ?></td>
                </tr>

                <tr>
                    <td class="bolds">Dokter</td>
                    <?php if ($visit['isrj'] == '0') { ?>
                        <td id="dokter"><?php echo $visit['fullname_inap']; ?></td>
                    <?php } else { ?>
                        <td id="dokter"><?php echo @$visit['fullname']; ?></td>
                    <?php } ?>
                </tr>
                <?php if ($visit['isrj'] == '0') { ?>
                    <tr>
                        <td class="bolds">Tanggal Masuk</td>
                        <td id="visit_date"><?= date("Y-m-d H:i", strtotime(@$visit['visit_datetime'])); ?></td>
                    </tr>
                    <?php if ($visit['keluar_id'] != '0') {
                    ?>
                        <tr>
                            <td class="bolds">Tanggal Keluar</td>
                            <td id="exit_date"><?= date("Y-m-d H:i", strtotime(@$visit['exit_datetime'])); ?></td>
                        </tr>
                    <?php
                    } ?>

                <?php } else { ?>
                    <tr>
                        <td class="bolds">Tanggal</td>
                        <td id="visit_date"><?= date("Y-m-d H:i", strtotime(@$visit['visit_datetime'])); ?></td>
                    </tr>
                <?php } ?>

                <tr>
                    <?php if ($visit['isrj'] == '0' && $visit['class_room_id'] != '') { ?>
                        <td class="bolds">Bangsal</td>
                        <td id="klinik"><?php echo (@$visit['name_of_class_room']); ?></td>
                    <?php } else { ?>
                        <td class="bolds">Poli</td>
                        <td id="klinik"><?php echo @$visit['name_of_clinic']; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="bolds">Alergi</td>
                    <td class="alergi"> - </td>
                </tr>
            </table>
            <hr>
            <table class="table">
                <div id="data-render-assTbc" class="data-render-assTbc">
                    <tr>
                        <td colspan="2" class="skriningsuspect-header fw-bold">
                            <div id="text-content-assTbc" class="btn btn-link pointer btn-show-tbc add">SKRINING SUSPECT
                                TBC
                            </div>
                        </td>

                    </tr>
                </div>
            </table>
            <hr>
            <div class="row text-center mb-4">
                <button type="button" name="familyman" data-loading-text="processing" class="btn btn-primary pull-right familymanTab"><i class="fa fa-home"></i> <span>Keluarga</span></button>
            </div>
            <?php if (false) {
                // if (empty($pasienDiagnosa)) {
            ?>
                <div class="profileRM" style="display: block">
                    <hr class="hr-panel-heading hr-10">
                    <p><b><i class="fa fa-tag"></i> Ringkasan Diagnosis:</b></p>
                    <ul>
                        <li>
                            <div class="rmdescription"></div>
                        </li>
                        <li>
                            <div class="rmdiagnosa_desc_05"></div>
                        </li>
                    </ul>
                    <hr class="hr-panel-heading hr-10">
                    <p><b><i class="fa fa-tag"></i> Riwayat Alergi:</b></p>
                    <ul>
                        <li>
                            <div class="rmdiagnosa_desc_06"></div>
                        </li>
                    </ul>
                    <hr class="hr-panel-heading hr-10">
                    <p><b><i class="fa fa-tag"></i> Anamnesis:</b></p>
                    <ul>
                        <li>
                            <div class="rmanamnase"></div>
                        </li>
                    </ul>
                    <hr class="hr-panel-heading hr-10">
                    <p><b><i class="fa fa-tag"></i> Periksa Fisik:</b></p>
                    <ul>
                        <li>
                            <div class="rmpemeriksaan"></div>
                        </li>
                    </ul>
                    <hr class="hr-panel-heading hr-10">
                    <p><b><i class="fa fa-tag"></i> Periksa Lab:</b></p>
                    <ul>
                        <li>
                            <div class="rmpemeriksaan_02"></div>
                        </li>
                    </ul>
                    <hr class="hr-panel-heading hr-10">
                    <p><b><i class="fa fa-tag"></i> Periksa RO:</b></p>
                    <ul>
                        <li>
                            <div class="rmpemeriksaan_03"></div>
                        </li>
                    </ul>
                    <hr class="hr-panel-heading hr-10">
                    <p><b><i class="fa fa-tag"></i> Pemeriksaan Lain:</b></p>
                    <ul>
                        <li>
                            <div class="rmpemeriksaan_05"></div>
                        </li>
                    </ul>
                    <hr class="hr-panel-heading hr-10">
                    <p><b><i class="fa fa-tag"></i> Terapi:</b></p>
                    <ul>
                        <li>
                            <div class="rmteraphy_desc"></div>
                        </li>
                    </ul>
                    <hr class="hr-panel-heading hr-10">
                    <p><b><i class="fa fa-tag"></i> Instruksi:</b></p>
                    <ul>
                        <li>
                            <div class="rminstruction"></div>
                        </li>
                    </ul>
                </div>
            <?php
            } else { ?>

            <?php } ?>
        </div>
    </div>
</div>