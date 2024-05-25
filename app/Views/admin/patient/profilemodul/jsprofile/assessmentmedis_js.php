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





        // tinymce.init({
        //     selector: '#armstanding_order',
        //     height: 300,
        //     plugins: [
        //         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        //         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        //         "save table contextmenu directionality emoticons template paste textcolor",
        //     ],
        //     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        //     style_formats: [{
        //             title: "Bold text",
        //             inline: "b"
        //         },
        //         {
        //             title: "Red text",
        //             inline: "span",
        //             styles: {
        //                 color: "#ff0000"
        //             }
        //         },
        //         {
        //             title: "Red header",
        //             block: "h1",
        //             styles: {
        //                 color: "#ff0000"
        //             }
        //         },
        //         {
        //             title: "Example 1",
        //             inline: "span",
        //             classes: "example1"
        //         },
        //         {
        //             title: "Example 2",
        //             inline: "span",
        //             classes: "example2"
        //         },
        //         {
        //             title: "Table styles"
        //         },
        //         {
        //             title: "Table row 1",
        //             selector: "tr",
        //             classes: "tablerow1"
        //         },
        //     ],
        // });
        // tinymce.init({
        //     selector: '#arminstruction',
        //     height: 300,
        //     plugins: [
        //         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        //         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        //         "save table contextmenu directionality emoticons template paste textcolor",
        //     ],
        //     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        //     style_formats: [{
        //             title: "Bold text",
        //             inline: "b"
        //         },
        //         {
        //             title: "Red text",
        //             inline: "span",
        //             styles: {
        //                 color: "#ff0000"
        //             }
        //         },
        //         {
        //             title: "Red header",
        //             block: "h1",
        //             styles: {
        //                 color: "#ff0000"
        //             }
        //         },
        //         {
        //             title: "Example 1",
        //             inline: "span",
        //             classes: "example1"
        //         },
        //         {
        //             title: "Example 2",
        //             inline: "span",
        //             classes: "example2"
        //         },
        //         {
        //             title: "Table styles"
        //         },
        //         {
        //             title: "Table row 1",
        //             selector: "tr",
        //             classes: "tablerow1"
        //         },
        //     ],
        // });

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
        // Call each function to append respective accordion items
        $("#accordionAssessmentMedis").html("")
        var accMedisName = "accordionAssessmentMedis"
        // if (<?= ($visit['clinic_id'] == 'P012' && is_null($visit['class_room_id'])) ? true : false; ?>  ) {
        if (true) {
            <?php foreach ($mapAssessment as $key => $value) {
                if ($value['doc_type'] == 1) {

            ?>
                    <?= $value['doc_id']; ?>(accMedisName);
            <?php
                }
            } ?>
            $("#armTitle").html("ASESMEN MEDIS <?= $value['specialist_type'] ?> <?= is_null($visit['class_room_id']) ? 'RAWAT JALAN' : 'RAWAT INAP'; ?>")
        }
        $("#formaddarmbtn").trigger("click")
        $("#armdiag_cat").val(3)
        getAssessmentMedis(3)
    })
    $("#rekammedisTab").on("click", function() {
        $("#armTitle").html("Resume Medis")

        $("#accordionAssessmentMedis").html("")
        appendAnamnesisMedis(accMedisName);
        appendRiwayatMedis(accMedisName);
        appendVitalSignMedis(accMedisName);
        appendSirkulasi(accMedisName);
        appendGcsMedisAccordion(accMedisName);
        appendPemeriksaanFisikMedis(accMedisName);
        appendLokalisAccordion(accMedisName);
        appendDiagnosaAccordion(accMedisName);
        appendProsedurAccordion(accMedisName);
        appendPenunjangTerapi(accMedisName)
        // appendRtlAccordion(accMedisName);
        // appendMedisAccordion(accMedisName);
        generateLokalis()
        $("#formaddarmbtn").trigger("click")
        $("#armdiag_cat").val(1)
        getAssessmentMedis(1)
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
    })
</script>

<script type="text/javascript">
    function generateLokalis() {
        <?php foreach ($aParameter as $key => $value) {
            if ($value['p_type'] == 'GEN0002')
                foreach ($aValue as $key1 => $value1) {
                    if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id'] && $value1['value_score'] == '3') {
                        foreach ($mapAssessment as $key2 => $value2) {
                            if ($value2['doc_id'] == $value1['value_id']) {


        ?>
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
        <?php
                            }
                        }
                    }
                }
        } ?>
    }


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
        const date = new Date();
        var pasienDiagnosaId = '';
        pasienDiagnosaId = date.toISOString().substring(0, 23);
        pasienDiagnosaId = pasienDiagnosaId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

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
        $('#armpasien_diagnosa_id').val(pasienDiagnosaId)
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
        $("#armdiag_cat").val(pd.diag_cat)

        fillPemeriksaanFisik(pd.pasien_diagnosa_id)

        displayTableAssessmentMedis(index)

        getTriage(pd.pasien_diagnosa_id, "bodyTriageMedis")
        getSirkulasi(pd.pasien_diagnosa_id, "bodySirkulasiMedis")
        getGcs(pd.pasien_diagnosa_id, "bodySirkulasiMedis")
        getPainMonitoring(pd.pasien_diagnosa_id, "bodyPainMonitoringMedis")
        getPernapasan(pd.pasien_diagnosa_id, "bodyPernapasanMedis")
        getApgar(pd.pasien_diagnosa_id, "bodyApgarMedis")

        // $("#formsavearmbtn").hide()
        // $("#formeditarm").show()


        if (typeof pasienDiagnosa.description !== 'undefined') {
            disableARM()
            // $("#formaddrmbtn").hide()
            // $("#formeditrm").show()
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
        <?php if (!is_null($visit['class_room_id'])) {
        ?>
            $("#copyVitalSignModal").modal('show')
        <?php
        } else {
        ?>
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
        <?php
        } ?>

    }

    function copyPeriksaLab() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getPeriksaLab/<?= $visit['trans_id']; ?>',
            type: "GET",
            dataType: 'json',
            success: function(data) {
                alert("berhasil ambil periksa lab")
                $("#armlab_result").val(data.periksalab)
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
                $("#armro_result").val(data.periksarad)
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
                    .append($("<td>").html(value.alloanamnase))
                    .append($("<td>").html(value.pemeriksaan))
                    .append($("<td>").html(value.medical_problem))
                    .append($("<td>").html(value.teraphy_desc))
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
                    .append($("<td>").html(value.alloanamnase))
                    .append($("<td>").html(value.pemeriksaan))
                    .append($("<td>").html(value.medical_problem))
                    .append($("<td>").html(value.teraphy_desc))
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
                    getAssessmentMedis($("#armdiag_cat").val())
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
                    .append('<select id="diag_id_medis' + diagIndex + '" class="form-control" name="diag_id[]" onchange="selectedDiagMedis(' + diagIndex + ')" style="width: 100%"></select>')
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

        initializeDiagSelect2("diag_id_medis" + diagIndex, diag_id, diag_name)
        $("#suffer_type" + diagIndex).val(0)
        $("#diag_cat" + diagIndex).val(diagIndex)
    }

    function selectedDiagMedis(index) {
        var diagname = $("#diag_id_medis" + index).text()
        if (typeof diagname !== 'undefined') {
            $("#diag_name_medis" + index).val(diagname)
        }
    }

    function addRowProcMedis(diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
        procIndex++
        $("#bodyProcMedis")
            .append($('<tr id="procmedis' + procIndex + '">')
                // .append($('<td>').html(diagIndex + "."))
                .append($('<td style="width: 90%">')
                    .append('<div class="p-2 select2-full-width"><select id="proc_idmedis' + procIndex + '" onchange="selectedProcMedis(' + procIndex + ')" class="form-control" name="proc_id[]" ></select></div>')
                    .append('<input id="proc_namemedis' + procIndex + '" name="proc_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
                )
                .append("<td><a href='#' onclick='$(\"#procmedis" + procIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-remove'></i></a></td>")
            );

        initializeProcSelect2("proc_idmedis" + procIndex, diag_id, diag_name)
    }

    function selectedProcMedis(index) {
        var diagname = $("#proc_idmedis" + index).text()
        console.log(diagname)
        if (typeof diagname !== 'undefined') {
            $("#proc_namemedis" + index).val(diagname)
        }
    }
</script>

<script type="text/javascript">
    function getAssessmentMedis(diagCat) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentMedis',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'diagCat': diagCat
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

                if (pasienDiagnosaAll.length > 0) {
                    fillDataArm(pasienDiagnosaAll.length - 1)
                    fillRiwayat()
                    disableARM()
                    $("#formaddarmbtn").hide()
                }
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addGcsMedis(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = gcsAll[index].body_id
        }
        $("#bodyGcsMedis").append(
            $('<form id="formGcsMedis' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("GCSMedis"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'GEN0011') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?> <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                                ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        }
                                            ?> <?php }
                                                                                    if ($value['parameter_id'] == '09') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="row">')
                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                .append($('<div class="col-md-8">')
                                    .append($('<select id="GCS_SCORE' + bodyId + '" name="GCS_SCORE" class="form-control">')
                                        .append('<option>-</option>')
                                        .append('<option value="1">Ringan</option>')
                                        .append('<option value="2">Sedang</option>')
                                        .append('<option value="3">Berat</option>')
                                    )
                                )
                            )
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formGcsMedisSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formGcsMedisEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        $("#GEN001101" + bodyId).on("change", function() {
            var e = $("#GEN001101" + bodyId).val()
            var m = $("#GEN001102" + bodyId).val()
            var v = $("#GEN001103" + bodyId).val()

            var totalScore = parseInt(e) + parseInt(m) + parseInt(v)
            var conclutionScore = 0
            if (totalScore >= 3 && totalScore <= 8)
                conclutionScore = 3
            if (totalScore > 8 && totalScore <= 12)
                conclutionScore = 2
            if (totalScore > 12 && totalScore <= 15)
                conclutionScore = 1


            $('GCS_SCORE' + bodyId).val(conclutionScore)
        })
        $("#GEN001102" + bodyId).on("change", function() {
            var e = $("#GEN001101" + bodyId).val()
            var m = $("#GEN001102" + bodyId).val()
            var v = $("#GEN001103" + bodyId).val()

            var totalScore = parseInt(e) + parseInt(m) + parseInt(v)
            var conclutionScore = 0
            if (totalScore >= 3 && totalScore <= 8)
                conclutionScore = 3
            if (totalScore > 8 && totalScore <= 12)
                conclutionScore = 2
            if (totalScore > 12 && totalScore <= 15)
                conclutionScore = 1


            $('GCS_SCORE' + bodyId).val(conclutionScore)
        })
        $("#GEN001103" + bodyId).on("change", function() {
            var e = $("#GEN001101" + bodyId).val()
            var m = $("#GEN001102" + bodyId).val()
            var v = $("#GEN001103" + bodyId).val()

            var totalScore = parseInt(e) + parseInt(m) + parseInt(v)
            var conclutionScore = 0
            if (totalScore >= 3 && totalScore <= 8)
                conclutionScore = 3
            if (totalScore > 8 && totalScore <= 12)
                conclutionScore = 2
            if (totalScore > 12 && totalScore <= 15)
                conclutionScore = 1


            $('#GCS_SCORE' + bodyId).val(conclutionScore)
        })

        $("#formGcsMedisEditBtn" + bodyId).on("click", function() {
            $("#formGcsMedisSaveBtn" + bodyId).show()
            $("#formGcsMedisEditBtn" + bodyId).hide()
            $("#formGcsMedis" + bodyId).find("input, select, textarea").prop("disabled", false)
        })

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'GEN0011' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                    } else {
                        console.log($(this).val())
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '').hide()
                    }
                });
        <?php
            }
        } ?>

        $("#formGcsMedis" + bodyId).append('<input name="org_unit_code" id="gcsmedisorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="gcsmedisvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="gcsmedistrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="gcsmedisbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="gcsmedisdocument_id' + bodyId + '" type="hidden" value="' + $("#armpasien_diagnosa_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="gcsmedisno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="gcsmedisp_type' + bodyId + '" type="hidden" value="GEN0011" class="form-control" />')
        $("#formGcsMedis" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveGcs',
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
                    $("#formGcsMedisSaveBtn" + bodyId).hide()
                    $("#formGcsMedisEditBtn" + bodyId).show()
                    $("#formGcsMedis" + bodyId).find("input, select, textarea").prop("disabled", true)

                    clicked_submit_btn.button('reset');
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                    errorMsg(xhr);
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


        if (flag == 1) {
            $("#formGcsMedisSaveBtn" + bodyId).show()
            $("#formGcsMedisEditBtn" + bodyId).hide()
            $("#formGcsMedis" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {
            var gcs = gcsAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'GEN0011') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(gcs.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (gcs.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'GEN0011' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(gcs.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $.each(GcsDetailAll, function(key, value) {
                if (value.body_id == Gcs.body_id) {
                    console.log("#val" + value.p_type + value.value_id + bodyId)
                    $("#val" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                }
            })

            $("#formGcsMedisSaveBtn" + bodyId).hide()
            $("#formGcsMedisEditBtn" + bodyId).show()
            $("#formGcsMedis" + bodyId).find("input, select, textarea").prop("disabled", true)
        }
        index++
        $("#addGcsButton").html('<a onclick="addGcs(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getGcs(bodyId) {
        $("#bodyGcs").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getGcs',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': bodyId
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                gcsAll = data.gcs
                gcsDetailAll = data.gcsDetail

                $.each(gcsAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addGcs(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

<script type="text/javascript">
    function displayTableAssessmentKeperawatanForVitalSign() {
        $("#copyListVitalSignModal").html("")
        $.each(examForassessment, function(key, value) {
            var pd = examForassessment[key]
            if (value.body_id == $("#armbody_id")) {
                $("#copyListVitalSignModal").append($("<tr>")
                    .append($("<td>").append($("<b>").append('<i class="mdi mdi-arrow-collapse-right" style="font-size: large"></i>')))
                    .append($("<td>").append($("<b>").html(value.examination_date)))
                    .append($("<td>").append($("<b>").html(value.petugas_id)))
                    .append($("<td>").append($("<b>").html(value.weight)))
                    .append($("<td>").append($("<b>").html(value.height)))
                    .append($("<td>").append($("<b>").html(value.temperature)))
                    .append($("<td>").append($("<b>").html(value.nadi)))
                    .append($("<td>").append($("<b>").html(value.tension_upper)))
                    .append($("<td>").append($("<b>").html(value.tension_below)))
                    .append($("<td>").append($("<b>").html(value.saturasi)))
                    .append($("<td>").append($("<b>").html(value.nafas)))
                    .append($("<td>").append($("<b>").html(value.arm_diameter)))
                    .append($("<td>").append($("<b>").append($('<button class="btn btn-success" onclick="fillVitalSignMedis(' + key + ')">').html("Copy"))))
                )
                $("#copyListVitalSignModal").append($("<tr>")
                    .append($("<td>").append($("<b>").append('<i class="mdi mdi-arrow-collapse-right" style="font-size: large"></i>')))
                    .append($("<td>").append($("<b>").html(value.examination_date)))
                    .append($("<td>").append($("<b>").html(value.name_of_clinic)))
                    .append($("<td>").append($("<b>").html(value.fullname)))
                    .append($("<td>").append($('<button class="btn btn-success" onclick="fillDataArp(' + key + ')">').html("Lihat")))
                )
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
            } else {
                $("#copyListVitalSignModal").append($("<tr>")
                    .append($("<td>"))
                    .append($("<td>").html(value.examination_date))
                    .append($("<td>").html(value.petugas_id))
                    .append($("<td>").html(value.weight))
                    .append($("<td>").html(value.height))
                    .append($("<td>").html(value.temperature))
                    .append($("<td>").html(value.nadi))
                    .append($("<td>").html(value.tension_upper))
                    .append($("<td>").html(value.tension_below))
                    .append($("<td>").html(value.saturasi))
                    .append($("<td>").html(value.nafas))
                    .append($("<td>").html(value.arm_diameter))
                    .append($("<td>").append($('<button class="btn btn-success" onclick="fillVitalSignMedis(' + key + ')">').html("Copy")))
                )
            }
        })
    }

    function fillVitalSignMedis(index) {
        var ex = examForassessment[index]
        $("#armpemeriksaan").val('BB: ' + ex.weight + 'Kg; TB: ' + ex.height + 'cm; ' +
            ex.temperature + '°C; ' +
            ex.nadi + '/menit; ' +
            ex.tension_upper + 'mmHg; ' +
            ex.tension_below + 'mmHg; ' +
            ex.saturasi + 'SpO2%; ' +
            ex.nafas + '/menit; ' +
            ex.arm_diameter + 'cm; ')
        $("#armbody_id").val(ex.body_id)
        $("#copyVitalSignModal").modal('hide')
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#armGcs_Group").hide()
        $("#arpFallRisk_Group").hide()
        $("#armLokalis_Group").hide()
        $("#armProcedures_Group").hide()
        $("#vitalsign").hide()
        $("#armDiagnosas_Group").hide()
        $("#armPenunjang_Group").hide()
        $("#armProcedures_Group").hide()
        $("#armRtl_Group").hide()
        $("#arpEdukasiIntegrasi_Group").hide()
        $("#arpEdukasiForm_Group").hide()
        <?php foreach ($mappingAssessment as $key => $value) {
        ?>
            $("#<?= $value['id']; ?>").show()
        <?php
        } ?>
    })
</script>
<script>
    function appendAnamnesisMedis(accordionId) {
        $("#" + accordionId).append(
            '<div class="accordion-item">' +
            '<h2 class="accordion-header" id="headingSubyektif">' +
            '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubyektif" aria-expanded="false" aria-controls="collapseSubyektif"><b>ANAMNESIS</b></button>' +
            '</h2>' +
            '<div id="collapseSubyektif" class="accordion-collapse collapse" aria-labelledby="headingSubyektif" data-bs-parent="#accordionAssessmentMedis">' +
            '<div class="accordion-body text-muted">' +
            '<div class="row">' +
            '<div class="col-sm-6 col-xs-12">' +
            '<div class="mb-3">' +
            '<div class="form-group">' +
            '<label for="armanamnase">Autoanamnesis</label>' +
            '<textarea id="armanamnase" name="anamnase" rows="2" class="form-control " autocomplete="off"></textarea>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-sm-6 col-xs-12">' +
            '<div class="mb-3">' +
            '<div class="form-group">' +
            '<label for="armalloanamnase">Alloanamnesis</label>' +
            '<textarea id="armalloanamnase" name="alloanamnase" rows="2" class="form-control " autocomplete="off"></textarea>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        )
    }

    function appendVitalSignMedis(accordionId) {
        $("#" + accordionId).append(
            '<div class="accordion-item">' +
            '<h2 class="accordion-header" id="headingVitalSign">' +
            '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVitalSign" aria-expanded="false" aria-controls="collapseVitalSign"><b>VITAL SIGN</b></button>' +
            '</h2>' +
            '<div id="collapseVitalSign" class="accordion-collapse collapse" aria-labelledby="headingVitalSign" data-bs-parent="#accordionAssessmentMedis">' +
            '<div class="accordion-body text-muted">' +
            '<div class="row mb-2">' +
            '<div class="col-sm-12 col-xs-12">' +
            '<div class="mb-3">' +
            '<div class="form-group">' +
            '<label for="armpemeriksaan">Vital Sign <a id="copyPeriksaFisikBtn" href="#" onclick="copyPeriksaFisik()">(Copy)</a></label>' +
            '<textarea id="armpemeriksaan" name="pemeriksaan" rows="5" class="form-control " autocomplete="off"></textarea>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        )
    }

    function appendRiwayatMedis(accordionId) {
        $("#" + accordionId).append(
            '<div class="accordion-item">' +
            '<h2 class="accordion-header" id="headingRiwayatMedis">' +
            '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRiwayatMedis" aria-expanded="false" aria-controls="collapseRiwayatMedis"><b>RIWAYAT</b></button>' +
            '</h2>' +
            '<div id="collapseRiwayatMedis" class="accordion-collapse collapse" aria-labelledby="headingRiwayatMedis" data-bs-parent="#accordionAssessmentMedis" style="">' +
            '<div class="accordion-body text-muted">' +
            '<div class="row">' +
            '<div class="col-sm-6 col-xs-12">' +
            '<div class="mb-3">' +
            '<div class="form-group">' +
            '<label for="armdescription">Riwayat Penyakit Sekarang</label>' +
            '<textarea id="armdescription" name="description" rows="2" class="form-control " autocomplete="off"></textarea>' +
            '</div>' +
            '</div>' +
            '</div>' +
            <?php foreach ($aValue as $key => $value) {
                if ($value['p_type'] == 'GEN0009') {
            ?> '<div class="col-sm-6 col-xs-12">' +
                    '<div class="mb-3">' +
                    '<div class="form-group">' +
                    '<label for="arm<?= $value['p_type'] . $value['value_id']; ?>"><?= $value['value_desc']; ?></label>' +
                    '<textarea id="arm<?= $value['p_type'] . $value['value_id']; ?>" name="<?= $value['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
            <?php
                }
            } ?> '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        )
    }

    function appendPemeriksaanFisikMedis(accordionId) {
        $("#" + accordionId).append(
            '<div class="accordion-item">' +
            '<h2 class="accordion-header" id="headingBodyPart">' +
            '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBodyPart" aria-expanded="false" aria-controls="collapseBodyPart">' +
            '<b>PEMERIKSAAN FISIK</b>' +
            '</button>' +
            '</h2>' +
            '<div id="collapseBodyPart" class="accordion-collapse collapse" aria-labelledby="headingBodyPart" data-bs-parent="#accordionAssessmentMedis" style="">' +
            '<div class="accordion-body text-muted">' +
            '<div class="row">' +
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'GEN0002')
                    foreach ($aValue as $key1 => $value1) {
                        if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id'] && $value1['value_score'] == '2') {
            ?> '<div class="col-sm-6 col-xs-12">' +
                        '<div class="mb-3">' +
                        '<div class="form-group">' +
                        '<label for="arm<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>"><?= $value1['value_desc']; ?></label>' +
                        '<textarea id="arm<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>" name="fisik<?= $value1['value_id']; ?>" rows="2" class="form-control " autocomplete="off"></textarea>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
            <?php
                        }
                    }
            } ?> '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        )
    }

    function appendPenunjangTerapi(accordionId) {
        var accordionContent = `
                <div id="armPenunjang_Group" class="accordion-item">
                    <h2 class="accordion-header" id="headingPenunjang">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePenunjang" aria-expanded="false" aria-controls="collapsePenunjang">
                            <b>PENUNJANG DAN TERAPI</b>
                        </button>
                    </h2>
                    <div id="collapsePenunjang" class="accordion-collapse collapse" aria-labelledby="headingPenunjang" data-bs-parent="#accordionAssessmentMedis">
                        <div class="accordion-body text-muted">
                            <div class="row mb-2">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="mb-3">
                                        <h4>PEMERIKSAAN DIAGNOSTIK PENUNJANG</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armlab_result">Periksa Lab <a id="copyPeriksaLabBtn" href="#" onclick="copyPeriksaLab()">(Copy)</a></label>
                                            <textarea id="armlab_result" name="lab_result" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armro_result">Periksa RO <a id="copyPeriksaRadBtn" href="#" onclick="copyPeriksaRad()">(Copy)</a></label>
                                            <textarea id="armro_result" name="ro_result" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armecg_result">Periksa EKG</label>
                                            <textarea id="armecg_result" name="ecg_result" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="mb-3">
                                        <h4>RENCANA ASUHAN DAN TERAPI</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armteraphy_desc">Farmakoterapi <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                            <textarea id="armteraphy_desc" name="teraphy_desc" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armteraphy_home">Obat Pulang <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                            <textarea id="armteraphy_home" name="teraphy_home" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="armtherapy_target">Target Sasaran Terapi <a id="copyTerapiBtn" href="#" onclick="copyTerapi()">(Copy)</a></label>
                                            <textarea id="armtherapy_target" name="therapy_target" rows="2" class="form-control " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

        $("#" + accordionId).append(accordionContent);
    }

    function appendAccordionItem(accordionId, accordionContent) {
        $("#" + accordionId).append(accordionContent);
    }

    var stringdiagnosa = `<div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="mb-4">
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table id="tablediagnosaMedis" class="table" data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                            <?php if (true) { ?>
                                                <thead>
                                                    <th class="text-center" style="width: 40%">Diagnosa</th>
                                                    <th class="text-center" style="width: 20%">Jenis Kasus</th>
                                                    <th class="text-center" style="width: 40%" colspan="2">Kategori Diagnosis</th>
                                                </thead>
                                                <tbody id="bodyDiagMedis">
                                                </tbody>
                                            <?php }   ?>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="formdiag" name="adddiagnosa" onclick="addRowDiagMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Diagnosa</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>`;

    function appendDiagnosaAccordion(accordionId) {
        var accordionContent = `
        <div id="armDiagnosas_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingDiagnosa">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosa" aria-expanded="false" aria-controls="collapseDiagnosa">
                    <b>ASSESSMENT (A)</b>
                </button>
            </h2>
            <div id="collapseDiagnosa" class="accordion-collapse collapse" aria-labelledby="headingDiagnosa" data-bs-parent="#accordionAssessmentMedis">
                <div class="accordion-body text-muted">
                    <div class="row mb-2">
                        <div class="col-sm-6 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armmedical_problem">Permasalahan Medis</label>
                                    <textarea id="armmedical_problem" name="medical_problem" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armhurt">Penyebab Cidera/Keracunan</label>
                                    <textarea id="armhurt" name="hurt" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armdiag_desc">Diagnosa Klinis</label>
                                    <textarea id="diag_desc" name="hurt" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendProsedurAccordion(accordionId) {
        var accordionContent = `
        <div id="armProcedures_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingProsedur">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProsedur" aria-expanded="false" aria-controls="collapseProsedur">
                    <b>PLANNING (P)</b>
                </button>
            </h2>
            <div id="collapseProsedur" class="accordion-collapse collapse" aria-labelledby="headingProsedur" data-bs-parent="#accordionAssessmentMedis">
                <div class="accordion-body text-muted">
                    <div class="row mb-2">
                        <div class="col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="armstanding_order" class="mb-4 badge bg-primary">Standing Order </label>
                                    <textarea id="armstanding_order" name="standing_order" rows="2" class="form-control " autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="mb-4">
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table id="tableprocedure" class="table table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                            <?php if (true) { ?>
                                                <thead>
                                                    <th colspan="2">Prosedur (ICD IX)</th>
                                                </thead>
                                                <tbody id="bodyProcMedis">
                                                </tbody>
                                            <?php }   ?>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="addprocedure" onclick="addRowProcMedis()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Prosedur</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);

        tinymce.init({
            selector: '#armstanding_order',
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor",
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [{
                    title: "Bold text",
                    inline: "b"
                },
                {
                    title: "Red text",
                    inline: "span",
                    styles: {
                        color: "#ff0000"
                    }
                },
                {
                    title: "Red header",
                    block: "h1",
                    styles: {
                        color: "#ff0000"
                    }
                },
                {
                    title: "Example 1",
                    inline: "span",
                    classes: "example1"
                },
                {
                    title: "Example 2",
                    inline: "span",
                    classes: "example2"
                },
                {
                    title: "Table styles"
                },
                {
                    title: "Table row 1",
                    selector: "tr",
                    classes: "tablerow1"
                },
            ],
        });
    }



    function appendLokalisAccordion(accordionId) {
        var accordionContent = `
        <div id="armLokalis_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingLokalis">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLokalis" aria-expanded="false" aria-controls="collapseLokalis">
                    <b>LOKALIS</b>
                </button>
            </h2>
            <div id="collapseLokalis" class="accordion-collapse collapse" aria-labelledby="headingLokalis" data-bs-parent="#accordionAssessmentMedis">
                <div class="accordion-body text-muted">
                    <div class="row mb-2">
                        <?php foreach ($aParameter as $key => $value) {
                            if ($value['p_type'] == 'GEN0002')
                                foreach ($aValue as $key1 => $value1) {
                                    if ($value['p_type'] == $value1['p_type'] && $value['parameter_id'] == $value1['parameter_id'] && $value1['value_score'] == '3') {
                                        foreach ($mapAssessment as $key2 => $value2) {
                                            if ($value2['doc_id'] == $value1['value_id']) {
                        ?>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-4">
                                    <h5 class="font-size-14 mb-4 badge bg-primary"><?= $value1['value_desc']; ?>:</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <canvas id="canvas<?= $value1['p_type'] . $value1['parameter_id'] . $value1['value_id']; ?>" width="450" height="450" style="border: 1px solid #000;"></canvas>
                                            <input type="hidden" name="lokalis<?= $value1['value_id']; ?>" id="lokalis<?= $value1['value_id']; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lokalis<?= $value1['value_id']; ?>desc">Deskripsi</label>
                                                <textarea name="lokalis<?= $value1['value_id']; ?>desc" id="lokalis<?= $value1['value_id']; ?>desc" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button id="undo<?= $value1['value_id'] ?>" class="btn btn-primary" type="button"> Undo</button>
                                            <button id="clear<?= $value1['value_id'] ?>" class="btn btn-danger" type="button"> Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        <?php
                                            }
                                        }
                                    }
                                }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);

        generateLokalis()
    }

    function appendGcsMedisAccordion(accordionId) {
        var accordionContent = `
        <div id="arpGcsMedis_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingGcsMedis">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGcsMedis" aria-expanded="false" aria-controls="collapseGcs">
                    <b>GLASGOW COMA SCALE (GCS)</b>
                </button>
            </h2>
            <div id="collapseGcsMedis" class="accordion-collapse collapse" aria-labelledby="headingGcsMedis" data-bs-parent="#accordionAssessmentMedis" style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bodyGcsMedis">
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div id="addGcsMedisButton" class="box-tab-tools text-center">
                                        <a onclick="addGcsMedis(1,0)" class="btn btn-primary btn-lg" id="addGcsMedisBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);
    }

    function appendRtlAccordion(accordionId) {
        var accordionContent = `
        <div id="armRtl_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingrtl">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRtl" aria-expanded="false" aria-controls="collapseRtl">
                    <b>RENCANA TINDAK LANJUT</b>
                </button>
            </h2>
            <div id="collapseRtl" class="accordion-collapse collapse" aria-labelledby="headingrtl" data-bs-parent="#accordionAssessmentMedis">
                <div class="accordion-body text-muted">
                    <div class="row mb-2">
                        <div class="row">
                            <div class="col-sm-4 col-md-3">
                                <div class="mb-3">
                                    <div id="armrujukan_group" class="form-group">
                                        <label>Rencana Tindak Lanjut</label>
                                        <select name="rencanatl" id="armrencanatl" onchange="tindakLanjut()" class="form-control ">
                                            <option value="1">Diperbolehkan Pulang</option>
                                            <option value="2">Pemeriksaan Penunjang</option>
                                            <option value="3">Dirujuk ke</option>
                                            <option value="4">Kontrol Kembali</option>
                                            <option value="5">Rawat Inap</option>
                                            <option value="6">Rujuk Internal Antar Poli</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <div class="mb-3">
                                    <div id="armtiperujukan_group" class="form-group" style="display: none">
                                        <label>Tipe Rujukan</label>
                                        <select name="tiperujukan" id="armtiperujukan" onchange="tindakLanjut()" class="form-control ">
                                            <option value="1">Penuh</option>
                                            <option value="2">Parsial</option>
                                            <option value="3">PRB</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="armdirujukkegroup" class="col-sm-4 col-md-3" style="display: none">
                                <div class="mb-3">
                                    <div class="form-group"><label for="diag_awal">Dirujuk Ke</label>
                                        <div class="select2-full-width" style="width:100%">
                                            <select class="form-control  patient_list_ajax" name='dirujukke' id="armdirujukke" style="width: 100%">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="armtgl_kontrolgroup" class="col-sm-4 col-md-3" style="display: none">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Tanggal Kontrol</label>
                                        <div class="input-group" id="armtglkontrol">
                                            <input id="armtgl_kontrol" name="tgl_kontrol" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#artglkontrol' value="<?= date('Y-m-d'); ?>">

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="armkdpoli_kontrolgroup" class="col-sm-4 col-md-3" style="display: none">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>Ke Poli</label>
                                        <select name="kdpoli_kontrol" id="armkdpoli_kontrol" class="form-control ">
                                            <?php $cliniclist = array();
                                            foreach ($clinic as $key => $value) {
                                                if ($clinic[$key]['stype_id'] == '1') {
                                                    $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                                }
                                            }
                                            asort($cliniclist);
                                            ?>
                                            <?php foreach ($cliniclist as $key => $value) { ?>
                                                <option value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="armdescriptiongroup" class="col-sm-8 col-md-3" style="display: none">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="pwd">Alasan/Ket</label>
                                        <textarea id="armprocedure_05" name="procedure_05" rows="1" class="form-control " autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-4">
                            <div id="armskdpgroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                <div class="mb-4">
                                    <h3>Pembuatan SKDP</h3>
                                    <div class="staff-members">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Nomor SKDP</label>
                                                    <input id="armskdp" name="skdp" placeholder="" type="text" class="form-control " value="" readonly>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" id="addskdp" onclick="postKontrol(1)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="deleteskdp" onclick="deleteKontrol(1)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="armsprigroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                <div class="mb-4">
                                    <h3>Pembuatan SPRI</h3>
                                    <div class="staff-members">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Nomor SPRI</label>
                                                    <input id="armspri" name="spri" placeholder="" type="text" class="form-control " value="" readonly>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" id="addspri" onclick="postKontrol(2)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="deletespri" onclick="deleteKontrol(2)" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="armrujukaneksternalgroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                <div class="mb-4">
                                    <h3>Pembuatan Rujukan Eksternal</h3>
                                    <div class="staff-members">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Nomor Rujukan</label>
                                                    <input id="armnorujukan" name="norujukan" placeholder="" type="text" class="form-control " value="" readonly>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" id="addnorujukan" onclick="postRujukan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="deleterujukan" onclick="deleteRujukan()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="armrujukaninternalgroup" class="col-sm-12 col-md-6 col-lg-6" style="display: none">
                                <div class="mb-4">
                                    <h3>Pembuatan Rujukan Internal</h3>
                                    <div class="staff-members">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Tanggal Rencana</label>
                                                    <input id="rujintvisitdate" name=" rujintvisitdate" type="date" class="form-control" placeholder="yyyy-mm-dd" value="<?= date('Y-m-d'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Poli Tujuan</label>
                                                    <select name='rujintclinicid' id="rujintclinicid" class="form-control select2 act" style="width:100%">
                                                        <?php $cliniclist = array();
                                                        foreach ($clinic as $key => $value) {
                                                            if ($clinic[$key]['stype_id'] == '1') {
                                                                $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                                            }
                                                        }
                                                        asort($cliniclist);
                                                        ?>
                                                        <?php foreach ($cliniclist as $key => $value) { ?>
                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                        <?php } ?>
                                                    </select> <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label>Dokter Tujuan</label>
                                                    <select name='rujintemployeeid' id="rujintemployeeid" class="form-control select2 act" style="width:100%">
                                                        <?php $dokterlist = array();
                                                        foreach ($dokter as $key => $value) {
                                                            if ($key == 'P003') {
                                                                foreach ($value as $key1 => $value1) {
                                                                    $dokterlist[$key1] = $value1;
                                                                }
                                                            }
                                                        }
                                                        asort($dokterlist);
                                                        ?>
                                                        <?php foreach ($dokterlist as $key => $value) { ?>
                                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-tab-tools" style="text-align: center;">
                                            <button type="button" id="addnorujukan" onclick="postRujukInternal()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <button type="button" id="deleterujukan" onclick="deleteRujukInternal()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <span>Delete</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);
    }

    function appendMedisAccordion(accordionId) {
        var accordionContent = `
        <div class="accordion-item">
            <h2 class="accordion-header" id="medis">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsemedis" aria-expanded="true" aria-controls="collapsemedis">
                    <b>MEDIS</b>
                </button>
            </h2>
            <div id="collapsemedis" class="accordion-collapse collapse" aria-labelledby="medis" data-bs-parent="#accodrionFormRm">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <ul id="medisListLinkAll" class="list-group list-group-flush">
                                <input id="armpasien_diagnosa_id" type="hidden" value="asdf">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);
    }

    function appendPainMonitoringMedisAccordion(accordionId) {
        var accordionContent = `
        <div id="arpPainMonitoring_Group" class="accordion-item">
            <h2 class="accordion-header" id="painMonitoringMedis">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsepainMonitoringMedis" aria-expanded="true" aria-controls="collapsepainMonitoringMedis">
                    <b>MONITORING SKALA NYERI</b>
                </button>
            </h2>
            <div id="collapsepainMonitoringMedis" class="accordion-collapse collapse" aria-labelledby="painMonitoringMedis" data-bs-parent="#accordionAssessmentMedis" style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <form id="formassessmentigd" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="col-md-12">
                                <div id="bodyPainMonitoringMedis">
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div id="addPainMonitoringButton" class="box-tab-tools text-center">
                                            <a onclick="addPainMonitoring(1,0,'armpasien_diagnosa_id', 'bodyPainMonitoringMedis')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);
    }

    function appendFallRiskMedisAccordion(accordionId) {
        var accordionContent = `
        <div id="arpFallRisk_Group" class="accordion-item">
            <h2 class="accordion-header" id="FallRiskMedis">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFallRiskMedis" aria-expanded="true" aria-controls="collapseFallRiskMedis">
                    <b>RESIKO JATUH</b>
                </button>
            </h2>
            <div id="collapseFallRiskMedis" class="accordion-collapse collapse" aria-labelledby="FallRiskMedis" data-bs-parent="#accordionAssessmentMedis" style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <form id="formassessmentigd" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="col-md-12">
                                <div id="bodyFallRiskMedis">
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div id="addFallRiskButton" class="box-tab-tools text-center">
                                            <a onclick="addFallRisk(1,0,'armpasien_diagnosa_id', 'bodyFallRiskMedis')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    `;
        appendAccordionItem(accordionId, accordionContent);
    }

    function appendTriaseMedis(accordionId) {
        var accordionContent = `
            <div id="arpTriage_Group" class="accordion-item">
                <h2 class="accordion-header" id="triaseMedis">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetriaseMedis" aria-expanded="true" aria-controls="collapsetriaseMedis">
                        <b>TRIASE</b>
                    </button>
                </h2>
                <div id="collapsetriaseMedis" class="accordion-collapse collapse" aria-labelledby="triaseMedis" data-bs-parent="#accordionAssessmentMedis" style="">
                    <div class="accordion-body text-muted">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="bodyTriageMedis">
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div id="addTriageButton" class="box-tab-tools text-center">
                                            <a onclick="addTriage(1,0,'armpasien_diagnosa_id', 'bodyTriageMedis')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        appendAccordionItem(accordionId, accordionContent);
    }

    function appendFormEdukasi(accordionId) {
        var accordionContent = `
            <div id="arpEdukasiForm_Group" class="accordion-item">
                <h2 class="accordion-header" id="headingEducationForm">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEducationForm" aria-expanded="false" aria-controls="collapseEducationForm">
                        <b>FORMULIR PEMBERIAK EDUKASI</b>
                    </button>
                </h2>
                <div id="collapseEducationForm" class="accordion-collapse collapse" aria-labelledby="headingEducationForm" data-bs-parent="#accordionAssessmentMedis" style="">
                    <div class="accordion-body text-muted">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="bodyEducationForm">
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div id="addEducationFormButton" class="box-tab-tools text-center">
                                            <a onclick="addEducationForm(1,0,'armpasien_diagnosa_id', 'bodyTriageMedis')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendSirkulasi(accordionId) {
        var accordionContent = `
        <div id="armSirkulasi_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingSirkulasiMedis">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSirkulasiMedis" aria-expanded="false" aria-controls="collapseSirkulasiMedis">
                    <b>SIRKULASI</b>
                </button>
            </h2>
            <div id="collapseSirkulasiMedis" class="accordion-collapse collapse" aria-labelledby="headingSirkulasiMedis" data-bs-parent="#accordionAssessmentMedis" style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bodySirkulasiMedis">
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div id="addSirkulasiButton" class="box-tab-tools text-center">
                                        <a onclick="addSirkulasi(1,0,'armpasien_diagnosa_id', 'bodySirkulasiMedis')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendPernapasan(accordionId) {
        var accordionContent = `
        <div id="arpPernapasan_Group" class="accordion-item">
            <h2 class="accordion-header" id="headingPernapasan">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePernapasan" aria-expanded="false" aria-controls="collapsePernapasan">
                    <b>PERNAPASAN</b>
                </button>
            </h2>
            <div id="collapsePernapasan" class="accordion-collapse collapse" aria-labelledby="headingPernapasan" data-bs-parent="#accodrionAssessmentAwal" style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bodyPernapasanMedis">
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div id="addPernapasanButton" class="box-tab-tools text-center">
                                        <a onclick="addPernapasan(1,0, 'armpasien_diagnosa_id', 'bodyPernapasanMedis')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        appendAccordionItem(accordionId, accordionContent);

    }

    function appendApgarAccordion(accordionId) {
        var accordionContent = `
        <div id="arpApgar_Group" class="accordion-item">
            <h2 class="accordion-header" id="apgarMedis">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseapgarMedis" aria-expanded="true" aria-controls="collapseapgarMedis">
                    <b>APGAR</b>
                </button>
            </h2>
            <div id="collapseapgarMedis" class="accordion-collapse collapse" aria-labelledby="apgarMedis" data-bs-parent="#accodrionAssessmentAwal" style="">
                <div class="accordion-body text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bodyApgarMedis">
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div id="addApgarButton" class="box-tab-tools text-center">
                                        <a onclick="addApgar(1,0,\'armpasien_diagnosa_id\', \'bodyApgarMedis\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        appendAccordionItem(accordionId, accordionContent);

    }
</script>


<script>
    $(document).ready(function() {
        $("#chargesTab").trigger("click")
        $("#assessmentmedisTab").trigger("click")
    })
</script>