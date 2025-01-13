<script type="text/javascript">
(function() {
    let categoryVal = []
    let beratBadanInfo = []
    $(document).ready(function() {
        let visit = <?= json_encode($visit) ?>;
        const StartToday = moment(visit?.visit_date).format("DD/MM/YYYY");
        const today = moment(new Date()).format("DD/MM/YYYY");
        const startDate = $('#startDateCairan').val(StartToday);
        const endDate = $('#endDateCairan').val(today);
        getCairanGen0023()
        $("#close-cairan-modal").off().on("click", (e) => {

            e.preventDefault();
            $("#create-modal-cairan-gen0023").modal("hide");
        });
    });

    const convertCairanDate1 = (dateString) => {
        const formats = ["YYYY-MM-DD", "DD/MM/YYYY", "YYYY-MM-DD HH:mm", "DD/MM/YYYY HH:mm"];
        const parsedDate = moment(dateString, formats, true);
        if (parsedDate.isValid()) {
            return parsedDate.format("YYYY-MM-DD");
        } else {
            return null;
        }
    };

    const getCairanGen0023 = () => {
        $("#cairanTab").off().on("click", function(e) {
            getRequestData0023()
            getCategoryCairan()
        });

        $("#btn-print-cairangen0023").off().on("click", function(e) {
            let visit = <?= json_encode($visit) ?>;

            const formattedStartDate = convertCairanDate1($('#startDateCairan').val());
            const formattedEndDate = convertCairanDate1($('#endDateCairan').val());

            const start = formattedStartDate ? `${formattedStartDate} 00:00:01` : null;
            const end = formattedEndDate ? `${formattedEndDate} 23:59:59` : null;

            cetakCairan({
                visit_id: visit?.visit_id,
                start: start,
                end: end
            });
        });

        $("#add-cairan-gen0023").off().on("click", (e) => {
            e.preventDefault();
            getParameterGen0023()
            $('#btn-save-gen0023-modal').removeAttr('hidden');
            $("#create-modal-cairan-gen0023").modal("show");
        });

        $("#btn-search-cairangen0023").off().on("click", function(e) {
            const startDate = $('#startDateCairan').val();
            const endDate = $('#endDateCairan').val();

            const formattedStartDate = convertCairanDate1(startDate);
            const formattedEndDate = convertCairanDate1(endDate);

            const start = formattedStartDate ? `${formattedStartDate} 00:00:01` : null;
            const end = formattedEndDate ? `${formattedEndDate} 23:59:59` : null;

            getRequestData0023({
                start: start,
                end: end
            });

        });

    };

    const getRequestData0023 = (props) => {
        let visit = <?= json_encode($visit) ?>;
        postData({
            id: visit?.visit_id,
            startDate: props?.start ?? "",
            endDate: props?.end ?? ""
        }, 'admin/cairan/getData', (res) => {
            beratBadanInfo = res?.exam
            if (res?.data.length > 0) {
                renderTableCairan(res?.data);
            } else {
                // $("#btn-print-cairangen0023").attr("disabled", true)
                $("#bodydatagen0023").html(tempTablesNull());
            }
        }, (beforesend) => {
            getLoadingGlobalServices('bodydatagen0023');
        });
    };

    const getCategoryCairan = (props) => {
        let visit = <?= json_encode($visit) ?>;

        getDataList('admin/cairan/getCategory', (res) => {
            categoryVal = res?.value.data
        })
    };

    const cetakCairan = (props) => {

        let visit = <?= json_encode($visit) ?>;
        let start_date = props?.start
        let end_date = props?.end


        let RequestCentak = {
            id: visit?.visit_id,
            startDate: props?.start ?? "",
            endDate: props?.end ?? "",
            visit: visit
        };

        let baseUrl = '<?= base_url() ?>';
        let jsonStr = JSON.stringify(RequestCentak);
        let base64Data = btoa(jsonStr);
        let url = baseUrl + 'admin/cetak/cairan_cetak/' + base64Data
        window.open(url, "_blank");

    }

    const renderTableCairan = (data) => {

        let aValue = <?= json_encode($aValue) ?>;
        let filteredDataValue = aValue?.filter(item => item?.p_type === "GEN0023");
        let dataRender = '';

        data.map((item, index) => {
            let resultType = filteredDataValue.find(e => e?.value_id === item?.fluid_type);
            let valueDesc = resultType?.value_desc || '';

            let editButton =
                `<?php if (user()->checkPermission("asuhancairan", 'c')&& user()->checkRoles(['superuser', 'admin', 'perawat']) ) : ?>` +
                `<button class="btn btn-secondary  edit-btn" data-id="${item.body_id}" data-item='${JSON.stringify(item)}'>Edit</button>` +
                `<?php endif; ?>`;

            let deleteButton =
                `<?php if (user()->checkPermission("asuhancairan", 'c')&& user()->checkRoles(['superuser', 'admin', 'perawat'])): ?>` +
                `<button class="btn btn-danger delete-btn btn-show-delete-requestcairan" data-id="${item.body_id}">Delete</button>` +
                `<?php endif; ?>`;

            dataRender += `<tr>
                        <td>${moment(item.examination_date).format("DD/MM/YYYY HH:mm")}</td>
                        <td>${valueDesc}</td>
                        <td>
                            ${editButton}
                            ${deleteButton}
                        </td>
                    </tr>`;
        })

        if ($.fn.DataTable.isDataTable('#tableDat-cairan0023')) {
            $('#tableDat-cairan0023').DataTable().destroy();
        }
        $("#bodydatagen0023").html(dataRender);
        let groupColumn = 0;
        let table = $('#tableDat-cairan0023').DataTable({
            dom: '<"mb-3">rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
            lengthChange: true,
            ordering: false,
            order: [
                [groupColumn, 'asc']
            ],
            lengthMenu: [
                [10],
                [10]
            ],
            displayLength: 10,
            buttons: [], // Tidak ada tombol di sini
            drawCallback: function(settings) {
                let api = this.api();
                let rows = api.rows({
                    page: 'current'
                }).nodes();
                let last = null;

                api.column(groupColumn, {
                        page: 'current'
                    })
                    .data()
                    .each(function(dateString, i) {
                        let [datePart, timePart] = dateString?.split(' ');
                        let [day, month, year] = datePart?.split('/');
                        let date = new Date(year, month - 1, day, ...timePart.split(':'));
                        let formattedDate = moment(date).format("DD-MM-YYYY HH");

                        if (last !== formattedDate) {
                            $(rows)
                                .eq(i)
                                .before(
                                    '<tr class="group"><th colspan="4">' +
                                    formattedDate.replace('T', ' ') +
                                    '</th></tr>'
                                );
                            last = formattedDate;
                        }
                    });
            }
        });


        $('#tableDat-cairan0023 tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                table.order([groupColumn, 'desc']).draw();
            } else {
                table.order([groupColumn, 'asc']).draw();
            }
        });

        $("#bodydatagen0023").off("click", ".edit-btn").on("click", ".edit-btn", function() {
            const id = $(this).data("id");
            const item = $(this).data("item");

            getParameterGen0023(item);
            $("#create-modal-cairan-gen0023").modal("show");
        });

        $("#bodydatagen0023").off("click", ".delete-btn").on("click", ".delete-btn", function() {
            const id = $(this).data("id");
            deleteModalDataRequestCairan(id);
        });
    };

    const deleteModalDataRequestCairan = (body_id) => {
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
                deleteActionRequestCairan({
                    body_id: body_id,
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Dibatalkan",
                    text: "File Anda aman :)",
                    icon: "error"
                });
            }
        });
    };

    const deleteActionRequestCairan = (props) => {
        postData({
            body_id: props?.body_id,
        }, 'admin/cairan/deleteData', (res) => {
            if (res.respon === true) {
                getRequestData0023()
                successSwal('Data berhasil Dihapus.');
            } else {
                errorSwal("Gagal Di hapus")
            }
        });
    }

    const getParameterGen0023 = (item) => {
        let aParameter = <?= json_encode($aParameter ?? []) ?>;
        let aValue = <?= json_encode($aValue ?? []) ?>;
        let visit = <?= json_encode($visit ?? []) ?>;

        let filteredDataParameter = Array.isArray(aParameter) ?
            aParameter.filter(param => param?.p_type === "GEN0023") : [];

        let filteredDataValue = Array.isArray(aValue) ?
            aValue.filter(value => value?.p_type === "GEN0023") : [];

        let groupedValues = {
            0: [],
            1: [],
            2: [],
            3: []
        };

        filteredDataValue.forEach(value => {
            let balanceType;
            switch (value.value_id) {
                case 'G0230301':
                case 'G0230302':
                case 'G0230309':
                    balanceType = 0; // Cairan Masuk
                    break;
                case 'G0230303':
                case 'G0230304':
                case 'G0230305':
                case 'G0230306':
                case 'G0230307':
                case 'G0230308':
                    balanceType = 1; // Cairan Keluar
                    break;
                case 'G0230310':
                    balanceType = 3; // Transfusi
                    break;
                default:
                    balanceType = null;
            }

            if (balanceType !== null) {
                groupedValues[balanceType].push(value);
            }
        });

        let content = '';
        console.log(item?.examination_date ?
            moment(item.examination_date).format("DD/MM/YYYY HH:mm") :
            moment(new Date()).format("DD/MM/YYYY HH:mm"));

        let formattedExaminationDate = item?.examination_date ?
            moment(item.examination_date).format("DD/MM/YYYY HH:mm") :
            moment(new Date()).format("DD/MM/YYYY HH:mm");

        content += `<div class="mb-3">
                            <label for="flatDateInput" class="form-label">Tanggal dan jam</label>
                            <input class="form-control" type="hidden" id="0023org_unit_code" name="org_unit_code" value="${visit?.org_unit_code || ''}">
                            <input class="form-control" type="hidden" id="0023visit_id" name="visit_id" value="${visit?.visit_id || ''}">
                            <input class="form-control" type="hidden" id="0023trans_id" name="trans_id" value="${visit?.trans_id || ''}">
                            <input class="form-control" type="hidden" id="0023body_id" name="body_id" value="${item?.body_id || get_bodyid()}">
                            <input class="form-control" type="hidden" id="0023p_type" name="p_type" value="GEN0023">
                            <input class="form-control" type="hidden" id="0023no_registration" name="no_registration" value="${visit?.no_registration || ''}">
                            <input class="form-control datetime-input" type="hidden" id="Inputexamination_date" name="examination_date" value="${formattedExaminationDate}">
                            <input class="form-control datetimeflatpickr" type="text" id="flatInputexamination_date" value="${formattedExaminationDate}">
                        </div>`;

        filteredDataParameter.forEach(param => {
            let paramId = `param_${param.parameter_id}_${param.p_type}`;
            let options = '';

            if (param.entry_type === 3) {
                if (param.parameter_id === "03") {
                    for (const [type, values] of Object.entries(groupedValues)) {
                        if (values.length > 0) {
                            let groupLabel;
                            switch (type) {
                                case '0':
                                    groupLabel = 'Cairan Masuk';
                                    break;
                                case '1':
                                    groupLabel = 'Cairan Keluar';
                                    break;
                                case '2':
                                    groupLabel = 'Infus';
                                    break;
                                case '3':
                                    groupLabel = 'Transfusi';
                                    break;
                            }

                            options += `<optgroup label="${groupLabel}">` +
                                values.map(value =>
                                    `<option value="${value.value_id}" data-balanceType="${type}" ${item?.[param.column_name?.toLowerCase()] === value.value_id ? 'selected' : ''}>${value.value_desc}</option>`
                                ).join('') +
                                `</optgroup>`;
                        }
                    }
                    if (item?. [param.column_name?.toLowerCase()] === "G0230302") {
                        setTimeout(() => {
                            $("#param_03_GEN0023").trigger("change")
                            $("#param_03A_GEN0023").val(item?.fluid_category)

                        }, 200);


                    }

                    const shouldShow03A = ['G0230301', 'G0230302', 'G0230309', 'G0230304'].includes(item
                        ?. [param.column_name?.toLowerCase()]);
                    if (shouldShow03A) {
                        $('#param_03A_GEN0023-content').show();
                    } else {
                        $('#param_03A_GEN0023-content').hide();
                    }

                    content += `<div class="mb-3" id="${paramId}-content">
                                    <label for="${paramId}" class="form-label">${param.parameter_desc}</label>
                                    <select id="${paramId}" class="form-select" name="${param.column_name?.toLowerCase()}">
                                        <option value="">Pilih ${param.parameter_desc}</option>
                                        ${options}
                                    </select>
                                </div>`;

                } else if (param.parameter_id === "07" || param.parameter_id === "03A") {
                    const selectedValueIdParam03 = $("#param_03_GEN0023").val();
                    options = categoryVal
                        .filter(value => value.value_id === item?.fluid_type)
                        .map(value =>
                            `<option value="${value.balance_category_id}" ${item?.[param.column_name?.toLowerCase()] === value.balance_category_id ? 'selected' : ''}>${value.balance_category}</option>`
                        ).join('');

                    content += `<div class="mb-3" id="${paramId}-content">
                                    <label for="${paramId}" class="form-label">${param.parameter_desc}</label>
                                    <select id="${paramId}" class="form-select" name="${param.column_name?.toLowerCase()}">
                                        <option value="">Pilih ${param.parameter_desc}</option>
                                        ${options}
                                    </select>
                                </div>`;

                } else {
                    options = filteredDataValue
                        .filter(value => value.parameter_id === param.parameter_id)
                        .map(value =>
                            `<option value="${value.value_id}" ${item?.[param.column_name?.toLowerCase()] === value.value_id ? 'selected' : ''}>${value.value_desc}</option>`
                        ).join('');

                    content += `<div class="mb-3" id="${paramId}-content" style="display: none;">
                                    <label for="${paramId}" class="form-label">${param.parameter_desc}</label>
                                    <select id="${paramId}" class="form-select" name="${param.column_name?.toLowerCase()}">
                                        <option value="">Pilih ${param.parameter_desc}</option>
                                        ${options}
                                    </select>
                                </div>`;
                }

            } else if (param.entry_type === 1) {
                if (param.parameter_id === "02") {
                    const balanceTypeValue = item?.balance_type || '';
                    content +=
                        `<input type="hidden" id="balance_type_${param.parameter_id}_${param.p_type}" name="balance_type" value="${balanceTypeValue}">`;
                } else if (["04", "01"].includes(param.parameter_id)) {
                    if (param?.parameter_id === "01") {
                        content += `<div class="mb-3" id="${paramId}-content">
                                    <label for="${paramId}" class="form-label">${param.parameter_desc}</label>
                                    <input type="number" id="${paramId}" name="${param.column_name?.toLowerCase()}" class="form-control" placeholder="${param.parameter_desc}" value="${item?.[param.column_name?.toLowerCase()] || parseInt(beratBadanInfo?.weight ?? 0)}">
                                </div>`;
                    } else {

                        content += `<div class="mb-3" id="${paramId}-content">
                                        <label for="${paramId}" class="form-label">${param.parameter_desc}</label>
                                        <input type="number" id="${paramId}" name="${param.column_name?.toLowerCase()}" class="form-control" placeholder="${param.parameter_desc}" value="${item?.[param.column_name?.toLowerCase()] || 0}">
                                    </div>`;
                    }
                } else {
                    content += `<div class="mb-3" id="${paramId}-content" style="display: none;">
                                    <label for="${paramId}" class="form-label">${param.parameter_desc}</label>
                                    <input type="number" id="${paramId}" name="${param.column_name?.toLowerCase()}" class="form-control" placeholder="${param.parameter_desc}" value="${item?.[param.column_name?.toLowerCase()] || 0}">
                                </div>`;
                }
            }
        });



        document.getElementById('dokument-gen0023').innerHTML = content;

        $("#param_03_GEN0023").on('change', function() {
            const selectedValueIdParam03 = $(this).val();

            if (selectedValueIdParam03 === 'G0230302') {
                $('#param_05_GEN0023-content').show();
                $('#param_06_GEN0023-content').show();
            } else {
                $('#param_05_GEN0023-content').hide();
                $('#param_06_GEN0023-content').hide();
                $('#param_03A_GEN0023-content').hide();
            }

            if (['G0230301', 'G0230302', 'G0230309', 'G0230304'].includes(selectedValueIdParam03)) {
                $('#param_03A_GEN0023-content').show();
            } else {
                $('#param_03A_GEN0023-content').hide();
            }

            $('#param_03A_GEN0023').empty();

            const filteredOptionsForParam07 = categoryVal
                .filter(value => value.value_id === selectedValueIdParam03)
                .map(value =>
                    `<option value="${value.balance_category_id}" ${item?.selected_category_id === value.balance_category_id ? 'selected' : ''}>${value.balance_category}</option>`
                ).join('');

            $('#param_03A_GEN0023').html(`
                    <option value="">Pilih</option>
                    ${filteredOptionsForParam07}
                `);
        });


        initializeFlatpickrCairan();
        btnSaveActionGen0023();
    };

    const initializeFlatpickrCairan = () => {
        flatpickr(".datetimeflatpickr", {
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            time_24hr: true,
        });

        $(".datetimeflatpickr").prop("readonly", false);

        $(".datetimeflatpickr").each(function() {
            if (!$(this).val()) {
                const defaultDate = moment().format("DD/MM/YYYY HH:mm");
                $(this).val(defaultDate).trigger("change");
            }
        });

        $(".datetimeflatpickr").on("change", function() {
            let theid = $(this).attr("id");
            theid = theid?.replace("flat", "");
            let thevalue = $(this).val();

            if (moment(thevalue, "DD/MM/YYYY HH:mm", true).isValid()) {
                let formattedDate = moment(thevalue, "DD/MM/YYYY HH:mm").format("YYYY-MM-DD HH:mm");
                $("#" + theid).val(formattedDate);
            }
        });
    };


    const btnSaveActionGen0023 = () => {
        $("#btn-save-gen0023-modal").off().on("click", function(e) {
            e.preventDefault();

            let formElement = document.getElementById('formDokument-gen0023');
            if (!formElement.checkValidity()) {
                formElement.reportValidity(); // Show validation error messages
                return; // Prevent the function from proceeding if validation fails
            }
            let dataSend = new FormData(formElement);
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                if (key === 'examination_date' && value) {
                    const date = new Date(value);
                    const formattedDate = moment(value, ["DD/MM/YYYY HH:mm",
                        "YYYY-MM-DD HH:mm"
                    ]).format(
                        "YYYY-MM-DD HH:mm")
                    jsonObj[key] = formattedDate;
                } else {
                    jsonObj[key] = value;
                }
            });

            postData(jsonObj, 'admin/cairan/insertData', (res) => {
                if (res.respon === true) {
                    getRequestData0023()
                    successSwal('Data berhasil disimpan.');
                    $("#create-modal-cairan-gen0023").modal("hide");
                    $('#formDokument-gen0023')[0].reset();
                }
            });
        });
    };



})()
</script>