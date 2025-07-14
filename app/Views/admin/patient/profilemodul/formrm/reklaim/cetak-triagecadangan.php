<?php $ats = json_decode($ats, true);
if (is_array($ats) && !empty($ats['triage'])):
?>
    <?php
    foreach (array_values($ats['triage']) as $index => $group) {
        if (!isset($group['detail']) || count($group['detail']) <= 3) {
            continue;
        }
    ?>

        <div class="page-break portrait">
            <!doctype html>
            <html lang="en">

            <body>
                <div class="container-fluid mt-5">
                    <?php if ($visit['clinic_id'] == 'P012' && $visit['isrj'] == '1') {
                        echo view("admin/patient/profilemodul/formrm/reklaim/template_header.php", ['key' => ['title' => 'Triase']]);
                    } ?>
                    <div id="bodyTriagePerawat_<?= $index ?>"></div>
                </div>
                <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
            </body>
            <script type="text/javascript">
                $(document).ready(function() {
                    dataTriageIndex<?= $index ?>();
                })
                const dataTriageIndex<?= $index ?> = () => {
                    let avalue = <?= json_encode($ats['aValue']) ?>;
                    let aparameter = <?= json_encode($ats['aParameter']) ?>;
                    let aparent = <?= json_encode($ats['aParent']) ?>;
                    let atype = <?= json_encode($ats['aType']) ?>;
                    let triage = <?= json_encode($group); ?>;
                    let triageDetil = triage?.detail

                    if (triage?.p_type === "ASES051") {
                        addTriageNew(0, 0, triage?.document_id, "bodyTriagePerawat_<?= $index ?>");
                    } else {
                        addTriage(0, 0, triage?.document_id, "bodyTriagePerawat_<?= $index ?>");
                    }

                    function addTriage(flag, index, document_id, container) {
                        $("#" + container).html("")
                        <?php foreach ($ats['aParent'] as $key => $value) { ?>
                            <?php if ($value['parent_id'] == '004') { ?>
                                var bodyId = '';
                                var documentId = $("#" + document_id).val()
                                if (flag == 1) {
                                    const date = new Date();
                                    bodyId = date.toISOString().substring(0, 23);
                                    bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
                                } else {
                                    bodyId = triage.body_id
                                }
                                $("#" + container).append(
                                    '<form id="formTriage' + bodyId +
                                    '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4 satelite">' +
                                    '<div class="card border border-1 rounded-4 p-4">' +
                                    '<div class="card-body">' +
                                    '<h4 class="card-title"> Triage' +
                                    '</h4>' +
                                    '<div class="row mt-4">' +
                                    '<table class="table table-borderless w-100">' +
                                    '<tbody>' +
                                    '<tr>' +
                                    '<td style="width: 25%;">' +
                                    '<h5 class="font-size-14 badge bg-primary">Jenis Triage:</h5>' +
                                    '</td>' +
                                    '<td>' +
                                    '<select class="form-control" name="p_type" id="aParamTriage' + bodyId +
                                    '" onchange="aValueParamTriage(\'<?= @$value['parent_id']; ?>\', this.value, \'' + bodyId +
                                    '\', 1)">' +
                                    <?php foreach ($ats['aType'] as $key1 => $value1) {
                                        if ($value1['parent_id'] == @$value['parent_id']) { ?> '<option value="<?= $value1['p_type']; ?>"><?= $value1['p_description']; ?></option>' +
                                    <?php }
                                    } ?> '</select>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td style="width: 25%; vertical-align: top;">' +
                                    '<h5 class="font-size-14 badge bg-primary">Step 1:</h5>' +
                                    '</td>' +
                                    '<td>' +
                                    '<h5 class="font-size-14 mb-3">Perlu tindakan <i>Live Saving/Resusitasi</i> segera?</h5>' +
                                    '<table><tr>' +
                                    <?php foreach ($ats['aValue'] as $value1) {
                                        if ($value1['p_type'] == 'GEN0008' && $value1['parameter_id'] == '01') { ?> '<td>' +
                                            '<div class="form-check">' +
                                            '<input class="form-check-input" type="radio" name="gen000801" id="step1<?= $value1['parameter_id'] . $value1['value_id']; ?>' +
                                            bodyId + '" value="<?= $value1['value_id']; ?>">' +
                                            '<label class="form-check-label ms-1" for="step1<?= $value1['parameter_id'] . $value1['value_id']; ?>' +
                                            bodyId + '"><?= $value1['value_desc']; ?></label>' +
                                            '</div>' +
                                            '</td>' +
                                    <?php }
                                    } ?> '</tr></table>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>' +
                                    '<h5 class="font-size-14 badge bg-primary">Step 2:</h5>' +
                                    '</td>' +
                                    '<td>' +
                                    '<h5 class="font-size-14 mb-3">Resiko Tinggi, Kebingungan/Letargis/Disorientasi, Nyeri/Distress Berat?</h5>' +
                                    '<table><tr>' +
                                    <?php foreach ($ats['aValue'] as $value1) {
                                        if ($value1['p_type'] == 'GEN0008' && $value1['parameter_id'] == '02') { ?> '<td>' +
                                            '<div class="form-check">' +
                                            '<input class="form-check-input" type="radio" name="gen000802" id="step2<?= $value1['parameter_id'] . $value1['value_id']; ?>' +
                                            bodyId + '" value="<?= $value1['value_id']; ?>">' +
                                            '<label class="form-check-label ms-1" for="step2<?= $value1['parameter_id'] . $value1['value_id']; ?>' +
                                            bodyId + '"><?= $value1['value_desc']; ?></label>' +
                                            '</div>' +
                                            '</td>' +
                                    <?php }
                                    } ?> '</tr></table>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>' +
                                    '<h5 class="font-size-14 badge bg-primary">Step 3:</h5>' +
                                    '</td>' +
                                    '<td>' +
                                    '<h5 class="font-size-14 mb-3">Berapa jenis sumber daya IGD yang dibutuhkan?</h5>' +
                                    '<table><tr>' +
                                    <?php foreach ($ats['aValue'] as $value1) {
                                        if ($value1['p_type'] == 'GEN0008' && $value1['parameter_id'] == '03') { ?> '<td>' +
                                            '<div class="form-check">' +
                                            '<input class="form-check-input" type="radio" name="gen000803" id="step3<?= $value1['parameter_id'] . $value1['value_id']; ?>' +
                                            bodyId + '" value="<?= $value1['value_id']; ?>">' +
                                            '<label class="form-check-label ms-1" for="step3<?= $value1['parameter_id'] . $value1['value_id']; ?>' +
                                            bodyId + '"><?= $value1['value_desc']; ?></label>' +
                                            '</div>' +
                                            '</td>' +
                                    <?php }
                                    } ?> '</tr></table>' +
                                    '</td>' +
                                    '</tr>' +
                                    '</tbody>' +
                                    '</table>' +
                                    '<div class="row">' +
                                    '<div class="col-md-12">' +
                                    '<h5 class="font-size-14 mb-4 badge bg-primary">Indikator:</h5>' +
                                    '</div>' +
                                    '<table class="col-md-12 table table-striped">' +
                                    '<tbody id="bodyAssessment004' + bodyId + '">' +
                                    '</tbody>' +
                                    '</table>' +
                                    '</div>' +
                                    `<div class="row">
                        <div class="col-md-3"><h5 class="font-size-14 mb-4 badge bg-primary">Score Triase:</h5>
                        </div>
                            <div class="col-md-9"><div class="form-check mb-3">
                                <select class="form-control" name="total_score" id="aTriageTotalScore` + bodyId + `">
                                    <option value="1">ATS 1</option>
                                    <option value="2">ATS 2</option>
                                    <option value="3">ATS 3</option>
                                    <option value="4">ATS 4</option>
                                    <option value="5">ATS 5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    ` +
                                    '</div>' +
                                    '</div>' +
                                    '</form>'
                                )

                                $("#formTriage" + bodyId).append('<input name="org_unit_code" id="triageorg_unit_code' + bodyId +
                                        '" type="hidden" value="<?= @$visit['org_unit_code']; ?>"  />')
                                    .append('<input name="visit_id" id="triagevisit_id' + bodyId +
                                        '" type="hidden" value="<?= @$visit['visit_id']; ?>"  />')
                                    .append('<input name="trans_id" id="triagetrans_id' + bodyId +
                                        '" type="hidden" value="<?= @$visit['trans_id']; ?>"  />')
                                    .append('<input name="body_id" id="triagebody_id' + bodyId + '" type="hidden" value="' + bodyId +
                                        '"  />')
                                    .append('<input name="document_id" id="triagedocument_id' + bodyId + '" type="hidden" value="' +
                                        documentId + '"  />')
                                    .append('<input name="no_registration" id="triageno_registration' + bodyId +
                                        '" type="hidden" value="<?= @$visit['no_registration']; ?>"  />')
                                    .append('<input name="clinic_id" id="triageclinic_id' + bodyId +
                                        '" type="hidden" value="<?= @$visit['clinic_id']; ?>"  />')
                                    .append('<input name="employee_id" id="triageemployee_id' + bodyId +
                                        '" type="hidden" value="<?= @$visit['employee_id']; ?>"  />')
                                    .append('<input name="petugas_id" id="triagepetugas_id' + bodyId + '" type="hidden" value=""  />')
                                    .append('<input name="class_room_id" id="triageclass_room_id' + bodyId +
                                        '" type="hidden" value="<?= @$visit['class_room_id']; ?>"  />')
                                    .append('<input name="bed_id" id="triagebed_id' + bodyId +
                                        '" type="hidden" value="<?= @$visit['bed_id']; ?>"  />')
                                    .append('<input name="description" id="triagedescription' + bodyId +
                                        '" type="hidden" value="<?= @$visit['description']; ?>"  />')
                                    .append('<input name="modified_date" id="triagemodified_date' + bodyId +
                                        '" type="hidden" value="<?= @$visit['modified_date']; ?>"  />')
                                    .append('<input name="modified_by" id="triagemodified_by' + bodyId +
                                        '" type="hidden" value="<?= user()->username; ?>"  />')
                                    .append('<input name="valid_date" class="valid_date" id="triagevalid_date' + bodyId +
                                        '" type="hidden"  />')
                                    .append('<input name="valid_user" class="valid_user" id="triagevalid_user' + bodyId +
                                        '" type="hidden"  />')
                                    .append('<input name="valid_pasien" class="valid_pasien" id="triagevalid_pasien' + bodyId +
                                        '" type="hidden"  />')
                                // .append('<input name="p_type" id="triagep_type' + bodyId + '" type="hidden" value=""  />')
                                // $("#formTriage" + bodyId).on('submit', (function(e) {
                                //     $("#triagedocument_id" + bodyId).val($("#" + document_id).val())
                                //     let clicked_submit_btn = $(this).closest('form').find(':submit');
                                //     e.preventDefault();
                                //     $.ajax({
                                //         url: '<?php echo base_url(); ?>admin/rm/assessment/saveTriage',
                                //         type: "POST",
                                //         data: new FormData(this),
                                //         dataType: 'json',
                                //         contentType: false,
                                //         cache: false,
                                //         processData: false,
                                //         beforeSend: function() {
                                //             clicked_submit_btn.button('loading');
                                //         },
                                //         success: function(data) {
                                //             // $('#formTriage' + bodyId).find("input, select, textarea").prop("disabled",
                                //             //     true)
                                //             $('#formTriage' + bodyId + ' input[type="datetime-local"]').prop(
                                //                 "readonly",
                                //                 true)
                                //             $("#formTriageSaveBtn" + bodyId).slideUp()
                                //             // checkSign("formTriage" + bodyId)
                                //         },
                                //         error: function(xhr) { // if error occured
                                //             alert("Error occured.please try again");
                                //             clicked_submit_btn.button('reset');
                                //             errorSwal(xhr);
                                //         },
                                //         complete: function() {
                                //             clicked_submit_btn.button('reset');
                                //         }
                                //     });
                                // }));


                                if (flag == 1) {
                                    // $("#formTriageSaveBtn" + bodyId).slideDown()
                                    // $("#formTriageEditBtn" + bodyId).slideUp()
                                    // $("#formTriage" + bodyId).find("input, textarea, select, option").prop("disabled", false)
                                    // $("#aParamTriage" + bodyId).val('ASES028').trigger("change")
                                } else {
                                    var triageset = triage

                                    $.each(triageset, function(key, value) {
                                        $("#triage" + key + bodyId).val(value)
                                    })
                                    $.each(triageDetil, function(key, value) {
                                        $("#formTriageSaveBtn" + bodyId).slideUp()
                                        $("#formTriageEditBtn" + bodyId).slideDown()

                                        if (value.p_type == 'GEN0008' && value.body_id == bodyId) {
                                            $('#aParamTriage' + bodyId).val(triage.p_type)
                                            $('#aTriageTotalScore' + bodyId).val(triage.total_score)
                                            $('#step1' + value.parameter_id + value.value_id + bodyId).prop("checked", true)
                                            $('#step2' + value.parameter_id + value.value_id + bodyId).prop("checked", true)
                                            $('#step3' + value.parameter_id + value.value_id + bodyId).prop("checked", true)
                                            // $('#formTriage' + bodyId + ' option').prop("disabled", true)
                                            aValueParamTriage('<?= @$value['parent_id']; ?>', triage.p_type, bodyId,
                                                flag)
                                        }

                                        // $("#formTriage" + bodyId).find("input, textarea, select, option").prop("disabled", true)
                                        $("#formTriage" + bodyId).find("input, textarea, select, option").each(function() {
                                            const tag = $(this).prop("tagName").toLowerCase();
                                            if (tag === "input" || tag === "textarea") {
                                                $(this).attr("readonly", true).attr("onclick", "return false;");
                                            } else if (tag === "select" || tag === "option") {
                                                $(this).attr("onmousedown", "return false;").css("pointer-events",
                                                    "none");
                                            }
                                        });

                                    })
                                    // checkSign("formTriage" + bodyId)
                                }
                            <?php } ?>
                        <?php } ?>
                        index++

                    }

                    function aValueParamTriage(parent_id, p_type, body_id, flag) {

                        $("#triagep_type" + body_id).val(p_type)
                        $("#bodyAssessment" + parent_id + body_id).html("")
                        var counter = 0;
                        $("#bodyAssessment" + parent_id + body_id).append(
                            '<thead >' +
                            '<tr id="theadAssessment' + parent_id + body_id + '">' +
                            '</tr>' +
                            ' </thead>' +
                            '<tbody id="tbodyAssessment' + parent_id + body_id + '">' +
                            '</tbody>'
                        )
                        $("#theadAssessment" + parent_id + body_id).append(
                            '<th>PEMERIKSAAN</th>'
                        )
                        $.each(aparameter, function(key, value) {

                            if (value.p_type == p_type) {
                                $("#theadAssessment" + parent_id + body_id).append(
                                    '<th id="theadAssessment' + parent_id + body_id + value.parameter_id + '">' +
                                    value
                                    .parameter_desc + '</th>'
                                )
                                if (value.parameter_id == '01') {
                                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("color",
                                        "white")
                                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css(
                                        "background-color",
                                        "red")
                                } else if (value.parameter_id == '02' || value.parameter_id == '03') {
                                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css(
                                        "background-color",
                                        "yellow")
                                } else if (value.parameter_id == '04' || value.parameter_id == '05') {
                                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("color",
                                        "white")
                                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css(
                                        "background-color",
                                        "green")
                                }
                            }
                        });
                        $.each(avalue, function(key, value) {
                            if (value.p_type == 'GEN0007') {
                                $("#tbodyAssessment" + parent_id + body_id).append(
                                    '<tr id="tbodyAssessment' + parent_id + body_id + value.value_id + '"><td>' +
                                    value
                                    .value_desc + '</td></tr>'
                                )
                                let param = aparameter.filter(item => item?.p_type == p_type)
                                $.each(param, function(key1, value1) {
                                    $("#tbodyAssessment" + parent_id + body_id + value.value_id).append(
                                        '<td id="tbodyAssessment' + parent_id + body_id + value.value_id +
                                        value1
                                        .parameter_id + '"></td>'
                                    )
                                    let val = avalue.filter(item => item?.p_type == p_type)
                                    $.each(val, function(key2, value2) {
                                        if (value2.value_info == value.value_id && value2
                                            .parameter_id == value1
                                            .parameter_id) {
                                            $("#tbodyAssessment" + parent_id + body_id + value
                                                .value_id + value1
                                                .parameter_id).append(
                                                '<div class="form-check mb-3">' +
                                                '<input name="val' + value2.value_id +
                                                '" class="form-check-input" type="checkbox" id="' +
                                                parent_id + body_id + value.value_id + value1
                                                .parameter_id +
                                                value2.value_id + '" onclick="updateATS(' + value2
                                                .value_score + ',\'' + body_id + '\')">' +
                                                '<label class="form-check-label" for="' +
                                                parent_id +
                                                body_id + value.value_id + value1.parameter_id +
                                                value2
                                                .value_id + '">' + value2.value_desc + '</label>' +
                                                '</div>'
                                            )
                                            $.each(triageDetil, function(key3, value3) {
                                                if (value3.value_id == value2.value_id) {
                                                    $("#" + parent_id + body_id + value
                                                        .value_id +
                                                        value2.parameter_id + value3
                                                        .value_id).prop(
                                                        "checked", true)
                                                    return false
                                                }
                                            })
                                        }

                                    });
                                });
                            }
                        })
                    }

                    function updateATS(score, bodyId) {
                        $("#aTriageTotalScore" + bodyId).val(score)
                    }

                    function addTriageNew(flag, index, document_id, container, isaddbutton = true) {

                        $(`#${container}`).html("")
                        const parent = aparent.find(p => p.parent_id === '010');
                        if (!parent) return;

                        let bodyId = '';
                        const documentId = $("#" + document_id).val();

                        if (flag === 1) {
                            const date = new Date();
                            bodyId = date.toISOString().substring(0, 23).replace(/[-:.T]/g, '');
                        } else {
                            bodyId = triage.body_id
                        }

                        const typeOptions = atype
                            .filter(t => t.parent_id === parent.parent_id)
                            .map(t => `<option value="${t.p_type}">${t.p_description}</option>`)
                            .join('');

                        const typeOptionsChange = atype
                            .find(t => t.parent_id === parent.parent_id)


                        const paramOptions = aparameter
                            .filter(t => t.p_type === typeOptionsChange.p_type && t.parameter_id <= 5)
                            .map(t => `<option value="${t.parameter_id}">${t.parameter_desc}</option>`)
                            .join('');


                        function buildStep(stepNum, parameterId, label) {
                            const radios = avalue
                                .filter(v => v.p_type === 'GEN0008' && v.parameter_id === parameterId)
                                .map(v => `
                                        <div class="col-md-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="gen0008${parameterId}" 
                                            id="step${stepNum}${parameterId}${v.value_id}${bodyId}"
                                            value="${v.value_id}" ${v.value_id === avalue.find(x => x.p_type === parent.p_type && x.parameter_id === parameterId)?.value_id ? 'checked' : ''}>
                                            <label class="form-check-label" for="step${stepNum}${parameterId}${v.value_id}${bodyId}">
                                            ${v.value_desc}
                                            </label>
                                        </div>
                                        </div>
                                    `).join('');

                            return `
                        <div class="col-md-3">
                            <h5 class="font-size-14 mb-4 badge bg-primary">Step ${stepNum}:</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="font-size-14 mb-4">${label}</h5>
                            <div class="row">${radios}</div>
                        </div>`;
                        }

                        const html = `
                        <form id="formTriage${bodyId}" accept-charset="utf-8"
                        enctype="multipart/form-data" method="post" class="mt-4">
                        <div class="card border border-1 rounded-4 p-4">
                            <div class="card-body">
                            <h4 class="card-title">Triage</h4>
                            <div class="row mt-4">
                                <div class="col-md-3">
                                <h5 class="font-size-14 mb-4 badge bg-primary">Jenis Triage:</h5>
                                </div>
                                <div class="col-md-9">
                                <div class="form-check mb-3">
                                    <select class="form-control" name="p_type" id="aParamTriage${bodyId}"
                                    onchange="aValueParamTriageNew('${parent.parent_id}', this.value, '${bodyId}', 1)">
                                    ${typeOptions}
                                    </select>
                                </div>
                                </div>
                                ${buildStep(1, '01', 'Perlu tindakan Live Saving/Resusitasi segera?')}
                                ${buildStep(2, '02', 'Resiko Tinggi, Kebingungan/Letargis/Disorientasi, Nyeri/Distress Berat?')}
                                ${buildStep(3, '03', 'Berapa jenis sumber daya IGD yang dibutuhkan?')}
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                <h5 class="font-size-14 mb-4 badge bg-primary">Indikator:</h5>
                                </div>
                                <div class="col-md-12 " id="bodyAssessment010${bodyId}">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-3">
                                <h5 class="font-size-14 mb-4 badge bg-primary">Score Triase:</h5>
                                </div>
                                <div class="col-md-9">
                                <div class="form-check mb-3">
                                    <select class="form-control" name="total_score" id="aTriageTotalScore${bodyId}">
                                        ${paramOptions}
                                    </select>
                                </div>
                                </div>
                            </div>

                          <!--  <div class="panel-footer text-end mb-4">
                                <button type="submit" id="formTriageSaveBtn${bodyId}"
                                class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> Simpan</button>
                                <button type="button" id="formTriageEditBtn${bodyId}"
                                class="btn btn-secondary btn-edit" style="margin-right:10px;"><i class="fa fa-edit"></i> Edit</button>
                            </div> -->
                            </div>

                        <!-- Hidden inputs -->
                       
                        <input name="valid_date" class="valid-date" type="hidden" value="">
                        <input name="valid_user" class="valid-user" type="hidden" value="">
                        <input name="valid_pasien" class="valid-pasien" type="hidden" value="">
                        </form>`;

                        $("#" + container).append(html);


                        const $form = $("#formTriage" + bodyId);
                        $form.find("#formTriageEditBtn" + bodyId).on("click", () => {
                            // $form.find("input, textarea, select").prop("disabled", false);
                            $form.find("#formTriageSaveBtn" + bodyId).show();
                            $form.find("#formTriageEditBtn" + bodyId).hide();
                        });

                        $form.on("submit", function(e) {
                            e.preventDefault();
                            const $btn = $(this).find(":submit");
                            $("#triagedocument_id" + bodyId).val($("#" + document_id).val());

                            $.ajax({
                                url: '/admin/rm/assessment/saveTriage',
                                type: "POST",
                                data: new FormData(this),
                                dataType: "json",
                                contentType: false,
                                processData: false,
                                beforeSend() {
                                    $btn.prop('disabled', true);
                                },
                                success(data) {
                                    $form.find("input, textarea, select").prop("disabled", true);
                                    $form.find("input[type='datetime-local']").prop("readonly", true);
                                    $form.find("#formTriageSaveBtn" + bodyId).hide();
                                    // checkSign("formTriage" + bodyId);
                                },
                                error(xhr) {
                                    alert("Error occurred. Please try again.");
                                    console.error(xhr);
                                },
                                complete() {
                                    $btn.prop('disabled', false);
                                }
                            });
                        });

                        if (flag === 1) {
                            // $form.find("input, textarea, select").prop("disabled", false);
                            // $form.find("#formTriageSaveBtn" + bodyId).show();
                            // $form.find("#formTriageEditBtn" + bodyId).hide();
                            // aValueParamTriageNew(parent.parent_id, typeOptionsChange.p_type, bodyId, 1)

                        } else {
                            const tri = triage;
                            if (tri) {
                                Object.keys(tri).forEach(key => {
                                    $form.find(`[name="${key}"]`).val(tri[key]);
                                });
                            }

                            triageDetil.forEach(d => {
                                if (d.body_id === bodyId && d.p_type === parent.p_type || typeOptionsChange
                                    ?.p_type) {
                                    $form.find("#aParamTriage" + bodyId).val(tri.p_type);
                                    $form.find("#aTriageTotalScore" + bodyId).val(tri.total_score);

                                    $form.find(`#step1${d.parameter_id}${d.value_id}${bodyId}`).prop("checked", true);
                                    $form.find(`#step2${d.parameter_id}${d.value_id}${bodyId}`).prop("checked", true);
                                    $form.find(`#step3${d.parameter_id}${d.value_id}${bodyId}`).prop("checked", true);
                                    aValueParamTriageNew(parent.parent_id, tri.p_type, bodyId, flag);
                                }
                            });
                            // $form.find("input, textarea, select").prop("disabled", true);
                            $form.find("#formTriageSaveBtn" + bodyId).hide();
                            $form.find("#formTriageEditBtn" + bodyId).show();
                            // checkSign("formTriage" + bodyId);
                            $("#formTriage" + bodyId).find("input, textarea, select, option").each(function() {
                                const tag = $(this).prop("tagName").toLowerCase();
                                if (tag === "input" || tag === "textarea") {
                                    $(this).attr("readonly", true).attr("onclick", "return false;");
                                } else if (tag === "select" || tag === "option") {
                                    $(this).attr("onmousedown", "return false;").css("pointer-events", "none");
                                }
                            });
                        }

                        index++;
                        if (isaddbutton && !$(`#formTriage${bodyId} .valid-user`).val()) {
                            $("#addTriageButton").html(`
                        <a onclick="addTriageNew(1, ${index}, '${document_id}', '${container}')" 
                            class="btn btn-primary btn-lg btn-add-doc" id="addDocumentBtn${bodyId}" style="width:300px">
                            <i class="fa fa-plus"></i> Tambah Dokumen
                        </a>`);
                        } else {
                            $("#" + container + "AddBtn").empty();
                        }
                    }

                    function aValueParamTriageNew(parent_id, p_type, body_id, flag) {

                        const containerId = `#bodyAssessment${parent_id}${body_id}`;
                        $(containerId).html("");

                        const params = aparameter.filter(p => p.p_type === p_type);
                        for (let i = 0; i < params.length; i += 2) {
                            const paramLeft = params[i];
                            const paramRight = params[i + 1] ?? null;

                            const valuesLeft = avalue.filter(v => v.p_type === p_type && v.parameter_id === paramLeft
                                .parameter_id);
                            const valuesRight = paramRight ? avalue.filter(v => v.p_type === p_type && v.parameter_id ===
                                paramRight
                                .parameter_id) : [];

                            const maxLength = Math.max(valuesLeft.length, valuesRight.length);

                            let rowHtml = `<div class="row mb-3">`;

                            rowHtml += `
                <div class="col-sm-${paramRight ? '6' : '12'}">
                    <div class="card h-100">
                        <div class="card-header text-center fw-bold bg-light">${paramLeft.parameter_desc}</div>
                        <div class="card-body" id="left_${paramLeft.parameter_id}_${body_id}"></div>
                    </div>
                </div>
                 `;

                            if (paramRight) {
                                rowHtml += `
                    <div class="col-sm-6">
                        <div class="card h-100">
                            <div class="card-header text-center fw-bold bg-light">${paramRight.parameter_desc}</div>
                            <div class="card-body" id="right_${paramRight.parameter_id}_${body_id}"></div>
                        </div>
                    </div>
                `;
                            }

                            rowHtml += `</div>`;
                            $(containerId).append(rowHtml);
                            $(`#left_${paramLeft.parameter_id}_${body_id}`).empty();
                            if (paramRight) $(`#right_${paramRight.parameter_id}_${body_id}`).empty();


                            for (let j = 0; j < maxLength; j++) {
                                const valLeft = valuesLeft[j];
                                const valRight = valuesRight[j];

                                const leftId = valLeft ? `${parent_id}${body_id}${paramLeft.parameter_id}${valLeft.value_id}` :
                                    "";
                                const rightId = valRight ?
                                    `${parent_id}${body_id}${paramRight.parameter_id}${valRight.value_id}` : "";

                                if (valLeft) {
                                    const isChecked = triageDetil?.some(d => d.value_id === valLeft.value_id);
                                    // $(`#left_${paramLeft.parameter_id}`).html("")
                                    $(`#left_${paramLeft.parameter_id}_${body_id}`).append(`
                        <div class="form-check mb-1">
                            <input type="checkbox" class="form-check-input score-check-triaseNew" 
                                data-param="${paramLeft.parameter_id}" 
                                data-body="${body_id}" 
                                id="${leftId}" 
                                name="val${valLeft.value_id}" 
                                ${isChecked ? 'checked' : ''}>
                            <label class="form-check-label" for="${leftId}">${valLeft.value_desc}</label>
                        </div>
                    `);
                                }

                                if (valRight) {
                                    const isChecked = triageDetil?.some(d => d.value_id === valRight.value_id);
                                    // $(`#right_${paramRight.parameter_id}`).html("")

                                    $(`#right_${paramRight.parameter_id}_${body_id}`).append(`
                        <div class="form-check mb-1">
                            <input type="checkbox" class="form-check-input score-check-triaseNew" 
                                data-param="${paramRight.parameter_id}" 
                                data-body="${body_id}" 
                                id="${rightId}" 
                                name="val${valRight.value_id}" 
                                ${isChecked ? 'checked' : ''}>
                            <label class="form-check-label" for="${rightId}">${valRight.value_desc}</label>
                        </div>
                    `);
                                }
                            }
                        }

                        $(containerId).on("change", ".score-check-triaseNew", function() {
                            const body_id = $(this).data("body");
                            const selector = `#bodyAssessment${parent_id}${body_id} .score-check-triaseNew`;

                            const selectedParams = [];

                            $(selector).each(function() {
                                if ($(this).is(":checked")) {
                                    const pid = $(this).data("param");
                                    if (['01', '02', '03', '04', '05'].includes(pid)) {
                                        selectedParams.push(pid);
                                    }
                                }
                            });

                            const minSelected = selectedParams.length > 0 ? selectedParams.sort()[0] : "01";
                            $(`#aTriageTotalScore${body_id}`).val(minSelected).trigger("change");
                        });

                        $(`#bodyAssessment${parent_id}${body_id} .score-check-triaseNew`).trigger("change");
                    }
                }
            </script>

            </html>
        </div>
    <?php } ?>
<?php
endif;
?>