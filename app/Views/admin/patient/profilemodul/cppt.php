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
<div class="tab-pane" id="cppt" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12">
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