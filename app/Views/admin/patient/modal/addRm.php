<script type="text/javascript">
    var historyJson = new Array();
    var currentIndex;
    var indexLength;
    $(document).ready(function(e) {})
</script>


<script type="text/javascript">
    $('#ardirujukke').select2({
        ajax: {
            url: '<?= base_url(); ?>admin/patient/getPPKRujukan',
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



    function getDataFillRekamMedis() {
        $.ajax({
            url: baseurl + 'admin/patient/getDataFillRekamMedis',
            type: "POST",
            data: {
                visit_id: '<?= $visit['visit_id']; ?>',
                no_registration: '<?= $visit['no_registration']; ?>'
            },
            dataType: 'json',
            success: function(data) {
                if (data) {

                } else {

                }
            },
        });

    }

    function getHistoryRekamMedis() {
        historyJson = <?= json_encode($pasienDiagnosaAll); ?>;
        // $.ajax({
        //     url: baseurl + 'admin/patient/getHistoryRekamMedis',
        //     type: "POST",
        //     data: {
        //         visit_id: '<?= $visit['visit_id']; ?>',
        //         no_registration: '<?= $visit['no_registration']; ?>'
        //     },
        //     dataType: 'json',
        //     success: function(data) {
        //         if (data) {
        currentIndex = 0
        // historyJson = data
        indexLength = historyJson.length
        updateHistory(currentIndex)
        // $("#arhdescription").val(data[0].description);
        // $("#arhdiagnosa_desc_05").val(data[0].diagnosa_desc_05);
        // $("#arhdiagnosa_desc_06").val(data[0].diagnosa_desc_06);
        // $("#arhanamnase").val(data[0].anamnase);
        // $("#arhpemeriksaan").val(data[0].pemeriksaan);
        // $("#arhpemeriksaan_02").val(data[0].pemeriksaan_02);
        // $("#arhpemeriksaan_03").val(data[0].pemeriksaan_03);
        // $("#arhpemeriksaan_05").val(data[0].pemeriksaan_05);
        // $("#arhteraphy_desc").val(data[0].teraphy_desc);
        // $("#arhinstruction").val(data[0].instruction);
        // $("#arhmorfologi_neoplasma").val(data[0].morfologi_neoplasma);
        // $("#arhdisability").val(data[0].disability);
        // $("#arhrencanatl").val(data[0].rencanatl);
        // $("#arhdirujukke").val(data[0].dirujukke);
        // $("#arhtgl_kontrol").val(data[0].tgl_kontrol);
        // $("#arhkdpoli_kontrol").val(data[0].kdpoli_kontrol);
        // $("#arhprocedure_05").val(data[0].procedure_05);
        // $("#arhsuffer_type").val(data[0].suffer_type);
        // $("#arhvisit_date").val(data[0].date_of_diagnosa);
        //         } else {

        //         }
        //     },
        // });
    }

    function copydescription() {
        var value = $("#ardescription").val($("#arhdescription").val());
    }

    function copydiagnosa_desc_05() {
        var value = $("#ardiagnosa_desc_05").val($("#arhdiagnosa_desc_05").val());
    }

    function copydiagnosa_desc_06() {
        var value = $("#ardiagnosa_desc_06").val($("#arhdiagnosa_desc_06").val());
    }

    function copyanamnase() {
        var value = $("#aranamnase").val($("#arhanamnase").val());
    }

    function copypemeriksaan() {
        var value = $("#arpemeriksaan").val($("#arhpemeriksaan").val());
    }

    function copypemeriksaan_02() {
        var value = $("#arpemeriksaan_02").val($("#arhpemeriksaan_02").val());
    }

    function copypemeriksaan_03() {
        var value = $("#arpemeriksaan_03").val($("#arhpemeriksaan_03").val());
    }

    function copypemeriksaan_05() {
        var value = $("#arpemeriksaan_05").val($("#arhpemeriksaan_05").val());
    }

    function copyteraphy_desc() {
        var value = $("#arteraphy_desc").val($("#arhteraphy_desc").val());
    }

    function copyinstruction() {
        var value = $("#arinstruction").val($("#arhinstruction").val());
    }

    function copymorfologi_neoplasma() {
        var value = $("#armorfologi_neoplasma").val($("#arhmorfologi_neoplasma").val());
    }

    function copydisability() {
        var value = $("#ardisability").val($("#arhdisability").val());
    }

    function copyrencanatl() {
        var value = $("#arrencanatl").val($("#arhrencanatl").val());
    }

    function copydirujukke() {
        var value = $("#ardirujukke").val($("#arhdirujukke").val());
    }

    function copytgl_kontrol() {
        var value = $("#artgl_kontrol").val($("#arhtgl_kontrol").val());
    }

    function copykdpoli_kontrol() {
        var value = $("#arkdpoli_kontrol").val($("#arhkdpoli_kontrol").val());
    }

    function copyprocedure_05() {
        var value = $("#arprocedure_05").val($("#arhprocedure_05").val());
    }

    function copysuffer_type() {
        var value = $("#arsuffer_type").val($("#arhsuffer_type").val());
    }

    function nextHistory() {
        if (currentIndex < indexLength - 1) {
            currentIndex++;
            updateHistory(currentIndex)
        }
    }

    function prevHistory() {
        if (currentIndex > 0) {
            currentIndex--;
            updateHistory(currentIndex)
        }
    }

    function updateHistory(index) {
        $("#arhdescription").val(historyJson[index].description);
        $("#arhdiagnosa_desc_index5").val(historyJson[index].diagnosa_desc_index5);
        $("#arhdiagnosa_desc_index6").val(historyJson[index].diagnosa_desc_index6);
        $("#arhanamnase").val(historyJson[index].anamnase);
        $("#arhpemeriksaan").val(historyJson[index].pemeriksaan);
        $("#arhpemeriksaan_index2").val(historyJson[index].pemeriksaan_index2);
        $("#arhpemeriksaan_index3").val(historyJson[index].pemeriksaan_index3);
        $("#arhpemeriksaan_index5").val(historyJson[index].pemeriksaan_index5);
        $("#arhteraphy_desc").val(historyJson[index].teraphy_desc);
        $("#arhinstruction").val(historyJson[index].instruction);
        $("#arhmorfologi_neoplasma").val(historyJson[index].morfologi_neoplasma);
        $("#arhdisability").val(historyJson[index].disability);
        $("#arhrencanatl").val(historyJson[index].rencanatl);
        $("#arhdirujukke").val(historyJson[index].dirujukke);
        $("#arhtgl_kontrol").val(historyJson[index].tgl_kontrol);
        $("#arhkdpoli_kontrol").val(historyJson[index].kdpoli_kontrol);
        $("#arhprocedure_index5").val(historyJson[index].procedure_index5);
        $("#arhsuffer_type").val(historyJson[index].suffer_type);
        $("#arhvisit_date").html(historyJson[index].date_of_diagnosa);
        var text = 'Data ke: ' + String(index + 1) + '/' + indexLength;
        $("#currentHistory").html(text);
    }

    function tindakLanjut() {
        var tindakLanjutType = $("#arrencanatl").val()
        if (tindakLanjutType == '1') {
            $("#ardirujukkegroup").hide()
            $("#artgl_kontrolgroup").hide()
            $("#arkdpoli_kontrolgroup").hide()
            $("#ardescriptiongroup").hide()
            $("#arskdpgroup").hide()
            $("#arsprigroup").hide()
            $("#arrujukaneksternalgroup").hide()
            $("#artiperujukan_group").hide()
            $("#arrujukaninternalgroup").hide()
        } else if (tindakLanjutType == '2') {
            $("#ardirujukkegroup").hide()
            $("#artgl_kontrolgroup").hide()
            $("#arkdpoli_kontrolgroup").hide()
            $("#ardescriptiongroup").hide()
            $("#arskdpgroup").hide()
            $("#arsprigroup").hide()
            $("#arrujukaneksternalgroup").hide()
            $("#artiperujukan_group").hide()
            $("#arrujukaninternalgroup").hide()
        } else if (tindakLanjutType == '3') {
            $("#ardirujukkegroup").show()
            $("#artgl_kontrolgroup").show()
            $("#arkdpoli_kontrolgroup").show()
            $("#ardescriptiongroup").show()
            $("#arskdpgroup").hide()
            $("#arsprigroup").hide()
            $("#arrujukaneksternalgroup").show()
            $("#artiperujukan_group").show()
            getRujukan()
            $("#arrujukaninternalgroup").hide()
        } else if (tindakLanjutType == '4') {
            $("#ardirujukkegroup").hide()
            $("#artgl_kontrolgroup").show()
            $("#arkdpoli_kontrolgroup").show()
            $("#ardescriptiongroup").show()
            $("#arskdpgroup").show()
            $("#arsprigroup").hide()
            $("#arrujukaneksternalgroup").hide()
            $("#artiperujukan_group").hide()
            $("#arrujukaninternalgroup").hide()
        } else if (tindakLanjutType == '5') {
            $("#ardirujukkegroup").hide()
            $("#artgl_kontrolgroup").show()
            $("#arkdpoli_kontrolgroup").hide()
            $("#ardescriptiongroup").show()
            $("#arskdpgroup").hide()
            $("#arsprigroup").show()
            $("#arrujukaneksternalgroup").hide()
            $("#artiperujukan_group").hide()
            $("#arrujukaninternalgroup").hide()
        } else if (tindakLanjutType == '6') {
            $("#ardirujukkegroup").hide()
            $("#artgl_kontrolgroup").hide()
            $("#arkdpoli_kontrolgroup").hide()
            $("#ardescriptiongroup").hide()
            $("#arskdpgroup").hide()
            $("#arsprigroup").hide()
            $("#arrujukaneksternalgroup").hide()
            $("#artiperujukan_group").hide()
            $("#arrujukaninternalgroup").show()
        }
    }

    $("#formaddrm").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/addrekammedis',
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
                    pasienDiagnosa = data.data
                    modalAddRm()
                    disableRM()
                    $("#formaddrmbtn").hide()
                    $("#formeditrm").show()
                    $("#postingSS").show()
                    $(".rmdescription").val(pasienDiagnosa.description)
                    executeWaktuUpdate()
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

    function postKontrol(jenisKontrol) {
        var clicked_submit_btn = $("#addskdp")
        var clicked_spri_btn = $("#addspri")



        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/postKontrol',
            type: "POST",
            data: JSON.stringify({
                'nosep': '<?= $visit['no_skpinap'] ?? $visit['no_skp']; ?>',
                'kddpjp': '<?= $visit['kddpjp']; ?>',
                'clinic_id': '<?= $visit['clinic_id']; ?>',
                'tgl_kontrol': $("#artgl_kontrol").val(),
                'noSkdp': $("#arskdp").val(),
                'noSpri': $("#arspri").val(),
                'employee_id': '<?= $visit['employee_inap'] ?? $visit['employee_id']; ?>',
                'visit_id': '<?= $visit['visit_id']; ?>',
                'jenisKontrol': jenisKontrol,
                'noKartu': '<?= $visit['pasien_id']; ?>'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
                clicked_spri_btn.button('loading');
            },
            success: function(data) {
                if (data.metaData.code == '200') {

                    if (jenisKontrol == 1) {
                        var noSuratKontrol = data.response.noSuratKontrol
                        $("#arskdp").val(noSuratKontrol);
                        $("#arskdp").prop("disabled", true);
                    } else {
                        var noSuratKontrol = data.response.noSPRI
                        $("#arspri").val(noSuratKontrol);
                        $("#arspri").prop("disabled", true);
                    }
                }

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_spri_btn.button('reset');
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_spri_btn.button('reset');
                clicked_submit_btn.button('reset');
            }
        });


    }

    function deleteKontrol(jenisKontrol) {
        var clicked_submit_btn = $("#deleteskdp")


        if (jenisKontrol == 1) {
            var noSuratKontrol = $("#arskdp").val();
        } else {
            var noSuratKontrol = $("#arspri").val();
        }
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/deleteKontrol',
            type: "POST",
            data: JSON.stringify({
                'visit_id': '<?= $visit['visit_id']; ?>',
                'noSuratKontrol': noSuratKontrol,
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
                clicked_spri_btn.button('loading');
            },
            success: function(data) {
                if (data.metaData.code == '200') {
                    if (jenisKontrol == 1) {
                        $("#arskdp").val("");
                    } else {
                        $("#arspri").val("");
                    }
                }

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_spri_btn.button('reset');
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_spri_btn.button('reset');
                clicked_submit_btn.button('reset');
            }
        })
    }

    function postRujukan() {
        var clicked_submit_btn = $("#addnorujukan")



        var rujvisit = '<?= $visit['visit_id']; ?>'
        var rujrujukanNosep = '<?= $visit['no_skpinap'] ?? $visit['no_skp']; ?>'
        var rujnoRujukan = $("#arnorujukan").val()
        var rujtglRujukan = '<?= $visit['visit_date']; ?>'
        var rujtglRencanaKunjungan = $("#artgl_kontrol").val()
        if (rujtglRencanaKunjungan == '' || rujtglRencanaKunjungan == null) {
            alert('Tanggal Rencana Rujukan harus diisi')
            return '';
        }
        var rujppkdirujuk = $("#ardirujukke").val()
        if (rujppkdirujuk == '' || rujppkdirujuk == null) {
            alert('kolom "Dirujuk Ke" tidak boleh kosong')
            return '';
        }
        var rujppkname = $("#ardirujukke").find(":selected").data()
        if (typeof rujppkname !== 'undefined') {
            var rujppkdirujukName = rujppkname.data.text
        }
        var rujjnsPelayanan = '<?= is_null($visit['class_room_id']) ? '1' : '2'; ?>'
        var rujcatatan = $("#arprocedure_05").val()
        var rujdiagRujukan = $("#diag_id1").val()
        if (rujdiagRujukan == '' || rujdiagRujukan == null) {
            alert('Harus sudah mengisi diagnosa utama')
            return '';
        }
        var rujdiagname = $("#diag_id1").find(":selected").data()
        if (typeof rujdiagname !== 'undefined') {
            var rujdiagRujukanName = rujdiagname.data.text
        }
        var rujtipeRujukan = $("#artiperujukan").val()
        var rujpoliRujukan = $("#arkdpoli_kontrol").val()
        if (rujpoliRujukan == '' || rujpoliRujukan == null) {
            alert('Poli rujukan harus diisi')
            return '';
        }
        var rujsex = '<?= $visit['gender']; ?>'
        var rujnama = '<?= $visit['diantar_oleh']; ?>'
        var rujnokartu = '<?= $visit['pasien_id']; ?>'
        var rujnorm = '<?= $visit['no_registration']; ?>'
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/postRujukan',
            type: "POST",
            data: JSON.stringify({
                'nosep': rujrujukanNosep,
                'norujukan': rujnoRujukan,
                'tglRujukan': rujtglRujukan,
                'tglRencanaKunjungan': rujtglRencanaKunjungan,
                'ppkdirujuk': rujppkdirujuk,
                'jnsPelayanan': rujjnsPelayanan,
                'catatan': rujcatatan,
                'diagRujukan': rujdiagRujukan,
                'tipeRujukan': rujtipeRujukan,
                'poliRujukan': rujpoliRujukan,
                'visit': rujvisit,
                'ppkdirujukName': rujppkdirujukName,
                'diagRujukanName': rujdiagRujukanName,
                'sex': rujsex,
                'nama': rujnama,
                'nokartu': rujnokartu,
                'nomr': rujnorm
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.metaData.code == '200') {
                    var noRujukan = data.response.rujukan.noRujukan
                    $("#arnorujukan").val(noRujukan);
                    $("#arnorujukan").prop("disabled", true);
                }

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }

    function deleteRujukan() {
        var clicked_submit_btn = $("#deleterujukan")

        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/deleteRujukan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': '<?= $visit['visit_id']; ?>',
                'noRujukan': $("#arnorujukan").val(),
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.metaData.code == '200') {
                    $("#arnorujukan").val("");
                }

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        })
    }

    function modalDiagnosa() {
        holdModal('addDiagModal');
    }

    function disableRM() {
        $("#ardescription").prop("disabled", true);
        $("#ardiagnosa_desc_05").prop("disabled", true);
        $("#ardiagnosa_desc_06").prop("disabled", true);
        $("#aranamnase").prop("disabled", true);
        $("#arpemeriksaan").prop("disabled", true);
        $("#arpemeriksaan_02").prop("disabled", true);
        $("#arpemeriksaan_03").prop("disabled", true);
        $("#arpemeriksaan_05").prop("disabled", true);
        $("#arteraphy_desc").prop("disabled", true);
        $("#arinstruction").prop("disabled", true);
        $("#armorfologi_neoplasma").prop("disabled", true);
        $("#ardisability").prop("disabled", true);
        $("#arrencanatl").prop("disabled", true);
        $("#ardirujukke").prop("disabled", true);
        $("#artgl_kontrol").prop("disabled", true);
        $("#arkdpoli_kontrol").prop("disabled", true);
        $("#arprocedure_05").prop("disabled", true);
        $("#arsuffer_type").prop("disabled", true);
        $("#artiperujukan").prop("disabled", true);
        $("#tablediagnosa select").prop("disabled", true);
        $("#tableprocedure select").prop("disabled", true);
    }

    function enableRM() {
        $("#ardescription").prop("disabled", false);
        $("#ardiagnosa_desc_05").prop("disabled", false);
        $("#ardiagnosa_desc_06").prop("disabled", false);
        $("#aranamnase").prop("disabled", false);
        $("#arpemeriksaan").prop("disabled", false);
        $("#arpemeriksaan_02").prop("disabled", false);
        $("#arpemeriksaan_03").prop("disabled", false);
        $("#arpemeriksaan_05").prop("disabled", false);
        $("#arteraphy_desc").prop("disabled", false);
        $("#arinstruction").prop("disabled", false);
        $("#armorfologi_neoplasma").prop("disabled", false);
        $("#ardisability").prop("disabled", false);
        $("#arrencanatl").prop("disabled", false);
        $("#ardirujukke").prop("disabled", false);
        $("#artgl_kontrol").prop("disabled", false);
        $("#arkdpoli_kontrol").prop("disabled", false);
        $("#arprocedure_05").prop("disabled", false);
        $("#arsuffer_type").prop("disabled", false);
        $("#artiperujukan").prop("disabled", true);
        $("#tablediagnosa select").prop("disabled", false);
        $("#tableprocedure select").prop("disabled", false);
    }

    function editRM() {
        $("#formaddrmbtn").show()
        $("#formeditrm").hide()
        $("#postingSS").hide()
        enableRM()
    }

    function getRujukan() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getRujukan',
            type: "POST",
            data: JSON.stringify({
                'visit': '<?= $visit['visit_id']; ?>',
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var result = data[0]
                alert(result.nokunjungan)
                $("#arnorujukan").val(result.nokunjungan)
            },
            error: function() {

            }
        });
    }

    function satuSehatLogin() {
        $.ajax({
            url: '<?php echo base_url(); ?>satusehat/loginInternal',
            type: "POST",
            data: JSON.stringify({
                'username': 'usi'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#asspasien_idsearch").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                localStorage.setItem('jwtauth', data.token)
                getSatuSehatToken()
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $("#asspasien_idsearch").html('<i class="fa fa-search"></i>')
            },
            complete: function() {
                $("#asspasien_idsearch").html('<i class="fa fa-search"></i>')

            }
        });
    }

    function getSatuSehatToken() {
        var jwtauth = localStorage.getItem('jwtauth')

        $.ajax({
            url: '<?php echo base_url(); ?>api/satusehat/getToken',
            type: "GET",
            headers: {
                Authorization: 'Bearer ' + jwtauth
            },
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#asspasien_idsearch").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                console.log(data)
                // var aksestoken = data.access_token
                // console.log(aksestoken)
                localStorage.setItem('ssToken', data)
                alert("Get Token Satu Sehat Berhasil, silahkan ulangi proses bridging satu sehat kembali")
            },
            error: function(xhr) {
                alert(xhr);
                satuSehatLogin()
                $("#asspasien_idsearch").html('<i class="fa fa-search"></i>')
            },
            complete: function() {
                $("#asspasien_idsearch").html('<i class="fa fa-search"></i>')

            }
        });
    }

    function updateWaktu(task) {
        var statusantrean = $("#pvstatusantrean").val()
        var checktask = task - 1
        console.log(statusantrean)
        console.log('2' + (String)(checktask))
        // if (statusantrean == '2' + (String)(checktask) || (statusantrean == '11' && task == 1)) {
        if (true) {
            $.ajax({
                url: '<?php echo base_url(); ?>api/antrianbpjs/updateWaktu',
                type: "POST",
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('jwtauth'),
                },
                data: JSON.stringify({
                    "norm": '<?= $visit['no_registration']; ?>',
                    "kodebooking": '<?= $visit['trans_id']; ?>',
                    "taskid": task,
                    "waktu": Date.now()
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#postingSS").html('<i class="spinner-border spinner-border-sm"></i><span> Posting Update Waktu ... </span>')
                },
                success: function(data) {
                    console.log("Tambah Antrean " + data.metadata.message)

                    if (data.metadata.code == 200) {
                        $("#arstatusantrean").val('2' + (String)(task))
                        executeWaktuUpdate()
                    } else {
                        alert("Posting Update Waktu Antrean BPJS kode " + task + " Gagal: " + data.metadata.message)
                    }
                },
                error: function(xhr) {
                    if (xhr.status == '401') {
                        getSatuSehatToken()
                    } else {
                        alert("Update Waktu Antrean BPJS: " + xhr.statusText)
                    }
                    $("#postingSS").html('<i class="fa fa-check-circle"></i> <span> Posting </span>')
                },
                complete: function() {
                    $("#postingSS").html('<i class="fa fa-check-circle"></i> <span> Posting </span>')
                }

            });
        }

    }

    function executeWaktuUpdate() {
        var statusantrean = $("#arstatusantrean").val()
        var task = '';
        if (statusantrean == '23') {
            task = '4'
        } else if (statusantrean == '24') {
            task = '5'
        }
        if (task != '') {
            updateWaktu(task)
        }

        $.ajax({
            url: '<?php echo base_url(); ?>api/antrianbpjs/updateStatusAntraenPV',
            type: "POST",
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('jwtauth'),
            },
            data: JSON.stringify({
                "norm": '<?= $visit['no_registration']; ?>',
                "kodebooking": '<?= $visit['trans_id']; ?>',
                "taskid": $("#arstatusantrean").val(),
                "waktu": Date.now()
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#formaddpvbtn").html('<i class="spinner-border spinner-border-sm"></i><span> Posting Update Waktu ... </span>')
            },
            success: function(data) {
                console.log("Update Waktu Selesai")
            },
            error: function(xhr) {
                if (xhr.status == '401') {
                    getSatuSehatToken()
                } else {
                    alert("Update Waktu Antrean BPJS: " + xhr.statusText)
                }
                $("#formaddpvbtn").html('<i class="fa fa-check-circle"></i> <span> Simpan </span>')
            },
            complete: function() {
                $("#formaddpvbtn").html('<i class="fa fa-check-circle"></i> <span> Simpan </span>')
            }

        });
    }
</script>