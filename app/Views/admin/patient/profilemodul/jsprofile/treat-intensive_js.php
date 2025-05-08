<script type="text/javascript">
(function() {

    $(document).ready(function() {
        getDataTableTreatIntensive();

    });

    // get data
    const getDataTableTreatIntensive = async (props) => {
        $("#treatintensiveTab").off("click").on("click", async function(e) {
            e.preventDefault();

            try {
                getLoadingscreen("contentToHide-treatintensive", "load-content-treatintensive");

                const visit = <?= json_encode($visit ?? []) ?>;

                await getDataTablesTreatIntensive({
                    visit_id: visit?.visit_id
                });

                $("#btn-create-treatintensive").off("click").on("click", function(e) {
                    e.preventDefault();
                    $("#create-modal-treatintensive").modal("show");
                    templateTreatIntensive({
                        visit: visit
                    })
                });
            } catch (error) {}

        });
    };

    const getDataTablesTreatIntensive = async (props) => {
        return new Promise((resolve, reject) => {
            postData({
                    visit_id: props.visit_id
                },
                "admin/AssIntensivTreat/getData",
                (res) => {
                    if (res.respon === true) {
                        renderDataTabelsTreatIntensive({
                            data: res?.value?.data
                        })

                    } else {
                        $("#bodydata-treatintensive").html(tempTablesNull());
                    }
                    resolve();
                },
                (beforesend) => {
                    getLoadingGlobalServices("bodydata-treatintensive");
                }
            );
        });
    };

    const templateTreatIntensive = (props) => {

        const contentShow = [{
                label: "",
                type: "hidden",
                name: "org_unit_code",
                value: props?.data?.org_unit_code ?? props?.visit?.org_unit_code,
                id: "org_unit_code",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "visit_id",
                value: props?.data?.visit_id ?? props?.visit?.visit_id,
                id: "visit_id",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "trans_id",
                value: props?.data?.trans_id ?? props?.visit?.trans_id,
                id: "trans_id",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "body_id",
                value: props?.data?.body_id ?? get_bodyid(),
                id: "body_id",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "document_id",
                value: props?.data?.document_id ?? props?.visit?.session_id,
                id: "document_id",
                class: ""
            },
            {
                label: "HARI/TANGGAL",
                type: "text",
                name: "examination_date",
                value: props?.data?.examination_date ? moment(props?.data?.examination_date).format(
                    "DD/MM/YYYY HH:mm") : moment(new Date()).format("DD/MM/YYYY HH:mm"),
                id: "examination_date",
                class: "dateflatpickr-treatintensive"
            },
            {
                label: "Treatment",
                type: "select",
                name: "treatment_id",
                value: props?.data?.treatment_id ?? "",
                id: "treatment_id-treatInten",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "treatment_name",
                value: props?.data?.treatment_name ?? "",
                id: "treatment_name-treat",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "p_type",
                value: props?.data?.p_type ?? "",
                id: "p_type-treat",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "parameter_id",
                value: props?.data?.parameter_id ?? "",
                id: "parameter_id-treat",
                class: ""
            },
            {
                label: "Note",
                type: "text",
                name: "results",
                value: props?.data?.results ?? "",
                id: "results",
                class: ""
            },

        ];

        let contentHtml = "";
        let contentHtmlHide = "";

        contentShow.forEach((group) => {
            const uniqueId = group.id || `input-${group.name}`;
            if (group.type === "hidden") {
                contentHtmlHide += `
                <div class="col-6" hidden>
                    <div class="mb-3 row">
                        <div class="col-sm-8">
                            <input type="${group.type}" class="form-control ${group?.class ?? ""}" id="${uniqueId}" name="${group.name}" value="${group.value}">
                        </div>
                    </div>
                </div>`;
            } else if (group.type === "select") {
                contentHtml += `
                <div class="col-6">
                    <div class="mb-3 row">
                        <label for="${uniqueId}" class="col-sm-4 col-form-label fw-bold">${group.label}</label>
                        <div class="col-sm-8">
                            <select class="form-select ${group?.class ?? ""}" id="${uniqueId}" name="${group.name}"></select>
                        </div>
                    </div>
                </div>`;
            } else {
                contentHtml += `
                <div class="col-6">
                    <div class="mb-3 row">
                        <label for="${uniqueId}" class="col-sm-4 col-form-label fw-bold">${group.label}</label>
                        <div class="col-sm-8">
                            <input type="${group.type}" class="form-control ${group?.class ?? ""}" id="${uniqueId}" name="${group.name}" value="${group.value}">
                        </div>
                    </div>
                </div>`;
            }
        });

        $("#contentTreatintensive_Show").html(`
        <div class="row">
            ${contentHtml}
        </div>`);
        $("#contentTreatintensive_Hide").html(`<div class="row">${contentHtmlHide}</div>`);

        renderDataModalTreatIntensive({
            data_val: props?.data?.treatment_id ?? ""
        });
        initialFlatpicTreatInten()

        $("#treatment_id-treatInten").on("change", function() {
            const selectedOption = $(this).find(":selected");
            const toolName = selectedOption.data("name") || "";
            const type = selectedOption.data("type") || "";
            const param = selectedOption.data("param") || "";

            $("#treatment_name-treat").val(toolName);
            $("#p_type-treat").val(type);
            $("#parameter_id-treat").val(param);
        });
        saveAssessmenTreatIntensive()
    };

    const renderDataModalTreatIntensive = (props) => {
        let aParameter = <?= json_encode($aParameter ?? []) ?>;
        let aValue = <?= json_encode($aValue ?? []) ?>;

        let dataGroup = aParameter.filter(e => e.p_type === 'GEN0026');
        let dataChild = aValue.filter(e => e.p_type === 'GEN0026');
        let data_val = props?.data_val || "";

        let result = "";

        dataGroup.forEach(group => {
            let childOptions = "";
            let groupId = group.parameter_id;

            let filteredChildren = dataChild.filter(child => child.parameter_id === groupId);

            if (filteredChildren.length === 0) {
                childOptions +=
                    `<option value="${groupId}" data-name='${group.parameter_desc}' data-type='${group.p_type}' 
                    data-param='${group.parameter_id}' >${group.parameter_desc}</option>`;
            } else {
                filteredChildren.forEach(child => {
                    const isSelected = child.value_id === data_val ? "selected" : "";

                    childOptions +=
                        `<option value="${child.value_id}" data-name='${child.value_desc}' data-type='${child.p_type}' 
                        data-param='${child.parameter_id}' ${isSelected}>${child.value_desc}</option>`;
                });
            }

            if (childOptions) {
                result += `<optgroup label="${group.parameter_desc}">${childOptions}</optgroup>`;
            }
        });

        $("#treatment_id-treatInten").html(`<option value="">Pilih</option>` + result);
    };




    const initialFlatpicTreatInten = () => {
        flatpickr(".dateflatpickr-treatintensive", {
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            time_24hr: true,
            onChange: function(selectedDates, dateStr, instance) {}
        });

        $(".dateflatpickr-treatintensive").prop("readonly", false)
    }


    const saveAssessmenTreatIntensive = () => {
        $("#btn-save-Treatintensive-modal").off().on("click", function(e) {
            e.preventDefault();

            let formElement = document.getElementById('formDokument-treatintensive');
            let dataSend = new FormData(formElement);
            let jsonObj = {};

            // dataSend.forEach((value, key) => {
            //     jsonObj[key] = value;
            // });

            dataSend.forEach((value, key) => {
                if (key === 'examination_date' && value) {
                    const date = new Date(value);
                    const formattedDate = moment(value, ["DD/MM/YYYY HH:mm",
                        "YYYY-MM-DD HH:mm", "DD/MM/YYYY",
                    ]).format(
                        "YYYY-MM-DD HH:mm")
                    jsonObj[key] = formattedDate;
                } else {
                    jsonObj[key] = value;
                }
            });
            let hasil = {
                visit_id: jsonObj?.visit_id,
            }
            postData(jsonObj, 'admin/AssIntensivTreat/saveData', (res) => {
                // if (response.success) {
                getDataTablesTreatIntensive({
                    visit_id: hasil?.visit_id
                })
                successSwal('Sukses');
                $("#create-modal-treatintensive").modal("hide");
                // }
            });
        });
    };


    const renderDataTabelsTreatIntensive = (props) => {
        let resultTables = ""
        props?.data?.map((e, index) => {
            resultTables += `
                            <tr>
                                <td>${index +1}</td>
                                <td>${e?.examination_date ?moment(e?.examination_date).format(
                                    "DD/MM/YYYY HH:mm") :"-"}</td>
                                <td>${e?.treatment_name}</td>
                                <td>${e?.results}</td>
                                <td class="d-flex justify-content-start">
                                    <button type="button" 
                                            class="btn btn-outline-primary checkbox-toggle pull-right w-50 formEditTreatIntersive" 
                                            data-id="${e?.body_id}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#create-modal-treatintensive"
                                            >
                                        <i class="far fa-edit"></i> Ubah
                                    </button>

                                    <button type="button" class="btn btn-outline-danger checkbox-toggle pull-right w-50 formDeleteTreatIntersive"  data-id="${e?.body_id}" >
                                        <i class="far fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            `
        })
        if ($.fn.DataTable.isDataTable('#table-treatintensive')) {
            $('#table-treatintensive').DataTable().destroy();
        }
        $("#bodydata-treatintensive").html(resultTables)
        $('#table-treatintensive').DataTable({
            dom: '<"mb-3"B>rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
            lengthChange: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ]
        });
        actionButtonInTabelssTreatIntensive(props)
    }

    const actionButtonInTabelssTreatIntensive = (props) => {
        $("#bodydata-treatintensive").on("click", ".formEditTreatIntersive", function() {
            const id = $(this).data("id");
            const selectedData = props.data.find(item => item.body_id === id);
            if (selectedData) {
                templateTreatIntensive({
                    data: selectedData
                })
            }
        });

        $("#bodydata-treatintensive").on("click", ".formDeleteTreatIntersive", function() {
            let id = $(this).data('id');
            const selectedData = props.data.find(item => item.body_id === id);
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
                    deleteActionTreatIntensive({
                        data: selectedData,
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
    }


    const deleteActionTreatIntensive = (props) => {
        postData({
            id: props?.data?.body_id,
        }, 'admin/AssIntensivTreat/deleteData', (res) => {
            if (res.respon === true) {
                successSwal('Data berhasil Dihapus.');
                let hasil = {
                    visit_id: props?.data?.visit_id,
                }
                getDataTablesTreatIntensive({
                    visit_id: hasil?.visit_id
                })
            } else {
                errorSwal("Gagal Di hapus")
            }
        });
    }


})();
</script>