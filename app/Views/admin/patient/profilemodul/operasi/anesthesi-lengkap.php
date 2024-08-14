<div class="tab-pane fade" id="anesthesi-lengkap">
    <form action="" id="form-laporanAnesthesi-lengkap">
        <input id="avtclinic_id-laporanAnesthesi-lengkap" name="clinic_id" placeholder="" type="hidden"
            class="form-control block" value="<?= $visit['clinic_id']; ?>" />
        <input id="avtclass_room_id-laporanAnesthesi-lengkap" name="class_room_id" placeholder="" type="hidden"
            class="form-control block" value="<?= $visit['class_room_id']; ?>" />
        <input id="avtbed_id-laporanAnesthesi-lengkap" name="bed_id" placeholder="" type="hidden"
            class="form-control block" value="<?= $visit['bed_id']; ?>" />
        <input id="avtkeluar_id-laporanAnesthesi-lengkap" name="keluar_id" placeholder="" type="hidden"
            class="form-control block" value="<?= $visit['keluar_id']; ?>" />
        <input id="avtemployee_id-laporanAnesthesi-lengkap" name="employee_id" placeholder="" type="hidden"
            class="form-control block" value="<?= $visit['employee_id']; ?>" />
        <input id="avtno_registration-laporanAnesthesi-lengkap" name="no_registration" placeholder="" type="hidden"
            class="form-control block" value="<?= $visit['no_registration']; ?>" />
        <input id="avtvisit_id-laporanAnesthesi-lengkap" name="visit_id" placeholder="" type="hidden"
            class="form-control block" value="<?= $visit['visit_id']; ?>" />
        <input id="avtorg_unit_code-laporanAnesthesi-lengkap" name="org_unit_code" placeholder="" type="hidden"
            class="form-control block" value="<?= $visit['org_unit_code']; ?>" />
        <input id="avtdoctor-laporanAnesthesi-lengkap" name="doctor" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['doctor'] ?? $visit['fullname']; ?>" />
        <input id="avtkal_id-laporanAnesthesi-lengkap" name="kal_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['kal_id']; ?>" />
        <input id="avttheid-laporanAnesthesi-lengkap" name="theid" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['theid']; ?>" />
        <input id="avtthename-laporanAnesthesi-lengkap" name="thename" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['theid']; ?>" />
        <input id="avttheaddress-laporanAnesthesi-lengkap" name="theaddress" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['theid']; ?>" />
        <input id="avtstatus_pasien_id-laporanAnesthesi-lengkap" name="status_pasien_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['status_pasien_id']; ?>" />
        <input id="avtisrj-laporanAnesthesi-lengkap" name="isrj" placeholder="" type="hidden" class="form-control block"
            value="<?= @$visit['isrj']; ?>" />
        <input id="avtgender-laporanAnesthesi-lengkap" name="gender" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['gender']; ?>" />
        <input id="avtageyear-laporanAnesthesi-lengkap" name="ageyear" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['ageyear']; ?>" />
        <input id="avtagemonth-laporanAnesthesi-lengkap" name="agemonth" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['agemonth']; ?>" />
        <input id="avtageday-laporanAnesthesi-lengkap" name="ageday" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['ageday']; ?>" />
        <input id="avtbody_id-laporanAnesthesi-lengkap" name="body_id" placeholder="" type="hidden"
            class="form-control block" value="" />
        <input id="avtmodified_by-laporanAnesthesi-lengkap" name="modified_by" placeholder="" type="hidden"
            class="form-control block" value="<?= user()->username ?>" />
        <input id="avttrans_id-laporanAnesthesi-lengkap" name="trans_id" placeholder="" type="hidden"
            class="form-control block" value="<?= @$visit['trans_id']; ?>" />
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
                                                <td><span id=""><?= @$visit['name_of_pasien'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>ID (KTP)</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @$visit['account_id'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Gender</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @$visit['gendername'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Date of Birth</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @$visit['date_of_birth'] ?? '' ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Patient Age</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @$visit['age'] ?></span></td>
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
                                                <td><span id=""><?= @$visit['name_of_clinic_from'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Dokter DPJP</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @$visit['fullname'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Ward/Room</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @$visit['name_of_clinic'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Bed No</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @$visit['bed'] ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><b>Room Class</b></td>
                                                <td width="1%">:</td>
                                                <td><span id=""><?= @$visit['class_id'] ?></span></td>
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
                                <h3 id="">
                                    <b>Vital Sign</b>
                                </h3>
                                <div class="col-xs-6 col-sm-6 col-md-12">
                                    <div class="row mb-2">
                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label>Jenis EWS</label>
                                                <select class="form-select" name="vs_status_id"
                                                    id="avtvs_status_id-laporanAnesthesi-lengkap" disabled>
                                                    <option selected>-- pilih --</option>
                                                    <option value="1">Dewasa</option>
                                                    <option value="4">Anak</option>
                                                    <option value="5">Neonatus</option>
                                                    <option value="10">Obstric</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label>BB(Kg)</label>
                                                <div class=" position-relative">
                                                    <input type="text" name="weight"
                                                        id="avtweight-laporanAnesthesi-lengkap" placeholder="" value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap"
                                                        disabled>
                                                    <span class="h6" id="badge-bb-laporanAnesthesi-lengkap"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label>Tinggi(cm)</label>
                                                <div class="position-relative">
                                                    <input type="text" name="height"
                                                        id="avtheight-laporanAnesthesi-lengkap" placeholder="" value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap"
                                                        disabled>
                                                    <span class="h6"
                                                        id="badge-avtheight-laporanAnesthesi-lengkap"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label>Suhu(°C)</label>
                                                <div class="position-relative">
                                                    <input type="text" name="temperature"
                                                        id="avttemperature-laporanAnesthesi-lengkap" placeholder=""
                                                        value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap"
                                                        disabled>
                                                    <span class="h6"
                                                        id="badge-avttemperature-laporanAnesthesi-lengkap"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                            <div class="form-group">
                                                <label>Nadi(/menit)</label>
                                                <div class="position-relative">
                                                    <input type="text" name="nadi" id="avtnadi-laporanAnesthesi-lengkap"
                                                        placeholder="" value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap"
                                                        disabled>
                                                    <span class="h6" id="badge-avtnadi-laporanAnesthesi-lengkap"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                    <div class="position-relative">
                                                        <input type="text" name="tension_upper"
                                                            id="avttension_upper-laporanAnesthesi-lengkap"
                                                            placeholder="" value=""
                                                            class="form-control vitalsignclass-laporanAnesthesi-lengkap"
                                                            disabled>
                                                        <span class="h6"
                                                            id="badge-avttension_upper-laporanAnesthesi-lengkap"></span>
                                                    </div>
                                                    <h4 class="mx-2">/</h4>
                                                    <div class="position-relative">
                                                        <input type="text" name="tension_below"
                                                            id="avttension_below-laporanAnesthesi-lengkap"
                                                            placeholder="" value=""
                                                            class="form-control vitalsignclass-laporanAnesthesi-lengkap"
                                                            disabled>
                                                        <span class="h6"
                                                            id="badge-avttension_below-laporanAnesthesi-lengkap"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label>Saturasi(SpO2%)</label>
                                                <div class="position-relative">
                                                    <input type="text" name="saturasi"
                                                        id="avtsaturasi-laporanAnesthesi-lengkap" placeholder=""
                                                        value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap"
                                                        disabled>
                                                    <span class="h6"
                                                        id="badge-avtsaturasi-laporanAnesthesi-lengkap"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label>Nafas/RR(/menit)</label>
                                                <div class="position-relative">
                                                    <input type="text" name="nafas"
                                                        id="avtnafas-laporanAnesthesi-lengkap" placeholder="" value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap"
                                                        disabled>
                                                    <span class="h6"
                                                        id="badge-avtnafas-laporanAnesthesi-lengkap"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label>Diameter Lengan(cm)</label>
                                                <div class="position-relative">
                                                    <input type="text" name="arm_diameter"
                                                        id="avtarm_diameter-laporanAnesthesi-lengkap" placeholder=""
                                                        value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap"
                                                        disabled>
                                                    <span class="h6"
                                                        id="badge-avtarm_diameter-laporanAnesthesi-lengkap"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label>Penggunaan Oksigen (L/mnt)</label>
                                                <div class="position-relative">
                                                    <input type="text" name="oxygen_usage"
                                                        id="avtoxygen_usage-laporanAnesthesi-lengkap" placeholder=""
                                                        value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap"
                                                        disabled>
                                                    <span class="h6"
                                                        id="badge-avtoxygen_usage-laporanAnesthesi-lengkap"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mt-2">
                                            <div class="form-group">
                                                <label>Pemeriksaan</label><textarea name="pemeriksaan"
                                                    id="avtpemeriksaan-laporanAnesthesi-lengkap" placeholder="" value=""
                                                    class="form-control" disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="row mb-4">
                            <hr>
                            <h3 id="">
                                <b>Vital Sign</b>
                            </h3>
                            <div class="col-xs-6 col-sm-6 col-md-12">
                                <div class="row mb-2">
                                    <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Jenis EWS</label>
                                            <select class="form-select" name="vs_status_id"
                                                id="avtvs_status_id-laporanAnesthesi-lengkap-durante">
                                                <option selected>-- pilih --</option>
                                                <option value="1">Dewasa</option>
                                                <option value="4">Anak</option>
                                                <option value="5">Neonatus</option>
                                                <option value="10">Obstric</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>BB(Kg)</label>
                                            <div class=" position-relative">
                                                <input type="text" name="weight"
                                                    id="avtweight-laporanAnesthesi-lengkap-durante" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-durante">
                                                <span class="h6" id="badge-bb-laporanAnesthesi-lengkap-durante"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Tinggi(cm)</label>
                                            <div class="position-relative">
                                                <input type="text" name="height"
                                                    id="avtheight-laporanAnesthesi-lengkap-durante" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-durante">
                                                <span class="h6"
                                                    id="badge-avtheight-laporanAnesthesi-lengkap-durante"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Suhu(°C)</label>
                                            <div class="position-relative">
                                                <input type="text" name="temperature"
                                                    id="avttemperature-laporanAnesthesi-lengkap-durante" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-durante">
                                                <span class="h6"
                                                    id="badge-avttemperature-laporanAnesthesi-lengkap-durante"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                        <div class="form-group">
                                            <label>Nadi(/menit)</label>
                                            <div class="position-relative">
                                                <input type="text" name="nadi"
                                                    id="avtnadi-laporanAnesthesi-lengkap-durante" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-durante">
                                                <span class="h6"
                                                    id="badge-avtnadi-laporanAnesthesi-lengkap-durante"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                        <div class="form-group"><label>T.Darah(mmHg)</label>
                                            <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                <div class="position-relative">
                                                    <input type="text" name="tension_upper"
                                                        id="avttension_upper-laporanAnesthesi-lengkap-durante"
                                                        placeholder="" value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap-durante">
                                                    <span class="h6"
                                                        id="badge-avttension_upper-laporanAnesthesi-lengkap-durante"></span>
                                                </div>
                                                <h4 class="mx-2">/</h4>
                                                <div class="position-relative">
                                                    <input type="text" name="tension_below"
                                                        id="avttension_below-laporanAnesthesi-lengkap-durante"
                                                        placeholder="" value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap-durante">
                                                    <span class="h6"
                                                        id="badge-avttension_below-laporanAnesthesi-lengkap-durante"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Saturasi(SpO2%)</label>
                                            <div class="position-relative">
                                                <input type="text" name="saturasi"
                                                    id="avtsaturasi-laporanAnesthesi-lengkap-durante" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-durante">
                                                <span class="h6"
                                                    id="badge-avtsaturasi-laporanAnesthesi-lengkap-durante"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Nafas/RR(/menit)</label>
                                            <div class="position-relative">
                                                <input type="text" name="nafas"
                                                    id="avtnafas-laporanAnesthesi-lengkap-durante" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-durante">
                                                <span class="h6"
                                                    id="badge-avtnafas-laporanAnesthesi-lengkap-durante"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Diameter Lengan(cm)</label>
                                            <div class="position-relative">
                                                <input type="text" name="arm_diameter"
                                                    id="avtarm_diameter-laporanAnesthesi-lengkap-durante" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-durante">
                                                <span class="h6"
                                                    id="badge-avtarm_diameter-laporanAnesthesi-lengkap-durante"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Penggunaan Oksigen (L/mnt)</label>
                                            <div class="position-relative">
                                                <input type="text" name="oxygen_usage"
                                                    id="avtoxygen_usage-laporanAnesthesi-lengkap-durante" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-durante">
                                                <span class="h6"
                                                    id="badge-avtoxygen_usage-laporanAnesthesi-lengkap-durante"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-2">
                                        <div class="form-group">
                                            <label>Pemeriksaan</label><textarea name="pemeriksaan"
                                                id="avtpemeriksaan-laporanAnesthesi-lengkap-durante" placeholder=""
                                                value="" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-body" id="informasiMedis-laporan-monitoring-durante-date">
                    </div>
                    <div class="accordion-body" id="informasiMedis-laporan-monitoring-durante-2">
                    </div>
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
                        <div class="row mb-4">
                            <hr>
                            <h3><b>Vital Sign</b></h3>
                            <div class="col-md-12">
                                <div class="row mb-2">
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Jenis EWS</label>
                                            <select class="form-select" name="vs_status_id2"
                                                id="avtvs_status_id-laporanAnesthesi-lengkap-monitoring">
                                                <option selected>-- pilih --</option>
                                                <option value="1">Dewasa</option>
                                                <option value="4">Anak</option>
                                                <option value="5">Neonatus</option>
                                                <option value="10">Obstric</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>BB(Kg)</label>
                                            <div class="position-relative">
                                                <input type="text" name="weight2"
                                                    id="avtweight-laporanAnesthesi-lengkap-monitoring" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-monitoring">
                                                <span class="h6"
                                                    id="badge-bb-laporanAnesthesi-lengkap-monitoring"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Tinggi(cm)</label>
                                            <div class="position-relative">
                                                <input type="text" name="height2"
                                                    id="avtheight-laporanAnesthesi-lengkap-monitoring" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-monitoring">
                                                <span class="h6"
                                                    id="badge-avtheight-laporanAnesthesi-lengkap-monitoring"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Suhu(°C)</label>
                                            <div class="position-relative">
                                                <input type="text" name="temperature2"
                                                    id="avttemperature-laporanAnesthesi-lengkap-monitoring"
                                                    placeholder="" value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-monitoring">
                                                <span class="h6"
                                                    id="badge-avttemperature-laporanAnesthesi-lengkap-monitoring"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Nadi(/menit)</label>
                                            <div class="position-relative">
                                                <input type="text" name="nadi2"
                                                    id="avtnadi-laporanAnesthesi-lengkap-monitoring" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-monitoring">
                                                <span class="h6"
                                                    id="badge-avtnadi-laporanAnesthesi-lengkap-monitoring"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>T.Darah(mmHg)</label>
                                            <div class="d-flex align-items-center">
                                                <div class="position-relative">
                                                    <input type="text" name="tension_upper2"
                                                        id="avttension_upper-laporanAnesthesi-lengkap-monitoring"
                                                        placeholder="" value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap-monitoring">
                                                    <span class="h6"
                                                        id="badge-avttension_upper-laporanAnesthesi-lengkap-monitoring"></span>
                                                </div>
                                                <h4 class="mx-2">/</h4>
                                                <div class="position-relative">
                                                    <input type="text" name="tension_below2"
                                                        id="avttension_below-laporanAnesthesi-lengkap-monitoring"
                                                        placeholder="" value=""
                                                        class="form-control vitalsignclass-laporanAnesthesi-lengkap-monitoring">
                                                    <span class="h6"
                                                        id="badge-avttension_below-laporanAnesthesi-lengkap-monitoring"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Saturasi(SpO2%)</label>
                                            <div class="position-relative">
                                                <input type="text" name="saturasi2"
                                                    id="avtsaturasi-laporanAnesthesi-lengkap-monitoring" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-monitoring">
                                                <span class="h6"
                                                    id="badge-avtsaturasi-laporanAnesthesi-lengkap-monitoring"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Nafas/RR(/menit)</label>
                                            <div class="position-relative">
                                                <input type="text" name="nafas2"
                                                    id="avtnafas-laporanAnesthesi-lengkap-monitoring" placeholder=""
                                                    value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-monitoring">
                                                <span class="h6"
                                                    id="badge-avtnafas-laporanAnesthesi-lengkap-monitoring"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Diameter Lengan(cm)</label>
                                            <div class="position-relative">
                                                <input type="text" name="arm_diameter2"
                                                    id="avtarm_diameter-laporanAnesthesi-lengkap-monitoring"
                                                    placeholder="" value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-monitoring">
                                                <span class="h6"
                                                    id="badge-avtarm_diameter-laporanAnesthesi-lengkap-monitoring"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Penggunaan Oksigen (L/mnt)</label>
                                            <div class="position-relative">
                                                <input type="text" name="oxygen_usage2"
                                                    id="avtoxygen_usage-laporanAnesthesi-lengkap-monitoring"
                                                    placeholder="" value=""
                                                    class="form-control vitalsignclass-laporanAnesthesi-lengkap-monitoring">
                                                <span class="h6"
                                                    id="badge-avtoxygen_usage-laporanAnesthesi-lengkap-monitoring"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-2">
                                        <div class="form-group">
                                            <label>Pemeriksaan</label>
                                            <textarea name="pemeriksaan2"
                                                id="avtpemeriksaan-laporanAnesthesi-lengkap-monitoring" placeholder=""
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            <a href="" target="_blank" class="btn btn-success"><i class="fas fa-print"></i> Cetak</a>
            <button type="button" id="btn-save-laporan-anesthesiLengkap" class="btn btn-primary btn-save-operasi"><i
                    class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>

<script src="<?= base_url('assets/js/default.js') ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type='text/javascript'>
var mrJson;
var lastOrder = 0;
var vitalsign = <?= json_encode($exam); ?>;
var visit = '<?= $visit['visit_id']; ?>'
var nomor = '<?= $visit['no_registration']; ?>';

$(document).ready(function(e) {

    var nomor = '<?= $visit['no_registration']; ?>';
    var ke = '%'
    var mulai = '2023-08-01' //tidak terpakai
    var akhir = '2023-08-31' //tidak terpakai
    var lunas = '%'
    // var klinik = '<?= $visit['clinic_id']; ?>'
    var klinik = '%'
    var rj = '%'
    var status = '%'
    var nota = '%'
    var trans = '<?= $visit['trans_id']; ?>'
    var visit = '<?= $visit['visit_id']; ?>'

    var bodyIdLengkap = ''

    const date = new Date();
    bodyIdLengkap = date.toISOString().substring(0, 23);
    bodyIdLengkap = bodyIdLengkap.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T",
        "");
    $("#avtbody_id-laporanAnesthesi-lengkap").val(bodyIdLengkap)
})


$("#avtvs_status_id-laporanAnesthesi-lengkap").on("change", function() {
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
</script>