<!-- ADD RANAP VIEW -->
<div id="addRanapModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addRanapModal" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg">
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
                                <?php foreach ($clinicAll as $key => $value) {
                                    if ($value['stype_id'] == '3') { ?>
                                        <option value="<?= $value['clinic_id']; ?>"><?= $value['name_of_clinic']; ?></option>
                                <?php }
                                } ?>
                            </select>
                            <div id="ariclinic_idalert" class="alert alert-danger mb-0" role="alert" style="display: none;">
                                <strong>Bangsal</strong> tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="formrow-email-input">Ruang</label>
                            <select id="ariclass_room_id" class="form-control" name="class_room_id" onchange="changeClassRoomTA(this.value)">
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
                                <?php foreach ($employee as $key => $value) { ?>
                                    <option value="<?= $value['employee_id']; ?>"><?= $value['fullname']; ?></option>
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

<!-- AKOMODASI VIEW -->
<div id="akomodasiView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="historyRajalModal" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Rawat Inap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadingAkomodasiView"></div>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo view('admin/patient/profilemodul/profilebiodata', [
                            'visit' => $visit,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa
                        ]); ?>
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
                                                        <select name='asalrujukan' id="taasalrujukan" class="form-control select2 act" style="width:100%" disabled>
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
                                                        <select name='kdpoli' id="takdpoli" class="form-control select2 act" style="width:100%" disabled>
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
                                                        <select name='tujuankunj' id="tatujuankunj" class="form-control select2 act" style="width:100%">
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
                                                        <select name='kdpenunjang' id="takdpenunjang" class="form-control select2 act" style="width:100%">
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
                                                        <select name='flagprocedure' id="taflagprocedure" class="form-control select2 act" style="width:100%">
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
                                                        <select name='assesmentpel' id="taassesmentpel" class="form-control select2 act" style="width:100%">
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
                                                    <select name='ppkRujukanInap' id="ppkRujukanInap" class="form-control select2 act" style="width:100%">
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
                                                    <select name="poliRujukan" id="poliRujukanInap" class="form-control ">
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
                                                    <select name="tipeRujukan" id="tipeRujukanInap" class="form-control ">
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
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->