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
<div class="tab-pane" id="billpoli" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-xs-12">
            <!-- <div class="row mt-4">
                <div class="col-md-12">
                    <div id="listRequestbillpoli" class="row">

                    </div>
                </div>
                <div class="col-md-12">
                    <div id="billpolioratoriumAdd" class="box-tab-tools text-center">
                        <a data-toggle="modal" onclick="requestbillpoli()" class="btn btn-primary btn-lg" id="addbillpoliBtn" style="width: 300px"><i class=" fa fa-plus"></i> Buat billpoli Online</a>
                    </div>
                </div>
            </div>
            <div class="accordion mt-4">
                <div class="panel-group" id="billpoliBody">
                </div>
            </div> -->

            <form id="formbillpoli" action="" method="post" class="">
                <div class="box-body row mt-4">
                    <input type="hidden" name="ci_csrf_token" value="">

                    <div class="col-sm-12 col-md-12 mb-4">
                        <?php if (isset($permissions['tindakanpoli']['c'])) {
                            if ($permissions['tindakanpoli']['c'] == '1') { ?>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Nomor Sesi</label>
                                            <select id="notaNoPoli" class="form-control" style="width: 100%">
                                                <option value="%">Semua</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="">Pencarian Tarif</label>
                                            <div class="div">
                                                <select id="searchTarifbillpoli" class="form-control" style="width: 80%; height: 100%;"></select>
                                                <a data-toggle="modal" onclick='addBillBillPoli("searchTarifbillpoli")' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <style>
                    th {
                        width: 200px;
                    }

                    #chargesBody td {
                        text-align: center;
                    }

                    #chargesBody p {
                        color: cadetblue;
                    }
                </style>
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0">
                        <table class="table table-sm table-hover">
                            <thead class="table-primary" style="text-align: center;">
                                <tr>
                                    <th class="text-center" rowspan="2" style="width: 2%;">No.</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 10%;">Tgl Tindakan</th class="text-center">
                                    <!-- <th class="text-center" rowspan="2">Cetak</th class="text-center"> -->
                                    <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 2%;">Jml</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan</th class="text-center">
                                    <th class="text-center" colspan="2" style="width: 20%;">Tanggungan pihak ke-3</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: auto;">Diskon</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 10%;">Subsidi Satuan</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 10%;">Subsidi Total</th class="text-center">
                                    <th class="text-center" rowspan="2"></th class="text-center">
                                    <!-- <th class="text-center" rowspan="2"></th class="text-center"> -->
                                    <!-- <th class="text-center" rowspan="2">Jenis Pelayanan</th class="text-center">
                            <th class="text-center" rowspan="2">Pembulatan</th class="text-center">
                            <th class="text-center" colspan="15">Info Detil Billing</th class="text-center">
                            <th class="text-center" rowspan="2">Jenis Transaksi</th class="text-center">
                            <th class="text-center" rowspan="2">Tgl Keluar</th class="text-center">
                            <th class="text-center" rowspan="2">Keterangan</th class="text-center">
                            <th class="text-center" colspan="2">Rujukan Dari</th class="text-center">
                            <th class="text-center" rowspan="2">Ruang Rawat Inap</th class="text-center">
                            <th class="text-center" rowspan="2">Cara Keluar</th class="text-center">
                            <th class="text-center" rowspan="2">Tgl Cetak</th class="text-center">
                            <th class="text-center" rowspan="2">No Card</th class="text-center">
                            <th class="text-center" rowspan="2">Jenis Tenaga Medik</th class="text-center">
                            <th class="text-center" rowspan="2">Kasir</th class="text-center">
                            <th class="text-center" colspan="3">Modifikasi</th class="text-center">
                            <th class="text-center" colspan="3">Info Cetak</th class="text-center">
                            <th class="text-center" rowspan="2">ID Transaksi</th class="text-center">
                            <th class="text-center" rowspan="2">Closed Poli ID</th class="text-center">
                            <th class="text-center" rowspan="2">Locked Billing ID</th class="text-center">
                            <th class="text-center" rowspan="2">Setoran</th class="text-center"> -->
                                </tr>
                                <tr>
                                    <th class="text-center">Nilai satuan</th class="text-center">
                                    <th class="text-center">Total</th class="text-center">
                                    <!-- <th class="text-center">Netto</th class="text-center">
                            <th class="text-center">tagihan</th class="text-center">
                            <th class="text-center">Diskon</th class="text-center">
                            <th class="text-center">potongan</th class="text-center">
                            <th class="text-center">subsidi</th class="text-center">
                            <th class="text-center">pembayaran</th class="text-center">
                            <th class="text-center">retur</th class="text-center">
                            <th class="text-center">Nilai PPN</th class="text-center">
                            <th class="text-center">Koreksi</th class="text-center">
                            <th class="text-center">Embalace</th class="text-center">
                            <th class="text-center">Biaya Jasa</th class="text-center">
                            <th class="text-center">Jenis Tarif</th class="text-center">
                            <th class="text-center">PPN</th class="text-center">
                            <th class="text-center">Pokok jual</th class="text-center">
                            <th class="text-center">Margin</th class="text-center">
                            <th class="text-center">Pelayanan</th class="text-center">
                            <th class="text-center">Dokter</th class="text-center">
                            <th class="text-center">oleh</th class="text-center">
                            <th class="text-center">Tanggal</th class="text-center">
                            <th class="text-center">Dari</th class="text-center">
                            <th class="text-center">Oleh</th class="text-center">
                            <th class="text-center">tanggal</th class="text-center">
                            <th class="text-center">Ke</th class="text-center"> -->
                                </tr>
                            </thead>
                            <tbody id="billPoliChargesBody" class="table-group-divider">
                                <?php
                                $total = 0;
                                ?>
                            </tbody>
                        </table>
                        <div class="panel-footer text-end mb-4">
                            <button type="button" id="formSaveBillPoliBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <!-- <button type="button" id="formEditBillPoliBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button> -->
                            <button type="button" id="formsign" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                            <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--./row-->
</div>
<!-- -->