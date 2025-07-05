<?php
$laktasi = array_filter($aValue, function ($value) {
    return $value['p_type'] == 'KBDN001' && $value['parameter_id'] == '01';
});
$uterus = array_filter($aValue, function ($value) {
    return $value['p_type'] == 'KBDN001' && $value['parameter_id'] == '02';
});
$lochea = array_filter($aValue, function ($value) {
    return $value['p_type'] == 'KBDN001' && $value['parameter_id'] == '03';
});
?>
<div class="tab-pane" id="nifas" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>



        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12 mt-4">
            <div class="box-tab-tools text-center">
                <a data-toggle="modal" onclick="initialAddNifas()" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
            </div>
            <h3>Nifas</h3>
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="text-align: center;">
                    <tr>
                        <th class="text-center" style="width: 10%;">No</th>
                        <th class="text-center" style="width: 10%;">Tanggal & Jam</th>
                        <th class="text-center" style="width: 10%;">Keadaan Umum</th>
                        <th class="text-center" style="width: 10%;">Mammae/Laktasi</th>
                        <th class="text-center" style="width: 10%;">Uterus</th>
                        <th class="text-center" style="width: 10%;">LOCHEA</th>
                        <th class="text-center" style="width: 10%;">KOMPLIKASI</th>
                        <th class="text-center" style="width: 10%;">NAMA PETUGAS</th>
                        <th class="text-center" style="width: 10%;">IS SIGNED?</th>
                        <th class="text-center" colspan="2" style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody id="nifasBody">

                </tbody>
            </table>
            <div class="d-flex mb-3">
                <a href="<?= base_url(); ?>/admin/rm/keperawatan/monitoring_nyeri/<?= base64_encode(json_encode($visit)); ?>" target="_blank" class="btn btn-success w-100"><i class="fa fa-print"></i> Cetak</a>
            </div>
        </div>
    </div><!--./row-->
</div>

<div class="modal fade" id="nifasModal" role="dialog" aria-labelledby="myModalLabel" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 text-start">
                            <h4 class="card-title">
                                Nifas
                            </h4>
                        </div>
                        <div class="col-md-8 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body pt0 pb0">
                <div id="anifasDocument" class="" style="">
                    <form id="formNifas" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">
                        <input type="hidden" name="org_unit_code" id="anifasorg_unit_code">
                        <input type="hidden" name="visit_id" id="anifasvisit_id">
                        <input type="hidden" name="trans_id" id="anifastrans_id">
                        <input type="hidden" name="body_id" id="anifasbody_id">
                        <input type="hidden" name="document_id" id="anifasdocument_id">
                        <input type="hidden" name="no_registration" id="anifasno_registration">
                        <input type="hidden" name="p_type" id="anifasp_type" value="KBDN001">
                        <input type="hidden" name="valid_user" id="anifasvalid_user">
                        <input type="hidden" name="valid_pasien" id="anifasvalid_pasien">
                        <input type="hidden" name="valid_date" id="anifasvalid_date">
                        <input type="hidden" name="modified_by" id="anifasmodified_by">
                        <input type="hidden" name="modified_date" id="anifasmodified_date">
                        <div class="card border border-1 rounded-4 m-4 p-4">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <h5 class="font-size-14 mb-4"> Tanggal:</h5>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="anifasexamination_date" name="examination_date" type="datetime-local" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <h5 class="font-size-14 mb-4"> Keadaan Umum:</h5>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea id="anifasgeneral_con" name="general_con" class="form-control" value="">
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-xs-12 col-sm-3 col-md-3"><label for="anifaslactation" class="col-form-label mb-4">Mammae/Laktasi:</label></div>
                                        <div class="col-xs-12 col-sm-9 col-md-9"><select class="form-select" name="lactation" id="anifaslactationss">
                                                <?php
                                                foreach ($laktasi as $key => $value) {
                                                ?>
                                                    <option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select></div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-xs-12 col-sm-3 col-md-3"><label for="anifasuterus" class="col-form-label mb-4">Uterus:</label></div>
                                        <div class="col-xs-12 col-sm-9 col-md-9"><select class="form-select" name="uterus" id="anifasuterus">
                                                <?php
                                                foreach ($uterus as $key => $value) {
                                                ?>
                                                    <option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select></div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-xs-12 col-sm-3 col-md-3"><label for="anifaslochea" class="col-form-label mb-4">LOCHEA:</label></div>
                                        <div class="col-xs-12 col-sm-9 col-md-9"><select class="form-select" name="lochea" id="anifaslochea">
                                                <?php
                                                foreach ($lochea as $key => $value) {
                                                ?>
                                                    <option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select></div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <h5 class="font-size-14 mb-4"> Komplikasi:</h5>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea id="anifascomplication" name="complication" class="form-control" value="">
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-end mb-4">
                                    <button type="submit" id="formNifasSaveBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                    <button style="margin-right: 10px" type="button" id="formNifasEditBtn" onclick="" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>