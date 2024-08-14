<div class="tab-pane fade" id="pra-operasi">
    <form id="formPraOperasi" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
        <?php csrf_field(); ?>
        <input name="org_unit_code" id="apoorg_unit_code" type="hidden" />
        <input name="visit_id" id="apovisit_id" type="hidden" />
        <input name="trans_id" id="apotrans_id" type="hidden" />
        <input name="body_id" id="apobody_id" type="hidden" />

        <div id="accordionPraOperasi" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="accordionPraOperasiInformasiMedis">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordionPraOperasiInformasiMedisContent" aria-expanded="false"
                        aria-controls="accordionPraOperasiInformasiMedisContent">
                        <b>INFORMASI MEDIS</b>
                    </button>
                </h2>
                <div id="accordionPraOperasiInformasiMedisContent" class="accordion-collapse collapse"
                    aria-labelledby="flush-accordionPraOperasiInformasiMedis" data-bs-parent="#accordionPraOperasi">
                    <div class="accordion-body">
                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                            <div class="form-group">
                                <label>Tanggal dan Jam Operasi</label>
                                <div class="position-relative">
                                    <input name="examination_date" id="apoexamination_date" type="datetime-local"
                                        class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="form-group"><label>Riwayat Alergi Non Obat</label>
                                <textarea name="riwayatnonobat" id="aporiwayatnonobat" placeholder="" value=""
                                    class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="form-group"><label>Riwayat Alergi Obat</label>
                                <textarea name="riwayatobat" id="aporiwayatobat" placeholder="" value=""
                                    class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                            <div class="form-group">
                                <label>Hasil Pemeriksaan Penunjang</label>
                                <div class="position-relative">
                                    <input class="form-check-input" type="checkbox" id="apopenunjang" name="penunjang"
                                        value="1">
                                    <span class="h6" id="badge-bb"></span>
                                </div>
                            </div>
                        </div>
                        <div id="praOperasiDiagnosaBody">
                            <div class="row mt-4">
                                <div class="table tablecustom-responsive">
                                    <h4><b>DIAGNOSA</b></h4>
                                    <hr>
                                    <table id="tablediagnosa" class="table">
                                        <thead>
                                            <th class="text-center" style="width: 40%">Diagnosa</th>
                                            <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                            <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis
                                            </th>
                                        </thead>
                                        <tbody id="bodyDiagPraOperation">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-tab-tools" style="text-align: center;">
                                    <button type="button" id="adddiagnosaPraOperasi"
                                        data-loading-text="<?php echo lang('processing') ?>"
                                        class="btn btn-secondary"><i class="fa fa-check-circle"></i>
                                        <span>Diagnosa</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Rencana Operasi</label>
                                    <div class=" position-relative">
                                        <select type="text" name="" id="" placeholder="" value="" class="form-control">
                                        </select>
                                        <span class="h6" id="badge-bb"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Mulai Operasi</label>
                                    <div class=" position-relative">
                                        <input name="start_operation" id="apostart_operation" type="datetime-local"
                                            class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Akhir Operasi</label>
                                    <div class=" position-relative">
                                        <input name="end_operation" id="apoend_operation" type="datetime-local"
                                            class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="table tablecustom-responsive">
                                <h4><b>Produk Darah</b></h4>
                                <hr>
                                <table id="tablediagnosa" class="table">
                                    <thead>
                                        <th class="text-center" style="width: 20%">Jenis Darah</th>
                                        <th class="text-center" style="width: 20%">Jumlah</th>
                                        <th class="text-center" style="width: 20%">Satuan Ukuran</th>
                                        <th class="text-center" style="width: 40%" colspan="2">Keterangan</th>
                                    </thead>
                                    <tbody id="bodyBloodRequest">

                                    </tbody>
                                </table>
                            </div>
                            <div class="box-tab-tools" style="text-align: center;">
                                <button type="button" id="addbloodrequest" name="addbloodrequest"
                                    onclick="addBloodRequest('bodyBloodRequest')"
                                    data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i
                                        class="fa fa-plus"></i> <span>Tambah</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="accordionPraOperasiChecklistHeader">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordionPraOperasiChecklistContent" aria-expanded="false"
                        aria-controls="accordionPraOperasiChecklistContent">
                        <b>CHECKLIST PERSIAPAN OPERASI</b>
                    </button>
                </h2>
                <div id="accordionPraOperasiChecklistContent" class="accordion-collapse collapse"
                    aria-labelledby="accordionPraOperasiChecklistHeader" data-bs-parent="#accordionPraOperasi">
                    <div class="accordion-body" id="cKeperawatanIntraOperatif">
                        <?php
                        $persiapanOperasi = array_filter($aType, function ($item) {
                            return $item['p_type'] == 'OPRS001';
                        });
                        $persiapanOperasip = array_filter($aParameter, function ($item) {
                            return $item['p_type'] == 'OPRS001';
                        });
                        $persiapanOperasiv = array_filter($aValue, function ($item) {
                            return $item['p_type'] == 'OPRS001';
                        });
                        ?>
                        <?php foreach ($persiapanOperasi as $key => $value) {
                        ?>
                        <div class="row mt-4">
                            <h4><b><?= $value['p_description']; ?></b></h4>
                            <hr>

                            <?php foreach (array_filter($persiapanOperasip, function ($value) use ($persiapanOperasi, $key) {
                                    return $value['p_type'] == $persiapanOperasi[$key]['p_type'];
                                }) as $key1 => $value1) {
                                    if ($value1['entry_type'] == '1') {
                                ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                <div class="form-group">
                                    <label><?= $value1['parameter_desc']; ?></label>
                                    <div class=" position-relative">
                                        <input type="text" name="<?= strtolower($value1['column_name']) ?? ''; ?>"
                                            id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder=""
                                            value="" class="form-control">
                                        <span class="h6" id="badge-bb"></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    } else if ($value1['entry_type'] == '2') {
                                    ?>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        id="apo<?= strtolower($value1['column_name']) ?? ''; ?>"
                                        name="<?= strtolower($value1['column_name']) ?? ''; ?>" value="1">
                                    <label
                                        for="apo<?= strtolower($value1['column_name']) ?? ''; ?>"><?= $value1['parameter_desc']; ?></label>
                                </div>
                            </div>
                            <?php
                                    } else if ($value1['entry_type'] == '3') {
                                    ?>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label><?= $value1['parameter_desc']; ?></label>
                                    <div class=" position-relative">
                                        <select type="text" name="<?= strtolower($value1['column_name']) ?? ''; ?>"
                                            id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder=""
                                            value="" class="form-control">
                                            <?php foreach (array_filter($persiapanOperasiv, function ($values) use ($value1) {
                                                            return $values['p_type'] == $value1['p_type'] && $values['parameter_id'] == $value1['parameter_id'];
                                                        }) as $key2 => $value2) {
                                                        ?>
                                            <option value="<?= $value2['value_id']; ?>"><?= $value2['value_desc']; ?>
                                            </option>
                                            <?php
                                                        } ?>
                                        </select>
                                        <span class="h6" id="badge-bb"></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    } else if ($value1['entry_type'] == '4') {
                                    ?>
                            <div class="col-sm-12 mt-2">
                                <div class="form-group"><label><?= $value1['parameter_desc']; ?></label>
                                    <textarea name="<?= strtolower($value1['column_name']) ?? ''; ?>"
                                        id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder=""
                                        value="" class="form-control"></textarea>
                                </div>
                            </div>
                            <?php
                                    } else if ($value1['entry_type'] == '5') {
                                    ?>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label><?= $value1['parameter_desc']; ?></label>
                                    <div class=" position-relative">
                                        <input name="<?= strtolower($value1['column_name']) ?? ''; ?>"
                                            id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>"
                                            type="datetime-local" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <?php
                                    } else if ($value1['entry_type'] == '6') {
                                    ?>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label><?= $value1['parameter_desc']; ?></label>
                                    <div class=" position-relative">
                                        <input class="form-check-input" type="checkbox"
                                            id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>"
                                            name="<?= strtolower($value1['column_name']) ?? ''; ?>" value="1">
                                        <span class="h6" id="badge-bb"></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    } else if ($value1['entry_type'] == '7') {
                                    ?>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label><?= $value1['parameter_desc']; ?></label>
                                    <div class="row position-relative">
                                        <?php foreach (array_filter($persiapanOperasiv, function ($values) use ($value1) {
                                                        return $values['p_type'] == $value1['p_type'] && $values['parameter_id'] == $value1['parameter_id'];
                                                    }) as $key2 => $value2) {
                                                    ?>
                                        <!-- <option value="<?= $value2['value_id']; ?>"><?= $value2['value_desc']; ?></option> -->
                                        <div class="col-md-12">
                                            <div class="form-check mb-3"><input class="form-check-input" type="radio"
                                                    name="<?= $value1['parameter_desc']; ?>"
                                                    id="<?= $value2['p_type'] . $value2['parameter_id'] . $value2['value_id']; ?>"
                                                    value="<?= $value2['value_id']; ?>">
                                                <label class="form-check-label"
                                                    for="<?= $value2['p_type'] . $value2['parameter_id'] . $value2['value_id']; ?>"><?= $value2['value_desc']; ?></label>
                                            </div>
                                        </div>
                                        <?php
                                                    } ?>
                                        <!-- <input class="form-check-input" type="radio" id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>" name="<?= strtolower($value1['column_name']) ?? ''; ?>" value="1">
                                                                                <span class="h6" id="badge-bb"></span> -->
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                }
                                ?>
                        </div>
                        <?php
                        } ?>
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
                                    <input class="form-check-input" type="checkbox" id="apo<?= $value1['value_id']; ?>"
                                        name="" value="1">
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
                                    <input id="apomodified_date" type="datetime-local" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="accordionPraOperasiSurgeryHeader">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordionPraOperasiSurgeryContent" aria-expanded="false"
                        aria-controls="accordionPraOperasiSurgeryContent">
                        <b>SURGERY LOCATION</b>
                    </button>
                </h2>
                <div id="accordionPraOperasiSurgeryContent" class="accordion-collapse collapse"
                    aria-labelledby="accordionPraOperasiSurgeryHeader" data-bs-parent="#accordionPraOperasi">
                    <div class="accordion-body" id="accordionPraOperasiSurgeryBody">

                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-end mt-4">
            <button type="button" id="formPraOperasiAddBtn" name="save" data-loading-text="Tambah"
                class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <span>Tambah</span></button>
            <button type="submit" id="formPraOperasiSaveBtn" name="edit"
                data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i
                    class="fa fa-check-circle"></i> <span>Simpan</span></button>
            <button type="button" id="formPraOperasiEditBtn" name="editrm" onclick=""
                data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i
                    class="fa fa-edit"></i> <span>Edit</span></button>
            <button type="button" id="formPraOperasiSignBtn" name="signrm" onclick=""
                data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i
                    class="fa fa-signature"></i> <span>Sign</span></button>
            <button type="button" id="formPraOperasiCetakBtn" name="" onclick=""
                data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i
                    class="fa fa-signature"></i> <span>Cetak</span></button>
        </div>
    </form>
</div>