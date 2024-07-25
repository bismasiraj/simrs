<link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.2/quill.snow.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.2/quill.js"></script>



<script type="text/javascript">
    let treatmentData = [];
    let historyPasien = [];
    let pasienOperasiValue = [];
    let pasienOperasiSelected = [];
    (function() {
        $(document).ready(function() {
            let visit = <?= json_encode($visit) ?>;
            getDataTableOperation(visit);

            actionButtonAddOperation(visit);
            $('#container-tab').attr('hidden', true) //update
            $("#close-create-modal-permintaan-operasi").off().on("click", (e) => {
                tinymce.remove();
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
                tinymce.remove();
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
                $('#container-tab').attr('hidden', true)
            });

        });
        let quillInstances = {}
        let tasksValue = []
        let employesValue = []
        let InstrumenValue = []

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

        const initTinyMCERequestOperation = () => {
            tinymce.remove();

            tinymce.init({
                selector: '#diagnosa_desc-permintaan_operasi',
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
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
                    }
                ]
            });
        };


        // ACTIONS & BTN
        const actionDropdownSpesialisas = () => {
            $("#tarif_id-permintaan_operasi").off().on("change", function(e) {
                let selectedOption = $(this).find('option:selected');
                let operationType = selectedOption.data('operation-type');
                $("#operation_type-permintaan_operasi").val(operationType);
            });
        }

        const getDataTableOperation = (props) => {

            $("#patientOperationRequestTab").off().on("click", function(e) {
                getLoadingscreen("contentToHide-requestOperation", "load-content-requestOperation")
                getDataTreatment()
                e.preventDefault();
                getDataTabelRequestOperation({
                    no_registration: props?.no_registration,
                    visit_id: props?.visit_id
                })
            })
        };

        const btnSaveActionRequestOperation = (props) => {
            $("#btn-save-permintaan-operasi-modal").off().on("click", function(e) {
                e.preventDefault();

                if ($('#tarif_id-permintaan_operasi').val() === '' || $('#tarif_id-permintaan_operasi')
                    .val() ===
                    null) {
                    $('#tarif_id-permintaan_operasi').select2('open');
                    return;
                }

                tinymce.triggerSave();

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

                let isChecked = $("#patient_category_id-permintaan_operasi").prop('checked') ? 1 : 0;
                jsonObj['patient_category_id-permintaan_operasi'] = isChecked;
                let operationType = $("#operation_type-permintaan_operasi").val();
                jsonObj['operation_type-permintaan_operasi'] = operationType;

                postData(jsonObj, 'admin/PatientOperationRequest/insertData', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil disimpan.');

                        $("#create-modal-permintaan-operasi").modal("hide");
                        $('#formDokumentPermintaanOperasi')[0].reset();
                        tinymce.remove();
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
                tinymce.triggerSave();
                $('#formDokumentPermintaanOperasi').find(':disabled').each(function() {
                    $(this).removeAttr('disabled');
                });

                let formElement = document.getElementById('formDokumentPermintaanOperasi');
                let dataSend = new FormData(formElement);
                let jsonObj = {};


                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });

                let isChecked = $("#patient_category_id-permintaan_operasi").prop('checked') ? 1 : 0;
                jsonObj['patient_category_id-permintaan_operasi'] = isChecked;
                let operationType = $("#operation_type-permintaan_operasi").val();
                jsonObj['operation_type-permintaan_operasi'] = operationType;

                postData(jsonObj, 'admin/PatientOperationRequest/updateData', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');

                        $("#create-modal-permintaan-operasi").modal("hide");
                        $('#formDokumentPermintaanOperasi')[0].reset();
                        tinymce.remove();
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

                tinymce.triggerSave();
                $('#form-catatan-keperawatan').find(':disabled').removeAttr('disabled');
                let formElement = document.getElementById('form-catatan-keperawatan');
                let dataSend = new FormData(formElement);

                let jsonObj = {};
                jsonObj.instrumen = [];

                dataSend.forEach((value, key) => {
                    if (value) { // Only include non-empty values
                        if (!jsonObj[key]) {
                            jsonObj[key] = value;
                        }
                    }
                });

                let quantity_before = dataSend.getAll('quantity_before[]');
                let quantity_intra = dataSend.getAll('quantity_intra[]');
                let quantity_additional = dataSend.getAll('quantity_additional[]');
                let quantity_after = dataSend.getAll('quantity_after[]');
                let brand_name = dataSend.getAll('brand_name[]');
                let brand_id = dataSend.getAll('brand_id[]');

                for (let i = 0; i < brand_id.length; i++) {
                    let entry = {
                        brand_id: brand_id[i],
                        brand_name: brand_name[i],
                        quantity_before: quantity_before[i],
                        quantity_intra: quantity_intra[i],
                        quantity_additional: quantity_additional[i],
                        quantity_after: quantity_after[i],
                    };

                    jsonObj.instrumen.push(entry);
                }

                let xrayValue = document.querySelector('input[name="xray"]:checked').value;
                jsonObj.xray = parseInt(xrayValue, 10);

                $("#loading-indicator").show();

                postData(jsonObj, 'admin/PatientOperationRequest/insertDataPraOprasi', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');

                        $("#create-modal-permintaan-operasi").modal("hide");
                        tinymce.remove();

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

                tinymce.triggerSave();
                $('#form-laporan-pembedahan').find(':disabled').removeAttr('disabled');

                let formElement = document.getElementById('form-laporan-pembedahan');
                let dataSend = new FormData(formElement);
                let jsonObj = {};


                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });

                postData(jsonObj, 'admin/PatientOperationRequest/insertLaporanPembedahan', (res) => {

                    if (res.respon === true) {
                        successSwal('Data berhasil diperbarui.');

                        $("#create-modal-permintaan-operasi").modal("hide");
                        $('#form-operasi')[0].reset();
                        tinymce.remove();

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
                quillInstances = {}
                let index = $(this).data('index');
                let item = pasienOperasiValue[index];
                pasienOperasiSelected = item
                // assessmentPraOperasi(item)
                getDataInstrumenoprs(item)
                getInstrumen(item)
                catatanKeperawatanPraOperasi(item);
                checklistKeselamatan(item);
                anestesi(item);
                pembedahan(item);
                postOperasi(item)

                $("#container-tab").attr("hidden", false);
                $("#nama-tindakan-operasi").text($(this).data('treatname') + ' (' + $(this).data(
                        'date') +
                    ')');
                $("#body_id_checklist_keselamatan").val($(this).data('id'));
                $("#body_id_checklist_anestesi").val($(this).data('id'));
                $("#body_id_informasi-post-operasi").val($(this).data('id'));
            });
        }

        const actionBtnUpdateAndInsert = (props) => {
            $('#btn-updateAndInsert-permintaan-operasi-modal').off().on('click', function(e) {
                e.preventDefault();

                tinymce.triggerSave();
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


                let isChecked = $("#patient_category_id-permintaan_operasi").prop('checked') ? 1 : 0;
                jsonObj['patient_category_id-permintaan_operasi'] = isChecked;
                let operationType = $("#operation_type-permintaan_operasi").val();
                jsonObj['operation_type-permintaan_operasi'] = operationType;


                groupedTasksKeys.forEach(key => {
                    let tasks = window.groupedTasks[key] || [];
                    let employees = window.employees.data || [];

                    let employeeIds = formData.getAll(`employee_option[]`);
                    let taskIds = formData.getAll(`groupedTasks_option[]`);

                    employeeIds.forEach((employee_id, index) => {
                        if (employee_id) {
                            let employeeData = employees.find(emp => emp.employee_id ===
                                employee_id);
                            if (employeeData) {
                                let entry = {
                                    [`EMPLOYEE_ID`]: employeeData.employee_id,
                                    [`DOCTOR`]: employeeData.fullname
                                };

                                let task_id = taskIds[index];
                                if (task_id) {
                                    let taskData = tasks.find(task => task.task_id ===
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
                        tinymce.remove();

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
                        console.error(`Tasks for dropdown type '${dropdownType}' are undefined or empty.`);
                    }
                });

            $('#dropdown-param-tindakan-operasi').off('click', '.delete-dropdown').on('click',
                '.delete-dropdown',
                function() {
                    $(this).closest('tr').prev().remove();
                    $(this).closest('tr').remove();
                });
        };

        // ALL RENDER & TEMPLATE
        const actionButtonAddOperation = (visit) => {
            $("#btn-create-operasi").off().on("click", (e) => {
                e.preventDefault();
                tinymce.remove();
                $("#dropdown-param-tindakan-operasi").html("");


                $("#create-modal-permintaan-operasi").modal("show");
                $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(visit));
                $("#formDate-tindakan-oprasi-2").html("")


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
                $('#end_operation-permintaan_operasi').val(visit.end_operation);
                $('#start_anestesi-permintaan_operasi').val(visit.start_anestesi);
                $('#end_anestesi-permintaan_operasi').val(visit.end_anestesi);
                $('#result_id-permintaan_operasi').val(visit.result_id);
                $('#clinic_id-permintaan_operasi').val(visit.clinic_id);
                $('#transaksi-permintaan_operasi').val(0);
                $('#layan-permintaan_operasi').val(visit.layan);
                let currentDateTime = moment().format("YYYY-MM-DDTHH:mm");
                $("#start_operation-permintaan_operasi").val(currentDateTime);
                $('#rooms_id-permintaan_operasi').val(visit.rooms_id);
                $('#clinic_id_from-permintaan_operasi').val(visit.clinic_id_from);
                $('#class_room_id-permintaan_operasi').val(visit.class_room_id);
                $('#patient_category_id-permintaan_operasi').prop('checked', visit.patient_category_id);
                $('#operation_type-permintaan_operasi').val("");


                tinymce.init({
                    selector: '#diagnosa_desc-permintaan_operasi',
                    toolbar: true,
                    menubar: true,
                    plugins: [],
                }).then((editors) => {
                    editors[0]?.setContent(visit.diagnosa_desc);
                });

                $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {
                    let treatmentData = renderDropdownTreatment();
                    $('#tarif_id-permintaan_operasi').select2({
                        data: treatmentData,
                        disabled: false,
                        dropdownParent: $('#create-modal-permintaan-operasi')
                    });
                });


                actionDropdownSpesialisas();
                initTinyMCERequestOperation();
                btnSaveActionRequestOperation(visit);
            });
        }

        const renderDropdownTreatment = () => {
            let data = treatmentData;

            let result = "";
            data.forEach((item) => {
                result +=
                    `<option value="${item.tarif_id}" data-operation-type="${item.operation_type}">${item.tarif_name}</option>`;
            });

            $("#tarif_id-permintaan_operasi").html(
                `<option selected disabled value="">Pilih Tindakan</option>` +
                result);
        };

        const getTemplatePermintaanOperasi = () => {
            return `<div hidden>
                <div class="form-group">
                    <label for="org_unit_code-permintaan_operasi">Org Unit Code</label>
                    <input class="form-control disabled" id="org_unit_code-permintaan_operasi" name="org_unit_code-permintaan_operasi" >
                    <input class="form-control disabled" id="trans_id-permintaan_operasi" name="trans_id-permintaan_operasi"></input>

                </div>
                <div class="form-group">
                    <label for="visit_id-permintaan_operasi">Visit ID</label>
                    <input class="form-control disabled" id="visit_id-permintaan_operasi" name="visit_id-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="vactination_id-permintaan_operasi">Vaccination ID</label>
                    <input class="form-control disabled" id="vactination_id-permintaan_operasi" name="vactination_id-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="no_registration-permintaan_operasi">No Registration</label>
                    <input class="form-control disabled" id="no_registration-permintaan_operasi" name="no_registration-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="vactination_date-permintaan_operasi">Vaccination Date</label>
                    <input class="form-control disabled" id="vactination_date-permintaan_operasi" name="vactination_date-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="description-permintaan_operasi">Description</label>
                    <input class="form-control disabled" id="description-permintaan_operasi" name="description-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="employee_id-permintaan_operasi">Employee ID</label>
                    <input class="form-control disabled" id="employee_id-permintaan_operasi" name="employee_id-permintaan_operasi">
                </div>
                <div class="form-group">
                    <label for="doctor-permintaan_operasi">Doctor</label>
                    <input class="form-control disabled" id="doctor-permintaan_operasi" name="doctor-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="anestesi_type-permintaan_operasi">Anestesi Type</label>
                    <input class="form-control disabled" id="anestesi_type-permintaan_operasi" name="anestesi_type-permintaan_operasi">
                </div>
                <div class="form-group">
                    <label for="modified_date-permintaan_operasi">Modified Date</label>
                    <input class="form-control disabled" id="modified_date-permintaan_operasi" name="modified_date-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="modified_by-permintaan_operasi">Modified By</label>
                    <input class="form-control disabled" id="modified_by-permintaan_operasi" name="modified_by-permintaan_operasi">
                </div>
                
                <div class="form-group">
                    <label for="validation-permintaan_operasi">Validation</label>
                    <input class="form-control disabled" id="validation-permintaan_operasi" name="validation-permintaan_operasi" value='0'>
                </div>
                <div class="form-group">
                    <label for="terlayani-permintaan_operasi">Terlayani</label>
                    <input class="form-control disabled" id="terlayani-permintaan_operasi" name="terlayani-permintaan_operasi" value='0'>
                </div>
               
                <div class="form-group">
                    <label for="thename-permintaan_operasi">Thename</label>
                    <input class="form-control disabled" id="thename-permintaan_operasi" name="thename-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="theaddress-permintaan_operasi">Theaddress</label>
                    <input class="form-control disabled" id="theaddress-permintaan_operasi" name="theaddress-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="theid-permintaan_operasi">Theid</label>
                    <input class="form-control disabled" id="theid-permintaan_operasi" name="theid-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="isrj-permintaan_operasi">Isrj</label>
                    <input class="form-control disabled" id="isrj-permintaan_operasi" name="isrj-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="status_pasien_id-permintaan_operasi">Status Pasien ID</label>
                    <input class="form-control disabled" id="status_pasien_id-permintaan_operasi" name="status_pasien_id-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="gender-permintaan_operasi">Gender</label>
                    <input class="form-control disabled" id="gender-permintaan_operasi" name="gender-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="ageyear-permintaan_operasi">Age Year</label>
                    <input class="form-control disabled" id="ageyear-permintaan_operasi" name="ageyear-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="agemonth-permintaan_operasi">Age Month</label>
                    <input class="form-control disabled" id="agemonth-permintaan_operasi" name="agemonth-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="ageday-permintaan_operasi">Age Day</label>
                    <input class="form-control disabled" id="ageday-permintaan_operasi" name="ageday-permintaan_operasi" >
                </div>
                
                <div class="form-group">
                    <label for="bed_id-permintaan_operasi">Bed ID</label>
                    <input class="form-control disabled" id="bed_id-permintaan_operasi" name="bed_id-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="keluar_id-permintaan_operasi">Keluar ID</label>
                    <input class="form-control disabled" id="keluar_id-permintaan_operasi" name="keluar_id-permintaan_operasi" >
                </div>
                
                <div class="form-group">
                    <label for="diagnosa_pra-permintaan_operasi">Diagnosa Pra</label>
                    <input class="form-control disabled" id="diagnosa_pra-permintaan_operasi" name="diagnosa_pra-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="diagnosa_pasca-permintaan_operasi">Diagnosa Pasca</label>
                    <input class="form-control disabled" id="diagnosa_pasca-permintaan_operasi" name="diagnosa_pasca-permintaan_operasi" >
                </div>
               
                <!---<div class="form-group">
                    <label for="end_operation-permintaan_operasi">End Operation</label>
                    <input class="form-control disabled" id="end_operation-permintaan_operasi" name="end_operation-permintaan_operasi" >
                </div>--->
                <div class="form-group">
                    <label for="start_anestesi-permintaan_operasi">Start Anestesi</label>
                    <input class="form-control disabled" id="start_anestesi-permintaan_operasi" name="start_anestesi-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="end_anestesi-permintaan_operasi">End Anestesi</label>
                    <input class="form-control disabled" id="end_anestesi-permintaan_operasi" name="end_anestesi-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="result_id-permintaan_operasi">Result ID</label>
                    <input class="form-control disabled" id="result_id-permintaan_operasi" name="result_id-permintaan_operasi" >
                </div>
                <div class="form-group">
                    <label for="clinic_id-permintaan_operasi">Clinic ID</label>
                    <input class="form-control disabled" id="clinic_id-permintaan_operasi" name="clinic_id-permintaan_operasi" value='P002'>
                </div>
               <div class="form-group">
                    <label for="transaksi-permintaan_operasi">Transaksi</label>
                    <input class="form-control disabled" id="transaksi-permintaan_operasi" name="transaksi-permintaan_operasi" value='0'>
                </div>
                <div class="form-group">
                    <label for="layan-permintaan_operasi">Layan</label>
                    <input class="form-control disabled" id="layan-permintaan_operasi" name="layan-permintaan_operasi" value='0'>
                </div>
                
            </div>
            <div>
            <h3 class="text-center">Penjadwalan Operasi</h3>
                <div class="form-group" id="formDate-tindakan-oprasi-1">
                    <label for="start_operation-permintaan_operasi">Tanggal/Jam Operasi</label>
                    <input class="form-control datetime-input" type="datetime-local" id="start_operation-permintaan_operasi" name="start_operation-permintaan_operasi">
                </div>
              <div class="row form-group" id="formDate-tindakan-oprasi-2">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="start_operation-permintaan_operasi">Tanggal/Jam Operasi</label>
                        <input class="form-control datetime-input" type="datetime-local" id="start_operation-permintaan_operasi" name="start_operation-permintaan_operasi">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end justify-content-center">
                    <div class="form-group">
                        <span>S.d</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="class_room_id-permintaan_operasi">&nbsp;</label>
                         <input class="form-control datetime-input" type="datetime-local" id="end_operation-permintaan_operasi" name="end_operation-permintaan_operasi">
                    </div>
                </div>
            </div>

                <div class="form-group">
                    <label for="rooms_id-permintaan_operasi">Ruang Operasi</label>
                    <input class="form-control disabled" id="rooms_id-permintaan_operasi" name="rooms_id-permintaan_operasi"  disabled>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="clinic_id_from-permintaan_operasi">Klinik</label>
                            <input class="form-control" disabled id="clinic_id_from-permintaan_operasi" name="clinic_id_from-permintaan_operasi" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="class_room_id-permintaan_operasi">Bangsal</label>
                            <input class="form-control disabled" disabled id="class_room_id-permintaan_operasi" name="class_room_id-permintaan_operasi" >
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <label>Emergency / Elektif</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="patient_category_id-permintaan_operasi" name="patient_category_id-permintaan_operasi">
                        <label class="form-check-label" for="patient_category_id-permintaan_operasi">
                            Cyto
                        </label>
                    </div>
                </div>

                <h3 class="text-center">Tim Operasi</h3>
                 <div class="form-group">
                    <label for="operation_type-permintaan_operasi">Sub Spesialisas</label>  <!--- hasil tarif id ---->
                    <input class="form-control disabled" id="operation_type-permintaan_operasi" name="operation_type-permintaan_operasi" disabled value="">
                </div>
                <div class="form-group">
                    <label for="tarif_id-permintaan_operasi">Tindakan Operasi</label> <!--- isis ---->
                    <select class="form-control select2" id="tarif_id-permintaan_operasi" name="tarif_id-permintaan_operasi" required >
                      
                    </select>
                </div>
                 <div class="form-group">
                    <label for="diagnosa_desc-permintaan_operasi">Diagnosis</label> <!--- isi sendiri --->
                    <textarea class="form-control disabled" id="diagnosa_desc-permintaan_operasi" name="diagnosa_desc-permintaan_operasi"></textarea>
                </div>

            </div>
            `
        }

        const modalViewDetailRequestOperation = (data) => {
            let resultData = data;
            let result = resultData.data[0];


            $("#dropdown-param-tindakan-operasi").html("");
            $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(result));
            $("#formDate-tindakan-oprasi-2").html("")
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
            $('#end_operation-permintaan_operasi').val(result.end_operation);
            $('#start_anestesi-permintaan_operasi').val(result.start_anestesi);
            $('#end_anestesi-permintaan_operasi').val(result.end_anestesi);
            $('#result_id-permintaan_operasi').val(result.result_id);
            $('#clinic_id-permintaan_operasi').val(result?.clinic_id);
            $('#transaksi-permintaan_operasi').val(result.transaksi);
            $('#layan-permintaan_operasi').val(result.layan);
            let currentDateTime = moment(result.start_operation).format("YYYY-MM-DDTHH:mm");
            $("#start_operation-permintaan_operasi").val(currentDateTime);
            $('#rooms_id-permintaan_operasi').val(result.rooms_id);
            $('#clinic_id_from-permintaan_operasi').val(result.clinic_id_from);
            $('#class_room_id-permintaan_operasi').val(result.class_room_id);
            $('#patient_category_id-permintaan_operasi').prop('checked', result.patient_category_id);
            $('#operation_type-permintaan_operasi').val(result.operation_type);
            $('#vactination_id-permintaan_operasi').val(result.vactination_id);
            $("#trans_id-permintaan_operasi").val(result?.trans_id)
            $("#start_operation-permintaan_operasi").attr("disabled", true)
            $("#patient_category_id-permintaan_operasi").attr("disabled", true)

            tinymce.init({
                selector: '#diagnosa_desc-permintaan_operasi',
                readonly: true,
                toolbar: true,
                menubar: true,
                plugins: [],
            }).then((editors) => {
                editors[0].setContent(result.diagnosa_desc);
            });

            $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {
                $('#tarif_id-permintaan_operasi').select2({
                    disabled: true
                });
                $('#tarif_id-permintaan_operasi').val(result.tarif_id).trigger('change');
            });
        };

        const modalViewEditRequestOperation = (data) => {
            let resultData = data;
            let result = resultData.data[0];

            $("#dropdown-param-tindakan-operasi").html("");
            $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(result));
            $("#formDate-tindakan-oprasi-2").html("")
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
            $('#end_operation-permintaan_operasi').val(result.end_operation);
            $('#start_anestesi-permintaan_operasi').val(result.start_anestesi);
            $('#end_anestesi-permintaan_operasi').val(result.end_anestesi);
            $('#result_id-permintaan_operasi').val(result.result_id);
            $('#clinic_id-permintaan_operasi').val(result?.clinic_id);
            $('#transaksi-permintaan_operasi').val(result.transaksi);
            $('#layan-permintaan_operasi').val(result.layan);
            let currentDateTime = moment(result.start_operation).format("YYYY-MM-DDTHH:mm");
            $("#start_operation-permintaan_operasi").val(currentDateTime);
            $('#rooms_id-permintaan_operasi').val(result.rooms_id);
            $('#clinic_id_from-permintaan_operasi').val(result.clinic_id_from);
            $('#class_room_id-permintaan_operasi').val(result.class_room_id);
            $('#patient_category_id-permintaan_operasi').prop('checked', result.patient_category_id);
            $('#operation_type-permintaan_operasi').val(result.operation_type);


            tinymce.init({
                selector: '#diagnosa_desc-permintaan_operasi',
                toolbar: true,
                menubar: true,
                plugins: [],
            }).then((editors) => {
                editors[0].setContent(result.diagnosa_desc);
            });

            $('#create-modal-permintaan-operasi').on('shown.bs.modal', function() {
                let treatmentData = renderDropdownTreatment();

                $('#tarif_id-permintaan_operasi').select2({
                    data: treatmentData,
                    disabled: false,
                    dropdownParent: $('#create-modal-permintaan-operasi')
                });

                $('#tarif_id-permintaan_operasi').val(result.tarif_id).trigger('change');
            });

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
            let currentDateTime = moment(result.start_operation).format("YYYY-MM-DDTHH:mm");
            let currentDateTimeEnd = moment(result.end_operation).format("YYYY-MM-DDTHH:mm");

            $('#content-param-permintaan-operasi').html(getTemplatePermintaanOperasi(result));
            $("#formDate-tindakan-oprasi-1").html("");
            $("#create-modal-permintaan-operasi").modal("show");
            $('#btn-save-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-edit-permintaan-operasi-modal').attr('hidden', true);
            $('#btn-updateAndInsert-permintaan-operasi-modal').attr('hidden', false);


            // getTeamService({
            //     vactination_id: result.vactination_id
            // });

            // spam

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
            $('#modified_date-permintaan_operasi').val(moment(result.modified_date).format("YYYY/MM/DD HH:mm"));
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


            $("#start_operation-permintaan_operasi").val(currentDateTime);
            $("#end_operation-permintaan_operasi").val(currentDateTimeEnd);
            $('#rooms_id-permintaan_operasi').val(result.rooms_id);
            $('#clinic_id_from-permintaan_operasi').val(result.clinic_id_from);
            $('#class_room_id-permintaan_operasi').val(result.class_room_id);
            $('#patient_category_id-permintaan_operasi').prop('checked', result.patient_category_id);
            $('#operation_type-permintaan_operasi').val(result.operation_type);



            tinymce.init({
                selector: '#diagnosa_desc-permintaan_operasi',
                toolbar: true,
                menubar: true,
                plugins: [],
            }).then((editors) => {
                editors[0].setContent(result.diagnosa_desc);
            });

            $('#create-modal-permintaan-operasi').off().on('shown.bs.modal', function() {
                let treatmentData = renderDropdownTreatment();
                $('#tarif_id-permintaan_operasi').select2({
                    data: treatmentData,
                    disabled: false,
                    dropdownParent: $('#create-modal-permintaan-operasi')
                });

                $('#tarif_id-permintaan_operasi').val(result.tarif_id).trigger('change');
            });



            actionBtnUpdateAndInsert(result);
        };

        const valueCatatan = async (props) => {
            try {
                let dataHtml = '';
                let promises = [];

                props?.data.forEach((e) => {
                    promises.push(
                        getType({
                            parameter_desc: e.parameter_desc,
                            parameter_id: e.parameter_id,
                            column_name: e.column_name,
                            p_type: e.p_type,
                            code: e?.entry_type,
                            get_data: props?.get_data,
                        }).then(({
                            htmlContent,
                            initializeQuill
                        }) => {
                            return `
                        <div class="row pl-sm-0 ${e?.entry_type == 4 ? 'col-12' : 'col-6'}" id="type-container-${e.parameter_id}">
                            ${htmlContent}
                        </div>`;
                        })
                    );
                });

                const results = await Promise.all(promises);
                dataHtml = results.join('');

                const container = $(`#${props?.content_id}`);
                container.html(dataHtml);

                initializeQuillEditors();

                if ($('textarea.tinymce-init').length > 0) {
                    tinymce.remove('textarea.tinymce-init');
                    tinymce.init({
                        selector: 'textarea.tinymce-init',
                        plugins: 'lists link image',
                        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
                    });
                }
            } catch (error) {
                console.error('Error in valueCatatan:', error);
            }
        };

        const renderbodyInstrumenoprs004 = () => {
            let hasil = '';

            InstrumenValue.map((item, index) => {
                hasil += `<tr>
            <td hidden><input type="number" name="brand_id[]" value="${item?.brand_id}"/></td>
            <td>${item?.brand_name}</td>
            <td hidden><input type="text" name="brand_name[]" value="${item?.brand_name}"/></td>
            <td>${item?.quantity_before}</td>
            <td hidden><input type="number" name="quantity_before[]" value="${item?.quantity_before}"/></td>
            
            <td><input type="number" class="form-control quantity-intra" min="0" id="quantity_intra_${index}" name="quantity_intra[]" data-before="${item?.quantity_before}" value="${item?.quantity_intra || ''}" /></td>
            <td><input type="number" class="form-control quantity-additional" min="0" id="quantity_additional_${index}" name="quantity_additional[]" value="${item?.quantity_additional || ''}" /></td>
            <td><input type="number" class="form-control quantity-after" min="0" id="quantity_after_${index}" name="quantity_after[]" value="${item?.quantity_after || ''}" /></td>
            <td class="result-${index}"></td>
        </tr>`;
            });

            $("#bodyInstrumenoprs004").html(hasil);

            $("input.quantity-intra, input.quantity-additional, input.quantity-after").on('input', function() {
                updateResults();
            });

            const updateResults = () => {
                InstrumenValue.forEach((item, index) => {
                    const quantityBefore = parseFloat(item?.quantity_before) || 0;
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

            let hasil = "";
            for (const [category, tasks] of Object.entries(groupedData)) {
                hasil += `
            <div class="form-group mb-3">
                <h5 class="fw-bold">${category}</h5>
                ${tasks.map(item => `
                    <div class="d-flex align-items-center mb-2 ms-4">
                        <label class="fw-bold me-3 w-25">${item.taskName}</label>
                        <span class="w-75">${item?.doctor}</span>
                    </div>
                `).join('')}
            </div>
        `;
            }

            $(`#data-oprasi-pembedahan`).html(hasil);
        }

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

            tinymce.init({
                selector: '#riwayat_penyakit-catatan_operasi',
                readonly: true,
                toolbar: true,
                menubar: true,
                plugins: [],
            }).then((editors) => {
                editors[0]?.setContent(contentPenyakit);
            });

            tinymce.init({
                selector: '#alergi-catatan_operasi',
                readonly: true,
                toolbar: true,
                menubar: true,
                plugins: [],
            }).then((editors) => {
                editors[0]?.setContent(contentAlergi);
            });
        }

        //---------bbb
        const catatanKeperawatanPraOperasi = async (props) => {
            let visit = <?= json_encode($visit) ?>;

            postData({
                body_id: props?.vactination_id,
            }, 'admin/PatientOperationRequest/getDataAssessmentOperation', (res) => {
                getAvalueType({
                    p_type: 'OPRS003',
                    content_id: 'template-tindakan-operasi-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
                getAvalueType({
                    p_type: 'OPRS004',
                    content_id: 'cKeperawatanIntraOperatif-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
                getAvalueType({
                    p_type: 'OPRS005',
                    content_id: 'cKeperawatanPascaOperatif-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
                const xrayData = res[0]?.xray;
                if (xrayData !== undefined) {
                    $(`input[name="xray"][value="${xrayData}"]`).prop('checked', true);
                }

            });

            let oprs003 = `
                    <div class="container">
                        <div class="row">
                              
                            <div id="template-tindakan-operasi-1" class="row"></div>
                                    <div class="form-group">
                                    <label for="riwayat_penyakit-catatan_operasi">Riwayat Penyakit</label>
                                    <textarea class="form-control disabled " id="riwayat_penyakit-catatan_operasi" name="riwayat_penyakit-catatan_operasi"></textarea>
                                </div>
                                    <div class="form-group">
                                    <label for="alergi-catatan_operasi">Alergi</label>
                                    <textarea class="form-control disabled" id="alergi-catatan_operasi" name="alergi-catatan_operasi"></textarea>
                                     <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value=${props?.vactination_id ??visit?.trans_id} hidden></input>
                                     <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value=${props?.vactination_id} hidden></input>
                                     <input class="form-control disabled" id="visit_id-catatan_operasi" name="visit_id" value=${props?.visit_id??visit?.visit_id} hidden></input>
                                     <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value=${props?.org_unit_code ??visit?.org_unit_code} hidden></input>
                                     <input class="form-control disabled" id="no_registration-catatan_operasi" name="no_registration" value=${props?.no_registration ??visit?.no_registration} hidden></input>
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
                                        <th class="text-center" style="width: 20%" >Tambahan</th>
                                        <th class="text-center" style="width: 20%" >Hitungan Akhir</th>
                                        <th class="text-center" style="width: 40%" >Kesimpulan</th>
                                    </thead>
                                    <tbody id="bodyInstrumenoprs004">

                                    </tbody>
                                </table>
                            </div>
                             
                            
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label class="form-label">Jika dihitung tidak Sesuai -> X-ray</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="xray" id="xrayYes" value="1">
                                    <label class="form-check-label" for="xrayYes">
                                        Ya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="xray" id="xrayNo" value="0" checked>
                                    <label class="form-check-label" for="xrayNo">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>

                            <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value=${props?.vactination_id ??visit?.trans_id} hidden></input>
                            <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value=${props?.vactination_id} hidden></input>
                            
                             <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value=${props?.org_unit_code ??visit?.org_unit_code} hidden></input>

                                     
                    </div>
                    `;
            let oprs005 = `
                    <div class="container">
                        <div class="row">
                            <div id="cKeperawatanPascaOperatif-1" class="row"></div>
                                     <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value=${props?.vactination_id ??visit?.trans_id} hidden></input>
                                     <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value=${props?.vactination_id} hidden></input>
                                     
                                     <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value=${props?.org_unit_code ??visit?.org_unit_code} hidden></input>

                                     
                        </div>
                    </div>
                    `;
            $('#template-tindakan-operasi').html(oprs003);
            $('#cKeperawatanIntraOperatif').html(oprs004);
            $('#cKeperawatanPascaOperatif').html(oprs005);
            renderHistoryTemplate();
            btnSavepraOprasi(props)


        };

        //---------cccccccccccccccccccccccccccccccccccccccccccccc
        const checklistKeselamatan = (props) => {
            let visit = <?= json_encode($visit) ?>;
            let arr = [];
            postData({
                body_id: props?.vactination_id,
            }, 'admin/PatientOperationRequest/getDataPatientOperationCheck', (res) => {
                getAvalueType({
                    p_type: 'OPRS026',
                    content_id: 'the-sign-in-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
                getAvalueType({
                    p_type: 'OPRS027',
                    content_id: 'the-time-out-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
                getAvalueType({
                    p_type: 'OPRS028',
                    content_id: 'the-sign-out-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
            });


            let catatanSignIn = `
                    <div class="container">
                        <div class="row">
                            <div id="the-sign-in-1"></div>

                        </div>
                    </div>
                    `;
            let catatanTimeOut = `
                    <div class="container">
                        <div class="row">
                              
                            <div id="the-time-out-1"></div>

                        </div>
                    </div>
                    `;
            let catatanSignOut = `
                    <div class="container">
                        <div class="row">
                              
                            <div id="the-sign-out-1"></div>

                        </div>
                    </div>
                    `;
            $('#the-sign-in').html(catatanSignIn);
            $('#the-time-out').html(catatanTimeOut);
            $('#the-sign-out').html(catatanSignOut);

            // btnSavepraOprasi()

        };

        //---------dddddddddddddd
        const anestesi = (props) => {
            let visit = <?= json_encode($visit) ?>;
            postData({
                body_id: props?.vactination_id,
            }, 'admin/PatientOperationRequest/getDataAssessmentAnestesi', (res) => {
                getAvalueType({
                    p_type: 'OPRS007',
                    content_id: 'checklist-anestesi-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
            });
            let catatan = `
                    <div class="container">
                        <div class="row">
                              
                            <div id="checklist-anestesi-1"></div>

                        </div>
                    </div>
                    `;
            $('#ck-anestesi').html(catatan);

            // btnSavepraOprasi()

        };

        //---------eeeeeeeeeeeeeee
        const pembedahan = (props) => {
            getAvalueType({
                p_type: 'OPRS008',
                content_id: 'pembedahan-laporan-1',
                body_id: props?.vactination_id,
                get_data: pasienOperasiSelected,
            });


            let oprs008 = `
                    <div class="container">
                        <div class="row">
                            <div id="data-oprasi-pembedahan"></div>
                            <div id="pembedahan-laporan-1"></div>
                                <div class="row mb-4">
                                    <div class="table tablecustom-responsive">
                                        <h4><b>DIAGNOSA PRA BEDAH</b></h4>
                                        <hr>
                                        <table id="tablediagnosaprabedah" class="table">
                                            <thead>
                                                <th class="text-center" style="width: 40%">Diagnosa</th>
                                                <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                            </thead>
                                            <tbody id="bodyDiagPraOperation">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag" name="adddiagnosa" onclick="addRowDiagDokter('bodyDiagPraOperation', '${props?.vactination_id}')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
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
                                            <tbody id="bodyDiagPascaOperation">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag" name="adddiagnosa" onclick="addRowDiagDokter('bodyDiagPraOperation', '${props?.vactination_id}')" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                    </div>
                                </div>
                            </div>
                            <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value=${props?.vactination_id ??visit?.trans_id} hidden></input>
                            <input class="form-control disabled" id="body_id-catatan_operasi" name="vactination_id" value=${props?.vactination_id} hidden></input>
                            <input class="form-control disabled" id="visit_id-catatan_operasi" name="visit_id" value=${props?.visit_id??visit?.visit_id} hidden></input>
                            <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value=${props?.org_unit_code ??visit?.org_unit_code} hidden></input>
                        </div>
                    </div>
                    `;
            $('#pembedahan-laporan').html(oprs008);
            templateOprasiPembedahan(props)
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
                                                <label><input type="radio" name="${nameAttributeoprs008_03}" value="1" checked> Emergency</label>
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


            }, 2000);

            btnSaveLaporanPembedahan(props)
        }

        // -------------------GGGGGGGGG
        const LaporanAnesthesi = (props) => {
            let visit = <?= json_encode($visit) ?>;

            postData({
                body_id: props?.vactination_id,
            }, 'admin/PatientOperationRequest/', (res) => {
                getAvalueType({
                    p_type: 'OPRS003',
                    content_id: 'template-tindakan-operasi-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
                getAvalueType({
                    p_type: 'OPRS004',
                    content_id: 'cKeperawatanIntraOperatif-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
                getAvalueType({
                    p_type: 'OPRS005',
                    content_id: 'cKeperawatanPascaOperatif-1',
                    body_id: props?.vactination_id,
                    get_data: res[0],
                });
                const xrayData = res[0]?.xray;
                if (xrayData !== undefined) {
                    $(`input[name="xray"][value="${xrayData}"]`).prop('checked', true);
                }

            });

            let oprs003 = `
                        <div class="container">
                            <div class="row">
                                
                                <div id="template-tindakan-operasi-1"></div>
                                        <div class="form-group">
                                        <label for="riwayat_penyakit-catatan_operasi">Riwayat Penyakit</label>
                                        <textarea class="form-control disabled " id="riwayat_penyakit-catatan_operasi" name="riwayat_penyakit-catatan_operasi"></textarea>
                                    </div>
                                        <div class="form-group">
                                        <label for="alergi-catatan_operasi">Alergi</label>
                                        <textarea class="form-control disabled" id="alergi-catatan_operasi" name="alergi-catatan_operasi"></textarea>
                                        <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value=${props?.vactination_id ??visit?.trans_id} hidden></input>
                                        <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value=${props?.vactination_id} hidden></input>
                                        <input class="form-control disabled" id="visit_id-catatan_operasi" name="visit_id" value=${props?.visit_id??visit?.visit_id} hidden></input>
                                        <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value=${props?.org_unit_code ??visit?.org_unit_code} hidden></input>
                                        <input class="form-control disabled" id="no_registration-catatan_operasi" name="no_registration" value=${props?.no_registration ??visit?.no_registration} hidden></input>
                                    </div>
                            </div>
                        </div>
                        `;
            let oprs004 = `
                        <div class="container">
                            <div class="row">
                                <div id="cKeperawatanIntraOperatif-1"></div>

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
                                            <th class="text-center" style="width: 20%" >Tambahan</th>
                                            <th class="text-center" style="width: 20%" >Hitungan Akhir</th>
                                            <th class="text-center" style="width: 40%" >Kesimpulan</th>
                                        </thead>
                                        <tbody id="bodyInstrumenoprs004">

                                        </tbody>
                                    </table>
                                </div>
                                
                                
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label class="form-label">Jika dihitung tidak Sesuai -> X-ray</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="xray" id="xrayYes" value="1">
                                        <label class="form-check-label" for="xrayYes">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="xray" id="xrayNo" value="0" checked>
                                        <label class="form-check-label" for="xrayNo">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>

                                <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value=${props?.vactination_id ??visit?.trans_id} hidden></input>
                                <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value=${props?.vactination_id} hidden></input>
                                
                                <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value=${props?.org_unit_code ??visit?.org_unit_code} hidden></input>

                                        
                        </div>
                        `;
            let oprs005 = `
                    <div class="container">
                        <div class="row">
                            <div id="cKeperawatanPascaOperatif-1"></div>
                                    <input class="form-control disabled" id="trans_id-catatan_operasi" name="trans_id" value=${props?.vactination_id ??visit?.trans_id} hidden></input>
                                    <input class="form-control disabled" id="body_id-catatan_operasi" name="body_id" value=${props?.vactination_id} hidden></input>
                                    
                                    <input class="form-control disabled" id="org_unit_code-catatan_operasi" name="org_unit_code" value=${props?.org_unit_code ??visit?.org_unit_code} hidden></input>

                                    
                        </div>
                    </div>
                    `;
            $('#template-tindakan-operasi').html(oprs003);
            $('#cKeperawatanIntraOperatif').html(oprs004);
            $('#cKeperawatanPascaOperatif').html(oprs005);
            renderHistoryTemplate();
            btnSavepraOprasi(props)
        }


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
                              
                            <div id="informasi-post-operasi-1"></div>

                        </div>
                    </div>
                    `;
            $('#ck-informasi-post-operasi').html(catatan);

            // btnSavepraOprasi()

        };

        const getType = (props) => {
            return new Promise((resolve) => {
                let htmlContent = '';
                let initializeQuill = false;

                let aValue = <?= json_encode($aValue) ?>;
                // let colClass = props?.code === 4 ? 'col-12' : 'col-6';

                if ([3, 4, 7].includes(parseInt(props?.code))) {
                    let matchedData = aValue.filter(item => item.parameter_id === props?.parameter_id &&
                        item.p_type === props?.p_type);
                    let valueProp = props?.p_type === "" ? 'value_score' : 'value_id';

                    switch (parseInt(props?.code)) {
                        case 3:
                            let selectOptions = matchedData.map(item =>
                                `<option value="${item[valueProp]}" ${props?.get_data?.[props?.column_name?.toLowerCase()] === item[valueProp] ? 'selected' : ''}>${item.value_desc}</option>`
                            ).join('');
                            htmlContent = `
                        <div class="form-group mb-0 pt-4">
                            <label for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                            <select class="form-select" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.column_name?.toLowerCase()}">
                                <option value="" selected>Pilih</option>
                                ${selectOptions}
                            </select>
                        </div>
                    `;
                            break;

                        case 4:
                            initializeQuill = true; // Set flag to initialize Quill
                            htmlContent = `
                        <div class="form-group mb-5 pt-4">
                            <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                            <input type="hidden" name="${props?.column_name?.toLowerCase()}" value="${props?.get_data?.[props?.column_name?.toLowerCase()] ?? ''}">
                            <div id="quill_${props?.column_name?.toLowerCase()}_${props?.parameter_id}" class="quill-editor">${props?.get_data?.[props?.column_name?.toLowerCase()] ?? ''}</div>
                        </div>
                    `;
                            break;

                        case 7:
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
                            break;

                        default:
                            htmlContent = '';
                            break;
                    }
                } else {
                    switch (parseInt(props?.code)) {
                        case 1:
                            htmlContent = `
                        <div class="form-group mb-0 pt-4">
                            <label class="fw-bold" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                            <input type="text" class="form-control form-thems" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.column_name?.toLowerCase()}" value="${props?.get_data?.[props?.column_name?.toLowerCase()] ?? ''}">
                        </div>
                    `;
                            break;

                        case 2:
                            htmlContent = `
                        <div class="form-check mb-0 pt-4">
                            <input type="hidden" name="${props?.column_name?.toLowerCase()}" value="">
                            <input type="checkbox" class="form-check-input" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.column_name?.toLowerCase()}" value="1" ${props?.get_data?.[props?.column_name?.toLowerCase()] === '1' ? 'checked' : ''}>
                            <label class="form-check-label" for="${props?.p_type?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                        </div>
                    `;
                            break;

                        case 5:
                            htmlContent = `
                        <div class="form-group mb-0 pt-4">
                            <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                            <input class="form-control datetime-input" type="datetime-local" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.column_name?.toLowerCase()}" value="${props?.get_data?.[props?.column_name?.toLowerCase()] ? moment(props?.get_data?.[props?.column_name?.toLowerCase()], "YYYY-MM-DDTHH:mm").format("YYYY-MM-DDTHH:mm") : ''}">
                        </div>
                    `;
                            break;

                        case 6:
                            htmlContent = `
                        <div class="form-group mb-0 pt-4">
                            <label class="fw-bold" for="${props?.column_name?.toLowerCase()}_${props?.parameter_id}">${props?.parameter_desc}</label>
                            <textarea class="form-control" id="${props?.p_type?.toLowerCase()}_${props?.parameter_id}" name="${props?.column_name?.toLowerCase()}">${props?.get_data?.[props?.column_name?.toLowerCase()] ?? ''}</textarea>
                        </div>
                    `;
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
                        // Initialize Quill editor with existing content
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

            // Clear the existing content
            $("#dropdown-param-tindakan-operasi").html('');
            // const taskIds = props?.map(item => item.task_id);
            // const employeeIds = props?.map(item => item.employee_id);
            // taskIds.unshift()
            const employeeOptions = getDropdownOptions(getShiftIdForDropdown(name));

            let droppdown = `
                <table class="table table-borderless" id="data-dropdown">
                    ${props?.map(e => `
                        <tr class="bg-light">
                            <td>
                                <select class="form-select task-dropdown" name="groupedTasks_option[]">
                                    ${tasksValue.data.map(item => `<option value="${item.task_id}" ${item.task_id == e.task_id ? 'selected' :''}>${item.task}</option>`)}
                                </select>
                            </td>
                            <td rowspan="2" width="1%">
                                <button type="button" class="btn btn-danger btn-sm delete-dropdown" style="height:80px;width:50px;"><i class="fas fa-trash-alt fa-2xl"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-select employee-dropdown" name="employee_option[]">
                            ${employesValue.data.map(item => `<option value="${item.employee_id}" ${item.employee_id == e.employee_id ? 'selected' :''}>${item.fullname}</option>`)}
                                </select>
                            </td>
                        </tr>
                    `).join('')}
                        <tr class="bg-light">
                            <td>
                                <select class="form-select task-dropdown" name="groupedTasks_option[]">
                                    <option>pilih</option>
                                    ${tasksValue.data.map(item => `<option value="${item.task_id}">${item.task}</option>`)}
                                </select>
                            </td>
                            <td rowspan="2" width="1%">
                                <button type="button" class="btn btn-danger btn-sm delete-dropdown" style="height:80px;width:50px;"><i class="fas fa-trash-alt fa-2xl"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-select employee-dropdown" name="employee_option[]">
                                    <option>pilih</option>
                                    ${employesValue.data.map(item => `<option value="${item.employee_id}">${item.fullname}</option>`)}
                                </select>
                            </td>
                        </tr>
                </table>
                <div class="d-flex my-3">
                    <button type="button" class="btn btn-success w-100 add-dropdown" style="height:50px;"><i class="fas fa-plus fa-2xl"></i></button>
                </div>
            `;

            // Additional form contents
            let contentFormEsekusi =
                `<table class="table table-borderless">
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
            let TransaksiContent =
                `<table class="table table-borderless">
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

            // Update the content of the container
            $("#dropdown-param-tindakan-operasi").html(content + droppdown + contentFormEsekusi +
                TransaksiContent);
            // actionDropdownContentTindakan();
            $('#dropdown-param-tindakan-operasi').on('click', '.delete-dropdown', function() {
                $(this).closest('tr').next().remove(); // Remove the previous row
                $(this).closest('tr').remove(); // Remove the current row
            });

            // Add button click event handler
            $('#dropdown-param-tindakan-operasi').on('click', '.add-dropdown', function() {
                // Clone the task row (first part of the template)
                let dataDropdownContent =
                    `
                        <tr class="bg-light">
                            <td>
                                <select class="form-select task-dropdown" name="groupedTasks_option[]">
                                    <option>pilih</option>
                                    ${tasksValue.data.map(item => `<option value="${item.task_id}">${item.task}</option>`)}
                                </select>
                            </td>
                            <td rowspan="2" width="1%">
                                <button type="button" class="btn btn-danger btn-sm delete-dropdown" style="height:80px;width:50px;"><i class="fas fa-trash-alt fa-2xl"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-select employee-dropdown" name="employee_option[]">
                                    <option>pilih</option>
                                    ${employesValue.data.map(item => `<option value="${item.employee_id}">${item.fullname}</option>`)}
                                </select>
                            </td>
                        </tr>
                `;
                $('#data-dropdown tbody').append(dataDropdownContent);
                // Optional: Reinitialize select2 for newly added elements
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
                    options += `<option value="${employee.employee_id}">${employee.fullname}</option>`;
                }
            });

            return `<option selected disabled value="">Pilih</option>` + options;
        };

        const renderDataRequestOperation = (data) => {
            let hasil = "";
            data?.data?.map((item, index) => {
                let treatment = treatmentData.find(t => t.tarif_id === item?.tarif_id);
                let treatmentName = treatment ? treatment.tarif_name : "-";
                hasil += `<tr>
                <td>${index + 1}</td>
                <td>${moment(item?.start_operation).format("DD/MM/YYYY HH:mm")}</td>
                <td class="operation_action cursor-pointer pointer" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}">${treatmentName}</td>
                <td>${item?.doctor ?? "-"}</td>
                <td>
                    ${item?.terlayani === 0 ? `
                        <button type="button" class="btn btn-sm btn-info btn-show-detail-requestOperation" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                           <i class="far fa-eye"></i> Lihat
                        </button>
                        <button type="button" class="btn btn-sm btn-primary btn-show-edit-requestOperation" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                          <i class="far fa-edit"></i> Ubah
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btn-show-delete-requestOperation" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                          <i class="far fa-trash-alt"></i> Hapus
                        </button>
                        <button type="button" class="btn btn-sm btn-success btn-show-assesment-requestOperation" data-date="${moment(item?.start_operation).format("DD/MM/YYYY HH:mm")}" data-treatname="${treatmentName}" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                           <i class="far fa-file-alt"></i> Asssesment
                        </button>
                        ` : `
                        <button type="button" class="btn btn-sm btn-info btn-show-detail-requestOperation" data-noregis="${item?.no_registration}"  data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                            <i class="far fa-eye"></i> Lihat
                        </button>
                        <button type="button" class="btn btn-sm btn-success btn-show-assesment-requestOperation" data-date="${moment(item?.start_operation).format("DD/MM/YYYY HH:mm")}" data-treatname="${treatmentName}" data-noregis="${item?.no_registration}" id="${item?.vactination_id}" data-id="${item?.vactination_id}" data-visit_id="${item?.visit_id}" data-index="${index}">
                           <i class="far fa-file-alt"></i> Asssesment
                        </button>
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
            postData({
                vactination_id: props?.vactination_id
            }, 'admin/PatientOperationRequest/getDataTim', (res) => {
                if (res.response) {
                    getDataList('admin/PatientOperationRequest/getDropdowntempAll', (labelRes) => {
                        renderDataTeamInPembedahan({
                            data: res?.data,
                            labels: labelRes?.data
                        });
                    });
                }
            });
        }

        const getInstrumen = (props) => {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/PatientOperationRequest/getDataInstrumen',
                type: "POST",
                data: JSON.stringify({
                    'body_id': props?.vactination_id,
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    let tableInstrumen = $("#get-data-instrumen").html("");
                    dataInstrumen = data
                    $("#body-instrumen").html("")

                    dataInstrumen.forEach((element, key) => {
                        addRowInstrumen(element)
                        tableInstrumen.append(
                            `<tr>
                                <td class="text-center">${key+1}</td>
                                <td class="text-center">${element?.brand_name}</td>
                                <td class="text-center">${element?.quantity_before}</td>
                                <td class="text-center">${element?.quantity_intra}</td>
                                <td class="text-center">${element?.quantity_additional}</td>
                                <td class="text-center">${element?.quantity_after}</td>
                            </tr>`)
                    });
                },
                error: function() {

                }
            });
        }

        const getDataInstrumenoprs = (props) => {
            postData({
                body_id: props?.vactination_id
            }, 'admin/PatientOperationRequest/getDataInstrumen', (res) => {
                InstrumenValue = res
                renderbodyInstrumenoprs004();
            })

        }

        const getAvalueType = (props) => {

            let aParameter = <?= json_encode($aParameter) ?>;

            let filteredData = aParameter.filter(item => item.p_type === props?.p_type);

            valueCatatan({
                data: filteredData,
                content_id: props?.content_id,
                get_data: props?.get_data
            });
        };

        const getDataMental = () => {
            postData({
                    parameter_id: '01'
                }, 'admin/PatientOperationRequest/getPasienOprasiValue',
                (res) => {
                    if (res) {
                        let data = ''
                        res.map(item => {
                            data += `<option value="${item?.value_id}">${item?.value_desc}</option>`
                        })
                        $("#status_mental-catatan_operasi").html(`<option selected>Pilih</option>` + data)
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

            // getDataList(
            //     'admin/PatientOperationRequest/getDropdowntempAll',
            //     (res) => {
            //         if (res.response) {
            //             tasksValue = res
            //             window.groupedTasks = groupTasks(res.data);
            //         } else {
            //             console.error('Failed to fetch dropdown data.');
            //         }
            //     }
            // );

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
                                    }, 'admin/PatientOperationRequest/getDataTim', (res) => {
                                        if (res.response) {
                                            createDropdownTables(res.data);
                                            $('#transaksi-permintaan_operasi').val(props
                                                ?.transaksi);
                                            $("#form-action-pelayanan").val(props?.terlayani);
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
                    tinymce.remove();
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
                    tinymce.remove();
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
                    tinymce.remove();
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




    })()
</script>
<?php
echo view('admin/patient/profilemodul/operasi/js/praoperasi_js', [
    'visit' => $visit,
    'aParent' => $aParent,
    'aType' => $aType,
    'aParameter' => $aParameter,
    'aValue' => $aValue,
]);
?>