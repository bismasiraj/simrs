<?php
// $db = db_connect();

// $exam_info = $db->query("SELECT TOP 1 weight, height, vs_status_id, temperature, nadi, tension_upper, tension_below, saturasi, nafas 
//     FROM EXAMINATION_DETAIL 
//     WHERE VISIT_ID = ? 
//     ORDER BY EXAMINATION_DATE DESC", [@$visit['visit_id']])->getRowArray();

// $exam_info = [
//     'weight' => $exam_info['weight'] ?? 0,
//     'height' => $exam_info['height'] ?? 0,
//     'vs_status_id' => $exam_info['vs_status_id'] ?? null,
//     'temperature' => $exam_info['temperature'] ?? null,
//     'nadi' => $exam_info['nadi'] ?? null,
//     'tension_upper' => $exam_info['tension_upper'] ?? null,
//     'tension_below' => $exam_info['tension_below'] ?? null,
//     'saturasi' => $exam_info['saturasi'] ?? null,
//     'nafas' => $exam_info['nafas'] ?? null,
// ];
?>

<div class="tab-pane fade" id="anesthesi-lengkap">
    <form action="" id="form-laporanAnesthesi-lengkap">
        <input id="clinic_id-laporanAnesthesi-lengkap" name="clinic_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['clinic_id']; ?>" />
        <input id="class_room_id-laporanAnesthesi-lengkap" name="class_room_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['class_room_id']; ?>" />
        <input id="bed_id-laporanAnesthesi-lengkap" name="bed_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['bed_id']; ?>" />
        <input id="keluar_id-laporanAnesthesi-lengkap" name="keluar_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['keluar_id']; ?>" />
        <input id="employee_id-laporanAnesthesi-lengkap" name="employee_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['employee_id']; ?>" />
        <input id="no_registration-laporanAnesthesi-lengkap" name="no_registration" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['no_registration']; ?>" />
        <input id="visit_id-laporanAnesthesi-lengkap" name="visit_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['visit_id']; ?>" />
        <input id="org_unit_code-laporanAnesthesi-lengkap" name="org_unit_code" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['org_unit_code']; ?>" />
        <input id="pasien_diagnosa_id-laporanAnesthesi-lengkap" name="pasien_diagnosa_id" placeholder="" type="hidden"
            class="form-control block" value="" />
        <input id="doctor-laporanAnesthesi-lengkap" name="doctor" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['doctor'] ?? @@$visit['fullname']; ?>" />
        <input id="kal_id-laporanAnesthesi-lengkap" name="kal_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['kal_id']; ?>" />
        <input id="theid-laporanAnesthesi-lengkap" name="theid" placeholder="" type="hidden" class="form-control block"
            value="<?= @@$visit['theid']; ?>" />
        <input id="thename-laporanAnesthesi-lengkap" name="thename" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['theid']; ?>" />
        <input id="theaddress-laporanAnesthesi-lengkap" name="theaddress" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['theid']; ?>" />
        <input id="status_pasien_id-laporanAnesthesi-lengkap" name="status_pasien_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['status_pasien_id']; ?>" />
        <input id="isrj-laporanAnesthesi-lengkap" name="isrj" placeholder="" type="hidden" class="form-control block"
            value="<?= @@$visit['isrj']; ?>" />
        <input id="gender-laporanAnesthesi-lengkap" name="gender" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['gender']; ?>" />
        <input id="ageyear-laporanAnesthesi-lengkap" name="ageyear" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['ageyear']; ?>" />
        <input id="agemonth-laporanAnesthesi-lengkap" name="agemonth" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['agemonth']; ?>" />
        <input id="ageday-laporanAnesthesi-lengkap" name="ageday" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['ageday']; ?>" />
        <input id="body_id-laporanAnesthesi-lengkap" name="body_id" placeholder="" type="hidden"
            class="form-control block" value="" />
        <input id="modified_by-laporanAnesthesi-lengkap" name="modified_by" placeholder="" type="hidden"
            class="form-control block" value="<?= user()->username ?>" />
        <input id="trans_id-laporanAnesthesi-lengkap" name="trans_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['trans_id']; ?>" />

        <input id="clinic_id-laporanAnesthesi-lengkap-durantee" name="clinic_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['clinic_id']; ?>" />
        <input id="class_room_id-laporanAnesthesi-lengkap-durantee" name="class_room_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['class_room_id']; ?>" />
        <input id="bed_id-laporanAnesthesi-lengkap-durantee" name="bed_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['bed_id']; ?>" />
        <input id="keluar_id-laporanAnesthesi-lengkap-durantee" name="keluar_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['keluar_id']; ?>" />
        <input id="employee_id-laporanAnesthesi-lengkap-durantee" name="employee_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['employee_id']; ?>" />
        <input id="no_registration-laporanAnesthesi-lengkap-durantee" name="no_registration" placeholder=""
            type="hidden" class="form-control block" value="<?= @$visit['no_registration']; ?>" />
        <input id="visit_id-laporanAnesthesi-lengkap-durantee" name="visit_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['visit_id']; ?>" />
        <input id="org_unit_code-laporanAnesthesi-lengkap-durantee" name="org_unit_code" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['org_unit_code']; ?>" />
        <input id="pasien_diagnosa_id-laporanAnesthesi-lengkap-durantee" name="pasien_diagnosa_id" placeholder=""
            type="hidden" class="form-control block" value="" />
        <input id="doctor-laporanAnesthesi-lengkap-durantee" name="doctor" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['doctor'] ?? @@$visit['fullname']; ?>" />
        <input id="kal_id-laporanAnesthesi-lengkap-durantee" name="kal_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['kal_id']; ?>" />
        <input id="theid-laporanAnesthesi-lengkap-durantee" name="theid" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['theid']; ?>" />
        <input id="thename-laporanAnesthesi-lengkap-durantee" name="thename" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['theid']; ?>" />
        <input id="theaddress-laporanAnesthesi-lengkap-durantee" name="theaddress" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['theid']; ?>" />
        <input id="status_pasien_id-laporanAnesthesi-lengkap-durantee" name="status_pasien_id" placeholder=""
            type="hidden" class="form-control block" value="<?= @@$visit['status_pasien_id']; ?>" />
        <input id="isrj-laporanAnesthesi-lengkap-durantee" name="isrj" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['isrj']; ?>" />
        <input id="gender-laporanAnesthesi-lengkap-durantee" name="gender" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['gender']; ?>" />
        <input id="ageyear-laporanAnesthesi-lengkap-durantee" name="ageyear" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['ageyear']; ?>" />
        <input id="agemonth-laporanAnesthesi-lengkap-durantee" name="agemonth" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['agemonth']; ?>" />
        <input id="ageday-laporanAnesthesi-lengkap-durantee" name="ageday" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['ageday']; ?>" />
        <input id="body_id-laporanAnesthesi-lengkap-durantee" name="body_id_durantee" placeholder="" type="hidden"
            class="form-control block" value="" />
        <input id="modified_by-laporanAnesthesi-lengkap-durantee" name="modified_by" placeholder="" type="hidden"
            class="form-control block" value="<?= user()->username ?>" />
        <input id="trans_id-laporanAnesthesi-lengkap-durantee" name="trans_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @@$visit['trans_id']; ?>" />
        <div id="accordionLengkap" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingUmum">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseUmum" aria-expanded="false" aria-controls="flush-collapseUmum">
                        UMUM
                    </button>
                </h2>
                <div id="flush-collapseUmum" class="accordion-collapse collapse" aria-labelledby="flush-headingUmum"
                    data-bs-parent="#accordionLengkap">
                    <div class="accordion-body" id="informasiMedis-laporan-umum">
                        <div class="container">

                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td width="150px"><b>Pasien</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @@$visit['diantar_oleh']; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>ID (KTP)</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @@$visit['account_id'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Gender</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @@$visit['gendername'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Date of Birth</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @@$visit['date_of_birth'] ?? '' ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Patient Age</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @@$visit['age'] ?></span></td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- Kolom kedua dengan tabel -->
                                <div class="col-12 col-md-6 mb-3">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td width="150px"><b>Department</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @@$visit['name_of_clinic_from'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Dokter DPJP</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @@@$visit['fullname'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Ward/Room</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @@$visit['name_of_clinic'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Bed No</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @@$visit['bed'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Room Class</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @@$visit['class_id'] ?></span></td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row" id="bodyTimOperasiAnesthesiLengkap">

                            </div>
                            <div class="row mb-4">
                                <hr>
                                <h3>Histori Vital Sign</h3>
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
                                    <tbody id="vitalSignBodyLaporanAnesthesiLengkap">
                                        <?php
                                        $total = 0;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row" id="bodyDiagnosisAnesthesiLengkap">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingAnesthesiaDetails">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseAnesthesiaDetails" aria-expanded="false"
                        aria-controls="flush-collapseAnesthesiaDetails">
                        Anesthesia Details
                    </button>
                </h2>
                <div id="flush-collapseAnesthesiaDetails" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingAnesthesiaDetails" data-bs-parent="#accordionLengkap">
                    <div class="accordion-body" id="informasiMedis-laporan-anesthesia-details">
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingMonitoringDurante">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseMonitoringDurante" aria-expanded="false"
                        aria-controls="flush-collapseMonitoringDurante">
                        Monitoring Durante
                    </button>
                </h2>
                <div id="flush-collapseMonitoringDurante" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingMonitoringDurante" data-bs-parent="#accordionLengkap">
                    <div class="accordion-body" id="informasiMedis-laporan-monitoring-durante">
                        <div id="vitalSignLaporanAnesthesiLengkap2" class="card border-1 rounded-4 m-4 p-4"
                            style="display: none;">
                            <div class="card-body">
                                <form id="formvitalsign-laporanAnesthesi-lengkap2" accept-charset="utf-8" action=""
                                    enctype="multipart/form-data" method="post" class="ptt10">
                                    <div class="modal-body pt0 pb0">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="anamnase-laporanAnesthesi-lengkap"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">(S)
                                                            Anamnesis</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control"
                                                                id="anamnase-laporanAnesthesi-lengkap-durantee"
                                                                name="anamnase2" placeholder=""></textarea>
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
                                                                            id="vs_status_id-laporanAnesthesi-lengkap-durantee">
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
                                                                                id="weight-laporanAnesthesi-lengkap-durantee"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-bb-laporanAnesthesi-lengkap-durantee"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Tinggi(cm)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="height"
                                                                                id="height-laporanAnesthesi-lengkap-durantee"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-height-laporanAnesthesi-lengkap-durantee"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Suhu(°C)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="temperature"
                                                                                id="temperature-laporanAnesthesi-lengkap-durantee"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-temperature-laporanAnesthesi-lengkap-durantee"></span>
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
                                                                                id="nadi-laporanAnesthesi-lengkap-durantee"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-nadi-laporanAnesthesi-lengkap-durantee"></span>
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
                                                                                    id="tension_upper-laporanAnesthesi-lengkap-durantee"
                                                                                    placeholder="" value=""
                                                                                    class="form-control vitalsignclass"
                                                                                    autocomplete="off">
                                                                                <span class="h6"
                                                                                    id="badge-tension_upper-laporanAnesthesi-lengkap-durantee"></span>
                                                                            </div>
                                                                            <h4 class="mx-2">/</h4>
                                                                            <div class="position-relative">
                                                                                <input onchange="vitalsignInput(this)"
                                                                                    type="text" name="tension_below"
                                                                                    id="tension_below-laporanAnesthesi-lengkap-durantee"
                                                                                    placeholder="" value=""
                                                                                    class="form-control vitalsignclass"
                                                                                    autocomplete="off">
                                                                                <span class="h6"
                                                                                    id="badge-tension_below-laporanAnesthesi-lengkap-durantee"></span>
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
                                                                                id="saturasi-laporanAnesthesi-lengkap-durantee"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-saturasi-laporanAnesthesi-lengkap-durantee"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Nafas/RR(/menit)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="nafas"
                                                                                id="nafas-laporanAnesthesi-lengkap-durantee"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-nafas-laporanAnesthesi-lengkap-durantee"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Kesadaran</label>
                                                                        <select class="form-select" name="awareness"
                                                                            id="awareness-laporanAnesthesi-lengkap-durantee"
                                                                            onchange="vitalsignInput(this)">
                                                                            <option value="0">Sadar</option>
                                                                            <option value="3">Nyeri</option>
                                                                            <option value="10">Unrespon</option>
                                                                        </select>
                                                                        <span class="h6"
                                                                            id="badge-awareness-laporanAnesthesi-lengkap-durantee"></span>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    id="container-vitalsign-laporanAnesthesi-lengkap-durantee">

                                                                </div>
                                                                <div class="col-sm-12 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Pemeriksaan</label><textarea
                                                                            name="pemeriksaan"
                                                                            id="pemeriksaan-laporanAnesthesi-lengkap-durantee"
                                                                            placeholder="" value=""
                                                                            class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="description-laporanAnesthesi-lengkap-durantee"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">(A)
                                                            Assesment</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control"
                                                                id="description-laporanAnesthesi-lengkap-durantee"
                                                                name="description" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="instruction-laporanAnesthesi-lengkap-durantee"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">(P)
                                                            Rencana Penatalaksanaan</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control"
                                                                id="instruction-laporanAnesthesi-lengkap-durantee"
                                                                name="instruction" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4">
                                                        <label for="examination_date-laporanAnesthesi-lengkap-durantee"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">Tanggal
                                                            Periksa</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group"
                                                                id="examinationdate--laporanAnesthesi-lengkap-durantee">
                                                                <input
                                                                    id="flatexamination_date-laporanAnesthesi-lengkap-durantee"
                                                                    type="text"
                                                                    class="form-control datetimeflatpickr-oprs"
                                                                    placeholder="yyyy-mm-dd">
                                                                <input
                                                                    id="examination_date-laporanAnesthesi-lengkap-durantee"
                                                                    name="examination_date" type="hidden"
                                                                    class="form-control" placeholder="yyyy-mm-dd">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>

                                                        <button type="button"
                                                            id="btn-save-vitalSignLaporanAnesthesiLengkap2"
                                                            class="btn btn-primary btn-save-vitalSignLaporanAnesthesiLengkap2"><i
                                                                class="fas fa-save"></i>
                                                            Simpan</button>
                                                    <?php } ?>
                                                </div>
                                                <!--./col-lg-7-->
                                            </div>
                                            <div class="col-sm-6" style="display: none;">
                                                <div class="form-group"><label>Perawat</label><input type="text"
                                                        name="petugas-laporanAnesthesi-lengkap-durantee"
                                                        id="petugas-laporanAnesthesi-lengkap-durantee" placeholder=""
                                                        value="<?= user_id(); ?>" class="form-control"></div>
                                            </div>
                                        </div>
                                        <span id="total_score-laporanAnesthesi-lengkap-durantee"></span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="box-tab-tools text-center mt-4">
                            <a data-toggle="modal"
                                onclick="setDataVitalSignLaporanAnesthesiLengkap('vitalSignLaporanAnesthesiLengkap2','formvitalsign-laporanAnesthesi-lengkap2')"
                                id="tambahVtLaporanAnesthesiLengkap2Show" class="btn btn-primary btn-lg"
                                style="width: 300px"><i class=" fa fa-plus"></i> Tambah
                                Vitalsign</a>
                            <a data-toggle="modal" id="sembunyikanVtLaporanAnesthesiLengkap2Show"
                                class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i>
                                Sembunyikan Form</a>
                        </div>
                        <h3>Histori Vital Sign</h3>
                        <table class="table table-striped table-hover">
                            <thead class=" table-primary" style="text-align: center;">
                                <tr>
                                    <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                                    <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                                    <th class="text-center" colspan="6" style="width: 70%;">SOAP</th
                                        class="text-center">
                                    <th class="text-center" style="width: 5%;"></th class="text-center">
                                    <th class="text-center" style="width: 5%;"></th class="text-center">
                                </tr>
                            </thead>
                            <tbody id="vitalSignBodyLaporanAnesthesiLengkap2">
                                <?php
                                $total = 0;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="accordion-body" id="informasiMedis-laporan-monitoring-durante-date">
                    </div>
                    <div class="accordion-body" id="informasiMedis-laporan-monitoring-durante-2">
                    </div>
                    <div class="accordion-body" id="body-recovery-room-oprs029-oprs033"></div>

                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingObatInhalasi">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseObatInhalasi" aria-expanded="false"
                        aria-controls="flush-collapseObatInhalasi">
                        Obat Inhalasi
                    </button>
                </h2>
                <div id="flush-collapseObatInhalasi" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingObatInhalasi" data-bs-parent="#accordionLengkap">
                    <div class="accordion-body" id="informasiMedis-laporan-obat-inhalasi">
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingObatInjeksi">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseObatInjeksi" aria-expanded="false"
                        aria-controls="flush-collapseObatInjeksi">
                        Obat Injeksi
                    </button>
                </h2>
                <div id="flush-collapseObatInjeksi" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingObatInjeksi" data-bs-parent="#accordionLengkap">
                    <div class="accordion-body" id="informasiMedis-laporan-obat-injeksi">
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingCairanMasuk">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseCairanMasuk" aria-expanded="false"
                        aria-controls="flush-collapseCairanMasuk">
                        Cairan Masuk
                    </button>
                </h2>
                <div id="flush-collapseCairanMasuk" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingCairanMasuk" data-bs-parent="#accordionLengkap">
                    <div class="accordion-body" id="informasiMedis-laporan-cairan-masuk">
                    </div>
                </div>
            </div>



            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOutput">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOutput" aria-expanded="false"
                        aria-controls="flush-collapseOutput">
                        Output
                    </button>
                </h2>
                <div id="flush-collapseOutput" class="accordion-collapse collapse" aria-labelledby="flush-headingOutput"
                    data-bs-parent="#accordionLengkap">
                    <div class="accordion-body" id="informasiMedis-laporan-output">
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingDuranteSignature">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseDuranteSignature" aria-expanded="false"
                        aria-controls="flush-collapseDuranteSignature">
                        Durante Signature
                    </button>
                </h2>
                <div id="flush-collapseDuranteSignature" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingDuranteSignature" data-bs-parent="#accordionLengkap">
                    <div class="accordion-body" id="informasiMedis-laporan-durante-signature">
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingIntruksiPascaAnesthesi">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseIntruksiPascaAnesthesi" aria-expanded="false"
                        aria-controls="flush-collapseIntruksiPascaAnesthesi">
                        Intruksi Pasca Anesthesi dan Sedasi
                    </button>
                </h2>
                <div id="flush-collapseIntruksiPascaAnesthesi" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingIntruksiPascaAnesthesi" data-bs-parent="#accordionLengkap">
                    <div class="accordion-body" id="informasiMedis-laporan-intruksi-pasca-anesthesi">
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingRecoveryRoomMonitoring">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseRecoveryRoomMonitoring" aria-expanded="false"
                        aria-controls="flush-collapseRecoveryRoomMonitoring">
                        Recovery Room Monitoring
                    </button>
                </h2>
                <div id="flush-collapseRecoveryRoomMonitoring" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingRecoveryRoomMonitoring" data-bs-parent="#accordionLengkap">
                    <div class="accordion-body" id="informasiMedis-laporan-recovery-room-monitoring"></div>
                    <div class="accordion-body" id="informasiMedis-laporan-recovery-room-monitoringg">
                        <div id="vitalSignLaporanAnesthesiLengkap3" class="card border-1 rounded-4 m-4 p-4"
                            style="display: none;">
                            <div class="card-body">
                                <form id="formvitalsign-laporanAnesthesi-lengkap3" accept-charset="utf-8" action=""
                                    enctype="multipart/form-data" method="post" class="ptt10">
                                    <div class="modal-body pt0 pb0">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="anamnase-laporanAnesthesi-lengkap"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">(S)
                                                            Anamnesis</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control"
                                                                id="anamnase-laporanAnesthesi-lengkap" name="anamnase"
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
                                                                        <select class="form-select" name="vs_status_id2"
                                                                            id="vs_status_id-laporanAnesthesi-lengkap">
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
                                                                                type="text" name="weight2"
                                                                                id="weight-laporanAnesthesi-lengkap"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-bb-laporanAnesthesi-lengkap"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Tinggi(cm)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="height2"
                                                                                id="height-laporanAnesthesi-lengkap"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-height-laporanAnesthesi-lengkap"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Suhu(°C)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="temperature2"
                                                                                id="temperature-laporanAnesthesi-lengkap"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-temperature-laporanAnesthesi-lengkap"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                                    <div class="form-group">
                                                                        <label>Nadi(/menit)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="nadi2"
                                                                                id="nadi-laporanAnesthesi-lengkap"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-nadi-laporanAnesthesi-lengkap"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                        <div class="col-sm-12 "
                                                                            style="display: flex;  align-items: center;">
                                                                            <div class="position-relative">
                                                                                <input onchange="vitalsignInput(this)"
                                                                                    type="text" name="tension_upper2"
                                                                                    id="tension_upper-laporanAnesthesi-lengkap"
                                                                                    placeholder="" value=""
                                                                                    class="form-control vitalsignclass"
                                                                                    autocomplete="off">
                                                                                <span class="h6"
                                                                                    id="badge-tension_upper-laporanAnesthesi-lengkap"></span>
                                                                            </div>
                                                                            <h4 class="mx-2">/</h4>
                                                                            <div class="position-relative">
                                                                                <input onchange="vitalsignInput(this)"
                                                                                    type="text" name="tension_below2"
                                                                                    id="tension_below-laporanAnesthesi-lengkap"
                                                                                    placeholder="" value=""
                                                                                    class="form-control vitalsignclass"
                                                                                    autocomplete="off">
                                                                                <span class="h6"
                                                                                    id="badge-tension_below-laporanAnesthesi-lengkap"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Saturasi(SpO2%)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="saturasi2"
                                                                                id="saturasi-laporanAnesthesi-lengkap"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-saturasi-laporanAnesthesi-lengkap"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Nafas/RR(/menit)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)"
                                                                                type="text" name="nafas2"
                                                                                id="nafas-laporanAnesthesi-lengkap"
                                                                                placeholder="" value=""
                                                                                class="form-control vitalsignclass"
                                                                                autocomplete="off">
                                                                            <span class="h6"
                                                                                id="badge-nafas-laporanAnesthesi-lengkap"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Kesadaran</label>
                                                                        <select class="form-select" name="awareness2"
                                                                            id="awareness-laporanAnesthesi-lengkap"
                                                                            onchange="vitalsignInput(this)">
                                                                            <option value="0">Sadar</option>
                                                                            <option value="3">Nyeri</option>
                                                                            <option value="10">Unrespon</option>
                                                                        </select>
                                                                        <span class="h6"
                                                                            id="badge-awareness-laporanAnesthesi-lengkap"></span>
                                                                    </div>
                                                                </div>
                                                                <div id="container-vitalsign-laporanAnesthesi-lengkap">

                                                                </div>
                                                                <div class="col-sm-12 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Pemeriksaan</label><textarea
                                                                            name="pemeriksaan2"
                                                                            id="pemeriksaan-laporanAnesthesi-lengkap"
                                                                            placeholder="" value=""
                                                                            class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="description-laporanAnesthesi-lengkap"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">(A)
                                                            Assesment</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control"
                                                                id="description-laporanAnesthesi-lengkap"
                                                                name="description2" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="instruction-laporanAnesthesi-lengkap"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">(P)
                                                            Rencana Penatalaksanaan</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control"
                                                                id="instruction-laporanAnesthesi-lengkap"
                                                                name="instruction2" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4">
                                                        <label for="examination_date-laporanAnesthesi-lengkap"
                                                            class="col-xs-6 col-sm-6 col-md-3 col-form-label">Tanggal
                                                            Periksa</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group"
                                                                id="examinationdate--laporanAnesthesi-lengkap">
                                                                <input
                                                                    id="flatexamination_date-laporanAnesthesi-lengkap"
                                                                    type="text"
                                                                    class="form-control datetimeflatpickr-oprs"
                                                                    placeholder="yyyy-mm-dd">
                                                                <input id="examination_date-laporanAnesthesi-lengkap"
                                                                    name="examination_date2" type="hidden"
                                                                    class="form-control" placeholder="yyyy-mm-dd">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>

                                                        <button type="button"
                                                            id="btn-save-vitalSignLaporanAnesthesiLengkap3"
                                                            class="btn btn-primary btn-save-vitalSignLaporanAnesthesiLengkap2"><i
                                                                class="fas fa-save"></i>
                                                            Simpan</button>
                                                    <?php } ?>
                                                </div>
                                                <!--./col-lg-7-->
                                            </div>
                                            <div class="col-sm-6" style="display: none;">
                                                <div class="form-group"><label>Perawat</label><input type="text"
                                                        name="petugas-laporanAnesthesi-lengkap"
                                                        id="petugas-laporanAnesthesi-lengkap" placeholder=""
                                                        value="<?= user_id(); ?>" class="form-control"></div>
                                            </div>
                                        </div>
                                        <span id="total_score-laporanAnesthesi-lengkap"></span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="box-tab-tools text-center mt-4">
                            <a data-toggle="modal"
                                onclick="setDataVitalSignLaporanAnesthesiLengkap2('vitalSignLaporanAnesthesiLengkap3','formvitalsign-laporanAnesthesi-lengkap3')"
                                id="tambahVtLaporanAnesthesiLengkap3Show" class="btn btn-primary btn-lg"
                                style="width: 300px"><i class=" fa fa-plus"></i> Tambah
                                Vitalsign</a>
                            <a data-toggle="modal" id="sembunyikanVtLaporanAnesthesiLengkap3Show"
                                class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i>
                                Sembunyikan Form</a>
                        </div>
                        <h3>Histori Vital Sign</h3>
                        <table class="table table-striped table-hover">
                            <thead class=" table-primary" style="text-align: center;">
                                <tr>
                                    <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                                    <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                                    <th class="text-center" colspan="6" style="width: 70%;">SOAP</th
                                        class="text-center">
                                    <th class="text-center" style="width: 5%;"></th class="text-center">
                                    <th class="text-center" style="width: 5%;"></th class="text-center">
                                </tr>
                            </thead>
                            <tbody id="vitalSignBodyLaporanAnesthesiLengkap3">
                                <?php
                                $total = 0;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="accordion-body" id="informasiMedis-laporan-recovery-medication"></div>
                    <div class="accordion-body" id="informasiMedis-laporan-recovery-room-monitoring-score">
                    </div>
                    <div class="accordion-body" id="informasiMedis-laporan-recovery-room-monitoring-score-2">
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12 my-3 d-flex justify-content-end gap-2">
            <button type="button" id="btn-print-anestesi-lengkap" class="btn btn-success">
                <i class="fas fa-print"></i> Cetak
            </button>


            <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>
                <button type="button" id="btn-save-laporan-anesthesiLengkap" class="btn btn-primary btn-save-operasi"><i
                        class="fas fa-save"></i> Simpan</button>
            <?php } ?>

        </div>
    </form>
</div>

<script type='text/javascript'>
    $(document).ready(function(e) {

        // var bodyIdLengkap = ''

        // const date = new Date();
        // bodyIdLengkap = date.toISOString().substring(0, 23);
        // bodyIdLengkap = bodyIdLengkap.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T",
        //     "");
        // $("#body_id-laporanAnesthesi-lengkap").val(bodyIdLengkap)

    })


    $("#vs_status_id-laporanAnesthesi-lengkap").on("change", function() {
        var optionSelected = $("option:selected", this);
        $('.vitalsignclass-laporanAnesthesi-lengkap').each((index, each) => {
            $(each).change(element => {
                vitalsignInput({
                    value: $(each).val(),
                    name: $(each).attr('name'),
                    uniq_name: '-laporanAnesthesi-lengkap',
                    type: optionSelected.val()
                })
            })
            vitalsignInput({
                value: $(each).val(),
                name: $(each).attr('name'),
                uniq_name: '-laporanAnesthesi-lengkap',
                type: optionSelected.val()
            })
        });
    })

    $("#sembunyikanVtLaporanAnesthesiLengkap2Show").off().on("click", function() {
        $("#tambahVtLaporanAnesthesiLengkap2Show").show()
        $("#vitalSignLaporanAnesthesiLengkap2").slideUp()
        $("#vitalSignLaporanAnesthesiLengkap2").hide()
        $("#sembunyikanVtLaporanAnesthesiLengkap2Show").hide()
    })


    function setDataVitalSignLaporanAnesthesiLengkap(container_id, body) {
        $("#" + container_id).find("input, textarea").val(null)
        $("#" + container_id).find("#total_score-laporanAnesthesi-lengkap-durantee").html("")
        $("#" + container_id).find("span.h6").html("")
        $("#vs_status_id-laporanAnesthesi-lengkap-durantee").prop("selectedIndex", 0);
        $("#body_id-laporanAnesthesi-lengkap-durantee").val('');
        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        // $("#body_id-laporanAnesthesi-lengkap-durantee").val(bodyId)
        $("#clinic_id-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['clinic_id']; ?>')
        $("#trans_id-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['trans_id']; ?>')
        $("#class_room_id-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['class_room_id']; ?>')
        $("#bed_id-laporanAnesthesi-lengkap-durantee").val()
        $("#keluar_id-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['keluar_id']; ?>')
        $("#employee_id-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['employee_id']; ?>')
        $("#no_registration-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['no_registration']; ?>')
        $("#visit_id-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['visit_id']; ?>')
        $("#org_unit_code-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['org_unit_code']; ?>')
        $("#doctor-laporanAnesthesi-lengkap-durantee").val('<?= @@$visit['fullname']; ?>')
        $("#kal_id-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['kal_id']; ?>')
        $("#theid-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['pasien_id']; ?>')
        $("#thename-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['diantar_oleh']; ?>')
        $("#theaddress-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['visitor_address']; ?>')
        $("#status_pasien_id-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['status_pasien_id']; ?>')
        $("#isrj-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['isrj']; ?>')
        $("#gender-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['gender']; ?>')
        $("#ageyear-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['ageyear']; ?>')
        $("#agemonth-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['agemonth']; ?>')
        $("#ageday-laporanAnesthesi-lengkap-durantee").val('<?= @$visit['ageday']; ?>')
        $("#examination_date-laporanAnesthesi-lengkap-durantee").val(get_date())
        $("#flatexamination_date-laporanAnesthesi-lengkap-durantee").val(moment(get_date()).format("DD/MM/YYYY HH:mm"))
            .trigger("change")


        postData({
                visit_id: '<?= @$visit['visit_id']; ?>',
                account_id: '12'
            }, 'admin/PatientOperationRequest/getExaminfoTop',
            (res) => {
                let exam_info = res.examInfo || {};

                $("#vs_status_id-laporanAnesthesi-lengkap-durantee").val(exam_info?.vs_status_id ?? "")
                $('#weight-laporanAnesthesi-lengkap-durantee').val(exam_info?.weight || 0);
                $('#height-laporanAnesthesi-lengkap-durantee').val(exam_info?.height || 0);
                $('#temperature-laporanAnesthesi-lengkap-durantee').val(exam_info?.temperature || 0);
                $('#nadi-laporanAnesthesi-lengkap-durantee').val(exam_info?.nadi || 0);
                $('#tension_upper-laporanAnesthesi-lengkap-durantee').val(exam_info?.tension_upper || 0);
                $('#tension_below-laporanAnesthesi-lengkap-durantee').val(exam_info?.tension_below || 0);
                $('#saturasi-laporanAnesthesi-lengkap-durantee').val(exam_info?.saturasi || 0);
                $('#nafas-laporanAnesthesi-lengkap-durantee').val(exam_info?.nafas || 0);
            }
        );

        $("#" + container_id).slideDown()
        $("#sembunyikanVtLaporanAnesthesiLengkap2Show").show()
        $("#tambahVtLaporanAnesthesiLengkap2Show").hide()
    }
    const addRowVitalSigncatatanLaporanAnesthesiLengkap = (examselect, key, container_id, account_id = null) => { //bisma
        let examinationDate = examselect.examination_date ? examselect.examination_date.substring(0, 16) : 'N/A';
        $('#' + container_id).append($("<tr>")
                .append($("<td rowspan='2'>").append(examinationDate))
                .append($("<td rowspan='2'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='2'>").html(
                    '<button type="button" onclick="copyvitalSignLaporanAnesthesiLengkap(\'' + btoa(JSON.stringify(
                        examselect)).replace(/'/g, "\\'") + '\', ' + key +
                    ')" class="btn btn-success" data-row-id="1" autocomplete="off" ' +
                    (account_id == '11' ? 'style="display:none;"' : 'style="display:block;"') +
                    '><i class="fa fa-copy"></i> Copy</button>'
                ))
                .append($("<td rowspan='2'>").html(
                    '<button type="button" onclick="removeLaporanLengkapVt(\'' + examselect.body_id + '\', \'' +
                    account_id + '\')" ' +
                    'class="btn btn-danger" data-row-id="1" autocomplete="off" ' +
                    (account_id == '11' ? 'style="display:none;"' : '') +
                    '><i class="fa fa-trash"></i></button>'

                ))
            )
            .append($("<tr>")
                .append($("<td>").html(''))
                .append($("<td>").html(examselect.tension_upper + '/' + examselect.tension_below + 'mmHg'))
                .append($("<td>").html(examselect.nadi + '/menit'))
                .append($("<td>").html(examselect.nafas + '/menit'))
                .append($("<td>").html(examselect.temperature + '/°C'))
                .append($("<td>").html(examselect.saturasi + '/SpO2%'))
            );
    }

    function removeLaporanLengkapVt(id, accountId = null) {
        postData({
            body_id: id
        }, 'admin/PatientOperationRequest/deleteExamDetail', (res) => {
            successSwal('berhasil.');
            getVitalSignLaporanAnesthesiLengkap('vitalSignBodyLaporanAnesthesiLengkap2', accountId)
        })
    }

    function copyvitalSignLaporanAnesthesiLengkap(data, key) {

        let dataExam = JSON.parse(atob(data));
        var examselect = vitalsign[key];

        const nowtime = moment(dataExam.examination_date).format("DD/MM/YYYY HH:mm");
        const date = new Date();

        $("#ageday-laporanAnesthesi-lengkap-durantee").val(dataExam.ageday)
        $("#agemonth-laporanAnesthesi-lengkap-durantee").val(dataExam.agemonth)
        $("#ageyear-laporanAnesthesi-lengkap-durantee").val(dataExam.ageyear)
        $("#anamnase-laporanAnesthesi-lengkap-durantee").val(dataExam.anamnase)
        $("#bed_id-laporanAnesthesi-lengkap-durantee").val(dataExam.bed_id)
        $("#body_id-laporanAnesthesi-lengkap-durantee").val(dataExam.body_id)
        $("#class_room_id-laporanAnesthesi-lengkap-durantee").val(dataExam.class_room_id)
        $("#clinic_id-laporanAnesthesi-lengkap-durantee").val(dataExam.clinic_id)
        $("#description-laporanAnesthesi-lengkap-durantee").val(dataExam.description)
        $("#doctor-laporanAnesthesi-lengkap-durantee").val(dataExam.doctor)
        $("#employee_id-laporanAnesthesi-lengkap-durantee").val(dataExam.employee_id)
        $("#flatexamination_date-laporanAnesthesi-lengkap-durantee").val(nowtime).trigger("change")
        $("#gender-laporanAnesthesi-lengkap-durantee").val(dataExam.gender)
        $("#height-laporanAnesthesi-lengkap-durantee").val(dataExam.height)
        $("#instruction-laporanAnesthesi-lengkap-durantee").val(dataExam.instruction)
        $("#isrj-laporanAnesthesi-lengkap-durantee").val(dataExam.isrj)
        $("#kal_id-laporanAnesthesi-lengkap-durantee").val(dataExam.kal_id)
        $("#keluar_id-laporanAnesthesi-lengkap-durantee").val(dataExam.keluar_id)
        $("#nadi-laporanAnesthesi-lengkap-durantee").val(dataExam.nadi)
        $("#nafas-laporanAnesthesi-lengkap-durantee").val(dataExam.nafas)
        $("#no_registraiton-laporanAnesthesi-lengkap-durantee").val(dataExam.no_registraiton)
        $("#org_unit_code-laporanAnesthesi-lengkap-durantee").val(dataExam.org_unit_code)
        $("#vs_status_id-laporanAnesthesi-lengkap-durantee").val(dataExam.vs_status_id)
        $("#pemeriksaan-laporanAnesthesi-lengkap-durantee").val(dataExam.pemeriksaan)
        $("#petugas-laporanAnesthesi-lengkap-durantee").val(dataExam.petugas)
        $("#saturasi-laporanAnesthesi-lengkap-durantee").val(dataExam.saturasi)
        $("#status_pasien_id-laporanAnesthesi-lengkap-durantee").val(dataExam.status_pasien_id)
        $("#temperature-laporanAnesthesi-lengkap-durantee").val(dataExam.temperature)
        $("#tension_below-laporanAnesthesi-lengkap-durantee").val(dataExam.tension_below)
        $("#tension_upper-laporanAnesthesi-lengkap-durantee").val(dataExam.tension_upper)
        $("#teraphy_desc-laporanAnesthesi-lengkap-durantee").val(dataExam.teraphy_desc)
        $("#theaddress-laporanAnesthesi-lengkap-durantee").val(dataExam.theaddress)
        $("#theid-laporanAnesthesi-lengkap-durantee").val(dataExam.pasien_id)
        $("#thename-laporanAnesthesi-lengkap-durantee").val(dataExam.diantar_oleh)
        $("#visit_id-laporanAnesthesi-lengkap-durantee").val(dataExam.visit_id)
        $("#weight-laporanAnesthesi-lengkap-durantee").val(dataExam.weight)

        $("#org_unit_code-laporanAnesthesi-lengkap-durantee").val(dataExam.org_unit_code)
        $("#pasien_diagnosa_id-laporanAnesthesi-lengkap-durantee").val(dataExam.pasien_diagnosa_id)
        $("#no_registration-laporanAnesthesi-lengkap-durantee").val(dataExam.no_registration)
        $("#visit_id-laporanAnesthesi-lengkap-durantee").val(dataExam.visit_id)
        $("#trans_id-laporanAnesthesi-lengkap-durantee").val(dataExam.trans_id) //==new
        $("#bill_id-laporanAnesthesi-lengkap-durantee").val(dataExam.bill_id)
        $("#class_room_id-laporanAnesthesi-lengkap-durantee").val(dataExam.class_room_id)
        $("#bed_id-laporanAnesthesi-lengkap-durantee").val(dataExam.bed_id)
        $("#in_date-laporanAnesthesi-lengkap-durantee").val(dataExam.in_date)
        $("#exit_date-laporanAnesthesi-lengkap-durantee").val(dataExam.exit_date)
        $("#keluar_id-laporanAnesthesi-lengkap-durantee").val(dataExam.keluar_id)
        $("#imt_score-laporanAnesthesi-lengkap-durantee").val(dataExam.imt_score)
        $("#imt_desc-laporanAnesthesi-lengkap-durantee").val(dataExam.imt_desc)
        $("#pemeriksaan-laporanAnesthesi-lengkap-durantee").val(dataExam.pemeriksaan)
        $("#medical_treatment-laporanAnesthesi-lengkap-durantee").val(dataExam.medical_treatment)
        $("#modified_date-laporanAnesthesi-lengkap-durantee").val(dataExam.modified_date)
        $("#modified_by-laporanAnesthesi-lengkap-durantee").val(dataExam.modified_by)
        $("#modified_from-laporanAnesthesi-lengkap-durantee").val(dataExam.modified_from)
        $("#status_pasien_id-laporanAnesthesi-lengkap-durantee").val(dataExam.status_pasien_id)
        $("#ageyear-laporanAnesthesi-lengkap-durantee").val(dataExam.ageyear)
        $("#agemonth-laporanAnesthesi-lengkap-durantee").val(dataExam.agemonth)
        $("#ageday-laporanAnesthesi-lengkap-durantee").val(dataExam.ageday)
        $("#thename-laporanAnesthesi-lengkap-durantee").val(dataExam.thename)
        $("#theaddress-laporanAnesthesi-lengkap-durantee").val(dataExam.theaddress)
        $("#theid-laporanAnesthesi-lengkap-durantee").val(dataExam.theid)
        $("#isrj-laporanAnesthesi-lengkap-durantee").val(dataExam.isrj)
        $("#gender-laporanAnesthesi-lengkap-durantee").val(dataExam.gender)
        $("#doctor-laporanAnesthesi-lengkap-durantee").val(dataExam.doctor)
        $("#kal_id-laporanAnesthesi-lengkap-durantee").val(dataExam.kal_id)
        $("#petugas_id-laporanAnesthesi-lengkap-durantee").val(dataExam.petugas_id)
        $("#petugas-laporanAnesthesi-lengkap-durantee").val(dataExam.petugas)
        $("#account_id-laporanAnesthesi-lengkap-durantee").val(dataExam.account_id)
        $("#kesadaran-laporanAnesthesi-lengkap-durantee").val(dataExam.kesadaran)
        $("#isvalid-laporanAnesthesi-lengkap-durantee").val(dataExam.isvalid)

        $("#anamnase-laporanAnesthesi-lengkap-durantee").val(dataExam.anamnase)
        $("#description-laporanAnesthesi-lengkap-durantee").val(dataExam.description)
        $("#weight-laporanAnesthesi-lengkap-durantee").val(dataExam.weight).trigger("change")
        $("#height-laporanAnesthesi-lengkap-durantee").val(dataExam.height).trigger("change")
        $("#temperature-laporanAnesthesi-lengkap-durantee").val(dataExam.temperature).trigger("change")
        $("#nadi-laporanAnesthesi-lengkap-durantee").val(dataExam.nadi).trigger("change")
        $("#tension_upper-laporanAnesthesi-lengkap-durantee").val(dataExam.tension_upper).trigger("change")
        $("#tension_lower-laporanAnesthesi-lengkap-durantee").val(dataExam.tension_lower).trigger("change")
        $("#saturasi-laporanAnesthesi-lengkap-durantee").val(dataExam.saturasi).trigger("change")
        $("#nafas-laporanAnesthesi-lengkap-durantee").val(dataExam.nafas).trigger("change")
        $("#vs_status_id-laporanAnesthesi-lengkap-durantee").val(dataExam.vs_status_id).trigger("change")
        $("#pemeriksaan-laporanAnesthesi-lengkap-durantee").val(dataExam.pemeriksaan).trigger("change")

        $("#vitalSignLaporanAnesthesi-lengkap").slideDown()


    }

    function getVitalSignLaporanAnesthesiLengkap(container_id, account_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>admin/PatientOperationRequest/getExaminfo',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit.visit_id,
                'nomor': nomor,
                'account_id': account_id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                if (data.examInfo.length > 0) {
                    vitalsign = data.examInfo

                    $("#" + container_id).html("")
                    vitalsign.forEach((element, key) => {
                        examselect = vitalsign[key];
                        addRowVitalSigncatatanLaporanAnesthesiLengkap(examselect, key, container_id,
                            account_id)
                    });
                } else {
                    $("#" + container_id).html("")

                }

            },
            error: function() {

            }
        });
    }

    $("#sembunyikanVtLaporanAnesthesiLengkap3Show").off().on("click", function() {
        $("#tambahVtLaporanAnesthesiLengkap3Show").show()
        $("#vitalSignLaporanAnesthesiLengkap3").slideUp()
        $("#vitalSignLaporanAnesthesiLengkap3").hide()
        $("#sembunyikanVtLaporanAnesthesiLengkap3Show").hide()
    })

    function setDataVitalSignLaporanAnesthesiLengkap2(container_id, body) {
        $("#" + body).find("input, textarea").val(null)
        $("#" + body).find("#total_score-laporanAnesthesi-lengkap").html("")
        $("#" + body).find("span.h6").html("")
        $("#vs_status_id-laporanAnesthesi-lengkap").prop("selectedIndex", 0);
        var bodyId = ''

        const date = new Date();
        // bodyId = date.toISOString().substring(0, 23);
        // bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        // $("#body_id-laporanAnesthesi-lengkap").val(bodyId)
        $("#clinic_id-laporanAnesthesi-lengkap").val('<?= @$visit['clinic_id']; ?>')
        $("#trans_id-laporanAnesthesi-lengkap").val('<?= @$visit['trans_id']; ?>')
        $("#class_room_id-laporanAnesthesi-lengkap").val('<?= @$visit['class_room_id']; ?>')
        $("#bed_id-laporanAnesthesi-lengkap").val()
        $("#keluar_id-laporanAnesthesi-lengkap").val('<?= @$visit['keluar_id']; ?>')
        $("#employee_id-laporanAnesthesi-lengkap").val('<?= @$visit['employee_id']; ?>')
        $("#no_registration-laporanAnesthesi-lengkap").val('<?= @$visit['no_registration']; ?>')
        $("#visit_id-laporanAnesthesi-lengkap").val('<?= @$visit['visit_id']; ?>')
        $("#org_unit_code-laporanAnesthesi-lengkap").val('<?= @$visit['org_unit_code']; ?>')
        $("#doctor-laporanAnesthesi-lengkap").val('<?= @@$visit['fullname']; ?>')
        $("#kal_id-laporanAnesthesi-lengkap").val('<?= @$visit['kal_id']; ?>')
        $("#theid-laporanAnesthesi-lengkap").val('<?= @$visit['pasien_id']; ?>')
        $("#thename-laporanAnesthesi-lengkap").val('<?= @$visit['diantar_oleh']; ?>')
        $("#theaddress-laporanAnesthesi-lengkap").val('<?= @$visit['visitor_address']; ?>')
        $("#status_pasien_id-laporanAnesthesi-lengkap").val('<?= @$visit['status_pasien_id']; ?>')
        $("#isrj-laporanAnesthesi-lengkap").val('<?= @$visit['isrj']; ?>')
        $("#gender-laporanAnesthesi-lengkap").val('<?= @$visit['gender']; ?>')
        $("#ageyear-laporanAnesthesi-lengkap").val('<?= @$visit['ageyear']; ?>')
        $("#agemonth-laporanAnesthesi-lengkap").val('<?= @$visit['agemonth']; ?>')
        $("#ageday-laporanAnesthesi-lengkap").val('<?= @$visit['ageday']; ?>')
        $("#flatexamination_date-laporanAnesthesi-lengkap").val(moment(get_date()).format("DD/MM/YYYY HH:mm"))
        $("#examination_date-laporanAnesthesi-lengkap").val(moment(get_date()).format("YYYY-MM-DD HH:mm"))


        $("#" + container_id).slideDown()


        postData({
                visit_id: '<?= @$visit['visit_id']; ?>',
                account_id: '13'
            }, 'admin/PatientOperationRequest/getExaminfoTop',
            (res) => {

                let exam_info = res.examInfo || {};

                $("#vs_status_id-laporanAnesthesi-lengkap").val(exam_info?.vs_status_id ?? "")
                $('#weight-laporanAnesthesi-lengkap').val(exam_info?.weight || 0);
                $('#height-laporanAnesthesi-lengkap').val(exam_info?.height || 0);
                $('#temperature-laporanAnesthesi-lengkap').val(exam_info?.temperature || 0);
                $('#nadi-laporanAnesthesi-lengkap').val(exam_info?.nadi || 0);
                $('#tension_upper-laporanAnesthesi-lengkap').val(exam_info?.tension_upper || 0);
                $('#tension_below-laporanAnesthesi-lengkap').val(exam_info?.tension_below || 0);
                $('#saturasi-laporanAnesthesi-lengkap').val(exam_info?.saturasi || 0);
                $('#nafas-laporanAnesthesi-lengkap').val(exam_info?.nafas || 0);
            }
        );


        $("#sembunyikanVtLaporanAnesthesiLengkap3Show").show()
        $("#tambahVtLaporanAnesthesiLengkap3Show").hide()
    }
    const addRowVitalSigncatatanLaporanAnesthesiLengkap2 = (examselect, key, container_id, account_id = null, element) => {
        let examinationDate = examselect.examination_date ? examselect.examination_date.substring(0, 16) : 'N/A';
        $('#' + container_id).append($("<tr>")
                .append($("<td rowspan='2'>").append(examinationDate))
                .append($("<td rowspan='2'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='2'>").html(
                    '<button type="button" onclick="copyvitalSignLaporanAnesthesiLengkap2(\'' + btoa(JSON.stringify(
                        examselect)).replace(/'/g, "\\'") + '\', ' + key +
                    ')" class="btn btn-success" data-row-id="1" autocomplete="off" ' +
                    (account_id == '12' ? 'style="display:none;"' : 'style="display:block;"') +
                    '><i class="fa fa-copy"></i> Copy</button>'
                ))
                .append($("<td rowspan='2'>").html(
                    '<button type="button" onclick="removeLaporanAnesthesiLengkap2(\'' + examselect.body_id +
                    '\', \'' +
                    '12' + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off" ' +
                    (account_id == '12' ? 'style="display:none;"' : '') +
                    '><i class="fa fa-trash"></i></button>'
                ))
            )
            .append($("<tr>")
                .append($("<td>").html(''))
                .append($("<td>").html(examselect.tension_upper + '/' + examselect.tension_below + 'mmHg'))
                .append($("<td>").html(examselect.nadi + '/menit'))
                .append($("<td>").html(examselect.nafas + '/menit'))
                .append($("<td>").html(examselect.temperature + '/°C'))
                .append($("<td>").html(examselect.saturasi + '/SpO2%'))
            );

    }

    function removeLaporanAnesthesiLengkap2(id, account_id = null) {

        postData({
            body_id: id,
            account_id: account_id
        }, 'admin/PatientOperationRequest/deleteExamDetail', (res) => {
            successSwal('berhasil.');

            // getVitalSignLaporanAnesthesiLengkap2('vitalSignBodyLaporanAnesthesiLengkap2', account_id)
        })
    }

    function copyvitalSignLaporanAnesthesiLengkap2(data, key) {
        let dataExam = JSON.parse(atob(data));
        var examselect = vitalsign[key];

        var bodyId = ''
        const nowtime = moment(dataExam.examination_date).format("DD/MM/YYYY HH:mm");
        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#ageday-laporanAnesthesi-lengkap").val(dataExam.ageday)
        $("#agemonth-laporanAnesthesi-lengkap").val(dataExam.agemonth)
        $("#ageyear-laporanAnesthesi-lengkap").val(dataExam.ageyear)
        $("#anamnase-laporanAnesthesi-lengkap").val(dataExam.anamnase)
        $("#bed_id-laporanAnesthesi-lengkap").val(dataExam.bed_id)
        // $("#body_id-laporanAnesthesi-lengkap").val(dataExam.body_id)
        $("#class_room_id-laporanAnesthesi-lengkap").val(dataExam.class_room_id)
        $("#clinic_id-laporanAnesthesi-lengkap").val(dataExam.clinic_id)
        $("#description-laporanAnesthesi-lengkap").val(dataExam.description)
        $("#doctor-laporanAnesthesi-lengkap").val(dataExam.doctor)
        $("#employee_id-laporanAnesthesi-lengkap").val(dataExam.employee_id)
        $("#flatexamination_date-laporanAnesthesi-lengkap").val(nowtime).trigger("change")
        $("#gender-laporanAnesthesi-lengkap").val(dataExam.gender)
        $("#height-laporanAnesthesi-lengkap").val(dataExam.height)
        $("#instruction-laporanAnesthesi-lengkap").val(dataExam.instruction)
        $("#isrj-laporanAnesthesi-lengkap").val(dataExam.isrj)
        $("#kal_id-laporanAnesthesi-lengkap").val(dataExam.kal_id)
        $("#keluar_id-laporanAnesthesi-lengkap").val(dataExam.keluar_id)
        $("#nadi-laporanAnesthesi-lengkap").val(dataExam.nadi)
        $("#nafas-laporanAnesthesi-lengkap").val(dataExam.nafas)
        $("#no_registraiton-laporanAnesthesi-lengkap").val(dataExam.no_registraiton)
        $("#org_unit_code-laporanAnesthesi-lengkap").val(dataExam.org_unit_code)
        $("#vs_status_id-laporanAnesthesi-lengkap").val(dataExam.vs_status_id)
        $("#pemeriksaan-laporanAnesthesi-lengkap").val(dataExam.pemeriksaan)
        $("#petugas-laporanAnesthesi-lengkap").val(dataExam.petugas)
        $("#saturasi-laporanAnesthesi-lengkap").val(dataExam.saturasi)
        $("#status_pasien_id-laporanAnesthesi-lengkap").val(dataExam.status_pasien_id)
        $("#temperature-laporanAnesthesi-lengkap").val(dataExam.temperature)
        $("#tension_below-laporanAnesthesi-lengkap").val(dataExam.tension_below)
        $("#tension_upper-laporanAnesthesi-lengkap").val(dataExam.tension_upper)
        $("#teraphy_desc-laporanAnesthesi-lengkap").val(dataExam.teraphy_desc)
        $("#theaddress-laporanAnesthesi-lengkap").val(dataExam.theaddress)
        $("#theid-laporanAnesthesi-lengkap").val(dataExam.pasien_id)
        $("#thename-laporanAnesthesi-lengkap").val(dataExam.diantar_oleh)
        $("#visit_id-laporanAnesthesi-lengkap").val(dataExam.visit_id)
        $("#weight-laporanAnesthesi-lengkap").val(dataExam.weight)

        $("#org_unit_code-laporanAnesthesi-lengkap").val(dataExam.org_unit_code)
        $("#no_registration-laporanAnesthesi-lengkap").val(dataExam.no_registration)
        $("#visit_id-laporanAnesthesi-lengkap").val(dataExam.visit_id)
        $("#trans_id-laporanAnesthesi-lengkap").val(dataExam.trans_id) //==new
        $("#bill_id-laporanAnesthesi-lengkap").val(dataExam.bill_id)
        $("#class_room_id-laporanAnesthesi-lengkap").val(dataExam.class_room_id)
        $("#bed_id-laporanAnesthesi-lengkap").val(dataExam.bed_id)
        $("#in_date-laporanAnesthesi-lengkap").val(dataExam.in_date)
        $("#exit_date-laporanAnesthesi-lengkap").val(dataExam.exit_date)
        $("#keluar_id-laporanAnesthesi-lengkap").val(dataExam.keluar_id)
        $("#imt_score-laporanAnesthesi-lengkap").val(dataExam.imt_score)
        $("#imt_desc-laporanAnesthesi-lengkap").val(dataExam.imt_desc)
        $("#pemeriksaan-laporanAnesthesi-lengkap").val(dataExam.pemeriksaan)
        $("#medical_treatment-laporanAnesthesi-lengkap").val(dataExam.medical_treatment)
        $("#modified_date-laporanAnesthesi-lengkap").val(dataExam.modified_date)
        $("#modified_by-laporanAnesthesi-lengkap").val(dataExam.modified_by)
        $("#modified_from-laporanAnesthesi-lengkap").val(dataExam.modified_from)
        $("#status_pasien_id-laporanAnesthesi-lengkap").val(dataExam.status_pasien_id)
        $("#ageyear-laporanAnesthesi-lengkap").val(dataExam.ageyear)
        $("#agemonth-laporanAnesthesi-lengkap").val(dataExam.agemonth)
        $("#ageday-laporanAnesthesi-lengkap").val(dataExam.ageday)
        $("#thename-laporanAnesthesi-lengkap").val(dataExam.thename)
        $("#theaddress-laporanAnesthesi-lengkap").val(dataExam.theaddress)
        $("#theid-laporanAnesthesi-lengkap").val(dataExam.theid)
        $("#isrj-laporanAnesthesi-lengkap").val(dataExam.isrj)
        $("#gender-laporanAnesthesi-lengkap").val(dataExam.gender)
        $("#doctor-laporanAnesthesi-lengkap").val(dataExam.doctor)
        $("#kal_id-laporanAnesthesi-lengkap").val(dataExam.kal_id)
        $("#petugas_id-laporanAnesthesi-lengkap").val(dataExam.petugas_id)
        $("#petugas-laporanAnesthesi-lengkap").val(dataExam.petugas)
        $("#account_id-laporanAnesthesi-lengkap").val(dataExam.account_id)
        $("#kesadaran-laporanAnesthesi-lengkap").val(dataExam.kesadaran)
        $("#isvalid-laporanAnesthesi-lengkap").val(dataExam.isvalid)

        $("#anamnase-laporanAnesthesi-lengkap").val(dataExam.anamnase)
        $("#description-laporanAnesthesi-lengkap").val(dataExam.description)
        $("#weight-laporanAnesthesi-lengkap").val(dataExam.weight).trigger("change")
        $("#height-laporanAnesthesi-lengkap").val(dataExam.height).trigger("change")
        $("#temperature-laporanAnesthesi-lengkap").val(dataExam.temperature).trigger("change")
        $("#nadi-laporanAnesthesi-lengkap").val(dataExam.nadi).trigger("change")
        $("#tension_upper-laporanAnesthesi-lengkap").val(dataExam.tension_upper).trigger("change")
        $("#tension_lower-laporanAnesthesi-lengkap").val(dataExam.tension_lower).trigger("change")
        $("#saturasi-laporanAnesthesi-lengkap").val(dataExam.saturasi).trigger("change")
        $("#nafas-laporanAnesthesi-lengkap").val(dataExam.nafas).trigger("change")
        $("#vs_status_id-laporanAnesthesi-lengkap").val(dataExam.vs_status_id).trigger("change")
        $("#pemeriksaan-laporanAnesthesi-lengkap").val(dataExam.pemeriksaan).trigger("change")

        $("#vitalSignLaporanAnesthesi-lengkap").slideDown()


    }

    function getVitalSignLaporanAnesthesiLengkap2(container_id, account_id) { //bisma

        $.ajax({
            url: '<?php echo base_url(); ?>admin/PatientOperationRequest/getExaminfo',
            type: "POST",
            data: JSON.stringify({
                'visit_id': `${visit.visit_id}`,
                'nomor': `${nomor}`,
                'account_id': `${account_id}`
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                if (data.examInfo.length > 0) {
                    vitalsign = data.examInfo
                    $("#" + container_id).html("")
                    vitalsign.forEach((element, key) => {
                        examselect = vitalsign[key];
                        addRowVitalSigncatatanLaporanAnesthesiLengkap2(examselect, key, container_id,
                            account_id, element)
                    });
                } else {
                    $("#" + container_id).html("")

                }

            },
            error: function() {

            }
        });
    }
</script>