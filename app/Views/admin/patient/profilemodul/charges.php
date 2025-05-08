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
<div class="tab-pane" id="charges" role="tabpanel">
    <!-- <div class="box-tab-header">
        <h3 class="box-tab-title">Tindakan</h3>
        <?php if (isset($permissions['tindakanpoli']['c'])) {
            if ($permissions['tindakanpoli']['c'] == '1') { ?>
                <div class="box-tab-tools">
                    <a data-toggle="modal" onclick="holdModal('addBill')" class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                </div>
        <?php }
        } ?>
    </div> -->
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">
            <form id="formSearchingTarifCharges" action="" method="post" class="">
                <div class="box-body row mt-4">
                    <input type="hidden" name="ci_csrf_token" value="">
                    <div class="col-sm-12 col-md-12 mb-4">
                        <div class="row">
                            <div class="col-md-2 d-none">
                                <div class="form-group">
                                    <label for="flatstartDateCharge">Start Date</label>
                                    <input type="text" id="flatstartDateCharge" class="form-control dateflatpickr">
                                    <input type="hidden" id="startDateCharge">
                                </div>
                            </div>
                            <div class="col-md-2 d-none">
                                <div class="form-group">
                                    <label for="flatendDateCharge">End Date</label>
                                    <input type="text" id="flatendDateCharge" class="form-control dateflatpickr">
                                    <input type="hidden" id="endDateCharge">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="notaNoCharge">Nomor Sesi</label>
                                    <div class="input-group">
                                        <select id="notaNoCharge" class="form-select">
                                            <option value="%">Semua</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="casemixId">Kategori</label>
                                    <div class="input-group">
                                        <select id="casemixId" class="form-select ">
                                            <option value="%">Semua</option>
                                            <option value="1"> Prosedur Non Bedah </option>
                                            <option value="2"> Prosedur Bedah </option>
                                            <option value="3"> Konsultasi </option>
                                            <option value="4"> Tenaga Ahli </option>
                                            <option value="5"> Keperawatan </option>
                                            <option value="6"> Penunjang </option>
                                            <option value="7"> Radiologi </option>
                                            <option value="8"> Laboratorium </option>
                                            <option value="9"> Pelayanan Darah </option>
                                            <option value="10"> Rehabilitasi </option>
                                            <option value="11"> Kamar / Akomodasi </option>
                                            <option value="12"> Rawat Intensif </option>
                                            <option value="13"> Obat </option>
                                            <option value="14"> Alkes </option>
                                            <option value="15"> BMHP </option>
                                            <option value="16"> Alat Medis </option>
                                            <option value="17"> Obat Kronis </option>
                                            <option value="18"> Obat Kemotherpy </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="btn-search-charge"></label>
                                    <div class="input-group pt-2">
                                        <button type="button" id="btn-search-charge" class="btn btn-secondary w-100" name="cari"> <i class="fa fa-search"></i>Cari</button>
                                    </div>
                                </div>
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
                                    <th class="text-center" rowspan="2" style="width: 5%;">No.</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 20%;">Dokter</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 20%;">Tgl Tindakan</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 10%;">Jml</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan</th class="text-center">
                                    <th class="text-center" rowspan="2" style="width: 5%"></th class="text-center">
                                </tr>
                            </thead>
                            <tbody id="chargesBody" class="table-group-divider">
                                <?php
                                $total = 0;
                                ?>
                            </tbody>
                            <tfoot class="table-group-divider">
                                <tr>
                                    <td colspan='7' class="align_right">
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <label for="tagihan_total" class="col-sm-3 col-form-label text-end"><?php echo "Total" . " : " . $currency_symbol . ""; ?></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control text-end" id="tagihan_total" name="tagihan_total" placeholder="" disabled></input>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='7' class="align_right">
                                        <div class="row">
                                            <div class="col-sm-5"></div>
                                            <label for="subsidi_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Subsidi/Tanggungan/Piutang Pihak Ketiga" . " : " . $currency_symbol . ""; ?></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control text-end" id="subsidi_total" name="subsidi_total" placeholder="" disabled></input>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='7' class="align_right">
                                        <div class="row">
                                            <div class="col-sm-5"></div>
                                            <label for="potongan_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Potongan" . " : " . $currency_symbol . ""; ?></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control text-end" id="potongan_total" name="potongan_total" placeholder="" disabled></input>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='7' class="align_right">
                                        <div class="row">
                                            <div class="col-sm-5"></div>
                                            <label for="pembulatan_total" class="col-sm-4 col-form-label text-end"><?php echo "Pembulatan" . " : " . $currency_symbol . ""; ?></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control text-end" id="pembulatan_total" name="pembulatan_total" placeholder="" disabled></input>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='7' class="align_right">
                                        <div class="row">
                                            <div class="col-sm-5"></div>
                                            <label for="pelunasan_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Pelunasan/Angsuran/Titipan/Deposit" . " : " . $currency_symbol . ""; ?></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control text-end" id="pelunasan_total" name="pelunasan_total" placeholder="" disabled></input>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='7' class="align_right">
                                        <div class="row">
                                            <div class="col-sm-5"></div>
                                            <label for="pembayaran_total" class="col-sm-4 col-form-label text-end"><?php echo "Total Retur Pembayaran" . " : " . $currency_symbol . ""; ?></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control text-end" id="pembayaran_total" name="pembayaran_total" placeholder="" disabled></input>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='7' class="align_right">
                                        <div class="row">
                                            <div class="col-sm-5"></div>
                                            <label for="totalnya" class="col-sm-4 col-form-label text-end">
                                                <h3><?php echo "Tagihan" . " : " . $currency_symbol . ""; ?></h3>
                                            </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control border border-primary border-3 text-end" id="totalnya" name="totalnya" placeholder="" disabled></input>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='7' class="align_right">
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
        </div>
    </div><!--./row-->
</div><!--#/charges-->
<!-- -->