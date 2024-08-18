<div class="tab-pane fade" id="checklist-keselamatan">
    <form action="" id="form-checklist-keselamatan">
        <input type="hidden" name="org_unit_code" id="org_unit_code_checklist_keselamatan" value="<?= $visit['org_unit_code'] ?>">
        <input type="hidden" name="visit_id" id="visit_id_checklist_keselamatan" value="<?= $visit['visit_id'] ?>">
        <input type="hidden" name="trans_id" id="trans_id_checklist_keselamatan" value="<?= $visit['trans_id'] ?>">
        <input type="hidden" name="document_id" id="document_id_checklist_keselamatan">
        <input type="hidden" name="body_id" id="body_id_checklist_keselamatan">
        <input type="hidden" name="examination_date" id="examination_date_checklist_keselamatan">
        <input type="hidden" name="modified_date" id="modified_date_checklist_keselamatan">
        <input type="hidden" name="modified_by" id="modified_by_checklist_keselamatan" value="<?= user()->username; ?>">


        <div id="accordionChecklist" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        The Sign In
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionChecklist">
                    <div class="accordion-body" id="the-sign-in">

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                        The Time Out
                    </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionChecklist">
                    <div class="accordion-body" id="the-time-out">

                    </div>
                    <div class="container" id="container-instrumen">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Alat</th>
                                        <th width="100px">Jumlah Sebelum</th>
                                        <th width="1%" class="text-center"><i class="fas fa-trash-alt"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="body-instrumen">

                                </tbody>
                            </table>
                            <div class="box-tab-tools my-3" style="text-align: center;">
                                <button type="button" id="addInstrumen" name="addInstrumen" data-body="body-instrumen" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><span>Tambah</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                        The Sign Out
                    </button>
                </h2>
                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionChecklist">
                    <div class="container mt-3">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center align-middle" rowspan="2" width="1%">No</th>
                                        <th class="text-center align-middle" rowspan="2">Nama Alat</th>
                                        <th class="text-center" colspan="4">Jumlah</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" width="100px">Sebelum</th>
                                        <th class="text-center" width="100px">Intra</th>
                                        <th class="text-center" width="100px">Tambahan</th>
                                        <th class="text-center" width="100px">Pasca</th>
                                    </tr>
                                </thead>
                                <tbody id="get-data-instrumen">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="accordion-body" id="the-sign-out">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-3 d-flex justify-content-end gap-2">
            <button type="button" id="btn-save-checklist-keselamatan" class="btn btn-primary btn-save-operasi">Simpan</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#addInstrumen').click(function() {
        addRowInstrumen();
    });


    $('#btn-save-checklist-keselamatan').on('click', function(e) {

        e.preventDefault();
        tinymce.triggerSave();

        let formElement = $('#form-checklist-keselamatan')[0];
        let dataSend = new FormData(formElement);

        let brand_name = dataSend.getAll(`brand_name[]`);
        let quantity_before = dataSend.getAll(`quantity_before[]`);
        let quantity_intra = dataSend.getAll(`quantity_intra[]`);
        let quantity_additional = dataSend.getAll(`quantity_additional[]`);
        let quantity_after = dataSend.getAll(`quantity_after[]`);
        let body_id = dataSend.getAll(`body_id[]`);
        let jsonObj = {
            instrumen: []
        };
        if (checkKeselamatanBodyID == '' || checkKeselamatanBodyID == 'undefined') {
            checkKeselamatanBodyID = get_bodyid();
        }

        dataSend.forEach((value, key) => {
            jsonObj[key] = value;
        });
        jsonObj['body_id'] = checkKeselamatanBodyID;

        if (genBodyID == '' || genBodyID == 'undefined') {
            genBodyID = get_bodyid();
        }


        // Iterate through arrays and create entries
        for (let i = 0; i < brand_name.length; i++) {
            let entry = {
                brand_id: brand_name[i],
                brand_name: $('select[name="brand_name[]"] option:selected').eq(i).text(),
                quantity_before: quantity_before[i],
                quantity_intra: quantity_intra[i],
                quantity_additional: quantity_additional[i],
                quantity_after: quantity_after[i],
                body_id: genBodyID,
            };

            jsonObj.instrumen.push(entry);
        }
        delete jsonObj['brand_name[]']
        delete jsonObj['quantity_before[]']
        delete jsonObj['quantity_intra[]']
        delete jsonObj['quantity_additional[]']
        delete jsonObj['quantity_after[]']
        delete jsonObj['body_id[]']

        postData(jsonObj, 'admin/PatientOperationRequest/insertChecklistKeselamatan', (res) => {
            if (res.respon === true) {
                successSwal('Data berhasil disimpan.');
                $('#form-checklist-keselamatan')[0].reset();
                tinymce.remove();
            }
        });
    });

    const addRowInstrumen = (props) => {
        // Create HTML for new row
        var newRow = `
            <tr>
                <td>
                    <select class="form-control" name="brand_name[]">
                        <option data-nama="Alat 1" value="1" ${props?.brand_id == 1 ? 'selected' : '' }>Alat 1</option>
                        <option data-nama="Alat 2" value="2" ${props?.brand_id == 2 ? 'selected' : '' }>Alat 2</option>
                        <option data-nama="Alat 3" value="3" ${props?.brand_id == 3 ? 'selected' : '' }>Alat 3</option>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="body_id[]" value="${props?.body_id}" />
                    <input type="hidden" name="quantity_intra[]" value="${props?.quantity_intra}" />
                    <input type="hidden" name="quantity_additional[]" value="${props?.quantity_additional}" />
                    <input type="hidden" name="quantity_after[]" value="${props?.quantity_after}" />
                    <input type="number" class="form-control" name="quantity_before[]" value="${props?.quantity_before}">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm delete-row"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
        `;

        // Append the new row to the tbody
        $('#body-instrumen').append(newRow);

        // Attach click event handler for delete button in the new row
        $('.delete-row').click(function() {
            $(this).closest('tr').remove();
        });
    }
</script>