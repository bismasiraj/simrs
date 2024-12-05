<style>
    .outline-white-bg {
        /* box-shadow: inset 0 0 0 3px rgba(255, 255, 255, 0.5); */
        background-color: #fff
    }

    .outline-warning-bg {
        /* box-shadow: inset 0 0 0 3px rgba(255, 193, 7, 0.7); */
        background-color: #fff5cc;
    }

    .outline-danger-bg {
        background-color: #ffcccc
            /* box-shadow: inset 0 0 0 3px rgba(220, 53, 69, 0.7); */
    }
</style>




<script type="text/javascript">
    let treatmentData = [];
    let historyPasien = [];
    let pasienOperasiValue = [];
    let pasienOperasiSelected = [];
    let genBodyID = ''; //new
    let checkKeselamatanBodyID = ''; //new
    let checkAnestesiBodyID = ''; //new
    let informasiPostOperasiBodyID = ''; //new
    let anestesiValID = ''; //new
    (function() {
        $(document).ready(function() {

            let visit = <?= json_encode($visit) ?>;
            getDataTreatment();
            getDataTableOperation(visit);

            actionButtonAddOperation(visit);
            $('#container-tab').attr('hidden', true) //update
            $("#close-create-modal-permintaan-operasi").off().on("click", (e) => {

                e.preventDefault();
                $("#create-modal-permintaan-operasi").modal("hide");
            });

            $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {

                $('#tarif_id-permintaan_operasi').select2({
                    dropdownParent: $('#create-modal-permintaan-operasi')
                });

                renderDropdownTreatment({
                    data: treatmentData
                });


            });

            // tindakan 
            $("#close-create-modal-tindakan-operasi").off().on("click", (e) => {

                e.preventDefault();
                $("#create-modal-tindakan-operasi").modal("hide");
            });

            $('#create-modal-tindakan-operasi').on('shown.bs.modal', function() {

                $('#tarif_id-tindakan_operasi').select2({
                    dropdownParent: $('#create-modal-tindakan-operasi')
                });
                renderDropdownTreatment({
                    data: treatmentData
                });
            });

            $('#btn-reset-data').click(function() {
                $('#bodydataRequestOperation > tr').removeClass('table-primary');
                $('#container-tab').attr('hidden', true)
            });

        });
        let quillInstances = {}
        let tasksValue = []
        let employesValue = []
        let InstrumenValue = []
        let dataDrain = []
        let globalBodyId = '';

        // OPTIONS & SUPPORT
        const generateCode = () => {
            let now = new Date();
            let code = "" + now.getFullYear() +
                ('0' + (now.getMonth() + 1)).slice(-2) +
                ('0' + now.getDate()).slice(-2) +
                ('0' + now.getHours()).slice(-2) +
                ('0' + now.getMinutes()).slice(-2) +
                ('0' + now.getSeconds()).slice(-2);
            let randomDigits = ('00' + Math.floor(Math.random() * 1000)).slice(-3);

            return code + randomDigits;
        };

        const initializeSelect2 = () => {
            $('.select2').each(function() {
                $(this).select2({
                    placeholder: "Select an option",
                    dropdownParent: $(this).parent()
                });
            });
        };

        const getShiftIdForDropdown = (dropdownType) => {
            switch (dropdownType) {
                case 'Operator':
                    return 1;
                case 'Anestesi':
                    return 2;
                case 'Instrumen':
                case 'Sirkuler':
                case 'Perawat':
                    return 3;
                case 'Dokter':
                    return null;
                default:
                    return 4;
            }
        };

        const groupTasks = (data) => {
            return data.reduce((acc, item) => {
                const taskGroupName = item.task.split(' ')[0];
                if (!acc[taskGroupName]) acc[taskGroupName] = [];
                acc[taskGroupName].push(item);
                return acc;
            }, {});
        };

        const manipulationsTextCheckbox = (ids) => {
            ids.forEach(id => {
                let initialInput = document.getElementById(id);

                if (!initialInput) return;
                if (initialInput.value.trim() !== '') {
                    initialInput.style.display = 'block';
                    return;
                }

                let checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.className = 'form-check-input';
                checkbox.id = `checkbox_${id}`;
                checkbox.name = 'sedation';
                checkbox.value = '';

                initialInput.parentNode.insertBefore(checkbox, initialInput);

                function toggleInput() {
                    if (checkbox.checked) {

                        initialInput.style.display = 'block';
                        checkbox.style.display = 'none';
                        initialInput.classList.remove('hidden');
                        initialInput.focus();
                    } else {

                        initialInput.style.display = 'none';
                        checkbox.style.display = 'block';
                        initialInput.classList.add('hidden');
                    }
                }

                checkbox.addEventListener('change', toggleInput);

                initialInput.style.display = 'none';
                checkbox.style.display = 'block';
            });
        };

        // ACTIONS & BTN
        const actionDropdownSpesialisas = () => {
            $("#tarif_id-permintaan_operasi").off().on("change", function(e) {
                let selectedOption = $(this).find('option:selected');
                let operationType = selectedOption.data('operation-type');
                $("#operation_type-permintaan_operasi").val(operationType);
                const foundData = treatmentData.find(item => item.operation_type === `${operationType}`);
                $("#operation_type_name-permintaan_operasi").val(foundData?.treatment);
            });
        }


        const getDataTableOperation = (props) => {

            $("#patientOperationRequestTab").off().on("click", function(e) {
                getLoadingscreen("contentToHide-requestOperation", "load-content-requestOperation")
                // getDataTreatment()
                e.preventDefault();
                getDataTabelRequestOperation({
                    no_registration: props?.no_registration,
                    visit_id: props?.visit_id
                })
                $("#container-tab").slideUp();
            })
        };


        const initializeFlatpickrOperasi = () => {
            flatpickr(".datetimeflatpickr", {
                enableTime: true,
                dateFormat: "d/m/Y H:i", // Display format
                time_24hr: true, // 24-hour time format
            });

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

        const btnSaveActionRequestOperation = (props) => {
            $("#btn-save-permintaan-operasi-modal").off().on("click", function(e) {
                e.preventDefault();

                if ($('#tarif_id-permintaan_operasi').val() === '' || $('#tarif_id-permintaan_operasi')
                    .val() ===
                    null) {
                    $('#tarif_id-permintaan_operasi').select2('open');
                    return;
                }



                $('#formDokumentPermintaanOperasi').find(':disabled').each(function() {
                    $(this).removeAttr('disabled');
                });

                let formElement = document.getElementById('formDokumentPermintaanOperasi');
                let dataSend = new FormData(formElement);
                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });


                $('#formDokumentPermintaanOperasi').find(':disabled').each(function() {
                    $(this).attr('disabled', 'disabled');
                });

                let isChecked = $('input[name="patient_category_id"]:checked').val();
                jsonObj['patient_category_id'] = isChecked;
                let operationType = $("#operation_type-permintaan_operasi").val();
                jsonObj['operation_type'] = operationType;

                postData(jsonObj, 'admin/PatientOperationRequest/insertData', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil disimpan.');

                        $("#create-modal-permintaan-operasi").modal("hide");
                        $('#formDokumentPermintaanOperasi')[0].reset();

                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id
                        });
                    }
                });
            });
        };

        const btnUpdateDataRequestOperation = (props) => {
            $('#btn-edit-permintaan-operasi-modal').off().on('click', function(e) {
                e.preventDefault();

                $('#formDokumentPermintaanOperasi').find(':disabled').each(function() {
                    $(this).removeAttr('disabled');
                });

                let formElement = document.getElementById('formDokumentPermintaanOperasi');
                let dataSend = new FormData(formElement);
                let jsonObj = {};


                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });

                let isChecked = $('input[name="patient_category_id"]:checked').length ? $(
                    'input[name="patient_category_id"]:checked').val() : null;
                jsonObj['patient_category_id'] = isChecked;

                let operationType = $("#operation_type-permintaan_operasi").val();
                jsonObj['operation_type'] = operationType;

                postData(jsonObj, 'admin/PatientOperationRequest/updateData', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');

                        $("#create-modal-permintaan-operasi").modal("hide");
                        $('#formDokumentPermintaanOperasi')[0].reset();

                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id
                        });
                    }
                });
            });
        };

        const deleteModalDataRequestOperation = () => {
            $('.btn-show-delete-requestOperation').off().on('click', function(e) {

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success ms-2",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: "Apa anda yakin?",
                    text: "Anda tidak akan dapat mengembalikannya!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteActionRequestOperation({
                            vactination_id: $(this).data('id'),
                            visit_id: $(this).data('visit_id'),
                            no_registration: $(this).data('noregis')
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Dibatalkan",
                            text: "File Anda aman :)",
                            icon: "error"
                        });
                    }
                });


            });
        };

        const btnSavepraOprasi = (props) => {
            $("#btn-save-catatan-keperawatan").off().on("click", function(e) {
                e.preventDefault();


                let jsonObj = {
                    instrumen: [],
                    instrumen2: [],
                    drain: [],
                    diagnosas: [],
                    bromage: [],
                    aldrete: [],
                    steward: [],
                    vitailsign: {}
                };

                const selects = document.querySelectorAll('#bromageContainer select');
                selects.forEach(select => {
                    // Use selectedOptions to get only the selected options
                    const selectedOptions = select.selectedOptions;
                    Array.from(selectedOptions).forEach(option => {
                        let entry = {
                            document_id: props?.vactination_id,
                            value_id: option.value,
                            p_type: 'OPRS024',
                            parameter_id: option.getAttribute('data-parameter'),
                            value_score: option.getAttribute('data-score'),
                            value_desc: option.getAttribute('data-desc')
                        };
                        jsonObj.bromage.push(entry);
                    });
                });

                $('#form-catatan-keperawatan').find(':disabled').removeAttr('disabled');
                let formElement = document.getElementById('form-catatan-keperawatan');
                let dataSend = new FormData(formElement);


                dataSend.forEach((value, key) => {
                    if (value) {
                        if (!jsonObj[key]) {
                            jsonObj[key] = value;
                        }
                    }
                });

                jsonObj['body_id'] = props?.vactination_id;
                jsonObj['document_id'] = props?.vactination_id;

                let quantity_before = dataSend.getAll('quantity_before[]');
                let quantity_intra = dataSend.getAll('quantity_intra[]');
                let quantity_additional = dataSend.getAll('quantity_additional[]');
                let quantity_after = dataSend.getAll('quantity_after[]');
                let brand_name = dataSend.getAll('brand_name[]');
                let arrInstrument = ['Instrumen', 'Kassa', 'Jarum'];
                let brand_id = dataSend.getAll('brand_id[]');

                for (let i = 0; i < brand_id.length; i++) {
                    let entry = {
                        brand_id: brand_id[i],
                        brand_name: brand_name[i] ?? arrInstrument[i],
                        quantity_before: quantity_before[i],
                        quantity_intra: quantity_intra[i],
                        quantity_additional: quantity_additional[i],
                        quantity_after: quantity_after[i],
                    };
                    jsonObj.instrumen.push(entry);
                }



                let quantity_before2 = dataSend.getAll('quantity_before2[]');
                let quantity_intra2 = dataSend.getAll('quantity_intra2[]');
                let quantity_additional2 = dataSend.getAll('quantity_additional2[]');
                let quantity_after2 = dataSend.getAll('quantity_after2[]');
                let brand_name2 = dataSend.getAll('brand_name2[]');
                let brand_id2 = dataSend.getAll('brand_id2[]');
                for (let i = 0; i < brand_id2.length; i++) {
                    let entry = {
                        brand_id: brand_id2[i],
                        brand_name: brand_name2[i],
                        quantity_before: quantity_before2[i],
                        quantity_intra: quantity_intra2[i],
                        quantity_additional: quantity_additional2[i],
                        quantity_after: quantity_after2[i],
                    };
                    jsonObj.instrumen2.push(entry);
                }


                let xrayValue = document.querySelector('input[name="xray"]:checked').value;
                jsonObj.xray = parseInt(xrayValue, 10);


                let drain_type = dataSend.getAll('drain_type_drain[]');
                let drain_kinds = dataSend.getAll('drain_kinds_drain[]');
                let drain_id = dataSend.getAll('drain_id_drain[]');
                let size = dataSend.getAll('size_drain[]');
                let description = dataSend.getAll('description_drain[]');
                let body_id = dataSend.getAll('body_id_drain[]');
                let visit_id = dataSend.getAll('visit_id_drain[]');
                let trans_id = dataSend.getAll('trans_id_drain[]');
                let org_unit_code = dataSend.getAll('org_unit_code_drain[]');
                let document_id = dataSend.getAll('document_id_drain[]');

                for (let i = 0; i < drain_type.length; i++) {
                    let entry = {
                        drain_type: drain_type[i],
                        drain_kinds: drain_kinds[i],
                        size: size[i],
                        drain_id: drain_id[i],
                        description: description[i],
                        body_id: body_id[i],
                        visit_id: visit_id[i],
                        trans_id: trans_id[i],
                        org_unit_code: org_unit_code[i],
                        document_id: props?.vactination_id,
                    };
                    jsonObj.drain.push(entry);
                }


                let diag_ids = dataSend.getAll('diagnosan_id[]');
                let diag_notes = dataSend.getAll('diag_notes[]');

                for (let i = 0; i < diag_ids.length; i++) {
                    let entry = {
                        diagnosa_id: diag_ids[i],
                        diag_notes: diag_notes[i],
                    };
                    jsonObj.diagnosas.push(entry);
                }



                $('#bodyAldreteoprs023').find('tr').each(function(rowIndex, tr) {
                    let row = $(tr);
                    let AldreteBodyId = get_bodyid();

                    row.find('select[name^="parameter_oprs023_"]').each(function(selectIndex,
                        select) {
                        let selectElement = $(select);
                        let parameterId = selectElement.attr('name').split('_').pop();
                        let valueScore = selectElement.find('option:selected').data(
                            'score');
                        let valueDesc = selectElement.find('option:selected').text().trim();
                        let observationDate = row.find('.datetime-input').val();

                        valueDesc = valueDesc.replace(/\s+/g, ' ').trim();

                        if (selectElement) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: AldreteBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS023',
                                parameter_id: parameterId,
                                value_score: valueScore,
                                value_desc: valueDesc,
                                observation_date: observationDate,
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: selectElement.val()
                            };

                            jsonObj.aldrete.push(entry);
                        } else {
                            console.log(
                                "  Skipped entry due to missing parameterId or valueScore"
                            );
                        }
                    });
                });

                $('#stewardContainer').find('tr').each(function(rowIndex, tr) {
                    let row = $(tr);
                    let StewardBodyId = get_bodyid();

                    row.find('select[name^="parameter_oprs025_"]').each(function(selectIndex,
                        select) {
                        let selectElement = $(select);
                        let parameterId = selectElement.attr('name').split('_').pop();
                        let valueScore = selectElement.find('option:selected').data(
                            'score');
                        let valueDesc = selectElement.find('option:selected').text().trim();
                        let observationDate = row.find('.datetime-input').val();

                        valueDesc = valueDesc.replace(/\s+/g, ' ').trim();

                        if (selectElement) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: StewardBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS025',
                                parameter_id: parameterId,
                                value_score: valueScore,
                                value_desc: valueDesc,
                                observation_date: observationDate,
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: selectElement.val()
                            };

                            jsonObj.steward.push(entry);
                        } else {
                            console.log(
                                "  Skipped entry due to missing parameterId or valueScore"
                            );
                        }
                    });
                });

                const vitailSignKeys = ['vs_status_id', 'arm_diameter', 'nadi', 'nafas', 'height',
                    'saturasi', 'temperature',
                    'tension_below', 'tension_upper', 'examination_date', 'pemeriksaan', 'weight',
                    'oxygen_usage'
                ];

                jsonObj.vitailsign = jsonObj.vitailsign || {};
                vitailSignKeys.forEach(key => {
                    jsonObj.vitailsign[key] = jsonObj[key];
                    delete jsonObj[key];
                });

                jsonObj.vitailsign['body_id'] = dataSend.get('body_id_vt');
                jsonObj.vitailsign['clinic_id'] = 'P002';
                jsonObj.vitailsign['class_room_id'] = dataSend.get('class_room_id');
                jsonObj.vitailsign['bed_id'] = dataSend.get('bed_id');
                jsonObj.vitailsign['keluar_id'] = dataSend.get('keluar_id');
                jsonObj.vitailsign['employee_id'] = dataSend.get('employee_id');
                jsonObj.vitailsign['no_registration'] = dataSend.get('no_registration');
                jsonObj.vitailsign['visit_id'] = dataSend.get('visit_id');
                jsonObj.vitailsign['org_unit_code'] = dataSend.get('org_unit_code');
                jsonObj.vitailsign['doctor'] = dataSend.get('doctor');
                jsonObj.vitailsign['kal_id'] = dataSend.get('kal_id');
                jsonObj.vitailsign['theid'] = dataSend.get('theid');
                jsonObj.vitailsign['thename'] = dataSend.get('thename');
                jsonObj.vitailsign['theaddress'] = dataSend.get('theaddress');
                jsonObj.vitailsign['status_pasien_id'] = dataSend.get('status_pasien_id');
                jsonObj.vitailsign['isrj'] = dataSend.get('isrj');
                jsonObj.vitailsign['gender'] = dataSend.get('gender');
                jsonObj.vitailsign['ageyear'] = dataSend.get('ageyear');
                jsonObj.vitailsign['agemonth'] = dataSend.get('agemonth');
                jsonObj.vitailsign['ageday'] = dataSend.get('ageday');
                jsonObj.vitailsign['modified_by'] = dataSend.get('modified_by');
                jsonObj.vitailsign['trans_id'] = dataSend.get('trans_id');
                if (jsonObj['body_id'] !== "undefined" || props?.vactination_id !== undefined) {
                    jsonObj.vitailsign['pasien_diagnosa_id'] = jsonObj['body_id'] ?? props?.vactination_id;
                }


                jsonObj.bromage['org_unit_code'] = dataSend.get('org_unit_code')
                jsonObj.bromage['visit_id'] = dataSend.get('visit_id')
                jsonObj.bromage['trans_id'] = dataSend.get('trans_id')


                $("#loading-indicator").show();
                postData(jsonObj, 'admin/PatientOperationRequest/insertDataPraOprasi', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');

                        $("#create-modal-permintaan-operasi").modal("hide");


                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id
                        });

                        $("#loading-indicator").hide();
                    } else {
                        errorSwal('Data gagal diperbarui. Silakan coba lagi.');
                        $("#loading-indicator").hide();
                    }
                }, (beforesend) => {
                    console.log("Request is being sent...");
                }, (error) => {
                    console.error("Error occurred:", error);
                    errorSwal('Terjadi kesalahan. Silakan coba lagi.');
                    $("#loading-indicator").hide();
                });
            });
        };

        const btnSaveLaporanPembedahan = (props) => {
            $("#btn-save-laporan-pembedahan").off().on('click', function(e) {
                e.preventDefault();


                $('#form-laporan-pembedahan').find(':disabled').removeAttr('disabled');

                let formElement = document.getElementById('form-laporan-pembedahan');
                let dataSend = new FormData(formElement);
                let jsonObj = {
                    diagnosas: [],
                };


                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });

                let diag_cats = dataSend.getAll('diag_cat[]');
                let diag_ids = dataSend.getAll('diag_id[]');
                let diag_names = dataSend.getAll('diag_name[]');
                let suffer_type = dataSend.getAll('suffer_type[]');

                for (let i = 0; i < diag_ids.length; i++) {
                    let entry = {
                        diagnosa_cat: diag_cats[i],
                        diagnosa_id: diag_ids[i],
                        diagnosa_name: diag_names[i],
                        suffer_type: suffer_type[i],
                    };
                    jsonObj.diagnosas.push(entry);
                }
                postData(jsonObj, 'admin/PatientOperationRequest/insertLaporanPembedahan', (
                    res) => {

                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');

                        // $("#create-modal-permintaan-operasi").modal("hide");
                        // $('#form-operasi')[0].reset();


                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id
                        });
                    }
                }, (beforesend) => {
                    console.log("Request is being sent...");
                });
            })
        }

        const groupingGetAllArcodions = (data) => {
            $('.btn-show-assesment-requestOperation').on('click', function(e) {
                quillInstances = {};
                dataDrain = [];
                globalBodyId = '';
                let index = $(this).data('index');
                let item = pasienOperasiValue[index];
                pasienOperasiSelected = item;

                $('#bodydataRequestOperation > tr').removeClass('table-primary');
                $(this).closest('tr').addClass('table-primary')
                // assessmentPraOperasi(item)
                // getDataInstrumenoprs(item);
                postData({
                    id: item?.vactination_id,
                    visit_id: item?.visit_id
                }, 'admin/PatientOperationRequest/getAllArcodions', (res) => {

                    if (res.respon) {
                        let result = res?.data
                        $("#pasien_diagnosa_id-laporanAnesthesi-lengkap").val(result
                            ?.assessment_anesthesia?.body_id); //new

                        checklistKeselamatan({
                            data: result?.assessment_operation_check,
                        });

                        anestesi({
                            data: {
                                assessment_operation: result?.assessment_operation,
                                assessment_anesthesia_checklist: result
                                    ?.assessment_anesthesia_checklist,
                                ori: item
                            }
                        });

                        catatanKeperawatanPraOperasi({
                            data: result?.assessment_operation,
                            assessment_anesthesia_recovery: result
                                ?.assessment_anesthesia_recovery,
                            exam_info: result?.exam_info

                        })

                        getDataKeperawatanOPRS001({
                            data: result?.assessment_operation_pra,
                            blood_request: result?.treatmentobat.blood_request,
                            diagnosas: result?.diagnosas

                        })

                        pembedahan({
                            data: item,
                            diagnosas: result?.diagnosas,
                        });

                        LaporanAnesthesi({
                            data: result?.assessment_anesthesia,
                            exam_info: result?.exam_info
                        })


                        laporanAnesthesiLengkap({
                            data: {
                                assessment_anesthesia_checklist: result
                                    ?.assessment_anesthesia_checklist,
                                assessment_anesthesia: result
                                    ?.assessment_anesthesia,
                                assessment_anesthesia_post: result
                                    ?.assessment_anesthesia_post,
                                assessment_anesthesia_recovery: result
                                    ?.assessment_anesthesia_recovery,
                            },
                            exam_info: result?.exam_info
                        })

                        templateOprasiPembedahan({
                            data: {
                                operation_team: result?.operation_team,
                                operation_task: result?.operation_task

                            }
                        })

                        templateOprasiPembedahanAnesthesiLengkap({
                            data: {
                                operation_team: result?.operation_team,
                                operation_task: result?.operation_task

                            }
                        })

                        renderDataTreatmentObat({
                            data: result?.treatmentobat
                        })


                        getDataDrain({
                            data: result?.assessment_operation_drain,
                            assessment_anesthesia_recovery: result
                                ?.assessment_anesthesia_recovery,

                        });

                        getInstrumen({
                            data: result?.assessment_instrument
                        });

                    }
                })
                postOperasi(item);


                // appendLokalisOperation("accordionPraOperasiSurgeryBody")
                $("#container-tab").attr("hidden", false);
                $("#nama-tindakan-operasi").text($(this).data('treatname') + ' (' + $(this).data(
                        'date') +
                    ')');
                $('#operation_planning').val($(this).data('treatname'));
                $("#document_id_checklist_keselamatan").val($(this).data('id')); //new
                $("#document_id_checklist_anestesi").val($(this).data('id')); //new
                $("#document_id_informasi-post-operasi").val($(this).data('id')); //new
                $("#apobody_id").val($(this).data('id')); //new

                assessmentPraOperasi({
                    vactination_id: $(this).data('id')
                })


                cetakOperasi({
                    vactination_id: $(this).data('id'),
                    element_id: '#btn-print-praoperasi2',
                    method: 'cetak_pra_operasi'
                })
                cetakOperasi({
                    vactination_id: $(this).data('id'),
                    element_id: '#btn-print-laporan-anesthesi',
                    method: 'cetak_laporan_anesthesi'
                })
                cetakOperasi({
                    vactination_id: $(this).data('id'),
                    element_id: '#btn-print-anestesi-lengkap',
                    method: 'cetak_anesthesi_lengkap'
                })
                cetakOperasi({
                    vactination_id: $(this).data('id'),
                    element_id: '#btn-print-checklist-anestesi',
                    method: 'cetak_checklist_anestesi'
                })
                cetakOperasi({
                    vactination_id: $(this).data('id'),
                    element_id: '#btn-print-catatan-keperawatan',
                    method: 'cetak_catatan_keperawatan'
                })
                cetakOperasi({
                    vactination_id: $(this).data('id'),
                    element_id: '#btn-print-checklist-keselamatan',
                    method: 'cetak_checklist_keselamatan'
                })
                cetakOperasi({
                    vactination_id: $(this).data('id'),
                    element_id: '#btn-print-post-operasi',
                    method: 'cetak_post_operasi'
                })
                cetakOperasi({
                    vactination_id: $(this).data('id'),
                    element_id: '#btn-print-laporan-pembedahan',
                    method: 'cetak_laporan_pembedahan'
                })
                $("#container-tab").slideUp();
                $("#container-tab").slideDown();
                initializeFlatpickrOperasi()
            });
        }; //new update 1/08


        const cetakOperasi = (props) => {
            $(props.element_id).on('click', function() {
                // Retrieve data from button attributes
                var visitEncoded = '<?= base64_encode(json_encode($visit)); ?>'
                var idEncoded = props.vactination_id;

                // Construct the URL
                var url = '<?= base_url() . '/admin/cetak/'; ?>' + props.method + '/' + visitEncoded + '/' +
                    idEncoded;

                // Redirect to the URL
                window.open(url, '_blank'); // Open in a new tab
            });
        }

        const actionBtnUpdateAndInsert = (props) => {
            $('#btn-updateAndInsert-permintaan-operasi-modal').off().on('click', function(e) {
                e.preventDefault();


                $('#formDokumentPermintaanOperasi').find(':disabled').removeAttr('disabled');

                let formElement = document.getElementById('formDokumentPermintaanOperasi');
                let formData = new FormData(formElement);

                let groupedTasksKeys = Object.keys(window.groupedTasks || {});

                let jsonObj = {};


                groupedTasksKeys.forEach(key => {
                    jsonObj[key] = [];
                });


                formData.forEach((value, key) => {
                    if (!key.includes('employee_option') && !key.includes(
                            'groupedTasks_option')) {
                        jsonObj[key] = value;
                    }
                });


                let isChecked = $('input[name="patient_category_id"]:checked').length ? $(
                    'input[name="patient_category_id"]:checked').val() : null;
                jsonObj['patient_category_id'] = isChecked;
                let operationType = $("#operation_type-permintaan_operasi").val();
                jsonObj['operation_type'] = operationType;


                groupedTasksKeys.forEach(key => {
                    let tasks = window.groupedTasks[key] || [];
                    let employees = window.employees.data || [];

                    let employeeIds = formData.getAll(`employee_option[]`);
                    let taskIds = formData.getAll(`groupedTasks_option[]`);

                    employeeIds.forEach((employee_id, index) => {
                        if (employee_id) {
                            let employeeData = employees.find(emp => emp
                                .employee_id ===
                                employee_id);
                            if (employeeData) {
                                let entry = {
                                    [`EMPLOYEE_ID`]: employeeData.employee_id,
                                    [`DOCTOR`]: employeeData.fullname
                                };

                                let task_id = taskIds[index];
                                if (task_id) {
                                    let taskData = tasks.find(task => task
                                        .task_id ===
                                        parseInt(task_id, 10));
                                    if (taskData) {
                                        entry[`TASK_ID`] = taskData.task_id;
                                        entry[`COEFFICIENT`] = taskData.coefisient;
                                        entry[`ONCALL`] = taskData.oncall;
                                        jsonObj[key].push(entry);
                                    }
                                }

                            }
                        }
                    });
                });

                postData(jsonObj, 'admin/PatientOperationRequest/updateDataAndInsert', (res) => {

                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');

                        $("#create-modal-permintaan-operasi").modal("hide");
                        $('#formDokumentPermintaanOperasi')[0].reset();


                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id
                        });
                    }
                }, (beforesend) => {
                    console.log("Request is being sent...");
                });
            });
        };

        const actionDropdownContentTindakan = () => {
            $('#dropdown-param-tindakan-operasi').off('click', '.add-dropdown').on('click', '.add-dropdown',
                function() {

                    const dropdownType = $(this).closest('table').attr('id').replace('dropdown-', '');
                    const tasks = window.groupedTasks[dropdownType];

                    if (tasks && tasks.length > 0) {
                        const options = tasks.map(task => `
                    <option value="${task.task_id}">${task.task}</option>
                `).join('');

                        const template = `
                    <tr>
                        <td>
                            <select class="form-control select2 groupedTasks-dropdown" name="groupedTasks_option_${dropdownType}[]">
                                ${options}
                            </select>
                        </td>
                        <td rowspan="2" class="align-middle">
                            <button class="btn btn-danger delete-dropdown"><i class="fas fa-minus-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control select2 employee-dropdown" name="employee_option_${dropdownType}[]">
                                ${getDropdownOptions(getShiftIdForDropdown(dropdownType))}
                            </select>
                        </td>
                    </tr>
                `;
                        $(this).closest('table').find('tbody').append(template);
                        initializeSelect2();
                    } else {
                        console.error(
                            `Tasks for dropdown type '${dropdownType}' are undefined or empty.`);
                    }
                });

            $('#dropdown-param-tindakan-operasi').off('click', '.delete-dropdown').on('click',
                '.delete-dropdown',
                function() {
                    $(this).closest('tr').prev().remove();
                    $(this).closest('tr').remove();
                });
        };

        const btnSaveLaporanAnestesi = (props) => {
            $("#btn-save-laporan-anesthesi").off().on("click", function(e) {
                e.preventDefault();


                $('#form-laporan-anesthesi').find(':disabled').removeAttr('disabled');
                let formElement = document.getElementById('form-laporan-anesthesi');
                let dataSend = new FormData(formElement);

                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    if (value) {
                        jsonObj[key] = value;
                    }
                });
                jsonObj['document_id'] = props.vactination_id

                // Extract diagnosa fields
                let diag_cat = dataSend.getAll('diag_cat[]');
                let diag_id = dataSend.getAll('diag_id[]');
                let diag_name = dataSend.getAll('diag_name[]');
                let suffer_type = dataSend.getAll('suffer_type[]');

                jsonObj.diagnosa = [];

                for (let i = 0; i < diag_id.length; i++) {
                    let entry = {
                        diag_cat: diag_cat[i],
                        diag_id: diag_id[i],
                        diag_name: diag_name[i],
                        suffer_type: suffer_type[i],
                        pasien_diagnosa_id: dataSend.get('body_id')
                    };

                    jsonObj.diagnosa.push(entry);
                }


                ['diag_cat[]', 'diag_id[]', 'diag_name[]', 'suffer_type[]'].forEach(key => {
                    dataSend.getAll(key).forEach((_, i) => {
                        jsonObj[key.replace('[]', `[${i}]`)] =
                            undefined;
                    });
                });



                const vitailSignKeys = ['vs_status_id', 'arm_diameter', 'nadi', 'nafas', 'height',
                    'saturasi', 'temperature', 'tension_below', 'tension_upper', 'examination_date',
                    'pemeriksaan', 'weight', 'oxygen_usage'
                ];

                jsonObj.vitailsign = jsonObj.vitailsign || {};
                vitailSignKeys.forEach(key => {
                    jsonObj.vitailsign[key] = jsonObj[key];
                    delete jsonObj[key];
                });

                jsonObj.vitailsign['body_id'] = dataSend.get('body_id_vt');
                jsonObj.vitailsign['clinic_id'] = 'P002';
                jsonObj.vitailsign['class_room_id'] = dataSend.get('class_room_id');
                jsonObj.vitailsign['bed_id'] = dataSend.get('bed_id');
                jsonObj.vitailsign['keluar_id'] = dataSend.get('keluar_id');
                jsonObj.vitailsign['employee_id'] = dataSend.get('employee_id');
                jsonObj.vitailsign['no_registration'] = dataSend.get('no_registration');
                jsonObj.vitailsign['visit_id'] = dataSend.get('visit_id');
                jsonObj.vitailsign['org_unit_code'] = dataSend.get('org_unit_code');
                jsonObj.vitailsign['doctor'] = dataSend.get('doctor');
                jsonObj.vitailsign['kal_id'] = dataSend.get('kal_id');
                jsonObj.vitailsign['theid'] = dataSend.get('theid');
                jsonObj.vitailsign['thename'] = dataSend.get('thename');
                jsonObj.vitailsign['theaddress'] = dataSend.get('theaddress');
                jsonObj.vitailsign['status_pasien_id'] = dataSend.get('status_pasien_id');
                jsonObj.vitailsign['isrj'] = dataSend.get('isrj');
                jsonObj.vitailsign['gender'] = dataSend.get('gender');
                jsonObj.vitailsign['ageyear'] = dataSend.get('ageyear');
                jsonObj.vitailsign['agemonth'] = dataSend.get('agemonth');
                jsonObj.vitailsign['ageday'] = dataSend.get('ageday');
                jsonObj.vitailsign['modified_by'] = dataSend.get('modified_by');
                jsonObj.vitailsign['trans_id'] = dataSend.get('trans_id');
                jsonObj.vitailsign['pasien_diagnosa_id'] = jsonObj['body_id'];

                $("#loading-indicator").show();

                postData(jsonObj, 'admin/PatientOperationRequest/insertLaporanAnestesia', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');
                        $("#create-modal-permintaan-operasi").modal("hide");

                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id
                        });
                        $("#loading-indicator").hide();
                    } else {
                        errorSwal('Data gagal diperbarui. Silakan coba lagi.');
                        $("#loading-indicator").hide();
                    }
                }, (beforesend) => {
                    console.log("Request is being sent...");
                }, (error) => {
                    console.error("Error occurred:", error);
                    errorSwal('Terjadi kesalahan. Silakan coba lagi.');
                    $("#loading-indicator").hide();
                });
            });
        }

        const ChartMonitoringDurante = (props) => {
            let rawData = props?.data || [];
            let dataRendersTables = '';

            let groupedData = {};

            rawData.forEach(item => {
                let dateTime = item?.examination_date ? moment(item?.examination_date).format(
                    'DD MMM YYYY HH:mm') : null;
                if (dateTime && !groupedData[dateTime]) {
                    groupedData[dateTime] = {
                        nadi: [],
                        temperature: [],
                        saturasi: [],
                        tension_upper: [],
                        tension_below: []
                    };
                }
                if (dateTime) {
                    groupedData[dateTime].nadi.push(parseInt(item?.nadi ?? 0));
                    groupedData[dateTime].temperature.push(parseInt(item?.temperature ?? 0));
                    groupedData[dateTime].saturasi.push(parseInt(item?.saturasi ?? 10));
                    groupedData[dateTime].tension_upper.push(parseInt(item?.tension_upper ?? 0));
                    groupedData[dateTime].tension_below.push(parseInt(item?.tension_below ?? 0));
                }
            });


            let allDates = Object.keys(groupedData);
            let dates = Array.from(new Set(allDates.map(dt => moment(dt, 'DD MMM YYYY HH:mm').format(
                'DD MMM YYYY'))));
            let times = allDates.map(dt => moment(dt, 'DD MMM YYYY HH:mm').format('HH:mm'));

            let labels = dates.flatMap(date => times.filter((_, index) => allDates[index].startsWith(date)));

            let datasets = [{
                    label: 'Nadi',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.nadi.reduce((a, b) => a + b, 0) / (groupedData[
                            key]?.nadi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(235, 125, 52, 0.2)',
                    borderColor: '#eb7d34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yNadi'
                },
                {
                    label: 'Suhu',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.temperature.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.temperature.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(52, 101, 235, 0.2)',
                    borderColor: '#3465eb',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTemperature'
                },
                {
                    label: 'SPO2',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.saturasi.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.saturasi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(18, 41, 105, 0.2)',
                    borderColor: '#122969',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'ySaturasi'
                },
                {
                    label: 'Sistole',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.tension_upper.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.tension_upper.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(61, 235, 52, 0.2)',
                    borderColor: '#3deb34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTension'
                },
                {
                    label: 'Diastole',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.tension_below.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.tension_below.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(61, 235, 52, 0.2)',
                    borderColor: '#3deb34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTension'
                },
                {
                    label: 'Respirasi',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.nadi.reduce((a, b) => a + b, 0) / (groupedData[
                            key]?.nadi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(230, 242, 5, 0.2)',
                    borderColor: '#e6f205',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yRespirasi'
                }
            ];

            const ctxChart = document.getElementById(`${props?.body_requestChart}`).getContext('2d');
            new Chart(ctxChart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    plugins: {
                        datalabels: false
                    },
                    scales: {
                        yNadi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Nadi'
                            }
                        },
                        yTemperature: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Suhu'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        ySaturasi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'SPO2'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        yTension: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Tekanan Darah'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        yRespirasi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Respirasi'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            });

            const tableBody = $(`#${props?.body_requestTabels}`);
            if (tableBody.length) {
                dataRendersTables = rawData.map(item => `
                                        <tr>
                                            <td>${moment(item?.examination_date).format('DD MMM YYYY HH:mm')}</td>
                                            <td>${item?.tension_upper ?? 0}</td>
                                            <td>${item?.tension_below?? 0}</td>
                                            <td>${item?.nadi?? 0}</td>
                                            <td>${item?.temperature?? 0}</td>
                                            <td>${item?.nafas?? 0}</td>
                                            <td>${item?.saturasi?? 0}</td>
                                            <td>${item?.pemeriksaan ?? "-"}</td>
                                            <td>${item?.petugas ?? "-"}</td>
                                        </tr>
                                    `).join('');

                tableBody.html(dataRendersTables);
            } else {
                console.log("Table body element not found.");
            }
        };

        const btnSaveLaporanAnestesiLengkap = (props) => {
            $("#btn-save-laporan-anesthesiLengkap").off().on("click", function(e) {

                e.preventDefault();
                // 

                let jsonObj = {
                    instrumen: [],
                    drain: [],
                    diagnosas: [],
                    bromage: [],
                    aldrete: [],
                    steward: [],
                    vitailsign: {},
                    vitailsign2: {}
                };

                const selects = document.querySelectorAll('#bromageContainer1 select');
                selects.forEach(select => {
                    // Use selectedOptions to get only the selected options
                    const selectedOptions = select.selectedOptions;
                    Array.from(selectedOptions).forEach(option => {
                        let entry = {
                            document_id: props?.vactination_id,
                            value_id: option.value,
                            p_type: 'OPRS024',
                            parameter_id: option.getAttribute('data-parameter'),
                            value_score: option.getAttribute('data-score'),
                            value_desc: option.getAttribute('data-desc')
                        };
                        jsonObj.bromage.push(entry);
                    });
                });


                $('#form-laporanAnesthesi-lengkap').find(':disabled').removeAttr('disabled');
                let formElement = document.getElementById('form-laporanAnesthesi-lengkap');
                let dataSend = new FormData(formElement);

                dataSend.forEach((value, key) => {
                    if (value) {
                        jsonObj[key] = value;
                    }
                    // if (moment(value, ['YYYY-MM-DDTHH:mm', 'DD/MM/YYYYTHH:mm'], true).isValid()) {
                    //     jsonObj[key] = moment(value, ['YYYY-MM-DDTHH:mm', 'DD/MM/YYYYTHH:mm']).format('YYYY-MM-DDTHH:mm');
                    // }
                });

                jsonObj['document_id'] = props.vactination_id;
                // Extract diagnosa fields
                let diag_cat = dataSend.getAll('diag_cat[]');
                let diag_id = dataSend.getAll('diag_id[]');
                let diag_name = dataSend.getAll('diag_name[]');
                let suffer_type = dataSend.getAll('suffer_type[]');

                jsonObj.diagnosa = [];

                for (let i = 0; i < diag_id.length; i++) {
                    let entry = {
                        diag_cat: diag_cat[i],
                        diag_id: diag_id[i],
                        diag_name: diag_name[i],
                        suffer_type: suffer_type[i],
                        pasien_diagnosa_id: dataSend.get('body_id')
                    };

                    jsonObj.diagnosa.push(entry);
                }


                ['diag_cat[]', 'diag_id[]', 'diag_name[]', 'suffer_type[]'].forEach(key => {
                    dataSend.getAll(key).forEach((_, i) => {
                        jsonObj[key.replace('[]', `[${i}]`)] =
                            undefined;
                    });
                });

                let InfusBodyId = get_bodyid();
                jsonObj.infusion = [];


                $('#recovery-room-oprs029').find('[name^="oprs029"]').each(function() {

                    if ($(this).is(':checkbox:checked') || $(this).is(':radio:checked')) {
                        let entry = {
                            org_unit_code: dataSend.get('org_unit_code'),
                            visit_id: dataSend.get('visit_id'),
                            trans_id: dataSend.get('trans_id'),
                            body_id: InfusBodyId,
                            document_id: props?.vactination_id,
                            p_type: 'OPRS029',
                            parameter_id: $(this).attr('name').split('_')[1] || '',
                            value_score: $(this).data('score'),
                            value_desc: $(this).data('desc'),
                            observation_date: '',
                            modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                            modified_by: dataSend.get('modified_by'),
                            value_id: $(this).val()
                        };
                        jsonObj.infusion.push(entry);
                    }
                    // Check if the element is a <select> option and is selected
                    else if ($(this).is('select')) {
                        let selectName = $(this).attr('name')
                        $(this).find('option:selected').each(function() {
                            var option = $(this);
                            var optionDataScore = option.data('score');
                            if (optionDataScore) {
                                let entry = {
                                    org_unit_code: dataSend.get('org_unit_code'),
                                    visit_id: dataSend.get('visit_id'),
                                    trans_id: dataSend.get('trans_id'),
                                    body_id: InfusBodyId,
                                    document_id: props?.vactination_id,
                                    p_type: 'OPRS029',
                                    parameter_id: selectName.split('_')[1] || '',
                                    value_score: optionDataScore,
                                    value_desc: $(this).data('desc'),
                                    observation_date: '',
                                    modified_date: moment().format(
                                        'YYYY-MM-DD HH:mm:ss'),
                                    modified_by: dataSend.get('modified_by'),
                                    value_id: $(this).val()
                                };
                                jsonObj.infusion.push(entry);
                            }
                        });
                    }
                    // Check if the element is a text input and its value is not empty
                    else if ($(this).is(':input[type="text"]')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue && $(this).data('score')) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: InfusBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS029',
                                parameter_id: $(this).attr('name').split('_')[1] || '',
                                value_score: '',
                                value_desc: $(this).data('desc'),
                                observation_date: '',
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: inputValue
                            };
                            jsonObj.infusion.push(entry);
                        }
                    } else if ($(this).is(':input[type="hidden"]')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue && $(this).data('score')) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: InfusBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS029',
                                parameter_id: $(this).attr('name').split('_')[1] || '',
                                value_score: '',
                                value_desc: $(this).data('desc'),
                                observation_date: '',
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: inputValue
                            };
                            jsonObj.infusion.push(entry);
                        }
                    }

                });
                let RegionalBodyId = get_bodyid();
                jsonObj.regional = [];

                $('#recovery-room-oprs033').find('[name^="oprs033"]').each(function() {

                    if ($(this).is(':checkbox:checked') || $(this).is(':radio:checked')) {
                        let entry = {
                            org_unit_code: dataSend.get('org_unit_code'),
                            visit_id: dataSend.get('visit_id'),
                            trans_id: dataSend.get('trans_id'),
                            body_id: RegionalBodyId,
                            document_id: props?.vactination_id,
                            p_type: 'OPRS033',
                            parameter_id: $(this).attr('name').split('_')[1] || '',
                            value_score: $(this).data('score'),
                            value_desc: $(this).data('desc'),
                            observation_date: '',
                            modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                            modified_by: dataSend.get('modified_by'),
                            value_id: $(this).val()
                        };
                        jsonObj.regional.push(entry);
                    }
                    // Check if the element is a <select> option and is selected
                    else if ($(this).is('select')) {
                        let selectName = $(this).attr('name')
                        $(this).find('option:selected').each(function() {
                            var option = $(this);
                            var optionDataScore = option.data('score');
                            if (optionDataScore) {
                                let entry = {
                                    org_unit_code: dataSend.get('org_unit_code'),
                                    visit_id: dataSend.get('visit_id'),
                                    trans_id: dataSend.get('trans_id'),
                                    body_id: RegionalBodyId,
                                    document_id: props?.vactination_id,
                                    p_type: 'OPRS033',
                                    parameter_id: selectName.split('_')[1] || '',
                                    value_score: optionDataScore,
                                    value_desc: $(this).data('desc'),
                                    observation_date: '',
                                    modified_date: moment().format(
                                        'YYYY-MM-DD HH:mm:ss'),
                                    modified_by: dataSend.get('modified_by'),
                                    value_id: $(this).val()
                                };
                                jsonObj.regional.push(entry);
                            }
                        });
                    }
                    // Check if the element is a text input and its value is not empty
                    else if ($(this).is(':input[type="text"]')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue && $(this).data('score')) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: RegionalBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS033',
                                parameter_id: $(this).attr('name').split('_')[1] || '',
                                value_score: '',
                                value_desc: $(this).data('desc'),
                                observation_date: '',
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: inputValue
                            };
                            jsonObj.regional.push(entry);
                        }
                    } else if ($(this).is(':input[type="hidden"]')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue && $(this).data('score')) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: RegionalBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS033',
                                parameter_id: $(this).attr('name').split('_')[1] || '',
                                value_score: '',
                                value_desc: $(this).data('desc'),
                                observation_date: '',
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: inputValue
                            };
                            jsonObj.regional.push(entry);
                        }
                    }

                });


                let GeneralBodyId = get_bodyid();
                jsonObj.general = [];

                $('#recovery-room-oprs030').find('[name^="oprs030"]').each(function() {

                    if ($(this).is(':checkbox:checked') || $(this).is(':radio:checked')) {
                        let entry = {
                            org_unit_code: dataSend.get('org_unit_code'),
                            visit_id: dataSend.get('visit_id'),
                            trans_id: dataSend.get('trans_id'),
                            body_id: GeneralBodyId,
                            document_id: props?.vactination_id,
                            p_type: 'OPRS030',
                            parameter_id: $(this).attr('name').split('_')[1] || '',
                            value_score: $(this).data('score'),
                            value_desc: $(this).data('desc'),
                            observation_date: '',
                            modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                            modified_by: dataSend.get('modified_by'),
                            value_id: $(this).val()
                        };
                        jsonObj.general.push(entry);
                    }
                    // Check if the element is a <select> option and is selected
                    else if ($(this).is('select')) {
                        let selectName = $(this).attr('name')
                        $(this).find('option:selected').each(function() {
                            var option = $(this);
                            var optionDataScore = option.data('score');
                            if (optionDataScore) {
                                let entry = {
                                    org_unit_code: dataSend.get('org_unit_code'),
                                    visit_id: dataSend.get('visit_id'),
                                    trans_id: dataSend.get('trans_id'),
                                    body_id: GeneralBodyId,
                                    document_id: props?.vactination_id,
                                    p_type: 'OPRS030',
                                    parameter_id: selectName.split('_')[1] || '',
                                    value_score: optionDataScore,
                                    value_desc: $(this).data('desc'),
                                    observation_date: '',
                                    modified_date: moment().format(
                                        'YYYY-MM-DD HH:mm:ss'),
                                    modified_by: dataSend.get('modified_by'),
                                    value_id: $(this).val()
                                };
                                jsonObj.general.push(entry);
                            }
                        });
                    }
                    // Check if the element is a text input and its value is not empty
                    else if ($(this).is(':input[type="text"]')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue && $(this).data('score')) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: GeneralBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS030',
                                parameter_id: $(this).attr('name').split('_')[1] || '',
                                value_score: '',
                                value_desc: $(this).data('desc'),
                                observation_date: '',
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: inputValue
                            };
                            jsonObj.general.push(entry);
                        }
                    } else if ($(this).is(':input[type="hidden"]')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue && $(this).data('score')) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: GeneralBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS030',
                                parameter_id: $(this).attr('name').split('_')[1] || '',
                                value_score: '',
                                value_desc: $(this).data('desc'),
                                observation_date: '',
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: inputValue
                            };
                            jsonObj.general.push(entry);
                        }
                    }

                });

                let VentilasiBodyId = get_bodyid();
                jsonObj.ventilasi = [];

                $('#recovery-room-oprs031').find('[name^="oprs031"]').each(function() {

                    if ($(this).is(':checkbox:checked') || $(this).is(':radio:checked')) {
                        let entry = {
                            org_unit_code: dataSend.get('org_unit_code'),
                            visit_id: dataSend.get('visit_id'),
                            trans_id: dataSend.get('trans_id'),
                            body_id: VentilasiBodyId,
                            document_id: props?.vactination_id,
                            p_type: 'OPRS031',
                            parameter_id: $(this).attr('name').split('_')[1] || '',
                            value_score: $(this).data('score'),
                            value_desc: $(this).data('desc'),
                            observation_date: '',
                            modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                            modified_by: dataSend.get('modified_by'),
                            value_id: $(this).val()
                        };
                        jsonObj.ventilasi.push(entry);
                    }
                    // Check if the element is a <select> option and is selected
                    else if ($(this).is('select')) {
                        let selectName = $(this).attr('name')
                        $(this).find('option:selected').each(function() {
                            var option = $(this);
                            var optionDataScore = option.data('score');
                            if (optionDataScore) {
                                let entry = {
                                    org_unit_code: dataSend.get('org_unit_code'),
                                    visit_id: dataSend.get('visit_id'),
                                    trans_id: dataSend.get('trans_id'),
                                    body_id: VentilasiBodyId,
                                    document_id: props?.vactination_id,
                                    p_type: 'OPRS031',
                                    parameter_id: selectName.split('_')[1] || '',
                                    value_score: optionDataScore,
                                    value_desc: $(this).data('desc'),
                                    observation_date: '',
                                    modified_date: moment().format(
                                        'YYYY-MM-DD HH:mm:ss'),
                                    modified_by: dataSend.get('modified_by'),
                                    value_id: $(this).val()
                                };
                                jsonObj.ventilasi.push(entry);
                            }
                        });
                    }
                    // Check if the element is a text input and its value is not empty
                    else if ($(this).is(':input[type="text"]')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue && $(this).data('score')) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: VentilasiBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS031',
                                parameter_id: $(this).attr('name').split('_')[1] || '',
                                value_score: '',
                                value_desc: $(this).data('desc'),
                                observation_date: '',
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: inputValue
                            };
                            jsonObj.ventilasi.push(entry);
                        }
                    } else if ($(this).is(':input[type="hidden"]')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue && $(this).data('score')) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: VentilasiBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS031',
                                parameter_id: $(this).attr('name').split('_')[1] || '',
                                value_score: '',
                                value_desc: $(this).data('desc'),
                                observation_date: '',
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: inputValue
                            };
                            jsonObj.ventilasi.push(entry);
                        }
                    }

                });


                let JalanNapasBodyId = get_bodyid();
                jsonObj.jalan_napas = [];

                $('#recovery-room-oprs032').find('[name^="oprs032"]').each(function() {

                    if ($(this).is(':checkbox:checked') || $(this).is(':radio:checked')) {
                        let entry = {
                            org_unit_code: dataSend.get('org_unit_code'),
                            visit_id: dataSend.get('visit_id'),
                            trans_id: dataSend.get('trans_id'),
                            body_id: JalanNapasBodyId,
                            document_id: props?.vactination_id,
                            p_type: 'OPRS032',
                            parameter_id: $(this).attr('name').split('_')[1] || '',
                            value_score: $(this).data('score'),
                            value_desc: $(this).data('desc'),
                            observation_date: '',
                            modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                            modified_by: dataSend.get('modified_by'),
                            value_id: $(this).val()
                        };
                        jsonObj.jalan_napas.push(entry);
                    }
                    // Check if the element is a <select> option and is selected
                    else if ($(this).is('select')) {
                        let selectName = $(this).attr('name')
                        $(this).find('option:selected').each(function() {
                            var option = $(this);
                            var optionDataScore = option.data('score');
                            if (optionDataScore) {
                                let entry = {
                                    org_unit_code: dataSend.get('org_unit_code'),
                                    visit_id: dataSend.get('visit_id'),
                                    trans_id: dataSend.get('trans_id'),
                                    body_id: JalanNapasBodyId,
                                    document_id: props?.vactination_id,
                                    p_type: 'OPRS032',
                                    parameter_id: selectName.split('_')[1] || '',
                                    value_score: optionDataScore,
                                    value_desc: $(this).data('desc'),
                                    observation_date: '',
                                    modified_date: moment().format(
                                        'YYYY-MM-DD HH:mm:ss'),
                                    modified_by: dataSend.get('modified_by'),
                                    value_id: $(this).val()
                                };
                                jsonObj.jalan_napas.push(entry);
                            }
                        });
                    }
                    // Check if the element is a text input and its value is not empty
                    else if ($(this).is(':input[type="text"]')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue && $(this).data('score')) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: JalanNapasBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS032',
                                parameter_id: $(this).attr('name').split('_')[1] || '',
                                value_score: '',
                                value_desc: $(this).data('desc'),
                                observation_date: '',
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: inputValue
                            };
                            jsonObj.jalan_napas.push(entry);
                        }
                    } else if ($(this).is(':input[type="hidden"]')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue && $(this).data('score')) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: JalanNapasBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS032',
                                parameter_id: $(this).attr('name').split('_')[1] || '',
                                value_score: '',
                                value_desc: $(this).data('desc'),
                                observation_date: '',
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: inputValue
                            };
                            jsonObj.jalan_napas.push(entry);
                        }
                    }

                });

                $('#bodyAldreteoprs023-1').find('tr').each(function(rowIndex, tr) {
                    let row = $(tr);
                    let AldreteBodyId = get_bodyid();

                    row.find('select[name^="parameter_oprs023_"]').each(function(selectIndex,
                        select) {
                        let selectElement = $(select);
                        let parameterId = selectElement.attr('name').split('_').pop();
                        let valueScore = selectElement.find('option:selected').data(
                            'score');
                        let valueDesc = selectElement.find('option:selected').text().trim();
                        let observationDate = row.find('.datetime-input').val();

                        valueDesc = valueDesc.replace(/\s+/g, ' ').trim();

                        if (selectElement) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: AldreteBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS023',
                                parameter_id: parameterId,
                                value_score: valueScore,
                                value_desc: valueDesc,
                                observation_date: observationDate,
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: selectElement.val()
                            };

                            jsonObj.aldrete.push(entry);
                        } else {
                            console.log(
                                "  Skipped entry due to missing parameterId or valueScore"
                            );
                        }
                    });
                });

                $('#stewardContainer1').find('tr').each(function(rowIndex, tr) {
                    let row = $(tr);
                    let StewardBodyId = get_bodyid();

                    row.find('select[name^="parameter_oprs025_"]').each(function(selectIndex,
                        select) {
                        let selectElement = $(select);
                        let parameterId = selectElement.attr('name').split('_').pop();
                        let valueScore = selectElement.find('option:selected').data(
                            'score');
                        let valueDesc = selectElement.find('option:selected').text().trim();
                        let observationDate = row.find('.datetime-input').val();

                        valueDesc = valueDesc.replace(/\s+/g, ' ').trim();

                        if (selectElement) {
                            let entry = {
                                org_unit_code: dataSend.get('org_unit_code'),
                                visit_id: dataSend.get('visit_id'),
                                trans_id: dataSend.get('trans_id'),
                                body_id: StewardBodyId,
                                document_id: props?.vactination_id,
                                p_type: 'OPRS025',
                                parameter_id: parameterId,
                                value_score: valueScore,
                                value_desc: valueDesc,
                                observation_date: observationDate,
                                modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                                modified_by: dataSend.get('modified_by'),
                                value_id: selectElement.val()
                            };

                            jsonObj.steward.push(entry);
                        } else {
                            console.log(
                                "  Skipped entry due to missing parameterId or valueScore"
                            );
                        }
                    });
                });

                const vitailSignKeys = ['vs_status_id', 'arm_diameter', 'nadi', 'nafas', 'height',
                    'saturasi', 'temperature', 'tension_below', 'tension_upper', 'examination_date',
                    'pemeriksaan', 'weight', 'oxygen_usage'
                ];
                const vitailSignKeys2 = ['vs_status_id2', 'arm_diameter2', 'nadi2', 'nafas2', 'height2',
                    'saturasi2', 'temperature2', 'tension_below2', 'tension_upper2',
                    'examination_date2',
                    'pemeriksaan2', 'weight2', 'oxygen_usage2'
                ];

                jsonObj.vitailsign = jsonObj.vitailsign || {};
                jsonObj.vitailsign2 = jsonObj.vitailsign2 || {};

                vitailSignKeys.forEach(key => {
                    jsonObj.vitailsign[key] = jsonObj[key];
                    delete jsonObj[key];
                });
                vitailSignKeys2.forEach(key => {
                    let inputElement = document.querySelector(
                        `#formvitalsign-laporanAnesthesi-lengkap3 [name="${key}"]`);
                    if (inputElement) {
                        if (inputElement.type === 'checkbox') {
                            jsonObj.vitailsign2[key] = inputElement.checked;
                        } else if (inputElement.type === 'radio') {
                            if (inputElement.checked) {
                                jsonObj.vitailsign2[key] = inputElement.value;
                            }
                        } else {
                            jsonObj.vitailsign2[key] = inputElement.value;
                        }
                    } else {
                        console.warn(`Input element for key ${key} not found.`);
                        jsonObj.vitailsign2[key] = null;
                    }
                });

                jsonObj.vitailsign['body_id'] = dataSend.get('body_id_durantee');
                jsonObj.vitailsign['clinic_id'] = 'P002';
                jsonObj.vitailsign['class_room_id'] = dataSend.get('class_room_id');
                jsonObj.vitailsign['bed_id'] = dataSend.get('bed_id');
                jsonObj.vitailsign['keluar_id'] = dataSend.get('keluar_id');
                jsonObj.vitailsign['employee_id'] = dataSend.get('employee_id');
                jsonObj.vitailsign['no_registration'] = dataSend.get('no_registration');
                jsonObj.vitailsign['visit_id'] = dataSend.get('visit_id');
                jsonObj.vitailsign['org_unit_code'] = dataSend.get('org_unit_code');
                jsonObj.vitailsign['doctor'] = dataSend.get('doctor');
                jsonObj.vitailsign['kal_id'] = dataSend.get('kal_id');
                jsonObj.vitailsign['theid'] = dataSend.get('theid');
                jsonObj.vitailsign['thename'] = dataSend.get('thename');
                jsonObj.vitailsign['theaddress'] = dataSend.get('theaddress');
                jsonObj.vitailsign['status_pasien_id'] = dataSend.get('status_pasien_id');
                jsonObj.vitailsign['isrj'] = dataSend.get('isrj');
                jsonObj.vitailsign['gender'] = dataSend.get('gender');
                jsonObj.vitailsign['ageyear'] = dataSend.get('ageyear');
                jsonObj.vitailsign['agemonth'] = dataSend.get('agemonth');
                jsonObj.vitailsign['ageday'] = dataSend.get('ageday');
                jsonObj.vitailsign['modified_by'] = dataSend.get('modified_by');
                jsonObj.vitailsign['trans_id'] = dataSend.get('trans_id');
                jsonObj.vitailsign['pasien_diagnosa_id'] = jsonObj['body_id']

                jsonObj.vitailsign2['body_id'] = dataSend.get('body_id');
                jsonObj.vitailsign2['clinic_id'] = 'P002';
                jsonObj.vitailsign2['class_room_id'] = dataSend.get('class_room_id');
                jsonObj.vitailsign2['bed_id'] = dataSend.get('bed_id');
                jsonObj.vitailsign2['keluar_id'] = dataSend.get('keluar_id');
                jsonObj.vitailsign2['employee_id'] = dataSend.get('employee_id');
                jsonObj.vitailsign2['no_registration'] = dataSend.get('no_registration');
                jsonObj.vitailsign2['visit_id'] = dataSend.get('visit_id');
                jsonObj.vitailsign2['org_unit_code'] = dataSend.get('org_unit_code');
                jsonObj.vitailsign2['doctor'] = dataSend.get('doctor');
                jsonObj.vitailsign2['kal_id'] = dataSend.get('kal_id');
                jsonObj.vitailsign2['theid'] = dataSend.get('theid');
                jsonObj.vitailsign2['thename'] = dataSend.get('thename');
                jsonObj.vitailsign2['theaddress'] = dataSend.get('theaddress');
                jsonObj.vitailsign2['status_pasien_id'] = dataSend.get('status_pasien_id');
                jsonObj.vitailsign2['isrj'] = dataSend.get('isrj');
                jsonObj.vitailsign2['gender'] = dataSend.get('gender');
                jsonObj.vitailsign2['ageyear'] = dataSend.get('ageyear');
                jsonObj.vitailsign2['agemonth'] = dataSend.get('agemonth');
                jsonObj.vitailsign2['ageday'] = dataSend.get('ageday');
                jsonObj.vitailsign2['modified_by'] = dataSend.get('modified_by');
                jsonObj.vitailsign2['trans_id'] = dataSend.get('trans_id');
                jsonObj.vitailsign2['pasien_diagnosa_id'] = jsonObj['body_id']

                jsonObj.post_anesthesia = {};


                const postAnesthesiaKeys = [
                    'bp_medicine', 'fasting', 'infus', 'infus_volume', 'meal', 'mealtime',
                    'oxygen', 'postan_position', 'respiratory_interval', 'transfusion',
                    'vomitus_medicine',
                    'postan_plan', 'oxygen_method', 'recovery_leave_time', 'patient_destination'
                ];

                // Populate jsonObj.post_anesthesia with key-value pairs
                postAnesthesiaKeys.forEach(key => {
                    jsonObj.post_anesthesia[key] = dataSend.get(key);
                    delete jsonObj[key];
                });



                $("#loading-indicator").show();
                console.log(jsonObj);
                postData(jsonObj, 'admin/PatientOperationRequest/insertAnestesiaLengkap', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');
                        $("#create-modal-permintaan-operasi").modal("hide");

                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id
                        });
                        $("#loading-indicator").hide();
                    } else {
                        errorSwal('Data gagal diperbarui. Silakan coba lagi.');
                        $("#loading-indicator").hide();
                    }
                }, (beforesend) => {
                    console.log("Request is being sent...");
                }, (error) => {
                    console.error("Error occurred:", error);
                    errorSwal('Terjadi kesalahan. Silakan coba lagi.');
                    $("#loading-indicator").hide();
                });
            });
        } // new 01/08



        //new 1/08


        // ALL RENDER & TEMPLATE
        const renderDataVitailSign = (data, suffix) => {
            if (!data) {
                console.warn('No data available for rendering vitalsign.');
                return;
            }

            const baseMappings = {
                examination_date: 'examination_date',
                vs_status_id: 'vs_status_id',
                arm_diameter: 'arm_diameter',
                nadi: 'nadi',
                nafas: 'nafas',
                height: 'height',
                saturasi: 'saturasi',
                temperature: 'temperature',
                tension_below: 'tension_below',
                tension_upper: 'tension_upper',
                pemeriksaan: 'pemeriksaan',
                weight: 'weight',
                oxygen_usage: 'oxygen_usage'
            };

            Object.keys(baseMappings).forEach(key => {
                const baseName = baseMappings[key];
                const selector = `#avt${baseName}${suffix}`;
                const value = data[key] || '';

                $(selector).val(value);
            });
        }; //new update 30/07


        const actionButtonAddOperation = (visit) => {
            $("#btn-create-operasi").off().on("click", (e) => {
                e.preventDefault();

                $("#dropdown-param-tindakan-operasi").html("");

                $("#create-modal-permintaan-operasi").modal("show");
                $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(visit));
                $("#formDate-tindakan-oprasi-2").html("").attr("class", "col-md-1")
                // $('#form-permintaan-operasi')[0].reset();

                $('#btn-save-permintaan-operasi-modal').attr('hidden', false);
                $('#btn-edit-permintaan-operasi-modal').attr('hidden', true);
                $('#btn-updateAndInsert-permintaan-operasi-modal').attr('hidden', true);

                $('#vactination_id-permintaan_operasi').val(generateCode());
                $("#trans_id-permintaan_operasi").val(visit?.trans_id)
                $('#org_unit_code-permintaan_operasi').val(visit.org_unit_code);
                $('#visit_id-permintaan_operasi').val(visit.visit_id);
                $('#no_registration-permintaan_operasi').val(visit.no_registration);
                $('#vactination_date-permintaan_operasi').val(moment().format(
                    "YYYY/MM/DD HH:mm"));
                $('#description-permintaan_operasi').val(visit.description);
                $('#employee_id-permintaan_operasi').val(visit.employee_id);
                $('#doctor-permintaan_operasi').val(visit.fullname ?? visit.doctor);
                $('#anestesi_type-permintaan_operasi').val(visit.anestesi_type);
                $('#modified_date-permintaan_operasi').val(moment().format("YYYY/MM/DDTHH:mm"));
                $('#modified_by-permintaan_operasi').val();
                $('#validation-permintaan_operasi').val(visit.validation);
                $('#terlayani-permintaan_operasi').val();
                $('#thename-permintaan_operasi').val(visit.diantar_oleh);
                $('#theaddress-permintaan_operasi').val(visit.contact_address);
                $('#theid-permintaan_operasi').val(visit.pasien_id);
                $('#isrj-permintaan_operasi').val(visit.isrj);
                $('#status_pasien_id-permintaan_operasi').val(visit.status_pasien_id);
                $('#gender-permintaan_operasi').val(visit.gender);
                $('#ageyear-permintaan_operasi').val(visit.ageyear);
                $('#agemonth-permintaan_operasi').val(visit.agemonth);
                $('#ageday-permintaan_operasi').val(visit.ageday);
                $('#bed_id-permintaan_operasi').val(visit.bed_id);
                $('#keluar_id-permintaan_operasi').val(visit.keluar_id);
                $('#diagnosa_pra-permintaan_operasi').val(visit.diagnosa_pra);
                $('#diagnosa_pasca-permintaan_operasi').val(visit.diagnosa_pasca);
                $('#end_operation-permintaan_operasi').val();
                $('#start_anestesi-permintaan_operasi').val(visit.start_anestesi);
                $('#end_anestesi-permintaan_operasi').val(visit.end_anestesi);
                $('#result_id-permintaan_operasi').val(visit.result_id);
                $('#clinic_id-permintaan_operasi').val("P002");
                $('#transaksi-permintaan_operasi').val(0);
                $('#layan-permintaan_operasi').val(visit.layan);
                let currentDateTime = moment(new Date()).format("DD/MM/YYYY HH:mm")
                $("#flatstart_operation-permintaan_operasi").val(currentDateTime).trigger("change");
                $("#start_operation-permintaan_operasi").val(moment($(
                    "#flatstart_operation-permintaan_operasi").val(), ["YYYY-MM-DD HH:mm",
                    "DD/MM/YYYY HH:mm"
                ]).format("DD-MM-YYYY HH:mm"))
                $('#rooms_id-permintaan_operasi').val(visit?.rooms_id);
                $('#clinic_id_from-permintaan_operasi').val("P002");
                $('#class_room_id-permintaan_operasi').val(visit.class_room_id);
                const categoryId = visit.patient_category_id ?? 0;

                $('#patient_category_id-elektif').prop('checked', categoryId === 0);
                $('#patient_category_id-cyto').prop('checked', categoryId === 1);
                $('#patient_category_id-emergency').prop('checked', categoryId === 2);


                $('#operation_type-permintaan_operasi').val("");


                getDataColumnName({
                    table_name: 'class_room',
                    column_name: 'name_of_class',
                    column_id: 'class_room_id',
                    id: visit.class_room_id,
                    element_id: 'class_room_id-permintaan_operasi_name'
                })
                getDataColumnName({
                    table_name: 'clinic',
                    column_name: 'name_of_clinic',
                    column_id: 'clinic_id',
                    id: "visit.clinic_id",
                    element_id: 'clinic_id_from-permintaan_operasi_name'
                })



                $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {
                    let treatmentData = renderDropdownTreatment();
                    $('#tarif_id-permintaan_operasi').select2({
                        data: treatmentData,
                        disabled: false,
                        dropdownParent: $('#create-modal-permintaan-operasi')
                    });
                    initializeFlatpickrOperasi()
                    initializeQuillEditors();
                });

                initializeQuillEditors();
                actionDropdownSpesialisas();
                btnSaveActionRequestOperation(visit);
            });
        }

        function formatToIDRResult(value) {
            const parsedValue = Math.floor(parseFloat(value));
            return parsedValue.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
        }

        const renderDropdownTreatment = () => {
            let data = treatmentData;

            let result = "";
            data.forEach((item) => {
                result +=
                    `<option value="${item.tarif_id}" data-operation-type="${item.operation_type}">${item.tarif_name} (${item?.name_of_class} - ${formatToIDRResult(item?.amount_paid ?? 0)})</option>`;
            });

            $("#tarif_id-permintaan_operasi").html(
                `<option selected disabled value="">Pilih Tindakan</option>` +
                result);
        };

        const getTemplatePermintaanOperasi = () => {
            return `<div hidden>
                <div class="form-group">
                    <label for="org_unit_code-permintaan_operasi">Org Unit Code</label>
                    <input class="form-control disabled" id="org_unit_code-permintaan_operasi" name="org_unit_code" >
                    <input class="form-control disabled" id="trans_id-permintaan_operasi" name="trans_id"></input>

                </div>
                <div class="form-group">
                    <label for="visit_id-permintaan_operasi">Visit ID</label>
                    <input class="form-control disabled" id="visit_id-permintaan_operasi" name="visit_id" >
                </div>
                <div class="form-group">
                    <label for="vactination_id-permintaan_operasi">Vaccination ID</label>
                    <input class="form-control disabled" id="vactination_id-permintaan_operasi" name="vactination_id" >
                </div>
                <div class="form-group">
                    <label for="no_registration-permintaan_operasi">No Registration</label>
                    <input class="form-control disabled" id="no_registration-permintaan_operasi" name="no_registration" >
                </div>
                <div class="form-group">
                    <label for="vactination_date-permintaan_operasi">Vaccination Date</label>
                    <input class="form-control disabled" id="vactination_date-permintaan_operasi" name="vactination_date" >
                </div>
                <div class="form-group">
                    <label for="description-permintaan_operasi">Description</label>
                    <input class="form-control disabled" id="description-permintaan_operasi" name="description" >
                </div>
                <div class="form-group">
                    <label for="employee_id-permintaan_operasi">Employee ID</label>
                    <input class="form-control disabled" id="employee_id-permintaan_operasi" name="employee_id">
                </div>
                <div class="form-group">
                    <label for="doctor-permintaan_operasi">Doctor</label>
                    <input class="form-control disabled" id="doctor-permintaan_operasi" name="doctor" >
                </div>
                <div class="form-group">
                    <label for="anestesi_type-permintaan_operasi">Anestesi Type</label>
                    <input class="form-control disabled" id="anestesi_type-permintaan_operasi" name="anestesi_type">
                </div>
                <div class="form-group">
                    <label for="modified_date-permintaan_operasi">Modified Date</label>
                    <input class="form-control disabled" id="modified_date-permintaan_operasi" name="modified_date" >
                </div>
                <div class="form-group">
                    <label for="modified_by-permintaan_operasi">Modified By</label>
                    <input class="form-control disabled" id="modified_by-permintaan_operasi" name="modified_by">
                </div>
                
                <div class="form-group">
                    <label for="validation-permintaan_operasi">Validation</label>
                    <input class="form-control disabled" id="validation-permintaan_operasi" name="validation" value='0'>
                </div>
                <div class="form-group">
                    <label for="terlayani-permintaan_operasi">Terlayani</label>
                    <input class="form-control disabled" id="terlayani-permintaan_operasi" name="terlayani" value='0'>
                </div>
               
                <div class="form-group">
                    <label for="thename-permintaan_operasi">Thename</label>
                    <input class="form-control disabled" id="thename-permintaan_operasi" name="thename" >
                </div>
                <div class="form-group">
                    <label for="theaddress-permintaan_operasi">Theaddress</label>
                    <input class="form-control disabled" id="theaddress-permintaan_operasi" name="theaddress" >
                </div>
                <div class="form-group">
                    <label for="theid-permintaan_operasi">Theid</label>
                    <input class="form-control disabled" id="theid-permintaan_operasi" name="theid" >
                </div>
                <div class="form-group">
                    <label for="isrj-permintaan_operasi">Isrj</label>
                    <input class="form-control disabled" id="isrj-permintaan_operasi" name="isrj" >
                </div>
                <div class="form-group">
                    <label for="status_pasien_id-permintaan_operasi">Status Pasien ID</label>
                    <input class="form-control disabled" id="status_pasien_id" name="status_pasien_id" >
                </div>
                <div class="form-group">
                    <label for="gender-permintaan_operasi">Gender</label>
                    <input class="form-control disabled" id="gender-permintaan_operasi" name="gender" >
                </div>
                <div class="form-group">
                    <label for="ageyear-permintaan_operasi">Age Year</label>
                    <input class="form-control disabled" id="ageyear-permintaan_operasi" name="ageyear" >
                </div>
                <div class="form-group">
                    <label for="agemonth-permintaan_operasi">Age Month</label>
                    <input class="form-control disabled" id="agemonth-permintaan_operasi" name="agemonth" >
                </div>
                <div class="form-group">
                    <label for="ageday-permintaan_operasi">Age Day</label>
                    <input class="form-control disabled" id="ageday-permintaan_operasi" name="ageday" >
                </div>
                
                <div class="form-group">
                    <label for="bed_id-permintaan_operasi">Bed ID</label>
                    <input class="form-control disabled" id="bed_id-permintaan_operasi" name="bed_id" >
                </div>
                <div class="form-group">
                    <label for="keluar_id-permintaan_operasi">Keluar ID</label>
                    <input class="form-control disabled" id="keluar_id-permintaan_operasi" name="keluar_id" >
                </div>
                
                <div class="form-group">
                    <label for="diagnosa_pra-permintaan_operasi">Diagnosa Pra</label>
                    <input class="form-control disabled" id="diagnosa_pra-permintaan_operasi" name="diagnosa_pra" >
                </div>
                <div class="form-group">
                    <label for="diagnosa_pasca-permintaan_operasi">Diagnosa Pasca</label>
                    <input class="form-control disabled" id="diagnosa_pasca-permintaan_operasi" name="diagnosa_pasca" >
                </div>
               
                <!---<div class="form-group">
                    <label for="end_operation-permintaan_operasi">End Operation</label>
                    <input class="form-control disabled" id="end_operation-permintaan_operasi" name="end_operation" >
                </div>--->
                <div class="form-group">
                    <label for="start_anestesi-permintaan_operasi">Start Anestesi</label>
                    <input class="form-control disabled" id="start_anestesi-permintaan_operasi" name="start_anestesi" >
                </div>
                <div class="form-group">
                    <label for="end_anestesi-permintaan_operasi">End Anestesi</label>
                    <input class="form-control disabled" id="end_anestesi-permintaan_operasi" name="end_anestesi" >
                </div>
                <div class="form-group">
                    <label for="result_id-permintaan_operasi">Result ID</label>
                    <input class="form-control disabled" id="result_id-permintaan_operasi" name="result_id" >
                </div>
                <div class="form-group">
                    <label for="clinic_id-permintaan_operasi">Clinic ID</label>
                    <input class="form-control disabled" id="clinic_id-permintaan_operasi" name="clinic_id" >
                </div>
               <div class="form-group">
                    <label for="transaksi-permintaan_operasi">Transaksi</label>
                    <input class="form-control disabled" id="transaksi-permintaan_operasi" name="transaksi" value='0'>
                </div>
                <div class="form-group">
                    <label for="layan-permintaan_operasi">Layan</label>
                    <input class="form-control disabled" id="layan-permintaan_operasi" name="layan" value='0'>
                </div>
                
            </div>
            <div>
                <h3 class="text-center">Penjadwalan Operasi</h3>

                <!-- Grup 1: Tanggal/Jam Operasi -->
                <div class="row form-group pt-3">
                    <div class="col-md-4" id="formDate-tindakan-oprasi-1">
                        <label for="start_operation-permintaan_operasi">Tanggal/Jam Operasi</label>
                        <input id="start_operation-permintaan_operasi" name="start_operation" type="hidden" class="form-control" placeholder="yyyy-mm-dd HH:mm ">
                        <input class="form-control datetimeflatpickr" type="text" id="flatstart_operation-permintaan_operasi" >
                    </div>
                    <div class="col-md-6" id="formDate-tindakan-oprasi-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_operation-range">Tanggal/Jam Operasi</label>
                                      <input id="start_operation-permintaan_operasi" name="start_operation" type="hidden" class="form-control" placeholder="yyyy-mm-dd">
                                    <input class="form-control datetimeflatpickr" type="text" id="flatstart_operation-permintaan_operasi" >
                                    </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end justify-content-center">
                                <div class="form-group">
                                    <span>S.d</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_operation-permintaan_operasi">&nbsp;</label>
                                    <input id="end_operation-permintaan_operasi" name="end_operation" type="hidden" class="form-control" placeholder="yyyy-mm-dd">
                                    <input class="form-control  datetimeflatpickr" type="text" id="flatend_operation-permintaan_operasi" name="end_operation">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="rooms_id-permintaan_operasi">Ruang Operasi</label>
                        <input class="form-select disabled" id="rooms_id-permintaan_operasi" name="rooms_id" disabled>
                    </div>
                </div>

                <!-- Grup 2: Pelayanan dan Bangsal -->
                <div class="row form-group pt-3">
                    <div class="col-md-4">
                        <label for="clinic_id_from-permintaan_operasi">Pelayanan</label>
                        <input class="form-control" disabled id="clinic_id_from-permintaan_operasi" name="clinic_id_from" hidden>
                        <input class="form-control" disabled id="clinic_id_from-permintaan_operasi_name" name="clinic_id_fromm">
                    </div>
                    <div class="col-md-4">
                        <label for="class_room_id-permintaan_operasi">Bangsal</label>
                        <input class="form-control disabled" id="class_room_id-permintaan_operasi" name="class_room_id" disabled hidden>
                        <input class="form-control disabled" id="class_room_id-permintaan_operasi_name" name="class_room_idd" disabled >
                    </div>
                    <div class="col-md-4">
                        <label>Emergency / Elektif</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="patient_category_id-elektif" name="patient_category_id" value="0" checked>
                            <label class="form-check-label" for="patient_category_id-elektif">Elektif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="patient_category_id-cyto" name="patient_category_id" value="1">
                            <label class="form-check-label" for="patient_category_id-cyto">Cyto</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="patient_category_id-emergency" name="patient_category_id" value="2">
                            <label class="form-check-label" for="patient_category_id-emergency">Emergency</label>
                        </div>
                    </div>
                    
                </div>

                <!-- Grup 3: Emergency / Elektif -->
                <div class="row form-group">
                    
                </div>

                <!-- Grup 4: Tim Operasi -->
                <h3 class="text-center">Tim Operasi</h3>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="operation_type-permintaan_operasi">Sub Spesialisas</label>
                        <input class="form-control disabled" id="operation_type-permintaan_operasi" name="operation_type" disabled value="" hidden>
                        <input class="form-control disabled" id="operation_type_name-permintaan_operasi" name="operation_type_name" disabled value="">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="tarif_id-permintaan_operasi">Tindakan Operasi</label>
                        <select class="form-control select2" id="tarif_id-permintaan_operasi" name="tarif_id" required>
                            <!-- Option elements here -->
                        </select>
                    </div>
                </div>

                <div class="row form-group mb-3 pb-5">
                    <div class="col-md-12">
                        <label for="diagnosa_desc-permintaan_operasi">Diagnosis</label>
                        <textarea class="form-control quill-editor disabled" id="diagnosa_desc-permintaan_operasi" name="diagnosa_desc"></textarea>
                    </div>
                </div>
            </div>
            `
        }

        const modalViewDetailRequestOperation = (data) => {

            let resultData = data;
            let result = resultData.data[0];

            $("#dropdown-param-tindakan-operasi").html("");
            $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(result));
            $("#formDate-tindakan-oprasi-2").html("").attr("class", "col-md-1")
            $("#create-modal-permintaan-operasi").modal("show");
            $('#btn-save-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-edit-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-updateAndInsert-permintaan-operasi-modal').attr('hidden', true);

            $('#org_unit_code-permintaan_operasi').val(result.org_unit_code);
            $('#visit_id-permintaan_operasi').val(result.visit_id);
            $('#no_registration-permintaan_operasi').val(result.no_registration);
            $('#vactination_date-permintaan_operasi').val(moment(result?.vactination_date).format(
                "YYYY/MM/DD HH:mm"));
            $('#description-permintaan_operasi').val(result.description);
            $('#employee_id-permintaan_operasi').val(result.employee_id);
            $('#doctor-permintaan_operasi').val(result.fullname);
            $('#anestesi_type-permintaan_operasi').val(result.anestesi_type);
            $('#modified_date-permintaan_operasi').val(moment(result?.modified_date).format(
                "YYYY/MM/DD HH:mm"));
            $('#modified_by-permintaan_operasi').val(result?.modified_by);
            $('#validation-permintaan_operasi').val(result.validation);
            $('#terlayani-permintaan_operasi').val(result.terlayani);
            $('#thename-permintaan_operasi').val(result.thename);
            $('#theaddress-permintaan_operasi').val(result.theaddress);
            $('#theid-permintaan_operasi').val(result.theid);
            $('#isrj-permintaan_operasi').val(result.isrj);
            $('#status_pasien_id-permintaan_operasi').val(result.status_pasien_id);
            $('#gender-permintaan_operasi').val(result.gender);
            $('#ageyear-permintaan_operasi').val(result.ageyear);
            $('#agemonth-permintaan_operasi').val(result.agemonth);
            $('#ageday-permintaan_operasi').val(result.ageday);
            $('#bed_id-permintaan_operasi').val(result.bed_id);
            $('#keluar_id-permintaan_operasi').val(result.keluar_id);
            $('#diagnosa_pra-permintaan_operasi').val(result.diagnosa_pra);
            $('#diagnosa_pasca-permintaan_operasi').val(result.diagnosa_pasca);
            $('#end_operation-permintaan_operasi').val(result.end_operation)
            $('#start_anestesi-permintaan_operasi').val(result.start_anestesi);
            $('#end_anestesi-permintaan_operasi').val(result.end_anestesi);
            $('#result_id-permintaan_operasi').val(result.result_id);
            $('#clinic_id-permintaan_operasi').val(result.clinic_id);
            $('#transaksi-permintaan_operasi').val(result.transaksi);
            $('#layan-permintaan_operasi').val(result.layan);
            let currentDateTime = moment(new Date(result.start_operation)).format("DD/MM/YYYY HH:mm")
            $("#flatstart_operation-permintaan_operasi").val(currentDateTime).trigger("change");
            $('#rooms_id-permintaan_operasi').val(result?.rooms_id);
            $('#clinic_id_from-permintaan_operasi').val(result.clinic_id);
            $('#class_room_id-permintaan_operasi').val(result.class_room_id);

            $('#patient_category_id-elektif').prop('checked', visit.patient_category_id === 0);
            $('#patient_category_id-cyto').prop('checked', visit.patient_category_id === 1);
            $('#patient_category_id-emergency').prop('checked', visit.patient_category_id === 2);

            $('#operation_type-permintaan_operasi').val(result.operation_type);
            $('#vactination_id-permintaan_operasi').val(result.vactination_id);
            $("#trans_id-permintaan_operasi").val(result?.trans_id)
            $("#flatstart_operation-permintaan_operasi").attr("disabled", true)

            $('#patient_category_id-elektif').attr("disabled", true)
            $('#patient_category_id-cyto').attr("disabled", true)
            $('#patient_category_id-emergency').attr("disabled", true)
            const foundData = treatmentData.find(item => item.operation_type === `${result.operation_type}`);

            $("#operation_type_name-permintaan_operasi").val(foundData?.treatment);

            getDataColumnName({
                table_name: 'class_room',
                column_name: 'name_of_class',
                column_id: 'class_room_id',
                id: result.class_room_id,
                element_id: 'class_room_id-permintaan_operasi_name'
            })
            getDataColumnName({
                table_name: 'clinic',
                column_name: 'name_of_clinic',
                column_id: 'clinic_id',
                id: result.clinic_id,
                element_id: 'clinic_id_from-permintaan_operasi_name'
            })


            $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {
                $('#tarif_id-permintaan_operasi').select2({
                    disabled: true
                });
                $('#tarif_id-permintaan_operasi').val(result.tarif_id).trigger('change');
                initializeFlatpickrOperasi()
                initializeQuillEditors();
            });
            initializeQuillEditors();
        };

        const modalViewEditRequestOperation = (data) => {
            let resultData = data;
            let result = resultData.data[0];

            $("#dropdown-param-tindakan-operasi").html("");
            $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(result));
            $("#formDate-tindakan-oprasi-2").html("").attr("class", "col-md-1")
            $("#create-modal-permintaan-operasi").modal("show");
            $('#btn-save-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-edit-permintaan-operasi-modal').attr('hidden', false);
            $('#btn-updateAndInsert-permintaan-operasi-modal').attr('hidden', true);


            $('#vactination_id-permintaan_operasi').val(result.vactination_id);
            $("#trans_id-permintaan_operasi").val(result?.trans_id)
            $('#org_unit_code-permintaan_operasi').val(result.org_unit_code);
            $('#visit_id-permintaan_operasi').val(result.visit_id);
            $('#no_registration-permintaan_operasi').val(result.no_registration);
            $('#vactination_date-permintaan_operasi').val(moment(result?.vactination_date).format(
                "YYYY/MM/DD HH:mm"));
            $('#description-permintaan_operasi').val(result.description);
            $('#employee_id-permintaan_operasi').val(result.employee_id);
            $('#doctor-permintaan_operasi').val(result?.fullname ?? result?.doctor);
            $('#anestesi_type-permintaan_operasi').val(result.anestesi_type);
            $('#modified_date-permintaan_operasi').val(moment(result?.modified_date).format(
                "YYYY/MM/DD HH:mm"));
            $('#modified_by-permintaan_operasi').val(result?.modified_by);
            $('#validation-permintaan_operasi').val(result.validation);
            $('#terlayani-permintaan_operasi').val(result.terlayani);
            $('#thename-permintaan_operasi').val(result.thename);
            $('#theaddress-permintaan_operasi').val(result.theaddress);
            $('#theid-permintaan_operasi').val(result.theid);
            $('#isrj-permintaan_operasi').val(result.isrj);
            $('#status_pasien_id-permintaan_operasi').val(result.status_pasien_id);
            $('#gender-permintaan_operasi').val(result.gender);
            $('#ageyear-permintaan_operasi').val(result.ageyear);
            $('#agemonth-permintaan_operasi').val(result.agemonth);
            $('#ageday-permintaan_operasi').val(result.ageday);
            $('#bed_id-permintaan_operasi').val(result.bed_id);
            $('#keluar_id-permintaan_operasi').val(result.keluar_id);
            $('#diagnosa_pra-permintaan_operasi').val(result.diagnosa_pra);
            $('#diagnosa_pasca-permintaan_operasi').val(result.diagnosa_pasca);
            $('#end_operation-permintaan_operasi').val(result.end_operation)
            $('#start_anestesi-permintaan_operasi').val(result.start_anestesi);
            $('#end_anestesi-permintaan_operasi').val(result.end_anestesi);
            $('#result_id-permintaan_operasi').val(result.result_id);
            $('#clinic_id-permintaan_operasi').val(result.clinic_id);
            $('#transaksi-permintaan_operasi').val(result.transaksi);
            $('#layan-permintaan_operasi').val(result.layan);
            let currentDateTime = moment(new Date(result.start_operation)).format("DD/MM/YYYY HH:mm")
            $("#start_operation-permintaan_operasi").val(moment(currentDateTime).format("YYYY-MM-DD HH:mm"))
            $("#flatstart_operation-permintaan_operasi").val(currentDateTime).trigger("change");
            $('#rooms_id-permintaan_operasi').val(result?.rooms_id);
            $('#clinic_id_from-permintaan_operasi').val(result.clinic_id);
            $('#class_room_id-permintaan_operasi').val(result.class_room_id);
            $('#patient_category_id-elektif').prop('checked', result.patient_category_id === 0);
            $('#patient_category_id-cyto').prop('checked', result.patient_category_id === 1);
            $('#patient_category_id-emergency').prop('checked', result.patient_category_id === 2);

            $('#operation_type-permintaan_operasi').val(result.operation_type);

            const foundData = treatmentData.find(item => item.operation_type === `${result.operation_type}`);

            $("#operation_type_name-permintaan_operasi").val(foundData?.treatment);
            getDataColumnName({
                table_name: 'class_room',
                column_name: 'name_of_class',
                column_id: 'class_room_id',
                id: result.class_room_id,
                element_id: 'class_room_id-permintaan_operasi_name'
            })
            getDataColumnName({
                table_name: 'clinic',
                column_name: 'name_of_clinic',
                column_id: 'clinic_id',
                id: result.clinic_id,
                element_id: 'clinic_id_from-permintaan_operasi_name'
            })



            $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {
                let treatmentData = renderDropdownTreatment();

                $('#tarif_id-permintaan_operasi').select2({
                    data: treatmentData,
                    disabled: false,
                    dropdownParent: $('#create-modal-permintaan-operasi')
                });

                $('#tarif_id-permintaan_operasi').val(result.tarif_id).trigger('change');
                initializeFlatpickrOperasi()
                initializeQuillEditors();
            });
            initializeFlatpickrOperasi()
            initializeQuillEditors();
            btnUpdateDataRequestOperation(result)
        };

        const modalViewOperationAction = (data) => {
            let resultData = data;
            let result = resultData.data[0];
            getDataDropdownAllemployee({
                vactination_id: result.vactination_id,
                transaksi: result?.transaksi,
                terlayani: result?.terlayani

            })

            let currentDateTime = moment(new Date(result.start_operation)).format("DD/MM/YYYY HH:mm")

            let currentDateTimeEnd = moment(result?.end_operation ? new Date(result?.end_operation) : new Date())
                .format("DD/MM/YYYY HH:mm");

            $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(result));
            $("#formDate-tindakan-oprasi-1").html("").attr("class", "");

            $("#create-modal-permintaan-operasi").modal("show");
            $('#btn-save-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-edit-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-updateAndInsert-permintaan-operasi-modal').attr('hidden', false);

            // Set the rest of the fields
            $('#vactination_id-permintaan_operasi').val(result.vactination_id);
            $("#trans_id-permintaan_operasi").val(result?.trans_id)

            $('#org_unit_code-permintaan_operasi').val(result.org_unit_code);
            $('#visit_id-permintaan_operasi').val(result.visit_id);
            $('#no_registration-permintaan_operasi').val(result.no_registration);
            $('#vactination_date-permintaan_operasi').val(moment(result.vactination_date).format(
                "YYYY/MM/DD HH:mm"));
            $('#description-permintaan_operasi').val(result.description);
            $('#employee_id-permintaan_operasi').val(result.employee_id);
            $('#doctor-permintaan_operasi').val(result.fullname ?? result.doctor);
            $('#anestesi_type-permintaan_operasi').val(result.anestesi_type);
            $('#modified_date-permintaan_operasi').val(moment(result.modified_date).format(
                "YYYY/MM/DD HH:mm"));
            $('#modified_by-permintaan_operasi').val(result.modified_by);
            $('#validation-permintaan_operasi').val(result.validation);
            $('#terlayani-permintaan_operasi').val(result.terlayani);
            $('#thename-permintaan_operasi').val(result.thename);
            $('#theaddress-permintaan_operasi').val(result.theaddress);
            $('#theid-permintaan_operasi').val(result.theid);
            $('#isrj-permintaan_operasi').val(result.isrj);
            $('#status_pasien_id-permintaan_operasi').val(result.status_pasien_id);
            $('#gender-permintaan_operasi').val(result.gender);
            $('#ageyear-permintaan_operasi').val(result.ageyear);
            $('#agemonth-permintaan_operasi').val(result.agemonth);
            $('#ageday-permintaan_operasi').val(result.ageday);
            $('#bed_id-permintaan_operasi').val(result.bed_id);
            $('#keluar_id-permintaan_operasi').val(result.keluar_id);
            $('#diagnosa_pra-permintaan_operasi').val(result.diagnosa_pra);
            $('#diagnosa_pasca-permintaan_operasi').val(result.diagnosa_pasca);

            $('#start_anestesi-permintaan_operasi').val(result.start_anestesi);
            $('#end_anestesi-permintaan_operasi').val(result.end_anestesi);
            $('#result_id-permintaan_operasi').val(result.result_id);
            $('#clinic_id-permintaan_operasi').val(result.clinic_id);
            $('#layan-permintaan_operasi').val(result.layan);

            $("#start_operation-permintaan_operasi").val(moment(currentDateTime).format("YYYY-MM-DD HH:mm"))
            $("#end_operation-permintaan_operasi").val(moment(currentDateTimeEnd).format("YYYY-MM-DD HH:mm"))

            $("#flatstart_operation-permintaan_operasi").val(currentDateTime).trigger("change");
            $("#flatend_operation-permintaan_operasi").val(currentDateTimeEnd).trigger("change");
            $('#clinic_id_from-permintaan_operasi').val(result.clinic_id);
            $('#class_room_id-permintaan_operasi').val(result.class_room_id);

            $('#patient_category_id-elektif').prop('checked', result.patient_category_id === 0);
            $('#patient_category_id-cyto').prop('checked', result.patient_category_id === 1);
            $('#patient_category_id-emergency').prop('checked', result.patient_category_id === 2);

            $('#operation_type-permintaan_operasi').val(result.operation_type);


            getDataColumnName({
                table_name: 'class_room',
                column_name: 'name_of_class',
                column_id: 'class_room_id',
                id: result?.class_room_id,
                element_id: 'class_room_id-permintaan_operasi_name'
            })
            getDataColumnName({
                table_name: 'clinic',
                column_name: 'name_of_clinic',
                column_id: 'clinic_id',
                id: result?.clinic_id,
                element_id: 'clinic_id_from-permintaan_operasi_name'
            })


            if (!result?.rooms_id) {
                let $inputElementRoom = $("#rooms_id-permintaan_operasi");

                let $selectElementRoom = $("<select>", {
                    id: $inputElementRoom.attr("id"),
                    name: $inputElementRoom.attr("name"),
                    class: $inputElementRoom.attr("class")
                });

                $selectElementRoom.append($("<option>", {
                    value: '',
                    text: 'Select',
                    selected: true
                }));


                for (let i = 1; i <= 5; i++) {
                    let option = $("<option>", {
                        value: "OK-" + i,
                        text: "OK-" + i
                    });
                    $selectElementRoom.append(option);
                }

                $inputElementRoom.replaceWith($selectElementRoom);
            } else {
                $("#rooms_id-permintaan_operasi").val(result?.rooms_id);
            }



            const foundData = treatmentData.find(item => item.operation_type === `${result?.operation_type}`);

            $("#operation_type_name-permintaan_operasi").val(foundData?.treatment);


            $('#create-modal-permintaan-operasi').off().on('shown.bs.modal', function() {
                let treatmentData = renderDropdownTreatment();
                $('#tarif_id-permintaan_operasi').select2({
                    data: treatmentData,
                    disabled: false,
                    dropdownParent: $('#create-modal-permintaan-operasi')
                });

                $('#tarif_id-permintaan_operasi').val(result?.tarif_id).trigger('change');
                initializeFlatpickrOperasi()
                initializeQuillEditors();
            });


            initializeQuillEditors();
            actionBtnUpdateAndInsert(result);
        };


        const valueCatatan = async (props) => {
            try {
                let promises = props?.data.map(async (e) => {
                    const {
                        htmlContent
                    } = await getType({
                        parameter_desc: e?.parameter_desc,
                        parameter_id: e?.parameter_id,
                        column_name: e?.column_name,
                        p_type: e?.p_type,
                        code: e?.entry_type,
                        get_data: props?.get_data,
                        items: props?.items,
                        data_tindakan: props?.data_tindakan
                    });

                    return htmlContent.trim() ? `
                <div class="row pl-sm-0 ${e?.entry_type == 4 ? 'col-12' : 'col-6'}" 
                    id="type-container-${e?.parameter_id}-${e?.p_type}">
                    ${htmlContent}
                </div>` : '';
                });

                const results = await Promise.all(promises);
                const dataHtml = results.filter(html => html.trim() !== '').join('');

                const container = $(`#${props?.content_id}`);
                container.html(dataHtml);

                initializeQuillEditors();
                initializeFlatpickrOperasi();

                $('#type-container-03-OPRS011').remove();


            } catch (error) {
                // console.error('Error in valueCatatan:', error);
            }
        };

        const renderbodyInstrumenoprs004 = (props) => {
            let hasil = '';
            InstrumenValue = props?.items
            InstrumenValue.forEach((item, index) => {
                hasil += `<tr>
                    <td hidden><input type="number" name="brand_id2[]" value="${item?.brand_id}"/></td>
                    <td>${item?.brand_name === '1' ? "Instrumen" :
                                    item?.brand_name === '2' ? "Kassa" :
                                    item?.brand_name === '3' ? "Jarum" :
                                    item?.brand_name}
                        <input type="hidden" name="document_id" id="document_id_checklist_keperawatan" value="${item?.document_id}">
                        <input type="hidden" name="body_id_instrument" id="body_id_instrument" value="${item?.body_id}">
                    </td>
                    <td hidden><input type="text" name="brand_name2[]" value="${item?.brand_name}"/></td>
                    <td>${item?.quantity_before}</td>
                    <td hidden><input type="number" name="quantity_before2[]" value="${item?.quantity_before}"/></td>
                    
                    <td><input type="number" class="form-control quantity-intra" min="0" id="quantity_intra_${index}" name="quantity_intra2[]" data-before="${item?.quantity_before}" value="${item?.quantity_intra || ''}" /></td>
                    <td><input type="number" class="form-control quantity-additional" min="0" id="quantity_additional_${index}" name="quantity_additional2[]" value="${item?.quantity_additional || ''}" /></td>
                    <td><input type="number" class="form-control quantity-after" min="0" id="quantity_after_${index}" name="quantity_after2[]" value="${item?.quantity_after || ''}" /></td>
                
                    <td class="result-${index}"></td>
                </tr>`;
            });
            $("#bodyInstrumenoprs004").append(hasil);


            $("input.quantity-intra, input.quantity-additional, input.quantity-after").on('input',
                function() {
                    updateResults();
                });

            const updateResults = () => {
                InstrumenValue.forEach((item2, index) => {
                    const quantityBefore = parseFloat(item2?.quantity_before) || 0;
                    const quantityIntra = parseFloat($(`#quantity_intra_${index}`).val()) || 0;
                    const quantityAdditional = parseFloat($(`#quantity_additional_${index}`)
                            .val()) ||
                        0;
                    const quantityAfter = parseFloat($(`#quantity_after_${index}`).val()) || 0;

                    const resultCell = $(`.result-${index}`);

                    // Condition 1: Check if quantity_intra equals quantity_before
                    const condition1 = (quantityIntra === quantityBefore);

                    // Condition 2: Check if the sum of quantity_before and quantity_additional equals quantity_after
                    const condition2 = (quantityBefore + quantityAdditional === quantityAfter);

                    if (condition1 && condition2) {
                        resultCell.html(`<span class="text-success">Sesuai</span>`);
                    } else {
                        resultCell.html(`<span class="text-danger">Tidak sesuai</span>`);
                    }
                });
            };

            updateResults();
        };


        const renderDrains004 = (props) => {
            $('#bodyDrains004').empty();
            dataDrain.forEach((item) => {
                AddRowDrains004({
                    item: item
                });
            });
            globalBodyId = get_bodyid();

            $('#addDrain').click(function() {
                AddRowDrains004({
                    valBody_id: dataDrain[0]?.body_id ?? globalBodyId,
                    item: {}
                });
            });

            $('#bodyAldreteoprs023').empty();


            if (props?.assessment_anesthesia_recovery?.aldrete) {
                props.assessment_anesthesia_recovery?.aldrete.forEach((item, index) => {
                    AddRowAldrete005({
                        item: item,
                        index: index,
                        container: 'bodyAldreteoprs023'
                    });
                    $('#addAldrete').hide();
                });
            }

            $('#addAldrete').click(function() {
                let rowCount = $('#bodyAldreteoprs023 tr').length;

                if (rowCount === 0) {
                    AddRowAldrete005({
                        item: {},
                        index: rowCount,
                        container: 'bodyAldreteoprs023'
                    });
                    $(this).hide();
                }
            });

        };
        const AddRowAldrete005 = (props) => {
            let visit = <?= json_encode($visit) ?>;
            let aValue = <?= json_encode($aValue) ?>;

            let filteredaValue = aValue.filter(item => item.p_type === 'OPRS023');

            let groupedData = filteredaValue.reduce((acc, item) => {
                if (!acc[item.parameter_id]) {
                    acc[item.parameter_id] = [];
                }
                acc[item.parameter_id].push(item);
                return acc;
            }, {});

            const createSelectOptions = (options, selectedValue) => {
                return options.map(option => `
                    <option value="${option.value_id}" data-score="${option.value_score}" ${option.value_id === selectedValue ? 'selected' : ''}>
                        ${option.value_desc}
                    </option>
                `).join('');
            };

            const createTimeOptions = () => {
                let options = [];
                for (let i = 5; i <= 30; i += 5) {
                    options.push(`
                <option value="${i}">${i} menit</option>
            `);
                }
                return options.join('');
            };

            const formatDateTime = (date) => {
                return moment(date).format('YYYY-MM-DDTHH:mm');
            };

            const formatTimeOnly = (date) => {
                return moment(date).format('HH:mm');
            };

            const calculateTotalScore = (row) => {
                let totalScore = 0;
                $(row).find('select[name^="parameter_oprs023_"]').each(function() {
                    const selectedOption = $(this).find('option:selected');
                    const score = parseInt(selectedOption.data('score'), 10) || 0;
                    totalScore += score;
                });
                return totalScore;
            };

            const updateRowScoreAndStatus = (row) => {
                let totalScore = calculateTotalScore(row);
                row.find('.total-score-input').text(totalScore);

                let status = totalScore >= 8 ? 'Pindah Ruangan / Pulang' : 'Tidak Pindah';
                row.find('.discharge-status-input').val(status);
            };

            let observationDate = props?.item?.observation_date ? moment(props?.item?.observation_date) : moment(
                new Date());
            let observationDateFormatted = formatDateTime(observationDate);
            let observationTimeOnly = formatTimeOnly(observationDate);

            let newRowDrain = `
                <tr>
                    ${Object.keys(groupedData).map(parameterId => {
                        let selectedValue = props.item[`value_id_${parameterId}`] || '';
                        return `
                            <td>
                                <select class="form-select" name="parameter_oprs023_${parameterId}">
                                    <option value="">Select...</option>
                                    ${createSelectOptions(groupedData[parameterId], selectedValue)}
                                </select>
                            </td>
                        `;
                    }).join('')}
                    <td class="total-score">
                        <h3><span class="badge text-bg-secondary total-score-input">0</span></h3>
                    </td>
                    <td class="discharge-status">
                        <input type="text" class="form-control discharge-status-input" readonly value="">
                    </td>
                    ${props.index === 0 ? `
                    <td></td>
                        <td class="datetime">
                            <input type="text" class="form-control datetime-input datetimeflatpickr" value="${observationDateFormatted}" hidden>
                            <h4><span class="badge text-bg-secondary">${observationTimeOnly}</span></h4>
                        </td>
                    ` : `
                        <td class="time-interval">
                            <select class="form-select" name="time_interval[]">
                                <option value="">Select Time...</option>
                                ${createTimeOptions()}
                            </select>
                        </td>
                        <td class="datetime">
                            <input type="text" class="form-control datetime-input datetimeflatpickr" value="${observationDateFormatted}" hidden name='observation_date[]'>
                            <h4><span class="badge text-bg-secondary datetime-display">${observationTimeOnly}</span></h4>
                        </td>
                    `}
                    <td>
                        <button type="button" class="btn btn-danger btn-sm adrete-delete-row"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            `;

            $(`#${props?.container}`).append(newRowDrain);

            updateRowScoreAndStatus($(`#${props?.container} tr`).last());

            $(`#${props?.container}`).on('change', 'select[name^="parameter_oprs023_"]', function() {
                let row = $(this).closest('tr');
                updateRowScoreAndStatus(row);
            });

            $(`#${props?.container}`).on('change', 'select[name="time_interval[]"]', function() {
                let row = $(this).closest('tr');
                let selectedMinutes = parseInt($(this).val(), 10) || 0;
                let previousDatetime = row.prev().find('.datetime-input').val();
                if (previousDatetime) {
                    let newDatetime = moment(previousDatetime).add(selectedMinutes, 'minutes').format(
                        'YYYY-MM-DDTHH:mm');
                    row.find('.datetime-input').val(newDatetime);
                    row.find('.datetime-display').text(formatTimeOnly(newDatetime));
                    updateRowScoreAndStatus(row);
                }
            });

            if (props.index > 0) {
                let previousDatetime = $(`#${props?.container} tr`).eq(props.index - 1).find('.datetime-input')
                    .val();
                let defaultDatetime = moment(previousDatetime).add(5, 'minutes').format('YYYY-MM-DDTHH:mm');
                $(`#${props?.container} tr`).eq(props.index).find('.datetime-input').val(defaultDatetime);
                $(`#${props?.container} tr`).eq(props.index).find('.datetime-display').text(formatTimeOnly(
                    defaultDatetime));
            }

            $(`#${props?.container}`).on('click', '.adrete-delete-row', function() {
                let theid = props?.container
                $(this).closest('tr').remove();

                theid = theid.replace("bodyAldreteoprs023", "addAldrete");
                if ($(`#${props?.container} tr`).length === 0) {
                    $(`#${theid}`).show();
                }

            });
        };

        // new

        const AddRowDrains004 = (props) => {
            let visit = <?= json_encode($visit) ?>;

            let newRowDrain = `
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="drain_type_drain[]" value="${props?.item.drain_type ?? ""}">
                            </td>
                            <td>
                               
                                <select class="form-select" name="drain_kinds_drain[]">
                                    <option>-- pilih --</option>
                                    <option data-nama="handscoon" value="handscoon" ${props?.item.drain_kinds == 'handscoon' ? 'selected' : '' }>Drain Handscoon</option>
                                    <option data-nama="vacuum" value="vacuum" ${props?.item.drain_kinds == 'vacuum' ? 'selected' : '' }>Drain Vacuum</option>
                                    <option data-nama="ndt" value="ndt" ${props?.item.drain_kinds == 'ndt' ? 'selected' : '' }>Drain NDT</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="size_drain[]" value="${props?.item.size ?? ""}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="description_drain[]" value="${props?.item.description ?? ""}">
                                <input type="text" class="form-control" name="body_id_drain[]" value="${props?.item.body_id ?? props?.valBody_id}" hidden>
                                <input type="text" class="form-control" name="drain_id_drain[]" value="${props?.item.drain_id ?? get_bodyid()}" hidden>
                                <input type="text" class="form-control" name="visit_id_drain[]" value="${props?.item.visit_id ?? visit?.visit_id}" hidden>
                                <input type="text" class="form-control" name="trans_id_drain[]" value="${props?.item.trans_id ?? visit?.trans_id}" hidden>
                                <input type="text" class="form-control" name="org_unit_code_drain[]" value="${props?.item.org_unit_code ?? visit?.org_unit_code}" hidden>
                                <input type="text" class="form-control" name="document_id_drain[]" value="${props?.item.document_id ?? props?.results?.document_id}" hidden>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm delete-row"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        `;

            $('#bodyDrains004').append(newRowDrain);

            // Attach delete event to new rows
            $('.delete-row').off().on('click', function() {
                $(this).closest('tr').remove();
            });
        };

        const renderDataTeamInPembedahan = (result) => {
            const labels = result?.labels || [];
            const data = result?.data || [];

            const groupedData = data.reduce((acc, item) => {
                const label = labels.find(lbl => lbl.task_id === item?.task_id);
                const taskName = label ? label.task : item?.task_id;

                const category = taskName.split(' ')[0];

                if (!acc[category]) {
                    acc[category] = [];
                }
                acc[category].push({
                    ...item,
                    taskName
                });
                return acc;
            }, {});

            const categories = Object.entries(groupedData);
            const half = Math.ceil(categories.length / 2);
            const leftCategories = categories.slice(0, half);
            const rightCategories = categories.slice(half);

            let hasil = `
                        <div class="d-flex justify-content-between">
                            <div class="flex-fill me-2">
                                ${leftCategories.map(([category, tasks]) => `
                                    <div class="form-group mb-3">
                                        <h5 class="fw-bold">${category}</h5>
                                        ${tasks.map(item => `
                                            <div class="d-flex align-items-center mb-2 ms-4">
                                                <label class="fw-bold me-3 w-25">${item.taskName}</label>
                                                <span class="w-75">${item?.doctor}</span>
                                            </div>
                                        `).join('')}
                                        <hr />
                                    </div>
                                `).join('')}
                            </div>
                            <div class="flex-fill ms-2">
                                ${rightCategories.map(([category, tasks]) => `
                                    <div class="form-group mb-3">
                                        <h5 class="fw-bold">${category}</h5>
                                        ${tasks.map(item => `
                                            <div class="d-flex align-items-center mb-2 ms-4">
                                                <label class="fw-bold me-3 w-25">${item.taskName}</label>
                                                <span class="w-75">${item?.doctor}</span>
                                            </div>
                                        `).join('')}
                                        <hr />
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;

            $(`#data-oprasi-pembedahan`).html(hasil);
        }
        const renderDataTeamInPembedahanAnesthesiLengkap = (result) => {
            const labels = result?.labels || [];
            const data = result?.data || [];

            const groupedData = data.reduce((acc, item) => {
                const label = labels.find(lbl => lbl.task_id === item?.task_id);
                const taskName = label ? label.task : item?.task_id;

                const category = taskName.split(' ')[0];

                if (!acc[category]) {
                    acc[category] = [];
                }
                acc[category].push({
                    ...item,
                    taskName
                });
                return acc;
            }, {});

            const categories = Object.entries(groupedData);
            const half = Math.ceil(categories.length / 2);
            const leftCategories = categories.slice(0, half);
            const rightCategories = categories.slice(half);

            let hasil = `
                        <div class="d-flex justify-content-between">
                            <div class="flex-fill me-2">
                                ${leftCategories.map(([category, tasks]) => `
                                    <div class="form-group mb-3">
                                        <h5 class="fw-bold">${category}</h5>
                                        ${tasks.map(item => `
                                            <div class="d-flex align-items-center mb-2 ms-4">
                                                <label class="fw-bold me-3 w-25">${item.taskName}</label>
                                                <span class="w-75">${item?.doctor}</span>
                                            </div>
                                        `).join('')}
                                        <hr />
                                    </div>
                                `).join('')}
                            </div>
                            <div class="flex-fill ms-2">
                                ${rightCategories.map(([category, tasks]) => `
                                    <div class="form-group mb-3">
                                        <h5 class="fw-bold">${category}</h5>
                                        ${tasks.map(item => `
                                            <div class="d-flex align-items-center mb-2 ms-4">
                                                <label class="fw-bold me-3 w-25">${item.taskName}</label>
                                                <span class="w-75">${item?.doctor}</span>
                                            </div>
                                        `).join('')}
                                        <hr />
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;

            $(`#bodyTimOperasiAnesthesiLengkap`).html(hasil);
        } //new 31/07

        const renderHistoryTemplate = () => {
            let item = historyPasien
            let filteredDataPenyakit = historyPasien.filter(item =>
                item.value_id === 'G0090201' || item.value_id === 'G0090202'
            );

            let filteredDataAlergi = historyPasien.filter(item =>
                item.value_id === 'G0090101' || item.value_id === 'G0090102'
            );

            let contentPenyakit = '';
            let contentAlergi = '';

            filteredDataPenyakit.forEach(item => {
                contentPenyakit +=
                    `${item.value_desc} : ${item.histories || 'Tidak ada catatan'}<br>`;
            });

            filteredDataAlergi.forEach(item => {
                contentAlergi +=
                    `${item.value_desc} : ${item.histories || 'Tidak ada catatan'}<br>`;
            });

        }

        const getDataKeperawatanOPRS001 = async (props) => {
            let data = props?.data
            let blood_request = props?.blood_request
            let diagnosas = props?.diagnosas

            let catatanKeperawatanOPRS001 = `
                    <div class="container">
                        <div class="row">
                            <div id="cKeperawatanoprs001-1" class="row"></div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                            <div class="form-group">
                                <label><strong>Tanda Tangan Perawat Ruangan</strong></label>
                                <div class="position-relative" id="qr-1-${data?.body_id}">

                                    <button type="button" id="formPraOperasiSignBtn1" name="signrm" data-sign-ke="1"
                                        data-button-id="formPraOperasiSaveBtn" class="btn btn-warning">
                                        <i class="fa fa-signature"></i> <span>Sign</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    `;
            let bloodRequest = `
            <div class="row mt-4">
                            <div class="table tablecustom-responsive">
                                <h4><b>Produk Darah</b></h4>
                                <hr>
                                <table id="tablediagnosa" class="table">
                                    <thead>
                                        <th class="text-center" style="width: 12%">Jenis Darah</th>
                                        <th class="text-center" style="width: 5%">Jumlah</th>
                                        <th class="text-center" style="width: 10%">Satuan Ukuran</th>
                                        <th class="text-center" style="width: 9%">Golongan Darah</th>
                                        <th class="text-center" style="width: 23%">Keterangan</th>
                                        <th class="text-center" style="width: 10%">Waktu Penggunaan</th>
                                        <th class="text-center" style="width: 10%">Transfusion Start</th>
                                        <th class="text-center" style="width: 10%">Transfusion End</th>
                                        <th class="text-center" style="width: 10%">Reaction Desc</th>
                                        <th class="text-center" style="width: 1%"></th>
                                    </thead>
                                    <tbody id="bodyBloodRequest">

                                    </tbody>
                                </table>
                            </div>
                            <div class="box-tab-tools" style="text-align: center;">
                                <button type="button" id="addbloodrequest2" name="addbloodrequest" class="btn btn-secondary"><i class="fa fa-plus"></i> <span>Tambah</span></button>
                            </div>
                        </div>
            `; // new 28 sept

            let diagnosaOPRS001 = `
            <div class="row mt-4">
                                <div class="table tablecustom-responsive">
                                    <h4><b>DIAGNOSA</b></h4>
                                    <hr>
                                    <table id="tablediagnosa" class="table">
                                        <thead>
                                            <th class="text-center" style="width: 40%">Diagnosa</th>
                                            <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                            <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis
                                            </th>
                                        </thead>
                                        <tbody id="bodyDiagPraOperation2-${pasienOperasiSelected?.vactination_id}">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-tab-tools" style="text-align: center;">
                                    <button type="button" id="adddiagnosaPraOperasi" class="btn btn-secondary"><i class="fa fa-check-circle"></i>
                                        <span>Diagnosa</span></button>
                                </div>
                            </div>
            `;

            let ttdOps2 = `<div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                        <div class="form-group">
                            <label><strong>Tanda Tangan Dokter Penanda</strong></label>
                            <div class="position-relative" id="qr-2-${data?.body_id}">
                                <button type="button" id="formPraOperasiSignBtn2" name="signrm" data-sign-ke="2"
                                    data-button-id="formPraOperasiSaveBtn" class="btn btn-warning">
                                    <i class="fa fa-signature"></i> <span>Sign</span>
                                </button>
                            </div>
                        </div>
                    </div>`

            getAvalueType({
                p_type: 'OPRS001',
                content_id: 'cKeperawatanoprs001-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });

            $('#ttd-praOps').html(ttdOps2)
            $('#cKeperawatanoprs001').html(catatanKeperawatanOPRS001);
            $('#containerBloodRequest').html(bloodRequest);
            $('#praOperasiDiagnosaBody').html(diagnosaOPRS001);

            if (blood_request) {
                blood_request.forEach((item, index) => {
                    addBloodRequest('bodyBloodRequest', item.blood_request, item);
                });
            }

            $("#addbloodrequest2").on("click", () => {
                const container = 'bodyBloodRequest';
                const bodyId = get_bodyid();
                const bloodselected = [];


                addBloodRequest(container, bodyId, bloodselected);
            });


            if (diagnosas) {

                diagnosas.forEach((item, index) => {

                    addRowDiagDokter('bodyDiagPraOperation2-', pasienOperasiSelected?.vactination_id,
                        item?.diagnosa_id, item?.diagnosa_name, item?.diag_cat);
                });
            }

            $("#adddiagnosaPraOperasi").on("click", () => {
                addRowDiagDokter('bodyDiagPraOperation2-', pasienOperasiSelected?.vactination_id);
            });


            const formId = 'formPraOperasi';
            const primaryKey = data?.body_id;
            const formSaveBtn = 'formPraOperasiSaveBtn';
            $("button[name='signrm']").each(function() {
                if (data?.body_id) {
                    $(this).prop('disabled', false);
                } else {
                    $(this).prop('disabled', true);
                }
            });


            $("button[name='signrm']").off().on("click", function() {
                const buttonId = $(this).data('button-id');
                const signKe = $(this).data('sign-ke');

                addSignUserOPS("formPraOperasi", "accordionPraOperasi", data?.body_id, buttonId,
                    7, signKe,
                    1, "Catatan Keperawatan Pra Operasi");
            });

            // if (data?.body_id) {
            //     checkSignSignature1(formId, primaryKey, formSaveBtn, '7');
            // }
        }

        //---------bbb
        const catatanKeperawatanPraOperasi = async (props) => {
            let visit = <?= json_encode($visit) ?>;
            let data = props?.data

            getAvalueType({
                p_type: 'OPRS003',
                content_id: 'template-tindakan-operasi-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });

            getAvalueType({
                p_type: 'OPRS004',
                content_id: 'cKeperawatanIntraOperatif-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });

            getAvalueType({
                p_type: 'OPRS005',
                content_id: 'cKeperawatanPascaOperatif-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });
            getAvalueType({
                p_type: 'OPRS024',
                content_id: 'bodyBromage-0',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });
            const xrayData = data?.xray;

            // if (xrayData !== undefined) {
            //     $(`input[name="xray"][value="${xrayData}"]`).prop('checked', true);
            // }
            if (data?.document_id) {

                getDataVitailSign({
                    pasien_diagnosa_id: data?.document_id ?? pasienOperasiSelected
                        ?.vactination_id,
                    account_ids: ['10'],
                    suffixes: ["-catatanKeperawatan"]
                });

                getDataDiagnosassPerawat({
                    visit_id: data?.visit_id,
                    document_id: data?.document_id,
                    vactination_id: data?.document_id
                });
            }




            let oprs003 = `
                        <div class="container">
                            <div class="row">
                                <div id="template-tindakan-operasi-1" class="row"></div>
                                <div class="form-group col-sm-12 pt-5">
                                    <label for="riwayat_penyakit-catatan_operasi" class="fw-bold">Riwayat Penyakit</label>
                                    <textarea class="form-control disabled" id="riwayat_penyakit-catatan_operasi" name="riwayat_penyakit-catatan-operasi"></textarea>
                                </div>
                                <div class="form-group col-sm-12 mb-3">
                                    <label for="alergi-catatan_operasi" class="fw-bold">Alergi</label>
                                    <textarea class="form-control disabled" id="alergi-catatan_operasi" name="alergi-catatan-operasi"></textarea>
                                    <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value="${data?.trans_id ?? visit?.trans_id}" hidden></input>
                                    <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value="${data?.body_id}" hidden></input>
                                    <input class="form-control disabled" id="visit_id-catatan_operasi" name="visit_id" value="${data?.visit_id ?? visit?.visit_id}" hidden></input>
                                    <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value="${data?.org_unit_code ?? visit?.org_unit_code}" hidden></input>
                                    <input class="form-control disabled" id="no_registration-catatan_operasi" name="no_registration" value="${data?.no_registration ?? visit?.no_registration}" hidden></input>
                                </div>
                                <div class="row mb-4 pt-4">
                                    <div class="table tablecustom-responsive">
                                        <h4><b>DIAGNOSA</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" >Validate</th>
                                            </thead>
                                            <tbody id="bodyDiagKepCatatan-${data?.document_id?? pasienOperasiSelected?.vactination_id}">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag-catatan" name="adddiagnosa" class="btn btn-secondary">
                                            <i class="fa fa-check-circle"></i> <span>Diagnosa</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                    <div class="form-group">
                                        <label><strong>Tanda Tangan Perawat IBS</strong></label>
                                        <div class="position-relative" id="qr-1-${data?.body_id}">
                                            <button type="button" id="formPeriOperasiSignBtn1" name="signperi" data-sign-ke="1"
                                                data-button-id="btn-save-catatan-keperawatan" class="btn btn-warning">
                                                <i class="fa fa-signature"></i> <span>Sign</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            `;

            let oprs004 = `
                            <div class="container">
                                <div class="row">
                                    <div id="cKeperawatanIntraOperatif-1" class="row"></div>
                                </div>
                                <div class="row mt-4">
                                    <div class="table tablecustom-responsive">
                                        <h5><b>Hitung Instrumen/Kassa/Jarum</b></h5>
                                        <hr>
                                        <table id="tablediagnosa" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 30%">Nama Alat</th>
                                                <th class="text-center" style="width: 20%">Hitungaan Awal</th>
                                                <th class="text-center" style="width: 20%">Intra</th>
                                                <th class="text-center" style="width: 20%">Tambahan</th>
                                                <th class="text-center" style="width: 20%">Hitungan Akhir</th>
                                                <th class="text-center" style="width: 40%">Kesimpulan</th>
                                            </thead>
                                            <tbody id="bodyInstrumenoprs004"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Jika dihitung tidak Sesuai -> X-ray</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="xray" id="xrayYes" value="1" ${xrayData == 1 ? 'checked' : ''}>
                                            <label class="form-check-label" for="xrayYes">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="xray" id="xrayNo" value="0" ${xrayData != 1 ? 'checked' : ''}>
                                            <label class="form-check-label" for="xrayNo">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="table tablecustom-responsive">
                                        <h5><b>Pemakian Drain</b></h5>
                                        <hr>
                                        <table id="tablediagnosa" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 20%">Tipe Drain</th>
                                                <th class="text-center" style="width: 20%">Jenis Drain</th>
                                                <th class="text-center" style="width: 20%">Ukuran</th>
                                                <th class="text-center" style="width: 40%">Keterangan</th>
                                            </thead>
                                            <tbody id="bodyDrains004"></tbody>
                                        </table>
                                        <div class="box-tab-tools my-3" style="text-align: center;">
                                            <button type="button" id="addDrain" name="addDrain" data-body="bodyDrains004" data-loading-text="" class="btn btn-secondary"><span>Tambah</span></button>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                    <div class="form-group">
                                        <label><strong>Tanda Tangan Instrument</strong></label>
                                        <div class="position-relative" id="qr-2-${data?.body_id}">
                                            <button type="button" id="formPeriOperasiSignBtn2" name="signperi" data-sign-ke="2"
                                                data-button-id="btn-save-catatan-keperawatan" class="btn btn-warning">
                                                <i class="fa fa-signature"></i> <span>Sign</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                    <div class="form-group">
                                        <label><strong>Tanda Tangan Sirkulasi</strong></label>
                                        <div class="position-relative" id="qr-3-${data?.body_id}">
                                            <button type="button" id="formPeriOperasiSignBtn3" name="signperi" data-sign-ke="3"
                                                data-button-id="btn-save-catatan-keperawatan" class="btn btn-warning">
                                                <i class="fa fa-signature"></i> <span>Sign</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value="${data?.trans_id ?? visit?.trans_id}" hidden></input>
                                <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value="${data?.body_id}" hidden></input>
                                <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value="${data?.org_unit_code ?? visit?.org_unit_code}" hidden></input>
                            
                            </div>
            `;

            let oprs005 = `
                        <div class="container">
                            <div class="row">
                                <div id="cKeperawatanPascaOperatif-1" class="row"></div>
                                <div class="row mt-4">
                                    <div class="table tablecustom-responsive">
                                        <h5><b>Aldrete</b></h5>
                                        <hr>
                                        <table id="tablediagnosa" class="table">
                                            <thead>
                                                <th class="text-center fit" >Aktivitas</th>
                                                <th class="text-center fit" >Pernafasan</th>
                                                <th class="text-center fit" >Circulation</th>
                                                <th class="text-center fit" >Kesadaran</th>
                                                <th class="text-center fit" >Saturasi O2</th>
                                                <th class="text-center fit" >Skor Aldrete</th>

                                            </thead>
                                            <tbody id="bodyAldreteoprs023"></tbody>
                                        </table>
                                        <div class="box-tab-tools my-3" style="text-align: center;">
                                            <button type="button" id="addAldrete" name="addAldrete" data-body="bodyAldreteoprs023" data-loading-text="" class="btn btn-secondary"><span>Tambah</span></button>
                                        </div>
                                    </div>
                                </div>
                                <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value="${data?.trans_id ?? visit?.trans_id}" hidden></input>
                                <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value="${data?.body_id}" hidden></input>
                                <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value="${data?.org_unit_code ?? visit?.org_unit_code}" hidden></input>
                            </div>
                        </div>
            `;

            let oprs024 = `
                        <div class="container">
                            <div class="row">
                                <h5><b>Bromage</b></h5>
                                <div id="bromageContainer" class="row"></div>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm my-3" id="addBromage">+ Tambah Bromage</button>
                        </div>
            `;
            let oprs025 = `
                    <div class="container">
                        <div class="row">
                            <h5><b>Steward</b></h5>
                            <input class="form-control steward-trans-id" id="trans_id-steward" name="trans_id" value="${data?.trans_id ?? visit?.trans_id}" hidden></input>
                            <input class="form-control steward-body-id" id="body_id-steward" name="body_id" value="${data?.body_id}" hidden></input>
                            <input class="form-control steward-org-unit-code" id="org_unit_code-steward" name="org_unit_code" value="${data?.org_unit_code ?? visit?.org_unit_code}" hidden></input>
                            <div id="stewardContainer" class="row"></div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm my-3" id="addSteward">+ Tambah Steward</button>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                            <div class="form-group">
                                <label><strong>Tanda Tangan Petugas Ruang Pulih</strong></label>
                                <div class="position-relative" id="qr-4-${data?.body_id}">
                                    <button type="button" id="formPeriOperasiSignBtn4" name="signperi" data-sign-ke="4"
                                        data-button-id="btn-save-catatan-keperawatan" class="btn btn-warning">
                                        <i class="fa fa-signature"></i> <span>Sign</span>
                                    </button>
                                </div>
                            </div>
                        </div>
            `;

            $('#weight-catatanKeperawatan').val(props?.exam_info.weight);
            $('#height-catatanKeperawatan').val(props?.exam_info.height);

            $('#template-tindakan-operasi').html(oprs003);
            $('#cKeperawatanIntraOperatif').html(oprs004);
            $('#cKeperawatanPascaOperatif').html(oprs005);
            $('#cKeperawatanPascaOperatifBromage').html(oprs024);
            $('#cKeperawatanPascaOperatifSteward').html(oprs025);

            if (props.assessment_anesthesia_recovery?.bromage) {
                props.assessment_anesthesia_recovery?.bromage.forEach(each => {
                    addBromage({
                        document_id: pasienOperasiSelected?.vactination_id,
                        data: each,
                        container: 'bromageContainer',
                        bodyId: 'bodyBromage'
                    });
                    $('#addBromage').hide();
                });
            }
            if (props?.assessment_anesthesia_recovery?.steward) {
                props.assessment_anesthesia_recovery?.steward.forEach((item, index) => {
                    addSteward({
                        document_id: pasienOperasiSelected?.vactination_id,
                        item: item,
                        index: index,
                        container: 'stewardContainer'
                    });
                    $('#addSteward').hide();
                });
            }
            $("#addBromage").on("click", function(e) {
                let bromageCount = $('#bromageContainer .bromage-item').length;


                if (bromageCount === 0) {
                    addBromage({
                        document_id: pasienOperasiSelected?.vactination_id,
                        container: 'bromageContainer',
                        bodyId: 'bodyBromage'
                    });

                    $(this).hide();
                }
            });
            $("#addSteward").on("click", function(e) {
                let rowCount = $('#stewardContainer tr').length;
                if (rowCount === 0) {
                    addSteward({
                        document_id: pasienOperasiSelected?.vactination_id,
                        item: {},
                        index: rowCount,
                        container: 'stewardContainer'
                    })
                    $(this).hide();
                }
            });

            $('#addInstrumen').off().on("click", function() {
                addRowInstrumen();
                updateAddButtonVisibility();

            });

            $('#addInstrumen1').off().on("click", function() {
                addRowInstrumen();
                updateAddButtonVisibility();
            });

            $("#formdiag-catatan").on("click", function(e) {
                addRowDiagPerawat('bodyDiagKepCatatan-', data?.document_id ?? pasienOperasiSelected
                    ?.vactination_id);
            });

            renderHistoryTemplate();

            btnSavepraOprasi(pasienOperasiSelected);

            $("#vs_status_id-catatanKeperawatan").on("change", function() {
                var optionSelected = $("option:selected", this);
                $('#container-vitalsign-catatanKeperawatan').empty();

                switch (optionSelected.val()) {
                    case '4':
                        getAvalueType({
                            p_type: 'GEN0022',
                            content_id: 'container-vitalsign-catatanKeperawatan',
                            body_id: pasienOperasiSelected?.vactination_id,
                            get_data: data ?? null,
                        });
                        break;
                    case '10':
                        getAvalueType({
                            p_type: 'GEN0021',
                            content_id: 'container-vitalsign-catatanKeperawatan',
                            body_id: pasienOperasiSelected?.vactination_id,
                            get_data: data ?? null,
                        });
                        break;
                }
            })
            const formId = 'form-catatan-keperawatan';
            const primaryKey = data?.body_id;
            const formSaveBtn = 'btn-save-catatan-keperawatan';

            $("button[name='signperi']").each(function() {
                if (data?.body_id) {
                    $(this).prop('disabled', false);
                } else {
                    $(this).prop('disabled', true);
                }
            });


            $("button[name='signperi']").off().on("click", function() {
                const buttonId = $(this).data('button-id');
                const signKe = $(this).data('sign-ke');
                if (!$(this).is(':disabled')) {
                    addSignUserOPS("form-catatan-keperawatan", "catatan-keperawatan", data?.body_id,
                        buttonId,
                        8, signKe, 1,
                        "Catatan Keperawatan Peri Operasi");
                }
            });
            // if (data?.body_id) {
            //     checkSignSignature1(formId, primaryKey, formSaveBtn, '8');
            // }

        };



        const addBromage = (props) => {
            let bromageCount = $('#' + props.container + ' .bromage-item').length;

            let newId = `${props.bodyId}-${bromageCount + 1}`;

            $('#' + props.container).append(
                `
        <div class="col-md-12 bromage-item">
            <div id="${newId}" class="row">
            </div>
            <h3 class="badge text-bg-secondary">Skor Bromage : ${props?.data?.value_score ?? 0}</h3>
            <div class="row pe-4 mt-2" style="box-sizing: border-box;">
                <div class="d-flex pe-4 col-6" style="box-sizing: border-box;">
                    <button type="button" class="btn btn-danger w-100 deleteBromage"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
        </div>
        `
            );

            getAvalueType({
                p_type: 'OPRS024',
                content_id: newId,
                body_id: props.document_id,
                get_data: props.data,
            });
            let hasil = props?.bodyId


            $('#' + props.container).on('click', '.deleteBromage', function() {

                let theid = props?.container

                $(this).closest('.bromage-item').remove();

                theid = theid.replace("bromageContainer", "addBromage");
                if ($(`#${props?.container} tr`).length === 0) {
                    $(`#${theid}`).show();
                }
            });
        };

        const addSteward = (props) => {
            let visit = <?= json_encode($visit) ?>;
            let aValue = <?= json_encode($aValue) ?>;

            let filteredaValue = aValue.filter(item => item.p_type === 'OPRS025');

            let groupedData = filteredaValue.reduce((acc, item) => {
                if (!acc[item.parameter_id]) {
                    acc[item.parameter_id] = [];
                }
                acc[item.parameter_id].push(item);
                return acc;
            }, {});

            const createSelectOptions = (options, selectedValue) => {
                return options.map(option => `
            <option value="${option.value_id}" data-score="${option.value_score}" ${option.value_id === selectedValue ? 'selected' : ''}>
                ${option.value_desc}
            </option>
        `).join('');
            };

            const createTimeOptions = () => {
                let options = [];
                for (let i = 5; i <= 30; i += 5) {
                    options.push(`
                <option value="${i}">${i} menit</option>
            `);
                }
                return options.join('');
            };

            const formatDateTime = (date) => {
                return moment(date).format('YYYY-MM-DDTHH:mm');
            };

            const formatTimeOnly = (date) => {
                return moment(date).format('HH:mm');
            };

            const calculateTotalScore = (row) => {
                let totalScore = 0;
                $(row).find('select[name^="parameter_oprs025_"]').each(function() {
                    const selectedOption = $(this).find('option:selected');
                    const score = parseInt(selectedOption.data('score'), 10) || 0;
                    totalScore += score;
                });
                return totalScore;
            };

            const updateRowScoreAndStatus = (row) => {
                let totalScore = calculateTotalScore(row);
                row.find('.steward-total-score-input').text(totalScore);

                let status = totalScore >= 8 ? 'Pindah Ruangan / Pulang' : 'Tidak Pindah';
                row.find('.steward-discharge-status-input').val(status);
            };

            let observationDate = props?.item?.observation_date ? moment(props?.item?.observation_date) : moment(
                new Date());
            let observationDateFormatted = formatDateTime(observationDate);
            let observationTimeOnly = formatTimeOnly(observationDate);

            let newRowSteward = `
        <tr>
            ${Object.keys(groupedData).map(parameterId => {
                let selectedValue = props.item[`value_id_${parameterId}`] || '';
                return `
                    <td>
                        <select class="form-select steward-select" name="parameter_oprs025_${parameterId}">
                            <option value="">Select...</option>
                            ${createSelectOptions(groupedData[parameterId], selectedValue)}
                        </select>
                    </td>
                `;
            }).join('')}
            <td class="steward-total-score">
                <h3><span class="badge text-bg-secondary steward-total-score-input">0</span></h3>
            </td>
            <td class="steward-discharge-status">
                <input type="text" class="form-control steward-discharge-status-input" readonly value="">
            </td>
            ${props.index === 0 ? `
            <td></td>
                <td class="steward-datetime">
                    <input type="datetime-local" class="form-control steward-datetime-input" value="${observationDateFormatted}" hidden>
                    <h4><span class="badge text-bg-secondary">${observationTimeOnly}</span></h4>
                </td>
            ` : `
                <td class="steward-time-interval">
                    <select class="form-select steward-time-interval-select" name="steward-time-interval[]">
                        <option value="">Select Time...</option>
                        ${createTimeOptions()}
                    </select>
                </td>
                <td class="steward-datetime">
                    <input type="datetime-local" class="form-control steward-datetime-input" value="${observationDateFormatted}" hidden name='steward-observation-date[]'>
                    <h4><span class="badge text-bg-secondary steward-datetime-display">${observationTimeOnly}</span></h4>
                </td>
            `}
            <td>
                <button type="button" class="btn btn-danger btn-sm steward-delete-row"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        `;

            $(`#${props?.container}`).append(newRowSteward);

            updateRowScoreAndStatus($(`#${props?.container} tr`).last());

            $(`#${props?.container}`).on('change', 'select[name^="parameter_oprs025_"]', function() {
                let row = $(this).closest('tr');
                updateRowScoreAndStatus(row);
            });

            $(`#${props?.container}`).on('change', 'select[name="steward-time-interval[]"]', function() {
                let row = $(this).closest('tr');
                let selectedMinutes = parseInt($(this).val(), 10) || 0;
                let previousDatetime = row.prev().find('.steward-datetime-input').val();
                if (previousDatetime) {
                    let newDatetime = moment(previousDatetime).add(selectedMinutes, 'minutes').format(
                        'YYYY-MM-DDTHH:mm');
                    row.find('.steward-datetime-input').val(newDatetime);
                    row.find('.steward-datetime-display').text(formatTimeOnly(newDatetime));
                    updateRowScoreAndStatus(row);
                }
            });

            if (props.index > 0) {
                let previousDatetime = $(`#${props?.container} tr`).eq(props.index - 1).find(
                    '.steward-datetime-input').val();
                let defaultDatetime = moment(previousDatetime).add(5, 'minutes').format('YYYY-MM-DDTHH:mm');
                $(`#${props?.container} tr`).eq(props.index).find('.steward-datetime-input').val(defaultDatetime);
                $(`#${props?.container} tr`).eq(props.index).find('.steward-datetime-display').text(formatTimeOnly(
                    defaultDatetime));
            }

            $(`#${props?.container}`).on('click', '.steward-delete-row', function() {


                let theid = props?.container
                $(this).closest('tr').remove();

                theid = theid.replace("stewardContainer", "addSteward");
                if ($(`#${props?.container} tr`).length === 0) {
                    $(`#${theid}`).show();
                }
            });
        };
        //---------cccccccccccccccccccccccccccccccccccccccccccccc
        const checklistKeselamatan = (props) => {
            let visit = <?= json_encode($visit) ?>;
            let arr = [];
            let data = props?.data
            getAvalueType({
                p_type: 'OPRS026',
                content_id: 'the-sign-in-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });
            getAvalueType({
                p_type: 'OPRS027',
                content_id: 'the-time-out-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });
            getAvalueType({
                p_type: 'OPRS028',
                content_id: 'the-sign-out-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });

            let catatanSignIn = `
                    <div class="container">
                        <div class="row">
                            <div id="the-sign-in-1" class="row"></div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                    <div class="form-group">
                                        <label><strong>Tanda Tangan Dokter Anestesi</strong></label>
                                        <div class="position-relative" id="qr-1-${data?.body_id}">
                                            <button type="button" id="formCkOpsSignBtn1" name="CkOps" data-sign-ke="1"
                                                data-button-id="btn-save-checklist-keselamatan" class="btn btn-warning">
                                                <i class="fa fa-signature"></i> <span>Sign</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                    <div class="form-group">
                                        <label><strong>Tanda Tangan Perawat</strong></label>
                                        <div class="position-relative" id="qr-2-${data?.body_id}">
                                            <button type="button" id="formCkOpsSignBtn2" name="CkOps" data-sign-ke="2"
                                                data-button-id="btn-save-checklist-keselamatan" class="btn btn-warning">
                                                <i class="fa fa-signature"></i> <span>Sign</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
            `;
            let catatanTimeOut = `
                    <div class="container">
                        <div class="row">
                              
                            <div id="the-time-out-1" class="row"></div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                <div class="form-group">
                                    <label><strong>Tanda Tangan Dokter Operator</strong></label>
                                    <div class="position-relative" id="qr-3-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn3" name="CkOps" data-sign-ke="3"
                                            data-button-id="btn-save-checklist-keselamatan" class="btn btn-warning">
                                            <i class="fa fa-signature"></i> <span>Sign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                <div class="form-group">
                                    <label><strong>Tanda Tangan Dokter Anestesi</strong></label>
                                    <div class="position-relative" id="qr-4-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn4" name="CkOps" data-sign-ke="4"
                                            data-button-id="btn-save-checklist-keselamatan" class="btn btn-warning">
                                            <i class="fa fa-signature"></i> <span>Sign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                <div class="form-group">
                                    <label><strong>Tanda Tangan Perawat</strong></label>
                                    <div class="position-relative" id="qr-5-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn5" name="CkOps" data-sign-ke="5"
                                            data-button-id="btn-save-checklist-keselamatan" class="btn btn-warning">
                                            <i class="fa fa-signature"></i> <span>Sign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
            let catatanSignOut = `
                    <div class="container">
                        <div class="row">
                              
                            <div id="the-sign-out-1" class="row"></div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                <div class="form-group">
                                    <label><strong>Tanda Tangan Dokter Operator</strong></label>
                                    <div class="position-relative" id="qr-6-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn6" name="CkOps" data-sign-ke="6"
                                            data-button-id="btn-save-checklist-keselamatan" class="btn btn-warning">
                                            <i class="fa fa-signature"></i> <span>Sign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                <div class="form-group">
                                    <label><strong>Tanda Tangan Dokter Anestesi</strong></label>
                                    <div class="position-relative" id="qr-7-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn7" name="CkOps" data-sign-ke="7"
                                            data-button-id="btn-save-checklist-keselamatan" class="btn btn-warning">
                                            <i class="fa fa-signature"></i> <span>Sign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                <div class="form-group">
                                    <label><strong>Tanda Tangan Perawat</strong></label>
                                    <div class="position-relative" id="qr-8-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn8" name="CkOps" data-sign-ke="8"
                                            data-button-id="btn-save-checklist-keselamatan" class="btn btn-warning">
                                            <i class="fa fa-signature"></i> <span>Sign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;


            $('#the-sign-in').html(catatanSignIn);
            $('#the-time-out').html(catatanTimeOut);
            $('#the-sign-out').html(catatanSignOut);


            const formId = 'form-checklist-keselamatan';
            const primaryKey = data?.body_id;
            const formSaveBtn = 'btn-save-checklist-keselamatan';

            $("button[name='CkOps']").each(function() {
                if (data?.body_id) {
                    $(this).prop('disabled', false);
                } else {
                    $(this).prop('disabled', true);
                }
            });


            $("button[name='CkOps']").off().on("click", function() {
                const buttonId = $(this).data('button-id');
                const signKe = $(this).data('sign-ke');
                if (!$(this).is(':disabled')) {
                    addSignUserOPS("form-checklist-keselamatan", "checklist-keselamatan", data?.body_id,
                        buttonId,
                        9, signKe, 1,
                        "Checklist Keselamatan Operasi");
                }
            });

            // if (data?.body_id) {
            //     checkSignSignature1(formId, primaryKey, formSaveBtn, '9');
            // }

        };

        //---------dddddddddddddd
        const anestesi = (props) => {
            let data = props?.data

            getAvalueType({
                p_type: 'OPRS007',
                content_id: 'checklist-anestesi-1',
                body_id: pasienOperasiSelected
                    ?.vactination_id,
                get_data: data?.assessment_anesthesia_checklist,
                items: data?.assessment_operation,
                data_tindakan: data?.ori //new
            });
            let catatan = `
                    <div class="container">
                        <div class="row">
                              
                            <div id="checklist-anestesi-1" class="row"></div>

                        </div>
                    </div>
                    `;

            $('#ck-anestesi').html(catatan);
            setTimeout(() => {
                $("#oprs007_02").val(data?.ori?.rooms_id)
            }, 100);


        };

        //---------eeeeeeeeeeeeeee
        const pembedahan = (props) => {
            let data = props?.data
            let diagnosas = props?.diagnosas
            getAvalueType({
                p_type: 'OPRS008',
                content_id: 'pembedahan-laporan-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });


            let oprs008 = `
                    <div class="container">
                        <div class="row">
                            <div id="data-oprasi-pembedahan" row></div>
                            <div id="pembedahan-laporan-1" class="row"></div>
                                <div class="row mb-4 pt-4">
                                    <div class="table tablecustom-responsive">
                                        <h4><b>DIAGNOSA PRA BEDAH</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 40%">Diagnosa</th>
                                                <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                            </thead>
                                            <tbody id="bodyDiagPraOperation-${pasienOperasiSelected?.vactination_id}">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag2" name="adddiagnosa" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="table tablecustom-responsive">
                                        <h4><b>DIAGNOSA PASCA BEDAH</b></h4>
                                        <hr>
                                        <table id="tablediagnosapascabedah" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 40%">Diagnosa</th>
                                                <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                            </thead>
                                            <tbody id="bodyDiagPascaOperation-${pasienOperasiSelected?.vactination_id}">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag" name="adddiagnosa" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                    </div>
                                </div>
                            </div>
                            <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value="${data?.trans_id ??visit?.trans_id}" hidden></input>
                            <input class="form-control disabled" id="body_id-catatan_operasi" name="vactination_id" value="${data?.document_id ?? pasienOperasiSelected?.vactination_id}" hidden></input>
                            <input class="form-control disabled" id="visit_id-catatan_operasi" name="visit_id" value="${data?.visit_id??visit?.visit_id}" hidden></input>
                            <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value="${data?.org_unit_code ??visit?.org_unit_code}" hidden></input>
                        </div>
                    </div>
                    `;
            $('#pembedahan-laporan').html(oprs008);

            setTimeout(() => {
                let currentValueoprs008_03 = $('#oprs008_03').val();
                let nameAttributeoprs008_03 = $('#oprs008_03').attr('name');
                let radioButtonsHtml008_03 = '';
                if (currentValueoprs008_03 === '0') {
                    radioButtonsHtml008_03 = `<div class="form-radio-group">
                                                <label><input type="radio" name="${nameAttributeoprs008_03}" value="0" checked> Elektif</label>
                                            </div>
                                        `;
                } else if (currentValueoprs008_03 === '1') {
                    radioButtonsHtml008_03 = `<div class="form-radio-group">
                                                                    <label><input type="radio" name="${nameAttributeoprs008_03}" value="1" checked> Cyto</label>
                                                                </div>
                                                            `;
                } else if (currentValueoprs008_03 === '2') {
                    radioButtonsHtml008_03 = `<div class="form-radio-group">
                                                <label><input type="radio" name="${nameAttributeoprs008_03}" value="2" checked> Emergency</label>
                                            </div>
                                        `;
                }
                $('#oprs008_03').replaceWith(radioButtonsHtml008_03);

                let currentValueoprs008_06 = $('#oprs008_06').val();
                let nameAttributeoprs008_06 = $('#oprs008_06').attr('name');
                let treatment = treatmentData.find(t => t.tarif_id === currentValueoprs008_06);
                let treatmentName = treatment ? treatment.tarif_name : "-";
                let labelHtml = `<label id="oprs008_06_label" class="form-control form-thems">
                                ${treatmentName}
                            </label>
                        `;

                $('#oprs008_06').replaceWith(labelHtml);


            }, 20);

            $("#formdiag2").on("click", function(e) {
                addRowDiagDokter('bodyDiagPraOperation-', pasienOperasiSelected?.vactination_id);
            });
            if (diagnosas) {
                diagnosas.forEach((item, index) => {
                    if (item.diag_cat == 13) {
                        addRowDiagDokter('bodyDiagPraOperation-', pasienOperasiSelected?.vactination_id,
                            item?.diagnosa_id, item?.diagnosa_name, item?.diag_cat, item?.diag_suffer);
                    } else {
                        addRowDiagDokter('bodyDiagPascaOperation-', pasienOperasiSelected?.vactination_id,
                            item?.diagnosa_id, item?.diagnosa_name, item?.diag_cat, item?.diag_suffer);
                    }
                });
            }
            $("#formdiag").on("click", function(e) {
                addRowDiagDokter('bodyDiagPascaOperation-', pasienOperasiSelected?.vactination_id);
            });

            btnSaveLaporanPembedahan(pasienOperasiSelected)
        }

        // -------------------GGGGGGGGG
        const LaporanAnesthesi = (props) => {

            let visit = <?= json_encode($visit) ?>;
            let data = props?.data

            let dataGetAnestesia = "";

            let oprs006 = `
                        <div class="container">
                            <div class="row">
                                <div id="informasiMedis-laporan-1" class="row pb-3"></div>
                                <input class="form-control" id="trans_id-laporan_anestesi" name="trans_id" value="" hidden></input>
                                <input class="form-control" id="body_id-laporan_anestesi" name="body_id" value="" hidden></input>
                                <input class="form-control" id="document_id-laporan_anestesi" name="document_id" value="" hidden></input>
                                <input class="form-control" id="org_unit_code-laporan_anestesi" name="org_unit_code" value="" hidden></input>
                                <input class="form-control" id="visit_id-laporan_anestesi" name="visit_id" value="" hidden></input>
                                <div class="row mb-4 pt-4">
                                    <div class="table tablecustom-responsive">
                                        <h4><b>DIAGNOSA NEW</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 40%">Diagnosa</th>
                                                <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                <th class="text-center" style="width: 20%">Kategori Diagnosis</th>
                                            </thead>
                                            <tbody id="bodyDiagLaporanAnesthesi-${data?.document_id ?? pasienOperasiSelected?.vactination_id}">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag-laporan" name="adddiagnosa" class="btn btn-secondary">
                                            <i class="fa fa-check-circle"></i> <span>Diagnosa</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
            $('#weight-laporanAnesthesi').val(props?.exam_info.weight);
            $('#height-laporanAnesthesi').val(props?.exam_info.height);

            $('#informasiMedis-laporan').html(oprs006);
            $("#trans_id-laporan_anestesi").val(data?.trans_id ?? visit?.trans_id);
            $("#org_unit_code-laporan_anestesi").val(data?.org_unit_code ?? visit?.org_unit_code);
            $("#visit_id-laporan_anestesi").val(data?.visit_id ?? visit?.visit_id);
            $("#formdiag-laporan").on("click", function(e) {
                addRowDiagDokter('bodyDiagLaporanAnesthesi-', pasienOperasiSelected?.vactination_id);
            });
            getAvalueType({
                p_type: 'OPRS006',
                content_id: 'informasiMedis-laporan-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });

            $("#body_id-laporan_anestesi").val(data?.body_id ?? get_bodyid());
            $("#document_id-laporan_anestesi").val(data?.document_id);

            setTimeout(() => {
                manipulationsTextCheckbox([
                    'oprs006_26', 'oprs006_27', 'oprs006_28',
                    'oprs006_29', 'oprs006_30', 'oprs006_31', 'oprs006_32'
                ]);
            }, 100);

            // getDataVitailSign({
            //     pasien_diagnosa_id: data?.body_id,
            //     val: "-laporanAnesthesi",
            //     account_ids: 11 //new
            // });

            if (data?.body_id) {

                getDataVitailSign({
                    pasien_diagnosa_id: data?.body_id,
                    account_ids: ['11'],
                    suffixes: ["-laporanAnesthesi"]
                });
                getDataDiagnosass({
                    pasien_diagnosa_id: data?.body_id,
                    vactination_id: data?.document_id
                });
            }

            btnSaveLaporanAnestesi(pasienOperasiSelected);
            $("#vs_status_id-laporanAnesthesi").on("change", function() {
                var optionSelected = $("option:selected", this);
                $('#container-vitalsign-laporanAnesthesi').empty();

                switch (optionSelected.val()) {
                    case '4':
                        getAvalueType({
                            p_type: 'GEN0022',
                            content_id: 'container-vitalsign-laporanAnesthesi',
                            body_id: pasienOperasiSelected?.vactination_id,
                            get_data: data ?? null,
                        });
                        break;
                    case '10':
                        getAvalueType({
                            p_type: 'GEN0021',
                            content_id: 'container-vitalsign-laporanAnesthesi',
                            body_id: pasienOperasiSelected?.vactination_id,
                            get_data: data ?? null,
                        });
                        break;
                }
            })
        };

        // -------------------hhhhhhhhhhh
        const postOperasi = (props) => {
            let visit = <?= json_encode($visit) ?>;
            postData({
                body_id: props?.vactination_id,
            }, 'admin/PatientOperationRequest/getDataAssessmentPostOperasi', (res) => {
                getAvalueType({
                    p_type: 'OPRS009',
                    content_id: 'informasi-post-operasi-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
            });
            let catatan = `
                    <div class="container">
                        <div class="row">
                            <div id="informasi-post-operasi-1" class="py-4 row"></div>
                        </div>
                    </div>
                    `;
            $('#ck-informasi-post-operasi').html(catatan);

        };

        const laporanAnesthesiLengkap = (props) => {
            let visit = <?= json_encode($visit) ?>;
            let data = props?.data


            let anesthesia_recovery = data?.assessment_anesthesia_recovery
            let aldreteScore = anesthesia_recovery?.aldrete[anesthesia_recovery?.aldrete?.length - 1] ?? 0
            let bromageScore = anesthesia_recovery?.bromage[anesthesia_recovery?.bromage?.length - 1] ?? 0
            let stewardScore = anesthesia_recovery?.steward[anesthesia_recovery?.steward?.length - 1] ?? 0

            let resultaldreteScore = (
                (aldreteScore?.value_score_01 ?? 0) +
                (aldreteScore?.value_score_02 ?? 0) +
                (aldreteScore?.value_score_03 ?? 0) +
                (aldreteScore?.value_score_04 ?? 0) +
                (aldreteScore?.value_score_05 ?? 0)
            );
            let resultbromageScore = bromageScore?.value_score ?? 0
            let resultStewardScore = (
                (stewardScore?.value_score_01 ?? 0) +
                (stewardScore?.value_score_02 ?? 0) +
                (stewardScore?.value_score_03 ?? 0)
            );


            getAvalueType({
                p_type: 'OPRS011',
                content_id: 'informasiMedis-laporan-anesthesia-details-1',
                body_id: data?.assessment_anesthesia?.document_id ?? pasienOperasiSelected
                    ?.vactination_id,
                get_data: data?.assessment_anesthesia,
            });
            getAvalueType({
                p_type: 'OPRS013',
                content_id: 'informasiMedis-Anesthesi-dan-Sedasi-1',
                body_id: data?.assessment_operation_post?.document_id ?? pasienOperasiSelected
                    ?.vactination_id,
                get_data: data?.assessment_anesthesia_post,
            });


            getAvalueType({
                p_type: 'OPRS014',
                content_id: 'informasiMedis-Anesthesi-dan-Sedasi-2',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data?.assessment_anesthesia_post,
            });

            getAvalueType({
                p_type: 'OPRS029',
                content_id: 'recovery-room-oprs029',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: anesthesia_recovery?.infusion,
            });
            getAvalueType({
                p_type: 'OPRS030',
                content_id: 'recovery-room-oprs030',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: anesthesia_recovery?.general,
            });
            getAvalueType({
                p_type: 'OPRS031',
                content_id: 'recovery-room-oprs031',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: anesthesia_recovery?.ventilasi,
            });
            getAvalueType({
                p_type: 'OPRS032',
                content_id: 'recovery-room-oprs032',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: anesthesia_recovery?.jalan_napas,
            });
            getAvalueType({
                p_type: 'OPRS033',
                content_id: 'recovery-room-oprs033',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: anesthesia_recovery?.regional,
            });

            let oprs011 = `
                    <div class="container">
                        <div class="row">
                            <div id="informasiMedis-laporan-anesthesia-details-1" class="row"></div>
                            </div>
                        </div>
                    </div>
                    `;

            let obatInhalasi = `
                    <div class="container">
                        <div class="row">
                            <div id="obatInhalasi-1" class="table tablecustom-responsive">
                                <table class="table">
                                    <thead class="table">
                                        <tr>
                                            <th scope="col">Waktu</th>
                                            <th scope="col">Obat Inhalasi</th>
                                            <th scope="col">Volume</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyDataObatInhalasi" class="table-group-divider">
                                        <tr>
                                            <td colspan="3">Data Kosong</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    `;

            let obatInjeksi = `
                    <div class="container">
                        <div class="row">
                            <div id="obatInjeksi-1" class="table tablecustom-responsive">
                                <table class="table">
                                    <thead class="table">
                                        <tr>
                                            <th scope="col">Waktu</th>
                                            <th scope="col">Obat Injeksi</th>
                                            <th scope="col">Volume</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyDataObatInjeksi" class="table-group-divider">
                                        <tr>
                                            <td colspan="3">Data Kosong</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    `;
            let cairanMasuk = `
                    <div class="container">
                        <div class="row">
                            <div id="cairanMasuk-1" class="table tablecustom-responsive">
                                <table class="table">
                                    <thead class="table">
                                        <tr>
                                            <th scope="col">Waktu</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">volume</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyDatacairanMasuk" class="table-group-divider">
                                        <tr>
                                            <td colspan="10">Data Kosong</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    `;
            let oprs006 = `
                        <div class="container">
                            <div class="row">
                                <input class="form-control" id="body_id-laporan_anestesiLengkap" name="body_id" value="" hidden></input>
                                <div class="row mb-4 pt-4">
                                    <div class="table tablecustom-responsive">
                                        <h4><b>DIAGNOSA NEW</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 40%">Diagnosa</th>
                                                <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                <th class="text-center" style="width: 20%">Kategori Diagnosis</th>
                                            </thead>
                                            <tbody id="bodyDiagLaporanAnesthesiLengkap-${data?.assessment_anesthesia?.document_id ?? pasienOperasiSelected?.vactination_id}">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag-lengkap" name="adddiagnosa" class="btn btn-secondary">
                                            <i class="fa fa-check-circle"></i> <span>Diagnosa</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
            let monitoringDurante = `
                    <div class="container">
                        <div class="row">
                            <div id="cairanMasuk-1" class="table tablecustom-responsive">
                                 <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="box box-info">
                                            <div class="box-body">
                                                <canvas id="myChartMonitoringDurante" width="auto" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="monitoringDurante-1" class="table tablecustom-responsive">
                                <table class="table">
                                    <thead class="table">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">TD(S)</th>
                                            <th scope="col">TD(D)</th>
                                            <th scope="col">NADI</th>
                                            <th scope="col">SUHU</th>
                                            <th scope="col">RR</th>
                                            <th scope="col">SPO2</th>
                                            <th scope="col">CATATAN</th>
                                            <th scope="col">STAFF NAME</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyDatamyChartMonitoringDurante" class="table-group-divider">
                                        <tr>
                                            <td colspan="10" class="text-center">Data Kosong</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    `;
            let recoveryRoom = `
                        <div class="container">
                            <div class="row">
                                <div id="cairanMasuk-1" class="table tablecustom-responsive">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="box box-info">
                                                <div class="box-body">
                                                    <canvas id="myChartRecoveryRoom" width="auto" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="RecoveryRoom-1" class="table tablecustom-responsive">
                                    <table class="table">
                                        <thead class="table">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">TD(S)</th>
                                                <th scope="col">TD(D)</th>
                                                <th scope="col">NADI</th>
                                                <th scope="col">SUHU</th>
                                                <th scope="col">RR</th>
                                                <th scope="col">SPO2</th>
                                                <th scope="col">CATATAN</th>
                                                <th scope="col">STAFF NAME</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyDatamyChartRecoveryRoom" class="table-group-divider">
                                            <tr>
                                                <td colspan="10" class="text-center">Data Kosong</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    `;
            let roomRecoveryScore = `
                        <div class="container">
                            <div class="row">
                                <div id="cKeperawatanPascaOperatif-1" class="row"></div>
                                <div class="row mt-4">
                                    <div class="table tablecustom-responsive">
                                        <h5><b>Aldrete</b></h5>
                                        <hr>
                                        <table id="tablediagnosa" class="table">
                                            <thead>
                                                <th class="text-center fit" >Aktivitas</th>
                                                <th class="text-center fit" >Pernafasan</th>
                                                <th class="text-center fit" >Circulation</th>
                                                <th class="text-center fit" >Kesadaran</th>
                                                <th class="text-center fit" >Saturasi O2</th>
                                                <th class="text-center fit" >Skor Aldrete</th>
                                            </thead>
                                            <tbody id="bodyAldreteoprs023-1"></tbody>
                                        </table>
                                        <div class="box-tab-tools my-3" style="text-align: center;">
                                            <button type="button" id="addAldrete-1" name="addAldrete" data-body="bodyAldreteoprs023-1" data-loading-text="" class="btn btn-secondary"><span>Tambah</span></button>
                                        </div>
                                    </div>
                                </div>
                                <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value="${data?.trans_id ?? visit?.trans_id}" hidden></input>
                                <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value="${data?.body_id}" hidden></input>
                                <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value="${data?.org_unit_code ?? visit?.org_unit_code}" hidden></input>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <h5><b>Bromage</b></h5>
                                <div id="bromageContainer1" class="row"></div>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm my-3" id="addBromage1">+ Tambah Bromage</button>
                        </div>
                        <div class="container">
                            <div class="row">
                                <h5><b>Steward</b></h5>
                                <input class="form-control disabled" id="trans_id-steward" name="trans_id" value="${data?.trans_id ?? visit?.trans_id}" hidden></input>
                                <input class="form-control disabled" id="body_id-steward" name="body_id" value="${data?.body_id}" hidden></input>
                                <input class="form-control disabled" id="org_unit_code-steward" name="org_unit_code" value="${data?.org_unit_code ?? visit?.org_unit_code}" hidden></input>
                                <div id="stewardContainer1" class="row"></div>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm my-3" id="addSteward1">+ Tambah Steward</button>
                        </div>
            `;

            let recoveryRoomOprs029Oprs033 = `
                <div class="container mb-3">
                    <h3>Infus</h3>
                    <div class="row mb-3">
                        <div id="recovery-room-oprs029" class="row"></div>
                    </div>
                </div>
                <div class="container my-3">
                    <h3>Regional Anestesia</h3>
                    <div class="row">
                        <div id="recovery-room-oprs033" class="row"></div>
                    </div>
                </div>
                <div class="container mb-3">
                    <h3>General Anestesia</h3>
                    <div class="row">
                        <div id="recovery-room-oprs030" class="row"></div>
                    </div>
                </div>
                <div class="container mb-3">
                    <h3>Ventilasi</h3>
                    <div class="row">
                        <div id="recovery-room-oprs031" class="row"></div>
                    </div>
                </div>
                <div class="container mb-3">
                    <h3>Jalan Napas</h3>
                    <div class="row">
                        <div id="recovery-room-oprs032" class="row"></div>
                    </div>
                </div>
            `; //new 02/09
            let monitoringDurante1 = `
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="anesthesiaStart" class="form-label"><strong>Anesthesia Start Time:</strong></label>
                                                <input type="text" id="anesthesiaStart" name="start_anesthesia" class="form-control datetimeflatpickr">
                                            </div>
                                            <div class="mb-3">
                                                <label for="anesthesiaEnd" class="form-label"><strong>Anesthesia End Time:</strong></label>
                                                <input type="text" id="anesthesiaEnd" name="end_anesthesia" class="form-control datetimeflatpickr">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="surgeryStart" class="form-label"><strong>Surgery Start Time:</strong></label>
                                                <input type="text" id="surgeryStart" name="surgeryStart" class="form-control datetimeflatpickr">
                                            </div>
                                            <div class="mb-3">
                                                <label for="surgeryEnd" class="form-label"><strong>Surgery End Time:</strong></label>
                                                <input type="text" id="surgeryEnd" name="surgeryEnd" class="form-control datetimeflatpickr">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
            let oprs013 = `
                    <div class="container">
                        <div class="row">
                            <div id="informasiMedis-Anesthesi-dan-Sedasi-1" class="row"></div>
                        </div>
                    </div>
                    `;

            let output = `<div class="container">
                            <div class="row">
                                <div id="informasiMedis-laporan-output-2" class="row">
                                            <div class="mb-3 col-6">
                                                <label for="anesthesiaStart" class="form-label"><strong>Bleeding Amount:</strong></label>
                                                <input type="Number" id="bleeding_amount_val" name="bleeding_amount" class="form-control">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="anesthesiaEnd" class="form-label"><strong>Urine Output:</strong></label>
                                                <input type="Number" id="urine_amount_val" name="urine_amount" class="form-control">
                                            </div>
                                </div>
                            </div>
                        </div>`;
            let medication = `
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div id="medication-1" class="table tablecustom-responsive">
                            <h4 class="fw-bold">Recovery Room Medication</h4>
                                <table class="table">
                                    <thead class="table">
                                        <tr>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Volume</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyDataMedication" class="table-group-divider">
                                        <tr>
                                            <td colspan="3">Data Kosong</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    `;



            let oprs014 = `
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div id="informasiMedis-Anesthesi-dan-Sedasi-2" class="row"></div>
                            <div id="s-2" class="row">
                                <div class="row pl-sm-0 col-4" id="type-container-01-OPRS014">
                                    <div class="form-group mb-0 pt-4">
                                        <label class="fw-bold" for="recovery_leave_time_01">Final Aldrette Score</label>
                                        <span class="form-control-plaintext datetime-input" id="oprs014_01">${resultaldreteScore ?? 0}</span>
                                    </div>
                                </div>
                                <div class="row pl-sm-0 col-4" id="type-container-02-OPRS014">
                                    <div class="form-group mb-0 pt-4">
                                        <label class="fw-bold" for="patient_destination_02">Final Bromage Score</label>
                                        <span class="form-control-plaintext" id="oprs014_02">${resultbromageScore ?? 0}</span>
                                    </div>
                                </div>
                                <div class="row pl-sm-0 col-4" id="type-container-03-OPRS014">
                                    <div class="form-group mb-0 pt-4">
                                        <label class="fw-bold" for="patient_destination_03">Final Steward Score</label>
                                        <span class="form-control-plaintext" id="oprs014_03">${resultStewardScore ?? 0}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                `;
            let ttdAll = `
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2 ps-3 pb-2">
                            <div class="form-group">
                                <label><strong>Tanda Tangan Dokter</strong></label>
                                <div class="position-relative" id="qr-1-${data?.assessment_anesthesia?.body_id}">
                                    <button type="button" id="formALengkapSignBtn1" name="signAlengkap" data-sign-ke="1"
                                        data-button-id="btn-save-laporan-anesthesiLengkap" class="btn btn-warning">
                                        <i class="fa fa-signature"></i> <span>Sign</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2 ps-3 pb-2">
                            <div class="form-group">
                                <label><strong>Tanda Tangan Dokter</strong></label>
                                <div class="position-relative" id="qr-2-${data?.assessment_anesthesia?.body_id}">
                                    <button type="button" id="formALengkapSignBtn2" name="signAlengkap" data-sign-ke="2"
                                        data-button-id="btn-save-laporan-anesthesiLengkap" class="btn btn-warning">
                                        <i class="fa fa-signature"></i> <span>Sign</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;

            $('#weight-laporanAnesthesi-lengkap-durantee').val(props?.exam_info.weight)
            $('#height-laporanAnesthesi-lengkap-durantee').val(props?.exam_info.height)

            $('#weight-laporanAnesthesi-lengkap').val(props?.exam_info.weight)
            $('#height-laporanAnesthesi-lengkap').val(props?.exam_info.height)

            $("#informasiMedis-laporan-durante-signature").html(ttdAll);
            $('#informasiMedis-laporan-output').html(output)
            $('#bodyDiagnosisAnesthesiLengkap').html(oprs006);
            $('#informasiMedis-laporan-anesthesia-details').html(oprs011);
            $('#informasiMedis-laporan-obat-inhalasi').html(obatInhalasi);
            $('#informasiMedis-laporan-obat-injeksi').html(obatInjeksi);
            $('#informasiMedis-laporan-cairan-masuk').html(cairanMasuk);
            $('#informasiMedis-laporan-monitoring-durante-date').html(monitoringDurante1);
            $('#informasiMedis-laporan-monitoring-durante-2').html(monitoringDurante);
            $('#informasiMedis-laporan-recovery-medication').html(medication);
            $('#informasiMedis-laporan-recovery-room-monitoring').html(recoveryRoom);
            $('#informasiMedis-laporan-recovery-room-monitoring-score').html(roomRecoveryScore);
            $('#body-recovery-room-oprs029-oprs033').html(recoveryRoomOprs029Oprs033);
            $('#informasiMedis-laporan-intruksi-pasca-anesthesi').html(oprs013)
            $('#informasiMedis-laporan-recovery-room-monitoring-score-2').html(oprs014)

            $("#formdiag-lengkap").on("click", function(e) {
                addRowDiagDokter('bodyDiagLaporanAnesthesiLengkap-', pasienOperasiSelected?.vactination_id);
            });

            $("#bleeding_amount_val").val(data?.assessment_anesthesia?.bleeding_amount ?? 0)
            $("#urine_amount_val").val(data?.assessment_anesthesia?.urine_amount ?? 0)
            if (data?.assessment_anesthesia?.start_anesthesia) {
                $("#anesthesiaStart").val(moment(data?.assessment_anesthesia.start_anesthesia).format(
                    'DD/MM/YYYYTHH:mm'));
                // 'YYYY-MM-DDTHH:mm'));
            }
            if (data?.assessment_anesthesia?.end_anesthesia) {
                $("#anesthesiaEnd").val(moment(data?.assessment_anesthesia.end_anesthesia).format(
                    'DD/MM/YYYYTHH:mm'));
            }

            let startOperation = pasienOperasiSelected?.start_operation;
            let endOperation = pasienOperasiSelected?.end_operation;
            let formatDate = (date) => date ? moment(date).format('YYYY-MM-DDTHH:mm') : '';
            let validEndOperation = endOperation && moment(endOperation).isSameOrAfter(startOperation);

            $("#surgeryStart").val(formatDate(startOperation));
            $("#surgeryEnd").val(validEndOperation ? formatDate(endOperation) : moment().format(
                'YYYY-MM-DDTHH:mm'));


            $("#body_id-laporan_anestesiLengkap").val(data?.assessment_anesthesia?.body_id ?? get_bodyid());
            $("#document_id-laporan_anestesiLengkap").val(pasienOperasiSelected?.vactination_id);

            if (anesthesia_recovery?.bromage) {
                anesthesia_recovery?.bromage.forEach(each => {

                    addBromage({
                        document_id: pasienOperasiSelected?.vactination_id,
                        data: each,
                        container: 'bromageContainer1',
                        bodyId: 'bodyBromage1'
                    })
                    $("#addBromage1").hide();

                })
            }

            if (anesthesia_recovery?.steward) {
                anesthesia_recovery?.steward.forEach((item, index) => {
                    addSteward({
                        document_id: pasienOperasiSelected?.vactination_id,
                        item: item,
                        index: index, // new 08/08
                        container: 'stewardContainer1'
                    })
                    $("#addSteward1").hide();
                });
            }

            $("#addBromage1").on("click", function(e) {
                let bromageCount = $('#bromageContainer1 .bromage-item').length;


                if (bromageCount === 0) {
                    addBromage({
                        document_id: pasienOperasiSelected?.vactination_id,
                        data: {},
                        container: 'bromageContainer1',
                        bodyId: 'bodyBromage1'
                    })

                    $(this).hide();
                }
            });

            $("#addSteward1").on("click", function(e) {
                let rowCount = $('#stewardContainer1 tr').length;
                if (rowCount === 0) {
                    addSteward({
                        document_id: pasienOperasiSelected?.vactination_id,
                        item: {},
                        index: rowCount, // new 08/08,
                        container: 'stewardContainer1'
                    })
                    $(this).hide();
                }
            });



            $('#bodyAldreteoprs023').empty();


            if (data?.assessment_anesthesia_recovery?.aldrete) {
                data?.assessment_anesthesia_recovery?.aldrete.forEach((item, index) => {
                    AddRowAldrete005({
                        item: item,
                        index: index,
                        container: 'bodyAldreteoprs023-1'
                    });
                    $("#addAldrete-1").hide()

                });
            }

            $('#addAldrete-1').click(function() {
                let rowCount = $('#bodyAldreteoprs023-1 tr').length;

                if (rowCount === 0) {
                    AddRowAldrete005({
                        item: {},
                        index: rowCount,
                        container: 'bodyAldreteoprs023-1'

                    });
                    $(this).hide();
                }

            });


            getVitalSignLaporanAnesthesiLengkap('vitalSignBodyLaporanAnesthesiLengkap', '11');
            getVitalSignLaporanAnesthesiLengkap('vitalSignBodyLaporanAnesthesiLengkap2', '12');
            getVitalSignLaporanAnesthesiLengkap2('vitalSignBodyLaporanAnesthesiLengkap3', '13');

            if (data?.assessment_anesthesia?.body_id) {

                getDataVitailSign({
                    pasien_diagnosa_id: data?.assessment_anesthesia?.body_id,
                    account_ids: ['11', '12', '13'],
                    suffixes: ["-laporanAnesthesi-lengkap", "-laporanAnesthesi-lengkap-durante",
                        "-laporanAnesthesi-lengkap-monitoring"
                    ]
                });


                getDataDiagnosasss({
                    pasien_diagnosa_id: data?.assessment_anesthesia?.body_id,
                    vactination_id: pasienOperasiSelected?.vactination_id
                });
            }
            const monitoringDuranteId = '#monitoringDurante-1';
            const recoveryRoomId = '#RecoveryRoom-1';


            getRequestVtRangeAnesthesia({
                vactination_id: pasienOperasiSelected?.vactination_id,
                filters: ["ALL", "13"],
                body_requestCharts: ["myChartMonitoringDurante", "myChartRecoveryRoom"],
                body_requestTables: ["bodyDatamyChartMonitoringDurante", "bodyDatamyChartRecoveryRoom"]
            });


            const formId = 'form-laporanAnesthesi-lengkap';
            const primaryKey = data?.assessment_anesthesia?.body_id;
            const formSaveBtn = 'btn-save-laporan-anesthesiLengkap';


            $("#vs_status_id-laporanAnesthesi-lengkap-durantee").on("change", function() {
                var optionSelected = $("option:selected", this);
                $('#container-vitalsign-laporanAnesthesi-lengkap-durantee').empty();

                switch (optionSelected.val()) {
                    case '4':
                        getAvalueType({
                            p_type: 'GEN0022',
                            content_id: 'container-vitalsign-laporanAnesthesi-lengkap-durantee',
                            body_id: pasienOperasiSelected?.vactination_id,
                            get_data: data ?? null,
                        });
                        break;
                    case '10':
                        getAvalueType({
                            p_type: 'GEN0021',
                            content_id: 'container-vitalsign-laporanAnesthesi-lengkap-durantee',
                            body_id: pasienOperasiSelected?.vactination_id,
                            get_data: data ?? null,
                        });
                        break;
                }
            })
            $("#vs_status_id-laporanAnesthesi-lengkap").on("change", function() {
                var optionSelected = $("option:selected", this);
                $('#container-vitalsign-laporanAnesthesi-lengkap').empty();

                switch (optionSelected.val()) {
                    case '4':
                        getAvalueType({
                            p_type: 'GEN0022',
                            content_id: 'container-vitalsign-laporanAnesthesi-lengkap',
                            body_id: pasienOperasiSelected?.vactination_id,
                            get_data: data ?? null,
                        });
                        break;
                    case '10':
                        getAvalueType({
                            p_type: 'GEN0021',
                            content_id: 'container-vitalsign-laporanAnesthesi-lengkap',
                            body_id: pasienOperasiSelected?.vactination_id,
                            get_data: data ?? null,
                        });
                        break;
                }
            })

            $("button[name='signAlengkap']").each(function() {
                if (data?.assessment_anesthesia?.body_id) {
                    $(this).prop('disabled', false);
                } else {
                    $(this).prop('disabled', true);
                }
            });

            $("button[name='signAlengkap']").off().on("click", function() {
                const buttonId = $(this).data('button-id');
                const signKe = $(this).data('sign-ke');
                if (!$(this).is(':disabled')) {
                    addSignUserOPS("form-laporanAnesthesi-lengkap", "anesthesi-lengkap", data
                        ?.assessment_anesthesia?.body_id,
                        buttonId, 10, signKe, 1, "Laporan Anesthesi Lengkap");
                }
            });


            // if (data?.assessment_anesthesia?.body_id) {
            //     checkSignSignature1(formId, primaryKey, formSaveBtn, '10');
            // }
            btnSaveLaporanAnestesiLengkap(pasienOperasiSelected)
        }



        const getType = (props) => {


            return new Promise((resolve) => {
                let htmlContent = '';
                let initializeQuill = false;
                let isAnastesi = props?.p_type == 'OPRS007'; //new


                let aValue = <?= json_encode($aValue) ?>;
                // let colClass = props?.code === 4 ? 'col-12' : 'col-6';
                const validTypesRecoveryRoom = ['OPRS029', 'OPRS030', 'OPRS031', 'OPRS032', 'OPRS033'];

                if ([3, 4, 7].includes(parseInt(props?.code))) {
                    let matchedData = aValue?.filter(item => item?.parameter_id === props
                        ?.parameter_id &&
                        item?.p_type === props?.p_type);
                    let valueProp = props?.p_type === "" ? 'value_score' : 'value_id';



                    switch (parseInt(props?.code)) {
                        case 3:
                            let selectOptions = '';
                            if (props?.p_type == 'OPRS024') {
                                selectOptions = matchedData?.map(item =>
                                    `<option value="${item[valueProp]}" data-type="${item?.p_type}" data-score="${item?.value_score}" data-desc="${item?.value_desc}" data-parameter="${item?.parameter_id}" ${props?.get_data?.value_id === item[valueProp] ? 'selected' : ''}>${item?.value_desc}</option>`
                                ).join('');
                            } else if (props?.p_type == 'GEN0022' || props?.p_type == 'GEN0021') {

                                selectOptions = matchedData?.map(item =>
                                    `<option value="${item['value_score']}" ${(props?.get_data?.[props?.column_name?.toLowerCase()] ?? "") === item[valueProp] ? 'selected' : ''}>${item?.value_desc}</option>`
                                ).join('');
                            } else if (props?.p_type && validTypesRecoveryRoom.includes(props.p_type)) {
                                selectOptions = matchedData?.map(item =>
                                    `<option value="${item['value_id']}" data-score="${item?.value_score}" data-desc="${item?.value_desc}"  ${props?.get_data?.['value_desc_'+props?.parameter_id] == item?.value_desc ? 'selected': ''}>${item?.value_desc}</option>`
                                ).join('');
                            } else {

                                selectOptions = matchedData?.map(item =>
                                    `<option value="${item[valueProp]}" ${(props?.get_data?.[props?.column_name?.toLowerCase()] ?? "") === item[valueProp] ? 'selected' : ''}>${item?.value_desc}</option>`
                                ).join('');
                            }

                            if (props?.p_type == 'GEN0022' || props?.p_type == 'GEN0021') {
                                htmlContent = `
                                    <div class="form-group mb-0 pt-4">
                                        <label for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                        <select class="form-select" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">
                                            <option value="" selected>Pilih</option>
                                            ${selectOptions}
                                        </select>
                                    </div>
                                `;
                            } else if (props?.p_type && validTypesRecoveryRoom.includes(props.p_type)) {
                                htmlContent = `
                                    <div class="form-group mb-0 pt-4">
                                        <label for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                        <select class="form-select" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">
                                            <option value="" selected>Pilih</option>
                                            ${selectOptions}
                                        </select>
                                    </div>
                                `;
                            } else {

                                htmlContent = `
                                    <div class="form-group mb-0 pt-4">
                                        <label for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                        <select class="form-select" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.column_name?.toLowerCase()}">
                                            <option value="" selected>Pilih</option>
                                            ${selectOptions}
                                        </select>
                                    </div>
                                `;
                            }
                            break;

                        case 4:
                            initializeQuill = true; // Set flag to initialize Quill
                            if (props?.p_type && validTypesRecoveryRoom.includes(props.p_type)) {
                                htmlContent = `
                                    <div class="form-group pb-5 pt-4">
                                        <label class="fw-bold" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                        <input type="hidden" name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" data-score="${props?.value_score}" data-desc="${props?.parameter_desc}" value="${props?.get_data?.['value_id_'+props?.parameter_id] ?? ''}">
                                        <div id="quill_${props?.p_type?.toLowerCase()}_${props?.parameter_id}" class="quill-editor" name='${props?.p_type?.toLowerCase()}_${props?.parameter_id}'>${props?.get_data?.['value_id_'+props?.parameter_id] ?? ''}</div>
                                    </div>
                                `;
                            } else {

                                htmlContent = `
                                    <div class="form-group pb-5 pt-4">
                                        <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                        <input type="hidden" name="${props?.column_name?.toLowerCase()}" value="${props?.get_data?.[props?.column_name?.toLowerCase()] ?? ''}">
                                        <div id="quill_${props?.column_name?.toLowerCase()}_${props?.parameter_id}" class="quill-editor" name='${props?.column_name?.toLowerCase()}'>${props?.get_data?.[props?.column_name?.toLowerCase()] ?? ''}</div>
                                    </div>
                                `;
                            }
                            break;

                        case 7:
                            if (props?.p_type && validTypesRecoveryRoom.includes(props.p_type)) {
                                let radioOptions = matchedData.map((item, index) => `
                                    <div class="form-check mb-0 pt-4">
                                        <input class="form-check-input" type="radio" name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item[valueProp]}" data-score="${item?.value_score}" data-desc="${item?.value_desc}" value="${item[valueProp]}" ${props?.get_data?.['value_desc_'+ props?.parameter_id] === item.value_desc ? 'checked' : (index === matchedData.length - 1 && !props?.get_data?.['value_desc_'+ props?.parameter_id] ? 'checked' : '')}>
                                        <label class="form-check-label" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item[valueProp]}">${item.value_desc}</label>
                                    </div>
                                `).join('');
                                htmlContent = `
                                    <div class="form-group mb-0 pt-4">
                                        <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                        ${radioOptions}
                                    </div>
                                `;
                            } else {
                                let radioOptions = matchedData.map((item, index) => `
                        <div class="form-check mb-0 pt-4">
                            <input class="form-check-input" type="radio" name="${props?.column_name?.toLowerCase()}" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item[valueProp]}" value="${item[valueProp]}" ${props?.get_data?.[props?.column_name?.toLowerCase()] === item[valueProp] ? 'checked' : (index === matchedData.length - 1 && !props?.get_data?.[props?.column_name?.toLowerCase()] ? 'checked' : '')}>
                            <label class="form-check-label" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item[valueProp]}">${item.value_desc}</label>
                        </div>
                    `).join('');
                                htmlContent = `
                        <div class="form-group mb-0 pt-4">
                            <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                            ${radioOptions}
                        </div>
                    `;
                            }

                            break;

                        default:
                            htmlContent = '';
                            break;
                    }
                } else {
                    let matchedData = aValue?.filter(item => item?.parameter_id === props
                        ?.parameter_id &&
                        item.p_type === props?.p_type);
                    let valueProp = props?.p_type === "" ? 'value_score' : 'value_id';
                    //new
                    switch (parseInt(props?.code)) {
                        case 2:
                            if (props?.p_type && validTypesRecoveryRoom.includes(props.p_type)) {
                                htmlContent = `
                                <div class="form-check mb-0 pt-4">
                                    <input type="hidden" name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" value="">
                                    <input type="checkbox" class="form-check-input" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}"  data-score="${props?.value_score ?? ''}" data-desc="${props?.parameter_desc}" name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" value="1" ${props?.get_data?.['value_id_'+props?.parameter_id] ?? "" === '1' ? 'checked' : ''}>
                                    <label class="form-check-label" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                </div>
                                `;
                            } else {

                                htmlContent = `
                                <div class="form-check mb-0 pt-4">
                                    <input type="hidden" name="${props?.column_name?.toLowerCase()}" value="">
                                    <input type="checkbox" class="form-check-input" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.column_name?.toLowerCase()}" value="1" ${props?.get_data?.[props?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''}>
                                    <label class="form-check-label" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                </div>
                                `;
                            }
                            break;


                        case 5:
                            let data_start_operation = '';
                            if (isAnastesi) {
                                if (props?.column_name?.toLowerCase() == 'start_operation') {
                                    data_start_operation = moment(props?.data_tindakan[props
                                        ?.column_name
                                        ?.toLowerCase()], "YYYY-MM-DDTHH:mm").format(
                                        "YYYY-MM-DDTHH:mm");
                                }
                            }

                            htmlContent = `
                        <div class="form-group mb-0 pt-4">
                            <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                            <input class="form-control datetime-input" type="hidden" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.column_name?.toLowerCase()}" value="${ isAnastesi ? data_start_operation : props?.get_data?.[props?.column_name?.toLowerCase()] ?  moment(new Date(props?.get_data?.[props?.column_name?.toLowerCase()])).format("DD/MM/YYYY HH:mm") : ''}" ${isAnastesi ? 'disabled' : ''}>
                            <input class="form-control datetime-input datetimeflatpickr" type="text" id="flat${props?.p_type?.toLowerCase()}_${props?.parameter_id}" value="${ isAnastesi ? data_start_operation : props?.get_data?.[props?.column_name?.toLowerCase()] ? moment(new Date(props?.get_data?.[props?.column_name?.toLowerCase()])).format("DD/MM/YYYY HH:mm") : ''}" ${isAnastesi ? 'disabled' : ''}>
                        </div>
                             `;


                            break;
                        case 6:
                            let multiOptions = matchedData?.map((item, index) => `
                        <div class="form-check mb-0 pt-4">
                            <input type="checkbox" class="form-check-input" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item[valueProp]}" name="${item?.value_info?.toLowerCase()}" value="${item.value_score}" ${props?.get_data?.[item?.value_info?.toLowerCase()] !== null ? 'checked' : ''}>
                            <label class="form-check-label" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item[valueProp]}">${item.value_desc}</label>
                        </div>
                    `).join('');
                            htmlContent = `
                        <div class="form-group mb-0 pt-4">
                            <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                             ${multiOptions}
                        </div>
                    `;
                            break;
                        case 1:
                            if (props?.p_type && validTypesRecoveryRoom.includes(props.p_type)) {
                                htmlContent = `
                                    <div class="form-group mb-0 pt-4">
                                        <label class="fw-bold" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                    <input type="text" class="form-control form-thems" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}"  data-score="${props?.value_score}" data-desc="${props?.parameter_desc}" name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" value="${props?.get_data?.['value_desc_'+props?.parameter_id] == props?.parameter_desc ? props?.get_data?.['value_id_'+props?.parameter_id]: ''}" >
                                    </div>
                                `;
                            } else {
                                htmlContent = `
                                    <div class="form-group mb-0 pt-4">
                                        <label class="fw-bold" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                    <input type="text" class="form-control form-thems" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.column_name?.toLowerCase()}" value="${isAnastesi ? (props?.items[props?.column_name?.toLowerCase()] ?? '') : (props?.get_data?.[props?.column_name?.toLowerCase()] ?? '')}" ${isAnastesi ? 'disabled' : ''}>
                                    </div>
                                `;
                            }


                            if (isAnastesi) {
                                if (props?.column_name?.toLowerCase() == 'type_of_anesthesia') {
                                    if (props?.items.type_of_anesthesia) {
                                        getDataColumnName({
                                            table_name: 'ASSESSMENT_PARAMETER_VALUE',
                                            column_name: 'value_desc',
                                            column_id: 'value_id',
                                            id: props?.items.type_of_anesthesia,
                                            element_id: props?.p_type?.toLowerCase() + '_' + props
                                                ?.parameter_id
                                        })
                                    }


                                }

                            }
                            break;
                        default:
                            htmlContent = '';
                            break;
                    }
                }

                const container = document.createElement('div');
                container.innerHTML = htmlContent;

                resolve({
                    htmlContent: container.innerHTML,
                    initializeQuill
                });
            });
        };

        const initializeQuillEditors = (props) => {
            document.querySelectorAll('.quill-editor').forEach(editor => {
                if (!quillInstances[editor.id]) {
                    const quill = new Quill(editor, {
                        theme: 'snow'
                    });

                    quillInstances[editor.id] = quill;


                    const inputField = document.querySelector(
                        `input[name="${editor.getAttribute('name')}"]`);
                    if (inputField) {
                        const initialContent = inputField.value || '';
                        quill.root.innerHTML = initialContent;

                        quill.on('text-change', () => {
                            const quillContent = quill.root.innerHTML.trim();
                            inputField.value = quillContent === '<p><br></p>' ? '' :
                                quillContent;
                        });
                    }
                }
            });
        };

        const createDropdownTables = (props) => {
            let content = '';
            $("#dropdown-param-tindakan-operasi").html('');
            const extractGroupName = (taskName) => {
                if (taskName.startsWith("Asisten Anestesi")) {
                    return "Asisten Anestesi";
                }
                if (taskName === "Asisten Dokter") {
                    return taskName;
                }
                return taskName.split(" ")[0];
            };

            const groupedTasks = tasksValue.data.reduce((groups, item) => {
                const groupName = extractGroupName(item.task);
                if (!groups[groupName]) groups[groupName] = [];
                groups[groupName].push(item);
                return groups;
            }, {});


            const groupedEmployees = employesValue.data.reduce((groups, item) => {
                let groupLabel;
                switch (item.shift_id) {
                    case 1:
                        groupLabel = "Dokter Operator";
                        break;
                    case 2:
                        groupLabel = "Dokter Anestesi";
                        break;
                    case 3:
                        groupLabel = "Perawat";
                        break;
                    case 4:
                        groupLabel = "Asisten Anestesi";
                        break;
                    default:
                        groupLabel = "Other"; // For any unexpected shift_id
                }
                if (!groups[groupLabel]) groups[groupLabel] = [];
                groups[groupLabel].push(item);
                return groups;
            }, {});

            const generateTaskOptions = (selectedId) => {
                return Object.keys(groupedTasks).map(group => `
                            <optgroup label="${group}">
                                ${groupedTasks[group].map(item => `
                                    <option value="${item.task_id}" ${item.task_id == selectedId ? 'selected' : ''}>${item.task}</option>
                                `).join('')}
                            </optgroup>
                        `).join('');
            };

            const generateEmployeeOptions = (selectedId) => {
                return Object.keys(groupedEmployees).map(group => `
            <optgroup label="${group}">
                ${groupedEmployees[group].map(item => `
                    <option value="${item.employee_id}" ${item.employee_id == selectedId ? 'selected' : ''}>${item.fullname}</option>
                `).join('')}
            </optgroup>
        `).join('');
            };

            let droppdown = `
                        <table class="table table-borderless" id="data-dropdown">
                            <tbody>
                                ${props?.map(e => `
                                    <tr class="bg-light">
                                        <td>
                                            <select class="form-select task-dropdown" name="groupedTasks_option[]">
                                                ${generateTaskOptions(e.task_id)}
                                            </select>
                                        </td>
                                        <td rowspan="2" width="1%">
                                            <button type="button" class="btn btn-danger btn-sm delete-dropdown" style="height:80px;width:50px;"><i class="fas fa-trash-alt fa-2xl"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-select employee-dropdown" name="employee_option[]">
                                                ${generateEmployeeOptions(e.employee_id)}
                                            </select>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                        <div class="d-flex my-3">
                            <button type="button" class="btn btn-success w-100 add-dropdown" style="height:50px;"><i class="fas fa-plus fa-2xl"></i></button>
                        </div>
                    `;

            let contentFormEsekusi = `
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <select class="form-select btn-sm" name="form-action-pelayanan" id="form-action-pelayanan">
                                        <option value="0">Terjadwal</option>
                                        <option value="1">Proses Oprasi</option>
                                        <option value="2">Selesai Oprasi</option>
                                        <option value="3">Tunda Oprasi</option>
                                        <option value="4">Batal Oprasi</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    `;

            let TransaksiContent = `
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <select class="form-select btn-sm" name="transaksi-permintaan_operasi" id="transaksi-permintaan_operasi">
                                        <option value="0">Belum Transaksi</option>
                                        <option value="1">Transaksi</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    `;

            $("#dropdown-param-tindakan-operasi").html(content + droppdown + contentFormEsekusi + TransaksiContent);

            $('#dropdown-param-tindakan-operasi').on('click', '.delete-dropdown', function() {
                $(this).closest('tr').next().remove(); // Remove the next row
                $(this).closest('tr').remove(); // Remove the current row
            });

            $('#dropdown-param-tindakan-operasi').on('click', '.add-dropdown', function() {
                let selectedTasks = $('.task-dropdown').map(function() {
                    return $(this).val();
                }).get();

                if (selectedTasks.includes('pilih') || selectedTasks.includes(null)) {
                    return;
                }

                let newTaskOptions = Object.keys(groupedTasks).map(group => `
                            <optgroup label="${group}">
                                ${groupedTasks[group].filter(item => !selectedTasks.includes(item.task_id)).map(item => `
                                    <option value="${item.task_id}">${item.task}</option>
                                `).join('')}
                            </optgroup>
                        `).join('');

                let newTaskOptionsEmployee = Object.keys(groupedEmployees).map(group => `
                            <optgroup label="${group}">
                                ${groupedEmployees[group].filter(item => !selectedTasks.includes(item.employee_id)).map(item => `
                                    <option value="${item.employee_id}">${item.fullname}</option>
                                `).join('')}
                            </optgroup>
                        `).join('');

                if (!newTaskOptions.trim()) {
                    alert('Semua task sudah dipilih, tidak ada task baru yang dapat ditambahkan!');
                    return;
                }

                let dataDropdownContent = `
                            <tr class="bg-light">
                                <td>
                                    <select class="form-select task-dropdown" name="groupedTasks_option[]">
                                        <option value="pilih">pilih</option>
                                        ${newTaskOptions}
                                    </select>
                                </td>
                                <td rowspan="2" width="1%">
                                    <button type="button" class="btn btn-danger btn-sm delete-dropdown" style="height:80px;width:50px;"><i class="fas fa-trash-alt fa-2xl"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-select employee-dropdown" name="employee_option[]">
                                        <option value="pilih">pilih</option>
                                        ${newTaskOptionsEmployee}
                                    </select>
                                </td>
                            </tr>
                        `;

                $('#data-dropdown tbody').append(dataDropdownContent);

                initializeSelect2();
            });

            initializeSelect2();
        };




        const getDropdownOptions = (shiftId) => {
            let options = '';

            window.employees.data.forEach(employee => {
                if (shiftId === null ||
                    (shiftId === 1 && employee.shift_id === 1) ||
                    (shiftId === 2 && employee.shift_id === 2) ||
                    (shiftId === 3 && employee.shift_id === 3) ||
                    (shiftId === 4 && employee.shift_id !== 2)) {
                    options +=
                        `<option value="${employee.employee_id}">${employee.fullname}</option>`;
                }
            });

            return `<option selected disabled value="">Pilih</option>` + options;
        };

        const renderDataRequestOperation = (data) => {
            let hasil = "";
            data?.data?.map((item, index) => {
                let treatment = treatmentData.find(t => t.tarif_id === item?.tarif_id);
                let treatmentName = treatment ? treatment.tarif_name : "-";
                let treatmentPrice = treatment ? (treatment.amount_paid ?? '0') : "0";

                hasil += `<tr class="${
                                item?.patient_category_id === 0 ? 'outline-white-bg' :
                                item?.patient_category_id === 1 ? 'outline-warning-bg' :
                                item?.patient_category_id === 2 ? 'outline-danger-bg' : ''
                                }">

                <td>${index + 1}</td>
                <td>${moment(item?.start_operation).format("DD/MM/YYYY HH:mm")}</td>
                <td class="operation_action cursor-pointer pointer text-primary fw-bold text-decoration-underline" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}"
                 data-visit_id="${item?.visit_id}"><strong>${treatmentName}</strong></td>
                <td>${formatToIDRResult(treatmentPrice)}</td>
                <td>${item?.doctor ?? "-"}</td>
                <td>
                    ${item?.terlayani === 0 ? `
                    <?php if (user()->checkPermission("pasienoperasi", 'c') || user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>

                        <button type="button" class="btn btn-sm btn-info btn-show-detail-requestOperation" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                           <i class="far fa-eye"></i> Lihat
                        </button>
                        <button type="button" class="btn btn-sm btn-primary btn-show-edit-requestOperation" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                          <i class="far fa-edit"></i> Ubah
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btn-show-delete-requestOperation" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                          <i class="far fa-trash-alt"></i> Hapus
                        </button>
                        <?php } ?>

                        <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>
                        <button type="button" class="btn btn-sm btn-success btn-show-assesment-requestOperation" data-date="${moment(item?.start_operation).format("DD/MM/YYYY HH:mm")}" data-treatname="${treatmentName}" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                           <i class="far fa-file-alt"></i> Asssesment
                        </button>
                        <?php } ?>
                        ` : `
                         <?php if (user()->checkPermission("pasienoperasi", 'c') || user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>

                        <button type="button" class="btn btn-sm btn-info btn-show-detail-requestOperation" data-noregis="${item?.no_registration}"  data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                            <i class="far fa-eye"></i> Lihat
                        </button>
                        <?php } ?>

                         <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>
                        <button type="button" class="btn btn-sm btn-success btn-show-assesment-requestOperation" data-date="${moment(item?.start_operation).format("DD/MM/YYYY HH:mm")}" data-treatname="${treatmentName}" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                           <i class="far fa-file-alt"></i> Asssesment
                        </button>
                        <?php } ?>
                    `}
                </td>
            </tr>`;
            });
            $("#bodydataRequestOperation").html(hasil);

            getDetailRequestOperation();
            getEditRequestOperation();
            deleteModalDataRequestOperation();
            viewModalOperationAction();
            groupingGetAllArcodions(data?.data);
            getDataPenyakit(data?.data[0]);
        }

        //GET DATA

        const templateOprasiPembedahan = (props) => {
            let data = props?.data
            renderDataTeamInPembedahan({
                data: data?.operation_team,
                labels: data?.operation_task
            });
        }

        const templateOprasiPembedahanAnesthesiLengkap = (props) => {
            let data = props?.data
            renderDataTeamInPembedahanAnesthesiLengkap({
                data: data?.operation_team,
                labels: data?.operation_task
            });

        } //new 31/07

        const getInstrumen = (props) => {
            if (props.data) {
                dataInstrumen = props?.data;
                renderbodyInstrumenoprs004({
                    items: dataInstrumen
                });
                let tableInstrumen = $("#get-data-instrumen").html("");
                $("#body-instrumen").html("");

                dataInstrumen?.forEach((element, key) => {
                    tableInstrumen.append(
                        `<tr>
                            <td class="text-center">${key + 1}</td>
                            <td class="text-center">
                                ${element?.brand_name === '1' ? "Instrumen" :
                                    element?.brand_name === '2' ? "Kassa" :
                                    element?.brand_name === '3' ? "Jarum" :
                                    element?.brand_name}
                                </td>

                            <td class="text-center">${element?.quantity_before}</td>
                            <td class="text-center">${element?.quantity_intra}</td>
                            <td class="text-center">${element?.quantity_additional}</td>
                            <td class="text-center">${element?.quantity_after}</td>
                        </tr>`
                    );
                    addRowInstrumen(element)
                });
            }
        };


        const addRowInstrumen = (props) => {
            // Create HTML for new row
            var newRow = `
                <tr>
                    <td>
                        <select class="form-select" name="brand_id[]">
                            <option data-nama-instrumen="Instrumen" value="1" ${props?.brand_id == '1' ? 'selected' : '' }>Instrumen</option>
                            <option data-nama-instrumen="Kassa" value="2" ${props?.brand_id == '2' ? 'selected' : '' }>Kassa</option>
                            <option data-nama-instrumen="Jarum" value="3" ${props?.brand_id == '3' ? 'selected' : '' }>Jarum</option>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="body_id_instrument[]" value="${props?.body_id ?? ''}" />
                        <input type="hidden" name="quantity_intra[]" value="${props?.quantity_intra ?? 0}" />
                        <input type="hidden" name="quantity_additional[]" value="${props?.quantity_additional ?? 0}" />
                        <input type="hidden" name="quantity_after[]" value="${props?.quantity_after ?? 0}" />
                        <input type="number" class="form-control" name="quantity_before[]" value="${props?.quantity_before ?? 0}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm delete-row"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            `;

            $('#body-instrumen').append(newRow);
            $('#body-instrumen1').append(newRow);


            $('.delete-row').click(function() {
                $(this).closest('tr').remove();
                updateAddButtonVisibility();
            });

            updateAddButtonVisibility();
        }

        const updateAddButtonVisibility = () => {
            let rowCount = $('#body-instrumen tr').length;
            let rowCount1 = $('#body-instrumen1 tr').length;

            if (rowCount1 >= 3) {
                $('#addInstrumen1').hide();
            } else {
                $('#addInstrumen1').show();
            }


            if (rowCount >= 3) {
                $('#addInstrumen').hide();
            } else {
                $('#addInstrumen').show();
            }
        }
        const getDataDrain = (props) => {
            let data = props?.data
            dataDrain = data || []
            assessment_anesthesia_recovery = props?.assessment_anesthesia_recovery || []
            // assessment_anesthesia_recovery_aldrete = props?.assessment_anesthesia_recovery_aldrete || []
            renderDrains004({
                results: dataDrain,
                valBody_id: globalBodyId,
                assessment_anesthesia_recovery: props?.assessment_anesthesia_recovery,
                // assessment_anesthesia_recovery_aldrete: props?.assessment_anesthesia_recovery_aldrete
            });
        };


        const getAvalueType = (props) => {

            let aParameter = <?= json_encode($aParameter) ?>;

            let filteredData = aParameter?.filter(item => item?.p_type === props?.p_type);

            valueCatatan({
                data: filteredData,
                content_id: props?.content_id,
                get_data: props?.get_data,
                items: props?.items ?? "",
                data_tindakan: props?.data_tindakan //new
            });
        }; // new Update 29/07

        const getDataMental = () => {
            postData({
                    parameter_id: '01'
                }, 'admin/PatientOperationRequest/getPasienOprasiValue',
                (res) => {
                    if (res) {
                        let data = ''
                        res.map(item => {
                            data +=
                                `<option value="${item?.value_id}">${item?.value_desc}</option>`
                        })
                        $("#status_mental-catatan_operasi").html(`<option selected>Pilih</option>` +
                            data)
                    }
                })
        }

        const getDataPenyakit = async (props) => {
            postData({
                    NO_REGISTRATION: props?.no_registration
                }, 'admin/PatientOperationRequest/getPasienOprasiHistory',
                (res) => {
                    if (res) {
                        historyPasien = res;


                    }
                })
        }

        const getDataDropdownAllemployee = (props) => {
            getDataList(
                'admin/PatientOperationRequest/getDropdowntempAll',
                (res) => {
                    if (res.response) {
                        tasksValue = res
                        window.groupedTasks = groupTasks(res.data);
                        getDataList(
                            'admin/PatientOperationRequest/getDropdownAddAll',
                            (res) => {
                                if (res.response) {
                                    employesValue = res
                                    window.employees = res;
                                    postData({
                                        vactination_id: props?.vactination_id
                                    }, 'admin/PatientOperationRequest/getDataTim', (
                                        res) => {
                                        if (res.response) {
                                            createDropdownTables(res.data);
                                            $('#transaksi-permintaan_operasi').val(props
                                                ?.transaksi);
                                            $("#form-action-pelayanan").val(props
                                                ?.terlayani);
                                        }
                                    });
                                }
                            }
                        );
                    } else {
                        console.error('Failed to fetch dropdown data.');
                    }
                }
            );
        };

        const viewModalOperationAction = () => {
            $('.operation_action').off().on('click', function(e) {
                postData({
                    vactination_id: $(this).data('id'),
                    visit_id: $(this).data('visit_id'),
                    no_registration: $(this).data('noregis')
                }, 'admin/PatientOperationRequest/getDetail', (res) => {

                    modalViewOperationAction({
                        data: res
                    });
                });
            })
        }

        const deleteActionRequestOperation = (props) => {
            postData({
                vactination_id: props?.vactination_id,
                visit_id: props?.visit_id,
                no_registration: props?.no_registration,
            }, 'admin/PatientOperationRequest/deleteData', (res) => {
                if (res.respon === true) {
                    successSwal('Data berhasil Dihapus.');
                    let visit_id = '<?php echo $visit['visit_id']; ?>';
                    getDataTabelRequestOperation({
                        no_registration: props?.no_registration,
                        visit_id: props?.visit_id
                    });
                } else {
                    errorSwal("Gagal Di hapus")
                }
            });
        }

        const getEditRequestOperation = () => {
            $('.btn-show-edit-requestOperation').on('click', function(e) {
                postData({
                    vactination_id: $(this).data('id'),
                    visit_id: $(this).data('visit_id'),
                    no_registration: $(this).data('noregis')
                }, 'admin/PatientOperationRequest/getDetail', (res) => {

                    modalViewEditRequestOperation({
                        data: res
                    });
                });
            });
        }

        const getDetailRequestOperation = () => {
            $('.btn-show-detail-requestOperation').on('click', function(e) {
                postData({
                    vactination_id: $(this).data('id'),
                    visit_id: $(this).data('visit_id'),
                    no_registration: $(this).data('noregis')
                }, 'admin/PatientOperationRequest/getDetail', (res) => {

                    modalViewDetailRequestOperation({
                        data: res
                    });
                });
            });
        }

        const getDataTabelRequestOperation = (props) => {
            postData({
                no_registration: props?.no_registration,
                visit_id: props?.visit_id
            }, 'admin/PatientOperationRequest/getOperationData', (res) => {
                if (res.length >= 1) {
                    pasienOperasiValue = res
                    renderDataRequestOperation({
                        data: res
                    });
                } else {
                    $("#bodydataRequestOperation").html(tempTablesNull());
                }
            }, (beforesend) => {
                getLoadingGlobalServices('bodydataRequestOperation');
            });
        }

        const getDataTreatment = (callback) => {
            getDataList(
                'admin/PatientOperationRequest/getTreatment',
                (res) => {
                    treatmentData = res;
                },
                () => {
                    // console.log('Before send callback');
                }
            );
        };

        const getDataVitailSign = (props) => {
            const pasienDiagnosaId = props?.pasien_diagnosa_id;
            const accountIds = props?.account_ids || [];
            const suffixes = props?.suffixes || [];


            postData({
                pasien_diagnosa_id: pasienDiagnosaId,
                account_ids: accountIds
            }, 'admin/PatientOperationRequest/getExaminationData', (res) => {

                if (res?.respon === false || !res?.data?.length) {
                    suffixes.forEach((suffix) => {
                        const newBodyId = get_bodyid();
                        $(`#avtbody_id${suffix}`).val(newBodyId);
                        clearVitalsignFields(suffix);
                    });
                } else {
                    const dataByAccountId = res.data.reduce((acc, item) => {
                        acc[item.account_id] = item;
                        return acc;
                    }, {});

                    suffixes.forEach((suffix, index) => {
                        const accountId = accountIds[index];
                        const data = dataByAccountId[accountId];

                        const elementId = `#avtbody_id${suffix}`;
                        if (data) {
                            const bodyIdFromData = data?.body_id;
                            $(elementId).val(bodyIdFromData);
                            renderDataVitailSign(data, suffix);
                        } else {
                            const newBodyId = get_bodyid();
                            $(elementId).val(newBodyId);
                            clearVitalsignFields(suffix);
                        }
                    });
                }
            });
        }



        //new 02/08//new update  30/07

        const clearVitalsignFields = (suffix) => {
            const baseMappings = {
                examination_date: 'examination_date',
                vs_status_id: 'vs_status_id',
                arm_diameter: 'arm_diameter',
                nadi: 'nadi',
                nafas: 'nafas',
                height: 'height',
                saturasi: 'saturasi',
                temperature: 'temperature',
                tension_below: 'tension_below',
                tension_upper: 'tension_upper',
                pemeriksaan: 'pemeriksaan',
                weight: 'weight',
                oxygen_usage: 'oxygen_usage'
            };

            Object.keys(baseMappings).forEach(key => {
                const baseName = baseMappings[key];
                const selector = `#avt${baseName}${suffix}`;
                $(selector).val('');
            });
        }; // new 30/7

        const getDataDiagnosass = (props) => {
            postData({
                pasien_diagnosa_id: props?.pasien_diagnosa_id
            }, 'admin/PatientOperationRequest/getDiagnosassDockterData', (res) => {
                if (res.respon && Array.isArray(res.data)) {
                    const tbodyId = `bodyDiagLaporanAnesthesi-${props?.vactination_id}`;
                    const tbody = $(`#${tbodyId}`);
                    tbody.empty();

                    res.data.forEach((diagnosis) => {
                        addRowDiagDokter('bodyDiagLaporanAnesthesi-', props?.vactination_id,
                            diagnosis?.diagnosa_id, diagnosis?.diagnosa_name, diagnosis
                            ?.diag_cat,
                            diagnosis?.suffer_type);
                    });
                }
            });
        };



        const getDataDiagnosassPerawat = (props) => {
            postData({
                document_id: props?.document_id,
                visit_id: props?.visit_id,
            }, 'admin/PatientOperationRequest/getDiagnosassPerawatData', (res) => {
                if (res.respon && Array.isArray(res.data)) {
                    const tbodyId = `bodyDiagKepCatatan-${props?.vactination_id}`;
                    const tbody = $(`#${tbodyId}`);
                    tbody.empty();
                    res?.data[0]?.diagnosa.forEach((diagnosis) => {
                        addRowDiagPerawat('bodyDiagKepCatatan-', props?.vactination_id,
                            diagnosis?.diagnosan_id, diagnosis?.diag_notes);
                    });
                }
            });
        }; // new update 30/07


        function addRowDiagDokter(container, bodyId, diag_id = null, diag_name = null, diag_cat = null,
            diag_suffer =
            0) {

            let tbody = document.getElementById(container + bodyId);
            let diagIndex = tbody.getElementsByTagName("tr").length;

            if (diag_cat == null) {
                diag_cat = 1
            }
            if (diag_cat == null && diagIndex > 1) {
                diag_cat = 2
            }
            diagIndex = bodyId + diagIndex + container;

            let $row = $('<tr id="adiagdiag' + diagIndex + '">')
                .append($('<td>')
                    .append('<select id="adiagdiag_id' + diagIndex +
                        '" class="form-control enablekan" name="diag_id[]" style="width: 100%"></select>')
                    .append('<input id="adiagdiag_name' + diagIndex +
                        '" name="diag_name[]" placeholder="" type="text" class="form-control block enablekan" value="" style="display: none" />'
                    )
                    .append('<input id="adiagsscondition_id' + diagIndex +
                        '" name="sscondition_id[]" placeholder="" type="text" class="form-control block enablekan" value="" style="display: none" />'
                    )
                )
                .append($('<td>')
                    .append($("<select class=\"form-select enablekan\">")
                        .attr('name', 'suffer_type[]').attr('id', 'adiagsuffer_type' +
                            diagIndex) <?php foreach ($suffer as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $suffer[$key]['suffer_type']; ?>').html(
                                    '<?= $suffer[$key]['suffer']; ?>')) <?php } ?>
                        .val(diag_suffer)
                    )
                )
                .append($('<td>')
                    .append($("<select class=\"form-select enablekan\">")
                        .attr('name', 'diag_cat[]')
                        .attr('id', 'adiagdiag_cat' +
                            diagIndex
                        ) <?php foreach ($diagCat as $key => $value) { ?> <?php if (in_array($diagCat[$key]['diag_cat'], [1, 13, 14, 15])) { ?>
                                .append($("<option>")
                                    .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>')
                                    .html('<?= $diagCat[$key]['diagnosa_category']; ?>')) <?php } ?> <?php } ?>
                        .val(diag_cat)
                    )
                )
                .append("<td><div onclick='$(\"#adiagdiag" + diagIndex +
                    "\").remove()' class='btn closebtn btn-xs pull-right enablekan pointer' data-toggle='modal' title=''><i class='fa fa-trash'></i></div></td>"
                );

            $("#" + container + bodyId).append($row);

            // Attach event handlers
            $("#adiagdiag_id" + diagIndex).on('focus', function() {
                removetextdiag(diagIndex);
            }).on('change', function() {
                selectedDiagnosa(diagIndex);
            });

            initializeDiagSelect2("adiagdiag_id" + diagIndex, diag_id, diag_name);
            $("#adiagsuffer_type" + diagIndex).val(diag_suffer);
            $("#adiagdiag_cat" + diagIndex).val(diag_cat);
        }


        function selectedDiagnosa(index) {
            let diagname = $("#adiagdiag_id" + index + " option:selected").text();
            if (typeof diagname !== 'undefined') {
                $("#adiagdiag_name" + index).val(diagname);
            }
        }

        function addRowDiagPerawat(container, bodyId, diag_id = null, diag_notes = null) {
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
                );

            $("#" + container + bodyId).append($row);


            initializeDiagPerawatSelect2("adiagpdiagnosan_id" + diagIndex, diag_id, diag_notes);


            $("#adiagpdiagnosan_id" + diagIndex).on('focus', function() {
                removetextdiag(diagIndex);
            }).on('change', function() {
                selectedDiagNursePerawat(diagIndex);
            });
        } // new update 30/07


        const getDataColumnName = (props) => {
            postData({
                    table_name: props?.table_name,
                    column_name: props?.column_name,
                    column_id: props?.column_id,
                    id: props?.id,
                }, 'admin/PatientOperationRequest/getDataColumnName',
                (res) => {
                    if (res && Array.isArray(res) && res.length > 0) {
                        $('#' + props?.element_id).val(res[0][props?.column_name]);
                    }
                })
        }

        const renderDataTreatmentObat = (props) => {
            let data = props?.data
            let obatInhalasi = "";
            let obatInjeksi = "";
            let blood = '';
            let obatCairan = ''
            let medication = ''
            data?.treatment?.filter(item => parseInt(item.isalkes) === 2).map((item, index) => {
                obatInhalasi += `<tr>
                <td>${moment(item?.treat_date).format("DD/MM/YYYY HH:mm")}</td>
                <td>${item?.name ?? "-"}</td>
                <td>${item?.quantity ?? "0"}</td>
            </tr>`;
            });

            data?.treatment?.filter(item => parseInt(item.isalkes) === 20).map((item, index) => {
                obatInjeksi += `<tr>
                <td>${moment(item?.treat_date).format("DD/MM/YYYY HH:mm")}</td>
                <td>${item?.name ?? "-"}</td>
                <td>${item?.quantity ?? "0"}</td>
            </tr>`;
            });

            data?.treatment?.filter(item => parseInt(item.isalkes) === 19).map((item, index) => {
                obatCairan += `<tr>
                <td>${moment(item?.treat_date).format("DD/MM/YYYY HH:mm")}</td>
                 <td></td>
                <td>${item?.name ?? "-"}</td>
                <td>${item?.quantity ?? "0"}</td>
            </tr>`;
            });


            // data?.treatment?.map((item, index) => {
            //     obatCairan += `<tr>
            //                 <td>${moment(item?.treat_date).format("DD/MM/YYYY HH:mm")}</td>
            //                 <td></td>
            //                 <td>${item?.name  ?? "-"}</td>
            //                 <td>${item?.quantity ?? "0"}</td>
            //             </tr>`;
            // });
            data?.blood_request?.map((item, index) => {
                blood += `<tr>
                        <td>${moment(item?.request_date).format("DD/MM/YYYY HH:mm")}</td>
                        <td></td>
                        <td>${item?.usagetype  ?? "-"}</td>
                        <td>${item?.blood_quantity ?? "0"}</td>
                    </tr>`;
            });

            const isalkesArray = [2, 19, 20];

            data?.treatment?.filter(item => isalkesArray.includes(parseInt(item.isalkes))).map((item, index) => {
                medication += `<tr>
                    <td>${item?.name ?? "-"}</td>
                    <td>${item?.quantity ?? "0"}</td>
                  </tr>`;
            });

            $("#bodyDataObatInhalasi").html(obatInhalasi);
            $("#bodyDataObatInjeksi").html(obatInjeksi)
            $("#bodyDatacairanMasuk").html(obatCairan + blood)
            $("#bodyDataMedication").html(medication)


        } // new  31/07

        const getRequestVtRangeAnesthesia = (props) => {
            let {
                vactination_id,
                filters,
                body_requestCharts,
                body_requestTables
            } = props;

            filters.forEach((filter, index) => {
                postData({
                    document_id: vactination_id ?? "",
                    filter: filter ?? ""
                }, 'admin/PatientOperationRequest/getDataVitailSignRangeAnesthesia', (res) => {
                    if (res.respon && res.data.examination_info.length > 0) {
                        ChartMonitoringDurante({
                            data: res.data.examination_info,
                            body_requestChart: body_requestCharts[index],
                            body_requestTabels: body_requestTables[index]
                        });
                    } else {
                        $(`#${body_requestCharts[index]}`).closest('.box.box-info').hide();
                        $(`#${body_requestTables[index]}`).closest('.box.box-info').hide();
                    }
                });
            });
        };
        // new 1/8
        const getDataDiagnosasss = (props) => {
            postData({
                pasien_diagnosa_id: props?.pasien_diagnosa_id
            }, 'admin/PatientOperationRequest/getDiagnosassDockterData', (res) => {
                if (res.respon && Array.isArray(res.data)) {
                    const tbodyId = `bodyDiagLaporanAnesthesiLengkap-${props?.vactination_id}`;
                    const tbody = $(`#${tbodyId}`);
                    tbody.empty();
                    res.data.forEach((diagnosis) => {
                        addRowDiagDokter('bodyDiagLaporanAnesthesiLengkap-', props?.vactination_id,
                            diagnosis.diagnosa_id, diagnosis.diagnosa_name, diagnosis.diag_cat,
                            diagnosis.suffer_type);
                    });
                }
            });
        }; //new 01/08

        const convertDate = (dateString) => {
            const formats = ["YYYY-MM-DD", "DD/MM/YYYY", "YYYY-MM-DD HH:mm", "DD/MM/YYYY HH:mm", "YYYY-MM-DDTHH:mm"];
            const parsedDate = moment(dateString, formats, true);
            if (parsedDate.isValid()) {
                return parsedDate.format("YYYY-MM-DD HH:mm");
            } else {
                return null;
            }
        };

    })()

    function selectedDiagNursePerawat(index) {
        var diagname = $("#adiagpdiagnosan_id" + index).text();
        if (typeof diagname !== "undefined") {
            $("#adiagpdiag_notes" + index).val(diagname);
        }
    }
</script>
<script>

</script>
<?php
echo view('admin/patient/profilemodul/operasi/js/praoperasi_js', [
    'visit' => $visit,
    'aParent' => $aParent,
    'aType' => $aType,
    'aParameter' => $aParameter,
    'aValue' => $aValue,
]);
