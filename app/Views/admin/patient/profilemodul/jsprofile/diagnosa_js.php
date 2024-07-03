<script>
    var pasienDiagnosasAll = [];
    var diagPerawatAll = [];
    $("#diagnosaTab").on("mouseup", function() {
        getAssessmentDocument()
    })
</script>
<script>
    function disableArmDiag(bodyId) {
        $("#formaddarm" + bodyId).find("input, textarea, select").prop("disabled", true)

        $("#formsavearmbtn" + bodyId).hide()
        $("#formeditarm" + bodyId).show()
        $("#formsignarm" + bodyId).hide()
        $("#formcetakarm" + bodyId).hide()
    }

    function enableArmDiag(bodyId) {
        $("#formaddarm" + bodyId).find("input, textarea, select").prop("disabled", false)

        $("#formsavearmbtn" + bodyId).show()
        $("#formeditarm" + bodyId).hide()
        $("#formsignarm" + bodyId).show()
        $("#formcetakarm" + bodyId).show()
    }

    function appendDiagnosa(accordionId, bodyId, pasienDiagnosa) {
        var titleDoc = ''
        var titlerj = '';

        if (pasienDiagnosa.class_room_id != '' && pasienDiagnosa.class_room_id != null) {
            titlerj = ' RAWAT JALAN'
        } else {
            titlerj = ' RAWAT JALAN'
        }
        $.each(mapAssessment, function(key, value) {
            if (value.doc_type == 1 && value.specialist_type_id == pasienDiagnosa.specialist_type_id) {
                titleDoc = ("ASESMEN MEDIS " + value.specialist_type + titlerj)
            }
        })
        var accordionContent = `
        <div id="adiagGroup` + bodyId + `" class="accordion-item">
            <h2 class="accordion-header" id="headingDiagnosaMedis` + bodyId + `">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaPerawat` + bodyId + `" aria-expanded="false" aria-controls="collapseDiagnosa` + bodyId + `">
                    <b>DIAGNOSA ` + titleDoc + `</b>
                </button>
            </h2>
            <div id="collapseDiagnosaPerawat` + bodyId + `" class="accordion-collapse collapse" aria-labelledby="headingDiagnosaMedis` + bodyId + `" data-bs-parent="#accordionDiagnosa" style="">
                <div class="accordion-body text-muted">
                    <form id="formaddarm` + bodyId + `">
                        <input type="hidden" id="adiagpasien_diagnosa_id` + bodyId + `" name="pasien_diagnosa_id"/>
                        <div class="row">
                            <div class="col-sm-2 col-xs-12">
                                <h5 class="font-size-14 mb-4 badge bg-primary">dokumen assessment:</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiagdate_of_diagnosa` + bodyId + `">Tanggal Assessmennt</label>
                                        <input name="date_of_diagnosa" id="adiagdate_of_diagnosa` + bodyId + `" type="datetime-local" class="form-control" value="<?php date('Y/m/d H:i:s'); ?>" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <?php if (!is_null($visit['class_room_id'])) { ?>
                                            <label for="adiagclinic_id` + bodyId + `">Bangsal</label>
                                        <?php } else { ?>
                                            <label for="adiagclinic_id` + bodyId + `">Poli</label>
                                        <?php } ?>
                                        <select name="clinic_id" id="adiagclinic_id` + bodyId + `" type="hidden" class="form-control" readonly>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiagemployee_id` + bodyId + `">Dokter</label>
                                        <select name="employee_id" id="adiagemployee_id` + bodyId + `" type="hidden" class="form-control" readonly>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiagmedical_problem">Permasalahan Medis</label>
                                        <textarea id="adiagmedical_problem" name="medical_problem" rows="2" class="form-control " autocomplete="off" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiaghurt">Penyebab Cidera/Keracunan</label>
                                        <textarea id="adiaghurt" name="hurt" rows="2" class="form-control " autocomplete="off" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiagdiagnosa_desc">Diagnosa Klinis</label>
                                        <textarea id="adiagdiagnosa_desc" name="diagnosa_desc" rows="2" class="form-control " autocomplete="off" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="table tablecustom-responsive">
                                <table id="tablediagnosa" class="table">
                                    <thead>
                                        <th class="text-center" style="width: 40%">Diagnosa</th>
                                        <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                        <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                    </thead>
                                    <tbody id="bodyDiagMedis` + bodyId + `">
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-tab-tools" style="text-align: center;">
                                <button type="button" id="formdiag" name="adddiagnosa" onclick="addRowDiagDokter('bodyDiagMedis', '` + bodyId + `')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-4">
                                    <div class="table tablecustom-responsive">
                                        <table id="tableprocedure" class="table table-borderedcustom table-hover ">
                                            <thead>
                                                <th class="text-center">Prosedur (ICD IX)</th>
                                            </thead>
                                            <tbody id="bodyProcMedis` + bodyId + `">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="addprocedure` + bodyId + `" onclick="addRowProcDokter('bodyProcMedis','` + bodyId + `')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Prosedur</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="panel-footer text-end mb-4">
                                <button type="button" id="formsavearmbtn` + bodyId + `" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                <button type="button" id="formeditarm` + bodyId + `" name="editrm" onclick="enableArmDiag('` + bodyId + `')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                <button type="button" id="formsignarm` + bodyId + `" name="signrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                <button type="button" id="formcetakarm` + bodyId + `" name="" onclick="cetakAssessmentMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fa fa-signature"></i> <span>Cetak</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        `;

        appendAccordionItem(accordionId, accordionContent);
        $("#adiagpasien_diagnosa_id" + bodyId).val(pasienDiagnosa.pasien_diagnosa_id)
        $("#adiagdate_of_diagnosa" + bodyId).val(pasienDiagnosa.date_of_diagnosa)
        $("#adiagclinic_id" + bodyId).html(`<option value="` + pasienDiagnosa.clinic_id + `">` + pasienDiagnosa.name_of_clinic + `</option>`)
        $("#adiagemployee_id" + bodyId).html(`<option value="` + pasienDiagnosa.employee_id + `">` + pasienDiagnosa.fullname + `</option>`)
        $("#adiagmedical_problem" + bodyId).val(pasienDiagnosa.medical_problem)
        $("#adiaghurt" + bodyId).val(pasienDiagnosa.diaghurt)
        $("#adiagdiagnosa_desc" + bodyId).val(pasienDiagnosa.diagnosa_desc)

        $.each(pasienDiagnosasAll, function(key, value) {
            if (value.pasien_diagnosa_id == pasienDiagnosa.pasien_diagnosa_id) {
                addRowDiagDokter('bodyDiagMedis', bodyId, value.diagnosa_id, value.diagnosa_name, value.diag_cat, value.diag_suffer)
            }
        })
        $.each(proceduresAll, function(key, value) {
            if (value.pasien_diagnosa_id == pasienDiagnosa.pasien_diagnosa_id) {
                addRowProcDokter('bodyProcMedis', bodyId, value.diagnosa_id, value.diagnosa_name, value.diag_cat, value.diag_suffer)
            }
        })

        $("#formsavearmbtn" + bodyId).on('click', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/addAssessmentMedisDiagnosa',
                type: "POST",
                data: new FormData(document.getElementById("formaddarm" + bodyId)),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    clicked_submit_btn.button('loading');
                },
                success: function(data) {
                    disableArmDiag(bodyId)
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function(index, value) {
                            message += value;
                        });
                        // errorMsg(message);
                    } else {
                        // successMsg(data.message);
                    }
                    clicked_submit_btn.button('reset');
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));
    }
</script>
<script>
    function addRowDiagDokter(container, bodyId, diag_id = null, diag_name = null, diag_cat = null, diag_suffer = 0) {
        var tbody = document.getElementById(container + bodyId);
        var diagIndex = tbody.getElementsByTagName("tr").length;
        if (diag_cat == null) {
            diag_cat = 1
        }
        if (diag_cat == null && diagIndex > 1) {
            diag_cat = 2
        }
        diagIndex = bodyId + diagIndex
        $("#" + container + bodyId)
            .append($('<tr id="adiagdiag' + diagIndex + '">')
                .append($('<td>')
                    .append('<select id="adiagdiag_id' + diagIndex + '" class="form-control enablekan" name="diag_id[]" onfocus="removetextdiag(\'' + diagIndex + '\')"  onchange="selectedDiagnosa(\'' + diagIndex + '\')" style="width: 100%"></select>')
                    .append('<input id="adiagdiag_name' + diagIndex + '" name="diag_name[]" placeholder="" type="text" class="form-control block enablekan" value="" style="display: none" />')
                    .append('<input id="adiagsscondition_id' + diagIndex + '" name="sscondition_id[]" placeholder="" type="text" class="form-control block enablekan" value="" style="display: none" />')
                )
                .append($('<td>')
                    .append($("<select class=\"form-control enablekan\">")
                        .attr('name', 'suffer_type[]').attr('id', 'adiagsuffer_type' + diagIndex) <?php foreach ($suffer as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $suffer[$key]['suffer_type']; ?>').html('<?= $suffer[$key]['suffer']; ?>')
                            ) <?php } ?>
                        .val(diag_suffer)
                    )
                )
                .append($('<td>')
                    .append($("<select class=\"form-control enablekan\">")
                        .attr('name', 'diag_cat[]').attr('id', 'adiagdiag_cat' + diagIndex) <?php foreach ($diagCat as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                            ) <?php } ?>
                        .val(diag_cat)
                    )
                )
                .append("<td><a href='#' onclick='$(\"#adiagdiag" + diagIndex + "\").remove()' class='btn closebtn btn-xs pull-right enablekan' data-toggle='modal' title=''><i class='fa fa-trash'></i></a></td>")
            );

        initializeDiagSelect2("adiagdiag_id" + diagIndex, diag_id, diag_name)
        $("#adiagsuffer_type" + diagIndex).val(diag_suffer)
        $("#adiagdiag_cat" + diagIndex).val(diag_cat)
    }

    function selectedDiagnosa(index) {
        var diagname = $("#adiagdiag_id" + index).text()
        if (typeof diagname !== 'undefined') {
            $("#adiagdiag_name" + index).val(diagname)
        }
    }

    function removetextdiag(index) {
        $("#adiagdiag_id" + index).text("")
    }
</script>
<script>
    function addRowProcDokter(container, bodyId, diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
        var tbody = document.getElementById(container + bodyId);
        var procIndex = tbody.getElementsByTagName("tr").length;
        procIndex = bodyId + procIndex
        $("#" + container + bodyId)
            .append($('<tr id="adiagprocmedis' + procIndex + '">')
                // .append($('<td>').html(diagIndex + "."))
                .append($('<td style="width: 100%">')
                    .append('<div class="p-2 select2-full-width"><select id="adiagproc_idmedis' + procIndex + '" onfocus="removetextproc(\'' + procIndex + '\')" onchange="selectedProcMedis(\'' + procIndex + '\')" class="form-control" name="proc_id[]" style="width: 100%"></select></div>')
                    .append('<input id="adiagproc_namemedis' + procIndex + '" name="proc_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
                )
                .append("<td><a href='#' onclick='$(\"#adiagprocmedis" + procIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-remove'></i></a></td>")
            );
        initializeProcSelect2("adiagproc_idmedis" + procIndex, diag_id, diag_name)
    }

    function selectedProcMedis(index) {
        var diagname = $("#adiagproc_idmedis" + index).text()
        if (typeof diagname !== 'undefined') {
            $("#adiagproc_namemedis" + index).val(diagname)
        }
    }

    function removetextproc(index) {
        $("#adiagdiag_id" + index).text("")
    }
</script>
<script>
    function disableArpDiag(bodyId) {
        $("#formDiagPerawat" + bodyId).find("input, textarea, select").prop("disabled", true)

        $("#formDiagPerawatSaveBtn" + bodyId).hide()
        $("#formDiagPerawatEditBtn" + bodyId).show()
        $("#formDiagPerawatSignBtn" + bodyId).hide()
        $("#formDiagPerawatCetakBtn" + bodyId).hide()
    }

    function enableArpDiag(bodyId) {
        $("#formDiagPerawat" + bodyId).find("input, textarea, select").prop("disabled", false)

        $("#formDiagPerawatSaveBtn" + bodyId).show()
        $("#formDiagPerawatEditBtn" + bodyId).hide()
        $("#formDiagPerawatSignBtn" + bodyId).show()
        $("#formDiagPerawatCetakBtn" + bodyId).show()
    }

    function appendDiagnosaPerawat(accordionId, bodyId, exam) {
        $title = 'Diagnosa Perawat Assessment Keperawatan Umum ' + exam.examination_date

        if (exam.vs_status_id == '1') {
            $title = 'Diagnosa Perawat Assessment Keperawatan Dewasa ' + exam.examination_date
        } else if (exam.vs_status_id == '4') {
            $title = 'Diagnosa Perawat Assessment Keperawatan Neonatus ' + exam.examination_date
        } else if (exam.vs_status_id == '5') {
            $title = 'Diagnosa Perawat Assessment Keperawatan Anak ' + exam.examination_date
        } else if (exam.vs_status_id == '2' || exam.vs_status_id == '7') {
            $title = 'Diagnosa Perawat CPPT ' + exam.examination_date
        }
        var accordionContent = `
        <div id="adiagpGroup` + bodyId + `" class="accordion-item">
            <h2 class="accordion-header" id="headingDiagGroup` + bodyId + `">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaPerawat` + bodyId + `" aria-expanded="false" aria-controls="collapseDiagnosaPerawat` + bodyId + `">
                    <b>${$title}</b>
                </button>
            </h2>
            <div id="collapseDiagnosaPerawat` + bodyId + `" class="accordion-collapse collapse" aria-labelledby="headingDiagGroup` + bodyId + `" data-bs-parent="#accordionDiagnosaPerawat" style="">
                <div class="accordion-body text-muted">
                    <div id="groupDiagnosaPerawat` + bodyId + `" class="row mb-2" <?= isset($group[11]) ? 'style="display: none"' : '' ?>>
                        <form id="formDiagPerawat` + bodyId + `">
                            <input type="hidden" id="adiagporg_unit_code` + bodyId + `" name="org_unit_code"/>
                            <input type="hidden" id="adiagpbody_id` + bodyId + `" name="body_id"/>
                            <input type="hidden" id="adiagpvisit_id` + bodyId + `" name="visit_id"/>
                            <input type="hidden" id="adiagptrans_id` + bodyId + `" name="trans_id"/>
                            <input type="hidden" id="adiagpclass_room_id` + bodyId + `" name="class_room_id"/>
                            <input type="hidden" id="adiagpbed_id` + bodyId + `" name="bed_id"/>
                            <input type="hidden" id="adiagpno_registration` + bodyId + `" name="no_registration"/>
                            <div class="row">
                                <div class="col-sm-2 col-xs-12">
                                    <h5 class="font-size-14 mb-4 badge bg-primary">dokumen assessment:</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="adiagpexamination_date` + bodyId + `">Tanggal Assessmennt</label>
                                            <input name="examination_date" id="adiagpexamination_date` + bodyId + `" type="datetime-local" class="form-control" value="<?php date('Y/m/d H:i:s'); ?>" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <?php if (!is_null($visit['class_room_id'])) { ?>
                                                <label for="adiagpclinic_id` + bodyId + `">Bangsal</label>
                                            <?php } else { ?>
                                                <label for="adiagpclinic_id` + bodyId + `">Poli</label>
                                            <?php } ?>
                                            <select name="clinic_id" id="adiagpclinic_id` + bodyId + `" type="hidden" class="form-control" readonly>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="adiagpemployee_id` + bodyId + `">Dokter</label>
                                            <select name="employee_id" id="adiagpemployee_id` + bodyId + `" type="hidden" class="form-control" readonly>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-4">
                                    <div class="">
                                        <div class="table tablecustom-responsive">
                                            <table id="tableDiagnosaPerawatMedis` + bodyId + `" class="table">
                                                <thead>
                                                    <th class="text-center" style="width: 100%">DiagnosaPerawat</th>
                                                </thead>
                                                <tbody id="bodyDiagPerawat` + bodyId + `">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" id="formdiag" name="addDiagnosaPerawat" onclick="addRowDiagPerawat('bodyDiagPerawat', '` + bodyId + `')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="panel-footer text-end mb-4">
                                        <button type="button" id="formDiagPerawatSaveBtn` + bodyId + `" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                        <button type="button" id="formDiagPerawatEditBtn` + bodyId + `" name="editrm" onclick="enableArpDiag('` + bodyId + `')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                        <button type="button" id="formDiagPerawatSignBtn` + bodyId + `" name="signrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                        <button type="button" id="formDiagPerawatCetakBtn` + bodyId + `" name="" onclick="cetakAssessmentMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fa fa-signature"></i> <span>Cetak</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
        `;
        appendAccordionItem(accordionId, accordionContent);
        $("#adiagporg_unit_code" + bodyId).val(exam.org_unit_code)
        $("#adiagpbody" + bodyId).val(exam.body_id)
        $("#adiagpexamination_date" + bodyId).val(exam.examination_date)
        $("#adiagpclinic_id" + bodyId).html(`<option value="` + exam.clinic_id + `">` + exam.name_of_clinic + `</option>`)
        $("#adiagpemployee_id" + bodyId).html(`<option value="` + exam.employee_id + `">` + exam.fullname + `</option>`)

        $("#adiagpbody_id" + bodyId).val(exam.body_id)
        $("#adiagpvisit_id" + bodyId).val(exam.visit_id)
        $("#adiagptrans_id" + bodyId).val(exam.trans_id)
        $("#adiagpclass_room_id" + bodyId).val(exam.class_room_id)
        $("#adiagpbed_id" + bodyId).val(exam.bed_id)
        $("#adiagpno_registration" + bodyId).val(exam.no_registration)

        $.each(diagPerawatAll, function(key, value) {
            if (value.document_id == exam.body_id) {
                addRowDiagPerawat('bodyDiagPerawat', bodyId, value.diagnosan_id, value.diag_notes)
            }
        })

        $("#formDiagPerawatSaveBtn" + bodyId).on('click', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/addDiagnosaKeperawatan',
                type: "POST",
                data: new FormData(document.getElementById("formDiagPerawat" + bodyId)),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    clicked_submit_btn.button('loading');
                },
                success: function(data) {
                    disableArpDiag(bodyId)
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function(index, value) {
                            message += value;
                        });
                        // errorMsg(message);
                    } else {
                        // successMsg(data.message);
                    }
                    clicked_submit_btn.button('reset');
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));
    }
</script>
<script>
    function addRowDiagPerawat(container, bodyId, diag_id = null, diag_name = null) {
        diagIndex++;
        $("#" + container + bodyId)
            .append($('<tr id="adiagpdiag' + diagIndex + '">')
                // .append($('<td>').html(diagIndex + "."))
                .append($('<td>')
                    .append('<select id="adiagpdiagnosan_id' + diagIndex + '" class="form-control" name="diagnosan_id[]" onfocus="removetextdiagperawat(\'' + diagIndex + '\')" onchange="selectedDiagNursePerawat(\'' + diagIndex + '\')" style="width: 100%"></select>')
                    .append('<input id="adiagpdiag_notes' + diagIndex + '" name="diag_notes[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                )
                .append("<td><a href='#' onclick='$(\"#adiagpdiag" + diagIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-trash'></i></a></td>")
            );

        initializeDiagPerawatSelect2("adiagpdiagnosan_id" + diagIndex, diag_id, diag_name)
    }

    function selectedDiagNursePerawat(index) {
        var diagname = $("#adiagpdiagnosan_id" + index).text()
        if (typeof diagname !== 'undefined') {
            $("#adiagpdiag_notes" + index).val(diagname)
        }
    }

    function removetextdiagperawat(index) {
        $("#adiagpdiagnosan_id" + index).text("")
    }
</script>

<script>
    function getAssessmentDocument(diagCat) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentDocument',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'diagCat': diagCat
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#accordionDiagnosa").html("")
                $("#accordionDiagnosaPerawat").html("")
                pasienDiagnosaAll = data.pasienDiagnosa
                examForassessment = data.examInfo

                pasienDiagnosasAll = data.pasienDiagnosas
                proceduresAll = data.pasienProcedures
                diagPerawatAll = data.pasienDiagnosasNurse

                if (pasienDiagnosaAll.length > 0) {
                    $.each(pasienDiagnosaAll, function(key, value) {
                        appendDiagnosa("accordionDiagnosa", value.pasien_diagnosa_id, value)
                    })
                }
                if (examForassessment.length > 0) {
                    $.each(examForassessment, function(key, value) {
                        appendDiagnosaPerawat("accordionDiagnosaPerawat", value.body_id, value)
                    })
                }
            },
            error: function() {

            }
        });
    }
</script>