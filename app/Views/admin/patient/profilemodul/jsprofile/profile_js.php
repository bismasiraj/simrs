<?php
$aValueParent = array();
foreach ($aValue as $key => $value) {
    $aValueParent[$value['parameter_id']]['parameter_id'] = $value['parameter_id'];
    $aValueParent[$value['parameter_id']]['p_type'] = $value['p_type'];
}
?>
<script type='text/javascript'>
    var doctors = <?= json_encode($employee); ?>;
    var clinics = <?= json_encode($clinic); ?>;
    var mrJson;
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    var examForassessment = <?= json_encode($exam); ?>;
    var avalue = <?= json_encode($aValue); ?>;
    var aparameter = <?= json_encode($aParameter); ?>;
    var atype = <?= json_encode($aType); ?>;
    var avalueparent = <?= json_encode($aValueParent); ?>;
    var fallRiskScore = Array();
    var painMonitoring;
    var painMonitoringDetil;
    var painIntervensi;
    var triage;
    var triageDetil;
    var apgar;
    var apgarDetil;
    var stabilitas;
    var stabilitasDetail;
    var tPerawat;
    var tPerawatAll;
    var napas;
    var fallRisk;
    var fallRiskDetail;
    var sirkulasiAll;
    var neuroAll;
    var integumenAll;
    var anakAll;
    var adlAll;
    var digestAll;
    var perkemihanAll;
    var seksualAll;
    var sleepingAll;
    var hearingAll;
    var socialAll;
    var psikologiAll;
    var psikologiDetailAll;
    var dekubitusAll;
    var giziAll;
    var giziDetailAll;
    var educationFormAll;
    var educationIntegrationAll;
    var educationIntegrationDetailAll;
    var educationIntegrationPlanAll = [];
    var educationIntegrationProvisionAll = [];
    var tarifData = []
    var addUnuDiag;
    var addUnuProc;
    var gcsDetailAll;

    $("#formeditfallriskbtn").on("click", function() {
        $("#formeditfallriskbtn").slideUp()
        $("#formsavefallriskbtn").slideDown()
        $("#formfallrisk").find("iput, select, textarea").prop("disabled", true)
    })
    $("#formeditfallriskbtnmedis").on("click", function() {
        $("#formeditfallriskbtnmedis").slideUp()
        $("#formsavefallriskbtnmedis").slideDown()
        $("#formfallriskmedis").find("iput, select, textarea").prop("disabled", true)
    })
</script>

<!-- PAIN MONITORING -->
<script>
    const addPainMonitoring = async (flag, index, document_id, container, isaddbutton = true) => {
        <?php foreach ($aParent as $key => $value) { ?>
            <?php if ($value['parent_id'] == '002') { ?>
                var documentId = $("#" + document_id).val()
                var bodyId = '';
                if (flag == 1) {
                    const date = new Date();
                    bodyId = date.toISOString().substring(0, 23);
                    bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
                } else {
                    bodyId = painMonitoring[index].body_id
                }
                $("#" + container).append(
                    '<form id="formPainMonitoring' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">' +
                    '<div class="card border border-1 rounded-4 m-4 p-4">' +
                    '<div class="card-body">' +
                    '<h4 class="card-title"> Monitoring Nyeri' +
                    '</h4>' +
                    '<div class="row mt-4">' +
                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Apakah Nyeri:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<div class="form-check mb-3">' +
                    '<select class="form-control" name="parameter_id01" id="atypeASES02101' + bodyId + '" onchange="aValueParamPain(\'<?= $value['parent_id']; ?>\',this.value, \'' + bodyId + '\')">' +
                    <?php foreach ($aValue as $key => $value1) { ?> <?php if ($value1['parameter_id'] == '01' && $value1['p_type'] == 'ASES021') { ?> '<option value="<?= $value1['value_id']; ?>"><?= $value1['value_desc']; ?></option>' +
                        <?php } ?> <?php } ?> '</select>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row mt-4">' +
                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Tanggal:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<div class="form-check mb-3">' +
                    '<input id="flatases022examination_date' + bodyId + '" type="text" class="form-control datetime" value="' + nowtime + '">' +
                    '<input id="ases022examination_date' + bodyId + '" name="examination_date" type="hidden">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Indikator:</h5>' +
                    '</div>' +
                    '<table class="col-md-12 table table-striped">' +
                    '<tbody id="bodyAssessment002' + bodyId + '">' +

                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Intervensi:</h5>' +
                    '</div>' +
                    '<table class="col-md-12 table table-striped">' +
                    '<tbody id="bodyAssessment002Intervensi' + bodyId + '">' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="panel-footer text-end mb-4">' +
                    '<button style="margin-right: 10px" type="submit" id="formPainMonitoringSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                    '<button style="margin-right: 10px" type="button" id="formPainMonitoringEditBtn' + bodyId + '" onclick="" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                    '<button style="margin-right: 10px" type="button" id="formPainMonitoringSignBtn' + bodyId + '" onclick="" name="sign" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning btn-sign"><i class="fa fa-signature"></i> <span>Sign</span></button>' +
                    '<button style="margin-right: 10px" type="button" id="formPainMonitoringCetakBtn' + bodyId + '" onclick="" name="cetak" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light"><i class="fa fa-file"></i> <span>Cetak</span></button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</form>'
                )

                datetimepickerbyid("flatases022examination_date" + bodyId)

                $("#formPainMonitoringSignBtn" + bodyId).on("click", function() {
                    addSignUserSatelite("formPainMonitoring" + bodyId, "ases022", bodyId, "ases022body_id" + bodyId, "formPainMonitoringSaveBtn" + bodyId, 4, 1, 1, "Monitoring Nyeri")
                })

                $("#formPainMonitoringEditBtn" + bodyId).on("click", function() {
                    $("#formPainMonitoringSaveBtn" + bodyId).slideDown()
                    $("#formPainMonitoringEditBtn" + bodyId).slideUp()
                    $("#formPainMonitoringSignBtn" + bodyId).slideDown()
                    $("#formPainMonitoring" + bodyId).find("input, textarea, select").prop("disabled", false)
                })
                $("#formPainMonitoringCetakBtn" + bodyId).on("click", function() {
                    var win = window.open('<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>' + '/' + bodyId, '_blank');
                })

                $("#formPainMonitoring" + bodyId).append('<input name="org_unit_code" id="ases022org_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>"  />')
                    .append('<input name="visit_id" id="ases022visit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>"  />')
                    .append('<input name="trans_id" id="ases022trans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>"  />')
                    .append('<input name="body_id" id="ases022body_id' + bodyId + '" type="hidden" value="' + bodyId + '"  />')
                    .append('<input name="document_id" id="ases022document_id' + bodyId + '" type="hidden" value="' + documentId + '"  />')
                    .append('<input name="no_registration" id="ases022no_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>"  />')
                    .append('<input name="clinic_id" id="ases022clinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>"  />')
                    .append('<input name="employee_id" id="ases022employee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>"  />')
                    .append('<input name="petugas_id" id="ases022petugas_id' + bodyId + '" type="hidden" value=""  />')
                    .append('<input name="class_room_id" id="ases022class_room_id' + bodyId + '" type="hidden" value="<?= $visit['class_room_id']; ?>"  />')
                    .append('<input name="bed_id" id="ases022bed_id' + bodyId + '" type="hidden" value="<?= $visit['bed_id']; ?>"  />')
                    .append('<input name="p_type" id="ases022p_type' + bodyId + '" type="hidden" value="ASES021"  />')
                    .append('<input name="description" id="ases022description' + bodyId + '" type="hidden" value="<?= $visit['description']; ?>"  />')
                    .append('<input name="modified_date" id="ases022modified_date' + bodyId + '" type="hidden" value="<?= $visit['modified_date']; ?>"  />')
                    .append('<input name="modified_by" id="ases022modified_by' + bodyId + '" type="hidden" value="<?= $visit['modified_by']; ?>"  />')
                    .append('<input name="pain_monitoring_status" id="ases022pain_monitoring_status' + bodyId + '" type="hidden" value=""  />')
                    .append('<input name="valid_date" class="valid_date" id="ases022valid_date' + bodyId + '" type="hidden"  />')
                    .append('<input name="valid_user" class="valid_user" id="ases022valid_user' + bodyId + '" type="hidden"  />')
                    .append('<input name="valid_pasien" class="valid_pasien" id="ases022valid_pasien' + bodyId + '" type="hidden"  />')


                $("#formPainMonitoring" + bodyId).on('submit', (function(e) {
                    e.preventDefault(); // Prevent default form submission

                    // Prepare the submit button and form data
                    const $form = $(this);
                    const $submitBtn = $form.find(':submit');

                    $("#ases022document_id" + bodyId).val($("#" + document_id).val())

                    $submitBtn.button('loading');
                    postDataForm(new FormData(this), 'admin/rm/assessment/savePainMonitoring', (response) => {
                        console.log(response)
                        if (response.status === 'success') {
                            if ($("#ases022valid_user" + bodyId).val() == '') {
                                $("#formPainMonitoringSaveBtn" + bodyId).slideUp();
                                $("#formPainMonitoringEditBtn" + bodyId).slideDown();
                                $("#formPainMonitoringSignBtn" + bodyId).slideDown();
                            } else {
                                $("#formPainMonitoringSaveBtn" + bodyId).slideUp();
                                $("#formPainMonitoringEditBtn" + bodyId).slideUp();
                                $("#formPainMonitoringSignBtn" + bodyId).slideUp();
                            }
                            // Disable the form inputs
                            $form.find("input, textarea, select").prop("disabled", true);

                            // Optionally display a success message
                            successSwal(response.message);
                        } else {
                            // Handle server-side validation or other error messages
                            errorSwal(response.message || 'An error occurred. Please try again.');
                        }
                    });
                    // $.ajax({
                    //     url: '<?php echo base_url(); ?>admin/rm/assessment/savePainMonitoring',
                    //     type: "POST",
                    //     data: new FormData(this),
                    //     dataType: 'json',
                    //     contentType: false,
                    //     cache: false,
                    //     processData: false,
                    //     success: function(response) {
                    //         // Handle response based on the status from the server
                    //         if (response.status === 'success') {
                    //             if ($("#ases022valid_user").val() == '') {
                    //                 $("#formPainMonitoringSaveBtn" + bodyId).slideUp();
                    //                 $("#formPainMonitoringEditBtn" + bodyId).slideDown();
                    //                 $("#formPainMonitoringSignBtn" + bodyId).slideDown();
                    //             } else {
                    //                 $("#formPainMonitoringSaveBtn" + bodyId).slideUp();
                    //                 $("#formPainMonitoringEditBtn" + bodyId).slideUp();
                    //                 $("#formPainMonitoringSignBtn" + bodyId).slideUp();
                    //             }
                    //             // Disable the form inputs
                    //             $form.find("input, textarea, select").prop("disabled", true);

                    //             // Optionally display a success message
                    //             successSwal(response.message);
                    //         } else {
                    //             // Handle server-side validation or other error messages
                    //             errorSwal(response.message || 'An error occurred. Please try again.');
                    //         }
                    //     },
                    //     error: function(xhr) { // if error occured
                    //         alert("An error occurred. Please try again.");
                    //         $submitBtn.button('reset');
                    //         errorSwal(xhr);
                    //     },
                    //     complete: function() {
                    //         $submitBtn.button('reset');
                    //     }
                    // });
                }));
                $("#formPainMonitoringEdit" + bodyId).on("click", function() {
                    $("#formPainMonitoringSaveBtn" + bodyId).slideDown()
                    $("#formPainMonitoringEditBtn" + bodyId).slideUp()
                    $("#formPainMonitoringSignBtn" + bodyId).slideDown()
                    $("#formPainMonitoring" + bodyId).find("input, textarea, select").prop("disabled", false)
                })

                if (flag == 1) {
                    $("#flatases022examination_date" + bodyId).val(nowtime).trigger("change")
                    $("#formPainMonitoringSaveBtn" + bodyId).slideDown()
                    $("#formPainMonitoringEditBtn" + bodyId).slideUp()

                    $("#formPainMonitoring" + bodyId).find("input, textarea, select").prop("disabled", false)

                } else {
                    var maindataset = painMonitoring[index]

                    $.each(maindataset, function(key, value) {
                        $("#ases022" + key + bodyId).val(value)
                    })
                    $("#flatases022examination_date" + bodyId).val(formatedDatetimeFlat(maindataset.examination_date)).trigger("change")
                    // $("#formPainMonitoringSaveBtn" + bodyId).slideUp()
                    // $("#formPainMonitoringEditBtn" + bodyId).slideDown()
                    $("#formPainMonitoring" + bodyId).find("input, textarea, select").prop("disabled", true)
                    let painDetilSelected = painMonitoringDetil.filter(item => item.body_id == bodyId);
                    $.each(painDetilSelected, function(key, value) {
                        if (value.p_type == 'ASES021' && value.body_id == bodyId && value.parameter_id == '01') {
                            $('#atypeASES02101' + bodyId).val(value.value_id)
                            // $('#atypeASES02101' + bodyId).prop("disabled", true)
                            $("#ases022body_id" + bodyId).val(bodyId)
                            // $('#formPainMonitoring' + bodyId + ' option').prop("disabled", true)
                            aValueParamPain('<?= $value['parent_id']; ?>', value.value_id, bodyId, flag)
                            aValueParamPain('<?= $value['parent_id']; ?>', $('#atypeASES02101' + bodyId).val(), bodyId, flag)
                        } else {
                            aValueParamPain('<?= $value['parent_id']; ?>', value.p_type, bodyId, flag)
                        }
                    })
                    let painIntervensiSelected = painIntervensi.filter(item => item.body_id == bodyId)
                    if (painIntervensiSelected.length > 0) {
                        $("#bodyAssessment002Intervensi" + bodyId).html("")
                    }
                    $.each(painIntervensi, function(key1, value1) {
                        if (value1.body_id == bodyId)
                            addIntervensi('<?= $value['parent_id']; ?>', value1.p_type, bodyId, key1, flag)
                    });
                    await checkSignSignature("formPainMonitoring" + bodyId, "ases022body_id" + bodyId, "formPainMonitoringSaveBtn")
                    if ($("#ases022valid_user" + bodyId).val() == '') {
                        $("#formPainMonitoringSaveBtn" + bodyId).slideDown()
                        $("#formPainMonitoringEditBtn" + bodyId).slideUp()
                        $("#formPainMonitoringSignBtn" + bodyId).slideUp()
                    } else {
                        $("#formPainMonitoringSaveBtn" + bodyId).slideUp()
                        $("#formPainMonitoringEditBtn" + bodyId).slideUp()
                        $("#formPainMonitoringSignBtn" + bodyId).slideUp()
                    }
                }
            <?php } ?>
        <?php } ?>
        index++

        if (isaddbutton && $("#ases022valid_user" + bodyId).val() == '')
            $("#addPainMonitoringButton").html('<a onclick="addPainMonitoring(1,' + index + ',\'' + document_id + '\', \'' + container + '\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        else
            $("#" + container + "AddBtn").html("")
    }

    function aValueParamPain(parent_id, p_type, body_id, flag) {
        $.each(avalue, function(key, value) {
            if (value.value_id == p_type) {
                p_type = value.value_info
            }
        })
        $("#bodyAssessment" + parent_id + body_id).html("")
        $("#bodyAssessment002Intervensi" + body_id).html("")
        var counter = 0;
        $.each(aparameter, function(key, value) {
            if (value.p_type == 'ASES021' && value.parameter_id != '01') {
                counter++;
                if (value.parameter_id != '05') {
                    $("#bodyAssessment" + parent_id + body_id).append(
                        '<tr>' +
                        '<td>' + counter + '.</td>' +
                        '<td> <h6 class="font-size-14 mb-4">' + value.parameter_desc + '<i class="mdi mdi-arrow-right text-primary me-1"></i</h6></td>' +
                        '<td><div class="row" id="' + parent_id + value.p_type + value.parameter_id + body_id + '">' +
                        '</div></td>' +
                        '</tr>'
                    )
                } else {
                    $("#bodyAssessment" + parent_id + body_id).append(
                        '<tr>' +
                        '<td>' + counter + '.</td>' +
                        '<td> <h6 class="font-size-14 mb-4">' + value.parameter_desc + '<i class="mdi mdi-arrow-right text-primary me-1"></i</h6></td>' +
                        '<td><select name="parameter_id05" class="form-control" id="' + parent_id + value.p_type + value.parameter_id + body_id + '">' +
                        '</select></td>' +
                        '</tr>'
                    )
                }

                $.each(avalue, function(key1, value1) {
                    if (value1.parameter_id == value.parameter_id && value1.p_type == 'ASES021' && value.parameter_id != '05') {
                        $("#" + parent_id + value.p_type + value.parameter_id + body_id).append(
                            '<div class="col-md-3"><div class="form-check mb-3"><input class="form-check-input" type="radio" name="parameter_id' + value1.parameter_id + '" id="parent_id' + parent_id + value1.value_id + body_id + '" value="' + value1.value_id + '" onchange="aValueParamScore(\'' + parent_id + '\', \'' + p_type + '\', \'' + value1.parameter_id + '\', ' + value1.value_score + ')"><label class="form-check-label" for="parent_id' + parent_id + value1.value_id + body_id + '">' + value1.value_desc + '</label></div></div>'
                        )
                    } else if (value.parameter_id == '05' && value1.parameter_id == '01' && value1.p_type == p_type) {
                        $("#" + parent_id + value.p_type + value.parameter_id + body_id).append(
                            '<option value="' + value1.value_id + '">[' + value1.value_score + '] ' + value1.value_desc + '.</option>'
                        )
                    }
                });
            }
            if (value.p_type == p_type) {
                if (p_type == 'ASES022' || p_type == 'ASES023' || p_type == 'ASES024') {
                    $("#bodyAssessment002Intervensi" + body_id).append(
                        // '<thead>' +
                        // '<tr>' +
                        // '<th>Tanggal dan Jam Intervensi</th>' +
                        // '<th>Intervensi</th>' +
                        // '<th>Rute</th>' +
                        // '<th>' + value.parameter_desc + '</th>' +
                        // '<th>Re-Assessment</th>' +
                        // '</tr>' +
                        // ' </thead>' +

                        // '<tr>' +
                        // '<td>' +
                        // '<input id="flattimeIntervensi' + body_id + 0 + '" + type="text" class="form-control" value="">' +
                        // '<input id="timeIntervensi' + body_id + 0 + '" name="timeIntervensi[]" type="hidden" class="form-control" value="">' +
                        // '<input id="reassessment_date' + body_id + 0 + '" name="reassessment_date[]" type="text" class="form-control d-none" value="">' +
                        // '</td>' +
                        // '<td>' +
                        // '<select id="intervensi' + body_id + 0 + '" name="intervensi[]" type="text" class="form-control" value="">' +
                        // '</select>' +
                        // '</td>' +
                        // '<td>' +
                        // '<select id="rute' + body_id + 0 + '" name="rute[]" type="text" class="form-control" value="">' +
                        // '</select>' +
                        // '</td>' +
                        // '<td>' +
                        // '<select id="painscalescore' + body_id + 0 + '" name="painscalescore[]" type="text" class="form-control" value="">' +
                        // '</select>' +
                        // '</td>' +
                        // '<td>' +
                        // '<select id="reAssessment' + body_id + 0 + '" name="reAssessment[]" type="text" class="form-control" value="" onchange="setRescheduleIntervensi(\'' + parent_id + '\', \'' + p_type + '\', \'' + body_id + '\', ' + 0 + ', this.value)">' +
                        // '</select>' +
                        // '</td>' +
                        // '</tr>' +

                        '<tr id="divBtnIntervensi' + body_id + '">' +
                        '<td colspan="5">' +
                        '<div class="row mb-4">' +
                        '<div class="col-md-12">' +
                        '<div  class="box-tab-tools text-center">' +
                        '<a onclick="addIntervensi(\'' + parent_id + '\', \'' + p_type + '\', \'' + body_id + '\', 0, 1)" class="btn btn-primary btn-sm"  style="width: 200px"><i class=" fa fa-plus"></i> Tambah Intervensi</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '</tr>'
                    )

                    // datetimepickerbyid('flattimeIntervensi' + body_id + 0)


                    // $.each(avalue, function(key1, value1) {
                    //     if (value1.parameter_id == value.parameter_id && value1.p_type == p_type) {
                    //         $("#painscalescore" + body_id + '0').append(
                    //             '<option value="' + value1.value_id + '">[' + value1.value_score + '] ' + value1.value_desc + '.</option>'
                    //         )
                    //     }
                    // });
                    // var initialDate = new Date();
                    // // Set the initial date to two hours ahead
                    // initialDate.setHours(initialDate.getHours());

                    // var timeZoneOffsetMinutes = initialDate.getTimezoneOffset();

                    // // Adjust the date to the local time zone
                    // initialDate.setMinutes(initialDate.getMinutes() - timeZoneOffsetMinutes);
                    // // Format the initial date into a string compatible with the datetime-local input
                    // var formattedInitialDate = initialDate.toISOString().slice(0, 16);


                    addIntervensi('<?= $value['parent_id']; ?>', p_type, body_id, 0, 1)

                    // Set the value of the input field to the formatted initial date
                    // document.getElementById("timeIntervensi" + body_id + '0').value = formattedInitialDate;
                    // document.getElementById("reassessment_date" + body_id + '0').value = formattedInitialDate;
                } else {
                    if (value.p_type == p_type) {
                        if (value.entry_type == 1) {
                            $("#bodyAssessment002Intervensi" + body_id).append($('<div class="row">')
                                .append('<label class="col-md-4 col-form-label mb-4">' + value.parameter_desc + '</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="text" id="' + value.p_type + value.parameter_id + body_id + '" name="' + value.column_name + '" placeholder=""></div>')
                            )
                        } else if (value.entry_type == 2) {
                            $("#bodyAssessment002Intervensi" + body_id).append($('<div class="form-group col-md-12">')
                                .append($('<div class="row">')
                                    .append('<label class="col-md-4 col-form-label mb-4">' + value.parameter_desc + '</label>')
                                    .append('<div class="col-md-8"><input class="form-control" type="text" id="' + value.p_type + value.parameter_id + body_id + '" name="' + value.column_name + '" placeholder=""></div>')

                                )
                            )
                            $.each(avalue, function(key1, value1) {
                                if (value1.p_type == value.p_type && value1.parameter_id == value.parameter_id && value1.value_score == '99') {
                                    $("#" + value.p_type + value.parameter_id + body_id)
                                        .append($('<div id="' + value.p_type + value.parameter_id + value1.value_id + 'group' + body_id + '"  class="row" style="display: none;">')
                                            .append('<label class="col-md-4 col-form-label mb-4">' + value1.value_desc + '</label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="' + value.p_type + value.parameter_id + value1.value_id + body_id + '" name="' + value.value_info + '" placeholder=""></div>')
                                        )
                                }
                            })
                        } else if (value.entry_type == 3) {

                            $("#bodyAssessment002Intervensi" + body_id).append($('<div class="row">')
                                .append('<label class="col-md-4 col-form-label mb-4">' + value.parameter_desc + '</label>')
                                .append($('<div class="col-md-8">')
                                    .append($('<select id="' + value.p_type + value.parameter_id + body_id + '" name="' + value.p_type + value.parameter_id + '" class="form-control">')
                                        .append('<option>-</option>')
                                    )
                                )
                            )
                            $.each(avalue, function(key1, value1) {
                                if (value1.p_type == value.p_type && value1.parameter_id == value.parameter_id) {
                                    $("#" + value.p_type + value.parameter_id + body_id)
                                        // .append($('<div id="' + value.p_type + value.parameter_id + value1.value_id + 'group' + body_id + '"  class="row" style="display: none;">')
                                        .append('<option value="' + value1.value_score + '">' + value1.value_desc + '</option>')
                                }
                            })
                        }
                    }
                }

            }
        });
        $.each(avalue, function(key1, value1) {
            if (value1.parameter_id == '01' && value1.p_type == 'GEN0005') {
                $("#reAssessment" + body_id + '0').append(
                    '<option value="' + value1.value_score + '">' + value1.value_desc + '.</option>'
                )
            }
        });

        $.each(aparameter, function(key1, value1) {
            if (value1.p_type == 'GEN0003') {
                $("#intervensi" + body_id + '0').append(
                    '<option value="' + value1.parameter_id + '">' + value1.parameter_desc + '.</option>'
                )
            }
        });
        $.each(aparameter, function(key1, value1) {
            if (value1.p_type == 'GEN0004') {
                $("#rute" + body_id + '0').append(
                    '<option value="' + value1.parameter_id + '">' + value1.parameter_desc + '.</option>'
                )
            }
        });
        if (flag == '0') {
            $.each(painMonitoringDetil, function(key1, value1) {
                if (value1.body_id == body_id && value1.parameter_id != '05') {
                    $('[name="parameter_id' + value1.parameter_id + '"][value="' + value1.value_id + '"]').prop("checked", true)
                    $('[name="parameter_id' + value1.parameter_id + '"][type="radio"]:not(:checked)').prop("disabled", true)
                } else {
                    // $("#atypeASES02101" + body_id).val(value1.value_id)
                    // $('#atypeASES02101' + body_id + ' option').prop("disabled", true)
                }
                if (value1.p_type == p_type) {
                    $("#" + value1.p_type + value1.parameter_id + body_id).val(value1.value_score)
                }
            });
        }
        if (flag == '0') {
            if (p_type == 'ASES022' || p_type == 'ASES023' || p_type == 'ASES024') {
                $("#bodyAssessment002Intervensi" + body_id).html("")
                $.each(painMonitoringDetil, function(key1, value1) {
                    if (value1.body_id == body_id && value1.parameter_id != '05') {
                        $('[name="parameter_id' + value1.parameter_id + '"][value="' + value1.value_id + '"]').prop("checked", true)
                        $('[name="parameter_id' + value1.parameter_id + '"][type="radio"]:not(:checked)').prop("disabled", true)
                    } else {
                        $("#002ASES02105" + body_id).val(value1.value_id)
                        $('#002ASES02105' + body_id + ' option').prop("disabled", true)
                    }
                });

            } else {
                $("#bodyAssessment002Intervensi" + body_id).find("select, input, textarea").prop("disabled", true)
            }
        }
    }

    function addIntervensi(parent_id, p_type, body_id, lastIndex, flag) {
        // var beforeIndex = lastIndex
        // if (flag == 1) {
        //     lastIndex++
        // }
        let beforeIndex = $("#bodyAssessment002Intervensi" + body_id + " thead").length
        indexnow = beforeIndex + 1
        $.each(aparameter, function(key, value) {
            if (value.p_type == p_type) {
                $("#divBtnIntervensi" + body_id).remove()
                $("#bodyAssessment002Intervensi" + body_id).append(
                    `<thead class="${parent_id + p_type + body_id + indexnow}">` +
                    '<tr>' +
                    '<th>Tanggal dan Jam Intervensi</th>' +
                    '<th>Intervensi</th>' +
                    '<th>Rute</th>' +
                    '<th>' + value.parameter_desc + '</th>' +
                    '<th>Re-Assessment</th>' +
                    '</tr>' +
                    ' </thead>' +
                    `<tr class="${parent_id + p_type + body_id + indexnow}">` +
                    '<td>' +
                    '<input id="flattimeIntervensi' + body_id + '' + indexnow + '" type="text" class="form-control">' +
                    '<input id="timeIntervensi' + body_id + '' + indexnow + '" name="timeIntervensi[]" type="hidden">' +
                    '<input id="flatreassessment_date' + body_id + '' + indexnow + '" type="text" class="form-control d-none">' +
                    '<input id="reassessment_date' + body_id + '' + indexnow + '" name="reassessment_date[]" type="hidden" class="form-control">' +
                    '</td>' +
                    '<td>' +
                    '<select id="intervensi' + body_id + '' + indexnow + '" name="intervensi[]" type="text" class="form-control" value="">' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<select id="rute' + body_id + '' + indexnow + '" name="rute[]" type="text" class="form-control" value="">' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<select id="painscalescore' + body_id + '' + indexnow + '" name="painscalescore[]" type="text" class="form-control" value="">' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<select id="reAssessment' + body_id + '' + indexnow + '" name="reAssessment[]" type="text" class="form-control" value="" onchange="setRescheduleIntervensi(\'' + parent_id + '\', \'' + p_type + '\', \'' + body_id + '\', ' + indexnow + ', this.value)">' +
                    '</select>' +
                    '</td>' +
                    `<td><button type="button" onclick="removeByClass('${parent_id + p_type + body_id + indexnow}')" class="btn btn-danger btn-remove-intervensi" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button></td>` +
                    '</tr>' +
                    '<tr id="divBtnIntervensi' + body_id + '">' +
                    '<td colspan="5">' +
                    '<div class="row mb-4">' +
                    '<div class="col-md-12">' +
                    '<div  class="box-tab-tools text-center">' +
                    '<a onclick="addIntervensi(\'' + parent_id + '\', \'' + p_type + '\', \'' + body_id + '\', ' + indexnow + ',1)" class="btn btn-primary btn-sm"  style="width: 200px"><i class=" fa fa-plus"></i> Tambah Intervensi</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '</tr>'
                )

                $("#timeIntervensi" + body_id + indexnow).on("change", function() {
                    console.log("jalan nggak ya")
                    $("#reAssessment" + body_id + indexnow).trigger("change")
                })

                datetimepickerbyid("flattimeIntervensi" + body_id + indexnow)
                datetimepickerbyid("flatreassessment_date" + body_id + indexnow)

                $.each(avalue, function(key1, value1) {
                    if (value1.parameter_id == value.parameter_id && value1.p_type == p_type) {
                        $("#painscalescore" + body_id + indexnow).append(
                            '<option value="' + value1.value_id + '">[' + value1.value_score + '] ' + value1.value_desc + '.</option>'
                        )
                    }
                });
                // Get the value of the input field
                var date
                if (flag == 1) {
                    var inputDate = $("#flatreassessment_date" + body_id + beforeIndex).val();
                    date = inputDate
                } else {
                    date = nowtime;
                }

                $.each(avalue, function(key1, value1) {
                    if (value1.parameter_id == '01' && value1.p_type == 'GEN0005') {
                        $("#reAssessment" + body_id + indexnow).append(
                            '<option value="' + value1.value_score + '">' + value1.value_desc + '.</option>'
                        )
                    }
                });

                $.each(aparameter, function(key1, value1) {
                    if (value1.p_type == 'GEN0003') {
                        $("#intervensi" + body_id + indexnow).append(
                            '<option value="' + value1.parameter_id + '">' + value1.parameter_desc + '.</option>'
                        )
                    }
                });
                $.each(aparameter, function(key1, value1) {
                    if (value1.p_type == 'GEN0004') {
                        $("#rute" + body_id + indexnow).append(
                            '<option value="' + value1.parameter_id + '">' + value1.parameter_desc + '.</option>'
                        )
                    }
                });

                // Parse the input date string into a JavaScript Date object

                // Get the local time zone offset in minutes
                // var timeZoneOffsetMinutes = date.getTimezoneOffset();

                // // Adjust the date to the local time zone
                // date.setMinutes(date.getMinutes() - timeZoneOffsetMinutes);

                // Format the date into a string compatible with the datetime-local input
                // var formattedDate = date.toISOString().slice(0, 16);

                // Update the value of the input field with the new date
                $("#flattimeIntervensi" + body_id + indexnow).val(date).trigger("change")
                $("#flatreassessment_date" + body_id + indexnow).val(date).trigger("change")
            }
        });

        $.each(avalue, function(key1, value1) {
            if (value1.parameter_id == '01' && value1.p_type == 'GEN0005') {
                $("#reAssessment" + body_id + '' + indexnow).append(
                    '<option value="' + value1.value_score + '">' + value1.value_desc + '.</option>'
                )
            }
        });

        $.each(aparameter, function(key1, value1) {
            if (value1.p_type == 'GEN0003') {
                $("#intervensi" + body_id + indexnow).append(
                    '<option value="' + value1.parameter_id + '">' + value1.parameter_desc + '.</option>'
                )
            }
        });
        $.each(aparameter, function(key1, value1) {
            if (value1.p_type == 'GEN0004') {
                $("#rute" + body_id + indexnow).append(
                    '<option value="' + value1.parameter_id + '">' + value1.parameter_desc + '.</option>'
                )
            }
        });

        if (flag == '0') {
            console.log("masuk lagi nggak")
            console.log("lastIndex: " + lastIndex)

            intervensiData = painIntervensi[lastIndex]
            console.log()
            // $("#timeIntervensi" + body_id + lastIndex).val(intervensiData.intervensi_date)
            // $("#reassessment_date" + body_id + lastIndex).val(intervensiData.reassessment_date)
            $("#intervensi" + body_id + indexnow).val(intervensiData.intervensi)
            $("#rute" + body_id + indexnow).val(intervensiData.rute)
            $("#painscalescore" + body_id + indexnow).val(intervensiData.value_id)
            $("#reAssessment" + body_id + indexnow).val(intervensiData.reassessment)

            let formatedDateIntervensi = formatedDatetimeFlat(intervensiData.intervensi_date)
            let formatedDateReassessmentDate = formatedDatetimeFlat(intervensiData.reassessment_date)

            $("#flattimeIntervensi" + body_id + indexnow).val(formatedDateIntervensi).trigger("change")
            $("#flatreassessment_date" + body_id + indexnow).val(formatedDateReassessmentDate).trigger("change")
            if (intervensiData.valid !== null) {
                $("#timeIntervensi" + body_id + indexnow).prop("readonly", true)
                $("#reassessment_date" + body_id + indexnow).prop("readonly", true)
                $("#intervensi" + body_id + indexnow + " option").prop("disabled", true)
                $("#rute" + body_id + indexnow + " option").prop("disabled", true)
                $("#painscalescore" + body_id + indexnow + " option").prop("disabled", true)
                $("#reAssessment" + body_id + indexnow + " option").prop("disabled", true)
            }
        }
    }

    function setRescheduleIntervensi(parent_id, p_type, body_id, index, thevalue) {
        // Get the value of the input field
        var inputDate = document.getElementById("timeIntervensi" + body_id + index).value;

        console.log("inputDate :" + inputDate)
        console.log("thevalue :" + thevalue)
        // Parse the input date string into a JavaScript Date object
        // var date = new Date(inputDate);
        var formattedDate = moment(inputDate).add(parseInt(thevalue), 'minutes').format("DD/MM/YYYY HH:mm");
        console.log("formattedDate :" + formattedDate)

        // Add two hours to the date
        // date.setMinutes(date.getMinutes() + parseInt(thevalue));
        // Get the local time zone offset in minutes
        // var timeZoneOffsetMinutes = date.getTimezoneOffset();

        // Adjust the date to the local time zone
        // date.setMinutes(date.getMinutes() - timeZoneOffsetMinutes);

        // Format the date into a string compatible with the datetime-local input
        // var formattedDate = date.toISOString().slice(0, 16);

        // Update the value of the input field with the new date
        $("#flatreassessment_date" + body_id + index).val(formattedDate).trigger("change")
    }

    function getPainMonitoring(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPainMonitoring',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                painMonitoring = data.painMonitoring
                painMonitoringDetil = data.painDetil
                painIntervensi = data.painIntervensi

                $.each(painMonitoring, function(key, value) {
                    $("#" + container).html("")
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyPainMonitoringPerawat").html("")
                        addPainMonitoring(0, key, 'arpbody_id', "bodyPainMonitoringPerawat")
                    } else if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyPainMonitoringMedis").html("")
                        addPainMonitoring(0, key, 'armpasien_diagnosa_id', "bodyPainMonitoringMedis", false)
                    }
                })
            },
            error: function() {

            }
        });

    }

    function copyPainMonitoring(flag, index, document_id, container, isaddbutton = true) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/copyPainMonitoring',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': $("#" + document_id)?.val()
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                painMonitoring = data.painMonitoring
                painMonitoringDetil = data.painDetil
                painIntervensi = data.painIntervensi

                $.each(painMonitoring, function(key, value) {
                    $("#" + container).html("")
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyPainMonitoringPerawat").html("")
                        addPainMonitoring(0, key, 'arpbody_id', "bodyPainMonitoringPerawat")
                    } else if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyPainMonitoringMedis").html("")
                        addPainMonitoring(0, key, 'armpasien_diagnosa_id', "bodyPainMonitoringMedis", false)
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- TRIASE -->
<script type="text/javascript">
    function addTriage(flag, index, document_id, container, isaddbutton = true) {
        <?php foreach ($aParent as $key => $value) { ?>
            <?php if ($value['parent_id'] == '004') { ?>
                var bodyId = '';
                var documentId = $("#" + document_id).val()
                if (flag == 1) {
                    const date = new Date();
                    bodyId = date.toISOString().substring(0, 23);
                    bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
                } else {
                    bodyId = triage[index].body_id
                }
                $("#" + container).append(
                    '<form id="formTriage' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">' +
                    '<div class="card border border-1 rounded-4 m-4 p-4">' +
                    '<div class="card-body">' +
                    '<h4 class="card-title"> Triage' +
                    '</h4>' +
                    '<div class="row mt-4">' +
                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Jenis Triage:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<div class="form-check mb-3">' +
                    // '<select class="form-control" name="p_type" id="aParamTriage' + bodyId + '" >' +
                    '<select class="form-control" name="p_type" id="aParamTriage' + bodyId + '" onchange="aValueParamTriage(\'<?= $value['parent_id']; ?>\',this.value, \'' + bodyId + '\', 1)">' +
                    <?php foreach ($aType as $key1 => $value1) { ?> <?php if ($value1['parent_id'] == $value['parent_id']) { ?> '<option value="<?= $value1['p_type']; ?>"><?= $value1['p_description']; ?></option>' +
                        <?php } ?> <?php } ?> '</select>' +
                    '</div>' +
                    '</div>' +

                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Step 1:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<h5 class="font-size-14 mb-4">Perlu tindakan <i>Live Saving/Resusitasi</i> segera?</h5>' +
                    '<div class="row">' +
                    <?php foreach ($aValue as $key1 => $value1) {
                        if ($value1['p_type'] == 'GEN0008' && $value1['parameter_id'] == '01') { ?> '<div class="col-md-3">' +
                            '<div class="form-check mb-3">' +
                            '<input class="form-check-input" type="radio" name="gen000801" id="step1<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '" checked="" value="<?= $value1['value_id']; ?>">' +
                            '<label class="form-check-label" for="step1<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '"><?= $value1['value_desc']; ?></label>' +
                            '</div>' +
                            '</div>' +
                    <?php }
                    } ?> '</div>' +
                    '</div>' +

                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Step 2:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<h5 class="font-size-14 mb-4">Resiko Tinggi, Kebingungan/Letargis/Disorientasi, Nyeri/Distress Berat?</h5>' +
                    '<div class="row">' +
                    <?php foreach ($aValue as $key1 => $value1) {
                        if ($value1['p_type'] == 'GEN0008' && $value1['parameter_id'] == '02') { ?> '<div class="col-md-3">' +
                            '<div class="form-check mb-3">' +
                            '<input class="form-check-input" type="radio" name="gen000802" id="step2<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '" checked="" value="<?= $value1['value_id']; ?>">' +
                            '<label class="form-check-label" for="step2<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '"><?= $value1['value_desc']; ?></label>' +
                            '</div>' +
                            '</div>' +
                    <?php }
                    } ?> '</div>' +
                    '</div>' +

                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Step 3:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<h5 class="font-size-14 mb-4">Berapa jenis sumber daya IGD yang dibutuhkan?</h5>' +
                    '<div class="row">' +
                    <?php foreach ($aValue as $key1 => $value1) {
                        if ($value1['p_type'] == 'GEN0008' && $value1['parameter_id'] == '03') { ?> '<div class="col-md-3">' +
                            '<div class="form-check mb-3">' +
                            '<input class="form-check-input" type="radio" name="gen000803" id="step3<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '" checked="" value="<?= $value1['value_id']; ?>">' +
                            '<label class="form-check-label" for="step3<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '"><?= $value1['value_desc']; ?></label>' +
                            '</div>' +
                            '</div>' +
                    <?php }
                    } ?> '</div>' +
                    '</div>' +


                    '</div>' +
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
                    '<div class="panel-footer text-end mb-4">' +
                    '<button type="submit" id="formTriageSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                    '<button style="margin-right: 10px" type="button" id="formTriageEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-edit"></i> <span>Edit</span></button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</form>'
                )

                $("#formTriageEditBtn" + bodyId).on("click", function() {
                    $("#formTriageSaveBtn" + bodyId).slideDown()
                    $("#formTriageEditBtn" + bodyId).slideUp()
                    $("#formTriage" + bodyId).find("input, textarea, select").prop("disabled", false)
                })


                $("#formTriage" + bodyId).append('<input name="org_unit_code" id="triageorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>"  />')
                    .append('<input name="visit_id" id="triagevisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>"  />')
                    .append('<input name="trans_id" id="triagetrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>"  />')
                    .append('<input name="body_id" id="triagebody_id' + bodyId + '" type="hidden" value="' + bodyId + '"  />')
                    .append('<input name="document_id" id="triagedocument_id' + bodyId + '" type="hidden" value="' + documentId + '"  />')
                    .append('<input name="no_registration" id="triageno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>"  />')
                    .append('<input name="clinic_id" id="triageclinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>"  />')
                    .append('<input name="employee_id" id="triageemployee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>"  />')
                    .append('<input name="petugas_id" id="triagepetugas_id' + bodyId + '" type="hidden" value=""  />')
                    .append('<input name="class_room_id" id="triageclass_room_id' + bodyId + '" type="hidden" value="<?= $visit['class_room_id']; ?>"  />')
                    .append('<input name="bed_id" id="triagebed_id' + bodyId + '" type="hidden" value="<?= $visit['bed_id']; ?>"  />')
                    .append('<input name="description" id="triagedescription' + bodyId + '" type="hidden" value="<?= $visit['description']; ?>"  />')
                    .append('<input name="modified_date" id="triagemodified_date' + bodyId + '" type="hidden" value="<?= $visit['modified_date']; ?>"  />')
                    .append('<input name="modified_by" id="triagemodified_by' + bodyId + '" type="hidden" value="<?= $visit['modified_by']; ?>"  />')
                    .append('<input name="valid_date" class="valid_date" id="triagevalid_date' + bodyId + '" type="hidden"  />')
                    .append('<input name="valid_user" class="valid_user" id="triagevalid_user' + bodyId + '" type="hidden"  />')
                    .append('<input name="valid_pasien" class="valid_pasien" id="triagevalid_pasien' + bodyId + '" type="hidden"  />')
                // .append('<input name="p_type" id="triagep_type' + bodyId + '" type="hidden" value=""  />')
                $("#formTriage" + bodyId).on('submit', (function(e) {
                    $("#triagedocument_id" + bodyId).val($("#" + document_id).val())
                    let clicked_submit_btn = $(this).closest('form').find(':submit');
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/rm/assessment/saveTriage',
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
                            $('#formTriage' + bodyId).find("input, select, textarea").prop("disabled", true)
                            $('#formTriage' + bodyId + ' input[type="datetime-local"]').prop("readonly", true)
                            $("#formTriageSaveBtn" + bodyId).slideUp()
                            checkSign("formTriage" + bodyId)
                        },
                        error: function(xhr) { // if error occured
                            alert("Error occured.please try again");
                            clicked_submit_btn.button('reset');
                            errorMsg(xhr);
                        },
                        complete: function() {
                            clicked_submit_btn.button('reset');
                        }
                    });
                }));


                if (flag == 1) {
                    $("#formTriageSaveBtn" + bodyId).slideDown()
                    $("#formTriageEditBtn" + bodyId).slideUp()
                    $("#formTriage" + bodyId).find("input, textarea, select").prop("disabled", false)

                } else {
                    var triageset = triage[index]

                    $.each(triageset, function(key, value) {
                        $("#triage" + key + bodyId).val(value)
                    })
                    $.each(triageDetil, function(key, value) {
                        $("#formTriageSaveBtn" + bodyId).slideUp()
                        $("#formTriageEditBtn" + bodyId).slideDown()

                        if (value.p_type == 'GEN0008' && value.body_id == bodyId) {
                            $('#aParamTriage' + bodyId).val(triage[index].p_type)
                            $('#aTriageTotalScore' + bodyId).val(triage[index].total_score)
                            $('#step1' + value.parameter_id + value.value_id + bodyId).prop("checked", true)
                            $('#step2' + value.parameter_id + value.value_id + bodyId).prop("checked", true)
                            $('#step3' + value.parameter_id + value.value_id + bodyId).prop("checked", true)
                            // $('#formTriage' + bodyId + ' option').prop("disabled", true)
                            aValueParamTriage('<?= $value['parent_id']; ?>', triage[index].p_type, bodyId, flag)
                        }
                        $("#formTriage" + bodyId).find("input, textarea, select").prop("disabled", true)
                    })
                    checkSign("formTriage" + bodyId)
                }
            <?php } ?>
        <?php } ?>
        index++
        if (isaddbutton && $("#triagevalid_user" + bodyId).val() == '')
            $("#addTriageButton").html('<a onclick="addTriage(1,' + index + ',\'' + document_id + '\', \'bodyTriageMedis\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        else
            $("#" + container + "AddBtn").html("")

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
                    '<th id="theadAssessment' + parent_id + body_id + value.parameter_id + '">' + value.parameter_desc + '</th>'
                )
                if (value.parameter_id == '01') {
                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("color", "white")
                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("background-color", "red")
                } else if (value.parameter_id == '02' || value.parameter_id == '03') {
                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("background-color", "yellow")
                } else if (value.parameter_id == '04' || value.parameter_id == '05') {
                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("color", "white")
                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("background-color", "green")
                }

            }
        });

        $.each(avalue, function(key, value) {
            if (value.p_type == 'GEN0007') {
                $("#tbodyAssessment" + parent_id + body_id).append(
                    '<tr id="tbodyAssessment' + parent_id + body_id + value.value_id + '"><td>' + value.value_desc + '</td></tr>'
                )
                $.each(aparameter, function(key1, value1) {
                    if (value1.p_type == p_type) {
                        $("#tbodyAssessment" + parent_id + body_id + value.value_id).append(
                            '<td id="tbodyAssessment' + parent_id + body_id + value.value_id + value1.parameter_id + '"></td>'
                        )
                        $.each(avalue, function(key2, value2) {
                            if (value2.value_info == value.value_id && value2.parameter_id == value1.parameter_id && value2.p_type == p_type) {
                                $("#tbodyAssessment" + parent_id + body_id + value.value_id + value1.parameter_id).append(
                                    '<div class="form-check mb-3">' +
                                    '<input name="val' + value2.value_id + '" class="form-check-input" type="checkbox" id="' + parent_id + body_id + value.value_id + value1.parameter_id + value2.value_id + '">' +
                                    '<label class="form-check-label" for="' + parent_id + body_id + value.value_id + value1.parameter_id + value2.value_id + '">' + value2.value_desc + '</label>' +
                                    '</div>'
                                )
                                $.each(triageDetil, function(key3, value3) {
                                    if (value3.value_id == value2.value_id) {
                                        $("#" + parent_id + body_id + value.value_id + value2.parameter_id + value3.value_id).prop("checked", true)
                                    }
                                })
                            }

                        });
                    }
                });

            }
        })

    }

    function getTriage(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getTriage',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                triage = data.triage
                triageDetil = data.triageDetil

                $.each(triage, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyTriagePerawat").html("")
                        addTriage(0, key, "arpbody_id", "bodyTriagePerawat", false)
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyTriageMedis").html("")
                        addTriage(0, key, "armpasien_diagnosa_id", "bodyTriageMedis", false)
                    }

                })
            },
            error: function() {

            }
        });
    }

    function copyTriage(flag, index, document_id, container, isaddbutton = true) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/copyTriage',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'document_id': $("#" + document_id)?.val()
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                triage = data.triage
                triageDetil = data.triageDetil

                $.each(triage, function(key, value) {

                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyTriagePerawat").html("")
                        addTriage(0, key, "arpbody_id", "bodyTriagePerawat", false)
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyTriageMedis").html("")
                        addTriage(0, key, "armpasien_diagnosa_id", "bodyTriageMedis", false)
                    }

                })
            },
            error: function() {

            }
        });
    }
</script>


<!-- APGAR -->
<script type="text/javascript">
    function addApgar(flag, index, document_id, container, isaddbutton = true) {
        <?php $apgarType = array_filter($aType, function ($value) {
            return $value['parent_id'] == '005';
        });
        usort($apgarType, function ($a, $b) {
            return $a['p_type'] <=> $b['p_type'];
        });;
        ?>
        <?php foreach ($aParent as $key => $value) { ?>
            <?php if ($value['parent_id'] == '005') { ?>
                var bodyId = '';
                var documentId = $("#" + document_id).val()
                if (flag == 1) {
                    const date = new Date();
                    bodyId = date.toISOString().substring(0, 23);
                    bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
                } else {
                    bodyId = apgar[index].body_id
                }
                $("#" + container).append(
                    '<form id="formApgar' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">' +
                    '<div class="card border border-1 rounded-4 m-4 p-4">' +
                    '<div class="card-body">' +
                    '<h4 class="card-title"> Apgar' +
                    '</h4>' +
                    '<div class="row mt-4">' +




                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Indikator:</h5>' +
                    '</div>' +
                    '<table class="col-md-12 table table-striped">' +
                    '<thead>' +
                    '<tr id="headAssessment005' + bodyId + '"><th></th>' +
                    <?php foreach ($aType as $key1 => $value1) {
                        if ($value1['parent_id'] == '005') {
                            foreach ($aParameter as $key2 => $value2) {
                                if ($value2['p_type'] == $value1['p_type']) {

                    ?> '<th><?= $value2['parameter_desc']; ?>' +
                                    '</th>' +
                    <?php
                                }
                            }
                            break;
                        }
                    } ?> '</tr>' +
                    '</thead>' +
                    '<tbody id="bodyAssessment005' + bodyId + '">' +
                    <?php foreach ($apgarType as $key1 => $value1) {
                        if ($value1['parent_id'] == '005') {
                    ?> '<tr><td><?= $value1['p_description']; ?></td>' +
                            <?php
                            foreach ($aParameter as $key2 => $value2) {
                                if ($value2['p_type'] == $value1['p_type']) {

                            ?> '<td><select id="<?= $value['parent_id'] . $value1['p_type'] . $value2['parameter_id']; ?>' + bodyId + '" name="<?= $value['parent_id'] . $value1['p_type'] . $value2['parameter_id']; ?>" class="form-control">' +
                                    <?php foreach ($aValue as $key3 => $value3) {
                                        if ($value3['parameter_id'] == $value2['parameter_id'] && $value3['p_type'] == $value1['p_type']) {
                                    ?> '<option value="<?= $value3['value_id']; ?>"><?= $value3['value_desc']; ?></option>' +
                                    <?php
                                        }
                                    } ?> '</select></td>' +
                            <?php
                                }
                            }
                            ?> '</tr>' +
                    <?php
                        }
                    } ?> '</tr>' + '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="panel-footer text-end mb-4">' +
                    '<button type="submit" id="formApgarSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                    '<button style="margin-right: 10px" type="button" id="formApgarEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</form>'
                )

                $("#formApgarEditBtn" + bodyId).on("click", function() {
                    $("#formApgarSaveBtn" + bodyId).slideDown()
                    $("#formApgarEditBtn" + bodyId).slideUp()
                    $("#formApgar" + bodyId).find("input, select, textarea").prop("disabled", false)
                })

                $("#formApgar" + bodyId).append('<input name="org_unit_code" id="apgarorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
                    .append('<input name="visit_id" id="apgarvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
                    .append('<input name="trans_id" id="apgartrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
                    .append('<input name="body_id" id="apgarbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
                    .append('<input name="document_id" id="apgardocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
                    .append('<input name="no_registration" id="apgarno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
                    .append('<input name="clinic_id" id="apgarclinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
                    .append('<input name="employee_id" id="apgaremployee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="petugas_id" id="apgarpetugas_id' + bodyId + '" type="hidden" value="" class="form-control" />')
                    .append('<input name="class_room_id" id="apgarclass_room_id' + bodyId + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
                    .append('<input name="bed_id" id="apgarbed_id' + bodyId + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
                    .append('<input name="description" id="apgardescription' + bodyId + '" type="hidden" value="<?= $visit['description']; ?>" class="form-control" />')
                    .append('<input name="modified_date" id="apgarmodified_date' + bodyId + '" type="hidden" value="<?= $visit['modified_date']; ?>" class="form-control" />')
                    .append('<input name="modified_by" id="apgarmodified_by' + bodyId + '" type="hidden" value="<?= $visit['modified_by']; ?>" class="form-control" />')
                    .append('<input name="p_type" id="apgarp_type' + bodyId + '" type="hidden" value="ASES032" class="form-control" />')
                    .append('<input name="valid_date" class="valid_date" id="apgarvalid_date' + bodyId + '" type="hidden"  />')
                    .append('<input name="valid_user" class="valid_user" id="apgarvalid_user' + bodyId + '" type="hidden"  />')
                    .append('<input name="valid_pasien" class="valid_pasien" id="apgarvalid_pasien' + bodyId + '" type="hidden"  />')

                $("#formApgar" + bodyId).on('submit', (function(e) {
                    $("#apgardocument_id" + bodyId).val($("#" + document_id).val())
                    let clicked_submit_btn = $(this).closest('form').find(':submit');
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/rm/assessment/saveApgar',
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
                            $("#formApgarSaveBtn" + bodyId).slideUp()
                            $("#formApgarEditBtn" + bodyId).slideDown()
                            $("#formApgar" + bodyId).find("input, select, textarea").prop("disabled", true)
                            clicked_submit_btn.button('reset');
                            checkSign("formApgar" + bodyId)
                        },
                        error: function(xhr) { // if error occured
                            alert("Error occured.please try again");
                            clicked_submit_btn.button('reset');
                            errorMsg(xhr);
                        },
                        complete: function() {
                            clicked_submit_btn.button('reset');
                        }
                    });
                }));


                if (flag == 1) {
                    $("#formApgarSaveBtn" + bodyId).slideDown()
                    $("#formApgarEditBtn" + bodyId).slideUp()
                    $("#formApgar" + bodyId).find("input, select, textarea").prop("disabled", false)
                } else {
                    var maindataset = apgar[index]

                    $.each(maindataset, function(key, value) {
                        $("#apgar" + key + bodyId).val(value)
                    })
                    $("#formApgarSaveBtn" + bodyId).slideUp()
                    $("#formApgarEditBtn" + bodyId).slideDown()
                    $("#formApgar" + bodyId).find("input, select, textarea").prop("disabled", true)

                    $.each(apgarDetil, function(key, value) {

                        if (value.body_id == bodyId) {
                            $("#005" + value.p_type + value.parameter_id + value.body_id).val(value.value_id)
                        }
                    })
                    checkSign("formApgar" + bodyId)
                }
            <?php } ?>
        <?php } ?>
        index++

        if (isaddbutton && $("#apgarvalid_user" + bodyId).val() == '')
            $("#" + container + "AddBtn").html('<a onclick="addApgar(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        else
            $("#" + container + "AddBtn").html("")


    }

    function aValueParamApgar(parent_id, p_type, body_id, flag) {
        $("#apgarp_type" + body_id).val(p_type)
        $("#bodyAssessment" + parent_id + body_id).html("")




        var counter = 0;
        <?php foreach ($aType as $key => $value) {
            if ($value['parent_id'] == '005') {
        ?>
        <?php
            }
        } ?>
        $.each(aparameter, function(key, value) {
            if (value.p_type == p_type) {
                $("#bodyAssessment005" + body_id).append(
                    '<tr id="' + parent_id + p_type + body_id + value.parameter_id + '">' +
                    '<td>' + value.parameter_desc +
                    '</td>' +
                    '</tr>'
                )
                $.each(avalue, function(key1, value1) {
                    $(parent_id + p_type + body_id + value.parameter_id).append(
                        '<td>'
                    )
                })
            }
        });

        $.each(avalue, function(key, value) {
            $("#tbodyAssessment" + parent_id + body_id).append(
                '<th>' + value.value_desc + '</th>'
            )
            if (value.p_type == 'GEN0007') {
                $.each()
                $.each(aparameter, function(key1, value1) {
                    if (value1.p_type == p_type) {
                        $("#tbodyAssessment" + parent_id + body_id + value.value_id).append(
                            '<td id="tbodyAssessment' + parent_id + body_id + value.value_id + value1.parameter_id + '"></td>'
                        )
                        $.each(avalue, function(key2, value2) {
                            if (value2.value_info == value.value_id && value2.parameter_id == value1.parameter_id && value2.p_type == p_type) {
                                $("#tbodyAssessment" + parent_id + body_id + value.value_id + value1.parameter_id).append(
                                    '<div class="form-check mb-3">' +
                                    '<input name="val' + value2.value_id + '" class="form-check-input" type="checkbox" id="' + parent_id + body_id + value.value_id + value1.parameter_id + value2.value_id + '">' +
                                    '<label class="form-check-label" for="' + parent_id + body_id + value.value_id + value1.parameter_id + value2.value_id + '">' + value2.value_desc + '</label>' +
                                    '</div>'
                                )
                                $.each(triageDetil, function(key3, value3) {
                                    if (value3.value_id == value2.value_id) {
                                        $("#" + parent_id + body_id + value.value_id + value2.parameter_id + value3.value_id).prop("checked", true)
                                    }
                                })
                            }

                        });
                    }
                });

            }
        })

    }

    function getApgar(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getApgar',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                apgar = data.apgar
                apgarDetil = data.apgarDetil

                $.each(apgar, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyApgarPerawat").html("")
                        addApgar(0, key, "arpbody_id", "bodyApgarPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyApgarMedis").html("")
                        addApgar(0, key, "armpasien_diagnosa_id", "bodyApgarMedis", false)
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>


<!-- STABILITAS -->
<script type="text/javascript">
    function addDerajatStabilitas(flag, index, document_id, container, isaddbutton = true) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = stabilitas[index].body_id
        }
        $("#" + container).append(
            '<form id="formStabilitas' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">' +
            '<div class="card border border-1 rounded-4 m-4 p-4">' +
            '<div class="card-body">' +
            '<h4 class="card-title"> Derajat Stabilitas' +
            '</h4>' +
            '<div class="row mt-4">' +
            '</div>' +
            '<div class="row">' +
            '<div class="col-md-3">' +
            '<h5 class="font-size-14 mb-4 badge bg-primary">Indikator:</h5>' +
            '</div>' +
            '<div class="col-md-3">' +
            '<select class="form-control" id="stabilitas' + bodyId + '" name="stabilitas">' +
            <?php foreach ($aValue as $key1 => $value1) {
                if ($value1['p_type'] == 'GEN0012') {
            ?> '<option value="<?= $value1['value_id']; ?>">[<?= $value1['value_score']; ?>] <?= $value1['value_desc']; ?>' +
                    '</option>' +
            <?php
                }
            } ?> '</select>' +
            '</div>' +
            '<table class="col-md-12 table table-striped">' +
            '<thead>' +
            '<tr id="headAssessment005' + bodyId + '">' +
            '<th>Level</th>' +
            '<th>Kategori</th>' +
            '<th>Pendamping Internal</th>' +
            '<th>Peralatan</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody id="bodyAssessment005' + bodyId + '">' +
            <?php
            foreach ($aValue as $key2 => $value2) {
                if ($value2['p_type'] == 'GEN0012') {
                    $stabilitasArray = explode(";", $value2['value_info']);
            ?> '<tr>' +
                    '<td><?= $value2['value_score']; ?></td>' +
                    '<td><?= $value2['value_desc']; ?></td>' +
                    '<td><?= $stabilitasArray[0]; ?></td>' +
                    '<td><?= $stabilitasArray[1]; ?></td>' +
                    '</tr>' +
            <?php
                }
            }
            ?> '</tbody>' +
            '</table>' +
            '</div>' +
            '<div class="panel-footer text-end mb-4">' +
            '<button type="submit" id="formStabilitasSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
            '<button style="margin-right: 10px" type="button" id="formStabilitasEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</form>'
        )


        $("#formStabilitasEditBtn" + bodyId).on("click", function() {
            $("#formStabilitasSaveBtn" + bodyId).slideDown()
            $("#formStabilitasEditBtn" + bodyId).slideUp()
            $("#formStabilitas" + bodyId).find("input, textarea, select").prop("disabled", false)
        })
        $("#formStabilitas" + bodyId).append('<input name="org_unit_code" id="stabilitasorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="stabilitasvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="stabilitastrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="stabilitasbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="stabilitasdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="stabilitasno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="clinic_id" id="stabilitasclinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="employee_id" id="stabilitasemployee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="petugas_id" id="stabilitaspetugas_id' + bodyId + '" type="hidden" value="" class="form-control" />')
            .append('<input name="class_room_id" id="stabilitasclass_room_id' + bodyId + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id" id="stabilitasbed_id' + bodyId + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="description" id="stabilitasdescription' + bodyId + '" type="hidden" value="<?= $visit['description']; ?>" class="form-control" />')
            .append('<input name="modified_date" id="stabilitasmodified_date' + bodyId + '" type="hidden" value="<?= $visit['modified_date']; ?>" class="form-control" />')
            .append('<input name="modified_by" id="stabilitasmodified_by' + bodyId + '" type="hidden" value="<?= $visit['modified_by']; ?>" class="form-control" />')
            .append('<input name="p_type" id="stabilitasp_type' + bodyId + '" type="hidden" value="ASES032" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="stabilitasvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="stabilitasvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="stabilitasvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formStabilitas" + bodyId).on('submit', (function(e) {
            $("#stabilitasdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveStabilitas',
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
                    $('#formStabilitas' + bodyId + ' select').prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formStabilitasSaveBtn" + bodyId).slideUp()
                    checkSign("formStabilitas" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formStabilitasSaveBtn" + bodyId).slideDown()
            $("#formStabilitasEditBtn" + bodyId).slideUp()
            $("#formStabilitas" + bodyId).find("input, textarea, select").prop("disabled", false)
        } else {
            var maindataset = stabilitas[index]

            $.each(maindataset, function(key, value) {
                $("#stabilitas" + key + bodyId).val(value)
            })
            $("#formStabilitasSaveBtn" + bodyId).slideUp()
            $("#formStabilitasEditBtn" + bodyId).slideDown()
            $("#formStabilitas" + bodyId).find("input, textarea, select").prop("disabled", true)

            $.each(stabilitasDetail, function(key, value) {
                if (value.body_id == bodyId) {
                    $('#stabilitas' + bodyId).val(value.value_id)
                    $('#stabilitas' + bodyId).prop("disabled", true)
                }
            })
            checkSign("formStabilitas" + bodyId)
        }
        index++
        if (isaddbutton && $("#ases022valid_user" + bodyId).val() == '') {
            $("#addDerajatStabilitasButton").html('<a onclick="addDerajatStabilitas(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        } else {
            $("#addDerajatStabilitasButton").html("")
        }
    }

    function getStabilitas(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getStabilitas',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                stabilitas = data.stabilitas
                stabilitasDetail = data.stabilitasDetail

                $.each(stabilitas, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addDerajatStabilitas(0, key, "arpbody_id", "bodyStabilitasPerawat")
                    if (value.document_id == $("#armpasien_diagnosa_id").val())
                        addDerajatStabilitas(0, key, "armpasien_diagnosa_id", "bodyStabilitasMedis")
                    if (value.document_id == $("#atransferbody_id").val())
                        addDerajatStabilitas(0, key, "atransferbody_id", container, false)
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- TINDAKAN PERAWAT -->
<script type="text/javascript">
    $(document).ready(function() {
        initializeSearchTarif("searchTarifPerawat", '<?= $visit['clinic_id']; ?>')
        initializeSearchTarif("searchTarifPerawatMandiri", '<?= $visit['clinic_id']; ?>')
    })
    var rowKolaborasi = 1;
    var rowMandiri = 1;
    var rowImplementasi = 1;


    function getTindakanPerawat() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getTindakanPerawat',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(e) {
                getLoadingscreen("contentTindakanPerawat", "loadContentTindakanPerawat")
            },
            success: function(data) {
                billPerawatJson = data
                $("#chargesBodyPerawat").html("")
                $("#chargesBodyPerawatMandiri").html("")
                $.each(billPerawatJson, function(key, value) {
                    addBillChargePerawat('', value.treatment_type, 0, key, 'tindakanBodyPerawat')
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- PERNAPASAN -->
<script type="text/javascript">
    function addPernapasan(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = napas[index].body_id
        }
        $("#" + container).append(
            $('<form id="formPernapasan' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Pernapasan"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES041') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES041' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formPernapasanSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formPernapasanEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        $("#formPernapasanEditBtn" + bodyId).on("click", function() {
            $("#formPernapasanSaveBtn" + bodyId).slideDown()
            $("#formPernapasanEditBtn" + bodyId).slideUp()
            $("#formPernapasan" + bodyId).find("input, select, textarea").prop("disabled", false)
        })
        $("#ASES04105" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04108" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04108" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES041' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formPernapasan" + bodyId).append('<input name="org_unit_code" id="respirationorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="respirationvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="respirationtrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="respirationbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="respirationdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="respirationno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="respirationp_type' + bodyId + '" type="hidden" value="ASES041" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="respirationvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="respirationvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="respirationvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formPernapasan" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/savePernapasan',
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
                    $('#formPernapasan' + bodyId + ' select').prop("disabled", true)
                    $('#formPernapasan' + bodyId + ' input').prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formPernapasanSaveBtn" + bodyId).slideUp()
                    $("#formPernapasanEditBtn" + bodyId).slideDown()
                    $("#formPernapasan" + bodyId).find("input, select, textarea").prop("disabled", true)

                    checkSign("formPernapasan" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));

        $("#ASES04105" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04108" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04114" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });

        if (flag == 1) {
            $("#formPernapasanSaveBtn" + bodyId).slideDown()
            $("#formPernapasanEditBtn" + bodyId).slideUp()
            $("#formPernapasan" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {
            var maindataset = napas[index]

            $.each(maindataset, function(key, value) {
                $("#respiration" + key + bodyId).val(value)
            })
            var napasDetil = napas[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES041') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(napas.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (napasDetil.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES041' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(napas.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formPernapasanSaveBtn" + bodyId).slideUp()
            $("#formPernapasanEditBtn" + bodyId).slideDown()
            $("#formPernapasan" + bodyId).find("input, select, textarea").prop("disabled", true)
            checkSign("formPernapasan" + bodyId)

        }
        index++
        $("#addPernapasanButton").html('<a onclick="addPernapasan(1,' + index + ',\'armpasien_diagnosa_id\', \'bodyPernapasanMedis\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getPernapasan(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPernapasan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                napas = data.napas
                // stabilitasDetail = data.stabilitasDetail

                $.each(napas, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addPernapasan(0, key, "arpbody_id", "bodyPernapasan")
                    else if (value.document_id == $("#armpasien_diagnosa_id").val())
                        addPernapasan(0, key, "armpasien_diagnosa_id", "bodyPernapasanMedis")
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- FALL RISK -->
<script type="text/javascript">
    const addFallRisk = async (flag, index, document_id, container, isaddbutton = true) => {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = fallRisk[index].body_id
        }

        var fallRiskContent = `
        <form id="formFallRisk` + bodyId + `" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
            <div class="card border border-1 rounder-4 m-4 p-4">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Tanggal:</h5>
                            </div>
                            <div class="col-md-9">
                                <input id="flatfallriskexamination_date` + bodyId + `" type="text" class="form-control">
                                <input id="fallriskexamination_date` + bodyId + `" name="examination_date" type="hidden" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Alat Ukur:</h5>
                            </div>
                            <div class="col-md-9">
                                <?php foreach ($aType as $key1 => $value1) { ?>
                                    <?php if ($value1['parent_id'] == '001') {
                                    ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="parameter<?= $value1['parent_id']; ?>" id="atype<?= $value1['p_type']; ?>` + bodyId + `" value="<?= $value1['p_type']; ?>" onchange="aValueParamFallRisk('<?= $value1['parent_id']; ?>', '<?= $value1['p_type']; ?>', '` + bodyId + `', '` + container + `')">
                                            <label class="form-check-label" for="atype<?= $value1['p_type']; ?>` + bodyId + `">
                                                <?= $value1['p_description']; ?>
                                            </label>
                                        </div>
                                    <?php
                                    } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Parameter 2:</h5>
                            </div>
                            <table class="col-md-12 table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Deskripsi</th>
                                        <th>Pilihan</th>
                                        <th>Score</th>
                                    </tr>

                                </thead>
                                <tbody id="` + container + `` + bodyId + `">
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer text-end mb-4">
                            <button type="submit" id="formFallRiskSaveBtn` + bodyId + `" name="save" data-loading-text="processing" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button style="margin-right: 10px; ; display: none;" type="button" id="formFallRiskEditBtn` + bodyId + `" onclick="" name="edit" data-loading-text="processing" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>
                            <button style="margin-right: 10px; ; display: none;" type="button" id="formFallRiskSigntBtn` + bodyId + `" onclick="" name="sign" data-loading-text="processing" class="btn btn-warning btn-sign"><i class="fa fa-signature"></i> <span>sign</span></button>
                            <button style="margin-right: 10px; ; display: none;" type="button" id="formFallRiskCetakBtn` + bodyId + `" onclick="" name="cetak" data-loading-text="processing" class="btn btn-light btn-cetak"><i class="fa fa-file"></i> <span>Cetak</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        `
        $("#" + container).append(fallRiskContent)
        datetimepickerbyid("flatfallriskexamination_date" + bodyId)

        $("#formFallRiskSigntBtn" + bodyId).on("click", function() {
            addSignUserSatelite("formFallRisk" + bodyId, "fallrisk", bodyId, "fallriskbody_id" + bodyId, "formFallRiskSaveBtn" + bodyId, 5, 1, 1, "Resiko Jatuh")
        })

        $("#formFallRiskEditBtn" + bodyId).on("click", function() {
            $("#formFallRiskSaveBtn" + bodyId).slideDown()
            $("#formFallRiskEditBtn" + bodyId).slideUp()
            $("#formFallRiskSignBtn" + bodyId).slideDown()
            $("#formFallRisk" + bodyId).find("input, select, textarea").prop("disabled", false)
        })
        $("#formFallRiskCetakBtn" + bodyId).on("click", function() {
            // window.open('<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>' + '/' + bodyId, '_blank');
        })

        $("#formFallRisk" + bodyId).append('<input name="org_unit_code" id="fallriskorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" />')
            .append('<input name="visit_id" id="fallriskvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" />')
            .append('<input name="trans_id" id="fallrisktrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" />')
            .append('<input name="body_id" id="fallriskbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" />')
            .append('<input name="document_id" id="fallriskdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" />')
            .append('<input name="no_registration" id="fallriskno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" />')
            .append('<input name="examination_date" id="fallriskexamination_date' + bodyId + '" type="hidden" value="' + get_date() + '" />')
            .append('<input name="clinic_id" id="fallriskclinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>" />')
            .append('<input name="employee_id" id="fallriskemployee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>" />')
            .append('<input name="p_type" id="fallriskp_type' + bodyId + '" type="hidden" value="ASES041" />')
            .append('<input name="modified_by" id="fallriskmodified_by' + bodyId + '" type="hidden" value="<?= user()->username; ?>" />')
            .append('<input name="valid_date" class="valid_date" id="fallriskvalid_date' + bodyId + '" type="hidden" />')
            .append('<input name="valid_user" class="valid_user" id="fallriskvalid_user' + bodyId + '" type="hidden" />')
            .append('<input name="valid_pasien" class="valid_pasien" id="fallriskvalid_pasien' + bodyId + '" type="hidden" />')

        $("#formFallRisk" + bodyId).on('submit', (function(e) {
            e.preventDefault();
            var isValid = true;
            var errorMessages = [];

            // Iterate through each fieldset
            $('#formFallRisk' + bodyId + ' fieldset').each(function() {
                var groupName = $(this).find('input[type="radio"]').attr('name');
                var isChecked = $(this).find('input[name="' + groupName + '"]:checked').length > 0;

                if (!isChecked) {
                    isValid = false;
                    errorMessages.push('Please select an option for ' + $(this).find('legend').text());
                }
            });
            if (isValid) {
                $("#fallriskdocument_id" + bodyId).val($("#" + document_id).val())
                let clicked_submit_btn = $(this).closest('form').find(':submit');
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/rm/assessment/saveFallRisk',
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
                        $('#formFallRisk' + bodyId + ' select').prop("disabled", true)
                        $('#formFallRisk' + bodyId + ' input').prop("disabled", true)
                        $("#formFallRiskSaveBtn" + bodyId).slideUp()
                        $("#formFallRiskEditBtn" + bodyId).slideDown()
                        $("#formFallRiskSignBtn" + bodyId).slideDown()
                        clicked_submit_btn.button('reset');
                        checkSign("formFallRisk" + bodyId)

                    },
                    error: function(xhr) { // if error occured
                        alert("Error occured.please try again");
                        clicked_submit_btn.button('reset');
                        errorMsg(xhr);
                    },
                    complete: function() {
                        clicked_submit_btn.button('reset');
                    }
                });
            } else {
                alert("Tolong isi semua penilaian Scoring nya sampai keluar total score")
            }
        }));
        if (flag == 1) {
            $("#formFallRiskSaveBtn" + bodyId).slideDown()
            $("#formFallRiskEditBtn" + bodyId).slideUp()
            $("#formFallRisk" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {
            var maindataset = fallRisk[index]

            $.each(maindataset, function(key, value) {
                $("#fallrisk" + key + bodyId).val(value)
            })
            $("#flatfallriskexamination_date" + bodyId).val(formatedDatetimeFlat(maindataset.examination_date)).trigger("change")
            var fallselect = fallRisk[index];

            $.each(atype, function(key, value) {
                if (value.parent_id == '001') {
                    $("#atype" + fallselect.p_type + bodyId).prop("checked", true)
                }
            })


            aValueParamFallRisk('001', fallselect.p_type, bodyId, container)

            $.each(fallRiskDetail, function(key, value) {
                if (value.body_id == fallselect.body_id) {

                    if ($("#parent_id001" + value.value_id + value.body_id).attr("type") === "text")
                        $("#parent_id001" + value.value_id + value.body_id).val(value.value_desc)
                    else
                        $("#parent_id001" + value.value_id + value.body_id).prop("checked", true)

                    aValueParamScore('001', value.p_type, value.parameter_id, value.value_score, bodyId)
                }
            })
            await checkSignSignature("formFallRisk" + bodyId, "fallriskbody_id" + bodyId, "formFallRiskSaveBtn")
            if ($("#fallriskvalid_pasien" + bodyId).val() == '') {
                $("#formFallRiskSaveBtn" + bodyId).slideUp()
                $("#formFallRiskEditBtn" + bodyId).slideDown()
                $("#formFallRiskSignBtn" + bodyId).slideDown()
                $("#formFallRisk" + bodyId).find("input, select, textarea").prop("disabled", true)
            } else {
                $("#formFallRiskSaveBtn" + bodyId).slideUp()
                $("#formFallRiskEditBtn" + bodyId).slideUp()
                $("#formFallRiskSignBtn" + bodyId).slideUp()
                $("#formFallRisk" + bodyId).find("input, select, textarea").prop("disabled", true)
            }
        }
        index++

        if (isaddbutton)
            $("#" + container + "AddBtn").html('<a onclick="addFallRisk(1,' + index + ',\'' + document_id + '\', \'' + container + '\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        else
            $("#" + container + "AddBtn").html("")
    }

    function aValueParamFallRisk(parent_id, p_type, bodyId, container) {
        $("#" + container + bodyId).html("")
        var counter = 0;
        $.each(aparameter, function(key, value) {
            if (value.p_type == p_type && (value.entry_type == null)) {
                counter++;
                $("#" + container + bodyId).append(
                    '<tr>' +
                    '<td>' + counter + '.</td>' +
                    '<td> <h6 class="font-size-14 mb-4">' + value.parameter_desc + ':</h6></td>' +
                    '<td><fieldset id="' + parent_id + value.p_type + value.parameter_id + bodyId + '">' +
                    '</fieldset></td>' +
                    '<td><h6 id="score' + parent_id + value.p_type + value.parameter_id + bodyId + '" class="font-size-14 mb-4"></h6></td>' +
                    '</tr>'
                )
                aValueParamScore('001', 'ASES020', '01', 3)
                $.each(avalue, function(key1, value1) {
                    if (value1.parameter_id == value.parameter_id && value1.p_type == p_type) {
                        $("#" + parent_id + value.p_type + value.parameter_id + bodyId).append(
                            '<div class="form-check mb-3"><input class="form-check-input" type="radio" name="parameter_id' + value1.parameter_id + '" id="parent_id' + parent_id + value1.value_id + bodyId + '" value="' + value1.value_id + '" onchange="aValueParamScore(\'' + parent_id + '\', \'' + p_type + '\', \'' + value1.parameter_id + '\', ' + value1.value_score + ', \'' + bodyId + '\')"><label class="form-check-label" for="parent_id' + parent_id + value1.value_id + bodyId + '" required>' + value1.value_desc + '</label></div>'
                        )
                    }
                });
            }
        });
        $("#" + container + bodyId).append(
            '<tr><td colspan="3"><h6 class="font-size-14 mb-4">Total Score</h6></td><td><h6 id="totalScore' + parent_id + p_type + bodyId + '" class="font-size-14 mb-4"></h6></td></tr>'
        )
        $.each(aparameter, function(key, value) {
            if (value.p_type == p_type && (value.entry_type == 1)) {

                $.each(avalue, function(key1, value1) {
                    if (value1.parameter_id == value.parameter_id && value1.p_type == p_type) {
                        console.log(container + bodyId)
                        $("#" + container + bodyId).append(
                            '<tr><td><h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>' + value1.value_desc + ':</h5></td><td colspan="3"><input class="form-control" type="text" name="parameter_id' + value.parameter_id + '" id="parent_id' + parent_id + value1.value_id + bodyId + '"></td></tr>'
                            // '<div class="form-check mb-3"><input class="form-check-input" type="radio" name="parameter_id' + value1.parameter_id + '" id="parent_id' + parent_id + value1.value_id + bodyId + '" value="' + value1.value_id + '" onchange="aValueParamScore(\'' + parent_id + '\', \'' + p_type + '\', \'' + value1.parameter_id + '\', ' + value1.value_score + ', \'' + bodyId + '\')"><label class="form-check-label" for="parent_id' + parent_id + value1.value_id + bodyId + '">' + value1.value_desc + '</label></div>'
                        )
                    }
                });
            }
        });
    }

    function aValueParamScore(parent_id, p_type, parameter_id, score, bodyId) {
        fallRiskScore['parameter_id' + parameter_id] = score;

        $('#score' + parent_id + p_type + parameter_id + bodyId).html(score)

        var total = 0;

        $.each(aparameter, function(key, value) {
            if (value.p_type == p_type && value.parameter_id != '08') {
                var valuenya = parseInt($("#score" + parent_id + value.p_type + value.parameter_id + bodyId).html())
                total += valuenya
            }
        });


        // for (var key in fallRiskScore) {
        //     total += fallRiskScore[key]
        // }
        $("#totalScore" + parent_id + p_type + bodyId).html(total)
    }

    function getFallRisk(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getFallRisk',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                fallRisk = data.fallRisk
                fallRiskDetail = data.fallRiskDetail

                $.each(fallRisk, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyFallRiskPerawat").html("")
                        addFallRisk(0, key, "arpbody_id", "bodyFallRiskPerawat")
                    } else if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyFallRiskMedis").html("")
                        addFallRisk(0, key, "armpasien_diagnosa_id", "bodyFallRiskMedis", false)
                    } else if (value.document_id == $("#acpptbody_id").val()) {
                        addFallRisk(0, key, "acpptbody_id", container, false)
                    }
                })
            },
            error: function() {

            }
        });
    }

    function copyFallRisk(flag, index, document_id, container, isaddbutton = true) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/copyFallRisk',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': $("#" + document_id)?.val()
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                fallRisk = data.fallRisk
                fallRiskDetail = data.fallRiskDetail

                $.each(fallRisk, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyFallRiskPerawat").html("")
                        addFallRisk(0, key, "arpbody_id", "bodyFallRiskPerawat")
                    } else if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyFallRiskMedis").html("")
                        addFallRisk(0, key, "armpasien_diagnosa_id", "bodyFallRiskMedis", false)
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- SIRKULASI -->
<script type="text/javascript">
    function addSirkulasi(flag, index, document_id, container, isaddbutton = true) {
        var bodyId = '';
        var documentId = $("#" + document_id).val()
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = sirkulasiAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formSirkulasi' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Sirkulasi"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES039') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES039' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formSirkulasiSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formSirkulasiEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES039' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formSirkulasiEditBtn" + bodyId).on("click", function() {
            $("#formSirkulasiSaveBtn" + bodyId).slideDown()
            $("#formSirkulasiEditBtn" + bodyId).slideUp()
            $("#formSirkulasi" + bodyId).find("input, textarea, select").prop("disabled", false)
        })

        $("#ASES03901" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES03906" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });


        $("#formSirkulasi" + bodyId).append('<input name="org_unit_code" id="sirkulasiorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="sirkulasivisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="sirkulasitrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="sirkulasibody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="sirkulasidocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="sirkulasino_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="sirkulasip_type' + bodyId + '" type="hidden" value="ASES039" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="sirkulasivalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="sirkulasivalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="sirkulasivalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formSirkulasi" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSirkulasi',
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
                    // $('#formSirkulasi' + bodyId + ' select').prop("disabled", true)
                    // $('#formSirkulasi' + bodyId + ' input').prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formSirkulasiSaveBtn" + bodyId).slideUp()
                    $("#formSirkulasiEditBtn" + bodyId).slideDown()
                    $("#formSirkulasi" + bodyId).find("input, textarea, select").prop("disabled", true)
                    checkSign("formSirkulasi" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formSirkulasiSaveBtn" + bodyId).slideDown()
            $("#formSirkulasiEditBtn" + bodyId).slideUp()
            $("#formSirkulasi" + bodyId).find("input, textarea, select").prop("disabled", false)

        } else {
            var maindataset = sirkulasiAll[index]

            $.each(maindataset, function(key, value) {
                $("#sirkulasi" + key + bodyId).val(value)
            })
            $("#formSirkulasiSaveBtn" + bodyId).slideUp()
            $("#formSirkulasiEditBtn" + bodyId).slideDown()
            $("#formSirkulasi" + bodyId).find("input, textarea, select").prop("disabled", true)
            var sirkulasi = sirkulasiAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES039') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(sirkulasi.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (sirkulasi.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES039' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(sirkulasi.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            checkSign("formSirkulasi" + bodyId)

        }
        index++
        if (isaddbutton && $("#sirkulasivalid_user" + bodyId).val() == '')
            $("#addSirkulasiButton").html('<a onclick="addSirkulasi(1,' + index + ',\'armpasien_diagnosa_id\', \'bodySirkulasiMedis\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        else
            $("#addSirkulasiButton").html('')
    }

    function getSirkulasi(bodyId) {
        $("#bodySirkulasi").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getSirkulasi',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                sirkulasiAll = data.sirkulasi
                $.each(sirkulasiAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addSirkulasi(0, key, "arpbody_id", "bodySirkulasi")
                    if (value.document_id == $("#armpasien_diagnosa_id").val())
                        addSirkulasi(0, key, "armpasien_diagnosa_id", "bodySirkulasiMedis")
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- NEUROSENSORIS -->
<script type="text/javascript">
    function addNeurosensoris(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = neuroAll[index].body_id
        }
        $("#bodyNeurosensoris").append(
            $('<form id="formNeurosensoris' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Neurosensoris"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES038') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES038' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formNeurosensorisSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formNeurosensorisEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES038' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formNeurosensoris" + bodyId).append('<input name="org_unit_code" id="neurosensorisorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="neurosensorisvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="neurosensoristrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="neurosensorisbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="neurosensorisdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="neurosensorisno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="neurosensorisp_type' + bodyId + '" type="hidden" value="ASES038" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="neurosensorisvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="neurosensorisvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="neurosensorisvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formNeurosensoris" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveNeurosensoris',
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
                    $("#formNeurosensoris" + bodyId).find("input, select, textarea").prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formNeurosensorisSaveBtn" + bodyId).slideUp()
                    $("#formNeurosensorisEditBtn" + bodyId).slideDown()
                    checkSign("formNeurosensoris" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));
        $("#formNeurosensorisEditBtn" + bodyId).on("click", function() {
            $("#formNeurosensorisSaveBtn" + bodyId).slideDown()
            $("#formNeurosensorisEditBtn" + bodyId).slideUp()
            $("#formDekubitus" + bodyId).find("input, select, textarea").prop("disabled", false)
        })

        $("#ASES03803" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES03805" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        if (flag == 1) {
            $("#formNeurosensorisSaveBtn" + bodyId).slideDown()
            $("#formNeurosensorisEditBtn" + bodyId).slideUp()
            $("#formNeurosensoris" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {
            var maindataset = neuroAll[index]

            $.each(maindataset, function(key, value) {
                $("#neurosensoris" + key + bodyId).val(value)
            })

            $("#formNeurosensorisSaveBtn" + bodyId).slideUp()
            $("#formNeurosensorisEditBtn" + bodyId).slideDown()

            var neuro = neuroAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES038') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(neuro.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (neuro.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES038' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(neuro.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $('#formNeurosensoris' + bodyId).find("input, select, textarea").prop("disabled", true)
            checkSign("formNeurosensoris" + bodyId)
        }
        index++
        $("#addNeurosensorisButton").html('<a onclick="addNeurosensoris(1,' + index + ')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getNeurosensoris(bodyId) {
        $("#bodyNeurosensoris").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getNeurosensoris',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                neuroAll = data.neuro
                // stabilitasDetail = data.stabilitasDetail

                $.each(neuroAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addNeurosensoris(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- ANAK -->
<script type="text/javascript">
    function addAnak(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = anakAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formAnak' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Anak"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES045') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                                                                        if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                            if ($value['parameter_id'] == '14') {
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES045' && in_array($value['parameter_id'], array('14', '15', '16', '17', '18', '19', '20', '21', '22', '23'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                                                                        if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                        }
                                                                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formAnakSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formAnakEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES045' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formAnak" + bodyId).append('<input name="org_unit_code" id="anaksorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="anaksvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="anakstrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="anaksbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="anaksdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="anaksno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="anaksp_type' + bodyId + '" type="hidden" value="ASES045" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="anaksvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="anaksvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="anaksvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formAnak" + bodyId).on('submit', (function(e) {
            $("#anaksdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveAnak',
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
                    $('#formAnak' + bodyId).find("input,select,textarea").prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formAnakSaveBtn" + bodyId).slideUp()
                    $("formAnakEditBtn" + bodyId).slideDown()
                    checkSign("formAnak" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));

        $("#ASES04506" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#formAnakEditBtn" + bodyId).on("click", function() {
            $("#formAnakSaveBtn" + bodyId).slideDown()
            $("#formAnakEditBtn" + bodyId).slideUp()
            $("#formAnak" + bodyId).find("input, select, textarea").prop("disabled", false)
        })
        if (flag == 1) {
            $("#formAnakSaveBtn" + bodyId).slideDown()
            $("formAnakEditBtn" + bodyId).slideUp()
        } else {

            var maindataset = anakAll[index]

            $.each(maindataset, function(key, value) {
                $("#anaks" + key + bodyId).val(value)
            })
            var anak = anakAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES045') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(anak.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (anak.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES045' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(anak.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formAnakSaveBtn" + bodyId).slideUp()
            $("formAnakEditBtn" + bodyId).slideDown()
            $("#formAnak" + bodyId).find("input, select, textarea").prop("disabled", true)
            checkSign("formAnak" + bodyId)

        }
        index++
        $("#addAnakButton").html('<a onclick="addAnak(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getAnak(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAnak',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                anakAll = data.anak
                // stabilitasDetail = data.stabilitasDetail

                $.each(anakAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyAnakPerawat").html("")
                        addAnak(0, key, "arpbody_id", "bodyAnakPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyAnakMedis").html("")
                        addAnak(0, key, "armpasien_diagnosa_id", "bodyAnakMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- NEONATUS -->
<script type="text/javascript">
    function addNeonatus(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = neonatusAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formNeonatus' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Neonatus"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES050') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                                                                        if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                            if ($value['parameter_id'] == '09') {
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES050' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                                                                        if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                        }
                                                                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formNeonatusSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formNeonatusEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES050' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formNeonatus" + bodyId).append('<input name="org_unit_code" id="neonatussorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="neonatussvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="neonatusstrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="neonatussbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="neonatussdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="neonatussno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="neonatussp_type' + bodyId + '" type="hidden" value="ASES050" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="neonatussvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="neonatussvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="neonatussvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formNeonatus" + bodyId).on('submit', (function(e) {
            $("#neonatussdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveNeonatus',
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
                    $('#formNeonatus' + bodyId).find("input,select,textarea").prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formNeonatusSaveBtn" + bodyId).slideUp()
                    $("formNeonatusEditBtn" + bodyId).slideDown()
                    checkSign("formNeonatus" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));

        $("#ASES05006" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#formNeonatusEditBtn" + bodyId).on("click", function() {
            $("#formNeonatusSaveBtn" + bodyId).slideDown()
            $("#formNeonatusEditBtn" + bodyId).slideUp()
            $("#formNeonatus" + bodyId).find("input, select, textarea").prop("disabled", false)
        })
        if (flag == 1) {
            $("#formNeonatusSaveBtn" + bodyId).slideDown()
            $("formNeonatusEditBtn" + bodyId).slideUp()
        } else {

            var maindataset = neonatusAll[index]

            $.each(maindataset, function(key, value) {
                $("#neonatuss" + key + bodyId).val(value)
            })
            var neonatus = neonatusAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES050') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(neonatus.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (neonatus.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES050' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(neonatus.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formNeonatusSaveBtn" + bodyId).slideUp()
            $("formNeonatusEditBtn" + bodyId).slideDown()
            $("#formNeonatus" + bodyId).find("input, select, textarea").prop("disabled", true)
            checkSign("formNeonatus" + bodyId)

        }
        index++
        $("#addNeonatusButton").html('<a onclick="addNeonatus(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getNeonatus(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getNeonatus',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                neonatusAll = data.neonatus
                // stabilitasDetail = data.stabilitasDetail

                $.each(neonatusAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyNeonatusPerawat").html("")
                        addNeonatus(0, key, "arpbody_id", "bodyNeonatusPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyNeonatusMedis").html("")
                        addNeonatus(0, key, "armpasien_diagnosa_id", "bodyNeonatusMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- ADL -->
<script type="text/javascript">
    function addADL(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = adlAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formADL' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Aktivitas dan Latihan"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES016') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option value="99">-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                    if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                                ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '06') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES016' && in_array($value['parameter_id'], array('07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option value="99">-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                    if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                                ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                    )
                    .append($('<div class="mb-3 row">')
                        .append($('<label class="col-md-2 col-form-label">Tingkat Ketergantungan ADL</label>'))
                        .append($('<div class="col-md-10">')
                            .append($('<select id="total_dependency' + bodyId + '" name="TOTAL_DEPENDENCY" class="form-control" readonly>'))
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formADLSave' + bodyId + '" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formADLEdit' + bodyId + '" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES016' && $value1['value_score'] == '99') {
        ?> $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formADL" + bodyId).append('<input name="org_unit_code" id="ADLorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="ADLvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="ADLtrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="ADLbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="ADLdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="ADLno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="ADLp_type' + bodyId + '" type="hidden" value="ASES016" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="ADLvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="ADLvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="ADLvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formADL" + bodyId).on('submit', (function(e) {
            $("#ADLsdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveADL',
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
                    $('#formADL' + bodyId + ' select').prop("disabled", true)
                    $('#formADL' + bodyId + ' input').prop("disabled", true)
                    $("#formADLSave" + bodyId).slideUp()
                    $("#formADLEdit" + bodyId).slideDown()
                    clicked_submit_btn.button('reset');
                    checkSign("formADL" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));
        $("#formADLEdit" + bodyId).on("click", function() {
            $("#formADLSave" + bodyId).slideDown()
            $("#formADLEdit" + bodyId).slideUp()
            $("#formADL" + bodyId).find("input, textarea, select").prop("disabled", false)
        })
        $("#formADL" + bodyId).find("select").on("change", function(e) {
            var totalScoreAdl = 0;
            $("#formADL" + bodyId).find("select").each(function() {
                var selectValue = $(this).val();
                totalScoreAdl += parseInt(selectValue)
                if (totalScoreAdl > 19)
                    var scoreAdlName = 'Mandiri'
                else if (totalScoreAdl < 19 && totalScoreAdl >= 15)
                    var scoreAdlName = 'Ketergantungan Ringan'
                else if (totalScoreAdl < 15 && totalScoreAdl >= 10)
                    var scoreAdlName = 'Ketergantungan Sedang'
                else if (totalScoreAdl < 10 && totalScoreAdl >= 5)
                    var scoreAdlName = 'Ketergantungan Berat'

                $("#total_dependency" + bodyId).html("")
                $("#total_dependency" + bodyId).append($('<option value="' + totalScoreAdl + '">' + scoreAdlName + '</option>'))
            })
        })

        if (flag == 1) {
            $("#formADLSave" + bodyId).slideDown()
            $("#formADLEdit" + bodyId).slideUp()
            $("#formADL" + bodyId).find("input, textarea, select").prop("disabled", false)
        } else {

            var maindataset = adlAll[index]

            $.each(maindataset, function(key, value) {
                $("#ADL" + key + bodyId).val(value)
            })

            var adl = adlAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES016') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(adl.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (adl.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES016' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?>' + bodyId).val(adl.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            var totalScoreAdl = 0;
            totalScoreAdl += parseInt(adl.total_dependency)
            if (totalScoreAdl > 19)
                var scoreAdlName = 'Mandiri'
            else if (totalScoreAdl < 19 && totalScoreAdl >= 15)
                var scoreAdlName = 'Ketergantungan Ringan'
            else if (totalScoreAdl < 15 && totalScoreAdl >= 10)
                var scoreAdlName = 'Ketergantungan Sedang'
            else if (totalScoreAdl < 10 && totalScoreAdl >= 5)
                var scoreAdlName = 'Ketergantungan Berat'

            $("#total_dependency" + bodyId).html("")
            $("#total_dependency" + bodyId).append($('<option value="' + totalScoreAdl + '">' + scoreAdlName + '</option>'))
            $("#formADLSave" + bodyId).slideDown()
            $("#formADLEdit" + bodyId).slideUp()
            $("#formADL" + bodyId).find("input, textarea, select").prop("disabled", true)
            checkSign("formADL" + bodyId)
        }

        index++
        $("#addADLButton").html('<a onclick="addADL(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getADL(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getADL',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                adlAll = data.adl
                // stabilitasDetail = data.stabilitasDetail

                $.each(adlAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyADLPerawat").html("")
                        addADL(0, key, "arpbody_id", "bodyADLPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyADLMedis").html("")
                        addADL(0, key, "armapsien_diagnosa_id", "bodyADLMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- DEKUBITUS -->
<script type="text/javascript">
    function addDekubitus(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = dekubitusAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formDekubitus' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Dekubitus"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES047') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES047' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formDekubitusSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formDekubitusEditBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit" style="display: none"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES047' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formDekubitus" + bodyId).append('<input name="org_unit_code" id="dekubitusorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="dekubitusvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="dekubitustrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="dekubitusbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="dekubitusdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="dekubitusno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="dekubitusp_type' + bodyId + '" type="hidden" value="ASES047" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="dekubitusvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="dekubitusvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="dekubitusvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formDekubitus" + bodyId).on('submit', (function(e) {
            $("#dekubitusdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveDekubitus',
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
                    $('#formDekubitus' + bodyId + ' select').prop("disabled", true)
                    $('#formDekubitus' + bodyId + ' input').prop("disabled", true)
                    clicked_submit_btn.button('reset');

                    $("#formDekubitusSaveBtn" + bodyId).slideUp()
                    $("#formDekubitusEditBtn" + bodyId).slideDown()
                    $("#formDekubitus" + bodyId).find("input, select, textarea").prop("disabled", true)
                    checkSign("formDekubitus" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        $("#formDekubitusEditBtn" + bodyId).on("click", function() {
            $("#formDekubitusSaveBtn" + bodyId).slideDown()
            $("#formDekubitusEditBtn" + bodyId).slideUp()
            $("#formDekubitus" + bodyId).find("input, select, textarea").prop("disabled", false)
        })

        if (flag == 1) {
            $("#formDekubitusSaveBtn" + bodyId).slideDown()
            $("#formDekubitusEditBtn" + bodyId).slideUp()
        } else {

            var maindataset = dekubitusAll[index]

            $.each(maindataset, function(key, value) {
                $("#dekubitus" + key + bodyId).val(value)
            })

            var digest = dekubitusAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES047') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES047' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formDekubitus" + bodyId).find("input, select, textarea").prop("disabled", true)
            $("#formDekubitusSaveBtn" + bodyId).slideUp()
            $("#formDekubitusEditBtn" + bodyId).slideDown()
            checkSign("formDekubitus" + bodyId)
        }
        index++
        $("#addDekubitusButton").html('<a onclick="addDekubitus(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getDekubitus(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getDekubitus',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                dekubitusAll = data.dekubitus

                $.each(dekubitusAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addDekubitus(0, key, 'arpbody_id', "bodyDekubitusPerawat")
                    if (value.document_id == $("#armpasien_diagnosa_id").val())
                        addDekubitus(0, key, 'armpasien_diagnosa_id', "bodyDekubitusMedis")
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- PENCERNAAN -->
<script type="text/javascript">
    function addPencernaan(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = digestAll[index].body_id
        }
        $("#bodyPencernaan").append(
            $('<form id="formPencernaan' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Pencernaan"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES040') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES040' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formPencernaanSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formPencernaanEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i><span>Edit</span></button>' +
                        '</div>')

                )
            )
        )
        $("#formPencernaanEditBtn").on("click", function() {
            $("#formPencernaan" + body).find("input, textarea, select").prop("disabled", false)
            $("#formPencernaanSaveBtn" + bodyId).slideDown()
            $("#formPencernaanEditBtn" + bodyId).slideUp()
        })
        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES040' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formPencernaan" + bodyId).append('<input name="org_unit_code" id="pencernaanorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="pencernaanvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="pencernaantrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="pencernaanbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="pencernaandocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="pencernaanno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="pencernaanp_type' + bodyId + '" type="hidden" value="ASES040" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="pencernaanvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="pencernaanvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="pencernaanvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formPencernaan" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/savePencernaan',
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
                    $("#formPencernaan" + bodyId).find("input, textarea, select").prop("disabled", true)
                    $("#formPencernaanSaveBtn" + bodyId).slideUp()
                    $("#formPencernaanEditBtn" + bodyId).slideDown()
                    clicked_submit_btn.button('reset');
                    checkSign("formPencernaan" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));
        $("#formPencernaanEditBtn" + bodyId).on("click", function() {
            $("#formPencernaanSaveBtn" + bodyId).slideDown()
            $("#formPencernaanEditBtn" + bodyId).slideUp()
            $("#formPencernaan" + bodyId).find("input, select, textarea").prop("disabled", false)
        })


        if (flag == 1) {
            $("#formPencernaan" + bodyId).find("input, textarea, select").prop("disabled", false)
            $("#formPencernaanSaveBtn" + bodyId).slideDown()
            $("#formPencernaanEditBtn" + bodyId).slideUp()
        } else {

            var maindataset = digestAll[index]

            $.each(maindataset, function(key, value) {
                $("#pencernaan" + key + bodyId).val(value)
            })

            var digest = digestAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES040') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES040' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formPencernaan" + bodyId).find("input, textarea, select").prop("disabled", true)
            $("#formPencernaanSaveBtn" + bodyId).slideUp()
            $("#formPencernaanEditBtn" + bodyId).slideDown()
            checkSign("formPencernaan" + bodyId)
        }
        index++
        $("#addPencernaanButton").html('<a onclick="addPencernaan(1,' + index + ')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getPencernaan(bodyId) {
        $("#bodyPencernaan").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPencernaan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                digestAll = data.pencernaan
                // stabilitasDetail = data.stabilitasDetail

                $.each(digestAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addPencernaan(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

<!-- PERKEMIHAN -->
<script type="text/javascript">
    function addPerkemihan(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = perkemihanAll[index].body_id
        }
        $("#bodyPerkemihan").append(
            $('<form id="formPerkemihan' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Perkemihan"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES042') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                                                                        if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>'
                                                .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                            ) <?php
                                                                                        } ?> <?php }
                                                                                            if ($value['parameter_id'] == '09') {
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                                ?>
                                        )
                                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                                    if ($value['p_type'] == 'ASES042 ' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                                    ?>
                                                        .append($('<div class="row">')
                                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                                        ) <?php
                                                                                                        } else if ($value['entry_type'] == 2) {
                                                            ?>
                                                        .append($('<div class="form-group col-md-12">')
                                                            .append($('<div class="row">')
                                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                                ?>
                                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                                    ) <?php
                                                                                                                }
                                                                                                            } ?>
                                                        ) <?php
                                                                                                        } else if ($value['entry_type'] == 3) {
                                                            ?>
                                                        .append($('<div class="row">')
                                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                            .append($('<div class="col-md-8">')
                                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                                    ?>
                                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                                        }
                                                                                                                                                                    } ?>
                                                                )
                                                            )
                                                        ) <?php
                                                                                                        }
                                                                                                        if ($value['entry_type'] == 4) {
                                                            ?>
                                                        .append($('<div class="row">')
                                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                            .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                                        ) <?php
                                                                                                        } ?> <?php }
                                                                                                        }
                                                                                                                ?>
                                        )
                                    )
                        .append('<div class="panel-footer text-end mb-4">' +
                            '<button type="submit" id="formPerkemihanSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                            '<button style="margin-right: 10px" type="button" id="formPerkemihanEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                            '</div>')

                    )
                )
            )



            <?php foreach ($aValue as $key1 => $value1) {
                if ($value1['p_type'] == 'ASES042 ' && $value1['value_score'] == '99') {
            ?> $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()

                        if ($(this).is(":checked")) {
                            $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                        } else {
                            $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideUp()
                        }
                    }); <?php
                    }
                } ?>

            $("#formPerkemihan" + bodyId).append('<input name="org_unit_code" id="perkemihanorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="perkemihanvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="perkemihantrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="perkemihanbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="perkemihandocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="perkemihanno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="perkemihanp_type' + bodyId + '" type="hidden" value="ASES042 " class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="perkemihanvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="perkemihanvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="perkemihanvalid_pasien' + bodyId + '" type="hidden"  />')


            $("#formPerkemihanEditBtn" + bodyId).on("click", function() {
                $("#formPerkemihan" + bodyId).find("input, textarea, select").prop("disabled", false)
                $("#formPerkemihanSaveBtn" + bodyId).slideDown()
                $("#formPerkemihanEditBtn" + bodyId).slideUp()
            })

            $("#formPerkemihan" + bodyId).on('submit', (function(e) {
                let clicked_submit_btn = $(this).closest('form').find(':submit');
                e.preventDefault();
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/rm/assessment/savePerkemihan',
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
                        $("#formPerkemihan" + bodyId).find("input, textarea, select").prop("disabled", true)
                        $("#formPerkemihanSaveBtn" + bodyId).slideUp()
                        $("#formPerkemihanEditBtn" + bodyId).slideDown()
                        clicked_submit_btn.button('reset');
                        checkSign("formPerkemihan" + bodyId)

                    },
                    error: function(xhr) { // if error occured
                        alert("Error occured.please try again");
                        clicked_submit_btn.button('reset');
                        errorMsg(xhr);
                    },
                    complete: function() {
                        clicked_submit_btn.button('reset');
                    }
                });
            }));


            if (flag == 1) {
                $("#formPerkemihan" + bodyId).find("input, textarea, select").prop("disabled", false)
                $("#formPerkemihanSaveBtn" + bodyId).slideDown()
                $("#formPerkemihanEditBtn" + bodyId).slideUp()

            } else {
                var maindataset = perkemihanAll[index]

                $.each(maindataset, function(key, value) {
                    $("#perkemihan" + key + bodyId).val(value)
                })
                var perkemihan = perkemihanAll[index];
                <?php foreach ($aParameter as $key => $value) {
                    if ($value['p_type'] == 'ASES042') {
                        // if ($value['entry_type'] == '3') {
                        if (in_array($value['entry_type'], [1, 3, 4])) {
                ?>
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(perkemihan.<?= strtolower($value['column_name']); ?>)
                        <?php

                        } else if ($value['entry_type'] == '2') {
                        ?>
                            if (perkemihan.<?= strtolower($value['column_name']); ?> == 1) {
                                $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                                <?php foreach ($aValue as $key1 => $value1) {
                                    if ($value1['p_type'] == 'ASES042 ' && $value1['value_score'] == '99') {
                                ?>
                                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(perkemihan.<?= strtolower($value1['value_info']); ?>)
                                <?php
                                    }
                                } ?>
                            }
                <?php
                        }
                    }
                } ?>
                $("#formPerkemihan" + bodyId).find("input, textarea, select").prop("disabled", true)
                $("#formPerkemihanSaveBtn" + bodyId).slideUp()
                $("#formPerkemihanEditBtn" + bodyId).slideDown()
                checkSign("formPerkemihan" + bodyId)
            }
            index++
            $("#addPerkemihanButton").html('<a onclick="addPerkemihan(1,' + index + ')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        }

        function getPerkemihan(bodyId) {
            $("#bodyPerkemihan").html("")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/getPerkemihan',
                type: "POST",
                data: JSON.stringify({
                    'visit_id': visit,
                    'nomor': nomor,
                    'body_id': bodyId
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    perkemihanAll = data.perkemihan
                    // stabilitasDetail = data.stabilitasDetail

                    $.each(perkemihanAll, function(key, value) {
                        if (value.document_id == $("#arpbody_id").val())
                            addPerkemihan(0, key)
                    })
                },
                error: function() {

                }
            });
        }
</script>

// PSIKOLOGI
<script type="text/javascript">
    function addPsikologi(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = psikologiAll[index].body_id
        }
        $("#bodyPsikologi").append(
            $('<form id="formPsikologi' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Psikologi Spiritual"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES035') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES035' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="row col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                .append($('<h4 class="card-title">Kondisi Pasien</h4>')))
                            .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                .append($('<table class="table table-hover">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'GIZI001') {
                                                                                ?>
                                            .append($('<tr>')
                                                .append($('<td>').html('<div class="form-check"><input name="<?= $value['p_type'] . $value['parameter_id']; ?>" class="form-check-input" type="checkbox" id="val<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '" value="1"><label class="form-check-label" for="val<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '"><?= $value['parameter_desc']; ?></label></div>'))
                                            ) <?php
                                                                                    }
                                                                                } ?>
                                )
                            )
                        )

                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formPsikologiSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formPsikologiEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )


        $("#formPsikologiEditBtn" + bodyId).on("click", function() {
            $("#formPsikologiSaveBtn" + bodyId).slideDown()
            $("#formPsikologiEditBtn" + bodyId).slideUp()
            $("#formPsikologi" + bodyId).find("input, select, textarea").prop("disabled", false)
        })

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES035' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formPsikologi" + bodyId)
            .append('<input name="org_unit_code" id="psikologiorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="psikologivisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="psikologitrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="psikologibody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="psikologidocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="psikologino_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="psikologip_type' + bodyId + '" type="hidden" value="ASES035" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="psikologivalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="psikologivalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="psikologivalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formPsikologi" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/savePsikologi',
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
                    $("#formPsikologiSaveBtn" + bodyId).slideUp()
                    $("#formPsikologiEditBtn" + bodyId).slideDown()
                    $("#formPsikologi" + bodyId).find("input, select, textarea").prop("disabled", true)

                    clicked_submit_btn.button('reset');
                    checkSign("formPsikologi" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formPsikologiSaveBtn" + bodyId).slideDown()
            $("#formPsikologiEditBtn" + bodyId).slideUp()
            $("#formPsikologi" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {

            var maindataset = psikologiAll[index]

            $.each(maindataset, function(key, value) {
                $("#psikologi" + key + bodyId).val(value)
            })
            var psikologi = psikologiAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES035') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(psikologi.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (psikologi.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES035' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(psikologi.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $.each(psikologiDetailAll, function(key, value) {
                if (value.body_id == psikologi.body_id) {
                    $("#val" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                }
            })

            $("#formPsikologiSaveBtn" + bodyId).slideUp()
            $("#formPsikologiEditBtn" + bodyId).slideDown()
            $("#formPsikologi" + bodyId).find("input, select, textarea").prop("disabled", true)
            checkSign("formPsikologi" + bodyId)

        }
        index++
        $("#addPsikologiButton").html('<a onclick="addPsikologi(1,' + index + ')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getPsikologi(bodyId) {
        $("#bodyPsikologi").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPsikologi',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                psikologiAll = data.psikologi
                psikologiDetailAll = data.psikologiDetail

                $.each(psikologiAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addPsikologi(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

// SEKSUAL
<script type="text/javascript">
    function addSeksual(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = seksualAll[index].body_id
        }
        $("#bodySeksual").append(
            $('<form id="formSeksual' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Seksual"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES043') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES043' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formSeksualSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formSeksualEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        $("#formSeksualEditBtn" + bodyId).on("click", function() {
            $("#formSeksualSaveBtn" + bodyId).slideDown()
            $("#formSeksualEditBtn" + bodyId).slideUp()
            $("#formSeksual" + bodyId).find("input, select, textarea").prop("disabled", false)
        })

        $("#ASES04301" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04302" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04303" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04306" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04307" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES043' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formSeksual" + bodyId)
            .append('<input name="org_unit_code" id="seksualorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="seksualvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="seksualtrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="seksualbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="seksualdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="seksualno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="seksualp_type' + bodyId + '" type="hidden" value="ASES043" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="seksualvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="seksualvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="seksualvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formSeksual" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSeksual',
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
                    $("#formSeksualSaveBtn" + bodyId).slideUp()
                    $("#formSeksualEditBtn" + bodyId).slideDown()
                    $("#formSeksual" + bodyId).find("input, select, textarea").prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    checkSign("formSeksual" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formSeksualSaveBtn" + bodyId).slideDown()
            $("#formSeksualEditBtn" + bodyId).slideUp()
            $("#formSeksual" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {
            var maindataset = seksualAll[index]

            $.each(maindataset, function(key, value) {
                $("#seksual" + key + bodyId).val(value)
            })
            var digest = seksualAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES043') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES043' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formSeksualSaveBtn" + bodyId).slideUp()
            $("#formSeksualEditBtn" + bodyId).slideDown()
            $("#formSeksual" + bodyId).find("input, select, textarea").prop("disabled", true)
            checkSign("formSeksual" + bodyId)

        }
        index++
        $("#addSeksualButton").html('<a onclick="addSeksual(1,' + index + ')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getSeksual(bodyId) {
        $("#bodySeksual").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getSeksual',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                seksualAll = data.seksual

                $.each(seksualAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addSeksual(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

// SOCIAL
<script type="text/javascript">
    function addSocial(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = socialAll[index].body_id
        }
        $("#bodySocial").append(
            $('<form id="formSocial' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Social"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES037') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES037' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formSocialSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formSocialEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES037' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').slideUp()
                    }
                });
        <?php
            }
        } ?>
        $("#formSocialEditBtn" + bodyId).on("click", function() {
            $("#formSocialSaveBtn" + bodyId).slideDown()
            $("#formSocialEditBtn" + bodyId).slideUp()
            $("#formSocial" + bodyId).find("input, textarea, select").prop("disabled", false)
        })
        $("#formSocial" + bodyId).append('<input name="org_unit_code" id="socialorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="socialvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="socialtrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="socialbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="socialdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="socialno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="socialp_type' + bodyId + '" type="hidden" value="ASES037" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="socialvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="socialvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="socialvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formSocial" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSocial',
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
                    $("#formSocialSaveBtn" + bodyId).slideUp()
                    $("#formSocialEditBtn" + bodyId).slideDown()
                    $("#formSocial" + bodyId).find("input, textarea, select").prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    checkSign("formSocial" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formSocialSaveBtn" + bodyId).slideDown()
            $("#formSocialEditBtn" + bodyId).slideUp()
            $("#formSocial" + bodyId).find("input, textarea, select").prop("disabled", false)

        } else {
            var maindataset = socialAll[index]

            $.each(maindataset, function(key, value) {
                $("#social" + key + bodyId).val(value)
            })
            var digest = socialAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES037') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES037' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formSocialSaveBtn" + bodyId).slideUp()
            $("#formSocialEditBtn" + bodyId).slideDown()
            $("#formSocial" + bodyId).find("input, textarea, select").prop("disabled", true)
            checkSign("formSocial" + bodyId)
        }
        index++
        $("#addSocialButton").html('<a onclick="addSocial(1,' + index + ')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getSocial(bodyId) {
        $("#bodySocial").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getSocial',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                socialAll = data.social



                $.each(socialAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addSocial(0, key)
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

// HEARING
<script type="text/javascript">
    function addHearing(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = hearingAll[index].body_id
        }
        $("#bodyHearing").append(
            $('<form id="formHearing' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Hearing"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES044') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES044' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formHearingSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formHearingEditBtn' + bodyId + '" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES044' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formHearing" + bodyId).on("click", function() {
            $("#formHearingSaveBtn" + bodyId).slideDown()
            $("#formHearingEditBtn" + bodyId).slideUp()
            $("#formHearing" + bodyId).find("input, textarea, select").prop("disabled", false)
        })

        $("#formHearing" + bodyId).append('<input name="org_unit_code" id="hearingorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="hearingvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="hearingtrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="hearingbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="hearingdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="hearingno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="hearingp_type' + bodyId + '" type="hidden" value="ASES044" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="hearingvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="hearingvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="hearingvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formHearing" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveHearing',
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
                    $('#formHearing' + bodyId + ' select').prop("disabled", true)
                    $('#formHearing' + bodyId + ' input').prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formHearingSaveBtn" + bodyId).slideUp()
                    $("#formHearingEditBtn" + bodyId).slideDown()
                    $("#formHearing" + bodyId).find("input, textarea, select").prop("disabled", true)

                    checkSign("formHearing" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formHearingSaveBtn" + bodyId).slideDown()
            $("#formHearingEditBtn" + bodyId).slideUp()
            $("#formHearing" + bodyId).find("input, textarea, select").prop("disabled", false)
        } else {
            var maindataset = hearingAll[index]

            $.each(maindataset, function(key, value) {
                $("#hearing" + key + bodyId).val(value)
            })
            $("#formHearingSaveBtn" + bodyId).slideUp()
            $("#formHearingEditBtn" + bodyId).slideDown()
            $("#formHearing" + bodyId).find("input, textarea, select").prop("disabled", true)

            var digest = hearingAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES044') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES044' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            checkSign("formHearing" + bodyId)
        }
        index++
        $("#addHearingButton").html('<a onclick="addHearing(1,' + index + ')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getHearing(bodyId) {
        $("#bodyHearing").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getHearing',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                hearingAll = data.hearing

                $.each(hearingAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addHearing(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

// SLEEPING
<script type="text/javascript">
    function addSleeping(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = sleepingAll[index].body_id
        }
        $("#bodySleeping").append(
            $('<form id="formSleeping' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Sleeping"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES046') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES046' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formSleepingSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formSleepingEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES046' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').slideUp()
                    }
                });
        <?php
            }
        } ?>


        $("#ASES04601" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });

        $("#formSleepingEditBtn" + bodyId).on("click", function() {
            $("#formSleepingSaveBtn" + bodyId).slideDown()
            $("#formSleepingEditBtn" + bodyId).slideUp()
            $("#formSleeping" + bodyId).find("input, textarea, select").prop("disabled", false)
        })

        $("#formSleeping" + bodyId).append('<input name="org_unit_code" id="sleepingorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="sleepingvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="sleepingtrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="sleepingbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="sleepingdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="sleepingno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="sleepingp_type' + bodyId + '" type="hidden" value="ASES046" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="sleepingvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="sleepingvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="sleepingvalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formSleeping" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSleeping',
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
                    $('#formSleeping' + bodyId + ' select').prop("disabled", true)
                    $('#formSleeping' + bodyId + ' input').prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formSleepingSaveBtn" + bodyId).slideUp()
                    $("#formSleepingEditBtn" + bodyId).slideDown()
                    $("#formSleeping" + bodyId).find("input, textarea, select").prop("disabled", true)

                    checkSign("formSleeping" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formSleepingSaveBtn" + bodyId).slideDown()
            $("#formSleepingEditBtn" + bodyId).slideUp()
            $("#formSleeping" + bodyId).find("input, textarea, select").prop("disabled", false)

        } else {
            var maindataset = sleepingAll[index]

            $.each(maindataset, function(key, value) {
                $("#sleeping" + key + bodyId).val(value)
            })
            $("#formSleepingSaveBtn" + bodyId).slideUp()
            $("#formSleepingEditBtn" + bodyId).slideDown()
            $("#formSleeping" + bodyId).find("input, textarea, select").prop("disabled", true)

            var sleeping = sleepingAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES046') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(sleeping.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (sleeping.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES046' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            checkSign("formSleeping" + bodyId)

        }
        index++
        $("#addSleepingButton").html('<a onclick="addSleeping(1,' + index + ')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getSleeping(bodyId) {
        $("#bodySleeping").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getSleeping',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                sleepingAll = data.sleeping

                $.each(sleepingAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addSleeping(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

// GIZI
<script type="text/javascript">
    function addGizi(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = giziAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formGizi' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Gizi"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="form-group col-md-12">')
                                .append($('<div class="row">')
                                    .append('<label for="gizimalnutrition_risk' + bodyId + '" class="col-md-4 col-form-label mb-4">Resiko Malnutrisi</label>')
                                    .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="gizimalnutrition_risk' + bodyId + '" name="malnutrition_risk" value="1"></div>')
                                )
                            )
                            .append($('<div class="form-group col-md-12">')
                                .append($('<div class="row">')
                                    .append('<label for="gizinutrition_consult' + bodyId + '" class="col-md-4 col-form-label mb-4">Perlu Konsultasi Gizi</label>')
                                    .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="gizinutrition_consult' + bodyId + '" name="nutrition_consult" value="1"></div>')
                                )
                            )
                            .append($('<div class="form-group col-md-12">')
                                .append($('<div class="row">')
                                    .append('<label for="gizioperation_elder' + bodyId + '" class="col-md-4 col-form-label mb-4">Pasien Operasi >= 65th?</label>')
                                    .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="gizioperation_elder' + bodyId + '" name="operation_elder" value="1"></div>')
                                )
                            )
                            .append($('<div class="form-group col-md-12">')
                                .append($('<div class="row">')
                                    .append('<label for="gizimalnutrition' + bodyId + '" class="col-md-4 col-form-label mb-4">Gangguan Makan</label>')
                                    .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="gizimalnutrition' + bodyId + '" name="malnutrition" value="1"></div>')
                                )
                            )
                        )
                    )
                    .append($('<div id="rowmalnutritiondetail' + bodyId + '" class="mb-3 row" style="display: none">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')


                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="" class="col-form-label mb-4">Masalah yang berhubungan dengan mal nutrisi</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<table class="">') <?php foreach ($aParameter as $key => $value) {
                                                                        if ($value['p_type'] == 'GIZI001') {
                                                                    ?>
                                                .append($('<tr>').append($('<td>').html('<div class="form-check"><input name="<?= $value['p_type'] . $value['parameter_id']; ?>" class="form-check-input" type="checkbox" id="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '" value="1"><label class="form-check-label" for="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '"><?= $value['parameter_desc']; ?></label></div>'))) <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>
                                    )
                                )
                            )

                            .append($('<div class="mb-3 row">')
                                .append('<label class="col-md-4 col-form-label mb-4">Lainnya</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="text" id="valueothers' + bodyId + '" name="others" placeholder=""></div>')
                            )

                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label class="col-form-label mb-4">Masalah makanan</label>')
                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<table class="">') <?php foreach ($aParameter as $key => $value) {
                                                                        if ($value['p_type'] == 'GIZI002') {
                                                                    ?>
                                                .append($('<tr>').append($('<td>').html('<div class="form-check"><input name="<?= $value['p_type'] . $value['parameter_id']; ?>" class="form-check-input" type="checkbox" id="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '" value="1"><label class="form-check-label" for="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '"><?= $value['parameter_desc']; ?></label></div>'))) <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append('<label for="giziGIZI00301' + bodyId + '" class="col-md-4 col-form-label mb-4">Nutrisi melalui NGT</label>')
                                .append('<input name="GIZI00301" class="form-check-input" type="checkbox" id="giziGIZI00301' + bodyId + '" value="1">')
                            )
                            .append($('<div class="mb-3 row">')
                                .append('<label class="col-md-4 col-form-label mb-4">Tanggal pasang</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="datetime-local" id="valueothers' + bodyId + '" name="others" placeholder=""></div>')
                            )
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="giziGIZI004' + bodyId + '" class="col-form-label mb-4">Mukosa mulut / lidah</label>')
                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="GIZI004" id="giziGIZI004' + bodyId + '">') <?php foreach ($aValue as $key => $value) {
                                                                                                                                    if ($value['p_type'] == 'GIZI004' && $value['parameter_id'] == '01') {
                                                                                                                                ?>
                                                .append('<option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>')

                                        <?php
                                                                                                                                    }
                                                                                                                                } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="malnutrition_risk' + bodyId + '" class="col-form-label mb-4">Penyakit</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<table class="">') <?php foreach ($aParameter as $key => $value) {
                                                                        if ($value['p_type'] == 'GIZI005') {
                                                                    ?>
                                                .append($('<tr>').append($('<td>').html('<div class="form-check"><input name="<?= $value['p_type'] . $value['parameter_id']; ?>" class="form-check-input" type="checkbox" id="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '" value="1"><label class="form-check-label" for="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '"><?= $value['parameter_desc']; ?></label></div>'))) <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append('<label id="giziGIZI00601' + bodyId + '" class="col-md-4 col-form-label mb-4">Intake Cairan (Fluid Intake</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="text" id="giziGIZI00601' + bodyId + '" name="GIZI00601" placeholder=""></div>')
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label class="col-form-label mb-4">Gangguan Metabolik</label>')
                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<table class="">') <?php foreach ($aParameter as $key => $value) {
                                                                        if ($value['p_type'] == 'GIZI007') {
                                                                    ?>
                                                .append($('<tr>').append($('<td>').html('<div class="form-check"><input name="<?= $value['p_type'] . $value['parameter_id']; ?>" class="form-check-input" type="checkbox" id="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '" value="1"><label class="form-check-label" for="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '"><?= $value['parameter_desc']; ?></label></div>'))) <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="giziGIZI00801' + bodyId + '" class="col-form-label mb-4">Status Gangguan Metabolik</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="GIZI00801" id="giziGIZI00801' + bodyId + '">') <?php foreach ($aValue as $key => $value) {
                                                                                                                                        if ($value['p_type'] == 'GIZI008' && $value['parameter_id'] == '01') {
                                                                                                                                    ?>
                                                .append('<option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>')

                                        <?php
                                                                                                                                        }
                                                                                                                                    } ?>
                                    )
                                )
                            )
                        )
                    )

                    .append($('<div class="mb-3 row">')
                        .append($('<h4>').html('Skrining Gizi'))
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="giziage_cat' + bodyId + '" class="col-form-label mb-4">Kategori usia</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="age_cat" id="giziage_cat' + bodyId + '">')
                                        .append('<option value="21">Anak 0 - 24 Bulan</option>')
                                        .append('<option value="22">Anak 24 - 60 Bulan</option>')
                                        .append('<option value="23">Anak 5 - 18 tahun</option>')
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append('<label for="giziweight' + bodyId + '" class="col-md-4 col-form-label mb-4">BB</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="number" step=".01" id="giziweight' + bodyId + '" name="weight" placeholder=""></div>')
                            )
                            .append($('<div class="row">')
                                .append('<label for="giziheight' + bodyId + '" class="col-md-4 col-form-label mb-4">TB</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="number" step=".01" id="giziheight' + bodyId + '" name="height" placeholder=""></div>')
                            )
                            .append($('<div class="row">')
                                .append('<label for="gizimt' + bodyId + '" class="col-md-4 col-form-label mb-4">IMT</label>')
                                .append('<div class="col-md-8"><select class="form-control" type="text" id="gizimt' + bodyId + '" name="imt" placeholder="" readonly></select></div>')
                            )
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="gizistep1_score_imt' + bodyId + '" class="col-form-label mb-4">Step 1|Skor IMT</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="step1_score_imt" id="gizistep1_score_imt' + bodyId + '">') <?php foreach ($aValue as $key => $value) {
                                                                                                                                                    if ($value['p_type'] == 'GIZI009' && $value['parameter_id'] == '01') {
                                                                                                                                                ?>
                                                .append('<option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>')

                                        <?php
                                                                                                                                                    }
                                                                                                                                                } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="gizistep2_score_wightloss' + bodyId + '" class="col-form-label mb-4">Step 2|Skor Penurunan BB</label>')
                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="step2_score_wightloss" id="gizistep2_score_wightloss' + bodyId + '">') <?php foreach ($aValue as $key => $value) {
                                                                                                                                                                if ($value['p_type'] == 'GIZI009' && $value['parameter_id'] == '02') {
                                                                                                                                                            ?>
                                                .append('<option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>')

                                        <?php
                                                                                                                                                                }
                                                                                                                                                            } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="gizistep3_score_acute_disease' + bodyId + '" class="col-form-label mb-4">Step 3|Skor Efek Penyakit Akut</label>')
                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="step3_score_acute_disease" id="gizistep3_score_acute_disease' + bodyId + '">') <?php foreach ($aValue as $key => $value) {
                                                                                                                                                                        if ($value['p_type'] == 'GIZI009' && $value['parameter_id'] == '03') {
                                                                                                                                                                    ?>
                                                .append('<option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>')

                                        <?php
                                                                                                                                                                        }
                                                                                                                                                                    } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="gizistep4_score_malnutrition' + bodyId + '" class="col-form-label mb-4">Step 4|Resiko Malnutrisi Keseluruhan</label>')

                                )
                                .append('<div class="col-xs-12 col-sm-8 col-md-8"><input class="form-control" type="number" id="gizistep4_score_malnutrition' + bodyId + '" name="step4_score_malnutrition" placeholder=""></div>')
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="giziscore_desc' + bodyId + '" class="col-form-label mb-4">Step 5|Management Guidelines</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="score_desc" id="giziscore_desc' + bodyId + '">')
                                        .append('<option value="21">Anak 0 - 24 Bulan</option>')
                                        .append('<option value="22">Anak 24 - 60 Bulan</option>')
                                        .append('<option value="23">Anak 5 - 18 tahun</option>')
                                    )
                                )
                            )
                        )
                    )
                    .append($('<div class="mb-3 row">'))
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formGiziSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formGiziEditBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')
                )
            )
        )

        // GIZI011	0.00	18.50	Berat badan kurang (Underweight)
        // GIZI011	18.51	22.90	Berat badan Normal
        // GIZI011	23.00	24.90	Kelebihan berat Badan (Overwight)
        // GIZI011	25.00	29.90	Obesitas I
        // GIZI011	30.00	200.00	Obesitas II
        $("#gizimalnutrition" + bodyId).on("change", function() {
            if ($("#gizimalnutrition" + bodyId).is(":checked")) {
                $("#rowmalnutritiondetail" + bodyId).slideDown()
            } else {
                $("#rowmalnutritiondetail" + bodyId).slideUp()
            }
        })

        $("#giziweight" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $('#giziweight' + bodyId).on("change", function() {
            var w = $('#giziweight' + bodyId).val()
            var h = $('#giziheight' + bodyId).val()
            w = parseFloat(w)
            h = parseFloat(h) / 100
            var imt = w / h / h
            var imtString = checkImt(imt.toFixed(2))
            $("#gizimt" + bodyId).html("");
            $("#gizimt" + bodyId).append('<option value="' + imt + '">' + imtString + '</option>');
            $("#gizimt" + bodyId).val(imt);
            $("#gizistep1_score_imt" + bodyId).val(score1Imt(imt.toFixed(2)))
        })
        $("#giziheight" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $('#giziheight' + bodyId).on("change", function() {
            var w = $('#giziweight' + bodyId).val()
            var h = $('#giziheight' + bodyId).val()
            w = parseFloat(w)
            h = parseFloat(h) / 100
            var imt = w / h / h
            var imtString = checkImt(imt.toFixed(2))
            $("#gizimt" + bodyId).html("");
            $("#gizimt" + bodyId).append('<option value="' + imt + '">' + imtString + '</option>');
            $("#gizimt" + bodyId).val(imt);
            $("#gizistep1_score_imt" + bodyId).val(score1Imt(imt.toFixed(2)))
        })

        $("#formGiziEditBtn" + bodyId).on("click", function() {
            $("#formGiziSaveBtn" + bodyId).slideDown()
            $("#formGiziEditBtn" + bodyId).slideUp()
            $("#formGizi" + bodyId).find("input, textarea, select").prop("disabled", false)
        })

        $("#gizistep1_score_imt" + bodyId).on("change", function() {
            var gizistep1_score_imt = $("#gizistep1_score_imt" + bodyId).val()
            var gizistep2_score_wightloss = $("#gizistep2_score_wightloss" + bodyId).val()
            var gizistep3_score_acute_disease = $("#gizistep3_score_acute_disease" + bodyId).val()

            var totalscore = parseInt(gizistep1_score_imt) + parseInt(gizistep2_score_wightloss) + parseInt(gizistep3_score_acute_disease)

            $("#gizistep4_score_malnutrition" + bodyId).val(totalscore)
            $("#giziscore_desc" + bodyId).val(step5Gizi(totalscore))
        })
        $("#gizistep2_score_wightloss" + bodyId).on("change", function() {

            var gizistep1_score_imt = $("#gizistep1_score_imt" + bodyId).val()
            var gizistep2_score_wightloss = $("#gizistep2_score_wightloss" + bodyId).val()
            var gizistep3_score_acute_disease = $("#gizistep3_score_acute_disease" + bodyId).val()

            var totalscore = parseInt(gizistep1_score_imt) + parseInt(gizistep2_score_wightloss) + parseInt(gizistep3_score_acute_disease)

            $("#gizistep4_score_malnutrition" + bodyId).val(totalscore)
            $("#giziscore_desc" + bodyId).val(step5Gizi(totalscore))
        })
        $("#gizistep3_score_acute_disease" + bodyId).on("change", function() {

            var gizistep1_score_imt = $("#gizistep1_score_imt" + bodyId).val()
            var gizistep2_score_wightloss = $("#gizistep2_score_wightloss" + bodyId).val()
            var gizistep3_score_acute_disease = $("#gizistep3_score_acute_disease" + bodyId).val()

            var totalscore = parseInt(gizistep1_score_imt) + parseInt(gizistep2_score_wightloss) + parseInt(gizistep3_score_acute_disease)

            $("#gizistep4_score_malnutrition" + bodyId).val(totalscore)
            $("#giziscore_desc" + bodyId).val(step5Gizi(totalscore))
        })

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES046' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formGizi" + bodyId).append('<input name="org_unit_code" id="giziorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="gizivisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="gizitrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="gizibody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="gizidocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="gizino_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="thename" id="gizithename' + bodyId + '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress" id="gizitheaddress' + bodyId + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="examination_date" id="giziexamination_date' + bodyId + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="clinic_id" id="giziclinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="employee_id" id="giziemployee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="petugas_id" id="gizipetugas_id' + bodyId + '" type="hidden" value="<?= user()->username; ?>" class="form-control" />')
            .append('<input name="class_room_id" id="giziclass_room_id' + bodyId + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id" id="gizibed_id' + bodyId + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            // .append('<input name="no_registration" id="giziparent_id' + bodyId + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="p_type" id="gizip_type' + bodyId + '" type="hidden" value="ASES046" class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="gizivalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="gizivalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="gizivalid_pasien' + bodyId + '" type="hidden"  />')

        $("#formGizi" + bodyId).on('submit', (function(e) {
            $("#gizidocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveGizi',
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
                    $("#formGiziSaveBtn" + bodyId).slideUp()
                    $("#formGiziEditBtn" + bodyId).slideDown()

                    $('#formGizi' + bodyId + ' select').prop("disabled", true)
                    $('#formGizi' + bodyId + ' input').prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    checkSign("formGizi" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formGiziSaveBtn" + bodyId).slideDown()
            $("#formGiziEditBtn" + bodyId).slideUp()
            $("#formGizi" + bodyId).find("input, textarea, select").prop("disabled", false)
        } else {
            var maindataset = giziAll[index]

            $.each(maindataset, function(key, value) {
                $("#gizi" + key + bodyId).val(value)
            })
            var gizi = giziAll[index];

            if (gizi.malnutrition_risk == 1)
                $("#gizimalnutrition_risk" + bodyId).prop("checked", true)
            if (gizi.nutrition_consult == 1)
                $("#gizinutrition_consult" + bodyId).prop("checked", true)
            if (gizi.operation_elder == 1)
                $("#gizioperation_elder" + bodyId).prop("checked", true)
            if (gizi.malnutrition == 1) {
                $("#gizimalnutrition" + bodyId).prop("checked", true)
                $("#rowmalnutritiondetail" + bodyId).slideDown()
            }
            $("#giziage_cat" + bodyId).val(gizi.age_cat)
            $("#giziweight" + bodyId).val(gizi.weight)
            $("#giziheight" + bodyId).val(gizi.height)
            var imtString = checkImt(parseFloat(gizi.imt).toFixed(2))
            $("#gizimt" + bodyId).html("");
            $("#gizimt" + bodyId).append('<option value="' + gizi.imt + '">' + imtString + '</option>');
            $("#gizimt" + bodyId).val(gizi.imt);
            $("#gizistep1_score_imt" + bodyId).val(gizi.step1_score_imt);
            $("#gizistep2_score_wightloss" + bodyId).val(gizi.step2_score_wightloss);
            $("#gizistep3_score_acute_disease" + bodyId).val(gizi.step3_score_acute_disease);
            var gizistep1_score_imt = $("#gizistep1_score_imt" + bodyId).val()
            var gizistep2_score_wightloss = $("#gizistep2_score_wightloss" + bodyId).val()
            var gizistep3_score_acute_disease = $("#gizistep3_score_acute_disease" + bodyId).val()

            var totalscore = parseInt(gizistep1_score_imt) + parseInt(gizistep2_score_wightloss) + parseInt(gizistep3_score_acute_disease)

            $("#gizistep4_score_malnutrition" + bodyId).val(totalscore)
            $("#giziscore_desc" + bodyId).val(step5Gizi(totalscore))

            $.each(giziDetailAll, function(key, value) {
                if (value.body_id == bodyId) {
                    if (value.p_type == 'GIZI001' && value.value_score == 1) {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI002' && value.value_score == 1) {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI003' && value.value_score == 1) {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI004') {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).val(value.value_score)
                    }
                    if (value.p_type == 'GIZI005') {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI006' && value.value_score == 1) {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI007' && value.value_score == 1) {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI008') {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).val(value.value_score)
                    }
                }
                // if (value.p_type == 'GIZI006' && value.value_score == 1) {
                //     $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                // }
            })
            $("#formGiziSaveBtn" + bodyId).slideUp()
            $("#formGiziEditBtn" + bodyId).slideDown()
            $("#formGizi" + bodyId).find("input, textarea, select").prop("disabled", true)
            checkSign("formGizi" + bodyId)
        }
        index++
        $("#addGiziButton").html('<a onclick="addGizi(1,' + index + ',\'' + document_id + '\', \'' + container + '\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function checkImt(score) {
        // GIZI011	0.00	18.50	Berat badan kurang (Underweight)
        // GIZI011	18.51	22.90	Berat badan Normal
        // GIZI011	23.00	24.90	Kelebihan berat Badan (Overwight)
        // GIZI011	25.00	29.90	Obesitas I
        // GIZI011	30.00	200.00	Obesitas II
        if (score <= 18.5) {
            return score + 'Berat badan kurang (Underweight)'
        } else if (score > 18.5 && score <= 22.9) {
            return score + ' Berat badan Normal'
        } else if (score > 22.9 && score <= 24.9) {
            return score + ' Kelebihan berat Badan (overWeight)'
        } else if (score > 24.9 && score <= 29.9) {
            return score + ' Obesitas I'
        } else {
            return score + ' Obesitas II'
        }
    }

    function score1Imt(score) {
        if (score <= 18.5) {
            return '2'
        } else if (score > 18.5 && score <= 20) {
            return '1'
        } else if (score > 20) {
            return '0'
        }
    }

    function step5Gizi(score) {
        if (score <= 1) {
            return 'Resiko Rendah (Low Risk) - Routine Clinical Care'
        } else if (score > 1 && score <= 2) {
            return 'Resiko sedang (Medium Risk) - Observe'
        } else if (score > 2) {
            return 'Resiko Tinggi (High Risk) - Treat'
        }
    }

    function getGizi(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getGizi',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                giziAll = data.gizi
                giziDetailAll = data.giziDetail

                $.each(giziAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyGiziPerawat").html("")
                        addGizi(0, key, "arpbody_id", "bodyGiziPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyGiziMedis").html("")
                        addGizi(0, key, "armpasien_diagnosa_id", "bodyGiziMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

// EDUCATION FORM
<script type="text/javascript">
    function addEducationForm(flag, index, document_id, container, isaddbutton = true) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = educationFormAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formEducationForm' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Education Form"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-12 col-md-12">') <?php foreach ($aParameter as $key => $value) {
                                                                                        if ($value['p_type'] == 'GEN0013') {
                                                                                    ?> <?php if ($value['entry_type'] == 1) {
                                                                                        ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                            } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                    if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                    }
                                                                                                } ?>
                                        ) <?php
                                                                                            } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                    if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                            } else if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-12 mb-4"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                        ) <?php
                                                                                            }
                                            ?> <?php }
                                                                                        if ($value['parameter_id'] == '09') {
                                                                                            break;
                                                                                        }
                                                                                    }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6" style="display: none">') <?php foreach ($aParameter as $key => $value) {
                                                                                                            if ($value['p_type'] == 'GEN0013' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                                        ?> <?php if ($value['entry_type'] == 1) {
                                                                                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                                                } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                                        if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                                        }
                                                                                                                    } ?>
                                        ) <?php
                                                                                                                } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                                        if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                                                }
                                            ?> <?php }
                                                                                                        }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formEducationFormSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formEducationFormEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formEducationFormCetakBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light"><i class="fa fa-file"></i> <span>Cetak</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aParameter as $key => $value) {
            if ($value['p_type'] == 'GEN0013') {
        ?> <?php if ($value['entry_type'] == 4) {
            ?>
                    // console.log("#<?= $value['p_type'] . $value['parameter_id'] ?>" + bodyId)
                    // tinymce.init({
                    //     selector: "#<?= $value['p_type'] . $value['parameter_id'] ?>" + bodyId,
                    //     height: 300,
                    //     plugins: [
                    //         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    //         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    //         "save table contextmenu directionality emoticons template paste textcolor",
                    //     ],
                    //     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    //     style_formats: [{
                    //             title: "Bold text",
                    //             inline: "b"
                    //         },
                    //         {
                    //             title: "Red text",
                    //             inline: "span",
                    //             styles: {
                    //                 color: "#ff0000"
                    //             }
                    //         },
                    //         {
                    //             title: "Red header",
                    //             block: "h1",
                    //             styles: {
                    //                 color: "#ff0000"
                    //             }
                    //         },
                    //         {
                    //             title: "Example 1",
                    //             inline: "span",
                    //             classes: "example1"
                    //         },
                    //         {
                    //             title: "Example 2",
                    //             inline: "span",
                    //             classes: "example2"
                    //         },
                    //         {
                    //             title: "Table styles"
                    //         },
                    //         {
                    //             title: "Table row 1",
                    //             selector: "tr",
                    //             classes: "tablerow1"
                    //         },
                    //     ],
                    // });
        <?php }
            }
        } ?>

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'GEN0013 ' && $value1['value_score'] == '99') {
        ?> $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formEducationForm" + bodyId).append('<input name="org_unit_code" id="educationformsorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>"  />')
            .append('<input name="visit_id" id="educationformsvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>"  />')
            .append('<input name="trans_id" id="educationformstrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>"  />')
            .append('<input name="body_id" id="educationformsbody_id' + bodyId + '" type="hidden" value="' + bodyId + '"  />')
            .append('<input name="document_id" id="educationformsdocument_id' + bodyId + '" type="hidden" value="' + documentId + '"  />')
            .append('<input name="no_registration" id="educationformsno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>"  />')
            .append('<input name="p_type" id="educationformsp_type' + bodyId + '" type="hidden" value="GEN0013 "  />')
            .append('<input name="valid_date" class="valid_date" id="educationformsvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="educationformsvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="educationformsvalid_pasien' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_date" class="valid_date" id="educationformsvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="educationformsvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="educationformsvalid_pasien' + bodyId + '" type="hidden"  />')


        $("#formEducationForm" + bodyId).on('submit', (function(e) {
            tinyMCE.triggerSave();
            setTimeout(function() {}, 1)
            $("#EducationFormsdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveEducationForm',
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
                    $('#formEducationForm' + bodyId + ' select').prop("disabled", true)
                    $('#formEducationForm' + bodyId + ' input').prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formEducationFormSaveBtn" + bodyId).slideUp()
                    $("#formEducationFormEditBtn" + bodyId).slideDown()
                    $("#formEducationForm" + bodyId).find("input, textarea, select").prop("disabled", true)

                    checkSign("formEducationForm" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));



        $("#formEducationFormEditBtn" + bodyId).on("click", function() {
            $("#formEducationFormSaveBtn" + bodyId).slideDown()
            $("#formEducationFormEditBtn" + bodyId).slideUp()
            $("#formEducationForm" + bodyId).find("input, textarea, select").prop("disabled", false)
        })
        $("#formEducationFormCetakBtn" + bodyId).on("click", function() {
            var win = window.open('<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>', '_blank');
        })


        if (flag == 1) {
            $("#formEducationFormSaveBtn" + bodyId).slideDown()
            $("#formEducationFormEditBtn" + bodyId).slideUp()
            $("#formEducationForm" + bodyId).find("input, textarea, select").prop("disabled", false)

            tinymce.init({
                selector: "#GEN001302" + bodyId,
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor",
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [{
                        title: "Bold text",
                        inline: "b"
                    },
                    {
                        title: "Red text",
                        inline: "span",
                        styles: {
                            color: "#ff0000"
                        }
                    },
                    {
                        title: "Red header",
                        block: "h1",
                        styles: {
                            color: "#ff0000"
                        }
                    },
                    {
                        title: "Example 1",
                        inline: "span",
                        classes: "example1"
                    },
                    {
                        title: "Example 2",
                        inline: "span",
                        classes: "example2"
                    },
                    {
                        title: "Table styles"
                    },
                    {
                        title: "Table row 1",
                        selector: "tr",
                        classes: "tablerow1"
                    },
                ],
            });
        } else {

            var maindataset = educationFormAll[index]

            $.each(maindataset, function(key, value) {
                $("#educationforms" + key + bodyId).val(value)
            })
            var EducationForm = educationFormAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'GEN0013') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(EducationForm.<?= strtolower($value['column_name']); ?>)
                        <?php if ($value['entry_type'] == 4) {
                        ?>
                            setTimeout(function() {
                                tinymce.init({
                                    selector: "#GEN001302" + bodyId,
                                    height: 300,
                                    plugins: [
                                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                        "save table contextmenu directionality emoticons template paste textcolor",
                                    ],
                                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                                    style_formats: [{
                                            title: "Bold text",
                                            inline: "b"
                                        },
                                        {
                                            title: "Red text",
                                            inline: "span",
                                            styles: {
                                                color: "#ff0000"
                                            }
                                        },
                                        {
                                            title: "Red header",
                                            block: "h1",
                                            styles: {
                                                color: "#ff0000"
                                            }
                                        },
                                        {
                                            title: "Example 1",
                                            inline: "span",
                                            classes: "example1"
                                        },
                                        {
                                            title: "Example 2",
                                            inline: "span",
                                            classes: "example2"
                                        },
                                        {
                                            title: "Table styles"
                                        },
                                        {
                                            title: "Table row 1",
                                            selector: "tr",
                                            classes: "tablerow1"
                                        },
                                    ],
                                });

                                $("#GEN001302" + bodyId)
                            }, 2000);
                        <?php
                        } ?>
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (EducationForm.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'GEN0013 ' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(EducationForm.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formEducationFormSaveBtn" + bodyId).slideUp()
            $("#formEducationFormEditBtn" + bodyId).slideDown()
            $("#formEducationForm" + bodyId).find("input, select, textarea").prop("disabled", true)

            checkSign("formEducationForm" + bodyId)
        }
        index++
        if (isaddbutton) {
            $("#addEducationFormButton").html('<a onclick="addEducationForm(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        } else {
            $("#" + container + "AddBtn").html("")
        }
    }

    function getEducationForm(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getEducationForm',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                educationFormAll = data.educationForm
                // stabilitasDetail = data.stabilitasDetail

                $.each(educationFormAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyEducationFormPerawat").html("")
                        addEducationForm(0, key, "arpbody_id", "bodyEducationFormPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyEducationFormMedis").html("")
                        addEducationForm(0, key, "armpasien_diagnosa_id", "bodyEducationFormMedis", false)
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

// EDUCATION INTEGRATION
<script type="text/javascript">
    function addEducationIntegration(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = educationIntegrationAll[index].body_id
        }
        <?php
        $ptype = 'ASES049';
        ?>
        $("#bodyEducationIntegration").append(
            $('<form id="formEducationIntegration' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("EducationIntegration"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == $ptype) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="049<?= $value['parameter_id'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>'
                                                .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                            )) <?php
                                                                                        } else if ($value['entry_type'] == 5) {
                                                                                        } else if ($value['entry_type'] == 6) {
                                                ?>
                                        .append($('<div class="row">')
                                            .append($('<div class="col-md-4">')
                                                .append($('<h5 class="font-size-14 mb-4"><?= $value['parameter_desc']; ?></h5>'))
                                            )
                                            .append($('<div class="col-md-8">') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                ?>
                                                        .append($('<div class="form-check mb-3">' +
                                                            '<input id="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '" class="form-check-input" type="checkbox" name="<?= $value1['value_info']; ?>" value="<?= $value1['value_score']; ?>">>' +
                                                            '<label class="form-check-label" for="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '">' +
                                                            '<?= $value1['value_desc']; ?>' +
                                                            '</label>' +
                                                            '</div>')) <?php
                                                                                                }
                                                                                            } ?>
                                            )
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 7) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append($('<div class="col-md-4">')
                                                .append($('<h5 class="font-size-14 mb-4"><?= $value['parameter_desc']; ?></h5>'))
                                            )
                                            .append($('<div class="col-md-8">') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                ?>
                                                        .append($('<div class="form-check mb-3">' +
                                                            '<input id="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '" class="form-check-input" type="radio" name="<?= $value1['value_info']; ?>" value="<?= $value1['value_score']; ?>">>' +
                                                            '<label class="form-check-label" for="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '">' +
                                                            '<?= $value1['value_desc']; ?>' +
                                                            '</label>' +
                                                            '</div>')) <?php
                                                                                                }
                                                                                            } ?>
                                            )
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                            if ($value['parameter_id'] == '09') {
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == $ptype  && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>'
                                                .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                            )) <?php
                                                                                        } else if ($value['entry_type'] == 5) {
                                                                                        } else if ($value['entry_type'] == 6) {
                                                ?>
                                        .append($('<div class="row">')
                                            .append($('<div class="col-md-4">')
                                                .append($('<h5 class="font-size-14 mb-4"><?= $value['parameter_desc']; ?></h5>'))
                                            )
                                            .append($('<div class="col-md-8">') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                ?>
                                                        .append($('<div class="form-check mb-3">' +
                                                            '<input id="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '" class="form-check-input" type="checkbox" name="<?= $value1['value_info']; ?>" value="<?= $value1['value_score']; ?>">>' +
                                                            '<label class="form-check-label" for="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '">' +
                                                            '<?= $value1['value_desc']; ?>' +
                                                            '</label>' +
                                                            '</div>')) <?php
                                                                                                }
                                                                                            } ?>
                                            )
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 7) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append($('<div class="col-md-4">')
                                                .append($('<h5 class="font-size-14 mb-4"><?= $value['parameter_desc']; ?></h5>'))
                                            )
                                            .append($('<div class="col-md-8">') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                ?>
                                                        .append($('<div class="form-check mb-3">' +
                                                            '<input id="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '" class="form-check-input" type="radio" name="<?= $value1['value_info']; ?>" value="<?= $value1['value_score']; ?>">' +
                                                            '<label class="form-check-label" for="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '">' +
                                                            '<?= $value1['value_desc']; ?>' +
                                                            '</label>' +
                                                            '</div>')) <?php
                                                                                                }
                                                                                            } ?>
                                            )
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                        }
                                                                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-12 col-md-12">')
                            .append($('<h5>Bahasa Sehari-hari</h5>'))
                            .append($('<table id="educationIntegrationLanguage' + bodyId + '" class="table table-striped">')
                                .append($('<thead>')
                                    .append($('<tr>')
                                        .append('<th width="50">Bahasa</th><th width="50">Status</th>')
                                    )
                                )
                                .append($('<tbody id="educationIntegrationLanguageBody' + bodyId + '">'))
                            )
                            .append($('<div class="col-md-12">' +
                                '<div class="box-tab-tools text-center"><a onclick="addEducationIntegrationLanguage(\'' + bodyId + '\')" class="btn btn-info btn-sm"  style="width: 200px"><i class=" fa fa-plus"></i> Tambah Dokumen</a></div>' +
                                '</div>)'))
                        )
                        .append($('<div class="col-xs-12 col-sm-12 col-md-12">')
                            .append($('<h5>Perencanaan Edukasi</h5>'))
                            .append($('<table id="educationIntegrationLanguagePlan' + bodyId + '" class="table table-striped">')
                                .append($('<thead>')
                                    .append($('<tr>')
                                        .append('<th width="50">Kebutuhan Edukasi</th>')
                                        .append('<th width="50">Pemberian Edukasi</th>')
                                        .append('<th width="50">Tanggal/Jam Edukasi</th>')
                                        .append('<th width="50">Sasaran Edukasi</th>')
                                        .append('<th width="50">Metode Edukasi</th>')
                                        .append('<th width="50">Metode Evaluasi</th>')
                                    )
                                )
                                .append($('<tbody id="educationIntegrationLanguagePlanBody' + bodyId + '">'))
                            )
                            .append($('<div class="col-md-12">' +
                                '<div class="box-tab-tools text-center"><a onclick="addEducationIntegrationPlan(\'' + bodyId + '\')" class="btn btn-info btn-sm"  style="width: 200px"><i class=" fa fa-plus"></i> Tambah</a></div>' +
                                '</div>)'))
                        )
                        .append($('<div class="col-xs-12 col-sm-12 col-md-12">')
                            .append($('<h5>Daftar Pemberian Edukasi</h5>'))
                            .append($('<table id="educationIntegrationLanguageProvision' + bodyId + '" class="table table-striped">')
                                .append($('<thead>')
                                    .append($('<tr>')
                                        .append('<th width="50">Judul Edukasi</th>')
                                        .append('<th width="50">Tanggal/jam Edukasi</th>')
                                        .append('<th width="50">Tingkat Pemahaman Awal</th>')
                                        .append('<th width="50">Assessmen Ulang</th>')
                                        .append('<th width="50">Evaluasi/Verifikasi</th>')
                                        .append('<th width="50">Staff Name</th>')
                                    )
                                )
                                .append($('<tbody id="educationIntegrationLanguageProvisionBody' + bodyId + '">'))
                            )
                            .append($('<div class="col-md-12">' +
                                '<div class="box-tab-tools text-center"><a onclick="addEducationIntegrationProvision(\'' + bodyId + '\')" class="btn btn-info btn-sm"  style="width: 200px"><i class=" fa fa-plus"></i> Tambah</a></div>' +
                                '</div>)'))
                        )
                        .append('<div class="panel-footer text-end mb-4">' +
                            '<button type="submit" id="formEducationIntegrationSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                            '<button style="margin-right: 10px" type="button" id="formEducationIntegrationEditBtn' + bodyId + '" onclick="" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                            '<button style="margin-right: 10px" type="button" id="formEducationIntegrationCetakBtn' + bodyId + '" onclick="" name="cetak" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light btn-edit"><i class="fa fa-file"></i> <span>Cetak</span></button>' +
                            '</div>')

                    )
                )
            )
        )


        $("#formEducationIntegrationEditBtn" + bodyId).on("click", function() {
            $("#formEducationIntegrationSaveBtn" + bodyId).slideDown()
            $("#formEducationIntegrationEditBtn" + bodyId).slideUp()
            $("#formEducationIntegration" + bodyId).find("input, select, textarea").prop("disabled", false)
        })
        $("#formEducationIntegrationCetakBtn" + bodyId).on("click", function() {
            var win = window.open('<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>' + '/' + bodyId, '_blank');
        })
        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == $ptype && $value1['value_score'] == '99') {
        ?> $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formEducationIntegration" + bodyId).append('<input name="org_unit_code" id="educationintegrationsorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="educationintegraitonvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="educationintegraitontrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="educationintegraitonbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="educationintegraitondocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="educationintegraitonno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="educationintegraitonp_type' + bodyId + '" type="hidden" value="<?= $ptype; ?>" class="form-control" />')
            .append('<input name="examination_date" id="educationintegraitonexamination_date' + bodyId + '" type="hidden" value="' + get_date() + ' " class="form-control" />')
            .append('<input name="valid_date" class="valid_date" id="educationintegraitonvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="educationintegraitonvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="educationintegraitonvalid_pasien' + bodyId + '" type="hidden"  />')


        $("#formEducationIntegration" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveEducationIntegration',
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

                    $("#formEducationIntegrationSaveBtn" + bodyId).slideUp()
                    $("#formEducationIntegrationEditBtn" + bodyId).slideDown()
                    $("#formEducationIntegration" + bodyId).find("input, select, textarea").prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    checkSign("formEducationIntegration" + bodyId)

                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formEducationIntegrationSaveBtn" + bodyId).slideDown()
            $("#formEducationIntegrationEditBtn" + bodyId).slideUp()
            $("#formEducationIntegration" + bodyId).find("input, select, textarea").prop("disabled", false)

        } else {
            var eduInt = educationIntegrationAll[index];

            $.each(eduInt, function(key, value) {
                $("#educationintegraiton" + key + bodyId).val(value)
            })
            $.each(educationIntegrationDetailAll, function(key, value) {
                if (value.body_id == eduInt.body_id) {
                    if (value.p_type == 'ASES049') {
                        <?php foreach ($aParameter as $key => $value) {
                            if ($value['p_type'] == $ptype) {
                                if ($value['entry_type'] == 3) {
                        ?>
                                    if (value.parameter_id == '<?= $value['parameter_id']; ?>')
                                        $("#" + value.p_type + value.parameter_id + bodyId).val(value.value_score)
                                    <?php
                                }
                                if ($value['entry_type'] == 6) {
                                    foreach ($aValue as $key1 => $value1) {
                                        if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                    ?>
                                            if (value.parameter_id == '<?= $value['parameter_id']; ?>' && value.value_id == <?= $value1['value_id']; ?>)
                                                $("#educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>" + bodyId).prop("checked", true)
                                        <?php
                                        }
                                    }
                                }
                                if ($value['entry_type'] == 7) {
                                    foreach ($aValue as $key1 => $value1) {
                                        if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                        ?>
                                            if (value.parameter_id == '<?= $value['parameter_id']; ?>' && value.value_id == <?= $value1['value_id']; ?>)
                                                $("#educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>" + bodyId).prop("checked", true)
                        <?php
                                        }
                                    }
                                }
                            }
                        } ?>
                    } else if (value.p_type == 'GEN0014') {
                        addEducationIntegrationLanguage(bodyId, value.parameter_id, value.value_desc)
                    }
                }
            })
            $.each(educationIntegrationPlanAll, function(key, value) {
                if (value.body_id == eduInt.body_id) {
                    addRowEducationIntegrationPlan(value)
                }
            })
            $.each(educationIntegrationProvisionAll, function(key, value) {
                if (value.body_id == eduInt.body_id) {
                    addRowEducationIntegrationProvision(value)
                }
            })
            $("#formEducationIntegrationSaveBtn" + bodyId).slideUp()
            $("#formEducationIntegrationEditBtn" + bodyId).slideDown()
            $("#formEducationIntegration" + bodyId).find("input, select, textarea").prop("disabled", true)

            checkSign("formEducationIntegration" + bodyId)
        }
        index++
        $("#addEducationIntegrationButton").html('<a onclick="addEducationIntegration(1,' + index + ')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function addEducationIntegrationLanguage(bodyId, language, isactive) {
        var rowcount = $("#educationIntegrationLanguageBody tr").length + 1;
        $("#educationIntegrationLanguageBody" + bodyId).append($('<tr>')
            .append($('<td>')
                .append($('<select id="GEN0014Bahasa' + bodyId + rowcount + '" name="GEN0014Bahasa[]" class="form-control">') <?php foreach ($aParameter as $key => $value) {
                                                                                                                                    if ($value['p_type'] == 'GEN0014')
                                                                                                                                        echo '.append(\'<option value="' . $value['parameter_id'] . '">' . $value['parameter_desc'] . '</option>\')';
                                                                                                                                } ?>)
            )
            .append($('<td>')
                .append($('<select id="GEN0014Aktif' + bodyId + rowcount + '" name="GEN0014Aktif[]" class="form-control">')
                    .append($('<option value="1">Aktif</option>'))
                    .append($('<option value="0">Pasif</option>'))
                )
            )
        )
        $("#GEN0014Bahasa" + bodyId + rowcount).val(language)
        $("#GEN0014Aktif" + bodyId + rowcount).val(isactive)
    }

    function addEducationIntegrationPlan(bodyId, flag) {
        $("#addEducationListPlan").modal('show')
        $("#eduplanbody_id").val(bodyId)
        $("#eduplanp_type").val('<?= $ptype; ?>')
        var lng = $("#educationIntegrationLanguagePlanBody" + bodyId + " tr").length + 1
        $("#eduplanplan_ke").val(lng)
    }

    function addRowEducationIntegrationPlan(value) {
        var edutreatment_type = [
            '',
            'Pengertian penyakit',
            'Gizi',
            'Farmasi',
            'Rehabilitasi Medik',
            'Nyeri dan Manajemen Nyeri',
            'Pencegahan dan Pengendalian Infeksi',
            'Pelayanan Saat Pelayanan di RS'
        ]
        var edueducation_provision = [
            '', 'Perawat', 'Dokter', 'Ahli Gizi', 'Terapis', 'Bidan', 'Lain-lain'
        ]
        var edueducation_target = [
            '', 'Pasien', 'Dokter', 'Ahli Gizi'
        ]
        var edueducation_method = [
            '', 'Leaflet', 'Demonstrasi', 'Wawancara'
        ]
        $("#educationIntegrationLanguagePlanBody" + value.body_id)
            .append($('<tr>')
                .append($('<td>').html(edutreatment_type[value.treatment_type]))
                .append($('<td>').html(edueducation_provision[value.education_provision]))
                .append($('<td>').html(value.examination_date))
                .append($('<td>').html(edueducation_target[value.education_target]))
                .append($('<td>').html(edueducation_method[value.education_method]))
                .append($('<td>').html(value.education_evaluation))
            )
    }

    function addEducationIntegrationProvision(bodyId, flag) {
        $("#addEducationListProvision").modal('show')
        $("#eduprovbody_id").val(bodyId)
        $("#eduprovp_type").val('<?= $ptype; ?>')
        var lng = $("#educationIntegrationLanguageProvisionBody" + bodyId + " tr").length + 1
        $("#eduprovprovision_ke").val(lng)
    }

    function addRowEducationIntegrationProvision(value) {
        var edutreatment_type = [
            '',
            'Pengertian penyakit',
            'Gizi',
            'Farmasi',
            'Rehabilitasi Medik',
            'Nyeri dan Manajemen Nyeri',
            'Pencegahan dan Pengendalian Infeksi',
            'Pelayanan Saat Pelayanan di RS'
        ]
        var edueducation_provision = [
            '', 'Perawat', 'Dokter', 'Ahli Gizi', 'Terapis', 'Bidan', 'Lain-lain'
        ]
        var edueducation_target = [
            '', 'Pasien', 'Dokter', 'Ahli Gizi'
        ]
        var edueducation_method = [
            '', 'Leaflet', 'Demonstrasi', 'Wawancara'
        ]
        var eduunderstanding_level = [
            '', 'Sudah Mengerti', 'Edukasi Ulang', 'Hal Baru'
        ]
        var eduevaluation = [
            '', 'Sudah Mengerti', 'Re-Edukasi', 'Re-Demo'
        ]

        if (value.re_assessment == '1') {
            var reas = 'Ya'
        } else {
            var reas = 'Tidak'
        }
        $("#educationIntegrationLanguageProvisionBody" + value.body_id)
            .append($('<tr>')
                .append($('<td>').html(edutreatment_type[value.treatment_type]))
                .append($('<td>').html(value.examination_date))
                .append($('<td>').html(eduunderstanding_level[value.understanding_level]))
                .append($('<td>').html(reas))
                .append($('<td>').html(eduevaluation[value.evaluation]))
                .append($('<td>').html(value.modified_by))
            )
    }

    function saveEducationIntegrationPlan() {
        let clicked_submit_btn = $("#formEducationIntegrationPlanBtn");
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveEducationIntegrationPlan',
            type: "POST",
            data: new FormData(document.getElementById("formEducationIntegrationPlan")),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                $("#addEducationListPlan").modal('hide')
                educationIntegrationPlanAll.push(data)

                $("#educationIntegrationLanguagePlanBody" + $("#eduplanbody_id").val()).html("")
                $.each(educationIntegrationPlanAll, function(key, value) {
                    addRowEducationIntegrationPlan(value)
                })

                clicked_submit_btn.button('reset');
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
                errorMsg(xhr);
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }

    function saveEducationIntegrationProvision() {
        let clicked_submit_btn = $("#formEducationIntegrationProvisionBtn");
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveEducationIntegrationProvision',
            type: "POST",
            data: new FormData(document.getElementById("formEducationIntegrationProvision")),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                $("#addEducationListProvision").modal('hide')
                educationIntegrationProvisionAll.push(data)

                $("#educationIntegrationLanguageProvisionBody" + $("#eduprovisionbody_id").val()).html("")
                $.each(educationIntegrationProvisionAll, function(key, value) {
                    addRowEducationIntegrationProvision(value)
                })

                clicked_submit_btn.button('reset');

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
                errorMsg(xhr);
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }

    function getEducationIntegration(bodyId) {
        $("#bodyEducationIntegration").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getEducationIntegration',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                educationIntegrationAll = data.educationIntegration
                educationIntegrationDetailAll = data.educationIntegrationDetail
                educationIntegrationPlanAll = data.educationPlan
                educationIntegrationProvisionAll = data.educationProvision
                // stabilitasDetail = data.stabilitasDetail

                $.each(educationIntegrationAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addEducationIntegration(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

// GCS
<script type="text/javascript">
    const addGcs = async (flag, index, document_id, container, isaddbutton = true) => {
        var bodyId = '';
        var documentId = $("#" + document_id).val()
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = gcsAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formGcs' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("GCS"))
                    .append(`<div class="row mb-4">
                            <div class="col-md-3">
                                <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Tanggal:</h5>
                            </div>
                            <div class="col-md-9">
                                <input id="flatgcsexamination_date` + bodyId + `" type="text" class="form-control">
                                <input id="gcsexamination_date` + bodyId + `" name="examination_date" type="hidden">
                            </div>
                        </div>`)
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'GEN0011') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?> <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                                ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option value="0">-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                            ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>">[<?= $value1['value_score']; ?>] <?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                                                            }
                                                                                                                                                                                        } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="row">')
                                .append('<label class="col-md-4 col-form-label mb-4">Score</label>')
                                .append($('<div class="col-md-8">')
                                    .append($('<input type="text" id="GCS_SCORE' + bodyId + '" name="GCS_SCORE" class="form-control" readonly>'))
                                )
                            )
                            .append($('<div class="row">')
                                .append('<label class="col-md-4 col-form-label mb-4">Kesimpulan</label>')
                                .append($('<div class="col-md-8">')
                                    .append($('<select id="GCS_DESC' + bodyId + '" name="GCS_DESC" class="form-control" readonly>')
                                        .append('<option>-</option>')
                                        .append('<option value="1">Composmentis</option>')
                                        .append('<option value="2">Apatis</option>')
                                        .append('<option value="3">Delirium</option>')
                                        .append('<option value="4">Samnolen</option>')
                                        .append('<option value="5">Sopor</option>')
                                        .append('<option value="6">Coma</option>')
                                    )
                                )
                            )
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formGcsSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary btn-save"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formGcsEditBtn' + bodyId + '" onclick="" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary btn-edit"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formGcsSignBtn' + bodyId + '" onclick="" name="sign" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning btn-sign"><i class="fa fa-signature"></i> <span>Sign</span></button>' +
                        '</div>')

                )
            )
        )

        datetimepickerbyid("flatgcsexamination_date" + bodyId)

        $("#GEN001101" + bodyId).on("change", function() {
            var e = ($("#GEN001101" + bodyId).val() === null) ? 0 : $("#GEN001101" + bodyId).val();
            var m = ($("#GEN001102" + bodyId).val() === null) ? 0 : $("#GEN001102" + bodyId).val();
            var v = ($("#GEN001103" + bodyId).val() === null) ? 0 : $("#GEN001103" + bodyId).val();

            var totalScore = parseInt(e) + parseInt(m) + parseInt(v)
            var conclutionScore = 0
            if (totalScore >= 3 && totalScore <= 4)
                conclutionScore = 6
            if (totalScore > 4 && totalScore <= 6)
                conclutionScore = 5
            if (totalScore > 6 && totalScore <= 9)
                conclutionScore = 4
            if (totalScore > 9 && totalScore <= 11)
                conclutionScore = 3
            if (totalScore > 11 && totalScore <= 13)
                conclutionScore = 2
            if (totalScore > 13 && totalScore <= 15)
                conclutionScore = 1



            $('#GCS_SCORE' + bodyId).val(totalScore)
            $('#GCS_DESC' + bodyId).val(conclutionScore)
        })
        $("#GEN001102" + bodyId).on("change", function() {
            var e = ($("#GEN001101" + bodyId).val() === null) ? 0 : $("#GEN001101" + bodyId).val();
            var m = ($("#GEN001102" + bodyId).val() === null) ? 0 : $("#GEN001102" + bodyId).val();
            var v = ($("#GEN001103" + bodyId).val() === null) ? 0 : $("#GEN001103" + bodyId).val();

            var totalScore = parseInt(e) + parseInt(m) + parseInt(v)
            var conclutionScore = 0
            if (totalScore >= 3 && totalScore <= 4)
                conclutionScore = 6
            if (totalScore > 4 && totalScore <= 6)
                conclutionScore = 5
            if (totalScore > 6 && totalScore <= 9)
                conclutionScore = 4
            if (totalScore > 9 && totalScore <= 11)
                conclutionScore = 3
            if (totalScore > 11 && totalScore <= 13)
                conclutionScore = 2
            if (totalScore > 13 && totalScore <= 15)
                conclutionScore = 1


            $('#GCS_SCORE' + bodyId).val(totalScore)
            $('#GCS_DESC' + bodyId).val(conclutionScore)
        })
        $("#GEN001103" + bodyId).on("change", function() {
            var e = ($("#GEN001101" + bodyId).val() === null) ? 0 : $("#GEN001101" + bodyId).val();
            var m = ($("#GEN001102" + bodyId).val() === null) ? 0 : $("#GEN001102" + bodyId).val();
            var v = ($("#GEN001103" + bodyId).val() === null) ? 0 : $("#GEN001103" + bodyId).val();

            var totalScore = parseInt(e) + parseInt(m) + parseInt(v)
            var conclutionScore = 0
            if (totalScore >= 3 && totalScore <= 4)
                conclutionScore = 6
            if (totalScore > 4 && totalScore <= 6)
                conclutionScore = 5
            if (totalScore > 6 && totalScore <= 9)
                conclutionScore = 4
            if (totalScore > 9 && totalScore <= 11)
                conclutionScore = 3
            if (totalScore > 11 && totalScore <= 13)
                conclutionScore = 2
            if (totalScore > 13 && totalScore <= 15)
                conclutionScore = 1


            $('#GCS_SCORE' + bodyId).val(totalScore)
            $('#GCS_DESC' + bodyId).val(conclutionScore)
        })

        $("#formGcsSignBtn" + bodyId).on("click", function() {
            addSignUserSatelite("formGcs" + bodyId, "gcs", bodyId, "gcsbody_id" + bodyId, "formGcsSaveBtn" + bodyId, 6, 1, 1, "GCS")
        })
        $("#formGcsEditBtn" + bodyId).on("click", function() {
            $("#formGcsSaveBtn" + bodyId).slideDown()
            $("#formGcsEditBtn" + bodyId).slideUp()
            $("#formGcsSignBtn" + bodyId).slideDown()
            $("#formGcs" + bodyId).find("input, select, textarea").prop("disabled", false)
        })

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'GEN0011' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formGcs" + bodyId).append('<input name="org_unit_code" id="gcsorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>"  />')
            .append('<input name="visit_id" id="gcsvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>"  />')
            .append('<input name="trans_id" id="gcstrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>"  />')
            .append('<input name="body_id" id="gcsbody_id' + bodyId + '" type="hidden" value="' + bodyId + '"  />')
            .append('<input name="document_id" id="gcsdocument_id' + bodyId + '" type="hidden" value="' + documentId + '"  />')
            .append('<input name="no_registration" id="gcsno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>"  />')
            .append('<input name="p_type" id="gcsp_type' + bodyId + '" type="hidden" value="GEN0011"  />')
            .append('<input name="modified_by" id="gcsmodified_by' + bodyId + '" type="hidden" value="<?= user()->username; ?>"  />')
            .append('<input name="valid_date" class="valid_date" id="gcsvalid_date' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_user" class="valid_user" id="gcsvalid_user' + bodyId + '" type="hidden"  />')
            .append('<input name="valid_pasien" class="valid_pasien" id="gcsvalid_pasien' + bodyId + '" type="hidden"  />')
        $("#formGcs" + bodyId).on('submit', (function(e) {
            $("#gcsdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveGcs',
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
                    if ($("#gcsvalid_pasien" + bodyId).val() == '') {
                        $("#formGcsSaveBtn" + bodyId).slideUp()
                        $("#formGcsEditBtn" + bodyId).slideDown()
                        $("#formGcsSignBtn" + bodyId).slideDown()
                    } else {
                        $("#formGcsSaveBtn" + bodyId).slideUp()
                        $("#formGcsEditBtn" + bodyId).slideUp()
                        $("#formGcsSignBtn" + bodyId).slideUp()
                    }
                    $("#formGcs" + bodyId).find("input, select, textarea").prop("disabled", true)
                    clicked_submit_btn.button('reset');
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formGcsSaveBtn" + bodyId).slideDown()
            $("#formGcsEditBtn" + bodyId).slideUp()
            $("#formGcs" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {

            var maindataset = gcsAll[index]

            $.each(maindataset, function(key, value) {
                $("#gcs" + key + bodyId).val(value)
            })
            $("#flatgcsexamination_date" + bodyId).val(formatedDatetimeFlat(maindataset.examination_date))
            var gcs = gcsAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'GEN0011') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(gcs.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (gcs.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'GEN0011' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(gcs.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#GCS_SCORE" + bodyId).val(gcs.gcs_score)
            $("#GCS_DESC" + bodyId).val(gcs.gcs_score)
            $.each(gcsDetailAll, function(key, value) {
                if (value.body_id == gcs.body_id) {
                    $("#val" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                }
            })


            await checkSignSignature("formGcs" + bodyId, "gcsbody_id" + bodyId, "formGcsSaveBtn")

            if ($("#gcsvalid_pasien" + bodyId).val() == '') {
                $("#formGcsSaveBtn" + bodyId).slideUp()
                $("#formGcsEditBtn" + bodyId).slideDown()
                $("#formGcsSignBtn" + bodyId).slideDown()
            } else {
                $("#formGcsSaveBtn" + bodyId).slideUp()
                $("#formGcsEditBtn" + bodyId).slideUp()
                $("#formGcsSignBtn" + bodyId).slideUp()
            }
            $("#formGcs" + bodyId).find("input, select, textarea").prop("disabled", true)

        }
        index++
        if (isaddbutton)
            $("#addGcsButton").html('<a onclick="addGcs(1,' + index + ',\'armpasien_diagnosa_id\', \'bodyGcsMedis\')" class="btn btn-primary btn-lg btn-add-doc btn-to-hide" id="addDocumentBtn' + bodyId + '" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        else
            $("#" + container + "AddBtn").html("")
    }

    function getGcs(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getGcs',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                gcsAll = data.gcs
                gcsDetailAll = data.gcsDetail

                $.each(gcsAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyGcsPerawat").html("")
                        addGcs(0, key, "arpbody_id", "bodyGcsPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyGcsMedis").html()
                        addGcs(0, key, "armpasien_diagnosa_id", "bodyGcsMedis", false)
                    }
                    if (value.document_id == $("#acpptbody_id").val()) {
                        addGcs(0, key, "acpptbody_id", container, false)
                    }
                })
            },
            error: function() {

            }
        });
    }

    function copyGcs(flag, index, document_id, container, isaddbutton = true) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/copyGcs',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': $("#" + document_id)?.val()
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                gcsAll = data.gcs
                // gcsDetailAll = data.gcsDetail

                $.each(gcsAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyGcsPerawat").html("")
                        addGcs(0, key, "arpbody_id", "bodyGcsPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyGcsMedis").html()
                        addGcs(0, key, "armpasien_diagnosa_id", "bodyGcsMedis", false)
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

// INTEGUMEN
<script type="text/javascript">
    function addIntegumen(flag, index, document_id, container) {
        var bodyId = '';
        var documentId = $("#" + document_id).val()

        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = integumenAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formIntegumen' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Integumen"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES036') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                                                                        if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                            if ($value['parameter_id'] == '09') {
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES036' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                                                                        if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                        }
                                                                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formIntegumenSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formIntegumenEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES036' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                    } else {
                        console.log($(this).val())
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideUp()
                    }
                });
        <?php
            }
        } ?>

        $("#formIntegumen" + bodyId).append('<input name="org_unit_code" id="integumensorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="integumensvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="integumenstrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="integumensbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="integumensdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="integumensno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="integumensp_type' + bodyId + '" type="hidden" value="ASES036" class="form-control" />')
        $("#formIntegumen" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveIntegumen',
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
                    $('#formIntegumen' + bodyId).find("input,select,textarea").prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formIntegumenSaveBtn" + bodyId).slideUp()
                    $("formIntegumenEditBtn" + bodyId).slideDown()
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));

        $("#ASES03606" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#formIntegumenEditBtn" + bodyId).on("click", function() {
            $("#formIntegumenSaveBtn" + bodyId).slideDown()
            $("#formIntegumenEditBtn" + bodyId).slideUp()
        })
        if (flag == 1) {
            $("#formIntegumenSaveBtn" + bodyId).slideDown()
            $("formIntegumenEditBtn" + bodyId).slideUp()
        } else {
            var integumen = integumenAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES036') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(integumen.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (integumen.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES036' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).slideDown()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(integumen.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formIntegumenSaveBtn" + bodyId).slideUp()
            $("formIntegumenEditBtn" + bodyId).slideDown()
            $("#formIntegumen" + bodyId).find("input, select, textarea").prop("disabled", true)
        }
        index++
        $("#addIntegumenButton").html('<a onclick="addIntegumen(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getIntegumen(bodyId) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getIntegumen',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                integumenAll = data.integumen
                // stabilitasDetail = data.stabilitasDetail

                $.each(integumenAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addIntegumen(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

// DIAG NURSE
<script>
    function addRowDiagPerawat(
        container,
        bodyId,
        diag_id = null,
        diag_name = null,
        modal_name = null
    ) {
        let diagIndex = get_bodyid()
        let diagNurseIdentity = container + diagIndex;
        $("#" + container + bodyId).append(
            $('<tr id="' + container + bodyId + diagIndex + '">')
            // .append($('<td>').html(diagIndex + "."))
            .append(
                $("<td>")
                .append(
                    '<select id="adiagpdiagnosan_id' +
                    diagNurseIdentity +
                    '" class="form-control" name="diagnosan_id[]" onfocus="removetextdiagperawat(\'' +
                    diagNurseIdentity +
                    "')\" onchange=\"selectedDiagNursePerawat('" +
                    diagNurseIdentity +
                    '\')" style="width: 100%"></select>'
                )
                .append(
                    '<input id="adiagpdiag_notes' +
                    diagNurseIdentity +
                    '" name="diag_notes[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />'
                )
            )
            .append(
                "<td><a href='#' onclick='$(\"#adiagpdiag" +
                diagNurseIdentity +
                "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-trash'></i></a></td>"
            )
        );

        initializeDiagPerawatSelect2(
            "adiagpdiagnosan_id" + diagNurseIdentity,
            diag_id,
            diag_name,
            null,
            modal_name
        );
    }

    function selectedDiagNurse(index) {
        var diagname = $("#arpdiag_id" + index).text();
        if (typeof diagname !== "undefined") {
            $("#arpdiag_name" + index).val(diagname);
        }
    }

    function selectedDiagNursePerawat(index) {
        var diagname = $("#adiagpdiagnosan_id" + index).text();
        if (typeof diagname !== "undefined") {
            $("#adiagpdiag_notes" + index).val(diagname);
        }
    }

    function removetextdiagperawat(index) {
        $("#adiagpdiagnosan_id" + index).text("");
    }

    function initializeDiagPerawatSelect2(
        theid,
        initialvalue = null,
        initialname = null,
        initialcat = null,
        modalParent = null
    ) {

        let modalParentId;
        if (modalParent == null) {
            modallParentId = $(this).parent()
        } else {
            modalParentId = $("#" + modalParent)
        }
        $("#" + theid).select2({
            placeholder: "Input Diagnosa",
            dropdownParent: modalParentId,
            ajax: {
                url: "<?= base_url(); ?>admin/patient/getDiagnosisPerawatListAjax",
                type: "post",
                dataType: "json",
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                    };
                },
                processResults: function(response) {
                    $("#" + theid)
                        .val(null)
                        .trigger("change");
                    return {
                        results: response,
                    };
                },
                cache: true,
            },
        });
        if (initialvalue != null) {
            var option = new Option(initialname, initialvalue, true, true);
            $("#" + theid)
                .append(option)
                .trigger("change");
        }
    }
</script>

<script>
    // function setBadge(propId, badgeId, className, textContent) {
    //     var badge = document.getElementById(badgeId);

    //     if (badge) {
    //         if (className == 'bg-light') {
    //             badge.className =
    //                 'badge-score h6 badge position-absolute top-50 start-100 translate-middle text-dark border border-1 border-dark ' +
    //                 className;
    //             badge.textContent = textContent;
    //         } else {
    //             badge.className = 'badge-score h6 badge position-absolute top-50 start-100 translate-middle ' +
    //                 className;
    //             badge.textContent = textContent;
    //         }
    //     }
    // }

    // function vitalsignInput(prop) {
    //     var value = prop.value.trim();
    //     var id = prop.id
    //     var name = prop.name; //=new
    //     var data;
    //     var totalScore = [];

    //     if (isNaN(value) || value === "") {
    //         value = 0;
    //     } else {
    //         value = parseFloat(value);
    //     }

    //     let scoreFunction;
    //     let typename = id.replace(name, "")
    //     console.log(typename)
    //     let thetype = $("#" + typename + "vs_status_id").val()
    //     console.log(thetype)
    //     if (prop.type == 1) {
    //         scoreFunction = getAdultScore;
    //     } else {
    //         scoreFunction = getNeonatalScore;
    //     }
    //     switch (name) {
    //         case "nadi":
    //             data = scoreFunction('nadi', value);
    //             setBadge(id, 'badge-' + id, 'bg-' + data.color, data.score);
    //             break;
    //         case "temperature":
    //             data = scoreFunction('suhu', value);
    //             setBadge(id, 'badge-' + id, 'bg-' + data.color, data.score);
    //             break;
    //         case "saturasi":
    //             data = scoreFunction('saturasi', value);
    //             setBadge(id, 'badge-' + id, 'bg-' + data.color, data.score);
    //             break;
    //         case "nafas":
    //             data = scoreFunction('pernapasan', value);
    //             setBadge(id, 'badge-' + id, 'bg-' + data.color, data.score);
    //             break;
    //         case "oxygen_usage":
    //             data = scoreFunction('oksigen', value);
    //             setBadge(id, 'badge-' + id, 'bg-' + data.color, data.score);
    //             break;
    //         case "weight":
    //             if (value < 10) {
    //                 value = 10.00;
    //             } else if (value > 50) {
    //                 value = 50.00;
    //             } else {
    //                 value = value.toFixed(2);
    //             }
    //             break;
    //         case "tension_upper":
    //             if (value < 50) {
    //                 value = 50.00;
    //             } else if (value > 250) {
    //                 value = 250.00;
    //             }
    //             data = scoreFunction('darah', value);
    //             setBadge(id, 'badge-' + id, 'bg-' + data.color, data.score);
    //             break;
    //         case "height":
    //             if (value > 250) {
    //                 value = 250;
    //             }
    //             break;
    //         case "tension_below":
    //             if (value < 0) {
    //                 value = 0.00;
    //             } else if (value > 300) {
    //                 value = 300.00;
    //             }
    //             break;
    //         default:
    //             break;
    //     }

    //     prop.value = value;

    //     document.getElementById('total_score').textContent = 'Total Skor: ' + sumTextContentFromClass('badge-score');
    // }

    // function changeEwsParam(className) {
    //     var optionSelected = $("option:selected", this);
    //     $('.className').each((index, each) => {
    //         $(each).change(element => {
    //             vitalsignInput({
    //                 value: $(each).val(),
    //                 name: $(each).attr('name'),
    //                 id: $(each).attr('id'),
    //                 type: optionSelected.val()
    //             })
    //         })
    //         vitalsignInput({
    //             value: $(each).val(),
    //             name: $(each).attr('name'),
    //             id: $(each).attr('id'),
    //             type: optionSelected.val()
    //         })
    //     });
    // }
</script>