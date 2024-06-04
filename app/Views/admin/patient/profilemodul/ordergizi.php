<?php
$currency_symbol = "Rp. ";
$permissions = user()->getPermissions();
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="tab-pane" id="orderGizi" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div id="ordergiziAdd" class="box-tab-tools text-center">
                        <a data-toggle="modal" onclick="" class="btn btn-primary btn-lg" id="addOrderGiziBtn" style="width: 300px"><i class=" fa fa-plus"></i> Buat Order Gizi</a>
                    </div>
                </div>
            </div>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-4">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Data Pasien</th>
                                <th></th>
                                <th>Makan Pagi</th>
                                <th>Makan Siang</th>
                                <th>Makan Malam</th>
                            </tr>
                        </thead>
                        <tbody id="ordergizi" class="table-group-divider">
                            <tr>
                                <td rowspan="4">1.</td>
                                <td rowspan="4">24-06-2024</td>
                                <td><?= $visit['diantar_oleh']; ?></td>
                                <td>Bentuk</td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="select2 form-control select2-multiple" name="dtype_pagi" id="dtype_pagi1" multiple="multiple" multiple data-placeholder="Choose ...">
                                            <option value="1">Nasi Biasa (NB)</option>
                                            <option value="2">Nasi Lunak (NL)</option>
                                            <option value="3">Bubur Biasa (BB)</option>
                                            <option value="4">Bubur Saring (BS)</option>
                                            <option value="5">Makanan Cair</option>
                                            <option value="6">BBLS</option>
                                            <option value="7">Puasa</option>
                                            <option value="8">Buah</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <select class="select2 form-control select2-multiple" name="dtype_siang" id="dtype_siang1" multiple="multiple" multiple data-placeholder="Choose ...">
                                        <option value="1">Nasi Biasa (NB)</option>
                                        <option value="2">Nasi Lunak (NL)</option>
                                        <option value="3">Bubur Biasa (BB)</option>
                                        <option value="4">Bubur Saring (BS)</option>
                                        <option value="5">Makanan Cair</option>
                                        <option value="6">BBLS</option>
                                        <option value="7">Puasa</option>
                                        <option value="8">Buah</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="select2 form-control select2-multiple" name="dtype_malam" id="dtype_malam1" multiple="multiple" multiple data-placeholder="Choose ...">
                                        <option value="1">Nasi Biasa (NB)</option>
                                        <option value="2">Nasi Lunak (NL)</option>
                                        <option value="3">Bubur Biasa (BB)</option>
                                        <option value="4">Bubur Saring (BS)</option>
                                        <option value="5">Makanan Cair</option>
                                        <option value="6">BBLS</option>
                                        <option value="7">Puasa</option>
                                        <option value="8">Buah</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $visit['no_registration']; ?></td>
                                <td>Jenis</td>
                                <td><input type="text" name="pantangan_pagi" id="pantangan_pagi1" class="form-control"></td>
                                <td><input type="text" name="pantangan_siang" id="pantangan_siang1" class="form-control"></td>
                                <td><input type="text" name="pantangan_malam" id="pantangan_malam1" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><?= $visit['ageyear']; ?> th <?= $visit['agemonth']; ?> bln <?= $visit['ageday'] ?> hr</td>
                                <td>Mineral</td>
                                <td><input type="text" name="dtype_iddesc" id="dtype_iddesc1" class="form-control"></td>
                                <td><input type="text" name="dtype_siangdesc" id="dtype_siangdesc1" class="form-control"></td>
                                <td><input type="text" name="dtype_malamdesc" id="dtype_malamdesc1" class="form-control"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Menu penunggu</td>
                                <td><input type="text" name="penunggu_pagi" id="penunggu_pagi1" class="form-control"></td>
                                <td><input type="text" name="penunggu_siang" id="penunggu_siang1" class="form-control"></td>
                                <td><input type="text" name="penunggu_malam" id="penunggu_malam1" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="panel-footer text-end mb-4">
                        <button type="button" id="formSaveBillOrderGiziBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                        <button type="button" id="formEditBillOrderGiziBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                        <button type="button" id="formsignarm" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                        <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                    </div>
                </div>
                <div class="table-responsive mb-4">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Data Pasien</th>
                                <th></th>
                                <th>Makan Pagi</th>
                                <th>Makan Siang</th>
                                <th>Makan Malam</th>
                            </tr>
                        </thead>
                        <tbody id="ordergizi" class="table-group-divider">
                            <tr>
                                <td rowspan="4">1.</td>
                                <td rowspan="4">24-06-2024</td>
                                <td><?= $visit['diantar_oleh']; ?></td>
                                <td>Bentuk</td>
                                <td><input type="text" name="dtype_pagi" id="dtype_pagi1" class="form-control"></td>
                                <td><input type="text" name="dtype_siang" id="dtype_siang1" class="form-control"></td>
                                <td><input type="text" name="dtype_malam" id="dtype_malam1" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><?= $visit['no_registration']; ?></td>
                                <td>Jenis</td>
                                <td><input type="text" name="pantangan_pagi" id="pantangan_pagi1" class="form-control"></td>
                                <td><input type="text" name="pantangan_siang" id="pantangan_siang1" class="form-control"></td>
                                <td><input type="text" name="pantangan_malam" id="pantangan_malam1" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><?= $visit['ageyear']; ?> th <?= $visit['agemonth']; ?> bln <?= $visit['ageday'] ?> hr</td>
                                <td>Mineral</td>
                                <td><input type="text" name="dtype_iddesc" id="dtype_iddesc1" class="form-control"></td>
                                <td><input type="text" name="dtype_siangdesc" id="dtype_siangdesc1" class="form-control"></td>
                                <td><input type="text" name="dtype_malamdesc" id="dtype_malamdesc1" class="form-control"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Menu penunggu</td>
                                <td><input type="text" name="penunggu_pagi" id="penunggu_pagi1" class="form-control"></td>
                                <td><input type="text" name="penunggu_siang" id="penunggu_siang1" class="form-control"></td>
                                <td><input type="text" name="penunggu_malam" id="penunggu_malam1" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="panel-footer text-end mb-4">
                        <button type="button" id="formSaveBillOrderGiziBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                        <button type="button" id="formEditBillOrderGiziBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                        <button type="button" id="formsignarm" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                        <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                    </div>
                </div>
                <div class="table-responsive mb-4">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Data Pasien</th>
                                <th></th>
                                <th>Makan Pagi</th>
                                <th>Makan Siang</th>
                                <th>Makan Malam</th>
                            </tr>
                        </thead>
                        <tbody id="ordergizi" class="table-group-divider">
                            <tr>
                                <td rowspan="4">1.</td>
                                <td rowspan="4">24-06-2024</td>
                                <td><?= $visit['diantar_oleh']; ?></td>
                                <td>Bentuk</td>
                                <td><input type="text" name="dtype_pagi" id="dtype_pagi1" class="form-control"></td>
                                <td><input type="text" name="dtype_siang" id="dtype_siang1" class="form-control"></td>
                                <td><input type="text" name="dtype_malam" id="dtype_malam1" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><?= $visit['no_registration']; ?></td>
                                <td>Jenis</td>
                                <td><input type="text" name="pantangan_pagi" id="pantangan_pagi1" class="form-control"></td>
                                <td><input type="text" name="pantangan_siang" id="pantangan_siang1" class="form-control"></td>
                                <td><input type="text" name="pantangan_malam" id="pantangan_malam1" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><?= $visit['ageyear']; ?> th <?= $visit['agemonth']; ?> bln <?= $visit['ageday'] ?> hr</td>
                                <td>Mineral</td>
                                <td><input type="text" name="dtype_iddesc" id="dtype_iddesc1" class="form-control"></td>
                                <td><input type="text" name="dtype_siangdesc" id="dtype_siangdesc1" class="form-control"></td>
                                <td><input type="text" name="dtype_malamdesc" id="dtype_malamdesc1" class="form-control"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Menu penunggu</td>
                                <td><input type="text" name="penunggu_pagi" id="penunggu_pagi1" class="form-control"></td>
                                <td><input type="text" name="penunggu_siang" id="penunggu_siang1" class="form-control"></td>
                                <td><input type="text" name="penunggu_malam" id="penunggu_malam1" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="panel-footer text-end mb-4">
                        <button type="button" id="formSaveBillOrderGiziBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                        <button type="button" id="formEditBillOrderGiziBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                        <button type="button" id="formsignarm" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                        <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                    </div>
                </div>
            </div>
        </div>
    </div><!--./row-->

</div>
<!-- -->