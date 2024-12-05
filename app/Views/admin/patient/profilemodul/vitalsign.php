<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
// echo '<pre>';
// var_dump($visit);
// die();
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
<div class="tab-pane" id="vitalsignmodul" role="tabpanel">
    <div class="row">
        <div id="loadContentVitalSign" class="col-12 center-spinner"></div>
        <div id="contentVitalSign" class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div><!--./col-lg-6-->
            <div class="col-lg-10 col-md-10 col-sm-12">
                <div id="vitalSignDocument" class="card border-1 rounded-4 m-4 p-4" style="display: none;">
                    <div class="card-body">
                        <form id="formvitalsign" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="modal-body pt0 pb0">
                                <input id="avtclinic_id" name="clinic_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtclass_room_id" name="class_room_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtbed_id" name="bed_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtkeluar_id" name="keluar_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtemployee_id" name="employee_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtno_registration" name="no_registration" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtvisit_id" name="visit_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtorg_unit_code" name="org_unit_code" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtdoctor" name="doctor" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtkal_id" name="kal_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avttheid" name="theid" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtthename" name="thename" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avttheaddress" name="theaddress" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtstatus_pasien_id" name="status_pasien_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtisrj" name="isrj" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtgender" name="gender" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtageyear" name="ageyear" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtagemonth" name="agemonth" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtageday" name="ageday" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtbody_id" name="body_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtmodified_by" name="modified_by" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avttrans_id" name="trans_id" placeholder="" type="hidden" class="form-control block" value="" /> <!--==new -->
                                <input id="avtaccount_id" name="account_id" placeholder="" type="hidden" class="form-control block" value="" /> <!--==new -->
                                <!-- <input id="avtvs_status_id" name="vs_status_id" placeholder="" type="hidden" class="form-control block" value="" /> -->
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="avtanamnase" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(S) Anamnesis</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="avtanamnase" name="anamnase" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <h3><b>Vital Sign</b></h3>
                                                <hr>
                                                <label class="col-xs-6 col-sm-6 col-md-2 col-form-label">Pemeriksaan Fisik</label>
                                                <div class="col-xs-6 col-sm-6 col-md-10">
                                                    <div class="row mb-2">
                                                        <!--==new -->
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Jenis EWS</label>
                                                                <select class="form-select" name="vs_status_id" id="avtvs_status_id">
                                                                    <option selected>-- pilih --</option>
                                                                    <option value="1">Dewasa</option>
                                                                    <option value="4">Anak</option>
                                                                    <option value="5">Neonatus</option>
                                                                    <option value="10">Obsetric</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--==endofnew -->
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>BB(Kg)</label>
                                                                <div class=" position-relative">
                                                                    <input onchange="" type="text" name="weight" id="avtweight" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                    <span class="h6" id="badge-bb"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Tinggi(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="" type="text" name="height" id="avtheight" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                    <span class="h6" id="badge-avtheight"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Suhu(°C)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="" type="text" name="temperature" id="avttemperature" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                    <span class="h6" id="badge-avttemperature"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                            <div class="form-group">
                                                                <label>Nadi(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="" type="text" name="nadi" id="avtnadi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                    <span class="h6" id="badge-avtnadi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="tension_upper" id="avttension_upper" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avttension_upper"></span>
                                                                    </div>
                                                                    <h4 class="mx-2">/</h4>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="tension_below" id="avttension_below" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avttension_below"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Saturasi(SpO2%)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="" type="text" name="saturasi" id="avtsaturasi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                    <span class="h6" id="badge-avtsaturasi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Nafas/RR(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="" type="text" name="nafas" id="avtnafas" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                    <span class="h6" id="badge-avtnafas"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Diameter Lengan(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="" type="text" name="arm_diameter" id="avtarm_diameter" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                    <span class="h6" id="badge-avtarm_diameter"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Penggunaan Oksigen (L/mnt)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="" type="text" name="oxygen_usage" id="avtoxygen_usage" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                    <span class="h6" id="badge-avtoxygen_usage"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Kesadaran</label>
                                                                <select class="form-select" name="awareness" id="avtawareness" onchange="">
                                                                    <option value="0">Sadar</option>
                                                                    <option value="3">Nyeri</option>
                                                                    <option value="10">Unrespon</option>
                                                                </select>
                                                                <span class="h6" id="badge-avtawareness"></span>
                                                            </div>
                                                        </div>
                                                        <?php if ($visit['specialist_type_id'] == '1.05') {
                                                        ?>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Nyeri</label>
                                                                    <select class="form-select" name="pain" id="prslexampain" onchange="">
                                                                        <option value="0">Normal</option>
                                                                        <option value="3">Abnormal</option>
                                                                    </select>
                                                                    <span class="h6" id="badge-prslexampain"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Discharge/Lokia</label>
                                                                    <select class="form-select" name="lochia" id="prslexamlochia" onchange="">
                                                                        <option value="0">Normal</option>
                                                                        <option value="3">Abnormal</option>
                                                                    </select>
                                                                    <span class="h6" id="badge-prslexamlokia"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Proteinuria (Perhari)</label>
                                                                    <select class="form-select" name="proteinuria" id="prslexamproteinuria" onchange="">
                                                                        <option value="0">-</option>
                                                                        <option value="2">+</option>
                                                                        <option value="3">++</option>
                                                                    </select>
                                                                    <span class="h6" id="badge-prslexamproteinuria"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Cervix</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="cervix" id="avtcervix" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avtcervix"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>DJJ</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="djj" id="avtdjj" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avtdjj"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>TFU</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="tfu" id="avttfu" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avttfu"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Letak Anak</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="child_potition" id="avtchild_potition" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avtchild_potition"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Bunyi Jantung</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="heart_sound" id="avtheart_sound" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avtheart_sound"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Oedema</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="oedema" id="avtoedema" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avtoedema"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Urine</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="urine" id="avturine" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avturine"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } ?>
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="avtpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                        <!-- <div class="col-sm-12">
                                                            <div class="mb-4">
                                                                <div class="form-group"><label>Tanggal Periksa</label><textarea name="examination_date" id="avtpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <?php if ($visit['specialist_type_id'] == '1.05') {
                                                ?>
                                                    <label class="col-xs-6 col-sm-6 col-md-2 col-form-label">HIS</label>
                                                    <div class="col-xs-6 col-sm-6 col-md-10">
                                                        <div class="row mb-2">

                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Freq</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="his_freq" id="avthis_freq" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avthis_freq"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Lama</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="his_duration" id="avthis_duration" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avthis_duration"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Kekuatan</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="his_power" id="avthis_power" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avthis_power"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label>Simetri</label>
                                                                    <div class="position-relative">
                                                                        <input onchange="" type="text" name="his_simetry" id="avthis_simetry" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                        <span class="h6" id="badge-avthis_simetry"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="avtdescription" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(A) Assesment</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="avtdescription" name="description" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="avtinstruction" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(P) Rencana Penatalaksanaan</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="avtinstruction" name="instruction" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4">
                                                <label for="avtexamination_date" class="col-xs-6 col-sm-6 col-md-3 col-form-label">Tanggal Periksa</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group" id="avtexaminationdate">
                                                        <input id="flatavtexamination_date" type="text" class="form-control datetimeflatpickr" placeholder="yyyy-mm-dd">
                                                        <input id="avtexamination_date" name="examination_date" type="hidden" class="form-control" placeholder="yyyy-mm-dd">
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
                                        <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="avtpetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                                    </div>
                                </div>
                                <span id="avttotal_score"></span>
                            </div>
                            <div class="modal-footer">
                                <div class="panel-footer text-end mb-4">
                                    <button type="submit" id="formvitalsignsubmit" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-primary"><?php echo lang('Word.save'); ?></button>
                                    <button type="button" id="formvitalsignedit" onclick="enableVitalSign()" style="display: none;" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-secondary">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-tab-tools text-center mt-4">
                    <a data-toggle="modal" onclick="setDataVitalSign()" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                </div>
                <h3>Histori Vital Sign</h3>
                <table class="table table-striped table-hover">
                    <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                            <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                            <th class="text-center" colspan="6" style="width: 70%;">SOAP</th class="text-center">
                            <th class="text-center" style="width: 5%;"></th class="text-center">
                            <th class="text-center" style="width: 5%;"></th class="text-center">
                        </tr>
                    </thead>
                    <tbody id="vitalSignBody">
                        <?php
                        $total = 0;
                        ?>
                    </tbody>
                </table>
                <div class="d-flex mb-3">
                    <a href="<?= base_url() . '/admin/cetak/cetakVitalSign/' . base64_encode(json_encode($visit)); ?>" target="_blank" class="btn btn-success w-100"><i class="fa fa-print"></i> Cetak</a>
                </div>
                <div class="d-flex mb-3">
                    <a href="<?= base_url() . '/admin/rm/lainnya/nadi_suhu/' . base64_encode(json_encode($visit)); ?>" target="_blank" class="btn btn-warning w-100"><i class="fa fa-print"></i> Lembar Nadi / Suhu</a>
                </div>
            </div>
        </div>
    </div><!--./row-->
</div>
<!-- -->