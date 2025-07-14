<?php if (!empty($fisio['value']['fisioterapi'])): ?>
    <div class="page-break portrait">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png"
                            width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3 class="kop-name text-center" id="kop-name">
                            <?= @$kop['name_of_org_unit'] ?>
                        </h3>
                        <p class="kop-address text-center" id="kop-address">
                            <?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2"
                            src="<?= base_url() ?>assets/img/paripurna.png"
                            width="100px">

                    </div>
                </div>
                <br>
                <div
                    style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
                </div>
                <div class="row">
                    <h3 class="text-center pt-2 fw-bold">Formulir Klaim Rawat Jalan
                        KFR</h3>
                </div>
                <div class="row">
                    <h5 class="text-start">Informasi Pasien</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 50%;">
                                <b>No. RM / Nama Pasien / Jenis Kelamin</b>
                                <p class="p-1"><?= @$visit['no_registration'] . ' / ' . @$visit['diantar_oleh'] . ' / ' . @$visit['name_of_gender']  ?></p>
                            </td>
                            <td style="width: 50%;">
                                <b>Tanggal Masuk</b>
                                <p class="p-1"><?= tanggal_indo(substr(@$visit['visit_date'], 0, 10)) ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                <b>Tanggal Lahir (Umur)</b>
                                <p class="p-1"><?= tanggal_indo(substr($visit['tgl_lahir'], 0, 10)) . ' (' . @$visit['age'] . ')'; ?></p>
                            </td>
                            <td style="width: 50%;">
                                <b>Alamat</b>
                                <p class="p-1"><?= @$visit['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                <b>DPJP</b>
                                <p class="p-1"><?= @$visit['fullname']; ?></p>
                            </td>
                            <td style="width: 50%;">
                                <b>Department</b>
                                <p class="p-1"><?= @$visit['name_of_clinic']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="p-3">
                    <div class="row">
                        <div class="col-6">
                            <p><strong>I. Diisi oleh Pasien/Peserta</strong></p>
                        </div>
                        <div class="col-6 text-end">
                            <p><strong>No. RM/Reg :</strong>
                                <?= $visit['no_registration'] ?>
                            </p>
                        </div>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="padding: 5px; width: 200px;"><strong>Nama
                                        Pasien</strong></td>
                                <td style="padding: 5px;">
                                    <?= @$visit['diantar_oleh'] ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;"><strong>Tanggal
                                        Lahir</strong></td>
                                <td style="padding: 5px;">
                                    <?= @$visit['date_of_birth'] ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;"><strong>Alamat</strong>
                                </td>
                                <td style="padding: 5px;">
                                    <?= @$visit['contact_address'] ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;"><strong>Telp/HP</strong>
                                </td>
                                <td style="padding: 5px;">
                                    <?= @$visit['phone_number'] ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;"><strong>Hubungan dengan
                                        bertanggung</strong></td>
                                <td style="padding: 5px;">
                                    <?= @$visit['family_notes'] ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <form id="form-fisioterapi-data">
                    <input id="vactination_date-fisio-val" name="vactination_date"
                        placeholder="" type="hidden" class="form-control block" />

                    <input id="org_unit_code-val" name="org_unit_code"
                        placeholder="" type="hidden" class="form-control block" />
                    <input id="vactination_id-fisio-val" name="vactination_id"
                        placeholder="" type="hidden" class="form-control block" />
                    <input id="no_registration-fisio-val" name="no_registration"
                        placeholder="" type="hidden" class="form-control block" />
                    <input id="visit_id-fisio-val" name="visit_id" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="bill_id-fisio-val" name="bill_id" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="clinic_id-fisio-val" name="clinic_id" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="terlayani-fisio-val" name="terlayani" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="employee_id-fisio-val" name="employee_id"
                        placeholder="" type="hidden" class="form-control block" />
                    <input id="patient_category_id-fisio-val"
                        name="patient_category_id" placeholder="" type="hidden"
                        class="form-control block" />
                    <input id="tarif_id-fisio-val" name="tarif_id" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="validation-fisio-val" name="validation"
                        placeholder="" type="hidden" class="form-control block" />
                    <input id="description-fisio-val" name="description"
                        placeholder="" type="hidden" class="form-control block" />
                    <input id="thename-fisio-val" name="thename" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="theaddress-fisio-val" name="theaddress"
                        placeholder="" type="hidden" class="form-control block" />
                    <input id="theid-fisio-val" name="theid" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="isrj-fisio-val" name="isrj" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="ageyear-fisio-val" name="ageyear" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="agemonth-fisio-val" name="agemonth" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="ageday-fisio-val" name="ageday" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="status_pasien_id-fisio-val" name="status_pasien_id"
                        placeholder="" type="hidden" class="form-control block" />
                    <input id="gender-fisio-val" name="gender" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="doctor-fisio-val" name="doctor" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="kal_id-fisio-val" name="kal_id" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="class_room_id-fisio-val" name="class_room_id"
                        placeholder="" type="hidden" class="form-control block" />
                    <input id="bed_id-fisio-val" name="bed_id" placeholder=""
                        type="hidden" class="form-control block" />
                    <input id="tarif_name-fisio-val" name="tarif_name"
                        placeholder="" type="hidden" class="form-control block" />
                    <input id="terapi_desc-fisio-val" name="terapi_desc"
                        placeholder="" type="hidden" class="form-control block" />

                    <div class="p-3 mt-3">
                        <p><strong>II. Diisi oleh Dokter Sp.KFR</strong></p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="padding: 5px; width: 200px;">
                                        <strong>Tanggal Pelayanan</strong>
                                    </td>
                                    <td id="vactination_date-fisio"
                                        style="padding: 5px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">
                                        <strong>Anamnesa</strong>
                                    </td>
                                    <td id="anamnase-output-fisio"
                                        style="padding: 5px;">

                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"><strong>Pemeriksaan
                                            Fisik dan Uji</strong></td>
                                    <td style="padding: 5px;"
                                        id="diagnosis-fungsi-output-fisio">
                                        <!-- <input type="text"
                                                                                class="form-control print-hidden-form"
                                                                                id="vas-fisio" name="vas"> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">
                                        <strong>Fungsi</strong>
                                    </td>
                                    <td style="padding: 5px;">
                                        <input type="text"
                                            class="form-control print-hidden-form"
                                            id="functions-fisio" name="functions">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"><strong>Diagnosis
                                            Medis (ICD-10)</strong></td>
                                    <td id="diagnosis-medis-output-fisio"
                                        style="padding: 5px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"><strong>Diagnosis
                                            Fungsi (ICD-10)</strong></td>
                                    <td id="diagnosis-fungsi-output-fisios"
                                        style="padding: 5px;">
                                        <select id="diagnosa_fungsi"
                                            name="diagnosa_fungsi"
                                            class="form-control print-hidden-form">
                                            <option value="" selected></option>
                                            <option value="Gangguan Nyeri Kronis">
                                                Gangguan Nyeri Kronis</option>
                                            <option value="Gangguan Nyeri Akut">
                                                Gangguan Nyeri Akut</option>
                                            <option value="Gangguan Pola Jalan">
                                                Gangguan Pola Jalan</option>
                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h5 class="fw-bold">Tindakan Penunjang </h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"><strong>Goal
                                            Terapi</strong></td>
                                    <td style="padding: 5px;">
                                        <input type="text"
                                            class="form-control print-hidden-form"
                                            id="goal-fisio" name="teraphy_goal">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"><strong>Pelaksanaan
                                            KFR
                                            (ICD 9 CM)</strong></td>
                                    <td style="padding: 5px;">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="ultrasound_checkbox-fisio"
                                                name="ultrasound_checkbox"
                                                class="form-check-input">
                                            <label for="ultrasound_checkbox-fisio"
                                                class="form-check-label">Ultrasound</label>
                                            <input type="text" id="ultrasound-fisio"
                                                name="ultrasound"
                                                class="form-control print-hidden-form"
                                                style="display:none;">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="tens_checkbox-fisio"
                                                name="tens_checkbox"
                                                class="form-check-input">
                                            <label for="tens_checkbox-fisio"
                                                class="form-check-label">TENS</label>
                                            <input type="text" id="tens-fisio"
                                                name="tens"
                                                class="form-control print-hidden-form"
                                                style="display:none;">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="exercise_checkbox-fisio"
                                                name="exercise_checkbox"
                                                class="form-check-input">
                                            <label for="exercise_checkbox-fisio"
                                                class="form-check-label">Exercise</label>
                                            <input type="text" id="exercise-fisio"
                                                name="exercise"
                                                class="form-control print-hidden-form"
                                                style="display:none;">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="infrared_checkbox-fisio"
                                                name="infrared_checkbox"
                                                class="form-check-input">
                                            <label for="infrared_checkbox-fisio"
                                                class="form-check-label">Infrared</label>
                                            <input type="text" id="infrared-fisio"
                                                name="infrared"
                                                class="form-control print-hidden-form"
                                                style="display:none;">
                                        </div>
                                        <!-- ==================================== -->
                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="swd_checkbox-fisio"
                                                name="swd_checkbox"
                                                class="form-check-input">
                                            <label for="swd_checkbox-fisio"
                                                class="form-check-label">SWD</label>
                                            <input type="text" id="swd-fisio"
                                                name="swd"
                                                class="form-control print-hidden-form"
                                                style="display:none;">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="mwd_checkbox-fisio"
                                                name="mwd_checkbox"
                                                class="form-check-input">
                                            <label for="mwd_checkbox-fisio"
                                                class="form-check-label">MWD</label>
                                            <input type="text" id="mwd-fisio"
                                                name="mwd"
                                                class="form-control print-hidden-form"
                                                style="display:none;">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="eswt_checkbox-fisio"
                                                name="eswt_checkbox"
                                                class="form-check-input">
                                            <label for="eswt_checkbox-fisio"
                                                class="form-check-label">ESWT</label>
                                            <input type="text" id="eswt-fisio"
                                                name="eswt"
                                                class="form-control print-hidden-form"
                                                style="display:none;">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="laser_checkbox-fisio"
                                                name="laser_checkbox"
                                                class="form-check-input">
                                            <label for="laser_checkbox-fisio"
                                                class="form-check-label">Laser</label>
                                            <input type="text" id="laser-fisio"
                                                name="laser"
                                                class="form-control print-hidden-form"
                                                style="display:none;">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="elektrikal_stimulasi_checkbox-fisio"
                                                name="elektrikal_stimulasi_checkbox"
                                                class="form-check-input">
                                            <label
                                                for="elektrikal_stimulasi_checkbox-fisio"
                                                class="form-check-label">ES (
                                                elektrikal stimulasi)</label>
                                            <input type="text"
                                                id="elektrikal_stimulasi-fisio"
                                                name="elektrikal_stimulasi"
                                                class="form-control print-hidden-form"
                                                style="display:none;">
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="other_checkbox-fisio"
                                                name="other_checkbox"
                                                class="form-check-input">
                                            <label for="other_checkbox-fisio"
                                                class="form-check-label">Lain-lain:</label>
                                            <input type="text" id="other_desc-fisio"
                                                name="other_desc"
                                                class="form-control print-hidden-form"
                                                style="display:none;">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">
                                        <strong>Anjuran</strong>
                                    </td>
                                    <td style="padding: 5px;">
                                        <input type="text"
                                            class="form-control print-hidden-form"
                                            id="suggestion-fisio" name="suggestion">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">
                                        <strong>Evaluasi</strong>
                                    </td>
                                    <td style="padding: 5px;">
                                        <input type="number"
                                            class="form-control print-hidden-form"
                                            id="evaluation_qty-fisio"
                                            name="evaluation_qty" min="0"
                                            style="width: 100px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"><strong>Suspek
                                            Penyakit akibat Kerja</strong></td>
                                    <td style="padding: 5px;">
                                        <div class="form-check">
                                            <input type="radio"
                                                id="suspect_yes-fisio"
                                                name="suspect_worker-radio"
                                                value="1" class="form-check-input">
                                            <label for="suspect_yes-fisio"
                                                class="form-check-label">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio"
                                                id="suspect_no-fisio"
                                                name="suspect_worker-radio"
                                                value="0" class="form-check-input"
                                                checked>
                                            <label for="suspect_no-fisio"
                                                class="form-check-label">Tidak</label>
                                        </div>
                                        <div id="suspect_details_container-fisio"
                                            style="display:none;">
                                            <label
                                                for="suspect_worker-fisio">Detail:</label>
                                            <input type="text"
                                                class="form-control print-hidden-form"
                                                id="suspect_worker-fisio"
                                                name="suspect_worker">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </form>



                <div class="row mb-2 hidden-show-ttd" hidden>
                    <div class="col-3" align="center">
                        <br>
                        <div>Pasien</div>
                        <div>
                            <div id="qrcode-fisio-pasien"></div>
                        </div>
                        <div id="qrcode-fisio-pasien_name"></div>
                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>
                            <div id="datetime-now" class="datetime-now"></div><br>
                            Dokter Penanggungjawab
                        </div>
                        <div>
                            <div class="pt-2 pb-2" id="qrcode-fisio-dokter"></div>
                        </div>
                        <div id="qrcode-fisio-dokter_name"></div>
                    </div>
                </div>

            </div>
        </body>
    </div>
<?php endif; ?>