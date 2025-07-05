<script type="text/javascript">
$(document).ready(function() {});

let dataBooldRequest = []
let dataBooldRequestHbLast = []
let dataKopBooldRequest = []
let dataSpecialistBooldRequest = []
let dataDoctorBooldRequest = []
$('#PermintaanDarahTab').off().on('click', function(e) {
    getDataAllBooldRequestApi({
        visit: visit,
        avalue: avalue
    })
})

const getBloodRequest = (props) => {
    let visit = props?.visit
    getDataFormPermintaanDarah({
        visit_id: visit?.visit_id,
        no_registration: visit?.no_registration,
        clinic_id: visit?.clinic_id,
        avalue: props?.avalue
    })
    getHistory({
        visit_id: visit?.visit_id,
        no_registration: visit?.no_registration,
        clinic_id: visit?.clinic_id,
    })

}

const getDataFormPermintaanDarah = (props) => {
    $('#tbodyPermintaanDarah').empty();
    postData({
        visit_id: props?.visit_id,
        no_registration: props?.no_registration,
        clinic_id: props?.clinic_id,
    }, 'admin/BloodRequest/getData', (res) => {
        dataBooldRequest = res?.data
        dataBooldRequestHbLast = res?.his_hb
        $("#no_sesi_booldRequesr option").not("[value='%']").remove();
        if (res.respon) {
            if (res.data.length > 0) {
                const addedDocumentIds = new Set();
                res.data.forEach(item => {
                    const documentId = item.document_id;
                    if (documentId && documentId.trim() !== "" && !addedDocumentIds.has(
                            documentId)) {
                        addedDocumentIds.add(documentId);
                        $("#no_sesi_booldRequesr").append($("<option>").val(documentId).text(
                            documentId));
                    }
                });

                res.data.forEach((data, index) => {
                    addPermintaanDarah({
                        data: data,
                        avalue: props?.avalue,
                        show: true,
                        visit: visit,
                        hb_last: dataBooldRequestHbLast
                    })
                })
            } else {}

            $('#tbodyPermintaanDarah').find('input.hidden-header').closest('td').hide();
            $('th.hidden-header[hidden]').attr('hidden', true);
        }
    });
}



const getHistory = (props) => {
    postData({
        visit_id: props?.visit_id,
        no_registration: props?.no_registration,
        clinic_id: props?.clinic_id,
    }, 'admin/BloodRequest/getHistory', (res) => {
        if (res.respon) {
            <?php
                $bloodUsage = array_filter($aValue, function ($value) {
                    return $value['p_type'] === 'BLOD001';
                });
                $bloodOptions = array_map(fn ($value) => ['value' => $value['value_score'], 'desc' => $value['value_desc']], $bloodUsage);
                ?>
            let bloodOptions = <?php echo json_encode($bloodOptions); ?>;

            if (typeof bloodOptions === 'object' && !Array.isArray(bloodOptions)) {
                bloodOptions = Object.keys(bloodOptions).map(key => bloodOptions[key]);
            }

            if (res.data.length > 0) {

                const table = $('#tableHistoryBlood').DataTable({
                    dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
                    stateSave: true,
                    "bDestroy": true
                });
                table.clear();

                let htmlContent = '';
                res.data.forEach((data, index) => {
                    htmlContent = `
                            <tr>
                                <td width="1%">${index + 1}</td>
                                <td width="100px;">
                                    <span class="blood-usage">
                                    ${bloodOptions.find(item => item.value === data?.blood_usage_type)?.desc || "-"}
                                    </span>
                                </td>
                                <td width="100px;">
                                    <span class="blood-type">
                                        ${data?.blood_type_id == 0 ? '-' : 
                                        data?.blood_type_id == 1 ? 'A' :
                                        data?.blood_type_id == 2 ? 'B' :
                                        data?.blood_type_id == 3 ? 'AB' :
                                        data?.blood_type_id == 4 ? 'O' :
                                        data?.blood_type_id == 5 ? '-' :
                                        data?.blood_type_id == 6 ? 'A+' :
                                        data?.blood_type_id == 7 ? 'B+' :
                                        data?.blood_type_id == 8 ? 'AB+' :
                                        data?.blood_type_id == 9 ? 'O+' : 'N/A'}
                                    </span>
                                </td>
                                <td width="1%">
                                    <span class="quantity-option">
                                        ${data?.blood_quantity ?? '0'}
                                    </span>
                                </td>
                                <td width="1%">
                                    <span class="measure-option">
                                        ${data?.measure_id == 1 ? 'cc' : (data?.measure_id == 56 ? 'kantong' : '')}
                                    </span>
                                </td>
                                <td width="200px;">
                                    <small>${moment(data?.request_date).format('DD/MM/YYYY HH:mm') ?? moment().format('DD/MM/YYYY HH:mm') ?? '-'}</small>
                                </td>
                                <td>
                                    <span>${data?.descriptions ?? ''}</span>
                                </td>
                            </tr>
                        `;
                    table.row.add($(htmlContent));
                });

                table.draw();
            } else {

            }
        }
    });
};

$('#tambah_permintaan_request').off().on('click', function(e) {
    let document_idBody = $("#no_sesi_booldRequesr").val();

    if (document_idBody == '%') {
        document_idBody = get_bodyid()
        $("#no_sesi_booldRequesr").append($("<option>").val(document_idBody).text(document_idBody))
        $("#no_sesi_booldRequesr").val(document_idBody)
        $("#tbodyPermintaanDarah").html("")
    }

    addPermintaanDarah({
        document_id: document_idBody,
        avalue: avalue,
        visit: visit,
        hb_last: dataBooldRequestHbLast

    });
})

$("#no_sesi_booldRequesr").on("change", function() {
    $('#tbodyPermintaanDarah').empty();
    let sendDocumentBooldRequest = []
    let resultChange = $(this).val()
    if (resultChange === "%") {
        sendDocumentBooldRequest = dataBooldRequest
    } else {
        sendDocumentBooldRequest = dataBooldRequest.filter(e => e?.document_id === resultChange)
    }
    sendDocumentBooldRequest.forEach((data, index) => {
        addPermintaanDarah({
            data: data,
            avalue: avalue,
            show: true,
            visit: visit,
            hb_last: dataBooldRequestHbLast
        })
    })


    // dataBooldRequest

});

const addPermintaanDarah = (props) => {
    let filterBolldOption = props?.avalue?.filter(e => e?.p_type === "BLOD001")

    let bloodOptions = filterBolldOption.map(e => ({
        value: e?.value_score,
        desc: e?.value_desc
    }));

    if (typeof bloodOptions === 'object' && !Array.isArray(bloodOptions)) {
        bloodOptions = Object.keys(bloodOptions)?.map(key => bloodOptions[key]);
    }

    const bloodOptionsHtml = bloodOptions?.map(option =>
        `<option value="${option.value}" ${option.value == props?.data?.blood_usage_type ? 'selected' : ''}>${option.desc}</option>`
    ).join('');

    let doctor = props?.data?.doctor || props?.visit?.fullname ||
        "";

    if (!dataDoctorBooldRequest?.some(option => option.fullname === doctor)) {
        dataDoctorBooldRequest.push({
            fullname: doctor
        });
    }

    const doctorOptionsHtml = dataDoctorBooldRequest?.map(option =>
        `<option value="${option.fullname}" ${option.fullname === doctor ? 'selected' : ''}>${option.fullname}</option>`
    ).join('');

    let container = $('#tbodyPermintaanDarah');
    let blood = `
            <tr>
                <input type="hidden" name="org_unit_code[]" value="<?= $visit['org_unit_code']; ?>">
                <input type="hidden" name="visit_id[]" value="<?= $visit['visit_id']; ?>">
                <input type="hidden" name="trans_id[]" value="<?= $visit['trans_id']; ?>">
                <input type="hidden" name="no_registration[]" value="<?= $visit['no_registration']; ?>">
                <input type="hidden" name="clinic_id[]" value="<?= $visit['clinic_id']; ?>">
                <input type="hidden" name="document_id[]" value="${props?.data?.document_id??props?.document_id}">
                <input type="hidden" name="request_date[]" value="${get_date()}">
                <input type="hidden" name="blood_request[]" value="${props?.data?.blood_request ?? get_bodyid()}">
                <td>
                    <select name="doctor[]" type="text" id='bloodrq-doctor-slct' data-id="${props?.data?.document_id ?? ""}" class="form-select bloodrq-doctor-slct" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                        ${doctorOptionsHtml}
                    </select>
                </td>
                <td>
                    <select name="blood_usage_type[]" type="text" class="form-select" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                        ${bloodOptionsHtml}
                    </select>
                </td>
                <td>
                    <input type="number" name="blood_quantity[]" class="form-control" value="${props?.data?.blood_quantity ?? 0}" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                </td>
                <td>
                    <select name="measure_id[]" type="text" class="form-select" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                        <option value="1" ${props?.data?.measure_id == 1 ? 'selected' : ''}>cc</option>
                        <option value="56" ${props?.data?.measure_id == 56 ? 'selected' : ''}>kantong</option>
                    </select>
                </td>
                <td>
                    <select name="blood_type_id[]" type="text" class="form-select" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                        <option value="0" ${props?.data?.blood_type_id == 0 ? 'selected' : ''}>-</option>
                        <option value="1" ${props?.data?.blood_type_id == 1 ? 'selected' : ''}>A</option>
                        <option value="2" ${props?.data?.blood_type_id == 2 ? 'selected' : ''}>B</option>
                        <option value="3" ${props?.data?.blood_type_id == 3 ? 'selected' : ''}>AB</option>
                        <option value="4" ${props?.data?.blood_type_id == 4 ? 'selected' : ''}>O</option>
                        <option value="5" ${props?.data?.blood_type_id == 5 ? 'selected' : ''}>-</option>
                        <option value="6" ${props?.data?.blood_type_id == 6 ? 'selected' : ''}>A+</option>
                        <option value="7" ${props?.data?.blood_type_id == 7 ? 'selected' : ''}>B+</option>
                        <option value="8" ${props?.data?.blood_type_id == 8 ? 'selected' : ''}>AB+</option>
                        <option value="9" ${props?.data?.blood_type_id == 9 ? 'selected' : ''}>O+</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="descriptions[]" class="form-control" value="${props?.data?.descriptions ?? ''}" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                </td>
                <td>
                    <input type="text" name="using_time[]" data-id="${props?.data?.document_id ?? ""}" class="form-control bg-white datepicker-darah darahusing-time" value="${moment(props?.data?.using_time).format('YYYY-MM-DD HH:mm') ?? moment().format('YYYY-MM-DD HH:mm')}" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                </td>
                
                ${props?.data?.terlayani == 1 ? `
                <td>
                    <input type="text" name="transfusion_start[]" class="form-control bg-white datepicker-darah" 
                    value="${moment(props?.data?.transfusion_start, 'YYYY-MM-DD HH:mm', true).isValid() 
                            ? moment(props?.data?.transfusion_start).format('YYYY-MM-DD HH:mm') 
                            : moment().format('YYYY-MM-DD HH:mm')}">
                </td>
                <td>
                    <input type="text" name="transfusion_end[]" class="form-control bg-white datepicker-darah" 
                    value="${moment(props?.data?.transfusion_end, 'YYYY-MM-DD HH:mm', true).isValid() 
                            ? moment(props?.data?.transfusion_end).format('YYYY-MM-DD HH:mm') 
                            : moment().format('YYYY-MM-DD HH:mm')}">
                </td>
                <td>
                    <input type="text" name="reaction_desc[]" class="form-control" value="${props?.data?.reaction_desc ?? ''}">
                </td>
                ` : 
                `
                    <td><input type="hidden" name="transfusion_start[]" value="${''}"></td>
                    <td><input type="hidden" name="transfusion_end[]" value="${''}"></td>
                    <td><input type="hidden" name="reaction_desc[]" value="${''}"></td>
                `}
                <td>
                    <div class="d-flex justify-content-between">
                    ${props?.show === true ? `<button type="button" class="btn btn-outline-primary btn-show-booldRequest" 
                                data-id="${props?.data?.blood_request ?? ''}" 
                                data-visit_id="${props?.data?.visit_id ?? ''}"
                                data-document_id="${props?.data?.document_id ?? ''}">
                            <i class="far fa-eye"></i>
                        </button>`:``}
                        <button type="button" class="btn btn-outline-danger btn-trash-booldRequest" 
                                data-id="${props?.data?.blood_request ?? ''}" 
                                data-visit_id="${props?.data?.visit_id ?? ''}">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>

                </td>
            </tr>
            `;

    $(container).append(blood);

    if (props?.data?.terlayani == 1) {
        $(container).find('input.hidden-header').closest('td').show();
        $('th.hidden-header[hidden]').removeAttr('hidden');
    } else {
        $(container).find('input.hidden-header').closest('td').hide();
        $('th.hidden-header[hidden]').attr('hidden', true);
    }

    flatpickr('.datepicker-darah', {
        dateFormat: 'Y-m-d H:i',
        enableTime: true,
        time_24hr: true,
        onChange: function(selectedDates, dateStr, instance) {
            console.log(selectedDates);
        }
    });

    $(container).find('button.btn-show-booldRequest').last().on('click', function(e) {
        e.preventDefault();
        let dataCheck = $(this).data("id")
        let dataVisit = $(this).data("visit_id")
        let dataDocument_id = $(this).data("document_id")
        renderLatterSendCheckBooldRequest({
            visit: visit,
            document_id: dataDocument_id,
            avalue: avalue,
            hb_last: dataBooldRequestHbLast
        })
        $("#bloodRequestModal").modal("show")

    });


    $("#cetak_boldReq_modal").on("click", function(e) {
        e.preventDefault();

        $(".hidden-show-ttd").removeAttr("hidden");

        let printContents = document.getElementById('bodybloodRequestModal').outerHTML;
        let printWindow = window.open('', '_blank', 'width=800,height=600');

        printWindow.document.write(`
    <html>
    <head>
        <title>Print Preview</title>
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
        <style>
           @page { 
                size: A4 portrait; 
                margin: 1mm 10mm 10mm 10mm; /* Persempit margin atas */
            }
            body { font-family: Arial, sans-serif; background-color: white; margin: 0; padding: 0; }
           .print-container {
                width: 100%;
                max-width: 190mm; /* Kurangi sedikit dari 210mm untuk memberi ruang */
                padding: 10mm;
                margin: auto;
                box-sizing: border-box;
            }

            /* Pastikan HB Terakhir tetap sejajar */
            .hb-container {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                flex-wrap: nowrap;
                gap: 15px;
            }
            .hb-container .col-md-6 {
                width: 50%;
                white-space: nowrap;
                text-align: left;
            }

            /* Tambahan untuk memastikan cetakan tetap rapi */
            .row {
                display: flex !important;
                flex-wrap: nowrap !important;
            }
            .col-md-6 {
                width: 50% !important;
                text-align: left !important;
            }

          
            @media print {
           .print-container { 
                    page-break-before: auto; 
                    width: 100%; 
                    max-width: 190mm; 
                    padding: 0; 
                    margin-top: 0; /* Hapus margin atas tambahan */
                }
                    table { page-break-inside: avoid; }
                .hb-container { display: flex; flex-wrap: nowrap; }
            .hidden-show-ttd { display: block !important; }
            }
        </style>
    </head>
    <body>
        <div class="print-container">
            ${printContents}
        </div>
    </body>
    </html>
    `);

        printWindow.document.close();

        printWindow.onload = function() {
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
                $(".hidden-show-ttd").attr("hidden", true);
            }, 500);
        };
    });









    $(container).find('button.btn-trash-booldRequest').last().on('click', function(e) {
        e.preventDefault();
        let dataCheck = $(this).data("id")
        let dataVisit = $(this).data("visit_id")
        if (!dataCheck || dataCheck.trim() === "") {
            $(this).closest('tr').remove();
            return;
        }
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
                    id: dataCheck,
                    visit_id: dataVisit,
                    no_registration: props?.data?.no_registration,
                    clinic_id: props?.data?.clinic_id,
                    avalue: props?.avalue
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

    $(document).on('change', '.bloodrq-doctor-slct', function() {
        let $select = $(this);
        let newDocumentId = $select.val();
        let currentDocumentId = $select.attr('data-id');

        $('select[data-id="' + currentDocumentId + '"]').each(function() {
            $(this).val(newDocumentId).attr('data-id', newDocumentId);
        });
    });

    $(document).on('change', '.darahusing-time', function() {
        let $select = $(this);
        let newDocumentId = $select.val();
        let currentDocumentId = $select.attr('data-id');

        $('input[data-id="' + currentDocumentId + '"]').each(function() {
            $(this).val(newDocumentId).attr('data-id', newDocumentId);
        });
    });

};


const deleteActionInf = (props) => {
    postData({
        id: String(props.id),
        visit_id: props.visit_id
    }, 'admin/BloodRequest/deleteData', (res) => {
        if (res.respon === true) {
            successSwal('Data berhasil Dihapus.');
            let visit_id = '<?php echo $visit['visit_id']; ?>';
            getDataFormPermintaanDarah({
                visit_id: props?.visit_id,
                no_registration: props?.no_registration,
                clinic_id: props?.clinic_id,
                avalue: props?.avalue
            })
        } else {
            errorSwal("Gagal Di hapus")
        }
    });
};


$('#btnSavePermintaanDarah').off().on('click', function(e) {
    let dataSend = $('#formPermintaanDarah')[0];
    let formData = new FormData(dataSend);

    let jsonObj = {
        blood: []
    };

    let blood_request = formData.getAll('blood_request[]');
    let blood_quantity = formData.getAll('blood_quantity[]');
    blood_quantity = blood_quantity.map(value => (value === "" ? 0 : value));
    if (blood_quantity.length === 0) {
        blood_quantity = [0];
    }
    let blood_type_id = formData.getAll('blood_type_id[]');
    let blood_usage_type = formData.getAll('blood_usage_type[]');
    let doctor = formData.getAll('doctor[]');
    let clinic_id = formData.getAll('clinic_id[]');
    let descriptions = formData.getAll('descriptions[]');
    let measure_id = formData.getAll('measure_id[]');
    let transfusion_start = formData.getAll('transfusion_start[]');
    let transfusion_end = formData.getAll('transfusion_end[]');
    let reaction_desc = formData.getAll('reaction_desc[]');
    let no_registration = formData.getAll('no_registration[]');
    let org_unit_code = formData.getAll('org_unit_code[]');
    let request_date = formData.getAll('request_date[]');
    let trans_id = formData.getAll('trans_id[]');
    let using_time = formData.getAll('using_time[]');
    let visit_id = formData.getAll('visit_id[]');
    let document_id = formData.getAll('document_id[]');

    for (let i = 0; i < measure_id.length; i++) {
        let entry = {
            blood_request: blood_request[i],
            blood_quantity: blood_quantity[i],
            blood_type_id: blood_type_id[i],
            blood_usage_type: blood_usage_type[i],
            doctor: doctor[i],
            clinic_id: clinic_id[i],
            descriptions: descriptions[i],
            measure_id: measure_id[i],
            transfusion_start: transfusion_start[i],
            transfusion_end: transfusion_end[i],
            reaction_desc: reaction_desc[i],
            no_registration: no_registration[i],
            org_unit_code: org_unit_code[i],
            request_date: request_date[i],
            trans_id: trans_id[i],
            using_time: using_time[i],
            visit_id: visit_id[i],
            document_id: document_id[i]
        };


        jsonObj.blood.push(entry);
    }
    // console.log(jsonObj);
    postData(jsonObj, 'admin/BloodRequest/insertData', (res) => {
        if (res.respon) {
            getDataFormPermintaanDarah({
                visit_id: visit.visit_id,
                no_registration: visit.no_registration,
                clinic_id: visit.clinic_id,
                avalue: avalue
            })
            getHistory({
                visit_id: visit.visit_id,
                no_registration: visit.no_registration,
                clinic_id: visit.clinic_id,
            })
            successSwal('Data berhasil Ditambahkan.');
        } else {
            errorSwall(res?.message)
        }
    });
});

const getDataAllBooldRequestApi = (props) => {
    getDataList('admin/BloodRequest/getDataAll', (res) => {
        // if (res && res.value) {
        dataDoctorBooldRequest = res?.value?.doctor || {}
        dataKopBooldRequest = res?.value?.kop || {}
        dataSpecialistBooldRequest = res?.value?.specialist || {}
        // }

        getBloodRequest({
            visit: props?.visit,
            avalue: props?.avalue
        });
    })
}


const renderLatterSendCheckBooldRequest = (props) => {

    $('.kop-name-boold_request').text(dataKopBooldRequest?.name_of_org_unit || '');
    $('.kop-address-boold_request').html(dataKopBooldRequest?.contact_address + ',' + dataKopBooldRequest?.phone +
        ', Fax:' + dataKopBooldRequest?.fax + ',' + dataKopBooldRequest
        ?.kota +
        '<br>' + dataKopBooldRequest?.sk
    );
    $("#rs-val2-booldRequest-latter").text(dataKopBooldRequest?.display)

    const filterBoolds = dataBooldRequest?.filter(e => e.document_id === props?.document_id) || [];
    const filterAvalue = props?.avalue?.filter(e => e?.p_type === "BLOD001") || [];

    const resultDataBoold = filterBoolds.map(e => {
        const match = filterAvalue.find(a => a.value_score === e.blood_usage_type);
        return match ? {
            valueDesc: match.value_desc,
            bloodQuantity: e.blood_quantity
        } : null;
    }).filter(Boolean);

    let resultdatabooldtype = ""
    let jumlahbooldKantong = 0
    resultDataBoold.forEach((item, index) => {
        let splitItem = item?.valueDesc.split(" - ");
        let leftPart = splitItem[0] || "";
        let rightPart = splitItem[1] || "";
        let bloodQuantity = parseFloat(item?.bloodQuantity ?? 0) || 0;
        resultdatabooldtype +=
            `<span>${index + 1}. </span><span class="left">${leftPart}</span> <span class="right">${rightPart}</span><br>`;

        jumlahbooldKantong += bloodQuantity

    });


    $("#databooldtype-val2-lab-latter").html(resultdatabooldtype);
    $("#jmlh-val2-booldRequest-latter").html(jumlahbooldKantong);


    let specialBloodRq = dataSpecialistBooldRequest.filter(e => e?.specialist_type_id === props?.visit
        ?.specialist_type_id)
    $("#dpjpspecial-val2-booldRequest-latter").text(specialBloodRq[0]?.specialist_type)


    if (props?.data) {
        if (props?.data?.modified_by === '<?= user()->username;?>') {
            $("#save-form-rad-cover-latter").show();
        } else {
            $("#save-form-rad-cover-latter").hide();
        }
    } else {
        $("#save-form-rad-cover-latter").show();
    }

    let result = props?.data
    let resultTemplate = props?.visit
    let nameValueVisit2 = [
        'diantar_oleh', 'age', 'no_registration',
        'visitor_address', 'gendername', 'name_of_class_room',
        'name_of_class', 'fullname',
    ];

    nameValueVisit2?.forEach(name => {
        let id = `${name}-val2-booldRequest-latter`;
        let value = resultTemplate?. [name];
        if (value !== undefined) {
            $(`#${id}`).text(value);
        }
    });

    $("#tgl_lahir-val2-booldRequest-latter").text(moment(resultTemplate?.tgl_lahir).format("DD/MM/YYYY"))

    let nameValueHidden = [
        'visit_id', 'trans_id', "no_registration", "employee_id",
        "patient_category_id", "isrj", "ageyear", "agemonth", "ageday", "status_pasien_id", "gender",
        "class_room_id", "bed_id", "keluar_id",
    ];

    nameValueHidden?.forEach(name => {
        let id = `${name}-rad-val-rad-latter`;
        let value = result?. [name] ?? resultTemplate?. [name];
        if (value !== undefined) {
            $(`#${id}`).val(value);
        }
    });


    $("#qrcode-darah-conver-dokter").empty();
    var qrcode = new QRCode(document.getElementById("qrcode-darah-conver-dokter"), {
        text: `${resultTemplate?.fullname || ""}`, // Your text here
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });

    $("#validator-darah-ttd").text(resultTemplate?.fullname)



    flatpickr('#treat_date-rad-val-rad-latter', {
        dateFormat: 'd/m/Y H:i',
        enableTime: true,
        time_24hr: true,
        onChange: function(selectedDates, dateStr, instance) {
            // console.log(selectedDates);
        }
    });


    if (props?.hb_last) {
        $('#hb_last-val2-booldRequest-latter').text(`${props.hb_last.satuan}`);

    } else {
        $('#hb_last-val2-booldRequest-latter').empty(); // Kosongkan jika tidak ada data
    }
    // new

    $('#fullname-val2-booldRequest-latter').text(filterBoolds[0]?.doctor)
    $('#diagnosa_desc-val2-booldRequest-latter').text(filterBoolds[0]?.descriptions)
    $('#using_time-val2-booldRequest-latter').text(filterBoolds[0]?.using_time ? moment(filterBoolds[0]
        ?.using_time).format("DD/MM/YYYY HH:mm") : "")
    $("#treat_date-rad-val-rad-latter").prop("readonly", false)

}
</script>