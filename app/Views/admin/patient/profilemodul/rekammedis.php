<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>
<div class="tab-pane active" id="rekammedis" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 mt-4">
            <form id="formaddrm" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                <div class="">
                    <div class="modal-body pt0 pb0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <input name="org_unit_code" id="arorg_unit_code" type="hidden" class="form-control " />
                                <input name="visit_id" id="arvisit_id" type="hidden" class="form-control " />
                                <input name="date_of_diagnosa" id="ardate_of_diagnosa" type="hidden" class="form-control " />
                                <input name="report_date" id="arreport_date" type="hidden" class="form-control " />
                                <input name="theid" id="artheid" type="hidden" class="form-control " />
                                <input name="theaddress" id="artheaddress" type="hidden" class="form-control " />
                                <input name="isrj" id="arisrj" type="hidden" class="form-control " />
                                <input name="kal_id" id="arkal_id" type="hidden" class="form-control " />
                                <input name="clinic_id" id="arclinic_id" type="hidden" class="form-control " />
                                <input name="spesialistik" id="arspesialistik" type="hidden" class="form-control " />
                                <input name="employee_id" id="aremployee_id" type="hidden" class="form-control " />
                                <input name="doctor" id="ardoctor" type="hidden" class="form-control " />
                                <input name="class_room_id" id="arclass_room_id" type="hidden" class="form-control " />
                                <input name="bed_id" id="arbed_id" type="hidden" class="form-control " />
                                <input name="result_id" id="arresult_id" type="hidden" class="form-control " />
                                <input name="keluar_id" id="arkeluar_id" type="hidden" class="form-control " />
                                <input name="in_date" id="arin_date" type="hidden" class="form-control " />
                                <input name="exit_date" id="arexit_date" type="hidden" class="form-control " />
                                <input name="modified_date" id="armodified_date" type="hidden" class="form-control " />
                                <input name="modified_by" id="armodified_by" type="hidden" class="form-control " />
                                <input name="nokartu" id="arnokartu" type="hidden" class="form-control " />
                                <input name="pasien_diagnosa_id" id="arpasien_diagnosa_id" type="hidden" class="form-control " />
                                <input name="no_registration" id="arno_registration" type="hidden" class="form-control " />
                                <input name="thename" id="arthename" type="hidden" class="form-control " />
                                <input name="status_pasien_id" id="arstatus_pasien_id" type="hidden" class="form-control " />
                                <input name="gender" id="argender" type="hidden" class="form-control " />
                                <input name="ageyear" id="arageyear" type="hidden" class="form-control " />
                                <input name="agemonth" id="aragemonth" type="hidden" class="form-control " />
                                <input name="ageday" id="arageday" type="hidden" class="form-control " />
                                <input name="nosep" id="arnosep" type="hidden" class="form-control " />
                                <input name="tglsep" id="artglsep" type="hidden" class="form-control " />
                                <input name="kddpjp" id="artglsep" type="hidden" class="form-control " />
                                <input name="statusantrean" id="arstatusantrean" type="hidden" class="form-control " value="<?= $visit['statusantrean']; ?>" />




                                <div class="row row-eq">


                                    <!-- INI CURRENT FILLING DATA -->



                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div id="ajax_load"></div>
                                        <div class="row">
                                            <h3>Rekam Medis</h3>
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="dividerhr"></div>
                                            </div><!--./col-md-12-->



                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Ringkasan Diagnosis</label>
                                                        <textarea id="ardescription" name="description" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Ringkasan Diagnosis 2</label>
                                                        <textarea id="ardiagnosa_desc_05" name="diagnosa_desc_05" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Riwayat Alergi</label>
                                                        <textarea id="ardiagnosa_desc_06" name="diagnosa_desc_06" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Anamnesis</label>
                                                        <textarea id="aranamnase" name="anamnase" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Periksa Fisik <a id="copyPeriksaFisikBtn" href="#" onclick="copyPeriksaFisik()">(Copy)</a></label>
                                                        <textarea id="arpemeriksaan" name="pemeriksaan" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Periksa Lab <a id="copyPeriksaLabBtn" href="#" onclick="copyPeriksaLab()">(Copy)</a></label>
                                                        <textarea id="arpemeriksaan_02" name="pemeriksaan_02" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Periksa RO <a id="copyPeriksaRadBtn" href="#" onclick="copyPeriksaRad()">(Copy)</a></label>
                                                        <textarea id="arpemeriksaan_03" name="pemeriksaan_03" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Periksa Lain</label>
                                                        <textarea id="arpemeriksaan_05" name="pemeriksaan_05" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Terapi <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                                        <textarea id="arteraphy_desc" name="teraphy_desc" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Instruksi/Anjuran</label>
                                                        <textarea id="arinstruction" name="instruction" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Evaluasi</label>
                                                        <textarea id="armorfologi_neoplasma" name="morfologi_neoplasma" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="pwd">Suspek Penyakit Akibat Kerja</label>
                                                        <textarea id="ardisability" name="disability" rows="2" class="form-control " autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div><!--./col-md-12-->
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="mb-4">
                                                        <h3>Diagnosa</h3>
                                                        <div class="staff-members">
                                                            <div class="table tablecustom-responsive">
                                                                <table id="tablediagnosa" class="table" data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                                                    <?php if (true) { ?>
                                                                        <thead>
                                                                            <th class="text-center" style="width: 40%">Diagnosa</th>
                                                                            <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                                            <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                                                        </thead>
                                                                        <tbody id="bodyDiag">
                                                                        </tbody>
                                                                    <?php }   ?>
                                                                </table>
                                                            </div>
                                                            <div class="box-tab-tools" style="text-align: center;">
                                                                <button type="button" id="formdiag" name="adddiagnosa" onclick="addRowDiag()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="mb-4">
                                                        <h3>Prosedur</h3>
                                                        <div class="staff-members">
                                                            <div class="table tablecustom-responsive">
                                                                <table id="tableprocedure" class="table table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                                                    <?php if (true) { ?>
                                                                        <thead>
                                                                            <th colspan="2">Prosedur (ICD IX)</th>
                                                                        </thead>
                                                                        <tbody id="bodyProc">
                                                                        </tbody>
                                                                    <?php }   ?>
                                                                </table>
                                                            </div>
                                                            <div class="box-tab-tools" style="text-align: center;">
                                                                <button type="button" id="addprocedure" onclick="addRowProc()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Prosedur</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-md-3">
                                                    <div class="mb-3">
                                                        <div id="arrujukan_group" class="form-group">
                                                            <label>Rencana Tindak Lanjut</label>
                                                            <select name="rencanatl" id="arrencanatl" onchange="tindakLanjut()" class="form-control ">
                                                                <option value="1">Diperbolehkan Pulang</option>
                                                                <option value="2">Pemeriksaan Penunjang</option>
                                                                <option value="3">Dirujuk ke</option>
                                                                <option value="4">Kontrol Kembali</option>
                                                                <option value="5">Rawat Inap</option>
                                                                <option value="6">Rujuk Internal Antar Poli</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-3">
                                                    <div class="mb-3">
                                                        <div id="artiperujukan_group" class="form-group" style="display: none">
                                                            <label>Tipe Rujukan</label>
                                                            <select name="tiperujukan" id="artiperujukan" onchange="tindakLanjut()" class="form-control ">
                                                                <option value="1">Penuh</option>
                                                                <option value="2">Parsial</option>
                                                                <option value="3">PRB</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="ardirujukkegroup" class="col-sm-4 col-md-3" style="display: none">
                                                    <div class="mb-3">
                                                        <div class="form-group"><label for="diag_awal">Dirujuk Ke</label>
                                                            <div class="select2-full-width" style="width:100%">
                                                                <select class="form-control  patient_list_ajax" name='dirujukke' id="ardirujukke" style="width: 100%">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="artgl_kontrolgroup" class="col-sm-4 col-md-3" style="display: none">
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label>Tanggal Kontrol</label>
                                                            <div class="input-group" id="artglkontrol">
                                                                <input id="artgl_kontrol" name="tgl_kontrol" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#artglkontrol' value="<?= date('Y-m-d'); ?>">

                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="arkdpoli_kontrolgroup" class="col-sm-4 col-md-3" style="display: none">
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label>Ke Poli</label>
                                                            <select name="kdpoli_kontrol" id="arkdpoli_kontrol" class="form-control ">
                                                                <?php $cliniclist = array();
                                                                foreach ($clinic as $key => $value) {
                                                                    if ($clinic[$key]['stype_id'] == '1') {
                                                                        $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                                                    }
                                                                }
                                                                asort($cliniclist);
                                                                ?>
                                                                <?php foreach ($cliniclist as $key => $value) { ?>
                                                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="ardescriptiongroup" class="col-sm-8 col-md-3" style="display: none">
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label for="pwd">Alasan/Ket</label>
                                                            <textarea id="arprocedure_05" name="procedure_05" rows="1" class="form-control " autocomplete="off"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4">
                                                <div id="arskdpgroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                                    <div class="mb-4">
                                                        <h3>Pembuatan SKDP</h3>
                                                        <div class="staff-members">
                                                            <div class="col-sm-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label>Nomor SKDP</label>
                                                                        <input id="arskdp" name="skdp" placeholder="" type="text" class="form-control " value="" readonly>
                                                                        <span class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-tab-tools" style="text-align: center;">
                                                                <button type="button" id="addskdp" onclick="postKontrol(1)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                                                <button type="button" id="deleteskdp" onclick="deleteKontrol(1)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="arsprigroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                                    <div class="mb-4">
                                                        <h3>Pembuatan SPRI</h3>
                                                        <div class="staff-members">
                                                            <div class="col-sm-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label>Nomor SPRI</label>
                                                                        <input id="arspri" name="spri" placeholder="" type="text" class="form-control " value="" readonly>
                                                                        <span class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-tab-tools" style="text-align: center;">
                                                                <button type="button" id="addspri" onclick="postKontrol(2)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                                                <button type="button" id="deletespri" onclick="deleteKontrol(2)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="arrujukaneksternalgroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                                    <div class="mb-4">
                                                        <h3>Pembuatan Rujukan Eksternal</h3>
                                                        <div class="staff-members">
                                                            <div class="col-sm-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label>Nomor Rujukan</label>
                                                                        <input id="arnorujukan" name="norujukan" placeholder="" type="text" class="form-control " value="" readonly>
                                                                        <span class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-tab-tools" style="text-align: center;">
                                                                <button type="button" id="addnorujukan" onclick="postRujukan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                                                <button type="button" id="deleterujukan" onclick="deleteRujukan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="arrujukaninternalgroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                                    <div class="mb-4">
                                                        <h3>Pembuatan Rujukan Internal</h3>
                                                        <div class="staff-members">
                                                            <div class="col-sm-6 col-md-6">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label>Tanggal Rencana</label>
                                                                        <input id="rujintvisitdate" name=" rujintvisitdate" type="date" class="form-control" placeholder="yyyy-mm-dd" value="<?= date('Y-m-d'); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label>Poli Tujuan</label>
                                                                        <select name='rujintclinicid' id="rujintclinicid" class="form-control select2 act" style="width:100%">
                                                                            <?php $cliniclist = array();
                                                                            foreach ($clinic as $key => $value) {
                                                                                if ($clinic[$key]['stype_id'] == '1') {
                                                                                    $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                                                                }
                                                                            }
                                                                            asort($cliniclist);
                                                                            ?>
                                                                            <?php foreach ($cliniclist as $key => $value) { ?>
                                                                                <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                            <?php } ?>
                                                                        </select> <span class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label>Dokter Tujuan</label>
                                                                        <select name='rujintemployeeid' id="rujintemployeeid" class="form-control select2 act" style="width:100%">
                                                                            <?php $dokterlist = array();
                                                                            foreach ($dokter as $key => $value) {
                                                                                if ($key == 'P003') {
                                                                                    foreach ($value as $key1 => $value1) {
                                                                                        $dokterlist[$key1] = $value1;
                                                                                    }
                                                                                }
                                                                            }
                                                                            asort($dokterlist);
                                                                            ?>
                                                                            <?php foreach ($dokterlist as $key => $value) { ?>
                                                                                <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <span class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-tab-tools" style="text-align: center;">
                                                                <button type="button" id="addnorujukan" onclick="postRujukInternal()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                                                <button type="button" id="deleterujukan" onclick="deleteRujukInternal()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./row-->
                                    </div><!--./col-md-8-->



                                    <!-- INI HISTORY PART -->



                                    <div class="col-lg-6 col-md-6 col-sm-6 col-eq ptt10" style="display: none;">
                                        <div class="row" id="patientDetails" style="display:block">
                                            <div class="col-md-9 col-sm-9 col-xs-9" id="Myinfo">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <table class="table tablecustom table-bordered mb0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="bolds">Tanggal Kunjungan</td>
                                                                    <td id="arhvisit_date"><?= substr($visit['visit_date'], 0, 13); ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div><!-- ./col-md-9 -->
                                        </div>

                                        <div class="row">
                                            <div class="box-header ptbnull">
                                                <h3 class="box-title titlefix">
                                                    History Rekam Medis Pasien </h3>

                                                <div class="box-tools pull-right">

                                                    <div class="dt-buttons btn-group btn-group2">
                                                        <a onclick="prevHistory()" class="btn btn-default dt-button buttons-copy buttons-html5 btn-copy" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Copy"><span>
                                                                <i class="fa fa-caret-square-o-left"></i></span>
                                                        </a>
                                                        <h4 id="currentHistory" class="box-title titlefix">
                                                        </h4>
                                                        <a onclick="nextHistory()" class=" btn btn-default dt-button buttons-excel buttons-html5 btn-excel" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Excel"><span>
                                                                <i class="fa fa-caret-square-o-right"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="dividerhr"></div>
                                            </div><!--./col-md-12-->

                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Ringkasan Diagnosis</label>
                                                    <a href='#' onclick='copydescription()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhdescription" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Ringkasan Diagnosis 2</label>
                                                    <a href='#' onclick='copydiagnosa_desc_05()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhdiagnosa_desc_05" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Riwayat Alergi</label>
                                                    <a href='#' onclick='copydiagnosa_desc_06()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhdiagnosa_desc_06" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Anamnesis</label>
                                                    <a href='#' onclick='copyanamnase()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhanamnase" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa Fisik</label>
                                                    <a href='#' onclick='copypemeriksaan()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhpemeriksaan" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa Lab</label>
                                                    <textarea id="arhpemeriksaan_02" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa RO</label>
                                                    <textarea id="arhpemeriksaan_03" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Periksa Lain</label>
                                                    <textarea id="arhpemeriksaan_05" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Terapi</label>
                                                    <a href='#' onclick='copyteraphy_desc()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhteraphy_desc" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Instruksi/Anjuran</label>
                                                    <a href='#' onclick='copyinstruction()' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-copy'></i></a>
                                                    <textarea id="arhinstruction" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Evaluasi</label>
                                                    <textarea id="arhmorfologi_neoplasma" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="pwd">Suspek Penyakit Akibat Kerja</label>
                                                    <textarea id="arhdisability" rows="2" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="dividerhr"></div>
                                            </div><!--./col-md-12-->
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Rencana Tindak Lanjut</label>
                                                    <select id="arhrujukan" class="form-control " disabled="">
                                                        <option value="1">Diperbolehkan Pulang</option>
                                                        <option value="2">Pemeriksaan Penunjang</option>
                                                        <option value="3">Dirujuk ke</option>
                                                        <option value="4">Kontrol Kembali</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group"><label for="diag_awal">Dirujuk Ke</label>
                                                    <div class="p-2 select2-full-width">
                                                        <select class="form-control  patient_list_ajax" id="arhdirujukke" disabled>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Tanggal Kontrol</label>
                                                    <div class="input-group" id="arhtglkontrol">
                                                        <input id="arhtgl_kontrol" name="tgl_kontrol" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#arhtglkontrol' value="<?= date('Y-m-d'); ?>">

                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-3">
                                                <div class="form-group">
                                                    <label>Ke Poli</label>
                                                    <select id="arhkdpoli_kontrol" class="form-control " disabled="">
                                                        <?php $cliniclist = array();
                                                        foreach ($clinic as $key => $value) {
                                                            if ($clinic[$key]['stype_id'] == '1') {
                                                                $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                                            }
                                                        }
                                                        asort($cliniclist);
                                                        ?>
                                                        <?php foreach ($cliniclist as $key => $value) { ?>
                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-md-3">
                                                <div class="form-group">
                                                    <label for="pwd">Alasan/Ket</label>
                                                    <textarea id="arhdescription" rows="1" class="form-control " autocomplete="off" disabled=""></textarea>
                                                </div>
                                            </div>

                                        </div><!--./row-->
                                    </div><!--./row-->
                                    <div class="panel-footer text-end mb-4">
                                        <button type="submit" id="formaddrmbtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                        <button type="button" id="formeditrm" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                        <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button>
                                    </div>
                                </div><!--./col-md-4-->
                            </div><!--./row-->
                        </div><!--./col-md-12-->
                    </div><!--./row-->
                </div>
            </form>
        </div>
    </div><!--./row-->

</div>
<!-- -->