<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
    table.table-fit {
        width: auto !important;
        table-layout: auto !important;
    }

    table.table-fit thead th,
    table.table-fit tfoot th {
        width: auto !important;
    }

    table.table-fit tbody td,
    table.table-fit tfoot td {
        width: auto !important;
    }
</style>
<div class="tab-pane" id="assessmentigd">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <div class="box-header border-b mb10 pl-0 pt0">
                <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"><?= $visit['diantar_oleh']; ?> (<?= $visit['no_registration']; ?>)</h3>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ptt10">

                    <?php

                    if ($visit['gender'] == '1') {
                        $file = "uploads\images\profile_male.png";
                    } else if ($visit['gender'] == '2') {
                        $file = "uploads\images\profile_female.png";
                    }

                    ?>
                    <img width="115" height="115" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url(); ?><?php echo $file ?>">

                </div><!--./col-lg-5-->
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table class="table tablecustom table-bordered mb0">
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


                    </table>
                </div><!--./col-lg-7-->
            </div><!--./row-->

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


        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">
            <form id="formassessmentigd" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                <div class="modal-body pt0 pb0">
                    <input id="aigdclinic_id" name="clinic_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdclass_room_id" name="class_room_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdkeluar_id" name="keluar_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdemployee_id" name="employee_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdno_registration" name="no_registration" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdvisit_id" name="visit_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdorg_unit_code" name="org_unit_code" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigddoctor" name="doctor" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdkal_id" name="kal_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdtheid" name="theid" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdthename" name="thename" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdtheaddress" name="theaddress" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdstatus_pasien_id" name="status_pasien_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdisrj" name="isrj" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdgender" name="gender" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdageyear" name="ageyear" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdagemonth" name="agemonth" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdageday" name="ageday" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdbody_id" name="body_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdmodified_by" name="modified_by" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdpasien_diagnosa_id" name="pasien_diagnosa_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdassessment_type" name="assessment_type" placeholder="" type="text" class="form-control block" value="" style="display: none" />

                    <div class="row">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <table class="table tablecustom table-bordered mb0">
                                    <tr>
                                        <td class="bolds">
                                            Tanggal-Jam Keberangkatan
                                        </td>
                                        <td>
                                            <input type="text" name="examination_date" id="aigdexamination_date" placeholder="" value="" class="form-control">
                                        </td>
                                        <td class="bolds">
                                            Rujukan
                                        </td>
                                        <td>
                                            <label class="radio-inline"><input type="radio" value="1" name="t_01">Ya</label>
                                            <label class="radio-inline"><input type="radio" value="0" name="t_01" checked>Tidak</label>
                                        </td>
                                        <td class="bolds">
                                            Dari:
                                        </td>
                                        <td>
                                            <input type="text" name="v_01" id="aigdv_01" placeholder="" value="" class="form-control">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="bolds">
                                            Kasus
                                        </td>
                                        <td colspan="5">
                                            <label class="radio-inline"><input type="radio" value="1" name="t_02">Trauma</label>
                                            <label class="radio-inline"><input type="radio" value="2" name="t_02">Non Trauma</label>
                                            <label class="radio-inline"><input type="radio" value="3" name="t_02">True Emergency</label>
                                            <label class="radio-inline"><input type="radio" value="4" name="t_02">False Emergency</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            Riwayat Alergi
                                        </td>
                                        <td>
                                            <label class="radio-inline"><input type="radio" value="1" name="t_04">Ya</label>
                                            <label class="radio-inline"><input type="radio" value="0" name="t_04" checked>Tidak</label>
                                        </td>
                                        <td class="bolds">
                                            Yaitu Obat-obatan:
                                        </td>
                                        <td>
                                            <input type="text" name="riwayat_alergi" id="aigdriwayat_alergi" placeholder="" value="" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">

                                        </td>
                                        <td>
                                        </td>
                                        <td class="bolds">
                                            Makanan:
                                        </td>
                                        <td>
                                            <input type="text" name="v_02" id="aigdv_02" placeholder="" value="" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">

                                        </td>
                                        <td>
                                        </td>
                                        <td class="bolds">
                                            Lingkungan:
                                        </td>
                                        <td>
                                            <input type="text" name="v_03" id="aigdv_03" placeholder="" value="" class="form-control">
                                        </td>
                                    </tr>
                                </table>
                                <h3>
                                    ANAMNESIS (Alasasan Masuk Rumah Sakit Serta Riwayat Penyakit Yang Positif)
                                </h3>
                                <table class="table tablecustom table-bordered mb0">
                                    <tr>
                                        <td class="bolds">
                                            Auto/Alloanamnesis dengan
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="alloanamnesis_contact" id="aigdalloanamnesis_contact" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                        <td class="bolds">
                                            Hubungan dengan pasien
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="alloanamnesis_hub" id="aigdalloanamnesis_hub" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="bolds">
                                            Anamnesis
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="anamnase" id="aigdanamnase" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            Riwayat Penyakit Dahulu
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="diagnosa_history" id="aigddiagnosa_history" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            Riwayat Pengobatan
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="riwayat_obat" id="aigdriwayat_obat" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                </table>
                                <h3>
                                    Pemeriksaan Fisik
                                </h3>
                                <table class="table tablecustom table-bordered mb0">
                                    <thead>
                                        <tr>
                                            <th colspan="3" style="width: 12.5%;">Tekanan Darah</th>
                                            <th style="width: 12.5%;">Nadi</th>
                                            <th style="width: 12.5%;">RR</th>
                                            <th style="width: 12.5%;">SpO2</th>
                                            <th style="width: 12.5%;">Suhu</th>
                                            <th style="width: 12.5%;">Nyeri</th>
                                            <th style="width: 12.5%;">BB</th>
                                            <th style="width: 12.5%;">TB</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="tension_upper" id="aigdtension_upper" placeholder="" value="" class="form-control">
                                                <!-- <div class="col-sm-12" style="display: flex;  align-items: center;">
                                                    <input type="text" name="tension_upper" id="aigdtension_upper" placeholder="" value="" class="form-control">
                                                    <h4>/</h4>
                                                    <input type="text" name="tension_below" id="aigdtension_below" placeholder="" value="" class="form-control">
                                                </div> -->
                                            </td>
                                            <td>/</td>
                                            <td>
                                                <input onchange="assessmentIgdInput(this)" type="text" name="tension_below" id="aigdtension_below" placeholder="" value="" class="form-control">
                                            </td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="nadi" id="aigdnadi" placeholder="" value="" class="form-control"></td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="nafas" id="aigdnafas" placeholder="" value="" class="form-control"></td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="saturasi" id="aigdsaturasi" placeholder="" value="" class="form-control"></td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="temperature" id="aigdtemperature" placeholder="" value="" class="form-control"></td>
                                            <td>
                                                <label class="radio-inline"><input type="radio" value="1" name="t_012">Ya</label>
                                                <label class="radio-inline"><input type="radio" value="0" name="t_012" checked>Tidak</label>
                                            </td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="weight" id="aigdweight" placeholder="" value="" class="form-control"></td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="height" id="aigdheight" placeholder="" value="" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table tablecustom table-bordered mb0">

                                    <tr>
                                        <td class="bolds">
                                            Pemeriksaan
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="pemeriksaan" id="aigdpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                        <td class="bolds">
                                            Status Lokalis
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="lokalis" id="aigdlokalis" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                    </tr>

                                    <tr>
                                        <td class="bolds">
                                            Laboratorium
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="v_33" id="aigdv_33" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            Radiologi
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="v_34" id="aigdv_34" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            EKG
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="v_35" id="aigdv_35" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            Diagnosis
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="diagnosa_desc" id="aigddiagnosa_desc" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table tablecustom table-bordered mb0">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%;">Tekanan Darah</th>
                                            <th style="width: 50%;">Masalah Medis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="col-md-12"><textarea name="v_36" id="aigdv_36" placeholder="" value="" class="form-control"></textarea></div>
                                            </td>
                                            <td>
                                                <div class="col-md-12"><textarea name="v_37" id="aigdv_37" placeholder="" value="" class="form-control"></textarea></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bolds" colspan="2">
                                                Rencana Asuhan / Terapi / Instruksi di IGD (Berikan Keterangan waktu/Jam jika sudah dilaksanakan)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="col-md-12"><textarea name="instruction" id="aigdinstruction" placeholder="" value="" class="form-control"></textarea></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bolds" colspan="2">
                                                Sasaran
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="col-md-12"><textarea name="description" id="aigddescription" placeholder="" value="" class="form-control"></textarea></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h3>Tindak Lanjut</h3>
                                <table class="table tablecustom table-bordered mb0">
                                    <tbody>
                                        <tr>
                                            <td class="bolds">
                                                <input type="checkbox" id="aigdpulang" name="pulang">
                                                <label for="aigdpulang"> Pulang</label><br>
                                            </td>
                                            <td>
                                                <label class="radio-inline"><input type="radio" value="1" name="t_010">Atas Ijin Dokter</label>
                                                <label class="radio-inline"><input type="radio" value="2" name="t_010">Atas Permintaan Sendiri</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bolds">
                                                <input type="checkbox" id="aigdranap" name="ranap">
                                                <label for="ranap"> Rawat Inap</label><br>
                                            </td>
                                            <td>
                                                <label class="radio-inline"><input type="radio" value="3" name="t_010">Rawat Inap</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bolds">
                                                <input type="checkbox" id="aigddirujuk" name="dirujuk">
                                                <label for="dirujuk"> Dirujuk</label><br>
                                            </td>
                                            <td>
                                                <label class="radio-inline"><input type="radio" value="3" name="t_011">Tempat Penuh</label>
                                                <label class="radio-inline"><input type="radio" value="3" name="t_011">Perlu Fasilitas Lebih</label>
                                                <label class="radio-inline"><input type="radio" value="3" name="t_011">Permintaan Pasien/Keluarga</label>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bolds">
                                                <input type="checkbox" id="aigddirujuk" name="dirujuk">
                                                <label for="aigddirujuk"> Meninggal</label><br>
                                            </td>
                                            <td>
                                                Tanggal dan Jam
                                            </td>
                                            <td>
                                                <div class="col-md-2"><input type='text' name="v_31" class="form-control" id='aigdv_31' /></div>
                                            </td>
                                            <script type="text/javascript">
                                                $(function() {
                                                    $('#aigdexamination_date').datetimepicker({
                                                        format: 'YYYY-MM-DD hh:mm:ss'
                                                    });
                                                });
                                            </script>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table tablecustom table-bordered mb0">
                                    <tr>
                                        <td class="bolds" colspan="2">
                                            Rencana Asuhan / Terapi / Instruksi di IGD (Berikan Keterangan waktu/Jam jika sudah dilaksanakan)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="col-md-12"><textarea name="teraphy_desc" id="aigdteraphy_desc" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds" colspan="2">
                                            Catatan Penting (Kondisi saat keluar IGD)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="col-md-12"><textarea name="diagnosa_kerja" id="aigddiagnosa_kerja" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table tablecustom table-bordered mb0">
                                    <tr>
                                        <td class="bolds">Tanggal Jam Edukasi</td>
                                        <td>
                                            <div class="col-md-2"><input type='text' name="education_date" class="form-control" id='aigdeducation_date' /></div>
                                        </td>
                                        <script type="text/javascript">
                                            $(function() {
                                                $('#aigdeducation_date').datetimepicker({
                                                    format: 'YYYY-MM-DD hh:mm:ss'
                                                });
                                            });
                                        </script>
                                    </tr>
                                    <tr>
                                        <td class="bolds">Penerima Edukasi</td>
                                        <td>
                                            <div class="col-md-12"><textarea name="v_39" id="aigdv_39" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                        <td class="bolds">Lainnya</td>
                                        <td>
                                            <div class="col-md-12"><textarea name="v_40" id="aigdv_40" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                </table>
                            </div><!--./col-lg-7-->
                        </div><!--./row-->
                        <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <label for="examination_date">Tgl Periksa</label>
                                <input type='text' name="examination_date" class="form-control" id='examination_date' />
                            </div>

                        </div> -->
                        <div class="col-sm-6" style="display: none;">
                            <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="aigdpetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="submit" id="formassessmentigdsubmit" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                        <button type="button" id="formassessmentigdedit" onclick="enableAssessmentIgd()" style="display: none;" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--./row-->

</div>
<!-- -->



<script type='text/javascript'>
    var mrJson;
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    var examForassessment = <?= json_encode($exam); ?>;
    $(document).ready(function(e) {
        var nomor = '<?= $visit['no_registration']; ?>';
        var ke = '%'
        var mulai = '2023-08-01' //tidak terpakai
        var akhir = '2023-08-31' //tidak terpakai
        var lunas = '%'
        // var klinik = '<?= $visit['clinic_id']; ?>'
        var klinik = '%'
        var rj = '%'
        var status = '%'
        var nota = '%'
        var trans = '<?= $visit['trans_id']; ?>'
        var visit = '<?= $visit['visit_id']; ?>'
        $("#aigdexamination_date").val(get_date())
        getAssessmentIgd(visit)
    })

    function get_bodyid() {
        var m = new Date();
        m.setHours(m.getHours() + 7)
        var dateString = m.getUTCFullYear() + "-" + String(m.getUTCMonth() + 1 + 100).substring(1, 3) + "-" + String(m.getUTCDate() + 100).substring(1, 3) + " " + String(m.getUTCHours() + 100).substring(1, 3) + ":" + String(m.getUTCMinutes() + 100).substring(1, 3) + ":" + String(m.getUTCSeconds() + 100).substring(1, 3);
        return dateString;
    }

    $("#aigdweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdnadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdsaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdnafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdarm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });



    function assessmentIgdInput(prop) {
        var value = $(prop).val()
        value = (Number(value.replace(/[^\d+(\.\d{1,2})$]/g, '')).toFixed(2))

        console.log(prop.id)

        if (prop.id == "aigdtemperature") {
            // Number(GetText( )) < 50 and Number(GetText( )) > 10
            if (value < 10)
                value = 10.00

            if (value > 50)
                value = 50.00
        }
        if (prop.id == "aigdtension_upper") {
            // Number(GetText()) < 250 and Number(GetText()) > 50
            if (value < 50)
                value = 50.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "aigdnadi") {
            //Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }
        if (prop.id == "aigdweight") {
            // Number(GetText( )) < 500
            if (value > 500)
                value = 500.00
        }
        if (prop.id == "aigdheight") {
            // Number(GetText( )) between 30 and 250
            if (value < 30)
                value = 30.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "aigdtension_below") {
            // Number(GetText( )) between 0 and 300
            if (value < 0)
                value = 0.00

            if (value > 300)
                value = 300.00
        }
        if (prop.id == "aigdtension_below") {
            // Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }

        $(prop).val(value)
    }


    function setDataassessmentIgd() {
        if (typeof $("#aigdbody_id").val() !== 'undefined' || $("#aigdbody_id").val() == "") {
            // $("#aigdbody_id").val((get_bodyid() + String(Math.floor(Math.random() * 1000))).replaceAll(' ', '').replaceAll('-', '').replaceAll(':', ''))
            $("#aigdno_registration").val('<?= $visit['no_registration']; ?>')
            $("#aigdvisit_id").val('<?= $visit['visit_id']; ?>')
            $("#aigdorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
            $("#aigdclinic_id").val('<?= $visit['clinic_id']; ?>')
            $("#aigdclass_room_id").val('<?= $visit['class_room_id']; ?>')
            $("#aigdbed_id").val()
            $("#aigdkeluar_id").val('<?= $visit['keluar_id']; ?>')
            $("#aigdemployee_id").val('<?= $visit['employee_id']; ?>')
            $("#aigddoctor").val('<?= $visit['fullname']; ?>')
            $("#aigdexamination_date").val(get_date())
            $("#aigdkal_id").val('<?= $visit['kal_id']; ?>')
            $("#aigdassessment_type").val('2')
            $("#aigdtheid").val('<?= $visit['pasien_id']; ?>')
            $("#aigdthename").val('<?= $visit['diantar_oleh']; ?>')
            $("#aigdtheaddress").val('<?= $visit['visitor_address']; ?>')
            $("#aigdstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
            $("#aigdisrj").val('<?= $visit['isrj']; ?>')
            $("#aigdgender").val('<?= $visit['gender']; ?>')
            $("#aigdageyear").val('<?= $visit['ageyear']; ?>')
            $("#aigdagemonth").val('<?= $visit['agemonth']; ?>')
            $("#aigdageday").val('<?= $visit['ageday']; ?>')

            if (typeof $("#aigdriwayat_alergi").val() !== 'undefined' || $("#aigdriwayat_alergi").val() == "") {
                $("#t_04").val(2)
            }

            <?php if (isset($pasienDiagnosa['pasien_diagnosa_id'])) { ?>

                $("#aigdanamnase").val('<?= $pasienDiagnosa['anamnase']; ?>')
                $("#aigddiagnosa_desc").val('<?= $pasienDiagnosa['diagnosa_id'] . '-' . $pasienDiagnosa['diagnosa_desc']; ?>')
                $("#aigdanamnase").val('<?= $pasienDiagnosa['anamnase']; ?>')
                $("#aigdv_07").val('<?= $pasienDiagnosa['pemeriksaan']; ?>')
                $("#aigdv_33").val('<?= $pasienDiagnosa['pemeriksaan_02']; ?>')
                $("#aigdv_34").val('<?= $pasienDiagnosa['pemeriksaan_03']; ?>')
                $("#aigdv_35").val('<?= $pasienDiagnosa['pemeriksaan_05']; ?>')
                $("#aigdteraphy_desc").val('<?= $pasienDiagnosa['teraphy_desc']; ?>')
                $("#aiginstruction").val('<?= $pasienDiagnosa['instruction']; ?>')
                $("#aigeducation_date").val(get_date())
            <?php } ?>

            var diagnosaHistory = '<?php foreach ($pasienDiagnosaAll as $key => $value) {
                                        echo "(" . $pasienDiagnosaAll[$key]['diagnosa_id'] . ")" . $pasienDiagnosaAll[$key]['diagnosa_desc'] . ",";
                                    } ?>';

            examForassessment.forEach((element, key) => {
                var exam = examForassessment[key]
                $("#aigdweight").val(exam.weight)
                $("#aigdheight").val(exam.height)
                $("#aigdtension_upper").val(exam.tension_upper)
                $("#aigdtension_below").val(exam.tension_below)
                $("#aigdnadi").val(exam.nadi)
                $("#aigdtemperature").val(exam.temperature)
                $("#aigdsaturasi").val(exam.saturasi)

            });

        }
    }



    function getAssessmentIgd(visit) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getAssessmentIgd',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                data.forEach((element, key) => {
                    $('#clinic_id').val(data[key].clinic_id)
                    $('#aigdclass_room_id').val(data[key].class_room_id)
                    $('#aigdkeluar_id').val(data[key].keluar_id)
                    $('#aigdemployee_id').val(data[key].employee_id)
                    $('#aigdno_registration').val(data[key].no_registration)
                    $('#aigdvisit_id').val(data[key].visit_id)
                    $('#aigdorg_unit_code').val(data[key].org_unit_code)
                    $('#aigddoctor').val(data[key].doctor)
                    $('#aigdkal_id').val(data[key].kal_id)
                    $('#aigdtheid').val(data[key].theid)
                    $('#aigdthename').val(data[key].thename)
                    $('#aigdtheaddress').val(data[key].theaddress)
                    $('#aigdstatus_pasien_id').val(data[key].status_pasien_id)
                    $('#aigdisrj').val(data[key].isrj)
                    $('#aigdgender').val(data[key].gender)
                    $('#aigdageyear').val(data[key].ageyear)
                    $('#aigdagemonth').val(data[key].agemonth)
                    $('#aigdageday').val(data[key].ageday)
                    $('#aigdbody_id').val(data[key].body_id)
                    $('#aigdmodified_by').val(data[key].modified_by)
                    $('#aigdpasien_diagnosa_id').val(data[key].pasien_diagnosa_id)
                    $('#aigdassessment_type').val(data[key].assessment_type)
                    $('#aigdexamination_date').val(data[key].examination_date)
                    $("input[name=t_01][value=" + data[key].t_01 + "]").prop('checked', true);
                    $('#aigdv_01').val(data[key].v_01)
                    $('#aigdt_02').val(data[key].t_02)
                    $("input[name=t_02][value=" + data[key].t_02 + "]").prop('checked', true);
                    $('#aigdt_04').val(data[key].t_04)
                    $("input[name=t_04][value=" + data[key].t_04 + "]").prop('checked', true);
                    $('#aigdriwayat_alergi').val(data[key].riwayat_alergi)
                    $('#aigdv_02').val(data[key].v_02)
                    $('#aigdv_03').val(data[key].v_03)
                    $('#aigdalloanamnesis_contact').val(data[key].alloanamnesis_contact)
                    $('#aigdalloanamnesis_hub').val(data[key].alloanamnesis_hub)
                    $('#aigdanamnase').val(data[key].anamnase)
                    $('#aigddiagnosa_history').val(data[key].diagnosa_history)
                    $('#aigdriwayat_obat').val(data[key].riwayat_obat)
                    $('#aigdtension_upper').val(data[key].tension_upper)
                    $('#aigdtension_below').val(data[key].tension_below)
                    $('#aigdnadi').val(data[key].nadi)
                    $('#aigdnafas').val(data[key].nafas)
                    $('#aigdsaturasi').val(data[key].saturasi)
                    $('#aigdtemperature').val(data[key].temperature)
                    $('#aigdt_012').val(data[key].t_012)
                    $("input[name=t_012][value=" + data[key].t_012 + "]").prop('checked', true);
                    $('#aigdweight').val(data[key].weight)
                    $('#aigdheight').val(data[key].height)
                    $('#aigdpemeriksaan').val(data[key].pemeriksaan)
                    $('#aigdlokalis').val(data[key].lokalis)
                    $('#aigdv_33').val(data[key].v_33)
                    $('#aigdv_34').val(data[key].v_34)
                    $('#aigdv_35').val(data[key].v_35)
                    $('#aigddiagnosa_desc').val(data[key].diagnosa_desc)
                    $('#aigdv_36').val(data[key].v_36)
                    $('#aigdv_37').val(data[key].v_37)
                    $('#aigdinstruction').val(data[key].instruction)
                    $('#aigddescription').val(data[key].description)
                    $('#aigdt_010').val(data[key].t_010)
                    $("input[name=t_010][value=" + data[key].t_010 + "]").prop('checked', true);
                    $("input[name=t_011][value=" + data[key].t_011 + "]").prop('checked', true);
                    $('#aigdt_011').val(data[key].t_011)
                    $('#aigddirujuk').val(data[key].dirujuk)
                    $('#aigdv_31').val(data[key].v_31)
                    $('#aigdteraphy_desc').val(data[key].teraphy_desc)
                    $('#aigddiagnosa_kerja').val(data[key].diagnosa_kerja)
                    $('#aigdeducation_date').val(data[key].education_date)
                    $('#aigdv_39').val(data[key].v_39)
                    $('#aigdv_40').val(data[key].v_40)
                    $('#aigdpetugas').val(data[key].petugas)

                    disableAssessmentIgd()
                });
                if (data.length == 0) {
                    setDataassessmentIgd()
                }
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                // clicked_submit_btn.button('reset');
            },
            complete: function() {
                // clicked_submit_btn.button('reset');
            }
        });
    }



    $("#formassessmentigd").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/assessmentigd',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(data.message);
                    disableAssessmentIgd()
                    $("#formassessmentigdsubmit").toggle()
                    $("#formassessmentigdedit").toggle()
                }
                clicked_submit_btn.button('reset');
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));

    function disableAssessmentIgd() {
        $('#clinic_id').prop('disabled', true)
        $('#aigdclass_room_id').prop('disabled', true)
        $('#aigdkeluar_id').prop('disabled', true)
        $('#aigdemployee_id').prop('disabled', true)
        $('#aigdno_registration').prop('disabled', true)
        $('#aigdvisit_id').prop('disabled', true)
        $('#aigdorg_unit_code').prop('disabled', true)
        $('#aigddoctor').prop('disabled', true)
        $('#aigdkal_id').prop('disabled', true)
        $('#aigdtheid').prop('disabled', true)
        $('#aigdthename').prop('disabled', true)
        $('#aigdtheaddress').prop('disabled', true)
        $('#aigdstatus_pasien_id').prop('disabled', true)
        $('#aigdisrj').prop('disabled', true)
        $('#aigdgender').prop('disabled', true)
        $('#aigdageyear').prop('disabled', true)
        $('#aigdagemonth').prop('disabled', true)
        $('#aigdageday').prop('disabled', true)
        $('#aigdbody_id').prop('disabled', true)
        $('#aigdmodified_by').prop('disabled', true)
        $('#aigdpasien_diagnosa_id').prop('disabled', true)
        $('#aigdassessment_type').prop('disabled', true)
        $('#aigdexamination_date').prop('disabled', true)
        $('#aigdv_01').prop('disabled', true)
        $('#aigdt_02').prop('disabled', true)
        $('#aigdt_04').prop('disabled', true)
        $('#aigdriwayat_alergi').prop('disabled', true)
        $('#aigdv_02').prop('disabled', true)
        $('#aigdv_03').prop('disabled', true)
        $('#aigdalloanamnesis_contact').prop('disabled', true)
        $('#aigdalloanamnesis_hub').prop('disabled', true)
        $('#aigdanamnase').prop('disabled', true)
        $('#aigddiagnosa_history').prop('disabled', true)
        $('#aigdriwayat_obat').prop('disabled', true)
        $('#aigdtension_upper').prop('disabled', true)
        $('#aigdtension_below').prop('disabled', true)
        $('#aigdnadi').prop('disabled', true)
        $('#aigdnafas').prop('disabled', true)
        $('#aigdsaturasi').prop('disabled', true)
        $('#aigdtemperature').prop('disabled', true)
        $('#aigdt_012').prop('disabled', true)
        $('#aigdweight').prop('disabled', true)
        $('#aigdheight').prop('disabled', true)
        $('#aigdpemeriksaan').prop('disabled', true)
        $('#aigdlokalis').prop('disabled', true)
        $('#aigdv_33').prop('disabled', true)
        $('#aigdv_34').prop('disabled', true)
        $('#aigdv_35').prop('disabled', true)
        $('#aigddiagnosa_desc').prop('disabled', true)
        $('#aigdv_36').prop('disabled', true)
        $('#aigdv_37').prop('disabled', true)
        $('#aigdinstruction').prop('disabled', true)
        $('#aigddescription').prop('disabled', true)
        $('#aigdt_010').prop('disabled', true)
        $('#aigdt_011').prop('disabled', true)
        $('#aigddirujuk').prop('disabled', true)
        $('#aigdv_31').prop('disabled', true)
        $('#aigdteraphy_desc').prop('disabled', true)
        $('#aigddiagnosa_kerja').prop('disabled', true)
        $('#aigdeducation_date').prop('disabled', true)
        $('#aigdv_39').prop('disabled', true)
        $('#aigdv_40').prop('disabled', true)
        $('#aigdpetugas').prop('disabled', true)
        $("input[name=t_01]").prop('disabled', true);
        $("input[name=t_02]").prop('disabled', true);
        $("input[name=t_04]").prop('disabled', true);
        $("input[name=t_012]").prop('disabled', true);
        $("input[name=t_010]").prop('disabled', true);
        $("input[name=t_011]").prop('disabled', true);

    }

    function enableAssessmentIgd() {
        $('#clinic_id').prop('disabled', false)
        $('#aigdclass_room_id').prop('disabled', false)
        $('#aigdkeluar_id').prop('disabled', false)
        $('#aigdemployee_id').prop('disabled', false)
        $('#aigdno_registration').prop('disabled', false)
        $('#aigdvisit_id').prop('disabled', false)
        $('#aigdorg_unit_code').prop('disabled', false)
        $('#aigddoctor').prop('disabled', false)
        $('#aigdkal_id').prop('disabled', false)
        $('#aigdtheid').prop('disabled', false)
        $('#aigdthename').prop('disabled', false)
        $('#aigdtheaddress').prop('disabled', false)
        $('#aigdstatus_pasien_id').prop('disabled', false)
        $('#aigdisrj').prop('disabled', false)
        $('#aigdgender').prop('disabled', false)
        $('#aigdageyear').prop('disabled', false)
        $('#aigdagemonth').prop('disabled', false)
        $('#aigdageday').prop('disabled', false)
        $('#aigdbody_id').prop('disabled', false)
        $('#aigdmodified_by').prop('disabled', false)
        $('#aigdpasien_diagnosa_id').prop('disabled', false)
        $('#aigdassessment_type').prop('disabled', false)
        $('#aigdexamination_date').prop('disabled', false)
        $('#aigdv_01').prop('disabled', false)
        $('#aigdt_02').prop('disabled', false)
        $('#aigdt_04').prop('disabled', false)
        $('#aigdriwayat_alergi').prop('disabled', false)
        $('#aigdv_02').prop('disabled', false)
        $('#aigdv_03').prop('disabled', false)
        $('#aigdalloanamnesis_contact').prop('disabled', false)
        $('#aigdalloanamnesis_hub').prop('disabled', false)
        $('#aigdanamnase').prop('disabled', false)
        $('#aigddiagnosa_history').prop('disabled', false)
        $('#aigdriwayat_obat').prop('disabled', false)
        $('#aigdtension_upper').prop('disabled', false)
        $('#aigdtension_below').prop('disabled', false)
        $('#aigdnadi').prop('disabled', false)
        $('#aigdnafas').prop('disabled', false)
        $('#aigdsaturasi').prop('disabled', false)
        $('#aigdtemperature').prop('disabled', false)
        $('#aigdt_012').prop('disabled', false)
        $('#aigdweight').prop('disabled', false)
        $('#aigdheight').prop('disabled', false)
        $('#aigdpemeriksaan').prop('disabled', false)
        $('#aigdlokalis').prop('disabled', false)
        $('#aigdv_33').prop('disabled', false)
        $('#aigdv_34').prop('disabled', false)
        $('#aigdv_35').prop('disabled', false)
        $('#aigddiagnosa_desc').prop('disabled', false)
        $('#aigdv_36').prop('disabled', false)
        $('#aigdv_37').prop('disabled', false)
        $('#aigdinstruction').prop('disabled', false)
        $('#aigddescription').prop('disabled', false)
        $('#aigdt_010').prop('disabled', false)
        $('#aigdt_011').prop('disabled', false)
        $('#aigddirujuk').prop('disabled', false)
        $('#aigdv_31').prop('disabled', false)
        $('#aigdteraphy_desc').prop('disabled', false)
        $('#aigddiagnosa_kerja').prop('disabled', false)
        $('#aigdeducation_date').prop('disabled', false)
        $('#aigdv_39').prop('disabled', false)
        $('#aigdv_40').prop('disabled', false)
        $('#aigdpetugas').prop('disabled', false)
        $("input[name=t_01]").prop('disabled', false);
        $("input[name=t_02]").prop('disabled', false);
        $("input[name=t_04]").prop('disabled', false);
        $("input[name=t_012]").prop('disabled', false);
        $("input[name=t_010]").prop('disabled', false);
        $("input[name=t_011]").prop('disabled', false);

        $("#formassessmentigdsubmit").toggle()
        $("#formassessmentigdedit").toggle()
    }
</script>