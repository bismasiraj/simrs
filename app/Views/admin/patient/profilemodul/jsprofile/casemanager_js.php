<script type="text/javascript">
    (function() {
        $("casemanager").on("click", e => {
            getDataTable();
        })


        $(document).ready(function() {
            getDataTable();

            fetchEntryTypes().then(() => {

            }).catch((error) => {
                console.error('Gagal mengambil data jenis entri:', error);
            });

            $("#btn-create-casemanager").off().on("click", (e) => {
                e.preventDefault();
                selectParamCasemanager();
                actionViewParam();


                btnSaveAction();
                $('#btn-save-cm-modal').removeAttr('hidden');
                $('#btn-edit-cm-modal').attr('hidden', true);
            });


        });


        let htmlContent = '';
        const getType = (props) => {
            return new Promise((resolve) => {
                let entry = entryTypes.find(item => item.entry_id === parseInt(props.code));
                if (props) {
                    if (parseInt(props.code) === 1) {
                        htmlContent = `<input type="text" class="form-control form-thems" id="value_info-${props.valueId}" name="value_info-${props.valueId}">`;
                        resolve(htmlContent);
                    } else if (parseInt(props.code) === 2) {
                        let labelContent = props.tb ? props.tb : 'Ya, terlaksana';
                        // htmlContent = `
                        //     <input type="checkbox" class="form-check-input" id="value_info-${props.valueId}" name="value_info-${props.valueId}" value="1">
                        //     <label class="form-check-label" for="value_info-${props.valueId}">${labelContent}</label>
                        // `;
                        htmlContent = `
                        <div class="row my-1">
                            <div class="col-8">
                                <input type="checkbox" class="form-check-input" id="value_info-${props.valueId}" name="value_info-${props.valueId}" value="1">
                                 <label class="form-check-label" for="value_info-${props.valueId}">${props?.valueDesc}</label>
                            </div>
                            <div class="col-4">
                                <label class="form-check-label badge btn btn-outline-primary btn-sm px-2 py-1" for="value_info-${props.valueId}">${labelContent}</label>
                            </div>
                        </div>
                        `;
                        resolve(htmlContent);
                    } else if (parseInt(props.code) === 3) {
                        postData({
                            nameTables: props?.tb,
                            score: "3",
                            vId: props?.valueId
                        }, 'admin/CaseManager/getTablesAll', (res) => {
                            let dataResult = `<select class="form-control" id="value_info-${props.valueId}" name="value_info-${props.valueId}">`;
                            res.forEach(item => {
                                dataResult += `<option value="${item.id}">${item.val}</option>`;
                            });
                            dataResult += `</select>`;
                            resolve(dataResult);
                        });
                    } else if (parseInt(props.code) === 4) {

                        htmlContent =
                            `
                            <label class="form-label fw-bold" for="editor-cm-${props.valueId}">${props?.valueDesc}</label>
                            <input type="hidden" name="value_info-${props.valueId}" id="hidden-value_info_cm-${props.valueId}">
                            <div id="editor-cm-${props.valueId}" name="value_info-${props.valueId}" style="height: 200px;">${props?.tb}</div>
                            `;

                        resolve(htmlContent);
                    } else if (parseInt(props.code) === 5) {
                        htmlContent = `<input class="form-control datetime-input" type="datetime-local" id="value_info-${props.valueId}" name="value_info-${props.valueId}">`;
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
                        }, 'admin/CaseManager/getTablesAll', (res) => {
                            let dataResult = '';
                            res.forEach(item => {
                                dataResult += `
                        <div class="form-check">
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
                        htmlContent = entry.entry;
                        resolve(htmlContent);
                    }
                } else {
                    htmlContent =
                        `<input type="hidden" name="value_info-${props.valueId}" id="hidden-value_info_cm-${props.valueId}">
                           <div id="editor-cm-${props.valueId}" name="value_info-${props.valueId}" style="height: 200px;"></div>`;
                    resolve(htmlContent);
                }
            });
        };


        const actionViewParam = (props) => {
            let res = <?= json_encode($aValue); ?>;

            let filteredData = res.filter(item => item?.p_type === "GEN0019");
            filteredData.sort((a, b) => a.parameter_id.localeCompare(b.parameter_id));


            let dataHtml = '';
            let promises = [];

            filteredData.forEach((e) => {
                if (!(e.value_score === 9 || e.value_score === 8 || !e.value_score || e.value_desc === "")) {
                    promises.push(getType({
                        code: e?.value_score,
                        valueId: e?.value_id,
                        valueDesc: e?.value_desc,
                        tb: e?.value_info,
                        parameterId: e?.parameter_id
                    }).then((htmlContent) => {
                        let colClass = !e.parameter_id.startsWith('CM_B_') ? 'col-12' : 'col-6'; // Adjust column class based on value_score

                        // Adjusted HTML template with vertical centering and fixed height

                        dataHtml += `
                    <div class="form-group mb-0 ${e.value_score === 4 ? 'pt-4 mb-2' :''} ${colClass}">
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

            if (props?.action === "detail" || props?.action === "edit") {
                return Promise.all(promises).then((htmlContents) => {
                    $("#content-param-casemanager").html(contentHide() + dataHtml);
                    initializeQuillEditors();
                }).catch((error) => {
                    console.error('Error updating content:', error);
                });
            } else {
                return Promise.all(promises).then((htmlContents) => {
                    $("#content-param-casemanager").html(contentHide() + dataHtml);
                    // tinymce.remove('textarea.tinymce-init');
                    // tinymce.init({
                    //     selector: 'textarea.tinymce-init',
                    //     init_instance_callback: function(editor) {}
                    // });
                    initializeQuillEditors();
                }).catch((error) => {
                    console.error('Error updating content:', error);
                });
            }
        };

        const contentHide = () => {
            return `
            <div hidden>
                <input class="form-control disabled" list="datalistOptions" id="body_id" name="body_id" value='${generateCode()}'>
                <input class="form-control disabled" list="datalistOptions" id="org_unit_code" name="org_unit_code" value='<?php echo $visit['org_unit_code'] ?>' >
                <input class="form-control disabled" list="datalistOptions" id="visit_id"name="visit_id" value='<?php echo $visit['visit_id'] ?>' >
                <input class="form-control disabled" list="datalistOptions" id="trans_id" name="trans_id"value='<?php echo $visit['trans_id'] ?>' >
                <input class="form-control disabled" list="datalistOptions" id="p_type" name="p_type"value='GEN0019' >
            </div>
        `;
        };

        let entryTypes = [];
        const fetchEntryTypes = () => {
            return new Promise((resolve, reject) => {
                getDataList('admin/InformedConsent/getType', (res) => {
                    entryTypes = res;
                    resolve();
                });
            });
        };

        const selectParamCasemanager = (props) => {

            let res = <?= json_encode($aParameter); ?>;
            let fill = res?.filter(item => item?.p_type === "GEN0019");
            let data = [];
            fill.map((e) => {
                data += `<option value=${e?.parameter_id}>${e?.parameter_desc}</option>`;
            });
            // $("#parameter_id_casemanager").html(`<option selected disabled value="">Pilih Dokumen</option>` + data);
        };

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

        const btnSaveAction = () => {
            $("#btn-save-cm-modal").off().on("click", function(e) {
                e.preventDefault();
                syncQuillEditorsToForm()
                // let formElement = $('#formDokumentCM');
                // let dataSend = new FormData(formElement);

                let formData = document.querySelector('#formDokumentCM');

                let dataSend = new FormData(formData);
                let jsonObj = {};
                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });
                postData(jsonObj, 'admin/CaseManager/insertData', (res) => {
                    if (res.respon === true) {
                        successSwal('Data berhasil disimpan.');

                        $("#create-modal-casemanager").modal("hide");
                        $('#formDokumentCM')[0].reset();
                        let visit_id = '<?php echo $visit['visit_id']; ?>';
                        getDataTables({
                            visit_id: visit_id
                        });
                    }
                });
            });
        };

        const btnUpdateData = () => {
            $('#btn-edit-cm-modal').off().on("click", (e) => {
                e.preventDefault();
                syncQuillEditorsToForm()
                let formElement = document.getElementById('formDokumentCM');
                let dataSend = new FormData(formElement);
                let jsonObj = {};
                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });


                // if (!jsonObj['parameter_id']) {
                //     jsonObj['parameter_id'] = $("#parameter_id_casemanager").val();
                // }

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
                    putData(validJsonObj, 'admin/CaseManager/updateData', (res) => {
                        if (res.respon === true) {
                            successSwal('Data berhasil diPerbarui.');
                            $("#create-modal-casemanager").modal("hide");
                            $('#formDokumentCM')[0].reset();
                            let visit_id = '<?php echo $visit['visit_id']; ?>';
                            getDataTables({
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

        const getDataTable = (props) => {
            $("#casemanagerTab").off().on("click", function(e) {
                e.preventDefault();

                getLoadingscreen("contentToHideCM", "load-content-cm")

                let visit_id = '<?php echo $visit['visit_id']; ?>';
                getDataTables({
                    visit_id: visit_id
                });
            });
        };
        const getDataTables = (props) => {
            postData({
                visit_id: props.visit_id
            }, 'admin/CaseManager/getData', (res) => {

                if (res.length >= 1) {

                    renderTables(res);
                } else {
                    $("#bodydataCM").html(tempTablesNull())
                }
            }, (beforesend) => {
                // getLoadingGlobalServices('bodydataCM')
                $("#bodydataCM").html(loadingScreen())
            });
        };
        const renderTables = (data) => {

            let res = <?= json_encode($aParameter); ?>;
            let fill = res?.filter(item => item?.p_type === "GEN0019");

            let groupedData = {};
            let date_modified = [];

            filterUniqueByBodyId(data).forEach((item, index) => {
                const key = `${item.body_id}-${item.parameter_id.replaceAll(' ', '')}-${item.visit_id}`;
                const modifiedDate = item.modified_date;
                if (!groupedData[key]) {
                    groupedData[key] = [];
                }
                groupedData[key].push(item);
                date_modified.push(modifiedDate)
            });

            const tableRows = Object.keys(groupedData).map((key, index) => {
                const [bodyId, parameterId, visitId] = key.split("-");
                const trimmedParameterId = parameterId.trim();
                const parameterItem = fill.find(param => param.parameter_id.replaceAll(' ', '') === (
                    trimmedParameterId === "13" ? "RM_9_F03" : trimmedParameterId
                ));
                const parameterDesc = parameterItem ? parameterItem.parameter_desc : "-";
                return `
                    <tr>
                        <td width="1%">${index + 1}</td>
                        <td>${'Dokumentasi Case Manager-' + bodyId + ' (' + moment(date_modified[index]).format("DD-MM-YYYY : hh:mm") + ')'}</td>
                        <td width="1%"><button type="button" class="btn btn-sm btn-info btn-show-detail" id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" data-param_id="${trimmedParameterId}"><i class="fas fa-search-plus"></i> Lihat</button></td>
                        <td width="1%"><button type="button" class="btn btn-sm btn-primary btn-show-edit" id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" data-param_id="${trimmedParameterId}"><i class="fas fa-edit"></i> Ubah</button></td>
                        <td width="1%"><button type="button" class="btn btn-sm btn-danger btn-show-delete" id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" data-param_id="${trimmedParameterId}" data-param_desc="${parameterDesc}"><i class="fas fa-trash-alt"></i> Hapus</button></td>
                        <td width="1%"><button type="button" class="btn btn-sm btn-secondary btn-show-print" id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" data-param_id="${trimmedParameterId}" data-param_desc="${parameterDesc}"><i class="fas fa-print"></i> Print</button></td>
                    </tr>
                    `;
            }).join('');

            $("#bodydataCM").html(tableRows);

            const table = $('#bodydataCM').closest('table').DataTable({
                dom: "tr<'row'<'col-sm-4'p><'col-sm-4 text-center'i><'col-sm-4 text-end'l>>",
                stateSave: true,
                "bDestroy": true
            });

            getDataRead();
            getDataEdit();
            deleteModal();
            actionCetak();
        };


        function filterUniqueByBodyId(data) {
            let seen = {}; // Object to track seen body_ids
            let filteredData = [];

            // Iterate through each item in the data array
            data.forEach(item => {
                // Check if body_id has been seen before
                if (!seen[item.body_id]) {
                    seen[item.body_id] = true; // Mark body_id as seen
                    filteredData.push(item); // Add item to filteredData
                }
            });

            return filteredData;
        }
        const getDataRead = () => {
            $('.btn-show-detail').on('click', function(e) {
                postData({
                    body_id: $(this).data('id'),
                    visit_id: $(this).data('visit_id')
                }, 'admin/CaseManager/getDetail', (res) => {
                    modalViewDetail({
                        data: res
                    });
                });
            });
        };
        const getDataEdit = () => {
            $('.btn-show-edit').on('click', function(e) {
                postData({
                    body_id: $(this).data('id'),
                    visit_id: $(this).data('visit_id'),
                    parameter_id: $(this).data('param_id')
                }, 'admin/CaseManager/getDetail', (res) => {
                    modalViewEdit({
                        data: res
                    });
                });
            });
        };

        const deleteModal = () => {
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
                        deleteAction({
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

        const deleteAction = (props) => {
            postData({
                id: props.id,
                visit: props.visit
            }, 'admin/CaseManager/deleteData', (res) => {
                if (res.respon === true) {
                    successSwal('Data berhasil Dihapus.');
                    let visit_id = '<?php echo $visit['visit_id']; ?>';
                    getDataTables({
                        visit_id: visit_id
                    });
                } else {
                    errorSwal("Gagal Di hapus")
                }
            });
        };

        const actionCetak = () => {
            $(".btn-show-print").on('click', function(e) {
                let RequestCentakInf = {
                    body_id: $(this).data('id'),
                    visit_id: $(this).data('visit_id'),
                    parameter_id: $(this).data('param_id'),
                    visit: <?= json_encode($visit); ?>
                };

                let baseUrl = '<?= base_url() ?>';
                let jsonStr = JSON.stringify(RequestCentakInf);
                let base64DataInf = btoa(jsonStr);
                let url = baseUrl + 'admin/CaseManager/cetakData/' + base64DataInf
                window.open(url, "_blank");


            });
        };


        const modalViewDetail = (data) => {

            let resultData = data;
            // selectParamCasemanager();
            let result = resultData.data[0];

            actionViewParam({
                id_param: result.parameter_id,
                action: "detail"
            }).then(() => {
                $("#body_id").val(result?.body_id);
                $("#org_unit_code").val(result.org_unit_code);
                $("#visit_id").val(result.visit_id);
                $("#trans_id").val(result.trans_id);
                $("#p_type").val(result.p_type);

                let res = <?= json_encode($aValue); ?>;
                let filteredData = res.filter(item => item?.p_type === "GEN0019");

                let promises = [];
                filteredData.forEach(item => {
                    if (!(item.value_score === 9 || item.value_score === 8 || !item.value_score || item.value_desc === "")) {
                        let getResultArray = resultData.data.filter(dataItem => dataItem.p_type === "GEN0019" && dataItem.parameter_id === item.parameter_id && dataItem.value_id === item.value_id);

                        if (getResultArray.length > 0) {
                            if (item.value_score === 7) {
                                promises.push(getType({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    valueDesc: item.value_desc,
                                    tb: item.value_info,
                                    parameterId: item?.parameter_id
                                }).then((htmlContent) => {
                                    let container = $(`#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        let content = getResultArray[0].value_info;
                                        let selectVal = content;
                                        $(`input[name="value_info-${item.value_id}"][value="${selectVal}"]`).prop('checked', true);
                                    }
                                }));
                            } else {
                                promises.push(getType({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    valueDesc: item.value_desc,
                                    tb: item.value_info,
                                    parameterId: item?.parameter_id
                                }).then((htmlContent) => {
                                    let container = $(`#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        if (item.value_score == 4) {
                                            const quill = new Quill(
                                                `#editor-cm-${item.value_id}`, {
                                                    theme: 'snow',
                                                    modules: {
                                                        toolbar: true
                                                    }
                                                });
                                            quill.root.innerHTML = getResultArray[0]
                                                .value_info;
                                            quill.enable(false);
                                        }
                                        let content = getResultArray[0].value_info;
                                        if (getResultArray[0].value_score === 2) {
                                            if (getResultArray[0].value_info !== '') {
                                                $(`#value_info-${item.value_id}`).prop('checked', true);
                                            } else {
                                                $(`#value_info-${item.value_id}`).prop('checked', false);
                                            }
                                        }
                                        $(`#value_info-${item.value_id}`).val(content);
                                    }
                                }));
                            }
                        }
                    }
                });

                return Promise.all(promises);
            }).then(() => {



                $("#create-modal-casemanager").find('input[type="radio"]').prop('disabled', true);
                $("#create-modal-casemanager").find('input[type="checkbox"]').prop('disabled', true);
                $("#create-modal-casemanager").find('select').prop('disabled', true);

                $("#create-modal-casemanager").modal("show");
                $('#btn-save-cm-modal').attr('hidden', true);
                $('#btn-edit-cm-modal').attr('hidden', true);
            });
        };

        const modalViewEdit = (data) => {

            let resultData = data;
            // selectParamCasemanager();
            let result = resultData.data[0];

            actionViewParam({
                id_param: result.parameter_id,
                action: "edit"
            }).then(() => {
                $("#body_id").val(result?.body_id);
                $("#org_unit_code").val(result.org_unit_code);
                $("#visit_id").val(result.visit_id);
                $("#trans_id").val(result.trans_id);
                $("#p_type").val(result.p_type);

                let res = <?= json_encode($aValue); ?>;
                let filteredData = res.filter(item => item?.p_type === "GEN0019");

                let promises = [];
                filteredData.forEach(item => {
                    if (!(item.value_score === 9 || item.value_score === 8 || !item.value_score || item.value_desc === "")) {
                        let getResultArray = resultData.data.filter(dataItem => dataItem.p_type === "GEN0019" && dataItem.parameter_id === item.parameter_id && dataItem.value_id === item.value_id);
                        if (getResultArray.length > 0) {
                            if (item.value_score === 7) {
                                promises.push(getType({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    valueDesc: item.value_desc,
                                    tb: item.value_info,
                                    parameterId: item?.parameter_id
                                }).then((htmlContent) => {
                                    let container = $(`#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        let content = getResultArray[0].value_info;
                                        let selectVal = content;

                                        $(`input[name="value_info-${item.value_id}"][value="${selectVal}"]`).prop('checked', true);
                                    }
                                }));
                            } else {
                                promises.push(getType({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    valueDesc: item.value_desc,
                                    tb: item.value_info,
                                    parameterId: item?.parameter_id
                                }).then((htmlContent) => {
                                    let container = $(`#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        if (item.value_score == 4) {
                                            const quill = new Quill(
                                                `#editor-cm-${item.value_id}`, {
                                                    theme: 'snow',
                                                    modules: {
                                                        toolbar: true
                                                    }
                                                });
                                            quill.root.innerHTML = getResultArray[0]
                                                .value_info;
                                        }

                                        let content = getResultArray[0].value_info;
                                        //cek jika data tidak kosong maka checked
                                        if (getResultArray[0].value_score === 2) {
                                            if (getResultArray[0].value_info === '1') {
                                                $(`#value_info-${item.value_id}`).prop('checked', true);
                                            } else {
                                                $(`#value_info-${item.value_id}`).prop('checked', false);
                                            }
                                            $(`#value_info-${item.value_id}`).val('1');
                                        } else {
                                            $(`#value_info-${item.value_id}`).val(content);
                                        }
                                    }
                                }));
                            }
                        }
                    }
                });

                return Promise.all(promises);
            }).then(() => {



                $("#create-modal-casemanager").find('input[type="radio"]').prop('disabled', false);
                $("#create-modal-casemanager").find('input[type="checkbox"]').prop('disabled', false);

                $("#create-modal-casemanager").modal("show");
                $('#btn-save-cm-modal').attr('hidden', true);
                $('#btn-edit-cm-modal').removeAttr('hidden');
                btnUpdateData();
            });
        };
        const initializeQuillEditors = () => {
            document.querySelectorAll('[id^="editor-cm-"]').forEach((element) => {
                const editorId = element.id;
                const hiddenInputId = `hidden-value_info_cm-${editorId.replace('editor-cm-', '')}`;

                if (!element.__quill) {
                    const quill = new Quill(`#${editorId}`, {
                        theme: 'snow',
                        modules: {
                            toolbar: true
                        }
                    });
                    element.__quill = quill;

                    const hiddenInput = document.querySelector(`#${hiddenInputId}`);
                    if (hiddenInput) {
                        if (hiddenInput.value) {
                            quill.root.innerHTML = hiddenInput.value;
                        }


                        quill.on('text-change', () => {
                            hiddenInput.value = quill.root.innerHTML;
                        });
                    }
                }
            });
        };
        const syncQuillEditorsToForm = () => {
            document.querySelectorAll('[id^="editor-cm-"]').forEach((element) => {
                const editorId = element.id;
                const hiddenInputId = `hidden-value_info_cm-${editorId.replace('editor-cm-', '')}`;
                const hiddenInput = document.querySelector(`#${hiddenInputId}`);
                if (hiddenInput && element.__quill) {
                    hiddenInput.value = element.__quill.root.innerHTML;
                }
            });
        };
    })();
</script>