<script>
    var pasienDiagnosasAll = [];
    var diagPerawatAll = [];
    var iDocDiag = 0;
    var iDocProc = 0;
    $("#diagnosaTab").on("mouseup", function() {
        $('#dokter-diag-tab').trigger("click")


        $('#perawat-diag-tab').on('click', function() {
            $('#dokter-diag-content').removeClass('show active');
            $('#dokter-diag-tab').removeClass('active').attr('aria-selected', 'false');

            $('#perawat-diag-content').addClass('show active');
            $('#perawat-diag-tab').addClass('active').attr('aria-selected', 'true');
        });

        $('#dokter-diag-tab').on('click', function() {
            $('#perawat-diag-content').removeClass('show active');
            $('#perawat-diag-tab').removeClass('active').attr('aria-selected', 'false');

            $('#dokter-diag-content').addClass('show active');
            $('#dokter-diag-tab').addClass('active').attr('aria-selected', 'true');
        });
        getAssessmentDocument()
    })
</script>
<script>
    function disableArmDiag(bodyId) {
        $("#formAddDiagnosa" + bodyId).find("input, textarea, select").prop("disabled", true)

        $("#formAddDiagnosaSaveBtn" + bodyId).slideUp()
        $("#formeditarm" + bodyId).slideDown()
        $("#formsignarm" + bodyId).slideUp()
        $("#formcetakarm" + bodyId).slideUp()
    }

    function enableArmDiag(bodyId) {
        $("#formAddDiagnosa" + bodyId).find("input, textarea, select").prop("disabled", false)

        $("#formAddDiagnosaSaveBtn" + bodyId).slideDown()
        $("#formeditarm" + bodyId).slideUp()
        $("#formsignarm" + bodyId).slideDown()
        $("#formcetakarm" + bodyId).slideDown()
    }

    function appendPemeriksaanFisikDiag(bodyId) {
        let accordionContent = ''
        $.each(lokalisAll, function(key, value) {
            if (value?.value_score == 2 && value?.body_id == bodyId) {
                $("#pemeriksaanFisik" + bodyId).append(
                    `<div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="${value?.p_type+ value?.parameter_id+ value?.value_id + bodyId}">${value?.value_desc}</label>
                                            <textarea id="${value?.p_type+ value?.parameter_id+ value?.value_id+ bodyId}" name="fisik${value?.value_id}" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>`)
                $(`#${value?.p_type+ value?.parameter_id+ value?.value_id+ bodyId}`).val(value?.value_detail)
            }
        })

        return accordionContent
    }
    const declareAddDiag = (bodyId) => {
        initializeSearchDiag("searchDiag" + bodyId, 'diag');
        $("#searchDiag" + bodyId).on('select2:select', function(e) {
            let data = {
                bodyId: bodyId,
                kddiag: $("#searchDiag" + bodyId).val(),
                nmdiag: $("#searchDiag" + bodyId).text()
            }
            addRowDiagDokter(data)
            $("#searchDiag" + bodyId).click()
            $("#searchDiag" + bodyId).click()
            $("#searchDiag" + bodyId).select2('open')
            $("#searchDiag" + bodyId).text(null).trigger('change');
            $("#searchDiag" + bodyId).val(null).trigger('change');
        });
    }
    const declareAddProc = (bodyId) => {
        initializeSearchDiag("searchProc" + bodyId, 'proc');
        $("#searchProc" + bodyId).on('select2:select', function(e) {
            let data = {
                bodyId: bodyId,
                kddiag: $("#searchProc" + bodyId).val(),
                nmdiag: $("#searchProc" + bodyId).text()
            }
            addRowProcDokter(data)
            $("#searchProc" + bodyId).click()
            $("#searchProc" + bodyId).click()
            $("#searchProc" + bodyId).select2('open')
            $("#searchProc" + bodyId).text(null).trigger('change');
            $("#searchProc" + bodyId).val(null).trigger('change');
        });
    }

    function appendDiagnosa(accordionId, bodyId, pasienDiagnosa) {

        var titleDoc = ''
        var titlerj = '';

        var body_id = bodyId
        bodyId = bodyId.replace(/\./g, '');


        if (pasienDiagnosa?.class_room_id != '' && pasienDiagnosa?.class_room_id != null) {
            titlerj = ' RAWAT JALAN '
        } else {
            titlerj = ' RAWAT JALAN '
        }
        if (pasienDiagnosa?.diag_cat == '1' || pasienDiagnosa?.account_id == '7')
            titleDoc = 'RESUME MEDIS';
        else {
            titleDoc = ("ASESMEN MEDIS ")
            if (pasienDiagnosa?.clinic_id != 'P012') {
                titleDoc = (titleDoc + " " + pasienDiagnosa?.specialist_type + titlerj)
            } else if (pasienDiagnosa?.clinic_id == 'P012') {
                titleDoc = (titleDoc + " IGD")
            }
        }


        var accordionContent = `
            <div id="adiagGroup` + bodyId + `" class="accordion-item">
            <h2 class="accordion-header" id="headingDiagnosaMedis` + bodyId +
            `">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaDokter` +
            bodyId +
            `" aria-expanded="false" aria-controls="collapseDiagnosa` + bodyId + `">
                    <b>DIAGNOSA  ` + titleDoc + ` | ${pasienDiagnosa?.date_of_diagnosa
                                                ? pasienDiagnosa.date_of_diagnosa.slice(0, 16)
                                                : pasienDiagnosa?.examination_date || ""
                                            } | ${'by: ' + pasienDiagnosa?.fullname}</b>
                </button>
            </h2>
            <div id="collapseDiagnosaDokter` + bodyId +
            `" class="accordion-collapse collapse" aria-labelledby="headingDiagnosaMedis` + bodyId + `" data-bs-parent="#accordionDiagnosa" style="">
                <div class="accordion-body text-muted">
                    <form id="formAddDiagnosa` + bodyId + `">
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
                                        <input name="date_of_diagnosa" id="adiagdate_of_diagnosa` + bodyId + `" type="datetime-local" class="form-control" value="<?php date('Y/m/d H:i:s'); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <?php if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '')) { ?>
                                            <label for="adiagclinic_id` + bodyId + `">Bangsal</label>
                                        <?php } else { ?>
                                            <label for="adiagclinic_id` + bodyId + `">Poli</label>
                                        <?php } ?>
                                        <select name="clinic_id" id="adiagclinic_id` + bodyId + `" type="hidden" class="form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiagemployee_id` + bodyId + `">Dokter</label>
                                        <select name="employee_id" id="adiagemployee_id` + bodyId + `" type="hidden" class="form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Anamnase</h4>
                            <hr>
                            <div class="col-sm-12 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiagdescription` + bodyId + `">Keluhan Utama</label>
                                        <textarea id="adiagdescription` + bodyId + `" name="description" rows="4" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Riwayat Penyakit Sekarang</h4>
                            <hr>
                            <div class="col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiaganamnase` + bodyId + `">Autoanamnesis</label>
                                        <textarea id="adiaganamnase` + bodyId + `" name="anamnase" rows="8" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiagalloanamnase` + bodyId + `">Alloanamnesis</label>
                                        <textarea id="adiagalloanamnase` + bodyId + `" name="alloanamnase" rows="8" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Pemeriksaan Fisik</h4>
                            <hr>
                            <div class="col-sm-12 col-xs-12">
                                <div id="pemeriksaanFisik${bodyId}" class="row">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiagdiagnosa_desc${bodyId}">Diagnosa Klinis</label>
                                        <textarea id="adiagdiagnosa_desc${bodyId}" name="diagnosa_desc" rows="2" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="adiagdiagnosa_desc_discharge${bodyId}">Diagnosa Pulang</label>
                                        <textarea id="adiagdiagnosa_desc_discharge${bodyId}" name="diagnosa_desc_discharge" rows="2" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="table tablecustom-responsive">
                                <table id="tablediagnosa" class="table">
                                    <thead>
                                        <th class="text-center" style="width: 10%"></th>
                                        <th class="text-center" style="width: 50%">Diagnosa</th>
                                        <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                    </thead>
                                    <tbody id="bodyDiagMedis${bodyId}">
                                    </tbody>
                                </table>
                            </div>
                            <?php if (user()->checkPermission("assessmentmedis", "u")) {
                            ?>
                                <div class="box-tab-tools" style="text-align: center;">
                                        <select id="searchDiag${bodyId}" class="form-control fit" style="width: 100%;"></select>
                                </div>
                                    <?php
                                } ?>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-4">
                                    <div class="table tablecustom-responsive">
                                        <table id="tableprocedure" class="table table-borderedcustom table-hover ">
                                            <thead>
                                                <th class="text-center" style="width: 10%"></th>
                                                <th class="text-center" style="width: 90%">Prosedur (ICD IX)</th>
                                            </thead>
                                            <tbody id="bodyProcMedis` + bodyId + `">
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if (user()->checkPermission("assessmentmedis", "u")) {
                                    ?>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <select id="searchProc${bodyId}" class="form-control fit" style="width: 100%;"></select>
                                    </div>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                        <?php if (user()->checkPermission("assessmentmedis", "u")) {
                        ?>
                        <div class="panel-footer text-end mb-4">
                            <button type="button" id="formAddDiagnosaSaveBtn` + bodyId + `" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="formeditarm` + bodyId +
            `" name="editrm" onclick="enableArmDiag('` + bodyId + `')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                            <button type="button" id="formsignarm` + bodyId + `" name="signrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                            <button type="button" id="formcetakarm` + bodyId + `" name="" onclick="cetakAssessmentMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fa fa-signature"></i> <span>Cetak</span></button>
                        </div>
                        <?php
                        } ?>
                        </div>
                    </form>
                </div>
            </div>
         </div>
         `;

        appendAccordionItem(accordionId, accordionContent);
        appendPemeriksaanFisikDiag(pasienDiagnosa?.pasien_diagnosa_id)

        $("#adiagdescription" + bodyId).val(pasienDiagnosa.description)
        $("#adiaganamnase" + bodyId).val(pasienDiagnosa.anamnase)
        $("#adiagalloanamnase" + bodyId).val(pasienDiagnosa.alloanamnase)
        $("#adiagdiagnosa_desc" + bodyId).val(pasienDiagnosa.diagnosa_desc)
        $("#adiagdiagnosa_desc_discharge" + bodyId).val(pasienDiagnosa.diagnosa_desc_discharge)
        $("#adiagpasien_diagnosa_id" + bodyId).val(pasienDiagnosa.pasien_diagnosa_id)
        $("#adiagdate_of_diagnosa" + bodyId).val(pasienDiagnosa.date_of_diagnosa)
        $("#adiagclinic_id" + bodyId).html(`<option value="` + pasienDiagnosa.clinic_id + `">` + pasienDiagnosa
            .name_of_clinic + `</option>`)
        $("#adiagemployee_id" + bodyId).html(`<option value="` + pasienDiagnosa.employee_id + `">` + pasienDiagnosa
            .fullname + `</option>`)
        $("#adiagmedical_problem" + bodyId).val(pasienDiagnosa.medical_problem)
        $("#adiaghurt" + bodyId).val(pasienDiagnosa.hurt)
        $("#adiagdiagnosa_desc" + bodyId).val(pasienDiagnosa.diagnosa_desc)

        $.each(pasienDiagnosasAll, function(key, value) {
            if (value.pasien_diagnosa_id == pasienDiagnosa.pasien_diagnosa_id) {
                let data = {
                    bodyId: body_id,
                    kddiag: value?.diagnosa_id,
                    nmdiag: value?.diagnosa_name,
                    diagcat: value?.diag_cat
                }
                addRowDiagDokter(data)
            }
        })
        $.each(proceduresAll, function(key, value) {
            if (value.pasien_diagnosa_id == pasienDiagnosa.pasien_diagnosa_id) {
                let data = {
                    bodyId: body_id,
                    kddiag: value?.diagnosa_id,
                    nmdiag: value?.diagnosa_name
                }
                addRowProcDokter(data)
            }
        })
        declareAddDiag(bodyId)
        declareAddProc(bodyId)
        $("#formAddDiagnosaSaveBtn" + bodyId).on('click', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();

            postDataForm(new FormData(document.getElementById("formAddDiagnosa" + bodyId)),
                'admin/DiagnosaC/addAssessmentMedisDiagnosa',
                function(data) {
                    disableArmDiag(bodyId)
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function(index, value) {
                            message += value;
                        });
                        // errorMsg(message);
                    } else {
                        successSwal("Berhasil Simpan")
                        const data = {
                            pasien_diagnosa_id: body_id,
                            visit_id: visit?.visit_id
                        }
                        postConditionSatuSehat(data)
                    }
                    clicked_submit_btn.button('reset');
                },
                function() {
                    clicked_submit_btn.button('loading');
                })
        }));
    }
</script>
<script>
    function addRowDiagPerawat(container, bodyId, diag_id = null, diag_notes = null, exam = null) {
        let tbody = document.getElementById(container + bodyId);
        let diagIndex = tbody.getElementsByTagName("tr").length;
        diagIndex = bodyId + diagIndex;
        let $row = $('<tr id="' + container + bodyId + diagIndex + '">')
            .append($('<td>')
                .append('<select id="adiagpdiagnosan_id' + diagIndex +
                    '" class="form-control" name="diagnosan_id[]" style="width: 100%"></select>')
                .append('<input id="adiagpdiag_notes' + diagIndex +
                    '" name="diag_notes[]" placeholder="" type="text" class="form-control block" value="' +
                    diag_notes + '" style="display: none" />'
                )

            )
            .append('<td><div onclick="$(\'#' + container + bodyId + diagIndex +
                '\').remove()" class="btn closebtn btn-xs pull-right pointer" data-toggle="modal" title=""><i class="fa fa-trash"></i></div></td>'
            )
            // .append('<td><div onclick="$(\'#' + container + bodyId + diagIndex +
            //     '\').remove()" class="btn closebtn btn-xs pull-right pointer" data-toggle="modal" title=""><i class="fa fa-trash"></i></div></td>'
            // )
            .append(`<td><button type="button" data-diag-id="${diag_id}" id="formAskepModalBtn` +
                bodyId +
                `${diag_id !== null ? diag_id.replace('.', '_') : ''}" name="askep" data-loading-text="<?php echo lang('processing') ?>" class="formAskepModalBtn btn btn-sm btn-outline-dark pull-right d-flex align-items-center gap-2" ${diag_id == null ? 'disabled' : ''}><i class="fa fa-notes-medical"></i> <span> Askep</span></button> </td>`
            )


        $("#" + container + bodyId).append($row);


        initializeDiagPerawatSelect2("adiagpdiagnosan_id" + diagIndex, diag_id, diag_notes);


        $("#adiagpdiagnosan_id" + diagIndex).on('focus', function() {
            removetextdiag(diagIndex);
        }).on('change', function() {
            selectedDiagNursePerawat(diagIndex);
        });

        actionBtnModal({
            data: `formAskepModalBtn` + bodyId + (diag_id !== null ? diag_id.replace('.', '_') : ''),
            id: bodyId,
            diag_id: diag_id,
            exam_date: exam?.examination_date ?? null
        })
    } // new update 30/07
    function addRowDiagDokter(props) {
        let bodyId = props?.bodyId;
        let kddiag = props?.kddiag;
        let nmdiag = props?.nmdiag;
        let diag_cat = props?.diagcat;
        iDocDiag++;
        $("#bodyDiagMedis" + bodyId)
            .append($(`<tr id="adiagbodyDiagMedis${iDocDiag}">`)
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="diagnosa_id[]" id="adiagdiagnosa_id${iDocDiag}" value="${kddiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="diagnosa_name[]" id="adiagdiagnosa_name${iDocDiag}" value="${nmdiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($('<td>')
                    .append($(`<div class="p-2">`)
                        .append($('<select class="form-select">')
                            .attr('name', 'diag_cat[]').attr('id', 'adiagdiag_cat' + iDocDiag) <?php foreach ($diagCat as $key => $value) { ?>
                                .append($("<option>")
                                    .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                                ) <?php } ?>
                        )
                    )
                )
                .append($(`<td><button type="button" onclick='$("#adiagbodyDiagMedis${iDocDiag}").remove()' class="btn closebtn btn-xs pull-right text-danger" data-toggle="modal" title=""><i class="fa fa-trash"></i></button></td>`))
            )
        const rowCount = document.querySelectorAll("#bodyDiagMedis" + bodyId + " tr").length;


        if (diag_cat != null) {
            $("#adiagdiag_cat" + iDocDiag).val(diag_cat)
        } else {
            if (rowCount == 1)
                $("#adiagdiag_cat" + iDocDiag).val(1)
            else
                $("#adiagdiag_cat" + iDocDiag).val(2)
        }
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
    function addRowProcDokter(props) {
        let bodyId = props?.bodyId;
        let kddiag = props?.kddiag;
        let nmdiag = props?.nmdiag;
        iDocProc++;

        $("#bodyProcMedis" + bodyId)
            .append($(`<tr id="adiagbodyProcMedis${iDocProc}">`)
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="proc_id[]" id="adiagdiagnosa_id${iDocDiag}" value="${kddiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="proc_name[]" id="adiagdiagnosa_name${iDocDiag}" value="${nmdiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($(`<td><button type="button" onclick='$("#adiagbodyProcMedis${iDocDiag}").remove()' class="btn closebtn btn-xs pull-right text-danger" data-toggle="modal" title=""><i class="fa fa-trash"></i></button></td>`))
            );
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

        $("#formDiagPerawatSaveBtn" + bodyId).slideUp()
        $("#formDiagPerawatEditBtn" + bodyId).slideDown()
        $("#formDiagPerawatSignBtn" + bodyId).slideUp()
        $("#formDiagPerawatCetakBtn" + bodyId).slideUp()
    }

    function enableArpDiag(bodyId) {
        $("#formDiagPerawat" + bodyId).find("input, textarea, select").prop("disabled", false)

        $("#formDiagPerawatSaveBtn" + bodyId).slideDown()
        $("#formDiagPerawatEditBtn" + bodyId).slideUp()
        $("#formDiagPerawatSignBtn" + bodyId).slideDown()
        $("#formDiagPerawatCetakBtn" + bodyId).slideDown()
    }

    const appendDiagnosaPerawat = (accordionId, bodyId, exam) => {

        let title = 'Diagnosa Perawat | Assessment Keperawatan Umum | ' + exam?.examination_date?.slice(0, 16)

        var body_id = bodyId
        bodyId = bodyId.replace(/\./g, '');
        if (exam?.account_id == '3') {
            title = 'Diagnosa Perawat | CPPT SOAP | ' + exam?.examination_date?.slice(0, 16) +
                ' | by: ' + exam?.petugas
        } else {
            if (exam?.vs_status_id == '1') {
                title = 'Diagnosa Perawat | Assessment Keperawatan Dewasa | ' + exam?.examination_date?.slice(0, 16) +
                    ' | by: ' + exam?.petugas
            } else if (exam?.vs_status_id == '4') {
                title = 'Diagnosa Perawat | Assessment Keperawatan Anak | ' + exam?.examination_date?.slice(0, 16) +
                    ' | by: ' + exam?.petugas
            } else if (exam?.vs_status_id == '5') {
                title = 'Diagnosa Perawat | Assessment Keperawatan Neonatus | ' + exam?.examination_date?.slice(0, 16) +
                    ' | by: ' + exam?.petugas
            } else if (exam?.vs_status_id == '2' || exam?.vs_status_id == '7') {
                title = 'Diagnosa Perawat | CPPT | ' + exam?.examination_date?.slice(0, 16) + ' | by: ' + exam?.petugas
            }
        }

        var accordionContent = `
        <div id="adiagpGroup` + bodyId + `" class="accordion-item">
            <h2 class="accordion-header" id="headingDiagGroup` + bodyId +
            `">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaPerawat` +
            bodyId +
            `" aria-expanded="false" aria-controls="collapseDiagnosaPerawat` + bodyId + `">
                    <b>${title}</b>
                </button>
            </h2>
            <div id="collapseDiagnosaPerawat` + bodyId +
            `" class="accordion-collapse collapse" aria-labelledby="headingDiagGroup` + bodyId + `" data-bs-parent="#accordionDiagnosaPerawatcppt" style="">
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
                                            <?php if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '')) { ?>
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
                                    <div class="row">
                                        <h4>CPPT SOAP</h4>
                                        <hr>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="adiagsubyektif` + bodyId + `">S</label>
                                                    <textarea id="adiagsubyektif` + bodyId + `" name="subyektif" rows="8" class="form-control " autocomplete="off" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="adiagobyektif` + bodyId + `">O</label>
                                                    <textarea id="adiagobyektif` + bodyId + `" name="obyektif" rows="8" class="form-control " autocomplete="off" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="adiagasesmen` + bodyId + `">A</label>
                                                    <textarea id="adiagasesmen` + bodyId + `" name="anamnase" rows="8" class="form-control " autocomplete="off" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="adiagplanning` + bodyId + `">P</label>
                                                    <textarea id="adiagplanning` + bodyId + `" name="alloanamnase" rows="8" class="form-control " autocomplete="off" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="table tablecustom-responsive">
                                            <table id="tableDiagnosaPerawatMedis` + bodyId + `" class="table">
                                                <thead>
                                                    <th class="text-center" style="width: 100%" colspan="2">DiagnosaPerawat</th>
                                                </thead>
                                                <tbody id="bodyDiagPerawat` + bodyId +
            `">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" id="formdiag" name="addDiagnosaPerawat" onclick="addRowDiagPerawat('bodyDiagPerawat', '` +
            bodyId + `')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-plus"></i> <span>Diagnosa</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="panel-footer text-end mb-4">
                                        <button type="button" id="formDiagPerawatSaveBtn` + bodyId + `" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                        <button type="button" id="formDiagPerawatEditBtn` + bodyId +
            `" name="editrm" onclick="enableArpDiag('` + bodyId + `')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                        <button type="button" id="formDiagPerawatSignBtn` + bodyId + `" name="signrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                        <button type="button" id="formDiagPerawatCetakBtn` + bodyId +
            `" name="" onclick="cetakAssessmentMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fa fa-signature"></i> <span>Cetak</span></button>

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
        $("#adiagpclinic_id" + bodyId).html(`<option value="` + exam.clinic_id + `">` + exam.name_of_clinic +
            `</option>`)
        $("#adiagpemployee_id" + bodyId).html(`<option value="` + exam.employee_id + `">` + exam.fullname + `</option>`)

        $("#adiagsubyektif" + bodyId).val(exam.anamnase)
        $("#adiagobyektif" + bodyId).val(exam.alo_anamnase)
        $("#adiagasesmen" + bodyId).val(exam.teraphy_desc)
        $("#adiagplanning" + bodyId).val(exam.instruction)
        $("#adiagpbody_id" + bodyId).val(exam.body_id)
        $("#adiagpvisit_id" + bodyId).val(exam.visit_id)
        $("#adiagptrans_id" + bodyId).val(exam.trans_id)
        $("#adiagpclass_room_id" + bodyId).val(exam.class_room_id)
        $("#adiagexamination_date" + bodyId).val(exam.examination_date)
        $("#adiagpclinic_id" + bodyId).html(`<option value="` + exam.clinic_id + `">` + exam.name_of_clinic +
            `</option>`)
        $("#adiagpemployee_id" + bodyId).html(`<option value="` + exam.employee_id + `">` + exam.fullname + `</option>`)
        $("#adiagpbed_id" + bodyId).val(exam.bed_id)
        $("#adiagpno_registration" + bodyId).val(exam.no_registration)
        // $.each(diagPerawatAll, function(key, value) {
        //     if (value.document_id == exam.body_id) {
        //         addRowDiagPerawat('bodyDiagPerawat', bodyId, value.diagnosan_id, value.diag_notes, exam)
        //     }
        // })

        $("#formDiagPerawatSaveBtn" + bodyId).on('click', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/DiagnosaC/addDiagnosaKeperawatan',
                type: "POST",
                data: new FormData(document.getElementById("formDiagPerawat" + bodyId)),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    clicked_submit_btn.button('loading');

                    $('#bodyDiagPerawat' + bodyId + ' select[name="diagnosan_id[]"]').each(
                        function() {

                            const selectedOption = $(this).find('option:selected');
                            const button_askep = $(this).closest('tr').find(
                                '.formAskepModalBtn')
                            button_askep.removeAttr('disabled');
                            // $('#formAskepModalBtn' + bodyId + selectedOption.val()).removeAttr('disabled')
                        });

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
                        successSwal("Berhasil Simpan")
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

    const appendDiagnosaDokter = (accordionId, bodyId, exam) => {
        var body_id = bodyId
        bodyId = bodyId.replace(/\./g, '');

        // let title = 'Diagnosa CPPT | ' + exam?.examination_date?.slice(0, 16)

        // if (exam?.vs_status_id == '1') {
        //     title = 'Diagnosa Perawat | Assessment Keperawatan Dewasa | ' + exam?.examination_date?.slice(0, 16) +
        //         ' | by: ' + exam?.petugas
        // } else if (exam?.vs_status_id == '4') {
        //     title = 'Diagnosa Perawat | Assessment Keperawatan Anak | ' + exam?.examination_date?.slice(0, 16) +
        //         ' | by: ' + exam?.petugas
        // } else if (exam?.vs_status_id == '5') {
        //     title = 'Diagnosa Perawat | Assessment Keperawatan Neonatus | ' + exam?.examination_date?.slice(0, 16) +
        //         ' | by: ' + exam?.petugas
        // } else if (exam?.vs_status_id == '2' || exam?.vs_status_id == '7') {
        let title = 'Diagnosa Dokter | CPPT | ' + exam?.examination_date?.slice(0, 16) + ' | by: ' + exam?.petugas
        console.log(exam)
        // }
        var accordionContent = `
    <div id="adiagpGroup` + bodyId + `" class="accordion-item">
        <h2 class="accordion-header" id="headingDiagGroup` + bodyId +
            `">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaDoktercppt` +
            bodyId +
            `" aria-expanded="false" aria-controls="collapseDiagnosaDoktercppt` + bodyId + `">
                <b>${title}</b>
            </button>
        </h2>
        <div id="collapseDiagnosaDoktercppt` + bodyId +
            `" class="accordion-collapse collapse" aria-labelledby="headingDiagGroup` + bodyId + `" data-bs-parent="#accordionDiagnosaDoktercppt" style="">
            <div class="accordion-body text-muted">
                <div id="groupDiagnosaDoktercppt` + bodyId + `" class="row mb-2" <?= isset($group[11]) ? 'style="display: none"' : '' ?>>
                    <form id="formDiagDoktercppt` + bodyId + `">
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
                                        <?php if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '')) { ?>
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
                                <div class="row">
                                    <h4>CPPT SOAP</h4>
                                    <hr>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="adiagsubyektif` + bodyId + `">S</label>
                                                <textarea id="adiagsubyektif` + bodyId + `" name="subyektif" rows="8" class="form-control " autocomplete="off" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="adiagobyektif` + bodyId + `">O</label>
                                                <textarea id="adiagobyektif` + bodyId + `" name="obyektif" rows="8" class="form-control " autocomplete="off" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="adiagasesmen` + bodyId + `">A</label>
                                                <textarea id="adiagasesmen` + bodyId + `" name="anamnase" rows="8" class="form-control " autocomplete="off" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="adiagplanning` + bodyId + `">P</label>
                                                <textarea id="adiagplanning` + bodyId + `" name="alloanamnase" rows="8" class="form-control " autocomplete="off" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="table tablecustom-responsive">
                                        <table id="tablediagnosa" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 10%"></th>
                                                <th class="text-center" style="width: 50%">Diagnosa</th>
                                                <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                            </thead>
                                            <tbody id="bodyDiagMedis${bodyId}">
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if (user()->checkPermission("assessmentmedis", "u")) {
                                    ?>
                                        <div class="box-tab-tools" style="text-align: center;">
                                                <select id="searchDiag${bodyId}" class="form-control fit" style="width: 100%;"></select>
                                        </div>
                                            <?php
                                        } ?>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="mb-4">
                                            <div class="table tablecustom-responsive">
                                                <table id="tableprocedure" class="table table-borderedcustom table-hover ">
                                                    <thead>
                                                        <th class="text-center" style="width: 10%"></th>
                                                        <th class="text-center" style="width: 90%">Prosedur (ICD IX)</th>
                                                    </thead>
                                                    <tbody id="bodyProcMedis` + bodyId + `">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php if (user()->checkPermission("assessmentmedis", "u")) {
                                            ?>
                                            <div class="box-tab-tools" style="text-align: center;">
                                                <select id="searchProc${bodyId}" class="form-control fit" style="width: 100%;"></select>
                                            </div>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            <div class="row mb-2">
                                <div class="panel-footer text-end mb-4">
                                    <button type="button" id="formDiagDokterCpptSaveBtn` + bodyId + `" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                    <button type="button" id="formDiagDokterCpptEditBtn` + bodyId +
            `" name="editrm" onclick="enableArpDiag('` + bodyId + `')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                                    <button type="button" id="formDiagDokterCpptSignBtn` + bodyId + `" name="signrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                    <button type="button" id="formDiagDokterCpptCetakBtn` + bodyId +
            `" name="" onclick="cetakAssessmentMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fa fa-signature"></i> <span>Cetak</span></button>

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
        $("#adiagpclinic_id" + bodyId).html(`<option value="` + exam.clinic_id + `">` + exam.name_of_clinic +
            `</option>`)
        $("#adiagpemployee_id" + bodyId).html(`<option value="` + exam.employee_id + `">` + exam.fullname + `</option>`)

        $("#adiagpbody_id" + bodyId).val(exam.body_id)
        $("#adiagpvisit_id" + bodyId).val(exam.visit_id)
        $("#adiagptrans_id" + bodyId).val(exam.trans_id)
        $("#adiagpclass_room_id" + bodyId).val(exam.class_room_id)
        $("#adiagpbed_id" + bodyId).val(exam.bed_id)
        $("#adiagpno_registration" + bodyId).val(exam.no_registration)

        $("#adiagdescription" + bodyId).val(exam.description)
        $("#adiagsubyektif" + bodyId).val(exam.anamnase)
        $("#adiagobyektif" + bodyId).val(exam.alo_anamnase)
        $("#adiagasesmen" + bodyId).val(exam.teraphy_desc)
        $("#adiagplanning" + bodyId).val(exam.instruction)


        $("#adiagdate_of_diagnosa" + bodyId).val(pasienDiagnosa.date_of_diagnosa)
        $("#adiagclinic_id" + bodyId).html(`<option value="` + pasienDiagnosa.clinic_id + `">` + pasienDiagnosa
            .name_of_clinic + `</option>`)
        $("#adiagemployee_id" + bodyId).html(`<option value="` + pasienDiagnosa.employee_id + `">` + pasienDiagnosa
            .fullname + `</option>`)
        $("#adiagmedical_problem" + bodyId).val(pasienDiagnosa.medical_problem)
        $("#adiaghurt" + bodyId).val(pasienDiagnosa.hurt)
        // $("#adiagdiagnosa_desc" + bodyId).val(pasienDiagnosa.diagnosa_desc)

        $.each(pasienDiagnosasAll, function(key, value) {
            if (value.pasien_diagnosa_id == exam.body_id) {
                let data = {
                    bodyId: bodyId,
                    kddiag: value?.diagnosa_id,
                    nmdiag: value?.diagnosa_name,
                    diagcat: value?.diag_cat
                }
                addRowDiagDokter(data)
            }
        })
        $.each(proceduresAll, function(key, value) {
            if (value.pasien_diagnosa_id == exam.body_id) {
                let data = {
                    bodyId: bodyId,
                    kddiag: value?.diagnosa_id,
                    nmdiag: value?.diagnosa_name
                }
                addRowProcDokter(data)
            }
        })

        declareAddDiag(bodyId)
        declareAddProc(bodyId)

        $.each(diagPerawatAll, function(key, value) {
            if (value.document_id == exam.body_id) {
                addRowDiagPerawat('bodyDiagPerawat', bodyId, value.diagnosan_id, value.diag_notes, exam)
            }
        })

        $("#formDiagDokterCpptSaveBtn" + bodyId).on('click', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/DiagnosaC/addDiagnosaDokterCppt',
                type: "POST",
                data: new FormData(document.getElementById("formDiagDoktercppt" + bodyId)),
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
                        successSwal("Berhasil Simpan")

                        console.log(data)

                        const data = {
                            body_id: body_id,
                            visit_id: visit?.visit_id
                        }
                        postConditionSatuSehat(data)
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

</script>

<script>
    function getAssessmentDocument(diagCat) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/DiagnosaC/getAssessmentDocument',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit?.visit_id,
                'nomor': visit?.no_registration,
                'diagCat': diagCat
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                getLoadingscreen("contentDiagnosa", "loadContentDiagnosa")
            },
            success: function(data) {
                $("#accordionDiagnosa").html("")
                $("#accordionDiagnosacppt").html("")
                $("#accordionDiagnosaPerawat").html("")
                $("#accordionDiagnosaPerawatcppt").html("")
                pasienDiagnosaAll = data.pasienDiagnosa
                examForDiagnosaAll = data.examInfo

                pasienDiagnosasAll = data.pasienDiagnosas
                proceduresAll = data.pasienProcedures
                diagPerawatAll = data.pasienDiagnosasNurse
                lokalisAll = data.lokalis



                if (visit?.class_room_id == null || visit?.class_room_id == "") {
                    examForDiagnosaAll = examForDiagnosaAll?.filter(
                        (e) => [1, 2, 3].includes(e.account_id) || ["1", "2", "3"].includes(e.account_id)
                    );
                } else {
                    examForDiagnosaAll = examForDiagnosaAll?.filter(
                        (e) => [1, 2, 7].includes(e.account_id) || ["1", "2", "7"].includes(e.account_id)
                    );
                }

                $("#accordionDiagnosa").html("")
                $("#accordionDiagnosaDoktercppt").html("")
                $("#accordionDiagnosaPerawat").html("")
                $("#accordionDiagnosaPerawatcppt").html("")
                if (pasienDiagnosaAll.length > 0) {
                    $.each(pasienDiagnosaAll, function(key, value) {
                        appendDiagnosa("accordionDiagnosa", value?.pasien_diagnosa_id, value)
                    })
                }


                if (examForDiagnosaAll.length > 0) {
                    examForDiagnosaAll.map((e, i) => {
                        if ((e.petugas_type === 11 || e.petugas_type === "11") &&
                            (e.account_id === 3 || e.account_id === "3")) {
                            appendDiagnosaDokter("accordionDiagnosaDoktercppt", e?.body_id, e)
                        } else if (e.account_id === 2 || e.account_id === "2") {
                            appendDiagnosaPerawat("accordionDiagnosaPerawat", e.body_id, e)
                        } else {
                            appendDiagnosaPerawat("accordionDiagnosaPerawatcppt", e.body_id, e)
                        }
                    })

                }
            },
            error: function() {

            }
        });
    }
</script>

<script>
    const actionBtnModal = (props) => {
        const {
            data,
            id,
            diag_id,
            exam_date
        } = props;
        let visit = <?= json_encode($visit); ?>;

        $(document).off('click', `[id^=${data}]`).on('click', `[id^=${data}]`, function() {
            const row = $(this).closest('tr');

            // Find the <select> within that row
            const select = row.find('select[name="diagnosan_id[]"]');

            // Get the selected option
            const selectedOption = select.find('option:selected');


            let new_diag_id = diag_id == null ? selectedOption.val() : diag_id

            getDataAskepAll({
                id: id,
                diag_id: new_diag_id,
                visit_id: visit?.visit_id,
                exam_date: exam_date
            })
            const bodyId = $(this).attr('id').replace('formAskepModalBtn', '');
            const modalSelector = '#ModalAskep';

            $(modalSelector).modal('show');

            const form = $(modalSelector).find('form');
            if (form.length) {
                const bodyIdInput = form.find('input[name="body_id"]');
                bodyIdInput.val(id);
            }




        });

        $('#saveButtonAskep').off('click').on('click', () => {
            $('#accordionAskep .accordion-collapse').each(function() {
                const isVisible = $(this).hasClass('show');
                if (isVisible) {
                    const form = $(this).find('form');
                    if (form.length) {
                        let jsonObj = {};

                        form.find('input[type="hidden"]').each(function() {
                            const input = $(this);
                            jsonObj[input.attr('name')] = input.val();
                        });

                        form.find('input[type="datetime-local"]').each(function() {
                            const input = $(this);
                            jsonObj[input.attr('name')] = input.val();
                        });

                        form.find('input[type="checkbox"]:checked').each(function() {
                            const checkbox = $(this);
                            const checkboxValue = checkbox.val();
                            const select = form.find(`select[id="select-${checkboxValue}"]`);

                            jsonObj['diagnosan_id_' + checkboxValue] = checkbox.data(
                                'diagnosan_id');
                            jsonObj['detail_type_' + checkboxValue] = checkbox.data(
                                'detail_type');
                            jsonObj['detail_id_' + checkboxValue] = checkbox.val();

                            if (select.length) {
                                const displayStyle = select[0].style.display;
                                if (displayStyle === 'inline-block' || displayStyle === '') {
                                    jsonObj['value_score_' + checkboxValue] = select.val();
                                    jsonObj['p_type_' + checkboxValue] = select.data(
                                        'p_type');

                                    const selectedOption = select.find('option:selected');
                                    jsonObj['parameter_id_' + checkboxValue] = selectedOption
                                        .data('parameter_id');
                                    jsonObj['value_desc_' + checkboxValue] = selectedOption
                                        .data('value_desc');
                                    jsonObj['value_id_' + checkboxValue] = selectedOption
                                        .data('value_id');
                                }
                            }
                        });

                        let saveUrl = '';
                        const formId = form.attr('id');

                        switch (formId) {
                            case 'formDiagnosisAskep':
                                saveUrl = 'admin/Askep/saveSdki';
                                break;
                            case 'formLuaranAskep':
                                saveUrl = 'admin/Askep/saveSlki';
                                break;
                            case 'formIntervensiAskep':
                                saveUrl = 'admin/Askep/saveSiki';
                                break;
                            default:
                                console.error('Unknown form ID:', formId);
                                return;
                        }

                        if (Object.keys(jsonObj).length > 0) {
                            postData(jsonObj, saveUrl, (res) => {
                                if (res.respon === true) {
                                    successSwal('Data berhasil disimpan.');
                                    $("#ModalAskep").modal("hide");
                                } else {
                                    console.error('Save failed:', res.message);
                                }
                            });
                        }

                        return false;
                    }
                }
            });
        });


        const checkIfAnySectionIsVisible = () => {
            const anySectionVisible = $('#accordionAskep .accordion-collapse').filter('.show').length > 0;
            $('#saveButtonAskep').prop('disabled', !anySectionVisible);
        };

        $('#accordionAskep .accordion-collapse').on('show.bs.collapse hide.bs.collapse', checkIfAnySectionIsVisible);
        checkIfAnySectionIsVisible();
    };

    const getDataAskepAll = (props) => {
        postData({
                id: props?.id,
                diag_id: props?.diag_id,
                visit_id: props?.visit_id,
                date: props?.result_date,
                dateSiki: props?.dateSiki
            },
            'admin/Askep/getData',
            (res) => {
                $("#btnCetakAskep").off().on("click", function() {
                    const visit = <?= json_encode($visit); ?>;

                    visit.d_diag_id = props?.diag_id;
                    visit.d_id = props?.id;
                    visit.d_body_id = props?.exam_date

                    const visitString = JSON.stringify(visit);
                    const encodedVisit = btoa(visitString);
                    const url =
                        `<?= base_url() . '/admin/DiagnosaC/diagnosis_keperawatan/' ?>${encodedVisit}`;
                    openPopUpTab(url);
                });

                if (res.respon) {
                    renderAskepSdki({
                        data: res?.value?.sdki,
                        document_id: res?.document_id,
                        exam_date: props?.exam_date
                    });
                    renderAskepSlki({
                        data: res?.value?.slki,
                        document_id: res?.document_id,
                        diag_id: res?.value?.siki?.diag_id
                    })
                    renderAskepSiki({
                        data: res?.value?.siki,
                        document_id: res?.document_id,
                        diag_id: res?.value?.siki?.diag_id
                    })

                } else {
                    console.warn('Data response not successful.');
                    errorSwal(`data ${props?.diag_id} belum tersedia`)
                    $("#ModalAskep").modal("hide");
                }
            }
        );
    };

    const renderAskepSdki = (data) => {

        if (!data) {
            console.warn('No valid data to render.');
            return;
        }

        let visit = <?= json_encode($visit); ?>;

        const container = document.getElementById('diagnosisAskepRender');
        if (!container) {
            console.warn('Container not found.');
            return;
        }

        container.innerHTML = '';

        const sdkiData = data?.data;

        const firstDiagName = sdkiData.gejala && sdkiData.gejala.length > 0 ?
            sdkiData.gejala[0].diag_name :
            'Diagnosis';

        const categoryHeader = document.createElement('h5');
        categoryHeader.textContent = firstDiagName;
        container.appendChild(categoryHeader);

        for (const [childParent, items] of Object.entries(sdkiData)) {
            if (!items || !Array.isArray(items)) continue;

            const groupedByDiagName = items.reduce((acc, item) => {
                if (!acc[item.child_parent]) {
                    acc[item.child_parent] = {};
                }
                if (!acc[item.child_parent][item.type_name]) {
                    acc[item.child_parent][item.type_name] = [];
                }
                acc[item.child_parent][item.type_name].push(item);
                return acc;
            }, {});

            for (const [diagName, typeNames] of Object.entries(groupedByDiagName)) {
                const card = document.createElement('div');
                card.className = 'card mb-3';

                const cardHeader = document.createElement('div');
                cardHeader.className = 'card-header fw-bold';
                cardHeader.textContent = diagName;
                card.appendChild(cardHeader);


                const orgUnitCodeInput = document.createElement('input');
                orgUnitCodeInput.type = 'hidden';
                orgUnitCodeInput.name = 'org_unit_code';
                orgUnitCodeInput.value = visit.org_unit_code;

                const visitIdInput = document.createElement('input');
                visitIdInput.type = 'hidden';
                visitIdInput.name = 'visit_id';
                visitIdInput.value = visit.visit_id;

                const transIdInput = document.createElement('input');
                transIdInput.type = 'hidden';
                transIdInput.name = 'trans_id';
                transIdInput.value = visit.trans_id;

                const documentIdInput = document.createElement('input');
                documentIdInput.type = 'hidden';
                documentIdInput.name = 'document_id';
                documentIdInput.value = data?.document_id

                const exam_dateInput = document.createElement('input');
                exam_dateInput.type = 'hidden';
                exam_dateInput.name = 'examination_date';
                exam_dateInput.value = data?.exam_date

                card.appendChild(orgUnitCodeInput);
                card.appendChild(visitIdInput);
                card.appendChild(transIdInput);
                card.appendChild(documentIdInput);
                card.appendChild(exam_dateInput);

                for (const [typeName, items] of Object.entries(typeNames)) {
                    const row = document.createElement('div');
                    row.className = 'row p-3';

                    const etiologyHeader = document.createElement('div');
                    etiologyHeader.className = 'col-12 mb-2';
                    etiologyHeader.innerHTML = `<strong>${typeName}</strong>`;
                    row.appendChild(etiologyHeader);

                    const col1 = document.createElement('div');
                    col1.className = 'col-md-6';

                    const col2 = document.createElement('div');
                    col2.className = 'col-md-6';

                    const half = Math.ceil(items.length / 2);
                    const firstHalf = items.slice(0, half);
                    const secondHalf = items.slice(half);

                    const createCheckbox = (item, container) => {
                        const formCheck = document.createElement('div');
                        formCheck.className = 'form-check';

                        const checkbox = document.createElement('input');
                        checkbox.className = 'form-check-input';
                        checkbox.type = 'checkbox';
                        checkbox.value = item.diag_val_id;
                        checkbox.name = `detail_id_${item.diag_val_id}`;
                        checkbox.id = `diagnosis-${item.diag_val_id}`;
                        checkbox.dataset.diagnosan_id = item.diag_id;
                        checkbox.dataset.detail_type = item.type;
                        checkbox.checked = item?.checked === 1;

                        const label = document.createElement('label');
                        label.className = 'form-check-label';
                        label.htmlFor = checkbox.id;
                        label.textContent = item.diag_val_name;

                        formCheck.appendChild(checkbox);
                        formCheck.appendChild(label);
                        container.appendChild(formCheck);
                    };

                    firstHalf.forEach(item => createCheckbox(item, col1));
                    secondHalf.forEach(item => createCheckbox(item, col2));

                    row.appendChild(col1);
                    row.appendChild(col2);
                    card.appendChild(row);
                }

                container.appendChild(card);
            }
        }
    };

    const initializeDiagFlatpickr = () => {
        // flatpickr(".datetimeflatpickr", {
        //     enableTime: true,
        //     dateFormat: "d/m/Y H:i", // Display format
        //     time_24hr: true, // 24-hour time format
        // });

        $(".datetimeflatpickr").prop("readonly", false);

        $(".datetimeflatpickr").on("change", function() {
            let theid = $(this).attr("id");
            theid = theid.replace("flat", "");
            let thevalue = $(this).val();

            if (moment(thevalue, "DD/MM/YYYY HH:mm", true).isValid()) {
                let formattedDate = moment(thevalue, "DD/MM/YYYY HH:mm").format(
                    "YYYY-MM-DD HH:mm"
                );
                $("#" + theid).val(formattedDate);
            } else {
                // console.warn("Invalid date entered:", thevalue);
            }
        });

        // const nowtime = moment().format("DD/MM/YYYY HH:mm");
        // $(".datetimeflatpickr").val(nowtime).trigger("change");
    }

    const renderAskepSlki = (data) => {
        if (!data) {
            console.warn('No valid data to render.');
            return;
        }

        let visit = <?= json_encode($visit); ?>;

        const container = document.getElementById('luaranAskepRender');
        if (!container) {
            console.warn('Container not found.');
            return;
        }

        container.innerHTML = '';

        const firstDiagName = data?.data?.data[0]?.type_name || '';

        const categoryHeader = document.createElement('h5');
        categoryHeader.textContent = firstDiagName;
        container.appendChild(categoryHeader);

        const groupedByTypeName = data?.data?.data.reduce((acc, item) => {
            if (!acc[item.diag_name]) {
                acc[item.diag_name] = [];
            }
            acc[item.diag_name].push(item);
            return acc;
        }, {});

        for (const [typeName, items] of Object.entries(groupedByTypeName)) {
            const card = document.createElement('div');
            card.className = 'card mb-3';

            const cardHeader = document.createElement('div');
            cardHeader.className = 'card-header fw-bold';
            cardHeader.textContent = typeName;
            card.appendChild(cardHeader);

            const createHiddenInput = (name, value) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                return input;
            };
            const itemsDate = data?.data?.data.filter(item => item.result_date !== null);
            let dateResult = itemsDate[0]?.result_date ?? moment(new Date()).format("YYYY-MM-DD HH:mm")
            const originalResultDate = data?.data?.date ? new Date(data?.data?.date) : new Date();

            const datetimeInputHidden = document.createElement('input');
            datetimeInputHidden.type = 'hidden';
            datetimeInputHidden.className = 'form-control';
            datetimeInputHidden.name = `result_date`;
            datetimeInputHidden.id = `result_date`;
            datetimeInputHidden.value = moment(dateResult).format("YYYY-MM-DD HH:mm");
            datetimeInputHidden.style = 'width: 200px; '

            const datetimeInput = document.createElement('input');
            datetimeInput.type = 'Text';
            datetimeInput.className = 'form-control datetimeflatpickr';
            // datetimeInput.name = `result_date`;
            datetimeInput.id = `flatresult_date`;
            datetimeInput.value = moment(dateResult).format("DD/MM/YYYY HH:mm");
            datetimeInput.style = 'width: 200px; '


            datetimeInput.addEventListener('change', (event) => {
                const newDate = new Date(event.target.value);
                const formattedDate = event.target.value.replace('T', ' ');
                if (newDate <= originalResultDate) {
                    getDataAskepAll({
                        diag_id: data?.diag_id,
                        id: data?.document_id,
                        visit_id: visit.visit_id,
                        result_date: formattedDate
                    });
                }
            });

            card.appendChild(createHiddenInput('org_unit_code', visit.org_unit_code));
            card.appendChild(createHiddenInput('visit_id', visit.visit_id));
            card.appendChild(createHiddenInput('trans_id', visit.trans_id));
            card.appendChild(createHiddenInput('document_id', data?.document_id));
            card.appendChild(datetimeInputHidden);
            card.appendChild(datetimeInput);

            const row = document.createElement('div');
            row.className = 'row mt-3';

            const col1 = document.createElement('div');
            col1.className = 'col-md-6';

            const col2 = document.createElement('div');
            col2.className = 'col-md-6';

            const half = Math.ceil(items.length / 2);
            const firstHalf = items.slice(0, half);
            const secondHalf = items.slice(half);

            const createCheckbox = (item, container) => {
                const formCheck = document.createElement('div');
                formCheck.className = 'form-check mb-2  align-items-center';

                const checkbox = document.createElement('input');
                checkbox.className = 'form-check-input';
                checkbox.type = 'checkbox';
                checkbox.value = item.diag_val_id;
                checkbox.name = `detail_id_${item.diag_val_id}`;
                checkbox.id = `diagnosis-${item.diag_val_id}`;
                checkbox.dataset.diagnosan_id = item.diag_id;
                checkbox.dataset.detail_type = item.type;
                checkbox.checked = item.checked === 1;

                const label = document.createElement('label');
                label.className = 'form-check-label';
                label.htmlFor = checkbox.id;
                label.textContent = item.diag_val_name;

                const select = document.createElement('select');
                select.className = 'form-select mt-2 ms-2 form-select-sm';
                select.style = 'width: 150px;padding: 0.2rem;';
                select.name = `value_score_${item.diag_val_id}`;
                select.id = `select-${item.diag_val_id}`;
                select.style.display = item.checked === 1 ? 'inline-block' : 'none';
                select.dataset.p_type = item.p_type;

                item.selected.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.value_score;
                    optionElement.dataset.parameter_id = option.parameter_id;
                    optionElement.dataset.value_desc = option.value_desc;
                    optionElement.dataset.value_id = option.value_id;
                    optionElement.textContent = `${option.value_desc} (${option.value_score})`;

                    if (option.selected === 1) {
                        optionElement.selected = true;
                    }

                    select.appendChild(optionElement);
                });

                checkbox.addEventListener('change', () => {
                    select.style.display = checkbox.checked ? 'inline-block' : 'none';
                });

                formCheck.appendChild(checkbox);
                formCheck.appendChild(label);
                formCheck.appendChild(select);
                container.appendChild(formCheck);
            };

            firstHalf.forEach(item => createCheckbox(item, col1));
            secondHalf.forEach(item => createCheckbox(item, col2));

            row.appendChild(col1);
            row.appendChild(col2);
            card.appendChild(row);

            container.appendChild(card);
        }
        initializeDiagFlatpickr()
    };

    const renderAskepSiki = (data) => {

        if (!data) {
            console.warn('No valid data to render.');
            return;
        }

        let visit = <?= json_encode($visit); ?>;

        const container = document.getElementById('intervensiAskepRender');
        if (!container) {
            console.warn('Container not found.');
            return;
        }

        container.innerHTML = '';

        const firstDiagName = data?.data?.data[0]?.type_name || '';

        const categoryHeader = document.createElement('h5');
        categoryHeader.textContent = firstDiagName;
        container.appendChild(categoryHeader);

        const itemsDate = data?.data?.data.filter(item => item.result_date !== null);
        let dateResult = itemsDate[0]?.result_date ?? moment(new Date()).format("YYYY-MM-DD HH:mm");
        const originalResultDate = data?.data?.date ? new Date(data?.data?.date) : new Date();

        const datetimeInputHidden = document.createElement('input');
        datetimeInputHidden.type = 'hidden';
        datetimeInputHidden.className = 'form-control';
        datetimeInputHidden.name = `result_date`;
        datetimeInputHidden.id = `result_date`;
        datetimeInputHidden.value = moment(dateResult).format("YYYY-MM-DD HH:mm");
        datetimeInputHidden.style = 'width: 200px; '

        const datetimeInput = document.createElement('input');
        datetimeInput.type = 'Text';
        datetimeInput.className = 'form-control datetimeflatpickr';
        // datetimeInput.name = `result_date`;
        datetimeInput.id = `flatresult_date`;
        datetimeInput.value = moment(dateResult).format("DD/MM/YYYY HH:mm");
        datetimeInput.style = 'width: 200px; '

        datetimeInput.addEventListener('change', (event) => {
            const newDate = new Date(event.target.value);
            const formattedDate = event.target.value.replace('T', ' ');
            if (newDate <= originalResultDate) {
                getDataAskepAll({
                    diag_id: data?.diag_id,
                    id: data?.document_id,
                    visit_id: visit.visit_id,
                    dateSiki: formattedDate
                });
            }
        });

        container.appendChild(datetimeInputHidden);
        container.appendChild(datetimeInput);

        const groupedByDiagAndType = data?.data?.data.reduce((acc, item) => {
            if (!acc[item.diag_name]) {
                acc[item.diag_name] = {};
            }
            if (!acc[item.diag_name][item.type_name]) {
                acc[item.diag_name][item.type_name] = [];
            }
            acc[item.diag_name][item.type_name].push(item);
            return acc;
        }, {});

        for (const [diagName, typeGroups] of Object.entries(groupedByDiagAndType)) {
            const card = document.createElement('div');
            card.className = 'card mb-3';

            const cardHeader = document.createElement('div');
            cardHeader.className = 'card-header fw-bold';
            cardHeader.textContent = diagName;
            card.appendChild(cardHeader);

            const createHiddenInput = (name, value) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                return input;
            };

            card.appendChild(createHiddenInput('org_unit_code', visit.org_unit_code));
            card.appendChild(createHiddenInput('visit_id', visit.visit_id));
            card.appendChild(createHiddenInput('trans_id', visit.trans_id));
            card.appendChild(createHiddenInput('document_id', data?.document_id));

            for (const [typeName, items] of Object.entries(typeGroups)) {
                const row = document.createElement('div');
                row.className = 'row p-3';

                const etiologyHeader = document.createElement('div');
                etiologyHeader.className = 'col-12 mb-2';
                etiologyHeader.innerHTML = `<strong>${typeName}</strong>`;
                row.appendChild(etiologyHeader);

                const col1 = document.createElement('div');
                col1.className = 'col-md-6';

                const col2 = document.createElement('div');
                col2.className = 'col-md-6';

                const half = Math.ceil(items.length / 2);
                const firstHalf = items.slice(0, half);
                const secondHalf = items.slice(half);

                const createCheckbox = (item, container) => {
                    const formCheck = document.createElement('div');
                    formCheck.className = 'form-check mb-2  align-items-center';

                    const checkbox = document.createElement('input');
                    checkbox.className = 'form-check-input';
                    checkbox.type = 'checkbox';
                    checkbox.value = item.diag_val_id;
                    checkbox.name = `detail_id_${item.diag_val_id}`;
                    checkbox.id = `diagnosis-${item.diag_val_id}`;
                    checkbox.dataset.diagnosan_id = data?.data.diag_id;
                    checkbox.dataset.detail_type = item.diag_id;
                    checkbox.checked = item.checked === 1;

                    const label = document.createElement('label');
                    label.className = 'form-check-label';
                    label.htmlFor = checkbox.id;
                    label.textContent = item.diag_val_name;

                    formCheck.appendChild(checkbox);
                    formCheck.appendChild(label);
                    container.appendChild(formCheck);
                };

                firstHalf.forEach(item => createCheckbox(item, col1));
                secondHalf.forEach(item => createCheckbox(item, col2));

                row.appendChild(col1);
                row.appendChild(col2);
                card.appendChild(row);
            }

            container.appendChild(card);
        }
        initializeDiagFlatpickr()

    };

    const postConditionSatuSehat = (data) => {
        if (!data) {
            console.warn('tidak ada data')
        } else {
            const id = data?.id
            postData(data, 'SatuSehat/postConditionByPasienDiagnosa', (res) => {
                console.log('Berhasil posting condition satu sehat')
                console.log(res)
            })
        }
    }




    // Usage example
</script>
<!-- new 12/08 -->