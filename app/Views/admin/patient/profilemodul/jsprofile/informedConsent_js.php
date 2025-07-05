<script type="text/javascript">
    (function() {
        let aValue = ["samsnaknskanskanksanksn"]
        let aPramInf = []
        let aValueInf = []
        let optionsInf = []
        let familyAction = []
        let visitAction = []
        let employeeSelect = []
        let diagAction = []


        const getDataParameter = () => {
            let visit_idVal = visit?.visit_id
            return new Promise((resolve, reject) => {
                getDataList(`admin/InformedConsent/getDataAssesment/${visit_idVal}`, (res) => {
                    if (res) {
                        aPramInf = res?.aPram;
                        aValueInf = res?.aValue;
                        optionsInf = res?.options;
                        familyAction = res?.family;
                        visitAction = res?.visit;
                        employeeSelect = res?.employeeAll
                        diagAction = res?.diag
                        resolve();
                    } else {
                        reject(
                            'Error: Data tidak diterima');
                    }
                });
            });
        }


        // select doc
        const selectParamInf = (props) => {
            let res = aPramInf
            let fill = res?.filter(item => item?.p_type === "GEN0017");
            let data = [];
            fill.map((e) => {
                data +=
                    `<option value=${e?.parameter_id}>${e?.parameter_desc}</option>`;
            });
            $("#inf_parameter_id").html(`<option selected disabled value="">Pilih Dokumen</option>` + data);
        };

        const actionParamInf = (props) => {
            $("#inf_parameter_id").on("change", (e) => {
                let val = $("#inf_parameter_id").val();
                actionViewParamInf({
                    id_param: val
                });
            });
        };

        const contentHideInf = () => {
            return `
            <div hidden>
                <input class="form-control disabled" list="datalistOptions" id="inf_body_id" name="body_id" value='${generateCodeInf()}'>
                <input class="form-control disabled" list="datalistOptions" id="inf_org_unit_code" name="org_unit_code" value='<?php echo $visit['org_unit_code'] ?>' >
                <input class="form-control disabled" list="datalistOptions" id="inf_visit_id"name="visit_id" value='<?php echo $visit['visit_id'] ?>' >
                <input class="form-control disabled" list="datalistOptions" id="inf_trans_id" name="trans_id"value='<?php echo $visit['trans_id'] ?>' >
                <input class="form-control disabled" list="datalistOptions" id="inf_p_type" name="p_type"value='GEN0017' >
            </div>
        `;
        };

        // let entryTypes = [];

        // const fetchEntryTypes = () => {
        //     return new Promise((resolve, reject) => {
        //         getDataList('admin/InformedConsent/getTypeInf', (res) => {
        //             entryTypes = res;
        //             resolve();
        //         });
        //     });
        // };

        const getTypeInf = (props) => {

            return new Promise((resolve) => {
                // let entry = entryTypes.find(item => item.entry_id === parseInt(props.code));
                let htmlContent = '';
                if (props) {
                    if (parseInt(props.code) === 1) {


                        let valueResult = "";
                        let filtersName = props.nameCheck.toLowerCase()

                        if (filtersName.includes("pemberi informasi")) {

                            let content = props?.dataVal?.value_info || "";


                            let result = employeeSelect?.map((e) => {
                                let isSelected = e.fullname === content ? 'selected' : '';
                                return `<option value="${e.fullname}" ${isSelected}>${e.fullname}</option>`;
                            }).join('') || "";

                            if (content && !employeeSelect.some(e => e.fullname === content)) {
                                result += `<option value="${content}" selected>${content}</option>`;
                            }

                            htmlContent = `
                                    <select class="form-control select-employe_all-family" id="value_info-${props.valueId}" name="value_info-${props.valueId}">
                                        ${result}
                                    </select>
                                `;

                            // htmlContent =
                            //     `<input type="text" class="form-control form-thems" id="value_info-${props.valueId}" name="value_info-${props.valueId}" value="${valueResult ?? ""}" >`;
                        } else {

                            if ((filtersName.includes("nama") || filtersName.includes(
                                    "penerima informasi")) && !filtersName.includes("nama tindakan")) {
                                valueResult = familyAction?.fullname;
                            } else if (filtersName.includes("ktp") || filtersName.includes("sim")) {
                                valueResult = familyAction?.nik
                            } else if (filtersName.includes("umur")) {
                                const dateOfBirth = familyAction?.date_of_birth;
                                if (dateOfBirth) {
                                    const birthDate = new Date(dateOfBirth);
                                    const currentDate = new Date();

                                    let age = currentDate.getFullYear() - birthDate
                                        .getFullYear();
                                    const monthDifference = currentDate.getMonth() - birthDate
                                        .getMonth();

                                    if (monthDifference < 0 || (monthDifference === 0 && currentDate
                                            .getDate() <
                                            birthDate.getDate())) {
                                        age--;
                                    }

                                    valueResult = age;
                                }
                            } else if (filtersName.includes("alamat")) {
                                valueResult = familyAction?.address
                            } else if (filtersName.includes("telepon") || filtersName.includes("/hp")) {
                                valueResult = familyAction?.phone ?? familyAction?.mobile
                            } else if (props?.tb === "MOW") {
                                valueResult = "MOW"
                            }
                            const agreedTextList = [
                                "dengan ini menyatakan setuju",
                                "dengan ini menyatakan menolak"
                            ];

                            const matchedTexts = agreedTextList.filter(txt => filtersName.includes(txt));

                            if (matchedTexts.length > 0) {
                                let content = props?.dataVal?.value_info || "";
                                valueResult = content || "";

                                htmlContent = matchedTexts.map(text => {
                                    const agreedLabel = $.map(text.split(" "), function(word) {
                                        return word.charAt(0).toUpperCase() + word.slice(1)
                                            .toLowerCase();
                                    }).join(" ");

                                    const optionValue = text.toLowerCase().includes("setuju") ?
                                        "Setuju" : "Menolak";
                                    const isChecked = valueResult ? "checked" : "";


                                    return `
                                                                    <div class="form-check">
                                                                        <input  
                                                                            class="form-check-input agreed-option" 
                                                                            type="checkbox" 
                                                                            data-group="agreement-${props?.dataVal?.parameter_id}" 
                                                                            data-value="${optionValue}" 
                                                                            data-id="${props.valueId}" 
                                                                            id="value_info-${props.valueId}-${optionValue.toLowerCase()}" 
                                                                            name="value_info-${props.valueId}-${optionValue.toLowerCase()}" 
                                                                            ${isChecked}>
                                                                        <label class="form-check-label" for="value_info-${props.valueId}-${optionValue.toLowerCase()}">
                                                                            ${agreedLabel}
                                                                        </label>
                                                                    </div>
                                                                `;
                                }).join("") + `
                                                                <input 
                                                                    type="hidden" 
                                                                    id="value_info-${props.valueId}" 
                                                                    class="agreed-hidden" 
                                                                    data-group="agreement-${props?.dataVal?.parameter_id}"  
                                                                    name="value_info-${props.valueId}" 
                                                                    value="${valueResult}">
                                                            `;
                            } else {
                                htmlContent =
                                    `<input type="text" class="form-control form-thems" id="value_info-${props.valueId}" name="value_info-${props.valueId}" value="${valueResult ?? ""}" >`;
                            }

                        }
                        resolve(htmlContent);
                    } else if (parseInt(props.code) === 2) {
                        htmlContent =
                            `<input type="checkbox" class="form-check-input" id="value_info-${props.valueId}" name="value_info-${props.valueId}" value="1">
                                <label class="form-check-label" for="value_info-${props.valueId}">${props?.nameCheck}</label>`;
                        resolve(htmlContent);
                    } else if (parseInt(props.code) === 3) {
                        let valueResult = "";
                        let filtersName = props.nameCheck.toLowerCase()
                        if (filtersName.includes("jenis kelamin") || filtersName.includes("kelamin")) {
                            valueResult = familyAction?.gender
                        } else if (filtersName.includes("status pernikahan") || filtersName.includes(
                                "pernikahan")) {
                            valueResult = familyAction?.maritalstatusid
                        } else if (filtersName.includes("agama")) {
                            valueResult = familyAction?.maritalstatusid
                        } else if (filtersName.includes("alamat")) {
                            valueResult = familyAction?.kode_agama
                        } else if (filtersName.includes("pekerjaan")) {
                            valueResult = familyAction?.job_id
                        } else if (filtersName.includes("hubungan dengan pasien") || filtersName.includes(
                                "adalah") || filtersName.includes("selaku") || filtersName.includes(
                                "Selaku") || filtersName.includes(
                                "penolakan") || filtersName.includes("setuju") || filtersName.includes(
                                "terhadap")) {
                            valueResult = familyAction?.family_status_id

                        } else if (filtersName.includes("menjadi kelas") || filtersName.includes(
                                "di kelas")) {
                            valueResult = visitAction?.class_id
                        } else if (filtersName.includes("dari kelas")) {
                            valueResult = visitAction?.class_id_plafond
                        } else if (filtersName.includes("dari pasien") || filtersName.includes(
                                "menjadi pasien")) {
                            valueResult = visitAction?.status_pasien_id
                        }

                        const option = optionsInf.filter(item => item.category === props?.tb
                            .toLowerCase());
                        let dataResult =
                            `<select class="form-select" id="value_info-${props.valueId}" name="value_info-${props.valueId}">`;
                        option.map(item => {
                            dataResult +=
                                `<option value="${item.id}" ${item?.id === parseInt(valueResult)  ? 'selected' : ''}>${item.name}</option>`;
                        });
                        dataResult += `</select>`;

                        resolve(dataResult);

                    } else if (parseInt(props.code) === 4) {

                        let valueResult = "";
                        let filtersName = props.nameCheck.toLowerCase()

                        if (filtersName.includes("diagnosis (wd dan dd)") && props?.dataVal === undefined) {

                            htmlContent =
                                `
                            <input type="hidden" name="value_info-${props.valueId}" id="hidden-value_info-inf-${props?.valueId}">
                           <div id="editor-inf-${props.valueId}" name="value_info-${props.valueId}" style="height: 200px;">${(props?.tb || diagAction?.diagnosa_desc) ?? ''}</div>`;
                            resolve(htmlContent);
                        } else {
                            htmlContent =
                                `
                        <input type="hidden" name="value_info-${props.valueId}" id="hidden-value_info-inf-${props.valueId}">
                           <div id="editor-inf-${props.valueId}" name="value_info-${props.valueId}" style="height: 200px;">${props?.tb}</div>`;
                            resolve(htmlContent);
                        }


                    } else if (parseInt(props.code) === 5) {
                        let valueResult = "";
                        let filtersName = props.nameCheck.toLowerCase()
                        if (filtersName.includes("tanggal lahir")) {
                            valueResult = familyAction?.date_of_birth

                        }

                        htmlContent =
                            `
                        <input class="form-control datetimeflatpickr-inf" type="text" id="flatvalue_info-${props.valueId}" value="${valueResult?moment(valueResult).format("DD/MM/YYYY HH:mm") :moment(new Date()).format("DD/MM/YYYY HH:mm")}">
                        <input class="form-control" type="hidden" id="value_info-${props.valueId}" name="value_info-${props.valueId}" value="${valueResult?moment(valueResult).format("DD/MM/YYYY HH:mm") :moment(new Date()).format("DD/MM/YYYY HH:mm")}" >
                        `

                        resolve(htmlContent);
                    } else if (parseInt(props.code) === 6) {
                        htmlContent = `<div class="form-check">
                                <input class="form-check-input" type="checkbox" name="value_info-${props.valueId}-multi1" id="value_info-${props.valueId}-multi1" value="option1">
                                <label class="form-check-label" for="value_info-${props.valueId}-multi1">Option 1</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="value_info-${props.valueId}-multi2" id="value_info-${props.valueId}-multi2" value="option2">
                                <label class="form-check-label" for="value_info-${props.valueId}-multi2">Option 2</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="value_info-${props.valueId}-multi3" id="value_info-${props.valueId}-multi3" value="option3">
                                <label class="form-check-label" for="value_info-${props.valueId}-multi3">Option 3</label>
                              </div>`;
                        resolve(htmlContent);
                    } else if (parseInt(props.code) === 7) {
                        postData({
                            nameTables: props.tb,
                            score: "7",
                            vId: props?.valueId
                        }, 'admin/InformedConsent/getTablesAll', (res) => {
                            let dataResult = '';
                            res.forEach(item => {
                                dataResult += `<div class="form-check">
                            <input class="form-check-input" type="radio" name="value_info-${props.valueId}" id="value_info-${props.valueId}-${item.id}" value="${item.id}">
                            <label class="form-check-label" for="value_info-${props.valueId}-${item.id}">${item.val}</label>
                        </div>`;
                            });
                            resolve(dataResult);
                        });
                    } else if (parseInt(props.code) === 8) {
                        htmlContent = `Teks Statis Dokumen`;
                        resolve(htmlContent);
                    } else if (parseInt(props.code) === 9) {
                        htmlContent = `Ambil data dari VISIT`;
                        resolve(htmlContent);
                    } else {
                        htmlContent = '';
                        resolve(htmlContent);
                    }

                } else {
                    htmlContent =
                        `<input type="hidden" name="value_info-${props.valueId}" id="hidden-value_info-inf-${props.valueId}">
                <div id="editor-inf-${props.valueId}" name="value_info-${props.valueId}" style="height: 200px;"></div>`;
                    resolve(htmlContent);
                }

            });

        };

        const initializeFlatpickrInf = (props) => {
            $(".datetimeflatpickr-inf").each(function() {
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
                    dateFormat: "d/m/Y H:i", // Display format
                    time_24hr: true, // 24-hour time format
                    defaultDate: initialDate, // Use the correctly parsed or default date
                });
            });

            $(".datetimeflatpickr-inf").prop("readonly", false);

            $(".datetimeflatpickr-inf").on("change", function() {
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

            $(".datetimeflatpickr-inf").trigger("change");

            $(`.select-employe_all-family`).select2({
                placeholder: "",
                dropdownParent: $(
                    '#create-modal'),
                theme: "bootstrap-5",
                allowClear: false,
                width: "100%"
            });

            $(document).on('change', '.agreed-option', function() {
                // console.log("lllllll");

                const group = $(this).data('group');
                const valueId = $(this).data('id');
                const selectedValue = $(this).data('value');

                if (this.checked) {

                    $(`.agreed-option[data-group="${group}"]`).not(this).each(function() {
                        const otherId = $(this).data('id');
                        $(this).prop('checked', false);
                        $(`#value_info-${otherId}`).val('');
                    });

                    $(`#value_info-${valueId}`).val(selectedValue);
                } else {

                    $(`#value_info-${valueId}`).val('');
                }
            });
        }


        const actionViewParamInf = (props) => {

            let res = aValueInf;

            let filteredData = res?.filter(item => item?.p_type === "GEN0017" && item?.parameter_id
                .replaceAll(' ',
                    '') === props?.id_param);

            let dataHtml = '';
            let promises = [];

            let filterPemberi = filteredData?.filter(item => item?.value_desc.toLowerCase() ===
                "pemberi informasi")[0] ?? [];

            let ResultfilterPemberiInfor = props?.resultData?.filter(item => item?.value_id === filterPemberi
                ?.value_id)[0]

            filteredData.forEach((e) => {
                if (!(e.value_score === 9 || e.value_score === 8 || !e.value_score || e.value_desc ===
                        "")) {
                    promises.push(getTypeInf({
                        code: e.value_score,
                        valueId: e.value_id,
                        tb: e?.value_info,
                        nameCheck: e?.value_desc,
                        dataVal: ResultfilterPemberiInfor
                    }).then((htmlContent) => {
                        dataHtml += `
                <div class="form-group row mb-0 pt-4" id="value-container-${e.value_id}">
                    <label for="" class="col-sm-4 col-form-label pr-0 fw-bold" data-id="${e.value_id}">
                        ${e.value_score === 2 ? "" : e.value_desc}
                    </label>
                    <div hidden>
                        <input class="form-control disabled" list="datalistOptions" id="value_score" name="value_score-${e.value_id}" value="${e.value_score}">
                        <input class="form-control disabled" list="datalistOptions" id="value_desc" name="value_desc-${e.value_id}" value="${e.value_desc.replace(/^"+|"+$/g, '').replace(/^\\+"|\\+"$/g, '')}">
                        <input class="form-control disabled" list="datalistOptions" id="value_id" name="value_id" value="${e.value_id}">
                    </div>
                    <div class="col-sm pl-sm-0" id="type-container-${e.value_id}">
                        ${htmlContent}
                    </div>
                </div>`;
                        return htmlContent;
                    }));
                }
            });

            return Promise.all(promises)
                .then((htmlContents) => {
                    $("#content-param").html(contentHideInf() + dataHtml);
                    initializeQuillEditorsInf();
                    syncQuillEditorsToFormInf(0)
                    initializeFlatpickrInf();
                })
                .catch((error) => {
                    console.error('Error updating content:', error);
                });



        };

        const initializeQuillEditorsInf = () => {
            document.querySelectorAll('[id^="editor-inf-"]').forEach((element) => {
                const editorId = element.id;
                const hiddenInputId = `hidden-value_info-inf-${editorId.replace('editor-inf-', '')}`;
                const hiddenInput = document.getElementById(hiddenInputId);

                if (!element.__quill) {
                    const quill = new Quill(`#${editorId}`, {
                        theme: 'snow',
                        modules: {
                            toolbar: true
                        }
                    });

                    element.__quill = quill;

                    if (hiddenInput) {

                        if (hiddenInput.value) {
                            quill.root.innerHTML = hiddenInput.value
                        }

                        quill.on('text-change', () => {
                            hiddenInput.value = quill.root.innerHTML
                        });
                    }
                }
            });
        };

        const syncQuillEditorsToFormInf = () => {
            document.querySelectorAll('[id^="editor-inf-"]').forEach((element) => {
                if (element.__quill) {
                    const editorId = element.id;
                    const hiddenInputId = `hidden-value_info-inf-${editorId.replace('editor-inf-', '')}`;
                    const hiddenInput = document.getElementById(hiddenInputId);
                    if (hiddenInput) {
                        hiddenInput.value = element.__quill.root.innerHTML
                    }
                }
            });
        };



        const btnSaveActionInf = () => {
            $("#btn-save-inf-modal").off().on("click", function(e) {
                e.preventDefault();

                syncQuillEditorsToFormInf();

                let formElement = document.getElementById('formDokument');
                let dataSend = new FormData(formElement);
                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });

                postData(jsonObj, 'admin/InformedConsent/insertData', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil disimpan.');

                        $("#create-modal").modal("hide");
                        $('#formDokument')[0].reset();
                        let visit_id = '<?php echo $visit['visit_id']; ?>';

                        getDataTablesInf({
                            visit_id: visit_id
                        });
                    }
                });
            });
        };

        const generateCodeInf = () => {
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

        // get data
        // const getDataTableInf = async (props) => {
        $("#informConcentTab").off("click").on("click", async function(e) {
            e.preventDefault();

            try {
                await getDataParameter();

                getLoadingscreen("contentToHide", "load-content-inf");

                const visit_id = visit?.visit_id
                await getDataTablesInf({
                    visit_id
                });

                $("#btn-create").off().on("click", (e) => {
                    e.preventDefault();
                    selectParamInf();
                    actionViewParamInf();
                    btnSaveActionInf();
                    actionParamInf();
                    $('#btn-save-inf-modal').removeAttr('hidden');
                    $('#btn-edit-inf-modal').attr('hidden', true);
                    $('#formsignInf').attr('hidden', true);

                    $("#create-modal").modal("show");
                    $('#inf_parameter_id').prop('disabled', false);
                    $('#inf_parameter_id').select2();
                });

                $("#close-create-modal").off().on("click", (e) => {
                    e.preventDefault();
                    $("#create-modal").modal("hide");
                });

                $('#create-modal').on('shown.bs.modal', function() {
                    $('#inf_parameter_id').select2({
                        dropdownParent: $('#create-modal')
                    });
                    // $('#formsignInf').on('click', function() {
                    //     $("#digitalSignModalOperation").modal("show");
                    //     $('#create-modal').modal('hide');
                    // });
                    syncQuillEditorsToFormInf();

                    btnUpdateDataInf();
                });

            } catch (error) {
                console.error('Terjadi kesalahan:',
                    error);
            }
        });
        // };


        const getDataTablesInf = async (props) => {
            return new Promise((resolve, reject) => {
                postData({
                        visit_id: props.visit_id
                    },
                    "admin/InformedConsent/getData",
                    (res) => {
                        if (res.length >= 1) {
                            renderTablesInf(res);
                        } else {
                            $("#bodydata").html(tempTablesNull());
                        }
                        resolve();
                    },
                    (beforesend) => {
                        getLoadingGlobalServices("bodydata");
                    }
                );
            });
        };


        const getDataReadSignInf = () => {
            $('.btn-show-sign').on('click', function(e) {
                postData({
                    body_id: String($(this).data('id')),
                    visit_id: $(this).data('visit_id'),
                    parameter_id: $(this).data('param_id')
                }, 'admin/InformedConsent/getDetail', (res) => {
                    modalViewDetailInf({
                        data: res?.data,
                        view: "Sign"
                    });
                });
            });
        };

        const getDataReadInf = () => {
            $('.btn-show-detail').on('click', function(e) {
                postData({
                    body_id: String($(this).data('id')),
                    visit_id: $(this).data('visit_id'),
                    parameter_id: $(this).data('param_id')
                }, 'admin/InformedConsent/getDetail', (res) => {

                    modalViewDetailInf({
                        data: res?.data,
                        view: "Detail"
                    });
                });
            });
        };
        const getDataEditInf = () => {
            $('.btn-show-edit').on('click', function(e) {
                postData({
                    body_id: String($(this).data('id')),
                    visit_id: $(this).data('visit_id'),
                    parameter_id: $(this).data('param_id')
                }, 'admin/InformedConsent/getDetail', (res) => {

                    modalViewEditInf({
                        data: res?.data
                    });
                });
            });
        };

        const modalViewEditInf = (data) => {
            $('#inf_parameter_id').prop('disabled', true);
            $('#inf_parameter_id').select2();

            let resultData = data;
            selectParamInf();
            let result = resultData.data[0];


            actionViewParamInf({
                id_param: result.parameter_id.replace(/\s+/g, ""),
                action: "edit",
                resultData: resultData?.data
            }).then(() => {
                $("#inf_body_id").val(result?.body_id);
                $("#inf_org_unit_code").val(result.org_unit_code);
                $("#inf_visit_id").val(result.visit_id);
                $("#inf_trans_id").val(result.trans_id);
                $("#inf_p_type").val(result.p_type);
                $("#inf_parameter_id").val(result.parameter_id.replace(/\s+/g, ""));

                let res = aValueInf;
                let filteredData = res?.filter(item => item?.p_type === "GEN0017" && item
                    ?.parameter_id
                    .replaceAll(' ', '') === result?.parameter_id.replace(/\s+/g, ""));

                let promises = [];
                filteredData.forEach(item => {

                    if (!(item.value_score === 9 || item.value_score === 8 || !item
                            .value_score ||
                            item.value_desc === "")) {
                        let getResultArray = resultData.data.filter(dataItem => dataItem
                            .p_type ===
                            "GEN0017" && dataItem.parameter_id === item.parameter_id &&
                            dataItem
                            .value_id === item.value_id);


                        if (getResultArray.length > 0) {
                            if (item.value_score === 7) {
                                promises.push(getTypeInf({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    tb: item.value_info,
                                    nameCheck: item?.value_desc
                                }).then((htmlContent) => {
                                    let container = $(
                                        `#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        let content = getResultArray[0]
                                            .value_info;
                                        let selectVal = content;

                                        $(`input[name="value_info-${item.value_id}"][value="${selectVal}"]`)
                                            .prop('checked', true);
                                    }
                                }));
                            } else if (item.value_score === 5) {
                                promises.push(getTypeInf({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    tb: item.value_info,
                                    nameCheck: item?.value_desc
                                }).then((htmlContent) => {
                                    let container = $(
                                        `#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        let content = getResultArray[0]
                                            .value_info;
                                        let selectVal = content;

                                        $(`#value_info-${item.value_id}`).val(
                                            moment(selectVal).format(
                                                "DD/MM/YYYY HH:mm"));
                                        $(`#flatvalue_info-${item.value_id}`).val(
                                            moment(selectVal).format(
                                                "DD/MM/YYYY HH:mm"))

                                    }
                                }));

                            } else {

                                promises.push(getTypeInf({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    tb: item.value_info,
                                    nameCheck: item?.value_desc,
                                    dataVal: getResultArray[0]
                                }).then((htmlContent) => {
                                    let container = $(
                                        `#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        if (item.value_score == 4) {

                                            $(`#editor-inf-${item.value_id}`).html(
                                                getResultArray[0]
                                                .value_info)
                                            // const quill = new Quill(
                                            //     `#editor-inf-${item.value_id}`, {
                                            //         theme: 'snow',
                                            //         modules: {
                                            //             toolbar: true
                                            //         }
                                            //     });
                                            // quill.root.innerHTML =
                                            //     getResultArray[0]
                                            //     .value_info;
                                        }

                                        let content = getResultArray[0]
                                            .value_info;
                                        if (getResultArray[0].value_score ===
                                            2) {
                                            if (getResultArray[0].value_info ===
                                                '1') {
                                                $(`#value_info-${item.value_id}`)
                                                    .prop(
                                                        'checked', true);
                                            } else {
                                                $(`#value_info-${item.value_id}`)
                                                    .prop(
                                                        'checked', false);
                                            }
                                            $(`#value_info-${item.value_id}`)
                                                .val('1');
                                        } else {

                                            $(`#value_info-${item.value_id}`)
                                                .val(
                                                    content);
                                        }
                                    }
                                }));
                            }
                        }
                    }
                });

                return Promise.all(promises);

            }).then(() => {
                initializeFlatpickrInf()
                initializeQuillEditorsInf()
                syncQuillEditorsToFormInf()
                $("#create-modal").find('.form-control').prop('disabled', false);
                $("#create-modal").find('input[type="radio"]').prop('disabled', false);
                $("#create-modal").find('input[type="checkbox"]').prop('disabled', false);

                $("#create-modal").modal("show");
                // $("#create-modal").attrClass("modal-dialog-scrollable")
                $('#formsignInf').attr('hidden', true);

                $('#btn-save-inf-modal').attr('hidden', true);
                $('#btn-edit-inf-modal').removeAttr('hidden');
                btnUpdateDataInf();
            });


        };


        const btnUpdateDataInf = () => {
            $('#btn-edit-inf-modal').off().on("click", (e) => {
                e.preventDefault();

                syncQuillEditorsToFormInf()


                let formElement = document.getElementById('formDokument');
                let dataSend = new FormData(formElement);
                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });


                if (!jsonObj['parameter_id']) {
                    jsonObj['parameter_id'] = $("#inf_parameter_id").val();
                }

                let validJsonObj = {};
                for (let key in jsonObj) {
                    if (key.startsWith('value_desc-')) {
                        if (jsonObj[key] !== "") {
                            let id = key.split('-')[1];
                            validJsonObj[`value_score-${id}`] = jsonObj[`value_score-${id}`];
                            validJsonObj[`value_desc-${id}`] = jsonObj[`value_desc-${id}`];
                            validJsonObj[`value_info-${id}`] = jsonObj[`value_info-${id}`];
                        }
                    } else if (!key.startsWith('value_score-') && !key.startsWith('value_info-')) {
                        validJsonObj[key] = jsonObj[key];
                    }
                }

                if (!validJsonObj['parameter_id']) {
                    validJsonObj['parameter_id'] = jsonObj['parameter_id'];
                }


                if (Object.keys(validJsonObj).length > 0) {
                    putData(validJsonObj, 'admin/InformedConsent/updateData', (res) => {
                        if (res.respon === true) {
                            successSwal('Data berhasil diPerbarui.');
                            $("#create-modal").modal("hide");
                            $('#formDokument')[0].reset();
                            let visit_id = '<?php echo $visit['visit_id']; ?>';

                            getDataTablesInf({
                                visit_id: visit_id
                            });
                        } else {
                            errorSwal("Gagal Di Perbarui");
                        }
                    });
                } else {
                    errorSwal("Tidak ada data yang valid untuk diperbarui.");
                }
            });
        };

        const modalViewDetailInf = (props) => {
            $('#inf_parameter_id').prop('disabled', true);
            $('#inf_parameter_id').select2();

            let resultData = props?.data;

            selectParamInf();
            let result = resultData[0];

            actionViewParamInf({
                id_param: result?.parameter_id.replace(/\s+/g, ""),
                action: "edit",
                resultData: resultData
            }).then(() => {
                $("#inf_body_id").val(result?.body_id);
                $("#inf_org_unit_code").val(result?.org_unit_code);
                $("#inf_visit_id").val(result?.visit_id);
                $("#inf_trans_id").val(result?.trans_id);
                $("#inf_p_type").val(result?.p_type);
                $("#inf_parameter_id").val(result.parameter_id.replace(/\s+/g, ""));

                let res = aValueInf;
                let filteredData = res?.filter(item => item?.p_type === "GEN0017" && item
                    ?.parameter_id
                    .replaceAll(' ', '') === result?.parameter_id.replace(/\s+/g, ""));

                let promises = [];
                filteredData?.forEach(item => {

                    if (!(item.value_score === 9 || item.value_score === 8 || !item
                            .value_score ||
                            item.value_desc === "")) {
                        let getResultArray = resultData.filter(dataItem => dataItem
                            .p_type ===
                            "GEN0017" && dataItem.parameter_id === item.parameter_id &&
                            dataItem
                            .value_id === item.value_id);

                        if (getResultArray.length > 0) {
                            if (item.value_score === 7) {
                                promises.push(getTypeInf({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    tb: item.value_info,
                                    nameCheck: item?.value_desc
                                }).then((htmlContent) => {
                                    let container = $(
                                        `#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        let content = getResultArray[0]
                                            .value_info;
                                        let selectVal = content;

                                        $(`input[name="value_info-${item.value_id}"][value="${selectVal}"]`)
                                            .prop('checked', true);
                                    }
                                }));
                            } else if (item.value_score === 5) {
                                promises.push(getTypeInf({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    tb: item.value_info,
                                    nameCheck: item?.value_desc
                                }).then((htmlContent) => {
                                    let container = $(
                                        `#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        let content = getResultArray[0]
                                            .value_info;
                                        let selectVal = content;


                                        $(`#flatvalue_info-${item.value_id}`).val(
                                            moment(selectVal).format(
                                                "DD/MM/YYYY HH:mm"))

                                        $(`#value_info-${item.value_id}`).val(
                                            moment(selectVal).format(
                                                "DD/MM/YYYY HH:mm"));
                                    }
                                }));
                            } else {
                                promises.push(getTypeInf({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    tb: item.value_info,
                                    nameCheck: item?.value_desc,
                                    dataVal: getResultArray[0]
                                }).then((htmlContent) => {
                                    let container = $(
                                        `#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        if (item.value_score == 4) {

                                            $(`#editor-inf-${item.value_id}`).html(
                                                getResultArray[0]
                                                .value_info)
                                            // const quill = new Quill(
                                            //     `#editor-inf-${item.value_id}`, {
                                            //         theme: 'snow',
                                            //         modules: {
                                            //             toolbar: true
                                            //         }
                                            //     });
                                            // quill.root.innerHTML =
                                            //     getResultArray[0]
                                            //     .value_info;
                                        }

                                        let content = getResultArray[0]
                                            .value_info;
                                        if (getResultArray[0].value_score ===
                                            2) {
                                            if (getResultArray[0].value_info ===
                                                '1') {
                                                $(`#value_info-${item.value_id}`)
                                                    .prop(
                                                        'checked', true);
                                            } else {
                                                $(`#value_info-${item.value_id}`)
                                                    .prop(
                                                        'checked', false);
                                            }
                                            $(`#value_info-${item.value_id}`)
                                                .val('1');
                                        } else {

                                            $(`#value_info-${item.value_id}`)
                                                .val(
                                                    content);
                                        }
                                    }
                                }));
                            }


                        }
                    }
                });
                return Promise.all(promises);
            }).then(() => {
                initializeFlatpickrInf()
                initializeQuillEditorsInf()
                syncQuillEditorsToFormInf()
                $("#create-modal").find('.form-control').prop('disabled', false);
                $("#create-modal").find('input[type="radio"]').prop('disabled', false);
                $("#create-modal").find('input[type="checkbox"]').each(function() {
                    $(this).prop('disabled', false);
                    this.setAttribute('onclick', 'return false;');
                });

                $('#formDokument :input').prop('readonly', true);
                $('#formDokument select').prop('disabled', true);

                $('#formDokument .ql-container').each(function() {
                    let quillInstance = Quill.find($(this).get(0));
                    if (quillInstance) {
                        quillInstance.enable(false);
                    }
                });

                $("#create-modal").modal("show");
                if (props?.view === "Detail") {
                    $('#formsignInf').attr('hidden', true);
                } else {
                    let signInfFill = resultData?.filter(e => e.value_score === 1 || e.value_score === "1")

                    if (signInfFill.length > 0) {
                        signInfFill
                    } else {
                        signInfFill = resultData?.filter(e => e.value_score === 0 || e.value_score === "0")
                    }
                    let resultDataSign = signInfFill[0]

                    $("[id^='formsignInfvalid_']").prop('disabled', false);
                    if (resultDataSign?.valid_user) {
                        $("#formsignInfvalid_user")
                            .removeClass("btn-outline-warning")
                            .addClass("btn-danger")
                            .prop("disabled", true);
                    }
                    if (resultDataSign?.valid_pasien) {
                        $("#formsignInfvalid_pasien").removeClass("btn-outline-warning")
                            .addClass("btn-danger").prop('disabled', true);
                    }
                    if (resultDataSign?.valid_other) {
                        $("#formsignInfvalid_other").removeClass("btn-outline-warning")
                            .addClass("btn-danger").prop('disabled', true);
                    }
                    if (resultDataSign?.valid_other2) {
                        $("#formsignInfvalid_other2").removeClass("btn-outline-warning")
                            .addClass("btn-danger").prop('disabled', true);
                    }
                    if (resultDataSign?.valid_other3) {
                        $("#formsignInfvalid_other3").removeClass("btn-outline-warning")
                            .addClass("btn-danger").prop('disabled', true);
                    }



                    $("button[name='signInf']").off().on("click", function() {

                        const signKe = $(this).data('sign-ke');
                        const userType = $(this).data('user-type');
                        const filed = $(this).data('filed')

                        if (!$(this).is(':disabled')) {
                            $(".modal.show").modal("hide");
                            let btnIdInf = `sign-inf-${resultDataSign?.body_id}`


                            addSignUser(formId = "formDokument", container = "", primaryKey =
                                "inf_body_id", buttonId = btnIdInf, docs_type = 13,
                                user_type = userType, sign_ke = signKe, title =
                                "Inform Consent",
                                columnName = filed,
                                value_id = resultDataSign?.value_id)
                        }
                        // $(this).prop('disabled', true);

                    });
                    $('#formsignInf').attr('hidden', false);

                }

                $('#btn-save-inf-modal').attr('hidden', true);
                $('#btn-edit-inf-modal').attr('hidden', true);
            });
        };


        const renderTablesInf = (data) => {
            let res = aPramInf;
            let fill = res?.filter(item => item?.p_type === "GEN0017");

            const tableRows = data.map((item, index) => {

                const bodyId = item.body_id;
                const dateId = item?.modified_date ? moment(item?.modified_date).format(
                        "DD/MM/YYYY HH:mm") :
                    ""
                const parameterId = item.parameter_id.replaceAll(' ', '');
                const visitId = item.visit_id;
                const validUser = item.valid_user;
                const isEditable = [item.valid_other, item.valid_other2, item.valid_other3, item
                    .valid_pasien, item.valid_user
                ].every(val => val === null);

                const parameterItem = fill.find(param => param.parameter_id.replaceAll(' ', '') ===
                    parameterId);
                const parameterDesc = parameterItem ? parameterItem.parameter_desc : "-";

                const editButton = isEditable ?
                    `<button type="button" class="btn btn-primary btn-show-edit" 
                id="${bodyId}" 
                data-id="${bodyId}" 
                data-visit_id="${visitId}" 
                data-param_id="${parameterId}">
                <i class="far fa-edit"></i> Ubah
            </button>
            <button type="button" class="btn btn-danger btn-show-delete" 
                id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" 
                data-param_id="${parameterId}" data-param_desc="${parameterDesc}">
                <i class="far fa-trash-alt"></i> Hapus
            </button>` : '';

                return `<tr>
                    <td class="fit">${index + 1}</td>
                    <td class="fit">${dateId}</td>
                    <td class="fit">${parameterDesc}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-show-detail" 
                            id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" 
                            data-param_id="${parameterId}">
                            <i class="far fa-eye"></i> Lihat
                        </button>
                        ${editButton} 
                        <button type="button" class="btn btn-secondary btn-show-print" 
                            id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" 
                            data-param_id="${parameterId}" data-param_desc="${parameterDesc}">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-warning btn-show-sign btn-showData-${bodyId}" 
                            id="sign-inf-${bodyId}" data-id="${bodyId}" 
                            data-visit_id="${visitId}" data-param_id="${parameterId}">
                            <i class="fa fa-signature"></i> <span> Sign</span>
                        </button>
                    </td>
                </tr>`;

            }).join('');

            $("#bodydata").html(tableRows);
            getDataReadInf();
            getDataReadSignInf();
            getDataEditInf();
            deleteModalInf();
            actionCetakInf();
            initializeQuillEditorsInf();
            syncQuillEditorsToFormInf();


        };



        const deleteModalInf = () => {
            $('.btn-show-delete').on('click', function(e) {
                let id = $(this).data('id');
                let visit = $(this).data('visit_id');

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
                        deleteActionInf({
                            id: id,
                            visit: visit
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

        const deleteActionInf = (props) => {
            postData({
                id: String(props.id),
                visit: props.visit
            }, 'admin/InformedConsent/deleteData', (res) => {
                if (res.respon === true) {
                    successSwal('Data berhasil Dihapus.');
                    let visit_id = '<?php echo $visit['visit_id']; ?>';
                    getDataTablesInf({
                        visit_id: visit_id
                    });
                } else {
                    errorSwal("Gagal Di hapus")
                }
            });
        };

        const actionCetakInf = () => {
            $(".btn-show-print").on('click', function(e) {
                let RequestCentakInf = {
                    body_id: $(this).data('id'),
                    visit_id: $(this).data('visit_id'),
                    parameter_id: $(this).data('param_id'),
                    visit: visit
                };

                let baseUrl = '<?= base_url() ?>';
                let jsonStr = JSON.stringify(RequestCentakInf);
                let base64DataInf = btoa(jsonStr);
                let url = baseUrl + 'admin/InformedConsent/cetakData/' + base64DataInf
                window.open(url, "_blank");


            });
        };


    })();
</script>