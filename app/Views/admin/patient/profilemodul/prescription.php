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
<div class="tab-pane" id="eresep" role="tabpanel">
    <div class="row">
        <div id="loadContentEresep" class="col-12 center-spinner"></div>
        <div id="contentEresep" class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div><!--.col-lg-2 col-md-2 col-sm-12 border-r-->
            <div class="col-lg-10 col-md-10 col-sm-12">
                <div class="box-tab-header">
                </div>
                <form id="formFilterResep" action="" method="post" class="">
                    <div class="row mt-4">
                        <h3 id="eresepTitle">E-Resep</h3>
                        <hr>
                    </div>
                    <div class="box-body row mt-4">
                        <input type="hidden" name="ci_csrf_token" value="">
                        <!-- <div class="col-sm-6 col-md-3">
                            <div class="mb-4">
                                <div class="form-group">
                                    <label>Poli/Bangsal</label><small class="req"> *</small>
                                    <select id="klinik" class="form-control" name="klinik" onchange="showdate(this.value)" autocomplete="off">
                                        <option value="%">Semua</option>
                                        <?php $cliniclist = array();
                                        foreach ($clinic as $key => $value) {
                                            $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                        }
                                        asort($cliniclist);
                                        ?>
                                        <?php foreach ($cliniclist as $key => $value) { ?>
                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <span class="text-danger" id="error_search_type"></span>
                            </div>
                        </div> -->
                        <!-- <div class="col-sm-6 col-md-3">
                            <div class="mb-4">
                                <div class="form-group">
                                    <label>Relasi</label>
                                    <select name="statuspasien" id="statuspasien" class="form-control">
                                        <option value="%">Semua</option>
                                        <?php foreach ($statusPasien as $key => $value) {
                                            if ($statusPasien[$key]['name_of_status_pasien'] != null && $statusPasien[$key]['name_of_status_pasien'] != '') {
                                        ?>
                                                <option value="<?= $statusPasien[$key]['status_pasien_id']; ?>"><?= $statusPasien[$key]['name_of_status_pasien']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-sm-6 col-md-3" style="display: none;">
                            <div class="mb-4">
                                <div class="form-group">
                                    <label>Eresep bukan</label>
                                    <select name="iseresep" id="iseresep" class="form-control">
                                        <option value="1">eresep</option>
                                        <option value="0">medical item</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 d-none">
                            <div class="mb-4">
                                <div class="form-group">
                                    <label>Resep</label>
                                    <select name="resepno" id="resepno" class="form-control" onchange="filteredResep(this.value)">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 d-none">
                            <div class="mb-4">
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <select name="jenisresep" id="jenisresep" class="form-control">
                                        <option value="1">E-Resep</option>
                                        <option value="5">Obat Pulang</option>
                                        <option value="7">ODD</option>
                                        <option value="8">Medical Item</option>
                                        <option value="0">BMHP</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php if (user()->checkPermission("eresep", "c")) {
                            if (true) { ?>
                                <div id="generateResepGroup" class="row m-4 spppoli-to-hide">
                                    <div class="col-md-12">
                                        <div class="box-tab-tools text-center">
                                            <a id="eresepAddRGenerateResep" data-toggle="modal" onclick="generateResep('<?= $visit['no_registration']; ?>','<?= $visit['clinic_id']; ?>','<?= $visit['isrj']; ?>')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Buat Resep Baru</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="history" class="row m-4 ">
                                    <div class="col-md-12">
                                        <button style="margin-right: 10px" type="button" id="historyprescbtn" onclick="$('#historyEresepModal').modal('show')" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light"><i class="fa fa-history"></i> <span>History & Salin Resep</span></button>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <?php if (user()->checkPermission("medicalitem", "c")) {
                        ?>
                            <div id="medItemBtnGroup" class="row spppoli-to-hide">
                                <div class="col-md-12">
                                    <div id="eresepAdds" class="box-tab-tools text-center">
                                        <a data-toggle="modal" onclick="generateResep('<?= $visit['no_registration']; ?>','<?= $visit['clinic_id']; ?>','<?= $visit['isrj']; ?>')" class="btn btn-primary btn-lg btn-to-hide" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Medical Item</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                        <!-- <div class="row text-center m-4">
                            <button type="button" name="save" data-loading-text="processing" class="btn btn-primary pull-right"
                                onclick="updateWaktu(5)"><i class="fa fa-check-circle"></i> <span>Selesai</span></button>
                        </div> -->
                    </div>
                </form>
                <div class="table-responsive">
                    <style>
                        th {
                            width: 200px;
                        }

                        #eresepBody td {
                            text-align: left;
                        }

                        #eresepBody p {
                            color: cadetblue;
                        }

                        select:invalid {
                            color: gray;
                        }

                        .select2-selection__rendered {
                            color: green;
                        }

                        .table-prescription thead tr th {
                            padding: 0.3rem 0.3rem;
                        }

                        .table-prescription tbody tr td {
                            padding: 0.3rem 0.3rem;
                        }
                    </style>
                    <?php if (isset($permissions['eresep']['c'])) {
                        if ($permissions['eresep']['c'] == '1') { ?>
                    <?php }
                    } ?>
                    <div class="box-tab-tools">
                        <div id="displayResep" class="row">
                        </div>
                    </div>
                </div>
            </div> <!-- col-lg-10 col-md-10 col-sm-12 -->
        </div>
    </div><!--./row-->
</div>
<div class="modal fade" id="prescriptionDetailModal" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content modal-media-content">

            <div class="modal-header modal-media-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <h4 id="modalPrescriptionTitle"></h4>
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div><!--./row-->
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pb0 ptt10">
                <form id="formprescription" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div id="headerMedicalItemDetailModal" class="col-md-4"></div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row" id="divMedicalItem">
                        <div class="col-md-2 col-sm-2 col-xs-2"></div>
                        <div id="" class="col-md-8 col-sm-8 col-sm-12">
                            <div class="card border border-1 rounded-4 m-2 p-2">
                                <h3 class="card-title text-center">Medical Item</h3>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <!-- <input type="hidden" name="visit" id="eresepvisit" value="<?= base64_encode(json_encode($visit)); ?>"> -->
                                            <table id="bhpTable" class="table table-hover table-prescription" style="display: block;">
                                                <thead class="table-primary" style="text-align: center;">
                                                    <tr>
                                                        <th class="text-center" style="width: 30%;">Nama Item</th class="text-center">
                                                        <th class="text-center" colspan="2" style="width: 10%;">Jumlah</th class="text-center">
                                                        <th class="text-center" colspan="3" style="width: 30%;">Keterangan</th class="text-center">
                                                        <!-- <th class="text-center" style="width: 12,5%;"></th class="text-center"> -->
                                                        <th class="text-center" style="width: 12,5%;"></th class="text-center">
                                                    </tr>
                                                </thead>
                                                <tbody id="bhpBody">
                                                </tbody>
                                            </table>
                                            <?php if (user()->checkPermission("medicalitem", "c")) {
                                            ?>
                                                <div id="" class="row spppoli-to-hide">
                                                    <div class="col-md-12">
                                                        <div id="eresepAdds" class="box-tab-tools text-center">
                                                            <a data-toggle="modal" onclick="addNR()" class="btn btn-primary btn-lg btn-to-hide" id="addNrMedicalItemBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Medical Item</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2"></div>
                    </div>
                    <div class="row" id="divEresep">
                        <div id="divNonRacikan" class="col-md-6 col-sm-6 col-sm-12">
                            <div class="card border border-1 rounded-4 m-2 p-2">
                                <h3 class="card-title text-center">Non Racikan</h3>

                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <div class="table-responsive col-xs-12 col-sm-12 col-md-12">
                                            <input type="hidden" name="visit" value="<?= base64_encode(json_encode($visit)); ?>">
                                            <table id="eresepTable" class="table table-hover table-prescription" style="display: block;">
                                                <thead class="table-primary" style="text-align: center;">
                                                    <tr>
                                                        <th class="text-center" style="width: 30%;">Nama Obat</th class="text-center">
                                                        <th class="text-center" colspan="2" style="width: 10%;">Jumlah</th class="text-center">
                                                        <th class="text-center" colspan="3" style="width: 30%;">Signa</th class="text-center">
                                                        <!-- <th class="text-center" style="width: 12,5%;"></th class="text-center"> -->
                                                        <th class="text-center" style="width: 12,5%;"></th class="text-center">
                                                    </tr>
                                                </thead>
                                                <tbody id="eresepNonRacikBody">
                                                </tbody>
                                            </table>
                                            <?php if (user()->checkPermission("eresep", "c")) {
                                                if (true) { ?>
                                                    <div id="eresepBtnGroup" class="row spppoli-to-hide">
                                                        <div class="col-md-12">
                                                            <div class="box-tab-tools text-center ">
                                                                <button id="eresepAddR" onclick="addNR()" type="button" class="btn btn-success btn-lg btn-to-hide" id="addNonRacikanBtn" style="width: 300px"><i class=" fa fa-plus"></i> TAMBAH E-RESEP Non Racikan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }
                                            } ?>
                                            <?php if (user()->checkPermission("medicalitem", "c")) {
                                            ?>
                                                <!-- <div id="" class="row">
                                                    <div class="col-md-12">
                                                        <div id="eresepAdds" class="box-tab-tools text-center">
                                                            <a data-toggle="modal" onclick="addNR()" class="btn btn-primary btn-lg btn-to-hide" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Medical Item</a>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="divRacikan" class="col-md-6 col-sm-6 col-sm-12">
                            <div class="card border border-1 rounded-4 m-2 p-2">
                                <h3 class="card-title text-center">Racikan</h3>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <input type="hidden" name="visit" value="<?= base64_encode(json_encode($visit)); ?>">
                                            <div id="eresepsRacikBody" class="table-responsive">

                                            </div>
                                            <?php if (user()->checkPermission("eresep", "c")) {
                                                if (true) { ?>
                                                    <div id="eresepBtnGroup" class="row spppoli-to-hide">
                                                        <div class="col-md-12">
                                                            <div id="eresepRAddNR" class="box-tab-tools text-center" style="">
                                                                <a data-toggle="modal" onclick="addR()" class="btn btn-warning btn-lg btn-to-hide" id="addRBtn" style="width: 300px"><i class=" fa fa-plus"></i> TAMBAH E-RESEP Racikan</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="panel-footer text-end mb-4 spppoli-to-hide">
                    <button type="submit" id="formAddPrescrBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                    <button type="button" id="formEditPrescrBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-edit"></i> <span>Edit</span></button>
                    <?php if ($visit['isrj'] == 0 && user()->checkRoles(['dokter', 'admin', 'superadmin'])) {
                    ?>
                        <button type="button" id="formStopOddBtn" onclick="stopOddAll()" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-stop"></i> <span>Stop ODD</span></button>
                    <?php
                    } ?>
                    <button style="margin-right: 10px" type="button" id="historyprescbtn" onclick="$('#historyEresepModal').modal('show')" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light"><i class="fa fa-history"></i> <span>History & Salin Resep</span></button>
                </div>
            </div>
        </div>
    </div><!--./modal-body-->
</div>