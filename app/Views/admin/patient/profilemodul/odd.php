<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>


<div class="tab-pane" id="odd" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-12 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
        'visit' => $visit,
      ]);
      ?>
        </div>
        <!--./col-lg-6-->
        <div class="col-lg-10 col-md-12 col-xs-12">
            <div class="accordion mt-4">
                <div class="panel-group table-responsive" id="tableOdd">
                    <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"
                        style="display: flex; justify-content: space-between; align-items: center;">
                        ODD
                        <a href="<?= base_url() . '/admin/rm/lainnya/pengobatan/' . base64_encode(json_encode($visit)); ?>"
                            target="_blank">
                            <button type="button" class="btn btn-sm btn-secondary" id="cetak">Cetak</button></a>
                    </h3>
                    <div class="row mt-4 mb-3">
                        <div class="col-lg-2 col-md-3">
                            <div class="form-group">
                                <label for="startDateOdd">Start Date</label>
                                <input type="text" id="startDateOdd" class="form-control  datetimeflatpickr-Odd-show">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <div class="form-group">
                                <label for="endDateOdd">End Date</label>
                                <input type="text" id="endDateOdd" class="form-control  datetimeflatpickr-Odd-show">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3 mt-4">
                            <div class="form-group">
                                <button type="button" id="btn-search-odd" class="btn btn-primary ">
                                    <i class="fa fa-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </div>
                    <form>
                        <table class="table table-bordered table-hover table-centered" style="text-align: center"
                            id="tablesOdd">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" class="w-auto text-nowrap">Nama Obat</th>
                                    <th scope="col" class="w-auto text-nowrap"></th>
                                    <th scope="col" class="w-auto text-nowrap">Tanggal Diberikan</th>
                                    <th scope="col" class="w-auto text-nowrap">Jumlah Resep</th>
                                    <th scope="col" class="w-auto text-nowrap">Jumlah Diberikan</th>
                                    <th scope="col" class="w-auto text-nowrap">Aturan Pakai</th>
                                    <th scope="col" class="w-auto text-nowrap">Rute</th>
                                    <th scope="col" class="w-auto text-nowrap">Obat Di Berikan</th>
                                </tr>
                            </thead>

                            <tbody id="bodydataOdd" class="table-group-divider">
                                <!-- Isi tabel disini -->
                            </tbody>
                        </table>
                        <div>
                            <button type="button" class="btn btn-sm btn-primary" id="save-tabelsOdd">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Create -->