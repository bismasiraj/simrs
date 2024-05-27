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
<div class="tab-pane" id="rad" role="tabpanel">
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
                    <div id="listRequestRad" class="row">

                    </div>
                </div>
                <div class="col-md-12">
                    <div id="radiologiAdd" class="box-tab-tools text-center">
                        <a data-toggle="modal" onclick="requestRad()" class="btn btn-primary btn-lg" id="addRadBtn" style="width: 300px"><i class=" fa fa-plus"></i> Buat Radiologi Online</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-4 mb-4">
                <table class="table table-striped table-hover">
                    <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th class="text-center" rowspan="2" style="width: 10%;">Kode</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 30%;">Nama Tindakan</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Tanggal</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Dokter Pemeriksa</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: auto;">Nota</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: auto;"></th class="text-center">
                        </tr>
                    </thead>
                    <tbody id="radBody">
                        <?php
                        $total = 0;

                        ?>


                    </tbody>

                </table>
            </div>
            <form id="form1" action="" method="post" class="">
                <div class="box-body row mt-4">
                    <input type="hidden" name="ci_csrf_token" value="">

                    <div class="col-sm-12 col-md-12 mb-4">
                        <?php if (isset($permissions['tindakanpoli']['c'])) {
                            if ($permissions['tindakanpoli']['c'] == '1') { ?>
                                <div class="row">

                                    <div class="col-md-8"><select id="searchTarifRad" class="form-control" style="width: 100%"></select></div>

                                    <div class="col-md-4">
                                        <div class="box-tab-tools">
                                            <a data-toggle="modal" onclick='addBillRad("searchTarifRad")' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </form>
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
                        <tbody id="radChargesBody" class="table-group-divider">
                            <?php
                            $total = 0;
                            ?>
                        </tbody>
                        <tfoot class="table-group-divider" style="display: none">
                            <tr>
                                <td colspan='11' class="align_right">
                                    <div class="row">
                                        <div class="col-sm-6"></div>
                                        <label for="labtagihan_total" class="col-sm-3 col-form-label text-end"><?php echo "Total" . " : " . $currency_symbol . ""; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control text-end" id="radtagihan_total" name="radtagihan_total" placeholder="" disabled></input>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan='11' class="align_right">
                                    <div class="row">
                                        <div class="col-sm-5"></div>
                                        <label for="radsubsidi_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Subsidi/Tanggungan/Piutang Pihak Ketiga" . " : " . $currency_symbol . ""; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control text-end" id="radsubsidi_total" name="radsubsidi_total" placeholder="" disabled></input>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan='11' class="align_right">
                                    <div class="row">
                                        <div class="col-sm-5"></div>
                                        <label for="labpotongan_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Potongan" . " : " . $currency_symbol . ""; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control text-end" id="radpotongan_total" name="radpotongan_total" placeholder="" disabled></input>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan='11' class="align_right">
                                    <div class="row">
                                        <div class="col-sm-5"></div>
                                        <label for="labpembulatan_total" class="col-sm-4 col-form-label text-end"><?php echo "Pembulatan" . " : " . $currency_symbol . ""; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control text-end" id="radpembulatan_total" name="radpembulatan_total" placeholder="" disabled></input>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan='11' class="align_right">
                                    <div class="row">
                                        <div class="col-sm-5"></div>
                                        <label for="radpelunasan_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Pelunasan/Angsuran/Titipan/Deposit" . " : " . $currency_symbol . ""; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control text-end" id="radpelunasan_total" name="radpelunasan_total" placeholder="" disabled></input>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan='11' class="align_right">
                                    <div class="row">
                                        <div class="col-sm-5"></div>
                                        <label for="radpembayaran_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Retur Pembayaran" . " : " . $currency_symbol . ""; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control text-end" id="radpembayaran_total" name="radpembayaran_total" placeholder="" disabled></input>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan='11' class="align_right">
                                    <div class="row">
                                        <div class="col-sm-5"></div>
                                        <label for="radtotalnya" class="col-sm-4 col-form-label text-end">
                                            <h3><?php echo "Tagihan" . " : " . $currency_symbol . ""; ?></h3>
                                        </label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control border border-primary border-3 text-end" id="radtotalnya" name="radtotalnya" placeholder="" disabled></input>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan='11' class="align_right">
                                    <div class="row">
                                        <div class="col-sm-5"></div>
                                        <label for="inacbg" class="col-sm-4 col-form-label text-end"><?php echo "Tarif INACBG" . " : " . $currency_symbol . ""; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control text-end" id="inacbg" name="inacbg" placeholder="" disabled></input>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div><!--./row-->

</div>
<!-- -->