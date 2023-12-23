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
<div class="tab-pane" id="tindaklanjut" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12">
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
                <tbody id="vitalSignBodyss">
                    <?php
                    $total = 0;

                    ?>


                </tbody>

            </table>
        </div>
    </div><!--./row-->

</div>
<!-- -->