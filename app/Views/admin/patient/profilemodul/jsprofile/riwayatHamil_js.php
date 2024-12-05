<script type="text/javascript">
(function() {
    $(document).ready(function() {
        // Event click untuk modal
        $("#riwayatHamilTab").off("click").on("click", function(e) {
            e.preventDefault();
            getLoadingscreen("contentToHide-Pregnancy_History", "load-content-Pregnancy_History")

            groupeActionInTab()
        });


    });


    const groupeActionInTab = async () => {
        let visit = <?= json_encode($visit) ?>;
        await getDataPregnancyHistory({
            visit: visit
        })

        $("#btn-doc-riwayatHamil").off("click").on("click", function(e) {
            e.preventDefault();
            $("#riwayatHamil-modal").modal("show");
            templatePregnancy({
                visit: visit
            })
        });
    }


    const templatePregnancy = (props) => {
        const contentShow = [{
                label: "",
                type: "hidden",
                name: "org_unit_code",
                value: props?.data?.org_unit_code ?? props?.visit?.org_unit_code,
                id: "org_unit_code",
                class: ""
            }, {
                label: "",
                type: "hidden",
                name: "no_registration",
                value: props?.data?.no_registration ?? props?.visit?.no_registration,
                id: "no_registration",
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
                name: "partus_date",
                value: props?.data?.partus_date ? moment(props?.data?.partus_date).format(
                    "YYYY-MM-DD HH:mm") : moment(new Date()).format("YYYY-MM-DD HH:mm"),
                id: "partus_date",
                class: ""
            },
            {
                label: "Tgl/Tahun Partus",
                type: "text",
                name: "",
                value: props?.data?.partus_date ? moment(props?.data?.partus_date).format(
                    "DD/MM/YYYY HH:mm") : moment(new Date()).format("DD/MM/YYYY HH:mm"),
                id: "flatpartus_date",
                class: "datetimeflatpickr"
            },
            {
                label: "Tempat Partus",
                type: "select",
                name: "partus_location",
                value: props?.data?.partus_location || "",
                id: "partus_location",
                class: "",
                selectOptions: window.optionsFilter.location.map(item => ({
                    key: item.result,
                    value: item.result
                })),
                customInput: true
            },
            {
                label: "Umur Hamil",
                type: "text",
                name: "gestation",
                value: props?.data?.gestation || "",
                id: "gestation",
                class: ""
            },
            {
                label: "Jenis Persalinan",
                type: "select",
                name: "partus_type",
                value: props?.data?.partus_type || "",
                id: "partus_type",
                class: "",
                selectOptions: window.optionsFilter.type.map(item => ({
                    key: item.result,
                    value: item.result
                })),
                customInput: true
            },
            {
                label: "Penolong Persalinan",
                type: "select",
                name: "partus_helper",
                value: props?.data?.partus_helper || "",
                id: "partus_helper",
                class: "",
                selectOptions: window.optionsFilter.helper.map(item => ({
                    key: item.result,
                    value: item.result
                })),
                customInput: true
            },
            {
                label: "Penyulit",
                type: "select",
                name: "partus_abnormal",
                value: props?.data?.partus_abnormal || "",
                id: "partus_abnormal",
                class: "",
                selectOptions: window.optionsFilter.penyulit.filter(item => item.result !== "LAIN-LAIN")
                    .map(item => ({
                        key: item.result,
                        value: item.result
                    })),
                customInput: true
            },
            {
                label: "Jenis Kelamin Anak",
                type: "select",
                name: "baby_sex",
                value: props?.data?.baby_sex || "",
                id: "baby_sex",
                class: "",
                selectOptions: [{
                        key: "Laki - Laki",
                        value: "1"
                    },
                    {
                        key: "Perempuan",
                        value: "2"
                    }
                ],
                customInput: false
            },
            {
                label: "Berat Anak",
                type: "number",
                name: "baby_weight",
                value: props?.data?.baby_weight || "",
                id: "baby_weight",
                class: ""
            },
            {
                label: "Keadaan Sekarang",
                type: "text",
                name: "baby_condition",
                value: props?.data?.baby_condition || "",
                id: "baby_condition",
                class: ""
            }
        ];

        let contentHtml = "";
        let contentHtmlSelect = ""
        let contentHtmlHide = "";

        contentShow.forEach((item, index) => {
            const uniqueId = item.id || `input-${index}`;

            if (item.type === "hidden") {
                contentHtmlHide += `<div class="col-6" hidden>
                                        <div class="mb-3 row">
                                            <div class="col-sm-8">
                                                <input type="${item.type}" class="form-control ${item.class}" id="${uniqueId}" name="${item.name}" value="${item.value}">
                                            </div>
                                        </div>
                                    </div>`;
            } else if (item.type === "select") {
                let options = item.selectOptions.map(option => {
                    return `<option value="${option.value}" ${option.value === item.value ? "selected" : ""}>${option.key}</option>`;
                }).join("");

                if (item.customInput === true) {
                    options +=
                        `<option value="custom" ${item.value === "custom" || (item.value && !item.selectOptions.some(opt => opt.value === item.value)) ? "selected" : ""}>Lainnya</option>`;
                }

                let customInputHtml = `<div class="col-6">
                                            <div class="mb-3 row">
                                                <label for="${uniqueId}" class="col-sm-4 col-form-label fw-bold">${item.label}</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control ${item.class}" id="${uniqueId}" name="${item.name}">
                                                        ${options}
                                                    </select>
                                                    <input type="text" class="form-control custom-text-input mt-2" id="custom-${uniqueId}" 
                                                        placeholder="Lainnya..." style="display:${item.value === "custom" || (item.value && !item.selectOptions.some(opt => opt.value === item.value)) ? "block" : "none"};" 
                                                        value="${item.value === "custom" || (item.value && !item.selectOptions.some(opt => opt.value === item.value)) ? props?.data?.customText || item.value : ""}">
                                                </div>
                                            </div>
                                        </div>`;
                contentHtmlSelect += customInputHtml;
            } else {
                contentHtml += `<div class="col-6">
                                    <div class="mb-3 row">
                                        <label for="${uniqueId}" class="col-sm-4 col-form-label fw-bold">${item.label}</label>
                                        <div class="col-sm-8">
                                            <input type="${item.type}" class="form-control ${item.class}" id="${uniqueId}" name="${item.name}" value="${item.value}">
                                        </div>
                                    </div>
                                </div>`;
            }
        });

        $("#contentPregnancy_History_Show").off("change", "select").on("change", "select", function() {
            const selectedValue = $(this).val();
            const customInputId = `#custom-${$(this).attr('id')}`;

            if (selectedValue === "custom") {
                $(customInputId).show();
            } else {
                $(customInputId).hide().val("");
            }
        });

        $("#contentPregnancy_History_Show").html(`<div class="row">${contentHtml}${contentHtmlSelect}</div>`);
        $("#contentPregnancy_History_Hide").html(`<div class="row">${contentHtmlHide}</div>`);

        initializeDiagFlatpickr();
        savePregnancyHistory();
    };

    const initializeDiagFlatpickr = () => {
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
            } else {}
        });
    }

    const getDataPregnancyHistory = (props) => {
        return new Promise((resolve) => {
            postData({
                no_registration: props?.visit?.no_registration,
                org_unit_code: props?.visit?.org_unit_code,
            }, 'admin/PregnancyHistory/getData', (res) => {
                window.optionsFilter = res?.value?.data?.filterOption
                renderDataTabelsPregnancyHistory({
                    data: res?.value?.data?.dataAll
                })
            }, (beforesend) => {
                getLoadingGlobalServices('bodydataRiwayatHamil')
            })
            resolve();
        })
    }

    const savePregnancyHistory = () => {
        $("#btn-action-pregnancy").off().on("click", function(e) {
            e.preventDefault();

            let formElement = document.getElementById('FormPregnancy_History');
            let dataSend = new FormData(formElement);
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });

            $("#FormPregnancy_History select").each(function() {
                const selectName = $(this).attr("name");
                const selectValue = $(this).val();

                if (selectValue === "custom") {
                    const customInput = $(this).siblings("input.custom-text-input");
                    if (customInput.length) {
                        jsonObj[selectName] = customInput
                            .val();
                    }
                }
            });

            let hasil = {
                no_registration: jsonObj?.no_registration,
                org_unit_code: jsonObj?.org_unit_code
            }
            postData(jsonObj, 'admin/PregnancyHistory/saveData', (res) => {
                // if (response.success) {
                getDataPregnancyHistory({
                    visit: hasil
                })
                successSwal('Sukses');
                $("#riwayatHamil-modal").modal("hide");
                // }
            });
        });
    };


    const renderDataTabelsPregnancyHistory = (props) => {
        let resultTables = ""

        props?.data?.map((e, index) => {
            resultTables += `<tr>
                                <td>${index +1}</td>
                                <td>${e?.partus_date ?moment(e?.partus_date).format(
                                    "DD/MM/YYYY HH:mm") :"-"}</td>
                                <td>${e?.partus_location ?? "-"}</td>
                                <td>${e?.gestation ?? "-"}</td>
                                <td>${e?.partus_type ?? "-"}</td>
                                <td>${e?.partus_helper ?? "-"}</td>
                                <td>${e?.partus_abnormal ?? "-"}</td>
                                <td>${
                                        e?.baby_sex === "1" 
                                        ? "Laki-Laki" 
                                        : e?.baby_sex === "2" 
                                            ? "Perempuan" 
                                            : "-"
                                    } / ${e?.baby_weight ?? "-"}
                                </td>

                                <td>${e?.baby_condition ?? "-"}</td>
                                <td class="d-flex justify-content-start">
                                    <button type="button" 
                                            class="btn btn-outline-primary checkbox-toggle pull-right w-50 formEditPregnancy" 
                                            data-id="${e?.body_id}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#riwayatHamil-modal"
                                            >
                                        <i class="far fa-edit"></i> Ubah
                                    </button>

                                    <button type="button" class="btn btn-outline-danger checkbox-toggle pull-right w-50 formDeletePregnancy"  data-id="${e?.body_id}" >
                                        <i class="far fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            `
        })
        if ($.fn.DataTable.isDataTable('#tableDat-riwayat-hamil')) {
            $('#tableDat-riwayat-hamil').DataTable().destroy();
        }
        $("#bodydataRiwayatHamil").html(resultTables)
        $('#tableDat-riwayat-hamil').DataTable({
            dom: '<"mb-3"B>rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
            lengthChange: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ]
        });
        actionButtonInTabelss(props)
    }


    const actionButtonInTabelss = (props) => {
        $("#bodydataRiwayatHamil").on("click", ".formEditPregnancy", function() {
            const id = $(this).data("id");
            const selectedData = props.data.find(item => item.body_id === id);
            if (selectedData) {
                templatePregnancy({
                    data: selectedData
                })
            }
        });

        $("#bodydataRiwayatHamil").on("click", ".formDeletePregnancy", function() {
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
                    deleteActionPregnancy({
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

    const deleteActionPregnancy = (props) => {
        postData({
            id: props?.data?.body_id,
        }, 'admin/PregnancyHistory/deleteData', (res) => {
            if (res.respon === true) {
                successSwal('Data berhasil Dihapus.');
                let hasil = {
                    no_registration: props?.data?.no_registration,
                    org_unit_code: props?.data?.org_unit_code
                }
                getDataPregnancyHistory({
                    visit: hasil
                });
            } else {
                errorSwal("Gagal Di hapus")
            }
        });
    }


})();
</script>