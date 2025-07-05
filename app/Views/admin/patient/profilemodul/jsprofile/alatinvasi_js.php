<script type="text/javascript">
(function() {

    $(document).ready(function() {
        getDataTableTools();

    });


    // get data
    const getDataTableTools = async (props) => {
        $("#gearinvasiTab").off("click").on("click", async function(e) {
            e.preventDefault();

            try {
                getLoadingscreen("contentToHide-gear", "load-content-gear");

                const visit = <?= json_encode($visit ?? []) ?>;

                await getDataTablesTools({
                    visit_id: visit?.visit_id
                });

                $("#btn-create-gear").off("click").on("click", function(e) {
                    e.preventDefault();
                    $("#create-modal-gear").modal("show");
                    templateToolsInvasif({
                        visit: visit
                    })
                });
            } catch (error) {}

        });
    };

    const getDataTablesTools = async (props) => {
        return new Promise((resolve, reject) => {
            postData({
                    visit_id: props.visit_id
                },
                "admin/Assinvasif/getData",
                (res) => {
                    if (res.respon === true) {
                        renderDataTabelsAssessmenInvasifTools({
                            data: res?.value?.data
                        })

                    } else {
                        $("#bodydata-gear").html(tempTablesNull());
                    }
                    resolve();
                },
                (beforesend) => {
                    getLoadingGlobalServices("bodydata-gear");
                }
            );
        });
    };

    const templateToolsInvasif = (props) => {
        const contentShow = [{
                label: "",
                type: "hidden",
                name: "org_unit_code",
                value: props?.data?.org_unit_code ?? props?.visit?.org_unit_code,
                id: "tools_org_unit_code",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "visit_id",
                value: props?.data?.visit_id ?? props?.visit?.visit_id,
                id: "tools_visit_id",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "trans_id",
                value: props?.data?.trans_id ?? props?.visit?.trans_id,
                id: "tools_trans_id",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "body_id",
                value: props?.data?.body_id ?? get_bodyid(),
                id: "tools_body_id",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "document_id",
                value: props?.data?.document_id ?? props?.visit?.session_id,
                id: "tools_document_id",
                class: ""
            },
            {
                label: "HARI/TANGGAL",
                type: "text",
                name: "examination_date",
                value: props?.data?.examination_date ? moment(props?.data?.examination_date).format(
                    "DD/MM/YYYY") : moment(new Date()).format("DD/MM/YYYY"),
                id: "tools_examination_date",
                class: "dateflatpickr-tools"
            },
            {
                label: "ALAT",
                type: "select",
                name: "tool_id",
                value: props?.data?.tool_id ?? "",
                id: "tools_tool_id-gear",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "tool_name",
                value: props?.data?.tool_name ?? "",
                id: "tools_tool_name",
                class: ""
            },
            {
                label: "POSISI",
                type: "text",
                name: "tool_location",
                value: props?.data?.tool_location ?? "",
                id: "tools_tool_location",
                class: ""
            },
            {
                label: "UKURAN",
                type: "text",
                name: "tool_size",
                value: props?.data?.tool_size ?? "",
                id: "tools_tool_size",
                class: ""
            }
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

        $("#contentToolsInvasif_Show").html(`
        <div class="row">
            ${contentHtml}
        </div>`);
        $("#contentToolsInvasif_Hide").html(`<div class="row">${contentHtmlHide}</div>`);

        renderDataModalGear({
            data_val: props?.data?.tool_id ?? ""
        });
        initialFlatpicToolsInvasi()

        $("#tools_tool_id-gear").on("change", function() {
            const selectedOption = $(this).find(":selected");
            const toolName = selectedOption.data("name") || "";
            $("#tools_tool_name").val(toolName);
        });
        saveAssessmenInvasifTools()
    };

    const renderDataModalGear = (props) => {
        let aParameter = <?= json_encode($aParameter ?? []) ?>;
        let data = aParameter.filter(e => e.p_type === 'GEN0025');
        let data_val = props?.data_val || "";
        let result = "";

        data.forEach(e => {
            const isSelected = e.parameter_id === data_val ? "selected" : "";
            result +=
                `<option value="${e.parameter_id}" data-name='${e.parameter_desc}' ${isSelected}>${e.parameter_desc}</option>`;
        });

        $("#tools_tool_id-gear").html(`<option value="">Pilih</option>` + result);
    };


    const initialFlatpicToolsInvasi = () => {
        flatpickr(".dateflatpickr-tools", {
            enableTime: false,
            dateFormat: "d/m/Y",

            onChange: function(selectedDates, dateStr, instance) {}
        });

        $(".dateflatpickr-tools").prop("readonly", false)
    }


    const saveAssessmenInvasifTools = () => {
        $("#btn-save-tools-modal").off().on("click", function(e) {
            e.preventDefault();

            let formElement = document.getElementById('formDokument-alatInvasif');
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
            postData(jsonObj, 'admin/Assinvasif/saveData', (res) => {
                // if (response.success) {
                getDataTablesTools({
                    visit_id: hasil?.visit_id
                })
                successSwal('Sukses');
                $("#create-modal-gear").modal("hide");
                // }
            });
        });
    };


    const renderDataTabelsAssessmenInvasifTools = (props) => {
        let resultTables = ""
        props?.data?.map((e, index) => {
            resultTables += `
                            <tr>
                                <td>${index +1}</td>
                                <td>${e?.examination_date ?moment(e?.examination_date).format(
                                    "DD/MM/YYYY") :"-"}</td>
                                <td>${e?.tool_name}</td>
                                <td>${e?.tool_location}</td>
                                <td>${e?.tool_size}</td>
                                <td class="d-flex justify-content-start">
                                    <button type="button" 
                                            class="btn btn-outline-primary checkbox-toggle pull-right w-50 formEditAlatInvasifEdit" 
                                            data-id="${e?.body_id}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#create-modal-gear"
                                            >
                                        <i class="far fa-edit"></i> Ubah
                                    </button>

                                    <button type="button" class="btn btn-outline-danger checkbox-toggle pull-right w-50 formDeleteAlatInvasi"  data-id="${e?.body_id}" >
                                        <i class="far fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            `
        })
        if ($.fn.DataTable.isDataTable('#table-tools')) {
            $('#table-tools').DataTable().destroy();
        }
        $("#bodydata-gear").html(resultTables)
        $('#table-tools').DataTable({
            dom: '<"mb-3"B>rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
            lengthChange: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ],
            buttons: []
        });
        actionButtonInTabelssAlat(props)
    }

    const actionButtonInTabelssAlat = (props) => {
        $("#bodydata-gear").on("click", ".formEditAlatInvasifEdit", function() {
            const id = $(this).data("id");
            const selectedData = props.data.find(item => item.body_id === id);
            if (selectedData) {
                templateToolsInvasif({
                    data: selectedData
                })
            }
        });

        $("#bodydata-gear").on("click", ".formDeleteAlatInvasi", function() {
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
                    deleteActionAlatInvasif({
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


    const deleteActionAlatInvasif = (props) => {
        postData({
            id: props?.data?.body_id,
        }, 'admin/Assinvasif/deleteData', (res) => {
            if (res.respon === true) {
                successSwal('Data berhasil Dihapus.');
                let hasil = {
                    visit_id: props?.data?.visit_id,
                }
                getDataTablesTools({
                    visit_id: hasil?.visit_id
                })
            } else {
                errorSwal("Gagal Di hapus")
            }
        });
    }


})();
</script>