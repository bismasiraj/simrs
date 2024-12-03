<div class="tab-pane tab-content-height
<?php if ($giTipe == 3) echo "active"; ?>
" id="rawat_inap">
    <?php
    $session = session();
    $gsPoli = $session->gsPoli;
    $permissions = user()->getPermissions();
    $roles = user()->getRoles();
    ?>
    <form id="form2" action="" method="post" class="">
        <div class="box-body row mt-4 mb-4">
            <input type="hidden" name="ci_csrf_token" value="">
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
            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Bangsal</label><small class="req"> *</small>
                    <select id="iklinik" class="form-select" name="klinik" onchange="showdate(this.value)" autocomplete="off">
                        <option value="%">Semua</option>
                        <?php $cliniclist = array();
                        foreach ($clinic as $key => $value) {
                            if ($clinic[$key]['stype_id'] == '3') {
                                $cliniclist[$clinic[$key]['name_of_clinic']] = $clinic[$key]['name_of_clinic'];
                            }
                        }
                        asort($cliniclist);
                        ?>
                        <?php foreach ($cliniclist as $key => $value) { ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                        <?php if ($giTipe == '6') {
                        ?>
                            <option value="P002">Kamar Operasi</option>
                        <?php
                        } ?>
                    </select>
                </div>
                <span class="text-danger" id="error_search_type"></span>
            </div>

            <!-- <div class="col-sm-6 col-md-2">
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
            </div> -->

            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Dokter</label>
                    <select id="dokter" class="form-select" name="dokter" onchange="showdate(this.value)">
                        <option value="%">Semua</option>
                        <?php if (!isset($roles['11'])) { ?>
                        <?php } ?>
                        <?php if (!is_null(user()->employee_id) && isset($roles['11'])) { ?>
                            <option value="<?= user()->employee_id; ?>"><?= user()->getFullname(); ?></option>
                        <?php
                        } else {
                        ?>
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
                        } ?>
                    </select>
                    <span class="text-danger" id="error_doctor"></span>
                </div>
            </div>


            <div class="col-sm-6 col-md-2" style="display: none">
                <div class="form-group">
                    <label>Rujukan Dari</label>

                    <select name="rujukan" id="irujukan" class="form-select">
                        <option value="%">Semua</option>
                        <?php foreach ($cliniclist as $key => $value) { ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-2" style="display: none">
                <div class="form-group">
                    <label>Relasi</label>
                    <select name="statuspasien" id="istatuspasien" class="form-select">
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
            <div class="col-sm-2" style="display: none">
                <div class="form-group">
                    <label>No Kartu/ SEP</label>
                    <input type="text" name="nokartu" id="inokartu" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-2" style="display: none">
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" id="iaddress" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-6 col-md-2" style="display: none">
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

            <div class="col-sm-6 col-md-2" style="display: none">
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
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <label>Status Rawat Inap</label>
                    <div class="row">

                        <div class="col-md-6">
                            <select name="keluar_id" id="icarakeluar" class="form-select">
                                <?php foreach ($caraKeluar as $key => $value) {
                                ?>
                                    <option value="<?= $caraKeluar[$key]['keluar_id']; ?>"><?= $caraKeluar[$key]['cara_keluar']; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <button id="form2btn" type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right w-100"><i class="fa fa-search"></i> Cari</button>
                        </div>
                        <div class="col-md-3">
                            <button id="btnHandOver" type="button" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right w-100"><i class="fas fa-hand-holding-heart"></i> HO</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-6 col-md-1">
                <div class="mt-4 text-end">
                    <button id="form2btn" type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right w-100 h-100"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
            <div class="col-sm-6 col-md-1">
                <div class="mt-4 text-end">
                    <button id="form2btn" type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right w-100 h-100"><i class="fa fa-search"></i> Handover</button>
                </div>
            </div> -->
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
                        <th>Ranap Bersama</th>
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
                            <select class="form-select" id="ariclinic_id" name="clinic_id" onchange="changeClinicInap(this.value)">
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
                            <select id="ariclass_room_id" class="form-select" name="class_room_id" onchange="changeClassRoomTA(this.value)">
                            </select>
                            <div id="ariclass_room_idalert" class="alert alert-danger mb-0" role="alert" style="display: none;">
                                <strong>Ruang</strong> tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Nomor TT</label>
                            <select id="aribed_id" class="form-select" name="bed_id">
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
                            <select id="ariemployee_id" class="form-select" name="employee_id">
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
                            <select class="form-select" id="ariclinic_type" name="clinic_type">
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
                                <input id="aritreat_date" name="treat_date" class="form-control" type="datetime-local" onchange="changeAriTreatDate()">
                                <!-- 
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->

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
<div id="akomodasiView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Rawat Inap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadingAkomodasiView"></div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-light border border-1 rounded m-4">
                            <div class="card-body">
                                <div class="row ptt10" style="display:block">
                                    <!-- ./col-md-9 -->
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align:center">
                                        <?php $file = "uploads/images/profile_male.png"; ?>
                                        <img class="rounded-circle avatar-lg" src="<?php echo base_url() . 'uploads/images/profile_male.png' ?>" id="image" alt="User profile picture">
                                        <div id="taidentity">SAIMAN 846202</div>
                                    </div><!-- ./col-md-3 -->
                                    <div class="col-md-12 col-sm-12 col-xs-12" id="taMyinfo">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <table class="table table-striped table-biodata">
                                                    <tbody>
                                                        <tr>
                                                            <td class="bolds">No. Peserta</td>
                                                            <td id="tabiodatatapasien_id"></td>
                                                            <!-- <td class="bolds">Ayah</td>
                                                                        <td id="taayah"></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">PISA</td>
                                                            <td id="tabiodatatacoverages"></td>
                                                            <!-- <td class="bolds">RT/RW</td>
                                                                        <td id="tartrw"></td>
                                                                        <td class="bolds">Ibu</td>
                                                                        <td id="taibu"></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Alamat</td>
                                                            <td id="tabiodatataaddress"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Jenis Kelamin</td>
                                                            <td id="tabiodatatagender"></td>
                                                        </tr>
                                                        <!-- <tr>
                                                                        <td class="bolds">Gol Darah</td>
                                                                        <td id="tagoldar"></td>
                                                                    </tr> -->
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Hak Kelas</td>
                                                            <td id="tabiodatataclass_id_plafond"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Umur</td>
                                                            <td id="tabiodatataage"></td>
                                                            <!-- <td class="bolds">Perkawinan</td>
                                                                        <td id="taperkawinan"></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Status</td>
                                                            <td id="tabiodatatastatus"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Kelompok</td>
                                                            <td id="tabiodatatapayor"></td>
                                                        </tr>
                                                        <!-- <tr>
                                                                        <td class="bolds">Catatan</td>
                                                                        <td id="tadescription"></td>
                                                                    </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <form id="formAkomodasiView" action="" method="post" class="">
                            <table id="akomoDasiViewTable" class="table table-bordered table-striped table-centered table-hover mb-4" data-export-title="<?= lang('Word.patient_list'); ?>">
                                <thead class="table-primary">
                                    <tr style="text-align: center">
                                        <th>No</th>
                                        <th>Bangsal/Dokter/No TT</th>
                                        <th>Tgl Masuk</th>
                                        <th>Tgl Keluar</th>
                                        <th>Jml Hari</th>
                                        <!-- <th>Jml Hari s/d hari ini</th> -->
                                        <th>Cara Keluar</th>
                                        <th>Tarif</th>
                                        <th>Biaya/Hari</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="akomodasiViewTableBody" class="table-group-divider">
                                </tbody>
                            </table>
                            <div class="col-sm-12 col-xs-12 mb-4">
                                <div class="button-items">
                                    <div class="text-center">
                                        <button id="formAkomodasiViewBtn" type="submit" class="btn btn-primary waves-effect waves-light" style="display: none;"><i class="fa fa-save"></i><span> Simpan</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="accordion" id="accordionRanap">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSepRanap">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSepRanap" aria-expanded="true" aria-controls="collapseSepRanap">
                                        <b>Parameter SEP</b>
                                    </button>
                                </h2>
                                <div id="collapseSepRanap" class="accordion-collapse collapse" aria-labelledby="headingSepRanap" data-bs-parent="#accordionRanap" style="">
                                    <div class="accordion-body text-muted">
                                        <div id="ajax_load"></div>
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="asalrujukan">Asal Rujukan</label>
                                                    <div>
                                                        <select name='asalrujukan' id="taasalrujukan" class="form-select select2 act" style="width:100%" disabled>
                                                            <option value="1">Faskes 1</option>
                                                            <option value="2">Faskes 2 (RS)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="norujukan">No. Rujukan</label><input id="tanorujukan" name="norujukan" type="text" class="form-control" disabled /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="kdpoli">Poli Rujukan</label>
                                                    <div>
                                                        <select name='kdpoli' id="takdpoli" class="form-select select2 act" style="width:100%" disabled>
                                                            <?php foreach ($inasisPoli as $key => $value) { ?>
                                                                <option value="<?= $inasisPoli[$key]['kdpoli']; ?>"><?= $inasisPoli[$key]['nmpoli']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group"><label for="tanggal_rujukan">Tgl Rujukan</label><input type='date' name="tanggal_rujukan" class="form-control" id='tatanggal_rujukan' /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="ppkrujukan">PPK Rujukan</label>
                                                    <div>
                                                        <select name='ppkrujukan' id="tappkrujukan" class="form-control select2 act" style="width:100%" disabled>
                                                            <?php foreach ($inasisFaskes as $key => $value) { ?>
                                                                <option value="<?= $inasisFaskes[$key]['kdprovider']; ?>"><?= $inasisFaskes[$key]['nmprovider']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="diag_awal">Diagnosis Rujukan</label>
                                                    <select class="form-select" name='diag_awal' id="tadiag_awal" disabled>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 mb-3">
                                                <div class="button-items">
                                                    <div class="d-grid">
                                                        <button id="getRujukanRanapBtn" type="button" onclick="getRujukanRanap()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Get Rujukan</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3" style="display: none;">
                                                <div class="form-group"><label for="conclusion"></label><input id="taconclusion" name="conclusion" type="text" class="form-control" /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="diagnosa_id">Diagnosis RS</label><input id="tadiagnosa_id" name="diagnosa_id" type="text" class="form-control" disabled /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3" style="display: none;">
                                                <div class="form-group"><label for="kdpoli_from"></label><input id="takdpoli_from" name=" kdpoli_from" type="text" class="form-control" /></div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12">
                                                <div>
                                                    <h3>Parameter SEP</h3>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="tatujuankunj">Tujuan Kunjungan</label>
                                                    <div>
                                                        <select name='tujuankunj' id="tatujuankunj" class="form-select select2 act" style="width:100%">
                                                            <option value="0">Normal</option>
                                                            <option value="1">Prosedur</option>
                                                            <option value="2">Konsul Dokter</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="takdpenunjang">Penunjang</label>
                                                    <div>
                                                        <select name='kdpenunjang' id="takdpenunjang" class="form-select select2 act" style="width:100%">
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
                                                <div class="form-group"><label for="taflagprocedure">Procedure</label>
                                                    <div>
                                                        <select name='flagprocedure' id="taflagprocedure" class="form-select select2 act" style="width:100%">
                                                            <option value="0">Prosedur Tidak Berkelanjutan</option>
                                                            <option value="1">Prosedur dan Terapi Berkelanjutan</option>
                                                            <option value="99">-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="taassesmentpelgroup">Assesment Pelayanan</label>
                                                    <div>
                                                        <select name='assesmentpel' id="taassesmentpel" class="form-select select2 act" style="width:100%">
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
                                            <!-- <div class="col-sm-3 col-xs-12 mb-3">
                                                <label for="taedit_sep">No. SKDP</label>
                                                <div class="input-group">
                                                    <input id="taedit_sep" name="edit_sep" type="text" class="form-control" />
                                                    <span class="input-group-btn">
                                                        <button id="getSkdpRanapBtn" class="form-control" onclick="getSKDP()" type="button"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div> -->
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <label for="taspecimenno">No. SPRI</label>
                                                <div class="input-group">
                                                    <input id="taspecimenno" name="specimenno" type="text" class="form-control" />
                                                    <span class="input-group-btn">
                                                        <button id="getSpriRanapBtn" class="form-control" onclick="getSPRI()" type="button"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 mb-3">
                                                <div class="form-group"><label for="tano_skpinap">SEP RI</label><input id="tano_skpinap" name="no_skpinap" type="text" class="form-control" disabled /></div>
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="createSepInapBtn" type="button" onclick="insertSepInap()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Insert SEP</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="editSepInapBtn" type="button" onclick="editSep()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Update SEP</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="deleteSepInapBtn" type="button" onclick="deleteSepInap()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-trash"></i> <span>Delete SEP</span></button>
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
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        <b>Follow Up</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionRanap">
                                    <div class="accordion-body text-muted">
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label for="tglRencanaRujukanInap">Tanggal Rencana Rujukan</label>
                                                    <input class="form-control" type="date" value="" id="tglRencanaRujukanInap">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label for="ppkRujukanInap">PPK Rujukan</label>
                                                    <select name='ppkRujukanInap' id="ppkRujukanInap" class="form-select select2 act" style="width:100%">
                                                        <?php foreach ($inasisFaskes as $key => $value) { ?>
                                                            <option value="<?= $inasisFaskes[$key]['kdprovider']; ?>"><?= $inasisFaskes[$key]['nmprovider']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label for="diagRujukan">Diagnosa Rujukan</label>
                                                <div class="input-group">
                                                    <input id="diagRujukanInap" name="diagRujukan" type="text" class="form-control" />
                                                    <input id="nameDiagRujukanInap" name="nameDiagRujukan" type="hidden" class="form-control" />
                                                    <span class="input-group-btn">
                                                        <button class="form-control" onclick="getDiagRujukan()" type="button"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label for="poliRujukanInap">Poli Rujukan</label>
                                                    <select name="poliRujukan" id="poliRujukanInap" class="form-select ">
                                                        <?php $cliniclist = array();
                                                        foreach ($clinic as $key => $value) {
                                                            if ($clinic[$key]['stype_id'] == '1') {
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
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label for="tipeRujukan">Tipe Rujukan</label>
                                                    <select name="tipeRujukan" id="tipeRujukanInap" class="form-select ">
                                                        <option value="0">Penuh</option>
                                                        <option value="1">Partial</option>
                                                        <option value="2">Balik PRB</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group"><label for="noRujukan">Catatan</label>
                                                    <textarea id="catatanRujukanInap" name="catatanRujukan" type="text" class="form-control">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group"><label for="noRujukan">No. Rujukan</label>
                                                    <input id="noRujukanInap" name="noRujukan" type="text" class="form-control" readonly />
                                                </div>
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="createSepInap" type="button" onclick="insertRujukanInap()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Simpan Rujukan</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="editSepInap" type="button" onclick="updateRujukanInap()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Edit Rujukan</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="deleteSepInap" type="button" onclick="deleteRujukanInap()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-remove"></i> <span>Delete Rujukan</span></button>
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
                                <h2 class="accordion-header" id="headingSpriRanap">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSpriRanap" aria-expanded="false" aria-controls="collapseSpriRanap">
                                        <b>Rencana SPRI</b>
                                    </button>
                                </h2>
                                <div id="collapseSpriRanap" class="accordion-collapse collapse" aria-labelledby="headingSpriRanap" data-bs-parent="#accordionRanap">
                                    <div class="accordion-body text-muted">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 mt-4">
                                                <div>
                                                    <h3>Rencana SPRI</h3>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-xs-4 mb-3">
                                                <div class="form-group"><label for="tasprikddpjp">Dokter</label>
                                                    <div>
                                                        <select name="tasprikddpjp" id="tasprikddpjp" class="form-select" style="width:100%">
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
                                                <div class="form-group"><label for="tasprikdpoli">Poli Kontrol</label>
                                                    <div>
                                                        <select name="tasprikdpoli" id="tasprikdpoli" class="form-select" style="width:100%">
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
                                                <div class="form-group"><label for="taspritglkontrol">Tgl Rencana Kontrol</label>
                                                    <input type='date' name="taspritglkontrol" class="form-control" id='taspritglkontrol' />
                                                </div>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-group"><label for="tasprinosurat">No SPRI</label>
                                                    <input type='text' name="tasprinosurat" class="form-control" id='tasprinosurat' />
                                                </div>
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="saveSpriRanapBtn" type="button" onclick="saveSpriRanap()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i>
                                                                    <span>Simpan</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="checkSpriRanapBtn" type="button" onclick="checkSpriRanap()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Check SPRI</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="deleteSpriRanapBtn" type="button" onclick="deleteSpriRanap()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-trash"></i> <span>Delete SPRI</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="handoverModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Rawat Inap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="handOverDocument" class="card border-1 rounded-4 m-4" style="display: none;">
                    <div class="card-body">
                        <form id="formSearchHandover" action="" method="post" class="">
                            <input type="hidden" name="ci_csrf_token" value="<?= csrf_token(); ?>">
                            <input type="hidden" id="handorg_unit_code">
                            <input type="hidden" id="handbody_id">
                            <input type="hidden" id="handhandover_by">
                            <input type="hidden" id="handhandover_date">
                            <input type="hidden" id="handhandover_sign">
                            <input type="hidden" id="handreceived_by">
                            <input type="hidden" id="handreceived_date">
                            <input type="hidden" id="handreceived_sign">
                            <div class="box-body row mt-4 mb-4">
                                <div class="col-sm-6 col-md-2">
                                    <div class="form-group">
                                        <label>Bangsal</label><small class="req"> *</small>
                                        <select id="handclinic_id" class="form-select" name="clinic_id" onchange="setClassRoom(this.value)" autocomplete="off">
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
                                            <?php if ($giTipe == '6') {
                                            ?>
                                                <option value="P002">Kamar Operasi</option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <span class="text-danger" id="error_search_type"></span>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>Ruang</label><small class="req"> *</small>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select id="handclass_room_id" class="form-select" name="class_room_id" autocomplete="off">
                                                    <option value="%">Semua</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right w-100 h-100"><i class="fa fa-search"></i> Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger" id="error_search_type"></span>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div id="groupToHandover" class="col-md-5">
                                <table id="tableToHandover" class="table table-bordered table-striped table-centered table-hover" data-export-title="<?= lang('Word.patient_list'); ?>">
                                    <thead class="table-primary">
                                        <tr style="text-align: center">
                                            <th class="justify-content-center align-items-center">
                                                <input id="toHandoverCheckAll" class="form-check-input" type="checkbox">
                                                <!-- <div class="form-check mb-3">
                                                    <label class="form-check-label" for="armGEN0009G0090501">Semua</label>
                                                </div> -->
                                            </th>
                                            <th>No. MR</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Pelayanan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listToHandover" class="table-group-divider">
                                    </tbody>
                                </table>
                            </div>
                            <style>
                                .button-container {
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    height: 100%;
                                }
                            </style>
                            <div id="btnTransferGRoup" class="col-md-2 button-container">
                                <div class="btn-group-vertical">
                                    <button class="btn btn-primary" onclick="transferToAfterHandoverAll()"> Pilih >> </button>
                                    <button class="btn btn-danger" onclick="transferAfterToHandoverAll()">
                                        << Batal </button>
                                </div>
                            </div>
                            <div id="groupAfterHandover" class="col-md-5">
                                <table id="tableAfterHandover" class="table table-bordered table-striped table-centered table-hover" data-export-title="<?= lang('Word.patient_list'); ?>">
                                    <thead class="table-primary">
                                        <tr style="text-align: center">
                                            <th class="justify-content-center align-items-center">
                                                <input id="afterHandoverCheckAll" class="form-check-input" type="checkbox">
                                                <!-- <div class="form-check mb-3">
                                                    <label class="form-check-label" for="armGEN0009G0090501">Semua</label>
                                                </div> -->
                                            </th>
                                            <th>No. MR</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Pelayanan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listAfterHandover" class="table-group-divider">
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- row -->
                        <div class="row">
                            <div id="qrcodeContainer" class="text-center mt-4"></div>
                        </div>
                        <div class="panel-footer text-end mb-4">
                            <button type="button" id="handSaveBtnId" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right handSaveBtnId"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="handEditBtnId" name="editrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right handEditBtnId"><i class="fa fa-edit"></i> <span>Edit</span></button>
                            <button type="button" id="handSignHandoverBtnId" name="signrm" onclick="signHandover()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right handSignBtnId"><i class="fa fa-signature"></i> <span>Sign Handover</span></button>
                            <button type="button" id="handSignReceiveBtnId" name="signrm" onclick="signReceive()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right handSignBtnId" style="display: none;"><i class="fa fa-signature"></i> <span>Sign Receive</span></button>
                            <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                        </div>
                    </div>
                </div>
                <div id="handOverList">
                    <div class="col-md-12">
                        <div class="box-tab-tools text-center m-4">
                            <a data-toggle="modal" onclick="setHandOver()" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                        </div>
                        <table id="tableHandover" class="table table-bordered table-striped table-centered table-hover" data-export-title="<?= lang('Word.patient_list'); ?>">
                            <thead class="table-primary">
                                <tr style="text-align: center">
                                    <th>Tanggal</th>
                                    <th>Nama Bangsal</th>
                                    <th>Nama Ruang / Kode JK</th>
                                    <th>Pemberi</th>
                                    <th>Penerima</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="listHandover" class="table-group-divider">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="historyCpptList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="historyCpptList" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Pilih sesi kunjungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="addSessionRanap" class="box-tab-tools text-center mb-4"></div>
                <div class="d-flex mb-3">
                    <button type="button" class="btn btn-sm btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#raberModal" id="btnRaberModal"><i class="fas fa-people-carry"></i> Rawat Bersama</button>
                </div>
                <div id="loadingHistoryrajal"></div>
                <table id="historyCpptTable" class="table table-bordered table-striped table-centered table-hover" data-export-title="<?= lang('Word.patient_list'); ?>">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                            <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                            <th class="text-center" colspan="6" style="width: 70%;">SOAP</th class="text-center">
                            <th class="text-center" style="width: 5%;"></th class="text-center">
                            <th class="text-center" style="width: 5%;"></th class="text-center">
                        </tr>
                    </thead>
                    <tbody id="historyCpptBody" class="table-group-divider">
                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="raberModal" tabindex="-1" aria-labelledby="childModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="childModalLabel">Dokter Konsultasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 75vh; overflow-y: auto;">
                <form action="" class="row" method="post" id="formRaberRanap">
                    <input type="hidden" name="visit_id" id="raber_visit_id">
                    <input type="hidden" name="employee_id" id="raber_employee_id">
                    <input type="hidden" name="doctor" id="raber_doctor">
                    <input type="hidden" name="specialist_type_id" id="raber_specialist_type_id">
                    <div class="col-6" id="left_col-raber">
                        <div class="form-group mb-3">
                            <label for="select_doctor_to" class="form-label fw-bold mb-1">DPJP To</label>
                            <select id="select_doctor_to" class="form-select" name="employee_id_to" onchange="showdate(this.value)">
                                <?php if (!isset($roles['11'])) { ?>
                                <?php } ?>
                                <?php if (!is_null(user()->employee_id) && isset($roles['11'])) { ?>
                                    <option value="<?= user()->employee_id; ?>"><?= user()->getFullname(); ?></option>
                                <?php
                                } else {
                                ?>
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
                                } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="select_department_ranap" class="form-label fw-bold mb-1">Department To</label>
                            <select id="select_department_ranap" class="form-select" name="specialist_type_id_to" autocomplete="off">

                            </select>

                        </div>
                        <div class="form-group mb-3">
                            <label for="select_consul_type" class="form-label fw-bold mb-1">Consultation Type</label>
                            <select name="consul_type" id="select_consul_type" class="form-select">
                                <option value="1">Konsulan</option>
                                <option value="2">Rawat Bersama</option>
                                <option value="3">Rawat Alih</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="consultation_date_raber" class="form-label fw-bold mb-1">Consultation Date</label>
                            <input type="date" name="document_date" id="consultation_date_raber" class="form-control bg-white dateflatpickr-ranap">
                        </div>
                        <div class="form-group mb-3">
                            <label for="consultation_desc_raber" class="form-label fw-bold mb-1">Consultation Desc</label>
                            <textarea name="description" id="consultation_desc_raber" class="form-control quill-editor-raber" rows="5"></textarea>
                        </div>
                        <button type="button" id="formsignarmraber" name="signrm" onclick="signarm()" data-loading-text="processing" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                    </div>
                    <div class="col-6" id="right_col_raber">
                        <div class="form-group mb-3">
                            <label for="response_date_raber" class="form-label fw-bold mb-1">Response Date </label>
                            <input type="date" name="respon_date" id="response_date_raber" class="form-control bg-white dateflatpickr-ranap">
                        </div>
                        <div class="form-group mb-3">
                            <label for="response_desc_raber" class="form-label fw-bold mb-1">Response Desc</label>
                            <textarea name="description_to" id="response_desc_raber" class="form-control quill-editor-raber" rows="5"></textarea>
                        </div>
                        <button type="button" id="formsignarmraber2" name="signrm" onclick="signarm()" data-loading-text="processing" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btn-cancel-raber" hidden>Batalkan</button>
                <button type="button" class="btn btn-primary" id="btn-save-raber"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade show" id="digitalSignModal" aria-labelledby="myModalLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content sign-modal-content rounded-4 shadow-lg">
            <div class="modal-header sign-modal-header">
                <h5 class="modal-title" id="myModalLabel">Digital Signature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--./modal-header-->
            <div class="modal-body sign-modal-body pt-4 pb-4">
                <form id="digitalSignForm" action="" method="post">
                    <input type="hidden" name="csrf_test_name" value="8caeffc8cc53af393bf38c6fcee31d82"> <input type="hidden" name="valid_date" id="signvalid_date" value="armvalid_date">
                    <input type="hidden" name="valid_user" id="signvalid_user" value="armvalid_user">
                    <input type="hidden" name="valid_pasien" id="signvalid_pasien" value="armvalid_pasien">
                    <input type="hidden" name="tombolsave" id="signtombolsave" value="formsavearmbtn">
                    <input type="hidden" name="formId" id="signform" value="formaddarm">
                    <input type="hidden" name="container" id="signcontainer" value="arm">
                    <input type="hidden" name="docs_type" id="signdocs_type" value="2"> <!-- tipe dokumen per modul, nanti mulai nya dari 7 -->
                    <input type="hidden" name="sign_id" id="signsign_id" value="202411291452130129a46"> <!-- body id dari dokumen -->
                    <!-- <input type="hidden" name="user_type" id="signuser_type"> -->
                    <input type="hidden" name="sign_ke" id="signsign_ke" value="1"> <!-- statis 1 -->
                    <input type="hidden" name="title" id="signtitle" value="ASESMEN MEDIS ANAK RAWAT INAP"> <!-- Judul dokumen -->
                    <input type="hidden" name="sign_path" id="signsign_path" value="faris: 2024-11-29 15:57">

                    <div id="signmedis">
                        <div id="displayuser_id" class="form-group" style="">
                            <label for="user_id">Username</label>
                            <input id="user_id" type="text" class="form-control" name="user_id" placeholder="Username">
                        </div>
                        <div id="displaypassword" class="form-group" style="">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div id="displaysignnik" class="form-group" style="display: none;">
                            <label for="signnik">NIK</label>
                            <input id="signnik" type="text" class="form-control" name="nik" placeholder="NIK">
                        </div>
                        <div id="displaysignname" class="form-group" style="display: none;">
                            <label for="signname">Nama</label>
                            <input id="signname" type="text" class="form-control" name="name" placeholder="Nama Wali">
                        </div>
                        <div id="displaysignno_registration" class="form-group" style="display: none;">
                            <label for="signno_registration">Nomor RM</label>
                            <input id="signno_registration" type="text" class="form-control" name="no_registration" placeholder="Nomor RM">
                        </div>
                        <div id="displaysigndatepasien" class="form-group" style="display: none;">
                            <label for="signdatepasien">Tanggal Lahir (YYYYMMDD)</label>
                            <input id="signdatepasien" type="text" name="datebirth" class="form-control" placeholder="YYYYMMDD">
                        </div>
                        <div id="displayttd" class="col-xl-12 col-lg-12 col-md-12 text-center mt-4" style="display: none;">
                            <canvas id="canvas" style="border: 1px solid #000;" width="300" height="300"></canvas>
                            <input type="hidden" name="tandatangansign" id="tandatangansign">
                            <div class="col-md-12 col-xm-12 m-1 text-center">
                                <button id="openttdmodal" class="btn btn-secondary" type="button"> Ubah TTD</button>
                            </div>
                        </div>


                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>