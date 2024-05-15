<script type='text/javascript'>
    var mrJson;
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;

    $(document).ready(function(e) {
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Anak</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_bedah/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Bedah</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_dalam/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Dalam</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_kebidanan/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Kebidanan</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_kulit_kelamin/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Kulit Kelamin</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_mata/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan Mata</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_tht/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ralan THT</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Anak</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_dalam/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Dalam</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_kebidanan/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Kebidanan</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_neonatal/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Neonatal</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_paru/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Ranap Paru</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/rawat_inap/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis Rawat Inap</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/profile/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Profile Ringkas Medis Rawat Jalan</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/reconsialisasi/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Reconsialisasi Obat</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/resume_medis/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Resume Medis</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_diagnosis/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Keterangan Diagnosis</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_bpjs/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Kontrol Pasien BPJS</a></li>')
        $('#medisListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_perintah/' . base64_encode(json_encode($visit)); ?>/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Perintah Rawat Inap</a></li>')

        tinymce.init({
            selector: '#armstanding_order'
        });
        tinymce.init({
            selector: '#arminstruction'
        });

        // armstanding_ordereditor.init({
        //     selector: '#armstanding_order'
        // });
        // arminstructioneditor.init({
        //     selector: '#arminstruction'
        // });
        var nomor = '<?= $visit['no_registration']; ?>';
        var ke = '%'
        var mulai = '2023-08-01' //tidak terpakai
        var akhir = '2023-08-31' //tidak terpakai
        var lunas = '%'
        // var klinik = '<?= $visit['clinic_id']; ?>'
        var klinik = '%'
        var rj = '%'
        var status = '%'
        var nota = '%'
        var trans = '<?= $visit['trans_id']; ?>'
        var visit = '<?= $visit['visit_id']; ?>'
    })
    $("#assessmentmedisTab").on("click", function() {
        getAssessmentMedis()
    })
</script>

<script>

</script>
<script type="text/javascript">
    <?php foreach ($aParameter as $key => $value) {
        if ($value['p_type'] == 'GEN0002')
            foreach ($aValue as $key1 => $value1) {
                if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id'] && $value1['value_score'] == '3') {
    ?>
                $(document).ready(function() {

                    var canvas<?= $value1['value_id']; ?> = document.getElementById('canvas<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>');
                    const canvasDataInput<?= $value1['value_id']; ?> = document.getElementById('lokalis<?= $value1['value_id']; ?>');
                    var ctx<?= $value1['value_id']; ?> = canvas<?= $value1['value_id']; ?>.getContext('2d');
                    var drawing<?= $value1['value_id'] ?> = false;
                    var line<?= $value1['value_id'] ?> = []; // Store points for the current line being drawn
                    let drawingHistory<?= $value1['value_id'] ?> = [];

                    var img<?= $value1['value_id']; ?> = new Image();
                    img<?= $value1['value_id']; ?>.onload = function() {
                        ctx<?= $value1['value_id']; ?>.drawImage(img<?= $value1['value_id']; ?>, 0, 0, canvas<?= $value1['value_id']; ?>.width, canvas<?= $value1['value_id']; ?>.height);
                    };
                    img<?= $value1['value_id']; ?>.src = '<?= base_url('assets/img/asesmen' . $value1['value_info']) ?>';

                    canvas<?= $value1['value_id'] ?>.addEventListener('mousedown', startDrawing<?= $value1['value_id'] ?>);
                    canvas<?= $value1['value_id'] ?>.addEventListener('mousemove', draw<?= $value1['value_id'] ?>);
                    canvas<?= $value1['value_id'] ?>.addEventListener('mouseup', stopDrawing<?= $value1['value_id'] ?>);
                    canvas<?= $value1['value_id'] ?>.addEventListener('mouseout', stopDrawing<?= $value1['value_id'] ?>);

                    console.log(canvas<?= $value1['value_id'] ?>.toDataURL("image/png"))


                    function startDrawing<?= $value1['value_id'] ?>(e) {
                        drawing<?= $value1['value_id'] ?> = true;
                        draw<?= $value1['value_id'] ?>(e);
                        line = []; // Clear the current line
                        line.push({
                            x: e.offsetX,
                            y: e.offsetY
                        }); // Add the starting point of the line
                    }

                    function draw<?= $value1['value_id'] ?>(e) {
                        if (!drawing<?= $value1['value_id'] ?>) return;

                        ctx<?= $value1['value_id'] ?>.lineWidth = 2;
                        ctx<?= $value1['value_id'] ?>.lineCap = 'round';
                        ctx<?= $value1['value_id'] ?>.strokeStyle = '#000';

                        const x = e.offsetX;
                        const y = e.offsetY;

                        ctx<?= $value1['value_id'] ?>.lineTo(e.clientX - canvas<?= $value1['value_id'] ?>.getBoundingClientRect().left, e.clientY - canvas<?= $value1['value_id'] ?>.getBoundingClientRect().top);
                        ctx<?= $value1['value_id'] ?>.stroke();
                        ctx<?= $value1['value_id'] ?>.beginPath();
                        ctx<?= $value1['value_id'] ?>.moveTo(e.clientX - canvas<?= $value1['value_id'] ?>.getBoundingClientRect().left, e.clientY - canvas<?= $value1['value_id'] ?>.getBoundingClientRect().top);
                        line<?= $value1['value_id'] ?>.push({
                            x,
                            y
                        }); // Add the current point to the line
                    }

                    function stopDrawing<?= $value1['value_id'] ?>() {
                        drawing<?= $value1['value_id'] ?> = false;
                        ctx<?= $value1['value_id'] ?>.beginPath();
                        drawingHistory<?= $value1['value_id'] ?>.push(line<?= $value1['value_id'] ?>);
                    }
                    $("#clear<?= $value1['value_id'] ?>").on("click", function() {
                        ctx<?= $value1['value_id'] ?>.clearRect(0, 0, canvas<?= $value1['value_id'] ?>.width, canvas<?= $value1['value_id'] ?>.height);
                        drawingHistory<?= $value1['value_id'] ?> = []; // Clear the drawing history
                        img<?= $value1['value_id']; ?>.onload = function() {
                            ctx<?= $value1['value_id']; ?>.drawImage(img<?= $value1['value_id']; ?>, 0, 0, canvas<?= $value1['value_id']; ?>.width, canvas<?= $value1['value_id']; ?>.height);
                        };
                        img<?= $value1['value_id']; ?>.src = '<?= base_url('assets/img/asesmen' . $value1['value_info']) ?>';
                    })
                    $("#undo<?= $value1['value_id'] ?>").on("click", function() {
                        if (drawingHistory<?= $value1['value_id'] ?>.length > 0) {
                            // Remove the last line from the drawing history
                            drawingHistory<?= $value1['value_id'] ?>.pop();
                            // Clear the canvas
                            ctx<?= $value1['value_id'] ?>.clearRect(0, 0, canvas<?= $value1['value_id'] ?>.width, canvas<?= $value1['value_id'] ?>.height);
                            // Redraw the remaining lines
                            // console.log(drawingHistory)
                            drawingHistory<?= $value1['value_id'] ?>.forEach(line => {
                                for (let i = 1; i < line<?= $value1['value_id'] ?>.length; i++) {
                                    console.log(line<?= $value1['value_id'] ?>[i].x)
                                    ctx<?= $value1['value_id'] ?>.beginPath();
                                    ctx<?= $value1['value_id'] ?>.moveTo(line<?= $value1['value_id'] ?>[i - 1].x, line<?= $value1['value_id'] ?>[i - 1].y);
                                    ctx<?= $value1['value_id'] ?>.lineTo(line<?= $value1['value_id'] ?>[i].x, line<?= $value1['value_id'] ?>[i].y);
                                    ctx<?= $value1['value_id'] ?>.stroke();
                                }
                            });
                        }
                    })
                });



    <?php
                }
            }
    } ?>

    function saveCanvasData() {
        <?php foreach ($aParameter as $key => $value) {
            if ($value['p_type'] == 'GEN0002')
                foreach ($aValue as $key1 => $value1) {
                    if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id'] && $value1['value_score'] == '3') {
        ?>
                    var canvasId = document.getElementById('canvas<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>');
                    const canvasResult<?= $value1['value_id']; ?> = canvasId.toDataURL('image/png');
                    console.log(canvasResult<?= $value1['value_id']; ?>)

                    $("#lokalis<?= $value1['value_id']; ?>").val(canvasResult<?= $value1['value_id']; ?>);

        <?php
                    }
                }
        } ?>
    }
</script>
<script type="text/javascript">
    var currentIndex;
    var indexLength;
    $(document).ready(function(e) {
        // initialAddArm()
    })

    function initialAddArm() {
        enableARM()

        $("#formaddarm input").val(null)
        $("#formaddarm select").val(null)
        $("#formaddarm textarea").val(null)


        $('#armdate_of_diagnosa').val(get_date())
        $('#armclinic_id').val('<?= $visit['clinic_id']; ?>')
        $('#armemployee_id').val('<?= $visit['employee_id']; ?>')

        $('#armorg_unit_code').val('<?= $visit['org_unit_code']; ?>')
        $('#armvisit_id').val('<?= $visit['visit_id']; ?>')
        $('#armtrans_id').val('<?= $visit['trans_id']; ?>')
        $('#armreport_date').val(get_date())
        $('#armtheid').val('<?= $visit['pasien_id']; ?>')
        $('#armbody_id').val(null)
        $('#armtheaddress').val('<?= $visit['visitor_address']; ?>')
        $('#armisrj').val('<?= $visit['isrj']; ?>')
        $('#armkal_id').val('<?= $visit['kal_id']; ?>')
        $('#armspesialistik').val(null)
        $('#armdoctor').val('<?= $visit['fullname']; ?>')
        $('#armclass_room_id').val('<?= $visit['class_room_id']; ?>')
        $('#armbed_id').val('<?= $visit['bed_id']; ?>')
        $('#armresult_id').val(null)
        $('#armkeluar_id').val('<?= $visit['keluar_id']; ?>')
        $('#armin_date').val('<?= $visit['in_date']; ?>')
        $('#armexit_date').val('<?= $visit['exit_date']; ?>')
        $('#armmodified_date').val(get_date())
        $('#armmodified_by').val('<?= $visit['modified_by']; ?>')
        $('#armnokartu').val('<?= $visit['pasien_id']; ?>')
        $('#armpasien_diagnosa_id').val(null)
        $('#armno_registration').val('<?= $visit['no_registration']; ?>')
        $('#armthename').val('<?= $visit['diantar_oleh']; ?>')
        $('#armstatus_pasien_id').val('<?= $visit['status_pasien_id']; ?>')
        $('#armgender').val('<?= $visit['gender']; ?>')
        $('#armageyear').val('<?= $visit['ageyear']; ?>')
        $('#armagemonth').val('<?= $visit['agemonth']; ?>')
        $('#armageday').val('<?= $visit['ageday']; ?>')
        $('#armnosep').val('<?= $visit['no_skpinap'] ?? $visit['no_skp']; ?>')
        $('#armtglsep').val('<?= $visit['visit_date']; ?>')
        $('#armkddpjp').val('<?= $visit['kddpjp']; ?>')
        $('#armstatusantrean').val('<?= $visit['statusantrean']; ?>')


        if (typeof pasienDiagnosa.description !== 'undefined') {
            disableRM()
            $("#formaddrmbtn").hide()
            $("#formeditrm").show()
        }


    }

    function fillDataArm(index) {
        disableARM()
        var pd = pasienDiagnosaAll[index]

        $.each(pd, function(key, value) {
            $("#arm" + key).val(value)
            $("#arm" + key).prop("disabled", true)
        })
        $("#armclinic_id").html('<option value="' + pd.clinic_id + '">' + pd.name_of_clinic + '</option>')
        $("#armemployee_id").html('<option value="' + pd.employee_id + '">' + pd.fullname + '</option>')

        fillPemeriksaanFisik(pd.pasien_diagnosa_id)

        displayTableAssessmentMedis(index)


        if (typeof pasienDiagnosa.description !== 'undefined') {
            disableRM()
            $("#formaddrmbtn").hide()
            $("#formeditrm").show()
        }
    }

    function fillRiwayat() {
        $.each(riwayatAll, function(key, value) {
            $("#armGEN0009" + value.value_id).val(value.histories)
            $("#armGEN0009" + value.value_id).prop("disabled", true)
        })
    }

    function fillPemeriksaanFisik(pasienDiagnosaId) {
        $.each(lokalisAll, function(key, value) {
            if (value.body_id = pasienDiagnosaId) {
                if (value.value_score == 2) {
                    $("#arm" + value.p_type + value.parameter_id + value.value_id).val(value.value_detail);
                    $("#arm" + value.p_type + value.parameter_id + value.value_id).prop("disabled", true)
                } else if (value.value_score == 3) {
                    $("#lokalis" + value.value_id).val(value.value_detail)
                    $("#lokalis" + value.value_id + "desc").val(value.value_desc)
                    var canvas = document.getElementById('canvas' + value.p_type + value.parameter_id + value.value_id);
                    const canvasDataInput = document.getElementById('lokalis' + value.value_id);
                    var context = canvas.getContext('2d');
                    const img = new Image();
                    img.onload = function() {
                        context.drawImage(img, 0, 0, canvas.width, canvas.height);
                    };
                    img.src = "data:image/png;base64," + value.filedata64;
                }
            }
        })
    }

    function enableARM() {
        $("#formsavearmbtn").show()
        $("#formeditarm").hide()
        $("#formaddarm input").prop("disabled", false)
        $("#formaddarm textarea").prop("disabled", false)
        $("#formaddarm select").prop("disabled", false)
        enableCanvasLokalis()
    }

    function disableARM() {
        $("#formsavearmbtn").hide()
        $("#formeditarm").show()
        $("#formaddarm input").prop("disabled", true)
        $("#formaddarm textarea").prop("disabled", true)
        $("#formaddarm select").prop("disabled", true)
        disableCanvasLokalis()
    }

    function enableCanvasLokalis() {
        <?php foreach ($aParameter as $key => $value) {
            if ($value['p_type'] == 'GEN0002')
                foreach ($aValue as $key1 => $value1) {
                    if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id'] && $value1['value_score'] == '3') {
        ?>

                    var canvas = document.getElementById('canvas<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>');
                    canvas.style.pointerEvents = 'auto';

        <?php
                    }
                }
        } ?>
    }

    function disableCanvasLokalis() {
        <?php foreach ($aParameter as $key => $value) {
            if ($value['p_type'] == 'GEN0002')
                foreach ($aValue as $key1 => $value1) {
                    if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id'] && $value1['value_score'] == '3') {
        ?>

                    var canvas = document.getElementById('canvas<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>');
                    canvas.style.pointerEvents = 'none';

        <?php
                    }
                }
        } ?>
    }

    function copyPeriksaFisik() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getPeriksaFisik/<?= $visit['visit_id']; ?>',
            type: "GET",
            dataType: 'json',
            success: function(data) {
                alert("berhasil ambil periksa fisik")
                $("#armpemeriksaan").val(data.periksafisik)
                $("#armanamnase").val(data.anamnase)
            }
        })
    }

    function copyPeriksaLab() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getPeriksaLab/<?= $visit['trans_id']; ?>',
            type: "GET",
            dataType: 'json',
            success: function(data) {
                alert("berhasil ambil periksa lab")
                $("#armpemeriksaan_05").val(data.periksalab)
            }
        })
    }

    function copyPeriksaRad() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getPeriksaRad/<?= $visit['trans_id']; ?>',
            type: "GET",
            dataType: 'json',
            success: function(data) {
                alert("berhasil ambil periksa radiologi")
                $("#armpemeriksaan_03").val(data.periksarad)
            }
        })
    }

    function copyTerapi() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getTerapi/<?= $visit['visit_id']; ?>',
            type: "GET",
            dataType: 'json',
            success: function(data) {
                alert("berhasil ambil data terapi obat")
                $("#armteraphy_desc").val(data.terapi)
            }
        })
    }

    function displayTableAssessmentMedis(index) {
        $("#assessmentMedisHistoryBody").html("")
        $.each(pasienDiagnosaAll, function(key, value) {
            var pd = pasienDiagnosaAll[key]
            if (key == index) {
                $("#assessmentMedisHistoryBody").append($("<tr>")
                    .append($("<td>").append($("<b>").append('<i class="mdi mdi-arrow-collapse-right" style="font-size: large"></i>')))
                    .append($("<td>").append($("<b>").html(value.date_of_diagnosa)))
                    .append($("<td>").append($("<b>").html(value.name_of_clinic)))
                    .append($("<td>").append($("<b>").html(value.fullname)))
                    .append($("<td>").append($('<button class="btn btn-success" onclick="fillDataArm(' + key + ')">').html("Lihat")))
                )
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
            } else {
                $("#assessmentMedisHistoryBody").append($("<tr>")
                    .append($("<td>"))
                    .append($("<td>").html(value.date_of_diagnosa))
                    .append($("<td>").html(value.name_of_clinic))
                    .append($("<td>").html(value.fullname))
                    .append($("<td>").append($('<button class="btn btn-success" onclick="fillDataArm(' + key + ')">').html("Lihat")))
                )
            }
        })
    }
</script>

<script type="text/javascript">
    $("#formaddarm").on('submit', (function(e) {
        saveCanvasData()
        // $("#armstanding_order").val(armstanding_ordereditor.activeEditor.getContent());
        // $("#arminstruction").val(arminstructioneditor.activeEditor.getContent());
        // arminstructioneditor
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/addAssessmentMedis',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(data.message);
                    getAssessmentMedis()
                }
                clicked_submit_btn.button('reset');
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));
    $("#formeditarm").on("click", function() {
        enableARM()
    })
    $("#formaddarmbtn").on("click", function() {
        initialAddArm()
    })
</script>
<script type="text/javascript">

</script>
<script type="text/javascript">
    function addRowDiagMedis(diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
        diagIndex++;
        if (diag_cat == null) {
            diag_cat = 1
        }
        if (diag_cat == null && diagIndex > 1) {
            diag_cat = 2
        }
        $("#bodyDiagMedis")
            .append($('<tr id="diag_medis' + diagIndex + '">')
                // .append($('<td>').html(diagIndex + "."))
                .append($('<td>')
                    .append('<select id="diag_id_medis' + diagIndex + '" class="form-control" name="diag_id[]" onchange="selectedDiag(' + diagIndex + ')" style="width: 100%"></select>')
                    .append('<input id="diag_name_medis' + diagIndex + '" name="diag_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    .append('<input id="sscondition_id_medis' + diagIndex + '" name="sscondition_id[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
                )
                // .append($('<td>')
                //     .append($('<input>').attr('name', 'diag_name[]').attr('id', 'diag_name' + diagIndex).attr('value', diag_name).attr('type', 'text').attr('readonly', 'readonly'))
                // )
                .append($('<td>')
                    .append($("<select class=\"form-control\">")
                        .attr('name', 'suffer_type[]').attr('id', 'suffer_type_medis' + diagIndex) <?php foreach ($suffer as $key => $value) { ?>
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
                .append("<td><a href='#' onclick='$(\"#diag" + diagIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-trash'></i></a></td>")
            );

        initializeDiagSelect2("diag_id" + diagIndex, diag_id, diag_name)
        $("#suffer_type" + diagIndex).val(0)
        $("#diag_cat" + diagIndex).val(diagIndex)
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
</script>

<script type="text/javascript">
    function getAssessmentMedis() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentMedis',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                pasienDiagnosaAll = data.pasienDiagnosa
                riwayatAll = data.pasienHistory
                diagnosasAll = data.pasienDiagnosas
                proceduresAll = data.pasienProcedures
                lokalisAll = data.lokalis

                fillDataArm(pasienDiagnosaAll.length - 1)
                fillRiwayat()
                disableARM()
            },
            error: function() {

            }
        });
    }
</script>