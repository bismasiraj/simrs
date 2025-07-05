<script type="text/javascript">
    $(document).ready(function() {
        console.log("saraf")
        // Event click untuk modal
        $("#pemeriksaanSarafTab").off("click").on("click", function(e) {
            e.preventDefault();
            getLoadingscreen("contentToHide-pemeriksaanSaraf", "load-content-pemeriksaanSaraf")
            groupeActionInTabSaraf()
        });
    });

    const groupeActionInTabSaraf = async () => {
        await getDataAssessmenNeurologi({
            visit: visit
        })
        $("#btn-doc-pemeriksaanSaraf").off("click").on("click", function(e) {
            e.preventDefault();
            $("#pemeriksaanSaraf-modal").modal("show");
            templateNeurologi({
                visit: visit
            })
        });
    }

    const templateNeurologi = (props) => {
        console.log(props)
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
                name: "visit_id",
                value: props?.data?.visit_id ?? props?.visit?.visit_id,
                id: "visit_id",
                class: ""
            }, {
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
                name: "examination_date",
                value: moment(new Date()).format("YYYY-MM-DD HH:mm"),
                id: "examination_date",
                class: ""
            },

            {
                label: "Var/NRS",
                type: "text",
                name: "vas_nrs",
                value: props?.data?.vas_nrs || "",
                id: "vas_nrs",
                class: "groupe-val"
            }, {
                group: "Pupil Kiri",
                fields: [{
                        label: "Diameter",
                        type: "text",
                        name: "left_diameter",
                        value: props?.data?.left_diameter || "3mm",
                        id: "left_diameter",
                        class: "groupe-val"
                    },
                    {
                        label: "Refleks",
                        type: "text",
                        name: "left_light_reflex",
                        value: props?.data?.left_light_reflex || "+",
                        id: "left_light_reflex",
                        class: "groupe-val"
                    },
                    {
                        label: "Kornea",
                        type: "text",
                        name: "left_cornea",
                        value: props?.data?.left_cornea || "Dalam batas normal",
                        id: "left_cornea",
                        class: "groupe-val"
                    },
                    {
                        label: "Isokor Anisokor",
                        type: "text",
                        name: "left_isokor_anisokor",
                        value: props?.data?.left_isokor_anisokor || "isokor",
                        id: "left_isokor_anisokor",
                        class: "groupe-val"
                    }
                ]
            },
            {
                group: "Pupil Kanan",
                fields: [{
                        label: "Diameter",
                        type: "text",
                        name: "right_diameter",
                        value: props?.data?.right_diameter || "3mm",
                        id: "right_diameter",
                        class: "groupe-val"
                    },
                    {
                        label: "Refleks",
                        type: "text",
                        name: "right_light_reflex",
                        value: props?.data?.right_light_reflex || "+",
                        id: "right_light_reflex",
                        class: "groupe-val"
                    },
                    {
                        label: "Kornea",
                        type: "text",
                        name: "right_cornea",
                        value: props?.data?.right_cornea || "Dalam batas normal",
                        id: "right_cornea",
                        class: "groupe-val"
                    },
                    {
                        label: "Isokor Anisokor",
                        type: "text",
                        name: "right_isokor_anisokor",
                        value: props?.data?.right_isokor_anisokor || "isokor",
                        id: "right_isokor_anisokor",
                        class: "groupe-val"
                    }
                ]
            },
            {
                group: "Leher",
                fields: [{
                        label: "Kaku Kuduk",
                        type: "text",
                        name: "stiff_neck",
                        value: props?.data?.stiff_neck || "-",
                        id: "stiff_neck",
                        class: "groupe-val"
                    },
                    {
                        label: "Meningeal Sign",
                        type: "text",
                        name: "meningeal_sign",
                        value: props?.data?.meningeal_sign || "-",
                        id: "meningeal_sign",
                        class: "groupe-val"
                    },
                    {
                        label: "Brudzinski I-IV",
                        type: "text",
                        name: "brudzinki_i_iv",
                        value: props?.data?.brudzinki_i_iv || "-",
                        id: "brudzinki_i_iv",
                        class: "groupe-val"
                    },
                    {
                        label: "Kernig Sign",
                        type: "text",
                        name: "kernig_sign",
                        value: props?.data?.kernig_sign || "-",
                        id: "kernig_sign",
                        class: "groupe-val"
                    },
                    {
                        label: "Dolls Eye Phenomena",
                        type: "text",
                        name: "dolls_eye_phenomenon",
                        value: props?.data?.dolls_eye_phenomenon || "-",
                        id: "dolls_eye_phenomenon",
                        class: "groupe-val"
                    },
                    {
                        label: "Vertebra",
                        type: "text",
                        name: "vertebra",
                        value: props?.data?.vertebra || "Dalam batas normal",
                        id: "vertebra",
                        class: "groupe-val"
                    },
                    {
                        label: "Extremity",
                        type: "text",
                        name: "extremity",
                        value: props?.data?.extremity || "Dalam batas normal",
                        id: "extremity",
                        class: "groupe-val"
                    },

                ]
            },
            {
                group: "Gerak",
                fields: [{
                        label: "Gerak Atas Kiri ",
                        type: "text",
                        name: "motion_upper_left",
                        value: props?.data?.motion_upper_left || "Dalam batas normal",
                        id: "motion_upper_left",
                        class: "groupe-val"
                    },
                    {
                        label: "Gerak Atas Kanan",
                        type: "text",
                        name: "motion_upper_right",
                        value: props?.data?.motion_upper_right || "Dalam batas normal",
                        id: "motion_upper_right",
                        class: "groupe-val"
                    },
                    {
                        label: "Gerak Bawah Kiri",
                        type: "text",
                        name: "motion_lower_left",
                        value: props?.data?.motion_lower_left || "Dalam batas normal",
                        id: "motion_lower_left",
                        class: "groupe-val"
                    },
                    {
                        label: "Gerak Bawah Kanan",
                        type: "text",
                        name: "motion_lower_right",
                        value: props?.data?.motion_lower_right || "Dalam batas normal",
                        id: "motion_lower_right",
                        class: "groupe-val"
                    }
                ]
            },
            {
                group: "Kekuatan",
                fields: [{
                        label: "Kekuatan Atas Kiri ",
                        type: "text",
                        name: "strength_upper_left",
                        value: props?.data?.strength_upper_left || "5",
                        id: "strength_upper_left",
                        class: "groupe-val"
                    },
                    {
                        label: "Kekuatan Atas Kanan",
                        type: "text",
                        name: "strength_upper_right",
                        value: props?.data?.strength_upper_right || "5",
                        id: "strength_upper_right",
                        class: "groupe-val"
                    },
                    {
                        label: "Kekuatan Bawah Kiri",
                        type: "text",
                        name: "strength_lower_left",
                        value: props?.data?.strength_lower_left || "5",
                        id: "strength_lower_left",
                        class: "groupe-val"
                    },
                    {
                        label: "Kekuatan Bawah Kanan",
                        type: "text",
                        name: "strength_lower_right",
                        value: props?.data?.strength_lower_right || "5",
                        id: "strength_lower_right",
                        class: "groupe-val"
                    }
                ]
            },
            {
                group: "Reflek Fisiologi",
                fields: [{
                        label: "Reflek Fisiologi Atas Kiri",
                        type: "text",
                        name: "physiological_reflex_upper_left",
                        value: props?.data?.physiological_reflex_upper_left || "+2",
                        id: "physiological_reflex_upper_left",
                        class: "groupe-val"
                    },
                    {
                        label: "Reflek Fisiologi Atas Kanan",
                        type: "text",
                        name: "physiological_reflex_upper_right",
                        value: props?.data?.physiological_reflex_upper_right || "-2",
                        id: "physiological_reflex_upper_right",
                        class: "groupe-val"
                    },
                    {
                        label: "Reflek Fisiologi Bawah Kiri",
                        type: "text",
                        name: "physiological_reflex_lower_left",
                        value: props?.data?.physiological_reflex_lower_left || "+2",
                        id: "physiological_reflex_lower_left",
                        class: "groupe-val"
                    },
                    {
                        label: "Reflek Fisiologi Bawah Kanan",
                        type: "text",
                        name: "physiological_reflex_lower_right",
                        value: props?.data?.physiological_reflex_lower_right || "-2",
                        id: "physiological_reflex_lower_right",
                        class: "groupe-val"
                    }
                ]
            },
            {
                group: "Reflek Patologi",
                fields: [{
                        label: "Reflek Patologi Atas Kiri",
                        type: "text",
                        name: "pathologycal_reflex_upper_left",
                        value: props?.data?.pathologycal_reflex_upper_left || "-",
                        id: "pathologycal_reflex_upper_left",
                        class: "groupe-val"
                    },
                    {
                        label: "Reflek Patologi Atas Kanan",
                        type: "text",
                        name: "pathologycal_reflex_upper_right",
                        value: props?.data?.pathologycal_reflex_upper_right || "-",
                        id: "pathologycal_reflex_upper_right",
                        class: "groupe-val"
                    },
                    {
                        label: "Reflek Patologi Bawah Kiri",
                        type: "text",
                        name: "pathologycal_reflex_lower_left",
                        value: props?.data?.pathologycal_reflex_lower_left || "-",
                        id: "pathologycal_reflex_lower_left",
                        class: "groupe-val"
                    },
                    {
                        label: "Reflek Patologi Bawah Kanan",
                        type: "text",
                        name: "pathologycal_reflex_lower_right",
                        value: props?.data?.pathologycal_reflex_lower_right || "-",
                        id: "pathologycal_reflex_lower_right",
                        class: "groupe-val"
                    }
                ]
            },
            {
                group: "Clonus/Sensibilitas",
                fields: [{
                        label: "Clonus ",
                        type: "text",
                        name: "clonus",
                        value: props?.data?.clonus || "-",
                        id: "clonus",
                        class: "groupe-val"
                    },
                    {
                        label: "Sensibilitas ",
                        type: "text",
                        name: "sensibility",
                        value: props?.data?.sensibility || "Dalam batas normal",
                        id: "sensibility",
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

        $("#contentAssessmen_Neurologi_Show").html(`
        <div class="row">
            ${contentHtml}
        </div>`);
        // $("#contentAssessmen_Neurologi_Show").html(`
        // <div class="row">
        //     <div class="d-flex justify-content-end">
        //         <button type="button" class="btn btn-outline-primary mb-3" id="default-value-groupe-neurologi">Default</button>
        //     </div>
        //     ${contentHtml}
        // </div>`);
        $("#contentAssessmen_Neurologi_Hide").html(`<div class="row">${contentHtmlHide}</div>`);


        saveAssessmenNeurologi();
        setDefaultValuesSaraf()
    };

    const setDefaultValuesSaraf = () => {
        $("#default-value-groupe-neurologi").on("click", function() {
            $("#contentAssessmen_Neurologi_Show .groupe-val").each(function() {
                $(this).val("Dalam batas normal");
            });
        });
    };

    const getDataAssessmenNeurologi = (props) => {
        return new Promise((resolve) => {
            postData({
                no_registration: props?.visit?.no_registration,
                org_unit_code: props?.visit?.org_unit_code,
                session_id: props?.visit?.session_id,
            }, 'admin/AssNeurology/getData', (res) => {
                templateNeurologi({
                    data: res?.value?.data?.dataAll
                })
            }, (beforesend) => {
                getLoadingGlobalServices('bodydatapemeriksaanSaraf')
            })
            resolve();
        })
    }

    const saveAssessmenNeurologi = () => {
        $("#btn-action-neurologi").off().on("click", function(e) {
            e.preventDefault();

            let formElement = document.getElementById('FormAssessmen_Neurologi');
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
            postData(jsonObj, 'admin/AssNeurology/saveData', (res) => {
                // if (response.success) {
                getDataAssessmenNeurologi({
                    visit: hasil
                })
                successSwal('Sukses');
                $("#pemeriksaanSaraf-modal").modal("hide");
                // }
            });
        });
    };

    const renderDataTabelsAssessmenNeurologi = (props) => {
        let resultTables = ""
        props?.data?.map((e, index) => {
            resultTables += `
                            <tr>
                                <td>${index +1}</td>
                                <td>${e?.examination_date ?moment(e?.examination_date).format(
                                    "DD/MM/YYYY HH:mm") :"-"}</td>
                                <td>${e?.vas_nrs ?? "-"}</td>
                                <td class="d-flex justify-content-start">
                                    <button type="button" 
                                            class="btn btn-outline-primary checkbox-toggle pull-right w-50 formEditNeurologi" 
                                            data-id="${e?.body_id}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#pemeriksaanSaraf-modal"
                                            >
                                        <i class="far fa-edit"></i> Ubah
                                    </button>

                                    <button type="button" class="btn btn-outline-danger checkbox-toggle pull-right w-50 formDeleteNeurologi"  data-id="${e?.body_id}" >
                                        <i class="far fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            `
        })
        if ($.fn.DataTable.isDataTable('#tableDat-pemeriksaanSaraf')) {
            $('#tableDat-pemeriksaanSaraf').DataTable().destroy();
        }
        $("#bodydatapemeriksaanSaraf").html(resultTables)
        $('#tableDat-pemeriksaanSaraf').DataTable({
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
        $("#bodydatapemeriksaanSaraf").on("click", ".formEditNeurologi", function() {
            const id = $(this).data("id");
            const selectedData = props.data.find(item => item.body_id === id);
            if (selectedData) {
                templateNeurologi({
                    data: selectedData
                })
            }
        });

        $("#bodydatapemeriksaanSaraf").on("click", ".formDeleteNeurologi", function() {
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
                    deleteActionNeurologi({
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

    const deleteActionNeurologi = (props) => {
        postData({
            id: props?.data?.body_id,
        }, 'admin/AssNeurology/deleteData', (res) => {
            if (res.respon === true) {
                successSwal('Data berhasil Dihapus.');
                let hasil = {
                    no_registration: props?.data?.no_registration,
                    org_unit_code: props?.data?.org_unit_code,
                    session_id: props?.data?.document_id

                }
                getDataAssessmenNeurologi({
                    visit: hasil
                });
            } else {
                errorSwal("Gagal Di hapus")
            }
        });
    }
</script>