<script type="text/javascript">
(function() {

    $("#familymanTab").off("click").on("click", async function(e) {
        e.preventDefault();

        try {
            getLoadingscreen("contentToHide-familyman", "load-content-familyman");

            await getDataTablesFamilyman({
                no_registration: visit?.no_registration
            });

            $("#btn-create-familyman").off("click").on("click", function(e) {
                e.preventDefault();
                $("#create-modal-familyman").modal("show");

            });

        } catch (error) {}

    });

    $(".familymanTab").off("click").on("click", async function(e) {
        e.preventDefault();
        try {

            await getDataTablesFamilyman({
                no_registration: visit?.no_registration
            });
            $("#create-modal-familyman").modal("show");
            $('#familyManTabContent').find('a').trigger('click');
        } catch (error) {}

    });

    $("#btn-create-familyman-modal").on("click", function() {
        $("#listFamilymanTabels").removeClass("show active").addClass("d-none");
        $("#FormInputFamilyMan").removeClass("d-none").addClass("show active");
        $("a[href='#listFamilymanTabels']").removeClass("active").addClass(
            "");
        templateFamilyman({
            visit: visit
        })
    });

    $("a[href='#listFamilymanTabels']").on("click", function() {
        $("#listFamilymanTabels").removeClass("d-none").addClass("show active");
        $("#FormInputFamilyMan").removeClass("show active").addClass("d-none");
    });

    const getDataTablesFamilyman = async (props) => {
        return new Promise((resolve, reject) => {
            postData({
                    no_registration: props.no_registration
                },
                "admin/Familyman/getData",
                (res) => {
                    if (res.respon === true) {

                        dataSetSelectFamilyman = res?.select
                        renderDataTabelsTreatIntensive({
                            data: res?.data
                        })

                    } else {
                        $("#bodydata-familyman").html(tempTablesNull());
                    }
                    resolve();
                },
                (beforesend) => {
                    getLoadingGlobalServices("bodydata-familyman");
                }
            );
        });
    };

    const templateFamilyman = (props) => {
        const contentShow = [{
                label: "",
                type: "hidden",
                name: "org_unit_code",
                value: props?.data?.org_unit_code ?? props?.visit?.org_unit_code,
                id: "familyman_org_unit_code",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "no_registration",
                value: props?.data?.no_registration ?? props?.visit?.no_registration,
                id: "familyman_no_registration",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "family_id",
                value: props?.data?.family_id ?? "",
                id: "familyman_family_id",
                class: ""
            },
            {
                label: "NIK ID",
                type: "text",
                name: "nik",
                value: props?.data?.nik ?? "",
                id: "familyman_nik",
                class: "",
                action: `oninput="this.value=this.value.replace(/[^0-9]/g,'');"`
            },
            {
                label: "Hubungan Keluarga",
                type: "select",
                name: "family_status_id",
                value: props?.data?.family_status_id ?? "",
                id: "familyman_family_status_id",
                class: ""
            },
            {
                label: "",
                type: "hidden",
                name: "no_registration2",
                value: props?.data?.no_registration2 ?? "",
                id: "familyman_no_registration2",
                class: ""
            },
            {
                label: "Nama",
                type: "text",
                name: "fullname",
                value: props?.data?.fullname ?? "",
                id: "familyman_fullname",
                class: ""
            },
            {
                label: "Penanggung Jawab",
                type: "select",
                name: "isresponsible",
                value: props?.data?.isresponsible ?? "",
                id: "familyman_isresponsible",
                class: ""
            },
            {
                label: "Jenis Kelamin",
                type: "select",
                name: "gender",
                value: props?.data?.gender ?? "",
                id: "familyman_gender",
                class: ""
            },
            {
                label: "Tanggal Lahir",
                type: "text",
                name: "date_of_birth",
                value: props?.data?.date_of_birth ? moment(props?.data?.date_of_birth).format(
                    "DD/MM/YYYY") : moment(new Date()).format("DD/MM/2000"),
                id: "familyman_date_of_birth",
                class: "dateflatpickr-familyman"
            },
            {
                label: "Tempat Lahir",
                type: "text",
                name: "place_of_birth",
                value: props?.data?.place_of_birth ?? "",
                id: "familyman_place_of_birth",
                class: ""
            },
            {
                label: "Agama",
                type: "select",
                name: "kode_agama",
                value: props?.data?.kode_agama ?? "",
                id: "familyman_kode_agama",
                class: ""
            },
            {
                label: "Pendidikan Terakhir",
                type: "select",
                name: "education_type_code",
                value: props?.data?.education_type_code ?? "",
                id: "familyman_education_type_code",
                class: ""
            },
            {
                label: "Pekerjaan",
                type: "select",
                name: "job_id",
                value: props?.data?.job_id ?? "",
                id: "familyman_job_id",
                class: ""
            },
            {
                label: "Gol. Darah",
                type: "select",
                name: "blood_id",
                value: props?.data?.blood_id ?? "",
                id: "familyman_blood_id",
                class: ""
            },
            {
                label: "Status Perkawinan",
                type: "select",
                name: "maritalstatusid",
                value: props?.data?.maritalstatusid ?? "",
                id: "familyman_maritalstatusid",
                class: ""
            },
            {
                label: "Alamat",
                type: "text",
                name: "address",
                value: props?.data?.address ?? "",
                id: "familyman_address",
                class: ""
            },
            {
                label: "Kota",
                type: "text",
                name: "kota",
                value: props?.data?.kota ?? "",
                id: "familyman_kota",
                class: ""
            },
            {
                label: "RT",
                type: "text",
                name: "rt",
                value: props?.data?.rt ?? "",
                id: "familyman_rt",
                class: "",
                action: `oninput="this.value=this.value.replace(/[^0-9]/g,'');"`
            },
            {
                label: "RW",
                type: "text",
                name: "rw",
                value: props?.data?.rw ?? "",
                id: "familyman_rw",
                class: "",
                action: `oninput="this.value=this.value.replace(/[^0-9]/g,'');"`
            },
            {
                label: "No. Telp",
                type: "text",
                name: "phone",
                value: props?.data?.phone ?? "",
                id: "familyman_phone",
                class: ""
            },
            {
                label: "HP",
                type: "text",
                name: "mobile",
                value: props?.data?.mobile ?? "",
                id: "familyman_mobile",
                class: "",
                action: `oninput="this.value=this.value.replace(/[^0-9+]/g,'');"`
            },
            {
                label: "Fax",
                type: "text",
                name: "fax",
                value: props?.data?.fax ?? "",
                id: "familyman_fax",
                class: ""
            },
            {
                label: "Email",
                type: "text",
                name: "email",
                value: props?.data?.email ?? "",
                id: "familyman_email",
                class: ""
            },
            {
                label: "Keterangan",
                type: "text",
                name: "description",
                value: props?.data?.description ?? "",
                id: "familyman_description",
                class: ""
            },

        ];

        const contentVisitShow = [{
                label: "No. CM/MR",
                type: "label",
                name: "",
                value: props?.visit?.org_unit_code ?? "",
                id: "",
                class: ""
            }, {
                label: "Nama",
                type: "label",
                name: "",
                value: props?.visit?.diantar_oleh ?? "",
                id: "",
                class: ""
            },
            {
                label: "Status Pasien",
                type: "label",
                name: "",
                value: props?.visit?.name_of_status_pasien ?? "",
                id: "",
                class: ""
            },
            {
                label: "No. Hp",
                type: "label",
                name: "",
                value: props?.visit?.mobile ?? "",
                id: "",
                class: ""
            },
        ]

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
                            <input ${group?.action ?? ""} type="${group.type}" class="form-control ${group?.class ?? ""}" id="${uniqueId}" name="${group.name}" value="${group.value}" placeholder="${group.label}">
                        </div>
                    </div>
                </div>`;
            }
        });


        let contentHtmlVisit = "";
        let contentHtmlVisitHide = "";

        contentVisitShow.forEach((group) => {
            const uniqueId = group.id || `input-${group.name}`;
            if (group.type === "hidden") {
                contentHtmlVisitHide += `
                <div class="col-6" hidden>
                    <div class="mb-3 row">
                        <div class="col-sm-8">
                            <input type="${group.type}" class="form-control ${group?.class ?? ""}" id="${uniqueId}" name="${group.name}" value="${group.value}">
                        </div>
                    </div>
                </div>`;
            } else if (group.type === "select") {
                contentHtmlVisit += `
                <div class="col-6">
                    <div class="mb-3 row">
                        <label for="${uniqueId}" class="col-sm-4 col-form-label fw-bold">${group.label}</label>
                        <div class="col-sm-8">
                            <select class="form-select ${group?.class ?? ""}" id="${uniqueId}" name="${group.name}"></select>
                        </div>
                    </div>
                </div>`;
            } else if (group.type === "label") {
                contentHtmlVisit += `
                <div class="col-6">
                    <div class="mb-3 row">
                        <label for="${uniqueId}" class="col-sm-4 col-form-label fw-bold">${group.label}</label>
                        <span id="${uniqueId}" name="${group.name}">${group.value}</span>
                        
                    </div>
                </div>`;
            } else {
                contentHtmlVisit += `
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

        $("#contentfamilyman_visit_Show").html(`
        <div class="row">
            ${contentHtmlVisit}
        </div>`);
        $("#contentfamilyman_Show").html(`
        <div class="row">
            ${contentHtml}
        </div>`);
        $("#contentfamilyman_Hide").html(`<div class="row">${contentHtmlHide}</div>`);

        renderDataModalFamilyman({
            data_valAgama: props?.data?.kode_agama,
            data_valBlood_type: props?.data?.blood_id,
            data_valEducation_category: props?.data?.education_type_code,
            data_valJob_category: props?.data?.job_id,
            data_valMartial_status: props?.data?.maritalstatusid,
            data_valResponsibles: props?.data?.family_status_id,
            data_valsex: props?.data?.gender,
            data_valIsresponsible: props?.data?.isresponsible
        });

        initialFlatpicFamilyMan()
        saveAssessmenFamilyMan()
    };

    const renderDataModalFamilyman = (props) => {
        let data_valAgama = props?.data_valAgama || 8;
        let data_valBlood_type = props?.data_valBlood_type || 0;
        let data_valEducation_category = props?.data_valEducation_category || "";
        let data_valJob_category = props?.data_valJob_category || "";
        let data_valMartial_status = props?.data_valMartial_status || "";
        let data_valResponsibles = props?.data_valResponsibles || "";
        let data_valsex = props?.data_valsex || 3;
        let data_valIsresponsible = props?.data_valIsresponsible || 0;

        let resultAgama = "";
        let resultBlood_type = "";
        let resultEducation_category = "";
        let resultJob_category = "";
        let resultMartial_status = "";
        let resultResponsibles = "";
        let resultSex = "";
        let resultIsresponsible = "";

        let dataOption = [{
            id: 1,
            name: "Ya"
        }, {
            id: 0,
            name: "Tidak"
        }]

        dataSetSelectFamilyman?.agama.map(e => {
            const isSelectedAgama = parseInt(data_valAgama) === parseInt(e.kode_agama) ? 'selected' :
                '';
            resultAgama +=
                `<option value="${e.kode_agama}" ${isSelectedAgama}>${e.nama_agama}</option>`;
        });

        dataSetSelectFamilyman?.blood_type.map(e => {
            const isSelectedBlood_type = parseInt(data_valBlood_type) === parseInt(e.blood_type_id) ?
                'selected' : '';
            resultBlood_type +=
                `<option value="${e.blood_type_id}" ${isSelectedBlood_type}>${e.name_of_type}</option>`;
        });

        dataSetSelectFamilyman?.education_category.map(e => {
            const isSelectedEducation_category = parseInt(data_valEducation_category) === parseInt(e
                    .education_type_code) ?
                'selected' : '';
            resultEducation_category +=
                `<option value="${e.education_type_code}" ${isSelectedEducation_category}>${e.description}</option>`;
        });

        dataSetSelectFamilyman?.job_category.map(e => {
            const isSelectedJob_category = parseInt(data_valJob_category) === parseInt(e.job_id) ?
                'selected' :
                '';
            resultJob_category +=
                `<option value="${e.job_id}" ${isSelectedJob_category}>${e.name_of_job}</option>`;
        });

        dataSetSelectFamilyman?.martial_status.map(e => {
            const isSelectedMartial_status = parseInt(data_valMartial_status) === parseInt(e
                    .maritalstatusid) ? 'selected' :
                '';
            resultMartial_status +=
                `<option value="${e.maritalstatusid}" ${isSelectedMartial_status}>${e.name_of_maritalstatus}</option>`;
        });

        dataSetSelectFamilyman?.responsibles.map(e => {
            const isSelectedResponsibles = parseInt(data_valResponsibles) === parseInt(e
                .responsible_id) ? 'selected' : '';
            resultResponsibles +=
                `<option value="${e.responsible_id}" ${isSelectedResponsibles}>${e.responsibles}</option>`;
        });

        dataSetSelectFamilyman?.sex.map(e => {
            const isSelectedSex = parseInt(data_valsex) === parseInt(e.gender) ? 'selected' : '';
            resultSex +=
                `<option value="${e.gender}" ${isSelectedSex}>${e.name_of_gender}</option>`;
        });

        dataOption.map(e => {
            const isSelectedIsresponsible = parseInt(data_valIsresponsible) === parseInt(e.id) ?
                'selected' : '';
            resultIsresponsible +=
                `<option value="${e.id}" ${isSelectedIsresponsible}>${e.name}</option>`;
        });

        $("#familyman_isresponsible").html(resultIsresponsible);
        $("#familyman_family_status_id").html(resultResponsibles);
        $("#familyman_gender").html(resultSex);
        $("#familyman_job_id").html(resultJob_category);
        $("#familyman_education_type_code").html(resultEducation_category);
        $("#familyman_blood_id").html(resultBlood_type);
        $("#familyman_maritalstatusid").html(resultMartial_status);
        $("#familyman_kode_agama").html(resultAgama);
    };


    const initialFlatpicFamilyMan = () => {
        flatpickr(".dateflatpickr-familyman", {
            enableTime: true,
            dateFormat: "d/m/Y",
            time_24hr: true,
            onChange: function(selectedDates, dateStr, instance) {}
        });

        $(".dateflatpickr-familyman").prop("readonly", false)
    }

    const saveAssessmenFamilyMan = () => {
        $("#btn-save-familyman-modal").off().on("click", function(e) {
            e.preventDefault();

            let formElement = document.getElementById('formDokument-familyman');
            let dataSend = new FormData(formElement);
            let jsonObj = {};

            // $("#formDokument-familyman input[type='hidden']").each(function() {
            //     jsonObj[this.name] = this.value;
            // });

            dataSend.forEach((value, key) => {
                if (key === 'date_of_birth' && value) {
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
                no_registration: jsonObj?.no_registration,
            }

            postData(jsonObj, 'admin/Familyman/saveData', (res) => {
                // if (response.success) {
                getDataTablesFamilyman({
                    no_registration: hasil?.no_registration
                })
                successSwal('Sukses');
                $('#familyManTabContent').find('a').trigger('click');
                // $("#create-modal-familyman").modal("hide");
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
                            <td>${e?.fullname}</td>
                            <td class="d-flex justify-content-start">
                                <button type="button" 
                                        class="btn btn-outline-primary checkbox-toggle pull-right w-50 formEditFamilyMan" 
                                        data-id="${e?.family_id}" 
                                        href="#FormInputFamilyMan">
                                    <i class="far fa-edit"></i> Ubah
                                </button>

                                <button type="button" class="btn btn-outline-danger checkbox-toggle pull-right w-50 formDeleteFamilyMan" data-id="${e?.family_id}" >
                                    <i class="far fa-trash-alt"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        `
        });

        $("#bodydata-familyman").html(resultTables);

        actionButtonInTabelssTreatIntensive(props);
    };

    const actionButtonInTabelssTreatIntensive = (props) => {
        $("#bodydata-familyman").on("click", ".formEditFamilyMan", function() {
            $("a[href='#listFamilymanTabels']").removeClass("active").addClass(
                "");
            $("#listFamilymanTabels").removeClass("show active").addClass("fade");
            $("#FormInputFamilyMan").removeClass("d-none").addClass("show active");
            const id = $(this).data("id");
            const selectedData = props.data.find(item => item.family_id === id);
            if (selectedData) {
                templateFamilyman({
                    data: selectedData,
                    visit: visit
                })
            }
        });

        $("#bodydata-familyman").on("click", ".formDeleteFamilyMan", function() {
            let id = $(this).data('id');
            const selectedData = props.data.find(item => item.family_id === id);
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
                    deleteActionFamiliyMan({
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


    const deleteActionFamiliyMan = (props) => {
        postData({
            id: props?.data?.family_id,
            no_registration: props?.data?.no_registration
        }, 'admin/Familyman/deleteData', (res) => {
            if (res.respon === true) {
                successSwal('Data berhasil Dihapus.');
                let hasil = {
                    no_registration: props?.data?.no_registration,
                }
                getDataTablesFamilyman({
                    no_registration: hasil?.no_registration
                })
                $('#familyManTabContent').find('a').trigger('click');

            } else {
                errorSwal("Gagal Di hapus")
            }
        });
    }


})();
</script>