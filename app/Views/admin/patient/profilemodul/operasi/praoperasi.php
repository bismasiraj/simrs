<div class="tab-pane fade" id="pra-operasi">
    <form id="formPraOperasi" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
        <?php csrf_field(); ?>

        <input id="apovisit_id" name="visit_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['visit_id']; ?>" />
        <input id="apoorg_unit_code" name="org_unit_code" placeholder="" type="hidden" class="form-control block" value="<?= $visit['org_unit_code']; ?>" />
        <input id="apobody_id" name="body_id" placeholder="" type="hidden" class="form-control block" value="" />
        <input id="apotrans_id" name="trans_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['trans_id'] ?>" />
        <div id="accordionPraOperasi" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="accordionPraOperasiInformasiMedis">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPraOperasiInformasiMedisContent" aria-expanded="false" aria-controls="accordionPraOperasiInformasiMedisContent">
                        <b>INFORMASI MEDIS</b>
                    </button>
                </h2>
                <div id="accordionPraOperasiInformasiMedisContent" class="accordion-collapse collapse" aria-labelledby="flush-accordionPraOperasiInformasiMedis" data-bs-parent="#accordionPraOperasi">
                    <div class="accordion-body">
                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                            <div class="form-group">
                                <label>Tanggal dan Jam Operasi</label>
                                <div class="position-relative">
                                    <input name="examination_date" id="apoexamination_date" type="hidden" class="form-control" value="">
                                    <input class="form-control datetimeflatpickr" type="text" id="flatapoexamination_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="form-group"><label>Riwayat Alergi Non Obat</label>
                                <textarea name="riwayatnonobat" id="aporiwayatnonobat" placeholder="" value="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="form-group"><label>Riwayat Alergi Obat</label>
                                <textarea name="riwayatobat" id="aporiwayatobat" placeholder="" value="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                            <div class="form-group">
                                <label>Hasil Pemeriksaan Penunjang</label>
                                <div class="position-relative">
                                    <input class="form-check-input" type="checkbox" id="apopenunjang" name="penunjang" value="1">
                                    <span class="h6" id="badge-bb"></span>
                                </div>
                            </div>
                        </div>
                        <div id="praOperasiDiagnosaBody">

                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Rencana Operasi</label>
                                    <div class=" position-relative">
                                        <input type="text" id="operation_planning" class="form-control">
                                        <span class="h6" id="badge-bb"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Mulai Operasi</label>
                                    <div class=" position-relative">
                                        <input name="start_operation" id="apostart_operation" type="hidden" class="form-control" value="">
                                        <input class="form-control datetimeflatpickr" type="text" id="flatapostart_operation">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Akhir Operasi</label>
                                    <div class=" position-relative">
                                        <input name="end_operation" id="apoend_operation" type="hidden" class="form-control" value="">
                                        <input class="form-control datetimeflatpickr" type="text" id="flatapoend_operation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="containerBloodRequest">

                        </div>
                        <div id="containerBloodRequestHistory">

                        </div>

                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="accordionPraOperasiChecklistHeader">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPraOperasiChecklistContent" aria-expanded="false" aria-controls="accordionPraOperasiChecklistContent">
                        <b>CHECKLIST PERSIAPAN OPERASI</b>
                    </button>
                </h2>
                <div id="accordionPraOperasiChecklistContent" class="accordion-collapse collapse" aria-labelledby="accordionPraOperasiChecklistHeader" data-bs-parent="#accordionPraOperasi">
                    <div class="accordion-body" id="cKeperawatanIntraOperatif2">
                        <div id="cKeperawatanoprs001">

                        </div>
                        <div class="row mt-4">
                            <h4><b>Penyakit Kronis</b></h4>
                            <hr>
                            <?php
                            $kronis = array_filter($aValue, function ($item) {
                                return $item['p_type'] == 'GEN0009' && $item['parameter_id'] == '05';
                            });
                            foreach ($kronis as $key1 => $value1) {

                            ?>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="apo<?= $value1['value_id']; ?>" name="" value="1">
                                        <label><?= $value1['value_desc']; ?></label>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                            <div class="form-group">
                                <label>Tanggal dan Jam Checklist</label>
                                <div class="position-relative">
                                    <input id="apomodified_date" type="hidden" class="form-control" value="">
                                    <input class="form-control datetimeflatpickr" type="text" id="flatapomodified_date">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="accordionPraOperasiSurgeryHeader">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPraOperasiSurgeryContent" aria-expanded="false" aria-controls="accordionPraOperasiSurgeryContent">
                        <b>SURGERY LOCATION</b>
                    </button>
                </h2>
                <div id="accordionPraOperasiSurgeryContent" class="accordion-collapse collapse" aria-labelledby="accordionPraOperasiSurgeryHeader" data-bs-parent="#accordionPraOperasi">
                    <div class="accordion-body" id="accordionPraOperasiSurgeryBody">

                    </div>
                    <div id="ttd-praOps"></div>

                </div>
            </div>
        </div>
        <div class="panel-footer text-end mt-4">
            <button type="button" id="btn-print-praoperasi2" class="btn btn-success">
                <i class="fas fa-print"></i> Cetak
            </button>
            <button type="button" id="formPraOperasiAddBtn" name="save" data-loading-text="Tambah" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <span>Tambah</span></button>
            <button type="submit" id="formPraOperasiSaveBtn" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
            <button type="button" id="formPraOperasiEditBtn" name="editrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
            <button type="button" id="formPraOperasiCetakBtn" name="" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fa fa-signature"></i> <span>Cetak</span></button>
        </div>
    </form>
</div>