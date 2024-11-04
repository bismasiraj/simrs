<script type="text/javascript">
    (function() {
        $(document).ready(function() {
            let visit = <?= json_encode($visit) ?>;
            getDataTableGizi();
            initializeSearchDietaryHabit('pola_makan_gizi', '#create-modal-gizi')


            flatpickr('.datepicker-gizi', {
                dateFormat: 'Y-m-d H:i',
                defaultDate: moment().format('YYYY-MM-DD HH:mm'),
                enableTime: true,
                time_24hr: true,
                onChange: function(selectedDates, dateStr, instance) {
                    console.log(selectedDates);
                }
            });

            const quillEditor = document.querySelectorAll('.quill-editor-gizi');

            quillEditor.forEach(function(editor, index) {
                new Quill(editor, {
                    theme: 'snow',
                });
            });

            const arrayPeringatan = [
                'ALBUMIN', 'BB', 'BS', 'DH I', 'DH II', 'DH III', 'DH IV', 'DJ I', 'DJ II',
                'DJ III', 'DJ IV', 'DL I', 'DL II', 'DL III', 'DL IV', 'DM', 'ENCER',
                'KECAP', 'LAUK SARING', 'MC', 'NABATI', 'NB', 'NL', 'PRO 40 GR',
                'PRO 60 GR', 'R. LEMAK', 'R. PURIN', 'R. SERAT', 'RG', 'STROKE I',
                'STROKE II A (BS)', 'STROKE II B (BB)', 'STROKE II C(NB)', 'T. SERAT',
                'TIM SARING', 'TKTP'
            ];
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
                onChange: function(selectedDates, dateStr, instance) {
                    console.log(selectedDates);
                }
            });
        });

        $('#addFoodRecall').off().click(function() {
            $('#formFoodRecall')[0].reset();
        });

        $('#tambah-asuhan-gizi').off().click(function() {
            let visit = <?= json_encode($visit) ?>;
            let birth = moment(<?= json_encode($visit['date_of_birth']); ?>);
            let now = moment();

            let daysDiff = now.diff(birth, 'days');
            getAge({
                visit: visit['visit_id'],
            }, 'age_category_gizi', daysDiff);
            getAsuhanGizi({
                visit_id: visit['visit_id'],
                no_registration: visit['no_registration'],
                trans_id: visit['trans_id'],
            })
        });

        $('#btn-close-gizi').off().click(function() {
            $('tr').removeClass('bg-light');
            $('#accordionGizi').hide();
        });

        $("#addDiagnosaGizi").off().on("click", function(e) {
            addRowDiagDokter('bodyDiagGizi');
        });
        // end of action button



        // ====== function render data ======
        const renderGizi = (props) => {
            let visit = <?= json_encode($visit) ?>;
            $('#accordionGizi').hide();
            postData({
                visit_id: props?.visit_id
            }, 'admin/Gizi/getDataGizi', (res) => {
                if (res.respon) {
                    let data = res?.data;
                    let bodyGizi = $('#containerBodyGizi');
                    if (res.data.length > 0) {
                        let dataRows = ''
                        data.forEach((value, key) => {
                            dataRows += `
                         <tr id="row-${value?.body_id}" class="align-middle">
                            <td width="1%" class="text-center">${key+1}</td>
                            <td class="text-center">${value?.nutrition_diagnose ?? '-'}</td>
                            <td width="1%">
                                <button type="button" class="btn btn-success btn-sm print-row" data-id="${value?.body_id}"><i class="fas fa-print"></i></button>
                            </td>
                            <?php /* if (user()->checkPermission("asuhangizi", 'c') || user()->checkRoles(['admingizi', 'superuser'])) : ?>
                            <td width="1%">
                                <div class="position-relative" id="qr-${key+1}-${value?.body_id}">
                                    <button type="button" class="btn btn-outline-primary btn-sm validate-row" name="sign_gizi" data-sign-ke="1"
                                    data-button-id="formGiziSaveBtn-${key+1}" data-id="${value?.body_id}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Validasi dokumen"><i class="fas fa-signature"></i></button>
                                </div>
                            </td>
                            <?php endif */ ?>
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


                        });
                        bodyGizi.html(dataRows);

                        document.querySelectorAll('.validate-row').forEach((button, key) => {
                            const id = button.getAttribute('data-id');
                            const formId = 'formAsuhanGizi';
                            const primaryKey = id;
                            const formSaveBtn = `formGiziSaveBtn-${key+1}`;
                            if (id) {
                                $(this).prop('disabled', false);
                            } else {
                                $(this).prop('disabled', true);
                            }


                            $("button[name='sign_gizi']").off().on("click", function() {
                                const buttonId = $(this).data('button-id');
                                const signKe = `${key+1}`;
                                addSignUserGizi("formAsuhanGizi", "accordionGizi", id, buttonId,
                                    7, signKe,
                                    1, "Form Asuhan Gizi");
                            });

                            // if (id) {
                            //     checkSignSignatureGizi(formId, primaryKey, formSaveBtn, '7');
                            // }
                        })
                        document.querySelectorAll('.assessment-row').forEach(button => {
                            button.addEventListener('click', function(event) {
                                getLoadingscreen("accordionGizi", "load-content-accordion-gizi")
                                const id = button.getAttribute('data-id');

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


                            });
                        })
                        document.querySelectorAll('.duplicate-row-gizi').forEach(button => {
                            button.addEventListener('click', function(event) {
                                const id = button.getAttribute('data-id');

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
                                                    no_registration: props?.no_registration
                                                })
                                                successSwal('Data berhasil Diduplikat.');
                                            }
                                        });

                                    }
                                });




                            });
                        })

                        document.querySelectorAll('.delete-row-gizi').forEach(button => {
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
                                        }, 'admin/Gizi/deleteGizi', (res) => {

                                            if (res.respon) {
                                                renderGizi({
                                                    visit_id: props?.visit_id,
                                                    no_registration: props?.no_registration
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
                        })

                        document.querySelectorAll('.edit-row-gizi').forEach(button => {
                            button.addEventListener('click', function(event) {

                                const id = button.getAttribute('data-id');
                                getAsuhanGiziByID({
                                    visit_id: props?.visit_id,
                                    no_registration: props?.no_registration,
                                    body_id: id
                                })

                            });
                        })

                        document.querySelectorAll('.print-row').forEach(button => {
                            button.addEventListener('click', function(event) {

                                const id = button.getAttribute('data-id');
                                cetakGizi({
                                    body_id: id
                                })

                            });
                        })

                    } else {
                        bodyGizi.html(`
                        <tr>
                            <td width="1%" class="text-center" colspan="7">Data Kosong</td>
                        </tr>
                        `);
                    }

                }
            });

            saveAsuhanGizi();
            updateAsuhanGizi();
        }

        const renderFoodRecall = (props) => {

            postData({
                visit_id: props?.visit_id,
                document_id: props?.document_id
            }, 'admin/Gizi/getDataFoodRecall', (res) => {
                if (res.respon) {
                    let data = res?.data;

                    let bodyFoodRecall = $('#body-food-recall');
                    let dataRows = ''
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
                    });
                    bodyFoodRecall.html(dataRows);

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


                        $(`button[data-button-id='formFoodRecallSaveBtn-${key+1}']`).off().on("click", function() {
                            const buttonId = $(this).data('button-id');
                            const signKe = `2${key+1}`;
                            addSignUserGizi("formFoodRecall", "accordionGizi", id, buttonId,
                                signKe, signKe,
                                1, "Form Food Recall");
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
                                    }, 'admin/Gizi/deleteFoodRecall', (res) => {

                                        if (res.respon) {
                                            renderFoodRecall({
                                                visit_id: props?.visit_id,
                                                document_id: props?.document_id
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
                                    $('#tanggal_edit_food_recall').val(moment(data.recall_date).format('DD-MM-YYYY HH:mm'));
                                    $('#nama_masakan_edit_food_recall').val(data.meal_name);
                                    $('#urt_masakan_edit_food_recall').val(data.meal_urt);
                                    $('#estimasi_gram_edit_food_recall').val(data.meal_grams);
                                    $('#keterangan_edit_food_recall').val(data.meal_description);
                                    $('#nama_bahan_edit_food_recall').val(data.ingredient_name);
                                    $('#urt_bahan_edit_food_recall').val(data.ingredient_urt);
                                    $('#gramasi_bahan_edit_food_recall').val(data.ingredient_grams);
                                    $('#netto_bahan_edit_food_recall').val(data.ingredient_netto);
                                    $('#edit_food_recall').val(data.recall_id);

                                }

                            });
                        });
                    })

                }
            });


            saveFoodRecall({
                document_id: props?.document_id
            })

            updateFoodRecall();
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

                        addRowDiagDokter('bodyDiagGizi', props?.document_id,
                            value?.diagnosa_id, value?.diagnosa_name, value
                            ?.diag_cat,
                            value?.suffer_type);
                    });


                }
            });

            saveDiagnosa({
                document_id: props?.document_id
            })

        }

        const renderIntervensi = (props) => {
            postData({
                visit_id: props?.visit_id,
                document_id: props?.document_id
            }, 'admin/Gizi/getDataIntervensi', (res) => {
                if (res.respon) {
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
                                    }, 'admin/Gizi/deleteIntervensi', (res) => {

                                        if (res.respon) {
                                            renderIntervensi({
                                                visit_id: props?.visit_id,
                                                document_id: props?.document_id
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
                                    $('#edit_tanggal_hasil_intervensi').val(moment(data?.intervention_date).format('DD-MM-YYYY HH:mm'));
                                    // $('#edit_gizi_hasil_intervensi').val(data.intervention_description);
                                    $('#edit_target_hasil_intervensi').val(data?.intervention_target);
                                    $('#edit_hasil_hasil_intervensi').val(data?.intervention_result);
                                    $('#edit_masalah_hasil_intervensi').val(data?.intervention_problem);
                                    $('#edit_rencana_hasil_intervensi').val(data?.intervention_planning);
                                    $('#edit_intervensi').val(data?.body_id);

                                    let container = $('#container_edit_intervention_description');
                                    container.empty();
                                    let checkbox = '';

                                    arrayPeringatan.forEach(item => {
                                        const isChecked = data.intervention_description.includes(item) ? 'checked' : '';

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
                                    $('#tbody-peyajian-gizi').append(dataRowPenyajian);
                                    $('#tbody-monitoring-evaluasi').append(dataRow);
                                }

                            });
                        });
                    })

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
                    $('#container_aktivitas_gizi').hide();
                    let gender = <?= json_encode($visit['gender']); ?>;

                    let height = res.data.height ?? 0;
                    let weight = res.data.weight ?? 0;
                    let heightInMeters = height / 100 ?? 0;
                    let ageyear = res.data.ageyear ?? 0;
                    let bmi = (weight / (heightInMeters * heightInMeters)).toFixed(2) ?? 0;
                    bmi = isNaN(bmi) ? 0 : bmi;

                    let classification;

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

                    let vitalSign = `BB: ${weight}, TB: ${height}, BMI: ${bmi} (${classification})`;

                    $('#clinical_description_gizi').val(vitalSign)
                    $('#biokimia_gizi').val(res?.biokimia)
                    $('#food_alergy_gizi').val(res?.alergi.histories ?? '-')
                    $('#examination_date_gizi').val(res.data.examination_date)

                    $('#antropometri_gizi').change(function() {
                        if ($(this).val() == 'dewasa') {
                            $('#container_aktivitas_gizi').show();
                        } else {
                            $('#container_aktivitas_gizi').hide();
                        }
                    })

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
                    $('#edit_container_aktivitas_gizi').hide();
                    $('#body_id_gizi').val(props?.body_id);
                    initializeSearchDietaryHabit('edit_pola_makan_gizi', '#edit-modal-gizi', res.data.pola_makan, res.data.dietary_habit)

                    getAge({
                        visit: visit['visit_id']
                    }, 'edit_age_category_gizi', null, res.data.age_category);
                    let gender = <?= json_encode($visit['gender']); ?>;
                    let height = res.data.height ?? 0;
                    let weight = res.data.weight ?? 0;
                    let heightInMeters = height / 100 ?? 0;
                    let ageyear = res.data.ageyear ?? 0;
                    let bmi = (weight / (heightInMeters * heightInMeters)).toFixed(2) ?? 0;
                    bmi = isNaN(bmi) ? 0 : bmi;

                    let classification;

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

                    let vitalSign = `BB: ${weight}, TB: ${height}, BMI: ${bmi} (${classification})`;


                    $('#edit_energi_gizi').val(res.data.energi)
                    $('#edit_clinical_description_gizi').val(vitalSign)
                    $('#edit_biokimia_gizi').val(res.data.biokimia)
                    $('#edit_food_alergy_gizi').val(res.data.food_alergy)
                    $('#edit_nutrition_diagnose_gizi').val(res.data.nutrition_diagnose)

                    $('#edit_protein_gizi').val(res.data.protein)
                    $('#edit_karbohidrat_gizi').val(res.data.karbohidrat)
                    $('#edit_lemak_gizi').val(res.data.lemak)
                    $('#edit_examination_date_gizi').val(res.data.examination_date)

                    $('#edit_antropometri_gizi').html(`
                            <option value="anak" ${res.data.antropometri == 'anak' ? 'selected' : ''}>Anak</option>
                            <option value="dewasa" ${res.data.antropometri == 'dewasa' ? 'selected' : ''}>Dewasa</option>`);

                    updateAktivitasGiziVisibility($('#edit_antropometri_gizi').val(), energy, res.data.energi);

                    $('#edit_antropometri_gizi').change(function() {
                        let selectedCategory = $(this).val();
                        updateAktivitasGiziVisibility(selectedCategory, energy, res.data.energi);
                    });


                }
            });



        }
        const getDataTableGizi = (props) => {

            $("#giziTab").off().on("click", function(e) {
                e.preventDefault();
                getLoadingscreen("content-to-hide-gizi", "load-content-gizi")

                let visit = <?= json_encode($visit) ?>;
                renderGizi({
                    visit_id: visit['visit_id'],
                    no_registration: visit['no_registration']
                })

            })
        };
        // ====== end of function get data ======



        //  ====== function save & update ======
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
                let suffer_type = dataSend.getAll('suffer_type[]');

                let diagnosa = [];

                for (let i = 0; i < diag_id.length; i++) {
                    let entry = {
                        diag_cat: diag_cat[i],
                        diag_id: diag_id[i],
                        diag_name: diag_name[i],
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
                console.log(intervention_description);
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

        const updateFoodRecall = () => {
            $('#editFoodRecall').off().click(function(e) {
                let formData = document.querySelector('#formEditFoodRecall');
                let dataSend = new FormData(formData);
                let id = $(this).data('id')
                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });


                postData(jsonObj, 'admin/Gizi/editFoodRecall', (res) => {

                    if (res.respon) {
                        successSwal(res.message);
                        $("#formEditFoodRecall")[0].reset()
                        $("#editFoodRecallModal").modal("hide")
                        renderFoodRecall({
                            visit_id: res?.result?.visit_id,
                            document_id: id
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
        function addRowDiagDokter(container, bodyId, diag_id = null, diag_name = null, diag_cat = null,
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
                        .attr('id', 'adiagdiag_cat' + diagIndex) <?php foreach ($diagCat as $key => $value) { ?> <?php if (in_array($diagCat[$key]['diag_cat'], [1, 16])) { ?>
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
                selectedDiagnosa(diagIndex);
            });

            initializeDiagGizi("adiagdiag_id" + diagIndex, diag_id, diag_name);
            $("#adiagsuffer_type" + diagIndex).val(diag_suffer);
            $("#adiagdiag_cat" + diagIndex).val(diag_cat);
        }

        function selectedDiagnosa(index) {
            let diagname = $("#adiagdiag_id" + index + " option:selected").text();
            if (typeof diagname !== 'undefined') {
                $("#adiagdiag_name" + index).val(diagname);
            }
        }

        function updateAktivitasGiziVisibility(category, energy, currentEnergi) {

            if (category == 'dewasa') {
                $('#edit_container_aktivitas_gizi').show();
                $('#edit_container_aktivitas_gizi').empty();
                $('#edit_container_aktivitas_gizi').append(`
                    <label for="edit_aktivitas_gizi" class="form-label fw-bold">Aktivitas</label>
                    <select id="edit_aktivitas_gizi" class="form-select">
                        <option value="1" ${(energy * 1).toFixed(2) == currentEnergi ? 'selected' : ''}> -- pilih --</option>
                        <option value="1.2" ${(energy * 1.2).toFixed(2) == currentEnergi ? 'selected' : ''}>Sangat jarang berolahraga</option>
                        <option value="1.375" ${(energy * 1.375).toFixed(2) == currentEnergi ? 'selected' : ''}>Jarang olahraga (1-3 kali per minggu)</option>
                        <option value="1.55" ${(energy * 1.55).toFixed(2) == currentEnergi ? 'selected' : ''}>Cukup olahraga (3-5 kali per minggu)</option>
                        <option value="1.725" ${(energy * 1.725).toFixed(2) == currentEnergi ? 'selected' : ''}>Sering olahraga (6-7 kali per minggu)</option>
                        <option value="1.9" ${(energy * 1.9).toFixed(2) == currentEnergi ? 'selected' : ''}>Sangat sering olahraga (sekitar 2 kali dalam sehari)</option>
                    </select>
                `);
            } else {
                $('#edit_container_aktivitas_gizi').empty();
                $('#edit_container_aktivitas_gizi').hide();
            }
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
                        dataRows += `<option value="${value.age_range}" ${dataValue != null ? (value.age_range == dataValue ? 'selected' : '') : (day >= value.lower_bound && day < value.upper_bound ? 'selected' : '')}>${value.display}</option>`;
                    });
                    $(`#${container}`).html(dataRows)

                }
            });

        }
        // ====== end of function others ======

    })()
</script>