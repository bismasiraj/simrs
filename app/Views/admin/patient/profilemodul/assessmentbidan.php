<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
$group = user()->getRoles();

$menu['fallrisk'] = 1;
$menu['painmonitoring'] = 1;
$menu['triase'] = 1;
$menu['painmonitoring'] = 1;
$menu['apgar'] = 0;
$menu['skrininggizi'] = 0;
$menu['adl'] = 0;
$menu['dekubitus'] = 0;
$menu['stabilitas'] = 0;
$menu['edukasiintegrasi'] = 0;
$menu['formedukasi'] = 0;
$menu['gcs'] = 0;
$menu['integumen'] = 0;
$menu['anak'] = 0;
$menu['neonatus'] = 0;
$menu['neurosensoris'] = 0;
$menu['pencernaan'] = 0;
$menu['pernapasan'] = 0;
$menu['perkemihan'] = 0;
$menu['psikologi'] = 1;
$menu['sirkulasi'] = 0;
$menu['seksual'] = 0;
$menu['social'] = 0;
$menu['tht'] = 0;
$menu['tidur'] = 0;


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
    $menu['anak'] = 0; //?
    $menu['neonatus'] = 0; //?
    $menu['neurosensoris'] = 1;
    $menu['pencernaan'] = 0;
    $menu['pernapasan'] = 0;
    $menu['perkemihan'] = 1;
    $menu['psikologi'] = 0;
    $menu['sirkulasi'] = 1;
    $menu['seksual'] = 0;
    $menu['social'] = 0;
    $menu['tht'] = 0; //hearing
    $menu['tidur'] = 0;
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
<div class="tab-pane" id="assessmentbidan" role="tabpanel">
    <!-- <div class="tab-pane <?= isset($group[13]) || isset($group[1]) ? 'active' : '' ?>" id="assessmentbidan" role="tabpanel"> -->
    <div class="row">
        <div id="loadContentAssessmentBidan" class="col-12 center-spinner"></div>
        <div id="contentAssessmentBidan" class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div><!--./col-lg-6-->
            <div class="col-lg-10 col-md-10 col-sm-12 mt-4">
                <div id="arbAddDocument" class="box-tab-tools text-center">
                    <a data-toggle="modal" onclick="initialAddArb()" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                </div>
                <h3>Histori Assessmen Kebidanan</h3>
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
                    <tbody id="assessmentKebidananHistoryBody">
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
                                            <input class="form-check-input" type="radio" name="education_provision" id="eduplaneducation_provisionBidan" checked="" value="1">
                                            <label class="form-check-label" for="eduplaneducation_provisionBidan">
                                                Bidan
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


<div class="modal fade" id="arbModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 id="arbTitle">Assessment Kebidanan</h3>
                            <!-- <h3 id="armTitle">ASESMEN MEDIS INSTALASI GAWAT DARURAT</h3> -->
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <div id="arbDocument" class="card border-1 rounded-4 p-4" style="display: none">
                    <form id="formaddarb" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <div class="card-body">
                            <input type="hidden" id="arbbody_id" name="body_id">
                            <input type="hidden" id="arborg_unit_code" name="org_unit_code">
                            <input type="hidden" id="arbpasien_diagnosa_id" name="pasien_diagnosa_id">
                            <!-- <input type="hidden" id="arbdiagnosa_id" name="diagnosa_id"> -->
                            <input type="hidden" id="arbno_registration" name="no_registration">
                            <input type="hidden" id="arbvisit_id" name="visit_id">
                            <input type="hidden" id="arbtrans_id" name="trans_id" value="<?= $visit['trans_id']; ?>">
                            <input type="hidden" id="arbbill_id" name="bill_id">
                            <input type="hidden" id="arbclass_room_id" name="class_room_id">
                            <input type="hidden" id="arbbed_id" name="bed_id">
                            <input type="hidden" id="arbin_date" name="in_date">
                            <input type="hidden" id="arbexit_date" name="exit_date">
                            <input type="hidden" id="arbkeluar_id" name="keluar_id">
                            <input type="hidden" id="arbimt_score" name="imt_score">
                            <input type="hidden" id="arbimt_desc" name="imt_desc">
                            <input type="hidden" id="arbalo_anamnase" name="alo_anamnase">
                            <!-- <input type="hidden" id="arbteraphy_desc" name="teraphy_desc"> -->
                            <input type="hidden" id="arbinstruction" name="instruction">
                            <input type="hidden" id="arbmedical_treatment" name="medical_treatment">
                            <input type="hidden" id="arbmodified_date" name="modified_date">
                            <input type="hidden" id="arbmodified_by" name="modified_by">
                            <input type="hidden" id="arbmodified_from" name="modified_from">
                            <input type="hidden" id="arbstatus_pasien_id" name="status_pasien_id">
                            <input type="hidden" id="arbageyear" name="ageyear">
                            <input type="hidden" id="arbagemonth" name="agemonth">
                            <input type="hidden" id="arbageday" name="ageday">
                            <input type="hidden" id="arbthename" name="thename">
                            <input type="hidden" id="arbtheaddress" name="theaddress">
                            <input type="hidden" id="arbtheid" name="theid">
                            <input type="hidden" id="arbisrj" name="isrj">
                            <input type="hidden" id="arbgender" name="gender">
                            <input type="hidden" id="arbdoctor" name="doctor">
                            <input type="hidden" id="arbkal_id" name="kal_id">
                            <input type="hidden" id="arbpetugas_id" name="petugas_id">
                            <input type="hidden" id="arbpetugas" name="petugas">
                            <input type="hidden" id="arbaccount_id" name="account_id">
                            <input type="hidden" id="arbkesadaran" name="kesadaran">
                            <input type="hidden" id="arbisvalid" name="isvalid">
                            <input type="hidden" id="arbvalid_date" name="valid_date" class="valid_date" value="">
                            <input type="hidden" id="arbvalid_user" name="valid_user" class="valid_user" value="">
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
                                            <div class="form-check mb-3"><input onclick="filterVsStatusIdBidan(this.value)" class="form-check-input" type="radio" name="vs_status_id" id="arbvs_status_id10" value="10"><label class="form-check-label" for="arbvs_status_id10">Obsetric</label></div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-check mb-3"><input onclick="filterVsStatusIdBidan(this.value)" class="form-check-input" type="radio" name="vs_status_id" id="arbvs_status_id1" value="1"><label class="form-check-label" for="arbvs_status_id1" checked>Dewasa</label></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-check mb-3"><input onclick="filterVsStatusIdBidan(this.value)" class="form-check-input" type="radio" name="vs_status_id" id="arbvs_status_id4" value="4"><label class="form-check-label" for="arbvs_status_id4">Anak</label></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-check mb-3"><input onclick="filterVsStatusIdBidan(this.value)" class="form-check-input" type="radio" name="vs_status_id" id="arbvs_status_id5" value="5"><label class="form-check-label" for="arbvs_status_id5">Neonatus</label></div>
                                        </div>
                                    <?php
                                    } ?>
                                    <!-- <div class="col-md-3">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="arbvs_status_id2" value="2"><label class="form-check-label" for="arbvs_status_id2" checked>SOAP</label></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check mb-3"><input class="form-check-input" type="radio" name="vs_status_id" id="arbvs_status_id7" value="7"><label class="form-check-label" for="arbvs_status_id7">SBAR</label></div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arbexamination_date">Tanggal Assessmennt</label>
                                                <input id="flatarbexamination_date" type="hidden" class="form-control datetimeflatpickr" />
                                                <input name="examination_date" id="arbexamination_date" type="hidden" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arbclinic_id">Poli</label>
                                                <select name="clinic_id" id="arbclinic_id" type="hidden" class="form-control ">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="arbemployee_id">Dokter</label>
                                                <select name="employee_id" id="arbemployee_id" type="hidden" class="form-control ">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 id="subjectiveGroupHeader">S:</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 mt-2 mb-4">
                                        <div class="form-group"><label id="arbanamnase_label">Keluhan Utama</label>
                                            <textarea name="anamnase" id="arbanamnase" placeholder="" value="" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion mb-4" id="accodrionRiwayatARB">
                                    <div class="accordion-item">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="arbheadingRiwayatARB">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#arbcollapseRiwayatARB" aria-expanded="false" aria-controls="arbcollapseRiwayatARB">
                                                    <b>RIWAYAT PASIEN</b>
                                                </button>
                                            </h2>
                                            <div id="arbcollapseRiwayatARB" class="accordion-collapse collapse" aria-labelledby="arbheadingRiwayatARB" data-bs-parent="#accodrionExamInfo" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row mb-4">
                                                        <div id="groupRiwayat" class="row">
                                                            <div class="col-sm-12 col-xs-12">
                                                                <div class="mb-3">
                                                                    <div class="form-group">
                                                                        <label for="arbdescription">Riwayat Penyakit Sekarang</label>
                                                                        <textarea id="arbdescription" name="description" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php foreach ($aValue as $key => $value) {
                                                                if ($value['p_type'] == 'GEN0009') {
                                                                    if ($value['value_score'] == '4') {
                                                            ?>
                                                                        <div class="col-sm-6 col-xs-12">
                                                                            <div class="mb-3">
                                                                                <div class="form-group">
                                                                                    <label for="arb<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                                    <textarea id="arb<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                    } else if ($value['value_score'] == '2') {
                                                                    ?>
                                                                        <div class="col-sm-6 col-xs-12">
                                                                            <div class="form-check mb-3">
                                                                                <input id="arb<?= $value['p_type'] . $value['value_id']; ?>" class="form-check-input" type="checkbox" name="<?= $value['value_id']; ?>" value="1">
                                                                                <label class="form-check-label" for="arb<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                            </div>
                                                                        </div> <?php
                                                                            }
                                                                                ?>
                                                            <?php
                                                                }
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($visit['specialist_type_id'] == '1.05') {
                                ?>
                                    <div class="accordion mb-4" id="accodrionRiwayatBidanARB">
                                        <div class="accordion-item">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="arbheadingRiwayatBidanARB">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#arbcollapseRiwayatBidanARB" aria-expanded="false" aria-controls="arbcollapseRiwayatBidanARB">
                                                        <b>RIWAYAT KEHAMILAN</b>
                                                    </button>
                                                </h2>
                                                <div id="arbcollapseRiwayatBidanARB" class="accordion-collapse collapse" aria-labelledby="arbheadingRiwayatBidanARB" data-bs-parent="#accodrionExamInfo" style="">
                                                    <div class="accordion-body text-muted">
                                                        <div class="row mb-4">
                                                            <div id="groupRiwayat" class="row">

                                                                <?php foreach ($aValue as $key => $value) {
                                                                    if ($value['p_type'] == 'GEN0009' && $value['parameter_id'] == '06') {
                                                                        if ($value['value_score'] == '4') {
                                                                ?>
                                                                            <div class="col-sm-6 col-xs-12">
                                                                                <div class="mb-3">
                                                                                    <div class="form-group">
                                                                                        <label for="arb<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                                        <textarea id="arb<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                        } else if ($value['value_score'] == '2') {
                                                                        ?>
                                                                            <div class="col-sm-6 col-xs-12">
                                                                                <div class="form-check mb-3">
                                                                                    <input id="arb<?= $value['p_type'] . $value['value_id']; ?>" class="form-check-input" type="checkbox" name="<?= $value['value_id']; ?>" value="1">
                                                                                    <label class="form-check-label" for="arb<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>
                                                                                </div>
                                                                            </div> <?php
                                                                                }
                                                                                    ?>
                                                                <?php
                                                                    }
                                                                } ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } ?>
                                <!-- <h4 id="objectiveGroupHeader">O:</h4> -->
                                <div class="row mb-4" id="accodrionExamInfo">
                                    <div class="">
                                        <h5 class="" id="arbheadingVitalSign">
                                            <b>O:</b>
                                        </h5>
                                        <hr>
                                        <div id="arbcollapseVitalSign" class="col-12" aria-labelledby="" data-bs-parent="#accodrionExamInfo" style="">
                                            <div class=" text-muted">
                                                <div class="row">
                                                    <div class="row mb-4">
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Jenis EWS</label>
                                                                <select class="form-select" name="vs_status_id" id="arbvs_status_id" disabled="true" onchange="">
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
                                                                    <input onchange="vitalsignInput(this)" type="text" name="weight" id="arbweight" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-bb"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Tinggi(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="height" id="arbheight" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arbheight"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Suhu(°C)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="temperature" id="arbtemperature" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arbtemperature"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                            <div class="form-group">
                                                                <label>Nadi(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="nadi" id="arbnadi" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arbnadi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="arbtension_upper" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arbtension_upper"></span>
                                                                    </div>
                                                                    <h4 class="mx-2">/</h4>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="arbtension_below" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-arbtension_below"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Saturasi(SpO2%)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="arbsaturasi" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arbsaturasi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Nafas/RR(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="nafas" id="arbnafas" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-arbnafas"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Kesadaran</label>
                                                                <select class="form-select" name="awareness" id="arbawareness" onchange="vitalsignInput(this)">
                                                                    <option value="0">Sadar</option>
                                                                    <option value="3">Nyeri</option>
                                                                    <option value="10">Unrespon</option>
                                                                </select>
                                                                <span class="h6" id="badge-arbawareness"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Nyeri</label>
                                                                <select class="form-select" name="pain" id="prslexampain" onchange="vitalsignInput(this)">
                                                                    <option value="0">Normal</option>
                                                                    <option value="3">Abnormal</option>
                                                                </select>
                                                                <span class="h6" id="badge-prslexampain"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Discharge/Lokia</label>
                                                                <select class="form-select" name="lochia" id="prslexamlochia" onchange="vitalsignInput(this)">
                                                                    <option value="0">Normal</option>
                                                                    <option value="3">Abnormal</option>
                                                                </select>
                                                                <span class="h6" id="badge-prslexamlokia"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Proteinuria (Perhari)</label>
                                                                <select class="form-select" name="proteinuria" id="prslexamproteinuria" onchange="vitalsignInput(this)">
                                                                    <option value="0">-</option>
                                                                    <option value="2">+</option>
                                                                    <option value="3">++</option>
                                                                </select>
                                                                <span class="h6" id="badge-prslexamproteinuria"></span>
                                                            </div>
                                                        </div>
                                                        <!--==new -->
                                                        <!--==endofnew -->
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="arbpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                    </div>
                                                    <span id="arbtotal_score"></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4" id="accodrionExamInfo">
                                    <div class="">
                                        <h5 class="" id="arbheadingVitalSign">
                                            <b>A:</b>
                                        </h5>
                                        <hr>
                                        <div id="" class="col-12" aria-labelledby="">
                                            <div class="text-muted">
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <div class="form-group"><label id="arbteraphy_desc_label">Diagnosa Bidan</label><textarea name="teraphy_desc" id="arbteraphy_desc" placeholder="" value="" class="form-control" row="4"></textarea></div>
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
                                                    <div class="form-group"><label id="arbinstruction_label">Catatan Planning</label><textarea name="instruction" id="arbinstruction" placeholder="" value="" class="form-control" row="4"></textarea></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-12 col-md-4 m-4">
                                        <div id="formaddarbqrcode1" class="qrcode-class"></div>
                                        <div id="formaddarbsigner1"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div><!--./col-md-12-->

                            </div>
                            <div class="accordion" id="accordionAssessmentAwal">
                                <?php foreach ($aParent as $key => $value) { ?>
                                    <?php if ($value['parent_id'] == '001' && $menu['fallrisk'] == 1) { ?>
                                        <div id="arbFallRisk_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="FallRiskBidan">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFallRiskBidan" aria-expanded="true" aria-controls="collapseFallRiskBidan">
                                                    <b>RESIKO JATUH</b>
                                                </button>
                                            </h2>
                                            <div id="collapseFallRiskBidan" class="accordion-collapse collapse" aria-labelledby="FallRiskBidan" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <form id="formassessmentbidan" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                                                            <div class="col-md-12">
                                                                <div id="bodyFallRiskBidan">
                                                                </div>
                                                                <div id="bodyFallRiskBidanAddBtn" class="col-md-12 text-center">
                                                                    <a onclick="addFallRisk(1, 0, 'arbbody_id', 'bodyFallRiskBidan', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($value['parent_id'] == '002' && $menu['painmonitoring'] == 1) { ?>
                                        <div id="arbPainMonitoring_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="<?= $value['parent_id']; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['parent_id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['parent_id']; ?>">
                                                    <b><?= $value['parent_parameter']; ?></b>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <form id="formassessmentbidan" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                                                            <div class="col-md-12">
                                                                <div id="bodyPainMonitoringBidan">
                                                                </div>
                                                                <div id="bodyPainMonitoringBidanAddBtn" class="col-md-12 text-center">
                                                                    <a onclick="addPainMonitoring(1, 0, 'arbbody_id', 'bodyPainMonitoringBidan', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($value['parent_id'] == '004' && $menu['triase'] == 1) { ?>
                                        <div id="arbTriage_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="<?= $value['parent_id']; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['parent_id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['parent_id']; ?>">
                                                    <b><?= $value['parent_parameter']; ?></b>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyTriageBidan">
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <div id="bodyTriageBidanAddBtn" class="box-tab-tools text-center">
                                                                        <a onclick="addTriage(1,0,'arbbody_id', 'bodyTriageBidan', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                        <div id="arbApgar_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="<?= $value['parent_id']; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['parent_id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['parent_id']; ?>">
                                                    <b><?= $value['parent_parameter']; ?></b>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $value['parent_id']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['parent_id']; ?>" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyApgarberawat">
                                                            </div>
                                                            <div id="bodyApgarberawatAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addApgar(1, 0, 'arbbody_id', 'bodyApgarberawat', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($value['parent_id'] == '006'  && $menu['skrininggizi'] == 1) {
                                    ?>
                                        <div id="arbGizi_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingGizi">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGizi" aria-expanded="false" aria-controls="collapseGizi">
                                                    <b>SKRINING GIZI</b>
                                                </button>
                                            </h2>
                                            <div id="collapseGizi" class="accordion-collapse collapse" aria-labelledby="headingGizi" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyGiziBidan">
                                                            </div>
                                                            <div id="bodyGiziBidanAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addGizi(1,1, 'arbbody_id','bodyGiziBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                        <div id="arbAdl_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingADL">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseADL" aria-expanded="false" aria-controls="collapseADL">
                                                    <b>AKTIVITAS DAN LATIHAN</b>
                                                </button>
                                            </h2>
                                            <div id="collapseADL" class="accordion-collapse collapse" aria-labelledby="headingADL" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyADLBidan">
                                                            </div>
                                                            <div id="bodyADLBidanAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addADL(1,1, 'arbbody_id','bodyADLBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES047' && $menu['dekubitus'] == 1) {
                                    ?>
                                        <div id="arbDekubitus_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingDekubitus">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDekubitus" aria-expanded="false" aria-controls="collapseDekubitus">
                                                    <b>DEKUBITUS</b>
                                                </button>
                                            </h2>
                                            <div id="collapseDekubitus" class="accordion-collapse collapse" aria-labelledby="headingDekubitus" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyDekubitusBidan">
                                                            </div>
                                                            <div id="bodyDekubitusBidanAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addDekubitus(1,1, 'arbbody_id','bodyDekubitusBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'GEN0012' && $menu['stabilitas'] == 1) {
                                    ?>
                                        <div id="arbStabilitas_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="<?= $value['p_type']; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value['p_type']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['p_type']; ?>">
                                                    <b><?= $value['p_description']; ?></b>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $value['p_type']; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $value['p_type']; ?>" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyStabilitasBidan">
                                                            </div>
                                                            <div id="bodyStabilitasBidanAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addDerajatStabilitas(1, 0, 'arbbody_id', 'bodyStabilitasBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES049' && $menu['edukasiintegrasi'] == 1) {
                                    ?>
                                        <div id="arbEdukasiIntegrasi_Group" class="accordion-item">
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
                                                                        <a onclick="addEducationIntegration(1,0, 'arbbody_id','bodyEducationIntegration', false)" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                        <div id="arbEdukasiForm_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingEducationForm">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEducationForm" aria-expanded="false" aria-controls="collapseEducationForm">
                                                    <b>FORMULIR PEMBERIAN EDUKASI</b>
                                                </button>
                                            </h2>
                                            <div id="collapseEducationForm" class="accordion-collapse collapse" aria-labelledby="headingEducationForm" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyEducationFormBidan">
                                                            </div>
                                                            <div id="bodyEducationFormBidanAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addEducationForm(1,1, 'arbbody_id','bodyEducationFormBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'GEN0011' && $menu['gcs'] == 1) {
                                    ?>
                                        <div id="arbGcs_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingGcs">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGcs" aria-expanded="false" aria-controls="collapseGcs">
                                                    <b>GLASGOW COMA SCALE (GCS)</b>
                                                </button>
                                            </h2>
                                            <div id="collapseGcs" class="accordion-collapse collapse" aria-labelledby="headingGcs" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyGcsBidan">
                                                            </div>
                                                            <div id="bodyGcsBidanAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addGcs(1,0,'arbbody_id', 'bodyGcsBidan', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES036' && $menu['integumen'] == 1) {
                                    ?>
                                        <div id="arbIntegumen_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingIntegumen">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIntegumen" aria-expanded="false" aria-controls="collapseIntegumen">
                                                    <b>INTEGUMEN & MOSKULO SKELETAL</b>
                                                </button>
                                            </h2>
                                            <div id="collapseIntegumen" class="accordion-collapse collapse" aria-labelledby="headingIntegumen" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyIntegumenBidan">
                                                            </div>
                                                            <div id="bodyIntegumenBidanAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addIntegumen(1,1, 'arbbody_id','bodyIntegumenBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES045' && $visit['specialist_type_id'] == "1.04" && $menu['anak'] == 1) {
                                    ?>
                                        <div id="arbAnak_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingAnak">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAnak" aria-expanded="false" aria-controls="collapseAnak">
                                                    <b>KHUSUS ANAK</b>
                                                </button>
                                            </h2>
                                            <div id="collapseAnak" class="accordion-collapse collapse" aria-labelledby="headingAnak" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyAnakBidan">
                                                            </div>
                                                            <div id="bodyAnakBidanAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addAnak(1,1, 'arbbody_id','bodyAnakBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES050' && $visit['specialist_type_id'] == "1.04" && $menu['neonatus'] == 1) {
                                    ?>
                                        <div id="arbNeonatus_Group" class="accordion-item">
                                            <h2 class="accordion-header" id="headingNeonatus">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNeonatus" aria-expanded="false" aria-controls="collapseNeonatus">
                                                    <b>NEONATUS</b>
                                                </button>
                                            </h2>
                                            <div id="collapseNeonatus" class="accordion-collapse collapse" aria-labelledby="headingNeonatus" style="">
                                                <div class="accordion-body text-muted">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="bodyNeonatusBidan">
                                                            </div>
                                                            <div id="bodyNeonatusBidanAddBtn" class="col-md-12 text-center">
                                                                <a onclick="addNeonatus(1,1, 'arbbody_id','bodyNeonatusBidan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value['p_type'] == 'ASES038' && $menu['neurosensoris'] == 1) {
                                    ?>
                                        <div id="arbNeurosensoris_Group" class="accordion-item">
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
                                        <div id="arbPencernaan_Group" class="accordion-item">
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
                                        <div id="arbPerkemihan_Group" class="accordion-item">
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
                                        <div id="arbPernapasan_Group" class="accordion-item">
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
                                                                        <a onclick="addPernapasan(1,0, 'arbbody_id', 'bodyPernapasan')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                        <div id="arbPsikologi_Group" class="accordion-item">
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
                                        <div id="arbSeksual_Group" class="accordion-item">
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
                                        <div id="arbSirkulasi_Group" class="accordion-item">
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
                                                                        <a onclick="addSirkulasi(1,0,'arbbody_id', 'bodySirkulasi')" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
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
                                        <div id="arbSocial_Group" class="accordion-item">
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
                                        <div id="arbHearing_Group" class="accordion-item">
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
                                        <div id="arbSleeping_Group" class="accordion-item">
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
                                    <h2 class="accordion-header" id="cetakprintKebidanan">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseprintKebidanan" aria-expanded="true" aria-controls="collapseprintKebidanan">
                                            <b>CETAK KEPERAWATAN</b>
                                        </button>
                                    </h2>
                                    <div id="collapseprintKebidanan" class="accordion-collapse collapse" aria-labelledby="printKebidanan">
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
                            <button type="button" id="formaddarbbtn" name="save" data-loading-text="Tambah" class="btn btn-info pull-right"><i class="fa fa-plus"></i> <span>Tambah</span></button>
                            <button type="button" id="formsavearbbtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="formeditarb" name="editrm" onclick="enableARB()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                            <button type="button" id="formsignarb" name="signrm" onclick="signArb()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                        </div> -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <?php if (user()->checkPermission("assessmentbidan", "c")) {
                ?>
                    <!-- <button type="button" id="formaddarbbtnid" name="add" data-loading-text="" class="btn btn-info pull-right formaddarbbtn"><i class="fa fa-plus"></i> <span>Tambah</span></button> -->
                <?php
                } ?>
                <?php if (user()->checkPermission("assessmentbidan", "c") || user()->checkPermission("assessmentbidan", "u")) {
                ?>
                    <button type="submit" id="formsavearbbtnid" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right formsavearbbtn"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                <?php
                } ?>
                <?php if (user()->checkPermission("assessmentbidan", "u")) {
                ?>
                    <button type="button" id="formeditarbid" name="editrm" onclick="enableARB()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right formeditarb"><i class="fa fa-edit"></i> <span>Edit</span></button>
                <?php
                } ?>
                <?php if (user()->checkPermission("assessmentbidan", "c")) {
                ?>
                    <button type="button" id="formsignarbid" name="signrm" onclick="signArb()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right formsignarb"><i class="fa fa-signature"></i> <span>Sign</span></button>
                <?php
                } ?>
                <button type="button" id="formcetakarb" name="" onclick="cetakAssessmenKebidanan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fas fa-file"></i> <span>Cetak</span></button>
            </div>
        </div>
    </div>
</div>