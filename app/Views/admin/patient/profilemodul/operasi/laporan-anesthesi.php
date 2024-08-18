<script src="<?= base_url('assets/js/default.js') ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="tab-pane fade " id="laporan-anesthesi">
    <form action="" id="form-laporan-anesthesi">
        <div id="accordionCatatan" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree1000">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree1000" aria-expanded="false" aria-controls="flush-collapseThree">
                        LAPORAN ANESTHESI & SEDASI
                    </button>
                </h2>
                <div id="flush-collapseThree1000" class="accordion-collapse collapse" aria-labelledby="flush-headingThree1000" data-bs-parent="#accordionCatatan">
                    <div class="accordion-body" id="informasiMedis-laporan">

                    </div>
                    <div class="card-body">
                        <form id="formvitalsign-laporanAnesthesi" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="modal-body pt0 pb0">
                                <input id="lapaneshclinic_id-laporanAnesthesi" name="clinic_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['clinic_id']; ?>" />
                                <input id="lapaneshclass_room_id-laporanAnesthesi" name="class_room_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['class_room_id']; ?>" />
                                <input id="lapaneshbed_id-laporanAnesthesi" name="bed_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['bed_id']; ?>" />
                                <input id="lapaneshkeluar_id-laporanAnesthesi" name="keluar_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['keluar_id']; ?>" />
                                <input id="lapaneshemployee_id-laporanAnesthesi" name="employee_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['employee_id']; ?>" />
                                <input id="lapaneshno_registration-laporanAnesthesi" name="no_registration" placeholder="" type="hidden" class="form-control block" value="<?= $visit['no_registration']; ?>" />
                                <input id="lapaneshvisit_id-laporanAnesthesi" name="visit_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['visit_id']; ?>" />
                                <input id="lapaneshorg_unit_code-laporanAnesthesi" name="org_unit_code" placeholder="" type="hidden" class="form-control block" value="<?= $visit['org_unit_code']; ?>" />
                                <input id="lapaneshdoctor-laporanAnesthesi" name="doctor" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['doctor'] ?? $visit['fullname']; ?>" />
                                <input id="lapaneshkal_id-laporanAnesthesi" name="kal_id" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['kal_id']; ?>" />
                                <input id="lapaneshtheid-laporanAnesthesi" name="theid" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['theid']; ?>" />
                                <input id="lapaneshthename-laporanAnesthesi" name="thename" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['theid']; ?>" />
                                <input id="lapaneshtheaddress-laporanAnesthesi" name="theaddress" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['theid']; ?>" />
                                <input id="lapaneshstatus_pasien_id-laporanAnesthesi" name="status_pasien_id" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['status_pasien_id']; ?>" />
                                <input id="lapaneshisrj-laporanAnesthesi" name="isrj" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['isrj']; ?>" />
                                <input id="lapaneshgender-laporanAnesthesi" name="gender" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['gender']; ?>" />
                                <input id="lapaneshageyear-laporanAnesthesi" name="ageyear" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['ageyear']; ?>" />
                                <input id="lapaneshagemonth-laporanAnesthesi" name="agemonth" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['agemonth']; ?>" />
                                <input id="lapaneshageday-laporanAnesthesi" name="ageday" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['ageday']; ?>" />
                                <input id="lapaneshbody_id-laporanAnesthesi" name="body_id_vt" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="lapaneshmodified_by-laporanAnesthesi" name="modified_by" placeholder="" type="hidden" class="form-control block" value="<?= user()->username ?>" />
                                <input id="lapaneshtrans_id-laporanAnesthesi" name="trans_id" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['trans_id']; ?>" />
                                <!--==new -->
                                <!-- <input id="lapaneshvs_status_id-laporanAnesthesi" name="vs_status_id" placeholder="" type="hidden" class="form-control block" value="" /> -->
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="lapaneshanamnase" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(S)
                                                    Anamnesis</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="lapaneshanamnase-laporanAnesthesi" name="anamnase" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <h3>
                                                    <b>Vital Sign</b>
                                                </h3>
                                                <hr>
                                                <label class="col-xs-6 col-sm-6 col-md-2 col-form-label">Pemeriksaan
                                                    Fisik</label>
                                                <div class="col-xs-6 col-sm-6 col-md-10">
                                                    <div class="row mb-2">
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>BB(Kg)</label>
                                                                <div class=" position-relative">
                                                                    <input type="text" name="weight" id="lapaneshweight-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass-laporanAnesthesi">
                                                                    <span class="h6" id="badge-bb-laporanAnesthesi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Tinggi(cm)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="height" id="lapaneshheight-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass-laporanAnesthesi">
                                                                    <span class="h6" id="badge-lapaneshheight-laporanAnesthesi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Suhu(°C)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="temperature" id="lapaneshtemperature-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass-laporanAnesthesi">
                                                                    <span class="h6" id="badge-lapaneshtemperature-laporanAnesthesi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                            <div class="form-group">
                                                                <label>Nadi(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="nadi" id="lapaneshnadi-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass-laporanAnesthesi">
                                                                    <span class="h6" id="badge-lapaneshnadi-laporanAnesthesi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                    <div class="position-relative">
                                                                        <input type="text" name="tension_upper" id="lapaneshtension_upper-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass-laporanAnesthesi">
                                                                        <span class="h6" id="badge-lapaneshtension_upper-laporanAnesthesi"></span>
                                                                    </div>
                                                                    <h4 class="mx-2">/</h4>
                                                                    <div class="position-relative">
                                                                        <input type="text" name="tension_below" id="lapaneshtension_below-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass-laporanAnesthesi">
                                                                        <span class="h6" id="badge-lapaneshtension_below-laporanAnesthesi"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Saturasi(SpO2%)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="saturasi" id="lapaneshsaturasi-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass-laporanAnesthesi">
                                                                    <span class="h6" id="badge-lapaneshsaturasi-laporanAnesthesi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Nafas/RR(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="nafas" id="lapaneshnafas-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass-laporanAnesthesi">
                                                                    <span class="h6" id="badge-lapaneshnafas-laporanAnesthesi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Diameter Lengan(cm)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="arm_diameter" id="lapanesharm_diameter-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass-laporanAnesthesi">
                                                                    <span class="h6" id="badge-lapanesharm_diameter-laporanAnesthesi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Penggunaan Oksigen (L/mnt)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="oxygen_usage" id="lapaneshoxygen_usage-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass-laporanAnesthesi">
                                                                    <span class="h6" id="badge-lapaneshoxygen_usage-laporanAnesthesi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--==new -->
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Jenis EWS</label>
                                                                <select class="form-select" name="vs_status_id" id="lapaneshvs_status_id-laporanAnesthesi">
                                                                    <option selected>-- pilih --</option>
                                                                    <option value="1">Dewasa</option>
                                                                    <option value="4">Anak</option>
                                                                    <option value="5">Neonatus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--==endofnew -->
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group">
                                                                <label>Pemeriksaan</label><textarea name="pemeriksaan" id="lapaneshpemeriksaan-laporanAnesthesi" placeholder="" value="" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-sm-12">
                                                        <div class="mb-4">
                                                            <div class="form-group"><label>Tanggal Periksa</label><textarea name="examination_date" id="lapaneshpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                    </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="lapaneshdescription" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(A)
                                                    Assesment</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="lapaneshdescription" name="description" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="lapaneshinstruction" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(P) Rencana
                                                    Penatalaksanaan</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="lapaneshinstruction" name="instruction" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4">
                                                <label for="lapaneshexamination_date" class="col-xs-6 col-sm-6 col-md-3 col-form-label">Tanggal
                                                    Periksa</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group" id="lapaneshexaminationdate">
                                                        <input id="lapaneshexamination_date" name="examination_date" type="datetime-local" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#aeexaminationdate' value="<?= date('Y-m-d'); ?>">
                                                    </div>
                                                </div>
                                            </div>
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
                                        <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="lapaneshpetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                                    </div>
                                </div>
                                <span id="total_score-laporanAnesthesi"></span>
                            </div>
                            <!-- <div class="modal-footer">
                                <div class="panel-footer text-end mb-4">
                                    <button type="submit" id="formvitalsignsubmit-laporanAnesthesi"
                                        data-loading-text="<?php echo lang('Word.processing') ?>"
                                        class="btn btn-primary"><?php echo lang('Word.save'); ?></button>
                                    <button type="button" id="formvitalsignedit-laporanAnesthesi"
                                        onclick="enableVitalSign()" style="display: none;"
                                        data-loading-text="<?php echo lang('Word.processing') ?>"
                                        class="btn btn-secondary">Edit</button>
                                </div>
                            </div> -->
                        </form>

                    </div>
                </div>
            </div>


        </div>
        <div class="col-12 my-3 d-flex justify-content-end gap-2">
            <button type="button" id="btn-print-laporan-anesthesi" class="btn btn-success">
                <i class="fas fa-print"></i> Cetak
            </button>

            <button type="button" id="btn-save-laporan-anesthesi" class="btn btn-primary btn-save-operasi"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>

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
        $("#lapaneshexamination_date").val(get_date())
        // setDataVitalSign()


    })

    // $("#vitalsignTab").on("click", function() {
    //     getVitalSign()
    // })

    $("#lapaneshvs_status_id-laporanAnesthesi").on("change", function() {
        var optionSelected = $("option:selected", this);
        $('.vitalsignclass-laporanAnesthesi').each((index, each) => {
            $(each).change(element => {
                vitalsignInput({
                    value: $(each).val(),
                    name: $(each).attr('name'),
                    uniq_name: '-laporanAnesthesi',
                    type: optionSelected.val()
                })
            })
            vitalsignInput({
                value: $(each).val(),
                name: $(each).attr('name'),
                uniq_name: '-laporanAnesthesi',
                type: optionSelected.val()
            })
        });
    })


    function setDataVitalSign() {
        $("#formvitalsign-laporanAnesthesi").find("input, textarea").val(null)
        $("#formvitalsign-laporanAnesthesi").find("#total_score-laporanAnesthesi").html("")
        $("#formvitalsign-laporanAnesthesi").find("span.h6").html("")
        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#lapaneshbody_id-laporanAnesthesi").val(bodyId)
        $("#lapaneshclinic_id-laporanAnesthesi").val('<?= $visit['clinic_id']; ?>')
        $("#lapaneshtrans_id-laporanAnesthesi").val('<?= $visit['trans_id']; ?>')
        $("#lapaneshclass_room_id-laporanAnesthesi").val('<?= $visit['class_room_id']; ?>')
        $("#lapaneshbed_id-laporanAnesthesi").val()
        $("#lapaneshkeluar_id-laporanAnesthesi").val('<?= $visit['keluar_id']; ?>')
        $("#lapaneshemployee_id-laporanAnesthesi").val('<?= $visit['employee_id']; ?>')
        $("#lapaneshno_registration-laporanAnesthesi").val('<?= $visit['no_registration']; ?>')
        $("#lapaneshvisit_id-laporanAnesthesi").val('<?= $visit['visit_id']; ?>')
        $("#lapaneshorg_unit_code-laporanAnesthesi").val('<?= $visit['org_unit_code']; ?>')
        $("#lapaneshdoctor-laporanAnesthesi").val('<?= $visit['fullname']; ?>')
        $("#lapaneshkal_id-laporanAnesthesi").val('<?= $visit['kal_id']; ?>')
        $("#lapaneshtheid-laporanAnesthesi").val('<?= $visit['pasien_id']; ?>')
        $("#lapaneshthename-laporanAnesthesi").val('<?= $visit['diantar_oleh']; ?>')
        $("#lapaneshtheaddress-laporanAnesthesi").val('<?= $visit['visitor_address']; ?>')
        $("#lapaneshstatus_pasien_id-laporanAnesthesi").val('<?= $visit['status_pasien_id']; ?>')
        $("#lapaneshisrj-laporanAnesthesi").val('<?= $visit['isrj']; ?>')
        $("#lapaneshgender-laporanAnesthesi").val('<?= $visit['gender']; ?>')
        $("#lapaneshageyear-laporanAnesthesi").val('<?= $visit['ageyear']; ?>')
        $("#lapaneshagemonth-laporanAnesthesi").val('<?= $visit['agemonth']; ?>')
        $("#lapaneshageday-laporanAnesthesi").val('<?= $visit['ageday']; ?>')
        $("#lapaneshexamination_date-laporanAnesthesi").val(get_date())

        //havin
        var ageYear = <?= $visit['ageyear']; ?>;
        var ageMonth = <?= $visit['agemonth']; ?>;
        var ageDay = <?= $visit['ageday']; ?>;

        if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
            $("#lapaneshvs_status_id-laporanAnesthesi").prop("selectedIndex", 3);
        } else if (ageYear >= 18) {
            $("#lapaneshvs_status_id-laporanAnesthesi").prop("selectedIndex", 1);
        } else {
            $("#lapaneshvs_status_id-laporanAnesthesi").prop("selectedIndex", 2);
        }
    }
</script>