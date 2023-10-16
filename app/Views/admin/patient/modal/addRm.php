<script type="text/javascript">
    var historyJson = new Array();
    var pasienDiagnosa = <?= json_encode($pasienDiagnosa); ?>;
    var currentIndex;
    var indexLength;
    $(document).ready(function(e) {
        // getDiagnosas()
    })
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

    function modalAddRm() {
        enableRM()
        $("#arorg_unit_code").val("<?= $visit['org_unit_code']; ?>")
        $("#arvisit_id").val("<?= $visit['visit_id']; ?>")
        $("#ardate_of_diagnosa").val(get_date())
        $("#arreport_date").val(get_date())

        $("#artheid").val("<?= $visit['pasien_id']; ?>")
        $("#artheaddress").val("<?= $visit['visitor_address']; ?>")
        $("#arisrj").val("<?= $visit['isrj']; ?>")
        $("#arkal_id").val("<?= $visit['kal_id']; ?>")
        $("#arclinic_id").val("<?= $visit['clinic_id']; ?>")

        $("#aremployee_id").val("<?= $visit['employee_id']; ?>")
        $("#ardoctor").val("<?= $visit['fullname']; ?>")
        $("#arclass_room_id").val("<?= $visit['class_room_id']; ?>")
        $("#arbed_id").val("<?= $visit['bed_id']; ?>")


        $("#arin_date").val("<?= $visit['in_date']; ?>")
        $("#arexit_date").val("<?= $visit['exit_date']; ?>")
        $("#armodified_date").val(get_date())
        $("#armodified_by").val("<?= user_id(); ?>")
        $("#arnokartu").val("<?= $visit['pasien_id']; ?>")
        $("#arvisit_id").val("<?= $visit['visit_id']; ?>")
        $("#arno_registration").val("<?= $visit['no_registration']; ?>")







        $("#arthename").val(pasienDiagnosa.thename)
        $("#arstatus_pasien_id").val(pasienDiagnosa.status_pasien_id)
        $("#argender").val(pasienDiagnosa.gender)
        $("#arageyear").val(pasienDiagnosa.ageyear)
        $("#aragemonth").val(pasienDiagnosa.agemonth)
        $("#arageday").val(pasienDiagnosa.ageday)
        $("#arspesialistik").val(pasienDiagnosa.spesialistik)
        $("#arresult_id").val(pasienDiagnosa.result_id)
        $("#arkeluar_id").val(pasienDiagnosa.keluar_id)
        $("#arnosep").val(pasienDiagnosa.nosep)
        $("#artglsep").val(pasienDiagnosa.tglsep)
        $("#arpasien_diagnosa_id").val(pasienDiagnosa.pasien_diagnosa_id)




        $("#ardescription").val(pasienDiagnosa.description)
        $("#ardiagnosa_desc_05").val(pasienDiagnosa.diagnosa_desc_05)
        $("#ardiagnosa_desc_06").val(pasienDiagnosa.diagnosa_desc_06)
        $("#aranamnase").val(pasienDiagnosa.anamnase)
        $("#arpemeriksaan").val(pasienDiagnosa.pemeriksaan)
        $("#arpemeriksaan_02").val(pasienDiagnosa.pemeriksaan_02)
        $("#arpemeriksaan_03").val(pasienDiagnosa.pemeriksaan_03)
        $("#arpemeriksaan_05").val(pasienDiagnosa.pemeriksaan_05)
        $("#arteraphy_desc").val(pasienDiagnosa.teraphy_desc)
        $("#arinstruction").val(pasienDiagnosa.instruction)
        $("#armorfologi_neoplasma").val(pasienDiagnosa.morfologi_neoplasma)
        $("#ardisability").val(pasienDiagnosa.disability)
        $("#arrencanatl").val(pasienDiagnosa.rencanatl)
        $("#ardirujukke").val(pasienDiagnosa.dirujukke)
        $("#artgl_kontrol").val(pasienDiagnosa.tgl_kontrol)
        $("#arkdpoli_kontrol").val(pasienDiagnosa.kdpoli_kontrol)
        $("#arprocedure_05").val(pasienDiagnosa.procedure_05)
        $("#arsuffer_type").val(pasienDiagnosa.suffer_type)










        // holdModal('addRmModal')
        // getDataFillRekamMedis()

        <?php if (isset($pasienDiagnosaAll[0])) { ?>
            getHistoryRekamMedis()
        <?php } ?>


    }

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
                    $("#formaddrmbtn").toggle()
                    $("#formeditrm").toggle()
                    $(".rmdescription").val(pasienDiagnosa.description)
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

    function addKontrol() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getBillEklaim18',
            type: "POST",
            data: JSON.stringify({
                'nosep': pasienDiagnosa.nosep,
                'kddpjp': '<?= $visit['kddpjp']; ?>',
                'clinic_id': '<?= $visit['clinic_id']; ?>',
                'tgl_kontrol': $("#artgl_kontrol").val()
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {


            },
            error: function() {

            }
        });
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
    }

    function editRM() {
        $("#formaddrmbtn").toggle()
        $("#formeditrm").toggle()
        enableRM()
    }
</script>