<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript">
    (function() {
        $(document).ready(function() {
            getDataTable();

            fetchEntryTypes().then(() => {

            }).catch((error) => {
                console.error('Gagal mengambil data jenis entri:', error);
            });

            $("#btn-create").off().on("click", (e) => {
                e.preventDefault();
                tinymce.remove();
                selectParam();
                actionViewParam();
                btnSaveAction();
                actionParam();
                $('#btn-save-inf-modal').removeAttr('hidden');
                $('#btn-edit-inf-modal').attr('hidden', true);
                $("#create-modal").modal("show");
                $('#parameter_id').prop('disabled', false);
                $('#parameter_id').select2();
            });
            $("#close-create-modal").off().on("click", (e) => {
                tinymce.remove();
                e.preventDefault();
                $("#create-modal").modal("hide");
            });
            $('#create-modal').on('shown.bs.modal', function() {
                $('#parameter_id').select2({
                    dropdownParent: $('#create-modal')
                });
                btnUpdateData();
            });

        });

        // select doc
        const selectParam = (props) => {

            let res = <?= json_encode($aParameter); ?>;
            let fill = res?.filter(item => item?.p_type === "GEN0017");
            let data = [];
            fill.map((e) => {
                data += `<option value=${e?.parameter_id}>${e?.parameter_desc}</option>`;
            });
            $("#parameter_id").html(`<option selected disabled value="">Pilih Dokumen</option>` + data);
        };

        const actionParam = (props) => {
            $("#parameter_id").on("change", (e) => {
                let val = $("#parameter_id").val();
                actionViewParam({
                    id_param: val
                });
            });
        };

        const contentHide = () => {
            return `
            <div hidden>
                <input class="form-control disabled" list="datalistOptions" id="body_id" name="body_id" value='${generateCode()}'>
                <input class="form-control disabled" list="datalistOptions" id="org_unit_code" name="org_unit_code" value='<?php echo $visit['org_unit_code'] ?>' >
                <input class="form-control disabled" list="datalistOptions" id="visit_id"name="visit_id" value='<?php echo $visit['visit_id'] ?>' >
                <input class="form-control disabled" list="datalistOptions" id="trans_id" name="trans_id"value='<?php echo $visit['trans_id'] ?>' >
                <input class="form-control disabled" list="datalistOptions" id="p_type" name="p_type"value='GEN0017' >
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

        const getType = (props) => {
            return new Promise((resolve) => {
                let entry = entryTypes.find(item => item.entry_id === parseInt(props.code));
                let htmlContent = '';

                if (props) {
                    if (parseInt(props.code) === 1) {
                        htmlContent = `<input type="text" class="form-control form-thems" id="value_info-${props.valueId}" name="value_info-${props.valueId}">`;
                        resolve(htmlContent);
                    } else if (parseInt(props.code) === 2) {
                        htmlContent = `<input type="checkbox" class="form-check-input" id="value_info-${props.valueId}" name="value_info-${props.valueId}" value="1">
                                <label class="form-check-label" for="value_info-${props.valueId}">Check Box</label>`;
                        resolve(htmlContent);
                    } else if (parseInt(props.code) === 3) {
                        postData({
                            nameTables: props?.tb,
                            score: "3",
                            vId: props?.valueId
                        }, 'admin/InformedConsent/getTablesAll', (res) => {
                            let dataResult = `<select class="form-control" id="value_info-${props.valueId}" name="value_info-${props.valueId}">`;
                            res.forEach(item => {
                                dataResult += `<option value="${item.id}">${item.val}</option>`;
                            });
                            dataResult += `</select>`;
                            resolve(dataResult);
                        });
                    } else if (parseInt(props.code) === 4) {
                        htmlContent = `<textarea class="form-control form-thems tinymce-init" id="value_info-${props.valueId}" name="value_info-${props.valueId}" rows="4" cols="50" >${props.tb}   </textarea>`;
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
                        }, 'admin/InformedConsent/getTablesAll', (res) => {
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
                    htmlContent = `<textarea class="form-control form-thems" id="value_info-${props.valueId}" name="value_info-${props.valueId}" rows="4" cols="50"></textarea>`;
                    resolve(htmlContent);
                }
            });
        };

        const actionViewParam = (props) => {
            let res = <?= json_encode($aValue); ?>;
            let filteredData = res.filter(item => item?.p_type === "GEN0017" && item?.parameter_id.replaceAll(' ', '') === props?.id_param);
            filteredData.sort((a, b) => a.parameter_id.localeCompare(b.parameter_id));

            let dataHtml = '';
            let promises = [];
            filteredData.forEach((e) => {
                if (!(e.value_score === 9 || e.value_score === 8 || !e.value_score || e.value_desc === "")) {
                    promises.push(getType({
                        code: e.value_score,
                        valueId: e.value_id,
                        tb: e?.value_info
                    }).then((htmlContent) => {
                        dataHtml += `
                <div class="form-group row mb-0 pt-4">
                    <label for="" class="col-sm-4 col-form-label pr-0" data-id="${e.value_id}">${e.value_desc}</label>
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

            if (props?.action === "detail") {
                return Promise.all(promises).then((htmlContents) => {
                    $("#content-param").html(contentslideUp() + dataHtml);

                    return Promise.resolve();
                });
            } else if (props?.action === "edit") {
                return Promise.all(promises).then((htmlContents) => {
                    $("#content-param").html(contentslideUp() + dataHtml);

                    return Promise.resolve();
                });
            } else {
                return Promise.all(promises).then((htmlContents) => {
                    $("#content-param").html(contentslideUp() + dataHtml);

                    tinymce.remove('textarea.tinymce-init');

                    tinymce.init({
                        selector: 'textarea.tinymce-init',
                        init_instance_callback: function(editor) {}
                    });
                });
            }
        };

        const btnSaveAction = () => {
            $("#btn-save-inf-modal").off().on("click", function(e) {
                e.preventDefault();
                tinymce.triggerSave();

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
                        tinymce.remove();
                        getDataTables({
                            visit_id: visit_id
                        });
                    }
                });
            });
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

        // get data
        const getDataTable = (props) => {
            $("#informConcentTab").off().on("click", function(e) {
                e.preventDefault();

                getLoadingscreen("contentToHide", "load-content-inf")

                let visit_id = '<?php echo $visit['visit_id']; ?>';
                getDataTables({
                    visit_id: visit_id
                });
            });
        };

        const getDataTables = (props) => {
            postData({
                visit_id: props.visit_id
            }, 'admin/InformedConsent/getData', (res) => {
                if (res.length >= 1) {
                    renderTables(res);
                } else {
                    $("#bodydata").html(tempTablesNull())
                }
            }, (beforesend) => {
                getLoadingGlobalServices('bodydata')
                // $("#bodydata").html(loadingScreen())
            });
        };

        const getDataRead = () => {
            $('.btn-show-detail').on('click', function(e) {
                postData({
                    body_id: $(this).data('id'),
                    visit_id: $(this).data('visit_id'),
                    parameter_id: $(this).data('param_id')
                }, 'admin/InformedConsent/getDetail', (res) => {
                    tinymce.remove();
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
                }, 'admin/InformedConsent/getDetail', (res) => {
                    tinymce.remove();
                    modalViewEdit({
                        data: res
                    });
                });
            });
        };

        const modalViewEdit = (data) => {
            $('#parameter_id').prop('disabled', true);
            $('#parameter_id').select2();

            let resultData = data;
            selectParam();
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
                $("#parameter_id").val(result.parameter_id);

                let res = <?= json_encode($aValue); ?>;
                let filteredData = res.filter(item => item?.p_type === "GEN0017" && item?.parameter_id.replaceAll(' ', '').replaceAll(' ', '') === result?.parameter_id);

                let promises = [];
                filteredData.forEach(item => {
                    if (!(item.value_score === 9 || item.value_score === 8 || !item.value_score || item.value_desc === "")) {
                        let getResultArray = resultData.data.filter(dataItem => dataItem.p_type === "GEN0017" && dataItem.parameter_id === item.parameter_id && dataItem.value_id === item.value_id);

                        if (getResultArray.length > 0) {
                            if (item.value_score === 7) {
                                promises.push(getType({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    tb: item.value_info
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
                                    tb: item.value_info
                                }).then((htmlContent) => {
                                    let container = $(`#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        if (item.value_score == 4) {
                                            $(`#value_info-${item.value_id}`).addClass('tinymce');
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
                tinymce.init({
                    selector: 'textarea.tinymce-init',

                    init_instance_callback: function(editor) {
                        let id = editor.id;
                        let content = $(`#${id}`).val();
                        editor.setContent(content);
                    }
                });

                $("#create-modal").find('.form-control').prop('disabled', false);
                $("#create-modal").find('input[type="radio"]').prop('disabled', false);
                $("#create-modal").find('input[type="checkbox"]').prop('disabled', false);

                $("#create-modal").modal("show");
                $('#btn-save-inf-modal').attr('hidden', true);
                $('#btn-edit-inf-modal').removeAttr('hidden');
                btnUpdateData();
            });
        };

        const btnUpdateData = () => {
            $('#btn-edit-inf-modal').off().on("click", (e) => {
                e.preventDefault();
                tinymce.triggerSave();

                let formElement = document.getElementById('formDokument');
                let dataSend = new FormData(formElement);
                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });


                if (!jsonObj['parameter_id']) {
                    jsonObj['parameter_id'] = $("#parameter_id").val();
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
                            tinymce.remove();
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

        const modalViewDetail = (data) => {
            $('#parameter_id').prop('disabled', true);
            $('#parameter_id').select2();

            let resultData = data;
            selectParam();
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
                $("#parameter_id").val(result.parameter_id);

                let res = <?= json_encode($aValue); ?>;
                let filteredData = res.filter(item => item?.p_type === "GEN0017" && item?.parameter_id.replaceAll(' ', '').replaceAll(' ', '') === result?.parameter_id);

                let promises = [];
                filteredData.forEach(item => {
                    if (!(item.value_score === 9 || item.value_score === 8 || !item.value_score || item.value_desc === "")) {
                        let getResultArray = resultData.data.filter(dataItem => dataItem.p_type === "GEN0017" && dataItem.parameter_id === item.parameter_id && dataItem.value_id === item.value_id);

                        if (getResultArray.length > 0) {
                            if (item.value_score === 7) {
                                promises.push(getType({
                                    code: item.value_score,
                                    valueId: item.value_id,
                                    tb: item.value_info
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
                                    tb: item.value_info
                                }).then((htmlContent) => {
                                    let container = $(`#type-container-${item.value_id}`);
                                    if (container.length) {
                                        container.html(htmlContent);

                                        if (item.value_score == 4) {
                                            $(`#value_info-${item.value_id}`).addClass('tinymce');
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
                tinymce.init({
                    selector: 'textarea.tinymce-init',
                    readonly: true,
                    init_instance_callback: function(editor) {
                        let id = editor.id;
                        let content = $(`#${id}`).val();
                        editor.setContent(content);
                    }
                });

                $("#create-modal").find('.form-control').prop('disabled', true);
                $("#create-modal").find('input[type="radio"]').prop('disabled', true);
                $("#create-modal").find('input[type="checkbox"]').prop('disabled', true);
                $("#create-modal").find('select').prop('disabled', true);

                $("#create-modal").modal("show");
                $('#btn-save-inf-modal').attr('hidden', true);
                $('#btn-edit-inf-modal').attr('hidden', true);
            });
        };

        const renderTables = (data) => {
            let res = <?= json_encode($aParameter); ?>;
            let fill = res?.filter(item => item?.p_type === "GEN0017");
            let groupedData = {};
            let dataResult = [];

            data.forEach((item, index) => {
                const key = `${item.body_id}-${item.parameter_id.replaceAll(' ', '')}-${item.visit_id}`;
                if (!groupedData[key]) {
                    groupedData[key] = [];
                }
                groupedData[key].push(item);
            });

            const tableRows = Object.keys(groupedData).map((key, index) => {
                const [bodyId, parameterId, visitId] = key.split("-");
                const trimmedParameterId = parameterId.trim();
                const parameterItem = fill.find(param => param.parameter_id.replaceAll(' ', '') === (
                    trimmedParameterId === "13" ?
                    "RM_9_F03" : trimmedParameterId));
                const parameterDesc = parameterItem ? parameterItem.parameter_desc : "-";

                return `
            <tr>
                <td>${index + 1}</td>
                <td>${parameterDesc}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-info btn-show-detail" id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" data-param_id="${trimmedParameterId}">Lihat</button>
                    <button type="button" class="btn btn-sm btn-primary btn-show-edit" id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" data-param_id="${trimmedParameterId}">Ubah</button>
                    <button type="button" class="btn btn-sm btn-danger btn-show-delete" id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" data-param_id="${trimmedParameterId}" data-param_desc="${parameterDesc}">Hapus</button>
                    <button type="button" class="btn btn-sm btn-secondary btn-show-print" id="${bodyId}" data-id="${bodyId}" data-visit_id="${visitId}" data-param_id="${trimmedParameterId}" data-param_desc="${parameterDesc}">Print</button>
                </td>
            </tr>
        `;
            }).join('');

            $("#bodydata").html(tableRows);
            getDataRead();
            getDataEdit();
            deleteModal();
            actionCetak();
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
            }, 'admin/InformedConsent/deleteData', (res) => {
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
                let url = baseUrl + 'admin/InformedConsent/cetakData/' + base64DataInf
                window.open(url, "_blank");


            });
        };

        const initTinyMCE = (props) => {
            tinymce.remove();
            props?.data.forEach(e => {
                tinymce.init({
                    selector: `#value_info-${e.value_id}`,
                    readonly: props?.action === "detail" ? true : false,
                    setup: function(editor) {
                        editor.on('init', function() {});
                    },
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [{
                            title: "Bold text",
                            inline: "b"
                        },
                        {
                            title: "Red text",
                            inline: "span",
                            styles: {
                                color: "#ff0000"
                            }
                        },
                        {
                            title: "Red header",
                            block: "h1",
                            styles: {
                                color: "#ff0000"
                            }
                        },
                        {
                            title: "Example 1",
                            inline: "span",
                            classes: "example1"
                        },
                        {
                            title: "Example 2",
                            inline: "span",
                            classes: "example2"
                        },
                        {
                            title: "Table styles"
                        },
                        {
                            title: "Table row 1",
                            selector: "tr",
                            classes: "tablerow1"
                        },
                    ],
                });
            });
        };
    })();
</script>