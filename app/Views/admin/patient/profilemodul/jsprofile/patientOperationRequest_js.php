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
    let tarif_id_oprs = []
    let historyPasien = [];
    let pasienOperasiValue = [];
    let pasienOperasiSelected = [];
    let genBodyID = ''; //new
    let checkKeselamatanBodyID = ''; //new
    let checkAnestesiBodyID = ''; //new
    let informasiPostOperasiBodyID = ''; //new
    let anestesiValID = ''; //new
    let kopTemplateOprs = [];
    (function() {
        $(document).ready(function() {


            getDataTableOperation(visit);


            $('#container-tab').attr('hidden', true) //update

        });
        let quillInstances = {}
        let quillInstancesModal = {}
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
            $('.select2-oprs').each(function() {
                const dropdownParent = $(this).closest('.modal').length > 0 ?
                    $(this).closest('.modal') :
                    $(this).parent();

                $(this).select2({
                    // placeholder: "Select an option",
                    dropdownParent: dropdownParent,
                    width: '100%',
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

        const renderDropdownTreatment = () => {
            let data = treatmentData;

            let result = "";
            data.forEach((item) => {
                result +=
                    `<option value="${item.tarif_id}" data-operation-type="${item.operation_type}">${item.tarif_name} (${item?.name_of_class} - ${formatToIDRResult(item?.amount_paid ?? 0)})</option>`;
            });

            $("#bill_id-permintaan_operasi").html(
                `<option selected  value="">Pilih Tindakan</option>` +
                result);
        };

        // ACTIONS & BTN
        const actionDropdownSpesialisas = () => {
            $("#bill_id-permintaan_operasi").off().on("change", function(e) {
                let selectedOption = $(this).find('option:selected');
                let operationType = selectedOption.data('operation-type');
                $("#operation_type-permintaan_operasi").val(operationType);
                const foundData = treatmentData.find(item => item.operation_type ===
                    `${operationType}`);
                $("#operation_type_name-permintaan_operasi").val(foundData?.treatment);
            });
        }


        const getDataTableOperation = (props) => {

            $("#patientOperationRequestTab").off().on("click", function(e) {

                if (!(visit?.locked === '0' || visit?.locked === null)) {
                    $(".spppoli-to-hide").remove();
                }

                // getDataTreatment()
                getLoadingscreen("contentToHide-requestOperation", "load-content-requestOperation")
                e.preventDefault();
                getDataList(
                    'admin/PatientOperationRequest/getTreatment',
                    (res) => {

                        treatmentData = res?.bill_id;
                        tarif_id_oprs = res?.tarif_id
                        kopTemplateOprs = res?.kop
                        dr_oprtOprs = res?.dr_oprt

                        $('.kop-name-oprs').text(res?.kop?.name_of_org_unit || '');
                        $('.kop-address-oprs').html(res?.kop?.contact_address + ',' + res?.kop?.phone +
                            ', Fax:' +
                            res?.kop?.fax + ',' + res?.kop?.kota +
                            '<br>' + res?.kop?.sk
                        );
                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id,
                            trans_id: props?.trans_id
                        })
                        $("#container-tab").slideUp();
                        actionButtonAddOperation(props);
                    },
                    () => {
                        // console.log('Before send callback');
                    }
                );



            })
        };


        const initializeFlatpickrOperasi = () => {
            $(".datetimeflatpickr-oprs").each(function() {
                const inputVal = $(this).val();

                let initialDate = '';

                if (inputVal) {
                    if (moment(inputVal, moment.ISO_8601, true).isValid()) {
                        initialDate = moment(inputVal).format("DD/MM/YYYY HH:mm");
                    } else if (moment(inputVal, "DD/MM/YYYY HH:mm", true).isValid()) {
                        initialDate = moment(inputVal, "DD/MM/YYYY HH:mm").format("DD/MM/YYYY HH:mm");
                    } else if (moment(inputVal, "DD-MM-YYYY HH:mm", true).isValid()) {
                        initialDate = moment(inputVal, "DD-MM-YYYY HH:mm").format("DD/MM/YYYY HH:mm");
                    } else {
                        initialDate = moment().format(
                            "DD/MM/YYYY HH:mm");
                    }
                } else {
                    initialDate = moment().format("DD/MM/YYYY HH:mm");

                }

                flatpickr(this, {
                    enableTime: true,
                    dateFormat: "d/m/Y H:i",
                    time_24hr: true,
                    defaultDate: initialDate,
                    allowInput: true
                });
            });

            $(".datetimeflatpickr-oprs").prop("readonly", false);

            $(".datetimeflatpickr-oprs").on("change", function() {
                let theid = $(this).attr("id");
                if (String(theid)?.includes("flat")) {
                    theid = theid.replace("flat", "");
                }
                let thevalue = $(this).val();

                if (moment(thevalue, "DD/MM/YYYY HH:mm", true).isValid()) {
                    let formattedDate = moment(thevalue, "DD/MM/YYYY HH:mm").format("YYYY-MM-DD HH:mm");
                    $("#" + theid).val(formattedDate);
                } else if (moment(thevalue, "YYYY-MM-DD HH:mm", true).isValid()) {
                    let formattedDate = moment(thevalue, "YYYY-MM-DD HH:mm").format("YYYY-MM-DD HH:mm");
                    $("#" + theid).val(formattedDate);
                } else {
                    console.warn("Invalid date entered:", thevalue);
                }
            });

            $(".datetimeflatpickr-oprs").trigger("change");


            flatpickr(".datetimeflatpickr-oprs-anes", {
                enableTime: true,
                dateFormat: "d/m/Y H:i",
                time_24hr: true,
                onChange: function(selectedDates, dateStr, instance) {}
            });

            $(".datetimeflatpickr-oprs-anes").prop("readonly", false)

        };




        const btnSaveActionRequestOperation = (props) => {
            $("#btn-save-permintaan-operasi-modal").off().on("click", function(e) {
                e.preventDefault();

                // if ($('#bill_id-permintaan_operasi').val() === '' || $('#bill_id-permintaan_operasi')
                //     .val() ===
                //     null) {
                //     $('#bill_id-permintaan_operasi').select2('open');
                //     return;
                // }

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

                let isChecked = parseInt($('input[name="patient_category_id_oprs"]:checked').val(), 10)
                let isCheckedKode = parseInt($('input[name="kode_operasi_oprs"]:checked').val(), 10)


                jsonObj['patient_category_id'] = isChecked;
                jsonObj['kode_operasi'] = isCheckedKode;
                jsonObj['terlayani'] = "0";
                let operationType = $("#operation_type-permintaan_operasi").val();
                jsonObj['operation_type'] = operationType;

                postData(jsonObj, 'admin/PatientOperationRequest/insertData', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil disimpan.');

                        $("#create-modal-permintaan-operasi").modal("hide");
                        $('#formDokumentPermintaanOperasi')[0].reset();

                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id,
                            trans_id: props?.trans_id
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

                let isChecked = $('input[name="patient_category_id_oprs"]:checked').length ? parseInt($(
                    'input[name="patient_category_id_oprs"]:checked').val(), 10) : null;

                let isCheckedKode = $('input[name="kode_operasi_oprs"]:checked').length ? parseInt($(
                    'input[name="kode_operasi_oprs"]:checked').val(), 10) : null;

                jsonObj['patient_category_id'] = isChecked;
                jsonObj['kode_operasi'] = isCheckedKode;

                let operationType = $("#operation_type-permintaan_operasi").val();
                jsonObj['operation_type'] = operationType;

                postData(jsonObj, 'admin/PatientOperationRequest/updateData', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');

                        $("#create-modal-permintaan-operasi").modal("hide");
                        $('#formDokumentPermintaanOperasi')[0].reset();

                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id,
                            trans_id: props?.trans_id
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
                            no_registration: $(this).data('noregis'),
                            trans_id: $(this).data('trans_id')
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
                let arrInstrument = ['Instrumen', 'Kassa', 'Jarum', 'TAMPON KASSA THT',
                    'TAMPON KASSA BIASA', 'TAMPON KASSA ROLL OBSGYN'
                ];
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
                let diag_cats = dataSend.getAll('diag_cat[]');

                for (let i = 0; i < diag_ids.length; i++) {
                    let entry = {
                        diagnosa_id: diag_ids[i],
                        diag_notes: diag_notes[i],
                        diag_cat: diag_cats[i]
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
                        let valueDesc = selectElement.find('option:selected').text()
                            .trim();
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
                                modified_date: moment().format(
                                    'YYYY-MM-DD HH:mm:ss'),
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
                        let valueDesc = selectElement.find('option:selected').text()
                            .trim();
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
                                modified_date: moment().format(
                                    'YYYY-MM-DD HH:mm:ss'),
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
                if ($('#vitalSignKeperawatan').is(':visible')) {
                    const vitailSignKeys = ['vs_status_id', 'arm_diameter', 'nadi', 'nafas', 'height',
                        'saturasi', 'temperature',
                        'tension_below', 'tension_upper', 'examination_date', 'pemeriksaan',
                        'weight',
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
                        jsonObj.vitailsign['pasien_diagnosa_id'] = jsonObj['body_id'] ?? props
                            ?.vactination_id;
                    }
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
                            visit_id: props?.visit_id,
                            trans_id: props?.trans_id
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


            $("#btn-save-vitalSignAcKeperawatan").off().on("click", function(e) {
                e.preventDefault();
                let jsonObj = {
                    vitailsign: {}
                };

                let formElement = document.getElementById('form-catatan-keperawatan');
                let dataSend = new FormData(formElement);


                dataSend.forEach((value, key) => {
                    if (value) {
                        if (!jsonObj[key]) {
                            jsonObj[key] = value;
                        }
                    }
                });

                jsonObj['pasien_diagnosa_id'] = props?.vactination_id;

                if ($('#vitalSignKeperawatan').is(':visible')) {
                    const vitailSignKeys = ['vs_status_id', 'arm_diameter', 'nadi', 'nafas', 'height',
                        'saturasi', 'temperature',
                        'tension_below', 'tension_upper', 'examination_date', 'pemeriksaan',
                        'weight',
                        'oxygen_usage'
                    ];

                    jsonObj.vitailsign = jsonObj.vitailsign || {};
                    vitailSignKeys.forEach(key => {
                        jsonObj.vitailsign[key] = jsonObj[key];
                        delete jsonObj[key];
                    })

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
                    jsonObj.vitailsign['account_id'] = '10'

                    if (jsonObj['body_id'] !== "undefined" || props?.vactination_id !== undefined) {
                        jsonObj.vitailsign['pasien_diagnosa_id'] = jsonObj['body_id'] ?? props
                            ?.vactination_id;
                    }
                }


                postData(jsonObj, 'admin/PatientOperationRequest/insertVt', (res) => {

                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');
                        getVitalSignLaporanAnesthesiLengkap(
                            'vitalSignBodyLaporanAnesthesiLengkap',
                            '11');
                        getVitalSignLaporanAnesthesiLengkap(
                            'vitalSignBodyLaporanAnesthesiLengkap2',
                            '12');
                        getVitalSignLaporanAnesthesiLengkap2(
                            'vitalSignBodyLaporanAnesthesiLengkap3', '13');
                        getVitalSignKeperawatan()

                    } else {
                        errorSwal('Data gagal diperbarui. Silakan coba lagi.');
                        //     $("#loading-indicator").hide();
                    }
                }, (beforesend) => {
                    console.log("Request is being sent...");
                }, (error) => {
                    console.error("Error occurred:", error);
                    errorSwal('Terjadi kesalahan. Silakan coba lagi.');
                    // $("#loading-indicator").hide();
                });



            })
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

                console.log(jsonObj);

                jsonObj.operation_desc = jsonObj.operation_desc_oprs008;
                delete jsonObj.operation_desc_oprs008;

                let diag_cats = dataSend.getAll('diag_cat[]');
                let diag_id = dataSend.getAll('diag_id[]');

                let diag_descs = dataSend.getAll('diag_desc[]');
                let diag_names = dataSend.getAll('diag_name[]');
                let suffer_type = dataSend.getAll('suffer_type[]');

                for (let i = 0; i < diag_cats.length; i++) {
                    let entry = {
                        diagnosa_cat: diag_cats[i],
                        diagnosa_id: diag_id[i],
                        diagnosa_desc: diag_descs[i],
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
                            visit_id: props?.visit_id,
                            trans_id: props?.trans_id
                        });
                    } else {
                        errorSwal(res?.error ?? "Data Tidak berhasil Tersimpanx")
                    }
                }, (beforesend) => {
                    console.log("Request is being sent...");
                });
            })
        }

        const groupingGetAllArcodions = (data) => {
            $('.btn-show-assesment-requestOperation').on('click', function(e) {

                if (e.event !== "trigger") {
                    getLoadingscreen("contentToHide-requestOperation-tab",
                        "load-content-requestOperation-tab")
                }

                $("#vitalSignKeperawatan").hide()
                $("#vitalSignLaporanAnesthesi").hide()
                $("#vitalSignLaporanAnesthesiLengkap2").hide()
                $("#vitalSignLaporanAnesthesiLengkap3").hide()
                // ====== Btn hide====
                $("#sembunyikanVtKeperawatanShow").hide()
                $("#sembunyikanVtLaporanAnesthesiShow").hide()
                $("#sembunyikanVtLaporanAnesthesiLengkap2Show").hide()
                $("#sembunyikanVtLaporanAnesthesiLengkap3Show").hide()
                // ====== Btn Show====
                $("#tambahVtKeperawatanShow").show()
                $("#tambahVtLaporanAnesthesiShow").show()
                $("#tambahVtLaporanAnesthesiLengkap2Show").show()
                $("#tambahVtLaporanAnesthesiLengkap3Show").show()


                quillInstances = {};
                dataDrain = [];
                globalBodyId = '';
                let index = $(this).data('index');
                let item = pasienOperasiValue[index];
                pasienOperasiSelected = item;


                $('#bodydataRequestOperation > tr').removeClass('table-primary');
                $(this).closest('tr').addClass('table-primary')

                // console.log(data);


                // $(".nav-link-oprs").on('click', e => {

                //     $(`#btn-show-assesment-requestOperation${item?.vactination_id}`).trigger(
                //         "click")
                // })

                cetakOperasi({
                    vactination_id: item?.vactination_id,
                    element_id: '#btn-print-praoperasi2',
                    method: 'cetak_pra_operasi'
                })
                cetakOperasi({
                    vactination_id: item?.vactination_id,
                    element_id: '#btn-print-laporan-anesthesi',
                    method: 'cetak_laporan_anesthesi'
                })
                cetakOperasi({
                    vactination_id: item?.vactination_id,
                    element_id: '#btn-print-anestesi-lengkap',
                    method: 'cetak_anesthesi_lengkap'
                })
                cetakOperasi({
                    vactination_id: item?.vactination_id,
                    element_id: '#btn-print-checklist-anestesi',
                    method: 'cetak_checklist_anestesi'
                })
                cetakOperasi({
                    vactination_id: item?.vactination_id,
                    element_id: '#btn-print-catatan-keperawatan',
                    method: 'cetak_catatan_keperawatan'
                })
                cetakOperasi({
                    vactination_id: item?.vactination_id,
                    element_id: '#btn-print-checklist-keselamatan',
                    method: 'cetak_checklist_keselamatan'
                })
                cetakOperasi({
                    vactination_id: item?.vactination_id,
                    element_id: '#btn-print-post-operasi',
                    method: 'cetak_post_operasi'
                })
                cetakOperasi({
                    vactination_id: item?.vactination_id,
                    element_id: '#btn-print-laporan-pembedahan',
                    method: 'cetak_laporan_pembedahan',
                })

                postData({
                    id: `${item?.vactination_id}`,
                    visit_id: `${item?.visit_id}`
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
                            diagnosas: result?.diagnosas,
                            blood_request_history: result?.blood_history,

                        })

                        pembedahan({
                            data: item,
                            diagnosas: result?.diagnosas,
                            ori: item
                        });

                        LaporanAnesthesi({
                            data: result?.assessment_anesthesia,
                            exam_info: result?.exam_info,
                            diagnosas: result?.diagnosas,
                            ori: item,
                            assessment_anesthesia_recovery: result
                                ?.assessment_anesthesia_recovery,
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

                        postOperasi({
                            data: item,
                            obat: result?.treatmentobat

                        });
                    }
                })


                $(".nav-link-oprs").off().on("click", function(e) {

                    e.preventDefault();
                    const $this = $(this);

                    if ($this.hasClass("clicked"))

                        $this.addClass("clicked");
                    $this.addClass("disabled");
                    const href = $(this).attr("href");
                    let item = pasienOperasiValue[index];
                    pasienOperasiSelected = item;
                    quillInstances = {};
                    dataDrain = [];

                    postData({
                        diag_id: `${item?.vactination_id}`
                    }, 'admin/PatientOperationRequest/getDiag', (res) => {
                        if (res?.success === true) {
                            res?.data?.forEach((item, index) => {

                                addRowDiagDokterOprs('bodyDiagPraOperation2-',
                                    pasienOperasiSelected
                                    ?.vactination_id,
                                    item?.diagnosa_id, item
                                    ?.diagnosa_name ??
                                    item?.diagnosa_desc, item
                                    ?.diag_cat);

                                if (item.diag_cat == 13) {
                                    addRowDiagDokterOprs(
                                        'bodyDiagPraOperation-',
                                        pasienOperasiSelected
                                        ?.vactination_id,
                                        item?.diagnosa_id, item
                                        ?.diagnosa_name ?? item
                                        ?.diagnosa_desc,
                                        item
                                        ?.diag_cat, item?.diag_suffer);
                                } else {
                                    addRowDiagDokterOprs(
                                        'bodyDiagPascaOperation-',
                                        pasienOperasiSelected
                                        ?.vactination_id,
                                        item?.diagnosa_id, item
                                        ?.diagnosa_name ?? item
                                        ?.diagnosa_desc,
                                        item
                                        ?.diag_cat, item?.diag_suffer);
                                }


                                addRowDiagDokterOprs(
                                    'bodyDiagLaporanAnesthesi-',
                                    pasienOperasiSelected
                                    ?.vactination_id,
                                    item?.diagnosa_id, item
                                    ?.diagnosa_name ??
                                    item?.diagnosa_desc, item
                                    ?.diag_cat, item?.suffer_type);


                                addRowDiagDokterOprs(
                                    'bodyDiagLaporanAnesthesiLengkap-',
                                    pasienOperasiSelected
                                    ?.vactination_id,
                                    item?.diagnosa_id, item
                                    ?.diagnosa_name ??
                                    item?.diagnosa_desc, item
                                    ?.diag_cat, item?.suffer_type);

                            });
                        }



                    });

                    postData({
                        id: `${item?.vactination_id}`,
                        visit_id: `${item?.visit_id}`
                    }, 'admin/PatientOperationRequest/getAllArcodions', (res) => {

                        if (res.respon) {
                            let result = res?.data

                            $("#pasien_diagnosa_id-laporanAnesthesi-lengkap").val(result
                                ?.assessment_anesthesia?.body_id); //new
                            if (href === '#checklist-keselamatan') {
                                checklistKeselamatan({
                                    data: result?.assessment_operation_check,
                                });
                                getInstrumen({
                                    data: result?.assessment_instrument
                                });
                            }
                            if (href === '#checklist-anestesi') {
                                anestesi({
                                    data: {
                                        assessment_operation: result
                                            ?.assessment_operation,
                                        assessment_anesthesia_checklist: result
                                            ?.assessment_anesthesia_checklist,
                                        ori: item
                                    }
                                });

                            }

                            if (href === '#catatan-keperawatan') {
                                catatanKeperawatanPraOperasi({
                                    data: result?.assessment_operation,
                                    assessment_anesthesia_recovery: result
                                        ?.assessment_anesthesia_recovery,
                                    exam_info: result?.exam_info

                                })
                                getDataKeperawatanOPRS001({
                                    data: result?.assessment_operation_pra,
                                    blood_request: result?.treatmentobat
                                        .blood_request,
                                    diagnosas: result?.diagnosas,
                                    blood_request_history: result?.blood_history,

                                })
                                getInstrumen({
                                    data: result?.assessment_instrument
                                });
                                getDataDrain({
                                    data: result?.assessment_operation_drain,
                                    assessment_anesthesia_recovery: result
                                        ?.assessment_anesthesia_recovery,

                                });
                            }


                            if (href === '#laporan-pembedahan') {
                                pembedahan({
                                    data: item,
                                    diagnosas: result?.diagnosas,
                                    ori: item
                                });
                                templateOprasiPembedahan({
                                    data: {
                                        operation_team: result?.operation_team,
                                        operation_task: result?.operation_task

                                    }
                                })
                            }
                            if (href === '#laporan-anesthesi') {
                                LaporanAnesthesi({
                                    data: result?.assessment_anesthesia,
                                    exam_info: result?.exam_info,
                                    diagnosas: result?.diagnosas,
                                    ori: item,
                                    assessment_anesthesia_recovery: result
                                        ?.assessment_anesthesia_recovery,
                                })
                            }
                            if (href === '#anesthesi-lengkap') {
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
                            }


                            if (href === "#informasi-post-operasi") {
                                postOperasi({
                                    data: item,
                                    obat: result?.treatmentobat

                                });
                            }
                        }
                        $this.removeClass("clicked disabled");

                    })
                })

                // appendLokalisOperation("accordionPraOperasiSurgeryBody")
                $("#container-tab").attr("hidden", false);
                $("#nama-tindakan-operasi").text($(this).data('treatname') + ' (' + $(this).data(
                        'date') +
                    ')');
                $('#operation_planning').html(item?.tarif_id);
                $("#document_id_checklist_keselamatan").val($(this).data('id')); //new
                $("#document_id_checklist_anestesi").val($(this).data('id')); //new
                $("#document_id_informasi-post-operasi").val($(this).data('id')); //new
                $("#apobody_id").val($(this).data('id')); //new

                // $("#apostart_operation").val(moment(item?.start_operation).format("DD/MM/YYYY HH:mm"))

                assessmentPraOperasi({
                    vactination_id: $(this).data('id')
                })


                $("#container-tab").slideUp();
                $("#container-tab").slideDown();
                initializeFlatpickrOperasi()
            });
        };


        const cetakOperasi = (props) => {
            $(props.element_id).off().on('click', function() {
                var visitEncoded = '<?= base64_encode(json_encode($visit)); ?>'
                var idEncoded = props.vactination_id;
                var url = '<?= base_url() . '/admin/cetak/'; ?>' + props.method + '/' + visitEncoded +
                    '/' +
                    idEncoded;

                window.open(url, '_blank');
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


                let isChecked = $('input[name="patient_category_id_oprs"]:checked').length ? parseInt($(
                    'input[name="patient_category_id_oprs"]:checked').val(), 10) : null;
                let isCheckedKode = $('input[name="kode_operasi_oprs"]:checked').length ? parseInt($(
                    'input[name="kode_operasi_oprs"]:checked').val(), 10) : null;
                jsonObj['patient_category_id'] = isChecked;
                jsonObj['kode_operasi'] = isCheckedKode;

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
                            visit_id: props?.visit_id,
                            trans_id: props?.trans_id
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
                            <select class="form-control select2-oprs groupedTasks-dropdown" name="groupedTasks_option_${dropdownType}[]">
                                ${options}
                            </select>
                        </td>
                        <td rowspan="2" class="align-middle">
                            <button class="btn btn-danger delete-dropdown"><i class="fas fa-minus-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control select2-oprs employee-dropdown" name="employee_option_${dropdownType}[]">
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

                jsonObj.diagnosas = [];
                let diag_cats = dataSend.getAll('diag_cat[]');
                let diag_id = dataSend.getAll('diag_id[]');

                let diag_descs = dataSend.getAll('diag_desc[]');
                let diag_names = dataSend.getAll('diag_name[]');
                let suffer_type = dataSend.getAll('suffer_type[]');

                for (let i = 0; i < diag_cats.length; i++) {
                    let entry = {
                        diagnosa_cat: diag_cats[i],
                        diagnosa_id: diag_id[i],
                        diagnosa_desc: diag_descs[i],
                        diagnosa_name: diag_names[i],
                        suffer_type: suffer_type[i],
                    };
                    jsonObj.diagnosas.push(entry);
                }


                ['diag_cat[]', 'diag_desc[]', 'suffer_type[]'].forEach(key => {
                    dataSend.getAll(key).forEach((_, i) => {
                        jsonObj[key.replace('[]', `[${i}]`)] =
                            undefined;
                    });
                });


                if ($('#vitalSignLaporanAnesthesi').is(':visible')) {
                    const vitailSignKeys = ['vs_status_id', 'arm_diameter', 'nadi', 'nafas', 'height',
                        'saturasi', 'temperature', 'tension_below', 'tension_upper',
                        'examination_date',
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
                }


                let organBodyId = get_bodyid();
                jsonObj.organ = [];

                $('#informasiMedis-laporan-2').find('[name^="oprs034"]').each(function() {
                    let $el = $(this);
                    let paramId = $el.attr('name').split('_')[1] || '';
                    let valueId = $el.val()?.trim() ?? "-";
                    let valueDesc = $el.find('option:selected').text() ?? valueId;
                    let valueScore = $el.find('option:selected').data('score') ?? "";

                    if ($el.is(':checkbox:checked') || $el.is(':radio:checked')) {
                        jsonObj.organ.push(createEntry(paramId, valueId, valueDesc,
                            valueScore));
                    } else if ($el.is('select')) {
                        if (valueId !== "") {
                            jsonObj.organ.push(createEntry(paramId, valueId, valueDesc,
                                valueScore));
                        }
                    } else if ($el.is(':input[type="text"], :input[type="hidden"]') &&
                        valueId) {
                        jsonObj.organ.push(createEntry(paramId, valueId, valueDesc, ""));
                    }
                });

                function createEntry(paramId, valueId, valueDesc, valueScore) {
                    return {
                        org_unit_code: dataSend.get('org_unit_code'),
                        visit_id: dataSend.get('visit_id'),
                        trans_id: dataSend.get('trans_id'),
                        body_id: organBodyId,
                        document_id: props?.vactination_id,
                        p_type: 'OPRS034',
                        parameter_id: paramId,
                        value_score: valueScore,
                        value_desc: valueDesc,
                        observation_date: '',
                        modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                        modified_by: dataSend.get('modified_by'),
                        value_id: valueId
                    };
                }

                $("#loading-indicator").show();


                postData(jsonObj, 'admin/PatientOperationRequest/insertLaporanAnestesia', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');
                        $("#create-modal-permintaan-operasi").modal("hide");

                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id,
                            trans_id: props?.trans_id
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



            $("#btn-save-vt-laporan-anesthesi").off().on("click", function(e) {
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
                jsonObj['pasien_diagnosa_id'] = jsonObj['body_id'];


                if ($('#vitalSignLaporanAnesthesi').is(':visible')) {
                    const vitailSignKeys = ['vs_status_id', 'arm_diameter', 'nadi', 'nafas', 'height',
                        'saturasi', 'temperature', 'tension_below', 'tension_upper',
                        'examination_date',
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
                    jsonObj.vitailsign['account_id'] = '11'

                }

                postData(jsonObj, 'admin/PatientOperationRequest/insertVt', (res) => {

                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');

                        getVitalSignLaporanAnesthesiLengkap('vitalSignBodyLaporanAnesthesi',
                            '11');
                        getVitalSignLaporanAnesthesiLengkap(
                            'vitalSignBodyLaporanAnesthesiLengkap',
                            '11');
                        getVitalSignLaporanAnesthesiLengkap(
                            'vitalSignBodyLaporanAnesthesiLengkap2',
                            '12');
                        getVitalSignLaporanAnesthesiLengkap2(
                            'vitalSignBodyLaporanAnesthesiLengkap3', '13');
                        getVitalSignKeperawatan()

                    } else {
                        errorSwal('Data gagal diperbarui. Silakan coba lagi.');
                        //     $("#loading-indicator").hide();
                    }
                }, (beforesend) => {
                    console.log("Request is being sent...");
                }, (error) => {
                    console.error("Error occurred:", error);
                    errorSwal('Terjadi kesalahan. Silakan coba lagi.');
                    // $("#loading-indicator").hide();
                });

            })


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
                        return key ? groupedData[key]?.nadi.reduce((a, b) => a + b, 0) / (
                            groupedData[
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
                        return key ? groupedData[key]?.nadi.reduce((a, b) => a + b, 0) / (
                            groupedData[
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
                let jsonObj = {
                    instrumen: [],
                    drain: [],
                    diagnosas: [],
                    bromage: [],
                    aldrete: [],
                    steward: [],
                    vitailsign: {},
                    vitailsign2: {},
                    obat: [],
                    boold: []
                };

                const selects = document.querySelectorAll('#bromageContainer1 select');
                selects.forEach(select => {
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
                let diag_cats = dataSend.getAll('diag_cat[]');
                let diag_id = dataSend.getAll('diag_id[]');

                let diag_descs = dataSend.getAll('diag_desc[]');
                let diag_names = dataSend.getAll('diag_name[]');
                let suffer_type = dataSend.getAll('suffer_type[]');

                let date_obat = dataSend.getAll('dateobat[]');
                let bill_obat = dataSend.getAll('billobat[]');


                let date_obatBoold = dataSend.getAll('dateobatBoold[]');
                let bill_obatBoold = dataSend.getAll('billobatBoold[]');




                for (let i = 0; i < date_obat.length; i++) {
                    let entry = {
                        date: date_obat[i] ? moment(date_obat[i], "DD/MM/YYYY HH:mm").format(
                            "YYYY-MM-DD HH:mm") : date_obat[i],
                        bill: bill_obat[i],

                    };
                    jsonObj.obat.push(entry);
                }

                for (let i = 0; i < date_obatBoold.length; i++) {
                    let entry = {
                        date: date_obatBoold[i] ? moment(date_obatBoold[i], "DD/MM/YYYY HH:mm").format(
                            "YYYY-MM-DD HH:mm") : date_obatBoold[i],
                        key: bill_obatBoold[i],

                    };
                    jsonObj.boold.push(entry);
                }



                for (let i = 0; i < diag_cats.length; i++) {
                    let entry = {
                        diagnosa_cat: diag_cats[i],
                        diagnosa_id: diag_id[i],
                        diagnosa_desc: diag_descs[i],
                        diagnosa_name: diag_names[i],
                        suffer_type: suffer_type[i],
                    };
                    jsonObj.diagnosas.push(entry);
                }


                ['diag_cat[]', 'diag_desc[]', 'suffer_type[]'].forEach(key => {
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
                    } else if ($(this).is('select')) {
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
                    } else if ($(this).is(':input[type="text"]')) {
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
                    let $el = $(this);
                    let paramId = $el.attr('name').split('_')[1] || '';
                    let valueId = $el.val()?.trim() ?? "-";
                    let valueDesc = $el.find('option:selected').text() ?? valueId;
                    let valueScore = $el.find('option:selected').data('score') ?? "";

                    if ($el.is(':checkbox:checked') || $el.is(':radio:checked')) {
                        jsonObj.regional.push(createEntry(paramId, valueId, valueDesc,
                            valueScore));
                    } else if ($el.is('select')) {
                        if (valueId !== "") {
                            jsonObj.regional.push(createEntry(paramId, valueId, valueDesc,
                                valueScore));
                        }
                    } else if ($el.is(':input[type="text"], :input[type="hidden"]') &&
                        valueId) {
                        jsonObj.regional.push(createEntry(paramId, valueId, valueDesc, ""));
                    }
                });

                function createEntry(paramId, valueId, valueDesc, valueScore) {
                    return {
                        org_unit_code: dataSend.get('org_unit_code'),
                        visit_id: dataSend.get('visit_id'),
                        trans_id: dataSend.get('trans_id'),
                        body_id: RegionalBodyId,
                        document_id: props?.vactination_id,
                        p_type: 'OPRS033',
                        parameter_id: paramId,
                        value_score: valueScore,
                        value_desc: valueDesc,
                        observation_date: '',
                        modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                        modified_by: dataSend.get('modified_by'),
                        value_id: valueId
                    };
                }



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
                    } else if ($(this).is('select')) {
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
                    } else if ($(this).is(':input[type="text"]')) {
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
                    } else if ($(this).is('select')) {
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
                    } else if ($(this).is(':input[type="text"]')) {
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
                            parameter_id: $(this).attr('name')?.split('_')[1] || '',
                            value_score: $(this).is(':checked') ? $(this).data('score') : null,
                            value_desc: $(this).is(':checked') ? $(this).data('desc') : null,
                            observation_date: '',
                            modified_date: moment().format('YYYY-MM-DD HH:mm:ss'),
                            modified_by: dataSend.get('modified_by'),
                            value_id: $(this).is(':checked') ? $(this).val() : null
                        };

                        jsonObj.jalan_napas.push(entry);

                    } else if ($(this).is('select')) {
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
                    } else if ($(this).is(':input[type="text"]')) {
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
                        let valueDesc = selectElement.find('option:selected').text()
                            .trim();
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
                                modified_date: moment().format(
                                    'YYYY-MM-DD HH:mm:ss'),
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
                        let valueDesc = selectElement.find('option:selected').text()
                            .trim();
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
                                modified_date: moment().format(
                                    'YYYY-MM-DD HH:mm:ss'),
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

                if ($('#vitalSignLaporanAnesthesiLengkap2').is(':visible')) {
                    const vitailSignKeys = ['vs_status_id', 'arm_diameter', 'nadi', 'nafas', 'height',
                        'saturasi', 'temperature', 'tension_below', 'tension_upper',
                        'examination_date',
                        'pemeriksaan', 'weight', 'oxygen_usage'
                    ];
                    jsonObj.vitailsign = jsonObj.vitailsign || {};
                    vitailSignKeys.forEach(key => {
                        jsonObj.vitailsign[key] = jsonObj[key];
                        delete jsonObj[key];
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
                }

                if ($('#vitalSignLaporanAnesthesiLengkap3').is(':visible')) {
                    jsonObj.vitailsign2 = jsonObj.vitailsign2 || {};
                    const vitailSignKeys2 = ['vs_status_id2', 'arm_diameter2', 'nadi2', 'nafas2',
                        'height2',
                        'saturasi2', 'temperature2', 'tension_below2', 'tension_upper2',
                        'examination_date2',
                        'pemeriksaan2', 'weight2', 'oxygen_usage2'
                    ];


                    vitailSignKeys2?.forEach(key => {
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
                }

                jsonObj.post_anesthesia = {};

                const postAnesthesiaKeys = [
                    'bp_medicine', 'fasting', 'infus', 'infus_volume', 'meal', 'mealtime',
                    'oxygen', 'postan_position', 'respiratory_interval', 'transfusion',
                    'vomitus_medicine',
                    'postan_plan', 'oxygen_method', 'recovery_leave_time', 'patient_destination',
                    'pain', 'allergies'
                ];

                // Populate jsonObj.post_anesthesia with key-value pairs
                postAnesthesiaKeys.forEach(key => {
                    jsonObj.post_anesthesia[key] = dataSend.get(key);
                    delete jsonObj[key];
                });



                $("#loading-indicator").show();


                postData(jsonObj, 'admin/PatientOperationRequest/insertAnestesiaLengkap', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');
                        $("#create-modal-permintaan-operasi").modal("hide");

                        getDataTabelRequestOperation({
                            no_registration: props?.no_registration,
                            visit_id: props?.visit_id,
                            trans_id: props?.trans_id
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


            $(".btn-save-vitalSignLaporanAnesthesiLengkap2").off().on("click", function(e) {
                e.preventDefault();
                let jsonObj = {
                    vitailsign: {},
                };
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


                if ($('#vitalSignLaporanAnesthesiLengkap2').closest('.collapse.show').length) {

                    if ($('#vitalSignLaporanAnesthesiLengkap2').is(':visible')) {
                        const vitailSignKeys = ['vs_status_id', 'arm_diameter', 'nadi', 'nafas',
                            'height',
                            'saturasi', 'temperature', 'tension_below', 'tension_upper',
                            'examination_date',
                            'pemeriksaan', 'weight', 'oxygen_usage'
                        ];
                        jsonObj.vitailsign = jsonObj.vitailsign || {};
                        vitailSignKeys.forEach(key => {
                            jsonObj.vitailsign[key] = jsonObj[key];
                            delete jsonObj[key];
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
                        jsonObj.vitailsign['account_id'] = '12'
                    }

                }
                if ($('#vitalSignLaporanAnesthesiLengkap3').closest('.collapse.show').length) {
                    if ($('#vitalSignLaporanAnesthesiLengkap3').is(':visible')) {
                        jsonObj.vitailsign = jsonObj.vitailsign || {};

                        const vitailSignKeys2 = [
                            'vs_status_id2', 'arm_diameter2', 'nadi2', 'nafas2', 'height2',
                            'saturasi2', 'temperature2', 'tension_below2', 'tension_upper2',
                            'examination_date2', 'pemeriksaan2', 'weight2', 'oxygen_usage2'
                        ];

                        vitailSignKeys2.forEach(key => {
                            let inputElement = document.querySelector(
                                `#formvitalsign-laporanAnesthesi-lengkap3 [name="${key}"]`
                            );
                            if (inputElement) {
                                let newKey = key.replace(/2$/, '');
                                if (inputElement.type === 'checkbox') {
                                    jsonObj.vitailsign[newKey] = inputElement.checked;
                                } else if (inputElement.type === 'radio') {
                                    if (inputElement.checked) {
                                        jsonObj.vitailsign[newKey] = inputElement.value;
                                    }
                                } else {
                                    jsonObj.vitailsign[newKey] = inputElement.value;
                                }
                            } else {
                                console.warn(`Input element for key ${key} not found.`);
                                jsonObj.vitailsign[key.replace(/2$/, '')] = null;
                            }
                        });

                        jsonObj.vitailsign['body_id'] = dataSend.get('body_id');
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
                        jsonObj.vitailsign['account_id'] = '13';
                    }
                }


                postData(jsonObj, 'admin/PatientOperationRequest/insertVt', (res) => {

                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');
                        getVitalSignLaporanAnesthesiLengkap(
                            'vitalSignBodyLaporanAnesthesiLengkap',
                            '11');
                        getVitalSignLaporanAnesthesiLengkap(
                            'vitalSignBodyLaporanAnesthesiLengkap2',
                            '12');
                        getVitalSignLaporanAnesthesiLengkap2(
                            'vitalSignBodyLaporanAnesthesiLengkap3', '13');

                    } else {
                        errorSwal('Data gagal diperbarui. Silakan coba lagi.');
                        //     $("#loading-indicator").hide();
                    }
                }, (beforesend) => {
                    console.log("Request is being sent...");
                }, (error) => {
                    console.error("Error occurred:", error);
                    errorSwal('Terjadi kesalahan. Silakan coba lagi.');
                    // $("#loading-indicator").hide();
                });
            })

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


        const modalViewOperationAction = (data) => {
            quillInstancesModal = {}

            let resultData = data;
            let result = resultData.data[0];
            const getEmp = getDataDropdownAllemployee({
                vactination_id: result.vactination_id,
                transaksi: result?.transaksi,
                terlayani: result?.terlayani

            })

            const getClass = getDataColumnName({
                table_name: 'class_room',
                column_name: 'name_of_class',
                column_id: 'class_room_id',
                id: result.class_room_id,
                element_id: 'class_room_id-permintaan_operasi_name'
            })
            const getClinic = getDataColumnName({
                table_name: 'clinic',
                column_name: 'name_of_clinic',
                column_id: 'clinic_id',
                id: result.clinic_id,
                element_id: 'clinic_id_from-permintaan_operasi_name'
            })

            let currentDateTime = moment(new Date(result.start_operation)).format("DD/MM/YYYY HH:mm")
            let currentDateTimeEnd = moment(result?.end_operation ? new Date(result?.end_operation) :
                    new Date())
                .format("DD/MM/YYYY HH:mm");

            $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(result));
            $("#formDate-tindakan-oprasi-1").html("").attr("class", "");
            $.when(getEmp, getClass, getClinic).done(() => {
                Swal.close();
                $("#create-modal-permintaan-operasi").modal("show");
            });
            // $("#create-modal-permintaan-operasi").modal("show");
            $('#btn-save-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-edit-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-updateAndInsert-permintaan-operasi-modal').attr('hidden', false);
            $('#cetak-oprs-permintaan').attr('hidden', false);

            // Set the rest of the fields
            $('#vactination_id-permintaan_operasi').val(result.vactination_id);
            $("#trans_id-permintaan_operasi").val(result?.trans_id)

            $('#org_unit_code-permintaan_operasi').val(result.org_unit_code);
            $('#visit_id-permintaan_operasi').val(result.visit_id);
            $('#no_registration-permintaan_operasi').val(result.no_registration);
            $('#vactination_date-permintaan_operasi').val(moment(result.vactination_date).format(
                "YYYY/MM/DD HH:mm"));
            $('#description-permintaan_operasi').val(result.description);
            const $select = $("#employee_id-permintaan_operasi");
            $select.empty().append(`<option value="">Pilih Dokter</option>`);

            dr_oprtOprs.forEach(emp => {
                $select.append(
                    `<option value="${emp.employee_id}">${emp.fullname}</option>`
                );
            });

            $select.val(result.employee_id).trigger("change");
            $('#doctor-permintaan_operasi').val(result.fullname ?? result.doctor);

            $select.on("change", function() {
                const selectedId = $(this).val();
                const selectedDoctor = dr_oprtOprs.find(d => d.employee_id === selectedId);
                $('#doctor-permintaan_operasi').val(selectedDoctor ? selectedDoctor.fullname : '');
            });

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


            $('#diagnosa_desc-permintaan_operasi').val(result.diagnosa_desc);
            $('#quill_diagnosa_desc-permintaan_operasi').html(result.diagnosa_desc);
            $('#advice_doctor-permintaan_operasi').val(result.advice_doctor);
            $('#quill_advice_doctor-permintaan_operasi').html(result.advice_doctor);

            $('#start_anestesi-permintaan_operasi').val(result.start_anestesi);
            $('#end_anestesi-permintaan_operasi').val(result.end_anestesi);
            $('#result_id-permintaan_operasi').val(result.result_id);
            $('#clinic_id-permintaan_operasi').val(result.clinic_id);
            $('#layan-permintaan_operasi').val(result.layan);

            $("#start_operation-permintaan_operasi").val(currentDateTime)
            $("#end_operation-permintaan_operasi").val(currentDateTimeEnd)

            $("#flatstart_operation-permintaan_operasi").val(currentDateTime).trigger("change");
            $("#flatend_operation-permintaan_operasi").val(currentDateTimeEnd).trigger("change");
            $('#clinic_id_from-permintaan_operasi').val(result.clinic_id);
            $('#class_room_id-permintaan_operasi').val(result.class_room_id);

            $('#patient_category_id-elektif').prop('checked', result.patient_category_id === "0" || result
                .patient_category_id === 0);
            $('#patient_category_id-cyto').prop('checked', result.patient_category_id === "1" || result
                .patient_category_id === 1);
            $('#patient_category_id-emergency').prop('checked', result.patient_category_id === "2" || result
                .patient_category_id === 2);

            $('#kode_operasi-sc').prop('checked', result?.kode_operasi === "1" || result?.kode_operasi === 1);
            $('#kode_operasi-non_sc').prop('checked', result?.kode_operasi === "0" || result?.kode_operasi ===
                0);

            $('#operation_type-permintaan_operasi').val(result.operation_type);



            let tarif_id_oprs_data = tarif_id_oprs;
            const newTreatment = result?.tarif_id;

            $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {
                //     console.log("66666666666666666666666666");
                let treatmentData = renderDropdownTreatment();

                $('#bill_id-permintaan_operasi').select2({
                    data: treatmentData,
                    disabled: false,
                    dropdownParent: $('#create-modal-permintaan-operasi')
                });

                $('#bill_id-permintaan_operasi').val(result.bill_id).trigger('change');


                const isExistingValue = tarif_id_oprs_data.some(item => item.text === newTreatment);
                if (!isExistingValue) {
                    tarif_id_oprs.push({
                        id: newTreatment,
                        text: newTreatment
                    });
                    setTimeout(() => {
                        $('#tarif_id-permintaan_operasi').select2({
                            placeholder: 'Cari atau pilih',
                            allowClear: false,
                            tags: true,
                            disabled: false,
                            data: tarif_id_oprs,
                            dropdownParent: $('#create-modal-permintaan-operasi'),
                            createTag: function(params) {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    newOption: true,
                                };
                            },
                            templateResult: function(data) {
                                if (data.newOption) {
                                    return $('<span>Tambah: ' + data.text +
                                        '</span>');
                                }
                                return data.text;
                            },

                        });

                        $('#tarif_id-permintaan_operasi').val(newTreatment).trigger('change');
                    }, 1000);
                } else {
                    let tarif_id_oprsresult = renderDropdownTarifId();
                    setTimeout(() => {
                        $('#tarif_id-permintaan_operasi').select2({
                            placeholder: 'Cari atau pilih',
                            allowClear: false,
                            tags: true,
                            disabled: false,
                            data: tarif_id_oprsresult,
                            dropdownParent: $('#create-modal-permintaan-operasi'),
                            createTag: function(params) {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    newOption: true,
                                };
                            },
                            templateResult: function(data) {
                                if (data.newOption) {
                                    return $('<span>Tambah: ' + data.text +
                                        '</span>');
                                }
                                return data.text;
                            },

                        });

                        $('#tarif_id-permintaan_operasi').val(result.tarif_id).trigger(
                            'change');
                    }, 1000);
                }
                $('#tarif_id-permintaan_operasi').on('select2:select', function(e) {
                    const selectedValue = e.params.data.text;

                    if (e.params.data.newOption) {
                        $('#tarif_id-permintaan_operasi').select2({
                            placeholder: 'Cari atau pilih',
                            allowClear: false,
                            tags: true,
                            disabled: false,
                            dropdownParent: $(
                                '#create-modal-permintaan-operasi'),
                            createTag: function(params) {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    newOption: true,
                                };
                            },
                            templateResult: function(data) {
                                if (data.newOption) {
                                    return $('<span>Tambah: ' + data.text +
                                        '</span>');
                                }
                                return data.text;
                            },

                        });
                    }
                });

                initializeFlatpickrOperasi()
                initializeQuillEditors();
            });


            if (result?.rooms_id) {
                let inputElementRoom = $("#rooms_id-permintaan_operasi");

                let $selectElementRoom = $("<select>", {
                    id: inputElementRoom.attr("id"),
                    name: inputElementRoom.attr("name"),
                    class: inputElementRoom.attr("class")
                });

                $selectElementRoom.append($("<option>", {
                    value: '',
                    text: 'Select',
                    selected: true
                }));

                let options = ["VK", "Op Mayor", "Op Minor"];
                options.forEach(optionText => {
                    let option = $("<option>", {
                        value: optionText,
                        text: optionText,
                        selected: optionText === result
                            ?.rooms_id
                    });
                    $selectElementRoom.append(option);
                });

                inputElementRoom.replaceWith($selectElementRoom);
            } else {
                let inputElementRoom = $("#rooms_id-permintaan_operasi");

                let $selectElementRoom = $("<select>", {
                    id: inputElementRoom.attr("id"),
                    name: inputElementRoom.attr("name"),
                    class: inputElementRoom.attr("class")
                });

                $selectElementRoom.append($("<option>", {
                    value: '',
                    text: 'Select',
                    selected: true
                }));

                let options = ["VK", "Op Mayor", "Op Minor"];
                options.forEach(optionText => {
                    let option = $("<option>", {
                        value: optionText,
                        text: optionText
                    });
                    $selectElementRoom.append(option);
                });

                inputElementRoom.replaceWith($selectElementRoom);
            }

            actionDropdownSpesialisas()
            initializeQuillEditors();
            actionBtnUpdateAndInsert(result);

            getPrintDataPermintaan(result)
        };

        const getPrintDataPermintaan = (props) => {
            $("#cetak-oprs-permintaan").off().on("click", () => {
                let resultTemplate = visit;
                let nameValueVisit2 = [
                    'diantar_oleh', 'age', 'no_registration',
                    'contact_address', 'gendername',
                ];

                nameValueVisit2.forEach(name => {
                    let id = `${name}-val2-oprs-latter`;
                    let value = resultTemplate?.[name];
                    if (value !== undefined) {
                        $(`#${id}`).text(value);
                    }
                });

                $("#tgl_lahir-val2-oprs-latter").text(moment(resultTemplate?.tgl_lahir).format(
                    "DD/MM/YYYY"));
                $("#tgl_date_oprs_cover").text(moment(resultTemplate?.visit_date).format("DD/MM/YYYY"));
                $("#tgl-val2-oprs-latter").text(moment(props?.start_operation).format("DD/MM/YYYY"));
                $("#desc_tarif-val2-oprs-latter").text(props?.tarif_id);
                $("#diagnosa_desc-val2-oprs-latter").html(props?.diagnosa_desc);
                $("#advice_doctor-val2-oprs-latter").html(props?.advice_doctor);

                let qrContainer = document.createElement("div");
                let qrcode = new QRCode(qrContainer, {
                    text: `${props?.doctor ?? ""}`,
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });

                setTimeout(() => {
                    let qrImg = qrContainer.querySelector("canvas").toDataURL("image/png");
                    $("#validator-ttd-oprs-conver-dokter").html(
                        `<img src="${qrImg}" width="128" height="128">`);
                    openPrintPreview("coverkopSuratPengantaroprs");
                }, 500);
            });
        };

        function openPrintPreview(divId) {
            let printContents = document.getElementById(divId).innerHTML;
            let printWindow = window.open('', '_blank', 'width=800,height=600');

            printWindow.document.write(`
        <html>
        <head>
            <title>Print Preview</title>
            <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; background-color: white; }
                .print-container { padding: 20px; color: black; }
                @media print { body { visibility: visible; } }
            </style>
        </head>
        <body>
            <div class="print-container">
                ${printContents}
            </div>
        </body>
        </html>
    `);

            printWindow.document.close();

            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.print();
                    printWindow.close();
                }, 5000);
            };
        }







        const actionButtonAddOperation = (props) => {
            $("#btn-create-operasi").off().on("click", (e) => {
                quillInstancesModal = {}
                setTimeout(() => {
                    $('#tarif_id-permintaan_operasi').val('').trigger('change');

                }, 2000);


                e.preventDefault();

                $("#dropdown-param-tindakan-operasi").html("");

                $("#create-modal-permintaan-operasi").modal("show");
                $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(props));
                $("#formDate-tindakan-oprasi-2").html("").attr("class", "col-md-1")
                // $('#form-permintaan-operasi')[0].reset();

                $('#btn-save-permintaan-operasi-modal').attr('hidden', false);
                $('#btn-edit-permintaan-operasi-modal').attr('hidden', true);
                $('#btn-updateAndInsert-permintaan-operasi-modal').attr('hidden', true);
                $('#cetak-oprs-permintaan').attr('hidden', true);


                $('#vactination_id-permintaan_operasi').val(generateCode());
                $("#trans_id-permintaan_operasi").val(props?.trans_id)
                $('#org_unit_code-permintaan_operasi').val(props?.org_unit_code);
                $('#visit_id-permintaan_operasi').val(props?.visit_id);
                $('#no_registration-permintaan_operasi').val(props?.no_registration);
                $('#vactination_date-permintaan_operasi').val(moment().format(
                    "YYYY/MM/DD HH:mm"));
                $('#description-permintaan_operasi').val(props?.description);
                const $select = $("#employee_id-permintaan_operasi");
                $select.empty().append(`<option value="">Pilih Dokter</option>`);

                dr_oprtOprs.forEach(emp => {
                    $select.append(
                        `<option value="${emp.employee_id}">${emp.fullname}</option>`
                    );
                });

                $select.val(props.employee_id).trigger("change");
                $('#doctor-permintaan_operasi').val(props.fullname ?? props.doctor);

                $select.on("change", function() {
                    const selectedId = $(this).val();
                    const selectedDoctor = dr_oprtOprs.find(d => d.employee_id === selectedId);
                    $('#doctor-permintaan_operasi').val(selectedDoctor ? selectedDoctor.fullname :
                        '');
                });
                $('#anestesi_type-permintaan_operasi').val(props?.anestesi_type);
                $('#modified_date-permintaan_operasi').val(moment().format("YYYY/MM/DDTHH:mm"));
                $('#modified_by-permintaan_operasi').val();
                $('#validation-permintaan_operasi').val(props?.validation);
                $('#terlayani-permintaan_operasi').val();
                $('#thename-permintaan_operasi').val(props?.diantar_oleh);
                $('#theaddress-permintaan_operasi').val(props?.contact_address);
                $('#theid-permintaan_operasi').val(props?.pasien_id);
                $('#isrj-permintaan_operasi').val(props?.isrj);
                $('#status_pasien_id-permintaan_operasi').val(props?.status_pasien_id);
                $('#gender-permintaan_operasi').val(props?.gender);
                $('#ageyear-permintaan_operasi').val(props?.ageyear);
                $('#agemonth-permintaan_operasi').val(props?.agemonth);
                $('#ageday-permintaan_operasi').val(props?.ageday);
                $('#bed_id-permintaan_operasi').val(props?.bed_id);
                $('#keluar_id-permintaan_operasi').val(props?.keluar_id);
                $('#diagnosa_pra-permintaan_operasi').val(props?.diagnosa_pra);
                $('#diagnosa_pasca-permintaan_operasi').val(props?.diagnosa_pasca);
                $('#end_operation-permintaan_operasi').val();
                $('#start_anestesi-permintaan_operasi').val(props?.start_anestesi);
                $('#end_anestesi-permintaan_operasi').val(props?.end_anestesi);
                $('#result_id-permintaan_operasi').val(props?.result_id);
                $('#clinic_id-permintaan_operasi').val("P002");
                $('#transaksi-permintaan_operasi').val(0);
                $('#layan-permintaan_operasi').val(props?.layan);
                let currentDateTime = moment(new Date()).format("DD/MM/YYYY HH:mm")
                $("#flatstart_operation-permintaan_operasi").val(currentDateTime).trigger("change");
                $("#start_operation-permintaan_operasi").val(moment($(
                    "#flatstart_operation-permintaan_operasi").val(), ["YYYY-MM-DD HH:mm",
                    "DD/MM/YYYY HH:mm"
                ]).format("DD-MM-YYYY HH:mm"))
                $('#rooms_id-permintaan_operasi').val(props?.rooms_id);
                $('#clinic_id_from-permintaan_operasi').val("P002");
                $('#class_room_id-permintaan_operasi').val(props?.class_room_id);
                const categoryId = props?.patient_category_id ?? 0;
                const codeId = props?.kode_operasi ?? 0;

                $('#patient_category_id-elektif').prop('checked', categoryId === 0);
                $('#patient_category_id-cyto').prop('checked', categoryId === 1);
                $('#patient_category_id-emergency').prop('checked', categoryId === 2);


                $('#kode_operasi-sc').prop('checked', codeId === 1);
                $('#kode_operasi-non_sc').prop('checked', codeId === 0);


                $('#operation_type-permintaan_operasi').val("");
                $('#diagnosa_desc-permintaan_operasi').val("");
                $('#quill_diagnosa_desc-permintaan_operasi').html("");

                $('#advice_doctor-permintaan_operasi').val("");
                $('#quill_advice_doctor-permintaan_operasi').html("");


                getDataColumnName({
                    table_name: 'class_room',
                    column_name: 'name_of_class',
                    column_id: 'class_room_id',
                    id: props?.class_room_id,
                    element_id: 'class_room_id-permintaan_operasi_name'
                })
                getDataColumnName({
                    table_name: 'clinic',
                    column_name: 'name_of_clinic',
                    column_id: 'clinic_id',
                    id: "P002",
                    element_id: 'clinic_id_from-permintaan_operasi_name'
                })


                $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {
                    let treatmentData1Action = renderDropdownTreatment();

                    $('#bill_id-permintaan_operasi').select2({
                        data: treatmentData1Action,
                        disabled: false,
                        dropdownParent: $('#create-modal-permintaan-operasi'),
                        width: '100%',
                    });

                    let tarif_id_oprs = renderDropdownTarifId();


                    $('#tarif_id-permintaan_operasi').select2({
                        placeholder: 'Cari atau pilih',
                        allowClear: false,
                        tags: true,
                        disabled: false,
                        data: tarif_id_oprs,
                        dropdownParent: $('#create-modal-permintaan-operasi'),
                        createTag: function(params) {

                            if ($.trim(params.term) === '') {
                                return null;
                            }
                            return {
                                id: params.term,
                                text: params.term,
                                newOption: true,
                            };
                        },
                        templateResult: function(data) {
                            if (data.newOption) {
                                return $('<span>Tambah: ' + data.text + '</span>');
                            }
                            return data.text;
                        },

                    });

                    $('#tarif_id-permintaan_operasi').on('select2:select', function(e) {
                        const selectedValue = e.params.data.text;

                        if (e.params.data.newOption) {

                            // $('#tarif_id-permintaan_operasi').val('').trigger('change');
                            $('#tarif_id-permintaan_operasi').select2({
                                placeholder: 'Cari atau pilih',
                                allowClear: false,
                                disabled: false,
                                tags: true,
                                dropdownParent: $(
                                    '#create-modal-permintaan-operasi'),
                                createTag: function(params) {
                                    return {
                                        id: params.term,
                                        text: params.term,
                                        newOption: true,
                                    };
                                },
                                templateResult: function(data) {
                                    if (data.newOption) {
                                        return $('<span>Tambah: ' + data
                                            .text +
                                            '</span>');
                                    }
                                    return data.text;
                                },

                            });
                        }
                    });

                    initializeFlatpickrOperasi()
                    initializeQuillEditors();
                });


                initializeQuillEditors();
                actionDropdownSpesialisas();
                btnSaveActionRequestOperation(props);
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



        const renderDropdownTarifId = () => {
            let data = tarif_id_oprs

            let result = "";
            data.forEach((item) => {
                result +=
                    `<option value="${item.id}">${item.text}</option>`;
            });

            $("#tarif_id-permintaan_operasi").html(
                `<option selected disabled value="">Pilih Tindakan</option>` +
                result);

        }

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
               <!-- <div class="form-group">
                    <label for="employee_id-permintaan_operasi">Employee ID</label>
                    <input class="form-control disabled" id="employee_id-permintaan_operasi" name="employee_id">
                </div>-->
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
                <!--<div class="form-group">
                    <label for="terlayani-permintaan_operasi">Terlayani</label>
                    <input class="form-control disabled" id="terlayani-permintaan_operasi" name="terlayani" value='0'>
                </div>-->
               
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

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="employee_id-permintaan_operasi">Dokter Operator</label>
                        <select class="form-control select2-oprs" id="employee_id-permintaan_operasi" name="employee_id" required>
                            <!-- Option elements here -->
                        </select>
                    </div>
                </div>

                <!-- Grup 1: Tanggal/Jam Operasi -->
                <div class="row form-group pt-3">
                    <div class="col-md-4" id="formDate-tindakan-oprasi-1">
                        <label for="start_operation-permintaan_operasi">Tanggal/Jam Operasi</label>
                        <input id="start_operation-permintaan_operasi" name="start_operation" type="hidden" class="form-control" placeholder="yyyy-mm-dd HH:mm ">
                        <input class="form-control datetimeflatpickr-oprs" type="text" id="flatstart_operation-permintaan_operasi" >
                    </div>
                    <div class="col-md-6" id="formDate-tindakan-oprasi-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_operation-range">Tanggal/Jam Operasi</label>
                                      <input id="start_operation-permintaan_operasi" name="start_operation" type="hidden" class="form-control" placeholder="yyyy-mm-dd">
                                    <input class="form-control datetimeflatpickr-oprs" type="text" id="flatstart_operation-permintaan_operasi" >
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
                                    <input class="form-control  datetimeflatpickr-oprs" type="text" id="flatend_operation-permintaan_operasi" name="end_operation">
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
                        <label> </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="kode_operasi-sc" name="kode_operasi_oprs" value="1">
                            <label class="form-check-label" for="kode_operasi-sc">SC</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="kode_operasi-non_sc" name="kode_operasi_oprs" value="0">
                            <label class="form-check-label" for="kode_operasi-non_sc">Non SC</label>
                        </div>
                        
                    </div>

                    <div class="col-md-4">
                        <label>Emergency / Elektif</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="patient_category_id-elektif" name="patient_category_id_oprs" value="0">
                            <label class="form-check-label" for="patient_category_id-elektif">Elektif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="patient_category_id-cyto" name="patient_category_id_oprs" value="1">
                            <label class="form-check-label" for="patient_category_id-cyto">Cyto</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="patient_category_id-emergency" name="patient_category_id_oprs" value="2">
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
                        <label for="tarif_id-permintaan_operasi">Prosedur Operasi</label>
                        <select class="form-control select2-oprs" id="tarif_id-permintaan_operasi" name="tarif_id" required>
                            <!-- Option elements here -->
                        </select>
                    </div>
                </div>

                <div class="row form-group mb-4 pb-5">
                    <div class="col-md-12">
                        <label for="diagnosa_desc-permintaan_operasi">Diagnosis</label>
                        <!--- <textarea class="form-control quill-editor-oprs disabled" id="diagnosa_desc-permintaan_operasi" name="diagnosa_desc"></textarea>-->
                        <input type="hidden" id="diagnosa_desc-permintaan_operasi" name="diagnosa_desc">
                        <div id="quill_diagnosa_desc-permintaan_operasi"  data-id="diagnosa_desc-permintaan_operasi"
                            class="quill-editor-oprs-modal" 
                            name="diagnosa_desc">
                        </div>
                    </div>
                </div>

                <div class="row form-group mb-4 pb-5">
                    <div class="col-md-12">
                        <label for="advice_doctor-permintaan_operasi">Advice Dokter</label>
                        <!--- <textarea class="form-control quill-editor-oprs disabled" id="advice_doctor-permintaan_operasi" name="advice_doctor"></textarea>-->
                        <input type="hidden" id="advice_doctor-permintaan_operasi" name="advice_doctor">
                        <div id="quill_advice_doctor-permintaan_operasi"  data-id="advice_doctor-permintaan_operasi"
                            class="quill-editor-oprs-modal" 
                            name="advice_doctor">
                        </div>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="operation_type-permintaan_operasi">Sub Spesialisas</label>
                        <input class="form-control disabled" id="operation_type-permintaan_operasi" name="operation_type" disabled value="" hidden>
                        <input class="form-control disabled" id="operation_type_name-permintaan_operasi" name="operation_type_name" disabled value="">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="bill_id-permintaan_operasi">Tarif Tindakan Operasi</label>
                        <select class="form-control select2-oprs" id="bill_id-permintaan_operasi" name="bill_id" required>
                            <!-- Option elements here -->
                        </select>
                    </div>
                </div>

                
            </div>
            `
        }

        const modalViewDetailRequestOperation = (data) => {
            quillInstancesModal = {}


            let resultData = data;
            let result = resultData.data[0];

            $("#dropdown-param-tindakan-operasi").html("");
            $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(result));
            $("#formDate-tindakan-oprasi-2").html("").attr("class", "col-md-1")
            $("#create-modal-permintaan-operasi").modal("show");
            $('#btn-save-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-edit-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-updateAndInsert-permintaan-operasi-modal').attr('hidden', true);
            $('#cetak-oprs-permintaan').attr('hidden', false);


            $('#org_unit_code-permintaan_operasi').val(result.org_unit_code);
            $('#visit_id-permintaan_operasi').val(result.visit_id);
            $('#no_registration-permintaan_operasi').val(result.no_registration);
            $('#vactination_date-permintaan_operasi').val(moment(result?.vactination_date).format(
                "YYYY/MM/DD HH:mm"));
            $('#description-permintaan_operasi').val(result.description);
            const $select = $("#employee_id-permintaan_operasi");
            $select.empty().append(`<option value="">Pilih Dokter</option>`);

            dr_oprtOprs.forEach(emp => {
                $select.append(
                    `<option value="${emp.employee_id}">${emp.fullname}</option>`
                );
            });

            $select.val(result.employee_id).trigger("change");
            $('#doctor-permintaan_operasi').val(result.fullname ?? result.doctor);

            $select.on("change", function() {
                const selectedId = $(this).val();
                const selectedDoctor = dr_oprtOprs.find(d => d.employee_id === selectedId);
                $('#doctor-permintaan_operasi').val(selectedDoctor ? selectedDoctor.fullname : '');
            });
            // $('#employee_id-permintaan_operasi').val(result.employee_id);
            // $('#doctor-permintaan_operasi').val(result.fullname);
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
            $('#diagnosa_desc-permintaan_operasi').val(result.diagnosa_desc);
            $('#advice_doctor-permintaan_operasi').val(result.advice_doctor);
            $('#quill_diagnosa_desc-permintaan_operasi').html(result.diagnosa_desc);
            $('#quill_advice_doctor-permintaan_operasi').html(result.advice_doctor);

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

            $('#patient_category_id-elektif').prop('checked', result.patient_category_id === 0);
            $('#patient_category_id-cyto').prop('checked', result.patient_category_id === 1);
            $('#patient_category_id-emergency').prop('checked', result.patient_category_id === 2);

            $('#kode_operasi-sc').prop('checked', result.kode_operasi === 1);
            $('#kode_operasi-non_sc').prop('checked', result.kode_operasi === 0);

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

            let tarif_id_oprs_data = tarif_id_oprs;
            const newTreatment = result.tarif_id;

            $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {
                $('#bill_id-permintaan_operasi').select2({
                    disabled: true
                });
                $('#tarif_id-permintaan_operasi').select2({
                    disabled: true
                });


                const isExistingValue = tarif_id_oprs_data.some(item => item.text === newTreatment);
                if (!isExistingValue) {
                    tarif_id_oprs.push({
                        id: newTreatment,
                        text: newTreatment
                    });
                    setTimeout(() => {
                        $('#tarif_id-permintaan_operasi').select2({
                            placeholder: 'Cari atau pilih',
                            allowClear: false,
                            tags: true,
                            data: tarif_id_oprs,
                            dropdownParent: $('#create-modal-permintaan-operasi'),
                            createTag: function(params) {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    newOption: true,
                                };
                            },
                            templateResult: function(data) {
                                if (data.newOption) {
                                    return $('<span>Tambah: ' + data.text +
                                        '</span>');
                                }
                                return data.text;
                            },

                        });

                        $('#tarif_id-permintaan_operasi').val(newTreatment).trigger('change');
                    }, 1000);
                } else {
                    let tarif_id_oprsresult = renderDropdownTarifId();
                    setTimeout(() => {
                        $('#tarif_id-permintaan_operasi').select2({
                            placeholder: 'Cari atau pilih',
                            allowClear: false,
                            tags: true,
                            data: tarif_id_oprsresult,
                            dropdownParent: $('#create-modal-permintaan-operasi'),
                            createTag: function(params) {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    newOption: true,
                                };
                            },
                            templateResult: function(data) {
                                if (data.newOption) {
                                    return $('<span>Tambah: ' + data.text +
                                        '</span>');
                                }
                                return data.text;
                            },

                        });

                        $('#tarif_id-permintaan_operasi').val(result.tarif_id).trigger(
                            'change');
                    }, 1000);
                }
                $('#tarif_id-permintaan_operasi').on('select2:select', function(e) {
                    const selectedValue = e.params.data.text;

                    if (e.params.data.newOption) {
                        $('#tarif_id-permintaan_operasi').select2({
                            placeholder: 'Cari atau pilih',
                            allowClear: false,
                            tags: true,
                            dropdownParent: $(
                                '#create-modal-permintaan-operasi'),
                            createTag: function(params) {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    newOption: true,
                                };
                            },
                            templateResult: function(data) {
                                if (data.newOption) {
                                    return $('<span>Tambah: ' + data.text +
                                        '</span>');
                                }
                                return data.text;
                            },

                        });
                    }
                });

                $('#bill_id-permintaan_operasi').val(result.bill_id).trigger('change');
                initializeFlatpickrOperasi()
                initializeQuillEditors();
            });
            initializeQuillEditors();

            getPrintDataPermintaan(result)
        };

        const modalViewEditRequestOperation = (data) => {
            quillInstancesModal = {}

            let resultData = data;
            let result = resultData.data[0];

            $("#dropdown-param-tindakan-operasi").html("");
            $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(result));
            $("#formDate-tindakan-oprasi-2").html("").attr("class", "col-md-1")
            $("#create-modal-permintaan-operasi").modal("show");
            $('#btn-save-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-edit-permintaan-operasi-modal').attr('hidden', false);
            $('#btn-updateAndInsert-permintaan-operasi-modal').attr('hidden', true);
            $('#cetak-oprs-permintaan').attr('hidden', true);



            $('#vactination_id-permintaan_operasi').val(result.vactination_id);
            $("#trans_id-permintaan_operasi").val(result?.trans_id)
            $('#org_unit_code-permintaan_operasi').val(result.org_unit_code);
            $('#visit_id-permintaan_operasi').val(result.visit_id);
            $('#no_registration-permintaan_operasi').val(result.no_registration);
            $('#vactination_date-permintaan_operasi').val(moment(result?.vactination_date).format(
                "YYYY/MM/DD HH:mm"));
            $('#description-permintaan_operasi').val(result.description);
            const $select = $("#employee_id-permintaan_operasi");
            $select.empty().append(`<option value="">Pilih Dokter</option>`);

            dr_oprtOprs.forEach(emp => {
                $select.append(
                    `<option value="${emp.employee_id}">${emp.fullname}</option>`
                );
            });

            $select.val(result.employee_id).trigger("change");
            $('#doctor-permintaan_operasi').val(result.fullname ?? result.doctor);

            $select.on("change", function() {
                const selectedId = $(this).val();
                const selectedDoctor = dr_oprtOprs.find(d => d.employee_id === selectedId);
                $('#doctor-permintaan_operasi').val(selectedDoctor ? selectedDoctor.fullname : '');
            });
            // $('#employee_id-permintaan_operasi').val(result.employee_id);
            // $('#doctor-permintaan_operasi').val(result?.fullname ?? result?.doctor);
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

            $('#diagnosa_desc-permintaan_operasi').val(result.diagnosa_desc);
            $('#advice_doctor-permintaan_operasi').val(result.advice_doctor);
            $('#quill_advice_doctor-permintaan_operasi').html(result.advice_doctor);
            $('#quill_diagnosa_desc-permintaan_operasi').html(result.diagnosa_desc);
            $('#end_operation-permintaan_operasi').val(result.end_operation)
            $('#start_anestesi-permintaan_operasi').val(result.start_anestesi);
            $('#end_anestesi-permintaan_operasi').val(result.end_anestesi);
            $('#result_id-permintaan_operasi').val(result.result_id);
            $('#clinic_id-permintaan_operasi').val(result.clinic_id);
            $('#transaksi-permintaan_operasi').val(result.transaksi);
            $('#layan-permintaan_operasi').val(result.layan);
            let currentDateTime = moment(new Date(result.start_operation)).format("DD/MM/YYYY HH:mm")
            $("#start_operation-permintaan_operasi").val(currentDateTime)
            $("#flatstart_operation-permintaan_operasi").val(currentDateTime).trigger("change");
            $('#rooms_id-permintaan_operasi').val(result?.rooms_id);
            $('#clinic_id_from-permintaan_operasi').val(result.clinic_id);
            $('#class_room_id-permintaan_operasi').val(result.class_room_id);
            $('#patient_category_id-elektif').prop('checked', result.patient_category_id === "0" || result
                .patient_category_id === 0);
            $('#patient_category_id-cyto').prop('checked', result.patient_category_id === "1" || result
                .patient_category_id === 1);
            $('#patient_category_id-emergency').prop('checked', result.patient_category_id === "2" || result
                .patient_category_id === 2);

            $('#kode_operasi-sc').prop('checked', result?.kode_operasi === "1" || result?.kode_operasi === 1);
            $('#kode_operasi-non_sc').prop('checked', result?.kode_operasi === "0" || result?.kode_operasi ===
                0);


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

            let tarif_id_oprs_data = tarif_id_oprs;
            const newTreatment = result.tarif_id;

            $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {
                let treatmentData = renderDropdownTreatment();

                $('#bill_id-permintaan_operasi').select2({
                    data: treatmentData,
                    disabled: false,
                    dropdownParent: $('#create-modal-permintaan-operasi')
                });

                $('#bill_id-permintaan_operasi').val(result.bill_id).trigger('change');

                const isExistingValue = tarif_id_oprs_data.some(item => item.text === newTreatment);
                if (!isExistingValue) {
                    tarif_id_oprs.push({
                        id: newTreatment,
                        text: newTreatment
                    });
                    setTimeout(() => {
                        $('#tarif_id-permintaan_operasi').select2({
                            placeholder: 'Cari atau pilih',
                            allowClear: false,
                            tags: true,
                            disabled: false,
                            data: tarif_id_oprs,
                            dropdownParent: $('#create-modal-permintaan-operasi'),
                            createTag: function(params) {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    newOption: true,
                                };
                            },
                            templateResult: function(data) {
                                if (data.newOption) {
                                    return $('<span>Tambah: ' + data.text +
                                        '</span>');
                                }
                                return data.text;
                            },

                        });

                        $('#tarif_id-permintaan_operasi').val(newTreatment).trigger('change');
                    }, 1000);
                } else {
                    let tarif_id_oprsresult = renderDropdownTarifId();
                    setTimeout(() => {
                        $('#tarif_id-permintaan_operasi').select2({
                            placeholder: 'Cari atau pilih',
                            allowClear: false,
                            tags: true,
                            disabled: false,
                            data: tarif_id_oprsresult,
                            dropdownParent: $('#create-modal-permintaan-operasi'),
                            createTag: function(params) {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    newOption: true,
                                };
                            },
                            templateResult: function(data) {
                                if (data.newOption) {
                                    return $('<span>Tambah: ' + data.text +
                                        '</span>');
                                }
                                return data.text;
                            },

                        });

                        $('#tarif_id-permintaan_operasi').val(result.tarif_id).trigger(
                            'change');
                    }, 1000);
                }
                $('#tarif_id-permintaan_operasi').on('select2:select', function(e) {
                    const selectedValue = e.params.data.text;

                    if (e.params.data.newOption) {
                        $('#tarif_id-permintaan_operasi').select2({
                            placeholder: 'Cari atau pilih',
                            allowClear: false,
                            tags: true,
                            disabled: false,
                            dropdownParent: $(
                                '#create-modal-permintaan-operasi'),
                            createTag: function(params) {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    newOption: true,
                                };
                            },
                            templateResult: function(data) {
                                if (data.newOption) {
                                    return $('<span>Tambah: ' + data.text +
                                        '</span>');
                                }
                                return data.text;
                            },

                        });
                    }
                });

                initializeFlatpickrOperasi()
                initializeQuillEditors();
            });
            initializeFlatpickrOperasi()
            initializeQuillEditors();
            btnUpdateDataRequestOperation(result)
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

                    let colClass =
                        ((e?.p_type === "OPRS030" && ["13", "14", "15", "16", "17", "18"].includes(e
                                .parameter_id)) ||
                            (e?.p_type === "OPRS031") || (e?.p_type === "OPRS034") ||
                            (e?.p_type === "OPRS011" && ["15"].includes(e.parameter_id))) ?
                        "col-12" :

                        ((e?.p_type === "OPRS011" && ["22", "23", "24", "25"].includes(e
                                .parameter_id)) ||
                            (e?.p_type === "OPRS006" && ["28", "29", "30", "31"].includes(e
                                .parameter_id)) ||
                            (e?.p_type === "OPRS011" && ["04", "05", "06", "07", "08", "09",
                                "10",
                                "11", "16", "17", "19"
                            ].includes(e.parameter_id))) ? "col-3" :

                        (e?.entry_type == 4 ? "col-12" : "col-6");

                    let label = "";
                    if (e?.p_type === "OPRS034") {
                        switch (e.parameter_id) {
                            case "38":
                                label = `<h4 class="fw-bold d-block pt-3">Kepala</h4>`;
                                break;
                            case "44":
                                label = `<h4 class="fw-bold d-block pt-3">Leher</h4>`;
                                break;
                            case "45":
                                label = `<h4 class="fw-bold d-block pt-3">Thorax</h4>`;
                                break;
                            case "48":
                                label = `<h4 class="fw-bold d-block pt-3">Abdomen</h4>`;
                                break;
                            case "52":
                                label = `<h4 class="fw-bold d-block pt-3">Genitalia</h4>`;
                                break;
                            case "53":
                                label = `<h4 class="fw-bold d-block pt-3">Ekstremitas</h4>`;
                                break;
                        }
                    }

                    return htmlContent.trim() ? `
                            ${label} 
                        <div class="row pl-sm-0 ${colClass}" id="type-container-${e?.parameter_id}-${e?.p_type}">
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
                    <td> ${item?.brand_name === '1' ? 'Instrumen' :
                            item?.brand_name === '2' ? 'Kassa' :
                            item?.brand_name === '3' ? 'Jarum' :
                            item?.brand_name === '4' ? 'TAMPON KASSA THT' :
                            item?.brand_name === '5' ? 'TAMPON KASSA BIASA' :
                            item?.brand_name === '6' ? 'TAMPON KASSA ROLL OBSGYN' :
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
                    const quantityIntra = parseFloat($(`#quantity_intra_${index}`).val()) ||
                        0;
                    const quantityAdditional = parseFloat($(`#quantity_additional_${index}`)
                            .val()) ||
                        0;
                    const quantityAfter = parseFloat($(`#quantity_after_${index}`).val()) ||
                        0;

                    const resultCell = $(`.result-${index}`);

                    const condition1 = (quantityIntra === quantityBefore);

                    const condition2 = (quantityBefore + quantityAdditional ===
                        quantityAfter);

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

            let filteredaValue = avalue.filter(item => item.p_type === 'OPRS023');

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
                let status = totalScore >= 8 ? 'Pindah Ruangan / Pulang' : 'Tidak Pindah';

                row.find('.total-score-input').text(totalScore);

                row.find('.discharge-status-input').text(status);
            };

            let observationDate = props?.item?.observation_date ? moment(props?.item
                    ?.observation_date) :
                moment(
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
                    <td class="total-score" width="1%">
                        <h3><span class="badge text-bg-secondary total-score-input">0</span></h3>
                    </td>
                    <td class="discharge-status" style="width:100px;">
                        <span class="discharge-status-input"></span>
                    </td>
                    ${props.index === 0 ? `
                    <td></td>
                        <td class="datetime">
                            <input type="text" class="form-control datetime-input datetimeflatpickr-oprs" value="${observationDateFormatted}" hidden>
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
                            <input type="text" class="form-control datetime-input datetimeflatpickr-oprs" value="${observationDateFormatted}" hidden name='observation_date[]'>
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
                    let newDatetime = moment(previousDatetime).add(selectedMinutes, 'minutes')
                        .format(
                            'YYYY-MM-DDTHH:mm');
                    row.find('.datetime-input').val(newDatetime);
                    row.find('.datetime-display').text(formatTimeOnly(newDatetime));
                    updateRowScoreAndStatus(row);
                }
            });

            if (props.index > 0) {
                let previousDatetime = $(`#${props?.container} tr`).eq(props.index - 1).find(
                        '.datetime-input')
                    .val();
                let defaultDatetime = moment(previousDatetime).add(5, 'minutes').format(
                    'YYYY-MM-DDTHH:mm');
                $(`#${props?.container} tr`).eq(props.index).find('.datetime-input').val(
                    defaultDatetime);
                $(`#${props?.container} tr`).eq(props.index).find('.datetime-display').text(
                    formatTimeOnly(
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

            $("#riwayat_penyakit-catatan_operasi").html(contentPenyakit)
            $("#alergi-catatan_operasi").html(contentAlergi)


        }

        const getDataKeperawatanOPRS001 = async (props) => {
            let data = props?.data
            let blood_request = props?.blood_request
            let diagnosas = props?.diagnosas
            let blood_request_history = props?.blood_request_history;

            let catatanKeperawatanOPRS001 = `
                    <div class="container">
                        <div class="row">
                            <div id="cKeperawatanoprs001-1" class="row"></div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                            <div class="form-group">
                                <label><strong>Tanda Tangan Perawat Ruangan</strong></label>
                                <div class="position-relative" id="qr-nurse_sign-1-${data?.body_id}">
                                    <button type="button" id="formPraOperasiSignBtn1" name="signrm" data-sign-ke="1" data-save="nurse_sign" data-vac="${pasienOperasiSelected?.vactination_id}"
                                        data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
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
                            <div class="table tablecustom-responsive table-responsive">
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
                                <div class="table tablecustom-responsive table-responsive">
                                    <h4><b>DIAGNOSA</b></h4>
                                    <hr>
                                    <table id="tablediagnosa" class="table">
                                        <thead>
                                                <th class="text-center" style="width: 10%"></th>
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
                            <div class="position-relative" id="qr-doctor_marker_sign-2-${data?.body_id}">
                                <button type="button" id="formPraOperasiSignBtn2" name="signrm" data-sign-ke="2" data-save="doctor_marker_sign" data-vac="${pasienOperasiSelected?.vactination_id}"
                                    data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
                                    <i class="fa fa-signature"></i> <span>Sign</span>
                                </button>
                            </div>
                        </div>
                    </div>`

            let bloodRequestHistory = `
                        <div class="row mt-4">
                            <div class="table tablecustom-responsive table-responsive">
                                <h4><b>History Produk Darah</b></h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>No.</th>
                                            <th>Jenis Darah</th>
                                            <th>Deskripsi</th>
                                            <th>Golongan Darah</th>
                                            <th>Jumlah</th>
                                            <th>Ukuran</th>
                                            <th>Tanggal Permintaan</th>
                                            <th>Tanggal Digunakan</th>
                                            <th>Tanggal Dikirim</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyBloodRequesHistoryt">
                                        ${(blood_request_history && blood_request_history.length > 0) ? blood_request_history.map((item, index) => `
                                            <tr>
                                                <td width="1%">${index + 1}</td>
                                                <td style="width:80px !important;">${item?.usagetype}</td>
                                                <td>${item?.descriptions ?? ''}</td>
                                                <td style="width:60px !important;">
                                                    <span class="blood-type">
                                                        ${item?.blood_type_id == 0 ? '-' : 
                                                        item?.blood_type_id == 1 ? 'A' :
                                                        item?.blood_type_id == 2 ? 'B' :
                                                        item?.blood_type_id == 3 ? 'AB' :
                                                        item?.blood_type_id == 4 ? 'O' :
                                                        item?.blood_type_id == 5 ? '-' :
                                                        item?.blood_type_id == 6 ? 'A+' :
                                                        item?.blood_type_id == 7 ? 'B+' :
                                                        item?.blood_type_id == 8 ? 'AB+' :
                                                        item?.blood_type_id == 9 ? 'O+' : 'N/A'}
                                                    </span>
                                                </td>
                                                <td width="1%">${item?.blood_quantity}</td>
                                                <td width="1%">${item?.measure_id}</td>
                                                <td>${item?.request_date}</td>
                                                <td>${item?.using_time}</td>
                                                <td>${item?.delivery_time}</td>
                                                <td width="1%">${item?.terlayani === "1" ? 'Processed' : 'Pending'}</td>
                                            </tr>
                                        `).join('') : '<tr><td colspan="10">No data available</td></tr>'}

                                    </tbody>
                                </table>
                            </div>
                        </div>
            `;

            getAvalueType({
                p_type: 'OPRS001',
                content_id: 'cKeperawatanoprs001-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
            });

            $('#ttd-praOps').html(ttdOps2)
            $('#cKeperawatanoprs001').html(catatanKeperawatanOPRS001);
            $('#containerBloodRequest').html(bloodRequest);
            $('#containerBloodRequestHistory').html(bloodRequestHistory);
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

                    addRowDiagDokterOprs('bodyDiagPraOperation2-', pasienOperasiSelected
                        ?.vactination_id,
                        item?.diagnosa_id, item?.diagnosa_name ?? item?.diagnosa_desc,
                        item
                        ?.diag_cat);

                    // if (item.diag_cat == 13) {
                    //     addRowDiagDokterOprs('bodyDiagPraOperation2-', pasienOperasiSelected
                    //         ?.vactination_id,
                    //         item?.diagnosa_id, item?.diagnosa_name ?? item?.diagnosa_desc, item
                    //         ?.diag_cat, item?.diag_suffer);
                    // }
                });
            }

            $("#adddiagnosaPraOperasi").on("click", () => {
                addRowDiagDokterOprs('bodyDiagPraOperation2-', pasienOperasiSelected
                    ?.vactination_id,
                    null,
                    null, 13, 0);
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
                const signFiled = $(this).data('save');


                addSignUserOPS("formPraOperasi", "accordionPraOperasi", 'apobody_id',
                    buttonId,
                    7, signKe,
                    1, "Catatan Keperawatan Pra Operasi", signFiled);
            });


            const {
                nurse_sign,
                doctor_marker_sign,
                body_id
            } = props?.data || {};

            let targetId = "";
            let qrText = "";

            if (nurse_sign) {
                targetId = `qr-nurse_sign-1-${body_id}`;
                qrText = nurse_sign;
            } else if (doctor_marker_sign) {
                targetId = `qr-doctor_marker_sign-2-${body_id}`;
                qrText = doctor_marker_sign;
            }


            if (targetId) {
                $(`#${targetId}`).empty();
                new QRCode(document.getElementById(targetId), {
                    text: qrText,
                    width: 70,
                    height: 70,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H // High error correction
                });
            }


            initializeFlatpickrOperasi();
        }

        //---------bbb
        const catatanKeperawatanPraOperasi = async (props) => {

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
                                    <span id="riwayat_penyakit-catatan_operasi"></span>
                                 <!---   <textarea class="form-control disabled" id="riwayat_penyakit-catatan_operasi" name="riwayat_penyakit-catatan-operasi"></textarea> --->
                                </div>
                                <div class="form-group col-sm-12 mb-3">
                                    <label for="alergi-catatan_operasi" class="fw-bold">Alergi</label>
                                    <span id="alergi-catatan_operasi"></span>
                                      <!---  <textarea class="form-control disabled" id="alergi-catatan_operasi" name="alergi-catatan-operasi"></textarea>--->
                                      
                                    <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value="${data?.trans_id ?? visit?.trans_id}" hidden></input>
                                    <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value="${data?.body_id}" hidden></input>
                                    <input class="form-control disabled" id="visit_id-catatan_operasi" name="visit_id" value="${data?.visit_id ?? visit?.visit_id}" hidden></input>
                                    <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value="${data?.org_unit_code ?? visit?.org_unit_code}" hidden></input>
                                    <input class="form-control disabled" id="no_registration-catatan_operasi" name="no_registration" value="${data?.no_registration ?? visit?.no_registration}" hidden></input>
                                </div>
                                <div class="row mb-4 pt-4">
                                    <div class="table tablecustom-responsive table-responsive">
                                        <h4><b>DIAGNOSA</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" >Validate</th>
                                                <th class="text-center" >Kategori Diagnosis</th>
                                                
                                            </thead>
                                            <tbody id="bodyDiagKepCatatanPraOprs-${data?.document_id?? pasienOperasiSelected?.vactination_id}">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag-catatanPraOprs" name="adddiagnosa" class="btn btn-secondary">
                                            <i class="fa fa-check-circle"></i> <span>Diagnosa</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                    <div class="form-group">
                                        <label><strong>Tanda Tangan Perawat IBS</strong></label>
                                        <div class="position-relative" id="qr-petugas_ibs_signature-1-${data?.body_id}">
                                            <button type="button" id="formPeriOperasiSignBtn1" name="signperi" data-sign-ke="1" data-save="petugas_ibs_signature"
                                                data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
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
                                 <div class="row mb-4 pt-4">
                                    <div class="table tablecustom-responsive table-responsive">
                                        <h4><b>DIAGNOSA</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" >Validate</th>
                                                <th class="text-center" >Kategori Diagnosis</th>
                                                
                                            </thead>
                                            <tbody id="bodyDiagKepCatatanIntraOprs-${data?.document_id?? pasienOperasiSelected?.vactination_id}">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag-catatanIntraOprs" name="adddiagnosa" class="btn btn-secondary">
                                            <i class="fa fa-check-circle"></i> <span>Diagnosa</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="table tablecustom-responsive table-responsive">
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
                                    <div class="table tablecustom-responsive table-responsive">
                                        <h5><b>Pemakaian Drain</b></h5>
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
                                        <div class="position-relative" id="qr-instrument_signature-2-${data?.body_id}">
                                            <button type="button" id="formPeriOperasiSignBtn2" name="signperi" data-sign-ke="2" data-save="instrument_signature"
                                                data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
                                                <i class="fa fa-signature"></i> <span>Sign</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                    <div class="form-group">
                                        <label><strong>Tanda Tangan Sirkulasi</strong></label>
                                        <div class="position-relative" id="qr-sirkulasi_signature-3-${data?.body_id}">
                                            <button type="button" id="formPeriOperasiSignBtn3" name="signperi" data-sign-ke="3" data-save="sirkulasi_signature"
                                                data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
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
                                <div class="row mb-4 pt-4">
                                    <div class="table tablecustom-responsive table-responsive">
                                        <h4><b>DIAGNOSA</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" >Validate</th>
                                                <th class="text-center" >Kategori Diagnosis</th>
                                                
                                            </thead>
                                            <tbody id="bodyDiagKepCatatanPascaOprs-${data?.document_id?? pasienOperasiSelected?.vactination_id}">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag-catatanPascaOprs" name="adddiagnosa" class="btn btn-secondary">
                                            <i class="fa fa-check-circle"></i> <span>Diagnosa</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="table tablecustom-responsive table-responsive">
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
                                <div class="position-relative" id="qr-rr_signature-4-${data?.body_id}">
                                    <button type="button" id="formPeriOperasiSignBtn4" name="signperi" data-sign-ke="4" data-save="rr_signature"
                                        data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
                                        <i class="fa fa-signature"></i> <span>Sign</span>
                                    </button>
                                </div>
                            </div>
                        </div>
            `;

            $('#weight-catatanKeperawatan').val(props?.exam_info?.weight ?? 0);
            $('#height-catatanKeperawatan').val(props?.exam_info?.height ?? 0);

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


            $('#bodyAldreteoprs023').empty();


            if (data?.assessment_anesthesia_recovery?.aldrete) {
                data?.assessment_anesthesia_recovery?.aldrete.forEach((item, index) => {
                    AddRowAldrete005({
                        item: item,
                        index: index,
                        container: 'bodyAldreteoprs023'
                    });
                    $("#addAldrete").hide()

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


            $('#addInstrumen').off().on("click", function() {
                addRowInstrumen();
                updateAddButtonVisibility();

            });

            $('#addInstrumen1').off().on("click", function() {
                addRowInstrumen();
                updateAddButtonVisibility();
            });

            $("#formdiag-catatanPraOprs").on("click", function(e) {
                addRowDiagPerawat('bodyDiagKepCatatanPraOprs-', data?.document_id ??
                    pasienOperasiSelected
                    ?.vactination_id, null, null, "13");
            });
            $("#formdiag-catatanIntraOprs").on("click", function(e) {
                addRowDiagPerawat('bodyDiagKepCatatanIntraOprs-', data?.document_id ??
                    pasienOperasiSelected
                    ?.vactination_id, null, null, "15");
            });

            $("#formdiag-catatanPascaOprs").on("click", function(e) {
                addRowDiagPerawat('bodyDiagKepCatatanPascaOprs-', data?.document_id ??
                    pasienOperasiSelected
                    ?.vactination_id, null, null, "14");
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
                const signFiled = $(this).data('save');
                if (!$(this).is(':disabled')) {
                    addSignUserOPS("form-catatan-keperawatan", "catatan-keperawatan",
                        'body_id-catatan_operasi',
                        buttonId,
                        8, signKe, 1,
                        "Catatan Keperawatan Peri Operasi", signFiled);
                }
            });


            const {
                petugas_ibs_signature,
                instrument_signature,
                sirkulasi_signature,
                rr_signature,
                body_id
            } = props?.data || {};

            let targetId = "";
            let qrText = "";

            if (petugas_ibs_signature) {
                targetId = `qr-petugas_ibs_signature-1-${body_id}`;
                qrText = petugas_ibs_signature;
            } else if (instrument_signature) {
                targetId = `qr-instrument_signature-2-${body_id}`;
                qrText = instrument_signature;
            } else if (sirkulasi_signature) {
                targetId = `qr-sirkulasi_signature-3-${body_id}`;
                qrText = sirkulasi_signature;
            } else if (rr_signature) {
                targetId = `qr-rr_signature-4-${body_id}`;
                qrText = rr_signature;
            }


            if (targetId) {
                $(`#${targetId}`).empty();
                new QRCode(document.getElementById(targetId), {
                    text: qrText,
                    width: 70,
                    height: 70,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H // High error correction
                });
            }

            // if (data?.body_id) {
            //     checkSignSignature1(formId, primaryKey, formSaveBtn, '8');
            // }

        };



        const addBromage = (props) => {
            let bromageCount = $('#' + props.container + ' .bromage-item').length;

            let newId = `${props.bodyId}`;

            $('#' + props.container).html(
                `<div class="col-md-12 bromage-item">
                        <div id="${newId}" class="row">
                        </div>
                        <h3 class="badge text-bg-secondary">Skor Bromage : <span class="span-SkorBromage${newId}">${props?.data?.value_score ?? 0}</span></h3>
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

            $(`#${newId}`).off().on("change", e => {
                let dataScore = $(`#${newId}`).find("option:selected").data("score");

                $(`.span-SkorBromage${newId}`).text(dataScore)
            })
        };

        const addSteward = (props) => {


            let filteredaValue = avalue.filter(item => item.p_type === 'OPRS025');

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

                let status = totalScore >= 5 ? 'Pindah Ruangan / Pulang' : 'Tidak Pindah';
                row.find('.steward-discharge-status-input').text(status);
            };

            let observationDate = props?.item?.observation_date ? moment(props?.item
                    ?.observation_date) :
                moment(
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
            <td class="steward-total-score" width="1%">
                <h3><span class="badge text-bg-secondary steward-total-score-input">0</span></h3>
            </td>
            <td class="steward-discharge-status" style="width:100px;">
                <span class="steward-discharge-status-input"></span>
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

            $(`#${props?.container}`).on('change', 'select[name="steward-time-interval[]"]',
                function() {
                    let row = $(this).closest('tr');
                    let selectedMinutes = parseInt($(this).val(), 10) || 0;
                    let previousDatetime = row.prev().find('.steward-datetime-input').val();
                    if (previousDatetime) {
                        let newDatetime = moment(previousDatetime).add(selectedMinutes, 'minutes')
                            .format(
                                'YYYY-MM-DDTHH:mm');
                        row.find('.steward-datetime-input').val(newDatetime);
                        row.find('.steward-datetime-display').text(formatTimeOnly(newDatetime));
                        updateRowScoreAndStatus(row);
                    }
                });

            if (props.index > 0) {
                let previousDatetime = $(`#${props?.container} tr`).eq(props.index - 1).find(
                    '.steward-datetime-input').val();
                let defaultDatetime = moment(previousDatetime).add(5, 'minutes').format(
                    'YYYY-MM-DDTHH:mm');
                $(`#${props?.container} tr`).eq(props.index).find('.steward-datetime-input').val(
                    defaultDatetime);
                $(`#${props?.container} tr`).eq(props.index).find('.steward-datetime-display').text(
                    formatTimeOnly(
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


            $("#body_id_checklist_keselamatan").val(data?.body_id ?? get_bodyid())

            let catatanSignIn = `
                    <div class="container">
                        <div class="row">
                            <div id="the-sign-in-1" class="row"></div>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                    <div class="form-group">
                                        <label><strong>Tanda Tangan Dokter Anestesi</strong></label>
                                        <div class="position-relative" id="qr-signin_anesthesia_signature-1-${data?.body_id}">
                                            <button type="button" id="formCkOpsSignBtn1" name="CkOps" data-sign-ke="1" data-save="signin_anesthesia_signature"
                                                data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
                                                <i class="fa fa-signature"></i> <span>Sign</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                    <div class="form-group">
                                        <label><strong>Tanda Tangan Perawat</strong></label>
                                        <div class="position-relative" id="qr-signin_nurse_signature-2-${data?.body_id}">
                                            <button type="button" id="formCkOpsSignBtn2" name="CkOps" data-sign-ke="2" data-save="signin_nurse_signature"
                                                data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
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
                                    <div class="position-relative" id="qr-timeout_surgeon_signature-3-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn3" name="CkOps" data-sign-ke="3" data-save="timeout_surgeon_signature"
                                            data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
                                            <i class="fa fa-signature"></i> <span>Sign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                <div class="form-group">
                                    <label><strong>Tanda Tangan Dokter Anestesi</strong></label>
                                    <div class="position-relative" id="qr-timeout_anesthesia_signature-4-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn4" name="CkOps" data-sign-ke="4" data-save="timeout_anesthesia_signature"
                                            data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
                                            <i class="fa fa-signature"></i> <span>Sign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                <div class="form-group">
                                    <label><strong>Tanda Tangan Perawat</strong></label>
                                    <div class="position-relative" id="qr-timeout_nurse_signature-5-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn5" name="CkOps" data-sign-ke="5" data-save="timeout_nurse_signature"
                                            data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
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
                                    <div class="position-relative" id="qr-signout_surgeon_signature-6-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn6" name="CkOps" data-sign-ke="6" data-save="signout_surgeon_signature"
                                            data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
                                            <i class="fa fa-signature"></i> <span>Sign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                <div class="form-group">
                                    <label><strong>Tanda Tangan Dokter Anestesi</strong></label>
                                    <div class="position-relative" id="qr-signout_anesthesia_signature-7-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn7" name="CkOps" data-sign-ke="7" data-save="signout_anesthesia_signature"
                                            data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
                                            <i class="fa fa-signature"></i> <span>Sign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2 ps-3 pb-2">
                                <div class="form-group">
                                    <label><strong>Tanda Tangan Perawat</strong></label>
                                    <div class="position-relative" id="qr-signout_nurse_signature-8-${data?.body_id}">
                                        <button type="button" id="formCkOpsSignBtn8" name="CkOps" data-sign-ke="8" data-save="signout_nurse_signature"
                                            data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
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
                const signFiled = $(this).data('save');

                if (!$(this).is(':disabled')) {
                    addSignUserOPS("form-checklist-keselamatan", "checklist-keselamatan",
                        'body_id_checklist_keselamatan',
                        buttonId,
                        9, signKe, 1,
                        "Checklist Keselamatan Operasi", signFiled);
                }
            });

            const {
                signin_anesthesia_signature,
                signin_nurse_signature,
                timeout_surgeon_signature,
                timeout_anesthesia_signature,
                timeout_nurse_signature,
                signout_surgeon_signature,
                signout_anesthesia_signature,
                signout_nurse_signature,
                body_id
            } = props?.data || {};

            let targetId = "";
            let qrText = "";

            if (signin_anesthesia_signature) {
                targetId = `qr-signin_anesthesia_signature-1-${body_id}`;
                qrText = signin_anesthesia_signature;
            } else if (signin_nurse_signature) {
                targetId = `qr-signin_nurse_signature-2-${body_id}`;
                qrText = signin_nurse_signature;
            } else if (timeout_surgeon_signature) {
                targetId = `qr-timeout_surgeon_signature-3-${body_id}`;
                qrText = timeout_surgeon_signature;
            } else if (timeout_anesthesia_signature) {
                targetId = `qr-timeout_anesthesia_signature-4-${body_id}`;
                qrText = timeout_anesthesia_signature;
            } else if (timeout_nurse_signature) {
                targetId = `qr-timeout_nurse_signature-5-${body_id}`;
                qrText = timeout_nurse_signature;
            } else if (signout_surgeon_signature) {
                targetId = `qr-signout_surgeon_signature-6-${body_id}`;
                qrText = signout_surgeon_signature;
            } else if (signout_anesthesia_signature) {
                targetId = `qr-signout_anesthesia_signature-7-${body_id}`;
                qrText = signout_anesthesia_signature;
            } else if (signout_nurse_signature) {
                targetId = `qr-signout_nurse_signature-8-${body_id}`;
                qrText = signout_nurse_signature;
            }


            if (targetId) {
                $(`#${targetId}`).empty();
                new QRCode(document.getElementById(targetId), {
                    text: qrText,
                    width: 70,
                    height: 70,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H // High error correction
                });
            }
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



            let filedsData = ['anesthesia_machine_on', 'oxygen_tube', 'flow_meter', 'power_on',
                'circuit_leackage',
                'volatil', 'face_mask', 'laringoskop', 'ett_lma', 'stylet',
                'spuit_cuff', 'ekg_cable', 'nibp_connection', 'stetoscope', 'suction_tube',
                'bandage',
                'nasal_cannula', 'intravenous_line', 'spuit_size', 'epinefrin', 'atropin',
                'sedative',
                'opioid',
                'muscle_relaxant', 'intravena_fluid', 'other_fluid'
            ]

            let catatan = `
                    <div class="container">
                        <div class="row">
                              <div class="row pl-sm-0 col-6">
                                    <div class="form-check mb-0 pt-4">
                                        <input type="checkbox" class="form-check-input" id="checklistanestesi1All" name="chelist-allanestesi" value="1" >
                                        <label class="form-check-label" for="checklistanestesi1All">Checklist Semua</label>
                                    </div>
                                </div>
                            <div id="checklist-anestesi-1" class="row"></div>

                        </div>
                    </div>
                    `;

            $('#ck-anestesi').html(catatan);

            if (data?.assessment_anesthesia_checklist) {
                const allChecked = filedsData.every(field => data.assessment_anesthesia_checklist[
                    field] == 1);

                $("#checklistanestesi1All").prop("checked", allChecked);
            }


            $(document).on("change", "#checklistanestesi1All", function() {
                let isChecked = $(this).is(":checked");
                $("#checklist-anestesi-1 input[type='checkbox']").prop("checked", isChecked);
            });

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
                                    <div class="table tablecustom-responsive table-responsive">
                                        <h4><b>DIAGNOSA PRA BEDAH</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 10%"></th>

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
                                    <div class="table tablecustom-responsive table-responsive">
                                        <h4><b>DIAGNOSA PASCA BEDAH</b></h4>
                                        <hr>
                                        <table id="tablediagnosapascabedah" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 10%"></th>

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

                let treatment = treatmentData.find(t => t.bill_id === currentValueoprs008_06);

                let treatmentName = treatment ? treatment.tarif_name : "-";
                let labelHtml = `<label id="oprs008_06_label" class="form-control form-thems">
                                ${data.tarif_id}
                            </label>
                        `;

                $('#oprs008_06').replaceWith(labelHtml);


            }, 20);

            $("#formdiag2").on("click", function(e) {
                addRowDiagDokterOprs('bodyDiagPraOperation-', pasienOperasiSelected
                    ?.vactination_id,
                    null,
                    null,
                    13, 0);
            });
            if (diagnosas) {
                diagnosas.forEach((item, index) => {

                    if (item.diag_cat == 13) {
                        addRowDiagDokterOprs('bodyDiagPraOperation-', pasienOperasiSelected
                            ?.vactination_id,
                            item?.diagnosa_id, item?.diagnosa_name ?? item?.diagnosa_desc,
                            item
                            ?.diag_cat, item?.diag_suffer);
                    } else {
                        addRowDiagDokterOprs('bodyDiagPascaOperation-', pasienOperasiSelected
                            ?.vactination_id,
                            item?.diagnosa_id, item?.diagnosa_name ?? item?.diagnosa_desc,
                            item
                            ?.diag_cat, item?.diag_suffer);
                    }
                });
            }
            $("#formdiag").on("click", function(e) {
                addRowDiagDokterOprs('bodyDiagPascaOperation-', pasienOperasiSelected
                    ?.vactination_id,
                    null,
                    null, 14, 0);
            });

            btnSaveLaporanPembedahan(pasienOperasiSelected)
        }

        // -------------------GGGGGGGGG
        const LaporanAnesthesi = (props) => {
            let data = props?.data
            let diagnosas = props?.diagnosas
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

                                </div>
                                <div id="informasiMedis-laporan-2" class="row pb-3"></div>

                                <div class="row mb-4 pt-4">
                                    <div class="table tablecustom-responsive table-responsive">
                                        <h4><b>DIAGNOSA NEW</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 10%"></th>
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
                    `;
            $('#weight-laporanAnesthesi').val(props?.exam_info?.weight ?? 0);
            $('#height-laporanAnesthesi').val(props?.exam_info?.height ?? 0);

            $('#informasiMedis-laporan').html(oprs006);
            $("#trans_id-laporan_anestesi").val(data?.trans_id ?? visit?.trans_id);
            $("#org_unit_code-laporan_anestesi").val(data?.org_unit_code ?? visit?.org_unit_code);
            $("#visit_id-laporan_anestesi").val(data?.visit_id ?? visit?.visit_id);
            $("#formdiag-laporan").on("click", function(e) {
                addRowDiagDokterOprs('bodyDiagLaporanAnesthesi-', pasienOperasiSelected
                    ?.vactination_id,
                    null,
                    null, 14, 0);
            });
            getAvalueType({
                p_type: 'OPRS006',
                content_id: 'informasiMedis-laporan-1',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: data,
                data_tindakan: props?.ori
            });

            getAvalueType({
                p_type: 'OPRS034',
                content_id: 'informasiMedis-laporan-2',
                body_id: pasienOperasiSelected?.vactination_id,
                get_data: props?.assessment_anesthesia_recovery?.organ,
                data_tindakan: props?.ori

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

            getDataVitailSign({
                pasien_diagnosa_id: props?.ori
                    ?.vactination_id,
                account_ids: ['11'],
                suffixes: ["-laporanAnesthesi"]
            });

            if (diagnosas) {
                diagnosas.forEach((item, index) => {

                    addRowDiagDokterOprs('bodyDiagLaporanAnesthesi-', props?.ori
                        ?.vactination_id,
                        item?.diagnosa_id, item?.diagnosa_name ?? item?.diagnosa_desc, item
                        ?.diag_cat, item?.suffer_type);
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
            postData({
                body_id: `${props?.data?.vactination_id}`,
            }, 'admin/PatientOperationRequest/getDataAssessmentPostOperasi', (res) => {
                getAvalueType({
                    p_type: 'OPRS009',
                    content_id: 'informasi-post-operasi-1',
                    body_id: props?.data?.vactination_id,
                    get_data: res[0],
                    items: props?.obat?.treatment
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
            let data = props?.data
            let anesthesia_recovery = data?.assessment_anesthesia_recovery

            let aldreteScore = anesthesia_recovery?.aldrete[anesthesia_recovery?.aldrete?.length - 1] ??
                0
            let bromageScore = anesthesia_recovery?.bromage[anesthesia_recovery?.bromage?.length - 1] ??
                0
            let stewardScore = anesthesia_recovery?.steward[anesthesia_recovery?.steward?.length - 1] ??
                0

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
                            <div id="obatInhalasi-1" class="table tablecustom-responsive table-responsive">
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
                            <div id="obatInjeksi-1" class="table tablecustom-responsive table-responsive">
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
                            <div id="cairanMasuk-1" class="table tablecustom-responsive table-responsive">
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
                                    <div class="table tablecustom-responsive table-responsive">
                                        <h4><b>DIAGNOSA NEW</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 10%"></th>

                                                <th class="text-center" style="width: 40%">Diagnosa</th>
                                                <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                <th class="text-center" style="width: 20%">Kategori Diagnosis</th>
                                            </thead>
                                            <tbody id="bodyDiagLaporanAnesthesiLengkap-${pasienOperasiSelected?.vactination_id}">
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
                            <div id="cairanMasuk-1" class="table tablecustom-responsive table-responsive">
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
                            <div id="monitoringDurante-1" class="table tablecustom-responsive table-responsive">
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
                                <div id="cairanMasuk-1" class="table tablecustom-responsive table-responsive">
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
                                <div id="RecoveryRoom-1" class="table tablecustom-responsive table-responsive">
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
                                    <div class="table tablecustom-responsive table-responsive">
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
                                                <input type="text" id="anesthesiaStart" name="start_anesthesia" class="form-control datetimeflatpickr-oprs-anes">
                                            </div>
                                            <div class="mb-3">
                                                <label for="anesthesiaEnd" class="form-label"><strong>Anesthesia End Time:</strong></label>
                                                <input type="text" id="anesthesiaEnd" name="end_anesthesia" class="form-control datetimeflatpickr-oprs-anes">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="surgeryStart" class="form-label"><strong>Surgery Start Time:</strong></label>
                                                <input type="text" id="surgeryStart" name="surgeryStart" class="form-control datetimeflatpickr-oprs-anes">
                                            </div>
                                            <div class="mb-3">
                                                <label for="surgeryEnd" class="form-label"><strong>Surgery End Time:</strong></label>
                                                <input type="text" id="surgeryEnd" name="surgeryEnd" class="form-control datetimeflatpickr-oprs-anes">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="infus-monitoring-duranate">
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
                                                <label for="bleeding_amount_val" class="form-label"><strong>Bleeding Amount:</strong></label>
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
                            <div id="medication-1" class="table tablecustom-responsive table-responsive">
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
                                <div class="position-relative" id="qr-signin_surgeon_signature-1-${data?.assessment_anesthesia?.body_id}">
                                    <button type="button" id="formALengkapSignBtn1" name="signAlengkap" data-sign-ke="1" data-save="signin_surgeon_signature"
                                        data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
                                        <i class="fa fa-signature"></i> <span>Sign</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2 ps-3 pb-2">
                            <div class="form-group">
                                <label><strong>Tanda Tangan Dokter</strong></label>
                                <div class="position-relative" id="qr-signin_anesthesia_signature-2-${data?.assessment_anesthesia?.body_id}">
                                    <button type="button" id="formALengkapSignBtn2" name="signAlengkap" data-sign-ke="2" data-save="signin_anesthesia_signature"
                                        data-button-id="btn-show-assesment-requestOperation${pasienOperasiSelected?.vactination_id}" class="btn btn-warning">
                                        <i class="fa fa-signature"></i> <span>Sign</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;

            $('#weight-laporanAnesthesi-lengkap-durantee').val(props?.exam_info?.weight ?? 0)
            $('#height-laporanAnesthesi-lengkap-durantee').val(props?.exam_info?.height ?? 0)

            $('#weight-laporanAnesthesi-lengkap').val(props?.exam_info?.weight ?? 0)
            $('#height-laporanAnesthesi-lengkap').val(props?.exam_info?.height ?? 0)

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
            // $('#infus-monitoring-duranate').html(recoveryRoomOprs029Oprs033);

            $('#informasiMedis-laporan-intruksi-pasca-anesthesi').html(oprs013)
            $('#informasiMedis-laporan-recovery-room-monitoring-score-2').html(oprs014)

            $("#formdiag-lengkap").on("click", function(e) {
                addRowDiagDokterOprs('bodyDiagLaporanAnesthesiLengkap-', pasienOperasiSelected
                    ?.vactination_id,
                    null, null, 14, 0);
            });

            $("#bleeding_amount_val").val(data?.assessment_anesthesia?.bleeding_amount ?? 0)
            $("#urine_amount_val").val(data?.assessment_anesthesia?.urine_amount ?? 0)

            if (data?.assessment_anesthesia?.start_anesthesia) {
                $("#anesthesiaStart").val(moment(data?.assessment_anesthesia.start_anesthesia).format(
                    'DD/MM/YYYY HH:mm'));

            }
            if (data?.assessment_anesthesia?.end_anesthesia) {
                $("#anesthesiaEnd").val(moment(data?.assessment_anesthesia.end_anesthesia).format(
                    'DD/MM/YYYY HH:mm'));
            }
            let startOperation = pasienOperasiSelected?.start_operation;
            let endOperation = pasienOperasiSelected?.end_operation;

            let formatDate = (date, format = 'DD/MM/YYYY HH:mm') => date ? moment(date).format(format) :
                '';

            let validEndOperation = endOperation && moment(endOperation).isSameOrAfter(startOperation);

            $("#surgeryStart").val(formatDate(startOperation));
            $("#surgeryEnd").val(validEndOperation ?
                formatDate(endOperation) :
                formatDate(moment()));

            $("#body_id-laporan_anestesiLengkap").val(data?.assessment_anesthesia?.body_id ??
                get_bodyid());
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



            $('#bodyAldreteoprs023-1').empty();


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

            $("#body_id-laporanAnesthesi-lengkap").val(primaryKey ?? get_bodyid())
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
                const signFiled = $(this).data('save');
                if (!$(this).is(':disabled')) {
                    addSignUserOPS("form-laporanAnesthesi-lengkap", "anesthesi-lengkap",
                        'body_id-laporanAnesthesi-lengkap',
                        buttonId, 10, signKe, 1, "Laporan Anesthesi Lengkap", signFiled);
                }
            });

            const {
                signin_surgeon_signature,
                signin_anesthesia_signature,

                body_id
            } = props?.data || {};

            let targetId = "";
            let qrText = "";

            if (signin_surgeon_signature) {
                targetId = `qr-signin_surgeon_signature-1-${body_id}`;
                qrText = signin_surgeon_signature;
            } else if (signin_anesthesia_signature) {
                targetId = `qr-signin_anesthesia_signature-2-${body_id}`;
                qrText = signin_anesthesia_signature;
            }


            if (targetId) {
                $(`#${targetId}`).empty();
                new QRCode(document.getElementById(targetId), {
                    text: qrText,
                    width: 70,
                    height: 70,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H // High error correction
                });
            }

            $(document).on("change", "#oprs031_01", function() {
                if ($(this).is(":checked")) {
                    $("input[type='radio'][name='oprs032_03']")
                        .prop("checked", false)
                        .off("change");
                }
            });

            $(document).on("change", "input[type='radio'][name='oprs032_03']", function() {
                $("#oprs031_01").prop("checked", false); // Hanya ubah tanpa trigger change
            });



            // if (data?.assessment_anesthesia?.body_id) {
            //     checkSignSignature1(formId, primaryKey, formSaveBtn, '10');
            // }
            initializeFlatpickrOperasi()
            btnSaveLaporanAnestesiLengkap(pasienOperasiSelected)
        }

        const escapeHtmlOperasi = (unsafe) => {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;");
        };


        const getType = (props) => {

            return new Promise((resolve) => {
                let htmlContent = '';
                let initializeQuill = false;
                let isAnastesi = props?.p_type == 'OPRS007'; //new

                const validTypesRecoveryRoom = ['OPRS029', 'OPRS030', 'OPRS031', 'OPRS032',
                    'OPRS033', "OPRS034"
                ];

                if ([3, 4, 7].includes(parseInt(props?.code))) {
                    let matchedData = avalue?.filter(item => item?.parameter_id === props
                        ?.parameter_id &&
                        item?.p_type === props?.p_type);
                    let valueProp = props?.p_type === "" ? 'value_score' : 'value_id';

                    switch (parseInt(props?.code)) {
                        case 3:
                            let selectOptions = '';
                            if (props?.p_type == 'OPRS024') {
                                selectOptions = matchedData?.map(item =>
                                    `<option value="${item[valueProp]}"  data-type="${item?.p_type}" data-score="${item?.value_score}" data-desc="${item?.value_desc}" 
                                data-parameter="${item?.parameter_id}" ${props?.get_data?.value_id === item[valueProp] ? 'selected' : ''}>${item?.value_desc}</option>`
                                ).join('');
                            } else if (props?.p_type == 'GEN0022' || props?.p_type ==
                                'GEN0021') {

                                selectOptions = matchedData?.map(item =>
                                    `<option value="${item['value_score']}" ${(props?.get_data?.[props?.column_name?.toLowerCase()] ?? "") === item[valueProp] ? 'selected' : ''}>${item?.value_desc}</option>`
                                ).join('');
                            } else if (props?.p_type && validTypesRecoveryRoom?.includes(props
                                    .p_type)) {
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
                            } else if (props?.p_type && validTypesRecoveryRoom?.includes(props
                                    .p_type)) {
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
                            initializeQuill = true;
                            if (props?.p_type && validTypesRecoveryRoom?.includes(props
                                    .p_type)) {


                                htmlContent = `
                                    <div class="form-group pb-5 pt-4" style="padding-bottom: 4rem !important;">
                                    <label class="fw-bold" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                    <input type="hidden" id="quill_oprsInp${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" 
                                    data-score="${props?.value_score}" data-desc="${props?.parameter_desc}" value="${escapeHtmlOperasi(props?.get_data?.[props?.column_name?.toLowerCase()] ?? '')}" >
                                    <div id="quill_${props?.p_type?.toLowerCase()}_${props?.parameter_id}" class="quill-editor-oprs" 
                                    data-id="quill_oprsInp${props?.p_type?.toLowerCase()}_${props?.parameter_id}"
                                    name='${props?.p_type?.toLowerCase()}_${props?.parameter_id}'>${(props?.get_data?.['value_id_'+props?.parameter_id]) ?? ''}</div>
                                    </div>
                                    `;
                            } else {
                                initializeQuill = true;

                                if (props.p_type != 'OPRS008') {
                                    let resultValueInput = `${props?.get_data?.[props?.column_name?.toLowerCase()] 
                                                                ? (props?.get_data?.[props?.column_name?.toLowerCase()]) 
                                                                : ''}`



                                    htmlContent = `
                                        <div class="form-group pb-5 pt-4">
                                            <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                            <input type="hidden" id="quill_oprsInp${props?.column_name?.toLowerCase()}" name="${props?.column_name?.toLowerCase()}" 
                                            value="${escapeHtmlOperasi(props?.get_data?.[props?.column_name?.toLowerCase()] ?? '')}"
                                            >
                                            <div id="quill_${props?.column_name?.toLowerCase()}_${props?.parameter_id}_${props?.p_type}"  data-id="quill_oprsInp${props?.column_name?.toLowerCase()}"
                                                    class="quill-editor-oprs" 
                                                    name="${props?.column_name?.toLowerCase()}">
                                                    ${props?.get_data?.[props?.column_name?.toLowerCase()] ?? ''}
                                                </div>
                                        </div>
                                    `;

                                } else {
                                    initializeQuill = true;

                                    if (props?.column_name != 'OPERATION_DESC') {

                                        htmlContent = `
                                                        <div class="form-group pb-5 pt-4">
                                                            <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                                            <input type="hidden" name="${props?.column_name?.toLowerCase()}" id="quill_oprsInp${props?.column_name?.toLowerCase()}" 
                                                            value="${escapeHtmlOperasi(props?.get_data?.[props?.column_name?.toLowerCase()] ?? '')}">
                                                            <div id="quill_${props?.column_name?.toLowerCase()}_${props?.parameter_id}" class="quill-editor-oprs" name="${props?.column_name?.toLowerCase()}" data-id="quill_oprsInp${props?.column_name?.toLowerCase()}">
                                                                ${props?.get_data?.[props?.column_name?.toLowerCase()] ?? ''}
                                                            </div>
                                                        </div>
                                                    `;
                                    } else {

                                        initializeQuill = true;
                                        htmlContent = `
                                                        <div class="form-group pb-5 pt-4">
                                                            <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_oprs008">${props?.parameter_desc}</label>
                                                            <input type="hidden" name="${props?.column_name?.toLowerCase()}_oprs008"  id="quill_oprsInp${props?.column_name?.toLowerCase()}_oprs008"
                                                            value="${escapeHtmlOperasi(props?.get_data?.[props?.column_name?.toLowerCase()] ?? '')}">
                                                            <div id="quill_${props?.column_name?.toLowerCase()}_oprs008" class="quill-editor-oprs" name="${props?.column_name?.toLowerCase()}" data-id="quill_oprsInp${props?.column_name?.toLowerCase()}_oprs008">
                                                                ${(props?.get_data?.[props?.column_name?.toLowerCase()]) ?? ''}
                                                            </div>
                                                        </div>
                                                    `;
                                    }

                                }

                            }
                            break;

                        case 7:
                            if (props?.p_type && validTypesRecoveryRoom?.includes(props
                                    .p_type)) {
                                let radioOptions = matchedData.map((item, index) => `
                                    <div class="form-check mb-0 pt-4">
                                        <input class="form-check-input" type="radio" name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item[valueProp]}" data-score="${item?.value_score}" data-desc="${item?.value_desc}" value="${item[valueProp]}" ${props?.get_data?.['value_desc_'+ props?.parameter_id] === item.value_desc ? 'checked' : (index === 0 && !props?.get_data?.['value_desc_' + props?.parameter_id] ? 'checked' : '')}>
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
                                let radioOptions = '';
                                if (props?.column_name?.toLowerCase() == 'terlayani') {

                                    const selectedValue = props?.get_data?.[props?.column_name
                                        ?.toLowerCase()
                                    ];
                                    let isChecked =
                                        false;

                                    radioOptions = matchedData.map((item) => {
                                        let checked = "";

                                        if (selectedValue === item.value_score && !
                                            isChecked) {
                                            checked = 'checked';
                                            isChecked =
                                                true;
                                        }

                                        return `
                                        <div class="form-check mb-0 pt-4">
                                            <input class="form-check-input" type="radio" name="${props?.column_name?.toLowerCase()}" 
                                                id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item.value_id}" 
                                                value="${item.value_score}" 
                                                ${checked}>
                                            <label class="form-check-label" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item.value_id}">${item.value_desc}</label>
                                        </div>
                                    `;
                                    }).join('');

                                } else {
                                    radioOptions = matchedData.map((item, index) => `
                                        <div class="form-check mb-0 pt-4">
                                            <input class="form-check-input" type="radio" name="${props?.column_name?.toLowerCase()}" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item[valueProp]}" value="${item[valueProp]}" 
                                            ${props?.get_data?.[props?.column_name?.toLowerCase()] === item[valueProp] 
                                                ? 'checked' 
                                                : (index === matchedData.length - 1 && !props?.get_data?.[props?.column_name?.toLowerCase()] ? '' : '')}>
                                            <label class="form-check-label" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}_${item[valueProp]}">${item.value_desc}</label>
                                        </div>
                                    `).join('');
                                }

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
                    let matchedData = avalue?.filter(item => item?.parameter_id === props
                        ?.parameter_id &&
                        item.p_type === props?.p_type);
                    let valueProp = props?.p_type === "" ? 'value_score' : 'value_id';
                    //new
                    switch (parseInt(props?.code)) {

                        case 2:
                            if (props?.p_type && validTypesRecoveryRoom?.includes(props
                                    .p_type)) {
                                htmlContent = `
                                <div class="form-check mb-0 pt-4">
                                    <input type="hidden" name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" value="">
                                    <input type="checkbox" class="form-check-input" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}"  
                                    data-score="${props?.value_score ?? ''}" data-desc="${props?.parameter_desc}" 
                                    name="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" 
                                    value="1" ${props?.get_data?.['value_id_'+props?.parameter_id] ?? "" === '1' ? 'checked' : ''}>
                                    <label class="form-check-label" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                                </div>
                                `;

                                if (props?.p_type === "OPRS031" && props?.parameter_id ===
                                    "01") {
                                    const value = props?.get_data?.['value_id_' + props
                                        ?.parameter_id
                                    ];

                                    if (value === 1 || value === "1") {
                                        setTimeout(() => {
                                            $("input[type='radio'][name='oprs032_03']")
                                                .prop(
                                                    "checked", false);
                                        }, 300);
                                    }
                                }

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
                                        ?.toLowerCase()]).format(
                                        "DD/MM/YYYY HH:mm")
                                }
                            }
                            // oprs004_05


                            htmlContent = `
                        <div class="form-group mb-0 pt-4">
                            <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                            <input class="form-control datetime-input" type="hidden" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.column_name?.toLowerCase()}" value="${ isAnastesi ? data_start_operation : props?.get_data?.[props?.column_name?.toLowerCase()] ?  moment(new Date(props?.get_data?.[props?.column_name?.toLowerCase()])).format("DD/MM/YYYY HH:mm") : ''}" ${isAnastesi ? 'disabled' : ''}>
                            <input class="form-control datetime-input datetimeflatpickr-oprs" type="text" id="flat${props?.p_type?.toLowerCase()}_${props?.parameter_id}" value="${ isAnastesi ? data_start_operation : props?.get_data?.[props?.column_name?.toLowerCase()] ? moment(new Date(props?.get_data?.[props?.column_name?.toLowerCase()])).format("DD/MM/YYYY HH:mm") : ''}" ${isAnastesi ? 'disabled' : ''}>
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
                            if (props?.p_type && validTypesRecoveryRoom?.includes(props
                                    .p_type)) {
                                const paramId =
                                    `${props?.p_type?.toLowerCase()}_${props?.parameter_id}`;
                                const isOPRS031 = props?.p_type === "OPRS031";
                                const isOPRS033 = props?.p_type === "OPRS033";
                                const isOPRS034 = props?.p_type === "OPRS034";
                                const paramDesc = props?.parameter_desc;

                                if (isOPRS033 && ["lcs", "lor", "barbotage"].includes(paramDesc
                                        ?.toLowerCase())) {
                                    const selectedValue = props?.get_data?.['value_desc_' +
                                        props
                                        ?.parameter_id
                                    ]

                                    htmlContent = `
                                            <div class="form-group mb-0 pt-4">
                                                <label for="${paramId}">${paramDesc}</label>
                                                <select class="form-select" id="${paramId}" name="${paramId}">
                                                    <option value="" ${selectedValue === "" ? "selected" : ""}>-- Pilih --</option>
                                                    <option value="+" ${selectedValue === "+" ? "selected" : ""}>+</option>
                                                    <option value="-" ${selectedValue === "-" ? "selected" : ""}>-</option>
                                                </select>
                                            </div>`;
                                } else if (isOPRS033) {
                                    htmlContent = `
                                            <div class="form-group mb-0 pt-4">
                                                <label class="fw-bold" for="${paramId}">${paramDesc}</label>
                                                <input type="text" class="form-control form-thems" id="${paramId}" 
                                                    data-score="${props?.value_score}" data-desc="${paramDesc}"
                                                    name="${paramId}" value="${props?.get_data['value_id_' + props?.parameter_id] ?? ''}">
                                            </div>`;
                                } else if (isOPRS034) {


                                    htmlContent = `
                                            <div class="form-group mb-0 pt-4">
                                                <label class="fw-bold" for="${paramId}">${paramDesc}</label>
                                                <input type="text" class="form-control form-thems" id="${paramId}" 
                                                    data-score="${props?.value_score}" data-desc="${paramDesc}"
                                                    name="${paramId}" value="${
                                                    props?.get_data?.['value_id_' + props?.parameter_id] == null || 
                                                    props?.get_data?.['value_id_' + props?.parameter_id] === undefined || 
                                                    props?.get_data?.['value_id_' + props?.parameter_id] === "" 
                                                    ? 'Dalam Batas Normal' 
                                                    : props?.get_data['value_id_' + props?.parameter_id] === " " 
                                                        ? "" 
                                                        : props?.get_data['value_id_' + props?.parameter_id]}">
                                            </div>`;
                                } else if (isOPRS031) {

                                    htmlContent = `
                                                <div class="form-group mb-0 pt-4">
                                                    <label class="fw-bold" for="${paramId}">${paramDesc}</label>
                                                    <input type="text" class="form-control form-thems" id="${paramId}" 
                                                        data-score="${props?.value_score}" data-desc="${paramDesc}"
                                                        name="${paramId}" value="${
                                                        props?.get_data?.['value_id_' + props?.parameter_id] == null || 
                                                        props?.get_data?.['value_id_' + props?.parameter_id] === undefined || 
                                                        props?.get_data?.['value_id_' + props?.parameter_id] === "" 
                                                        ? '' 
                                                        : props?.get_data['value_id_' + props?.parameter_id] === " " 
                                                            ? "" 
                                                            : props?.get_data['value_id_' + props?.parameter_id]}">
                                                </div>`;
                                } else {
                                    htmlContent = `
                                            <div class="form-group mb-0 pt-4">
                                                <label class="fw-bold" for="${paramId}">${paramDesc}</label>
                                                <input type="text" class="form-control form-thems" id="${paramId}"
                                                    data-score="${props?.value_score}" data-desc="${paramDesc}"
                                                    name="${paramId}" value="${
                                                                ['OPRS029', 'OPRS032'].includes(props?.p_type)
                                                                    ? (props?.get_data['value_id_' + props?.parameter_id] !== 'undefined'
                                                                        ? props?.get_data['value_id_' + props?.parameter_id]
                                                                        : '')
                                                                    : (props?.get_data['value_desc_' + props?.parameter_id] ?? '')
                                                                }">
                                            </div>`;
                                }
                            } else if (props?.p_type === "OPRS006" && props?.column_name
                                ?.toLowerCase() ===
                                'rooms_id') {
                                const columnName = props?.column_name?.toLowerCase();
                                htmlContent = `
                                        <div class="form-group mb-0 pt-4">
                                            <label class="fw-bold" for="${columnName}">${props?.parameter_desc}</label>
                                            <input type="${columnName === 'bleeding' ? 'number' : 'text'}" 
                                                class="form-control form-thems" id="${columnName}" name="${columnName}"
                                                value="${props?.data_tindakan[columnName] ?? props?.get_data?.[columnName] ?? ''}" disabled>
                                        </div>`;
                            } else if (props?.p_type === "OPRS009" && ["analgesik",
                                    "antiemetik",
                                    "antibiotik", "other_drugs"
                                ].includes(props?.column_name?.toLowerCase())) {
                                const columnName = props?.column_name?.toLowerCase();
                                const obatMap = {
                                    analgesik: ["J22", "J21"],
                                    antibiotik: ["J128", "J54"],
                                    antiemetik: ["J09"],
                                };
                                const dataFilterObat = obatMap[columnName] || [];

                                let resultObatOPRS009 = props?.items.filter(e => dataFilterObat
                                    .includes(e
                                        ?.code_5) && e.isalkes.trim() !== "1");
                                let initialValue = isAnastesi ? (props?.items[columnName] ??
                                    '') : (
                                    props
                                    ?.get_data?.[columnName] ?? '');

                                if (!initialValue && resultObatOPRS009.length > 0) {
                                    initialValue = resultObatOPRS009.map(item => item?.name)
                                        .join(', ');
                                }

                                htmlContent = `
                                        <div class="form-group mb-0 pt-4">
                                            <label class="fw-bold" for="${columnName}">${props?.parameter_desc}</label>
                                            <input type="${columnName === 'bleeding' ? 'number' : 'text'}" 
                                                class="form-control form-thems" id="${columnName}" name="${columnName}" value="${initialValue}" 
                                                ${isAnastesi ? 'disabled' : ''}>
                                        </div>`;
                            } else if (props?.p_type === "OPRS008" && props?.parameter_id ===
                                "03") {
                                const columnName = props?.column_name?.toLowerCase();
                                let labelsData = "";
                                let badgeClass = ""; // Default tanpa badge

                                if (props?.get_data?.[columnName] == 0) {
                                    labelsData = "Elektif";
                                } else if (props?.get_data?.[columnName] == 1) {
                                    labelsData = "Cyto";
                                    badgeClass = "badge bg-warning text-dark";
                                } else if (props?.get_data?.[columnName] == 2) {
                                    labelsData = "Emergency";
                                    badgeClass = "badge bg-danger";
                                }

                                htmlContent = `<div class="form-group mb-0 pt-4">
                                                <label class="fw-bold" for="${columnName}">${props?.parameter_desc}</label>
                                                <p class="fw-bold" for="${columnName}">
                                                    ${badgeClass ? `<span class="${badgeClass}">${labelsData}</span>` : labelsData}
                                                </p>
                                            </div>`;

                            } else if (props?.p_type === "OPRS006" && ["26", "27", "28", "29",
                                    "30",
                                    "31"
                                ]
                                .includes(props.parameter_id)) {
                                const columnName = props?.column_name?.toLowerCase();
                                const selectedValue = isAnastesi ? (props?.items[columnName] ??
                                    '') : (
                                    props
                                    ?.get_data?.[columnName] ?? '');


                                htmlContent = `
                                    <div class="form-group mb-0 pt-4">
                                        <label class="fw-bold">${props?.parameter_desc} <span class="text-muted"></span></label>
                                        <div>
                                            <input type="checkbox" class="form-check-input form-thems param-check"
                                                id="${columnName}_yes" name="${props?.column_name}" data-param="${props.parameter_id}" 
                                                value="yes" ${selectedValue === 'yes' ? 'checked' : ''} ${isAnastesi ? 'disabled' : ''}>
                                            <label for="${columnName}_yes" class="form-check-label">Pilih</label>
                                        </div>
                                    </div>`;

                                $(document).on('change', `.param-check`, function() {
                                    if ($(this).prop('checked')) {
                                        $('.param-check').not(this).prop('checked',
                                            false);
                                    }
                                });

                            } else {

                                const columnName = props?.column_name?.toLowerCase();

                                htmlContent = `
                                        <div class="form-group mb-0 pt-4">
                                            <label class="fw-bold" for="${columnName}">${props?.parameter_desc}</label>
                                            <input type="${columnName === 'bleeding' ? 'number' : 'text'}" class="form-control form-thems" 
                                                id="${columnName === 'type_of_anesthesia' ? `${props?.p_type?.toLowerCase()}_${props?.parameter_id}` :columnName}" name="${columnName?.trim() ? columnName : paramId}"
                                                value="${isAnastesi ? (props?.items[columnName] ?? '') : (props?.get_data?.[columnName] ?? '')}"
                                                ${isAnastesi ? 'disabled' : ''}>
                                        </div>`;
                            }

                            if (isAnastesi && props?.column_name?.toLowerCase() ===
                                'type_of_anesthesia' &&
                                props?.items?.type_of_anesthesia) {
                                getDataColumnName({
                                    table_name: 'ASSESSMENT_PARAMETER_VALUE',
                                    column_name: 'value_desc',
                                    column_id: 'value_id',
                                    id: props?.items.type_of_anesthesia,
                                    element_id: `${props?.p_type?.toLowerCase()}_${props?.parameter_id}`
                                });
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

        const initializeQuillEditors = () => {
            document.querySelectorAll('.quill-editor-oprs').forEach(editor => {

                const editorId = editor.id;
                if (!quillInstances[editorId]) {
                    const quill = new Quill(editor, {
                        theme: 'snow'
                    });
                    quillInstances[editorId] = quill;

                    const inputFieldId = editor.getAttribute('data-id');
                    const inputField = document.querySelector(`#${inputFieldId}`);
                    if (inputField) {
                        if (inputField.value) {
                            quill.root.innerHTML = inputField.value;
                        }
                        quill.on('text-change', () => {
                            inputField.value = quill.root.innerHTML;
                        });
                    }
                    // if (inputField) {

                    //     let initialContent = inputField.value || '';
                    //     quill.root.innerHTML = initialContent;
                    //     quill.on('text-change', () => {
                    //         const quillContent = quill.root.innerHTML.trim();
                    //         inputField.value = quillContent === '<p><br></p>' ? '' : quillContent;
                    //     });
                    // }
                }
            });



            const quillElementquillmodal = document.getElementById(
                'quill_diagnosa_desc-permintaan_operasi');
            if (quillElementquillmodal && !quillInstancesModal[
                    'quill_diagnosa_desc-permintaan_operasi']) {
                const quill = new Quill(quillElementquillmodal, {
                    theme: 'snow'
                });

                quillInstancesModal['quill_diagnosa_desc-permintaan_operasi'] = quill;

                const inputField = document.getElementById('diagnosa_desc-permintaan_operasi');

                if (inputField) {
                    let initialContent = inputField.value || '';
                    quill.root.innerHTML = initialContent;

                    quill.on('text-change', () => {
                        const quillContent = quill.root.innerHTML.trim();
                        inputField.value = quillContent === '<p><br></p>' ? '' : quillContent;
                    });
                }
            }

            const quillElementquillmodal1 = document.getElementById(
                'quill_advice_doctor-permintaan_operasi');
            if (quillElementquillmodal1 && !quillInstancesModal[
                    'quill_advice_doctor-permintaan_operasi']) {
                const quill = new Quill(quillElementquillmodal1, {
                    theme: 'snow'
                });

                quillInstancesModal['quill_advice_doctor-permintaan_operasi'] = quill;

                const inputField = document.getElementById('advice_doctor-permintaan_operasi');

                if (inputField) {
                    let initialContent = inputField.value || '';
                    quill.root.innerHTML = initialContent;

                    quill.on('text-change', () => {
                        const quillContent = quill.root.innerHTML.trim();
                        inputField.value = quillContent === '<p><br></p>' ? '' : quillContent;
                    });
                }
            }
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
                                            <select class="form-select task-dropdown select2-oprs select-2Dropdown" name="groupedTasks_option[]">
                                                ${generateTaskOptions(e.task_id)}
                                            </select>
                                        </td>
                                        <td rowspan="2" width="1%">
                                            <button type="button" class="btn btn-danger btn-sm delete-dropdown" style="height:80px;width:50px;"><i class="fas fa-trash-alt fa-2xl"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-select employee-dropdown select2-oprs select-2Dropdown" name="employee_option[]">
                                                ${generateEmployeeOptions(e.employee_id)}
                                            </select>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                        <div class="d-flex my-3">
                            <button type="button" class="btn btn-primary mx-auto add-dropdown" style="height:40px;"><i class="fas fa-plus fa-2xl"></i> Tenaga Pelaksana Operasi</button>
                        </div>
                    `;

            let contentFormEsekusi = `
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <select class="form-select btn-sm" name="terlayani" id="form-action-pelayanan">
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

            $("#dropdown-param-tindakan-operasi").html(content + droppdown + contentFormEsekusi +
                TransaksiContent);

            $('#dropdown-param-tindakan-operasi').on('click', '.delete-dropdown', function() {
                $(this).closest('tr').next().remove(); // Remove the next row
                $(this).closest('tr').remove(); // Remove the current row
            });

            $('#dropdown-param-tindakan-operasi').on('click', '.add-dropdown', function() {
                let selectedTasks = $('.task-dropdown').map(function() {
                    return $(this).val();
                }).get();

                if (selectedTasks?.includes('pilih') || selectedTasks?.includes(null)) {
                    return;
                }

                let newTaskOptions = Object.keys(groupedTasks).map(group => `
                            <optgroup label="${group}">
                                ${groupedTasks[group].filter(item => !selectedTasks?.includes(item.task_id)).map(item => `
                                    <option value="${item.task_id}">${item.task}</option>
                                `).join('')}
                            </optgroup>
                        `).join('');

                let newTaskOptionsEmployee = Object.keys(groupedEmployees).map(group => `
                            <optgroup label="${group}">
                                ${groupedEmployees[group].filter(item => !selectedTasks?.includes(item.employee_id)).map(item => `
                                    <option value="${item.employee_id}">${item.fullname}</option>
                                `).join('')}
                            </optgroup>
                        `).join('');

                if (!newTaskOptions.trim()) {
                    alert(
                        'Semua task sudah dipilih, tidak ada task baru yang dapat ditambahkan!'
                    );
                    return;
                }

                let dataDropdownContent = `
                            <tr class="bg-light">
                                <td>
                                    <select class="form-select task-dropdown select2-oprs" name="groupedTasks_option[]">
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
                                    <select class="form-select employee-dropdown select2-oprs" name="employee_option[]">
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
                let treatment = treatmentData.find(t => t.tarif_id === item?.bill_id);
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
                  
                        <button type="button" class="btn btn-sm btn-primary btn-show-edit-requestOperation spppoli-to-hide" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                          <i class="far fa-edit"></i> Ubah
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btn-show-delete-requestOperation spppoli-to-hide" 
                        data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-trans_id="${item?.trans_id}" 
                         data-visit_id="${item?.visit_id}" data-index="${index}">
                          <i class="far fa-trash-alt"></i> Hapus
                        </button>
                        <?php } ?>

                        <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkPermission("assesmenoperasi", 'r') || user()->checkRoles(['superuser'])) { ?>
                        <button type="button" id="btn-show-assesment-requestOperation${item?.vactination_id}" class="btn btn-sm btn-success btn-show-assesment-requestOperation" data-date="${moment(item?.start_operation).format("DD/MM/YYYY HH:mm")}" data-treatname="${treatmentName}" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                           <i class="far fa-file-alt"></i> Asssesment
                        </button>
                        <?php } ?>
                        ` : `
                         <?php if (user()->checkPermission("pasienoperasi", 'c') || user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>

                        <button type="button" class="btn btn-sm btn-info btn-show-detail-requestOperation" data-noregis="${item?.no_registration}"  data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                            <i class="far fa-eye"></i> Lihat
                        </button>
                        <?php } ?>

                         <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkPermission("assesmenoperasi", 'r') || user()->checkRoles(['superuser'])) { ?>
                        <button type="button" id="btn-show-assesment-requestOperation${item?.vactination_id}" class="btn btn-sm btn-success btn-show-assesment-requestOperation" data-date="${moment(item?.start_operation).format("DD/MM/YYYY HH:mm")}" data-treatname="${treatmentName}" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
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

            if (!(visit?.locked === '0' || visit?.locked === null)) {
                $(".spppoli-to-hide").remove();
            }

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
                                ${element?.brand_name === '1' ? 'Instrumen' :
                                    element?.brand_name === '2' ? 'Kassa' :
                                    element?.brand_name === '3' ? 'Jarum' :
                                    element?.brand_name === '4' ? 'TAMPON KASSA THT' :
                                    element?.brand_name === '5' ? 'TAMPON KASSA BIASA' :
                                    element?.brand_name === '6' ? 'TAMPON KASSA ROLL OBSGYN' :
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


        const addRowInstrumen = (props = {}) => {
            const usedValues = $('select[name="brand_id[]"]').map(function() {
                return $(this).val();
            }).get();

            const options = [{
                    value: '1',
                    label: 'Instrumen'
                },
                {
                    value: '2',
                    label: 'Kassa'
                },
                {
                    value: '3',
                    label: 'Jarum'
                },
                {
                    value: '4',
                    label: 'TAMPON KASSA THT '
                },
                {
                    value: '5',
                    label: 'TAMPON KASSA BIASA'
                },
                {
                    value: '6',
                    label: 'TAMPON KASSA ROLL OBSGYN'
                },
            ];

            const availableOptions = options.filter(opt => !usedValues.includes(opt.value));

            if (availableOptions.length === 0) {
                alert('Semua instrumen telah dipilih.');
                return;
            }

            const select = $('<select class="form-select" name="brand_id[]"></select>');
            availableOptions.forEach(opt => {
                const selected = props?.brand_id === opt.value ? 'selected' : '';
                select.append(
                    `<option data-nama-instrumen="${opt.label}" value="${opt.value}" ${selected}>${opt.label}</option>`
                );
            });

            const $newRow = $(`
                    <tr>
                        <td></td>
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
                `);

            $newRow.find('td:first').append(select);

            $('#body-instrumen').append($newRow);
            $('#body-instrumen1').append($newRow.clone(true));

            $newRow.find('.delete-row').click(function() {
                $(this).closest('tr').remove();
                updateAddButtonVisibility();
            });

            updateAddButtonVisibility();
        };


        const updateAddButtonVisibility = () => {
            let rowCount = $('#body-instrumen tr').length;
            let rowCount1 = $('#body-instrumen1 tr').length;

            if (rowCount1 >= 6) {
                $('#addInstrumen1').hide();
            } else {
                $('#addInstrumen1').show();
            }


            if (rowCount >= 6) {
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

            let filteredData = aparameter?.filter(item => item?.p_type === props?.p_type);

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
                    NO_REGISTRATION: `${props?.no_registration}`
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
                                        vactination_id: `${props?.vactination_id}`
                                    }, 'admin/PatientOperationRequest/getDataTim', (
                                        res) => {
                                        if (res.response) {
                                            createDropdownTables(res.data);
                                            $('#transaksi-permintaan_operasi').val(props
                                                ?.transaksi);
                                            $("#form-action-pelayanan").val(props
                                                ?.terlayani ?? 0);
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
                    vactination_id: `${$(this).data('id')}`,
                    visit_id: `${$(this).data('visit_id')}`,
                    no_registration: `${$(this).data('noregis')}`
                }, 'admin/PatientOperationRequest/getDetail', (res) => {
                    Swal.fire({
                        title: 'Harap tunggu...',
                        html: '',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    modalViewOperationAction({
                        data: res
                    });
                });
            })
        }

        const deleteActionRequestOperation = (props) => {
            postData({
                vactination_id: `${props?.vactination_id}`,
                visit_id: `${props?.visit_id}`,
                no_registration: `${props?.no_registration}`,
            }, 'admin/PatientOperationRequest/deleteData', (res) => {
                if (res.respon === true) {
                    successSwal('Data berhasil Dihapus.');

                    getDataTabelRequestOperation({
                        no_registration: `${props?.no_registration}`,
                        visit_id: `${props?.visit_id}`,
                        trans_id: `${props?.trans_id}`
                    });
                } else {
                    errorSwal("Gagal Di hapus")
                }
            });
        }

        const getEditRequestOperation = () => {
            $('.btn-show-edit-requestOperation').on('click', function(e) {
                postData({
                    vactination_id: `${$(this).data('id')}`,
                    visit_id: `${$(this).data('visit_id')}`,
                    no_registration: `${$(this).data('noregis')}`
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
                    vactination_id: `${$(this).data('id')}`,
                    visit_id: `${$(this).data('visit_id')}`,
                    no_registration: `${$(this).data('noregis')}`
                }, 'admin/PatientOperationRequest/getDetail', (res) => {

                    modalViewDetailRequestOperation({
                        data: res
                    });
                });
            });
        }

        const getDataTabelRequestOperation = (props) => {
            postData({
                no_registration: `${props?.no_registration}`,
                visit_id: `${props?.visit_id}`,
                trans_id: `${props?.trans_id}`
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
            // $("#container-tab").slideUp();
        }



        const getDataVitailSign = (props) => {
            const pasienDiagnosaId = props?.pasien_diagnosa_id;
            const accountIds = props?.account_ids || [];
            const suffixes = props?.suffixes || [];


            postData({
                pasien_diagnosa_id: `${pasienDiagnosaId}`,
                account_ids: `${accountIds}`
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
                pasien_diagnosa_id: `${props?.vactination_id}`
            }, 'admin/PatientOperationRequest/getDiagnosassDockterData', (res) => {
                if (res.respon && Array.isArray(res.data)) {
                    const tbodyId = `bodyDiagLaporanAnesthesi-${props?.vactination_id}`;
                    const tbody = $(`#${tbodyId}`);
                    tbody.empty();

                    res.data.forEach((diagnosis) => {

                        addRowDiagDokterOprs('bodyDiagLaporanAnesthesi-', props
                            ?.vactination_id,
                            diagnosis?.diagnosa_id, diagnosis?.diagnosa_name ??
                            diagnosis
                            ?.diagnosa_desc,
                            diagnosis
                            ?.diag_cat,
                            diagnosis?.suffer_type);
                    });
                }
            });
        };



        const getDataDiagnosassPerawat = (props) => {
            postData({
                document_id: `${props?.document_id}`,
                visit_id: `${props?.visit_id}`,
            }, 'admin/PatientOperationRequest/getDiagnosassPerawatData', (res) => {
                if (res.respon === true) {
                    const tbodyIdPra = `bodyDiagKepCatatanPraOprs-${props?.vactination_id}`;
                    const tbodyPra = $(`#${tbodyIdPra}`);
                    tbodyPra.empty();
                    // =============intra 
                    const tbodyIdIntra = `bodyDiagKepCatatanIntraOprs-${props?.vactination_id}`;
                    const tbodyIntra = $(`#${tbodyIdIntra}`);
                    tbodyIntra.empty();

                    //============pasca
                    const tbodyIdPasca = `bodyDiagKepCatatanPascaOprs-${props?.vactination_id}`;
                    const tbodyPasca = $(`#${tbodyIdPasca}`);
                    tbodyPasca.empty();

                    res?.data?.diagnosa.forEach((diagnosis) => {
                        if (diagnosis?.diag_cat === "13") {
                            addRowDiagPerawat('bodyDiagKepCatatanPraOprs-', props
                                ?.vactination_id,
                                diagnosis?.diagnosan_id, diagnosis?.diag_notes,
                                diagnosis
                                ?.diag_cat);
                        } else if (diagnosis?.diag_cat === "15") {
                            addRowDiagPerawat('bodyDiagKepCatatanIntraOprs-', props
                                ?.vactination_id,
                                diagnosis?.diagnosan_id, diagnosis?.diag_notes,
                                diagnosis
                                ?.diag_cat);
                        } else if (diagnosis?.diag_cat === "14") {
                            addRowDiagPerawat('bodyDiagKepCatatanPascaOprs-', props
                                ?.vactination_id,
                                diagnosis?.diagnosan_id, diagnosis?.diag_notes,
                                diagnosis
                                ?.diag_cat);
                        }
                    });




                }
            });
        }; // new update 30/07

        const selectedDiagnosaOprs = (index) => {
            const diagtext = $(`#adiagdiag_id${index} option:selected`).text();
            const diagVal = $(`#adiagdiag_id${index} option:selected`).val();
            const diagdesc = moment(new Date).format("YYYY")

            if (diagtext && diagtext.trim() !== "") {
                if (diagVal.includes(diagdesc)) {
                    $(`#adiagdiag_desc${index}`).val(diagtext);
                    $(`#adiagdiag_name${index}`).val(null);
                } else {
                    $(`#adiagdiag_name${index}`).val(diagtext);
                    $(`#adiagdiag_desc${index}`).val(null);
                }
            }
        };

        const addRowDiagDokterOprs = (container, bodyId, diag_id = null, diag_name = null, diag_cat = null,
            diag_suffer = 0) => {
            const tbody = document.getElementById(`${container}${bodyId}`);
            let diagIndex = tbody.getElementsByTagName("tr").length;

            if (diag_id) {
                let isDuplicate = false;
                $(`#${container}${bodyId} tr`).each(function() {
                    const existingDiagId = $(this).find(`[name="diag_id[]"]`).val();
                    if (existingDiagId === diag_id) {
                        isDuplicate = true;
                        return false;
                    }
                });

                if (isDuplicate) {
                    // alert("Diagnosa sudah ditambahkan sebelumnya!");
                    return;
                }
            }

            if (!diag_cat) diag_cat = diagIndex > 1 ? 2 : 1;
            diagIndex = `${bodyId}_${diagIndex + 1}`;

            const sufferOptions = <?= json_encode(array_map(function ($item) {
                                        return ['value' => $item['suffer_type'], 'label' => $item['suffer']];
                                    }, $suffer)); ?>;

            const diagCatOptions = <?= json_encode($diagCat); ?>;

            const filteredDiagCatOptions = diagCatOptions.filter(option => ['1', '13', '14', '15']
                .includes(
                    option
                    .diag_cat.toString()));

            const sufferList = sufferOptions.map(opt =>
                    `<option value="${opt.value}">${opt.label}</option>`)
                .join('');
            const diagCatList = filteredDiagCatOptions.map(opt =>
                `<option value="${opt.diag_cat}">${opt.diagnosa_category}</option>`).join('');

            $(`#${container}${bodyId}`).append(`
                    <tr id="adiagdiag${diagIndex}${container}">
                        <td>
                            <span id="idCopydiag${diagIndex}${container}" class="pointer text-primary fw-bold text-decoration-underline">Copy</span>
                        </td>
                        <td>
                            <select id="adiagdiag_id${diagIndex}${container}" 
                                    class="form-control enablekan" 
                                    name="diag_id[]" 
                                    onfocus="removetextdiag('${diagIndex}${container}')" 
                                    style="width: 100%">
                            </select>
                            <input id="adiagdiag_name${diagIndex}${container}" 
                                name="diag_name[]" 
                                type="text" 
                                class="form-control block enablekan" 
                                style="display: none" />
                            <input id="adiagdiag_desc${diagIndex}${container}" 
                                name="diag_desc[]" 
                                type="text" 
                                class="form-control block enablekan" 
                                style="display: none" />
                            <input id="adiagsscondition_id${diagIndex}${container}" 
                                name="sscondition_id[]" 
                                type="text" 
                                class="form-control block enablekan" 
                                style="display: none" />
                        </td>
                        <td>
                            <select class="form-select enablekan" name="suffer_type[]" id="adiagsuffer_type${diagIndex}${container}">
                                ${sufferList}
                            </select>
                        </td>
                        <td>
                            <select class="form-select enablekan" name="diag_cat[]" id="adiagdiag_cat${diagIndex}${container}">
                                ${diagCatList}
                            </select>
                        </td>
                        <td>
                            <a href="#" onclick="$('#adiagdiag${diagIndex}${container}').remove()" 
                            class="btn closebtn btn-xs pull-right enablekan" 
                            title="">
                            <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
         `);

            $(`#adiagdiag_id${diagIndex}${container}`).on('change', function() {
                selectedDiagnosaOprs(diagIndex + container);
            });
            initializeDiagSelect21(`adiagdiag_id${diagIndex}${container}`, diag_id, diag_name,
                diagIndex +
                container);

            $(`#adiagsuffer_type${diagIndex}${container}`).val(diag_suffer ?? 0);
            $(`#adiagdiag_cat${diagIndex}${container}`).val(diag_cat);

            $(`#idCopydiag${diagIndex}${container}`).on("click", function() {
                const selectedText = $(`#adiagdiag_id${diagIndex}${container} option:selected`)
                    .text();
                if (selectedText) {
                    navigator.clipboard.writeText(selectedText).then(() => {
                        alert("Teks berhasil disalin: " + selectedText);
                    }).catch(err => {
                        console.error("Gagal menyalin teks", err);
                    });
                } else {
                    alert("Tidak ada teks yang dipilih!");
                }
            });
        };


        function initializeDiagSelect21(theid, initialvalue = null, initialname = null, index = null) {
            const $select = $("#" + theid);

            $select.select2({
                placeholder: "Input Diagnosa",
                allowClear: false,
                tags: true,
                ajax: {
                    url: '<?= base_url(); ?>admin/patient/getDiagnosisListAjax',
                    type: "post",
                    dataType: 'json',
                    delay: 50,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: false
                },
                createTag: function(params) {
                    if ($.trim(params.term) === '') {
                        return null;
                    }
                    return {
                        id: "new_" + get_bodyid(),
                        text: params.term,
                        newOption: true
                    };
                },
                templateResult: function(data) {
                    if (data.newOption) {
                        $(`#adiagdiag_desc${index}`).val(data.text);
                        $(`#adiagdiag_name${index}`).val(null);
                        return $('<span>Tambah: ' + data.text + '</span>');
                    }
                    return data.text;
                },

            });

            if (initialvalue != null) {
                let option = new Option(initialname, initialvalue, true, true);
                $select.append(option).trigger('change');
            }

            $select.on('select2:select', function(e) {
                const selectedValue = e.params.data.text;
                const isNew = e.params.data.newOption || e.params.data.id.startsWith("new_");

                if (isNew) {
                    $(`#adiagdiag_desc${index}`).val(selectedValue);
                    $(`#adiagdiag_name${index}`).val(null);
                    setTimeout(() => {
                        $(".select2-search__field").val(selectedValue).focus();
                    }, 50);
                } else {
                    $(`#adiagdiag_desc${index}`).val(null);
                    $(`#adiagdiag_name${index}`).val(selectedValue);
                }
            });

            $select.on("select2:open", function() {
                let lastSelectedText = $select.find("option:selected").text();
                setTimeout(() => {
                    $(".select2-search__field").val(lastSelectedText).focus();
                }, 50);
            });

            $select.parent().find("input.select2-search__field").on("keypress", function(e) {
                if (e.which === 13) {
                    const inputVal = $(this).val().trim();
                    if (inputVal !== "") {
                        let newOption = new Option(inputVal, 'new_' + Date.now(), true, true);
                        $select.append(newOption).trigger('change');
                    }
                    return false;
                }
            });

        }



        function addRowDiagPerawat(container, bodyId, diag_id = null, diag_notes = null, diag_cat = null) {
            const diagCatOptions = <?= json_encode($diagCat); ?>;
            const filteredDiagCatOptions = diagCatOptions.filter(option => ['13', '14', '15'].includes(
                option
                .diag_cat.toString()));
            const tbody = $("#" + container + bodyId);
            let diagIndex = tbody.find("tr").length;

            diagIndex = bodyId + diagIndex;

            const diagCatList = filteredDiagCatOptions.map(opt =>
                `<option value="${opt.diag_cat}">${opt.diagnosa_category}</option>`
            ).join('');

            const rowHtml = `
        <tr id="${container}${bodyId}${diagIndex}">
            <td>
                <select id="adiagpdiagnosan_id${container}${bodyId}${diagIndex}" class="form-control" name="diagnosan_id[]" style="width: 100%"></select>
                <input id="adiagpdiag_notes${container}${bodyId}${diagIndex}" name="diag_notes[]" placeholder="" type="text" class="form-control block" value="${diag_notes || ''}" style="display: none" />
            </td>
            <td>
                <select class="form-select" name="diag_cat[]" id="adiagdiag_cat${container}${bodyId}${diagIndex}" disabled>
                    ${diagCatList}
                </select>
            </td>
            <td>
                <div class="btn closebtn btn-xs pull-right pointer" data-toggle="modal" title="">
                    <i class="fa fa-trash"></i>
                </div>
            </td>
            
        </tr>
    `;

            tbody.append(rowHtml);

            const diagSelect = $(`#adiagpdiagnosan_id${container}${bodyId}${diagIndex}`);
            const diagCatSelect = $(`#adiagdiag_cat${container}${bodyId}${diagIndex}`);

            initializeDiagPerawatSelect2(diagSelect.attr("id"), diag_id, diag_notes);
            diagCatSelect.val(diag_cat || "");

            diagSelect.on("focus", function() {
                removetextdiag(diagIndex);
            }).on("change", function() {
                selectedDiagNursePerawatOprs(container + bodyId + diagIndex);
            });

            $(`#${container}${bodyId}${diagIndex} .closebtn`).on("click", function() {
                $(`#${container}${bodyId}${diagIndex}`).remove();
            });
        }
        // new update 30/07


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
                obatInhalasi += `<tr id="obat${item?.bill_id}cstm">
                <td>
                <input type="text" id="dateObat${item?.bill_id}" name="dateobat[]" class="form-control datetimeflatpickr-oprs-anes"
                 value="${moment(item?.treat_date).format("DD/MM/YYYY HH:mm")}">   
                 <input type="hidden" id="dateObat${item?.bill_id}Id" name="billobat[]" class="form-control "
                 value="${item?.bill_id}">
                </td>
                <td>${item?.name ?? "-"}</td>
                <td>${item?.quantity ?? "0"}</td>
            </tr>`;
            });

            data?.treatment?.filter(item => parseInt(item.isalkes) === 20).map((item, index) => {

                obatInjeksi += `<tr id="obat${item?.bill_id}cstm">
                <td>
                <input type="text" id="dateObat${item?.bill_id}" name="dateobat[]" class="form-control datetimeflatpickr-oprs-anes"
                 value="${moment(item?.treat_date).format("DD/MM/YYYY HH:mm")}">   
                 <input type="hidden" id="dateObat${item?.bill_id}Id" name="billobat[]" class="form-control "
                 value="${item?.bill_id}">
                </td>
                <td>${item?.name ?? "-"}</td>
                <td>${item?.quantity ?? "0"}</td>
            </tr>`;
            });

            data?.treatment?.filter(item => parseInt(item.isalkes) === 19).map((item, index) => {
                obatCairan += `<tr>
               <td>
                <input type="text" id="dateObat${item?.bill_id}" name="dateobat[]" class="form-control datetimeflatpickr-oprs-anes"
                 value="${moment(item?.treat_date).format("DD/MM/YYYY HH:mm")}">   
                 <input type="hidden" id="dateObat${item?.bill_id}Id" name="billobat[]" class="form-control "
                 value="${item?.bill_id}">
                </td>
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
                        <td>
                          <input type="text" id="dateObat${item?.blood_request}" name="dateobatBoold[]" class="form-control datetimeflatpickr-oprs-anes"
                            value="${moment(item?.using_time).format("DD/MM/YYYY HH:mm")}">   
                            <input type="hidden" id="dateObat${item?.blood_request}Id" name="billobatBoold[]" class="form-control "
                            value="${item?.blood_request}">
                        </td>
                        <td></td>
                        <td>${item?.usagetype  ?? "-"}</td>
                        <td>${item?.blood_quantity ?? "0"}</td>
                    </tr>`;
            });

            const isalkesArray = [2, 19, 20];

            data?.treatment?.filter(item => isalkesArray?.includes(parseInt(item.isalkes))).map((item,
                index) => {
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
                pasien_diagnosa_id: `${props?.vactination_id}`
            }, 'admin/PatientOperationRequest/getDiagnosassDockterData', (res) => {


                if (res.respon && Array.isArray(res.data)) {
                    const tbodyId = `bodyDiagLaporanAnesthesiLengkap-${props?.vactination_id}`;
                    const tbody = $(`#${tbodyId}`);
                    tbody.empty();
                    res.data.forEach((diagnosis) => {

                        addRowDiagDokterOprs('bodyDiagLaporanAnesthesiLengkap-', props
                            ?.vactination_id,
                            diagnosis.diagnosa_id, diagnosis.diagnosa_name ??
                            diagnosis
                            .diagnosa_desc, diagnosis
                            .diag_cat,
                            diagnosis.suffer_type);
                    });
                }
            });
        }; //new 01/08

        const convertDate = (dateString) => {
            const formats = ["YYYY-MM-DD", "DD/MM/YYYY", "YYYY-MM-DD HH:mm", "DD/MM/YYYY HH:mm",
                "YYYY-MM-DDTHH:mm"
            ];
            const parsedDate = moment(dateString, formats, true);
            if (parsedDate.isValid()) {
                return parsedDate.format("YYYY-MM-DD HH:mm");
            } else {
                return null;
            }
        };

    })()

    function selectedDiagNursePerawatOprs(index) {
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
