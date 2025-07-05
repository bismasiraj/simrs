<div class="tab-pane fade" id="dummy-blood-request">
    <div class="row">
        <div class="col-12">
            <div class="box-tab-tools text-center mb-3">
                <button type="button" class="btn btn-primary btn-lg" id="tambah_permintaan_request2"
                    style="width: 300px"><i class=" fa fa-plus"></i> Tambah Permintaan Darah</button>
            </div>
            <form action="" method="post" id="formPermintaanDarah2">
                <table class="table table-bordered">
                    <thead>
                        <th class="text-center" style="width: 12%">Jenis Darah</th>
                        <th class="text-center" style="width: 5%">Jumlah</th>
                        <th class="text-center" style="width: 10%">Satuan Ukuran</th>
                        <th class="text-center" style="width: 9%">Golongan Darah</th>
                        <th class="text-center" style="width: 23%">Diagnosa Sementara</th>
                        <th class="text-center" style="width: 10%">Waktu Penggunaan</th>
                        <th class="text-center" style="width: 10%">Transfusion Start</th>
                        <th class="text-center" style="width: 10%">Transfusion End</th>
                        <th class="text-center" style="width: 10%">Reaction Desc</th>
                        <th class="text-center" style="width: 1%"><i class="fa fa-trash"></i></th>
                    </thead>
                    <tbody id="tbodyPermintaanDarah2">

                    </tbody>
                </table>
                <div class="col-12 my-3 d-flex justify-content-end gap-2">
                    <button type="button" id="btn-print-dummy-blood-request" class="btn btn-success">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                    <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>
                    <button type="submit" id="btn-save-dummy-blood-request2" class="btn btn-primary"><i
                            class="fas fa-save"></i> Simpan</button>

                    <?php } ?>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
$('#tambah_permintaan_request2').off().on('click', function(e) {
    addPermintaanDarah();
})

const addPermintaanDarah = (props) => {
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

    const bloodOptionsHtml = bloodOptions.map(option =>
        `<option value="${option.value}" ${option.value == props?.data.blood_usage_type ? 'selected' : ''}>${option.desc}</option>`
    ).join('');

    let container = $('#tbodyPermintaanDarah2');
    let blood = `
            <tr>
                <input type="hidden" name="bloodorg_unit_code[]" value="<?= $visit['org_unit_code']; ?>">
                <input type="hidden" name="bloodvisit_id[]" value="<?= $visit['visit_id']; ?>">
                <input type="hidden" name="bloodtrans_id[]" value="<?= $visit['trans_id']; ?>">
                <input type="hidden" name="bloodno_registration[]" value="<?= $visit['no_registration']; ?>">
                <input type="hidden" name="bloodclinic_id[]" value="<?= $visit['clinic_id']; ?>">
                <input type="hidden" name="bloodrequest_date[]" value="${get_date()}">
                <input type="hidden" name="bloodblood_request[]" value="${props?.data.blood_request ?? get_bodyid()}">

                <td>
                    <select name="bloodblood_usage_type[]" type="text" class="form-select" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                        ${bloodOptionsHtml}
                    </select>
                </td>
                <td>
                    <input type="number" name="bloodblood_quantity[]" class="form-control" value="${props?.data.blood_quantity}" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                </td>
                <td>
                    <select name="bloodmeasure_id[]" type="text" class="form-select" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                        <option value="1" ${props?.data.measure_id == 1 ? 'selected' : ''}>cc</option>
                        <option value="56" ${props?.data.measure_id == 56 ? 'selected' : ''}>kantong</option>
                    </select>
                </td>
                <td>
                    <select name="bloodblood_type_id[]" type="text" class="form-select" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                        <option value="0" ${props?.data.blood_type_id == 0 ? 'selected' : ''}>-</option>
                        <option value="1" ${props?.data.blood_type_id == 1 ? 'selected' : ''}>A</option>
                        <option value="2" ${props?.data.blood_type_id == 2 ? 'selected' : ''}>B</option>
                        <option value="3" ${props?.data.blood_type_id == 3 ? 'selected' : ''}>AB</option>
                        <option value="4" ${props?.data.blood_type_id == 4 ? 'selected' : ''}>O</option>
                        <option value="5" ${props?.data.blood_type_id == 5 ? 'selected' : ''}>-</option>
                        <option value="6" ${props?.data.blood_type_id == 6 ? 'selected' : ''}>A+</option>
                        <option value="7" ${props?.data.blood_type_id == 7 ? 'selected' : ''}>B+</option>
                        <option value="8" ${props?.data.blood_type_id == 8 ? 'selected' : ''}>AB+</option>
                        <option value="9" ${props?.data.blood_type_id == 9 ? 'selected' : ''}>O+</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="blooddescriptions[]" class="form-control" value="${props?.data.descriptions ?? ''}" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                </td>
                <td>
                    <input type="text" name="bloodusing_time[]" class="form-control bg-white datepicker-darah" value="${moment(props?.data.using_time).format('YYYY-MM-DD HH:mm') ?? moment().format('YYYY-MM-DD HH:mm')}" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                </td>
                
                ${props?.data?.terlayani == 1 ? `
                <td>
                    <input type="text" name="bloodtransfusion_start[]" class="form-control bg-white datepicker-darah" 
                    value="${moment(props?.data.transfusion_start, 'YYYY-MM-DD HH:mm', true).isValid() 
                            ? moment(props?.data.transfusion_start).format('YYYY-MM-DD HH:mm') 
                            : moment().format('YYYY-MM-DD HH:mm')}">
                </td>
                <td>
                    <input type="text" name="bloodtransfusion_end[]" class="form-control bg-white datepicker-darah" 
                    value="${moment(props?.data.transfusion_end, 'YYYY-MM-DD HH:mm', true).isValid() 
                            ? moment(props?.data.transfusion_end).format('YYYY-MM-DD HH:mm') 
                            : moment().format('YYYY-MM-DD HH:mm')}">
                </td>
                <td>
                    <input type="text" name="bloodreaction_desc[]" class="form-control" value="${props?.data.reaction_desc ?? ''}">
                </td>
                ` : 
                `
                <td><input type="hidden" name="bloodtransfusion_start[]" value="${''}"></td>
                <td><input type="hidden" name="bloodtransfusion_end[]" value="${''}"></td>
                <td><input type="hidden" name="bloodreaction_desc[]" value="${''}"></td>
                `}
                <td>
                    <a href="#" class="btn closebtn btn-trash">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
                
            </tr>
            `;

    $(container).append(blood);

    // Toggle visibility based on 'terlayani' value
    if (props?.data?.terlayani == 1) {
        $(container).find('input.hidden-header').closest('td').show(); // Show hidden-header fields
        $('th.hidden-header[hidden]').removeAttr('hidden'); // Make them visible
    } else {
        $(container).find('input.hidden-header').closest('td').hide(); // Hide hidden-header fields
        $('th.hidden-header[hidden]').attr('hidden', true);
    }

    flatpickr('.datepicker-darah', {
        dateFormat: 'Y-m-d H:i',
        enableTime: true,
        time_24hr: true,
        onChange: function(selectedDates, dateStr, instance) {}
    });
    $(container).find('a.btn-trash').last().on('click', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    });
};
// $('#btn-save-dummy-blood-request2').off().on('click', function(e) {
//     let dataSend = $('#formPermintaanDarah2')[0];
//     let formData = new FormData(dataSend);

//     let jsonObj = {
//         blood: []
//     };

//     let blood_request = formData.getAll('bloodblood_request[]');
//     let blood_quantity = formData.getAll('bloodblood_quantity[]');
//     let blood_type_id = formData.getAll('bloodblood_type_id[]');
//     let blood_usage_type = formData.getAll('bloodblood_usage_type[]');
//     let clinic_id = formData.getAll('bloodclinic_id[]');
//     let descriptions = formData.getAll('blooddescriptions[]');
//     let measure_id = formData.getAll('bloodmeasure_id[]');
//     let transfusion_start = formData.getAll('bloodtransfusion_start[]');
//     let transfusion_end = formData.getAll('bloodtransfusion_end[]');
//     let reaction_desc = formData.getAll('bloodreaction_desc[]');
//     let no_registration = formData.getAll('bloodno_registration[]');
//     let org_unit_code = formData.getAll('bloodorg_unit_code[]');
//     let request_date = formData.getAll('bloodrequest_date[]');
//     let trans_id = formData.getAll('bloodtrans_id[]');
//     let using_time = formData.getAll('bloodusing_time[]');
//     let visit_id = formData.getAll('bloodvisit_id[]');

//     for (let i = 0; i < measure_id.length; i++) {
//         let entry = {
//             blood_request: blood_request[i],
//             blood_quantity: blood_quantity[i],
//             blood_type_id: blood_type_id[i],
//             blood_usage_type: blood_usage_type[i],
//             clinic_id: clinic_id[i],
//             descriptions: descriptions[i],
//             measure_id: measure_id[i],
//             transfusion_start: transfusion_start[i],
//             transfusion_end: transfusion_end[i],
//             reaction_desc: reaction_desc[i],
//             no_registration: no_registration[i],
//             org_unit_code: org_unit_code[i],
//             request_date: request_date[i],
//             trans_id: trans_id[i],
//             using_time: using_time[i],
//             visit_id: visit_id[i]
//         };


//         jsonObj.blood.push(entry);
//     }
//     console.log(jsonObj);
//     // postData(jsonObj, 'admin/BloodRequest/insertData', (res) => {
//     //     if (res.respon) {
//     //         getDataFormPermintaanDarah({
//     //             visit_id: res?.data[0].visit_id,
//     //             no_registration: res?.data[0].no_registration,
//     //             clinic_id: res?.data[0].clinic_id,
//     //         })
//     //         getHistory({
//     //             visit_id: res?.data[0].visit_id,
//     //             no_registration: res?.data[0].no_registration,
//     //             clinic_id: res?.data[0].clinic_id,
//     //         })
//     //         successSwal('Data berhasil Ditambahkan.');
//     //     } else {
//     //         errorSwall(res?.message)
//     //     }
//     // });
// });
// $('#btn-save-dummy-blood-request2').off().on('click', function(e) {
//     e.preventDefault(); // Prevent the default button behavior

//     // Get the form element
//     const form = $("#formPermintaanDarah2")[0];
//     console.log(form);
//     // Disable the submit button to prevent multiple clicks
//     const clicked_submit_btn = $(this);

//     // Perform AJAX form submission
//     $.ajax({
//         url: '<?php echo base_url(); ?>admin/PatientOperationRequest/savePraOperasi',
//         type: "POST",
//         data: new FormData(form), // Use the form element
//         dataType: 'json',
//         contentType: false,
//         cache: false,
//         processData: false,
//         beforeSend: () => {
//             // You can show a loading spinner or disable the button if needed
//         },
//         success: data => {
//             if (data.status === "fail") {
//                 const message = data.error.join(' ');
//                 errorSwal('Data tidak ditemukan.');
//             } else {
//                 successSwal('Data berhasil disimpan.');
//                 disablePraOperasi();
//             }
//             clicked_submit_btn.prop('disabled', false); // Re-enable the submit button
//         },
//         error: () => {
//             errorSwal('Error occurred. Please try again.');
//             clicked_submit_btn.prop('disabled', false); // Re-enable the submit button in case of error
//         }
//     });
// });
$("#formPermintaanDarah2").on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission
    // const clicked_submit_btn = $(this).find(':submit'); // Refers to the submit button

    $.ajax({
        url: '<?php echo base_url(); ?>admin/PatientOperationRequest/savePraOperasiDummy',
        type: "POST",
        data: new FormData(this), // Simplified reference
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: () => {},
        success: data => {
            if (data.status === "fail") {
                const message = data.error.join(' ');
                errorSwal('Data tidak ditemukan.');
            } else {
                successSwal('Data berhasil disimpan.');
                disablePraOperasi();
            }
            clicked_submit_btn.button('reset');
        },
        error: () => errorSwal('Error occurred. Please try again.')
    });
});
</script>