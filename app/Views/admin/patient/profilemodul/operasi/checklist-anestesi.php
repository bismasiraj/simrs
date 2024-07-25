<div class="tab-pane fade" id="checklist-anestesi">
    <form action="" id="form-checklist-anestesi">
        <input type="hidden" name="org_unit_code" id="org_unit_code_checklist_anestesi"
            value="<?= $visit['org_unit_code'] ?>">
        <input type="hidden" name="visit_id" id="visit_id_checklist_anestesi" value="<?= $visit['visit_id'] ?>">
        <input type="hidden" name="trans_id" id="trans_id_checklist_anestesi" value="<?= $visit['trans_id'] ?>">
        <input type="hidden" name="body_id" id="body_id_checklist_anestesi">
        <div id="accordionChecklistAnestesi" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                        Checklist Anestesi
                    </button>
                </h2>
                <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven"
                    data-bs-parent="#accordionChecklistAnestesi">
                    <div class="accordion-body" id="ck-anestesi">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-3 d-flex justify-content-end gap-2">
            <button type="button" id="btn-save-checklist-anestesi"
                class="btn btn-primary btn-save-operasi">Simpan</button>
        </div>
    </form>
</div>

<script>
$('#btn-save-checklist-anestesi').on('click', function(e) {


    e.preventDefault();
    tinymce.triggerSave();

    let formElement = $('#form-checklist-anestesi')[0];
    let dataSend = new FormData(formElement);
    let jsonObj = {};
    dataSend.forEach((value, key) => {
        jsonObj[key] = value;
    });
    postData(jsonObj, 'admin/PatientOperationRequest/insertChecklistanestesi', (res) => {
        if (res.respon === true) {
            successSwal('Data berhasil disimpan.');
            $('#form-checklist-anestesi')[0].reset();
            let visit_id = '<?php echo $visit['visit_id']; ?>';
            tinymce.remove();

        }
    });
});
</script>