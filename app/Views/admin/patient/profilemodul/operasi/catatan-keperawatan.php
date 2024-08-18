<script src="<?= base_url('assets/js/default.js') ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="tab-pane fade show active" id="catatan-keperawatan">
    <form action="" id="form-catatan-keperawatan">
        <div id="accordionCatatan" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        CATATAN KEPERAWATAN PRA OPERASI
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionCatatan">
                    <div class="card-body">
                        <!-- ------------------ -->
                        <form id="formvitalsign-catatanKeperawatan" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="modal-body pt0 pb0">
                                <input id="catkepclinic_id-catatanKeperawatan" name="clinic_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['clinic_id']; ?>" />
                                <input id="catkepclass_room_id-catatanKeperawatan" name="class_room_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['class_room_id']; ?>" />
                                <input id="catkepbed_id-catatanKeperawatan" name="bed_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['bed_id']; ?>" />
                                <input id="catkepkeluar_id-catatanKeperawatan" name="keluar_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['keluar_id']; ?>" />
                                <input id="catkepemployee_id-catatanKeperawatan" name="employee_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['employee_id']; ?>" />
                                <input id="catkepno_registration-catatanKeperawatan" name="no_registration" placeholder="" type="hidden" class="form-control block" value="<?= $visit['no_registration']; ?>" />
                                <input id="catkepvisit_id-catatanKeperawatan" name="visit_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['visit_id']; ?>" />
                                <input id="catkeporg_unit_code-catatanKeperawatan" name="org_unit_code" placeholder="" type="hidden" class="form-control block" value="<?= $visit['org_unit_code']; ?>" />
                                <input id="catkepdoctor-catatanKeperawatan" name="doctor" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['doctor'] ?? $visit['fullname']; ?>" />
                                <input id="catkepkal_id-catatanKeperawatan" name="kal_id" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['kal_id']; ?>" />
                                <input id="catkeptheid-catatanKeperawatan" name="theid" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['theid']; ?>" />
                                <input id="catkepthename-catatanKeperawatan" name="thename" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['theid']; ?>" />
                                <input id="catkeptheaddress-catatanKeperawatan" name="theaddress" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['theid']; ?>" />
                                <input id="catkepstatus_pasien_id-catatanKeperawatan" name="status_pasien_id" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['status_pasien_id']; ?>" />
                                <input id="catkepisrj-catatanKeperawatan" name="isrj" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['isrj']; ?>" />
                                <input id="catkepgender-catatanKeperawatan" name="gender" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['gender']; ?>" />
                                <input id="catkepageyear-catatanKeperawatan" name="ageyear" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['ageyear']; ?>" />
                                <input id="catkepagemonth-catatanKeperawatan" name="agemonth" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['agemonth']; ?>" />
                                <input id="catkepageday-catatanKeperawatan" name="ageday" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['ageday']; ?>" />
                                <input id="catkepbody_id-catatanKeperawatan" name="body_id_vt" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="catkepmodified_by-catatanKeperawatan" name="modified_by" placeholder="" type="hidden" class="form-control block" value="<?= user()->username ?>" />
                                <input id="catkeptrans_id-catatanKeperawatan" name="trans_id" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['trans_id']; ?>" />
                                <!--==new -->
                                <!-- <input id="catkepvs_status_id-catatanKeperawatan" name="vs_status_id" placeholder="" type="hidden" class="form-control block" value="" /> -->
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="catkepanamnase" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(S)
                                                    Anamnesis</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="catkepanamnase-catatanKeperawatan" name="anamnase" placeholder=""></textarea>
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
                                                                    <input type="text" name="weight" id="catkepweight-catatanKeperawatan" placeholder="" value="" class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6" id="badge-bb-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Tinggi(cm)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="height" id="catkepheight-catatanKeperawatan" placeholder="" value="" class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6" id="badge-catkepheight-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Suhu(°C)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="temperature" id="catkeptemperature-catatanKeperawatan" placeholder="" value="" class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6" id="badge-catkeptemperature-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                            <div class="form-group">
                                                                <label>Nadi(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="nadi" id="catkepnadi-catatanKeperawatan" placeholder="" value="" class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6" id="badge-catkepnadi-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                    <div class="position-relative">
                                                                        <input type="text" name="tension_upper" id="catkeptension_upper-catatanKeperawatan" placeholder="" value="" class="form-control vitalsignclass-catatanKeperawatan">
                                                                        <span class="h6" id="badge-catkeptension_upper-catatanKeperawatan"></span>
                                                                    </div>
                                                                    <h4 class="mx-2">/</h4>
                                                                    <div class="position-relative">
                                                                        <input type="text" name="tension_below" id="catkeptension_below-catatanKeperawatan" placeholder="" value="" class="form-control vitalsignclass-catatanKeperawatan">
                                                                        <span class="h6" id="badge-catkeptension_below-catatanKeperawatan"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Saturasi(SpO2%)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="saturasi" id="catkepsaturasi-catatanKeperawatan" placeholder="" value="" class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6" id="badge-catkepsaturasi-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Nafas/RR(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="nafas" id="catkepnafas-catatanKeperawatan" placeholder="" value="" class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6" id="badge-catkepnafas-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Diameter Lengan(cm)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="arm_diameter" id="catkeparm_diameter-catatanKeperawatan" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-catkeparm_diameter-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Penggunaan Oksigen (L/mnt)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="oxygen_usage" id="catkepoxygen_usage-catatanKeperawatan" placeholder="" value="" class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6" id="badge-catkepoxygen_usage-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--==new -->
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Jenis EWS</label>
                                                                <select class="form-select" name="vs_status_id" id="catkepvs_status_id-catatanKeperawatan">
                                                                    <option selected>-- pilih --</option>
                                                                    <option value="1">Dewasa</option>
                                                                    <option value="4">Anak</option>
                                                                    <option value="5">Neonatus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--==endofnew -->
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="catkeppemeriksaan-catatanKeperawatan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                        <!-- <div class="col-sm-12">
                                                        <div class="mb-4">
                                                            <div class="form-group"><label>Tanggal Periksa</label><textarea name="examination_date" id="catkeppemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                    </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="catkepdescription" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(A)
                                                    Assesment</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="catkepdescription" name="description" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="catkepinstruction" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(P) Rencana
                                                    Penatalaksanaan</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="catkepinstruction" name="instruction" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4">
                                                <label for="catkepexamination_date" class="col-xs-6 col-sm-6 col-md-3 col-form-label">Tanggal
                                                    Periksa</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group" id="catkepexaminationdate">
                                                        <input id="catkepexamination_date" name="examination_date" type="datetime-local" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#aeexaminationdate' value="<?= date('Y-m-d'); ?>">
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
                                        <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="catkeppetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                                    </div>
                                </div>
                                <span id="total_score-catatanKeperawatan"></span>
                            </div>
                            <!-- <div class="modal-footer">
                                <div class="panel-footer text-end mb-4">
                                    <button type="submit" id="formvitalsignsubmit-catatanKeperawatan"
                                        data-loading-text="<?php echo lang('Word.processing') ?>"
                                        class="btn btn-primary"><?php echo lang('Word.save'); ?></button>
                                    <button type="button" id="formvitalsignedit-catatanKeperawatan"
                                        onclick="enableVitalSign()" style="display: none;"
                                        data-loading-text="<?php echo lang('Word.processing') ?>"
                                        class="btn btn-secondary">Edit</button>
                                </div>
                            </div> -->
                        </form>
                        <!-- ----------------- -->
                    </div>
                    <div class="accordion-body" id="template-tindakan-operasi">

                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThreess">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThreess" aria-expanded="false" aria-controls="flush-collapseThreess">
                        CATATAN KEPERAWATAN INTRA OPERATIF
                    </button>
                </h2>
                <div id="flush-collapseThreess" class="accordion-collapse collapse" aria-labelledby="flush-headingThreess" data-bs-parent="#accordionCatatan">
                    <div class="accordion-body" id="cKeperawatanIntraOperatif">

                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThrees">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThrees" aria-expanded="false" aria-controls="flush-collapseThrees">
                        CATATAN KEPERAWATAN PASCA OPERASI
                    </button>
                </h2>
                <div id="flush-collapseThrees" class="accordion-collapse collapse" aria-labelledby="flush-headingThrees" data-bs-parent="#accordionCatatan">
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
            <button type="button" id="btn-save-catatan-keperawatan" class="btn btn-primary btn-save-operasi">Simpan</button>
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
        $("#catkepexamination_date").val(get_date())
        // setDataVitalSign()
    })

    $("#vitalsignTab").on("click", function() {
        getVitalSign()
    })

    $("#catkepvs_status_id-catatanKeperawatan").on("change", function() {
        var optionSelected = $("option:selected", this);
        $('.vitalsignclass-catatanKeperawatan').each((index, each) => {
            $(each).change(element => {
                vitalsignInput({
                    value: $(each).val(),
                    name: $(each).attr('name'),
                    uniq_name: '-catatanKeperawatan',
                    type: optionSelected.val()
                })
            })
            vitalsignInput({
                value: $(each).val(),
                name: $(each).attr('name'),
                uniq_name: '-catatanKeperawatan',
                type: optionSelected.val()
            })
        });
    })


    function setDataVitalSign() {
        $("#formvitalsign-catatanKeperawatan").find("input, textarea").val(null)
        $("#formvitalsign-catatanKeperawatan").find("#total_score-catatanKeperawatan").html("")
        $("#formvitalsign-catatanKeperawatan").find("span.h6").html("")
        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#catkepbody_id-catatanKeperawatan").val(bodyId)
        $("#catkepclinic_id-catatanKeperawatan").val('<?= $visit['clinic_id']; ?>')
        $("#catkeptrans_id-catatanKeperawatan").val('<?= $visit['trans_id']; ?>')
        $("#catkepclass_room_id-catatanKeperawatan").val('<?= $visit['class_room_id']; ?>')
        $("#catkepbed_id-catatanKeperawatan").val()
        $("#catkepkeluar_id-catatanKeperawatan").val('<?= $visit['keluar_id']; ?>')
        $("#catkepemployee_id-catatanKeperawatan").val('<?= $visit['employee_id']; ?>')
        $("#catkepno_registration-catatanKeperawatan").val('<?= $visit['no_registration']; ?>')
        $("#catkepvisit_id-catatanKeperawatan").val('<?= $visit['visit_id']; ?>')
        $("#catkeporg_unit_code-catatanKeperawatan").val('<?= $visit['org_unit_code']; ?>')
        $("#catkepdoctor-catatanKeperawatan").val('<?= $visit['fullname']; ?>')
        $("#catkepkal_id-catatanKeperawatan").val('<?= $visit['kal_id']; ?>')
        $("#catkeptheid-catatanKeperawatan").val('<?= $visit['pasien_id']; ?>')
        $("#catkepthename-catatanKeperawatan").val('<?= $visit['diantar_oleh']; ?>')
        $("#catkeptheaddress-catatanKeperawatan").val('<?= $visit['visitor_address']; ?>')
        $("#catkepstatus_pasien_id-catatanKeperawatan").val('<?= $visit['status_pasien_id']; ?>')
        $("#catkepisrj-catatanKeperawatan").val('<?= $visit['isrj']; ?>')
        $("#catkepgender-catatanKeperawatan").val('<?= $visit['gender']; ?>')
        $("#catkepageyear-catatanKeperawatan").val('<?= $visit['ageyear']; ?>')
        $("#catkepagemonth-catatanKeperawatan").val('<?= $visit['agemonth']; ?>')
        $("#catkepageday-catatanKeperawatan").val('<?= $visit['ageday']; ?>')
        $("#catkepexamination_date-catatanKeperawatan").val(get_date())

        //havin
        var ageYear = <?= $visit['ageyear']; ?>;
        var ageMonth = <?= $visit['agemonth']; ?>;
        var ageDay = <?= $visit['ageday']; ?>;

        if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
            $("#catkepvs_status_id-catatanKeperawatan").prop("selectedIndex", 3);
        } else if (ageYear >= 18) {
            $("#catkepvs_status_id-catatanKeperawatan").prop("selectedIndex", 1);
        } else {
            $("#catkepvs_status_id-catatanKeperawatan").prop("selectedIndex", 2);
        }
    }

    const addRowVitalSigncatatanKeperawatan = (examselect, key) => {
        $("#vitalSignBody").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date).substring(0, 16)))
                .append($("<td rowspan='7'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="copyVitalSign(' + key +
                    ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editCppt(' + key +
                    ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'
                ))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="removeRacik(\'' + examselect
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
            .append($("<tr>")
                .append($("<td>").html("<b>S</b>"))
                .append($("<td colspan='5'>").html(examselect.anamnase))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>O</b>"))
                .append($("<td colspan='5'>").html(examselect.pemeriksaan))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>A</b>"))
                .append($("<td colspan='5'>").html(examselect.description))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>P</b>"))
                .append($("<td colspan='5'>").html(examselect.instruction))
            )
            .append($("<tr>")
                .append($("<td>").html("Instruksi"))
                .append($("<td colspan='5'>").html(examselect.instruction))
            )
    }

    function vitalsignInputcatatanKeperawatan(prop) {
        var value = prop.value.trim();
        var name = 'catkep' + prop.name + `-catatanKeperawatan`; //=new
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

            case "catkepnadi-catatanKeperawatan":
                data = scoreFunction('nadi', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "catkeptemperature-catatanKeperawatan":
                data = scoreFunction('suhu', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "catkepsaturasi-catatanKeperawatan":
                data = scoreFunction('saturasi', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "catkepnafas-catatanKeperawatan":
                data = scoreFunction('pernapasan', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "catkepoxygen_usage-catatanKeperawatan":
                data = scoreFunction('oksigen', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "catkepweight-catatanKeperawatan":
                if (value < 10) {
                    value = 10.00;
                } else if (value > 50) {
                    value = 50.00;
                } else {
                    value = value.toFixed(2);
                }
                break;
            case "catkeptension_upper-catatanKeperawatan":
                if (value < 50) {
                    value = 50.00;
                } else if (value > 250) {
                    value = 250.00;
                }
                data = scoreFunction('darah', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "catkepheight-catatanKeperawatan":
                if (value > 250) {
                    value = 250;
                }
                break;
            case "catkeptension_below-catatanKeperawatan":
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


    function disableVitalSign() {
        $("#catkepexamination_date-catatanKeperawatan").prop("disabled", true)
        $("#catkeppetugas-catatanKeperawatan").prop("disabled", true)
        $("#catkepweight-catatanKeperawatan").prop("disabled", true)
        $("#catkepheight-catatanKeperawatan").prop("disabled", true)
        $("#catkeptemperature-catatanKeperawatan").prop("disabled", true)
        $("#catkepnadi-catatanKeperawatan").prop("disabled", true)
        $("#catkeptension_upper-catatanKeperawatan").prop("disabled", true)
        $("#catkeptension_below-catatanKeperawatan").prop("disabled", true)
        $("#catkepsaturasi-catatanKeperawatan").prop("disabled", true)
        $("#catkepnafas-catatanKeperawatan").prop("disabled", true)
        $("#catkeparm_diameter-catatanKeperawatan").prop("disabled", true)
        $("#catkepanamnase-catatanKeperawatan").prop("disabled", true)
        $("#catkepoxygen_usage-catatanKeperawatan").prop("disabled", true)
        $("#catkepvs_status_id-catatanKeperawatan").prop("disabled", true)
        $("#catkeppemeriksaan-catatanKeperawatan").prop("disabled", true)
        $("#catkepteraphy_desc-catatanKeperawatan").prop("disabled", true)
        $("#catkepdescription-catatanKeperawatan").prop("disabled", true)
        $("#catkepclinic_id-catatanKeperawatan").prop("disabled", true)
        $("#catkeptrans_id-catatanKeperawatan").prop("disabled", true) //==new
        $("#catkepclass_room_id-catatanKeperawatan").prop("disabled", true)
        $("#catkepbed_id-catatanKeperawatan").prop("disabled", true)
        $("#catkepkeluar_id-catatanKeperawatan").prop("disabled", true)
        $("#catkepemployee_id-catatanKeperawatan").prop("disabled", true)
        $("#catkepno_registraiton-catatanKeperawatan").prop("disabled", true)
        $("#catkepvisit_id-catatanKeperawatan").prop("disabled", true)
        $("#catkeporg_unit_code-catatanKeperawatan").prop("disabled", true)
        $("#catkepdoctor-catatanKeperawatan").prop("disabled", true)
        $("#catkepkal_id-catatanKeperawatan").prop("disabled", true)
        $("#catkeptheid-catatanKeperawatan").prop("disabled", true)
        $("#catkepthename-catatanKeperawatan").prop("disabled", true)
        $("#catkeptheaddress-catatanKeperawatan").prop("disabled", true)
        $("#catkepstatus_pasien_id-catatanKeperawatan").prop("disabled", true)
        $("#catkepisrj-catatanKeperawatan").prop("disabled", true)
        $("#catkepgender-catatanKeperawatan").prop("disabled", true)
        $("#catkepageyear-catatanKeperawatan").prop("disabled", true)
        $("#catkepagemonth-catatanKeperawatan").prop("disabled", true)
        $("#catkepageday-catatanKeperawatan").prop("disabled", true)
        $("#catkepinstruction-catatanKeperawatan").prop("disabled", true)
    }

    function enableVitalSign() {
        $("#catkepexamination_date-catatanKeperawatan").prop("disabled", false)
        $("#catkeppetugas-catatanKeperawatan").prop("disabled", false)
        $("#catkepweight-catatanKeperawatan").prop("disabled", false)
        $("#catkepheight-catatanKeperawatan").prop("disabled", false)
        $("#catkeptemperature-catatanKeperawatan").prop("disabled", false)
        $("#catkepnadi-catatanKeperawatan").prop("disabled", false)
        $("#catkeptension_upper-catatanKeperawatan").prop("disabled", false)
        $("#catkeptension_below-catatanKeperawatan").prop("disabled", false)
        $("#catkepsaturasi-catatanKeperawatan").prop("disabled", false)
        $("#catkepnafas-catatanKeperawatan").prop("disabled", false)
        $("#catkeparm_diameter-catatanKeperawatan").prop("disabled", false)
        $("#catkepoxygen_usage-catatanKeperawatan").prop("disabled", false)
        $("#catkepvs_status_id-catatanKeperawatan").prop("disabled", false)
        $("#catkepanamnase-catatanKeperawatan").prop("disabled", false)
        $("#catkeppemeriksaan-catatanKeperawatan").prop("disabled", false)
        $("#catkepteraphy_desc-catatanKeperawatan").prop("disabled", false)
        $("#catkepdescription-catatanKeperawatan").prop("disabled", false)
        $("#catkepclinic_id-catatanKeperawatan").prop("disabled", false)
        $("#catkeptrans_id-catatanKeperawatan").prop("disabled", false) //==new
        $("#catkepclass_room_id-catatanKeperawatan").prop("disabled", false)
        $("#catkepbed_id-catatanKeperawatan").prop("disabled", false)
        $("#catkepkeluar_id-catatanKeperawatan").prop("disabled", false)
        $("#catkepemployee_id-catatanKeperawatan").prop("disabled", false)
        $("#catkepno_registraiton-catatanKeperawatan").prop("disabled", false)
        $("#catkepvisit_id-catatanKeperawatan").prop("disabled", false)
        $("#catkeporg_unit_code-catatanKeperawatan").prop("disabled", false)
        $("#catkepdoctor-catatanKeperawatan").prop("disabled", false)
        $("#catkepkal_id-catatanKeperawatan").prop("disabled", false)
        $("#catkeptheid-catatanKeperawatan").prop("disabled", false)
        $("#catkepthename-catatanKeperawatan").prop("disabled", false)
        $("#catkeptheaddress-catatanKeperawatan").prop("disabled", false)
        $("#catkepstatus_pasien_id-catatanKeperawatan").prop("disabled", false)
        $("#catkepisrj-catatanKeperawatan").prop("disabled", false)
        $("#catkepgender-catatanKeperawatan").prop("disabled", false)
        $("#catkepageyear-catatanKeperawatan").prop("disabled", false)
        $("#catkepagemonth-catatanKeperawatan").prop("disabled", false)
        $("#catkepageday-catatanKeperawatan").prop("disabled", false)
        $("#catkepinstruction-catatanKeperawatan").prop("disabled", false)

        $("#formvitalsignsubmit-catatanKeperawatan").toggle()
        $("#formvitalsignedit").toggle()
    }

    var vitalsigndesc = []

    var i = 0

    // for (let index = vitalsign.length; index >= 0; index--) {
    //     vitalsigndesc.push(vitalsign[index]);
    // }
    // console.log(vitalsigndesc)
    // vitalsign = vitalsigndesc

    vitalsign.forEach((element, key) => {
        examselect = vitalsign[key];
        addRowVitalSigncatatanKeperawatan(examselect, key)
    });

    vitalsign.forEach((element, key) => {
        examselect = vitalsign[key];

        if (examselect.visit_id == '<?= $visit['visit_id']; ?>') {

            disableVitalSign()
            $("#formvitalsignsubmit-catatanKeperawatan").hide()
            $("#formvitalsignedit-catatanKeperawatan").show()

            $("#catkepclinic_id-catatanKeperawatan").val(examselect.clinic_id)
            $("#catkepclass_room_id-catatanKeperawatan").val(examselect.class_room_id)
            $("#catkepbed_id-catatanKeperawatan").val(examselect.bed_id)
            $("#catkepkeluar_id-catatanKeperawatan").val(examselect.keluar_id)
            $("#catkepemployee_id-catatanKeperawatan").val(examselect.employee_id)
            $("#catkepno_registration-catatanKeperawatan").val(examselect.no_registration)
            $("#catkepvisit_id-catatanKeperawatan").val(examselect.visit_id)
            $("#catkeporg_unit_code-catatanKeperawatan").val(examselect.org_unit_code)
            $("#catkepdoctor-catatanKeperawatan").val(examselect.fullname)
            $("#catkepkal_id-catatanKeperawatan").val(examselect.kal_id)
            $("#catkeptheid-catatanKeperawatan").val(examselect.pasien_id)
            $("#catkepthename-catatanKeperawatan").val(examselect.diantar_oleh)
            $("#catkeptheaddress-catatanKeperawatan").val(examselect.visitor_address)
            $("#catkepstatus_pasien_id-catatanKeperawatan").val(examselect.status_pasien_id)
            $("#catkepisrj-catatanKeperawatan").val(examselect.isrj)
            $("#catkepgender-catatanKeperawatan").val(examselect.gender)
            $("#catkepageyear-catatanKeperawatan").val(examselect.ageyear)
            $("#catkepagemonth-catatanKeperawatan").val(examselect.agemonth)
            $("#catkepageday-catatanKeperawatan").val(examselect.ageday)
            $("#catkepbody_id-catatanKeperawatan").val(examselect.body_id)

            $("#catkepexamination_date-catatanKeperawatan").val(examselect.examination_date)
            $("#catkeppetugas-catatanKeperawatan").val(examselect.petugas)
            $("#catkepweight-catatanKeperawatan").val(examselect.weight)
            $("#catkepheight-catatanKeperawatan").val(examselect.height)
            $("#catkeptemperature-catatanKeperawatan").val(examselect.temperature)
            $("#catkepnadi-catatanKeperawatan").val(examselect.nadi)
            $("#catkeptension_upper-catatanKeperawatan").val(examselect.tension_upper)
            $("#catkeptension_below-catatanKeperawatan").val(examselect.tension_below)
            $("#catkepsaturasi-catatanKeperawatan").val(examselect.saturasi)
            $("#catkepnafas-catatanKeperawatan").val(examselect.nafas)
            $("#catkeparm_diameter-catatanKeperawatan").val(examselect.arm_diameter)
            $("#catkepanamnase-catatanKeperawatan").val(examselect.anamnase)
            $("#catkepoxygen_usage-catatanKeperawatan").val(examselect.oxygen_usage)
            $("#catkepvs_status_id-catatanKeperawatan").val(examselect.vs_status_id)
            $("#catkeppemeriksaan-catatanKeperawatan").val(examselect.pemeriksaan)
            $("#catkepteraphy_desc-catatanKeperawatan").val(examselect.teraphy_desc)
            $("#catkepdescription-catatanKeperawatan").val(examselect.description)
            $("#catkepclinic_id-catatanKeperawatan").val(examselect.clinic_id)
            $("#catkeptrans_id-catatanKeperawatan").val(examselect.trans_id) //==new
            $("#catkepclass_room_id-catatanKeperawatan").val(examselect.class_room_id)
            $("#catkepbed_id-catatanKeperawatan").val(examselect.bed_id)
            $("#catkepkeluar_id-catatanKeperawatan").val(examselect.keluar_id)
            $("#catkepemployee_id-catatanKeperawatan").val(examselect.employee_id)
            $("#catkepno_registraiton-catatanKeperawatan").val(examselect.no_registraiton)
            $("#catkepvisit_id-catatanKeperawatan").val(examselect.visit_id)
            $("#catkeporg_unit_code-catatanKeperawatan").val(examselect.org_unit_code)
            $("#catkepdoctor-catatanKeperawatan").val(examselect.doctor)
            $("#catkepkal_id-catatanKeperawatan").val(examselect.kal_id)
            $("#catkeptheid-catatanKeperawatan").val(examselect.theid)
            $("#catkepthename-catatanKeperawatan").val(examselect.thename)
            $("#catkeptheaddress-catatanKeperawatan").val(examselect.theaddress)
            $("#catkepstatus_pasien_id-catatanKeperawatan").val(examselect.status_pasien_id)
            $("#catkepisrj-catatanKeperawatan").val(examselect.isrj)
            $("#catkepgender-catatanKeperawatan").val(examselect.gender)
            $("#catkepageyear-catatanKeperawatan").val(examselect.ageyear)
            $("#catkepagemonth-catatanKeperawatan").val(examselect.agemonth)
            $("#catkepageday-catatanKeperawatan").val(examselect.ageday)
            $("#catkepinstruction-catatanKeperawatan").val(examselect.instruction)
        }

        if (typeof $("#catkepbody_id-catatanKeperawatan").val() !== 'undefined' || $(
                "#catkepbody_id-catatanKeperawatan")
            .val() == "-catatanKeperawatan") {
            $("#catkepclinic_id-catatanKeperawatan").val('<?= $visit['clinic_id']; ?>')
            $("#catkeptrans_id-catatanKeperawatan").val('<?= $visit['trans_id']; ?>') //==new
            $("#catkepclass_room_id-catatanKeperawatan").val('<?= $visit['class_room_id']; ?>')
            $("#catkepbed_id-catatanKeperawatan").val()
            $("#catkepkeluar_id-catatanKeperawatan").val('<?= $visit['keluar_id']; ?>')
            $("#catkepemployee_id-catatanKeperawatan").val('<?= $visit['employee_id']; ?>')
            $("#catkepno_registration-catatanKeperawatan").val('<?= $visit['no_registration']; ?>')
            $("#catkepvisit_id-catatanKeperawatan").val('<?= $visit['visit_id']; ?>')
            $("#catkeporg_unit_code-catatanKeperawatan").val('<?= $visit['org_unit_code']; ?>')
            $("#catkepdoctor-catatanKeperawatan").val('<?= $visit['fullname']; ?>')
            $("#catkepkal_id-catatanKeperawatan").val('<?= $visit['kal_id']; ?>')
            $("#catkeptheid-catatanKeperawatan").val('<?= $visit['pasien_id']; ?>')
            $("#catkepthename-catatanKeperawatan").val('<?= $visit['diantar_oleh']; ?>')
            $("#catkeptheaddress-catatanKeperawatan").val('<?= $visit['visitor_address']; ?>')
            $("#catkepstatus_pasien_id-catatanKeperawatan").val('<?= $visit['status_pasien_id']; ?>')
            $("#catkepisrj-catatanKeperawatan").val('<?= $visit['isrj']; ?>')
            $("#catkepgender-catatanKeperawatan").val('<?= $visit['gender']; ?>')
            $("#catkepageyear-catatanKeperawatan").val('<?= $visit['ageyear']; ?>')
            $("#catkepagemonth-catatanKeperawatan").val('<?= $visit['agemonth']; ?>')
            $("#catkepageday-catatanKeperawatan").val('<?= $visit['ageday']; ?>')


        }
    });
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

    function getVitalSign() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentKeperawatan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                vitalsign = data.examInfo
                $("#vitalSignBody").html("")
                vitalsign.forEach((element, key) => {
                    examselect = vitalsign[key];
                    addRowVitalSigncatatanKeperawatan(examselect, key)
                });
            },
            error: function() {

            }
        });
    }
</script>