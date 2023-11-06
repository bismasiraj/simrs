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
<div class="tab-pane" id="vitalsign" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <div class="box-header border-b mb10 pl-0 pt0">
                <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"><?= $visit['diantar_oleh']; ?> (<?= $visit['no_registration']; ?>)</h3>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 mb-4 table-biodata-header">

                    <?php

                    if ($visit['gender'] == '1') {
                        $file = "uploads\images\profile_male.png";
                    } else if ($visit['gender'] == '2') {
                        $file = "uploads\images\profile_female.png";
                    }

                    ?>
                    <img width="115" height="115" class="rounded-circle avatar-lg" src="<?php echo base_url(); ?><?php echo $file ?>">

                </div><!--./col-lg-5-->
                <hr>
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
            <form id="formvitalsign" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                <div class="modal-body pt0 pb0">
                    <input id="aeclinic_id" name="clinic_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeclass_room_id" name="class_room_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aebed_id" name="bed_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aekeluar_id" name="keluar_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeemployee_id" name="employee_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeno_registration" name="no_registration" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aevisit_id" name="visit_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeorg_unit_code" name="org_unit_code" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aedoctor" name="doctor" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aekal_id" name="kal_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aetheid" name="theid" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aethename" name="thename" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aetheaddress" name="theaddress" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aestatus_pasien_id" name="status_pasien_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeisrj" name="isrj" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aegender" name="gender" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeageyear" name="ageyear" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeagemonth" name="agemonth" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aeageday" name="ageday" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aebody_id" name="body_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aemodified_by" name="modified_by" placeholder="" type="text" class="form-control block" value="" style="display: none" />

                    <div class="row">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <table class="table tablecustom table-bordered mb0">
                                    <!-- <tr>
                                        <td>
                                            <h4 class="bolds">
                                                (S) Anamnesis
                                            </h4>
                                        </td>
                                        <td id="address">
                                            <div class="col-md-12"><textarea name="anamnase" id="aeanamnase" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h4 class="bolds">
                                                (O) Pemeriksaan Fisik
                                            </h4>
                                        </td>
                                        <td id="dokter">

                                            <div class="col-sm-2">
                                                <div class="form-group"><label>BB(Kg)</label><input type="text" name="weight" id="aeweight" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Tinggi(cm)</label><input type="text" name="height" id="aeheight" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Suhu(°C)</label><input type="text" name="temperature" id="aetemperature" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Nadi(/menit)</label><input type="text" name="nadi" id="aenadi" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">

                                                <div class="form-group"><label>Tekanan Darah(mmHg)</label>
                                                    <div class="col-sm-12" style="display: flex;  align-items: center;">
                                                        <input type="text" name="tension_upper" id="aetension_upper" placeholder="" value="" class="form-control">
                                                        <h4>/</h4>
                                                        <input type="text" name="tension_below" id="aetension_below" placeholder="" value="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Saturasi(SpO2%)</label><input type="text" name="saturasi" id="aesaturasi" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Nafas/RR(/menit)</label><input type="text" name="nafas" id="aenafas" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Diameter Lengan(cm)</label><input type="text" name="arm_diameter" id="aearm_diameter" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="aepemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="bolds">
                                                (A) Assesment
                                            </h4>
                                        </td>
                                        <td id="visit_date">
                                            <div class="col-md-12"><textarea name="description" id="aedescription" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="bolds">
                                                (P) Rencana Penatalaksanaan
                                            </h4>
                                        </td>
                                        <td id="exit_date">
                                            <div class="col-md-12"><textarea name="instruction" id="aeinstruction" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="bolds">Tanggal Periksa
                                            </h4>
                                        </td>
                                        <td id="klinik">
                                            <div class="col-md-2"><input type='text' name="examination_date" class="form-control" id='examination_date' /></div>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td class="bolds">
                                            (S) Anamnesis
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="anamnase" id="aeanamnase" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="bolds">
                                            (O) Pemeriksaan Fisik
                                        </td>
                                        <td>

                                            <div class="col-sm-2">
                                                <div class="form-group"><label>BB(Kg)</label><input onchange="vitalsignInput(this)" type="text" name="weight" id="aeweight" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Tinggi(cm)</label><input onchange="vitalsignInput(this)" type="text" name="height" id="aeheight" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Suhu(°C)</label><input onchange="vitalsignInput(this)" type="text" name="temperature" id="aetemperature" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Nadi(/menit)</label><input onchange="vitalsignInput(this)" type="text" name="nadi" id="aenadi" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">

                                                <div class="form-group"><label>Tekanan Darah(mmHg)</label>
                                                    <div class="col-sm-12" style="display: flex;  align-items: center;">
                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="aetension_upper" placeholder="" value="" class="form-control">
                                                        <h4>/</h4>
                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="aetension_below" placeholder="" value="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Saturasi(SpO2%)</label><input onchange="vitalsignInput(this)" type="text" name="saturasi" id="aesaturasi" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Nafas/RR(/menit)</label><input onchange="vitalsignInput(this)" type="text" name="nafas" id="aenafas" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Diameter Lengan(cm)</label><input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="aearm_diameter" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="aepemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            (A) Assesment
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="description" id="aedescription" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            (P) Rencana Penatalaksanaan
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="instruction" id="aeinstruction" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">Tanggal Periksa</td>
                                        <td>
                                            <div class="col-md-2"><input type='text' name="examination_date" class="form-control" id='aeexamination_date' /></div>
                                        </td>
                                    </tr>
                                    <script type="text/javascript">
                                        $(function() {
                                            $('#examination_date').datetimepicker({
                                                format: 'YYYY-MM-DD hh:mm:ss'
                                            });
                                        });
                                    </script>

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
                            <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="aepetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="submit" id="formvitalsignsubmit" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                        <button type="button" id="formvitalsignedit" onclick="enableVitalSign()" style="display: none;" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info">Edit</button>
                    </div>
                </div>
            </form>

            <h3>Histori Vital Sign</h3>
            <table class="table table-borderedcustom table-bordered table-hover">
                <thead style="text-align: center;">
                    <tr>
                        <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                        <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                        <th class="text-center" colspan="6" style="width: 70%;">SOAP</th class="text-center">
                        <!-- <th class="text-center" style="width: 5%;"></th class="text-center"> -->
                        <!-- <th class="text-center" style="width: 5%;"></th class="text-center"> -->
                    </tr>

                </thead>
                <tbody id="vitalSignBody">
                    <?php
                    $total = 0;

                    ?>


                </tbody>

            </table>
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
    var vitalsign = <?= json_encode($exam); ?>;
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
        $("#aeexamination_date").val(get_date())
        setDataVitalSign()
    })

    function get_bodyid() {
        var m = new Date();
        m.setHours(m.getHours() + 7)
        var dateString = m.getUTCFullYear() + "-" + String(m.getUTCMonth() + 1 + 100).substring(1, 3) + "-" + String(m.getUTCDate() + 100).substring(1, 3) + " " + String(m.getUTCHours() + 100).substring(1, 3) + ":" + String(m.getUTCMinutes() + 100).substring(1, 3) + ":" + String(m.getUTCSeconds() + 100).substring(1, 3);
        return dateString;
    }

    $("#aeweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aeheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aetemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aenadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aetension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aetension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aesaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aenafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aearm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });

    function setDataVitalSign() {
        $("#aeclinic_id").val('<?= $visit['clinic_id']; ?>')
        $("#aeclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#aebed_id").val()
        $("#aekeluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#aeemployee_id").val('<?= $visit['employee_id']; ?>')
        $("#aeno_registration").val('<?= $visit['no_registration']; ?>')
        $("#aevisit_id").val('<?= $visit['visit_id']; ?>')
        $("#aeorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#aedoctor").val('<?= $visit['fullname']; ?>')
        $("#aekal_id").val('<?= $visit['kal_id']; ?>')
        $("#aetheid").val('<?= $visit['pasien_id']; ?>')
        $("#aethename").val('<?= $visit['diantar_oleh']; ?>')
        $("#aetheaddress").val('<?= $visit['visitor_address']; ?>')
        $("#aestatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#aeisrj").val('<?= $visit['isrj']; ?>')
        $("#aegender").val('<?= $visit['gender']; ?>')
        $("#aeageyear").val('<?= $visit['ageyear']; ?>')
        $("#aeagemonth").val('<?= $visit['agemonth']; ?>')
        $("#aeageday").val('<?= $visit['ageday']; ?>')

    }

    function addRowVitalSign(examselect, key) {
        $("#vitalSignBody").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date).substring(0, 16)))
                .append($("<td rowspan='7'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                // .append($("<td rowspan='7'>").html('<button type="button" onclick="copyCppt(' + key + ')" class="addbtn copybtn" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                // '<button type="button" onclick="editCppt(' + key + ')" class="editbtn edit-transparent-btn" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
                // .append($("<td rowspan='7'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="closebtn delete_row" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>'))
            )
            .append($("<tr>")
                .append($("<td>").html(''))
                .append($("<td>").html(examselect.tension_upper + '/' + examselect.tension_below + 'mmHg'))
                .append($("<td>").html(examselect.nadi + '/menit'))
                .append($("<td>").html(examselect.nafas + '/menit'))
                .append($("<td>").html(examselect.temperature + '/°C'))
                .append($("<td>").html(examselect.saturasi + '/SpO2%'))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>S</b>"))
                .append($("<td colspan='5'>").html(examselect.anamnase))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>O</b>"))
                .append($("<td colspan='5'>").html(examselect.pemeriksaan))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>A</b>"))
                .append($("<td colspan='5'>").html(examselect.description))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>P</b>"))
                .append($("<td colspan='5'>").html(examselect.instruction))
            )
            .append($("<tr>")
                .append($("<td>").html("Instruksi"))
                .append($("<td colspan='5'>").html(examselect.instruction))
            )
    }

    function vitalsignInput(prop) {
        var value = $(prop).val()
        value = (Number(value.replace(/[^\d+(\.\d{1,2})$]/g, '')).toFixed(2))

        console.log(prop.id)

        if (prop.id == "cppttemperature") {
            // Number(GetText( )) < 50 and Number(GetText( )) > 10
            if (value < 10)
                value = 10.00

            if (value > 50)
                value = 50.00
        }
        if (prop.id == "aetension_upper") {
            // Number(GetText()) < 250 and Number(GetText()) > 50
            if (value < 50)
                value = 50.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "aetnadi") {
            //Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }
        if (prop.id == "aeweight") {
            // Number(GetText( )) < 500
            if (value > 500)
                value = 500.00
        }
        if (prop.id == "aeheight") {
            // Number(GetText( )) between 30 and 250
            if (value < 30)
                value = 30.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "aetension_below") {
            // Number(GetText( )) between 0 and 300
            if (value < 0)
                value = 0.00

            if (value > 300)
                value = 300.00
        }
        if (prop.id == "aetension_below") {
            // Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }

        $(prop).val(value)
    }

    function disableVitalSign() {
        $("#aeexamination_date").prop("disabled", true)
        $("#aepetugas").prop("disabled", true)
        $("#aeweight").prop("disabled", true)
        $("#aeheight").prop("disabled", true)
        $("#aetemperature").prop("disabled", true)
        $("#aenadi").prop("disabled", true)
        $("#aetension_upper").prop("disabled", true)
        $("#aetension_below").prop("disabled", true)
        $("#aesaturasi").prop("disabled", true)
        $("#aenafas").prop("disabled", true)
        $("#aearm_diameter").prop("disabled", true)
        $("#aeanamnase").prop("disabled", true)
        $("#aepemeriksaan").prop("disabled", true)
        $("#aeteraphy_desc").prop("disabled", true)
        $("#aedescription").prop("disabled", true)
        $("#aeclinic_id").prop("disabled", true)
        $("#aeclass_room_id").prop("disabled", true)
        $("#aebed_id").prop("disabled", true)
        $("#aekeluar_id").prop("disabled", true)
        $("#aeemployee_id").prop("disabled", true)
        $("#aeno_registraiton").prop("disabled", true)
        $("#aevisit_id").prop("disabled", true)
        $("#aeorg_unit_code").prop("disabled", true)
        $("#aedoctor").prop("disabled", true)
        $("#aekal_id").prop("disabled", true)
        $("#aetheid").prop("disabled", true)
        $("#aethename").prop("disabled", true)
        $("#aetheaddress").prop("disabled", true)
        $("#aestatus_pasien_id").prop("disabled", true)
        $("#aeisrj").prop("disabled", true)
        $("#aegender").prop("disabled", true)
        $("#aeageyear").prop("disabled", true)
        $("#aeagemonth").prop("disabled", true)
        $("#aeageday").prop("disabled", true)
        $("#aeinstruction").prop("disabled", true)
    }

    function enableVitalSign() {
        $("#aeexamination_date").prop("disabled", false)
        $("#aepetugas").prop("disabled", false)
        $("#aeweight").prop("disabled", false)
        $("#aeheight").prop("disabled", false)
        $("#aetemperature").prop("disabled", false)
        $("#aenadi").prop("disabled", false)
        $("#aetension_upper").prop("disabled", false)
        $("#aetension_below").prop("disabled", false)
        $("#aesaturasi").prop("disabled", false)
        $("#aenafas").prop("disabled", false)
        $("#aearm_diameter").prop("disabled", false)
        $("#aeanamnase").prop("disabled", false)
        $("#aepemeriksaan").prop("disabled", false)
        $("#aeteraphy_desc").prop("disabled", false)
        $("#aedescription").prop("disabled", false)
        $("#aeclinic_id").prop("disabled", false)
        $("#aeclass_room_id").prop("disabled", false)
        $("#aebed_id").prop("disabled", false)
        $("#aekeluar_id").prop("disabled", false)
        $("#aeemployee_id").prop("disabled", false)
        $("#aeno_registraiton").prop("disabled", false)
        $("#aevisit_id").prop("disabled", false)
        $("#aeorg_unit_code").prop("disabled", false)
        $("#aedoctor").prop("disabled", false)
        $("#aekal_id").prop("disabled", false)
        $("#aetheid").prop("disabled", false)
        $("#aethename").prop("disabled", false)
        $("#aetheaddress").prop("disabled", false)
        $("#aestatus_pasien_id").prop("disabled", false)
        $("#aeisrj").prop("disabled", false)
        $("#aegender").prop("disabled", false)
        $("#aeageyear").prop("disabled", false)
        $("#aeagemonth").prop("disabled", false)
        $("#aeageday").prop("disabled", false)
        $("#aeinstruction").prop("disabled", false)

        $("#formvitalsignsubmit").toggle()
        $("#formvitalsignedit").toggle()
    }

    var vitalsigndesc = []

    var i = 0

    // for (let index = vitalsign.length; index >= 0; index--) {
    //     vitalsigndesc.push(vitalsign[index]);
    // }
    // console.log(vitalsigndesc)
    // vitalsign = vitalsigndesc

    vitalsign.forEach((element, key) => {
        examselect = vitalsign[key];
        addRowVitalSign(examselect, key)
    });

    vitalsign.forEach((element, key) => {
        examselect = vitalsign[key];

        if (examselect.visit_id == '<?= $visit['visit_id']; ?>') {
            console.log(examselect)

            $("#aeclinic_id").val(examselect.clinic_id)
            $("#aeclass_room_id").val(examselect.class_room_id)
            $("#aebed_id").val(examselect.bed_id)
            $("#aekeluar_id").val(examselect.keluar_id)
            $("#aeemployee_id").val(examselect.employee_id)
            $("#aeno_registration").val(examselect.no_registration)
            $("#aevisit_id").val(examselect.visit_id)
            $("#aeorg_unit_code").val(examselect.org_unit_code)
            $("#aedoctor").val(examselect.fullname)
            $("#aekal_id").val(examselect.kal_id)
            $("#aetheid").val(examselect.pasien_id)
            $("#aethename").val(examselect.diantar_oleh)
            $("#aetheaddress").val(examselect.visitor_address)
            $("#aestatus_pasien_id").val(examselect.status_pasien_id)
            $("#aeisrj").val(examselect.isrj)
            $("#aegender").val(examselect.gender)
            $("#aeageyear").val(examselect.ageyear)
            $("#aeagemonth").val(examselect.agemonth)
            $("#aeageday").val(examselect.ageday)
            $("#aebody_id").val(examselect.body_id)

            $("#aeexamination_date").val(examselect.examination_date)
            $("#aepetugas").val(examselect.petugas)
            $("#aeweight").val(examselect.weight)
            $("#aeheight").val(examselect.height)
            $("#aetemperature").val(examselect.temperature)
            $("#aenadi").val(examselect.nadi)
            $("#aetension_upper").val(examselect.tension_upper)
            $("#aetension_below").val(examselect.tension_below)
            $("#aesaturasi").val(examselect.saturasi)
            $("#aenafas").val(examselect.nafas)
            $("#aearm_diameter").val(examselect.arm_diameter)
            $("#aeanamnase").val(examselect.anamnase)
            $("#aepemeriksaan").val(examselect.pemeriksaan)
            $("#aeteraphy_desc").val(examselect.teraphy_desc)
            $("#aedescription").val(examselect.description)
            $("#aeclinic_id").val(examselect.clinic_id)
            $("#aeclass_room_id").val(examselect.class_room_id)
            $("#aebed_id").val(examselect.bed_id)
            $("#aekeluar_id").val(examselect.keluar_id)
            $("#aeemployee_id").val(examselect.employee_id)
            $("#aeno_registraiton").val(examselect.no_registraiton)
            $("#aevisit_id").val(examselect.visit_id)
            $("#aeorg_unit_code").val(examselect.org_unit_code)
            $("#aedoctor").val(examselect.doctor)
            $("#aekal_id").val(examselect.kal_id)
            $("#aetheid").val(examselect.theid)
            $("#aethename").val(examselect.thename)
            $("#aetheaddress").val(examselect.theaddress)
            $("#aestatus_pasien_id").val(examselect.status_pasien_id)
            $("#aeisrj").val(examselect.isrj)
            $("#aegender").val(examselect.gender)
            $("#aeageyear").val(examselect.ageyear)
            $("#aeagemonth").val(examselect.agemonth)
            $("#aeageday").val(examselect.ageday)
            $("#aeinstruction").val(examselect.instruction)
        }

        if (typeof $("#aebody_id").val() !== 'undefined' || $("#aebody_id").val() == "") {
            // $("#aebody_id").val((get_bodyid() + String(Math.floor(Math.random() * 1000))).replaceAll(' ', '').replaceAll('-', '').replaceAll(':', ''))
            $("#aeclinic_id").val('<?= $visit['clinic_id']; ?>')
            $("#aeclass_room_id").val('<?= $visit['class_room_id']; ?>')
            $("#aebed_id").val()
            $("#aekeluar_id").val('<?= $visit['keluar_id']; ?>')
            $("#aeemployee_id").val('<?= $visit['employee_id']; ?>')
            $("#aeno_registration").val('<?= $visit['no_registration']; ?>')
            $("#aevisit_id").val('<?= $visit['visit_id']; ?>')
            $("#aeorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
            $("#aedoctor").val('<?= $visit['fullname']; ?>')
            $("#aekal_id").val('<?= $visit['kal_id']; ?>')
            $("#aetheid").val('<?= $visit['pasien_id']; ?>')
            $("#aethename").val('<?= $visit['diantar_oleh']; ?>')
            $("#aetheaddress").val('<?= $visit['visitor_address']; ?>')
            $("#aestatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
            $("#aeisrj").val('<?= $visit['isrj']; ?>')
            $("#aegender").val('<?= $visit['gender']; ?>')
            $("#aeageyear").val('<?= $visit['ageyear']; ?>')
            $("#aeagemonth").val('<?= $visit['agemonth']; ?>')
            $("#aeageday").val('<?= $visit['ageday']; ?>')


        }
    });
    $("#formvitalsign").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/editExam',
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
                    disableVitalSign()
                    $("#formvitalsignsubmit").toggle()
                    $("#formvitalsignedit").toggle()
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
</script>