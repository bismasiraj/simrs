<div class="tab-pane fade " id="laporan-pembedahan">
    <form action="" id="form-laporan-pembedahan">
        <div id="accordionCatatan" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree1" aria-expanded="false"
                        aria-controls="flush-collapseThree">
                        LAPORAN PEMBEDAHAN
                    </button>
                </h2>
                <div id="flush-collapseThree1" class="accordion-collapse collapse" aria-labelledby="flush-headingThree1"
                    data-bs-parent="#accordionCatatan">
                    <div class="accordion-body" id="pembedahan-laporan">

                    </div>
                </div>
            </div>

            <!-- <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThreess">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThreess" aria-expanded="false"
                        aria-controls="flush-collapseThreess">
                        CATATAN KEPERAWATAN INTRA OPERATIF
                    </button>
                </h2>
                <div id="flush-collapseThreess" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingThreess" data-bs-parent="#accordionCatatan">
                    <div class="accordion-body" id="cKeperawatanIntraOperatif">

                    </div>
                </div>
            </div> -->

            <!-- <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThrees">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThrees" aria-expanded="false"
                        aria-controls="flush-collapseThrees">
                        CATATAN KEPERAWATAN PASCA OPERASI
                    </button>
                </h2>
                <div id="flush-collapseThrees" class="accordion-collapse collapse" aria-labelledby="flush-headingThrees"
                    data-bs-parent="#accordionCatatan">
                    <div class="accordion-body" id="cKeperawatanPascaOperatif">

                    </div>
                </div>
            </div> -->
        </div>
        <div class="col-12 my-3 d-flex justify-content-end gap-2">
            <button type="button" id="btn-save-laporan-pembedahan"
                class="btn btn-primary btn-save-operasi">Simpan</button>
        </div>
    </form>
</div>

<script>
// $('#btn-save-catatan-keperawatan').on('click', function(e) {
//     // Code to handle click event

//     e.preventDefault();
//     tinymce.triggerSave();

//     let formElement = $('#form-catatan-keperawatan')[0];
//     let dataSend = new FormData(formElement);
//     let jsonObj = {};
//     dataSend.forEach((value, key) => {
//         jsonObj[key] = value;
//     });
//     postData(jsonObj, 'admin/PatientOperationRequest/insertDataPraOprasi', (res) => {
//         if (res.respon === true) {
//             successSwal('Data berhasil disimpan.');
//             $('#form-catatan-keperawatan')[0].reset();
//             let visit_id = '<?php echo $visit['visit_id']; ?>';
//             tinymce.remove();
//             // getDataTables({
//             //     visit_id: visit_id
//             // });
//         }
//     });

// });
</script>