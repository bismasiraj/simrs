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
<div class="tab-pane" id="cppt">
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
            <form id="formcppt" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                <div class="modal-body pt0 pb0">
                    <input id="cpptclinic_id" name="clinic_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptclass_room_id" name="class_room_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptbed_id" name="bed_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptkeluar_id" name="keluar_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptemployee_id" name="employee_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptno_registration" name="no_registration" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptvisit_id" name="visit_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptorg_unit_code" name="org_unit_code" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptdoctor" name="doctor" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptkal_id" name="kal_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cppttheid" name="theid" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptthename" name="thename" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cppttheaddress" name="theaddress" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptstatus_pasien_id" name="status_pasien_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptisrj" name="isrj" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptgender" name="gender" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptageyear" name="ageyear" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptagemonth" name="agemonth" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptageday" name="ageday" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptbody_id" name="body_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptweight" name="weight" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="cpptheight" name="height" placeholder="" type="text" class="form-control block" value="" style="display: none" />

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
                                            <div class="col-md-12"><textarea name="anamnase" id="cpptanamnase" placeholder="" value="" class="form-control"></textarea></div>
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
                                                <div class="form-group"><label>BB(Kg)</label><input type="text" name="weight" id="cpptweight" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Tinggi(cm)</label><input type="text" name="height" id="cpptheight" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Suhu(°C)</label><input type="text" name="temperature" id="cppttemperature" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Nadi(/menit)</label><input type="text" name="nadi" id="cpptnadi" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">

                                                <div class="form-group"><label>Tekanan Darah(mmHg)</label>
                                                    <div class="col-sm-12" style="display: flex;  align-items: center;">
                                                        <input type="text" name="tension_upper" id="cppttension_upper" placeholder="" value="" class="form-control">
                                                        <h4>/</h4>
                                                        <input type="text" name="tension_below" id="cppttension_below" placeholder="" value="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Saturasi(SpO2%)</label><input type="text" name="saturasi" id="cpptsaturasi" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Nafas/RR(/menit)</label><input type="text" name="nafas" id="cpptnafas" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Diameter Lengan(cm)</label><input type="text" name="arm_diameter" id="cpptarm_diameter" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="cpptpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
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
                                            <div class="col-md-12"><textarea name="description" id="cpptdescription" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="bolds">
                                                (P) Rencana Penatalaksanaan
                                            </h4>
                                        </td>
                                        <td id="exit_date">
                                            <div class="col-md-12"><textarea name="instruction" id="cpptinstruction" placeholder="" value="" class="form-control"></textarea></div>
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
                                            <div class="col-md-12"><textarea name="anamnase" id="cpptanamnase" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="bolds">
                                            (O) Pemeriksaan Fisik
                                        </td>
                                        <td>

                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Suhu(°C)</label><input type="text" name="temperature" id="cppttemperature" placeholder="" value="" class="form-control" onchange="cpptInput(this)"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Nadi(/menit)</label><input type="text" name="nadi" id="cpptnadi" placeholder="" value="" class="form-control" onchange="cpptInput(this)"></div>
                                            </div>
                                            <div class="col-sm-2">

                                                <div class="form-group"><label>Tekanan Darah(mmHg)</label>
                                                    <div class="col-sm-12" style="display: flex;  align-items: center;">
                                                        <input type="text" name="tension_upper" id="cppttension_upper" placeholder="" value="" class="form-control" onchange="cpptInput(this)">
                                                        <h4>/</h4>
                                                        <input type="text" name="tension_below" id="cppttension_below" placeholder="" value="" class="form-control" onchange="cpptInput(this)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Saturasi(SpO2%)</label><input type="text" name="saturasi" id="cpptsaturasi" placeholder="" value="" class="form-control" onchange="cpptInput(this)"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Nafas/RR(/menit)</label><input type="text" name="nafas" id="cpptnafas" placeholder="" value="" class="form-control" onchange="cpptInput(this)"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Diameter Lengan(cm)</label><input type="text" name="arm_diameter" id="cpptarm_diameter" placeholder="" value="" class="form-control" onchange="cpptInput(this)"></div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="cpptpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            (A) Assesment
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="description" id="cpptdescription" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            (P) Rencana Penatalaksanaan
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="instruction" id="cpptinstruction" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">Tanggal Periksa</td>
                                        <td>
                                            <div class="col-md-2"><input type='text' name="examination_date" class="form-control" id='cpptexamination_date' /></div>
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
                            <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="cpptpetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="submit" id="formcpptsubmit" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                        <button type="button" id="formcpptedit" onclick="enablecpptjson()" style="display: none;" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info">Edit</button>
                    </div>
                </div>
            </form>
            <h3>Histori CPPT</h3>
            <table class="table table-borderedcustom table-bordered table-hover">
                <thead style="text-align: center;">
                    <tr>
                        <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                        <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                        <th class="text-center" colspan="6" style="width: 70%;">SOAP</th class="text-center">
                        <th class="text-center" style="width: 5%;"></th class="text-center">
                        <th class="text-center" style="width: 5%;"></th class="text-center">
                    </tr>

                </thead>
                <tbody id="cpptBody">
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
    var cpptjson = [];
    cpptjson = <?= json_encode($exam); ?>;
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
        // $("#examination_date").val(get_date())
        setDataCPPT()
    })

    $("#cpptweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cpptheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cppttemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cpptnadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cppttension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cppttension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cpptsaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cpptnafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#cpptarm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });

    function cpptInput(prop) {
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
        if (prop.id == "cppttension_upper") {
            // Number(GetText()) < 250 and Number(GetText()) > 50
            if (value < 50)
                value = 50.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "cppttnadi") {
            //Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }
        if (prop.id == "cpptweight") {
            // Number(GetText( )) < 500
            if (value > 500)
                value = 500.00
        }
        if (prop.id == "cpptheight") {
            // Number(GetText( )) between 30 and 250
            if (value < 30)
                value = 30.00

            if (value > 250)
                value = 250.00
        }
        if (prop.id == "cppttension_below") {
            // Number(GetText( )) between 0 and 300
            if (value < 0)
                value = 0.00

            if (value > 300)
                value = 300.00
        }
        if (prop.id == "cppttension_below") {
            // Number(GetText( )) < 300 
            if (value > 300)
                value = 300.00
        }

        $(prop).val(value)
    }

    function get_bodyid() {
        var m = new Date();
        m.setHours(m.getHours() + 7)
        var dateString = m.getUTCFullYear() + "-" + String(m.getUTCMonth() + 1 + 100).substring(1, 3) + "-" + String(m.getUTCDate() + 100).substring(1, 3) + " " + String(m.getUTCHours() + 100).substring(1, 3) + ":" + String(m.getUTCMinutes() + 100).substring(1, 3) + ":" + String(m.getUTCSeconds() + 100).substring(1, 3);
        return dateString;
    }

    function disablecpptjson() {
        $("#examination_date").prop("disabled", true)
        $("#cpptpetugas").prop("disabled", true)
        $("#cpptweight").prop("disabled", true)
        $("#cpptheight").prop("disabled", true)
        $("#cppttemperature").prop("disabled", true)
        $("#cpptnadi").prop("disabled", true)
        $("#cppttension_upper").prop("disabled", true)
        $("#cppttension_below").prop("disabled", true)
        $("#cpptsaturasi").prop("disabled", true)
        $("#cpptnafas").prop("disabled", true)
        $("#cpptarm_diameter").prop("disabled", true)
        $("#cpptanamnase").prop("disabled", true)
        $("#cpptpemeriksaan").prop("disabled", true)
        $("#cpptteraphy_desc").prop("disabled", true)
        $("#cpptdescription").prop("disabled", true)
        $("#cpptclinic_id").prop("disabled", true)
        $("#cpptclass_room_id").prop("disabled", true)
        $("#cpptbed_id").prop("disabled", true)
        $("#cpptkeluar_id").prop("disabled", true)
        $("#cpptemployee_id").prop("disabled", true)
        $("#cpptno_registraiton").prop("disabled", true)
        $("#cpptvisit_id").prop("disabled", true)
        $("#cpptorg_unit_code").prop("disabled", true)
        $("#cpptdoctor").prop("disabled", true)
        $("#cpptkal_id").prop("disabled", true)
        $("#cppttheid").prop("disabled", true)
        $("#cpptthename").prop("disabled", true)
        $("#cppttheaddress").prop("disabled", true)
        $("#cpptstatus_pasien_id").prop("disabled", true)
        $("#cpptisrj").prop("disabled", true)
        $("#cpptgender").prop("disabled", true)
        $("#cpptageyear").prop("disabled", true)
        $("#cpptagemonth").prop("disabled", true)
        $("#cpptageday").prop("disabled", true)
        $("#cpptinstruction").prop("disabled", true)
    }

    function enablecpptjson() {
        $("#examination_date").prop("disabled", false)
        $("#cpptpetugas").prop("disabled", false)
        $("#cpptweight").prop("disabled", false)
        $("#cpptheight").prop("disabled", false)
        $("#cppttemperature").prop("disabled", false)
        $("#cpptnadi").prop("disabled", false)
        $("#cppttension_upper").prop("disabled", false)
        $("#cppttension_below").prop("disabled", false)
        $("#cpptsaturasi").prop("disabled", false)
        $("#cpptnafas").prop("disabled", false)
        $("#cpptarm_diameter").prop("disabled", false)
        $("#cpptanamnase").prop("disabled", false)
        $("#cpptpemeriksaan").prop("disabled", false)
        $("#cpptteraphy_desc").prop("disabled", false)
        $("#cpptdescription").prop("disabled", false)
        $("#cpptclinic_id").prop("disabled", false)
        $("#cpptclass_room_id").prop("disabled", false)
        $("#cpptbed_id").prop("disabled", false)
        $("#cpptkeluar_id").prop("disabled", false)
        $("#cpptemployee_id").prop("disabled", false)
        $("#cpptno_registraiton").prop("disabled", false)
        $("#cpptvisit_id").prop("disabled", false)
        $("#cpptorg_unit_code").prop("disabled", false)
        $("#cpptdoctor").prop("disabled", false)
        $("#cpptkal_id").prop("disabled", false)
        $("#cppttheid").prop("disabled", false)
        $("#cpptthename").prop("disabled", false)
        $("#cppttheaddress").prop("disabled", false)
        $("#cpptstatus_pasien_id").prop("disabled", false)
        $("#cpptisrj").prop("disabled", false)
        $("#cpptgender").prop("disabled", false)
        $("#cpptageyear").prop("disabled", false)
        $("#cpptagemonth").prop("disabled", false)
        $("#cpptageday").prop("disabled", false)
        $("#cpptinstruction").prop("disabled", false)

        $("#formcpptsubmit").toggle()
        $("#formcpptedit").toggle()
    }

    function addRowCPPT(examselect, key) {
        $("#cpptBody").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date).substring(0, 16)))
                .append($("<td rowspan='7'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="copyCppt(' + key + ')" class="addbtn copybtn" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editCppt(' + key + ')" class="editbtn edit-transparent-btn" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id + '\')" class="closebtn delete_row" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>'))
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

    function setDataCPPT() {
        $("#cpptclinic_id").val('<?= $visit['clinic_id']; ?>')
        $("#cpptclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#cpptbed_id").val()
        $("#cpptkeluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#cpptemployee_id").val('<?= $visit['employee_id']; ?>')
        $("#cpptno_registration").val('<?= $visit['no_registration']; ?>')
        $("#cpptvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#cpptorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#cpptdoctor").val('<?= $visit['fullname']; ?>')
        $("#cpptkal_id").val('<?= $visit['kal_id']; ?>')
        $("#cppttheid").val('<?= $visit['pasien_id']; ?>')
        $("#cpptthename").val('<?= $visit['diantar_oleh']; ?>')
        $("#cppttheaddress").val('<?= $visit['visitor_address']; ?>')
        $("#cpptstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#cpptisrj").val('<?= $visit['isrj']; ?>')
        $("#cpptgender").val('<?= $visit['gender']; ?>')
        $("#cpptageyear").val('<?= $visit['ageyear']; ?>')
        $("#cpptagemonth").val('<?= $visit['agemonth']; ?>')
        $("#cpptageday").val('<?= $visit['ageday']; ?>')
        $("#cpptexamination_date").val(get_date())
        $("#cpptanamnase").val("")
        $("#cppttemperature").val("")
        $("#cpptnadi").val("")
        $("#cppttension_upper").val("")
        $("#cppttension_below").val("")
        $("#cpptsaturasi").val("")
        $("#cpptnafas").val("")
        $("#cpptarm_diameter").val("")
        $("#cpptpemeriksaan").val("")
        $("#cpptdescription").val("")
        $("#cpptinstruction").val("")
        $("#cpptpetugas").val('<?= user()->getFullname(); ?>')
    }

    cpptjson.forEach((element, key) => {
        examselect = cpptjson[key];
        addRowCPPT(examselect, key)
    });

    function editCppt(key) {
        var examselect = cpptjson[key];
        if (examselect.petugas == '<?= user()->getFullname(); ?>') {
            alert("Tidak dapat meengubah inputan CPPT milik dokter/petugas lain")
        } else {
            $("#cpptageday").val(examselect.ageday)
            $("#cpptagemonth").val(examselect.agemonth)
            $("#cpptageyear").val(examselect.ageyear)
            $("#cpptanamnase").val(examselect.anamnase)
            $("#cpptarm_diameter").val(examselect.arm_diameter)
            $("#cpptbed_id").val(examselect.bed_id)
            $("#cpptbody_id").val(examselect.body_id)
            $("#cpptclass_room_id").val(examselect.class_room_id)
            $("#cpptclinic_id").val(examselect.clinic_id)
            $("#cpptdescription").val(examselect.description)
            $("#cpptdoctor").val(examselect.doctor)
            $("#cpptemployee_id").val(examselect.employee_id)
            $("#cpptexamination_date").val(examselect.examination_date)
            $("#cpptgender").val(examselect.gender)
            $("#cpptheight").val(examselect.height)
            $("#cpptinstruction").val(examselect.instruction)
            $("#cpptisrj").val(examselect.isrj)
            $("#cpptkal_id").val(examselect.kal_id)
            $("#cpptkeluar_id").val(examselect.keluar_id)
            $("#cpptnadi").val(examselect.nadi)
            $("#cpptnafas").val(examselect.nafas)
            $("#cpptno_registraiton").val(examselect.no_registraiton)
            $("#cpptorg_unit_code").val(examselect.org_unit_code)
            $("#cpptpemeriksaan").val(examselect.pemeriksaan)
            $("#cpptpetugas").val(examselect.petugas)
            $("#cpptsaturasi").val(examselect.saturasi)
            $("#cpptstatus_pasien_id").val(examselect.status_pasien_id)
            $("#cppttemperature").val(examselect.temperature)
            $("#cppttension_below").val(examselect.tension_below)
            $("#cppttension_upper").val(examselect.tension_upper)
            $("#cpptteraphy_desc").val(examselect.teraphy_desc)
            $("#cppttheaddress").val(examselect.theaddress)
            $("#cppttheid").val(examselect.pasien_id)
            $("#cpptthename").val(examselect.diantar_oleh)
            $("#cpptvisit_id").val(examselect.visit_id)
            $("#cpptweight").val(examselect.weight)
        }
    }

    function copyCppt(key) {
        var examselect = cpptjson[key];
        $("#cpptageday").val(examselect.ageday)
        $("#cpptagemonth").val(examselect.agemonth)
        $("#cpptageyear").val(examselect.ageyear)
        $("#cpptanamnase").val(examselect.anamnase)
        $("#cpptarm_diameter").val(examselect.arm_diameter)
        $("#cpptbed_id").val(examselect.bed_id)
        $("#cpptbody_id").val("")
        $("#cpptclass_room_id").val(examselect.class_room_id)
        $("#cpptclinic_id").val(examselect.clinic_id)
        $("#cpptdescription").val(examselect.description)
        $("#cpptdoctor").val(examselect.doctor)
        $("#cpptemployee_id").val(examselect.employee_id)
        $("#cpptexamination_date").val(get_date())
        $("#cpptgender").val(examselect.gender)
        $("#cpptheight").val(examselect.height)
        $("#cpptinstruction").val(examselect.instruction)
        $("#cpptisrj").val(examselect.isrj)
        $("#cpptkal_id").val(examselect.kal_id)
        $("#cpptkeluar_id").val(examselect.keluar_id)
        $("#cpptnadi").val(examselect.nadi)
        $("#cpptnafas").val(examselect.nafas)
        $("#cpptno_registraiton").val(examselect.no_registraiton)
        $("#cpptorg_unit_code").val(examselect.org_unit_code)
        $("#cpptpemeriksaan").val(examselect.pemeriksaan)
        $("#cpptpetugas").val(examselect.petugas)
        $("#cpptsaturasi").val(examselect.saturasi)
        $("#cpptstatus_pasien_id").val(examselect.status_pasien_id)
        $("#cppttemperature").val(examselect.temperature)
        $("#cppttension_below").val(examselect.tension_below)
        $("#cppttension_upper").val(examselect.tension_upper)
        $("#cpptteraphy_desc").val(examselect.teraphy_desc)
        $("#cppttheaddress").val(examselect.theaddress)
        $("#cppttheid").val(examselect.pasien_id)
        $("#cpptthename").val(examselect.diantar_oleh)
        $("#cpptvisit_id").val(examselect.visit_id)
        $("#cpptweight").val(examselect.weight)
    }

    $("#formcppt").on('submit', (function(e) {
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
                    if (data.type == 'insert') {
                        cpptjson.push(data.data)
                        setDataCPPT()
                        var len = cpptjson.length
                        addRowCPPT(data.data, len)
                    } else {
                        console.log(data.type)
                        $("#cpptBody").html("")
                        setDataCPPT()
                        cpptjson.forEach((element, key) => {
                            console.log("json: " + cpptjson[key].body_id + " & data: " + data.data.body_id)
                            if (cpptjson[key].body_id == data.data.body_id) {
                                cpptjson[key] = data.data
                            }
                            addRowCPPT(data.data, key)
                        });
                    }
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