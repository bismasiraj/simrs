<script>
    var pasienDiagnosasAll = [];
    $("#diagnosaTab").on("mouseup", function() {
        getAssessmentDocument()
    })
</script>
<script>
    function disableArmDiag(bodyId) {
        $("#formaddarm" + bodyId).find("input, textarea, select").prop("readonly", true)

        $("#formsavearmbtn" + bodyId).hide()
        $("#formeditarm" + bodyId).show()
        $("#formsignarm" + bodyId).hide()
        $("#formcetakarm" + bodyId).hide()
    }

    function enableArmDiag(bodyId) {
        $("#formaddarm" + bodyId).find(".enablekan").prop("readonly", true)

        $("#formsavearmbtn" + bodyId).show()
        $("#formeditarm" + bodyId).hide()
        $("#formsignarm" + bodyId).show()
        $("#formcetakarm" + bodyId).show()
    }

    function appendDiagnosa(accordionId, bodyId, pasienDiagnosa) {
        console.log(pasienDiagnosa)
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
                        <input type="hidden" id="adiagpasien_diagnosa_id" name="pasien_diagnosa_id"/>
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
                                <table id="tablediagnosa" class="table" data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
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
                addRowDiagDokter('bodyDiagMedis', bodyId, value.diagnosa_id, value.dianogsa_name, value.diag_cat)
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
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function(index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        getAssessmentMedis($("#armdiag_cat").val())
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

    function appendDiagnosaPerawat(accordionId, bodyId) {
        var accordionContent = `
        <div id="adiagGroup` + bodyId + `" class="accordion-item">
            <h2 class="accordion-header" id="headingDiagGroup` + bodyId + `">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaPerawat` + bodyId + `" aria-expanded="false" aria-controls="collapseDiagnosa` + bodyId + `">
                    <b>Diagnosa Perawat Assessment Keperawatan</b>
                </button>
            </h2>
            <div id="collapseDiagnosaPerawat` + bodyId + `" class="accordion-collapse collapse" aria-labelledby="headingDiagGroup` + bodyId + `" data-bs-parent="#accordionDiagnosa` + bodyId + `" style="">
                <div class="accordion-body text-muted">
                    <div id="groupDiagnosaPerawat` + bodyId + `" class="row mb-2" <?= isset($group[11]) ? 'style="display: none"' : '' ?>>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="mb-4">
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table id="tableDiagnosaPerawatMedis` + bodyId + `" class="table" data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                            <thead>
                                                <th class="text-center" style="width: 40%">DiagnosaPerawat</th>
                                                <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                            </thead>
                                            <tbody id="bodyDiagPerawat` + bodyId + `">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag" name="addDiagnosaPerawat" onclick="addRowDiagPerawat('bodyDiagPerawat` + bodyId + `', '` + bodyId + `')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        appendAccordionItem(accordionId, accordionContent);
    }
</script>
<script>
    function addRowDiagDokter(container, bodyId, diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
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
            .append($('<tr id="diag' + diagIndex + '">')
                .append($('<td>')
                    .append('<select id="diag_id' + diagIndex + '" class="form-control enablekan" name="diag_id[]" onchange="selectedDiagnosa(\'' + diagIndex + '\')" style="width: 100%"></select>')
                    .append('<input id="diag_name' + diagIndex + '" name="diag_name[]" placeholder="" type="text" class="form-control block enablekan" value="" style="display: none" />')
                    .append('<input id="sscondition_id' + diagIndex + '" name="sscondition_id[]" placeholder="" type="text" class="form-control block enablekan" value="" style="display: none" />')
                )
                .append($('<td>')
                    .append($("<select class=\"form-control enablekan\">")
                        .attr('name', 'suffer_type[]').attr('id', 'suffer_type' + diagIndex) <?php foreach ($suffer as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $suffer[$key]['suffer_type']; ?>').html('<?= $suffer[$key]['suffer']; ?>')
                            ) <?php } ?>
                        .val(diag_suffer)
                    )
                )
                .append($('<td>')
                    .append($("<select class=\"form-control enablekan\">")
                        .attr('name', 'diag_cat[]').attr('id', 'diag_cat' + diagIndex) <?php foreach ($diagCat as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                            ) <?php } ?>
                        .val(diag_cat)
                    )
                )
                .append("<td><a href='#' onclick='$(\"#diag" + diagIndex + "\").remove()' class='btn closebtn btn-xs pull-right enablekan' data-toggle='modal' title=''><i class='fa fa-trash'></i></a></td>")
            );

        initializeDiagSelect2("diag_id" + diagIndex, diag_id, diag_name)
        $("#suffer_type" + diagIndex).val(0)
        $("#diag_cat" + diagIndex).val(diag_cat)
    }

    function addRowDiagPerawat(container, bodyId, diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
        diagIndex++;
        if (diag_cat == null) {
            diag_cat = 1
        }
        if (diag_cat == null && diagIndex > 1) {
            diag_cat = 2
        }
        $("#" + container)
            .append($('<tr id="adiagdiag' + diagIndex + '">')
                // .append($('<td>').html(diagIndex + "."))
                .append($('<td>')
                    .append('<select id="adiagdiag_id' + diagIndex + '" class="form-control" name="diag_id[]" onchange="selectedDiagNurse(' + diagIndex + ')" style="width: 100%"></select>')
                    .append('<input id="adiagdiag_name' + diagIndex + '" name="diag_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    .append('<input id="adiagsscondition_id' + diagIndex + '" name="sscondition_id[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
                )
                // .append($('<td>')
                //     .append($('<input>').attr('name', 'diag_name[]').attr('id', 'diag_name' + diagIndex).attr('value', diag_name).attr('type', 'text').attr('readonly', 'readonly'))
                // )
                .append($('<td>')
                    .append($("<select class=\"form-control\">")
                        .attr('name', 'suffer_type[]').attr('id', 'adiagsuffer_type' + diagIndex) <?php foreach ($suffer as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $suffer[$key]['suffer_type']; ?>').html('<?= $suffer[$key]['suffer']; ?>')
                            ) <?php } ?>
                        .val(diag_suffer)
                    )
                )
                .append($('<td>')
                    .append($("<select class=\"form-control\">")
                        .attr('name', 'diag_cat[]').attr('id', 'diag_cat' + diagIndex) <?php foreach ($diagCat as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                            ) <?php } ?>
                        .val(diag_cat)
                    )
                )
                .append("<td><a href='#' onclick='$(\"#diag" + diagIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-trash'></i></a></td>")
            );

        initializeDiagPerawatSelect2("adiagdiag_id" + diagIndex, diag_id, diag_name)
        $("#adiagsuffer_type" + diagIndex).val(0)
        $("#adiagdiag_cat" + diagIndex).val(diagIndex)
    }

    function selectedDiagnosa(index) {
        var diagname = $("#adiagdiag_id" + index).text()
        console.log(diagname)
        if (typeof diagname !== 'undefined') {
            $("#adiagdiag_name" + index).val(diagname)
        }
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
                pasienDiagnosaAll = data.pasienDiagnosa
                examForassessment = data.examInfo

                pasienDiagnosasAll = data.pasienDiagnosas

                if (pasienDiagnosaAll.length > 0) {
                    $.each(pasienDiagnosaAll, function(key, value) {
                        appendDiagnosa("accordionDiagnosa", value.pasien_diagnosa_id, value)
                    })
                }
                // if (examForassessment.length > 0) {
                //     $.each(examForassessment, function(key, value) {
                //         appendDiagnosaPerawat("accordionDiagnosa", value.body_id)
                //     })
                // }
            },
            error: function() {

            }
        });
    }
</script>