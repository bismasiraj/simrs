<?php
$aValueParent = array();
foreach ($aValue as $key => $value) {
    $aValueParent[$value['parameter_id']]['parameter_id'] = $value['parameter_id'];
    $aValueParent[$value['parameter_id']]['p_type'] = $value['p_type'];
}
?>
<script type="text/javascript">
    $(document).ready(function(e) {
        const nomor = '<?= $visit['no_registration']; ?>';
        const ke = '%'
        // const mulai = '2023-08-01' //tidak terpakai
        // const akhir = '2023-08-31' //tidak terpakai
        const lunas = '%'
        // var klinik = '<?= $visit['clinic_id']; ?>'
        const klinik = '%'
        const rj = '%'
        const status = '%'
        const nota = '%'
        const trans = '<?= $visit['trans_id']; ?>'
        const visit = '<?= $visit['visit_id']; ?>'



        $("#aigdexamination_date").val(get_date())

        // armstanding_ordereditor.init({
        //     selector: '#arpeducation_material'
        // });
        // tinymce.init({
        //     selector: '#arpeducation_material'
        // });
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#armbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_neonatus/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Jalan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Diagnosis Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Hak dan Kewajiban Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Implementasi Asuhan Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Inform Concern (Pemasangan Infus)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Nyeri</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Transfer Internal</a></li>')
    })



    $("#aigdweight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdheight").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtemperature").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdnadi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtension_upper").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdtension_below").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdsaturasi").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdnafas").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
    $("#aigdarm_diameter").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });

    // $("#cpptTab").on("click", function() {
    //     $("#arpTitle").html("CPPT")
    //     $("#arpanamnase_label").html("Subyektif (S)")
    //     $("#collapseRiwayat").slideUp()
    //     $("#groupRiwayat").slideUp()
    //     // $("#subjectiveGroupHeader").slideDown()
    //     $("#objectiveGroupHeader").slideDown()
    //     $("#arpFallRisk_Group").slideDown()
    //     $("#arpPainMonitoring_Group").slideUp()
    //     $("#arpTriage_Group").slideUp()
    //     $("#arpApgar_Group").slideUp()
    //     $("#arpGizi_Group").slideUp()
    //     $("#arpAdl_Group").slideUp()
    //     $("#arpDekubitus_Group").slideUp()
    //     $("#arpStabilitas_Group").slideUp()
    //     $("#arpEdukasiIntegrasi_Group").slideUp()
    //     $("#arpEdukasiForm_Group").slideUp()
    //     $("#arpGcs_Group").slideDown()
    //     $("#arpIntegumen_Group").slideUp()
    //     $("#arpNeurosensoris_Group").slideUp()
    //     $("#arpPencernaan_Group").slideUp()
    //     $("#arpPerkemihan_Group").slideUp()
    //     $("#arpPernapasan_Group").slideUp()
    //     $("#arpPsikologi_Group").slideUp()
    //     $("#arpSeksual_Group").slideUp()
    //     $("#arpSirkulasi_Group").slideUp()
    //     $("#arpSocial_Group").slideUp()
    //     $("#arpHearing_Group").slideUp()
    //     $("#arpSleeping_Group").slideUp()
    //     $("#arpTindakanKolaboratif_Group").slideDown()
    //     $("#arpTindakanMandiri_Group").slideDown()
    //     $("#arpImplementasi_Group").slideUp()
    // })
    $("#assessmentigdTab").on("mouseup", function() {
        $("#arpTitle").html("Asesmen Keperawatan")

        $("#arpanamnase_label").html("Subyektif (S)")
        $("#collapseRiwayat").slideDown()
        $("#groupRiwayat").slideDown()
        // $("#subjectiveGroupHeader").slideDown()
        $("#objectiveGroupHeader").slideDown()
        $("#arpFallRisk_Group").slideDown()
        $("#arpPainMonitoring_Group").slideDown()
        $("#arpTriage_Group").slideDown()
        $("#bodyTriagePerawat").html("")
        $("#arpApgar_Group").slideDown()
        $("#arpGizi_Group").slideDown()
        $("#arpAdl_Group").slideDown()
        $("#arpDekubitus_Group").slideDown()
        $("#arpStabilitas_Group").slideDown()
        $("#arpEdukasiIntegrasi_Group").slideDown()
        $("#arpEdukasiForm_Group").slideDown()
        $("#arpGcs_Group").slideDown()
        $("#arpIntegumen_Group").slideDown()
        $("#arpNeurosensoris_Group").slideDown()
        $("#arpPencernaan_Group").slideDown()
        $("#arpPerkemihan_Group").slideDown()
        $("#arpPernapasan_Group").slideDown()
        $("#arpPsikologi_Group").slideDown()
        $("#arpSeksual_Group").slideDown()
        $("#arpSirkulasi_Group").slideDown()
        $("#arpSocial_Group").slideDown()
        $("#arpHearing_Group").slideDown()
        $("#arpSleeping_Group").slideDown()
        $("#arpTindakanKolaboratif_Group").slideDown()
        $("#arpTindakanMandiri_Group").slideDown()
        $("#arpImplementasi_Group").slideDown()

        initialAddArp()
        generateSatelite()
        getAssessmentKeperawatan()
        getTindakanPerawat()
    })
</script>

<script type="text/javascript">
    $(".formsavearpbtn").on('click', (function(e) {
        $("#formaddarp").find("button.btn-save:not([disabled])").trigger("click")
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveExaminationInfo',
            type: "POST",
            // data: 

            data: new FormData(document.getElementById('formaddarp')),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                getAssessmentKeperawatan()
                // // $("#formsavearpbtn").slideUp()
                // // $("#formeditarp").slideDown()
                // var isNewDocument = 0
                // $.each(examForassessment, function(key, value) {
                //     if (value.body_id == data.body_id) {
                //         examForassessment[key] = data
                //         isNewDocument = 1
                //     }
                // })
                // if (isNewDocument == 1)
                //     examForassessment.push(data)
                // disableARP()
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

    const filterVsStatusId = (value) => {
        if (value == 1) {
            $("#arpApgar_Group").slideUp()
            $("#arpAnak_Group").slideUp()
        } else if (value == 4) {
            $("#arpApgar_Group").slideDown()
            $("#arpAnak_Group").slideDown()
        } else if (value == 5) {
            $("#arpApgar_Group").slideUp()
            $("#arpAnak_Group").slideDown()
        } else if (value == 10) {
            $("#arpApgar_Group").slideUp()
            $("#arpAnak_Group").slideUp()
        }
        $("#arpvs_status_id").val(value)
    }

    function generateSatelite() {
        $("#bodyFallRiskPerawat").html("")
        // addFallRisk(1, 0, 'arpbody_id', 'bodyFallRiskPerawat')
        $("#bodyApgarPerawat").html("")
        // addApgar(1, 0, 'arpbody_id', 'bodyApgarPerawat')
        $("#bodyPainMonitoringPerawat").html("")
        // addPainMonitoring(1, 0, 'arpbody_id', 'bodyPainMonitoringPerawat')
        $("#bodyGiziPerawat").html("")
        // addGizi(1, 0, 'arpbody_id', 'bodyGiziPerawat')
        $("#bodyTriagePerawat").html("")
        // addTriage(1, 0, 'arpbody_id', 'bodyTriagePerawat')
        $("#bodyADLPerawat").html("")
        // addADL(1, 0, 'arpbody_id', 'bodyADLPerawat')
        $("#bodyDekubitusPerawat").html("")
        // addDekubitus(1, 0, 'arpbody_id', 'bodyDekubitusPerawat')
        $("#bodyStabilitasPerawat").html("")
        // addDerajatStabilitas(1, 0, 'arpbody_id', 'bodyStabilitasPerawat')
        $("#bodyEducationFormPerawat").html("")
        // addEducationForm(1, 0, 'arpbody_id', 'bodyEducationFormPerawat')
        $("#bodyGcsPerawat").html("")
        // addGcs(1, 0, 'arpbody_id', 'bodyGcsPerawat')
        $("#bodyIntegumenPerawat").html("")
    }

    function getAssessmentKeperawatan() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentKeperawatan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#cpptDivForm").hide()
                getLoadingscreen("contentCppt", "loadContentCppt")
                getLoadingscreen("contentAssessmentPerawat", "loadContentAssessmentPerawat")
                $("#cpptBody").html(loadingScreen())
                $("#vitalSignBody").html(loadingScreen())
            },
            processData: false,
            success: function(data) {
                $("#cpptBody").html(tempTablesNull())
                $("#vitalSignBody").html(tempTablesNull())
                examForassessment = data.examInfo
                riwayatAll = data.pasienHistory

                examSelected = [];

                // $.each(examForassessment, function(key, value) {
                var vsStatusId = [1, 4, 5];

                //     if (vsStatusId.includes(value.vs_status_id)) {
                //         fillDataArp(key)
                //         disableARP()
                //     }
                // })
                // fillDataArp(examForassessment.length)


                let examFiltered145 = examForassessment.filter(item => item.account_id == 2)
                if (examFiltered145.length > 0) {
                    fillDataArp(examFiltered145.length - 1)
                    $("#arpAddDocument").slideUp()
                    $("#arpDocument").slideDown()
                }

                if (examForassessment.length > 0) {
                    displayTableAssessmentKeperawatan();
                    displayTableAssessmentKeperawatanForVitalSign();
                }


                fillRiwayatArp()
            },
            error: function() {
                $("#cpptBody").html(tempTablesNull())
                $("#vitalSignBody").html(tempTablesNull())
            }
        });
    }

    function initialAddArp() {


        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#formaddarp").find('input[type="text"], input[type="hidden"], textarea').val(null)

        $("#arpvs_status_id1").prop("checked", true)
        $("#arpbody_id").val(bodyId)
        $("#arporg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#arppasien_diagnosa_id").val(null)
        $("#arpdiagnosa_id").val(null)
        $("#arpno_registration").val('<?= $visit['no_registration']; ?>')
        $("#arpvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#arpbill_id").val(null)
        <?php if ($visit['isrj'] == 0) { ?>
            // $('#arpclinic_id').val('<?= $visit['class_room_id']; ?>')
        <?php } else { ?>
            // $('#arpclinic_id').val('<?= $visit['clinic_id']; ?>')
        <?php } ?>
        let clinicSelect = clinics.filter(item => item.clinic_id == '<?= $visit['clinic_id']; ?>')
        $("#arpclinic_id").html($('<option></option>')
            .val(clinicSelect[0].clinic_id)
            .text(clinicSelect[0].name_of_clinic))

        <?php if ($visit['isrj'] == '0') {
        ?>
            $("#arpemployee_id").html('<option value="<?= $visit['employee_inap']; ?>"><?= $visit['fullname_inap']; ?></option>')
        <?php
        } else {
        ?>
            $("#arpemployee_id").html('<option value="<?= $visit['employee_id']; ?>"><?= $visit['fullname']; ?></option>')
        <?php
        } ?>
        $("#arpclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#arpbed_id").val('<?= $visit['bed_id']; ?>')
        $("#arpin_date").val('<?= $visit['in_date']; ?>')
        $("#arpexit_date").val('<?= $visit['exit_date']; ?>')
        $("#arpkeluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#flatarpexamination_date").val(nowtime).trigger("change")
        $("#arpmodified_date").val(get_date())
        $("#arpmodified_by").val('<?= user()->username; ?>')
        $("#arpmodified_from").val('<?= $visit['clinic_id']; ?>')
        $("#arpstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#arpageyear").val('<?= $visit['ageyear']; ?>')
        $("#arpagemonth").val('<?= $visit['agemonth']; ?>')
        $("#arpageday").val('<?= $visit['ageday']; ?>')
        $("#arpthename").val('<?= $visit['diantar_oleh']; ?>')
        $("#arptheaddress").val('<?= $visit['visitor_address']; ?>')
        $("#arptheid").val('<?= $visit['pasien_id']; ?>')
        $("#arpisrj").val('<?= $visit['isrj']; ?>')
        $("#arpgender").val('<?= $visit['gender']; ?>')
        $("#arpdoctor").val('<?= $visit['fullname']; ?>')
        $("#arpkal_id").val('<?= $visit['kal_id']; ?>')
        $("#arppetugas_id").val('<?= user()->username; ?>')
        $("#arppetugas").val('<?= user()->getFullname(); ?>')
        $("#arpaccount_id").val(2)
        // $("#arpvs_status_id").val(1)

        $('#keperawatanListLinkAll').html("")

        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#armbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_neonatus/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">CPPT Rawat Jalan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Diagnosis Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Hak dan Kewajiban Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Implementasi Asuhan Keperawatan</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Inform Concern (Pemasangan Infus)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Anak</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Keperawatan IGD Dewasa</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Nyeri</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">SDKI SLKI SIKI</a></li>')
        $('#keperawatanListLinkAll').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>/' + $("#arpbody_id").val() + '" target="_blank">Transfer Internal</a></li>')

        $("#arpisvalid").val(0)

        $("#arpcollapseVitalSign").find("#arptotal_score").html("")
        $("#arpcollapseVitalSign").find("span.h6").html("")

        $("#arpAddDocument").slideUp()
        $("#arpDocument").slideDown()
        enableARP()
        fillRiwayatArp()
        generateSatelite()
    }

    const fillDataArp = async (index) => {
        var ex = examForassessment[index]
        $.each(ex, function(key, value) {
            $("#arp" + key).val(value)
        })
        let clinicSelect = clinics.filter(item => item.clinic_id == '<?= $visit['clinic_id']; ?>')
        $("#arpclinic_id").html($('<option></option>')
            .val(clinicSelect[0].clinic_id)
            .text(clinicSelect[0].name_of_clinic))
        $("#arpemployee_id").html('<option value="' + ex.employee_id + '">' + ex.fullname + '</option>')
        $("#arpvs_status_id" + ex.vs_status_id).prop("checked", true)
        // let formattedValue = moment(ex.examination_date).format('DD/MM/YYYY HH:mm');
        $("#arpcollapseVitalSign").find("input").each(function() {
            $(this).trigger("change")
        })
        $("#flatarpexamination_date").val(formatedDatetimeFlat(ex.examination_date)).trigger("change")

        await checkSignSignature("formaddarp", "arpbody_id", "formsavearpbtnid", 3)

        disableARP()

        // getFallRisk(ex.body_id)
        // getPainMonitoring(ex.body_id)
        // getTriage(ex.body_id, "bodyTriage")
        // getGcs(ex.body_id, "bodyGcsPerawat")
        // getApgar(ex.body_id)
        // getStabilitas(ex.body_id)
        // getPernapasan(ex.body_id)
        // getSirkulasi(ex.body_id)
        // getNeurosensoris(ex.body_id)
        // getIntegumen(ex.body_id)
        // getADL(ex.body_id)
        // getPencernaan(ex.body_id)
        // getDekubitus(ex.body_id)
        // getPsikologi(ex.body_id)
        // getPerkemihan(ex.body_id)
        // getSeksual(ex.body_id)
        // getSocial(ex.body_id)
        // getGizi(ex.body_id)
        // getEducationForm(ex.body_id)
        // getEducationIntegration(ex.body_id)
        // getHearing(ex.body_id)
        // getSleeping(ex.body_id)

    }

    function fillRiwayatArp() {
        $.each(riwayatAll, function(key, value) {
            if ($("#arpGEN0009" + value.value_id).is(":checkbox")) {
                $("#arpGEN0009" + value.value_id).prop("checked", true)
                // $("#arpGEN0009" + value.value_id).prop("disabled", true)
            } else {
                $("#arpGEN0009" + value.value_id).val(value.histories)
                // $("#arpGEN0009" + value.value_id).prop("disabled", true)
            }
        })
    }

    const signArp = async () => {
        $("#formeditarpid").trigger("click")
        //const addSignUser = (formId, container, primaryKey, buttonId, docs_type, user_type, sign_ke = 1, title)
        let titlenya = $("#arpTitle").html()
        let titlerj = ''
        let titlejenis = ''
        if ($("#arpisrj") == 0) {
            titlerj = ' Rawat Inap';
        } else {
            titlerj = ' Rawat Jalan'
        }
        switch ($('#formaddarp input[name="vs_status_id"]:checked').val()) {
            case 1:
                titlejenis = ' Dewasa'
                break;
            case 4:
                titlejenis = ' Neonatus'
                break;
            case 5:
                titlejenis = ' Anak'
                break;
            case 10:
                titlejenis = ' Obsetric'
                break;
            default:
                break;
        }
        await addSignUser("formaddarp", "arp", "arpbody_id", "formsavearpbtnid", 3, 1, 1, $("#arpTitle").html() + titlejenis + titlerj)
    }

    function displayTableAssessmentKeperawatan(index) {
        $("#assessmentKeperawatanHistoryBody").html("")
        $("#cpptBody").html("")
        // var vsStatusId = [1, 4, 5];


        // let examfiltered14 = examForassessment.filter(item => (vsStatusId.includes(item.vs_status_id)))


        $.each(examForassessment, function(key, value) {
            var pd = examForassessment[key]
            if (key == index) {
                $("#assessmentKeperawatanHistoryBody").append($("<tr>")
                    .append($("<td>").append($("<b>").append('<i class="mdi mdi-arrow-collapse-right" style="font-size: large"></i>')))
                    .append($("<td>").append($("<b>").html(formatedDatetimeFlat(value.examination_date))))
                    .append($("<td>").append($("<b>").html(value.name_of_clinic)))
                    .append($("<td>").append($("<b>").html(value.anamnase)))
                    .append($("<td>").append($("<b>").html('BB: ' + value.weight + 'Kg; TB: ' + value.height + 'cm; ' +
                        value.temperature + '°C; ' +
                        value.nadi + '/menit; ' +
                        value.tension_upper + 'mmHg; ' +
                        value.tension_below + 'mmHg; ' +
                        value.saturasi + 'SpO2%; ' +
                        value.nafas + '/menit; ' +
                        value.arm_diameter + 'cm; ')))
                    .append($("<td>").append($("<b>").html()))
                    .append($("<td>").append($("<b>").html()))
                    .append($("<td>").append($('<button class="btn btn-success" onclick="fillDataArp(' + key + ')">').html("Lihat")))
                )
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
            } else {
                $("#assessmentKeperawatanHistoryBody").append($("<tr>")
                    .append($("<td>"))
                    .append($("<td>").append($("<b>").html(formatedDatetimeFlat(value.examination_date))))
                    .append($("<td>").append($("<b>").html(value.name_of_clinic)))
                    .append($("<td>").append($("<b>").html(value.anamnase)))
                    .append($("<td>").append($("<b>").html('BB: ' + value.weight + 'Kg; TB: ' + value.height + 'cm; ' +
                        value.temperature + '°C; ' +
                        value.nadi + '/menit; ' +
                        value.tension_upper + 'mmHg; ' +
                        value.tension_below + 'mmHg; ' +
                        value.saturasi + 'SpO2%; ' +
                        value.nafas + '/menit; ' +
                        value.arm_diameter + 'cm; ')))
                    .append($("<td>").append($("<b>").html()))
                    .append($("<td>").append($("<b>").html()))
                    .append($("<td>").append($('<button class="btn btn-success" onclick="fillDataArp(' + key + ')">').html("Lihat")))
                )
            }
        })
        vsStatusId = [2, 7];

        // let examfiltered27 = examForassessment.filter(item => (item.vs_status_id == 2 || item.vs_status_id == 7))
        // coba = examfiltered27
        $.each(examForassessment, function(key, value) {
            if (value.account_id == 3 || value.account_id == 4) {
                let pd = examForassessment[key]
                addRowCPPT(value, key)
            }
        })
    }

    function enableARP() {
        $("#formsavearpbtnid").slideDown()
        $("#formeditarpid").slideUp()
        // $(".formsignarp").slideDown()
        $("#formaddarp input").prop("disabled", false)
        $("#formaddarp textarea").prop("disabled", false)
        $("#formaddarp select").prop("disabled", false)
        $("#vitalSignPerawat").find("button").click()
        $("#formaddarp").find(".btn-to-hide").slideDown()
        $("#formaddarp").find(".btn-edit").each(function() {
            $(this).trigger("click")
        })
    }

    const disableARP = () => {
        $("#formsavearpbtnid").slideUp()
        $("#formeditarpid").slideDown()
        // $(".formsignarp").slideUp()
        $("#formaddarp input").prop("disabled", true)
        $("#formaddarp textarea").prop("disabled", true)
        $("#formaddarp select").prop("disabled", true)
        $("#formaddarp").find(".btn-to-hide").slideUp()
        $("#vitalSignPerawat").find("button").click()
        if ($("#arpvalid_user").val() != '') {
            $("#formaddarpbtnid").slideUp()
            $("#formeditarpid").slideUp()
            $("#formsignarpid").slideUp()
            $("#formaddarp").find(".btn-add-doc").remove()
        }
    }

    $(".formaddarpbtn").on("mouseup", function() {
        initialAddArp()
    })
</script>
<script type="text/javascript">
    // function addRowDiagPerawat(diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
    //     diagIndex++;
    //     if (diag_cat == null) {
    //         diag_cat = 1
    //     }
    //     if (diag_cat == null && diagIndex > 1) {
    //         diag_cat = 2
    //     }
    //     $("#bodyDiagPerawat")
    //         .append($('<tr id="arpdiag' + diagIndex + '">')
    //             // .append($('<td>').html(diagIndex + "."))
    //             .append($('<td>')
    //                 .append('<select id="arpdiag_id' + diagIndex + '" class="form-control" name="diag_id[]" onchange="selectedDiagNurse(' + diagIndex + ')" style="width: 100%"></select>')
    //                 .append('<input id="arpdiag_name' + diagIndex + '" name="diag_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
    //                 .append('<input id="arpsscondition_id' + diagIndex + '" name="sscondition_id[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
    //                 // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
    //             )
    //             // .append($('<td>')
    //             //     .append($('<input>').attr('name', 'diag_name[]').attr('id', 'diag_name' + diagIndex).attr('value', diag_name).attr('type', 'text').attr('readonly', 'readonly'))
    //             // )
    //             .append($('<td>')
    //                 .append($("<select class=\"form-control\">")
    //                     .attr('name', 'suffer_type[]').attr('id', 'arpsuffer_type' + diagIndex) <?php foreach ($suffer as $key => $value) { ?>
    //                         .append($("<option>")
    //                             .attr('value', '<?= $suffer[$key]['suffer_type']; ?>').html('<?= $suffer[$key]['suffer']; ?>')
    //                         ) <?php } ?>
    //                     .val(diag_suffer)
    //                 )
    //             )
    //             .append($('<td>')
    //                 .append($("<select class=\"form-control\">")
    //                     .attr('name', 'diag_cat[]').attr('id', 'diag_cat' + diagIndex) <?php foreach ($diagCat as $key => $value) { ?>
    //                         .append($("<option>")
    //                             .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
    //                         ) <?php } ?>
    //                     .val(diag_cat)
    //                 )
    //             )
    //             .append("<td><a href='#' onclick='$(\"#diag" + diagIndex + "\").remove()' class='btn closebtn btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-trash'></i></a></td>")
    //         );

    //     initializeDiagPerawatSelect2("arpdiag_id" + diagIndex, diag_id, diag_name)
    //     $("#arpsuffer_type" + diagIndex).val(0)
    //     $("#arpdiag_cat" + diagIndex).val(diagIndex)
    // }
</script>

<script>
    function cetakAssessmenKeperawatan() {
        var titlekeperawatan = '';
        if ($("#arpvs_status_id1").prop("checked")) {
            titlekeperawatan = 'Dewasa'
        }
        if ($("#arpvs_status_id4").prop("checked")) {
            titlekeperawatan = 'Neonatus'
        }
        if ($("#arpvs_status_id5").prop("checked")) {
            titlekeperawatan = 'Anak'
        }
        if ($("#arpvs_status_id10").prop("checked")) {
            titlekeperawatan = 'Obsetric'
        }

        var win = window.open('<?= base_url() . '/admin/rm/keperawatan/cetak_keperawatan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '/' + titlekeperawatan, '_blank');
        // $.ajax({
        //     url: '<?= base_url() . '/admin/rm/assessment/cetakKeperawatan' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val(),
        //     type: "GET",
        //     success: function(data) {
        //         // Insert fetched content into modal
        //         // $("#cetakarpbody").html(data);
        //         $("#pdfFrame").attr("src", "data:application/pdf;base64," + data);
        //         // Display the modal
        //         $("#cetakarp").modal('show');
        //     }
        // });
    }
</script>