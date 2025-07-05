<?php

use App\Controllers\Admin\Patient;

$session = session();
$gsPoli = $session->gsPoli;
$permissions = user()->getPermissions();
$basecontroller = new Patient();
$cliniclist = array();
?>
<div class="tab-pane tab-content-height
<?php if ($giTipe == 1 || $giTipe == 2 || $giTipe == 6 || $giTipe == 73 || $giTipe == 50) echo "active"; ?>
" id="operasi">
    <div class="row">
        <div class="mt-4">
            <form id="formsearchoperasi" action="" method="post" class="">
                <div class="box-body row">
                    <div class="box-header with-border">
                        <!-- <?php if ($title == 'old_patient') { ?>
                    <h3 class="box-title titlefix"><?php echo lang('Word.opd_old_patient'); ?></h3>
                <?php } else { ?>
                    <h3 class="box-title titlefix">Rawat Jalan</h3>

                <?php } ?> -->
                    </div>
                    <input type="hidden" name="ci_csrf_token" value="">
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group">
                            <label>Pelayanan</label><small class="req"> *</small>
                            <select id="klinikrajal" class="form-control" name="klinik" onchange="showdate(this.value)" autocomplete="off">
                                <option value="%">Semua</option>
                                <?php if (is_null(user()->employee_id)) { ?>
                                <?php } ?>
                                <?php
                                if ($basecontroller->getLastUrl('vk')) {
                                ?>
                                    <option value="P002">VK</option>
                                <?php
                                } else {
                                ?>
                                    <?php

                                    if ($giTipe != 2 && $giTipe != 5 && $giTipe != 6) {
                                        foreach ($clinic as $key => $value) {
                                            if ($clinic[$key]['stype_id'] == '1')
                                                $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                        }
                                    } else {
                                        foreach ($clinic as $key => $value) {
                                            if ($clinic[$key]['clinic_id'] == $gsPoli)
                                                $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                        }
                                    }
                                    asort($cliniclist);
                                    ?>
                                    <?php foreach ($cliniclist as $key => $value) { ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php } ?>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <span class="text-danger" id="error_search_type"></span>
                    </div>

                    <div class="col-sm-6 col-md-2" <?php if (user()->employee_id != '' && !is_null(user()->employee_id)) { ?> <?php } ?>>
                        <div class="form-group">
                            <label>Dokter</label>
                            <select id="dokter" class="form-control" name="dokter" onchange="showdate(this.value)">
                                <?php if (is_null(user()->employee_id) && user()->employee_id != '70438' && user()->employee_id != '46') { ?>
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
                                    <?php }
                                } else { ?>
                                    <option value="%">Semua</option>
                                    <?php $dokterlist = array();
                                    foreach ($dokter as $key => $value) {
                                        foreach ($value as $key1 => $value1) {
                                            if ($key1 == user()->employee_id) {
                                                $dokterlist[$key1] = $value1;
                                            }
                                        }
                                    }
                                    asort($dokterlist); ?>
                                    <?php foreach ($dokterlist as $key => $value) { ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php } ?>
                                <?php } ?>

                            </select>
                            <span class="text-danger" id="error_doctor"></span>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-2" style="display: none;">
                        <div class="form-group">
                            <label>Rujukan Dari</label>

                            <select name="rujukan" id="rujukan" class="form-control">
                                <option value="%">Semua</option>
                                <?php foreach ($cliniclist as $key => $value) { ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-2" style="display: none;">
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
                    <div class="col-sm-2" style="display: none;">
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama" id="nama" placeholder="" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Nama / Nomor</label>
                            <input type="text" name="norm" id="nama" placeholder="Nama/No.RM/No.SEP/No.BPJS" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2" style="display: none;">
                        <div class="form-group">
                            <label>No Kartu/ SEP</label>
                            <input type="text" name="nokartu" id="nama" placeholder="" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2" style="display: none;">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="address" id="nama" placeholder="" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="mb-3">
                            <label>Tanggal Awal</label>
                            <div>
                                <div class="input-group" id="mulai">
                                    <input name="mulai" type="date" class="form-control" value="<?= date('Y-m-d'); ?>">

                                    <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->

                                </div>
                                <!-- input-group -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-2">
                        <div class="mb-3">
                            <label>Tanggal Akhir</label>
                            <div>
                                <div class="input-group" id="akhir">
                                    <input name="akhir" type="date" class="form-control" value="<?= date('Y-m-d'); ?>">


                                    <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->

                                </div>
                                <!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="mt-4 text-end">
                                    <div class="mb-0">
                                        <div>
                                            <button id="formsearchoperasibtn" type=" submit" name="search" class="btn btn-primary waves-effect waves-light me-1">
                                                <i class="fa fa-search"></i>Cari
                                            </button>
                                            <?php if ($giTipe == 0) {
                                                if (isset($permissions['pendaftaranrajal']['c'])) {
                                                    if ($permissions['pendaftaranrajal']['c'] == '1') { ?>
                                                        <!-- <button type="button" onclick="holdModal('addKunjunganModal')" class="btn btn-secondary waves-effect">
                                                            <i class="fa fa-plus"></i><?php echo lang('Word.add_patient'); ?>
                                                        </button> -->
                                            <?php }
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
    <div class="box-body">
        <div class="">
            <table id="tableSearchOperasi" class="table table-bordered table-hover table-centered" data-export-title="<?php echo lang('Word.opd_patient'); ?>" style="text-align: center">
                <thead class="table-primary">
                    <tr style="text-align: center">
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Umur</th>
                        <th>Pelayanan/Bangsal</th>
                        <th>Jam</th>
                        <th>Tindakan Operasi</th>
                        <th>Operator</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="bodydata" class="table-group-divider">
                </tbody>
            </table>
        </div>
    </div>
</div>