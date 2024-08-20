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
<div class="tab-pane" id="lab" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-xs-12">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div id="listRequestLab" class="row">

                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div id="laboratoriumAdd" class="box-tab-tools text-center">
                        <a data-toggle="modal" onclick="requestLab()" class="btn btn-primary btn-lg" id="addLabBtn" style="width: 300px"><i class=" fa fa-plus"></i> Buat Lab Online</a>
                    </div>
                </div> -->
            </div>
            <div class="accordion mt-4">
                <div class="panel-group" id="labBody">
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="operasi-tab">
                        <ul class="nav nav-underline mb-3" style="border-bottom: 2px solid var(--bs-border-color);">
                            <li class="nav-item">
                                <a class="nav-link active" href="#transaksi-lab-tab" data-bs-toggle="tab">Transaksi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#catatan-keperawatan" data-bs-toggle="tab">Bridging List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#checklist-keselamatan" data-bs-toggle="tab">Lihat Hasil</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">




                            <div class="tab-pane fade show active" id="transaksi-lab-tab">
                                <form id="formlabbill" action="" method="post">
                                    <div class="row g-3">
                                        <input type="hidden" name="ci_csrf_token" value="">

                                        <div class="col-12">
                                            <?php if (isset($permissions['tindakanpoli']['c']) && $permissions['tindakanpoli']['c'] == '1') { ?>
                                                <div class="row">

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="startDateLab">Start Date</label>
                                                            <input type="date" id="startDateLab" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="endDateLab">End Date</label>
                                                            <input type="date" id="endDateLab" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="notaNoLab">Nomor Sesi</label>
                                                            <div class="input-group">
                                                                <select id="notaNoLab" class="form-select form-select-sm">
                                                                    <option value="%">Semua</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="btn-search-lab"></label>
                                                            <div class="input-group pt-2">
                                                                <button type="button" id="btn-search-lab" class="btn btn-secondary btn-sm" name="cari"> <i class="fa fa-search"></i>Cari</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row mt-3">
                                                    <!-- Pencarian Tarif -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="searchTarifLab">Pencarian Tarif</label>
                                                            <div class="input-group">
                                                                <select id="searchTarifLab" class="form-control fit" style="width: 70%;"></select>
                                                                <button type="button" class="btn btn-primary btn-sm addcharges align-items-end" onclick='addBillLab("searchTarifLab")'>
                                                                    <i class="fa fa-plus"></i> Tambah
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive mt-4">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th class="align-middle">No.</th>
                                                <th class="align-middle">Jenis Tindakan</th>
                                                <th class="align-middle">Tgl Tindakan</th>
                                                <th class="align-middle">Nilai</th>
                                                <th class="align-middle">Jml</th>
                                                <th class="align-middle">Total Tagihan</th>
                                                <th colspan="2">Tanggungan pihak ke-3</th>
                                                <th class="align-middle">Diskon</th>
                                                <th class="align-middle">Subsidi Satuan</th>
                                                <th class="align-middle">Subsidi Total</th>
                                                <th class="align-middle"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="labChargesBody" class="table-group-divider"></tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" id="formSaveBillLabBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary me-2">
                                        <i class="fa fa-check-circle"></i> Simpan
                                    </button>
                                    <button type="button" id="formsign" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning">
                                        <i class="fa fa-signature"></i> Sign
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>







        </div>
    </div>
    <!--./row-->
</div>
<!-- -->