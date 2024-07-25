<?php
$postOP = array_filter($aType, function ($value) {
    return $value['p_type'] == 'OPRS009';
});
$postOPp = array_filter($aParameter, function ($value) {
    return $value['p_type'] == 'OPRS009';
});
$postOPv = array_filter($aValue, function ($value) {
    return $value['p_type'] == 'OPRS009';
});
?>
<div class="tab-pane fade" id="instruksi-post-operasi">
    <div id="accordionInstruksiPost" class="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="accordionInstruksiPostInformasiMedis">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionInstruksiPostInformasiMedisContent" aria-expanded="false" aria-controls="accordionInstruksiPostInformasiMedisContent">
                    <b>INFORMASI MEDIS</b>
                </button>
            </h2>
            <div id="accordionInstruksiPostInformasiMedisContent" class="accordion-collapse collapse" aria-labelledby="flush-accordionInstruksiPostInformasiMedis" data-bs-parent="#accordionInstruksiPost">
                <div class="accordion-body">
                    <?php foreach ($postOP as $key => $value) {
                    ?>
                        <div class="row mt-4">
                            <h4><b><?= $value['p_description']; ?></b></h4>
                            <hr>
                            <ol class="list-group list-group-numbered">
                                <?php foreach (array_filter($postOPp, function ($value) use ($postOP, $key) {
                                    return $value['p_type'] == $postOP[$key]['p_type'];
                                }) as $key1 => $value1) {
                                    if ($value1['entry_type'] == '1') {
                                ?>
                                        <li class="list-group-item col-xs-12 col-sm-12 col-md-12 ">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class="form-group">
                                                <div class=" position-relative">
                                                    <input type="text" name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder="" value="" class="form-control">
                                                    <span class="h6" id="badge-bb"></span>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    } else if ($value1['entry_type'] == '2') {
                                    ?>
                                        <li class="list-group-item col-xs-12 col-sm-12 col-md-12 ">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <input class="form-check-input" type="checkbox" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" name="<?= $value1['column_name'] ?? ''; ?>" value="1">
                                            <div class="form-group">
                                                <div class=" position-relative">
                                                    <span class="h6" id="badge-bb"></span>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    } else if ($value1['entry_type'] == '3') {
                                    ?>
                                        <li class="list-group-item col-xs-12 col-sm-12 col-md-12 ">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class="form-group">
                                                <div class=" position-relative">
                                                    <select type="text" name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder="" value="" class="form-control">
                                                        <?php foreach (array_filter($postOPv, function ($values) use ($value1) {
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
                                        </li>
                                    <?php
                                    } else if ($value1['entry_type'] == '4') {
                                    ?>
                                        <li class="col-sm-12 ">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class="form-group">
                                                <textarea name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder="" value="" class="form-control"></textarea>
                                            </div>
                                        </li>
                                    <?php
                                    } else if ($value1['entry_type'] == '5') {
                                    ?>
                                        <li class="list-group-item col-xs-12 col-sm-12 col-md-12 ">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class="form-group">
                                                <div class=" position-relative">
                                                    <input name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" type="datetime-local" class="form-control" value="">
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    } else if ($value1['entry_type'] == '6') {
                                    ?>
                                        <li class="list-group-item col-xs-12 col-sm-12 col-md-12 ">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class="form-group">
                                                <div class=" position-relative">
                                                    <input class="form-check-input" type="checkbox" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" name="<?= $value1['column_name'] ?? ''; ?>" value="1">
                                                    <span class="h6" id="badge-bb"></span>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    } else if ($value1['entry_type'] == '7') {
                                    ?>
                                        <li class="list-group-item col-xs-12 col-sm-12 col-md-12 ">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class="form-group">
                                                <div class="row position-relative">
                                                    <?php foreach (array_filter($postOPv, function ($values) use ($value1) {
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
                                                    <!-- <input class="form-check-input" type="radio" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" name="<?= $value1['column_name'] ?? ''; ?>" value="1">
                                                                                <span class="h6" id="badge-bb"></span> -->
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    } else if ($value1['entry_type'] == '8') {
                                    ?>
                                        <li class="list-group-item col-xs-12 col-sm-12 col-md-12 ">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class="form-group">
                                            </div>
                                        </li>
                                <?php
                                    }
                                } ?>
                            </ol>

                            <?php
                            ?>
                        </div>
                    <?php
                    } ?>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="accordionInstruksiPostChecklistHeader">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionInstruksiPostChecklistContent" aria-expanded="false" aria-controls="accordionInstruksiPostChecklistContent">
                    <b>CHECKLIST PERSIAPAN OPERASI</b>
                </button>
            </h2>
            <div id="accordionInstruksiPostChecklistContent" class="accordion-collapse collapse" aria-labelledby="accordionInstruksiPostChecklistHeader" data-bs-parent="#accordionInstruksiPost">
                <div class="accordion-body" id="cKeperawatanIntraOperatif">
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
                                    <div class="list-group-item col-xs-12 col-sm-12 col-md-12 ">
                                        <div class="form-group">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class=" position-relative">
                                                <input type="text" name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder="" value="" class="form-control">
                                                <span class="h6" id="badge-bb"></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else if ($value1['entry_type'] == '2') {
                                ?>
                                    <div class="col-xs-12 col-sm-12 col-md-3 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" name="<?= $value1['column_name'] ?? ''; ?>" value="1">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                        </div>
                                    </div>
                                <?php
                                } else if ($value1['entry_type'] == '3') {
                                ?>
                                    <div class="col-xs-12 col-sm-12 col-md-3 ">
                                        <div class="form-group">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class=" position-relative">
                                                <select type="text" name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder="" value="" class="form-control">
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
                                    <div class="col-sm-12 ">
                                        <div class="form-group"><label><?= $value1['parameter_desc']; ?></label>
                                            <textarea name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" placeholder="" value="" class="form-control"></textarea>
                                        </div>
                                    </div>
                                <?php
                                } else if ($value1['entry_type'] == '5') {
                                ?>
                                    <div class="col-xs-12 col-sm-12 col-md-3 ">
                                        <div class="form-group">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class=" position-relative">
                                                <input name="<?= $value1['column_name'] ?? ''; ?>" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" type="datetime-local" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else if ($value1['entry_type'] == '6') {
                                ?>
                                    <div class="col-xs-12 col-sm-12 col-md-3 ">
                                        <div class="form-group">
                                            <label><?= $value1['parameter_desc']; ?></label>
                                            <div class=" position-relative">
                                                <input class="form-check-input" type="checkbox" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" name="<?= $value1['column_name'] ?? ''; ?>" value="1">
                                                <span class="h6" id="badge-bb"></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else if ($value1['entry_type'] == '7') {
                                ?>
                                    <div class="col-xs-12 col-sm-12 col-md-3 ">
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
                                                <!-- <input class="form-check-input" type="radio" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" name="<?= $value1['column_name'] ?? ''; ?>" value="1">
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
                            <div class="col-xs-12 col-sm-12 col-md-3 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="prsl<?= $value1['p_type'] . $value1['parameter_id']; ?>" name="" value="1">
                                    <label><?= $value1['value_desc']; ?></label>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 ">
                        <div class="form-group">
                            <label>Tanggal dan Jam Checklist</label>
                            <div class="position-relative">
                                <input name="" id="" type="datetime-local" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="accordionInstruksiPostSurgeryHeader">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionInstruksiPostSurgeryContent" aria-expanded="false" aria-controls="accordionInstruksiPostSurgeryContent">
                    <b>SURGERY LOCATION</b>
                </button>
            </h2>
            <div id="accordionInstruksiPostSurgeryContent" class="accordion-collapse collapse" aria-labelledby="accordionInstruksiPostSurgeryHeader" data-bs-parent="#accordionInstruksiPost">
                <div class="accordion-body" id="accordionInstruksiPostSurgeryBody">

                </div>
            </div>
        </div>
    </div>
</div>