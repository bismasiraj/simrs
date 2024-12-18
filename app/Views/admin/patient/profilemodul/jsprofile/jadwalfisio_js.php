<?php
$db = db_connect();

$getDataTarif = $db->query("
SELECT
    TREAT_TARIF.TARIF_NAME as text, 
    TREAT_TARIF.TARIF_ID as id
FROM TREAT_TARIF
INNER JOIN treatment ON treatment.treat_id = TREAT_TARIF.treat_id
WHERE TREATMENT.TREAT_TYPE IN ('16')
ORDER BY TREAT_TARIF.TARIF_NAME")->getResultArray();

?>
<script type="text/javascript">
    (function() {
        let getDataFisioterapiAll = []
        let diagnosaList = []
        $(document).ready(function() {
            getDataTableJadwalFisio()

            renderNonFisioterapiTemplate()
            btnActionSaveUpdate()



            btnSaveRequestJadwalFisio();
            btnActionSaveUpdateFisioterapiDetail();
            tandaTangan()
        });




        function addRowJadwalFisio(SelectID, data = null) {
            // id="flatdate-req-fisio"
            var newRow = `
                <tr>
                    <td class="text-center align-middle fw-bold print-hidden-form" style="width:56% !important">
                        <select class="form-select tarif-fisio" id="${SelectID}" name="program[]"  style="width:100% !important"></select>
                    </td>
                    <td class="text-center align-middle fw-bold print-hidden-form" style="width:20% !important">
                        <input type="text" name="vactination_date[]" class="form-control datepicker-tanggal-fisio" value="${moment(data?.vactination_date).format('YYYY-MM-DD')}">
                    </td>
                    <td class="text-center align-middle fw-bold print-hidden-form" style="width:10% !important">
                        <input type="text" name="start[]" class="form-control datepicker-jadwal-fisio" value="${moment(data?.start_date).format('HH:mm')}">
                    </td>
                    <td class="text-center align-middle fw-bold print-hidden-form" style="width:10% !important">
                        <input type="text" name="end[]" class="form-control datepicker-jadwal-fisio" value="${moment(data?.end_date).format('HH:mm')}">
                    </td>
                    <td class="text-center align-middle fw-bold" width="1%">

                    </td>
                    <td class="text-center align-middle fw-bold" width="1%">
                        <div class="position-relative d-flex justify-content-center align-items-center" id="qr-dokter-${data?.vactination_id}">
                            <button type="button" id="formsignJadwalFisio-dokter-${data?.vactination_id}" data-user-type="dokter" name="signFisio" data-sign-ke="1" data-button-id="btn-save-jadwal-fisio" class="btn btn-sm btn-warning row-to-hide" data-bs-toggle="modal" data-bs-target="#digitalSignModalOperation" style="${data?.vactination_id || 'display:none'}">
                                <i class="fa fa-signature"></i>
                            </button>
                        </div>
                    </td>
                    <td class="text-center align-middle fw-bold" width="1%">
                        <div class="position-relative d-flex justify-content-center align-items-center" id="qr-terapis-${data?.vactination_id}">
                            <button type="button" id="formsignJadwalFisio-terapis-${data?.vactination_id}" data-user-type="terapis" name="signFisio" data-sign-ke="2" data-button-id="btn-save-jadwal-fisio" class="btn btn-sm btn-warning row-to-hide" data-bs-toggle="modal" data-bs-target="#digitalSignModalOperation" style="${data?.vactination_id || 'display:none'}">
                                <i class="fa fa-signature"></i>
                            </button>
                        </div>
                    </td>
                    <td width="1%" class="row-to-hide">
                        <button type="button" class="btn btn-danger btn-sm delete-row-fisio"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            `;

            $('#tbody-jadwal-fisio').append(newRow);


            $("button[name='signFisio']").each(function() {
                if (data?.vactination_id) {
                    $(this).prop('disabled', false);
                } else {
                    $(this).prop('disabled', true);
                }
            });


            $("button[name='signFisio']").off().on("click", function() {
                const buttonId = $(this).data('button-id');
                const signKe = $(this).data('sign-ke');
                const userType = $(this).data('user-type');
                if (!$(this).is(':disabled')) {
                    addSignUserOPS("form-jadwal-fisio", "jadwal-fisioterapi", data?.vactination_id,
                        buttonId,
                        9, userType, signKe,
                        "Jadwal Fisioterapi");
                }
            });

            flatpickr('.datepicker-tanggal-fisio', {
                dateFormat: 'Y-m-d',
                enableTime: false,

                onChange: function(selectedDates, dateStr, instance) {

                }
            });

            flatpickr('.datepicker-jadwal-fisio', {
                // defaultDate: moment().format('HH:mm'),
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,

                onChange: function(selectedDates, dateStr, instance) {

                }
            });


            $('.delete-row-fisio').click(function() {
                $(this).closest('tr').remove();

                let jadwalFisioCount = $('#tbody-jadwal-fisio tr').length;


                // if (jadwalFisioCount < 3) {

                //     $('#addJadwalFisio').show();
                // }
            });

        }

        const printJfisio = (props) => {
            $(`#${props?.id_button}`).off().on('click', function() {
                const printContent = document.querySelector(`#${props?.id_formTab} .card-body`).cloneNode(
                    true);
                const style = document.createElement('style');
                style.textContent = `
                                @media print {
                                    .hidden-show-ttd {
                                        display: flex !important; /* Mengubah display menjadi flex */
                                        justify-content: space-between; /* Menyebarkan elemen ke kanan dan kiri */
                                    }

                                    .hidden-show-ttd .col-3 {
                                        width: 45%; /* Atur lebar kolom */
                                    }

                                    .hidden-show-ttd .col {
                                        display: none; /* Sembunyikan kolom tengah */
                                    }

                                    /* Atur gaya lainnya */
                                    @page {
                                        size: A4;
                                    }

                                    body {
                                        width: 21cm;
                                        height: 29.7cm;
                                        margin: 0;
                                        font-size: 12px;
                                    }

                                    .form-control.print-hidden-form:disabled,
                                    .form-control.print-hidden-form[readonly] {
                                        background-color: #FFF;
                                        opacity: 1;
                                    }
                                    .form-control.datepicker-tanggal-fisio{
                                        border: none;
                                        background: transparent;
                                    }
                                    .form-control.datepicker-jadwal-fisio{
                                        border: none;
                                        background: transparent;
                                        font-size: 10px;
                                    }

                                    .form-control.print-hidden-form,
                                    .input-group-text {
                                        background-color: #fff;
                                        border: 1px solid #fff;
                                        font-size: 12px;
                                    }

                                    .h1, .h2, .h3, .h4, .h5, .h6,
                                    h1, h2, h3, h4, h5, h6 {
                                        margin-top: 0;
                                        margin-bottom: .3rem;
                                        font-weight: 500;
                                        line-height: 1.2;
                                    }

                                    thead.border {
                                        border-bottom: 1px solid black !important;
                                        border-top: 1px solid black !important;
                                    }

                                    tbody.border {
                                        border-bottom: 1px solid black !important;
                                    }

                                    .d-flex button {
                                        display: none;
                                    }
                                    .row-to-hide{
                                        display: none;
                                    }
                                    .form-select.tarif-fisio{
                                        display: none;
                                    }
                                }
                                .d-flex button {
                                    display: none;
                                }
                            `;


                const inputs = printContent.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const inputType = input.type;

                    if (inputType === 'checkbox') {
                        const originalInputs = document.querySelectorAll(
                            `input[type="checkbox"][name="${input.name}"]`);
                        let isChecked = false;

                        originalInputs.forEach(originalInput => {
                            if (originalInput.checked) {
                                isChecked = true;
                            }
                        });

                        if (isChecked) {
                            input.setAttribute('checked', '');
                        } else {
                            input.removeAttribute('checked');
                        }
                        input.setAttribute('onclick', 'return false');
                    } else if (inputType === 'radio') {
                        const name = input.name;
                        const originalInput = document.querySelector(
                            `input[name="${name}-radio"]:checked`);

                        if (originalInput) {
                            input.checked = (originalInput.value === input.value);
                        } else {
                            input.value = (input.value === '1') ? '0' : '1';

                            if (input.value === '1') {
                                input.setAttribute('checked', '');
                            } else {
                                input.removeAttribute('checked');
                            }
                        }
                        input.setAttribute('onclick', 'return false');

                    } else if (inputType === 'hidden' && input.classList.contains(
                            'datetime-thems')) {

                        const hiddenValue = input.value;
                        const displayValue = document.createElement('div');
                        displayValue.textContent = hiddenValue;
                        displayValue.className =
                            'hidden-value';
                        input.replaceWith(displayValue);
                        input.setAttribute('disabled', '');
                    } else if (inputType === 'text' && input.id.startsWith('flatdate-')) {} else {
                        const originalInput = document.querySelector(
                            `input[name="${input.name}"], textarea[name="${input.name}"]`);
                        if (originalInput) {
                            input.value = originalInput.value;
                            input.setAttribute('value', originalInput.value);
                        }
                        input.setAttribute('disabled', '');
                    }
                });

                const hiddenInputs = printContent.querySelectorAll('input[type="hidden"].datetime-thems');
                hiddenInputs.forEach(hiddenInput => {
                    const id = hiddenInput.id;
                    const correspondingInput = document.querySelector(
                        `input[id="${id.replace('flatdate-', '')}"]`);

                    if (!correspondingInput) {
                        const displayValue = document.createElement('div');
                        displayValue.textContent = hiddenInput.value;
                        hiddenInput.replaceWith(displayValue);
                    }
                });

                const printWindow = window.open('', '_blank', 'width=800,height=600');

                printWindow.document.write(`
            <html>
                <head>
                    <title>Cetak</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
                    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">
                    <style>
                            .form-control.print-hidden-form:disabled,
                            .form-control.print-hidden-form[readonly] {
                                background-color: #FFF;
                                opacity: 1;
                            }

                            .form-control.print-hidden-form,
                            .input-group-text {
                                background-color: #fff;
                                border: 1px solid #fff;
                                font-size: 12px;
                            }
                    </style>
                </head>
                <body>
                    ${printContent.innerHTML} 
                </body>
            </html>
        `);

                printWindow.document.head.appendChild(style);
                printWindow.document.close();

                printWindow.print();
            });
        };


        const getDataJadwalFisioterapi = (props) => {
            postData({
                // visit_id: "2024062310264005533E4"
                visit_id: props?.visit_id
            }, 'admin/jadwalFisioterapi/getData', (res) => {
                diagnosaList = res?.value?.diagnosa || []
                renderDiagnosa()
                renderKop({
                    kop: res?.value?.kop || {}
                })

                if (res.value?.fisioterapi.length >= 1) {
                    getDataFisioterapiAll = res.value?.fisioterapi
                    getDataFisioterapiDetailAll = res.value?.fioterapi_detail || []
                    renderJadwalFisio({
                        data: res.value?.fisioterapi,
                        data_schedule: res.value?.fisioterapi_schedule,
                        monitoring_nyeri: res?.value?.monitoring_nyeri
                    });
                } else {
                    $("#save-tabelsOdd").attr("disabled", "disabled");
                    $("#bodydataJadwalFisioterapi").html(tempTablesNull());
                }
            }, (beforesend) => {
                getLoadingGlobalServices('bodydataJadwalFisioterapi');
            });
        };

        const getDataTableJadwalFisio = (props) => {
            $("#jadwalFisioTab").off().on("click", function(e) {
                e.preventDefault();

                if ($("#JfisioDocument").is(":visible")) {
                    $("#JfisioDocument").slideUp();
                }
                getLoadingscreen("contentToHide-jadwalFisio", "load-content-jadwalFisio")
                let visit_id = '<?php echo $visit['visit_id']; ?>';
                getDataJadwalFisioterapi({
                    visit_id: visit_id
                });
            });
        };

        const renderKop = (props) => {
            $('.kop-name').text(props?.kop.name_of_org_unit || '');
            $('.kop-address').text(props?.kop.contact_address || '');
        }

        const renderDiagnosa = (props) => {
            let diagnosa = diagnosaList
            let anamnaseList = diagnosa.map(item => item.anamnase).filter(Boolean);
            $('#anamnase-output-fisio').text(anamnaseList.join(', '));

            let diagMedis = diagnosa?.filter(item => item.diag_cat === '1').map(item => item
                .diagnosa_desc);
            $('#diagnosis-medis-output-fisio').text(diagMedis.join(', '));
            $('#diagnosis-medis-uji-fisio').text(diagMedis.join(', '));

            let diagFungsi = diagnosa?.filter(item => item.diag_cat === '17').map(item => item
                .diagnosa_desc);
            $('#diagnosis-fungsi-output-fisio').text(diagFungsi.join(', '));
            $('#diagnosis-fungsi-uji-fisio').text(diagFungsi.join(', '));
            $('#diagnosis-fungsi-output-coverfisio').text(diagFungsi.join(', '));

        }

        const renderJadwalFisio = (data) => {
            let resultData = '';
            data.data.forEach((e, index) => {

                resultData += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${!e.vactination_date ?"-": moment(e.vactination_date).format("DD-MM-YYYY HH:mm")}</td>
                    <td>${e.doctor}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-show-render-Jfisio" autocomplete="off" data-index="${index}"><i
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
            $('.btn-show-render-Jfisio').on('click', function(e) {
                let index = $(this).data('index');
                let item = getDataFisioterapiAll[index];
                $('a[href="#formulirRequestFisio"]').closest('li').show();
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

                renderRequestJadwalFisio({
                    vactination_id: item.vactination_id,
                    evaluasi_qty: item.evaluasi_qty,
                    data: props?.data_schedule
                }) // baru havin 26 09

                renderUjiRehabMedic({
                    data: resultdetailData ?? null,
                    monitoring_nyeri: props?.monitoring_nyeri
                })

                $('#coverSendFisioterapi').addClass('show active');
                $('#formulirRequestFisio').removeClass(
                    'show active');
                $('#JfisioDocument .nav-link').removeClass('active');
                $('#formulirUjiFisio').removeClass('show active');
                $('#rawatJalanRM').removeClass('show active');
                $('a[href="#coverSendFisioterapi"]').addClass('active');
                $('.datetime-now').html(moment(new Date()).format('DD-MM-YYYY HH:mm'))

                $('#JfisioDocument').show();

            })
        }

        const renderFisioterapiTemplate = (props) => {
            let visit = <?= json_encode($visit) ?>;

            const vactinationDate = props?.fisioterapi.vactination_date ?
                moment(props.fisioterapi.vactination_date).format('DD-MM-YYYY HH:mm') :
                new Date().toLocaleString();
            $('#vactination_date-fisio').text(vactinationDate);
            $('#anamnase-fisio-output').text(props?.fisioterapi.anamnase || '');
            $('#vas-fisio').val(props?.fisioterapi.vas || '');
            $('#functions-fisio').val(props?.fisioterapi.functions || '');
            $('#diagnosis-fisio-medis-output').text(props?.fisioterapi.diagnosis_medis || '');
            $('#diagnosis-fisio-fungsi-output').text(props?.fisioterapi.diagnosis_fungsi || '');

            $('#other_checkbox-fisio').prop('checked', !!props?.fisioterapi.other_desc);
            $('#other_desc-fisio').val(props?.fisioterapi.other_desc || '').toggle(!!props?.fisioterapi.other_desc);

            $('#suggestion-fisio').val(props?.fisioterapi.suggestion || '');
            $('#goal-fisio').val(props?.fisioterapi.teraphy_goal || '');
            $('#evaluation_qty-fisio').val(props?.fisioterapi.evaluation_qty || 0);

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
                printJfisio({
                    id_button: "print-form-fisioterapi",
                    id_formTab: "rawatJalanRM"
                });
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
                    checkbox: '#other_checkbox-fisio',
                    input: '#other_desc-fisio',
                    prop: 'other_desc'
                }
            ];

            fisioterapiItems.forEach(item => {
                const value = props?.fisioterapi[item.prop];

                $(item.checkbox).prop('checked', !!value && value !== " ");
                $(item.input).val(value || '').toggle(!!value && value !== " ");

                $(item.checkbox).on('change', function() {
                    if ($(this).is(':checked')) {
                        $(item.input).show().prop('disabled', false);
                    } else {
                        $(item.input).val(' ').hide().prop('disabled', true);
                    }
                });
            });

            $("#no_registration-fisio-val").val(props?.fisioterapi?.no_registration);
            $("#visit_id-fisio-val").val(props?.fisioterapi?.visit_id);
            $("#bill_id-fisio-val").val(props?.fisioterapi?.bill_id);
            $("#clinic_id-fisio-val").val(props?.fisioterapi?.clinic_id);
            $("#terlayani-fisio-val").val(0);
            $("#employee_id-fisio-val").val(props?.fisioterapi?.employee_id);
            $("#patient_category_id-fisio-val").val(props?.fisioterapi?.patient_category_id);
            $("#tarif_id-fisio-val").val(props?.fisioterapi?.tarif_id);
            $("#validation-fisio-val").val(0);
            $("#description-fisio-val").val(props?.fisioterapi?.description);
            $("#thename-fisio-val").val(props?.fisioterapi?.name_of_pasien);
            $("#theaddress-fisio-val").val(props?.fisioterapi?.contact_address);
            $("#theid-fisio-val").val();
            $("#isrj-fisio-val").val(props?.fisioterapi?.isrj);
            $("#ageyear-fisio-val").val(props?.fisioterapi?.ageyear || 0);
            $("#agemonth-fisio-val").val(props?.fisioterapi?.agemonth || 0);
            $("#ageday-fisio-val").val(props?.fisioterapi?.ageday || 0);
            $("#status_pasien_id-fisio-val").val(props?.fisioterapi?.status_pasien_id);
            $("#gender-fisio-val").val(props?.fisioterapi?.gender);
            $("#doctor-fisio-val").val(props?.fisioterapi?.fullname || props?.fisioterapi?.fullname_inap);
            $("#kal_id-fisio-val").val();
            $("#class_room_id-fisio-val").val(props?.fisioterapi?.class_room_id);
            $("#bed_id-fisio-val").val(props?.fisioterapi?.bed_id);
            $("#tarif_name-fisio-val").val(props?.fisioterapi?.tarif_name);
            $("#terapi_desc-fisio-val").val(props?.fisioterapi?.terapi_desc);

            renderDiagnosa();

        };

        const btnActionSaveUpdate = (props) => {
            $("#save-form-fisioterapi").on("click", function(e) {
                e.preventDefault();

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
                    $("#JfisioDocument").slideUp()

                })

            });

            $("#save-form-fisioterapi-cover").on("click", function(e) {
                e.preventDefault();

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
                $('a[href="#formulirUjiFisio"]').closest('li').hide();
                $('a[href="#rawatJalanRM"]').closest('li').hide();

                $('#coverSendFisioterapi').addClass('show active');
                $('#formulirRequestFisio').removeClass(
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
                printJfisio({
                    id_button: "print-form-fisioterapi-cover",
                    id_formTab: "coverSendFisioterapi"
                });
            } else {
                $("#save-form-fisioterapi-cover").text("Simpan")
                $("#print-form-fisioterapi-cover").hide();
            }
            let nameValueVisit = [
                'no_registration', 'diantar_oleh', 'gender', 'age',
                'contact_address', 'fullname', 'clinic_id', 'visit_date'
            ];

            nameValueVisit?.forEach(name => {
                let id = `${name}-val-coverfisio`;
                let value = visit?.[name];

                if (name === 'age') {
                    let dateOfBirth = visit?.date_of_birth;
                    if (dateOfBirth) {
                        let date = `${moment(dateOfBirth).format('DD-MM-YYYY')} ${visit?.age}`
                        $(`#${id}`).text(date);
                    } else {
                        $(`#${id}`).text('');
                    }
                } else if (name === 'gender') {
                    let gender = parseFloat(visit?.gender);

                    if (gender) {
                        let hasilGen = gender === 1 ? 'Laki-Laki' : 'Perempuan'
                        $(`#${id}`).text(hasilGen);
                    } else {
                        $(`#${id}`).text('-');
                    }

                } else {
                    if (value !== undefined) {
                        $(`#${id}`).text(value);
                    }
                }
            });

            let nameValueVisit2 = [
                'diantar_oleh', 'age', 'no_registration',
                'contact_address',
            ];

            nameValueVisit2?.forEach(name => {
                let id = `${name}-val2-coverfisio`;
                let value = visit?.[name];
                if (value !== undefined) {
                    $(`#${id}`).text(value);
                }
            });


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
            $("#employee_id-fisio-val-coverfisio").val(props?.fisioterapi?.employee_id || visit?.employee_id);
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
            $("#doctor-fisio-val-coverfisio").val(props?.fisioterapi?.doctor || visit?.fullname_inap || "");
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
                    checkbox: '#other_checkbox-fisio-cover',
                    input: '#other_desc-fisio-cover',
                    prop: 'other_desc'
                }
            ];
            fisioterapiItems.forEach(item => {
                const value = props?.fisioterapi[item.prop];

                $(item.checkbox).prop('checked', !!value && value !== " ");
                $(item.input).val(value || '').toggle(!!value && value !== " ");

                $(item.checkbox).on('change', function() {
                    if ($(this).is(':checked')) {
                        $(item.input).show().prop('disabled', false);
                    } else {
                        $(item.input).val(' ').hide().prop('disabled', true);
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
                $("#save-form-uji-rehab").text("Update");
                $("#print-uji-rehab").show();

                printJfisio({
                    id_button: "print-uji-rehab",
                    id_formTab: "formulirUjiFisio"
                });
            } else {
                $("#save-form-uji-rehab").text("Simpan");
                $("#print-uji-rehab").hide();
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
                    const doctorName = visit?.fullname || visit?.fullname_inap || "";
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
            updateTreatmentResult();

            $('#val-detail-treatment').on('change keyup', function() {
                updateTreatmentResult();
            });

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
            $("#save-form-uji-rehab").off().on("click", function(e) {
                e.preventDefault();

                let formElement = document.getElementById('form-uji-rehab-medic');

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

            if (props?.data[vactination_id]) {
                $("#btn-save-jadwal-fisio").text("Update");
                $("#print-jadwal-fisio").show();

                printJfisio({
                    id_button: "print-jadwal-fisio",
                    id_formTab: "formulirRequestFisio"
                });
            } else {
                $("#btn-save-jadwal-fisio").text("Simpan");
                $("#print-jadwal-fisio").hide();
            }

            $('#reqJadwal_evaluasi_qty').val(evaluasi_qty)
            $('#reqJadwal_vactination_id').val(vactination_id)
            $('#input_treatment_jadwal_fisio').val(data[0]?.treatment)
            $('#tbody-jadwal-fisio').empty();
            let jadwalFisioCount = $('#tbody-jadwal-fisio tr').length;
            renderDiagnosa();

            data.forEach((each, index) => {
                addRowJadwalFisio('tarif-fisio' + index, each);
                initializeSearchTarifFisio('tarif-fisio' + index, each?.tarif_id, each
                    ?.treatment_program)

            })

            $('#addJadwalFisio').off('click').on('click', function() {
                let jadwalFisioCount = $('#tbody-jadwal-fisio tr').length;
                // if (jadwalFisioCount < 3) {
                //     $(this).hide();

                addRowJadwalFisio('tarif-fisio' + jadwalFisioCount + 1);
                initializeSearchTarifFisio('tarif-fisio' + jadwalFisioCount + 1)


                // }
            });



        } // baru havin 26 09

        const btnSaveRequestJadwalFisio = () => {
            $('#btn-save-jadwal-fisio').click(function(e) {
                let formData = document.querySelector('#form-jadwal-fisio');
                let dataSend = new FormData(formData);
                let jsonObj = {};

                dataSend.forEach((value, key) => {
                    jsonObj[key] = value;
                });


                let vactination_date = dataSend.getAll('vactination_date[]');
                let start = dataSend.getAll('start[]');
                let end = dataSend.getAll('end[]');
                let program_name = dataSend.getAll('program[]');

                jsonObj.program = [];
                let program_tarif = <?= json_encode($getDataTarif); ?>;
                for (let i = 0; i < program_name.length; i++) {

                    let entry = {
                        vactination_date: vactination_date[i],
                        start: start[i],
                        end: end[i],
                        program_name: program_tarif.find(item => item.id == program_name[i])?.text,
                        program_id: program_name[i]
                    };

                    jsonObj.program.push(entry);
                }

                delete jsonObj['vactination_date[]'];
                delete jsonObj['start[]'];
                delete jsonObj['end[]'];
                delete jsonObj['program[]'];

                postData(jsonObj, 'admin/jadwalFisioterapi/saveJadwalFisio', (res) => {
                    let visit_id = '<?php echo $visit['visit_id']; ?>';
                    if (res.respon) {
                        successSwal(res.message)
                        // getDataJadwalFisioterapi({
                        //     visit_id: res.result
                        // });
                        // $("#JfisioDocument").slideUp()
                    } else {
                        errorSwal(res.message)
                        // getDataJadwalFisioterapi({
                        //     visit_id: res.result
                        // });
                        // $("#JfisioDocument").slideUp()
                    }
                });
            })
        }

        const tandaTangan = (props) => {
            let visit = <?= json_encode($visit) ?>;

            var qrcode = new QRCode(document.getElementById("qrcode-fisio-conver-dokter"), {
                text: `${visit?.fullname}`, // Your text here
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });

            var qrcode = new QRCode(document.getElementById("qrcode-fisio-pasien"), {
                text: `${visit?.diantar_oleh}`, // Your text here
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });

            var qrcode = new QRCode(document.getElementById("qrcode-fisio-dokter"), {
                text: `${visit?.fullname}`, // Your text here
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });

            var qrcode = new QRCode(document.getElementById("qrcode-fisio-uji-pasien"), {
                text: `${visit?.diantar_oleh}`, // Your text here
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });





        }

        function initializeSearchTarifFisio(theid, initialvalue = null, initialname = null) {

            $("#" + theid).select2({
                theme: "bootstrap-5",
                placeholder: "Pilih tarif",
                data: <?= json_encode($getDataTarif); ?>
            });

            if (initialvalue != null) {
                let option = new Option(initialname, initialvalue, true, true);
                $("#" + theid).append(option).trigger('change');
            }

        }
    })()
</script>