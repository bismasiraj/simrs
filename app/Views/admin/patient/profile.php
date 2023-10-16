<?php

$this->extend('layout/default', [
    'orgunit' => $orgunit,
    'img_time' => $img_time
]) ?>

<?php
$permissions = user()->getPermissions();
$pasienDiagnosa = array();
$pasienDiagnosaAll = array();
foreach ($pd as $key => $value) {
    if ($pd[$key]['visit_id'] == $visit['visit_id'] && $key == 0) {
        $pasienDiagnosa = $pd[$key];
    } else {
        $pasienDiagnosaAll[] = $pd[$key];
    }
}
// dd($pasienDiagnosaAll);
?>


<?php $this->section('content') ?>
<?php
$currency_symbol = 'Rp. ';
?>
<script src="<?php echo base_url('/') ?>backend/js/Chart.bundle.js"></script>
<script src="<?php echo base_url('/') ?>backend/js/utils.js"></script>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs navlistscroll">
                        <li><a href="#overview" data-toggle="tab" aria-expanded="true"><i class="fa fa-th"></i> Profil</a></li>
                        <li class="active"><a href="#rekammedis" data-toggle="tab" aria-expanded="true"><i class="fa fa-hospital-o"></i> Rekam Medis</a></li>
                        <?php if ($visit['isrj'] == '0') { ?>
                            <li><a href="#assessmentigd" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-md"></i> Assessment Awal</a></li>
                            <li><a href="#cppt" data-toggle="tab" aria-expanded="true"><i class="fa fa-book"></i> CPPT</a></li>
                        <?php } else { ?>
                            <li><a href="#vitalsign" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-md"></i> Vital Sign</a></li>
                        <?php } ?>
                        <li><a href="#charges" data-toggle="tab" aria-expanded="true"><i class="far fa-caret-square-down"></i> Tindakan</a></li>
                        <li><a href="#eresep" data-toggle="tab" aria-expanded="true"><i class="fas fa-prescription"></i> E-Resep</a></li>
                        <li><a href="#tindaklanjut" data-toggle="tab" aria-expanded="true"><i class="fas fa-prescription"></i> Tindak Lanjut</a></li>
                        <li><a href="#mrpasien" data-toggle="tab" aria-expanded="true"><i class="fas fa-file"></i> MR Pasien</a></li>
                        <li><a href="#lab" data-toggle="tab" aria-expanded="true"><i class="fas fa-microscope"></i>Laboratorium</a></li>
                        <li><a href="#rad" data-toggle="tab" aria-expanded="true"><i class="far fa-id-card"></i> Radiologi</a></li>
                        <li><a href="#klaim" data-toggle="tab" aria-expanded="true"><i class="far fa-id-card"></i> E-Klaim</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane tab-content-height" id="overview">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                                    <div class="box-header border-b mb10 pl-0 pt0">
                                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"><?= $visit['diantar_oleh']; ?> (<?= $visit['no_registration']; ?>)</h3>
                                        <?php
                                        if (isset($permissions['profilrekammedis']['c'])) {
                                            if ($permissions['profilrekammedis']['c'] == '1') { ?>
                                                <!-- <div class="box-tools">
                                                    <a data-toggle="modal" id="add" onclick="modalAddRm()" class="btn btn-primary btn-sm addpatient"><i class="fa fa-edit"></i> Isi Rekam Medis</a>
                                                </div> -->
                                        <?php }
                                        } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ptt10">

                                            <?php

                                            if ($visit['gender'] == '1') {
                                                $file = "uploads\images\profile_male.png";
                                            } else if ($visit['gender'] == '2') {
                                                $file = "uploads\images\profile_female.png";
                                            }

                                            ?>
                                            <img width="115" height="115" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url(); ?><?php echo $file ?>">

                                        </div><!--./col-lg-5-->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <table class="table tablecustom table-bordered mb0">
                                                <tr>
                                                    <td class="bolds"><?php echo lang('Word.age'); ?></td>
                                                    <td id="age"><?= $visit['age']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bolds">Alamat</td>
                                                    <td id="address"><?php echo $visit['visitor_address']; ?></td>
                                                </tr>

                                                <tr>
                                                    <td class="bolds">Dokter</td>
                                                    <td id="dokter"><?php echo $visit['fullname']; ?></td>
                                                </tr>
                                                <?php if (!is_null($visit['class_room_id'])) { ?>
                                                    <tr>
                                                        <td class="bolds">Tanggal Masuk</td>
                                                        <td id="visit_date"><?php echo $visit['visit_date']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bolds">Tanggal Keluar</td>
                                                        <td id="exit_date"><?php echo $visit['exit_date']; ?></td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td class="bolds">Tanggal</td>
                                                        <td id="visit_date"><?php echo $visit['visit_date']; ?></td>
                                                    </tr>
                                                <?php } ?>

                                                <tr>
                                                    <?php if (!is_null($visit['class_room_id'])) { ?>
                                                        <td class="bolds">Bangsal</td>
                                                        <td id="klinik"><?php echo ($visit['name_of_class']); ?></td>
                                                    <?php } else { ?>
                                                        <td class="bolds">Poli</td>
                                                        <td id="klinik"><?php echo $visit['name_of_clinic']; ?></td>
                                                    <?php } ?>
                                                </tr>


                                            </table>
                                        </div><!--./col-lg-7-->
                                    </div><!--./row-->


                                </div><!--./col-lg-6-->
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <?php
                                    if (!empty($pasienDiagnosa)) {
                                        // if (false) {
                                    ?>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Ringkasan Diagnosis:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmdescription"><?= $pasienDiagnosa['description']; ?></div>
                                            </li>
                                            <li>
                                                <div><?= $pasienDiagnosa['diagnosa_desc_05']; ?></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Riwayat Alergi:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmdiagnosa_desc_06"><?= $pasienDiagnosa['diagnosa_desc_06']; ?></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Anamnesis:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmanamnase"><?= $pasienDiagnosa['anamnase']; ?></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Periksa Fisik:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmpemeriksaan"><?= $pasienDiagnosa['pemeriksaan']; ?></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Periksa Lab:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmpemeriksaan_02"><?= $pasienDiagnosa['pemeriksaan_02']; ?></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Periksa RO:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmpemeriksaan_03"><?= $pasienDiagnosa['pemeriksaan_03']; ?></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Pemeriksaan Lain:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmpemeriksaan_05"><?= $pasienDiagnosa['pemeriksaan_05']; ?></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Terapi:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmteraphy_desc"><?= $pasienDiagnosa['teraphy_desc']; ?></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Instruksi:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rminstruction"><?= $pasienDiagnosa['instruction']; ?></div>
                                            </li>
                                        </ul>
                                    <?php
                                    } else { ?>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Ringkasan Diagnosis:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmdescription"></div>
                                            </li>
                                            <li>
                                                <div class="rmdiagnosa_desc_05"></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Riwayat Alergi:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmdiagnosa_desc_06"></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Anamnesis:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmanamnase"></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Periksa Fisik:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmpemeriksaan"></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Periksa Lab:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmpemeriksaan_02"></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Periksa RO:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmpemeriksaan_03"></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Pemeriksaan Lain:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmpemeriksaan_05"></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Terapi:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rmteraphy_desc"></div>
                                            </li>
                                        </ul>
                                        <hr class="hr-panel-heading hr-10">
                                        <p><b><i class="fa fa-tag"></i> Instruksi:</b></p>
                                        <ul>
                                            <li>
                                                <div class="rminstruction"></div>
                                            </li>
                                        </ul>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12">

                                    <div class="box-header border-b mb10 pl-0 pt0">
                                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Diagnosa ICD X</h3>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="staff-members">
                                                <div class="table tablecustom-responsive">
                                                    <table class="table tablecustom table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                                        <?php if (true) { ?>
                                                            <thead>
                                                                <th>No</th>
                                                                <th>Diagnosa ICD X</th>
                                                                <th>Jenis Kasus</th>
                                                                <th>Jenis Kasus</th>
                                                                <th>Kategori Diagnosis</th>
                                                            </thead>
                                                            <tbody id="bodyDiagShow">

                                                            </tbody>
                                                        <?php }   ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-header border-b mb10 pl-0 pt0">
                                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Riwayat Pemeriksaan Fisik</h3>
                                        <?php if (isset($permissions['profilexam']['c'])) {
                                            if ($permissions['profilexam']['c'] == '1' && false) { ?>
                                                <div class="box-tools">
                                                    <a data-toggle="modal" id="add" onclick="holdModal('addExamModal')" class="btn btn-primary btn-sm addpatient"><i class="fa fa-plus"></i> Tambah Pemeriksaan Fisik</a>
                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="box box-info">

                                                <div class="box-body">
                                                    <div class="chart">
                                                        <canvas id="medical-history-chart" height="300"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-lg-7-->
                                    </div>

                                    <div class="">
                                        <div class="">
                                            <div class="box-header mb10 pl-0">
                                                <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"></h3>
                                                <div class="pull-right">
                                                    <div class="editviewdelete-icon pt8">
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="add-edit-members"></a>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="staff-members">
                                                <div class="table tablecustom-responsive">
                                                    <table class="table tablecustom table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) . " - " . $visit['visit_id'] . lang('Word.opd_details'); ?>">
                                                        <?php if (true) { ?>
                                                            <thead>
                                                                <th>Tanggal</th>
                                                                <th>Berat</th>
                                                                <th>Suhu</th>
                                                                <th>Tinggi</th>
                                                                <th>Nadi</th>
                                                                <th>Tension</th>
                                                                <th>Saturasi</th>
                                                                <th>Nafas</th>
                                                                <th></th>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 0;

                                                                foreach ($exam as $key => $value) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= substr($exam[$key]['examination_date'], 0, 13); ?></td>
                                                                        <td><?= $exam[$key]['weight']; ?></td>
                                                                        <td><?= $exam[$key]['temperature']; ?></td>
                                                                        <td><?= $exam[$key]['height']; ?></td>
                                                                        <td><?= $exam[$key]['nadi']; ?></td>
                                                                        <td><?= $exam[$key]['tension_upper'] . ' / ' . $exam[$key]['tension_below']; ?></td>
                                                                        <td><?= $exam[$key]['saturasi']; ?></td>
                                                                        <td><?= $exam[$key]['nafas']; ?></td>
                                                                        <?php if (isset($permissions['profilexam']['u'])) {
                                                                            if ($permissions['profilexam']['u'] == '1') { ?>
                                                                                <td><a href='#' onclick='editExamFunc(<?= $key; ?>)' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-edit'></i></a></td>
                                                                        <?php }
                                                                        } ?>
                                                                    </tr>
                                                                <?php
                                                                }  ?>

                                                            </tbody>
                                                        <?php }   ?>
                                                    </table>
                                                </div>
                                            </div><!--./staff-members-->

                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="">
                                            <div class=" box-header mb10 pl-0">
                                                <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"></h3>
                                                <div class="pull-right">
                                                    <div class="editviewdelete-icon pt8">
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="add-edit-members"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--./row-->
                        </div><!--#/overview-->
                        <?php echo view('admin/patient/profilemodul/charges', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee
                        ]); ?>
                        <?php echo view('admin/patient/profilemodul/mrpasien', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee
                        ]); ?>
                        <?php echo view('admin/patient/profilemodul/radiologi', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee
                        ]); ?>
                        <?php echo view('admin/patient/profilemodul/lab', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee
                        ]); ?>
                        <?php if (isset($permissions['tindakanpoli']['c'])) {
                            if ($permissions['tindakanpoli']['c'] == '1') { ?>
                        <?php echo view('admin/patient/modal/addBill', [
                                    'title' => '',
                                    'orgunit' => $orgunit,
                                    // 'clinic' => $clinic,
                                    // 'dokter' => $dokter,
                                    // 'coverage' => $coverage,
                                    // 'status' => $status,
                                    // 'jenis' => $jenis,
                                    // 'kelas' => $kelas,
                                    // 'kalurahan' => $kalurahan,
                                    // 'kecamatan' => $kecamatan,
                                    // 'kota' => $kota,
                                    // 'prov' => $prov,
                                    'statusPasien' => $statusPasien,
                                    // 'payor' => $payor,
                                    // 'education' => $education,
                                    // 'marital' => $marital,
                                    // 'agama' => $agama,
                                    // 'job' => $job,
                                    // 'blood' => $blood,
                                    // 'family' => $family,
                                    // 'gender' => $gender,
                                    // 'way' => $way,
                                    'reason' => $reason,
                                    'isattended' => $isattended,
                                    'inasisPoli' => $inasisPoli,
                                    'inasisFaskes' => $inasisFaskes,
                                    // 'diagnosa' => $diagnosa,
                                    //'dpjp' => $dpjp,
                                    'visit' => $visit,
                                    'exam' => $exam,
                                    'pd' => $pasienDiagnosa,
                                    'suffer' => $suffer,
                                    'diagCat' => $diagCat,
                                    'employee' => $employee
                                ]);
                            }
                        } ?>
                        <?php echo view('admin/patient/profilemodul/prescription', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee
                        ]); ?>
                        <?php echo view('admin/patient/profilemodul/tindaklanjut', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee
                        ]); ?>
                        <?php echo view('admin/patient/profilemodul/rekammedis', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa
                        ]); ?>
                        <?php echo view('admin/patient/profilemodul/cppt', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa
                        ]); ?>
                        <?php echo view('admin/patient/profilemodul/assessmentigd', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa
                        ]); ?>
                        <?php echo view('admin/patient/profilemodul/vitalsign', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa
                        ]); ?>
                        <?php echo view('admin/patient/profilemodul/eklaim', [
                            'title' => '',
                            'orgunit' => $orgunit,
                            // 'clinic' => $clinic,
                            // 'dokter' => $dokter,
                            // 'coverage' => $coverage,
                            // 'status' => $status,
                            // 'jenis' => $jenis,
                            // 'kelas' => $kelas,
                            // 'kalurahan' => $kalurahan,
                            // 'kecamatan' => $kecamatan,
                            // 'kota' => $kota,
                            // 'prov' => $prov,
                            'statusPasien' => $statusPasien,
                            // 'payor' => $payor,
                            // 'education' => $education,
                            // 'marital' => $marital,
                            // 'agama' => $agama,
                            // 'job' => $job,
                            // 'blood' => $blood,
                            // 'family' => $family,
                            // 'gender' => $gender,
                            // 'way' => $way,
                            'reason' => $reason,
                            'isattended' => $isattended,
                            'inasisPoli' => $inasisPoli,
                            'inasisFaskes' => $inasisFaskes,
                            // 'diagnosa' => $diagnosa,
                            //'dpjp' => $dpjp,
                            'visit' => $visit,
                            'exam' => $exam,
                            'pd' => $pasienDiagnosa,
                            'suffer' => $suffer,
                            'diagCat' => $diagCat,
                            'employee' => $employee,
                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                            'pasienDiagnosa' => $pasienDiagnosa
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="modal-chkstatus" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog modal-lg">
        <form id="form-chkstatus" action="" method="POST">
            <div class="modal-content">
                <div class="">
                    <button type="button" class="close modalclosezoom" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="zoom_details">
                </div>
            </div>
        </form>
    </div>
</div>


<script src="<?php echo base_url(); ?>uploads\custom\patient\profile.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        getAlergi(<?= $visit['no_registration']; ?>)
    })


    var skunj = <?= json_encode($visit); ?>;
    var exam = <?= json_encode($exam); ?>;

    function get_datesecond() {
        var m = new Date();
        m.setHours(m.getHours() + 7)
        var dateString = m.getUTCFullYear() + "-" + String(m.getUTCMonth() + 1 + 100).substring(1, 3) + "-" + String(m.getUTCDate() + 100).substring(1, 3) + " " + String(m.getUTCHours() + 100).substring(1, 3) + ":" + String(m.getUTCMinutes() + 100).substring(1, 3) + ":" + String(m.getUTCSeconds() + 100).substring(1, 3);
        return dateString;
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
        var color = ['#f56954', '#00a65a', '#f39c12', '#2f4074', '#00c0ef', '#3c8dbc', '#d2d6de', '#b7b83f'];

        var label = [
            <?php foreach ($exam as $key => $value) { ?> '<?= substr($exam[$key]['examination_date'], 0, 13); ?>',
            <?php } ?>
        ];
        var datasheet = [{
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['weight']; ?>,
                    <?php } ?>
                ],
                label: 'Berat',
                borderColor: "#438FFF",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['temperature']; ?>,
                    <?php } ?>
                ],
                label: 'Suhu',
                borderColor: "#A80000",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['height']; ?>,
                    <?php } ?>
                ],
                label: 'Tinggi',
                borderColor: "#12239E",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['nadi']; ?>,
                    <?php } ?>
                ],
                label: 'Nadi',
                borderColor: "#D82C20",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['tension_upper']; ?>,
                    <?php } ?>
                ],
                label: 'Sistol',
                borderColor: "#FFA500",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['tension_below']; ?>,
                    <?php } ?>
                ],
                label: 'Diastol',
                borderColor: "#FFA500",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['nafas']; ?>,
                    <?php } ?>
                ],
                label: 'Nafas',
                borderColor: "#016E51",
                fill: false
            },
        ]

        var ctx = document.getElementById("medical-history-chart").getContext("2d");

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: label,
                datasets: datasheet,
            }
        });
    });
</script>
<!-- //========datatable end===== -->
<!-- //========datatable end===== -->

<?php $this->endSection() ?>

<?php $this->section('jsContent') ?>
<?php if (isset($permissions['profilrekammedis']['c'])) {
    if ($permissions['profilrekammedis']['c'] == '1') { ?>
        <?php
        echo view('admin/patient/modal/addRm', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa
        ]);
        ?>
<?php echo view('admin/patient/modal/addDiag', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat
        ]);
    }
} ?>
<?php if (isset($permissions['profilrekammedis']['u'])) {
    if ($permissions['profilrekammedis']['u'] == '1') { ?>
<?php echo view('admin/patient/modal/editDiag', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat
        ]);
    }
} ?>
<?php if (isset($permissions['eresep']['c'])) {
    if ($permissions['eresep']['c'] == '1') { ?>
        <?php
        /* echo view('admin/patient/modal/addPrescNR', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat
        ]); */
        ?>
        <?php /* echo view('admin/patient/modal/addPrescR', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat
        ]); */ ?>
<?php }
} ?>
<?php if (isset($permissions['eresep']['c'])) {
    if ($permissions['eresep']['c'] == '1') { ?>
        <?php /* echo view('admin/patient/modal/editPrescNR', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat
        ]); */ ?>
        <?php /* echo view('admin/patient/modal/editPrescR', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat
        ]); */ ?>
<?php }
} ?>
<?php echo view('admin/patient/modal/historyPrescription', [
    'clinic' => $clinic,
    'visit' => $visit,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat
]); ?>
<?php echo view('admin/patient/modal/hasilRad', [
    'clinic' => $clinic,
    'visit' => $visit,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat
]); ?>
<?php $this->endSection() ?>

<?php $this->section('jsContent') ?>
<script type="text/javascript">
    $('#fillitemid').select2({
        placeholder: "Input nama obat",
        ajax: {
            url: '<?= base_url(); ?>admin/patient/getObatListAjax',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term, // search term
                    employeeId: '<?= $visit['employee_id']; ?>'
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
    $('#fillitemidR').select2({
        placeholder: "Input nama obat",
        ajax: {
            url: '<?= base_url(); ?>admin/patient/getObatListAjax',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term, // search term
                    employeeId: '<?= $visit['employee_id']; ?>'
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });

    function initializeResepSelect2(theid, initialvalue = null) {
        $("#" + theid).select2({
            placeholder: "Input nama obat",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getObatListAjax',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term, // search term
                        employeeId: '<?= $visit['employee_id']; ?>'
                    };
                },
                processResults: function(response) {
                    $("#" + theid).val(null).trigger('change');
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        if (initialvalue != null) {
            var option = new Option(initialvalue, initialvalue, true, true);
            $("#" + theid).append(option).trigger('change');
        }

    }

    function initializeDiagSelect2(theid, initialvalue = null, initialname = null, initialcat = null) {
        $("#" + theid).select2({
            placeholder: "Input Diagnosa",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getDiagnosisListAjax',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                    };
                },
                processResults: function(response) {
                    $("#" + theid).val(null).trigger('change');
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        if (initialvalue != null) {
            var option = new Option(initialname, initialvalue, true, true);
            $("#" + theid).append(option).trigger('change');
        }

    }

    function initializeProcSelect2(theid, initialvalue = null, initialname = null, initialcat = null) {
        $("#" + theid).select2({
            placeholder: "Input Prosedur",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getProcedureListAjax',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                    };
                },
                processResults: function(response) {
                    $("#" + theid).val(null).trigger('change');
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        if (initialvalue != null) {
            var option = new Option(initialname, initialvalue, true, true);
            $("#" + theid).append(option).trigger('change');
        }

    }


    function get_date() {
        var m = new Date();
        m.setHours(m.getHours() + 7)
        var dateString = m.getUTCFullYear() + "-" + String(m.getUTCMonth() + 1 + 100).substring(1, 3) + "-" + String(m.getUTCDate() + 100).substring(1, 3) + " " + String(m.getUTCHours() + 100).substring(1, 3) + ":" + String(m.getUTCMinutes() + 100).substring(1, 3);
        return dateString;
    }

    function getAlergi(nomor) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getAlergi',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor,
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $(".alergi").val(data)
                $("#aigdriwayat_alergi").val(data)
            },
            error: function() {

            }
        });
    }
</script>
<?php $this->endSection() ?>