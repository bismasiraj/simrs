<?php
$session = session();
$gsPoli = $session->gsPoli;
$permissions = user()->getPermissions();
?>

<div class="tab-pane tab-content-height
<?php if ($giTipe == 1 || $giTipe == 2 || $giTipe == 73 || $giTipe == 50) echo "active"; ?>
" id="rawat_jalan">
    <div class="row">
        <div class="mt-4">

            <form id="form1" action="" method="post" class="">
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
                            <label>Poli</label><small class="req"> *</small>
                            <select id="klinikrajal" class="form-control" name="klinik" onchange="showdate(this.value)" autocomplete="off">
                                <option value="%">Semua</option>
                                <?php if (is_null(user()->employee_id)) { ?>
                                <?php } ?>
                                <?php $cliniclist = array();
                                if ($giTipe != 2 && $giTipe != 5) {
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
                            </select>
                        </div>
                        <span class="text-danger" id="error_search_type"></span>
                    </div>

                    <div class="col-sm-6 col-md-2" <?php if (user()->employee_id != '' && !is_null(user()->employee_id)) { ?> style="display: none;" <?php } ?>>
                        <div class="form-group">
                            <label>Dokter</label>
                            <select id="dokter" class="form-control" name="dokter" onchange="showdate(this.value)">
                                <?php if (is_null(user()->employee_id)) { ?>
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
                                            <button id="form1btn" type=" submit" name="search" class="btn btn-primary waves-effect waves-light me-1">
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
            <table id="tableSearchRajal" class="table table-bordered table-hover table-centered" data-export-title="<?php echo lang('Word.opd_patient'); ?>" style="text-align: center">
                <thead class="table-primary">
                    <tr style="text-align: center">
                        <th>Antrian</th>
                        <th>Nama/No RM/<br>Cara Kunjung</th>
                        <th>Tanggal Kunjungan/<br>Tanggal Lahir</th>
                        <th>Asuransi/Gender/<br>Agama</th>
                        <th>Poli/Asal Poli/<br>Dokter</th>
                        <th>No SEP / Rujukan</th>
                        <th>Poli Asal / Kelas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="bodydata" class="table-group-divider">
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .table-biodata>tbody>tr>td:nth-child(even) {
        text-align: left;
    }

    .table-biodata>tbody>tr>td:nth-of-type(odd)>* {
        text-align: right;
    }
</style>
<div id="addKunjunganModal" class="modal fade" tabindex="-1" aria-labelledby="#addKunjunganModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <form id="formpv" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
            <div class="modal-content rounded-4">
                <div class="modal-header bg-light">
                    <h3 class="modal-title mt-0 identityPv">
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <input id="pvcurrentkey" type="hidden" class="form-control" />
                            <input name="visit_id" id="pvvisit_id" type="hidden" class="form-control" />
                            <input name="trans_id" id="pvtrans_id" type="hidden" class="form-control" />
                            <input name="no_registration" id="pvno_registration" type="hidden" class="form-control" />
                            <input name="diantar_oleh" id="pvdiantar_oleh" type="hidden" class="form-control" />
                            <input name="visitor_address" id="pvvisitor_address" type="hidden" class="form-control" />
                            <input name="org_unit_code" id="pvorg_unit_code" type="hidden" class="form-control" />
                            <input name="tgl_lahir" id="pvtgl_lahir" type="hidden" class="form-control" />
                            <input name="gender" id="pvgender" type="hidden" class="form-control" />
                            <input name="payor_id" id="pvpayor_id" type="hidden" class="form-control" />
                            <input name="clinic_id_from" id="pvclinic_id_from" type="hidden" class="form-control" />
                            <input name="pasien_id" id="pvpasien_id" type="hidden" class="form-control" />
                            <input name="karyawan" id="pvkaryawan" type="hidden" class="form-control" />
                            <input name="family_status_id" id="pvfamily_status_id" type="hidden" class="form-control" />
                            <input name="account_id" id="pvaccount_id" type="hidden" class="form-control" />
                            <input name="coverage_Id" id="pvcoverage_Id" type="hidden" class="form-control" />
                            <input name="ageday" id="pvageday" type="hidden" class="form-control" />
                            <input name="agemonth" id="pvagemonth" type="hidden" class="form-control" />
                            <input name="ageyear" id="pvageyear" type="hidden" class="form-control" />
                            <input name="kode_agama" id="pvagama" type="hidden" class="form-control" />
                            <input name="aktif" id="pvaktif" type="hidden" class="form-control" />
                            <input name="isrj" id="pvisrj" type="hidden" class="form-control" />
                            <input name="responpost_vklaim" id="pvresponpost_vklaim" type="hidden" class="form-control" />
                            <input name="responput_vklaim" id="pvresponput_vklaim" type="hidden" class="form-control" />
                            <input name="respondel_vklaim" id="pvrespondel_vklaim" type="hidden" class="form-control" />
                            <input name="statusantrean" id="pvstatusantrean" type="hidden" class="form-control" />


                            <div class="row row-eq">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="btn-group">
                                        <button id="paginationRajalPrev" type="button" class="fc-prev-button btn btn-primary" aria-label="prev" onclick='viewKunjunganOnModal(1)'><span class="fa fa-chevron-left"></span></button>
                                        <span id="paginationRajalText" class="bg-primary p-2 text-white">1 out of 54</span>
                                        <button id="paginationRajalNext" type="button" class="fc-next-button btn btn-primary" aria-label="next" onclick='viewKunjunganOnModal(-1)'><span class="fa fa-chevron-right"></span></button>
                                    </div>
                                    <div class="accordion m-4" id="accordionPv">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingKunjungan">
                                                <button id="headingKunjunganBtn" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKunjungan" aria-expanded="false" aria-controls="collapseKunjungan">
                                                    <b>Kunjungan</b>
                                                </button>
                                            </h2>
                                            <div id="collapseKunjungan" class="accordion-collapse collapse show" aria-labelledby="headingKunjungan" data-bs-parent="#accordionPv">
                                                <div class="accordion-body text-muted">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="dividerhr"></div>
                                                        </div><!--./col-md-12-->

                                                        <div class="col-sm-4 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="clinic_id">Tujuan</label>
                                                                <div>
                                                                    <select name='clinic_id' id="pvclinic_id" class="form-control select2 act" style="width:100%">
                                                                        <?php $cliniclist = array();
                                                                        foreach ($clinic as $key => $value) {
                                                                            if ($giTipe == 5) {
                                                                                if ($clinic[$key]['stype_id'] == '5') {
                                                                                    $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                                                                }
                                                                            } else if ($clinic[$key]['stype_id'] == '1') {
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
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="employee_id">Dokter</label>
                                                                <div>
                                                                    <select name='employee_id' id="pvemployee_id" class="form-control select2 act" style="width:100%">
                                                                        <?php $dokterlist = array();
                                                                        foreach ($dokter as $key => $value) {
                                                                            if ($key == 'P003') {
                                                                                foreach ($value as $key1 => $value1) {
                                                                                    $dokterlist[$key1] = $value1;
                                                                                }
                                                                            }
                                                                        }
                                                                        asort($dokterlist);
                                                                        ?>
                                                                        <?php foreach ($dokterlist as $key => $value) { ?>
                                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="kddpjp">DPJP</label>
                                                                <div>
                                                                    <select name='kddpjp' id="pvkddpjp" class="form-control select2 act" style="width:100%">
                                                                        <?php $dpjplist = array();
                                                                        foreach ($dokter as $key => $value) {
                                                                            foreach ($value as $key1 => $value1) {
                                                                                foreach ($dpjp as $dpjpkey => $dpjpvalue) {
                                                                                    foreach ($dpjpvalue as $dpjpkey1 => $dpjpvalue1) {
                                                                                        if ($key1 == $dpjpkey) {
                                                                                            $dpjplist[$dpjpkey1] = $value1;
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        asort($dpjplist);
                                                                        ?>
                                                                        <?php foreach ($dpjplist as $key => $value) {
                                                                        ?>
                                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                        <?php
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="class_id">Kelas</label>
                                                                <div>
                                                                    <select name='class_id' id="pvclass_id" class="form-control select2 act" style="width:100%">
                                                                        <?php foreach ($kelas as $key => $value) { ?>
                                                                            <option value="<?= $kelas[$key]['class_id']; ?>"><?= $kelas[$key]['name_of_class']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="class_id_plafond">Hak Kelas</label>
                                                                <div>
                                                                    <select name='class_id_plafond' id="pvclass_id_plafond" class="form-control select2 act" style="width:100%">
                                                                        <?php foreach ($kelas as $key => $value) { ?>
                                                                            <option value="<?= $kelas[$key]['class_id']; ?>"><?= $kelas[$key]['name_of_class']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="status_pasien_id">Status Bayar</label>
                                                                <div>
                                                                    <select name='status_pasien_id' id="pvstatus_pasien_id" class="form-control select2 act" style="width:100%">
                                                                        <?php foreach ($statusPasien as $key => $value) { ?>
                                                                            <option value="<?= $statusPasien[$key]['status_pasien_id']; ?>"><?= $statusPasien[$key]['name_of_status_pasien']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="mb-3">
                                                                <label>Tgl Kunj/SEP</label>
                                                                <div>
                                                                    <div class="input-group" id="pvvisit_dategroup">
                                                                        <input name="visit_date" class="form-control" type="datetime-local" id="pvvisit_date">
                                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                    </div>
                                                                    <!-- input-group -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <div class="mb-3">
                                                                <label>Booking</label>
                                                                <div>
                                                                    <div class="input-group" id="pvbooked_dategroup">
                                                                        <input name="booked_date" class="form-control" type="datetime-local" id="pvbooked_date">

                                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                                                    </div>
                                                                    <!-- input-group -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 col-xs-4 mb-3">
                                                            <label for="kdpoli_eks">Eksekutif</label>
                                                            <div class="form-group">
                                                                <div>
                                                                    <select name='kdpoli_eks' id="pvkdpoli_eks" class="form-control select2 act" style="width:100%">
                                                                        <option value="1">Ya</option>
                                                                        <option value="0">Tidak</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="isnew">Baru</label>
                                                                <div>
                                                                    <select name='isnew' id="pvisnew" class="form-control select2 act" style="width:100%">
                                                                        <option value="1">Ya</option>
                                                                        <option value="0">Tidak</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="cob">COB</label>
                                                                <div>
                                                                    <select name='cob' id="pvcob" class="form-control select2 act" style="width:100%">
                                                                        <option value="1">Ya</option>
                                                                        <option value="0">Tidak</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="pvbackcharge">Katarak</label>
                                                                <div>
                                                                    <select name='backcharge' id="pvbackcharge" class="form-control select2 act" style="width:100%">
                                                                        <option value="1">Ya</option>
                                                                        <option value="0">Tidak</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="pvway_id">Cara Datang</label>
                                                                <div>
                                                                    <select name='way_id' id="pvway_id" class="form-control select2 act" style="width:100%">
                                                                        <?php foreach ($way as $key => $value) { ?>
                                                                            <option value="<?= $way[$key]['way_id']; ?>"><?= $way[$key]['way']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="pvreason_id">Alasan/Lakalantas</label>
                                                                <div>
                                                                    <select name='reason_id' id="pvreason_id" class="form-control select2 act" style="width:100%">
                                                                        <?php foreach ($reason as $key => $value) { ?>
                                                                            <option value="<?= $reason[$key]['reason_id']; ?>"><?= $reason[$key]['reason']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="pvisattended">Sudah Dilayani</label>
                                                                <select name='isattended' id="pvisattended" class="form-control select2 act" style="width:100%">
                                                                    <?php foreach ($isattended as $key => $value) { ?>
                                                                        <option value="<?= $isattended[$key]['isattended']; ?>"><?= $isattended[$key]['visitstatus']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="pvisattended">No Urut</label>
                                                                <input id="pvticket_no" name="ticket_no" class="form-control" type="text" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-xs-12 mb-3">
                                                            <div class="form-group">
                                                                <label for="description">Catatan</label>
                                                                <textarea id="pvdescription" name="description" rows="4" class="form-control" autocomplete="off"></textarea>
                                                            </div>
                                                        </div>
                                                    </div><!--./row-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSep">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSep" aria-expanded="true" aria-controls="collapseSep">
                                                    <b>Parameter SEP</b>
                                                </button>
                                            </h2>
                                            <div id="collapseSep" class="accordion-collapse collapse" aria-labelledby="headingSep" data-bs-parent="#accordionPv" style="">
                                                <div class="accordion-body text-muted">
                                                    <div id="ajax_load"></div>
                                                    <div class="row">
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="asalrujukan">Asal Rujukan</label>
                                                                <div>
                                                                    <select name='asalrujukan' id="pvasalrujukan" class="form-control select2 act" style="width:100%">
                                                                        <option value="1">Faskes 1</option>
                                                                        <option value="2">Faskes 2 (RS)</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="norujukan">No. Rujukan</label><input id="pvnorujukan" name="norujukan" type="text" class="form-control" /></div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="kdpoli">Poli Rujukan</label>
                                                                <div>
                                                                    <select name='kdpoli' id="pvkdpoli" class="form-control select2 act" style="width:100%">
                                                                        <?php foreach ($inasisPoli as $key => $value) { ?>
                                                                            <option value="<?= $inasisPoli[$key]['kdpoli']; ?>"><?= $inasisPoli[$key]['nmpoli']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group"><label for="tanggal_rujukan">Tgl Rujukan</label><input type='date' name="tanggal_rujukan" class="form-control" id='pvtanggal_rujukan' /></div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="ppkrujukan">PPK Rujukan</label>
                                                                <div>
                                                                    <select name='ppkrujukan' id="pvppkrujukan" class="form-control select2 act" style="width:100%">
                                                                        <?php foreach ($inasisFaskes as $key => $value) { ?>
                                                                            <option value="<?= $inasisFaskes[$key]['kdprovider']; ?>"><?= $inasisFaskes[$key]['nmprovider']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="diag_awal">Diagnosis Rujukan</label>
                                                                <div class="input-group">
                                                                    <select class="form-control" name='diag_awal' id="pvdiag_awal">
                                                                    </select>
                                                                    <span class="input-group-btn">
                                                                        <button id="openSearchDiagnosaBtn" class="form-control" onclick="s()" type="button"><i class="fa fa-search"></i></button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="input-group">
                                                                <input id="pvedit_sep" name="edit_sep" type="text" class="form-control" />
                                                                <span class="input-group-btn">
                                                                    <button id="getSkdpBtn" class="form-control" onclick="getSKDP()" type="button"><i class="fa fa-search"></i></button>
                                                                </span>
                                                            </div> -->
                                                        </div>
                                                        <div class="col-sm-12 col-xs-12 mb-3">
                                                            <div class="button-items">
                                                                <div class="d-grid">
                                                                    <button id="getRujukanBtn" type="button" onclick="getRujukan()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Get Rujukan</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3" style="display: none;">
                                                            <div class="form-group"><label for="conclusion"></label><input id="pvconclusion" name="conclusion" type="text" class="form-control" /></div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="diagnosa_id">Diagnosis RS</label><input id="pvdiagnosa_id" name="diagnosa_id" type="text" class="form-control" /></div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3" style="display: none;">
                                                            <div class="form-group"><label for="kdpoli_from"></label><input id="pvkdpoli_from" name=" kdpoli_from" type="text" class="form-control" /></div>
                                                        </div>
                                                        <div class="col-sm-12 col-xs-12">
                                                            <div>
                                                                <h3>Parameter SEP</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="pvtujuankunj">Tujuan Kunjungan</label>
                                                                <div>
                                                                    <select name='tujuankunj' id="pvtujuankunj" class="form-control select2 act" style="width:100%">
                                                                        <option value="0">Normal</option>
                                                                        <option value="1">Prosedur</option>
                                                                        <option value="2">Konsul Dokter</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="pvkdpenunjang">Penunjang</label>
                                                                <div>
                                                                    <select name='kdpenunjang' id="pvkdpenunjang" class="form-control select2 act" style="width:100%">
                                                                        <option value="1">Radioterapi</option>
                                                                        <option value="2">Kemoterapi</option>
                                                                        <option value="3">Rehab Medik</option>
                                                                        <option value="4">Rehab Psikososial</option>
                                                                        <option value="5">Transfusi Darah</option>
                                                                        <option value="6">Pelayanan Gigi</option>
                                                                        <option value="7">Laboratorium</option>
                                                                        <option value="8">USG</option>
                                                                        <option value="9">Farmasi</option>
                                                                        <option value="10">Lain-lain</option>
                                                                        <option value="11">MRI</option>
                                                                        <option value="12">Hemodialisa</option>
                                                                        <option value="99">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="pvflagprocedure">Procedure</label>
                                                                <div>
                                                                    <select name='flagprocedure' id="pvflagprocedure" class="form-control select2 act" style="width:100%">
                                                                        <option value="0">Prosedur Tidak Berkelanjutan</option>
                                                                        <option value="1">Prosedur dan Terapi Berkelanjutan</option>
                                                                        <option value="99">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="pvassesmentpelgroup">Assesment Pelayanan</label>
                                                                <div>
                                                                    <select name='assesmentpel' id="pvassesmentpel" class="form-control select2 act" style="width:100%">
                                                                        <option value="1">Poli spesialis tidak tersedia pada hari sebelumnya</option>
                                                                        <option value="2">Jam poli telah berakhir pada hari sebelumnya</option>
                                                                        <option value="3">Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya</option>
                                                                        <option value="4">Atas Instruksi RS</option>
                                                                        <option value="5">Tujuan Kontrol</option>
                                                                        <option value="99">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <label for="pvedit_sep">No. SKDP</label>
                                                            <div class="input-group">
                                                                <input id="pvedit_sep" name="edit_sep" type="text" class="form-control" />
                                                                <span class="input-group-btn">
                                                                    <button id="getSkdpBtn" class="form-control" onclick="getSKDP()" type="button"><i class="fa fa-search"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <label for="pvspecimenno">No. SPRI</label>
                                                            <div class="input-group">
                                                                <input id="pvspecimenno" name="specimenno" type="text" class="form-control" />
                                                                <span class="input-group-btn">
                                                                    <button id="getSpriBtn" class="form-control" onclick="getSPRI()" type="button"><i class="fa fa-search"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="no_skp">SEP RJ</label><input id="pvno_skp" name="no_skp" type="text" class="form-control" disabled /></div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-12 mb-3">
                                                            <div class="form-group"><label for="pvno_skpinap">SEP RI</label><input id="pvno_skpinap" name="no_skpinap" type="text" class="form-control" disabled /></div>
                                                        </div>
                                                        <div class="row mt-3 mb-3">
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="createSepBtn" type="button" onclick="insertSep()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Insert SEP</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="editSepBtn" type="button" onclick="editSep()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Update SEP</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="deleteSepBtn" type="button" onclick="deleteSep()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-trash"></i> <span>Delete SEP</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingLaka">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <b>Parameter Lakalantas</b>
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingLaka" data-bs-parent="#accordionPv">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">

                                                        <div class="col-sm-12 col-xs-12 mt-4">
                                                            <div>
                                                                <h3>Parameter Lakalantas</h3>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3 mb-3">
                                                            <div class="form-group"><label for="pvvalid_rm_date">Tanggal Kejadian</label>
                                                                <input type='text' name="valid_rm_date" class="form-control" id='pvvalid_rm_date' />
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="pvpenjamin">Penjamin Lakalantas</label>
                                                                <div>
                                                                    <select name="penjamin" id="pvpenjamin" class="form-control" style="width:100%" multiple>
                                                                        <option value="0">Pribadi</option>
                                                                        <option value="1">Jasa Raharja PT</option>
                                                                        <option value="2">BPJS Ketenagakerjaan</option>
                                                                        <option value="3">TASPEN PT</option>
                                                                        <option value="4">ASABRI PT</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="lokasilaka">Lokasi Laka</label>
                                                                <div class="p-2 select2-full-width">
                                                                    <select class="form-control patient_list_ajax" name='pvlokasilaka' id="lokasilaka">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="pvispertarif">Suplesi</label>
                                                                <div>
                                                                    <select name='ispertarif' id="pvispertarif" class="form-control select2 act" style="width:100%">
                                                                        <option value="1">Ya</option>
                                                                        <option value="0">Tidak</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="pvtemptrans">No LP</label><input id="pvtemptrans" name="temptrans" type="text" class="form-control" /></div>
                                                        </div>
                                                        <div class="col-sm-6 col-xs-12">
                                                            <div class="form-group"><label for="pvdelete_sep">Keterangan</label><input id="pvdelete_sep" name="delete_sep" type="text" class="form-control" /></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <?php
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSkdp">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSkdp" aria-expanded="false" aria-controls="collapseSkdp">
                                                    <b>Rencana SKDP</b>
                                                </button>
                                            </h2>
                                            <div id="collapseSkdp" class="accordion-collapse collapse" aria-labelledby="headingSkdp" data-bs-parent="#accordionPv">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">

                                                        <div class="col-sm-12 col-xs-12 mt-4">
                                                            <div>
                                                                <h3>Rencana SKDP</h3>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3 col-lg-12 mb-3">
                                                            <div class="form-group"><label for="skdpnosep">No SEP</label>
                                                                <input type='text' name="skdpnosep" class="form-control" id='skdpnosep' />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="skdpkddpjp">Dokter</label>
                                                                <div>
                                                                    <select name="skdpkddpjp" id="skdpkddpjp" class="form-control" style="width:100%">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="skdpkdpoli">Poli Kontrol</label>
                                                                <div>
                                                                    <select name="skdpkdpoli" id="skdpkdpoli" class="form-control" style="width:100%">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 mb-3">
                                                            <div class="form-group"><label for="skdptglkontrol">Tgl Rencana Kontrol</label>
                                                                <input type='date' name="skdptglkontrol" class="form-control" id='skdptglkontrol' />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 mb-3">
                                                            <div class="form-group"><label for="skdpnosurat">No SKDP</label>
                                                                <input type='text' name="skdpnosurat" class="form-control" id='skdpnosurat' />
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3 mb-3">
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="saveSkdpBtn" type="button" onclick="saveSkdp()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Simpan</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="checkSkdpBtn" type="button" onclick="checkSkdp()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Check SKDP</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="deleteSkdpBtn" type="button" onclick="deleteSkdp()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-trash"></i> <span>Delete SKDP</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSpri">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSpri" aria-expanded="false" aria-controls="collapseSpri">
                                                    <b>Rencana SPRI</b>
                                                </button>
                                            </h2>
                                            <div id="collapseSpri" class="accordion-collapse collapse" aria-labelledby="headingSpri" data-bs-parent="#accordionPv">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-xs-12 mt-4">
                                                            <div>
                                                                <h3>Rencana SPRI</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="sprikddpjp">Dokter</label>
                                                                <div>
                                                                    <select name="sprikddpjp" id="sprikddpjp" class="form-control" style="width:100%">
                                                                        <?php $dpjplist = array();
                                                                        foreach ($dokter as $key => $value) {
                                                                            foreach ($value as $key1 => $value1) {
                                                                                foreach ($dpjp as $dpjpkey => $dpjpvalue) {
                                                                                    foreach ($dpjpvalue as $dpjpkey1 => $dpjpvalue1) {
                                                                                        if ($key1 == $dpjpkey) {
                                                                                            $dpjplist[$dpjpkey1] = $value1;
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        asort($dpjplist);
                                                                        ?>
                                                                        <?php foreach ($dpjplist as $key => $value) {
                                                                        ?>
                                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                        <?php
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-4 mb-3">
                                                            <div class="form-group"><label for="sprikdpoli">Poli Kontrol</label>
                                                                <div>
                                                                    <select name="sprikdpoli" id="sprikdpoli" class="form-control" style="width:100%">
                                                                        <?php
                                                                        $clinicList = array();
                                                                        foreach ($clinic as $key => $value) {
                                                                            if ($value['stype_id'] == '1') {
                                                                                $clinicList[$value['other_id']] = $value['name_of_clinic'];
                                                                        ?>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        asort($clinicList); ?>
                                                                        <?php foreach ($clinicList as $key => $value) {
                                                                        ?>
                                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                        <?php
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 mb-3">
                                                            <div class="form-group"><label for="spritglkontrol">Tgl Rencana Kontrol</label>
                                                                <input type='date' name="spritglkontrol" class="form-control" id='spritglkontrol' />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 mb-3">
                                                            <div class="form-group"><label for="sprinosurat">No SPRI</label>
                                                                <input type='text' name="sprinosurat" class="form-control" id='sprinosurat' />
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3 mb-3">
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="saveSpriBtn" type="button" onclick="saveSpri()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i>
                                                                                <span>Simpan</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="checkSpriBtn" type="button" onclick="checkSpri()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Check SPRI</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="deleteSpriBtn" type="button" onclick="deleteSpri()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-trash"></i> <span>Delete SPRI</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingEncounter">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEncounter" aria-expanded="false" aria-controls="collapseEncounter">
                                                    <b>Satu Sehat</b>
                                                </button>
                                            </h2>
                                            <div id="collapseEncounter" class="accordion-collapse collapse" aria-labelledby="headingEncounter" data-bs-parent="#accordionPv">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-sm-3 mb-3">
                                                            <div class="form-group"><label for="sprinosurat">No Kunjungan Satu Sehat</label>
                                                                <input type='text' name="ssencounter_id" class="form-control" id='pvssencounter_id' />
                                                            </div>
                                                        </div>
                                                        <!-- <div class="row mt-3 mb-3">
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="saveEncounterBtn" type="button" onclick="saveEncounterSS()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i>
                                                                                <span>Simpan</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="" type="button" onclick="checkSpri()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Check SPRI</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-xs-12">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="button-items">
                                                                        <div class="d-grid">
                                                                            <button id="" type="button" onclick="deleteSpri()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-trash"></i> <span>Delete SPRI</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div><!--./col-md-8-->
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="card bg-light border border-1 rounded m-4">
                                        <div class="card-body">
                                            <div class="row ptt10" id="patientDetails" style="display:none">
                                                <!-- ./col-md-9 -->
                                                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align:center">
                                                    <?php $file = "uploads/images/profile_male.png"; ?>
                                                    <img class="rounded-circle avatar-lg" src="<?php echo base_url() . 'uploads/images/profile_male.png' ?>" id="image" alt="User profile picture">
                                                    <div class="identityPv">SAIMAN 846202</div>
                                                </div><!-- ./col-md-3 -->
                                                <div class="col-md-12 col-sm-12 col-xs-12" id="pvMyinfo">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <table class="table table-striped table-biodata">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="bolds">No. Peserta</td>
                                                                        <td id="biodatapvkk_no"></td>
                                                                        <!-- <td class="bolds">Ayah</td>
                                                                        <td id="pvayah"></td> -->
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">PISA</td>
                                                                        <td id="biodatapvcoverages"></td>
                                                                        <!-- <td class="bolds">RT/RW</td>
                                                                        <td id="pvrtrw"></td>
                                                                        <td class="bolds">Ibu</td>
                                                                        <td id="pvibu"></td> -->
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">NIK</td>
                                                                        <td id="pvpasien_id"></td>
                                                                        <!-- <td class="bolds">Suami/Istri</td>
                                                                        <td id="pvsutri"></td> -->
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Alamat</td>
                                                                        <td id="biodatapvaddress"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Jenis Kelamin</td>
                                                                        <td id="biodatapvgender"></td>
                                                                    </tr>
                                                                    <!-- <tr>
                                                                        <td class="bolds">Gol Darah</td>
                                                                        <td id="pvgoldar"></td>
                                                                    </tr> -->
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Hak Kelas</td>
                                                                        <td id="biodatapvclass_id"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Tgl Lahir</td>
                                                                        <td id="biodatapvdatebirth"></td>
                                                                        <!-- <td class="bolds">Agama</td>
                                                                        <td id="pvagama"></td> -->
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Telp/HP</td>
                                                                        <td id="biodatapvphone"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Umur</td>
                                                                        <td id="biodatapvage"></td>
                                                                        <!-- <td class="bolds">Perkawinan</td>
                                                                        <td id="pvperkawinan"></td> -->
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Status</td>
                                                                        <td id="biodatapvstatus"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Kelompok</td>
                                                                        <td id="biodatapvpayor"></td>
                                                                    </tr>
                                                                    <!-- <tr>
                                                                        <td class="bolds">Catatan</td>
                                                                        <td id="pvdescription"></td>
                                                                    </tr> -->
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card bg-light border border-1 rounded m-4">
                                        <div class="card-body">
                                            <div class="row ptt10">
                                                <!-- ./col-md-9 -->
                                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="text-align:center">
                                                    <h4>Cetak</h4>
                                                </div><!-- ./col-md-3 -->
                                                <div class="col-md-12 col-sm-12 col-xs-12" id="pvMyinfo">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 mb-3">
                                                            <button type="button" class="btn btn-secondary form-control" id="cetakAntrianBtn" onclick="cetak(1)">Antrian</button>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mb-3">
                                                            <button type="button" class="btn btn-secondary form-control" id="" onclick="cetak(2)">Form RM</button>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mb-3">
                                                            <button type="button" class="btn btn-secondary form-control" id="" onclick="cetak(3)">Tagihan</button>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mb-3">
                                                            <button type="button" class="btn btn-secondary form-control" id="" onclick="cetak(4)">Gelang</button>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mb-3">
                                                            <button type="button" class="btn btn-secondary form-control" id="" onclick="cetak(5)">Label Pasien</button>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mb-3">
                                                            <button type="button" class="btn btn-secondary form-control" id="" onclick="cetak(6)">SEP</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--./row-->
                            </div><!--./col-md-4-->
                        </div><!--./row-->
                    </div><!--./col-md-12-->
                </div>
                <div class="modal-footer">
                    <button id="formaddpvbtn" class="btn btn-primary waves-effect" data-loading-text="<?php echo lang('processing') ?>"><i class="fa fa-check-circle"></i><?php echo lang('save'); ?></button>
                    <button type="button" class="btn btn-secondary" id="formeditpvbtn" onclick="editFormPV()">Edit</button>
                    <button type="button" class="btn btn-danger" id="formdelpvbtn" onclick="deleteFormPV()"><i class="fa fa-trash"></i>Delete</button>
                    <!-- <button id="formaddpvbtn_save_print" type="button" class="btn btn-primary waves-effect waves-light">Save
                        changes</button> -->
                </div>
            </div><!-- /.modal-content rounded-4 -->
        </form>
    </div><!-- /.modal-dialog -->
</div>
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
                            <th>No RM</th>
                            <th>Nama</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Asuransi</th>
                            <th>Poli<br>Dokter</th>
                            <th>No SEP / Rujukan</th>
                            <th>Kelas / Hak Kelas</th>
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
<?php if (isset($permissions['pendaftaranrajal']['c'])) {
    if ($permissions['pendaftaranrajal']['c'] == '1') { ?>

<?php }
} ?>