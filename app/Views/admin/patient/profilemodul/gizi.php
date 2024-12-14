<style>
    .quill-editor-gizi>.ql-toolbar:first-child {
        display: none !important;
    }
</style>
<div class="tab-pane" id="gizi" role="tabpanel">
    <div id="load-content-gizi" class="col-12 center-spinner"></div>
    <div class="row mb-3" id="content-to-hide-gizi">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <div class="col-10 mt-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="asuhan-gizi-tab">
                        <ul class="nav nav-underline mb-3" style="border-bottom: 2px solid var(--bs-border-color);">
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link active" href="#skrining-gizi-tab" data-bs-toggle="tab">Skrining Gizi</a>
                            </li>
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link" href="#asuhan-gizi-tab" data-bs-toggle="tab">Asuhan Gizi</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">

                            <div class="tab-pane fade show active" id="skrining-gizi-tab">
                                <div class="container-fluid">
                                    <div class="row mt-3 ">
                                        <div class="col-md-12">
                                            <div class="box-tab-tools text-center">
                                                <a data-bs-toggle="modal" data-bs-target="#create-modal-skrining" class="btn btn-primary btn-lg" id="tambah-skrining-gizi" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Formulir Skrining Gizi</a>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered mt-3" id="table_skrining_gizi">
                                        <thead>
                                            <tr class="table-primary p-0">
                                                <th style="width:1% !important;" class="p-1">No.</th>
                                                <th class="text-center p-1">Formulir Skrining</th>
                                                <th style="width:1% !important;" class="text-center p-1"><i class="fas fa-print"></i></th>
                                                <th style="width:1% !important;" class="text-center p-1"><i class="fas fa-edit"></i></th>
                                                <th style="width:1% !important;" class="text-center p-1"><i class="fas fa-trash-alt"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody id="containerBodySkrining"></tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="asuhan-gizi-tab">
                                <div class="container-fluid">
                                    <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['operatorgizi', 'operatorgizi', 'superuser'])) : ?>
                                        <div class="row mt-3 ">
                                            <div class="col-md-12">
                                                <div class="box-tab-tools text-center">
                                                    <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#create-modal-gizi" class="btn btn-primary btn-lg" id="tambah-asuhan-gizi" style="width: 300px">+ Tambah Asuhan Gizi</button> -->
                                                    <a data-bs-toggle="modal" data-bs-target="#create-modal-gizi" class="btn btn-primary btn-lg" id="tambah-asuhan-gizi" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Asuhan Gizi</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <table class="table table-bordered mt-3" id="table_asuhan_gizi">
                                        <thead class="table-primary">
                                            <tr>
                                                <th width="1%">No.</th>
                                                <th class="text-center">Dokumen</th>
                                                <th width="1%" class="text-center"><i class="fas fa-print"></i></th>
                                                <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['operatorgizi', 'superuser'])) : ?>
                                                    <!-- <th width="1%" class="text-center"><i class="fas fa-clipboard-check"></i></th> -->
                                                <?php endif; ?>
                                                <th width="1%" class="text-center"><i class="fas fa-tasks"></i></th>
                                                <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['operatorgizi', 'operatorgizi', 'superuser'])) : ?>
                                                    <th width="1%" class="text-center"><i class="fas fa-edit"></i></th>
                                                    <th width="1%" class="text-center"><i class="fas fa-clone"></i></th>
                                                    <th width="1%" class="text-center"><i class="fas fa-trash-alt"></i></th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody id="containerBodyGizi"></tbody>
                                    </table>
                                    <div class="position-relative mt-3">
                                        <div id="load-content-accordion-gizi" class="col-12 center-spinner"></div>
                                        <div class="accordion mt-4" id="accordionGizi">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingGiziDiagnosis">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#diagnosisGizi" aria-expanded="true" aria-controls="diagnosisGizi">
                                                        Diagnosis
                                                    </button>
                                                </h2>
                                                <div id="diagnosisGizi" class="accordion-collapse collapse" aria-labelledby="headingGiziDiagnosis" data-bs-parent="#accordionGizi">
                                                    <div class="accordion-body" id="body_diagnosa_gizi">
                                                        <div class="row mb-4 pt-4">
                                                            <div class="table tablecustom-responsive">
                                                                <h4><b>DIAGNOSA</b></h4>
                                                                <hr>
                                                                <form action="" method="post" id="formDiagnosaGizi">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <th class="text-center" style="width: 40%">Diagnosa</th>
                                                                            <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                                            <th class="text-center" style="width: 20%">Kategori Diagnosis</th>
                                                                        </thead>
                                                                        <tbody id="bodyDiagGizi">
                                                                        </tbody>
                                                                    </table>
                                                                </form>
                                                            </div>

                                                        </div>
                                                        <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['operatorgizi', 'operatorgizi', 'superuser'])) : ?>
                                                            <div class="row mt-3">
                                                                <div class="col text-center">
                                                                    <button type="button" id="addDiagnosaGizi" name="addDiagnosaGizi" data-body="body-diagnosisGizi" class="btn btn-primary">
                                                                        <i class="fas fa-plus"></i> <span>Tambah</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex mt-3">
                                                                <button id="btnSaveDiagnosaGizi" class="btn btn-primary ms-auto">Simpan</button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFoodRecall">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#foodRecallGizi" aria-expanded="false" aria-controls="foodRecallGizi">
                                                        Food Recall
                                                    </button>
                                                </h2>
                                                <div id="foodRecallGizi" class="accordion-collapse collapse" aria-labelledby="headingFoodRecall" data-bs-parent="#accordionGizi">
                                                    <div class="accordion-body" id="body_food_recall_gizi">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h3>Food Recall</h3>
                                                                <table class="table table-bordered" id="foodRecallTable" aria-labelledby="foodRecallTableLabel">
                                                                    <thead class="thead-light text-center">
                                                                        <tr class="table-primary text-center">
                                                                            <th scope="col" width="1%">No.</th>
                                                                            <th scope="col">Tanggal/Jam Makan</th>
                                                                            <th scope="col">Nama Masakan</th>
                                                                            <th scope="col">Kesimpulan</th>
                                                                            <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['operatorgizi', 'operatorgizi', 'superuser'])) : ?>
                                                                                <th scope="col" width="1%" class="text-center"><i class="fas fa-edit"></i></th>
                                                                                <th scope="col" width="1%" class="text-center"><i class="fas fa-trash-alt"></i></th>
                                                                            <?php endif; ?>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="body-food-recall">

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['operatorgizi', 'operatorgizi', 'superuser'])) : ?>
                                                            <div class="row mt-3 pt-3">
                                                                <div class="col text-center">

                                                                    <button type="button" class="btn btn-primary" id="addFoodRecall" data-bs-toggle="modal" data-bs-target="#foodRecallModal">
                                                                        <i class="fas fa-plus"></i> <span>Tambah</span>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingHasilIntervensi">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#hasilIntervensiGizi" aria-expanded="false" aria-controls="hasilIntervensiGizi">
                                                        Rencana dan Hasil Intervensi
                                                    </button>
                                                </h2>
                                                <div id="hasilIntervensiGizi" class="accordion-collapse collapse" aria-labelledby="headingHasilIntervensi" data-bs-parent="#accordionGizi">
                                                    <div class="accordion-body" id="body_intervensi_gizi">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h3>Rencana Dan Hasil Intervensi</h3>
                                                                <table class="table table-bordered" id="intervensiGiziTable" aria-labelledby="intervensiGiziTableLabel">
                                                                    <thead>
                                                                        <tr class="table-primary text-center">
                                                                            <th scope="col" width="1%">No.</th>
                                                                            <th scope="col">Tanggal/Jam Makan</th>
                                                                            <th scope="col">Intervensi Gizi</th>
                                                                            <th scope="col">Target</th>
                                                                            <th scope="col">Hasil</th>
                                                                            <th scope="col">Identifikasi Masalah</th>
                                                                            <th scope="col">Rencana Tindak Lanjut</th>
                                                                            <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['operatorgizi', 'operatorgizi', 'superuser'])) : ?>
                                                                                <th scope="col" width="1%" class="text-center"><i class="fas fa-laptop-medical"></i></th>
                                                                                <th scope="col" width="1%" class="text-center"><i class="fas fa-edit"></i></th>
                                                                                <th scope="col" width="1%" class="text-center"><i class="fas fa-trash-alt"></i></th>
                                                                            <?php endif; ?>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="body-hasil-intervensi">

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3 pt-3">
                                                            <div class="col text-center">
                                                                <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['admingizi', 'operatorgizi', 'superuser'])) : ?>
                                                                    <button type="button" class="btn btn-primary" id="addHasilIntervensi" data-bs-toggle="modal" data-bs-target="#hasilIntervensiModal">
                                                                        <i class="fas fa-plus"></i> <span>Tambah</span>
                                                                    </button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <button class="btn btn-sm btn-primary ms-auto" id="btn-close-gizi">Tutup</button>
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
</div>



<!-- Modal Asuhan Gizi -->
<div class="modal fade modal-xl" id="create-modal-gizi" tabindex="-1" aria-labelledby="ModalLabelGizi">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelGizi">Asuhan Nutrisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 75vh; overflow-y: auto;">
                <form action="" id="formAsuhanGizi" method="post">
                    <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                    <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                    <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                    <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                    <input type="hidden" name="examination_date" id="examination_date_gizi">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="clinical_description_gizi" class="form-label fw-bold">Vital Sign</label>
                                    <textarea class="form-control quill-editor-gizi" id="clinical_description_gizi" name="clinical_description" rows="3" readonly></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="nutrition_diagnose_gizi" class="form-label fw-bold">Diagnosa</label>
                                    <input type="text" class="form-control" id="nutrition_diagnose_gizi" name="nutrition_diagnose">
                                </div>
                                <div class="mb-2">
                                    <label for="age_category_gizi" class="form-label fw-bold">Kategori Usia</label>
                                    <select name="age_category" id="gizi_age_category" class="form-select"></select>
                                </div>
                                <div class="mb-2">
                                    <label for="factor_activity" class="form-label fw-bold">Faktor Aktivitas</label>
                                    <select name="fa_value" id="factor_activity" class="form-select" style="width: 100%;"></select>
                                </div>
                                <div class="mb-2">
                                    <label for="factor_stress" class="form-label fw-bold">Faktor Stress</label>
                                    <select name="fs_value" id="factor_stress" class="form-select" style="width: 100%;"></select>
                                </div>
                                <div class="mb-2">
                                    <label for="antropometri_gizi" class="form-label fw-bold">Antropometri</label>
                                    <select name="antropometri" id="antropometri_gizi" class="form-select">
                                        <option value="anak">Anak</option>
                                        <option value="dewasa">Dewasa</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="pola_makan_gizi" class="form-label fw-bold">Pola Makan</label>
                                    <select class="form-select" id="pola_makan_gizi" type="text" name="pola_makan" style="width: 100%;"></select>
                                </div>

                            </div>
                        </div>
                        <div class="col-6">

                            <div class="mb-2">
                                <label for="biokimia_gizi" class="form-label fw-bold">Biokimia</label>
                                <textarea class="form-control quill-editor-gizi" id="biokimia_gizi" name="biokimia" rows="3"></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="food_alergy_gizi" class="form-label fw-bold">Alergi</label>
                                <input type="text" class="form-control" id="food_alergy_gizi" name="food_alergy">
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label for="height_gizi" class="form-label fw-bold">Tinggi Badan</label>
                                        <input type="number" class="form-control" id="height_gizi" name="weight">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label for="weight_gizi" class="form-label fw-bold">Berat Badan</label>
                                        <input type="number" class="form-control" id="weight_gizi" name="height">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label for="bbi_gizi" class="form-label fw-bold">BBI</label>
                                        <input type="number" class="form-control" id="bbi_gizi" name="weight_ideal">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="energi_gizi" class="form-label fw-bold">Energi</label>
                                <input type="number" class="form-control" id="energi_gizi" name="energi">
                            </div>
                            <div class="mb-2">
                                <label for="protein_gizi" class="form-label fw-bold">Protein (gram)</label>
                                <input type="number" class="form-control" id="protein_gizi" name="protein">
                            </div>
                            <div class="mb-2">
                                <label for="karbohidrat_gizi" class="form-label fw-bold">Karbohidrat (gram)</label>
                                <input type="number" class="form-control" id="karbohidrat_gizi" name="karbohidrat">
                            </div>
                            <div class="mb-2">
                                <label for="lemak_gizi" class="form-label fw-bold">Lemak (gram)</label>
                                <input type="number" class="form-control" id="lemak_gizi" name="lemak">
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button id="saveAsuhanGizi" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Asuhan Gizi -->
<div class="modal fade modal-xl" id="edit-modal-gizi" tabindex="-1" aria-labelledby="ModalLabelEditGizi">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditGizi">Edit Asuhan Nutrisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 75vh; overflow-y: auto;">
                <form action="" id="formEditAsuhanGizi" method="post">
                    <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                    <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                    <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                    <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                    <input type="hidden" name="examination_date" id="edit_examination_date_gizi">
                    <input type="hidden" name="body_id" id="body_id_gizi">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="edit_clinical_description_gizi" class="form-label fw-bold">Vital Sign</label>
                                    <textarea class="form-control quill-editor-gizi" id="edit_clinical_description_gizi" name="clinical_description" rows="3" readonly></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="edit_nutrition_diagnose_gizi" class="form-label fw-bold">Diagnosa</label>
                                    <input type="text" class="form-control" id="edit_nutrition_diagnose_gizi" name="nutrition_diagnose">
                                </div>
                                <div class="mb-2">
                                    <label for="edit_age_category_gizi" class="form-label fw-bold">Kategori Usia</label>
                                    <select name="age_category" id="edit_gizi_age_category" class="form-select"></select>
                                </div>
                                <div class="mb-2">
                                    <label for="edit_factor_activity" class="form-label fw-bold">Faktor Aktivitas</label>
                                    <select name="fa_value" id="edit_factor_activity" class="form-select" style="width: 100%;"></select>
                                </div>
                                <div class="mb-2">
                                    <label for="edit_factor_stress" class="form-label fw-bold">Faktor Stress</label>
                                    <select name="fs_value" id="edit_factor_stress" class="form-select" style="width: 100%;"></select>
                                </div>
                                <div class="mb-2">
                                    <label for="edit_antropometri_gizi" class="form-label fw-bold">Antropometri</label>
                                    <select name="antropometri" id="edit_antropometri_gizi" class="form-select">
                                        <option value="anak">Anak</option>
                                        <option value="dewasa">Dewasa</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="edit_pola_makan_gizi" class="form-label fw-bold">Pola Makan</label>
                                    <select class="form-select" id="edit_pola_makan_gizi" type="text" name="pola_makan" style="width: 100%;"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="edit_biokimia_gizi" class="form-label fw-bold">Biokimia</label>
                                <textarea class="form-control quill-editor-gizi" id="edit_biokimia_gizi" name="biokimia" rows="3"></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="edit_food_alergy_gizi" class="form-label fw-bold">Alergi</label>
                                <input type="text" class="form-control" id="edit_food_alergy_gizi" name="food_alergy">
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label for="edit_height_gizi" class="form-label fw-bold">Tinggi Badan</label>
                                        <input type="number" class="form-control" id="edit_height_gizi" name="weight">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label for="edit_weight_gizi" class="form-label fw-bold">Berat Badan</label>
                                        <input type="number" class="form-control" id="edit_weight_gizi" name="height">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label for="edit_bbi_gizi" class="form-label fw-bold">BBI</label>
                                        <input type="number" class="form-control" id="edit_bbi_gizi" name="weight_ideal">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="edit_energi_gizi" class="form-label fw-bold">Energi</label>
                                <input type="text" class="form-control" id="edit_energi_gizi" name="energi">
                            </div>
                            <div class="mb-2">
                                <label for="edit_protein_gizi" class="form-label fw-bold">Protein (gram)</label>
                                <input type="text" class="form-control" id="edit_protein_gizi" name="protein">
                            </div>
                            <div class="mb-2">
                                <label for="edit_karbohidrat_gizi" class="form-label fw-bold">Karbohidrat (gram)</label>
                                <input type="number" class="form-control" id="edit_karbohidrat_gizi" name="karbohidrat">
                            </div>
                            <div class="mb-2">
                                <label for="edit_lemak_gizi" class="form-label fw-bold">Lemak (gram)</label>
                                <input type="number" class="form-control" id="edit_lemak_gizi" name="lemak">
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button id="editAsuhanGizi" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal FoodRecall -->
<div class="modal fade modal-xl" id="foodRecallModal" tabindex="-1" aria-labelledby="ModalLabelFoodRecall">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelFoodRecall">Food Recall</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formFoodRecall" method="post">
                    <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                    <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                    <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                    <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="tanggal_food_recall" class="form-label fw-bold">Tanggal/Jam</label>
                                    <input type="text" id="tanggal_food_recall" class="form-control datepicker-gizi" name="recall_date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <h3 class="fw-weight text-primary">Food Info</h3>
                                <div class="mb-2">
                                    <label for="nama_masakan_food_recall" class="form-label fw-bold">Nama Masakan</label>
                                    <!-- <input type="text" class="form-control" id="nama_masakan_food_recall" name="meal_name"> -->
                                    <select class="form-select" id="nama_masakan_food_recall" name="meal_name" style="width: 100%;">
                                        <option value="">--pilih--</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="urt_masakan_food_recall" class="form-label fw-bold">URT Masakan</label>
                                    <input type="text" class="form-control" id="urt_masakan_food_recall" name="meal_urt">
                                </div>
                                <div class="mb-2">
                                    <label for="estimasi_gram_food_recall" class="form-label fw-bold">Estimasi Gram</label>
                                    <input type="number" class="form-control" id="estimasi_gram_food_recall" name="meal_grams">
                                </div>
                                <div class="mb-2">
                                    <label for="keterangan_food_recall" class="form-label fw-bold">Keterangan</label>
                                    <textarea class="form-control quill-editor-gizi" id="keterangan_food_recall" name="meal_description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="fw-weight text-primary">Ingredient Info</h3>
                            <div class="mb-2">
                                <label for="nama_bahan_food_recall" class="form-label fw-bold">Nama Bahan</label>
                                <input type="text" class="form-control" id="nama_bahan_food_recall" name="ingredient_name">
                            </div>
                            <div class="mb-2">
                                <label for="urt_bahan_food_recall" class="form-label fw-bold">URT Bahan</label>
                                <input type="text" class="form-control" id="urt_bahan_food_recall" name="ingredient_urt">
                            </div>
                            <div class="mb-2">
                                <label for="gramasi_bahan_food_recall" class="form-label fw-bold">Gramasi Bahan</label>
                                <input type="number" class="form-control" id="gramasi_bahan_food_recall" name="ingredient_grams">
                            </div>
                            <div class="mb-2">
                                <label for="netto_bahan_food_recall" class="form-label fw-bold">Netto Bahan</label>
                                <input type="number" class="form-control" id="netto_bahan_food_recall" name="ingredient_netto">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button id="saveFoodRecall" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit FoodRecall -->
<div class="modal fade modal-xl" id="editFoodRecallModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelFoodRecall">Detail Food Recall</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formEditFoodRecall" method="post">
                    <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                    <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                    <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                    <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                    <input type="hidden" name="recall_id" id="edit_food_recall">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="tanggal_edit_food_recall" class="form-label fw-bold">Tanggal/Jam</label>
                                    <input type="text" id="tanggal_edit_food_recall" class="form-control datepicker-gizi" name="recall_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <h3 class="fw-weight text-primary">Food Info</h3>
                                <div class="mb-2">
                                    <label for="nama_masakan_edit_food_recall" class="form-label fw-bold">Nama Masakan</label>
                                    <select class="form-select" id="nama_masakan_edit_food_recall" name="meal_name" style="width: 100%;">
                                        <option value="">--pilih--</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="urt_masakan_edit_food_recall" class="form-label fw-bold">URT Masakan</label>
                                    <input type="text" class="form-control" id="urt_masakan_edit_food_recall" name="meal_urt">
                                </div>
                                <div class="mb-2">
                                    <label for="estimasi_gram_edit_food_recall" class="form-label fw-bold">Estimasi Gram</label>
                                    <input type="number" class="form-control" id="estimasi_gram_edit_food_recall" name="meal_grams">
                                </div>
                                <div class="mb-2">
                                    <label for="keterangan_edit_food_recall" class="form-label fw-bold">Keterangan</label>
                                    <textarea class="form-control quill-editor-gizi" id="keterangan_edit_food_recall" name="meal_description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="fw-weight text-primary">Ingredient Info</h3>
                            <div class="mb-2">
                                <label for="nama_bahan_edit_food_recall" class="form-label fw-bold">Nama Bahan</label>
                                <input type="text" class="form-control" id="nama_bahan_edit_food_recall" name="ingredient_name">
                            </div>
                            <div class="mb-2">
                                <label for="urt_bahan_edit_food_recall" class="form-label fw-bold">URT Bahan</label>
                                <input type="text" class="form-control" id="urt_bahan_edit_food_recall" name="ingredient_urt">
                            </div>
                            <div class="mb-2">
                                <label for="gramasi_bahan_edit_food_recall" class="form-label fw-bold">Gramasi Bahan</label>
                                <input type="number" class="form-control" id="gramasi_bahan_edit_food_recall" name="ingredient_grams">
                            </div>
                            <div class="mb-2">
                                <label for="netto_bahan_edit_food_recall" class="form-label fw-bold">Netto Bahan</label>
                                <input type="number" class="form-control" id="netto_bahan_edit_food_recall" name="ingredient_netto">
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button id="editFoodRecall" type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hasil Intervensi -->
<div class="modal fade modal-xl" id="hasilIntervensiModal" tabindex="-1" aria-labelledby="ModalLabelHasilIntervensi">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelHasilIntervensi">Hasil Intervensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 75vh; overflow-y: auto;">
                <form action="" id="formHasilIntervensi" method="post">
                    <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                    <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                    <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                    <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="tanggal_hasil_intervensi" class="form-label fw-bold">Tanggal/Jam</label>
                                    <input type="text" class="form-control datepicker-gizi" id="tanggal_hasil_intervensi" name="intervention_date">
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label fw-bold">Intervensi Gizi</label>
                                    <div class="row" id="container_intervention_description">

                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="target_hasil_intervensi" class="form-label fw-bold">Target</label>
                                    <select name="intervention_target" id="target_hasil_intervensi" class="form-select">
                                        <option value="0">Target 0%</option>
                                        <option value="25">Target 25%</option>
                                        <option value="50">Target 50%</option>
                                        <option value="75">Target 75%</option>
                                        <option value="100">Target 100%</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="hasil_hasil_intervensi" class="form-label fw-bold">Hasil</label>
                                    <input type="text" class="form-control" id="hasil_hasil_intervensi" name="intervention_result">
                                </div>

                            </div>
                        </div>
                        <div class="col-7">
                            <div class="mb-2">
                                <label for="masalah_hasil_intervensi" class="form-label fw-bold">Indentifikasi Masalah</label>
                                <textarea class="form-control quill-editor-gizi" id="masalah_hasil_intervensi" name="intervention_problem" rows="5"></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="rencana_hasil_intervensi" class="form-label fw-bold">Rencana Tindak Lanjut</label>
                                <textarea class="form-control quill-editor-gizi" id="rencana_hasil_intervensi" name="intervention_planning" rows="5"></textarea>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button id="saveHasilIntervensi" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Hasil Intervensi -->
<div class="modal fade modal-xl" id="editHasilIntervensiModal" tabindex="-1" aria-labelledby="ModalLabelEditHasilIntervensi">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditHasilIntervensi">Hasil Intervensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 75vh; overflow-y: auto;">
                <form action="" id="formEditHasilIntervensi" method="post">
                    <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                    <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                    <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                    <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                    <input type="hidden" name="body_id" id="edit_intervensi">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="edit_tanggal_hasil_intervensi" class="form-label fw-bold">Tanggal/Jam</label>
                                    <input type="text" class="form-control datepicker-gizi" id="edit_tanggal_hasil_intervensi" name="intervention_date">
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label fw-bold">Intervensi Gizi</label>
                                    <div class="row" id="container_edit_intervention_description">

                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="edit_target_hasil_intervensi" class="form-label fw-bold">Target</label>
                                    <select name="edit_intervention_target" id="edit_target_hasil_intervensi" class="form-select">
                                        <option value="0">Target 0%</option>
                                        <option value="25">Target 25%</option>
                                        <option value="50">Target 50%</option>
                                        <option value="75">Target 75%</option>
                                        <option value="100">Target 100%</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="edit_hasil_hasil_intervensi" class="form-label fw-bold">Hasil</label>
                                    <input type="text" class="form-control" id="edit_hasil_hasil_intervensi" name="intervention_result">
                                </div>

                            </div>
                        </div>
                        <div class="col-7">
                            <div class="mb-2">
                                <label for="edit_masalah_hasil_intervensi" class="form-label fw-bold">Indentifikasi Masalah</label>
                                <textarea class="form-control quill-editor-gizi" id="edit_masalah_hasil_intervensi" name="intervention_problem" rows="5"></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="edit_rencana_hasil_intervensi" class="form-label fw-bold">Rencana Tindak Lanjut</label>
                                <textarea class="form-control quill-editor-gizi" id="edit_rencana_hasil_intervensi" name="intervention_planning" rows="5"></textarea>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button id="editHasilIntervensi" type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Monitoring Evaluasi -->
<div class="modal fade modal-xl" id="monitoringEvaluasiModal" tabindex="-1" aria-labelledby="ModalLabelMonitoringEvaluasi">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelMonitoringEvaluasi">Monitoring Evaluasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="load-content-monitoring" class="col-12 center-spinner"></div>
            <div class="modal-body" style="height: 75vh; overflow-y: auto;" id="content-to-hide-monitoring">
                <h3 class="card-title">Gizi yang disajikan</h3>
                <table class="table table-bordered" style="width: auto; table-layout: auto;">

                    <thead>
                        <tr class="table-primary">
                            <th>Gizi</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-peyajian-gizi"></tbody>

                </table>
                <br>
                <h3 class="card-title">Monitoring Evaluasi</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <td>Total Kalori</td>
                            <td>Target</td>
                            <td>Kalori dikonsumsi</td>
                            <td>Protein</td>
                            <td>Karbohidrat</td>
                            <td>Lemak</td>
                        </tr>
                    </thead>

                    <tbody id="tbody-monitoring-evaluasi">

                    </tbody>
                </table>
                <!-- <h3 class="card-title">Food Waste</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Total Kalori</td>
                            <td>Target</td>
                            <td>MP</td>
                            <td>LH</td>
                            <td>LN</td>
                            <td>S</td>
                            <td>B</td>
                            <td>DIET EKSTRA</td>
                        </tr>
                    </thead>
                    <tbody id="tbody-food-waste">

                    </tbody>
                </table> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>





<!-- Modal Tambah Skrining Gizi -->
<div class="modal fade modal-xl" id="create-modal-skrining" tabindex="-1" aria-labelledby="ModalLabelSkriningGizi">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelSkriningGizi">Tambah Skrining Gizi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="height: 75vh; overflow-y: auto;">
                <h3 class="text-center">Formulir Skrining Gizi</h3>
                <form action="" method="POST" id="formSkriningGizi">
                    <div class="row">
                        <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                        <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                        <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                        <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                        <input type="hidden" name="thename" value="<?= $visit['diantar_oleh']; ?>">
                        <input type="hidden" name="theaddress" value="<?= $visit['visitor_address']; ?>">
                        <input type="hidden" name="clinic_id" value="<?= $visit['clinic_id']; ?>">
                        <input type="hidden" name="employee_id" value="<?= $visit['employee_id']; ?>">
                        <input type="hidden" name="class_room_id" value="<?= $visit['class_room_id']; ?>">
                        <input type="hidden" name="bed_id" value="<?= $visit['bed_id']; ?>">
                        <input type="hidden" name="ageyear" value="<?= $visit['ageyear']; ?>">
                        <input type="hidden" name="agemonth" value="<?= $visit['agemonth']; ?>">
                        <input type="hidden" name="ageday" value="<?= $visit['ageday']; ?>">

                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label fw-bold">Kategori Formulir</label>
                                <select class="form-select" id="select_skrining_gizi" name="p_type">
                                    <option selected>Pilih kategori</option>
                                    <option value="GIZ0601">Anak 1 bulan - 18 tahun (Adaptasi Strong-kids)</option>
                                    <option value="GIZ0602">Malnutrition Screening Tool (MST)</option>
                                    <option value="GIZ0603">Mini Nutritional Assessment (MNA)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="age_category_screening" class="form-label fw-bold">Kategori Usia</label>
                                <select name="age_cat" id="age_category_screening" class="form-select" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-3 mb-3">
                            <div class="form-group">
                                <label for="height_screening" class="form-label fw-bold">Tinggi Badan</label>
                                <input name="height" id="height_screening" class="form-control">
                            </div>
                        </div>
                        <div class="col-3 mb-3">
                            <div class="form-group">
                                <label for="weight_screening" class="form-label fw-bold">Berat Badan</label>
                                <input name="weight" id="weight_screening" class="form-control">
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="imt_screening" class="form-label fw-bold">IMT</label>
                                <input name="imt" id="imt_screening" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <table class="table table-bordered">
                                <tr class="table-primary">
                                    <th class="p-1" style="width:1% !important">No.</th>
                                    <th class="p-1">Pertanyaan</th>
                                    <th class="p-1" style="width:120px !important;">Pilih</th>
                                </tr>
                                <tbody id="tbodySkriningGizi"></tbody>
                            </table>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnSaveSkrining"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Skrining Gizi -->
<div class="modal fade modal-xl" id="edit-modal-skrining" tabindex="-1" aria-labelledby="ModalLabelEditSkriningGizi">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditSkriningGizi">Detail Skrining Gizi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="height: 75vh; overflow-y: auto;">
                <h3 class="text-center">Formulir Skrining Gizi</h3>
                <form action="" method="POST" id="edit_formSkriningGizi">
                    <div class="row">
                        <input type="hidden" name="body_id" id="body_id-edit-skrining">

                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label fw-bold">Kategori Formulir</label>
                                <select class="form-select" id="edit_select_skrining_gizi" name="p_type">
                                    <option selected>Pilih kategori</option>
                                    <option value="GIZ0601">Anak 1 bulan - 18 tahun (Adaptasi Strong-kids)</option>
                                    <option value="GIZ0602">Malnutrition Screening Tool (MST)</option>
                                    <option value="GIZ0603">Mini Nutritional Assessment (MNA)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="edit_age_category_screening" class="form-label fw-bold">Kategori Usia</label>
                                <select name="age_cat" id="edit_age_category_screening" class="form-select" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-3 mb-3">
                            <div class="form-group">
                                <label for="height_screening" class="form-label fw-bold">Tinggi Badan</label>
                                <input name="height" id="edit_height_screening" class="form-control">
                            </div>
                        </div>
                        <div class="col-3 mb-3">
                            <div class="form-group">
                                <label for="weight_screening" class="form-label fw-bold">Berat Badan</label>
                                <input name="weight" id="edit_weight_screening" class="form-control">
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="imt_screening" class="form-label fw-bold">IMT</label>
                                <input name="imt" id="edit_imt_screening" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <table class="table table-bordered">
                                <tr class="table-primary">
                                    <th class="p-1" style="width:1% !important">No.</th>
                                    <th class="p-1">Pertanyaan</th>
                                    <th class="p-1" style="width:120px !important;">Pilih</th>
                                </tr>
                                <tbody id="edit_tbodySkriningGizi"></tbody>
                            </table>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnUpdateSkrining"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>