<?php if (!empty($fisio['value']['fisioterapi'])): ?>
    <script>
        // (function() {
        $(document).ready(function() {
            renderFisioAll()
        })
        let getDataFisioterapiAll = []
        let getDataFisioterapiDetailAll = []
        let diagnosaList = []
        let clinicCover = ""

        function renderFisioAll() {
            res = <?= json_encode($fisio); ?>;
            diagnosaList = res?.value?.diagnosa || []
            clinicCover = res?.value?.clinic_cover?.name_of_clinic ?? "-"
            renderDiagnosa()
            // renderKop({
            //     kop: res?.value?.kop || {}
            // })

            let resultEmployeee = ""
            res?.value?.employee?.map((e) => {
                resultEmployeee += `<option value="${e?.employee_id}">${e?.fullname}</option>`
            })

            $("#employedocTindakanFisio").html(resultEmployeee)

            getDataFisioterapiAll = res.value?.fisioterapi
            getDataFisioterapiDetailAll = res.value?.fioterapi_detail || []
            renderShowJfisoDoc({
                data_schedule: res.value?.fisioterapi_schedule,
                monitoring_nyeri: res?.value?.monitoring_nyeri
            })
            // if (res.value?.fisioterapi?.length >= 1) {
            //     renderJadwalFisio({
            //         data: res.value?.fisioterapi,
            //         data_schedule: res.value?.fisioterapi_schedule,
            //         monitoring_nyeri: res?.value?.monitoring_nyeri
            //     });
            // } else {
            //     $("#save-tabelsOdd").attr("disabled", "disabled");
            //     $("#bodydataJadwalFisioterapi").html(tempTablesNull());
            // }
        }
        const renderKop = (props) => {
            let {
                kop
            } = props
            $('.kop-name').text(kop?.name_of_org_unit || '');
            $('.kop-address').html(kop?.contact_address + ',' + kop?.phone + ', Fax:' + kop?.fax + ',' + kop?.kota +
                '<br>' + kop?.sk
            );
        }

        const renderDiagnosa = (props) => {
            let diagnosa = diagnosaList
            let anamnaseList = [...new Set(diagnosa.map(item => item.anamnase).filter(Boolean))];
            $('#anamnase-output-fisio').text(anamnaseList.join(', '));


            let diagMedis = diagnosa?.filter(item => item.diag_cat === '1' || item.diag_cat === 1).map(item => item
                .diagnosa_name);

            $('#diagnosis-protokol').html(diagMedis.join(', <br>'));
            $('#diagnosa-program').html(diagMedis.join(', <br>'));

            $('#diagnosis-medis-output-fisio').html(diagMedis.join(', <br>'));
            $('#diagnosis-medis-uji-fisio').html(diagMedis.join(', <br>'));

            let diagFungsi = diagnosa?.filter(item => item.diag_cat === '17' || item.diag_cat === 17).map(item =>
                item
                .diagnosa_name);
            $('#diagnosis-fungsi-output-fisio').html(diagFungsi.join(', <br>'));
            // $('#diagnosis-fungsi-uji-fisio').html(diagFungsi.join(', <br>'));
            $('#diagnosis-fungsi-output-coverfisio').html(diagFungsi.join(', <br>'));

        }

        const renderJadwalFisio = (data) => {
            let resultData = '';
            data.data.forEach((e, index) => {

                resultData += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${!e.vactination_date ?"-": moment(e.vactination_date).format("DD-MM-YYYY HH:mm")}</td>
                    <td>${e?.doctor ??"-"}</td>
                    <td>
                        ${[
                            (e.ultrasound && e.ultrasound.trim() !== null) ? 'Ultrasound' : '',
                            (e.tens && e.tens !== null) ? 'Tens' : '',
                            (e.exercise && e.exercise !== null) ? 'Exercise' : '',
                            (e.infrared && e.infrared !== null) ? 'Infrared' : '',
                            (e.swd && e.swd !== null) ? 'SWD' : '',
                            (e.mwd && e.mwd !== null) ? 'MWD' : '',
                            (e.eswt && e.eswt !== null) ? 'ESWT' : '',
                            (e.laser && e.laser !== null) ? 'Laser' : '',
                            (e.elektrikal_stimulasi && e.elektrikal_stimulasi !== null) ? 'ES ( elektrikal stimulasi)' : ''
                        ].filter(Boolean).join(', ')}
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning btn-show-render-Jfisio" autocomplete="off" data-vactination_id="${e.vactination_id}" data-index="${index}"><i
                                class="fa fa-edit">Check</i></button>
                        <button type="button" class="btn btn-danger btn-delete-Jfisio" data-vactination_id="${e.vactination_id}"
                            autocomplete="off"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>`;
            });
            $("#bodydataJadwalFisioterapi").html(resultData);
            renderShowJfisoDoc({
                data_schedule: data?.data_schedule,
                monitoring_nyeri: data?.monitoring_nyeri
            })
            deleteFisioTerapi()
        };

        const deleteFisioTerapi = () => {
            $('.btn-delete-Jfisio').off().on('click', function(e) {
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
                        deleteRequest({
                            vactination_id: $(this).data('vactination_id'),
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

        const deleteRequest = (props) => {
            postData({
                vactination_id: props?.vactination_id
            }, 'admin/jadwalFisioterapi/deleteDataFisio', (res) => {
                successSwal('Sukses');
                let visit_id = '<?php echo $visit['visit_id']; ?>';
                getDataJadwalFisioterapi({
                    visit_id: visit_id
                });
                $("#JfisioDocument").slideUp()

            })
        }

        const renderShowJfisoDoc = (props) => {
            let index = 0;
            let item = getDataFisioterapiAll[index];
            $('a[href="#formulirRequestFisio"]').closest('li').show();
            $('a[href="#programFisio"]').closest('li').show();

            $('a[href="#formulirUjiFisio"]').closest('li').show();
            $('a[href="#rawatJalanRM"]').closest('li').show();

            $("#JfisioDocument").slideUp()
            $("#JfisioDocument").slideDown()

            let documentId = item?.vactination_id

            let detailData = getDataFisioterapiDetailAll?.find(item => item?.document_id ===
                documentId);


            let resultdetailData = $.extend({}, detailData, {
                document_id: documentId
            });
            renderFisioterapiTemplate({
                fisioterapi: item
            })
            renderCoverFisioterapiTemplate({
                fisioterapi: item
            })

            tandaTangan({
                data: item
            })
            renderRequestJadwalFisio({
                vactination_id: item.vactination_id,
                evaluasi_qty: item.evaluasi_qty,
                data: props?.data_schedule,
                fisioterapi: item
            })


            renderRequestProgramFisio({
                vactination_id: item.vactination_id,
                evaluasi_qty: item.evaluasi_qty,
                data: props?.data_schedule,
                fisioterapi: item
            })

            renderUjiRehabMedic({
                data: resultdetailData ?? null,
                monitoring_nyeri: props?.monitoring_nyeri,
                fisioterapi: item

            })

            $('#coverSendFisioterapi').addClass('show active');
            $('#formulirRequestFisio').removeClass(
                'show active');
            $('#programFisio').removeClass(
                'show active');

            $('#JfisioDocument .nav-link').removeClass('active');
            $('#formulirUjiFisio').removeClass('show active');
            $('#rawatJalanRM').removeClass('show active');
            $('a[href="#coverSendFisioterapi"]').addClass('active');
            $('.datetime-now').html(moment(new Date()).format('DD-MM-YYYY HH:mm'))

            $('#JfisioDocument').show();
        }

        const renderFisioterapiTemplate = (props) => {
            let visit = <?= json_encode($visit) ?>;

            const vactinationDate = props?.fisioterapi?.vactination_date ?
                moment(props.fisioterapi?.vactination_date).format('DD-MM-YYYY HH:mm') :
                new Date().toLocaleString();
            $('#vactination_date-fisio').text(vactinationDate);
            $('#anamnase-fisio-output').text(props?.fisioterapi?.anamnase || '');
            $('#vas-fisio').val(props?.fisioterapi?.vas || '');
            $('#functions-fisio').val(props?.fisioterapi?.functions || '');
            $('#diagnosis-fisio-medis-output').text(props?.fisioterapi?.diagnosis_medis || '');
            $('#diagnosis-fisio-fungsi-output').text(props?.fisioterapi?.diagnosis_fungsi || '');

            $('#other_checkbox-fisio').prop('checked', !!props?.fisioterapi?.other_desc);
            $('#other_desc-fisio').val(props?.fisioterapi?.other_desc || '').toggle(!!props?.fisioterapi?.other_desc);

            $('#suggestion-fisio').val(props?.fisioterapi?.suggestion || '');
            $('#goal-fisio').val(props?.fisioterapi?.teraphy_goal || '');
            $('#evaluation_qty-fisio').val(props?.fisioterapi?.evaluation_qty || 0);

            if (props?.fisioterapi?.suspect_worker) {
                $('#suspect_no-fisio').prop('checked', true);
                $('#suspect_worker-fisio').val(props?.fisioterapi?.suspect_worker);
                $('#suspect_details_container-fisio').show();
            } else {
                $('#suspect_yes-fisio').prop('checked', true);
                $('#suspect_details_container-fisio').hide();
            }

            $('input[name="suspect_worker-radio"]').on('change', function() {
                if ($(this).val() === "1") {
                    $('#suspect_details_container-fisio').hide();
                    $('#suspect_worker-fisio').val('').prop('disabled',
                        true);
                } else if ($(this).val() === "0") {
                    $('#suspect_details_container-fisio').show();
                    $('#suspect_worker-fisio').prop('disabled', false);
                }
            });

            if (props?.fisioterapi?.vactination_id) {
                $("#save-form-fisioterapi").text("Update");
                $("#vactination_id-fisio-val").val(props?.fisioterapi?.vactination_id);
                $("#print-form-fisioterapi").show();

            } else {
                $("#save-form-fisioterapi").text("Simpan");
                $("#print-form-fisioterapi").hide();
            }
            $("#vactination_date-fisio-val").val(moment(props?.fisioterapi?.vactination_date).format(
                "YYYY-MM-DD HH:mm"));
            $("#org_unit_code-val").val(props?.fisioterapi?.org_unit_code);


            const fisioterapiItems = [{
                    checkbox: '#ultrasound_checkbox-fisio',
                    input: '#ultrasound-fisio',
                    prop: 'ultrasound'
                },
                {
                    checkbox: '#tens_checkbox-fisio',
                    input: '#tens-fisio',
                    prop: 'tens'
                },
                {
                    checkbox: '#exercise_checkbox-fisio',
                    input: '#exercise-fisio',
                    prop: 'exercise'
                },
                {
                    checkbox: '#infrared_checkbox-fisio',
                    input: '#infrared-fisio',
                    prop: 'infrared'
                },
                {
                    checkbox: '#swd_checkbox-fisio',
                    input: '#swd-fisio',
                    prop: 'swd'
                },
                {
                    checkbox: '#mwd_checkbox-fisio',
                    input: '#mwd-fisio',
                    prop: 'mwd'
                },
                {
                    checkbox: '#eswt_checkbox-fisio',
                    input: '#eswt-fisio',
                    prop: 'eswt'
                },
                {
                    checkbox: '#laser_checkbox-fisio',
                    input: '#laser-fisio',
                    prop: 'laser'
                },
                {
                    checkbox: '#elektrikal_stimulasi_checkbox-fisio',
                    input: '#elektrikal_stimulasi-fisio',
                    prop: 'elektrikal_stimulasi'
                },
                {
                    checkbox: '#other_checkbox-fisio',
                    input: '#other_desc-fisio',
                    prop: 'other_desc'
                }
            ];


            fisioterapiItems.forEach(item => {
                console.log(item)
                const value = props?.fisioterapi[item?.prop];

                $(item.checkbox).prop('checked', !!value && value !== "");
                $(item.input).val(value || '').toggle(!!value && value !== "");

                $(item.checkbox).on('change', function() {
                    if ($(this).is(':checked')) {
                        $(item.input).val(' ').show().prop('disabled', false);
                    } else {
                        $(item.input).val(null).hide().prop('disabled', true);
                    }
                });
            });

            $("#no_registration-fisio-val").val(props?.fisioterapi?.no_registration);
            $("#visit_id-fisio-val").val(props?.fisioterapi?.visit_id);
            $("#bill_id-fisio-val").val(props?.fisioterapi?.bill_id);
            $("#clinic_id-fisio-val").val(props?.fisioterapi?.clinic_id);
            $("#terlayani-fisio-val").val(0);
            $("#employee_id-fisio-val").val(props?.fisioterapi?.employee_id ||
                '<?= user()->employee_id ?>');
            $("#patient_category_id-fisio-val").val(props?.fisioterapi?.patient_category_id);
            $("#tarif_id-fisio-val").val(props?.fisioterapi?.tarif_id);
            $("#validation-fisio-val").val(0);
            $("#description-fisio-val").val(props?.fisioterapi?.description);
            $("#thename-fisio-val").val(props?.fisioterapi?.name_of_pasien);
            $("#theaddress-fisio-val").val(props?.fisioterapi?.contact_address);
            $("#theid-fisio-val").val();
            $("#isrj-fisio-val").val(props?.fisioterapi?.isrj || visit?.isrj);
            $("#ageyear-fisio-val").val(props?.fisioterapi?.ageyear || 0);
            $("#agemonth-fisio-val").val(props?.fisioterapi?.agemonth || 0);
            $("#ageday-fisio-val").val(props?.fisioterapi?.ageday || 0);
            $("#status_pasien_id-fisio-val").val(props?.fisioterapi?.status_pasien_id);
            $("#gender-fisio-val").val(props?.fisioterapi?.gender);
            $("#doctor-fisio-val").val(props?.fisioterapi?.doctor || visit?.fullname_inap || visit
                ?.fullname || "");
            $("#kal_id-fisio-val").val();
            $("#class_room_id-fisio-val").val(props?.fisioterapi?.class_room_id);
            $("#bed_id-fisio-val").val(props?.fisioterapi?.bed_id);
            $("#tarif_name-fisio-val").val(props?.fisioterapi?.tarif_name);
            $("#terapi_desc-fisio-val").val(props?.fisioterapi?.terapi_desc);

            renderDiagnosa();

        };

        const btnActionSaveUpdate = (props) => {
            $("#save-form-fisioterapi").off().on("click", function(e) {
                e.preventDefault();
                $("#form-fisioterapi-data").find(":input:disabled").prop("disabled", false);

                let formElement = document.getElementById('form-fisioterapi-data');

                let dataSend = new FormData(formElement);
                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });

                postData(jsonObj, 'admin/jadwalFisioterapi/insertOrUpdateDataFisio', (
                    res) => {
                    successSwal('Sukses');
                    let visit_id = '<?php echo $visit['visit_id']; ?>';
                    getDataJadwalFisioterapi({
                        visit_id: visit_id
                    });
                    // $("#JfisioDocument").slideUp()

                })

            });

            $("#save-form-fisioterapi-cover").off().on("click", function(e) {
                e.preventDefault();
                $("#form-fisioterapi-data-cover").find(":input:disabled").prop("disabled", false);
                let formElement = document.getElementById('form-fisioterapi-data-cover');

                let dataSend = new FormData(formElement);
                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });

                postData(jsonObj, 'admin/jadwalFisioterapi/insertOrUpdateDataFisio', (
                    res) => {
                    successSwal('Sukses');
                    let visit_id = '<?php echo $visit['visit_id']; ?>';
                    getDataJadwalFisioterapi({
                        visit_id: visit_id
                    });
                    $("#JfisioDocument").slideUp()

                })

            });
        }



        const renderNonFisioterapiTemplate = (props) => {
            $('#add-new-doc-Jfisio').on('click', function() {
                renderCoverFisioterapiTemplate()
                $("#JfisioDocument").slideUp()
                $("#JfisioDocument").slideDown();
                $('a[href="#formulirRequestFisio"]').closest('li').hide();
                $('a[href="#programFisio"]').closest('li').hide();

                $('a[href="#formulirUjiFisio"]').closest('li').hide();
                $('a[href="#rawatJalanRM"]').closest('li').hide();

                $('#coverSendFisioterapi').addClass('show active');
                $('#formulirRequestFisio').removeClass(
                    'show active');
                $('#programFisio').removeClass(
                    'show active');
                $('#formulirUjiFisio').removeClass('show active');
                $('#rawatJalanRM').removeClass('show active');

                $('#JfisioDocument').show();


            });
        };

        const renderCoverFisioterapiTemplate = (props) => {
            let visit = <?= json_encode($visit) ?>;
            if (props?.fisioterapi?.vactination_id) {
                $("#save-form-fisioterapi-cover").text("Update")
                $("#print-form-fisioterapi-cover").show();

            } else {
                $("#save-form-fisioterapi-cover").text("Simpan")
                $("#print-form-fisioterapi-cover").hide();
            }


            $("#vactination_id-fisio-val-coverfisio").val(props?.fisioterapi?.vactination_id ?? get_bodyid());
            $("#vactination_date-fisio-val-coverfisio").val(moment(props?.fisioterapi?.vactination_date).format(
                    "YYYY-MM-DD HH:mm") || moment(new Date().toLocaleString())
                .format(
                    "YYYY-MM-DD HH:mm"));
            $("#org_unit_code-val-coverfisio").val(props?.fisioterapi?.org_unit_code || visit?.org_unit_code);
            $("#no_registration-fisio-val-coverfisio").val(props?.fisioterapi?.no_registration || visit
                ?.no_registration);
            $("#visit_id-fisio-val-coverfisio").val(props?.fisioterapi?.visit_id || visit?.visit_id);
            $("#bill_id-fisio-val-coverfisio").val(props?.fisioterapi?.bill_id || visit?.bill_id);
            $("#clinic_id-fisio-val-coverfisio").val(props?.fisioterapi?.clinic_id || visit?.clinic_id);
            $("#terlayani-fisio-val-coverfisio").val(0);

            $("#employedocTindakanFisio").val(props?.fisioterapi?.employee_id ||
                '<?= user()->employee_id ?>');
            $("#doctor-fisio-val-coverfisio").val(props?.fisioterapi?.doctor || '<?= user()->fullname ?>')

            $("#employedocTindakanFisio").on("change", function() {
                let ggg = $(`#employedocTindakanFisio option:selected`).text()
                $("#doctor-fisio-val-coverfisio").val(ggg)
            })


            $("#patient_category_id-fisio-val-coverfisio").val(props?.fisioterapi?.patient_category_id || visit
                ?.patient_category_id);
            $("#tarif_id-fisio-val-coverfisio").val(props?.fisioterapi?.tarif_id || visit?.tarif_id);
            $("#validation-fisio-val-coverfisio").val(0);
            $("#description-fisio-val-coverfisio").val(props?.fisioterapi?.description);
            $("#thename-fisio-val-coverfisio").val(props?.fisioterapi?.thename || visit?.diantar_oleh);
            $("#theaddress-fisio-val-coverfisio").val(props?.fisioterapi?.theaddress || visit
                ?.contact_address);
            $("#theid-fisio-val-coverfisio").val("");
            $("#isrj-fisio-val-coverfisio").val(props?.fisioterapi?.isrj || visit?.isrj);
            $("#ageyear-fisio-val-coverfisio").val(props?.fisioterapi?.ageyear || 0);
            $("#agemonth-fisio-val-coverfisio").val(props?.fisioterapi?.agemonth || 0);
            $("#ageday-fisio-val-coverfisio").val(props?.fisioterapi?.ageday || 0);
            $("#status_pasien_id-fisio-val-coverfisio").val(props?.fisioterapi?.status_pasien_id || visit
                ?.status_pasien_id);
            $("#gender-fisio-val-coverfisio").val(props?.fisioterapi?.gender || visit?.gender);
            $("#kal_id-fisio-val-coverfisio").val("");
            $("#class_room_id-fisio-val-coverfisio").val(props?.fisioterapi?.class_room_id || visit?.class_room_id);
            $("#bed_id-fisio-val-coverfisio").val(props?.fisioterapi?.bed_id || visit?.bed_id);
            $("#tarif_name-fisio-val-coverfisio").val(props?.fisioterapi?.tarif_name || "");
            $("#terapi_desc-fisio-val-coverfisio").val(props?.fisioterapi?.terapi_desc || "");
            const fisioterapiItems = [{
                    checkbox: '#ultrasound_checkbox-fisio-cover',
                    input: '#ultrasound-fisio-cover',
                    prop: 'ultrasound'
                },
                {
                    checkbox: '#tens_checkbox-fisio-cover',
                    input: '#tens-fisio-cover',
                    prop: 'tens'
                },
                {
                    checkbox: '#exercise_checkbox-fisio-cover',
                    input: '#exercise-fisio-cover',
                    prop: 'exercise'
                },
                {
                    checkbox: '#infrared_checkbox-fisio-cover',
                    input: '#infrared-fisio-cover',
                    prop: 'infrared'
                },
                {
                    checkbox: '#swd_checkbox-fisio-cover',
                    input: '#swd-fisio-cover',
                    prop: 'swd'
                },
                {
                    checkbox: '#mwd_checkbox-fisio-cover',
                    input: '#mwd-fisio-cover',
                    prop: 'mwd'
                },
                {
                    checkbox: '#eswt_checkbox-fisio-cover',
                    input: '#eswt-fisio-cover',
                    prop: 'eswt'
                },
                {
                    checkbox: '#laser_checkbox-fisio-cover',
                    input: '#laser-fisio-cover',
                    prop: 'laser'
                },
                {
                    checkbox: '#elektrikal_stimulasi_checkbox-fisio-cover',
                    input: '#elektrikal_stimulasi-fisio-cover',
                    prop: 'elektrikal_stimulasi'
                },
                {
                    checkbox: '#other_checkbox-fisio-cover',
                    input: '#other_desc-fisio-cover',
                    prop: 'other_desc'
                }
            ];
            fisioterapiItems.forEach(item => {
                const value = props?.fisioterapi[item.prop];

                $(item.checkbox).prop('checked', !!value && value !== "");
                $(item.input).val(value || '').toggle(!!value && value !== "");

                $(item.checkbox).on('change', function() {
                    if ($(this).is(':checked')) {
                        $(item.input).val(' ').show().prop('disabled', false);
                    } else {
                        $(item.input).val(null).hide().prop('disabled', true);
                    }
                });
            });


            let tindakanLabels = {
                ultrasound: 'Ultrasound',
                tens: 'TENS',
                exercise: 'Exercise'
            };

            let tindakanContainer = $("#hasil-tindakan-val2-coverfisio");
            tindakanContainer.empty();
            let indexT = 1;
            Object.keys(tindakanLabels).forEach(key => {
                let value = props?.fisioterapi?.[key];
                if (value === "1") {
                    tindakanContainer.append(
                        `<div class="label">${indexT}. ${tindakanLabels[key]}</div>`);
                    indexT++;
                }
            });



            renderDiagnosa()


            // btnActionSaveUpdate()
        };

        const renderUjiRehabMedic = (props) => {

            let visit = <?= json_encode($visit) ?>;
            $('#inputformujirehab').empty();





            if (props?.data?.vactination_id) {
                $("#formaddaujirehabbtnid").text("Update");
                $("#print-uji-rehab").show();
                $("#formsignUjiRehab").show();

            } else {
                $("#formaddaujirehabbtnid").text("Simpan");
                $("#print-uji-rehab").hide();
                $("#formsignUjiRehab").hide();

            }
            if (props?.data?.valid_user) {
                $("#flatdate-detail-vactination_date").prop("disabled", true)
                $("#val-detail-treatment").prop("disabled", true)
                $("#val-detail-teraphy_result").prop("disabled", true)
                $("#val-detail-teraphy_conclusion").prop("disabled", true)
                $("#val-detail-teraphy_recomendation").prop("disabled", true)
                $("#formaddaujirehabbtnid").prop("disabled", true)
                $("#formsignUjiRehab").prop("disabled", true)


            } else {
                $("#flatdate-detail-vactination_date").prop("disabled", false)
                $("#val-detail-treatment").prop("disabled", false)
                $("#val-detail-teraphy_result").prop("disabled", false)
                $("#val-detail-teraphy_conclusion").prop("disabled", false)
                $("#val-detail-teraphy_recomendation").prop("disabled", false)
                $("#formaddaujirehabbtnid").prop("disabled", false)
                $("#formsignUjiRehab").prop("disabled", false)
            }




            let nameValue = [
                'org_unit_code', 'vactination_id', 'document_id', 'no_registration',
                'visit_id', 'bill_id', 'clinic_id', 'employee_id', 'doctor', 'tarif_id',
                'description', 'thename', 'theaddress',
                'theid', 'isrj', 'ageyear', 'agemonth', 'ageday', 'class_room_id', 'bed_id',
                'teraphy_desc', 'start_date', 'end_date'
            ];

            const getValueFromPropsOrVisit = (field) => {
                const value = props?.data?.[field] || visit?.[field] || "";

                return value;
            };


            nameValue.forEach(field => {
                $('#inputformujirehab').append(
                    `<input id="${field}-uji-fisio-val" name="${field}" type="hidden" class="form-control block" />`
                );
            });


            nameValue.forEach(field => {
                if (field === 'vactination_id') {
                    let vactinationId = props?.data?.vactination_id || get_bodyid();
                    $(`#${field}-uji-fisio-val`).val(vactinationId);
                } else if (field === 'thename') {
                    const name = visit?.diantar_oleh || "";
                    $(`#${field}-uji-fisio-val`).val(name);
                } else if (field === 'theaddress') {
                    const address = visit?.contact_address || "";
                    $(`#${field}-uji-fisio-val`).val(address);
                } else if (field === 'doctor') {
                    const doctorName = visit?.fullname || visit?.fullname_inap || visit
                        ?.fullname || "";
                    $(`#${field}-uji-fisio-val`).val(doctorName);
                } else {
                    $(`#${field}-uji-fisio-val`).val(props?.data?.[field] || visit?.[
                        field
                    ]);
                }
            });


            const updateTreatmentResult = () => {
                let treatmentValue = $('#val-detail-treatment').val();
                $('#val-detail-treatment-result').text(treatmentValue);
            };

            $("#flatdate-detail-vactination_date").val(props?.data?.vactination_date || "").trigger(
                'change');
            $("#val-detail-treatment").val(props?.data?.treatment || "");
            $("#val-detail-teraphy_result").val(props?.data?.teraphy_result ?? (props?.monitoring_nyeri ?? ''));
            $("#val-detail-teraphy_conclusion").val(props?.data?.teraphy_conclusion || "");
            $("#val-detail-teraphy_recomendation").val(props?.data?.teraphy_recomendation || "");
            $("#diagnosis-fungsi-uji-fisio").html(props?.fisioterapi?.diagnosa_fungsi)

            updateTreatmentResult();

            $('#val-detail-treatment').on('change keyup', function() {
                updateTreatmentResult();
            });



            // $("#formsignUjiRehab").off().on("click", function(e) {
            //     e.preventDefault()
            //     addSignUser(formId = "formaddaujirehab", container = "", primaryKey =
            //         "vactination_id-uji-fisio-val", buttonId = "jadwalFisioTab", docs_type = 19,
            //         user_type = 1, sign_ke = 1, title =
            //         "Formulir Uji Fungsi Medic",
            //         columnName = 'valid_user',
            //         value_id = null)
            // })


            initializeFlatpickrFisioterapi();

        };

        const initializeFlatpickrFisioterapi = () => {
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
                } else {
                    // console.warn("Invalid date entered:", thevalue);
                }
            });

            const nowtime = moment().format("DD/MM/YYYY HH:mm");
            $(".datetimeflatpickr").val(nowtime).trigger("change");
        }

        const btnActionSaveUpdateFisioterapiDetail = (props) => {
            $("#formaddaujirehabbtnid").off().on("click", function(e) {
                e.preventDefault();

                let formElement = document.getElementById('formaddaujirehab');

                let dataSend = new FormData(formElement);
                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });

                postData(jsonObj, 'admin/jadwalFisioterapi/insertOrUpdateUjiDataFisio', (
                    res) => {
                    successSwal('Sukses');
                    let visit_id = '<?php echo $visit['visit_id']; ?>';
                    getDataJadwalFisioterapi({
                        visit_id: visit_id
                    });
                    $("#JfisioDocument").slideUp()

                })

            });
        }

        const renderRequestJadwalFisio = (props) => {

            let evaluasi_qty = props?.evaluasi_qty;
            let vactination_id = props?.vactination_id;

            let data = props?.data[vactination_id]
            data = data.filter(e => !e.schedule_type || e.schedule_type.toLowerCase() === "protokol");











            if (props?.data[vactination_id]) {
                $("#btn-save-jadwal-fisio").text("Update");
                $("#print-jadwal-fisio").show();

            } else {
                $("#btn-save-jadwal-fisio").text("Simpan");
                $("#print-jadwal-fisio").hide();
            }

            $('#reqJadwal_evaluasi_qty').val(evaluasi_qty)
            $('#reqJadwal_vactination_id').val(vactination_id)
            $('#input_treatment_jadwal_fisio').val(data[0]?.treatment || `${[
                            (props?.fisioterapi?.ultrasound && props?.fisioterapi?.ultrasound.trim() !== null) ? 'Ultrasound' : '',
                            (props?.fisioterapi?.tens && props?.fisioterapi?.tens !== null) ? 'Tens' : '',
                            (props?.fisioterapi?.exercise && props?.fisioterapi?.exercise !== null) ? 'Exercise' : '',
                            (props?.fisioterapi?.infrared && props?.fisioterapi?.infrared !== null) ? 'Infrared' : '',
                            (props?.swd && props?.swd !== null) ? 'SWD' : '',
                            (props?.mwd && props?.mwd !== null) ? 'MWD' : '',
                            (props?.eswt && props?.eswt !== null) ? 'ESWT' : '',
                            (props?.laser && props?.laser !== null) ? 'Laser' : '',
                            (props?.elektrikal_stimulasi && props?.elektrikal_stimulasi !== null) ? 'ES ( elektrikal stimulasi)' : ''
                        ].filter(Boolean).join(', ')}`)
            $('#tbody-jadwal-fisio').empty();
            let jadwalFisioCount = $('#tbody-jadwal-fisio tr').length;
            renderDiagnosa();

            data.forEach((each, index) => {
                addRowJadwalFisio('tarif-fisio' + (index + 1), each);
                $("#tarif-fisio" + (index + 1)).html(`${each
                        ?.treatment_program}`)
            })

            $('#addJadwalFisio').off('click').on('click', function() {
                let jadwalFisio = $('#tbody-jadwal-fisio tr');
                let selectedPrograms = [];

                jadwalFisio.each(function() {
                    let programValue = $(this).find('select[name="program[]"]').val();
                    let rowId = $(this).find('select[name="program[]"]').attr(
                        'id');
                    selectedPrograms.push({
                        id: rowId,
                        value: programValue
                    });
                });

                let jadwalFisioCount = jadwalFisio.length;

                let lastProgram = selectedPrograms[selectedPrograms.length - 1];

                let hasDuplicate = selectedPrograms.some(
                    (item, index, array) =>
                    array.findIndex(el => el.value === item.value) !== index
                );

                if (!selectedPrograms.some(item => !item.value) && !hasDuplicate) {
                    addRowJadwalFisio('tarif-fisio' + (jadwalFisioCount + 1));
                    initializeSearchTarifFisio('tarif-fisio' + (jadwalFisioCount + 1));
                } else {
                    if (hasDuplicate) {
                        errorSwal("Program Sudah Ada")
                        $(`#${lastProgram?.id}`).closest('tr').remove();
                    }
                }
            });
        } // baru havin 26 09

        function addRowProgramFisio(SelectID, data = null) {
            let signRead = data?.valid_user || data?.valid_pasien || data?.valid_other
            let retrunOption = signRead ? "disabled" : ""
            // id="flatdate-req-fisio"
            var newRow = `
                    <tr>
                        <td class="text-center align-middle fw-bold print-hidden-form" style="width:20% !important">
                            <input type="text" ${retrunOption} name="vactination_date[]" class="form-control datepicker-tanggal-fisio print-hidden-form" value="${moment(data?.vactination_date).format('YYYY-MM-DD')}">
                        </td>
                        <td class="text-center align-middle fw-bold print-hidden-form" style="width:25% !important">
                            <select class="form-select tarif-fisio print-hidden-form" ${retrunOption} id="${SelectID}" name="program[]"  style="width:100% !important"></select>
                        </td>
                        <td class="text-center align-middle fw-bold print-hidden-form" style="width:20% !important">
                            <input type="hidden" id="tindakan-fisio-${data?.vactination_id}" name="vactination_id_program[]" class="form-control" value="${data?.vactination_id ?? get_bodyid()}">
                            <input type="text" ${retrunOption} name="treatment_description[]" class="form-control print-hidden-form" value="${data?.treatment_description || ""}">
                            <input type="hidden" name="schedule_type[]" class="form-control" value="program">
                            <input type="hidden" name="valid_user_program[]" class="form-control" ${data?.valid_user ? `value="${data.valid_user}"` : ""}>
                            <input type="hidden" name="valid_pasien_program[]" class="form-control" ${data?.valid_pasien ? `value="${data.valid_pasien}"` : ""}>
                            <input type="hidden" name="valid_other_program[]" class="form-control" ${data?.valid_other ? `value="${data.valid_other}"` : ""}>
                        </td>
                        <td class="text-center align-middle fw-bold" width="1%">
                            <div class="position-relative d-flex justify-content-center align-items-center" id="qr-dokter-program-${data?.vactination_id}">
                                <button type="button" id="formsignprogramFisio-dokter-${data?.vactination_id}" data-id="${data?.vactination_id}" data-user-type="1" data-filed="valid_user" name="signFisio" data-sign-ke="2" data-button-id="btn-save-jadwal-fisio" class="btn btn-sm btn-warning row-to-hide" >
                                    <i class="fa fa-signature"></i>
                                </button>
                            </div>
                        </td>
                        <td width="1%" class="row-to-hide">
                            <button type="button" style="${signRead ? 'display: none;' : ''}" class="btn btn-danger btn-sm delete-row-fisio print-hidden-form">
                                <i class="fas fa-trash-alt print-hidden-form"></i>
                            </button>
                        </td>
                    </tr>
            `;

            $('#tbody-program-fisio').append(newRow);

            if (data?.valid_user) {
                $(`#formsignprogramFisio-dokter-${data?.vactination_id}`).hide();
                let qrcode1 = new QRCode(document.getElementById(
                    `qr-dokter-program-${data?.vactination_id}`), {
                    text: data?.valid_user,
                    width: 35,
                    height: 35,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }


            $("button[name='signFisio']").each(function() {
                if (data?.vactination_id) {
                    $(this).prop('disabled', false);
                } else {
                    $(this).prop('disabled', true);
                }
            });

            $("button[name='signFisio']").off().on("click", function() {
                const signKe = $(this).data('sign-ke');
                const userType = $(this).data('user-type');
                const filed = $(this).data('filed')
                const id = $(this).data('id')
                const idPk = `tindakan-fisio-` + id

                if (!$(this).is(':disabled')) {
                    addSignUser(formId = "form-program-fisio", container = "", primaryKey =
                        idPk, buttonId = "btn-save-program-fisio", docs_type = 18,
                        user_type = userType, sign_ke = signKe, title =
                        "Tindakan Fisio Terapi",
                        columnName = filed,
                        value_id = null)
                }
            });

            // flatpickr('.datepicker-tanggal-fisio', {
            //     dateFormat: 'Y-m-d',
            //     enableTime: false,

            //     onChange: function(selectedDates, dateStr, instance) {

            //     }
            // });

            $(".datepicker-tanggal-fisio").prop("readonly", false);

            // flatpickr('.datepicker-program-fisio', {
            //     // defaultDate: moment().format('HH:mm'),
            //     enableTime: true,
            //     noCalendar: true,
            //     dateFormat: "H:i",
            //     time_24hr: true,

            //     onChange: function(selectedDates, dateStr, instance) {

            //     }
            // });
            $(".datepicker-program-fisio").prop("readonly", false);



            $('.delete-row-fisio').click(function() {
                $(this).closest('tr').remove();

                let programFisioCount = $('#tbody-program-fisio tr').length;


                // if (jadwalFisioCount < 3) {

                //     $('#addJadwalFisio').show();
                // }
            });

        }

        const renderRequestProgramFisio = (props) => {

            let evaluasi_qty = props?.evaluasi_qty;
            let vactination_id = props?.vactination_id;

            let data = props?.data[vactination_id]
            data = data.filter(e => !e.schedule_type || e.schedule_type.toLowerCase() === "program");



            if (props?.data[vactination_id]) {
                $("#btn-save-program-fisio").text("Update");
                $("#print-program-fisio").show();

            } else {
                $("#btn-save-program-fisio").text("Simpan");
                $("#print-program-fisio").hide();
            }

            $('#reqprogram_evaluasi_qty').val(evaluasi_qty)
            $('#reqprogram_vactination_id').val(vactination_id)

            $('#input_treatment_jadwal_fisio_programFisio').text(data[0]?.treatment || `${[
                    (props?.fisioterapi?.ultrasound && props?.fisioterapi?.ultrasound.trim() !== null) ? 'Ultrasound' : '',
                    (props?.fisioterapi?.tens && props?.fisioterapi?.tens !== null) ? 'Tens' : '',
                    (props?.fisioterapi?.exercise && props?.fisioterapi?.exercise !== null) ? 'Exercise' : '',
                    (props?.fisioterapi?.infrared && props?.fisioterapi?.infrared !== null) ? 'Infrared' : '',
                    (props?.fisioterapi?.swd && props?.fisioterapi?.swd !== null) ? 'SWD' : '',
                    (props?.fisioterapi?.mwd && props?.fisioterapi?.mwd !== null) ? 'MWD' : '',
                    (props?.fisioterapi?.eswt && props?.fisioterapi?.eswt !== null) ? 'ESWT' : '',
                    (props?.fisioterapi?.laser && props?.fisioterapi?.laser !== null) ? 'Laser' : '',
                    (props?.fisioterapi?.elektrikal_stimulasi && props?.fisioterapi?.elektrikal_stimulasi !== null) ? 'ES ( elektrikal stimulasi)' : ''
                ].filter(Boolean).join(', ')}`)

            $("#input_treatment_fisio_programFisio").val(data[0]?.treatment || `${[
                    (props?.fisioterapi?.ultrasound && props?.fisioterapi?.ultrasound.trim() !== null) ? 'Ultrasound' : '',
                    (props?.fisioterapi?.tens && props?.fisioterapi?.tens !== null) ? 'Tens' : '',
                    (props?.fisioterapi?.exercise && props?.fisioterapi?.exercise !== null) ? 'Exercise' : '',
                    (props?.fisioterapi?.infrared && props?.fisioterapi?.infrared !== null) ? 'Infrared' : '',
                    (props?.fisioterapi?.swd && props?.fisioterapi?.swd !== null) ? 'SWD' : '',
                    (props?.fisioterapi?.mwd && props?.fisioterapi?.mwd !== null) ? 'MWD' : '',
                    (props?.fisioterapi?.eswt && props?.fisioterapi?.eswt !== null) ? 'ESWT' : '',
                    (props?.fisioterapi?.laser && props?.fisioterapi?.laser !== null) ? 'Laser' : '',
                    (props?.fisioterapi?.elektrikal_stimulasi && props?.fisioterapi?.elektrikal_stimulasi !== null) ? 'ES ( elektrikal stimulasi)' : ''
                ].filter(Boolean).join(', ')}`)

            $('#tbody-program-fisio').empty();
            let ProgramFisioCount = $('#tbody-program-fisio tr').length;
            renderDiagnosa();

            data.forEach((each, index) => {
                addRowProgramFisio('tarif-fisio-program' + (index + 1), each);
                initializeSearchTarifFisio('tarif-fisio-program' + (index + 1), each?.tarif_id, each
                    ?.treatment_program)
            })

            $('#addprogramFisio').off('click').on('click', function() {
                let ProgramFisio = $('#tbody-program-fisio tr');
                let selectedPrograms = [];

                ProgramFisio.each(function() {
                    let programValue = $(this).find('select[name="program[]"]').val();
                    let rowId = $(this).find('select[name="program[]"]').attr(
                        'id');
                    selectedPrograms.push({
                        id: rowId,
                        value: programValue
                    });
                });

                let ProgramFisioCount = ProgramFisio.length;

                let lastProgram = selectedPrograms[selectedPrograms.length - 1];

                let hasDuplicate = selectedPrograms.some(
                    (item, index, array) =>
                    array.findIndex(el => el.value === item.value) !== index
                );

                if (!selectedPrograms.some(item => !item.value) && !hasDuplicate) {
                    addRowProgramFisio('tarif-fisio-program' + (ProgramFisioCount + 1));
                    initializeSearchTarifFisio('tarif-fisio-program' + (ProgramFisioCount + 1));
                } else {
                    if (hasDuplicate) {
                        errorSwal("Program Sudah Ada")
                        $(`#${lastProgram?.id}`).closest('tr').remove();
                    }
                }
            });
        }




        const tandaTangan = (props) => {
            const base64_ttd_dok = props?.data?.ttd_dok
            const base64_ttd_dok_name = props?.data?.doctor
            const base64_ttd_pasien = props?.data?.ttd_pasien
            const base64_ttd_name = props?.data?.thename
            let visit = <?= json_encode($visit) ?>;


            if (base64_ttd_dok) {
                $('#qrcode-fisio-conver-dokter').html(
                    `<img src="${base64_ttd_dok}" alt="QR Code" style="width: 100%; max-width: 300px; height: auto;">`
                );

                $('#qrcode-fisio-conver-dokter_name').html(base64_ttd_dok_name)
                $('#qrcode-fisio-dokter_name').html(base64_ttd_dok_name)

                $('#qrcode-fisio-dokter').html(
                    `<img src="${base64_ttd_dok}" alt="QR Code" style="width: 100%; max-width: 300px; height: auto;">`
                );

            } else {
                $('#qrcode-fisio-conver-dokter').html('');
                $('#qrcode-fisio-dokter').html('')
            }


            if (base64_ttd_pasien) {
                cropTransparentPNG(base64_ttd_pasien, (croppedImage) => {
                    if (croppedImage) {
                        $('#qrcode-fisio-pasien').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );

                        $('#qrcode-fisio-pasien_name').html(base64_ttd_name)
                        $('#qrcode-fisio-uji-pasien_name').html(base64_ttd_name)
                        $('#qrcode-fisio-uji-pasien').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                    } else {
                        $('#qrcode-fisio-pasien').html('');
                        $('#qrcode-fisio-uji-pasien').html('')
                    }
                });
            } else {
                $('#qrcode-fisio-pasien').html('');
                $('#qrcode-fisio-uji-pasien').html('')

            }
        }

        function addRowJadwalFisio(SelectID, data = null) {

            let signRead = data?.valid_user || data?.valid_pasien || data?.valid_other
            let retrunOption = signRead ? "disabled" : ""
            // id="flatdate-req-fisio"
            var newRow = `
    <tr>
        <td class="text-center align-middle fw-bold print-hidden-form" style="width:25% !important">
            <p id="${SelectID}"></p>
        </td>
        <td class="text-center align-middle fw-bold print-hidden-form" style="width:20% !important">
            <input type="hidden" id="tindakan-fisio-${data?.vactination_id}" name="vactination_id_program[]" class="form-control" value="${data?.vactination_id ?? get_bodyid()}">
            <input type="text" name="treatment_description[]" class="form-control print-hidden-form" ${retrunOption} value="${data?.treatment_description || ""}">
            <input type="hidden" name="schedule_type[]" class="form-control" value="protokol">
            <input type="hidden" name="valid_user_program[]" class="form-control" ${data?.valid_user ? `value="${data.valid_user}"` : ""}>
            <input type="hidden" name="valid_pasien_program[]" class="form-control" ${data?.valid_pasien ? `value="${data.valid_pasien}"` : ""}>
            <input type="hidden" name="valid_other_program[]" class="form-control" ${data?.valid_other ? `value="${data.valid_other}"` : ""}>
        </td>
        <td class="text-center align-middle fw-bold print-hidden-form" style="width:20% !important">
            <input type="text" name="vactination_date[]" class="form-control datepicker-tanggal-fisio print-hidden-form" ${retrunOption} value="${moment(data?.vactination_date).format('YYYY-MM-DD')}">
        </td>
        <td class="text-center align-middle fw-bold print-hidden-form" style="width:10% !important">
            <input type="text" name="start[]" class="form-control datepicker-jadwal-fisio print-hidden-form"  ${retrunOption} value="${moment(data?.start_date).format('HH:mm')}">
        </td>
        <td class="text-center align-middle fw-bold print-hidden-form" style="width:10% !important">
            <input type="text" name="end[]" class="form-control datepicker-jadwal-fisio print-hidden-form" ${retrunOption} value="${moment(data?.end_date).format('HH:mm')}">
        </td>
        <td class="text-center align-middle fw-bold" width="1%">
            <div class="position-relative d-flex justify-content-center align-items-center" id="qr-pasien-${data?.vactination_id}">
                
            </div>
        </td>
        <td class="text-center align-middle fw-bold" width="1%">
            <div class="position-relative d-flex justify-content-center align-items-center" id="qr-dokter-${data?.vactination_id}">
                
            </div>
        </td>
        <td class="text-center align-middle fw-bold" width="1%">
            <div class="position-relative d-flex justify-content-center align-items-center" id="qr-terapis-${data?.vactination_id}">
                
            </div>
        </td>
        <td width="1%" class="row-to-hide">
            
        </td>
    </tr>
`;



            $('#tbody-jadwal-fisio').append(newRow);

            if (data?.valid_user) {
                $(`#formsignJadwalFisio-dokter-${data?.vactination_id}`).hide();
                let qrcode = new QRCode(document.getElementById(
                    `qr-dokter-${data?.vactination_id}`), {
                    text: data?.valid_user,
                    width: 35,
                    height: 35,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }

            if (data?.valid_pasien) {
                $(`#formsignJadwalFisio-pasien-${data?.vactination_id}`).hide();
                let qrcode = new QRCode(document.getElementById(
                    `qr-pasien-${data?.vactination_id}`), {
                    text: data?.valid_pasien,
                    width: 35,
                    height: 35,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }
            if (data?.valid_other) {
                $(`#formsignJadwalFisio-terapis-${data?.vactination_id}`).hide();
                let qrcode = new QRCode(document.getElementById(
                    `qr-terapis-${data?.vactination_id}`), {
                    text: data?.valid_other,
                    width: 35,
                    height: 35,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }


            $("button[name='signFisio']").each(function() {
                if (data?.vactination_id) {
                    $(this).prop('disabled', false);
                } else {
                    $(this).prop('disabled', true);
                }
            });


            $("button[name='signFisio']").off().on("click", function() {
                const signKe = $(this).data('sign-ke');
                const userType = $(this).data('user-type');
                const filed = $(this).data('filed')
                const id = $(this).data('id')
                const idPk = `tindakan-fisio-` + id

                if (!$(this).is(':disabled')) {
                    addSignUser(formId = "form-jadwal-fisio", container = "", primaryKey =
                        idPk, buttonId = "btn-save-jadwal-fisio", docs_type = 18,
                        user_type = userType, sign_ke = signKe, title =
                        "Tindakan Fisio Terapi",
                        columnName = filed,
                        value_id = null)
                }
            });

            // flatpickr('.datepicker-tanggal-fisio', {
            //     dateFormat: 'Y-m-d',
            //     enableTime: false,

            //     onChange: function(selectedDates, dateStr, instance) {

            //     }
            // });

            $(".datepicker-tanggal-fisio").prop("readonly", false);

            // flatpickr('.datepicker-jadwal-fisio', {
            //     // defaultDate: moment().format('HH:mm'),
            //     enableTime: true,
            //     noCalendar: true,
            //     dateFormat: "H:i",
            //     time_24hr: true,

            //     onChange: function(selectedDates, dateStr, instance) {

            //     }
            // });
            $(".datepicker-jadwal-fisio").prop("readonly", false);



            $('.delete-row-fisio').click(function() {
                $(this).closest('tr').remove();

                let jadwalFisioCount = $('#tbody-jadwal-fisio tr').length;


                // if (jadwalFisioCount < 3) {

                //     $('#addJadwalFisio').show();
                // }
            });

        }
    </script>
<?php endif; ?>