<script src="<?php echo base_url(); ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#PermintaanDarahTab').off().on('click', function(e) {
            getBloodRequest();
        })
    });

    const getBloodRequest = (props) => {
        let visit_id = <?= json_encode($visit['visit_id']); ?>;
        let no_registration = <?= json_encode($visit['no_registration']); ?>;
        let clinic_id = <?= json_encode($visit['clinic_id']); ?>;

        getDataFormPermintaanDarah({
            visit_id: visit_id,
            no_registration: no_registration,
            clinic_id: clinic_id,
        })
        getHistory({
            visit_id: visit_id,
            no_registration: no_registration,
            clinic_id: clinic_id,
        })

    }

    const getDataFormPermintaanDarah = (props) => {
        $('#tbodyPermintaanDarah').empty();
        postData({
            visit_id: props?.visit_id,
            no_registration: props?.no_registration,
            clinic_id: props?.clinic_id,
        }, 'admin/BloodRequest/getData', (res) => {
            if (res.respon) {
                if (res.data.length > 0) {

                    res.data.forEach((data, index) => {
                        addPermintaanDarah({
                            data: data
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

        let container = $('#tbodyPermintaanDarah');
        let blood = `
            <tr>
                <input type="hidden" name="org_unit_code[]" value="<?= $visit['org_unit_code']; ?>">
                <input type="hidden" name="visit_id[]" value="<?= $visit['visit_id']; ?>">
                <input type="hidden" name="trans_id[]" value="<?= $visit['trans_id']; ?>">
                <input type="hidden" name="no_registration[]" value="<?= $visit['no_registration']; ?>">
                <input type="hidden" name="clinic_id[]" value="<?= $visit['clinic_id']; ?>">
                <input type="hidden" name="request_date[]" value="${get_date()}">
                <input type="hidden" name="blood_request[]" value="${props?.data.blood_request ?? ''}">

                <td>
                    <select name="blood_usage_type[]" type="text" class="form-select" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                        ${bloodOptionsHtml}
                    </select>
                </td>
                <td>
                    <input type="number" name="blood_quantity[]" class="form-control" value="${props?.data.blood_quantity}" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                </td>
                <td>
                    <select name="measure_id[]" type="text" class="form-select" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                        <option value="1" ${props?.data.measure_id == 1 ? 'selected' : ''}>cc</option>
                        <option value="56" ${props?.data.measure_id == 56 ? 'selected' : ''}>kantong</option>
                    </select>
                </td>
                <td>
                    <select name="blood_type_id[]" type="text" class="form-select" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
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
                    <input type="text" name="descriptions[]" class="form-control" value="${props?.data.descriptions ?? ''}" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                </td>
                <td>
                    <input type="text" name="using_time[]" class="form-control bg-white datepicker-darah" value="${moment(props?.data.using_time).format('YYYY-MM-DD HH:mm') ?? moment().format('YYYY-MM-DD HH:mm')}" ${props?.data?.terlayani == 1 ? 'readonly' : ''}>
                </td>
                
                ${props?.data?.terlayani == 1 ? `
                <td>
                    <input type="text" name="transfusion_start[]" class="form-control bg-white datepicker-darah" 
                    value="${moment(props?.data.transfusion_start, 'YYYY-MM-DD HH:mm', true).isValid() 
                            ? moment(props?.data.transfusion_start).format('YYYY-MM-DD HH:mm') 
                            : moment().format('YYYY-MM-DD HH:mm')}">
                </td>
                <td>
                    <input type="text" name="transfusion_end[]" class="form-control bg-white datepicker-darah" 
                    value="${moment(props?.data.transfusion_end, 'YYYY-MM-DD HH:mm', true).isValid() 
                            ? moment(props?.data.transfusion_end).format('YYYY-MM-DD HH:mm') 
                            : moment().format('YYYY-MM-DD HH:mm')}">
                </td>
                <td>
                    <input type="text" name="reaction_desc[]" class="form-control" value="${props?.data.reaction_desc ?? ''}">
                </td>
                ` : 
                `
                <td><input type="hidden" name="transfusion_start[]" value="${''}"></td>
                <td><input type="hidden" name="transfusion_end[]" value="${''}"></td>
                <td><input type="hidden" name="reaction_desc[]" value="${''}"></td>
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
            onChange: function(selectedDates, dateStr, instance) {
                console.log(selectedDates);
            }
        });
        $(container).find('a.btn-trash').last().on('click', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
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
        let blood_type_id = formData.getAll('blood_type_id[]');
        let blood_usage_type = formData.getAll('blood_usage_type[]');
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

        for (let i = 0; i < measure_id.length; i++) {
            let entry = {
                blood_request: blood_request[i],
                blood_quantity: blood_quantity[i],
                blood_type_id: blood_type_id[i],
                blood_usage_type: blood_usage_type[i],
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
                visit_id: visit_id[i]
            };


            jsonObj.blood.push(entry);
        }
        // console.log(jsonObj);
        postData(jsonObj, 'admin/BloodRequest/insertData', (res) => {
            if (res.respon) {
                getDataFormPermintaanDarah({
                    visit_id: res?.data[0].visit_id,
                    no_registration: res?.data[0].no_registration,
                    clinic_id: res?.data[0].clinic_id,
                })
                getHistory({
                    visit_id: res?.data[0].visit_id,
                    no_registration: res?.data[0].no_registration,
                    clinic_id: res?.data[0].clinic_id,
                })
                successSwal('Data berhasil Ditambahkan.');
            } else {
                errorSwall(res?.message)
            }
        });
    });
</script>