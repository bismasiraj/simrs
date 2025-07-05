<script type="text/javascript">
(function() {

    let visit = <?= json_encode($visit) ?>;
    const allowedTypes = ['GIZ0604', 'GIZ0605', 'GIZ0606', 'GIZ0607', 'GIZ0608', 'GIZ0609'];
    const allowedNames = [
        'ANAK (0-1 TH)',
        'ANAK 1-6 TAHUN',
        'ANAK 7-18 TAHUN ',
        'IBU MELAHIRKAN DAN HAMIL',
        'DEWASA - LANSIA (DIIT BIASA, JANTUNG, GINJAL, RENDAH GARAM, STROKE, PPOK/ASMA (TANPA KOMPLIKASI DM)',
        'DEWASA - LANSIA (DIIT DM)'
    ];

    const arrayPeringatan = [
        'ALBUMIN', 'BB', 'BS', 'DH I', 'DH II', 'DH III', 'DH IV', 'DJ I', 'DJ II',
        'DJ III', 'DJ IV', 'DL I', 'DL II', 'DL III', 'DL IV', 'DM', 'ENCER',
        'KECAP', 'LAUK SARING', 'MC', 'NABATI', 'NB', 'NL', 'PRO 40 GR',
        'PRO 60 GR', 'R. LEMAK', 'R. PURIN', 'R. SERAT', 'RG', 'STROKE I',
        'STROKE II A (BS)', 'STROKE II B (BB)', 'STROKE II C(NB)', 'T. SERAT',
        'TIM SARING', 'TKTP'
    ];

    $(document).ready(function() {

        initializeSearchDietaryHabit('pola_makan_gizi', '#create-modal-gizi')

        flatpickr('.datepicker-gizi', {
            dateFormat: 'Y-m-d H:i',
            defaultDate: moment().format('YYYY-MM-DD HH:mm'),
            enableTime: true,
            time_24hr: true,
            onChange: function(selectedDates, dateStr, instance) {}
        });

        const quillEditor = document.querySelectorAll('.quill-editor-gizi');

        quillEditor.forEach(function(editor, index) {
            new Quill(editor, {
                theme: 'snow',
            });
        });

        // getDataTableGizi();
    });


    // action button
    $('#hasilIntervensiModal').on('shown.bs.modal', function() {
        let container = $('#container_intervention_description');
        container.empty();
        let checkbox = '';

        arrayPeringatan.forEach(item => {
            checkbox += `
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="${item}" id="intervention_description_ + ${item}" name="intervention_description[]">
                        <label class="form-check-label" for="intervention_description_ + ${item}">${item}</label>
                    </div>
                </div>
                `;
        });
        container.append(checkbox);
    })

    $('#foodRecallModal').on('shown.bs.modal', function() {
        flatpickr('.datepicker-gizi', {
            dateFormat: 'Y-m-d H:i',
            defaultDate: moment().format('YYYY-MM-DD HH:mm'),
            enableTime: true,
            time_24hr: true,
            onChange: function(selectedDates, dateStr, instance) {}
        });
    });

    $('#addFoodRecall').off().click(function() {
        $('#formFoodRecall')[0].reset();

        initializeReceipe('nama_masakan_food_recall', 'foodRecallModal')

    });

    $('#tambah-asuhan-gizi').off().click(function() {
        $("#formAsuhanGizi")[0].reset();
        let birth = moment(<?= json_encode(@$visit['tgl_lahir']); ?>);
        let now = moment();
        let daysDiff = now.diff(birth, 'days');


        const filteredItems = aparameter
            ?.filter(item => allowedTypes.includes(item?.p_type))
            .sort((a, b) => a.p_type.localeCompare(b.p_type) || a.parameter_id - b.parameter_id);

        let selectAge = '';
        let currentGroup = '';

        filteredItems.forEach(item => {
            if (item.p_type !== currentGroup) {
                if (currentGroup) selectAge += '</optgroup>';
                const groupIndex = allowedTypes.indexOf(item.p_type);
                const groupLabel = allowedNames[groupIndex];
                currentGroup = item.p_type;
                selectAge += `<optgroup label="${groupLabel.toLowerCase()}">`;
            }

            selectAge +=
                `<option value="${item?.p_type}-${item.parameter_id}">${item.parameter_desc.toLowerCase()}</option>`;
        });

        if (currentGroup) selectAge += '</optgroup>';

        $('#gizi_age_category').html(selectAge);

        let factorActivity = avalue?.filter(item => item?.p_type === 'GIZ0611' && item.parameter_id ===
            '01');
        let factorStress = avalue?.filter(item => item?.p_type === 'GIZ0611' && item.parameter_id === '02');

        function populateSelect(selectId, items) {
            const selectElement = $('#' + selectId);
            selectElement.innerHTML = '';

            if (!items || items.length === 0) {
                selectElement.innerHTML = '<option>No data available</option>';
            } else {
                let optionHtml = '';
                items.forEach(item => {
                    optionHtml +=
                        `<option value="${item.value_id}"
                                data-score="${(item.value_score / 100).toString()}">${item.value_desc}
                            </option>`
                });
                selectElement.html(optionHtml);
            }
        }


        populateSelect('factor_activity', factorActivity);
        populateSelect('factor_stress', factorStress);

        // $('#bbi_gizi').val(bmi)
        // getAge({
        //     visit: visit['visit_id'],
        // }, 'gizi_age_category', daysDiff);

        getAsuhanGizi({
            visit_id: visit['visit_id'],
            no_registration: visit['no_registration'],
            trans_id: visit['trans_id'],
        })
        saveAsuhanGizi();
    });

    $('#btn-close-gizi').off().click(function() {
        $('tr').removeClass('bg-light');
        $('#accordionGizi').hide();
    });

    $("#addDiagnosaGizi").off().on("click", function(e) {
        addRowDiagGizi('bodyDiagGizi');
    });
    // end of action button

    // ====== function render data ======
    const renderGizi = (props) => {

        $('#accordionGizi').hide();
        postData({
            visit_id: props?.visit_id
        }, 'admin/Gizi/getDataGizi', (res) => {
            if (res.respon) {
                let data = res?.data;

                const tableGizi = $('#table_asuhan_gizi').DataTable({
                    dom: "tr<'row'<'col-sm-4'p><'col-sm-4 text-center'i><'col-sm-4 text-end'l>>",
                    stateSave: true,
                    "bDestroy": true
                });
                tableGizi.clear();
                let dataRows = '';
                data.forEach((value, key) => {
                    dataRows = `
                                <tr id="row-${value?.body_id}" class="align-middle">
                                    <td width="1%" class="text-center">${key+1}</td>
                                    <td class="text-center">${value?.nutrition_diagnose ?? '-'}</td>
                                    <td width="1%">
                                    ${value?.treat_image_base64 !== '' && value?.treat_image_base64 !== null ? 
                                        `<button type="button" class="btn btn-outline-primary btn-sm btn-asuhan-gizi-upload" data-type="asuhan_gizi" data-filename="${value?.filename}" data-file="true" data-id="${value?.body_id}"><i class="fas fa-upload"></i></button>`
                                        : 
                                        `<button type="button" class="btn btn-outline-primary btn-sm btn-asuhan-gizi-upload" data-type="asuhan_gizi" data-filename="${value?.filename}" data-file="false" data-id="${value?.body_id}"><i class="fas fa-upload"></i></button>`
                                        }
                                        
                                    </td>
                                    <td width="1%">
                                        <button type="button" class="btn btn-success btn-sm print-row" data-id="${value?.body_id}"><i class="fas fa-print"></i></button>
                                    </td>
                                    
                                    <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['admingizi', 'superuser'])) : ?>
                                    <td style="width:1% !important;" class="text-center p-1">
                                        ${value?.valid_user !== '' && value?.valid_user !== null ? 
                                        `<img src="https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(value?.valid_user)}&size=30x30" alt="QR Code" />`
                                        : 
                                        `<button class="btn btn-sm btn-light btn-asuhan-gizi-sign" data-id="${value?.body_id}" data-gizi="asuhan_gizi"><i class="fas fa-signature"></i></button>`
                                        }
                                    </td>
                                    <?php endif  ?>
                                    <td width="1%">
                                    <button type="button" class="btn btn-success btn-sm assessment-row" data-id="${value?.body_id}">Assessment</button>
                                    </td>
                                    <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['admingizi', 'operatorgizi', 'superuser'])) : ?>
                                    <td width="1%">
                                        <button type="button" class="btn btn-warning btn-sm edit-row-gizi" data-id="${value?.body_id}" data-bs-toggle="modal" data-bs-target="#edit-modal-gizi"><i class="fas fa-edit"></i></button>
                                    </td>
                                    <td width="1%">
                                        <button type="button" class="btn btn-primary btn-sm duplicate-row-gizi" data-id="${value?.body_id}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Duplikat data"><i class="fas fa-clone"></i></button>
                                    </td>
                                    <td width="1%">
                                        <button type="button" class="btn btn-danger btn-sm delete-row-gizi" data-id="${value?.body_id}"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                    <?php endif ?>
                                </tr>
                                `;

                    tableGizi.row.add($(dataRows));
                });

                tableGizi.draw();


                actionSign({
                    container: '.btn-asuhan-gizi-sign'
                })

                $('.validate-row').each(function(index, button) {
                    const id = $(button).data('id');
                    const formId = 'formAsuhanGizi';
                    const primaryKey = id;
                    const formSaveBtn = `formGiziSaveBtn-${index+1}`;
                    if (id) {
                        $(this).prop('disabled', false);
                    } else {
                        $(this).prop('disabled', true);
                    }


                    $("button[name='sign_gizi']").off().on("click", function() {
                        const buttonId = $(this).data('button-id');
                        const signKe = `${index+1}`;
                        addSignUser(formId = "formAsuhanGizi", container =
                            "accordionGizi", primaryKey = id, buttonId = buttonId,
                            docs_type = 15, user_type = 1, sign_ke = 1, title =
                            "Form Asuhan Gizi", columnName = "valid_user");
                        addSignUser(formId = "formAsuhanGizi", container =
                            "accordionGizi", primaryKey = id, buttonId = buttonId,
                            docs_type = 15, user_type = 1, sign_ke = 2, title =
                            "Form Asuhan Gizi", columnName = "valid_user");
                        addSignUser(formId = "formAsuhanGizi", container =
                            "accordionGizi", primaryKey = id, buttonId = buttonId,
                            docs_type = 15, user_type = 3, sign_ke = 1, title =
                            "Form Asuhan Gizi", columnName = "valid_user");
                        // addSignUser = (formId, container, primaryKey, buttonId, docs_type, user_type, sign_ke = 1, title = null, columnName = null)
                    });

                    // if (id) {
                    //     checkSignSignatureGizi(formId, primaryKey, formSaveBtn, '7');
                    // }
                })
                $('.assessment-row').off().on('click', function() {
                    getLoadingscreen("accordionGizi", "load-content-accordion-gizi")
                    const id = $(this).data('id');

                    $('tr').removeClass('bg-light');
                    $('#row-' + id).addClass('bg-light')

                    renderDiagnosaGizi({
                        document_id: id
                    })
                    renderFoodRecall({
                        visit_id: visit['visit_id'],
                        document_id: id
                    })
                    renderIntervensi({
                        visit_id: visit['visit_id'],
                        document_id: id
                    })

                })
                $('.duplicate-row-gizi').off().on('click', function() {
                    const id = $(this).data('id');

                    Swal.fire({
                        title: "Duplikat Data Asesmen?",
                        text: "Data baru akan dibuat sesuai data yang diduplikat",
                        icon: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#7a6fbe",
                        confirmButtonText: "Duplikat",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            postData({
                                visit_id: visit['visit_id'],
                                body_id: id
                            }, 'admin/Gizi/duplikatAsuhanGizi', (res) => {
                                if (res.respon) {
                                    renderGizi({
                                        visit_id: props?.visit_id,
                                        no_registration: props
                                            ?.no_registration
                                    })
                                    successSwal('Data berhasil Diduplikat.');
                                }
                            });

                        }
                    });

                });

                $('.delete-row-gizi').off().on('click', function() {
                    const id = $(this).data('id');
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
                            postData({
                                body_id: id
                            }, 'admin/Gizi/deleteGizi', (res) => {

                                if (res.respon) {
                                    renderGizi({
                                        visit_id: props?.visit_id,
                                        no_registration: props
                                            ?.no_registration
                                    })
                                    successSwal('Data berhasil Dihapus.');
                                } else {
                                    errorSwal("Gagal Di hapus")
                                }

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

                $('.edit-row-gizi').off().on('click', function() {
                    const id = $(this).data('id');
                    getAsuhanGiziByID({
                        visit_id: props?.visit_id,
                        no_registration: props?.no_registration,
                        body_id: id
                    })

                });

                $('.print-row').off().on('click', function() {

                    const id = $(this).data('id');
                    cetakGizi({
                        body_id: id
                    })

                });
                actionUploadGizi({
                    container: '.btn-asuhan-gizi-upload'
                })




            }
        });
        updateAsuhanGizi();
    }

    const renderDiagnosaGizi = (props) => {

        postData({
            document_id: props?.document_id
        }, 'admin/Gizi/getDataDiagnosaGizi', (res) => {
            if (res.respon) {
                let data = res?.data;
                const tbody = $(`#bodyDiagGizi`);
                tbody.empty();

                let dataRows = ''
                data.forEach((value, key) => {

                    addRowDiagGizi('bodyDiagGizi', props?.document_id,
                        value?.diagnosa_id, value?.diagnosa_name ?? value?.diagnosa_desc,
                        value
                        ?.diag_cat,
                        value?.suffer_type);
                });


            }
        });

        saveDiagnosa({
            document_id: props?.document_id
        })

    }
    const actionUploadGizi = (props) => {
        $(props?.container).off().on('click', function() {
            $('#uploadFileGizi').modal('show')
            const id = $(this).data('id');
            const file = $(this).data('file');
            const type = $(this).data('type');
            const filename = $(this).data('filename') ?? '';
            const visit_id = <?= json_encode($visit['visit_id']); ?>;
            if (file) {
                $('#wrapLinkGizi').css('visibility', 'visible');
                $('#linkUploadGizi').text(filename);
            } else {
                $('#wrapLinkGizi').css('visibility', 'hidden');
                $('#linkUploadGizi').text('');
            }

            $('#linkUploadGizi').off().on('click', function(e) {
                filePreview({
                    body_id: id,
                    type: type
                })
            })


            $('#btnUploadGizi').off().on('click', function(e) {

                let formData = document.querySelector('#formUploadGizi');
                let dataSend = new FormData(formData);

                dataSend.set('visit_id', visit_id);
                dataSend.set('id', id);
                dataSend.set('type', type);

                $.ajax({
                    url: '<?php echo base_url(); ?>admin/Gizi/uploadFile',
                    type: "POST",
                    data: dataSend,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        successSwal('Data berhasil disimpan');
                        $("#uploadFileGizi").modal("hide")
                        renderGizi({
                            visit_id: res?.result?.visit_id,
                            no_registration: res?.result?.no_registration,
                        })

                    },
                    error: function() {
                        errorSwal('Data gagal disimpan');
                        $("#uploadFileGizi").modal("hide")
                    }
                });
            })

        });
    }
    const renderFoodRecall = (props) => {

        postData({
            visit_id: props?.visit_id,
            document_id: props?.document_id
        }, 'admin/Gizi/getDataFoodRecall', (res) => {
            if (res.respon && res.data.length >= 1) {
                let data = res?.data;

                let bodyFoodRecall = $('#body-food-recall');
                let dataRows = ''
                let avgMeal_grams = 0
                data.forEach((value, key) => {
                    dataRows += `
                        <tr>
                            <td width="1%" class="text-center fw-bold">
                                ${key+1}
                            </td>
                            <td width="17%" class="text-center">
                                ${moment(value?.recall_date).format('DD-MM-YYYY HH:mm')}
                            </td>
                            <td  width="30%" class="text-center">
                                ${value.meal_name ?? '-'}
                            </td>
                            <td  width="50%">
                                ${value.meal_description ?? '-'}
                            </td>
                             <td  width="10%">
                                ${value.meal_grams ?? 0}
                            </td>
                            <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['admingizi', 'operatorgizi', 'superuser'])) : ?>
                            <td width="1%">
                                <button type="button" class="btn btn-warning btn-sm edit-row-food-recall" data-bs-toggle="modal" data-bs-target="#editFoodRecallModal" data-id="${value?.recall_id}"><i class="fas fa-edit"></i></button>
                            </td>
                            <td width="1%">
                                <button type="button" class="btn btn-danger btn-sm delete-row-food-recall" data-id="${value.recall_id}"><i class="fas fa-trash-alt"></i></button>
                            </td>
                            <?php endif ?>
                        </tr>
                        `;

                    avgMeal_grams += value?.meal_grams ? parseInt(value?.meal_grams) : 0
                });


                let tfoodRecal = `<tr>
                                        <td class="text-end fw-Bold" colspan="4"> Avg Estimasi Gram</td>
                                        <td class="text-end fw-Bold"> ${avgMeal_grams /  data?.length || 0}</td>
                                        <td></td>
                                    </tr>`
                bodyFoodRecall.html(dataRows + tfoodRecal);



                document.querySelectorAll('.validate-row-food-recall').forEach((button, key) => {
                    const id = button.getAttribute('data-id');
                    const formId = 'formFoodRecall';
                    const primaryKey = id;
                    const formSaveBtn = `formFoodRecallSaveBtn-${key+1}`;
                    if (id) {
                        $(this).prop('disabled', false);
                    } else {
                        $(this).prop('disabled', true);
                    }


                    $(`button[data-button-id='formFoodRecallSaveBtn-${key+1}']`).off().on(
                        "click",
                        function() {
                            const buttonId = $(this).data('button-id');
                            const signKe = `2${key+1}`;
                            // addSignUserGizi("formFoodRecall", "accordionGizi", id, buttonId, signKe, signKe, 1, "Form Food Recall");
                            addSignUser(formId = "formFoodRecall", container =
                                "accordionGizi", primaryKey = id, buttonId = buttonId,
                                docs_type = 16, user_type = 1, sign_ke = signKe, title =
                                "Form Food Recall", columnName = "valid_user");

                        });

                    // if (id) {
                    //     checkSignSignatureGizi(formId, primaryKey, formSaveBtn, `2${key+1}`);
                    // }
                })

                document.querySelectorAll('.delete-row-food-recall').forEach(button => {
                    button.addEventListener('click', function(event) {

                        const id = button.getAttribute('data-id');
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
                                postData({
                                    recall_id: id
                                }, 'admin/Gizi/deleteFoodRecall', (
                                    res) => {

                                    if (res.respon) {
                                        renderFoodRecall({
                                            visit_id: props
                                                ?.visit_id,
                                            document_id: props
                                                ?.document_id
                                        })
                                        successSwal(
                                            'Data berhasil Dihapus.'
                                        );
                                    } else {
                                        errorSwal("Gagal Di hapus")
                                    }

                                });
                            } else if (result.dismiss === Swal.DismissReason
                                .cancel) {
                                swalWithBootstrapButtons.fire({
                                    title: "Dibatalkan",
                                    text: "File Anda aman :)",
                                    icon: "error"
                                });
                            }
                        });

                    });
                })

                document.querySelectorAll('.edit-row-food-recall').forEach(button => {
                    button.addEventListener('click', function(event) {

                        const id = button.getAttribute('data-id');

                        postData({
                            recall_id: id,
                            visit_id: props?.visit_id
                        }, 'admin/Gizi/getFoodRecallByID', (res) => {
                            let data = res.data
                            if (res.respon) {
                                // $('#nama_masakan_edit_food_recall').off('change');
                                $('#tanggal_edit_food_recall').val(moment(data
                                    .recall_date).format(
                                    'DD-MM-YYYY HH:mm'));
                                // $('#nama_masakan_edit_food_recall').val(data.meal_name);
                                $('#urt_masakan_edit_food_recall').val(data
                                    .meal_urt);
                                $('#estimasi_gram_edit_food_recall').val(data
                                    .meal_grams);
                                $('#keterangan_edit_food_recall').val(data
                                    .meal_description);
                                $('#netto_bahan_edit_food_recall').val(data
                                    .ingredient_netto);
                                $('#edit_food_recall').val(data.recall_id);

                                $('#nama_bahan_edit_food_recall').val(data
                                    .ingredient_name);
                                $('#urt_bahan_edit_food_recall').val(data
                                    .ingredient_urt);
                                $('#gramasi_bahan_edit_food_recall').val(data
                                    .ingredient_grams);

                                initializeReceipe(
                                    'nama_masakan_edit_food_recall',
                                    'editFoodRecallModal', data)



                            }

                        });
                    });
                })

            } else {
                $('#body-food-recall').html(tempTablesNull())
            }
        });


        saveFoodRecall({
            document_id: props?.document_id
        })

        updateFoodRecall({
            document_id: props?.document_id
        });
    }

    const renderIntervensi = (props) => {
        postData({
            visit_id: props?.visit_id,
            document_id: props?.document_id
        }, 'admin/Gizi/getDataIntervensi', (res) => {
            if (res.respon && res.data.length >= 1) {
                let data = res?.data;
                let bodyIntervensi = $('#body-hasil-intervensi');
                let dataRows = ''
                data.forEach((value, key) => {
                    dataRows += `
                         <tr>
                            <td width="1%" class="text-center">${++key}</td>
                            <td class="text-center">${moment(value?.intervention_date).format('YYYY-MM-DD HH:mm')}</td>
                            <td class="text-center">${value?.intervention_description}</td>
                            <td class="text-center">${value?.intervention_target}</td>
                            <td class="text-center">${value?.intervention_result ?? ''}</td>
                            <td class="text-center">${value?.intervention_problem}</td>
                            <td class="text-center">${value?.intervention_planning}</td>
                            <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['admingizi', 'operatorgizi', 'superuser'])) : ?>
                            <td width="1%" vertical-align="middle">
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-outline-primary btn-sm show-monitoring-evaluasi" data-id="${value?.body_id}" data-bs-toggle="modal" data-bs-target="#monitoringEvaluasiModal"><i class="fas fa-laptop-medical"></i></button>
                                </div>
                            </td>
                            <td width="1%" vertical-align="middle">
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-warning btn-sm edit-row-intervensi" data-id="${value?.body_id}" data-bs-toggle="modal" data-bs-target="#editHasilIntervensiModal"><i class="fas fa-edit"></i></button>
                                </div>
                            </td>
                            <td width="1%" vertical-align="middle">
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-danger btn-sm delete-row-intervensi" data-id="${value?.body_id}"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                            <?php endif; ?>
                        </tr>
                        `;
                });
                bodyIntervensi.html(dataRows);
                document.querySelectorAll('.delete-row-intervensi').forEach(button => {
                    button.addEventListener('click', function(event) {

                        const id = button.getAttribute('data-id');
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
                                postData({
                                    body_id: id
                                }, 'admin/Gizi/deleteIntervensi', (
                                    res) => {

                                    if (res.respon) {
                                        renderIntervensi({
                                            visit_id: props
                                                ?.visit_id,
                                            document_id: props
                                                ?.document_id
                                        })
                                        successSwal(
                                            'Data berhasil Dihapus.'
                                        );
                                    } else {
                                        errorSwal("Gagal Di hapus")
                                    }

                                });
                            } else if (result.dismiss === Swal.DismissReason
                                .cancel) {
                                swalWithBootstrapButtons.fire({
                                    title: "Dibatalkan",
                                    text: "File Anda aman :)",
                                    icon: "error"
                                });
                            }
                        });

                    });
                })

                document.querySelectorAll('.edit-row-intervensi').forEach(button => {
                    button.addEventListener('click', function(event) {

                        const id = button.getAttribute('data-id');

                        postData({
                            body_id: id,
                            visit_id: props?.visit_id
                        }, 'admin/Gizi/getIntervensiByID', (res) => {

                            let data = res?.data
                            if (res.respon) {
                                $('#edit_tanggal_hasil_intervensi').val(moment(
                                    data?.intervention_date).format(
                                    'DD-MM-YYYY HH:mm'));
                                // $('#edit_gizi_hasil_intervensi').val(data.intervention_description);
                                $('#edit_target_hasil_intervensi').val(data
                                    ?.intervention_target);
                                $('#edit_hasil_hasil_intervensi').val(data
                                    ?.intervention_result);
                                $('#edit_masalah_hasil_intervensi').val(data
                                    ?.intervention_problem);
                                $('#edit_rencana_hasil_intervensi').val(data
                                    ?.intervention_planning);
                                $('#edit_intervensi').val(data?.body_id);

                                let container = $(
                                    '#container_edit_intervention_description'
                                );
                                container.empty();
                                let checkbox = '';

                                arrayPeringatan.forEach(item => {
                                    const isChecked = data
                                        .intervention_description
                                        .includes(item) ? 'checked' :
                                        '';

                                    checkbox += `
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="${item}" id="edit_intervention_description_${item.replace(/ /g, '_')}" name="intervention_description[]" ${isChecked}>
                                                <label class="form-check-label" for="edit_intervention_description_${item.replace(/ /g, '_')}">${item}</label>
                                            </div>
                                        </div>
                                        `;
                                });
                                container.append(checkbox);
                            }

                        });
                    });
                })
                document.querySelectorAll('.show-monitoring-evaluasi').forEach(button => {
                    button.addEventListener('click', function(event) {
                        const id = button.getAttribute('data-id');

                        postData({
                            body_id: id,
                            visit_id: props?.visit_id
                        }, 'admin/Gizi/getMonitoring', (res) => {
                            let data = res?.data?.gizi
                            let dataIntervensi = res?.data?.intervensi
                            // getLoadingscreen("content-to-hide-monitoring", "load-content-monitoring")
                            if (res.respon) {
                                $('#tbody-peyajian-gizi').empty();
                                $('#tbody-monitoring-evaluasi').empty();
                                let = dataRowPenyajian = `
                                        <tr>
                                            <td>Kalori</td>
                                            <td>${parseFloat(data?.energi).toFixed(2)}</td>
                                        </tr>
                                        <tr>
                                            <td>Protein</td>
                                            <td>${parseFloat(data?.protein).toFixed(2)} Grams</td>
                                        </tr>
                                        <tr>
                                            <td>Karbohidrat</td>
                                            <td>${parseFloat(data?.karbohidrat).toFixed(2)} Grams</td>
                                        </tr>
                                        <tr>
                                            <td>Lemak</td>
                                            <td>${parseFloat(data?.lemak).toFixed(2)} Grams</td>
                                        </tr>
                                    `;
                                let = dataRow = `
                                    <tr>
                                        <td>${data?.energi}</td>
                                        <td>${dataIntervensi?.intervention_target} %</td>
                                        <td>${(parseFloat(dataIntervensi?.intervention_target) * parseFloat(data?.energi) / 100).toFixed(2)}</td>
                                        <td>${(parseFloat(dataIntervensi?.intervention_target) * parseFloat(data?.protein) / 100).toFixed(2)} Gram</td>
                                        <td>${(parseFloat(dataIntervensi?.intervention_target) * parseFloat(data?.karbohidrat) / 100).toFixed(2)} Gram</td>
                                        <td>${(parseFloat(dataIntervensi?.intervention_target) * parseFloat(data?.lemak) / 100).toFixed(2)} Gram</td>
                                    </tr>
                                    `;
                                $('#tbody-peyajian-gizi').append(
                                    dataRowPenyajian);
                                $('#tbody-monitoring-evaluasi').append(dataRow);
                            }

                        });
                    });
                })

            } else {
                $('#body-hasil-intervensi').html(tempTablesNull())
            }
        });


        saveHasilIntervensi({
            document_id: props?.document_id
        });

        updateHasilIntervensi();
    }
    // ====== end of function render data ======



    // ====== function get data ======
    const getAsuhanGizi = (props) => {

        postData({
            visit_id: props?.visit_id,
            no_registration: props?.no_registration,
            trans_id: props?.trans_id
        }, 'admin/Gizi/getAsuhanGizi', (res) => {
            if (res.respon) {
                let gender = <?= json_encode($visit['gender']); ?>;

                let height = res.data.height ?? 0;
                let weight = res.data.weight ?? 0;
                let heightInMeters = height / 100 ?? 0;
                let ageyear = <?= json_encode($visit['age']); ?>;

                $('#height_gizi').val(height)
                $('#weight_gizi').val(weight)

                $('#tambah-skrining-gizi').off().on('click', function(e) {
                    $("#formSkriningGizi")[0].reset();
                    let birth = moment(<?= json_encode(@$visit['tgl_lahir']); ?>);
                    let now = moment();
                    let exam_info = res.exam_info;

                    let bmi = countBMI({
                        weight: weight,
                        height: height
                    });
                    $('#height_screening').val(height)
                    $('#weight_screening').val(weight)
                    $('#imt_screening').val(isNaN(bmi) ? 0 : bmi)

                    BMIonChange({
                        height: '#height_screening',
                        weight: '#weight_screening',
                        bmi: '#imt_screening',
                    })

                    let daysDiff = now.diff(birth, 'days');
                    getAge({
                        visit: visit['visit_id'],
                    }, 'age_category_screening', daysDiff);

                    $('#select_skrining_gizi').change(function(e) {
                        let selectedOption = $(this).val();
                        selectedOption === '' ? $('#btnSaveSkrining').attr('disabled',
                            'disabled') : $('#btnSaveSkrining').removeAttr(
                            'disabled');

                        getFormScreening({
                            selectedOption: selectedOption,
                            container: '#tbodySkriningGizi',
                        });

                        countScoreAndDescription({
                            select_id: '#tbodySkriningGizi',
                            score_id: '#score_screening',
                            kesimpulan_id: '#kesimpulan_screening',
                            p_type: selectedOption,

                        })

                        $('#tbodySkriningGizi select').on('change', function() {
                            countScoreAndDescription({
                                select_id: '#tbodySkriningGizi',
                                score_id: '#score_screening',
                                kesimpulan_id: '#kesimpulan_screening',
                                p_type: selectedOption,

                            })
                        })
                    })


                    $('#select_skrining_gizi').trigger("change")

                    insertDataScreening();
                })

                let bmi = countBMI({
                    height: height,
                    weight: weight
                });
                bmi = isNaN(bmi) ? 0 : bmi;
                let classification = classificationBMI(bmi);
                let vitalSign = `BB: ${weight}, TB: ${height}, BMI: ${bmi} (${classification})`;

                let bbi = 0;
                bbi = countBBI({
                    height: height,
                    weight: weight,
                    gender: gender,
                    p_type: $('#gizi_age_category').val(),
                })

                $('#bbi_gizi').val(bbi);

                $('#gizi_age_category, #height_gizi, #weight_gizi').change(function(e) {
                    bbi = countBBI({
                        height: $('#height_gizi').val(),
                        weight: $('#weight_gizi').val(),
                        gender: gender,
                        p_type: $('#gizi_age_category').val(),
                    })

                    $('#bbi_gizi').val(bbi);
                })

                let energy = 0;
                energy = countEnergy({
                    height: $('#height_gizi').val(),
                    weight: $('#weight_gizi').val(),
                    bbi: $('#bbi_gizi').val(),
                    factor_activity: $('#factor_activity option:selected').data('score'),
                    factor_stress: $('#factor_stress option:selected').data('score'),
                    gender: gender,
                    ageyear: ageyear,
                    p_type: $('#gizi_age_category').val(),
                })

                $('#energi_gizi').val(energy);

                countNutrition({
                    energy: $('#energi_gizi').val(),
                    p_type: $('#gizi_age_category').val(),
                })

                $('#gizi_age_category, #height_gizi, #weight_gizi, #bbi_gizi, #factor_activity, #factor_stress')
                    .change(function(e) {
                        energy = countEnergy({
                            height: $('#height_gizi').val(),
                            weight: $('#weight_gizi').val(),
                            bbi: $('#bbi_gizi').val(),
                            factor_activity: $('#factor_activity option:selected').data(
                                'score'),
                            factor_stress: $('#factor_stress option:selected').data(
                                'score'),
                            gender: gender,
                            ageyear: ageyear,
                            p_type: $('#gizi_age_category').val(),
                        })

                        $('#energi_gizi').val(energy);
                        countNutrition({
                            energy: $('#energi_gizi').val(),
                            p_type: $('#gizi_age_category').val(),
                        })
                    })



                $('#clinical_description_gizi').val(vitalSign)
                if (res?.biokimia) {
                    $('#biokimia_gizi').val(res.biokimia).attr('readonly', true);
                } else {
                    $('#biokimia_gizi').val('').attr('readonly', false);
                }



                $('#food_alergy_gizi').val(res?.alergi.histories ?? '-')
                $('#examination_date_gizi').val(moment().format("YYYY-MM-DD HH:mm"))


            }
        });



    }
    const getAsuhanGiziByID = (props) => {
        postData({
            visit_id: props?.visit_id,
            no_registration: props?.no_registration,
            body_id: props?.body_id
        }, 'admin/Gizi/getGiziByID', (res) => {

            if (res.respon) {

                $('#body_id_gizi').val(props?.body_id);
                initializeSearchDietaryHabit('edit_pola_makan_gizi', '#edit-modal-gizi', res.data
                    .pola_makan, res.data.dietary_habit)

                let gender = <?= json_encode($visit['gender']); ?>;
                let height = res.data.height ?? 0;
                let weight = res.data.weight ?? 0;
                let heightInMeters = height / 100 ?? 0;
                let ageyear = res.data.ageyear ?? 0;

                $('#edit_height_gizi').val(height)
                $('#edit_weight_gizi').val(weight)
                $('#edit_bbi_gizi').val(res?.data.weight_ideal)
                $('#edit_antropometri_gizi').val(res?.data.antropometri)

                let bmi = countBMI({
                    height: height,
                    weight: weight
                });
                bmi = isNaN(bmi) ? 0 : bmi;

                let classification = classificationBMI(bmi);
                let vitalSign = `BB: ${weight}, TB: ${height}, BMI: ${bmi} (${classification})`;

                let bbi = 0;



                const filteredItems = aparameter
                    ?.filter(item => allowedTypes.includes(item?.p_type))
                    .sort((a, b) => a.p_type.localeCompare(b.p_type) || a.parameter_id - b
                        .parameter_id);

                let selectAge = '';
                let currentGroup = '';

                filteredItems.forEach(item => {
                    if (item.p_type !== currentGroup) {
                        if (currentGroup) selectAge += '</optgroup>';
                        const groupIndex = allowedTypes.indexOf(item.p_type);
                        const groupLabel = allowedNames[groupIndex];
                        currentGroup = item.p_type;
                        selectAge += `<optgroup label="${groupLabel.toLowerCase()}">`;
                    }

                    selectAge +=
                        `<option value="${item?.p_type}-${item.parameter_id}" ${item?.p_type + '-' + item.parameter_id === res?.data.p_type + '-' + res?.data.age_category ? 'selected' : ''}>${item.parameter_desc.toLowerCase()}</option>`;

                });

                if (currentGroup) selectAge += '</optgroup>';
                $('#edit_gizi_age_category').html(selectAge);

                let factorActivity = avalue?.filter(item => item?.p_type === 'GIZ0611' && item
                    .parameter_id === '01');
                let factorStress = avalue?.filter(item => item?.p_type === 'GIZ0611' && item
                    .parameter_id === '02');

                function populateSelect(selectId, items, data = null) {
                    const selectElement = $('#' + selectId);
                    selectElement.innerHTML = '';

                    if (!items || items.length === 0) {
                        selectElement.innerHTML = '<option>No data available</option>';
                    } else {

                        let optionHtml = '';
                        items.forEach(item => {
                            optionHtml +=
                                `<option value="${item.value_id}" data-score="${(item.value_score / 100).toString()}" ${item?.value_id == data ? 'selected' :''}>
                                        ${item.value_desc}
                                    </option>`
                        });
                        selectElement.html(optionHtml);
                    }
                }


                populateSelect('edit_factor_activity', factorActivity, res?.data.fa_value);
                populateSelect('edit_factor_stress', factorStress, res?.data.fs_value);


                $('#edit_gizi_age_category, #edit_height_gizi, #edit_weight_gizi').change(function(e) {
                    bbi = countBBI({
                        height: $('#edit_height_gizi').val(),
                        weight: $('#edit_weight_gizi').val(),
                        gender: gender,
                        p_type: $('#edit_gizi_age_category').val(),
                    })

                    $('#edit_bbi_gizi').val(bbi);
                })

                let energy = 0;
                energy = countEnergy({
                    height: $('#edit_height_gizi').val(),
                    weight: $('#edit_weight_gizi').val(),
                    bbi: $('#edit_bbi_gizi').val(),
                    factor_activity: $('#edit_factor_activity option:selected').data('score'),
                    factor_stress: $('#edit_factor_stress option:selected').data('score'),
                    gender: gender,
                    ageyear: ageyear,
                    p_type: $('#edit_gizi_age_category').val(),
                })

                $('#edit_energi_gizi').val(energy);

                countNutrition({
                    energy: $('#edit_energi_gizi').val(),
                    p_type: $('#edit_gizi_age_category').val(),
                })

                $('#edit_gizi_age_category, #edit_height_gizi, #edit_weight_gizi, #edit_bbi_gizi, #edit_factor_activity, #edit_factor_stress')
                    .change(function(e) {
                        energy = countEnergy({
                            height: $('#edit_height_gizi').val(),
                            weight: $('#edit_weight_gizi').val(),
                            bbi: $('#edit_bbi_gizi').val(),
                            factor_activity: $('#edit_factor_activity option:selected')
                                .data('score'),
                            factor_stress: $('#edit_factor_stress option:selected').data(
                                'score'),
                            gender: gender,
                            ageyear: ageyear,
                            p_type: $('#edit_gizi_age_category').val(),
                        })

                        $('#edit_energi_gizi').val(energy);
                        countNutrition({
                            energy: $('#edit_energi_gizi').val(),
                            p_type: $('#edit_gizi_age_category').val(),
                        })
                    })


                $('#edit_energi_gizi').val(res.data.energi)
                $('#edit_clinical_description_gizi').val(vitalSign)
                $('#edit_biokimia_gizi').val(res.data.biokimia)
                $('#edit_food_alergy_gizi').val(res.data.food_alergy)
                $('#edit_nutrition_diagnose_gizi').val(res.data.nutrition_diagnose)

                $('#edit_protein_gizi').val(res.data.protein)
                $('#edit_karbohidrat_gizi').val(res.data.karbohidrat)
                $('#edit_lemak_gizi').val(res.data.lemak)
                $('#edit_examination_date_gizi').val(res.data.examination_date)
            }
        });
    }
    // const getDataTableGizi = (props) => {

    $("#giziTab").off().on("click", function(e) {
        e.preventDefault();
        getLoadingscreen("content-to-hide-gizi", "load-content-gizi")

        getDataScreening();
        renderGizi({
            visit_id: visit['visit_id'],
            no_registration: visit['no_registration']
        })
        getAsuhanGizi({
            visit_id: visit['visit_id'],
            no_registration: visit['no_registration'],
            trans_id: visit['trans_id'],
        })

    })
    // };
    // ====== end of function get data ======


    const saveAsuhanGizi = () => {
        $('#saveAsuhanGizi').off().click(function(e) {
            let formData = document.querySelector('#formAsuhanGizi');
            let dataSend = new FormData(formData);
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });

            postData(jsonObj, 'admin/Gizi/insertAsuhanGizi', (res) => {

                if (res.respon) {
                    successSwal('Data berhasil Ditambahkan.');
                    $("#formAsuhanGizi")[0].reset()
                    $("#create-modal-gizi").modal("hide")
                    renderGizi({
                        visit_id: res?.result?.visit_id,
                        no_registration: res?.result?.no_registration,
                    })
                }
            });
        })
    }

    const saveDiagnosa = (props) => {
        $('#btnSaveDiagnosaGizi').off().click(function() {
            let formData = document.querySelector('#formDiagnosaGizi');
            let dataSend = new FormData(formData);

            let diag_cat = dataSend.getAll('diag_cat[]');
            let diag_id = dataSend.getAll('diag_id[]');
            let diag_name = dataSend.getAll('diag_name[]');
            let diag_desc = dataSend.getAll('diag_desc[]');
            let suffer_type = dataSend.getAll('suffer_type[]');

            let diagnosa = [];

            for (let i = 0; i < diag_id.length; i++) {
                let entry = {
                    diag_cat: diag_cat[i],
                    diag_id: diag_id[i],
                    diag_name: diag_name[i],
                    diag_desc: diag_desc[i],
                    suffer_type: suffer_type[i],
                    pasien_diagnosa_id: props?.document_id
                };

                diagnosa.push(entry);
            }


            postData({
                diagnosa
            }, 'admin/Gizi/insertDiagnosaGizi', (res) => {
                let data = res.data
                if (res.respon) {
                    renderDiagnosaGizi({
                        document_id: props?.document_id
                    })
                    successSwal(res.message)
                } else {
                    errorSwal(res.message)
                }

            });

        });
    }

    const saveFoodRecall = (props) => {
        $('#saveFoodRecall').off().click(function(e) {
            let formData = document.querySelector('#formFoodRecall');
            let dataSend = new FormData(formData);
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });
            jsonObj['document_id'] = props?.document_id

            postData(jsonObj, 'admin/Gizi/insertFoodRecall', (res) => {

                if (res.respon) {
                    successSwal('Data berhasil Ditambahkan.');
                    $("#formFoodRecall")[0].reset()
                    $("#foodRecallModal").modal("hide")
                    renderFoodRecall({
                        visit_id: res?.result?.visit_id,
                        document_id: props?.document_id
                    })
                }
            });
        })
    }

    const saveHasilIntervensi = (props) => {
        $('#saveHasilIntervensi').off().click(function(e) {
            let formData = document.querySelector('#formHasilIntervensi');
            let dataSend = new FormData(formData);
            let intervention_description = dataSend.getAll('intervention_description[]');


            let jsonObj = {};
            jsonObj.intervention_description = intervention_description
            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });

            jsonObj['document_id'] = props?.document_id
            delete jsonObj['intervention_description[]']
            postData(jsonObj, 'admin/Gizi/insertHasilIntervensi', (res) => {

                if (res.respon) {
                    successSwal('Data berhasil Ditambahkan.');
                    $("#formHasilIntervensi")[0].reset()
                    $("#hasilIntervensiModal").modal("hide")
                    renderIntervensi({
                        visit_id: res?.result?.visit_id,
                        document_id: props?.document_id
                    })
                }
            });
        })
    }

    const updateAsuhanGizi = () => {
        $('#editAsuhanGizi').off().click(function(e) {
            let formData = document.querySelector('#formEditAsuhanGizi');
            let dataSend = new FormData(formData);
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });


            postData(jsonObj, 'admin/Gizi/editAsuhanGizi', (res) => {

                if (res.respon) {
                    successSwal(res.message);
                    $("#formEditAsuhanGizi")[0].reset()
                    $("#edit-modal-gizi").modal("hide")
                    renderGizi({
                        visit_id: res?.result?.visit_id,
                        no_registration: res?.result?.no_registration,
                    })
                } else {
                    errorSwal(res.message);
                }
            });
        })
    }

    const updateFoodRecall = (props) => {
        $('#editFoodRecall').off().click(function(e) {
            let formData = document.querySelector('#formEditFoodRecall');
            let dataSend = new FormData(formData);
            let id = $(this).data('id')
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });
            jsonObj['document_id'] = props?.document_id

            postData(jsonObj, 'admin/Gizi/editFoodRecall', (res) => {

                if (res.respon) {
                    successSwal(res.message);
                    $("#formEditFoodRecall")[0].reset()
                    $("#editFoodRecallModal").modal("hide")
                    renderFoodRecall({
                        visit_id: res?.result?.visit_id,
                        document_id: props?.document_id
                    })
                } else {
                    errorSwal(res.message);
                }
            });
        })
    }

    const updateHasilIntervensi = () => {
        $('#editHasilIntervensi').off().on('click', function(e) {
            let formData = document.querySelector('#formEditHasilIntervensi');
            let dataSend = new FormData(formData);
            let id = $(this).data('id')
            let id2 = $(this).attr('data-id');
            let jsonObj = {};
            let intervention_description = dataSend.getAll('intervention_description[]');
            jsonObj.intervention_description = intervention_description
            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });

            delete jsonObj['intervention_description[]']

            postData(jsonObj, 'admin/Gizi/editIntervensi', (res) => {
                if (res.respon) {
                    successSwal(res.message);
                    $("#formEditHasilIntervensi")[0].reset()
                    $("#editHasilIntervensiModal").modal("hide")
                    renderIntervensi({
                        visit_id: res?.result?.visit_id,
                        document_id: res.document_id
                    })
                } else {
                    errorSwal(res.message);
                }
            });
        })
    }
    //  ====== end of function save & update ======




    // ====== function others ======
    function classificationBMI(bmi) {
        let classification = '';
        if (bmi < 18.5) {
            classification = 'Underweight';
        } else if (bmi >= 18.5 && bmi < 25.0) {
            classification = 'Normal weight';
        } else if (bmi >= 25.0 && bmi < 30.0) {
            classification = 'Overweight';
        } else if (bmi >= 30.0 && bmi < 35.0) {
            classification = 'Obesity class 1';
        } else if (bmi >= 35.0 && bmi < 40.0) {
            classification = 'Obesity class 2';
        } else if (bmi >= 40.0) {
            classification = 'Obesity class 3';
        } else {
            classification = '-';
        }
        return classification;
    }

    function addRowDiagGizi(container, bodyId, diag_id = null, diag_name = null, diag_cat = null,
        diag_suffer =
        0) {

        let tbody = document.getElementById(container);
        let diagIndex = tbody.getElementsByTagName("tr").length;

        if (diag_cat == null) {
            diag_cat = 1
        }
        if (diag_cat == null && diagIndex > 1) {
            diag_cat = 2
        }
        diagIndex = diagIndex + container;

        let $row = $('<tr id="adiagdiag' + diagIndex + '">')
            .append($('<td>')
                .append('<select id="adiagdiag_id' + diagIndex +
                    '" class="form-control enablekan" name="diag_id[]" style="width: 100%"></select>')
                .append('<input id="adiagdiag_name' + diagIndex +
                    '" name="diag_name[]" placeholder="" type="text" class="form-control block enablekan" value="" style="display: none" />'
                ).append('<input id="adiagdiag_desc' + diagIndex +
                    '" name="diag_desc[]" placeholder="" type="text" class="form-control block enablekan" value="" style="display: none" />'
                )
                .append('<input id="adiagsscondition_id' + diagIndex +
                    '" name="sscondition_id[]" placeholder="" type="text" class="form-control block enablekan" value="" style="display: none" />'
                )
            )
            .append($('<td>')
                .append($("<select class=\"form-select enablekan\">")
                    .attr('name', 'suffer_type[]').attr('id', 'adiagsuffer_type' +
                        diagIndex) <?php foreach ($suffer as $key => $value) { ?>
                    .append($("<option>")
                        .attr('value', '<?= $suffer[$key]['suffer_type']; ?>').html(
                            '<?= $suffer[$key]['suffer']; ?>')) <?php } ?>
                    .val(diag_suffer)
                )
            )
            .append($('<td>')
                .append($("<select class=\"form-select enablekan\">")
                    .attr('name', 'diag_cat[]')
                    .attr('id', 'adiagdiag_cat' +
                        diagIndex
                    ) <?php foreach ($diagCat as $key => $value) { ?> <?php if (in_array($diagCat[$key]['diag_cat'], [1, 16])) { ?>
                    .append($("<option>")
                        .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>')
                        .html('<?= $diagCat[$key]['diagnosa_category']; ?>')) <?php } ?> <?php } ?>
                    .val(diag_cat)
                )
            )
            .append("<td width='1%'><div onclick='$(\"#adiagdiag" + diagIndex +
                "\").remove()' class='btn closebtn btn-xs pull-right enablekan pointer' data-toggle='modal' title=''><i class='fa fa-trash'></i></div></td>"
            );

        $("#" + container).append($row);

        $("#adiagdiag_id" + diagIndex).on('focus', function() {
            removetextdiag(diagIndex);
        }).on('change', function() {
            selectedDiagnosaGizi(diagIndex);
        });

        initializeDiagGizi("adiagdiag_id" + diagIndex, diag_id, diag_name, null, diagIndex);

        // initializeDiagGizi(`adiagdiag_id${diagIndex}`, diag_id, diag_name, null,
        //     diagIndex +
        //     container);


        $(`#adiagsuffer_type${diagIndex}`).val(diag_suffer ?? 0);
        $(`#adiagdiag_cat${diagIndex}`).val(diag_cat);
    }

    // function selectedDiagnosa(index) {
    //     let diagname = $("#adiagdiag_id" + index + " option:selected").text();
    //     if (typeof diagname !== 'undefined') {
    //         $("#adiagdiag_name" + index).val(diagname);
    //     }
    // }
    const selectedDiagnosaGizi = (index) => { // baru yang tadinya hanya  selectedDiagnosa

        const diagtext = $(`#adiagdiag_id${index} option:selected`).text();
        const diagVal = $(`#adiagdiag_id${index} option:selected`).val();
        const diagdesc = moment(new Date).format("YYYY")

        if (diagtext && diagtext.trim() !== "") {
            if (diagVal.includes(diagdesc)) {
                $(`#adiagdiag_desc${index}`).val(diagtext);
                $(`#adiagdiag_name${index}`).val(null);
            } else {
                $(`#adiagdiag_name${index}`).val(diagtext);
                $(`#adiagdiag_desc${index}`).val(null);
            }
        }
    };

    const filePreview = (props) => {
        // Retrieve data from button attributes
        let visitEncoded = '<?= base64_encode(json_encode($visit)); ?>'
        let type = props.type;
        let id = props.body_id;

        // Construct the URL
        let url = '<?= base_url() . '/admin/Gizi/preview/'; ?>' + visitEncoded + '/' + type + '/' + id;

        // Redirect to the URL
        window.open(url, '_blank'); // Open in a new tab
    }


    const cetakGizi = (props) => {
        // Retrieve data from button attributes
        var visitEncoded = '<?= base64_encode(json_encode($visit)); ?>'
        var idEncoded = props.body_id;

        // Construct the URL
        var url = '<?= base_url() . '/admin/cetak/asuhan_gizi/'; ?>' + visitEncoded + '/' +
            idEncoded;

        // Redirect to the URL
        window.open(url, '_blank'); // Open in a new tab
    }

    const getAge = (props, container, day, dataValue = null) => {
        postData(props, 'admin/Gizi/getAgeRange', (res) => {
            if (res.respon) {
                let data = res?.data;

                const tbody = $(`#${container}`);
                tbody.empty();

                let dataRows = ''
                data.forEach((value, key) => {
                    dataRows +=
                        `<option value="${value.age_range}" ${dataValue != null ? (value.age_range == dataValue ? 'selected' : '') : (day >= value.lower_bound && day < value.upper_bound ? 'selected' : '')}>${value.display}</option>`;
                });
                $(`#${container}`).html(dataRows)

            }
        });

    }

    const countBMI = (props) => {
        const weight = parseFloat(props?.weight);
        const height = parseFloat(props?.height);

        if (!weight || !height) return "0.00";

        const bmi = weight / ((height / 100) ** 2);
        return Number.isFinite(bmi) ? bmi.toFixed(2) : "0.00";
    };

    const countBBI = (props) => {
        const height = parseFloat(props?.height);
        if (!height || height === 0) return "0.00";

        let idealWeight = height - 100;
        let [p_type, parameter_id] = (props?.p_type || "").split("-");
        let bbi = 0;

        // GIZ0606 rumus (TB-100)*0.9
        if (p_type === 'GIZ0606' && (parameter_id === '03' || parameter_id === '04')) {
            bbi = idealWeight * 0.9;
        }

        // GIZ0607 rumus (TB-100)
        else if (p_type === 'GIZ0607') {
            bbi = idealWeight;
        }

        // GIZ0608 rumus (TB-100)*0.9
        else if (p_type === 'GIZ0608') {
            bbi = idealWeight * 0.9;
        }

        // GIZ0609 rumus pria ((TB)^2)*21, wanita ((TB)^2)*22.5 
        else if (p_type === 'GIZ0609') {
            const heightInMeter = height / 100;
            if (props?.gender === '1') {
                bbi = (heightInMeter ** 2) * 21;
            } else {
                bbi = (heightInMeter ** 2) * 22.5;
            }
        }

        return Number.isFinite(bbi) ? bbi.toFixed(2) : "0.00";
    };


    const BMIonChange = (props) => {

        $(props?.height + ', ' + props?.weight).on('change', function() {
            const height = parseFloat($(props?.height).val());
            const weight = parseFloat($(props?.weight).val());

            if (!isNaN(height) && !isNaN(weight)) {
                const bmi = countBMI({
                    height,
                    weight
                });

                $(props?.bmi).val(bmi);
            }
        });
    };

    const countEnergy = (props) => {
        const bbi = parseFloat(props?.bbi);
        if (!bbi || bbi === 0) return "0.00";
        let [p_type, parameter_id] = props?.p_type.split('-');
        let energy = 0;


        if (p_type === 'GIZ0604') { // ANAK (0-1 TH) 
            // BBI X 128 KKAL
            if (parameter_id === '01') energy = parseFloat(props?.bbi) * 128;
            // BBI X 98 KKAL
            if (parameter_id === '02') energy = parseFloat(props?.bbi) * 98;


        } else if (p_type === 'GIZ0605') { // ANAK 1-6 TAHUN 
            // BBI X 102 KKAL
            if (parameter_id === '01') energy = parseFloat(props?.bbi) * 102;
            // BBI X 90 KKAL
            if (parameter_id === '02') energy = parseFloat(props?.bbi) * 90;

        } else if (p_type === 'GIZ0606') { // ANAK 7-18 TAHUN 

            // ((19,59*BBI)+(1,3*TB)+414,9)*FA*FS  
            if (parameter_id === '01') energy = parseFloat(props?.bbi) * 108;
            //  ((16,97*BBI)+(1,62*TB)+371,2)*FA*FS
            if (parameter_id === '02') energy = parseFloat(props?.bbi) * 90;
            //  ((16,25*BBI)+(1,4*TB)+515,5)*FA*FS
            if (parameter_id === '03') energy = (16.25 * parseFloat(props?.bbi) + (1.4 * parseFloat(props
                ?.height)) + 515.5) * parseFloat(props?.factor_activity) * parseFloat(props?.factor_stress);
            //  ((8,4*BBI)+(4,65*TB)+200)*FA*FS
            if (parameter_id === '04') energy = (8.4 * parseFloat(props?.bbi) + (4.65 * parseFloat(props
                ?.height)) + 200) * parseFloat(props?.factor_activity) * parseFloat(props?.factor_stress);

        } else if (p_type === 'GIZ0607') { // IBU MELAHIRKAN DAN HAMIL 

            // ((655+(9,6*BBI)+(1,8*TB)-(4,7*USIA))*1,2*1,3)+330
            if (parameter_id === '01') energy = (655 + (9.6 * parseFloat(props?.bbi)) + (1.8 * parseFloat(props
                ?.height)) - (4.7 * parseFloat(props?.ageyear)) * 1.2 * 1.3) + 330;
            // ((655+(9,6*BBI)+(1,8*TB)-(4,7*USIA))*1,2*1,2)+180
            if (parameter_id === '02') energy = (655 + (9.6 * parseFloat(props?.bbi)) + (1.8 * parseFloat(props
                ?.height)) - (4.7 * parseFloat(props?.ageyear)) * 1.2 * 1.3) + 180;
            // ((655+(9,6*BBI)+(1,8*TB)-(4,7*USIA))*1,2*1,2)+300
            if (parameter_id === '03') energy = (655 + (9.6 * parseFloat(props?.bbi)) + (1.8 * parseFloat(props
                ?.height)) - (4.7 * parseFloat(props?.ageyear)) * 1.2 * 1.3) + 300;

        } else if (p_type === 'GIZ0608') {
            // DEWASA – LANSIA (DIIT BIASA, JANTUNG, GINJAL, RENDAH GARAM, STROKE, PPOK/ASMA (TANPA KOMPLIKASI DM) 

            // ((655+(9,6*BBI )+(1,8*TB)-(4,7*USIA))*FA*FS)
            if (props?.gender !== '01') energy = (655 + (9.6 * parseFloat(props?.bbi)) + (1.8 * parseFloat(props
                    ?.height)) - (4.7 * parseFloat(props?.ageyear)) * parseFloat(props?.factor_activity) *
                parseFloat(props?.factor_stress))

            // (66+(13,7*BBI)+(5*TB)-(6,8*USIA))*FA*FS)
            if (props?.gender === '01') energy = (66 + (13.7 * parseFloat(props?.bbi)) + (5 * parseFloat(props
                    ?.height)) - (6.8 * parseFloat(props?.ageyear)) * parseFloat(props?.factor_activity) *
                parseFloat(props?.factor_stress))

        } else if (p_type === 'GIZ0609') {
            // DEWASA – LANSIA (DIIT BIASA, JANTUNG, GINJAL, RENDAH GARAM, STROKE, PPOK/ASMA (KOMPLIKASI DM) 

            // (BBI*25)+(FAKTOR*BBI*25)
            if (props?.gender !== '01') energy = (parseFloat(props?.bbi) * 25) + (parseFloat(props
                ?.factor_activity) * parseFloat(props?.factor_stress) * parseFloat(props?.bbi) * 25);
            // (BBI*25)+(FAKTOR*BBI*30)
            if (props?.gender === '01') energy = (parseFloat(props?.bbi) * 25) + (parseFloat(props
                ?.factor_activity) * parseFloat(props?.factor_stress) * parseFloat(props?.bbi) * 30);

        }


        return parseFloat(energy).toFixed(2);
    }

    const countNutrition = (props) => {
        const energyval = parseFloat(props?.energy);
        if (!energyval || energyval === 0) return "0.00";

        let [p_type, parameter_id] = props?.p_type.split('-');

        let khPercent = 0,
            pPercent = 0,
            lPercent = 0;

        const energy = parseFloat(props?.energy) || 0;

        if (p_type === 'GIZ0608' || p_type === 'GIZ0609') {

            switch (parameter_id) {
                case '01':
                case '10':
                case '11':
                case '05':
                    khPercent = 60;
                    pPercent = 15;
                    lPercent = 25;
                    break; // KH: 60%, P: 15%, L: 25%
                case '02':
                case '06':
                    khPercent = 60;
                    pPercent = 20;
                    lPercent = 20;
                    break; // KH: 60%, P: 20%, L: 20%
                case '03':
                case '07':
                    khPercent = 55;
                    pPercent = 20;
                    lPercent = 25;
                    break; // KH: 55%, P: 20%, L: 25%
                case '04':
                case '08':
                    khPercent = 65;
                    pPercent = 10;
                    lPercent = 25;
                    break; // KH: 65%, P: 10%, L: 25%
            }
        } else {
            khPercent = 65;
            pPercent = 15;
            lPercent = 20; // KH: 65%, P: 15%, L: 20%
        }


        const kh = ((khPercent * energy) / 100) / 4;
        const p = ((pPercent * energy) / 100) / 4;
        const l = ((lPercent * energy) / 100) / 9;


        $('#karbohidrat_gizi').val(kh.toFixed(2));
        $('#protein_gizi').val(p.toFixed(2));
        $('#lemak_gizi').val(l.toFixed(2));
    }
    // ====== end of function others ======







    // ======= SCRIPT SCREENING GIZI =======


    const getDataScreening = () => {
        postData({
            visit_id: visit['visit_id'],
            no_registration: visit['no_registration']
        }, 'admin/Gizi/getDataSkrining', (res) => {
            if (res.respon) {

                const table = $('#table_skrining_gizi').DataTable({
                    dom: "tr<'row'<'col-sm-4'p><'col-sm-4 text-center'i><'col-sm-4 text-end'l>>",
                    stateSave: true,
                    "bDestroy": true
                });
                table.clear();
                let dataHtml = '';

                res?.data.forEach((element, index) => {

                    let p_type = '';
                    switch (element?.p_type) {
                        case 'GIZ0601':
                            p_type = 'Anak 1 bulan - 18 tahun(Adaptasi Strong - kids)';
                            break;
                        case 'GIZ0602':
                            p_type = 'Malnutrition Screening Tool(MST)';
                            break;
                        case 'GIZ0603':
                            p_type = 'Mini Nutritional Assessment(MNA)';
                            break;
                    }

                    dataHtml = `
                                <tr class="p-0">
                                    <th style="width:1% !important;" class="text-center p-1">${index+1}</th>
                                    <th class="text-center p-1">Formulir Skrining - ${moment(element?.examination_date).format('YYYY-MM-DD HH:mm')} (${p_type})</th>
                                    <td class="text-center" width="1%">${element.total_score ?? "-"}</td>
                                    <td class="text-center" style="width:100px;">${element.score_desc ?? "-"}</td>
                                     <?php if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['admingizi', 'superuser'])) : ?>
                                        <th style="width:1% !important;" class="text-center p-1">
                                            ${element?.valid_user && element?.valid_user !== '' ? 
                                            `<img src="https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(element?.valid_user)}&size=30x30" alt="QR Code" />`
                                            : 
                                            `<button class="btn btn-sm btn-light btn-skrining-sign" data-id="${element.body_id}" data-gizi="screening"><i class="fas fa-signature"></i></button>`
                                            }
                                        </th>
                                    <?php endif; ?>
                                    <th style="width:1% !important;" class="text-center p-1">
                                       <button class="btn btn-sm btn-success btn-skrining-cetak" data-id="${element.body_id}">
                                                <i class="fas fa-print"></i>
                                        </button>
                                    </th>
                                    <th style="width:1% !important;" class="text-center p-1">
                                        <button class="btn btn-sm btn-warning btn-skrining-edit" data-id="${element.body_id}"><i class="fas fa-edit"></i></button>
                                    </th>
                                    <th style="width:1% !important;" class="text-center p-1">
                                        <button class="btn btn-sm btn-danger btn-skrining-delete" data-id="${element.body_id}"><i class="fas fa-trash-alt"></i></button>
                                    </th>
                                </tr>
                            `;
                    table.row.add($(dataHtml));
                })
                table.draw();

                // $('#tambah-skrining-gizi').off().on('click', function(e) {

                //     let birth = moment(<?= json_encode(@$visit['date_of_birth']); ?>);
                //     let now = moment();
                //     let exam_info = res.exam_info;

                //     let bmi = countBMI({
                //         weight: exam_info ? exam_info['weight'] : 0,
                //         height: exam_info ? exam_info['height'] : 0
                //     });
                //     $('#height_screening').val(exam_info ? exam_info['height'] : 0)
                //     $('#weight_screening').val(exam_info ? exam_info['weight'] : 0)
                //     $('#imt_screening').val(isNaN(bmi) ? 0 : bmi)

                //     BMIonChange({
                //         height: '#height_screening',
                //         weight: '#weight_screening',
                //         bmi: '#imt_screening',
                //     })

                //     let daysDiff = now.diff(birth, 'days');
                //     getAge({
                //         visit: visit['visit_id'],
                //     }, 'age_category_screening', daysDiff);

                //     $('#select_skrining_gizi').change(function(e) {
                //         let selectedOption = $(this).val();
                //         selectedOption === '' ? $('#btnSaveSkrining').attr('disabled',
                //             'disabled') : $('#btnSaveSkrining').removeAttr(
                //             'disabled');

                //         getFormScreening({
                //             selectedOption: selectedOption,
                //             container: '#tbodySkriningGizi',
                //         });

                //         countScoreAndDescription({
                //             select_id: '#tbodySkriningGizi',
                //             score_id: '#score_screening',
                //             kesimpulan_id: '#kesimpulan_screening',
                //             p_type: selectedOption,

                //         })

                //         $('#tbodySkriningGizi select').on('change', function() {
                //             countScoreAndDescription({
                //                 select_id: '#tbodySkriningGizi',
                //                 score_id: '#score_screening',
                //                 kesimpulan_id: '#kesimpulan_screening',
                //                 p_type: selectedOption,

                //             })
                //         })
                //     })

                //     getAsuhanGizi({
                //         visit_id: visit['visit_id'],
                //         no_registration: visit['no_registration'],
                //         trans_id: visit['trans_id'],
                //     })


                //     insertDataScreening();
                // })

                $('.btn-skrining-edit').off().on('click', function(event) {
                    const id = $(this).data('id');

                    postData({
                        visit_id: visit['visit_id'],
                        no_registration: visit['no_registration'],
                        body_id: id,
                    }, 'admin/Gizi/getSkriningById', (res) => {
                        if (res.respon) {
                            $('#edit_height_screening').val(res?.data.height ?? 0)
                            $('#edit_weight_screening').val(res?.data.weight ?? 0)
                            $('#edit_imt_screening').val(res.data.imt)

                            BMIonChange({
                                height: '#edit_height_screening',
                                weight: '#edit_weight_screening',
                                bmi: '#edit_imt_screening',
                            })

                            let birth = moment(
                                <?= json_encode(@$visit['tgl_lahir']); ?>);
                            let now = moment();

                            let daysDiff = now.diff(birth, 'days');
                            getAge({
                                    visit: visit['visit_id'],
                                }, 'edit_age_category_screening', daysDiff, res.data
                                .age_cat);

                            $('#edit_select_skrining_gizi').val(res?.data.p_type);
                            $('#body_id-edit-skrining').val(res?.data.body_id);

                            $('#edit-modal-skrining').modal('show')


                            getFormScreening({
                                selectedOption: res?.data.p_type,
                                container: '#edit_tbodySkriningGizi',
                                data: res?.data
                            });

                            $('#edit_select_skrining_gizi').change(function(e) {
                                $(this).val() == '' ? $('#btnUpdateSkrining')
                                    .attr('disabled') : $('#btnUpdateSkrining')
                                    .removeAttr('disabled')
                                getFormScreening({
                                    selectedOption: $(this).val(),
                                    container: '#edit_tbodySkriningGizi',
                                    data: res?.data
                                });

                            })

                            $('#btnUpdateSkrining').off().on('click', function(e) {
                                let formData = document.querySelector(
                                    '#edit_formSkriningGizi');
                                let dataSend = new FormData(formData);
                                let jsonObj = {};

                                dataSend.forEach((value, key) => {
                                    jsonObj[key] = value;
                                });

                                postData(jsonObj, 'admin/Gizi/UpdateSkrining', (
                                    res) => {
                                    if (res.respon) {
                                        successSwal(res.message)
                                        $('#create-modal-skrining')
                                            .modal('hide')
                                        getDataScreening();
                                    } else {
                                        errorSwal(res.message)
                                        $('#create-modal-skrining')
                                            .modal('hide')
                                    }
                                });
                            })

                        }
                    });
                });



                actionSign({
                    container: '.btn-skrining-sign'
                })


                deleteScreening();
                actionCetakScreening();



            }
        });

    }

    const actionSign = (props) => {
        $(props?.container).off().on('click', function(e) {
            $('#signSignGiziModal').modal('show')
            const id = $(this).data('id');
            const type = $(this).data('gizi');
            $('#gizi_sign_id').val(id)


            $('#btnSubmitSignGizi').off().on('click', function(e) {

                let formData = document.querySelector('#formSignGizi');
                let dataSend = new FormData(formData);
                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });
                jsonObj.type = type;
                if (jsonObj.user_type == '1') {
                    jsonObj.password = btoa(jsonObj.password)
                }
                postData(jsonObj, 'admin/Gizi/signGizi', (res) => {
                    if (res.respon) {
                        successSwal(res.message)
                        $('#signSignGiziModal').modal('hide')
                        getDataScreening();
                        renderGizi({
                            visit_id: visit['visit_id'],
                            no_registration: visit['no_registration']
                        })
                        $('#formSignGizi').reset();
                    } else {
                        errorSwal(res.message)
                        $('#signSignGiziModal').modal('hide')
                        $('#formSignGizi').reset();
                    }
                });
            })

        })
    }

    const insertDataScreening = () => {
        $('#btnSaveSkrining').one('click', function(e) {

            let formData = document.querySelector('#formSkriningGizi');
            let dataSend = new FormData(formData);
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });

            postData(jsonObj, 'admin/Gizi/insertSkrining', (res) => {
                if (res.respon) {
                    successSwal(res.message)
                    $('#create-modal-skrining').modal('hide')
                    getDataScreening();
                } else {
                    errorSwal(res.message)
                    $('#create-modal-skrining').modal('hide')
                }
            });
        })
    }
    const deleteScreening = () => {
        $('.btn-skrining-delete').off().on('click', function(event) {
            const id = $(this).data('id');

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
                    postData({
                        body_id: id
                    }, 'admin/Gizi/delete', (res) => {

                        if (res.respon) {
                            successSwal(res.message)
                            getDataScreening();
                        } else {
                            errorSwal(res.message)
                        }

                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Dibatalkan",
                        text: "File Anda aman :)",
                        icon: "error"
                    });
                }
            });
        })
    }
    const actionCetakScreening = () => {
        $('.btn-skrining-cetak').off().on('click', function(event) {
            const id = $(this).data('id');
            cetakSkriningGizi({
                body_id: id
            })
        })
    }
    const getFormScreening = (props) => {

        let selectedCategory = props?.selectedOption;
        let filteredData = aparameter?.filter(item => item?.p_type === selectedCategory);
        let data = props?.data ?? null;
        let bodyContainer = $(props?.container);
        let htmlContent = '';

        filteredData.forEach((parameter, index) => {
            let inputOrSelect = '';
            let arr = avalue.filter(item => item?.parameter_id === parameter.parameter_id && item
                ?.p_type === selectedCategory);
            if (data != null) {
                inputOrSelect = parameter?.entry_type === 3 ?
                    `<select class="form-select" name="${parameter?.column_name}">
                                ${arr.map(item => {

                                    let isSelected = data[parameter?.column_name.toLowerCase()] === item.value_score && data.p_type === selectedCategory ? 'selected' : '';
                                    return `<option value="${item.value_score}" ${isSelected}>${item.value_desc}</option>`;
                                }).join('')}
                            </select>` :

                    `<input type="text" class="form-control" name="${parameter?.column_name.toLowerCase()}" value="${data.p_type === selectedCategory ? data[parameter?.column_name.toLowerCase()] : ''}">`;

            } else {
                inputOrSelect = parameter?.entry_type === 3 ?
                    `<select class="form-select" name="${parameter?.column_name}">
                            ${arr.map(item => `<option value="${item.value_score}">${item.value_desc}</option>`).join('')}
                                </select>` :
                    `<input type="text" class="form-control" name="${parameter?.column_name}">`;
            }


            htmlContent += `
                        <tr>
                            <th class="p-1 text-center align-middle" style="width:1% !important">${index + 1}</th>
                            <td class="p-1">${parameter?.parameter_desc}</td>
                            <td class="p-1" style="width:120px !important;">
                                ${inputOrSelect}
                            </td>
                        </tr>
                        `;
        });



        bodyContainer.html(htmlContent)
        countScoreAndDescription({
            select_id: '#edit_tbodySkriningGizi',
            score_id: '#edit_score_screening',
            kesimpulan_id: '#edit_kesimpulan_screening',
            p_type: selectedCategory,

        })


        $('#edit_tbodySkriningGizi select').on('change', function() {
            countScoreAndDescription({
                select_id: '#edit_tbodySkriningGizi',
                score_id: '#edit_score_screening',
                kesimpulan_id: '#edit_kesimpulan_screening',
                p_type: selectedCategory,

            })
        })
    }

    const countScoreAndDescription = (props) => {
        let score = 0;

        $(`${props?.select_id} select`).each(function() {

            let name = $(this).attr('name');
            let selectedValue = $(this).val();

            score += parseInt(selectedValue);
        });


        $(props?.score_id).html(score)

        let description = '';
        switch (props?.p_type) {
            case 'GIZ0601':
                description = score === 0 ? '<span class="badge bg-success">Rendah</span>' : (score >= 1 &&
                    score <= 3 ? '<span class="badge bg-warning">Sedang</span>' : (score >= 4 && score <=
                        5 ? '<span class="badge bg-danger">Tinggi</span>' :
                        '<span class="badge bg-light">-</span>'));
                break;
            case 'GIZ0602':
                description = score >= 2 ? '<span class="badge bg-danger">Berisiko malnutrisi</span>' :
                    '<span class="badge bg-success">Tidak berisiko malnutrisi</span>';
                break;
            case 'GIZ0603':
                description = score >= 12 ?
                    '<span class="badge bg-success">Normal / tidak berisiko, tidak membutuhkan pengkajian lebih lanjut</span>' :
                    '<span class="badge bg-danger">Mungkin malnutrisi, membutuhkan pengkajian lebih lanjut</span>';
                break;
            default:
                description = '-'; // Default case if none of the cases match
                break;
        }
        $(props?.kesimpulan_id).html(description);
    }
    const cetakSkriningGizi = (props) => {

        var visitEncoded = '<?= base64_encode(json_encode($visit)); ?>'
        var idEncoded = props.body_id;


        var url = '<?= base_url() . '/admin/cetak/skrining_gizi/'; ?>' + visitEncoded + '/' +
            idEncoded;


        window.open(url, '_blank');
    }

    function initializeReceipe(theid, modalParent, data = null) {
        let initialvalue = data?.meal_name;
        postData({

        }, 'admin/Gizi/getRecipes', (result) => {
            $("#" + theid).select2({
                theme: "bootstrap-5",
                tags: true,
                dropdownParent: '#' + modalParent,
                placeholder: "Pilih pola makan",
                allowClear: true,
                data: result?.data
            });

            if (initialvalue != null) {
                let selectedId = result.data.find(item => item.text.toLowerCase() === initialvalue
                    .toLowerCase())?.id;
                $("#" + theid).val(selectedId).trigger('change');
            }
            $('#' + theid).off().change(function(e) {
                if ($(this).val() != null) {
                    postData({
                        recipe_id: $(this).val(),
                    }, 'admin/Gizi/getIngredient', (res) => {
                        if (initialvalue != null) {
                            let selectedOption = result.data.find(item => item.text
                                .toLowerCase() === initialvalue.toLowerCase())?.id;

                            if (selectedOption.toLowerCase() != $("#" + theid).val()
                                .toLowerCase()) {
                                $('#nama_bahan_edit_food_recall').val(res?.data.nama_bahan)
                                $('#urt_bahan_edit_food_recall').val(res?.data.urt_bahan)
                                $('#gramasi_bahan_edit_food_recall').val(res?.data.gramasi)
                            } else {
                                $('#nama_bahan_edit_food_recall').val(data.ingredient_name);
                                $('#urt_bahan_edit_food_recall').val(data.ingredient_urt);
                                $('#gramasi_bahan_edit_food_recall').val(data
                                    .ingredient_grams);
                            }

                        } else {
                            $('#nama_bahan_food_recall').val(res?.data.nama_bahan)
                            $('#urt_bahan_food_recall').val(res?.data.urt_bahan)
                            $('#gramasi_bahan_food_recall').val(res?.data.gramasi)
                        }

                    });
                }
            })
        });

    }
})()
</script>