<div class="tab-pane fade" id="informasi-post-operasi">
    <form action="" id="form-informasi-post-operasi">
        <input type="hidden" name="org_unit_code" id="org_unit_code_informasi-post-operasi"
            value="<?= $visit['org_unit_code'] ?>">
        <input type="hidden" name="visit_id" id="visit_id_informasi-post-operasi" value="<?= $visit['visit_id'] ?>">
        <input type="hidden" name="trans_id" id="trans_id_informasi-post-operasi" value="<?= $visit['trans_id'] ?>">
        <input type="hidden" name="document_id" id="document_id_informasi-post-operasi">
        <div id="accordionInformasiMedis" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading-informasi-medis">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse-informasi-medis" aria-expanded="false"
                        aria-controls="flush-collapse-informasi-medis">
                        Informasi Medis
                    </button>
                </h2>
                <div id="flush-collapse-informasi-medis" class="accordion-collapse collapse"
                    aria-labelledby="flush-heading-informasi-medis" data-bs-parent="#accordionInformasiMedis">
                    <div class="accordion-body" id="ck-informasi-post-operasi">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-3 d-flex justify-content-end gap-2">
            <button type="button" id="btn-save-informasi-post-operasi"
                class="btn btn-primary btn-save-operasi">Simpan</button>
        </div>
    </form>
</div>

<script>
$('#btn-save-informasi-post-operasi').on('click', function(e) {


    e.preventDefault();
    tinymce.triggerSave();

    let formElement = $('#form-informasi-post-operasi')[0];
    let dataSend = new FormData(formElement);
    let jsonObj = {};
    if (informasiPostOperasiBodyID == '' || informasiPostOperasiBodyID == 'undefined') {
        informasiPostOperasiBodyID = get_bodyid();
    }
    dataSend.forEach((value, key) => {
        jsonObj[key] = value;
    });
    jsonObj['body_id'] = informasiPostOperasiBodyID;
    console.log(jsonObj);
    postData(jsonObj, 'admin/PatientOperationRequest/insertAssessmentPostOperasi', (res) => {
        if (res.respon === true) {
            successSwal('Data berhasil disimpan.');
            $('#form-informasi-post-operasi')[0].reset();
            let visit_id = '<?php echo $visit['visit_id']; ?>';
            tinymce.remove();

        }
    });
});
</script>