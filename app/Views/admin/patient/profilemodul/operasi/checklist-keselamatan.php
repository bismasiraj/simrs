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
            <button type="button" id="btn-print-checklist-keselamatan" class="btn btn-success">
                <i class="fas fa-print"></i> Cetak
            </button>
            <button type="button" id="btn-save-checklist-keselamatan" class="btn btn-primary btn-save-operasi">Simpan</button>
        </div>
    </form>
</div>

<script>
    $('#btn-save-checklist-keselamatan').on('click', function(e) {

        e.preventDefault();

        let formElement = $('#form-checklist-keselamatan')[0];
        let dataSend = new FormData(formElement);

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


        delete jsonObj['body_id[]']


        postData(jsonObj, 'admin/PatientOperationRequest/insertChecklistKeselamatan', (res) => {
            if (res.respon) {
                successSwal('Data berhasil disimpan.');
            } else {
                errorSwal('Data gagal disimpan.')
            }
        });
    });
</script>