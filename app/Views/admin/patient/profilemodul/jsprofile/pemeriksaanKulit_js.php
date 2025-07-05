<script type="text/javascript">
    $(document).ready(function() {
        console.log("dermatologi masuk")
        // Event click untuk modal
        $("#pemeriksaanKulitTab").off("click").on("click", function(e) {
            e.preventDefault();
            getLoadingscreen("contentToHide-pemeriksaanKulit", "load-content-pemeriksaanKulit")
            groupeActionInTabKulit()
        });
    });

    const groupeActionInTabKulit = async (pasien_diagnosa_id) => {
        let newvisit = visit
        newvisit.session_id = pasien_diagnosa_id
        await getDataAssessmenDermatovenerologi({
            visit: newvisit
        })
        $("#btn-doc-pemeriksaanKulit").off("click").on("click", function(e) {
            e.preventDefault();
            $("#pemeriksaanKulit-modal").modal("show");
            templateDermatovenerologi({
                visit: newvisit
            })
        });
    }

    const templateDermatovenerologi = (props) => {
        const contentShow = [{
                label: "",
                type: "hidden",
                name: "org_unit_code",
                value: props?.data?.org_unit_code ?? props?.visit?.org_unit_code,
                id: "derm_org_unit_code",
                class: ""
            }, {
                label: "",
                type: "hidden",
                name: "visit_id",
                value: props?.data?.visit_id ?? props?.visit?.visit_id,
                id: "derm_visit_id",
                class: ""
            }, {
                label: "",
                type: "hidden",
                name: "trans_id",
                value: props?.data?.trans_id ?? props?.visit?.trans_id,
                id: "derm_trans_id",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "body_id",
                value: props?.data?.body_id ?? get_bodyid(),
                id: "derm_body_id",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "document_id",
                value: props?.data?.document_id ?? props?.visit?.session_id,
                id: "derm_document_id",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "no_registration",
                value: props?.data?.no_registration ?? props?.visit?.no_registration,
                id: "derm_no_registration",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "examination_date",
                value: moment(new Date()).format("YYYY-MM-DD HH:mm"),
                id: "derm_examination_date",
                class: ""
            },
            {
                group: "Status Dermatologik <h6>I. Inspeksi</h6>",
                fields: [{
                        label: "Lokasi",
                        type: "text",
                        name: "sd_ins_location",
                        value: props?.data?.sd_ins_location || "",
                        id: "derm_sd_ins_location",
                        class: "groupe-val"
                    },
                    {
                        label: "UKK",
                        type: "text",
                        name: "sd_ins_ukk",
                        value: props?.data?.sd_ins_ukk || "",
                        id: "derm_sd_ins_ukk",
                        class: "groupe-val"
                    },
                    {
                        label: "Distribusi",
                        type: "text",
                        name: "sd_ins_distribution",
                        value: props?.data?.sd_ins_distribution || "",
                        id: "derm_sd_ins_distribution",
                        class: "groupe-val"
                    },
                    {
                        label: "Konfigurasi",
                        type: "text",
                        name: "sd_ins_configuration",
                        value: props?.data?.sd_ins_configuration || "",
                        id: "derm_sd_ins_configuration",
                        class: "groupe-val"
                    },
                    {
                        label: "Palpasi",
                        type: "text",
                        name: "sd_palpation",
                        value: props?.data?.sd_palpation || "",
                        id: "derm_sd_palpation",
                        class: "groupe-val"
                    },
                    {
                        label: "Lain-lain",
                        type: "text",
                        name: "sd_others",
                        value: props?.data?.sd_others || "",
                        id: "derm_sd_others",
                        class: "groupe-val"
                    }
                ]
            },
            {
                group: "Status Venerologik",
                fields: [{
                        label: "Inspeksi",
                        type: "text",
                        name: "sv_inspection",
                        value: props?.data?.sv_inspection || "",
                        id: "derm_sv_inspection",
                        class: "groupe-val"
                    },
                    {
                        label: "Palpasi",
                        type: "text",
                        name: "sv_palpation",
                        value: props?.data?.sv_palpation || "",
                        id: "derm_sv_palpation",
                        class: "groupe-val"
                    },
                ]
            },

        ];

        let contentHtml = "";
        let contentHtmlSelect = ""
        let contentHtmlHide = "";

        contentShow.forEach((group) => {
            if (group.group) {
                contentHtml += `<div class="col-12 mb-4">
                                <h5 class="fw-bold">${group.group}</h5>
                                <hr>
                                <div class="row">`;

                group.fields.forEach((item, index) => {
                    const uniqueId = item.id || `input-${index}`;
                    contentHtml += `
                                <div class="col-6">
                                    <div class="mb-3 row">
                                        <label for="${uniqueId}" class="col-sm-4 col-form-label fw-bold">${item.label}</label>
                                        <div class="col-sm-8">
                                            <input type="${item.type}" class="form-control ${item?.class ?? ""}" id="${uniqueId}" name="${item.name}" value="${item.value}">
                                        </div>
                                    </div>
                                </div>`;
                });

                contentHtml += `</div></div>`;
            } else {
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
            }
        });

        $("#contentAssessmen_Dermatovenerologi_Show").html(`
        <div class="row">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-primary mb-3" id="default-value-groupe-dermatovenerologi">Default</button>
            </div>
            ${contentHtml}
        </div>`);
        $("#contentAssessmen_Dermatovenerologi_Hide").html(`<div class="row">${contentHtmlHide}</div>`);


        // initializeDermFlatpickr();
        saveAssessmenDermatovenerologi();
        setDefaultValuesKulit()
    };

    const setDefaultValuesKulit = () => {
        $("#default-value-groupe-dermatovenerologi").on("click", function() {
            $("#contentAssessmen_Dermatovenerologi_Show .groupe-val").each(function() {
                $(this).val("Dalam batas normal");
            });
        });
    };

    // const initializeDiagFlatpickr = () => {
    //     flatpickr(".datetimeflatpickr", {
    //         enableTime: true,
    //         dateFormat: "d/m/Y H:i", // Display format
    //         time_24hr: true, // 24-hour time format
    //     });

    //     $(".datetimeflatpickr").prop("readonly", false);

    //     $(".datetimeflatpickr").on("change", function() {
    //         let theid = $(this).attr("id");
    //         theid = theid.replace("flat", "");
    //         let thevalue = $(this).val();

    //         if (moment(thevalue, "DD/MM/YYYY HH:mm", true).isValid()) {
    //             let formattedDate = moment(thevalue, "DD/MM/YYYY HH:mm").format(
    //                 "YYYY-MM-DD HH:mm"
    //             );
    //             $("#" + theid).val(formattedDate);
    //         } else {}
    //     });
    // }

    const getDataAssessmenDermatovenerologi = (props, document_id) => {
        return new Promise((resolve) => {
            postData({
                no_registration: props?.visit?.no_registration,
                org_unit_code: props?.visit?.org_unit_code,
                session_id: props?.visit?.session_id,
            }, 'admin/AssDermatovenerologi/getData', (res) => {
                templateDermatovenerologi({
                    data: res?.value?.data?.dataAll
                })
                // renderDataTabelsAssessmenDermatovenerologi({
                //     data: res?.value?.data?.dataAll
                // })
            }, (beforesend) => {
                getLoadingGlobalServices('bodydatapemeriksaanKulit')
            })
            resolve();
        })
    }

    const saveAssessmenDermatovenerologi = () => {
        $("#btn-action-dermatovenerologi").off().on("click", function(e) {
            e.preventDefault();

            let formElement = document.getElementById('FormAssessmen_Dermatovenerologi');
            let dataSend = new FormData(formElement);
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });

            let hasil = {
                no_registration: jsonObj?.no_registration,
                org_unit_code: jsonObj?.org_unit_code,
                session_id: jsonObj?.document_id
            }
            postData(jsonObj, 'admin/AssDermatovenerologi/saveData', (res) => {
                if (res.respon === true) {
                    getDataAssessmenDermatovenerologi({
                        visit: hasil
                    })
                    successSwal('Sukses');
                    $("#pemeriksaanKulit-modal").modal("hide");
                } else {
                    getDataAssessmenDermatovenerologi({
                        visit: hasil
                    })
                    // successSwal('Sukses');
                    $("#pemeriksaanKulit-modal").modal("hide");
                }
            });
        });
    };

    const renderDataTabelsAssessmenDermatovenerologi = (props) => {
        let resultTables = ""
        props?.data?.map((e, index) => {
            resultTables += `
                            <tr>
                                <td>${index +1}</td>
                                <td>${e?.examination_date ? moment(e?.examination_date).format(
                                    "DD/MM/YYYY HH:mm") :"-"}</td>
                                <td class="d-flex justify-content-start">
                                    <button type="button" 
                                            class="btn btn-outline-primary checkbox-toggle pull-right w-50 formEditDermatovenerologi" 
                                            data-id="${e?.body_id}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#pemeriksaanKulit-modal"
                                            >
                                        <i class="far fa-edit"></i> Ubah
                                    </button>
                                    <button type="button" class="btn btn-outline-danger checkbox-toggle pull-right w-50 formDeleteDermatovenerologi"  data-id="${e?.body_id}" >
                                        <i class="far fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            `
        })

        if ($.fn.DataTable.isDataTable('#tableDat-Dermatovenerologi')) {
            $('#tableDat-Dermatovenerologi').DataTable().destroy();
        }
        $("#bodydatapemeriksaanKulit").html(resultTables)
        $('#tableDat-Dermatovenerologi').DataTable({
            destroy: true,
            dom: '<"mb-3"B>rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
            lengthChange: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ]
        });
        actionButtonInTabelssKulit(props)
    }


    const actionButtonInTabelssKulit = (props) => {
        $("#bodydatapemeriksaanKulit").on("click", ".formEditDermatovenerologi", function() {
            const id = $(this).data("id");
            const selectedData = props.data.find(item => item.body_id === id);
            if (selectedData) {
                templateDermatovenerologi({
                    data: selectedData
                })
            }
        });

        $("#bodydatapemeriksaanKulit").on("click", ".formDeleteDermatovenerologi", function() {
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
                    deleteActionDermatovenerologi({
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

    const deleteActionDermatovenerologi = (props) => {
        postData({
            id: props?.data?.body_id,
        }, 'admin/AssDermatovenerologi/deleteData', (res) => {
            if (res.respon === true) {
                successSwal('Data berhasil Dihapus.');
                let hasil = {
                    no_registration: props?.data?.no_registration,
                    org_unit_code: props?.data?.org_unit_code,
                    session_id: props?.data?.document_id

                }
                getDataAssessmenDermatovenerologi({
                    visit: hasil
                });
            } else {
                errorSwal("Gagal Di hapus")
            }
        });
    }
</script>