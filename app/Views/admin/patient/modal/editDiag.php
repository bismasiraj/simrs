<div class="modal fade" id="editDiagModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Diagnosa</h4>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group"><label for="diag_awal">Diagnosis</label>
                            <div class="p-2 select2-full-width">
                                <select class="form-control patient_list_ajax" id="editdiagnosa">
                                </select>
                            </div>
                        </div>
                    </div>
                </div><!--./row-->
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" id="editdiagbtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var rowEdit;
    $("#editdiagbtn").on("click", function() {
        var diag_id = $("#editdiagnosa").val()
        var diag_name = $("#editdiagnosa").text().trim()

        changeRowDiag(diag_id, diag_name, rowEdit)

        resetDiagModal()

        $('#editDiagModal').modal('hide')
    })

    function editRowDiag(row) {
        var diag_id = $("#diag_id" + row).val()
        var diag_name = $("#diag_name" + row).text().trim()
        rowEdit = row

        // alert(diag_suffer)

        $("#editdiagnosa").val(diag_id).text(diag_name)

        holdModal('editDiagModal')
    }

    function changeRowDiag(diag_id, diag_name, row) {
        $("#diag_id" + row).val(diag_id)
        $("#diag_name" + row).val(diag_name)
    }

    $('#editdiagnosa').select2({
        ajax: {
            url: '<?= base_url(); ?>admin/patient/getDiagnosisListAjax',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
</script>