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
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--.col-lg-2 col-md-2 col-sm-12 border-r-->
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="box-tab-header">
            </div>
            <form id="form1" action="" method="post" class="">
                <div class="box-body row mt-4">
                    <input type="hidden" name="ci_csrf_token" value="">
                    <div class="col-sm-6 col-md-3">
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
                    </div>

                    <div class="col-sm-6 col-md-3">
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
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-4">
                            <div class="form-group">
                                <label>Resep</label>
                                <select name="resepno" id="resepno" class="form-control" onchange="filteredResep(this.value)">
                                </select>
                            </div>
                        </div>
                    </div>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div id="eresepAdd" class="box-tab-tools text-end">
                                    <a data-toggle="modal" onclick="addNR()" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> BUAT E-RESEP Non Racikan</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="eresepRAdd" class="box-tab-tools text-start" style="">
                                    <a data-toggle="modal" onclick="addR()" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> BUAT E-RESEP Racikan</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
                <div class="box-tab-tools">
                    <form id="formprescription" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">
                        <table id="eresepTable" class="table table-hover table-prescription" style="display: block;">
                            <thead class="table-primary" style="text-align: center;">
                                <tr>
                                    <th class="text-center" style="width: 4%;">No.</th class="text-center">
                                    <th class="text-center" style="width: 30%;">Nama Obat</th class="text-center">
                                    <th class="text-center" colspan="2" style="width: 10%;">Jumlah</th class="text-center">
                                    <th class="text-center" colspan="5" style="width: 50%;">Aturan Minum</th class="text-center">
                                    <th class="text-center" style="width: auto;"></th class="text-center">
                                    <th class="text-center" style="width: auto;"></th class="text-center">
                                </tr>
                            </thead>
                            <tbody id="eresepBody">
                                <?php
                                $total = 0;

                                ?>
                            </tbody>

                        </table>
                        <div class="panel-footer text-end mb-4">
                            <button type="submit" id="formaddprescrbtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button style="margin-right: 10px" type="button" id="historyprescbtn" onclick="$('#historyEresepModal').modal('show')" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>History</span></button>
                        </div>
                    </form>
                </div>

            </div>
        </div> <!-- col-lg-10 col-md-10 col-sm-12 -->
    </div><!--./row-->
</div>
<!-- -->