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
                                <div class="row mt-4 mb-4">
                                    <label for="aeanamnase" class="col-sm-2 col-form-label">(S) Anamnesis</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" id="aeanamnase" name="anamnase" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">(O) Pemeriksaan Fisik</label>
                                    <div class="col-sm-10">
                                        <div class="row mb-2">
                                            <div class="col-sm-2 mt-2">
                                                <div class="form-group"><label>BB(Kg)</label><input onchange="vitalsignInput(this)" type="text" name="weight" id="aeweight" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2 mt-2">
                                                <div class="form-group"><label>Tinggi(cm)</label><input onchange="vitalsignInput(this)" type="text" name="height" id="aeheight" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2 mt-2">
                                                <div class="form-group"><label>Suhu(°C)</label><input onchange="vitalsignInput(this)" type="text" name="temperature" id="aetemperature" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2 mt-2">
                                                <div class="form-group"><label>Nadi(/menit)</label><input onchange="vitalsignInput(this)" type="text" name="nadi" id="aenadi" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2 mt-2">

                                                <div class="form-group"><label>T.Darah(mmHg)</label>
                                                    <div class="col-sm-12" style="display: flex;  align-items: center;">
                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="aetension_upper" placeholder="" value="" class="form-control">
                                                        <h4>/</h4>
                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="aetension_below" placeholder="" value="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 mt-2">
                                                <div class="form-group"><label>Saturasi(SpO2%)</label><input onchange="vitalsignInput(this)" type="text" name="saturasi" id="aesaturasi" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2 mt-2">
                                                <div class="form-group"><label>Nafas/RR(/menit)</label><input onchange="vitalsignInput(this)" type="text" name="nafas" id="aenafas" placeholder="" value="" class="form-control"></div>
                                            </div>
                                            <div class="col-sm-2 mt-2">
                                                <div class="form-group"><label>Diameter Lengan(cm)</label><input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="aearm_diameter" placeholder="" value="" class="form-control"></div>

                                            </div>
                                            <div class="col-sm-12 mt-2">
                                                <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="aepemeriksaan" placeholder="" value="" class="form-control"></textarea></div>

                                            </div>
                                            <!-- <div class="col-sm-12">
                                                <div class="mb-4">
                                                    <div class="form-group"><label>Tanggal Periksa</label><textarea name="examination_date" id="aepemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-4">
                                    <label for="aedescription" class="col-sm-2 col-form-label">(A) Assesment</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" id="aedescription" name="description" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-4">
                                    <label for="aeinstruction" class="col-sm-2 col-form-label">(P) Rencana Penatalaksanaan</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" id="aeinstruction" name="instruction" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-4">
                                    <label for="aeexamination_date" class="col-sm-2 col-form-label">Tanggal Periksa</label>
                                    <div class="col-sm-10">
                                        <div class="input-group" id="aeexaminationdate">
                                            <input id="aeexamination_date" name="examination_date" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#aeexaminationdate' value="<?= date('Y-m-d'); ?>">

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                        </div>
                                    </div>
                                </div>

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
                    <div class="panel-footer text-end mb-4">
                        <button type="submit" id="formvitalsignsubmit" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-primary"><?php echo lang('Word.save'); ?></button>
                        <button type="button" id="formvitalsignedit" onclick="enableVitalSign()" style="display: none;" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-secondary">Edit</button>
                    </div>
                </div>
            </form>

            <h3>Histori Vital Sign</h3>
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="text-align: center;">
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