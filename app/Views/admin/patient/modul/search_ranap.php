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
<div id="akomodasiView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="historyRajalModal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Rawat Inap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadingAkomodasiView"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-light border border-1 rounded m-4">
                            <div class="card-body">
                                <div class="row ptt10" style="display:block">
                                    <!-- ./col-md-9 -->
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align:center">
                                        <?php $file = "uploads/images/profile_male.png"; ?>
                                        <img class="rounded-circle avatar-lg" src="<?php echo base_url() . 'uploads/images/profile_male.png' ?>" id="image" alt="User profile picture">
                                        <div class="iidentity">SAIMAN 846202</div>
                                    </div><!-- ./col-md-3 -->
                                    <div class="col-md-12 col-sm-12 col-xs-12" id="taMyinfo">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <table class="table table-striped table-biodata">
                                                    <tbody>
                                                        <tr>
                                                            <td class="bolds">No. Peserta</td>
                                                            <td id="biodatatapasien_id"></td>
                                                            <!-- <td class="bolds">Ayah</td>
                                                                        <td id="taayah"></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">PISA</td>
                                                            <td id="biodatatacoverages"></td>
                                                            <!-- <td class="bolds">RT/RW</td>
                                                                        <td id="tartrw"></td>
                                                                        <td class="bolds">Ibu</td>
                                                                        <td id="taibu"></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Alamat</td>
                                                            <td id="biodatataaddress"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Jenis Kelamin</td>
                                                            <td id="biodatatagender"></td>
                                                        </tr>
                                                        <!-- <tr>
                                                                        <td class="bolds">Gol Darah</td>
                                                                        <td id="tagoldar"></td>
                                                                    </tr> -->
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Hak Kelas</td>
                                                            <td id="biodatataclass_id_plafond"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Umur</td>
                                                            <td id="biodatataage"></td>
                                                            <!-- <td class="bolds">Perkawinan</td>
                                                                        <td id="taperkawinan"></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Status</td>
                                                            <td id="biodatatastatus"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bolds">Kelompok</td>
                                                            <td id="biodatatapayor"></td>
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
                    <div class="col-md-8">
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
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                        Pengaturan SEP Rawat Inap
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body text-muted">
                                        <div id="ajax_load"></div>
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group"><label for="asalrujukan">Asal Rujukan</label>
                                                    <div>
                                                        <select name='asalrujukan' id="taasalrujukan" class="form-control select2 act" style="width:100%" readonly>
                                                            <option value="1">Faskes 1</option>
                                                            <option value="2">Faskes 2 (RS)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group"><label for="norujukan">No. Rujukan</label><input id="tanorujukan" name="norujukan" type="text" class="form-control" readonly /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12" style="display: none;">
                                                <div class="form-group"><label for="kdpoli_from"></label><input id="takdpoli_from" name="kdpoli_from" type="text" class="form-control" readonly /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label for="taspecimenno">No. SPRI</label>
                                                <div class="input-group">
                                                    <input id="taspecimenno" name="specimenno" type="text" class="form-control" readonly />
                                                    <span class="input-group-btn">
                                                        <button class="form-control" onclick="getSPRI()" type="button"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group"><label for="no_skp">SEP RJ</label><input id="tano_skp" name="no_skp" type="text" class="form-control" readonly /></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group"><label for="tano_skpinap">SEP RI</label><input id="tano_skpinap" name="no_skpinap" type="text" class="form-control" readonly /></div>
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="createSepInap" type="button" onclick="insertSepInap()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus"></i> <span>Insert SEP</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="editSepInap" type="button" onclick="updateSepInap()" class="btn btn-secondary btn-lg waves-effect waves-light"><i class="fa fa-edit"></i> <span>Edit SEP</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="button-items">
                                                            <div class="d-grid">
                                                                <button id="deleteSepInap" type="button" onclick="deleteSepInap()" class="btn btn-danger btn-lg waves-effect waves-light"><i class="fa fa-remove"></i> <span>Delete SEP</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="col-md-12">
                                                    <div class="dividerhr"></div>
                                                    <h3>Follow Up</h3>
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <a data-toggle="modal" id="add" onclick="insertSPRI()" class="modalbtnpatient"><i class="fa fa-search"></i> <span>Rujukan</span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="dividerhr"></div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Follow Up
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body text-muted">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        Accordion Item #3
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body text-muted">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
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