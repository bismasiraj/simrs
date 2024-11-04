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
        <div class="col-9">

            <div class="row mt-3 ">
                <div class="col-md-12">
                    <div class="box-tab-tools text-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#create-modal-gizi" class="btn btn-primary btn-lg" id="tambah-asuhan-gizi" style="width: 300px">+ Tambah Asuhan Gizi</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered mt-3">
                <thead class="table-primary">
                    <tr>
                        <th width="1%">No.</th>
                        <th class="text-center">Dokumen</th>
                        <th width="1%" class="text-center"><i class="fas fa-print"></i></th>
                        <th width="1%" class="text-center"><i class="fas fa-clipboard-check"></i></th>
                        <th width="1%" class="text-center"><i class="fas fa-tasks"></i></th>
                        <th width="1%" class="text-center"><i class="fas fa-edit"></i></th>
                        <th width="1%" class="text-center"><i class="fas fa-trash-alt"></i></th>
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
                                                <tr>
                                                    <th scope="col" width="1%">No.</th>
                                                    <th scope="col">Tanggal/Jam Makan</th>
                                                    <th scope="col">Nama Masakan</th>
                                                    <th scope="col">Kesimpulan</th>
                                                    <th scope="col" width="1%" class="text-center"><i class="fas fa-clipboard-check"></i></th>
                                                    <th scope="col" width="1%" class="text-center"><i class="fas fa-edit"></i></th>
                                                    <th scope="col" width="1%" class="text-center"><i class="fas fa-trash-alt"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody id="body-food-recall">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-3 pt-3">
                                    <div class="col text-center">

                                        <button type="button" class="btn btn-primary" id="addFoodRecall" data-bs-toggle="modal" data-bs-target="#foodRecallModal">
                                            <i class="fas fa-plus"></i> <span>Tambah</span>
                                        </button>

                                    </div>
                                </div>
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
                                            <thead class="thead-light text-center">
                                                <tr>
                                                    <th scope="col" width="1%">No.</th>
                                                    <th scope="col">Tanggal/Jam Makan</th>
                                                    <th scope="col">Intervensi Gizi</th>
                                                    <th scope="col">Target</th>
                                                    <th scope="col">Hasil</th>
                                                    <th scope="col">Identifikasi Masalah</th>
                                                    <th scope="col">Rencana Tindak Lanjut</th>
                                                    <th scope="col" width="1%" class="text-center"><i class="fas fa-edit"></i></th>
                                                    <th scope="col" width="1%" class="text-center"><i class="fas fa-trash-alt"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody id="body-hasil-intervensi">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-3 pt-3">
                                    <div class="col text-center">

                                        <button type="button" class="btn btn-primary" id="addHasilIntervensi" data-bs-toggle="modal" data-bs-target="#hasilIntervensiModal">
                                            <i class="fas fa-plus"></i> <span>Tambah</span>
                                        </button>

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



<!-- Modal Asuhan Gizi -->
<div class="modal fade modal-xl" id="create-modal-gizi" tabindex="-1" aria-labelledby="ModalLabelGizi" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelGizi">Asuhan Nutrisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
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
                                    <textarea class="form-control quill-editor" id="clinical_description_gizi" name="clinical_description" rows="3" readonly></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="nutrition_diagnose_gizi" class="form-label fw-bold">Diagnosa</label>
                                    <input type="text" class="form-control" id="nutrition_diagnose_gizi" name="nutrition_diagnose">
                                </div>
                                <div class="mb-2">
                                    <label for="age_category_gizi" class="form-label fw-bold">Kategori Usia</label>
                                    <select name="age_category" id="age_category_gizi" class="form-select" style="width: 100%;"></select>
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
                                <div class="mb-2" id="container_aktivitas_gizi">
                                    <label for="aktivitas_gizi" class="form-label fw-bold">Aktivitas</label>
                                    <select id="aktivitas_gizi" class="form-select">
                                        <option value="1"> -- pilih --</option>
                                        <option value="1.2">Sangat jarang berolahraga</option>
                                        <option value="1.375">Jarang olahraga (1-3 kali per minggu)</option>
                                        <option value="1.55">Cukup olahraga (3-5 kali per minggu)</option>
                                        <option value="1.725">Sering olahraga (6-7 kali per minggu)</option>
                                        <option value="1.9">Sangat sering olahraga (sekitar 2 kali dalam sehari)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="biokimia_gizi" class="form-label fw-bold">Biokimia</label>
                                <textarea class="form-control quill-editor" id="biokimia_gizi" name="biokimia" rows="3" readonly></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="food_alergy_gizi" class="form-label fw-bold">Alergi</label>
                                <input type="text" class="form-control" id="food_alergy_gizi" name="food_alergy">
                            </div>
                            <div class="mb-2">
                                <label for="energi_gizi" class="form-label fw-bold">Energi</label>
                                <input type="text" class="form-control" id="energi_gizi" name="energi" readonly>
                            </div>
                            <div class="mb-2">
                                <label for="protein_gizi" class="form-label fw-bold">Protein (gram)</label>
                                <input type="text" class="form-control" id="protein_gizi" name="protein" readonly>
                            </div>
                            <div class="mb-2">
                                <label for="karbohidrat_gizi" class="form-label fw-bold">Karbohidrat (gram)</label>
                                <input type="number" class="form-control" id="karbohidrat_gizi" name="karbohidrat" readonly>
                            </div>
                            <div class="mb-2">
                                <label for="lemak_gizi" class="form-label fw-bold">Lemak (gram)</label>
                                <input type="number" class="form-control" id="lemak_gizi" name="lemak" readonly>
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
<div class="modal fade modal-xl" id="edit-modal-gizi" tabindex="-1" aria-labelledby="ModalLabelEditGizi" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditGizi">Edit Asuhan Nutrisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="" id="formEditAsuhanGizi" method="post">
                    <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                    <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                    <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                    <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                    <input type="hidden" name="examination_date" id="examination_date_gizi">
                    <input type="hidden" name="body_id" id="body_id_gizi">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="edit_clinical_description_gizi" class="form-label fw-bold">Vital Sign</label>
                                    <textarea class="form-control quill-editor" id="edit_clinical_description_gizi" name="clinical_description" rows="3" readonly></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="edit_nutrition_diagnose_gizi" class="form-label fw-bold">Diagnosa</label>
                                    <input type="text" class="form-control" id="edit_nutrition_diagnose_gizi" name="nutrition_diagnose">
                                </div>
                                <div class="mb-2">
                                    <label for="edit_age_category_gizi" class="form-label fw-bold">Kategori Usia</label>
                                    <select name="age_category" id="edit_age_category_gizi" class="form-select" style="width: 100%;"></select>
                                </div>
                                <div class="mb-2">
                                    <label for="edit_antropometri_gizi" class="form-label fw-bold">Antropometri</label>
                                    <select name="antropometri" id="edit_antropometri_gizi" class="form-select">

                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="edit_pola_makan_gizi" class="form-label fw-bold">Pola Makan</label>
                                    <select class="form-select" id="edit_pola_makan_gizi" type="text" name="pola_makan" style="width: 100%;"></select>
                                </div>
                                <div class="mb-2" id="edit_container_aktivitas_gizi">
                                    <!-- <label for="edit_aktivitas_gizi" class="form-label fw-bold">Aktivitas</label>
                                    <select id="edit_aktivitas_gizi" class="form-select">
                                        <option value="1"> -- pilih --</option>
                                        <option value="1.2">Sangat jarang berolahraga</option>
                                        <option value="1.375">Jarang olahraga (1-3 kali per minggu)</option>
                                        <option value="1.55">Cukup olahraga (3-5 kali per minggu)</option>
                                        <option value="1.725">Sering olahraga (6-7 kali per minggu)</option>
                                        <option value="1.9">Sangat sering olahraga (sekitar 2 kali dalam sehari)</option>
                                    </select> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="edit_biokimia_gizi" class="form-label fw-bold">Biokimia</label>
                                <textarea class="form-control quill-editor" id="edit_biokimia_gizi" name="biokimia" rows="3" readonly></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="edit_food_alergy_gizi" class="form-label fw-bold">Alergi</label>
                                <input type="text" class="form-control" id="edit_food_alergy_gizi" name="food_alergy">
                            </div>
                            <div class="mb-2">
                                <label for="edit_energi_gizi" class="form-label fw-bold">Energi</label>
                                <input type="text" class="form-control" id="edit_energi_gizi" name="energi" readonly>
                            </div>
                            <div class="mb-2">
                                <label for="edit_protein_gizi" class="form-label fw-bold">Protein (gram)</label>
                                <input type="text" class="form-control" id="edit_protein_gizi" name="protein" readonly>
                            </div>
                            <div class="mb-2">
                                <label for="edit_karbohidrat_gizi" class="form-label fw-bold">Karbohidrat (gram)</label>
                                <input type="number" class="form-control" id="edit_karbohidrat_gizi" name="karbohidrat" readonly>
                            </div>
                            <div class="mb-2">
                                <label for="edit_lemak_gizi" class="form-label fw-bold">Lemak (gram)</label>
                                <input type="number" class="form-control" id="edit_lemak_gizi" name="lemak" readonly>
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
<div class="modal fade modal-xl" id="foodRecallModal" tabindex="-1" aria-labelledby="ModalLabelFoodRecall" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelFoodRecall">Food Recall</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formFoodRecall" method="post">
                <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="tanggal_food_recall" class="form-label fw-bold">Tanggal/Jam</label>
                                    <input type="text" id="tanggal_food_recall" class="form-control datepicker-gizi" name="recall_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <h3 class="fw-weight text-primary">Food Info</h3>
                                <div class="mb-2">
                                    <label for="nama_masakan_food_recall" class="form-label fw-bold">Nama Masakan</label>
                                    <input type="text" class="form-control" id="nama_masakan_food_recall" name="meal_name">
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
                                    <textarea class="form-control quill-editor" id="keterangan_food_recall" name="meal_description" rows="3"></textarea>
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


                </div>
                <div class="modal-footer">
                    <button id="saveFoodRecall" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit FoodRecall -->
<div class="modal fade modal-xl" id="editFoodRecallModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelFoodRecall">Detail Food Recall</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formEditFoodRecall" method="post">
                <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                <input type="hidden" name="recall_id" id="edit_food_recall">
                <div class="modal-body">
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
                                    <input type="text" class="form-control" id="nama_masakan_edit_food_recall" name="meal_name">
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
                                    <textarea class="form-control quill-editor" id="keterangan_edit_food_recall" name="meal_description" rows="3"></textarea>
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


                </div>
                <div class="modal-footer">
                    <button id="editFoodRecall" type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Hasil Intervensi -->
<div class="modal fade modal-xl" id="hasilIntervensiModal" tabindex="-1" aria-labelledby="ModalLabelHasilIntervensi" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelHasilIntervensi">Hasil Intervensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formHasilIntervensi" method="post">
                <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="tanggal_hasil_intervensi" class="form-label fw-bold">Tanggal/Jam</label>
                                    <input type="text" class="form-control datepicker-gizi" id="tanggal_hasil_intervensi" name="intervention_date">
                                </div>
                                <div class="mb-2">
                                    <label for="gizi_hasil_intervensi" class="form-label fw-bold">Intervensi Gizi</label>
                                    <textarea class="form-control quill-editor" id="gizi_hasil_intervensi" name="intervention_description" rows="5"></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="target_hasil_intervensi" class="form-label fw-bold">Target</label>
                                    <input type="text" class="form-control" id="target_hasil_intervensi" name="intervention_target">
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
                                <textarea class="form-control quill-editor" id="masalah_hasil_intervensi" name="intervention_problem" rows="5"></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="rencana_hasil_intervensi" class="form-label fw-bold">Rencana Tindak Lanjut</label>
                                <textarea class="form-control quill-editor" id="rencana_hasil_intervensi" name="intervention_planning" rows="5"></textarea>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button id="saveHasilIntervensi" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Hasil Intervensi -->
<div class="modal fade modal-xl" id="editHasilIntervensiModal" tabindex="-1" aria-labelledby="ModalLabelEditHasilIntervensi" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditHasilIntervensi">Hasil Intervensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formEditHasilIntervensi" method="post">
                <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
                <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
                <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                <input type="hidden" name="trans_id" value="<?= $visit['trans_id']; ?>">
                <input type="hidden" name="body_id" id="edit_intervensi">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="edit_tanggal_hasil_intervensi" class="form-label fw-bold">Tanggal/Jam</label>
                                    <input type="text" class="form-control datepicker-gizi" id="edit_tanggal_hasil_intervensi" name="intervention_date">
                                </div>
                                <div class="mb-2">
                                    <label for="edit_gizi_hasil_intervensi" class="form-label fw-bold">Intervensi Gizi</label>
                                    <textarea class="form-control quill-editor" id="edit_gizi_hasil_intervensi" name="intervention_description" rows="5"></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="edit_target_hasil_intervensi" class="form-label fw-bold">Target</label>
                                    <input type="text" class="form-control" id="edit_target_hasil_intervensi" name="intervention_target">
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
                                <textarea class="form-control quill-editor" id="edit_masalah_hasil_intervensi" name="intervention_problem" rows="5"></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="edit_rencana_hasil_intervensi" class="form-label fw-bold">Rencana Tindak Lanjut</label>
                                <textarea class="form-control quill-editor" id="edit_rencana_hasil_intervensi" name="intervention_planning" rows="5"></textarea>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button id="editHasilIntervensi" type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>