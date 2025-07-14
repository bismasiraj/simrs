<script type="text/javascript">
    (function() {
        let categoryVal = []
        let beratBadanInfo = []
        $(document).ready(function() {
            getCairanGen0023()

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

        const convertCairanDateTime = (dateString) => {
            const formats = ["YYYY-MM-DD", "DD/MM/YYYY", "YYYY-MM-DD HH:mm", "DD/MM/YYYY HH:mm"];
            const parsedDate = moment(dateString, formats, true);
            if (parsedDate.isValid()) {
                return parsedDate.format("YYYY-MM-DD HH:mm");
            } else {
                return null;
            }
        };

        const getCairanGen0023 = () => {
            $("#cairanTab").off().on("click", function(e) {
                getRequestData0023()
                getCategoryCairan()
                const StartToday = moment(visit?.visit_date).format("DD/MM/YYYY");
                const today = moment(new Date()).format("DD/MM/YYYY HH:mm");
                const startDate = $('#startDateCairan').val(StartToday);
                const endDate = $('#endDateCairan').val(today);
                initializeFlatpickrCairan()
                $("#close-cairan-modal").off().on("click", (e) => {

                    e.preventDefault();
                    $("#create-modal-cairan-gen0023").modal("hide");
                });
            });

            let visit_cairan = visit

            $("#btn-print-cairangen0023").off().on("click", function(e) {
                let visit = visit_cairan

                const formattedStartDate = convertCairanDate1($('#startDateCairan').val());
                const formattedEndDate = convertCairanDate1($('#endDateCairan').val());

                const start = formattedStartDate ? `${formattedStartDate} 00:00:01` : null;
                const end = formattedEndDate ? `${formattedEndDate} 23:59:59` : null;

                cetakCairan({
                    visit_id: visit?.visit_id,
                    start: start,
                    end: end,
                    action: "cetak"
                });
            });
            $("#btn-print-monitoring-infus").off().on("click", function(e) {
                let visit = visit_cairan

                const formattedStartDate = convertCairanDate1($('#startDateCairan').val());
                const formattedEndDate = convertCairanDate1($('#endDateCairan').val());

                const start = formattedStartDate ? `${formattedStartDate} 00:00:01` : null;
                const end = formattedEndDate ? `${formattedEndDate} 23:59:59` : null;

                cetakCairanInfus({
                    visit_id: visit?.visit_id,
                    start: start,
                    end: end,
                    action: "cetak"
                });
            });

            //new
            $("#btn-print-priview-cairangen0023").off().on("click", function(e) {
                let visit = visit_cairan

                const formattedStartDate = convertCairanDateTime($('#startDateCairan').val());
                const formattedEndDate = convertCairanDateTime($('#endDateCairan').val());


                cetakCairan({
                    visit_id: visit?.visit_id,
                    start: formattedStartDate ?? null,
                    end: formattedEndDate ?? null,
                    action: "iwl"
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

                const formattedStartDate = convertCairanDateTime(startDate);
                const formattedEndDate = convertCairanDateTime(endDate);


                const start = formattedStartDate ? `${formattedStartDate}` : null;
                const end = formattedEndDate ? `${formattedEndDate}` : null;

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

            $('#btn-print-priview-cairangen0023').attr('hidden', true);
        };

        const getCategoryCairan = (props) => {
            let visit = <?= json_encode($visit) ?>;

            getDataList('admin/cairan/getCategory', (res) => {
                // categoryVal = res?.value.data
                categoryVal = [{
                        "balance_category_id": "Hijau",
                        "value_id": "G0230304",
                        "balance_category": "Hijau"
                    },
                    {
                        "balance_category_id": "Infus",
                        "value_id": "G0230302",
                        "balance_category": "Infus"
                    },
                    {
                        "balance_category_id": "Kuning",
                        "value_id": "G0230304",
                        "balance_category": "Kuning"
                    },
                    {
                        "balance_category_id": "Makanan",
                        "value_id": "G0230309",
                        "balance_category": "Makanan"
                    },
                    {
                        "balance_category_id": "Merah",
                        "value_id": "G0230304",
                        "balance_category": "Merah"
                    },
                    {
                        "balance_category_id": "Minuman",
                        "value_id": "G0230309",
                        "balance_category": "Minuman"
                    },
                    {
                        "balance_category_id": "Sonde",
                        "value_id": "G0230309",
                        "balance_category": "Sonde"
                    },
                    {
                        "balance_category_id": "Transfusi",
                        "value_id": "G0230302",
                        "balance_category": "Transfusi"
                    },
                    {
                        "balance_category_id": "Obat",
                        "value_id": "G0230302",
                        "balance_category": "Obat"
                    }
                ]


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
            let url = baseUrl + 'admin/cetak/cairan_cetak/' + base64Data + `/${props?.action}`
            window.open(url, "_blank");

        }
        const cetakCairanInfus = (props) => {
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
            let url = baseUrl + 'admin/cetak/monitoring_infus/' + base64Data + `/${props?.action}`
            window.open(url, "_blank");

        }


        const renderTableCairan = (data) => {
            let age_konstaIwl = Math.floor(
                (new Date().getFullYear() - new Date(visit?.tgl_lahir).getFullYear()) * 12 +
                (new Date().getMonth() - new Date(visit?.tgl_lahir).getMonth())
            );

            let konsta_iwl;
            if (age_konstaIwl <= 1) {
                konsta_iwl = 50;
            } else if (age_konstaIwl <= 12) {
                konsta_iwl = 40;
            } else if (age_konstaIwl <= 60) {
                konsta_iwl = 30;
            } else if (age_konstaIwl <= 120) {
                konsta_iwl = 20;
            } else {
                konsta_iwl = 10;
            }
            let weight_iwl;
            if (data) {
                weight_iwl = parseInt(data[0]?.awareness, 10);
            }


            const validFluidTypesIn = ["G0230301", "G0230302", "G0230309"];
            const totalfluidIn = data.reduce((total, item) => {
                if (validFluidTypesIn.includes(item.fluid_type)) {
                    return total + item.fluid_amount;
                }
                return total;
            }, 0);

            const validFluidTypesOut = ["G0230303", "G0230304", "G0230305", "G0230306", "G0230307", "G0230308"];
            const totalfluidOut = data.reduce((total, item) => {
                if (validFluidTypesOut.includes(item.fluid_type)) {
                    return total + item.fluid_amount;
                }
                return total;
            }, 0);

            const validFluidUrineOut = ["G0230303"];
            const urineTotalOut = data.reduce((total, item) => {
                if (validFluidUrineOut.includes(item.fluid_type)) {
                    return total + item.fluid_amount;
                }
                return total;
            }, 0);

            let dataiwl24 = (weight_iwl * konsta_iwl) / 24 || 0;

            let startIwl = $("#startDateCairan").val()
            let endIwl = $("#endDateCairan").val()
            const startDate = new Date(convertCairanDateTime(startIwl));
            const endDate = new Date(convertCairanDateTime(endIwl));
            const timeDifference = endDate - startDate;


            const hoursDifference = timeDifference / (1000 * 60 * 60);

            let resultiwlShiftDate = (dataiwl24 * hoursDifference).toFixed(2);

            let resultbc = (totalfluidIn - (totalfluidOut + hoursDifference)).toFixed(2);
            console.log(urineTotalOut, weight_iwl, hoursDifference);

            let resultDiuresis = (urineTotalOut / weight_iwl / hoursDifference || 0).toFixed(2);

            let iwl;
            if (hoursDifference < 24) {
                $('#btn-print-priview-cairangen0023').attr('hidden', false);
                const resultIwlData = data.filter(item =>
                    item.fluid_type === "G0230308" &&
                    moment(item.examination_date).format("DD/MM/YYYY HH") === moment(startIwl,
                        "DD/MM/YYYY HH:mm").format("DD/MM/YYYY HH") &&
                    moment(item.iwl_time).format("DD/MM/YYYY HH") === moment(endIwl,
                        "DD/MM/YYYY HH:mm").format("DD/MM/YYYY HH")
                );

                let iwlResult = resultIwlData[0]
                let body_idNewIwl = get_bodyid();

                let dataUpdateResultChange = {
                    org_unit_code: iwlResult?.org_unit_code ?? visit?.org_unit_code,
                    visit_id: iwlResult?.visit_id ?? visit?.visit_id,
                    trans_id: iwlResult?.trans_id ?? visit?.trans_id,
                    body_id: iwlResult?.body_id ?? body_idNewIwl,
                    p_type: iwlResult?.p_type ?? "GEN0023",
                    no_registration: iwlResult?.no_registration ?? visit?.no_registration,
                    examination_date: iwlResult?.examination_date ?? moment(startIwl, [
                        "DD/MM/YYYY HH:mm", "YYYY-MM-DD HH:mm"
                    ]).format("YYYY-MM-DD HH:mm"),
                    iwl_time: iwlResult?.iwl_time ?? moment(endIwl, [
                        "DD/MM/YYYY HH:mm", "YYYY-MM-DD HH:mm"
                    ]).format("YYYY-MM-DD HH:mm"),
                    awareness: iwlResult?.awareness ?? weight_iwl,
                    balance_type: "",
                    fluid_type: iwlResult?.fluid_type ?? "G0230308",
                    fluid_category: "",
                    fluid_amount: iwlResult?.fluid_amount ?? resultiwlShiftDate,
                    drip_rate: "0",
                    botle_amount: 0,
                }



                iwl = `<tr role="row" class="even">
                        <td style="text-align: center; vertical-align: middle;">
                            <label class="fw-bold">BC</label><br>
                            <span>${resultbc}</span>
                        </td>
                       <td style="text-align: center; vertical-align: middle;">
                            <label class="fw-bold">Diuresis</label><br>
                            <span>${resultDiuresis}</span>
                        </td>
                         <td style="text-align: center; vertical-align: middle;">
                            <label class="fw-bold">IWL SHIFT</label><br>
                            <span>${iwlResult?.fluid_amount ?? resultiwlShiftDate}</span>
                        </td>
                        <td>
                            <button class="btn btn-secondary edit-btn-iwl" data-item='${JSON.stringify(dataUpdateResultChange)}' data-id="${iwlResult?.body_id ?? body_idNewIwl}">Edit IWL</button>
                        </td>
                    </tr>`

                if (iwlResult === undefined || iwlResult === null) {

                    postData(dataUpdateResultChange, 'admin/cairan/insertData', (res) => {});
                }



            }


            let aValue = avalue
            let filteredDataValue = aValue?.filter(item => item?.p_type === "GEN0023");
            let dataRender = '';
            const resultNotIwl = data;
            resultNotIwl.map((item, index) => {
                let resultType = filteredDataValue.find(e => e?.value_id === item?.fluid_type);
                let valueDesc = resultType?.value_desc || '';

                let editButton =
                    `<?php if (user()->checkPermission("asuhancairan", 'c') && user()->checkRoles(['superuser', 'admin', 'perawat'])) : ?>` +
                    `<button class="btn btn-secondary  edit-btn" data-id="${item.body_id}" data-item='${JSON.stringify(item)}'>Edit</button>` +
                    `<?php endif; ?>`;

                let deleteButton =
                    `<?php if (user()->checkPermission("asuhancairan", 'c') && user()->checkRoles(['superuser', 'admin', 'perawat'])): ?>` +
                    `<button class="btn btn-danger delete-btn btn-show-delete-requestcairan" data-id="${item.body_id}">Delete</button>` +
                    `<?php endif; ?>`;

                dataRender += `<tr>
                        <td>${moment(item.examination_date).format("DD/MM/YYYY HH:mm")}</td>
                        <td>${valueDesc} - ${
                                    (() => {
                                        switch (item?.fluid_type) {
                                            case 'G0230301':
                                            case 'G0230302':
                                            case 'G0230309':
                                                return 'Cairan Masuk';
                                                break
                                            case 'G0230303':
                                            case 'G0230304':
                                            case 'G0230305':
                                            case 'G0230306':
                                            case 'G0230307':
                                            case 'G0230308':
                                                return 'Cairan Keluar';
                                            default:
                                                return 'iiiiii';
                                        }
                                    })()
                                }
                        </td>
                        <td>${item?.fluid_amount}</td>
                        <td>
                            ${editButton}
                            ${deleteButton}
                        </td>
                    </tr>`;
            })


            $("#bodydatagen0023").html(dataRender + iwl);
            let groupColumn = 0;


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


            $("#bodydatagen0023").off("click", ".edit-btn-iwl").on("click", ".edit-btn-iwl", function() {
                const row = $(this).closest("tr");
                const spanElement = row.find("td:nth-child(3) span");
                const resultiwlShiftDate = spanElement.text();
                const item = $(this).data("item")


                spanElement.replaceWith(
                    `<input type="number" class="form-control" value="${resultiwlShiftDate}" />`);

                row.find("td:last-child").html(`
                <button class="btn btn-secondary save-btn-iwl">Save IWL</button>
            `);

                row.off("click", ".save-btn-iwl").on("click", ".save-btn-iwl", function() {
                    const updatedValue = row.find("input").val();
                    row.find("input").replaceWith(`<span>${updatedValue}</span>`);
                    row.find("td:last-child").html(`
                    <button class="btn btn-secondary edit-btn-iwl">Edit IWL</button>
                `);

                    item.fluid_amount = updatedValue;
                    postData(item, 'admin/cairan/insertData', (res) => {
                        if (res.respon === true) {
                            successSwal('Data berhasil disimpan.');
                        }

                    });

                    // update data 
                });
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
                    // case 'G0230301':
                    case 'G0230302':
                    case 'G0230309':
                        balanceType = 0; // Cairan Masuk
                        break;
                    case 'G0230303':
                    case 'G0230304':
                    case 'G0230305':
                    case 'G0230306':
                    case 'G0230307':
                    case 'G0230308': // IWL
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
                            <input class="form-control datetimeflatpickr-cairan" type="text" id="flatInputexamination_date" value="${formattedExaminationDate}">
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
                        if (item?.[param.column_name?.toLowerCase()] === "G0230302") {
                            setTimeout(() => {
                                $("#param_03_GEN0023").trigger("change")
                                $("#param_03A_GEN0023").val(item?.fluid_category)

                                if (item?.fluid_category === 'Obat') {
                                    $("#param_03A_GEN0023").trigger("change")
                                }

                            }, 200);


                        }

                        const shouldShow03A = ['G0230301', 'G0230302', 'G0230309', 'G0230304'].includes(item
                            ?.[param.column_name?.toLowerCase()]);
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


            content += `<div class="mb-3" id="iv_line_parenteral-content" style="display: none;">
                        <label for="line" class="form-label">Line</label>
                        <select id="iv_line_parenteral" class="form-select" name="iv_line">
                            <option value="" ${item?.iv_line === "" ? 'selected' : ''}>Pilih</option>
                            <option value="1" ${item?.iv_line === 1 ||item?.iv_line === "1" ? 'selected' : ''}>Line 1</option>
                            <option value="2" ${item?.iv_line === 2 ||item?.iv_line === "2" ? 'selected' : ''}>Line 2</option>
                            <option value="3" ${item?.iv_line === 3 ||item?.iv_line === "3" ? 'selected' : ''}>Line 3</option>
                            <option value="4" ${item?.iv_line === 4 ||item?.iv_line === "4" ? 'selected' : ''}>Line 4</option>
                            <option value="5" ${item?.iv_line === 5 ||item?.iv_line === "5" ? 'selected' : ''}>Line 5</option>
                        </select>
                    </div>
                    <div class="mb-3" id="iv_description_parenteral-content" style="display: none;">
                        <label for="jenis" class="form-label">Jenis Line</label>
                        <input class="form-control" type="text" id="iv_description_parenteral" name="iv_description" value="${item?.iv_description ?? ""}">
                    </div>
                    `;

            document.getElementById('dokument-gen0023').innerHTML = content;

            $("#param_03_GEN0023").on('change', function() {
                const selectedValueIdParam03 = $(this).val();

                if (selectedValueIdParam03 === 'G0230302') {
                    $('#param_06_GEN0023-content').show();
                    $('#iv_line_parenteral-content').show();
                    $('#iv_description_parenteral-content').show();

                    $('#param_03A_GEN0023').on('change', function() {
                        const obatChange = $(this).val();

                        if (obatChange === 'Obat') {
                            $('#param_06_GEN0023-content').hide();
                            $('#iv_line_parenteral-content').hide();
                            $('#iv_description_parenteral-content').hide();
                        } else {
                            $('#param_06_GEN0023-content').show();
                            $('#iv_line_parenteral-content').show();
                            $('#iv_description_parenteral-content').show();
                        }
                    });
                } else {
                    $('#param_03A_GEN0023').on('change', function() {
                        $('#param_06_GEN0023-content').hide();
                        $('#iv_line_parenteral-content').hide();
                        $('#iv_description_parenteral-content').hide();
                    })
                    $('#param_06_GEN0023-content').hide();
                    $('#param_03A_GEN0023-content').hide();
                    $('#iv_line_parenteral-content').hide();
                    $('#iv_description_parenteral-content').hide();
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


            $('#param_03A_GEN0023').on('change', function() {
                const obatChange = $(this).val();
                if (obatChange === 'Obat') {
                    $('#param_06_GEN0023-content').hide();
                    $('#iv_line_parenteral-content').hide();
                    $('#iv_description_parenteral-content').hide();
                }

            })

            initializeFlatpickrCairan();
            btnSaveActionGen0023();
        };

        const initializeFlatpickrCairan = () => {
            const options = {
                enableTime: true,
                dateFormat: "d/m/Y H:i",
                time_24hr: true,
                allowInput: true
            };


            flatpickr(".datetimeflatpickr-cairan", options);
            flatpickr(".datetimeflatpickr-cairan-show", options);

            $(".datetimeflatpickr-cairan, .datetimeflatpickr-cairan-show").prop("readonly", false);

            $(".datetimeflatpickr-cairan").each(function() {
                if (!$(this).val()) {
                    const defaultDate = moment().format("DD/MM/YYYY HH:mm");
                    $(this).val(defaultDate).trigger("change");
                }
            });


            $(".datetimeflatpickr-cairan").on("change", function() {
                let theid = $(this).attr("id");
                let theida = $(this).val();

                if (!theid) return;

                theid = theid.replace("flat", "");
                let thevalue = $(this).val();

                if (moment(thevalue, "DD/MM/YYYY HH:mm", true).isValid()) {
                    const formattedDate = moment(thevalue, "DD/MM/YYYY HH:mm").format("YYYY-MM-DD HH:mm");
                    const hiddenInput = $("#" + theid);
                    if (hiddenInput.length) {
                        hiddenInput.val(formattedDate);
                    }
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