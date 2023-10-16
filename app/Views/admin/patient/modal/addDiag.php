<div class="modal fade" id="addDiagModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Diagnosa</h4>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group"><label for="diag_awal">Diagnosis</label>
                            <div class="p-2 select2-full-width">
                                <select class="form-control patient_list_ajax" id="filldiagnosa">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group"><label for="fillsuffer_type">Jenis Kasus</label>
                            <div>
                                <?php
                                $option = array();
                                foreach ($suffer as $key => $value) {
                                    $option[$suffer[$key]['suffer_type']] = $suffer[$key]['suffer'];
                                }
                                echo form_dropdown('fillsuffer_type', $option, '0', 'id="fillsuffer_type" class="form-control select2 act"');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group"><label for="filldiag_cat">Kategori Diagnosis</label>
                            <div>
                                <?php
                                $option = array();
                                foreach ($diagCat as $key => $value) {
                                    $option[$diagCat[$key]['diag_cat']] = $diagCat[$key]['diagnosa_category'];
                                }
                                echo form_dropdown('fillsuffer_type', $option, '0', 'id="filldiag_cat" class="form-control select2 act"');
                                ?>
                            </div>
                        </div>
                    </div>

                </div><!--./row-->
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" id="adddiagbtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var diagIndex = 0;
    var procIndex = 0;
    var suffer = new Array();
    var diagCat = new Array();

    suffer = JSON.parse('<?= json_encode($suffer); ?>');
    diagCat = JSON.parse('<?= json_encode($diagCat); ?>');

    $("#adddiagbtn").on("click", function() {
        var diag_id = $("#filldiagnosa").val()
        var diag_name = $("#filldiagnosa").find(":selected").data().data.text
        var diag_cat = $("#filldiag_cat").val()
        var diag_suffer = $("#fillsuffer_type").val()

        // alert(diag_name)

        addRowDiag(diag_id, diag_name, diag_cat, diag_suffer)

        resetDiagModal()

        $("#addDiagModal").modal('hide')
    })

    function getDiagnosas() {
        <?php if (!empty($pasienDiagnosa)) {
        ?>
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/getDiagnosas',
                type: "POST",
                data: JSON.stringify({
                    'id': '<?= $pasienDiagnosa['pasien_diagnosa_id']; ?>'
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    data.forEach((element, key) => {

                        addRowDiag(data[key].diagnosa_id, data[key].diagnosa_name, data[key].diag_cat, data[key].suffer_type);

                        <?php if (!is_null($visit['class_room_id'])) { ?>
                            addUnuDiag(data[key].diagnosa_id, data[key].diagnosa_name, data[key].diag_cat)
                            addInaDiag(data[key].diagnosa_id, data[key].diagnosa_name, data[key].diag_cat)
                        <?php } else { ?>
                            addUnuDiag(data[key].diagnosa_id, data[key].diagnosa_name, data[key].diag_cat)
                        <?php } ?>

                    });
                },
                error: function() {

                }
            });
        <?php } ?>
    }

    function getProcedures() {
        <?php if (!empty($pasienDiagnosa)) {
        ?>
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/getProcedures',
                type: "POST",
                data: JSON.stringify({
                    'id': '<?= $pasienDiagnosa['pasien_diagnosa_id']; ?>'
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    data.forEach((element, key) => {

                        addRowProc(data[key].diagnosa_id, data[key].diagnosa_name, data[key].diag_cat, data[key].suffer_type);

                        <?php if (!is_null($visit['class_room_id'])) { ?>
                            addUnuProc(data[key].diagnosa_id, data[key].diagnosa_name, data[key].diag_cat)
                            addInaProc(data[key].diagnosa_id, data[key].diagnosa_name, data[key].diag_cat)
                        <?php } else { ?>
                            addUnuProc(data[key].diagnosa_id, data[key].diagnosa_name, data[key].diag_cat)
                        <?php } ?>

                    });
                },
                error: function() {

                }
            });
        <?php } ?>
    }

    function addRowDiag(diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
        diagIndex++;
        if (diag_cat == null) {
            diag_cat = 1
        }
        if (diag_cat == null && diagIndex > 1) {
            diag_cat = 2
        }
        $("#bodyDiag")
            .append($('<tr id="diag' + diagIndex + '">')
                // .append($('<td>').html(diagIndex + "."))
                .append($('<td>')
                    .append('<div class="p-2 select2-full-width"><select id="diag_id' + diagIndex + '" class="form-control" name="diag_id[]" onchange="selectedDiag(' + diagIndex + ')"></select></div>')
                    .append('<input id="diag_name' + diagIndex + '" name="diag_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
                )
                // .append($('<td>')
                //     .append($('<input>').attr('name', 'diag_name[]').attr('id', 'diag_name' + diagIndex).attr('value', diag_name).attr('type', 'text').attr('readonly', 'readonly'))
                // )
                .append($('<td>')
                    .append($("<select class=\"form-control\">")
                        .attr('name', 'suffer_type[]').attr('id', 'suffer_type' + diagIndex) <?php foreach ($suffer as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $suffer[$key]['suffer_type']; ?>').html('<?= $suffer[$key]['suffer']; ?>')
                            ) <?php } ?>
                        .val(diag_suffer)
                    )
                )
                .append($('<td>')
                    .append($("<select class=\"form-control\">")
                        .attr('name', 'diag_cat[]').attr('id', 'diag_cat' + diagIndex) <?php foreach ($diagCat as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                            ) <?php } ?>
                        .val(diag_cat)
                    )
                )
                .append("<td><a href='#' onclick='$(\"#diag" + diagIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-remove'></i></a></td>")
            );

        initializeDiagSelect2("diag_id" + diagIndex, diag_id, diag_name)
    }


    function selectedDiag(index) {
        var diagname = $("#diag_id" + index).find(":selected").data()
        if (typeof diagname !== 'undefined') {
            $("#diag_name" + index).val(diagname.data.text)
        }
    }

    function addRowProc(diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
        procIndex++
        $("#bodyProc")
            .append($('<tr id="proc' + procIndex + '">')
                // .append($('<td>').html(diagIndex + "."))
                .append($('<td style="width: 90%">')
                    .append('<div class="p-2 select2-full-width"><select id="proc_id' + procIndex + '" onchange="selectedProc(' + procIndex + ')" class="form-control" name="proc_id[]" ></select></div>')
                    .append('<input id="proc_name' + procIndex + '" name="proc_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
                )
                .append("<td><a href='#' onclick='$(\"#proc" + procIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-remove'></i></a></td>")
            );

        initializeProcSelect2("proc_id" + procIndex, diag_id, diag_name)

    }

    function selectedProc(index) {
        var diagname = $("#proc_id" + index).find(":selected").data()
        console.log(diagname)
        if (typeof diagname !== 'undefined') {
            $("#proc_name" + index).val(diagname.data.text)
        }
    }



    function resetDiagModal() {
        $("#filldiagnosa").select2("val", "")
        $("#filldiag_cat").prop('selectedindex', 0)
        $("#fillsuffer_type").prop('selectedindex', 0)

    }

    $('#filldiagnosa').select2({
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