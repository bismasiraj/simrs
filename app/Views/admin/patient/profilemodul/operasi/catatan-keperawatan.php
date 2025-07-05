<?php
$db = db_connect();

$exam_info = $db->query("SELECT TOP 1 weight, height, vs_status_id, temperature, nadi, tension_upper, tension_below, saturasi, nafas 
    FROM EXAMINATION_DETAIL 
    WHERE VISIT_ID = ? 
    ORDER BY EXAMINATION_DATE DESC", [@$visit['visit_id']])->getRowArray();

$exam_info = [
    'weight' => $exam_info['weight'] ?? 0,
    'height' => $exam_info['height'] ?? 0,
    'vs_status_id' => $exam_info['vs_status_id'] ?? null,
    'temperature' => $exam_info['temperature'] ?? null,
    'nadi' => $exam_info['nadi'] ?? null,
    'tension_upper' => $exam_info['tension_upper'] ?? null,
    'tension_below' => $exam_info['tension_below'] ?? null,
    'saturasi' => $exam_info['saturasi'] ?? null,
    'nafas' => $exam_info['nafas'] ?? null,
];
?>

<div class="tab-pane fade" id="catatan-keperawatan">
    <form action="" id="form-catatan-keperawatan">
        <div id="accordionCatatan" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        CATATAN KEPERAWATAN PRA OPERASI
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                    data-bs-parent="#accordionCatatan">
                    <div class="card-body">
                        <!-- ------------------ -->
                        <div id="vitalSignKeperawatan" class="card border-1 rounded-4 m-4 p-4" style="display: none;">
                            <div class="card-body">
                                <form id="formvitalsign-catatanKeperawatan" accept-charset="utf-8" action=""
                                    enctype="multipart/form-data" method="post" class="ptt10">
                                    <div class="modal-body pt0 pb0">
                                        <input id="clinic_id-catatanKeperawatan" name="clinic_id" placeholder=""
                                            type="hidden" class="form-control block"
                                            value="<?= @$visit['clinic_id']; ?>" />
                                        <input id="class_room_id-catatanKeperawatan" name="class_room_id" placeholder=""
                                            type="hidden" class="form-control block"
                                            value="<?= @$visit['class_room_id']; ?>" />
                                        <input id="bed_id-catatanKeperawatan" name="bed_id" placeholder="" type="hidden"
                                            class="form-control block" value="<?= @$visit['bed_id']; ?>" />
                                        <input id="keluar_id-catatanKeperawatan" name="keluar_id" placeholder=""
                                            type="hidden" class="form-control block"
                                            value="<?= @$visit['keluar_id']; ?>" />
                                        <input id="employee_id-catatanKeperawatan" name="employee_id" placeholder=""
                                            type="hidden" class="form-control block"
                                            value="<?= @$visit['employee_id']; ?>" />
                                        <input id="no_registration-catatanKeperawatan" name="no_registration"
                                            placeholder="" type="hidden" class="form-control block"
                                            value="<?= @$visit['no_registration']; ?>" />
                                        <input id="visit_id-catatanKeperawatan" name="visit_id" placeholder=""
                                            type="hidden" class="form-control block"
                                            value="<?= @$visit['visit_id']; ?>" />
                                        <input id="org_unit_code-catatanKeperawatan" name="org_unit_code" placeholder=""
                                            type="hidden" class="form-control block"
                                            value="<?= @$visit['org_unit_code']; ?>" />
                                        <input id="doctor-catatanKeperawatan" name="doctor" placeholder="" type="hidden"
                                            class="form-control block"
                                            value="<?= @@$visit['doctor'] ?? @@@$visit['fullname']; ?>" />
                                        <input id="kal_id-catatanKeperawatan" name="kal_id" placeholder="" type="hidden"
                                            class="form-control block" value="<?= @@$visit['kal_id']; ?>" />
                                        <input id="theid-catatanKeperawatan" name="theid" placeholder="" type="hidden"
                                            class="form-control block" value="<?= @@$visit['theid']; ?>" />
                                        <input id="thename-catatanKeperawatan" name="thename" placeholder=""
                                            type="hidden" class="form-control block" value="<?= @@$visit['theid']; ?>" />
                                        <input id="theaddress-catatanKeperawatan" name="theaddress" placeholder=""
                                            type="hidden" class="form-control block" value="<?= @@$visit['theid']; ?>" />
                                        <input id="status_pasien_id-catatanKeperawatan" name="status_pasien_id"
                                            placeholder="" type="hidden" class="form-control block"
                                            value="<?= @@$visit['status_pasien_id']; ?>" />
                                        <input id="isrj-catatanKeperawatan" name="isrj" placeholder="" type="hidden"
                                            class="form-control block" value="<?= @@$visit['isrj']; ?>" />
                                        <input id="gender-catatanKeperawatan" name="gender" placeholder="" type="hidden"
                                            class="form-control block" value="<?= @@$visit['gender']; ?>" />
                                        <input id="ageyear-catatanKeperawatan" name="ageyear" placeholder=""
                                            type="hidden" class="form-control block"
                                            value="<?= @@$visit['ageyear']; ?>" />
                                        <input id="agemonth-catatanKeperawatan" name="agemonth" placeholder=""
                                            type="hidden" class="form-control block"
                                            value="<?= @@$visit['agemonth']; ?>" />
                                        <input id="ageday-catatanKeperawatan" name="ageday" placeholder="" type="hidden"
                                            class="form-control block" value="<?= @@$visit['ageday']; ?>" />
                                        <input id="body_id-catatanKeperawatan" name="body_id_vt" placeholder=""
                                            type="hidden" class="form-control block" value="" />
                                        <input id="modified_by-catatanKeperawatan" name="modified_by" placeholder=""
                                            type="hidden" class="form-control block" value="<?= user()->username ?>" />
                                        <input id="trans_id-catatanKeperawatan" name="trans_id" placeholder=""
                                            type="hidden" class="form-control block"
                                            value="<?= @@$visit['trans_id']; ?>" />
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="anamnase-catatanKeperawatan"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">(S)
                                                            Anamnesis</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control"
                                                                id="anamnase-catatanKeperawatan" name="anamnase"
                                                                placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <h3><b>Vital Sign</b></h3>
                                                        <hr>
                                                        <label
                                                            class="col-xs-6 col-sm-6 col-md-2 col-form-label">Pemeriksaan
                                                            Fisik</label>
                                                        <div class="col-xs-6 col-sm-6 col-md-10">
                                                            <div class="row mb-2">
                                                                <!--==new -->
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Jenis EWS</label>
                                                                        <select class="form-select" name="vs_status_id"
                                                                            id="vs_status_id-catatanKeperawatan">
                                                                            <option value="" selected>-- pilih --
                                                                            </option>
                                                                            <option value="1">Dewasa</option>
                                                                            <option value="4">Anak</option>
                                                                            <option value="5">Neonatus</option>
                                                                            <option value="10">Obsetric</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!--==endofnew -->
                                                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>BB(Kg)</label>
                                                                        <div class=" position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="weight"
                                                                                id="weight-catatanKeperawatan"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-bb-catatanKeperawatan"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Tinggi(cm)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="height"
                                                                                id="height-catatanKeperawatan"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-height-catatanKeperawatan"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Suhu(°C)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="temperature"
                                                                                id="temperature-catatanKeperawatan"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-temperature-catatanKeperawatan"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                                    <div class="form-group">
                                                                        <label>Nadi(/menit)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="nadi"
                                                                                id="nadi-catatanKeperawatan"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-nadi-catatanKeperawatan"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                        <div class="col-sm-12 "
                                                                            style="display: flex;  align-items: center;">
                                                                            <div class="position-relative">
                                                                                <input onchange="vitalsignInput(this)"
                                                                                    type="text" name="tension_upper"
                                                                                    id="tension_upper-catatanKeperawatan"
                                                                                    placeholder="" value=""
                                                                                    class="form-control vitalsignclass"
                                                                                    autocomplete="off">
                                                                                <span class="h6"
                                                                                    id="badge-tension_upper-catatanKeperawatan"></span>
                                                                            </div>
                                                                            <h4 class="mx-2">/</h4>
                                                                            <div class="position-relative">
                                                                                <input onchange="vitalsignInput(this)"
                                                                                    type="text" name="tension_below"
                                                                                    id="tension_below-catatanKeperawatan"
                                                                                    placeholder="" value=""
                                                                                    class="form-control vitalsignclass"
                                                                                    autocomplete="off">
                                                                                <span class="h6"
                                                                                    id="badge-tension_below-catatanKeperawatan"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Saturasi(SpO2%)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="saturasi"
                                                                                id="saturasi-catatanKeperawatan"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-saturasi-catatanKeperawatan"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Nafas/RR(/menit)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="nafas"
                                                                                id="nafas-catatanKeperawatan"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-nafas-catatanKeperawatan"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Kesadaran</label>
                                                                        <select class="form-select" name="awareness"
                                                                            id="awareness-catatanKeperawatan"
                                                                            onchange="vitalsignInput(this)">
                                                                            <option value="0">Sadar</option>
                                                                            <option value="3">Nyeri</option>
                                                                            <option value="10">Unrespon</option>
                                                                        </select>
                                                                        <span class="h6"
                                                                            id="badge-awareness-catatanKeperawatan"></span>
                                                                    </div>
                                                                </div>
                                                                <div id="container-vitalsign-catatanKeperawatan">

                                                                </div>
                                                                <div class="col-sm-12 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Pemeriksaan</label><textarea
                                                                            name="pemeriksaan"
                                                                            id="pemeriksaan-catatanKeperawatan"
                                                                            placeholder="" value=""
                                                                            class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-sm-12">
                                                            <div class="mb-4">
                                                                <div class="form-group"><label>Tanggal Periksa</label><textarea name="examination_date" id="pemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                            </div>
                                                        </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="description-catatanKeperawatan"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">(A)
                                                            Assesment</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control"
                                                                id="description-catatanKeperawatan" name="description"
                                                                placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="instruction-catatanKeperawatan"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">(P)
                                                            Rencana Penatalaksanaan</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control"
                                                                id="instruction-catatanKeperawatan" name="instruction"
                                                                placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4">
                                                        <label for="examination_date-catatanKeperawatan"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">Tanggal
                                                            Periksa</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group"
                                                                id="examinationdate--catatanKeperawatan">
                                                                <input id="flatexamination_date-catatanKeperawatan"
                                                                    type="text"
                                                                    class="form-control datetimeflatpickr-oprs"
                                                                    placeholder="yyyy-mm-dd">
                                                                <input id="examination_date-catatanKeperawatan"
                                                                    name="examination_date" type="hidden"
                                                                    class="form-control" placeholder="yyyy-mm-dd">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>

                                                        <button type="button" id="btn-save-vitalSignAcKeperawatan"
                                                            class="btn btn-primary"><i class="fas fa-save"></i>
                                                            Simpan</button>
                                                    <?php } ?>
                                                </div>
                                                <!--./col-lg-7-->
                                            </div>
                                            <!--./row-->
                                            <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="examination_date">Tgl Periksa</label>
                                            <input type='text' name="examination_date" class="form-control" id='examination_date' />
                                        </div>
                                    </div> -->
                                            <div class="col-sm-6" style="display: none;">
                                                <div class="form-group"><label>Perawat</label><input type="text"
                                                        name="petugas-catatanKeperawatan"
                                                        id="petugas-catatanKeperawatan" placeholder=""
                                                        value="<?= user_id(); ?>" class="form-control"></div>
                                            </div>
                                        </div>
                                        <span id="total_score-catatanKeperawatan"></span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="box-tab-tools text-center mt-4" id="setDataVitalSignKeperawatanBtn">
                            <a data-toggle="modal" onclick="setDataVitalSignKeperawatan()" id="tambahVtKeperawatanShow"
                                class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah
                                Vitalsign</a>
                            <a data-toggle="modal" id="sembunyikanVtKeperawatanShow" class="btn btn-primary btn-lg"
                                style="width: 300px"><i class=" fa fa-plus"></i> Sembunyikan Form</a>
                        </div>
                        <h3>Histori Vital Sign</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class=" table-primary" style="text-align: center;">
                                    <tr>
                                        <th class="text-center" style="width: 10%;">Tanggal & Jam</th
                                            class="text-center">
                                        <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                                        <th class="text-center" colspan="6" style="width: 70%;">SOAP</th
                                            class="text-center">
                                        <th class="text-center" style="width: 5%;"></th class="text-center">
                                        <th class="text-center" style="width: 5%;"></th class="text-center">
                                    </tr>
                                </thead>
                                <tbody id="vitalSignBodyKeperawatan">
                                    <?php
                                    $total = 0;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- ----------------- -->
                    </div>
                    <div class="accordion-body" id="template-tindakan-operasi">

                    </div>

                    <div class="container" id="container-instrumen">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Daftar Instrumen</h3>
                                <table class="table table-bordered" id="instrumenTable"
                                    aria-labelledby="instrumenTableLabel">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th scope="col" width="98%">Nama Alat</th>
                                            <th scope="col" width="1%">Jumlah Sebelum</th>
                                            <th scope="col" width="1%" class="text-center"><i
                                                    class="fas fa-trash-alt"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-instrumen">
                                        <!-- Rows will be dynamically added here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3 pt-3">
                            <div class="col text-center mb-3">
                                <label for="addInstrumen" class="form-label visually-hidden">Tambah Instrumen</label>
                                <button type="button" id="addInstrumen" name="addInstrumen" data-body="body-instrumen"
                                    data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary">
                                    <i class="fas fa-plus"></i> <span>Tambah</span>
                                </button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThreess">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThreess" aria-expanded="false"
                        aria-controls="flush-collapseThreess">
                        CATATAN KEPERAWATAN INTRA OPERATIF
                    </button>
                </h2>
                <div id="flush-collapseThreess" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingThreess" data-bs-parent="#accordionCatatan">
                    <div class="accordion-body" id="cKeperawatanIntraOperatif">

                    </div>


                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThrees">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThrees" aria-expanded="false"
                        aria-controls="flush-collapseThrees">
                        CATATAN KEPERAWATAN PASCA OPERASI
                    </button>
                </h2>
                <div id="flush-collapseThrees" class="accordion-collapse collapse" aria-labelledby="flush-headingThrees"
                    data-bs-parent="#accordionCatatan">
                    <div class="accordion-body">
                        <div class="row" id="cKeperawatanPascaOperatif">

                        </div>
                        <div class="row" id="cKeperawatanPascaOperatifBromage">

                        </div>
                        <div class="row" id="cKeperawatanPascaOperatifSteward">

                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-3 d-flex justify-content-end gap-2">
            <button type="button" id="btn-print-catatan-keperawatan" class="btn btn-success">
                <i class="fas fa-print"></i> Cetak
            </button>

            <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>
                <button type="button" id="btn-save-catatan-keperawatan" class="btn btn-primary btn-save-operasi"><i
                        class="fas fa-save"></i> Simpan</button>
            <?php } ?>

        </div>
    </form>
</div>

<script type='text/javascript'>
    var mrJson;
    var lastOrder = 0;
    var vitalsign = <?= json_encode($exam); ?>;


    $("#flush-headingThree").on("click", function() {
        getVitalSignKeperawatan()
    })

    // $("#vs_status_id-catatanKeperawatan").on("change", function() {
    //     var optionSelected = $("option:selected", this);
    //     console.log(optionSelected.val());
    //     $('#container-vitalsign-catatanKeperawatan').empty();

    //     switch (optionSelected.val()) {
    //         case '4':
    //             let isi = `
    //             <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
    //                             <div class="form-group">
    //                                 <label>aaaaaa</label>
    //                                 <div class="position-relative">
    //                                     <input onchange="vitalsignInput(this)" type="text" name="temperature" id="temperature-catatanKeperawatan" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
    //                                     <span class="h6" id="badge-temperature-catatanKeperawatan"></span>
    //                                 </div>
    //                             </div>
    //                         </div>`;
    //             console.log(isi);
    //             $('#container-vitalsign-catatanKeperawatan').append(isi);
    //             break;
    //         case '10':
    //             break;
    //     }
    //     $('.vitalsignclass-catatanKeperawatan').each((index, each) => {
    //         $(each).change(element => {
    //             vitalsignInput({
    //                 value: $(each).val(),
    //                 name: $(each).attr('name'),
    //                 uniq_name: '-catatanKeperawatan',
    //                 type: optionSelected.val()
    //             })
    //         })
    //         vitalsignInput({
    //             value: $(each).val(),
    //             name: $(each).attr('name'),
    //             uniq_name: '-catatanKeperawatan',
    //             type: optionSelected.val()
    //         })
    //     });
    // })

    $("#formvitalsign-catatanKeperawatan").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        clicked_submit_btn.html('<i class="spinner-border spinner-border-sm"></i>')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/Assessment/saveExaminationInfo', //==new
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    // errorMsg(message);
                    errorSwal(message)
                    getVitalSign()
                } else {
                    // successMsg(data.message);
                    successSwal(data.message)
                    disableVitalSign()
                    $("#formvitalsignsubmit").toggle()
                    $("#formvitalsignedit").toggle()
                    getVitalSign()
                }
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            error: function(xhr) { // if error occured
                errorMsg("Error occured.please try again");
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            complete: function() {
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            }
        });
    }));


    $("#sembunyikanVtKeperawatanShow").off().on("click", function() {
        $("#tambahVtKeperawatanShow").show()
        $("#vitalSignKeperawatan").slideUp()
        $("#vitalSignKeperawatan").hide()
        $("#sembunyikanVtKeperawatanShow").hide()
    })




    function setDataVitalSignKeperawatan() {
        const vitalSignKeperawatan = $("#vitalSignKeperawatan");

        if (vitalSignKeperawatan.is(":hidden")) {
            vitalSignKeperawatan.show();
        }
        $("#vitalSignKeperawatan").find("input, textarea").val(null)
        $("#vitalSignKeperawatan").find("#total_score-catatanKeperawatan").html("")
        $("#vitalSignKeperawatan").find("span.h6").html("")
        $("#vs_status_id-catatanKeperawatan").prop("selectedIndex", 0);
        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#body_id-catatanKeperawatan").val(bodyId)
        $("#clinic_id-catatanKeperawatan").val('<?= @$visit['clinic_id']; ?>')
        $("#trans_id-catatanKeperawatan").val('<?= @$visit['trans_id']; ?>')
        $("#class_room_id-catatanKeperawatan").val('<?= @$visit['class_room_id']; ?>')
        $("#bed_id-catatanKeperawatan").val()
        $("#keluar_id-catatanKeperawatan").val('<?= @$visit['keluar_id']; ?>')
        $("#employee_id-catatanKeperawatan").val('<?= @$visit['employee_id']; ?>')
        $("#no_registration-catatanKeperawatan").val('<?= @$visit['no_registration']; ?>')
        $("#visit_id-catatanKeperawatan").val('<?= @$visit['visit_id']; ?>')
        $("#org_unit_code-catatanKeperawatan").val('<?= @$visit['org_unit_code']; ?>')
        $("#doctor-catatanKeperawatan").val('<?= @@@$visit['fullname']; ?>')
        $("#kal_id-catatanKeperawatan").val('<?= @$visit['kal_id']; ?>')
        $("#theid-catatanKeperawatan").val('<?= @$visit['pasien_id']; ?>')
        $("#thename-catatanKeperawatan").val('<?= @$visit['diantar_oleh']; ?>')
        $("#theaddress-catatanKeperawatan").val('<?= @$visit['visitor_address']; ?>')
        $("#status_pasien_id-catatanKeperawatan").val('<?= @$visit['status_pasien_id']; ?>')
        $("#isrj-catatanKeperawatan").val('<?= @$visit['isrj']; ?>')
        $("#gender-catatanKeperawatan").val('<?= @$visit['gender']; ?>')
        $("#ageyear-catatanKeperawatan").val('<?= @$visit['ageyear']; ?>')
        $("#agemonth-catatanKeperawatan").val('<?= @$visit['agemonth']; ?>')
        $("#ageday-catatanKeperawatan").val('<?= @$visit['ageday']; ?>')
        $("#examination_date-catatanKeperawatan").val(get_date())
        $("#flatexamination_date-catatanKeperawatan").val(moment(get_date()).format("DD/MM/YYYY HH:mm"))


        // var ageYear = <?= @$visit['ageyear']; ?>;
        // var ageMonth = <?= @$visit['agemonth']; ?>;
        // var ageDay = <?= @$visit['ageday']; ?>;

        // if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
        //     $("#vs_status_id-catatanKeperawatan").prop("selectedIndex", 3);
        // } else if (ageYear >= 18) {
        //     $("#vs_status_id-catatanKeperawatan").prop("selectedIndex", 1);
        // } else {
        //     $("#vs_status_id-catatanKeperawatan").prop("selectedIndex", 2);
        // }
        enableVitalSignKeperawatan()
        $("#vitalSignKeperawatan").slideDown()
        $("#sembunyikanVtKeperawatanShow").show()
        $("#tambahVtKeperawatanShow").hide()

    }

    const addRowVitalSigncatatanKeperawatan = (examselect, key) => {
        $("#vitalSignBodyKeperawatan").append($("<tr>")
                .append($("<td rowspan='2'>").append(
                    examselect.examination_date ? examselect.examination_date.substring(0, 16) : ""
                )).append($("<td rowspan='2'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='2'>").html('<button type="button" onclick="copyVitalSignKeperawatan(' +
                    key +
                    ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>'
                ))
                .append($("<td rowspan='2'>").html('<button type="button" onclick="removeCatatanKeperawatan(\'' +
                    examselect
                    .body_id +
                    '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'
                ))
            )
            .append($("<tr>")
                .append($("<td>").html(''))
                .append($("<td>").html(examselect.tension_upper + '/' + examselect.tension_below + 'mmHg'))
                .append($("<td>").html(examselect.nadi + '/menit'))
                .append($("<td>").html(examselect.nafas + '/menit'))
                .append($("<td>").html(examselect.temperature + '/°C'))
                .append($("<td>").html(examselect.saturasi + '/SpO2%'))
            )

    }

    function removeCatatanKeperawatan(id) {
        postData({
            body_id: id
        }, 'admin/PatientOperationRequest/deleteExamDetail', (res) => {
            successSwal('berhasil.');
            getVitalSignKeperawatan()
        })
    }

    function vitalsignInputcatatanKeperawatan(prop) {
        var value = prop.value.trim();
        var name = '' + prop.name + `-catatanKeperawatan`; //=new
        var data;
        var totalScore = [];

        if (isNaN(value) || value === "") {
            value = 0;
        } else {
            value = parseFloat(value);
        }

        let scoreFunction;
        if (prop.type == 1) {
            scoreFunction = getAdultScore;
        } else {
            scoreFunction = getNeonatalScore;
        }
        switch (name) {

            case "nadi-catatanKeperawatan":
                data = scoreFunction('nadi', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "temperature-catatanKeperawatan":
                data = scoreFunction('suhu', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "saturasi-catatanKeperawatan":
                data = scoreFunction('saturasi', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "nafas-catatanKeperawatan":
                data = scoreFunction('pernapasan', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;

            case "weight-catatanKeperawatan":
                if (value < 10) {
                    value = 10.00;
                } else if (value > 50) {
                    value = 50.00;
                } else {
                    value = value.toFixed(2);
                }
                break;
            case "tension_upper-catatanKeperawatan":
                if (value < 50) {
                    value = 50.00;
                } else if (value > 250) {
                    value = 250.00;
                }
                data = scoreFunction('darah', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "height-catatanKeperawatan":
                if (value > 250) {
                    value = 250;
                }
                break;
            case "tension_below-catatanKeperawatan":
                if (value < 0) {
                    value = 0.00;
                } else if (value > 300) {
                    value = 300.00;
                }
                break;
            default:
                break;
        }

        prop.value = value;

        document.getElementById('total_score-catatanKeperawatan').textContent = 'Total Skor: ' +
            sumTextContentFromClass(
                'badge-score');
    }


    function disableVitalSignKeperawatan() {
        $("#examination_date-catatanKeperawatan").prop("disabled", true)
        $("#petugas-catatanKeperawatan").prop("disabled", true)
        $("#weight-catatanKeperawatan").prop("disabled", true)
        $("#height-catatanKeperawatan").prop("disabled", true)
        $("#temperature-catatanKeperawatan").prop("disabled", true)
        $("#nadi-catatanKeperawatan").prop("disabled", true)
        $("#tension_upper-catatanKeperawatan").prop("disabled", true)
        $("#tension_below-catatanKeperawatan").prop("disabled", true)
        $("#saturasi-catatanKeperawatan").prop("disabled", true)
        $("#nafas-catatanKeperawatan").prop("disabled", true)
        $("#anamnase-catatanKeperawatan").prop("disabled", true)
        $("#vs_status_id-catatanKeperawatan").prop("disabled", true)
        $("#pemeriksaan-catatanKeperawatan").prop("disabled", true)
        $("#teraphy_desc-catatanKeperawatan").prop("disabled", true)
        $("#description-catatanKeperawatan").prop("disabled", true)
        $("#clinic_id-catatanKeperawatan").prop("disabled", true)
        $("#trans_id-catatanKeperawatan").prop("disabled", true) //==new
        $("#class_room_id-catatanKeperawatan").prop("disabled", true)
        $("#bed_id-catatanKeperawatan").prop("disabled", true)
        $("#keluar_id-catatanKeperawatan").prop("disabled", true)
        $("#employee_id-catatanKeperawatan").prop("disabled", true)
        $("#no_registraiton-catatanKeperawatan").prop("disabled", true)
        $("#visit_id-catatanKeperawatan").prop("disabled", true)
        $("#org_unit_code-catatanKeperawatan").prop("disabled", true)
        $("#doctor-catatanKeperawatan").prop("disabled", true)
        $("#kal_id-catatanKeperawatan").prop("disabled", true)
        $("#theid-catatanKeperawatan").prop("disabled", true)
        $("#thename-catatanKeperawatan").prop("disabled", true)
        $("#theaddress-catatanKeperawatan").prop("disabled", true)
        $("#status_pasien_id-catatanKeperawatan").prop("disabled", true)
        $("#isrj-catatanKeperawatan").prop("disabled", true)
        $("#gender-catatanKeperawatan").prop("disabled", true)
        $("#ageyear-catatanKeperawatan").prop("disabled", true)
        $("#agemonth-catatanKeperawatan").prop("disabled", true)
        $("#ageday-catatanKeperawatan").prop("disabled", true)
        $("#instruction-catatanKeperawatan").prop("disabled", true)
        $("#formvitalsignsubmit-catatanKeperawatan").hide()
        $("#formvitalsignedit").show()
    }

    function enableVitalSignKeperawatan() {
        $("#examination_date-catatanKeperawatan").prop("disabled", false)
        $("#petugas-catatanKeperawatan").prop("disabled", false)
        $("#weight-catatanKeperawatan").prop("disabled", false)
        $("#height-catatanKeperawatan").prop("disabled", false)
        $("#temperature-catatanKeperawatan").prop("disabled", false)
        $("#nadi-catatanKeperawatan").prop("disabled", false)
        $("#tension_upper-catatanKeperawatan").prop("disabled", false)
        $("#tension_below-catatanKeperawatan").prop("disabled", false)
        $("#saturasi-catatanKeperawatan").prop("disabled", false)
        $("#nafas-catatanKeperawatan").prop("disabled", false)
        $("#vs_status_id-catatanKeperawatan").prop("disabled", false)
        $("#anamnase-catatanKeperawatan").prop("disabled", false)
        $("#pemeriksaan-catatanKeperawatan").prop("disabled", false)
        $("#teraphy_desc-catatanKeperawatan").prop("disabled", false)
        $("#description-catatanKeperawatan").prop("disabled", false)
        $("#clinic_id-catatanKeperawatan").prop("disabled", false)
        $("#trans_id-catatanKeperawatan").prop("disabled", false) //==new
        $("#class_room_id-catatanKeperawatan").prop("disabled", false)
        $("#bed_id-catatanKeperawatan").prop("disabled", false)
        $("#keluar_id-catatanKeperawatan").prop("disabled", false)
        $("#employee_id-catatanKeperawatan").prop("disabled", false)
        $("#no_registraiton-catatanKeperawatan").prop("disabled", false)
        $("#visit_id-catatanKeperawatan").prop("disabled", false)
        $("#org_unit_code-catatanKeperawatan").prop("disabled", false)
        $("#doctor-catatanKeperawatan").prop("disabled", false)
        $("#kal_id-catatanKeperawatan").prop("disabled", false)
        $("#theid-catatanKeperawatan").prop("disabled", false)
        $("#thename-catatanKeperawatan").prop("disabled", false)
        $("#theaddress-catatanKeperawatan").prop("disabled", false)
        $("#status_pasien_id-catatanKeperawatan").prop("disabled", false)
        $("#isrj-catatanKeperawatan").prop("disabled", false)
        $("#gender-catatanKeperawatan").prop("disabled", false)
        $("#ageyear-catatanKeperawatan").prop("disabled", false)
        $("#agemonth-catatanKeperawatan").prop("disabled", false)
        $("#ageday-catatanKeperawatan").prop("disabled", false)
        $("#instruction-catatanKeperawatan").prop("disabled", false)

        postData({
                visit_id: '<?= @$visit['visit_id']; ?>',
                account_id: '10'
            }, 'admin/PatientOperationRequest/getExaminfoTop',
            (res) => {
                let exam_info = res.examInfo || {};
                $("#vs_status_id-catatanKeperawatan").val(exam_info?.vs_status_id ?? "")
                $('#weight-catatanKeperawatan').val(exam_info?.weight || 0);
                $('#height-catatanKeperawatan').val(exam_info?.height || 0);
                $('#temperature-catatanKeperawatan').val(exam_info?.temperature || 0);
                $('#nadi-catatanKeperawatan').val(exam_info?.nadi || 0);
                $('#tension_upper-catatanKeperawatan').val(exam_info?.tension_upper || 0);
                $('#tension_below-catatanKeperawatan').val(exam_info?.tension_below || 0);
                $('#saturasi-catatanKeperawatan').val(exam_info?.saturasi || 0);
                $('#nafas-catatanKeperawatan').val(exam_info?.nafas || 0);
            }
        );




        $("#formvitalsignsubmit-catatanKeperawatan").show()
        $("#formvitalsignedit").hide()
    }

    function copyVitalSignKeperawatan(key) {
        var examselect = vitalsign[key];

        var bodyId = ''
        const nowtime = moment(examselect?.examination_date).format("DD/MM/YYYY HH:mm");
        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#ageday-catatanKeperawatan").val(examselect.ageday)
        $("#agemonth-catatanKeperawatan").val(examselect.agemonth)
        $("#ageyear-catatanKeperawatan").val(examselect.ageyear)
        $("#anamnase-catatanKeperawatan").val(examselect.anamnase)
        $("#bed_id-catatanKeperawatan").val(examselect.bed_id)
        $("#body_id-catatanKeperawatan").val(examselect.body_id)
        $("#class_room_id-catatanKeperawatan").val(examselect.class_room_id)
        $("#clinic_id-catatanKeperawatan").val(examselect.clinic_id)
        $("#description-catatanKeperawatan").val(examselect.description)
        $("#doctor-catatanKeperawatan").val(examselect.doctor)
        $("#employee_id-catatanKeperawatan").val(examselect.employee_id)
        $("#flatexamination_date-catatanKeperawatan").val(nowtime).trigger("change")
        $("#gender-catatanKeperawatan").val(examselect.gender)
        $("#height-catatanKeperawatan").val(examselect.height)
        $("#instruction-catatanKeperawatan").val(examselect.instruction)
        $("#isrj-catatanKeperawatan").val(examselect.isrj)
        $("#kal_id-catatanKeperawatan").val(examselect.kal_id)
        $("#keluar_id-catatanKeperawatan").val(examselect.keluar_id)
        $("#nadi-catatanKeperawatan").val(examselect.nadi)
        $("#nafas-catatanKeperawatan").val(examselect.nafas)
        $("#no_registraiton-catatanKeperawatan").val(examselect.no_registraiton)
        $("#org_unit_code-catatanKeperawatan").val(examselect.org_unit_code)
        $("#vs_status_id-catatanKeperawatan").val(examselect.vs_status_id)
        $("#pemeriksaan-catatanKeperawatan").val(examselect.pemeriksaan)
        $("#petugas-catatanKeperawatan").val(examselect.petugas)
        $("#saturasi-catatanKeperawatan").val(examselect.saturasi)
        $("#status_pasien_id-catatanKeperawatan").val(examselect.status_pasien_id)
        $("#temperature-catatanKeperawatan").val(examselect.temperature)
        $("#tension_below-catatanKeperawatan").val(examselect.tension_below)
        $("#tension_upper-catatanKeperawatan").val(examselect.tension_upper)
        $("#teraphy_desc-catatanKeperawatan").val(examselect.teraphy_desc)
        $("#theaddress-catatanKeperawatan").val(examselect.theaddress)
        $("#theid-catatanKeperawatan").val(examselect.pasien_id)
        $("#thename-catatanKeperawatan").val(examselect.diantar_oleh)
        $("#visit_id-catatanKeperawatan").val(examselect.visit_id)
        $("#weight-catatanKeperawatan").val(examselect.weight)

        $("#org_unit_code-catatanKeperawatan").val(examselect.org_unit_code)
        $("#pasien_diagnosa_id-catatanKeperawatan").val(examselect.pasien_diagnosa_id)
        $("#no_registration-catatanKeperawatan").val(examselect.no_registration)
        $("#visit_id-catatanKeperawatan").val(examselect.visit_id)
        $("#trans_id-catatanKeperawatan").val(examselect.trans_id) //==new
        $("#bill_id-catatanKeperawatan").val(examselect.bill_id)
        $("#class_room_id-catatanKeperawatan").val(examselect.class_room_id)
        $("#bed_id-catatanKeperawatan").val(examselect.bed_id)
        $("#in_date-catatanKeperawatan").val(examselect.in_date)
        $("#exit_date-catatanKeperawatan").val(examselect.exit_date)
        $("#keluar_id-catatanKeperawatan").val(examselect.keluar_id)
        $("#imt_score-catatanKeperawatan").val(examselect.imt_score)
        $("#imt_desc-catatanKeperawatan").val(examselect.imt_desc)
        $("#pemeriksaan-catatanKeperawatan").val(examselect.pemeriksaan)
        $("#medical_treatment-catatanKeperawatan").val(examselect.medical_treatment)
        $("#modified_date-catatanKeperawatan").val(examselect.modified_date)
        $("#modified_by-catatanKeperawatan").val(examselect.modified_by)
        $("#modified_from-catatanKeperawatan").val(examselect.modified_from)
        $("#status_pasien_id-catatanKeperawatan").val(examselect.status_pasien_id)
        $("#ageyear-catatanKeperawatan").val(examselect.ageyear)
        $("#agemonth-catatanKeperawatan").val(examselect.agemonth)
        $("#ageday-catatanKeperawatan").val(examselect.ageday)
        $("#thename-catatanKeperawatan").val(examselect.thename)
        $("#theaddress-catatanKeperawatan").val(examselect.theaddress)
        $("#theid-catatanKeperawatan").val(examselect.theid)
        $("#isrj-catatanKeperawatan").val(examselect.isrj)
        $("#gender-catatanKeperawatan").val(examselect.gender)
        $("#doctor-catatanKeperawatan").val(examselect.doctor)
        $("#kal_id-catatanKeperawatan").val(examselect.kal_id)
        $("#petugas_id-catatanKeperawatan").val(examselect.petugas_id)
        $("#petugas-catatanKeperawatan").val(examselect.petugas)
        $("#account_id-catatanKeperawatan").val(examselect.account_id)
        $("#kesadaran-catatanKeperawatan").val(examselect.kesadaran)
        $("#isvalid-catatanKeperawatan").val(examselect.isvalid)

        $("#anamnase-catatanKeperawatan").val(examselect.anamnase)
        $("#description-catatanKeperawatan").val(examselect.description)
        $("#weight-catatanKeperawatan").val(examselect.weight).trigger("change")
        $("#height-catatanKeperawatan").val(examselect.height).trigger("change")
        $("#temperature-catatanKeperawatan").val(examselect.temperature).trigger("change")
        $("#nadi-catatanKeperawatan").val(examselect.nadi).trigger("change")
        $("#tension_upper-catatanKeperawatan").val(examselect.tension_upper).trigger("change")
        $("#tension_lower-catatanKeperawatan").val(examselect.tension_lower).trigger("change")
        $("#saturasi-catatanKeperawatan").val(examselect.saturasi).trigger("change")
        $("#nafas-catatanKeperawatan").val(examselect.nafas).trigger("change")
        $("#vs_status_id-catatanKeperawatan").val(examselect.vs_status_id).trigger("change")
        $("#pemeriksaan-catatanKeperawatan").val(examselect.pemeriksaan).trigger("change")

        $("#vitalSignDocument").slideDown()
        enableVitalSign()

    }
    var vitalsigndesc = []

    var i = 0



    vitalsign?.forEach((element, key) => {
        examselect = vitalsign[key];
        addRowVitalSigncatatanKeperawatan(examselect, key)
    });

    vitalsign.forEach((element, key) => {
        examselect = vitalsign[key];

        if (examselect.visit_id == '<?= @$visit['visit_id']; ?>') {

            disableVitalSignKeperawatan()
            $("#formvitalsignsubmit-catatanKeperawatan").hide()
            $("#formvitalsignedit-catatanKeperawatan").show()

            $("#clinic_id-catatanKeperawatan").val(examselect.clinic_id)
            $("#class_room_id-catatanKeperawatan").val(examselect.class_room_id)
            $("#bed_id-catatanKeperawatan").val(examselect.bed_id)
            $("#keluar_id-catatanKeperawatan").val(examselect.keluar_id)
            $("#employee_id-catatanKeperawatan").val(examselect.employee_id)
            $("#no_registration-catatanKeperawatan").val(examselect.no_registration)
            $("#visit_id-catatanKeperawatan").val(examselect.visit_id)
            $("#org_unit_code-catatanKeperawatan").val(examselect.org_unit_code)
            $("#doctor-catatanKeperawatan").val(examselect.fullname)
            $("#kal_id-catatanKeperawatan").val(examselect.kal_id)
            $("#theid-catatanKeperawatan").val(examselect.pasien_id)
            $("#thename-catatanKeperawatan").val(examselect.diantar_oleh)
            $("#theaddress-catatanKeperawatan").val(examselect.visitor_address)
            $("#status_pasien_id-catatanKeperawatan").val(examselect.status_pasien_id)
            $("#isrj-catatanKeperawatan").val(examselect.isrj)
            $("#gender-catatanKeperawatan").val(examselect.gender)
            $("#ageyear-catatanKeperawatan").val(examselect.ageyear)
            $("#agemonth-catatanKeperawatan").val(examselect.agemonth)
            $("#ageday-catatanKeperawatan").val(examselect.ageday)
            $("#body_id-catatanKeperawatan").val(examselect.body_id)

            $("#examination_date-catatanKeperawatan").val(examselect.examination_date)
            $("#petugas-catatanKeperawatan").val(examselect.petugas)
            $("#weight-catatanKeperawatan").val(examselect.weight)
            $("#height-catatanKeperawatan").val(examselect.height)
            $("#temperature-catatanKeperawatan").val(examselect.temperature)
            $("#nadi-catatanKeperawatan").val(examselect.nadi)
            $("#tension_upper-catatanKeperawatan").val(examselect.tension_upper)
            $("#tension_below-catatanKeperawatan").val(examselect.tension_below)
            $("#saturasi-catatanKeperawatan").val(examselect.saturasi)
            $("#nafas-catatanKeperawatan").val(examselect.nafas)
            $("#anamnase-catatanKeperawatan").val(examselect.anamnase)
            $("#vs_status_id-catatanKeperawatan").val(examselect.vs_status_id)
            $("#pemeriksaan-catatanKeperawatan").val(examselect.pemeriksaan)
            $("#teraphy_desc-catatanKeperawatan").val(examselect.teraphy_desc)
            $("#description-catatanKeperawatan").val(examselect.description)
            $("#clinic_id-catatanKeperawatan").val(examselect.clinic_id)
            $("#trans_id-catatanKeperawatan").val(examselect.trans_id) //==new
            $("#class_room_id-catatanKeperawatan").val(examselect.class_room_id)
            $("#bed_id-catatanKeperawatan").val(examselect.bed_id)
            $("#keluar_id-catatanKeperawatan").val(examselect.keluar_id)
            $("#employee_id-catatanKeperawatan").val(examselect.employee_id)
            $("#no_registraiton-catatanKeperawatan").val(examselect.no_registraiton)
            $("#visit_id-catatanKeperawatan").val(examselect.visit_id)
            $("#org_unit_code-catatanKeperawatan").val(examselect.org_unit_code)
            $("#doctor-catatanKeperawatan").val(examselect.doctor)
            $("#kal_id-catatanKeperawatan").val(examselect.kal_id)
            $("#theid-catatanKeperawatan").val(examselect.theid)
            $("#thename-catatanKeperawatan").val(examselect.thename)
            $("#theaddress-catatanKeperawatan").val(examselect.theaddress)
            $("#status_pasien_id-catatanKeperawatan").val(examselect.status_pasien_id)
            $("#isrj-catatanKeperawatan").val(examselect.isrj)
            $("#gender-catatanKeperawatan").val(examselect.gender)
            $("#ageyear-catatanKeperawatan").val(examselect.ageyear)
            $("#agemonth-catatanKeperawatan").val(examselect.agemonth)
            $("#ageday-catatanKeperawatan").val(examselect.ageday)
            $("#instruction-catatanKeperawatan").val(examselect.instruction)
        }

        if (typeof $("#body_id-catatanKeperawatan").val() !== 'undefined' || $(
                "#body_id-catatanKeperawatan")
            .val() == "-catatanKeperawatan") {
            $("#clinic_id-catatanKeperawatan").val('<?= @$visit['clinic_id']; ?>')
            $("#trans_id-catatanKeperawatan").val('<?= @$visit['trans_id']; ?>') //==new
            $("#class_room_id-catatanKeperawatan").val('<?= @$visit['class_room_id']; ?>')
            $("#bed_id-catatanKeperawatan").val()
            $("#keluar_id-catatanKeperawatan").val('<?= @$visit['keluar_id']; ?>')
            $("#employee_id-catatanKeperawatan").val('<?= @$visit['employee_id']; ?>')
            $("#no_registration-catatanKeperawatan").val('<?= @$visit['no_registration']; ?>')
            $("#visit_id-catatanKeperawatan").val('<?= @$visit['visit_id']; ?>')
            $("#org_unit_code-catatanKeperawatan").val('<?= @$visit['org_unit_code']; ?>')
            $("#doctor-catatanKeperawatan").val('<?= @@$visit['fullname']; ?>')
            $("#kal_id-catatanKeperawatan").val('<?= @$visit['kal_id']; ?>')
            $("#theid-catatanKeperawatan").val('<?= @$visit['pasien_id']; ?>')
            $("#thename-catatanKeperawatan").val('<?= @$visit['diantar_oleh']; ?>')
            $("#theaddress-catatanKeperawatan").val('<?= @$visit['visitor_address']; ?>')
            $("#status_pasien_id-catatanKeperawatan").val('<?= @$visit['status_pasien_id']; ?>')
            $("#isrj-catatanKeperawatan").val('<?= @$visit['isrj']; ?>')
            $("#gender-catatanKeperawatan").val('<?= @$visit['gender']; ?>')
            $("#ageyear-catatanKeperawatan").val('<?= @$visit['ageyear']; ?>')
            $("#agemonth-catatanKeperawatan").val('<?= @$visit['agemonth']; ?>')
            $("#ageday-catatanKeperawatan").val('<?= @$visit['ageday']; ?>')


        }
    });

    function getVitalSignKeperawatan() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/PatientOperationRequest/getExaminfo',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit.visit_id,
                'nomor': nomor,
                'account_id': '10'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                if (data.examInfo.length > 0) {
                    vitalsign = data.examInfo
                    $("#vitalSignBodyKeperawatan").html("")
                    vitalsign.forEach((element, key) => {
                        examselect = vitalsign[key];
                        addRowVitalSigncatatanKeperawatan(examselect, key)
                    });
                } else {
                    $("#vitalSignBodyKeperawatan").html("")

                }


            },
            error: function() {

            }
        });
    }
</script>