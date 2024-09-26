<div class="tab-pane fade" id="pra-operasi">
    <form id="formPraOperasi" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
        <?php csrf_field(); ?>

        <input id="apovisit_id" name="visit_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['visit_id']; ?>" />
        <input id="apoorg_unit_code" name="org_unit_code" placeholder="" type="hidden" class="form-control block" value="<?= $visit['org_unit_code']; ?>" />
        <input id="apobody_id" name="body_id" placeholder="" type="hidden" class="form-control block" value="" />
        <input id="apotrans_id" name="trans_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['trans_id'] ?>" />
        <div id="accordionPraOperasi" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="accordionPraOperasiInformasiMedis">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPraOperasiInformasiMedisContent" aria-expanded="false" aria-controls="accordionPraOperasiInformasiMedisContent">
                        <b>INFORMASI MEDIS</b>
                    </button>
                </h2>
                <div id="accordionPraOperasiInformasiMedisContent" class="accordion-collapse collapse" aria-labelledby="flush-accordionPraOperasiInformasiMedis" data-bs-parent="#accordionPraOperasi">
                    <div class="accordion-body">
                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                            <div class="form-group">
                                <label>Tanggal dan Jam Operasi</label>
                                <div class="position-relative">
                                    <input name="examination_date" id="apoexamination_date" type="datetime-local" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="form-group"><label>Riwayat Alergi Non Obat</label>
                                <textarea name="riwayatnonobat" id="aporiwayatnonobat" placeholder="" value="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="form-group"><label>Riwayat Alergi Obat</label>
                                <textarea name="riwayatobat" id="aporiwayatobat" placeholder="" value="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                            <div class="form-group">
                                <label>Hasil Pemeriksaan Penunjang</label>
                                <div class="position-relative">
                                    <input class="form-check-input" type="checkbox" id="apopenunjang" name="penunjang" value="1">
                                    <span class="h6" id="badge-bb"></span>
                                </div>
                            </div>
                        </div>
                        <div id="praOperasiDiagnosaBody">
                            <div class="row mt-4">
                                <div class="table tablecustom-responsive">
                                    <h4><b>DIAGNOSA</b></h4>
                                    <hr>
                                    <table id="tablediagnosa" class="table">
                                        <thead>
                                            <th class="text-center" style="width: 40%">Diagnosa</th>
                                            <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                            <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                        </thead>
                                        <tbody id="bodyDiagPraOperation">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-tab-tools" style="text-align: center;">
                                    <button type="button" id="adddiagnosaPraOperasi" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Rencana Operasi</label>
                                    <div class=" position-relative">
                                        <select type="text" name="" id="" placeholder="" value="" class="form-control">
                                        </select>
                                        <span class="h6" id="badge-bb"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Mulai Operasi</label>
                                    <div class=" position-relative">
                                        <input name="start_operation" id="apostart_operation" type="datetime-local" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                <div class="form-group">
                                    <label>Akhir Operasi</label>
                                    <div class=" position-relative">
                                        <input name="end_operation" id="apoend_operation" type="datetime-local" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="table tablecustom-responsive">
                                <h4><b>Produk Darah</b></h4>
                                <hr>
                                <table id="tablediagnosa" class="table">
                                    <thead>
                                        <th class="text-center" style="width: 20%">Jenis Darah</th>
                                        <th class="text-center" style="width: 20%">Jumlah</th>
                                        <th class="text-center" style="width: 20%">Satuan Ukuran</th>
                                        <th class="text-center" style="width: 40%" colspan="2">Keterangan</th>
                                    </thead>
                                    <tbody id="bodyBloodRequest">

                                    </tbody>
                                </table>
                            </div>
                            <div class="box-tab-tools" style="text-align: center;">
                                <button type="button" id="addbloodrequest2" name="addbloodrequest" class="btn btn-secondary"><i class="fa fa-plus"></i> <span>Tambah</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="accordionPraOperasiChecklistHeader">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPraOperasiChecklistContent" aria-expanded="false" aria-controls="accordionPraOperasiChecklistContent">
                        <b>CHECKLIST PERSIAPAN OPERASI</b>
                    </button>
                </h2>
                <div id="accordionPraOperasiChecklistContent" class="accordion-collapse collapse" aria-labelledby="accordionPraOperasiChecklistHeader" data-bs-parent="#accordionPraOperasi">
                    <div class="accordion-body" id="cKeperawatanIntraOperatif2">
                        <?php
                        $persiapanOperasi = array_filter($aType, function ($item) {
                            return $item['p_type'] == 'OPRS001';
                        });
                        $persiapanOperasip = array_filter($aParameter, function ($item) {
                            return $item['p_type'] == 'OPRS001';
                        });
                        $persiapanOperasiv = array_filter($aValue, function ($item) {
                            return $item['p_type'] == 'OPRS001';
                        });
                        ?>
                        <?php foreach ($persiapanOperasi as $key => $value) {
                        ?>
                            <div class="row mt-4">
                                <h4><b><?= $value['p_description']; ?></b></h4>
                                <hr>

                                <?php foreach (array_filter($persiapanOperasip, function ($value) use ($persiapanOperasi, $key) {
                                    return $value['p_type'] == $persiapanOperasi[$key]['p_type'];
                                }) as $key1 => $value1) {
                                    if ($value1['entry_type'] == '1') {
                                ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                            <div class="form-group">
                                                <label><?= $value1['parameter_desc']; ?></label>
                                                <div class=" position-relative">
                                                    <input type="text" name="<?= strtolower($value1['column_name']) ?? ''; ?>" id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder="" value="" class="form-control">
                                                    <span class="h6" id="badge-bb"></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value1['entry_type'] == '2') {
                                    ?>
                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="apo<?= strtolower($value1['column_name']) ?? ''; ?>" name="<?= strtolower($value1['column_name']) ?? ''; ?>" value="1">
                                                <label for="apo<?= strtolower($value1['column_name']) ?? ''; ?>"><?= $value1['parameter_desc']; ?></label>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value1['entry_type'] == '3') {
                                    ?>
                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label><?= $value1['parameter_desc']; ?></label>
                                                <div class=" position-relative">
                                                    <select type="text" name="<?= strtolower($value1['column_name']) ?? ''; ?>" id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder="" value="" class="form-control">
                                                        <?php foreach (array_filter($persiapanOperasiv, function ($values) use ($value1) {
                                                            return $values['p_type'] == $value1['p_type'] && $values['parameter_id'] == $value1['parameter_id'];
                                                        }) as $key2 => $value2) {
                                                        ?>
                                                            <option value="<?= $value2['value_id']; ?>"><?= $value2['value_desc']; ?></option>
                                                        <?php
                                                        } ?>
                                                    </select>
                                                    <span class="h6" id="badge-bb"></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value1['entry_type'] == '4') {
                                    ?>
                                        <div class="col-sm-12 mt-2">
                                            <div class="form-group"><label><?= $value1['parameter_desc']; ?></label>
                                                <textarea name="<?= strtolower($value1['column_name']) ?? ''; ?>" id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder="" value="" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value1['entry_type'] == '5') {
                                    ?>
                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label><?= $value1['parameter_desc']; ?></label>
                                                <div class=" position-relative">
                                                    <input name="<?= strtolower($value1['column_name']) ?? ''; ?>" id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>" type="datetime-local" class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value1['entry_type'] == '6') {
                                    ?>
                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label><?= $value1['parameter_desc']; ?></label>
                                                <div class=" position-relative">
                                                    <input class="form-check-input" type="checkbox" id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>" name="<?= strtolower($value1['column_name']) ?? ''; ?>" value="1">
                                                    <span class="h6" id="badge-bb"></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($value1['entry_type'] == '7') {
                                    ?>
                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                            <div class="form-group">
                                                <label><?= $value1['parameter_desc']; ?></label>
                                                <div class="row position-relative">
                                                    <?php foreach (array_filter($persiapanOperasiv, function ($values) use ($value1) {
                                                        return $values['p_type'] == $value1['p_type'] && $values['parameter_id'] == $value1['parameter_id'];
                                                    }) as $key2 => $value2) {
                                                    ?>
                                                        <!-- <option value="<?= $value2['value_id']; ?>"><?= $value2['value_desc']; ?></option> -->
                                                        <div class="col-md-12">
                                                            <div class="form-check mb-3"><input class="form-check-input" type="radio" name="<?= $value1['parameter_desc']; ?>" id="<?= $value2['p_type'] . $value2['parameter_id'] . $value2['value_id']; ?>" value="<?= $value2['value_id']; ?>">
                                                                <label class="form-check-label" for="<?= $value2['p_type'] . $value2['parameter_id'] . $value2['value_id']; ?>"><?= $value2['value_desc']; ?></label>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } ?>
                                                    <!-- <input class="form-check-input" type="radio" id="apo<?= $value1['p_type'] . $value1['parameter_id']; ?>" name="<?= strtolower($value1['column_name']) ?? ''; ?>" value="1">
                                                                                <span class="h6" id="badge-bb"></span> -->
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        <?php
                        } ?>
                        <div class="row mt-4">
                            <h4><b>Penyakit Kronis</b></h4>
                            <hr>
                            <?php
                            $kronis = array_filter($aValue, function ($item) {
                                return $item['p_type'] == 'GEN0009' && $item['parameter_id'] == '05';
                            });
                            foreach ($kronis as $key1 => $value1) {

                            ?>
                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="apo<?= $value1['value_id']; ?>" name="" value="1">
                                        <label><?= $value1['value_desc']; ?></label>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                            <div class="form-group">
                                <label>Tanggal dan Jam Checklist</label>
                                <div class="position-relative">
                                    <input id="apomodified_date" type="datetime-local" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="accordionPraOperasiSurgeryHeader">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPraOperasiSurgeryContent" aria-expanded="false" aria-controls="accordionPraOperasiSurgeryContent">
                        <b>SURGERY LOCATION</b>
                    </button>
                </h2>
                <div id="accordionPraOperasiSurgeryContent" class="accordion-collapse collapse" aria-labelledby="accordionPraOperasiSurgeryHeader" data-bs-parent="#accordionPraOperasi">
                    <div class="accordion-body" id="accordionPraOperasiSurgeryBody">

                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-end mt-4">
            <button type="button" id="btn-print-praoperasi2" class="btn btn-success">
                <i class="fas fa-print"></i> Cetak
            </button>
            <button type="button" id="formPraOperasiAddBtn" name="save" data-loading-text="Tambah" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <span>Tambah</span></button>
            <button type="submit" id="formPraOperasiSaveBtn" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
            <button type="button" id="formPraOperasiEditBtn" name="editrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
            <button type="button" id="formPraOperasiSignBtn" name="signrm" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
            <button type="button" id="formPraOperasiCetakBtn" name="" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-light pull-right"><i class="fa fa-signature"></i> <span>Cetak</span></button>
        </div>
    </form>
</div>
<script>
    let aparameter = <?= json_encode($aParameter); ?>;
    let avalue = <?= json_encode($aValue); ?>;
    $(document).ready(function() {
        // appendDiagnosa(accordionId, bodyId, pasienDiagnosa)
        appendLokalisOperation("accordionPraOperasiSurgeryBody")

    })
</script>
<script>
    let coba = [];

    const appendLokalisOperation = (accordionId) => {
        var accordionContent = ``
        $.each(aparameter, function(key, value) {
            if (value.p_type == 'OPRS002') {
                $.each(avalue, function(key1, value1) {
                    if (value.p_type == value1.p_type && value.parameter_id == value1.parameter_id && value1.value_score == '3') {
                        accordionContent += `<div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="mb-4">
                                        <h5 class="font-size-14 mb-4 badge bg-primary">` + value1.value_desc + `:</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <canvas id="canvas` + value1.p_type + value1.parameter_id + value1.value_id + `" width="450" height="450" style="border: 1px solid #000;"></canvas>
                                                <input type="hidden" name="lokalis` + value1.value_id + `" id="lokalis` + value1.value_id + `">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lokalis` + value1.value_id + `desc">Deskripsi</label>
                                                    <textarea name="lokalis` + value1.value_id + `desc" id="lokalis` + value1.value_id + `desc" class="form-control" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <button id="undo` + value1.value_id + `" class="btn btn-primary" type="button"> Undo</button>
                                                <button id="clear` + value1.value_id + `" class="btn btn-danger" type="button"> Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                    }
                })
            }
        })
        $("#" + accordionId).html(accordionContent);
        generateLokalisOperation()
    }
</script>
<script>
    const generateLokalisOperation = () => {

        $.each(aparameter, function(key, value) {
            if (value.p_type == 'OPRS002') {
                $.each(avalue, function(key1, value1) {
                    if (value.p_type == value1.p_type && value.parameter_id == value1.parameter_id && value1.value_score == '3') {
                        var canvas = document.getElementById('canvas' + value1.p_type + value1.parameter_id + value1.value_id);
                        const canvasDataInput = document.getElementById('lokalis' + value1.value_id);
                        var ctx = canvas.getContext('2d');
                        var drawing = false;
                        var line = []; // Store points for the current line being drawn
                        let drawingHistory = [];

                        var img = new Image();
                        img.onload = function() {
                            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        };
                        img.src = '<?= base_url('assets/img/asesmen') ?>' + value1.value_info;

                        canvas.addEventListener('mousedown', startDrawing);
                        canvas.addEventListener('mousemove', draw);
                        canvas.addEventListener('mouseup', stopDrawing);
                        canvas.addEventListener('mouseout', stopDrawing);

                        function startDrawing(e) {
                            drawing = true;
                            draw(e);
                            line = []; // Clear the current line
                            line.push({
                                x: e.offsetX,
                                y: e.offsetY
                            }); // Add the starting point of the line
                        }

                        function draw(e) {
                            if (!drawing) return;

                            ctx.lineWidth = 2;
                            ctx.lineCap = 'round';
                            ctx.strokeStyle = '#000';

                            const x = e.offsetX;
                            const y = e.offsetY;

                            ctx.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
                            ctx.stroke();
                            ctx.beginPath();
                            ctx.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
                            line.push({
                                x,
                                y
                            }); // Add the current point to the line
                        }

                        function stopDrawing() {
                            drawing = false;
                            ctx.beginPath();
                            drawingHistory.push(line);
                        }
                        $("#clear" + value1.value_id).on("click", function() {
                            ctx.clearRect(0, 0, canvas.width, canvas.height);
                            drawingHistory = []; // Clear the drawing history
                            img.onload = function() {
                                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                            };
                            img.src = '<?= base_url('assets/img/asesmen') ?>' + value1.value_info;
                        })
                        $("#undo" + value1.value_id).on("click", function() {
                            if (drawingHistory.length > 0) {
                                // Remove the last line from the drawing history
                                drawingHistory.pop();
                                // Clear the canvas
                                ctx.clearRect(0, 0, canvas.width, canvas.height);
                                // Redraw the remaining lines
                                drawingHistory.forEach(line => {
                                    for (let i = 1; i < line.length; i++) {
                                        ctx.beginPath();
                                        ctx.moveTo(line[i - 1].x, line[i - 1].y);
                                        ctx.lineTo(line[i].x, line[i].y);
                                        ctx.stroke();
                                    }
                                });
                            }
                        })
                    }
                })
            }
        })
    }

    const saveCanvasOperasiData = () => {
        <?php foreach ($aParameter as $key => $value) {
            if ($value['p_type'] == 'OPRS002')
                foreach ($aValue as $key1 => $value1) {
                    if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id']) {
                        // dd($value);
                        $file_path = $value1["value_info"];
                        $extension = pathinfo(
                            $file_path,
                            PATHINFO_EXTENSION
                        );
        ?>
                    var canvasId = document.getElementById('canvas<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>');
                    const canvasResult<?= $value1['value_id']; ?> = canvasId.toDataURL('image/<?= $extension; ?>');

                    $("#lokalis<?= $value1['value_id']; ?>").val(canvasResult<?= $value1['value_id']; ?>);

        <?php
                    }
                }
        } ?>
    }
</script>
<script>
    const initiatePraOperasi = (props, res) => {
        enablePraOperasi()
        let opsSelected = props

        // $("#apoexamination_date").val(get_date())
        // $("#apostart_operation").val(opsSelected.start_operation)
        let pattern = /G00905/
        let historyKronis = historyPasien?.filter(function(str) {
            return pattern.test(str.value_id);
        })
        let historyAlergy = historyPasien?.filter(item =>
            item.value_id === 'G0090101' || item.value_id === 'G0090102'
        )

        $.each(historyPasien, function(key, value) {
            $("#apo" + value.value_id).prop("checked", true)
        })
        $.each(historyAlergy, function(key, value) {
            if (value.value_id == 'G0090101') {
                $("#aporiwayatobat").val(value.histories)
            }

            if (value.value_id == 'G0090102') {
                $("#aporiwayatnonobat").val(value.histories)
            }
        })

        if (res) {
            let praoperasi = res?.praoperasi
            let lokalis = res?.lokalis
            let diagnosa = res?.pasienDiagnosas
            let blood = res?.blood

            coba = blood

            $.each(diagnosa, function(key, value) {
                if (value.pasien_diagnosa_id == bodyId) {
                    addRowDiagDokter('bodyDiagPraOperation', '', value.diagnosa_id, value.diagnosa_name, value.diag_cat, value.diag_suffer)
                }
            })
            $.each(blood, function(key, value) {
                if (value.pasien_diagnosa_id == bodyId) {
                    addBloodRequest('bodyBloodRequest', value.body_id, value)
                }
            })

            appendLokalisOperation("accordionPraOperasiSurgeryBody")

            $.each(praoperasi, function(key, value) {
                $.each(value, function(key1, value1) {
                    if ($("#apo" + key1).is(":checkbox")) {
                        if (value1 == 1) {
                            $("#apo" + key1).prop("checked", true)
                        }
                    } else {
                        $("#apo" + key1).val(value1)
                        if (key1 == 'modified_date') {
                            let valdate = String(value1).substring(0, 16)
                            $("#apo" + key1).val(valdate)
                        }
                    }
                })
            })

            $.each(lokalis, function(key, value) {
                if (value.body_id = bodyId) {
                    $("#lokalis" + value.value_id).val(value.value_detail)
                    $("#lokalis" + value.value_id + "desc").val(value.value_desc)
                    let valid = String(value.value_id)
                    let canvas = document.getElementById('canvas' + value.p_type + value.parameter_id + valid.toUpperCase());
                    const canvasDataInput = document.getElementById('lokalis' + value.value_id);
                    let context = canvas.getContext('2d');
                    const img = new Image();
                    img.onload = function() {
                        context.drawImage(img, 0, 0, canvas.width, canvas.height);
                    };
                    img.src = "data:image/png;base64," + value.filedata64;
                }
            })
        }
    }
    const assessmentPraOperasi = (props) => {

        let visit = <?= json_encode($visit) ?>;
        postData({
            body_id: props?.vactination_id,
        }, 'admin/PatientOperationRequest/getDataPraOperasi', (res) => {
            // let resjson = JSON.parse(res)
            console.log(res);
            initiatePraOperasi(props, res)
        });
    };

    $("#formPraOperasi").on('submit', (function(e) {
        saveCanvasOperasiData()
        e.preventDefault();
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/PatientOperationRequest/savePraOperasi',
            type: "POST",
            data: new FormData(document.getElementById("formPraOperasi")),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    errorSwal('Data tidak ditemukan.');

                } else {
                    successSwal('Data berhasil disimpan.');

                    disablePraOperasi()
                }
                clicked_submit_btn.button('reset');
            },
            error: function(xhr) { // if error occured
                errorSwal('Error occured.please try again.');

            },
            complete: function() {}
        });
    }));

    $("#formPraOperasiEditBtn").on("click", function(e) {
        enablePraOperasi()
    })
    $("#adddiagnosaPraOperasi").on("click", function(e) {
        addRowDiagDokter('bodyDiagPraOperation', '')
    })
</script>
<script>
    const enablePraOperasi = () => {
        // e.preventDefault()
        $("#formPraOperasi").find("input, select, textarea").prop("disabled", false)
        $("#formPraOperasiSaveBtn").show()
        $("#formPraOperasiEditBtn").hide()
        $("#formPraOperasiSignBtn").hide()
        $("#formPraOperasiCetakBtn").hide()
    }
    const disablePraOperasi = () => {
        $("#formPraOperasi").find("input, select, textarea").prop("disabled", true)
        $("#formPraOperasiSaveBtn").hide()
        if ($("#apovalid_user").val() == '' || typeof($("#apovalid_user").val()) === 'undefined') {
            $("#formPraOperasiEditBtn").show()
            $("#formPraOperasiSignBtn").show()
            $("#formPraOperasiCetakBtn").show()
        } else {
            $("#formPraOperasiEditBtn").hide()
            $("#formPraOperasiSignBtn").hide()
            $("#formPraOperasiCetakBtn").hide()
        }
    }
</script>

<script>

</script>