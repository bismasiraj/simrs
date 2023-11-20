<div class="tab-pane tab-content-height
<?php if ($giTipe == 3) echo "active"; ?>
" id="rawat_inap">
    <form id="form2" action="" method="post" class="">
        <div class="box-body row mt-4 mb-4">
            <input type="hidden" name="ci_csrf_token" value="">
            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Bangsal</label><small class="req"> *</small>
                    <select id="iklinik" class="form-control" name="klinik" onchange="showdate(this.value)" autocomplete="off">
                        <option value="%">Semua</option>
                        <?php $cliniclist = array();
                        foreach ($clinic as $key => $value) {
                            if ($clinic[$key]['stype_id'] == '3') {
                                $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                            }
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

            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Dokter</label>
                    <select id="idokter" class="form-control" name="dokter" onchange="showdate(this.value)">
                        <option value="%">Semua</option>
                        <?php $dokterlist = array();
                        foreach ($dokter as $key => $value) {
                            foreach ($value as $key1 => $value1) {
                                $dokterlist[$key1] = $value1;
                            }
                        }
                        asort($dokterlist);
                        ?>
                        <?php foreach ($dokterlist as $key => $value) { ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger" id="error_doctor"></span>
                </div>
            </div>


            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Rujukan Dari</label>

                    <select name="rujukan" id="irujukan" class="form-control">
                        <option value="%">Semua</option>
                        <?php foreach ($cliniclist as $key => $value) { ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Relasi</label>
                    <select name="statuspasien" id="istatuspasien" class="form-control">
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
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" id="inama" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>No RM</label>
                    <input type="text" name="norm" id="inorm" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>No Kartu/ SEP</label>
                    <input type="text" name="nokartu" id="inokartu" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" id="iaddress" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="mb-3">
                    <label>Tanggal Awal</label>
                    <div>
                        <div class="input-group" id="imulai">
                            <input name="mulai" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#imulai' value="<?= date('Y-m-d'); ?>">

                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                        </div>
                        <!-- input-group -->
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-2">
                <div class="mb-3">
                    <label>Tanggal Akhir</label>
                    <div>
                        <div class="input-group" id="iakhir">
                            <input name="akhir" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#iakhir' value="<?= date('Y-m-d'); ?>">

                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                        </div>
                        <!-- input-group -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Status Rawat Inap</label>
                    <select name="keluar_id" id="icarakeluar" class="form-control">
                        <?php foreach ($caraKeluar as $key => $value) {
                        ?>
                            <option value="<?= $caraKeluar[$key]['keluar_id']; ?>"><?= $caraKeluar[$key]['cara_keluar']; ?></option>
                        <?php
                        } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="mt-4 text-end">
                    <button id="form2btn" type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </div>
        <!-- <div class="box-body row">

        </div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div> -->
    </form>
    <div class="box-body">
        <div class="mt-4">
            <table id="tableSearchRanap" class="table table-bordered table-hover table-centered" data-export-title="<?php echo lang('Word.ipd_patient'); ?>" style="text-align: center">
                <thead class="table-primary">
                    <style>
                        thead tr th {
                            text-align: center !important;
                        }
                    </style>
                    <tr style="text-align: center">
                        <th>No.MR</th>
                        <th>Nama</th>
                        <th>Alamat/No.Jaminan/No.SEP</th>
                        <th>Status/JK</th>
                        <th>Pelayanan/Dokter/HP/Phone</th>
                        <th>Rujukan dari/Tgl Masuk s/d Tgl Keluar</th>
                        <th>No Tgl Lahir - Umur</th>
                        <th>Ditagihkan ke Kelas / Hak Kelas</th>
                    </tr>
                </thead>
                <tbody id="bodydata2" class="table-group-divider">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="addRanapModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addRanapModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Akomodasi Rawat Inap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div id="loadingHistoryrajal"></div>
                        <table id="ketersediaanTT" class="table table-bordered table-striped table-centered table-hover" data-export-title="<?= lang('Word.patient_list'); ?>">
                            <thead class="table-primary">
                                <tr style="text-align: center">
                                    <th>Nama Bangsal</th>
                                    <th>Nama Ruang / Kode JK</th>
                                    <th>Kelas</th>
                                    <th>Kapasitas</th>
                                    <th>Sisa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="ajaxlist" class="table-group-divider">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Bangsal</label>
                            <select class="form-control" id="ariclinic_id" name="clinic_id" onchange="changeClinicInap(this.value)">
                                <?php foreach ($clinicInap as $key => $value) { ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                            </select>
                            <div id="ariclinic_idalert" class="alert alert-danger mb-0" role="alert" style="display: none;">
                                <strong>Bangsal</strong> tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Ruang</label>
                            <select id="ariclass_room_id" class="form-control" name="class_room_id" onchange="changeClassRoom(this.value)">
                            </select>
                            <div id="ariclass_room_idalert" class="alert alert-danger mb-0" role="alert" style="display: none;">
                                <strong>Ruang</strong> tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Nomor TT</label>
                            <select id="aribed_id" class="form-control" name="bed_id">
                            </select>
                            <div id="aribed_idalert" class="alert alert-danger mb-0" role="alert" style="display: none;">
                                <strong>Nomor TT</strong> tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Tarif</label>
                            <input id="aritarif_name" class="form-control" name="tarif_name" type="hidden">
                            <input id="ariamount_paid" class="form-control" name="amount_paid" type="number" step=".0,1">
                            <input id="aritarif_id" class="form-control" name="tarif_id" type="hidden">
                            <input id="aritarif_type" class="form-control" name="tarif_type" type="hidden">
                            <input id="ariclass_id" class="form-control" name="class_id" type="hidden">
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Dokter DPJP</label>
                            <select id="ariemployee_id" class="form-control" name="employee_id">
                                <?php $dokterlist = array();
                                foreach ($dokter as $key => $value) {
                                    foreach ($value as $key1 => $value1) {
                                        $dokterlist[$key1] = $value1;
                                    }
                                }
                                asort($dokterlist);
                                ?>
                                <?php foreach ($dokterlist as $key => $value) { ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Jenis Perawatan</label>
                            <select class="form-control" id="ariclinic_type" name="clinic_type">
                                <?php foreach ($clinicType as $key => $value) { ?>
                                    <option value="<?= $clinicType[$key]['clinic_type']; ?>"><?= $clinicType[$key]['clinictype']; ?></option>
                                <?php } ?>
                            </select>
                            <div id="ariclinic_typealert" class="alert alert-danger mb-0" role="alert" style="display: none;">
                                <strong>Jenis Perawatan</strong> tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label>Tanggal Awal</label>
                            <div class="input-group" id="arimulai" style="padding:0">
                                <input id="aritreat_date" name="treat_date" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container="#arimulai" value="<?= date('Y-m-d'); ?>">

                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                            </div>
                        </div>
                        <div class="mb-3 row text-end">
                            <button id="saveAddAkomodasi" type="button" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right" onclick="saveAddAkomodasi()">Simpan <i class=" fas fa-check-circle"></i></button>
                        </div>
                    </div>
                </div><!-- row -->
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="historyRajalModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="historyRajalModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Pilih kunjungan rawat jalan yang akan dirawat-inapkan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadingHistoryrajal"></div>
                <table id="historyRajalTable" class="table table-bordered table-striped table-centered table-hover" data-export-title="<?= lang('Word.patient_list'); ?>">
                    <thead class="table-primary">
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Bangsal/Dokter/No TT</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl Keluar</th>
                            <th>Jml Hari</th>
                            <th>Jml Hari s/d hari ini</th>
                            <th>Cara Keluar</th>
                            <th>Tarif</th>
                            <th>Biaya/Hari</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="ajaxlist" class="table-group-divider">
                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->