<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
$group = user()->getRoles();

$menu['fallrisk'] = 1;
$menu['painmonitoring'] = 1;
$menu['triase'] = 1;
$menu['painmonitoring'] = 1;
$menu['apgar'] = 1;
$menu['skrininggizi'] = 1;
$menu['adl'] = 1;
$menu['dekubitus'] = 1;
$menu['stabilitas'] = 1;
$menu['edukasiintegrasi'] = 1;
$menu['formedukasi'] = 1;
$menu['gcs'] = 1;
$menu['integumen'] = 1;
$menu['anak'] = 1;
$menu['neonatus'] = 1;
$menu['neurosensoris'] = 1;
$menu['pencernaan'] = 1;
$menu['pernapasan'] = 1;
$menu['perkemihan'] = 1;
$menu['psikologi'] = 1;
$menu['sirkulasi'] = 1;
$menu['seksual'] = 1;
$menu['social'] = 1;
$menu['tht'] = 1;
$menu['tidur'] = 1;


if ($visit['clinic_id'] == 'P012') {
    $menu['fallrisk'] = 1;
    $menu['painmonitoring'] = 1;
    $menu['triase'] = 1;
    $menu['apgar'] = 0;
    $menu['skrininggizi'] = 1;
    $menu['adl'] = 0;
    $menu['dekubitus'] = 0;
    $menu['stabilitas'] = 0;
    $menu['edukasiintegrasi'] = 0;
    $menu['formedukasi'] = 0;
    $menu['gcs'] = 0;
    $menu['integumen'] = 1;
    $menu['anak'] = 0;
    $menu['neonatus'] = 0;
    $menu['neurosensoris'] = 1;
    $menu['pencernaan'] = 0;
    $menu['pernapasan'] = 0;
    $menu['perkemihan'] = 1;
    $menu['psikologi'] = 0;
    $menu['sirkulasi'] = 1;
    $menu['seksual'] = 0;
    $menu['social'] = 0;
    $menu['tht'] = 0;
    $menu['tidur'] = 0;
} else if ($visit['isrj'] == '0') {
    $menu['fallrisk'] = 1;
    $menu['painmonitoring'] = 1;
    $menu['triase'] = 0;
    $menu['apgar'] = 0;
    $menu['skrininggizi'] = 1;
    $menu['adl'] = 0;
    $menu['dekubitus'] = 1;
    $menu['stabilitas'] = 0;
    $menu['edukasiintegrasi'] = 0;
    $menu['formedukasi'] = 1;
    $menu['gcs'] = 1;
    $menu['integumen'] = 1;
    $menu['anak'] = 1;
    $menu['neonatus'] = 1;
    $menu['neurosensoris'] = 1;
    $menu['pencernaan'] = 1;
    $menu['pernapasan'] = 1;
    $menu['perkemihan'] = 1;
    $menu['psikologi'] = 1;
    $menu['sirkulasi'] = 1;
    $menu['seksual'] = 1;
    $menu['social'] = 1;
    $menu['tht'] = 1;
    $menu['tidur'] = 1;
} else {
    $menu['fallrisk'] = 1;
    $menu['painmonitoring'] = 1;
    $menu['triase'] = 0;
    $menu['apgar'] = 0;
    $menu['skrininggizi'] = 1;
    $menu['adl'] = 0;
    $menu['dekubitus'] = 1;
    $menu['stabilitas'] = 0;
    $menu['edukasiintegrasi'] = 0;
    $menu['formedukasi'] = 0;
    $menu['gcs'] = 1;
    $menu['integumen'] = 1;
    $menu['anak'] = 1;
    $menu['neonatus'] = 1;
    $menu['neurosensoris'] = 1;
    $menu['pencernaan'] = 1;
    $menu['pernapasan'] = 1;
    $menu['perkemihan'] = 1;
    $menu['psikologi'] = 1;
    $menu['sirkulasi'] = 1;
    $menu['seksual'] = 1;
    $menu['social'] = 1;
    $menu['tht'] = 1;
    $menu['tidur'] = 1;
}
?>

<style>
    table.table-fit {
        width: auto !important;
        table-layout: auto !important;
    }

    table.table-fit thead th,
    table.table-fit tfoot th {
        width: auto !important;
    }

    table.table-fit tbody td,
    table.table-fit tfoot td {
        width: auto !important;
    }
</style>
<div class="tab-pane" id="assessmentigd" role="tabpanel">
    <!-- <div class="tab-pane <?= isset($group[13]) || isset($group[1]) ? 'active' : '' ?>" id="assessmentigd" role="tabpanel"> -->
    <div class="row">
        <div id="loadContentAssessmentPerawat" class="col-12 center-spinner"></div>
        <div id="contentAssessmentPerawat" class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div><!--./col-lg-6-->
            <div class="col-lg-10 col-md-10 col-sm-12 mt-4">
                <div id="arpAddDocument" class="box-tab-tools text-center">
                    <a data-toggle="modal" onclick="initialAddArp()" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                </div>
                <h3>Histori Assessmen Keperawatan</h3>
                <table class="table table-striped table-hover">
                    <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th></th>
                            <th>Tanggal</th>
                            <th>Klinik/Poli</th>
                            <th class="text-center" style="width: 20%;">Subyektif</th class="text-center">
                            <th class="text-center" style="width: 20%;">Obyektif</th class="text-center">
                            <th class="text-center" style="width: 20%;">Asesmen</th class="text-center">
                            <th class="text-center" style="width: 20%;">Prosedur</th class="text-center">
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="assessmentKeperawatanHistoryBody">
                        <?php
                        $total = 0;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--./row-->

</div>
<!-- -->

<div class="modal fade" id="addEducationListPlan" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Tambah List Perencanaan Edukasi</h3>
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <form id="formEducationIntegrationPlan" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">

                    <input name="body_id" id="eduplanbody_id" type="hidden" class="form-control" />
                    <input name="plan_ke" id="eduplanplan_ke" type="hidden" class="form-control" />
                    <input name="p_type" id="eduplanp_type" type="hidden" class="form-control" />


                    <div class="row">
                        <!-- <div class="col-sm-12">
                            <div class="box-header border-b mb-10 pl-0 pt0">
                                <div class="row">

                                </div>
                            </div>
                        </div> -->
                        <hr>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <div class="form-group"><label for="employee_id">Materi Edukasi</label>
                                    <div class="row p-3">
                                        <div class="col-md-6 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_material" id="eduplaneducation_material1" checked="" value="1">
                                            <label class="form-check-label" for="eduplaneducation_material1">
                                                Pilih Material
                                            </label>
                                        </div>
                                        <div class=" col-md-6 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_material" id="eduplaneducation_material2" checked="" value="2">
                                            <label class="form-check-label" for="eduplaneducation_material2">
                                                Tulis Bebas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group"><label>Judul Edukasi</label>
                                    <select type="text" name="treatment_type" id="eduplantreatment_type" placeholder="" value="" class="form-control">
                                        <option value="0491501">Hak dan Kewajiban pasien</option>
                                        <option value="0491502">Diagnosa, Tanda dan Gejala</option>
                                        <option value="0491503">Diet</option>
                                        <option value="0491504">Obat-obat yang didapat</option>
                                        <option value="0491505">Penggunaan alat medis yang aman dan efektif</option>
                                        <option value="0491506">Rehabilitasi Medik</option>
                                        <option value="0491507">Manajemen Nyeri</option>
                                        <option value="0491508">Pencegahan dan pengendalian infeksi</option>
                                        <option value="0491509">Lain-lain</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-2"><label>Taggal Edukasi</label><input type="datetime-local" name="examination_date" id="eduplanexamination_date" placeholder="" value="" class="form-control"></div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group"><label for="employee_id">Pemberian Edukasi</label>
                                    <div class="row p-3">
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provisionPerawat" checked="" value="1">
                                            <label class="form-check-label" for="eduplaneducation_provisionPerawat">
                                                Perawat
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provisionDokter" checked="" value="2">
                                            <label class="form-check-label" for="eduplaneducation_provisionDokter">
                                                Dokter
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provisionAhliGizi" checked="" value="3">
                                            <label class="form-check-label" for="eduplaneducation_provisionAhliGizi">
                                                Ahli Gizi
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provisionTerapis" checked="" value="4">
                                            <label class="form-check-label" for="eduplaneducation_provisionTerapis">
                                                Terapis
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provisionBidan" checked="" value="5">
                                            <label class="form-check-label" for="eduplaneducation_provisionBidan">
                                                Bidan
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaeducation_provisionnLainlain" checked="" value="6">
                                            <label class="form-check-label" for="eduplaeducation_provisionnLainlain">
                                                Lain-lain
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label for="employee_id">Sasaran Edukasi</label>
                                    <div class="row p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_target" id="eduplaneducation_target1" checked="" value="1">
                                            <label class="form-check-label" for="eduplaneducation_target1">
                                                Pasien
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_target" id="eduplaneducation_target2" checked="" value="2">
                                            <label class="form-check-label" for="eduplaneducation_target2">
                                                Dokter
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_target" id="eduplaneducation_target3" checked="" value="3">
                                            <label class="form-check-label" for="eduplaneducation_target3">
                                                Ahli Gizi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label for="employee_id">Metode Edukasi</label>
                                    <div class="row p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" value="1" id="eduplaneducation_methodLeaflet" checked="">
                                            <label class="form-check-label" for="eduplaneducation_methodLeaflet">
                                                Leaflet
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" value="2" id="eduplaneducation_methodDemonstrasi" checked="">
                                            <label class="form-check-label" for="eduplaneducation_methodDemonstrasi">
                                                Demonstrasi
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" value="3" id="eduplaneducation_methodWawancara" checked="">
                                            <label class="form-check-label" for="eduplaneducation_methodWawancara">
                                                Wawancara
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-2"><label>Penjelasan Metode Evaluasi</label><input type="text" name="EDUCATION_EVALUATION" id="eduplaneducation_evaluation" placeholder="" value="" class="form-control" onfocus="this.value=''"></div>
                            </div>
                        </div>
                    </div><!--./row-->
                    <div class="pull-right">
                        <button type="button" id="formEducationIntegrationPlanBtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-primary" onclick="saveEducationIntegrationPlan()"><?php echo lang('Word.save'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEducationListProvision" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <form id="formEducationIntegrationProvision" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">

                    <input name="body_id" id="eduprovbody_id" type="hidden" class="form-control" />
                    <input name="provision_ke" id="eduprovprovision_ke" type="hidden" class="form-control" />
                    <input name="p_type" id="eduprovp_type" type="hidden" class="form-control" />


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-header border-b mb-10 pl-0 pt0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Tambah List Perencanaan Edukasi</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <div class="form-group"><label for="">Materi Edukasi</label>
                                    <div class="row p-3">
                                        <div class="col-md-6 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_material" id="eduproveducation_material1" checked="" value="1">
                                            <label class="form-check-label" for="eduproveducation_material1">
                                                Pilih Material
                                            </label>
                                        </div>
                                        <div class=" col-md-6 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_material" id="eduproveducation_material2" checked="" value="2">
                                            <label class="form-check-label" for="eduproveducation_material2">
                                                Tulis Bebas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group"><label>Judul Edukasi</label>
                                    <select type="text" name="treatment_type" id="eduprovtreatment_type" placeholder="" value="" class="form-control">
                                        <option value="1">Pengertian penyakit</option>
                                        <option value="2">Gizi</option>
                                        <option value="3">Farmasi</option>
                                        <option value="4">Rehabilitasi Medik</option>
                                        <option value="5">Nyeri dan Manajemen Nyeri</option>
                                        <option value="6">Pencegahan dan Pengendalian Infeksi</option>
                                        <option value="7">Pelayanan Saat Pelayanan di RS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-2">
                                    <label>Deskripsi Edukasi</label>
                                    <textarea type="datetime-local" name="education_desc" id="eduproveducation_desc" placeholder="" value="" class="form-control">
                                        </textarea>
                                </div>
                                <script>
                                    $(function() {
                                        initializeQuillEditorsById("eduproveducation_desc")
                                    })
                                </script>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group"><label for="">Tingkat Pemahaman Awal</label>
                                    <div class="row p-3">
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="understanding_level" id="eduprovunderstanding_level1" checked="" value="1">
                                            <label class="form-check-label" for="eduprovunderstanding_level1">
                                                Sudah Mengerti
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="understanding_level" id="eduprovunderstanding_level2" checked="" value="2">
                                            <label class="form-check-label" for="eduprovunderstanding_level2">
                                                Edukasi Ulang
                                            </label>
                                        </div>
                                        <div class="col-md-2 form-check mb-3">
                                            <input class="form-check-input" type="radio" name="understanding_level" id="eduprovunderstanding_level3" checked="" value="3">
                                            <label class="form-check-label" for="eduprovunderstanding_level3">
                                                Hal Baru
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-2">
                                    <label>Assessment Ulang</label>
                                    <input type="checkbox" name="re_assessment" id="eduprovre_assessment" placeholder="" value="" class="form-check-input">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-2">
                                    <label>Tanggal/Jam Edukasi</label>
                                    <input type="datetime-local" name="examination_date" id="eduprovexamination_date" placeholder="" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label for="employee_id">Metode Edukasi</label>
                                    <div class="row p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" id="eduproveducation_method1" checked="" value="1">
                                            <label class="form-check-label" for="eduproveducation_method1">
                                                Leaflet
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" id="eduproveducation_method2" checked="" value="2">
                                            <label class="form-check-label" for="eduproveducation_method2">
                                                Demonstrasi
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="education_method" id="eduproveducation_method3" checked="" value="3">
                                            <label class="form-check-label" for="eduproveducation_method3">
                                                Wawancara
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label for="employee_id">Evaluasi/Verifikasi</label>
                                    <div class="row p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="evaluation" id="eduprovevaluation1" checked="" value="1">
                                            <label class="form-check-label" for="eduprovevaluation1">
                                                Sudah Mengerti
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="evaluation" id="eduprovevaluation2" checked="" value="2">
                                            <label class="form-check-label" for="eduprovevaluation2">
                                                Re-Edukasi
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="evaluation" id="eduprovevaluation3" checked="" value="3">
                                            <label class="form-check-label" for="eduprovevaluation3">
                                                Re-Demo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-2">
                                    <label>Tgl Reedukasi</label>
                                    <input type="datetime-local" name="reevaluation_date" id="eduprovreevaluation_date" placeholder="" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label for="">Re-evaluasi</label>
                                    <div class="row p-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="re_evaluation" id="eduprovre_evaluation1" checked="" value="1">
                                            <label class="form-check-label" for="eduprovre_evaluation1">
                                                Leaflet
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="re_evaluation" id="eduprovre_evaluation2" checked="" value="2">
                                            <label class="form-check-label" for="eduprovre_evaluation2">
                                                Demonstrasi
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="re_evaluation" id="eduprovre_evaluation3" checked="" value="3">
                                            <label class="form-check-label" for="eduprovre_evaluation3">
                                                Wawancara
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-2"><label>Lama Edukasi</label><input type="text" name="education_duration" id="eduproveducation_duration" placeholder="" value="" class="form-control" onfocus="this.value=''"></div>
                            </div>
                        </div>
                    </div><!--./row-->
                    <div class="pull-right">
                        <button type="button" id="formEducationIntegrationProvisionBtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-primary" onclick="saveEducationIntegrationProvision()"><?php echo lang('Word.save'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="arpModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 id="arpTitle">Assessment Keperawatan</h3>
                            <!-- <h3 id="armTitle">ASESMEN MEDIS INSTALASI GAWAT DARURAT</h3> -->
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <div id="arpDocument" class="card border-1 rounded-4 p-4" style="display: none">
                    <form id="formaddarp" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <div class="card-body">
                            <input type="hidden" id="arpbody_id" name="body_id">
                            <input type="hidden" id="arporg_unit_code" name="org_unit_code">
                            <input type="hidden" id="arppasien_diagnosa_id" name="pasien_diagnosa_id">
                            <!-- <input type="hidden" id="arpdiagnosa_id" name="diagnosa_id"> -->
                            <input type="hidden" id="arpno_registration" name="no_registration">
                            <input type="hidden" id="arpvisit_id" name="visit_id">
                            <input type="hidden" id="arptrans_id" name="trans_id" value="<?= $visit['trans_id']; ?>">
                            <input type="hidden" id="arpbill_id" name="bill_id">
                            <input type="hidden" id="arpclass_room_id" name="class_room_id">
                            <input type="hidden" id="arpbed_id" name="bed_id">
                            <input type="hidden" id="arpin_date" name="in_date">
                            <input type="hidden" id="arpexit_date" name="exit_date">
                            <input type="hidden" id="arpkeluar_id" name="keluar_id">
                            <input type="hidden" id="arpimt_score" name="imt_score">
                            <input type="hidden" id="arpimt_desc" name="imt_desc">
                            <input type="hidden" id="arpalo_anamnase" name="alo_anamnase">
                            <input type="hidden" id="arpteraphy_desc" name="teraphy_desc">
                            <input type="hidden" id="arpinstruction" name="instruction">
                            <input type="hidden" id="arpmedical_treatment" name="medical_treatment">
                            <input type="hidden" id="arpmodified_date" name="modified_date">
                            <input type="hidden" id="arpmodified_by" name="modified_by">
                            <input type="hidden" id="arpmodified_from" name="modified_from">
                            <input type="hidden" id="arpstatus_pasien_id" name="status_pasien_id">
                            <input type="hidden" id="arpageyear" name="ageyear">
                            <input type="hidden" id="arpagemonth" name="agemonth">
                            <input type="hidden" id="arpageday" name="ageday">
                            <input type="hidden" id="arpthename" name="thename">
                            <input type="hidden" id="arptheaddress" name="theaddress">
                            <input type="hidden" id="arptheid" name="theid">
                            <input type="hidden" id="arpisrj" name="isrj">
                            <input type="hidden" id="arpgender" name="gender">
                            <input type="hidden" id="arpdoctor" name="doctor">
                            <input type="hidden" id="arpkal_id" name="kal_id">
                            <input type="hidden" id="arppetugas_id" name="petugas_id">
                            <input type="hidden" id="arppetugas" name="petugas">
                            <input type="hidden" id="arpaccount_id" name="account_id">
                            <input type="hidden" id="arpkesadaran" name="kesadaran">
                            <input type="hidden" id="arpisvalid" name="isvalid">
                            <input type="hidden" id="arpvalid_date" name="valid_date" class="valid_date" value="">
                            <input type="hidden" id="arpvalid_user" name="valid_user" class="valid_user" value="">
                            <?php csrf_field(); ?>
                            <div class="row">
                                <hr>
                                <div class="col-md-12">
                                    <div class="dividerhr"></div>
                                </div><!--./col-md-12-->
                                <div class="row">
                                    <div class="col-sm-2 col-xs-12">
                                        <h5 class="font-size-14 mb-4 badge bg-primary">Dokumen Assessment:</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if ($visit['specialist_type_id'] == '1.05') {
                                    ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-check mb-3"><input onclick="filterVsStatusId(this.value)" class="form-check-input" type="radio" name="vs_status_id" id="arpvs_status_id10" value="10"><label class="form-check-label" for="arpvs_status_id10">Obsetric</label></div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-check mb-3"><input onclick="filterVsStatusId(this.value)" class="form-check-input" type="radio" name="vs_status_id" id="arpvs_status_id1" value="1"><label class="form-check-label" for="arpvs_status_id1" checked>Dewasa</label></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-check mb-3"><input onclick="filterVsStatusId(this.value)" class="form-check-input" type="radio" name="vs_status_id" id="arpvs_status_id4" value="4"><label class="form-check-label" for="arpvs_status_id4">Anak</label></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-check mb-3"><input onclick="filterVsStatusId(this.value)" class="form-check-input" type="radio" name="vs_status_id" id="arpvs_status_id5" value="5"><label class="form-check-label" for="arpvs_status_id5">Neonatus</label></div>
                                        </div>
                                    <?php
                                    } ?>
                                    <!-- <div class="col-md-3">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="acpptvs_status_id2" value="2"><label class="form-check-label" for="acpptvs_status_id2" checked>SOAP</label></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="acpptvs_status_id7" value="7"><label class="form-check-label" for="acpptvs_status_id7">SBAR</label></div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arpexamination_date">Tanggal Assessmennt</label>
                                                <input id="flatarpexamination_date" type="hidden" class="form-control datetimeflatpickr" />
                                                <input name="examination_date" id="arpexamination_date" type="hidden" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arpclinic_id">Poli</label>
                                                <select name="clinic_id" id="arpclinic_id" type="hidden" class="form-control ">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arpemployee_id">Dokter</label>
                                                <select name="employee_id" id="arpemployee_id" type="hidden" class="form-control ">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 id="subjectiveGroupHeader">S:</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 mt-2 mb-4">
                                        <div class="form-group"><label id="arpanamnase_label">Keluhan Utama</label>
                                            <textarea name="anamnase" id="arpanamnase" placeholder="" value="" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion mb-4" id="accodrionRiwayatARP">
                                    <div class="accordion-item">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="arpheadingRiwayatARP">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#arpcollapseRiwayatARP" aria-expanded="false" aria-controls="arpcollapseRiwayatARP">
                                                    <b>RIWAYAT PASIEN</b>
                                                </button>
                                            </h2>
                                            <div id="arpcollapseRiwayatARP" class="accordion-collapse collapse" aria-labelledby="arpheadingRiwayatARP" data-bs-parent="#accodrionExamInfo" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row mb-4">
                                                        <div id="groupRiwayat" class="row">
                                                            <div class="col-sm-12 col-xs-12">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label for="arpdescription">Riwayat Penyakit Sekarang</label>
                                                                        <textarea id="arpdescription" name="description" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php if ($visit['specialist_type_id'] == '1.05') {
                                                            ?>
                                                                <?php foreach ($aValue as $key => $value) {
                                                                    if ($value['p_type'] == 'GEN0009' && $value['parameter_id'] == '06') {
                                                                        if ($value['value_score'] == '4') {
                                                                ?>
                                                                            <div class="col-sm-6 col-xs-12">
                                                                                <div class="mb-3">
                                                                                    <div class="form-group">
                                                                                        <label for="arp<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                                        <textarea id="arp<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                        } else if ($value['value_score'] == '2') {
                                                                        ?>
                                                                            <div class="col-sm-6 col-xs-12">
                                                                                <div class="form-check mb-3">
                                                                                    <input id="arp<?= $value['p_type'] . $value['value_id']; ?>" class="form-check-input" type="checkbox" name="<?= $value['value_id']; ?>" value="1">
                                                                                    <label class="form-check-label" for="arp<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                                </div>
                                                                            </div> <?php
                                                                                }
                                                                                    ?>
                                                                <?php
                                                                    }
                                                                } ?>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <?php foreach ($aValue as $key => $value) {
                                                                    if ($value['p_type'] == 'GEN0009') {
                                                                        if ($value['value_score'] == '4') {
                                                                ?>
                                                                            <div class="col-sm-6 col-xs-12">
                                                                                <div class="mb-3">
                                                                                    <div class="form-group">
                                                                                        <label for="arp<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                                        <textarea id="arp<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                        } else if ($value['value_score'] == '2') {
                                                                        ?>
                                                                            <div class="col-sm-6 col-xs-12">
                                                                                <div class="form-check mb-3">
                                                                                    <input id="arp<?= $value['p_type'] . $value['value_id']; ?>" class="form-check-input" type="checkbox" name="<?= $value['value_id']; ?>" value="1">
                                                                                    <label class="form-check-label" for="arp<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                                </div>
                                                                            </div> <?php
                                                                                }
                                                                                    ?>
                                                                <?php
                                                                    }
                                                                } ?>
                                                            <?php
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <h4 id="objectiveGroupHeader">O:</h4> -->
                                <div class="row mb-4" id="accodrionExamInfo">
                                    <div class="">
                                        <h5 class="" id="arpheadingVitalSign">
                                            <b>O:</b>
                                        </h5>
                                        <hr>
                                        <div id="arpcollapseVitalSign" class="col-12" aria-labelledby="" data-bs-parent="#accodrionExamInfo" style="">
                                            <div class=" text-muted">
                                                <div class="row">
                                                    <div class="row mb-4">
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Jenis EWS</label>
                                                                <select class="form-select" name="vs_status_id" id="arpvs_status_id" disabled="true" onchange="">
                                                                    <option value="" selected>-- pilih --</option>
                                                                    <option value="1">Dewasa</option>
                                                                    <option value="4">Anak</option>
                                                                    <option value="5">Neonatus</option>
                                                                    <option value="10">Obsetric</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>BB(Kg)</label>
                                                                <div class=" position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="weight" id="arpweight" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-bb"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Tinggi(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="height" id="arpheight" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arpheight"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Suhu(°C)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="temperature" id="arptemperature" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arptemperature"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                            <div class="form-group">
                                                                <label>Nadi(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="nadi" id="arpnadi" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arpnadi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="arptension_upper" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arptension_upper"></span>
                                                                    </div>
                                                                    <h4 class="mx-2">/</h4>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="arptension_below" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arptension_below"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Saturasi(SpO2%)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="arpsaturasi" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arpsaturasi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Nafas/RR(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="nafas" id="arpnafas" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arpnafas"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Diameter Lengan(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="arp_diameter" id="arparp_diameter" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arparp_diameter"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Penggunaan Oksigen (L/mnt)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="arpoxygen_usage" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arpoxygen_usage"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Kesadaran</label>
                                                                <select class="form-select" name="awareness" id="arpawareness" onchange="vitalsignInput(this)">
                                                                    <option value="0">Sadar</option>
                                                                    <option value="3">Nyeri</option>
                                                                    <option value="10">Unrespon</option>
                                                                </select>
                                                                <span class="h6" id="badge-arpawareness"></span>
                                                            </div>
                                                        </div>
                                                        <!--==new -->
                                                        <!--==endofnew -->
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="arppemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                    </div>
                                                    <span id="arptotal_score"></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4" id="accodrionExamInfo">
                                    <div class="">
                                        <h5 class="" id="arpheadingVitalSign">
                                            <b>A:</b>
                                        </h5>
                                        <hr>
                                        <div id="collapseDiagnosaPerawat" class="col-12" aria-labelledby="" data-bs-parent="#">
                                            <div class=" text-muted">
                                                <div class="row mb-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div class="mb-4">
                                                            <div class="staff-members">
                                                                <div class="table tablecustom-responsive">
                                                                    <table id="tableDiagnosaPerawatMedis" class="table" data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                                                        <?php if (true) { ?>
                                                                            <thead>
                                                                                <th class="text-center" colspan="2">DiagnosaPerawat</th>
                                                                            </thead>
                                                                            <tbody id="bodyDiagPerawat">
                                                                            </tbody>
                                                                        <?php }   ?>
                                                                    </table>
                                                                </div>
                                                                <div class="box-tab-tools" style="text-align: center;">
                                                                    <button type="button" name="addDiagnosaPerawat" onclick="addRowDiagPerawatBasic('bodyDiagPerawat', '', null, null, 'arpModal')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <h5 class="" id="headingSubyektif">
                                        <b id="cpptSubyektifTitle">P</b>
                                    </h5>
                                    <hr>
                                    <div id="" class="col-12" aria-labelledby="">
                                        <div class="text-muted">
                                            <div class="row">
                                                <div class="col-sm-12 mt-2">
                                                    <div class="form-group"><label id="acpptinstruction_label">Catatan Planning</label><textarea name="instruction" id="acpptinstruction" placeholder="" value="" class="form-control" row="4"></textarea></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-12 col-md-4 m-4">
                                        <div id="formaddarpqrcode1" class="qrcode-class"></div>
                                        <div id="formaddarpsigner1"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div><!--./col-md-12-->

                            </div>
                            <div class="accordion" id="accordionAssessmentAwal">
                                <?php foreach ($aParent as $key => $value) { ?>
                                    <?php if ($value['parent_id'] == '001' && $menu['fallrisk'] == 1) { ?>
                                        <div id="arpFallRisk_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="FallRiskPerawat">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFallRiskPerawat" aria-expanded="true" aria-controls="collapseFallRiskPerawat">
                                                    <b>RESIKO JATUH</b>
                                                </button>
                                            </h2>
                                            <div id="collapseFallRiskPerawat" class="accordion-collapse collapse" aria-labelledby="FallRiskPerawat" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <form id="formassessmentigd" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                                                            <div class="col-md-12">
                                                                <div id="bodyFallRiskPerawat">
                                                                </div>
                                                                <div id="bodyFallRiskPerawatAddBtn" class="col-md-12 text-center">
                                                                    <a onclick="addFallRisk(1, 0, 'arpbody_id', 'bodyFallRiskPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($value['parent_id'] == '002' && $menu['painmonitoring'] == 1) { ?>
                                        <div id="arpPainMonitoring_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="<?= $value['parent_id']; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['parent_id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['parent_id']; ?>">
                                                    <b><?= $value['parent_parameter']; ?></b>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <form id="formassessmentigd" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                                                            <div class="col-md-12">
                                                                <div id="bodyPainMonitoringPerawat">
                                                                </div>
                                                                <div id="bodyPainMonitoringPerawatAddBtn" class="col-md-12 text-center">
                                                                    <a onclick="addPainMonitoring(1, 0, 'arpbody_id', 'bodyPainMonitoringPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($value['parent_id'] == '004' && $menu['triase'] == 1) { ?>
                                        <div id="arpTriage_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="<?= $value['parent_id']; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['parent_id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['parent_id']; ?>">
                                                    <b><?= $value['parent_parameter']; ?></b>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyTriagePerawat">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="bodyTriagePerawatAddBtn" class="box-tab-tools text-center">
                                                                        <a onclick="addTriage(1,0,'arpbody_id', 'bodyTriagePerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($value['parent_id'] == '005' && $visit['specialist_type_id'] == "1.04" && $menu['apgar'] == 1) { ?>
                                        <div id="arpApgar_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="<?= $value['parent_id']; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['parent_id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['parent_id']; ?>">
                                                    <b><?= $value['parent_parameter']; ?></b>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyApgarPerawat">
                                                            </div>
                                                            <div id="bodyApgarPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addApgar(1, 0, 'arpbody_id', 'bodyApgarPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($value['parent_id'] == '006'  && $menu['skrininggizi'] == 1) {
                                    ?>
                                        <div id="arpGizi_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingGizi">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGizi" aria-expanded="false" aria-controls="collapseGizi">
                                                    <b>SKRINING GIZI</b>
                                                </button>
                                            </h2>
                                            <div id="collapseGizi" class="accordion-collapse collapse" aria-labelledby="headingGizi" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyGiziPerawat">
                                                            </div>
                                                            <div id="bodyGiziPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addGizi(1,1, 'arpbody_id','bodyGiziPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } ?>
                                <?php } ?>
                                <?php foreach ($aType as $key => $value) {
                                    if ($value['p_type'] == 'ASES016'  && $menu['adl'] == 1) {
                                ?>
                                        <div id="arpAdl_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingADL">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseADL" aria-expanded="false" aria-controls="collapseADL">
                                                    <b>AKTIVITAS DAN LATIHAN</b>
                                                </button>
                                            </h2>
                                            <div id="collapseADL" class="accordion-collapse collapse" aria-labelledby="headingADL" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyADLPerawat">
                                                            </div>
                                                            <div id="bodyADLPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addADL(1,1, 'arpbody_id','bodyADLPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES047' && $menu['dekubitus'] == 1) {
                                    ?>
                                        <div id="arpDekubitus_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingDekubitus">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDekubitus" aria-expanded="false" aria-controls="collapseDekubitus">
                                                    <b>DEKUBITUS</b>
                                                </button>
                                            </h2>
                                            <div id="collapseDekubitus" class="accordion-collapse collapse" aria-labelledby="headingDekubitus" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyDekubitusPerawat">
                                                            </div>
                                                            <div id="bodyDekubitusPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addDekubitus(1,1, 'arpbody_id','bodyDekubitusPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'GEN0012' && $menu['stabilitas'] == 1) {
                                    ?>
                                        <div id="arpStabilitas_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="<?= $value['p_type']; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['p_type']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['p_type']; ?>">
                                                    <b><?= $value['p_description']; ?></b>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $value['p_type']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['p_type']; ?>" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyStabilitasPerawat">
                                                            </div>
                                                            <div id="bodyStabilitasPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addDerajatStabilitas(1, 0, 'arpbody_id', 'bodyStabilitasPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES049' && $menu['edukasiintegrasi'] == 1) {
                                    ?>
                                        <div id="arpEdukasiIntegrasi_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingEducationIntegration">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEducationIntegration" aria-expanded="false" aria-controls="collapseEducationIntegration">
                                                    <b>EDUKASI INTEGRASI</b>
                                                </button>
                                            </h2>
                                            <div id="collapseEducationIntegration" class="accordion-collapse collapse" aria-labelledby="headingEducationIntegration" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyEducationIntegration">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addEducationIntegrationButton" class="box-tab-tools text-center">
                                                                        <a onclick="addEducationIntegration(1,0, 'arpbody_id','bodyEducationIntegration', false)" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'GEN0013' && $menu['formedukasi'] == 1) {
                                    ?>
                                        <div id="arpEdukasiForm_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingEducationForm">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEducationForm" aria-expanded="false" aria-controls="collapseEducationForm">
                                                    <b>FORMULIR PEMBERIAN EDUKASI</b>
                                                </button>
                                            </h2>
                                            <div id="collapseEducationForm" class="accordion-collapse collapse" aria-labelledby="headingEducationForm" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyEducationFormPerawat">
                                                            </div>
                                                            <div id="bodyEducationFormPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addEducationForm(1,1, 'arpbody_id','bodyEducationFormPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'GEN0011' && $menu['gcs'] == 1) {
                                    ?>
                                        <div id="arpGcs_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingGcs">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGcs" aria-expanded="false" aria-controls="collapseGcs">
                                                    <b>GLASGOW COMA SCALE (GCS)</b>
                                                </button>
                                            </h2>
                                            <div id="collapseGcs" class="accordion-collapse collapse" aria-labelledby="headingGcs" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyGcsPerawat">
                                                            </div>
                                                            <div id="bodyGcsPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addGcs(1,0,'arpbody_id', 'bodyGcsPerawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES036' && $menu['integumen'] == 1) {
                                    ?>
                                        <div id="arpIntegumen_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingIntegumen">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIntegumen" aria-expanded="false" aria-controls="collapseIntegumen">
                                                    <b>INTEGUMEN & MOSKULO SKELETAL</b>
                                                </button>
                                            </h2>
                                            <div id="collapseIntegumen" class="accordion-collapse collapse" aria-labelledby="headingIntegumen" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyIntegumenPerawat">
                                                            </div>
                                                            <div id="bodyIntegumenPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addIntegumen(1,1, 'arpbody_id','bodyIntegumenPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES045' && $visit['specialist_type_id'] == "1.04" && $menu['anak'] == 1) {
                                    ?>
                                        <div id="arpAnak_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingAnak">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAnak" aria-expanded="false" aria-controls="collapseAnak">
                                                    <b>KHUSUS ANAK</b>
                                                </button>
                                            </h2>
                                            <div id="collapseAnak" class="accordion-collapse collapse" aria-labelledby="headingAnak" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyAnakPerawat">
                                                            </div>
                                                            <div id="bodyAnakPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addAnak(1,1, 'arpbody_id','bodyAnakPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES050' && $visit['specialist_type_id'] == "1.04" && $menu['neonatus'] == 1) {
                                    ?>
                                        <div id="arpNeonatus_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingNeonatus">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNeonatus" aria-expanded="false" aria-controls="collapseNeonatus">
                                                    <b>NEONATUS</b>
                                                </button>
                                            </h2>
                                            <div id="collapseNeonatus" class="accordion-collapse collapse" aria-labelledby="headingNeonatus" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyNeonatusPerawat">
                                                            </div>
                                                            <div id="bodyNeonatusPerawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addNeonatus(1,1, 'arpbody_id','bodyNeonatusPerawat')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES038' && $menu['neurosensoris'] == 1) {
                                    ?>
                                        <div id="arpNeurosensoris_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingNeurosensoris">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNeurosensoris" aria-expanded="false" aria-controls="collapseNeurosensoris">
                                                    <b>NEUROSENSORIS</b>
                                                </button>
                                            </h2>
                                            <div id="collapseNeurosensoris" class="accordion-collapse collapse" aria-labelledby="headingNeurosensoris" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyNeurosensoris">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addNeurosensorisButton" class="box-tab-tools text-center">
                                                                        <a onclick="addNeurosensoris(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES040' && $menu['pencernaan'] == 1) {
                                    ?>
                                        <div id="arpPencernaan_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingPencernaan">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencernaan" aria-expanded="false" aria-controls="collapsePencernaan">
                                                    <b>PENCERNAAN</b>
                                                </button>
                                            </h2>
                                            <div id="collapsePencernaan" class="accordion-collapse collapse" aria-labelledby="headingPencernaan" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyPencernaan">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addPencernaanButton" class="box-tab-tools text-center">
                                                                        <a onclick="addPencernaan(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES042' && $menu['perkemihan'] == 1) {
                                    ?>
                                        <div id="arpPerkemihan_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingPerkemihan">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePerkemihan" aria-expanded="false" aria-controls="collapsePerkemihan">
                                                    <b>PERKEMIHAN</b>
                                                </button>
                                            </h2>
                                            <div id="collapsePerkemihan" class="accordion-collapse collapse" aria-labelledby="headingPerkemihan" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyPerkemihan">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addPerkemihanButton" class="box-tab-tools text-center">
                                                                        <a onclick="addPerkemihan(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES041' && $menu['pernapasan'] == 1) {
                                    ?>
                                        <div id="arpPernapasan_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingPernapasan">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePernapasan" aria-expanded="false" aria-controls="collapsePernapasan">
                                                    <b>PERNAPASAN</b>
                                                </button>
                                            </h2>
                                            <div id="collapsePernapasan" class="accordion-collapse collapse" aria-labelledby="headingPernapasan" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyPernapasan">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addPernapasanButton" class="box-tab-tools text-center">
                                                                        <a onclick="addPernapasan(1,0, 'arpbody_id', 'bodyPernapasan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES035' && $menu['psikologi'] == 1) {
                                    ?>
                                        <div id="arpPsikologi_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingPsikologi">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePsikologi" aria-expanded="false" aria-controls="collapsePsikologi">
                                                    <b>PSIKOLOGI SPIRITUAL</b>
                                                </button>
                                            </h2>
                                            <div id="collapsePsikologi" class="accordion-collapse collapse" aria-labelledby="headingPsikologi" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyPsikologi">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addPsikologiButton" class="box-tab-tools text-center">
                                                                        <a onclick="addPsikologi(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES043' && $menu['seksual'] == 1) {
                                    ?>
                                        <div id="arpSeksual_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingSeksual">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeksual" aria-expanded="false" aria-controls="collapseSeksual">
                                                    <b>SEKSUAL/REPRODUKSI</b>
                                                </button>
                                            </h2>
                                            <div id="collapseSeksual" class="accordion-collapse collapse" aria-labelledby="headingSeksual" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodySeksual">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addSeksualButton" class="box-tab-tools text-center">
                                                                        <a onclick="addSeksual(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES039' && $menu['sirkulasi'] == 1) {
                                    ?>
                                        <div id="arpSirkulasi_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingSirkulasi">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSirkulasi" aria-expanded="false" aria-controls="collapseSirkulasi">
                                                    <b>SIRKULASI</b>
                                                </button>
                                            </h2>
                                            <div id="collapseSirkulasi" class="accordion-collapse collapse" aria-labelledby="headingSirkulasi" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodySirkulasi">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addSirkulasiButton" class="box-tab-tools text-center">
                                                                        <a onclick="addSirkulasi(1,0,'arpbody_id', 'bodySirkulasi')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES037' && $menu['social'] == 1) {
                                    ?>
                                        <div id="arpSocial_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingSocial">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSocial" aria-expanded="false" aria-controls="collapseSocial">
                                                    <b>SOCIAL ECONOMY</b>
                                                </button>
                                            </h2>
                                            <div id="collapseSocial" class="accordion-collapse collapse" aria-labelledby="headingSocial" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodySocial">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addSocialButton" class="box-tab-tools text-center">
                                                                        <a onclick="addSocial(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES044' && $menu['tht'] == 1) {
                                    ?>
                                        <div id="arpHearing_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingHearing">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHearing" aria-expanded="false" aria-controls="collapseHearing">
                                                    <b>THT & MATA</b>
                                                </button>
                                            </h2>
                                            <div id="collapseHearing" class="accordion-collapse collapse" aria-labelledby="headingHearing" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyHearing">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addHearingButton" class="box-tab-tools text-center">
                                                                        <a onclick="addHearing(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES046' && $menu['tidur'] == 1) {
                                    ?>
                                        <div id="arpSleeping_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingSleeping">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSleeping" aria-expanded="false" aria-controls="collapseSleeping">
                                                    <b>TIDUR DAN ISTIRAHAT</b>
                                                </button>
                                            </h2>
                                            <div id="collapseSleeping" class="accordion-collapse collapse" aria-labelledby="headingSleeping" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodySleeping">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="addSleepingButton" class="box-tab-tools text-center">
                                                                        <a onclick="addSleeping(1,0)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } ?>
                                <!-- <div class="accordion-item">
                                    <h2 class="accordion-header" id="cetakprintKeperawatan">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseprintKeperawatan" aria-expanded="true" aria-controls="collapseprintKeperawatan">
                                            <b>CETAK KEPERAWATAN</b>
                                        </button>
                                    </h2>
                                    <div id="collapseprintKeperawatan" class="accordion-collapse collapse" aria-labelledby="printKeperawatan">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <ul id="keperawatanListLinkAll" class="list-group list-group-flush">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div><!--./col-md-12-->
                            <!-- <div class="panel-footer text-end mb-4">
                            <button type="button" id="formaddarpbtn" name="save" data-loading-text="Tambah" class="btn btn-info pull-right"><i class="fa fa-plus"></i> <span>Tambah</span></button>
                            <button type="button" id="formsavearpbtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="formeditarp" name="editrm" onclick="enableARP()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                            <button type="button" id="formsignarp" name="signrm" onclick="signArp()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                        </div> -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <?php if (user()->checkPermission("assessmentperawat", "c")) {
                ?>
                    <!-- <button type="button" id="formaddarpbtnid" name="add" data-loading-text="" class="btn btn-info pull-right formaddarpbtn"><i class="fa fa-plus"></i> <span>Tambah</span></button> -->
                <?php
                } ?>
                <?php if (user()->checkPermission("assessmentperawat", "c") || user()->checkPermission("assessmentperawat", "u")) {
                ?>
                    <button type="submit" id="formsavearpbtnid" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right formsavearpbtn"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                <?php
                } ?>
                <?php if (user()->checkPermission("assessmentperawat", "u")) {
                ?>
                    <button type="button" id="formeditarpid" name="editrm" onclick="enableARP()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right formeditarp"><i class="fa fa-edit"></i> <span>Edit</span></button>
                <?php
                } ?>
                <?php if (user()->checkPermission("assessmentperawat", "c")) {
                ?>
                    <button type="button" id="formsignarpid" name="signrm" onclick="signArp()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignarp"><i class="fa fa-signature"></i> <span>Sign</span></button>
                <?php
                } ?>
                <button type="button" id="formcetakarp" name="" onclick="cetakAssessmenKeperawatan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fas fa-file"></i> <span>Cetak</span></button>
            </div>
        </div>
    </div>
</div>