<?php
$aValueParent = array();
foreach ($aValue as $key => $value) {
    $aValueParent[$value['parameter_id']]['parameter_id'] = $value['parameter_id'];
    $aValueParent[$value['parameter_id']]['p_type'] = $value['p_type'];
}
?>
<script type="text/javascript">
    var mrJson;
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    var examForassessment = <?= json_encode($exam); ?>;
    var avalue = <?= json_encode($aValue); ?>;
    var aparameter = <?= json_encode($aParameter); ?>;
    var atype = <?= json_encode($aType); ?>;
    var avalueparent = <?= json_encode($aValueParent); ?>;
    var fallRiskScore = Array();
    var painMonitoring;
    var painMonitoringDetil;
    var painIntervensi;
    var triage;
    var triageDetil;
    var apgar;
    var apgarDetil;
    var stabilitas;
    var stabilitasDetail;
    var tPerawat;
    var tPerawatAll;
    var napas;
    var fallRisk;
    var fallRiskDetail;
    var sirkulasiAll;
    var neuroAll;
    var integumenAll;
    var anakAll;
    var adlAll;
    var digestAll;
    var perkemihanAll;
    var seksualAll;
    var sleepingAll;
    var hearingAll;
    var socialAll;
    var psikologiAll;
    var psikologiDetailAll;
    var dekubitusAll;
    var giziAll;
    var giziDetailAll;
    var educationFormAll;
    var educationIntegrationAll;
    var educationIntegrationDetailAll;
    var educationIntegrationPlanAll = [];
    var educationIntegrationProvisionAll = [];
    var tarifData = []
    var addUnuDiag;
    var addUnuProc;
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
    //     $("#collapseRiwayat").hide()
    //     $("#groupRiwayat").hide()
    //     // $("#subjectiveGroupHeader").show()
    //     $("#objectiveGroupHeader").show()
    //     $("#arpFallRisk_Group").show()
    //     $("#arpPainMonitoring_Group").hide()
    //     $("#arpTriage_Group").hide()
    //     $("#arpApgar_Group").hide()
    //     $("#arpGizi_Group").hide()
    //     $("#arpAdl_Group").hide()
    //     $("#arpDekubitus_Group").hide()
    //     $("#arpStabilitas_Group").hide()
    //     $("#arpEdukasiIntegrasi_Group").hide()
    //     $("#arpEdukasiForm_Group").hide()
    //     $("#arpGcs_Group").show()
    //     $("#arpIntegumen_Group").hide()
    //     $("#arpNeurosensoris_Group").hide()
    //     $("#arpPencernaan_Group").hide()
    //     $("#arpPerkemihan_Group").hide()
    //     $("#arpPernapasan_Group").hide()
    //     $("#arpPsikologi_Group").hide()
    //     $("#arpSeksual_Group").hide()
    //     $("#arpSirkulasi_Group").hide()
    //     $("#arpSocial_Group").hide()
    //     $("#arpHearing_Group").hide()
    //     $("#arpSleeping_Group").hide()
    //     $("#arpTindakanKolaboratif_Group").show()
    //     $("#arpTindakanMandiri_Group").show()
    //     $("#arpImplementasi_Group").hide()
    // })
    $("#assessmentigdTab").on("mouseup", function() {
        $("#arpTitle").html("Asesmen Keperawatan")

        $("#arpanamnase_label").html("Subyektif (S)")
        $("#collapseRiwayat").show()
        $("#groupRiwayat").show()
        // $("#subjectiveGroupHeader").show()
        $("#objectiveGroupHeader").show()
        $("#arpFallRisk_Group").show()
        $("#arpPainMonitoring_Group").show()
        $("#arpTriage_Group").show()
        $("#bodyTriagePerawat").html("")
        $("#arpApgar_Group").show()
        $("#arpGizi_Group").show()
        $("#arpAdl_Group").show()
        $("#arpDekubitus_Group").show()
        $("#arpStabilitas_Group").show()
        $("#arpEdukasiIntegrasi_Group").show()
        $("#arpEdukasiForm_Group").show()
        $("#arpGcs_Group").show()
        $("#arpIntegumen_Group").show()
        $("#arpNeurosensoris_Group").show()
        $("#arpPencernaan_Group").show()
        $("#arpPerkemihan_Group").show()
        $("#arpPernapasan_Group").show()
        $("#arpPsikologi_Group").show()
        $("#arpSeksual_Group").show()
        $("#arpSirkulasi_Group").show()
        $("#arpSocial_Group").show()
        $("#arpHearing_Group").show()
        $("#arpSleeping_Group").show()
        $("#arpTindakanKolaboratif_Group").show()
        $("#arpTindakanMandiri_Group").show()
        $("#arpImplementasi_Group").show()

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
                // // $("#formsavearpbtn").hide()
                // // $("#formeditarp").show()
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
                if (examForassessment.length > 0) {
                    // fillDataArp(examForassessment.length - 1)

                    displayTableAssessmentKeperawatan(examForassessment.length - 1)
                    displayTableAssessmentKeperawatanForVitalSign();
                    $("#arpAddDocument").hide()
                    $("#arpDocument").show()
                }
                // $.each(examForassessment, function(key, value) {
                var vsStatusId = [1, 4, 5];

                //     if (vsStatusId.includes(value.vs_status_id)) {
                //         fillDataArp(key)
                //         disableARP()
                //     }
                // })
                // fillDataArp(examForassessment.length)


                let examFiltered145 = examForassessment.filter(item => vsStatusId.includes(item.vs_status_id))
                fillDataArp(examFiltered145.length - 1)
                disableARP()


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
        <?php if (!is_null($visit['class_room_id'])) { ?>
            $('#arpclinic_id').val('<?= $visit['class_room_id']; ?>')
        <?php } else { ?>
            $('#arpclinic_id').val('<?= $visit['clinic_id']; ?>')
        <?php } ?>
        <?php if (!is_null($visit['class_room_id'])) { ?>
            $('#arpemployee_id').val('<?= $visit['employee_inap']; ?>')
        <?php } else { ?>
            $('#arpemployee_id').val('<?= $visit['employee_id']; ?>')
        <?php } ?>
        $("#arpclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#arpbed_id").val('<?= $visit['bed_id']; ?>')
        $("#arpin_date").val('<?= $visit['in_date']; ?>')
        $("#arpexit_date").val('<?= $visit['exit_date']; ?>')
        $("#arpkeluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#arpexamination_date").val(get_date())
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
        $("#arpisrj").val('<?= is_null($visit['class_room_id']) ? 1 : 0; ?>')
        $("#arpgender").val('<?= $visit['gender']; ?>')
        $("#arpdoctor").val('<?= $visit['fullname']; ?>')
        $("#arpkal_id").val('<?= $visit['kal_id']; ?>')
        $("#arppetugas_id").val('<?= user()->username; ?>')
        $("#arppetugas").val('<?= user()->getFullname(); ?>')
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

        $("#arpAddDocument").hide()
        $("#arpDocument").show()
        enableARP()
        fillRiwayatArp()
        generateSatelite()
    }

    function fillDataArp(index) {
        var ex = examForassessment[index]
        $.each(ex, function(key, value) {
            $("#arp" + key).val(value)
            $("#arp" + key).prop("disabled", true)
        })
        $("#arpclinic_id").html('<option value="' + ex.clinic_id + '">' + ex.name_of_clinic + '</option>')
        $("#arpemployee_id").html('<option value="' + ex.employee_id + '">' + ex.fullname + '</option>')
        $("#arpvs_status_id" + ex.vs_status_id).prop("checked", true)

        getFallRisk(ex.body_id)
        getPainMonitoring(ex.body_id)
        getTriage(ex.body_id, "bodyTriage")
        getGcs(ex.body_id, "bodyGcsPerawat")
        getApgar(ex.body_id)
        getStabilitas(ex.body_id)
        getPernapasan(ex.body_id)
        getSirkulasi(ex.body_id)
        getNeurosensoris(ex.body_id)
        getIntegumen(ex.body_id)
        getADL(ex.body_id)
        getPencernaan(ex.body_id)
        getDekubitus(ex.body_id)
        getPsikologi(ex.body_id)
        getPerkemihan(ex.body_id)
        getSeksual(ex.body_id)
        getSocial(ex.body_id)
        getGizi(ex.body_id)
        getEducationForm(ex.body_id)
        getEducationIntegration(ex.body_id)
        getHearing(ex.body_id)
        getSleeping(ex.body_id)
        disableARP()
    }

    function fillRiwayatArp() {
        $.each(riwayatAll, function(key, value) {
            if ($("#arpGEN0009" + value.value_id).is(":checkbox")) {
                $("#arpGEN0009" + value.value_id).prop("checked", true)
                $("#arpGEN0009" + value.value_id).prop("disabled", true)
            } else {
                $("#arpGEN0009" + value.value_id).val(value.histories)
                $("#arpGEN0009" + value.value_id).prop("disabled", true)
            }
        })
    }

    function signArp() {
        $("#formeditarpid").trigger("click")

        addSignUser("arp", "formsavearpbtnid", "formaddarp")
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
                    .append($("<td>").append($("<b>").html(value.examination_date)))
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
                    .append($("<td>").append($("<b>").html(value.examination_date)))
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
            console.log(key)
            if (value.vs_status_id == 2 || value.vs_status_id == 7) {
                let pd = examForassessment[key]
                addRowCPPT(value, key)
            }
        })
    }

    function enableARP() {
        $("#formsavearpbtnid").show()
        $("#formeditarpid").hide()
        // $(".formsignarp").show()
        $("#formaddarp input").prop("disabled", false)
        $("#formaddarp textarea").prop("disabled", false)
        $("#formaddarp select").prop("disabled", false)
        $("#vitalSignPerawat").find("button").click()
        $("#formaddarp").find(".btn-edit").each(function() {
            $(this).trigger("click")
        })
    }

    function disableARP() {
        $("#formsavearpbtnid").hide()
        $("#formeditarpid").show()
        // $(".formsignarp").hide()
        $("#formaddarp input").prop("disabled", true)
        $("#formaddarp textarea").prop("disabled", true)
        $("#formaddarp select").prop("disabled", true)
        $("#vitalSignPerawat").find("button").click()
        if ($("#arpvalid_user").val() != '' && $("#arpvalid_user").val() != null) {
            $("#formeditarpid").hide()
            $("#formsignarpid").hide()
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